<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<h1>レシピの一覧</h1>
<a href="./form.html">レシピの新規登録</a>
<?php
require_once './db_config.php';

try{
    $dbh = new PDO('mysql:host=localhost;dbname=cooking_db;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    //SQL文の準備
    $sql = 'select * from recipe';
    //SQLの実行した結果を$stmtへ代入
    $stmt = $dbh->query($sql);
    //実行結果の取り出し
    //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr>";
    echo "<th>料理名</th><th>予算</th><th>難易度</th>";
    echo "</tr>";
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($result['food_name'], ENT_QUOTES, 'utf-8') . "</td>";
        echo "<td>" . htmlspecialchars($result['money'], ENT_QUOTES, 'utf-8') . "</td>";
        echo "<td>" . htmlspecialchars($result['difficulty'], ENT_QUOTES, 'utf-8') . "</td>";
        echo "<td>\n";
        echo "<a href=./detail.php?id=" . htmlspecialchars($result['id'], ENT_QUOTES, 'utf-8') . ">詳細</a>\n";
        echo "<a href=./edit.php?id=" . htmlspecialchars($result['id'], ENT_QUOTES, 'utf-8') . ">|変更</a>\n";
        echo "<a href=./delete.php?id=" . htmlspecialchars($result['id'], ENT_QUOTES, 'utf-8') . ">｜削除</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";

    $dbh = null;
}catch(Exception $e){
    echo htmlspecialchars($e->getMessage(), ENT_QUOTES, 'utf-8');
    die();
}
?>
</body>
</html>
