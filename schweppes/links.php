<?
include '../core/db.config.php';
include '../core/function.php'; 
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
echo'<div class="head">Управление ссылками</a></div>';
$array2 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
if ($array2['level'] != 3){header("Location: ../index.php");}

switch(ms(@$_GET['act'])){
default:
echo '<div class="menu"><a href="?act=delete2">Удалить все</a></div>';
$man = mysqli_query($DB, "SELECT * FROM `url` ORDER BY `id` DESC");
while($result = mysqli_fetch_assoc($man)){
echo "<div class='menu'><b>".$result['id'].".</b> Ссылка: <b>".ms(htmlspecialchars($result['url']))."</b><br/>
Куда ведет: <b>".ms(htmlspecialchars($result['url_real']))."</b><br/>
Переходов: <b>".ms(htmlspecialchars($result['count']))."</b><br/>";
if ($result['user']){echo"Добавил: <b>".ms(htmlspecialchars($result['user']))."</b><br/>";}
echo"[<a href=\"?act=delete&id=".$result['id']."\">Удалить</a>] [<a href=\"?act=pravka&id=".$result['id']."\">Редактировать</a>]<br/><br/></div>";
}
break;


case 'pravka':
$id=(int)ms($_GET['id']);
$result = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `url` WHERE `id` = '$id'"));
echo '<div class="menu"><b>Редактирование ссылки:</b></div><div class="menu">
<form action="?act=pravka_go&id='.$id.'" method="post" name="form">
Куда ведет:<br/>
<input name="url_real" type="text" maxlength="250" value="'.ms($result['url_real']).'"/><br/>
Кто добавил:<br/>
<input name="user" type="" maxlength="250" value="'.ms($result['user']).'"/><br/>
Идентификатор:<br/>
<input name="url" type="" maxlength="250" value="'.ms($result['url']).'"/><br/>
<input name="submit" type="submit" value="Сохранить" /></form></div>';
break;

case 'delete':
$id=(int)ms($_GET['id']);
echo '<div class="error">Вы уверены?<br/><a href="?act=deleteok&id='.$id.'">Да, заебал</a></div>';
break;

case 'deleteok':
$id=(int)ms($_GET['id']);
$result = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `url` WHERE `id` = '$id'"));
mysqli_query($DB, "DELETE FROM `counts` WHERE `idurl` = '$result[url]'");
mysqli_query($DB, "DELETE FROM `url` WHERE `id` = '$id'");
echo '<div class="result">Ссылка удалена!</div>';
break;

case 'delete2':
echo '<div class="error">Вы уверены?<br/><a href="?act=delete2ok">Да, заебал</a></div>';
break;

case 'delete2ok':
mysqli_query($DB, "DELETE FROM `url`");
mysqli_query($DB, "DELETE FROM `counts`");
echo '<div class="result">Все ссылки удалены</div>';
break;

case 'pravka_go':
$id=(int)ms($_GET['id']);
$user = ms($_POST['user']);
$url_real = ms($_POST['url_real']);
$url = ms($_POST['url']);
mysqli_query($DB, "UPDATE `url` SET `url`='$url', `url_real`='$url_real', `user`='$user' WHERE `id` = '$id'");
echo '<div class="result">Сохранено!</div>';
break;
}

echo'<div class="menu"><a href="links.php?">Список ссылок</a> | <a href="index.php">В админку</a></div>';
include '../core/foot.php';
?>