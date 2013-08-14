<?php
/**
住院诊疗基本数据集住院诊疗基本数据集
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrc00_02_101  住院机构名称
* @param date $hrc00_02_102  入院日期
* @param string $hrc00_02_103  住院原因
* @param string $hrc00_02_104  病案号
* @param string $hrc00_02_105  住院患者入院科室名称
* @param string $hrc00_02_106  住院症状-名称
* @param string $hrc00_02_107  住院症状-代码
* @param string $hrc00_02_108  姓名
* @param date $hrc00_02_109  出生日期
* @param string $hrc00_02_110  性别代码
* @param string $hrc00_02_111  婚姻状况类别代码
* @param string $hrc00_02_201  住院患者入院诊断-名称
* @param string $hrc00_02_202  住院患者入院诊断-代码
* @param boolean $hrc00_02_203  住院患者传染性标识
* @param string $hrc00_02_204  住院患者疾病状态
* @param dateTime $hrc00_02_205  发病日期时间
* @param date $hrc00_02_206  确诊日期
* @param string $hrc00_02_207  检查/检验-类别代码
* @param string $hrc00_02_208  检查/检验-项目名称
* @param string $hrc00_02_209  检查/检验-结果代码
* @param string $hrc00_02_210  检查/检验-结果(定性)
* @param decimal $hrc00_02_211  检查/检验-结果(数值)
* @param string $hrc00_02_212  检查/检验-计量单位
* @param string $hrc00_02_213  检查/检验-项目代码
* @param string $hrc00_02_214  中药类别代码
* @param string $hrc00_02_215  药物类型
* @param string $hrc00_02_216  药物名称
* @param string $hrc00_02_217  药物剂型代码
* @param decimal $hrc00_02_218  用药天数
* @param string $hrc00_02_219  药物使用-频率
* @param string $hrc00_02_220  药物使用-剂量单位
* @param decimal $hrc00_02_221  药物使用-次剂量
* @param decimal $hrc00_02_222  药物使用-总剂量
* @param string $hrc00_02_223  药物使用-途径代码
* @param dateTime $hrc00_02_224  用药停止日期时间
* @param string $hrc00_02_301  手术/操作-名称
* @param string $hrc00_02_302  手术/操作-代码
* @param string $hrc00_02_303  手术/操作-目标部位名称
* @param date $hrc00_02_304  手术日期
* @param string $hrc00_02_305  麻醉-方法
* @param string $hrc00_02_306  麻醉-方法代码
* @param string $hrc00_02_307  住院患者出院诊断-名称
* @param string $hrc00_02_308  住院患者出院诊断-代码
* @param string $hrc00_02_401  住院患者治疗结果代码
* @param date $hrc00_02_402  出院日期
* @param string $hrc00_02_403  根本死因代码
* @param dateTime $hrc00_02_404  死亡日期时间
* @param string $hrc00_02_501  住院费用-分类
* @param string $hrc00_02_502  住院费用-分类代码
* @param decimal $hrc00_02_503  住院费用-金额（元/人民币）
* @param string $hrc00_02_504  住院费用-医疗付款方式代码
* @return boolean
*/
function update_hrc00_02($ws_id,$org_id,$doctor_id,$identity_number,$hrc00_02_101='',$hrc00_02_102='',$hrc00_02_103='',$hrc00_02_104='',$hrc00_02_105='',$hrc00_02_106='',$hrc00_02_107='',$hrc00_02_108='',$hrc00_02_109='',$hrc00_02_110='',$hrc00_02_111='',$hrc00_02_201='',$hrc00_02_202='',$hrc00_02_203=false,$hrc00_02_204='',$hrc00_02_205='',$hrc00_02_206='',$hrc00_02_207='',$hrc00_02_208='',$hrc00_02_209='',$hrc00_02_210='',$hrc00_02_211=0,$hrc00_02_212='',$hrc00_02_213='',$hrc00_02_214='',$hrc00_02_215='',$hrc00_02_216='',$hrc00_02_217='',$hrc00_02_218=0,$hrc00_02_219='',$hrc00_02_220='',$hrc00_02_221=0,$hrc00_02_222=0,$hrc00_02_223='',$hrc00_02_224='',$hrc00_02_301='',$hrc00_02_302='',$hrc00_02_303='',$hrc00_02_304='',$hrc00_02_305='',$hrc00_02_306='',$hrc00_02_307='',$hrc00_02_308='',$hrc00_02_401='',$hrc00_02_402='',$hrc00_02_403='',$hrc00_02_404='',$hrc00_02_501='',$hrc00_02_502='',$hrc00_02_503=0,$hrc00_02_504=''){
require_once(__SITEROOT.'library/Models/ws_hrc00_02.php');
$table_obj="Tws_hrc00_02";
$ws_hrc00_02=new $table_obj();
$ws_hrc00_02 -> ws_id=$ws_id;
$ws_hrc00_02 -> uuid=uniqid('',true);
$ws_hrc00_02 -> created=time();
$ws_hrc00_02 -> org_id=$org_id;
$ws_hrc00_02 -> doctor_id=$doctor_id;
$ws_hrc00_02 -> identity_number=$identity_number;//身份证号
$ws_hrc00_02 -> action='insert';
$ws_hrc00_02->hrc00_02_101 = $hrc00_02_101; //住院机构名称 
$ws_hrc00_02 ->hrc00_02_102 = empty($hrc00_02_102)?null : $ws_hrc00_02 ->escape('hrc00_02_102',to_date($hrc00_02_102,'YYYY-MM-DD')); //入院日期 
$ws_hrc00_02->hrc00_02_103 = $hrc00_02_103; //住院原因 
$ws_hrc00_02->hrc00_02_104 = $hrc00_02_104; //病案号 
$ws_hrc00_02->hrc00_02_105 = $hrc00_02_105; //住院患者入院科室名称 
$ws_hrc00_02->hrc00_02_106 = $hrc00_02_106; //住院症状-名称 
$ws_hrc00_02->hrc00_02_107 = $hrc00_02_107; //住院症状-代码 
$ws_hrc00_02->hrc00_02_108 = $hrc00_02_108; //姓名 
$ws_hrc00_02 ->hrc00_02_109 = empty($hrc00_02_109)?null : $ws_hrc00_02 ->escape('hrc00_02_109',to_date($hrc00_02_109,'YYYY-MM-DD')); //出生日期 
$ws_hrc00_02->hrc00_02_110 = $hrc00_02_110; //性别代码 
$ws_hrc00_02->hrc00_02_111 = $hrc00_02_111; //婚姻状况类别代码 
$ws_hrc00_02->hrc00_02_201 = $hrc00_02_201; //住院患者入院诊断-名称 
$ws_hrc00_02->hrc00_02_202 = $hrc00_02_202; //住院患者入院诊断-代码 
$ws_hrc00_02->hrc00_02_203 = $hrc00_02_203; //住院患者传染性标识 
$ws_hrc00_02->hrc00_02_204 = $hrc00_02_204; //住院患者疾病状态 
$ws_hrc00_02 ->hrc00_02_205 = empty($hrc00_02_205)?null : $ws_hrc00_02 ->escape('hrc00_02_205',to_date($hrc00_02_205,'YYYY-MM-DD')); //发病日期时间 
$ws_hrc00_02 ->hrc00_02_206 = empty($hrc00_02_206)?null : $ws_hrc00_02 ->escape('hrc00_02_206',to_date($hrc00_02_206,'YYYY-MM-DD')); //确诊日期 
$ws_hrc00_02->hrc00_02_207 = $hrc00_02_207; //检查/检验-类别代码 
$ws_hrc00_02->hrc00_02_208 = $hrc00_02_208; //检查/检验-项目名称 
$ws_hrc00_02->hrc00_02_209 = $hrc00_02_209; //检查/检验-结果代码 
$ws_hrc00_02->hrc00_02_210 = $hrc00_02_210; //检查/检验-结果(定性) 
$ws_hrc00_02->hrc00_02_211 = $hrc00_02_211; //检查/检验-结果(数值) 
$ws_hrc00_02->hrc00_02_212 = $hrc00_02_212; //检查/检验-计量单位 
$ws_hrc00_02->hrc00_02_213 = $hrc00_02_213; //检查/检验-项目代码 
$ws_hrc00_02->hrc00_02_214 = $hrc00_02_214; //中药类别代码 
$ws_hrc00_02->hrc00_02_215 = $hrc00_02_215; //药物类型 
$ws_hrc00_02->hrc00_02_216 = $hrc00_02_216; //药物名称 
$ws_hrc00_02->hrc00_02_217 = $hrc00_02_217; //药物剂型代码 
$ws_hrc00_02->hrc00_02_218 = $hrc00_02_218; //用药天数 
$ws_hrc00_02->hrc00_02_219 = $hrc00_02_219; //药物使用-频率 
$ws_hrc00_02->hrc00_02_220 = $hrc00_02_220; //药物使用-剂量单位 
$ws_hrc00_02->hrc00_02_221 = $hrc00_02_221; //药物使用-次剂量 
$ws_hrc00_02->hrc00_02_222 = $hrc00_02_222; //药物使用-总剂量 
$ws_hrc00_02->hrc00_02_223 = $hrc00_02_223; //药物使用-途径代码 
$ws_hrc00_02 ->hrc00_02_224 = empty($hrc00_02_224)?null : $ws_hrc00_02 ->escape('hrc00_02_224',to_date($hrc00_02_224,'YYYY-MM-DD')); //用药停止日期时间 
$ws_hrc00_02->hrc00_02_301 = $hrc00_02_301; //手术/操作-名称 
$ws_hrc00_02->hrc00_02_302 = $hrc00_02_302; //手术/操作-代码 
$ws_hrc00_02->hrc00_02_303 = $hrc00_02_303; //手术/操作-目标部位名称 
$ws_hrc00_02 ->hrc00_02_304 = empty($hrc00_02_304)?null : $ws_hrc00_02 ->escape('hrc00_02_304',to_date($hrc00_02_304,'YYYY-MM-DD')); //手术日期 
$ws_hrc00_02->hrc00_02_305 = $hrc00_02_305; //麻醉-方法 
$ws_hrc00_02->hrc00_02_306 = $hrc00_02_306; //麻醉-方法代码 
$ws_hrc00_02->hrc00_02_307 = $hrc00_02_307; //住院患者出院诊断-名称 
$ws_hrc00_02->hrc00_02_308 = $hrc00_02_308; //住院患者出院诊断-代码 
$ws_hrc00_02->hrc00_02_401 = $hrc00_02_401; //住院患者治疗结果代码 
$ws_hrc00_02 ->hrc00_02_402 = empty($hrc00_02_402)?null : $ws_hrc00_02 ->escape('hrc00_02_402',to_date($hrc00_02_402,'YYYY-MM-DD')); //出院日期 
$ws_hrc00_02->hrc00_02_403 = $hrc00_02_403; //根本死因代码 
$ws_hrc00_02 ->hrc00_02_404 = empty($hrc00_02_404)?null : $ws_hrc00_02 ->escape('hrc00_02_404',to_date($hrc00_02_404,'YYYY-MM-DD')); //死亡日期时间 
$ws_hrc00_02->hrc00_02_501 = $hrc00_02_501; //住院费用-分类 
$ws_hrc00_02->hrc00_02_502 = $hrc00_02_502; //住院费用-分类代码 
$ws_hrc00_02->hrc00_02_503 = $hrc00_02_503; //住院费用-金额（元/人民币） 
$ws_hrc00_02->hrc00_02_504 = $hrc00_02_504; //住院费用-医疗付款方式代码 
if($ws_hrc00_02 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrc00_02 ->free_statement();
}
