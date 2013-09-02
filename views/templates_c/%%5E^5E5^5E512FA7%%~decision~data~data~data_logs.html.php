<?php /* Smarty version 2.6.14, created on 2013-08-30 09:33:00
         compiled from data_logs.html */ ?>
<table id="mytable" cellspacing="0">
<tr>
<th scope="col">机构名称</th>
<th scope="col">最后请求类型</th>
<th scope="col">数据交换总量</th>
<th scope="col">最后请求时间</th>
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
<th scope="row" class="spec"><?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['org_name']; ?>
</th>
<?php else: ?>
<th scope="row" class="specalt"><?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['org_name']; ?>
</th>
<?php endif; ?>
<td><?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['upload_token']; ?>
</td>
<td><?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['nums']; ?>
</td>
<td><?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['updated']; ?>
</td>
</tr>
<?php endfor; endif; ?>
</table>