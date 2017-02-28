<?php
require_once "../config/config.php";

/**
 * Status
 * ------
 * 	- 1: New login
 * 	- 0: Error
 * 	- -1: OK
 */
if (isset($_GET["status"]) && ($_GET["status"]) == 0) {
	$smarty->assign("status", 0);
} else {
	if (isset($_GET["status"]) && ($_GET["status"]) == 1) {
		$smarty->assign("status", 1);
	} else {
		$smarty->assign("status", -1);
	}
}

/**
 * Template
 * --------
 */
$smarty->assign("settings", $Settings->getData());
$smarty->display("../templates/login.tpl");

/**
 * Login
 * -----
 */
if(isset($_POST["login"])) {
	include_once "../libs/login/Login.php";
	$Login = new Login($_POST["email"],$_POST["heslo"]);

	if($Login->getStatus()) {
		$_SESSION["logged_email"] = $_POST["email"];
		$_SESSION["logged_id"] = $Login->getLoggedID();
		$Login->redirect();
	} else {
		header("Location: login.php?status=0");
	}
}
