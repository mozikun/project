<?php /* Smarty version 2.6.14, created on 2013-06-24 15:14:44
         compiled from cd_table.html */ ?>
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
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/popup.js" type="text/javascript"></script>

<title>高血压患者随访服务记录表</title>
<style type="text/css">
	td
	{
		height:28px;
		padding:2px 2px 2px 4px;
	}
	body
	{
		
	}

<!--
*{margin:0; padding:0}
.STYLE2 {font-size: 18px}
label
{
	cursor:hand;
	cursor: pointer;
}
.other_sym{ width:40px;}
.other_txtsym{ width:120px; overflow:hidden;}
.other_sym,other_txtsym{ float:left;}
.inputs{background:none repeat scroll 0 0 #FFFFFF;
border-style:none;
width:40px;}
-->
</style>
</head>
<body >
   <div class="STYLE1" style="background:#FFFFFF; text-align:center; width:100%;font-size: 16px;
	font-weight: bold;">【<?php echo $this->_tpl_vars['user_name']; ?>
】高血压随访服务记录一览表(共<?php echo $this->_tpl_vars['nums']; ?>
次)<img title="“本表为高血压患者在接受随访服务时由医生填写。每年的综合评估填写居民健康档案的健康体检表。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></div>
   <div  style=" text-align:center; width:100%; "><input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
      <div  style=" width:30%; text-align:left; float:left;background:#FFFFFF;"><span class="STYLE2" style="padding-left:4px;">姓名</span>：<?php echo $this->_tpl_vars['user_name']; ?>
</div>
      <div  style=" width:40%; text-align:left; float:left;background:#FFFFFF;"><span class="STYLE2">身份证号</span>：<?php echo $this->_tpl_vars['identity_number']; ?>
</div>
	  <div  style=" width:30%; text-align:left; float:left;background:#FFFFFF;"><span class="STYLE2">编号</span>：<?php echo $this->_tpl_vars['standard_code']; ?>
</div>
   </div>
<table width="100%"  align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
   	<tr>
		<td colspan="2">随访日期</td>
		<?php unset($this->_sections['follow_time_year']);
$this->_sections['follow_time_year']['name'] = 'follow_time_year';
$this->_sections['follow_time_year']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['follow_time_year']['show'] = true;
$this->_sections['follow_time_year']['max'] = $this->_sections['follow_time_year']['loop'];
$this->_sections['follow_time_year']['step'] = 1;
$this->_sections['follow_time_year']['start'] = $this->_sections['follow_time_year']['step'] > 0 ? 0 : $this->_sections['follow_time_year']['loop']-1;
if ($this->_sections['follow_time_year']['show']) {
    $this->_sections['follow_time_year']['total'] = $this->_sections['follow_time_year']['loop'];
    if ($this->_sections['follow_time_year']['total'] == 0)
        $this->_sections['follow_time_year']['show'] = false;
} else
    $this->_sections['follow_time_year']['total'] = 0;
if ($this->_sections['follow_time_year']['show']):

            for ($this->_sections['follow_time_year']['index'] = $this->_sections['follow_time_year']['start'], $this->_sections['follow_time_year']['iteration'] = 1;
                 $this->_sections['follow_time_year']['iteration'] <= $this->_sections['follow_time_year']['total'];
                 $this->_sections['follow_time_year']['index'] += $this->_sections['follow_time_year']['step'], $this->_sections['follow_time_year']['iteration']++):
$this->_sections['follow_time_year']['rownum'] = $this->_sections['follow_time_year']['iteration'];
$this->_sections['follow_time_year']['index_prev'] = $this->_sections['follow_time_year']['index'] - $this->_sections['follow_time_year']['step'];
$this->_sections['follow_time_year']['index_next'] = $this->_sections['follow_time_year']['index'] + $this->_sections['follow_time_year']['step'];
$this->_sections['follow_time_year']['first']      = ($this->_sections['follow_time_year']['iteration'] == 1);
$this->_sections['follow_time_year']['last']       = ($this->_sections['follow_time_year']['iteration'] == $this->_sections['follow_time_year']['total']);
?>
	    <td colspan="2">
		<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['follow_time_year']['index']]['follow_time']; ?>

		</td>
	    <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td colspan="2">随访方式</td>
	  <?php unset($this->_sections['follow_type']);
$this->_sections['follow_type']['name'] = 'follow_type';
$this->_sections['follow_type']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['follow_type']['show'] = true;
$this->_sections['follow_type']['max'] = $this->_sections['follow_type']['loop'];
$this->_sections['follow_type']['step'] = 1;
$this->_sections['follow_type']['start'] = $this->_sections['follow_type']['step'] > 0 ? 0 : $this->_sections['follow_type']['loop']-1;
if ($this->_sections['follow_type']['show']) {
    $this->_sections['follow_type']['total'] = $this->_sections['follow_type']['loop'];
    if ($this->_sections['follow_type']['total'] == 0)
        $this->_sections['follow_type']['show'] = false;
} else
    $this->_sections['follow_type']['total'] = 0;
if ($this->_sections['follow_type']['show']):

            for ($this->_sections['follow_type']['index'] = $this->_sections['follow_type']['start'], $this->_sections['follow_type']['iteration'] = 1;
                 $this->_sections['follow_type']['iteration'] <= $this->_sections['follow_type']['total'];
                 $this->_sections['follow_type']['index'] += $this->_sections['follow_type']['step'], $this->_sections['follow_type']['iteration']++):
$this->_sections['follow_type']['rownum'] = $this->_sections['follow_type']['iteration'];
$this->_sections['follow_type']['index_prev'] = $this->_sections['follow_type']['index'] - $this->_sections['follow_type']['step'];
$this->_sections['follow_type']['index_next'] = $this->_sections['follow_type']['index'] + $this->_sections['follow_type']['step'];
$this->_sections['follow_type']['first']      = ($this->_sections['follow_type']['iteration'] == 1);
$this->_sections['follow_type']['last']       = ($this->_sections['follow_type']['iteration'] == $this->_sections['follow_type']['total']);
?>
      <td colspan="2">	
	 <?php $_from = $this->_tpl_vars['follow_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
	<?php endforeach; endif; unset($_from); ?>&nbsp;
	  <input type="text" name="follow_type[0][0]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['follow_type']['index']]['follow_type']; ?>
" class="inputnew" /></td>
     <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td rowspan="2"><p>症</p>
      <p>状</p></td>
      <td width="90" rowspan="2">
	  	<?php $_from = $this->_tpl_vars['symptom_code']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
<br />
		<?php endforeach; endif; unset($_from); ?>	  </td>
		<?php unset($this->_sections['symptom_code']);
$this->_sections['symptom_code']['name'] = 'symptom_code';
$this->_sections['symptom_code']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['symptom_code']['show'] = true;
$this->_sections['symptom_code']['max'] = $this->_sections['symptom_code']['loop'];
$this->_sections['symptom_code']['step'] = 1;
$this->_sections['symptom_code']['start'] = $this->_sections['symptom_code']['step'] > 0 ? 0 : $this->_sections['symptom_code']['loop']-1;
if ($this->_sections['symptom_code']['show']) {
    $this->_sections['symptom_code']['total'] = $this->_sections['symptom_code']['loop'];
    if ($this->_sections['symptom_code']['total'] == 0)
        $this->_sections['symptom_code']['show'] = false;
} else
    $this->_sections['symptom_code']['total'] = 0;
if ($this->_sections['symptom_code']['show']):

            for ($this->_sections['symptom_code']['index'] = $this->_sections['symptom_code']['start'], $this->_sections['symptom_code']['iteration'] = 1;
                 $this->_sections['symptom_code']['iteration'] <= $this->_sections['symptom_code']['total'];
                 $this->_sections['symptom_code']['index'] += $this->_sections['symptom_code']['step'], $this->_sections['symptom_code']['iteration']++):
$this->_sections['symptom_code']['rownum'] = $this->_sections['symptom_code']['iteration'];
$this->_sections['symptom_code']['index_prev'] = $this->_sections['symptom_code']['index'] - $this->_sections['symptom_code']['step'];
$this->_sections['symptom_code']['index_next'] = $this->_sections['symptom_code']['index'] + $this->_sections['symptom_code']['step'];
$this->_sections['symptom_code']['first']      = ($this->_sections['symptom_code']['iteration'] == 1);
$this->_sections['symptom_code']['last']       = ($this->_sections['symptom_code']['iteration'] == $this->_sections['symptom_code']['total']);
?>
      <td height="30" colspan="2" align="center">
	  	<?php unset($this->_sections['inp']);
$this->_sections['inp']['name'] = 'inp';
$this->_sections['inp']['loop'] = is_array($_loop=8) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['inp']['show'] = true;
$this->_sections['inp']['max'] = $this->_sections['inp']['loop'];
$this->_sections['inp']['step'] = 1;
$this->_sections['inp']['start'] = $this->_sections['inp']['step'] > 0 ? 0 : $this->_sections['inp']['loop']-1;
if ($this->_sections['inp']['show']) {
    $this->_sections['inp']['total'] = $this->_sections['inp']['loop'];
    if ($this->_sections['inp']['total'] == 0)
        $this->_sections['inp']['show'] = false;
} else
    $this->_sections['inp']['total'] = 0;
if ($this->_sections['inp']['show']):

            for ($this->_sections['inp']['index'] = $this->_sections['inp']['start'], $this->_sections['inp']['iteration'] = 1;
                 $this->_sections['inp']['iteration'] <= $this->_sections['inp']['total'];
                 $this->_sections['inp']['index'] += $this->_sections['inp']['step'], $this->_sections['inp']['iteration']++):
$this->_sections['inp']['rownum'] = $this->_sections['inp']['iteration'];
$this->_sections['inp']['index_prev'] = $this->_sections['inp']['index'] - $this->_sections['inp']['step'];
$this->_sections['inp']['index_next'] = $this->_sections['inp']['index'] + $this->_sections['inp']['step'];
$this->_sections['inp']['first']      = ($this->_sections['inp']['iteration'] == 1);
$this->_sections['inp']['last']       = ($this->_sections['inp']['iteration'] == $this->_sections['inp']['total']);
?>
			<input type="text" class="inputnew" name="symptom_code[<?php echo $this->_sections['symptom_code']['rownum']-1; ?>
][]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['symptom_code']['index']]['symptom_code'][$this->_sections['inp']['index']]['symptom_code']; ?>
" />/
		<?php endfor; endif; ?>	  </td>
		<?php endfor; endif; ?>
   	</tr>
   	<tr>
   		<?php unset($this->_sections['symptom_other']);
$this->_sections['symptom_other']['name'] = 'symptom_other';
$this->_sections['symptom_other']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['symptom_other']['show'] = true;
$this->_sections['symptom_other']['max'] = $this->_sections['symptom_other']['loop'];
$this->_sections['symptom_other']['step'] = 1;
$this->_sections['symptom_other']['start'] = $this->_sections['symptom_other']['step'] > 0 ? 0 : $this->_sections['symptom_other']['loop']-1;
if ($this->_sections['symptom_other']['show']) {
    $this->_sections['symptom_other']['total'] = $this->_sections['symptom_other']['loop'];
    if ($this->_sections['symptom_other']['total'] == 0)
        $this->_sections['symptom_other']['show'] = false;
} else
    $this->_sections['symptom_other']['total'] = 0;
