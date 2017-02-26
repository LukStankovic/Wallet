<?php
if(!isset($_SESSION["logged"]) || (trim($_SESSION['logged']) == '')) {
	header("location: login.php");
	exit();
}