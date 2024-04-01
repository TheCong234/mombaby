<?php
if(!defined('_CODE')){
    die('Access dinied...');
}

$logged = getSession('logged');
$userId = getSession('userId');
$store = oneRaw("SELECT * FROM stories WHERE userId = ".$userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['pageTitle'])? $data['pageTitle'] : 'Quản lý người dùng'?></title>
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES?>/css/style.css?ver=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top mb-5">
  <div class="container-fluid">
    <a class="navbar-brand badge text-bg-warning text-wrap fs-3" href="#">Mombaby</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active border border-success rounded" aria-current="page" href="?module=product&action=products"><i class="fa-brands fa-product-hunt pe-1"></i>Sản phẩm</a>
        </li>
        <?php
          if(!empty($logged) and empty($store)){
            echo '<a class="nav-link border border-success p-1 mx-2 rounded" href="?module=owner&action=register"><i class="fa-brands fa-sellsy me-1"></i>Đăng ký bán hàng</a>';
          }
        ?>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Danh mục
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Danh sách cửa hàng</a></li>
            <li><a class="dropdown-item" href="#">Thống kê</a></li>
            <li><a class="dropdown-item" href="#">Danh sách người dùng</a></li>
          </ul>
        </li> -->
      </ul>
      <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
      <?php
          

          if(empty($logged)){
              echo '<a class="nav-link border border-success p-1 mx-2 rounded" href="?module=auth&action=regiter"><i class="fa-solid fa-registered me-1"></i>Đăng ký</a>';
              echo '<a class="nav-link border border-success p-1 mx-2 rounded" href="?module=auth&action=login"><i class="fa-solid fa-right-to-bracket me-1"></i>Đăng nhập</a>';
          }
          else if(!empty($logged)){
            if($logged == 'admin'){
              echo '<a class="nav-link border border-success p-1 mx-2 rounded" href="?module=admin&action=index"><i class="fa-solid fa-list-check me-1"></i>Quản lý</a>';
            }
            if(!empty($store)){
              echo '<a class="nav-link border border-success p-1 mx-2 rounded" href="?module=owner&action=home&store-id='.$store['id'].'">My Store</a>';
            }
            echo '<a class="nav-link border border-success p-1 mx-2 rounded" href="?module=auth&action=profile"><i class="fa-solid fa-user me-1"></i>'.$logged.'</a>';
            echo '<a class="nav-link border border-danger p-1 mx-2 rounded" href="?module=cart&action=carts"><i class="fa-solid fa-cart-shopping me-1"></i>Giỏ hàng</a>';
            echo '<a class="nav-link border border-danger p-1 mx-2 rounded" href="?module=auth&action=logout"><i class="fa-solid fa-right-from-bracket me-1"></i>Đăng xuất</a>';
          }

          
          ?>
    </div>
  </div>
</nav>
    
