<?php /* Smarty version 2.6.14, created on 2013-11-05 14:18:19
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>体格检查</title>
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
	/*左上角*/
.Left_top {right:0;top:0;position:fixed;+position:absolute;top:expression(parseInt(document.body.scrollTop));}
</style>
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/search_list.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$("#search_listpic").toggle(function(){do_search("<?php echo $this->_tpl_vars['basePath']; ?>
","","","","");},function(){undo_search("<?php echo $this->_tpl_vars['basePath']; ?>
");});
});
</script>
</head>
<body>
<div id="search_list"></div>
	<table border="0" width="100%">
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
gp/physical/index" id="search" method="POST">
			<tr><td>
				姓名<img title="“可以输入汉字也可以输入姓名拼音的首字母，比如要查找'王高兴',那么可以输入姓名的三个汉字中的任意一个，也可以输入‘wxm’几个字母进行搜索查找”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />：<input type="text" name="username" value="<?php echo $this->_tpl_vars['search']['username']; ?>
" class="line" size="10">&nbsp;
				档案号<img title="“输入标准档案号里的全部或者部分数字”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="standard_code" value="<?php echo $this->_tpl_vars['search']['standard_code']; ?>
" class="line" size="10">&nbsp;
				身份证号<img title="“可以输入完整或者部分身份证号”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="identity_number" value="<?php echo $this->_tpl_vars['search']['identity_number']; ?>
" class="line" size="12">&nbsp;
				随访医生:<select name="staff_id" id="staff_id">
			<?php unset($this->_sections['response_doctor']);
$this->_sections['response_doctor']['name'] = 'response_doctor';
$this->_sections['response_doctor']['loop'] = is_array($_loop=$this->_tpl_vars['response_doctor']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['response_doctor']['show'] = true;
$this->_sections['response_doctor']['max'] = $this->_sections['response_doctor']['loop'];
$this->_sections['response_doctor']['step'] = 1;
$this->_sections['response_doctor']['start'] = $this->_sections['response_doctor']['step'] > 0 ? 0 : $this->_sections['response_doctor']['loop']-1;
if ($this->_sections['response_doctor']['show']) {
    $this->_sections['response_doctor']['total'] = $this->_sections['response_doctor']['loop'];
    if ($this->_sections['response_doctor']['total'] == 0)
        $this->_sections['response_doctor']['show'] = false;
} else
    $this->_sections['response_doctor']['total'] = 0;
if ($this->_sections['response_doctor']['show']):

            for ($this->_sections['response_doctor']['index'] = $this->_sections['response_doctor']['start'], $this->_sections['response_doctor']['iteration'] = 1;
                 $this->_sections['response_doctor']['iteration'] <= $this->_sections['response_doctor']['total'];
                 $this->_sections['response_doctor']['index'] += $this->_sections['response_doctor']['step'], $this->_sections['response_doctor']['iteration']++):
$this->_sections['response_doctor']['rownum'] = $this->_sections['response_doctor']['iteration'];
$this->_sections['response_doctor']['index_prev'] = $this->_sections['response_doctor']['index'] - $this->_sections['response_doctor']['step'];
$this->_sections['response_doctor']['index_next'] = $this->_sections['response_doctor']['index'] + $this->_sections['response_doctor']['step'];
$this->_sections['response_doctor']['first']      = ($this->_sections['response_doctor']['iteration'] == 1);
$this->_sections['response_doctor']['last']       = ($this->_sections['response_doctor']['iteration'] == $this->_sections['response_doctor']['total']);
?>
			<option value="<?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['id']; ?>
" <?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['zh_name']; ?>
</option>
			<?php endfor; endif; ?>
			</select>
		&nbsp;
				
				<input type="submit" value="搜索">
				
				</td>
			</tr>
			</form>
</table>	
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
    	<th>&nbsp;
        	
        </th>
		<th>
        	姓名
        </th>
		<th>
        	体检日期
        </th>
        <th>
        	模块名
        </th>
		<th>
        	身高(cm)
        </th>
		<th>
        	体重(kg)
        </th>
		<th>
        	操作
        </th>
	</tr>
	</thead>
	<tbody id="hy">
	<?php unset($this->_sections['physical']);
$this->_sections['physical']['name'] = 'physical';
$this->_sections['physical']['loop'] = is_array($_loop=$this->_tpl_vars['physical']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['physical']['show'] = true;
$this->_sections['physical']['max'] = $this->_sections['physical']['loop'];
$this->_sections['physical']['step'] = 1;
$this->_sections['physical']['start'] = $this->_sections['physical']['step'] > 0 ? 0 : $this->_sections['physical']['loop']-1;
if ($this->_sections['physical']['show']) {
    $this->_sections['physical']['total'] = $this->_sections['physical']['loop'];
    if ($this->_sections['physical']['total'] == 0)
        $this->_sections['physical']['show'] = false;
} else
    $this->_sections['physical']['total'] = 0;
if ($this->_sections['physical']['show']):

            for ($this->_sections['physical']['index'] = $this->_sections['physical']['start'], $this->_sections['physical']['iteration'] = 1;
                 $this->_sections['physical']['iteration'] <= $this->_sections['physical']['total'];
                 $this->_sections['physical']['index'] += $this->_sections['physical']['step'], $this->_sections['physical']['iteration']++):
$this->_sections['physical']['rownum'] = $this->_sections['physical']['iteration'];
$this->_sections['physical']['index_prev'] = $this->_sections['physical']['index'] - $this->_sections['physical']['step'];
$this->_sections['physical']['index_next'] = $this->_sections['physical']['index'] + $this->_sections['physical']['step'];
$this->_sections['physical']['first']      = ($this->_sections['physical']['iteration'] == 1);
$this->_sections['physical']['last']       = ($this->_sections['physical']['iteration'] == $this->_sections['physical']['total']);
?>
	 <tr>
	 	<td>&nbsp;
        	
        </td>
		<td>
        	<?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['ssname']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['experience_time']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['module_name']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['height']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['weight']; ?>

        </td>
		<td>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
gp/physical/add/uuid/<?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['uuid']; ?>
">编辑</a>
            <a href="<?php echo $this->_tpl_vars['basePath']; ?>
gp/physical/del/uuid/<?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['uuid']; ?>
" onClick="javascript:if(confirm('确定要删除 <?php echo $this->_tpl_vars['physical'][$this->_sections['physical']['index']]['ssname']; ?>
 的 体检检查-基本检查 信息吗？')){return true;}else{return false;}">删除</a>
        </td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="7">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="7">
        	&nbsp;<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
	</tbody>
</table>
<input type="hidden" id="error_message" name="error_message" value="<?php echo $this->_tpl_vars['error_message']; ?>
" />
<div class="Left_top" id="left_top"><img id="search_listpic" alt="" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/search_list.gif" /></div>

</body>
</html>