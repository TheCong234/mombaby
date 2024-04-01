<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
  'pageTitle' => 'Thông tin cá nhân'
];
layouts('header', $data);

//xác nhận đã nhận hàng
if(!empty($_GET['confirm'])){
    $billId = $_GET['confirm'];
    $updateData = [
        'status' => 1
    ];
    update('bills', $updateData, 'id = '.$billId);
}

$userId = getSession('userId');
$userInfor = oneRaw("SELECT * FROM user WHERE id = ".$userId);
$bills = getRaw("SELECT * FROM bills WHERE userId = ".$userId);


?>

<div class="container d-flex flex-column justify-content-center" style="margin-top:80px">
    
    <h1 class="text-center bg-success-subtle py-3">Thông tin cá nhân</h1>
    <div class="row bg-body-tertiary">
        <div class="col-md-6 ">
            <img src="https://i.pngimg.me/thumb/f/720/c3f2c592f9.jpg" alt="Ảnh đại diện" class="img-fluid">
        </div>

        <div class="col-md-6 position-relative ">
            <div class="row">
                <div class="col-md fs-4">Mã người dùng:</div>
                <?php echo '<div class="col-md fs-4">'.$userInfor['id'].'</div>'; ?>
            </div>
            <div class="row">
                <div class="col-md fs-4">Họ và Tên:</div>
                <?php echo '<div class="col-md fs-4">'.$userInfor['name'].'</div>'; ?>
            </div>
            <div class="row">
                <div class="col-md fs-4">Ngày sinh:</div>
                <?php echo '<div class="col-md fs-4">'.$userInfor['birth'].'</div>'; ?>
            </div>
            <div class="row">
                <div class="col-md fs-4">Số điện thoại:</div>
                <?php echo '<div class="col-md fs-4">'.$userInfor['phone'].'</div>'; ?>
            </div>
            <div class="row">
                <div class="col-md fs-4">Email:</div>
                <?php echo '<div class="col-md fs-4">'.$userInfor['email'].'</div>'; ?>
            </div>
            <div class="position-absolute " style="bottom:10px;">
                <a class="btn btn-warning" href="">Chỉnh sửa</a>
            </div>
        </div>
    </div>

    <!-- lịch sử đặt hàng -->
    <h1 class="text-center bg-success-subtle py-3 mt-3">Lịch sử đơn hàng</h1>
    <!-- header -->
    <div class="row border overflow-hidden mx-auto shadow bg-body-tertiary rounded py-3 mt-1 w-100" style="border-radius: 8px;">
        
        <div class="col-md fw-bold text-center">Ngày đặt hàng</div>
        <div class="col-md fw-bold text-center">Địa chỉ nhận</div>
        <div class="col-md fw-bold text-center">Tổng tiền</div>
        <div class="col-md fw-bold text-center">Trạng thái</div>
        <div class="col-md fw-bold text-center">Lựa chọn</div>

    </div>
    <div class="">
        <?php
        if(!empty($bills)){
            foreach($bills as $bill){
        echo '<div class="row border overflow-hidden mx-auto shadow bg-body-tertiary rounded py-3 mt-1 w-100" style="border-radius: 8px;">';
        echo '    <div class="card-body">';
        echo '        <div class="row">';

        echo '            <div class="col-md text-center">';
                            echo $bill['createAt'];
        echo '            </div>';

        echo '            <div class="col-md text-center">';
                            echo '<span>'.$bill['address'].'</span>';
        echo '            </div>';

        echo '            <div class="col-md text-center">';
                                $amount_display = number_format($bill['total'], 0, ',', '.') . ' VNĐ';
        echo '                <span class="text-danger">'.$amount_display.'</span>';
        echo '            </div>';

                            if($bill['status'] == 0){
                                echo '<div class="col-md text-center">';
                                    echo '<span class="text-danger">Đang giao hàng</span>';
                                echo'</div>';

                                echo '<div class="col-md text-center">';
                                    echo '<a href="?module=auth&action=profile&confirm='.$bill['id'].'" class="btn btn-warning">Xác nhận đã nhận hàng</a>';
                                echo '</div>';
                            }else{
                                echo '<div class="col-md text-center">';
                                    echo '<span class="text-success">Đã nhận hàng</span>';
                                echo '</div>';
                                    
                                echo '<div class="col-md text-center">';
                                    echo '<a href="?module=auth&action=return&billId='.$bill['id'].'" class="btn btn-danger">Hoàn trả hàng</a>';
                                echo '</div>';
                            }
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
            }
        }else{
            echo '<div class="bg-warning-subtle">Bạn chưa có đơn hàng nào</div>';
        }
        ?>
    </div>
</div>

<?php
layouts('footer');
?>