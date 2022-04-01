<?php
include '../core/db.config.php';
include '../core/function.php';
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
echo'<div class="head">'.$head_login.'</div>';
if( $detect->isMobile() && $detect->isTablet() ){
echo $uuno;
}
if (isset($_SESSION['user_id'])) {
	header('Location: ../');
	exit;
}
$login = ms($_GET['login']);
$password = ms($_GET['password']);
$sql = mysqli_query($DB, "SELECT `salt` FROM `users` WHERE `login`='{$login}' LIMIT 1");
	if (mysqli_num_rows($sql) == 1) {
		$password = md5(md5(ms($_GET['password'])));
		$sql = mysqli_query($DB, "SELECT `id`, `visit` FROM `users` WHERE `login`='{$login}' AND `password`='{$password}' LIMIT 1");
		if (mysqli_num_rows($sql) == 1) {
            $row = mysqli_fetch_assoc($sql);
			$_SESSION['user_id'] = $row['id'];
			setcookie('login', $login, time()+3600*24*365, "/");
			setcookie('password', $password, time()+3600*24*365, "/");
			header('Location: ../');
			exit;             
		} else {
				die("<div class='error'>$input_error</div><div class='menu'><a href='http://ek.vc/me/login'><img src='http://ek.vc/designe/img/backw.png' alt='!'> $retry</a></div>");
		}
	} else {
			die("<div class='error'>$input_error</div><div class='menu'><a href='http://ek.vc/me/login'><img src='http://ek.vc/designe/img/backw.png' alt='!'> $retry</a></div>");
	}
include '../core/foot.php';
?>