if ($this->_sections['symptom_other']['show']):

            for ($this->_sections['symptom_other']['index'] = $this->_sections['symptom_other']['start'], $this->_sections['symptom_other']['iteration'] = 1;
                 $this->_sections['symptom_other']['iteration'] <= $this->_sections['symptom_other']['total'];
                 $this->_sections['symptom_other']['index'] += $this->_sections['symptom_other']['step'], $this->_sections['symptom_other']['iteration']++):
$this->_sections['symptom_other']['rownum'] = $this->_sections['symptom_other']['iteration'];
$this->_sections['symptom_other']['index_prev'] = $this->_sections['symptom_other']['index'] - $this->_sections['symptom_other']['step'];
$this->_sections['symptom_other']['index_next'] = $this->_sections['symptom_other']['index'] + $this->_sections['symptom_other']['step'];
$this->_sections['symptom_other']['first']      = ($this->_sections['symptom_other']['iteration'] == 1);
$this->_sections['symptom_other']['last']       = ($this->_sections['symptom_other']['iteration'] == $this->_sections['symptom_other']['total']);
?>
   	  <td colspan="2" valign="top">
	  	<div>
			<div class="other_sym">其他：</div>
			<div class="other_txtsym">
				<textarea class="newtextarea" name="symptom_other[<?php echo $this->_sections['symptom_other']['rownum']-1; ?>
]" rows="6" cols="10">
					<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['symptom_other']['index']]['symptom_other']; ?>

				</textarea>
			</div>
		</div>	  </td>
		<?php endfor; endif; ?>
   	</tr>
    <?php if ($this->_tpl_vars['sex_code'] == 3): ?>
    <tr>
   	  <td colspan="2">是否妊娠期或哺乳期</td>
	  <?php unset($this->_sections['pregnancy']);
$this->_sections['pregnancy']['name'] = 'pregnancy';
$this->_sections['pregnancy']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pregnancy']['show'] = true;
$this->_sections['pregnancy']['max'] = $this->_sections['pregnancy']['loop'];
$this->_sections['pregnancy']['step'] = 1;
$this->_sections['pregnancy']['start'] = $this->_sections['pregnancy']['step'] > 0 ? 0 : $this->_sections['pregnancy']['loop']-1;
if ($this->_sections['pregnancy']['show']) {
    $this->_sections['pregnancy']['total'] = $this->_sections['pregnancy']['loop'];
    if ($this->_sections['pregnancy']['total'] == 0)
        $this->_sections['pregnancy']['show'] = false;
} else
    $this->_sections['pregnancy']['total'] = 0;
if ($this->_sections['pregnancy']['show']):

            for ($this->_sections['pregnancy']['index'] = $this->_sections['pregnancy']['start'], $this->_sections['pregnancy']['iteration'] = 1;
                 $this->_sections['pregnancy']['iteration'] <= $this->_sections['pregnancy']['total'];
                 $this->_sections['pregnancy']['index'] += $this->_sections['pregnancy']['step'], $this->_sections['pregnancy']['iteration']++):
$this->_sections['pregnancy']['rownum'] = $this->_sections['pregnancy']['iteration'];
$this->_sections['pregnancy']['index_prev'] = $this->_sections['pregnancy']['index'] - $this->_sections['pregnancy']['step'];
$this->_sections['pregnancy']['index_next'] = $this->_sections['pregnancy']['index'] + $this->_sections['pregnancy']['step'];
$this->_sections['pregnancy']['first']      = ($this->_sections['pregnancy']['iteration'] == 1);
$this->_sections['pregnancy']['last']       = ($this->_sections['pregnancy']['iteration'] == $this->_sections['pregnancy']['total']);
?>
      <td colspan="2">
      <?php $_from = $this->_tpl_vars['pregnancy_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','pregnancy')" class="blur"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
	       <?php endforeach; endif; unset($_from); ?>&nbsp;
	       <input type="text" name="pregnancy" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['pregnancy']['index']]['pregnancy']; ?>
" class="inputnew" />
        </td>
	  <?php endfor; endif; ?>
   	</tr>
    <?php endif; ?>
   	<tr>
   	  <td rowspan="7"><p>体</p>
      <p>征</p></td>
      <td align="center">血压(mmHg)</td>
	  <?php unset($this->_sections['blood_pressure']);
$this->_sections['blood_pressure']['name'] = 'blood_pressure';
$this->_sections['blood_pressure']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['blood_pressure']['show'] = true;
$this->_sections['blood_pressure']['max'] = $this->_sections['blood_pressure']['loop'];
$this->_sections['blood_pressure']['step'] = 1;
$this->_sections['blood_pressure']['start'] = $this->_sections['blood_pressure']['step'] > 0 ? 0 : $this->_sections['blood_pressure']['loop']-1;
if ($this->_sections['blood_pressure']['show']) {
    $this->_sections['blood_pressure']['total'] = $this->_sections['blood_pressure']['loop'];
    if ($this->_sections['blood_pressure']['total'] == 0)
        $this->_sections['blood_pressure']['show'] = false;
} else
    $this->_sections['blood_pressure']['total'] = 0;
if ($this->_sections['blood_pressure']['show']):

            for ($this->_sections['blood_pressure']['index'] = $this->_sections['blood_pressure']['start'], $this->_sections['blood_pressure']['iteration'] = 1;
                 $this->_sections['blood_pressure']['iteration'] <= $this->_sections['blood_pressure']['total'];
                 $this->_sections['blood_pressure']['index'] += $this->_sections['blood_pressure']['step'], $this->_sections['blood_pressure']['iteration']++):
$this->_sections['blood_pressure']['rownum'] = $this->_sections['blood_pressure']['iteration'];
$this->_sections['blood_pressure']['index_prev'] = $this->_sections['blood_pressure']['index'] - $this->_sections['blood_pressure']['step'];
$this->_sections['blood_pressure']['index_next'] = $this->_sections['blood_pressure']['index'] + $this->_sections['blood_pressure']['step'];
$this->_sections['blood_pressure']['first']      = ($this->_sections['blood_pressure']['iteration'] == 1);
$this->_sections['blood_pressure']['last']       = ($this->_sections['blood_pressure']['iteration'] == $this->_sections['blood_pressure']['total']);
?>
      <td colspan="2"><input type="text" name="blood_pressure[<?php echo $this->_sections['blood_pressure']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['blood_pressure']['index']]['blood_pressure']; ?>
" class="inputnone1" style="width:35px;" />/<input type="text" name="blood_pressure[<?php echo $this->_sections['blood_pressure']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['blood_pressure']['index']]['diastolic_blood_pressure']; ?>
" class="inputnone1"></td>
	  <?php endfor; endif; ?>
   	</tr>
    <tr>
   	  <td align="center">双侧血压相差值</td>
	  <?php unset($this->_sections['blood_difference']);
$this->_sections['blood_difference']['name'] = 'blood_difference';
$this->_sections['blood_difference']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['blood_difference']['show'] = true;
$this->_sections['blood_difference']['max'] = $this->_sections['blood_difference']['loop'];
$this->_sections['blood_difference']['step'] = 1;
$this->_sections['blood_difference']['start'] = $this->_sections['blood_difference']['step'] > 0 ? 0 : $this->_sections['blood_difference']['loop']-1;
if ($this->_sections['blood_difference']['show']) {
    $this->_sections['blood_difference']['total'] = $this->_sections['blood_difference']['loop'];
    if ($this->_sections['blood_difference']['total'] == 0)
        $this->_sections['blood_difference']['show'] = false;
} else
    $this->_sections['blood_difference']['total'] = 0;
if ($this->_sections['blood_difference']['show']):

            for ($this->_sections['blood_difference']['index'] = $this->_sections['blood_difference']['start'], $this->_sections['blood_difference']['iteration'] = 1;
                 $this->_sections['blood_difference']['iteration'] <= $this->_sections['blood_difference']['total'];
                 $this->_sections['blood_difference']['index'] += $this->_sections['blood_difference']['step'], $this->_sections['blood_difference']['iteration']++):
$this->_sections['blood_difference']['rownum'] = $this->_sections['blood_difference']['iteration'];
$this->_sections['blood_difference']['index_prev'] = $this->_sections['blood_difference']['index'] - $this->_sections['blood_difference']['step'];
$this->_sections['blood_difference']['index_next'] = $this->_sections['blood_difference']['index'] + $this->_sections['blood_difference']['step'];
$this->_sections['blood_difference']['first']      = ($this->_sections['blood_difference']['iteration'] == 1);
$this->_sections['blood_difference']['last']       = ($this->_sections['blood_difference']['iteration'] == $this->_sections['blood_difference']['total']);
?>
      <td colspan="2">
		  <input type="text" name="blood_difference[<?php echo $this->_sections['blood_difference']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['blood_difference']['index']]['blood_difference']; ?>
" class="inputnone" />
		  <?php endfor; endif; ?>
   	</tr>
    <tr>
   	  <td align="center">身高(cm)</td>
	  <?php unset($this->_sections['height']);
$this->_sections['height']['name'] = 'height';
$this->_sections['height']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['height']['show'] = true;
$this->_sections['height']['max'] = $this->_sections['height']['loop'];
$this->_sections['height']['step'] = 1;
$this->_sections['height']['start'] = $this->_sections['height']['step'] > 0 ? 0 : $this->_sections['height']['loop']-1;
if ($this->_sections['height']['show']) {
    $this->_sections['height']['total'] = $this->_sections['height']['loop'];
    if ($this->_sections['height']['total'] == 0)
        $this->_sections['height']['show'] = false;
} else
    $this->_sections['height']['total'] = 0;
if ($this->_sections['height']['show']):

            for ($this->_sections['height']['index'] = $this->_sections['height']['start'], $this->_sections['height']['iteration'] = 1;
                 $this->_sections['height']['iteration'] <= $this->_sections['height']['total'];
                 $this->_sections['height']['index'] += $this->_sections['height']['step'], $this->_sections['height']['iteration']++):
$this->_sections['height']['rownum'] = $this->_sections['height']['iteration'];
$this->_sections['height']['index_prev'] = $this->_sections['height']['index'] - $this->_sections['height']['step'];
$this->_sections['height']['index_next'] = $this->_sections['height']['index'] + $this->_sections['height']['step'];
$this->_sections['height']['first']      = ($this->_sections['height']['iteration'] == 1);
$this->_sections['height']['last']       = ($this->_sections['height']['iteration'] == $this->_sections['height']['total']);
?>
      <td colspan="2">
		  <input type="text" name="height[<?php echo $this->_sections['height']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['height']['index']]['height']; ?>
" class="inputnone">/
		  <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">体重(kg)</td>
	  <?php unset($this->_sections['weight_begin']);
$this->_sections['weight_begin']['name'] = 'weight_begin';
$this->_sections['weight_begin']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['weight_begin']['show'] = true;
$this->_sections['weight_begin']['max'] = $this->_sections['weight_begin']['loop'];
$this->_sections['weight_begin']['step'] = 1;
$this->_sections['weight_begin']['start'] = $this->_sections['weight_begin']['step'] > 0 ? 0 : $this->_sections['weight_begin']['loop']-1;
if ($this->_sections['weight_begin']['show']) {
    $this->_sections['weight_begin']['total'] = $this->_sections['weight_begin']['loop'];
    if ($this->_sections['weight_begin']['total'] == 0)
        $this->_sections['weight_begin']['show'] = false;
} else
    $this->_sections['weight_begin']['total'] = 0;
