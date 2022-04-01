<?php
require_once '../core/db.config.php';
include_once '../core/function.php';
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
echo'<div class="head">'.$head_area.'</div>';
if( $detect->isMobile() && $detect->isTablet() ){
echo $uuus;
}
if (!isset($_SESSION['user_id'])) {
	header('Location: ../');
	exit;
}
$level = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
if ($level['level'] == 3){echo'<div class="menu"><a href="../schweppes/"><b>Админка</b></a></div>';}
echo $areain;
include '../core/foot.php';
?>