<?php
if( !$detect->isMobile() && !$detect->isTablet() ){
?>
</div>
	<div id="body">
		<div id="footer">
			<div>
				<span id="social">
					<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fek.vc%2F&amp;send=false&amp;layout=button_count&amp;width=140&amp;show_faces=false&amp;action=recommend&amp;colorscheme=light&amp;font=arial&amp;height=20&amp;locale=ru_RU" style="display:inline; border-width:1px; overflow:hidden; border:none; overflow:hidden; width:140px; height:20px;"></iframe>
					<iframe src="//platform.twitter.com/widgets/tweet_button.html?lang=ru&amp;url=http%3A%2F%2Fek.vc%2F&amp;text=Сервис%20сокращения%20ссылок&amp;hashtags=сократить" style="display:inline; border-width:0px; overflow:hidden; width:100px; height:20px;"></iframe>
					<script src="https://apis.google.com/js/plusone.js"></script>
					<g:plus action="share" data-annotation="inline" data-href="http://ek.vc/"></g:plus>
				</span>
				
				<ul>
					<li>&copy; 2014 <?echo $title; echo $version; echo $tool;?>
					</li>				
				</ul>

				<span id="work">
					<!--LiveInternet counter-->
					<script type="text/javascript"><!--
					document.write("<a href='//www.liveinternet.ru/click' "+
					"target=_blank><img src='//counter.yadro.ru/hit?t26.6;r"+
					escape(document.referrer)+((typeof(screen)=="undefined")?"":
					";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
					screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
					";"+Math.random()+
					"' alt='' title='LiveInternet: показано число посетителей за"+
					" сегодня' "+
					"border='0' width='88' height='15'><\/a>")
					//--></script>
					<!--/LiveInternet-->		
					<img src="http://yunusov.me/projects/shortlinks_2014/designe/img/html5.png" alt="html5" title="HTML5"/>
				</span>
			</div>	
		</div>
	</div>
</body></html>
<?php
} else {
if ($_SERVER['PHP_SELF'] !='/index.php'){echo'<div class="menu"><a href="http://yunusov.me/projects/shortlinks_2014/"><b><img src="http://yunusov.me/projects/shortlinks_2014/designe/img/home.png" alt="!" /> '.$home.'</b></a></div>';}
echo'<div class="head">
<a href="http://yunusov.me/projects/shortlinks_2014/vk" target="_blank"><img class="vk" src="http://yunusov.me/projects/shortlinks_2014/designe/img/vk.png" alt="!"></a>
<b>(c) ek.vc, 2014</b> '.$version.'
<a href="http://yunusov.me/projects/shortlinks_2014/twt" target="_blank"><img class="twitter" src="http://yunusov.me/projects/shortlinks_2014/designe/img/twitter.png" alt="!"></a></div>
<a href="http://waplog.net/c.shtml?567960"><img src="http://c.waplog.net/567960.cnt" alt="waplog" /></a>
<a href="http://waptut.ru/in.go?id=10106"><img src="http://c.waptut.ru/10106/small.png" alt="Waptut" /></a>
</body></html>';
}
?>