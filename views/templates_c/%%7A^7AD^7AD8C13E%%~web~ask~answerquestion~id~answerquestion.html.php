<?php /* Smarty version 2.6.14, created on 2013-08-22 17:36:17
         compiled from answerquestion.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>问题回复</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<style>
	table
	{
		background:#ffffff;
	}
	.line
	{
		border-top:0px;
		border-left:0px;
		border-right:0px;
	}
</style>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
</head>
<body>		
<table border="0" width="100%">
    <tr class="headbg">
    	<td >
        	问题回复
        </td>
	</tr>
    
	<tbody id="article">
	
	 <tr id="">
	 	
		<td>
        	问题：<?php echo $this->_tpl_vars['ask']->question; ?>

        </td>
		
	</tr>
	 <tr id="">
	 	<td>
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
ask/saveanswer" method="post">
        	<textarea name="answer" style="width:500px;height:100px;"></textarea>
			<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['ask']->id; ?>
"/>
			</br>
			<input type='submit' value="提交"/>
			<input type='button' value="返回" onclick="history.go(-1);"/>
		</form>	
        </td>
		
		
	</tr>
	</tbody>
</table>
</body>
</html>

	