<?
include '../core/db.config.php';
include '../core/function.php'; 
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
$array2 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
if ($array2['level'] != 3){header("Location: ../index.php");}
echo'<div class="head">Панель управления</a></div>
<div class="menu"><a href="users.php">- Управление пользователями</a></div>
<div class="menu"><a href="links.php">- Управление ссылками</a></div>
<div class="menu"><a href="statistic.php">- Статистика сайта</a></div>
<div class="menu"><a href="upload.php">- Выгрузить фото</a></div>
</div></div>';
include"../core/foot.php";
?>