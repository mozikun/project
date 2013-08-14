<?php /* Smarty version 2.6.14, created on 2013-08-14 10:53:36
         compiled from doctorhome.html */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/android.css"/>
	
	<style type="text/css">
       body{margin:0 auto;padding:0 auto;text-align:left;background:url(<?php echo $this->_tpl_vars['basePath']; ?>
views/images/div_bg.jpg) repeat-x;height:100%; }
       div,img,table,tr{margin:0 auto;padding:0 auto;text-align:left;}
       .title_bg{background:url(<?php echo $this->_tpl_vars['basePath']; ?>
views/images/bg_search_ext.jpg) repeat-x;height:25px;line-height:25px;text-align:left;padding-left:2em;color:white;font-weight:bold;}
       .div_content{background:url(<?php echo $this->_tpl_vars['basePath']; ?>
views/images/div_bg.jpg) repeat-x center top;height:auto;}
	   .lie{
	    border:1px solid gray;
		
		line-height:30px;
	   }
	   
    </style>
</head>
<body>
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   <div  style="background:lightblue;margin:10px;border-radius: 10px;">
     <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['r']):
?>
	  <tr class="lie">
		<td >[<?php echo $this->_tpl_vars['r']['name']; ?>
]<a  style="color:red;font-size:15px;" href="<?php echo $this->_tpl_vars['basePath']; ?>
android/chat/chat/receiver_id/<?php echo $this->_tpl_vars['r']['identity_number']; ?>
"><?php echo $this->_tpl_vars['r']['cotent']; ?>
</a></td>
	  </tr>
	  <?php endforeach; endif; unset($_from); ?>	
     </table>
   </div>
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>