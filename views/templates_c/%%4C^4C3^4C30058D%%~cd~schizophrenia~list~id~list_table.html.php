<?php /* Smarty version 2.6.14, created on 2013-08-28 11:35:19
         compiled from list_table.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'list_table.html', 234, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/health.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/experience_table.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<title>重性精神疾病患者随访服务记录表</title>
<style>
.STYLE1 {font-weight: bold}
.STYLE2 {font-weight: bold}

</style>

</head>
<body >

<form  action="<?php echo $this->_tpl_vars['basePath']; ?>
cd/schizophrenia/update" method="post">
   
   <div class="STYLE1" style="background:#FFFFFF; text-align:center; width:100%;font-size: 16px;
	font-weight: bold;">【<?php echo $this->_tpl_vars['user_name']; ?>
】重性精神疾病患者随访服务记录表(共<?php echo $this->_tpl_vars['nums']; ?>
次)<img title="“本表为重性精神疾病患者在接受随访服务时由医生填写。每年的综合评估填写居民健康档案的健康体检表。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></div>
   <div  style=" text-align:center; width:100%; "><input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
      <div  style=" width:30%; text-align:left; float:left;background:#FFFFFF;"><strong>姓名</strong>：<?php echo $this->_tpl_vars['user_name']; ?>
</div>
      <div  style=" width:40%; text-align:left; float:left;background:#FFFFFF;"><strong>身份证号</strong>：<?php echo $this->_tpl_vars['identity_number']; ?>
</div>
	  <div style=" width:30%; text-align:left; float:left;background:#FFFFFF;"><strong>编号</strong>：<?php echo $this->_tpl_vars['standard_code']; ?>
</div>
   </div>
<table width="100%"  align="center" cellpadding="" cellspacing="">
   	<tr>
		<td colspan="2">随访日期</td>
        <?php unset($this->_sections['fllowup_time']);
$this->_sections['fllowup_time']['name'] = 'fllowup_time';
$this->_sections['fllowup_time']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['fllowup_time']['show'] = true;
$this->_sections['fllowup_time']['max'] = $this->_sections['fllowup_time']['loop'];
$this->_sections['fllowup_time']['step'] = 1;
$this->_sections['fllowup_time']['start'] = $this->_sections['fllowup_time']['step'] > 0 ? 0 : $this->_sections['fllowup_time']['loop']-1;
if ($this->_sections['fllowup_time']['show']) {
    $this->_sections['fllowup_time']['total'] = $this->_sections['fllowup_time']['loop'];
    if ($this->_sections['fllowup_time']['total'] == 0)
        $this->_sections['fllowup_time']['show'] = false;
} else
    $this->_sections['fllowup_time']['total'] = 0;
if ($this->_sections['fllowup_time']['show']):

            for ($this->_sections['fllowup_time']['index'] = $this->_sections['fllowup_time']['start'], $this->_sections['fllowup_time']['iteration'] = 1;
                 $this->_sections['fllowup_time']['iteration'] <= $this->_sections['fllowup_time']['total'];
                 $this->_sections['fllowup_time']['index'] += $this->_sections['fllowup_time']['step'], $this->_sections['fllowup_time']['iteration']++):
$this->_sections['fllowup_time']['rownum'] = $this->_sections['fllowup_time']['iteration'];
$this->_sections['fllowup_time']['index_prev'] = $this->_sections['fllowup_time']['index'] - $this->_sections['fllowup_time']['step'];
$this->_sections['fllowup_time']['index_next'] = $this->_sections['fllowup_time']['index'] + $this->_sections['fllowup_time']['step'];
$this->_sections['fllowup_time']['first']      = ($this->_sections['fllowup_time']['iteration'] == 1);
$this->_sections['fllowup_time']['last']       = ($this->_sections['fllowup_time']['iteration'] == $this->_sections['fllowup_time']['total']);
?>	    
	    <td colspan="3">
		<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['fllowup_time']['index']]['fllowup_time']; ?>

		</td>
        <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td colspan="2">目前症状</td>
      	<?php unset($this->_sections['present_symptoms_current']);
$this->_sections['present_symptoms_current']['name'] = 'present_symptoms_current';
$this->_sections['present_symptoms_current']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['present_symptoms_current']['show'] = true;
$this->_sections['present_symptoms_current']['max'] = $this->_sections['present_symptoms_current']['loop'];
$this->_sections['present_symptoms_current']['step'] = 1;
$this->_sections['present_symptoms_current']['start'] = $this->_sections['present_symptoms_current']['step'] > 0 ? 0 : $this->_sections['present_symptoms_current']['loop']-1;
if ($this->_sections['present_symptoms_current']['show']) {
    $this->_sections['present_symptoms_current']['total'] = $this->_sections['present_symptoms_current']['loop'];
    if ($this->_sections['present_symptoms_current']['total'] == 0)
        $this->_sections['present_symptoms_current']['show'] = false;
} else
    $this->_sections['present_symptoms_current']['total'] = 0;
if ($this->_sections['present_symptoms_current']['show']):

            for ($this->_sections['present_symptoms_current']['index'] = $this->_sections['present_symptoms_current']['start'], $this->_sections['present_symptoms_current']['iteration'] = 1;
                 $this->_sections['present_symptoms_current']['iteration'] <= $this->_sections['present_symptoms_current']['total'];
                 $this->_sections['present_symptoms_current']['index'] += $this->_sections['present_symptoms_current']['step'], $this->_sections['present_symptoms_current']['iteration']++):
$this->_sections['present_symptoms_current']['rownum'] = $this->_sections['present_symptoms_current']['iteration'];
$this->_sections['present_symptoms_current']['index_prev'] = $this->_sections['present_symptoms_current']['index'] - $this->_sections['present_symptoms_current']['step'];
$this->_sections['present_symptoms_current']['index_next'] = $this->_sections['present_symptoms_current']['index'] + $this->_sections['present_symptoms_current']['step'];
$this->_sections['present_symptoms_current']['first']      = ($this->_sections['present_symptoms_current']['iteration'] == 1);
$this->_sections['present_symptoms_current']['last']       = ($this->_sections['present_symptoms_current']['iteration'] == $this->_sections['present_symptoms_current']['total']);
?>
            <td colspan="3">
             <?php $_from = $this->_tpl_vars['present_symptoms_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                   <?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text" name="present_symptoms_other" id="present_symptoms_other" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['present_symptoms_current']['index']]['present_symptoms_other']; ?>
" class="inputbottom" disabled="true"/>
            <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=12) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['customer']['show'] = true;
$this->_sections['customer']['max'] = $this->_sections['customer']['loop'];
$this->_sections['customer']['step'] = 1;
$this->_sections['customer']['start'] = $this->_sections['customer']['step'] > 0 ? 0 : $this->_sections['customer']['loop']-1;
if ($this->_sections['customer']['show']) {
    $this->_sections['customer']['total'] = $this->_sections['customer']['loop'];
    if ($this->_sections['customer']['total'] == 0)
        $this->_sections['customer']['show'] = false;
} else
    $this->_sections['customer']['total'] = 0;
if ($this->_sections['customer']['show']):

            for ($this->_sections['customer']['index'] = $this->_sections['customer']['start'], $this->_sections['customer']['iteration'] = 1;
                 $this->_sections['customer']['iteration'] <= $this->_sections['customer']['total'];
                 $this->_sections['customer']['index'] += $this->_sections['customer']['step'], $this->_sections['customer']['iteration']++):
$this->_sections['customer']['rownum'] = $this->_sections['customer']['iteration'];
$this->_sections['customer']['index_prev'] = $this->_sections['customer']['index'] - $this->_sections['customer']['step'];
$this->_sections['customer']['index_next'] = $this->_sections['customer']['index'] + $this->_sections['customer']['step'];
$this->_sections['customer']['first']      = ($this->_sections['customer']['iteration'] == 1);
$this->_sections['customer']['last']       = ($this->_sections['customer']['iteration'] == $this->_sections['customer']['total']);
?>
            <input type="text" id="present_symptoms" name="present_symptoms[]" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['present_symptoms_current']['index']]['present_symptoms_current'][$this->_sections['customer']['index']]; ?>
" class="inputnew" />
            <?php endfor; endif; ?>
            </td>
        <?php endfor; endif; ?>
   	</tr>
    <tr>
		<td colspan="2">自知力</td>
        <?php unset($this->_sections['insight_current']);
$this->_sections['insight_current']['name'] = 'insight_current';
$this->_sections['insight_current']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['insight_current']['show'] = true;
$this->_sections['insight_current']['max'] = $this->_sections['insight_current']['loop'];
$this->_sections['insight_current']['step'] = 1;
$this->_sections['insight_current']['start'] = $this->_sections['insight_current']['step'] > 0 ? 0 : $this->_sections['insight_current']['loop']-1;
if ($this->_sections['insight_current']['show']) {
    $this->_sections['insight_current']['total'] = $this->_sections['insight_current']['loop'];
    if ($this->_sections['insight_current']['total'] == 0)
        $this->_sections['insight_current']['show'] = false;
} else
    $this->_sections['insight_current']['total'] = 0;
if ($this->_sections['insight_current']['show']):

            for ($this->_sections['insight_current']['index'] = $this->_sections['insight_current']['start'], $this->_sections['insight_current']['iteration'] = 1;
                 $this->_sections['insight_current']['iteration'] <= $this->_sections['insight_current']['total'];
                 $this->_sections['insight_current']['index'] += $this->_sections['insight_current']['step'], $this->_sections['insight_current']['iteration']++):
$this->_sections['insight_current']['rownum'] = $this->_sections['insight_current']['iteration'];
$this->_sections['insight_current']['index_prev'] = $this->_sections['insight_current']['index'] - $this->_sections['insight_current']['step'];
$this->_sections['insight_current']['index_next'] = $this->_sections['insight_current']['index'] + $this->_sections['insight_current']['step'];
$this->_sections['insight_current']['first']      = ($this->_sections['insight_current']['iteration'] == 1);
$this->_sections['insight_current']['last']       = ($this->_sections['insight_current']['iteration'] == $this->_sections['insight_current']['total']);
?>			
	    	<td colspan="3">
            <?php $_from = $this->_tpl_vars['insight_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text" name="insight" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['insight_current']['index']]['insight_current']; ?>
" class="inputnew" />
            </td>
    	<?php endfor; endif; ?>
   	</tr>
    <tr>
		<td colspan="2">睡眠情况</td>
        <?php unset($this->_sections['sleep_quality_current']);
$this->_sections['sleep_quality_current']['name'] = 'sleep_quality_current';
$this->_sections['sleep_quality_current']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sleep_quality_current']['show'] = true;
$this->_sections['sleep_quality_current']['max'] = $this->_sections['sleep_quality_current']['loop'];
$this->_sections['sleep_quality_current']['step'] = 1;
$this->_sections['sleep_quality_current']['start'] = $this->_sections['sleep_quality_current']['step'] > 0 ? 0 : $this->_sections['sleep_quality_current']['loop']-1;
if ($this->_sections['sleep_quality_current']['show']) {
    $this->_sections['sleep_quality_current']['total'] = $this->_sections['sleep_quality_current']['loop'];
    if ($this->_sections['sleep_quality_current']['total'] == 0)
        $this->_sections['sleep_quality_current']['show'] = false;
} else
    $this->_sections['sleep_quality_current']['total'] = 0;
if ($this->_sections['sleep_quality_current']['show']):

            for ($this->_sections['sleep_quality_current']['index'] = $this->_sections['sleep_quality_current']['start'], $this->_sections['sleep_quality_current']['iteration'] = 1;
                 $this->_sections['sleep_quality_current']['iteration'] <= $this->_sections['sleep_quality_current']['total'];
                 $this->_sections['sleep_quality_current']['index'] += $this->_sections['sleep_quality_current']['step'], $this->_sections['sleep_quality_current']['iteration']++):
$this->_sections['sleep_quality_current']['rownum'] = $this->_sections['sleep_quality_current']['iteration'];
$this->_sections['sleep_quality_current']['index_prev'] = $this->_sections['sleep_quality_current']['index'] - $this->_sections['sleep_quality_current']['step'];
$this->_sections['sleep_quality_current']['index_next'] = $this->_sections['sleep_quality_current']['index'] + $this->_sections['sleep_quality_current']['step'];
$this->_sections['sleep_quality_current']['first']      = ($this->_sections['sleep_quality_current']['iteration'] == 1);
$this->_sections['sleep_quality_current']['last']       = ($this->_sections['sleep_quality_current']['iteration'] == $this->_sections['sleep_quality_current']['total']);
?>
	    	<td colspan="3">
        	<?php $_from = $this->_tpl_vars['sleep_quality_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text" name="sleep_quality" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['sleep_quality_current']['index']]['sleep_quality_current']; ?>
" class="inputnew" />
            </td>
         <?php endfor; endif; ?>
            
   	</tr>
    <tr>
		<td colspan="2">饮食情况</td>
        <?php unset($this->_sections['personlife_do_current']);
$this->_sections['personlife_do_current']['name'] = 'personlife_do_current';
$this->_sections['personlife_do_current']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['personlife_do_current']['show'] = true;
$this->_sections['personlife_do_current']['max'] = $this->_sections['personlife_do_current']['loop'];
$this->_sections['personlife_do_current']['step'] = 1;
$this->_sections['personlife_do_current']['start'] = $this->_sections['personlife_do_current']['step'] > 0 ? 0 : $this->_sections['personlife_do_current']['loop']-1;
if ($this->_sections['personlife_do_current']['show']) {
    $this->_sections['personlife_do_current']['total'] = $this->_sections['personlife_do_current']['loop'];
    if ($this->_sections['personlife_do_current']['total'] == 0)
        $this->_sections['personlife_do_current']['show'] = false;
} else
    $this->_sections['personlife_do_current']['total'] = 0;
if ($this->_sections['personlife_do_current']['show']):

            for ($this->_sections['personlife_do_current']['index'] = $this->_sections['personlife_do_current']['start'], $this->_sections['personlife_do_current']['iteration'] = 1;
                 $this->_sections['personlife_do_current']['iteration'] <= $this->_sections['personlife_do_current']['total'];
                 $this->_sections['personlife_do_current']['index'] += $this->_sections['personlife_do_current']['step'], $this->_sections['personlife_do_current']['iteration']++):
$this->_sections['personlife_do_current']['rownum'] = $this->_sections['personlife_do_current']['iteration'];
$this->_sections['personlife_do_current']['index_prev'] = $this->_sections['personlife_do_current']['index'] - $this->_sections['personlife_do_current']['step'];
$this->_sections['personlife_do_current']['index_next'] = $this->_sections['personlife_do_current']['index'] + $this->_sections['personlife_do_current']['step'];
$this->_sections['personlife_do_current']['first']      = ($this->_sections['personlife_do_current']['iteration'] == 1);
$this->_sections['personlife_do_current']['last']       = ($this->_sections['personlife_do_current']['iteration'] == $this->_sections['personlife_do_current']['total']);
?>
	    	<td colspan="3">
       		<?php $_from = $this->_tpl_vars['personlife_do_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text" name="personlife_do" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['personlife_do_current']['index']]['personlife_do_current']; ?>
" class="inputnew" />
            </td>
         <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td colspan="2" rowspan="5">社会功能情况</td>
      <?php unset($this->_sections['diet_current']);
$this->_sections['diet_current']['name'] = 'diet_current';
$this->_sections['diet_current']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diet_current']['show'] = true;
$this->_sections['diet_current']['max'] = $this->_sections['diet_current']['loop'];
$this->_sections['diet_current']['step'] = 1;
$this->_sections['diet_current']['start'] = $this->_sections['diet_current']['step'] > 0 ? 0 : $this->_sections['diet_current']['loop']-1;
if ($this->_sections['diet_current']['show']) {
    $this->_sections['diet_current']['total'] = $this->_sections['diet_current']['loop'];
    if ($this->_sections['diet_current']['total'] == 0)
        $this->_sections['diet_current']['show'] = false;
} else
    $this->_sections['diet_current']['total'] = 0;
if ($this->_sections['diet_current']['show']):

            for ($this->_sections['diet_current']['index'] = $this->_sections['diet_current']['start'], $this->_sections['diet_current']['iteration'] = 1;
                 $this->_sections['diet_current']['iteration'] <= $this->_sections['diet_current']['total'];
                 $this->_sections['diet_current']['index'] += $this->_sections['diet_current']['step'], $this->_sections['diet_current']['iteration']++):
$this->_sections['diet_current']['rownum'] = $this->_sections['diet_current']['iteration'];
$this->_sections['diet_current']['index_prev'] = $this->_sections['diet_current']['index'] - $this->_sections['diet_current']['step'];
$this->_sections['diet_current']['index_next'] = $this->_sections['diet_current']['index'] + $this->_sections['diet_current']['step'];
$this->_sections['diet_current']['first']      = ($this->_sections['diet_current']['iteration'] == 1);
$this->_sections['diet_current']['last']       = ($this->_sections['diet_current']['iteration'] == $this->_sections['diet_current']['total']);
?>   
      	   <td height="30"  >个人生活料理</td>                    
          <td  height="30" colspan="2">
          <?php $_from = $this->_tpl_vars['diet_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
                <?php endforeach; endif; unset($_from); ?>&nbsp;
          <input type="text" name="diet" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['diet_current']['index']]['diet_current']; ?>
" class="inputnew" />
          </td>
      <?php endfor; endif; ?>
   	</tr>
   	<tr>
     <?php unset($this->_sections['housework_current']);
$this->_sections['housework_current']['name'] = 'housework_current';
$this->_sections['housework_current']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['housework_current']['show'] = true;
$this->_sections['housework_current']['max'] = $this->_sections['housework_current']['loop'];
$this->_sections['housework_current']['step'] = 1;
$this->_sections['housework_current']['start'] = $this->_sections['housework_current']['step'] > 0 ? 0 : $this->_sections['housework_current']['loop']-1;
if ($this->_sections['housework_current']['show']) {
    $this->_sections['housework_current']['total'] = $this->_sections['housework_current']['loop'];
    if ($this->_sections['housework_current']['total'] == 0)
        $this->_sections['housework_current']['show'] = false;
} else
    $this->_sections['housework_current']['total'] = 0;
if ($this->_sections['housework_current']['show']):

            for ($this->_sections['housework_current']['index'] = $this->_sections['housework_current']['start'], $this->_sections['housework_current']['iteration'] = 1;
                 $this->_sections['housework_current']['iteration'] <= $this->_sections['housework_current']['total'];
                 $this->_sections['housework_current']['index'] += $this->_sections['housework_current']['step'], $this->_sections['housework_current']['iteration']++):
$this->_sections['housework_current']['rownum'] = $this->_sections['housework_current']['iteration'];
$this->_sections['housework_current']['index_prev'] = $this->_sections['housework_current']['index'] - $this->_sections['housework_current']['step'];
$this->_sections['housework_current']['index_next'] = $this->_sections['housework_current']['index'] + $this->_sections['housework_current']['step'];
$this->_sections['housework_current']['first']      = ($this->_sections['housework_current']['iteration'] == 1);
$this->_sections['housework_current']['last']       = ($this->_sections['housework_current']['iteration'] == $this->_sections['housework_current']['total']);
?>  
         <td height="30"  >
            家务劳动      
          </td>
         <td height="30" colspan="2">
         <?php $_from = $this->_tpl_vars['housework_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
              <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
         <?php endforeach; endif; unset($_from); ?>&nbsp;
         <input type="text" name="housework" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['housework_current']['index']]['housework_current']; ?>
" class="inputnew" />	  </td>
     <?php endfor; endif; ?>
   	</tr>
    <tr>
     <?php unset($this->_sections['work_current']);
$this->_sections['work_current']['name'] = 'work_current';
$this->_sections['work_current']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['work_current']['show'] = true;
$this->_sections['work_current']['max'] = $this->_sections['work_current']['loop'];
$this->_sections['work_current']['step'] = 1;
$this->_sections['work_current']['start'] = $this->_sections['work_current']['step'] > 0 ? 0 : $this->_sections['work_current']['loop']-1;
if ($this->_sections['work_current']['show']) {
    $this->_sections['work_current']['total'] = $this->_sections['work_current']['loop'];
    if ($this->_sections['work_current']['total'] == 0)
        $this->_sections['work_current']['show'] = false;
} else
    $this->_sections['work_current']['total'] = 0;
if ($this->_sections['work_current']['show']):

            for ($this->_sections['work_current']['index'] = $this->_sections['work_current']['start'], $this->_sections['work_current']['iteration'] = 1;
                 $this->_sections['work_current']['iteration'] <= $this->_sections['work_current']['total'];
                 $this->_sections['work_current']['index'] += $this->_sections['work_current']['step'], $this->_sections['work_current']['iteration']++):
$this->_sections['work_current']['rownum'] = $this->_sections['work_current']['iteration'];
$this->_sections['work_current']['index_prev'] = $this->_sections['work_current']['index'] - $this->_sections['work_current']['step'];
$this->_sections['work_current']['index_next'] = $this->_sections['work_current']['index'] + $this->_sections['work_current']['step'];
$this->_sections['work_current']['first']      = ($this->_sections['work_current']['iteration'] == 1);
$this->_sections['work_current']['last']       = ($this->_sections['work_current']['iteration'] == $this->_sections['work_current']['total']);
?>  
     <td height="30" >
   	    生产劳动及工作      </td>
   	 <td height="30" colspan="2" >
      		<?php $_from = $this->_tpl_vars['work_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text" name="work" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['work_current']['index']]['work_current']; ?>
" class="inputnew" />	  </td>
       <?php endfor; endif; ?>
   	</tr>
    <tr>
   	  <?php unset($this->_sections['learning_current']);
$this->_sections['learning_current']['name'] = 'learning_current';
$this->_sections['learning_current']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['learning_current']['show'] = true;
$this->_sections['learning_current']['max'] = $this->_sections['learning_current']['loop'];
$this->_sections['learning_current']['step'] = 1;
$this->_sections['learning_current']['start'] = $this->_sections['learning_current']['step'] > 0 ? 0 : $this->_sections['learning_current']['loop']-1;
if ($this->_sections['learning_current']['show']) {
    $this->_sections['learning_current']['total'] = $this->_sections['learning_current']['loop'];
    if ($this->_sections['learning_current']['total'] == 0)
        $this->_sections['learning_current']['show'] = false;
} else
    $this->_sections['learning_current']['total'] = 0;
if ($this->_sections['learning_current']['show']):

            for ($this->_sections['learning_current']['index'] = $this->_sections['learning_current']['start'], $this->_sections['learning_current']['iteration'] = 1;
                 $this->_sections['learning_current']['iteration'] <= $this->_sections['learning_current']['total'];
                 $this->_sections['learning_current']['index'] += $this->_sections['learning_current']['step'], $this->_sections['learning_current']['iteration']++):
$this->_sections['learning_current']['rownum'] = $this->_sections['learning_current']['iteration'];
$this->_sections['learning_current']['index_prev'] = $this->_sections['learning_current']['index'] - $this->_sections['learning_current']['step'];
$this->_sections['learning_current']['index_next'] = $this->_sections['learning_current']['index'] + $this->_sections['learning_current']['step'];
$this->_sections['learning_current']['first']      = ($this->_sections['learning_current']['iteration'] == 1);
$this->_sections['learning_current']['last']       = ($this->_sections['learning_current']['iteration'] == $this->_sections['learning_current']['total']);
?>  
      <td height="30"  >
   	     学习能力      </td>
   	  <td height="30" colspan="2" >
			<?php $_from = $this->_tpl_vars['learning_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text" name="learning" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['learning_current']['index']]['learning_current']; ?>
" class="inputnew" />	  </td>
       <?php endfor; endif; ?>
   	</tr>
    <tr>
      <?php unset($this->_sections['human_communication_current']);
$this->_sections['human_communication_current']['name'] = 'human_communication_current';
$this->_sections['human_communication_current']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['human_communication_current']['show'] = true;
$this->_sections['human_communication_current']['max'] = $this->_sections['human_communication_current']['loop'];
$this->_sections['human_communication_current']['step'] = 1;
$this->_sections['human_communication_current']['start'] = $this->_sections['human_communication_current']['step'] > 0 ? 0 : $this->_sections['human_communication_current']['loop']-1;
if ($this->_sections['human_communication_current']['show']) {
    $this->_sections['human_communication_current']['total'] = $this->_sections['human_communication_current']['loop'];
    if ($this->_sections['human_communication_current']['total'] == 0)
        $this->_sections['human_communication_current']['show'] = false;
} else
    $this->_sections['human_communication_current']['total'] = 0;
if ($this->_sections['human_communication_current']['show']):

            for ($this->_sections['human_communication_current']['index'] = $this->_sections['human_communication_current']['start'], $this->_sections['human_communication_current']['iteration'] = 1;
                 $this->_sections['human_communication_current']['iteration'] <= $this->_sections['human_communication_current']['total'];
                 $this->_sections['human_communication_current']['index'] += $this->_sections['human_communication_current']['step'], $this->_sections['human_communication_current']['iteration']++):
$this->_sections['human_communication_current']['rownum'] = $this->_sections['human_communication_current']['iteration'];
$this->_sections['human_communication_current']['index_prev'] = $this->_sections['human_communication_current']['index'] - $this->_sections['human_communication_current']['step'];
$this->_sections['human_communication_current']['index_next'] = $this->_sections['human_communication_current']['index'] + $this->_sections['human_communication_current']['step'];
$this->_sections['human_communication_current']['first']      = ($this->_sections['human_communication_current']['iteration'] == 1);
$this->_sections['human_communication_current']['last']       = ($this->_sections['human_communication_current']['iteration'] == $this->_sections['human_communication_current']['total']);
?>  
          <td height="30" >
            社会人及交往      </td>
          <td height="30" colspan="2" >
                <?php $_from = $this->_tpl_vars['human_communication_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
                <?php endforeach; endif; unset($_from); ?>&nbsp;
                <input type="text" name="human_communication" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['human_communication_current']['index']]['human_communication_current']; ?>
" class="inputnew" />	  </td>
      <?php endfor; endif; ?>
   	</tr>
    <tr>
		<td colspan="2">患者对家庭社会的影响</td>
        <?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>  
            <td colspan="3">       		
                1 轻度滋事<input type="text" name="mild_trouble" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['mild_trouble']; ?>
" class="inputbottom"/>次
                2 肇事<input type="text" name="accident" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['accident']; ?>
" class="inputbottom"/>次
                3 肇祸<input type="text" name="zhaohuo" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['zhaohuo']; ?>
" class="inputbottom"/>次<br/>
                4 自伤<input type="text" name="self_wounding" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['self_wounding']; ?>
" class="inputbottom"/>次
                5 自杀未遂<input type="text" name="attmpted_suicide" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['attmpted_suicide']; ?>
" class="inputbottom"/>次		</td>
        <?php endfor; endif; ?>   
   	</tr>
   	<tr>
   	  <td colspan="2">室验室检查</td>
      <?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>
          <td  colspan="3"  valign="top">
          <?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['lab_examination']; ?>

          </td>
      <?php endfor; endif; ?>   
   	</tr>
   	
   	<tr>
   	  <td colspan="2">服药依从性</td>
      <?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>
          <td colspan="3">
                <?php $_from = $this->_tpl_vars['compliance_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
                <?php endforeach; endif; unset($_from); ?>&nbsp;
                <input type="text"  name="compliance" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['compliance_current']; ?>
" class="inputnew" />	
          </td>
      <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td  colspan="2">药物不良反应</td>
      <?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>
         <td colspan="3">
    		<?php $_from = $this->_tpl_vars['adverse_drug_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text"  id="adverse_drug_info" name="adverse_drug_info" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['adverse_drug_info']; ?>
" class="inputbottom"/>
            
            <input type="text" id="adverse_drug" name="adverse_drug" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['adverse_drug_current']; ?>
"  class="inputnew" />	
         </td>
      <?php endfor; endif; ?>

    </tr>
   	<tr>
   	  <td  colspan="2">治疗效果</td>
      <?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>
      <td colspan="3">
    		<?php $_from = $this->_tpl_vars['treatment_effect_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;            
            <input type="text" name="treatment_effect" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['treatment_effect_current']; ?>
" class="inputnew" />	
      </td>
      <?php endfor; endif; ?>
    </tr>
   	<tr>
   	  <td colspan="2">此次随访分类</td>
      <?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>
        <td colspan="3">
    		<?php $_from = $this->_tpl_vars['followup_classification_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;            
            <input type="text" name="followup_classification" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['followup_classification_current']; ?>
" class="inputnew" />	
        </td>
      <?php endfor; endif; ?>
    </tr>
   	<tr>
   	  <td  colspan="2">是否转诊</td>
      <?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>
          <td colspan="3">
                 <?php $_from = $this->_tpl_vars['is_referral_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                    <label><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
                <?php endforeach; endif; unset($_from); ?>&nbsp;            
                <input type="text" id="is_referral" name="is_referral" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['is_referral_current']; ?>
" class="inputnew"   />	
                <br />
                原因：<input type="text" id="reason_referral" name="reason_referral" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['reason_referral']; ?>
" class="inputbottom"/><br/>
                机构及科室：<input type="text" id="hospital_referral" name="hospital_referral" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['hospital_referral']; ?>
" class="inputbottom"/>
          </td>  
      <?php endfor; endif; ?>	
    </tr>
   	<tr>
   	  <td rowspan="3" colspan="2">用药情况</td>
   	     <?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>
	      <td  >药物 1:      
	      <input name="drug_name1" type="text" class="inputnone2" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['drug_name1']; ?>
"/></td>
	      <td>用法:
	      <select name="drug_usage_frequency1">
	      	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['drug_usage_frequency1_options'],'selected' => $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['drug_usage_frequency1_current']), $this);?>

	      </select>
	      <input name="drug_usage1" type="text" class="inputnone" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['drug_usage1']; ?>
"/>次</td>
	   	  <td>每次剂量<input name="drug_dose1" type="text" class="inputnone" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['drug_dose1']; ?>
"/>mg</td>
	     <?php endfor; endif; ?>
	   	</tr>
	   	<tr>
	   	   <?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>
		   	  <td >药物 2:<input name="drug_name2" type="text" class="inputnone2" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['drug_name2']; ?>
"/></td>
		      <td>用法:
		      <select name="drug_usage_frequency2">
		      	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['drug_usage_frequency2_options'],'selected' => "$".($this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]).".drug_usage_frequency2_current"), $this);?>

		      </select>
		      <input name="drug_usage2" type="text" class="inputnone" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['drug_usage2']; ?>
"/>次</td>
		   	  <td>每次剂量            <input name="drug_dose2" type="text" class="inputnone" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['drug_dose2']; ?>
"/>mg</td	>
	   	  <?php endfor; endif; ?>
	    </tr>
	   	<tr>
	   	   <?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>
		   	  <td >药物 3:<input name="drug_name3" type="text" class="inputnone2"  value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['drug_name3']; ?>
"/></td>
		      <td>用法:
		      <select name="drug_usage_frequency3">
		      	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['drug_usage_frequency3_options'],'selected' => $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['drug_usage_frequency3_current']), $this);?>

		      </select>
		      <input name="drug_usage3" type="text" class="inputnone"  value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['drug_usage3']; ?>
"/>次</td>
		   	  <td>每次剂量            <input name="drug_dose3" type="text" class="inputnone" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['custom']['index']]['drug_dose3']; ?>
"/>mg</td>
	   	   <?php endfor; endif; ?>
   	 
      </tr>
   	 <tr>
   	  <td colspan="2">康复措施</td>
   	  <?php unset($this->_sections['rehabilitation_measure']);
$this->_sections['rehabilitation_measure']['name'] = 'rehabilitation_measure';
$this->_sections['rehabilitation_measure']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rehabilitation_measure']['show'] = true;
$this->_sections['rehabilitation_measure']['max'] = $this->_sections['rehabilitation_measure']['loop'];
$this->_sections['rehabilitation_measure']['step'] = 1;
$this->_sections['rehabilitation_measure']['start'] = $this->_sections['rehabilitation_measure']['step'] > 0 ? 0 : $this->_sections['rehabilitation_measure']['loop']-1;
if ($this->_sections['rehabilitation_measure']['show']) {
    $this->_sections['rehabilitation_measure']['total'] = $this->_sections['rehabilitation_measure']['loop'];
    if ($this->_sections['rehabilitation_measure']['total'] == 0)
        $this->_sections['rehabilitation_measure']['show'] = false;
} else
    $this->_sections['rehabilitation_measure']['total'] = 0;
if ($this->_sections['rehabilitation_measure']['show']):

            for ($this->_sections['rehabilitation_measure']['index'] = $this->_sections['rehabilitation_measure']['start'], $this->_sections['rehabilitation_measure']['iteration'] = 1;
                 $this->_sections['rehabilitation_measure']['iteration'] <= $this->_sections['rehabilitation_measure']['total'];
                 $this->_sections['rehabilitation_measure']['index'] += $this->_sections['rehabilitation_measure']['step'], $this->_sections['rehabilitation_measure']['iteration']++):
$this->_sections['rehabilitation_measure']['rownum'] = $this->_sections['rehabilitation_measure']['iteration'];
$this->_sections['rehabilitation_measure']['index_prev'] = $this->_sections['rehabilitation_measure']['index'] - $this->_sections['rehabilitation_measure']['step'];
$this->_sections['rehabilitation_measure']['index_next'] = $this->_sections['rehabilitation_measure']['index'] + $this->_sections['rehabilitation_measure']['step'];
$this->_sections['rehabilitation_measure']['first']      = ($this->_sections['rehabilitation_measure']['iteration'] == 1);
$this->_sections['rehabilitation_measure']['last']       = ($this->_sections['rehabilitation_measure']['iteration'] == $this->_sections['rehabilitation_measure']['total']);
?>
        <td colspan="3">
      		<?php $_from = $this->_tpl_vars['rehabilitation_measures_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;   
            <input type="text" name="rehabilitation_measure_other" id="rehabilitation_measure_other" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['rehabilitation_measure']['index']]['rehabilitation_measure_other']; ?>
" class="inputbottom"  disabled="true"/>
            <?php unset($this->_sections['custom']);
$this->_sections['custom']['name'] = 'custom';
$this->_sections['custom']['loop'] = is_array($_loop=3) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['show'] = true;
$this->_sections['custom']['max'] = $this->_sections['custom']['loop'];
$this->_sections['custom']['step'] = 1;
$this->_sections['custom']['start'] = $this->_sections['custom']['step'] > 0 ? 0 : $this->_sections['custom']['loop']-1;
if ($this->_sections['custom']['show']) {
    $this->_sections['custom']['total'] = $this->_sections['custom']['loop'];
    if ($this->_sections['custom']['total'] == 0)
        $this->_sections['custom']['show'] = false;
} else
    $this->_sections['custom']['total'] = 0;
if ($this->_sections['custom']['show']):

            for ($this->_sections['custom']['index'] = $this->_sections['custom']['start'], $this->_sections['custom']['iteration'] = 1;
                 $this->_sections['custom']['iteration'] <= $this->_sections['custom']['total'];
                 $this->_sections['custom']['index'] += $this->_sections['custom']['step'], $this->_sections['custom']['iteration']++):
$this->_sections['custom']['rownum'] = $this->_sections['custom']['iteration'];
$this->_sections['custom']['index_prev'] = $this->_sections['custom']['index'] - $this->_sections['custom']['step'];
$this->_sections['custom']['index_next'] = $this->_sections['custom']['index'] + $this->_sections['custom']['step'];
$this->_sections['custom']['first']      = ($this->_sections['custom']['iteration'] == 1);
$this->_sections['custom']['last']       = ($this->_sections['custom']['iteration'] == $this->_sections['custom']['total']);
?>
            <input type="text" id="rehabilitation_measures" name="rehabilitation_measures[]" value="<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['rehabilitation_measure']['index']]['rehabilitation_measures_current'][$this->_sections['custom']['index']]; ?>
" class="inputnew" />	
            <?php endfor; endif; ?>
        </td> 
      <?php endfor; endif; ?>
    </tr>
    <tr>
   	  <td  colspan="2">下次随访日期</td>
   	  <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['customer']['show'] = true;
$this->_sections['customer']['max'] = $this->_sections['customer']['loop'];
$this->_sections['customer']['step'] = 1;
$this->_sections['customer']['start'] = $this->_sections['customer']['step'] > 0 ? 0 : $this->_sections['customer']['loop']-1;
if ($this->_sections['customer']['show']) {
    $this->_sections['customer']['total'] = $this->_sections['customer']['loop'];
    if ($this->_sections['customer']['total'] == 0)
        $this->_sections['customer']['show'] = false;
} else
    $this->_sections['customer']['total'] = 0;
if ($this->_sections['customer']['show']):

            for ($this->_sections['customer']['index'] = $this->_sections['customer']['start'], $this->_sections['customer']['iteration'] = 1;
                 $this->_sections['customer']['iteration'] <= $this->_sections['customer']['total'];
                 $this->_sections['customer']['index'] += $this->_sections['customer']['step'], $this->_sections['customer']['iteration']++):
$this->_sections['customer']['rownum'] = $this->_sections['customer']['iteration'];
$this->_sections['customer']['index_prev'] = $this->_sections['customer']['index'] - $this->_sections['customer']['step'];
$this->_sections['customer']['index_next'] = $this->_sections['customer']['index'] + $this->_sections['customer']['step'];
$this->_sections['customer']['first']      = ($this->_sections['customer']['iteration'] == 1);
$this->_sections['customer']['last']       = ($this->_sections['customer']['iteration'] == $this->_sections['customer']['total']);
?>
	      <td  colspan="3" >
	         <?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['customer']['index']]['next_followup_time']; ?>

	      </td>
	    
      <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td  colspan="2">随访结果</td>
   	  <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['customer']['show'] = true;
$this->_sections['customer']['max'] = $this->_sections['customer']['loop'];
$this->_sections['customer']['step'] = 1;
$this->_sections['customer']['start'] = $this->_sections['customer']['step'] > 0 ? 0 : $this->_sections['customer']['loop']-1;
if ($this->_sections['customer']['show']) {
    $this->_sections['customer']['total'] = $this->_sections['customer']['loop'];
    if ($this->_sections['customer']['total'] == 0)
        $this->_sections['customer']['show'] = false;
} else
    $this->_sections['customer']['total'] = 0;
if ($this->_sections['customer']['show']):

            for ($this->_sections['customer']['index'] = $this->_sections['customer']['start'], $this->_sections['customer']['iteration'] = 1;
                 $this->_sections['customer']['iteration'] <= $this->_sections['customer']['total'];
                 $this->_sections['customer']['index'] += $this->_sections['customer']['step'], $this->_sections['customer']['iteration']++):
$this->_sections['customer']['rownum'] = $this->_sections['customer']['iteration'];
$this->_sections['customer']['index_prev'] = $this->_sections['customer']['index'] - $this->_sections['customer']['step'];
$this->_sections['customer']['index_next'] = $this->_sections['customer']['index'] + $this->_sections['customer']['step'];
$this->_sections['customer']['first']      = ($this->_sections['customer']['iteration'] == 1);
$this->_sections['customer']['last']       = ($this->_sections['customer']['iteration'] == $this->_sections['customer']['total']);
?>
	      
	      <td colspan="3">
	     	<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['customer']['index']]['followup_content']; ?>

	      </td>
      <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td  colspan="2">随访医生签名</td>
   	  <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['customer']['show'] = true;
$this->_sections['customer']['max'] = $this->_sections['customer']['loop'];
$this->_sections['customer']['step'] = 1;
$this->_sections['customer']['start'] = $this->_sections['customer']['step'] > 0 ? 0 : $this->_sections['customer']['loop']-1;
if ($this->_sections['customer']['show']) {
    $this->_sections['customer']['total'] = $this->_sections['customer']['loop'];
    if ($this->_sections['customer']['total'] == 0)
        $this->_sections['customer']['show'] = false;
} else
    $this->_sections['customer']['total'] = 0;
if ($this->_sections['customer']['show']):

            for ($this->_sections['customer']['index'] = $this->_sections['customer']['start'], $this->_sections['customer']['iteration'] = 1;
                 $this->_sections['customer']['iteration'] <= $this->_sections['customer']['total'];
                 $this->_sections['customer']['index'] += $this->_sections['customer']['step'], $this->_sections['customer']['iteration']++):
$this->_sections['customer']['rownum'] = $this->_sections['customer']['iteration'];
$this->_sections['customer']['index_prev'] = $this->_sections['customer']['index'] - $this->_sections['customer']['step'];
$this->_sections['customer']['index_next'] = $this->_sections['customer']['index'] + $this->_sections['customer']['step'];
$this->_sections['customer']['first']      = ($this->_sections['customer']['iteration'] == 1);
$this->_sections['customer']['last']       = ($this->_sections['customer']['iteration'] == $this->_sections['customer']['total']);
?>
	      
	      <td colspan="3">
	     	<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['customer']['index']]['followup_doctor']; ?>

	      </td>
      <?php endfor; endif; ?>
   	</tr>
    <tr id="no_print">
		<td colspan="2">&nbsp;</td>
   	  <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['customer']['show'] = true;
$this->_sections['customer']['max'] = $this->_sections['customer']['loop'];
$this->_sections['customer']['step'] = 1;
$this->_sections['customer']['start'] = $this->_sections['customer']['step'] > 0 ? 0 : $this->_sections['customer']['loop']-1;
if ($this->_sections['customer']['show']) {
    $this->_sections['customer']['total'] = $this->_sections['customer']['loop'];
    if ($this->_sections['customer']['total'] == 0)
        $this->_sections['customer']['show'] = false;
} else
    $this->_sections['customer']['total'] = 0;
if ($this->_sections['customer']['show']):

            for ($this->_sections['customer']['index'] = $this->_sections['customer']['start'], $this->_sections['customer']['iteration'] = 1;
                 $this->_sections['customer']['iteration'] <= $this->_sections['customer']['total'];
                 $this->_sections['customer']['index'] += $this->_sections['customer']['step'], $this->_sections['customer']['iteration']++):
$this->_sections['customer']['rownum'] = $this->_sections['customer']['iteration'];
$this->_sections['customer']['index_prev'] = $this->_sections['customer']['index'] - $this->_sections['customer']['step'];
$this->_sections['customer']['index_next'] = $this->_sections['customer']['index'] + $this->_sections['customer']['step'];
$this->_sections['customer']['first']      = ($this->_sections['customer']['iteration'] == 1);
$this->_sections['customer']['last']       = ($this->_sections['customer']['iteration'] == $this->_sections['customer']['total']);
?>
   	 	 <td colspan="3" align="center"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/schizophrenia/add/uuid/<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['customer']['index']]['uuid']; ?>
">修改</a>　<a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/schizophrenia/del/uuid/<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['customer']['index']]['uuid']; ?>
" onclick="if(confirm('确定要删除吗？')){return true;}else{return false;}">删除 </a>
         
         　<a  target="_blank" href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/schizophrenia/print/uuid/<?php echo $this->_tpl_vars['schizophrenia_array'][$this->_sections['customer']['index']]['uuid']; ?>
">打印</a>
         </td>
   	  <?php endfor; endif; ?>
   	</tr>
   </table>
   <div class="STYLE1" style="background:#FFFFFF; text-align:center; width:100%;font-size: 16px;">
   <input type="button" name="return" id="return" class="inputbutton" value="返回列表" onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
cd/schizophrenia/index';" />
</div>
</form> 
</body>
</html>
<script type="text/javascript">
 function  print_info(){
 	$("#no_print").hide();
 	window.print();
 	$("#no_print").show();
 }
</script>