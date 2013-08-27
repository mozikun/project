<?php /* Smarty version 2.6.14, created on 2013-08-27 10:49:20
         compiled from index.html */ ?>
<!doctype html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0,user-scalable=no" />
<title>雅安居民健康掌中宝</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/mobileindex.css"/>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
</head>
<body style='background:rgb(0,145,223)'>
<div class="ui-mobile-viewport">
  <div class="content" style="zoom:0.6667">
    <div class="absorbs one"><a onclick="check(3);" href="#"  title="体检信息">体检信息</a></div>
    <div class="absorbs two"><a href="#" onclick="check(4);" title="慢病信息">慢病信息</a></div>
    <div class="absorbs three"><a href="#" onclick="check(2);"title="健康信息">健康信息</a></div>
    <div class="absorbs four"><a href="#" onclick="check(1);"title="个人信息">个人信息</a></div>
    <div class="absorbs six"><a href="#" onclick="window.location.href='<?php echo $this->_tpl_vars['basePath']; ?>
android/hospital/list'">找医院</a></div>
    <div class="absorbs seven"><a href="#" onclick="check(7);" title="健康教育">健康教育</a></div>
    <div class="absorbs eight"><a href="#"onclick="check(5);" title="就诊查询">就诊查询</a></div>
	<div class="absorbs five"><a href="#" onclick="check(6);" title="处方记录">处方记录</a></div>
  </div>
  <div class="ui-footer">
  <?php if ($this->_tpl_vars['login'] == 1): ?>   
  <a id="exit" href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/login/loginout/device_id/<?php echo $this->_tpl_vars['device_id']; ?>
">退出</a>
  <?php else: ?>
  <a id="login" href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/login/logindisplay/phone_number/<?php echo $this->_tpl_vars['phone_number']; ?>
/device_id/<?php echo $this->_tpl_vars['device_id']; ?>
">登陆</a>
  <?php endif; ?> 
   <a id="login" href="<?php echo $this->_tpl_vars['basePath']; ?>
android/android/index/">返回</a>
  </div>
</div>
<script type='text/javascript'>
	function check(action){
		if(<?php echo $this->_tpl_vars['login']; ?>
!=1){
			alert("您还没有登录！");
			window.location.href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/login/logindisplay/phone_number/<?php echo $this->_tpl_vars['phone_number']; ?>
/device_id/<?php echo $this->_tpl_vars['device_id']; ?>
";
			//history.go(-1);	
		}
		else
			window.location="<?php echo $this->_tpl_vars['basePath']; ?>
iha/extsearch/extsearch/action/"+action+"/org/000000/id/<?php echo $this->_tpl_vars['identity_number']; ?>
/hash/234556.999";
	}
	function check1(){
		if(<?php echo $this->_tpl_vars['login']; ?>
!=1){
			alert("您还没有登录！");
			window.location.href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/login/logindisplay/phone_number/<?php echo $this->_tpl_vars['phone_number']; ?>
";
			//history.go(-1);	
		}
		else
			window.location="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/reservation/index";
	}
	//检查登陆
	function check_login(){
			window.location.href="<?php echo $this->_tpl_vars['basePath']; ?>
android/chat/index";

	}
</script>
</body>
</html>