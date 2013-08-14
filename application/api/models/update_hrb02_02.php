<?php
/**
妇女病普查基本数据集标准HRB02.02妇女病普查基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb02_02_001  记录表单编号
* @param string $hrb02_02_002  姓名
* @param date $hrb02_02_003  出生日期
* @param string $hrb02_02_004  民族代码
* @param string $hrb02_02_005  职业类别代码(国标)
* @param string $hrb02_02_006  工作单位名称
* @param string $hrb02_02_007  文化程度代码
* @param string $hrb02_02_008  身份证件-类别代码
* @param string $hrb02_02_009  身份证件-号码
* @param string $hrb02_02_010  婚姻状况类别代码
* @param string $hrb02_02_011  地址类别代码
* @param string $hrb02_02_012  行政区划代码
* @param string $hrb02_02_013  地址-省（自治区、直辖市）
* @param string $hrb02_02_014  地址-市（地区）
* @param string $hrb02_02_015  地址-县（区）
* @param string $hrb02_02_016  地址-乡（镇、街道办事处）
* @param string $hrb02_02_017  地址-村（街、路、弄等）
* @param string $hrb02_02_018  地址-门牌号码
* @param string $hrb02_02_019  邮政编码
* @param string $hrb02_02_020  联系电话-类别
* @param string $hrb02_02_021  联系电话-类别代码
* @param string $hrb02_02_022  联系电话-号码
* @param string $hrb02_02_023  性交出血史
* @param string $hrb02_02_024  妊娠合并症/并发症史
* @param string $hrb02_02_025  既往疾病史
* @param string $hrb02_02_026  家族肿瘤史
* @param string $hrb02_02_027  妇科及乳腺不适症状代码
* @param decimal $hrb02_02_028  心率（次/分钟）
* @param decimal $hrb02_02_029  收缩压(mmHg)
* @param decimal $hrb02_02_030  舒张压(mmHg)
* @param decimal $hrb02_02_031  初潮年龄（岁）
* @param decimal $hrb02_02_032  月经周期（d）
* @param decimal $hrb02_02_033  月经持续时间（d）
* @param string $hrb02_02_034  月经出血量类别代码
* @param boolean $hrb02_02_035  痛经标志
* @param date $hrb02_02_036  末次月经日期
* @param boolean $hrb02_02_037  绝经标志
* @param boolean $hrb02_02_038  手术绝经标志
* @param decimal $hrb02_02_039  绝经年龄（岁）
* @param decimal $hrb02_02_040  孕次
* @param decimal $hrb02_02_041  产次
* @param decimal $hrb02_02_042  自然流产次数
* @param decimal $hrb02_02_043  人工流产次数
* @param decimal $hrb02_02_044  阴道助产次数
* @param decimal $hrb02_02_045  剖宫产次数
* @param decimal $hrb02_02_046  死胎例数
* @param decimal $hrb02_02_047  死产例数
* @param decimal $hrb02_02_048  出生缺陷儿例数
* @param date $hrb02_02_049  末次妊娠终止日期
* @param string $hrb02_02_050  末次妊娠终止方式代码
* @param date $hrb02_02_051  末次分娩日期
* @param string $hrb02_02_052  末次分娩方式代码
* @param string $hrb02_02_053  避孕方式代码
* @param string $hrb02_02_054  左侧附件检查结果代码
* @param string $hrb02_02_055  右侧附件检查结果代码
* @param string $hrb02_02_056  宫颈检查结果
* @param string $hrb02_02_057  阴道检查结果
* @param string $hrb02_02_058  外阴检查结果
* @param string $hrb02_02_059  子宫检查结果
* @param string $hrb02_02_060  左侧乳腺检查结果代码
* @param string $hrb02_02_061  右侧乳腺检查结果代码
* @param string $hrb02_02_062  阴道细胞学诊断结果代码
* @param string $hrb02_02_063  乳腺X线检查结果
* @param string $hrb02_02_064  乳腺B超检查结果
* @param string $hrb02_02_065  阴道镜检查结果
* @param string $hrb02_02_066  阴道分泌物性状描述
* @param string $hrb02_02_067  滴虫检测结果代码
* @param string $hrb02_02_068  念珠菌检测结果代码
* @param string $hrb02_02_069  阴道分泌物清洁度代码
* @param string $hrb02_02_070  淋球菌检查结果
* @param string $hrb02_02_071  梅毒血清学试验结果代码
* @param string $hrb02_02_072  体检结果
* @param string $hrb02_02_073  处理及指导意见
* @param string $hrb02_02_074  主检医师姓名
* @param date $hrb02_02_075  检查（测）日期
* @param string $hrb02_02_076  检查（测）人员姓名
* @param string $hrb02_02_077  检查（测）机构名称
* @return boolean
*/
function update_hrb02_02($ws_id,$org_id,$doctor_id,$identity_number,$hrb02_02_001='',$hrb02_02_002='',$hrb02_02_003='',$hrb02_02_004='',$hrb02_02_005='',$hrb02_02_006='',$hrb02_02_007='',$hrb02_02_008='',$hrb02_02_009='',$hrb02_02_010='',$hrb02_02_011='',$hrb02_02_012='',$hrb02_02_013='',$hrb02_02_014='',$hrb02_02_015='',$hrb02_02_016='',$hrb02_02_017='',$hrb02_02_018='',$hrb02_02_019='',$hrb02_02_020='',$hrb02_02_021='',$hrb02_02_022='',$hrb02_02_023='',$hrb02_02_024='',$hrb02_02_025='',$hrb02_02_026='',$hrb02_02_027='',$hrb02_02_028=0,$hrb02_02_029=0,$hrb02_02_030=0,$hrb02_02_031=0,$hrb02_02_032=0,$hrb02_02_033=0,$hrb02_02_034='',$hrb02_02_035=false,$hrb02_02_036='',$hrb02_02_037=false,$hrb02_02_038=false,$hrb02_02_039=0,$hrb02_02_040=0,$hrb02_02_041=0,$hrb02_02_042=0,$hrb02_02_043=0,$hrb02_02_044=0,$hrb02_02_045=0,$hrb02_02_046=0,$hrb02_02_047=0,$hrb02_02_048=0,$hrb02_02_049='',$hrb02_02_050='',$hrb02_02_051='',$hrb02_02_052='',$hrb02_02_053='',$hrb02_02_054='',$hrb02_02_055='',$hrb02_02_056='',$hrb02_02_057='',$hrb02_02_058='',$hrb02_02_059='',$hrb02_02_060='',$hrb02_02_061='',$hrb02_02_062='',$hrb02_02_063='',$hrb02_02_064='',$hrb02_02_065='',$hrb02_02_066='',$hrb02_02_067='',$hrb02_02_068='',$hrb02_02_069='',$hrb02_02_070='',$hrb02_02_071='',$hrb02_02_072='',$hrb02_02_073='',$hrb02_02_074='',$hrb02_02_075='',$hrb02_02_076='',$hrb02_02_077=''){
require_once(__SITEROOT.'library/Models/ws_hrb02_02.php');
$table_obj="Tws_hrb02_02";
$ws_hrb02_02=new $table_obj();
$ws_hrb02_02 -> ws_id=$ws_id;
$ws_hrb02_02 -> uuid=uniqid('',true);
$ws_hrb02_02 -> created=time();
$ws_hrb02_02 -> org_id=$org_id;
$ws_hrb02_02 -> doctor_id=$doctor_id;
$ws_hrb02_02 -> identity_number=$identity_number;//身份证号
$ws_hrb02_02 -> action='insert';
$ws_hrb02_02->hrb02_02_001 = $hrb02_02_001; //记录表单编号 
$ws_hrb02_02->hrb02_02_002 = $hrb02_02_002; //姓名 
$ws_hrb02_02 ->hrb02_02_003 = empty($hrb02_02_003)?null : $ws_hrb02_02 ->escape('hrb02_02_003',to_date($hrb02_02_003,'YYYY-MM-DD')); //出生日期 
$ws_hrb02_02->hrb02_02_004 = $hrb02_02_004; //民族代码 
$ws_hrb02_02->hrb02_02_005 = $hrb02_02_005; //职业类别代码(国标) 
$ws_hrb02_02->hrb02_02_006 = $hrb02_02_006; //工作单位名称 
$ws_hrb02_02->hrb02_02_007 = $hrb02_02_007; //文化程度代码 
$ws_hrb02_02->hrb02_02_008 = $hrb02_02_008; //身份证件-类别代码 
$ws_hrb02_02->hrb02_02_009 = $hrb02_02_009; //身份证件-号码 
$ws_hrb02_02->hrb02_02_010 = $hrb02_02_010; //婚姻状况类别代码 
$ws_hrb02_02->hrb02_02_011 = $hrb02_02_011; //地址类别代码 
$ws_hrb02_02->hrb02_02_012 = $hrb02_02_012; //行政区划代码 
$ws_hrb02_02->hrb02_02_013 = $hrb02_02_013; //地址-省（自治区、直辖市） 
$ws_hrb02_02->hrb02_02_014 = $hrb02_02_014; //地址-市（地区） 
$ws_hrb02_02->hrb02_02_015 = $hrb02_02_015; //地址-县（区） 
$ws_hrb02_02->hrb02_02_016 = $hrb02_02_016; //地址-乡（镇、街道办事处） 
$ws_hrb02_02->hrb02_02_017 = $hrb02_02_017; //地址-村（街、路、弄等） 
$ws_hrb02_02->hrb02_02_018 = $hrb02_02_018; //地址-门牌号码 
$ws_hrb02_02->hrb02_02_019 = $hrb02_02_019; //邮政编码 
$ws_hrb02_02->hrb02_02_020 = $hrb02_02_020; //联系电话-类别 
$ws_hrb02_02->hrb02_02_021 = $hrb02_02_021; //联系电话-类别代码 
$ws_hrb02_02->hrb02_02_022 = $hrb02_02_022; //联系电话-号码 
$ws_hrb02_02->hrb02_02_023 = $hrb02_02_023; //性交出血史 
$ws_hrb02_02->hrb02_02_024 = $hrb02_02_024; //妊娠合并症/并发症史 
$ws_hrb02_02->hrb02_02_025 = $hrb02_02_025; //既往疾病史 
$ws_hrb02_02->hrb02_02_026 = $hrb02_02_026; //家族肿瘤史 
$ws_hrb02_02->hrb02_02_027 = $hrb02_02_027; //妇科及乳腺不适症状代码 
$ws_hrb02_02->hrb02_02_028 = $hrb02_02_028; //心率（次/分钟） 
$ws_hrb02_02->hrb02_02_029 = $hrb02_02_029; //收缩压(mmHg) 
$ws_hrb02_02->hrb02_02_030 = $hrb02_02_030; //舒张压(mmHg) 
$ws_hrb02_02->hrb02_02_031 = $hrb02_02_031; //初潮年龄（岁） 
$ws_hrb02_02->hrb02_02_032 = $hrb02_02_032; //月经周期（d） 
$ws_hrb02_02->hrb02_02_033 = $hrb02_02_033; //月经持续时间（d） 
$ws_hrb02_02->hrb02_02_034 = $hrb02_02_034; //月经出血量类别代码 
$ws_hrb02_02->hrb02_02_035 = $hrb02_02_035; //痛经标志 
$ws_hrb02_02 ->hrb02_02_036 = empty($hrb02_02_036)?null : $ws_hrb02_02 ->escape('hrb02_02_036',to_date($hrb02_02_036,'YYYY-MM-DD')); //末次月经日期 
$ws_hrb02_02->hrb02_02_037 = $hrb02_02_037; //绝经标志 
$ws_hrb02_02->hrb02_02_038 = $hrb02_02_038; //手术绝经标志 
$ws_hrb02_02->hrb02_02_039 = $hrb02_02_039; //绝经年龄（岁） 
$ws_hrb02_02->hrb02_02_040 = $hrb02_02_040; //孕次 
$ws_hrb02_02->hrb02_02_041 = $hrb02_02_041; //产次 
$ws_hrb02_02->hrb02_02_042 = $hrb02_02_042; //自然流产次数 
$ws_hrb02_02->hrb02_02_043 = $hrb02_02_043; //人工流产次数 
$ws_hrb02_02->hrb02_02_044 = $hrb02_02_044; //阴道助产次数 
$ws_hrb02_02->hrb02_02_045 = $hrb02_02_045; //剖宫产次数 
$ws_hrb02_02->hrb02_02_046 = $hrb02_02_046; //死胎例数 
$ws_hrb02_02->hrb02_02_047 = $hrb02_02_047; //死产例数 
$ws_hrb02_02->hrb02_02_048 = $hrb02_02_048; //出生缺陷儿例数 
$ws_hrb02_02 ->hrb02_02_049 = empty($hrb02_02_049)?null : $ws_hrb02_02 ->escape('hrb02_02_049',to_date($hrb02_02_049,'YYYY-MM-DD')); //末次妊娠终止日期 
$ws_hrb02_02->hrb02_02_050 = $hrb02_02_050; //末次妊娠终止方式代码 
$ws_hrb02_02 ->hrb02_02_051 = empty($hrb02_02_051)?null : $ws_hrb02_02 ->escape('hrb02_02_051',to_date($hrb02_02_051,'YYYY-MM-DD')); //末次分娩日期 
$ws_hrb02_02->hrb02_02_052 = $hrb02_02_052; //末次分娩方式代码 
$ws_hrb02_02->hrb02_02_053 = $hrb02_02_053; //避孕方式代码 
$ws_hrb02_02->hrb02_02_054 = $hrb02_02_054; //左侧附件检查结果代码 
$ws_hrb02_02->hrb02_02_055 = $hrb02_02_055; //右侧附件检查结果代码 
$ws_hrb02_02->hrb02_02_056 = $hrb02_02_056; //宫颈检查结果 
$ws_hrb02_02->hrb02_02_057 = $hrb02_02_057; //阴道检查结果 
$ws_hrb02_02->hrb02_02_058 = $hrb02_02_058; //外阴检查结果 
$ws_hrb02_02->hrb02_02_059 = $hrb02_02_059; //子宫检查结果 
$ws_hrb02_02->hrb02_02_060 = $hrb02_02_060; //左侧乳腺检查结果代码 
$ws_hrb02_02->hrb02_02_061 = $hrb02_02_061; //右侧乳腺检查结果代码 
$ws_hrb02_02->hrb02_02_062 = $hrb02_02_062; //阴道细胞学诊断结果代码 
$ws_hrb02_02->hrb02_02_063 = $hrb02_02_063; //乳腺X线检查结果 
$ws_hrb02_02->hrb02_02_064 = $hrb02_02_064; //乳腺B超检查结果 
$ws_hrb02_02->hrb02_02_065 = $hrb02_02_065; //阴道镜检查结果 
$ws_hrb02_02->hrb02_02_066 = $hrb02_02_066; //阴道分泌物性状描述 
$ws_hrb02_02->hrb02_02_067 = $hrb02_02_067; //滴虫检测结果代码 
$ws_hrb02_02->hrb02_02_068 = $hrb02_02_068; //念珠菌检测结果代码 
$ws_hrb02_02->hrb02_02_069 = $hrb02_02_069; //阴道分泌物清洁度代码 
$ws_hrb02_02->hrb02_02_070 = $hrb02_02_070; //淋球菌检查结果 
$ws_hrb02_02->hrb02_02_071 = $hrb02_02_071; //梅毒血清学试验结果代码 
$ws_hrb02_02->hrb02_02_072 = $hrb02_02_072; //体检结果 
$ws_hrb02_02->hrb02_02_073 = $hrb02_02_073; //处理及指导意见 
$ws_hrb02_02->hrb02_02_074 = $hrb02_02_074; //主检医师姓名 
$ws_hrb02_02 ->hrb02_02_075 = empty($hrb02_02_075)?null : $ws_hrb02_02 ->escape('hrb02_02_075',to_date($hrb02_02_075,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrb02_02->hrb02_02_076 = $hrb02_02_076; //检查（测）人员姓名 
$ws_hrb02_02->hrb02_02_077 = $hrb02_02_077; //检查（测）机构名称 
if($ws_hrb02_02 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb02_02 ->free_statement();
}
