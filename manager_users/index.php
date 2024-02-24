
<?php
session_start();
require_once('config.php');

require_once('./includes/functions.php');

$module = _MODULE;
$action = _ACTION;
$code = _CODE;
//gán giá trị cho module nếu tham số tồn tại và là chuỗi
if(!empty($_GET['module'])){
    if(is_string($_GET['module'])){
        $module = trim($_GET['module']);
    }
}

//gán giá trị cho action nếu tham số tồn tại và là chuỗi
if(!empty($_GET['action'])){
    if(is_string($_GET['action'])){
        $action = trim($_GET['action']);
    }
}

$path = 'modules/'.$module.'/'.$action.'.php';

if(file_exists($path)){
    require_once($path);
}else{
    require_once 'modules/error/404.php';
}