<?php
/**
产前筛查与诊断基本数据集标准HRB02.05产前筛查与诊断基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb02_05_001  记录表单编号
* @param string $hrb02_05_002  姓名
* @param date $hrb02_05_003  出生日期
* @param string $hrb02_05_004  身份证件-类别代码
* @param string $hrb02_05_005  身份证件-号码
* @param string $hrb02_05_006  地址类别代码
* @param string $hrb02_05_007  行政区划代码
* @param string $hrb02_05_008  地址-省（自治区、直辖市）
* @param string $hrb02_05_009  地址-市（地区）
* @param string $hrb02_05_010  地址-县（区）
* @param string $hrb02_05_011  地址-乡（镇、街道办事处）
* @param string $hrb02_05_012  地址-村（街、路、弄等）
* @param string $hrb02_05_013  地址-门牌号码
* @param string $hrb02_05_014  邮政编码
* @param string $hrb02_05_015  联系电话-类别
* @param string $hrb02_05_016  联系电话-类别代码
* @param string $hrb02_05_017  联系电话-号码
* @param decimal $hrb02_05_018  体重（kg）
* @param decimal $hrb02_05_019  产前筛查孕周
* @param string $hrb02_05_020  产前筛查项目
* @param string $hrb02_05_021  产前筛查方法代码
* @param string $hrb02_05_022  产前筛查结果
* @param decimal $hrb02_05_023  产前诊断孕周
* @param string $hrb02_05_024  诊断项目
* @param string $hrb02_05_025  诊断方法
* @param string $hrb02_05_026  诊断结果
* @param string $hrb02_05_027  产前诊断医学意见
* @param string $hrb02_05_028  妊娠结局
* @param date $hrb02_05_029  检查（测）日期
* @param string $hrb02_05_030  产前筛查医师姓名
* @param string $hrb02_05_031  产前筛查机构名称
* @param date $hrb02_05_032  诊断日期
* @param string $hrb02_05_033  产前诊断医师姓名
* @param string $hrb02_05_034  诊断机构名称
* @return boolean
*/
function update_hrb02_05($ws_id,$org_id,$doctor_id,$identity_number,$hrb02_05_001='',$hrb02_05_002='',$hrb02_05_003='',$hrb02_05_004='',$hrb02_05_005='',$hrb02_05_006='',$hrb02_05_007='',$hrb02_05_008='',$hrb02_05_009='',$hrb02_05_010='',$hrb02_05_011='',$hrb02_05_012='',$hrb02_05_013='',$hrb02_05_014='',$hrb02_05_015='',$hrb02_05_016='',$hrb02_05_017='',$hrb02_05_018=0,$hrb02_05_019=0,$hrb02_05_020='',$hrb02_05_021='',$hrb02_05_022='',$hrb02_05_023=0,$hrb02_05_024='',$hrb02_05_025='',$hrb02_05_026='',$hrb02_05_027='',$hrb02_05_028='',$hrb02_05_029='',$hrb02_05_030='',$hrb02_05_031='',$hrb02_05_032='',$hrb02_05_033='',$hrb02_05_034=''){
require_once(__SITEROOT.'library/Models/ws_hrb02_05.php');
$table_obj="Tws_hrb02_05";
$ws_hrb02_05=new $table_obj();
$ws_hrb02_05 -> ws_id=$ws_id;
$ws_hrb02_05 -> uuid=uniqid('',true);
$ws_hrb02_05 -> created=time();
$ws_hrb02_05 -> org_id=$org_id;
$ws_hrb02_05 -> doctor_id=$doctor_id;
$ws_hrb02_05 -> identity_number=$identity_number;//身份证号
$ws_hrb02_05 -> action='insert';
$ws_hrb02_05->hrb02_05_001 = $hrb02_05_001; //记录表单编号 
$ws_hrb02_05->hrb02_05_002 = $hrb02_05_002; //姓名 
$ws_hrb02_05 ->hrb02_05_003 = empty($hrb02_05_003)?null : $ws_hrb02_05 ->escape('hrb02_05_003',to_date($hrb02_05_003,'YYYY-MM-DD')); //出生日期 
$ws_hrb02_05->hrb02_05_004 = $hrb02_05_004; //身份证件-类别代码 
$ws_hrb02_05->hrb02_05_005 = $hrb02_05_005; //身份证件-号码 
$ws_hrb02_05->hrb02_05_006 = $hrb02_05_006; //地址类别代码 
$ws_hrb02_05->hrb02_05_007 = $hrb02_05_007; //行政区划代码 
$ws_hrb02_05->hrb02_05_008 = $hrb02_05_008; //地址-省（自治区、直辖市） 
$ws_hrb02_05->hrb02_05_009 = $hrb02_05_009; //地址-市（地区） 
$ws_hrb02_05->hrb02_05_010 = $hrb02_05_010; //地址-县（区） 
$ws_hrb02_05->hrb02_05_011 = $hrb02_05_011; //地址-乡（镇、街道办事处） 
$ws_hrb02_05->hrb02_05_012 = $hrb02_05_012; //地址-村（街、路、弄等） 
$ws_hrb02_05->hrb02_05_013 = $hrb02_05_013; //地址-门牌号码 
$ws_hrb02_05->hrb02_05_014 = $hrb02_05_014; //邮政编码 
$ws_hrb02_05->hrb02_05_015 = $hrb02_05_015; //联系电话-类别 
$ws_hrb02_05->hrb02_05_016 = $hrb02_05_016; //联系电话-类别代码 
$ws_hrb02_05->hrb02_05_017 = $hrb02_05_017; //联系电话-号码 
$ws_hrb02_05->hrb02_05_018 = $hrb02_05_018; //体重（kg） 
$ws_hrb02_05->hrb02_05_019 = $hrb02_05_019; //产前筛查孕周 
$ws_hrb02_05->hrb02_05_020 = $hrb02_05_020; //产前筛查项目 
$ws_hrb02_05->hrb02_05_021 = $hrb02_05_021; //产前筛查方法代码 
$ws_hrb02_05->hrb02_05_022 = $hrb02_05_022; //产前筛查结果 
$ws_hrb02_05->hrb02_05_023 = $hrb02_05_023; //产前诊断孕周 
$ws_hrb02_05->hrb02_05_024 = $hrb02_05_024; //诊断项目 
$ws_hrb02_05->hrb02_05_025 = $hrb02_05_025; //诊断方法 
$ws_hrb02_05->hrb02_05_026 = $hrb02_05_026; //诊断结果 
$ws_hrb02_05->hrb02_05_027 = $hrb02_05_027; //产前诊断医学意见 
$ws_hrb02_05->hrb02_05_028 = $hrb02_05_028; //妊娠结局 
$ws_hrb02_05 ->hrb02_05_029 = empty($hrb02_05_029)?null : $ws_hrb02_05 ->escape('hrb02_05_029',to_date($hrb02_05_029,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrb02_05->hrb02_05_030 = $hrb02_05_030; //产前筛查医师姓名 
$ws_hrb02_05->hrb02_05_031 = $hrb02_05_031; //产前筛查机构名称 
$ws_hrb02_05 ->hrb02_05_032 = empty($hrb02_05_032)?null : $ws_hrb02_05 ->escape('hrb02_05_032',to_date($hrb02_05_032,'YYYY-MM-DD')); //诊断日期 
$ws_hrb02_05->hrb02_05_033 = $hrb02_05_033; //产前诊断医师姓名 
$ws_hrb02_05->hrb02_05_034 = $hrb02_05_034; //诊断机构名称 
if($ws_hrb02_05 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb02_05 ->free_statement();
}
