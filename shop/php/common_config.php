<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/19
 * Time: 17:28
 */
#本番環境
/*
$user = 'sigishia';
$pass = '4179love';
$mysql = 'mysql:host=mysql715.db.sakura.ne.jp;dbname=sugishia_shop;charset=utf8';
*/

#開発環境
$user = 'user';
$pass = '4179love';
$mysql = 'mysql:host=localhost;dbname=shop;charset=utf8';

function sanitize($befor){
    foreach ($befor as $key => $value) {
        $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'utf-8');
    }
    return $after;
}
