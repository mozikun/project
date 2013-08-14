<?php
/**
职业性健康监护基本数据集标准HRB03.08职业性健康监护基本数据集标准
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrb03_08_218  精液检查结果
* @param decimal $hrb03_08_219  全身计数器检查结果（Bq）
* @param string $hrb03_08_220  染色体畸变-类型
* @param decimal $hrb03_08_221  染色体畸变-百分率（％）
* @param decimal $hrb03_08_222  染色体畸变-数量
* @param decimal $hrb03_08_223  染色体中期分裂细胞数
* @param decimal $hrb03_08_224  微核淋巴细胞千分比（‰）
* @param decimal $hrb03_08_225  淋巴细胞微核千分比（‰）
* @param string $hrb03_08_226  乙型肝炎病毒e抗体检测结果代码
* @param string $hrb03_08_227  乙型肝炎病毒e抗原检测结果代码
* @param string $hrb03_08_228  乙型肝炎病毒e抗原检测结果代码
* @param string $hrb03_08_229  乙型肝炎病毒表面抗体检测结果代码
* @param string $hrb03_08_230  乙型肝炎病毒表面抗原检测结果代码
* @param string $hrb03_08_231  乙型肝炎病毒核心抗体检测结果代码
* @param decimal $hrb03_08_232  最大肺活量（L）
* @param decimal $hrb03_08_233  一秒钟用力呼气量（ml）
* @param decimal $hrb03_08_234  一秒钟用力呼气量/最大肺活量百分比（%）
* @param string $hrb03_08_235  腹部B超检查结果
* @param string $hrb03_08_236  脑电图检查结果
* @param string $hrb03_08_237  听觉诱发电位检查结果
* @param string $hrb03_08_238  视觉诱发电位检查结果
* @param string $hrb03_08_239  神经肌电图检查结果
* @param string $hrb03_08_240  心电图检查结果
* @param string $hrb03_08_241  心功能检查结果
* @param string $hrb03_08_242  胸部X线检查结果
* @param decimal $hrb03_08_243  受照剂量（Gy）
* @param string $hrb03_08_244  职业健康检查结论代码
* @param string $hrb03_08_245  职业病名称代码
* @param string $hrb03_08_246  检查（测）人员姓名
* @param string $hrb03_08_247  检查（测）机构名称
* @param string $hrb03_08_248  诊断机构名称
* @param date $hrb03_08_249  检查（测）日期
* @param date $hrb03_08_250  诊断日期
* @param string $hrb03_08_001  记录表单编号
* @param string $hrb03_08_002  姓名
* @param string $hrb03_08_003  性别代码
* @param date $hrb03_08_004  出生日期
* @param string $hrb03_08_005  身份证件-类别代码
* @param string $hrb03_08_006  身份证件-号码
* @param string $hrb03_08_007  文化程度代码
* @param string $hrb03_08_008  民族代码
* @param string $hrb03_08_009  婚姻状况类别代码
* @param date $hrb03_08_010  结婚日期
* @param string $hrb03_08_011  联系电话-类别
* @param string $hrb03_08_012  联系电话-类别代码
* @param string $hrb03_08_013  联系电话-号码
* @param string $hrb03_08_014  工作单位名称
* @param string $hrb03_08_015  配偶职业类别代码(国标)
* @param string $hrb03_08_016  地址类别代码
* @param string $hrb03_08_017  行政区划代码
* @param string $hrb03_08_018  地址-省（自治区、直辖市）
* @param string $hrb03_08_019  地址-市（地区）
* @param string $hrb03_08_020  地址-县（区）
* @param string $hrb03_08_021  地址-乡（镇、街道办事处）
* @param string $hrb03_08_022  地址-村（街、路、弄等）
* @param string $hrb03_08_023  地址-门牌号码
* @param string $hrb03_08_024  邮政编码
* @param string $hrb03_08_025  体检类别代码
* @param decimal $hrb03_08_026  初潮年龄（岁）
* @param decimal $hrb03_08_027  绝经年龄（岁）
* @param decimal $hrb03_08_028  月经周期（d）
* @param decimal $hrb03_08_029  月经持续时间（d）
* @param boolean $hrb03_08_030  月经异常标志
* @param decimal $hrb03_08_031  早产次数
* @param decimal $hrb03_08_032  异常胎次数
* @param decimal $hrb03_08_033  流产总次数
* @param decimal $hrb03_08_034  现有子女数
* @param string $hrb03_08_035  过量照射史
* @param string $hrb03_08_036  既往疾病史
* @param string $hrb03_08_037  家族遗传性疾病史
* @param string $hrb03_08_038  非放射工作职业史
* @param boolean $hrb03_08_039  吸烟标志
* @param decimal $hrb03_08_040  日吸烟量(支)
* @param decimal $hrb03_08_041  吸烟时长（年）
* @param boolean $hrb03_08_042  饮酒标志
* @param decimal $hrb03_08_043  日饮酒量(两)
* @param decimal $hrb03_08_044  饮酒时长（年）
* @param date $hrb03_08_045  从事毒害职业开始日期
* @param date $hrb03_08_046  从事毒害职业终止日期
* @param decimal $hrb03_08_047  每日工作时长（h）
* @param string $hrb03_08_048  射线装置种类代码
* @param string $hrb03_08_049  配偶健康状况
* @param boolean $hrb03_08_050  鼻堵标志
* @param boolean $hrb03_08_051  便秘标志
* @param boolean $hrb03_08_052  盗汗标志
* @param boolean $hrb03_08_053  动作不灵活标志
* @param boolean $hrb03_08_054  多汗-标志
* @param string $hrb03_08_055  多汗-部位
* @param boolean $hrb03_08_056  多梦标志
* @param boolean $hrb03_08_057  恶心标志
* @param boolean $hrb03_08_058  耳鸣标志
* @param boolean $hrb03_08_059  腹痛标志
* @param boolean $hrb03_08_060  腹泻标志
* @param boolean $hrb03_08_061  腹胀标志
* @param boolean $hrb03_08_062  咯血标志
* @param boolean $hrb03_08_063  关节痛标志
* @param boolean $hrb03_08_064  记忆力减退标志
* @param boolean $hrb03_08_065  咳嗽标志
* @param boolean $hrb03_08_066  咳痰标志
* @param boolean $hrb03_08_067  口渴标志
* @param boolean $hrb03_08_068  流泪标志
* @param boolean $hrb03_08_069  流涕标志
* @param boolean $hrb03_08_070  流涎标志
* @param boolean $hrb03_08_071  尿急标志
* @param boolean $hrb03_08_072  尿频标志
* @param boolean $hrb03_08_073  尿血标志
* @param boolean $hrb03_08_074  呕吐标志
* @param string $hrb03_08_075  配偶接触放射线情况
* @param boolean $hrb03_08_076  疲乏无力标志
* @param boolean $hrb03_08_077  皮肤瘙痒标志
* @param boolean $hrb03_08_078  全身酸痛标志
* @param boolean $hrb03_08_079  失眠标志
* @param boolean $hrb03_08_080  食欲减退标志
* @param boolean $hrb03_08_081  视力下降标志
* @param boolean $hrb03_08_082  视物模糊标志
* @param boolean $hrb03_08_083  嗜睡标志
* @param boolean $hrb03_08_084  刷牙出血标志
* @param decimal $hrb03_08_085  死产例数
* @param boolean $hrb03_08_086  四肢麻木标志
* @param boolean $hrb03_08_087  头昏标志
* @param boolean $hrb03_08_088  头痛标志
* @param boolean $hrb03_08_089  哮喘标志
* @param boolean $hrb03_08_090  心悸标志
* @param boolean $hrb03_08_091  心前区不适标志
* @param boolean $hrb03_08_092  性欲减退标志
* @param boolean $hrb03_08_093  胸闷标志
* @param boolean $hrb03_08_094  胸痛标志
* @param boolean $hrb03_08_095  羞明标志
* @param boolean $hrb03_08_096  嗅觉减退标志
* @param boolean $hrb03_08_097  眩晕标志
* @param boolean $hrb03_08_098  牙齿松动标志
* @param boolean $hrb03_08_099  牙痛标志
* @param boolean $hrb03_08_100  咽痛标志
* @param boolean $hrb03_08_101  眼痛标志
* @param boolean $hrb03_08_102  易激动标志
* @param string $hrb03_08_103  职业照射种类代码
* @param string $hrb03_08_104  一般状况检查结果
* @param decimal $hrb03_08_105  身高(cm)
* @param decimal $hrb03_08_106  体重（kg）
* @param decimal $hrb03_08_107  呼吸频率（次/分钟）
* @param decimal $hrb03_08_108  脉率（次/分钟）
* @param decimal $hrb03_08_109  收缩压(mmHg)
* @param decimal $hrb03_08_110  舒张压(mmHg)
* @param string $hrb03_08_111  四肢检查结果
* @param string $hrb03_08_112  发育程度代码
* @param string $hrb03_08_113  营养状态代码
* @param string $hrb03_08_114  感觉异常
* @param string $hrb03_08_115  心律
* @param decimal $hrb03_08_116  心率（次/分钟）
* @param string $hrb03_08_117  心脏听诊结果
* @param string $hrb03_08_118  病理反射检查结果
* @param string $hrb03_08_119  玻璃体检查结果
* @param string $hrb03_08_120  鼻部检查结果
* @param boolean $hrb03_08_121  鼻干标志
* @param boolean $hrb03_08_122  鼻血标志
* @param boolean $hrb03_08_123  低热标志
* @param boolean $hrb03_08_124  耳聋标志
* @param boolean $hrb03_08_125  气短标志
* @param boolean $hrb03_08_126  浮肿标志
* @param boolean $hrb03_08_127  肝区痛标志
* @param boolean $hrb03_08_128  口腔溃疡标志
* @param boolean $hrb03_08_129  消瘦标志
* @param boolean $hrb03_08_130  脱发标志
* @param boolean $hrb03_08_131  肾区叩痛标志
* @param boolean $hrb03_08_132  皮疹标志
* @param boolean $hrb03_08_133  口腔异味标志
* @param boolean $hrb03_08_134  皮下出血标志
* @param string $hrb03_08_135  肝脏触诊结果
* @param string $hrb03_08_136  肺部听诊结果
* @param string $hrb03_08_137  跟腱反射检查结果
* @param string $hrb03_08_138  共济运动检查结果
* @param string $hrb03_08_139  干燥部位
* @param string $hrb03_08_140  过度角化部位
* @param string $hrb03_08_141  肌力检查结果
* @param string $hrb03_08_142  肌张力检查结果
* @param string $hrb03_08_143  脊柱检查结果
* @param string $hrb03_08_144  甲状腺检查结果
* @param string $hrb03_08_145  晶体裂隙灯检查结果
* @param string $hrb03_08_146  皮肤和粘膜检查结果
* @param string $hrb03_08_147  脾脏触诊结果
* @param string $hrb03_08_148  皮肤划纹症检查结果
* @param string $hrb03_08_149  浅表淋巴结检查结果
* @param string $hrb03_08_150  三颤检查结果
* @param string $hrb03_08_151  色觉检查结果
* @param string $hrb03_08_152  口腔检查结果
* @param string $hrb03_08_153  指甲检查结果
* @param string $hrb03_08_154  膝反射检查结果
* @param string $hrb03_08_155  嗅觉检查结果
* @param string $hrb03_08_156  咽部检查结果
* @param string $hrb03_08_157  肾脏检查结果
* @param string $hrb03_08_158  皮疹部位
* @param string $hrb03_08_159  皮肤萎缩部位
* @param string $hrb03_08_160  皲裂部位
* @param string $hrb03_08_161  疣状物部位
* @param string $hrb03_08_162  色素沉着部位
* @param string $hrb03_08_163  色素减退部位
* @param string $hrb03_08_164  溃疡部位
* @param string $hrb03_08_165  紫癜部位
* @param string $hrb03_08_166  脱发部位
* @param string $hrb03_08_167  脱毛部位
* @param string $hrb03_08_168  脱屑部位
* @param string $hrb03_08_169  左侧听力检测结果
* @param string $hrb03_08_170  右侧听力检测结果
* @param string $hrb03_08_171  视野检查结果
* @param string $hrb03_08_172  眼底检查结果
* @param decimal $hrb03_08_173  右眼矫正近视力值
* @param decimal $hrb03_08_174  右眼矫正远视力值
* @param decimal $hrb03_08_175  右眼裸眼近视力值
* @param decimal $hrb03_08_176  右眼裸眼远视力值
* @param decimal $hrb03_08_177  左眼矫正近视力值
* @param decimal $hrb03_08_178  左眼矫正远视力值
* @param decimal $hrb03_08_179  左眼裸眼近视力值
* @param decimal $hrb03_08_180  左眼裸眼远视力值
* @param decimal $hrb03_08_181  白细胞计数值(G/L)
* @param decimal $hrb03_08_182  红细胞计数值（G/L）
* @param decimal $hrb03_08_183  淋巴细胞百分率（％）
* @param decimal $hrb03_08_184  嗜碱性粒细胞百分率（％）
* @param decimal $hrb03_08_185  嗜酸性粒细胞百分率（％）
* @param decimal $hrb03_08_186  中性分叶核粒细胞百分率（％）
* @param decimal $hrb03_08_187  中性杆状核粒细胞百分率（％）
* @param decimal $hrb03_08_188  血胆碱酯酶活性（％）
* @param decimal $hrb03_08_189  血红蛋白值（g/L）
* @param decimal $hrb03_08_190  血尿素氮检测值(mmol/L)
* @param decimal $hrb03_08_191  血铅检测值（nmol/L）
* @param decimal $hrb03_08_192  血清肌酐检测值（μmol/L）
* @param decimal $hrb03_08_193  血清总胆红素检测值（μmol/L）
* @param decimal $hrb03_08_194  血糖检测值（mmol/L）
* @param decimal $hrb03_08_195  血小板计数值(G/L)
* @param decimal $hrb03_08_196  血锌原卟啉检测值（μmol/L）
* @param decimal $hrb03_08_197  丙氨酸氨基转移酶检测值(U/L)
* @param decimal $hrb03_08_198  促甲状腺激素检测值(mU/L)
* @param decimal $hrb03_08_199  单核细胞检测值（G/L）
* @param decimal $hrb03_08_200  睾丸酮检测值（nmol/L）
* @param decimal $hrb03_08_201  甲状腺素检测值（nmol/L）
* @param decimal $hrb03_08_202  尿白细胞计数值（个/H）
* @param decimal $hrb03_08_203  游离三碘甲状腺原氨酸检测结果（pmol/L）
* @param string $hrb03_08_204  尿常规镜检结果
* @param decimal $hrb03_08_205  尿蛋白定量检测值（mg/24h）
* @param string $hrb03_08_206  尿液外观
* @param string $hrb03_08_207  尿管型检查结果
* @param decimal $hrb03_08_208  尿糖定量检测(mmol/L)
* @param decimal $hrb03_08_209  尿氟检测值（mg/L）
* @param decimal $hrb03_08_210  尿镉检测值（μg/L）
* @param decimal $hrb03_08_211  尿红细胞计数值（个/H）
* @param decimal $hrb03_08_212  尿锰检测值（mg/L）
* @param decimal $hrb03_08_213  尿铅检测值（μmol/L）
* @param decimal $hrb03_08_214  尿砷检测值（mg/L）
* @param decimal $hrb03_08_215  尿β２-微球蛋白值（mg/L）
* @param decimal $hrb03_08_216  尿δ-氨基乙酰丙酸值（mg/L）
* @param string $hrb03_08_217  痰细胞学检查结果
* @return boolean
*/
function update_hrb03_08($ws_id,$org_id,$doctor_id,$identity_number,$hrb03_08_218='',$hrb03_08_219=0,$hrb03_08_220='',$hrb03_08_221=0,$hrb03_08_222=0,$hrb03_08_223=0,$hrb03_08_224=0,$hrb03_08_225=0,$hrb03_08_226='',$hrb03_08_227='',$hrb03_08_228='',$hrb03_08_229='',$hrb03_08_230='',$hrb03_08_231='',$hrb03_08_232=0,$hrb03_08_233=0,$hrb03_08_234=0,$hrb03_08_235='',$hrb03_08_236='',$hrb03_08_237='',$hrb03_08_238='',$hrb03_08_239='',$hrb03_08_240='',$hrb03_08_241='',$hrb03_08_242='',$hrb03_08_243=0,$hrb03_08_244='',$hrb03_08_245='',$hrb03_08_246='',$hrb03_08_247='',$hrb03_08_248='',$hrb03_08_249='',$hrb03_08_250='',$hrb03_08_001='',$hrb03_08_002='',$hrb03_08_003='',$hrb03_08_004='',$hrb03_08_005='',$hrb03_08_006='',$hrb03_08_007='',$hrb03_08_008='',$hrb03_08_009='',$hrb03_08_010='',$hrb03_08_011='',$hrb03_08_012='',$hrb03_08_013='',$hrb03_08_014='',$hrb03_08_015='',$hrb03_08_016='',$hrb03_08_017='',$hrb03_08_018='',$hrb03_08_019='',$hrb03_08_020='',$hrb03_08_021='',$hrb03_08_022='',$hrb03_08_023='',$hrb03_08_024='',$hrb03_08_025='',$hrb03_08_026=0,$hrb03_08_027=0,$hrb03_08_028=0,$hrb03_08_029=0,$hrb03_08_030=false,$hrb03_08_031=0,$hrb03_08_032=0,$hrb03_08_033=0,$hrb03_08_034=0,$hrb03_08_035='',$hrb03_08_036='',$hrb03_08_037='',$hrb03_08_038='',$hrb03_08_039=false,$hrb03_08_040=0,$hrb03_08_041=0,$hrb03_08_042=false,$hrb03_08_043=0,$hrb03_08_044=0,$hrb03_08_045='',$hrb03_08_046='',$hrb03_08_047=0,$hrb03_08_048='',$hrb03_08_049='',$hrb03_08_050=false,$hrb03_08_051=false,$hrb03_08_052=false,$hrb03_08_053=false,$hrb03_08_054=false,$hrb03_08_055='',$hrb03_08_056=false,$hrb03_08_057=false,$hrb03_08_058=false,$hrb03_08_059=false,$hrb03_08_060=false,$hrb03_08_061=false,$hrb03_08_062=false,$hrb03_08_063=false,$hrb03_08_064=false,$hrb03_08_065=false,$hrb03_08_066=false,$hrb03_08_067=false,$hrb03_08_068=false,$hrb03_08_069=false,$hrb03_08_070=false,$hrb03_08_071=false,$hrb03_08_072=false,$hrb03_08_073=false,$hrb03_08_074=false,$hrb03_08_075='',$hrb03_08_076=false,$hrb03_08_077=false,$hrb03_08_078=false,$hrb03_08_079=false,$hrb03_08_080=false,$hrb03_08_081=false,$hrb03_08_082=false,$hrb03_08_083=false,$hrb03_08_084=false,$hrb03_08_085=0,$hrb03_08_086=false,$hrb03_08_087=false,$hrb03_08_088=false,$hrb03_08_089=false,$hrb03_08_090=false,$hrb03_08_091=false,$hrb03_08_092=false,$hrb03_08_093=false,$hrb03_08_094=false,$hrb03_08_095=false,$hrb03_08_096=false,$hrb03_08_097=false,$hrb03_08_098=false,$hrb03_08_099=false,$hrb03_08_100=false,$hrb03_08_101=false,$hrb03_08_102=false,$hrb03_08_103='',$hrb03_08_104='',$hrb03_08_105=0,$hrb03_08_106=0,$hrb03_08_107=0,$hrb03_08_108=0,$hrb03_08_109=0,$hrb03_08_110=0,$hrb03_08_111='',$hrb03_08_112='',$hrb03_08_113='',$hrb03_08_114='',$hrb03_08_115='',$hrb03_08_116=0,$hrb03_08_117='',$hrb03_08_118='',$hrb03_08_119='',$hrb03_08_120='',$hrb03_08_121=false,$hrb03_08_122=false,$hrb03_08_123=false,$hrb03_08_124=false,$hrb03_08_125=false,$hrb03_08_126=false,$hrb03_08_127=false,$hrb03_08_128=false,$hrb03_08_129=false,$hrb03_08_130=false,$hrb03_08_131=false,$hrb03_08_132=false,$hrb03_08_133=false,$hrb03_08_134=false,$hrb03_08_135='',$hrb03_08_136='',$hrb03_08_137='',$hrb03_08_138='',$hrb03_08_139='',$hrb03_08_140='',$hrb03_08_141='',$hrb03_08_142='',$hrb03_08_143='',$hrb03_08_144='',$hrb03_08_145='',$hrb03_08_146='',$hrb03_08_147='',$hrb03_08_148='',$hrb03_08_149='',$hrb03_08_150='',$hrb03_08_151='',$hrb03_08_152='',$hrb03_08_153='',$hrb03_08_154='',$hrb03_08_155='',$hrb03_08_156='',$hrb03_08_157='',$hrb03_08_158='',$hrb03_08_159='',$hrb03_08_160='',$hrb03_08_161='',$hrb03_08_162='',$hrb03_08_163='',$hrb03_08_164='',$hrb03_08_165='',$hrb03_08_166='',$hrb03_08_167='',$hrb03_08_168='',$hrb03_08_169='',$hrb03_08_170='',$hrb03_08_171='',$hrb03_08_172='',$hrb03_08_173=0,$hrb03_08_174=0,$hrb03_08_175=0,$hrb03_08_176=0,$hrb03_08_177=0,$hrb03_08_178=0,$hrb03_08_179=0,$hrb03_08_180=0,$hrb03_08_181=0,$hrb03_08_182=0,$hrb03_08_183=0,$hrb03_08_184=0,$hrb03_08_185=0,$hrb03_08_186=0,$hrb03_08_187=0,$hrb03_08_188=0,$hrb03_08_189=0,$hrb03_08_190=0,$hrb03_08_191=0,$hrb03_08_192=0,$hrb03_08_193=0,$hrb03_08_194=0,$hrb03_08_195=0,$hrb03_08_196=0,$hrb03_08_197=0,$hrb03_08_198=0,$hrb03_08_199=0,$hrb03_08_200=0,$hrb03_08_201=0,$hrb03_08_202=0,$hrb03_08_203=0,$hrb03_08_204='',$hrb03_08_205=0,$hrb03_08_206='',$hrb03_08_207='',$hrb03_08_208=0,$hrb03_08_209=0,$hrb03_08_210=0,$hrb03_08_211=0,$hrb03_08_212=0,$hrb03_08_213=0,$hrb03_08_214=0,$hrb03_08_215=0,$hrb03_08_216=0,$hrb03_08_217=''){
require_once(__SITEROOT.'library/Models/ws_hrb03_08.php');
$table_obj="Tws_hrb03_08";
$ws_hrb03_08=new $table_obj();
$ws_hrb03_08 -> ws_id=$ws_id;
$ws_hrb03_08 -> uuid=uniqid('',true);
$ws_hrb03_08 -> created=time();
$ws_hrb03_08 -> org_id=$org_id;
$ws_hrb03_08 -> doctor_id=$doctor_id;
$ws_hrb03_08 -> identity_number=$identity_number;//身份证号
$ws_hrb03_08 -> action='insert';
$ws_hrb03_08->hrb03_08_218 = $hrb03_08_218; //精液检查结果 
$ws_hrb03_08->hrb03_08_219 = $hrb03_08_219; //全身计数器检查结果（Bq） 
$ws_hrb03_08->hrb03_08_220 = $hrb03_08_220; //染色体畸变-类型 
$ws_hrb03_08->hrb03_08_221 = $hrb03_08_221; //染色体畸变-百分率（％） 
$ws_hrb03_08->hrb03_08_222 = $hrb03_08_222; //染色体畸变-数量 
$ws_hrb03_08->hrb03_08_223 = $hrb03_08_223; //染色体中期分裂细胞数 
$ws_hrb03_08->hrb03_08_224 = $hrb03_08_224; //微核淋巴细胞千分比（‰） 
$ws_hrb03_08->hrb03_08_225 = $hrb03_08_225; //淋巴细胞微核千分比（‰） 
$ws_hrb03_08->hrb03_08_226 = $hrb03_08_226; //乙型肝炎病毒e抗体检测结果代码 
$ws_hrb03_08->hrb03_08_227 = $hrb03_08_227; //乙型肝炎病毒e抗原检测结果代码 
$ws_hrb03_08->hrb03_08_228 = $hrb03_08_228; //乙型肝炎病毒e抗原检测结果代码 
$ws_hrb03_08->hrb03_08_229 = $hrb03_08_229; //乙型肝炎病毒表面抗体检测结果代码 
$ws_hrb03_08->hrb03_08_230 = $hrb03_08_230; //乙型肝炎病毒表面抗原检测结果代码 
$ws_hrb03_08->hrb03_08_231 = $hrb03_08_231; //乙型肝炎病毒核心抗体检测结果代码 
$ws_hrb03_08->hrb03_08_232 = $hrb03_08_232; //最大肺活量（L） 
$ws_hrb03_08->hrb03_08_233 = $hrb03_08_233; //一秒钟用力呼气量（ml） 
$ws_hrb03_08->hrb03_08_234 = $hrb03_08_234; //一秒钟用力呼气量/最大肺活量百分比（%） 
$ws_hrb03_08->hrb03_08_235 = $hrb03_08_235; //腹部B超检查结果 
$ws_hrb03_08->hrb03_08_236 = $hrb03_08_236; //脑电图检查结果 
$ws_hrb03_08->hrb03_08_237 = $hrb03_08_237; //听觉诱发电位检查结果 
$ws_hrb03_08->hrb03_08_238 = $hrb03_08_238; //视觉诱发电位检查结果 
$ws_hrb03_08->hrb03_08_239 = $hrb03_08_239; //神经肌电图检查结果 
$ws_hrb03_08->hrb03_08_240 = $hrb03_08_240; //心电图检查结果 
$ws_hrb03_08->hrb03_08_241 = $hrb03_08_241; //心功能检查结果 
$ws_hrb03_08->hrb03_08_242 = $hrb03_08_242; //胸部X线检查结果 
$ws_hrb03_08->hrb03_08_243 = $hrb03_08_243; //受照剂量（Gy） 
$ws_hrb03_08->hrb03_08_244 = $hrb03_08_244; //职业健康检查结论代码 
$ws_hrb03_08->hrb03_08_245 = $hrb03_08_245; //职业病名称代码 
$ws_hrb03_08->hrb03_08_246 = $hrb03_08_246; //检查（测）人员姓名 
$ws_hrb03_08->hrb03_08_247 = $hrb03_08_247; //检查（测）机构名称 
$ws_hrb03_08->hrb03_08_248 = $hrb03_08_248; //诊断机构名称 
$ws_hrb03_08 ->hrb03_08_249 = empty($hrb03_08_249)?null : $ws_hrb03_08 ->escape('hrb03_08_249',to_date($hrb03_08_249,'YYYY-MM-DD')); //检查（测）日期 
$ws_hrb03_08 ->hrb03_08_250 = empty($hrb03_08_250)?null : $ws_hrb03_08 ->escape('hrb03_08_250',to_date($hrb03_08_250,'YYYY-MM-DD')); //诊断日期 
$ws_hrb03_08->hrb03_08_001 = $hrb03_08_001; //记录表单编号 
$ws_hrb03_08->hrb03_08_002 = $hrb03_08_002; //姓名 
$ws_hrb03_08->hrb03_08_003 = $hrb03_08_003; //性别代码 
$ws_hrb03_08 ->hrb03_08_004 = empty($hrb03_08_004)?null : $ws_hrb03_08 ->escape('hrb03_08_004',to_date($hrb03_08_004,'YYYY-MM-DD')); //出生日期 
$ws_hrb03_08->hrb03_08_005 = $hrb03_08_005; //身份证件-类别代码 
$ws_hrb03_08->hrb03_08_006 = $hrb03_08_006; //身份证件-号码 
$ws_hrb03_08->hrb03_08_007 = $hrb03_08_007; //文化程度代码 
$ws_hrb03_08->hrb03_08_008 = $hrb03_08_008; //民族代码 
$ws_hrb03_08->hrb03_08_009 = $hrb03_08_009; //婚姻状况类别代码 
$ws_hrb03_08 ->hrb03_08_010 = empty($hrb03_08_010)?null : $ws_hrb03_08 ->escape('hrb03_08_010',to_date($hrb03_08_010,'YYYY-MM-DD')); //结婚日期 
$ws_hrb03_08->hrb03_08_011 = $hrb03_08_011; //联系电话-类别 
$ws_hrb03_08->hrb03_08_012 = $hrb03_08_012; //联系电话-类别代码 
$ws_hrb03_08->hrb03_08_013 = $hrb03_08_013; //联系电话-号码 
$ws_hrb03_08->hrb03_08_014 = $hrb03_08_014; //工作单位名称 
$ws_hrb03_08->hrb03_08_015 = $hrb03_08_015; //配偶职业类别代码(国标) 
$ws_hrb03_08->hrb03_08_016 = $hrb03_08_016; //地址类别代码 
$ws_hrb03_08->hrb03_08_017 = $hrb03_08_017; //行政区划代码 
$ws_hrb03_08->hrb03_08_018 = $hrb03_08_018; //地址-省（自治区、直辖市） 
$ws_hrb03_08->hrb03_08_019 = $hrb03_08_019; //地址-市（地区） 
$ws_hrb03_08->hrb03_08_020 = $hrb03_08_020; //地址-县（区） 
$ws_hrb03_08->hrb03_08_021 = $hrb03_08_021; //地址-乡（镇、街道办事处） 
$ws_hrb03_08->hrb03_08_022 = $hrb03_08_022; //地址-村（街、路、弄等） 
$ws_hrb03_08->hrb03_08_023 = $hrb03_08_023; //地址-门牌号码 
$ws_hrb03_08->hrb03_08_024 = $hrb03_08_024; //邮政编码 
$ws_hrb03_08->hrb03_08_025 = $hrb03_08_025; //体检类别代码 
$ws_hrb03_08->hrb03_08_026 = $hrb03_08_026; //初潮年龄（岁） 
$ws_hrb03_08->hrb03_08_027 = $hrb03_08_027; //绝经年龄（岁） 
$ws_hrb03_08->hrb03_08_028 = $hrb03_08_028; //月经周期（d） 
$ws_hrb03_08->hrb03_08_029 = $hrb03_08_029; //月经持续时间（d） 
$ws_hrb03_08->hrb03_08_030 = $hrb03_08_030; //月经异常标志 
$ws_hrb03_08->hrb03_08_031 = $hrb03_08_031; //早产次数 
$ws_hrb03_08->hrb03_08_032 = $hrb03_08_032; //异常胎次数 
$ws_hrb03_08->hrb03_08_033 = $hrb03_08_033; //流产总次数 
$ws_hrb03_08->hrb03_08_034 = $hrb03_08_034; //现有子女数 
$ws_hrb03_08->hrb03_08_035 = $hrb03_08_035; //过量照射史 
$ws_hrb03_08->hrb03_08_036 = $hrb03_08_036; //既往疾病史 
$ws_hrb03_08->hrb03_08_037 = $hrb03_08_037; //家族遗传性疾病史 
$ws_hrb03_08->hrb03_08_038 = $hrb03_08_038; //非放射工作职业史 
$ws_hrb03_08->hrb03_08_039 = $hrb03_08_039; //吸烟标志 
$ws_hrb03_08->hrb03_08_040 = $hrb03_08_040; //日吸烟量(支) 
$ws_hrb03_08->hrb03_08_041 = $hrb03_08_041; //吸烟时长（年） 
$ws_hrb03_08->hrb03_08_042 = $hrb03_08_042; //饮酒标志 
$ws_hrb03_08->hrb03_08_043 = $hrb03_08_043; //日饮酒量(两) 
$ws_hrb03_08->hrb03_08_044 = $hrb03_08_044; //饮酒时长（年） 
$ws_hrb03_08 ->hrb03_08_045 = empty($hrb03_08_045)?null : $ws_hrb03_08 ->escape('hrb03_08_045',to_date($hrb03_08_045,'YYYY-MM-DD')); //从事毒害职业开始日期 
$ws_hrb03_08 ->hrb03_08_046 = empty($hrb03_08_046)?null : $ws_hrb03_08 ->escape('hrb03_08_046',to_date($hrb03_08_046,'YYYY-MM-DD')); //从事毒害职业终止日期 
$ws_hrb03_08->hrb03_08_047 = $hrb03_08_047; //每日工作时长（h） 
$ws_hrb03_08->hrb03_08_048 = $hrb03_08_048; //射线装置种类代码 
$ws_hrb03_08->hrb03_08_049 = $hrb03_08_049; //配偶健康状况 
$ws_hrb03_08->hrb03_08_050 = $hrb03_08_050; //鼻堵标志 
$ws_hrb03_08->hrb03_08_051 = $hrb03_08_051; //便秘标志 
$ws_hrb03_08->hrb03_08_052 = $hrb03_08_052; //盗汗标志 
$ws_hrb03_08->hrb03_08_053 = $hrb03_08_053; //动作不灵活标志 
$ws_hrb03_08->hrb03_08_054 = $hrb03_08_054; //多汗-标志 
$ws_hrb03_08->hrb03_08_055 = $hrb03_08_055; //多汗-部位 
$ws_hrb03_08->hrb03_08_056 = $hrb03_08_056; //多梦标志 
$ws_hrb03_08->hrb03_08_057 = $hrb03_08_057; //恶心标志 
$ws_hrb03_08->hrb03_08_058 = $hrb03_08_058; //耳鸣标志 
$ws_hrb03_08->hrb03_08_059 = $hrb03_08_059; //腹痛标志 
$ws_hrb03_08->hrb03_08_060 = $hrb03_08_060; //腹泻标志 
$ws_hrb03_08->hrb03_08_061 = $hrb03_08_061; //腹胀标志 
$ws_hrb03_08->hrb03_08_062 = $hrb03_08_062; //咯血标志 
$ws_hrb03_08->hrb03_08_063 = $hrb03_08_063; //关节痛标志 
$ws_hrb03_08->hrb03_08_064 = $hrb03_08_064; //记忆力减退标志 
$ws_hrb03_08->hrb03_08_065 = $hrb03_08_065; //咳嗽标志 
$ws_hrb03_08->hrb03_08_066 = $hrb03_08_066; //咳痰标志 
$ws_hrb03_08->hrb03_08_067 = $hrb03_08_067; //口渴标志 
$ws_hrb03_08->hrb03_08_068 = $hrb03_08_068; //流泪标志 
$ws_hrb03_08->hrb03_08_069 = $hrb03_08_069; //流涕标志 
$ws_hrb03_08->hrb03_08_070 = $hrb03_08_070; //流涎标志 
$ws_hrb03_08->hrb03_08_071 = $hrb03_08_071; //尿急标志 
$ws_hrb03_08->hrb03_08_072 = $hrb03_08_072; //尿频标志 
$ws_hrb03_08->hrb03_08_073 = $hrb03_08_073; //尿血标志 
$ws_hrb03_08->hrb03_08_074 = $hrb03_08_074; //呕吐标志 
$ws_hrb03_08->hrb03_08_075 = $hrb03_08_075; //配偶接触放射线情况 
$ws_hrb03_08->hrb03_08_076 = $hrb03_08_076; //疲乏无力标志 
$ws_hrb03_08->hrb03_08_077 = $hrb03_08_077; //皮肤瘙痒标志 
$ws_hrb03_08->hrb03_08_078 = $hrb03_08_078; //全身酸痛标志 
$ws_hrb03_08->hrb03_08_079 = $hrb03_08_079; //失眠标志 
$ws_hrb03_08->hrb03_08_080 = $hrb03_08_080; //食欲减退标志 
$ws_hrb03_08->hrb03_08_081 = $hrb03_08_081; //视力下降标志 
$ws_hrb03_08->hrb03_08_082 = $hrb03_08_082; //视物模糊标志 
$ws_hrb03_08->hrb03_08_083 = $hrb03_08_083; //嗜睡标志 
$ws_hrb03_08->hrb03_08_084 = $hrb03_08_084; //刷牙出血标志 
$ws_hrb03_08->hrb03_08_085 = $hrb03_08_085; //死产例数 
$ws_hrb03_08->hrb03_08_086 = $hrb03_08_086; //四肢麻木标志 
$ws_hrb03_08->hrb03_08_087 = $hrb03_08_087; //头昏标志 
$ws_hrb03_08->hrb03_08_088 = $hrb03_08_088; //头痛标志 
$ws_hrb03_08->hrb03_08_089 = $hrb03_08_089; //哮喘标志 
$ws_hrb03_08->hrb03_08_090 = $hrb03_08_090; //心悸标志 
$ws_hrb03_08->hrb03_08_091 = $hrb03_08_091; //心前区不适标志 
$ws_hrb03_08->hrb03_08_092 = $hrb03_08_092; //性欲减退标志 
$ws_hrb03_08->hrb03_08_093 = $hrb03_08_093; //胸闷标志 
$ws_hrb03_08->hrb03_08_094 = $hrb03_08_094; //胸痛标志 
$ws_hrb03_08->hrb03_08_095 = $hrb03_08_095; //羞明标志 
$ws_hrb03_08->hrb03_08_096 = $hrb03_08_096; //嗅觉减退标志 
$ws_hrb03_08->hrb03_08_097 = $hrb03_08_097; //眩晕标志 
$ws_hrb03_08->hrb03_08_098 = $hrb03_08_098; //牙齿松动标志 
$ws_hrb03_08->hrb03_08_099 = $hrb03_08_099; //牙痛标志 
$ws_hrb03_08->hrb03_08_100 = $hrb03_08_100; //咽痛标志 
$ws_hrb03_08->hrb03_08_101 = $hrb03_08_101; //眼痛标志 
$ws_hrb03_08->hrb03_08_102 = $hrb03_08_102; //易激动标志 
$ws_hrb03_08->hrb03_08_103 = $hrb03_08_103; //职业照射种类代码 
$ws_hrb03_08->hrb03_08_104 = $hrb03_08_104; //一般状况检查结果 
$ws_hrb03_08->hrb03_08_105 = $hrb03_08_105; //身高(cm) 
$ws_hrb03_08->hrb03_08_106 = $hrb03_08_106; //体重（kg） 
$ws_hrb03_08->hrb03_08_107 = $hrb03_08_107; //呼吸频率（次/分钟） 
$ws_hrb03_08->hrb03_08_108 = $hrb03_08_108; //脉率（次/分钟） 
$ws_hrb03_08->hrb03_08_109 = $hrb03_08_109; //收缩压(mmHg) 
$ws_hrb03_08->hrb03_08_110 = $hrb03_08_110; //舒张压(mmHg) 
$ws_hrb03_08->hrb03_08_111 = $hrb03_08_111; //四肢检查结果 
$ws_hrb03_08->hrb03_08_112 = $hrb03_08_112; //发育程度代码 
$ws_hrb03_08->hrb03_08_113 = $hrb03_08_113; //营养状态代码 
$ws_hrb03_08->hrb03_08_114 = $hrb03_08_114; //感觉异常 
$ws_hrb03_08->hrb03_08_115 = $hrb03_08_115; //心律 
$ws_hrb03_08->hrb03_08_116 = $hrb03_08_116; //心率（次/分钟） 
$ws_hrb03_08->hrb03_08_117 = $hrb03_08_117; //心脏听诊结果 
$ws_hrb03_08->hrb03_08_118 = $hrb03_08_118; //病理反射检查结果 
$ws_hrb03_08->hrb03_08_119 = $hrb03_08_119; //玻璃体检查结果 
$ws_hrb03_08->hrb03_08_120 = $hrb03_08_120; //鼻部检查结果 
$ws_hrb03_08->hrb03_08_121 = $hrb03_08_121; //鼻干标志 
$ws_hrb03_08->hrb03_08_122 = $hrb03_08_122; //鼻血标志 
$ws_hrb03_08->hrb03_08_123 = $hrb03_08_123; //低热标志 
$ws_hrb03_08->hrb03_08_124 = $hrb03_08_124; //耳聋标志 
$ws_hrb03_08->hrb03_08_125 = $hrb03_08_125; //气短标志 
$ws_hrb03_08->hrb03_08_126 = $hrb03_08_126; //浮肿标志 
$ws_hrb03_08->hrb03_08_127 = $hrb03_08_127; //肝区痛标志 
$ws_hrb03_08->hrb03_08_128 = $hrb03_08_128; //口腔溃疡标志 
$ws_hrb03_08->hrb03_08_129 = $hrb03_08_129; //消瘦标志 
$ws_hrb03_08->hrb03_08_130 = $hrb03_08_130; //脱发标志 
$ws_hrb03_08->hrb03_08_131 = $hrb03_08_131; //肾区叩痛标志 
$ws_hrb03_08->hrb03_08_132 = $hrb03_08_132; //皮疹标志 
$ws_hrb03_08->hrb03_08_133 = $hrb03_08_133; //口腔异味标志 
$ws_hrb03_08->hrb03_08_134 = $hrb03_08_134; //皮下出血标志 
$ws_hrb03_08->hrb03_08_135 = $hrb03_08_135; //肝脏触诊结果 
$ws_hrb03_08->hrb03_08_136 = $hrb03_08_136; //肺部听诊结果 
$ws_hrb03_08->hrb03_08_137 = $hrb03_08_137; //跟腱反射检查结果 
$ws_hrb03_08->hrb03_08_138 = $hrb03_08_138; //共济运动检查结果 
$ws_hrb03_08->hrb03_08_139 = $hrb03_08_139; //干燥部位 
$ws_hrb03_08->hrb03_08_140 = $hrb03_08_140; //过度角化部位 
$ws_hrb03_08->hrb03_08_141 = $hrb03_08_141; //肌力检查结果 
$ws_hrb03_08->hrb03_08_142 = $hrb03_08_142; //肌张力检查结果 
$ws_hrb03_08->hrb03_08_143 = $hrb03_08_143; //脊柱检查结果 
$ws_hrb03_08->hrb03_08_144 = $hrb03_08_144; //甲状腺检查结果 
$ws_hrb03_08->hrb03_08_145 = $hrb03_08_145; //晶体裂隙灯检查结果 
$ws_hrb03_08->hrb03_08_146 = $hrb03_08_146; //皮肤和粘膜检查结果 
$ws_hrb03_08->hrb03_08_147 = $hrb03_08_147; //脾脏触诊结果 
$ws_hrb03_08->hrb03_08_148 = $hrb03_08_148; //皮肤划纹症检查结果 
$ws_hrb03_08->hrb03_08_149 = $hrb03_08_149; //浅表淋巴结检查结果 
$ws_hrb03_08->hrb03_08_150 = $hrb03_08_150; //三颤检查结果 
$ws_hrb03_08->hrb03_08_151 = $hrb03_08_151; //色觉检查结果 
$ws_hrb03_08->hrb03_08_152 = $hrb03_08_152; //口腔检查结果 
$ws_hrb03_08->hrb03_08_153 = $hrb03_08_153; //指甲检查结果 
$ws_hrb03_08->hrb03_08_154 = $hrb03_08_154; //膝反射检查结果 
$ws_hrb03_08->hrb03_08_155 = $hrb03_08_155; //嗅觉检查结果 
$ws_hrb03_08->hrb03_08_156 = $hrb03_08_156; //咽部检查结果 
$ws_hrb03_08->hrb03_08_157 = $hrb03_08_157; //肾脏检查结果 
$ws_hrb03_08->hrb03_08_158 = $hrb03_08_158; //皮疹部位 
$ws_hrb03_08->hrb03_08_159 = $hrb03_08_159; //皮肤萎缩部位 
$ws_hrb03_08->hrb03_08_160 = $hrb03_08_160; //皲裂部位 
$ws_hrb03_08->hrb03_08_161 = $hrb03_08_161; //疣状物部位 
$ws_hrb03_08->hrb03_08_162 = $hrb03_08_162; //色素沉着部位 
$ws_hrb03_08->hrb03_08_163 = $hrb03_08_163; //色素减退部位 
$ws_hrb03_08->hrb03_08_164 = $hrb03_08_164; //溃疡部位 
$ws_hrb03_08->hrb03_08_165 = $hrb03_08_165; //紫癜部位 
$ws_hrb03_08->hrb03_08_166 = $hrb03_08_166; //脱发部位 
$ws_hrb03_08->hrb03_08_167 = $hrb03_08_167; //脱毛部位 
$ws_hrb03_08->hrb03_08_168 = $hrb03_08_168; //脱屑部位 
$ws_hrb03_08->hrb03_08_169 = $hrb03_08_169; //左侧听力检测结果 
$ws_hrb03_08->hrb03_08_170 = $hrb03_08_170; //右侧听力检测结果 
$ws_hrb03_08->hrb03_08_171 = $hrb03_08_171; //视野检查结果 
$ws_hrb03_08->hrb03_08_172 = $hrb03_08_172; //眼底检查结果 
$ws_hrb03_08->hrb03_08_173 = $hrb03_08_173; //右眼矫正近视力值 
$ws_hrb03_08->hrb03_08_174 = $hrb03_08_174; //右眼矫正远视力值 
$ws_hrb03_08->hrb03_08_175 = $hrb03_08_175; //右眼裸眼近视力值 
$ws_hrb03_08->hrb03_08_176 = $hrb03_08_176; //右眼裸眼远视力值 
$ws_hrb03_08->hrb03_08_177 = $hrb03_08_177; //左眼矫正近视力值 
$ws_hrb03_08->hrb03_08_178 = $hrb03_08_178; //左眼矫正远视力值 
$ws_hrb03_08->hrb03_08_179 = $hrb03_08_179; //左眼裸眼近视力值 
$ws_hrb03_08->hrb03_08_180 = $hrb03_08_180; //左眼裸眼远视力值 
$ws_hrb03_08->hrb03_08_181 = $hrb03_08_181; //白细胞计数值(G/L) 
$ws_hrb03_08->hrb03_08_182 = $hrb03_08_182; //红细胞计数值（G/L） 
$ws_hrb03_08->hrb03_08_183 = $hrb03_08_183; //淋巴细胞百分率（％） 
$ws_hrb03_08->hrb03_08_184 = $hrb03_08_184; //嗜碱性粒细胞百分率（％） 
$ws_hrb03_08->hrb03_08_185 = $hrb03_08_185; //嗜酸性粒细胞百分率（％） 
$ws_hrb03_08->hrb03_08_186 = $hrb03_08_186; //中性分叶核粒细胞百分率（％） 
$ws_hrb03_08->hrb03_08_187 = $hrb03_08_187; //中性杆状核粒细胞百分率（％） 
$ws_hrb03_08->hrb03_08_188 = $hrb03_08_188; //血胆碱酯酶活性（％） 
$ws_hrb03_08->hrb03_08_189 = $hrb03_08_189; //血红蛋白值（g/L） 
$ws_hrb03_08->hrb03_08_190 = $hrb03_08_190; //血尿素氮检测值(mmol/L) 
$ws_hrb03_08->hrb03_08_191 = $hrb03_08_191; //血铅检测值（nmol/L） 
$ws_hrb03_08->hrb03_08_192 = $hrb03_08_192; //血清肌酐检测值（μmol/L） 
$ws_hrb03_08->hrb03_08_193 = $hrb03_08_193; //血清总胆红素检测值（μmol/L） 
$ws_hrb03_08->hrb03_08_194 = $hrb03_08_194; //血糖检测值（mmol/L） 
$ws_hrb03_08->hrb03_08_195 = $hrb03_08_195; //血小板计数值(G/L) 
$ws_hrb03_08->hrb03_08_196 = $hrb03_08_196; //血锌原卟啉检测值（μmol/L） 
$ws_hrb03_08->hrb03_08_197 = $hrb03_08_197; //丙氨酸氨基转移酶检测值(U/L) 
$ws_hrb03_08->hrb03_08_198 = $hrb03_08_198; //促甲状腺激素检测值(mU/L) 
$ws_hrb03_08->hrb03_08_199 = $hrb03_08_199; //单核细胞检测值（G/L） 
$ws_hrb03_08->hrb03_08_200 = $hrb03_08_200; //睾丸酮检测值（nmol/L） 
$ws_hrb03_08->hrb03_08_201 = $hrb03_08_201; //甲状腺素检测值（nmol/L） 
$ws_hrb03_08->hrb03_08_202 = $hrb03_08_202; //尿白细胞计数值（个/H） 
$ws_hrb03_08->hrb03_08_203 = $hrb03_08_203; //游离三碘甲状腺原氨酸检测结果（pmol/L） 
$ws_hrb03_08->hrb03_08_204 = $hrb03_08_204; //尿常规镜检结果 
$ws_hrb03_08->hrb03_08_205 = $hrb03_08_205; //尿蛋白定量检测值（mg/24h） 
$ws_hrb03_08->hrb03_08_206 = $hrb03_08_206; //尿液外观 
$ws_hrb03_08->hrb03_08_207 = $hrb03_08_207; //尿管型检查结果 
$ws_hrb03_08->hrb03_08_208 = $hrb03_08_208; //尿糖定量检测(mmol/L) 
$ws_hrb03_08->hrb03_08_209 = $hrb03_08_209; //尿氟检测值（mg/L） 
$ws_hrb03_08->hrb03_08_210 = $hrb03_08_210; //尿镉检测值（μg/L） 
$ws_hrb03_08->hrb03_08_211 = $hrb03_08_211; //尿红细胞计数值（个/H） 
$ws_hrb03_08->hrb03_08_212 = $hrb03_08_212; //尿锰检测值（mg/L） 
$ws_hrb03_08->hrb03_08_213 = $hrb03_08_213; //尿铅检测值（μmol/L） 
$ws_hrb03_08->hrb03_08_214 = $hrb03_08_214; //尿砷检测值（mg/L） 
$ws_hrb03_08->hrb03_08_215 = $hrb03_08_215; //尿β２-微球蛋白值（mg/L） 
$ws_hrb03_08->hrb03_08_216 = $hrb03_08_216; //尿δ-氨基乙酰丙酸值（mg/L） 
$ws_hrb03_08->hrb03_08_217 = $hrb03_08_217; //痰细胞学检查结果 
if($ws_hrb03_08 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrb03_08 ->free_statement();
}
