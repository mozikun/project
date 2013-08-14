<?php /* Smarty version 2.6.14, created on 2013-07-26 14:45:09
         compiled from users_list.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
 $(function(){
 });
 
  function del_record(id){
	 if(confirm("你真的要删除吗？")){
	 	
		$.get("<?php echo $this->_tpl_vars['basePath']; ?>
admin/users/delete/id/"+id, function(data){
		  	alert(data);
			if(data=="删除成功！"){
				window.location="<?php echo $this->_tpl_vars['basePath']; ?>
admin/users/index/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/org_id/<?php echo $this->_tpl_vars['org_id']; ?>
";
			}
		}); 
	 }
	 
 }
</script>
	
	<table cellspacing="0" width="100%">
    <thead>
    <tr >
	<th  colspan="4" align="left">当前机构:<font color="Red"><?php echo $this->_tpl_vars['org_name']; ?>
</font>&nbsp;&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['go_back'] == ""): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
organization/listorg/listorg/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
">返回</a><?php endif; ?></th>
	</tr>
	</thead>
    <tr  class="headbg">
	<th style="width:40%" colspan="4">用户管理</th>
	</tr>
    <?php if ($this->_tpl_vars['record_count'] != 0): ?>
	<tr class="columnbg">
	<th style="width:25%">国家标准代码</th><th style="width:25%">角色</th><th style="width:25%">登录名</th><th style="width:25%">操作</th>
	</tr>	
	<tbody id=''>
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
      <tr onmouseover="this.className='table_mouseover'" onmouseout="this.className='table_mouseout'">
			<td ><?php echo $this->_tpl_vars['row'][$this->_sections['contact']['index']]['standard_code']; ?>
</td>
            <td ><?php echo $this->_tpl_vars['row'][$this->_sections['contact']['index']]['role_name']; ?>
</td>
			<td ><?php echo $this->_tpl_vars['row'][$this->_sections['contact']['index']]['name_login']; ?>
</td>	
			<td><a href="<?php echo $this->_tpl_vars['basePath']; ?>
admin/users/add/org_id/<?php echo $this->_tpl_vars['org_id']; ?>
/org_name/<?php echo $this->_tpl_vars['url_org_name']; ?>
/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/id/<?php echo $this->_tpl_vars['row'][$this->_sections['contact']['index']]['id']; ?>
/region_path/<?php echo $this->_tpl_vars['region_path']; ?>
">[修改]</a>  |  <a href="javascript:" onclick="del_record('<?php echo $this->_tpl_vars['row'][$this->_sections['contact']['index']]['id']; ?>
')">[删除]</a>
             </td>
		</tr>
	    <?php endfor; endif; ?>	
          
	</tbody>
	
    <?php endif; ?>
   
    <tr  class="columnbg">
		<td style="width:40%" colspan="4"><div style=" float:left">[<a href="<?php echo $this->_tpl_vars['basePath']; ?>
admin/users/add/org_id/<?php echo $this->_tpl_vars['org_id']; ?>
/org_name/<?php echo $this->_tpl_vars['url_org_name']; ?>
/region_id/<?php echo $this->_tpl_vars['region_id']; ?>
/region_path/<?php echo $this->_tpl_vars['region_path']; ?>
">添加工作人员</a>]</div><div style="float:right"><?php echo $this->_tpl_vars['out']; ?>
</div></td>
	</tr>
	</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>