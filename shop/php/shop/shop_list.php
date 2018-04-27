<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/20
 * Time: 2:21
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
    $dbh = new PDO($mysql, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code, name, price FROM mst_product WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

} catch (Exception $error) {
    echo '<h1 class="page-header">ただいま障害により大変ご迷惑をおかけしております。</h1>';
    echo htmlspecialchars($error->getMessage(), ENT_QUOTES, 'utf-8');
    die();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>商品一覧</title>
    <link rel="stylesheet" href="../../bootstrap_lib/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div style="clear: both; overflow: hidden; margin-top: 5px;">
        <span class="right" style="float: right; font-weight: bold;">
            ようこそ、<?= $member_name ?>様&nbsp;&nbsp;
            <button class="btn btn-primary btn-sm" type="button" onclick="location.href='<?= $location ?>'"><?= $login ?></button>
            <button class="btn btn-primary btn-sm" type="button" onclick="location.href='./shop_cartlook.php'">ショッピングカートを見る</button>
        </span>
    </div>
    <div class="jumbotron h2">商品　登録・変更・削除</div>
    <p class="page-header h3">商品一覧</p>

    <table class="table table-striped text-center table-hover" style="table-layout: fixed">
        <thead>
        <tr>
            <th class="text-center">チェック</th>
            <th class="text-center">商品名</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr><td><a style="display: block; text-decoration: none;" href="./shop_product.php?procode=' . $result['code'] . '">' . $result['name'] . '</a></td><td>' . $result['price'] . '</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<script src="../../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>
