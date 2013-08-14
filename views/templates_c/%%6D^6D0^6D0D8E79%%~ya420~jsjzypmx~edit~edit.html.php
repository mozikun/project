<?php /* Smarty version 2.6.14, created on 2013-04-27 20:15:31
         compiled from edit.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>四川雅安“4.20”地震接受捐赠药品明细表</title>
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
    .line{
        border:1px solid #ccc;
        width: 96%;
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
ya420/jsjzypmx/editin">
	<tr class="headbg">
		<td colspan="10">
        	四川雅安“4.20”地震接受捐赠药品明细<?php if (! $this->_tpl_vars['jsjzypmx']->uuid): ?>添加<?php else: ?>编辑<?php endif; ?>
        </td>
	</tr>
			    <tr class="columnbg">
			        <td colspan="2">口服药品</td>
                    <td colspan="2">注射剂</td>
                    <td colspan="2">抗生素</td>
                    <td colspan="2">毒麻药品</td>
                    <td colspan="2">外用药品</td>
                </tr>
                <tr class="title">
                <td>品种</td><td>金额</td>
                <td>品种</td><td>金额</td>
                <td>品种</td><td>金额</td>
                <td>品种</td><td>金额</td>
                <td>品种</td><td>金额</td>
                </tr>
                <tr>
                <td><input type="text" name="items[kfyppz]" class="line" value="<?php echo $this->_tpl_vars['jsjzypmx']->kfyppz; ?>
" /></td><td><input type="text" name="items[kfypje]" class="line" value="<?php echo $this->_tpl_vars['jsjzypmx']->kfypje; ?>
" /></td>
                <td><input type="text" name="items[zsyppz]" class="line" value="<?php echo $this->_tpl_vars['jsjzypmx']->zsyppz; ?>
" /></td><td><input type="text" name="items[zsypje]" class="line" value="<?php echo $this->_tpl_vars['jsjzypmx']->zsypje; ?>
" /></td>
                <td><input type="text" name="items[ksyppz]" class="line" value="<?php echo $this->_tpl_vars['jsjzypmx']->ksyppz; ?>
" /></td><td><input type="text" name="items[ksypje]" class="line" value="<?php echo $this->_tpl_vars['jsjzypmx']->ksypje; ?>
" /></td>
                <td><input type="text" name="items[dmyppz]" class="line" value="<?php echo $this->_tpl_vars['jsjzypmx']->dmyppz; ?>
" /></td><td><input type="text" name="items[dmypje]" class="line" value="<?php echo $this->_tpl_vars['jsjzypmx']->dmypje; ?>
" /></td>
                <td><input type="text" name="items[yyyppz]" class="line" value="<?php echo $this->_tpl_vars['jsjzypmx']->yyyppz; ?>
" /></td><td><input type="text" name="items[yyypje]" class="line" value="<?php echo $this->_tpl_vars['jsjzypmx']->yyypje; ?>
" /></td>
                </tr>
	<tr>
		<td style="text-align:center;" colspan="10">
            <input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['jsjzypmx']->uuid; ?>
" />
        	<input type="submit" value="保存内容" class="input" style="height: 28px;font-size:14px;"  />
	</tr>
	</form>
</table>
</body>
</html>