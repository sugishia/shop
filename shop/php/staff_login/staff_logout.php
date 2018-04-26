<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/26
 * Time: 23:27
 */
session_start();
session_regenerate_id(true);

$_SESSION = array();
if(isset($_SESSION[session_name()]) == true){
    setcookie(session_name(), '', time()-42000, '/');
}
session_destroy();

header('Location:./staff_login.html');

?>