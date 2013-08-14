<?php /* Smarty version 2.6.14, created on 2013-04-27 17:40:54
         compiled from admin_index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tree.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<style>
body
{
_width:1px;
word-break:keep-all; /* for ie */
white-space:nowrap; /* for chrome */
}
li{
    list-style: none;
}
</style>
<script>
function show_pic()
{
    $.get('<?php echo $this->_tpl_vars['basePath']; ?>
decision/main/tree',function(data)
    {
        $(".tree:eq(1)").append(data);
    });
}
</script>
</head>
<body>
<div style="text-align:left;"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/admin_main.jpg" /></div>
<div style="padding-left:30px;margin-top: 25px;">
	<ul>
    	<li>系统目前共计29个功能模块，其中系统管理常涉及大模块"系统管理"，子模块如下：</li>
        
        <li>
        <div class="tree">
        	<?php echo $this->_tpl_vars['tree2']; ?>

        </div>
</li>
    </ul>
</div>
<div class="tree">
	<?php echo $this->_tpl_vars['tree']; ?>

</div>
</body>
</html>