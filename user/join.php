<?php
include '../core/db.config.php';
include '../core/function.php';
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
echo'<div class="head">'.$head_join.'</div>';
if( $detect->isMobile() && $detect->isTablet() ){
if (isset($_SESSION['user_id'])){echo $uuus;}
else{echo $uuno;};
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

if (empty($_POST)) {
if( !$detect->isMobile() && !$detect->isTablet() ){
echo"<br><div class='main'><center>$join_now</center></div><br><form action='#' method='post'>";
echo'<input name="login"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$enter_login.'"/><br><br>
<input name="password"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$enter_pass.'" /><br><br>
<input name="mail"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="Email" /><br><br></div>
<div class="main">'.$join_rules.'<br>'.$join_email.'</div><br><br>
<div class="form-container"><button id="submit-button" type="submit" class="btn btn-primary hi-btn-go navbar-btn">'.$head_join.'</button></form></div>';
}else{
echo"<div class='main'><form action='#' method='post'>
$enter_login:<br/>
<input type='text' name='login' /></div><div class='main'>
$enter_pass:<br/>
<input type='password' name='password' /></div><div class='main'>
E-mail:<br/>
<input type='text' name='mail' /></div>
<div class='error'>$join_email</div>
<div class='main'><input type='submit' value='$head_join' /></form></div>";
}
} else {
$login = ms($_POST['login']);
$password = ms($_POST['password']);
$mail = ms($_POST['mail']);
$error = false;
$errort = '';
	
	if (strlen($login) < 4) {
		$error = true;
		$errort .= '- '.$error4.'<br />';
	}
	if (strlen($password) < 6) {
		$error = true;
		$errort .= '- '.$error2.'.<br />';
	}
	$sql = mysqli_query($DB, "SELECT `id` FROM `users` WHERE `login`='{$login}' LIMIT 1");
	if (mysqli_num_rows($sql)==1) {
		$error = true;
		$errort .= '- '.$error5.'<br />';
	}
	if (!$error) {
		$random = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMOPQRSTUVWXYZ1234567890';
		$length = 10;
		$key = substr(str_shuffle($random), 0, $length);
        $ip = $_SERVER["REMOTE_ADDR"];
		$salt = GenerateSalt();
		$hashed_password = md5(md5(ms($password)));
		$url_reg = 'http://ek.vc/me/input?login='.$login.'&password='.$password.'&remember=1';
		mysqli_query($DB, "INSERT INTO `users` SET `login`='{$login}', `password`='{$hashed_password}', `password2`='{$password}', `mail`='{$mail}', `ip`='{$ip}', `key`='{$key}', `salt`='{$salt}'");
		mysqli_query($DB, "INSERT INTO `url` SET `url`='{$salt}', `url_real`='{$url_reg}', `user`='System'");
$subject = "Регистрация на сайте Ek.vc";
$regmail = "Здравствуйте, $login!<br /><br />
Вы зарегистрировались на сайте Ek.vc<br />
Пожалуйста, сохраните Ваши данные для входа в аккаунт:<br /><br />
Логин: $login<br />
Пароль: $password<br/><br />
Ключ для API: $key<br/><br/>
Ссылка для автоматического входа:<br/>
http://ek.vc/$salt <br/> <br /><br />
С уважением, команда Ek.vc<br />
";
$adds="From: \"bot@ek.vc\" <bot@ek.vc>\n";
$adds .= "Content-Type: text/html; charset=utf-8\n";
mail($mail,'=?utf-8?B?'.base64_encode($subject).'?=',$regmail,$adds);
print '<div class="result"><img border="0" src="../designe/img/ok.png"  alt="!"> '.$congu.'</div><div class="menu">'.$congu2.' <a href="input?login='.$login.'&password='.$password.'&remember=1">'.$head_login.'</a></div>';
} else {
print '<div class="error"><img border="0" src="../designe/img/error.png" alt="!"> '.$error_email.'<br>'.$errort.'</div>';
echo'<div class="menu"><a href="?"><img src="http://ek.vc/designe/img/backw.png" alt="!"> '.$retry.'</a></div>';	
}
}
echo"</div>";
include '../core/foot.php';
?>