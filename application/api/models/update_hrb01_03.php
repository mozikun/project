<?php
/**
儿童健康体检基本数据集标准HRB01.03儿童健康体检基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param decimal $hrb01_03_033  抬头月龄
* @param decimal $hrb01_03_034  翻身月龄
* @param decimal $hrb01_03_035  独坐月龄
* @param decimal $hrb01_03_036  爬行月龄
* @param string $hrb01_03_037  ABO血型代码
* @param string $hrb01_03_038  Rh血型代码
* @param string $hrb01_03_039  家族遗传性疾病史
* @param string $hrb01_03_040  患者与本人关系代码
* @param string $hrb01_03_041  过敏史
* @param decimal $hrb01_03_042  儿童体检年龄
* @param string $hrb01_03_043  喂养方式类别代码
* @param string $hrb01_03_044  辅食种类代码
* @param boolean $hrb01_03_045  维生素D/钙剂添加标志
* @param decimal $hrb01_03_046  身高(cm)
* @param decimal $hrb01_03_047  体重（kg）
* @param decimal $hrb01_03_048  头围（cm）
* @param decimal $hrb01_03_049  胸围（cm）
* @param boolean $hrb01_03_050  前囟闭合标志
* @param decimal $hrb01_03_051  前囟横径（cm）
* @param decimal $hrb01_03_052  前囟纵径（cm）
* @param string $hrb01_03_053  心脏听诊结果
* @param string $hrb01_03_054  肺部听诊结果
* @param string $hrb01_03_055  肝脏触诊结果
* @param string $hrb01_03_056  脾脏触诊结果
* @param string $hrb01_03_057  皮肤毛发检查结果
* @param string $hrb01_03_058  浅表淋巴结检查结果
* @param string $hrb01_03_059  四肢检查结果
* @param string $hrb01_03_060  脊柱检查结果
* @param string $hrb01_03_061  腹部检查结果
* @param string $hrb01_03_062  外生殖器检查结果
* @param string $hrb01_03_063  症状
* @param string $hrb01_03_064  体征
* @param boolean $hrb01_03_065  沙眼标志
* @param string $hrb01_03_066  左眼视力
* @param string $hrb01_03_067  右眼视力
* @param string $hrb01_03_068  左耳检查结果
* @param string $hrb01_03_069  右耳检查结果
* @param string $hrb01_03_070  左侧听力检测结果
* @param string $hrb01_03_071  右侧听力检测结果
* @param string $hrb01_03_072  鼻部检查结果
* @param string $hrb01_03_073  咽部检查结果
* @param string $hrb01_03_074  扁桃体检查结果
* @param decimal $hrb01_03_075  出牙月龄
* @param decimal $hrb01_03_076  出牙数（颗）
* @param decimal $hrb01_03_077  龋齿数（颗）
* @param decimal $hrb01_03_078  血红蛋白值（g/L）
* @param string $hrb01_03_079  年龄别体重评价结果代码
* @param string $hrb01_03_080  年龄别身高评价结果代码
* @param string $hrb01_03_081  身高别体重评价结果代码
* @param string $hrb01_03_082  儿童神经精神发育筛查结果
* @param boolean $hrb01_03_083  体弱儿童标志
* @param string $hrb01_03_084  体检结果
* @param string $hrb01_03_085  处理及指导意见
* @param date $hrb01_03_086  检查（测）日期
* @param string $hrb01_03_087  检查（测）人员姓名
* @param string $hrb01_03_088  检查（测）机构名称
* @param date $hrb01_03_089  建档日期
* @param string $hrb01_03_090  建档人员姓名
* @param string $hrb01_03_091  建档机构名称
* @param string $hrb01_03_001  记录表单编号
* @param string $hrb01_03_002  姓名
* @param string $hrb01_03_003  性别代码
* @param date $hrb01_03_004  出生日期
* @param string $hrb01_03_005  父亲姓名
* @param date $hrb01_03_006  父亲出生日期
* @param string $hrb01_03_007  父亲职业类别代码(国标)
* @param string $hrb01_03_008  父亲工作单位名称
* @param string $hrb01_03_009  母亲姓名
* @param date $hrb01_03_010  母亲出生日期
* @param string $hrb01_03_011  母亲职业类别代码(国标)
* @param string $hrb01_03_012  母亲工作单位名称
* @param string $hrb01_03_013  地址类别代码
* @param string $hrb01_03_014  行政区划代码
* @param string $hrb01_03_015  地址-省（自治区、直辖市）
* @param string $hrb01_03_016  地址-市（地区）
* @param string $hrb01_03_017  地址-县（区）
* @param string $hrb01_03_018  地址-乡（镇、街道办事处）
* @param string $hrb01_03_019  地址-村（街、路、弄等）
* @param string $hrb01_03_020  地址-门牌号码
* @param string $hrb01_03_021  邮政编码
* @param string $hrb01_03_022  联系电话-类别
* @param string $hrb01_03_023  联系电话-类别代码
* @param string $hrb01_03_024  联系电话-号码
* @param string $hrb01_03_025  分娩方式代码
* @param decimal $hrb01_03_026  出生孕周
* @param decimal $hrb01_03_027  体重（g）
* @param decimal $hrb01_03_028  身长（cm）
* @param decimal $hrb01_03_029  Apgar评分值（分）
* @param boolean $hrb01_03_030  出生缺陷标志
* @param string $hrb01_03_031  出生缺陷类别代码
* @param string $hrb01_03_032  新生儿疾病筛查结果
* @return boolean
*/
function update_hrb01_03($ws_id,$org_id,$doctor_id,$identity_number,$hrb01_03_033=0,$hrb01_03_034=0,$hrb01_03_035=0,$hrb01_03_036=0,$hrb01_03_037='',$hrb01_03_038='',$hrb01_03_039='',$hrb01_03_040='',$hrb01_03_041='',$hrb01_03_042=0,$hrb01_03_043='',$hrb01_03_044='',$hrb01_03_045=false,$hrb01_03_046=0,$hrb01_03_047=0,$hrb01_03_048=0,$hrb01_03_049=0,$hrb01_03_050=false,$hrb01_03_051=0,$hrb01_03_052=0,$hrb01_03_053='',$hrb01_03_054='',$hrb01_03_055='',$hrb01_03_056='',$hrb01_03_057='',$hrb01_03_058='',$hrb01_03_059='',$hrb01_03_060='',$hrb01_03_061='',$hrb01_03_062='',$hrb01_03_063='',$hrb01_03_064='',$hrb01_03_065=false,$hrb01_03_066='',$hrb01_03_067='',$hrb01_03_068='',$hrb01_03_069='',$hrb01_03_070='',$hrb01_03_071='',$hrb01_03_072='',$hrb01_03_073='',$hrb01_03_074='',$hrb01_03_075=0,$hrb01_03_076=0,$hrb01_03_077=0,$hrb01_03_078=0,$hrb01_03_079='',$hrb01_03_080='',$hrb01_03_081='',$hrb01_03_082='',$hrb01_03_083=false,$hrb01_03_084='',$hrb01_03_085='',$hrb01_03_086='',$hrb01_03_087='',$hrb01_03_088='',$hrb01_03_089='',$hrb01_03_090='',$hrb01_03_091='',$hrb01_03_001='',$hrb01_03_002='',$hrb01_03_003='',$hrb01_03_004='',$hrb01_03_005='',$hrb01_03_006='',$hrb01_03_007='',$hrb01_03_008='',$hrb01_03_009='',$hrb01_03_010='',$hrb01_03_011='',$hrb01_03_012='',$hrb01_03_013='',$hrb01_03_014='',$hrb01_03_015='',$hrb01_03_016='',$hrb01_03_017='',$hrb01_03_018='',$hrb01_03_019='',$hrb01_03_020='',$hrb01_03_021='',$hrb01_03_022='',$hrb01_03_023='',$hrb01_03_024='',$hrb01_03_025='',$hrb01_03_026=0,$hrb01_03_027=0,$hrb01_03_028=0,$hrb01_03_029=0,$hrb01_03_030=false,$hrb01_03_031='',$hrb01_03_032=''){
require_once(__SITEROOT.'library/Models/ws_hrb01_03.php');
$table_obj="Tws_hrb01_03";
$ws_hrb01_03=new $table_obj();
$ws_hrb01_03 -> ws_id=$ws_id;
$ws_hrb01_03 -> uuid=uniqid('',true);
$ws_hrb01_03 -> created=time();
$ws_hrb01_03 -> org_id=$org_id;
$ws_hrb01_03 -> doctor_id=$doctor_id;
$ws_hrb01_03 -> identity_number=$identity_number;//身份证号
$ws_hrb01_03 -> action='insert';
$ws_hrb01_03->hrb01_03_033 = $hrb01_03_033; //抬头月龄 
$ws_hrb01_03->hrb01_03_034 = $hrb01_03_034; //翻身月龄 
$ws_hrb01_03->hrb01_03_035 = $hrb01_03_035; //独坐月龄 
$ws_hrb01_03->hrb01_03_036 = $hrb01_03_036; //爬行月龄 
$ws_hrb01_03->hrb01_03_037 = $hrb01_03_037; //ABO血型代码 
$ws_hrb01_03->hrb01_03_038 = $hrb01_03_038; //Rh血型代码 
$ws_hrb01_03->hrb01_03_039 = $hrb01_03_039; //家族遗传性疾病史 
$ws_hrb01_03->hrb01_03_040 = $hrb01_03_040; //患者与本人关系代码 
$ws_hrb01_03->hrb01_03_041 = $hrb01_03_041; //过敏史 
$ws_hrb01_03->hrb01_03_042 = $hrb01_03_042; //儿童体检年龄 
$ws_hrb01_03->hrb01_03_043 = $hrb01_03_043; //喂养方式类别代码 
$ws_hrb01_03->hrb01_03_044 = $hrb01_03_044; //辅食种类代码 
$ws_hrb01_03->hrb01_03_045 = $hrb01_03_045; //维生素D/钙剂添加标志 
$ws_hrb01_03->hrb01_03_046 = $hrb01_03_046; //身高(cm) 
$ws_hrb01_03->hrb01_03_047 = $hrb01_03_047; //体重（kg） 
$ws_hrb01_03->hrb01_03_048 = $hrb01_03_048; //头围（cm） 
$ws_hrb01_03->hrb01_03_049 = $hrb01_03_049; //胸围（cm） 
$ws_hrb01_03->hrb01_03_050 = $hrb01_03_050; //前囟闭合标志 
$ws_hrb01_03->hrb01_03_051 = $hrb01_03_051; //前囟横径（cm） 
$ws_hrb01_03->hrb01_03_052 = $hrb01_03_052; //前囟纵径（cm） 
$ws_hrb01_03->hrb01_03_053 = $hrb01_03_053; //心脏听诊结果 
$ws_hrb01_03->hrb01_03_054 = $hrb01_03_054; //肺部听诊结果 
$ws_hrb01_03->hrb01_03_055 = $hrb01_03_055; //肝脏触诊结果 
$ws_hrb01_03->hrb01_03_056 = $hrb01_03_056; //脾脏触诊结果 
$ws_hrb01_03->hrb01_03_057 = $hrb01_03_057; //皮肤毛发检查结果 
$ws_hrb01_03->hrb01_03_058 = $hrb01_03_058; //浅表淋巴结检查结果 
$ws_hrb01_03->hrb01_03_059 = $hrb01_03_059; //四肢检查结果 
$ws_hrb01_03->hrb01_03_060 = $hrb01_03_060; //脊柱检查结果 
$ws_hrb01_03->hrb01_03_061 = $hrb01_03_061; //腹部检查结果 
$ws_hrb01_03->hrb01_03_062 = $hrb01_03_062; //外生殖器检查结果 
$ws_hrb01_03->hrb01_03_063 = $hrb01_03_063; //症状 
$ws_hrb01_03->hrb01_03_064 = $hrb01_03_064; //体征 
$ws_hrb01_03->hrb01_03_065 = $hrb01_03_065; //沙眼标志 
$ws_hrb01_03->hrb01_03_066 = $hrb01_03_066; //左眼视力 
$ws_hrb01_03->hrb01_03_067 = $hrb01_03_067; //右眼视力 
$ws_hrb01_03->hrb01_03_068 = $hrb01_03_068; //左耳检查结果 
$ws_hrb01_03->hrb01_03_069 = $hrb01_03_069; //右耳检查结果 
$ws_hrb01_03->hrb01_03_070 = $hrb01_03_070; //左侧听力检测结果 
$ws_hrb01_03->hrb01_03_071 = $hrb01_03_071; //右侧听力检测结果 
$ws_hrb01_03->hrb01_03_072 = $hrb01_03_072; //鼻部检查结果 
$ws_hrb01_03->hrb01_03_073 = $hrb01_03_073; //咽部检查结果 
$ws_hrb01_03->hrb01_03_074 = $hrb01_03_074; //扁桃体检查结果 
$ws_hrb01_03->hrb01_03_075 = $hrb01_03_075; //出牙月龄 
$ws_hrb01_03->hrb01_03_076 = $hrb01_03_076; //出牙数（颗） 
$ws_hrb01_03->hrb01_03_077 = $hrb01_03_077; //龋齿数（颗） 
$ws_hrb01_03->hrb01_03_078 = $hrb01_03_078; //血红蛋白值（g/L） 
$ws_hrb01_03->hrb01_03_079 = $hrb01_03_079; //年龄别体重评价结果代码 
$ws_hrb01_03->hrb01_03_080 = $hrb01_03_080; //年龄别身高评价结果代码 
$ws_hrb01_03->hrb01_03_081 = $hrb01_03_081; //身高别体重评价结果代码 
$ws_hrb01_03->hrb01_03_082 = $hrb01_03_082; //儿童神经精神发育筛查结果 
$ws_hrb01_03->hrb01_03_083 = $hrb01_03_083; //体弱儿童标志 
$ws_hrb01_03->hrb01_03_084 = $hrb01_03_084; //体检结果 
$ws_hrb01_03->hrb01_03_085 = $hrb01_03_085; //处理及指导意见 
$ws_hrb01_03 ->hrb01_03_086 = empty($hrb01_03_086)?null : $ws_hrb01_03 ->escape('hrb01_03_086',to_date($hrb01_03_086,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrb01_03->hrb01_03_087 = $hrb01_03_087; //检查（测）人员姓名 
$ws_hrb01_03->hrb01_03_088 = $hrb01_03_088; //检查（测）机构名称 
$ws_hrb01_03 ->hrb01_03_089 = empty($hrb01_03_089)?null : $ws_hrb01_03 ->escape('hrb01_03_089',to_date($hrb01_03_089,'YYYY-MM-DD')); //建档日期 
$ws_hrb01_03->hrb01_03_090 = $hrb01_03_090; //建档人员姓名 
$ws_hrb01_03->hrb01_03_091 = $hrb01_03_091; //建档机构名称 
$ws_hrb01_03->hrb01_03_001 = $hrb01_03_001; //记录表单编号 
$ws_hrb01_03->hrb01_03_002 = $hrb01_03_002; //姓名 
$ws_hrb01_03->hrb01_03_003 = $hrb01_03_003; //性别代码 
$ws_hrb01_03 ->hrb01_03_004 = empty($hrb01_03_004)?null : $ws_hrb01_03 ->escape('hrb01_03_004',to_date($hrb01_03_004,'YYYY-MM-DD')); //出生日期 
$ws_hrb01_03->hrb01_03_005 = $hrb01_03_005; //父亲姓名 
$ws_hrb01_03 ->hrb01_03_006 = empty($hrb01_03_006)?null : $ws_hrb01_03 ->escape('hrb01_03_006',to_date($hrb01_03_006,'YYYY-MM-DD')); //父亲出生日期 
$ws_hrb01_03->hrb01_03_007 = $hrb01_03_007; //父亲职业类别代码(国标) 
$ws_hrb01_03->hrb01_03_008 = $hrb01_03_008; //父亲工作单位名称 
$ws_hrb01_03->hrb01_03_009 = $hrb01_03_009; //母亲姓名 
$ws_hrb01_03 ->hrb01_03_010 = empty($hrb01_03_010)?null : $ws_hrb01_03 ->escape('hrb01_03_010',to_date($hrb01_03_010,'YYYY-MM-DD')); //母亲出生日期 
$ws_hrb01_03->hrb01_03_011 = $hrb01_03_011; //母亲职业类别代码(国标) 
$ws_hrb01_03->hrb01_03_012 = $hrb01_03_012; //母亲工作单位名称 
$ws_hrb01_03->hrb01_03_013 = $hrb01_03_013; //地址类别代码 
$ws_hrb01_03->hrb01_03_014 = $hrb01_03_014; //行政区划代码 
$ws_hrb01_03->hrb01_03_015 = $hrb01_03_015; //地址-省（自治区、直辖市） 
$ws_hrb01_03->hrb01_03_016 = $hrb01_03_016; //地址-市（地区） 
$ws_hrb01_03->hrb01_03_017 = $hrb01_03_017; //地址-县（区） 
$ws_hrb01_03->hrb01_03_018 = $hrb01_03_018; //地址-乡（镇、街道办事处） 
$ws_hrb01_03->hrb01_03_019 = $hrb01_03_019; //地址-村（街、路、弄等） 
$ws_hrb01_03->hrb01_03_020 = $hrb01_03_020; //地址-门牌号码 
$ws_hrb01_03->hrb01_03_021 = $hrb01_03_021; //邮政编码 
$ws_hrb01_03->hrb01_03_022 = $hrb01_03_022; //联系电话-类别 
$ws_hrb01_03->hrb01_03_023 = $hrb01_03_023; //联系电话-类别代码 
$ws_hrb01_03->hrb01_03_024 = $hrb01_03_024; //联系电话-号码 
$ws_hrb01_03->hrb01_03_025 = $hrb01_03_025; //分娩方式代码 
$ws_hrb01_03->hrb01_03_026 = $hrb01_03_026; //出生孕周 
$ws_hrb01_03->hrb01_03_027 = $hrb01_03_027; //体重（g） 
$ws_hrb01_03->hrb01_03_028 = $hrb01_03_028; //身长（cm） 
$ws_hrb01_03->hrb01_03_029 = $hrb01_03_029; //Apgar评分值（分） 
$ws_hrb01_03->hrb01_03_030 = $hrb01_03_030; //出生缺陷标志 
$ws_hrb01_03->hrb01_03_031 = $hrb01_03_031; //出生缺陷类别代码 
$ws_hrb01_03->hrb01_03_032 = $hrb01_03_032; //新生儿疾病筛查结果 
if($ws_hrb01_03 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb01_03 ->free_statement();
}
