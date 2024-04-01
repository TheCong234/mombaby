<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
    'pageTitle' => 'Thống kê doanh thu'
];

layouts('header', $data);
$billsComplete = getRaw("SELECT * FROM bills WHERE status = 1");
$totalComplete = 0;
foreach($billsComplete as $bill){
  $totalComplete += $bill['total'];
}

$billsIncomplete = getRaw("SELECT * FROM bills WHERE status = 0");
$totalIncomplete = 0;
foreach($billsIncomplete as $bill){
  $totalIncomplete += $bill['total'];
}
?>
<div class="container d-flex flex-column justify-content-center" style="margin-top:80px">
    
    <h1 class="text-center bg-success-subtle py-3">Đơn hàng đã hoàn thành</h1>
    <!-- header -->
    <div class="row border overflow-hidden mx-auto shadow bg-body-tertiary rounded py-3 mt-1 w-100" style="border-radius: 8px;">
        
        <div class="col-md fw-bold text-center">Ngày đặt hàng</div>
        <div class="col-md fw-bold text-center">Địa chỉ nhận</div>
        <div class="col-md fw-bold text-center">Tổng tiền</div>

    </div>

    <!-- thông tin đơn đã hoàn thành -->
    <div class="">
        <?php
        if(!empty($billsComplete)){
            foreach($billsComplete as $bill){
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
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
            }
        }else{
            echo '<div class="bg-warning-subtle">Không có đơn hàng đã hoàn thành nào</div>';
        }
        ?>
        <!-- total -->
        <div class="card my-3">
          <div class="card-body d-flex flex-row justify-content-end align-items-center">
              <span class="fs-5">Tổng tiền: </span>
                <?php 
                $amount_display = number_format($totalComplete, 0, ',', '.') . ' VNĐ';
                echo '<span class="text-danger mx-3 fs-5">'.$amount_display.'</span>';
                ?>
              
          </div>
        </div>
    </div>

        <hr>
    <!-- đơn hàng chưa hoàn thành -->
    <h1 class="text-center bg-danger-subtle py-3 mt-3">Đơn hàng chưa hoàn thành</h1>
    <!-- header -->
    <div class="row border overflow-hidden mx-auto shadow bg-body-tertiary rounded py-3 mt-1 w-100" style="border-radius: 8px;">
        
        <div class="col-md fw-bold text-center">Ngày đặt hàng</div>
        <div class="col-md fw-bold text-center">Địa chỉ nhận</div>
        <div class="col-md fw-bold text-center">Tổng tiền</div>

    </div>

    <!-- thông tin đơn chưa hoàn thành -->
    <div class="">
        <?php
        if(!empty($billsIncomplete)){
            foreach($billsIncomplete as $bill){
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
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
            }
        }else{
            echo '<div class="bg-warning-subtle">Không có đơn hàng chưa hoàn thành nào</div>';
        }
        ?>
        <!-- total -->
        <div class="card my-3">
          <div class="card-body d-flex flex-row justify-content-end align-items-center">
              <span class="fs-5">Tổng tiền: </span>
                <?php 
                $amount_display = number_format($totalIncomplete, 0, ',', '.') . ' VNĐ';
                echo '<span class="text-danger mx-3 fs-5">'.$amount_display.'</span>';
                ?>
              
          </div>
        </div>
    </div>

</div>

<?php
layouts('footer');
?>