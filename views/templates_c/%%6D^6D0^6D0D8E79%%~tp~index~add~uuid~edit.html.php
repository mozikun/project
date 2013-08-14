<?php /* Smarty version 2.6.14, created on 2013-08-08 09:25:28
         compiled from edit.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>工作计划</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<style>
	table
	{
		background:#ffffff;
	}
	.line
	{
		border-top:0px;
		border-left:0px;
		border-right:0px;
	}
	/*左上角*/
.Left_top {right:0;top:0;position:fixed;+position:absolute;top:expression(parseInt(document.body.scrollTop));}
</style>
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<script>
$(document).ready(function(){
	 $("form").submit( function () {
	 	var title = $("#title");
	 	var tips_time =  $("#tips_time");
	 	if(title.val()==""){
	 		alert("工作计划标题不能为空！");
	 		title.focus();
	 		return false;
	 	}
	  	if(tips_time.val()==""){
	 		alert("工作计划时间不能为空！");
	 		tips_time.focus();
	 		return false;
	 	}
	 });
	 //初始化工作计划类型
	 $.get("<?php echo $this->_tpl_vars['basePath']; ?>
tp/index/tipstypeajax/parent_id/"+<?php echo $this->_tpl_vars['tips_type']; ?>
+"/token/edit", function(data){
			 	//alert("Data Loaded: " + data);
			 	//var old_tips_type=$("#tips_type_content").html();
			 	if(data!=""){
			 		$("#tips_type_content").append(data);			
			 	} 	
	  });
	 /*var tips_region_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['tips_region_array']; ?>
');
	 var tips_type_info="";
	 for(var i=0;i<tips_region_array.length;i++){
	 	//alert(tips_region_array[i]);
	 	 $.get("<?php echo $this->_tpl_vars['basePath']; ?>
tp/index/tipstypeajax/parent_id/"+tips_region_array[i], function(data){
			 	 //alert("Data Loaded: " + data);
			 	//var old_tips_type=$("#tips_type_content").html();
			 	if(data!=""){
			 		$("#tips_type_content").append(data);			
			 	} 	
	 	 });
	 	//tips_type_info+=
	 }*/
	 //$("#tips_type_content").html(tips_type_info);	 
	 
	 //计划类型改变时
	$("select[name=tips_type]").live("change",function(){
       
	 	var current_val=$(this).val();
	 	var this_obj=$(this);
	 	if(current_val!=""){
	 		    $.get("<?php echo $this->_tpl_vars['basePath']; ?>
tp/index/tipstypeajax/parent_id/"+current_val, function(data){
			 	 //alert("Data Loaded: " + data);
			 	//var old_tips_type=$("#tips_type_content").html();
			 	if(data!=""){
			 		$("#tips_type_content").html(data);			
			    }else{
			 		//var old_tip_type_content=$("#tips_type_content").html();
			 		//alert(old_tip_type_content);
			 		
			 		//var sel_tips_type_arr =$("select[name=tips_type]");
			 		
			 		this_obj.nextAll("select").remove();
			 		
			 	} 		

			});			
	 	}

	 });
});
</script>
</head>
<body>

<div id="search_list"></div>
<form action="<?php echo $this->_tpl_vars['basePath']; ?>
tp/index/update" id="form1" method="POST">
<input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
<input type="hidden" name="user_token" value="<?php echo $this->_tpl_vars['user_token']; ?>
"/>
	<table border="0" width="100%">
		<tr  class="headbg"><td colspan="2"  style="text-align:center;"><?php echo $this->_tpl_vars['title_token']; ?>
</td></tr>
		<?php if ($this->_tpl_vars['user_token'] != 'group'): ?>
		<tr><td >居民姓名</td><td><?php echo $this->_tpl_vars['name']; ?>
</td></tr>
		<tr><td >性别</td><td><?php echo $this->_tpl_vars['sex']; ?>
</td></tr>
		<tr><td >年龄</td><td><?php echo $this->_tpl_vars['age']; ?>
</td></tr>
		<tr><td>电话</td><td><?php echo $this->_tpl_vars['telphone']; ?>
</td></tr>
		<tr><td>详细地址</td><td><?php echo $this->_tpl_vars['faminy_add']; ?>
</td></tr>
		<tr><td  colspan="2"></td></tr>
		<?php endif; ?>
		<tr><td width="30%">标题</td><td><input type='text' name='title' id='title' value='<?php echo $this->_tpl_vars['title']; ?>
' length=''  /></td></tr>
		<tr><td>计划类型</td><td>
		
		<span id="tips_type_content">
			
		</span>
		</td></tr>
		<tr><td>计划预定执行时间</td><td><input type="text" name="tips_time" id="tips_time"  class="Wdate"  value='<?php echo $this->_tpl_vars['tips_time']; ?>
' onfocus="WdatePicker({firstDayOfWeek:1})"  MINDATE="1930-1-1" MAXDATE="2015-12-31" readonly="readonly" /></td></tr>
		
		<tr><td>计划参与人员</td>
		<td>
		    <?php unset($this->_sections['experience']);
