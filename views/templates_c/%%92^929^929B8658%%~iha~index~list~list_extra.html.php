<?php /* Smarty version 2.6.14, created on 2013-07-23 11:01:41
         compiled from list_extra.html */ ?>
	<?php unset($this->_sections['iha']);
$this->_sections['iha']['name'] = 'iha';
$this->_sections['iha']['loop'] = is_array($_loop=$this->_tpl_vars['iha']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iha']['show'] = true;
$this->_sections['iha']['max'] = $this->_sections['iha']['loop'];
$this->_sections['iha']['step'] = 1;
$this->_sections['iha']['start'] = $this->_sections['iha']['step'] > 0 ? 0 : $this->_sections['iha']['loop']-1;
if ($this->_sections['iha']['show']) {
    $this->_sections['iha']['total'] = $this->_sections['iha']['loop'];
    if ($this->_sections['iha']['total'] == 0)
        $this->_sections['iha']['show'] = false;
} else
    $this->_sections['iha']['total'] = 0;
if ($this->_sections['iha']['show']):

            for ($this->_sections['iha']['index'] = $this->_sections['iha']['start'], $this->_sections['iha']['iteration'] = 1;
                 $this->_sections['iha']['iteration'] <= $this->_sections['iha']['total'];
                 $this->_sections['iha']['index'] += $this->_sections['iha']['step'], $this->_sections['iha']['iteration']++):
$this->_sections['iha']['rownum'] = $this->_sections['iha']['iteration'];
$this->_sections['iha']['index_prev'] = $this->_sections['iha']['index'] - $this->_sections['iha']['step'];
$this->_sections['iha']['index_next'] = $this->_sections['iha']['index'] + $this->_sections['iha']['step'];
$this->_sections['iha']['first']      = ($this->_sections['iha']['iteration'] == 1);
$this->_sections['iha']['last']       = ($this->_sections['iha']['iteration'] == $this->_sections['iha']['total']);
?>
	 <tr id="iha_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
" ondblclick="set_session('<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
')" class="status_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['status_flag']; ?>
">
	 	<td>
	 		<?php if ($this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid'] == $this->_tpl_vars['individual_current']->uuid): ?>
			<img id="img_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/status_online.png" class="online" />
			<?php else: ?>
			<img id="img_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/status_offline.png" class="online" />
			<?php endif; ?>
	 	</td>
        <td class="vtip" title="档案最后更新时间：<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['updated']; ?>
，建档时间为：<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['filing_time']; ?>
">
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['standard_code']; ?>

        </td>
		<td id="<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
_name">
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/search/username/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['name']; ?>
/card/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['standard_code_base']; ?>
" target="_blank"><?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['name']; ?>
</a>
        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['sex']; ?>

        </td>
		<td>
        	<a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/map/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
" class="vtip" title="点击在地图上标注家庭地址，同时将修改家庭地址"><?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['address']; ?>
</a>
        </td>
		<td title="生日：<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['date_of_birth']; ?>
">
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['age']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['contact_number']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['householder_name']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['staff_name']; ?>

        </td>
		<td onclick="showrate('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/showrate/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
')" style="cursor: pointer;">
        	<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['criteria_rate']; ?>

        </td>
        <td>
        	<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/credit-card_<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['card_status']; ?>
.png" title="<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['card_status_info']; ?>
" alt="<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['card_status_info']; ?>
" />
        </td>
		<td>
        	<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
iha/cover/add/action/edit/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
/para_page/<?php echo $this->_tpl_vars['para_page']; ?>
/opener/index" onclick="set_session('<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
');">编辑首页</a>
       		<a href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/add/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
/para_page/<?php echo $this->_tpl_vars['para_page']; ?>
/opener/index"  onclick="set_session('<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
');">编辑档案</a>
        	<a href="###" onclick="delete_iha('<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/delete/uuid/<?php echo $this->_tpl_vars['iha'][$this->_sections['iha']['index']]['uuid']; ?>
')">删除</a>
        </td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="12">
        	暂时没有数据
        </td>
	</tr>
	<?php endif; ?>
    <tr>
		<td colspan="12">
        <img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/status_online.png" />选中状态
		&nbsp;
		<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/status_offline.png" />未选中状态&nbsp;
        <img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/credit-card_1.png" />已发卡&nbsp;
        <img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/credit-card_2.png" />未发卡&nbsp;
        <img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/credit-card_3.png" />补卡&nbsp;
        
    </td>
	</tr>
	<tr>
		<td colspan="12">
        	<span class="flag status_6">死亡</span> <span class="flag status_4">临时</span> <span class="flag status_8">转出</span>&nbsp;<?php echo $this->_tpl_vars['pager']; ?>

			<input type="hidden" name="searchinput" id="searchinput" value="<?php echo $this->_tpl_vars['search']; ?>
" />
        </td>
	</tr>