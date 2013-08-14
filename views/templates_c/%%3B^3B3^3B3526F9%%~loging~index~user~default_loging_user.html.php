<?php /* Smarty version 2.6.14, created on 2013-04-27 20:06:39
         compiled from default_loging_user.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>雅安市区域卫生信息平台</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/login/user.css"/>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
 <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/j.dimensions.js"></script>
 <?php if ($this->_tpl_vars['currentregion'] == ''): ?>
 <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/organization.js"></script>
 <?php else: ?>
 <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/<?php echo $this->_tpl_vars['currentregion']; ?>
.js"></script>
 <?php endif; ?>
 <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/j.suggest.js"></script>
 <script type="text/javascript">
	 $(function(){
	 	 $("#Layer1").hide();
		 $("#organize").suggest(organizationArray,{hot_list:organizationArray,dataContainer:'#organize_code',onSelect:function(){$("#organize_passwd").focus();}, attachObject:'#suggest'});
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
doctor/index";
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

</head>

<body>
<table border="0" cellspacing="0" cellpadding="0" style="margin-left: 10%;margin-top: 20%;">
<tr><td colspan="2" id="logo">&nbsp;</td></tr>
<tr><td><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/login_lf.gif" /></td><td style="background:url(<?php echo $this->_tpl_vars['basePath']; ?>
images/login_rf.gif) top left no-repeat;width: 344px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mtab">
          <tr>
            <td width="27%" align="right">机构名称：</td>
            <td width="73%" style="text-align: left;padding-left: 2px;">
             <input type="hidden" name="organize_code" id="organize_code" value="" />
             <input type="text" name="organize" id="organize" size="16"  class="txt"/>
             <div id='suggest' class="ac_results">
             </div>
            
            </td>
          </tr>
          <tr>
            <td align="right">机构密码：</td>
            <td style="text-align: left;padding-left: 2px;"><input type="password" name="organize_passwd" id="organize_passwd" size="16" maxlength="16"  class="txt"/></td>
          </tr>
          <tr>
            <td align="right">用户账号：</td>
            <td style="text-align: left;padding-left: 2px;">
            	<select name="user_id" id="user_id"  class="est">
            	</select>
            </td>
          </tr>
          <tr>
            <td align="right">用户密码：</td>
            <td style="text-align: left;padding-left: 2px;"><input type="password" name="user_passwd" id="user_passwd" size="16" maxlength="16"  class="txt" /></td>
          </tr>
          <tr class="last">
            <td align="right">&nbsp;</td>
            <td><span>

              <input type="image" name="loginsubmit" value=" 登录 "  id="loginsubmit" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/login_login.gif" />
              </span><span style="margin-left: 20px;*margin-left: -10px;">
              <input type="image" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/login_cancel.gif" name="Submit2" value=" 退出 " onClick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
loging/index';return false;" style="margin-left: 20px;" />
              </span>
              </td>
          </tr>
        </table>
        </td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td colspan="2" style="text-align: center;color: #fff;font-size: 12px;">一切为了人民健康。 非法窃取个人信息的都是刑事犯罪！四川省雅安市卫生局 © 2010-2013</td></tr>
</table>
</body>
</html>