<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/26
 * Time: 1:53
 */
require_once '../common_config.php';

$code = htmlspecialchars($_POST['code'], ENT_QUOTES, 'utf-8');
#echo $code;
$password = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'utf-8');
$password = md5($password);

try{
    $dbh = new PDO($mysql, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT name FROM mst_staff WHERE code = ? AND password = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $code, PDO::PARAM_INT);
    $stmt->bindValue(2, $password, PDO::PARAM_STR);
    $stmt->execute();

    $dbh = null;

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result == false){
        $word = 'スタッフコードかパスワードが間違ってます。';
        header('Location:../staff_ng.php?' . $word);
        die();
    }else{
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['code'] = $code;
        $_SESSION['name'] = htmlspecialchars($result['name'], ENT_QUOTES, 'utf-8');
        $_SESSION['pass'] = $password;
        header('Location:./staff_top.php');
        die();
    }

}catch (Exception $error){
    echo '<h1 class="page-header">ただいま障害により大変ご迷惑をおかけしております。</h1>';
    echo htmlspecialchars($error->getMessage(), ENT_QUOTES, 'utf-8');
    die();
}