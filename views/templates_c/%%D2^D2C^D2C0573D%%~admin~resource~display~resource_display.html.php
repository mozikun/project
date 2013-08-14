<?php /* Smarty version 2.6.14, created on 2013-06-17 16:06:43
         compiled from resource_display.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
 $(function(){
 	
 	$('#form_table').css("display","none");
 	$('#form_table').css("background-color","#F5F5F5");
    
 	 //提交按钮单击事件
	 $("#form1").submit( function () {
	      
		   //对资源名进行验证－－start
	 	　 var resource_en_name  = $("#resource_en_name").val();
		   var resource_zh_name  = $("#resource_zh_name").val();	
			  
		   if(resource_en_name.length<2){
			  alert("资源英文名也太短了吧!");
			  $("#resource_en_name").focus();
			  return false;
		   }
		   if(resource_zh_name.length<2){
			  alert("资源名也太短了吧!");
			  $("#resource_zh_name").focus();
		
			  return false;
		   }
		   if(resource_en_name.match(/^[a-zA-Z0-9_\-]{2,60}$/)){
			 
		   }else{
			  alert("资源英语名只能是数字,字母,下划线");
			  return false;
		   }
		   //对资源名进行验证--stop
		  
		 //提交表单
         $.post("<?php echo $this->_tpl_vars['basePath']; ?>
admin/resource/update",$("#form1").serialize(),function (msg) {
		 		//alert(msg);
			    var mm=msg.split("|");
				
				alert(mm[2]);
				//更新成功后　更新列表
				if(mm[1]=='true'){
		            //更新列表
					$.get("<?php echo $this->_tpl_vars['basePath']; ?>
admin/resource/list", function(data){
 						 $("#resource_list").html(data);
 						 add_record('23');//清除输入信息
 						 $('#form_table').bPopup().close();
					}); 
					add_record();//清除输入信息
				}
				
			});
			
			
		  return false;
    } ); 
    
    
    
 });
  //链接添加，清空输入内容
  function add_record(){
  
  	$("#resource_en_name").val("");
	$("#resource_zh_name").val("");
	
	$("#resource_id").val("");
	$("#resource_en_name").focus();
	if("undefined" == typeof(token)){
	$('#form_table').bPopup({
	          fadeSpeed: 'fast', //can be a string ('slow'/'fast') or int
	          followSpeed: 'fast', //can be a string ('slow'/'fast') or int
	          modalColor: 'black'

	            //modalClose: false
	  });
	}
		
  }
  //链接修改，清空输入内容
  function update_record(resource_id){
  	
  	$("#resource_en_name").val($("#en_"+resource_id).text()); 	  	
	$("#resource_zh_name").val($("#zh_"+resource_id).text());	
	$("#resource_id").val(resource_id);	
	
	$('#form_table').bPopup({
            fadeSpeed: 'fast', //can be a string ('slow'/'fast') or int
            followSpeed: 'fast', //can be a string ('slow'/'fast') or int
            modalColor: 'black'
            //zIndex: 2,
            //modalClose: false
            
    });
	$("#resource_en_name").focus();
  }
  ////链接删除，清空输入内容
  function del_record(resource_current_id,obj){
  	
   if(confirm('你真的要删除么？删除后将不能恢复！')){
                $.get("<?php echo $this->_tpl_vars['basePath']; ?>
admin/resource/delete/resource_id/"+resource_current_id, function(msg){
	  			//alert(msg);
	  			 var mm=msg.split("|");
					
				 alert(mm[2]);
				//删除成功
	            if(mm[1]=="true"){
					//更新列表
					$.get("<?php echo $this->_tpl_vars['basePath']; ?>
admin/resource/list", function(data){
					//$(obj).parents("tr").remove();
					    $("#resource_list").html(data);
						$("#resource_en_name").val("");
						$("#resource_zh_name").val("");	
						$("#resource_id").val("");
	               }); 
				}
		}); 
  }
  	
	
	
  }
  
  function chk_form(){
   var resource_en_name  = $("#resource_en_name").val();
   var resource_zh_name  = $("#resource_zh_name").val();	
      
   if(resource_en_name.length<2){
      alert("资源英文名也太短了吧!");
	  $("#resource_en_name").focus();
	  return false;
   }
   if(resource_zh_name.length<2){
      alert("资源名也太短了吧!");
	  $("#resource_zh_name").focus();

	  return false;
   }
   if(resource_en_name.match(/^[a-zA-Z0-9_\-]{2,60}$/)){
     
   }else{
      alert("资源英语名只能是数字,字母,下划线");
	  return false;
   }
   return true;
  }
  
 
  
  //全选、反选
function checkselect(obj) {
	  //for (var i = 0; i < document.getElementsByName("selectFlag[]").length; i++) {
	  //	if(document.getElementsByName("selectFlag[]")[i].checked ==true){
	  //		document.getElementsByName("selectFlag[]")[i].checked = false;
	  	//}else{
	  	//	document.getElementsByName("selectFlag[]")[i].checked = true;
	  		//$("input[type='checkbox']").attr('checked',true);
	  //	}
	   
	 // }
	 var checkbox_obj= $("input[type='checkbox']");
	 checkbox_obj.each(function () { 
		 if($(obj).attr('checked') ==true ){	
		 	if($(this).attr('checked')==true){
		 		$(this).attr('checked',false);
		 	}else{
		 		$(this).attr('checked',true);
		 	} 	
		 	
		 }else{
		 	if($(this).attr('checked')==true){
		 		$(this).attr('checked',false);
		 	}else{
		 		$(this).attr('checked',true);
		 	} 	
		 }
	});

	 
	 
}
//选中与否，有选中项才执行删除	 
function checkselected(){
	var token=0;//标志
	$("input[name='selectFlag[]']").each(function(){
	
		if($(this).attr('checked')==true){
			token=1;//有选中项
			
			
		}
	
		
	});
	//alert(token);
	if(token==1){
		if(confirm('你真的要删除选中项么？删除后将不能恢复！')){
			//执行删除操作
			
			  $.post("<?php echo $this->_tpl_vars['basePath']; ?>
admin/resource/delete/",$("#from_post").serialize(),function (msg) {
			  	//alert(msg);
			  	var mm=msg.split("|");				
			    alert(mm[2]);
			     //更新列表
				$.get("<?php echo $this->_tpl_vars['basePath']; ?>
admin/resource/list/", function(data){
			　　 　  $("#resource_list").html(data);
					$("#res_name_en").val("");

					$("#res_name_zh").val("");	
					$("#resource_id").val("");				
		　　　　　}); 
			   
		 });
		 return false;
		}else{
			//取消删除
			return false;
		}
		//return false;
	}else{
		alert('没有选中要删除的项！');
		return false;
	}
	
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
<div>
<fieldset id="list"  style="width:80%;">
	<legend>资源列表</legend>
	<form action="" id='from_post'>
	<table cellspacing="0">

	<tbody id='resource_list'>
       <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./resource_list.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	

	
	</tbody>
	<tr>
	 <td >
	 <label><input type="checkbox" value="" name="ifAll" id="ifAll" onClick="return checkselect(this);"/>全选/反选 </label>
	 <input type="button" onclick="return checkselected();"  name="delAll" value="删除" class="inputbutton"/>
	 </td>
	</tr>
	</table>
	</form> 
</fieldset>
</div>

<div style="width:50%">
<fieldset id="form_table">
<a name="update_resource" id="update_resource"></a>

	<table cellspacing="0">
	<thead>
	<tr class="headbg">
	<th colspan="2">资源管理</th>
	</tr>
	</thead>
	<form name="form1" id="form1" method="POST" action="<?php echo $this->_tpl_vars['basePath']; ?>
admin/resource/update">
	<input type="hidden" name="resource_id" id="resource_id"/>
	<tbody >
		<tr>
		<td>资源英文名</td><td><input type="text" id="resource_en_name" name="resource_en_name"/></td>
		</tr>
		<tr>
		<td>资源中文名</td><td><input type="text" id="resource_zh_name" name="resource_zh_name"/></td>
		</tr>
		<tr>
		<td></td><td><input type="submit"　　　　　　　　  value="提交"/></td>
		</tr>

	
	</tbody>
	</form>
	</table>
</fieldset>

</div>




<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>