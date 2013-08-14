<?php
/**
新生儿疾病筛查基本数据集标准HRB01.02新生儿疾病筛查基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb01_02_002  新生儿姓名
* @param string $hrb01_02_001  记录表单编号
* @param string $hrb01_02_003  新生儿性别代码
* @param dateTime $hrb01_02_004  新生儿出生日期时间
* @param string $hrb01_02_005  母亲姓名
* @param date $hrb01_02_006  母亲出生日期
* @param string $hrb01_02_007  母亲身份证件-类别代码
* @param string $hrb01_02_008  母亲身份证件-号码
* @param string $hrb01_02_009  地址类别代码
* @param string $hrb01_02_010  行政区划代码
* @param string $hrb01_02_011  地址-省（自治区、直辖市）
* @param string $hrb01_02_012  地址-市（地区）
* @param string $hrb01_02_013  地址-县（区）
* @param string $hrb01_02_014  地址-乡（镇、街道办事处）
* @param string $hrb01_02_015  地址-村（街、路、弄等）
* @param string $hrb01_02_016  地址-门牌号码
* @param string $hrb01_02_017  邮政编码
* @param string $hrb01_02_018  联系电话-类别
* @param string $hrb01_02_019  联系电话-类别代码
* @param string $hrb01_02_020  联系电话-号码
* @param string $hrb01_02_021  标本编号
* @param dateTime $hrb01_02_022  采血日期时间
* @param string $hrb01_02_023  采血方式代码
* @param string $hrb01_02_024  采血部位代码
* @param string $hrb01_02_025  采血机构名称
* @param string $hrb01_02_026  采血人员姓名
* @param string $hrb01_02_027  新生儿疾病筛查项目代码
* @param string $hrb01_02_028  新生儿疾病筛查方法代码
* @param string $hrb01_02_029  新生儿疾病筛查结果
* @param date $hrb01_02_030  检查（测）日期
* @param string $hrb01_02_031  检查（测）人员姓名
* @param string $hrb01_02_032  检查（测）机构名称
* @param date $hrb01_02_033  筛查结果通知日期
* @param date $hrb01_02_034  召回日期
* @param string $hrb01_02_035  检查结果通知形式代码
* @param string $hrb01_02_036  通知到达人姓名
* @param string $hrb01_02_037  通知到达人与新生儿关系代码
* @param string $hrb01_02_038  通知者姓名
* @param date $hrb01_02_039  诊断日期
* @param string $hrb01_02_040  诊断项目
* @param string $hrb01_02_041  诊断方法
* @param string $hrb01_02_042  诊断结果
* @param string $hrb01_02_043  诊断机构名称
* @return boolean
*/
function update_hrb01_02($ws_id,$org_id,$doctor_id,$identity_number,$hrb01_02_002='',$hrb01_02_001='',$hrb01_02_003='',$hrb01_02_004='',$hrb01_02_005='',$hrb01_02_006='',$hrb01_02_007='',$hrb01_02_008='',$hrb01_02_009='',$hrb01_02_010='',$hrb01_02_011='',$hrb01_02_012='',$hrb01_02_013='',$hrb01_02_014='',$hrb01_02_015='',$hrb01_02_016='',$hrb01_02_017='',$hrb01_02_018='',$hrb01_02_019='',$hrb01_02_020='',$hrb01_02_021='',$hrb01_02_022='',$hrb01_02_023='',$hrb01_02_024='',$hrb01_02_025='',$hrb01_02_026='',$hrb01_02_027='',$hrb01_02_028='',$hrb01_02_029='',$hrb01_02_030='',$hrb01_02_031='',$hrb01_02_032='',$hrb01_02_033='',$hrb01_02_034='',$hrb01_02_035='',$hrb01_02_036='',$hrb01_02_037='',$hrb01_02_038='',$hrb01_02_039='',$hrb01_02_040='',$hrb01_02_041='',$hrb01_02_042='',$hrb01_02_043=''){
require_once(__SITEROOT.'library/Models/ws_hrb01_02.php');
$table_obj="Tws_hrb01_02";
$ws_hrb01_02=new $table_obj();
$ws_hrb01_02 -> ws_id=$ws_id;
$ws_hrb01_02 -> uuid=uniqid('',true);
$ws_hrb01_02 -> created=time();
$ws_hrb01_02 -> org_id=$org_id;
$ws_hrb01_02 -> doctor_id=$doctor_id;
$ws_hrb01_02 -> identity_number=$identity_number;//身份证号
$ws_hrb01_02 -> action='insert';
$ws_hrb01_02->hrb01_02_002 = $hrb01_02_002; //新生儿姓名 
$ws_hrb01_02->hrb01_02_001 = $hrb01_02_001; //记录表单编号 
$ws_hrb01_02->hrb01_02_003 = $hrb01_02_003; //新生儿性别代码 
$ws_hrb01_02 ->hrb01_02_004 = empty($hrb01_02_004)?null : $ws_hrb01_02 ->escape('hrb01_02_004',to_date($hrb01_02_004,'YYYY-MM-DD')); //新生儿出生日期时间 
$ws_hrb01_02->hrb01_02_005 = $hrb01_02_005; //母亲姓名 
$ws_hrb01_02 ->hrb01_02_006 = empty($hrb01_02_006)?null : $ws_hrb01_02 ->escape('hrb01_02_006',to_date($hrb01_02_006,'YYYY-MM-DD')); //母亲出生日期 
$ws_hrb01_02->hrb01_02_007 = $hrb01_02_007; //母亲身份证件-类别代码 
$ws_hrb01_02->hrb01_02_008 = $hrb01_02_008; //母亲身份证件-号码 
$ws_hrb01_02->hrb01_02_009 = $hrb01_02_009; //地址类别代码 
$ws_hrb01_02->hrb01_02_010 = $hrb01_02_010; //行政区划代码 
$ws_hrb01_02->hrb01_02_011 = $hrb01_02_011; //地址-省（自治区、直辖市） 
$ws_hrb01_02->hrb01_02_012 = $hrb01_02_012; //地址-市（地区） 
$ws_hrb01_02->hrb01_02_013 = $hrb01_02_013; //地址-县（区） 
$ws_hrb01_02->hrb01_02_014 = $hrb01_02_014; //地址-乡（镇、街道办事处） 
$ws_hrb01_02->hrb01_02_015 = $hrb01_02_015; //地址-村（街、路、弄等） 
$ws_hrb01_02->hrb01_02_016 = $hrb01_02_016; //地址-门牌号码 
$ws_hrb01_02->hrb01_02_017 = $hrb01_02_017; //邮政编码 
$ws_hrb01_02->hrb01_02_018 = $hrb01_02_018; //联系电话-类别 
$ws_hrb01_02->hrb01_02_019 = $hrb01_02_019; //联系电话-类别代码 
$ws_hrb01_02->hrb01_02_020 = $hrb01_02_020; //联系电话-号码 
$ws_hrb01_02->hrb01_02_021 = $hrb01_02_021; //标本编号 
$ws_hrb01_02 ->hrb01_02_022 = empty($hrb01_02_022)?null : $ws_hrb01_02 ->escape('hrb01_02_022',to_date($hrb01_02_022,'YYYY-MM-DD')); //采血日期时间 
$ws_hrb01_02->hrb01_02_023 = $hrb01_02_023; //采血方式代码 
$ws_hrb01_02->hrb01_02_024 = $hrb01_02_024; //采血部位代码 
$ws_hrb01_02->hrb01_02_025 = $hrb01_02_025; //采血机构名称 
$ws_hrb01_02->hrb01_02_026 = $hrb01_02_026; //采血人员姓名 
$ws_hrb01_02->hrb01_02_027 = $hrb01_02_027; //新生儿疾病筛查项目代码 
$ws_hrb01_02->hrb01_02_028 = $hrb01_02_028; //新生儿疾病筛查方法代码 
$ws_hrb01_02->hrb01_02_029 = $hrb01_02_029; //新生儿疾病筛查结果 
$ws_hrb01_02 ->hrb01_02_030 = empty($hrb01_02_030)?null : $ws_hrb01_02 ->escape('hrb01_02_030',to_date($hrb01_02_030,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrb01_02->hrb01_02_031 = $hrb01_02_031; //检查（测）人员姓名 
$ws_hrb01_02->hrb01_02_032 = $hrb01_02_032; //检查（测）机构名称 
$ws_hrb01_02 ->hrb01_02_033 = empty($hrb01_02_033)?null : $ws_hrb01_02 ->escape('hrb01_02_033',to_date($hrb01_02_033,'YYYY-MM-DD')); //筛查结果通知日期 
$ws_hrb01_02 ->hrb01_02_034 = empty($hrb01_02_034)?null : $ws_hrb01_02 ->escape('hrb01_02_034',to_date($hrb01_02_034,'YYYY-MM-DD')); //召回日期 
$ws_hrb01_02->hrb01_02_035 = $hrb01_02_035; //检查结果通知形式代码 
$ws_hrb01_02->hrb01_02_036 = $hrb01_02_036; //通知到达人姓名 
$ws_hrb01_02->hrb01_02_037 = $hrb01_02_037; //通知到达人与新生儿关系代码 
$ws_hrb01_02->hrb01_02_038 = $hrb01_02_038; //通知者姓名 
$ws_hrb01_02 ->hrb01_02_039 = empty($hrb01_02_039)?null : $ws_hrb01_02 ->escape('hrb01_02_039',to_date($hrb01_02_039,'YYYY-MM-DD')); //诊断日期 
$ws_hrb01_02->hrb01_02_040 = $hrb01_02_040; //诊断项目 
$ws_hrb01_02->hrb01_02_041 = $hrb01_02_041; //诊断方法 
$ws_hrb01_02->hrb01_02_042 = $hrb01_02_042; //诊断结果 
$ws_hrb01_02->hrb01_02_043 = $hrb01_02_043; //诊断机构名称 
if($ws_hrb01_02 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb01_02 ->free_statement();
}
