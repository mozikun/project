<?php
/**
中毒报告基本数据集标准HRB03.10中毒报告基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb03_10_001  记录表单编号
* @param string $hrb03_10_002  姓名
* @param string $hrb03_10_003  性别代码
* @param string $hrb03_10_004  身份证件-类别代码
* @param string $hrb03_10_005  身份证件-号码
* @param date $hrb03_10_006  出生日期
* @param string $hrb03_10_007  地址类别代码
* @param string $hrb03_10_008  行政区划代码
* @param string $hrb03_10_009  地址-省（自治区、直辖市）
* @param string $hrb03_10_010  地址-市（地区）
* @param string $hrb03_10_011  地址-县（区）
* @param string $hrb03_10_012  地址-乡（镇、街道办事处）
* @param string $hrb03_10_013  地址-村（街、路、弄等）
* @param string $hrb03_10_014  地址-门牌号码
* @param date $hrb03_10_015  诊断日期
* @param string $hrb03_10_016  中毒农药名称代码
* @param string $hrb03_10_017  农药中毒类型代码
* @param string $hrb03_10_018  农药中毒转归代码
* @return boolean
*/
function update_hrb03_10($ws_id,$org_id,$doctor_id,$identity_number,$hrb03_10_001='',$hrb03_10_002='',$hrb03_10_003='',$hrb03_10_004='',$hrb03_10_005='',$hrb03_10_006='',$hrb03_10_007='',$hrb03_10_008='',$hrb03_10_009='',$hrb03_10_010='',$hrb03_10_011='',$hrb03_10_012='',$hrb03_10_013='',$hrb03_10_014='',$hrb03_10_015='',$hrb03_10_016='',$hrb03_10_017='',$hrb03_10_018=''){
require_once(__SITEROOT.'library/Models/ws_hrb03_10.php');
$table_obj="Tws_hrb03_10";
$ws_hrb03_10=new $table_obj();
$ws_hrb03_10 -> ws_id=$ws_id;
$ws_hrb03_10 -> uuid=uniqid('',true);
$ws_hrb03_10 -> created=time();
$ws_hrb03_10 -> org_id=$org_id;
$ws_hrb03_10 -> doctor_id=$doctor_id;
$ws_hrb03_10 -> identity_number=$identity_number;//身份证号
$ws_hrb03_10 -> action='insert';
$ws_hrb03_10->hrb03_10_001 = $hrb03_10_001; //记录表单编号 
$ws_hrb03_10->hrb03_10_002 = $hrb03_10_002; //姓名 
$ws_hrb03_10->hrb03_10_003 = $hrb03_10_003; //性别代码 
$ws_hrb03_10->hrb03_10_004 = $hrb03_10_004; //身份证件-类别代码 
$ws_hrb03_10->hrb03_10_005 = $hrb03_10_005; //身份证件-号码 
$ws_hrb03_10 ->hrb03_10_006 = empty($hrb03_10_006)?null : $ws_hrb03_10 ->escape('hrb03_10_006',to_date($hrb03_10_006,'YYYY-MM-DD')); //出生日期 
$ws_hrb03_10->hrb03_10_007 = $hrb03_10_007; //地址类别代码 
$ws_hrb03_10->hrb03_10_008 = $hrb03_10_008; //行政区划代码 
$ws_hrb03_10->hrb03_10_009 = $hrb03_10_009; //地址-省（自治区、直辖市） 
$ws_hrb03_10->hrb03_10_010 = $hrb03_10_010; //地址-市（地区） 
$ws_hrb03_10->hrb03_10_011 = $hrb03_10_011; //地址-县（区） 
$ws_hrb03_10->hrb03_10_012 = $hrb03_10_012; //地址-乡（镇、街道办事处） 
$ws_hrb03_10->hrb03_10_013 = $hrb03_10_013; //地址-村（街、路、弄等） 
$ws_hrb03_10->hrb03_10_014 = $hrb03_10_014; //地址-门牌号码 
$ws_hrb03_10 ->hrb03_10_015 = empty($hrb03_10_015)?null : $ws_hrb03_10 ->escape('hrb03_10_015',to_date($hrb03_10_015,'YYYY-MM-DD')); //诊断日期 
$ws_hrb03_10->hrb03_10_016 = $hrb03_10_016; //中毒农药名称代码 
$ws_hrb03_10->hrb03_10_017 = $hrb03_10_017; //农药中毒类型代码 
$ws_hrb03_10->hrb03_10_018 = $hrb03_10_018; //农药中毒转归代码 
if($ws_hrb03_10 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb03_10 ->free_statement();
}
