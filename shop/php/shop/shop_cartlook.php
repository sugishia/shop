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

    if(isset($_SESSION['cart'])==true) {
        $cart = $_SESSION['cart'];
        $kazu = $_SESSION['kazu'];

        /*カートになにも入っていないときに、
         * */
        $max = count($cart);

        $dbh = new PDO($mysql, $user, $pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach ($cart as $key => $value) {
            $sql = 'SELECT name, price, picture FROM mst_product WHERE code = ?';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(1, $value, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $pro_name[] = $result['name'];
            $pro_price[] = $result['price'];
            $pro_picture[] = $result['picture'];
        }

        $dbh = null;
    }else{
        $max = 0;
    }
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
        #thead th {
            text-align: center;
        }

        #tbody td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container">
    <div style="clear: both; overflow: hidden; margin-top: 5px;">
        <span class="right" style="float: right; font-weight: bold;">ようこそ、<?= $member_name ?>様&nbsp;&nbsp;<button class="btn btn-primary btn-sm" type="button" onclick="location.href='<?= $location ?>'"><?= $login ?></button></span>
    </div>
    <div class="jumbotron h2">商品　登録・変更・削除</div>
    <p class="page-header h3">商品詳細情報</p>
    <table style="table-layout: fixed" class="table table-striped text-center table-hover">
        <thead id="thead">
        <tr>
            <th>商品</th>
            <th>単価</th>
            <th>写真</th>
            <th>個数</th>
            <th>金額</th>
            <th>削除</th>
        </tr>
        </thead>
        <tbody id="tbody">
        <form action="./kazu_change.php" method="post">
            <?php for ($i = 0; $i < $max; $i++) { ?>
                <tr>
                    <td><?=$pro_name[$i]?></td>
                    <td><?=$pro_price[$i]?>円</td>
                    <td><img style="border-radius: 50%; width: 40px; height: auto" src="../product/picture/<?=$pro_picture[$i]?>"></td>
                    <td><input style="width: 20%;" type="number" name="kazu<?=$i?>" value="<?=$kazu[$i]?>">個</td>
                    <td><?=$pro_price[$i] * $kazu[$i]?>円</td>
                    <td><input type="checkbox" name="sakujo<?= $i ?>"></td>
                </tr>
            <?php } ?>
            <?php if($max == 0) {?>
                <tr><td colspan="6" style="font-size: 1.5em; font-weight: bold; color: red; text-align: center">商品が入っていません。</td></tr>
            <?php } ?>
            <input type="hidden" name="max" value="<?= $max; ?>">
        </tbody>
    </table>
    <button class="btn btn-primary" type="submit">数量変更</button>
    </form>
    <button class="btn btn-primary" onclick="location.href='./shop_list.php'">戻る</button>
</div>
<script src="../../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>
