<?php
if(!defined('_CODE')){
    die('Access dinied...');
}

$test = 'khong tc';

try{
    if(class_exists('PDO')){
        $dsn = 'mysql:dbname='._DB.';host'._HOST;

        $options=[
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        $conn = new PDO($dsn, _USER, _PASS, $options);
        $test = 'thanh cong';
    }
}catch(Excetion $exp){
    echo $exp ->getMessage().'<br>';
    die();
}

//echo $test;
?>