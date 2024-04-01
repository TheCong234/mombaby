<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}
$data = [
  'pageTitle' => 'Xác thực'
];

layouts('header', $data);
$type = getSession('typeConfirm');

$newUser = getSession('newUser');
$codeConfirm = getSession('codeConfirm');

$created = false;
$error = "";

//xác thực đăng ký và quên mật khẩu
if($type == "register"){
    if(isPost()){
        if((int)$codeConfirm == (int)$_POST['code']){
            if(insert('user', $newUser)){
                removeSession('newUser');
                removeSession('codeConfirm');
                removeSession('typeConfirm');
                $created = true;
            }
        }else{
            $error = "Mã xác thực không đúng, vui lòng kiểm tra lại";
        }
    }
}else if($type == "forgot"){
    if(isPost()){
        if((int)$codeConfirm == (int)$_POST['code']){
            $updateData = [
                'password' => $newUser['password']
            ];
            echo '<pre>';
            print_r($newUser);
            echo '</pre>';
            if(update('user', $updateData, "email = '".$newUser['email']."'")){
                removeSession('newUser');
                removeSession('codeConfirm');
                removeSession('typeConfirm');
                $created = true;
            }else{
                echo 'Update that bai';
            }
        }else{
            $error = "Mã xác thực không đúng, vui lòng kiểm tra lại";
        }
    }
}

?>
<div class="container d-flex flex-column justify-content-center" style="margin-top:80px">
    
    <h1 class="text-center bg-success-subtle py-3">Xác thực tài khoản</h1>
    <form action="" method="post">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="inputPassword6" class="col-form-label">Mã xác thực</label>
            </div>
            <div class="col-auto">
                <input type="number" id="inputPassword6" name="code" class="form-control" aria-describedby="passwordHelpInline">
            </div>
            <div class="col-auto">
                <span id="passwordHelpInline" class="form-text">
                Là chuỗi số được gửi tới email <?php echo $newUser['email'];?>
                </span>
            </div>
        </div>
        <div>
            <?php
                if(!empty($error)){
                    echo '<span class="text-danger fs-4">'.$error.'</span> <br>';
                }
                if(!$created){
                    echo '<button type="submit" class="btn btn-success">Xác thực</button>';
                }else{
                    echo '<span class="text-success fs-4">Đăng ký thành công</span> <br>';
                    echo '<a href="?module=auth&action=login" class="btn btn-primary">Quay lại trang đăng nhập</a>';
                }
            ?>
            
        </div>
    </form>
</div>


<?php
layouts('footer');
?>