if ($this->_sections['weight_begin']['show']):

            for ($this->_sections['weight_begin']['index'] = $this->_sections['weight_begin']['start'], $this->_sections['weight_begin']['iteration'] = 1;
                 $this->_sections['weight_begin']['iteration'] <= $this->_sections['weight_begin']['total'];
                 $this->_sections['weight_begin']['index'] += $this->_sections['weight_begin']['step'], $this->_sections['weight_begin']['iteration']++):
$this->_sections['weight_begin']['rownum'] = $this->_sections['weight_begin']['iteration'];
$this->_sections['weight_begin']['index_prev'] = $this->_sections['weight_begin']['index'] - $this->_sections['weight_begin']['step'];
$this->_sections['weight_begin']['index_next'] = $this->_sections['weight_begin']['index'] + $this->_sections['weight_begin']['step'];
$this->_sections['weight_begin']['first']      = ($this->_sections['weight_begin']['iteration'] == 1);
$this->_sections['weight_begin']['last']       = ($this->_sections['weight_begin']['iteration'] == $this->_sections['weight_begin']['total']);
?>
      <td colspan="2">
		  <input type="text" name="weight_begin[<?php echo $this->_sections['weight_begin']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['weight_begin']['index']]['weight_begin']; ?>
" class="inputnone">/
		  <input type="text" name="weight_after[<?php echo $this->_sections['weight_begin']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['weight_begin']['index']]['weight_after']; ?>
" class="inputnone"></td>
		  <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">体质指数</td>
	  <?php unset($this->_sections['body_mass_index']);
$this->_sections['body_mass_index']['name'] = 'body_mass_index';
$this->_sections['body_mass_index']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['body_mass_index']['show'] = true;
$this->_sections['body_mass_index']['max'] = $this->_sections['body_mass_index']['loop'];
$this->_sections['body_mass_index']['step'] = 1;
$this->_sections['body_mass_index']['start'] = $this->_sections['body_mass_index']['step'] > 0 ? 0 : $this->_sections['body_mass_index']['loop']-1;
if ($this->_sections['body_mass_index']['show']) {
    $this->_sections['body_mass_index']['total'] = $this->_sections['body_mass_index']['loop'];
    if ($this->_sections['body_mass_index']['total'] == 0)
        $this->_sections['body_mass_index']['show'] = false;
} else
    $this->_sections['body_mass_index']['total'] = 0;
if ($this->_sections['body_mass_index']['show']):

            for ($this->_sections['body_mass_index']['index'] = $this->_sections['body_mass_index']['start'], $this->_sections['body_mass_index']['iteration'] = 1;
                 $this->_sections['body_mass_index']['iteration'] <= $this->_sections['body_mass_index']['total'];
                 $this->_sections['body_mass_index']['index'] += $this->_sections['body_mass_index']['step'], $this->_sections['body_mass_index']['iteration']++):
$this->_sections['body_mass_index']['rownum'] = $this->_sections['body_mass_index']['iteration'];
$this->_sections['body_mass_index']['index_prev'] = $this->_sections['body_mass_index']['index'] - $this->_sections['body_mass_index']['step'];
$this->_sections['body_mass_index']['index_next'] = $this->_sections['body_mass_index']['index'] + $this->_sections['body_mass_index']['step'];
$this->_sections['body_mass_index']['first']      = ($this->_sections['body_mass_index']['iteration'] == 1);
$this->_sections['body_mass_index']['last']       = ($this->_sections['body_mass_index']['iteration'] == $this->_sections['body_mass_index']['total']);
?>
      <td colspan="2"><input type="text" name="body_mass_index[<?php echo $this->_sections['body_mass_index']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['body_mass_index']['index']]['body_mass_index']; ?>
" class="inputnone1"></td>
   	  <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">心率</td>
	  <?php unset($this->_sections['heart_rate_begin']);
$this->_sections['heart_rate_begin']['name'] = 'heart_rate_begin';
$this->_sections['heart_rate_begin']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['heart_rate_begin']['show'] = true;
$this->_sections['heart_rate_begin']['max'] = $this->_sections['heart_rate_begin']['loop'];
$this->_sections['heart_rate_begin']['step'] = 1;
$this->_sections['heart_rate_begin']['start'] = $this->_sections['heart_rate_begin']['step'] > 0 ? 0 : $this->_sections['heart_rate_begin']['loop']-1;
if ($this->_sections['heart_rate_begin']['show']) {
    $this->_sections['heart_rate_begin']['total'] = $this->_sections['heart_rate_begin']['loop'];
    if ($this->_sections['heart_rate_begin']['total'] == 0)
        $this->_sections['heart_rate_begin']['show'] = false;
} else
    $this->_sections['heart_rate_begin']['total'] = 0;
if ($this->_sections['heart_rate_begin']['show']):

            for ($this->_sections['heart_rate_begin']['index'] = $this->_sections['heart_rate_begin']['start'], $this->_sections['heart_rate_begin']['iteration'] = 1;
                 $this->_sections['heart_rate_begin']['iteration'] <= $this->_sections['heart_rate_begin']['total'];
                 $this->_sections['heart_rate_begin']['index'] += $this->_sections['heart_rate_begin']['step'], $this->_sections['heart_rate_begin']['iteration']++):
$this->_sections['heart_rate_begin']['rownum'] = $this->_sections['heart_rate_begin']['iteration'];
$this->_sections['heart_rate_begin']['index_prev'] = $this->_sections['heart_rate_begin']['index'] - $this->_sections['heart_rate_begin']['step'];
$this->_sections['heart_rate_begin']['index_next'] = $this->_sections['heart_rate_begin']['index'] + $this->_sections['heart_rate_begin']['step'];
$this->_sections['heart_rate_begin']['first']      = ($this->_sections['heart_rate_begin']['iteration'] == 1);
$this->_sections['heart_rate_begin']['last']       = ($this->_sections['heart_rate_begin']['iteration'] == $this->_sections['heart_rate_begin']['total']);
?>
      <td colspan="2">
		  <input type="text" name="heart_rate_begin[<?php echo $this->_sections['heart_rate_begin']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['heart_rate_begin']['index']]['heart_rate_begin']; ?>
" class="inputnone">/
		  <input type="text" name="heart_rate_after[<?php echo $this->_sections['heart_rate_begin']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['heart_rate_begin']['index']]['heart_rate_after']; ?>
" class="inputnone"></td>
		   <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">其他</td>
	  <?php unset($this->_sections['signs_other']);
$this->_sections['signs_other']['name'] = 'signs_other';
$this->_sections['signs_other']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['signs_other']['show'] = true;
$this->_sections['signs_other']['max'] = $this->_sections['signs_other']['loop'];
$this->_sections['signs_other']['step'] = 1;
$this->_sections['signs_other']['start'] = $this->_sections['signs_other']['step'] > 0 ? 0 : $this->_sections['signs_other']['loop']-1;
if ($this->_sections['signs_other']['show']) {
    $this->_sections['signs_other']['total'] = $this->_sections['signs_other']['loop'];
    if ($this->_sections['signs_other']['total'] == 0)
        $this->_sections['signs_other']['show'] = false;
} else
    $this->_sections['signs_other']['total'] = 0;
if ($this->_sections['signs_other']['show']):

            for ($this->_sections['signs_other']['index'] = $this->_sections['signs_other']['start'], $this->_sections['signs_other']['iteration'] = 1;
                 $this->_sections['signs_other']['iteration'] <= $this->_sections['signs_other']['total'];
                 $this->_sections['signs_other']['index'] += $this->_sections['signs_other']['step'], $this->_sections['signs_other']['iteration']++):
$this->_sections['signs_other']['rownum'] = $this->_sections['signs_other']['iteration'];
$this->_sections['signs_other']['index_prev'] = $this->_sections['signs_other']['index'] - $this->_sections['signs_other']['step'];
$this->_sections['signs_other']['index_next'] = $this->_sections['signs_other']['index'] + $this->_sections['signs_other']['step'];
$this->_sections['signs_other']['first']      = ($this->_sections['signs_other']['iteration'] == 1);
$this->_sections['signs_other']['last']       = ($this->_sections['signs_other']['iteration'] == $this->_sections['signs_other']['total']);
?>
      <td colspan="2"><input type="text" name="signs_other[<?php echo $this->_sections['signs_other']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['signs_other']['index']]['signs_other']; ?>
" class="inputnone1"></td>
   	  <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td rowspan="7"><p>生</p>
      <p>活</p>
      <p>方</p>
      <p>式</p>
      <p>指</p>
      <p>导</p></td>
      <td align="center">日吸烟量(支)</td>
	  <?php unset($this->_sections['smoking_begin']);
$this->_sections['smoking_begin']['name'] = 'smoking_begin';
$this->_sections['smoking_begin']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['smoking_begin']['show'] = true;
$this->_sections['smoking_begin']['max'] = $this->_sections['smoking_begin']['loop'];
$this->_sections['smoking_begin']['step'] = 1;
$this->_sections['smoking_begin']['start'] = $this->_sections['smoking_begin']['step'] > 0 ? 0 : $this->_sections['smoking_begin']['loop']-1;
if ($this->_sections['smoking_begin']['show']) {
    $this->_sections['smoking_begin']['total'] = $this->_sections['smoking_begin']['loop'];
    if ($this->_sections['smoking_begin']['total'] == 0)
        $this->_sections['smoking_begin']['show'] = false;
} else
    $this->_sections['smoking_begin']['total'] = 0;
if ($this->_sections['smoking_begin']['show']):

            for ($this->_sections['smoking_begin']['index'] = $this->_sections['smoking_begin']['start'], $this->_sections['smoking_begin']['iteration'] = 1;
                 $this->_sections['smoking_begin']['iteration'] <= $this->_sections['smoking_begin']['total'];
                 $this->_sections['smoking_begin']['index'] += $this->_sections['smoking_begin']['step'], $this->_sections['smoking_begin']['iteration']++):
$this->_sections['smoking_begin']['rownum'] = $this->_sections['smoking_begin']['iteration'];
$this->_sections['smoking_begin']['index_prev'] = $this->_sections['smoking_begin']['index'] - $this->_sections['smoking_begin']['step'];
$this->_sections['smoking_begin']['index_next'] = $this->_sections['smoking_begin']['index'] + $this->_sections['smoking_begin']['step'];
$this->_sections['smoking_begin']['first']      = ($this->_sections['smoking_begin']['iteration'] == 1);
$this->_sections['smoking_begin']['last']       = ($this->_sections['smoking_begin']['iteration'] == $this->_sections['smoking_begin']['total']);
?>
      <td colspan="2">
		  <input type="text" name="smoking_begin[<?php echo $this->_sections['smoking_begin']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['smoking_begin']['index']]['smoking_begin']; ?>
" class="inputnone">/
		  <input type="text" name="smoking_after[<?php echo $this->_sections['smoking_begin']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['smoking_begin']['index']]['smoking_after']; ?>
" class="inputnone"></td>
		  <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">日饮酒量(两)</td>
	  <?php unset($this->_sections['drinking_begin']);
