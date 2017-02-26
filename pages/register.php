<?php
session_start();
require_once "../config/config.php";

$smarty->assign("settings",$settings);
$smarty->display("../templates/register.tpl");

if(isset($_POST["registrovat"])) {
	$options = [
		'cost' => 13,
		'salt' => uniqid(mt_rand(),true)
	];
	$arr = [
		'id' => '',
		'email' => $_POST["email"],
		'salt' => $options["salt"],
		'pass' => password_hash($_POST["pass"], PASSWORD_BCRYPT, $options),
		'fname' => $_POST["fname"],
		'lname' => $_POST["lname"]
	];
	dibi::query('INSERT INTO [users]', $arr);
	header("Location: login.php?status=1");
}