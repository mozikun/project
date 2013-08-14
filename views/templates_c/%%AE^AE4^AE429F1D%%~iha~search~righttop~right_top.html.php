<?php /* Smarty version 2.6.14, created on 2013-07-23 11:03:25
         compiled from right_top.html */ ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<style type="text/css">
body {margin:0px;padding:0px;}
table,tr,td{ height:22px;margin:0px;padding:0px; font-size:13px;margin-bottom:12px;}
.tbs{ margin:0px;padding:0px;margin-left:8px;margin-right:10px;}  /*有变动的话 添加(height:27px;)*/
table{
    border-bottom: 1px solid #999999;
}
.tp{margin:0px;padding:0px;margin-left:3px;margin-right:4px; font-weight:bold}  
#hse{color:#999999}
td{padding-left: 4px;padding-right: 4px;}
span{font-weight: bold;}
</style>
</head>
<body>
<div class="tbs">
	<table width="100%" height="25px" border="0">
	  <tr>
      <td>
	  姓名：<span><?php echo $this->_tpl_vars['user']->name; ?>
 </span>
      </td>
      <td>性别：<span><?php echo $this->_tpl_vars['user']->sex; ?>
</span> </td>
      <td>出生日期：<span><?php echo $this->_tpl_vars['user']->birth_day; ?>
 </span></td>
      <td>年龄：<span><?php echo $this->_tpl_vars['user']->age; ?>
 </span></td>
      <td>身份证号：<span><?php echo $this->_tpl_vars['user']->identity_number; ?>
</span></td>
      <td>住址：<span><?php echo $this->_tpl_vars['user']->address; ?>
</span></td>
	  </tr>
	</table>
</div>
</body>
</html>