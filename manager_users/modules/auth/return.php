<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
  'pageTitle' => 'Hoàn trả hàng'
];
layouts('header', $data);

$billId = $_GET['billId'];

?>

<div class="container justify-content-center mb-3" style="margin-top:80px">
    
    <h1 class="text-center bg-success-subtle py-3">Hoàn trả hàng</h1>
    <h3 class="text-success text-center">Mã đơn hàng <?php echo $billId ?></h3>
    <h5>Vui lòng cho biết lý do hoàn trả hàng của bạn</h5>
    <textarea class="w-100"></textarea>
    <button class="btn btn-success">Gửi yêu cầu hoàn trả</button>
</div>

<?php
layouts('footer');
?>