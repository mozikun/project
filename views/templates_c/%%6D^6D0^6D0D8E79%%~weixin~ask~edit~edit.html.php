<?php /* Smarty version 2.6.14, created on 2013-06-21 15:09:26
         compiled from edit.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加/编辑问题</title>
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
	.nobg table,td,tr
	{
		border:0px;
	}
	.line_table td
	{
		border:1px solid #ccc;
		margin:2px 0px 2px 0px;
	}
	.none
	{
	    border:1px solid #FFF;
		border-bottom:1px solid #ccc;
	}
    .input{
	margin-right:6px;
    border:1px solid #ccc;
    }
</style>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>   <!--时间控件的加载!-->
</head>
<body>
<table border="0" width="100%" class="line_table">
	<form method="post" action="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/ask/editin" >
	<tr class="headbg">
		<td colspan="2">
        	智能问答<?php if (! $this->_tpl_vars['ask']->uuid): ?>添加<?php else: ?>编辑<?php endif; ?>
        </td>
	</tr>
			    <tr>
			        <td>问题:&nbsp;</td>
                    <td>
						<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['ask']->id; ?>
" />
						<input type="text" name="question" value="<?php echo $this->_tpl_vars['ask']->question; ?>
" size="45" />
			        </td>
                </tr>
				<tr>
                    <td>关键字:&nbsp;</td>
                    <td>
						<input type="text" name="keywords" value="<?php echo $this->_tpl_vars['ask']->keywords; ?>
" size="45" />
			        </td>
                </tr>
                <tr>
                    <td>答案:&nbsp;</td>
                    <td>
                          <textarea name="answer"style="width:300px;height:100px;"><?php echo $this->_tpl_vars['ask']->answer; ?>
</textarea>
			        </td>			
				</tr>
                
				<tr>
                    <td>是否启用:&nbsp;</td>
                    <td>
                          <input type="radio" name="isactive" value="1" <?php if ($this->_tpl_vars['ask']->isactive == 1): ?>checked<?php endif; ?> />是<input type="radio" name="isactive" value="2"  <?php if ($this->_tpl_vars['ask']->isactive == 2): ?>checked<?php endif; ?>/>否&nbsp;&nbsp;*默认开启
			        </td>			
				</tr>
                <tr>
                    <td>是否公开:&nbsp;</td>
                    <td>
                          <input type="radio" name="ispublic" value="1" <?php if ($this->_tpl_vars['ask']->ispublic == 1): ?>checked<?php endif; ?> />是<input type="radio" name="ispublic" value="2" <?php if ($this->_tpl_vars['ask']->ispublic == 2): ?>checked<?php endif; ?> />否 &nbsp;&nbsp;*公开表示的是此问题能够被其它机构编辑和删除，是所有机构共享的，默认不公开.
			        </td>			
				</tr>
                
	<tr>
		<td style="text-align:center;" colspan="2">
        	<input type="submit" value="保存内容" class="input" style="height: 28px;font-size:14px;"  /><input type="button" value="返回" class="input" style="height: 28px;font-size:14px;" onclick="history.go(-1);" />
	</tr>
	</form>
</table>
</body>
</html>
