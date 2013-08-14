<?php /* Smarty version 2.6.14, created on 2013-08-06 10:16:29
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>健康体检列表</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
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
.inputbutton{
border: 1px solid blue;
width:80px;
background:#FFFFFF;
}
</style>
</head>
<body>
<table border="0" width="100%">
    <tr class="headbg">
      <td>
		<strong>预防接种记录信息表</strong>
	  </td>
	</tr>
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
vaccinate/index/index" id="search" method="post">
			<tr><td>
				姓名：<input type="text" name="username" size="18" value="<?php echo $this->_tpl_vars['realname']; ?>
"/>&nbsp;
				档案号:<input type="text" name="standard_code" value="<?php echo $this->_tpl_vars['serialnumber']; ?>
"/>&nbsp;
				身份证号:<input type="text" name="identity_number" size="18" value="<?php echo $this->_tpl_vars['nowdate']; ?>
"/>&nbsp;
				责任医生:<select name="staff_id" id="staff_id">
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
				<input type="submit" value="搜索" class="inputbutton"/>
				</td>
			</tr>
		</form>
</table>	
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
        <th title="姓名">
   	        姓名</th>
		<th title="对方姓名" >
        	    监护人    </th>
		<th title="身份证号码">身份证号码</th>
		<th title="填表时间">填表时间</th>
		<th>
        	操作        </th>
	</tr>
	</thead>
	<tbody >
	 <?php $_from = $this->_tpl_vars['exam_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['li']):
?>
	 <tr onMouseOver="this.className='table_mouseover'" onMouseOut="this.className='table_mouseout'">
        <td><?php echo $this->_tpl_vars['li']['name']; ?>
</td>
		<td><?php echo $this->_tpl_vars['li']['moreinfo']->guardian; ?>
</td>
		<td><?php echo $this->_tpl_vars['li']['indent']; ?>
</td>
		<td><?php echo $this->_tpl_vars['li']['moreinfo']->created_card_time; ?>
</td>
		<td >
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
vaccinate/index/add/id/<?php echo $this->_tpl_vars['li']['id']; ?>
">[ 进入编辑 ]</a> 
			<a href="<?php echo $this->_tpl_vars['basePath']; ?>
vaccinate/index/del/id/<?php echo $this->_tpl_vars['li']['id']; ?>
" onClick="javascript:if(confirm('确定要删除 <?php echo $this->_tpl_vars['li']['name']; ?>
 的疫苗预防接种信息吗')){return true;}else{return false;}">[ 删除记录 ]</a>
		</td>
	</tr>
	<?php endforeach; else: ?>
	<tr>
		<td colspan="5">对不起，未找到您要查询的内容！</td>
	</tr>
	 <?php endif; unset($_from); ?>
	  <?php echo $this->_tpl_vars['str']; ?>

	  <tr>
	  <td colspan="5" align="center">
	   <?php echo $this->_tpl_vars['pager']; ?>
</td>
	</tr>
	</tbody>
</table>
</body>
</html>
<script type="text/javascript">
function checkselect() {
	  for (var i = 0; i < document.getElementsByName("selectFlag[]").length; i++) {
	   document.getElementsByName("selectFlag[]")[i].checked = document.getElementById("ifAll").checked;
	  }
	 }
</script>