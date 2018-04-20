<?php

echo '料理名：' . htmlspecialchars($_POST['food_name'], ENT_QUOTES, 'utf-8');
echo "<br>";

$valiable1 = (int)htmlspecialchars($_POST['cook_category'], ENT_QUOTES, 'utf-8');
$cook_category = category($valiable1);
echo 'カテゴリ：' . $cook_category;
echo "<br>";

$valiable2 = (int)htmlspecialchars($_POST['difficulty'], ENT_QUOTES, 'utf-8');
$difficulty = difficult($valiable2);
echo '難易度：' . $difficulty;
echo "<br>";

$valiable3 = htmlspecialchars($_POST['money'], ENT_QUOTES, 'utf-8');
if(is_numeric($valiable3)){
    echo number_format($valiable3);
    echo "<br>";
}else{
    die('数字の入力が不正です');
}

echo nl2br(htmlspecialchars($_POST['howto'], ENT_QUOTES, 'utf-8'));
echo '<br>';

function category($num){
    $result = '';
    $num = (int)$num;
    switch($num){
        case 1:
        $result = '和食';
        break;
        case 2:
        $result = '中華';
        break;
        case 3:
        $result = '洋食';
        break;
    }
    return $result;
}

function difficult($num){
    $result = '';
    $num = (int)$num;
    switch($num){
        case 1:
        $result = '簡単';
        break;
        case 2:
        $result = '普通';
        break;
        case 3:
        $result = '難しい';
        break;
    }
    return $result;
}