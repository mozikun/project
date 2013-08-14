<?php
/**
慢性丝虫病病人管理基本数据集标准HRB03.06慢性丝虫病病人管理基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb03_06_001  记录表单编号
* @param string $hrb03_06_002  姓名
* @param string $hrb03_06_003  性别代码
* @param date $hrb03_06_004  出生日期
* @param string $hrb03_06_005  身份证件-类别代码
* @param string $hrb03_06_006  身份证件-号码
* @param string $hrb03_06_007  地址类别代码
* @param string $hrb03_06_008  地址-省（自治区、直辖市）
* @param string $hrb03_06_009  地址-市（地区）
* @param string $hrb03_06_010  地址-县（区）
* @param string $hrb03_06_011  地址-乡（镇、街道办事处）
* @param string $hrb03_06_012  地址-村（街、路、弄等）
* @param string $hrb03_06_013  地址-门牌号码
* @param string $hrb03_06_014  邮政编码
* @param date $hrb03_06_015  建档日期
* @param date $hrb03_06_016  随访日期
* @param decimal $hrb03_06_017  年度随访第次
* @param decimal $hrb03_06_018  收缩压(mmHg)
* @param decimal $hrb03_06_019  舒张压(mmHg)
* @param decimal $hrb03_06_020  脉率（次/分钟）
* @param decimal $hrb03_06_021  体温（℃）
* @param string $hrb03_06_022  慢性丝虫病病人建档症状代码
* @param string $hrb03_06_023  慢性丝虫病症状发作部位代码
* @param decimal $hrb03_06_024  慢性丝虫病症状发作次数
* @param date $hrb03_06_025  慢性丝虫病症状发作开始日期
* @param decimal $hrb03_06_026  慢性丝虫病症状发作持续天数（d） 
* @param boolean $hrb03_06_027  皮肤粗糙标志
* @param boolean $hrb03_06_028  皮肤苔藓样变标志
* @param boolean $hrb03_06_029  凹陷性水肿标志
* @param boolean $hrb03_06_030  溃疡标志
* @param boolean $hrb03_06_031  患肢畸形标志
* @param decimal $hrb03_06_032  下肢淋巴水肿分期
* @param string $hrb03_06_033  慢性丝虫病病人照料形式代码
* @param boolean $hrb03_06_034  患肢清洗标志
* @param boolean $hrb03_06_035  外用药物防止感染标志
* @param boolean $hrb03_06_036  患肢抬高标志
* @param boolean $hrb03_06_037  患肢锻炼标志
* @param string $hrb03_06_038  淋巴管／结炎发作特点代码
* @param boolean $hrb03_06_039  淋巴管／结炎发作伴随高热寒战标志
* @param string $hrb03_06_040  乳糜尿发作规律特点代码
* @param string $hrb03_06_041  乳糜尿发作诱因代码
* @param boolean $hrb03_06_042  低脂高蛋白饮食标志
* @param string $hrb03_06_043  每日饮水量代码（ml）
* @param string $hrb03_06_044  劳作情况代码
* @param boolean $hrb03_06_045  登高和剧烈运动标志
* @param string $hrb03_06_046  尿液外观
* @param boolean $hrb03_06_047  排尿困难标志
* @param boolean $hrb03_06_048  乳糜试验结果
* @param string $hrb03_06_049  鞘膜积液-累及部位代码
* @param decimal $hrb03_06_050  鞘膜积液-测量值（cm）
* @param boolean $hrb03_06_051  压痛试验标志
* @param boolean $hrb03_06_052  透光试验标志
* @param string $hrb03_06_053  自理能力代码
* @param string $hrb03_06_054  治疗情况代码
* @param string $hrb03_06_055  慢性丝虫病转归代码
* @param string $hrb03_06_056  根本死因代码
* @param string $hrb03_06_057  填报人姓名
* @param date $hrb03_06_058  填报日期
* @return boolean
*/
function update_hrb03_06($ws_id,$org_id,$doctor_id,$identity_number,$hrb03_06_001='',$hrb03_06_002='',$hrb03_06_003='',$hrb03_06_004='',$hrb03_06_005='',$hrb03_06_006='',$hrb03_06_007='',$hrb03_06_008='',$hrb03_06_009='',$hrb03_06_010='',$hrb03_06_011='',$hrb03_06_012='',$hrb03_06_013='',$hrb03_06_014='',$hrb03_06_015='',$hrb03_06_016='',$hrb03_06_017=0,$hrb03_06_018=0,$hrb03_06_019=0,$hrb03_06_020=0,$hrb03_06_021=0,$hrb03_06_022='',$hrb03_06_023='',$hrb03_06_024=0,$hrb03_06_025='',$hrb03_06_026=0,$hrb03_06_027=false,$hrb03_06_028=false,$hrb03_06_029=false,$hrb03_06_030=false,$hrb03_06_031=false,$hrb03_06_032=0,$hrb03_06_033='',$hrb03_06_034=false,$hrb03_06_035=false,$hrb03_06_036=false,$hrb03_06_037=false,$hrb03_06_038='',$hrb03_06_039=false,$hrb03_06_040='',$hrb03_06_041='',$hrb03_06_042=false,$hrb03_06_043='',$hrb03_06_044='',$hrb03_06_045=false,$hrb03_06_046='',$hrb03_06_047=false,$hrb03_06_048=false,$hrb03_06_049='',$hrb03_06_050=0,$hrb03_06_051=false,$hrb03_06_052=false,$hrb03_06_053='',$hrb03_06_054='',$hrb03_06_055='',$hrb03_06_056='',$hrb03_06_057='',$hrb03_06_058=''){
require_once(__SITEROOT.'library/Models/ws_hrb03_06.php');
$table_obj="Tws_hrb03_06";
$ws_hrb03_06=new $table_obj();
$ws_hrb03_06 -> ws_id=$ws_id;
$ws_hrb03_06 -> uuid=uniqid('',true);
$ws_hrb03_06 -> created=time();
$ws_hrb03_06 -> org_id=$org_id;
$ws_hrb03_06 -> doctor_id=$doctor_id;
$ws_hrb03_06 -> identity_number=$identity_number;//身份证号
$ws_hrb03_06 -> action='insert';
$ws_hrb03_06->hrb03_06_001 = $hrb03_06_001; //记录表单编号 
$ws_hrb03_06->hrb03_06_002 = $hrb03_06_002; //姓名 
$ws_hrb03_06->hrb03_06_003 = $hrb03_06_003; //性别代码 
$ws_hrb03_06 ->hrb03_06_004 = empty($hrb03_06_004)?null : $ws_hrb03_06 ->escape('hrb03_06_004',to_date($hrb03_06_004,'YYYY-MM-DD')); //出生日期 
$ws_hrb03_06->hrb03_06_005 = $hrb03_06_005; //身份证件-类别代码 
$ws_hrb03_06->hrb03_06_006 = $hrb03_06_006; //身份证件-号码 
$ws_hrb03_06->hrb03_06_007 = $hrb03_06_007; //地址类别代码 
$ws_hrb03_06->hrb03_06_008 = $hrb03_06_008; //地址-省（自治区、直辖市） 
$ws_hrb03_06->hrb03_06_009 = $hrb03_06_009; //地址-市（地区） 
$ws_hrb03_06->hrb03_06_010 = $hrb03_06_010; //地址-县（区） 
$ws_hrb03_06->hrb03_06_011 = $hrb03_06_011; //地址-乡（镇、街道办事处） 
$ws_hrb03_06->hrb03_06_012 = $hrb03_06_012; //地址-村（街、路、弄等） 
$ws_hrb03_06->hrb03_06_013 = $hrb03_06_013; //地址-门牌号码 
$ws_hrb03_06->hrb03_06_014 = $hrb03_06_014; //邮政编码 
$ws_hrb03_06 ->hrb03_06_015 = empty($hrb03_06_015)?null : $ws_hrb03_06 ->escape('hrb03_06_015',to_date($hrb03_06_015,'YYYY-MM-DD')); //建档日期 
$ws_hrb03_06 ->hrb03_06_016 = empty($hrb03_06_016)?null : $ws_hrb03_06 ->escape('hrb03_06_016',to_date($hrb03_06_016,'YYYY-MM-DD')); //随访日期 
$ws_hrb03_06->hrb03_06_017 = $hrb03_06_017; //年度随访第次 
$ws_hrb03_06->hrb03_06_018 = $hrb03_06_018; //收缩压(mmHg) 
$ws_hrb03_06->hrb03_06_019 = $hrb03_06_019; //舒张压(mmHg) 
$ws_hrb03_06->hrb03_06_020 = $hrb03_06_020; //脉率（次/分钟） 
$ws_hrb03_06->hrb03_06_021 = $hrb03_06_021; //体温（℃） 
$ws_hrb03_06->hrb03_06_022 = $hrb03_06_022; //慢性丝虫病病人建档症状代码 
$ws_hrb03_06->hrb03_06_023 = $hrb03_06_023; //慢性丝虫病症状发作部位代码 
$ws_hrb03_06->hrb03_06_024 = $hrb03_06_024; //慢性丝虫病症状发作次数 
$ws_hrb03_06 ->hrb03_06_025 = empty($hrb03_06_025)?null : $ws_hrb03_06 ->escape('hrb03_06_025',to_date($hrb03_06_025,'YYYY-MM-DD')); //慢性丝虫病症状发作开始日期 
$ws_hrb03_06->hrb03_06_026 = $hrb03_06_026; //慢性丝虫病症状发作持续天数（d）  
$ws_hrb03_06->hrb03_06_027 = $hrb03_06_027; //皮肤粗糙标志 
$ws_hrb03_06->hrb03_06_028 = $hrb03_06_028; //皮肤苔藓样变标志 
$ws_hrb03_06->hrb03_06_029 = $hrb03_06_029; //凹陷性水肿标志 
$ws_hrb03_06->hrb03_06_030 = $hrb03_06_030; //溃疡标志 
$ws_hrb03_06->hrb03_06_031 = $hrb03_06_031; //患肢畸形标志 
$ws_hrb03_06->hrb03_06_032 = $hrb03_06_032; //下肢淋巴水肿分期 
$ws_hrb03_06->hrb03_06_033 = $hrb03_06_033; //慢性丝虫病病人照料形式代码 
$ws_hrb03_06->hrb03_06_034 = $hrb03_06_034; //患肢清洗标志 
$ws_hrb03_06->hrb03_06_035 = $hrb03_06_035; //外用药物防止感染标志 
$ws_hrb03_06->hrb03_06_036 = $hrb03_06_036; //患肢抬高标志 
$ws_hrb03_06->hrb03_06_037 = $hrb03_06_037; //患肢锻炼标志 
$ws_hrb03_06->hrb03_06_038 = $hrb03_06_038; //淋巴管／结炎发作特点代码 
$ws_hrb03_06->hrb03_06_039 = $hrb03_06_039; //淋巴管／结炎发作伴随高热寒战标志 
$ws_hrb03_06->hrb03_06_040 = $hrb03_06_040; //乳糜尿发作规律特点代码 
$ws_hrb03_06->hrb03_06_041 = $hrb03_06_041; //乳糜尿发作诱因代码 
$ws_hrb03_06->hrb03_06_042 = $hrb03_06_042; //低脂高蛋白饮食标志 
$ws_hrb03_06->hrb03_06_043 = $hrb03_06_043; //每日饮水量代码（ml） 
$ws_hrb03_06->hrb03_06_044 = $hrb03_06_044; //劳作情况代码 
$ws_hrb03_06->hrb03_06_045 = $hrb03_06_045; //登高和剧烈运动标志 
$ws_hrb03_06->hrb03_06_046 = $hrb03_06_046; //尿液外观 
$ws_hrb03_06->hrb03_06_047 = $hrb03_06_047; //排尿困难标志 
$ws_hrb03_06->hrb03_06_048 = $hrb03_06_048; //乳糜试验结果 
$ws_hrb03_06->hrb03_06_049 = $hrb03_06_049; //鞘膜积液-累及部位代码 
$ws_hrb03_06->hrb03_06_050 = $hrb03_06_050; //鞘膜积液-测量值（cm） 
$ws_hrb03_06->hrb03_06_051 = $hrb03_06_051; //压痛试验标志 
$ws_hrb03_06->hrb03_06_052 = $hrb03_06_052; //透光试验标志 
$ws_hrb03_06->hrb03_06_053 = $hrb03_06_053; //自理能力代码 
$ws_hrb03_06->hrb03_06_054 = $hrb03_06_054; //治疗情况代码 
$ws_hrb03_06->hrb03_06_055 = $hrb03_06_055; //慢性丝虫病转归代码 
$ws_hrb03_06->hrb03_06_056 = $hrb03_06_056; //根本死因代码 
$ws_hrb03_06->hrb03_06_057 = $hrb03_06_057; //填报人姓名 
$ws_hrb03_06 ->hrb03_06_058 = empty($hrb03_06_058)?null : $ws_hrb03_06 ->escape('hrb03_06_058',to_date($hrb03_06_058,'YYYY-MM-DD')); //填报日期 
if($ws_hrb03_06 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb03_06 ->free_statement();
}
