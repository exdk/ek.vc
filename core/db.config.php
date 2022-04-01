<?php 
$DB = new mysqli('mysql-174554.srv.hoster.ru', 'srv174554_aa59', 'bcs2d.,y', 'srv174554_b63cb'); 
if (mysqli_connect_errno()) { 
echo 'Ошибка подключения к MySQL';
exit; 
}
$DB->query('SET charset utf8'); 
$DB->query('SET names utf8'); 
$DB->query('SET character_set_client="utf8"'); 
$DB->query('SET character_set_connection="utf8"'); 
$DB->query('SET character_set_result="utf8"');

// сюда вынесем обработку суперглобальных массивов от слешей
// http://phpfaq.ru/slashes

   function slashes(&$el)
		{
			if (is_array($el))
			foreach($el as $k=>$v)
			slashes($el[$k]);
			else $el = stripslashes($el); 
		}

	if (ini_get("magic_quotes_gpc"))
		{
			slashes($_GET);
			slashes($_POST);    
			slashes($_COOKIE);
		}
?>