<?php /* Smarty version 2.6.14, created on 2013-09-26 14:53:49
         compiled from experience_table.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'experience_table.html', 1589, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/popup.js" type="text/javascript"></script>
<script type="text/javascript">
// JavaScript Document
$(document).ready(function(){
	//检查项目
	var symptom_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['symptom_options_json']; ?>
');
	$("input[name='symptom[]']").each(function(){
		var symptom_val=$(this).val();
		if(symptom_val!="" && symptom_array[symptom_val][0]=="-99"){
			$("#symptom_other").attr("disabled",false);
		}
		$(this).blur(function(){
			$i=0;
			$("input[name='symptom[]']").each(function(){
				var input_val=$(this).val();
				//alert(input_val);
				if($i==9){
					$("#symptom_other").val("");
				}
				//当symptom_array[input_val]未定义时，清空当前输入内容
				if(input_val!="" && typeof(symptom_array[input_val])=="undefined"){
					$(this).val('');
					return false;
				}
				if(input_val!="" && symptom_array[input_val][0]=="-99")
				{
					$("#symptom_other").attr("disabled",false);
					//alert($("#symptom_other").val());
					if($("#symptom_other").val()=="")
					{
						$("#symptom_other").focus();
					}
					return false;//只要出现了其他项
				}else{

					$("#symptom_other").attr("disabled",true);
					$i++;
				}

			});
		});
	});

	//老年人认知功能
	control_enable('mmse','older_cognitive_functions',2);
	//老年情感状态
	control_enable('depression','older_affective_state',2);
	//饮食习惯
	var food_habit_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['foot_habit_json']; ?>
');
	$("input[name='food_habit[]']").each(function(){
		var food_habit_val=$(this).val();
		$(this).blur(function(){
			$("input[name='food_habit']").each(function(){
				var input_val=$(this).val();
				//当food_habit_array[input_val]未定义时，清空当前输入内容
				if(input_val!="" && typeof(food_habit_array[input_val])=="undefined"){
					$(this).val('');
					return false;
				}
			})
		})
	});
	
	//体育锻炼
	obj_enable_true('sport_frequence',4,['sport_time','exercise_duration','exercising_way']);	
	//吸烟情况
	var smoke_val=$("#smoke").val();
	if(smoke_val=='1'){
		obj_enable_true('smoke',1,['smoke_quantity','begin_smoke_age','stop_smoke_age']);//不吸烟
	}else if(smoke_val=='3'){		
		obj_enable_false('smoke',3,['smoke_quantity','begin_smoke_age']);//吸烟
	}else if(smoke_val=='2'){
		obj_enable_false('smoke',2,['begin_smoke_age','stop_smoke_age']);//已戒烟
	}
	//吸烟情况失去焦点
	$("#smoke").blur(function(){
		var smoke_val=$("#smoke").val();		
		if(smoke_val=='1'){			
			obj_enable_true('smoke',1,['smoke_quantity','begin_smoke_age','stop_smoke_age']);//不吸烟
		}else if(smoke_val=='3'){		
			obj_enable_false('smoke',1,['smoke_quantity','begin_smoke_age','stop_smoke_age']);//先禁用所有的
			obj_enable_false('smoke',3,['smoke_quantity','begin_smoke_age']);//吸烟启用
		}else{
			obj_enable_false('smoke',1,['smoke_quantity','begin_smoke_age','stop_smoke_age']);//先禁用所有的
			obj_enable_false('smoke',2,['begin_smoke_age','stop_smoke_age']);//已戒烟启用
		}
	});
	//是否戒酒
	control_enable('stop_drinking_age','drink',2);
	//职业暴露处理disabled
	control_enable('chemistry_protection_info','chemistry_protection',2);
	control_enable('pest_protection_info','pest_protection','2');
	control_enable('ray_protection_info','ray_protection','2');
	control_enable('physical_protection_info','physical_protection','2');
	control_enable('dust_protection_info','dust_protection','2');
	control_enable('other_types_info','other_types_protection','2');
	//皮肤
	control_enable_lone('skin_other','skin','<?php echo $this->_tpl_vars['skin_options_json']; ?>
');
	//巩膜
	control_enable_lone('sclera_other','sclera','<?php echo $this->_tpl_vars['et_sclera_json']; ?>
');
	//淋巴结
	control_enable_lone('lymph_node_other','lymph_node','<?php echo $this->_tpl_vars['et_lymph_json']; ?>
');
	//呼吸音
	control_enable('lung_sounds_exception','lung_sounds','2');
	//罗音
	control_enable_lone('lung_rale_other','lung_rale','<?php echo $this->_tpl_vars['et_lung_json']; ?>
');
	//杂音
	control_enable('heart_noise_info','heart_noise','2');
	//压痛
	control_enable('abdominal_tenderness_info','abdominal_tenderness','2');
	//包块
	control_enable('abdominal_mass_info','abdominal_mass','2');	
	//肝大
	control_enable('abdominal_hepatomegaly_info','abdominal_hepatomegaly','2');	
	//脾大
	control_enable('abdominal_splenomegaly_info','abdominal_splenomegaly','2');
	//移动性浊音
	control_enable('shifting_dullness_info','shifting_dullness','2');
	//肛门指诊
	control_enable_lone('rectal_touch_other','rectal_touch','<?php echo $this->_tpl_vars['rectal_touch_json']; ?>
');
	//外阴
	control_enable('gynae_vulva_exception','gynae_vulva','2');
	//阴道
	control_enable('gynae_cunt_exception','gynae_cunt','2');
	//宫颈
	control_enable('gynae_cervix_exception','gynae_cervix','2');
	//宫体
	control_enable('gynae_uterus_exception','gynae_uterus','2');
	//附件
	control_enable('gynae_appendix_exception','gynae_appendix','2');
	//眼底
	control_enable('veryfundus','fundus','2');
	//心电图
	control_enable('veryecg','ecg','2');
	//胸部X线片
	control_enable('veryxrayfilm','xrayfilm','2');
	//B 超
	control_enable('verybc','bc','2');
	//宫颈涂片
	control_enable('verycsmear','csmear','2');
	//神经系统疾病
	control_enable('nervousdisease_other','nervousdisease_status','2');
	//其他系统疾病
	control_enable('otherdisease_other','otherdisease_status','2');
	//职业暴露
	control_enable_new('occupation','occupation_age','occupation_status','2');
	//饮酒种类
	var drink_style_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['drink_style_json']; ?>
');
	$("input[name='drink_style[]']").each(function(){
		var drink_style_val=$(this).val();
		if(drink_style_val!="" && drink_style_array[drink_style_val][0]=="-99"){
			$("#drink_style_other").attr("disabled",false);
		}
		$(this).blur(function(){

			$("input[name='drink_style[]']").each(function(){
				var input_val=$(this).val();
				//当drink_style_array[input_val]未定义时，清空当前输入内容
				if(input_val!="" && typeof(drink_style_array[input_val])=="undefined"){
					$(this).val('');
					return false;
				}
				if(input_val!="" && drink_style_array[input_val][0]=="-99")
				{
					$("#drink_style_other").attr("disabled",false);

					if($("#drink_style_other").val()=="")
					{
						$("#drink_style_other").focus();
					}
					return false;//只要出现了其他项
				}else{

					$("#drink_style_other").attr("disabled",true);

				}
			});
		});
	});
	//齿列
	var dentition_val=$("#dentition").val();
	if(dentition_val==2){

		$("input[name='dentition_missing_teeth[]']").each(function(){
			$(this).attr("disabled",false);
		});
	}else if(dentition_val==3){
		$("input[name='dentition_decayed_tooth[]']").each(function(){
			$(this).attr("disabled",false);
		});
	}else if(dentition_val==4){
		$("input[name='dentition_false_tooth[]']").each(function(){
			$(this).attr("disabled",false);
		});
	}
	//齿列失去焦点
	$("#dentition").blur(function(){
		var dentition_val=$(this).val();
		var j=0;
		if(dentition_val==2){
			$("input[name='dentition_missing_teeth[]']").each(function(){
				if(j==0){
					$(this).focus();
					j++;				}
				$(this).attr("disabled",false);
			});

			$("input[name='dentition_decayed_tooth[]']").each(function(){
				$(this).attr("disabled",true);
			});
			$("input[name='dentition_false_tooth[]']").each(function(){
				$(this).attr("disabled",true);
			});
		}else if(dentition_val==3){
			$("input[name='dentition_decayed_tooth[]']").each(function(){
				if(j==0){
					$(this).focus();
					j++;
				}
				$(this).attr("disabled",false);
			});

			$("input[name='dentition_missing_teeth[]']").each(function(){
				$(this).attr("disabled",true);
			});
			$("input[name='dentition_false_tooth[]']").each(function(){
				$(this).attr("disabled",true);
			});
		}else if(dentition_val==4){
			$("input[name='dentition_false_tooth[]']").each(function(){
				if(j==0){
					$(this).focus();
					j++;
				}
				$(this).attr("disabled",false);
			});

			$("input[name='dentition_missing_teeth[]']").each(function(){
				$(this).attr("disabled",true);
			});
			$("input[name='dentition_decayed_tooth[]']").each(function(){
				$(this).attr("disabled",true);
			});
		}else if(dentition_val==1){
			
		}else{//验证
			$(this).val('');
		}
	});
	//脑血管疾病
	var ceredisease_status_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['ceredisease_status_json']; ?>
');
	$("input[name='ceredisease_status[]']").each(function(){
		var ceredisease_status_val=$(this).val();
		if(ceredisease_status_val!="" && ceredisease_status_array[ceredisease_status_val][0]=="-99"){
			$("#ceredisease_other").attr("disabled",false);
		}
		$(this).blur(function(){

			$("input[name='ceredisease_status[]']").each(function(){
				var input_val=$(this).val();
				//合法性验证,清空当前输入内容
				if(input_val!="" && typeof(ceredisease_status_array[input_val])=="undefined"){
					$(this).val('');
					return false;
				}
				if(input_val!="" && ceredisease_status_array[input_val][0]=="-99")
				{
					$("#ceredisease_other").attr("disabled",false);

					if($("#ceredisease_other").val()=="")
					{
						$("#ceredisease_other").focus();
					}
					return false;//只要出现了其他项
				}else{

					$("#ceredisease_other").attr("disabled",true);

				}
			});
		});
	});
	
	//肾脏疾病
	var kidneydisease_status_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['kidneydisease_status_json']; ?>
');
	$("input[name='kidneydisease_status[]']").each(function(){
		var kidneydisease_status_val=$(this).val();
		if(kidneydisease_status_val!="" && kidneydisease_status_array[kidneydisease_status_val][0]=="-99"){
			$("#kidneydisease_other").attr("disabled",false);
		}
		$(this).blur(function(){

			$("input[name='kidneydisease_status[]']").each(function(){
				var input_val=$(this).val();
				//合法性验证,清空当前输入内容
				if(input_val!="" && typeof(kidneydisease_status_array[input_val])=="undefined"){
					$(this).val('');
					return false;
				}
				if(input_val!="" && kidneydisease_status_array[input_val][0]=="-99")
				{
					$("#kidneydisease_other").attr("disabled",false);

					if($("#kidneydisease_other").val()=="")
					{
						$("#kidneydisease_other").focus();
					}
					return false;//只要出现了其他项
				}else{

					$("#kidneydisease_other").attr("disabled",true);

				}
			});
		});
	});
	//心脏疾病
	var heartdisease_status_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['heartdisease_status_json']; ?>
');
	$("input[name='heartdisease_status[]']").each(function(){
		var heartdisease_status_val=$(this).val();
		if(heartdisease_status_val!="" && heartdisease_status_array[heartdisease_status_val][0]=="-99"){
			$("#heartdisease_other").attr("disabled",false);
		}
		$(this).blur(function(){

			$("input[name='heartdisease_status[]']").each(function(){
				var input_val=$(this).val();
				//合法性验证,清空当前输入内容
				if(input_val!="" && typeof(heartdisease_status_array[input_val])=="undefined"){
					$(this).val('');
					return false;
				}
				if(input_val!="" && heartdisease_status_array[input_val][0]=="-99")
				{
					$("#heartdisease_other").attr("disabled",false);

					if($("#heartdisease_other").val()=="")
					{
						$("#heartdisease_other").focus();
					}
					return false;//只要出现了其他项
				}else{

					$("#heartdisease_other").attr("disabled",true);

				}
			});
		});
	});
	//血管疾病
	var vasculardisease_status_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['vasculardisease_status_json']; ?>
');
	$("input[name='vasculardisease_status[]']").each(function(){
		var vasculardisease_status_val=$(this).val();
		if(vasculardisease_status_val!="" && vasculardisease_status_array[vasculardisease_status_val][0]=="-99"){
			$("#vasculardisease_other").attr("disabled",false);
		}
		$(this).blur(function(){

			$("input[name='vasculardisease_status[]']").each(function(){
				var input_val=$(this).val();
				//合法性验证,清空当前输入内容
				if(input_val!="" && typeof(vasculardisease_status_array[input_val])=="undefined"){
					$(this).val('');
					return false;
				}
				if(input_val!="" && vasculardisease_status_array[input_val][0]=="-99")
				{
					$("#vasculardisease_other").attr("disabled",false);

					if($("#vasculardisease_other").val()=="")
					{
						$("#vasculardisease_other").focus();
					}
					return false;//只要出现了其他项
				}else{

					$("#vasculardisease_other").attr("disabled",true);

				}
			});
		});
	});
	//乳腺
	var mammary_gland_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['mammary_gland_json']; ?>
');
	//alert(mammary_gland_array);
	$("input[name='mammary_gland[]']").each(function(){
		var mammary_gland_val=$(this).val();
		if(mammary_gland_val!="" && mammary_gland_array[mammary_gland_val][0]=="-99"){
			$("#mammary_gland_other").attr("disabled",false);
		}
		$(this).blur(function(){

			$("input[name='mammary_gland[]']").each(function(){
				var input_val=$(this).val();
			//	alert(input_val);
				//合法性验证,清空当前输入内容
				if(input_val!="" && typeof(mammary_gland_array[input_val])=="undefined"){
					$(this).val('');
					return false;
				}
				if(input_val!="" && mammary_gland_array[input_val][0]=="-99")
				{
					$("#mammary_gland_other").attr("disabled",false);

					if($("#mammary_gland_other").val()=="")
					{
						$("#mammary_gland_other").focus();
					}
					return false;//只要出现了其他项
				}else{

					$("#mammary_gland_other").attr("disabled",true);

				}
			});
		});
	});
	//眼部疾病
	var eyedisease_status_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['et_eyedisease_json']; ?>
');
	$("input[name='eyedisease_status[]']").each(function(){
		var eyedisease_status_val=$(this).val();
		if(eyedisease_status_val!="" && eyedisease_status_array[eyedisease_status_val][0]=="-99"){
			$("#eyedisease_other").attr("disabled",false);
		}
		$(this).blur(function(){

			$("input[name='eyedisease_status[]']").each(function(){
				var input_val=$(this).val();
				//合法性验证,清空当前输入内容
				if(input_val!="" && typeof(eyedisease_status_array[input_val])=="undefined"){
					$(this).val('');
					return false;
				}
				if(input_val!="" && eyedisease_status_array[input_val][0]=="-99")
				{
					$("#eyedisease_other").attr("disabled",false);

					if($("#eyedisease_other").val()=="")
					{
						$("#eyedisease_other").focus();
					}
					return false;//只要出现了其他项
				}else{

					$("#eyedisease_other").attr("disabled",true);

				}
			});
		});
	});
	//危险因素控制
	$("input[name='risk_factor_col[]']").each(function(){
		$(this).blur(function(){
			//恢复所有输入框的禁用标志
			$("#lose_weight").attr("disabled", true);
			$("#recommended_vaccination").attr("disabled", true);
			$("#risk_factor_col_other").attr("disabled", true);
			$("input[name='risk_factor_col[]']").each(function(){
				var risk_factor_col_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['risk_factor_col_json']; ?>
');
				var input_val=$(this).val();
				if (input_val != "" && typeof(risk_factor_col_array[input_val])!="undefined") {
					if (input_val != "" && risk_factor_col_array[input_val][0] == "5") {
							//减体重
							$("#lose_weight").attr("disabled", false);
							if ($("#lose_weight").val() == "") {
								$("#lose_weight").focus();
							}
						}
					if (input_val != "" && risk_factor_col_array[input_val][0] == "6") {
							//建议疫苗接种
							$("#recommended_vaccination").attr("disabled", false);
							if ($("#recommended_vaccination").val() == "") {
								$("#recommended_vaccination").focus();
							}
						}
					if (input_val != "" && risk_factor_col_array[input_val][0] == "-99") {
								//其他
								$("#risk_factor_col_other").attr("disabled", false);
								if ($("#risk_factor_col_other").val() == "") {
									$("#risk_factor_col_other").focus();
								}
							}
				}
			});
		});
	});
});
//毒物种类
function getval(getid,inputid,bottomid,inputval,tagid){
	var getnewid = document.getElementById(getid);
	var inputnewid = document.getElementById(inputid);
	// alert(getnewid.value);
	if(getnewid.value==""){
		inputnewid.disabled="disabled";
		getnewid.focus();
		var inputidnew = document.getElementById(inputid);
		var bottomidnew  = document.getElementById(bottomid);
		if(inputval!==tagid&&inputval!==""){
			bottomidnew.disabled="disabled";
		}
		inputidnew.value="";
		return false;
	}else{
		var inputidnew = document.getElementById(inputid);
		var bottomidnew  = document.getElementById(bottomid);
		inputidnew.value = inputval;
		if(inputval!==tagid&&inputval!==""){
			bottomidnew.disabled="disabled";
			bottomidnew.value="";
		}else{
			bottomidnew.disabled="";
			bottomidnew.focus();
		}
		inputnewid.disabled="";
	}
}
function checktxet(getid,inputid,bottomid){
	var getnewid = document.getElementById(getid);
	var inputnewid = document.getElementById(inputid);
	var bottomidnew  = document.getElementById(bottomid);
	if(getnewid.value==""){
		inputnewid.disabled="disabled";
		inputnewid.value="";
		bottomidnew.disabled="disabled";
		bottomidnew.value="";
	}
}
//皮肤
function sink(inputval,inputnew,bottomid){
	var et_skin_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['skin_options_json']; ?>
');
	var inputid = document.getElementById(inputnew);
	var bottomnow = document.getElementById(bottomid);
	inputid.value = inputval;
	//alert(et_skin_array[inputval][0]);
	if(inputval="" || et_skin_array[inputval][0]!=="-99"){
		bottomnow.disabled = "disabled";
	}else{
		bottomnow.disabled = "";
		bottomnow.focus();
	}
}
//巩膜
function et_sclera(inputval,inputnew,bottomid){
	var et_sclera_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['et_sclera_json']; ?>
');
	var inputid = document.getElementById(inputnew);
	var bottomnow = document.getElementById(bottomid);
	inputid.value = inputval;
	//alert(et_sclera_array[inputval][0]);
	if(inputval="" || et_sclera_array[inputval][0]!=="-99"){
		bottomnow.disabled = "disabled";
	}else{
		bottomnow.disabled = "";
		bottomnow.focus();
	}
}
//淋巴结
function et_lymph(inputval,inputnew,bottomid){
	var et_lymph_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['et_lymph_json']; ?>
');
	var inputid = document.getElementById(inputnew);
	var bottomnow = document.getElementById(bottomid);
	inputid.value = inputval;
	//alert(et_lymph_array[inputval][0]);
	if(inputval=="" || et_lymph_array[inputval][0]!=="-99"){
		bottomnow.disabled = "disabled";
	}else{
		bottomnow.disabled = "";
		bottomnow.focus();
	}
}
//罗音
function et_lung(inputval,inputnew,bottomid){
	var et_lung_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['et_lung_json']; ?>
');
	var inputid = document.getElementById(inputnew);
	var bottomnow = document.getElementById(bottomid);
	inputid.value = inputval;
	//alert(et_lung_array[inputval][0]);
	if(inputval=="" || et_lung_array[inputval][0]!=="-99"){
		bottomnow.disabled = "disabled";
	}else{
		bottomnow.disabled = "";
		bottomnow.focus();
	}
}
//肛门指诊
function rectal_touch_new(inputval,inputnew,bottomid){
	var rectal_touch_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['rectal_touch_json']; ?>
');
	var inputid = document.getElementById(inputnew);
	var bottomnow = document.getElementById(bottomid);
	inputid.value = inputval;
	//alert(inputval);
	if(inputval==""||rectal_touch_array[inputval][0]!=="-99"){
		bottomnow.disabled = "disabled";
	}else{
		bottomnow.disabled = "";
		bottomnow.focus();
	}
}
function skinget(inputid,bottomid,inputval,inputag){
	var inputnew = document.getElementById(inputid);
	var bottomid = document.getElementById(bottomid);
	inputnew.value = inputval;
	if(inputval==""||inputval!==inputag){
		bottomid.disabled="disabled";
	}else{
		bottomid.disabled="";
		bottomid.focus();
	}
}
//职业暴露顶部的
function occp(inputid,firstid,endid,inputval){
	var inputidnow = document.getElementById(inputid);
	var firstidnow = document.getElementById(firstid);
	var endidnow   = document.getElementById(endid);
	inputidnow.value = inputval;
	//alert(inputval);
	if(inputval=='2'){
		firstidnow.disabled="";
		endidnow.disabled ="";
		firstidnow.focus();
		}else{
		firstidnow.disabled="disabled";
		endidnow.disabled ="disabled";
			}
}
//皮肤
function loadinput(inputid,bottomid){
	var inputnewid  = document.getElementById(inputid);
	var bottomnewid = document.getElementById(bottomid);
	var jsonarray   = jQuery.parseJSON('<?php echo $this->_tpl_vars['skin_options_json']; ?>
');
	//alert(jsonarray[inputnewid.value]);
	if(inputnewid.value==""||jsonarray[inputnewid.value]==undefined){
		inputnewid.value="";
		bottomnewid.disabled="disabled";
		return false;
	}
	if(jsonarray[inputnewid.value][0]=="-99"){
		bottomnewid.disabled="";
		bottomnewid.focus();
		}else{
	    bottomnewid.disabled="disabled";
			}
}
//巩膜
function loadinput_gm(inputid,bottomid){
	var inputnewid  = document.getElementById(inputid);
	var bottomnewid = document.getElementById(bottomid);
	var jsonarray   = jQuery.parseJSON('<?php echo $this->_tpl_vars['et_sclera_json']; ?>
');
	//alert(jsonarray[inputnewid.value]);
	if(inputnewid.value==""||jsonarray[inputnewid.value]==undefined){
		inputnewid.value="";
		bottomnewid.disabled="disabled";
		return false;
	}
	if(jsonarray[inputnewid.value][0]=="-99"){
		bottomnewid.disabled="";
		bottomnewid.focus();
		}else{
	    bottomnewid.disabled="disabled";
			}
}
//淋巴结
function loadinput_lbj(inputid,bottomid){
	var inputnewid  = document.getElementById(inputid);
	var bottomnewid = document.getElementById(bottomid);
	var jsonarray   = jQuery.parseJSON('<?php echo $this->_tpl_vars['et_lymph_json']; ?>
');
	//alert(jsonarray[inputnewid.value]);
	if(inputnewid.value==""||jsonarray[inputnewid.value]==undefined){
		inputnewid.value="";
		bottomnewid.disabled="disabled";
		return false;
	}
	if(jsonarray[inputnewid.value][0]=="-99"){
		bottomnewid.disabled="";
		bottomnewid.focus();
		}else{
	    bottomnewid.disabled="disabled";
			}
}
//罗音
function loadinput_ly(inputid,bottomid){
	var inputnewid  = document.getElementById(inputid);
	var bottomnewid = document.getElementById(bottomid);
	var jsonarray   = jQuery.parseJSON('<?php echo $this->_tpl_vars['et_lung_json']; ?>
');
	//alert(jsonarray[inputnewid.value]);
	if(inputnewid.value==""||jsonarray[inputnewid.value]==undefined){
		inputnewid.value="";
		bottomnewid.disabled="disabled";
		return false;
	}
	if(jsonarray[inputnewid.value][0]=="-99"){
		bottomnewid.disabled="";
		bottomnewid.focus();
		}else{
	    bottomnewid.disabled="disabled";
			}
}
//肛门指诊
function loadinput_gmzz(inputid,bottomid){
	var inputnewid  = document.getElementById(inputid);
	var bottomnewid = document.getElementById(bottomid);
	var jsonarray   = jQuery.parseJSON('<?php echo $this->_tpl_vars['rectal_touch_json']; ?>
');
	//alert(jsonarray[inputnewid.value]);
	if(inputnewid.value==""||jsonarray[inputnewid.value]==undefined){
		inputnewid.value="";
		bottomnewid.disabled="disabled";
		return false;
	}
	if(jsonarray[inputnewid.value][0]=="-99"){
		bottomnewid.disabled="";
		bottomnewid.focus();
		}else{
	    bottomnewid.disabled="disabled";
			}
}
//没有其他的输入框
function loadinput_lone(inputid,bottomid,inputval){
	var inputnewid  = document.getElementById(inputid);
	var bottomnewid = document.getElementById(bottomid);
	//alert(inputnewid.value);
	if(inputnewid.value==""){
		inputnewid.value="";
		bottomnewid.disabled="disabled";
		return false;
	}
	if(inputnewid.value==inputval){
		bottomnewid.disabled="";
		bottomnewid.focus();
		}else{
	    bottomnewid.disabled="disabled";
			}
}
//健康评价
function checkheal(inputval){
	var val=document.getElementById(inputval);
	if(val.value=="1"){
		for(i=1;i<=4;i++){
			var healthnew = document.getElementById('health_exception'+i);
			healthnew.disabled="disabled";
			healthnew.value='';
			}
		}else{
			for(i=1;i<=4;i++){
				var healthnew = document.getElementById('health_exception'+i);
				healthnew.disabled="";
				}
			}
}
</script>
<title>健康体检</title>
<style type="text/css">
<!--
.STYLE2 {font-size: 18px}
label
{
	cursor:hand;
	cursor: pointer;
}
.text_align_center{
		text-align:center;
	}
	.text_align_right{
		text-align:right;	
	}
	.text_padding_left{
		 padding-left:60px;
	}
	.text_align_left{
		text-align:left;	
	}
-->
</style>
</head>
<body >
<form action="<?php echo $this->_tpl_vars['basePath']; ?>
et/index/update" method="post">
    <input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
"/>
   <table width="100%"  align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
         <tr>
		   <td colspan="7" style="text-align:center; font-size:18px;"><strong>健康体检表<img title="“本表用于居民首次建立健康档案时填写。如果居民的个人信息有所变动，可在原条目处修改，并注明修改时间。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></strong></td>
		 </tr>
	      <tr> 
		   <td colspan="7"  >
		   <div style="width:100%;position:relative;">
			   <div style="float:left;width:49%;">姓名:<?php echo $this->_tpl_vars['user_name']; ?>
</div>
			   <div style="float:left;width:50%;" class="text_align_right">编号:<?php echo $this->_tpl_vars['standard_code']; ?>
</div>
		   </div>
		   </td >
	     </tr>
         <tr>
		     <td colspan="2" >体检日期</td>
			 <td colspan="2" width="80%">
			 <input type="text" name="examination_date_year" class="inputnone4" id="examination_date_year" value="<?php echo $this->_tpl_vars['examination_date_year']; ?>
" onClick="WdatePicker({dateFmt:'yyyy'})"/>年
			 <input type="text" name="examination_date_month" class="inputnone3" id="examination_date_month" value="<?php echo $this->_tpl_vars['examination_date_month']; ?>
" onClick="WdatePicker({dateFmt:'MM'})" />月
			 <input type="text" name="examination_date_day" class="inputnone3" id="examination_date_day" value="<?php echo $this->_tpl_vars['examination_date_day']; ?>
" onClick="WdatePicker({dateFmt:'dd'})" />日			 </td>
			 <td width="12%">责任医生<img title="“此处呈现后台维护好的人员列表，也可自行添加；自行添加的人员自动添加到人员列表中，供以后选择。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
			 <td colspan="2">	
			 
			 <select name="examination_doctor" id="examination_doctor">
			 <option value="">请选择</option>
			 <?php unset($this->_sections['contact']);
$this->_sections['contact']['name'] = 'contact';
$this->_sections['contact']['loop'] = is_array($_loop=$this->_tpl_vars['examination_doctor']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['contact']['show'] = true;
$this->_sections['contact']['max'] = $this->_sections['contact']['loop'];
$this->_sections['contact']['step'] = 1;
$this->_sections['contact']['start'] = $this->_sections['contact']['step'] > 0 ? 0 : $this->_sections['contact']['loop']-1;
if ($this->_sections['contact']['show']) {
    $this->_sections['contact']['total'] = $this->_sections['contact']['loop'];
    if ($this->_sections['contact']['total'] == 0)
        $this->_sections['contact']['show'] = false;
} else
    $this->_sections['contact']['total'] = 0;
if ($this->_sections['contact']['show']):

            for ($this->_sections['contact']['index'] = $this->_sections['contact']['start'], $this->_sections['contact']['iteration'] = 1;
                 $this->_sections['contact']['iteration'] <= $this->_sections['contact']['total'];
                 $this->_sections['contact']['index'] += $this->_sections['contact']['step'], $this->_sections['contact']['iteration']++):
$this->_sections['contact']['rownum'] = $this->_sections['contact']['iteration'];
$this->_sections['contact']['index_prev'] = $this->_sections['contact']['index'] - $this->_sections['contact']['step'];
$this->_sections['contact']['index_next'] = $this->_sections['contact']['index'] + $this->_sections['contact']['step'];
$this->_sections['contact']['first']      = ($this->_sections['contact']['iteration'] == 1);
$this->_sections['contact']['last']       = ($this->_sections['contact']['iteration'] == $this->_sections['contact']['total']);
?>
			 <option value="<?php echo $this->_tpl_vars['examination_doctor'][$this->_sections['contact']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['examination_doctor'][$this->_sections['contact']['index']]['id'] == $this->_tpl_vars['response_doctor']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['examination_doctor'][$this->_sections['contact']['index']]['name_real']; ?>
</option>
			 <?php endfor; endif; ?>
			 </select>
			 </td>
		 </tr>
		 <tr>
		     <td width="12%"  align="center"><strong>内容</strong></td>
			 <td colspan="6"><strong>检查项目</strong></td>
		 </tr>
		 <tr>
		     <td align="center">症状</td>
			 <td colspan="6">
            <?php $_from = $this->_tpl_vars['symptom_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			  <label onclick="set_input_many('<?php echo $this->_tpl_vars['k']; ?>
','symptom[]');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
			<input type="text" name="symptom_other" class="inputbottom"   disabled="disabled" id="symptom_other" value="<?php echo $this->_tpl_vars['symptom_other']; ?>
" />
			 <div align="right">
             <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=10) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		      <input type="text" id="symptom" name="symptom[]"  class="inputnew" value="<?php echo $this->_tpl_vars['symptom_current_code_arr'][$this->_sections['customer']['index']]; ?>
" maxlength="2"/>/
              <?php endfor; endif; ?>
		     </div>
	   	     </td>
		 </tr>
			 <!--一般状况开始-->
	     <tr >
		     <td <?php if ($this->_tpl_vars['mytag']): ?>rowspan="9"<?php else: ?>rowspan="5"<?php endif; ?>>一般状况</td>
			 <td width="15%">体温</td>
		   <td width="10%" ><input type="text" name="temperature" class="inputnone" id="temperature" value="<?php echo $this->_tpl_vars['temperature']; ?>
" />℃</td>
			 <td colspan="2">脉率</td>
			 <td colspan="2"><input type="text" name="pulse" class="inputnone" id="pulse" value="<?php echo $this->_tpl_vars['pulse']; ?>
" />次/分钟</td>
		 </tr>
         <tr >
			 <td rowspan="2">呼吸频率</td>
			 <td rowspan="2"><input type="text" name="breathing_rate" class="inputnone" id="breathing_rate" value="<?php echo $this->_tpl_vars['breathing_rate']; ?>
" />次/分钟</td>
			 <td colspan="2" rowspan="2">血压</td>
			 <td width="12%" >左侧<img title="“前为收缩压，后为舒张压”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
			 <td width="35%" >
		   <input type="text" name="blood_pressure_left_s" class="inputnone" id="blood_pressure_left_s" value="<?php echo $this->_tpl_vars['blood_pressure_left_s']; ?>
" />/<input type="text" name="blood_pressure_left_p" class="inputnone" id="blood_pressure_left_p" value="<?php echo $this->_tpl_vars['blood_pressure_left_p']; ?>
" />mmHg			 </td>
		 </tr>
		<tr>
		    <td>右侧<img title="“前为收缩压，后为舒张压”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		    <td><input type="text" name="blood_pressure_right_s" class="inputnone" id="blood_pressure_right_s" value="<?php echo $this->_tpl_vars['blood_pressure_right_s']; ?>
" />/<input type="text" name="blood_pressure_right_p" class="inputnone" id="blood_pressure_right_p" value="<?php echo $this->_tpl_vars['blood_pressure_right_p']; ?>
" />mmHg		    </td> 
	    </tr>
		<tr>
		  <td>身高</td>
		  <td><input type="text" name="height" class="inputnone1" id="height" value="<?php echo $this->_tpl_vars['height']; ?>
"  onblur="set_bmi('weight','height','bmi');"/>cm</td>
		  <td colspan="2">体重</td>
		  <td colspan="2"><input type="text" name="weight" class="inputnone1" id="weight" value="<?php echo $this->_tpl_vars['weight']; ?>
" onblur="set_bmi('weight','height','bmi');" />kg</td>
		</tr>
		<tr>
		  <td>腰围</td>
		  <td><input type="text" name="waistline" class="inputnone1" id="waistline" value="<?php echo $this->_tpl_vars['waistline']; ?>
"  />cm</td>
		  <td colspan="2">体质指数</td>
		  <td colspan="2"><input type="text" name="bmi" class="inputnone1" id="bmi" value="<?php echo $this->_tpl_vars['bmi']; ?>
"   readonly="readonly"/></td>
		</tr>
		<?php if ($this->_tpl_vars['mytag']): ?>
		<tr>
		  <td>老年人健康状态自我评估*</td>
		  <td colspan="5">
		  <?php $_from = $this->_tpl_vars['elder_health_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		  <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','elder_health_status')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		  <?php endforeach; endif; unset($_from); ?>
		  <input type="text" id="elder_health_status" name="elder_health_status"  class="inputnew" value="<?php echo $this->_tpl_vars['upelder_health_status']; ?>
" />
		  </td>
		</tr>
		<tr>
		  <td>老年人生活自理能力自我评估*</td>
		  <td colspan="5">
		   <?php if ($this->_tpl_vars['totalNumber'] !== ''): ?>
		  <font color="red">老年人生活自理评估表评分总分：<input type="text"  class="inputbottom" value="<?php echo $this->_tpl_vars['totalNumber']; ?>
" readonly="readonly"/>分</font>,<a href="<?php echo $this->_tpl_vars['basePath']; ?>
elder/elder/add/uuid/<?php echo $this->_tpl_vars['lifecaseuuid']; ?>
">查看<font color="red">[<?php echo $this->_tpl_vars['user_name']; ?>
]</font>的评分细项</a>
		  <?php else: ?>
		  当前还没有<font color="red">[<?php echo $this->_tpl_vars['user_name']; ?>
]</font>的老年人生活自理评估表评分总分,<a href="<?php echo $this->_tpl_vars['basePath']; ?>
elder/elder/add/editid/<?php echo $this->_tpl_vars['editid']; ?>
">进入评分</a>
		  <?php endif; ?><br>
		  <?php $_from = $this->_tpl_vars['elder_living_skills']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		  <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','elder_living_skills')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		  <?php endforeach; endif; unset($_from); ?>
		  <input type="text" id="elder_living_skills" name="elder_living_skills"  class="inputnew" value="<?php echo $this->_tpl_vars['upelder_living_skills']; ?>
" /><br>
		  </td>
		</tr>
		<tr>
		  <td>老年人认知功能*<img title="“1.	易智力状态检查，总分  判断年龄，60岁以下灰化；
2.	“简  ”先灰化，如果字段值为“2”再询问是否激活“简易智力状态检查表”；允许不激活，直接填写总分，也可以根据记录情况汇总得到总分，总分可修改
”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		  <td colspan="6" align="left">
		     <?php $_from = $this->_tpl_vars['older_cognitive_functions_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value(<?php echo $this->_tpl_vars['k']; ?>
,'older_cognitive_functions');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>
			,简单智力状态检查,总分<input type="text" name="mmse" id="mmse"  class="inputbottom" value="<?php echo $this->_tpl_vars['mmse']; ?>
" />		  
		   <input type="text" id="older_cognitive_functions" name="older_cognitive_functions"  class="inputnew" value="<?php echo $this->_tpl_vars['older_cognitive_functions_current']; ?>
" onblur="control_enable('mmse','older_cognitive_functions',2);" maxlength="1" /></div><br/>
		  </td>
		</tr>
		<tr>
		  <td>老年情感状态*<img title="“1.判断年龄，60岁以下灰化；
2.“老年人抑郁评分检查，总分    ”先灰化，如果字段值为“2”再询问是否激活“老年人抑郁评分检查表”；允许不激活，直接填写总分，也可以根据记录情况汇总得到总分，总分可修改。
”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		  <td colspan="6" align="left">
		     <?php $_from = $this->_tpl_vars['older_cognitive_functions_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value(<?php echo $this->_tpl_vars['k']; ?>
,'older_affective_state');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>
			,性老年人抑郁评分检查,总分<input type="text" name="depression" id="depression"  class="inputbottom" value="<?php echo $this->_tpl_vars['depression']; ?>
"/>	
			<input type="text" onblur="control_enable('depression','older_affective_state',2);" id="older_affective_state" name="older_affective_state"  class="inputnew" value="<?php echo $this->_tpl_vars['older_affective_state_current']; ?>
" maxlength="1" /></div><br/>
		  </td>
		</tr>
		<?php endif; ?>
		<!--一般状况结束-->
		<!--生活方式开始-->
		<tr>
		  <td rowspan="13" width="12%">生活方式</td>
		  <td rowspan="3">体育锻炼<img title="“体育锻炼：指主动锻炼，即有意识地为强体健身而进行的活动。不包括因工作或其他需要而必须进行的活动，如为上班骑自行车、做强体力工作等。锻炼方式填写最常采用的具体锻炼方式。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		  <td>锻炼频率</td>
		  <td colspan="4" align="left">
		  <?php $_from = $this->_tpl_vars['sport_frequence_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','sport_frequence')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>
		  <div align="right">
		  <input type="text" id="sport_frequence" name="sport_frequence"  class="inputnew" value="<?php echo $this->_tpl_vars['sport_frequence_current']; ?>
" onblur="obj_enable_true('sport_frequence',4,['sport_time','exercise_duration','exercising_way'])" maxlength="1" />
		  </div>
		  </td>
		</tr>
		<tr>
		   <td>每次锻炼时间</td>
		   <td colspan="2"><input type="text" name="sport_time" disabled="disabled" class="inputnone" id="sport_time" value="<?php echo $this->_tpl_vars['sport_time']; ?>
"/>分钟</td>
		   <td>坚持锻炼时间</td>
		   <td><input type="text" name="exercise_duration" disabled="disabled" class="inputnone" id="exercise_duration" value="<?php echo $this->_tpl_vars['exercise_duration']; ?>
"/>年</td>
		</tr>
		<tr>
		  <td>锻炼方式</td>
		  <td colspan="4"><input type="text" name="exercising_way" disabled="disabled" class="inputnone1" id="exercising_way" value="<?php echo $this->_tpl_vars['exercising_way']; ?>
"/></td>
	     </tr>
		 <tr>
		   <td>饮食习惯</td>
		   <td colspan="5" align="left">
		     <?php $_from = $this->_tpl_vars['food_habit_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_many('<?php echo $this->_tpl_vars['k']; ?>
','food_habit[]')" ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>
		     <div align="right">
		     <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
             <input type="text" id="food_habit" name="food_habit[]"  class="inputnew" value="<?php echo $this->_tpl_vars['foot_habit_current'][$this->_sections['customer']['index']]; ?>
" maxlength="1" />/
             <?php endfor; endif; ?>
             </div></td>             
	     </tr> 
		 <tr>
		   <td rowspan="3">吸烟情况<img title="“吸烟情况：“从不吸烟者”不必填写“日吸烟量”、“开始吸烟年龄”、“戒烟年龄”等。”
2.“日吸烟量”、“开始吸烟年龄”、“戒烟年龄”先灰化；“吸烟状况”如选“2”，则激活“开始吸烟年龄”和“戒烟年龄”；“吸烟状况”如选“3”，则激活“日吸烟量”和“开始吸烟年龄”。
”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <td>吸烟状况</td>
		   <td colspan="4" align="left"> 
		   <?php $_from = $this->_tpl_vars['smoke_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label  onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','smoke')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?><div align="right">
           <input type="text" id="smoke" name="smoke"  class="inputnew" value="<?php echo $this->_tpl_vars['smoke_current']; ?>
"  maxlength="1" />
           </div></td>
	     </tr>
		 <tr>
		    <td height="21">日吸烟量</td>
			<td colspan="4" align="left">平均
			  <input type="text" name="smoke_quantity" class="inputnone"  disabled="disabled" id="smoke_quantity" value="<?php echo $this->_tpl_vars['smoke_quantity1']; ?>
"/>
		    支</td>
		 </tr>
		 <tr>
		   <td>开始吸烟年龄</td>
		   <td width="12%"><input type="text" name="begin_smoke_age" disabled="disabled"  class="inputnone" id="begin_smoke_age" value="<?php echo $this->_tpl_vars['begin_smoke_age1']; ?>
"/>岁</td>
		   <td colspan="2">戒烟年龄</td>
		   <td><input type="text" name="stop_smoke_age" class="inputnone" disabled="disabled"  id="stop_smoke_age" value="<?php echo $this->_tpl_vars['stop_smoke_age1']; ?>
"/>
	       岁</td>
		 </tr>
		 <tr>
		   <td rowspan="5">饮酒情况<img title="“从不饮酒者”不必填写其他有关饮酒情况项目。“日饮酒量”应折合相当于白酒“××两”。白酒1两折合葡萄酒4两、黄酒半斤、啤酒1瓶、果酒4两。
2.	除“饮酒频率”外，其余字段先灰化；如果值不为“1”，再激活
3.	“是否戒酒”的“戒酒年龄：      岁”先灰化，值为“2”时再激活。
”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <td>饮酒频率</td>
		   <td colspan="5" align="left">
		   <?php $_from = $this->_tpl_vars['drink_frequency_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label  onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','drink_frequency')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>
		   <div align="right">
           <input type="text" id="drink_frequency" name="drink_frequency"  class="inputnew" value="<?php echo $this->_tpl_vars['drink_frequency_current']; ?>
" onblur="obj_enable_true('drink_frequency',1,['drink_quantity','drink','begin_drinking_age','last_year_ntoxication','drink_style0','drink_style1']);" maxlength="1" />
           </div></td>
	     </tr>
		 <tr>
		   <td>日饮酒量</td>
		   <td colspan="5" align="left">平均
		     <input type="text" name="drink_quantity" class="inputnone" id="drink_quantity" value="<?php echo $this->_tpl_vars['drink_quantity']; ?>
"/>
	       两</td>
	     </tr>
		 <tr>
		    <td>是否戒酒</td>
			<td colspan="5" align="left">
			<?php $_from = $this->_tpl_vars['drink_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label   onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','drink')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?> ,戒酒年龄： 
		    <input type="text" name="stop_drinking_age" id="stop_drinking_age"  class="inputbottom" value="<?php echo $this->_tpl_vars['stop_drinking_age']; ?>
"/>
		    岁
		    <div align="right">
            <input type="text" id="drink" name="drink"  class="inputnew" value="<?php echo $this->_tpl_vars['drink_current']; ?>
" onblur="control_enable('stop_drinking_age','drink',2);" maxlength="1" />
            </div></td>
		 </tr>
		 <tr>
		   <td>开始饮酒年龄</td>
		   <td><input type="text" name="begin_drinking_age" class="inputnone" id="begin_drinking_age" value="<?php echo $this->_tpl_vars['begin_drinking_age']; ?>
"/>
		     岁</td>
		   <td>近一年内是否曾醉酒</td>
		   <td colspan="3" align="left">
			<?php $_from = $this->_tpl_vars['last_year_ntoxication_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','last_year_ntoxication')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?>
			 <div align="right">
           <input type="text" id="last_year_ntoxication" name="last_year_ntoxication"  class="inputnew" value="<?php echo $this->_tpl_vars['last_year_ntoxication_current']; ?>
" maxlength="1" />
           </div></td>
	     </tr>
		 <tr>
		   <td>饮酒种类</td>
		   <td colspan="5" align="left">
		   <?php $_from = $this->_tpl_vars['drink_style_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="set_input_many('<?php echo $this->_tpl_vars['k']; ?>
','drink_style[]');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
	       <input type="text" name="drink_style_other" id="drink_style_other"  disabled="disabled"  class="inputbottom" value="<?php echo $this->_tpl_vars['drink_style_other']; ?>
"/>
		   <div align="right">
           <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=2) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                   <input type="text" id="drink_style<?php echo $this->_sections['customer']['index']; ?>
" name="drink_style[]"  class="inputnew" value="<?php echo $this->_tpl_vars['drink_style_current'][$this->_sections['customer']['index']]; ?>
"  maxlength="1" />/
			<?php endfor; endif; ?>
           
		   </div>		   </td>
	     </tr>
		 <tr>
		   <td>职业病危害因素接触史<img title="“职业暴露情况：指因患者职业原因造成的化学品、毒物或射线接触情况。如有，需填写具体化学品、毒物、射线名或填不详”
2.“（具体职业       从业时间    年）”“毒物种类”先灰化，填写“2有”后再激活
3.“防护措施”的文本输入框先灰化，填写“2有”后再激活
”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <td colspan="5" align="left" >
		      <?php $_from = $this->_tpl_vars['occupational_exposure_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			  <label onclick="occp('occupation_status','occupation','occupation_age','<?php echo $this->_tpl_vars['k']; ?>
');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			  <?php endforeach; endif; unset($_from); ?>(工种<input name="occupation" id="occupation" value="<?php echo $this->_tpl_vars['occupation']; ?>
" type="text" class="inputbottom"/>从业时间<input name="occupation_age" id="occupation_age" type="text" value="<?php echo $this->_tpl_vars['occupation_age']; ?>
" class="inputbottom"/>年)
		      <div align="right"> 
			  <input type="text" id="occupation_status" name="occupation_status"  class="inputnew" value="<?php echo $this->_tpl_vars['occupation_status']; ?>
" maxlength="1" /> 
			  </div>
			  毒物种类  粉尘  <input name="dust" type="text" class="inputbottom" id="dust" onmousedown="checktxet('dust','dust_protection','dust_protection_info');" value="<?php echo $this->_tpl_vars['dust']; ?>
"/> 防护措施     
				<?php $_from = $this->_tpl_vars['dust_protection_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<label onclick="getval('dust','dust_protection','dust_protection_info','<?php echo $this->_tpl_vars['k']; ?>
','2');" ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
				<?php endforeach; endif; unset($_from); ?>
			  <input name="dust_protection_info" id="dust_protection_info" type="text" class="inputbottom" value="<?php echo $this->_tpl_vars['dust_protection_info']; ?>
" disabled="disabled"/>
			  <div align="right"> 
			  <input type="text" id="dust_protection" name="dust_protection"  class="inputnew" value="<?php echo $this->_tpl_vars['dust_protection_current']; ?>
"  maxlength="1"  /> 
			  </div>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;放射物质  <input name="ray" type="text" class="inputbottom" id="ray" onmousedown="checktxet('ray','ray_protection','ray_protection_info');" value="<?php echo $this->_tpl_vars['ray']; ?>
"/> 防护措施     
			<?php $_from = $this->_tpl_vars['ray_protection_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="getval('ray','ray_protection','ray_protection_info','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?><input name="ray_protection_info"  id="ray_protection_info" value="<?php echo $this->_tpl_vars['ray_protection_info']; ?>
" type="text" class="inputbottom" disabled="disabled"/>
			  <div align="right"> 
			  <input type="text" id="ray_protection" name="ray_protection"  class="inputnew" value="<?php echo $this->_tpl_vars['ray_protection_current']; ?>
" maxlength="1" /> 
			  </div>
			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;物理因素  <input name="physical" type="text" class="inputbottom" id="physical" onmousedown="checktxet('physical','physical_protection','physical_protection_info');" value="<?php echo $this->_tpl_vars['physical']; ?>
"/> 防护措施     
			<?php $_from = $this->_tpl_vars['physical_protection_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<label onclick="getval('physical','physical_protection','physical_protection_info','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			<?php endforeach; endif; unset($_from); ?><input name="physical_protection_info"  id="physical_protection_info" value="<?php echo $this->_tpl_vars['physical_protection_info']; ?>
" type="text" class="inputbottom" disabled="disabled"/>
			  <div align="right"> 
			  <input type="text" id="physical_protection" name="physical_protection"  class="inputnew" value="<?php echo $this->_tpl_vars['physical_protection_current']; ?>
" maxlength="1" /> 
			  </div>
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;化学物质 <input name="chemistry" type="text"  id="chemistry" class="inputbottom" onmousedown="checktxet('chemistry','chemistry_protection','chemistry_protection_info');" value="<?php echo $this->_tpl_vars['chemistry']; ?>
"/>防护措施
			  <?php $_from = $this->_tpl_vars['chemistry_protection_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<label onclick="getval('chemistry','chemistry_protection','chemistry_protection_info','<?php echo $this->_tpl_vars['k']; ?>
','2');" ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			  <?php endforeach; endif; unset($_from); ?>
			  <input name="chemistry_protection_info"  id="chemistry_protection_info" value="<?php echo $this->_tpl_vars['chemistry_protection_info']; ?>
" type="text" class="inputbottom" disabled="disabled"/>
			   <div align="right"> 
			   <input type="text" id="chemistry_protection" name="chemistry_protection"  class="inputnew" value="<?php echo $this->_tpl_vars['chemistry_protection_current']; ?>
" maxlength="1" /> 
			  </div>
			   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其他 <input name="other_types" type="text" value="<?php echo $this->_tpl_vars['other_types']; ?>
" id="other_types" class="inputbottom" onmousedown="checktxet('other_types','other_types_protection','other_types_info');"/>防护措施
			   <?php $_from = $this->_tpl_vars['other_types_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			    <label onclick="getval('other_types','other_types_protection','other_types_info','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			   <?php endforeach; endif; unset($_from); ?>
			  <input name="other_types_info"  id="other_types_info" value="<?php echo $this->_tpl_vars['other_types_info']; ?>
" type="text" class="inputbottom" disabled="disabled"/>
			   <div align="right" > 
			   <input type="text" id="other_types_protection" name="other_types_protection"  class="inputnew" value="<?php echo $this->_tpl_vars['other_types_protection']; ?>
" maxlength="1" /> 
			  </div>
           </td>
	     </tr>
		 <!--生活方式结束-->
		 <!--脏器功能开始-->
		 <tr>
		    <td rowspan="4" width="12%">脏器功能</td>
		    <td>口腔</td>
			<td colspan="5" align="left">
			  <?php $_from = $this->_tpl_vars['lips_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			  <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','lips')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			  <?php endforeach; endif; unset($_from); ?>
			  <div align="right"> 
			  <input type="text" id="lips" name="lips"  class="inputnew" value="<?php echo $this->_tpl_vars['lips_current']; ?>
"/ maxlength="1" > 
			  </div>
			  齿列<img title="“各十字架先灰化，如果相应选项被填选，则被激活
，每个十字架的四个象限均需设计一个文本输入框
”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /> 1 正常  
			  <div align="right" style="float:right;">
               <input type="text" id="dentition" name="dentition"  value="<?php echo $this->_tpl_vars['dentition']; ?>
" class="inputnew" maxlength="1"  />
		      </div>
			  <div style=" width:20%;  float: right">		   
			       <div class="addstyleup"><input type="text" name="dentition_false_tooth[]"  disabled="disabled" value="<?php echo $this->_tpl_vars['dentition_false_tooth'][0]; ?>
" class="inputnone3" id="dentition_false_tooth"/></div>
				   <div class="addstyleleft"><input type="text" name="dentition_false_tooth[]"  disabled="disabled" value="<?php echo $this->_tpl_vars['dentition_false_tooth'][1]; ?>
" class="inputnone3" id="dentition_false_tooth"/></div>
				   <div class="addstyleright"><input type="text" name="dentition_false_tooth[]"  disabled="disabled" value="<?php echo $this->_tpl_vars['dentition_false_tooth'][2]; ?>
" class="inputnone3" id="dentition_false_tooth"/></div>
				   <div class="addstyledown"><input type="text" name="dentition_false_tooth[]"  disabled="disabled" value="<?php echo $this->_tpl_vars['dentition_false_tooth'][3]; ?>
" class="inputnone3" id="dentition_false_tooth"/></div>
			  4 义齿(假齿)
			  </div>
			  <div style=" width:20%;  float: right"> 
			       <div class="addstyleup"><input type="text" name="dentition_decayed_tooth[]"  disabled="disabled" value="<?php echo $this->_tpl_vars['dentition_decayed_tooth'][0]; ?>
" class="inputnone3" id="dentition_decayed_tooth"/></div>
				   <div class="addstyleleft"><input type="text" name="dentition_decayed_tooth[]"  disabled="disabled" value="<?php echo $this->_tpl_vars['dentition_decayed_tooth'][1]; ?>
"  class="inputnone3" id="dentition_decayed_tooth"/></div>
				   <div class="addstyleright"><input type="text" name="dentition_decayed_tooth[]"  disabled="disabled" value="<?php echo $this->_tpl_vars['dentition_decayed_tooth'][2]; ?>
"  class="inputnone3" id="dentition_decayed_tooth"/></div>
				   <div class="addstyledown"><input type="text" name="dentition_decayed_tooth[]"  disabled="disabled" value="<?php echo $this->_tpl_vars['dentition_decayed_tooth'][3]; ?>
"  class="inputnone3" id="dentition_decayed_tooth"/></div>
			  3 龋齿
			  </div>
			  <div style=" width:20%;  float: right">
			       <div class="addstyleup"><input type="text" name="dentition_missing_teeth[]"  disabled="disabled" value="<?php echo $this->_tpl_vars['dentition_missing_teeth'][0]; ?>
" class="inputnone3" id="dentition_missing_teeth"/></div>
				   <div class="addstyleleft"><input type="text" name="dentition_missing_teeth[]"  disabled="disabled" value="<?php echo $this->_tpl_vars['dentition_missing_teeth'][1]; ?>
" class="inputnone3" id="dentition_missing_teeth"/></div>
				   <div class="addstyleright"><input type="text" name="dentition_missing_teeth[]"  disabled="disabled" value="<?php echo $this->_tpl_vars['dentition_missing_teeth'][2]; ?>
" class="inputnone3" id="dentition_missing_teeth"/></div>
				   <div class="addstyledown"><input type="text" name="dentition_missing_teeth[]"  disabled="disabled" value="<?php echo $this->_tpl_vars['dentition_missing_teeth'][3]; ?>
" class="inputnone3" id="dentition_missing_teeth"/></div> 
			  2 缺齿
			  </div> 
			  <div style=" width:100%;  float: right;">
			       咽部 
			       <?php $_from = $this->_tpl_vars['pharyngeal_portion_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				  <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','pharyngeal_portion')" ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
				  <?php endforeach; endif; unset($_from); ?>
				 <div align="right" style="float:right;">
                   <input type="text" id="pharyngeal_portion" name="pharyngeal_portion"  class="inputnew" value="<?php echo $this->_tpl_vars['pharyngeal_portion_current']; ?>
" maxlength="1" />
		         </div>
			  </div> 
		   </td>
		 </tr>
		 <tr>
		    <td>视力<img title="“视力：填写采用对数视力表测量后的具体数值，对佩戴眼镜者，可戴其平时所用眼镜测量矫正视力。
”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
			<td colspan="5">左眼 
		    <input type="text" name="left_eye" id="left_eye"  class="inputbottom" value="<?php echo $this->_tpl_vars['left_eye']; ?>
"/> 
		    右眼 
		    <input type="text" name="right_eye" id="right_eye"  class="inputbottom" value="<?php echo $this->_tpl_vars['right_eye']; ?>
"/> 
		    (矫正视力:左眼 
		    <input type="text" name="left_eye_corrected_vision" id="left_eye_corrected_vision"  class="inputbottom" value="<?php echo $this->_tpl_vars['left_eye_corrected_vision']; ?>
"/> 
		    右眼 
		    <input type="text" name="right_eye_corrected_vision" id="right_eye_corrected_vision"  class="inputbottom" value="<?php echo $this->_tpl_vars['right_eye_corrected_vision']; ?>
"/>
		    )  </td>
		 </tr>
		 <tr>
		    <td>听力<img title="“听力：在被检查者耳旁轻声耳语“你叫什么姓名”（注意检查时检查者的脸应在被检查者视线之外），判断被检查者听力状况。
”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
			<td colspan="5" align="left">
			 <?php $_from = $this->_tpl_vars['hearing_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			 <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','hearing')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
			 <?php endforeach; endif; unset($_from); ?>
			<div align="right">
              <input type="text" id="hearing" name="hearing"  class="inputnew" value="<?php echo $this->_tpl_vars['hearing_current']; ?>
" maxlength="1" />
		    </div>			</td>
		 </tr>
		 <tr>
		   <td>运动功能<img title="“运动功能：请被检查者完成以下动作：“两手触枕后部”、“捡起这支笔”、“从椅子上站起，行走几步，转身，坐下。”判断被检查者运动功能。
”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <td colspan="5" align="left">
		   <?php $_from = $this->_tpl_vars['energizing_function_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','energizing_function')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		   <?php endforeach; endif; unset($_from); ?>
		   <div align="right">
              <input type="text" id="energizing_function" name="energizing_function" value="<?php echo $this->_tpl_vars['energizing_function_current']; ?>
"  class="inputnew" maxlength="1" />
		    </div>	   	   </td>
	     </tr>
		 <!--脏器功能结束-->
		 <!--查体开始-->
		 <tr>
		     <td <?php if ($this->_tpl_vars['sexTag']): ?>rowspan="18"<?php else: ?>rowspan="13"<?php endif; ?> width="12%">查体</td>
			 <td >皮肤</td>
			 <td colspan="5" align="left">
			 <?php $_from = $this->_tpl_vars['skin_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		     <label onclick="sink('<?php echo $this->_tpl_vars['k']; ?>
','skin','skin_other');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		     <?php endforeach; endif; unset($_from); ?>
			 
		     <input type="text" name="skin_other" id="skin_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['skin_other']; ?>
" disabled="disabled"/>
			 <div align="right">
              <input type="text" id="skin" name="skin"  class="inputnew" value="<?php echo $this->_tpl_vars['skin_current']; ?>
" maxlength="1" onblur="loadinput('skin','skin_other');" />
		    </div>			 </td>
		 </tr>
		  <tr>
		     <td>巩膜<img title="“如有异常请在横线上具体说明，如其他淋巴结部位、个数；心脏杂音描述；肝脾肋下触诊大小等。
”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip"/> </td>
			 <td colspan="5" align="left">
			 <?php $_from = $this->_tpl_vars['sclera_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		     <label onclick="et_sclera('<?php echo $this->_tpl_vars['k']; ?>
','sclera','sclera_other');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		     <?php endforeach; endif; unset($_from); ?>
		     <input type="text" name="sclera_other" id="sclera_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['sclera_other']; ?>
" disabled="disabled"/>
			 <div align="right">
              <input type="text" id="sclera" name="sclera"  class="inputnew" value="<?php echo $this->_tpl_vars['sclera_current']; ?>
" maxlength="1" onblur="loadinput_gm('sclera','sclera_other');"/>
		    </div>			</td>
		 </tr>
		 <tr>
		     <td>淋巴结</td>
			 <td colspan="5" align="left">
			 <?php $_from = $this->_tpl_vars['lymph_node_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		     <label onclick="et_lymph('<?php echo $this->_tpl_vars['k']; ?>
','lymph_node','lymph_node_other');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		     <?php endforeach; endif; unset($_from); ?>
		     <input type="text" name="lymph_node_other" id="lymph_node_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['lymph_node_other']; ?>
" disabled="disabled"/>
			 <div align="right">
              <input type="text" id="lymph_node" name="lymph_node"  class="inputnew" value="<?php echo $this->_tpl_vars['lymph_node_current']; ?>
" maxlength="1" onblur="loadinput_lbj('lymph_node','lymph_node_other');"/>
		    </div>			</td>
		 </tr>
		 <tr>
		     <td rowspan="3">肺</td>
			 <td colspan="5" align="left">桶装胸 ：
			 <?php $_from = $this->_tpl_vars['lung_barrel_chest_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		     <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','lung_barrel_chest')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		     <?php endforeach; endif; unset($_from); ?>
			 <div align="right">
              <input type="text" id="lung_barrel_chest" name="lung_barrel_chest"  class="inputnew" value="<?php echo $this->_tpl_vars['lung_barrel_chest_current']; ?>
" maxlength="1" />
		    </div>			</td>
		 </tr>
		 <tr>
		     <td colspan="5" align="left">呼吸音 ：
		     <?php $_from = $this->_tpl_vars['lung_sounds_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		     <label onclick="skinget('lung_sounds','lung_sounds_exception','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		     <?php endforeach; endif; unset($_from); ?>
		       <input type="text" name="lung_sounds" id="lung_sounds_exception" disabled="disabled" class="inputbottom" value="<?php echo $this->_tpl_vars['lung_sounds_exception']; ?>
" />
		       <div align="right">
              <input type="text" id="lung_sounds" name="lung_sounds"  class="inputnew" value="<?php echo $this->_tpl_vars['lung_sounds_current']; ?>
" maxlength="1" onblur="loadinput_lone('lung_sounds','lung_sounds_exception','2');"/>
		    </div>			</td>
		 </tr>
		 <tr>
		     <td colspan="5" align="left">罗音 ：
		     <?php $_from = $this->_tpl_vars['lung_rale_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		     <label onclick="et_lung('<?php echo $this->_tpl_vars['k']; ?>
','lung_rale','lung_rale_other');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		     <?php endforeach; endif; unset($_from); ?>
		       <input type="text" name="lung_rale_other" id="lung_rale_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['lung_rale_other']; ?>
" disabled="disabled"/>
		       <div align="right">
                <input type="text" id="lung_rale" name="lung_rale"  class="inputnew" value="<?php echo $this->_tpl_vars['lung_rale_current']; ?>
" maxlength="1" onblur="loadinput_ly('lung_rale','lung_rale_other');"/>
		       </div>			
			</td>
		 </tr>
		 <tr>
		   <td>心脏</td>
		   <td colspan="5" align="left"> 
		      心率 <input type="text" name="heart_rate" id="heart_rate"  class="inputbottom" value="<?php echo $this->_tpl_vars['heart_rate']; ?>
"/>次/分钟    心律 
		     <?php $_from = $this->_tpl_vars['heart_rhythm_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		     <label  onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','heart_rhythm')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		     <?php endforeach; endif; unset($_from); ?>
			  <div align="right">
              <input type="text" id="heart_rhythm" name="heart_rhythm" value="<?php echo $this->_tpl_vars['heart_rhythm_current']; ?>
"  class="inputnew" maxlength="1" />
		      </div>
			  杂音：
			 <?php $_from = $this->_tpl_vars['heart_noise_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		     <label onclick="skinget('heart_noise','heart_noise_info','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		     <?php endforeach; endif; unset($_from); ?> <input type="text" name="heart_noise_info" id="heart_noise_info" value="<?php echo $this->_tpl_vars['heart_noise_info']; ?>
" class="inputbottom" value="<?php echo $this->_tpl_vars['heart_noise_info']; ?>
"/> 
			  <div align="right">
              <input type="text" id="heart_noise" name="heart_noise" value="<?php echo $this->_tpl_vars['heart_noise_current']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('heart_noise','heart_noise_info','2');"/>
		      </div>
	       </td>
	     </tr>
		 <tr>
		   <td>腹部</td>
		   <td colspan="5" align="left"> 
		       压痛: 
		       <?php $_from = $this->_tpl_vars['abdominal_tenderness_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		       <label onclick="skinget('abdominal_tenderness','abdominal_tenderness_info','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		       <?php endforeach; endif; unset($_from); ?>  <input type="text" name="abdominal_tenderness_info" id="abdominal_tenderness_info"  value="<?php echo $this->_tpl_vars['abdominal_tenderness_info']; ?>
" class="inputbottom" value="<?php echo $this->_tpl_vars['abdominal_tenderness_info']; ?>
"/>
			  <div align="right">
               <input type="text" id="abdominal_tenderness" name="abdominal_tenderness" value="<?php echo $this->_tpl_vars['abdominal_tenderness_current']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('abdominal_tenderness','abdominal_tenderness_info','2');"/>
		      </div>
			   包块: 
			   <?php $_from = $this->_tpl_vars['abdominal_tenderness_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		       <label onclick="skinget('abdominal_mass','abdominal_mass_info','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		       <?php endforeach; endif; unset($_from); ?><input type="text" name="abdominal_mass_info" id="abdominal_mass_info"  class="inputbottom" value="<?php echo $this->_tpl_vars['abdominal_mass_info']; ?>
"/>
			  <div align="right">
               <input type="text" id="abdominal_mass" name="abdominal_mass" value="<?php echo $this->_tpl_vars['abdominal_mass']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('abdominal_mass','abdominal_mass_info','2');"/>
		      </div>
			   肝大: 
			   <?php $_from = $this->_tpl_vars['abdominal_tenderness_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		       <label onclick="skinget('abdominal_hepatomegaly','abdominal_hepatomegaly_info','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		       <?php endforeach; endif; unset($_from); ?> <input type="text" name="abdominal_hepatomegaly_info" id="abdominal_hepatomegaly_info"  class="inputbottom" value="<?php echo $this->_tpl_vars['abdominal_hepatomegaly_info']; ?>
"/>
			  <div align="right">
               <input type="text" id="abdominal_hepatomegaly" name="abdominal_hepatomegaly" value="<?php echo $this->_tpl_vars['abdominal_hepatomegaly']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('abdominal_hepatomegaly','abdominal_hepatomegaly_info','2');"/>
		      </div>
			   脾大: 
			   <?php $_from = $this->_tpl_vars['abdominal_tenderness_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		       <label onclick="skinget('abdominal_splenomegaly','abdominal_splenomegaly_info','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		       <?php endforeach; endif; unset($_from); ?>  <input type="text" name="abdominal_splenomegaly_info" id="abdominal_splenomegaly_info"  class="inputbottom" value="<?php echo $this->_tpl_vars['abdominal_splenomegaly_info']; ?>
"/>
			  <div align="right">
               <input type="text" id="abdominal_splenomegaly" name="abdominal_splenomegaly" value="<?php echo $this->_tpl_vars['abdominal_splenomegaly']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('abdominal_splenomegaly','abdominal_splenomegaly_info','2');"/>
		      </div>
			   移动性浊音: 
			   <?php $_from = $this->_tpl_vars['abdominal_tenderness_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		       <label onclick="skinget('shifting_dullness','shifting_dullness_info','<?php echo $this->_tpl_vars['k']; ?>
','2');" ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		       <?php endforeach; endif; unset($_from); ?>  <input type="text" name="shifting_dullness_info" id="shifting_dullness_info"  class="inputbottom" value="<?php echo $this->_tpl_vars['shifting_dullness_info']; ?>
"/>
			  <div align="right">
               <input type="text" id="shifting_dullness" name="shifting_dullness" value="<?php echo $this->_tpl_vars['shifting_dullness']; ?>
"  class="inputnew" maxlength="1" onblur="loadinput_lone('shifting_dullness','shifting_dullness_info','2');"/>
		      </div>
           </td>
	     </tr>
		 <tr>
		   <td>下肢水肿</td>
		   <td colspan="6" align="left">
		   <?php $_from = $this->_tpl_vars['ramus_inferior_edema_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','ramus_inferior_edema')" ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		   <?php endforeach; endif; unset($_from); ?>
		   <div align="right">
              <input type="text" id="ramus_inferior_edema" name="ramus_inferior_edema" value="<?php echo $this->_tpl_vars['ramus_inferior_edema_current']; ?>
"  class="inputnew" maxlength="1" />
		    </div>		   </td>
	     </tr>
		 <tr>
		   <td>足背动脉搏动</td>
		   <td colspan="6" align="left">
		   <?php $_from = $this->_tpl_vars['foot_arterial_pulse_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','foot_arterial_pulse')" ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		   <?php endforeach; endif; unset($_from); ?>
		   <div align="right">
              <input type="text" id="foot_arterial_pulse" name="foot_arterial_pulse" value="<?php echo $this->_tpl_vars['foot_arterial_pulse_current']; ?>
"  class="inputnew" maxlength="1" />
		    </div>		   </td>
	     </tr>
		 <tr>
		   <td>肛门指诊*</td>
		   <td colspan="6" align="left">
		   <?php $_from = $this->_tpl_vars['rectal_touch_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="rectal_touch_new('<?php echo $this->_tpl_vars['k']; ?>
','rectal_touch','rectal_touch_other');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		   <?php endforeach; endif; unset($_from); ?>
		   <input type="text" name="rectal_touch_other" id="rectal_touch_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['rectal_touch_other']; ?>
" disabled="disabled"/>   
		   <div align="right">
              <input type="text" id="rectal_touch" name="rectal_touch"  value="<?php echo $this->_tpl_vars['rectal_touch_current']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_gmzz('rectal_touch','rectal_touch_other')";/>
		    </div>			</td>
	     </tr>
		 <tr>
		   <td>乳&nbsp;&nbsp; 腺*<img title="“注意，男性要查此项”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <td colspan="5" align="left">
		   <?php $_from = $this->_tpl_vars['mammary_gland_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="set_input_many('<?php echo $this->_tpl_vars['k']; ?>
','mammary_gland[]')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		   <?php endforeach; endif; unset($_from); ?>
		   <input type="text" name="mammary_gland_other" id="mammary_gland_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['mammary_gland_other']; ?>
" disabled="disabled"/>
		   <div align="right">
		   <?php unset($this->_sections['mammary_gland_current']);
$this->_sections['mammary_gland_current']['name'] = 'mammary_gland_current';
$this->_sections['mammary_gland_current']['loop'] = is_array($_loop=4) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mammary_gland_current']['show'] = true;
$this->_sections['mammary_gland_current']['max'] = $this->_sections['mammary_gland_current']['loop'];
$this->_sections['mammary_gland_current']['step'] = 1;
$this->_sections['mammary_gland_current']['start'] = $this->_sections['mammary_gland_current']['step'] > 0 ? 0 : $this->_sections['mammary_gland_current']['loop']-1;
if ($this->_sections['mammary_gland_current']['show']) {
    $this->_sections['mammary_gland_current']['total'] = $this->_sections['mammary_gland_current']['loop'];
    if ($this->_sections['mammary_gland_current']['total'] == 0)
        $this->_sections['mammary_gland_current']['show'] = false;
} else
    $this->_sections['mammary_gland_current']['total'] = 0;
if ($this->_sections['mammary_gland_current']['show']):

            for ($this->_sections['mammary_gland_current']['index'] = $this->_sections['mammary_gland_current']['start'], $this->_sections['mammary_gland_current']['iteration'] = 1;
                 $this->_sections['mammary_gland_current']['iteration'] <= $this->_sections['mammary_gland_current']['total'];
                 $this->_sections['mammary_gland_current']['index'] += $this->_sections['mammary_gland_current']['step'], $this->_sections['mammary_gland_current']['iteration']++):
$this->_sections['mammary_gland_current']['rownum'] = $this->_sections['mammary_gland_current']['iteration'];
$this->_sections['mammary_gland_current']['index_prev'] = $this->_sections['mammary_gland_current']['index'] - $this->_sections['mammary_gland_current']['step'];
$this->_sections['mammary_gland_current']['index_next'] = $this->_sections['mammary_gland_current']['index'] + $this->_sections['mammary_gland_current']['step'];
$this->_sections['mammary_gland_current']['first']      = ($this->_sections['mammary_gland_current']['iteration'] == 1);
$this->_sections['mammary_gland_current']['last']       = ($this->_sections['mammary_gland_current']['iteration'] == $this->_sections['mammary_gland_current']['total']);
?>
		   	<input type="text" id="mammary_gland" name="mammary_gland[]" value="<?php echo $this->_tpl_vars['mammary_gland_current'][$this->_sections['mammary_gland_current']['index']]; ?>
" class="inputnew" maxlength="1" />/
		   <?php endfor; endif; ?>
           
		    </div>			</td>
	     </tr>
	     <?php if ($this->_tpl_vars['sexTag']): ?>
		 <tr>
		   <td  rowspan="5">妇&nbsp;&nbsp;科</td>
		   <td >外阴*<img title="“外阴  记录发育情况及婚产式（未婚、已婚未产或经产式），如有异常情况请具体描述。

”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <td colspan="4" align="left">
		   <?php $_from = $this->_tpl_vars['gynae_vulva_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="skinget('gynae_vulva','gynae_vulva_exception','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		   <?php endforeach; endif; unset($_from); ?>
	       <input type="text" name="gynae_vulva_exception" id="gynae_vulva_exception"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['gynae_vulva_exception']; ?>
"/>
		   <div align="right">
              <input type="text" id="gynae_vulva" name="gynae_vulva" value="<?php echo $this->_tpl_vars['gynae_vulva_current']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('gynae_vulva','gynae_vulva_exception','2');"/>
		    </div>		   </td>
	     </tr>
		 <tr>
		   <td >阴道*<img title="“阴道  记录是否通畅，黏膜情况、分泌物量、色、性状以及有无异味等。

”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <td colspan="4" align="left">
		   <?php $_from = $this->_tpl_vars['gynae_cunt_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="skinget('gynae_cunt','gynae_cunt_exception','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		   <?php endforeach; endif; unset($_from); ?>
	       <input type="text" name="gynae_cunt_exception" id="gynae_cunt_exception"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['gynae_cunt_exception']; ?>
"/>
		   <div align="right">
              <input type="text" id="gynae_cunt" name="gynae_cunt" value="<?php echo $this->_tpl_vars['gynae_cunt_current']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('gynae_cunt','gynae_cunt_exception','2');"/>
		    </div>		   </td>
	     </tr>
		 <tr>
		   <td >宫颈*<img title="“宫颈  记录大小、质地、有无糜烂、撕裂、息肉、腺囊肿；有无接触性出血、举痛等。

”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <td colspan="4" align="left">
		   <?php $_from = $this->_tpl_vars['gynae_cervix_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="skinget('gynae_cervix','gynae_cervix_exception','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		   <?php endforeach; endif; unset($_from); ?>
	       <input type="text" name="gynae_cervix_exception" id="gynae_cervix_exception"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['gynae_cervix_exception']; ?>
"/>
		   <div align="right">
              <input type="text" id="gynae_cervix" name="gynae_cervix" value="<?php echo $this->_tpl_vars['gynae_cervix_current']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('gynae_cervix','gynae_cervix_exception','2');"/>
		    </div>		   </td>
	     </tr>
		  <tr>
		   <td >宫体*<img title="“宫体  记录位置、大小、质地、活动度；有无压痛等。

”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <td colspan="4" align="left">
		   <?php $_from = $this->_tpl_vars['gynae_uterus_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="skinget('gynae_uterus','gynae_uterus_exception','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		   <?php endforeach; endif; unset($_from); ?>
	       <input type="text" name="gynae_uterus_exception" id="gynae_uterus_exception"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['gynae_uterus_exception']; ?>
"/>
		   <div align="right">
              <input type="text" id="gynae_uterus" name="gynae_uterus" value="<?php echo $this->_tpl_vars['gynae_uterus_current']; ?>
"  class="inputnew" maxlength="1" onblur="loadinput_lone('gynae_uterus','gynae_uterus_exception','2');"/>
		    </div>		   </td>
	     </tr>
		  <tr>
		   <td >附件*<img title="“记录有无块物、增厚或压痛；若扪及块物，记录其位置、大小、质地；表面光滑与否、活动度、有无压痛以及与子宫及盆壁关系。左右两侧分别记录。

”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <td colspan="4" align="left">
		   <?php $_from = $this->_tpl_vars['gynae_appendix_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="skinget('gynae_appendix','gynae_appendix_exception','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		   <?php endforeach; endif; unset($_from); ?>
	       <input type="text" name="gynae_appendix_exception" id="gynae_appendix_exception"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['gynae_appendix_exception']; ?>
"/>
		   <div align="right">
              <input type="text" id="gynae_appendix" name="gynae_appendix" value="<?php echo $this->_tpl_vars['gynae_appendix_current']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('gynae_appendix','gynae_appendix_exception','2');"/>
		    </div>		 </td>
	     </tr>
	     <?php endif; ?>
		 <tr>
		   <td colspan="2" >其 他*</td>
		   <td colspan="4" align="left">
		     <textarea name="others" cols="64" rows="6" class="newtextarea"><?php echo $this->_tpl_vars['others']; ?>
</textarea>
		   </td>
	     </tr>
		 <!--查体结束-->
		 <!--辅助检查开始-->
		 <tr>
		    <td <?php if ($this->_tpl_vars['sexTag']): ?>rowspan="16"<?php else: ?>rowspan="15"<?php endif; ?> width="12%">辅助检查<img title="“辅助检查：该项目根据各地实际情况及不同人群情况，有选择地开展。

”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
			<td>空腹血糖*<img title="“老年人健康体检、高血压患者、2型糖尿病患者和重性精神疾病患者年度健康检查时应免费检查的项目。

”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
			<td colspan="5" align="left">
			  <input type="text" name="fbglucoseh" id="fbglucoseh"  class="inputbottom" value="<?php echo $this->_tpl_vars['fbglucoseh']; ?>
"/>
			mmol/L 或
			<input type="text" name="fbglucosee" id="fbglucosee"  class="inputbottom" value="<?php echo $this->_tpl_vars['fbglucosee']; ?>
"/>
			mg/dL </td>
		 </tr>
		  <tr>
		    <td>血常规*</td>
			<td colspan="5" align="left">血红蛋白
		    <input type="text" name="hemoglobin" id="hemoglobin"  class="inputbottom" value="<?php echo $this->_tpl_vars['hemoglobin']; ?>
"/>
		    g/L &nbsp;&nbsp;白细胞 
		    <input type="text" name="leukocyte" id="leukocyte"  class="inputbottom" value="<?php echo $this->_tpl_vars['leukocyte']; ?>
"/>
		    /L &nbsp;&nbsp;血小板
		    <input type="text" name="platelet" id="platelet"  class="inputbottom" value="<?php echo $this->_tpl_vars['platelet']; ?>
"/>
		    /L &nbsp;&nbsp;其他 
		     <input type="text" name="b_other" id="b_other"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['b_other']; ?>
"/></td>
		 </tr>
		 <tr>
		    <td>尿常规*<img title="“尿常规中的“尿蛋白、尿糖、尿酮体、尿潜血”可以填写定性检查结果，阴性填“－”，阳性根据检查结果填写“＋”、“＋＋”、“＋＋＋”或“＋＋＋＋”，也可以填写定量检查结果，定量结果需写明计量单位。

”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
			<td colspan="5" align="left">尿蛋白<input type="text" name="u_protein" id="u_protein"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['u_protein']; ?>
"/>
			  尿糖<input type="text" name="urine" id="urine"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['urine']; ?>
"/>
			  尿酮体<input type="text" name="ketone" id="ketone"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['ketone']; ?>
"/>
			  尿潜血<input type="text" name="uoblood" id="uoblood"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['uoblood']; ?>
"/><br/>
			  其它<input type="text" name="u_other" id="u_other"  class="inputbottomlong"  value="<?php echo $this->_tpl_vars['u_other']; ?>
"/></td>
		 </tr>
		  <tr>
		    <td>尿微量白蛋白*</td>
			<td colspan="5" align="left"><input type="text" name="microurine" id="microurine"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['microurine']; ?>
"/>
			  mg/dL</td>
		 </tr>
		 <tr>
		    <td>大便潜血*</td>
			<td colspan="5" align="left">
			  <?php $_from = $this->_tpl_vars['fecalblood_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		      <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','fecalblood')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		      <?php endforeach; endif; unset($_from); ?>
			  <div align="right">
              <input type="text" id="fecalblood" name="fecalblood"  class="inputnew" value="<?php echo $this->_tpl_vars['fecalblood_current']; ?>
" maxlength="1"/>
		      </div>			</td>
		 </tr>
		 <tr> 
		    <td>肝功能*</td>
			<td colspan="5" align="left">
			 血清谷丙转氨酶 <input type="text" name="alanine" id="alanine"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['alanine']; ?>
"/>U/L
			 血清谷草转氨酶 <input type="text" name="serum" id="serum"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['serum']; ?>
"/>U/L
			 白蛋白        <input type="text" name="albumin" id="albumin"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['albumin']; ?>
"/>g/L
			 总胆红素      <input type="text" name="tbilirubin" id="tbilirubin"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['tbilirubin']; ?>
"/>μmol/L
			 结合胆红素    <input type="text" name="bilirubin" id="bilirubin"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['bilirubin']; ?>
"/>μmol/L
     	   </td>
		</tr>
		 <tr> 
		    <td>肾功能*</td>
			<td colspan="5" align="left">
			血清肌酐  <input type="text" name="screatinine" id="screatinine"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['screatinine']; ?>
"/>μmol/L
			血尿素氮  <input type="text" name="bun" id="bun"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['bun']; ?>
"/>mmol/L
			血钾浓度 <img title="“血钾浓度为高血压患者年度健康检查时应检查的项目，建议有条件的地区为高血压患者提供该项检查。

”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /> <input type="text" name="serumpc" id="serumpc"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['serumpc']; ?>
"/>mmol/L
			血钠浓度  <img title="“血钠浓度为高血压患者年度健康检查时应检查的项目，建议有条件的地区为高血压患者提供该项检查。
”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /><input type="text" name="sodium" id="sodium"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['sodium']; ?>
"/>mmol/L
    	   </td>
		</tr>
		<tr> 
		    <td>血脂*</td>
			<td colspan="5" align="left">
			总胆固醇 <input type="text" name="tcholesterol" id="tcholesterol"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['tcholesterol']; ?>
"/>mmol/L
			甘油三酯 <input type="text" name="triglyceride" id="triglyceride"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['triglyceride']; ?>
"/>mmol/L
			血清低密度酯蛋白胆固醇 <input type="text" name="lowcholesterol" id="lowcholesterol"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['lowcholesterol']; ?>
"/>mmol/L
			血清高密度酯蛋白胆固醇 <input type="text" name="highcholesterol" id="highcholesterol"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['highcholesterol']; ?>
"/>mmol/L
    	  </td>
		</tr>
		<tr> 
		    <td>糖化血红蛋白*<img title="“糖化血红蛋白为糖尿病患者应检查的项目，建议有条件的地区为糖尿病患者提供该项检查。
”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
			<td colspan="5" align="left">
			<input type="text" name="ghemoglobin" id="ghemoglobin"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['ghemoglobin']; ?>
"/>
			  %			</td>
		</tr>
		<tr> 
		    <td>乙型肝炎表面抗原*</td>
			<td colspan="5" align="left">
			 <?php $_from = $this->_tpl_vars['hbsurface_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		      <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','hbsurface')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		      <?php endforeach; endif; unset($_from); ?>
			 <div align="right">
              <input type="text" id="hbsurface" name="hbsurface" value="<?php echo $this->_tpl_vars['hbsurface_current']; ?>
"  class="inputnew" maxlength="1"/>
		    </div>			
		    </td>
		</tr>
		<tr> 
		    <td>眼底*</td>
			<td colspan="5" align="left">
			 <?php $_from = $this->_tpl_vars['fundus_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		      <label onclick="skinget('fundus','veryfundus','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		      <?php endforeach; endif; unset($_from); ?>
		      <input type="text" name="veryfundus" id="veryfundus"  class="inputbottom" value="<?php echo $this->_tpl_vars['veryfundus']; ?>
"/>
			 <div align="right">
              <input type="text" id="fundus" name="fundus"  class="inputnew" value="<?php echo $this->_tpl_vars['fundus_current']; ?>
" maxlength="1" onblur="loadinput_lone('fundus','veryfundus','2');"/>
		    </div>			</td>
		</tr>
		<tr> 
		    <td>心电图*</td>
			<td colspan="5" align="left">
			 <?php $_from = $this->_tpl_vars['ecg_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		      <label onclick="skinget('ecg','veryecg','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		      <?php endforeach; endif; unset($_from); ?> 
		      <input type="text" id="veryecg" name="veryecg"  class="inputbottom" value="<?php echo $this->_tpl_vars['veryecg']; ?>
"/>
			 <div align="right">
              <input type="text" id="ecg" name="ecg" value="<?php echo $this->_tpl_vars['ecg_current']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('ecg','veryecg','2');"/>
		    </div>	
		    </td>
		</tr>
		<tr> 
		    <td>胸部X线片*</td>
			<td colspan="5" align="left">
			 <?php $_from = $this->_tpl_vars['xrayfilm_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		      <label onclick="skinget('xrayfilm','veryxrayfilm','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		      <?php endforeach; endif; unset($_from); ?> 
		      <input type="text" id="veryxrayfilm" name="veryxrayfilm"  class="inputbottom" value="<?php echo $this->_tpl_vars['veryxrayfilm']; ?>
" />
			 <div align="right">
              <input type="text" id="xrayfilm" name="xrayfilm"  value="<?php echo $this->_tpl_vars['xrayfilm_current']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('xrayfilm','veryxrayfilm','2');"/>
		    </div>			</td>
		</tr>
		<tr> 
		    <td>B  超*</td>
			<td colspan="5" align="left">
			 <?php $_from = $this->_tpl_vars['bc_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		      <label onclick="skinget('bc','verybc','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		      <?php endforeach; endif; unset($_from); ?> 
		      <input type="text" id="verybc" name="verybc"  class="inputbottom" value="<?php echo $this->_tpl_vars['verybc']; ?>
" />
			 <div align="right">
              <input type="text" id="bc" name="bc" value="<?php echo $this->_tpl_vars['bc_current']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('bc','verybc','2');"/>
		    </div>			</td>
		</tr>
		<?php if ($this->_tpl_vars['sexTag']): ?>
		<tr> 
		    <td>宫颈涂片*</td>
			<td colspan="5" align="left">
			 <?php $_from = $this->_tpl_vars['csmear_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		      <label onclick="skinget('csmear','verycsmear','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		      <?php endforeach; endif; unset($_from); ?> 
		      <input type="text" id="verycsmear" name="verycsmear"  class="inputbottom" value="<?php echo $this->_tpl_vars['verycsmear']; ?>
" disabled="disabled"/>
			 <div align="right">
              <input type="text" id="csmear" name="csmear" value="<?php echo $this->_tpl_vars['csmear_current']; ?>
" class="inputnew" maxlength="1" onblur="loadinput_lone('csmear','verycsmear','2');"/>
		    </div>			</td>
		</tr>
		<?php endif; ?>
		 <tr>
		   <td >其 他*</td>
		   <td colspan="5" align="left">
		     <textarea name="examination_other" cols="64" rows="6" class="newtextarea"><?php echo $this->_tpl_vars['examination_other']; ?>
</textarea>
		   </td>
	     </tr>
	    
		<!--辅助检查结束-->
		<!--中医体质辨识开始-->
		<tr>
		   <td rowspan="<?php echo count($this->_tpl_vars['physical_medicine_name_options']); ?>
" width="12%">中医体质辨识<img title="“该项由有条件的地区基层医疗卫生机构中医医务人员或经过培训的其他医务人员填写。
体质辨识方法：采用量表的方法，依据中华中医药学会颁布的《中医体质分类与判定标准》进行测评。根据不同的体质辨识，提供相应的健康指导。

”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <?php $_from = $this->_tpl_vars['physical_medicine_name_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <input type="hidden" value="<?php echo $this->_tpl_vars['v'][0]; ?>
" name="physical_medicine_name[]" id="physical_medicine_name"/>
		   <td><?php echo $this->_tpl_vars['v'][1]; ?>
</td>
		   <td colspan="5" align="left">
		   <?php $_from = $this->_tpl_vars['physical_medicine_val_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k_1'] => $this->_tpl_vars['v_1']):
?>
		   
		   <label onclick="set_value('<?php echo $this->_tpl_vars['k_1']; ?>
','physical_medicine_val<?php echo $this->_tpl_vars['k']; ?>
')"><?php echo $this->_tpl_vars['k_1']; ?>
、<?php echo $this->_tpl_vars['v_1'][1]; ?>
</label>&nbsp;
		   <?php endforeach; endif; unset($_from); ?> 
		   <div align="right">
              <input type="text" id="physical_medicine_val<?php echo $this->_tpl_vars['k']; ?>
" name="physical_medicine_val[]" value="<?php echo $this->_tpl_vars['physical_medicine_val'][$this->_tpl_vars['k']]; ?>
"  class="inputnew" maxlength="1"/>
		    </div>		    </td>
	     </tr>
		 <?php endforeach; endif; unset($_from); ?> 
		
		 <!--中医体质辨识结束-->
		 <!--现存主要健康问题开始-->
		 <tr>
		   <td width="12%" rowspan="7">现存主要健康问题<img title="“现存主要健康问题：指曾经出现或一直存在，并影响目前身体健康状况的疾病。可以多选。”
结合原设计的“靶器官损害及临床情况”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <td width="15%">脑血管疾病</td>
		   <td colspan="5" align="left">
		   <?php $_from = $this->_tpl_vars['ceredisease_status_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="set_input_many('<?php echo $this->_tpl_vars['k']; ?>
','ceredisease_status[]');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		   <?php endforeach; endif; unset($_from); ?> 
	       <input type="text" name="ceredisease_other" id="ceredisease_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['ceredisease_other']; ?>
" disabled="disabled"/>
		   <div align="right">
            <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=5) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
              <input type="text" id="ceredisease_status" name="ceredisease_status[]"  class="inputnew" value="<?php echo $this->_tpl_vars['ceredisease_status_current'][$this->_sections['customer']['index']]; ?>
" maxlength="1"/>/
			<?php endfor; endif; ?>
		    </div>			</td>
	     </tr>
		 <tr>
		   <td width="15%">肾脏疾病</td>
		   <td colspan="5" align="left">
		   <?php $_from = $this->_tpl_vars['kidneydisease_status_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="set_input_many('<?php echo $this->_tpl_vars['k']; ?>
','kidneydisease_status[]');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		   <?php endforeach; endif; unset($_from); ?> 
		   
	       <input type="text" name="kidneydisease_other" id="kidneydisease_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['kidneydisease_other']; ?>
" disabled="disabled"/>
		   <div align="right">
           
              
              <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=5) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
              <input type="text" id="kidneydisease_status" name="kidneydisease_status[]"  class="inputnew" value="<?php echo $this->_tpl_vars['kidneydisease_status_current'][$this->_sections['customer']['index']]; ?>
" maxlength="1"/>/
              <?php endfor; endif; ?>
			  
		    </div>			</td>
	     </tr>
		 <tr>
		   <td width="15%">心脏疾病</td>
		   <td colspan="5" align="left">
		   <?php $_from = $this->_tpl_vars['heartdisease_status_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="set_input_many('<?php echo $this->_tpl_vars['k']; ?>
','heartdisease_status[]');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		   <?php endforeach; endif; unset($_from); ?> 
	       <input type="text" name="heartdisease_other" id="heartdisease_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['heartdisease_other']; ?>
" disabled="disabled"/>
		   <div align="right">
               <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=5) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
              <input type="text" id="heartdisease_status" name="heartdisease_status[]"  class="inputnew" value="<?php echo $this->_tpl_vars['heartdisease_status_current'][$this->_sections['customer']['index']]; ?>
" maxlength="1"/>/
			  <?php endfor; endif; ?>
		    </div>			</td>
	     </tr>
		  <tr>
		   <td width="15%">血管疾病</td>
		   <td colspan="5" align="left">
		   <?php $_from = $this->_tpl_vars['vasculardisease_status_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="set_input_many('<?php echo $this->_tpl_vars['k']; ?>
','vasculardisease_status[]');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		   <?php endforeach; endif; unset($_from); ?> 
	       <input type="text" name="vasculardisease_other" id="vasculardisease_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['vasculardisease_other']; ?>
" disabled="disabled"/>
		   <div align="right">
              <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=3) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
              <input type="text" id="vasculardisease_status" name="vasculardisease_status[]"  class="inputnew" value="<?php echo $this->_tpl_vars['vasculardisease_status_current'][$this->_sections['customer']['index']]; ?>
" maxlength="1"/>/
              <?php endfor; endif; ?>
		    </div>			</td>
	     </tr>
		 <tr>
		   <td width="15%">眼部疾病</td>
		   <td colspan="5" align="left">
		   <?php $_from = $this->_tpl_vars['eyedisease_status_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="set_input_many('<?php echo $this->_tpl_vars['k']; ?>
','eyedisease_status[]');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
		   <?php endforeach; endif; unset($_from); ?> 
	       <input type="text" name="eyedisease_other" id="eyedisease_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['eyedisease_other']; ?>
" disabled="disabled"/>
		   <div align="right">
              <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=3) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
              <input type="text" id="eyedisease_status" name="eyedisease_status[]"  class="inputnew" value="<?php echo $this->_tpl_vars['eyedisease_status_current'][$this->_sections['customer']['index']]; ?>
" maxlength="1"/>/
			  <?php endfor; endif; ?>
		    </div>			</td>
	     </tr>
		  <tr>
		   <td width="15%">神经系统疾病</td>
		   <td colspan="5" align="left">
		   <?php $_from = $this->_tpl_vars['nervousdisease_status_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="skinget('nervousdisease_status','nervousdisease_other','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		   <?php endforeach; endif; unset($_from); ?> 
	       <input type="text" name="nervousdisease_other" id="nervousdisease_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['nervousdisease_other']; ?>
"/>
		   <div align="right">
              <input type="text" id="nervousdisease_status" name="nervousdisease_status"  class="inputnew" value="<?php echo $this->_tpl_vars['nervousdisease_status_current']; ?>
" maxlength="1" onblur="loadinput_lone('nervousdisease_status','nervousdisease_other','2');"/>
		    </div>			</td>
	     </tr>
		 <tr>
		   <td width="15%">其他系统疾病</td>
		   <td colspan="5" align="left">
		   <?php $_from = $this->_tpl_vars['otherdisease_status_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		   <label onclick="skinget('otherdisease_status','otherdisease_other','<?php echo $this->_tpl_vars['k']; ?>
','2');"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		   <?php endforeach; endif; unset($_from); ?> 
	       <input type="text" name="otherdisease_other" id="otherdisease_other"  class="inputbottom" value="<?php echo $this->_tpl_vars['otherdisease_other']; ?>
"/>
		   <div align="right">
              <input type="text" id="otherdisease_status" name="otherdisease_status"  class="inputnew" value="<?php echo $this->_tpl_vars['otherdisease_status_current']; ?>
" maxlength="1" onblur="loadinput_lone('otherdisease_status','otherdisease_other','2');"/>
		    </div>			</td>
	     </tr>
		 <!--现存主要健康问题结束-->
		 <!--住院治疗情况开始-->
		 <tr>
		   <td rowspan="6" width="12%">住院治疗情况<img title="“住院治疗情况：指最近1年内的住院治疗情况。应逐项填写。日期填写年月，年份必须写4位。如因慢性病急性发作或加重而住院/家庭病床，请特别说明。医疗机构名称应写全称。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
		   <td rowspan="3">住院史</td>
		   <td colspan="2">入/出院日期</td>
		   <td>原因</td>
		   <td>医疗机构名称</td>
		   <td>病案号</td>
		 </tr>
		 <?php unset($this->_sections['et_hospitalization_array']);
$this->_sections['et_hospitalization_array']['name'] = 'et_hospitalization_array';
$this->_sections['et_hospitalization_array']['loop'] = is_array($_loop=10) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['et_hospitalization_array']['show'] = true;
$this->_sections['et_hospitalization_array']['max'] = $this->_sections['et_hospitalization_array']['loop'];
$this->_sections['et_hospitalization_array']['step'] = 1;
$this->_sections['et_hospitalization_array']['start'] = $this->_sections['et_hospitalization_array']['step'] > 0 ? 0 : $this->_sections['et_hospitalization_array']['loop']-1;
if ($this->_sections['et_hospitalization_array']['show']) {
    $this->_sections['et_hospitalization_array']['total'] = $this->_sections['et_hospitalization_array']['loop'];
    if ($this->_sections['et_hospitalization_array']['total'] == 0)
        $this->_sections['et_hospitalization_array']['show'] = false;
} else
    $this->_sections['et_hospitalization_array']['total'] = 0;
if ($this->_sections['et_hospitalization_array']['show']):

            for ($this->_sections['et_hospitalization_array']['index'] = $this->_sections['et_hospitalization_array']['start'], $this->_sections['et_hospitalization_array']['iteration'] = 1;
                 $this->_sections['et_hospitalization_array']['iteration'] <= $this->_sections['et_hospitalization_array']['total'];
                 $this->_sections['et_hospitalization_array']['index'] += $this->_sections['et_hospitalization_array']['step'], $this->_sections['et_hospitalization_array']['iteration']++):
$this->_sections['et_hospitalization_array']['rownum'] = $this->_sections['et_hospitalization_array']['iteration'];
$this->_sections['et_hospitalization_array']['index_prev'] = $this->_sections['et_hospitalization_array']['index'] - $this->_sections['et_hospitalization_array']['step'];
$this->_sections['et_hospitalization_array']['index_next'] = $this->_sections['et_hospitalization_array']['index'] + $this->_sections['et_hospitalization_array']['step'];
$this->_sections['et_hospitalization_array']['first']      = ($this->_sections['et_hospitalization_array']['iteration'] == 1);
$this->_sections['et_hospitalization_array']['last']       = ($this->_sections['et_hospitalization_array']['iteration'] == $this->_sections['et_hospitalization_array']['total']);
?>
			<?php if ($this->_sections['et_hospitalization_array']['rownum'] < 2): ?>
		 <tr>
		   <td colspan="2">
		   <input type="text" name="be_hospitalized_time[]" class="inputbottom" id="be_hospitalized_time" value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['be_hospitalized_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>/
		   <input type="text" name="leave_hospital_time[]" class="inputbottom" id="leave_hospital_time"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['leave_hospital_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>		   </td>
		   <td><input type="text" name="hh_reason[]" class="inputbottom" id="hh_reason"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['reason']; ?>
"/></td>
		   <td><input type="text" name="hh_organization[]" class="inputbottom" id="hh_organization"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['organization']; ?>
"/></td>
		   <td><input type="text" name="hh_record_no[]" class="inputbottom" id="hh_record_no"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['record_no']; ?>
"/></td>
		 </tr>
		 <?php elseif ($this->_sections['et_hospitalization_array']['rownum'] == 2): ?>
		 <tr>
		   <td colspan="2">
		   <input type="text" name="be_hospitalized_time[]" class="inputbottom" id="be_hospitalized_time" value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['be_hospitalized_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>/
		   <input type="text" name="leave_hospital_time[]" class="inputbottom" id="leave_hospital_time" value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['leave_hospital_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>		   </td>
		   <td><input type="text" name="hh_reason[]" class="inputbottom" id="hh_reason" value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['reason']; ?>
"/></td>
		   <td><input type="text" name="hh_organization[]" class="inputbottom" id="hh_organization"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['organization']; ?>
"/></td>
		   <td><input type="text" name="hh_record_no[]" class="inputbottom" id="hh_record_no"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['record_no']; ?>
"/><input type="button" id="hh_popup_button" value="...">
		   <div id="hh_popup" style="display:none;">
			<table width="100%" class="center">
				<thead>
					<tr><th colspan="2">入/出院日期</th><th>原因</th><th>医疗机构名称</th><th>病案号</th></tr>
				</thead>
				<tbody>
					<tr>
					   <td colspan="2">
					   <input type="text" name="be_hospitalized_time[]" class="inputbottom" id="be_hospitalized_time" value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['be_hospitalized_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>/
					   <input type="text" name="leave_hospital_time[]" class="inputbottom" id="leave_hospital_time"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['leave_hospital_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>		   </td>
					   <td><input type="text" name="hh_reason[]" class="inputbottom" id="hh_reason"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['reason']; ?>
"/></td>
					   <td><input type="text" name="hh_organization[]" class="inputbottom" id="hh_organization"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['organization']; ?>
"/></td>
					   <td><input type="text" name="hh_record_no[]" class="inputbottom" id="hh_record_no"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['record_no']; ?>
"/></td>
					 </tr>
					 <?php elseif ($this->_sections['et_hospitalization_array']['rownum'] > 3): ?>
					 <tr>
					   <td colspan="2">
					   <input type="text" name="be_hospitalized_time[]" class="inputbottom" id="be_hospitalized_time" value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['be_hospitalized_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>/
					   <input type="text" name="leave_hospital_time[]" class="inputbottom" id="leave_hospital_time"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['leave_hospital_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>		   </td>
					   <td><input type="text" name="hh_reason[]" class="inputbottom" id="hh_reason"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['reason']; ?>
"/></td>
					   <td><input type="text" name="hh_organization[]" class="inputbottom" id="hh_organization"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['organization']; ?>
"/></td>
					   <td><input type="text" name="hh_record_no[]" class="inputbottom" id="hh_record_no"  value="<?php echo $this->_tpl_vars['et_hospitalization_array'][$this->_sections['et_hospitalization_array']['index']]['record_no']; ?>
"/></td>
					 </tr>
					 <?php endif; ?>
			<?php endfor; endif; ?>
				</tbody>
			</table>
			</div>
		   </td>
		 </tr>
		 <tr>
		   <td rowspan="3">家庭病床史</td>
		   <td colspan="2">建/撤床日期</td>
		   <td>原因</td>
		   <td>医疗机构名称</td>
		   <td>病案号</td>
		 </tr>
		 <?php unset($this->_sections['et_operation_array']);
$this->_sections['et_operation_array']['name'] = 'et_operation_array';
$this->_sections['et_operation_array']['loop'] = is_array($_loop=10) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['et_operation_array']['show'] = true;
$this->_sections['et_operation_array']['max'] = $this->_sections['et_operation_array']['loop'];
$this->_sections['et_operation_array']['step'] = 1;
$this->_sections['et_operation_array']['start'] = $this->_sections['et_operation_array']['step'] > 0 ? 0 : $this->_sections['et_operation_array']['loop']-1;
if ($this->_sections['et_operation_array']['show']) {
    $this->_sections['et_operation_array']['total'] = $this->_sections['et_operation_array']['loop'];
    if ($this->_sections['et_operation_array']['total'] == 0)
        $this->_sections['et_operation_array']['show'] = false;
} else
    $this->_sections['et_operation_array']['total'] = 0;
if ($this->_sections['et_operation_array']['show']):

            for ($this->_sections['et_operation_array']['index'] = $this->_sections['et_operation_array']['start'], $this->_sections['et_operation_array']['iteration'] = 1;
                 $this->_sections['et_operation_array']['iteration'] <= $this->_sections['et_operation_array']['total'];
                 $this->_sections['et_operation_array']['index'] += $this->_sections['et_operation_array']['step'], $this->_sections['et_operation_array']['iteration']++):
$this->_sections['et_operation_array']['rownum'] = $this->_sections['et_operation_array']['iteration'];
$this->_sections['et_operation_array']['index_prev'] = $this->_sections['et_operation_array']['index'] - $this->_sections['et_operation_array']['step'];
$this->_sections['et_operation_array']['index_next'] = $this->_sections['et_operation_array']['index'] + $this->_sections['et_operation_array']['step'];
$this->_sections['et_operation_array']['first']      = ($this->_sections['et_operation_array']['iteration'] == 1);
$this->_sections['et_operation_array']['last']       = ($this->_sections['et_operation_array']['iteration'] == $this->_sections['et_operation_array']['total']);
?>
			<?php if ($this->_sections['et_operation_array']['rownum'] < 2): ?>
		 <tr>
		   <td colspan="2">
		   <input type="text" name="put_bed_time[]" class="inputbottom" id="put_bed_time" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['put_bed_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>/
		   <input type="text" name="receive_bed_time[]" class="inputbottom" id="receive_bed_time" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['receive_bed_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>		   </td>
		   <td><input type="text" name="oh_reason[]" class="inputbottom" id="oh_reason" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['reason']; ?>
"/></td>
		   <td><input type="text" name="oh_organization[]" class="inputbottom" id="oh_organization" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['organization']; ?>
"/></td>
		   <td><input type="text" name="oh_record_no[]" class="inputbottom" id="oh_record_no" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['record_no']; ?>
"/></td>
		 </tr>
		  <?php elseif ($this->_sections['et_operation_array']['rownum'] == 2): ?>
		 <tr>
		   <td colspan="2">
		   <input type="text" name="put_bed_time[]" class="inputbottom" id="put_bed_time" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['put_bed_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>/
		   <input type="text" name="receive_bed_time[]" class="inputbottom" id="receive_bed_time" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['receive_bed_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>		   </td>
		   <td><input type="text" name="oh_reason[]" class="inputbottom" id="oh_reason" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['reason']; ?>
"/></td>
		   <td><input type="text" name="oh_organization[]" class="inputbottom" id="oh_organization" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['organization']; ?>
"/></td>
		   <td><input type="text" name="oh_record_no[]" class="inputbottom" id="oh_record_no" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['record_no']; ?>
"/>
		   <input type="button" id="oh_popup_button" value="...">
		   <div id="oh_popup" style="display:none;">
			<table width="100%" class="center">
				<thead>
					<tr><th colspan="2">建/撤床日期</th><th>原因</th><th>医疗机构名称</th><th>病案号</th></tr>
				</thead>
				<tbody>
					<tr>
					   <td colspan="2">
					   <input type="text" name="put_bed_time[]" class="inputbottom" id="put_bed_time" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['put_bed_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>/
					   <input type="text" name="receive_bed_time[]" class="inputbottom" id="receive_bed_time" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['receive_bed_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>		   </td>
					   <td><input type="text" name="oh_reason[]" class="inputbottom" id="oh_reason" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['reason']; ?>
"/></td>
					   <td><input type="text" name="oh_organization[]" class="inputbottom" id="oh_organization" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['organization']; ?>
"/></td>
					   <td><input type="text" name="oh_record_no[]" class="inputbottom" id="oh_record_no" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['record_no']; ?>
"/></td>
					 </tr>
					  <?php elseif ($this->_sections['et_operation_array']['rownum'] > 3): ?>
					 <tr>
					   <td colspan="2">
					   <input type="text" name="put_bed_time[]" class="inputbottom" id="put_bed_time" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['put_bed_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>/
					   <input type="text" name="receive_bed_time[]" class="inputbottom" id="receive_bed_time" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['receive_bed_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})"/>		   </td>
					   <td><input type="text" name="oh_reason[]" class="inputbottom" id="oh_reason" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['reason']; ?>
"/></td>
					   <td><input type="text" name="oh_organization[]" class="inputbottom" id="oh_organization" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['organization']; ?>
"/></td>
					   <td><input type="text" name="oh_record_no[]" class="inputbottom" id="oh_record_no" value="<?php echo $this->_tpl_vars['et_operation_array'][$this->_sections['et_operation_array']['index']]['record_no']; ?>
"/></td>
					 </tr>
					  <?php endif; ?>
			<?php endfor; endif; ?>
				</tbody>
			</table>
			</div>
		   </td>
		 </tr>
		 <!--住院治疗结束-->
		 <!--主要用药情况开始-->
		 <tr>
		    <td rowspan="7" width="12%">主要用药情况<img title="“主要用药情况：对长期服药的慢性病患者了解其最近1年内的主要用药情况，西药填写化学名（通用名）而非商品名，中药填写药品名称或中药汤剂，用法、用量按医生医嘱填写。用药时间指在此时间段内一共服用此药的时间，单位为年、月或天。服药依从性是指对此药的依从情况，“规律”为按医嘱服药，“间断”为未按医嘱服药，频次或数量不足，“不服药”即为医生开了处方，但患者未使用此药。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
			<td>药物名称</td>
			<td colspan="2">用法</td>
			<td>用量</td>
			<td>用药时间</td>
			<td>服药依从性 
			<?php $_from = $this->_tpl_vars['drug_compliance_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		    <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		    <?php endforeach; endif; unset($_from); ?></td>
		 </tr>
		 <?php unset($this->_sections['et_main_drug_array']);
$this->_sections['et_main_drug_array']['name'] = 'et_main_drug_array';
$this->_sections['et_main_drug_array']['loop'] = is_array($_loop=14) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['et_main_drug_array']['show'] = true;
$this->_sections['et_main_drug_array']['max'] = $this->_sections['et_main_drug_array']['loop'];
$this->_sections['et_main_drug_array']['step'] = 1;
$this->_sections['et_main_drug_array']['start'] = $this->_sections['et_main_drug_array']['step'] > 0 ? 0 : $this->_sections['et_main_drug_array']['loop']-1;
if ($this->_sections['et_main_drug_array']['show']) {
    $this->_sections['et_main_drug_array']['total'] = $this->_sections['et_main_drug_array']['loop'];
    if ($this->_sections['et_main_drug_array']['total'] == 0)
        $this->_sections['et_main_drug_array']['show'] = false;
} else
    $this->_sections['et_main_drug_array']['total'] = 0;
if ($this->_sections['et_main_drug_array']['show']):

            for ($this->_sections['et_main_drug_array']['index'] = $this->_sections['et_main_drug_array']['start'], $this->_sections['et_main_drug_array']['iteration'] = 1;
                 $this->_sections['et_main_drug_array']['iteration'] <= $this->_sections['et_main_drug_array']['total'];
                 $this->_sections['et_main_drug_array']['index'] += $this->_sections['et_main_drug_array']['step'], $this->_sections['et_main_drug_array']['iteration']++):
$this->_sections['et_main_drug_array']['rownum'] = $this->_sections['et_main_drug_array']['iteration'];
$this->_sections['et_main_drug_array']['index_prev'] = $this->_sections['et_main_drug_array']['index'] - $this->_sections['et_main_drug_array']['step'];
$this->_sections['et_main_drug_array']['index_next'] = $this->_sections['et_main_drug_array']['index'] + $this->_sections['et_main_drug_array']['step'];
$this->_sections['et_main_drug_array']['first']      = ($this->_sections['et_main_drug_array']['iteration'] == 1);
$this->_sections['et_main_drug_array']['last']       = ($this->_sections['et_main_drug_array']['iteration'] == $this->_sections['et_main_drug_array']['total']);
?>
			<?php if ($this->_sections['et_main_drug_array']['rownum'] < 6): ?>
		 <tr>
			<td><?php echo $this->_sections['et_main_drug_array']['rownum']; ?>
<input type="text" name="drug_name[]" class="inputbottom" id="drug_name" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_name']; ?>
"/></td>
			<td colspan="2"><input type="text" name="drug_usage[]" class="inputbottom" id="drug_usage" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_usage']; ?>
"/></td>
			<td><input type="text" name="drug_dosage[]" class="inputbottom" id="drug_dosage" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_dosage']; ?>
"/></td>
			<td><input type="text" name="drug_time[]" class="inputbottom" id="drug_time" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})" /></td>
			<td><input type="text" name="drug_compliance[]" class="inputbottom" id="drug_compliance" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_compliance']; ?>
"/></td>
		 </tr>
		  <?php elseif ($this->_sections['et_main_drug_array']['rownum'] == 6): ?>
		 <tr>
			<td><?php echo $this->_sections['et_main_drug_array']['rownum']; ?>
<input type="text" name="drug_name[]" class="inputbottom" id="drug_name" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_name']; ?>
"/></td>
			<td colspan="2"><input type="text" name="drug_usage[]" class="inputbottom" id="drug_usage" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_usage']; ?>
"/></td>
			<td><input type="text" name="drug_dosage[]" class="inputbottom" id="drug_dosage" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_dosage']; ?>
"/></td>
			<td><input type="text" name="drug_time[]" class="inputbottom" id="drug_time" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})" /></td>
			<td><input type="text" name="drug_compliance[]" class="inputbottom" id="drug_compliance" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_compliance']; ?>
"/>
			 <input type="button" id="drug_popup_button" value="...">
			<div id="drug_popup" style="display:none;">
			<table width="100%" class="center">
				<thead>
					<tr><th>&nbsp;</th><th>药物名称</th><th colspan="2">用法</th><th>用量</th><th>用药时间</th><th>服药依从性 <br />
			<?php $_from = $this->_tpl_vars['drug_compliance_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		    <label ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
		    <?php endforeach; endif; unset($_from); ?></th></tr>
				</thead>
				<tbody>
					<?php elseif ($this->_sections['et_main_drug_array']['rownum'] == 7): ?>
					<tr>
						<td><?php echo $this->_sections['et_main_drug_array']['rownum']; ?>
</td>
						<td><input type="text" name="drug_name[]" class="inputbottom" id="drug_name" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_name']; ?>
"/></td>
						<td colspan="2"><input type="text" name="drug_usage[]" class="inputbottom" id="drug_usage" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_usage']; ?>
"/></td>
						<td><input type="text" name="drug_dosage[]" class="inputbottom" id="drug_dosage" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_dosage']; ?>
"/></td>
						<td><input type="text" name="drug_time[]" class="inputbottom" id="drug_time" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})" /></td>
						<td><input type="text" name="drug_compliance[]" class="inputbottom" id="drug_compliance" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_compliance']; ?>
"/></td>
					 </tr>
					 <?php elseif ($this->_sections['et_main_drug_array']['rownum'] > 7): ?>
					 <tr>
					 	<td><?php echo $this->_sections['et_main_drug_array']['rownum']; ?>
</td>
						<td><input type="text" name="drug_name[]" class="inputbottom" id="drug_name" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_name']; ?>
"/></td>
						<td colspan="2"><input type="text" name="drug_usage[]" class="inputbottom" id="drug_usage" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_usage']; ?>
"/></td>
						<td><input type="text" name="drug_dosage[]" class="inputbottom" id="drug_dosage" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_dosage']; ?>
"/></td>
						<td><input type="text" name="drug_time[]" class="inputbottom" id="drug_time" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_time']; ?>
" onClick="WdatePicker({firstDayOfWeek:1})" /></td>
						<td><input type="text" name="drug_compliance[]" class="inputbottom" id="drug_compliance" value="<?php echo $this->_tpl_vars['et_main_drug_array'][$this->_sections['et_main_drug_array']['index']]['drug_compliance']; ?>
"/></td>
					 </tr>
					 <?php endif; ?>
			<?php endfor; endif; ?>
				</tbody>
			</table>
			</div>
			</td>
		 </tr>
		 <!--非免疫规划预防接种史开始-->
		 <tr>
		    <td rowspan="4" width="12%">非免疫规划预防接种史<img title="“非免疫规划预防接种史：填写最近1年内接种的疫苗的名称、接种日期和接种机构。疫苗名称填写应完整准确。”
直接输入，不与预防接种模块联动
。”" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
			<td>名称</td>
			<td colspan="2">接种日期</td>
			<td colspan="3">接种机构</td>
		 </tr>
		 <?php unset($this->_sections['et_nonepi_array']);
$this->_sections['et_nonepi_array']['name'] = 'et_nonepi_array';
$this->_sections['et_nonepi_array']['loop'] = is_array($_loop=11) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['et_nonepi_array']['show'] = true;
$this->_sections['et_nonepi_array']['max'] = $this->_sections['et_nonepi_array']['loop'];
$this->_sections['et_nonepi_array']['step'] = 1;
$this->_sections['et_nonepi_array']['start'] = $this->_sections['et_nonepi_array']['step'] > 0 ? 0 : $this->_sections['et_nonepi_array']['loop']-1;
if ($this->_sections['et_nonepi_array']['show']) {
    $this->_sections['et_nonepi_array']['total'] = $this->_sections['et_nonepi_array']['loop'];
    if ($this->_sections['et_nonepi_array']['total'] == 0)
        $this->_sections['et_nonepi_array']['show'] = false;
} else
    $this->_sections['et_nonepi_array']['total'] = 0;
if ($this->_sections['et_nonepi_array']['show']):

            for ($this->_sections['et_nonepi_array']['index'] = $this->_sections['et_nonepi_array']['start'], $this->_sections['et_nonepi_array']['iteration'] = 1;
                 $this->_sections['et_nonepi_array']['iteration'] <= $this->_sections['et_nonepi_array']['total'];
                 $this->_sections['et_nonepi_array']['index'] += $this->_sections['et_nonepi_array']['step'], $this->_sections['et_nonepi_array']['iteration']++):
$this->_sections['et_nonepi_array']['rownum'] = $this->_sections['et_nonepi_array']['iteration'];
$this->_sections['et_nonepi_array']['index_prev'] = $this->_sections['et_nonepi_array']['index'] - $this->_sections['et_nonepi_array']['step'];
$this->_sections['et_nonepi_array']['index_next'] = $this->_sections['et_nonepi_array']['index'] + $this->_sections['et_nonepi_array']['step'];
$this->_sections['et_nonepi_array']['first']      = ($this->_sections['et_nonepi_array']['iteration'] == 1);
$this->_sections['et_nonepi_array']['last']       = ($this->_sections['et_nonepi_array']['iteration'] == $this->_sections['et_nonepi_array']['total']);
?>
			<?php if ($this->_sections['et_nonepi_array']['rownum'] < 3): ?>
		 <tr>
			<td><?php echo $this->_sections['et_nonepi_array']['rownum']; ?>
<input type="text" value="<?php echo $this->_tpl_vars['et_nonepi_array'][$this->_sections['et_nonepi_array']['index']]['vaccination_name']; ?>
" name="vaccination_name[]" class="inputbottom" id="vaccination_name"/></td>
			<td colspan="2"><input type="text" value="<?php echo $this->_tpl_vars['et_nonepi_array'][$this->_sections['et_nonepi_array']['index']]['vaccination_time']; ?>
" name="vaccination_time[]" class="inputbottom" id="vaccination_time" onClick="WdatePicker({firstDayOfWeek:1})"/></td>
			<td colspan="3"><input type="text" value="<?php echo $this->_tpl_vars['et_nonepi_array'][$this->_sections['et_nonepi_array']['index']]['vaccination_org']; ?>
" name="vaccination_org[]" class="inputbottom" id="vaccination_org"/></td>
		 </tr>
		 <?php elseif ($this->_sections['et_nonepi_array']['rownum'] == 3): ?>
		 <tr>
			<td><?php echo $this->_sections['et_nonepi_array']['rownum']; ?>
<input type="text" value="<?php echo $this->_tpl_vars['et_nonepi_array'][$this->_sections['et_nonepi_array']['index']]['vaccination_name']; ?>
" name="vaccination_name[]" class="inputbottom" id="vaccination_name"/></td>
			<td colspan="2"><input type="text" value="<?php echo $this->_tpl_vars['et_nonepi_array'][$this->_sections['et_nonepi_array']['index']]['vaccination_time']; ?>
" name="vaccination_time[]" class="inputbottom" id="vaccination_time" onClick="WdatePicker({firstDayOfWeek:1})"/></td>
			<td colspan="3"><input type="text" value="<?php echo $this->_tpl_vars['et_nonepi_array'][$this->_sections['et_nonepi_array']['index']]['vaccination_org']; ?>
" name="vaccination_org[]" class="inputbottom" id="vaccination_org"/>
			<input type="button" id="vacc_popup_button" value="...">
			<div id="vacc_popup" style="display:none;">
			<table width="100%" class="center">
				<thead>
					<tr><th>&nbsp;</th><th>名称</th><th colspan="2">接种日期</th><th colspan="3">接种机构</th></tr>
				</thead>
				<tbody>
					<?php elseif ($this->_sections['et_nonepi_array']['rownum'] == 4): ?>
					<tr>
						<td><?php echo $this->_sections['et_nonepi_array']['rownum']; ?>
</td>
						<td><input type="text" value="<?php echo $this->_tpl_vars['et_nonepi_array'][$this->_sections['et_nonepi_array']['index']]['vaccination_name']; ?>
" name="vaccination_name[]" class="inputbottom" id="vaccination_name"/></td>
						<td colspan="2"><input type="text" value="<?php echo $this->_tpl_vars['et_nonepi_array'][$this->_sections['et_nonepi_array']['index']]['vaccination_time']; ?>
" name="vaccination_time[]" class="inputbottom" id="vaccination_time" onClick="WdatePicker({firstDayOfWeek:1})"/></td>
						<td colspan="3"><input type="text" value="<?php echo $this->_tpl_vars['et_nonepi_array'][$this->_sections['et_nonepi_array']['index']]['vaccination_org']; ?>
" name="vaccination_org[]" class="inputbottom" id="vaccination_org"/></td>
					 </tr>
					 <?php elseif ($this->_sections['et_nonepi_array']['rownum'] > 4): ?>
					 <tr>
					 	<td><?php echo $this->_sections['et_nonepi_array']['rownum']; ?>
</td>
						<td><input type="text" value="<?php echo $this->_tpl_vars['et_nonepi_array'][$this->_sections['et_nonepi_array']['index']]['vaccination_name']; ?>
" name="vaccination_name[]" class="inputbottom" id="vaccination_name"/></td>
						<td colspan="2"><input type="text" value="<?php echo $this->_tpl_vars['et_nonepi_array'][$this->_sections['et_nonepi_array']['index']]['vaccination_time']; ?>
" name="vaccination_time[]" class="inputbottom" id="vaccination_time" onClick="WdatePicker({firstDayOfWeek:1})"/></td>
						<td colspan="3"><input type="text" value="<?php echo $this->_tpl_vars['et_nonepi_array'][$this->_sections['et_nonepi_array']['index']]['vaccination_org']; ?>
" name="vaccination_org[]" class="inputbottom" id="vaccination_org"/></td>
					 </tr>
					 <?php endif; ?>
			<?php endfor; endif; ?>
				</tbody>
			</table>
			</div>
			</td>
		 </tr>
		 <!--非免疫规划预防接种史结束-->
		 <!--健康评价开始-->
		 <tr>
		   <td>健康评价</td>
		   <td colspan="6" align="left">
		      <?php $_from = $this->_tpl_vars['health_evaluation_assessment_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		      <div style=" width:100%;  float: left;"><label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','health_evaluation')" ><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;</div>
		      <?php endforeach; endif; unset($_from); ?>		    
			
			  <div align="right" style="float:right;">
                   <input type="text" id="et_health_evaluation" name="health_evaluation" value="<?php echo $this->_tpl_vars['health_evaluation_assessment_current']; ?>
" class="inputnew" maxlength="1" onblur="checkheal('et_health_evaluation');"/>
		      </div>
		      <?php unset($this->_sections['contact']);
$this->_sections['contact']['name'] = 'contact';
$this->_sections['contact']['loop'] = is_array($_loop=4) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['contact']['show'] = true;
$this->_sections['contact']['max'] = $this->_sections['contact']['loop'];
$this->_sections['contact']['step'] = 1;
$this->_sections['contact']['start'] = $this->_sections['contact']['step'] > 0 ? 0 : $this->_sections['contact']['loop']-1;
if ($this->_sections['contact']['show']) {
    $this->_sections['contact']['total'] = $this->_sections['contact']['loop'];
    if ($this->_sections['contact']['total'] == 0)
        $this->_sections['contact']['show'] = false;
} else
    $this->_sections['contact']['total'] = 0;
if ($this->_sections['contact']['show']):

            for ($this->_sections['contact']['index'] = $this->_sections['contact']['start'], $this->_sections['contact']['iteration'] = 1;
                 $this->_sections['contact']['iteration'] <= $this->_sections['contact']['total'];
                 $this->_sections['contact']['index'] += $this->_sections['contact']['step'], $this->_sections['contact']['iteration']++):
$this->_sections['contact']['rownum'] = $this->_sections['contact']['iteration'];
$this->_sections['contact']['index_prev'] = $this->_sections['contact']['index'] - $this->_sections['contact']['step'];
$this->_sections['contact']['index_next'] = $this->_sections['contact']['index'] + $this->_sections['contact']['step'];
$this->_sections['contact']['first']      = ($this->_sections['contact']['iteration'] == 1);
$this->_sections['contact']['last']       = ($this->_sections['contact']['iteration'] == $this->_sections['contact']['total']);
?>
			  <div style=" width:100%;  float: left;"> 异常  <?php echo $this->_sections['contact']['iteration']; ?>
  
			    <input type="text" name="health_exception[]" id="health_exception<?php echo $this->_sections['contact']['iteration']; ?>
"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['health_evaluation_exception'][$this->_sections['contact']['index']]; ?>
"/>
			  </div>
			 <?php endfor; endif; ?>
	       </td>
		 </tr>
		 <!--健康评价结束-->
		 <!--健康指导开始-->
		 <tr>
		    <td>健康指导</td>
			<td colspan="4" align="left">
			  <?php $_from = $this->_tpl_vars['health_assessment_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			  <div style=" width:100%;  float: right;"><label onclick="set_input_many('<?php echo $this->_tpl_vars['k']; ?>
','health_assessment[]')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;</div>
			  <?php endforeach; endif; unset($_from); ?>
			 
			  <div align="right" style="float:right;">
              <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=4) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                   <input type="text" id="health_assessment" name="health_assessment[]"  class="inputnew" value="<?php echo $this->_tpl_vars['health_assessment_current'][$this->_sections['customer']['index']]; ?>
" maxlength="1"/>/
			  <?php endfor; endif; ?>
		      </div>
			</td>
			<td colspan="2" align="left">
			   <div style=" width:100%;  float: right;">危险因素控制
			   <div align="right" style="float:right;">
			   <?php unset($this->_sections['risk_factor']);
$this->_sections['risk_factor']['name'] = 'risk_factor';
$this->_sections['risk_factor']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['risk_factor']['show'] = true;
$this->_sections['risk_factor']['max'] = $this->_sections['risk_factor']['loop'];
$this->_sections['risk_factor']['step'] = 1;
$this->_sections['risk_factor']['start'] = $this->_sections['risk_factor']['step'] > 0 ? 0 : $this->_sections['risk_factor']['loop']-1;
if ($this->_sections['risk_factor']['show']) {
    $this->_sections['risk_factor']['total'] = $this->_sections['risk_factor']['loop'];
    if ($this->_sections['risk_factor']['total'] == 0)
        $this->_sections['risk_factor']['show'] = false;
} else
    $this->_sections['risk_factor']['total'] = 0;
if ($this->_sections['risk_factor']['show']):

            for ($this->_sections['risk_factor']['index'] = $this->_sections['risk_factor']['start'], $this->_sections['risk_factor']['iteration'] = 1;
                 $this->_sections['risk_factor']['iteration'] <= $this->_sections['risk_factor']['total'];
                 $this->_sections['risk_factor']['index'] += $this->_sections['risk_factor']['step'], $this->_sections['risk_factor']['iteration']++):
$this->_sections['risk_factor']['rownum'] = $this->_sections['risk_factor']['iteration'];
$this->_sections['risk_factor']['index_prev'] = $this->_sections['risk_factor']['index'] - $this->_sections['risk_factor']['step'];
$this->_sections['risk_factor']['index_next'] = $this->_sections['risk_factor']['index'] + $this->_sections['risk_factor']['step'];
$this->_sections['risk_factor']['first']      = ($this->_sections['risk_factor']['iteration'] == 1);
$this->_sections['risk_factor']['last']       = ($this->_sections['risk_factor']['iteration'] == $this->_sections['risk_factor']['total']);
?>
                   <input type="text" name="risk_factor_col[]" value="<?php echo $this->_tpl_vars['risk_factor_col_arrray'][$this->_sections['risk_factor']['index']]; ?>
"  class="inputnew" maxlength="3" maxlength="1"/>/
				<?php endfor; endif; ?>
		      </div>
			   </div> 
			  <div style=" width:100%;  float: left;">
			  <?php $_from = $this->_tpl_vars['risk_factor_col_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			  <label onclick="set_input_many('<?php echo $this->_tpl_vars['k']; ?>
','risk_factor_col[]')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>
			  <?php endforeach; endif; unset($_from); ?>
			  <div style=" width:100%;  float: left;">
			  5 减体重 (目标 <input type="text" name="lose_weight" id="lose_weight" <?php if (! $this->_tpl_vars['lose_weight_sign']): ?> disabled="disabled"<?php endif; ?>  class="inputbottomlong" value="<?php echo $this->_tpl_vars['lose_weight']; ?>
"/> )
			  </div>
			  <div style=" width:100%;  float: left;">
			  6 建议疫苗接种 <input type="text" name="recommended_vaccination" <?php if (! $this->_tpl_vars['recommended_vaccination_sign']): ?> disabled="disabled"<?php endif; ?> id="recommended_vaccination"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['recommended_vaccination']; ?>
"/>
			  </div>
			  <div style=" width:100%;  float: left;">
			  7 其他 <input type="text" name="risk_factor_col_other" <?php if (! $this->_tpl_vars['risk_factor_col_other_sign']): ?> disabled="disabled"<?php endif; ?> id="risk_factor_col_other"  class="inputbottomlong" value="<?php echo $this->_tpl_vars['risk_factor_col_other']; ?>
"/>
			  </div>
		   </td>
		 </tr>
		 <!--健康指导结束-->
         <tr class="endbg"><td colspan="8" style="text-align:center;"><input type="submit"  value="提交" class="inputbutton"/>&nbsp;&nbsp;<input type="button" onclick="javascript:window.location='<?php echo $this->_tpl_vars['basePath']; ?>
et/index/index'" value="返回" class="inputbutton"/> <?php if ($this->_tpl_vars['uuid'] != ""): ?>&nbsp;&nbsp;<input type="button" name="print" id="print" value="打印" onclick="javascript:window.print();" class="inputbutton"/><?php endif; ?></td></tr>
	
</table>
</form> 
</body>
</html>