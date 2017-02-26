<?php
session_start();
require_once "../config/config.php";
if (isset($_GET["status"]) && ($_GET["status"]) == 0) {
	$smarty->assign("status", 0);
} else {
	if (isset($_GET["status"]) && ($_GET["status"]) == 1) {
		$smarty->assign("status", 1);
	} else {
		$smarty->assign("status", -1);
	}
}
$smarty->assign("settings", $settings);
$smarty->display("../templates/login.tpl");