<?php /* Smarty version 2.6.14, created on 2013-07-26 14:45:43
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
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
<title>当前机构信息列表</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" media="all" type="text/css" rel="stylesheet"/>
</head>
<body>
     <table border="1px" align="center" width="100%">
     <tr class="headbg">
       <td colspan="5"><strong><?php echo $this->_tpl_vars['orgname']; ?>
--机构信息</strong></td>
     </tr>
     <tr class="bigfont">
        <td width="50%"><strong>机构信息数据年份</strong></td>
        <td width="50%"><strong>操作</strong></td>
     </tr>
     <?php unset($this->_sections['chs_center_array']);
$this->_sections['chs_center_array']['loop'] = is_array($_loop=$this->_tpl_vars['chs_center_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['chs_center_array']['name'] = 'chs_center_array';
$this->_sections['chs_center_array']['show'] = true;
$this->_sections['chs_center_array']['max'] = $this->_sections['chs_center_array']['loop'];
$this->_sections['chs_center_array']['step'] = 1;
$this->_sections['chs_center_array']['start'] = $this->_sections['chs_center_array']['step'] > 0 ? 0 : $this->_sections['chs_center_array']['loop']-1;
if ($this->_sections['chs_center_array']['show']) {
    $this->_sections['chs_center_array']['total'] = $this->_sections['chs_center_array']['loop'];
    if ($this->_sections['chs_center_array']['total'] == 0)
        $this->_sections['chs_center_array']['show'] = false;
} else
    $this->_sections['chs_center_array']['total'] = 0;
if ($this->_sections['chs_center_array']['show']):

            for ($this->_sections['chs_center_array']['index'] = $this->_sections['chs_center_array']['start'], $this->_sections['chs_center_array']['iteration'] = 1;
                 $this->_sections['chs_center_array']['iteration'] <= $this->_sections['chs_center_array']['total'];
                 $this->_sections['chs_center_array']['index'] += $this->_sections['chs_center_array']['step'], $this->_sections['chs_center_array']['iteration']++):
$this->_sections['chs_center_array']['rownum'] = $this->_sections['chs_center_array']['iteration'];
$this->_sections['chs_center_array']['index_prev'] = $this->_sections['chs_center_array']['index'] - $this->_sections['chs_center_array']['step'];
$this->_sections['chs_center_array']['index_next'] = $this->_sections['chs_center_array']['index'] + $this->_sections['chs_center_array']['step'];
$this->_sections['chs_center_array']['first']      = ($this->_sections['chs_center_array']['iteration'] == 1);
$this->_sections['chs_center_array']['last']       = ($this->_sections['chs_center_array']['iteration'] == $this->_sections['chs_center_array']['total']);
?>
        <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
           <td><?php echo $this->_tpl_vars['chs_center_array'][$this->_sections['chs_center_array']['index']]['year']; ?>
年机构信息数据</td>
           <td>
<a href="<?php echo $this->_tpl_vars['basePath']; ?>
organization/orgext/index/org_id/<?php echo $this->_tpl_vars['org_id']; ?>
/org_year/<?php echo $this->_tpl_vars['chs_center_array'][$this->_sections['chs_center_array']['index']]['year']; ?>
">[编辑]</a><a href="<?php echo $this->_tpl_vars['basePath']; ?>
organization/orgext/del/org_id/<?php echo $this->_tpl_vars['org_id']; ?>
/org_year/<?php echo $this->_tpl_vars['chs_center_array'][$this->_sections['chs_center_array']['index']]['year']; ?>
" onclick="return confirm('您确定删除吗?确定');">[删除]</a></td>
        </tr>
     <?php endfor; else: ?>
     <tr>
      <td colspan="2">
         目前没有任何数据！
      </td>
     </tr>
     <?php endif; ?>
     <tr>
     	<td colspan="5"><?php if ($this->_tpl_vars['org_type'] == '3' || $this->_tpl_vars['org_type'] == '5'): ?><a  href="<?php echo $this->_tpl_vars['basePath']; ?>
organization/orgext/index"><strong>[添加机构信息]</strong><?php endif; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['page']; ?>
</td>
     </tr>
     </table>
</body>
</html>
