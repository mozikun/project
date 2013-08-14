<?php /* Smarty version 2.6.14, created on 2013-04-27 17:40:53
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
</style>
</head>
<body>
<div class="tbs">
	<table width="100%" height="25px" border="0">
	  <tr>
	  	
		<td width="42%">
			<b>你的位置：</b><span id="url"><span id="hse">暂无选项卡!</span></span>		</td>
		
	  <td width="3%">
			<span id="meg" style="display:none;">&nbsp;<sup><b id="megvalue"></b></sup></span>		</td>
		
	  <td width="13%">			
			<b>居&nbsp;民：</b><span id="name"><span id="patient" style="color:green"><?php echo $this->_tpl_vars['patient']; ?>
</span></span>		</td>
		
	  <td width="23%">
			<b>工作人员：</b><span style="color:#000000"><?php echo $this->_tpl_vars['yisheng']; ?>
[<?php echo $this->_tpl_vars['role_name']; ?>
]</span>		</td>
		
	    <td width="20%">
			<b>机&nbsp;构：</b><span style="color:#000000"><?php echo $this->_tpl_vars['org_name']; ?>
</span>		</td>
	        
      </td>
	  </tr>
	</table>
</div>
</body>
</html>