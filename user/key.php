<?php
include '../core/db.config.php';
include '../core/function.php';
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
echo'<div class="head">API Key</div>';
if( $detect->isMobile() && $detect->isTablet() ){
echo $uuus;
}
if (!isset($_SESSION['user_id'])) {
	header('Location: ../');
	exit;
}
$row = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='".$_SESSION['user_id']."'"));
echo "<div class='main'>$api_key :</div>";
if( !$detect->isMobile() && !$detect->isTablet() ){
echo'<input name="old"  maxlength="10" type="text" class="form-control fr-input" id="input-word" autocomplete="off" value="'.ms($row['key']).'"  readonly="readonly" onclick="this.select();"/><br><br>
<div class="main"><a href="../do/api">- '.$about_api.'</a><br>
<a href="index">- '.$head_area.'</a></div>';
} else {
echo "<div class='main'><input type='text' name='old' value='".ms($row['key'])."'/></div>
<div class='menu'><a href='../do/api'><img src='http://ek.vc/designe/img/infow.png' alt='!'> $about_api</a></div><div class='menu'><a href='index'><img src='http://ek.vc/designe/img/backw.png' alt='!'> $head_area</a></div>";
}
include '../core/foot.php';
?>