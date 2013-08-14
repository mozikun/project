<?php
/**
电子病历基础模板：医疗机构信息数据集EMR15.00电子病历基础模板：医疗机构信息数据集
* @param string $ws_id 
* @param string $org_id 机构id
* @param string $doctor_id  医生id
* @param string $identity_number  身份证号
* @param string $emr15_00_001  工作单位名称 
* @param string $emr15_00_002  标识地址类别的代码 
* @param string $emr15_00_003  地址-省（自治区、直辖市）
* @param string $emr15_00_004  地址-市（地区）
* @param string $emr15_00_005  地址-县（区）
* @param string $emr15_00_006  地址-乡（镇、街道办事处）
* @param string $emr15_00_007  地址-村（街、路、弄等）
* @param string $emr15_00_008  地址-门牌号码
* @param string $emr15_00_009  邮政编码 
* @param string $emr15_00_010  行政区划代码 
* @param string $emr15_00_021  联系电话-类别
* @param string $emr15_00_022  联系电话-类别代码
* @param string $emr15_00_023  联系电话-号码
* @param string $emr15_00_024  电子邮件地址
* @param string $emr15_00_031  机构名称
* @param string $emr15_00_032  机构组织机构代码
* @param string $emr15_00_033  机构负责人（法人）
* @param string $emr15_00_034  机构地址
* @param string $emr15_00_035  科室名称
* @param string $emr15_00_036  机构角色
* @param string $emr15_00_037  机构角色代码
* @param string $emr15_00_041  服务者姓名
* @param string $emr15_00_042  服务者职责（角色）
* @param string $emr15_00_043  服务者职责（角色）代码
* @param string $emr15_00_044  服务者医师资格标志
* @param string $emr15_00_045  服务者学历
* @param string $emr15_00_046  服务者所学专业
* @param string $emr15_00_047  服务者专业技术职称
* @param string $emr15_00_048  服务者职务
* @return boolean
*/
function update_emr15_00($ws_id,$org_id,$doctor_id,$identity_number,$emr15_00_001='',$emr15_00_002='',$emr15_00_003='',$emr15_00_004='',$emr15_00_005='',$emr15_00_006='',$emr15_00_007='',$emr15_00_008='',$emr15_00_009='',$emr15_00_010='',$emr15_00_021='',$emr15_00_022='',$emr15_00_023='',$emr15_00_024='',$emr15_00_031='',$emr15_00_032='',$emr15_00_033='',$emr15_00_034='',$emr15_00_035='',$emr15_00_036='',$emr15_00_037='',$emr15_00_041='',$emr15_00_042='',$emr15_00_043='',$emr15_00_044='',$emr15_00_045='',$emr15_00_046='',$emr15_00_047='',$emr15_00_048=''){
require_once(__SITEROOT.'library/Models/ws_emr15_00.php');
$table_obj="Tws_emr15_00";
$ws_emr15_00=new $table_obj();
$ws_emr15_00 -> ws_id=$ws_id;
$ws_emr15_00 -> uuid=uniqid('',true);
$ws_emr15_00 -> created=time();
$ws_emr15_00 -> org_id=$org_id;
$ws_emr15_00 -> doctor_id=$doctor_id;
$ws_emr15_00 -> identity_number=$identity_number;//身份证号
$ws_emr15_00 -> action='insert';
$ws_emr15_00->emr15_00_001 = $emr15_00_001; //工作单位名称  
$ws_emr15_00->emr15_00_002 = $emr15_00_002; //标识地址类别的代码  
$ws_emr15_00->emr15_00_003 = $emr15_00_003; //地址-省（自治区、直辖市） 
$ws_emr15_00->emr15_00_004 = $emr15_00_004; //地址-市（地区） 
$ws_emr15_00->emr15_00_005 = $emr15_00_005; //地址-县（区） 
$ws_emr15_00->emr15_00_006 = $emr15_00_006; //地址-乡（镇、街道办事处） 
$ws_emr15_00->emr15_00_007 = $emr15_00_007; //地址-村（街、路、弄等） 
$ws_emr15_00->emr15_00_008 = $emr15_00_008; //地址-门牌号码 
$ws_emr15_00->emr15_00_009 = $emr15_00_009; //邮政编码  
$ws_emr15_00->emr15_00_010 = $emr15_00_010; //行政区划代码  
$ws_emr15_00->emr15_00_021 = $emr15_00_021; //联系电话-类别 
$ws_emr15_00->emr15_00_022 = $emr15_00_022; //联系电话-类别代码 
$ws_emr15_00->emr15_00_023 = $emr15_00_023; //联系电话-号码 
$ws_emr15_00->emr15_00_024 = $emr15_00_024; //电子邮件地址 
$ws_emr15_00->emr15_00_031 = $emr15_00_031; //机构名称 
$ws_emr15_00->emr15_00_032 = $emr15_00_032; //机构组织机构代码 
$ws_emr15_00->emr15_00_033 = $emr15_00_033; //机构负责人（法人） 
$ws_emr15_00->emr15_00_034 = $emr15_00_034; //机构地址 
$ws_emr15_00->emr15_00_035 = $emr15_00_035; //科室名称 
$ws_emr15_00->emr15_00_036 = $emr15_00_036; //机构角色 
$ws_emr15_00->emr15_00_037 = $emr15_00_037; //机构角色代码 
$ws_emr15_00->emr15_00_041 = $emr15_00_041; //服务者姓名 
$ws_emr15_00->emr15_00_042 = $emr15_00_042; //服务者职责（角色） 
$ws_emr15_00->emr15_00_043 = $emr15_00_043; //服务者职责（角色）代码 
$ws_emr15_00->emr15_00_044 = $emr15_00_044; //服务者医师资格标志 
$ws_emr15_00->emr15_00_045 = $emr15_00_045; //服务者学历 
$ws_emr15_00->emr15_00_046 = $emr15_00_046; //服务者所学专业 
$ws_emr15_00->emr15_00_047 = $emr15_00_047; //服务者专业技术职称 
$ws_emr15_00->emr15_00_048 = $emr15_00_048; //服务者职务 
if($ws_emr15_00 ->insert()){
	return true;
}else{
	return false;
}
$ws_emr15_00 ->free_statement();
}
