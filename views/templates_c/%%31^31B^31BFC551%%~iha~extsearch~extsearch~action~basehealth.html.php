<?php /* Smarty version 2.6.14, created on 2013-08-26 14:04:41
         compiled from basehealth.html */ ?>
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
   <div >
      <!--基本健康信息-->
   <div class="title_bg">
     <?php echo $this->_tpl_vars['title']; ?>

   </div>
   <div>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" >
        <tr>
         <td>血型：</td>
         <td><?php echo $this->_tpl_vars['blood']->abo_bloodtype; ?>
</td>
       </tr>
       <tr>
         <td width="30%">药物过敏史:</td>
         <td><?php echo $this->_tpl_vars['individual_core']->allergy_code; ?>
</td>
       </tr>
       <tr>
         <td>暴露史:</td>
         <td><?php echo $this->_tpl_vars['individual_core']->exposure_code; ?>
</td>
       </tr>
       <?php unset($this->_sections['clinical_array']);
$this->_sections['clinical_array']['loop'] = is_array($_loop=$this->_tpl_vars['clinical_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['clinical_array']['name'] = 'clinical_array';
$this->_sections['clinical_array']['show'] = true;
$this->_sections['clinical_array']['max'] = $this->_sections['clinical_array']['loop'];
$this->_sections['clinical_array']['step'] = 1;
$this->_sections['clinical_array']['start'] = $this->_sections['clinical_array']['step'] > 0 ? 0 : $this->_sections['clinical_array']['loop']-1;
if ($this->_sections['clinical_array']['show']) {
    $this->_sections['clinical_array']['total'] = $this->_sections['clinical_array']['loop'];
    if ($this->_sections['clinical_array']['total'] == 0)
        $this->_sections['clinical_array']['show'] = false;
} else
    $this->_sections['clinical_array']['total'] = 0;
if ($this->_sections['clinical_array']['show']):

            for ($this->_sections['clinical_array']['index'] = $this->_sections['clinical_array']['start'], $this->_sections['clinical_array']['iteration'] = 1;
                 $this->_sections['clinical_array']['iteration'] <= $this->_sections['clinical_array']['total'];
                 $this->_sections['clinical_array']['index'] += $this->_sections['clinical_array']['step'], $this->_sections['clinical_array']['iteration']++):
$this->_sections['clinical_array']['rownum'] = $this->_sections['clinical_array']['iteration'];
$this->_sections['clinical_array']['index_prev'] = $this->_sections['clinical_array']['index'] - $this->_sections['clinical_array']['step'];
$this->_sections['clinical_array']['index_next'] = $this->_sections['clinical_array']['index'] + $this->_sections['clinical_array']['step'];
$this->_sections['clinical_array']['first']      = ($this->_sections['clinical_array']['iteration'] == 1);
$this->_sections['clinical_array']['last']       = ($this->_sections['clinical_array']['iteration'] == $this->_sections['clinical_array']['total']);
?>
       <tr>
         <td>确诊疾病:</td>
         <td><?php echo $this->_tpl_vars['clinical_array'][$this->_sections['clinical_array']['index']]['mycode']; ?>
</td>
       </tr>
      <?php endfor; else: ?>
      <tr>
        <td>确诊疾病</td>
        <td>暂无记录</td>
      </tr>
       <?php endif; ?>
       <?php unset($this->_sections['surgical_array']);
$this->_sections['surgical_array']['loop'] = is_array($_loop=$this->_tpl_vars['surgical_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['surgical_array']['name'] = 'surgical_array';
$this->_sections['surgical_array']['show'] = true;
$this->_sections['surgical_array']['max'] = $this->_sections['surgical_array']['loop'];
$this->_sections['surgical_array']['step'] = 1;
$this->_sections['surgical_array']['start'] = $this->_sections['surgical_array']['step'] > 0 ? 0 : $this->_sections['surgical_array']['loop']-1;
if ($this->_sections['surgical_array']['show']) {
    $this->_sections['surgical_array']['total'] = $this->_sections['surgical_array']['loop'];
    if ($this->_sections['surgical_array']['total'] == 0)
        $this->_sections['surgical_array']['show'] = false;
} else
    $this->_sections['surgical_array']['total'] = 0;
if ($this->_sections['surgical_array']['show']):

            for ($this->_sections['surgical_array']['index'] = $this->_sections['surgical_array']['start'], $this->_sections['surgical_array']['iteration'] = 1;
                 $this->_sections['surgical_array']['iteration'] <= $this->_sections['surgical_array']['total'];
                 $this->_sections['surgical_array']['index'] += $this->_sections['surgical_array']['step'], $this->_sections['surgical_array']['iteration']++):
$this->_sections['surgical_array']['rownum'] = $this->_sections['surgical_array']['iteration'];
$this->_sections['surgical_array']['index_prev'] = $this->_sections['surgical_array']['index'] - $this->_sections['surgical_array']['step'];
$this->_sections['surgical_array']['index_next'] = $this->_sections['surgical_array']['index'] + $this->_sections['surgical_array']['step'];
$this->_sections['surgical_array']['first']      = ($this->_sections['surgical_array']['iteration'] == 1);
$this->_sections['surgical_array']['last']       = ($this->_sections['surgical_array']['iteration'] == $this->_sections['surgical_array']['total']);
?>
       <tr>
         <td>手术记录</td>
         <td><?php echo $this->_tpl_vars['surgical_array'][$this->_sections['surgical_array']['index']]['code']; ?>
</td>
       </tr>
        <?php endfor; else: ?>
      <tr>
        <td>手术记录</td>
        <td>暂无记录</td>
      </tr>
       <?php endif; ?>
        <tr>
         <td>遗传病史</td>
         <td><?php echo $this->_tpl_vars['genetic_diseases']->disease_name; ?>
</td>
       </tr>
       <tr>
         <td>残疾状况</td>
         <td><?php echo $this->_tpl_vars['individual_core']->deformity_str; ?>
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