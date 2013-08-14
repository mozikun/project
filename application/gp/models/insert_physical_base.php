<?php
require_once(__SITEROOT.'library/Models/physical_base.php');
/**
 * 插入体格检查-基本检查
 * @param String $uuid(体检uuid)
 * @param String $staff_id(医生id)
 * @param String $serial_number(个人档案号)  
 * @param String $module_name(模块名)
 * @param String $r_uuid(引用页uuid)
 * @param String $r_url(引用页url)
 * @param String $height(身高)
 * @param String $weight(体重)
 * @param String $bmi(体重指数)
 * @param String $s_blood_pressure(收缩压)
 * @param String $p_blood_pressure(舒张压)
 * @param String $experience_time(体检时间戳)
 */
function insert_physical_base($uuid,$staff_id,$serial_number,$module_name,$r_uuid,$r_url='',$height='',$weight='',$bmi='',$s_blood_pressure='',$p_blood_pressure='',$experience_time=''){
	$physical_base=new Tphysical_base();
	
	$physical_base->uuid 				= empty($uuid)?$uuiduniqid("ot",true):$uuid;//编号
	
	$physical_base->staff_id 			= $staff_id;//医生档案号
	
	$physical_base->id 					= $serial_number;//个人档案号
	
	$physical_base->created 			= time();//添加记录时间
	
	$physical_base->module_name 		= $module_name;//模块名
	
	$physical_base->r_uuid 				= $r_uuid;//引用模块的uuid
	
	$physical_base->r_url 				= $r_url;//引用模块的url
	
	$physical_base->height 				= $height;//身高(米)|text
	
	$physical_base->weight 				= $weight;//体重(公斤)|text
	
	$physical_base->bmi 				= $bmi;//体重指数|text
	
	$physical_base->s_blood_pressure 	= $s_blood_pressure;//收缩压(mmHg)|text
	
	$physical_base->p_blood_pressure 	= $p_blood_pressure;//舒张压(mmHg)|text
	
	$physical_base->doctors_signature 	= $staff_id;//医生签字|text
	
	$physical_base->experience_time 	= $experience_time;//体检时间|text
	
	$physical_base->insert();
}
