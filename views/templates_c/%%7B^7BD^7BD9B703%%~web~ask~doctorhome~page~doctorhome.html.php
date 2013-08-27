<?php /* Smarty version 2.6.14, created on 2013-08-27 09:50:31
         compiled from doctorhome.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>消息列表</title>
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
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>
</head>
<body>		
<table border="0" width="100%">
    <tr class="headbg">
    	<td colspan="4">
        	消息列表
        </td>
	</tr>
    <tr class="title">
    	<td>
        	问题
        </td>
        <td>
        	提问者
        </td>
		<td>
        	提问时间
        </td>
		<td>
        	操作
        </td>
	</tr>
	<tbody id="article">
	<?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['r']):
?>
	 <tr id="">
	 	<td>
        	<?php echo $this->_tpl_vars['r']['question']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['r']['author']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['r']['time']; ?>

        </td>
		<td>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/ask/answerquestion/id/<?php echo $this->_tpl_vars['r']['id']; ?>
">回复</a>
			<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/ask/getanswer/id/<?php echo $this->_tpl_vars['r']['id']; ?>
">查看答案</a>
        </td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<tr><td colspan='4'><?php echo $this->_tpl_vars['page']; ?>
</td></tr>
	</tbody>
</table>

</body>
</html>

	