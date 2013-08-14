<?php /* Smarty version 2.6.14, created on 2013-06-24 15:38:36
         compiled from add_diabetes_table.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/tnb.js" type="text/javascript"></script>
<title>糖尿病随访记录</title>
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
var myid = '<?php echo $this->_tpl_vars['currenteditid']; ?>
';
$(document).ready(function(){
	//判断症状
	$("input[name='symptom[]']").each(function(){
		var et=jQuery.parseJSON('<?php echo $this->_tpl_vars['json_symptom']; ?>
');
		$(this).blur(function(){
			$("input[name='symptom[]']").each(function(){
				var val = $(this).val();
				if(val != '' && typeof(et[val]) == 'undefined'){
					$(this).val('');
					return false;
				}
			})
		})
	});
	
	if(myid==''){
	   get_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/result",<?php echo $this->_tpl_vars['is_diabetes']; ?>
,'<?php echo $this->_tpl_vars['date_time']; ?>
');
	}
	 //$('textarea[id="resultnow"]').html('您的血糖控制很好,1年后进行随访');
	 $("input[name='symptom[]']").blur(function(){
	 	get_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/result",<?php echo $this->_tpl_vars['is_diabetes']; ?>
,'<?php echo $this->_tpl_vars['date_time']; ?>
');
	 });
	 $("input[name='blood_pressure']").blur(function(){get_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/result",<?php echo $this->_tpl_vars['is_diabetes']; ?>
,'<?php echo $this->_tpl_vars['date_time']; ?>
');
	 });
	 $("input[name='diastolic_blood_pressure']").blur(function(){get_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/result",<?php echo $this->_tpl_vars['is_diabetes']; ?>
,'<?php echo $this->_tpl_vars['date_time']; ?>
');});
	 $("input[name='fasting_bloodglucose']").blur(function(){get_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/result",<?php echo $this->_tpl_vars['is_diabetes']; ?>
,'<?php echo $this->_tpl_vars['date_time']; ?>
');});
	 $(".adv").click(function(){get_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/result",<?php echo $this->_tpl_vars['is_diabetes']; ?>
,'<?php echo $this->_tpl_vars['date_time']; ?>
');});
	 $(".classification").click(function(){get_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/result",<?php echo $this->_tpl_vars['is_diabetes']; ?>
,'<?php echo $this->_tpl_vars['date_time']; ?>
');});
});
function set_lung_val(val,obj){
	var et_lung_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['json_lung']; ?>
');
	$('input[name='+ obj +']').val(val);
}

</script>
</head>
<body >
<form name="frm" action="<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/add" method="post" >
   <input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
   <input type="hidden" name="editid" value="<?php echo $this->_tpl_vars['currenteditid']; ?>
"/>
   <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
"/>
   <div class="STYLE1" style="background:#FFFFFF; text-align:center; width:100%;font-size: 16px;font-weight: bold; height:32px;">[ <?php echo $this->_tpl_vars['currentname']; ?>
 ] <?php echo $this->_tpl_vars['title']; ?>
Ⅱ型糖尿病患者随访服务记录<img title="“本表为Ⅱ型糖尿病患者在接受随访服务时由医生填写。每年的综合评估填写居民健康档案的健康体检表。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></div>
   <div  style=" text-align:center; width:100%;">
      <div  style=" width:30%; text-align:left; float:left;background:#FFFFFF;"><span class="STYLE2">姓名</span>：<?php echo $this->_tpl_vars['currentname']; ?>
</div>
      <div  style=" width:39.9%;  float:left;background:#FFFFFF;"><span class="STYLE2">身份证号</span>：<?php echo $this->_tpl_vars['identity_number']; ?>
</div>
	  <div style=" width:30%; text-align:right; float:left;background:#FFFFFF; "><span class="STYLE2">编号</span>：<?php echo $this->_tpl_vars['standard_code']; ?>
</div>
   </div>
<table width="100%"  align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
   	<tr>
		<td height="28" colspan="2">随访日期</td>
	    <td colspan="2">
	<input type="text"  onclick="WdatePicker({firstDayOfWeek:1})" class="inputnone1" name="ftime" id="ftime" value="<?php if ($this->_tpl_vars['tag'] !== ''):  echo $this->_tpl_vars['followuptime'];  else:  echo $this->_tpl_vars['default_sftime'];  endif; ?>">   	</tr>
   	<tr>
   	  <td height="28" colspan="2">随访方式</td>
      <td colspan="2">
	  <?php $_from = $this->_tpl_vars['type_of_followup']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['foll']):
?>
	  <label onclick="set_lung_val('<?php echo $this->_tpl_vars['k']; ?>
','type_of_followup')">
	  <?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['foll'][1]; ?>

	  </label>
	  <?php endforeach; endif; unset($_from); ?>
	  <input type="text" value="<?php echo $this->_tpl_vars['typefollowup']; ?>
" name="type_of_followup" id="type_of_followup" class="inputnew" /></td>
   	</tr>
   	<tr>
   	  <td width="64" rowspan="2" align="center"><p>症</p>
      <p>状</p></td>
      <td width="180" rowspan="2">
	  	<?php $_from = $this->_tpl_vars['diabetes_symptom']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['sym']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['sym'][1]; ?>
 <span id="sym_<?php echo $this->_tpl_vars['k']; ?>
"></span><br />
	  <?php endforeach; endif; unset($_from); ?>      </td>
		
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
			<input type="text" class="inputnew" name="symptom[]" id="symptom_<?php echo $this->_sections['inp']['iteration']; ?>
" value="<?php echo $this->_tpl_vars['symptomarr'][$this->_sections['inp']['index']]; ?>
"/>/
		<?php endfor; endif; ?>
		<span id="message_now"></span>	  </td>
   	</tr>
   	<tr>
   	  <td colspan="2" valign="top">
	  	<div>
			<div class="other_sym">其他：</div>
			<div class="other_txtsym">
				<textarea name="symptom_other" class="newtextarea" rows="6" cols="30"><?php echo $this->_tpl_vars['symother']; ?>
</textarea>
			</div>
		</div>	  </td>
   	</tr>
   	<tr>
   	  <td rowspan="6" align="center"><p>体</p>
      <p>征</p><img title="“体质指数=体重（kg）/身高的平方（m2）。如有其他阳性体征，请填写在“其他”一栏。体重斜线前填写目前情况，斜线后下填写下次随访时应调整到的目标。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td height="29" align="center">血压(mmHg)</td>
     <td colspan="2">
                 <input type="text" name="blood_pressure" value="<?php echo $this->_tpl_vars['bloodpress']; ?>
" class="inputnone" id="blood_pressure" style=" width:50px;"  style="ime-mode: disabled;"  />|
                 <input type="text" name="diastolic_blood_pressure" value="<?php echo $this->_tpl_vars['diabloodpress']; ?>
" class="inputnone" id="diastolic_blood_pressure" style=" width:50px;ime-mode: disabled;"  >   (单位:mmHg)(本次：收缩压/舒张压)|(下次：收缩压/舒张压)  </td>
   	</tr>
   	<tr>
   	  <td height="29" align="center">身高(cm)<img title="“身高斜线前填写目前情况，斜线后下填写下次随访时应调整到的目标。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
     <td colspan="2">
		  <input type="text" value="<?php echo $this->_tpl_vars['height']; ?>
" name="height" id="height" class="inputnone" onblur="bmi_result('height','weight','bmi');" style="ime-mode: disabled;"  >/
		  <input type="text" value="<?php echo $this->_tpl_vars['height_next']; ?>
" name="height_next" id="height_next" class="inputnone" onblur="bmi_result('height_next','expectative_weight','bmi_next');" style="ime-mode: disabled;"  >(单位:cm)</td>
   	</tr>
   	<tr>
   	  <td height="29" align="center">体重(kg)<img title="“体重斜线前填写目前情况，斜线后下填写下次随访时应调整到的目标。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
     <td colspan="2">
		  <input type="text" value="<?php echo $this->_tpl_vars['weight']; ?>
" name="weight" id="weight" class="inputnone" onblur="bmi_result('height','weight','bmi');" style="ime-mode: disabled;"  />/
		  <input type="text" value="<?php echo $this->_tpl_vars['expecttative']; ?>
" name="expectative_weight" id="expectative_weight" class="inputnone" onblur="bmi_result('height_next','expectative_weight','bmi_next');" style="ime-mode: disabled;"  >(单位:kg)</td>
   	</tr>
   	<tr>
   	  <td height="29" align="center">体质指数<img title="“体质指数=体重（kg）/身高的平方（m2）。如有其他阳性体征，请填写在“其他”一栏。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
      <input type="text" value="<?php echo $this->_tpl_vars['bmi']; ?>
"  name="bmi" id="bmi" class="inputnone" style="ime-mode: ">/
      <input type="text" value="<?php echo $this->_tpl_vars['bmi_next']; ?>
"  name="bmi_next" id="bmi_next" class="inputnone" style="ime-mode: disabled;" >
      </td>
   	</tr>
   	<tr>
   	  <td height="29" align="center">足背动脉搏动</td>
      <td colspan="2">
	  		<?php $_from = $this->_tpl_vars['arteria_dorsalis_pedis']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['adp']):
?>
	  <label onclick="set_lung_val('<?php echo $this->_tpl_vars['k']; ?>
','arteria_dorsalis_pedis')">
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['adp'][1]; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
		  <input type="text" value="<?php echo $this->_tpl_vars['arterta']; ?>
" name="arteria_dorsalis_pedis" class="inputnew"></td>
   	</tr>
   	<tr>
   	  <td height="29" align="center">其他</td>
     <td colspan="2"><input name="adp_other" type="text" value="<?php echo $this->_tpl_vars['other']; ?>
" class="inputnone1"></td>
   	</tr>
   	<tr>
   	  <td rowspan="7" align="center"><p>生</p>
      <p>活</p>
      <p>方</p>
      <p>式</p>
      <p>指</p>
      <p>导</p><img title="“询问患者生活方式的同时对患者进行生活方式指导，与患者共同制定下次随访目标。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td height="43" align="center">日吸烟量(支)<img title="“斜线前填写目前吸烟量，不吸烟填“0”，吸烟者写出每天的吸烟量“××支”，斜线后填写吸烟者下次随访目标吸烟量“××支”。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
		  <input type="text" value="<?php echo $this->_tpl_vars['smoking']; ?>
" name="smoking" id="smoking" class="inputnone" style="ime-mode: disabled;" onblur="return check_form('smoking');" >/
		  <input type="text" value="<?php echo $this->_tpl_vars['expertsmoking']; ?>
" name="expert_smoking" id="expert_smoking" class="inputnone" style="ime-mode: disabled;" onblur="return check_form('expert_smoking');" ></td>
   	</tr>
   	<tr>
   	  <td height="41" align="center">日饮酒量(两)<img title="“斜线前填写目前饮酒量，不饮酒填“0”，饮酒者写出每天的饮酒量相当于白酒“××两”，斜线后填写饮酒者下次随访目标饮酒量相当于白酒“××两”。白酒1两相当于葡萄酒4两，黄酒半斤，啤酒1瓶，果酒4两。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
		  <input type="text" value="<?php echo $this->_tpl_vars['drinking']; ?>
" name="drinking" id="drinking" class="inputnone" style="ime-mode: disabled;" onblur="return check_form('drinking');" >/
		  <input type="text" value="<?php echo $this->_tpl_vars['experdrinking']; ?>
" name="expert_drinking" id="expert_drinking" class="inputnone" style="ime-mode: disabled;" onblur="return check_form('expert_drinking');" ></td>
   	</tr>
   	<tr>
   	  <td rowspan="2" align="center">运动<img title="“填写每周几次，每次多少分钟。即“××次／周，××分钟／次”。横线上填写目前情况，横线下填写下次随访时应达到的目标。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
     <td height="28" colspan="2" align="left">
	  	<input type="text" value="<?php echo $this->_tpl_vars['frequencying']; ?>
" name="frequency" id="frequency" class="inputnone" style="ime-mode: disabled;" onblur="return check_form('frequency');" >次/周
	  <input type="text" value="<?php echo $this->_tpl_vars['frequencyingtime']; ?>
" name="frequency_time" id="frequency_time" class="inputnone" style="ime-mode: disabled;" onblur="return check_form('frequency_time');" >分钟/次	  </td>
   	</tr>
   	<tr>
      <td height="33" colspan="2" align="left">
	  	<input type="text" value="<?php echo $this->_tpl_vars['experquency']; ?>
" name="expert_frequency" id="expert_frequency" class="inputnone" style="ime-mode: disabled;" onblur="return check_form('expert_frequency');" >次/周
	  <input type="text" value="<?php echo $this->_tpl_vars['experquencytime']; ?>
" name="expert_frequency_time" id="expert_frequency_time" class="inputnone" style="ime-mode: disabled;" onblur="return check_form('expert_frequency_time');">分钟/次	  </td>
   	</tr>
   	<tr>
   	  <td align="center"><p>主食</p>
      <p>(克/天)</p><img title="“根据患者的实际情况估算主食（米饭、面食、饼干等淀粉类食物）的摄入量。为每天各餐的合计量。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
		  <input type="text" value="<?php echo $this->_tpl_vars['maincourse']; ?>
" name="main_course" id="main_course" class="inputnone1" style="ime-mode: disabled;" onblur="return check_form('main_course');" >/
		  <input type="text" value="<?php echo $this->_tpl_vars['expermaincourse']; ?>
" name="expert_main_course" id="expert_main_course" class="inputnone1" style="ime-mode: disabled;" onblur="return check_form('expert_main_course');" ></td>
   	</tr>
   	<tr>
   	  <td align="center">心理调整<img title="“根据医生印象选择对应的选项。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['heart_adjustment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['heart']):
?>
	  <label onclick="set_lung_val('<?php echo $this->_tpl_vars['k']; ?>
','heart_adjustment')">
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['heart'][1]; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		<input type="text" class="inputnew" name="heart_adjustment" value="<?php echo $this->_tpl_vars['headerad']; ?>
" />	  </td>
   	</tr>
   	<tr>
   	  <td align="center">遵医行为<img title="“指患者是否遵照医生的指导去改善生活方式。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['complian']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['cp']):
?>
	  <label onclick="set_lung_val('<?php echo $this->_tpl_vars['k']; ?>
','complian')">
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['cp'][1]; ?>

		</label>
		<?php endforeach; endif; unset($_from); ?>
		<input type="text" class="inputnew" name="complian" value="<?php echo $this->_tpl_vars['comp']; ?>
" />	  </td>
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
      <td colspan="2"><input type="text" name="fasting_bloodglucose" class="inputbottom" value="<?php echo $this->_tpl_vars['bloodnumber']; ?>
" id="fasting_bloodglucose" style="ime-mode: disabled;" onblur="return check_form('fasting_bloodglucose');" >mmol/L</td>
   	</tr>
   	<tr>
   	  <td align="center">其他检查*</td>
      <td colspan="2" valign="top">
		  <p>糖化血红蛋白<input type="text" name="hbclc" id="hbclc" class="inputbottom" value="<?php echo $this->_tpl_vars['hbclc']; ?>
" style="ime-mode: disabled;" onblur="return check_form('hbclc');">%</p>
		  <p>检查日期<input type="text" class="time"  name="mon" id="mon" value="<?php echo $this->_tpl_vars['examintimeone']; ?>
" style="ime-mode: disabled;"  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'MM'})" >月
		  <input type="text" class="time" value="<?php echo $this->_tpl_vars['examintimetwo']; ?>
" name="day" id="day"  onfocus="WdatePicker({skin:'whyGreen',dateFmt:'dd'})" >日</p>	
		  <input type="text" class="inputbottom other" name="eamination_info" value="<?php echo $this->_tpl_vars['eaminationinf']; ?>
">	  </td>
   	</tr>
   	<tr>
   	  <td height="41" colspan="2" align="center">服药依从性<img title="““规律”为按医嘱服药，“间断”为未按医嘱服药，频次或数量不足，“不服药”即为医生开了处方，但患者未使用此药。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['compliance']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['comply']):
?>
	  <label onclick="set_lung_val('<?php echo $this->_tpl_vars['k']; ?>
','compliance')">
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['comply'][1]; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		<input type="text" class="inputnew" name="compliance" value="<?php echo $this->_tpl_vars['compile']; ?>
" />	  </td>
   	</tr>
   	<tr>
   	  <td height="38" colspan="2" align="center">药物不良反应<img title="“如果患者服用上述药物有明显的药物不良反应，具体描述哪种药物，何种不良反应。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['adverse_drug_reaction']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['adv']):
?>
	  <label onclick="set_lung_val('<?php echo $this->_tpl_vars['k']; ?>
','adverse_drug_reaction')" class="adv">
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['adv'][1]; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		<input type="text" class="inputnew" name="adverse_drug_reaction" value="<?php echo $this->_tpl_vars['adverse_drug']; ?>
" id="adverse_drug_reaction"/>	  </td>
   	</tr>
	<tr>
   	 	<td height="36" colspan="2" align="center">低血糖反应<img title="“根据上次随访到此次随访之间患者出现的低血糖反应情况。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		<td colspan="2">
	  	<?php $_from = $this->_tpl_vars['reactive_hypoglycemia']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['rh']):
?>
	  <label onclick="set_lung_val('<?php echo $this->_tpl_vars['k']; ?>
','reactive_hypoglycemia')">
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['rh'][1]; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		<input type="text" value="<?php echo $this->_tpl_vars['reactive']; ?>
" name="reactive_hypoglycemia" class="inputnew"></td>
	</tr>
   	<tr>
   	  <td height="38" colspan="2" align="center">此次随访分类<img title="根据此次随访时的分类结果，由随访医生在4种分类结果中选择一项在“□”中填上相应的数字。“控制满意”意为血糖控制满意，无其他异常、“控制不满意”意为血糖控制不满意，无其他异常、“不良反应”意为存在药物不良反应、“并发症”意为出现新的并发症或并发症出现异常。如果患者并存几种情况，填写最严重的一种情况，同时结合上次随访情况，决定患者下次随访时间，并告知患者。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['followup_classification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['fclass']):
?>
	  <label onclick="set_lung_val('<?php echo $this->_tpl_vars['k']; ?>
','followup_classification')" class="classification">
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['fclass'][1]; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		<input type="text" class="inputnew" name="followup_classification" value="<?php echo $this->_tpl_vars['classific']; ?>
" id="followup_classification" />	 </td>
   	</tr>
   	<tr>
   	  <td rowspan="8" align="center"><p>用</p>
      <p>药</p>
      <p>情</p>
      <p>况</p><img title="根据患者整体情况，为患者开具处方，填写患者即将服用的降糖药物名称，写明用法。胰岛素具体写明胰岛素的种类、时间、剂量。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	</tr>
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
      <td height="27" align="center">药物名称<?php echo $this->_sections['custom']['iteration']; ?>
</td>
      <input type="hidden" name="drug_uuid[]" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['custom']['index']]['drugs_uuid']; ?>
" />
      <td colspan="2"><input type="text" name="drug_name[]" class="inputnone1" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['custom']['index']]['drug_name']; ?>
"></td>
   	</tr>
   	<tr>
   	  <td height="26" align="center">用法用量</td>
      <td width="387">每日
      <input type="text" name="drug_frequency[]" class="inputs" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['custom']['index']]['drug_frequency']; ?>
">次</td>
   	  <td width="461">每次
      <input type="text" name="drug_amount[]" class="inputs" value="<?php echo $this->_tpl_vars['hypertension_array'][$this->_sections['custom']['index']]['drug_amount']; ?>
">mg</td>
   	</tr>
   <?php endfor; endif; ?>
   	<tr>
   	  <td align="center">胰岛素</td>
      <td colspan="2">
         种类：<input type="text" name="insulin_class" class="inputnone1" value="<?php echo $this->_tpl_vars['insuli_edit']; ?>
"/>
         <br>
         <span style="display:block;float:left;">用法和用量：</span><textarea cols="16" rows="6" class="newtextarea" name="insulin"><?php echo $this->_tpl_vars['insuli']; ?>
</textarea>
      </td>
    </tr>
   	
   	<tr>
   	  <td rowspan="2" align="center"><p>转</p>
      <p>诊</p><img title="如果转诊要写明转诊的医疗机构及科室类别，如××市人民医院心内科，并在原因一栏写明转诊原因。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td height="25" align="center">原因</td>
      <td colspan="2"><input type="text" name="reason" class="inputnone1" value="<?php echo $this->_tpl_vars['reason']; ?>
"></td>
   	</tr>
   	<tr>
   	  <td align="center">机构及科别</td>
   	  <td colspan="2"><input type="text" name="organization" class="inputnone1" value="<?php echo $this->_tpl_vars['organization']; ?>
"></td>
   	</tr>
   	<tr>
   	  <td height="25" colspan="2" align="center">下次随访日期</td>
      <td colspan="2"><input type="text" name="time_of_next_followup" onclick="WdatePicker({firstDayOfWeek:1})" class="inputnone1" value="<?php echo $this->_tpl_vars['nexttime']; ?>
"><span id="myweek"></span></td>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center" >随访结果</td>
   	  <td colspan="2"><textarea rows="5" cols="60" id="resultnow" name="followup_result"><?php echo $this->_tpl_vars['followup_result']; ?>
</textarea></td>
   	</tr>
   	<tr>
   	  <td height="36" colspan="2" align="center">随访医生签名<img title="随访完毕，核查无误后随访医生签署其姓名。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
      	<select name="followup_doctor" id="staff_id">
      	    <option value="-1">请选择...</option>
			<?php unset($this->_sections['response_doctor']);
$this->_sections['response_doctor']['name'] = 'response_doctor';
$this->_sections['response_doctor']['loop'] = is_array($_loop=$this->_tpl_vars['response_doctor']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['response_doctor']['show'] = true;
$this->_sections['response_doctor']['max'] = $this->_sections['response_doctor']['loop'];
$this->_sections['response_doctor']['step'] = 1;
$this->_sections['response_doctor']['start'] = $this->_sections['response_doctor']['step'] > 0 ? 0 : $this->_sections['response_doctor']['loop']-1;
if ($this->_sections['response_doctor']['show']) {
    $this->_sections['response_doctor']['total'] = $this->_sections['response_doctor']['loop'];
    if ($this->_sections['response_doctor']['total'] == 0)
        $this->_sections['response_doctor']['show'] = false;
} else
    $this->_sections['response_doctor']['total'] = 0;
if ($this->_sections['response_doctor']['show']):

            for ($this->_sections['response_doctor']['index'] = $this->_sections['response_doctor']['start'], $this->_sections['response_doctor']['iteration'] = 1;
                 $this->_sections['response_doctor']['iteration'] <= $this->_sections['response_doctor']['total'];
                 $this->_sections['response_doctor']['index'] += $this->_sections['response_doctor']['step'], $this->_sections['response_doctor']['iteration']++):
$this->_sections['response_doctor']['rownum'] = $this->_sections['response_doctor']['iteration'];
$this->_sections['response_doctor']['index_prev'] = $this->_sections['response_doctor']['index'] - $this->_sections['response_doctor']['step'];
$this->_sections['response_doctor']['index_next'] = $this->_sections['response_doctor']['index'] + $this->_sections['response_doctor']['step'];
$this->_sections['response_doctor']['first']      = ($this->_sections['response_doctor']['iteration'] == 1);
$this->_sections['response_doctor']['last']       = ($this->_sections['response_doctor']['iteration'] == $this->_sections['response_doctor']['total']);
?>
			<option value="<?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['user_id']; ?>
" <?php if ($this->_tpl_vars['fdoctor'] == $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['user_id']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['name_real']; ?>
</option>
			<?php endfor; endif; ?>
		</select></td>
   	</tr>
	<tr>
		<td height="42" colspan="4" align="center">
		    <input type="hidden" id="nexturl" value="" name="nexturl"/>
		    <?php if ($this->_tpl_vars['currenteditid'] !== ""): ?>
			<input type="submit" class="inputbutton" value="更新记录" name="ok"/>	 &nbsp;
			 <input type="button" name="return" id="return" class="inputbutton" value="返回列表" onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/list';" />
			<?php else: ?>
			<input type="submit" class="inputbutton" value="添加记录" name="ok"/> &nbsp;
			 <input type="button" name="return" id="return" class="inputbutton" value="返回列表" onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/list';" />
			<?php endif; ?>
			 </td>
	</tr>
  </table>
</form> 
</body>
</html>
<script type="text/javascript">
//计算bmi 体质指数
	function bmi_result(current_obj,next_obj,result_obj)
	{
		var height_obj = $("#"+current_obj);
		var weight_obj = $("#"+next_obj);
		var result_obj = $("#"+result_obj);
		if(weight_obj.val()==''||height_obj.val()=='')
		{
			result_obj.val(0);
		}
		else
		{
			var result_val = weight_obj.val()/(height_obj.val()/100)/(height_obj.val()/100);
			//var result_val = result_val/10000;
			result_obj.val(result_val.toFixed(2));
		}
	}
	 function check_form(id)
	 {  
		reg=/^[0-9]*[\.]{0,1}[0-9]+$/;    
		var val = $("#"+id).val(); 
		if(val!='')
		{
		   if(!reg.test(val))
          {
        	alert('输入格式不正确,请输入数字或者小数!');
        	$("#"+id).val('');
        	$("#"+id).focus();
        	return false;
          }
		}
		else
		{
			return true;
		}   
	 }
</script>