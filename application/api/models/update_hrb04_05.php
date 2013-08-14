<?php
/**
老年人健康管理基本数据集标准HRB04.05老年人健康管理基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb04_05_001  健康档案标识符
* @param string $hrb04_05_002  病案号
* @param string $hrb04_05_003  姓名
* @param string $hrb04_05_004  性别代码
* @param string $hrb04_05_005  身份证件-类别代码
* @param string $hrb04_05_006  身份证件-号码
* @param string $hrb04_05_007  地址类别代码
* @param string $hrb04_05_008  行政区划代码
* @param string $hrb04_05_009  地址-省（自治区、直辖市）
* @param string $hrb04_05_010  地址-市（地区）
* @param string $hrb04_05_011  地址-县（区）
* @param string $hrb04_05_012  地址-乡（镇、街道办事处）
* @param string $hrb04_05_013  地址-村（街、路、弄等）
* @param string $hrb04_05_014  地址-门牌号码
* @param string $hrb04_05_015  邮政编码
* @param string $hrb04_05_016  责任医师姓名
* @param string $hrb04_05_017  随访医师姓名
* @param string $hrb04_05_018  随访方式代码
* @param date $hrb04_05_019  随访日期
* @param string $hrb04_05_020  症状代码(健康检查)
* @param decimal $hrb04_05_021  体重（kg）
* @param decimal $hrb04_05_022  日吸烟量(支)
* @param decimal $hrb04_05_023  日饮酒量(两)
* @param string $hrb04_05_024  随访饮食合理性评价类别代码
* @param string $hrb04_05_025  随访周期建议代码
* @param string $hrb04_05_026  随访遵医行为评价结果代码 
* @param string $hrb04_05_027  随访心理指导-详细描述
* @param boolean $hrb04_05_028  随访心理指导-标志
* @param string $hrb04_05_029  服药依从性代码
* @param string $hrb04_05_030  药物名称
* @param string $hrb04_05_031  药物使用-频率
* @param string $hrb04_05_032  药物使用-剂量单位
* @param decimal $hrb04_05_033  药物使用-次剂量
* @param decimal $hrb04_05_034  药物使用-总剂量
* @param string $hrb04_05_035  药物使用-途径代码
* @param string $hrb04_05_036  检查（测）人员姓名
* @param date $hrb04_05_037  检查（测）日期
* @param string $hrb04_05_038  运动方式说明
* @param string $hrb04_05_039  运动频率类别代码
* @param decimal $hrb04_05_040  运动时间(min)
* @param decimal $hrb04_05_041  坚持运动时长(年)
* @param decimal $hrb04_05_042  周运动次数
* @param string $hrb04_05_043  饮食习惯代码
* @param string $hrb04_05_044  吸烟状况代码
* @param decimal $hrb04_05_045  开始吸烟年龄(岁)
* @param decimal $hrb04_05_046  戒烟年龄(岁)
* @param string $hrb04_05_047  饮酒频率代码
* @param string $hrb04_05_048  饮酒种类代码
* @param decimal $hrb04_05_049  开始饮酒年龄(岁)
* @param boolean $hrb04_05_050  醉酒标志
* @param boolean $hrb04_05_051  戒酒标志
* @param decimal $hrb04_05_052  戒酒年龄(岁)
* @param string $hrb04_05_053  心理状态代码
* @param string $hrb04_05_054  遵医行为
* @param boolean $hrb04_05_055  职业暴露标志
* @param string $hrb04_05_056  职业暴露危险因素名称
* @param string $hrb04_05_057  职业暴露危险因素种类
* @param string $hrb04_05_058  有危害因素的具体职业
* @param decimal $hrb04_05_059  从事有危害因素职业时长(年)
* @param boolean $hrb04_05_060  防护措施标志
* @param boolean $hrb04_05_061  家庭成员吸烟标志
* @param boolean $hrb04_05_062  家中煤火取暖标志
* @param decimal $hrb04_05_063  家中煤火取暖时间(年)
* @param string $hrb04_05_064  常住地址类别代码
* @param string $hrb04_05_065  现存主要健康问题
* @param date $hrb04_05_066  入院日期
* @param string $hrb04_05_067  入院原因
* @param date $hrb04_05_068  出院日期
* @param string $hrb04_05_069  医疗机构名称
* @param date $hrb04_05_070  家庭病床撤床日期
* @param date $hrb04_05_071  家庭病床建床日期
* @param string $hrb04_05_072  家庭病床建立原因
* @param decimal $hrb04_05_073  吸氧时间(h)
* @param string $hrb04_05_074  疫苗-名称代码
* @param string $hrb04_05_075  疫苗-批号
* @param date $hrb04_05_076  疫苗接种日期
* @return boolean
*/
function update_hrb04_05($ws_id,$org_id,$doctor_id,$identity_number,$hrb04_05_001='',$hrb04_05_002='',$hrb04_05_003='',$hrb04_05_004='',$hrb04_05_005='',$hrb04_05_006='',$hrb04_05_007='',$hrb04_05_008='',$hrb04_05_009='',$hrb04_05_010='',$hrb04_05_011='',$hrb04_05_012='',$hrb04_05_013='',$hrb04_05_014='',$hrb04_05_015='',$hrb04_05_016='',$hrb04_05_017='',$hrb04_05_018='',$hrb04_05_019='',$hrb04_05_020='',$hrb04_05_021=0,$hrb04_05_022=0,$hrb04_05_023=0,$hrb04_05_024='',$hrb04_05_025='',$hrb04_05_026='',$hrb04_05_027='',$hrb04_05_028=false,$hrb04_05_029='',$hrb04_05_030='',$hrb04_05_031='',$hrb04_05_032='',$hrb04_05_033=0,$hrb04_05_034=0,$hrb04_05_035='',$hrb04_05_036='',$hrb04_05_037='',$hrb04_05_038='',$hrb04_05_039='',$hrb04_05_040=0,$hrb04_05_041=0,$hrb04_05_042=0,$hrb04_05_043='',$hrb04_05_044='',$hrb04_05_045=0,$hrb04_05_046=0,$hrb04_05_047='',$hrb04_05_048='',$hrb04_05_049=0,$hrb04_05_050=false,$hrb04_05_051=false,$hrb04_05_052=0,$hrb04_05_053='',$hrb04_05_054='',$hrb04_05_055=false,$hrb04_05_056='',$hrb04_05_057='',$hrb04_05_058='',$hrb04_05_059=0,$hrb04_05_060=false,$hrb04_05_061=false,$hrb04_05_062=false,$hrb04_05_063=0,$hrb04_05_064='',$hrb04_05_065='',$hrb04_05_066='',$hrb04_05_067='',$hrb04_05_068='',$hrb04_05_069='',$hrb04_05_070='',$hrb04_05_071='',$hrb04_05_072='',$hrb04_05_073=0,$hrb04_05_074='',$hrb04_05_075='',$hrb04_05_076=''){
require_once(__SITEROOT.'library/Models/ws_hrb04_05.php');
$table_obj="Tws_hrb04_05";
$ws_hrb04_05=new $table_obj();
$ws_hrb04_05 -> ws_id=$ws_id;
$ws_hrb04_05 -> uuid=uniqid('',true);
$ws_hrb04_05 -> created=time();
$ws_hrb04_05 -> org_id=$org_id;
$ws_hrb04_05 -> doctor_id=$doctor_id;
$ws_hrb04_05 -> identity_number=$identity_number;//身份证号
$ws_hrb04_05 -> action='insert';
$ws_hrb04_05->hrb04_05_001 = $hrb04_05_001; //健康档案标识符 
$ws_hrb04_05->hrb04_05_002 = $hrb04_05_002; //病案号 
$ws_hrb04_05->hrb04_05_003 = $hrb04_05_003; //姓名 
$ws_hrb04_05->hrb04_05_004 = $hrb04_05_004; //性别代码 
$ws_hrb04_05->hrb04_05_005 = $hrb04_05_005; //身份证件-类别代码 
$ws_hrb04_05->hrb04_05_006 = $hrb04_05_006; //身份证件-号码 
$ws_hrb04_05->hrb04_05_007 = $hrb04_05_007; //地址类别代码 
$ws_hrb04_05->hrb04_05_008 = $hrb04_05_008; //行政区划代码 
$ws_hrb04_05->hrb04_05_009 = $hrb04_05_009; //地址-省（自治区、直辖市） 
$ws_hrb04_05->hrb04_05_010 = $hrb04_05_010; //地址-市（地区） 
$ws_hrb04_05->hrb04_05_011 = $hrb04_05_011; //地址-县（区） 
$ws_hrb04_05->hrb04_05_012 = $hrb04_05_012; //地址-乡（镇、街道办事处） 
$ws_hrb04_05->hrb04_05_013 = $hrb04_05_013; //地址-村（街、路、弄等） 
$ws_hrb04_05->hrb04_05_014 = $hrb04_05_014; //地址-门牌号码 
$ws_hrb04_05->hrb04_05_015 = $hrb04_05_015; //邮政编码 
$ws_hrb04_05->hrb04_05_016 = $hrb04_05_016; //责任医师姓名 
$ws_hrb04_05->hrb04_05_017 = $hrb04_05_017; //随访医师姓名 
$ws_hrb04_05->hrb04_05_018 = $hrb04_05_018; //随访方式代码 
$ws_hrb04_05 ->hrb04_05_019 = empty($hrb04_05_019)?null : $ws_hrb04_05 ->escape('hrb04_05_019',to_date($hrb04_05_019,'YYYY-MM-DD')); //随访日期 
$ws_hrb04_05->hrb04_05_020 = $hrb04_05_020; //症状代码(健康检查) 
$ws_hrb04_05->hrb04_05_021 = $hrb04_05_021; //体重（kg） 
$ws_hrb04_05->hrb04_05_022 = $hrb04_05_022; //日吸烟量(支) 
$ws_hrb04_05->hrb04_05_023 = $hrb04_05_023; //日饮酒量(两) 
$ws_hrb04_05->hrb04_05_024 = $hrb04_05_024; //随访饮食合理性评价类别代码 
$ws_hrb04_05->hrb04_05_025 = $hrb04_05_025; //随访周期建议代码 
$ws_hrb04_05->hrb04_05_026 = $hrb04_05_026; //随访遵医行为评价结果代码  
$ws_hrb04_05->hrb04_05_027 = $hrb04_05_027; //随访心理指导-详细描述 
$ws_hrb04_05->hrb04_05_028 = $hrb04_05_028; //随访心理指导-标志 
$ws_hrb04_05->hrb04_05_029 = $hrb04_05_029; //服药依从性代码 
$ws_hrb04_05->hrb04_05_030 = $hrb04_05_030; //药物名称 
$ws_hrb04_05->hrb04_05_031 = $hrb04_05_031; //药物使用-频率 
$ws_hrb04_05->hrb04_05_032 = $hrb04_05_032; //药物使用-剂量单位 
$ws_hrb04_05->hrb04_05_033 = $hrb04_05_033; //药物使用-次剂量 
$ws_hrb04_05->hrb04_05_034 = $hrb04_05_034; //药物使用-总剂量 
$ws_hrb04_05->hrb04_05_035 = $hrb04_05_035; //药物使用-途径代码 
$ws_hrb04_05->hrb04_05_036 = $hrb04_05_036; //检查（测）人员姓名 
$ws_hrb04_05 ->hrb04_05_037 = empty($hrb04_05_037)?null : $ws_hrb04_05 ->escape('hrb04_05_037',to_date($hrb04_05_037,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrb04_05->hrb04_05_038 = $hrb04_05_038; //运动方式说明 
$ws_hrb04_05->hrb04_05_039 = $hrb04_05_039; //运动频率类别代码 
$ws_hrb04_05->hrb04_05_040 = $hrb04_05_040; //运动时间(min) 
$ws_hrb04_05->hrb04_05_041 = $hrb04_05_041; //坚持运动时长(年) 
$ws_hrb04_05->hrb04_05_042 = $hrb04_05_042; //周运动次数 
$ws_hrb04_05->hrb04_05_043 = $hrb04_05_043; //饮食习惯代码 
$ws_hrb04_05->hrb04_05_044 = $hrb04_05_044; //吸烟状况代码 
$ws_hrb04_05->hrb04_05_045 = $hrb04_05_045; //开始吸烟年龄(岁) 
$ws_hrb04_05->hrb04_05_046 = $hrb04_05_046; //戒烟年龄(岁) 
$ws_hrb04_05->hrb04_05_047 = $hrb04_05_047; //饮酒频率代码 
$ws_hrb04_05->hrb04_05_048 = $hrb04_05_048; //饮酒种类代码 
$ws_hrb04_05->hrb04_05_049 = $hrb04_05_049; //开始饮酒年龄(岁) 
$ws_hrb04_05->hrb04_05_050 = $hrb04_05_050; //醉酒标志 
$ws_hrb04_05->hrb04_05_051 = $hrb04_05_051; //戒酒标志 
$ws_hrb04_05->hrb04_05_052 = $hrb04_05_052; //戒酒年龄(岁) 
$ws_hrb04_05->hrb04_05_053 = $hrb04_05_053; //心理状态代码 
$ws_hrb04_05->hrb04_05_054 = $hrb04_05_054; //遵医行为 
$ws_hrb04_05->hrb04_05_055 = $hrb04_05_055; //职业暴露标志 
$ws_hrb04_05->hrb04_05_056 = $hrb04_05_056; //职业暴露危险因素名称 
$ws_hrb04_05->hrb04_05_057 = $hrb04_05_057; //职业暴露危险因素种类 
$ws_hrb04_05->hrb04_05_058 = $hrb04_05_058; //有危害因素的具体职业 
$ws_hrb04_05->hrb04_05_059 = $hrb04_05_059; //从事有危害因素职业时长(年) 
$ws_hrb04_05->hrb04_05_060 = $hrb04_05_060; //防护措施标志 
$ws_hrb04_05->hrb04_05_061 = $hrb04_05_061; //家庭成员吸烟标志 
$ws_hrb04_05->hrb04_05_062 = $hrb04_05_062; //家中煤火取暖标志 
$ws_hrb04_05->hrb04_05_063 = $hrb04_05_063; //家中煤火取暖时间(年) 
$ws_hrb04_05->hrb04_05_064 = $hrb04_05_064; //常住地址类别代码 
$ws_hrb04_05->hrb04_05_065 = $hrb04_05_065; //现存主要健康问题 
$ws_hrb04_05 ->hrb04_05_066 = empty($hrb04_05_066)?null : $ws_hrb04_05 ->escape('hrb04_05_066',to_date($hrb04_05_066,'YYYY-MM-DD')); //入院日期 
$ws_hrb04_05->hrb04_05_067 = $hrb04_05_067; //入院原因 
$ws_hrb04_05 ->hrb04_05_068 = empty($hrb04_05_068)?null : $ws_hrb04_05 ->escape('hrb04_05_068',to_date($hrb04_05_068,'YYYY-MM-DD')); //出院日期 
$ws_hrb04_05->hrb04_05_069 = $hrb04_05_069; //医疗机构名称 
$ws_hrb04_05 ->hrb04_05_070 = empty($hrb04_05_070)?null : $ws_hrb04_05 ->escape('hrb04_05_070',to_date($hrb04_05_070,'YYYY-MM-DD')); //家庭病床撤床日期 
$ws_hrb04_05 ->hrb04_05_071 = empty($hrb04_05_071)?null : $ws_hrb04_05 ->escape('hrb04_05_071',to_date($hrb04_05_071,'YYYY-MM-DD')); //家庭病床建床日期 
$ws_hrb04_05->hrb04_05_072 = $hrb04_05_072; //家庭病床建立原因 
$ws_hrb04_05->hrb04_05_073 = $hrb04_05_073; //吸氧时间(h) 
$ws_hrb04_05->hrb04_05_074 = $hrb04_05_074; //疫苗-名称代码 
$ws_hrb04_05->hrb04_05_075 = $hrb04_05_075; //疫苗-批号 
$ws_hrb04_05 ->hrb04_05_076 = empty($hrb04_05_076)?null : $ws_hrb04_05 ->escape('hrb04_05_076',to_date($hrb04_05_076,'YYYY-MM-DD')); //疫苗接种日期 
if($ws_hrb04_05 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb04_05 ->free_statement();
}
