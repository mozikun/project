<?php /* Smarty version 2.6.14, created on 2013-06-24 15:15:59
         compiled from cd_add.html */ ?>
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
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/hypertension.js" type="text/javascript"></script>
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
.inputnone_more{
background:#FFFFFF;
border: 1px solid blue;
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
<script>
	$(document).ready(function(){
	//药物不良反应
	function chkadverse(){
		var adverse_drug_array = jQuery.parseJSON('<?php echo $this->_tpl_vars['adverse_drug_json_array']; ?>
');
		var input_val = $("input[name='adverse_drug']").val();
		if (input_val != "" && adverse_drug_array[input_val][0] == "2") {
			$("#adverse_drug_info").attr("disabled", false);
			if ($("#adverse_drug_info").val() == "") {
				$("#adverse_drug_info").focus();
			}
			return false;//只要出现了其他项，则退出
		}
		else {
			$("#adverse_drug_info").attr("disabled", true);
		}
	}
	chkadverse();
    var edit_sign='<?php echo $this->_tpl_vars['uuid']; ?>
';
    if(!edit_sign)
    {
        get_follow_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/cal");
    }
	$("#adverse_drug").blur(function(){chkadverse();});
    //判定逻辑
    $("input[name='symptom_code[]']").blur(function(){get_follow_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/cal/uuid/<?php echo $this->_tpl_vars['uuid']; ?>
");});
    $("input[name='pregnancy']").blur(function(){get_follow_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/cal/uuid/<?php echo $this->_tpl_vars['uuid']; ?>
");});
    $("input[name='blood_pressure']").blur(function(){get_follow_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/cal/uuid/<?php echo $this->_tpl_vars['uuid']; ?>
");});
    $("input[name='diastolic_blood_pressure']").blur(function(){get_follow_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/cal/uuid/<?php echo $this->_tpl_vars['uuid']; ?>
");});
    $("input[name='blood_difference']").blur(function(){get_follow_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/cal/uuid/<?php echo $this->_tpl_vars['uuid']; ?>
");});
    $("input[name='adverse_drug']").blur(function(){get_follow_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/cal/uuid/<?php echo $this->_tpl_vars['uuid']; ?>
");});
    $(".blur").click(function(){get_follow_result("<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/cal/uuid/<?php echo $this->_tpl_vars['uuid']; ?>
");});
	});
    function view_blood_pic(url)
    {
        //$("#blood_pic_load").attr("src",url);
        $.dialog(760, 268+60, $('#blood_popup').html(),"blood_popup","高血压随访血压近7日走势图");
        $('#dialog_box_html').addClass('background:url(<?php echo $this->_tpl_vars['basePath']; ?>
images/load.gif) no-repeat center center;');
        $('#dialog_box_html').empty();//先清空，因为多次载入图片
        var img = new Image();
        $(img).load(function() {
            $(this).hide();
            $('#dialog_box_html').append(this);
            $(this).fadeIn();
            }).error(function(){
                $('#dialog_box_html').html("没有查询到有相关数据，无法绘出相关图形");
                // notify the user that the image could not be loaded
            }).attr('src', url);
    }
</script>
</head>
<body >

<form name="frm" action="<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/editin" method="post">
   <input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
">
   <input type="hidden" name="person_uuid" value="<?php echo $this->_tpl_vars['person_uuid']; ?>
">
   <div class="STYLE1" style="background:#FFFFFF; text-align:center; width:100%;font-size: 16px;
	font-weight: bold;">高血压患者随访服务记录表<img title="本表为高血压患者在接受随访服务时由医生填写。每年的综合评估后填写居民健康档案的健康体检表。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></div>
   <div  style=" text-align:center; width:100%; "><input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
      <div  style=" width:70%; text-align:left; float:left;background:#FFFFFF;"><span class="STYLE2" style="padding-left:4px;">姓名</span>：<?php echo $this->_tpl_vars['user_name']; ?>
</div>
	  <div style=" width:30%; text-align:left; float:left;background:#FFFFFF;"><span class="STYLE2">编号</span>：<?php echo $this->_tpl_vars['standard_code']; ?>
</div>
   </div>
<table width="100%"  align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
   	<tr>
		<td colspan="2">随访日期</td>
	    <td colspan="2">
		<input type="text" name="follow_time_year" value="<?php echo $this->_tpl_vars['follow_time_year']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy'})" class="inputs">年
		<input type="text" name="follow_time_month" value="<?php echo $this->_tpl_vars['follow_time_month']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'MM'})" class="inputs">月
		<input type="text" name="follow_time_day" value="<?php echo $this->_tpl_vars['follow_time_day']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'dd'})" class="inputs">日</td>
   	</tr>
   	<tr>
   	  <td colspan="2">随访方式</td>
      <td colspan="2">
	 <?php $_from = $this->_tpl_vars['follow_type_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','follow_type')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
	<?php endforeach; endif; unset($_from); ?>&nbsp;
	  <input type="text" name="follow_type" value="<?php echo $this->_tpl_vars['follow_type']; ?>
" class="inputnew" /></td>
   	</tr>
   	<tr>
   	  <td rowspan="2"><p>症</p>
      <p>状</p></td>
      <td rowspan="2">
	  	<?php $_from = $this->_tpl_vars['symptom_code_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
<br />
		<?php endforeach; endif; unset($_from); ?>	  </td>
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
			<input type="text" class="inputnew" name="symptom_code[]" value="<?php echo $this->_tpl_vars['symptom_code'][$this->_sections['inp']['index']]['symptom_code']; ?>
" />/
		<?php endfor; endif; ?>	  </td>
   	</tr>
   	<tr>
   	  <td colspan="2" valign="top">
	  	<div>
			<div class="other_sym">其他：</div>
			<div class="other_txtsym">
				<textarea class="newtextarea" name="symptom_other" rows="6" cols="10"><?php echo $this->_tpl_vars['symptom_other']; ?>
</textarea>
			</div>
		</div>	  </td>
   	</tr>
    <?php if ($this->_tpl_vars['sex_code'] == 3): ?>
    <tr>
   	  <td colspan="2">是否妊娠期或哺乳期</td>
      <td colspan="2">
	 <?php $_from = $this->_tpl_vars['pregnancy_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','pregnancy')" class="blur"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
	<?php endforeach; endif; unset($_from); ?>&nbsp;
	  <input type="text" name="pregnancy" value="<?php echo $this->_tpl_vars['pregnancy']; ?>
" class="inputnew" /></td>
   	</tr>
    <?php endif; ?>
   	<tr>
   	  <td rowspan="7"><p>体</p>
      <p>征<img title="体质指数=体重（kg）/身高的平方（m2），体重和体质指数斜线前填写目前情况，斜线后下填写下次随访时应调整到的目标。如果 是超重或是肥胖的高血压患者，要求每次随访时测量体重并指导患者控制体重；正常体重人群可每年测量一次体重及体质指数。如有其他阳性体征，请填写在“其他”一栏。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></p></td>
      <td align="center"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/chart_bar.png" onclick="view_blood_pic('<?php echo $this->_tpl_vars['basePath']; ?>
statistics/hy/index/id/<?php echo $this->_tpl_vars['person_uuid']; ?>
')" alt="血压走势图" style="cursor: hand; height: 20px;" />血压(mmHg)<img title="分别填写收缩压、舒张压" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2"><input type="text" name="blood_pressure" value="<?php echo $this->_tpl_vars['blood_pressure']; ?>
" class="inputnone1" style="width:35px;" />/<input type="text" name="diastolic_blood_pressure" value="<?php echo $this->_tpl_vars['diastolic_blood_pressure']; ?>
" class="inputnone1" />
      &nbsp;今日参考值：&nbsp;<?php unset($this->_sections['blood_today']);
$this->_sections['blood_today']['name'] = 'blood_today';
$this->_sections['blood_today']['loop'] = is_array($_loop=$this->_tpl_vars['blood_today']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['blood_today']['show'] = true;
$this->_sections['blood_today']['max'] = $this->_sections['blood_today']['loop'];
$this->_sections['blood_today']['step'] = 1;
$this->_sections['blood_today']['start'] = $this->_sections['blood_today']['step'] > 0 ? 0 : $this->_sections['blood_today']['loop']-1;
if ($this->_sections['blood_today']['show']) {
    $this->_sections['blood_today']['total'] = $this->_sections['blood_today']['loop'];
    if ($this->_sections['blood_today']['total'] == 0)
        $this->_sections['blood_today']['show'] = false;
} else
    $this->_sections['blood_today']['total'] = 0;
if ($this->_sections['blood_today']['show']):

            for ($this->_sections['blood_today']['index'] = $this->_sections['blood_today']['start'], $this->_sections['blood_today']['iteration'] = 1;
                 $this->_sections['blood_today']['iteration'] <= $this->_sections['blood_today']['total'];
                 $this->_sections['blood_today']['index'] += $this->_sections['blood_today']['step'], $this->_sections['blood_today']['iteration']++):
$this->_sections['blood_today']['rownum'] = $this->_sections['blood_today']['iteration'];
$this->_sections['blood_today']['index_prev'] = $this->_sections['blood_today']['index'] - $this->_sections['blood_today']['step'];
$this->_sections['blood_today']['index_next'] = $this->_sections['blood_today']['index'] + $this->_sections['blood_today']['step'];
$this->_sections['blood_today']['first']      = ($this->_sections['blood_today']['iteration'] == 1);
$this->_sections['blood_today']['last']       = ($this->_sections['blood_today']['iteration'] == $this->_sections['blood_today']['total']);
?>
      <?php if ($this->_tpl_vars['blood_today'][$this->_sections['blood_today']['index']]['s_blood_pressure'] != "" || $this->_tpl_vars['blood_today'][$this->_sections['blood_today']['index']]['p_blood_pressure'] != ""): ?>
      <label onclick="blood_press(this)" class="blur"><?php echo $this->_tpl_vars['blood_today'][$this->_sections['blood_today']['index']]['s_blood_pressure']; ?>
/<?php echo $this->_tpl_vars['blood_today'][$this->_sections['blood_today']['index']]['p_blood_pressure']; ?>
</label>
      <?php endif; ?>
      <?php endfor; endif; ?>
      </td>
   	</tr>
    <tr>
   	  <td align="center">双侧血压相差值</td>
      <td colspan="2">
		  <input type="text" name="blood_difference" value="<?php echo $this->_tpl_vars['blood_difference']; ?>
" class="inputnone" /></td>
   	</tr>
    <tr>
   	  <td align="center">身高(cm)</td>
      <td colspan="2">
		  <input type="text" name="height" value="<?php echo $this->_tpl_vars['height']; ?>
" onblur="cal_bmi()" class="inputnone">
        &nbsp;今日参考值：&nbsp;<?php unset($this->_sections['blood_today']);
$this->_sections['blood_today']['name'] = 'blood_today';
$this->_sections['blood_today']['loop'] = is_array($_loop=$this->_tpl_vars['blood_today']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['blood_today']['show'] = true;
$this->_sections['blood_today']['max'] = $this->_sections['blood_today']['loop'];
$this->_sections['blood_today']['step'] = 1;
$this->_sections['blood_today']['start'] = $this->_sections['blood_today']['step'] > 0 ? 0 : $this->_sections['blood_today']['loop']-1;
if ($this->_sections['blood_today']['show']) {
    $this->_sections['blood_today']['total'] = $this->_sections['blood_today']['loop'];
    if ($this->_sections['blood_today']['total'] == 0)
        $this->_sections['blood_today']['show'] = false;
} else
    $this->_sections['blood_today']['total'] = 0;
if ($this->_sections['blood_today']['show']):

            for ($this->_sections['blood_today']['index'] = $this->_sections['blood_today']['start'], $this->_sections['blood_today']['iteration'] = 1;
                 $this->_sections['blood_today']['iteration'] <= $this->_sections['blood_today']['total'];
                 $this->_sections['blood_today']['index'] += $this->_sections['blood_today']['step'], $this->_sections['blood_today']['iteration']++):
$this->_sections['blood_today']['rownum'] = $this->_sections['blood_today']['iteration'];
$this->_sections['blood_today']['index_prev'] = $this->_sections['blood_today']['index'] - $this->_sections['blood_today']['step'];
$this->_sections['blood_today']['index_next'] = $this->_sections['blood_today']['index'] + $this->_sections['blood_today']['step'];
$this->_sections['blood_today']['first']      = ($this->_sections['blood_today']['iteration'] == 1);
$this->_sections['blood_today']['last']       = ($this->_sections['blood_today']['iteration'] == $this->_sections['blood_today']['total']);
?>
      <label onclick="lable_press(this,'height')" class="blur"><?php echo $this->_tpl_vars['blood_today'][$this->_sections['blood_today']['index']]['height']; ?>
</label>
      <?php endfor; endif; ?></td>
   	</tr>
   	<tr>
   	  <td align="center">体重(kg)</td>
      <td colspan="2">
		  <input type="text" name="weight_begin" value="<?php echo $this->_tpl_vars['weight_begin']; ?>
" onblur="cal_bmi()" class="inputnone">/
		  <input type="text" name="weight_after" value="<?php echo $this->_tpl_vars['weight_after']; ?>
" class="inputnone">
          &nbsp;今日参考值：&nbsp;<?php unset($this->_sections['blood_today']);
$this->_sections['blood_today']['name'] = 'blood_today';
$this->_sections['blood_today']['loop'] = is_array($_loop=$this->_tpl_vars['blood_today']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['blood_today']['show'] = true;
$this->_sections['blood_today']['max'] = $this->_sections['blood_today']['loop'];
$this->_sections['blood_today']['step'] = 1;
$this->_sections['blood_today']['start'] = $this->_sections['blood_today']['step'] > 0 ? 0 : $this->_sections['blood_today']['loop']-1;
if ($this->_sections['blood_today']['show']) {
    $this->_sections['blood_today']['total'] = $this->_sections['blood_today']['loop'];
    if ($this->_sections['blood_today']['total'] == 0)
        $this->_sections['blood_today']['show'] = false;
} else
    $this->_sections['blood_today']['total'] = 0;
if ($this->_sections['blood_today']['show']):

            for ($this->_sections['blood_today']['index'] = $this->_sections['blood_today']['start'], $this->_sections['blood_today']['iteration'] = 1;
                 $this->_sections['blood_today']['iteration'] <= $this->_sections['blood_today']['total'];
                 $this->_sections['blood_today']['index'] += $this->_sections['blood_today']['step'], $this->_sections['blood_today']['iteration']++):
$this->_sections['blood_today']['rownum'] = $this->_sections['blood_today']['iteration'];
$this->_sections['blood_today']['index_prev'] = $this->_sections['blood_today']['index'] - $this->_sections['blood_today']['step'];
$this->_sections['blood_today']['index_next'] = $this->_sections['blood_today']['index'] + $this->_sections['blood_today']['step'];
$this->_sections['blood_today']['first']      = ($this->_sections['blood_today']['iteration'] == 1);
$this->_sections['blood_today']['last']       = ($this->_sections['blood_today']['iteration'] == $this->_sections['blood_today']['total']);
?>
      <label onclick="lable_press(this,'weight_begin')" class="blur"><?php echo $this->_tpl_vars['blood_today'][$this->_sections['blood_today']['index']]['weight']; ?>
</label>
      <?php endfor; endif; ?>
          </td>
   	</tr>
   	<tr>
   	  <td align="center">体质指数<img title="体质指数=体重(kg)/身高的平方(㎡)" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2"><input type="text" name="body_mass_index" value="<?php echo $this->_tpl_vars['body_mass_index']; ?>
" class="inputnone1"></td>
   	</tr>
   	<tr>
   	  <td align="center">心率</td>
      <td colspan="2">
		  <input type="text" name="heart_rate_begin" value="<?php echo $this->_tpl_vars['heart_rate_begin']; ?>
" class="inputnone">/
		  <input type="text" name="heart_rate_after" value="<?php echo $this->_tpl_vars['heart_rate_after']; ?>
" class="inputnone"></td>
   	</tr>
   	<tr>
   	  <td align="center">其他</td>
      <td colspan="2"><input type="text" name="signs_other" value="<?php echo $this->_tpl_vars['signs_other']; ?>
" class="inputnone1"></td>
   	</tr>
    <tr>
   	  <td style="font-size: 14px;" colspan="4">以下内容仅高血压患者填写，【<?php echo $this->_tpl_vars['user_name']; ?>
】属于<span style="color: <?php if ($this->_tpl_vars['sign_hypertension']): ?>red<?php else: ?>green<?php endif; ?>;"><?php if ($this->_tpl_vars['sign_hypertension']): ?>高血压患者<?php else: ?>非高血压患者<?php endif; ?></span></td>
   	</tr>
   	<tr>
   	  <td rowspan="7"><p>生</p>
      <p>活</p>
      <p>方</p>
      <p>式</p>
      <p>指</p>
      <p>导<img title="在询问患者生活方式时，同时对患者进行生活方式指导，与患者共同制定下次随访目标。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></p></td>
      <td align="center">日吸烟量(支)<img title="斜线前填写目前吸烟量，不吸烟填“0”，吸烟者写出每天的吸烟量“××支”，斜线后填写吸烟者下次随访目标吸烟量“××支”。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
		  <input type="text" name="smoking_begin" value="<?php echo $this->_tpl_vars['smoking_begin']; ?>
" class="inputnone">/
		  <input type="text" name="smoking_after" value="<?php echo $this->_tpl_vars['smoking_after']; ?>
" class="inputnone"></td>
   	</tr>
   	<tr>
   	  <td align="center">日饮酒量(两)<img title="斜线前填写目前饮酒量，不饮酒填“0”，饮酒者写出每天的饮酒量相当于白酒“××两”，斜线后填写饮酒者下次随访目标饮酒量相当于白酒“××两”。白酒1两相当于葡萄酒4两，黄酒半斤，啤酒1瓶，果酒4两。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
		  <input type="text" name="drinking_begin" value="<?php echo $this->_tpl_vars['drinking_begin']; ?>
" class="inputnone">/
		  <input type="text" name="drinking_after" value="<?php echo $this->_tpl_vars['drinking_after']; ?>
" class="inputnone"></td>
   	</tr>
   	<tr>
   	  <td rowspan="2" align="center">运动<img title="填写每周几次，每次多少分钟。即“××次／周，××分钟／次”。横线上填写目前情况，横线下填写下次随访时应达到的目标。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>

      <td colspan="2" align="center">
	  	<input type="text" name="sport_amount_begin" value="<?php echo $this->_tpl_vars['sport_amount_begin']; ?>
" class="inputnone">次/周
	  <input type="text" name="sport_time_begin" value="<?php echo $this->_tpl_vars['sport_time_begin']; ?>
" class="inputnone">分钟/次	  </td> 
	  </tr>
   	<tr>
	<td colspan="2" align="center">
	  	<input type="text" name="sport_amount_after" value="<?php echo $this->_tpl_vars['sport_amount_after']; ?>
" class="inputnone">次/周
	  <input type="text" name="sport_time_after" value="<?php echo $this->_tpl_vars['sport_time_after']; ?>
" class="inputnone">分钟/次	  </td>
   	<tr>
   	  <td align="center"><p>摄盐情况<img title="斜线前填写目前摄盐的咸淡情况 。根据患者饮食的摄盐情况，按咸淡程度在列出的“轻、中、重”之一上划“√”分类，斜线后填写患者下次随访目标摄盐情况。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></p>
      <p>(咸淡)</p></td>
      <td colspan="2">
          <input type="radio" name="salt_intake_begin" value="1" <?php if ($this->_tpl_vars['salt_intake_begin'] == 1): ?> checked="checked"<?php endif; ?> />轻
          <input type="radio" name="salt_intake_begin" value="2" <?php if ($this->_tpl_vars['salt_intake_begin'] == 2): ?> checked="checked"<?php endif; ?> />中
          <input type="radio" name="salt_intake_begin" value="3" <?php if ($this->_tpl_vars['salt_intake_begin'] == 3): ?> checked="checked"<?php endif; ?> />重
		  /
          <input type="radio" name="salt_intake_after" value="1" <?php if ($this->_tpl_vars['salt_intake_after'] == 1): ?> checked="checked"<?php endif; ?> />轻
          <input type="radio" name="salt_intake_after" value="2" <?php if ($this->_tpl_vars['salt_intake_after'] == 2): ?> checked="checked"<?php endif; ?> />中
          <input type="radio" name="salt_intake_after" value="3" <?php if ($this->_tpl_vars['salt_intake_after'] == 3): ?> checked="checked"<?php endif; ?> />重
		  </td>
   	</tr>
   	<tr>
   	  <td align="center">心理调整<img title="根据医生印象选择对应的选项。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['psychology_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','psychology')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		<input type="text" name="psychology" class="inputnew" value="<?php echo $this->_tpl_vars['psychology']; ?>
" />	  </td>
   	</tr>
   	<tr>
   	  <td align="center">遵医行为<img title="指患者是否遵照医生的指导去改善生活方式。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['treatment_compliance_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','treatment_compliance')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		<input type="text" name="treatment_compliance" class="inputnew" value="<?php echo $this->_tpl_vars['treatment_compliance']; ?>
" />	  </td>
   	</tr>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">辅助检查*<img title="记录患者在上次随访到这次随访之间到各医疗机构进行的辅助检查结果。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2"><input type="text" name="auxiliary_check" class="inputnone1" value="<?php echo $this->_tpl_vars['auxiliary_check']; ?>
"></td>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">服药依从性<img title="“规律”为按医嘱服药，“间断”为未按医嘱服药，频次或数量不足，“不服药”即为医生开了处方，但患者未使用此药。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['medication_compliance_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','medication_compliance')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		<input type="text" name="medication_compliance" class="inputnew" value="<?php echo $this->_tpl_vars['medication_compliance']; ?>
" />	  </td>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">药物不良反应<img title="如果患者服用的降压药物有明显的药物不良反应，具体描述哪种药物，何种不良反应。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['adverse_drug_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','adverse_drug')" class="blur"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		<input type="text" name="adverse_drug_info" id="adverse_drug_info" class="inputbottom" value="<?php echo $this->_tpl_vars['adverse_drug_info']; ?>
" />
		<input type="text" name="adverse_drug" id="adverse_drug" class="inputnew" value="<?php echo $this->_tpl_vars['adverse_drug']; ?>
" onblur="chkadverse()" />	  </td>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">随访分类<img title="根据此次随访时的分类结果，由责任医生在4种分类结果中选择一项在“□”中填上相应的数字。“控制满意”意为血压控制满意，无其他异常、“控制不满意”意为血压控制不满意，无其他异常、“不良反应”意为存在药物不良反应、“并发症”意为出现新的并发症或并发症出现异常。如果患者同时并存几种情况，填写最严重的一种情况，同时结合上次随访情况确定患者下次随访时间，并告知患者。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
	  	<?php $_from = $this->_tpl_vars['follow_up_result_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','follow_up_result')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		<input type="text" name="follow_up_result" class="inputnew" value="<?php echo $this->_tpl_vars['follow_up_result']; ?>
" />	  </td>
   	</tr>
   	<tr>
   	  <td rowspan="8"><p>用</p>
      <p>药</p>
      <p>情</p>
      <p>况<img title="根据患者整体情况，为患者开具处方，并填写在表格中，写明用法、用量。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></p></td>
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
	  <?php if ($this->_sections['drug_show']['rownum'] == 1): ?>
      <td align="center">药物名称<?php echo $this->_sections['drug_show']['rownum']; ?>
</td>
      <td colspan="2"><input type="hidden" name="drug_uuid[]" class="inputnone1" value="<?php echo $this->_tpl_vars['drug'][$this->_sections['drug_show']['index']]['drug_uuid']; ?>
" />
	  <input type="text" name="drug_name[]" class="inputnone1" value="<?php echo $this->_tpl_vars['drug'][$this->_sections['drug_show']['index']]['drug_name']; ?>
"></td>
	</tr>
   	<tr>
   	  <td align="center">用法用量</td>
       <td>每日<input type="text" name="drug_frequency[]" class="inputs" value="<?php echo $this->_tpl_vars['drug'][$this->_sections['drug_show']['index']]['drug_frequency']; ?>
">次</td>
   	  <td>每次<input type="text" name="drug_amount[]" class="inputs" value="<?php echo $this->_tpl_vars['drug'][$this->_sections['drug_show']['index']]['drug_amount']; ?>
">mg</td>
	</tr>
	<?php elseif ($this->_sections['drug_show']['rownum'] > 1 && $this->_sections['drug_show']['rownum'] < 4): ?>
   		<tr>
      <td align="center">药物名称<?php echo $this->_sections['drug_show']['rownum']; ?>
</td>
      <td colspan="2"><input type="hidden" name="drug_uuid[]" class="inputnone1" value="<?php echo $this->_tpl_vars['drug'][$this->_sections['drug_show']['index']]['drug_uuid']; ?>
" />
      	<input type="text" name="drug_name[]" class="inputnone1" value="<?php echo $this->_tpl_vars['drug'][$this->_sections['drug_show']['index']]['drug_name']; ?>
"></td>
	</tr>
   	<tr>
   	  <td align="center">用法用量</td>
       <td>每日<input type="text" name="drug_frequency[]" class="inputs" value="<?php echo $this->_tpl_vars['drug'][$this->_sections['drug_show']['index']]['drug_frequency']; ?>
">次</td>
   	  <td>每次<input type="text" name="drug_amount[]" class="inputs" value="<?php echo $this->_tpl_vars['drug'][$this->_sections['drug_show']['index']]['drug_amount']; ?>
">mg</td>
	</tr>
	<?php elseif ($this->_sections['drug_show']['rownum'] == 4): ?>
   	<tr>
      <td align="center">其他药物</td>
      <td colspan="2"><input type="hidden" name="drug_uuid[]" class="inputnone1" value="<?php echo $this->_tpl_vars['drug'][$this->_sections['drug_show']['index']]['drug_uuid']; ?>
" />
      	<input type="text" name="drug_name[]" class="inputnone1" value="<?php echo $this->_tpl_vars['drug'][$this->_sections['drug_show']['index']]['drug_name']; ?>
"></td>
	</tr>
   	<tr>
   	  <td align="center">用法用量</td>
       <td>每日<input type="text" name="drug_frequency[]" class="inputs" value="<?php echo $this->_tpl_vars['drug'][$this->_sections['drug_show']['index']]['drug_frequency']; ?>
">次</td>
   	  <td>每次<input type="text" name="drug_amount[]" class="inputs" value="<?php echo $this->_tpl_vars['drug'][$this->_sections['drug_show']['index']]['drug_amount']; ?>
">mg</td>
	</tr>
	<?php endif; ?>
	<?php endfor; endif; ?>
   	<tr>
   	  <td rowspan="2" align="center">转诊<img title="如果转诊要写明转诊的医疗机构及科室类别，如××市人民医院心内科，并在原因一栏写明转诊原因。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td align="center">原因</td>
      <td colspan="2"><input type="text" name="referral_reason" class="inputnone1" value="<?php echo $this->_tpl_vars['referral_reason']; ?>
"></td>
   	</tr>
   	<tr>
   	  <td align="center">机构及科别</td>
   	  <td colspan="2"><input type="text" name="organization" class="inputnone1" value="<?php echo $this->_tpl_vars['organization']; ?>
"></td>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">下次随访日期<img title="根据患者此次 随访分类，确定下次随访日期，并告知患者。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2"><input type="text" name="follow_next_time" class="inputnone1" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd'})" value="<?php echo $this->_tpl_vars['follow_next_time']; ?>
"><span id="week"></span></td>
   	</tr>
    <tr>
   	  <td colspan="2" align="center">随访结果</td>
      <td colspan="2"><textarea name="follow_result" rows="5" cols="60"><?php echo $this->_tpl_vars['follow_result']; ?>
</textarea></td>
   	</tr>
   	<tr>
   	  <td colspan="2" align="center">随访医生签名<img title="随访完毕，核查无误后随访医生签署其姓名。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="2">
      	<select name="staff_id" id="staff_id">
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
			<option value="<?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['id']; ?>
" <?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['response_doctor'][$this->_sections['response_doctor']['index']]['zh_name']; ?>
</option>
			<?php endfor; endif; ?>
		</select></td>
   	</tr>
	<tr class="endbg">
		<td height="33" colspan="10" align="center">
            <input type="hidden" id="refer" name="refer" value="" />
			<input type="submit" class="inputnone_more"  value="保存" <?php echo $this->_tpl_vars['ajax_save_disabled']; ?>
 />
            &nbsp;
            <input type="button" name="return" id="return" value="返回列表" class="inputbutton" onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/index';" />
            <?php if ($this->_tpl_vars['uuid']): ?>
        &nbsp;<input type="button" name="print" id="print" value="打印" class="inputbutton" onclick="javascript:window.print();" />
        <?php endif; ?>
        <?php echo $this->_tpl_vars['error_string']; ?>

	  </td>
	</tr>
    <tr>
    <td colspan="10">
    <span style="font-weight: bold;font-size: 14px;">填表说明</span><br />
1．本表为高血压患者在接受随访服务时由医生填写。每年的健康体检后填写城乡居民健康档案管理服务规范的健康体检表。<br />
2．体征：体质指数=体重（kg）/身高的平方（m2），体重和体质指数斜线前填写目前情况，斜线后下填写下次随访时应调整到的目标。如果 是超重或是肥胖的高血压患者，要求每次随访时测量体重并指导患者控制体重；正常体重人群可每年测量一次体重及体质指数。如有其他阳性体征，请填写在“其他”一栏。<br />
3．生活方式指导：在询问患者生活方式时，同时对患者进行生活方式指导，与患者共同制定下次随访目标。<br />
日吸烟量：斜线前填写目前吸烟量，不吸烟填“0”，吸烟者写出每天的吸烟量“××支”，斜线后填写吸烟者下次随访目标吸烟量“××支”。<br />
日饮酒量：斜线前填写目前饮酒量，不饮酒填“0”，饮酒者写出每天的饮酒量相当于白酒“××两”，斜线后填写饮酒者下次随访目标饮酒量相当于白酒“××两”。白酒1两相当于葡萄酒4两，黄酒半斤，啤酒1瓶，果酒4两。<br />
运动：填写每周几次，每次多少分钟。即“××次／周，××分钟／次”。横线上填写目前情况，横线下填写下次随访时应达到的目标。<br />
摄盐情况：斜线前填写目前摄盐的咸淡情况 。根据患者饮食的摄盐情况，按咸淡程度在列出的“轻、中、重”之一上划“√”分类，斜线后填写患者下次随访目标摄盐情况。<br />
心理调整：根据医生印象选择对应的选项。<br />
遵医行为：指患者是否遵照医生的指导去改善生活方式。<br />
4．辅助检查：记录患者在上次随访到这次随访之间到各医疗机构进行的辅助检查结果。<br />
5．服药依从性：“规律”为按医嘱服药，“间断”为未按医嘱服药，频次或数量不足，“不服药”即为医生开了处方，但患者未使用此药。<br />
6．药物不良反应：如果患者服用的降压药物有明显的药物不良反应，具体描述哪种药物，何种不良反应。<br />
7．此次随访分类：根据此次随访时的分类结果，由随访 医生在4种分类结果中选择一项在“□”中填上相应的数字。“控制满意”意为血压控制满意，无其他异常、“控制不满意”意为血压控制不满意，无其他异常、“不良反应”意为存在药物不良反应、“并发症”意为出现新的并发症或并发症出现异常。如果患者同时并存几种情况，填写最严重的一种情况，同时结合上次随访情况确定患者下次随访时间，并告知患者。<br />
8．用药情况：根据患者整体情况，为患者开具处方，并填写在表格中，写明用法、用量。<br />
9．转诊：如果转诊要写明转诊的医疗机构及科室类别，如××市人民医院心内科，并在原因一栏写明转诊原因。<br />
10.下次随访日期：根据患者此次 随访分类，确定下次随访日期，并告知患者。<br />
11.随访医生签名：随访完毕，核查无误后随访医生签署其姓名。<br />
</td>
    </tr>
   </table>
</form>
<div id="blood_popup" style="display:none;">
</div> 
</body>
</html>