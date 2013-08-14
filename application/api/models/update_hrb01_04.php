<?php
/**
体弱儿童管理基本数据集标准HRB01.04体弱儿童管理基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb01_04_001  记录表单编号
* @param string $hrb01_04_002  姓名
* @param string $hrb01_04_003  性别代码
* @param date $hrb01_04_004  出生日期
* @param string $hrb01_04_005  母亲姓名
* @param string $hrb01_04_006  父亲姓名
* @param string $hrb01_04_007  地址类别代码
* @param string $hrb01_04_008  行政区划代码
* @param string $hrb01_04_009  地址-省（自治区、直辖市）
* @param string $hrb01_04_010  地址-市（地区）
* @param string $hrb01_04_011  地址-县（区）
* @param string $hrb01_04_012  地址-乡（镇、街道办事处）
* @param string $hrb01_04_013  地址-村（街、路、弄等）
* @param string $hrb01_04_014  地址-门牌号码
* @param string $hrb01_04_015  邮政编码
* @param string $hrb01_04_016  联系电话-类别
* @param string $hrb01_04_017  联系电话-类别代码
* @param string $hrb01_04_018  联系电话-号码
* @param string $hrb01_04_019  喂养方式类别代码
* @param decimal $hrb01_04_020  随诊月龄
* @param string $hrb01_04_021  儿童体弱原因类别代码
* @param string $hrb01_04_022  症状
* @param string $hrb01_04_023  体征
* @param string $hrb01_04_024  辅助检查-项目名称
* @param string $hrb01_04_025  辅助检查-结果
* @param string $hrb01_04_026  处理及指导意见
* @param date $hrb01_04_027  预约日期
* @param date $hrb01_04_028  检查（测）日期
* @param string $hrb01_04_029  检查（测）人员姓名
* @param string $hrb01_04_030  检查（测）机构名称
* @param string $hrb01_04_031  体弱儿童转归代码
* @param date $hrb01_04_032  结案日期
* @param string $hrb01_04_033  结案医师姓名
* @param string $hrb01_04_034  结案单位名称
* @param date $hrb01_04_035  建档日期
* @return boolean
*/
function update_hrb01_04($ws_id,$org_id,$doctor_id,$identity_number,$hrb01_04_001='',$hrb01_04_002='',$hrb01_04_003='',$hrb01_04_004='',$hrb01_04_005='',$hrb01_04_006='',$hrb01_04_007='',$hrb01_04_008='',$hrb01_04_009='',$hrb01_04_010='',$hrb01_04_011='',$hrb01_04_012='',$hrb01_04_013='',$hrb01_04_014='',$hrb01_04_015='',$hrb01_04_016='',$hrb01_04_017='',$hrb01_04_018='',$hrb01_04_019='',$hrb01_04_020=0,$hrb01_04_021='',$hrb01_04_022='',$hrb01_04_023='',$hrb01_04_024='',$hrb01_04_025='',$hrb01_04_026='',$hrb01_04_027='',$hrb01_04_028='',$hrb01_04_029='',$hrb01_04_030='',$hrb01_04_031='',$hrb01_04_032='',$hrb01_04_033='',$hrb01_04_034='',$hrb01_04_035=''){
require_once(__SITEROOT.'library/Models/ws_hrb01_04.php');
$table_obj="Tws_hrb01_04";
$ws_hrb01_04=new $table_obj();
$ws_hrb01_04 -> ws_id=$ws_id;
$ws_hrb01_04 -> uuid=uniqid('',true);
$ws_hrb01_04 -> created=time();
$ws_hrb01_04 -> org_id=$org_id;
$ws_hrb01_04 -> doctor_id=$doctor_id;
$ws_hrb01_04 -> identity_number=$identity_number;//身份证号
$ws_hrb01_04 -> action='insert';
$ws_hrb01_04->hrb01_04_001 = $hrb01_04_001; //记录表单编号 
$ws_hrb01_04->hrb01_04_002 = $hrb01_04_002; //姓名 
$ws_hrb01_04->hrb01_04_003 = $hrb01_04_003; //性别代码 
$ws_hrb01_04 ->hrb01_04_004 = empty($hrb01_04_004)?null : $ws_hrb01_04 ->escape('hrb01_04_004',to_date($hrb01_04_004,'YYYY-MM-DD')); //出生日期 
$ws_hrb01_04->hrb01_04_005 = $hrb01_04_005; //母亲姓名 
$ws_hrb01_04->hrb01_04_006 = $hrb01_04_006; //父亲姓名 
$ws_hrb01_04->hrb01_04_007 = $hrb01_04_007; //地址类别代码 
$ws_hrb01_04->hrb01_04_008 = $hrb01_04_008; //行政区划代码 
$ws_hrb01_04->hrb01_04_009 = $hrb01_04_009; //地址-省（自治区、直辖市） 
$ws_hrb01_04->hrb01_04_010 = $hrb01_04_010; //地址-市（地区） 
$ws_hrb01_04->hrb01_04_011 = $hrb01_04_011; //地址-县（区） 
$ws_hrb01_04->hrb01_04_012 = $hrb01_04_012; //地址-乡（镇、街道办事处） 
$ws_hrb01_04->hrb01_04_013 = $hrb01_04_013; //地址-村（街、路、弄等） 
$ws_hrb01_04->hrb01_04_014 = $hrb01_04_014; //地址-门牌号码 
$ws_hrb01_04->hrb01_04_015 = $hrb01_04_015; //邮政编码 
$ws_hrb01_04->hrb01_04_016 = $hrb01_04_016; //联系电话-类别 
$ws_hrb01_04->hrb01_04_017 = $hrb01_04_017; //联系电话-类别代码 
$ws_hrb01_04->hrb01_04_018 = $hrb01_04_018; //联系电话-号码 
$ws_hrb01_04->hrb01_04_019 = $hrb01_04_019; //喂养方式类别代码 
$ws_hrb01_04->hrb01_04_020 = $hrb01_04_020; //随诊月龄 
$ws_hrb01_04->hrb01_04_021 = $hrb01_04_021; //儿童体弱原因类别代码 
$ws_hrb01_04->hrb01_04_022 = $hrb01_04_022; //症状 
$ws_hrb01_04->hrb01_04_023 = $hrb01_04_023; //体征 
$ws_hrb01_04->hrb01_04_024 = $hrb01_04_024; //辅助检查-项目名称 
$ws_hrb01_04->hrb01_04_025 = $hrb01_04_025; //辅助检查-结果 
$ws_hrb01_04->hrb01_04_026 = $hrb01_04_026; //处理及指导意见 
$ws_hrb01_04 ->hrb01_04_027 = empty($hrb01_04_027)?null : $ws_hrb01_04 ->escape('hrb01_04_027',to_date($hrb01_04_027,'YYYY-MM-DD')); //预约日期 
$ws_hrb01_04 ->hrb01_04_028 = empty($hrb01_04_028)?null : $ws_hrb01_04 ->escape('hrb01_04_028',to_date($hrb01_04_028,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrb01_04->hrb01_04_029 = $hrb01_04_029; //检查（测）人员姓名 
$ws_hrb01_04->hrb01_04_030 = $hrb01_04_030; //检查（测）机构名称 
$ws_hrb01_04->hrb01_04_031 = $hrb01_04_031; //体弱儿童转归代码 
$ws_hrb01_04 ->hrb01_04_032 = empty($hrb01_04_032)?null : $ws_hrb01_04 ->escape('hrb01_04_032',to_date($hrb01_04_032,'YYYY-MM-DD')); //结案日期 
$ws_hrb01_04->hrb01_04_033 = $hrb01_04_033; //结案医师姓名 
$ws_hrb01_04->hrb01_04_034 = $hrb01_04_034; //结案单位名称 
$ws_hrb01_04 ->hrb01_04_035 = empty($hrb01_04_035)?null : $ws_hrb01_04 ->escape('hrb01_04_035',to_date($hrb01_04_035,'YYYY-MM-DD')); //建档日期 
if($ws_hrb01_04 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb01_04 ->free_statement();
}
