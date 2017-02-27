<?php
/*
 * Database connect
 * ================
 *  - create ../config/dbconnect_overlay.php for developing
 */
if(file_exists("../config/dbconnect_overlay.php")) {
	include_once "../config/dbconnect_overlay.php";
} else {
	include_once "../config/dbconnect.php";
}

/*
 * Application settings
 * ====================
 * 	- data from table settings in the database
 */
include_once "../libs/settings/Settings.php";
$Settings = new Settings;
$settings = $Settings->data;

/*
 * Navigation
 * ==========
 *
 */
require_once "../libs/classes/navigation/Navigation.php";
$Navigation = new Navigation;


// SAVE LIB
require_once "../libs/save/Save.php";
$save = new Save;

// CLASSES
require_once "../libs/classes/currecnies/Currencies.php";
require_once "../libs/classes/accounts/Accounts.php";
$Currencies = new Currencies;

$Accounts = new Accounts;


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
Debugger::DEVELOPMENT;
Debugger::$strictMode = TRUE;