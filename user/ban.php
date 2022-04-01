<?php
session_start();
include '../core/db.config.php';
include '../core/function.php';
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
if(empty($_COOKIE['lang'])) {
setcookie('lang', 'russian', time() + 1296000, '/', '.'. $_SERVER['HTTP_HOST']);
header('Location: /');
exit;
} else {
$lang = ms($_COOKIE['lang']);
}
include '../core/lang.'.$lang.'.php';
if (isset($_SESSION['user_id'])) {
	$welcome = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM `users` WHERE `id`='{$_SESSION['user_id']}'"));
	$bann = $welcome['bann'];
		if ($bann != 1) {
			header("Location: http://ek.vc");
			exit;
		}
} else {
	header("Location: http://ek.vc");
	exit;
}
if( !$detect->isMobile() && !$detect->isTablet() ){
echo'<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Cache-Control" content="cache" />
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
<meta name="copyright" content="ek.vc" />
<meta name="description" content="сервис коротких ссылок" />
<meta name="keywords" content="short url, cute url, short, cute, короткие ссылки, короткие" />
<title>'.$title.'</title>
<link href="http://ek.vc/designe/favicon.ico" rel="shortcut icon"/>
<link rel="stylesheet" href="http://ek.vc/designe/bootstrap.css">
<link rel="stylesheet" href="http://ek.vc/designe/app.css">';
echo'<div class="container">
		<div class="row1">
			<div class="col-lg-2">
			</div>
			<div class="col-lg-8 hi_title">
				ek.vc
			</div>
		</div>
<div class="head">
<br><br><img border="0" src="../designe/img/error.png" alt="!"> <font color="red">'.$ban.'</b></font></a></div>
<br><br><br><div class="main"><center>&copy; 2014 Сервис коротких ссылок <a href="http://ek.vc/" title="">Ek.vc</a></center></div>';
}else{
echo'<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Cache-Control" content="cache" />
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
<meta name="copyright" content="ek.vc" />
<meta name="description" content="сервис коротких ссылок" />
<meta name="keywords" content="short url, cute url, short, cute, короткие ссылки, короткие" />
<link href="../designe/style.css" rel="stylesheet" type="text/css"/>
<link href="../designe/favicon.ico" rel="shortcut icon"/>
<title>'.$title.'</title>
</head><body>';
echo'<div class="head">'.$ban.'</b></a></div>';
echo'<div class="head">(c) Ek.vc, 2014</div>
<a href="http://waplog.net/c.shtml?567960"><img src="http://c.waplog.net/567960.cnt" alt="waplog" /></a>
<a href="http://waptut.ru/in.go?id=10106"><img src="http://c.waptut.ru/10106/small.png" alt="Waptut" /></a>
</body>
</html>';
}
?>