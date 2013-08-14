<?php /* Smarty version 2.6.14, created on 2013-06-20 12:00:42
         compiled from add.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>微信通知管理</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/choice.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/ajax_select_region.js"></script>
<style>
.table_mouseover{
	background:#cccccc;
}
.table_mouseout{
	background:#ffffff;
}
.inputbutton{
border: 1px solid blue;
width:80px;
background:#FFFFFF;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$("input[type='submit']").click(function(){
	  	$title= $("#title").val();
	  	$content=$("#content").val();
	  	if($title==""){
	  		alert("标题不能为空！");
	  		return false;
	  	}
	  	if($content==""){
	  		alert("内容不能为空！");
	  		return false;
	  	}
  	});
});
</script>
</head>
<body>
<table border="0" width="100%">
    <tr class="headbg">
      <td>
		<strong>微信通知<?php if ($this->_tpl_vars['flag']): ?>添加<?php else: ?>修改<?php endif; ?></strong>
	  </td>
	</tr>
</table>	
<form action="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/notice/add" id="search" method="post">
<table border="0" width="100%">
	 <tr>
	 	<td>标题：</td>
	 	<td><input type="text" name="title" id="title" value="<?php echo $this->_tpl_vars['title']; ?>
" /></td>
	 </tr>
	 <tr>
	 	<td>内容：</td>
	 	<td><textarea name="content" id="content" cols="60" rows="8"><?php echo $this->_tpl_vars['content']; ?>
</textarea></td>
	 </tr>
	 <tr>	
        <td colspan="2">
	        <input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
" />
	        <input type="submit" name="submit" value="保存"/>
	        <input type="button" name="button" value="返回" onclick="javascript:location.href='<?php echo $this->_tpl_vars['basePath']; ?>
weixin/notice/index'" />
        </td>
   	</tr>
</table>
</form>
</body>
</html>