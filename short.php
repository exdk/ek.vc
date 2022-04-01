<?php
############ШАПКА##############
echo'<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Cache-Control" content="cache" />
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
<link href="http://ek.vc/designe/style.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="http://ek.vc/designe/favicon.ico"/>
<title>Сокращатель ссылок 3000</title>
</head><body>
<div class="head"><b>Образец граббера сервиса коротких ссылок</div>';
###############################
if (isset($_GET['url'])){
$real_url = htmlspecialchars($_GET['url']);
$url = "http://ek.vc/api.php?url=$real_url&api=1";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($ch);
if (curl_errno($ch)) {
  echo curl_error($ch);
  echo "\n<br />";
  $contents = '';
} else {
  curl_close($ch);
}
if (!is_string($contents) || !strlen($contents)) {
echo "<div class='error'>Ошибка соединения.</div>";
$contents = '';
}
echo '<div class="menu">Ваша короткая ссылка:</div>
<div class="result">'.$contents.'</div>';
} else {
echo '<div class="menu">
<form method="get" action="">Ссылка для сокращения:<br/>
<input type="text" name="url" value="http://"/><br/>
<input type="submit" value=" Сократить" /></form>
</div>';
}
############НОГИ###############
echo '<div class="menu"><a href="?"> - Сократить ссылку</a></div>';
echo'<div class="head"><b>(c) Сокращатель ссылок, 2014</b></div>
</body></html>';
###############################
?>