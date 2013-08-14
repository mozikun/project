<?php
/**
门诊诊疗基本数据门诊诊疗基本数据
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrc00_01_101  就诊机构名称
* @param dateTime $hrc00_01_102  就诊日期时间
* @param string $hrc00_01_103  门诊号
* @param string $hrc00_01_104  就诊患者就医科室名称
* @param string $hrc00_01_201  姓名
* @param date $hrc00_01_202  出生日期
* @param string $hrc00_01_203  性别代码
* @param string $hrc00_01_204  婚姻状况类别代码
* @param boolean $hrc00_01_205  门诊症状-名称
* @param string $hrc00_01_206  门诊症状-诊断代码
* @param string $hrc00_01_207  疾病诊断名称
* @param string $hrc00_01_208  疾病诊断代码
* @param dateTime $hrc00_01_209  发病日期时间
* @param date $hrc00_01_210  诊断日期
* @param string $hrc00_01_301  检查/检验-类别代码
* @param string $hrc00_01_302  检查/检验-项目名称
* @param string $hrc00_01_303  检查/检验-结果代码
* @param string $hrc00_01_304  检查/检验-结果(定性)
* @param decimal $hrc00_01_305  检查/检验-结果(数值)
* @param string $hrc00_01_306  检查/检验-计量单位
* @param string $hrc00_01_401  中药类别代码
* @param string $hrc00_01_402  药物类型
* @param string $hrc00_01_403  药物名称
* @param string $hrc00_01_404  药物剂型代码
* @param decimal $hrc00_01_405  用药天数
* @param string $hrc00_01_406  药物使用-频率
* @param string $hrc00_01_407  药物使用-剂量单位
* @param decimal $hrc00_01_408  药物使用-次剂量
* @param decimal $hrc00_01_409  药物使用-总剂量
* @param string $hrc00_01_410  药物使用-途径代码
* @param dateTime $hrc00_01_411  用药停止日期时间
* @param string $hrc00_01_501  手术/操作-名称
* @param string $hrc00_01_502  手术/操作-代码
* @param string $hrc00_01_503  手术/操作-目标部位名称
* @param string $hrc00_01_601  门诊费用-分类
* @param string $hrc00_01_602  门诊费用-分类代码
* @param decimal $hrc00_01_603  门诊费用-金额（元/人民币）
* @param string $hrc00_01_604  门诊费用-支付方式代码
* @return boolean
*/
function update_hrc00_01($ws_id,$org_id,$doctor_id,$identity_number,$hrc00_01_101='',$hrc00_01_102='',$hrc00_01_103='',$hrc00_01_104='',$hrc00_01_201='',$hrc00_01_202='',$hrc00_01_203='',$hrc00_01_204='',$hrc00_01_205=false,$hrc00_01_206='',$hrc00_01_207='',$hrc00_01_208='',$hrc00_01_209='',$hrc00_01_210='',$hrc00_01_301='',$hrc00_01_302='',$hrc00_01_303='',$hrc00_01_304='',$hrc00_01_305=0,$hrc00_01_306='',$hrc00_01_401='',$hrc00_01_402='',$hrc00_01_403='',$hrc00_01_404='',$hrc00_01_405=0,$hrc00_01_406='',$hrc00_01_407='',$hrc00_01_408=0,$hrc00_01_409=0,$hrc00_01_410='',$hrc00_01_411='',$hrc00_01_501='',$hrc00_01_502='',$hrc00_01_503='',$hrc00_01_601='',$hrc00_01_602='',$hrc00_01_603=0,$hrc00_01_604=''){
require_once(__SITEROOT.'library/Models/ws_hrc00_01.php');
$table_obj="Tws_hrc00_01";
$ws_hrc00_01=new $table_obj();
$ws_hrc00_01 -> ws_id=$ws_id;
$ws_hrc00_01 -> uuid=uniqid('',true);
$ws_hrc00_01 -> created=time();
$ws_hrc00_01 -> org_id=$org_id;
$ws_hrc00_01 -> doctor_id=$doctor_id;
$ws_hrc00_01 -> identity_number=$identity_number;//身份证号
$ws_hrc00_01 -> action='insert';
$ws_hrc00_01->hrc00_01_101 = $hrc00_01_101; //就诊机构名称 
$ws_hrc00_01 ->hrc00_01_102 = empty($hrc00_01_102)?null : $ws_hrc00_01 ->escape('hrc00_01_102',to_date($hrc00_01_102,'YYYY-MM-DD')); //就诊日期时间 
$ws_hrc00_01->hrc00_01_103 = $hrc00_01_103; //门诊号 
$ws_hrc00_01->hrc00_01_104 = $hrc00_01_104; //就诊患者就医科室名称 
$ws_hrc00_01->hrc00_01_201 = $hrc00_01_201; //姓名 
$ws_hrc00_01 ->hrc00_01_202 = empty($hrc00_01_202)?null : $ws_hrc00_01 ->escape('hrc00_01_202',to_date($hrc00_01_202,'YYYY-MM-DD')); //出生日期 
$ws_hrc00_01->hrc00_01_203 = $hrc00_01_203; //性别代码 
$ws_hrc00_01->hrc00_01_204 = $hrc00_01_204; //婚姻状况类别代码 
$ws_hrc00_01->hrc00_01_205 = $hrc00_01_205; //门诊症状-名称 
$ws_hrc00_01->hrc00_01_206 = $hrc00_01_206; //门诊症状-诊断代码 
$ws_hrc00_01->hrc00_01_207 = $hrc00_01_207; //疾病诊断名称 
$ws_hrc00_01->hrc00_01_208 = $hrc00_01_208; //疾病诊断代码 
$ws_hrc00_01 ->hrc00_01_209 = empty($hrc00_01_209)?null : $ws_hrc00_01 ->escape('hrc00_01_209',to_date($hrc00_01_209,'YYYY-MM-DD')); //发病日期时间 
$ws_hrc00_01 ->hrc00_01_210 = empty($hrc00_01_210)?null : $ws_hrc00_01 ->escape('hrc00_01_210',to_date($hrc00_01_210,'YYYY-MM-DD')); //诊断日期 
$ws_hrc00_01->hrc00_01_301 = $hrc00_01_301; //检查/检验-类别代码 
$ws_hrc00_01->hrc00_01_302 = $hrc00_01_302; //检查/检验-项目名称 
$ws_hrc00_01->hrc00_01_303 = $hrc00_01_303; //检查/检验-结果代码 
$ws_hrc00_01->hrc00_01_304 = $hrc00_01_304; //检查/检验-结果(定性) 
$ws_hrc00_01->hrc00_01_305 = $hrc00_01_305; //检查/检验-结果(数值) 
$ws_hrc00_01->hrc00_01_306 = $hrc00_01_306; //检查/检验-计量单位 
$ws_hrc00_01->hrc00_01_401 = $hrc00_01_401; //中药类别代码 
$ws_hrc00_01->hrc00_01_402 = $hrc00_01_402; //药物类型 
$ws_hrc00_01->hrc00_01_403 = $hrc00_01_403; //药物名称 
$ws_hrc00_01->hrc00_01_404 = $hrc00_01_404; //药物剂型代码 
$ws_hrc00_01->hrc00_01_405 = $hrc00_01_405; //用药天数 
$ws_hrc00_01->hrc00_01_406 = $hrc00_01_406; //药物使用-频率 
$ws_hrc00_01->hrc00_01_407 = $hrc00_01_407; //药物使用-剂量单位 
$ws_hrc00_01->hrc00_01_408 = $hrc00_01_408; //药物使用-次剂量 
$ws_hrc00_01->hrc00_01_409 = $hrc00_01_409; //药物使用-总剂量 
$ws_hrc00_01->hrc00_01_410 = $hrc00_01_410; //药物使用-途径代码 
$ws_hrc00_01 ->hrc00_01_411 = empty($hrc00_01_411)?null : $ws_hrc00_01 ->escape('hrc00_01_411',to_date($hrc00_01_411,'YYYY-MM-DD')); //用药停止日期时间 
$ws_hrc00_01->hrc00_01_501 = $hrc00_01_501; //手术/操作-名称 
$ws_hrc00_01->hrc00_01_502 = $hrc00_01_502; //手术/操作-代码 
$ws_hrc00_01->hrc00_01_503 = $hrc00_01_503; //手术/操作-目标部位名称 
$ws_hrc00_01->hrc00_01_601 = $hrc00_01_601; //门诊费用-分类 
$ws_hrc00_01->hrc00_01_602 = $hrc00_01_602; //门诊费用-分类代码 
$ws_hrc00_01->hrc00_01_603 = $hrc00_01_603; //门诊费用-金额（元/人民币） 
$ws_hrc00_01->hrc00_01_604 = $hrc00_01_604; //门诊费用-支付方式代码 
if($ws_hrc00_01 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrc00_01 ->free_statement();
}
