<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
  'pageTitle' => 'Thanh toán'
];
layouts('header', $data);

$userId = getSession('userId');

//lấy danh sách giỏ hàng theo mã người dùng
$carts = getRaw("SELECT carts.id, productId, products.image, products.name, products.price, quantity FROM carts JOIN products ON carts.productId = products.id WHERE carts.userId = ".$userId);

//tính tổng giỏ hàng
$total = 0;
foreach($carts as $cart){
  $total += ($cart['quantity'] * $cart['price']);
}


if(isPost()){

    $billData = [
        'userId' => $userId,
        'address' => $_POST['address'],
        'total' => $total
    ];
    insert('bills', $billData);

    foreach($carts as $cart){
        $billNew = oneRaw("SELECT * FROM bills WHERE id = (SELECT MAX(id) FROM bills)");
        $billItemsData = [
            'billId' => $billNew['id'],
            'productId' => $cart['productId'],
            'quantity' => $cart['quantity']
        ];
        insert('billitems', $billItemsData);
    }

    delete('carts', 'userId = '.$userId);
}
?>

<form class="d-flex justify-content-center shadow p-5 mb-5 bg-body-tertiary rounded" style="margin-top: 80px;" action="" method="post">
    <div class="box-inner-2">
        <div>
            <p class="fw-bold fs-3 text-success">Xác nhận mua hàng</p>
            <p class="dis mb-3">Vui lòng nhập thông tin đầy đủ trước khi thanh toán</p>
        </div>
        <div>
            <div>
                <span class="dis fw-bold mb-2">Số điện thoại</span>
                <div class="d-flex align-items-center justify-content-between card-atm border rounded">
                    <input type="text" class="form-control" id="phone" name="phone"/>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Vui lòng nhập Số điện của người nhận</div>
                </div>
            </div>
            <div class="my-3 cardname">
                <span class="dis fw-bold mb-2" >Họ và tên người nhận:</span>
                <input class="form-control" type="text" id="fullName" name="fullName"/>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Vui lòng nhập Tên người nhận</div>
            </div>
            <div class="address">
                <span class="dis fw-bold mb-3">Địa chỉ</span>
                <input class="form-control" id="address" name="address" />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Vui lòng nhập Địa chỉ nhận hàng</div>
            </div>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle btn btn-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Thanh toán bằng tiền mặt
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item text-primary" href="#">Tiền mặt</a></li>
                    <li><a class="dropdown-item text-secondary" href="#">Mombaby pay</a></li>
                    <li><a class="dropdown-item text-secondary" href="#">Chuyển khoản</a></li>
                </ul>
            </div>

            <div class="d-flex flex-column dis">
                
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fw-bold"> Tổng tiền cần thanh toán</span>
                    <p class="fw-bold">
                        <?php
                        
                        if(isPost()){
                            echo '<span class="text-danger mx-3 fs-6">0 VNĐ</span>';
                        }else{
                            $amount_display = number_format($total, 0, ',', '.') . ' VNĐ';
                            echo '<span class="text-danger mx-3 fs-6">'.$amount_display.'</span>';
                        }
                        ?>
                    </p>
                </div>
                <div class="d-flex flex-column">
                    <?php
                    if(isPost()){
                        echo '<a class="btn btn-primary mt-2" href="?module=product&action=products">Quay lại mua sắm</a>';
                    }else{
                        echo '<button id="PayButton" type="submit" class="btn btn-warning mt-2">Xác nhận mua hàng</button>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
layouts('footer');
?>