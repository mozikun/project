<?php
/**
艾滋病防治基本数据艾滋病防治基本数据
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb03_04_001  姓名
* @param string $hrb03_04_002  性别代码
* @param string $hrb03_04_003  父亲姓名
* @param string $hrb03_04_004  母亲姓名
* @param string $hrb03_04_005  身份证件-类别代码
* @param string $hrb03_04_006  身份证件-号码
* @param date $hrb03_04_007  出生日期
* @param string $hrb03_04_008  职业代码（传染病）
* @param string $hrb03_04_009  联系电话-类别
* @param string $hrb03_04_010  联系电话-类别代码
* @param string $hrb03_04_011  联系电话-号码
* @param string $hrb03_04_012  地址类别代码
* @param string $hrb03_04_013  地址-省（自治区、直辖市）
* @param string $hrb03_04_014  地址-市（地区）
* @param string $hrb03_04_015  地址-县（区）
* @param string $hrb03_04_016  地址-乡（镇、街道办事处）
* @param string $hrb03_04_017  地址-村（街、路、弄等）
* @param string $hrb03_04_018  地址-门牌号码
* @param string $hrb03_04_019  民族代码
* @param string $hrb03_04_020  婚姻状况类别代码
* @param string $hrb03_04_021  文化程度代码
* @param string $hrb03_04_022  艾滋病接触史代码
* @param string $hrb03_04_023  性病史代码
* @param string $hrb03_04_024  艾滋病阳性检测方法代码
* @param date $hrb03_04_025  艾滋病病毒感染诊断日期
* @param string $hrb03_04_026  诊断机构名称
* @param decimal $hrb03_04_027  CD4+检测结果（个/ul）
* @param date $hrb03_04_028  CD4+检测日期
* @param boolean $hrb03_04_029  艾滋病病人标志
* @param date $hrb03_04_030  确诊日期
* @param boolean $hrb03_04_031  艾滋病抗病毒治疗标志
* @param decimal $hrb03_04_032  艾滋病抗病毒治疗编号
* @param date $hrb03_04_033  艾滋病抗病毒治疗开始日期
* @param date $hrb03_04_034  艾滋病抗病毒治疗终止日期
* @param string $hrb03_04_035  艾滋病抗病毒治疗终止原因代码
* @param string $hrb03_04_036  艾滋病抗病毒治疗停药原因代码
* @param boolean $hrb03_04_037  美沙酮维持治疗标志
* @param decimal $hrb03_04_038  美沙酮维持治疗编号
* @param date $hrb03_04_039  美沙酮维持治疗开始日期
* @param date $hrb03_04_040  美沙酮维持治疗终止日期
* @param string $hrb03_04_041  美沙酮维持治疗终止原因代码
* @param dateTime $hrb03_04_042  死亡日期时间
* @param string $hrb03_04_043  根本死因代码
* @param boolean $hrb03_04_044  配偶/固定性伴标志
* @param string $hrb03_04_045  配偶/固定性伴感染状况代码
* @param boolean $hrb03_04_046  子女标志
* @param string $hrb03_04_047  子女感染状况代码
* @param boolean $hrb03_04_048  避孕措施标志
* @param boolean $hrb03_04_049  怀孕标志
* @param boolean $hrb03_04_050  分娩标志
* @param string $hrb03_04_051  分娩活产个数
* @param string $hrb03_04_052  育龄妇女预防母婴传播干预措施代码
* @param decimal $hrb03_04_053  身高（cm）
* @param decimal $hrb03_04_054  体重（kg）
* @param decimal $hrb03_04_055  头围（cm）
* @param decimal $hrb03_04_056  出生身长（cm）
* @param decimal $hrb03_04_057  身长（cm）
* @param decimal $hrb03_04_058  出生体重（g）
* @param decimal $hrb03_04_059  出生头围（cm)
* @param string $hrb03_04_060  儿童预防母婴传播干预措施代码
* @return boolean
*/
function update_hrb03_04($ws_id,$org_id,$doctor_id,$identity_number,$hrb03_04_001='',$hrb03_04_002='',$hrb03_04_003='',$hrb03_04_004='',$hrb03_04_005='',$hrb03_04_006='',$hrb03_04_007='',$hrb03_04_008='',$hrb03_04_009='',$hrb03_04_010='',$hrb03_04_011='',$hrb03_04_012='',$hrb03_04_013='',$hrb03_04_014='',$hrb03_04_015='',$hrb03_04_016='',$hrb03_04_017='',$hrb03_04_018='',$hrb03_04_019='',$hrb03_04_020='',$hrb03_04_021='',$hrb03_04_022='',$hrb03_04_023='',$hrb03_04_024='',$hrb03_04_025='',$hrb03_04_026='',$hrb03_04_027=0,$hrb03_04_028='',$hrb03_04_029=false,$hrb03_04_030='',$hrb03_04_031=false,$hrb03_04_032=0,$hrb03_04_033='',$hrb03_04_034='',$hrb03_04_035='',$hrb03_04_036='',$hrb03_04_037=false,$hrb03_04_038=0,$hrb03_04_039='',$hrb03_04_040='',$hrb03_04_041='',$hrb03_04_042='',$hrb03_04_043='',$hrb03_04_044=false,$hrb03_04_045='',$hrb03_04_046=false,$hrb03_04_047='',$hrb03_04_048=false,$hrb03_04_049=false,$hrb03_04_050=false,$hrb03_04_051='',$hrb03_04_052='',$hrb03_04_053=0,$hrb03_04_054=0,$hrb03_04_055=0,$hrb03_04_056=0,$hrb03_04_057=0,$hrb03_04_058=0,$hrb03_04_059=0,$hrb03_04_060=''){
require_once(__SITEROOT.'library/Models/ws_hrb03_04.php');
$table_obj="Tws_hrb03_04";
$ws_hrb03_04=new $table_obj();
$ws_hrb03_04 -> ws_id=$ws_id;
$ws_hrb03_04 -> uuid=uniqid('',true);
$ws_hrb03_04 -> created=time();
$ws_hrb03_04 -> org_id=$org_id;
$ws_hrb03_04 -> doctor_id=$doctor_id;
$ws_hrb03_04 -> identity_number=$identity_number;//身份证号
$ws_hrb03_04 -> action='insert';
$ws_hrb03_04->hrb03_04_001 = $hrb03_04_001; //姓名 
$ws_hrb03_04->hrb03_04_002 = $hrb03_04_002; //性别代码 
$ws_hrb03_04->hrb03_04_003 = $hrb03_04_003; //父亲姓名 
$ws_hrb03_04->hrb03_04_004 = $hrb03_04_004; //母亲姓名 
$ws_hrb03_04->hrb03_04_005 = $hrb03_04_005; //身份证件-类别代码 
$ws_hrb03_04->hrb03_04_006 = $hrb03_04_006; //身份证件-号码 
$ws_hrb03_04 ->hrb03_04_007 = empty($hrb03_04_007)?null : $ws_hrb03_04 ->escape('hrb03_04_007',to_date($hrb03_04_007,'YYYY-MM-DD')); //出生日期 
$ws_hrb03_04->hrb03_04_008 = $hrb03_04_008; //职业代码（传染病） 
$ws_hrb03_04->hrb03_04_009 = $hrb03_04_009; //联系电话-类别 
$ws_hrb03_04->hrb03_04_010 = $hrb03_04_010; //联系电话-类别代码 
$ws_hrb03_04->hrb03_04_011 = $hrb03_04_011; //联系电话-号码 
$ws_hrb03_04->hrb03_04_012 = $hrb03_04_012; //地址类别代码 
$ws_hrb03_04->hrb03_04_013 = $hrb03_04_013; //地址-省（自治区、直辖市） 
$ws_hrb03_04->hrb03_04_014 = $hrb03_04_014; //地址-市（地区） 
$ws_hrb03_04->hrb03_04_015 = $hrb03_04_015; //地址-县（区） 
$ws_hrb03_04->hrb03_04_016 = $hrb03_04_016; //地址-乡（镇、街道办事处） 
$ws_hrb03_04->hrb03_04_017 = $hrb03_04_017; //地址-村（街、路、弄等） 
$ws_hrb03_04->hrb03_04_018 = $hrb03_04_018; //地址-门牌号码 
$ws_hrb03_04->hrb03_04_019 = $hrb03_04_019; //民族代码 
$ws_hrb03_04->hrb03_04_020 = $hrb03_04_020; //婚姻状况类别代码 
$ws_hrb03_04->hrb03_04_021 = $hrb03_04_021; //文化程度代码 
$ws_hrb03_04->hrb03_04_022 = $hrb03_04_022; //艾滋病接触史代码 
$ws_hrb03_04->hrb03_04_023 = $hrb03_04_023; //性病史代码 
$ws_hrb03_04->hrb03_04_024 = $hrb03_04_024; //艾滋病阳性检测方法代码 
$ws_hrb03_04 ->hrb03_04_025 = empty($hrb03_04_025)?null : $ws_hrb03_04 ->escape('hrb03_04_025',to_date($hrb03_04_025,'YYYY-MM-DD')); //艾滋病病毒感染诊断日期 
$ws_hrb03_04->hrb03_04_026 = $hrb03_04_026; //诊断机构名称 
$ws_hrb03_04->hrb03_04_027 = $hrb03_04_027; //CD4+检测结果（个/ul） 
$ws_hrb03_04 ->hrb03_04_028 = empty($hrb03_04_028)?null : $ws_hrb03_04 ->escape('hrb03_04_028',to_date($hrb03_04_028,'YYYY-MM-DD')); //CD4+检测日期 
$ws_hrb03_04->hrb03_04_029 = $hrb03_04_029; //艾滋病病人标志 
$ws_hrb03_04 ->hrb03_04_030 = empty($hrb03_04_030)?null : $ws_hrb03_04 ->escape('hrb03_04_030',to_date($hrb03_04_030,'YYYY-MM-DD')); //确诊日期 
$ws_hrb03_04->hrb03_04_031 = $hrb03_04_031; //艾滋病抗病毒治疗标志 
$ws_hrb03_04->hrb03_04_032 = $hrb03_04_032; //艾滋病抗病毒治疗编号 
$ws_hrb03_04 ->hrb03_04_033 = empty($hrb03_04_033)?null : $ws_hrb03_04 ->escape('hrb03_04_033',to_date($hrb03_04_033,'YYYY-MM-DD')); //艾滋病抗病毒治疗开始日期 
$ws_hrb03_04 ->hrb03_04_034 = empty($hrb03_04_034)?null : $ws_hrb03_04 ->escape('hrb03_04_034',to_date($hrb03_04_034,'YYYY-MM-DD')); //艾滋病抗病毒治疗终止日期 
$ws_hrb03_04->hrb03_04_035 = $hrb03_04_035; //艾滋病抗病毒治疗终止原因代码 
$ws_hrb03_04->hrb03_04_036 = $hrb03_04_036; //艾滋病抗病毒治疗停药原因代码 
$ws_hrb03_04->hrb03_04_037 = $hrb03_04_037; //美沙酮维持治疗标志 
$ws_hrb03_04->hrb03_04_038 = $hrb03_04_038; //美沙酮维持治疗编号 
$ws_hrb03_04 ->hrb03_04_039 = empty($hrb03_04_039)?null : $ws_hrb03_04 ->escape('hrb03_04_039',to_date($hrb03_04_039,'YYYY-MM-DD')); //美沙酮维持治疗开始日期 
$ws_hrb03_04 ->hrb03_04_040 = empty($hrb03_04_040)?null : $ws_hrb03_04 ->escape('hrb03_04_040',to_date($hrb03_04_040,'YYYY-MM-DD')); //美沙酮维持治疗终止日期 
$ws_hrb03_04->hrb03_04_041 = $hrb03_04_041; //美沙酮维持治疗终止原因代码 
$ws_hrb03_04 ->hrb03_04_042 = empty($hrb03_04_042)?null : $ws_hrb03_04 ->escape('hrb03_04_042',to_date($hrb03_04_042,'YYYY-MM-DD')); //死亡日期时间 
$ws_hrb03_04->hrb03_04_043 = $hrb03_04_043; //根本死因代码 
$ws_hrb03_04->hrb03_04_044 = $hrb03_04_044; //配偶/固定性伴标志 
$ws_hrb03_04->hrb03_04_045 = $hrb03_04_045; //配偶/固定性伴感染状况代码 
$ws_hrb03_04->hrb03_04_046 = $hrb03_04_046; //子女标志 
$ws_hrb03_04->hrb03_04_047 = $hrb03_04_047; //子女感染状况代码 
$ws_hrb03_04->hrb03_04_048 = $hrb03_04_048; //避孕措施标志 
$ws_hrb03_04->hrb03_04_049 = $hrb03_04_049; //怀孕标志 
$ws_hrb03_04->hrb03_04_050 = $hrb03_04_050; //分娩标志 
$ws_hrb03_04->hrb03_04_051 = $hrb03_04_051; //分娩活产个数 
$ws_hrb03_04->hrb03_04_052 = $hrb03_04_052; //育龄妇女预防母婴传播干预措施代码 
$ws_hrb03_04->hrb03_04_053 = $hrb03_04_053; //身高（cm） 
$ws_hrb03_04->hrb03_04_054 = $hrb03_04_054; //体重（kg） 
$ws_hrb03_04->hrb03_04_055 = $hrb03_04_055; //头围（cm） 
$ws_hrb03_04->hrb03_04_056 = $hrb03_04_056; //出生身长（cm） 
$ws_hrb03_04->hrb03_04_057 = $hrb03_04_057; //身长（cm） 
$ws_hrb03_04->hrb03_04_058 = $hrb03_04_058; //出生体重（g） 
$ws_hrb03_04->hrb03_04_059 = $hrb03_04_059; //出生头围（cm) 
$ws_hrb03_04->hrb03_04_060 = $hrb03_04_060; //儿童预防母婴传播干预措施代码 
if($ws_hrb03_04 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb03_04 ->free_statement();
}
