<?php /* Smarty version 2.6.14, created on 2013-06-24 15:29:11
         compiled from diabetes_table.html */ ?>
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
views/js/calendar/WdiabetesPicker.js" type="text/javascript"></script> 
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/popup.js" type="text/javascript"></script>
<title>慢病检查</title>
<style type="text/css">
<!--
input {
border:1px solid blue;
}
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
.time {
border-left:0 none;
border-right:0 none;
border-top:0 none;
width:30px;
}
.other{ width:190px;}
-->
</style>
<script type="text/javascript">
//$(document).ready(function(){
//	$("input").attr("disabled","disabled");
//	$("textarea").attr("disabled","disabled");
//	$("input").css("background","white");
//});
</script>
</head>
<body >
   <input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
">
   <div class="STYLE1" style="background:#FFFFFF; text-align:center; width:100%;font-size: 16px;
	font-weight: bold; height:32px;">[ <?php echo $this->_tpl_vars['user_name']; ?>
 ] 2型糖尿病患者随访服务记录一览表(共<?php echo $this->_tpl_vars['nums']; ?>
次)<img title="“本表为2型糖尿病患者在接受随访服务时由医生填写。每年的综合评估填写居民健康档案的健康体检表。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></div>
   <div  style=" text-align:center; width:100%; "><input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
      <div  style=" width:30%; text-align:left; float:left;background:#FFFFFF;"><span class="STYLE2">姓名</span>：<?php echo $this->_tpl_vars['user_name']; ?>
</div>
       <div  style=" width:39.9%; text-align:left; float:left;background:#FFFFFF;"><span class="STYLE2">身份证号</span>：<?php echo $this->_tpl_vars['identity_number']; ?>
</div>
	  <div style=" width:30%; text-align:left; float:left;background:#FFFFFF; "><span class="STYLE2">编号</span>：<?php echo $this->_tpl_vars['standard_code']; ?>
</div>
   </div>
<table width="100%" height="1243"  align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
   	<tr>
		<td height="23" colspan="2">随访日期</td>
		<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
	    <td colspan="2">
		<?php echo $this->_tpl_vars['diabetes_array'][$this->_sections['diabetes']['index']]['followup_time']; ?>

		</td>
		<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td height="28" colspan="2">随访方式</td>
		<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2">
	  <?php $_from = $this->_tpl_vars['type_of_followup']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['foll']):
?>
	  <?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['foll'][1]; ?>

	  <?php endforeach; endif; unset($_from); ?>
	  <input type="text" name="type_of_followup" value="<?php echo $this->_tpl_vars['diabetes_array'][$this->_sections['diabetes']['index']]['type_of_followup']; ?>
" class="inputnew" /></td>
		<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td width="66" rowspan="2" align="center"><p>症</p>
      <p>状</p></td>
      <td width="160" rowspan="2">
	  	<?php $_from = $this->_tpl_vars['diabetes_symptom']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['sym']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['sym'][1]; ?>
<br />
	  <?php endforeach; endif; unset($_from); ?>	  </td>
		
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td height="30" colspan="2" align="left">
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
			<input type="text" class="inputnew" name="symptom[]" value="<?php echo $this->_tpl_vars['diabetes_symptom_array'][$this->_sections['diabetes']['index']][$this->_sections['inp']['index']]['sym']; ?>
" />/
		<?php endfor; endif; ?>
	  </td>
	<?php endfor; endif; ?>
   	</tr>
   	<tr>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
   	  <td colspan="2" valign="top">
	  	<div>
			<div class="other_sym">其他：</div>
			<div class="other_txtsym">
				<textarea class="newtextarea" rows="6" cols="16"><?php echo $this->_tpl_vars['symptom_other_array'][$this->_sections['diabetes']['index']]['sym_other']; ?>
</textarea>
			</div>
		</div>	  </td>
	<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td rowspan="6" align="center"><p>体</p>
      <p>征</p><img title="“体质指数=体重（kg）/身高的平方（m2）。如有其他阳性体征，请填写在“其他”一栏。体重斜线前填写目前情况，斜线后下填写下次随访时应调整到的目标。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td align="center">血压(mmHg)</td>
 	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
     <td colspan="2"><input type="text" value="<?php echo $this->_tpl_vars['physical_sign_array'][$this->_sections['diabetes']['index']]['blood_pressure']; ?>
