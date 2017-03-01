<?php
ob_start();
require_once "../config/config.php";
require_once "../config/authses.php";

$smarty->assign("menuitems", $Navigation->getData());
$smarty->assign("selected", $Navigation->selected());
$smarty->assign("allcur", $Currencies->getData());
$smarty->assign("accounts", $Accounts->getData());
$smarty->assign("settings", $Settings->getData());
$smarty->display("../templates/accounts.tpl");

$Save->account(array ("name", "color"));

ob_end_flush();