<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/18
 * Time: 23:42
 */

$user = 'user';
$pass = '4179love';

$food_name = (string)$_POST['food_name'];
$cook_category = (int)$_POST['cook_category'];
$money = (int)$_POST['money'];
$difficulty = (int)$_POST['difficulty'];
$howto = (string)$_POST['howto'];

try{
    if(empty($_POST['id'])){
        throw new Exception('不正なIDです');
    }

    $id = (int)$_POST['id'];

    $dbh = new PDO('mysql:host=localhost;dbname=cooking_db', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE recipe SET food_name = ?, cook_category = ?, money = ?, difficulty = ?, howto = ? WHERE id = ?';
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(1, $food_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $cook_category, PDO::PARAM_INT);
    $stmt->bindValue(3, $money, PDO::PARAM_INT);
    $stmt->bindValue(4, $difficulty, PDO::PARAM_INT);
    $stmt->bindValue(5, $howto, PDO::PARAM_STR);
    $stmt->bindValue(6, $id, PDO::PARAM_INT);
    $stmt->execute();

    $dbh = null;

    echo 'ID： ' . htmlspecialchars($id, ENT_QUOTES, 'utf-8') . 'レシピの更新が完了しました。';
}catch (Exception $error){
    echo 'エラー発生：' . htmlspecialchars($error->getMessage(), ENT_QUOTES, 'utf-8');
    die();
}