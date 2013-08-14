<?php /* Smarty version 2.6.14, created on 2013-04-27 20:05:51
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="translated-ltr"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/android.css" rel="stylesheet" type="text/css" media="screen">
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/jquerymobile.css" rel="stylesheet" type="text/css" media="screen">
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquerymobile.js"></script>
<body >
<div class="content">
<img style="position: absolute; left: 11; top:15; z-index:-1;"src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/bg.jpg" width="100%" height="100%">
<div class="center">
<div class="yuan">
	<img id="zyy" style="position: absolute; left: 11; top:15; margin:100px;"src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/index_zyy.png" width='100px' height='100px'>
	<img id="grzx" style="position: absolute; left: 11; top:15;margin:120px 25px;"src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/grzx.png" width='50px' >
	
</div>
</div>
</div>
</body>
<script type='text/javascript'>

//找医院点击背景图片
$("#zyy").bind("vmousedown",function(){
	$(this).attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/index_zyy_focus.png");
});
$("#zyy").bind("vmouseup",function(){
	$(this).attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/index_zyy.png");
});

//个人中心点击背景图片
$("#grzx").bind("vmousedown",function(){
	$(this).attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/grzx_focus.png");
});
$("#grzx").bind("vmouseup",function(){
	$(this).attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/grzx.png");
});


$(document).ready(function(){
	
	$("#zyy").click(function(){
		window.location="<?php echo $this->_tpl_vars['basePath']; ?>
android/hospital/list";
	})
	
    $("#grzx").click(function(){
		window.location="<?php echo $this->_tpl_vars['basePath']; ?>
android/user/resident/";
	})	
})
</script>
</html>