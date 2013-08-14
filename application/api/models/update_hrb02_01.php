<?php
/**
婚前保健服务基本数据集标准HRB02.01婚前保健服务基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb02_01_001  记录表单编号
* @param string $hrb02_01_002  姓名
* @param date $hrb02_01_003  出生日期
* @param string $hrb02_01_004  民族代码
* @param string $hrb02_01_005  文化程度代码
* @param string $hrb02_01_006  国籍代码
* @param string $hrb02_01_007  身份证件-类别代码
* @param string $hrb02_01_008  身份证件-号码
* @param string $hrb02_01_009  职业类别代码(国标)
* @param string $hrb02_01_010  工作单位名称
* @param string $hrb02_01_011  地址类别代码
* @param string $hrb02_01_012  行政区划代码
* @param string $hrb02_01_013  地址-省（自治区、直辖市）
* @param string $hrb02_01_014  地址-市（地区）
* @param string $hrb02_01_015  地址-县（区）
* @param string $hrb02_01_016  地址-乡（镇、街道办事处）
* @param string $hrb02_01_017  地址-村（街、路、弄等）
* @param string $hrb02_01_018  地址-门牌号码
* @param string $hrb02_01_019  邮政编码
* @param string $hrb02_01_020  联系电话-类别
* @param string $hrb02_01_021  联系电话-类别代码
* @param string $hrb02_01_022  联系电话-号码
* @param string $hrb02_01_023  对方记录表单编号
* @param string $hrb02_01_024  对方姓名
* @param string $hrb02_01_025  血缘关系代码
* @param string $hrb02_01_026  既往疾病史
* @param string $hrb02_01_027  手术史
* @param string $hrb02_01_028  现病史
* @param string $hrb02_01_029  家族遗传性疾病史
* @param string $hrb02_01_030  患者与本人关系代码
* @param decimal $hrb02_01_031  初潮年龄（岁）
* @param decimal $hrb02_01_032  月经持续时间（d）
* @param string $hrb02_01_033  月经出血量类别代码
* @param decimal $hrb02_01_034  月经周期（d）
* @param string $hrb02_01_035  痛经程度代码
* @param date $hrb02_01_036  末次月经日期
* @param decimal $hrb02_01_037  足月产次数
* @param decimal $hrb02_01_038  早产次数
* @param decimal $hrb02_01_039  流产总次数
* @param string $hrb02_01_040  婚姻状况类别代码
* @param decimal $hrb02_01_041  生育女数
* @param decimal $hrb02_01_042  生育子数
* @param string $hrb02_01_043  子女患遗传性疾病情况
* @param boolean $hrb02_01_044  家族近亲婚配标志
* @param string $hrb02_01_045  家族近亲婚配者与本人关系代码
* @param decimal $hrb02_01_046  收缩压(mmHg)
* @param decimal $hrb02_01_047  舒张压(mmHg)
* @param string $hrb02_01_048  特殊体态检查结果
* @param string $hrb02_01_049  精神状态代码
* @param string $hrb02_01_050  特殊面容检查结果
* @param string $hrb02_01_051  五官检查结果
* @param string $hrb02_01_052  智力发育
* @param string $hrb02_01_053  心律
* @param decimal $hrb02_01_054  心率（次/分钟）
* @param string $hrb02_01_055  心脏听诊结果
* @param string $hrb02_01_056  肺部听诊结果
* @param string $hrb02_01_057  肝脏触诊结果
* @param string $hrb02_01_058  四肢检查结果
* @param string $hrb02_01_059  脊柱检查结果
* @param string $hrb02_01_060  皮肤毛发检查结果
* @param string $hrb02_01_061  甲状腺检查结果
* @param string $hrb02_01_062  阴茎检查结果
* @param string $hrb02_01_063  包皮检查结果代码
* @param string $hrb02_01_064  左侧睾丸检查结果代码
* @param string $hrb02_01_065  右侧睾丸检查结果代码
* @param string $hrb02_01_066  左侧附睾检查结果代码
* @param string $hrb02_01_067  右侧附睾检查结果代码
* @param string $hrb02_01_068  附睾异常情况
* @param string $hrb02_01_069  喉结检查结果
* @param boolean $hrb02_01_070  精索静脉曲张-标志
* @param string $hrb02_01_071  精索静脉曲张-部位
* @param string $hrb02_01_072  精索静脉曲张-程度代码
* @param string $hrb02_01_073  妇科检查方式代码
* @param boolean $hrb02_01_074  知情同意标志
* @param string $hrb02_01_075  阴毛检查结果
* @param string $hrb02_01_076  外阴检查结果
* @param string $hrb02_01_077  阴道检查结果
* @param string $hrb02_01_078  子宫检查结果
* @param string $hrb02_01_079  左侧附件检查结果代码
* @param string $hrb02_01_080  右侧附件检查结果代码
* @param string $hrb02_01_081  宫颈检查结果
* @param string $hrb02_01_082  左侧乳腺检查结果代码
* @param string $hrb02_01_083  右侧乳腺检查结果代码
* @param string $hrb02_01_084  阴道分泌物性状描述
* @param string $hrb02_01_085  胸部X线检查结果
* @param string $hrb02_01_086  白细胞分类结果
* @param decimal $hrb02_01_087  白细胞计数值(G/L)
* @param decimal $hrb02_01_088  红细胞计数值（G/L）
* @param decimal $hrb02_01_089  血红蛋白值（g/L）
* @param decimal $hrb02_01_090  血小板计数值(G/L)
* @param decimal $hrb02_01_091  尿比重
* @param decimal $hrb02_01_092  尿蛋白定量检测值（mg/24h）
* @param decimal $hrb02_01_093  尿糖定量检测(mmol/L)
* @param decimal $hrb02_01_094  尿液酸碱度
* @param decimal $hrb02_01_095  血清谷丙转氨酶值（U/L）
* @param string $hrb02_01_096  乙型肝炎病毒表面抗原检测结果代码
* @param string $hrb02_01_097  淋球菌检查结果
* @param string $hrb02_01_098  梅毒血清学试验结果代码
* @param string $hrb02_01_099  HIV抗体检测结果代码
* @param string $hrb02_01_100  滴虫检测结果代码
* @param string $hrb02_01_101  念珠菌检测结果代码
* @param string $hrb02_01_102  阴道分泌物清洁度代码
* @param string $hrb02_01_103  疾病诊断代码
* @param string $hrb02_01_104  婚前医学检查结果代码
* @param string $hrb02_01_105  婚检医学意见代码
* @param string $hrb02_01_106  婚前卫生指导内容
* @param string $hrb02_01_107  婚前卫生咨询内容
* @param string $hrb02_01_108  婚检咨询指导结果代码
* @param date $hrb02_01_109  检查（测）日期
* @param string $hrb02_01_110  检查（测）人员姓名
* @param string $hrb02_01_111  检查（测）机构名称
* @param date $hrb02_01_112  填报日期
* @param string $hrb02_01_113  首诊医师姓名
* @param string $hrb02_01_114  主检医师姓名
* @param date $hrb02_01_115  转诊日期
* @param string $hrb02_01_116  转入医院名称
* @param date $hrb02_01_117  预约日期
* @param date $hrb02_01_118  出具《婚前医学检查证明》日期
* @return boolean
*/
function update_hrb02_01($ws_id,$org_id,$doctor_id,$identity_number,$hrb02_01_001='',$hrb02_01_002='',$hrb02_01_003='',$hrb02_01_004='',$hrb02_01_005='',$hrb02_01_006='',$hrb02_01_007='',$hrb02_01_008='',$hrb02_01_009='',$hrb02_01_010='',$hrb02_01_011='',$hrb02_01_012='',$hrb02_01_013='',$hrb02_01_014='',$hrb02_01_015='',$hrb02_01_016='',$hrb02_01_017='',$hrb02_01_018='',$hrb02_01_019='',$hrb02_01_020='',$hrb02_01_021='',$hrb02_01_022='',$hrb02_01_023='',$hrb02_01_024='',$hrb02_01_025='',$hrb02_01_026='',$hrb02_01_027='',$hrb02_01_028='',$hrb02_01_029='',$hrb02_01_030='',$hrb02_01_031=0,$hrb02_01_032=0,$hrb02_01_033='',$hrb02_01_034=0,$hrb02_01_035='',$hrb02_01_036='',$hrb02_01_037=0,$hrb02_01_038=0,$hrb02_01_039=0,$hrb02_01_040='',$hrb02_01_041=0,$hrb02_01_042=0,$hrb02_01_043='',$hrb02_01_044=false,$hrb02_01_045='',$hrb02_01_046=0,$hrb02_01_047=0,$hrb02_01_048='',$hrb02_01_049='',$hrb02_01_050='',$hrb02_01_051='',$hrb02_01_052='',$hrb02_01_053='',$hrb02_01_054=0,$hrb02_01_055='',$hrb02_01_056='',$hrb02_01_057='',$hrb02_01_058='',$hrb02_01_059='',$hrb02_01_060='',$hrb02_01_061='',$hrb02_01_062='',$hrb02_01_063='',$hrb02_01_064='',$hrb02_01_065='',$hrb02_01_066='',$hrb02_01_067='',$hrb02_01_068='',$hrb02_01_069='',$hrb02_01_070=false,$hrb02_01_071='',$hrb02_01_072='',$hrb02_01_073='',$hrb02_01_074=false,$hrb02_01_075='',$hrb02_01_076='',$hrb02_01_077='',$hrb02_01_078='',$hrb02_01_079='',$hrb02_01_080='',$hrb02_01_081='',$hrb02_01_082='',$hrb02_01_083='',$hrb02_01_084='',$hrb02_01_085='',$hrb02_01_086='',$hrb02_01_087=0,$hrb02_01_088=0,$hrb02_01_089=0,$hrb02_01_090=0,$hrb02_01_091=0,$hrb02_01_092=0,$hrb02_01_093=0,$hrb02_01_094=0,$hrb02_01_095=0,$hrb02_01_096='',$hrb02_01_097='',$hrb02_01_098='',$hrb02_01_099='',$hrb02_01_100='',$hrb02_01_101='',$hrb02_01_102='',$hrb02_01_103='',$hrb02_01_104='',$hrb02_01_105='',$hrb02_01_106='',$hrb02_01_107='',$hrb02_01_108='',$hrb02_01_109='',$hrb02_01_110='',$hrb02_01_111='',$hrb02_01_112='',$hrb02_01_113='',$hrb02_01_114='',$hrb02_01_115='',$hrb02_01_116='',$hrb02_01_117='',$hrb02_01_118=''){
require_once(__SITEROOT.'library/Models/ws_hrb02_01.php');
$table_obj="Tws_hrb02_01";
$ws_hrb02_01=new $table_obj();
$ws_hrb02_01 -> ws_id=$ws_id;
$ws_hrb02_01 -> uuid=uniqid('',true);
$ws_hrb02_01 -> created=time();
$ws_hrb02_01 -> org_id=$org_id;
$ws_hrb02_01 -> doctor_id=$doctor_id;
$ws_hrb02_01 -> identity_number=$identity_number;//身份证号
$ws_hrb02_01 -> action='insert';
$ws_hrb02_01->hrb02_01_001 = $hrb02_01_001; //记录表单编号 
$ws_hrb02_01->hrb02_01_002 = $hrb02_01_002; //姓名 
$ws_hrb02_01 ->hrb02_01_003 = empty($hrb02_01_003)?null : $ws_hrb02_01 ->escape('hrb02_01_003',to_date($hrb02_01_003,'YYYY-MM-DD')); //出生日期 
$ws_hrb02_01->hrb02_01_004 = $hrb02_01_004; //民族代码 
$ws_hrb02_01->hrb02_01_005 = $hrb02_01_005; //文化程度代码 
$ws_hrb02_01->hrb02_01_006 = $hrb02_01_006; //国籍代码 
$ws_hrb02_01->hrb02_01_007 = $hrb02_01_007; //身份证件-类别代码 
$ws_hrb02_01->hrb02_01_008 = $hrb02_01_008; //身份证件-号码 
$ws_hrb02_01->hrb02_01_009 = $hrb02_01_009; //职业类别代码(国标) 
$ws_hrb02_01->hrb02_01_010 = $hrb02_01_010; //工作单位名称 
$ws_hrb02_01->hrb02_01_011 = $hrb02_01_011; //地址类别代码 
$ws_hrb02_01->hrb02_01_012 = $hrb02_01_012; //行政区划代码 
$ws_hrb02_01->hrb02_01_013 = $hrb02_01_013; //地址-省（自治区、直辖市） 
$ws_hrb02_01->hrb02_01_014 = $hrb02_01_014; //地址-市（地区） 
$ws_hrb02_01->hrb02_01_015 = $hrb02_01_015; //地址-县（区） 
$ws_hrb02_01->hrb02_01_016 = $hrb02_01_016; //地址-乡（镇、街道办事处） 
$ws_hrb02_01->hrb02_01_017 = $hrb02_01_017; //地址-村（街、路、弄等） 
$ws_hrb02_01->hrb02_01_018 = $hrb02_01_018; //地址-门牌号码 
$ws_hrb02_01->hrb02_01_019 = $hrb02_01_019; //邮政编码 
$ws_hrb02_01->hrb02_01_020 = $hrb02_01_020; //联系电话-类别 
$ws_hrb02_01->hrb02_01_021 = $hrb02_01_021; //联系电话-类别代码 
$ws_hrb02_01->hrb02_01_022 = $hrb02_01_022; //联系电话-号码 
$ws_hrb02_01->hrb02_01_023 = $hrb02_01_023; //对方记录表单编号 
$ws_hrb02_01->hrb02_01_024 = $hrb02_01_024; //对方姓名 
$ws_hrb02_01->hrb02_01_025 = $hrb02_01_025; //血缘关系代码 
$ws_hrb02_01->hrb02_01_026 = $hrb02_01_026; //既往疾病史 
$ws_hrb02_01->hrb02_01_027 = $hrb02_01_027; //手术史 
$ws_hrb02_01->hrb02_01_028 = $hrb02_01_028; //现病史 
$ws_hrb02_01->hrb02_01_029 = $hrb02_01_029; //家族遗传性疾病史 
$ws_hrb02_01->hrb02_01_030 = $hrb02_01_030; //患者与本人关系代码 
$ws_hrb02_01->hrb02_01_031 = $hrb02_01_031; //初潮年龄（岁） 
$ws_hrb02_01->hrb02_01_032 = $hrb02_01_032; //月经持续时间（d） 
$ws_hrb02_01->hrb02_01_033 = $hrb02_01_033; //月经出血量类别代码 
$ws_hrb02_01->hrb02_01_034 = $hrb02_01_034; //月经周期（d） 
$ws_hrb02_01->hrb02_01_035 = $hrb02_01_035; //痛经程度代码 
$ws_hrb02_01 ->hrb02_01_036 = empty($hrb02_01_036)?null : $ws_hrb02_01 ->escape('hrb02_01_036',to_date($hrb02_01_036,'YYYY-MM-DD')); //末次月经日期 
$ws_hrb02_01->hrb02_01_037 = $hrb02_01_037; //足月产次数 
$ws_hrb02_01->hrb02_01_038 = $hrb02_01_038; //早产次数 
$ws_hrb02_01->hrb02_01_039 = $hrb02_01_039; //流产总次数 
$ws_hrb02_01->hrb02_01_040 = $hrb02_01_040; //婚姻状况类别代码 
$ws_hrb02_01->hrb02_01_041 = $hrb02_01_041; //生育女数 
$ws_hrb02_01->hrb02_01_042 = $hrb02_01_042; //生育子数 
$ws_hrb02_01->hrb02_01_043 = $hrb02_01_043; //子女患遗传性疾病情况 
$ws_hrb02_01->hrb02_01_044 = $hrb02_01_044; //家族近亲婚配标志 
$ws_hrb02_01->hrb02_01_045 = $hrb02_01_045; //家族近亲婚配者与本人关系代码 
$ws_hrb02_01->hrb02_01_046 = $hrb02_01_046; //收缩压(mmHg) 
$ws_hrb02_01->hrb02_01_047 = $hrb02_01_047; //舒张压(mmHg) 
$ws_hrb02_01->hrb02_01_048 = $hrb02_01_048; //特殊体态检查结果 
$ws_hrb02_01->hrb02_01_049 = $hrb02_01_049; //精神状态代码 
$ws_hrb02_01->hrb02_01_050 = $hrb02_01_050; //特殊面容检查结果 
$ws_hrb02_01->hrb02_01_051 = $hrb02_01_051; //五官检查结果 
$ws_hrb02_01->hrb02_01_052 = $hrb02_01_052; //智力发育 
$ws_hrb02_01->hrb02_01_053 = $hrb02_01_053; //心律 
$ws_hrb02_01->hrb02_01_054 = $hrb02_01_054; //心率（次/分钟） 
$ws_hrb02_01->hrb02_01_055 = $hrb02_01_055; //心脏听诊结果 
$ws_hrb02_01->hrb02_01_056 = $hrb02_01_056; //肺部听诊结果 
$ws_hrb02_01->hrb02_01_057 = $hrb02_01_057; //肝脏触诊结果 
$ws_hrb02_01->hrb02_01_058 = $hrb02_01_058; //四肢检查结果 
$ws_hrb02_01->hrb02_01_059 = $hrb02_01_059; //脊柱检查结果 
$ws_hrb02_01->hrb02_01_060 = $hrb02_01_060; //皮肤毛发检查结果 
$ws_hrb02_01->hrb02_01_061 = $hrb02_01_061; //甲状腺检查结果 
$ws_hrb02_01->hrb02_01_062 = $hrb02_01_062; //阴茎检查结果 
$ws_hrb02_01->hrb02_01_063 = $hrb02_01_063; //包皮检查结果代码 
$ws_hrb02_01->hrb02_01_064 = $hrb02_01_064; //左侧睾丸检查结果代码 
$ws_hrb02_01->hrb02_01_065 = $hrb02_01_065; //右侧睾丸检查结果代码 
$ws_hrb02_01->hrb02_01_066 = $hrb02_01_066; //左侧附睾检查结果代码 
$ws_hrb02_01->hrb02_01_067 = $hrb02_01_067; //右侧附睾检查结果代码 
$ws_hrb02_01->hrb02_01_068 = $hrb02_01_068; //附睾异常情况 
$ws_hrb02_01->hrb02_01_069 = $hrb02_01_069; //喉结检查结果 
$ws_hrb02_01->hrb02_01_070 = $hrb02_01_070; //精索静脉曲张-标志 
$ws_hrb02_01->hrb02_01_071 = $hrb02_01_071; //精索静脉曲张-部位 
$ws_hrb02_01->hrb02_01_072 = $hrb02_01_072; //精索静脉曲张-程度代码 
$ws_hrb02_01->hrb02_01_073 = $hrb02_01_073; //妇科检查方式代码 
$ws_hrb02_01->hrb02_01_074 = $hrb02_01_074; //知情同意标志 
$ws_hrb02_01->hrb02_01_075 = $hrb02_01_075; //阴毛检查结果 
$ws_hrb02_01->hrb02_01_076 = $hrb02_01_076; //外阴检查结果 
$ws_hrb02_01->hrb02_01_077 = $hrb02_01_077; //阴道检查结果 
$ws_hrb02_01->hrb02_01_078 = $hrb02_01_078; //子宫检查结果 
$ws_hrb02_01->hrb02_01_079 = $hrb02_01_079; //左侧附件检查结果代码 
$ws_hrb02_01->hrb02_01_080 = $hrb02_01_080; //右侧附件检查结果代码 
$ws_hrb02_01->hrb02_01_081 = $hrb02_01_081; //宫颈检查结果 
$ws_hrb02_01->hrb02_01_082 = $hrb02_01_082; //左侧乳腺检查结果代码 
$ws_hrb02_01->hrb02_01_083 = $hrb02_01_083; //右侧乳腺检查结果代码 
$ws_hrb02_01->hrb02_01_084 = $hrb02_01_084; //阴道分泌物性状描述 
$ws_hrb02_01->hrb02_01_085 = $hrb02_01_085; //胸部X线检查结果 
$ws_hrb02_01->hrb02_01_086 = $hrb02_01_086; //白细胞分类结果 
$ws_hrb02_01->hrb02_01_087 = $hrb02_01_087; //白细胞计数值(G/L) 
$ws_hrb02_01->hrb02_01_088 = $hrb02_01_088; //红细胞计数值（G/L） 
$ws_hrb02_01->hrb02_01_089 = $hrb02_01_089; //血红蛋白值（g/L） 
$ws_hrb02_01->hrb02_01_090 = $hrb02_01_090; //血小板计数值(G/L) 
$ws_hrb02_01->hrb02_01_091 = $hrb02_01_091; //尿比重 
$ws_hrb02_01->hrb02_01_092 = $hrb02_01_092; //尿蛋白定量检测值（mg/24h） 
$ws_hrb02_01->hrb02_01_093 = $hrb02_01_093; //尿糖定量检测(mmol/L) 
$ws_hrb02_01->hrb02_01_094 = $hrb02_01_094; //尿液酸碱度 
$ws_hrb02_01->hrb02_01_095 = $hrb02_01_095; //血清谷丙转氨酶值（U/L） 
$ws_hrb02_01->hrb02_01_096 = $hrb02_01_096; //乙型肝炎病毒表面抗原检测结果代码 
$ws_hrb02_01->hrb02_01_097 = $hrb02_01_097; //淋球菌检查结果 
$ws_hrb02_01->hrb02_01_098 = $hrb02_01_098; //梅毒血清学试验结果代码 
$ws_hrb02_01->hrb02_01_099 = $hrb02_01_099; //HIV抗体检测结果代码 
$ws_hrb02_01->hrb02_01_100 = $hrb02_01_100; //滴虫检测结果代码 
$ws_hrb02_01->hrb02_01_101 = $hrb02_01_101; //念珠菌检测结果代码 
$ws_hrb02_01->hrb02_01_102 = $hrb02_01_102; //阴道分泌物清洁度代码 
$ws_hrb02_01->hrb02_01_103 = $hrb02_01_103; //疾病诊断代码 
$ws_hrb02_01->hrb02_01_104 = $hrb02_01_104; //婚前医学检查结果代码 
$ws_hrb02_01->hrb02_01_105 = $hrb02_01_105; //婚检医学意见代码 
$ws_hrb02_01->hrb02_01_106 = $hrb02_01_106; //婚前卫生指导内容 
$ws_hrb02_01->hrb02_01_107 = $hrb02_01_107; //婚前卫生咨询内容 
$ws_hrb02_01->hrb02_01_108 = $hrb02_01_108; //婚检咨询指导结果代码 
$ws_hrb02_01 ->hrb02_01_109 = empty($hrb02_01_109)?null : $ws_hrb02_01 ->escape('hrb02_01_109',to_date($hrb02_01_109,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrb02_01->hrb02_01_110 = $hrb02_01_110; //检查（测）人员姓名 
$ws_hrb02_01->hrb02_01_111 = $hrb02_01_111; //检查（测）机构名称 
$ws_hrb02_01 ->hrb02_01_112 = empty($hrb02_01_112)?null : $ws_hrb02_01 ->escape('hrb02_01_112',to_date($hrb02_01_112,'YYYY-MM-DD')); //填报日期 
$ws_hrb02_01->hrb02_01_113 = $hrb02_01_113; //首诊医师姓名 
$ws_hrb02_01->hrb02_01_114 = $hrb02_01_114; //主检医师姓名 
$ws_hrb02_01 ->hrb02_01_115 = empty($hrb02_01_115)?null : $ws_hrb02_01 ->escape('hrb02_01_115',to_date($hrb02_01_115,'YYYY-MM-DD')); //转诊日期 
$ws_hrb02_01->hrb02_01_116 = $hrb02_01_116; //转入医院名称 
$ws_hrb02_01 ->hrb02_01_117 = empty($hrb02_01_117)?null : $ws_hrb02_01 ->escape('hrb02_01_117',to_date($hrb02_01_117,'YYYY-MM-DD')); //预约日期 
$ws_hrb02_01 ->hrb02_01_118 = empty($hrb02_01_118)?null : $ws_hrb02_01 ->escape('hrb02_01_118',to_date($hrb02_01_118,'YYYY-MM-DD')); //出具《婚前医学检查证明》日期 
if($ws_hrb02_01 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb02_01 ->free_statement();
}
