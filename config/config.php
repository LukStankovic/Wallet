<?php
if(file_exists("../config/dbconnect_overlay.php")) {
	include_once "../config/dbconnect_overlay.php";
} else {
	include_once "../config/dbconnect.php";
}
// WEB SETTINGS
include_once "../libs/settings/Settings.php";
$Settings = new Settings;
$settings = $Settings->data;

// SMARTY
include_once "../libs/smarty/Smarty.class.php";
$smarty = new Smarty;
// SMARTY SETTINGS
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 0;

// TRACY

include_once "../libs/tracy/src/tracy.php";
use Tracy\Debugger;
Debugger::enable();
Debugger::$strictMode = TRUE;