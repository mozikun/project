<?php /* Smarty version 2.6.14, created on 2013-08-26 14:05:46
         compiled from base.html */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs_search.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/mobileindex.css"/>
	<title><?php echo $this->_tpl_vars['individual_core']->name;  echo $this->_tpl_vars['title']; ?>
</title>
	<style type="text/css">
       body{margin:0 auto;padding:0 auto;text-align:left;background:url(<?php echo $this->_tpl_vars['basePath']; ?>
views/images/div_bg.jpg) repeat-x;height:100%; }
       div,img,table,tr{margin:0 auto;padding:0 auto;text-align:left;}
       .title_bg{background:url(<?php echo $this->_tpl_vars['basePath']; ?>
views/images/bg_search_ext.jpg) repeat-x;height:25px;line-height:25px;text-align:left;padding-left:2em;color:white;font-weight:bold;}
       .div_content{background:url(<?php echo $this->_tpl_vars['basePath']; ?>
views/images/div_bg.jpg) repeat-x center top;height:auto;}
    </style>
</head>
<body>
   <!--个人基本信息-->
   <div class="title_bg">
     <?php echo $this->_tpl_vars['title']; ?>

   </div>
   <div>
     <table border="0" cellpadding="0" cellspacing="0" width="100%">
       <tr>
         <td  width="30%" style="height:200px;"align="center"><img src="<?php echo $this->_tpl_vars['individual_core']->main_img_src; ?>
" alt="个人照片" style="border:1px solid black" width="100px" height="128px" /></td>
         <td><font><?php echo $this->_tpl_vars['individual_core']->name; ?>
</font></td>
          </tr>
       
       <tr>
         <td>性别：</td>
         <td><?php echo $this->_tpl_vars['individual_core']->sex; ?>
 </td>
       </tr>
       <tr>
         <td>民族：</td>
         <td><?php echo $this->_tpl_vars['individual_core']->race; ?>
 </td>
       </tr>
       <tr>
         <td>年龄：</td>
         <td><?php echo $this->_tpl_vars['individual_core']->age; ?>
 </td>
       </tr>
       <tr>
         <td>出生日期：</td>
         <td><?php echo $this->_tpl_vars['individual_core']->date_of_birth; ?>
 </td>
       </tr>
       <tr>
         <td>电话：</td>
         <td><?php echo $this->_tpl_vars['individual_core']->phone_number; ?>
 </td>
       </tr>
        <tr>
         <td>住址：</td>
         <td><?php echo $this->_tpl_vars['individual_core']->address; ?>
 </td>
       </tr>
     </table>
   </div>
   <div class="ui-footer">
     <a id="login" href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/login/index">返回</a>
  </div>
</body>
</html>