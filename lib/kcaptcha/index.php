<?php
error_reporting (E_ALL);

include('kcaptcha.php');

if(isset($_REQUEST['AgileWeb'])){
	session_id($_REQUEST['AgileWeb']);
	session_start();
}

$captcha = new KCAPTCHA();

if($_REQUEST['AgileWeb']){
	$_SESSION['o']['AgileWeb']['captcha_keystring'] = $captcha->getKeyString();
}