<?php
if (empty($_GET['words'])) {
    throw new Exception('不正なGETメソッドが送られました');
}
$words = htmlspecialchars($_GET['words'], ENT_QUOTES, 'utf-8');
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
    <div class="jumbotron h2 bg-danger">エラー通知</div>
    <p class="page-header h3">エラー</p>
    <p><?= $words ?></p>
    <button onclick="location.href='./staff_list.php'">戻る</button>
</div>
</body>
</html>