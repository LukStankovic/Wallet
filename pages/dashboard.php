<?php
require_once "../config/config.php";
require_once "../config/authses.php";

$nav = new Navigation;
$smarty->assign("menuitems", $nav->getData());
$smarty->assign("selected", $nav->selected());
$smarty->assign("settings", $Settings->getData());
$smarty->display("../templates/dashboard.tpl");