<?php /* Smarty version 2.6.14, created on 2013-06-18 10:04:42
         compiled from login.html */ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0,maximum-scale=1.0" />
<meta name="MobileOptimized" content="320"/>
<title>雅安市区域卫生信息平台-用户登陆</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/android/css/site.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/android/css/main.css">


 <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
 
<script type="text/javascript">
 $(function(){
 	
            $("#loginsubmit").click(function(){
         	   
		      // var organize_code  = $("#organize_code").val();//机构代码
			//   var organize_passwd= $("#organize_passwd").val();//机构密码
			//   var user_code	  = $("#user_id").val();//用户代码
			   var user_passwd    = $("#user_passwd").val();//用户密码
                           var yanz=$("#yanz").val();//验证码
			   if(user_passwd==""){
			    	alert("请输入用户密码!");
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
loging/index/chkuser/user_passwd/"+user_passwd+"/action/android"+"/yanz/"+yanz, function(data){
				  	
				    //alert(data);
				    var msg_arr = data.split("|");
				    if(msg_arr[0]==1){
				    	window.location="<?php echo $this->_tpl_vars['basePath']; ?>
android/index/main";
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
<div class="login">
  <form id="form1" target="_self" method="post">
    <ul class="lgbox">
    <li class="yh_title">用户登录-<span>login</span></li>
      <li>
        <label for="password">密&nbsp;&nbsp; 码：</label>
        <input type="password" id="user_passwd" />
      </li>
      <li>
        <label for="yanz">验证码：</label>
        <input type="text" id="yanz"/><img id='checkcode' src="<?php echo $this->_tpl_vars['basePath']; ?>
android/index/image" onclick="this.src=this.src='<?php echo $this->_tpl_vars['basePath']; ?>
android/index/image/randdate/'+Math.random()" style="cursor:pointer;border: 1px solid #ffffff" alt="看不清，点击刷新验证码"  />
      </li>
      <li class="li_lo">
        <input type="image" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/android/images/login.png" title="登录" id="loginsubmit" />
        <input type="image" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/android/images/cancel.png" title="取消" onclick="window.close()"/>
      </li>
    </ul>
  </form>
    
</div>
</body>
</html>