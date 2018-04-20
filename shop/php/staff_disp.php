<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/21
 * Time: 2:48
 */
require_once 'common_config.php';

try{
    if(empty($_GET['staffcode'])){
        throw new Exception('不正なＩＤです。');
    }

    $staff_code = htmlspecialchars($_GET['staffcode'], ENT_QUOTES, 'utf-8');

    $dbh = new PDO($mysql, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code, name FROM mst_staff WHERE code = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $staff_code, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $staff_name = $result['name'];

    $dbh = null;
}catch (Exception $error){
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
    <link rel="stylesheet" href="../bootstrap_lib/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="jumbotron h2">販売員　登録・変更・削除</div>
    <p class="page-header h3">スタッフ情報</p>
    <table class="table table-striped">
        <tr><th>スタッフコード</th><th>名　前</th></tr>
        <tr><td><?=$staff_code?></td><td><?=$staff_name?></td></tr>
    </table>
    <button class="btn-primary" onclick="location.href='./staff_list.php'">戻る</button>
</div>
</body>
</html>
