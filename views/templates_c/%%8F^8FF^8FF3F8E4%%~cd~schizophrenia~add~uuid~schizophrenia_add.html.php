<?php /* Smarty version 2.6.14, created on 2013-11-01 09:51:36
         compiled from schizophrenia_add.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'schizophrenia_add.html', 645, false),)), $this); ?>
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
<title>重性精神疾病患者随访服务记录表</title>
<style>
.STYLE1 {font-weight: bold}
.STYLE2 {font-weight: bold}
label
{
	cursor:hand;
	cursor: pointer;
}
</style>
<script type="text/javascript">

	$(document).ready(function(){
				
		//是否转诊
		function chk_referral(){
			var is_referral_json_array = jQuery.parseJSON('<?php echo $this->_tpl_vars['is_referral_json']; ?>
');
			var input_val = $("input[name='is_referral']").val();
			if (input_val != "" && is_referral_json_array[input_val][0] == "2") {
				$("#reason_referral").attr("disabled", false);
				$("#hospital_referral").attr("disabled", false);			
				if ($("#reason_referral").val() == "") {
					$("#reason_referral").focus();
				}
				return false;//只要出现了其他项，则退出
			}
			else {
				$("#reason_referral").attr("disabled", true);
				$("#hospital_referral").attr("disabled", true);
			}
		}
		//实验室检查
		function chk_lab_examination(){
			var lab_examination_array = jQuery.parseJSON('<?php echo $this->_tpl_vars['lab_examination_json']; ?>
');
			var input_val = $("input[name='is_lab_examination']").val();
			if (input_val != "" && lab_examination_array[input_val][0] == "2") {
				$("#lab_examination").attr("disabled", false);			
				if ($("#lab_examination").val() == "") {
					$("#lab_examination").focus();
				}
				return false;//只要出现了其他项，则退出
			}
			else {
				$("#lab_examination").attr("disabled", true);

			}
		}
		//药物不良反应
		function chk_adverse_drug(){
			var adverse_drug_array = jQuery.parseJSON('<?php echo $this->_tpl_vars['adverse_drug_json']; ?>
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
		
		
		//=============处理过程============
		chk_referral();//是否转诊
	 	$("#is_referral").blur(function(){chk_referral();});//
	 	chk_lab_examination();//实验室检查
	 	$("#is_lab_examination").blur(function(){chk_lab_examination();});//实验室检查
	 	chk_adverse_drug();//药物不良反应
	 	$("#adverse_drug").blur(function(){chk_adverse_drug();});//
		
		//目前症状
		$("input[name='present_symptoms[]']").each(function(){
			 $(this).blur(function(){
				$("input[name='present_symptoms[]']").each(function(){
				var present_symptoms_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['present_symptoms_json']; ?>
');
				var input_val=$(this).val();
				//输入数字没有定义退出循环并且清除当前数据	
				if(typeof(present_symptoms_array[input_val])=="undefined"){
					$(this).val("");
					//$(this).focus();
					return false;
				}
				//输入为空或者其它	
				if(input_val!="" && present_symptoms_array[input_val][0]=="-99")
				{
					
					$("#present_symptoms_other").attr("disabled",false);
					if($("#present_symptoms_other").val()=="")
					{
						$("#present_symptoms_other").focus();
					}
					return false;//只要出现了其他项，则退出					
				}
				else
				{				
					$("#present_symptoms_other").attr("disabled",true);
				}
				});
			});
		});
	    //康复措施
		$("input[name='rehabilitation_measures[]']").each(function(){
			 $(this).blur(function(){
				$("input[name='rehabilitation_measures[]']").each(function(){
				var rehabilitation_measures_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['rehabilitation_measures_json']; ?>
');
				var input_val=$(this).val();			
				if(input_val!="" && rehabilitation_measures_array[input_val][0]=="-99")
				{
					//alert(input_val);
					$("#rehabilitation_measure_other").attr("disabled",false);
					if($("#rehabilitation_measure_other").val()=="")
					{
						$("#rehabilitation_measure_other").focus();
					}
					return false;//只要出现了其他项，则退出					
				}
				else
				{				
					$("#rehabilitation_measure_other").attr("disabled",true);
				}
				});
			});
		});
		//===================以下生成工作计划条件===============
		//==精神分裂目前症状次数
		var present_symptoms_num="<?php echo $this->_tpl_vars['present_symptoms_num']; ?>
";
		//===自知力
		var insight_num="<?php echo $this->_tpl_vars['insight_current']; ?>
";
		//===社会功能
	    var social_function_num=0;
	    //个人生活料理 	    
	    var diet_num="<?php echo $this->_tpl_vars['diet_current']; ?>
";
	    //家务劳动	    
	    var housework_num="<?php echo $this->_tpl_vars['housework_current']; ?>
";
	    //生产劳动及工作	    
	    var work_num="<?php echo $this->_tpl_vars['work_current']; ?>
";
	    //学习能力	    
	    var learning_num="<?php echo $this->_tpl_vars['learning_current']; ?>
";
	    //社会人际交往
	    var human_communication_num="<?php echo $this->_tpl_vars['human_communication_current']; ?>
";
	    //===有影响社区社会或者家庭行为
	    var trouble_family_society=0;
		//1 轻度滋事mild_trouble
		var mild_trouble_num="<?php echo $this->_tpl_vars['mild_trouble']; ?>
";
		 //  2 肇事accident
        var accident_num="<?php echo $this->_tpl_vars['accident']; ?>
";
        // 3 肇祸zhaohuo
        var zhaohuo_num="<?php echo $this->_tpl_vars['zhaohuo']; ?>
";
        //  4 自伤self_wounding
        var self_wounding_num="<?php echo $this->_tpl_vars['self_wounding']; ?>
";
        // 5 自杀未遂attmpted_suicide
        var attmpted_suicide_num="<?php echo $this->_tpl_vars['attmpted_suicide']; ?>
";
         //=======药物不良反应
	    var adverse_drug_num="<?php echo $this->_tpl_vars['adverse_drug_current']; ?>
";
	    //========治疗效果
	    var treatment_effect_num="<?php echo $this->_tpl_vars['treatment_effect_current']; ?>
";
		$("input[name='present_symptoms[]']").each(function(){
			 $(this).blur(function(){
			 	present_symptoms_num="";
				$("input[name='present_symptoms[]']").each(function(){
				var present_symptoms_array=jQuery.parseJSON('<?php echo $this->_tpl_vars['present_symptoms_json']; ?>
');
				var input_val=$(this).val();	
				//输入的数字存在
				//alert(typeof(present_symptoms_array[input_val][0]));
				if("undefined" != typeof(present_symptoms_array[input_val]  && input_val!="") ){
					present_symptoms_num++;
					return ;
				}
				eval(process);//逻辑处理
				});
				//alert(present_symptoms_num);
			});
			//alert(present_symptoms_num);
		});
		//===自知力
		//var insight_num="<?php echo $this->_tpl_vars['insight_current']; ?>
";
	    $("input[name='insight']").blur(function(){
	    	insight_num	= $(this).val();
	    	eval(process);//逻辑处理
	    });
	    //===社会功能
	    // var social_function_num=0;
	    //个人生活料理 	    
	    //var diet_num="<?php echo $this->_tpl_vars['diet_current']; ?>
";
	    $("input[name='diet']").blur(function(){
	    	diet_num	= $(this).val();
	    	if(diet_num==3 || housework_num==3 || work_num==3 || learning_num==3 || human_communication_num==3){
		    	social_function_num=3;
		    }else{ 
		    	social_function_num=0;
		    }
		    eval(process);//逻辑处理
	    	
	    });
	    //家务劳动
	    
	    //var housework_num="<?php echo $this->_tpl_vars['housework_current']; ?>
";
	    $("input[name='housework']").blur(function(){
	    	housework_num	= $(this).val();
	    	if(diet_num==3 || housework_num==3 || work_num==3 || learning_num==3 || human_communication_num==3){
		    	social_function_num=3;
		    }else{ 
		    	social_function_num=0;
		    }
		    eval(process);//逻辑处理
	    });
	    //生产劳动及工作
	    
	    //var work_num="<?php echo $this->_tpl_vars['work_current']; ?>
";
	    $("input[name='work']").blur(function(){
	    	work_num	= $(this).val();
	    	if(diet_num==3 || housework_num==3 || work_num==3 || learning_num==3 || human_communication_num==3){
		    	social_function_num=3;
		    }else{ 
		    	social_function_num=0;
		    }
		    eval(process);//逻辑处理
	    });
	    //学习能力	    
	    //var learning_num="<?php echo $this->_tpl_vars['learning_current']; ?>
";
	    $("input[name='learning']").blur(function(){
	    	learning_num = $(this).val();
	    	if(diet_num==3 || housework_num==3 || work_num==3 || learning_num==3 || human_communication_num==3){
		    	social_function_num=3;
		    }else{ 
		    	social_function_num=0;
		    }
		    eval(process);//逻辑处理
	    });
	    //社会人际交往
	    //var human_communication_num="<?php echo $this->_tpl_vars['human_communication_current']; ?>
";
	    $("input[name='human_communication']").blur(function(){
	    	human_communication_num	= $(this).val();
	    	
	    	if(diet_num==3 || housework_num==3 || work_num==3 || learning_num==3 || human_communication_num==3){
		    	social_function_num=3;
		    }else{ 
		    	social_function_num=0;
		    }
		    eval(process);//逻辑处理
	    
	    });
	    //社会功能=个人生活料理+家务劳动+生产劳动及工作+学习能力+社会人际交往出现较差的情况
	    //if(diet_num==3 || housework_num==3 || work_num==3 || learning_num==3 || human_communication_num==3){
	    //	social_function_num=3;
	    //}
	   
	    //===有影响社区社会或者家庭行为
	     // var trouble_family_society=0;
		 //1 轻度滋事mild_trouble
		// var mild_trouble_num="<?php echo $this->_tpl_vars['mild_trouble']; ?>
";
	      $("input[name='mild_trouble']").blur(function(){
	    	mild_trouble_num	= $(this).val();
	    	if(mild_trouble_num>0 || accident_num>0 || zhaohuo_num>0 || self_wounding_num>0 || attmpted_suicide_num>0 ){
	    		trouble_family_society=1;
	    		
	    	}else{
	    		trouble_family_society=0;
	    	}
	    	eval(process);//逻辑处理
	      
	      });
          //  2 肇事accident
         // var accident_num="<?php echo $this->_tpl_vars['accident']; ?>
";
	      $("input[name='accident']").blur(function(){
	    	accident_num	= $(this).val();
	    	if(mild_trouble_num>0 || accident_num>0 || zhaohuo_num>0 || self_wounding_num>0 || attmpted_suicide_num>0 ){
	    		trouble_family_society=1;
	    		
	    	}else{
	    		trouble_family_society=0;
	    	}
	    	eval(process);//逻辑处理
	      });
          // 3 肇祸zhaohuo
          //var zhaohuo_num="<?php echo $this->_tpl_vars['zhaohuo']; ?>
";
	      $("input[name='zhaohuo']").blur(function(){
	    	zhaohuo_num	= $(this).val();
	    	if(mild_trouble_num>0 || accident_num>0 || zhaohuo_num>0 || self_wounding_num>0 || attmpted_suicide_num>0 ){
	    		trouble_family_society=1;
	    		
	    	}else{
	    		trouble_family_society=0;
	    	}
	    	eval(process);//逻辑处理
	      });
          //  4 自伤self_wounding
          //var self_wounding_num="<?php echo $this->_tpl_vars['self_wounding']; ?>
";
	      $("input[name='self_wounding']").blur(function(){
	    	self_wounding_num	= $(this).val();
	    	if(mild_trouble_num>0 || accident_num>0 || zhaohuo_num>0 || self_wounding_num>0 || attmpted_suicide_num>0 ){
	    		trouble_family_society=1;
	    		
	    	}else{
	    		trouble_family_society=0;
	    	}
	    	eval(process);//逻辑处理
	      });
          // 5 自杀未遂attmpted_suicide
          //var attmpted_suicide_num="<?php echo $this->_tpl_vars['attmpted_suicide']; ?>
";
	      $("input[name='attmpted_suicide']").blur(function(){
	    	attmpted_suicide_num	= $(this).val();
	    	if(mild_trouble_num>0 || accident_num>0 || zhaohuo_num>0 || self_wounding_num>0 || attmpted_suicide_num>0 ){
	    		trouble_family_society=1;
	    		
	    	}else{
	    		trouble_family_society=0;
	    	}
	    	eval(process);//逻辑处理
	      });
	      //出现患者都家庭和社会的影响
	      //if(mild_trouble_num>0 || accident_num>0 || zhaohuo_num>0 || self_wounding_num>0 || attmpted_suicide_num>0 ){
	      	//trouble_family_society=1;

	     // }
	      //alert();
	      //=======药物不良反应
	    //var adverse_drug_num="<?php echo $this->_tpl_vars['adverse_drug_current']; ?>
";
	    $("input[name='adverse_drug']").blur(function(){
	    	adverse_drug_num = $(this).val();
	    	eval(process);//逻辑处理
	    	//alert(present_symptoms_num+"-"+insight_num+"-"+social_function_num+"_"+adverse_drug_num+"-"+trouble_family_society);
	    });
	    //========治疗效果
	    //var treatment_effect_num="<?php echo $this->_tpl_vars['treatment_effect_current']; ?>
";
	    $("input[name='treatment_effect']").blur(function(){
	    	treatment_effect_num = $(this).val();
	    	eval(process);//逻辑处理
	    });
	  
	    //=======躯体异常=====
	    //效率非常低，因此暂时加入流程判断
	    //========逻辑处理======
	    //alert(present_symptoms_num);
	    //病情稳定--1.	症关基本消失，2.	自知力基本恢复 3.	社会功能处于一般或者良好4.	无严重药物不良反应5.无影响社区社会或者家庭行为
	    //alert(present_symptoms_num+"-"+insight_num+"-"+human_communication_num+"-"+adverse_drug_num+"-"+trouble_family_society);
	    //不稳定:1.	精神症状明显 2.	自知力缺乏3.	社会功能较差   4.	有影响社区社会或者家庭行为5.	有严重药物不良反应或者躯体疾病
		//基本稳定：1.	精神症状2.	自知力3.	社会功能状况 (以上三个项至少一方面较差)	4 药物不良反应或者其他异常 						
   
	    var process="if(present_symptoms_num==\"\" && insight_num==\"1\"  && human_communication_num!=3 && adverse_drug_num==\"1\" && trouble_family_society!=\"1\"){ $(\"input[name='followup_classification']\").val(\"1\"); $(\"input[name='followup_classification']\").triggerHandler(\"blur\"); }else  if(present_symptoms_num!=\"\" &&  insight_num==\"3\" && social_function_num==3 && trouble_family_society==\"1\" && adverse_drug_num==\"2\"){	$(\"input[name='followup_classification']\").val(\"3\"); $(\"input[name='followup_classification']\").triggerHandler(\"blur\"); }else if((present_symptoms_num!=\"\" ||  insight_num==\"3\" || social_function_num==3) && trouble_family_society==\"1\"){	$(\"input[name='followup_classification']\").val(\"2\"); $(\"input[name='followup_classification']\").triggerHandler(\"blur\"); }";
	     //var process="if(present_symptoms_num==\"0\" && insight_num==\"1\" ){ $(\"input[name='followup_classification']\").val(\"8\"); }";
	    //=======病此次随访分类--询问和一些特殊情况，可以直接点选此次随访分类
	    $("input[name='followup_classification']").blur(function(){
	    	var followup_classification = $(this).val();//此次随访分类结果
	    	var next_followup_time_year	= $("input[name='next_followup_time_year']");//下次随访时间年
	    	var next_followup_time_month=$("input[name='next_followup_time_month']");//下次随访时间月
	    	var next_followup_time_day	=$("input[name='next_followup_time_day']");//下次随访时间日
	    	var followup_content		= $("textarea[name='followup_content']");//随访内容
	    	
	    	var today=new Date(); //定义当天日期对象 
			today.setFullYear(<?php echo $this->_tpl_vars['next_followup_time1']; ?>
);
			var year = today.getFullYear(); //获取年份 
			var month = today.getMonth(); //获取月份 
			var date = today.getDate(); //获取日期值
			//alert(year);
	    	if(followup_classification=="1"){
	    		//病情稳定
				<?php if ($this->_tpl_vars['disease_state'] == 1): ?>
	    		var newDay = new Date(year,month+2,date); 
				<?php else: ?>
				var newDay = new Date(year+1,month-1,date); 
				<?php endif; ?>
				next_followup_time_year.val(newDay.getFullYear());//年
				next_followup_time_month.val(newDay.getMonth()+1);//月
				next_followup_time_day.val(newDay.getDate());//日
	    		followup_content.val("结继续执行上级医院制定的治病方案，3个月时随访病情基本稳定");

	    	}else if(followup_classification==2){
	    		//病情基本稳定
	    		
	    		if(adverse_drug_num=="1"){
	    			//无药物不良反应
	    			if(treatment_effect_num=="4" || treatment_effect_num=="3"){
					    //alert("没有好转 ");
					    var newDay = new Date(year,month,date+14); 
						next_followup_time_year.val(newDay.getFullYear());//年
						next_followup_time_month.val(newDay.getMonth()+1);//月
						next_followup_time_day.val(newDay.getDate());//日
			    		followup_content.val("建议转诊，2周内随访");
					}else if(treatment_effect_num=="2"){
						//alert("好转");
						var newDay = new Date(year,month,date+14); 
						next_followup_time_year.val(newDay.getFullYear());//年
						next_followup_time_month.val(newDay.getMonth()+1);//月
						next_followup_time_day.val(newDay.getDate());//日
			    		followup_content.val("继续现治疗方案，2周时随访");
					}
	    		}else if(adverse_drug_num=="2"){
	    			//有药物不良反应
	    			var newDay = new Date(year,month,date+14); 
					next_followup_time_year.val(newDay.getFullYear());//年
					next_followup_time_month.val(newDay.getMonth()+1);//月
					next_followup_time_day.val(newDay.getDate());//日
		    		followup_content.val("对症治疗，2周时随访");
	    		}else{
	    			var newDay = new Date(year,month,date); 
					next_followup_time_year.val(newDay.getFullYear());//年
					next_followup_time_month.val(newDay.getMonth()+1);//月
					next_followup_time_day.val(newDay.getDate());//日
		    		followup_content.val("");
	    		}   	
	    		
	    	}else if(followup_classification==3){
	    		//病情不稳定
	    		var newDay = new Date(year,month,date+14); 
				next_followup_time_year.val(newDay.getFullYear());//年
				next_followup_time_month.val(newDay.getMonth()+1);//月
				next_followup_time_day.val(newDay.getDate());//日
	    		followup_content.val("建议转诊到上级医院，2周内随访转诊情况");
	    	}else{
	    		var newDay = new Date(year,month,date); 
				next_followup_time_year.val(newDay.getFullYear());//年
				next_followup_time_month.val(newDay.getMonth()+1);//月
				next_followup_time_day.val(newDay.getDate());//日
	    		followup_content.val("");
	    	}
	    });
	});
	
</script>
</head>
<body >

<form  action="<?php echo $this->_tpl_vars['basePath']; ?>
cd/schizophrenia/update" method="post">
   
   <div class="STYLE1" style="background:#FFFFFF; text-align:center; width:100%;font-size: 16px;
	font-weight: bold;">重性精神疾病患者随访服务记录表</div>
   <div  style=" text-align:center; width:100%; "><input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['uuid']; ?>
"/>
      <div  style=" width:70%; text-align:left; float:left;background:#FFFFFF;"><strong>姓名</strong>：<?php echo $this->_tpl_vars['name']; ?>
</div>
	  <div style=" width:30%; text-align:left; float:left;background:#FFFFFF;"><strong>编号</strong>：<?php echo $this->_tpl_vars['serial_num']; ?>
</div>
   </div>
<table width="100%"  align="center" cellpadding="" cellspacing="">
   	<tr>
		<td colspan="2">随访日期</td>
	    <td colspan="3">
		<input type="text" name="fllowup_time_year" value="<?php echo $this->_tpl_vars['fllowup_time_year']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy'})" class="inputbottom">年
		<input type="text" name="fllowup_time_month" value="<?php echo $this->_tpl_vars['fllowup_time_month']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'MM'})" class="inputbottom" style="width:50px">月
		<input type="text" name="fllowup_time_day" value="<?php echo $this->_tpl_vars['fllowup_time_day']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'dd'})" class="inputbottom" style="width:50px">日
		</td>
   	</tr>
   		<tr>
		<td colspan="2">危险性</td>
	    <td colspan="3">
		<?php $_from = $this->_tpl_vars['risk_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','risk')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
         <?php endforeach; endif; unset($_from); ?>&nbsp;            
         <input type="text" name="risk" value="<?php echo $this->_tpl_vars['risk_current']; ?>
" class="inputnew" />	
		</td>
   	</tr>
   	<tr>
   	  <td colspan="2">目前症状<img title="目前症状：填写从上次随访到本次随访期间发生的情况" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="3">
         <?php $_from = $this->_tpl_vars['present_symptoms_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
               <?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
        <?php endforeach; endif; unset($_from); ?>&nbsp;
        <input type="text" name="present_symptoms_other" id="present_symptoms_other" value="<?php echo $this->_tpl_vars['present_symptoms_other']; ?>
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
	  	<input type="text" id="present_symptoms" name="present_symptoms[]" value="<?php echo $this->_tpl_vars['present_symptoms_current'][$this->_sections['customer']['index']]; ?>
" class="inputnew" />
        <?php endfor; endif; ?>
        </td>
   	</tr>
    <tr>
		<td colspan="2">自知力<img title="自知力：是患者对其自身精神状态的认识能力。自知力完全：患者精神症状消失，真正认识到自己有病，能透彻认识到哪些是病态表现，并认为需要治疗。自知力不全：患者承认有病，但缺乏正确认识和分析自己病态表现的能力。自知力缺失：患者否认自己有病。
" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	    <td colspan="3">
            <?php $_from = $this->_tpl_vars['insight_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','insight')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text" name="insight" value="<?php echo $this->_tpl_vars['insight_current']; ?>
" class="inputnew" />		</td>
   	</tr>
    <tr>
		<td colspan="2">睡眠情况</td>
	    <td colspan="3">
        	<?php $_from = $this->_tpl_vars['sleep_quality_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','sleep_quality')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text" name="sleep_quality" value="<?php echo $this->_tpl_vars['sleep_quality_current']; ?>
" class="inputnew" />		</td>
   	</tr>
    <tr>
		<td colspan="2">饮食情况</td>
	    <td colspan="3">
       		<?php $_from = $this->_tpl_vars['diet_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','diet')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text" name="diet" value="<?php echo $this->_tpl_vars['diet_current']; ?>
" class="inputnew" />		</td>
   	</tr>
   	<tr>
   	  <td colspan="2" rowspan="5">社会功能情况</td>
      <td height="30"  >
                        个人生活料理      </td>
   	  <td  height="30" colspan="2">
   	  <?php $_from = $this->_tpl_vars['personlife_do_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','personlife_do')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
      <?php endforeach; endif; unset($_from); ?>&nbsp;
      <input type="text" name="personlife_do" value="<?php echo $this->_tpl_vars['personlife_do_current']; ?>
" class="inputnew" />      </td>
   	</tr>
   	<tr>
   	 <td height="30"  >
   	    家务劳动      
   	  </td>
   	 <td height="30" colspan="2">
   	 <?php $_from = $this->_tpl_vars['housework_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
          <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','housework')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
     <?php endforeach; endif; unset($_from); ?>&nbsp;
     <input type="text" name="housework" value="<?php echo $this->_tpl_vars['housework_current']; ?>
" class="inputnew" />	  </td>
   	</tr>
    <tr>
     <td height="30" >
   	    生产劳动及工作      </td>
   	 <td height="30" colspan="2" >
      		<?php $_from = $this->_tpl_vars['work_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','work')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text" name="work" value="<?php echo $this->_tpl_vars['work_current']; ?>
" class="inputnew" />	  </td>
   	</tr>
    <tr>
      <td height="30"  >
   	     学习能力      </td>
   	  <td height="30" colspan="2" >
			<?php $_from = $this->_tpl_vars['learning_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','learning')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text" name="learning" value="<?php echo $this->_tpl_vars['learning_current']; ?>
" class="inputnew" />	  </td>
   	</tr>
    <tr>
      <td height="30" >
   	    社会人及交往      </td>
   	 <td height="30" colspan="2" >
     		<?php $_from = $this->_tpl_vars['human_communication_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','human_communication')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text" name="human_communication" value="<?php echo $this->_tpl_vars['human_communication_current']; ?>
" class="inputnew" />	  </td>
   	</tr>
    <tr>
		<td colspan="2">患者对家庭社会的影响<img title="患病对家庭社会的影响：填写从上次随访到本次随访期间发生的情况。若未发生过，填写“0”；若发生过，填写相应的次数。轻度滋事：是指公安机关出警但仅作一般教育等处理的案情，例如患者打、骂他人或者扰乱秩序，但没有造成生命财产损害的，属于此类。肇事：是指患者的行为触犯了我国《治安管理处罚法》但未触犯《刑法》，例如患者有行凶伤人毁物等，但未导致被害人轻、重伤的。肇祸：是指患者的行为触犯了《刑法》，属于犯罪行为的" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
	    <td colspan="3">       		
            1 轻度滋事<input type="text" name="mild_trouble" value="<?php echo $this->_tpl_vars['mild_trouble']; ?>
" class="inputbottom"/>次
            2 肇事<input type="text" name="accident" value="<?php echo $this->_tpl_vars['accident']; ?>
" class="inputbottom"/>次
            3 肇祸<input type="text" name="zhaohuo" value="<?php echo $this->_tpl_vars['zhaohuo']; ?>
" class="inputbottom"/>次<br/>
            4 自伤<input type="text" name="self_wounding" value="<?php echo $this->_tpl_vars['self_wounding']; ?>
" class="inputbottom"/>次
            5 自杀未遂<input type="text" name="attmpted_suicide" value="<?php echo $this->_tpl_vars['attmpted_suicide']; ?>
" class="inputbottom"/>次		</td>
   	</tr>
   	<tr>
   	  <td colspan="2">关锁情况</td>
      <td  colspan="3"  valign="top">
		 <?php $_from = $this->_tpl_vars['shut_case_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','shut_case')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
         <?php endforeach; endif; unset($_from); ?>&nbsp;            
         <input type="text" name="shut_case" value="<?php echo $this->_tpl_vars['shut_case_current']; ?>
" class="inputnew" />	
      </td>
   	</tr>
   	<tr>
   	  <td colspan="2">住院情况</td>
      <td  colspan="3"  valign="top">
       <?php $_from = $this->_tpl_vars['hospitalization_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','hospitalization')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
       <?php endforeach; endif; unset($_from); ?>&nbsp;
       <input type="text" name="hospitalization" value="<?php echo $this->_tpl_vars['hospitalization_current']; ?>
" class="inputnew" />
       <br/>
       末次出院时间:<input type="text" name="discharge_time" value="<?php echo $this->_tpl_vars['discharge_time']; ?>
" class="inputbottomlong"  onClick="WdatePicker({firstDayOfWeek:1})" />
      </td>
   	</tr>
   	<tr>
   	  <td colspan="2">室验室检查<img title="记录最近一次（3个月内）的实验室检查结果，包括在上级医院或其他医院的检查" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td  colspan="3"  valign="top">
      		<?php $_from = $this->_tpl_vars['lab_examination_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','is_lab_examination')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text"  id="lab_examination" name="lab_examination" value="<?php echo $this->_tpl_vars['lab_examination']; ?>
" class="inputbottom"/>
            
            <input type="text" id="is_lab_examination" name="is_lab_examination" value="<?php echo $this->_tpl_vars['is_lab_examination_current']; ?>
"  class="inputnew" />	
      </td>
   	</tr>
   	
   	<tr>
   	  <td colspan="2">服药依从性<img title="服药依从性：“规律”为按医嘱服药，“间断”为未按医嘱服药，服药频次或数量不足，“不服药”即为医生开了处方，但患者未使用此药" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="3">
      		<?php $_from = $this->_tpl_vars['compliance_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','compliance')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text"  name="compliance" value="<?php echo $this->_tpl_vars['compliance_current']; ?>
" class="inputnew" />	
      </td>
   	</tr>
   	<tr>
   	  <td  colspan="2">药物不良反应<img title="如果患者服用的药物有明显的药物不良反应，应具体描述哪种药物，以及何种不良反应" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
    <td colspan="3">
    		<?php $_from = $this->_tpl_vars['adverse_drug_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','adverse_drug')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;
            <input type="text"  id="adverse_drug_info" name="adverse_drug_info" value="<?php echo $this->_tpl_vars['adverse_drug_info']; ?>
" class="inputbottom"/>
            
            <input type="text" id="adverse_drug" name="adverse_drug" value="<?php echo $this->_tpl_vars['adverse_drug_current']; ?>
"  class="inputnew" />	
    </td>
    </tr>
   	<tr>
   	  <td  colspan="2">治疗效果</td>
    <td colspan="3">
    		<?php $_from = $this->_tpl_vars['treatment_effect_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','treatment_effect')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;            
            <input type="text" name="treatment_effect" value="<?php echo $this->_tpl_vars['treatment_effect_current']; ?>
" class="inputnew" />	
    </td>
    </tr>
   	<tr>
   	  <td colspan="2"  style="color:red">此次随访分类<img title="此次随访分类：根据从上次随访到此次随访期间患者的总体情况进行选择。未访到指本次随访阶段因各种情况未能直接或间接访问到患者。" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
    <td colspan="3">
    		<?php $_from = $this->_tpl_vars['followup_classification_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','followup_classification')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;            
            <input type="text" name="followup_classification" value="<?php echo $this->_tpl_vars['followup_classification_current']; ?>
" class="inputnew" />	
    </td>
    </tr>
   	<tr>
   	  <td  colspan="2">是否转诊<img title="根据患者此次随访的情况，确定是否要转诊，若给出患者转诊建议，填写转诊医院的具体名称" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="3">
     		 <?php $_from = $this->_tpl_vars['is_referral_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <label onclick="set_input_value('<?php echo $this->_tpl_vars['k']; ?>
','is_referral')"><?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;            
            <input type="text" id="is_referral" name="is_referral" value="<?php echo $this->_tpl_vars['is_referral_current']; ?>
" class="inputnew"   />	
            <br />
            原因：<input type="text" id="reason_referral" name="reason_referral" value="<?php echo $this->_tpl_vars['reason_referral']; ?>
" class="inputbottom"/><br/>
            机构及科室：<input type="text" id="hospital_referral" name="hospital_referral" value="<?php echo $this->_tpl_vars['hospital_referral']; ?>
" class="inputbottom"/>
      </td>  	
    </tr>
   	<tr>
   	  <td rowspan="3" colspan="2">用药情况<img title="根据患者的总体情况，填写患者即将服用的抗精神病药物名称，并写明用法" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td width="26%" >药物 1:      
      <input name="drug_name1" type="text" class="inputnone2" value="<?php echo $this->_tpl_vars['drug_name1']; ?>
"/></td>
      <td width="21%">用法:
      <select name="drug_usage_frequency1">
      	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['drug_usage_frequency1_options'],'selected' => $this->_tpl_vars['drug_usage_frequency1_current']), $this);?>

      </select>
      <input name="drug_usage1" type="text" class="inputnone" value="<?php echo $this->_tpl_vars['drug_usage1']; ?>
"/>次</td>
   	  <td>每次剂量            <input name="drug_dose1" type="text" class="inputnone" value="<?php echo $this->_tpl_vars['drug_dose1']; ?>
"/>mg</td>
   	</tr>
   	<tr>
   	  <td >药物 2:      <input name="drug_name2" type="text" class="inputnone2" value="<?php echo $this->_tpl_vars['drug_name2']; ?>
"/></td>
      <td>用法:
      <select name="drug_usage_frequency2">
      	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['drug_usage_frequency2_options'],'selected' => $this->_tpl_vars['drug_usage_frequency2_current']), $this);?>

      </select>
      <input name="drug_usage2" type="text" class="inputnone" value="<?php echo $this->_tpl_vars['drug_usage2']; ?>
"/>次</td>
   	  <td>每次剂量            <input name="drug_dose2" type="text" class="inputnone" value="<?php echo $this->_tpl_vars['drug_dose2']; ?>
"/>mg</td
   	></tr>
   	<tr>
   	  <td >药物 3:      <input name="drug_name3" type="text" class="inputnone2" value="<?php echo $this->_tpl_vars['drug_name3']; ?>
"/></td>
      <td>用法:
      <select name="drug_usage_frequency3">
      	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['drug_usage_frequency3_options'],'selected' => $this->_tpl_vars['drug_usage_frequency3_current']), $this);?>

      </select>
      <input name="drug_usage3" type="text" class="inputnone" value="<?php echo $this->_tpl_vars['drug_usage3']; ?>
"/>次</td>
   	  <td>每次剂量            <input name="drug_dose3" type="text" class="inputnone" value="<?php echo $this->_tpl_vars['drug_dose3']; ?>
"/>mg</td
	  ></tr>
   	 <tr>
   	  <td colspan="2">康复措施<img title="根据患者此次随访的情况，给出应采取的康复措施，可以多选" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="3">
      		<?php $_from = $this->_tpl_vars['rehabilitation_measures_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <?php echo $this->_tpl_vars['k']; ?>
、<?php echo $this->_tpl_vars['v'][1]; ?>
&nbsp;
            <?php endforeach; endif; unset($_from); ?>&nbsp;   
            <input type="text" name="rehabilitation_measure_other" id="rehabilitation_measure_other" value="<?php echo $this->_tpl_vars['rehabilitation_measure_other']; ?>
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
            <input type="text" id="rehabilitation_measures" name="rehabilitation_measures[]" value="<?php echo $this->_tpl_vars['rehabilitation_measures_current'][$this->_sections['custom']['index']]; ?>
" class="inputnew" />	
            <?php endfor; endif; ?>
      </td> 
    </tr>
    <tr>
   	  <td  colspan="2">下次随访日期<img title="根据患者的情况确定下次随访时间，并告知患者和家属" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/comments.png" class="vtip" /></td>
      <td colspan="3">
         <input type="text" name="next_followup_time_year" value="<?php echo $this->_tpl_vars['next_followup_time_year']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy'})" class="inputbottom">年
		 <input type="text" name="next_followup_time_month" value="<?php echo $this->_tpl_vars['next_followup_time_month']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'MM'})" class="inputbottom" style="width:50px">月
		 <input type="text" name="next_followup_time_day" value="<?php echo $this->_tpl_vars['next_followup_time_day']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'dd'})" class="inputbottom" style="width:50px">日
      </td>
     
   	</tr>
   	 <tr>
   	  <td  colspan="2">随访结果</td>
      <td colspan="3">
        <textarea name="followup_content" cols="50" rows="5" class="newtextarea" ><?php echo $this->_tpl_vars['followup_content']; ?>
</textarea>
      </td>
     
   	</tr>
   	 <tr>
   	  <td  colspan="2">随访医生签名</td>
      <td  colspan="3">
        <select name="followup_doctor" >
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
" <?php if ($this->_tpl_vars['followup_doctor'] == $this->_tpl_vars['region_users'][$this->_sections['experience']['index']]['user_id']): ?>selected<?php endif; ?>>
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