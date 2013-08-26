<?php /* Smarty version 2.6.14, created on 2013-08-26 14:05:54
         compiled from edu.html */ ?>
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
  <div class="title_bg">
     健康教育信息
   </div>
   <div>
     <table border="0" cellpadding="0" cellspacing="0" width="100%">
        	<?php unset($this->_sections['he']);
$this->_sections['he']['name'] = 'he';
$this->_sections['he']['loop'] = is_array($_loop=$this->_tpl_vars['he']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['he']['show'] = true;
$this->_sections['he']['max'] = $this->_sections['he']['loop'];
$this->_sections['he']['step'] = 1;
$this->_sections['he']['start'] = $this->_sections['he']['step'] > 0 ? 0 : $this->_sections['he']['loop']-1;
if ($this->_sections['he']['show']) {
    $this->_sections['he']['total'] = $this->_sections['he']['loop'];
    if ($this->_sections['he']['total'] == 0)
        $this->_sections['he']['show'] = false;
} else
    $this->_sections['he']['total'] = 0;
if ($this->_sections['he']['show']):

            for ($this->_sections['he']['index'] = $this->_sections['he']['start'], $this->_sections['he']['iteration'] = 1;
                 $this->_sections['he']['iteration'] <= $this->_sections['he']['total'];
                 $this->_sections['he']['index'] += $this->_sections['he']['step'], $this->_sections['he']['iteration']++):
$this->_sections['he']['rownum'] = $this->_sections['he']['iteration'];
$this->_sections['he']['index_prev'] = $this->_sections['he']['index'] - $this->_sections['he']['step'];
$this->_sections['he']['index_next'] = $this->_sections['he']['index'] + $this->_sections['he']['step'];
$this->_sections['he']['first']      = ($this->_sections['he']['iteration'] == 1);
$this->_sections['he']['last']       = ($this->_sections['he']['iteration'] == $this->_sections['he']['total']);
?>
	     <tr>
		 	<td>
		 	  活动时间
	        </td>
			<td>
	        	<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['activity_time']; ?>

	        </td>
         </tr>
         <tr>
            <td>活动地点</td>
			<td>
	        	<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['activity_address']; ?>

	        </td>
       	 </tr>
       	 <tr>
       	    <td>组织者</td>
			<td>
	 			<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['sponsor']; ?>

	        </td>
        </tr>
        <tr>
			<td>
	        	负责人
	        </td>
			<td>
	        	<?php echo $this->_tpl_vars['he'][$this->_sections['he']['index']]['person_in_charge']; ?>

			</td>
		</tr>
		<tr>
		 <td colspan="2" style="height:50px;">&nbsp;</td>
		</tr>
	  <?php endfor; else: ?>
	   <tr>
	     <td colspan="2">没有记录</td>
	   </tr>
      <?php endif; ?>
     </table>
   </div>
   <div class="ui-footer">
     <a id="login" href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/login/index">返回</a>
  </div>
</body>
</html>