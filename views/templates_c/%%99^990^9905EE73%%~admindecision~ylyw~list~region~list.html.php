<?php /* Smarty version 2.6.14, created on 2013-05-23 10:01:52
         compiled from list.html */ ?>
<table  width="100%" >

     <tr class="columnbg">
     <td align="center">地区名称</td>
     <?php if ($this->_tpl_vars['field'] == 'mzrc'): ?>
     <td align="center">门诊人次</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'jzrc'): ?>
     <td align="center">急诊人次</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'ryrc'): ?>
     <td align="center">入院人次</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'cyrc'): ?>
     <td align="center">出院人次</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'zyrs'): ?>
     <td align="center">在院人数</td>
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
</strong></td>
    <?php if ($this->_tpl_vars['field'] == 'mzrc'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['mzrc']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'jzrc'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['jzrc']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'ryrc'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['ryrc']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'cyrc'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['cyrc']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'zyrs'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['zyrs']; ?>
</td>
    <?php endif; ?>
   </tr>
  <?php endfor; endif; ?>
   <tr align="center" class="title">
     <td>合计</td>
     <?php if ($this->_tpl_vars['field'] == 'mzrc'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_mzrc']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'jzrc'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_jzrc']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'ryrc'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_ryrc']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'cyrc'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_cyrc']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'zyrs'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_zyrs']; ?>
</td>
     <?php endif; ?>
   </tr>
</table>