$this->_sections['drinking_begin']['name'] = 'drinking_begin';
$this->_sections['drinking_begin']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['drinking_begin']['show'] = true;
$this->_sections['drinking_begin']['max'] = $this->_sections['drinking_begin']['loop'];
$this->_sections['drinking_begin']['step'] = 1;
$this->_sections['drinking_begin']['start'] = $this->_sections['drinking_begin']['step'] > 0 ? 0 : $this->_sections['drinking_begin']['loop']-1;
if ($this->_sections['drinking_begin']['show']) {
    $this->_sections['drinking_begin']['total'] = $this->_sections['drinking_begin']['loop'];
    if ($this->_sections['drinking_begin']['total'] == 0)
        $this->_sections['drinking_begin']['show'] = false;
} else
    $this->_sections['drinking_begin']['total'] = 0;
if ($this->_sections['drinking_begin']['show']):

            for ($this->_sections['drinking_begin']['index'] = $this->_sections['drinking_begin']['start'], $this->_sections['drinking_begin']['iteration'] = 1;
                 $this->_sections['drinking_begin']['iteration'] <= $this->_sections['drinking_begin']['total'];
                 $this->_sections['drinking_begin']['index'] += $this->_sections['drinking_begin']['step'], $this->_sections['drinking_begin']['iteration']++):
$this->_sections['drinking_begin']['rownum'] = $this->_sections['drinking_begin']['iteration'];
$this->_sections['drinking_begin']['index_prev'] = $this->_sections['drinking_begin']['index'] - $this->_sections['drinking_begin']['step'];
$this->_sections['drinking_begin']['index_next'] = $this->_sections['drinking_begin']['index'] + $this->_sections['drinking_begin']['step'];
$this->_sections['drinking_begin']['first']      = ($this->_sections['drinking_begin']['iteration'] == 1);
$this->_sections['drinking_begin']['last']       = ($this->_sections['drinking_begin']['iteration'] == $this->_sections['drinking_begin']['total']);
?>
      <td colspan="2">
		  <input type="text" name="drinking_begin[<?php echo $this->_sections['drinking_begin']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['drinking_begin']['index']]['drinking_begin']; ?>
" class="inputnone">/
		  <input type="text" name="drinking_after[<?php echo $this->_sections['drinking_begin']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['drinking_begin']['index']]['drinking_after']; ?>
" class="inputnone"></td>
     <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td rowspan="2" align="center">运动</td>
	  <?php unset($this->_sections['sport_amount_begin']);
$this->_sections['sport_amount_begin']['name'] = 'sport_amount_begin';
$this->_sections['sport_amount_begin']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sport_amount_begin']['show'] = true;
$this->_sections['sport_amount_begin']['max'] = $this->_sections['sport_amount_begin']['loop'];
$this->_sections['sport_amount_begin']['step'] = 1;
$this->_sections['sport_amount_begin']['start'] = $this->_sections['sport_amount_begin']['step'] > 0 ? 0 : $this->_sections['sport_amount_begin']['loop']-1;
if ($this->_sections['sport_amount_begin']['show']) {
    $this->_sections['sport_amount_begin']['total'] = $this->_sections['sport_amount_begin']['loop'];
    if ($this->_sections['sport_amount_begin']['total'] == 0)
        $this->_sections['sport_amount_begin']['show'] = false;
} else
    $this->_sections['sport_amount_begin']['total'] = 0;
if ($this->_sections['sport_amount_begin']['show']):

            for ($this->_sections['sport_amount_begin']['index'] = $this->_sections['sport_amount_begin']['start'], $this->_sections['sport_amount_begin']['iteration'] = 1;
                 $this->_sections['sport_amount_begin']['iteration'] <= $this->_sections['sport_amount_begin']['total'];
                 $this->_sections['sport_amount_begin']['index'] += $this->_sections['sport_amount_begin']['step'], $this->_sections['sport_amount_begin']['iteration']++):
$this->_sections['sport_amount_begin']['rownum'] = $this->_sections['sport_amount_begin']['iteration'];
$this->_sections['sport_amount_begin']['index_prev'] = $this->_sections['sport_amount_begin']['index'] - $this->_sections['sport_amount_begin']['step'];
$this->_sections['sport_amount_begin']['index_next'] = $this->_sections['sport_amount_begin']['index'] + $this->_sections['sport_amount_begin']['step'];
$this->_sections['sport_amount_begin']['first']      = ($this->_sections['sport_amount_begin']['iteration'] == 1);
$this->_sections['sport_amount_begin']['last']       = ($this->_sections['sport_amount_begin']['iteration'] == $this->_sections['sport_amount_begin']['total']);
?>
      <td colspan="2" align="center">
	  	<input type="text" name="sport_amount_begin[<?php echo $this->_sections['sport_amount_begin']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['sport_amount_begin']['index']]['sport_amount_begin']; ?>
" class="inputnone">次/周
	  <input type="text" name="sport_time_begin[<?php echo $this->_sections['sport_amount_begin']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['sport_amount_begin']['index']]['sport_time_begin']; ?>
" class="inputnone">分钟/次	  </td> 
	  <?php endfor; endif; ?>
	  </tr>
   	<tr>
   	<?php unset($this->_sections['sport_amount_after']);
$this->_sections['sport_amount_after']['name'] = 'sport_amount_after';
$this->_sections['sport_amount_after']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sport_amount_after']['show'] = true;
$this->_sections['sport_amount_after']['max'] = $this->_sections['sport_amount_after']['loop'];
$this->_sections['sport_amount_after']['step'] = 1;
$this->_sections['sport_amount_after']['start'] = $this->_sections['sport_amount_after']['step'] > 0 ? 0 : $this->_sections['sport_amount_after']['loop']-1;
if ($this->_sections['sport_amount_after']['show']) {
    $this->_sections['sport_amount_after']['total'] = $this->_sections['sport_amount_after']['loop'];
    if ($this->_sections['sport_amount_after']['total'] == 0)
        $this->_sections['sport_amount_after']['show'] = false;
} else
    $this->_sections['sport_amount_after']['total'] = 0;
if ($this->_sections['sport_amount_after']['show']):

            for ($this->_sections['sport_amount_after']['index'] = $this->_sections['sport_amount_after']['start'], $this->_sections['sport_amount_after']['iteration'] = 1;
                 $this->_sections['sport_amount_after']['iteration'] <= $this->_sections['sport_amount_after']['total'];
                 $this->_sections['sport_amount_after']['index'] += $this->_sections['sport_amount_after']['step'], $this->_sections['sport_amount_after']['iteration']++):
$this->_sections['sport_amount_after']['rownum'] = $this->_sections['sport_amount_after']['iteration'];
$this->_sections['sport_amount_after']['index_prev'] = $this->_sections['sport_amount_after']['index'] - $this->_sections['sport_amount_after']['step'];
$this->_sections['sport_amount_after']['index_next'] = $this->_sections['sport_amount_after']['index'] + $this->_sections['sport_amount_after']['step'];
$this->_sections['sport_amount_after']['first']      = ($this->_sections['sport_amount_after']['iteration'] == 1);
$this->_sections['sport_amount_after']['last']       = ($this->_sections['sport_amount_after']['iteration'] == $this->_sections['sport_amount_after']['total']);
?>	
	  <td colspan="2" align="center">
	  	<input type="text" name="sport_amount_after[<?php echo $this->_sections['sport_amount_after']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['sport_amount_after']['index']]['sport_amount_after']; ?>
" class="inputnone">次/周
	  <input type="text" name="sport_time_after[<?php echo $this->_sections['sport_amount_after']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['sport_amount_after']['index']]['sport_time_after']; ?>
" class="inputnone">分钟/次	  </td> 
	  <?php endfor; endif; ?>
	  </tr>
   	<tr>
   	  <td align="center"><p>摄盐情况</p>
      <p>(咸淡)</p></td>
	  <?php unset($this->_sections['salt_intake_begin']);
$this->_sections['salt_intake_begin']['name'] = 'salt_intake_begin';
$this->_sections['salt_intake_begin']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['salt_intake_begin']['show'] = true;
$this->_sections['salt_intake_begin']['max'] = $this->_sections['salt_intake_begin']['loop'];
$this->_sections['salt_intake_begin']['step'] = 1;
$this->_sections['salt_intake_begin']['start'] = $this->_sections['salt_intake_begin']['step'] > 0 ? 0 : $this->_sections['salt_intake_begin']['loop']-1;
if ($this->_sections['salt_intake_begin']['show']) {
    $this->_sections['salt_intake_begin']['total'] = $this->_sections['salt_intake_begin']['loop'];
    if ($this->_sections['salt_intake_begin']['total'] == 0)
        $this->_sections['salt_intake_begin']['show'] = false;
} else
    $this->_sections['salt_intake_begin']['total'] = 0;
if ($this->_sections['salt_intake_begin']['show']):

            for ($this->_sections['salt_intake_begin']['index'] = $this->_sections['salt_intake_begin']['start'], $this->_sections['salt_intake_begin']['iteration'] = 1;
                 $this->_sections['salt_intake_begin']['iteration'] <= $this->_sections['salt_intake_begin']['total'];
                 $this->_sections['salt_intake_begin']['index'] += $this->_sections['salt_intake_begin']['step'], $this->_sections['salt_intake_begin']['iteration']++):
$this->_sections['salt_intake_begin']['rownum'] = $this->_sections['salt_intake_begin']['iteration'];
$this->_sections['salt_intake_begin']['index_prev'] = $this->_sections['salt_intake_begin']['index'] - $this->_sections['salt_intake_begin']['step'];
$this->_sections['salt_intake_begin']['index_next'] = $this->_sections['salt_intake_begin']['index'] + $this->_sections['salt_intake_begin']['step'];
$this->_sections['salt_intake_begin']['first']      = ($this->_sections['salt_intake_begin']['iteration'] == 1);
$this->_sections['salt_intake_begin']['last']       = ($this->_sections['salt_intake_begin']['iteration'] == $this->_sections['salt_intake_begin']['total']);
?>
      <td colspan="2">
         
          <input type="radio" name="salt_intake_begin[<?php echo $this->_sections['salt_intake_begin']['rownum']-1; ?>
]" value="1" <?php if ($this->_tpl_vars['hypertension_array'][$this->_sections['salt_intake_begin']['index']]['salt_intake_begin'] == 1): ?> checked="checked"<?php endif; ?> />轻
          <input type="radio" name="salt_intake_begin[<?php echo $this->_sections['salt_intake_begin']['rownum']-1; ?>
]" value="2" <?php if ($this->_tpl_vars['hypertension_array'][$this->_sections['salt_intake_begin']['index']]['salt_intake_begin'] == 2): ?> checked="checked"<?php endif; ?> />中
          <input type="radio" name="salt_intake_begin[<?php echo $this->_sections['salt_intake_begin']['rownum']-1; ?>
]" value="3" <?php if ($this->_tpl_vars['hypertension_array'][$this->_sections['salt_intake_begin']['index']]['salt_intake_begin'] == 3): ?> checked="checked"<?php endif; ?> />重
		  /
          <input type="radio" name="salt_intake_after[<?php echo $this->_sections['salt_intake_begin']['rownum']-1; ?>
]" value="1" <?php if ($this->_tpl_vars['hypertension_array'][$this->_sections['salt_intake_begin']['index']]['salt_intake_after'] == 1): ?> checked="checked"<?php endif; ?> />轻
          <input type="radio" name="salt_intake_after[<?php echo $this->_sections['salt_intake_begin']['rownum']-1; ?>
]" value="2" <?php if ($this->_tpl_vars['hypertension_array'][$this->_sections['salt_intake_begin']['index']]['salt_intake_after'] == 2): ?> checked="checked"<?php endif; ?> />中
          <input type="radio" name="salt_intake_after[<?php echo $this->_sections['salt_intake_begin']['rownum']-1; ?>
]" value="3" <?php if ($this->_tpl_vars['hypertension_array'][$this->_sections['salt_intake_begin']['index']]['salt_intake_after'] == 3): ?> checked="checked"<?php endif; ?> />重
          </td>
		  <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">心理调整</td>
	  <?php unset($this->_sections['psychology']);