" class="inputnone1"  style="width:60px;">|&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="<?php echo $this->_tpl_vars['physical_sign_array'][$this->_sections['diabetes']['index']]['diastolic_blood_pressure']; ?>
" class="inputnone1" style="width:60px;">(单位:mmHg)</td>
	<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">身高(cm)</td>
  	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
     <td colspan="2">
		  <input type="text" value="<?php echo $this->_tpl_vars['physical_sign_array'][$this->_sections['diabetes']['index']]['height']; ?>
" class="inputnone">/
		  <input type="text" value="<?php echo $this->_tpl_vars['physical_sign_array'][$this->_sections['diabetes']['index']]['height_next']; ?>
" class="inputnone">身高(cm)</td>
	<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">体重(kg)</td>
  	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
     <td colspan="2">
		  <input type="text" value="<?php echo $this->_tpl_vars['physical_sign_array'][$this->_sections['diabetes']['index']]['weight']; ?>
" class="inputnone">/
		  <input type="text" value="<?php echo $this->_tpl_vars['physical_sign_array'][$this->_sections['diabetes']['index']]['expectative_weight']; ?>
" class="inputnone">体重(kg)</td>
	<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">体质指数</td>
  	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2"><input type="text" value="<?php echo $this->_tpl_vars['physical_sign_array'][$this->_sections['diabetes']['index']]['bmi']; ?>
" class="inputnone1"></td>
 	<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">足背动脉搏动</td>
  	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2">
	  		<?php $_from = $this->_tpl_vars['arteria_dorsalis_pedis']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['adp']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['adp'][1]; ?>

			<?php endforeach; endif; unset($_from); ?>
		  <input type="text" value="<?php echo $this->_tpl_vars['physical_sign_array'][$this->_sections['diabetes']['index']]['arteria_dorsalis_pedis']; ?>
" class="inputnew"></td>
 	<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">其他</td>
   	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
     <td colspan="2"><input type="text" value="<?php echo $this->_tpl_vars['physical_sign_array'][$this->_sections['diabetes']['index']]['other']; ?>
" class="inputnone1"></td>
  	<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td rowspan="7" align="center"><p>生</p>
      <p>活</p>
      <p>方</p>
      <p>式</p>
      <p>指</p>
      <p>导</p><img title="“询问患者生活方式的同时对患者进行生活方式指导，与患者共同制定下次随访目标。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td align="center">日吸烟量(支)<img title="“斜线前填写目前吸烟量，不吸烟填“0”，吸烟者写出每天的吸烟量“××支”，斜线后填写吸烟者下次随访目标吸烟量“××支”。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
   	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2">
		  <input type="text" value="<?php echo $this->_tpl_vars['lifestyle_guide_array'][$this->_sections['diabetes']['index']]['smoking']; ?>
" class="inputnone">/
		  <input type="text" value="<?php echo $this->_tpl_vars['lifestyle_guide_array'][$this->_sections['diabetes']['index']]['expert_smoking']; ?>
" class="inputnone"></td>
  	<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">日饮酒量(两)<img title="“斜线前填写目前饮酒量，不饮酒填“0”，饮酒者写出每天的饮酒量相当于白酒“××两”，斜线后填写饮酒者下次随访目标饮酒量相当于白酒“××两”。白酒1两相当于葡萄酒4两，黄酒半斤，啤酒1瓶，果酒4两。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
   	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2">
		  <input type="text" value="<?php echo $this->_tpl_vars['lifestyle_guide_array'][$this->_sections['diabetes']['index']]['drinking']; ?>
" class="inputnone">/
		  <input type="text" value="<?php echo $this->_tpl_vars['lifestyle_guide_array'][$this->_sections['diabetes']['index']]['expert_drinking']; ?>
" class="inputnone"></td>
   	<?php endfor; endif; ?>

   	</tr>
   	<tr>
   	  <td rowspan="2" align="center">运动<img title="“填写每周几次，每次多少分钟。即“××次／周，××分钟／次”。横线上填写目前情况，横线下填写下次随访时应达到的目标。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
    	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
     <td colspan="2" align="center">
	  	<input type="text" value="<?php echo $this->_tpl_vars['lifestyle_guide_array'][$this->_sections['diabetes']['index']]['frequency']; ?>
