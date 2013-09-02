<?php /* Smarty version 2.6.14, created on 2013-08-30 09:33:30
         compiled from data_status.html */ ?>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;">
        <tr class="headbg">
        <td colspan="2" class="title_tjb" style="padding-left: 36px;background: no-repeat 2px 50%;
    background-image: url('<?php echo $this->_tpl_vars['basePath']; ?>
images/hire-me.png');">居民就诊信息</td>
        </tr>
        <?php unset($this->_sections['data']);
$this->_sections['data']['name'] = 'data';
$this->_sections['data']['loop'] = is_array($_loop=$this->_tpl_vars['data_status']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <tr><td><?php echo $this->_tpl_vars['data_status'][$this->_sections['data']['index']]['name']; ?>
</td><td><?php echo $this->_tpl_vars['data_status'][$this->_sections['data']['index']]['nums']; ?>
 人次</td></tr>
        <?php endfor; else: ?>
        <tr><td colspan="2">平台暂无就诊信息</td></tr>
        <?php endif; ?>
    </table>