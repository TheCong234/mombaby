<?php
if (!defined('_CODE')) {
    die('Access dinied...');
}

// $data=[
//     'id' => '3',
//     'name' => 'Thanh Bình',
//     'birth' => '2004-02-02',
//     'phone' => '0125256432',
//     'email' => 'binh@gmail.com',
// ];

// insert('user',$data);

// $data=[
//     'name' => 'Trần Thanh Bình',
//     'birth' => '2004-01-02',
//     'phone' => '0125256439',
//     'email' => 'bin@gmail.com',
// ];

// update('user',$data, 'id=2');

if(isPost()){
    $codeConfirm = rand(100000, 999999);
    $send = SendMail($_POST['email'], 'Xac thuc dang ky tai khoan tai Mombaby shop', 'Mã nè: '.$codeConfirm);
    if($send){
        setSession('newUser', $_POST);
        setSession('codeConfirm', $codeConfirm);
        setSession('typeConfirm', 'register');
        redirect('?module=auth&action=confirm');
    }
    
}

$data=[
    'pageTitle' => 'Đăng ký'
];
layouts('header', $data);
?>
<div class=" d-flex justify-content-center"  style="margin-top: 80px">
<div class="w-50 shadow p-3 mb-5 bg-body-tertiary rounded px-5">

    <h1 class="text-center">Đăng ký tài khoản </h1>
    <form action="" method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="" class="form-label">Họ và Tên</label>
            <input type="text" class="form-control" id="name" placeholder="Nguyễn Văn A" name="name" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="nguyenvana@gmail.com" name="email" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ngày sinh</label>
            <input type="text" class="form-control" id="name" placeholder="2004-02-15" name="birth" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="phone" placeholder="0123456789" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Xác thực mật khẩu</label>
            <input type="password" class="form-control" id="confirmPass"  required>
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-success">Đăng ký</button>
        </div>
        <div>
            <?php
            if(!empty($smg))
                echo $smg
            ?>
            <a href="?module=auth&action=login">Trở lại đăng nhập</a>
        </div>
        
    </form>
</div>
</div>

<?php
layouts('footer');
?>
