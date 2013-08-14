<?php /* Smarty version 2.6.14, created on 2013-04-27 20:06:25
         compiled from index.html */ ?>
in 测试默认 index html
<br />
姓名：<font color="red"><?php echo $this->_tpl_vars['name']; ?>
</font><br />
年龄：<font color="blue"><?php echo $this->_tpl_vars['age']; ?>
</font><br />
照片:<img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/noimage.jpg"><br />
<a href="<?php echo $this->_tpl_vars['basePath']; ?>
oracle/oracle/test">测试oracle</a><br />
<a href="<?php echo $this->_tpl_vars['basePath']; ?>
doctor">测试doctor</a><br />
<a href="<?php echo $this->_tpl_vars['basePath']; ?>
statistics/iha/index">测试statistics/iha/index</a><br />



<form action="" method="POST">
<input type="hidden" name="message" id="message" value="<?php echo $this->_tpl_vars['message']; ?>
">
<a href="#" id="back" style="display:none">请返回</a>
<input type="submit" name="ok" id="ok" value="保存" />
</form>
<script type="text/javascript">
if($('message').value!=''){
	alert($('message').value);
	$('back').style.display='block';
}
function $(objName){
	return document.getElementById(objName);
}
</script>