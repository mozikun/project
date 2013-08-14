<?php
/**
死亡医学证明基本数据死亡医学证明基本数据
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb03_12_001  姓名
* @param string $hrb03_12_002  性别代码
* @param string $hrb03_12_003  民族代码
* @param date $hrb03_12_004  出生日期
* @param dateTime $hrb03_12_005  死亡日期时间
* @param string $hrb03_12_006  身份证件-类别代码
* @param string $hrb03_12_007  身份证件-号码
* @param string $hrb03_12_008  职业类别代码(国标)
* @param string $hrb03_12_009  婚姻状况类别代码
* @param string $hrb03_12_010  文化程度代码
* @param string $hrb03_12_011  地址类别代码
* @param string $hrb03_12_012  行政区划代码
* @param string $hrb03_12_013  地址-省（自治区、直辖市）
* @param string $hrb03_12_014  地址-市（地区）
* @param string $hrb03_12_015  地址-县（区）
* @param string $hrb03_12_016  地址-乡（镇、街道办事处）
* @param string $hrb03_12_017  地址-村（街、路、弄等）
* @param string $hrb03_12_018  地址-门牌号码
* @param string $hrb03_12_019  邮政编码
* @param string $hrb03_12_020  联系电话-类别
* @param string $hrb03_12_021  联系电话-类别代码
* @param string $hrb03_12_022  联系电话-号码
* @param string $hrb03_12_023  工作单位名称
* @param string $hrb03_12_024  联系人姓名
* @param string $hrb03_12_025  住院号
* @param string $hrb03_12_026  死因链-顺序代码
* @param string $hrb03_12_027  死因链-疾病代码
* @param string $hrb03_12_028  根本死因代码
* @param decimal $hrb03_12_029  时间间隔-时长
* @param string $hrb03_12_030  时间间隔-单位代码
* @param string $hrb03_12_031  死亡医院
* @param string $hrb03_12_032  死亡地点类别代码
* @param string $hrb03_12_033  死亡最高诊断依据类别代码
* @param string $hrb03_12_034  死亡最高诊断机构级别代码
* @return boolean
*/
function update_hrb03_12($ws_id,$org_id,$doctor_id,$identity_number,$hrb03_12_001='',$hrb03_12_002='',$hrb03_12_003='',$hrb03_12_004='',$hrb03_12_005='',$hrb03_12_006='',$hrb03_12_007='',$hrb03_12_008='',$hrb03_12_009='',$hrb03_12_010='',$hrb03_12_011='',$hrb03_12_012='',$hrb03_12_013='',$hrb03_12_014='',$hrb03_12_015='',$hrb03_12_016='',$hrb03_12_017='',$hrb03_12_018='',$hrb03_12_019='',$hrb03_12_020='',$hrb03_12_021='',$hrb03_12_022='',$hrb03_12_023='',$hrb03_12_024='',$hrb03_12_025='',$hrb03_12_026='',$hrb03_12_027='',$hrb03_12_028='',$hrb03_12_029=0,$hrb03_12_030='',$hrb03_12_031='',$hrb03_12_032='',$hrb03_12_033='',$hrb03_12_034=''){
require_once(__SITEROOT.'library/Models/ws_hrb03_12.php');
$table_obj="Tws_hrb03_12";
$ws_hrb03_12=new $table_obj();
$ws_hrb03_12 -> ws_id=$ws_id;
$ws_hrb03_12 -> uuid=uniqid('',true);
$ws_hrb03_12 -> created=time();
$ws_hrb03_12 -> org_id=$org_id;
$ws_hrb03_12 -> doctor_id=$doctor_id;
$ws_hrb03_12 -> identity_number=$identity_number;//身份证号
$ws_hrb03_12 -> action='insert';
$ws_hrb03_12->hrb03_12_001 = $hrb03_12_001; //姓名 
$ws_hrb03_12->hrb03_12_002 = $hrb03_12_002; //性别代码 
$ws_hrb03_12->hrb03_12_003 = $hrb03_12_003; //民族代码 
$ws_hrb03_12 ->hrb03_12_004 = empty($hrb03_12_004)?null : $ws_hrb03_12 ->escape('hrb03_12_004',to_date($hrb03_12_004,'YYYY-MM-DD')); //出生日期 
$ws_hrb03_12 ->hrb03_12_005 = empty($hrb03_12_005)?null : $ws_hrb03_12 ->escape('hrb03_12_005',to_date($hrb03_12_005,'YYYY-MM-DD')); //死亡日期时间 
$ws_hrb03_12->hrb03_12_006 = $hrb03_12_006; //身份证件-类别代码 
$ws_hrb03_12->hrb03_12_007 = $hrb03_12_007; //身份证件-号码 
$ws_hrb03_12->hrb03_12_008 = $hrb03_12_008; //职业类别代码(国标) 
$ws_hrb03_12->hrb03_12_009 = $hrb03_12_009; //婚姻状况类别代码 
$ws_hrb03_12->hrb03_12_010 = $hrb03_12_010; //文化程度代码 
$ws_hrb03_12->hrb03_12_011 = $hrb03_12_011; //地址类别代码 
$ws_hrb03_12->hrb03_12_012 = $hrb03_12_012; //行政区划代码 
$ws_hrb03_12->hrb03_12_013 = $hrb03_12_013; //地址-省（自治区、直辖市） 
$ws_hrb03_12->hrb03_12_014 = $hrb03_12_014; //地址-市（地区） 
$ws_hrb03_12->hrb03_12_015 = $hrb03_12_015; //地址-县（区） 
$ws_hrb03_12->hrb03_12_016 = $hrb03_12_016; //地址-乡（镇、街道办事处） 
$ws_hrb03_12->hrb03_12_017 = $hrb03_12_017; //地址-村（街、路、弄等） 
$ws_hrb03_12->hrb03_12_018 = $hrb03_12_018; //地址-门牌号码 
$ws_hrb03_12->hrb03_12_019 = $hrb03_12_019; //邮政编码 
$ws_hrb03_12->hrb03_12_020 = $hrb03_12_020; //联系电话-类别 
$ws_hrb03_12->hrb03_12_021 = $hrb03_12_021; //联系电话-类别代码 
$ws_hrb03_12->hrb03_12_022 = $hrb03_12_022; //联系电话-号码 
$ws_hrb03_12->hrb03_12_023 = $hrb03_12_023; //工作单位名称 
$ws_hrb03_12->hrb03_12_024 = $hrb03_12_024; //联系人姓名 
$ws_hrb03_12->hrb03_12_025 = $hrb03_12_025; //住院号 
$ws_hrb03_12->hrb03_12_026 = $hrb03_12_026; //死因链-顺序代码 
$ws_hrb03_12->hrb03_12_027 = $hrb03_12_027; //死因链-疾病代码 
$ws_hrb03_12->hrb03_12_028 = $hrb03_12_028; //根本死因代码 
$ws_hrb03_12->hrb03_12_029 = $hrb03_12_029; //时间间隔-时长 
$ws_hrb03_12->hrb03_12_030 = $hrb03_12_030; //时间间隔-单位代码 
$ws_hrb03_12->hrb03_12_031 = $hrb03_12_031; //死亡医院 
$ws_hrb03_12->hrb03_12_032 = $hrb03_12_032; //死亡地点类别代码 
$ws_hrb03_12->hrb03_12_033 = $hrb03_12_033; //死亡最高诊断依据类别代码 
$ws_hrb03_12->hrb03_12_034 = $hrb03_12_034; //死亡最高诊断机构级别代码 
if($ws_hrb03_12 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb03_12 ->free_statement();
}
