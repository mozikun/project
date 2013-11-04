<?php /* Smarty version 2.6.14, created on 2013-11-04 11:32:08
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" media="all" type="text/css" rel="stylesheet"/>
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
a{
	text-decoration:none;
}
</style>
</head>
<body>
<table width="100%" align="center">
   <tr class="headbg">
       <td colspan="7">标准代码维护列表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="生成所有的数据" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/infmanage/all'" style="line-height:16px;"/></td>
   </tr>
   <form action="<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/infmanage/index" method="post">
	   <tr>
	     <td colspan="7">
	              模块名称:<input type="text" name="module_search"/>
	              表名:    <input  name="table_search" type="text"/> 
	     <input type="hidden" name="pagenow" value="<?php echo $this->_tpl_vars['pageCurrent']; ?>
"/>
	     <input name="ok" value="搜索" type="submit" style="height:25px;line-height:20px;"/>
	     </td>
	   </tr>
   </form>
   <tr class="headbg">
    <td width="14%"><strong>数据元标识符</strong></td>
	<td><strong>数据元名称</strong></td>
	<td><strong>定义</strong></td>
	<td><strong>模块名称</strong></td>
	<td><strong>表名</strong></td>
	<td><strong>字段名</strong></td>
	<td width="14%"><strong>操作</strong></td>
   </tr>
   <?php unset($this->_sections['listArray']);
$this->_sections['listArray']['name'] = 'listArray';
$this->_sections['listArray']['loop'] = is_array($_loop=$this->_tpl_vars['listArray']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['listArray']['show'] = true;
$this->_sections['listArray']['max'] = $this->_sections['listArray']['loop'];
$this->_sections['listArray']['step'] = 1;
$this->_sections['listArray']['start'] = $this->_sections['listArray']['step'] > 0 ? 0 : $this->_sections['listArray']['loop']-1;
if ($this->_sections['listArray']['show']) {
    $this->_sections['listArray']['total'] = $this->_sections['listArray']['loop'];
    if ($this->_sections['listArray']['total'] == 0)
        $this->_sections['listArray']['show'] = false;
} else
    $this->_sections['listArray']['total'] = 0;
if ($this->_sections['listArray']['show']):

            for ($this->_sections['listArray']['index'] = $this->_sections['listArray']['start'], $this->_sections['listArray']['iteration'] = 1;
                 $this->_sections['listArray']['iteration'] <= $this->_sections['listArray']['total'];
                 $this->_sections['listArray']['index'] += $this->_sections['listArray']['step'], $this->_sections['listArray']['iteration']++):
$this->_sections['listArray']['rownum'] = $this->_sections['listArray']['iteration'];
$this->_sections['listArray']['index_prev'] = $this->_sections['listArray']['index'] - $this->_sections['listArray']['step'];
$this->_sections['listArray']['index_next'] = $this->_sections['listArray']['index'] + $this->_sections['listArray']['step'];
$this->_sections['listArray']['first']      = ($this->_sections['listArray']['iteration'] == 1);
$this->_sections['listArray']['last']       = ($this->_sections['listArray']['iteration'] == $this->_sections['listArray']['total']);
?>
   <tr>
    <td width="14%"><?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['internal_identifier']; ?>
</td>
	<td><?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['data_element']; ?>
</td>
	<td><?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['definition']; ?>
</td>
	<td><?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['module_id']; ?>
</td>
	<td><?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['table_name']; ?>
</td>
	<td><?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['fields']; ?>
</td>
	<td width="14%"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/infmanage/manage/editid/<?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['internal_identifier']; ?>
/currentpage/<?php echo $this->_tpl_vars['pageCurrent']; ?>
/module_search/<?php echo $this->_tpl_vars['module_id']; ?>
/table_search/<?php echo $this->_tpl_vars['table_name']; ?>
">[编辑]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/infmanage/del/delid/<?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['internal_identifier']; ?>
/currentpage/<?php echo $this->_tpl_vars['pageCurrent']; ?>
/module_search/<?php echo $this->_tpl_vars['module_id']; ?>
/table_search/<?php echo $this->_tpl_vars['table_name']; ?>
" onclick="return confirm('您确定删除吗?请谨慎操作');">[删除]</a></td>
   </tr>
   <?php endfor; else: ?>
   <tr>
     <td colspan="7">当前没有任何数据</td>
   </tr>
   <?php endif; ?>
	<tr>
	 <td colspan="7" align="left" width="100%">
		<a href="<?php echo $this->_tpl_vars['basePath']; ?>
wsinfo/infmanage/manage/currentpage/<?php echo $this->_tpl_vars['pageCurrent']; ?>
">[添加]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['page']; ?>

	 </td>
	</tr>
</table>
</body>