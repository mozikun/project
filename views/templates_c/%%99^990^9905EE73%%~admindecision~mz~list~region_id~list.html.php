<?php /* Smarty version 2.6.14, created on 2013-05-23 10:01:53
         compiled from list.html */ ?>
<table border="1px" align="center" width="100%">
     <tr class="headbg">
       <td colspan="2" align="center"><center><strong>地区疾病顺位统计表</strong></center></td>
     </tr>
     <tr class="columnbg">
        <td width="50%"><strong>疾病名称</strong></td>
        <td width="50%"><strong>疾病数</strong></td>
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
            <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['jzzdmc']; ?>
</td> 
            <td><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['total']; ?>
</td> 
        </tr> 
         <?php endfor; endif; ?>      
</table>
