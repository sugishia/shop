<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/20
 * Time: 13:24
 */
session_start();
session_regenerate_id(true);

if(isset($_SESSION['login']) == false){
    $words = 'ログインされていません';
    header('Location:../staff_ng.php?words='.$words);
    die();
}

require_once '../common_config.php';

try {
    if (empty($_GET['procode'])) {
        throw new Exception('不正なＩＤです');
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

    $pro_name = $result['name'];
    $pro_price = $result['price'];
    $pro_old_picture = $result['picture'];
    #echo $pro_old_picture;
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
    <title></title>
    <link rel="stylesheet" href="../../bootstrap_lib/bootstrap.min.css">
</head>
<body>
<div class="container">
    <span class="bg-success right" style="float: right; font-weight: bold;"><?= $_SESSION['name'] ?>さん ログイン中</span>
    <div class="jumbotron h2">商品　登録・変更・削除</div>
    <p class="page-header h3">商品 登録変更</p>
    <form action="./pro_edit_check.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="procode" value="<?= $pro_code ?>">
        <input type="hidden" name="pro_old_picture" value="<?= $pro_old_picture ?>">
        <div class="form-group">
            <label for="name">商品名入力</label>
            <input class="form-control" type="text" name="proname" value="<?= $result['name'] ?>" required>
        </div>
        <div class="form-group">
            <label for="staff_pass1">金額入力</label>
            <input class="form-control" type="number" name="proprice" value="<?= $result['price'] ?>" required>
        </div>
        <div class="form-group">
            <label for="staff_pass1">画像入力</label>
            <img style="border-radius: 50%; width: 40px; height: auto;" src="./picture/<?= $pro_old_picture ?>">
            <input class="form-control" type="file" name="pro_new_picture" value="<?= $result['picture'] ?>">
        </div>
        <button class="btn btn-primary" type="button" onclick="history.back();">戻る</button>
        <button class="btn btn-default" type="submit">ＯＫ</button>
        <!--<input type="submit" value="ＯＫ">-->
    </form>
</div>
<script src="../../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>
