<?php
if (!defined('_CODE')) {
  die('Access dinied...');
}

$data = [
    'pageTitle' => 'Login'
];

var_dump(isEmail('cong@gmail.com'));
layouts('header', $data);
?>
<div class="container" style="margin-top:80px">


    <h1 class="text-success">Forgot page </h1>
    <form>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">your Pass word</label>
        <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="your pass">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">your Pass word</label>
        <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="your pass">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-success">Submit</button>
        <a href="http://localhost/mombaby/manager_users/?module=auth&action=login">back to Login</a>
    </div>
    </form>
</div>

<?php
layouts('footer', $data);
?>