$this->_sections['psychology']['name'] = 'psychology';
$this->_sections['psychology']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['psychology']['show'] = true;
$this->_sections['psychology']['max'] = $this->_sections['psychology']['loop'];
$this->_sections['psychology']['step'] = 1;
$this->_sections['psychology']['start'] = $this->_sections['psychology']['step'] > 0 ? 0 : $this->_sections['psychology']['loop']-1;
if ($this->_sections['psychology']['show']) {
    $this->_sections['psychology']['total'] = $this->_sections['psychology']['loop'];
    if ($this->_sections['psychology']['total'] == 0)
        $this->_sections['psychology']['show'] = false;
} else
    $this->_sections['psychology']['total'] = 0;
if ($this->_sections['psychology']['show']):

            for ($this->_sections['psychology']['index'] = $this->_sections['psychology']['start'], $this->_sections['psychology']['iteration'] = 1;
                 $this->_sections['psychology']['iteration'] <= $this->_sections['psychology']['total'];
                 $this->_sections['psychology']['index'] += $this->_sections['psychology']['step'], $this->_sections['psychology']['iteration']++):
$this->_sections['psychology']['rownum'] = $this->_sections['psychology']['iteration'];
$this->_sections['psychology']['index_prev'] = $this->_sections['psychology']['index'] - $this->_sections['psychology']['step'];
$this->_sections['psychology']['index_next'] = $this->_sections['psychology']['index'] + $this->_sections['psychology']['step'];
$this->_sections['psychology']['first']      = ($this->_sections['psychology']['iteration'] == 1);
$this->_sections['psychology']['last']       = ($this->_sections['psychology']['iteration'] == $this->_sections['psychology']['total']);
?>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['psychology']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['c']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['c'][1]; ?>

		<?php endforeach; endif; unset($_from); ?>
		<input type="text" name="heart_adjustment[<?php echo $this->_sections['psychology']['rownum']-1; ?>
]" class="inputnew" name="" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['psychology']['index']]['psychology']; ?>
" />	  </td>
	<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">遵医行为</td>
	  <?php unset($this->_sections['treatment_compliance']);
$this->_sections['treatment_compliance']['name'] = 'treatment_compliance';
$this->_sections['treatment_compliance']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['treatment_compliance']['show'] = true;
$this->_sections['treatment_compliance']['max'] = $this->_sections['treatment_compliance']['loop'];
$this->_sections['treatment_compliance']['step'] = 1;
$this->_sections['treatment_compliance']['start'] = $this->_sections['treatment_compliance']['step'] > 0 ? 0 : $this->_sections['treatment_compliance']['loop']-1;
if ($this->_sections['treatment_compliance']['show']) {
    $this->_sections['treatment_compliance']['total'] = $this->_sections['treatment_compliance']['loop'];
    if ($this->_sections['treatment_compliance']['total'] == 0)
        $this->_sections['treatment_compliance']['show'] = false;
} else
    $this->_sections['treatment_compliance']['total'] = 0;
if ($this->_sections['treatment_compliance']['show']):

            for ($this->_sections['treatment_compliance']['index'] = $this->_sections['treatment_compliance']['start'], $this->_sections['treatment_compliance']['iteration'] = 1;
                 $this->_sections['treatment_compliance']['iteration'] <= $this->_sections['treatment_compliance']['total'];
                 $this->_sections['treatment_compliance']['index'] += $this->_sections['treatment_compliance']['step'], $this->_sections['treatment_compliance']['iteration']++):
$this->_sections['treatment_compliance']['rownum'] = $this->_sections['treatment_compliance']['iteration'];
$this->_sections['treatment_compliance']['index_prev'] = $this->_sections['treatment_compliance']['index'] - $this->_sections['treatment_compliance']['step'];
$this->_sections['treatment_compliance']['index_next'] = $this->_sections['treatment_compliance']['index'] + $this->_sections['treatment_compliance']['step'];
$this->_sections['treatment_compliance']['first']      = ($this->_sections['treatment_compliance']['iteration'] == 1);
$this->_sections['treatment_compliance']['last']       = ($this->_sections['treatment_compliance']['iteration'] == $this->_sections['treatment_compliance']['total']);
?>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['treatment_compliance']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>

		<?php endforeach; endif; unset($_from); ?>
		<input type="text" name="treatment_compliance[<?php echo $this->_sections['treatment_compliance']['rownum']-1; ?>
]" class="inputnew" name="" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['treatment_compliance']['index']]['treatment_compliance']; ?>
" />	  </td>
	  <?php endfor; endif; ?>
   	</tr>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">辅助检查*</td>
	  <?php unset($this->_sections['auxiliary_check']);
$this->_sections['auxiliary_check']['name'] = 'auxiliary_check';
$this->_sections['auxiliary_check']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['auxiliary_check']['show'] = true;
$this->_sections['auxiliary_check']['max'] = $this->_sections['auxiliary_check']['loop'];
$this->_sections['auxiliary_check']['step'] = 1;
$this->_sections['auxiliary_check']['start'] = $this->_sections['auxiliary_check']['step'] > 0 ? 0 : $this->_sections['auxiliary_check']['loop']-1;
if ($this->_sections['auxiliary_check']['show']) {
    $this->_sections['auxiliary_check']['total'] = $this->_sections['auxiliary_check']['loop'];
    if ($this->_sections['auxiliary_check']['total'] == 0)
        $this->_sections['auxiliary_check']['show'] = false;
} else
    $this->_sections['auxiliary_check']['total'] = 0;
if ($this->_sections['auxiliary_check']['show']):

            for ($this->_sections['auxiliary_check']['index'] = $this->_sections['auxiliary_check']['start'], $this->_sections['auxiliary_check']['iteration'] = 1;
                 $this->_sections['auxiliary_check']['iteration'] <= $this->_sections['auxiliary_check']['total'];
                 $this->_sections['auxiliary_check']['index'] += $this->_sections['auxiliary_check']['step'], $this->_sections['auxiliary_check']['iteration']++):
$this->_sections['auxiliary_check']['rownum'] = $this->_sections['auxiliary_check']['iteration'];
$this->_sections['auxiliary_check']['index_prev'] = $this->_sections['auxiliary_check']['index'] - $this->_sections['auxiliary_check']['step'];
$this->_sections['auxiliary_check']['index_next'] = $this->_sections['auxiliary_check']['index'] + $this->_sections['auxiliary_check']['step'];
$this->_sections['auxiliary_check']['first']      = ($this->_sections['auxiliary_check']['iteration'] == 1);
$this->_sections['auxiliary_check']['last']       = ($this->_sections['auxiliary_check']['iteration'] == $this->_sections['auxiliary_check']['total']);
?>
      <td colspan="2"><input type="text" name="auxiliary_check[<?php echo $this->_sections['auxiliary_check']['rownum']-1; ?>
]" class="inputnone1" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['auxiliary_check']['index']]['auxiliary_check']; ?>
"></td>
      <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">服药依从性</td>
	  <?php unset($this->_sections['medication_compliance']);
$this->_sections['medication_compliance']['name'] = 'medication_compliance';
$this->_sections['medication_compliance']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['medication_compliance']['show'] = true;
$this->_sections['medication_compliance']['max'] = $this->_sections['medication_compliance']['loop'];
$this->_sections['medication_compliance']['step'] = 1;
$this->_sections['medication_compliance']['start'] = $this->_sections['medication_compliance']['step'] > 0 ? 0 : $this->_sections['medication_compliance']['loop']-1;
if ($this->_sections['medication_compliance']['show']) {
    $this->_sections['medication_compliance']['total'] = $this->_sections['medication_compliance']['loop'];
    if ($this->_sections['medication_compliance']['total'] == 0)
        $this->_sections['medication_compliance']['show'] = false;
} else
    $this->_sections['medication_compliance']['total'] = 0;
if ($this->_sections['medication_compliance']['show']):

            for ($this->_sections['medication_compliance']['index'] = $this->_sections['medication_compliance']['start'], $this->_sections['medication_compliance']['iteration'] = 1;
                 $this->_sections['medication_compliance']['iteration'] <= $this->_sections['medication_compliance']['total'];
                 $this->_sections['medication_compliance']['index'] += $this->_sections['medication_compliance']['step'], $this->_sections['medication_compliance']['iteration']++):
$this->_sections['medication_compliance']['rownum'] = $this->_sections['medication_compliance']['iteration'];
$this->_sections['medication_compliance']['index_prev'] = $this->_sections['medication_compliance']['index'] - $this->_sections['medication_compliance']['step'];
$this->_sections['medication_compliance']['index_next'] = $this->_sections['medication_compliance']['index'] + $this->_sections['medication_compliance']['step'];
$this->_sections['medication_compliance']['first']      = ($this->_sections['medication_compliance']['iteration'] == 1);
$this->_sections['medication_compliance']['last']       = ($this->_sections['medication_compliance']['iteration'] == $this->_sections['medication_compliance']['total']);
?>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['medication_compliance']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>

		<?php endforeach; endif; unset($_from); ?>
		<input type="text" name="medication_compliance[<?php echo $this->_sections['medication_compliance']['rownum']-1; ?>
]" class="inputnew" name="" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['medication_compliance']['index']]['medication_compliance']; ?>
" />	  </td>
		<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">药物不良反应</td>
	  <?php unset($this->_sections['adverse_drug']);
$this->_sections['adverse_drug']['name'] = 'adverse_drug';
$this->_sections['adverse_drug']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['adverse_drug']['show'] = true;
$this->_sections['adverse_drug']['max'] = $this->_sections['adverse_drug']['loop'];
$this->_sections['adverse_drug']['step'] = 1;
$this->_sections['adverse_drug']['start'] = $this->_sections['adverse_drug']['step'] > 0 ? 0 : $this->_sections['adverse_drug']['loop']-1;
if ($this->_sections['adverse_drug']['show']) {
    $this->_sections['adverse_drug']['total'] = $this->_sections['adverse_drug']['loop'];
    if ($this->_sections['adverse_drug']['total'] == 0)
        $this->_sections['adverse_drug']['show'] = false;
} else
    $this->_sections['adverse_drug']['total'] = 0;
if ($this->_sections['adverse_drug']['show']):

            for ($this->_sections['adverse_drug']['index'] = $this->_sections['adverse_drug']['start'], $this->_sections['adverse_drug']['iteration'] = 1;
                 $this->_sections['adverse_drug']['iteration'] <= $this->_sections['adverse_drug']['total'];
                 $this->_sections['adverse_drug']['index'] += $this->_sections['adverse_drug']['step'], $this->_sections['adverse_drug']['iteration']++):
