<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

if(isPost()){
  $filterAll = filter();

  $email = $filterAll['email'];
  $password = $filterAll['password'];

  $userQuery = oneRaw("SELECT * FROM user WHERE email = '$email'");
  if(empty($userQuery)){
    $smg = 'Email chưa đăng ký';
  }else if($userQuery['password'] != $password){
    $smg = 'Mật khẩu không đúng';
  }else if($userQuery['password'] == $password){
    $smg = 'Mật khẩu đúng';
    setSession('userId', $userQuery['id']);
    if($email == 'cong@gmail.com'){
      setSession('logged', 'admin');
      redirect('?module=admin&action=index');
    }else{
      setSession('logged', $userQuery['name']);
      redirect('?module=product&action=products');
    }
    
  }else{
    $smg = 'Thông tin tài khoản không đúng';
  }
}

$data = [
  'pageTitle' => 'Login'
];

layouts('header', $data);
?>

<div class=" d-flex justify-content-center" style="margin-top:80px;">
<div class="w-50 shadow p-3 mb-5 bg-body-tertiary rounded px-5">

  <h1 class="text-success text-center">Đăng nhập</h1>
  <form action="" method="post" class="needs-validation" novalidate>
    <div class="mb-3">
      <label for="" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
    </div>
    <div class="mb-3">
      <label for="" class="form-label">Mật khẩu</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required>
    </div>
    <div class="mb-3 text-center">
      <?php 
      if(!empty($smg))
        echo $smg.'<br>';
      ?>
      <button type="submit" class="btn btn-success mb-3">Đăng nhập</button><br>
      <a href="?module=auth&action=forgot">Quên mật khẩu</a>
    </div>
  </form>
</div>
</div>

<?php
layouts('footer', $data);
?>