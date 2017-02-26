<?php
session_start();
require_once "../config/config.php";
include_once "../libs/login/Login.php";
$login = new Login($_POST["email"],$_POST["heslo"]);

if($login->getStatus()) {
	$_SESSION["logged"] = $_POST["email"];
	$login->redirect();
} else {
	header("Location: login.php?status=0");
}