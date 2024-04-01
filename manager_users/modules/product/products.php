<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
  'pageTitle' => 'Danh sách sản phẩm'
];
layouts('header', $data);

$products = getRaw("SELECT * FROM products")
?>

<div class="container d-flex flex-column justify-content-center" style="margin-top:80px">
    
    <h1 class="text-center bg-success-subtle py-3">Danh sách sản phẩm</h1>

    <div class="d-flex bg-body-secondary py-3">
        <?php
        if(!empty($products)){
            foreach($products as $product){
                $amount_display = number_format($product['price'], 0, ',', '.') . ' VNĐ';
                echo '<div class="card mx-2" style="width: 18rem;">';
                    echo '<img src="'.$product['image'].'" class="card-img-top" alt="..." height="165px;">';
                    echo '<div class="card-body">';
                        echo '<h5 class="card-title d-inline-block text-truncate" style="max-width: 250px;">'.$product['name'].'</h5>';
                        echo '<p class="card-text" style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">'.$product['description'].'</p>';
                        echo '<p class="card-text text-danger">'.$amount_display.'</p>';
                        echo '<a href="?module=product&action=detail&product-id='.$product['id'].'" class="btn btn-primary">Xem</a>';
                    echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
</div>

<?php
layouts('footer');
?>