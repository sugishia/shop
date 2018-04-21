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

<?php
$word = '';
$judge = true;

$pro_name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8');
$pro_price = htmlspecialchars($_POST['price'], ENT_QUOTES, 'utf-8');

if(empty($pro_name)){
    $word = '<p>商品名が入力されていません</p>';
    $judge =false;
}else{
    $word = '<p>商品名：　' . $pro_name . '</p>';
}

if(preg_match('/\A[0-9]+\z/', $pro_price) === 0){
    $word = '<p>価格を正しく入力してください。</p>';
    $judge = false;
}

if($judge === false){
    echo $word;
    echo '<form>';
    echo '<input type="button" onclick="history.back();" value="戻る">';
    echo '</form>';
}else{
    echo '<p>' . $word . '</p>';
    echo '上記の商品を登録します';
    echo '<form action="./pro_add_done.php" method="post">';
    echo '<input type="hidden" name="name" value="' . $pro_name . '">';
    echo '<input type="hidden" name="price" value="' . $pro_price . '">';
    echo '<input class="btn btn-default" type="button" onclick="history.back()" value="戻る">';
    echo '<input class="btn btn-primary" type="submit" value="OK">';
    echo '</form>';
}

?>

</div>
    <script src="../../bootstrap_lib/jquery-3.2.1.min.js"></script>
    <script src="../../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>