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
    header('Location:./staff_ng.php?words='.$words);
    die();
}

require_once 'common_config.php';

try {
    if (empty($_GET['staffcode'])) {
        throw new Exception('不正なＩＤです');
    }

    $staff_code = htmlspecialchars($_GET['staffcode'], ENT_QUOTES, 'utf-8');

    $dbh = new PDO($mysql, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT name FROM mst_staff WHERE code = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $staff_code, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../bootstrap_lib/bootstrap.min.css">
</head>
<body>
<div class="container">
    <span class="bg-success right" style="float: right; font-weight: bold;"><?= $_SESSION['name'] ?>さん ログイン中</span>
    <div class="jumbotron h2">販売員　登録・変更・削除</div>
    <p class="page-header h3">スタッフ削除</p>

    <table class="table table-striped">
        <tr><td>スタッフコード</td><td>名　前</td></tr>
        <tr><td><?=$staff_code?></td><td><?=$result['name']?></td></tr>
    </table>
    <p>このスタッフを削除してよろしいですか？</p>
    <form action="./staff_delete_done.php" method="post">
        <input type="hidden" name="staff_id" value="<?= $staff_code ?>">
        <button class="btn btn-default" type="button" onclick="history.back();">戻る</button>
        <button class="btn btn-primary" type="submit">ＯＫ</button>
        <!--<input type="submit" value="ＯＫ">-->
    </form>
</div>
<script src="../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>
