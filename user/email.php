<?php
include '../core/db.config.php';
include '../core/function.php';
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
echo'<div class="head">'.$change_email.'</div>';
if( $detect->isMobile() && $detect->isTablet() ){
echo $uuus;
}
if (!isset($_SESSION['user_id'])) {
	header('Location: ../');
	exit;
}
if (empty($_POST)) { 
$mail = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
if( !$detect->isMobile() && !$detect->isTablet() ){
echo'<div class="main"><form action="#" method="post">
<input name="old"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$mail['mail'].'"  disabled="disabled"/><br><br>
<input name="new"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$new_email.'" /><br><br>
<button id="submit-button" type="submit" name="save" class="btn btn-primary hi-btn-go navbar-btn">Изменить</button></form></div><br/>';
} else {
echo "<div class='main'><form action='#' method='post'>";
echo "$old_email:<br />
<input type='text' name='old' value='".$mail['mail']."' disabled='disabled'/><br />";
echo "$new_email:<br />
<input type='text' name='new' value='' /><br />";
echo "<input type='submit' name='save' value='$change_email' />";
echo "</form></div>";
}
echo"<div class='menu'><a href='index'><img src='http://ek.vc/designe/img/backw.png' alt='!'> $head_area</a></div>";
} else {
$old1 = (isset($_POST['new'])) ? ms($_POST['new']) : '';
$old11 = ms($old1);
$error = false;
$errort = '';
if (strlen($old11) < 5) {
$error = true;
$errort .= ''.$correct_email.'<br />';
}
if (!$error) {
mysqli_query($DB, "UPDATE `users` SET `mail` = '{$old11}' WHERE `id` = '{$_SESSION['user_id']}' LIMIT 1");
echo"<div class='result'><img border='0' src='../designe/img/ok.png' alt='!'>$email_ok</div><div class='menu'><a href='index'>- $head_area</a></div>";
} else {
print '<div class="error"><img border="0" src="../designe/img/error.png" alt="!"> '.$error_email.'<br/>'.$errort.'</div>';
echo'<div class="menu"><a href="?"><img src="http://ek.vc/designe/img/backw.png" alt="!"> '.$retry.'</a></div>';	
}
}
include '../core/foot.php';
?>