<?php
/**
伤害监测报告基本数据集标准HRB03.09伤害监测报告基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb03_09_001  姓名
* @param string $hrb03_09_002  记录表单编号
* @param string $hrb03_09_003  身份证件-类别代码
* @param string $hrb03_09_004  身份证件-号码
* @param string $hrb03_09_005  性别代码
* @param date $hrb03_09_006  出生日期
* @param string $hrb03_09_007  职业类别代码(国标)
* @param string $hrb03_09_008  文化程度代码
* @param string $hrb03_09_009  地址类别代码
* @param string $hrb03_09_010  地址-省（自治区、直辖市）
* @param string $hrb03_09_011  地址-市（地区）
* @param string $hrb03_09_012  地址-县（区）
* @param string $hrb03_09_013  地址-乡（镇、街道办事处）
* @param string $hrb03_09_014  地址-村（街、路、弄等）
* @param string $hrb03_09_015  地址-门牌号码
* @param string $hrb03_09_016  邮政编码
* @param string $hrb03_09_017  就诊机构名称
* @param dateTime $hrb03_09_018  就诊日期时间
* @param dateTime $hrb03_09_019  伤害发生日期时间
* @param string $hrb03_09_020  伤害发生原因代码
* @param string $hrb03_09_021  伤害发生地点代码
* @param string $hrb03_09_022  伤害发生时活动类别代码
* @param string $hrb03_09_023  伤害意图类别代码
* @param string $hrb03_09_024  伤害性质代码
* @param string $hrb03_09_025  伤害部位代码
* @param string $hrb03_09_026  临床诊断
* @param string $hrb03_09_027  伤害严重程度代码
* @param string $hrb03_09_028  伤害转归代码
* @return boolean
*/
function update_hrb03_09($ws_id,$org_id,$doctor_id,$identity_number,$hrb03_09_001='',$hrb03_09_002='',$hrb03_09_003='',$hrb03_09_004='',$hrb03_09_005='',$hrb03_09_006='',$hrb03_09_007='',$hrb03_09_008='',$hrb03_09_009='',$hrb03_09_010='',$hrb03_09_011='',$hrb03_09_012='',$hrb03_09_013='',$hrb03_09_014='',$hrb03_09_015='',$hrb03_09_016='',$hrb03_09_017='',$hrb03_09_018='',$hrb03_09_019='',$hrb03_09_020='',$hrb03_09_021='',$hrb03_09_022='',$hrb03_09_023='',$hrb03_09_024='',$hrb03_09_025='',$hrb03_09_026='',$hrb03_09_027='',$hrb03_09_028=''){
require_once(__SITEROOT.'library/Models/ws_hrb03_09.php');
$table_obj="Tws_hrb03_09";
$ws_hrb03_09=new $table_obj();
$ws_hrb03_09 -> ws_id=$ws_id;
$ws_hrb03_09 -> uuid=uniqid('',true);
$ws_hrb03_09 -> created=time();
$ws_hrb03_09 -> org_id=$org_id;
$ws_hrb03_09 -> doctor_id=$doctor_id;
$ws_hrb03_09 -> identity_number=$identity_number;//身份证号
$ws_hrb03_09 -> action='insert';
$ws_hrb03_09->hrb03_09_001 = $hrb03_09_001; //姓名 
$ws_hrb03_09->hrb03_09_002 = $hrb03_09_002; //记录表单编号 
$ws_hrb03_09->hrb03_09_003 = $hrb03_09_003; //身份证件-类别代码 
$ws_hrb03_09->hrb03_09_004 = $hrb03_09_004; //身份证件-号码 
$ws_hrb03_09->hrb03_09_005 = $hrb03_09_005; //性别代码 
$ws_hrb03_09 ->hrb03_09_006 = empty($hrb03_09_006)?null : $ws_hrb03_09 ->escape('hrb03_09_006',to_date($hrb03_09_006,'YYYY-MM-DD')); //出生日期 
$ws_hrb03_09->hrb03_09_007 = $hrb03_09_007; //职业类别代码(国标) 
$ws_hrb03_09->hrb03_09_008 = $hrb03_09_008; //文化程度代码 
$ws_hrb03_09->hrb03_09_009 = $hrb03_09_009; //地址类别代码 
$ws_hrb03_09->hrb03_09_010 = $hrb03_09_010; //地址-省（自治区、直辖市） 
$ws_hrb03_09->hrb03_09_011 = $hrb03_09_011; //地址-市（地区） 
$ws_hrb03_09->hrb03_09_012 = $hrb03_09_012; //地址-县（区） 
$ws_hrb03_09->hrb03_09_013 = $hrb03_09_013; //地址-乡（镇、街道办事处） 
$ws_hrb03_09->hrb03_09_014 = $hrb03_09_014; //地址-村（街、路、弄等） 
$ws_hrb03_09->hrb03_09_015 = $hrb03_09_015; //地址-门牌号码 
$ws_hrb03_09->hrb03_09_016 = $hrb03_09_016; //邮政编码 
$ws_hrb03_09->hrb03_09_017 = $hrb03_09_017; //就诊机构名称 
$ws_hrb03_09 ->hrb03_09_018 = empty($hrb03_09_018)?null : $ws_hrb03_09 ->escape('hrb03_09_018',to_date($hrb03_09_018,'YYYY-MM-DD')); //就诊日期时间 
$ws_hrb03_09 ->hrb03_09_019 = empty($hrb03_09_019)?null : $ws_hrb03_09 ->escape('hrb03_09_019',to_date($hrb03_09_019,'YYYY-MM-DD')); //伤害发生日期时间 
$ws_hrb03_09->hrb03_09_020 = $hrb03_09_020; //伤害发生原因代码 
$ws_hrb03_09->hrb03_09_021 = $hrb03_09_021; //伤害发生地点代码 
$ws_hrb03_09->hrb03_09_022 = $hrb03_09_022; //伤害发生时活动类别代码 
$ws_hrb03_09->hrb03_09_023 = $hrb03_09_023; //伤害意图类别代码 
$ws_hrb03_09->hrb03_09_024 = $hrb03_09_024; //伤害性质代码 
$ws_hrb03_09->hrb03_09_025 = $hrb03_09_025; //伤害部位代码 
$ws_hrb03_09->hrb03_09_026 = $hrb03_09_026; //临床诊断 
$ws_hrb03_09->hrb03_09_027 = $hrb03_09_027; //伤害严重程度代码 
$ws_hrb03_09->hrb03_09_028 = $hrb03_09_028; //伤害转归代码 
if($ws_hrb03_09 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb03_09 ->free_statement();
}
