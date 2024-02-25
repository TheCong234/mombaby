<?php
if(!defined('_CODE')){
    die('Access dinied...');
}

// $data=[
//     'id' => '3',
//     'name' => 'Thanh Bình',
//     'birth' => '2004-02-02',
//     'phone' => '0125256432',
//     'email' => 'binh@gmail.com',
// ];

// insert('user',$data);

// $data=[
//     'name' => 'Trần Thanh Bình',
//     'birth' => '2004-01-02',
//     'phone' => '0125256439',
//     'email' => 'bin@gmail.com',
// ];

// update('user',$data, 'id=2');

layouts('header',$data);
?>

<h2>Register page </h2>

<?php
layouts('footer');