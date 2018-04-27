<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/21
 * Time: 2:48
 */
session_start();
session_regenerate_id(true);

if (isset($_SESSION['member_login']) == false) {
    $location = './member_login.html';
    $member_name = 'ゲスト';
    $login = '会員ログイン';

} else {
    $location = './member_logout.php';
    $member_name = $_SESSION['member_name'];
    $login = 'ログアウト';
}

require_once '../common_config.php';

try {
    if(empty($_GET['procode'])){
        throw new Exception('不正なＩＤが送られました。');
        die();
    }

    if(!(empty($_SESSION['cart']))){
        $cart = $_SESSION['cart'];
        $kazu = $_SESSION['kazu'];
    }

    $pro_code = $_GET['procode'];
    $kazu[] = 1;
    $cart[] = $pro_code;
    $_SESSION['cart'] = $cart;
    $_SESSION['kazu'] = $kazu;

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
    <style>
        #thead th{
            text-align: center;
        }
        #tbody td{
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container">
    <div style="clear: both; overflow: hidden; margin-top: 5px;"><span class="right" style="float: right; font-weight: bold;">ようこそ、<?= $member_name ?>様&nbsp;&nbsp;<button
                    class="btn btn-primary btn-sm" type="button"
                    onclick="location.href='<?= $location ?>'"><?= $login ?></button></span></div>
    <div class="jumbotron h2">商品　登録・変更・削除</div>
    <p class="page-header h3">商品詳細情報</p>

    <p>下記をカートに追加しました。</p>
    <table class="table table-striped table-bordered table-striped">
        <thead>
        <tr>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr><td></td></tr>
        </tbody>
    </table>

    <button class="btn btn-primary" onclick="location.href='./shop_list.php'">商品一覧に戻る</button>
</div>
<script src="../../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>
