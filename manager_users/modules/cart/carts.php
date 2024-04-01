<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
  'pageTitle' => 'Giỏ hàng'
];
layouts('header', $data);

$userId = getSession('userId');




//MYSQL
//Thêm sản phẩm vào giỏ hàng nếu url query có product-id
if(!empty($_GET['product-id'])){
  $productId = $_GET['product-id'];

  $cartExits = oneRaw("SELECT * FROM carts WHERE userId = ".$userId.' AND productId = '.$productId);
  //nếu sản phẩm chưa có trong giỏ hàng thì thêm mới vào
  if(empty($cartExits)){
    $insertData = [
        'userId' => $userId,
        'productId' => $productId,
        'quantity' => 1
      ];
    insert('carts', $insertData);
  }else{
    //nếu sản phẩm đã có trong carts thì tăng số lượng lên +1
    $insertData = [
      'quantity' => (int)$cartExits['quantity'] + 1
    ];
    update('carts', $insertData, 'id = '.$cartExits['id']);
  }
  
}

//xóa sản phẩm khỏi giỏ hàng nếu url query có cartId
if(!empty($_GET['cartId']) and empty($_GET['quantity'])){
  $cartId = $_GET['cartId'];
  $deleted = delete('carts', 'id = '.$cartId);
}

//cập nhật số lượng nếu url query có quantity
if(!empty($_GET['quantity'])){
  $quantity = $_GET['quantity'];
  $cartId = $_GET['cartId'];

  echo '<br> <br> <br> <br> <br>'.$cartId;
  $cartUpdate = oneRaw("SELECT * FROM carts WHERE carts.id = ".$cartId);

  if($quantity == 'tang'){
    $updateData = [
      'quantity' => (int)$cartUpdate['quantity'] + 1
    ];
    update('carts', $updateData, 'id = '.$cartId);
  }else{
    if((int)$cartUpdate['quantity'] == 1){
      $deleted = delete('carts', 'id = '.$cartId);
    }else{
      $updateData = [
        'quantity' => (int)$cartUpdate['quantity'] - 1
      ];
      update('carts', $updateData, 'id = '.$cartId);
    }
  }
}

//lấy danh sách giỏ hàng theo mã người dùng
$carts = getRaw("SELECT carts.id, productId, products.image, products.name, products.price, quantity FROM carts JOIN products ON carts.productId = products.id WHERE carts.userId = ".$userId);

//tính tổng giỏ hàng
$total = 0;
foreach($carts as $cart){
  $total += ($cart['quantity'] * $cart['price']);
}
?>
<div class="container d-flex flex-column justify-content-center" style="margin-top:80px">
    <h1 class="text-center bg-success-subtle py-3">Giỏ hàng</h1>

    <!-- header của bảng -->
    <div class="row border  mx-auto shadow bg-body-tertiary rounded py-3 mt-1 w-100" style="border-radius: 8px;">
        <div class="col-1 fw-bold text-center ">Hình ảnh</div>
        <div class="col-11">
            <div class="row">
                <div class="col-md fw-bold text-center">Tên sản phẩm</div>
                <div class="col-md fw-bold text-center">Giá</div>
                <div class="col-md fw-bold text-center">Số lượng</div>
                <div class="col-md fw-bold text-center">Sửa</div>
            </div>
        </div>
    </div>


    <?php 
    if(empty($carts)){
      echo '<div class="d-flex justify-content-center my-3">';
        echo '<span class="text-danger fs-3 fw-bold" >Bạn chưa thêm gì vào giỏ hàng</span>';
      echo '</div>';
    }
    ?>
    
    <!-- cartitems-->
    <?php
    
    foreach($carts as $cart){
      echo '<div class="card w-100 my-3 shadow bg-body-tertiary rounded" style="border-radius: 8px;">';
        echo '<div class="card-body">';
        
          echo '<div class="row">';
              echo '<div class="col-md-1">';
              echo  '<img width="100px" height="100px" src="'.$cart['image'].'" class="img-fluid" alt="Products Cart" >';
              echo '</div>';

              echo '<div class="col-md-11 ">';
              echo '    <div class="row  h-100 d-flex align-items-center">';
              echo '        <div class="col-md h-100 d-flex flex-column justify-content-center align-items-center">';
              echo '          <span class="fw-semibold fs-4 text-center">'.$cart['name'].'</span>';
              echo '        </div>';

              echo '        <div class="col-md h-100 d-flex justify-content-center align-items-center">';
                                $amount_display = number_format($cart['price'], 0, ',', '.') . ' VNĐ';
              echo '            <span class="text-danger fs-4">'.$amount_display.'</span>';
              echo '        </div>';
                            
              echo '        <div class="input-group" style="width: 170px; height:40px;">';
              echo '          <a id="ReduceBtn" class="btn btn-white px-3 border-danger" href="?module=cart&action=carts&quantity=giam&cartId='.$cart['id'].'">-</a>';
              echo '          <span id="QuantityLabel" class="form-control text-center border border-secondary">'.$cart['quantity'].'</span>';
              echo '          <a id="IncreaseBtn" class="btn btn-white px-3 border-success" href="?module=cart&action=carts&quantity=tang&cartId='.$cart['id'].'">+</a>';
              echo '        </div>';

              echo '        <div class="col-md h-100 d-flex justify-content-center align-items-center">';
              echo '            <a id="DeleteBtn" class="btn btn-danger" href="?module=cart&action=carts&cartId='.$cart['id'].'">Xóa</a>';
              echo '        </div>';
                            
              echo '    </div>';
              echo '</div>';
          echo '</div>';
          
      echo '</div>';
  echo '</div>';
}
?>

<!-- total -->
  <div class="card mb-3">
    <div class="card-body d-flex flex-row justify-content-end align-items-center">
        <span class="fs-5">Tổng tiền: </span>
          <?php 
          $amount_display = number_format($total, 0, ',', '.') . ' VNĐ';
          echo '<span class="text-danger mx-3 fs-5">'.$amount_display.'</span>';

          if($total > 0){
            echo '<a class="btn btn-danger" href="?module=cart&action=paid">Mua hàng</a>';
          }
          ?>
        
    </div>
  </div>
</div>


<?php
layouts('footer');
?>