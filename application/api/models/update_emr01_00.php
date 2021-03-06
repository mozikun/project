<?php
/**
电子病历基础模板：病历概要数据集EMR01.00电子病历基础模板：病历概要数据集
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $emr01_00_01_002  文档标识-名称 
* @param string $emr01_00_01_003  文档标识-类别代码
* @param string $emr01_00_01_004  文档标识-管理机构名称
* @param string $emr01_00_01_005  文档标识-管理机构组织机构代码（法人代码）
* @param string $emr01_00_01_006  文档标识-号码 
* @param date $emr01_00_01_007  文档标识-生效日期 
* @param date $emr01_00_01_011  文档标识-失效日期 
* @param string $emr01_00_01_012  标识号-类别代码 
* @param string $emr01_00_01_013  标识号-号码 
* @param date $emr01_00_01_014  标识号-生效日期 
* @param date $emr01_00_01_015  标识号-失效日期 
* @param string $emr01_00_01_016  标识号-提供标识的机构名称 
* @param string $emr01_00_01_017  姓名-标识对象
* @param string $emr01_00_01_018  姓名-标识对象代码
* @param string $emr01_00_01_021  姓名 *
* @param string $emr01_00_01_022  ABO血型
* @param string $emr01_00_01_031  RH血型
* @param string $emr01_00_01_032  个体危险性名称
* @param string $emr01_00_01_041  个体危险性代码
* @param string $emr01_00_01_042  性别代码 
* @param decimal $emr01_00_01_043  年龄（岁）*
* @param string $emr01_00_01_044  国籍代码 
* @param string $emr01_00_01_045  民族代码 
* @param string $emr01_00_01_046  婚姻状况类别代码
* @param string $emr01_00_01_047  职业编码系统名称 
* @param string $emr01_00_01_048  职业代码
* @param string $emr01_00_01_049  文化程度代码 
* @param date $emr01_00_01_050  出生日期 
* @param string $emr01_00_01_061  出生地 
* @param string $emr01_00_01_062  标识号-类别代码 
* @param string $emr01_00_01_063  标识号-号码 
* @param date $emr01_00_01_064  标识号-生效日期 
* @param date $emr01_00_01_065  标识号-失效日期 
* @param string $emr01_00_01_066  标识号-提供标识的机构名称 
* @param string $emr01_00_01_067  姓名-标识对象
* @param string $emr01_00_01_068  姓名-标识对象代码
* @param string $emr01_00_01_071  姓名 *
* @param string $emr01_00_01_072  工作单位名称 *
* @param string $emr01_00_01_073  标识地址类别的代码 
* @param string $emr01_00_01_074  地址-省（自治区、直辖市）*
* @param string $emr01_00_01_075  地址-市（地区）*
* @param string $emr01_00_01_076  地址-县（区）*
* @param string $emr01_00_01_077  地址-乡（镇、街道办事处）*
* @param string $emr01_00_01_078  地址-村（街、路、弄等）*
* @param string $emr01_00_01_079  地址-门牌号码*
* @param string $emr01_00_01_080  邮政编码 *
* @param string $emr01_00_01_091  行政区划代码 *
* @param string $emr01_00_01_092  联系电话-类别
* @param string $emr01_00_01_093  联系电话-类别代码
* @param string $emr01_00_01_094  联系电话-号码*
* @param string $emr01_00_01_101  电子邮件地址*
* @param string $emr01_00_01_102  医疗保险-类别
* @param string $emr01_00_01_201  医疗保险-类别代码
* @param string $emr01_00_01_202  既往疾病史
* @param string $emr01_00_01_203  既往精神类疾病诊断名称
* @param string $emr01_00_01_204  既往疾病名称
* @param string $emr01_00_01_205  既往疾病代码
* @param string $emr01_00_01_206  既往疾病诊断机构
* @param string $emr01_00_01_207  既往疾病诊断机构级别代码
* @param date $emr01_00_01_208  既往疾病诊断时间
* @param string $emr01_00_01_211  疾病当前状态代码
* @param string $emr01_00_01_212  药物用法
* @param string $emr01_00_01_213  药物使用-频率
* @param string $emr01_00_01_214  药物使用-剂量单位
* @param decimal $emr01_00_01_215  药物使用-次剂量
* @param decimal $emr01_00_01_216  药物使用-总剂量
* @param string $emr01_00_01_217  药物使用-途径代码
* @param string $emr01_00_01_218  药物名称
* @param string $emr01_00_01_219  药物剂型代码
* @param string $emr01_00_01_220  中药类别代码
* @param string $emr01_00_01_221  药物类型
* @param string $emr01_00_01_231  药物名称代码
* @param string $emr01_00_01_232  卫生事件(动作)名称
* @param string $emr01_00_01_233  事件分类代码
* @param string $emr01_00_01_234  事件开始时间
* @param string $emr01_00_01_235  事件结束时间
* @param date $emr01_00_01_236  事件发生地点
* @param date $emr01_00_01_237  事件发生场所
* @param string $emr01_00_01_238  事件参与方
* @param string $emr01_00_01_239  事件发生原因
* @param string $emr01_00_01_241  事件结局
* @param string $emr01_00_01_242  门诊费用-分类
* @param string $emr01_00_01_243  门诊费用-分类代码
* @param decimal $emr01_00_01_244  门诊费用-金额（元/人民币）
* @param string $emr01_00_01_245  门诊费用-支付方式代码
* @param string $emr01_00_01_246  住院费用-分类
* @param string $emr01_00_01_247  住院费用-分类代码
* @param decimal $emr01_00_01_248  住院费用-金额（元/人民币）
* @param string $emr01_00_01_249  住院费用-医疗付款方式代码
* @return boolean
*/
function update_emr01_00($ws_id,$org_id,$doctor_id,$identity_number,$emr01_00_01_002='',$emr01_00_01_003='',$emr01_00_01_004='',$emr01_00_01_005='',$emr01_00_01_006='',$emr01_00_01_007='',$emr01_00_01_011='',$emr01_00_01_012='',$emr01_00_01_013='',$emr01_00_01_014='',$emr01_00_01_015='',$emr01_00_01_016='',$emr01_00_01_017='',$emr01_00_01_018='',$emr01_00_01_021='',$emr01_00_01_022='',$emr01_00_01_031='',$emr01_00_01_032='',$emr01_00_01_041='',$emr01_00_01_042='',$emr01_00_01_043=0,$emr01_00_01_044='',$emr01_00_01_045='',$emr01_00_01_046='',$emr01_00_01_047='',$emr01_00_01_048='',$emr01_00_01_049='',$emr01_00_01_050='',$emr01_00_01_061='',$emr01_00_01_062='',$emr01_00_01_063='',$emr01_00_01_064='',$emr01_00_01_065='',$emr01_00_01_066='',$emr01_00_01_067='',$emr01_00_01_068='',$emr01_00_01_071='',$emr01_00_01_072='',$emr01_00_01_073='',$emr01_00_01_074='',$emr01_00_01_075='',$emr01_00_01_076='',$emr01_00_01_077='',$emr01_00_01_078='',$emr01_00_01_079='',$emr01_00_01_080='',$emr01_00_01_091='',$emr01_00_01_092='',$emr01_00_01_093='',$emr01_00_01_094='',$emr01_00_01_101='',$emr01_00_01_102='',$emr01_00_01_201='',$emr01_00_01_202='',$emr01_00_01_203='',$emr01_00_01_204='',$emr01_00_01_205='',$emr01_00_01_206='',$emr01_00_01_207='',$emr01_00_01_208='',$emr01_00_01_211='',$emr01_00_01_212='',$emr01_00_01_213='',$emr01_00_01_214='',$emr01_00_01_215=0,$emr01_00_01_216=0,$emr01_00_01_217='',$emr01_00_01_218='',$emr01_00_01_219='',$emr01_00_01_220='',$emr01_00_01_221='',$emr01_00_01_231='',$emr01_00_01_232='',$emr01_00_01_233='',$emr01_00_01_234='',$emr01_00_01_235='',$emr01_00_01_236='',$emr01_00_01_237='',$emr01_00_01_238='',$emr01_00_01_239='',$emr01_00_01_241='',$emr01_00_01_242='',$emr01_00_01_243='',$emr01_00_01_244=0,$emr01_00_01_245='',$emr01_00_01_246='',$emr01_00_01_247='',$emr01_00_01_248=0,$emr01_00_01_249=''){
require_once(__SITEROOT.'library/Models/ws_emr01_00.php');
$table_obj="Tws_emr01_00";
$ws_emr01_00=new $table_obj();
$ws_emr01_00 -> ws_id=$ws_id;
$ws_emr01_00 -> uuid=uniqid('',true);
$ws_emr01_00 -> created=time();
$ws_emr01_00 -> org_id=$org_id;
$ws_emr01_00 -> doctor_id=$doctor_id;
$ws_emr01_00 -> identity_number=$identity_number;//身份证号
$ws_emr01_00 -> action='insert';
$ws_emr01_00->emr01_00_01_002 = $emr01_00_01_002; //文档标识-名称  
$ws_emr01_00->emr01_00_01_003 = $emr01_00_01_003; //文档标识-类别代码 
$ws_emr01_00->emr01_00_01_004 = $emr01_00_01_004; //文档标识-管理机构名称 
$ws_emr01_00->emr01_00_01_005 = $emr01_00_01_005; //文档标识-管理机构组织机构代码（法人代码） 
$ws_emr01_00->emr01_00_01_006 = $emr01_00_01_006; //文档标识-号码  
$ws_emr01_00 ->emr01_00_01_007 = empty($emr01_00_01_007)?null : $ws_emr01_00 ->escape('emr01_00_01_007',to_date($emr01_00_01_007,'YYYY-MM-DD')); //文档标识-生效日期  
$ws_emr01_00 ->emr01_00_01_011 = empty($emr01_00_01_011)?null : $ws_emr01_00 ->escape('emr01_00_01_011',to_date($emr01_00_01_011,'YYYY-MM-DD')); //文档标识-失效日期  
$ws_emr01_00->emr01_00_01_012 = $emr01_00_01_012; //标识号-类别代码  
$ws_emr01_00->emr01_00_01_013 = $emr01_00_01_013; //标识号-号码  
$ws_emr01_00 ->emr01_00_01_014 = empty($emr01_00_01_014)?null : $ws_emr01_00 ->escape('emr01_00_01_014',to_date($emr01_00_01_014,'YYYY-MM-DD')); //标识号-生效日期  
$ws_emr01_00 ->emr01_00_01_015 = empty($emr01_00_01_015)?null : $ws_emr01_00 ->escape('emr01_00_01_015',to_date($emr01_00_01_015,'YYYY-MM-DD')); //标识号-失效日期  
$ws_emr01_00->emr01_00_01_016 = $emr01_00_01_016; //标识号-提供标识的机构名称  
$ws_emr01_00->emr01_00_01_017 = $emr01_00_01_017; //姓名-标识对象 
$ws_emr01_00->emr01_00_01_018 = $emr01_00_01_018; //姓名-标识对象代码 
$ws_emr01_00->emr01_00_01_021 = $emr01_00_01_021; //姓名 * 
$ws_emr01_00->emr01_00_01_022 = $emr01_00_01_022; //ABO血型 
$ws_emr01_00->emr01_00_01_031 = $emr01_00_01_031; //RH血型 
$ws_emr01_00->emr01_00_01_032 = $emr01_00_01_032; //个体危险性名称 
$ws_emr01_00->emr01_00_01_041 = $emr01_00_01_041; //个体危险性代码 
$ws_emr01_00->emr01_00_01_042 = $emr01_00_01_042; //性别代码  
$ws_emr01_00->emr01_00_01_043 = $emr01_00_01_043; //年龄（岁）* 
$ws_emr01_00->emr01_00_01_044 = $emr01_00_01_044; //国籍代码  
$ws_emr01_00->emr01_00_01_045 = $emr01_00_01_045; //民族代码  
$ws_emr01_00->emr01_00_01_046 = $emr01_00_01_046; //婚姻状况类别代码 
$ws_emr01_00->emr01_00_01_047 = $emr01_00_01_047; //职业编码系统名称  
$ws_emr01_00->emr01_00_01_048 = $emr01_00_01_048; //职业代码 
$ws_emr01_00->emr01_00_01_049 = $emr01_00_01_049; //文化程度代码  
$ws_emr01_00 ->emr01_00_01_050 = empty($emr01_00_01_050)?null : $ws_emr01_00 ->escape('emr01_00_01_050',to_date($emr01_00_01_050,'YYYY-MM-DD')); //出生日期  
$ws_emr01_00->emr01_00_01_061 = $emr01_00_01_061; //出生地  
$ws_emr01_00->emr01_00_01_062 = $emr01_00_01_062; //标识号-类别代码  
$ws_emr01_00->emr01_00_01_063 = $emr01_00_01_063; //标识号-号码  
$ws_emr01_00 ->emr01_00_01_064 = empty($emr01_00_01_064)?null : $ws_emr01_00 ->escape('emr01_00_01_064',to_date($emr01_00_01_064,'YYYY-MM-DD')); //标识号-生效日期  
$ws_emr01_00 ->emr01_00_01_065 = empty($emr01_00_01_065)?null : $ws_emr01_00 ->escape('emr01_00_01_065',to_date($emr01_00_01_065,'YYYY-MM-DD')); //标识号-失效日期  
$ws_emr01_00->emr01_00_01_066 = $emr01_00_01_066; //标识号-提供标识的机构名称  
$ws_emr01_00->emr01_00_01_067 = $emr01_00_01_067; //姓名-标识对象 
$ws_emr01_00->emr01_00_01_068 = $emr01_00_01_068; //姓名-标识对象代码 
$ws_emr01_00->emr01_00_01_071 = $emr01_00_01_071; //姓名 * 
$ws_emr01_00->emr01_00_01_072 = $emr01_00_01_072; //工作单位名称 * 
$ws_emr01_00->emr01_00_01_073 = $emr01_00_01_073; //标识地址类别的代码  
$ws_emr01_00->emr01_00_01_074 = $emr01_00_01_074; //地址-省（自治区、直辖市）* 
$ws_emr01_00->emr01_00_01_075 = $emr01_00_01_075; //地址-市（地区）* 
$ws_emr01_00->emr01_00_01_076 = $emr01_00_01_076; //地址-县（区）* 
$ws_emr01_00->emr01_00_01_077 = $emr01_00_01_077; //地址-乡（镇、街道办事处）* 
$ws_emr01_00->emr01_00_01_078 = $emr01_00_01_078; //地址-村（街、路、弄等）* 
$ws_emr01_00->emr01_00_01_079 = $emr01_00_01_079; //地址-门牌号码* 
$ws_emr01_00->emr01_00_01_080 = $emr01_00_01_080; //邮政编码 * 
$ws_emr01_00->emr01_00_01_091 = $emr01_00_01_091; //行政区划代码 * 
$ws_emr01_00->emr01_00_01_092 = $emr01_00_01_092; //联系电话-类别 
$ws_emr01_00->emr01_00_01_093 = $emr01_00_01_093; //联系电话-类别代码 
$ws_emr01_00->emr01_00_01_094 = $emr01_00_01_094; //联系电话-号码* 
$ws_emr01_00->emr01_00_01_101 = $emr01_00_01_101; //电子邮件地址* 
$ws_emr01_00->emr01_00_01_102 = $emr01_00_01_102; //医疗保险-类别 
$ws_emr01_00->emr01_00_01_201 = $emr01_00_01_201; //医疗保险-类别代码 
$ws_emr01_00->emr01_00_01_202 = $emr01_00_01_202; //既往疾病史 
$ws_emr01_00->emr01_00_01_203 = $emr01_00_01_203; //既往精神类疾病诊断名称 
$ws_emr01_00->emr01_00_01_204 = $emr01_00_01_204; //既往疾病名称 
$ws_emr01_00->emr01_00_01_205 = $emr01_00_01_205; //既往疾病代码 
$ws_emr01_00->emr01_00_01_206 = $emr01_00_01_206; //既往疾病诊断机构 
$ws_emr01_00->emr01_00_01_207 = $emr01_00_01_207; //既往疾病诊断机构级别代码 
$ws_emr01_00 ->emr01_00_01_208 = empty($emr01_00_01_208)?null : $ws_emr01_00 ->escape('emr01_00_01_208',to_date($emr01_00_01_208,'YYYY-MM-DD')); //既往疾病诊断时间 
$ws_emr01_00->emr01_00_01_211 = $emr01_00_01_211; //疾病当前状态代码 
$ws_emr01_00->emr01_00_01_212 = $emr01_00_01_212; //药物用法 
$ws_emr01_00->emr01_00_01_213 = $emr01_00_01_213; //药物使用-频率 
$ws_emr01_00->emr01_00_01_214 = $emr01_00_01_214; //药物使用-剂量单位 
$ws_emr01_00->emr01_00_01_215 = $emr01_00_01_215; //药物使用-次剂量 
$ws_emr01_00->emr01_00_01_216 = $emr01_00_01_216; //药物使用-总剂量 
$ws_emr01_00->emr01_00_01_217 = $emr01_00_01_217; //药物使用-途径代码 
$ws_emr01_00->emr01_00_01_218 = $emr01_00_01_218; //药物名称 
$ws_emr01_00->emr01_00_01_219 = $emr01_00_01_219; //药物剂型代码 
$ws_emr01_00->emr01_00_01_220 = $emr01_00_01_220; //中药类别代码 
$ws_emr01_00->emr01_00_01_221 = $emr01_00_01_221; //药物类型 
$ws_emr01_00->emr01_00_01_231 = $emr01_00_01_231; //药物名称代码 
$ws_emr01_00->emr01_00_01_232 = $emr01_00_01_232; //卫生事件(动作)名称 
$ws_emr01_00->emr01_00_01_233 = $emr01_00_01_233; //事件分类代码 
$ws_emr01_00->emr01_00_01_234 = $emr01_00_01_234; //事件开始时间 
$ws_emr01_00->emr01_00_01_235 = $emr01_00_01_235; //事件结束时间 
$ws_emr01_00 ->emr01_00_01_236 = empty($emr01_00_01_236)?null : $ws_emr01_00 ->escape('emr01_00_01_236',to_date($emr01_00_01_236,'YYYY-MM-DD')); //事件发生地点 
$ws_emr01_00 ->emr01_00_01_237 = empty($emr01_00_01_237)?null : $ws_emr01_00 ->escape('emr01_00_01_237',to_date($emr01_00_01_237,'YYYY-MM-DD')); //事件发生场所 
$ws_emr01_00->emr01_00_01_238 = $emr01_00_01_238; //事件参与方 
$ws_emr01_00->emr01_00_01_239 = $emr01_00_01_239; //事件发生原因 
$ws_emr01_00->emr01_00_01_241 = $emr01_00_01_241; //事件结局 
$ws_emr01_00->emr01_00_01_242 = $emr01_00_01_242; //门诊费用-分类 
$ws_emr01_00->emr01_00_01_243 = $emr01_00_01_243; //门诊费用-分类代码 
$ws_emr01_00->emr01_00_01_244 = $emr01_00_01_244; //门诊费用-金额（元/人民币） 
$ws_emr01_00->emr01_00_01_245 = $emr01_00_01_245; //门诊费用-支付方式代码 
$ws_emr01_00->emr01_00_01_246 = $emr01_00_01_246; //住院费用-分类 
$ws_emr01_00->emr01_00_01_247 = $emr01_00_01_247; //住院费用-分类代码 
$ws_emr01_00->emr01_00_01_248 = $emr01_00_01_248; //住院费用-金额（元/人民币） 
$ws_emr01_00->emr01_00_01_249 = $emr01_00_01_249; //住院费用-医疗付款方式代码 
if($ws_emr01_00 ->insert()){
	return true;
}else{
	return false;
}
$ws_emr01_00 ->free_statement();
}
