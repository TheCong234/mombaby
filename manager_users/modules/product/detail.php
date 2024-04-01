<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
  'pageTitle' => 'Chi tiết sản phẩm'
];
layouts('header', $data);

$productId = $_GET['product-id'];
$productDetails = oneRaw("SELECT * FROM products WHERE id = ".$productId);
$store = oneRaw("SELECT * FROM stories WHERE id = ".$productDetails['storeId']);
?>

<div class="container d-flex flex-column justify-content-center" style="margin-top:80px">
    <h1 class="text-center bg-primary-subtle fw-bold py-1">Chi tiết sản phẩm</h1>

    <div class="row bg-secondary-subtle my-2 position-relative">
        <div class="col-md-6">
            <?php
            echo '<img src="'.$productDetails['image'].'" class="card-img-top" alt="...">';
            ?>
        </div>

        <div class="col-md-6">
            <div class="">
                <span class="fw-bold fs-4">Mã sản phẩm: </span>
                <?php echo '<span class="p-3 fw-bold fs-4">'.$productDetails['id'].'</span>'?>
            </div>

            <div class="">
                <span class="fw-bold fs-4">Tên sản phẩm: </span>
                <?php echo '<span class="p-3 fw-bold fs-4">'.$productDetails['name'].'</span>'?>
            </div>

            <div class="d-flex">
                <span class="fw-bold fs-4" style="width: 163px;">Mô tả: </span>
                <?php echo '<span class="fs-4">'.$productDetails['description'].'</span>'?>
            </div>

            <div class="">
                <span class="fw-bold fs-4">Giá: </span>
                <?php 
                $amount_display = number_format($productDetails['price'], 0, ',', '.') . ' VNĐ';
                echo '<span class="p-3 fw-bold fs-4 text-danger">'.$amount_display.'</span>'?>
            </div>

            <div class="">
                <span class="fw-bold fs-4">Tên cửa hàng: </span>
                <?php echo '<span class="p-3 fw-bold fs-4">'.$store['name'].'</span>'?>
            </div>
            <div class="">
                <span class="fw-bold fs-4">Số lượng tồn: </span>
                <?php echo '<span class="p-3 fw-bold fs-4">'.$productDetails['inventory'].'</span>'?>
            </div>
            <div class="position-absolute" style="bottom: 10px;">
                <a href="" class="btn btn-success">Mua</a>
                <?php echo '<a href="?module=cart&action=carts&product-id='.$productDetails['id'].'" class="btn btn-secondary">Thêm vào giỏ hàng</a>'?>
                
            </div>
        </div>

        
</div>


<?php
layouts('footer');
?>