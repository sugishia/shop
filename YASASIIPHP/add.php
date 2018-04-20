<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/17
 * Time: 14:07
 */

$user = 'user';
$pass = '4179love';
$array_data = [
    'food_name' => (string) $_POST['food_name'],
    'cook_category' => (int) $_POST['cook_category'],
    'money' => (int) $_POST['money'],
    'difficulty' =>(int) $_POST['difficulty'],
    'howto' => (string) $_POST['howto']
];

try{
    $dbh = new PDO('mysql:host=localhost;dbname=cooking_db;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'INSERT INTO recipe (food_name, cook_category, money, difficulty, howto) VALUES (?, ?, ?, ?, ?)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $array_data['food_name'], PDO::PARAM_STR);
    $stmt->bindValue(2, $array_data['cook_category'], PDO::PARAM_INT);
    $stmt->bindValue(3, $array_data['money'], PDO::PARAM_INT);
    $stmt->bindValue(4, $array_data['difficulty'], PDO::PARAM_INT);
    $stmt->bindValue(5, $array_data['howto'], PDO::PARAM_STR);

    $stmt->execute();

    $dbh = null;

    echo 'レシピの登録が完了しました。';
}catch (Exception $error){
    echo htmlspecialchars($error->getMessage(), ENT_QUOTES, 'utf-8');
    exit();
}