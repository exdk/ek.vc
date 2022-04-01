<?
include '../core/db.config.php';
include '../core/function.php'; 
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
$urlis = mysqli_fetch_array(mysqli_query($DB, "SELECT COUNT(`id`) FROM `url`"),MYSQLI_NUM);
$users = mysqli_fetch_array(mysqli_query($DB, "SELECT COUNT(`id`) FROM `users`"),MYSQLI_NUM);
$goes = mysqli_fetch_array(mysqli_query($DB, "SELECT SUM(`count`) FROM `url`"),MYSQLI_NUM);
$api = mysqli_fetch_array(mysqli_query($DB, "SELECT COUNT(`id`) FROM `url` WHERE `api`='1'"),MYSQLI_NUM);
$man = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `url` ORDER BY `count` DESC LIMIT 1"));
$array2 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
if ($array2['level'] != 3){header("Location: ../index.php");}
echo'<div class="head">Статистика сервиса</a></div>';
echo"<div class='menu'>Добавлено <a href='links.php'>ссылок</a>: <b>".$urlis[0]."</b></div>
<div class='menu'>Из них через API: <b>".$api[0]."</b></div>
<div class='menu'>Зарегистрировано <a href='users.php'>пользователей</a>: <b>".$users[0]."</b></div>
<div class='menu'>Переходов по ссылкам: <b>".$goes[0]."</b></div>
<div class='menu'>Самая кликабельная ссылка: <a href='http://ek.vc/".$man['url']."'><b>http://ek.vc/".$man['url']."</b></a> (".$man['count'].")</div>
<div class='menu'>Оригинал: <a href='".$man['url_real']."'><b>".$man['url_real']."</b></a> (".$man['user'].")</div>";
echo'<div class="menu"><a href="index.php">- Админка</a></div>';
include"../core/foot.php";
?>