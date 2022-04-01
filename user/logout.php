<?php
session_start();
include '../core/db.config.php';
if (isset($_SESSION['user_id'])) {
	$row = mysqli_fetch_array(mysqli_query($DB, "SELECT `bann` FROM `users` WHERE `id`='{$_SESSION['user_id']}' LIMIT 1"));
		if ($row =='1') {
			header("Location: http://ek.vc/me/ban"); exit; 
		} else {
			if (isset($_GET['logout'])); {
			if (isset($_SESSION['user_id']))
			unset($_SESSION['user_id']);	
			setcookie('login', '', 0, "/");
			setcookie('password', '', 0, "/");
			header('Location: ../?');
			exit;
			}
		}
}
?>