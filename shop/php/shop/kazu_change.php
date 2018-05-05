<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/28
 * Time: 2:37
 */

session_start();
session_regenerate_id(true);

require_once '../common_config.php';

$post = sanitize($_POST);

$max = $post['max'];
for($i = 0; $i < $max; $i++){
    $kazu[] = $_POST['kazu' . $i];
}

$cart = $_SESSION['cart'];
for($i = $max - 1; $i >= 0; $i--){
    if(isset($_POST['sakujo' . $i]) == true){
        array_splice($kazu, $i, 1);
        array_splice($cart, $i, 1);
    }
}

$_SESSION['cart'] = $cart; //カートに入っている商品コードの配列
$_SESSION['kazu'] = $kazu; //カートに入っている商品個数の配列

header('Location:./shop_cartlook.php');
die();