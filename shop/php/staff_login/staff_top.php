<?php
session_start();
session_regenerate_id(true);

if(isset($_SESSION['login']) == false){
    $words = 'ログインされていません';
    header('Location:../staff_ng.php?words='.$words);
    die();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>トップメニュー</title>
    <link rel="stylesheet" href="../../bootstrap_lib/bootstrap.min.css">
</head>
<body>
<div class="container">
    <span class="bg-success right" style="float: right; font-weight: bold;"><?= $_SESSION['name'] ?>さん ログイン中</span>
    <div class="jumbotron h2">トップメニュー</div>
    <p class="page-header h3">ショップ管理トップメニュー</p>
    <div style="width: 80%; margin: auto">
        <button style="display: block; width: 100%;" class="btn btn-primary btn-lg" type="button" onclick="location.href='../staff_list.php'">スタッフ管理</button>
        <button style="display: block; width: 100%; margin-top: 3%;" class="btn btn-info btn-lg" type="button" onclick="location.href='../product/pro_list.php'">商品管理</button>
        <button style="display: block; width: 100%; margin-top: 3%;" class="btn btn-success btn-lg" type="button" onclick="location.href='./staff_logout.php'">ログアウト</button>
    </div>
</div>
</body>
</html>