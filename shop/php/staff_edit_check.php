<?php
require_once './common_config.php';

session_start();
session_regenerate_id(true);

if (isset($_SESSION['login']) == false) {
    $words = 'ログインされていません';
    header('Location:./staff_ng.php?words=' . $words);
    die();
}

$post = sanitize($_POST);
$staff_code = $post['staff_code'];
$staff_name = $post['staff_name'];
$staff_pass1 = $post['staff_pass1'];
$staff_pass2 = $post['staff_pass2'];

$judge = true;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>編集確認</title>
    <link href="../bootstrap_lib/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <span class="bg-success right" style="float: right; font-weight: bold;"><?= $_SESSION['name'] ?>さん ログイン中</span>
    <div class="jumbotron h2">販売員　登録・変更・削除</div>
    <h2 class="page-header">編集確認</h2>

    <?php
    if (empty($staff_name)) {
        echo 'スタッフ名が入力されていません';
        $judge = false;
    } else {
        echo '<p>スタッフ名：　' . $staff_name . '</p>';
    }

    if ($staff_pass1 !== $staff_pass2) {
        echo 'パスワードが一致しません';
        $judge = false;
    }

    if ($judge === false) {
        echo '<form>';
        echo '<button class="btn-default" type="button" onclick="history.back();">戻る</button>';
        echo '</form>';
    } else {
        # ↓↓↓　$staff_pass1の変数を暗号化：md5暗号化規格！！　↓↓↓
        $staff_pass1 = md5($staff_pass1);
        echo '<form action="./staff_edit_done.php" method="post">';
        echo '<div><input type="hidden" name="code" value="' . $staff_code . '">';
        echo '<input type="hidden" name="name" value="' . $staff_name . '">';
        echo '<input type="hidden" name="password1" value="' . $staff_pass1 . '"></div>';
        echo '<button class="btn btn-default" type="button" onclick="history.back()">戻る</button>';
        echo '<button class="btn btn-primary" style="margin-left: 5px;" type="submit">ＯＫ</button>';
        echo '</form>';
    }

    ?>

</div>
<script src="../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>