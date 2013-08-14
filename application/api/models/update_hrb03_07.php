<?php
/**
职业病报告基本数据集标准HRB03.07职业病报告基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb03_07_001  报告卡编码
* @param string $hrb03_07_002  姓名
* @param string $hrb03_07_003  性别代码
* @param date $hrb03_07_004  出生日期
* @param string $hrb03_07_005  身份证件-类别代码
* @param string $hrb03_07_006  身份证件-号码
* @param string $hrb03_07_007  地址类别代码
* @param string $hrb03_07_008  行政区划代码
* @param string $hrb03_07_009  地址-省（自治区、直辖市）
* @param string $hrb03_07_010  地址-市（地区）
* @param string $hrb03_07_011  地址-县（区）
* @param string $hrb03_07_012  地址-乡（镇、街道办事处）
* @param string $hrb03_07_013  地址-村（街、路、弄等）
* @param string $hrb03_07_014  地址-门牌号码
* @param string $hrb03_07_015  邮政编码
* @param string $hrb03_07_016  联系电话-类别
* @param string $hrb03_07_017  联系电话-类别代码
* @param string $hrb03_07_018  联系电话-号码
* @param string $hrb03_07_019  文化程度代码
* @param string $hrb03_07_020  工作单位名称
* @param string $hrb03_07_021  统计工种
* @param string $hrb03_07_022  受照史
* @param string $hrb03_07_023  职业照射种类代码
* @param date $hrb03_07_024  开始从事放射工作日期
* @param date $hrb03_07_025  开始接尘日期
* @param decimal $hrb03_07_026  实际接害工龄（年）
* @param decimal $hrb03_07_027  放射工龄（年）
* @param decimal $hrb03_07_028  累积受照时长（小时/年）
* @param date $hrb03_07_029  受照日期
* @param date $hrb03_07_030  首次出现症状日期
* @param decimal $hrb03_07_031  受照剂量（Gy）
* @param string $hrb03_07_032  受照类型代码
* @param string $hrb03_07_033  受照原因代码
* @param string $hrb03_07_034  职业病种类代码
* @param string $hrb03_07_035  尘肺类别代码
* @param string $hrb03_07_036  尘肺期别代码
* @param string $hrb03_07_037  职业病名称代码
* @param string $hrb03_07_038  职业病伤残等级代码
* @param string $hrb03_07_039  职业病转归代码
* @param string $hrb03_07_040  职业性放射性疾病代码
* @param string $hrb03_07_041  放射性疾病的分度代码
* @param string $hrb03_07_042  放射性疾病的分期代码
* @param boolean $hrb03_07_043  尘肺合并肺结核的标志
* @param string $hrb03_07_044  职业性放射性疾病处理类别代码
* @param dateTime $hrb03_07_045  死亡日期时间
* @param string $hrb03_07_046  根本死因代码
* @param string $hrb03_07_047  诊断机构名称
* @param date $hrb03_07_048  诊断日期
* @param string $hrb03_07_049  诊断医师姓名
* @return boolean
*/
function update_hrb03_07($ws_id,$org_id,$doctor_id,$identity_number,$hrb03_07_001='',$hrb03_07_002='',$hrb03_07_003='',$hrb03_07_004='',$hrb03_07_005='',$hrb03_07_006='',$hrb03_07_007='',$hrb03_07_008='',$hrb03_07_009='',$hrb03_07_010='',$hrb03_07_011='',$hrb03_07_012='',$hrb03_07_013='',$hrb03_07_014='',$hrb03_07_015='',$hrb03_07_016='',$hrb03_07_017='',$hrb03_07_018='',$hrb03_07_019='',$hrb03_07_020='',$hrb03_07_021='',$hrb03_07_022='',$hrb03_07_023='',$hrb03_07_024='',$hrb03_07_025='',$hrb03_07_026=0,$hrb03_07_027=0,$hrb03_07_028=0,$hrb03_07_029='',$hrb03_07_030='',$hrb03_07_031=0,$hrb03_07_032='',$hrb03_07_033='',$hrb03_07_034='',$hrb03_07_035='',$hrb03_07_036='',$hrb03_07_037='',$hrb03_07_038='',$hrb03_07_039='',$hrb03_07_040='',$hrb03_07_041='',$hrb03_07_042='',$hrb03_07_043=false,$hrb03_07_044='',$hrb03_07_045='',$hrb03_07_046='',$hrb03_07_047='',$hrb03_07_048='',$hrb03_07_049=''){
require_once(__SITEROOT.'library/Models/ws_hrb03_07.php');
$table_obj="Tws_hrb03_07";
$ws_hrb03_07=new $table_obj();
$ws_hrb03_07 -> ws_id=$ws_id;
$ws_hrb03_07 -> uuid=uniqid('',true);
$ws_hrb03_07 -> created=time();
$ws_hrb03_07 -> org_id=$org_id;
$ws_hrb03_07 -> doctor_id=$doctor_id;
$ws_hrb03_07 -> identity_number=$identity_number;//身份证号
$ws_hrb03_07 -> action='insert';
$ws_hrb03_07->hrb03_07_001 = $hrb03_07_001; //报告卡编码 
$ws_hrb03_07->hrb03_07_002 = $hrb03_07_002; //姓名 
$ws_hrb03_07->hrb03_07_003 = $hrb03_07_003; //性别代码 
$ws_hrb03_07 ->hrb03_07_004 = empty($hrb03_07_004)?null : $ws_hrb03_07 ->escape('hrb03_07_004',to_date($hrb03_07_004,'YYYY-MM-DD')); //出生日期 
$ws_hrb03_07->hrb03_07_005 = $hrb03_07_005; //身份证件-类别代码 
$ws_hrb03_07->hrb03_07_006 = $hrb03_07_006; //身份证件-号码 
$ws_hrb03_07->hrb03_07_007 = $hrb03_07_007; //地址类别代码 
$ws_hrb03_07->hrb03_07_008 = $hrb03_07_008; //行政区划代码 
$ws_hrb03_07->hrb03_07_009 = $hrb03_07_009; //地址-省（自治区、直辖市） 
$ws_hrb03_07->hrb03_07_010 = $hrb03_07_010; //地址-市（地区） 
$ws_hrb03_07->hrb03_07_011 = $hrb03_07_011; //地址-县（区） 
$ws_hrb03_07->hrb03_07_012 = $hrb03_07_012; //地址-乡（镇、街道办事处） 
$ws_hrb03_07->hrb03_07_013 = $hrb03_07_013; //地址-村（街、路、弄等） 
$ws_hrb03_07->hrb03_07_014 = $hrb03_07_014; //地址-门牌号码 
$ws_hrb03_07->hrb03_07_015 = $hrb03_07_015; //邮政编码 
$ws_hrb03_07->hrb03_07_016 = $hrb03_07_016; //联系电话-类别 
$ws_hrb03_07->hrb03_07_017 = $hrb03_07_017; //联系电话-类别代码 
$ws_hrb03_07->hrb03_07_018 = $hrb03_07_018; //联系电话-号码 
$ws_hrb03_07->hrb03_07_019 = $hrb03_07_019; //文化程度代码 
$ws_hrb03_07->hrb03_07_020 = $hrb03_07_020; //工作单位名称 
$ws_hrb03_07->hrb03_07_021 = $hrb03_07_021; //统计工种 
$ws_hrb03_07->hrb03_07_022 = $hrb03_07_022; //受照史 
$ws_hrb03_07->hrb03_07_023 = $hrb03_07_023; //职业照射种类代码 
$ws_hrb03_07 ->hrb03_07_024 = empty($hrb03_07_024)?null : $ws_hrb03_07 ->escape('hrb03_07_024',to_date($hrb03_07_024,'YYYY-MM-DD')); //开始从事放射工作日期 
$ws_hrb03_07 ->hrb03_07_025 = empty($hrb03_07_025)?null : $ws_hrb03_07 ->escape('hrb03_07_025',to_date($hrb03_07_025,'YYYY-MM-DD')); //开始接尘日期 
$ws_hrb03_07->hrb03_07_026 = $hrb03_07_026; //实际接害工龄（年） 
$ws_hrb03_07->hrb03_07_027 = $hrb03_07_027; //放射工龄（年） 
$ws_hrb03_07->hrb03_07_028 = $hrb03_07_028; //累积受照时长（小时/年） 
$ws_hrb03_07 ->hrb03_07_029 = empty($hrb03_07_029)?null : $ws_hrb03_07 ->escape('hrb03_07_029',to_date($hrb03_07_029,'YYYY-MM-DD')); //受照日期 
$ws_hrb03_07 ->hrb03_07_030 = empty($hrb03_07_030)?null : $ws_hrb03_07 ->escape('hrb03_07_030',to_date($hrb03_07_030,'YYYY-MM-DD')); //首次出现症状日期 
$ws_hrb03_07->hrb03_07_031 = $hrb03_07_031; //受照剂量（Gy） 
$ws_hrb03_07->hrb03_07_032 = $hrb03_07_032; //受照类型代码 
$ws_hrb03_07->hrb03_07_033 = $hrb03_07_033; //受照原因代码 
$ws_hrb03_07->hrb03_07_034 = $hrb03_07_034; //职业病种类代码 
$ws_hrb03_07->hrb03_07_035 = $hrb03_07_035; //尘肺类别代码 
$ws_hrb03_07->hrb03_07_036 = $hrb03_07_036; //尘肺期别代码 
$ws_hrb03_07->hrb03_07_037 = $hrb03_07_037; //职业病名称代码 
$ws_hrb03_07->hrb03_07_038 = $hrb03_07_038; //职业病伤残等级代码 
$ws_hrb03_07->hrb03_07_039 = $hrb03_07_039; //职业病转归代码 
$ws_hrb03_07->hrb03_07_040 = $hrb03_07_040; //职业性放射性疾病代码 
$ws_hrb03_07->hrb03_07_041 = $hrb03_07_041; //放射性疾病的分度代码 
$ws_hrb03_07->hrb03_07_042 = $hrb03_07_042; //放射性疾病的分期代码 
$ws_hrb03_07->hrb03_07_043 = $hrb03_07_043; //尘肺合并肺结核的标志 
$ws_hrb03_07->hrb03_07_044 = $hrb03_07_044; //职业性放射性疾病处理类别代码 
$ws_hrb03_07 ->hrb03_07_045 = empty($hrb03_07_045)?null : $ws_hrb03_07 ->escape('hrb03_07_045',to_date($hrb03_07_045,'YYYY-MM-DD')); //死亡日期时间 
$ws_hrb03_07->hrb03_07_046 = $hrb03_07_046; //根本死因代码 
$ws_hrb03_07->hrb03_07_047 = $hrb03_07_047; //诊断机构名称 
$ws_hrb03_07 ->hrb03_07_048 = empty($hrb03_07_048)?null : $ws_hrb03_07 ->escape('hrb03_07_048',to_date($hrb03_07_048,'YYYY-MM-DD')); //诊断日期 
$ws_hrb03_07->hrb03_07_049 = $hrb03_07_049; //诊断医师姓名 
if($ws_hrb03_07 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb03_07 ->free_statement();
}
