<?php
include '../core/db.config.php';
include '../core/function.php';
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
echo'<div class="head">'.$change_pass.'</div>';
if( $detect->isMobile() && $detect->isTablet() ){
echo $uuus;
}
if (!isset($_SESSION['user_id'])) {
	header('Location: ../');
	exit;
}
if (empty($_POST)) {
if( !$detect->isMobile() && !$detect->isTablet() ){
echo'<form action="#" method="post">
<input name="oldpass"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$valid.'"/><br><br>
<input name="pass1"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$new.'"/><br><br>
<input name="pass2"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$retry_new.'" /><br><br>
<button id="submit-button" type="submit" name="save" class="btn btn-primary hi-btn-go navbar-btn">'.$change.'</button></form></div>';
} else {
echo "<div class='main'>$pass_must</div><div class='main'><form action='#' method='post'>";
echo "$valid:<br />
<input type='password' name='oldpass' value='' /><br />";
echo "$new:<br />
<input type='password' name='pass1' value='' /><br />";
echo "$retry_new:<br />
<input type='password' name='pass2' value='' /><br />";
echo "<input type='submit' name='save' value='$change' />";
echo "</form></div>
<div class='menu'><a href='index'><img src='http://ek.vc/designe/img/backw.png' alt='!'> $head_area</a></div>";
}
} else {
$oldpass = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
$oldpass2 = (isset($_POST['oldpass'])) ? ms($_POST['oldpass']) : '';
$pass1 = (isset($_POST['pass1'])) ? ms($_POST['pass1']) : '';
$pass2 = (isset($_POST['pass2'])) ? ms($_POST['pass2']) : '';
$oldpass1 = ms($oldpass2);
$pass11 = ms($pass1);
$pass22 = ms($pass2);
$error = false;
$errort = '';
if ($oldpass['password2'] != $oldpass1) {
$error = true;
$errort .= ''.$error1.'.<br />';
}
if (strlen($pass11) < 6) {
$error = true;
$errort .= ''.$error2.'.<br />';
}
if (strlen($pass22) < 6) {
$error = true;
$errort .= ''.$error2.'.<br />';
}
if ($pass11 != $pass22) {
$error = true;
$errort .= ''.$error3.'.<br />';
}
if (!$error) {
$hashed_password = md5(md5($pass11));
mysqli_query($DB, "UPDATE `users` SET `password` = '{$hashed_password}', `password2` = '{$pass11}' WHERE `id` = '{$_SESSION['user_id']}' LIMIT 1");
echo"<div class='result'>$pass_change</div><div class='menu'><a href='index'>- $head_area</a></div>";
} else {
print '<div class="error"><img border="0" src="../designe/img/error.png" alt="!"> '.$error_email.'<br/>'.$errort.'</div>';
echo'<div class="menu"><a href="?"><img src="http://ek.vc/designe/img/backw.png" alt="!"> '.$retry.'</a></div>';	
}
}
include '../core/foot.php';
?>