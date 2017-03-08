<?php
ob_start();
require_once "../config/config.php";
require_once "../config/authses.php";

$nav = new Navigation;
$smarty->assign("menuitems", $nav->getData());
$smarty->assign("selected", $nav->selected());
$smarty->assign("accounts", $Accounts->getData());
$smarty->assign("settings", $Settings->getData());
$smarty->assign("latestRecords", $Accounts->getLatestRecords(5));
$smarty->display("../templates/dashboard.tpl");

$Save->moneyRecord(array ("title", "amount", "type", "added"));

ob_end_flush();