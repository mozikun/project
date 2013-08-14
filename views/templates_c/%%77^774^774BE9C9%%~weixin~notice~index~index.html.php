<?php /* Smarty version 2.6.14, created on 2013-06-20 12:00:28
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>微信通知管理</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/choice.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/ajax_select_region.js"></script>
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
<script type="text/javascript">
$(document).ready(function(){
   
});
</script>
</head>
<body>
<table border="0" width="100%">
    <tr class="headbg">
      <td>
		<strong>微信通知管理</strong>
	  </td>
	</tr>
		<form action="" id="search" method="post">
		      <tr>
		        <td>
				   标题：<input type="text" name="title"  value="<?php echo $this->_tpl_vars['title']; ?>
"/>&nbsp;	    
				   时间：<input type="text" name="start_time"  onClick="WdatePicker({firstDayOfWeek:1})"  value=""  id="start_time"/>-<input type="text" name="end_time"  onClick="WdatePicker({firstDayOfWeek:1})" value=""  id="end_time"/>&nbsp;       
		           <input type="submit" value="搜索" class="inputbutton" id="mysubmit"/>&nbsp;&nbsp;
		        </td>
		      </tr>
		</form>
</table>	
<table border="0" width="100%">
	<thead>
    <tr class="headbg">
		<th title="标题" >
        	标题
        </th>
        <th title="机构" >
        	机构
        </th>
		<th title="操作者">
        	操作者
        </th>
        <th title="时间">
        	时间
        </th>
        <th title="操作">
        	操作
        </th>
	</tr>
	</thead>
	<tbody >
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
	 <tr>
		<td >
        	<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['title']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['org_id']; ?>

        </td>
		<td >
        	<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['staff_id']; ?>

        </td>
        <td >
        	<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['create_time']; ?>

        </td>
        	<td>
	 		<a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/notice/add/uuid/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['uuid']; ?>
">修改</a>
	 		<a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/notice/del/uuid/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['uuid']; ?>
" onclick="return confirm('是否确定删除此条记录？')">删除</a>
	 	</td>
	</tr>
	  <?php endfor; else: ?>
	    <tr><td colspan="5" align="center">当前暂时没有任何数据！</td></tr>
	  <?php endif; ?>
	  <tr>
	  <td colspan="5" align="center">
	   <a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/notice/add">+&nbsp;添加通知</a>&nbsp;&nbsp;<?php echo $this->_tpl_vars['pager']; ?>

	</td>
	</tr>
	</tbody>
</table>
</body>
</html>