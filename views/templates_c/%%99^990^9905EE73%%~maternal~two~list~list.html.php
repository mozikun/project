<?php /* Smarty version 2.6.14, created on 2013-05-06 10:32:17
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>孕产妇第2-5次产前随访服务记录列表</title>
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
","prenatal_visit_two","2-5次产前随访","","");},function(){undo_search("<?php echo $this->_tpl_vars['basePath']; ?>
");});
});
</script>
</head>
<body>
<div id="search_list"></div>
<div class="Left_top" id="left_top"><img id="search_listpic" alt="" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/search_list.gif" /></div>
	<table border="0" width="100%">
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
maternal/two/list" id="search" method="POST">
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
    	<th>
        	&nbsp;
        </th>
		<th>
        	姓名
        </th>
        <th>
        	本人电话
        </th>
        <th>
        	随访次数
        </th>
        <th>
        	随访时间
        </th>
		<th>
        	孕次<img title="本次检查时的孕次" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />
        </th>
		<th>
        	产次<img title="本次检查时的产次" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />
        </th>
		<th>
        	末次月经时间<img title="本次检查时的末次月经时间" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />
        </th>
		<th>
        	医生
        </th>
		<th>
        	操作
        </th>
	</tr>
	</thead>
	<tbody id="ma">
	<?php unset($this->_sections['prenatal']);
$this->_sections['prenatal']['name'] = 'prenatal';
$this->_sections['prenatal']['loop'] = is_array($_loop=$this->_tpl_vars['prenatal']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['prenatal']['show'] = true;
$this->_sections['prenatal']['max'] = $this->_sections['prenatal']['loop'];
$this->_sections['prenatal']['step'] = 1;
$this->_sections['prenatal']['start'] = $this->_sections['prenatal']['step'] > 0 ? 0 : $this->_sections['prenatal']['loop']-1;
if ($this->_sections['prenatal']['show']) {
    $this->_sections['prenatal']['total'] = $this->_sections['prenatal']['loop'];
    if ($this->_sections['prenatal']['total'] == 0)
        $this->_sections['prenatal']['show'] = false;
} else
    $this->_sections['prenatal']['total'] = 0;
if ($this->_sections['prenatal']['show']):

            for ($this->_sections['prenatal']['index'] = $this->_sections['prenatal']['start'], $this->_sections['prenatal']['iteration'] = 1;
                 $this->_sections['prenatal']['iteration'] <= $this->_sections['prenatal']['total'];
                 $this->_sections['prenatal']['index'] += $this->_sections['prenatal']['step'], $this->_sections['prenatal']['iteration']++):
$this->_sections['prenatal']['rownum'] = $this->_sections['prenatal']['iteration'];
$this->_sections['prenatal']['index_prev'] = $this->_sections['prenatal']['index'] - $this->_sections['prenatal']['step'];
$this->_sections['prenatal']['index_next'] = $this->_sections['prenatal']['index'] + $this->_sections['prenatal']['step'];
$this->_sections['prenatal']['first']      = ($this->_sections['prenatal']['iteration'] == 1);
$this->_sections['prenatal']['last']       = ($this->_sections['prenatal']['iteration'] == $this->_sections['prenatal']['total']);
?>
	 <tr>
	 	<td>
        	&nbsp;
        </td>
		<td>
        	<?php echo $this->_tpl_vars['prenatal'][$this->_sections['prenatal']['index']]['ssname']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['prenatal'][$this->_sections['prenatal']['index']]['phone_number']; ?>

        </td>
        <td>
        	第<?php echo $this->_tpl_vars['prenatal'][$this->_sections['prenatal']['index']]['follow_count']; ?>
次
        </td>
        <td>
        	<?php echo $this->_tpl_vars['prenatal'][$this->_sections['prenatal']['index']]['follow_time']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['prenatal'][$this->_sections['prenatal']['index']]['prenatal_visit_first']['gravidity']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['prenatal'][$this->_sections['prenatal']['index']]['prenatal_visit_first']['parity']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['prenatal'][$this->_sections['prenatal']['index']]['prenatal_visit_first']['last_menstrual']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['prenatal'][$this->_sections['prenatal']['index']]['staff_name']; ?>

        </td>
		<td>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
maternal/two/view/fid/<?php echo $this->_tpl_vars['prenatal'][$this->_sections['prenatal']['index']]['fid']; ?>
">查看本次随访内容</a>
        </td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="10">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="10">
			<?php if ($this->_tpl_vars['user_id'] != ""): ?>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
maternal/two/list/id/<?php echo $this->_tpl_vars['user_id']; ?>
">-查看当前人员随访记录</a>
			<?php else: ?>
			<a href="<?php echo $this->_tpl_vars['basePath']; ?>
maternal/two/list">-查看全部人员随访记录</a>
			<?php endif; ?>
			&nbsp;<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
	</tbody>
</table>
<input type="hidden" id="error_message" name="error_message" value="<?php echo $this->_tpl_vars['error_message']; ?>
" />
</body>
</html>