" class="inputnone">次/周
	  <input type="text" value="<?php echo $this->_tpl_vars['lifestyle_guide_array'][$this->_sections['diabetes']['index']]['frequency_time']; ?>
" class="inputnone">分钟/次	  </td>
   	<?php endfor; endif; ?>
   	</tr>
   	<tr>
    	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2" align="center">
	  	<input type="text" value="<?php echo $this->_tpl_vars['lifestyle_guide_array'][$this->_sections['diabetes']['index']]['expert_frequency']; ?>
" class="inputnone">次/周
	  <input type="text" value="<?php echo $this->_tpl_vars['lifestyle_guide_array'][$this->_sections['diabetes']['index']]['expert_frequency_time']; ?>
" class="inputnone">分钟/次	  </td>
   	<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center"><p>主食</p>
      <p>(克/天)</p><img title="“根据患者的实际情况估算主食（米饭、面食、饼干等淀粉类食物）的摄入量。为每天各餐的合计量。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2">
		  <input type="text" value="<?php echo $this->_tpl_vars['lifestyle_guide_array'][$this->_sections['diabetes']['index']]['main_course']; ?>
" class="inputnone">/
		  <input type="text" value="<?php echo $this->_tpl_vars['lifestyle_guide_array'][$this->_sections['diabetes']['index']]['expert_main_course']; ?>
