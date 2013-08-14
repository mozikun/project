<?php
/**
糖尿病病例管理基本数据集标准HRB04.02糖尿病病例管理基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb04_02_057  饮酒种类代码
* @param decimal $hrb04_02_058  开始饮酒年龄(岁)
* @param boolean $hrb04_02_059  醉酒标志
* @param boolean $hrb04_02_060  戒酒标志
* @param decimal $hrb04_02_061  戒酒年龄(岁)
* @param string $hrb04_02_062  心理状态代码
* @param string $hrb04_02_063  遵医行为
* @param decimal $hrb04_02_064  空腹血糖值(mmol/L)
* @param decimal $hrb04_02_065  餐后两小时血糖值(mmol/L)
* @param decimal $hrb04_02_066  糖化血红蛋白值(%)
* @param boolean $hrb04_02_067  职业暴露标志
* @param string $hrb04_02_068  职业暴露危险因素名称
* @param string $hrb04_02_069  职业暴露危险因素种类
* @param string $hrb04_02_070  有危害因素的具体职业
* @param decimal $hrb04_02_071  从事有危害因素职业时长(年)
* @param boolean $hrb04_02_072  防护措施标志
* @param boolean $hrb04_02_073  家庭成员吸烟标志
* @param boolean $hrb04_02_074  家中煤火取暖标志
* @param decimal $hrb04_02_075  家中煤火取暖时间(年)
* @param string $hrb04_02_076  常住地址类别代码
* @param string $hrb04_02_077  现存主要健康问题
* @param date $hrb04_02_078  入院日期
* @param string $hrb04_02_079  入院原因
* @param date $hrb04_02_080  出院日期
* @param string $hrb04_02_081  医疗机构名称
* @param date $hrb04_02_082  家庭病床撤床日期
* @param date $hrb04_02_083  家庭病床建床日期
* @param string $hrb04_02_084  家庭病床建立原因
* @param decimal $hrb04_02_085  吸氧时间(h)
* @param string $hrb04_02_086  疫苗-名称代码
* @param string $hrb04_02_087  疫苗-批号
* @param date $hrb04_02_088  疫苗接种日期
* @param string $hrb04_02_001  健康档案标识符
* @param string $hrb04_02_002  病案号
* @param string $hrb04_02_003  姓名
* @param string $hrb04_02_004  性别代码
* @param string $hrb04_02_005  身份证件-类别代码
* @param string $hrb04_02_006  身份证件-号码
* @param string $hrb04_02_007  地址类别代码
* @param string $hrb04_02_008  行政区划代码
* @param string $hrb04_02_009  地址-省（自治区、直辖市）
* @param string $hrb04_02_010  地址-市（地区）
* @param string $hrb04_02_011  地址-县（区）
* @param string $hrb04_02_012  地址-乡（镇、街道办事处）
* @param string $hrb04_02_013  地址-村（街、路、弄等）
* @param string $hrb04_02_014  地址-门牌号码
* @param string $hrb04_02_015  邮政编码
* @param string $hrb04_02_016  责任医师姓名
* @param string $hrb04_02_017  随访医师姓名
* @param string $hrb04_02_018  随访方式代码
* @param date $hrb04_02_019  随访日期
* @param string $hrb04_02_020  症状代码(健康检查)
* @param string $hrb04_02_021  糖尿病随访评价代码 
* @param decimal $hrb04_02_022  体重（kg）
* @param decimal $hrb04_02_023  体重指数
* @param decimal $hrb04_02_024  收缩压(mmHg)
* @param decimal $hrb04_02_025  舒张压(mmHg)
* @param decimal $hrb04_02_026  日吸烟量(支)
* @param decimal $hrb04_02_027  日饮酒量(两)
* @param decimal $hrb04_02_028  日主食量（g）
* @param string $hrb04_02_029  随访饮食合理性评价类别代码
* @param string $hrb04_02_030  随访周期建议代码
* @param string $hrb04_02_031  随访遵医行为评价结果代码 
* @param string $hrb04_02_032  服药依从性代码
* @param string $hrb04_02_033  药物名称
* @param string $hrb04_02_034  药物使用-频率
* @param string $hrb04_02_035  药物使用-剂量单位
* @param decimal $hrb04_02_036  药物使用-次剂量
* @param decimal $hrb04_02_037  药物使用-总剂量
* @param string $hrb04_02_038  药物使用-途径代码
* @param boolean $hrb04_02_039  药物副作用标志
* @param string $hrb04_02_040  药物副作用
* @param decimal $hrb04_02_041  胰岛素用药-使用频率(次/天)
* @param decimal $hrb04_02_042  胰岛素用药-次剂量(mg)
* @param string $hrb04_02_043  转诊科别
* @param string $hrb04_02_044  转诊原因
* @param string $hrb04_02_045  检查（测）人员姓名
* @param date $hrb04_02_046  检查（测）日期
* @param string $hrb04_02_047  运动方式说明
* @param string $hrb04_02_048  运动频率类别代码
* @param decimal $hrb04_02_049  运动时间(min)
* @param decimal $hrb04_02_050  坚持运动时长(年)
* @param decimal $hrb04_02_051  周运动次数
* @param string $hrb04_02_052  饮食习惯代码
* @param string $hrb04_02_053  吸烟状况代码
* @param decimal $hrb04_02_054  开始吸烟年龄(岁)
* @param decimal $hrb04_02_055  戒烟年龄(岁)
* @param string $hrb04_02_056  饮酒频率代码
* @return boolean
*/
function update_hrb04_02($ws_id,$org_id,$doctor_id,$identity_number,$hrb04_02_057='',$hrb04_02_058=0,$hrb04_02_059=false,$hrb04_02_060=false,$hrb04_02_061=0,$hrb04_02_062='',$hrb04_02_063='',$hrb04_02_064=0,$hrb04_02_065=0,$hrb04_02_066=0,$hrb04_02_067=false,$hrb04_02_068='',$hrb04_02_069='',$hrb04_02_070='',$hrb04_02_071=0,$hrb04_02_072=false,$hrb04_02_073=false,$hrb04_02_074=false,$hrb04_02_075=0,$hrb04_02_076='',$hrb04_02_077='',$hrb04_02_078='',$hrb04_02_079='',$hrb04_02_080='',$hrb04_02_081='',$hrb04_02_082='',$hrb04_02_083='',$hrb04_02_084='',$hrb04_02_085=0,$hrb04_02_086='',$hrb04_02_087='',$hrb04_02_088='',$hrb04_02_001='',$hrb04_02_002='',$hrb04_02_003='',$hrb04_02_004='',$hrb04_02_005='',$hrb04_02_006='',$hrb04_02_007='',$hrb04_02_008='',$hrb04_02_009='',$hrb04_02_010='',$hrb04_02_011='',$hrb04_02_012='',$hrb04_02_013='',$hrb04_02_014='',$hrb04_02_015='',$hrb04_02_016='',$hrb04_02_017='',$hrb04_02_018='',$hrb04_02_019='',$hrb04_02_020='',$hrb04_02_021='',$hrb04_02_022=0,$hrb04_02_023=0,$hrb04_02_024=0,$hrb04_02_025=0,$hrb04_02_026=0,$hrb04_02_027=0,$hrb04_02_028=0,$hrb04_02_029='',$hrb04_02_030='',$hrb04_02_031='',$hrb04_02_032='',$hrb04_02_033='',$hrb04_02_034='',$hrb04_02_035='',$hrb04_02_036=0,$hrb04_02_037=0,$hrb04_02_038='',$hrb04_02_039=false,$hrb04_02_040='',$hrb04_02_041=0,$hrb04_02_042=0,$hrb04_02_043='',$hrb04_02_044='',$hrb04_02_045='',$hrb04_02_046='',$hrb04_02_047='',$hrb04_02_048='',$hrb04_02_049=0,$hrb04_02_050=0,$hrb04_02_051=0,$hrb04_02_052='',$hrb04_02_053='',$hrb04_02_054=0,$hrb04_02_055=0,$hrb04_02_056=''){
require_once(__SITEROOT.'library/Models/ws_hrb04_02.php');
$table_obj="Tws_hrb04_02";
$ws_hrb04_02=new $table_obj();
$ws_hrb04_02 -> ws_id=$ws_id;
$ws_hrb04_02 -> uuid=uniqid('',true);
$ws_hrb04_02 -> created=time();
$ws_hrb04_02 -> org_id=$org_id;
$ws_hrb04_02 -> doctor_id=$doctor_id;
$ws_hrb04_02 -> identity_number=$identity_number;//身份证号
$ws_hrb04_02 -> action='insert';
$ws_hrb04_02->hrb04_02_057 = $hrb04_02_057; //饮酒种类代码 
$ws_hrb04_02->hrb04_02_058 = $hrb04_02_058; //开始饮酒年龄(岁) 
$ws_hrb04_02->hrb04_02_059 = $hrb04_02_059; //醉酒标志 
$ws_hrb04_02->hrb04_02_060 = $hrb04_02_060; //戒酒标志 
$ws_hrb04_02->hrb04_02_061 = $hrb04_02_061; //戒酒年龄(岁) 
$ws_hrb04_02->hrb04_02_062 = $hrb04_02_062; //心理状态代码 
$ws_hrb04_02->hrb04_02_063 = $hrb04_02_063; //遵医行为 
$ws_hrb04_02->hrb04_02_064 = $hrb04_02_064; //空腹血糖值(mmol/L) 
$ws_hrb04_02->hrb04_02_065 = $hrb04_02_065; //餐后两小时血糖值(mmol/L) 
$ws_hrb04_02->hrb04_02_066 = $hrb04_02_066; //糖化血红蛋白值(%) 
$ws_hrb04_02->hrb04_02_067 = $hrb04_02_067; //职业暴露标志 
$ws_hrb04_02->hrb04_02_068 = $hrb04_02_068; //职业暴露危险因素名称 
$ws_hrb04_02->hrb04_02_069 = $hrb04_02_069; //职业暴露危险因素种类 
$ws_hrb04_02->hrb04_02_070 = $hrb04_02_070; //有危害因素的具体职业 
$ws_hrb04_02->hrb04_02_071 = $hrb04_02_071; //从事有危害因素职业时长(年) 
$ws_hrb04_02->hrb04_02_072 = $hrb04_02_072; //防护措施标志 
$ws_hrb04_02->hrb04_02_073 = $hrb04_02_073; //家庭成员吸烟标志 
$ws_hrb04_02->hrb04_02_074 = $hrb04_02_074; //家中煤火取暖标志 
$ws_hrb04_02->hrb04_02_075 = $hrb04_02_075; //家中煤火取暖时间(年) 
$ws_hrb04_02->hrb04_02_076 = $hrb04_02_076; //常住地址类别代码 
$ws_hrb04_02->hrb04_02_077 = $hrb04_02_077; //现存主要健康问题 
$ws_hrb04_02 ->hrb04_02_078 = empty($hrb04_02_078)?null : $ws_hrb04_02 ->escape('hrb04_02_078',to_date($hrb04_02_078,'YYYY-MM-DD')); //入院日期 
$ws_hrb04_02->hrb04_02_079 = $hrb04_02_079; //入院原因 
$ws_hrb04_02 ->hrb04_02_080 = empty($hrb04_02_080)?null : $ws_hrb04_02 ->escape('hrb04_02_080',to_date($hrb04_02_080,'YYYY-MM-DD')); //出院日期 
$ws_hrb04_02->hrb04_02_081 = $hrb04_02_081; //医疗机构名称 
$ws_hrb04_02 ->hrb04_02_082 = empty($hrb04_02_082)?null : $ws_hrb04_02 ->escape('hrb04_02_082',to_date($hrb04_02_082,'YYYY-MM-DD')); //家庭病床撤床日期 
$ws_hrb04_02 ->hrb04_02_083 = empty($hrb04_02_083)?null : $ws_hrb04_02 ->escape('hrb04_02_083',to_date($hrb04_02_083,'YYYY-MM-DD')); //家庭病床建床日期 
$ws_hrb04_02->hrb04_02_084 = $hrb04_02_084; //家庭病床建立原因 
$ws_hrb04_02->hrb04_02_085 = $hrb04_02_085; //吸氧时间(h) 
$ws_hrb04_02->hrb04_02_086 = $hrb04_02_086; //疫苗-名称代码 
$ws_hrb04_02->hrb04_02_087 = $hrb04_02_087; //疫苗-批号 
$ws_hrb04_02 ->hrb04_02_088 = empty($hrb04_02_088)?null : $ws_hrb04_02 ->escape('hrb04_02_088',to_date($hrb04_02_088,'YYYY-MM-DD')); //疫苗接种日期 
$ws_hrb04_02->hrb04_02_001 = $hrb04_02_001; //健康档案标识符 
$ws_hrb04_02->hrb04_02_002 = $hrb04_02_002; //病案号 
$ws_hrb04_02->hrb04_02_003 = $hrb04_02_003; //姓名 
$ws_hrb04_02->hrb04_02_004 = $hrb04_02_004; //性别代码 
$ws_hrb04_02->hrb04_02_005 = $hrb04_02_005; //身份证件-类别代码 
$ws_hrb04_02->hrb04_02_006 = $hrb04_02_006; //身份证件-号码 
$ws_hrb04_02->hrb04_02_007 = $hrb04_02_007; //地址类别代码 
$ws_hrb04_02->hrb04_02_008 = $hrb04_02_008; //行政区划代码 
$ws_hrb04_02->hrb04_02_009 = $hrb04_02_009; //地址-省（自治区、直辖市） 
$ws_hrb04_02->hrb04_02_010 = $hrb04_02_010; //地址-市（地区） 
$ws_hrb04_02->hrb04_02_011 = $hrb04_02_011; //地址-县（区） 
$ws_hrb04_02->hrb04_02_012 = $hrb04_02_012; //地址-乡（镇、街道办事处） 
$ws_hrb04_02->hrb04_02_013 = $hrb04_02_013; //地址-村（街、路、弄等） 
$ws_hrb04_02->hrb04_02_014 = $hrb04_02_014; //地址-门牌号码 
$ws_hrb04_02->hrb04_02_015 = $hrb04_02_015; //邮政编码 
$ws_hrb04_02->hrb04_02_016 = $hrb04_02_016; //责任医师姓名 
$ws_hrb04_02->hrb04_02_017 = $hrb04_02_017; //随访医师姓名 
$ws_hrb04_02->hrb04_02_018 = $hrb04_02_018; //随访方式代码 
$ws_hrb04_02 ->hrb04_02_019 = empty($hrb04_02_019)?null : $ws_hrb04_02 ->escape('hrb04_02_019',to_date($hrb04_02_019,'YYYY-MM-DD')); //随访日期 
$ws_hrb04_02->hrb04_02_020 = $hrb04_02_020; //症状代码(健康检查) 
$ws_hrb04_02->hrb04_02_021 = $hrb04_02_021; //糖尿病随访评价代码  
$ws_hrb04_02->hrb04_02_022 = $hrb04_02_022; //体重（kg） 
$ws_hrb04_02->hrb04_02_023 = $hrb04_02_023; //体重指数 
$ws_hrb04_02->hrb04_02_024 = $hrb04_02_024; //收缩压(mmHg) 
$ws_hrb04_02->hrb04_02_025 = $hrb04_02_025; //舒张压(mmHg) 
$ws_hrb04_02->hrb04_02_026 = $hrb04_02_026; //日吸烟量(支) 
$ws_hrb04_02->hrb04_02_027 = $hrb04_02_027; //日饮酒量(两) 
$ws_hrb04_02->hrb04_02_028 = $hrb04_02_028; //日主食量（g） 
$ws_hrb04_02->hrb04_02_029 = $hrb04_02_029; //随访饮食合理性评价类别代码 
$ws_hrb04_02->hrb04_02_030 = $hrb04_02_030; //随访周期建议代码 
$ws_hrb04_02->hrb04_02_031 = $hrb04_02_031; //随访遵医行为评价结果代码  
$ws_hrb04_02->hrb04_02_032 = $hrb04_02_032; //服药依从性代码 
$ws_hrb04_02->hrb04_02_033 = $hrb04_02_033; //药物名称 
$ws_hrb04_02->hrb04_02_034 = $hrb04_02_034; //药物使用-频率 
$ws_hrb04_02->hrb04_02_035 = $hrb04_02_035; //药物使用-剂量单位 
$ws_hrb04_02->hrb04_02_036 = $hrb04_02_036; //药物使用-次剂量 
$ws_hrb04_02->hrb04_02_037 = $hrb04_02_037; //药物使用-总剂量 
$ws_hrb04_02->hrb04_02_038 = $hrb04_02_038; //药物使用-途径代码 
$ws_hrb04_02->hrb04_02_039 = $hrb04_02_039; //药物副作用标志 
$ws_hrb04_02->hrb04_02_040 = $hrb04_02_040; //药物副作用 
$ws_hrb04_02->hrb04_02_041 = $hrb04_02_041; //胰岛素用药-使用频率(次/天) 
$ws_hrb04_02->hrb04_02_042 = $hrb04_02_042; //胰岛素用药-次剂量(mg) 
$ws_hrb04_02->hrb04_02_043 = $hrb04_02_043; //转诊科别 
$ws_hrb04_02->hrb04_02_044 = $hrb04_02_044; //转诊原因 
$ws_hrb04_02->hrb04_02_045 = $hrb04_02_045; //检查（测）人员姓名 
$ws_hrb04_02 ->hrb04_02_046 = empty($hrb04_02_046)?null : $ws_hrb04_02 ->escape('hrb04_02_046',to_date($hrb04_02_046,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrb04_02->hrb04_02_047 = $hrb04_02_047; //运动方式说明 
$ws_hrb04_02->hrb04_02_048 = $hrb04_02_048; //运动频率类别代码 
$ws_hrb04_02->hrb04_02_049 = $hrb04_02_049; //运动时间(min) 
$ws_hrb04_02->hrb04_02_050 = $hrb04_02_050; //坚持运动时长(年) 
$ws_hrb04_02->hrb04_02_051 = $hrb04_02_051; //周运动次数 
$ws_hrb04_02->hrb04_02_052 = $hrb04_02_052; //饮食习惯代码 
$ws_hrb04_02->hrb04_02_053 = $hrb04_02_053; //吸烟状况代码 
$ws_hrb04_02->hrb04_02_054 = $hrb04_02_054; //开始吸烟年龄(岁) 
$ws_hrb04_02->hrb04_02_055 = $hrb04_02_055; //戒烟年龄(岁) 
$ws_hrb04_02->hrb04_02_056 = $hrb04_02_056; //饮酒频率代码 
if($ws_hrb04_02 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb04_02 ->free_statement();
}
