<?
include '../core/db.config.php';
include '../core/function.php';
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
echo'<div class="head">'.$password_reset.'</div>';
if( $detect->isMobile() && $detect->isTablet() ){
echo $uuno;
}
if (isset($_SESSION['user_id'])) {
	header('Location: ../');
	exit;
}
function GenerateSalt($n=3) {
	$key1 = '';
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
	$counter = strlen($pattern)-1;
	for($i=0; $i<$n; $i++) {
		$key1 .= $pattern{rand(0,$counter)};
	}
	return $key1;
}
function passgen($k_simb=8, $types=3) {
$password="";
$small="abcdefghijklmnopqrstuvwxyz";
$large="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$numbers="1234567890";
mt_srand((double)microtime()*1000000); 
for ($i=0; $i<$k_simb; $i++) { 
$type=mt_rand(1,min($types,3));
switch ($type) {
case 3:
$password.=$large[mt_rand(0,25)];
break;
case 2:
$password.=$small[mt_rand(0,25)];
break;
case 1:
$password.=$numbers[mt_rand(0,9)];
break;
}
}
return $password;
}
$passgen=passgen();
function strlen2($str) {
$rus=array('й','ц','у','к','е','н','г','ш','щ','з','х','ъ','ф','ы','в','а','п','р','о','л','д','ж','э','я','ч','с','м','и','т','ь','б','ю','Й','Ц','У','К','Е','Н','Г','Ш','Щ','З','Х','Ъ','Ф','Ы','В','А','П','Р','О','Л','Д','Ж','Э','Я','Ч','С','М','И','Т','Ь','Б','Ю');
return strlen(str_replace($rus, '0', $str));
}
if (isset($_POST['nick']) && isset($_POST['mail']) && $_POST['nick']!=NULL && $_POST['mail']!=NULL) {
if (mysqli_num_rows(mysqli_query($DB, "SELECT COUNT(*) FROM `users` WHERE `login` = '".ms($_POST['nick'])."'")) == 0) {
echo "<div class='error'>$no_user</div>";
} elseif (mysqli_num_rows(mysqli_query($DB, "SELECT COUNT(*) FROM `users` WHERE `login` = '".ms($_POST['nick'])."' AND `mail` = '".ms($_POST['mail'])."'"))==0) {
echo'<div class="error">'.$no_email.'</div>';
} else {
$salt = GenerateSalt();
$user2 = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `users` WHERE `login` = '".ms($_POST['nick'])."' LIMIT 1"));
$new_sess=substr(md5(md5(passgen())), 0, 20);
$url_reg = 'http://ek.vc/me/lostpass?id='.$user2['id'].'&set_new='.$new_sess.'';
mysqli_query($DB, "INSERT INTO `url` SET `url`='{$salt}', `url_real`='{$url_reg}', `user`='System'");
$subject = "Восстановление пароля";
$regmail = "Здравствуйте, $user2[login]!<br />
Вы активировали восстановление пароля на сайте http://ek.vc<br />
Для установки нового пароля перейдите по ссылке:<br />
<a href='http://$_SERVER[HTTP_HOST]/$salt'>http://$_SERVER[HTTP_HOST]/$salt</a><br />
С уважением, администрация сайта Ek.vc<br />";
$adds="From: \"support@$_SERVER[HTTP_HOST]\" <support@$_SERVER[HTTP_HOST]>\n";
$adds .= "Content-Type: text/html; charset=utf-8\n";
mail($user2['mail'],'=?utf-8?B?'.base64_encode($subject).'?=',$regmail,$adds);
mysqli_query($DB, "UPDATE `users` SET `sess` = '$new_sess' WHERE `id` = '$user2[id]' LIMIT 1");
echo"<div class='result'>$reset_link ".ms($user2['mail'])."</div>";
}
}
if (isset($_GET['id']) && isset($_GET['set_new']) && strlen($_GET['set_new'])==20 && mysqli_num_rows(mysqli_query($DB, "SELECT COUNT(*) FROM `users` WHERE `id` = '".intval($_GET['id'])."' AND `sess` = '".$_GET['set_new']."'"))==1) {
$user2 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM `users` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1"));
if (empty($_POST['pass1']) && empty($_POST['pass2'])) {
echo'<div class="error">'.$all_polya.'</div>';
} else {
if (isset($_POST['pass1']) && isset($_POST['pass2'])) {
if (($_POST['pass1'])!== ($_POST['pass2'])) {
echo'<div class="error">'.$error3.'</div>';
} else {
$hashed_password = md5(md5($_POST['pass1']));
setcookie('id_user', $user2['id'], time()+60*60*24*365);
mysqli_query($DB, "UPDATE `users` SET `password` = '".ms($hashed_password)."', `password2` = '".ms($_POST['pass1'])."' WHERE `id` = '$user2[id]' LIMIT 1");
setcookie('password', ms($_POST['pass1']),$user2['id'], time()+60*60*24*365);
echo"</div><div class='result'>'.$pass_change.'</div>";
}
}
}
echo'<div class="main">';
if( !$detect->isMobile() && !$detect->isTablet() ){
echo'<form action="lostpass?id='.$user2['id'].'&amp;set_new='.ms($_GET['set_new']).'&amp;'.$passgen.'" method="post">
<input name="pass1"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$new.'"/><br><br>
<input name="pass2"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$retry_new.'" /><br><br>
<button id="submit-button" type="submit" name="save" class="btn btn-primary hi-btn-go navbar-btn">'.$change.'</button></form></div>';
} else {
echo "<form action='lostpass?id=$user2[id]&amp;set_new=".ms($_GET['set_new'])."&amp;$passgen' method=\"post\">\n";
echo "$new:<br />\n<input type='password' name='pass1' value='' /><br />\n";
echo "$retry_new:<br />\n<input type='password' name='pass2' value='' /><br />\n";
echo "<input type='submit' name='save' value='$change' />\n";
echo "</form></div>\n";
}
} else {
if( !$detect->isMobile() && !$detect->isTablet() ){
echo'<div class="main"><form action="?'.$passgen.'" method="post">
<input name="nick"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$enter_login.'"/><br><br>
<input name="mail"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="Email" /><br><br>
<button id="submit-button" type="submit" name="save" class="btn btn-primary hi-btn-go navbar-btn">'.$next.'</button></form>';
echo "</div><div class='main'>$next_go<br />\n";
echo "$next_no</div>\n";
} else {
echo "<div class='main'><form action=\"?$passgen\" method=\"post\">\n";
echo "$enter_login:<br />\n";
echo "<input type=\"text\" name=\"nick\" title=\"$enter_login\" value=\"\" maxlength=\"32\" size=\"16\" /><br />\n";
echo "E-mail:<br />\n";
echo "<input type=\"text\" name=\"mail\" title=\"E-mail\" value=\"\" maxlength=\"32\" size=\"16\" /><br />\n";
echo "<input type=\"submit\" value=\"$next\" title=\"$next\" />";
echo "</form></div><div class='main'>\n";
echo "$next_go<br />\n";
echo "$next_no</div></div>\n";
}
}
include '../core/foot.php';
?>