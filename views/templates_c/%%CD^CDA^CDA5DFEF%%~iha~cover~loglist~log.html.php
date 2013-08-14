<?php /* Smarty version 2.6.14, created on 2013-08-14 11:34:51
         compiled from log.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en" />
<meta name="GENERATOR" content="Zend Studio" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
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
.bigfont{
    background:#DAE6F3;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	var id      =$("select[name='org']").val();
	var staff_id=$("input[name='staff']").val();//获取选中医生的id
	getVal(id,staff_id);
	
})
	function getVal(id,staff_id)
	{
//		alert(staff_id);
		$.get("<?php echo $this->_tpl_vars['basePath']; ?>
iha/cover/getStaff/org_id/"+id+"/staff_id/"+staff_id,function(data){
//			alert(data);
			$("select[name='staff_id']").empty();
			$("select[name='staff_id']").append(data);
		});
	}
</script>
<title>日志列表</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" media="all" type="text/css" rel="stylesheet"/>
</head>
<body>
     <table border="1px" align="center" width="100%">
     <form method="POST" action="">
	     <tr class="headbg">
	       <td colspan="8">
	       		时间：<input type="text" name="start_time"  onClick="WdatePicker({firstDayOfWeek:1})"  value=""  id="start_time"/>-
	       			 <input type="text" name="end_time"  onClick="WdatePicker({firstDayOfWeek:1})" value=""  id="end_time"/>&nbsp;  
	       		表名：<select name="table_name">
	       				<option value="">请选择</option>
	       				<?php unset($this->_sections['row']);
$this->_sections['row']['loop'] = is_array($_loop=$this->_tpl_vars['arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['row']['name'] = 'row';
$this->_sections['row']['show'] = true;
$this->_sections['row']['max'] = $this->_sections['row']['loop'];
$this->_sections['row']['step'] = 1;
$this->_sections['row']['start'] = $this->_sections['row']['step'] > 0 ? 0 : $this->_sections['row']['loop']-1;
if ($this->_sections['row']['show']) {
    $this->_sections['row']['total'] = $this->_sections['row']['loop'];
    if ($this->_sections['row']['total'] == 0)
        $this->_sections['row']['show'] = false;
} else
    $this->_sections['row']['total'] = 0;
if ($this->_sections['row']['show']):

            for ($this->_sections['row']['index'] = $this->_sections['row']['start'], $this->_sections['row']['iteration'] = 1;
                 $this->_sections['row']['iteration'] <= $this->_sections['row']['total'];
                 $this->_sections['row']['index'] += $this->_sections['row']['step'], $this->_sections['row']['iteration']++):
$this->_sections['row']['rownum'] = $this->_sections['row']['iteration'];
$this->_sections['row']['index_prev'] = $this->_sections['row']['index'] - $this->_sections['row']['step'];
$this->_sections['row']['index_next'] = $this->_sections['row']['index'] + $this->_sections['row']['step'];
$this->_sections['row']['first']      = ($this->_sections['row']['iteration'] == 1);
$this->_sections['row']['last']       = ($this->_sections['row']['iteration'] == $this->_sections['row']['total']);
?>
	       				<option value="<?php echo $this->_tpl_vars['arr'][$this->_sections['row']['index']]['table_name']; ?>
" <?php if (( $this->_tpl_vars['table_name'] == $this->_tpl_vars['arr'][$this->_sections['row']['index']]['table_name'] )): ?> selected='selected'<?php endif; ?> ><?php echo $this->_tpl_vars['arr'][$this->_sections['row']['index']]['table_name']; ?>
</option>
	       				<?php endfor; endif; ?>
	       			</select>     
				 动作名称：
				 <select name="action">
				    <option value="">请选择</option>
				 	<option value="insert" <?php if (( $this->_tpl_vars['action'] == insert )): ?> selected='selected'<?php endif; ?> >新增</option>
				 	<option value="update" <?php if (( $this->_tpl_vars['action'] == update )): ?> selected='selected'<?php endif; ?> >更新</option>
				 	<option value="delete" <?php if (( $this->_tpl_vars['action'] == delete )): ?> selected='selected'<?php endif; ?> >删除</option>
				 </select>  <br />
				 机构名称：
				 <select name="org" id="org" onchange="getVal(this.value)">
				 	<option value="">请选择</option>
				 	<?php unset($this->_sections['row']);
$this->_sections['row']['loop'] = is_array($_loop=$this->_tpl_vars['org_name']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['row']['name'] = 'row';
$this->_sections['row']['show'] = true;
$this->_sections['row']['max'] = $this->_sections['row']['loop'];
$this->_sections['row']['step'] = 1;
$this->_sections['row']['start'] = $this->_sections['row']['step'] > 0 ? 0 : $this->_sections['row']['loop']-1;
if ($this->_sections['row']['show']) {
    $this->_sections['row']['total'] = $this->_sections['row']['loop'];
    if ($this->_sections['row']['total'] == 0)
        $this->_sections['row']['show'] = false;
} else
    $this->_sections['row']['total'] = 0;
if ($this->_sections['row']['show']):

            for ($this->_sections['row']['index'] = $this->_sections['row']['start'], $this->_sections['row']['iteration'] = 1;
                 $this->_sections['row']['iteration'] <= $this->_sections['row']['total'];
                 $this->_sections['row']['index'] += $this->_sections['row']['step'], $this->_sections['row']['iteration']++):
$this->_sections['row']['rownum'] = $this->_sections['row']['iteration'];
$this->_sections['row']['index_prev'] = $this->_sections['row']['index'] - $this->_sections['row']['step'];
$this->_sections['row']['index_next'] = $this->_sections['row']['index'] + $this->_sections['row']['step'];
$this->_sections['row']['first']      = ($this->_sections['row']['iteration'] == 1);
$this->_sections['row']['last']       = ($this->_sections['row']['iteration'] == $this->_sections['row']['total']);
?>
				 	<option value="<?php echo $this->_tpl_vars['org_name'][$this->_sections['row']['index']]['id']; ?>
" <?php if (( $this->_tpl_vars['org'] == $this->_tpl_vars['org_name'][$this->_sections['row']['index']]['id'] )): ?> selected='selected'<?php endif; ?> ><?php echo $this->_tpl_vars['org_name'][$this->_sections['row']['index']]['zh_name']; ?>
</option>
				 	<?php endfor; endif; ?>
				 </select> 
				  医生：<select name="staff_id" id="staff_id">
				           <option value="">请选择</option>
				       </select>      
				       <input type="hidden" name="staff" id="staff" value="<?php echo $this->_tpl_vars['staff_id']; ?>
" />
		         <input type="submit" value="搜索" class="inputbutton" id="mysubmit"/>&nbsp;&nbsp;</td>
	     </tr>
     </form>
     <tr class="bigfont">
        <td width="15%"><strong>动作时间</strong></td>
        <td width="10%"><strong>动作名称</strong></td>
        <td width="10%"><strong>表</strong></td>
        <td width="10%"><strong>字段</strong></td>
        <td width="15%"><strong>机构</strong></td>
        <td width="10%"><strong>操作者</strong></td>
        <td width="15%"><strong>新值</strong></td>
        <td width="15%"><strong>旧值</strong></td>
     </tr>
     <?php if (( $this->_tpl_vars['row'] )): ?>
     <?php unset($this->_sections['row']);
$this->_sections['row']['loop'] = is_array($_loop=$this->_tpl_vars['row']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['row']['name'] = 'row';
$this->_sections['row']['show'] = true;
$this->_sections['row']['max'] = $this->_sections['row']['loop'];
$this->_sections['row']['step'] = 1;
$this->_sections['row']['start'] = $this->_sections['row']['step'] > 0 ? 0 : $this->_sections['row']['loop']-1;
if ($this->_sections['row']['show']) {
    $this->_sections['row']['total'] = $this->_sections['row']['loop'];
    if ($this->_sections['row']['total'] == 0)
        $this->_sections['row']['show'] = false;
} else
    $this->_sections['row']['total'] = 0;
if ($this->_sections['row']['show']):

            for ($this->_sections['row']['index'] = $this->_sections['row']['start'], $this->_sections['row']['iteration'] = 1;
                 $this->_sections['row']['iteration'] <= $this->_sections['row']['total'];
                 $this->_sections['row']['index'] += $this->_sections['row']['step'], $this->_sections['row']['iteration']++):
$this->_sections['row']['rownum'] = $this->_sections['row']['iteration'];
$this->_sections['row']['index_prev'] = $this->_sections['row']['index'] - $this->_sections['row']['step'];
$this->_sections['row']['index_next'] = $this->_sections['row']['index'] + $this->_sections['row']['step'];
$this->_sections['row']['first']      = ($this->_sections['row']['iteration'] == 1);
$this->_sections['row']['last']       = ($this->_sections['row']['iteration'] == $this->_sections['row']['total']);
?>
     <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
			<td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['update_time']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['action']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['table_name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['column_name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['org_description']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['name_login']; ?>
</td>
			<td title="<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['new_value']; ?>
"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['new_value_abstract']; ?>
</td>
			<td title="<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['old_value']; ?>
"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['old_value_abstract']; ?>
</td>
         </tr>
     <?php endfor; endif; ?>
     <?php else: ?>
     <tr ><td colspan="8">暂时没有数据</td></tr>
     <?php endif; ?>
     <tr><td colspan="8"><?php echo $this->_tpl_vars['pager']; ?>
</td></tr>
     </table>
     <div id="errorMessage" style="display:none"><?php echo $this->_tpl_vars['errorMessage']; ?>
</div>
</body>
</html>