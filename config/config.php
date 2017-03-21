<?php
session_start();

/**
 * DATABASE CONNECT
 * ================
 *  - create ../config/dbconnect_overlay.php for developing
 */
if(file_exists("../config/dbconnect_overlay.php")) {
	include_once "../config/dbconnect_overlay.php";
} else {
	include_once "../config/dbconnect.php";
}

/**
 * CLASSES
 * =======
 */
	/**
	 * Navigation
	 * ----------
	 */
	require_once "../libs/classes/navigation/Navigation.php";
	$Navigation = new Navigation;

	/**
	 * Currencies
	 * ----------
	 */
	require_once "../libs/classes/currecnies/Currencies.php";
	$Currencies = new Currencies;

	/**
	 * Accounts
	 * --------
	 */
	require_once "../libs/classes/accounts/Accounts.php";
	$Accounts = new Accounts;

	/**
	 * Users
	 * -----
	 */
	require_once "../libs/classes/users/Users.php";
	$Users = new Users;

	/**
	 * Categories
	 * ----------
	 */
	require_once "../libs/classes/categories/Categories.php";
	$Categories = new Categories;

/**
 * LIBRARIES
 * =========
 */
	/**
	 * Application settings
	 * --------------------
	 * 	- data from table settings in the database
	 */
	include_once "../libs/settings/Settings.php";
	$Settings = new Settings;

	/**
	 * Save library
	 * ------------
	 * 	- library for saving POST data into database
	 */
	require_once "../libs/save/Save.php";
	$Save = new Save;

	/**
	 * Smarty
	 * ------
	 * 	- template library
	 */
	include_once "../libs/smarty/Smarty.class.php";
	$smarty = new Smarty;

	$smarty->debugging = false;
	$smarty->caching = false;
	$smarty->cache_lifetime = 0;

	$smarty->assign("menuitems", $Navigation->getData());
	$smarty->assign("selected", $Navigation->selected());
	$smarty->assign("allcur", $Currencies->getData());
	$smarty->assign("accounts", $Accounts->getData());
	$smarty->assign("settings", $Settings->getData());
	$smarty->assign("categories", $Categories->getAllCategories());
	$smarty->assign("users", $Users->getAllUsers());
	$smarty->assign("latestRecords", $Accounts->getLatestRecords($Users->getLoggedUser()));

	/**
	 * Tracy
	 * -----
	 * 	- PHP debugger
	 */
	include_once "../libs/tracy/src/tracy.php";
	use Tracy\Debugger;

	Debugger::enable();
	Debugger::DEVELOPMENT;
	Debugger::$strictMode = TRUE;
