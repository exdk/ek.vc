<?php
include '../core/db.config.php';
include '../core/function.php';
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
echo'<div class="head">Редактор ссылок</div>';
if( $detect->isMobile() && $detect->isTablet() ){
echo $uuus;
}
if (!isset($_SESSION['user_id'])) {
	header('Location: ../');
	exit;
}
switch(ms(@$_GET['act'])) {
default:
$user2 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
$qo=mysqli_query($DB, "SELECT * FROM `url` WHERE `user` = '{$user2['login']}'");
$count = mysqli_num_rows(mysqli_query($DB, "SELECT COUNT `id` FROM `url` WHERE `user`='{$user2['login']}'"));
if ($count == 0) {
echo'<div class="main"><img border="0" src="../designe/img/smi2.png" alt="!"> Ссылок пока нет. Почему бы не <b><a href="http://ek.vc">добавить</a></b> их сейчас?</div>';
} else {
echo'<div class="main"><img border="0" src="http://ek.vc/designe/img/smi2.png" alt="!"> <a href="?act=delete2">Удалить все мои ссылки</a><br/></div>';
}
while($result = mysqli_fetch_array($qo)) {
echo "<div class='main'>Ссылка: <b>".ms($result['url_real'])."</b><br/>
Короткая ссылка:<br/>
<input type='text' name='url' maxlength='10' value='http://ek.vc/".ms($result['url'])."'><br/>
Переходов: <b>".ms($result['count'])."</b></div>
<div class='menu'><a href='statistic?url=".ms($result['url'])."'><img src='http://ek.vc/designe/img/infow.png' alt='!'> Полная статистика</a></div><div class='menu'>
<a href=\"?act=delete&id=".$result['id']."\"><img src='http://ek.vc/designe/img/delw.png' alt='!'> Удалить</a></div><div class='menu'><a href=\"?act=edit&id=".$result['id']."\"><img src='http://ek.vc/designe/img/edw.png' alt='!'> Редактировать</a>
</div><br>";
}
break;

case 'edit':
$id=(int)ms($_GET['id']);
$touser = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM `users` WHERE id='{$_SESSION['user_id']}'"));
$user = $touser['login'];
$touser2 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM `url` WHERE id='$id'"));
$user2 = $touser2['user'];
$result = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `url` WHERE `id` = '$id'"));
if ($user=$user2) {
echo '<div class="menu"><b>Редактирование ссылки:</b><br/>';
echo '<form action="?act=edit_ok&id='.$id.'" method="post" name="form">';
echo '<b>Адрес:</b><br/>
<textarea name="new_url" rows="4" cols="21">'.ms($result['url_real']).'</textarea><br/>';
echo"<b>Идентификатор:</b><br><input type='text' name='new_id' maxlength='10' value='".ms($result['url'])."'><br/>";
echo '<input name="submit" type="submit" value="Сохранить" /></form></div>';
} else {
echo '<div class="error">Это не Ваша ссылка</div>';
}
break;

case 'edit_ok':
$id=(int)ms($_GET['id']);
$touser = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
$user = $touser['login'];
$touser2 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM url WHERE id='$id'"));
$user2 = $touser2['user'];
if ($user=$user2) {
$new_url = ms($_POST['new_url']);
$new_id = ms($_POST['new_id']);
mysqli_query($DB, "UPDATE `url` SET `url` = '$new_id', `url_real` = '$new_url' WHERE `id` = '$id'");
echo '<div class="result">Изменения сохранены!</div>';
} else {
echo '<div class="error">Это не Ваша ссылка</div>';
}
break;

case 'delete':
$id=(int)ms($_GET['id']);
$touser = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
$user = $touser['login'];
$touser2 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM url WHERE id='$id'"));
$user2 = $touser2['user'];
if ($user=$user2) {
$result = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `url` WHERE `id` = '$id'"));
mysqli_query($DB, "DELETE FROM `counts` WHERE `idurl` = '$result[url]'");
mysqli_query($DB, "DELETE FROM `url` WHERE `id` = '$id'");
echo '<div class="result">Ссылка удалена!</div>';
} else {
echo '<div class="error">Это не Ваша ссылка</div>';
}
break;

case 'delete2':
echo'<div class="error"><a href="?act=delete2ok">Да, я хочу удалить все свои ссылки</a></div>';
break;

case 'delete2ok':
$user = mysqli_fetch_array(mysqli_query($DB, "SELECT login FROM users WHERE id='{$_SESSION['user_id']}'"));
$result = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `url` WHERE `user` = '$user'"));
mysqli_query($DB, "DELETE FROM `counts` WHERE `idurl` = '$result[url]'");
mysqli_query($DB, "DELETE FROM `url` WHERE `user` = '$user'");
echo '<div class="result">Все Ваши ссылки были удалены.</div>';
break;
}
echo'<div class="menu"><a href="edit"><img src="../designe/img/backw.png" alt="!"> Редактор ссылок</div>';
include"../core/foot.php";
?>