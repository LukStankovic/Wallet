<?php
session_start();
require_once "../config/config.php";
require_once "../config/authses.php";


$smarty->assign("menuitems", $nav->getData());
$smarty->assign("selected", $nav->selected());
$smarty->assign("allcur", $cur->getData());
$smarty->assign("accounts", $acc->getData());
$smarty->assign("settings", $settings);
$smarty->display("../templates/accounts.tpl");

$save->saveAccount(array("name"));