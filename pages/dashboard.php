<?php
ob_start();
require_once "../config/config.php";
require_once "../config/authses.php";

$smarty->display("../templates/dashboard.tpl");

$Save->moneyRecord(array ("title", "amount", "type", "added"));

ob_end_flush();