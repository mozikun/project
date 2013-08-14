<?php
/**
精神分裂症病例管理基本数据集标准HRB04.04精神分裂症病例管理基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb04_04_001  健康档案标识符
* @param string $hrb04_04_002  病案号
* @param string $hrb04_04_003  姓名
* @param string $hrb04_04_004  性别代码
* @param string $hrb04_04_005  身份证件-类别代码
* @param string $hrb04_04_006  身份证件-号码
* @param string $hrb04_04_007  地址类别代码
* @param string $hrb04_04_008  行政区划代码
* @param string $hrb04_04_009  地址-省（自治区、直辖市）
* @param string $hrb04_04_010  地址-市（地区）
* @param string $hrb04_04_011  地址-县（区）
* @param string $hrb04_04_012  地址-乡（镇、街道办事处）
* @param string $hrb04_04_013  地址-村（街、路、弄等）
* @param string $hrb04_04_014  地址-门牌号码
* @param string $hrb04_04_015  邮政编码
* @param string $hrb04_04_016  联系电话-类别
* @param string $hrb04_04_017  联系电话-类别代码
* @param string $hrb04_04_018  联系电话-号码
* @param string $hrb04_04_019  责任医师姓名
* @param string $hrb04_04_020  随访医师姓名
* @param date $hrb04_04_021  随访日期
* @param string $hrb04_04_022  精神症状代码
* @param string $hrb04_04_023  自知力评价结果代码
* @param string $hrb04_04_024  睡眠情况类别代码
* @param string $hrb04_04_025  饮食情况类别代码
* @param string $hrb04_04_026  社会功能情况分类代码
* @param string $hrb04_04_027  社会功能情况评价代码
* @param string $hrb04_04_028  躯体疾病名称
* @param string $hrb04_04_029  药物名称
* @param string $hrb04_04_030  药物使用-频率
* @param string $hrb04_04_031  药物使用-剂量单位
* @param decimal $hrb04_04_032  药物使用-次剂量
* @param decimal $hrb04_04_033  药物使用-总剂量
* @param string $hrb04_04_034  药物使用-途径代码
* @param string $hrb04_04_035  药物副作用
* @param string $hrb04_04_036  精神分裂症患者服药依从性
* @param string $hrb04_04_037  康复措施指导
* @param boolean $hrb04_04_038  转诊标志
* @param string $hrb04_04_039  转入医院名称
* @param string $hrb04_04_040  检查（测）人员姓名
* @param string $hrb04_04_041  监护人姓名
* @param string $hrb04_04_042  监护人与本人关系
* @param string $hrb04_04_043  辖区居委会名称
* @param string $hrb04_04_044  居委会联系人姓名
* @param boolean $hrb04_04_045  精神疾患家族史标志
* @param string $hrb04_04_046  家族性精神疾病名称
* @param string $hrb04_04_047  患家族病成员与本人关系代码
* @param decimal $hrb04_04_048  精神分裂症患者初次发病年龄（岁）
* @param string $hrb04_04_049  既往精神类疾病诊断名称
* @param date $hrb04_04_050  首次确诊日期
* @param decimal $hrb04_04_051  既往精神专科医院住院次数
* @param string $hrb04_04_052  既往门诊治疗情况代码
* @param string $hrb04_04_053  既往治疗效果类别代码
* @param string $hrb04_04_054  既往主要精神症状代码
* @param string $hrb04_04_055  发病对家庭社会的影响类别代码
* @param string $hrb04_04_056  生活和劳动能力评价结果代码
* @param string $hrb04_04_057  精神康复措施
* @param string $hrb04_04_058  治疗形式建议代码
* @param string $hrb04_04_059  药物治疗建议
* @param string $hrb04_04_060  康复措施建议
* @return boolean
*/
function update_hrb04_04($ws_id,$org_id,$doctor_id,$identity_number,$hrb04_04_001='',$hrb04_04_002='',$hrb04_04_003='',$hrb04_04_004='',$hrb04_04_005='',$hrb04_04_006='',$hrb04_04_007='',$hrb04_04_008='',$hrb04_04_009='',$hrb04_04_010='',$hrb04_04_011='',$hrb04_04_012='',$hrb04_04_013='',$hrb04_04_014='',$hrb04_04_015='',$hrb04_04_016='',$hrb04_04_017='',$hrb04_04_018='',$hrb04_04_019='',$hrb04_04_020='',$hrb04_04_021='',$hrb04_04_022='',$hrb04_04_023='',$hrb04_04_024='',$hrb04_04_025='',$hrb04_04_026='',$hrb04_04_027='',$hrb04_04_028='',$hrb04_04_029='',$hrb04_04_030='',$hrb04_04_031='',$hrb04_04_032=0,$hrb04_04_033=0,$hrb04_04_034='',$hrb04_04_035='',$hrb04_04_036='',$hrb04_04_037='',$hrb04_04_038=false,$hrb04_04_039='',$hrb04_04_040='',$hrb04_04_041='',$hrb04_04_042='',$hrb04_04_043='',$hrb04_04_044='',$hrb04_04_045=false,$hrb04_04_046='',$hrb04_04_047='',$hrb04_04_048=0,$hrb04_04_049='',$hrb04_04_050='',$hrb04_04_051=0,$hrb04_04_052='',$hrb04_04_053='',$hrb04_04_054='',$hrb04_04_055='',$hrb04_04_056='',$hrb04_04_057='',$hrb04_04_058='',$hrb04_04_059='',$hrb04_04_060=''){
require_once(__SITEROOT.'library/Models/ws_hrb04_04.php');
$table_obj="Tws_hrb04_04";
$ws_hrb04_04=new $table_obj();
$ws_hrb04_04 -> ws_id=$ws_id;
$ws_hrb04_04 -> uuid=uniqid('',true);
$ws_hrb04_04 -> created=time();
$ws_hrb04_04 -> org_id=$org_id;
$ws_hrb04_04 -> doctor_id=$doctor_id;
$ws_hrb04_04 -> identity_number=$identity_number;//身份证号
$ws_hrb04_04 -> action='insert';
$ws_hrb04_04->hrb04_04_001 = $hrb04_04_001; //健康档案标识符 
$ws_hrb04_04->hrb04_04_002 = $hrb04_04_002; //病案号 
$ws_hrb04_04->hrb04_04_003 = $hrb04_04_003; //姓名 
$ws_hrb04_04->hrb04_04_004 = $hrb04_04_004; //性别代码 
$ws_hrb04_04->hrb04_04_005 = $hrb04_04_005; //身份证件-类别代码 
$ws_hrb04_04->hrb04_04_006 = $hrb04_04_006; //身份证件-号码 
$ws_hrb04_04->hrb04_04_007 = $hrb04_04_007; //地址类别代码 
$ws_hrb04_04->hrb04_04_008 = $hrb04_04_008; //行政区划代码 
$ws_hrb04_04->hrb04_04_009 = $hrb04_04_009; //地址-省（自治区、直辖市） 
$ws_hrb04_04->hrb04_04_010 = $hrb04_04_010; //地址-市（地区） 
$ws_hrb04_04->hrb04_04_011 = $hrb04_04_011; //地址-县（区） 
$ws_hrb04_04->hrb04_04_012 = $hrb04_04_012; //地址-乡（镇、街道办事处） 
$ws_hrb04_04->hrb04_04_013 = $hrb04_04_013; //地址-村（街、路、弄等） 
$ws_hrb04_04->hrb04_04_014 = $hrb04_04_014; //地址-门牌号码 
$ws_hrb04_04->hrb04_04_015 = $hrb04_04_015; //邮政编码 
$ws_hrb04_04->hrb04_04_016 = $hrb04_04_016; //联系电话-类别 
$ws_hrb04_04->hrb04_04_017 = $hrb04_04_017; //联系电话-类别代码 
$ws_hrb04_04->hrb04_04_018 = $hrb04_04_018; //联系电话-号码 
$ws_hrb04_04->hrb04_04_019 = $hrb04_04_019; //责任医师姓名 
$ws_hrb04_04->hrb04_04_020 = $hrb04_04_020; //随访医师姓名 
$ws_hrb04_04 ->hrb04_04_021 = empty($hrb04_04_021)?null : $ws_hrb04_04 ->escape('hrb04_04_021',to_date($hrb04_04_021,'YYYY-MM-DD')); //随访日期 
$ws_hrb04_04->hrb04_04_022 = $hrb04_04_022; //精神症状代码 
$ws_hrb04_04->hrb04_04_023 = $hrb04_04_023; //自知力评价结果代码 
$ws_hrb04_04->hrb04_04_024 = $hrb04_04_024; //睡眠情况类别代码 
$ws_hrb04_04->hrb04_04_025 = $hrb04_04_025; //饮食情况类别代码 
$ws_hrb04_04->hrb04_04_026 = $hrb04_04_026; //社会功能情况分类代码 
$ws_hrb04_04->hrb04_04_027 = $hrb04_04_027; //社会功能情况评价代码 
$ws_hrb04_04->hrb04_04_028 = $hrb04_04_028; //躯体疾病名称 
$ws_hrb04_04->hrb04_04_029 = $hrb04_04_029; //药物名称 
$ws_hrb04_04->hrb04_04_030 = $hrb04_04_030; //药物使用-频率 
$ws_hrb04_04->hrb04_04_031 = $hrb04_04_031; //药物使用-剂量单位 
$ws_hrb04_04->hrb04_04_032 = $hrb04_04_032; //药物使用-次剂量 
$ws_hrb04_04->hrb04_04_033 = $hrb04_04_033; //药物使用-总剂量 
$ws_hrb04_04->hrb04_04_034 = $hrb04_04_034; //药物使用-途径代码 
$ws_hrb04_04->hrb04_04_035 = $hrb04_04_035; //药物副作用 
$ws_hrb04_04->hrb04_04_036 = $hrb04_04_036; //精神分裂症患者服药依从性 
$ws_hrb04_04->hrb04_04_037 = $hrb04_04_037; //康复措施指导 
$ws_hrb04_04->hrb04_04_038 = $hrb04_04_038; //转诊标志 
$ws_hrb04_04->hrb04_04_039 = $hrb04_04_039; //转入医院名称 
$ws_hrb04_04->hrb04_04_040 = $hrb04_04_040; //检查（测）人员姓名 
$ws_hrb04_04->hrb04_04_041 = $hrb04_04_041; //监护人姓名 
$ws_hrb04_04->hrb04_04_042 = $hrb04_04_042; //监护人与本人关系 
$ws_hrb04_04->hrb04_04_043 = $hrb04_04_043; //辖区居委会名称 
$ws_hrb04_04->hrb04_04_044 = $hrb04_04_044; //居委会联系人姓名 
$ws_hrb04_04->hrb04_04_045 = $hrb04_04_045; //精神疾患家族史标志 
$ws_hrb04_04->hrb04_04_046 = $hrb04_04_046; //家族性精神疾病名称 
$ws_hrb04_04->hrb04_04_047 = $hrb04_04_047; //患家族病成员与本人关系代码 
$ws_hrb04_04->hrb04_04_048 = $hrb04_04_048; //精神分裂症患者初次发病年龄（岁） 
$ws_hrb04_04->hrb04_04_049 = $hrb04_04_049; //既往精神类疾病诊断名称 
$ws_hrb04_04 ->hrb04_04_050 = empty($hrb04_04_050)?null : $ws_hrb04_04 ->escape('hrb04_04_050',to_date($hrb04_04_050,'YYYY-MM-DD')); //首次确诊日期 
$ws_hrb04_04->hrb04_04_051 = $hrb04_04_051; //既往精神专科医院住院次数 
$ws_hrb04_04->hrb04_04_052 = $hrb04_04_052; //既往门诊治疗情况代码 
$ws_hrb04_04->hrb04_04_053 = $hrb04_04_053; //既往治疗效果类别代码 
$ws_hrb04_04->hrb04_04_054 = $hrb04_04_054; //既往主要精神症状代码 
$ws_hrb04_04->hrb04_04_055 = $hrb04_04_055; //发病对家庭社会的影响类别代码 
$ws_hrb04_04->hrb04_04_056 = $hrb04_04_056; //生活和劳动能力评价结果代码 
$ws_hrb04_04->hrb04_04_057 = $hrb04_04_057; //精神康复措施 
$ws_hrb04_04->hrb04_04_058 = $hrb04_04_058; //治疗形式建议代码 
$ws_hrb04_04->hrb04_04_059 = $hrb04_04_059; //药物治疗建议 
$ws_hrb04_04->hrb04_04_060 = $hrb04_04_060; //康复措施建议 
if($ws_hrb04_04 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb04_04 ->free_statement();
}
