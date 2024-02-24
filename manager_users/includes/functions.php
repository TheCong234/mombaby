<?php
//chặn người dùng truy cập không hợp lệ
if(!defined('_CODE')){
    die('Access dinied...');
}

//layout
function layouts($layoutName='header', $data=[]){
    if(file_exists(_WEB_PATH_TEMPLATES.'/layout/'.$layoutName.'.php')){
        require_once(_WEB_PATH_TEMPLATES.'/layout/'.$layoutName.'.php');
    }
}