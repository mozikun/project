<?php
/**
高血压病例管理基本数据集标准HRB04.01高血压病例管理基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb04_01_001  健康档案标识符
* @param string $hrb04_01_002  病案号
* @param string $hrb04_01_003  姓名
* @param string $hrb04_01_004  性别代码
* @param string $hrb04_01_005  身份证件-类别代码
* @param string $hrb04_01_006  身份证件-号码
* @param string $hrb04_01_007  地址类别代码
* @param string $hrb04_01_008  行政区划代码
* @param string $hrb04_01_009  地址-省（自治区、直辖市）
* @param string $hrb04_01_010  地址-市（地区）
* @param string $hrb04_01_011  地址-县（区）
* @param string $hrb04_01_012  地址-乡（镇、街道办事处）
* @param string $hrb04_01_013  地址-村（街、路、弄等）
* @param string $hrb04_01_014  地址-门牌号码
* @param string $hrb04_01_015  邮政编码
* @param string $hrb04_01_016  责任医师姓名
* @param string $hrb04_01_017  随访医师姓名
* @param string $hrb04_01_018  随访方式代码
* @param date $hrb04_01_019  随访日期
* @param string $hrb04_01_020  症状代码(健康检查)
* @param string $hrb04_01_021  高血压随访评价结果代码
* @param decimal $hrb04_01_022  体重（kg）
* @param decimal $hrb04_01_023  体重指数
* @param decimal $hrb04_01_024  收缩压(mmHg)
* @param decimal $hrb04_01_025  舒张压(mmHg)
* @param decimal $hrb04_01_026  日吸烟量(支)
* @param decimal $hrb04_01_027  日饮酒量(两)
* @param string $hrb04_01_028  随访饮食合理性评价类别代码
* @param string $hrb04_01_029  随访周期建议代码
* @param string $hrb04_01_030  随访遵医行为评价结果代码 
* @param string $hrb04_01_031  服药依从性代码
* @param string $hrb04_01_032  药物名称
* @param string $hrb04_01_033  药物使用-频率
* @param string $hrb04_01_034  药物使用-剂量单位
* @param decimal $hrb04_01_035  药物使用-次剂量
* @param decimal $hrb04_01_036  药物使用-总剂量
* @param string $hrb04_01_037  药物使用-途径代码
* @param boolean $hrb04_01_038  药物副作用标志
* @param string $hrb04_01_039  药物副作用
* @param string $hrb04_01_040  转诊科别
* @param string $hrb04_01_041  转诊原因
* @param string $hrb04_01_042  检查（测）人员姓名
* @param date $hrb04_01_043  检查（测）日期
* @param string $hrb04_01_044  运动方式说明
* @param string $hrb04_01_045  运动频率类别代码
* @param decimal $hrb04_01_046  运动时间(min)
* @param decimal $hrb04_01_047  坚持运动时长(年)
* @param decimal $hrb04_01_048  周运动次数
* @param string $hrb04_01_049  饮食习惯代码
* @param string $hrb04_01_050  吸烟状况代码
* @param decimal $hrb04_01_051  开始吸烟年龄(岁)
* @param decimal $hrb04_01_052  戒烟年龄(岁)
* @param string $hrb04_01_053  饮酒频率代码
* @param string $hrb04_01_054  饮酒种类代码
* @param decimal $hrb04_01_055  开始饮酒年龄(岁)
* @param boolean $hrb04_01_056  醉酒标志
* @param boolean $hrb04_01_057  戒酒标志
* @param decimal $hrb04_01_058  戒酒年龄(岁)
* @param string $hrb04_01_059  心理状态代码
* @param string $hrb04_01_060  遵医行为
* @param boolean $hrb04_01_061  职业暴露标志
* @param string $hrb04_01_062  职业暴露危险因素名称
* @param string $hrb04_01_063  职业暴露危险因素种类
* @param string $hrb04_01_064  有危害因素的具体职业
* @param decimal $hrb04_01_065  从事有危害因素职业时长(年)
* @param boolean $hrb04_01_066  防护措施标志
* @param boolean $hrb04_01_067  家庭成员吸烟标志
* @param boolean $hrb04_01_068  家中煤火取暖标志
* @param decimal $hrb04_01_069  家中煤火取暖时间(年)
* @param string $hrb04_01_070  常住地址类别代码
* @param string $hrb04_01_071  现存主要健康问题
* @param date $hrb04_01_072  入院日期
* @param string $hrb04_01_073  入院原因
* @param date $hrb04_01_074  出院日期
* @param string $hrb04_01_075  医疗机构名称
* @param date $hrb04_01_076  家庭病床撤床日期
* @param date $hrb04_01_077  家庭病床建床日期
* @param string $hrb04_01_078  家庭病床建立原因
* @param decimal $hrb04_01_079  吸氧时间(h)
* @param string $hrb04_01_080  疫苗-名称代码
* @param string $hrb04_01_081  疫苗-批号
* @param date $hrb04_01_082  疫苗接种日期
* @return boolean
*/
function update_hrb04_01($ws_id,$org_id,$doctor_id,$identity_number,$hrb04_01_001='',$hrb04_01_002='',$hrb04_01_003='',$hrb04_01_004='',$hrb04_01_005='',$hrb04_01_006='',$hrb04_01_007='',$hrb04_01_008='',$hrb04_01_009='',$hrb04_01_010='',$hrb04_01_011='',$hrb04_01_012='',$hrb04_01_013='',$hrb04_01_014='',$hrb04_01_015='',$hrb04_01_016='',$hrb04_01_017='',$hrb04_01_018='',$hrb04_01_019='',$hrb04_01_020='',$hrb04_01_021='',$hrb04_01_022=0,$hrb04_01_023=0,$hrb04_01_024=0,$hrb04_01_025=0,$hrb04_01_026=0,$hrb04_01_027=0,$hrb04_01_028='',$hrb04_01_029='',$hrb04_01_030='',$hrb04_01_031='',$hrb04_01_032='',$hrb04_01_033='',$hrb04_01_034='',$hrb04_01_035=0,$hrb04_01_036=0,$hrb04_01_037='',$hrb04_01_038=false,$hrb04_01_039='',$hrb04_01_040='',$hrb04_01_041='',$hrb04_01_042='',$hrb04_01_043='',$hrb04_01_044='',$hrb04_01_045='',$hrb04_01_046=0,$hrb04_01_047=0,$hrb04_01_048=0,$hrb04_01_049='',$hrb04_01_050='',$hrb04_01_051=0,$hrb04_01_052=0,$hrb04_01_053='',$hrb04_01_054='',$hrb04_01_055=0,$hrb04_01_056=false,$hrb04_01_057=false,$hrb04_01_058=0,$hrb04_01_059='',$hrb04_01_060='',$hrb04_01_061=false,$hrb04_01_062='',$hrb04_01_063='',$hrb04_01_064='',$hrb04_01_065=0,$hrb04_01_066=false,$hrb04_01_067=false,$hrb04_01_068=false,$hrb04_01_069=0,$hrb04_01_070='',$hrb04_01_071='',$hrb04_01_072='',$hrb04_01_073='',$hrb04_01_074='',$hrb04_01_075='',$hrb04_01_076='',$hrb04_01_077='',$hrb04_01_078='',$hrb04_01_079=0,$hrb04_01_080='',$hrb04_01_081='',$hrb04_01_082=''){
require_once(__SITEROOT.'library/Models/ws_hrb04_01.php');
$table_obj="Tws_hrb04_01";
$ws_hrb04_01=new $table_obj();
$ws_hrb04_01 -> ws_id=$ws_id;
$ws_hrb04_01 -> uuid=uniqid('',true);
$ws_hrb04_01 -> created=time();
$ws_hrb04_01 -> org_id=$org_id;
$ws_hrb04_01 -> doctor_id=$doctor_id;
$ws_hrb04_01 -> identity_number=$identity_number;//身份证号
$ws_hrb04_01 -> action='insert';
$ws_hrb04_01->hrb04_01_001 = $hrb04_01_001; //健康档案标识符 
$ws_hrb04_01->hrb04_01_002 = $hrb04_01_002; //病案号 
$ws_hrb04_01->hrb04_01_003 = $hrb04_01_003; //姓名 
$ws_hrb04_01->hrb04_01_004 = $hrb04_01_004; //性别代码 
$ws_hrb04_01->hrb04_01_005 = $hrb04_01_005; //身份证件-类别代码 
$ws_hrb04_01->hrb04_01_006 = $hrb04_01_006; //身份证件-号码 
$ws_hrb04_01->hrb04_01_007 = $hrb04_01_007; //地址类别代码 
$ws_hrb04_01->hrb04_01_008 = $hrb04_01_008; //行政区划代码 
$ws_hrb04_01->hrb04_01_009 = $hrb04_01_009; //地址-省（自治区、直辖市） 
$ws_hrb04_01->hrb04_01_010 = $hrb04_01_010; //地址-市（地区） 
$ws_hrb04_01->hrb04_01_011 = $hrb04_01_011; //地址-县（区） 
$ws_hrb04_01->hrb04_01_012 = $hrb04_01_012; //地址-乡（镇、街道办事处） 
$ws_hrb04_01->hrb04_01_013 = $hrb04_01_013; //地址-村（街、路、弄等） 
$ws_hrb04_01->hrb04_01_014 = $hrb04_01_014; //地址-门牌号码 
$ws_hrb04_01->hrb04_01_015 = $hrb04_01_015; //邮政编码 
$ws_hrb04_01->hrb04_01_016 = $hrb04_01_016; //责任医师姓名 
$ws_hrb04_01->hrb04_01_017 = $hrb04_01_017; //随访医师姓名 
$ws_hrb04_01->hrb04_01_018 = $hrb04_01_018; //随访方式代码 
$ws_hrb04_01 ->hrb04_01_019 = empty($hrb04_01_019)?null : $ws_hrb04_01 ->escape('hrb04_01_019',to_date($hrb04_01_019,'YYYY-MM-DD')); //随访日期 
$ws_hrb04_01->hrb04_01_020 = $hrb04_01_020; //症状代码(健康检查) 
$ws_hrb04_01->hrb04_01_021 = $hrb04_01_021; //高血压随访评价结果代码 
$ws_hrb04_01->hrb04_01_022 = $hrb04_01_022; //体重（kg） 
$ws_hrb04_01->hrb04_01_023 = $hrb04_01_023; //体重指数 
$ws_hrb04_01->hrb04_01_024 = $hrb04_01_024; //收缩压(mmHg) 
$ws_hrb04_01->hrb04_01_025 = $hrb04_01_025; //舒张压(mmHg) 
$ws_hrb04_01->hrb04_01_026 = $hrb04_01_026; //日吸烟量(支) 
$ws_hrb04_01->hrb04_01_027 = $hrb04_01_027; //日饮酒量(两) 
$ws_hrb04_01->hrb04_01_028 = $hrb04_01_028; //随访饮食合理性评价类别代码 
$ws_hrb04_01->hrb04_01_029 = $hrb04_01_029; //随访周期建议代码 
$ws_hrb04_01->hrb04_01_030 = $hrb04_01_030; //随访遵医行为评价结果代码  
$ws_hrb04_01->hrb04_01_031 = $hrb04_01_031; //服药依从性代码 
$ws_hrb04_01->hrb04_01_032 = $hrb04_01_032; //药物名称 
$ws_hrb04_01->hrb04_01_033 = $hrb04_01_033; //药物使用-频率 
$ws_hrb04_01->hrb04_01_034 = $hrb04_01_034; //药物使用-剂量单位 
$ws_hrb04_01->hrb04_01_035 = $hrb04_01_035; //药物使用-次剂量 
$ws_hrb04_01->hrb04_01_036 = $hrb04_01_036; //药物使用-总剂量 
$ws_hrb04_01->hrb04_01_037 = $hrb04_01_037; //药物使用-途径代码 
$ws_hrb04_01->hrb04_01_038 = $hrb04_01_038; //药物副作用标志 
$ws_hrb04_01->hrb04_01_039 = $hrb04_01_039; //药物副作用 
$ws_hrb04_01->hrb04_01_040 = $hrb04_01_040; //转诊科别 
$ws_hrb04_01->hrb04_01_041 = $hrb04_01_041; //转诊原因 
$ws_hrb04_01->hrb04_01_042 = $hrb04_01_042; //检查（测）人员姓名 
$ws_hrb04_01 ->hrb04_01_043 = empty($hrb04_01_043)?null : $ws_hrb04_01 ->escape('hrb04_01_043',to_date($hrb04_01_043,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrb04_01->hrb04_01_044 = $hrb04_01_044; //运动方式说明 
$ws_hrb04_01->hrb04_01_045 = $hrb04_01_045; //运动频率类别代码 
$ws_hrb04_01->hrb04_01_046 = $hrb04_01_046; //运动时间(min) 
$ws_hrb04_01->hrb04_01_047 = $hrb04_01_047; //坚持运动时长(年) 
$ws_hrb04_01->hrb04_01_048 = $hrb04_01_048; //周运动次数 
$ws_hrb04_01->hrb04_01_049 = $hrb04_01_049; //饮食习惯代码 
$ws_hrb04_01->hrb04_01_050 = $hrb04_01_050; //吸烟状况代码 
$ws_hrb04_01->hrb04_01_051 = $hrb04_01_051; //开始吸烟年龄(岁) 
$ws_hrb04_01->hrb04_01_052 = $hrb04_01_052; //戒烟年龄(岁) 
$ws_hrb04_01->hrb04_01_053 = $hrb04_01_053; //饮酒频率代码 
$ws_hrb04_01->hrb04_01_054 = $hrb04_01_054; //饮酒种类代码 
$ws_hrb04_01->hrb04_01_055 = $hrb04_01_055; //开始饮酒年龄(岁) 
$ws_hrb04_01->hrb04_01_056 = $hrb04_01_056; //醉酒标志 
$ws_hrb04_01->hrb04_01_057 = $hrb04_01_057; //戒酒标志 
$ws_hrb04_01->hrb04_01_058 = $hrb04_01_058; //戒酒年龄(岁) 
$ws_hrb04_01->hrb04_01_059 = $hrb04_01_059; //心理状态代码 
$ws_hrb04_01->hrb04_01_060 = $hrb04_01_060; //遵医行为 
$ws_hrb04_01->hrb04_01_061 = $hrb04_01_061; //职业暴露标志 
$ws_hrb04_01->hrb04_01_062 = $hrb04_01_062; //职业暴露危险因素名称 
$ws_hrb04_01->hrb04_01_063 = $hrb04_01_063; //职业暴露危险因素种类 
$ws_hrb04_01->hrb04_01_064 = $hrb04_01_064; //有危害因素的具体职业 
$ws_hrb04_01->hrb04_01_065 = $hrb04_01_065; //从事有危害因素职业时长(年) 
$ws_hrb04_01->hrb04_01_066 = $hrb04_01_066; //防护措施标志 
$ws_hrb04_01->hrb04_01_067 = $hrb04_01_067; //家庭成员吸烟标志 
$ws_hrb04_01->hrb04_01_068 = $hrb04_01_068; //家中煤火取暖标志 
$ws_hrb04_01->hrb04_01_069 = $hrb04_01_069; //家中煤火取暖时间(年) 
$ws_hrb04_01->hrb04_01_070 = $hrb04_01_070; //常住地址类别代码 
$ws_hrb04_01->hrb04_01_071 = $hrb04_01_071; //现存主要健康问题 
$ws_hrb04_01 ->hrb04_01_072 = empty($hrb04_01_072)?null : $ws_hrb04_01 ->escape('hrb04_01_072',to_date($hrb04_01_072,'YYYY-MM-DD')); //入院日期 
$ws_hrb04_01->hrb04_01_073 = $hrb04_01_073; //入院原因 
$ws_hrb04_01 ->hrb04_01_074 = empty($hrb04_01_074)?null : $ws_hrb04_01 ->escape('hrb04_01_074',to_date($hrb04_01_074,'YYYY-MM-DD')); //出院日期 
$ws_hrb04_01->hrb04_01_075 = $hrb04_01_075; //医疗机构名称 
$ws_hrb04_01 ->hrb04_01_076 = empty($hrb04_01_076)?null : $ws_hrb04_01 ->escape('hrb04_01_076',to_date($hrb04_01_076,'YYYY-MM-DD')); //家庭病床撤床日期 
$ws_hrb04_01 ->hrb04_01_077 = empty($hrb04_01_077)?null : $ws_hrb04_01 ->escape('hrb04_01_077',to_date($hrb04_01_077,'YYYY-MM-DD')); //家庭病床建床日期 
$ws_hrb04_01->hrb04_01_078 = $hrb04_01_078; //家庭病床建立原因 
$ws_hrb04_01->hrb04_01_079 = $hrb04_01_079; //吸氧时间(h) 
$ws_hrb04_01->hrb04_01_080 = $hrb04_01_080; //疫苗-名称代码 
$ws_hrb04_01->hrb04_01_081 = $hrb04_01_081; //疫苗-批号 
$ws_hrb04_01 ->hrb04_01_082 = empty($hrb04_01_082)?null : $ws_hrb04_01 ->escape('hrb04_01_082',to_date($hrb04_01_082,'YYYY-MM-DD')); //疫苗接种日期 
if($ws_hrb04_01 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb04_01 ->free_statement();
}