$this->_sections['experience']['loop'] = is_array($_loop=$this->_tpl_vars['region_users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['experience']['name'] = 'experience';
$this->_sections['experience']['show'] = true;
$this->_sections['experience']['max'] = $this->_sections['experience']['loop'];
$this->_sections['experience']['step'] = 1;
$this->_sections['experience']['start'] = $this->_sections['experience']['step'] > 0 ? 0 : $this->_sections['experience']['loop']-1;
if ($this->_sections['experience']['show']) {
    $this->_sections['experience']['total'] = $this->_sections['experience']['loop'];
    if ($this->_sections['experience']['total'] == 0)
        $this->_sections['experience']['show'] = false;
} else
    $this->_sections['experience']['total'] = 0;
if ($this->_sections['experience']['show']):

            for ($this->_sections['experience']['index'] = $this->_sections['experience']['start'], $this->_sections['experience']['iteration'] = 1;
                 $this->_sections['experience']['iteration'] <= $this->_sections['experience']['total'];
                 $this->_sections['experience']['index'] += $this->_sections['experience']['step'], $this->_sections['experience']['iteration']++):
$this->_sections['experience']['rownum'] = $this->_sections['experience']['iteration'];
$this->_sections['experience']['index_prev'] = $this->_sections['experience']['index'] - $this->_sections['experience']['step'];
$this->_sections['experience']['index_next'] = $this->_sections['experience']['index'] + $this->_sections['experience']['step'];
$this->_sections['experience']['first']      = ($this->_sections['experience']['iteration'] == 1);
$this->_sections['experience']['last']       = ($this->_sections['experience']['iteration'] == $this->_sections['experience']['total']);
?>
			  <?php $this->assign('checked', ""); ?> 
			  <?php $_from = $this->_tpl_vars['tips_framer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				 <?php if ($this->_tpl_vars['v'] == $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['user_id']): ?> <?php $this->assign('checked', 'checked');  endif; ?>
			  <?php endforeach; endif; unset($_from); ?>
			  
			<label><input type="checkbox" name="tips_framer[]" value="<?php echo $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['user_id']; ?>
" <?php echo $this->_tpl_vars['checked']; ?>
/><?php echo $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['name_real']; ?>
</label>&nbsp;
			<?php $this->assign('checked', ""); ?> 			
			<?php endfor; endif; ?>
		</td>
		</tr>
		<tr><td>计划备注</td><td><textarea name="tips_info" rows="6" cols="40"><?php echo $this->_tpl_vars['tips_info']; ?>
</textarea></td></tr>
		<tr><td>计划制定者</td>
		<td>
		    <?php unset($this->_sections['experience']);
$this->_sections['experience']['loop'] = is_array($_loop=$this->_tpl_vars['region_users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['experience']['name'] = 'experience';
$this->_sections['experience']['show'] = true;
$this->_sections['experience']['max'] = $this->_sections['experience']['loop'];
$this->_sections['experience']['step'] = 1;
$this->_sections['experience']['start'] = $this->_sections['experience']['step'] > 0 ? 0 : $this->_sections['experience']['loop']-1;
if ($this->_sections['experience']['show']) {
    $this->_sections['experience']['total'] = $this->_sections['experience']['loop'];
    if ($this->_sections['experience']['total'] == 0)
        $this->_sections['experience']['show'] = false;
} else
    $this->_sections['experience']['total'] = 0;
if ($this->_sections['experience']['show']):

            for ($this->_sections['experience']['index'] = $this->_sections['experience']['start'], $this->_sections['experience']['iteration'] = 1;
                 $this->_sections['experience']['iteration'] <= $this->_sections['experience']['total'];
                 $this->_sections['experience']['index'] += $this->_sections['experience']['step'], $this->_sections['experience']['iteration']++):
$this->_sections['experience']['rownum'] = $this->_sections['experience']['iteration'];
$this->_sections['experience']['index_prev'] = $this->_sections['experience']['index'] - $this->_sections['experience']['step'];
$this->_sections['experience']['index_next'] = $this->_sections['experience']['index'] + $this->_sections['experience']['step'];
$this->_sections['experience']['first']      = ($this->_sections['experience']['iteration'] == 1);
$this->_sections['experience']['last']       = ($this->_sections['experience']['iteration'] == $this->_sections['experience']['total']);
?>
		    <?php $this->assign('checked', ""); ?> 
		    <?php $_from = $this->_tpl_vars['current_doctor']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>			        		
				<?php if ($this->_tpl_vars['v'] == $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['user_id']): ?> <?php $this->assign('checked', 'checked');  endif; ?>
				
			<?php endforeach; endif; unset($_from); ?>
			<label><input type="checkbox" name="tips_serial[]" value="<?php echo $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['user_id']; ?>
"  <?php echo $this->_tpl_vars['checked']; ?>
/><?php echo $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['name_real']; ?>
</label>&nbsp;
			<?php $this->assign('checked', ""); ?> 
			<?php endfor; endif; ?>
		</td>
		</tr>
		<tr><td  colspan="2"  style="text-align:center;"><input type="submit"  value=" 提交 "/> &nbsp;<input name="fh" type="button" value=" 返回 " onClick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
tp/index';" /></td></tr>
	</table>	

</form>
</body>
</html>