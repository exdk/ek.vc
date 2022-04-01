<?php
require_once 'core/db.config.php';
include_once 'core/function.php';
  
if(!empty($_GET['url'])){
$urlapi=filter_var($_GET['url'],FILTER_VALIDATE_URL);
if(!empty($_GET['key'])){
$key=ms($_GET['key']);
$user1 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM `users` WHERE `key`='".$key."'"));
$user = $user1['login'];
}else{
$user='API';
}
if(!empty($_GET['r'])){$r=abs(intval($_GET['r']));}else{$r='0';}
if (!$urlapi) {
        echo 'URL введен не верно';
    } else {
    do  { 
	$url_random=create_url(); 
	$q=mysqli_query($DB, "SELECT * FROM `url` where `url`='$url_random'"); 
	}  
    while(@mysqli_num_rows($q)>0); 
    $query=mysqli_query($DB, "SELECT * FROM `url` where `url_real`='$urlapi'"); 
    if(mysqli_num_rows($query)==0){ 
	mysqli_query($DB, "INSERT INTO `url`(url,url_real,user,adver,api) VALUES('$url_random','$urlapi','$user','$r','1')"); 
	echo 'http://ek.vc/'.$url_random.'';
    } else { 
      while($row=mysqli_fetch_array($query)){ 
           $url=$row['url']; 
      } 
		echo 'http://ek.vc/'.$url.'';
    }
  }
} else {
    echo 'URL введен не верно';
  }
?>