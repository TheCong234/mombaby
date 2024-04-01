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
echo 'hahahah';
if(isPost()){
    if(insert('user', $_POST)){
        $smg = "Đăng ký thành công";
    }else{
        $smg = "Lỗi, vui lòng thử lại sau";
    }
}

$data=[
    'pageTitle' => 'Đăng ký'
];
layouts('header', $data);
?>
<div class="container" style="margin-top: 80px">


    <h2>Đăng ký tài khoản </h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="" class="form-label">Họ và Tên</label>
            <input type="text" class="form-control" id="name" placeholder="Nguyễn Văn A" name="name">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="nguyenvana@gmail.com" name="email">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="phone" placeholder="0123456789" name="phone">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Xác thực mật khẩu</label>
            <input type="password" class="form-control" id="confirmPass" >
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">Submit</button>
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

<?php
layouts('footer');
