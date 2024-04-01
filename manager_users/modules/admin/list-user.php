<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
    'pageTitle' => 'Danh sách người dùng'
];

layouts('header', $data);
$users = getRaw("SELECT * FROM user");
?>

<div class="container d-flex flex-column justify-content-center" style="margin-top:80px">
    <div class="d-flex justify-content-center bg-info-subtle mb-3">
        <h1>Danh sách người dùng</h1>
    </div>

    <!-- header -->
    <div class="row border overflow-hidden mx-auto shadow bg-body-tertiary rounded py-3 mt-1 w-100" style="border-radius: 8px;">
        <div class="col-md fw-bold text-center">Mã người dùng</div>
        <div class="col-md fw-bold text-center">Họ và Tên</div>
        <div class="col-md fw-bold text-center">Ngày sinh</div>
        <div class="col-md fw-bold text-center">Số điện thoại</div>
        <div class="col-md fw-bold text-center">Email</div>
        <div class="col-md fw-bold text-center">Tổng tiền</div>
    </div>

    <!-- danh sách -->
    <?php
    foreach($users as $user){
        $bills = getRaw("SELECT * FROM bills WHERE userid = ".$user['id']);
        $total = 0;
        foreach($bills as $bill){
          $total += $bill['total'];
        }
        echo '<div class="row border overflow-hidden mx-auto shadow bg-body-tertiary rounded py-3 mt-1 w-100" style="border-radius: 8px;">';
        echo '    <div class="card-body">';
        echo '        <div class="row">';

        echo '            <div class="col-md text-center">';
                            echo $user['id'];
        echo '            </div>';

        echo '            <div class="col-md text-center">';
                            echo '<span>'.$user['name'].'</span>';
        echo '            </div>';

        echo '            <div class="col-md text-center">';
        echo '                <span class="text-danger">'.$user['birth'].'</span>';
        echo '            </div>';

        echo '            <div class="col-md text-center">';
        echo '                <span class="text-danger">'.$user['phone'].'</span>';
        echo '            </div>';

        echo '            <div class="col-md text-center">';
        echo '                <span class="text-danger">'.$user['email'].'</span>';
        echo '            </div>';

        echo '            <div class="col-md text-center">';
                              $amount_display = number_format($total, 0, ',', '.') . ' VNĐ';
        echo '                <span class="text-danger">'.$amount_display.'</span>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
      ?>
<?php
layouts('footer');
?>