" class="inputnone"></td>
   	<?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">心理调整<img title="“根据医生印象选择对应的选项。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['heart_adjustment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['heart']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['heart'][1]; ?>

		<?php endforeach; endif; unset($_from); ?>
		<input type="text" class="inputnew" name="" value="<?php echo $this->_tpl_vars['lifestyle_guide_array'][$this->_sections['diabetes']['index']]['heart_adjustment']; ?>
" />	  </td>
   	<?php endfor; endif; ?>

   	</tr>
   	<tr>
   	  <td align="center">遵医行为<img title="“指患者是否遵照医生的指导去改善生活方式。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['complian']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['cp']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['cp'][1]; ?>

		<?php endforeach; endif; unset($_from); ?>
		<input type="text" class="inputnew" name="" value="<?php echo $this->_tpl_vars['lifestyle_guide_array'][$this->_sections['diabetes']['index']]['complian']; ?>
" />	  </td>
   	<?php endfor; endif; ?>

   	</tr>
   	</tr>
   	<tr>
   	  <td rowspan="2" align="center"><p>辅</p>
      <p>助</p>
      <p>检</p>
      <p>查</p>
      <p>&nbsp;</p><img title="“为患者进行空腹血糖检查，记录检查结果。若患者在上次随访到此次随访之间到各医疗机构进行过糖化血红蛋白或其他辅助检查，应如实记录。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td align="center">空腹血糖值</td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2"><input type="text" value="<?php echo $this->_tpl_vars['accessory_examine_array'][$this->_sections['diabetes']['index']]['fasting_bloodglucose']; ?>
" class="inputbottom">mmol/L</td>
    <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">其他检查*</td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2" valign="top">
		  <p>糖化血红蛋白<input type="text" value="<?php echo $this->_tpl_vars['accessory_examine_array'][$this->_sections['diabetes']['index']]['hbclc']; ?>
" class="inputbottom">%</p>
		  <p>检查日期<input type="text" class="time" value="<?php echo $this->_tpl_vars['accessory_examine_array'][$this->_sections['diabetes']['index']]['eaminat_mot']; ?>
">月
		  <input type="text" class="time" value="<?php echo $this->_tpl_vars['accessory_examine_array'][$this->_sections['diabetes']['index']]['eaminat_day']; ?>
">日</p>	
		  <input type="text" value="<?php echo $this->_tpl_vars['accessory_examine_array'][$this->_sections['diabetes']['index']]['eamination_info']; ?>
" class="inputbottom other">
	  </td>
    <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">服药依从性<img title="““规律”为按医嘱服药，“间断”为未按医嘱服药，频次或数量不足，“不服药”即为医生开了处方，但患者未使用此药。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['compliance']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['comply']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['comply'][1]; ?>

		<?php endforeach; endif; unset($_from); ?>
		<input type="text" class="inputnew" name="" value="<?php echo $this->_tpl_vars['diabetes_array'][$this->_sections['diabetes']['index']]['compliance']; ?>
" />	  </td>
    <?php endfor; endif; ?>

   	</tr>
   	<tr>
   	  <td colspan="2" align="center">药物不良反应<img title="“如果患者服用上述药物有明显的药物不良反应，具体描述哪种药物，何种不良反应。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['adverse_drug_reaction']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['adv']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['adv'][1]; ?>

		<?php endforeach; endif; unset($_from); ?>
		<input type="text" class="inputnew" name="" value="<?php echo $this->_tpl_vars['diabetes_array'][$this->_sections['diabetes']['index']]['adverse_drug_reaction']; ?>
" />	  </td>
    <?php endfor; endif; ?>
   	</tr>
	<tr>
   	 	<td colspan="2" align="center">低血糖反应<img title="“根据上次随访到此次随访之间患者出现的低血糖反应情况。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
		<td colspan="2">
	  	<?php $_from = $this->_tpl_vars['reactive_hypoglycemia']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['rh']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['rh'][1]; ?>

		<?php endforeach; endif; unset($_from); ?>
		<input type="text" value="<?php echo $this->_tpl_vars['diabetes_array'][$this->_sections['diabetes']['index']]['reactive_hypoglycemia']; ?>
" name="" class="inputnew"></td>
    <?php endfor; endif; ?>
	</tr>
   	<tr>
   	  <td colspan="2" align="center">此次随访分类<img title="根据此次随访时的分类结果，由随访医生在4种分类结果中选择一项在“□”中填上相应的数字。“控制满意”意为血糖控制满意，无其他异常、“控制不满意”意为血糖控制不满意，无其他异常、“不良反应”意为存在药物不良反应、“并发症”意为出现新的并发症或并发症出现异常。如果患者并存几种情况，填写最严重的一种情况，同时结合上次随访情况，决定患者下次随访时间，并告知患者。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['followup_classification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['fclass']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['fclass'][1]; ?>

		<?php endforeach; endif; unset($_from); ?>
		<input type="text" class="inputnew" name="" value="<?php echo $this->_tpl_vars['diabetes_array'][$this->_sections['diabetes']['index']]['followup_classification']; ?>
" />	  </td>
    <?php endfor; endif; ?>

   	</tr>
  <!-- 	<tr>
   	    </tr>-->
   <?php unset($this->_sections['custom']);
$this->_sections['custom']['loop'] = is_array($_loop=3) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['custom']['name'] = 'custom';
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
	<tr>
	 <?php if ($this->_sections['custom']['iteration'] == 1): ?>
	  <td rowspan="7" align="center"><p>用</p>
      <p>药</p>
      <p>情</p>
      <p>况</p><img title="根据患者整体情况，为患者开具处方，填写患者即将服用的降糖药物名称，写明用法。胰岛素具体写明胰岛素的种类、时间、剂量。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	  <?php endif; ?>

      <td height="27" align="center">药物名称<?php echo $this->_sections['custom']['iteration']; ?>
</td>
      <?php unset($this->_sections['mydrug']);
$this->_sections['mydrug']['name'] = 'mydrug';
$this->_sections['mydrug']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mydrug']['show'] = true;
$this->_sections['mydrug']['max'] = $this->_sections['mydrug']['loop'];
$this->_sections['mydrug']['step'] = 1;
$this->_sections['mydrug']['start'] = $this->_sections['mydrug']['step'] > 0 ? 0 : $this->_sections['mydrug']['loop']-1;
if ($this->_sections['mydrug']['show']) {
    $this->_sections['mydrug']['total'] = $this->_sections['mydrug']['loop'];
    if ($this->_sections['mydrug']['total'] == 0)
        $this->_sections['mydrug']['show'] = false;
} else
    $this->_sections['mydrug']['total'] = 0;
if ($this->_sections['mydrug']['show']):

            for ($this->_sections['mydrug']['index'] = $this->_sections['mydrug']['start'], $this->_sections['mydrug']['iteration'] = 1;
                 $this->_sections['mydrug']['iteration'] <= $this->_sections['mydrug']['total'];
                 $this->_sections['mydrug']['index'] += $this->_sections['mydrug']['step'], $this->_sections['mydrug']['iteration']++):
$this->_sections['mydrug']['rownum'] = $this->_sections['mydrug']['iteration'];
$this->_sections['mydrug']['index_prev'] = $this->_sections['mydrug']['index'] - $this->_sections['mydrug']['step'];
$this->_sections['mydrug']['index_next'] = $this->_sections['mydrug']['index'] + $this->_sections['mydrug']['step'];
$this->_sections['mydrug']['first']      = ($this->_sections['mydrug']['iteration'] == 1);
$this->_sections['mydrug']['last']       = ($this->_sections['mydrug']['iteration'] == $this->_sections['mydrug']['total']);
?>
      <td colspan="2"><input type="text" name="drug_name[]" class="inputnone1" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['mydrug']['index']]['drug'][$this->_sections['custom']['index']]['drug_name']; ?>
