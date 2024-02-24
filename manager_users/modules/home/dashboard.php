<?php
if(!defined('_CODE')){
    die('Access dinied...');
}

$data=[
    'pageTitle' => 'Dashboard'
];

layouts('header',$data);
?>

<h2>Dashboard page</h2>
<i class="fa-solid fa-house"></i>

<?php
layouts('footer');
