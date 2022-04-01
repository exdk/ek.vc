<?php
include 'db.config.php';
include 'function.php';
include'Mobile_Detect.php';
$detect = new Mobile_Detect;
$get = ms($_GET['id']);
$array = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM url WHERE url='$get'"));
$url_real = $array['url_real']; 
$adver = $array['adver'];
$user = ms($array['user']);
$count_new = $array['count']+1; 
$refer = (@$_SERVER['HTTP_REFERER']);
$ip_user = ip();
$ua = $_SERVER['HTTP_USER_AGENT'];
if (empty($_GET['id'])) {
		header('Location: ../');
		exit;
	}
if ($adver == 0) {
if ($url_real) {
		mysqli_query($DB, "UPDATE `url` SET `count` = '$count_new' WHERE `url` = '$get'");
		if ($user) {
		mysqli_query($DB, "INSERT INTO `counts`(idurl,date,refer,ip,ua) VALUES ('$get','".time()."','$refer','$ip_user','$ua')");
		}
		header('Location: '.$url_real.'');
		exit;
    } else {
		if( !$detect->isMobile() && !$detect->isTablet() ){
		include 'head.web.php';
		echo '<br><br><div class="form-container"><center><img border="0" src="../designe/img/error.png" alt="!"> '.$not_found.'</center></div>
		<br><br><br><div class="col-lg-7 hi_text"><center>&copy; 2014 '.$title.'</center></div>';
		}else{
		include 'head.php';
		echo'<div class="head">Error</div><div class="error">'.$not_found.'</div>';
		include 'foot.php';
		}
	}
} else { /////ЕСЛИ РЕКЛАМА ВКЛЮЧЕНА
if( !$detect->isMobile() && !$detect->isTablet() ){ ////WEB РЕКЛАМА
echo'
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Переход по ссылке</title>
<style type="text/css">
* { font-family:arial, verdana, tahoma; margin:0; padding:0; font-size:25px; }
html { height:100%; }
body { background:url(/i/bg.jpg) repeat-x #FFF; color:#000; height:100%; }
a { color: #005C9C; }
a:hover { color: #C00; }
strong { font-size:8px; }
.da_adp_links a { color:#000; font-size:8px; }
#lnk { vertical-align:top; }
#lnk a { display:block; margin:99px auto; text-align:center; border:2px solid #C00; color:#C00; border-radius: 12px; width:290px; line-height:90px; font-size:50px; background-color:#FCFCFC; }
#lnk a:hover { border:2px solid #F00; color:#F00; }
</style>
</head>
<body">
<table width="100%" height="100%"><tbody><tr><td id="lnk">
<a href="'.$url_real.'" target="_blank" onclick="javascript:window.open("http://yandex.ru")">Далее →</a>
</td></tr>
<tr><td style="verical-align:bottom;">
<div id="DIV_DA_87511"></div>
<script charset="utf-8" type="text/javascript" src="http://www.directadvert.ru/show.cgi?adp=87511&div=DIV_DA_87511"></script>
<div style="font-size:9px; color:#CCC; text-align:center; margin-top:10px;">При нажатии кнопки «Далее» произойдёт переход на сайт: '.$url_real.'</div>
</td></tr></tbody></table>
<a href="http://waplog.net/c.shtml?567960"><img src="http://c.waplog.net/567960.cnt" alt="waplog" /></a>
<a href="http://waptut.ru/in.go?id=10106"><img src="http://c.waptut.ru/10106/small.png" alt="Waptut" /></a> ';
?>
<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t26.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показано число посетителей за"+
" сегодня' "+
"border='0' width='88' height='15'><\/a>")
//--></script><!--/LiveInternet-->
<?php
} else { ////WAP РЕКЛАМА
include 'head.php';
echo'<div class="head">Переход по ссылке</div><br>
<div class="wapstart-plus1-ad"></div>
<div class="menu"><a href="'.$url_real.'" target="_blank" onclick="javascript:window.open("http://yandex.ru")">Далее →</a><br></div><br>
<div class="wapstart-plus1-ad"></div>
<div style="font-size:9px; color:#CCC; text-align:left; margin-top:10px;">При нажатии кнопки «Далее» произойдёт переход на сайт: '.$url_real.'</div>
<a href="http://waplog.net/c.shtml?567960"><img src="http://c.waplog.net/567960.cnt" alt="waplog" /></a>
<a href="http://waptut.ru/in.go?id=10106"><img src="http://c.waptut.ru/10106/small.png" alt="Waptut" /></a> ';
?>
<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t26.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показано число посетителей за"+
" сегодня' "+
"border='0' width='88' height='15'><\/a>")
//--></script><!--/LiveInternet-->
<?php
echo"<script type='text/javascript'>
    (function() {
    var plus1SiteId = 11751;
    var c = document.createElement('script'); c.type = 'text/javascript'; c.async = true; c.src = 'http://ro.plus1.wapstart.ru/?area=getJsCode&id=' + plus1SiteId + '&encoding=1'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(c, s);
    })();
    </script>";
}
}
?>