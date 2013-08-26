<?php /* Smarty version 2.6.14, created on 2013-08-26 14:35:01
         compiled from hospital.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="translated-ltr"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/android.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<body style="background:rgb(236,245,249)">
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="hospital">
	<ul>
		<li><a ><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/hos_yyjx.png" width=60px;/><br/>医院介绍</a></li>
		<li><a><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/hos_lxfs.png" width=60px;/><br/>联系方式</a></li>
		<li><a href="<?php echo $this->_tpl_vars['basePath']; ?>
android/hospital/doctor/org_id/<?php echo $this->_tpl_vars['org_id']; ?>
"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/hos_yyzj.png" width=60px;/><br/>医院专家</a></li>
		<li><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/hos_yydt.png" width=60px;/><br/>医院地图</li>
		<li><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/hos_ghzx.png" width=60px;/><br/>挂号咨询</li>
		<li><a href="<?php echo $this->_tpl_vars['basePath']; ?>
android/hospital/department"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/android/hos_ksjx.png" width=60px;/><br/>科室介绍</a></li>
		<div class='clear'></div>
	</ul>
	
</div>
<<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>

</html>