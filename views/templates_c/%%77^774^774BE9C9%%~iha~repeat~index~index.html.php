<?php /* Smarty version 2.6.14, created on 2013-05-24 10:52:28
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>个人档案查重</title>
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
	.table_mouseover{
		background:#cccccc;
	}
	.table_mouseout{
		background:#ffffff;
	}
	.line
	{
		border-top:0px;
		border-left:0px;
		border-right:0px;
	}
</style>
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
</head>
<body>
<form action="<?php echo $this->_tpl_vars['basePath']; ?>
iha/repeat/index" id="search" method="POST" >
	<table border="0" width="100%">
		<tr><td>身份证号<img title="“可以依次输入完整或者部分身份证号”" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/comments.png" class="vtip" />:
		<input type="text" id="identity" name="standard_code" />&nbsp;&nbsp; 
		管辖地区内重复档案：<input  name="token" value="1" type="checkbox" <?php if ($this->_tpl_vars['token'] == 1): ?>checked="checked"<?php endif; ?>>
		 <input type="submit" value="搜索"  />&nbsp;&nbsp;<input type="button" value="管辖地区与其他地区重复档案" onclick="window.location.href='<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/repeat/list'" /></td></tr>
	</table>
</form>    
	<table border="0" width="100%">
	<thead id="title">
	    <tr class="headbg">
	        <th>
	        	身份证号
	        </th>
			<th>
	        	重复数
	        </th>
			<th>
	        	操作
	        </th>	
		</tr>
	</thead>
	<tbody id="iha">
	<?php unset($this->_sections['individual']);
$this->_sections['individual']['name'] = 'individual';
$this->_sections['individual']['loop'] = is_array($_loop=$this->_tpl_vars['individual']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['individual']['show'] = true;
$this->_sections['individual']['max'] = $this->_sections['individual']['loop'];
$this->_sections['individual']['step'] = 1;
$this->_sections['individual']['start'] = $this->_sections['individual']['step'] > 0 ? 0 : $this->_sections['individual']['loop']-1;
if ($this->_sections['individual']['show']) {
    $this->_sections['individual']['total'] = $this->_sections['individual']['loop'];
    if ($this->_sections['individual']['total'] == 0)
        $this->_sections['individual']['show'] = false;
} else
    $this->_sections['individual']['total'] = 0;
if ($this->_sections['individual']['show']):

            for ($this->_sections['individual']['index'] = $this->_sections['individual']['start'], $this->_sections['individual']['iteration'] = 1;
                 $this->_sections['individual']['iteration'] <= $this->_sections['individual']['total'];
                 $this->_sections['individual']['index'] += $this->_sections['individual']['step'], $this->_sections['individual']['iteration']++):
$this->_sections['individual']['rownum'] = $this->_sections['individual']['iteration'];
$this->_sections['individual']['index_prev'] = $this->_sections['individual']['index'] - $this->_sections['individual']['step'];
$this->_sections['individual']['index_next'] = $this->_sections['individual']['index'] + $this->_sections['individual']['step'];
$this->_sections['individual']['first']      = ($this->_sections['individual']['iteration'] == 1);
$this->_sections['individual']['last']       = ($this->_sections['individual']['iteration'] == $this->_sections['individual']['total']);
?>
	 <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
        <td>
        <?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['identity_number']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['nums']; ?>

        </td>
		<td>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/repeat/list/uuid/<?php echo $this->_tpl_vars['individual'][$this->_sections['individual']['index']]['identity_number']; ?>
/token/<?php echo $this->_tpl_vars['token']; ?>
">查看</a>
        </td>
	</tr>
	
	<?php endfor; else: ?>
	<tr>
		<td colspan="3">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="3">
        	<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
	</tbody>
</table>
</body>