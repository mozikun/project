<?php
/**
计划生育技术服务基本数据集标准HRB02.03计划生育技术服务基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb02_03_001  记录表单编号
* @param string $hrb02_03_002  姓名
* @param date $hrb02_03_003  出生日期
* @param string $hrb02_03_004  门诊号
* @param string $hrb02_03_005  住院号
* @param string $hrb02_03_006  职业类别代码(国标)
* @param string $hrb02_03_007  工作单位名称
* @param string $hrb02_03_008  婚姻状况类别代码
* @param string $hrb02_03_009  地址类别代码
* @param string $hrb02_03_010  行政区划代码
* @param string $hrb02_03_011  地址-省（自治区、直辖市）
* @param string $hrb02_03_012  地址-市（地区）
* @param string $hrb02_03_013  地址-县（区）
* @param string $hrb02_03_014  地址-乡（镇、街道办事处）
* @param string $hrb02_03_015  地址-村（街、路、弄等）
* @param string $hrb02_03_016  地址-门牌号码
* @param string $hrb02_03_017  邮政编码
* @param string $hrb02_03_018  联系电话-类别
* @param string $hrb02_03_019  联系电话-类别代码
* @param string $hrb02_03_020  联系电话-号码
* @param string $hrb02_03_021  既往疾病史
* @param string $hrb02_03_022  过敏史
* @param string $hrb02_03_023  避孕史
* @param string $hrb02_03_024  主诉
* @param decimal $hrb02_03_025  初潮年龄（岁）
* @param decimal $hrb02_03_026  月经持续时间（d）
* @param decimal $hrb02_03_027  月经周期（d）
* @param string $hrb02_03_028  月经出血量类别代码
* @param string $hrb02_03_029  痛经程度代码
* @param date $hrb02_03_030  末次月经日期
* @param decimal $hrb02_03_031  孕次
* @param decimal $hrb02_03_032  产次
* @param date $hrb02_03_033  末次妊娠终止日期
* @param string $hrb02_03_034  末次妊娠终止方式代码
* @param decimal $hrb02_03_035  流产总次数
* @param decimal $hrb02_03_036  体温(℃)
* @param decimal $hrb02_03_037  舒张压(mmHg)
* @param decimal $hrb02_03_038  收缩压(mmHg)
* @param decimal $hrb02_03_039  心率（次/分钟）
* @param string $hrb02_03_040  心脏听诊结果
* @param string $hrb02_03_041  肺部听诊结果
* @param string $hrb02_03_042  外阴检查结果
* @param string $hrb02_03_043  阴道检查结果
* @param string $hrb02_03_044  宫颈检查结果
* @param string $hrb02_03_045  子宫检查结果
* @param string $hrb02_03_046  子宫位置代码
* @param string $hrb02_03_047  子宫大小代码
* @param string $hrb02_03_048  左侧输卵管检查结果
* @param string $hrb02_03_049  右侧输卵管检查结果
* @param string $hrb02_03_050  左侧卵巢检查结果
* @param string $hrb02_03_051  右侧卵巢检查结果
* @param string $hrb02_03_052  左侧附件检查结果代码
* @param string $hrb02_03_053  右侧附件检查结果代码
* @param string $hrb02_03_054  左侧附睾检查结果代码
* @param string $hrb02_03_055  右侧附睾检查结果代码
* @param string $hrb02_03_056  左侧睾丸检查结果代码
* @param string $hrb02_03_057  右侧睾丸检查结果代码
* @param string $hrb02_03_058  左侧输精管检查结果
* @param string $hrb02_03_059  右侧输精管检查结果
* @param string $hrb02_03_060  阴囊检查结果
* @param string $hrb02_03_061  精索检查结果
* @param decimal $hrb02_03_062  红细胞计数值（G/L）
* @param decimal $hrb02_03_063  血红蛋白值（g/L）
* @param decimal $hrb02_03_064  血小板计数值(G/L)
* @param decimal $hrb02_03_065  白细胞计数值(G/L)
* @param string $hrb02_03_066  白细胞分类结果
* @param decimal $hrb02_03_067  出血时间（s）
* @param decimal $hrb02_03_068  凝血时间（s）
* @param string $hrb02_03_069  阴道分泌物性状描述
* @param string $hrb02_03_070  滴虫检测结果代码
* @param string $hrb02_03_071  念珠菌检测结果代码
* @param string $hrb02_03_072  阴道分泌物清洁度代码
* @param string $hrb02_03_073  淋球菌检查结果
* @param string $hrb02_03_074  梅毒血清学试验结果代码
* @param string $hrb02_03_075  HIV抗体检测结果代码
* @param string $hrb02_03_076  尿妊娠试验结果代码
* @param decimal $hrb02_03_077  血β-绒毛膜促性腺激素值（IU/L）
* @param string $hrb02_03_078  乙型肝炎病毒表面抗原检测结果代码
* @param string $hrb02_03_079  B超检查结果
* @param string $hrb02_03_080  疾病诊断代码
* @param string $hrb02_03_081  手术/操作-名称
* @param decimal $hrb02_03_082  宫内节育器放置年限
* @param string $hrb02_03_083  宫内节育器放置时期代码
* @param boolean $hrb02_03_084  宫内节育器取出-情况代码
* @param string $hrb02_03_085  宫内节育器取出-异常情况描述
* @param string $hrb02_03_086  宫内节育器种类代码
* @param string $hrb02_03_087  皮下埋植剂埋植时期代码
* @param decimal $hrb02_03_088  皮下埋植剂埋植年限
* @param string $hrb02_03_089  皮下埋植剂埋植部位代码
* @param string $hrb02_03_090  取出皮下埋植剂检查结果代码
* @param string $hrb02_03_091  输卵管结扎手术方式代码
* @param string $hrb02_03_092  输卵管结扎部位代码
* @param string $hrb02_03_093  输精管结扎手术方式代码
* @param decimal $hrb02_03_094  左侧输精管切除长度（cm）
* @param decimal $hrb02_03_095  右侧输精管切除长度（cm）
* @param boolean $hrb02_03_096  左侧附睾端包埋操作标志
* @param boolean $hrb02_03_097  右侧附睾端包埋操作标志
* @param boolean $hrb02_03_098  宫颈扩张标志
* @param boolean $hrb02_03_099  见到绒毛标志
* @param boolean $hrb02_03_100  胚囊-可见标志
* @param decimal $hrb02_03_101  胚囊-平均直径（cm）
* @param boolean $hrb02_03_102  清宫操作标志
* @param string $hrb02_03_103  流产方法代码
* @param string $hrb02_03_104  药物流产使用药物类别代码
* @param string $hrb02_03_105  给（服）药时间
* @param decimal $hrb02_03_106  呕吐次数
* @param decimal $hrb02_03_107  腹泻次数
* @param string $hrb02_03_108  腹痛程度代码
* @param boolean $hrb02_03_109  病理检查-标志
* @param string $hrb02_03_110  病理检查-结果
* @param string $hrb02_03_111  药物名称
* @param string $hrb02_03_112  药物用法
* @param dateTime $hrb02_03_113  胚囊排出日期时间
* @param date $hrb02_03_114  清宫日期
* @param boolean $hrb02_03_115  手术过程顺利标志
* @param decimal $hrb02_03_116  手术出血量（ml）
* @param string $hrb02_03_117  手术过程描述
* @param string $hrb02_03_118  手术并发症-标志
* @param string $hrb02_03_119  手术并发症-详细描述
* @param string $hrb02_03_120  特殊情况记录
* @param string $hrb02_03_121  处理及指导意见
* @param string $hrb02_03_122  随诊检查结果
* @param string $hrb02_03_123  手术者姓名
* @param string $hrb02_03_124  手术机构名称
* @param date $hrb02_03_125  手术日期
* @param string $hrb02_03_126  检查（测）人员姓名
* @param string $hrb02_03_127  检查（测）机构名称
* @param date $hrb02_03_128  检查（测）日期
* @return boolean
*/
function update_hrb02_03($ws_id,$org_id,$doctor_id,$identity_number,$hrb02_03_001='',$hrb02_03_002='',$hrb02_03_003='',$hrb02_03_004='',$hrb02_03_005='',$hrb02_03_006='',$hrb02_03_007='',$hrb02_03_008='',$hrb02_03_009='',$hrb02_03_010='',$hrb02_03_011='',$hrb02_03_012='',$hrb02_03_013='',$hrb02_03_014='',$hrb02_03_015='',$hrb02_03_016='',$hrb02_03_017='',$hrb02_03_018='',$hrb02_03_019='',$hrb02_03_020='',$hrb02_03_021='',$hrb02_03_022='',$hrb02_03_023='',$hrb02_03_024='',$hrb02_03_025=0,$hrb02_03_026=0,$hrb02_03_027=0,$hrb02_03_028='',$hrb02_03_029='',$hrb02_03_030='',$hrb02_03_031=0,$hrb02_03_032=0,$hrb02_03_033='',$hrb02_03_034='',$hrb02_03_035=0,$hrb02_03_036=0,$hrb02_03_037=0,$hrb02_03_038=0,$hrb02_03_039=0,$hrb02_03_040='',$hrb02_03_041='',$hrb02_03_042='',$hrb02_03_043='',$hrb02_03_044='',$hrb02_03_045='',$hrb02_03_046='',$hrb02_03_047='',$hrb02_03_048='',$hrb02_03_049='',$hrb02_03_050='',$hrb02_03_051='',$hrb02_03_052='',$hrb02_03_053='',$hrb02_03_054='',$hrb02_03_055='',$hrb02_03_056='',$hrb02_03_057='',$hrb02_03_058='',$hrb02_03_059='',$hrb02_03_060='',$hrb02_03_061='',$hrb02_03_062=0,$hrb02_03_063=0,$hrb02_03_064=0,$hrb02_03_065=0,$hrb02_03_066='',$hrb02_03_067=0,$hrb02_03_068=0,$hrb02_03_069='',$hrb02_03_070='',$hrb02_03_071='',$hrb02_03_072='',$hrb02_03_073='',$hrb02_03_074='',$hrb02_03_075='',$hrb02_03_076='',$hrb02_03_077=0,$hrb02_03_078='',$hrb02_03_079='',$hrb02_03_080='',$hrb02_03_081='',$hrb02_03_082=0,$hrb02_03_083='',$hrb02_03_084=false,$hrb02_03_085='',$hrb02_03_086='',$hrb02_03_087='',$hrb02_03_088=0,$hrb02_03_089='',$hrb02_03_090='',$hrb02_03_091='',$hrb02_03_092='',$hrb02_03_093='',$hrb02_03_094=0,$hrb02_03_095=0,$hrb02_03_096=false,$hrb02_03_097=false,$hrb02_03_098=false,$hrb02_03_099=false,$hrb02_03_100=false,$hrb02_03_101=0,$hrb02_03_102=false,$hrb02_03_103='',$hrb02_03_104='',$hrb02_03_105='',$hrb02_03_106=0,$hrb02_03_107=0,$hrb02_03_108='',$hrb02_03_109=false,$hrb02_03_110='',$hrb02_03_111='',$hrb02_03_112='',$hrb02_03_113='',$hrb02_03_114='',$hrb02_03_115=false,$hrb02_03_116=0,$hrb02_03_117='',$hrb02_03_118='',$hrb02_03_119='',$hrb02_03_120='',$hrb02_03_121='',$hrb02_03_122='',$hrb02_03_123='',$hrb02_03_124='',$hrb02_03_125='',$hrb02_03_126='',$hrb02_03_127='',$hrb02_03_128=''){
require_once(__SITEROOT.'library/Models/ws_hrb02_03.php');
$table_obj="Tws_hrb02_03";
$ws_hrb02_03=new $table_obj();
$ws_hrb02_03 -> ws_id=$ws_id;
$ws_hrb02_03 -> uuid=uniqid('',true);
$ws_hrb02_03 -> created=time();
$ws_hrb02_03 -> org_id=$org_id;
$ws_hrb02_03 -> doctor_id=$doctor_id;
$ws_hrb02_03 -> identity_number=$identity_number;//身份证号
$ws_hrb02_03 -> action='insert';
$ws_hrb02_03->hrb02_03_001 = $hrb02_03_001; //记录表单编号 
$ws_hrb02_03->hrb02_03_002 = $hrb02_03_002; //姓名 
$ws_hrb02_03 ->hrb02_03_003 = empty($hrb02_03_003)?null : $ws_hrb02_03 ->escape('hrb02_03_003',to_date($hrb02_03_003,'YYYY-MM-DD')); //出生日期 
$ws_hrb02_03->hrb02_03_004 = $hrb02_03_004; //门诊号 
$ws_hrb02_03->hrb02_03_005 = $hrb02_03_005; //住院号 
$ws_hrb02_03->hrb02_03_006 = $hrb02_03_006; //职业类别代码(国标) 
$ws_hrb02_03->hrb02_03_007 = $hrb02_03_007; //工作单位名称 
$ws_hrb02_03->hrb02_03_008 = $hrb02_03_008; //婚姻状况类别代码 
$ws_hrb02_03->hrb02_03_009 = $hrb02_03_009; //地址类别代码 
$ws_hrb02_03->hrb02_03_010 = $hrb02_03_010; //行政区划代码 
$ws_hrb02_03->hrb02_03_011 = $hrb02_03_011; //地址-省（自治区、直辖市） 
$ws_hrb02_03->hrb02_03_012 = $hrb02_03_012; //地址-市（地区） 
$ws_hrb02_03->hrb02_03_013 = $hrb02_03_013; //地址-县（区） 
$ws_hrb02_03->hrb02_03_014 = $hrb02_03_014; //地址-乡（镇、街道办事处） 
$ws_hrb02_03->hrb02_03_015 = $hrb02_03_015; //地址-村（街、路、弄等） 
$ws_hrb02_03->hrb02_03_016 = $hrb02_03_016; //地址-门牌号码 
$ws_hrb02_03->hrb02_03_017 = $hrb02_03_017; //邮政编码 
$ws_hrb02_03->hrb02_03_018 = $hrb02_03_018; //联系电话-类别 
$ws_hrb02_03->hrb02_03_019 = $hrb02_03_019; //联系电话-类别代码 
$ws_hrb02_03->hrb02_03_020 = $hrb02_03_020; //联系电话-号码 
$ws_hrb02_03->hrb02_03_021 = $hrb02_03_021; //既往疾病史 
$ws_hrb02_03->hrb02_03_022 = $hrb02_03_022; //过敏史 
$ws_hrb02_03->hrb02_03_023 = $hrb02_03_023; //避孕史 
$ws_hrb02_03->hrb02_03_024 = $hrb02_03_024; //主诉 
$ws_hrb02_03->hrb02_03_025 = $hrb02_03_025; //初潮年龄（岁） 
$ws_hrb02_03->hrb02_03_026 = $hrb02_03_026; //月经持续时间（d） 
$ws_hrb02_03->hrb02_03_027 = $hrb02_03_027; //月经周期（d） 
$ws_hrb02_03->hrb02_03_028 = $hrb02_03_028; //月经出血量类别代码 
$ws_hrb02_03->hrb02_03_029 = $hrb02_03_029; //痛经程度代码 
$ws_hrb02_03 ->hrb02_03_030 = empty($hrb02_03_030)?null : $ws_hrb02_03 ->escape('hrb02_03_030',to_date($hrb02_03_030,'YYYY-MM-DD')); //末次月经日期 
$ws_hrb02_03->hrb02_03_031 = $hrb02_03_031; //孕次 
$ws_hrb02_03->hrb02_03_032 = $hrb02_03_032; //产次 
$ws_hrb02_03 ->hrb02_03_033 = empty($hrb02_03_033)?null : $ws_hrb02_03 ->escape('hrb02_03_033',to_date($hrb02_03_033,'YYYY-MM-DD')); //末次妊娠终止日期 
$ws_hrb02_03->hrb02_03_034 = $hrb02_03_034; //末次妊娠终止方式代码 
$ws_hrb02_03->hrb02_03_035 = $hrb02_03_035; //流产总次数 
$ws_hrb02_03->hrb02_03_036 = $hrb02_03_036; //体温(℃) 
$ws_hrb02_03->hrb02_03_037 = $hrb02_03_037; //舒张压(mmHg) 
$ws_hrb02_03->hrb02_03_038 = $hrb02_03_038; //收缩压(mmHg) 
$ws_hrb02_03->hrb02_03_039 = $hrb02_03_039; //心率（次/分钟） 
$ws_hrb02_03->hrb02_03_040 = $hrb02_03_040; //心脏听诊结果 
$ws_hrb02_03->hrb02_03_041 = $hrb02_03_041; //肺部听诊结果 
$ws_hrb02_03->hrb02_03_042 = $hrb02_03_042; //外阴检查结果 
$ws_hrb02_03->hrb02_03_043 = $hrb02_03_043; //阴道检查结果 
$ws_hrb02_03->hrb02_03_044 = $hrb02_03_044; //宫颈检查结果 
$ws_hrb02_03->hrb02_03_045 = $hrb02_03_045; //子宫检查结果 
$ws_hrb02_03->hrb02_03_046 = $hrb02_03_046; //子宫位置代码 
$ws_hrb02_03->hrb02_03_047 = $hrb02_03_047; //子宫大小代码 
$ws_hrb02_03->hrb02_03_048 = $hrb02_03_048; //左侧输卵管检查结果 
$ws_hrb02_03->hrb02_03_049 = $hrb02_03_049; //右侧输卵管检查结果 
$ws_hrb02_03->hrb02_03_050 = $hrb02_03_050; //左侧卵巢检查结果 
$ws_hrb02_03->hrb02_03_051 = $hrb02_03_051; //右侧卵巢检查结果 
$ws_hrb02_03->hrb02_03_052 = $hrb02_03_052; //左侧附件检查结果代码 
$ws_hrb02_03->hrb02_03_053 = $hrb02_03_053; //右侧附件检查结果代码 
$ws_hrb02_03->hrb02_03_054 = $hrb02_03_054; //左侧附睾检查结果代码 
$ws_hrb02_03->hrb02_03_055 = $hrb02_03_055; //右侧附睾检查结果代码 
$ws_hrb02_03->hrb02_03_056 = $hrb02_03_056; //左侧睾丸检查结果代码 
$ws_hrb02_03->hrb02_03_057 = $hrb02_03_057; //右侧睾丸检查结果代码 
$ws_hrb02_03->hrb02_03_058 = $hrb02_03_058; //左侧输精管检查结果 
$ws_hrb02_03->hrb02_03_059 = $hrb02_03_059; //右侧输精管检查结果 
$ws_hrb02_03->hrb02_03_060 = $hrb02_03_060; //阴囊检查结果 
$ws_hrb02_03->hrb02_03_061 = $hrb02_03_061; //精索检查结果 
$ws_hrb02_03->hrb02_03_062 = $hrb02_03_062; //红细胞计数值（G/L） 
$ws_hrb02_03->hrb02_03_063 = $hrb02_03_063; //血红蛋白值（g/L） 
$ws_hrb02_03->hrb02_03_064 = $hrb02_03_064; //血小板计数值(G/L) 
$ws_hrb02_03->hrb02_03_065 = $hrb02_03_065; //白细胞计数值(G/L) 
$ws_hrb02_03->hrb02_03_066 = $hrb02_03_066; //白细胞分类结果 
$ws_hrb02_03->hrb02_03_067 = $hrb02_03_067; //出血时间（s） 
$ws_hrb02_03->hrb02_03_068 = $hrb02_03_068; //凝血时间（s） 
$ws_hrb02_03->hrb02_03_069 = $hrb02_03_069; //阴道分泌物性状描述 
$ws_hrb02_03->hrb02_03_070 = $hrb02_03_070; //滴虫检测结果代码 
$ws_hrb02_03->hrb02_03_071 = $hrb02_03_071; //念珠菌检测结果代码 
$ws_hrb02_03->hrb02_03_072 = $hrb02_03_072; //阴道分泌物清洁度代码 
$ws_hrb02_03->hrb02_03_073 = $hrb02_03_073; //淋球菌检查结果 
$ws_hrb02_03->hrb02_03_074 = $hrb02_03_074; //梅毒血清学试验结果代码 
$ws_hrb02_03->hrb02_03_075 = $hrb02_03_075; //HIV抗体检测结果代码 
$ws_hrb02_03->hrb02_03_076 = $hrb02_03_076; //尿妊娠试验结果代码 
$ws_hrb02_03->hrb02_03_077 = $hrb02_03_077; //血β-绒毛膜促性腺激素值（IU/L） 
$ws_hrb02_03->hrb02_03_078 = $hrb02_03_078; //乙型肝炎病毒表面抗原检测结果代码 
$ws_hrb02_03->hrb02_03_079 = $hrb02_03_079; //B超检查结果 
$ws_hrb02_03->hrb02_03_080 = $hrb02_03_080; //疾病诊断代码 
$ws_hrb02_03->hrb02_03_081 = $hrb02_03_081; //手术/操作-名称 
$ws_hrb02_03->hrb02_03_082 = $hrb02_03_082; //宫内节育器放置年限 
$ws_hrb02_03->hrb02_03_083 = $hrb02_03_083; //宫内节育器放置时期代码 
$ws_hrb02_03->hrb02_03_084 = $hrb02_03_084; //宫内节育器取出-情况代码 
$ws_hrb02_03->hrb02_03_085 = $hrb02_03_085; //宫内节育器取出-异常情况描述 
$ws_hrb02_03->hrb02_03_086 = $hrb02_03_086; //宫内节育器种类代码 
$ws_hrb02_03->hrb02_03_087 = $hrb02_03_087; //皮下埋植剂埋植时期代码 
$ws_hrb02_03->hrb02_03_088 = $hrb02_03_088; //皮下埋植剂埋植年限 
$ws_hrb02_03->hrb02_03_089 = $hrb02_03_089; //皮下埋植剂埋植部位代码 
$ws_hrb02_03->hrb02_03_090 = $hrb02_03_090; //取出皮下埋植剂检查结果代码 
$ws_hrb02_03->hrb02_03_091 = $hrb02_03_091; //输卵管结扎手术方式代码 
$ws_hrb02_03->hrb02_03_092 = $hrb02_03_092; //输卵管结扎部位代码 
$ws_hrb02_03->hrb02_03_093 = $hrb02_03_093; //输精管结扎手术方式代码 
$ws_hrb02_03->hrb02_03_094 = $hrb02_03_094; //左侧输精管切除长度（cm） 
$ws_hrb02_03->hrb02_03_095 = $hrb02_03_095; //右侧输精管切除长度（cm） 
$ws_hrb02_03->hrb02_03_096 = $hrb02_03_096; //左侧附睾端包埋操作标志 
$ws_hrb02_03->hrb02_03_097 = $hrb02_03_097; //右侧附睾端包埋操作标志 
$ws_hrb02_03->hrb02_03_098 = $hrb02_03_098; //宫颈扩张标志 
$ws_hrb02_03->hrb02_03_099 = $hrb02_03_099; //见到绒毛标志 
$ws_hrb02_03->hrb02_03_100 = $hrb02_03_100; //胚囊-可见标志 
$ws_hrb02_03->hrb02_03_101 = $hrb02_03_101; //胚囊-平均直径（cm） 
$ws_hrb02_03->hrb02_03_102 = $hrb02_03_102; //清宫操作标志 
$ws_hrb02_03->hrb02_03_103 = $hrb02_03_103; //流产方法代码 
$ws_hrb02_03->hrb02_03_104 = $hrb02_03_104; //药物流产使用药物类别代码 
$ws_hrb02_03->hrb02_03_105 = $hrb02_03_105; //给（服）药时间 
$ws_hrb02_03->hrb02_03_106 = $hrb02_03_106; //呕吐次数 
$ws_hrb02_03->hrb02_03_107 = $hrb02_03_107; //腹泻次数 
$ws_hrb02_03->hrb02_03_108 = $hrb02_03_108; //腹痛程度代码 
$ws_hrb02_03->hrb02_03_109 = $hrb02_03_109; //病理检查-标志 
$ws_hrb02_03->hrb02_03_110 = $hrb02_03_110; //病理检查-结果 
$ws_hrb02_03->hrb02_03_111 = $hrb02_03_111; //药物名称 
$ws_hrb02_03->hrb02_03_112 = $hrb02_03_112; //药物用法 
$ws_hrb02_03 ->hrb02_03_113 = empty($hrb02_03_113)?null : $ws_hrb02_03 ->escape('hrb02_03_113',to_date($hrb02_03_113,'YYYY-MM-DD')); //胚囊排出日期时间 
$ws_hrb02_03 ->hrb02_03_114 = empty($hrb02_03_114)?null : $ws_hrb02_03 ->escape('hrb02_03_114',to_date($hrb02_03_114,'YYYY-MM-DD')); //清宫日期 
$ws_hrb02_03->hrb02_03_115 = $hrb02_03_115; //手术过程顺利标志 
$ws_hrb02_03->hrb02_03_116 = $hrb02_03_116; //手术出血量（ml） 
$ws_hrb02_03->hrb02_03_117 = $hrb02_03_117; //手术过程描述 
$ws_hrb02_03->hrb02_03_118 = $hrb02_03_118; //手术并发症-标志 
$ws_hrb02_03->hrb02_03_119 = $hrb02_03_119; //手术并发症-详细描述 
$ws_hrb02_03->hrb02_03_120 = $hrb02_03_120; //特殊情况记录 
$ws_hrb02_03->hrb02_03_121 = $hrb02_03_121; //处理及指导意见 
$ws_hrb02_03->hrb02_03_122 = $hrb02_03_122; //随诊检查结果 
$ws_hrb02_03->hrb02_03_123 = $hrb02_03_123; //手术者姓名 
$ws_hrb02_03->hrb02_03_124 = $hrb02_03_124; //手术机构名称 
$ws_hrb02_03 ->hrb02_03_125 = empty($hrb02_03_125)?null : $ws_hrb02_03 ->escape('hrb02_03_125',to_date($hrb02_03_125,'YYYY-MM-DD')); //手术日期 
$ws_hrb02_03->hrb02_03_126 = $hrb02_03_126; //检查（测）人员姓名 
$ws_hrb02_03->hrb02_03_127 = $hrb02_03_127; //检查（测）机构名称 
$ws_hrb02_03 ->hrb02_03_128 = empty($hrb02_03_128)?null : $ws_hrb02_03 ->escape('hrb02_03_128',to_date($hrb02_03_128,'YYYY-MM-DD')); //检查（测）日期 
if($ws_hrb02_03 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb02_03 ->free_statement();
}
