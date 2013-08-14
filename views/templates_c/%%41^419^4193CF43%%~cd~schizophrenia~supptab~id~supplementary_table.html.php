<?php /* Smarty version 2.6.14, created on 2013-06-24 15:54:11
         compiled from supplementary_table.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/health.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/experience_table.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script> 
<title>重性精神病患者个人信息补充表</title>
<style>
.STYLE1 {font-weight: bold}
.STYLE2 {font-weight: bold}
label
{
	cursor:hand;
	cursor: pointer;
}
</style>
<script>
	$(document).ready(function(){
	//目前症状
		$("input[name='main_symptomsed[]']").each(function(){
			 $(this).blur(function(){
				$("input[name='main_symptomsed[]']").each(function(){
				var present_symptoms_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['present_symptoms_json']; ?>
');
				var input_val=$(this).val();			
				if(input_val!="" && present_symptoms_array[input_val][0]=="-99")
				{
					
					$("#main_symptomsed_other").attr("disabled",false);
					if($("#main_symptomsed_other").val()=="")
					{
						$("#main_symptomsed_other").focus();
					}
					return false;//只要出现了其他项，则退出					
				}
				else
				{				
					$("#main_symptomsed_other").attr("disabled",true);
				}
				});
			});
		});
	});
</script>
</head>
<body >

<form  action="<?php echo $this->_tpl_vars['basePath']; ?>
cd/schizophrenia/supptabupdate" method="post">

   <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
   <div class="STYLE1" style="background:#FFFFFF; text-align:center; width:100%;font-size: 16px;
	font-weight: bold;">重性精神病患者个人信息补充表<img title="对于重性精神疾病患者，在建立居民健康档案时，除填写个人基本信息表外，还应填写此表。在随访中发现个人信息有所变更时，要及时修订" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></div>
   <div  style=" text-align:center; width:100%; "><input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
      <div  style=" width:70%; text-align:left; float:left;background:#FFFFFF;"><strong>姓名</strong>：<?php echo $this->_tpl_vars['user_name']; ?>
</div>
	  <div style=" width:30%; text-align:left; float:left;background:#FFFFFF;"><strong>编号</strong>：<?php echo $this->_tpl_vars['standard_code']; ?>
</div>
   </div>
<table width="100%"  align="center" cellpadding="" cellspacing="">
   	<tr>
   	  <td colspan="2">监护人姓名<img title="监护人姓名：法律规定的、目前行使监护职责的人" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td ><input type="text" name="guardian_name" value="<?php echo $this->_tpl_vars['guardian_name']; ?>
" class="inputnone2"></td>
      <td>与患者关系</td>
   	  <td width="34%"><input type="text" name="relationship_with_patients" value="<?php echo $this->_tpl_vars['relationship_with_patients']; ?>
" class="inputnone2"></td>
   	</tr>
   	<tr>
   	  <td colspan="2">监护人地址<img title="监护人住址及监护人电话：填写患者监护人目前的居住地址及可以随时联系的电话。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td ><input type="text" name="guardian_address" value="<?php echo $this->_tpl_vars['guardian_address']; ?>
" class="inputnone2"></td>
      <td>监护人电话</td>
   	  <td><input type="text" name="guardian_phone" value="<?php echo $this->_tpl_vars['guardian_phone']; ?>
" class="inputnone2"></td>
   	</tr>
    <tr>
		<td colspan="2">辖区村委会(居)委会联系人</td>
	    <td ><input type="text" name="contact_area" value="<?php echo $this->_tpl_vars['contact_area']; ?>
" class="inputnone1"></td><td>电话</td><td><input type="text" name="phone_area" value="<?php echo $this->_tpl_vars['phone_area']; ?>
" class="inputnone1"></td>
   	</tr>
   	<tr>
		<td colspan="2">初次发病时间<img title="初次发病时间：患者首次出现精神症状的时间" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	    <td colspan="3"><input type="text" name="onset_time" value="<?php echo $this->_tpl_vars['onset_time']; ?>
" class="inputbottomlong"  onClick="WdatePicker({firstDayOfWeek:1})" /></td>
   	</tr>
    <tr>
		<td colspan="2">知情同意</td>
	    <td colspan="3">
	     <?php $_from = $this->_tpl_vars['informed_consent_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','informed_consent')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
         <?php endforeach; endif; unset($_from); ?>&nbsp;   
         <input type="text"  name="informed_consent" value="<?php echo $this->_tpl_vars['informed_consent_current']; ?>
" class="inputnew" />         
        <br/> 
        签字:<input type="text" name="informed_consent_sign" value="<?php echo $this->_tpl_vars['informed_consent_sign']; ?>
" class="inputbottomlong"/>	   
	    <br/>
	    签字时间:<input type="text" name="informed_consent_sign_time" value="<?php echo $this->_tpl_vars['informed_consent_sign_time']; ?>
" class="inputbottomlong"  onClick="WdatePicker({firstDayOfWeek:1})" /> 
	    </td>
   	</tr>
    <tr>
		<td colspan="2">既往主要症状<img title="既往主要症状：根据患者从第一次发病到填写此表之时的情况，填写患者曾出现过的主要症状" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	    <td colspan="3">
       		 <?php $_from = $this->_tpl_vars['present_symptoms_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
               <?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
	        <?php endforeach; endif; unset($_from); ?>&nbsp;
	        <input type="text" name="main_symptomsed_other" id="main_symptomsed_other" value="<?php echo $this->_tpl_vars['main_symptomsed_other']; ?>
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
		  	<input type="text" id="main_symptomsed" name="main_symptomsed[]" value="<?php echo $this->_tpl_vars['main_symptomsed_current'][$this->_sections['customer']['index']]; ?>
" class="inputnew" />
	        <?php endfor; endif; ?>
         </td>
   	</tr>
   	<tr>
   	  <td width="10%" rowspan="2">既往治疗情况<img title="既往治疗情况：根据患者接受的门诊和住院治疗情况填写。若未住过精神专科医院或综合医院精神科，填写“0”，住过院的填写次数" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td width="9%" >门诊</td>
      <td height="30"  colspan="3">  
   	        <?php $_from = $this->_tpl_vars['outpatient_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','outpatient')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
      		<input type="text" name="outpatient" value="<?php echo $this->_tpl_vars['outpatient_current']; ?>
" class="inputnew" />    
      </td>
   	</tr>
    <tr>
      <td>住院</td>
   	  <td height="30" colspan="3" >
                     曾住精神专科医院/综合医院精神专科<input type="text" name="hospital" value="<?php echo $this->_tpl_vars['hospital']; ?>
" class="inputbottom" />次	  
       </td>
   	</tr>
     <tr>
		<td colspan="2">最近诊断情况<img title="最近诊断情况：填写患者最近一次所患精神疾病的诊断名称，并填写医院名称和确诊日期" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	    <td colspan="3">
	              诊断   <input type="text" name="diagnosis" value="<?php echo $this->_tpl_vars['diagnosis']; ?>
" class="inputbottomlong"/>
	              确诊医院<input type="text" name="hospital_diagnosis" value="<?php echo $this->_tpl_vars['hospital_diagnosis']; ?>
" class="inputbottomlong"/>
	              确诊日期<input type="text" name="time_diagnosis" value="<?php echo $this->_tpl_vars['time_diagnosis']; ?>
" class="inputbottomlong" onClick="WdatePicker({firstDayOfWeek:1})" />
	    </td>
   	</tr>
   	<tr>
   	  <td colspan="2">最近一次治疗效果</td>
      <td colspan="3" >
            <?php $_from = $this->_tpl_vars['treatment_effect_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','therapeutic_effect')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;            
            <input type="text"  name="therapeutic_effect" value="<?php echo $this->_tpl_vars['therapeutic_effect_current']; ?>
" class="inputnew" />
      </td>
   	</tr>	
   	<tr>
   	  <td colspan="2">患者对家庭社会的影响<img title="患病对家庭社会的影响：根据患者从第一次发病到填写此表之时的情况，若未发生过，填写“0”；若发生过，填写相应的次数。轻度滋事：是指公安机关出警但仅作一般教育等处理的案情，例如患者打、骂他人或者扰乱秩序，但没有造成生命财产损害的，属于此类。肇事：是指患者的行为触犯了我国《治安管理处罚法》但未触犯《刑法》，例如患者有行凶伤人毁物等，但未导致被害人轻、重伤的。肇祸：是指患者的行为触犯了《刑法》，属于犯罪行为的" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="3">
         1 轻度滋事<input type="text" name="mild_trouble" value="<?php echo $this->_tpl_vars['mild_trouble']; ?>
" class="inputbottom">次&nbsp;
         2 肇事<input type="text" name="accident" value="<?php echo $this->_tpl_vars['accident']; ?>
" class="inputbottom">次&nbsp;
         3 肇祸<input type="text" name="zhaohuo" value="<?php echo $this->_tpl_vars['zhaohuo']; ?>
" class="inputbottom">次&nbsp;
         4 自伤<input type="text" name="self_wounding" value="<?php echo $this->_tpl_vars['self_wounding']; ?>
" class="inputbottom">次&nbsp;
         5 自杀未遂<input type="text" name="attmpted_suicide" value="<?php echo $this->_tpl_vars['attmpted_suicide']; ?>
" class="inputbottom">次&nbsp;
         6 无
      </td>
   	</tr>
   	 <tr>
   	  <td  colspan="2">关锁情况<img title="关锁情况：关锁指出于非医疗目的，使用某种工具（如绳索、铁链、铁笼等）限制患者的行动自由" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="3">
           <?php $_from = $this->_tpl_vars['shut_case_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','shut_case')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;            
            <input type="text"  name="shut_case" value="<?php echo $this->_tpl_vars['shut_case_current']; ?>
" class="inputnew" />	
            </td>  	
    </tr>
    <tr>
   	  <td  colspan="2">经济状况<img title="经济状况：指患者经济状况。贫困指低保户" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="3">
           <?php $_from = $this->_tpl_vars['economic_conditions_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','economic_conditions')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;            
            <input type="text"  name="economic_conditions" value="<?php echo $this->_tpl_vars['economic_conditions']; ?>
" class="inputnew" />	
            </td>  	
    </tr>
    <tr>
   	  <td  colspan="2">专科医生的意见<br/>(如果有请记录)<img title="专科医生意见：是指建档时由家属提供或患者原治疗医疗机构提供的精神专科医生的意见。如没有相关信息则填写“无”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="3">
           <textarea  class="newtextarea" name="specialist_advice" cols="60" rows="5"><?php echo $this->_tpl_vars['specialist_advice']; ?>
</textarea>
            </td>  	
    </tr>
    <tr>
   	  <td  colspan="2">填表日期</td>
      <td >
         <input type="text" name="fill_time" value="<?php echo $this->_tpl_vars['fill_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})" class="inputbottom">年
	  </td>
      <td>医生签名</td>
   	  <td>
   	 
       <select name="doctors_signature" style="width:95px">
       <?php unset($this->_sections['experience']);
$this->_sections['experience']['loop'] = is_array($_loop=$this->_tpl_vars['region_users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['experience']['name'] = 'experience';
$this->_sections['experience']['show'] = true;
$this->_sections['experience']['max'] = $this->_sections['experience']['loop'];
$this->_sections['experience']['step'] = 1;
$this->_sections['experience']['start'] = $this->_sections['experience']['step'] > 0 ? 0 : $this->_sections['experience']['loop']-1;
if ($this->_sections['experience']['show']) {
    $this->_sections['experience']['total'] = $this->_sections['experience']['loop'];
    if ($this->_sections['experience']['total'] == 0)
        $this->_sections['experience']['show'] = false;
} else
    $this->_sections['experience']['total'] = 0;
if ($this->_sections['experience']['show']):

            for ($this->_sections['experience']['index'] = $this->_sections['experience']['start'], $this->_sections['experience']['iteration'] = 1;
                 $this->_sections['experience']['iteration'] <= $this->_sections['experience']['total'];
                 $this->_sections['experience']['index'] += $this->_sections['experience']['step'], $this->_sections['experience']['iteration']++):
$this->_sections['experience']['rownum'] = $this->_sections['experience']['iteration'];
$this->_sections['experience']['index_prev'] = $this->_sections['experience']['index'] - $this->_sections['experience']['step'];
$this->_sections['experience']['index_next'] = $this->_sections['experience']['index'] + $this->_sections['experience']['step'];
$this->_sections['experience']['first']      = ($this->_sections['experience']['iteration'] == 1);
$this->_sections['experience']['last']       = ($this->_sections['experience']['iteration'] == $this->_sections['experience']['total']);
?>
       <option value="<?php echo $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['user_id']; ?>
" <?php if ($this->_tpl_vars['doctors_signature'] == $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['user_id']): ?>selected<?php endif; ?>>
       <?php echo $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['name_real']; ?>
</option>
       <?php endfor; endif; ?>
       </select>
       </td>
   	</tr>
   	<tr>
   	  <td colspan="5" align="center"><input type="submit" name="ok" value="保存" class="inputbutton"/><?php if ($this->_tpl_vars['uuid'] != ""): ?>&nbsp;&nbsp;<input type="button" name="print" id="print" value="打印" onclick="javascript:window.print();" class="inputbutton"/><?php endif; ?></td>
   	</tr>
   </table>
</form> 
</body>
</html>