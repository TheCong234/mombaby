<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
    'pageTitle' => 'Quên mật khẩu'
];

layouts('header', $data);

$error = "";
if(isPost()){
    $user = oneRaw("SELECT * FROM user WHERE email = '".$_POST['email']."'");
    if(!empty($user)){
        $codeConfirm = rand(100000, 999999);
        $send = SendMail($_POST['email'], 'Xac thuc doi mat khau cho tai khoan tai Mombaby shop', 'Mã nè: '.$codeConfirm);
        if($send){
            setSession('newUser', $_POST);
            setSession('codeConfirm', $codeConfirm);
            setSession('typeConfirm','forgot');
            redirect('?module=auth&action=confirm');
        }
    }
}
?>
<div class="container" style="margin-top:80px">

    <h1 class="text-success">Quên mật khẩu </h1>
    <form action="" method="post">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Địa chỉ email đã đăng ký</label>
        <input type="email" class="form-control" id="name" placeholder="name@example.com" name="email">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Mật khẩu mới</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nhập lại mật khẩu mới</label>
        <input type="password" class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-success">Nhận mã xác thực qua email</button>
        <br>
        <a href="?module=auth&action=login">Trở lại trang đăng nhập</a>
    </div>
    </form>
</div>

<?php
layouts('footer', $data);
?>