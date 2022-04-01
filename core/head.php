<?php
session_start();
if(empty($_COOKIE['lang'])) {
$lang = 'russian';
} else {
$lang = ms($_COOKIE['lang']);
}
include 'lang.'.$lang.'.php';
if (!isset($_SESSION['id'])) {
	if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
		$result = mysqli_query($DB, "SELECT id FROM users WHERE login='".ms($_COOKIE['login'])."' AND password='".ms($_COOKIE['password'])."' LIMIT 1");
		if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
			$_SESSION['user_id'] = $row['id'];
		}
	}
}
if (isset($_SESSION['user_id'])) {
  $ban = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
  $bann = $ban['bann'];
    if ($bann == 1) { 
	header("Location: http://yunusov.me/projects/shortlinks_2014/me/ban"); 
	exit; 
  }
}
if( !$detect->isMobile() && !$detect->isTablet() ){
echo'<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="Ek.vc - сервис коротких ссылок. Сокращение длинных ссылок. Мы делаем длинные ссылки короткими. Запоминай ссылку по идентификатору. Бесплатно и навечно. Скрытие ссылок. Short link service" />
<meta name="keywords" content="каталог, сервис, сокращение, сокращение ссылок, короткие ссылки, ссылки, бесплатно, адрес, веб-сервис, короткий, короткие, texting, генератор коротких ссылок, зашифрованные ссылки, ek, ek.vc" />
<title>'.$title.'</title>
<link rel="shortcut icon" href="http://yunusov.me/projects/shortlinks_2014/designe/favicon.ico"/>
<link rel="stylesheet" href="http://yunusov.me/projects/shortlinks_2014/designe/bootstrap.css">
<link rel="stylesheet" href="http://yunusov.me/projects/shortlinks_2014/designe/bootlegs.css">
<link rel="stylesheet" href="http://yunusov.me/projects/shortlinks_2014/designe/app.css">
</head><body>
<div class="container">
		<div class="row1">
			<div class="col-lg-2"></div>
			<div class="col-lg-8 hi_title">
				<a href="http://yunusov.me/projects/shortlinks_2014/">ek.vc</a>
			</div>
		</div>
<div style="text-align:center"><div class="hi_text3"><a href="http://yunusov.me/projects/shortlinks_2014/"><b>'.$head_short.'</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
if (isset($_SESSION['user_id']))
	{
		$touser = $DB->query("SELECT login FROM users WHERE id='".$_SESSION['user_id']."'' LIMIT 1");
		$user=$touser['login'];
		echo'<a href="http://yunusov.me/projects/shortlinks_2014/me/index">'.$head_area.'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://yunusov.me/projects/shortlinks_2014/me/logout">'.$head_logout.'</a>';
	} else {
		echo'<a href="http://yunusov.me/projects/shortlinks_2014/me/login">'.$head_login.'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://yunusov.me/projects/shortlinks_2014/me/join">'.$head_join.'</a>';
	}
echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://yunusov.me/projects/shortlinks_2014/do/api">API</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://yunusov.me/projects/shortlinks_2014/do/feedback">'.$head_feedback.'</a></div></div>';
} else {
echo'<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Cache-Control" content="cache" />
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
<meta name="copyright" content="ek.vc" />
<meta name="description" content="Ek.vc - сервис коротких ссылок. Сокращение длинных ссылок. Мы делаем длинные ссылки короткими. Запоминай ссылку по идентификатору. Бесплатно и навечно. Скрытие ссылок. Short link service" />
<meta name="keywords" content="каталог, сервис, сокращение, сокращение ссылок, короткие ссылки, ссылки, бесплатно, адрес, веб-сервис, короткий, короткие, texting, генератор коротких ссылок, зашифрованные ссылки, ek, ek.vc" />
<link href="http://yunusov.me/projects/shortlinks_2014/designe/style.css" rel="stylesheet" type="text/css"/>
<link href="http://yunusov.me/projects/shortlinks_2014/designe/favicon.ico" rel="shortcut icon"/>
<title>'.$title.'</title>
</head><body>';
}
?>