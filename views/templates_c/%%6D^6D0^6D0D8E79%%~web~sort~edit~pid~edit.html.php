<?php /* Smarty version 2.6.14, created on 2013-05-02 10:25:15
         compiled from edit.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>门户栏目添加/编辑</title>
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
web/sort/editin">
	<tr class="headbg">
		<td colspan="2">
        	门户栏目<?php if (! $this->_tpl_vars['sort']->uuid): ?>添加<?php else: ?>编辑<?php endif; ?>
        </td>
	</tr>
                <tr>
			        <td>栏目路径:&nbsp;</td>
                    <td>
						顶级栏目<?php unset($this->_sections['path']);
$this->_sections['path']['name'] = 'path';
$this->_sections['path']['loop'] = is_array($_loop=$this->_tpl_vars['path']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['path']['show'] = true;
$this->_sections['path']['max'] = $this->_sections['path']['loop'];
$this->_sections['path']['step'] = 1;
$this->_sections['path']['start'] = $this->_sections['path']['step'] > 0 ? 0 : $this->_sections['path']['loop']-1;
if ($this->_sections['path']['show']) {
    $this->_sections['path']['total'] = $this->_sections['path']['loop'];
    if ($this->_sections['path']['total'] == 0)
        $this->_sections['path']['show'] = false;
} else
    $this->_sections['path']['total'] = 0;
if ($this->_sections['path']['show']):

            for ($this->_sections['path']['index'] = $this->_sections['path']['start'], $this->_sections['path']['iteration'] = 1;
                 $this->_sections['path']['iteration'] <= $this->_sections['path']['total'];
                 $this->_sections['path']['index'] += $this->_sections['path']['step'], $this->_sections['path']['iteration']++):
$this->_sections['path']['rownum'] = $this->_sections['path']['iteration'];
$this->_sections['path']['index_prev'] = $this->_sections['path']['index'] - $this->_sections['path']['step'];
$this->_sections['path']['index_next'] = $this->_sections['path']['index'] + $this->_sections['path']['step'];
$this->_sections['path']['first']      = ($this->_sections['path']['iteration'] == 1);
$this->_sections['path']['last']       = ($this->_sections['path']['iteration'] == $this->_sections['path']['total']);
?>-><?php echo $this->_tpl_vars['path'][$this->_sections['path']['index']]['sortname'];  endfor; endif; ?>
			        </td>
                </tr>
			    <tr>
			        <td>栏目名称:&nbsp;</td>
                    <td>
						<input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['sort']->uuid; ?>
" />
						<input type="hidden" name="pid" value="<?php echo $this->_tpl_vars['pid']; ?>
" />
                        <input type="text" name="sortname" value="<?php echo $this->_tpl_vars['sort']->sortname; ?>
" size="25" />
			        </td>
                </tr>
                <tr>
                    <td>栏目介绍:&nbsp;</td>
                    <td>
                          <textarea name="sortinfo" cols="60" rows="8"><?php echo $this->_tpl_vars['sort']->sortinfo; ?>
</textarea>
			        </td>			
				</tr>
	<tr>
		<td style="text-align:center;" colspan="2">
        <input type="submit" value="保存栏目" class="input" style="height: 28px;font-size:14px;"  />
        </td>
	</tr>
	</form>
</table>
</body>
</html>