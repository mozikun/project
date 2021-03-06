<?php
/**
电子病历基础模板：住院志数据集EMR09.00电子病历基础模板：住院志数据集
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $emr09_00_01_087  症状观察结果
* @param string $emr09_00_01_091  观察-类别
* @param string $emr09_00_01_092  观察-类别代码
* @param string $emr09_00_01_093  观察项目名称
* @param string $emr09_00_01_094  观察-项目代码
* @param string $emr09_00_01_095  观察-结果描述
* @param decimal $emr09_00_01_096  观察-结果(数值)
* @param string $emr09_00_01_097  观察-计量单位
* @param string $emr09_00_01_098  观察-结果代码
* @param string $emr09_00_01_099  体格检查项目类目名称
* @param string $emr09_00_01_100  体格检查观察结果
* @param string $emr09_00_01_111  一般状态检查描述
* @param string $emr09_00_01_112  一般状态检查体征代码
* @param string $emr09_00_01_113  一般状态检查项目名称
* @param string $emr09_00_01_114  一般状态检查项目类目名称
* @param string $emr09_00_01_121  一般状态检查结果
* @param string $emr09_00_01_122  皮肤检查描述
* @param string $emr09_00_01_123  皮肤检查体征代码
* @param string $emr09_00_01_124  皮肤检查项目名称
* @param string $emr09_00_01_125  皮肤检查项目类目名称
* @param string $emr09_00_01_126  皮肤检查结果
* @param string $emr09_00_01_131  浅表淋巴结检查结果
* @param string $emr09_00_01_132  淋巴管／结炎发作特点代码
* @param boolean $emr09_00_01_133  淋巴管／结炎发作伴随高热寒战标志
* @param string $emr09_00_01_134  淋巴结检查结果-类别代码
* @param string $emr09_00_01_135  淋巴结检查结果-描述
* @param string $emr09_00_01_136  淋巴结检查体征代码
* @param string $emr09_00_01_137  淋巴结检查项目名称
* @param string $emr09_00_01_141  头部检查描述
* @param string $emr09_00_01_142  头部检查体征代码
* @param string $emr09_00_01_143  头部检查项目名称
* @param string $emr09_00_01_144  头部检查项目类目名称
* @param string $emr09_00_01_145  头部检查结果
* @param string $emr09_00_01_151  甲状腺检查结果
* @param string $emr09_00_01_152  喉结检查结果
* @param boolean $emr09_00_01_153  颈静脉怒张标志
* @param string $emr09_00_01_154  颈部检查描述
* @param string $emr09_00_01_155  颈部检查体征代码
* @param string $emr09_00_01_156  颈部检查项目名称
* @param string $emr09_00_01_161  胸部检查描述
* @param string $emr09_00_01_162  胸部检查体征代码
* @param string $emr09_00_01_163  胸部检查项目名称
* @param string $emr09_00_01_164  胸部检查项目类目名称
* @param string $emr09_00_01_165  胸部检查结果
* @param string $emr09_00_01_171  腹部检查描述
* @param string $emr09_00_01_172  腹部检查体征代码
* @param string $emr09_00_01_173  腹部检查项目名称
* @param string $emr09_00_01_174  腹部检查项目类目名称
* @param string $emr09_00_01_175  腹部检查结果
* @param string $emr09_00_01_181  生殖器、肛门、直肠检查描述
* @param string $emr09_00_01_271  个人史危险因素代码
* @param string $emr09_00_01_272  个人史观察项目类目名称
* @param string $emr09_00_01_273  个人史观察结果
* @param string $emr09_00_01_281  婚姻史观察项目类目名称
* @param string $emr09_00_01_282  婚姻史观察结果
* @param string $emr09_00_01_291  月经史观察项目类目名称
* @param string $emr09_00_01_292  月经史观察结果
* @param string $emr09_00_01_301  生育史观察项目类目名称
* @param string $emr09_00_01_302  生育史观察结果
* @param string $emr09_00_01_311  家族史观察项目类目名称
* @param string $emr09_00_01_312  家族史观察结果
* @param string $emr09_00_01_321  暴露史观察项目类目名称
* @param string $emr09_00_01_322  暴露史观察结果
* @param string $emr09_00_01_331  观察-类别
* @param string $emr09_00_01_332  观察-类别代码
* @param string $emr09_00_01_333  观察项目名称
* @param string $emr09_00_01_334  观察-项目代码
* @param string $emr09_00_01_335  观察-结果描述
* @param decimal $emr09_00_01_336  观察-结果(数值)
* @param string $emr09_00_01_337  观察-计量单位
* @param string $emr09_00_01_338  观察-结果代码
* @param string $emr09_00_01_339  检查部位
* @param string $emr09_00_01_340  检查部位代码
* @param string $emr09_00_01_351  观察-类别
* @param string $emr09_00_01_352  观察-类别代码
* @param string $emr09_00_01_353  观察项目名称
* @param string $emr09_00_01_354  观察-项目代码
* @param string $emr09_00_01_355  观察-结果描述
* @param decimal $emr09_00_01_356  观察-结果(数值)
* @param string $emr09_00_01_357  观察-计量单位
* @param string $emr09_00_01_358  观察-结果代码
* @param string $emr09_00_01_361  诊断机构名称
* @param date $emr09_00_01_362  诊断日期 
* @param string $emr09_00_01_363  诊断类别 
* @param string $emr09_00_01_364  诊断类别代码 
* @param string $emr09_00_01_365  诊断顺位（从属关系）代码 
* @param string $emr09_00_01_366  疾病名称 
* @param string $emr09_00_01_367  疾病代码 
* @param string $emr09_00_01_368  诊断依据 
* @param string $emr09_00_01_369  诊断依据代码 
* @param date $emr09_00_01_371  疫苗接种日期 
* @param string $emr09_00_01_372  免疫类型代码 
* @param string $emr09_00_01_373  免疫接种方法代码 
* @param string $emr09_00_01_374  免疫接种状态代码 
* @param string $emr09_00_01_375  疫苗-名称代码 
* @param string $emr09_00_01_376  疫苗-批号
* @param string $emr09_00_01_377  疫苗-名称
* @param string $emr09_00_01_182  生殖器、肛门、直肠检查体征代码
* @param string $emr09_00_01_183  生殖器、肛门、直肠检查项目名称
* @param string $emr09_00_01_184  生殖器、肛门、直肠检查项目类目名称
* @param string $emr09_00_01_185  生殖器、肛门、直肠检查结果
* @param string $emr09_00_01_191  四肢检查结果
* @param string $emr09_00_01_192  脊柱检查结果
* @param string $emr09_00_01_193  脊柱与四肢检查描述
* @param string $emr09_00_01_194  脊柱与四肢检查体征代码
* @param string $emr09_00_01_195  脊柱与四肢检查项目名称
* @param string $emr09_00_01_201  功能检查描述
* @param string $emr09_00_01_202  功能检查体征代码
* @param string $emr09_00_01_203  功能检查项目名称
* @param string $emr09_00_01_204  残疾情况代码
* @param string $emr09_00_01_205  功能检查项目类目名称
* @param string $emr09_00_01_206  功能检查结果
* @param dateTime $emr09_00_01_211  起病时间
* @param string $emr09_00_01_212  起病情况描述
* @param string $emr09_00_01_213  症状开始原因/诱因
* @param string $emr09_00_01_214  症状特点
* @param string $emr09_00_01_215  伴随症状
* @param string $emr09_00_01_216  本疾病既往诊疗经过
* @param string $emr09_00_01_217  起病后一般情况
* @param string $emr09_00_01_218  基础疾病诊疗情况
* @param string $emr09_00_01_221  感染途径
* @param string $emr09_00_01_222  感染途径代码
* @param string $emr09_00_01_223  家族史观察项目类目名称
* @param string $emr09_00_01_224  家族史观察结果
* @param string $emr09_00_01_231  既往疾病史
* @param string $emr09_00_01_232  既往精神类疾病诊断名称
* @param string $emr09_00_01_233  既往疾病名称
* @param string $emr09_00_01_234  既往疾病代码
* @param string $emr09_00_01_235  既往疾病诊断机构
* @param string $emr09_00_01_236  既往疾病诊断机构级别代码
* @param date $emr09_00_01_237  既往疾病诊断时间
* @param string $emr09_00_01_238  疾病当前状态代码
* @param string $emr09_00_01_241  手术史标识
* @param string $emr09_00_01_242  手术方式代码
* @param string $emr09_00_01_243  手术体位代码
* @param string $emr09_00_01_244  手术过程描述
* @param string $emr09_00_01_251  输血史标识代码
* @param string $emr09_00_01_252  输血史观察项目数据组
* @param string $emr09_00_01_253  输血史观察结果
* @param string $emr09_00_01_261  过敏史
* @param string $emr09_00_01_262  过敏原
* @param string $emr09_00_01_263  过敏症状
* @param string $emr09_00_01_264  过敏症状代码
* @param string $emr09_00_01_265  过敏原代码
* @param string $emr09_00_01_266  过敏药物名称
* @param string $emr09_00_01_267  过敏病情状态代码
* @param string $emr09_00_01_268  过敏严重性代码
* @param string $emr09_00_01_269  过敏史标识代码
* @param string $emr09_00_01_001  文档标识-名称 
* @param string $emr09_00_01_002  文档标识-类别代码
* @param string $emr09_00_01_003  文档标识-管理机构名称
* @param string $emr09_00_01_004  文档标识-管理机构组织机构代码（法人代码）
* @param string $emr09_00_01_005  文档标识-号码 
* @param date $emr09_00_01_006  文档标识-生效日期 
* @param date $emr09_00_01_007  文档标识-失效日期 
* @param string $emr09_00_01_011  标识号-类别代码 
* @param string $emr09_00_01_012  标识号-号码 *
* @param date $emr09_00_01_013  标识号-生效日期 
* @param date $emr09_00_01_014  标识号-失效日期 
* @param string $emr09_00_01_015  标识号-提供标识的机构名称 
* @param string $emr09_00_01_016  姓名-标识对象
* @param string $emr09_00_01_017  姓名-标识对象代码
* @param string $emr09_00_01_018  姓名 *
* @param string $emr09_00_01_021  性别代码 
* @param decimal $emr09_00_01_022  年龄（岁）*
* @param string $emr09_00_01_023  国籍代码 
* @param string $emr09_00_01_024  民族代码 
* @param string $emr09_00_01_025  婚姻状况类别代码
* @param string $emr09_00_01_026  职业编码系统名称 
* @param string $emr09_00_01_027  职业代码
* @param string $emr09_00_01_028  文化程度代码 
* @param date $emr09_00_01_029  出生日期* 
* @param string $emr09_00_01_030  出生地*
* @param string $emr09_00_01_041  标识号-类别代码 
* @param string $emr09_00_01_042  标识号-号码*
* @param date $emr09_00_01_043  标识号-生效日期 
* @param date $emr09_00_01_044  标识号-失效日期 
* @param string $emr09_00_01_045  标识号-提供标识的机构名称 
* @param string $emr09_00_01_046  姓名-标识对象
* @param string $emr09_00_01_047  姓名-标识对象代码
* @param string $emr09_00_01_048  姓名*
* @param string $emr09_00_01_051  机构名称
* @param string $emr09_00_01_052  机构组织机构代码
* @param string $emr09_00_01_053  机构负责人（法人）
* @param string $emr09_00_01_054  机构地址
* @param string $emr09_00_01_055  科室名称
* @param string $emr09_00_01_056  机构角色
* @param string $emr09_00_01_057  机构角色代码
* @param string $emr09_00_01_061  服务者姓名*
* @param string $emr09_00_01_062  服务者职责（角色）
* @param string $emr09_00_01_063  服务者职责（角色）代码
* @param string $emr09_00_01_064  服务者医师资格标志*
* @param string $emr09_00_01_065  服务者学历*
* @param string $emr09_00_01_066  服务者所学专业*
* @param string $emr09_00_01_067  服务者专业技术职称*
* @param string $emr09_00_01_068  服务者职务*
* @param string $emr09_00_01_071  卫生事件(动作)名称
* @param string $emr09_00_01_072  事件分类代码
* @param string $emr09_00_01_073  事件开始时间
* @param string $emr09_00_01_074  事件结束时间
* @param date $emr09_00_01_075  事件发生地点
* @param date $emr09_00_01_076  事件发生场所
* @param string $emr09_00_01_077  事件参与方
* @param string $emr09_00_01_078  事件发生原因
* @param string $emr09_00_01_079  事件结局
* @param string $emr09_00_01_081  主诉
* @param string $emr09_00_01_082  症状代码编码体系名称
* @param string $emr09_00_01_083  症状代码
* @param dateTime $emr09_00_01_084  症状开始日期时间
* @param dateTime $emr09_00_01_085  症状停止日期时间
* @param string $emr09_00_01_086  症状观察项目类目名称
* @return boolean
*/
function update_emr09_00($ws_id,$org_id,$doctor_id,$identity_number,$emr09_00_01_087='',$emr09_00_01_091='',$emr09_00_01_092='',$emr09_00_01_093='',$emr09_00_01_094='',$emr09_00_01_095='',$emr09_00_01_096=0,$emr09_00_01_097='',$emr09_00_01_098='',$emr09_00_01_099='',$emr09_00_01_100='',$emr09_00_01_111='',$emr09_00_01_112='',$emr09_00_01_113='',$emr09_00_01_114='',$emr09_00_01_121='',$emr09_00_01_122='',$emr09_00_01_123='',$emr09_00_01_124='',$emr09_00_01_125='',$emr09_00_01_126='',$emr09_00_01_131='',$emr09_00_01_132='',$emr09_00_01_133=false,$emr09_00_01_134='',$emr09_00_01_135='',$emr09_00_01_136='',$emr09_00_01_137='',$emr09_00_01_141='',$emr09_00_01_142='',$emr09_00_01_143='',$emr09_00_01_144='',$emr09_00_01_145='',$emr09_00_01_151='',$emr09_00_01_152='',$emr09_00_01_153=false,$emr09_00_01_154='',$emr09_00_01_155='',$emr09_00_01_156='',$emr09_00_01_161='',$emr09_00_01_162='',$emr09_00_01_163='',$emr09_00_01_164='',$emr09_00_01_165='',$emr09_00_01_171='',$emr09_00_01_172='',$emr09_00_01_173='',$emr09_00_01_174='',$emr09_00_01_175='',$emr09_00_01_181='',$emr09_00_01_271='',$emr09_00_01_272='',$emr09_00_01_273='',$emr09_00_01_281='',$emr09_00_01_282='',$emr09_00_01_291='',$emr09_00_01_292='',$emr09_00_01_301='',$emr09_00_01_302='',$emr09_00_01_311='',$emr09_00_01_312='',$emr09_00_01_321='',$emr09_00_01_322='',$emr09_00_01_331='',$emr09_00_01_332='',$emr09_00_01_333='',$emr09_00_01_334='',$emr09_00_01_335='',$emr09_00_01_336=0,$emr09_00_01_337='',$emr09_00_01_338='',$emr09_00_01_339='',$emr09_00_01_340='',$emr09_00_01_351='',$emr09_00_01_352='',$emr09_00_01_353='',$emr09_00_01_354='',$emr09_00_01_355='',$emr09_00_01_356=0,$emr09_00_01_357='',$emr09_00_01_358='',$emr09_00_01_361='',$emr09_00_01_362='',$emr09_00_01_363='',$emr09_00_01_364='',$emr09_00_01_365='',$emr09_00_01_366='',$emr09_00_01_367='',$emr09_00_01_368='',$emr09_00_01_369='',$emr09_00_01_371='',$emr09_00_01_372='',$emr09_00_01_373='',$emr09_00_01_374='',$emr09_00_01_375='',$emr09_00_01_376='',$emr09_00_01_377='',$emr09_00_01_182='',$emr09_00_01_183='',$emr09_00_01_184='',$emr09_00_01_185='',$emr09_00_01_191='',$emr09_00_01_192='',$emr09_00_01_193='',$emr09_00_01_194='',$emr09_00_01_195='',$emr09_00_01_201='',$emr09_00_01_202='',$emr09_00_01_203='',$emr09_00_01_204='',$emr09_00_01_205='',$emr09_00_01_206='',$emr09_00_01_211='',$emr09_00_01_212='',$emr09_00_01_213='',$emr09_00_01_214='',$emr09_00_01_215='',$emr09_00_01_216='',$emr09_00_01_217='',$emr09_00_01_218='',$emr09_00_01_221='',$emr09_00_01_222='',$emr09_00_01_223='',$emr09_00_01_224='',$emr09_00_01_231='',$emr09_00_01_232='',$emr09_00_01_233='',$emr09_00_01_234='',$emr09_00_01_235='',$emr09_00_01_236='',$emr09_00_01_237='',$emr09_00_01_238='',$emr09_00_01_241='',$emr09_00_01_242='',$emr09_00_01_243='',$emr09_00_01_244='',$emr09_00_01_251='',$emr09_00_01_252='',$emr09_00_01_253='',$emr09_00_01_261='',$emr09_00_01_262='',$emr09_00_01_263='',$emr09_00_01_264='',$emr09_00_01_265='',$emr09_00_01_266='',$emr09_00_01_267='',$emr09_00_01_268='',$emr09_00_01_269='',$emr09_00_01_001='',$emr09_00_01_002='',$emr09_00_01_003='',$emr09_00_01_004='',$emr09_00_01_005='',$emr09_00_01_006='',$emr09_00_01_007='',$emr09_00_01_011='',$emr09_00_01_012='',$emr09_00_01_013='',$emr09_00_01_014='',$emr09_00_01_015='',$emr09_00_01_016='',$emr09_00_01_017='',$emr09_00_01_018='',$emr09_00_01_021='',$emr09_00_01_022=0,$emr09_00_01_023='',$emr09_00_01_024='',$emr09_00_01_025='',$emr09_00_01_026='',$emr09_00_01_027='',$emr09_00_01_028='',$emr09_00_01_029='',$emr09_00_01_030='',$emr09_00_01_041='',$emr09_00_01_042='',$emr09_00_01_043='',$emr09_00_01_044='',$emr09_00_01_045='',$emr09_00_01_046='',$emr09_00_01_047='',$emr09_00_01_048='',$emr09_00_01_051='',$emr09_00_01_052='',$emr09_00_01_053='',$emr09_00_01_054='',$emr09_00_01_055='',$emr09_00_01_056='',$emr09_00_01_057='',$emr09_00_01_061='',$emr09_00_01_062='',$emr09_00_01_063='',$emr09_00_01_064='',$emr09_00_01_065='',$emr09_00_01_066='',$emr09_00_01_067='',$emr09_00_01_068='',$emr09_00_01_071='',$emr09_00_01_072='',$emr09_00_01_073='',$emr09_00_01_074='',$emr09_00_01_075='',$emr09_00_01_076='',$emr09_00_01_077='',$emr09_00_01_078='',$emr09_00_01_079='',$emr09_00_01_081='',$emr09_00_01_082='',$emr09_00_01_083='',$emr09_00_01_084='',$emr09_00_01_085='',$emr09_00_01_086=''){
require_once(__SITEROOT.'library/Models/ws_emr09_00.php');
$table_obj="Tws_emr09_00";
$ws_emr09_00=new $table_obj();
$ws_emr09_00 -> ws_id=$ws_id;
$ws_emr09_00 -> uuid=uniqid('',true);
$ws_emr09_00 -> created=time();
$ws_emr09_00 -> org_id=$org_id;
$ws_emr09_00 -> doctor_id=$doctor_id;
$ws_emr09_00 -> identity_number=$identity_number;//身份证号
$ws_emr09_00 -> action='insert';
$ws_emr09_00->emr09_00_01_087 = $emr09_00_01_087; //症状观察结果 
$ws_emr09_00->emr09_00_01_091 = $emr09_00_01_091; //观察-类别 
$ws_emr09_00->emr09_00_01_092 = $emr09_00_01_092; //观察-类别代码 
$ws_emr09_00->emr09_00_01_093 = $emr09_00_01_093; //观察项目名称 
$ws_emr09_00->emr09_00_01_094 = $emr09_00_01_094; //观察-项目代码 
$ws_emr09_00->emr09_00_01_095 = $emr09_00_01_095; //观察-结果描述 
$ws_emr09_00->emr09_00_01_096 = $emr09_00_01_096; //观察-结果(数值) 
$ws_emr09_00->emr09_00_01_097 = $emr09_00_01_097; //观察-计量单位 
$ws_emr09_00->emr09_00_01_098 = $emr09_00_01_098; //观察-结果代码 
$ws_emr09_00->emr09_00_01_099 = $emr09_00_01_099; //体格检查项目类目名称 
$ws_emr09_00->emr09_00_01_100 = $emr09_00_01_100; //体格检查观察结果 
$ws_emr09_00->emr09_00_01_111 = $emr09_00_01_111; //一般状态检查描述 
$ws_emr09_00->emr09_00_01_112 = $emr09_00_01_112; //一般状态检查体征代码 
$ws_emr09_00->emr09_00_01_113 = $emr09_00_01_113; //一般状态检查项目名称 
$ws_emr09_00->emr09_00_01_114 = $emr09_00_01_114; //一般状态检查项目类目名称 
$ws_emr09_00->emr09_00_01_121 = $emr09_00_01_121; //一般状态检查结果 
$ws_emr09_00->emr09_00_01_122 = $emr09_00_01_122; //皮肤检查描述 
$ws_emr09_00->emr09_00_01_123 = $emr09_00_01_123; //皮肤检查体征代码 
$ws_emr09_00->emr09_00_01_124 = $emr09_00_01_124; //皮肤检查项目名称 
$ws_emr09_00->emr09_00_01_125 = $emr09_00_01_125; //皮肤检查项目类目名称 
$ws_emr09_00->emr09_00_01_126 = $emr09_00_01_126; //皮肤检查结果 
$ws_emr09_00->emr09_00_01_131 = $emr09_00_01_131; //浅表淋巴结检查结果 
$ws_emr09_00->emr09_00_01_132 = $emr09_00_01_132; //淋巴管／结炎发作特点代码 
$ws_emr09_00->emr09_00_01_133 = $emr09_00_01_133; //淋巴管／结炎发作伴随高热寒战标志 
$ws_emr09_00->emr09_00_01_134 = $emr09_00_01_134; //淋巴结检查结果-类别代码 
$ws_emr09_00->emr09_00_01_135 = $emr09_00_01_135; //淋巴结检查结果-描述 
$ws_emr09_00->emr09_00_01_136 = $emr09_00_01_136; //淋巴结检查体征代码 
$ws_emr09_00->emr09_00_01_137 = $emr09_00_01_137; //淋巴结检查项目名称 
$ws_emr09_00->emr09_00_01_141 = $emr09_00_01_141; //头部检查描述 
$ws_emr09_00->emr09_00_01_142 = $emr09_00_01_142; //头部检查体征代码 
$ws_emr09_00->emr09_00_01_143 = $emr09_00_01_143; //头部检查项目名称 
$ws_emr09_00->emr09_00_01_144 = $emr09_00_01_144; //头部检查项目类目名称 
$ws_emr09_00->emr09_00_01_145 = $emr09_00_01_145; //头部检查结果 
$ws_emr09_00->emr09_00_01_151 = $emr09_00_01_151; //甲状腺检查结果 
$ws_emr09_00->emr09_00_01_152 = $emr09_00_01_152; //喉结检查结果 
$ws_emr09_00->emr09_00_01_153 = $emr09_00_01_153; //颈静脉怒张标志 
$ws_emr09_00->emr09_00_01_154 = $emr09_00_01_154; //颈部检查描述 
$ws_emr09_00->emr09_00_01_155 = $emr09_00_01_155; //颈部检查体征代码 
$ws_emr09_00->emr09_00_01_156 = $emr09_00_01_156; //颈部检查项目名称 
$ws_emr09_00->emr09_00_01_161 = $emr09_00_01_161; //胸部检查描述 
$ws_emr09_00->emr09_00_01_162 = $emr09_00_01_162; //胸部检查体征代码 
$ws_emr09_00->emr09_00_01_163 = $emr09_00_01_163; //胸部检查项目名称 
$ws_emr09_00->emr09_00_01_164 = $emr09_00_01_164; //胸部检查项目类目名称 
$ws_emr09_00->emr09_00_01_165 = $emr09_00_01_165; //胸部检查结果 
$ws_emr09_00->emr09_00_01_171 = $emr09_00_01_171; //腹部检查描述 
$ws_emr09_00->emr09_00_01_172 = $emr09_00_01_172; //腹部检查体征代码 
$ws_emr09_00->emr09_00_01_173 = $emr09_00_01_173; //腹部检查项目名称 
$ws_emr09_00->emr09_00_01_174 = $emr09_00_01_174; //腹部检查项目类目名称 
$ws_emr09_00->emr09_00_01_175 = $emr09_00_01_175; //腹部检查结果 
$ws_emr09_00->emr09_00_01_181 = $emr09_00_01_181; //生殖器、肛门、直肠检查描述 
$ws_emr09_00->emr09_00_01_271 = $emr09_00_01_271; //个人史危险因素代码 
$ws_emr09_00->emr09_00_01_272 = $emr09_00_01_272; //个人史观察项目类目名称 
$ws_emr09_00->emr09_00_01_273 = $emr09_00_01_273; //个人史观察结果 
$ws_emr09_00->emr09_00_01_281 = $emr09_00_01_281; //婚姻史观察项目类目名称 
$ws_emr09_00->emr09_00_01_282 = $emr09_00_01_282; //婚姻史观察结果 
$ws_emr09_00->emr09_00_01_291 = $emr09_00_01_291; //月经史观察项目类目名称 
$ws_emr09_00->emr09_00_01_292 = $emr09_00_01_292; //月经史观察结果 
$ws_emr09_00->emr09_00_01_301 = $emr09_00_01_301; //生育史观察项目类目名称 
$ws_emr09_00->emr09_00_01_302 = $emr09_00_01_302; //生育史观察结果 
$ws_emr09_00->emr09_00_01_311 = $emr09_00_01_311; //家族史观察项目类目名称 
$ws_emr09_00->emr09_00_01_312 = $emr09_00_01_312; //家族史观察结果 
$ws_emr09_00->emr09_00_01_321 = $emr09_00_01_321; //暴露史观察项目类目名称 
$ws_emr09_00->emr09_00_01_322 = $emr09_00_01_322; //暴露史观察结果 
$ws_emr09_00->emr09_00_01_331 = $emr09_00_01_331; //观察-类别 
$ws_emr09_00->emr09_00_01_332 = $emr09_00_01_332; //观察-类别代码 
$ws_emr09_00->emr09_00_01_333 = $emr09_00_01_333; //观察项目名称 
$ws_emr09_00->emr09_00_01_334 = $emr09_00_01_334; //观察-项目代码 
$ws_emr09_00->emr09_00_01_335 = $emr09_00_01_335; //观察-结果描述 
$ws_emr09_00->emr09_00_01_336 = $emr09_00_01_336; //观察-结果(数值) 
$ws_emr09_00->emr09_00_01_337 = $emr09_00_01_337; //观察-计量单位 
$ws_emr09_00->emr09_00_01_338 = $emr09_00_01_338; //观察-结果代码 
$ws_emr09_00->emr09_00_01_339 = $emr09_00_01_339; //检查部位 
$ws_emr09_00->emr09_00_01_340 = $emr09_00_01_340; //检查部位代码 
$ws_emr09_00->emr09_00_01_351 = $emr09_00_01_351; //观察-类别 
$ws_emr09_00->emr09_00_01_352 = $emr09_00_01_352; //观察-类别代码 
$ws_emr09_00->emr09_00_01_353 = $emr09_00_01_353; //观察项目名称 
$ws_emr09_00->emr09_00_01_354 = $emr09_00_01_354; //观察-项目代码 
$ws_emr09_00->emr09_00_01_355 = $emr09_00_01_355; //观察-结果描述 
$ws_emr09_00->emr09_00_01_356 = $emr09_00_01_356; //观察-结果(数值) 
$ws_emr09_00->emr09_00_01_357 = $emr09_00_01_357; //观察-计量单位 
$ws_emr09_00->emr09_00_01_358 = $emr09_00_01_358; //观察-结果代码 
$ws_emr09_00->emr09_00_01_361 = $emr09_00_01_361; //诊断机构名称 
$ws_emr09_00 ->emr09_00_01_362 = empty($emr09_00_01_362)?null : $ws_emr09_00 ->escape('emr09_00_01_362',to_date($emr09_00_01_362,'YYYY-MM-DD')); //诊断日期  
$ws_emr09_00->emr09_00_01_363 = $emr09_00_01_363; //诊断类别  
$ws_emr09_00->emr09_00_01_364 = $emr09_00_01_364; //诊断类别代码  
$ws_emr09_00->emr09_00_01_365 = $emr09_00_01_365; //诊断顺位（从属关系）代码  
$ws_emr09_00->emr09_00_01_366 = $emr09_00_01_366; //疾病名称  
$ws_emr09_00->emr09_00_01_367 = $emr09_00_01_367; //疾病代码  
$ws_emr09_00->emr09_00_01_368 = $emr09_00_01_368; //诊断依据  
$ws_emr09_00->emr09_00_01_369 = $emr09_00_01_369; //诊断依据代码  
$ws_emr09_00 ->emr09_00_01_371 = empty($emr09_00_01_371)?null : $ws_emr09_00 ->escape('emr09_00_01_371',to_date($emr09_00_01_371,'YYYY-MM-DD')); //疫苗接种日期  
$ws_emr09_00->emr09_00_01_372 = $emr09_00_01_372; //免疫类型代码  
$ws_emr09_00->emr09_00_01_373 = $emr09_00_01_373; //免疫接种方法代码  
$ws_emr09_00->emr09_00_01_374 = $emr09_00_01_374; //免疫接种状态代码  
$ws_emr09_00->emr09_00_01_375 = $emr09_00_01_375; //疫苗-名称代码  
$ws_emr09_00->emr09_00_01_376 = $emr09_00_01_376; //疫苗-批号 
$ws_emr09_00->emr09_00_01_377 = $emr09_00_01_377; //疫苗-名称 
$ws_emr09_00->emr09_00_01_182 = $emr09_00_01_182; //生殖器、肛门、直肠检查体征代码 
$ws_emr09_00->emr09_00_01_183 = $emr09_00_01_183; //生殖器、肛门、直肠检查项目名称 
$ws_emr09_00->emr09_00_01_184 = $emr09_00_01_184; //生殖器、肛门、直肠检查项目类目名称 
$ws_emr09_00->emr09_00_01_185 = $emr09_00_01_185; //生殖器、肛门、直肠检查结果 
$ws_emr09_00->emr09_00_01_191 = $emr09_00_01_191; //四肢检查结果 
$ws_emr09_00->emr09_00_01_192 = $emr09_00_01_192; //脊柱检查结果 
$ws_emr09_00->emr09_00_01_193 = $emr09_00_01_193; //脊柱与四肢检查描述 
$ws_emr09_00->emr09_00_01_194 = $emr09_00_01_194; //脊柱与四肢检查体征代码 
$ws_emr09_00->emr09_00_01_195 = $emr09_00_01_195; //脊柱与四肢检查项目名称 
$ws_emr09_00->emr09_00_01_201 = $emr09_00_01_201; //功能检查描述 
$ws_emr09_00->emr09_00_01_202 = $emr09_00_01_202; //功能检查体征代码 
$ws_emr09_00->emr09_00_01_203 = $emr09_00_01_203; //功能检查项目名称 
$ws_emr09_00->emr09_00_01_204 = $emr09_00_01_204; //残疾情况代码 
$ws_emr09_00->emr09_00_01_205 = $emr09_00_01_205; //功能检查项目类目名称 
$ws_emr09_00->emr09_00_01_206 = $emr09_00_01_206; //功能检查结果 
$ws_emr09_00 ->emr09_00_01_211 = empty($emr09_00_01_211)?null : $ws_emr09_00 ->escape('emr09_00_01_211',to_date($emr09_00_01_211,'YYYY-MM-DD')); //起病时间 
$ws_emr09_00->emr09_00_01_212 = $emr09_00_01_212; //起病情况描述 
$ws_emr09_00->emr09_00_01_213 = $emr09_00_01_213; //症状开始原因/诱因 
$ws_emr09_00->emr09_00_01_214 = $emr09_00_01_214; //症状特点 
$ws_emr09_00->emr09_00_01_215 = $emr09_00_01_215; //伴随症状 
$ws_emr09_00->emr09_00_01_216 = $emr09_00_01_216; //本疾病既往诊疗经过 
$ws_emr09_00->emr09_00_01_217 = $emr09_00_01_217; //起病后一般情况 
$ws_emr09_00->emr09_00_01_218 = $emr09_00_01_218; //基础疾病诊疗情况 
$ws_emr09_00->emr09_00_01_221 = $emr09_00_01_221; //感染途径 
$ws_emr09_00->emr09_00_01_222 = $emr09_00_01_222; //感染途径代码 
$ws_emr09_00->emr09_00_01_223 = $emr09_00_01_223; //家族史观察项目类目名称 
$ws_emr09_00->emr09_00_01_224 = $emr09_00_01_224; //家族史观察结果 
$ws_emr09_00->emr09_00_01_231 = $emr09_00_01_231; //既往疾病史 
$ws_emr09_00->emr09_00_01_232 = $emr09_00_01_232; //既往精神类疾病诊断名称 
$ws_emr09_00->emr09_00_01_233 = $emr09_00_01_233; //既往疾病名称 
$ws_emr09_00->emr09_00_01_234 = $emr09_00_01_234; //既往疾病代码 
$ws_emr09_00->emr09_00_01_235 = $emr09_00_01_235; //既往疾病诊断机构 
$ws_emr09_00->emr09_00_01_236 = $emr09_00_01_236; //既往疾病诊断机构级别代码 
$ws_emr09_00 ->emr09_00_01_237 = empty($emr09_00_01_237)?null : $ws_emr09_00 ->escape('emr09_00_01_237',to_date($emr09_00_01_237,'YYYY-MM-DD')); //既往疾病诊断时间 
$ws_emr09_00->emr09_00_01_238 = $emr09_00_01_238; //疾病当前状态代码 
$ws_emr09_00->emr09_00_01_241 = $emr09_00_01_241; //手术史标识 
$ws_emr09_00->emr09_00_01_242 = $emr09_00_01_242; //手术方式代码 
$ws_emr09_00->emr09_00_01_243 = $emr09_00_01_243; //手术体位代码 
$ws_emr09_00->emr09_00_01_244 = $emr09_00_01_244; //手术过程描述 
$ws_emr09_00->emr09_00_01_251 = $emr09_00_01_251; //输血史标识代码 
$ws_emr09_00->emr09_00_01_252 = $emr09_00_01_252; //输血史观察项目数据组 
$ws_emr09_00->emr09_00_01_253 = $emr09_00_01_253; //输血史观察结果 
$ws_emr09_00->emr09_00_01_261 = $emr09_00_01_261; //过敏史 
$ws_emr09_00->emr09_00_01_262 = $emr09_00_01_262; //过敏原 
$ws_emr09_00->emr09_00_01_263 = $emr09_00_01_263; //过敏症状 
$ws_emr09_00->emr09_00_01_264 = $emr09_00_01_264; //过敏症状代码 
$ws_emr09_00->emr09_00_01_265 = $emr09_00_01_265; //过敏原代码 
$ws_emr09_00->emr09_00_01_266 = $emr09_00_01_266; //过敏药物名称 
$ws_emr09_00->emr09_00_01_267 = $emr09_00_01_267; //过敏病情状态代码 
$ws_emr09_00->emr09_00_01_268 = $emr09_00_01_268; //过敏严重性代码 
$ws_emr09_00->emr09_00_01_269 = $emr09_00_01_269; //过敏史标识代码 
$ws_emr09_00->emr09_00_01_001 = $emr09_00_01_001; //文档标识-名称  
$ws_emr09_00->emr09_00_01_002 = $emr09_00_01_002; //文档标识-类别代码 
$ws_emr09_00->emr09_00_01_003 = $emr09_00_01_003; //文档标识-管理机构名称 
$ws_emr09_00->emr09_00_01_004 = $emr09_00_01_004; //文档标识-管理机构组织机构代码（法人代码） 
$ws_emr09_00->emr09_00_01_005 = $emr09_00_01_005; //文档标识-号码  
$ws_emr09_00 ->emr09_00_01_006 = empty($emr09_00_01_006)?null : $ws_emr09_00 ->escape('emr09_00_01_006',to_date($emr09_00_01_006,'YYYY-MM-DD')); //文档标识-生效日期  
$ws_emr09_00 ->emr09_00_01_007 = empty($emr09_00_01_007)?null : $ws_emr09_00 ->escape('emr09_00_01_007',to_date($emr09_00_01_007,'YYYY-MM-DD')); //文档标识-失效日期  
$ws_emr09_00->emr09_00_01_011 = $emr09_00_01_011; //标识号-类别代码  
$ws_emr09_00->emr09_00_01_012 = $emr09_00_01_012; //标识号-号码 * 
$ws_emr09_00 ->emr09_00_01_013 = empty($emr09_00_01_013)?null : $ws_emr09_00 ->escape('emr09_00_01_013',to_date($emr09_00_01_013,'YYYY-MM-DD')); //标识号-生效日期  
$ws_emr09_00 ->emr09_00_01_014 = empty($emr09_00_01_014)?null : $ws_emr09_00 ->escape('emr09_00_01_014',to_date($emr09_00_01_014,'YYYY-MM-DD')); //标识号-失效日期  
$ws_emr09_00->emr09_00_01_015 = $emr09_00_01_015; //标识号-提供标识的机构名称  
$ws_emr09_00->emr09_00_01_016 = $emr09_00_01_016; //姓名-标识对象 
$ws_emr09_00->emr09_00_01_017 = $emr09_00_01_017; //姓名-标识对象代码 
$ws_emr09_00->emr09_00_01_018 = $emr09_00_01_018; //姓名 * 
$ws_emr09_00->emr09_00_01_021 = $emr09_00_01_021; //性别代码  
$ws_emr09_00->emr09_00_01_022 = $emr09_00_01_022; //年龄（岁）* 
$ws_emr09_00->emr09_00_01_023 = $emr09_00_01_023; //国籍代码  
$ws_emr09_00->emr09_00_01_024 = $emr09_00_01_024; //民族代码  
$ws_emr09_00->emr09_00_01_025 = $emr09_00_01_025; //婚姻状况类别代码 
$ws_emr09_00->emr09_00_01_026 = $emr09_00_01_026; //职业编码系统名称  
$ws_emr09_00->emr09_00_01_027 = $emr09_00_01_027; //职业代码 
$ws_emr09_00->emr09_00_01_028 = $emr09_00_01_028; //文化程度代码  
$ws_emr09_00 ->emr09_00_01_029 = empty($emr09_00_01_029)?null : $ws_emr09_00 ->escape('emr09_00_01_029',to_date($emr09_00_01_029,'YYYY-MM-DD')); //出生日期*  
$ws_emr09_00->emr09_00_01_030 = $emr09_00_01_030; //出生地* 
$ws_emr09_00->emr09_00_01_041 = $emr09_00_01_041; //标识号-类别代码  
$ws_emr09_00->emr09_00_01_042 = $emr09_00_01_042; //标识号-号码* 
$ws_emr09_00 ->emr09_00_01_043 = empty($emr09_00_01_043)?null : $ws_emr09_00 ->escape('emr09_00_01_043',to_date($emr09_00_01_043,'YYYY-MM-DD')); //标识号-生效日期  
$ws_emr09_00 ->emr09_00_01_044 = empty($emr09_00_01_044)?null : $ws_emr09_00 ->escape('emr09_00_01_044',to_date($emr09_00_01_044,'YYYY-MM-DD')); //标识号-失效日期  
$ws_emr09_00->emr09_00_01_045 = $emr09_00_01_045; //标识号-提供标识的机构名称  
$ws_emr09_00->emr09_00_01_046 = $emr09_00_01_046; //姓名-标识对象 
$ws_emr09_00->emr09_00_01_047 = $emr09_00_01_047; //姓名-标识对象代码 
$ws_emr09_00->emr09_00_01_048 = $emr09_00_01_048; //姓名* 
$ws_emr09_00->emr09_00_01_051 = $emr09_00_01_051; //机构名称 
$ws_emr09_00->emr09_00_01_052 = $emr09_00_01_052; //机构组织机构代码 
$ws_emr09_00->emr09_00_01_053 = $emr09_00_01_053; //机构负责人（法人） 
$ws_emr09_00->emr09_00_01_054 = $emr09_00_01_054; //机构地址 
$ws_emr09_00->emr09_00_01_055 = $emr09_00_01_055; //科室名称 
$ws_emr09_00->emr09_00_01_056 = $emr09_00_01_056; //机构角色 
$ws_emr09_00->emr09_00_01_057 = $emr09_00_01_057; //机构角色代码 
$ws_emr09_00->emr09_00_01_061 = $emr09_00_01_061; //服务者姓名* 
$ws_emr09_00->emr09_00_01_062 = $emr09_00_01_062; //服务者职责（角色） 
$ws_emr09_00->emr09_00_01_063 = $emr09_00_01_063; //服务者职责（角色）代码 
$ws_emr09_00->emr09_00_01_064 = $emr09_00_01_064; //服务者医师资格标志* 
$ws_emr09_00->emr09_00_01_065 = $emr09_00_01_065; //服务者学历* 
$ws_emr09_00->emr09_00_01_066 = $emr09_00_01_066; //服务者所学专业* 
$ws_emr09_00->emr09_00_01_067 = $emr09_00_01_067; //服务者专业技术职称* 
$ws_emr09_00->emr09_00_01_068 = $emr09_00_01_068; //服务者职务* 
$ws_emr09_00->emr09_00_01_071 = $emr09_00_01_071; //卫生事件(动作)名称 
$ws_emr09_00->emr09_00_01_072 = $emr09_00_01_072; //事件分类代码 
$ws_emr09_00->emr09_00_01_073 = $emr09_00_01_073; //事件开始时间 
$ws_emr09_00->emr09_00_01_074 = $emr09_00_01_074; //事件结束时间 
$ws_emr09_00 ->emr09_00_01_075 = empty($emr09_00_01_075)?null : $ws_emr09_00 ->escape('emr09_00_01_075',to_date($emr09_00_01_075,'YYYY-MM-DD')); //事件发生地点 
$ws_emr09_00 ->emr09_00_01_076 = empty($emr09_00_01_076)?null : $ws_emr09_00 ->escape('emr09_00_01_076',to_date($emr09_00_01_076,'YYYY-MM-DD')); //事件发生场所 
$ws_emr09_00->emr09_00_01_077 = $emr09_00_01_077; //事件参与方 
$ws_emr09_00->emr09_00_01_078 = $emr09_00_01_078; //事件发生原因 
$ws_emr09_00->emr09_00_01_079 = $emr09_00_01_079; //事件结局 
$ws_emr09_00->emr09_00_01_081 = $emr09_00_01_081; //主诉 
$ws_emr09_00->emr09_00_01_082 = $emr09_00_01_082; //症状代码编码体系名称 
$ws_emr09_00->emr09_00_01_083 = $emr09_00_01_083; //症状代码 
$ws_emr09_00 ->emr09_00_01_084 = empty($emr09_00_01_084)?null : $ws_emr09_00 ->escape('emr09_00_01_084',to_date($emr09_00_01_084,'YYYY-MM-DD')); //症状开始日期时间 
$ws_emr09_00 ->emr09_00_01_085 = empty($emr09_00_01_085)?null : $ws_emr09_00 ->escape('emr09_00_01_085',to_date($emr09_00_01_085,'YYYY-MM-DD')); //症状停止日期时间 
$ws_emr09_00->emr09_00_01_086 = $emr09_00_01_086; //症状观察项目类目名称 
if($ws_emr09_00 ->insert()){
	return true;
}else{
	return false;
}
$ws_emr09_00 ->free_statement();
}
