<?php
ob_start();
require_once "../config/config.php";
require_once "../config/authses.php";

$smarty->display("../templates/accounts.tpl");

$Save->account(array ("name", "color"));

ob_end_flush();