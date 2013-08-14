<?php
/**
出生医学证明基本数据集标准HRB01.01出生医学证明基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb01_01_001  出生医学证明编号
* @param string $hrb01_01_002  新生儿姓名
* @param string $hrb01_01_003  新生儿性别代码
* @param dateTime $hrb01_01_004  新生儿出生日期时间
* @param string $hrb01_01_005  出生地
* @param string $hrb01_01_006  地址类别代码
* @param string $hrb01_01_007  行政区划代码
* @param string $hrb01_01_008  地址-省（自治区、直辖市）
* @param string $hrb01_01_009  地址-市（地区）
* @param string $hrb01_01_010  地址-县（区）
* @param string $hrb01_01_011  地址-乡（镇、街道办事处）
* @param string $hrb01_01_012  地址-村（街、路、弄等）
* @param string $hrb01_01_013  地址-门牌号码
* @param string $hrb01_01_014  邮政编码
* @param string $hrb01_01_015  出生地点类别代码
* @param string $hrb01_01_016  新生儿健康状况代码
* @param decimal $hrb01_01_017  出生孕周
* @param decimal $hrb01_01_018  出生身长（cm）
* @param decimal $hrb01_01_019  出生体重（g）
* @param string $hrb01_01_020  母亲姓名
* @param string $hrb01_01_021  母亲国籍代码
* @param string $hrb01_01_022  母亲民族代码
* @param string $hrb01_01_023  母亲身份证件-类别代码
* @param string $hrb01_01_024  母亲身份证件-号码
* @param string $hrb01_01_025  父亲姓名
* @param string $hrb01_01_026  父亲国籍代码
* @param string $hrb01_01_027  父亲民族代码
* @param string $hrb01_01_028  父亲身份证件-类别代码
* @param string $hrb01_01_029  父亲身份证件-号码
* @param string $hrb01_01_030  助产人员姓名
* @param string $hrb01_01_031  助产机构名称
* @param date $hrb01_01_032  签发日期
* @param string $hrb01_01_033  签证机构名称
* @return boolean
*/
function update_hrb01_01($ws_id,$org_id,$doctor_id,$identity_number,$hrb01_01_001='',$hrb01_01_002='',$hrb01_01_003='',$hrb01_01_004='',$hrb01_01_005='',$hrb01_01_006='',$hrb01_01_007='',$hrb01_01_008='',$hrb01_01_009='',$hrb01_01_010='',$hrb01_01_011='',$hrb01_01_012='',$hrb01_01_013='',$hrb01_01_014='',$hrb01_01_015='',$hrb01_01_016='',$hrb01_01_017=0,$hrb01_01_018=0,$hrb01_01_019=0,$hrb01_01_020='',$hrb01_01_021='',$hrb01_01_022='',$hrb01_01_023='',$hrb01_01_024='',$hrb01_01_025='',$hrb01_01_026='',$hrb01_01_027='',$hrb01_01_028='',$hrb01_01_029='',$hrb01_01_030='',$hrb01_01_031='',$hrb01_01_032='',$hrb01_01_033=''){
require_once(__SITEROOT.'library/Models/ws_hrb01_01.php');
$table_obj="Tws_hrb01_01";
$ws_hrb01_01=new $table_obj();
$ws_hrb01_01 -> ws_id=$ws_id;
$ws_hrb01_01 -> uuid=uniqid('',true);
$ws_hrb01_01 -> created=time();
$ws_hrb01_01 -> org_id=$org_id;
$ws_hrb01_01 -> doctor_id=$doctor_id;
$ws_hrb01_01 -> identity_number=$identity_number;//身份证号
$ws_hrb01_01 -> action='insert';
$ws_hrb01_01->hrb01_01_001 = $hrb01_01_001; //出生医学证明编号 
$ws_hrb01_01->hrb01_01_002 = $hrb01_01_002; //新生儿姓名 
$ws_hrb01_01->hrb01_01_003 = $hrb01_01_003; //新生儿性别代码 
$ws_hrb01_01 ->hrb01_01_004 = empty($hrb01_01_004)?null : $ws_hrb01_01 ->escape('hrb01_01_004',to_date($hrb01_01_004,'YYYY-MM-DD')); //新生儿出生日期时间 
$ws_hrb01_01->hrb01_01_005 = $hrb01_01_005; //出生地 
$ws_hrb01_01->hrb01_01_006 = $hrb01_01_006; //地址类别代码 
$ws_hrb01_01->hrb01_01_007 = $hrb01_01_007; //行政区划代码 
$ws_hrb01_01->hrb01_01_008 = $hrb01_01_008; //地址-省（自治区、直辖市） 
$ws_hrb01_01->hrb01_01_009 = $hrb01_01_009; //地址-市（地区） 
$ws_hrb01_01->hrb01_01_010 = $hrb01_01_010; //地址-县（区） 
$ws_hrb01_01->hrb01_01_011 = $hrb01_01_011; //地址-乡（镇、街道办事处） 
$ws_hrb01_01->hrb01_01_012 = $hrb01_01_012; //地址-村（街、路、弄等） 
$ws_hrb01_01->hrb01_01_013 = $hrb01_01_013; //地址-门牌号码 
$ws_hrb01_01->hrb01_01_014 = $hrb01_01_014; //邮政编码 
$ws_hrb01_01->hrb01_01_015 = $hrb01_01_015; //出生地点类别代码 
$ws_hrb01_01->hrb01_01_016 = $hrb01_01_016; //新生儿健康状况代码 
$ws_hrb01_01->hrb01_01_017 = $hrb01_01_017; //出生孕周 
$ws_hrb01_01->hrb01_01_018 = $hrb01_01_018; //出生身长（cm） 
$ws_hrb01_01->hrb01_01_019 = $hrb01_01_019; //出生体重（g） 
$ws_hrb01_01->hrb01_01_020 = $hrb01_01_020; //母亲姓名 
$ws_hrb01_01->hrb01_01_021 = $hrb01_01_021; //母亲国籍代码 
$ws_hrb01_01->hrb01_01_022 = $hrb01_01_022; //母亲民族代码 
$ws_hrb01_01->hrb01_01_023 = $hrb01_01_023; //母亲身份证件-类别代码 
$ws_hrb01_01->hrb01_01_024 = $hrb01_01_024; //母亲身份证件-号码 
$ws_hrb01_01->hrb01_01_025 = $hrb01_01_025; //父亲姓名 
$ws_hrb01_01->hrb01_01_026 = $hrb01_01_026; //父亲国籍代码 
$ws_hrb01_01->hrb01_01_027 = $hrb01_01_027; //父亲民族代码 
$ws_hrb01_01->hrb01_01_028 = $hrb01_01_028; //父亲身份证件-类别代码 
$ws_hrb01_01->hrb01_01_029 = $hrb01_01_029; //父亲身份证件-号码 
$ws_hrb01_01->hrb01_01_030 = $hrb01_01_030; //助产人员姓名 
$ws_hrb01_01->hrb01_01_031 = $hrb01_01_031; //助产机构名称 
$ws_hrb01_01 ->hrb01_01_032 = empty($hrb01_01_032)?null : $ws_hrb01_01 ->escape('hrb01_01_032',to_date($hrb01_01_032,'YYYY-MM-DD')); //签发日期 
$ws_hrb01_01->hrb01_01_033 = $hrb01_01_033; //签证机构名称 
if($ws_hrb01_01 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb01_01 ->free_statement();
}
