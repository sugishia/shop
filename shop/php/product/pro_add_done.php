<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/20
 * Time: 0:34
 */
session_start();
session_regenerate_id(true);

if(isset($_SESSION['login']) == false){
    $words = 'ログインされていません';
    header('Location:../staff_ng.php?words='.$words);
    die();
}

require_once '../common_config.php';

$pro_name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8');
$pro_price = htmlspecialchars($_POST['price'], ENT_QUOTES, 'utf-8');
$pro_picture = htmlspecialchars($_POST['picture'], ENT_QUOTES, 'utf-8');

try {
    $dbh = new PDO($mysql, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'INSERT INTO mst_product(name, price, picture) VALUES (?, ?, ?)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $pro_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $pro_price, PDO::PARAM_STR);
    $stmt->bindValue(3, $pro_picture, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $dbh = null;

} catch (Exception $error) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。<br>';
    echo htmlspecialchars($error->getMessage(), ENT_QUOTES, 'utf-8');
    die();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="../../bootstrap_lib/bootstrap.min.css">
</head>
<body>
<div class="container">
    <span class="bg-success right" style="float: right; font-weight: bold;"><?= $_SESSION['name'] ?>さん ログイン中</span>
    <div class="jumbotron h2">商品　登録・変更・削除</div>
    <p class="page-header h3">商品登録</p>
    <p><?=$pro_name?>を追加しました</p>
    <button class="btn btn-default" onclick="location.href='./pro_list.php'">戻る</button>
</div>
<script src="../../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>
