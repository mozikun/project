<?php /* Smarty version 2.6.14, created on 2013-05-23 10:01:52
         compiled from list.html */ ?>
<table  width="100%" >
     <tr class="columnbg">
     <td align="center">地区名称</td>
     <?php if ($this->_tpl_vars['field'] == 'edcw'): ?>
     <td align="center">编制床位数</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'sjcws'): ?>
     <td align="center">每日实际床位数</td>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['field'] == 'sjkfcws'): ?>
     <td align="center">每日实际开放床位数</td>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['field'] == 'sycw'): ?>
     <td align="center">每日实际使用床位数</td>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['field'] == 'jrry'): ?>
     <td align="center">今日入院</td>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['field'] == 'jrcy'): ?>
     <td align="center">今日出院</td>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['field'] == 'jrzr'): ?>
     <td align="center">今日转入</td>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['field'] == 'jrzc'): ?>
     <td align="center">今日转出</td>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['field'] == 'jrbz'): ?>
     <td align="center">今日病重</td>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['field'] == 'jrbw'): ?>
     <td align="center">今日病危</td>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['field'] == 'jrsw'): ?>
     <td align="center">今日死亡</td>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['field'] == 'zyrs'): ?>
     <td align="center">住院人数</td>
      <?php endif; ?>
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
    <?php if ($this->_tpl_vars['field'] == 'edcw'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['edcw']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'sjcws'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sjcws']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'sjkfcws'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sjkfcws']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'sycw'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['sycw']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'jrry'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['jrry']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'jrcy'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['jrcy']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'jrzr'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['jrzr']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'jrzc'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['jrzc']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'jrbz'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['jrbz']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'jrbw'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['jrbw']; ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['field'] == 'jrsw'): ?>
    <td align="center"><?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['jrsw']; ?>
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
     <?php if ($this->_tpl_vars['field'] == 'edcw'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_edcw']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'sjcws'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_sjcws']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'sjkfcws'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_sjkfcws']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'sycw'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_sycw']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'jrry'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_jrry']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'jrcy'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_jrcy']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'jrzr'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_jrzr']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'jrzc'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_jrzc']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'jrbz'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_jrbz']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'jrbw'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_jrbw']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'jrsw'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_jrsw']; ?>
</td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['field'] == 'zyrs'): ?>
     <td><?php echo $this->_tpl_vars['total']['sum_zyrs']; ?>
</td>
     <?php endif; ?>
   </tr>
</table>