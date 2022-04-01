<? 
require_once 'core/db.config.php';
include_once 'core/function.php';
include 'core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include 'core/head.php';
if (!empty($_GET['p'])) {
$p = ms($_GET['p']);  


if ($p == 'api') { ///////////////API
echo'<div class="head">API</div>';
if( $detect->isMobile() && $detect->isTablet() ){
if (isset($_SESSION['user_id'])){echo $uuus;}
else{echo $uuno;}
}
echo $apii;
if( $detect->isMobile() && $detect->isTablet() ){
echo'<div class="menu"><a href="/me/index"><img src="http://yunusov.me/projects/shortlinks_2014/designe/img/backw.png" alt="!"> В кабинет</a></div><div class="menu"><a href="/"><img src="http://yunusov.me/projects/shortlinks_2014/designe/img/home.png" alt="!"> На главную</a></div>';
}
}


elseif ($p == 'about') {///////////////ABOUT
if( $detect->isMobile() && $detect->isTablet() ){
echo'<div class="head">Правила пользования:</div>';
if (isset($_SESSION['user_id'])){echo $uuus;}
else{echo $uuno;};
echo $about;
} else {/////WEB ABOUT REDIRECT
header('Location: ../');
exit;
}
}


elseif ($p == 'lang') {////////////////ВАРИАНТ ЯЗЫКА
if(isset($_GET['v'])) {
setcookie('lang', ms($_GET['v']), time() + 1296000, '/', '.'. $_SERVER['HTTP_HOST']);
header('Location: /');
exit;
} else {
header('Location: /');
exit;
}
}


elseif ($p == 'feedback') {///////////////FEEDBACK
echo'<div class="head">'.$head_feedback.'</div>';
if( $detect->isMobile() && $detect->isTablet() ){
if (isset($_SESSION['user_id'])){echo $uuus;}
else{echo $uuno;}
}
echo'<div class="main">';
$post = (!empty($_POST)) ? true : false;
if($post) {
if (!isset($_SESSION['user_id'])) {
$name1 = ms($_POST['name']);
$email1 = ms($_POST['email']);
} else {
$login = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM `users` WHERE id='{$_SESSION['user_id']}'"));
$name1 = $login['login'];
$email1 = $login['mail'];
}
$message1 =ms($_POST['message']);
$error = '';
if (!isset($_SESSION['user_id'])) {
if(!$name1) {
$error .= 'А представиться? :)<br />';
}
}
if(!$message1 || strlen($message1) < 1) {
$error .= "Введите сообщение<br />";
}
if(!$error) {
$mail = mail("a@ek.vc", "Feedback from ek.vc", "Hello!\n\rWe have a mail for you:\n\r------------\n\rAuthor: ".$name1." (".$email1.")\n\rText: ".$message1."\n\r------------\n\rRegards, bot@ek.vc",
"From: bot@ek.vc");
if($mail) {
echo '<div class="notification_ok">Ваше сообщение принято. Спасибо.</div>';
}
} else {
echo '<div class="notification_error">'.$error.'</div>';
}
}
if( !$detect->isMobile() && !$detect->isTablet() ){
echo'<form action="#" method="post"><div class="col-lg-7 hi_text">'.$please_feedback.'</div><br><br>
<div style="text-align:center">';
if (!isset($_SESSION['user_id'])) {
echo'<input name="name"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$name.'" /><br><br>
<input name="email"  maxlength="100" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="Email" /><br><br>';
}
echo'<textarea name="message"  maxlength="1000" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="'.$message.'"></textarea><br><br>
<button id="submit-button" type="submit" class="btn btn-primary hi-btn-go navbar-btn">'.$send.'</button></form></div></div>';
} else {
echo'<form action="#" method="post">';
if (!isset($_SESSION['user_id'])) {
echo'<input type="text" class="text" name="name" placeholder="'.$name.'" /></div><div class="main">
<input type="text" class="text" name="email" placeholder="Email" /></div><div class="main">';
}
echo'<textarea name="message" placeholder="'.$message.'"></textarea></div><div class="main">
<input class="button submit" type="submit" name="submit" value="'.$send.'" />
</form></div><div class="menu"><a href="/me/index"><img src="http://ek.vc/designe/img/backw.png" alt="!"> '.$head_area.'</a></div>
<div class="menu"><a href="/"><img src="http://ek.vc/designe/img/home.png" alt="!"> '.$home.'</a></div>';
}
}


elseif ($p == 'tool') {///////////////Tools
?>
<div class="head">Дополнения</div><br><div class="main">
Для удобства работы с сервисом можно воспользоваться букмарклетом:<br>
перетащите вот эту ссылку (<b><a href="javascript:location.href='http://ek.vc/api.php?url='+encodeURIComponent(location.href)">Сократить ссылку</a></b>) на панель вашего браузера.<br>
Нажимайте на эту закладку, когда хотите укоротить адрес просматриваемого вами сайта.</div>
<?php
}


}else {///////////////INDEX
if( !$detect->isMobile() && !$detect->isTablet() ){
echo'<div class="row"></div><br><br><br>
<form action="#" method="post"> 
<div class="input-group"><input name="url"  maxlength="1000" value="http://" type="text" class="form-control fr-input" id="input-word" autocomplete="off" placeholder="http://ek.vc" />
<span class="input-group-btn"><button id="submit-button" type="submit" class="btn btn-primary hi-btn-go navbar-btn">'.$short.'</button></span>
</form></div>';
} else {
echo'<div class="head"><b>'.$title.'</b></div>';
if (isset($_SESSION['user_id'])){echo $uuus;}
else{echo $uuno;}
echo $forp;
}
if(isset($_POST['url'])){ 
	$url_real=filter_var($_POST['url'],FILTER_VALIDATE_URL);
      if (!$url_real) {
        echo "<br><div class='main'><img border='0' src='designe/img/error.png' alt='!'> $address</div>";
		} else {
    do { 
       $url_random=create_url(); 
       $q=mysqli_query($DB, "SELECT * FROM `url` where `url`='$url_random'"); 
    }  
    while(@mysqli_num_rows($q)>0); 
    $query=mysqli_query($DB, "SELECT * FROM `url` where `url_real`='$url_real'"); 
    if(mysqli_num_rows($query)==0){ 
	if (isset($_SESSION['user_id']))
	{
		$touser1 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM `users` WHERE `id`='{$_SESSION['user_id']}'"));
		$touser = $touser1['login'];
        mysqli_query($DB, "INSERT INTO `url`(url,url_real,user) VALUES('$url_random','$url_real','$touser')"); 
	} else {
	       mysqli_query($DB, "INSERT INTO `url`(url,url_real) VALUES('$url_random','$url_real')"); 
		   }
		   if( !$detect->isMobile() && !$detect->isTablet() ){
	   echo "<br><div class='main'><img border='0' src='designe/img/ok.png' alt='!'> $done<br><br> 
	   <input name='old'  maxlength='12' type='text' class='form-control fr-input' id='input-word' value='http://ek.vc/".$url_random."' readonly='readonly' onclick='this.select();'/></div>";
	   } else {
	   	   echo "<div class='result'>$done <a href='http://".$_SERVER['HTTP_HOST']."/$url_random' target='_blank'><b>http://".$_SERVER['HTTP_HOST']."/$url_random</b></a><br />";
	   echo'<input type="text" name="url_result" value="http://'.$_SERVER['HTTP_HOST'].'/'.$url_random.'"></div>';
	   }
    } else { 
      while($row=mysqli_fetch_array($query)){ 
           $url=$row['url']; 
      } 
	  if( !$detect->isMobile() && !$detect->isTablet() ){
	  echo '<br><div class="main"><img border="0" src="designe/img/ok.png" alt="!"> '.$done.' </p><br>';
	   echo"<input name='old'  maxlength='12' type='text' class='form-control fr-input' id='input-word' value='http://ek.vc/".$url."' readonly='readonly' onclick='this.select();'/></div>"; 
	   } else {
	         echo '<div class="result">'.$done.' <a href="http://'.$_SERVER['HTTP_HOST'].'/'.$url.'" target="_blank"><b>http://'.$_SERVER['HTTP_HOST'].'/'.$url.'</b></a><br />
	  <input type="text" name="url_result" value="http://'.$_SERVER['HTTP_HOST'].'/'.$url.'"></div>'; 
	  }
    }
}
}
if( !$detect->isMobile() && !$detect->isTablet() ){
echo $prob;
} else {
echo $prop;
}
}
include 'core/foot.php';
?>