<?php
/**
传染病报告基本数据传染病报告基本数据
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb03_02_001  记录表单编号
* @param string $hrb03_02_002  报卡类别代码
* @param string $hrb03_02_003  姓名
* @param string $hrb03_02_004  家长姓名
* @param string $hrb03_02_005  身份证件-类别代码
* @param string $hrb03_02_006  身份证件-号码
* @param string $hrb03_02_007  性别代码
* @param date $hrb03_02_008  出生日期
* @param string $hrb03_02_009  工作单位名称
* @param string $hrb03_02_010  联系电话-类别
* @param string $hrb03_02_011  联系电话-类别代码
* @param string $hrb03_02_012  联系电话-号码
* @param string $hrb03_02_013  地址类别代码
* @param string $hrb03_02_014  地址-省（自治区、直辖市）
* @param string $hrb03_02_015  地址-市（地区）
* @param string $hrb03_02_016  地址-县（区）
* @param string $hrb03_02_017  地址-乡（镇、街道办事处）
* @param string $hrb03_02_018  地址-村（街、路、弄等）
* @param string $hrb03_02_019  地址-门牌号码
* @param string $hrb03_02_020  邮政编码
* @param string $hrb03_02_021  职业代码（传染病）
* @param date $hrb03_02_022  首次出现症状日期
* @param string $hrb03_02_023  传染病发病类别代码
* @param string $hrb03_02_024  诊断状态代码
* @param date $hrb03_02_025  诊断日期
* @param dateTime $hrb03_02_026  死亡日期时间
* @param string $hrb03_02_027  传染病类别代码
* @param string $hrb03_02_028  传染病名称代码
* @param string $hrb03_02_029  其他法定管理以及重点监测传染病名称
* @param string $hrb03_02_030  订正病名
* @param string $hrb03_02_031  退卡原因
* @param string $hrb03_02_032  报告医师姓名
* @param string $hrb03_02_033  填报单位名称
* @param date $hrb03_02_034  填报日期
* @return boolean
*/
function update_hrb03_02($ws_id,$org_id,$doctor_id,$identity_number,$hrb03_02_001='',$hrb03_02_002='',$hrb03_02_003='',$hrb03_02_004='',$hrb03_02_005='',$hrb03_02_006='',$hrb03_02_007='',$hrb03_02_008='',$hrb03_02_009='',$hrb03_02_010='',$hrb03_02_011='',$hrb03_02_012='',$hrb03_02_013='',$hrb03_02_014='',$hrb03_02_015='',$hrb03_02_016='',$hrb03_02_017='',$hrb03_02_018='',$hrb03_02_019='',$hrb03_02_020='',$hrb03_02_021='',$hrb03_02_022='',$hrb03_02_023='',$hrb03_02_024='',$hrb03_02_025='',$hrb03_02_026='',$hrb03_02_027='',$hrb03_02_028='',$hrb03_02_029='',$hrb03_02_030='',$hrb03_02_031='',$hrb03_02_032='',$hrb03_02_033='',$hrb03_02_034=''){
require_once(__SITEROOT.'library/Models/ws_hrb03_02.php');
$table_obj="Tws_hrb03_02";
$ws_hrb03_02=new $table_obj();
$ws_hrb03_02 -> ws_id=$ws_id;
$ws_hrb03_02 -> uuid=uniqid('',true);
$ws_hrb03_02 -> created=time();
$ws_hrb03_02 -> org_id=$org_id;
$ws_hrb03_02 -> doctor_id=$doctor_id;
$ws_hrb03_02 -> identity_number=$identity_number;//身份证号
$ws_hrb03_02 -> action='insert';
$ws_hrb03_02->hrb03_02_001 = $hrb03_02_001; //记录表单编号 
$ws_hrb03_02->hrb03_02_002 = $hrb03_02_002; //报卡类别代码 
$ws_hrb03_02->hrb03_02_003 = $hrb03_02_003; //姓名 
$ws_hrb03_02->hrb03_02_004 = $hrb03_02_004; //家长姓名 
$ws_hrb03_02->hrb03_02_005 = $hrb03_02_005; //身份证件-类别代码 
$ws_hrb03_02->hrb03_02_006 = $hrb03_02_006; //身份证件-号码 
$ws_hrb03_02->hrb03_02_007 = $hrb03_02_007; //性别代码 
$ws_hrb03_02 ->hrb03_02_008 = empty($hrb03_02_008)?null : $ws_hrb03_02 ->escape('hrb03_02_008',to_date($hrb03_02_008,'YYYY-MM-DD')); //出生日期 
$ws_hrb03_02->hrb03_02_009 = $hrb03_02_009; //工作单位名称 
$ws_hrb03_02->hrb03_02_010 = $hrb03_02_010; //联系电话-类别 
$ws_hrb03_02->hrb03_02_011 = $hrb03_02_011; //联系电话-类别代码 
$ws_hrb03_02->hrb03_02_012 = $hrb03_02_012; //联系电话-号码 
$ws_hrb03_02->hrb03_02_013 = $hrb03_02_013; //地址类别代码 
$ws_hrb03_02->hrb03_02_014 = $hrb03_02_014; //地址-省（自治区、直辖市） 
$ws_hrb03_02->hrb03_02_015 = $hrb03_02_015; //地址-市（地区） 
$ws_hrb03_02->hrb03_02_016 = $hrb03_02_016; //地址-县（区） 
$ws_hrb03_02->hrb03_02_017 = $hrb03_02_017; //地址-乡（镇、街道办事处） 
$ws_hrb03_02->hrb03_02_018 = $hrb03_02_018; //地址-村（街、路、弄等） 
$ws_hrb03_02->hrb03_02_019 = $hrb03_02_019; //地址-门牌号码 
$ws_hrb03_02->hrb03_02_020 = $hrb03_02_020; //邮政编码 
$ws_hrb03_02->hrb03_02_021 = $hrb03_02_021; //职业代码（传染病） 
$ws_hrb03_02 ->hrb03_02_022 = empty($hrb03_02_022)?null : $ws_hrb03_02 ->escape('hrb03_02_022',to_date($hrb03_02_022,'YYYY-MM-DD')); //首次出现症状日期 
$ws_hrb03_02->hrb03_02_023 = $hrb03_02_023; //传染病发病类别代码 
$ws_hrb03_02->hrb03_02_024 = $hrb03_02_024; //诊断状态代码 
$ws_hrb03_02 ->hrb03_02_025 = empty($hrb03_02_025)?null : $ws_hrb03_02 ->escape('hrb03_02_025',to_date($hrb03_02_025,'YYYY-MM-DD')); //诊断日期 
$ws_hrb03_02 ->hrb03_02_026 = empty($hrb03_02_026)?null : $ws_hrb03_02 ->escape('hrb03_02_026',to_date($hrb03_02_026,'YYYY-MM-DD')); //死亡日期时间 
$ws_hrb03_02->hrb03_02_027 = $hrb03_02_027; //传染病类别代码 
$ws_hrb03_02->hrb03_02_028 = $hrb03_02_028; //传染病名称代码 
$ws_hrb03_02->hrb03_02_029 = $hrb03_02_029; //其他法定管理以及重点监测传染病名称 
$ws_hrb03_02->hrb03_02_030 = $hrb03_02_030; //订正病名 
$ws_hrb03_02->hrb03_02_031 = $hrb03_02_031; //退卡原因 
$ws_hrb03_02->hrb03_02_032 = $hrb03_02_032; //报告医师姓名 
$ws_hrb03_02->hrb03_02_033 = $hrb03_02_033; //填报单位名称 
$ws_hrb03_02 ->hrb03_02_034 = empty($hrb03_02_034)?null : $ws_hrb03_02 ->escape('hrb03_02_034',to_date($hrb03_02_034,'YYYY-MM-DD')); //填报日期 
if($ws_hrb03_02 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb03_02 ->free_statement();
}
