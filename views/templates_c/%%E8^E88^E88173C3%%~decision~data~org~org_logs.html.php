<?php /* Smarty version 2.6.14, created on 2013-08-30 09:33:13
         compiled from org_logs.html */ ?>
<table id="mytable" cellspacing="0">
<tr>
<th scope="col">地区</th>
<?php $_from = $this->_tpl_vars['token']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['token']):
?>
<th scope="col"><?php echo $this->_tpl_vars['token']; ?>
</th>
<?php endforeach; endif; unset($_from); ?>
</tr>
<?php unset($this->_sections['data']);
$this->_sections['data']['name'] = 'data';
$this->_sections['data']['loop'] = is_array($_loop=$this->_tpl_vars['data_logs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<tr>
<?php if ($this->_sections['data']['rownum']%2 == 0): ?>
<th scope="row" class="spec" style="cursor: pointer;" onclick="show_next_region('<?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['id']; ?>
')"><?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['zh_name']; ?>
</th>
<?php else: ?>
<th scope="row" class="specalt" style="cursor: pointer;" onclick="show_next_region('<?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['id']; ?>
')"><?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['zh_name']; ?>
</th>
<?php endif; ?>
<?php unset($this->_sections['type']);
$this->_sections['type']['name'] = 'type';
$this->_sections['type']['loop'] = is_array($_loop=$this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['drilldown']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['type']['show'] = true;
$this->_sections['type']['max'] = $this->_sections['type']['loop'];
$this->_sections['type']['step'] = 1;
$this->_sections['type']['start'] = $this->_sections['type']['step'] > 0 ? 0 : $this->_sections['type']['loop']-1;
if ($this->_sections['type']['show']) {
    $this->_sections['type']['total'] = $this->_sections['type']['loop'];
    if ($this->_sections['type']['total'] == 0)
        $this->_sections['type']['show'] = false;
} else
    $this->_sections['type']['total'] = 0;
if ($this->_sections['type']['show']):

            for ($this->_sections['type']['index'] = $this->_sections['type']['start'], $this->_sections['type']['iteration'] = 1;
                 $this->_sections['type']['iteration'] <= $this->_sections['type']['total'];
                 $this->_sections['type']['index'] += $this->_sections['type']['step'], $this->_sections['type']['iteration']++):
$this->_sections['type']['rownum'] = $this->_sections['type']['iteration'];
$this->_sections['type']['index_prev'] = $this->_sections['type']['index'] - $this->_sections['type']['step'];
$this->_sections['type']['index_next'] = $this->_sections['type']['index'] + $this->_sections['type']['step'];
$this->_sections['type']['first']      = ($this->_sections['type']['iteration'] == 1);
$this->_sections['type']['last']       = ($this->_sections['type']['iteration'] == $this->_sections['type']['total']);
?>
<td><?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['drilldown'][$this->_sections['type']['index']]['nums']; ?>
</td>
<?php endfor; endif; ?>
</tr>
<?php endfor; endif; ?>
</table>