"></td>
      <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td height="26" align="center">用法</td>
   	  <?php unset($this->_sections['mydrug']);
$this->_sections['mydrug']['name'] = 'mydrug';
$this->_sections['mydrug']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mydrug']['show'] = true;
$this->_sections['mydrug']['max'] = $this->_sections['mydrug']['loop'];
$this->_sections['mydrug']['step'] = 1;
$this->_sections['mydrug']['start'] = $this->_sections['mydrug']['step'] > 0 ? 0 : $this->_sections['mydrug']['loop']-1;
if ($this->_sections['mydrug']['show']) {
    $this->_sections['mydrug']['total'] = $this->_sections['mydrug']['loop'];
    if ($this->_sections['mydrug']['total'] == 0)
        $this->_sections['mydrug']['show'] = false;
} else
    $this->_sections['mydrug']['total'] = 0;
if ($this->_sections['mydrug']['show']):

            for ($this->_sections['mydrug']['index'] = $this->_sections['mydrug']['start'], $this->_sections['mydrug']['iteration'] = 1;
                 $this->_sections['mydrug']['iteration'] <= $this->_sections['mydrug']['total'];
                 $this->_sections['mydrug']['index'] += $this->_sections['mydrug']['step'], $this->_sections['mydrug']['iteration']++):
$this->_sections['mydrug']['rownum'] = $this->_sections['mydrug']['iteration'];
$this->_sections['mydrug']['index_prev'] = $this->_sections['mydrug']['index'] - $this->_sections['mydrug']['step'];
$this->_sections['mydrug']['index_next'] = $this->_sections['mydrug']['index'] + $this->_sections['mydrug']['step'];
$this->_sections['mydrug']['first']      = ($this->_sections['mydrug']['iteration'] == 1);
$this->_sections['mydrug']['last']       = ($this->_sections['mydrug']['iteration'] == $this->_sections['mydrug']['total']);
?>
      <td width="387">每日
      <input type="text" name="drug_frequency[]" class="inputs" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['mydrug']['index']]['drug'][$this->_sections['custom']['index']]['drug_frequency']; ?>
">次</td>
   	  <td width="461">每次
      <input type="text" name="drug_amount[]" class="inputs" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['mydrug']['index']]['drug'][$this->_sections['custom']['index']]['drug_amount']; ?>
">mg</td>
      <?php endfor; endif; ?>
   	</tr>
   <?php endfor; endif; ?>
	
   	<tr>
   	  <td align="center">胰岛素</td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2"><textarea cols="16" rows="6" class="newtextarea">
<?php echo $this->_tpl_vars['diabetes_array'][$this->_sections['diabetes']['index']]['insulin']; ?>
</textarea></td>
    <?php endfor; endif; ?>
   	</tr>
   	
   	<tr>
   	  <td rowspan="2" align="center"><p>转</p>
      <p>诊</p><img title="如果转诊要写明转诊的医疗机构及科室类别，如××市人民医院心内科，并在原因一栏写明转诊原因。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td align="center">原因</td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2"><input type="text" class="inputnone1" value="<?php echo $this->_tpl_vars['patient_referral_array'][$this->_sections['diabetes']['index']]['reason']; ?>
