<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
  'pageTitle' => 'Details store'
];
layouts('header', $data);

//mã cửa hàng
$storeId = $_GET['store-id'];

if(isPost()){
    //Thêm sản phẩm vào shop
    $insertData = [
        'storeId' => $storeId,
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'description' => $_POST['description'],
        'inventory' => $_POST['inventory'],
        'image' => $_POST['image']
    ];
    insert('products', $insertData);
}



//chi tiết cửa hàng
$storeDetails = oneRaw('SELECT * FROM stories WHERE id = '.$storeId);

//chủ cửa hàng
$owner = oneRaw('SELECT * FROM user WHERE id = '.$storeDetails['userId']);
    
//sản phầm của cửa hàng
$products = getRaw("SELECT * FROM products WHERE storeId = ".$storeId);

?>
<div class="container d-flex flex-column justify-content-center" style="margin-top:80px">
    <div class="d-flex justify-content-center bg-info-subtle mb-3">
        <h1>Chi tiết cửa hàng</h1>
    </div>
    
    <div class="row bg-secondary-subtle">
        <div class="col-md-6">
            <?php
            echo '<img src="'.$storeDetails['image'].'" class="card-img-top" alt="...">';
            ?>
        </div>

        <div class="col-md-6">
            <div class="">
                <span class="fw-bold fs-4">Mã cửa hàng: </span>
                <?php echo '<span class="p-3 fw-bold fs-4">'.$storeDetails['id'].'</span>'?>
            </div>

            <div class="">
                <span class="fw-bold fs-4">Tên cửa hàng: </span>
                <?php echo '<span class="p-3 fw-bold fs-4">'.$storeDetails['name'].'</span>'?>
            </div>

            <div class="d-flex">
                <span class="fw-bold fs-4" style="width: 163px;">Mô tả: </span>
                <?php echo '<span class="fs-4">'.$storeDetails['description'].'</span>'?>
            </div>

            <div class="">
                <span class="fw-bold fs-4">Ngày tạo: </span>
                <?php echo '<span class="p-3 fw-bold fs-4">'.$storeDetails['createDate'].'</span>'?>
            </div>

            <div class="">
                <span class="fw-bold fs-4">Địa chỉ: </span>
                <?php echo '<span class="p-3 fw-bold fs-4">'.$storeDetails['address'].'</span>'?>
            </div>
            <div class="">
                <span class="fw-bold fs-4">Chủ cửa hàng: </span>
                <?php echo '<span class="p-3 fw-bold fs-4">'.$owner['name'].'</span>'?>
            </div>
            <div class="">
                <button class="btn btn-warning">Chỉnh sửa</button>
            </div>
        </div>

    </div>

    <!-- danh sách sản phẩm của cửa hàng-->
    <div class="my-3">
        <h1>Sản phẩm của shop</h1>
        <div class="d-flex">
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
        }else{
            echo '<div class="text-danger">Cửa hàng của bạn chưa có sản phẩm nào</div>';
        }
        ?>
        </div>
    </div>

    <!-- Thêm sản phẩm -->
    <div class="">
        <h1 class="text-center bg-danger-subtle py-3 mt-3">Thêm sản phẩm</h1>
        <form action="" method="post" class="border p-3">
            <label for="name" class="form-label mt-3">Tên sản phẩm</label>
            <input type="text" id="name" class="form-control" aria-describedby="passwordHelpBlock" name="name">

            <label for="price" class="form-label mt-3">Giá</label>
            <input type="number" id="price" class="form-control" aria-describedby="passwordHelpBlock" name="price">
            
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label mt-3">Mô tả sản phẩm</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
            </div>

            <label for="inventory" class="form-label mt-3">Số lượng sẵn có</label>
            <input type="number" id="price" class="form-control" aria-describedby="passwordHelpBlock" name="inventory">

            <label for="image" class="form-label mt-3">Ảnh sản phẩm</label>
            <input type="text" id="iamge" class="form-control" aria-describedby="passwordHelpBlock" name="image">
            <div id="passwordHelpBlock" class="form-text">
                Là đường dẫn tới ảnh
            </div>
            <div class="text-center">
                <button class="btn btn-warning" type="submit">Thêm</button>
            </div>
        </form>
    </div>
</div>

<?php
layouts('footer');
?>