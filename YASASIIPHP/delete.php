<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/17
 * Time: 15:49
 */
$user = 'user';
$pass = '4179love';

try{
    if(empty($_GET['id'])){
        throw new Exception('不正');
    }
    $id = (int) $_GET['id'];

    $dbh = new PDO('mysql:host=localhost;dbname=cooking_db;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'DELETE FROM recipe WHERE id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);

    $stmt->execute();
    $dbh = null;

    echo '削除完了したぞ。';
}catch (Exception $error){
    echo 'エラー発生：' . htmlspecialchars($error->getMessage(), ENT_QUOTES, 'utf-8') . '<br>';
    exit();
}