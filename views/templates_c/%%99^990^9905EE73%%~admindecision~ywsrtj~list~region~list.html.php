<?php /* Smarty version 2.6.14, created on 2013-05-23 10:01:52
         compiled from list.html */ ?>
<table  width="100%" >
     <tr class="columnbg">
     <td align="center">地区名称</td>
     <?php if ($this->_tpl_vars['field'] == 'mjzylfy'): ?>
     <td align="center">门急诊医疗费用</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'zyylfy'): ?>
     <td align="center">住院医疗费用</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'mjzypfy'): ?>
     <td align="center">门急诊药品费用</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'zyypfy'): ?>
     <td align="center">住院药品费用</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'mjzybylfy'): ?>
     <td align="center">门急诊医保医疗费用</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'zyybylfy'): ?>
     <td align="center">住院医保医疗费用</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'mjzybypfy'): ?>
     <td align="center">门急诊医保药品费用</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'zyybypfy'): ?>
     <td align="center">住院医保药品费用</td>	
     <?php endif; ?>
    </tr>
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
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['zh_name']; ?>
</td>
    <?php if ($this->_tpl_vars['field'] == 'mjzylfy'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['mjzylfy']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'zyylfy'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['zyylfy']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'mjzypfy'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['mjzypfy']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'zyypfy'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['zyypfy']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'mjzybylfy'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['mjzybylfy']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'zyybylfy'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['zyybylfy']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'mjzybypfy'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['mjzybypfy']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'zyybypfy'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['zyybypfy']; ?>
</td>
   <?php endif; ?>
   </tr>
 <?php endfor; endif; ?>
   <tr align="center" class="title">
     <td>合计</td>
     <?php if ($this->_tpl_vars['field'] == 'mjzylfy'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_mjzylfy']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'zyylfy'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_zyylfy']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'mjzypfy'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_mjzypfy']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'zyypfy'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_zyypfy']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'mjzybylfy'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_mjzybylfy']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'zyybylfy'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_zyybylfy']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'mjzybypfy'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_mjzybypfy']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'zyybypfy'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_zyybypfy']; ?>
</td>
	<?php endif; ?>
   </tr>
</table>