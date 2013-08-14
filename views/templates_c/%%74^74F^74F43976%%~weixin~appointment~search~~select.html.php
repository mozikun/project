<?php /* Smarty version 2.6.14, created on 2013-08-13 17:14:23
         compiled from select.html */ ?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/jquerymobile.min.css" rel="stylesheet" type="text/css" media="screen" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquerymobile.min.js"></script>
<style>
.tips{
	height:40px;
	background: #ffcece;
    border-color: #df8f8f;
    color: #665252;
	margin-bottom:10px;
	text-align:center;
	border-radius:5px;
	color: #556652;
}
.tips span {
   line-height:40px;
   
}

</style>
<div data-role="page" >
	
	
	<form method="post"  action="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/appointment/search/">
    <div data-role="content">
	      
         <div data-role="fieldcontain">
			<?php if ($this->_tpl_vars['message']): ?>
			<div  class="tips"><span><?php echo $this->_tpl_vars['message']; ?>
</span></div>
			<?php endif; ?>
            <label for="textinput1">
                输入您的身份证号:
            </label>
			<br/>
            <input name="identity_number" id="identity_number" placeholder="" value="" type="text">
			<br/>
			 <label for="textinput1">
                输入密码:
            </label>
			<br/>
            <input name="password" id="password" placeholder="" type="password">
		</div>
        <input type="submit"  value="查询">
    </div>
	</form>
</div>
</html>