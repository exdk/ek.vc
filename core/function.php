<?php
////Создавалка рандомной ссылки
  function create_url() 
  { 
    $arr = array('a','b','c','d','e','f', 
                 'g','h','i','j','k','l', 
                 'm','n','o','p','r','s', 
                 't','u','v','w','x','y', 
                 'z','A','B','C','D','E', 
                 'G','H','I','J','K','L', 
                 'M','N','O','P','R','S', 
                 'T','U','V','W','X','Y', 
                 'Z','F','1','2','3','4', 
                 '5','6','7','8','9','0'); 
    $url = ""; 
    for($i = 0; $i < 3; $i++) 
    { 
      $random = rand(0, count($arr) - 1); 
      $url .= $arr[$random]; 
    } 
    return $url; 
  }


//фильтрация SQL Inj и XSS
function ms($var) {
global $DB;
$var = str_replace('\00', ' ', $var);
$var = $DB->real_escape_string($var);
$var = htmlspecialchars(trim($var,ENT_QUOTES));
return $var;
}

//////получаем ip адрес
function ip(){
if (isset($_SERVER['HTTP_X_REAL_IP'])) {
return $_SERVER['HTTP_X_REAL_IP'];
} else {
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
return $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
return $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
return $_SERVER['REMOTE_ADDR'];
}
}
}

/**
 * Время 1
 */
function vremja($time=NULL)
{
global $user;
date_default_timezone_set('Europe/Moscow');
if ($time==NULL)$time=time();
if (isset($user))$time=$time+$user['set_timesdvig']*60*60;
$timep="".date("j M Y в H:i", $time)."";
$time_p[0]=date("j n Y", $time);
$time_p[1]=date("H:i", $time);
if ($time_p[0]==date("j n Y"))$timep=date("H:i:s", $time);
if ($time_p[0]==date("j n Y", time()+$user['set_timesdvig']*60*60))$timep=date("Сегодня в H:i:s", $time);
if ($time_p[0]==date("j n Y", time()-60*60*(24-$user['set_timesdvig'])))$timep="Вчера в $time_p[1]";
else{
if ($time_p[0]==date("j n Y", time()+$user['set_timesdvig']*60*60))$timep=date("Сегодня в H:i:s", $time);
if ($time_p[0]==date("j n Y", time()-60*60*24))$timep="Вчера в $time_p[1]";}

$timep=str_replace("Jan","Января",$timep);
$timep=str_replace("Feb","Февраля",$timep);
$timep=str_replace("Mar","Марта",$timep);
$timep=str_replace("May","Мая",$timep);
$timep=str_replace("Apr","Апреля",$timep);
$timep=str_replace("Jun","Июня",$timep);
$timep=str_replace("Jul","Июля",$timep);
$timep=str_replace("Aug","Августа",$timep);
$timep=str_replace("Sep","Сентября",$timep);
$timep=str_replace("Oct","Октября",$timep);
$timep=str_replace("Nov","Ноября",$timep);
$timep=str_replace("Dec","Декабря",$timep);
return $timep;
}



/**
 * Склонение слов по числам
 */
function numword() {  
    $args = func_get_args();  
    $num = $args[0] % 100;  
     
    if ($num > 19) {  
        $num = $num % 10;  
    }  

    switch ($num) {  
        case 1:  { return $args[1]; }  
        case 2:  
        case 3:  
        case 4:  { return $args[2]; }  
        default: { return $args[3]; }  
    }  
} 
////////////Время
function time_ago($time)
{
$ltime = time() - $time;

if($ltime < 5)
{
return 'только что';
}
elseif($ltime < 60)
{
return $ltime.' '.numword($ltime, 'секунду', 'секунды', 'секунд').' назад';
}
elseif($ltime < 3600)
{
return round($ltime/60).' '.numword(round($ltime/60), 'минуту', 'минуты', 'минут').' назад';
}
elseif($ltime < 86400)
{
return round($ltime/3600).' '.numword(round($ltime/3600), 'час', 'часа', 'часов').' назад';
}
elseif($ltime > 1814400)
{
return vremja($time);
}
elseif($ltime > 604800)
{
return round($ltime/604800).' '.numword(round($ltime/86400), 'неделю', 'недели', 'недель').' назад';
}
elseif($ltime > 86400)
{
return round($ltime/86400).' '.numword(round($ltime/86400), 'день', 'дня', 'дней').' назад';
}
}
?>