<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
    'pageTitle' => 'Admin index'
];

layouts('header', $data);

?>
<div class="container d-flex flex-column justify-content-center" style="margin-top:80px">
    <div class="card d-flex flex-column justify-content-center">
        <div class="card-header">
          Admin
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><a href="?module=admin&action=list-store">Danh sách cửa hàng</a></li>
          <li class="list-group-item"><a href="?module=admin&action=list-user">Danh sách người dùng</a></li>
          <li class="list-group-item"><a href="?module=product&action=products">Danh sách sản phẩm</a></li>
          <li class="list-group-item"><a href="?module=admin&action=statistics">Thống kê doanh thu</a></li>
          
          
        </ul>
    </div>
</div>

<?php
layouts('footer');
?>