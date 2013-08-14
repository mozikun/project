<?php
/**
个人信息基本数据个人信息基本数据
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $hra00_01_001  卫生事件名称
* @param date $hra00_01_002  卫生事件发生日期
* @param string $hra00_01_003  卫生事件发生地点
* @param string $hra00_01_101  健康档案标识符
* @param string $hra00_01_102  健康档案管理机构名称
* @param date $hra00_01_103  建档日期
* @param string $hra00_01_201  姓名-标识对象
* @param string $hra00_01_202  姓名-标识对象代码
* @param string $hra00_01_203  标识号-类别代码
* @param string $hra00_01_204  标识号-号码
* @param date $hra00_01_205  标识号-生效日期
* @param date $hra00_01_206  标识号-失效日期
* @param string $hra00_01_207  标识号-提供标识的机构名称
* @param string $hra00_01_208  常住地址户籍标志
* @param string $hra00_01_209  联系电话-类别
* @param string $hra00_01_210  联系电话-类别代码
* @param string $hra00_01_211  联系电话-号码
* @param string $hra00_01_212  电子邮件地址
* @param date $hra00_01_301  出生日期
* @param string $hra00_01_302  性别代码
* @param string $hra00_01_303  国籍代码
* @param string $hra00_01_304  民族代码
* @param string $hra00_01_305  地址类别代码
* @param string $hra00_01_306  地址-省（自治区、直辖市）
* @param string $hra00_01_307  地址-市（地区）
* @param string $hra00_01_308  地址-县（区）
* @param string $hra00_01_309  地址-乡（镇、街道办事处）
* @param string $hra00_01_310  地址-村（街、路、弄等）
* @param string $hra00_01_311  地址-门牌号码
* @param string $hra00_01_312  邮政编码
* @param string $hra00_01_313  行政区划代码
* @param string $hra00_01_314  婚姻状况类别代码
* @param date $hra00_01_315  参加工作日期
* @param string $hra00_01_316  职业类别代码(国标)
* @param string $hra00_01_317  文化程度代码
* @param string $hra00_01_401  医疗保险-类别
* @param string $hra00_01_402  医疗保险-类别代码
* @param string $hra00_01_501  既往观察-项目名称
* @param string $hra00_01_502  既往观察-项目分类代码
* @param string $hra00_01_503  既往观察-项目代码名称
* @param string $hra00_01_504  既往观察-项目代码
* @param string $hra00_01_505  既往观察-方法代码
* @param string $hra00_01_506  既往观察-结果
* @param string $hra00_01_507  既往观察-结果代码
* @param date $hra00_01_508  观察结果开始（发现）日期
* @param date $hra00_01_509  观察结果停止(治愈)日期
* @return boolean
*/
function update_hra00_01($ws_id,$org_id,$doctor_id,$identity_number,$hra00_01_001='',$hra00_01_002='',$hra00_01_003='',$hra00_01_101='',$hra00_01_102='',$hra00_01_103='',$hra00_01_201='',$hra00_01_202='',$hra00_01_203='',$hra00_01_204='',$hra00_01_205='',$hra00_01_206='',$hra00_01_207='',$hra00_01_208='',$hra00_01_209='',$hra00_01_210='',$hra00_01_211='',$hra00_01_212='',$hra00_01_301='',$hra00_01_302='',$hra00_01_303='',$hra00_01_304='',$hra00_01_305='',$hra00_01_306='',$hra00_01_307='',$hra00_01_308='',$hra00_01_309='',$hra00_01_310='',$hra00_01_311='',$hra00_01_312='',$hra00_01_313='',$hra00_01_314='',$hra00_01_315='',$hra00_01_316='',$hra00_01_317='',$hra00_01_401='',$hra00_01_402='',$hra00_01_501='',$hra00_01_502='',$hra00_01_503='',$hra00_01_504='',$hra00_01_505='',$hra00_01_506='',$hra00_01_507='',$hra00_01_508='',$hra00_01_509=''){
require_once(__SITEROOT.'library/Models/ws_hra00_01.php');
$table_obj="Tws_hra00_01";
$ws_hra00_01=new $table_obj();
$ws_hra00_01 -> ws_id=$ws_id;
$ws_hra00_01 -> uuid=uniqid('',true);
$ws_hra00_01 -> created=time();
$ws_hra00_01 -> org_id=$org_id;
$ws_hra00_01 -> doctor_id=$doctor_id;
$ws_hra00_01 -> identity_number=$identity_number;//身份证号
$ws_hra00_01 -> action='insert';
$ws_hra00_01->hra00_01_001 = $hra00_01_001; //卫生事件名称 
$ws_hra00_01 ->hra00_01_002 = empty($hra00_01_002)?null : $ws_hra00_01 ->escape('hra00_01_002',to_date($hra00_01_002,'YYYY-MM-DD')); //卫生事件发生日期 
$ws_hra00_01->hra00_01_003 = $hra00_01_003; //卫生事件发生地点 
$ws_hra00_01->hra00_01_101 = $hra00_01_101; //健康档案标识符 
$ws_hra00_01->hra00_01_102 = $hra00_01_102; //健康档案管理机构名称 
$ws_hra00_01 ->hra00_01_103 = empty($hra00_01_103)?null : $ws_hra00_01 ->escape('hra00_01_103',to_date($hra00_01_103,'YYYY-MM-DD')); //建档日期 
$ws_hra00_01->hra00_01_201 = $hra00_01_201; //姓名-标识对象 
$ws_hra00_01->hra00_01_202 = $hra00_01_202; //姓名-标识对象代码 
$ws_hra00_01->hra00_01_203 = $hra00_01_203; //标识号-类别代码 
$ws_hra00_01->hra00_01_204 = $hra00_01_204; //标识号-号码 
$ws_hra00_01 ->hra00_01_205 = empty($hra00_01_205)?null : $ws_hra00_01 ->escape('hra00_01_205',to_date($hra00_01_205,'YYYY-MM-DD')); //标识号-生效日期 
$ws_hra00_01 ->hra00_01_206 = empty($hra00_01_206)?null : $ws_hra00_01 ->escape('hra00_01_206',to_date($hra00_01_206,'YYYY-MM-DD')); //标识号-失效日期 
$ws_hra00_01->hra00_01_207 = $hra00_01_207; //标识号-提供标识的机构名称 
$ws_hra00_01->hra00_01_208 = $hra00_01_208; //常住地址户籍标志 
$ws_hra00_01->hra00_01_209 = $hra00_01_209; //联系电话-类别 
$ws_hra00_01->hra00_01_210 = $hra00_01_210; //联系电话-类别代码 
$ws_hra00_01->hra00_01_211 = $hra00_01_211; //联系电话-号码 
$ws_hra00_01->hra00_01_212 = $hra00_01_212; //电子邮件地址 
$ws_hra00_01 ->hra00_01_301 = empty($hra00_01_301)?null : $ws_hra00_01 ->escape('hra00_01_301',to_date($hra00_01_301,'YYYY-MM-DD')); //出生日期 
$ws_hra00_01->hra00_01_302 = $hra00_01_302; //性别代码 
$ws_hra00_01->hra00_01_303 = $hra00_01_303; //国籍代码 
$ws_hra00_01->hra00_01_304 = $hra00_01_304; //民族代码 
$ws_hra00_01->hra00_01_305 = $hra00_01_305; //地址类别代码 
$ws_hra00_01->hra00_01_306 = $hra00_01_306; //地址-省（自治区、直辖市） 
$ws_hra00_01->hra00_01_307 = $hra00_01_307; //地址-市（地区） 
$ws_hra00_01->hra00_01_308 = $hra00_01_308; //地址-县（区） 
$ws_hra00_01->hra00_01_309 = $hra00_01_309; //地址-乡（镇、街道办事处） 
$ws_hra00_01->hra00_01_310 = $hra00_01_310; //地址-村（街、路、弄等） 
$ws_hra00_01->hra00_01_311 = $hra00_01_311; //地址-门牌号码 
$ws_hra00_01->hra00_01_312 = $hra00_01_312; //邮政编码 
$ws_hra00_01->hra00_01_313 = $hra00_01_313; //行政区划代码 
$ws_hra00_01->hra00_01_314 = $hra00_01_314; //婚姻状况类别代码 
$ws_hra00_01 ->hra00_01_315 = empty($hra00_01_315)?null : $ws_hra00_01 ->escape('hra00_01_315',to_date($hra00_01_315,'YYYY-MM-DD')); //参加工作日期 
$ws_hra00_01->hra00_01_316 = $hra00_01_316; //职业类别代码(国标) 
$ws_hra00_01->hra00_01_317 = $hra00_01_317; //文化程度代码 
$ws_hra00_01->hra00_01_401 = $hra00_01_401; //医疗保险-类别 
$ws_hra00_01->hra00_01_402 = $hra00_01_402; //医疗保险-类别代码 
$ws_hra00_01->hra00_01_501 = $hra00_01_501; //既往观察-项目名称 
$ws_hra00_01->hra00_01_502 = $hra00_01_502; //既往观察-项目分类代码 
$ws_hra00_01->hra00_01_503 = $hra00_01_503; //既往观察-项目代码名称 
$ws_hra00_01->hra00_01_504 = $hra00_01_504; //既往观察-项目代码 
$ws_hra00_01->hra00_01_505 = $hra00_01_505; //既往观察-方法代码 
$ws_hra00_01->hra00_01_506 = $hra00_01_506; //既往观察-结果 
$ws_hra00_01->hra00_01_507 = $hra00_01_507; //既往观察-结果代码 
$ws_hra00_01 ->hra00_01_508 = empty($hra00_01_508)?null : $ws_hra00_01 ->escape('hra00_01_508',to_date($hra00_01_508,'YYYY-MM-DD')); //观察结果开始（发现）日期 
$ws_hra00_01 ->hra00_01_509 = empty($hra00_01_509)?null : $ws_hra00_01 ->escape('hra00_01_509',to_date($hra00_01_509,'YYYY-MM-DD')); //观察结果停止(治愈)日期 
if($ws_hra00_01 ->insert()){
	return true;
}else{
	return false;
}
$ws_hra00_01 ->free_statement();
}
