<?php /* Smarty version 2.6.14, created on 2013-08-27 09:46:37
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加问题</title>
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

</head>
<body>		
<table border="0" width="100%">
    <tr class="headbg">
    	<td >
        	添加问题
        </td>
	</tr>
    
	<tbody id="article">
	 <tr id="">
	 	<td>
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
web/ask/ask" method="post" onSubmit="return check()">
        	<textarea name="question" id="question" style="width:500px;height:100px;"></textarea>
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
<script>
	function check(){ 
		var question=document.getElementById("question").value;
		if(question==""){
			alert("问题不能为空");
			return false;
		}
	}
</script>
	