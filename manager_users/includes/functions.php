<?php
//chặn người dùng truy cập không hợp lệ
if(!defined('_CODE')){
    die('Access dinied...');
}

function redirect($url) {
    header('Location: ' . $url);
    exit;
}

//layout
function layouts($layoutName='header', $data=[]){
    if(file_exists(_WEB_PATH_TEMPLATES.'/layout/'.$layoutName.'.php')){
        require_once(_WEB_PATH_TEMPLATES.'/layout/'.$layoutName.'.php');
    }
}



//kiểm tra phương thức

function isGet(){
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        return true;
    }
    return false;
}

function isPost(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        return true;
    }
    return false;
}

//Input Filter
function filter(){
    $filterArray = [];
    if(isGet()){
        if(!empty($_GET)){
            foreach($_GET as $key =>$value){
                $key = strip_tags($key);
                if(is_array($value)){
                    $filterArray[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $filterArray[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }

    if(isPost()){
        if(!empty($_POST)){
            foreach($_POST as $key =>$value){
                $key = strip_tags($key);
                if(is_array($value)){
                    $filterArray[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $filterArray[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }
    
    return $filterArray;
}

//validation
function isEmail($email){
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

function isNumberInt($num){
    $checkInt = filter_var($num, FILTER_VALIDATE_INT);
    return $checkInt;
}

function isNumberFloat($num){
    $checkFloat = filter_var($num, FILTER_VALIDATE_FLOAT);
    return $checkFloat;
}