<?php /* Smarty version 2.6.14, created on 2013-06-24 11:03:53
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en" />
<meta name="GENERATOR" content="Zend Studio" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/popup.js"></script>
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
.bigfont{
    background:#DAE6F3;
}
</style>

<title>地区列表</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" media="all" type="text/css" rel="stylesheet"/>
</head>
<body>
<table border="1px" align="center" width="100%">
     <tr class="bigfont">
       <td colspan="11" align="center"><center><strong>综合统计(<?php echo $this->_tpl_vars['start_time']; ?>
~<?php echo $this->_tpl_vars['decision_time']; ?>
)</strong></center></td>
     </tr>
     <tr class="bigfont">
       <td colspan="10" align="center"><form action="" method="POST">
            时间㈣：<input type="text" onClick="WdatePicker({firstDayOfWeek:1})" class="" name="start_decision_time" value="<?php echo $this->_tpl_vars['start_time']; ?>
"/>    <input type="text" onClick="WdatePicker({firstDayOfWeek:1})" class="" name="post_decision_time" value="<?php echo $this->_tpl_vars['decision_time']; ?>
"/>       <input type="submit" value="搜索"  />
         </form>
        </td>
     </tr>
     
     <tr class="headbg">
       <td colspan="10"><?php unset($this->_sections['rs']);
$this->_sections['rs']['loop'] = is_array($_loop=$this->_tpl_vars['rs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rs']['name'] = 'rs';
$this->_sections['rs']['show'] = true;
$this->_sections['rs']['max'] = $this->_sections['rs']['loop'];
$this->_sections['rs']['step'] = 1;
$this->_sections['rs']['start'] = $this->_sections['rs']['step'] > 0 ? 0 : $this->_sections['rs']['loop']-1;
if ($this->_sections['rs']['show']) {
    $this->_sections['rs']['total'] = $this->_sections['rs']['loop'];
    if ($this->_sections['rs']['total'] == 0)
        $this->_sections['rs']['show'] = false;
} else
    $this->_sections['rs']['total'] = 0;
if ($this->_sections['rs']['show']):

            for ($this->_sections['rs']['index'] = $this->_sections['rs']['start'], $this->_sections['rs']['iteration'] = 1;
                 $this->_sections['rs']['iteration'] <= $this->_sections['rs']['total'];
                 $this->_sections['rs']['index'] += $this->_sections['rs']['step'], $this->_sections['rs']['iteration']++):
$this->_sections['rs']['rownum'] = $this->_sections['rs']['iteration'];
$this->_sections['rs']['index_prev'] = $this->_sections['rs']['index'] - $this->_sections['rs']['step'];
$this->_sections['rs']['index_next'] = $this->_sections['rs']['index'] + $this->_sections['rs']['step'];
$this->_sections['rs']['first']      = ($this->_sections['rs']['iteration'] == 1);
$this->_sections['rs']['last']       = ($this->_sections['rs']['iteration'] == $this->_sections['rs']['total']);
?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/schizophrenia/index/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
"><?php if ($this->_tpl_vars['add_need_id'] == $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']): ?><font color="Red"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a></font><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/schizophrenia/index/parent_id/<?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['id']; ?>
"><strong><?php echo $this->_tpl_vars['rs'][$this->_sections['rs']['index']]['zh_name']; ?>
</strong></a><?php endif; ?>&nbsp;&nbsp;->&nbsp;&nbsp;<?php endfor; endif; ?></td>
     </tr>
     <tr class="bigfont">
        <td width="9%"><strong>地区名称</strong></td>
        <td width="9%"><strong>患者数</strong></td>
        <td width="9%"><strong>15岁及以上人口总数</strong></td>
        <td width="9%"><strong>患病率(%)</strong></td>

        <td width="9%"><strong>管理率(%)</strong></td>
        <td width="9%"><strong>最近病情稳定患者数</strong></td>
        <td width="9%"><strong>患者稳定率(%)</strong></td>
        <td width="9%"><strong>规范管理人数</strong></td>
        <td width="9%"><strong>规范管理率(%)</strong></td>
        <td width="9%"><strong><?php if ($this->_tpl_vars['td_title'] == 1): ?>查看下级地区<?php endif;  if ($this->_tpl_vars['td_title'] == 2): ?>建档机构<?php endif; ?></strong></td>
     </tr>
       <?php echo $this->_tpl_vars['msg']; ?>

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
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['zh_name']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['all_schizophreniaer']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['population']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['adult_rate']; ?>
</td>

           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['mentalillness']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['last_good_schizophreniaer']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['good_rate']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['every_year_stand']; ?>
</td>
           <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['every_year_stand_rate']; ?>
</td>
           <td>
           <?php if ($this->_tpl_vars['td_title'] == 1): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
decision/schizophrenia/index/parent_id/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['id']; ?>
/decision_time/<?php echo $this->_tpl_vars['decision_time']; ?>
">[进入子地区]</a><?php endif; ?>
           <?php if ($this->_tpl_vars['td_title'] == 2):  echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['org_name'];  endif; ?>
           
           </td>
        </tr>
     <?php endfor; endif; ?>
        <tr class="headbg">
           <td>小计</td>
           <td><?php echo $this->_tpl_vars['sum_all_schizophreniaer']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_population']; ?>
</td>
           <td><?php echo $this->_tpl_vars['adult_rate']; ?>
</td>

           <td><?php echo $this->_tpl_vars['mentalillness']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_last_good_schizophreniaer']; ?>
</td>
           <td><?php echo $this->_tpl_vars['good_rate']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_every_year_stand']; ?>
</td>
           <td><?php echo $this->_tpl_vars['sum_every_year_stand_rate']; ?>
</td>
           <td>&nbsp;</td>
        </tr>
        <tr>
        	<td  colspan="11">
        	<?php echo $this->_tpl_vars['evaluation_target']; ?>

        	

        	</td>
        </tr>

</table>
  
</body>
</html>


