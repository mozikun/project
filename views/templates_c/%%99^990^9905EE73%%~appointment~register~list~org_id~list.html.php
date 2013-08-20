<?php /* Smarty version 2.6.14, created on 2013-08-20 12:19:00
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/site.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<link rel="stylesheet" type="text/css"  href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/default/datepicker.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
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
<title><?php echo $this->_tpl_vars['title']; ?>
</title>

</head>
<body>

<script type="text/javascript">
function change_status(data){ 
		$.get("<?php echo $this->_tpl_vars['basePath']; ?>
appointment/register/change_status/data/"+data, function(info){
		//alert(info);
		})
}
 
function del(id){
	if(confirm("确定删除吗?")){
	$.get("<?php echo $this->_tpl_vars['basePath']; ?>
appointment/register/del/id/"+id, function(info){
	window.location.reload();
	})
	}
}  
</script>
	
	<table cellspacing="0">
    <thead>
   
	</thead>
    <tr  class="headbg">
	<th colspan="11" align="center">预约挂号一览表</th>
	</tr>
	<form action="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/register/list" method='post'>
	<tr><td colspan='11'> 
	
	患者姓名<img title="输入患者姓名" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />：<input type="text" name="username" class="line" size="10" value='<?php echo $this->_tpl_vars['username']; ?>
'>&nbsp;
	身份证号<img title="“可以依次输入完整或者部分身份证号”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="identity_number" class="line" size="12" value='<?php echo $this->_tpl_vars['identity_number']; ?>
'>
	科室<img title="输入完整并存在的科室名" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" />:<input type="text" name="department" class="line" size="12" value='<?php echo $this->_tpl_vars['department_search']; ?>
'>
	预约时间：<input type="text" name="time_start" size="10" class="Wdate" onClick="WdatePicker({firstDayOfWeek:1})" value="<?php echo $this->_tpl_vars['time_start']; ?>
"  />-
	           <input type="text" name="time_end" class="Wdate" onClick="WdatePicker({firstDayOfWeek:1})" size="10" value="<?php echo $this->_tpl_vars['time_end']; ?>
" />
	挂号状态：<select id="flag" name='flag'>
				<?php $_from = $this->_tpl_vars['flag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['flag']):
?>
				<option <?php if ($this->_tpl_vars['flag_flag'] == $this->_tpl_vars['k']): ?>selected<?php endif; ?>  value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['flag']; ?>
</option>
			    <?php endforeach; endif; unset($_from); ?>
			</select>		
	&nbsp;<input type="submit" value="搜索" />		
	&nbsp;</td></tr>
	</form>
	<tr class="columnbg">
	<th   >姓名</th>
	<th   >性别</th>
    <th   >年龄</th>
    <th  >预约医生</th>
    <th     >预约时间</th>
	 <th   >身份证号</th>
   <th   >科室</th>
   <th    >诊室</th>
   <th     >号种</th>
   <th    >状态</th>
   <th   ></th>
	</tr>	
	<tbody id=''>
      <?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
     
      <tr >
			<td ><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
			<td ><?php echo $this->_tpl_vars['v']['gender']; ?>
</td>
            <td ><?php echo $this->_tpl_vars['v']['age']; ?>
</td>
            <td ><?php echo $this->_tpl_vars['v']['doctor_name']; ?>
</td>
            <td ><?php echo $this->_tpl_vars['v']['register_time']; ?>
-<?php echo $this->_tpl_vars['v']['day']; ?>
</td>
            <td ><?php echo $this->_tpl_vars['v']['identity_number']; ?>
 </td>
            <td><?php echo $this->_tpl_vars['v']['department_name']; ?>
</td> 
			<td><?php echo $this->_tpl_vars['v']['clinic_name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['v']['number_species_name']; ?>
</td>
			<td>
			<select id="status" onchange="change_status($(this).val())">
				<?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['s']):
?>
				<option <?php if ($this->_tpl_vars['v']['status'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['v']['uuid']; ?>
|<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['s']; ?>
</option>
			    <?php endforeach; endif; unset($_from); ?>
			</select>		
			</td> 
			<td><a href="#" onclick="del('<?php echo $this->_tpl_vars['v']['uuid']; ?>
')">删除</a></td> 
			
           
	  </tr>
         <?php endforeach; else: ?>	
		 <tr><td colspan='11'>暂时没有信息!</td></tr>
		 
	    <?php endif; unset($_from); ?>	
	</tbody>
	
  
    <tr  class="columnbg">
		<td  colspan="11"><div style=" float:left"></div><div style="float:right"><?php echo $this->_tpl_vars['out']; ?>
</div></td>
	</tr>
	</table>


<br />
	</body>
</html>