$this->_sections['adverse_drug']['rownum'] = $this->_sections['adverse_drug']['iteration'];
$this->_sections['adverse_drug']['index_prev'] = $this->_sections['adverse_drug']['index'] - $this->_sections['adverse_drug']['step'];
$this->_sections['adverse_drug']['index_next'] = $this->_sections['adverse_drug']['index'] + $this->_sections['adverse_drug']['step'];
$this->_sections['adverse_drug']['first']      = ($this->_sections['adverse_drug']['iteration'] == 1);
$this->_sections['adverse_drug']['last']       = ($this->_sections['adverse_drug']['iteration'] == $this->_sections['adverse_drug']['total']);
?>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['adverse_drug']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>

		<?php endforeach; endif; unset($_from); ?>
		<input type="text" name="adverse_drug_info[<?php echo $this->_sections['adverse_drug']['rownum']-1; ?>
]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['adverse_drug']['index']]['adverse_drug_info']; ?>
" class="inputbottom" />
		<input type="text" name="adverse_drug[<?php echo $this->_sections['adverse_drug']['rownum']-1; ?>
]" class="inputnew" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['adverse_drug']['index']]['adverse_drug']; ?>
" />	  </td>
      <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">随访分类</td>
	  <?php unset($this->_sections['follow_up_result']);
$this->_sections['follow_up_result']['name'] = 'follow_up_result';
$this->_sections['follow_up_result']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['follow_up_result']['show'] = true;
$this->_sections['follow_up_result']['max'] = $this->_sections['follow_up_result']['loop'];
$this->_sections['follow_up_result']['step'] = 1;
$this->_sections['follow_up_result']['start'] = $this->_sections['follow_up_result']['step'] > 0 ? 0 : $this->_sections['follow_up_result']['loop']-1;
if ($this->_sections['follow_up_result']['show']) {
    $this->_sections['follow_up_result']['total'] = $this->_sections['follow_up_result']['loop'];
    if ($this->_sections['follow_up_result']['total'] == 0)
        $this->_sections['follow_up_result']['show'] = false;
} else
    $this->_sections['follow_up_result']['total'] = 0;
if ($this->_sections['follow_up_result']['show']):

            for ($this->_sections['follow_up_result']['index'] = $this->_sections['follow_up_result']['start'], $this->_sections['follow_up_result']['iteration'] = 1;
                 $this->_sections['follow_up_result']['iteration'] <= $this->_sections['follow_up_result']['total'];
                 $this->_sections['follow_up_result']['index'] += $this->_sections['follow_up_result']['step'], $this->_sections['follow_up_result']['iteration']++):
$this->_sections['follow_up_result']['rownum'] = $this->_sections['follow_up_result']['iteration'];
$this->_sections['follow_up_result']['index_prev'] = $this->_sections['follow_up_result']['index'] - $this->_sections['follow_up_result']['step'];
$this->_sections['follow_up_result']['index_next'] = $this->_sections['follow_up_result']['index'] + $this->_sections['follow_up_result']['step'];
$this->_sections['follow_up_result']['first']      = ($this->_sections['follow_up_result']['iteration'] == 1);
$this->_sections['follow_up_result']['last']       = ($this->_sections['follow_up_result']['iteration'] == $this->_sections['follow_up_result']['total']);
?>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['follow_up_result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>

		<?php endforeach; endif; unset($_from); ?>
		<input type="text" name="follow_up_result[<?php echo $this->_sections['follow_up_result']['rownum']-1; ?>
]" class="inputnew" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['follow_up_result']['index']]['follow_up_result']; ?>
" />	  </td>
      <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td rowspan="8"><p>用</p>
      <p>药</p>
      <p>情</p>
      <p>况</p></td>
	  <?php unset($this->_sections['drug']);
$this->_sections['drug']['name'] = 'drug';
$this->_sections['drug']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['drug']['show'] = true;
$this->_sections['drug']['max'] = $this->_sections['drug']['loop'];
$this->_sections['drug']['step'] = 1;
$this->_sections['drug']['start'] = $this->_sections['drug']['step'] > 0 ? 0 : $this->_sections['drug']['loop']-1;
if ($this->_sections['drug']['show']) {
    $this->_sections['drug']['total'] = $this->_sections['drug']['loop'];
    if ($this->_sections['drug']['total'] == 0)
        $this->_sections['drug']['show'] = false;
} else
    $this->_sections['drug']['total'] = 0;
if ($this->_sections['drug']['show']):

            for ($this->_sections['drug']['index'] = $this->_sections['drug']['start'], $this->_sections['drug']['iteration'] = 1;
                 $this->_sections['drug']['iteration'] <= $this->_sections['drug']['total'];
                 $this->_sections['drug']['index'] += $this->_sections['drug']['step'], $this->_sections['drug']['iteration']++):
$this->_sections['drug']['rownum'] = $this->_sections['drug']['iteration'];
$this->_sections['drug']['index_prev'] = $this->_sections['drug']['index'] - $this->_sections['drug']['step'];
$this->_sections['drug']['index_next'] = $this->_sections['drug']['index'] + $this->_sections['drug']['step'];
$this->_sections['drug']['first']      = ($this->_sections['drug']['iteration'] == 1);
$this->_sections['drug']['last']       = ($this->_sections['drug']['iteration'] == $this->_sections['drug']['total']);
?>
	  <?php unset($this->_sections['drug_show']);
$this->_sections['drug_show']['name'] = 'drug_show';
$this->_sections['drug_show']['loop'] = is_array($_loop=4) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['drug_show']['show'] = true;
$this->_sections['drug_show']['max'] = $this->_sections['drug_show']['loop'];
$this->_sections['drug_show']['step'] = 1;
$this->_sections['drug_show']['start'] = $this->_sections['drug_show']['step'] > 0 ? 0 : $this->_sections['drug_show']['loop']-1;
if ($this->_sections['drug_show']['show']) {
    $this->_sections['drug_show']['total'] = $this->_sections['drug_show']['loop'];
    if ($this->_sections['drug_show']['total'] == 0)
        $this->_sections['drug_show']['show'] = false;
} else
    $this->_sections['drug_show']['total'] = 0;
if ($this->_sections['drug_show']['show']):

            for ($this->_sections['drug_show']['index'] = $this->_sections['drug_show']['start'], $this->_sections['drug_show']['iteration'] = 1;
                 $this->_sections['drug_show']['iteration'] <= $this->_sections['drug_show']['total'];
                 $this->_sections['drug_show']['index'] += $this->_sections['drug_show']['step'], $this->_sections['drug_show']['iteration']++):
$this->_sections['drug_show']['rownum'] = $this->_sections['drug_show']['iteration'];
$this->_sections['drug_show']['index_prev'] = $this->_sections['drug_show']['index'] - $this->_sections['drug_show']['step'];
$this->_sections['drug_show']['index_next'] = $this->_sections['drug_show']['index'] + $this->_sections['drug_show']['step'];
$this->_sections['drug_show']['first']      = ($this->_sections['drug_show']['iteration'] == 1);
$this->_sections['drug_show']['last']       = ($this->_sections['drug_show']['iteration'] == $this->_sections['drug_show']['total']);
?>
	  <?php if ($this->_sections['drug']['rownum'] == 1): ?>
	  <?php if ($this->_sections['drug_show']['rownum'] == 1): ?>
      <td align="center">药物名称<?php echo $this->_sections['drug_show']['rownum']; ?>
</td>
	  <?php unset($this->_sections['drug_name']);
