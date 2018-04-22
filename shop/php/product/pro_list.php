<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/20
 * Time: 2:21
 */
require_once '../common_config.php';

try {
    $dbh = new PDO($mysql, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code, name FROM mst_product WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

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
    <title>スタッフ一覧</title>
    <link rel="stylesheet" href="../../bootstrap_lib/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="jumbotron h2">商品　登録・変更・削除</div>
    <p class="page-header h3">商品一覧</p>
    <form method="post" action="./pro_branch.php">
        <table class="table table-striped">
            <tr>
                <th>チェック</th>
                <th>商品名</th>
            </tr>
            <?php
            $i = 0;
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if($i === 0){
                    echo '<tr><td><input type="radio" name="code" value="' . $result['code'] . '" checked></td><td>' . $result['name'] . '</td></tr>';
                }else{
                    echo '<tr><td><input type="radio" name="code" value="' . $result['code'] . '"></td><td>' . $result['name'] . '</td></tr>';
                }
                $i++;
            }
            ?>
        </table>
        <button class="btn btn-info" type="submit" name="disp" value="disp">詳細</button>
        <button class="btn btn-primary" type="submit" name="add" value="add">追加</button>
        <button class="btn btn-success" type="submit" name="edit" value="edit">修正</button>
        <button class="btn btn-danger" type="submit" name="delete" value="delete">削除</button>
    </form>
</div>
<script src="../../bootstrap_lib/jquery-3.2.1.min.js"></script>
<script src="../../bootstrap_lib/bootstrap.min.js"></script>
</body>
</html>
