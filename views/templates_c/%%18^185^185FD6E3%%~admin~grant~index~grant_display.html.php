<?php /* Smarty version 2.6.14, created on 2013-06-17 16:07:54
         compiled from grant_display.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">

$(function(){
 	//清空资源列表
	//$("#resource_content").hidden;
    //按钮单击
    /*
     $("input[type='submit']").click( function () {
     	 alert("ad");
     	 //提交表单
	     $.post("<?php echo $this->_tpl_vars['basePath']; ?>
admin/grant/update",$("#form1").serialize(),function (msg) {
			  alert(msg);		
		 });
		 return false;
     });
     */
 });
 function post_form(){
 	     //alert("ad");
     	 //提交表单
	     $.post("<?php echo $this->_tpl_vars['basePath']; ?>
admin/grant/update",$("#form1").serialize(),function (msg) {
			  alert(msg);		
		 });
		 return false;
 }
 
 
 function display_resource(role_id,role_name){
 
 	$.get("<?php echo $this->_tpl_vars['basePath']; ?>
admin/grant/resource/role_id/"+role_id, function(msg){
 		//alert(msg);
		$("#resource_content").html(msg);
		$("#role_id").val(role_id);
		$("#role_name").text(role_name);
		//alert($("#resource_content").html());
		//alert(role_id);
		//alert($("#role_id").val());
	});
   
 }
//显示或者隐藏
function toggleInfo(obj,id){
	
    
	var title_val=$(obj).html().replace("+","");
	var title_val=title_val.replace("-","");
	
	
		  if($(obj).html().indexOf("+")!=-1) {
		    $("#"+id).show();
		    $(obj).html(title_val+"-");
		    
		  }else if($(obj).html().indexOf("-")!=-1) {
		    $("#"+id).hide();
		    $(obj).html(title_val+"+");
		    
		  }
	
	
}

//选择一个module 里的所有checkbox
function selectModule(id,obj){
	if($(obj).attr('checked')==true){
		//alert("1");
		$("#"+id).find("input").attr('checked',true);
		
	}else{
		//alert("2");
		$("#"+id).find("input").attr('checked',false);
	}

	
}
</script>
<div style="float:left;width:30%">
<fieldset  >
	<legend>角色</legend>
	<table cellspacing="0">
	<thead>
	<tr class="headbg">
	<th >角色名列表</th>
	</tr>
	</thead>
	<tbody id='role_list'>
         <?php unset($this->_sections['contact']);
$this->_sections['contact']['name'] = 'contact';
$this->_sections['contact']['loop'] = is_array($_loop=$this->_tpl_vars['roles_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<tr style=" cursor:pointer" >
			<td  onclick="display_resource('<?php echo $this->_tpl_vars['roles_arr'][$this->_sections['contact']['index']]['role_id']; ?>
','<?php echo $this->_tpl_vars['roles_arr'][$this->_sections['contact']['index']]['role_zh_name']; ?>
')"><span  style="float:left"><?php echo $this->_tpl_vars['roles_arr'][$this->_sections['contact']['index']]['role_zh_name']; ?>
</span><span style="color:red; float:right; padding-right:10px;"><?php echo $this->_tpl_vars['roles_arr'][$this->_sections['contact']['index']]['role_en_name']; ?>
</span></td>
						
		</tr>
        <?php endfor; endif; ?>		
	</tbody>
	</table>
</fieldset>
</div>
<div style="width:70%;float:left">
<form name="form1" id="form1" method="POST" action="<?php echo $this->_tpl_vars['basePath']; ?>
admin/grant/update" >
<fieldset >
<legend><span id='role_name'></span>　授权</legend>
	<table cellspacing="0">
	<thead>
	<tr class="headbg">
	<th width="40%">资源中文名</th><th width="40%">资源英文名</th><th width="10%">读</th><th width="10%">写</th>
	</tr>
	</thead>
	
    
	<tbody id="resource_content" >
    
	</tbody>
	
	
	</table>
</fieldset>
</form>
</div>




<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>