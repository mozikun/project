<?php
/**
预防接种基本数据预防接种基本数据
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb03_01_001  姓名
* @param date $hrb03_01_002  出生日期
* @param string $hrb03_01_003  性别代码
* @param string $hrb03_01_004  身份证件-类别代码
* @param string $hrb03_01_005  身份证件-号码
* @param string $hrb03_01_006  地址类别代码
* @param string $hrb03_01_007  地址-省（自治区、直辖市）
* @param string $hrb03_01_008  地址-市（地区）
* @param string $hrb03_01_009  地址-县（区）
* @param string $hrb03_01_010  地址-乡（镇、街道办事处）
* @param string $hrb03_01_011  地址-村（街、路、弄等）
* @param string $hrb03_01_012  地址-门牌号码
* @param string $hrb03_01_013  出生医学证明编号
* @param string $hrb03_01_014  父亲姓名
* @param string $hrb03_01_015  母亲姓名
* @param string $hrb03_01_016  联系电话-类别
* @param string $hrb03_01_017  联系电话-类别代码
* @param string $hrb03_01_018  联系电话-号码
* @param string $hrb03_01_019  过敏症状
* @param string $hrb03_01_020  过敏原
* @param string $hrb03_01_021  疫苗接种者姓名 
* @param string $hrb03_01_022  疫苗接种单位名称
* @param date $hrb03_01_023  疫苗接种日期
* @param string $hrb03_01_024  免疫类型代码
* @param string $hrb03_01_025  疫苗-名称代码
* @param string $hrb03_01_026  疫苗-批号
* @param string $hrb03_01_027  疫苗生产厂家代码
* @param string $hrb03_01_028  引起预防接种后不良反应的可疑疫苗名称代码
* @param string $hrb03_01_029  预防接种后不良反应症状代码
* @param date $hrb03_01_030  预防接种后不良反应发生日期
* @param string $hrb03_01_031  预防接种后不良反应处理结果
* @return boolean
*/
function update_hrb03_01($ws_id,$org_id,$doctor_id,$identity_number,$hrb03_01_001='',$hrb03_01_002='',$hrb03_01_003='',$hrb03_01_004='',$hrb03_01_005='',$hrb03_01_006='',$hrb03_01_007='',$hrb03_01_008='',$hrb03_01_009='',$hrb03_01_010='',$hrb03_01_011='',$hrb03_01_012='',$hrb03_01_013='',$hrb03_01_014='',$hrb03_01_015='',$hrb03_01_016='',$hrb03_01_017='',$hrb03_01_018='',$hrb03_01_019='',$hrb03_01_020='',$hrb03_01_021='',$hrb03_01_022='',$hrb03_01_023='',$hrb03_01_024='',$hrb03_01_025='',$hrb03_01_026='',$hrb03_01_027='',$hrb03_01_028='',$hrb03_01_029='',$hrb03_01_030='',$hrb03_01_031=''){
require_once(__SITEROOT.'library/Models/ws_hrb03_01.php');
$table_obj="Tws_hrb03_01";
$ws_hrb03_01=new $table_obj();
$ws_hrb03_01 -> ws_id=$ws_id;
$ws_hrb03_01 -> uuid=uniqid('',true);
$ws_hrb03_01 -> created=time();
$ws_hrb03_01 -> org_id=$org_id;
$ws_hrb03_01 -> doctor_id=$doctor_id;
$ws_hrb03_01 -> identity_number=$identity_number;//身份证号
$ws_hrb03_01 -> action='insert';
$ws_hrb03_01->hrb03_01_001 = $hrb03_01_001; //姓名 
$ws_hrb03_01 ->hrb03_01_002 = empty($hrb03_01_002)?null : $ws_hrb03_01 ->escape('hrb03_01_002',to_date($hrb03_01_002,'YYYY-MM-DD')); //出生日期 
$ws_hrb03_01->hrb03_01_003 = $hrb03_01_003; //性别代码 
$ws_hrb03_01->hrb03_01_004 = $hrb03_01_004; //身份证件-类别代码 
$ws_hrb03_01->hrb03_01_005 = $hrb03_01_005; //身份证件-号码 
$ws_hrb03_01->hrb03_01_006 = $hrb03_01_006; //地址类别代码 
$ws_hrb03_01->hrb03_01_007 = $hrb03_01_007; //地址-省（自治区、直辖市） 
$ws_hrb03_01->hrb03_01_008 = $hrb03_01_008; //地址-市（地区） 
$ws_hrb03_01->hrb03_01_009 = $hrb03_01_009; //地址-县（区） 
$ws_hrb03_01->hrb03_01_010 = $hrb03_01_010; //地址-乡（镇、街道办事处） 
$ws_hrb03_01->hrb03_01_011 = $hrb03_01_011; //地址-村（街、路、弄等） 
$ws_hrb03_01->hrb03_01_012 = $hrb03_01_012; //地址-门牌号码 
$ws_hrb03_01->hrb03_01_013 = $hrb03_01_013; //出生医学证明编号 
$ws_hrb03_01->hrb03_01_014 = $hrb03_01_014; //父亲姓名 
$ws_hrb03_01->hrb03_01_015 = $hrb03_01_015; //母亲姓名 
$ws_hrb03_01->hrb03_01_016 = $hrb03_01_016; //联系电话-类别 
$ws_hrb03_01->hrb03_01_017 = $hrb03_01_017; //联系电话-类别代码 
$ws_hrb03_01->hrb03_01_018 = $hrb03_01_018; //联系电话-号码 
$ws_hrb03_01->hrb03_01_019 = $hrb03_01_019; //过敏症状 
$ws_hrb03_01->hrb03_01_020 = $hrb03_01_020; //过敏原 
$ws_hrb03_01->hrb03_01_021 = $hrb03_01_021; //疫苗接种者姓名  
$ws_hrb03_01->hrb03_01_022 = $hrb03_01_022; //疫苗接种单位名称 
$ws_hrb03_01 ->hrb03_01_023 = empty($hrb03_01_023)?null : $ws_hrb03_01 ->escape('hrb03_01_023',to_date($hrb03_01_023,'YYYY-MM-DD')); //疫苗接种日期 
$ws_hrb03_01->hrb03_01_024 = $hrb03_01_024; //免疫类型代码 
$ws_hrb03_01->hrb03_01_025 = $hrb03_01_025; //疫苗-名称代码 
$ws_hrb03_01->hrb03_01_026 = $hrb03_01_026; //疫苗-批号 
$ws_hrb03_01->hrb03_01_027 = $hrb03_01_027; //疫苗生产厂家代码 
$ws_hrb03_01->hrb03_01_028 = $hrb03_01_028; //引起预防接种后不良反应的可疑疫苗名称代码 
$ws_hrb03_01->hrb03_01_029 = $hrb03_01_029; //预防接种后不良反应症状代码 
$ws_hrb03_01 ->hrb03_01_030 = empty($hrb03_01_030)?null : $ws_hrb03_01 ->escape('hrb03_01_030',to_date($hrb03_01_030,'YYYY-MM-DD')); //预防接种后不良反应发生日期 
$ws_hrb03_01->hrb03_01_031 = $hrb03_01_031; //预防接种后不良反应处理结果 
if($ws_hrb03_01 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb03_01 ->free_statement();
}
