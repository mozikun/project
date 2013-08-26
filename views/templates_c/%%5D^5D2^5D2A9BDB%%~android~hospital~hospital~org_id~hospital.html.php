<?php /* Smarty version 2.6.14, created on 2013-08-26 15:26:47
         compiled from hospital.html */ ?>
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
.hospital ul li{
	list-style:none;
	float:left;
	margin:20px;
}

</style>
<div data-role="page" id="page1">
 <div data-theme="a" data-role="header">
        <h3>
            <?php echo $this->_tpl_vars['title']; ?>

        </h3>
    </div>
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
</div>


</html>