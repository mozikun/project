<?php

require_once(__SITEROOT.'library/Models/resources.php');
/**
 * 根据resource_id_array中的resource_id取是资源信息 
 *
 * @param array $resource_id_array=array(resource_id1,resource_id2...)
 * @return array
 */
function getResources($resource_id_array=array()){
	
		$resources_table=new Tresources();
		//对应的resource_id
		foreach ($resource_id_array as $resource_id){
			$resources_table->whereAdd("resource_id='{$resource_id}'");
		}
		$resources_table->orderby("resource_en_name ASC");
		$resources_table->find();
		$row=array();//
		//print_r($resources_table);
		$i=0;
		
		while ($resources_table->fetch()){
			$row[$i]['resource_id']		= $resources_table->resource_id;
			$row[$i]['resource_en_name']= $resources_table->resource_en_name;
			$row[$i]['resource_zh_name']= $resources_table->resource_zh_name;	
			$i++;		
		}
		return $row;
}
/**
 * role_resource表中存在着对应的role_id的资源id，取出role_resource中的权限，以resources表为准，权限为空
 *$resource_arr=Array (
 	'0' => Array (
 		 'uuid' => '14c031d60f06c6' ,
 		 'role_id' => '14bfe1647b5bef',
 		 'resource_id' => '14bfe1a3f1f513',
 		 'read' => '1',
 		 'write' => '#^&*^&*#', 
 		 'resource_en_name' => 'dddff',
 		 'resource_zh_name' => 'ddd' ));

 * @param array $resource_arr 
 * $current_role_resource_arr=Array ( 
	'0' => Array (
		 'resource_id' => '14bfe1a3f1f513', 
		 'resource_en_name' => 'dddff', 
		 'resource_zh_name' => 'ddd' ), 
	'1' => Array ( 
		'resource_id' => '14bff5ed3bddd5', 
		'resource_en_name' => 'sadf', 
		'resource_zh_name' => 'asdfd' )
		) ;
 * @param array $current_role_resource_arr
 */
function currentRoleResource($resource_arr,$current_role_resource_arr){
	
	foreach ($resource_arr as $key=>$resource_array){
		
		foreach ($current_role_resource_arr as  $current_resource_arr){
			
		  if($resource_array['resource_id']==$current_resource_arr['resource_id']){
		  	
			$resource_arr[$key]['read']=$current_resource_arr['read'];
			
			$resource_arr[$key]['write']=$current_resource_arr['write'];
		}
	}
	
	}
	return $resource_arr;
}