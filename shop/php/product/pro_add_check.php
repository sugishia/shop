<?php
$pro_name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8');
$pro_price = htmlspecialchars($_POST['price'], ENT_QUOTES, 'utf-8');
$pro_picture = $_FILES['picture'];

if ($pro_picture['size'] > 0) {
    if ($pro_picture['size'] > 1000000) {
        $words = '画像ファイルのサイズが大きすぎます';
        header('Location:../staff_ng.php?words=' . $words);
        die();
    } else {
        move_uploaded_file($pro_picture['tmp_name'], './picture1/'.$pro_picture['name']);
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登録確認</title>
    <link href="../../bootstrap_lib/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="jumbotron h2">商品管理　登録・変更・削除</div>
    <p class="page-header h3">商品追加</p>
    <p>下記の商品を登録します</p>

    <table class="table table-striped text-center">
        <thead>
        <tr>
            <th>商品名</th>
            <th>値段</th>
            <th>画像</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="vertical-align: middle"><?= $pro_name ?></td>
            <td style="vertical-align: middle"><?= $pro_price ?></td>
            <td style="vertical-align: middle"><img class="img-circle" style="width:40px; height: auto; border-radius: 50%;" src="./picture/<?= $pro_picture['name'] ?>"></td>
        </tr>
        </tbody>
    </table>

    <form action="./pro_add_done.php" method="post">
        <input type="hidden" name="name" value="<?= $pro_name ?>">
        <input type="hidden" name="price" value="<?= $pro_price ?>">
        <input type="hidden" name="picture" value="<?= $pro_picture['name'] ?>">
        <button class="btn btn-default" type="button" onclick="history.back()">戻る</button>
        <button class="btn btn-primary" type="submit">ＯＫ</button>
    </form>
</div>
<script src="../../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>