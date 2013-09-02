<?php /* Smarty version 2.6.14, created on 2013-09-02 09:51:08
         compiled from listdiagnosis.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>接诊记录列表</title>
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
		<strong>接诊记录列表</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
gp/diagnosis/listdiagnosis"><font style="color:black;">返回列表</font></a>
	  </td>
	</tr>
		<form action="<?php echo $this->_tpl_vars['basePath']; ?>
gp/diagnosis/listdiagnosis" id="search" method="post">
			<tr><td>
				姓名：<input type="text" name="realname" size="18"/>&nbsp;
				日期:<input type="text" name="nowdate" size="18" onClick="WdatePicker({firstDayOfWeek:1})" value="<?php echo $this->_tpl_vars['nowdate']; ?>
"/>&nbsp;
				<input type="submit" value="搜索" class="inputbutton" name="search"/>
				</td>
			</tr>
		</form>
</table>	
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
    	<th>&nbsp;
        	
        </th>
        <th title="编号">
        	编号
        </th>
		<th title="姓名" >
        	姓名
        </th>
		<th title="体检日期">
        	日期
        </th>
        <th title="姓名" >
        	医生姓名
        </th>
		<th>
        	操作
        </th>
	</tr>
	</thead>
	<tbody >
	<?php if ($this->_tpl_vars['nunumber'] == 0): ?>
	<tr>
	  <td colspan="6" align="center"><font color="red"><?php echo $this->_tpl_vars['msg']; ?>
</font></td>
	</tr>
	<?php else: ?>
     <?php unset($this->_sections['diagnosislistarr']);
$this->_sections['diagnosislistarr']['loop'] = is_array($_loop=$this->_tpl_vars['diagnosislistarr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diagnosislistarr']['name'] = 'diagnosislistarr';
$this->_sections['diagnosislistarr']['show'] = true;
$this->_sections['diagnosislistarr']['max'] = $this->_sections['diagnosislistarr']['loop'];
$this->_sections['diagnosislistarr']['step'] = 1;
$this->_sections['diagnosislistarr']['start'] = $this->_sections['diagnosislistarr']['step'] > 0 ? 0 : $this->_sections['diagnosislistarr']['loop']-1;
if ($this->_sections['diagnosislistarr']['show']) {
    $this->_sections['diagnosislistarr']['total'] = $this->_sections['diagnosislistarr']['loop'];
    if ($this->_sections['diagnosislistarr']['total'] == 0)
        $this->_sections['diagnosislistarr']['show'] = false;
} else
    $this->_sections['diagnosislistarr']['total'] = 0;
if ($this->_sections['diagnosislistarr']['show']):

            for ($this->_sections['diagnosislistarr']['index'] = $this->_sections['diagnosislistarr']['start'], $this->_sections['diagnosislistarr']['iteration'] = 1;
                 $this->_sections['diagnosislistarr']['iteration'] <= $this->_sections['diagnosislistarr']['total'];
                 $this->_sections['diagnosislistarr']['index'] += $this->_sections['diagnosislistarr']['step'], $this->_sections['diagnosislistarr']['iteration']++):
$this->_sections['diagnosislistarr']['rownum'] = $this->_sections['diagnosislistarr']['iteration'];
$this->_sections['diagnosislistarr']['index_prev'] = $this->_sections['diagnosislistarr']['index'] - $this->_sections['diagnosislistarr']['step'];
$this->_sections['diagnosislistarr']['index_next'] = $this->_sections['diagnosislistarr']['index'] + $this->_sections['diagnosislistarr']['step'];
$this->_sections['diagnosislistarr']['first']      = ($this->_sections['diagnosislistarr']['iteration'] == 1);
$this->_sections['diagnosislistarr']['last']       = ($this->_sections['diagnosislistarr']['iteration'] == $this->_sections['diagnosislistarr']['total']);
?>
	 <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
	  <form action="<?php echo $this->_tpl_vars['basePath']; ?>
gp/diagnosis/del/actionname/delall" method="post">
	 	<td>
	 	    <input type="hidden" value="<?php echo $this->_tpl_vars['delname']; ?>
" name="realnamedel"/>
	 	    <input type="hidden" value="<?php echo $this->_tpl_vars['deldate']; ?>
" name="nowdatedel"/>
	 		<input type="checkbox" value="<?php echo $this->_tpl_vars['diagnosislistarr'][$this->_sections['diagnosislistarr']['index']]['uuid']; ?>
" name="selectFlag[]" id="selectFlag"/>
	 	</td>
        <td>
           <?php echo $this->_tpl_vars['diagnosislistarr'][$this->_sections['diagnosislistarr']['index']]['standard_code_1']; ?>
 
        </td>
		<td >
        	<?php echo $this->_tpl_vars['diagnosislistarr'][$this->_sections['diagnosislistarr']['index']]['name']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['diagnosislistarr'][$this->_sections['diagnosislistarr']['index']]['current_time']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['diagnosislistarr'][$this->_sections['diagnosislistarr']['index']]['doctor_name']; ?>

        </td>
		<td >
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
gp/diagnosis/index/uuid/<?php echo $this->_tpl_vars['diagnosislistarr'][$this->_sections['diagnosislistarr']['index']]['uuid']; ?>
/currentpage/<?php echo $this->_tpl_vars['currentpagenow']; ?>
/realname/<?php echo $this->_tpl_vars['urlencodename']; ?>
/nowdatedit/<?php echo $this->_tpl_vars['current_time']; ?>
">[编辑]</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo $this->_tpl_vars['basePath']; ?>
gp/diagnosis/del/actionname/dellone/uuid/<?php echo $this->_tpl_vars['diagnosislistarr'][$this->_sections['diagnosislistarr']['index']]['uuid']; ?>
/realnamedel/<?php echo $this->_tpl_vars['delname']; ?>
/nowdatedel/<?php echo $this->_tpl_vars['deldate']; ?>
" onClick="return confirm('您确定删除吗?确定');">[删除]</a>
        </td>
	</tr>
	  <?php endfor; endif; ?>
	  <?php endif; ?>
	  <tr>
	  <td colspan="6" align="center">
	   <input type="checkbox" value="" name="ifAll" id="ifAll" onClick="return checkselect();"/>全选      &nbsp;&nbsp;<?php echo $this->_tpl_vars['page']; ?>
&nbsp;&nbsp;<input type="submit" name="delAll" value="全部删除" class="inputbutton" onClick="	if(confirm('确定要删除这些内容吗？')){return true;}else{return false;}
"/>
	</td>
	</tr>
	</form> 
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