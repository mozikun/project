<?php /* Smarty version 2.6.14, created on 2013-05-06 15:53:08
         compiled from children_index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>3岁以内儿童健康检查记录表</title>
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
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/ajax_select_region.js"  type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
 
     //下拉地区
     get_region_select_html('<?php echo $this->_tpl_vars['basePath']; ?>
','region_p_id_','menuDropDownBox_address');
	
	if("<?php echo $this->_tpl_vars['display']; ?>
"=="on"){
		$("#tbody_search").show();
		$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");
	}else{
		$("#tbody_search").hide();
		$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png");
	}
	$("#search_lable").toggle(function(){
		$("#tbody_search").show();
		$("#search").attr("action","<?php echo $this->_tpl_vars['basePath']; ?>
children/children/index/display/on");
		$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_out.png");},function(){$("#tbody_search").hide();
		$("#search_lable>img").attr("src","<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png");
		$("#search").attr("action","<?php echo $this->_tpl_vars['basePath']; ?>
children/children/index/display/off");
		});
});
</script>
</head>
<body>
	<table border="0" width="100%">
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
children/children/index" id="search" method="POST">
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
				
				
			   <label id="search_lable" style="cursor:pointer;"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/zoom_in.png" />高级搜索</label><img title="请尽量使用普通搜索，并且限制搜索条件详细一些，否则会耗费过长的时间" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />
				</td>
			</tr>
			<tr id="tbody_search"><td>
				随访时间段:<input type="text" name="created_start_time" value="<?php echo $this->_tpl_vars['created_start_time']; ?>
"  class="inputnone2" onClick="WdatePicker({firstDayOfWeek:1})" >
						  --<input type="text" name="created_end_time" value="<?php echo $this->_tpl_vars['created_end_time']; ?>
"  class="inputnone2" onClick="WdatePicker({firstDayOfWeek:1})" >
				<br />所属地区:<span id="menuDropDownBox_address"></span>	
					<input type="hidden" name="region_p_id" id="region_p_id_" value="<?php echo $this->_tpl_vars['region_p_id']; ?>
" />
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
        	上次检查时间
        </th>
		<th>
        	上次检查医生
        </th>
		<th>
        	检查次数
        </th>
		<th>
        	操作
        </th>
	</tr>
	</thead>
	<tbody id="hy">
	<?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=$this->_tpl_vars['child_physical_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>
	 <tr id="hy_<?php echo $this->_tpl_vars['child_physical_array'][$this->_sections['custom']['index']]['uuid']; ?>
">
	 	<td>&nbsp;
        	
        </td>
		<td>
        	<?php echo $this->_tpl_vars['child_physical_array'][$this->_sections['custom']['index']]['ssname']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['child_physical_array'][$this->_sections['custom']['index']]['followup_time']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['child_physical_array'][$this->_sections['custom']['index']]['followup_doctor']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['child_physical_array'][$this->_sections['custom']['index']]['snums']; ?>

        </td>
		<td>
        	 <a href="<?php echo $this->_tpl_vars['basePath']; ?>
children/children/list/id/<?php echo $this->_tpl_vars['child_physical_array'][$this->_sections['custom']['index']]['id']; ?>
">进入查看</a>
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
        	&nbsp;<?php echo $this->_tpl_vars['pager']; ?>

        </td>
	</tr>
	</tbody>
</table>
<input type="hidden" id="error_message" name="error_message" value="<?php echo $this->_tpl_vars['error_message']; ?>
" />
</body>
</html>