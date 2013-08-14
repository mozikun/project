<?php
/**
成人健康体检基本数据集标准HRC00.04成人健康体检基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrc00_04_001  健康档案标识符
* @param string $hrc00_04_002  姓名
* @param date $hrc00_04_003  出生日期
* @param string $hrc00_04_004  性别代码
* @param string $hrc00_04_005  身份证件-类别代码
* @param string $hrc00_04_006  身份证件-号码
* @param string $hrc00_04_007  婚姻状况类别代码
* @param string $hrc00_04_008  职业类别代码(国标)
* @param string $hrc00_04_009  责任医师姓名
* @param date $hrc00_04_010  检查（测）日期
* @param string $hrc00_04_011  症状代码(健康检查)
* @param decimal $hrc00_04_012  身高(cm)
* @param decimal $hrc00_04_013  体温(℃)
* @param decimal $hrc00_04_014  体重（kg）
* @param decimal $hrc00_04_015  体重指数
* @param decimal $hrc00_04_016  臀围(cm)
* @param decimal $hrc00_04_017  腰围(cm)
* @param decimal $hrc00_04_018  腰臀围比值
* @param decimal $hrc00_04_019  脉率（次/分钟）
* @param decimal $hrc00_04_020  呼吸频率（次/分钟）
* @param string $hrc00_04_021  皮肤巩膜检查结果类别代码
* @param string $hrc00_04_022  口唇外观类别代码
* @param string $hrc00_04_023  齿列类别代码
* @param string $hrc00_04_024  咽部检查结果
* @param string $hrc00_04_025  胸廓类别代码
* @param decimal $hrc00_04_026  左眼矫正远视力值
* @param decimal $hrc00_04_027  左眼裸眼远视力值
* @param decimal $hrc00_04_028  右眼矫正远视力值
* @param decimal $hrc00_04_029  右眼裸眼远视力值
* @param string $hrc00_04_030  听力检测结果
* @param string $hrc00_04_031  运动功能状态代码
* @param boolean $hrc00_04_032  肺部罗音-标志
* @param string $hrc00_04_033  肺部罗音-描述
* @param boolean $hrc00_04_034  肺部异常呼吸音-标志
* @param string $hrc00_04_035  肺部异常呼吸音-描述
* @param boolean $hrc00_04_036  肝大-标志
* @param string $hrc00_04_037  肝大-说明
* @param boolean $hrc00_04_038  脾大-标志
* @param string $hrc00_04_039  脾大-说明
* @param boolean $hrc00_04_040  腹部包块-标志
* @param string $hrc00_04_041  腹部包块-说明
* @param boolean $hrc00_04_042  腹部压痛-标志
* @param string $hrc00_04_043  腹部压痛-说明
* @param boolean $hrc00_04_044  腹部移动性浊音-标志
* @param string $hrc00_04_045  腹部移动性浊音-描述
* @param string $hrc00_04_046  肾区叩痛部位说明
* @param string $hrc00_04_047  肛门指诊检查结果-类别代码
* @param string $hrc00_04_048  肛门指诊检查结果-描述
* @param string $hrc00_04_049  淋巴结检查结果-类别代码
* @param string $hrc00_04_050  淋巴结检查结果-描述
* @param boolean $hrc00_04_051  前列腺异常-标志
* @param boolean $hrc00_04_052  前列腺异常-说明
* @param string $hrc00_04_053  下肢水肿检查结果类别代码
* @param decimal $hrc00_04_054  心率（次/分钟）
* @param string $hrc00_04_055  心律类别代码
* @param boolean $hrc00_04_056  心脏杂音-标志
* @param string $hrc00_04_057  心脏杂音-描述
* @param boolean $hrc00_04_058  眼底检查结果异常标志
* @param string $hrc00_04_059  眼底检查结果
* @param decimal $hrc00_04_060  收缩压(mmHg)
* @param decimal $hrc00_04_061  舒张压(mmHg)
* @param decimal $hrc00_04_062  血红蛋白值（g/L）
* @param decimal $hrc00_04_063  白细胞计数值(G/L)
* @param decimal $hrc00_04_064  血小板计数值(G/L)
* @param decimal $hrc00_04_065  尿比重
* @param string $hrc00_04_066  尿蛋白定性检测结果代码
* @param decimal $hrc00_04_067  尿蛋白定量检测值（mg/24h）
* @param string $hrc00_04_068  尿糖定性检测结果代码
* @param decimal $hrc00_04_069  尿糖定量检测(mmol/L)
* @param string $hrc00_04_070  尿酮体定性检测结果代码
* @param decimal $hrc00_04_071  尿液酸碱度
* @param string $hrc00_04_072  尿潜血检测结果代码
* @param boolean $hrc00_04_073  粪便潜血标志
* @param decimal $hrc00_04_074  空腹血糖值(mmol/L)
* @param decimal $hrc00_04_075  餐后两小时血糖值(mmol/L)
* @param decimal $hrc00_04_076  糖化血红蛋白值(%)
* @param decimal $hrc00_04_077  白蛋白浓度(g/L)
* @param decimal $hrc00_04_078  丙氨酸氨基转移酶检测值(U/L)
* @param decimal $hrc00_04_079  天冬氨酸氨基转移酶检测值(U/L)
* @param decimal $hrc00_04_080  结合胆红素值(μmol/L)
* @param decimal $hrc00_04_081  总胆红素值(μmol/L)
* @param decimal $hrc00_04_082  血钾浓度(mmol/L)
* @param decimal $hrc00_04_083  血钠浓度(mmol/L)
* @param decimal $hrc00_04_084  血尿素氮检测值(mmol/L)
* @param decimal $hrc00_04_085  血肌酐值(μmol/L)
* @param decimal $hrc00_04_086  甘油三酯值(mmol/L)
* @param decimal $hrc00_04_087  血清低密度脂蛋白胆固醇检测值(mmol/L)
* @param decimal $hrc00_04_088  血清高密度脂蛋白胆固醇检测值(mmol/L)
* @param decimal $hrc00_04_089  总胆固醇值(mmol/L)
* @param string $hrc00_04_090  乙型肝炎病毒e抗体检测结果代码
* @param string $hrc00_04_091  乙型肝炎病毒e抗原检测结果代码
* @param string $hrc00_04_092  乙型肝炎病毒表面抗体检测结果代码
* @param string $hrc00_04_093  乙型肝炎病毒表面抗原检测结果代码
* @param string $hrc00_04_094  乙型肝炎病毒核心抗体检测结果代码
* @param decimal $hrc00_04_095  甲胎蛋白值(μg/L)
* @param decimal $hrc00_04_096  癌胚抗原浓度值(μg/L)
* @param decimal $hrc00_04_097  老年人抑郁评分
* @param string $hrc00_04_098  老年人情感状态初筛结果代码
* @param string $hrc00_04_099  老年人认知功能初筛结果代码
* @param decimal $hrc00_04_100  老年人认知功能评分
* @param string $hrc00_04_101  胸部X线检查结果
* @param string $hrc00_04_102  B超检查结果
* @param string $hrc00_04_103  影像检查
* @param boolean $hrc00_04_104  足背动脉搏动标志
* @param boolean $hrc00_04_105  颈静脉怒张标志
* @param boolean $hrc00_04_106  口唇紫绀标志
* @param string $hrc00_04_107  COPD咳嗽症状类别代码
* @param string $hrc00_04_108  COPD咳痰症状类别代码
* @param string $hrc00_04_109  哮鸣音种类代码
* @param string $hrc00_04_110  呼吸困难症状类别代码
* @param decimal $hrc00_04_111  一秒钟用力呼气量(ml)
* @param decimal $hrc00_04_112  一秒钟用力呼气量/最大肺活量比值(%)
* @param decimal $hrc00_04_113  血氧饱和度(%)
* @param decimal $hrc00_04_115  六分钟步行距离(m)
* @param string $hrc00_04_116  体检结果
* @return boolean
*/
function update_hrc00_04($ws_id,$org_id,$doctor_id,$identity_number,$hrc00_04_001='',$hrc00_04_002='',$hrc00_04_003='',$hrc00_04_004='',$hrc00_04_005='',$hrc00_04_006='',$hrc00_04_007='',$hrc00_04_008='',$hrc00_04_009='',$hrc00_04_010='',$hrc00_04_011='',$hrc00_04_012=0,$hrc00_04_013=0,$hrc00_04_014=0,$hrc00_04_015=0,$hrc00_04_016=0,$hrc00_04_017=0,$hrc00_04_018=0,$hrc00_04_019=0,$hrc00_04_020=0,$hrc00_04_021='',$hrc00_04_022='',$hrc00_04_023='',$hrc00_04_024='',$hrc00_04_025='',$hrc00_04_026=0,$hrc00_04_027=0,$hrc00_04_028=0,$hrc00_04_029=0,$hrc00_04_030='',$hrc00_04_031='',$hrc00_04_032=false,$hrc00_04_033='',$hrc00_04_034=false,$hrc00_04_035='',$hrc00_04_036=false,$hrc00_04_037='',$hrc00_04_038=false,$hrc00_04_039='',$hrc00_04_040=false,$hrc00_04_041='',$hrc00_04_042=false,$hrc00_04_043='',$hrc00_04_044=false,$hrc00_04_045='',$hrc00_04_046='',$hrc00_04_047='',$hrc00_04_048='',$hrc00_04_049='',$hrc00_04_050='',$hrc00_04_051=false,$hrc00_04_052=false,$hrc00_04_053='',$hrc00_04_054=0,$hrc00_04_055='',$hrc00_04_056=false,$hrc00_04_057='',$hrc00_04_058=false,$hrc00_04_059='',$hrc00_04_060=0,$hrc00_04_061=0,$hrc00_04_062=0,$hrc00_04_063=0,$hrc00_04_064=0,$hrc00_04_065=0,$hrc00_04_066='',$hrc00_04_067=0,$hrc00_04_068='',$hrc00_04_069=0,$hrc00_04_070='',$hrc00_04_071=0,$hrc00_04_072='',$hrc00_04_073=false,$hrc00_04_074=0,$hrc00_04_075=0,$hrc00_04_076=0,$hrc00_04_077=0,$hrc00_04_078=0,$hrc00_04_079=0,$hrc00_04_080=0,$hrc00_04_081=0,$hrc00_04_082=0,$hrc00_04_083=0,$hrc00_04_084=0,$hrc00_04_085=0,$hrc00_04_086=0,$hrc00_04_087=0,$hrc00_04_088=0,$hrc00_04_089=0,$hrc00_04_090='',$hrc00_04_091='',$hrc00_04_092='',$hrc00_04_093='',$hrc00_04_094='',$hrc00_04_095=0,$hrc00_04_096=0,$hrc00_04_097=0,$hrc00_04_098='',$hrc00_04_099='',$hrc00_04_100=0,$hrc00_04_101='',$hrc00_04_102='',$hrc00_04_103='',$hrc00_04_104=false,$hrc00_04_105=false,$hrc00_04_106=false,$hrc00_04_107='',$hrc00_04_108='',$hrc00_04_109='',$hrc00_04_110='',$hrc00_04_111=0,$hrc00_04_112=0,$hrc00_04_113=0,$hrc00_04_115=0,$hrc00_04_116=''){
require_once(__SITEROOT.'library/Models/ws_hrc00_04.php');
$table_obj="Tws_hrc00_04";
$ws_hrc00_04=new $table_obj();
$ws_hrc00_04 -> ws_id=$ws_id;
$ws_hrc00_04 -> uuid=uniqid('',true);
$ws_hrc00_04 -> created=time();
$ws_hrc00_04 -> org_id=$org_id;
$ws_hrc00_04 -> doctor_id=$doctor_id;
$ws_hrc00_04 -> identity_number=$identity_number;//身份证号
$ws_hrc00_04 -> action='insert';
$ws_hrc00_04->hrc00_04_001 = $hrc00_04_001; //健康档案标识符 
$ws_hrc00_04->hrc00_04_002 = $hrc00_04_002; //姓名 
$ws_hrc00_04 ->hrc00_04_003 = empty($hrc00_04_003)?null : $ws_hrc00_04 ->escape('hrc00_04_003',to_date($hrc00_04_003,'YYYY-MM-DD')); //出生日期 
$ws_hrc00_04->hrc00_04_004 = $hrc00_04_004; //性别代码 
$ws_hrc00_04->hrc00_04_005 = $hrc00_04_005; //身份证件-类别代码 
$ws_hrc00_04->hrc00_04_006 = $hrc00_04_006; //身份证件-号码 
$ws_hrc00_04->hrc00_04_007 = $hrc00_04_007; //婚姻状况类别代码 
$ws_hrc00_04->hrc00_04_008 = $hrc00_04_008; //职业类别代码(国标) 
$ws_hrc00_04->hrc00_04_009 = $hrc00_04_009; //责任医师姓名 
$ws_hrc00_04 ->hrc00_04_010 = empty($hrc00_04_010)?null : $ws_hrc00_04 ->escape('hrc00_04_010',to_date($hrc00_04_010,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrc00_04->hrc00_04_011 = $hrc00_04_011; //症状代码(健康检查) 
$ws_hrc00_04->hrc00_04_012 = $hrc00_04_012; //身高(cm) 
$ws_hrc00_04->hrc00_04_013 = $hrc00_04_013; //体温(℃) 
$ws_hrc00_04->hrc00_04_014 = $hrc00_04_014; //体重（kg） 
$ws_hrc00_04->hrc00_04_015 = $hrc00_04_015; //体重指数 
$ws_hrc00_04->hrc00_04_016 = $hrc00_04_016; //臀围(cm) 
$ws_hrc00_04->hrc00_04_017 = $hrc00_04_017; //腰围(cm) 
$ws_hrc00_04->hrc00_04_018 = $hrc00_04_018; //腰臀围比值 
$ws_hrc00_04->hrc00_04_019 = $hrc00_04_019; //脉率（次/分钟） 
$ws_hrc00_04->hrc00_04_020 = $hrc00_04_020; //呼吸频率（次/分钟） 
$ws_hrc00_04->hrc00_04_021 = $hrc00_04_021; //皮肤巩膜检查结果类别代码 
$ws_hrc00_04->hrc00_04_022 = $hrc00_04_022; //口唇外观类别代码 
$ws_hrc00_04->hrc00_04_023 = $hrc00_04_023; //齿列类别代码 
$ws_hrc00_04->hrc00_04_024 = $hrc00_04_024; //咽部检查结果 
$ws_hrc00_04->hrc00_04_025 = $hrc00_04_025; //胸廓类别代码 
$ws_hrc00_04->hrc00_04_026 = $hrc00_04_026; //左眼矫正远视力值 
$ws_hrc00_04->hrc00_04_027 = $hrc00_04_027; //左眼裸眼远视力值 
$ws_hrc00_04->hrc00_04_028 = $hrc00_04_028; //右眼矫正远视力值 
$ws_hrc00_04->hrc00_04_029 = $hrc00_04_029; //右眼裸眼远视力值 
$ws_hrc00_04->hrc00_04_030 = $hrc00_04_030; //听力检测结果 
$ws_hrc00_04->hrc00_04_031 = $hrc00_04_031; //运动功能状态代码 
$ws_hrc00_04->hrc00_04_032 = $hrc00_04_032; //肺部罗音-标志 
$ws_hrc00_04->hrc00_04_033 = $hrc00_04_033; //肺部罗音-描述 
$ws_hrc00_04->hrc00_04_034 = $hrc00_04_034; //肺部异常呼吸音-标志 
$ws_hrc00_04->hrc00_04_035 = $hrc00_04_035; //肺部异常呼吸音-描述 
$ws_hrc00_04->hrc00_04_036 = $hrc00_04_036; //肝大-标志 
$ws_hrc00_04->hrc00_04_037 = $hrc00_04_037; //肝大-说明 
$ws_hrc00_04->hrc00_04_038 = $hrc00_04_038; //脾大-标志 
$ws_hrc00_04->hrc00_04_039 = $hrc00_04_039; //脾大-说明 
$ws_hrc00_04->hrc00_04_040 = $hrc00_04_040; //腹部包块-标志 
$ws_hrc00_04->hrc00_04_041 = $hrc00_04_041; //腹部包块-说明 
$ws_hrc00_04->hrc00_04_042 = $hrc00_04_042; //腹部压痛-标志 
$ws_hrc00_04->hrc00_04_043 = $hrc00_04_043; //腹部压痛-说明 
$ws_hrc00_04->hrc00_04_044 = $hrc00_04_044; //腹部移动性浊音-标志 
$ws_hrc00_04->hrc00_04_045 = $hrc00_04_045; //腹部移动性浊音-描述 
$ws_hrc00_04->hrc00_04_046 = $hrc00_04_046; //肾区叩痛部位说明 
$ws_hrc00_04->hrc00_04_047 = $hrc00_04_047; //肛门指诊检查结果-类别代码 
$ws_hrc00_04->hrc00_04_048 = $hrc00_04_048; //肛门指诊检查结果-描述 
$ws_hrc00_04->hrc00_04_049 = $hrc00_04_049; //淋巴结检查结果-类别代码 
$ws_hrc00_04->hrc00_04_050 = $hrc00_04_050; //淋巴结检查结果-描述 
$ws_hrc00_04->hrc00_04_051 = $hrc00_04_051; //前列腺异常-标志 
$ws_hrc00_04->hrc00_04_052 = $hrc00_04_052; //前列腺异常-说明 
$ws_hrc00_04->hrc00_04_053 = $hrc00_04_053; //下肢水肿检查结果类别代码 
$ws_hrc00_04->hrc00_04_054 = $hrc00_04_054; //心率（次/分钟） 
$ws_hrc00_04->hrc00_04_055 = $hrc00_04_055; //心律类别代码 
$ws_hrc00_04->hrc00_04_056 = $hrc00_04_056; //心脏杂音-标志 
$ws_hrc00_04->hrc00_04_057 = $hrc00_04_057; //心脏杂音-描述 
$ws_hrc00_04->hrc00_04_058 = $hrc00_04_058; //眼底检查结果异常标志 
$ws_hrc00_04->hrc00_04_059 = $hrc00_04_059; //眼底检查结果 
$ws_hrc00_04->hrc00_04_060 = $hrc00_04_060; //收缩压(mmHg) 
$ws_hrc00_04->hrc00_04_061 = $hrc00_04_061; //舒张压(mmHg) 
$ws_hrc00_04->hrc00_04_062 = $hrc00_04_062; //血红蛋白值（g/L） 
$ws_hrc00_04->hrc00_04_063 = $hrc00_04_063; //白细胞计数值(G/L) 
$ws_hrc00_04->hrc00_04_064 = $hrc00_04_064; //血小板计数值(G/L) 
$ws_hrc00_04->hrc00_04_065 = $hrc00_04_065; //尿比重 
$ws_hrc00_04->hrc00_04_066 = $hrc00_04_066; //尿蛋白定性检测结果代码 
$ws_hrc00_04->hrc00_04_067 = $hrc00_04_067; //尿蛋白定量检测值（mg/24h） 
$ws_hrc00_04->hrc00_04_068 = $hrc00_04_068; //尿糖定性检测结果代码 
$ws_hrc00_04->hrc00_04_069 = $hrc00_04_069; //尿糖定量检测(mmol/L) 
$ws_hrc00_04->hrc00_04_070 = $hrc00_04_070; //尿酮体定性检测结果代码 
$ws_hrc00_04->hrc00_04_071 = $hrc00_04_071; //尿液酸碱度 
$ws_hrc00_04->hrc00_04_072 = $hrc00_04_072; //尿潜血检测结果代码 
$ws_hrc00_04->hrc00_04_073 = $hrc00_04_073; //粪便潜血标志 
$ws_hrc00_04->hrc00_04_074 = $hrc00_04_074; //空腹血糖值(mmol/L) 
$ws_hrc00_04->hrc00_04_075 = $hrc00_04_075; //餐后两小时血糖值(mmol/L) 
$ws_hrc00_04->hrc00_04_076 = $hrc00_04_076; //糖化血红蛋白值(%) 
$ws_hrc00_04->hrc00_04_077 = $hrc00_04_077; //白蛋白浓度(g/L) 
$ws_hrc00_04->hrc00_04_078 = $hrc00_04_078; //丙氨酸氨基转移酶检测值(U/L) 
$ws_hrc00_04->hrc00_04_079 = $hrc00_04_079; //天冬氨酸氨基转移酶检测值(U/L) 
$ws_hrc00_04->hrc00_04_080 = $hrc00_04_080; //结合胆红素值(μmol/L) 
$ws_hrc00_04->hrc00_04_081 = $hrc00_04_081; //总胆红素值(μmol/L) 
$ws_hrc00_04->hrc00_04_082 = $hrc00_04_082; //血钾浓度(mmol/L) 
$ws_hrc00_04->hrc00_04_083 = $hrc00_04_083; //血钠浓度(mmol/L) 
$ws_hrc00_04->hrc00_04_084 = $hrc00_04_084; //血尿素氮检测值(mmol/L) 
$ws_hrc00_04->hrc00_04_085 = $hrc00_04_085; //血肌酐值(μmol/L) 
$ws_hrc00_04->hrc00_04_086 = $hrc00_04_086; //甘油三酯值(mmol/L) 
$ws_hrc00_04->hrc00_04_087 = $hrc00_04_087; //血清低密度脂蛋白胆固醇检测值(mmol/L) 
$ws_hrc00_04->hrc00_04_088 = $hrc00_04_088; //血清高密度脂蛋白胆固醇检测值(mmol/L) 
$ws_hrc00_04->hrc00_04_089 = $hrc00_04_089; //总胆固醇值(mmol/L) 
$ws_hrc00_04->hrc00_04_090 = $hrc00_04_090; //乙型肝炎病毒e抗体检测结果代码 
$ws_hrc00_04->hrc00_04_091 = $hrc00_04_091; //乙型肝炎病毒e抗原检测结果代码 
$ws_hrc00_04->hrc00_04_092 = $hrc00_04_092; //乙型肝炎病毒表面抗体检测结果代码 
$ws_hrc00_04->hrc00_04_093 = $hrc00_04_093; //乙型肝炎病毒表面抗原检测结果代码 
$ws_hrc00_04->hrc00_04_094 = $hrc00_04_094; //乙型肝炎病毒核心抗体检测结果代码 
$ws_hrc00_04->hrc00_04_095 = $hrc00_04_095; //甲胎蛋白值(μg/L) 
$ws_hrc00_04->hrc00_04_096 = $hrc00_04_096; //癌胚抗原浓度值(μg/L) 
$ws_hrc00_04->hrc00_04_097 = $hrc00_04_097; //老年人抑郁评分 
$ws_hrc00_04->hrc00_04_098 = $hrc00_04_098; //老年人情感状态初筛结果代码 
$ws_hrc00_04->hrc00_04_099 = $hrc00_04_099; //老年人认知功能初筛结果代码 
$ws_hrc00_04->hrc00_04_100 = $hrc00_04_100; //老年人认知功能评分 
$ws_hrc00_04->hrc00_04_101 = $hrc00_04_101; //胸部X线检查结果 
$ws_hrc00_04->hrc00_04_102 = $hrc00_04_102; //B超检查结果 
$ws_hrc00_04->hrc00_04_103 = $hrc00_04_103; //影像检查 
$ws_hrc00_04->hrc00_04_104 = $hrc00_04_104; //足背动脉搏动标志 
$ws_hrc00_04->hrc00_04_105 = $hrc00_04_105; //颈静脉怒张标志 
$ws_hrc00_04->hrc00_04_106 = $hrc00_04_106; //口唇紫绀标志 
$ws_hrc00_04->hrc00_04_107 = $hrc00_04_107; //COPD咳嗽症状类别代码 
$ws_hrc00_04->hrc00_04_108 = $hrc00_04_108; //COPD咳痰症状类别代码 
$ws_hrc00_04->hrc00_04_109 = $hrc00_04_109; //哮鸣音种类代码 
$ws_hrc00_04->hrc00_04_110 = $hrc00_04_110; //呼吸困难症状类别代码 
$ws_hrc00_04->hrc00_04_111 = $hrc00_04_111; //一秒钟用力呼气量(ml) 
$ws_hrc00_04->hrc00_04_112 = $hrc00_04_112; //一秒钟用力呼气量/最大肺活量比值(%) 
$ws_hrc00_04->hrc00_04_113 = $hrc00_04_113; //血氧饱和度(%) 
$ws_hrc00_04->hrc00_04_115 = $hrc00_04_115; //六分钟步行距离(m) 
$ws_hrc00_04->hrc00_04_116 = $hrc00_04_116; //体检结果 
if($ws_hrc00_04 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrc00_04 ->free_statement();
}
