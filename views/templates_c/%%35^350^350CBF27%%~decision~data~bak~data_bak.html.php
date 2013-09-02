<?php /* Smarty version 2.6.14, created on 2013-08-30 09:33:09
         compiled from data_bak.html */ ?>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;">
        <tr class="headbg">
        <td class="title_tjb" id="data_bak" style="padding-left: 36px;background: no-repeat 2px 50%;
    background-image: url('<?php echo $this->_tpl_vars['basePath']; ?>
images/future-projects.png');color: #ff6e00;">平台计划任务</td>
        </tr>
        <?php unset($this->_sections['data']);
$this->_sections['data']['name'] = 'data';
$this->_sections['data']['loop'] = is_array($_loop=$this->_tpl_vars['data_bak']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['data']['show'] = true;
$this->_sections['data']['max'] = $this->_sections['data']['loop'];
$this->_sections['data']['step'] = 1;
$this->_sections['data']['start'] = $this->_sections['data']['step'] > 0 ? 0 : $this->_sections['data']['loop']-1;
if ($this->_sections['data']['show']) {
    $this->_sections['data']['total'] = $this->_sections['data']['loop'];
    if ($this->_sections['data']['total'] == 0)
        $this->_sections['data']['show'] = false;
} else
    $this->_sections['data']['total'] = 0;
if ($this->_sections['data']['show']):

            for ($this->_sections['data']['index'] = $this->_sections['data']['start'], $this->_sections['data']['iteration'] = 1;
                 $this->_sections['data']['iteration'] <= $this->_sections['data']['total'];
                 $this->_sections['data']['index'] += $this->_sections['data']['step'], $this->_sections['data']['iteration']++):
$this->_sections['data']['rownum'] = $this->_sections['data']['iteration'];
$this->_sections['data']['index_prev'] = $this->_sections['data']['index'] - $this->_sections['data']['step'];
$this->_sections['data']['index_next'] = $this->_sections['data']['index'] + $this->_sections['data']['step'];
$this->_sections['data']['first']      = ($this->_sections['data']['iteration'] == 1);
$this->_sections['data']['last']       = ($this->_sections['data']['iteration'] == $this->_sections['data']['total']);
?>
        <tr><td <?php if ($this->_tpl_vars['data_bak'][$this->_sections['data']['index']]['overtime'] > 0): ?> class="overtime"<?php else: ?> class="plantime"<?php endif; ?>><?php echo $this->_tpl_vars['data_bak'][$this->_sections['data']['index']]['timer']; ?>
 <?php echo $this->_tpl_vars['data_bak'][$this->_sections['data']['index']]['txt']; ?>
</td></tr>
        <?php endfor; else: ?>
        <tr><td>还没有制定计划任务</td></tr>
        <?php endif; ?>
    </table>