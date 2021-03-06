<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/20
 * Time: 0:34
 */
session_start();
session_regenerate_id(true);

if (isset($_SESSION['login']) == false) {
    $words = 'ログインされていません';
    header('Location:./staff_ng.php?words=' . $words);
    die();
}

require_once './common_config.php';

$post = sanitize($_POST);
$staff_code = $post['code'];
$staff_name = $post['name'];
$staff_pass = $post['password1'];

try {
    $dbh = new PDO($mysql, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE mst_staff SET name = ?, password = ? WHERE code = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $staff_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $staff_pass, PDO::PARAM_STR);
    $stmt->bindValue(3, $staff_code, PDO::PARAM_STR);
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
    <link rel="stylesheet" href="../bootstrap_lib/bootstrap.min.css">
</head>
<body>
<div class="container">
    <span class="bg-success right" style="float: right; font-weight: bold;"><?= $_SESSION['name'] ?>さん ログイン中</span>
    <p class="page-header"><?= $staff_name ?>さんのデータを修正しました。</p>
    <button class="btn-primary" onclick="location.href='./staff_list.php'">戻る</button>
</div>
<script src="../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>
