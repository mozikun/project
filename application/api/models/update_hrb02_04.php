<?php
/**
孕产期保健服务与高危管理基本数据集标准HRB02.04孕产期保健服务与高危管理基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param decimal $hrb02_04_069  分娩孕周
* @param dateTime $hrb02_04_070  分娩日期时间
* @param string $hrb02_04_071  分娩方式代码
* @param decimal $hrb02_04_072  总产程时长（min）
* @param decimal $hrb02_04_073  第一产程时长（min）
* @param decimal $hrb02_04_074  第二产程时长（min）
* @param decimal $hrb02_04_075  第三产程时长（min）
* @param decimal $hrb02_04_076  产后开奶时长（min）
* @param decimal $hrb02_04_077  产后天数（d）
* @param string $hrb02_04_078  产时并发症代码
* @param string $hrb02_04_079  分娩结局
* @param decimal $hrb02_04_080  总出血量（ml）
* @param decimal $hrb02_04_081  产时出血量（ml）
* @param decimal $hrb02_04_082  产后两小时出血量（ml）
* @param decimal $hrb02_04_083  体重（g）
* @param decimal $hrb02_04_084  身长（cm）
* @param decimal $hrb02_04_085  身高(cm)
* @param decimal $hrb02_04_086  基础体重（kg）
* @param decimal $hrb02_04_087  体重（kg）
* @param decimal $hrb02_04_088  头围（cm）
* @param decimal $hrb02_04_089  胸围（cm）
* @param string $hrb02_04_090  恶露状况
* @param date $hrb02_04_091  预产期
* @param string $hrb02_04_092  孕期异常情况记录
* @param decimal $hrb02_04_093  早孕反应开始孕周
* @param boolean $hrb02_04_094  早孕反应标志
* @param boolean $hrb02_04_095  危重孕产妇标志
* @param string $hrb02_04_096  孕产期高危因素-代码
* @param boolean $hrb02_04_097  孕产期高危因素-标志
* @param date $hrb02_04_098  高危评分日期
* @param decimal $hrb02_04_099  高危评分孕周
* @param decimal $hrb02_04_100  高危评分值（分）
* @param string $hrb02_04_101  高危妊娠级别代码
* @param decimal $hrb02_04_102  腹围（cm）
* @param decimal $hrb02_04_103  宫底高度（cm）
* @param decimal $hrb02_04_104  骶耻外径（cm）
* @param decimal $hrb02_04_105  髂棘间径（cm）
* @param decimal $hrb02_04_106  髂嵴间径（cm）
* @param decimal $hrb02_04_107  坐骨结节间径（cm）
* @param date $hrb02_04_108  骨盆测量日期
* @param decimal $hrb02_04_109  骨盆测量孕周
* @param string $hrb02_04_110  口腔检查结果
* @param string $hrb02_04_111  心脏听诊结果
* @param string $hrb02_04_112  新生儿心脏听诊结果
* @param string $hrb02_04_113  肺部听诊结果
* @param string $hrb02_04_114  新生儿肺部听诊结果
* @param string $hrb02_04_115  肝脏触诊结果
* @param string $hrb02_04_116  脾脏触诊结果
* @param string $hrb02_04_117  宫颈检查结果
* @param string $hrb02_04_118  阴道检查结果
* @param boolean $hrb02_04_119  会阴-切开标志
* @param decimal $hrb02_04_120  会阴-缝合针数
* @param string $hrb02_04_121  会阴裂伤程度代码
* @param string $hrb02_04_122  子宫检查结果
* @param string $hrb02_04_123  左侧附件检查结果代码
* @param string $hrb02_04_124  右侧附件检查结果代码
* @param string $hrb02_04_125  左侧乳腺检查结果代码
* @param string $hrb02_04_126  右侧乳腺检查结果代码
* @param string $hrb02_04_127  脊柱检查结果
* @param string $hrb02_04_128  甲状腺检查结果
* @param string $hrb02_04_129  皮肤毛发检查结果
* @param string $hrb02_04_130  脐部检查结果
* @param string $hrb02_04_131  外阴检查结果
* @param string $hrb02_04_132  乳头检查结果
* @param string $hrb02_04_133  乳汁量代码
* @param string $hrb02_04_134  四肢检查结果
* @param string $hrb02_04_135  浮肿程度代码
* @param boolean $hrb02_04_136  衔接标志
* @param string $hrb02_04_137  B超检查结果
* @param string $hrb02_04_138  新生儿睡眠状况
* @param decimal $hrb02_04_139  胎动孕周
* @param string $hrb02_04_140  胎方位代码
* @param decimal $hrb02_04_141  胎数
* @param string $hrb02_04_142  胎先露代码
* @param string $hrb02_04_143  ABO血型代码
* @param string $hrb02_04_144  Rh血型代码
* @param string $hrb02_04_145  新生儿黄疸程度代码
* @param string $hrb02_04_146  肝功能检测结果代码
* @param string $hrb02_04_147  肾功能检测结果代码
* @param decimal $hrb02_04_148  血β-绒毛膜促性腺激素值（IU/L）
* @param decimal $hrb02_04_149  血糖检测值（mmol/L）
* @param decimal $hrb02_04_150  白细胞计数值(G/L)
* @param decimal $hrb02_04_151  红细胞计数值（G/L）
* @param decimal $hrb02_04_152  血小板计数值(G/L)
* @param decimal $hrb02_04_153  出血时间（s）
* @param decimal $hrb02_04_154  凝血时间（s）
* @param decimal $hrb02_04_155  血红蛋白值（g/L）
* @param decimal $hrb02_04_156  血清谷丙转氨酶值（U/L）
* @param decimal $hrb02_04_157  尿比重
* @param decimal $hrb02_04_158  尿蛋白定量检测值（mg/24h）
* @param decimal $hrb02_04_159  尿糖定量检测(mmol/L)
* @param decimal $hrb02_04_160  尿液酸碱度
* @param decimal $hrb02_04_161  尿蛋白定量检测值（mg/24h）
* @param string $hrb02_04_162  阴道分泌物性状描述
* @param string $hrb02_04_163  滴虫检测结果代码
* @param string $hrb02_04_164  念珠菌检测结果代码
* @param string $hrb02_04_165  阴道分泌物清洁度代码
* @param string $hrb02_04_166  乙型肝炎病毒表面抗原检测结果代码
* @param string $hrb02_04_167  梅毒血清学试验结果代码
* @param string $hrb02_04_168  淋球菌检查结果
* @param string $hrb02_04_169  HIV抗体检测结果代码
* @param string $hrb02_04_170  喂养方式类别代码
* @param boolean $hrb02_04_171  臀红标志
* @param decimal $hrb02_04_172  Apgar评分值（分）
* @param string $hrb02_04_173  小便状况记录
* @param string $hrb02_04_174  新生儿小便状况记录
* @param string $hrb02_04_175  大便状况记录
* @param string $hrb02_04_176  新生儿大便状况记录
* @param string $hrb02_04_177  特殊情况记录
* @param string $hrb02_04_178  新生儿特殊情况记录
* @param string $hrb02_04_179  辅助检查-结果
* @param string $hrb02_04_180  辅助检查-项目名称
* @param string $hrb02_04_181  产后42天检查结果
* @param string $hrb02_04_182  转诊记录
* @param string $hrb02_04_183  孕产妇高危筛查机构名称
* @param string $hrb02_04_184  高危妊娠转归代码
* @param string $hrb02_04_185  妊娠合并症/并发症史
* @param string $hrb02_04_186  妊娠诊断方法代码
* @param string $hrb02_04_187  伤口愈合状况代码
* @param boolean $hrb02_04_188  出生缺陷标志
* @param string $hrb02_04_189  出生缺陷类别代码
* @param decimal $hrb02_04_190  出生缺陷儿例数
* @param boolean $hrb02_04_191  新生儿并发症-标志
* @param string $hrb02_04_192  新生儿并发症-代码
* @param boolean $hrb02_04_193  新生儿疾病筛查标志
* @param boolean $hrb02_04_194  新生儿抢救标志
* @param string $hrb02_04_195  新生儿抢救方法代码
* @param string $hrb02_04_196  孕产妇死亡时间类别代码
* @param string $hrb02_04_197  处理及指导意见
* @param string $hrb02_04_198  新生儿处理及指导意见
* @param string $hrb02_04_199  计划生育指导内容
* @param string $hrb02_04_200  宣教内容
* @param string $hrb02_04_201  检查（测）人员姓名
* @param string $hrb02_04_202  检查（测）机构名称
* @param date $hrb02_04_203  检查（测）日期
* @param string $hrb02_04_204  助产人员姓名
* @param string $hrb02_04_205  助产机构名称
* @param decimal $hrb02_04_206  建档孕周
* @param string $hrb02_04_207  建档人员姓名
* @param string $hrb02_04_208  建档机构名称
* @param date $hrb02_04_209  结案日期
* @param string $hrb02_04_210  结案单位名称
* @param date $hrb02_04_211  预约日期
* @param date $hrb02_04_212  访视日期
* @param string $hrb02_04_213  访视人员姓名
* @param string $hrb02_04_214  访视机构名称
* @param string $hrb02_04_001  记录表单编号
* @param string $hrb02_04_002  住院号
* @param string $hrb02_04_003  姓名
* @param date $hrb02_04_004  出生日期
* @param string $hrb02_04_005  民族代码
* @param string $hrb02_04_006  文化程度代码
* @param string $hrb02_04_007  身份证件-类别代码
* @param string $hrb02_04_008  身份证件-号码
* @param string $hrb02_04_009  职业类别代码(国标)
* @param string $hrb02_04_010  工作单位名称
* @param string $hrb02_04_011  配偶姓名
* @param date $hrb02_04_012  配偶出生日期
* @param string $hrb02_04_013  配偶民族代码
* @param string $hrb02_04_014  配偶文化程度代码
* @param string $hrb02_04_015  配偶身份证件-类别代码
* @param string $hrb02_04_016  配偶身份证件-号码
* @param string $hrb02_04_017  配偶职业类别代码(国标)
* @param string $hrb02_04_018  配偶工作单位名称
* @param string $hrb02_04_019  母亲姓名
* @param string $hrb02_04_020  新生儿姓名
* @param string $hrb02_04_021  新生儿性别代码
* @param string $hrb02_04_022  地址类别代码
* @param string $hrb02_04_023  行政区划代码
* @param string $hrb02_04_024  地址-省（自治区、直辖市）
* @param string $hrb02_04_025  地址-市（地区）
* @param string $hrb02_04_026  地址-县（区）
* @param string $hrb02_04_027  地址-乡（镇、街道办事处）
* @param string $hrb02_04_028  地址-村（街、路、弄等）
* @param string $hrb02_04_029  地址-门牌号码
* @param string $hrb02_04_030  邮政编码
* @param string $hrb02_04_031  联系电话-类别
* @param string $hrb02_04_032  联系电话-类别代码
* @param string $hrb02_04_033  联系电话-号码
* @param string $hrb02_04_034  现病史
* @param string $hrb02_04_035  既往疾病史
* @param string $hrb02_04_036  手术史
* @param string $hrb02_04_037  过敏史
* @param string $hrb02_04_038  家族遗传性疾病史
* @param decimal $hrb02_04_039  初潮年龄（岁）
* @param decimal $hrb02_04_040  月经持续时间（d）
* @param string $hrb02_04_041  月经出血量类别代码
* @param decimal $hrb02_04_042  月经周期（d）
* @param date $hrb02_04_043  末次月经日期
* @param string $hrb02_04_044  痛经程度代码
* @param decimal $hrb02_04_045  孕次
* @param decimal $hrb02_04_046  产次
* @param decimal $hrb02_04_047  早产次数
* @param decimal $hrb02_04_048  自然流产次数
* @param decimal $hrb02_04_049  人工流产次数
* @param decimal $hrb02_04_050  剖宫产次数
* @param decimal $hrb02_04_051  阴道助产次数
* @param decimal $hrb02_04_052  死胎例数
* @param decimal $hrb02_04_053  死产例数
* @param string $hrb02_04_054  前次分娩方式代码
* @param string $hrb02_04_055  前次妊娠终止方式代码
* @param date $hrb02_04_056  前次分娩日期
* @param date $hrb02_04_057  前次妊娠终止日期
* @param decimal $hrb02_04_058  收缩压(mmHg)
* @param decimal $hrb02_04_059  舒张压(mmHg)
* @param decimal $hrb02_04_060  基础收缩压（mmHg）
* @param decimal $hrb02_04_061  基础舒张压（mmHg）
* @param decimal $hrb02_04_062  体温(℃)
* @param decimal $hrb02_04_063  新生儿体温（℃）
* @param string $hrb02_04_064  症状
* @param string $hrb02_04_065  体征
* @param decimal $hrb02_04_066  心率（次/分钟）
* @param decimal $hrb02_04_067  胎心率（次/分钟）
* @param decimal $hrb02_04_068  新生儿心率（次/分钟）
* @return boolean
*/
function update_hrb02_04($ws_id,$org_id,$doctor_id,$identity_number,$hrb02_04_069=0,$hrb02_04_070='',$hrb02_04_071='',$hrb02_04_072=0,$hrb02_04_073=0,$hrb02_04_074=0,$hrb02_04_075=0,$hrb02_04_076=0,$hrb02_04_077=0,$hrb02_04_078='',$hrb02_04_079='',$hrb02_04_080=0,$hrb02_04_081=0,$hrb02_04_082=0,$hrb02_04_083=0,$hrb02_04_084=0,$hrb02_04_085=0,$hrb02_04_086=0,$hrb02_04_087=0,$hrb02_04_088=0,$hrb02_04_089=0,$hrb02_04_090='',$hrb02_04_091='',$hrb02_04_092='',$hrb02_04_093=0,$hrb02_04_094=false,$hrb02_04_095=false,$hrb02_04_096='',$hrb02_04_097=false,$hrb02_04_098='',$hrb02_04_099=0,$hrb02_04_100=0,$hrb02_04_101='',$hrb02_04_102=0,$hrb02_04_103=0,$hrb02_04_104=0,$hrb02_04_105=0,$hrb02_04_106=0,$hrb02_04_107=0,$hrb02_04_108='',$hrb02_04_109=0,$hrb02_04_110='',$hrb02_04_111='',$hrb02_04_112='',$hrb02_04_113='',$hrb02_04_114='',$hrb02_04_115='',$hrb02_04_116='',$hrb02_04_117='',$hrb02_04_118='',$hrb02_04_119=false,$hrb02_04_120=0,$hrb02_04_121='',$hrb02_04_122='',$hrb02_04_123='',$hrb02_04_124='',$hrb02_04_125='',$hrb02_04_126='',$hrb02_04_127='',$hrb02_04_128='',$hrb02_04_129='',$hrb02_04_130='',$hrb02_04_131='',$hrb02_04_132='',$hrb02_04_133='',$hrb02_04_134='',$hrb02_04_135='',$hrb02_04_136=false,$hrb02_04_137='',$hrb02_04_138='',$hrb02_04_139=0,$hrb02_04_140='',$hrb02_04_141=0,$hrb02_04_142='',$hrb02_04_143='',$hrb02_04_144='',$hrb02_04_145='',$hrb02_04_146='',$hrb02_04_147='',$hrb02_04_148=0,$hrb02_04_149=0,$hrb02_04_150=0,$hrb02_04_151=0,$hrb02_04_152=0,$hrb02_04_153=0,$hrb02_04_154=0,$hrb02_04_155=0,$hrb02_04_156=0,$hrb02_04_157=0,$hrb02_04_158=0,$hrb02_04_159=0,$hrb02_04_160=0,$hrb02_04_161=0,$hrb02_04_162='',$hrb02_04_163='',$hrb02_04_164='',$hrb02_04_165='',$hrb02_04_166='',$hrb02_04_167='',$hrb02_04_168='',$hrb02_04_169='',$hrb02_04_170='',$hrb02_04_171=false,$hrb02_04_172=0,$hrb02_04_173='',$hrb02_04_174='',$hrb02_04_175='',$hrb02_04_176='',$hrb02_04_177='',$hrb02_04_178='',$hrb02_04_179='',$hrb02_04_180='',$hrb02_04_181='',$hrb02_04_182='',$hrb02_04_183='',$hrb02_04_184='',$hrb02_04_185='',$hrb02_04_186='',$hrb02_04_187='',$hrb02_04_188=false,$hrb02_04_189='',$hrb02_04_190=0,$hrb02_04_191=false,$hrb02_04_192='',$hrb02_04_193=false,$hrb02_04_194=false,$hrb02_04_195='',$hrb02_04_196='',$hrb02_04_197='',$hrb02_04_198='',$hrb02_04_199='',$hrb02_04_200='',$hrb02_04_201='',$hrb02_04_202='',$hrb02_04_203='',$hrb02_04_204='',$hrb02_04_205='',$hrb02_04_206=0,$hrb02_04_207='',$hrb02_04_208='',$hrb02_04_209='',$hrb02_04_210='',$hrb02_04_211='',$hrb02_04_212='',$hrb02_04_213='',$hrb02_04_214='',$hrb02_04_001='',$hrb02_04_002='',$hrb02_04_003='',$hrb02_04_004='',$hrb02_04_005='',$hrb02_04_006='',$hrb02_04_007='',$hrb02_04_008='',$hrb02_04_009='',$hrb02_04_010='',$hrb02_04_011='',$hrb02_04_012='',$hrb02_04_013='',$hrb02_04_014='',$hrb02_04_015='',$hrb02_04_016='',$hrb02_04_017='',$hrb02_04_018='',$hrb02_04_019='',$hrb02_04_020='',$hrb02_04_021='',$hrb02_04_022='',$hrb02_04_023='',$hrb02_04_024='',$hrb02_04_025='',$hrb02_04_026='',$hrb02_04_027='',$hrb02_04_028='',$hrb02_04_029='',$hrb02_04_030='',$hrb02_04_031='',$hrb02_04_032='',$hrb02_04_033='',$hrb02_04_034='',$hrb02_04_035='',$hrb02_04_036='',$hrb02_04_037='',$hrb02_04_038='',$hrb02_04_039=0,$hrb02_04_040=0,$hrb02_04_041='',$hrb02_04_042=0,$hrb02_04_043='',$hrb02_04_044='',$hrb02_04_045=0,$hrb02_04_046=0,$hrb02_04_047=0,$hrb02_04_048=0,$hrb02_04_049=0,$hrb02_04_050=0,$hrb02_04_051=0,$hrb02_04_052=0,$hrb02_04_053=0,$hrb02_04_054='',$hrb02_04_055='',$hrb02_04_056='',$hrb02_04_057='',$hrb02_04_058=0,$hrb02_04_059=0,$hrb02_04_060=0,$hrb02_04_061=0,$hrb02_04_062=0,$hrb02_04_063=0,$hrb02_04_064='',$hrb02_04_065='',$hrb02_04_066=0,$hrb02_04_067=0,$hrb02_04_068=0){
require_once(__SITEROOT.'library/Models/ws_hrb02_04.php');
$table_obj="Tws_hrb02_04";
$ws_hrb02_04=new $table_obj();
$ws_hrb02_04 -> ws_id=$ws_id;
$ws_hrb02_04 -> uuid=uniqid('',true);
$ws_hrb02_04 -> created=time();
$ws_hrb02_04 -> org_id=$org_id;
$ws_hrb02_04 -> doctor_id=$doctor_id;
$ws_hrb02_04 -> identity_number=$identity_number;//身份证号
$ws_hrb02_04 -> action='insert';
$ws_hrb02_04->hrb02_04_069 = $hrb02_04_069; //分娩孕周 
$ws_hrb02_04 ->hrb02_04_070 = empty($hrb02_04_070)?null : $ws_hrb02_04 ->escape('hrb02_04_070',to_date($hrb02_04_070,'YYYY-MM-DD')); //分娩日期时间 
$ws_hrb02_04->hrb02_04_071 = $hrb02_04_071; //分娩方式代码 
$ws_hrb02_04->hrb02_04_072 = $hrb02_04_072; //总产程时长（min） 
$ws_hrb02_04->hrb02_04_073 = $hrb02_04_073; //第一产程时长（min） 
$ws_hrb02_04->hrb02_04_074 = $hrb02_04_074; //第二产程时长（min） 
$ws_hrb02_04->hrb02_04_075 = $hrb02_04_075; //第三产程时长（min） 
$ws_hrb02_04->hrb02_04_076 = $hrb02_04_076; //产后开奶时长（min） 
$ws_hrb02_04->hrb02_04_077 = $hrb02_04_077; //产后天数（d） 
$ws_hrb02_04->hrb02_04_078 = $hrb02_04_078; //产时并发症代码 
$ws_hrb02_04->hrb02_04_079 = $hrb02_04_079; //分娩结局 
$ws_hrb02_04->hrb02_04_080 = $hrb02_04_080; //总出血量（ml） 
$ws_hrb02_04->hrb02_04_081 = $hrb02_04_081; //产时出血量（ml） 
$ws_hrb02_04->hrb02_04_082 = $hrb02_04_082; //产后两小时出血量（ml） 
$ws_hrb02_04->hrb02_04_083 = $hrb02_04_083; //体重（g） 
$ws_hrb02_04->hrb02_04_084 = $hrb02_04_084; //身长（cm） 
$ws_hrb02_04->hrb02_04_085 = $hrb02_04_085; //身高(cm) 
$ws_hrb02_04->hrb02_04_086 = $hrb02_04_086; //基础体重（kg） 
$ws_hrb02_04->hrb02_04_087 = $hrb02_04_087; //体重（kg） 
$ws_hrb02_04->hrb02_04_088 = $hrb02_04_088; //头围（cm） 
$ws_hrb02_04->hrb02_04_089 = $hrb02_04_089; //胸围（cm） 
$ws_hrb02_04->hrb02_04_090 = $hrb02_04_090; //恶露状况 
$ws_hrb02_04 ->hrb02_04_091 = empty($hrb02_04_091)?null : $ws_hrb02_04 ->escape('hrb02_04_091',to_date($hrb02_04_091,'YYYY-MM-DD')); //预产期 
$ws_hrb02_04->hrb02_04_092 = $hrb02_04_092; //孕期异常情况记录 
$ws_hrb02_04->hrb02_04_093 = $hrb02_04_093; //早孕反应开始孕周 
$ws_hrb02_04->hrb02_04_094 = $hrb02_04_094; //早孕反应标志 
$ws_hrb02_04->hrb02_04_095 = $hrb02_04_095; //危重孕产妇标志 
$ws_hrb02_04->hrb02_04_096 = $hrb02_04_096; //孕产期高危因素-代码 
$ws_hrb02_04->hrb02_04_097 = $hrb02_04_097; //孕产期高危因素-标志 
$ws_hrb02_04 ->hrb02_04_098 = empty($hrb02_04_098)?null : $ws_hrb02_04 ->escape('hrb02_04_098',to_date($hrb02_04_098,'YYYY-MM-DD')); //高危评分日期 
$ws_hrb02_04->hrb02_04_099 = $hrb02_04_099; //高危评分孕周 
$ws_hrb02_04->hrb02_04_100 = $hrb02_04_100; //高危评分值（分） 
$ws_hrb02_04->hrb02_04_101 = $hrb02_04_101; //高危妊娠级别代码 
$ws_hrb02_04->hrb02_04_102 = $hrb02_04_102; //腹围（cm） 
$ws_hrb02_04->hrb02_04_103 = $hrb02_04_103; //宫底高度（cm） 
$ws_hrb02_04->hrb02_04_104 = $hrb02_04_104; //骶耻外径（cm） 
$ws_hrb02_04->hrb02_04_105 = $hrb02_04_105; //髂棘间径（cm） 
$ws_hrb02_04->hrb02_04_106 = $hrb02_04_106; //髂嵴间径（cm） 
$ws_hrb02_04->hrb02_04_107 = $hrb02_04_107; //坐骨结节间径（cm） 
$ws_hrb02_04 ->hrb02_04_108 = empty($hrb02_04_108)?null : $ws_hrb02_04 ->escape('hrb02_04_108',to_date($hrb02_04_108,'YYYY-MM-DD')); //骨盆测量日期 
$ws_hrb02_04->hrb02_04_109 = $hrb02_04_109; //骨盆测量孕周 
$ws_hrb02_04->hrb02_04_110 = $hrb02_04_110; //口腔检查结果 
$ws_hrb02_04->hrb02_04_111 = $hrb02_04_111; //心脏听诊结果 
$ws_hrb02_04->hrb02_04_112 = $hrb02_04_112; //新生儿心脏听诊结果 
$ws_hrb02_04->hrb02_04_113 = $hrb02_04_113; //肺部听诊结果 
$ws_hrb02_04->hrb02_04_114 = $hrb02_04_114; //新生儿肺部听诊结果 
$ws_hrb02_04->hrb02_04_115 = $hrb02_04_115; //肝脏触诊结果 
$ws_hrb02_04->hrb02_04_116 = $hrb02_04_116; //脾脏触诊结果 
$ws_hrb02_04->hrb02_04_117 = $hrb02_04_117; //宫颈检查结果 
$ws_hrb02_04->hrb02_04_118 = $hrb02_04_118; //阴道检查结果 
$ws_hrb02_04->hrb02_04_119 = $hrb02_04_119; //会阴-切开标志 
$ws_hrb02_04->hrb02_04_120 = $hrb02_04_120; //会阴-缝合针数 
$ws_hrb02_04->hrb02_04_121 = $hrb02_04_121; //会阴裂伤程度代码 
$ws_hrb02_04->hrb02_04_122 = $hrb02_04_122; //子宫检查结果 
$ws_hrb02_04->hrb02_04_123 = $hrb02_04_123; //左侧附件检查结果代码 
$ws_hrb02_04->hrb02_04_124 = $hrb02_04_124; //右侧附件检查结果代码 
$ws_hrb02_04->hrb02_04_125 = $hrb02_04_125; //左侧乳腺检查结果代码 
$ws_hrb02_04->hrb02_04_126 = $hrb02_04_126; //右侧乳腺检查结果代码 
$ws_hrb02_04->hrb02_04_127 = $hrb02_04_127; //脊柱检查结果 
$ws_hrb02_04->hrb02_04_128 = $hrb02_04_128; //甲状腺检查结果 
$ws_hrb02_04->hrb02_04_129 = $hrb02_04_129; //皮肤毛发检查结果 
$ws_hrb02_04->hrb02_04_130 = $hrb02_04_130; //脐部检查结果 
$ws_hrb02_04->hrb02_04_131 = $hrb02_04_131; //外阴检查结果 
$ws_hrb02_04->hrb02_04_132 = $hrb02_04_132; //乳头检查结果 
$ws_hrb02_04->hrb02_04_133 = $hrb02_04_133; //乳汁量代码 
$ws_hrb02_04->hrb02_04_134 = $hrb02_04_134; //四肢检查结果 
$ws_hrb02_04->hrb02_04_135 = $hrb02_04_135; //浮肿程度代码 
$ws_hrb02_04->hrb02_04_136 = $hrb02_04_136; //衔接标志 
$ws_hrb02_04->hrb02_04_137 = $hrb02_04_137; //B超检查结果 
$ws_hrb02_04->hrb02_04_138 = $hrb02_04_138; //新生儿睡眠状况 
$ws_hrb02_04->hrb02_04_139 = $hrb02_04_139; //胎动孕周 
$ws_hrb02_04->hrb02_04_140 = $hrb02_04_140; //胎方位代码 
$ws_hrb02_04->hrb02_04_141 = $hrb02_04_141; //胎数 
$ws_hrb02_04->hrb02_04_142 = $hrb02_04_142; //胎先露代码 
$ws_hrb02_04->hrb02_04_143 = $hrb02_04_143; //ABO血型代码 
$ws_hrb02_04->hrb02_04_144 = $hrb02_04_144; //Rh血型代码 
$ws_hrb02_04->hrb02_04_145 = $hrb02_04_145; //新生儿黄疸程度代码 
$ws_hrb02_04->hrb02_04_146 = $hrb02_04_146; //肝功能检测结果代码 
$ws_hrb02_04->hrb02_04_147 = $hrb02_04_147; //肾功能检测结果代码 
$ws_hrb02_04->hrb02_04_148 = $hrb02_04_148; //血β-绒毛膜促性腺激素值（IU/L） 
$ws_hrb02_04->hrb02_04_149 = $hrb02_04_149; //血糖检测值（mmol/L） 
$ws_hrb02_04->hrb02_04_150 = $hrb02_04_150; //白细胞计数值(G/L) 
$ws_hrb02_04->hrb02_04_151 = $hrb02_04_151; //红细胞计数值（G/L） 
$ws_hrb02_04->hrb02_04_152 = $hrb02_04_152; //血小板计数值(G/L) 
$ws_hrb02_04->hrb02_04_153 = $hrb02_04_153; //出血时间（s） 
$ws_hrb02_04->hrb02_04_154 = $hrb02_04_154; //凝血时间（s） 
$ws_hrb02_04->hrb02_04_155 = $hrb02_04_155; //血红蛋白值（g/L） 
$ws_hrb02_04->hrb02_04_156 = $hrb02_04_156; //血清谷丙转氨酶值（U/L） 
$ws_hrb02_04->hrb02_04_157 = $hrb02_04_157; //尿比重 
$ws_hrb02_04->hrb02_04_158 = $hrb02_04_158; //尿蛋白定量检测值（mg/24h） 
$ws_hrb02_04->hrb02_04_159 = $hrb02_04_159; //尿糖定量检测(mmol/L) 
$ws_hrb02_04->hrb02_04_160 = $hrb02_04_160; //尿液酸碱度 
$ws_hrb02_04->hrb02_04_161 = $hrb02_04_161; //尿蛋白定量检测值（mg/24h） 
$ws_hrb02_04->hrb02_04_162 = $hrb02_04_162; //阴道分泌物性状描述 
$ws_hrb02_04->hrb02_04_163 = $hrb02_04_163; //滴虫检测结果代码 
$ws_hrb02_04->hrb02_04_164 = $hrb02_04_164; //念珠菌检测结果代码 
$ws_hrb02_04->hrb02_04_165 = $hrb02_04_165; //阴道分泌物清洁度代码 
$ws_hrb02_04->hrb02_04_166 = $hrb02_04_166; //乙型肝炎病毒表面抗原检测结果代码 
$ws_hrb02_04->hrb02_04_167 = $hrb02_04_167; //梅毒血清学试验结果代码 
$ws_hrb02_04->hrb02_04_168 = $hrb02_04_168; //淋球菌检查结果 
$ws_hrb02_04->hrb02_04_169 = $hrb02_04_169; //HIV抗体检测结果代码 
$ws_hrb02_04->hrb02_04_170 = $hrb02_04_170; //喂养方式类别代码 
$ws_hrb02_04->hrb02_04_171 = $hrb02_04_171; //臀红标志 
$ws_hrb02_04->hrb02_04_172 = $hrb02_04_172; //Apgar评分值（分） 
$ws_hrb02_04->hrb02_04_173 = $hrb02_04_173; //小便状况记录 
$ws_hrb02_04->hrb02_04_174 = $hrb02_04_174; //新生儿小便状况记录 
$ws_hrb02_04->hrb02_04_175 = $hrb02_04_175; //大便状况记录 
$ws_hrb02_04->hrb02_04_176 = $hrb02_04_176; //新生儿大便状况记录 
$ws_hrb02_04->hrb02_04_177 = $hrb02_04_177; //特殊情况记录 
$ws_hrb02_04->hrb02_04_178 = $hrb02_04_178; //新生儿特殊情况记录 
$ws_hrb02_04->hrb02_04_179 = $hrb02_04_179; //辅助检查-结果 
$ws_hrb02_04->hrb02_04_180 = $hrb02_04_180; //辅助检查-项目名称 
$ws_hrb02_04->hrb02_04_181 = $hrb02_04_181; //产后42天检查结果 
$ws_hrb02_04->hrb02_04_182 = $hrb02_04_182; //转诊记录 
$ws_hrb02_04->hrb02_04_183 = $hrb02_04_183; //孕产妇高危筛查机构名称 
$ws_hrb02_04->hrb02_04_184 = $hrb02_04_184; //高危妊娠转归代码 
$ws_hrb02_04->hrb02_04_185 = $hrb02_04_185; //妊娠合并症/并发症史 
$ws_hrb02_04->hrb02_04_186 = $hrb02_04_186; //妊娠诊断方法代码 
$ws_hrb02_04->hrb02_04_187 = $hrb02_04_187; //伤口愈合状况代码 
$ws_hrb02_04->hrb02_04_188 = $hrb02_04_188; //出生缺陷标志 
$ws_hrb02_04->hrb02_04_189 = $hrb02_04_189; //出生缺陷类别代码 
$ws_hrb02_04->hrb02_04_190 = $hrb02_04_190; //出生缺陷儿例数 
$ws_hrb02_04->hrb02_04_191 = $hrb02_04_191; //新生儿并发症-标志 
$ws_hrb02_04->hrb02_04_192 = $hrb02_04_192; //新生儿并发症-代码 
$ws_hrb02_04->hrb02_04_193 = $hrb02_04_193; //新生儿疾病筛查标志 
$ws_hrb02_04->hrb02_04_194 = $hrb02_04_194; //新生儿抢救标志 
$ws_hrb02_04->hrb02_04_195 = $hrb02_04_195; //新生儿抢救方法代码 
$ws_hrb02_04->hrb02_04_196 = $hrb02_04_196; //孕产妇死亡时间类别代码 
$ws_hrb02_04->hrb02_04_197 = $hrb02_04_197; //处理及指导意见 
$ws_hrb02_04->hrb02_04_198 = $hrb02_04_198; //新生儿处理及指导意见 
$ws_hrb02_04->hrb02_04_199 = $hrb02_04_199; //计划生育指导内容 
$ws_hrb02_04->hrb02_04_200 = $hrb02_04_200; //宣教内容 
$ws_hrb02_04->hrb02_04_201 = $hrb02_04_201; //检查（测）人员姓名 
$ws_hrb02_04->hrb02_04_202 = $hrb02_04_202; //检查（测）机构名称 
$ws_hrb02_04 ->hrb02_04_203 = empty($hrb02_04_203)?null : $ws_hrb02_04 ->escape('hrb02_04_203',to_date($hrb02_04_203,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrb02_04->hrb02_04_204 = $hrb02_04_204; //助产人员姓名 
$ws_hrb02_04->hrb02_04_205 = $hrb02_04_205; //助产机构名称 
$ws_hrb02_04->hrb02_04_206 = $hrb02_04_206; //建档孕周 
$ws_hrb02_04->hrb02_04_207 = $hrb02_04_207; //建档人员姓名 
$ws_hrb02_04->hrb02_04_208 = $hrb02_04_208; //建档机构名称 
$ws_hrb02_04 ->hrb02_04_209 = empty($hrb02_04_209)?null : $ws_hrb02_04 ->escape('hrb02_04_209',to_date($hrb02_04_209,'YYYY-MM-DD')); //结案日期 
$ws_hrb02_04->hrb02_04_210 = $hrb02_04_210; //结案单位名称 
$ws_hrb02_04 ->hrb02_04_211 = empty($hrb02_04_211)?null : $ws_hrb02_04 ->escape('hrb02_04_211',to_date($hrb02_04_211,'YYYY-MM-DD')); //预约日期 
$ws_hrb02_04 ->hrb02_04_212 = empty($hrb02_04_212)?null : $ws_hrb02_04 ->escape('hrb02_04_212',to_date($hrb02_04_212,'YYYY-MM-DD')); //访视日期 
$ws_hrb02_04->hrb02_04_213 = $hrb02_04_213; //访视人员姓名 
$ws_hrb02_04->hrb02_04_214 = $hrb02_04_214; //访视机构名称 
$ws_hrb02_04->hrb02_04_001 = $hrb02_04_001; //记录表单编号 
$ws_hrb02_04->hrb02_04_002 = $hrb02_04_002; //住院号 
$ws_hrb02_04->hrb02_04_003 = $hrb02_04_003; //姓名 
$ws_hrb02_04 ->hrb02_04_004 = empty($hrb02_04_004)?null : $ws_hrb02_04 ->escape('hrb02_04_004',to_date($hrb02_04_004,'YYYY-MM-DD')); //出生日期 
$ws_hrb02_04->hrb02_04_005 = $hrb02_04_005; //民族代码 
$ws_hrb02_04->hrb02_04_006 = $hrb02_04_006; //文化程度代码 
$ws_hrb02_04->hrb02_04_007 = $hrb02_04_007; //身份证件-类别代码 
$ws_hrb02_04->hrb02_04_008 = $hrb02_04_008; //身份证件-号码 
$ws_hrb02_04->hrb02_04_009 = $hrb02_04_009; //职业类别代码(国标) 
$ws_hrb02_04->hrb02_04_010 = $hrb02_04_010; //工作单位名称 
$ws_hrb02_04->hrb02_04_011 = $hrb02_04_011; //配偶姓名 
$ws_hrb02_04 ->hrb02_04_012 = empty($hrb02_04_012)?null : $ws_hrb02_04 ->escape('hrb02_04_012',to_date($hrb02_04_012,'YYYY-MM-DD')); //配偶出生日期 
$ws_hrb02_04->hrb02_04_013 = $hrb02_04_013; //配偶民族代码 
$ws_hrb02_04->hrb02_04_014 = $hrb02_04_014; //配偶文化程度代码 
$ws_hrb02_04->hrb02_04_015 = $hrb02_04_015; //配偶身份证件-类别代码 
$ws_hrb02_04->hrb02_04_016 = $hrb02_04_016; //配偶身份证件-号码 
$ws_hrb02_04->hrb02_04_017 = $hrb02_04_017; //配偶职业类别代码(国标) 
$ws_hrb02_04->hrb02_04_018 = $hrb02_04_018; //配偶工作单位名称 
$ws_hrb02_04->hrb02_04_019 = $hrb02_04_019; //母亲姓名 
$ws_hrb02_04->hrb02_04_020 = $hrb02_04_020; //新生儿姓名 
$ws_hrb02_04->hrb02_04_021 = $hrb02_04_021; //新生儿性别代码 
$ws_hrb02_04->hrb02_04_022 = $hrb02_04_022; //地址类别代码 
$ws_hrb02_04->hrb02_04_023 = $hrb02_04_023; //行政区划代码 
$ws_hrb02_04->hrb02_04_024 = $hrb02_04_024; //地址-省（自治区、直辖市） 
$ws_hrb02_04->hrb02_04_025 = $hrb02_04_025; //地址-市（地区） 
$ws_hrb02_04->hrb02_04_026 = $hrb02_04_026; //地址-县（区） 
$ws_hrb02_04->hrb02_04_027 = $hrb02_04_027; //地址-乡（镇、街道办事处） 
$ws_hrb02_04->hrb02_04_028 = $hrb02_04_028; //地址-村（街、路、弄等） 
$ws_hrb02_04->hrb02_04_029 = $hrb02_04_029; //地址-门牌号码 
$ws_hrb02_04->hrb02_04_030 = $hrb02_04_030; //邮政编码 
$ws_hrb02_04->hrb02_04_031 = $hrb02_04_031; //联系电话-类别 
$ws_hrb02_04->hrb02_04_032 = $hrb02_04_032; //联系电话-类别代码 
$ws_hrb02_04->hrb02_04_033 = $hrb02_04_033; //联系电话-号码 
$ws_hrb02_04->hrb02_04_034 = $hrb02_04_034; //现病史 
$ws_hrb02_04->hrb02_04_035 = $hrb02_04_035; //既往疾病史 
$ws_hrb02_04->hrb02_04_036 = $hrb02_04_036; //手术史 
$ws_hrb02_04->hrb02_04_037 = $hrb02_04_037; //过敏史 
$ws_hrb02_04->hrb02_04_038 = $hrb02_04_038; //家族遗传性疾病史 
$ws_hrb02_04->hrb02_04_039 = $hrb02_04_039; //初潮年龄（岁） 
$ws_hrb02_04->hrb02_04_040 = $hrb02_04_040; //月经持续时间（d） 
$ws_hrb02_04->hrb02_04_041 = $hrb02_04_041; //月经出血量类别代码 
$ws_hrb02_04->hrb02_04_042 = $hrb02_04_042; //月经周期（d） 
$ws_hrb02_04 ->hrb02_04_043 = empty($hrb02_04_043)?null : $ws_hrb02_04 ->escape('hrb02_04_043',to_date($hrb02_04_043,'YYYY-MM-DD')); //末次月经日期 
$ws_hrb02_04->hrb02_04_044 = $hrb02_04_044; //痛经程度代码 
$ws_hrb02_04->hrb02_04_045 = $hrb02_04_045; //孕次 
$ws_hrb02_04->hrb02_04_046 = $hrb02_04_046; //产次 
$ws_hrb02_04->hrb02_04_047 = $hrb02_04_047; //早产次数 
$ws_hrb02_04->hrb02_04_048 = $hrb02_04_048; //自然流产次数 
$ws_hrb02_04->hrb02_04_049 = $hrb02_04_049; //人工流产次数 
$ws_hrb02_04->hrb02_04_050 = $hrb02_04_050; //剖宫产次数 
$ws_hrb02_04->hrb02_04_051 = $hrb02_04_051; //阴道助产次数 
$ws_hrb02_04->hrb02_04_052 = $hrb02_04_052; //死胎例数 
$ws_hrb02_04->hrb02_04_053 = $hrb02_04_053; //死产例数 
$ws_hrb02_04->hrb02_04_054 = $hrb02_04_054; //前次分娩方式代码 
$ws_hrb02_04->hrb02_04_055 = $hrb02_04_055; //前次妊娠终止方式代码 
$ws_hrb02_04 ->hrb02_04_056 = empty($hrb02_04_056)?null : $ws_hrb02_04 ->escape('hrb02_04_056',to_date($hrb02_04_056,'YYYY-MM-DD')); //前次分娩日期 
$ws_hrb02_04 ->hrb02_04_057 = empty($hrb02_04_057)?null : $ws_hrb02_04 ->escape('hrb02_04_057',to_date($hrb02_04_057,'YYYY-MM-DD')); //前次妊娠终止日期 
$ws_hrb02_04->hrb02_04_058 = $hrb02_04_058; //收缩压(mmHg) 
$ws_hrb02_04->hrb02_04_059 = $hrb02_04_059; //舒张压(mmHg) 
$ws_hrb02_04->hrb02_04_060 = $hrb02_04_060; //基础收缩压（mmHg） 
$ws_hrb02_04->hrb02_04_061 = $hrb02_04_061; //基础舒张压（mmHg） 
$ws_hrb02_04->hrb02_04_062 = $hrb02_04_062; //体温(℃) 
$ws_hrb02_04->hrb02_04_063 = $hrb02_04_063; //新生儿体温（℃） 
$ws_hrb02_04->hrb02_04_064 = $hrb02_04_064; //症状 
$ws_hrb02_04->hrb02_04_065 = $hrb02_04_065; //体征 
$ws_hrb02_04->hrb02_04_066 = $hrb02_04_066; //心率（次/分钟） 
$ws_hrb02_04->hrb02_04_067 = $hrb02_04_067; //胎心率（次/分钟） 
$ws_hrb02_04->hrb02_04_068 = $hrb02_04_068; //新生儿心率（次/分钟） 
if($ws_hrb02_04 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb02_04 ->free_statement();
}
