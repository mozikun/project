<?php /* Smarty version 2.6.14, created on 2013-09-15 11:25:11
         compiled from error.html */ ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
fieldset{
	width:90%;
	border:1px solid #ff9900;
	text-align:left;
	color:#ff9900;
	font-size:14px;
	padding:8px;
}
fieldset legend{
	border:2px solid #ff9900;
	color:#FF0000;
	padding:2px;
	margin:2px;
	font-weight:bold;
}

</style>
<fieldset>
<legend >错误</legend>
<br />
<?php echo $this->_tpl_vars['error_message']; ?>

<br /><br />
<a href="<?php echo $this->_tpl_vars['__BASEPATH']; ?>
">返回首页</a>
<br /><br />
<a href="##" onclick="document.history.back(-1)">返回</a>
</fieldset>