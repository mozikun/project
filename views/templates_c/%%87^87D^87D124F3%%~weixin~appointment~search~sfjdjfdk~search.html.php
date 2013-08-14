<?php /* Smarty version 2.6.14, created on 2013-07-18 14:48:41
         compiled from search.html */ ?>
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

</style>

<div data-role="page" id="page1">
   <div data-role="content">
        <table>
			<tr>
				<td>姓名:</td>
				<td><?php echo $this->_tpl_vars['result']['name']; ?>
</td>
			</tr>
			<tr>
				<td>预约医生:</td>
				<td><?php echo $this->_tpl_vars['result']['doctor']; ?>
</td>
			</tr>
			<tr>
				<td>预约时间:</td>
				<td><?php echo $this->_tpl_vars['result']['time']; ?>
</td>
			</tr>
		</table>
    </div>

</div>
</html>