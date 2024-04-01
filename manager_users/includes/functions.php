<?php
//chặn người dùng truy cập không hợp lệ
if(!defined('_CODE')){
    die('Access dinied...');
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

//Hàm mail
function SendMail($to, $subject, $content){

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'tranthecong999@gmail.com';                     //SMTP username
    $mail->Password   = 'ywwxiqtdgiqyuoxv';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('tranthecong999@gmail.com', 'The');
    $mail->addAddress($to);     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $content;

    $mail->send();
    return true;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return false;
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