<?php /* Smarty version 2.6.14, created on 2013-05-02 09:55:42
         compiled from login.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="translated-ltr"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/android.css" rel="stylesheet" type="text/css" media="screen">
<body style="background:lightblue">
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="login">
<form id="form">
<div class="middle">
	<div class="info">
	<span id='jumin_info' style="display:none" >身份证号:<input class="input" type='text' name='identity_number'/></span>
	<div id='doctor_info' style="display:none">
	<span>机构名称:<select id="org" >
			<?php $_from = $this->_tpl_vars['org']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
			 <option value="<?php echo $this->_tpl_vars['i']['org_id']; ?>
"><?php echo $this->_tpl_vars['i']['org_name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?> 
			 </select><br/><br/>
   
	用户账号:<span id='u'><input class="input" name="user" type='text' /></span><br/><br/>
	用户密码:<input class='input' type='password' name='password' id="password" />
	</span>
	</div>
	</div>
	<div class="info"><span>
	选择你的身份:<input id='jumin' name='shenfen' type='radio' value='1'/>居民
				  <input id='doctor' name='shenfen' type='radio' value='2'/>医生
		 </span>		  
	</div>			  
<div class="foot">
	<input type='button' onclick="login()"  value='登陆' class="button"/> 
	<input type='button' value='取消' class="button" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
android/android/index'"/>
</div>
</div>
</form>
</div>
</body>
<script type='text/javascript'>
/*
	$("#login").height($(window).height()-100);
	$("#login").width($(window).width()-50);
	*/
</script>

<script>
$(".button").bind("vmousedown",function(e){
	$(this).css("background"," -webkit-gradient(linear, 0 0, 0 100%, from(rgb(6,135,183)), to(rgb(11,111,148)))");
	});
$(".button").bind("vmouseup",function(e){
 var elem = this;
	setTimeout(function(){$(elem).css("background","-webkit-gradient(linear, 0 0, 0 100%, from(rgb(6,159,213)), to(rgb(13,127,169)))");},300);
	});	
	
$(".input").bind("vfocus",function(e){
	$(this).css("background"," -webkit-gradient(linear, 0 0, 0 100%, from(rgb(6,135,183)), to(rgb(11,111,148)))");
	});	
$(document).ready(function(){
	//按钮变色
	//获取用户
	$("#org").change(function(){ 
		$.get("<?php echo $this->_tpl_vars['basePath']; ?>
android/user/getuser/org_id/"+$(this).val(),function(info){
			$("#u").html(info);
		});
	})
	
	//切换用户类型
	$("#jumin").click(function(){
	
		$("#doctor_info").css("display","none");
		$("#jumin_info").css("display","block");
		
	});
	$("#doctor").click(function(){
	
		$("#jumin_info").css("display","none");
		$("#doctor_info").css("display","block");
		
	});
});


//提交数据
function login(){
	if($('input:radio[name="shenfen"]:checked').val()==null){
		alert("请选择您的身份");
		return false;
	}
	var user=$("#user").val();
	var data=$("#form").serialize();  
	$.post("<?php echo $this->_tpl_vars['basePath']; ?>
android/user/logindb/user/"+user,data,function(info){
		var flag=info.split("|");
		if(flag[0]==2)
		alert(flag[1]);
		if(flag[0]==1)
		window.location="<?php echo $this->_tpl_vars['basePath']; ?>
android/android/index";
		if(flag[0]==3)
		window.location="<?php echo $this->_tpl_vars['basePath']; ?>
android/user/doctorhome/doctor_id/"+user;
	});
}
</script>
</html>