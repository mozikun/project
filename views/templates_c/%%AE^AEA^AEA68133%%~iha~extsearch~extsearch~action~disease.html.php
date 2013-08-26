<?php /* Smarty version 2.6.14, created on 2013-08-26 14:04:56
         compiled from disease.html */ ?>
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
     最近一次慢病随访
   </div>
   <div>
     <table border="0" cellpadding="0" cellspacing="0" width="100%">
       <?php unset($this->_sections['disease_array']);
$this->_sections['disease_array']['loop'] = is_array($_loop=$this->_tpl_vars['disease_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['disease_array']['name'] = 'disease_array';
$this->_sections['disease_array']['show'] = true;
$this->_sections['disease_array']['max'] = $this->_sections['disease_array']['loop'];
$this->_sections['disease_array']['step'] = 1;
$this->_sections['disease_array']['start'] = $this->_sections['disease_array']['step'] > 0 ? 0 : $this->_sections['disease_array']['loop']-1;
if ($this->_sections['disease_array']['show']) {
    $this->_sections['disease_array']['total'] = $this->_sections['disease_array']['loop'];
    if ($this->_sections['disease_array']['total'] == 0)
        $this->_sections['disease_array']['show'] = false;
} else
    $this->_sections['disease_array']['total'] = 0;
if ($this->_sections['disease_array']['show']):

            for ($this->_sections['disease_array']['index'] = $this->_sections['disease_array']['start'], $this->_sections['disease_array']['iteration'] = 1;
                 $this->_sections['disease_array']['iteration'] <= $this->_sections['disease_array']['total'];
                 $this->_sections['disease_array']['index'] += $this->_sections['disease_array']['step'], $this->_sections['disease_array']['iteration']++):
$this->_sections['disease_array']['rownum'] = $this->_sections['disease_array']['iteration'];
$this->_sections['disease_array']['index_prev'] = $this->_sections['disease_array']['index'] - $this->_sections['disease_array']['step'];
$this->_sections['disease_array']['index_next'] = $this->_sections['disease_array']['index'] + $this->_sections['disease_array']['step'];
$this->_sections['disease_array']['first']      = ($this->_sections['disease_array']['iteration'] == 1);
$this->_sections['disease_array']['last']       = ($this->_sections['disease_array']['iteration'] == $this->_sections['disease_array']['total']);
?>
        <tr>
          <td  colspan="2">慢病名称：<?php echo $this->_tpl_vars['disease_array'][$this->_sections['disease_array']['index']]['disease_name']; ?>
</td>
        </tr>
       <tr>
         <td width="30%">随访时间：</td>
         <td><?php echo $this->_tpl_vars['disease_array'][$this->_sections['disease_array']['index']]['fllowup_time']; ?>
</td> 
       </tr>
       <tr>
         <td >随访结果：</td>
         <td><?php echo $this->_tpl_vars['disease_array'][$this->_sections['disease_array']['index']]['followup_content']; ?>
</td> 
       </tr>
       <?php endfor; endif; ?>
     </table>
   </div>
   <div class="ui-footer">
     <a id="login" href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/login/index">返回</a>
  </div>
</body>
</html>