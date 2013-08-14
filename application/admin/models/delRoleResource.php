<?php
require_once(__SITEROOT.'library/Models/role_resource.php');//角色对应的资源
/**
 * 删除 role_resource表的字段$key内容为$value
 *
 * @param String $key
 * @param mixed $value
 * @return bool
 */
function delRoleResource($key,$value){
	
	if(empty($key) && empty($value)){
		new Exception("参错误");
	}
	$role_resource=new Trole_resource();
	$role_resource->whereAdd("$key='$value'");
	
	if($role_resource->delete()){
		return true;
	}else{
		return false;
	}
	
	
}