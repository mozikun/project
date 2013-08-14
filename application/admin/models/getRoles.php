<?php

require_once(__SITEROOT.'library/Models/role_table.php');
/**
 * 根据role_id_array中的role_id取是角色信息 
 *
 * @param array $role_id_array=array(role_id1,role_id2...)
 * @return array
 */
function getRoles($role_id_array=array()){
	
		$roles_table=new Trole_table();
		//对应的role_id
		if(is_array($role_id_array)){
			foreach ($role_id_array as $role_id){
				$roles_table->whereAdd("role_id='{$role_id}'");
			}
		}elseif(is_string($role_id_array)){
			
			$roles_table->whereAdd("role_id='{$role_id_array}'");
		}else{
			throw new Exception(__FILE__.__FUNCTION__.'参数错误');
		}
		
		$roles_table->find();
		$row=array();//
		//print_r($roles_table);
		$i=0;
		
		while ($roles_table->fetch()){
			$row[$i]['role_id']		= $roles_table->role_id;
			$row[$i]['role_en_name']= $roles_table->role_en_name;
			$row[$i]['role_zh_name']= $roles_table->role_zh_name;
			$row[$i]['width_option']= $roles_table->width_option;	
			$i++;		
		}
		return $row;
}