<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/20
 * Time: 22:14
 */

$staff_code = $_POST['staffcode'];

function branch(){
    if(isset($_POST['staffcode']) === false){
        header('Location: staff_ng.php');
        die();
    }
}

if(isset($_POST['add']) === true){
    header('Location: staff_add.php');
    exit();
}

if(isset($_POST['edit']) === true){
    branch();
    header('Location: staff_edit.php?staffcode='.$staff_code);
    exit();
}

if (isset($_POST['delete']) === true){
    branch();
    header('Location: staff_delete.php?staffcode='.$staff_code);
    exit();
}

if (isset($_POST['disp']) === true){
    branch();
    header('Location: staff_disp.php?staffcode='.$staff_code);
    exit();
}