<?php /* Smarty version 2.6.14, created on 2013-05-02 09:55:31
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/android.css"/>
</head>
<body>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   <div>
      <ul>
      <?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['r']):
?>
		<a  href="<?php echo $this->_tpl_vars['basePath']; ?>
android/hospital/hospital/org_id/<?php echo $this->_tpl_vars['r']['id']; ?>
/org_name/<?php echo $this->_tpl_vars['r']['zh_name']; ?>
"><li class="lie" ><?php echo $this->_tpl_vars['r']['zh_name']; ?>
</li></a>
	  <?php endforeach; endif; unset($_from); ?>	
    </ul>
   </div>
   
</body>
</html>