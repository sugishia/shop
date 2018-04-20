<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登録確認</title>
    <link href="../bootstrap_lib/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">

<?php


$staff_name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8');
$staff_pass1 = htmlspecialchars($_POST['password1'], ENT_QUOTES, 'utf-8');
$staff_pass2 = htmlspecialchars($_POST['password2'], ENT_QUOTES, 'utf-8');

$judge = true;


if(empty($staff_name)){
    echo 'スタッフ名が入力されていません';
    $judge =false;
}else{
    echo 'スタッフ名：　' . $staff_name . '<br>';
}

if(empty($staff_pass1)){
    echo 'パスワードが入力されていません';
    $judge = false;
}

if($staff_pass1 !== $staff_pass2){
    echo 'パスワードが一致しません';
    $judge = false;
}

if($judge === false){
    echo '<form>';
    echo '<input type="button" onclick="history.back();" value="戻る">';
    echo '</form>';
}else{
    # ↓↓↓　$staff_pass1の変数を暗号化：md5暗号化規格！！　↓↓↓
    $staff_pass1 = md5($staff_pass1);
    echo '<form action="./staff_add_done.php" method="post">';
    echo '<input type="hidden" name="name" value="' . $staff_name . '">';
    echo '<input type="hidden" name="password1" value="' . $staff_pass1 . '">';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit" value="OK">';
    echo '</form>';
}

?>

</div>
    <script src="../bootstrap_lib/jquery-3.2.1.min.js"></script>
    <script src="../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>