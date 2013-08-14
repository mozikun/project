<?php
/**
出生缺陷监测基本数据集标准HRB02.06出生缺陷监测基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb02_06_001  记录表单编号
* @param string $hrb02_06_002  住院号
* @param string $hrb02_06_003  姓名
* @param date $hrb02_06_004  出生日期
* @param string $hrb02_06_005  民族代码
* @param string $hrb02_06_006  文化程度代码
* @param string $hrb02_06_007  家庭年人均收入类别代码
* @param string $hrb02_06_008  地址类别代码
* @param string $hrb02_06_009  行政区划代码
* @param string $hrb02_06_010  地址-省（自治区、直辖市）
* @param string $hrb02_06_011  地址-市（地区）
* @param string $hrb02_06_012  地址-县（区）
* @param string $hrb02_06_013  地址-乡（镇、街道办事处）
* @param string $hrb02_06_014  地址-村（街、路、弄等）
* @param string $hrb02_06_015  地址-门牌号码
* @param string $hrb02_06_016  邮政编码
* @param string $hrb02_06_017  常住地址类别代码
* @param decimal $hrb02_06_018  孕次
* @param decimal $hrb02_06_019  产次
* @param decimal $hrb02_06_020  死胎例数
* @param decimal $hrb02_06_021  自然流产次数
* @param decimal $hrb02_06_022  出生缺陷儿例数
* @param string $hrb02_06_023  家族遗传性疾病史
* @param boolean $hrb02_06_024  家族近亲婚配标志
* @param string $hrb02_06_025  家族近亲婚配者与本人关系代码
* @param string $hrb02_06_026  新生儿性别代码
* @param decimal $hrb02_06_027  胎龄
* @param dateTime $hrb02_06_028  分娩日期时间
* @param decimal $hrb02_06_029  体重（g）
* @param decimal $hrb02_06_030  胎数
* @param string $hrb02_06_031  多胎类型代码
* @param string $hrb02_06_032  出生缺陷儿结局代码
* @param boolean $hrb02_06_033  治疗性引产标志
* @param string $hrb02_06_034  出生缺陷诊断依据类别代码
* @param string $hrb02_06_035  出生缺陷确诊时间类别代码
* @param string $hrb02_06_036  出生缺陷类别代码
* @param boolean $hrb02_06_037  孕早期患病-标志
* @param string $hrb02_06_038  孕早期患病-情况
* @param string $hrb02_06_039  孕早期服药类别代码
* @param string $hrb02_06_040  药物名称
* @param string $hrb02_06_041  孕早期接触有害因素-类别代码
* @param string $hrb02_06_042  孕早期接触有害因素-情况
* @param date $hrb02_06_043  填报日期
* @param string $hrb02_06_044  填报人姓名
* @param string $hrb02_06_045  填报人职称代码
* @param string $hrb02_06_046  填报单位名称
* @param date $hrb02_06_047  医院审表日期
* @param string $hrb02_06_048  医院审表人姓名
* @param string $hrb02_06_049  医院审表人职称代码
* @param date $hrb02_06_050  省级审表日期
* @param string $hrb02_06_051  省级审表人姓名
* @param string $hrb02_06_052  省级审表人职称代码
* @return boolean
*/
function update_hrb02_06($ws_id,$org_id,$doctor_id,$identity_number,$hrb02_06_001='',$hrb02_06_002='',$hrb02_06_003='',$hrb02_06_004='',$hrb02_06_005='',$hrb02_06_006='',$hrb02_06_007='',$hrb02_06_008='',$hrb02_06_009='',$hrb02_06_010='',$hrb02_06_011='',$hrb02_06_012='',$hrb02_06_013='',$hrb02_06_014='',$hrb02_06_015='',$hrb02_06_016='',$hrb02_06_017='',$hrb02_06_018=0,$hrb02_06_019=0,$hrb02_06_020=0,$hrb02_06_021=0,$hrb02_06_022=0,$hrb02_06_023='',$hrb02_06_024=false,$hrb02_06_025='',$hrb02_06_026='',$hrb02_06_027=0,$hrb02_06_028='',$hrb02_06_029=0,$hrb02_06_030=0,$hrb02_06_031='',$hrb02_06_032='',$hrb02_06_033=false,$hrb02_06_034='',$hrb02_06_035='',$hrb02_06_036='',$hrb02_06_037=false,$hrb02_06_038='',$hrb02_06_039='',$hrb02_06_040='',$hrb02_06_041='',$hrb02_06_042='',$hrb02_06_043='',$hrb02_06_044='',$hrb02_06_045='',$hrb02_06_046='',$hrb02_06_047='',$hrb02_06_048='',$hrb02_06_049='',$hrb02_06_050='',$hrb02_06_051='',$hrb02_06_052=''){
require_once(__SITEROOT.'library/Models/ws_hrb02_06.php');
$table_obj="Tws_hrb02_06";
$ws_hrb02_06=new $table_obj();
$ws_hrb02_06 -> ws_id=$ws_id;
$ws_hrb02_06 -> uuid=uniqid('',true);
$ws_hrb02_06 -> created=time();
$ws_hrb02_06 -> org_id=$org_id;
$ws_hrb02_06 -> doctor_id=$doctor_id;
$ws_hrb02_06 -> identity_number=$identity_number;//身份证号
$ws_hrb02_06 -> action='insert';
$ws_hrb02_06->hrb02_06_001 = $hrb02_06_001; //记录表单编号 
$ws_hrb02_06->hrb02_06_002 = $hrb02_06_002; //住院号 
$ws_hrb02_06->hrb02_06_003 = $hrb02_06_003; //姓名 
$ws_hrb02_06 ->hrb02_06_004 = empty($hrb02_06_004)?null : $ws_hrb02_06 ->escape('hrb02_06_004',to_date($hrb02_06_004,'YYYY-MM-DD')); //出生日期 
$ws_hrb02_06->hrb02_06_005 = $hrb02_06_005; //民族代码 
$ws_hrb02_06->hrb02_06_006 = $hrb02_06_006; //文化程度代码 
$ws_hrb02_06->hrb02_06_007 = $hrb02_06_007; //家庭年人均收入类别代码 
$ws_hrb02_06->hrb02_06_008 = $hrb02_06_008; //地址类别代码 
$ws_hrb02_06->hrb02_06_009 = $hrb02_06_009; //行政区划代码 
$ws_hrb02_06->hrb02_06_010 = $hrb02_06_010; //地址-省（自治区、直辖市） 
$ws_hrb02_06->hrb02_06_011 = $hrb02_06_011; //地址-市（地区） 
$ws_hrb02_06->hrb02_06_012 = $hrb02_06_012; //地址-县（区） 
$ws_hrb02_06->hrb02_06_013 = $hrb02_06_013; //地址-乡（镇、街道办事处） 
$ws_hrb02_06->hrb02_06_014 = $hrb02_06_014; //地址-村（街、路、弄等） 
$ws_hrb02_06->hrb02_06_015 = $hrb02_06_015; //地址-门牌号码 
$ws_hrb02_06->hrb02_06_016 = $hrb02_06_016; //邮政编码 
$ws_hrb02_06->hrb02_06_017 = $hrb02_06_017; //常住地址类别代码 
$ws_hrb02_06->hrb02_06_018 = $hrb02_06_018; //孕次 
$ws_hrb02_06->hrb02_06_019 = $hrb02_06_019; //产次 
$ws_hrb02_06->hrb02_06_020 = $hrb02_06_020; //死胎例数 
$ws_hrb02_06->hrb02_06_021 = $hrb02_06_021; //自然流产次数 
$ws_hrb02_06->hrb02_06_022 = $hrb02_06_022; //出生缺陷儿例数 
$ws_hrb02_06->hrb02_06_023 = $hrb02_06_023; //家族遗传性疾病史 
$ws_hrb02_06->hrb02_06_024 = $hrb02_06_024; //家族近亲婚配标志 
$ws_hrb02_06->hrb02_06_025 = $hrb02_06_025; //家族近亲婚配者与本人关系代码 
$ws_hrb02_06->hrb02_06_026 = $hrb02_06_026; //新生儿性别代码 
$ws_hrb02_06->hrb02_06_027 = $hrb02_06_027; //胎龄 
$ws_hrb02_06 ->hrb02_06_028 = empty($hrb02_06_028)?null : $ws_hrb02_06 ->escape('hrb02_06_028',to_date($hrb02_06_028,'YYYY-MM-DD')); //分娩日期时间 
$ws_hrb02_06->hrb02_06_029 = $hrb02_06_029; //体重（g） 
$ws_hrb02_06->hrb02_06_030 = $hrb02_06_030; //胎数 
$ws_hrb02_06->hrb02_06_031 = $hrb02_06_031; //多胎类型代码 
$ws_hrb02_06->hrb02_06_032 = $hrb02_06_032; //出生缺陷儿结局代码 
$ws_hrb02_06->hrb02_06_033 = $hrb02_06_033; //治疗性引产标志 
$ws_hrb02_06->hrb02_06_034 = $hrb02_06_034; //出生缺陷诊断依据类别代码 
$ws_hrb02_06->hrb02_06_035 = $hrb02_06_035; //出生缺陷确诊时间类别代码 
$ws_hrb02_06->hrb02_06_036 = $hrb02_06_036; //出生缺陷类别代码 
$ws_hrb02_06->hrb02_06_037 = $hrb02_06_037; //孕早期患病-标志 
$ws_hrb02_06->hrb02_06_038 = $hrb02_06_038; //孕早期患病-情况 
$ws_hrb02_06->hrb02_06_039 = $hrb02_06_039; //孕早期服药类别代码 
$ws_hrb02_06->hrb02_06_040 = $hrb02_06_040; //药物名称 
$ws_hrb02_06->hrb02_06_041 = $hrb02_06_041; //孕早期接触有害因素-类别代码 
$ws_hrb02_06->hrb02_06_042 = $hrb02_06_042; //孕早期接触有害因素-情况 
$ws_hrb02_06 ->hrb02_06_043 = empty($hrb02_06_043)?null : $ws_hrb02_06 ->escape('hrb02_06_043',to_date($hrb02_06_043,'YYYY-MM-DD')); //填报日期 
$ws_hrb02_06->hrb02_06_044 = $hrb02_06_044; //填报人姓名 
$ws_hrb02_06->hrb02_06_045 = $hrb02_06_045; //填报人职称代码 
$ws_hrb02_06->hrb02_06_046 = $hrb02_06_046; //填报单位名称 
$ws_hrb02_06 ->hrb02_06_047 = empty($hrb02_06_047)?null : $ws_hrb02_06 ->escape('hrb02_06_047',to_date($hrb02_06_047,'YYYY-MM-DD')); //医院审表日期 
$ws_hrb02_06->hrb02_06_048 = $hrb02_06_048; //医院审表人姓名 
$ws_hrb02_06->hrb02_06_049 = $hrb02_06_049; //医院审表人职称代码 
$ws_hrb02_06 ->hrb02_06_050 = empty($hrb02_06_050)?null : $ws_hrb02_06 ->escape('hrb02_06_050',to_date($hrb02_06_050,'YYYY-MM-DD')); //省级审表日期 
$ws_hrb02_06->hrb02_06_051 = $hrb02_06_051; //省级审表人姓名 
$ws_hrb02_06->hrb02_06_052 = $hrb02_06_052; //省级审表人职称代码 
if($ws_hrb02_06 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb02_06 ->free_statement();
}
