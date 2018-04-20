<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/17
 * Time: 17:19
 */

$user = 'user';
$pass = '4179love';

try{
    if(empty($_GET['id'])){
        throw new Exception('不正なIDです');
    }

    $id = (int)$_GET['id'];

    $dbh = new PDO('mysql:host=localhost;dbname=cooking_db;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM recipe WHERE id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $dbh =null;

    echo '登録内容を変更しました。';
}catch(Exception $error){
    echo 'エラー発生：' . htmlspecialchars($error->getMessage(), ENT_QUOTES, 'utf-8') . '<br>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>入力フォーム</title>
</head>
<body>
    <form action="./update.php" method="post">
        料理名：
        <input type="text" name="food_name" value="<?php echo htmlspecialchars($result['food_name'], ENT_QUOTES, 'utf-8'); ?>" required>
        <br>
        カテゴリー：
        <select name="cook_category" required>
            <option value="">選択してください</option>
            <option value="1" <?php if($result['cook_category'] === 1) echo 'selected'; ?>>和食</option>
            <option value="2" <?php if($result['cook_category'] === 2) echo 'selected'; ?>>中華</option>
            <option value="3" <?php if($result['cook_category'] === 3) echo 'selected'; ?>>洋食</option>
        </select>
        <br>
        予算：
        <input type="number" name="money" value="<?php echo htmlspecialchars($result['money'], ENT_QUOTES, 'utf-8'); ?>" required>円
        <br>
        難易度：
        <input type="radio" name="difficulty" value="1" <?php if($result['difficulty'] === 1) echo 'checked'; ?>>簡単
        <input type="radio" name="difficulty" value="2" <?php if($result['difficulty'] === 2) echo 'checked'; ?>>普通
        <input type="radio" name="difficulty" value="3" <?php if($result['difficulty'] === 3) echo 'checked'; ?>>難しい
        <br>
        作り方：
        <textarea name="howto" required><?php echo htmlspecialchars($result['howto'], ENT_QUOTES, 'utf-8'); ?></textarea>

        <input type="hidden" name="id" value="<?php echo htmlspecialchars($result['id'], ENT_QUOTES, 'utf-8'); ?>">
        <input type="submit" value="送信">
    </form>
</body>
</html>
