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

    session_start();
    session_regenerate_id(true);

    if (isset($_SESSION['login']) == false) {
        $words = 'ログインされていません';
        header('Location:./staff_ng.php?words=' . $words);
        die();
    }

    require_once './common_config.php';

    $post = sanitize($_POST);
    $staff_name = $post['name'];
    $staff_pass1 = $post['password1'];
    $staff_pass2 = $post['password2'];

    $judge = true;


    if (empty($staff_name)) {
        echo 'スタッフ名が入力されていません';
        $judge = false;
    } else {
        echo 'スタッフ名：　' . $staff_name . '<br>';
    }

    if ($staff_pass1 !== $staff_pass2) {
        echo 'パスワードが一致しません';
        $judge = false;
    }

    if ($judge === false) {
        echo '<form>';
        echo '<input class="btn btn-danger" type="button" onclick="history.back();" value="戻る">';
        echo '</form>';
    } else {
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
    <span class="bg-success right" style="float: right; font-weight: bold;"><?= $_SESSION['name'] ?>さん ログイン中</span>
</div>
<script src="../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>