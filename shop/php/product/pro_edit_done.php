<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/20
 * Time: 0:34
 */
require_once '../common_config.php';

$pro_code = htmlspecialchars($_POST['code'], ENT_QUOTES, 'utf-8');
$pro_name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8');
$pro_price = htmlspecialchars($_POST['price'], ENT_QUOTES, 'utf-8');
$pro_picture_old_name = htmlspecialchars($_POST['picture_old_name'], ENT_QUOTES, 'utf-8');
$pro_picture_new_name = htmlspecialchars($_POST['picture_new_name'], ENT_QUOTES, 'utf-8');
echo $pro_picture_old_name;

try {
    $dbh = new PDO($mysql, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE mst_product SET name = ?, price = ?, picture = ? WHERE code = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $pro_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $pro_price, PDO::PARAM_STR);
    $stmt->bindValue(3, $pro_picture_new_name, PDO::PARAM_STR);
    $stmt->bindValue(4, $pro_code, PDO::PARAM_STR);
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
    <div class="jumbotron h2">商品　登録・変更・削除</div>
    <p class="page-header h3">商品 変更</p>
    <p class="page-header"><?= $pro_name ?>のデータを修正しました。</p>
    <button class="btn btn-primary" onclick="location.href='./pro_list.php'">戻る</button>
</div>
<script src="../../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>
