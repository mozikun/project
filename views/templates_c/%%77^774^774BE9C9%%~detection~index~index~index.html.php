<?php /* Smarty version 2.6.14, created on 2013-05-06 10:32:35
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>检验报告列表</title>
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
       <td colspan="6">检验报告列表</td>
   </tr>
   <tr class="bigfont">
    <td ><strong>姓名</strong></td>
	<td ><strong>性别</strong></td>
	<td ><strong>标本种类</strong></td>
	<td ><strong>检验单号</strong></td>
	<td ><strong>采样日期</strong></td>
	<td ><strong>查看详细</strong></td>
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
    <td ><?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['name']; ?>
</td>
	<td ><?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['gender']; ?>
</td>
	<td ><?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['spe_type']; ?>
</td>
	<td ><?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['lis_id']; ?>
</td>
	<td ><?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['created']; ?>
</td>
	<td ><a href="<?php echo $this->_tpl_vars['basePath']; ?>
detection/index/detail/currentid/<?php echo $this->_tpl_vars['listArray'][$this->_sections['listArray']['index']]['lis_id']; ?>
">[查看详细]</a></td>
   </tr>
   <?php endfor; else: ?>
   <tr>
     <td colspan="6">当前没有任何数据</td>
   </tr>
   <?php endif; ?>
   <tr>
   <td colspan="6" align="left" width="100%">
		<?php echo $this->_tpl_vars['page']; ?>

	 </td>
	</tr>
</table>
</body>