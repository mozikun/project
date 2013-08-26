<?php /* Smarty version 2.6.14, created on 2013-08-26 14:03:03
         compiled from et.html */ ?>
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
views/images/div_bg.jpg) repeat-x;height:100%;}
       div,img,table,tr{margin:0 auto;padding:0 auto;text-align:left;}
       .title_bg{background:url(<?php echo $this->_tpl_vars['basePath']; ?>
views/images/bg_search_ext.jpg) repeat-x;height:25px;line-height:25px;text-align:left;padding-left:2em;color:white;font-weight:bold;}
       .div_content{background:url(<?php echo $this->_tpl_vars['basePath']; ?>
views/images/div_bg.jpg) repeat-x center top;height:auto;}
    </style>
</head>
<body>
   <!--最后一次体检记录-->
   <div class="title_bg">
     <?php echo $this->_tpl_vars['title']; ?>

   </div>
   <div>
     <table border="0" cellpadding="0" cellspacing="0" width="100%">
       <tr>
         <td width="30%">体温</td>
         <td><?php echo $this->_tpl_vars['et_general_condition']->temperature; ?>
</td>    
       </tr>
       <tr>
         <td>脉搏</td>
         <td><?php echo $this->_tpl_vars['et_general_condition']->pulse; ?>
</td>
       </tr>
       <tr>
         <td width="30%">呼吸频率</td>
         <td><?php echo $this->_tpl_vars['et_general_condition']->breathing_rate; ?>
</td>     
       </tr>
       <tr>
         <td>腰围</td>
         <td><?php echo $this->_tpl_vars['et_general_condition']->waistline; ?>
</td>
       </tr>
       <tr>
         <td width="30%">血压左侧</td>
         <td><?php echo $this->_tpl_vars['et_general_condition']->blood_pressure_left_s; ?>
(mmHg) </td>
       </tr>
       <tr>
         <td>血压右侧</td>
         <td><?php echo $this->_tpl_vars['et_general_condition']->blood_pressure_left_p; ?>
(mmHg) </td>
       </tr>
       <tr>
         <td width="30%">身高</td>
         <td><?php echo $this->_tpl_vars['et_general_condition']->height; ?>
 </td> 
       </tr>
       <tr>
         <td>体重</td>
         <td><?php echo $this->_tpl_vars['et_general_condition']->weight; ?>
 </td>
       </tr>
       <tr>
         <td width="30%">空腹血糖</td>
         <td><?php echo $this->_tpl_vars['et_general_condition']->fbglucoseh; ?>
 </td> 
       </tr>
       <tr>
         <td>尿微量白蛋白</td>
         <td><?php echo $this->_tpl_vars['et_general_condition']->microurine; ?>
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