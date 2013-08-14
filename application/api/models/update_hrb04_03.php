<?php
/**
肿瘤病例管理基本数据集标准HRB04.03肿瘤病例管理基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb04_03_001  记录表单编号
* @param string $hrb04_03_002  肿瘤病情告知病人情况类别代码
* @param string $hrb04_03_003  门诊号
* @param string $hrb04_03_004  住院号
* @param string $hrb04_03_005  身份证件-类别代码
* @param string $hrb04_03_006  身份证件-号码
* @param string $hrb04_03_007  姓名
* @param string $hrb04_03_008  性别代码
* @param string $hrb04_03_009  民族代码
* @param date $hrb04_03_010  出生日期
* @param string $hrb04_03_011  职业类别代码(国标)
* @param string $hrb04_03_012  工作单位名称
* @param string $hrb04_03_013  地址类别代码
* @param string $hrb04_03_014  行政区划代码
* @param string $hrb04_03_015  地址-省（自治区、直辖市）
* @param string $hrb04_03_016  地址-市（地区）
* @param string $hrb04_03_017  地址-县（区）
* @param string $hrb04_03_018  地址-乡（镇、街道办事处）
* @param string $hrb04_03_019  地址-村（街、路、弄等）
* @param string $hrb04_03_020  地址-门牌号码
* @param string $hrb04_03_021  邮政编码
* @param string $hrb04_03_022  联系电话-类别
* @param string $hrb04_03_023  联系电话-类别代码
* @param string $hrb04_03_024  联系电话-号码
* @param string $hrb04_03_025  电子邮件地址
* @param string $hrb04_03_026  肿瘤诊断代码
* @param string $hrb04_03_027  肿瘤学分类代码
* @param string $hrb04_03_028  病理号
* @param string $hrb04_03_029  肿瘤TNM分期代码
* @param string $hrb04_03_030  肿瘤临床分期代码
* @param date $hrb04_03_031  首次就诊日期
* @param date $hrb04_03_032  确诊日期
* @param string $hrb04_03_033  肿瘤诊断依据代码
* @param string $hrb04_03_034  填报单位名称
* @param string $hrb04_03_035  报告医师姓名
* @param date $hrb04_03_036  填报日期
* @param date $hrb04_03_037  户口迁移日期
* @param date $hrb04_03_038  撤销随访管理日期
* @param string $hrb04_03_039  撤销随访管理原因代码
* @param boolean $hrb04_03_040  肿瘤家族史标志
* @param string $hrb04_03_041  患者与本人关系代码
* @param string $hrb04_03_042  肿瘤家族史瘤别
* @param string $hrb04_03_043  肿瘤病人治疗方式代码
* @param string $hrb04_03_044  手术机构名称
* @param date $hrb04_03_045  手术日期
* @param string $hrb04_03_046  肿瘤手术性质代码
* @param string $hrb04_03_047  肿瘤放疗机构名称
* @param string $hrb04_03_048  肿瘤化疗机构名称
* @param string $hrb04_03_049  肿瘤化疗疗程次数
* @param string $hrb04_03_050  肿瘤病人目前疾病情况类别代码
* @param boolean $hrb04_03_051  复发-标志
* @param string $hrb04_03_052  复发-次数
* @param date $hrb04_03_053  复发日期
* @param boolean $hrb04_03_054  肿瘤病人转移-标志
* @param string $hrb04_03_055  肿瘤病人转移-部位
* @param string $hrb04_03_056  肿瘤病人指导内容代码
* @param decimal $hrb04_03_057  卡氏评分值
* @param string $hrb04_03_058  社区管理医师姓名
* @param date $hrb04_03_059  随访日期
* @param string $hrb04_03_060  肿瘤诊疗机构代码
* @return boolean
*/
function update_hrb04_03($ws_id,$org_id,$doctor_id,$identity_number,$hrb04_03_001='',$hrb04_03_002='',$hrb04_03_003='',$hrb04_03_004='',$hrb04_03_005='',$hrb04_03_006='',$hrb04_03_007='',$hrb04_03_008='',$hrb04_03_009='',$hrb04_03_010='',$hrb04_03_011='',$hrb04_03_012='',$hrb04_03_013='',$hrb04_03_014='',$hrb04_03_015='',$hrb04_03_016='',$hrb04_03_017='',$hrb04_03_018='',$hrb04_03_019='',$hrb04_03_020='',$hrb04_03_021='',$hrb04_03_022='',$hrb04_03_023='',$hrb04_03_024='',$hrb04_03_025='',$hrb04_03_026='',$hrb04_03_027='',$hrb04_03_028='',$hrb04_03_029='',$hrb04_03_030='',$hrb04_03_031='',$hrb04_03_032='',$hrb04_03_033='',$hrb04_03_034='',$hrb04_03_035='',$hrb04_03_036='',$hrb04_03_037='',$hrb04_03_038='',$hrb04_03_039='',$hrb04_03_040=false,$hrb04_03_041='',$hrb04_03_042='',$hrb04_03_043='',$hrb04_03_044='',$hrb04_03_045='',$hrb04_03_046='',$hrb04_03_047='',$hrb04_03_048='',$hrb04_03_049='',$hrb04_03_050='',$hrb04_03_051=false,$hrb04_03_052='',$hrb04_03_053='',$hrb04_03_054=false,$hrb04_03_055='',$hrb04_03_056='',$hrb04_03_057=0,$hrb04_03_058='',$hrb04_03_059='',$hrb04_03_060=''){
require_once(__SITEROOT.'library/Models/ws_hrb04_03.php');
$table_obj="Tws_hrb04_03";
$ws_hrb04_03=new $table_obj();
$ws_hrb04_03 -> ws_id=$ws_id;
$ws_hrb04_03 -> uuid=uniqid('',true);
$ws_hrb04_03 -> created=time();
$ws_hrb04_03 -> org_id=$org_id;
$ws_hrb04_03 -> doctor_id=$doctor_id;
$ws_hrb04_03 -> identity_number=$identity_number;//身份证号
$ws_hrb04_03 -> action='insert';
$ws_hrb04_03->hrb04_03_001 = $hrb04_03_001; //记录表单编号 
$ws_hrb04_03->hrb04_03_002 = $hrb04_03_002; //肿瘤病情告知病人情况类别代码 
$ws_hrb04_03->hrb04_03_003 = $hrb04_03_003; //门诊号 
$ws_hrb04_03->hrb04_03_004 = $hrb04_03_004; //住院号 
$ws_hrb04_03->hrb04_03_005 = $hrb04_03_005; //身份证件-类别代码 
$ws_hrb04_03->hrb04_03_006 = $hrb04_03_006; //身份证件-号码 
$ws_hrb04_03->hrb04_03_007 = $hrb04_03_007; //姓名 
$ws_hrb04_03->hrb04_03_008 = $hrb04_03_008; //性别代码 
$ws_hrb04_03->hrb04_03_009 = $hrb04_03_009; //民族代码 
$ws_hrb04_03 ->hrb04_03_010 = empty($hrb04_03_010)?null : $ws_hrb04_03 ->escape('hrb04_03_010',to_date($hrb04_03_010,'YYYY-MM-DD')); //出生日期 
$ws_hrb04_03->hrb04_03_011 = $hrb04_03_011; //职业类别代码(国标) 
$ws_hrb04_03->hrb04_03_012 = $hrb04_03_012; //工作单位名称 
$ws_hrb04_03->hrb04_03_013 = $hrb04_03_013; //地址类别代码 
$ws_hrb04_03->hrb04_03_014 = $hrb04_03_014; //行政区划代码 
$ws_hrb04_03->hrb04_03_015 = $hrb04_03_015; //地址-省（自治区、直辖市） 
$ws_hrb04_03->hrb04_03_016 = $hrb04_03_016; //地址-市（地区） 
$ws_hrb04_03->hrb04_03_017 = $hrb04_03_017; //地址-县（区） 
$ws_hrb04_03->hrb04_03_018 = $hrb04_03_018; //地址-乡（镇、街道办事处） 
$ws_hrb04_03->hrb04_03_019 = $hrb04_03_019; //地址-村（街、路、弄等） 
$ws_hrb04_03->hrb04_03_020 = $hrb04_03_020; //地址-门牌号码 
$ws_hrb04_03->hrb04_03_021 = $hrb04_03_021; //邮政编码 
$ws_hrb04_03->hrb04_03_022 = $hrb04_03_022; //联系电话-类别 
$ws_hrb04_03->hrb04_03_023 = $hrb04_03_023; //联系电话-类别代码 
$ws_hrb04_03->hrb04_03_024 = $hrb04_03_024; //联系电话-号码 
$ws_hrb04_03->hrb04_03_025 = $hrb04_03_025; //电子邮件地址 
$ws_hrb04_03->hrb04_03_026 = $hrb04_03_026; //肿瘤诊断代码 
$ws_hrb04_03->hrb04_03_027 = $hrb04_03_027; //肿瘤学分类代码 
$ws_hrb04_03->hrb04_03_028 = $hrb04_03_028; //病理号 
$ws_hrb04_03->hrb04_03_029 = $hrb04_03_029; //肿瘤TNM分期代码 
$ws_hrb04_03->hrb04_03_030 = $hrb04_03_030; //肿瘤临床分期代码 
$ws_hrb04_03 ->hrb04_03_031 = empty($hrb04_03_031)?null : $ws_hrb04_03 ->escape('hrb04_03_031',to_date($hrb04_03_031,'YYYY-MM-DD')); //首次就诊日期 
$ws_hrb04_03 ->hrb04_03_032 = empty($hrb04_03_032)?null : $ws_hrb04_03 ->escape('hrb04_03_032',to_date($hrb04_03_032,'YYYY-MM-DD')); //确诊日期 
$ws_hrb04_03->hrb04_03_033 = $hrb04_03_033; //肿瘤诊断依据代码 
$ws_hrb04_03->hrb04_03_034 = $hrb04_03_034; //填报单位名称 
$ws_hrb04_03->hrb04_03_035 = $hrb04_03_035; //报告医师姓名 
$ws_hrb04_03 ->hrb04_03_036 = empty($hrb04_03_036)?null : $ws_hrb04_03 ->escape('hrb04_03_036',to_date($hrb04_03_036,'YYYY-MM-DD')); //填报日期 
$ws_hrb04_03 ->hrb04_03_037 = empty($hrb04_03_037)?null : $ws_hrb04_03 ->escape('hrb04_03_037',to_date($hrb04_03_037,'YYYY-MM-DD')); //户口迁移日期 
$ws_hrb04_03 ->hrb04_03_038 = empty($hrb04_03_038)?null : $ws_hrb04_03 ->escape('hrb04_03_038',to_date($hrb04_03_038,'YYYY-MM-DD')); //撤销随访管理日期 
$ws_hrb04_03->hrb04_03_039 = $hrb04_03_039; //撤销随访管理原因代码 
$ws_hrb04_03->hrb04_03_040 = $hrb04_03_040; //肿瘤家族史标志 
$ws_hrb04_03->hrb04_03_041 = $hrb04_03_041; //患者与本人关系代码 
$ws_hrb04_03->hrb04_03_042 = $hrb04_03_042; //肿瘤家族史瘤别 
$ws_hrb04_03->hrb04_03_043 = $hrb04_03_043; //肿瘤病人治疗方式代码 
$ws_hrb04_03->hrb04_03_044 = $hrb04_03_044; //手术机构名称 
$ws_hrb04_03 ->hrb04_03_045 = empty($hrb04_03_045)?null : $ws_hrb04_03 ->escape('hrb04_03_045',to_date($hrb04_03_045,'YYYY-MM-DD')); //手术日期 
$ws_hrb04_03->hrb04_03_046 = $hrb04_03_046; //肿瘤手术性质代码 
$ws_hrb04_03->hrb04_03_047 = $hrb04_03_047; //肿瘤放疗机构名称 
$ws_hrb04_03->hrb04_03_048 = $hrb04_03_048; //肿瘤化疗机构名称 
$ws_hrb04_03->hrb04_03_049 = $hrb04_03_049; //肿瘤化疗疗程次数 
$ws_hrb04_03->hrb04_03_050 = $hrb04_03_050; //肿瘤病人目前疾病情况类别代码 
$ws_hrb04_03->hrb04_03_051 = $hrb04_03_051; //复发-标志 
$ws_hrb04_03->hrb04_03_052 = $hrb04_03_052; //复发-次数 
$ws_hrb04_03 ->hrb04_03_053 = empty($hrb04_03_053)?null : $ws_hrb04_03 ->escape('hrb04_03_053',to_date($hrb04_03_053,'YYYY-MM-DD')); //复发日期 
$ws_hrb04_03->hrb04_03_054 = $hrb04_03_054; //肿瘤病人转移-标志 
$ws_hrb04_03->hrb04_03_055 = $hrb04_03_055; //肿瘤病人转移-部位 
$ws_hrb04_03->hrb04_03_056 = $hrb04_03_056; //肿瘤病人指导内容代码 
$ws_hrb04_03->hrb04_03_057 = $hrb04_03_057; //卡氏评分值 
$ws_hrb04_03->hrb04_03_058 = $hrb04_03_058; //社区管理医师姓名 
$ws_hrb04_03 ->hrb04_03_059 = empty($hrb04_03_059)?null : $ws_hrb04_03 ->escape('hrb04_03_059',to_date($hrb04_03_059,'YYYY-MM-DD')); //随访日期 
$ws_hrb04_03->hrb04_03_060 = $hrb04_03_060; //肿瘤诊疗机构代码 
if($ws_hrb04_03 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb04_03 ->free_statement();
}
