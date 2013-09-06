<?php /* Smarty version 2.6.14, created on 2013-09-03 14:26:04
         compiled from lead_login.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>监管平台-登陆</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/lead/site.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/lead/login.css"/>

</head>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script type="text/javascript">
	 $(function(){

	 		 	
		
		 //机构密码失去焦点
		 $("#organize_passwd").blur( function (){
				var organize_code  = $("#organize_code").val();//机构代码
				var organize_passwd= $("#organize_passwd").val();//机构密码
				
		 		//机构代码和机构密码不能为空验证表单
				var user=$("#user_id");//用户下拉框
		 		if(organize_code!=""  && organize_passwd!=""){
		 			if(organize_passwd.match(/[\u4e00-\u9fa5 0-9 a-z_]{1}/i)){
			   	  	    $("#Layer1").show();
		        		user.html('<option >载入中,请等待！</option>'); 
			   	    }else{
				   	  	alert("机构密码格式不对!");
				   	  	user.empty();//清空下拉选项
				   	  	return false;
			   	    }
					$.get("<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/chkoragnize/organize_code/"+organize_code+"/organize_passwd/"+organize_passwd, function(data){
					  
					  if(data.indexOf("~")==-1){
					  	 alert("网络不通！");
					  	 user.empty();//清空下拉选项
					  	 return false;
					  }
					  var msg_arr=data.split("~");
					  var msg_code=msg_arr[0];//信息代码
					  var msg_content=msg_arr[1];//信息提示
					  
					  //alert(data);
					  
					
					  user.empty();//清空下拉选项
					  if(msg_code!=1){
					  	  //alert(msg_content);
					  	  $("#Layer1").hide();
						  return false;
					  }else{
						  var user_array=msg_content.split("|");
						
						  for(i=0;i<user_array.length;i++){
						        //alert(user_array[i]);
						  		var user_arr= (user_array[i]).split(":");//得到用户id和登录名
								user.append('<option value="'+user_arr[0]+'">'+user_arr[1]+'</option>');   
						  }
						  user.focus();
						  $("#Layer1").hide();
					  }
				
				  	 
					  
					});
				}
		 
		 } );
		
		
		//提交表单
         $("#loginsubmit").click(function(){
         	   
		       var organize_code  = $("#organize_code").val();//机构代码
			   var organize_passwd= $("#organize_passwd").val();//机构密码
			   var user_code	  = $("#user_id").val();//用户代码
			   var user_passwd    = $("#user_passwd").val();//用户密码
			   
			   if(organize_code==""){
			    	alert("请输入机构名！");
			   		$("#organize").focus();
					return false;
			   }
			   if(organize_passwd==""){
			    	alert("请输入机构密码！");
			   		$("#organize_passwd").focus();
					return false;
			   }else{
			   	  if(organize_passwd.match(/[\u4e00-\u9fa5 0-9 a-z_]{1}/i)){
			   	  	 
			   	  }else{
			   	  	alert("机构密码格式不对!");
			   	  	return false;
			   	  }
			   	
			   }
			    if(user_code==""){
			    	alert("请选择用户名！");
			   		$("#user_id").focus();
					return false;
			   }
			   if(user_passwd==""){
			    	alert("请选择用户密码！");
			   		$("#user_passwd").focus();
					return false;
			   }else{
				      if(user_passwd.match(/[\u4e00-\u9fa5 0-9 a-z_]{1}/i)){
				   	  	 
				   	  }else{
				   	  	alert("用户密码格式不对!");
				   	  	return false;
				   	  }
			   	
			   }
			   
			   
			   $.get("<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/chkuser/organize_code/"+organize_code+"/user_code/"+user_code+"/user_passwd/"+user_passwd, function(data){
				  	
				    //alert(data);
				    var msg_arr = data.split("|");
				    if(msg_arr[0]==1){
				    	window.location="<?php echo $this->_tpl_vars['basePath']; ?>
lead/index/index";
				  		return false;
				    }
				  	//document.write(data);
					
					alert(msg_arr[1]);
				    return false;
					
			   });
			   return false;
						 
		 });
	});
	
</script>
<body>
<div class="login_box">
  <div class="title">
    <h1>雅安市县级卫生信息监管平台</h1>
  </div>
  <div class="login_conts">
      <input type="hidden" name="organize_code" id="organize_code" value="<?php echo $this->_tpl_vars['org_code']; ?>
" />
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="nes">
        <tr>
          <td width="33%" align="right"><label for="can_name">机构名称：</label></td>
          <td width="67%"><input id="organize_name" name="organize_name" type="text" value="<?php echo $this->_tpl_vars['org_name']; ?>
"  disabled="disabled"/></td>
        </tr>
        <tr>
          <td align="right"><label for="can_password">机构密码：</label></td>
          <td><input id="organize_passwd" name="organize_passwd" type="password" /></td>
        </tr>
        <tr>
          <td align="right"><label for="select">用户账号：</label></td>
          <td><select name="user_id" id="user_id">
              
            </select></td>
        </tr>
        <tr>
          <td align="right"><label for="adm_password">用户密码：</label></td>
          <td><input id="user_passwd" name="user_passwd" type="password" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input class="image" name="loginsubmit"  id="loginsubmit" type="image" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/lead/ya_19.png" />
          <input class="image" id="cancel" type="image" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/lead/ya_20.png"    onClick="window.location.href='<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/leadindex'"/>
          </td>
        </tr>
      </table>
  </div>
</div>
</body>
</html>