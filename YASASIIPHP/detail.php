<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/17
 * Time: 12:25
 */

$user = 'user';
$pass = '4179love';

try{
    if(empty($_GET['id'])){
        throw new Exception('ID不正');
    }
    $id = (int) $_GET['id'];

    $dbh = new PDO('mysql:host=localhost;dbname=cooking_db;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "select * from recipe where id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo '料理名：' . htmlspecialchars($result['food_name'], ENT_QUOTES, 'utf-8') . "<br>";
    echo 'カテゴリー：' . htmlspecialchars($result['cook_category'], ENT_QUOTES, 'utf-8') . "<br>";
    echo '予算：' . htmlspecialchars($result['money'], ENT_QUOTES, 'utf-8') . "<br>";
    echo '難易度：' . htmlspecialchars($result['difficulty'], ENT_QUOTES, 'utf-8') . "<br>";
    echo '作り方：<br>' . nl2br(htmlspecialchars($result['howto'], ENT_QUOTES, 'utf-8') . "<br>");
    $dbh = null;

}catch(Exception $e){
    echo htmlspecialchars($e->getMessage(), ENT_QUOTES, 'utf-8');
    exit();
}