$this->_sections['drug_name']['name'] = 'drug_name';
$this->_sections['drug_name']['loop'] = is_array($_loop=$this->_tpl_vars['hypertension_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['drug_name']['show'] = true;
$this->_sections['drug_name']['max'] = $this->_sections['drug_name']['loop'];
$this->_sections['drug_name']['step'] = 1;
$this->_sections['drug_name']['start'] = $this->_sections['drug_name']['step'] > 0 ? 0 : $this->_sections['drug_name']['loop']-1;
if ($this->_sections['drug_name']['show']) {
    $this->_sections['drug_name']['total'] = $this->_sections['drug_name']['loop'];
    if ($this->_sections['drug_name']['total'] == 0)
        $this->_sections['drug_name']['show'] = false;
} else
    $this->_sections['drug_name']['total'] = 0;
if ($this->_sections['drug_name']['show']):

            for ($this->_sections['drug_name']['index'] = $this->_sections['drug_name']['start'], $this->_sections['drug_name']['iteration'] = 1;
                 $this->_sections['drug_name']['iteration'] <= $this->_sections['drug_name']['total'];
                 $this->_sections['drug_name']['index'] += $this->_sections['drug_name']['step'], $this->_sections['drug_name']['iteration']++):
$this->_sections['drug_name']['rownum'] = $this->_sections['drug_name']['iteration'];
$this->_sections['drug_name']['index_prev'] = $this->_sections['drug_name']['index'] - $this->_sections['drug_name']['step'];
$this->_sections['drug_name']['index_next'] = $this->_sections['drug_name']['index'] + $this->_sections['drug_name']['step'];
$this->_sections['drug_name']['first']      = ($this->_sections['drug_name']['iteration'] == 1);
$this->_sections['drug_name']['last']       = ($this->_sections['drug_name']['iteration'] == $this->_sections['drug_name']['total']);
?>
      <td colspan="2"><input type="text" name="drug_name[]" class="inputnone1" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['drug_name']['index']]['drug'][$this->_sections['drug_show']['index']]['drug_name']; ?>
"></td>
   	  <?php endfor; endif; ?>
	</tr>
   	<tr>
   	  <td align="center">用法用量</td>
	  <?php unset($this->_sections['drug_name']);
$this->_sections['drug_name']['name'] = 'drug_name';
$this->_sections['drug_name']['loop'] = is_array($_loop=$this->_tpl_vars['hypertension_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['drug_name']['show'] = true;
$this->_sections['drug_name']['max'] = $this->_sections['drug_name']['loop'];
$this->_sections['drug_name']['step'] = 1;
$this->_sections['drug_name']['start'] = $this->_sections['drug_name']['step'] > 0 ? 0 : $this->_sections['drug_name']['loop']-1;
if ($this->_sections['drug_name']['show']) {
    $this->_sections['drug_name']['total'] = $this->_sections['drug_name']['loop'];
    if ($this->_sections['drug_name']['total'] == 0)
        $this->_sections['drug_name']['show'] = false;
} else
    $this->_sections['drug_name']['total'] = 0;
if ($this->_sections['drug_name']['show']):

            for ($this->_sections['drug_name']['index'] = $this->_sections['drug_name']['start'], $this->_sections['drug_name']['iteration'] = 1;
                 $this->_sections['drug_name']['iteration'] <= $this->_sections['drug_name']['total'];
                 $this->_sections['drug_name']['index'] += $this->_sections['drug_name']['step'], $this->_sections['drug_name']['iteration']++):
$this->_sections['drug_name']['rownum'] = $this->_sections['drug_name']['iteration'];
$this->_sections['drug_name']['index_prev'] = $this->_sections['drug_name']['index'] - $this->_sections['drug_name']['step'];
$this->_sections['drug_name']['index_next'] = $this->_sections['drug_name']['index'] + $this->_sections['drug_name']['step'];
$this->_sections['drug_name']['first']      = ($this->_sections['drug_name']['iteration'] == 1);
$this->_sections['drug_name']['last']       = ($this->_sections['drug_name']['iteration'] == $this->_sections['drug_name']['total']);
?>
       <td>每日<input type="text" name="drug_frequency[]" class="inputs" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['drug_name']['index']]['drug'][$this->_sections['drug_show']['index']]['drug_frequency']; ?>
">次</td>
   	  <td>每次<input type="text" name="drug_amount[]" class="inputs" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['drug_name']['index']]['drug'][$this->_sections['drug_show']['index']]['drug_amount']; ?>
">mg</td>
   	  <?php endfor; endif; ?>
	</tr>
	<?php elseif ($this->_sections['drug']['rownum'] > 1 && $this->_sections['drug']['rownum'] < 4): ?>
	<?php elseif ($this->_sections['drug_show']['rownum'] > 1 && $this->_sections['drug_show']['rownum'] < 4): ?>
   		<tr>
      <td align="center">药物名称<?php echo $this->_sections['drug_show']['rownum']; ?>
</td>
	  <?php unset($this->_sections['drug_two']);
$this->_sections['drug_two']['name'] = 'drug_two';
$this->_sections['drug_two']['loop'] = is_array($_loop=$this->_tpl_vars['hypertension_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['drug_two']['show'] = true;
$this->_sections['drug_two']['max'] = $this->_sections['drug_two']['loop'];
$this->_sections['drug_two']['step'] = 1;
$this->_sections['drug_two']['start'] = $this->_sections['drug_two']['step'] > 0 ? 0 : $this->_sections['drug_two']['loop']-1;
if ($this->_sections['drug_two']['show']) {
    $this->_sections['drug_two']['total'] = $this->_sections['drug_two']['loop'];
    if ($this->_sections['drug_two']['total'] == 0)
        $this->_sections['drug_two']['show'] = false;
} else
    $this->_sections['drug_two']['total'] = 0;
if ($this->_sections['drug_two']['show']):

            for ($this->_sections['drug_two']['index'] = $this->_sections['drug_two']['start'], $this->_sections['drug_two']['iteration'] = 1;
                 $this->_sections['drug_two']['iteration'] <= $this->_sections['drug_two']['total'];
                 $this->_sections['drug_two']['index'] += $this->_sections['drug_two']['step'], $this->_sections['drug_two']['iteration']++):
$this->_sections['drug_two']['rownum'] = $this->_sections['drug_two']['iteration'];
$this->_sections['drug_two']['index_prev'] = $this->_sections['drug_two']['index'] - $this->_sections['drug_two']['step'];
$this->_sections['drug_two']['index_next'] = $this->_sections['drug_two']['index'] + $this->_sections['drug_two']['step'];
$this->_sections['drug_two']['first']      = ($this->_sections['drug_two']['iteration'] == 1);
$this->_sections['drug_two']['last']       = ($this->_sections['drug_two']['iteration'] == $this->_sections['drug_two']['total']);
?>
      <td colspan="2"><input type="text" name="drug_name[]" class="inputnone1" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['drug_two']['index']]['drug'][$this->_sections['drug_show']['index']]['drug_name']; ?>
"></td>
   	  <?php endfor; endif; ?>
	</tr>
   	<tr>
   	  <td align="center">用法用量</td>
	  <?php unset($this->_sections['drug_frequency']);
$this->_sections['drug_frequency']['name'] = 'drug_frequency';
$this->_sections['drug_frequency']['loop'] = is_array($_loop=$this->_tpl_vars['hypertension_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['drug_frequency']['show'] = true;
$this->_sections['drug_frequency']['max'] = $this->_sections['drug_frequency']['loop'];
$this->_sections['drug_frequency']['step'] = 1;
$this->_sections['drug_frequency']['start'] = $this->_sections['drug_frequency']['step'] > 0 ? 0 : $this->_sections['drug_frequency']['loop']-1;
if ($this->_sections['drug_frequency']['show']) {
    $this->_sections['drug_frequency']['total'] = $this->_sections['drug_frequency']['loop'];
    if ($this->_sections['drug_frequency']['total'] == 0)
        $this->_sections['drug_frequency']['show'] = false;
} else
    $this->_sections['drug_frequency']['total'] = 0;
if ($this->_sections['drug_frequency']['show']):

            for ($this->_sections['drug_frequency']['index'] = $this->_sections['drug_frequency']['start'], $this->_sections['drug_frequency']['iteration'] = 1;
                 $this->_sections['drug_frequency']['iteration'] <= $this->_sections['drug_frequency']['total'];
                 $this->_sections['drug_frequency']['index'] += $this->_sections['drug_frequency']['step'], $this->_sections['drug_frequency']['iteration']++):
$this->_sections['drug_frequency']['rownum'] = $this->_sections['drug_frequency']['iteration'];
$this->_sections['drug_frequency']['index_prev'] = $this->_sections['drug_frequency']['index'] - $this->_sections['drug_frequency']['step'];
$this->_sections['drug_frequency']['index_next'] = $this->_sections['drug_frequency']['index'] + $this->_sections['drug_frequency']['step'];
$this->_sections['drug_frequency']['first']      = ($this->_sections['drug_frequency']['iteration'] == 1);
$this->_sections['drug_frequency']['last']       = ($this->_sections['drug_frequency']['iteration'] == $this->_sections['drug_frequency']['total']);
?>
       <td>每日<input type="text" name="drug_frequency[]" class="inputs" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['drug_frequency']['index']]['drug'][$this->_sections['drug_show']['index']]['drug_frequency']; ?>
">次</td>
   	  <td>每次<input type="text" name="drug_amount[]" class="inputs" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['drug_frequency']['index']]['drug'][$this->_sections['drug_show']['index']]['drug_amount']; ?>
">mg</td>
   	  <?php endfor; endif; ?>
	</tr>
	<?php elseif ($this->_sections['drug']['rownum'] == 4): ?>
	<?php elseif ($this->_sections['drug_show']['rownum'] == 4): ?>
   	<tr>
      <td align="center">其他药物</td>
	  <?php unset($this->_sections['drug_amount']);
$this->_sections['drug_amount']['name'] = 'drug_amount';
$this->_sections['drug_amount']['loop'] = is_array($_loop=$this->_tpl_vars['hypertension_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['drug_amount']['show'] = true;
$this->_sections['drug_amount']['max'] = $this->_sections['drug_amount']['loop'];
$this->_sections['drug_amount']['step'] = 1;
$this->_sections['drug_amount']['start'] = $this->_sections['drug_amount']['step'] > 0 ? 0 : $this->_sections['drug_amount']['loop']-1;
if ($this->_sections['drug_amount']['show']) {
    $this->_sections['drug_amount']['total'] = $this->_sections['drug_amount']['loop'];
    if ($this->_sections['drug_amount']['total'] == 0)
        $this->_sections['drug_amount']['show'] = false;
} else
    $this->_sections['drug_amount']['total'] = 0;
if ($this->_sections['drug_amount']['show']):

            for ($this->_sections['drug_amount']['index'] = $this->_sections['drug_amount']['start'], $this->_sections['drug_amount']['iteration'] = 1;
                 $this->_sections['drug_amount']['iteration'] <= $this->_sections['drug_amount']['total'];
                 $this->_sections['drug_amount']['index'] += $this->_sections['drug_amount']['step'], $this->_sections['drug_amount']['iteration']++):
$this->_sections['drug_amount']['rownum'] = $this->_sections['drug_amount']['iteration'];
$this->_sections['drug_amount']['index_prev'] = $this->_sections['drug_amount']['index'] - $this->_sections['drug_amount']['step'];
$this->_sections['drug_amount']['index_next'] = $this->_sections['drug_amount']['index'] + $this->_sections['drug_amount']['step'];
$this->_sections['drug_amount']['first']      = ($this->_sections['drug_amount']['iteration'] == 1);
$this->_sections['drug_amount']['last']       = ($this->_sections['drug_amount']['iteration'] == $this->_sections['drug_amount']['total']);
?>
      <td colspan="2"><input type="text" name="drug_name[]" class="inputnone1" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['drug_amount']['index']]['drug'][$this->_sections['drug_show']['index']]['drug_name']; ?>
"></td>
   	  <?php endfor; endif; ?>
	</tr>
   	<tr>
   	  <td align="center">用法用量</td>
	  <?php unset($this->_sections['drug_other']);
$this->_sections['drug_other']['name'] = 'drug_other';
$this->_sections['drug_other']['loop'] = is_array($_loop=$this->_tpl_vars['hypertension_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['drug_other']['show'] = true;
$this->_sections['drug_other']['max'] = $this->_sections['drug_other']['loop'];
$this->_sections['drug_other']['step'] = 1;
$this->_sections['drug_other']['start'] = $this->_sections['drug_other']['step'] > 0 ? 0 : $this->_sections['drug_other']['loop']-1;
if ($this->_sections['drug_other']['show']) {
    $this->_sections['drug_other']['total'] = $this->_sections['drug_other']['loop'];
    if ($this->_sections['drug_other']['total'] == 0)
        $this->_sections['drug_other']['show'] = false;
} else
    $this->_sections['drug_other']['total'] = 0;
if ($this->_sections['drug_other']['show']):

            for ($this->_sections['drug_other']['index'] = $this->_sections['drug_other']['start'], $this->_sections['drug_other']['iteration'] = 1;
                 $this->_sections['drug_other']['iteration'] <= $this->_sections['drug_other']['total'];
                 $this->_sections['drug_other']['index'] += $this->_sections['drug_other']['step'], $this->_sections['drug_other']['iteration']++):
$this->_sections['drug_other']['rownum'] = $this->_sections['drug_other']['iteration'];
$this->_sections['drug_other']['index_prev'] = $this->_sections['drug_other']['index'] - $this->_sections['drug_other']['step'];
$this->_sections['drug_other']['index_next'] = $this->_sections['drug_other']['index'] + $this->_sections['drug_other']['step'];
$this->_sections['drug_other']['first']      = ($this->_sections['drug_other']['iteration'] == 1);
$this->_sections['drug_other']['last']       = ($this->_sections['drug_other']['iteration'] == $this->_sections['drug_other']['total']);
?>
       <td>每日<input type="text" name="drug_frequency[]" class="inputs" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['drug_other']['index']]['drug'][$this->_sections['drug_show']['index']]['drug_frequency']; ?>
">次</td>
   	  <td>每次<input type="text" name="drug_amount[]" class="inputs" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['drug_other']['index']]['drug'][$this->_sections['drug_show']['index']]['drug_amount']; ?>
">mg</td>
   	  <?php endfor; endif; ?>
	</tr>
	<?php endif; ?>
	<?php endif; ?>
	<?php endfor; endif; ?>
	<?php endfor; endif; ?>
   	<tr>
   	  <td rowspan="2" align="center">转诊</td>
      <td align="center">原因</td>
	  <?php unset($this->_sections['referral_reason']);
$this->_sections['referral_reason']['name'] = 'referral_reason';
$this->_sections['referral_reason']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['referral_reason']['show'] = true;
$this->_sections['referral_reason']['max'] = $this->_sections['referral_reason']['loop'];
$this->_sections['referral_reason']['step'] = 1;
$this->_sections['referral_reason']['start'] = $this->_sections['referral_reason']['step'] > 0 ? 0 : $this->_sections['referral_reason']['loop']-1;
if ($this->_sections['referral_reason']['show']) {
    $this->_sections['referral_reason']['total'] = $this->_sections['referral_reason']['loop'];
    if ($this->_sections['referral_reason']['total'] == 0)
        $this->_sections['referral_reason']['show'] = false;
} else
    $this->_sections['referral_reason']['total'] = 0;
if ($this->_sections['referral_reason']['show']):

            for ($this->_sections['referral_reason']['index'] = $this->_sections['referral_reason']['start'], $this->_sections['referral_reason']['iteration'] = 1;
                 $this->_sections['referral_reason']['iteration'] <= $this->_sections['referral_reason']['total'];
                 $this->_sections['referral_reason']['index'] += $this->_sections['referral_reason']['step'], $this->_sections['referral_reason']['iteration']++):
$this->_sections['referral_reason']['rownum'] = $this->_sections['referral_reason']['iteration'];
$this->_sections['referral_reason']['index_prev'] = $this->_sections['referral_reason']['index'] - $this->_sections['referral_reason']['step'];
$this->_sections['referral_reason']['index_next'] = $this->_sections['referral_reason']['index'] + $this->_sections['referral_reason']['step'];
$this->_sections['referral_reason']['first']      = ($this->_sections['referral_reason']['iteration'] == 1);
$this->_sections['referral_reason']['last']       = ($this->_sections['referral_reason']['iteration'] == $this->_sections['referral_reason']['total']);
?>
      <td colspan="2"><input type="text" name="referral_reason" class="inputnone1" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['referral_reason']['index']]['referral_reason']; ?>
"></td>
	  <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">机构及科别</td>
	  <?php unset($this->_sections['organization']);
$this->_sections['organization']['name'] = 'organization';
$this->_sections['organization']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['organization']['show'] = true;
$this->_sections['organization']['max'] = $this->_sections['organization']['loop'];
$this->_sections['organization']['step'] = 1;
$this->_sections['organization']['start'] = $this->_sections['organization']['step'] > 0 ? 0 : $this->_sections['organization']['loop']-1;
if ($this->_sections['organization']['show']) {
    $this->_sections['organization']['total'] = $this->_sections['organization']['loop'];
    if ($this->_sections['organization']['total'] == 0)
        $this->_sections['organization']['show'] = false;
} else
    $this->_sections['organization']['total'] = 0;
if ($this->_sections['organization']['show']):

            for ($this->_sections['organization']['index'] = $this->_sections['organization']['start'], $this->_sections['organization']['iteration'] = 1;
                 $this->_sections['organization']['iteration'] <= $this->_sections['organization']['total'];
                 $this->_sections['organization']['index'] += $this->_sections['organization']['step'], $this->_sections['organization']['iteration']++):
$this->_sections['organization']['rownum'] = $this->_sections['organization']['iteration'];
$this->_sections['organization']['index_prev'] = $this->_sections['organization']['index'] - $this->_sections['organization']['step'];
$this->_sections['organization']['index_next'] = $this->_sections['organization']['index'] + $this->_sections['organization']['step'];
$this->_sections['organization']['first']      = ($this->_sections['organization']['iteration'] == 1);
$this->_sections['organization']['last']       = ($this->_sections['organization']['iteration'] == $this->_sections['organization']['total']);
?>
   	  <td colspan="2"><input type="text" name="organization" class="inputnone1" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['organization']['index']]['organization']; ?>
"></td>
	  <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">下次随访日期</td>
	  <?php unset($this->_sections['follow_next_time']);
$this->_sections['follow_next_time']['name'] = 'follow_next_time';
$this->_sections['follow_next_time']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['follow_next_time']['show'] = true;
$this->_sections['follow_next_time']['max'] = $this->_sections['follow_next_time']['loop'];
$this->_sections['follow_next_time']['step'] = 1;
$this->_sections['follow_next_time']['start'] = $this->_sections['follow_next_time']['step'] > 0 ? 0 : $this->_sections['follow_next_time']['loop']-1;
if ($this->_sections['follow_next_time']['show']) {
    $this->_sections['follow_next_time']['total'] = $this->_sections['follow_next_time']['loop'];
    if ($this->_sections['follow_next_time']['total'] == 0)
        $this->_sections['follow_next_time']['show'] = false;
} else
    $this->_sections['follow_next_time']['total'] = 0;
if ($this->_sections['follow_next_time']['show']):

            for ($this->_sections['follow_next_time']['index'] = $this->_sections['follow_next_time']['start'], $this->_sections['follow_next_time']['iteration'] = 1;
                 $this->_sections['follow_next_time']['iteration'] <= $this->_sections['follow_next_time']['total'];
                 $this->_sections['follow_next_time']['index'] += $this->_sections['follow_next_time']['step'], $this->_sections['follow_next_time']['iteration']++):
$this->_sections['follow_next_time']['rownum'] = $this->_sections['follow_next_time']['iteration'];
$this->_sections['follow_next_time']['index_prev'] = $this->_sections['follow_next_time']['index'] - $this->_sections['follow_next_time']['step'];
$this->_sections['follow_next_time']['index_next'] = $this->_sections['follow_next_time']['index'] + $this->_sections['follow_next_time']['step'];
$this->_sections['follow_next_time']['first']      = ($this->_sections['follow_next_time']['iteration'] == 1);
$this->_sections['follow_next_time']['last']       = ($this->_sections['follow_next_time']['iteration'] == $this->_sections['follow_next_time']['total']);
?>
      <td colspan="2"><input type="text" name="follow_next_time" class="inputnone1" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['follow_next_time']['index']]['follow_next_time']; ?>
