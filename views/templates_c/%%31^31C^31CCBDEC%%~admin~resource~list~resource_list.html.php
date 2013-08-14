<?php /* Smarty version 2.6.14, created on 2013-06-17 16:07:39
         compiled from resource_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'regex_replace', 'resource_list.html', 18, false),)), $this); ?>

  <?php unset($this->_sections['modeule_']);
$this->_sections['modeule_']['name'] = 'modeule_';
$this->_sections['modeule_']['loop'] = is_array($_loop=$this->_tpl_vars['module_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['modeule_']['show'] = true;
$this->_sections['modeule_']['max'] = $this->_sections['modeule_']['loop'];
$this->_sections['modeule_']['step'] = 1;
$this->_sections['modeule_']['start'] = $this->_sections['modeule_']['step'] > 0 ? 0 : $this->_sections['modeule_']['loop']-1;
if ($this->_sections['modeule_']['show']) {
    $this->_sections['modeule_']['total'] = $this->_sections['modeule_']['loop'];
    if ($this->_sections['modeule_']['total'] == 0)
        $this->_sections['modeule_']['show'] = false;
} else
    $this->_sections['modeule_']['total'] = 0;
if ($this->_sections['modeule_']['show']):

            for ($this->_sections['modeule_']['index'] = $this->_sections['modeule_']['start'], $this->_sections['modeule_']['iteration'] = 1;
                 $this->_sections['modeule_']['iteration'] <= $this->_sections['modeule_']['total'];
                 $this->_sections['modeule_']['index'] += $this->_sections['modeule_']['step'], $this->_sections['modeule_']['iteration']++):
$this->_sections['modeule_']['rownum'] = $this->_sections['modeule_']['iteration'];
$this->_sections['modeule_']['index_prev'] = $this->_sections['modeule_']['index'] - $this->_sections['modeule_']['step'];
$this->_sections['modeule_']['index_next'] = $this->_sections['modeule_']['index'] + $this->_sections['modeule_']['step'];
$this->_sections['modeule_']['first']      = ($this->_sections['modeule_']['iteration'] == 1);
$this->_sections['modeule_']['last']       = ($this->_sections['modeule_']['iteration'] == $this->_sections['modeule_']['total']);
?>
 

  <tr >
  	   <td colspan="3"> 
	  	   <fieldset>
			  	   <legend>
	  	           <span  style=" cursor:pointer">
	  	            <input type="checkbox" onclick="selectModule('<?php echo $this->_tpl_vars['module_array'][$this->_sections['modeule_']['index']]; ?>
',this);" />
			  	    <strong onclick="toggleInfo(this,'<?php echo $this->_tpl_vars['module_array'][$this->_sections['modeule_']['index']]; ?>
')"><?php echo $this->_tpl_vars['module_array'][$this->_sections['modeule_']['index']]; ?>
-</strong>
			  	    </span>
			  	    </legend>
			  	    
				    <table id="<?php echo $this->_tpl_vars['module_array'][$this->_sections['modeule_']['index']]; ?>
" >
					
				    <?php unset($this->_sections['contact']);
$this->_sections['contact']['name'] = 'contact';
$this->_sections['contact']['loop'] = is_array($_loop=$this->_tpl_vars['row']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['contact']['show'] = true;
$this->_sections['contact']['max'] = $this->_sections['contact']['loop'];
$this->_sections['contact']['step'] = 1;
$this->_sections['contact']['start'] = $this->_sections['contact']['step'] > 0 ? 0 : $this->_sections['contact']['loop']-1;
if ($this->_sections['contact']['show']) {
    $this->_sections['contact']['total'] = $this->_sections['contact']['loop'];
    if ($this->_sections['contact']['total'] == 0)
        $this->_sections['contact']['show'] = false;
} else
    $this->_sections['contact']['total'] = 0;
if ($this->_sections['contact']['show']):

            for ($this->_sections['contact']['index'] = $this->_sections['contact']['start'], $this->_sections['contact']['iteration'] = 1;
                 $this->_sections['contact']['iteration'] <= $this->_sections['contact']['total'];
                 $this->_sections['contact']['index'] += $this->_sections['contact']['step'], $this->_sections['contact']['iteration']++):
$this->_sections['contact']['rownum'] = $this->_sections['contact']['iteration'];
$this->_sections['contact']['index_prev'] = $this->_sections['contact']['index'] - $this->_sections['contact']['step'];
$this->_sections['contact']['index_next'] = $this->_sections['contact']['index'] + $this->_sections['contact']['step'];
$this->_sections['contact']['first']      = ($this->_sections['contact']['iteration'] == 1);
$this->_sections['contact']['last']       = ($this->_sections['contact']['iteration'] == $this->_sections['contact']['total']);
?>
				        <?php if (( ((is_array($_tmp=$this->_tpl_vars['row'][$this->_sections['contact']['index']]['resource_en_name'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[_]+[a-z0-9]*/", "") : smarty_modifier_regex_replace($_tmp, "/[_]+[a-z0-9]*/", "")) ) == ( $this->_tpl_vars['module_array'][$this->_sections['modeule_']['index']] )): ?>
						<tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
						    <td style="width:40%">
							    <label><input type="checkbox" value="<?php echo $this->_tpl_vars['row'][$this->_sections['contact']['index']]['resource_id']; ?>
" name="selectFlag[]" id="selectFlag"/>
							    <span  id="en_<?php echo $this->_tpl_vars['row'][$this->_sections['contact']['index']]['resource_id']; ?>
"><?php echo $this->_tpl_vars['row'][$this->_sections['contact']['index']]['resource_en_name']; ?>
</span>
							    </label>
						    </td style="width:40%">
							<td  style="width:40%" id="zh_<?php echo $this->_tpl_vars['row'][$this->_sections['contact']['index']]['resource_id']; ?>
"><?php echo $this->_tpl_vars['row'][$this->_sections['contact']['index']]['resource_zh_name']; ?>
</td>	
							<td><a href="###" onclick="add_record()">[添加]</a> <a href="###" onclick="update_record('<?php echo $this->_tpl_vars['row'][$this->_sections['contact']['index']]['resource_id']; ?>
')">[修改]</a> <a href="###" onclick="del_record('<?php echo $this->_tpl_vars['row'][$this->_sections['contact']['index']]['resource_id']; ?>
',this)">[删除]</a></td>
						</tr>
						<?php endif; ?>
				        <?php endfor; endif; ?>	
				     </table>
			 </fieldset>
    	</td>
    </tr> 
   <?php endfor; endif; ?>	
     