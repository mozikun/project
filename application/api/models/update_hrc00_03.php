<?php
/**
住院病案首页基本数据住院病案首页基本数据
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hrc00_03_101  住院机构名称
* @param date $hrc00_03_102  入院日期
* @param decimal $hrc00_03_103  住院患者住院次数
* @param string $hrc00_03_104  病案号
* @param string $hrc00_03_105  住院患者入院科室名称
* @param string $hrc00_03_106  住院患者入院病情
* @param string $hrc00_03_107  住院患者转科科室名称
* @param string $hrc00_03_108  住院患者过敏源
* @param date $hrc00_03_109  住院患者过敏症状出现日期
* @param string $hrc00_03_201  住院患者医院感染名称
* @param string $hrc00_03_202  住院患者损伤和中毒外部原因
* @param string $hrc00_03_203  住院患者血清学检查项目代码
* @param string $hrc00_03_204  住院患者血清学检查结果代码
* @param string $hrc00_03_205  疾病诊断名称
* @param string $hrc00_03_206  疾病诊断代码
* @param date $hrc00_03_207  确诊日期
* @param string $hrc00_03_208  患者疾病诊断对照
* @param string $hrc00_03_209  住院患者疾病诊断对照代码
* @param string $hrc00_03_210  住院患者诊断符合情况-详细描述
* @param string $hrc00_03_211  住院患者诊断符合情况-代码
* @param string $hrc00_03_212  住院患者疾病诊断类型-详细描述
* @param string $hrc00_03_213  住院患者疾病诊断类型-代码
* @param string $hrc00_03_301  手术/操作-名称
* @param string $hrc00_03_302  手术/操作-代码
* @param string $hrc00_03_303  手术/操作-目标部位名称
* @param string $hrc00_03_304  麻醉-方法
* @param string $hrc00_03_305  麻醉-方法代码
* @param string $hrc00_03_306  手术切口愈合等级代码
* @param string $hrc00_03_307  住院期间输血品种代码
* @param decimal $hrc00_03_308  住院期间输血量
* @param string $hrc00_03_309  住院患者输血量计量单位
* @param string $hrc00_03_310  住院患者输血反应标志
* @param decimal $hrc00_03_311  住院患者抢救次数
* @param decimal $hrc00_03_312  住院患者抢救成功次数
* @param string $hrc00_03_401  住院患者治疗结果代码
* @param date $hrc00_03_402  出院日期
* @param string $hrc00_03_403  住院患者出院科室名称
* @param decimal $hrc00_03_404  住院患者住院天数
* @param boolean $hrc00_03_405  住院患者尸检标志
* @param boolean $hrc00_03_406  住院患者随诊标志
* @param string $hrc00_03_501  住院费用-分类
* @param string $hrc00_03_502  住院费用-分类代码
* @param decimal $hrc00_03_503  住院费用-金额（元/人民币）
* @param string $hrc00_03_504  住院费用-医疗付款方式代码
* @param string $hrc00_03_601  相关医生角色名称
* @param string $hrc00_03_602  相关医生姓名
* @param boolean $hrc00_03_603  住院患者示教病例标志
* @param string $hrc00_03_604  住院病例病案质量代码
* @return boolean
*/
function update_hrc00_03($ws_id,$org_id,$doctor_id,$identity_number,$hrc00_03_101='',$hrc00_03_102='',$hrc00_03_103=0,$hrc00_03_104='',$hrc00_03_105='',$hrc00_03_106='',$hrc00_03_107='',$hrc00_03_108='',$hrc00_03_109='',$hrc00_03_201='',$hrc00_03_202='',$hrc00_03_203='',$hrc00_03_204='',$hrc00_03_205='',$hrc00_03_206='',$hrc00_03_207='',$hrc00_03_208='',$hrc00_03_209='',$hrc00_03_210='',$hrc00_03_211='',$hrc00_03_212='',$hrc00_03_213='',$hrc00_03_301='',$hrc00_03_302='',$hrc00_03_303='',$hrc00_03_304='',$hrc00_03_305='',$hrc00_03_306='',$hrc00_03_307='',$hrc00_03_308=0,$hrc00_03_309='',$hrc00_03_310='',$hrc00_03_311=0,$hrc00_03_312=0,$hrc00_03_401='',$hrc00_03_402='',$hrc00_03_403='',$hrc00_03_404=0,$hrc00_03_405=false,$hrc00_03_406=false,$hrc00_03_501='',$hrc00_03_502='',$hrc00_03_503=0,$hrc00_03_504='',$hrc00_03_601='',$hrc00_03_602='',$hrc00_03_603=false,$hrc00_03_604=''){
require_once(__SITEROOT.'library/Models/ws_hrc00_03.php');
$table_obj="Tws_hrc00_03";
$ws_hrc00_03=new $table_obj();
$ws_hrc00_03 -> ws_id=$ws_id;
$ws_hrc00_03 -> uuid=uniqid('',true);
$ws_hrc00_03 -> created=time();
$ws_hrc00_03 -> org_id=$org_id;
$ws_hrc00_03 -> doctor_id=$doctor_id;
$ws_hrc00_03 -> identity_number=$identity_number;//身份证号
$ws_hrc00_03 -> action='insert';
$ws_hrc00_03->hrc00_03_101 = $hrc00_03_101; //住院机构名称 
$ws_hrc00_03 ->hrc00_03_102 = empty($hrc00_03_102)?null : $ws_hrc00_03 ->escape('hrc00_03_102',to_date($hrc00_03_102,'YYYY-MM-DD')); //入院日期 
$ws_hrc00_03->hrc00_03_103 = $hrc00_03_103; //住院患者住院次数 
$ws_hrc00_03->hrc00_03_104 = $hrc00_03_104; //病案号 
$ws_hrc00_03->hrc00_03_105 = $hrc00_03_105; //住院患者入院科室名称 
$ws_hrc00_03->hrc00_03_106 = $hrc00_03_106; //住院患者入院病情 
$ws_hrc00_03->hrc00_03_107 = $hrc00_03_107; //住院患者转科科室名称 
$ws_hrc00_03->hrc00_03_108 = $hrc00_03_108; //住院患者过敏源 
$ws_hrc00_03 ->hrc00_03_109 = empty($hrc00_03_109)?null : $ws_hrc00_03 ->escape('hrc00_03_109',to_date($hrc00_03_109,'YYYY-MM-DD')); //住院患者过敏症状出现日期 
$ws_hrc00_03->hrc00_03_201 = $hrc00_03_201; //住院患者医院感染名称 
$ws_hrc00_03->hrc00_03_202 = $hrc00_03_202; //住院患者损伤和中毒外部原因 
$ws_hrc00_03->hrc00_03_203 = $hrc00_03_203; //住院患者血清学检查项目代码 
$ws_hrc00_03->hrc00_03_204 = $hrc00_03_204; //住院患者血清学检查结果代码 
$ws_hrc00_03->hrc00_03_205 = $hrc00_03_205; //疾病诊断名称 
$ws_hrc00_03->hrc00_03_206 = $hrc00_03_206; //疾病诊断代码 
$ws_hrc00_03 ->hrc00_03_207 = empty($hrc00_03_207)?null : $ws_hrc00_03 ->escape('hrc00_03_207',to_date($hrc00_03_207,'YYYY-MM-DD')); //确诊日期 
$ws_hrc00_03->hrc00_03_208 = $hrc00_03_208; //患者疾病诊断对照 
$ws_hrc00_03->hrc00_03_209 = $hrc00_03_209; //住院患者疾病诊断对照代码 
$ws_hrc00_03->hrc00_03_210 = $hrc00_03_210; //住院患者诊断符合情况-详细描述 
$ws_hrc00_03->hrc00_03_211 = $hrc00_03_211; //住院患者诊断符合情况-代码 
$ws_hrc00_03->hrc00_03_212 = $hrc00_03_212; //住院患者疾病诊断类型-详细描述 
$ws_hrc00_03->hrc00_03_213 = $hrc00_03_213; //住院患者疾病诊断类型-代码 
$ws_hrc00_03->hrc00_03_301 = $hrc00_03_301; //手术/操作-名称 
$ws_hrc00_03->hrc00_03_302 = $hrc00_03_302; //手术/操作-代码 
$ws_hrc00_03->hrc00_03_303 = $hrc00_03_303; //手术/操作-目标部位名称 
$ws_hrc00_03->hrc00_03_304 = $hrc00_03_304; //麻醉-方法 
$ws_hrc00_03->hrc00_03_305 = $hrc00_03_305; //麻醉-方法代码 
$ws_hrc00_03->hrc00_03_306 = $hrc00_03_306; //手术切口愈合等级代码 
$ws_hrc00_03->hrc00_03_307 = $hrc00_03_307; //住院期间输血品种代码 
$ws_hrc00_03->hrc00_03_308 = $hrc00_03_308; //住院期间输血量 
$ws_hrc00_03->hrc00_03_309 = $hrc00_03_309; //住院患者输血量计量单位 
$ws_hrc00_03->hrc00_03_310 = $hrc00_03_310; //住院患者输血反应标志 
$ws_hrc00_03->hrc00_03_311 = $hrc00_03_311; //住院患者抢救次数 
$ws_hrc00_03->hrc00_03_312 = $hrc00_03_312; //住院患者抢救成功次数 
$ws_hrc00_03->hrc00_03_401 = $hrc00_03_401; //住院患者治疗结果代码 
$ws_hrc00_03 ->hrc00_03_402 = empty($hrc00_03_402)?null : $ws_hrc00_03 ->escape('hrc00_03_402',to_date($hrc00_03_402,'YYYY-MM-DD')); //出院日期 
$ws_hrc00_03->hrc00_03_403 = $hrc00_03_403; //住院患者出院科室名称 
$ws_hrc00_03->hrc00_03_404 = $hrc00_03_404; //住院患者住院天数 
$ws_hrc00_03->hrc00_03_405 = $hrc00_03_405; //住院患者尸检标志 
$ws_hrc00_03->hrc00_03_406 = $hrc00_03_406; //住院患者随诊标志 
$ws_hrc00_03->hrc00_03_501 = $hrc00_03_501; //住院费用-分类 
$ws_hrc00_03->hrc00_03_502 = $hrc00_03_502; //住院费用-分类代码 
$ws_hrc00_03->hrc00_03_503 = $hrc00_03_503; //住院费用-金额（元/人民币） 
$ws_hrc00_03->hrc00_03_504 = $hrc00_03_504; //住院费用-医疗付款方式代码 
$ws_hrc00_03->hrc00_03_601 = $hrc00_03_601; //相关医生角色名称 
$ws_hrc00_03->hrc00_03_602 = $hrc00_03_602; //相关医生姓名 
$ws_hrc00_03->hrc00_03_603 = $hrc00_03_603; //住院患者示教病例标志 
$ws_hrc00_03->hrc00_03_604 = $hrc00_03_604; //住院病例病案质量代码 
if($ws_hrc00_03 ->insert()){
	return true;
}else{
	return false;
}
$ws_hrc00_03 ->free_statement();
}
