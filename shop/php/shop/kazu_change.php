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

$_SESSION['kazu'] = $kazu;

header('Location:./shop_cartlook.php');
die();