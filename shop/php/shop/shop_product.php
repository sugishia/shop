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
    if (empty($_GET['procode'])) {
        throw new Exception('不正なＩＤです。');
    }

    $pro_code = htmlspecialchars($_GET['procode'], ENT_QUOTES, 'utf-8');

    $dbh = new PDO($mysql, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT name, price, picture FROM mst_product WHERE code = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $pro_code, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = htmlspecialchars($result['name'], ENT_QUOTES, 'utf-8');
    $pro_price = htmlspecialchars($result['price'], ENT_QUOTES, 'utf-8');
    $pro_picture = $result['picture'];

    /*
    if($pro_picture === ''){
        $pro_picture = 'default.png';
    }
    */

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
    <table style="table-layout: fixed" class="table table-striped text-center table-hover">
        <thead id="thead">
        <tr>
            <th>商品コード</th>
            <th>商品</th>
            <th>価格</th>
            <th>写真</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="tbody">
        <tr>
            <td><?= $pro_code ?></td>
            <td><?= $pro_name ?></td>
            <td><?= $pro_price ?></td>
            <td><img style="border-radius: 50%; width: 40px; height: auto" src="../product//picture/<?= $pro_picture ?>"></td>
            <td><button class="btn btn-primary btn-sm" type="button" onclick="location.href='./shop_cartin.php?procode=<?= $pro_code ?>'">カートに入れる</button></td>
        </tr>
        </tbody>
    </table>
    <button class="btn btn-primary" onclick="location.href='./shop_list.php'">戻る</button>
</div>
<script src="../../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>
