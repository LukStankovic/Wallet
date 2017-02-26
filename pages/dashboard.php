<?php
session_start();
require_once "../config/config.php";
require_once "../config/authses.php";
$smarty->assign("settings", $settings);
$smarty->display("../templates/dashboard.tpl");