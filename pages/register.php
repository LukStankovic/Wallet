<?php
require_once "../config/config.php";

$smarty->assign("settings",$Settings->getData());
$smarty->display("../templates/register.tpl");

$Save->register(array("email","pass","fnam","lname"));