"></td>
	  <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">随访结果</td>
	  <?php unset($this->_sections['follow_result']);
$this->_sections['follow_result']['name'] = 'follow_result';
$this->_sections['follow_result']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['follow_result']['show'] = true;
$this->_sections['follow_result']['max'] = $this->_sections['follow_result']['loop'];
$this->_sections['follow_result']['step'] = 1;
$this->_sections['follow_result']['start'] = $this->_sections['follow_result']['step'] > 0 ? 0 : $this->_sections['follow_result']['loop']-1;
if ($this->_sections['follow_result']['show']) {
    $this->_sections['follow_result']['total'] = $this->_sections['follow_result']['loop'];
    if ($this->_sections['follow_result']['total'] == 0)
        $this->_sections['follow_result']['show'] = false;
} else
    $this->_sections['follow_result']['total'] = 0;
if ($this->_sections['follow_result']['show']):

            for ($this->_sections['follow_result']['index'] = $this->_sections['follow_result']['start'], $this->_sections['follow_result']['iteration'] = 1;
                 $this->_sections['follow_result']['iteration'] <= $this->_sections['follow_result']['total'];
                 $this->_sections['follow_result']['index'] += $this->_sections['follow_result']['step'], $this->_sections['follow_result']['iteration']++):
$this->_sections['follow_result']['rownum'] = $this->_sections['follow_result']['iteration'];
$this->_sections['follow_result']['index_prev'] = $this->_sections['follow_result']['index'] - $this->_sections['follow_result']['step'];
$this->_sections['follow_result']['index_next'] = $this->_sections['follow_result']['index'] + $this->_sections['follow_result']['step'];
$this->_sections['follow_result']['first']      = ($this->_sections['follow_result']['iteration'] == 1);
$this->_sections['follow_result']['last']       = ($this->_sections['follow_result']['iteration'] == $this->_sections['follow_result']['total']);
?>
      <td colspan="2"><?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['follow_result']['index']]['follow_result']; ?>
</td>
      <?php endfor; endif; ?>
   	</tr>
    <tr>
   	  <td colspan="2" align="center">随访医生签名</td>
	  <?php unset($this->_sections['staff_id']);
$this->_sections['staff_id']['name'] = 'staff_id';
$this->_sections['staff_id']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['staff_id']['show'] = true;
$this->_sections['staff_id']['max'] = $this->_sections['staff_id']['loop'];
$this->_sections['staff_id']['step'] = 1;
$this->_sections['staff_id']['start'] = $this->_sections['staff_id']['step'] > 0 ? 0 : $this->_sections['staff_id']['loop']-1;
if ($this->_sections['staff_id']['show']) {
    $this->_sections['staff_id']['total'] = $this->_sections['staff_id']['loop'];
    if ($this->_sections['staff_id']['total'] == 0)
        $this->_sections['staff_id']['show'] = false;
} else
    $this->_sections['staff_id']['total'] = 0;
if ($this->_sections['staff_id']['show']):

            for ($this->_sections['staff_id']['index'] = $this->_sections['staff_id']['start'], $this->_sections['staff_id']['iteration'] = 1;
                 $this->_sections['staff_id']['iteration'] <= $this->_sections['staff_id']['total'];
                 $this->_sections['staff_id']['index'] += $this->_sections['staff_id']['step'], $this->_sections['staff_id']['iteration']++):
$this->_sections['staff_id']['rownum'] = $this->_sections['staff_id']['iteration'];
$this->_sections['staff_id']['index_prev'] = $this->_sections['staff_id']['index'] - $this->_sections['staff_id']['step'];
$this->_sections['staff_id']['index_next'] = $this->_sections['staff_id']['index'] + $this->_sections['staff_id']['step'];
$this->_sections['staff_id']['first']      = ($this->_sections['staff_id']['iteration'] == 1);
$this->_sections['staff_id']['last']       = ($this->_sections['staff_id']['iteration'] == $this->_sections['staff_id']['total']);
?>
      <td colspan="2"><?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['staff_id']['index']]['staff_name']; ?>
</td>
      <?php endfor; endif; ?>
   	</tr>
	<tr>
	<td colspan="2" align="center">操作选项</td>
	  <?php unset($this->_sections['do']);
$this->_sections['do']['name'] = 'do';
$this->_sections['do']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['do']['show'] = true;
$this->_sections['do']['max'] = $this->_sections['do']['loop'];
$this->_sections['do']['step'] = 1;
$this->_sections['do']['start'] = $this->_sections['do']['step'] > 0 ? 0 : $this->_sections['do']['loop']-1;
if ($this->_sections['do']['show']) {
    $this->_sections['do']['total'] = $this->_sections['do']['loop'];
    if ($this->_sections['do']['total'] == 0)
        $this->_sections['do']['show'] = false;
} else
    $this->_sections['do']['total'] = 0;
if ($this->_sections['do']['show']):

            for ($this->_sections['do']['index'] = $this->_sections['do']['start'], $this->_sections['do']['iteration'] = 1;
                 $this->_sections['do']['iteration'] <= $this->_sections['do']['total'];
                 $this->_sections['do']['index'] += $this->_sections['do']['step'], $this->_sections['do']['iteration']++):
$this->_sections['do']['rownum'] = $this->_sections['do']['iteration'];
$this->_sections['do']['index_prev'] = $this->_sections['do']['index'] - $this->_sections['do']['step'];
$this->_sections['do']['index_next'] = $this->_sections['do']['index'] + $this->_sections['do']['step'];
$this->_sections['do']['first']      = ($this->_sections['do']['iteration'] == 1);
$this->_sections['do']['last']       = ($this->_sections['do']['iteration'] == $this->_sections['do']['total']);
?>
      <td colspan="2"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/edit/uuid/<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['do']['index']]['uuid']; ?>
">编辑</a>&nbsp;|&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/delete/uuid/<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['do']['index']]['uuid']; ?>
">删除</a>&nbsp;|&nbsp;
      <a href="#" onclick="window.open('<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/print/uuid/<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['do']['index']]['uuid']; ?>
')">打印</a></td>
      <?php endfor; endif; ?>
	</tr>
   </table>
   <div class="STYLE1" style="background:#FFFFFF; text-align:center; width:100%;font-size: 16px;">
            <input type="button" name="return" id="return" value="返回列表" class="inputbutton" onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/index';" />
   </div>
</body>
</html>