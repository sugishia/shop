<?php
session_start();
session_regenerate_id(true);

if(isset($_SESSION['login']) == false){
    $words = 'ログインされていません';
    header('Location:../staff_ng.php?words='.$words);
    die();
}

/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/20
 * Time: 22:14
 */

$pro_code = $_POST['code'];

function branch(){
    if(isset($_POST['code']) === false){
        header('Location: pro_ng.php');
        die();
    }
}

if(isset($_POST['add']) === true){
    header('Location: pro_add.php');
    exit();
}

if(isset($_POST['edit']) === true){
    branch();
    header('Location: pro_edit.php?procode='.$pro_code);
    exit();
}

if (isset($_POST['delete']) === true){
    branch();
    header('Location: pro_delete.php?procode='.$pro_code);
    exit();
}

if (isset($_POST['disp']) === true){
    branch();
    header('Location: pro_disp.php?procode='.$pro_code);
    exit();
}