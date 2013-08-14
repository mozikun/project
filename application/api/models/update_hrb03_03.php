<?php
/**
结核病防治基本数据集标准HRB03.03结核病防治基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb03_03_055  诊断机构名称
* @param string $hrb03_03_056  诊断医师姓名
* @param string $hrb03_03_057  治疗机构名称
* @param string $hrb03_03_058  治疗医师姓名
* @param string $hrb03_03_001  姓名
* @param string $hrb03_03_002  性别代码
* @param string $hrb03_03_003  身份证件-类别代码
* @param string $hrb03_03_004  身份证件-号码
* @param string $hrb03_03_005  民族代码
* @param date $hrb03_03_006  出生日期
* @param string $hrb03_03_007  地址类别代码
* @param string $hrb03_03_008  地址-省（自治区、直辖市）
* @param string $hrb03_03_009  地址-市（地区）
* @param string $hrb03_03_010  地址-县（区）
* @param string $hrb03_03_011  地址-乡（镇、街道办事处）
* @param string $hrb03_03_012  地址-村（街、路、弄等）
* @param string $hrb03_03_013  地址-门牌号码
* @param string $hrb03_03_014  联系电话-类别
* @param string $hrb03_03_015  联系电话-类别代码
* @param string $hrb03_03_016  联系电话-号码
* @param string $hrb03_03_017  工作单位名称
* @param string $hrb03_03_018  职业类别代码(国标)
* @param string $hrb03_03_019  门诊号
* @param string $hrb03_03_020  住院号
* @param string $hrb03_03_021  疑似结核病人症状代码
* @param date $hrb03_03_022  首次出现症状日期
* @param date $hrb03_03_023  首次就诊日期
* @param date $hrb03_03_024  确诊日期
* @param date $hrb03_03_025  首次治疗日期
* @param string $hrb03_03_026  结核病人发现方式代码
* @param string $hrb03_03_027  痰检培养结果代码
* @param string $hrb03_03_028  痰检涂片结果代码
* @param string $hrb03_03_029  胸部X线检查结果
* @param string $hrb03_03_030  CT检查结果
* @param string $hrb03_03_031  肝功能检测结果代码
* @param string $hrb03_03_032  粪常规检测结果代码
* @param string $hrb03_03_033  尿常规检测结果代码
* @param string $hrb03_03_034  血常规检测结果代码
* @param string $hrb03_03_035  HIV抗体检测结果代码
* @param string $hrb03_03_036  药敏实验所用药物代码
* @param string $hrb03_03_037  药敏实验结果代码
* @param string $hrb03_03_038  结核菌群检测结果代码
* @param string $hrb03_03_039  肺外结核部位代码
* @param string $hrb03_03_040  诊断结核病类型代码
* @param string $hrb03_03_041  肺结核诊断结果代码
* @param boolean $hrb03_03_042  肺结核标志
* @param boolean $hrb03_03_043  肝炎标志
* @param boolean $hrb03_03_044  结核病接触史标志
* @param string $hrb03_03_045  结核病合并症代码
* @param string $hrb03_03_046  结核病治疗分类代码
* @param string $hrb03_03_047  结核病患者始治方案代码
* @param string $hrb03_03_048  结核病患者化疗方案代码
* @param boolean $hrb03_03_049  药物副作用标志
* @param date $hrb03_03_050  停止治疗日期
* @param string $hrb03_03_051  停止治疗原因代码
* @param string $hrb03_03_052  结核病人化疗管理方式代码
* @param boolean $hrb03_03_053  规律服药标志
* @param string $hrb03_03_054  结核病管理机构名称
* @return boolean
*/
function update_hrb03_03($ws_id,$org_id,$doctor_id,$identity_number,$hrb03_03_055='',$hrb03_03_056='',$hrb03_03_057='',$hrb03_03_058='',$hrb03_03_001='',$hrb03_03_002='',$hrb03_03_003='',$hrb03_03_004='',$hrb03_03_005='',$hrb03_03_006='',$hrb03_03_007='',$hrb03_03_008='',$hrb03_03_009='',$hrb03_03_010='',$hrb03_03_011='',$hrb03_03_012='',$hrb03_03_013='',$hrb03_03_014='',$hrb03_03_015='',$hrb03_03_016='',$hrb03_03_017='',$hrb03_03_018='',$hrb03_03_019='',$hrb03_03_020='',$hrb03_03_021='',$hrb03_03_022='',$hrb03_03_023='',$hrb03_03_024='',$hrb03_03_025='',$hrb03_03_026='',$hrb03_03_027='',$hrb03_03_028='',$hrb03_03_029='',$hrb03_03_030='',$hrb03_03_031='',$hrb03_03_032='',$hrb03_03_033='',$hrb03_03_034='',$hrb03_03_035='',$hrb03_03_036='',$hrb03_03_037='',$hrb03_03_038='',$hrb03_03_039='',$hrb03_03_040='',$hrb03_03_041='',$hrb03_03_042=false,$hrb03_03_043=false,$hrb03_03_044=false,$hrb03_03_045='',$hrb03_03_046='',$hrb03_03_047='',$hrb03_03_048='',$hrb03_03_049=false,$hrb03_03_050='',$hrb03_03_051='',$hrb03_03_052='',$hrb03_03_053=false,$hrb03_03_054=''){
require_once(__SITEROOT.'library/Models/ws_hrb03_03.php');
$table_obj="Tws_hrb03_03";
$ws_hrb03_03=new $table_obj();
$ws_hrb03_03 -> ws_id=$ws_id;
$ws_hrb03_03 -> uuid=uniqid('',true);
$ws_hrb03_03 -> created=time();
$ws_hrb03_03 -> org_id=$org_id;
$ws_hrb03_03 -> doctor_id=$doctor_id;
$ws_hrb03_03 -> identity_number=$identity_number;//身份证号
$ws_hrb03_03 -> action='insert';
$ws_hrb03_03->hrb03_03_055 = $hrb03_03_055; //诊断机构名称 
$ws_hrb03_03->hrb03_03_056 = $hrb03_03_056; //诊断医师姓名 
$ws_hrb03_03->hrb03_03_057 = $hrb03_03_057; //治疗机构名称 
$ws_hrb03_03->hrb03_03_058 = $hrb03_03_058; //治疗医师姓名 
$ws_hrb03_03->hrb03_03_001 = $hrb03_03_001; //姓名 
$ws_hrb03_03->hrb03_03_002 = $hrb03_03_002; //性别代码 
$ws_hrb03_03->hrb03_03_003 = $hrb03_03_003; //身份证件-类别代码 
$ws_hrb03_03->hrb03_03_004 = $hrb03_03_004; //身份证件-号码 
$ws_hrb03_03->hrb03_03_005 = $hrb03_03_005; //民族代码 
$ws_hrb03_03 ->hrb03_03_006 = empty($hrb03_03_006)?null : $ws_hrb03_03 ->escape('hrb03_03_006',to_date($hrb03_03_006,'YYYY-MM-DD')); //出生日期 
$ws_hrb03_03->hrb03_03_007 = $hrb03_03_007; //地址类别代码 
$ws_hrb03_03->hrb03_03_008 = $hrb03_03_008; //地址-省（自治区、直辖市） 
$ws_hrb03_03->hrb03_03_009 = $hrb03_03_009; //地址-市（地区） 
$ws_hrb03_03->hrb03_03_010 = $hrb03_03_010; //地址-县（区） 
$ws_hrb03_03->hrb03_03_011 = $hrb03_03_011; //地址-乡（镇、街道办事处） 
$ws_hrb03_03->hrb03_03_012 = $hrb03_03_012; //地址-村（街、路、弄等） 
$ws_hrb03_03->hrb03_03_013 = $hrb03_03_013; //地址-门牌号码 
$ws_hrb03_03->hrb03_03_014 = $hrb03_03_014; //联系电话-类别 
$ws_hrb03_03->hrb03_03_015 = $hrb03_03_015; //联系电话-类别代码 
$ws_hrb03_03->hrb03_03_016 = $hrb03_03_016; //联系电话-号码 
$ws_hrb03_03->hrb03_03_017 = $hrb03_03_017; //工作单位名称 
$ws_hrb03_03->hrb03_03_018 = $hrb03_03_018; //职业类别代码(国标) 
$ws_hrb03_03->hrb03_03_019 = $hrb03_03_019; //门诊号 
$ws_hrb03_03->hrb03_03_020 = $hrb03_03_020; //住院号 
$ws_hrb03_03->hrb03_03_021 = $hrb03_03_021; //疑似结核病人症状代码 
$ws_hrb03_03 ->hrb03_03_022 = empty($hrb03_03_022)?null : $ws_hrb03_03 ->escape('hrb03_03_022',to_date($hrb03_03_022,'YYYY-MM-DD')); //首次出现症状日期 
$ws_hrb03_03 ->hrb03_03_023 = empty($hrb03_03_023)?null : $ws_hrb03_03 ->escape('hrb03_03_023',to_date($hrb03_03_023,'YYYY-MM-DD')); //首次就诊日期 
$ws_hrb03_03 ->hrb03_03_024 = empty($hrb03_03_024)?null : $ws_hrb03_03 ->escape('hrb03_03_024',to_date($hrb03_03_024,'YYYY-MM-DD')); //确诊日期 
$ws_hrb03_03 ->hrb03_03_025 = empty($hrb03_03_025)?null : $ws_hrb03_03 ->escape('hrb03_03_025',to_date($hrb03_03_025,'YYYY-MM-DD')); //首次治疗日期 
$ws_hrb03_03->hrb03_03_026 = $hrb03_03_026; //结核病人发现方式代码 
$ws_hrb03_03->hrb03_03_027 = $hrb03_03_027; //痰检培养结果代码 
$ws_hrb03_03->hrb03_03_028 = $hrb03_03_028; //痰检涂片结果代码 
$ws_hrb03_03->hrb03_03_029 = $hrb03_03_029; //胸部X线检查结果 
$ws_hrb03_03->hrb03_03_030 = $hrb03_03_030; //CT检查结果 
$ws_hrb03_03->hrb03_03_031 = $hrb03_03_031; //肝功能检测结果代码 
$ws_hrb03_03->hrb03_03_032 = $hrb03_03_032; //粪常规检测结果代码 
$ws_hrb03_03->hrb03_03_033 = $hrb03_03_033; //尿常规检测结果代码 
$ws_hrb03_03->hrb03_03_034 = $hrb03_03_034; //血常规检测结果代码 
$ws_hrb03_03->hrb03_03_035 = $hrb03_03_035; //HIV抗体检测结果代码 
$ws_hrb03_03->hrb03_03_036 = $hrb03_03_036; //药敏实验所用药物代码 
$ws_hrb03_03->hrb03_03_037 = $hrb03_03_037; //药敏实验结果代码 
$ws_hrb03_03->hrb03_03_038 = $hrb03_03_038; //结核菌群检测结果代码 
$ws_hrb03_03->hrb03_03_039 = $hrb03_03_039; //肺外结核部位代码 
$ws_hrb03_03->hrb03_03_040 = $hrb03_03_040; //诊断结核病类型代码 
$ws_hrb03_03->hrb03_03_041 = $hrb03_03_041; //肺结核诊断结果代码 
$ws_hrb03_03->hrb03_03_042 = $hrb03_03_042; //肺结核标志 
$ws_hrb03_03->hrb03_03_043 = $hrb03_03_043; //肝炎标志 
$ws_hrb03_03->hrb03_03_044 = $hrb03_03_044; //结核病接触史标志 
$ws_hrb03_03->hrb03_03_045 = $hrb03_03_045; //结核病合并症代码 
$ws_hrb03_03->hrb03_03_046 = $hrb03_03_046; //结核病治疗分类代码 
$ws_hrb03_03->hrb03_03_047 = $hrb03_03_047; //结核病患者始治方案代码 
$ws_hrb03_03->hrb03_03_048 = $hrb03_03_048; //结核病患者化疗方案代码 
$ws_hrb03_03->hrb03_03_049 = $hrb03_03_049; //药物副作用标志 
$ws_hrb03_03 ->hrb03_03_050 = empty($hrb03_03_050)?null : $ws_hrb03_03 ->escape('hrb03_03_050',to_date($hrb03_03_050,'YYYY-MM-DD')); //停止治疗日期 
$ws_hrb03_03->hrb03_03_051 = $hrb03_03_051; //停止治疗原因代码 
$ws_hrb03_03->hrb03_03_052 = $hrb03_03_052; //结核病人化疗管理方式代码 
$ws_hrb03_03->hrb03_03_053 = $hrb03_03_053; //规律服药标志 
$ws_hrb03_03->hrb03_03_054 = $hrb03_03_054; //结核病管理机构名称 
if($ws_hrb03_03 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb03_03 ->free_statement();
}
