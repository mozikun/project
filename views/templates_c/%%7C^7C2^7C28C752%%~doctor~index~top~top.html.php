<?php /* Smarty version 2.6.14, created on 2013-04-27 17:40:51
         compiled from top.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<style type="text/css">
body{
	margin:0px;
	padding:0px;
	#background:url('<?php echo $this->_tpl_vars['baseUrl']; ?>
images/top_bg.gif') repeat-x;
	background:url('<?php echo $this->_tpl_vars['baseUrl']; ?>
images/top_bg.gif') repeat-x;
	border:0;
}
img{
    float: left;
}
#Layer1 {
	position:absolute;
	width:155px;
	height:34px;
	color:#fff;
	font-size:12px;
	z-index:1;
	left: 80%;
	top: 45%;	
}
</style>
</head>

<body>
<img src="<?php echo $this->_tpl_vars['topimg']; ?>
" />
<div id="Layer1"><?php echo $this->_tpl_vars['timer']; ?>

</div>
</body>

</html>