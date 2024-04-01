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

<div class="container d-flex flex-column justify-content-center" style="margin-top:80px">


  <h1 class="text-success" style="width: 220px;">Đăng nhập</h1>
  <form action="" method="post">
    <div class="mb-3">
      <label for="" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
    </div>
    <div class="mb-3">
      <label for="" class="form-label">Mật khẩu</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
    </div>
    <div class="mb-3">
      <?php 
      if(!empty($smg))
        echo $smg.'<br>';
      ?>
      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </form>
</div>
<?php
layouts('footer', $data);
?>