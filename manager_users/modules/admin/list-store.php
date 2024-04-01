<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
  'pageTitle' => 'List store'
];
layouts('header', $data);


//mysql
$stories = getRaw("SELECT * FROM stories");
?>
<div class="container d-flex flex-column justify-content-center" style="margin-top:80px">

  
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-md">
          <h1>Danh sách cửa hàng</h1>
          <div class="row">
            <?php
              if (!empty($stories)) {
                foreach($stories as $store){
                  echo '<div class="card col-md mx-2" style="width: 18rem;">';
                    echo '<img src="'.$store['image'].'" class="card-img-top" alt="...">';
                    echo '<div class="card-body">';
                      echo '<h5 class="card-title">'.$store['name'].'</h5>';
                      echo '<p class="card-text">'.$store['description'].'</p>';
                      echo '<a href="?module=admin&action=detail-store&store-id='.$store['id'].'" class="btn btn-primary">Xem</a>';
                    echo '</div>';
                  echo '</div>';
                }
              }else{
                echo 'chưa có cửa hàng nào đăng ký';
              }


            ?>

          <div>
        <div>
      </div><!-- /.container-fluid -->
  </section>
  <div>

<?php

layouts('footer', $data);
?>