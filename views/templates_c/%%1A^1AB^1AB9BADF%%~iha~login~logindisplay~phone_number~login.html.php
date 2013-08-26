<?php /* Smarty version 2.6.14, created on 2013-08-26 13:47:49
         compiled from login.html */ ?>
﻿<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/jquerymobile.min.css" rel="stylesheet" type="text/css" media="screen" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquerymobile.min.js"></script>
<style type="text/css"> 

p { font-size: 1.5em; 

font-weight: bold; 

} 

#submit{ 

float:right; margin:10px; 

} 

#toregist{ 

float:left; margin:10px; 

} 

</style>
<script type="text/javascript">
	function send(){
	    var data=$("#info").serialize(); 
		$.post("<?php echo $this->_tpl_vars['basePath']; ?>
iha/login/login/",data,function(info){
		var rows=info.split("|");
		//登陆成功
		if(rows[0]==3)
		{   
		    alert(rows[1]);
			window.location.href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/login/index/device_id/<?php echo $this->_tpl_vars['device_id']; ?>
";
			//window.location.href="www.baidu.com";
		}
		else
		{
			alert(rows[1]);
		}
		});
		
	}
	function back(){
		window.location.href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/login/index/device_id/<?php echo $this->_tpl_vars['device_id']; ?>
";
	}
</script>


<body> 


<!-- begin first page -->

<section id="page1" data-role="page">

<header data-role="header" data-theme="b" ><h1>居民健康掌中宝</h1></header>

<div data-role="content" class="content">

<p style="backg"><font color="#2EB1E8" >登录掌中宝</font></p>

<form method="post" id="info">

<input type="text" name="identity_number" id="identity_number" /><br>

<input type="password" name="password" id="password" />

<fieldset data-role="controlgroup" >

<input type="checkbox" name="checkbox-1" id="checkbox-1" class="custom" />

<label for="checkbox-1">保持登录状态</label>

</fieldset>

<a href="content/regist.html" data-role="button" id="toregist" data-theme="e">注册</a>

<a data-role="button" id="submit" data-theme="b" onclick="send()">登录</a>

</form>

</div>
<div data-theme="a" data-role="footer" data-position="fixed">
        <h3>
           
        </h3>
    </div>
</section>

<!-- end first page -->

</body>
