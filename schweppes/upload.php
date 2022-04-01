<?php
include '../core/db.config.php';
include '../core/function.php'; 
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
$array2 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
if ($array2['level'] != 3){header("Location: ../index.php");}
$uploaddir = '../upload/';
$apend=rand(1,10000).'.jpg';
$uploadfile = "$uploaddir$apend";
echo'<div class="head">Загрузить картинку</a></div>
<div class="menu">Загрузаемый файл должен иметь ограничения: размер не превышает 6 Мб, пиксели по ширине не более 8010, по высоте не более 8000.</div><div class="menu">
<form name="upload" action="#" method="POST" ENCTYPE="multipart/form-data">
Выберите файл для загрузки: <input type="file" name="userfile">
<input type="submit" name="upload" value="Загрузить">
</form></div></div>';
if ($_POST) {
if($_FILES['userfile']['size'] != 0 and $_FILES['userfile']['size']<=6024000) {
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
$size = getimagesize($uploadfile);
if ($size[0] < 8011 && $size[1]<8002) {
echo "<div class='result'>Файл загружен. Путь к файлу: <br><a href='http://ek.vc/schweppes/$uploadfile' target='_blank'><b>http://ek.vc/upload/$apend</b></a></div>";
}else {echo "<div class='error'>Размер пикселей превышает допустимые нормы (ширина не более - 8010 пикселей, высота не более 8000)</div>"; 
unlink($uploadfile);
}
} else {echo "<div class='error'>Файл не загружен, верьнитель и попробуйте еще раз</div>";}
}else { echo "<div class='error'>Размер файла не должен превышать 6000Кб</div>";}
}
include"../core/foot.php";
?>