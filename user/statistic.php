<?php
include '../core/db.config.php';
include '../core/function.php';
include'../core/Mobile_Detect.php';
$detect = new Mobile_Detect;
include '../core/head.php';
if (!isset($_SESSION['user_id'])) {
	header('Location: ../');
	exit;
}
class Navigator 
{ 
    function __construct($all,$pnumber,$query='') 
    { 
        $this->all=$all; 
        $this->pnumber=$pnumber; 
        $this->query=$query; 
        $this->page=isset($_GET['page']) ? (int)$_GET['page'] : 1; 
    } 

    function start() 
    { 
        $this->num_pages=ceil($this->all/$this->pnumber); 
         
        if (isset($_GET['last'])) 
        $this->page=$this->num_pages; 
         
        $this->start=$this->page*$this->pnumber-$this->pnumber; 

        if ($this->page > $this->num_pages || $this->page < 1) 
        { 
            $this->page=1; 
            $this->start=0; 
        } 

        return $this->start; 
    } 

    function navi() 
    { 
         
        if ($this->num_pages<2) 
        return '';         
         
        $buff='<div class="menu">'; 
         
    for($pr = '', $i =1; $i <= $this->num_pages; $i++) 
    { 
        $buff.=  
        $pr=(($i == 1 || $i == $this->num_pages || abs($i-$this->page) < 2) ? ($i == $this->page ? " [$i] " : ' <a href="'.$_SERVER['SCRIPT_NAME'].'?page='.$i.'&amp;'.$this->query.'">'.$i.'</a> ') : (($pr == ' ... ' || $pr == '')? '' : ' ... ')); 
    } 
        return $buff.'</div>'; 
    } 

} 
if (!empty($_GET['url'])) {
$url=ms($_GET['url']);
$user1 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'"));
$user = $user1['login'];
$user21 = mysqli_fetch_array(mysqli_query($DB, "SELECT * FROM url WHERE url='$url'"));
$user2 = $user21['user'];
if (!empty($_GET['p'])) { ///ЕСЛИ ЕСТЬ &P= ТО ВЫДАЕМ ALL
$p = ms($_GET['p']);  
if ($p == 'all') {
if ($user=$user2) {/////ЕСЛИ ССЫЛКА ПОЛЬЗОВАТЕЛЯ:
$q=mysqli_query($DB, "SELECT COUNT(*) FROM counts WHERE idurl='$url'");
$all=mysqli_num_rows($q);
if ($all)
{/////ЕСЛИ ПЕРЕХОДЫ ЕСТЬ:
$pnumber=7;
$n=new Navigator($all,$pnumber);
$man = mysqli_query($DB, "SELECT * FROM `counts` WHERE `idurl` = '$url' ORDER BY `id` DESC LIMIT {$n->start()},$pnumber ");
$result1 = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `url` WHERE `url` = '$url'"));
$all_count = $result1['count'];
echo '<div class="head"><b>'.$all_clicks.' '.$url.'</b></div>';
if( $detect->isMobile() && $detect->isTablet() ){
if (isset($_SESSION['user_id'])){echo $uuus;}
else{echo $uuno;};
}
echo'<div class="main"><b>'.$total_clicks.':</b> '.$all_count.'</div><br>';
while($result = mysqli_fetch_assoc($man)){////ВЫВОД ВСЕХ ПЕРЕХОДОВ ПО ССЫЛКЕ:
echo'<div class="main"><b>'.$click.':</b> '.time_ago($result['date']).'<br>
<b>'.$location.':</b> '.ms($result['refer']).'<br>
<b>'.$machine.'а:</b> '.ms($result['ua']).' (IP: '.ms($result['ip']).')<br>
</div><br>';
}/////КОНЕЦ ВЫВОДА ВСЕХ ПЕРЕХОДОВ.
echo'<div class="menu"><a href="edit"><img src="http://ek.vc/designe/img/backw.png" alt="!"> '.$editor.'</a></div>';
echo $n->navi();
}else{/////ЕСЛИ ПЕРЕХОДОВ НЕТ:
echo '<div class="main"><img border="0" src="../designe/img/smi2.png" alt="!"> '.$not_clicks.'</div><div class="menu"><a href="edit"><img src="http://ek.vc/designe/img/backw.png" alt="!"> '.$editor.'</a><</div>';
}
} else {/////ЕСЛИ НЕ ССЫЛКА ПОЛЬЗОВАТЕЛЯ:
echo '<div class="main"><img border="0" src="../designe/img/error.png" alt="!"> '.$not_your.'</div><div class="menu"><a href="edit"><img src="http://ek.vc/designe/img/backw.png" alt="!"> '.$editor.'</a></div>';
}
}}else{ ///ЕСЛИ НЕТ &P= ТО ВЫДАЕМ ГЛАВНУЮ:
if ($user=$user2) {/////ЕСЛИ ССЫЛКА ПОЛЬЗОВАТЕЛЯ:
$result = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `counts` WHERE `idurl` = '$url' ORDER BY `id` DESC LIMIT 1"));
$result1 = mysqli_fetch_assoc(mysqli_query($DB, "SELECT * FROM `url` WHERE `url` = '$url'"));
$all_count = $result1['count'];
echo '<div class="head"><b>'.$stst_link.' '.$url.'</b></div>';
if( $detect->isMobile() && $detect->isTablet() ){
if (isset($_SESSION['user_id'])){echo $uuus;}
else{echo $uuno;};
}
echo '<div class="main"><b>'.$total_clicks.':</b> '.$all_count.'</div>';
echo '<div class="main"><b>'.$click.':</b> '.time_ago($result['date']).'</div>
<div class="main"><b>'.$location.':</b> '.ms($result['refer']).'</div>
<div class="main"><b>'.$machine.':</b> '.ms($result['ua']).' (IP: '.ms($result['ip']).')</div>';
echo '<div class="menu"><b><a href="statistic?p=all&url='.$url.'"><img src="http://ek.vc/designe/img/gow.png" alt="!"> '.$show_all.'</a></b></div>';
} else {/////ЕСЛИ ССЫЛКА НЕ ПОЛЬЗОВАТЕЛЯ:
echo '<div class="error"><img border="0" src="../designe/img/error.png" alt="!"> '.$not_your.'</div><div class="menu"><a href="edit"><img src="http://ek.vc/designe/img/backw.png" alt="!"> '.$editor.'</a></div>';
}}/////КОНЕЦ ГЛАВНОЙ.
} else {
echo '<div class="error"><img border="0" src="../designe/img/error.png" alt="!"> '.$not_your.'</div><div class="menu"><a href="edit"><img src="http://ek.vc/designe/img/backw.png" alt="!"> '.$editor.'</a></div>';}
include"../core/foot.php";
?>
