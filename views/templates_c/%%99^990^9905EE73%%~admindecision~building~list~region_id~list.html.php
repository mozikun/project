<?php /* Smarty version 2.6.14, created on 2013-05-23 10:01:51
         compiled from list.html */ ?>
<table width="100%" border="0">
	<tr class="headbg">
		<td colspan="8">房屋资源</td>
	</tr>
</table>
<table width="100%" border="0">
	<tr class="columnbg">
		<td align="center" >地区</td>
		<td align="center" >业务用房面积</td>
	</tr>
	<?php unset($this->_sections['regionarr']);
$this->_sections['regionarr']['name'] = 'regionarr';
$this->_sections['regionarr']['loop'] = is_array($_loop=$this->_tpl_vars['regionarr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['regionarr']['show'] = true;
$this->_sections['regionarr']['max'] = $this->_sections['regionarr']['loop'];
$this->_sections['regionarr']['step'] = 1;
$this->_sections['regionarr']['start'] = $this->_sections['regionarr']['step'] > 0 ? 0 : $this->_sections['regionarr']['loop']-1;
if ($this->_sections['regionarr']['show']) {
    $this->_sections['regionarr']['total'] = $this->_sections['regionarr']['loop'];
    if ($this->_sections['regionarr']['total'] == 0)
        $this->_sections['regionarr']['show'] = false;
} else
    $this->_sections['regionarr']['total'] = 0;
if ($this->_sections['regionarr']['show']):

            for ($this->_sections['regionarr']['index'] = $this->_sections['regionarr']['start'], $this->_sections['regionarr']['iteration'] = 1;
                 $this->_sections['regionarr']['iteration'] <= $this->_sections['regionarr']['total'];
                 $this->_sections['regionarr']['index'] += $this->_sections['regionarr']['step'], $this->_sections['regionarr']['iteration']++):
$this->_sections['regionarr']['rownum'] = $this->_sections['regionarr']['iteration'];
$this->_sections['regionarr']['index_prev'] = $this->_sections['regionarr']['index'] - $this->_sections['regionarr']['step'];
$this->_sections['regionarr']['index_next'] = $this->_sections['regionarr']['index'] + $this->_sections['regionarr']['step'];
$this->_sections['regionarr']['first']      = ($this->_sections['regionarr']['iteration'] == 1);
$this->_sections['regionarr']['last']       = ($this->_sections['regionarr']['iteration'] == $this->_sections['regionarr']['total']);
?>
	<tr  align="center"  onMouseOver="this.style.backgroundColor='#E5FBFF'" onMouseOut="this.style.backgroundColor='#E4EDF9'">
			<td align="center"><?php echo $this->_tpl_vars['regionarr'][$this->_sections['regionarr']['index']]['axisname']; ?>
</td>
			<td  title="业务用房面积"><?php echo $this->_tpl_vars['regionarr'][$this->_sections['regionarr']['index']]['operation_area']; ?>
</td>
	</tr>
	<?php endfor; endif; ?>
	<tr class="title">
		    <td align="center">合计</td>
			<td align="center" title="万元以上设备总数"><?php echo $this->_tpl_vars['allnumber']; ?>
</td>
	</tr>	
</table>