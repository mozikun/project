<?php
/**
行为危险因素监测基本数据集标准HRB03.11行为危险因素监测基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb03_11_001  姓名
* @param string $hrb03_11_002  性别代码
* @param date $hrb03_11_003  出生日期
* @param string $hrb03_11_004  职业类别代码(国标)
* @param string $hrb03_11_005  地址类别代码
* @param string $hrb03_11_006  地址-省（自治区、直辖市）
* @param string $hrb03_11_007  地址-市（地区）
* @param string $hrb03_11_008  地址-县（区）
* @param string $hrb03_11_009  地址-乡（镇、街道办事处）
* @param string $hrb03_11_010  地址-村（街、路、弄等）
* @param string $hrb03_11_011  地址-门牌号码
* @param string $hrb03_11_012  民族代码
* @param string $hrb03_11_013  婚姻状况类别代码
* @param string $hrb03_11_014  文化程度代码
* @param string $hrb03_11_015  吸烟频率代码
* @param decimal $hrb03_11_016  开始每天吸烟年龄（岁）
* @param decimal $hrb03_11_017  开始吸烟年龄(岁)
* @param string $hrb03_11_018  吸食烟草种类代码
* @param decimal $hrb03_11_019  日吸烟量(支)
* @param decimal $hrb03_11_020  停止吸烟时长（d）
* @param string $hrb03_11_021  戒烟方法类别代码
* @param string $hrb03_11_022  接触二手烟代码
* @param decimal $hrb03_11_023  接触二手烟天数（d）
* @param string $hrb03_11_024  被动吸烟场所类别代码
* @param string $hrb03_11_025  饮酒频率代码
* @param string $hrb03_11_026  饮酒种类代码
* @param decimal $hrb03_11_027  日饮酒量(两)
* @param boolean $hrb03_11_028  饮酒标志
* @param decimal $hrb03_11_029  开始饮酒年龄(岁)
* @param string $hrb03_11_030  饮食种类代码
* @param decimal $hrb03_11_031  饮食频率（次/天）
* @param string $hrb03_11_032  身体活动类别代码
* @param string $hrb03_11_033  身体活动强度分类代码
* @param string $hrb03_11_034  身体活动频率代码
* @param decimal $hrb03_11_035  步行或骑自行车累计时长（min）
* @param decimal $hrb03_11_036  日静态行为时长（min）
* @param decimal $hrb03_11_037  中午及其他时间睡眠时长（min）
* @param decimal $hrb03_11_038  晚上睡眠时长（min）
* @return boolean
*/
function update_hrb03_11($ws_id,$org_id,$doctor_id,$identity_number,$hrb03_11_001='',$hrb03_11_002='',$hrb03_11_003='',$hrb03_11_004='',$hrb03_11_005='',$hrb03_11_006='',$hrb03_11_007='',$hrb03_11_008='',$hrb03_11_009='',$hrb03_11_010='',$hrb03_11_011='',$hrb03_11_012='',$hrb03_11_013='',$hrb03_11_014='',$hrb03_11_015='',$hrb03_11_016=0,$hrb03_11_017=0,$hrb03_11_018='',$hrb03_11_019=0,$hrb03_11_020=0,$hrb03_11_021='',$hrb03_11_022='',$hrb03_11_023=0,$hrb03_11_024='',$hrb03_11_025='',$hrb03_11_026='',$hrb03_11_027=0,$hrb03_11_028=false,$hrb03_11_029=0,$hrb03_11_030='',$hrb03_11_031=0,$hrb03_11_032='',$hrb03_11_033='',$hrb03_11_034='',$hrb03_11_035=0,$hrb03_11_036=0,$hrb03_11_037=0,$hrb03_11_038=0){
require_once(__SITEROOT.'library/Models/ws_hrb03_11.php');
$table_obj="Tws_hrb03_11";
$ws_hrb03_11=new $table_obj();
$ws_hrb03_11 -> ws_id=$ws_id;
$ws_hrb03_11 -> uuid=uniqid('',true);
$ws_hrb03_11 -> created=time();
$ws_hrb03_11 -> org_id=$org_id;
$ws_hrb03_11 -> doctor_id=$doctor_id;
$ws_hrb03_11 -> identity_number=$identity_number;//身份证号
$ws_hrb03_11 -> action='insert';
$ws_hrb03_11->hrb03_11_001 = $hrb03_11_001; //姓名 
$ws_hrb03_11->hrb03_11_002 = $hrb03_11_002; //性别代码 
$ws_hrb03_11 ->hrb03_11_003 = empty($hrb03_11_003)?null : $ws_hrb03_11 ->escape('hrb03_11_003',to_date($hrb03_11_003,'YYYY-MM-DD')); //出生日期 
$ws_hrb03_11->hrb03_11_004 = $hrb03_11_004; //职业类别代码(国标) 
$ws_hrb03_11->hrb03_11_005 = $hrb03_11_005; //地址类别代码 
$ws_hrb03_11->hrb03_11_006 = $hrb03_11_006; //地址-省（自治区、直辖市） 
$ws_hrb03_11->hrb03_11_007 = $hrb03_11_007; //地址-市（地区） 
$ws_hrb03_11->hrb03_11_008 = $hrb03_11_008; //地址-县（区） 
$ws_hrb03_11->hrb03_11_009 = $hrb03_11_009; //地址-乡（镇、街道办事处） 
$ws_hrb03_11->hrb03_11_010 = $hrb03_11_010; //地址-村（街、路、弄等） 
$ws_hrb03_11->hrb03_11_011 = $hrb03_11_011; //地址-门牌号码 
$ws_hrb03_11->hrb03_11_012 = $hrb03_11_012; //民族代码 
$ws_hrb03_11->hrb03_11_013 = $hrb03_11_013; //婚姻状况类别代码 
$ws_hrb03_11->hrb03_11_014 = $hrb03_11_014; //文化程度代码 
$ws_hrb03_11->hrb03_11_015 = $hrb03_11_015; //吸烟频率代码 
$ws_hrb03_11->hrb03_11_016 = $hrb03_11_016; //开始每天吸烟年龄（岁） 
$ws_hrb03_11->hrb03_11_017 = $hrb03_11_017; //开始吸烟年龄(岁) 
$ws_hrb03_11->hrb03_11_018 = $hrb03_11_018; //吸食烟草种类代码 
$ws_hrb03_11->hrb03_11_019 = $hrb03_11_019; //日吸烟量(支) 
$ws_hrb03_11->hrb03_11_020 = $hrb03_11_020; //停止吸烟时长（d） 
$ws_hrb03_11->hrb03_11_021 = $hrb03_11_021; //戒烟方法类别代码 
$ws_hrb03_11->hrb03_11_022 = $hrb03_11_022; //接触二手烟代码 
$ws_hrb03_11->hrb03_11_023 = $hrb03_11_023; //接触二手烟天数（d） 
$ws_hrb03_11->hrb03_11_024 = $hrb03_11_024; //被动吸烟场所类别代码 
$ws_hrb03_11->hrb03_11_025 = $hrb03_11_025; //饮酒频率代码 
$ws_hrb03_11->hrb03_11_026 = $hrb03_11_026; //饮酒种类代码 
$ws_hrb03_11->hrb03_11_027 = $hrb03_11_027; //日饮酒量(两) 
$ws_hrb03_11->hrb03_11_028 = $hrb03_11_028; //饮酒标志 
$ws_hrb03_11->hrb03_11_029 = $hrb03_11_029; //开始饮酒年龄(岁) 
$ws_hrb03_11->hrb03_11_030 = $hrb03_11_030; //饮食种类代码 
$ws_hrb03_11->hrb03_11_031 = $hrb03_11_031; //饮食频率（次/天） 
$ws_hrb03_11->hrb03_11_032 = $hrb03_11_032; //身体活动类别代码 
$ws_hrb03_11->hrb03_11_033 = $hrb03_11_033; //身体活动强度分类代码 
$ws_hrb03_11->hrb03_11_034 = $hrb03_11_034; //身体活动频率代码 
$ws_hrb03_11->hrb03_11_035 = $hrb03_11_035; //步行或骑自行车累计时长（min） 
$ws_hrb03_11->hrb03_11_036 = $hrb03_11_036; //日静态行为时长（min） 
$ws_hrb03_11->hrb03_11_037 = $hrb03_11_037; //中午及其他时间睡眠时长（min） 
$ws_hrb03_11->hrb03_11_038 = $hrb03_11_038; //晚上睡眠时长（min） 
if($ws_hrb03_11 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb03_11 ->free_statement();
}
