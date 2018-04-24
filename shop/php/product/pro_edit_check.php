<?php
$pro_code = htmlspecialchars($_POST['procode'], ENT_QUOTES, 'utf-8');
$pro_name = htmlspecialchars($_POST['proname'], ENT_QUOTES, 'utf-8');
$pro_price = htmlspecialchars($_POST['proprice'], ENT_QUOTES, 'utf-8');
$pro_old_picture = htmlspecialchars($_POST['pro_old_picture'], ENT_QUOTES, 'utf-8');
$pro_new_picture = $_FILES['pro_new_picture'];
#echo $pro_new_picture['name'];

if($pro_new_picture['name'] === ''){
    $pro_new_picture['name'] = 'default/default.png';
}

if ($pro_new_picture['size'] > 0) {
    if ($pro_new_picture['size'] > 1000000) {
        $word = 'ファイルサイズが大きすぎます。';
        header('Location:../staff_ng.php?word=' . $word);
        die();
    } else {
        move_uploaded_file($pro_new_picture['tmp_name'], './picture/'.$pro_new_picture['name']);
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>編集確認</title>
    <link href="../../bootstrap_lib/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="jumbotron h2">商品　登録・変更・削除</div>
    <p class="page-header h3">商品 変更内容確認</p>
    <p>下記のように変更します</p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>商品名</th>
            <th>金額</th>
            <th>画像</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= $pro_name ?></td>
            <td><?= $pro_price ?></td>
            <td><img style="border-radius: 50%; width: 40px; height: auto;" src="./picture/<?= $pro_new_picture['name'] ?>"></td>
        </tr>
        </tbody>
    </table>
    <form action="./pro_edit_done.php" method="post">
        <div>
            <input type="hidden" name="code" value="<?= $pro_code ?>">
            <input type="hidden" name="name" value="<?= $pro_name ?>">
            <input type="hidden" name="price" value="<?= $pro_price ?>">
            <input type="hidden" name="picture_old_name" value="<?= $pro_old_picture ?>">
            <input type="hidden" name="picture_new_name" value="<?= $pro_new_picture['name'] ?>">
        </div>
        <button class="btn btn-default" type="button" onclick="history.back()">戻る</button>
        <button class="btn btn-primary" style="margin-left: 5px;" type="submit">ＯＫ</button>
    </form>
</div>
<script src="../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>