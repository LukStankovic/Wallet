<?php
if((!isset($_SESSION["logged_email"]) || (trim($_SESSION['logged_email']) == '')) &&
	(!isset($_SESSION["logged_id"]) || (trim($_SESSION['logged_id']) == ''))) {
	header("location: login.php");
	exit();
}