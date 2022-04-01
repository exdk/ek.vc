<?
include '../core/db.config.php';
include '../core/function.php'; 
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
echo'<div class="head">Управление пользователями</a></div>';
$array2 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
if ($array2['level'] != 3){header("Location: ../index.php");}

switch(ms(@$_GET['act'])){
default:
echo '<div class="menu"><a href="?act=delete2">Удалить всех</a></div><div class="menu">Управление пользователями</div>';
$man = mysqli_query($DB, "SELECT * FROM `users` ORDER BY `id` DESC");
while($result = mysqli_fetch_assoc($man)){
$urls = mysqli_fetch_array(mysqli_query($DB, "SELECT COUNT(`user`) FROM `url` WHERE `user`='{$result['login']}'"),MYSQLI_NUM);
echo "<div class='menu'><b>".$result['id'].".</b> Логин: <b>".ms(htmlspecialchars($result['login']))."</b><br/> 
<a href=\"?act=links&id=".$result['id']."\"><b>Ссылки пользователя</b></a>: <b>".$urls[0]."</b><br/>
[<a href=\"?act=delete&id=".$result['id']."\">Удалить</a>] [<a href=\"?act=pravka&id=".$result['id']."\">Редактировать</a>] [<a href=\"?act=ban&id=".$result['id']."\">Забанить</a>]</br>"; if($result['bann'] == 1){echo"[<a href=\"?act=unban&id=".$result['id']."\">Разбанить</a>]";}
echo'<br/></div>';
}
echo'</div>';
break;

case 'links':
$id=(int)ms($_GET['id']);
$result = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `users` WHERE `id` = '$id'"));
$login = $result['login'];
$links = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `url` WHERE `user` = '$login'"));
$qo=mysqli_query($DB, "SELECT * FROM `url` WHERE `user` = '$login' ORDER BY `id` DESC");
echo '<div class="menu"><b>Ссылки пользователя '.ms($result['login']).'</b></div>';
while($result = mysqli_fetch_array($qo)) {
echo "<div class='menu'>Ссылка: <b>".ms($result['url_real'])."</b><br/>
Короткая ссылка:<br/>
<input type='text' name='url' maxlength='10' value='http://ek.vc/".ms($result['url'])."'><br/>
Переходов: <b>".ms($result['count'])."</b><br/>";
echo"[<a href=\"links.php?act=delete&id=".$result['id']."\">Удалить</a>] [<a href=\"links.php?act=pravka&id=".$result['id']."\">Редактировать</a>]</div>";
}
break;


case 'ban':
$id=(int)ms($_GET['id']);
$result = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `users` WHERE `id` = '$id'"));
echo '<div class="menu"><b>Забанить пользователя '.ms($result['login']).'?</b><br/>
<form action="?act=ban_go&id='.$id.'" method="post" name="form">
<input name="coment" type="hidden" value="1"/>
<input name="submit" type="submit" value="Да" /></form></div>';
break;

case 'unban':
$id=(int)ms($_GET['id']);
$result = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `users` WHERE `id` = '$id'"));
echo '<div class="menu"><b>Разбанить пользователя '.ms($result['login']).'?</b><br/>
<form action="?act=unban_go&id='.$id.'" method="post" name="form">
<input name="coment" type="hidden" value="0"/>
<input name="submit" type="submit" value="Да" /></form></div>';
break;

case 'pravka':
$id=(int)ms($_GET['id']);
$result = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `users` WHERE `id` = '$id'"));
echo '<div class="menu"><b>Редактирование пользователя:</b><br/>
<form action="?act=pravka_go&id='.$id.'" method="post" name="form">
<b>Логин:</b><br/>
<input name="login" type="text" maxlength="250" value="'.ms($result['login']).'"/><br/>
<b>E-mail:</b><br/>
<input name="mail" type="" maxlength="250" value="'.ms($result['mail']).'"/><br/>
<b>Level (3-администратор):</b><br/>
<input name="level" type="" maxlength="250" value="'.ms($result['level']).'"/><br/>
<input name="submit" type="submit" value="Сохранить" /></form></div>';
break;

case 'delete':
$id=(int)ms($_GET['id']);
echo '<div class="menu">Вы уверены?<br/><a href="?act=deleteok&id='.$id.'">Да, заебал</a></div>';
break;

case 'deleteok':
$id=(int)ms($_GET['id']);
$resultgo = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `users` WHERE `id` = '$id'"));
mysqli_query($DB, "DELETE FROM `url` WHERE `user` = '$resultgo[login]'");
mysqli_query($DB, "DELETE FROM `users` WHERE `id` = '$id'");
echo '<div class="menu">Пользователь удален!</div>';
break;

case 'delete2':
echo '<div class="menu">Вы уверены?<br/><a href="?act=delete2ok">Да, заебал</a></div>';
break;

case 'delete2ok':
mysqli_query($DB, "DELETE FROM `users`");
echo '<div class="menu">Все удалены</div>';
break;

case 'ban_go':
$id=(int)ms($_GET['id']);
$coment = ms($_POST['coment']);
mysqli_query($DB, "UPDATE `users` SET `bann` = '$coment' WHERE `id` = '$id'");
echo '<div class="menu">Забанен!</div>';
break;

case 'unban_go':
$id=(int)ms($_GET['id']);
$coment = ms($_POST['coment']);
mysqli_query($DB, "UPDATE `users` SET `bann` = '$coment' WHERE `id` = '$id'");
echo '<div class="menu">Разбанен!</div>';
break;

case 'pravka_go':
$id=(int)ms($_GET['id']);
$login = ms($_POST['login']);
$mail = ms($_POST['mail']);
$level = ms($_POST['level']);
mysqli_query($DB, "UPDATE `users` SET `login`='$login', `level`='$level', `mail`='$mail' WHERE `id` = '$id'");
echo '<div class="menu">Сохранено!</div>';
break;
}

echo'<div class="menu"><a href="users.php?">Список пользователей</a> | <a href="index.php">В админку</a></div>';
include '../core/foot.php';
?>