"></td>
    <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td align="center">机构及科别</td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
   	  <td colspan="2"><input type="text" class="inputnone1" value="<?php echo $this->_tpl_vars['patient_referral_array'][$this->_sections['diabetes']['index']]['organization']; ?>
"></td>
    <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">下次随访日期</td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2"><input type="text" class="inputnone1" value="<?php echo $this->_tpl_vars['diabetes_array'][$this->_sections['diabetes']['index']]['time_of_next_followup']; ?>
"></td>
    <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">随访医生签名<img title="随访完毕，核查无误后随访医生签署其姓名。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
      <td colspan="2"><input type="text" class="inputnone1" value="<?php echo $this->_tpl_vars['diabetes_array'][$this->_sections['diabetes']['index']]['followup_doctor']; ?>
"></td>
    <?php endfor; endif; ?>
   	</tr>
   	<tr>
   	  <td height="32" colspan="2" align="center">操作</td>
	<?php unset($this->_sections['diabetes']);
$this->_sections['diabetes']['name'] = 'diabetes';
$this->_sections['diabetes']['loop'] = is_array($_loop=$this->_tpl_vars['nums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['diabetes']['show'] = true;
$this->_sections['diabetes']['max'] = $this->_sections['diabetes']['loop'];
$this->_sections['diabetes']['step'] = 1;
$this->_sections['diabetes']['start'] = $this->_sections['diabetes']['step'] > 0 ? 0 : $this->_sections['diabetes']['loop']-1;
if ($this->_sections['diabetes']['show']) {
    $this->_sections['diabetes']['total'] = $this->_sections['diabetes']['loop'];
    if ($this->_sections['diabetes']['total'] == 0)
        $this->_sections['diabetes']['show'] = false;
} else
    $this->_sections['diabetes']['total'] = 0;
if ($this->_sections['diabetes']['show']):

            for ($this->_sections['diabetes']['index'] = $this->_sections['diabetes']['start'], $this->_sections['diabetes']['iteration'] = 1;
                 $this->_sections['diabetes']['iteration'] <= $this->_sections['diabetes']['total'];
                 $this->_sections['diabetes']['index'] += $this->_sections['diabetes']['step'], $this->_sections['diabetes']['iteration']++):
$this->_sections['diabetes']['rownum'] = $this->_sections['diabetes']['iteration'];
$this->_sections['diabetes']['index_prev'] = $this->_sections['diabetes']['index'] - $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['index_next'] = $this->_sections['diabetes']['index'] + $this->_sections['diabetes']['step'];
$this->_sections['diabetes']['first']      = ($this->_sections['diabetes']['iteration'] == 1);
$this->_sections['diabetes']['last']       = ($this->_sections['diabetes']['iteration'] == $this->_sections['diabetes']['total']);
?>
	  <td colspan="2" align="left">
      <a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/add/editid/<?php echo $this->_tpl_vars['diabetes_array'][$this->_sections['diabetes']['index']]['uuid']; ?>
/id/<?php echo $this->_tpl_vars['id']; ?>
">编辑</a> | <a href="<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/delete/uuid/<?php echo $this->_tpl_vars['diabetes_array'][$this->_sections['diabetes']['index']]['uuid']; ?>
" onclick="if(confirm('确定要删除吗')){return true;}else{return false;}">删除</a> |	
       <a href="#" onclick="window.open('<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/print/uuid/<?php echo $this->_tpl_vars['diabetes_array'][$this->_sections['diabetes']['index']]['uuid']; ?>
/id/<?php echo $this->_tpl_vars['id']; ?>
')">打印</a> </td>
    <?php endfor; endif; ?>
   	</tr>
</table>
<div class="STYLE1" style="background:#FFFFFF; text-align:center; width:100%;font-size: 16px;">
   <!--<input type="button" name="print" id="print" value="打印" class="inputbutton" onclick="javascript:window.print();" />-->
   <input type="button" name="return" id="return" class="inputbutton" value="返回列表" onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/list';" />
</div>
</form> 
</body>
</html>