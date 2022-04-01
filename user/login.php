<?php
include '../core/db.config.php';
include '../core/function.php';
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
echo'<div class="head">'.$head_login.'</div>';
if( $detect->isMobile() && $detect->isTablet() ){
if (isset($_SESSION['user_id'])){echo $uuus;}
else{echo $uuno;};
}
if (isset($_SESSION['user_id']))
{
header('Location: ../');
			exit;
}
if (!empty($_POST)) {
$login = ms($_POST['login']);
$password = ms($_POST['password']);
$sql = mysqli_query($DB, "SELECT * FROM `users` WHERE `login`='{$login}' LIMIT 1");
	if (mysqli_num_rows($sql) == 1) {
		$row = mysqli_fetch_assoc($sql);
		$salt = $row['salt'];
		$password = md5(md5($_POST['password']));
		$sql = mysqli_query($DB, "SELECT `id`,`visit` FROM `users` WHERE `login`='{$login}' AND `password`='{$password}' LIMIT 1");
		if (mysqli_num_rows($sql) == 1) {
			$row = mysqli_fetch_assoc($sql);
			$_SESSION['user_id'] = $row['id'];
			setcookie('login', $login, time()+3600*24*365, "/");
			setcookie('password', $password, time()+3600*24*365, "/");
			header('Location: ../?');
			exit;
		} else {
			echo"</div><div class='error'>$input_error</div><div class='main'>";
		}
	} else {
			echo"</div><div class='error'>$input_error</div><div class='main'>";
	}
}
if( !$detect->isMobile() && !$detect->isTablet() ){
print '
<div class="main"><br>
<form action="#" method="post">
<input name="login"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$enter_login.'"/><br><br>
<input name="password"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$enter_pass.'" /><br><br>
<button id="submit-button" type="submit" class="btn btn-primary hi-btn-go navbar-btn">'.$head_login.'</button></form>
</div><br>
<div class="main"><center><a href="lostpass">'.$forgot_pass.'</a></center></div>';
}else{
print '<form action="#" method="post">
'.$enter_login.':<br/>
<input type="text" name="login" /></div><div class="main">
'.$enter_pass.':<br/>
<input type="password" name="password" /></div><div class="main">
<input type="submit" value="'.$head_login.'" /></form></div>
<div class="menu"><a href="lostpass"><img src="http://ek.vc/designe/img/infow.png" alt="!"> '.$forgot_pass.'</a></div>';
}
include '../core/foot.php';
?>