<?php /* Smarty version 2.6.14, created on 2013-08-14 10:53:36
         compiled from ../header.html */ ?>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquerymobile.js"></script>
<div class='header'>
	<div class="navdiv">
		<div ><img id="nav" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/nav_btn.png" width=60px/></div>
		<div class="slidetoggle">
			<div class="triangle"></div>
			<div class="infobox">
				<ul>
					<li style="background:url(/views/images/android/w_user_center.png) no-repeat;background-size:25px ;background-position:10px;"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
android/user/resident">个人中心</a></li>
					<li style="background:url(/views/images/android/w_find_hos.png) no-repeat;background-size:25px 25px;background-position:10px;"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
android/hospital/list">找医院</a></li>
					<li><img style="height:40px;clip:rect(10px 10px 10px 10px);z-index:200;position:absolute" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/grzx.png"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
android/user/login">登陆</a></li>
				</ul>
			</div>
		</div>
	</div>
	
		<?php echo $this->_tpl_vars['title']; ?>

</div>
<script>
$("#nav").bind("vmousedown",function(){
	$(this).attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/nav_btn_focus.png");
});
$("#nav").bind("vmouseup",function(){
	$(this).attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/nav_btn.png");
});
$(document).ready(function(){
	$("#nav").click(function(){
		$(".slidetoggle").slideToggle(200);
	});
});

</script>