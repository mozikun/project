<?php
require_once(__SITEROOT.'library/Models/staff_core.php');//用户核心表
require_once(__SITEROOT.'library/Models/staff_archive.php');//用户扩展表
require_once(__SITEROOT."application/admin/models/getRoles.php");//取得角色
/**
 * 根据用户用和密码证验证是否与数据库内容一致.
 *
 * @param string $user
 * @param string $passwd
 */
function verificaUser($user='',$passwd=''){
	
	if(!empty($user) && !empty($passwd)){
		$staff_core		=	new Tstaff_core();
		$staff_archive	=	new Tstaff_archive();
		$staff_core->whereAdd("staff_core.id='{$user}'");
		$staff_core->whereAdd("staff_core.passwd='{$passwd}'");
		$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
		//$staff_core->debugLevel(3);
		//$count=$staff_core->count();
		//echo $count;
		$staff_core->find();
		//$staff_core_row		=	array();
		//$staff_archive_row	=	array();
		$row				=	array();//存放所有结果
		$count				=	0;
		while ($staff_core->fetch()) {
			//echo $staff_core->name_login;
			//print_r($staff_core);
			$row['uuid']=$staff_core->id;//个人档案编号
			$row['name_login']=$staff_core->name_login;//登录名			
			$row['individual_stander_code']=$staff_core->standard_code;//个人标准代码
			$row['region_id']=$staff_core->region_id;//机构id
			$row['org_id']=$staff_core->org_id;//所属机构
			$org_info=getOrgName($staff_core->org_id);//机构信息
			$row['org_zh_name']=$org_info->zh_name;//机构名
			$row['current_region_path_domain']=$org_info->region_path_domain;//机构所属区域
			$row['current_region_path']=$org_info->region_path;//机构所属区域
			$row['role_id']=$staff_core->role_id;//角色ID
			$roles=getRoles($staff_core->role_id);//角色信息
			
			//print_r($roles);
			$row['role_en_name']=$roles[0]['role_en_name'];//角色英语名
			$row['role_zh_name']=$roles[0]['role_zh_name'];//角色中文名
			$row['role_width_option']=$roles[0]['width_option'];//管理是否拥有管理权限
			$row['name_real']=$staff_archive->name_real;//真实名
			
			
			//$staff_core_row		=	$staff_core;
			//$staff_archive_row	=	$staff_archive;
			
			
			
			$count++;
		}
		//print_r($staff_core_row);
		//print_r($staff_archive_row);
		
		//print_r($row);
	    return $row;
	 	
		
		
	}else{
		throw new Exception(__FILE__.__FUNCTION__.'用户名和密码不能为空!');
	}
	
	
}
/**
 * 根据机构ID取得机构所有信息
 *
 * @param number $id
 * @return string
 */
function getOrgName($id){
	require_once(__SITEROOT.'library/Models/organization.php');
	$organization=new Torganization();
	$organization->whereAdd("id={$id}");
	$organization->find();
	$organization->fetch();
	return $organization;
	
}