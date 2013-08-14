<?php
/**
血吸虫病病人管理基本数据集标准HRB03.05血吸虫病病人管理基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb03_05_001  姓名
* @param string $hrb03_05_002  性别代码
* @param date $hrb03_05_003  出生日期
* @param string $hrb03_05_004  身份证件-类别代码
* @param string $hrb03_05_005  身份证件-号码
* @param string $hrb03_05_006  地址类别代码
* @param string $hrb03_05_007  地址-省（自治区、直辖市）
* @param string $hrb03_05_008  地址-市（地区）
* @param string $hrb03_05_009  地址-县（区）
* @param string $hrb03_05_010  地址-乡（镇、街道办事处）
* @param string $hrb03_05_011  地址-村（街、路、弄等）
* @param string $hrb03_05_012  地址-门牌号码
* @param string $hrb03_05_013  邮政编码
* @param string $hrb03_05_014  文化程度代码
* @param string $hrb03_05_015  职业类别代码(国标)
* @param decimal $hrb03_05_016  身高（cm）
* @param decimal $hrb03_05_017  体重（kg）
* @param decimal $hrb03_05_018  腹围（cm）
* @param boolean $hrb03_05_019  脾切除史标志
* @param date $hrb03_05_020  脾切除日期
* @param boolean $hrb03_05_021  腹水标志
* @param date $hrb03_05_022  末次腹水日期
* @param boolean $hrb03_05_023  上消化道出血史标志
* @param date $hrb03_05_024  末次上消化道出血日期
* @param boolean $hrb03_05_025  肝昏迷史标志
* @param date $hrb03_05_026  末次肝昏迷日期
* @param boolean $hrb03_05_027  肝炎标志
* @param string $hrb03_05_028  肝炎类型代码
* @param string $hrb03_05_029  血吸虫病合并症代码
* @param boolean $hrb03_05_030  既往救治情况标志
* @param date $hrb03_05_031  外科救治日期
* @param date $hrb03_05_032  内科救治日期
* @param date $hrb03_05_033  感染日期
* @param string $hrb03_05_034  血吸虫病感染地点
* @param string $hrb03_05_035  血吸虫病感染环境名称
* @param string $hrb03_05_036  血吸虫病感染方式代码
* @param date $hrb03_05_037  首次出现症状日期
* @param boolean $hrb03_05_038  发热标志
* @param boolean $hrb03_05_039  咳嗽标志
* @param boolean $hrb03_05_040  头痛标志
* @param boolean $hrb03_05_041  头昏标志
* @param boolean $hrb03_05_042  腹痛标志
* @param boolean $hrb03_05_043  腹泻标志
* @param boolean $hrb03_05_044  腹胀标志
* @param boolean $hrb03_05_045  恶心标志
* @param boolean $hrb03_05_046  呕吐标志
* @param boolean $hrb03_05_047  呕血标志
* @param boolean $hrb03_05_048  便血标志
* @param boolean $hrb03_05_049  黄疸标志
* @param boolean $hrb03_05_050  腹壁静脉显露标志
* @param string $hrb03_05_051  肝质地类别代码
* @param decimal $hrb03_05_052  肝脏剑突下测量值（cm）
* @param decimal $hrb03_05_053  肝脏肋下测量值（cm）
* @param string $hrb03_05_054  脾质地类别代码
* @param string $hrb03_05_055  脾肿大分级代码
* @param decimal $hrb03_05_056  血小板计数值(G/L)
* @param decimal $hrb03_05_057  红细胞计数值（G/L）
* @param decimal $hrb03_05_058  白细胞计数值(G/L)
* @param decimal $hrb03_05_059  中性粒细胞百分率（％）
* @param decimal $hrb03_05_060  淋巴细胞百分率（％）
* @param decimal $hrb03_05_061  嗜酸性粒细胞百分率（％）
* @param string $hrb03_05_062  贫血分级代码
* @param string $hrb03_05_063  血吸虫病检查方法代码
* @param string $hrb03_05_064  血吸虫病免疫学检查方法代码
* @param string $hrb03_05_065  血吸虫病原学检查方法代码
* @param string $hrb03_05_066  血吸虫病检查结果代码
* @param date $hrb03_05_067  检查（测）日期
* @param boolean $hrb03_05_068  B超检查标志
* @param decimal $hrb03_05_069  肝脏前后径（cm）
* @param decimal $hrb03_05_070  肝脏斜径（cm）
* @param string $hrb03_05_071  实质纤维化程度代码
* @param decimal $hrb03_05_072  门静脉内径（mm）
* @param decimal $hrb03_05_073  脾脏长径（cm）
* @param decimal $hrb03_05_074  脾脏厚度（cm）
* @param decimal $hrb03_05_075  脾脏肋下（cm）
* @param string $hrb03_05_076  诊断状态代码
* @param date $hrb03_05_077  诊断日期
* @param date $hrb03_05_078  首次诊断日期
* @param string $hrb03_05_079  首次诊断血吸虫病依据代码
* @param date $hrb03_05_080  首次确诊日期
* @param string $hrb03_05_081  首次诊断为晚期血吸虫病病例类型代码
* @param boolean $hrb03_05_082  病原治疗标志
* @param decimal $hrb03_05_083  病原治疗次数
* @param date $hrb03_05_084  末次血吸虫病原治疗日期
* @param string $hrb03_05_085  血吸虫病治疗方案代码
* @param string $hrb03_05_086  药物名称
* @param decimal $hrb03_05_087  治疗药物剂量（mg/kg）
* @param decimal $hrb03_05_088  治疗药物疗程（d）
* @param string $hrb03_05_089  血吸虫病诊断机构级别代码
* @param string $hrb03_05_090  血吸虫病治疗机构级别代码
* @param string $hrb03_05_091  劳动能力分级代码
* @param string $hrb03_05_092  血吸虫病转归代码
* @param string $hrb03_05_093  根本死因代码
* @param string $hrb03_05_094  门诊费用-分类
* @param string $hrb03_05_095  门诊费用-分类代码
* @param decimal $hrb03_05_096  门诊费用-金额（元/人民币）
* @param string $hrb03_05_097  门诊费用-支付方式代码
* @param string $hrb03_05_098  住院费用-分类
* @param string $hrb03_05_099  住院费用-分类代码
* @param decimal $hrb03_05_100  住院费用-金额（元/人民币）
* @param string $hrb03_05_101  住院费用-医疗付款方式代码
* @param decimal $hrb03_05_102  个人承担费用（元/人民币） 
* @param string $hrb03_05_103  调查者姓名
* @param date $hrb03_05_104  调查日期
* @return boolean
*/
function update_hrb03_05($ws_id,$org_id,$doctor_id,$identity_number,$hrb03_05_001='',$hrb03_05_002='',$hrb03_05_003='',$hrb03_05_004='',$hrb03_05_005='',$hrb03_05_006='',$hrb03_05_007='',$hrb03_05_008='',$hrb03_05_009='',$hrb03_05_010='',$hrb03_05_011='',$hrb03_05_012='',$hrb03_05_013='',$hrb03_05_014='',$hrb03_05_015='',$hrb03_05_016=0,$hrb03_05_017=0,$hrb03_05_018=0,$hrb03_05_019=false,$hrb03_05_020='',$hrb03_05_021=false,$hrb03_05_022='',$hrb03_05_023=false,$hrb03_05_024='',$hrb03_05_025=false,$hrb03_05_026='',$hrb03_05_027=false,$hrb03_05_028='',$hrb03_05_029='',$hrb03_05_030=false,$hrb03_05_031='',$hrb03_05_032='',$hrb03_05_033='',$hrb03_05_034='',$hrb03_05_035='',$hrb03_05_036='',$hrb03_05_037='',$hrb03_05_038=false,$hrb03_05_039=false,$hrb03_05_040=false,$hrb03_05_041=false,$hrb03_05_042=false,$hrb03_05_043=false,$hrb03_05_044=false,$hrb03_05_045=false,$hrb03_05_046=false,$hrb03_05_047=false,$hrb03_05_048=false,$hrb03_05_049=false,$hrb03_05_050=false,$hrb03_05_051='',$hrb03_05_052=0,$hrb03_05_053=0,$hrb03_05_054='',$hrb03_05_055='',$hrb03_05_056=0,$hrb03_05_057=0,$hrb03_05_058=0,$hrb03_05_059=0,$hrb03_05_060=0,$hrb03_05_061=0,$hrb03_05_062='',$hrb03_05_063='',$hrb03_05_064='',$hrb03_05_065='',$hrb03_05_066='',$hrb03_05_067='',$hrb03_05_068=false,$hrb03_05_069=0,$hrb03_05_070=0,$hrb03_05_071='',$hrb03_05_072=0,$hrb03_05_073=0,$hrb03_05_074=0,$hrb03_05_075=0,$hrb03_05_076='',$hrb03_05_077='',$hrb03_05_078='',$hrb03_05_079='',$hrb03_05_080='',$hrb03_05_081='',$hrb03_05_082=false,$hrb03_05_083=0,$hrb03_05_084='',$hrb03_05_085='',$hrb03_05_086='',$hrb03_05_087=0,$hrb03_05_088=0,$hrb03_05_089='',$hrb03_05_090='',$hrb03_05_091='',$hrb03_05_092='',$hrb03_05_093='',$hrb03_05_094='',$hrb03_05_095='',$hrb03_05_096=0,$hrb03_05_097='',$hrb03_05_098='',$hrb03_05_099='',$hrb03_05_100=0,$hrb03_05_101='',$hrb03_05_102=0,$hrb03_05_103='',$hrb03_05_104=''){
require_once(__SITEROOT.'library/Models/ws_hrb03_05.php');
$table_obj="Tws_hrb03_05";
$ws_hrb03_05=new $table_obj();
$ws_hrb03_05 -> ws_id=$ws_id;
$ws_hrb03_05 -> uuid=uniqid('',true);
$ws_hrb03_05 -> created=time();
$ws_hrb03_05 -> org_id=$org_id;
$ws_hrb03_05 -> doctor_id=$doctor_id;
$ws_hrb03_05 -> identity_number=$identity_number;//身份证号
$ws_hrb03_05 -> action='insert';
$ws_hrb03_05->hrb03_05_001 = $hrb03_05_001; //姓名 
$ws_hrb03_05->hrb03_05_002 = $hrb03_05_002; //性别代码 
$ws_hrb03_05 ->hrb03_05_003 = empty($hrb03_05_003)?null : $ws_hrb03_05 ->escape('hrb03_05_003',to_date($hrb03_05_003,'YYYY-MM-DD')); //出生日期 
$ws_hrb03_05->hrb03_05_004 = $hrb03_05_004; //身份证件-类别代码 
$ws_hrb03_05->hrb03_05_005 = $hrb03_05_005; //身份证件-号码 
$ws_hrb03_05->hrb03_05_006 = $hrb03_05_006; //地址类别代码 
$ws_hrb03_05->hrb03_05_007 = $hrb03_05_007; //地址-省（自治区、直辖市） 
$ws_hrb03_05->hrb03_05_008 = $hrb03_05_008; //地址-市（地区） 
$ws_hrb03_05->hrb03_05_009 = $hrb03_05_009; //地址-县（区） 
$ws_hrb03_05->hrb03_05_010 = $hrb03_05_010; //地址-乡（镇、街道办事处） 
$ws_hrb03_05->hrb03_05_011 = $hrb03_05_011; //地址-村（街、路、弄等） 
$ws_hrb03_05->hrb03_05_012 = $hrb03_05_012; //地址-门牌号码 
$ws_hrb03_05->hrb03_05_013 = $hrb03_05_013; //邮政编码 
$ws_hrb03_05->hrb03_05_014 = $hrb03_05_014; //文化程度代码 
$ws_hrb03_05->hrb03_05_015 = $hrb03_05_015; //职业类别代码(国标) 
$ws_hrb03_05->hrb03_05_016 = $hrb03_05_016; //身高（cm） 
$ws_hrb03_05->hrb03_05_017 = $hrb03_05_017; //体重（kg） 
$ws_hrb03_05->hrb03_05_018 = $hrb03_05_018; //腹围（cm） 
$ws_hrb03_05->hrb03_05_019 = $hrb03_05_019; //脾切除史标志 
$ws_hrb03_05 ->hrb03_05_020 = empty($hrb03_05_020)?null : $ws_hrb03_05 ->escape('hrb03_05_020',to_date($hrb03_05_020,'YYYY-MM-DD')); //脾切除日期 
$ws_hrb03_05->hrb03_05_021 = $hrb03_05_021; //腹水标志 
$ws_hrb03_05 ->hrb03_05_022 = empty($hrb03_05_022)?null : $ws_hrb03_05 ->escape('hrb03_05_022',to_date($hrb03_05_022,'YYYY-MM-DD')); //末次腹水日期 
$ws_hrb03_05->hrb03_05_023 = $hrb03_05_023; //上消化道出血史标志 
$ws_hrb03_05 ->hrb03_05_024 = empty($hrb03_05_024)?null : $ws_hrb03_05 ->escape('hrb03_05_024',to_date($hrb03_05_024,'YYYY-MM-DD')); //末次上消化道出血日期 
$ws_hrb03_05->hrb03_05_025 = $hrb03_05_025; //肝昏迷史标志 
$ws_hrb03_05 ->hrb03_05_026 = empty($hrb03_05_026)?null : $ws_hrb03_05 ->escape('hrb03_05_026',to_date($hrb03_05_026,'YYYY-MM-DD')); //末次肝昏迷日期 
$ws_hrb03_05->hrb03_05_027 = $hrb03_05_027; //肝炎标志 
$ws_hrb03_05->hrb03_05_028 = $hrb03_05_028; //肝炎类型代码 
$ws_hrb03_05->hrb03_05_029 = $hrb03_05_029; //血吸虫病合并症代码 
$ws_hrb03_05->hrb03_05_030 = $hrb03_05_030; //既往救治情况标志 
$ws_hrb03_05 ->hrb03_05_031 = empty($hrb03_05_031)?null : $ws_hrb03_05 ->escape('hrb03_05_031',to_date($hrb03_05_031,'YYYY-MM-DD')); //外科救治日期 
$ws_hrb03_05 ->hrb03_05_032 = empty($hrb03_05_032)?null : $ws_hrb03_05 ->escape('hrb03_05_032',to_date($hrb03_05_032,'YYYY-MM-DD')); //内科救治日期 
$ws_hrb03_05 ->hrb03_05_033 = empty($hrb03_05_033)?null : $ws_hrb03_05 ->escape('hrb03_05_033',to_date($hrb03_05_033,'YYYY-MM-DD')); //感染日期 
$ws_hrb03_05->hrb03_05_034 = $hrb03_05_034; //血吸虫病感染地点 
$ws_hrb03_05->hrb03_05_035 = $hrb03_05_035; //血吸虫病感染环境名称 
$ws_hrb03_05->hrb03_05_036 = $hrb03_05_036; //血吸虫病感染方式代码 
$ws_hrb03_05 ->hrb03_05_037 = empty($hrb03_05_037)?null : $ws_hrb03_05 ->escape('hrb03_05_037',to_date($hrb03_05_037,'YYYY-MM-DD')); //首次出现症状日期 
$ws_hrb03_05->hrb03_05_038 = $hrb03_05_038; //发热标志 
$ws_hrb03_05->hrb03_05_039 = $hrb03_05_039; //咳嗽标志 
$ws_hrb03_05->hrb03_05_040 = $hrb03_05_040; //头痛标志 
$ws_hrb03_05->hrb03_05_041 = $hrb03_05_041; //头昏标志 
$ws_hrb03_05->hrb03_05_042 = $hrb03_05_042; //腹痛标志 
$ws_hrb03_05->hrb03_05_043 = $hrb03_05_043; //腹泻标志 
$ws_hrb03_05->hrb03_05_044 = $hrb03_05_044; //腹胀标志 
$ws_hrb03_05->hrb03_05_045 = $hrb03_05_045; //恶心标志 
$ws_hrb03_05->hrb03_05_046 = $hrb03_05_046; //呕吐标志 
$ws_hrb03_05->hrb03_05_047 = $hrb03_05_047; //呕血标志 
$ws_hrb03_05->hrb03_05_048 = $hrb03_05_048; //便血标志 
$ws_hrb03_05->hrb03_05_049 = $hrb03_05_049; //黄疸标志 
$ws_hrb03_05->hrb03_05_050 = $hrb03_05_050; //腹壁静脉显露标志 
$ws_hrb03_05->hrb03_05_051 = $hrb03_05_051; //肝质地类别代码 
$ws_hrb03_05->hrb03_05_052 = $hrb03_05_052; //肝脏剑突下测量值（cm） 
$ws_hrb03_05->hrb03_05_053 = $hrb03_05_053; //肝脏肋下测量值（cm） 
$ws_hrb03_05->hrb03_05_054 = $hrb03_05_054; //脾质地类别代码 
$ws_hrb03_05->hrb03_05_055 = $hrb03_05_055; //脾肿大分级代码 
$ws_hrb03_05->hrb03_05_056 = $hrb03_05_056; //血小板计数值(G/L) 
$ws_hrb03_05->hrb03_05_057 = $hrb03_05_057; //红细胞计数值（G/L） 
$ws_hrb03_05->hrb03_05_058 = $hrb03_05_058; //白细胞计数值(G/L) 
$ws_hrb03_05->hrb03_05_059 = $hrb03_05_059; //中性粒细胞百分率（％） 
$ws_hrb03_05->hrb03_05_060 = $hrb03_05_060; //淋巴细胞百分率（％） 
$ws_hrb03_05->hrb03_05_061 = $hrb03_05_061; //嗜酸性粒细胞百分率（％） 
$ws_hrb03_05->hrb03_05_062 = $hrb03_05_062; //贫血分级代码 
$ws_hrb03_05->hrb03_05_063 = $hrb03_05_063; //血吸虫病检查方法代码 
$ws_hrb03_05->hrb03_05_064 = $hrb03_05_064; //血吸虫病免疫学检查方法代码 
$ws_hrb03_05->hrb03_05_065 = $hrb03_05_065; //血吸虫病原学检查方法代码 
$ws_hrb03_05->hrb03_05_066 = $hrb03_05_066; //血吸虫病检查结果代码 
$ws_hrb03_05 ->hrb03_05_067 = empty($hrb03_05_067)?null : $ws_hrb03_05 ->escape('hrb03_05_067',to_date($hrb03_05_067,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrb03_05->hrb03_05_068 = $hrb03_05_068; //B超检查标志 
$ws_hrb03_05->hrb03_05_069 = $hrb03_05_069; //肝脏前后径（cm） 
$ws_hrb03_05->hrb03_05_070 = $hrb03_05_070; //肝脏斜径（cm） 
$ws_hrb03_05->hrb03_05_071 = $hrb03_05_071; //实质纤维化程度代码 
$ws_hrb03_05->hrb03_05_072 = $hrb03_05_072; //门静脉内径（mm） 
$ws_hrb03_05->hrb03_05_073 = $hrb03_05_073; //脾脏长径（cm） 
$ws_hrb03_05->hrb03_05_074 = $hrb03_05_074; //脾脏厚度（cm） 
$ws_hrb03_05->hrb03_05_075 = $hrb03_05_075; //脾脏肋下（cm） 
$ws_hrb03_05->hrb03_05_076 = $hrb03_05_076; //诊断状态代码 
$ws_hrb03_05 ->hrb03_05_077 = empty($hrb03_05_077)?null : $ws_hrb03_05 ->escape('hrb03_05_077',to_date($hrb03_05_077,'YYYY-MM-DD')); //诊断日期 
$ws_hrb03_05 ->hrb03_05_078 = empty($hrb03_05_078)?null : $ws_hrb03_05 ->escape('hrb03_05_078',to_date($hrb03_05_078,'YYYY-MM-DD')); //首次诊断日期 
$ws_hrb03_05->hrb03_05_079 = $hrb03_05_079; //首次诊断血吸虫病依据代码 
$ws_hrb03_05 ->hrb03_05_080 = empty($hrb03_05_080)?null : $ws_hrb03_05 ->escape('hrb03_05_080',to_date($hrb03_05_080,'YYYY-MM-DD')); //首次确诊日期 
$ws_hrb03_05->hrb03_05_081 = $hrb03_05_081; //首次诊断为晚期血吸虫病病例类型代码 
$ws_hrb03_05->hrb03_05_082 = $hrb03_05_082; //病原治疗标志 
$ws_hrb03_05->hrb03_05_083 = $hrb03_05_083; //病原治疗次数 
$ws_hrb03_05 ->hrb03_05_084 = empty($hrb03_05_084)?null : $ws_hrb03_05 ->escape('hrb03_05_084',to_date($hrb03_05_084,'YYYY-MM-DD')); //末次血吸虫病原治疗日期 
$ws_hrb03_05->hrb03_05_085 = $hrb03_05_085; //血吸虫病治疗方案代码 
$ws_hrb03_05->hrb03_05_086 = $hrb03_05_086; //药物名称 
$ws_hrb03_05->hrb03_05_087 = $hrb03_05_087; //治疗药物剂量（mg/kg） 
$ws_hrb03_05->hrb03_05_088 = $hrb03_05_088; //治疗药物疗程（d） 
$ws_hrb03_05->hrb03_05_089 = $hrb03_05_089; //血吸虫病诊断机构级别代码 
$ws_hrb03_05->hrb03_05_090 = $hrb03_05_090; //血吸虫病治疗机构级别代码 
$ws_hrb03_05->hrb03_05_091 = $hrb03_05_091; //劳动能力分级代码 
$ws_hrb03_05->hrb03_05_092 = $hrb03_05_092; //血吸虫病转归代码 
$ws_hrb03_05->hrb03_05_093 = $hrb03_05_093; //根本死因代码 
$ws_hrb03_05->hrb03_05_094 = $hrb03_05_094; //门诊费用-分类 
$ws_hrb03_05->hrb03_05_095 = $hrb03_05_095; //门诊费用-分类代码 
$ws_hrb03_05->hrb03_05_096 = $hrb03_05_096; //门诊费用-金额（元/人民币） 
$ws_hrb03_05->hrb03_05_097 = $hrb03_05_097; //门诊费用-支付方式代码 
$ws_hrb03_05->hrb03_05_098 = $hrb03_05_098; //住院费用-分类 
$ws_hrb03_05->hrb03_05_099 = $hrb03_05_099; //住院费用-分类代码 
$ws_hrb03_05->hrb03_05_100 = $hrb03_05_100; //住院费用-金额（元/人民币） 
$ws_hrb03_05->hrb03_05_101 = $hrb03_05_101; //住院费用-医疗付款方式代码 
$ws_hrb03_05->hrb03_05_102 = $hrb03_05_102; //个人承担费用（元/人民币）  
$ws_hrb03_05->hrb03_05_103 = $hrb03_05_103; //调查者姓名 
$ws_hrb03_05 ->hrb03_05_104 = empty($hrb03_05_104)?null : $ws_hrb03_05 ->escape('hrb03_05_104',to_date($hrb03_05_104,'YYYY-MM-DD')); //调查日期 
if($ws_hrb03_05 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb03_05 ->free_statement();
}
