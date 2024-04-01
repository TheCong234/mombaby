<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
    'pageTitle' => 'Danh sách người dùng'
];


$userId = getSession('userId');
if(isPost()){

    $insertData = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'address' => $_POST['address'],
        'userId' => $userId,
        'image' => $_POST['image']
    ];
    insert('stories', $insertData);
    redirect('?module=owner&action=home');
}

layouts('header', $data);
?>

<div class="container d-flex flex-column justify-content-center" style="margin-top:80px">
    <div class="d-flex justify-content-center bg-info-subtle mb-3">
        <h1>Đăng ký bán hàng</h1>
    </div>

    <form action="" method="post" class="border p-3">
        <label for="name" class="form-label mt-3">Tên cửa hàng</label>
        <input type="text" id="name" class="form-control" aria-describedby="passwordHelpBlock" name="name">

        <label for="description" class="form-label mt-3">Mô tả cửa hàng</label>
        <input type="text" id="description" class="form-control" aria-describedby="passwordHelpBlock" name="description">
        
        <div class="mb-3">
            <label for="address" class="form-label mt-3">Địa chỉ cửa hàng</label>
            <textarea class="form-control" id="address" rows="3" name="address"></textarea>
        </div>

        <label for="image" class="form-label mt-3">Ảnh cửa hàng</label>
        <input type="text" id="iamge" class="form-control" aria-describedby="passwordHelpBlock" name="image">
        <div id="passwordHelpBlock" class="form-text">
            Là đường dẫn tới ảnh của cửa hàng
        </div>
        <div class="text-center">
            <button class="btn btn-warning" type="submit">Đăng ký cửa hàng</button>
        </div>
    </form>
    
</div>

<?php
layouts('footer');
?>