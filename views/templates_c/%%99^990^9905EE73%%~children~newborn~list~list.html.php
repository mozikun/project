<?php /* Smarty version 2.6.14, created on 2013-05-06 15:53:06
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>新生儿家庭访视列表</title>
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
	.ablock{
	dispaly:block;
	width:10px;
	heigth:5px;
	border:1px solid black;
	background:#6691DB;
	color:#FFFFFF;
	}
</style>
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
</head>
<body>
	<table border="0" width="100%">
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
children/newborn/list" id="search" method="POST">
			<tr><td>
				姓名<img title="“输入汉字”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />：                                                                   <input type="text" name="username"  class="line" size="10"/>&nbsp;
				档案号<img title="“输入标准档案号里的全部或者部分数字”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="standard_code"  class="line" size="10"/>&nbsp;
				身份证号<img title="“可以输入完整或者部分身份证号”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:    <input type="text" name="identity_number"  class="line" size="12"/>&nbsp;
				筛查<img title="“可以完成新生儿疾病筛查和出生缺陷监测”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:   
				<select name="sc">
				   <option value="-9">请选择...</option>
				   <option value="1">新生儿疾病筛查</option>
				   <option value="2">出生缺陷监测</option>
				</select>
				&nbsp;
				随访医生:<select name="staff_id" id="staff_id">
			<option value="-9">请选择...</option>
			<option value="<?php echo $this->_tpl_vars['currentstaffid']; ?>
"><?php echo $this->_tpl_vars['currentstaffname_real']; ?>
</option>
			<?php unset($this->_sections['realstafflist']);
$this->_sections['realstafflist']['name'] = 'realstafflist';
$this->_sections['realstafflist']['loop'] = is_array($_loop=$this->_tpl_vars['realstafflist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['realstafflist']['show'] = true;
$this->_sections['realstafflist']['max'] = $this->_sections['realstafflist']['loop'];
$this->_sections['realstafflist']['step'] = 1;
$this->_sections['realstafflist']['start'] = $this->_sections['realstafflist']['step'] > 0 ? 0 : $this->_sections['realstafflist']['loop']-1;
if ($this->_sections['realstafflist']['show']) {
    $this->_sections['realstafflist']['total'] = $this->_sections['realstafflist']['loop'];
    if ($this->_sections['realstafflist']['total'] == 0)
        $this->_sections['realstafflist']['show'] = false;
} else
    $this->_sections['realstafflist']['total'] = 0;
if ($this->_sections['realstafflist']['show']):

            for ($this->_sections['realstafflist']['index'] = $this->_sections['realstafflist']['start'], $this->_sections['realstafflist']['iteration'] = 1;
                 $this->_sections['realstafflist']['iteration'] <= $this->_sections['realstafflist']['total'];
                 $this->_sections['realstafflist']['index'] += $this->_sections['realstafflist']['step'], $this->_sections['realstafflist']['iteration']++):
$this->_sections['realstafflist']['rownum'] = $this->_sections['realstafflist']['iteration'];
$this->_sections['realstafflist']['index_prev'] = $this->_sections['realstafflist']['index'] - $this->_sections['realstafflist']['step'];
$this->_sections['realstafflist']['index_next'] = $this->_sections['realstafflist']['index'] + $this->_sections['realstafflist']['step'];
$this->_sections['realstafflist']['first']      = ($this->_sections['realstafflist']['iteration'] == 1);
$this->_sections['realstafflist']['last']       = ($this->_sections['realstafflist']['iteration'] == $this->_sections['realstafflist']['total']);
?>
			<option value="<?php echo $this->_tpl_vars['realstafflist'][$this->_sections['realstafflist']['index']]['user_id']; ?>
"><?php echo $this->_tpl_vars['realstafflist'][$this->_sections['realstafflist']['index']]['name_real']; ?>
</option>
			<?php endfor; endif; ?>
			</select>
		&nbsp;
				
				<input type="submit"  name="search" value="搜索">
				
				</td>
			</tr>
			</form>
</table>	
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
    	<th>
        	&nbsp;
        </th>
		<th>
        	姓名
        </th>
		<th>
        	各次家庭访视列表
        </th>
	</tr>
	</thead>
	<tbody id="hy">
	<?php unset($this->_sections['list']);
$this->_sections['list']['name'] = 'list';
$this->_sections['list']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['list']['show'] = true;
$this->_sections['list']['max'] = $this->_sections['list']['loop'];
$this->_sections['list']['step'] = 1;
$this->_sections['list']['start'] = $this->_sections['list']['step'] > 0 ? 0 : $this->_sections['list']['loop']-1;
if ($this->_sections['list']['show']) {
    $this->_sections['list']['total'] = $this->_sections['list']['loop'];
    if ($this->_sections['list']['total'] == 0)
        $this->_sections['list']['show'] = false;
} else
    $this->_sections['list']['total'] = 0;
if ($this->_sections['list']['show']):

            for ($this->_sections['list']['index'] = $this->_sections['list']['start'], $this->_sections['list']['iteration'] = 1;
                 $this->_sections['list']['iteration'] <= $this->_sections['list']['total'];
                 $this->_sections['list']['index'] += $this->_sections['list']['step'], $this->_sections['list']['iteration']++):
$this->_sections['list']['rownum'] = $this->_sections['list']['iteration'];
$this->_sections['list']['index_prev'] = $this->_sections['list']['index'] - $this->_sections['list']['step'];
$this->_sections['list']['index_next'] = $this->_sections['list']['index'] + $this->_sections['list']['step'];
$this->_sections['list']['first']      = ($this->_sections['list']['iteration'] == 1);
$this->_sections['list']['last']       = ($this->_sections['list']['iteration'] == $this->_sections['list']['total']);
?>
	 <tr id="hy_<?php echo $this->_tpl_vars['list'][$this->_sections['list']['index']]['uuid']; ?>
">
	 	<td>
        	&nbsp;
        </td>
		<td>
        	<?php echo $this->_tpl_vars['list'][$this->_sections['list']['index']]['name']; ?>

        </td>
		<td>
        	<?php unset($this->_sections['c']);
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['list'][$this->_sections['list']['index']]['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
        	   <a href="<?php echo $this->_tpl_vars['basePath']; ?>
children/newborn/index/uuid/<?php echo $this->_tpl_vars['list'][$this->_sections['list']['index']]['list'][$this->_sections['c']['index']]['uuid']; ?>
/currentpage/<?php echo $this->_tpl_vars['currentpage']; ?>
" class="ablock"><strong>第<?php echo $this->_sections['c']['iteration']; ?>
次家庭访视记录</strong></a>
        	<?php endfor; endif; ?>
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
        	&nbsp;<?php echo $this->_tpl_vars['page']; ?>

        </td>
	</tr>
	</tbody>
</table>
<input type="hidden" id="error_message" name="error_message" value="<?php echo $this->_tpl_vars['error_message']; ?>
" />
</body>
</html>