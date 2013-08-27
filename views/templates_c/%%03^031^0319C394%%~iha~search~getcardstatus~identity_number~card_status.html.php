<?php /* Smarty version 2.6.14, created on 2013-08-27 09:47:36
         compiled from card_status.html */ ?>
 <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tr class="headbg">
    <td colspan="6"><b>就诊状态</b></td>
    </tr>
<tr>
    <td>就诊时间</td>
    <td>就诊机构</td>
    <td>就诊科室</td>
    <td>就诊状态</td>
    <td>活动描述</td>
    <td>医生姓名</td>
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
<tr>
     <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['created']; ?>
</td>
     <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['zh_name']; ?>
</td>
     <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['department_name']; ?>
</td>
     <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['status']; ?>
</td>
     <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['actions']; ?>
</td>
     <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['name_login']; ?>
</td>
</tr>
<?php endfor; endif; ?>
 </table>