<?php
/**
 * 资源管理/添加/修改/删除
 *
 */

class admin_resourceController extends controller {

	public function init()
	{
		$this->view->basePath = $this->_request->getBasePath();
		//用户认证与权限
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/resources.php');
        require_once(__SITEROOT.'library/Models/role_resource.php');//角色对应的资源权限
        require_once(__SITEROOT.'library/Models/role_table.php');//角色表
		require_once(__SITEROOT."application/admin/models/delRoleResource.php");//删除权限表
        require_once __SITEROOT . '/library/custom/php_fast_cache.php';
        phpFastCache::$storage = "auto";


	}
	public function indexAction(){





	}
	/**
	 * 列表内容
	 *
	 */
	public  function listAction(){


		$resource_table=new Tresources();
		$resource_table->orderby('resource_en_name ASC');
		$resource_table->find();
		$row=array();//存储资源色表的数据
		//$resource_table->debugLevel(2);
		$i=0;
		$modeule_array=array();//模块
		while ($resource_table->fetch()){
			$row[$i]['resource_id']		= $resource_table->resource_id;
			$resource_en_name			= $resource_table->resource_en_name;
			if(preg_match("~[a-z]+[a-z0-9]*~i",$resource_en_name,$matches)==1){
				if(!in_array($matches[0],$modeule_array)){
					$modeule_array[]=$matches[0];
				}
			
			}		
			$row[$i]['resource_en_name']= $resource_en_name;
			$row[$i]['resource_zh_name']= $resource_table->resource_zh_name;
			$i++;
		}

		$this->view->row=$row;
		$this->view->module_array=$modeule_array;
		
		$this->view->display("resource_list.html");


	}
	/**
	 * 显示
	 *
	 */
	public function displayAction(){

		$resource_table=new Tresources();
		$resource_table->orderby('resource_en_name ASC');
		$resource_table->find();
		$row=array();//存储中资源表中数据
		//print_r($resource_table);
		$i=0;
        $modeule_array=array();//模块
		while ($resource_table->fetch()){
			$row[$i]['resource_id']		= $resource_table->resource_id;
			$resource_en_name			=$resource_table->resource_en_name;
			if(preg_match("~[a-z]+[a-z0-9]*~i",$resource_en_name,$matches)==1){
				if(!in_array($matches[0],$modeule_array)){
					$modeule_array[]=$matches[0];
				}
			
			}		
			$row[$i]['resource_en_name']= $resource_en_name;
			$row[$i]['resource_zh_name']= $resource_table->resource_zh_name;
			$i++;
		}
		//print_r($modeule_array);
        $this->view->module_array=$modeule_array;
		$this->view->row=$row;
		$this->view->display("resource_display.html");
	}
	/**
	 * 添加/修改
	 *
	 */
	public function updateAction(){

		$resource_id=$this->_request->getParam('resource_id');//资源Id
		$resource_en_name=$this->_request->getParam('resource_en_name');//资源Id
		$resource_zh_name=$this->_request->getParam('resource_zh_name');//资源Id
		//验证英文名
		if(preg_match("~^[a-z0-9_\-]{2,60}$~i",$resource_en_name)===FALSE){
			echo "|false|资源英文名由字母，数字，下划线，减号构成！";
			exit();
		}


		$resource_table=new Tresources();

		$resource_table->resource_en_name=$resource_en_name;
		$resource_table->resource_zh_name=$resource_zh_name;
		//$resource_table->debugLevel(5);
		if(strlen($resource_id)>12){
			//更新操作
			$resource_table->whereAdd("resource_id='$resource_id'");
			if($resource_table->update()){
				echo "|true|记录更新成功！";
				$this->delete_resource_cache_file();//删除资源缓存文件
			}else {
				echo "|false|记录更新失败！";
			}
		}else{
			
			//检查重复资源名
			$resource_chk=new Tresources();
			$resource_chk->whereAdd("resource_en_name='$resource_en_name'");
			if($resource_chk->count()>0){
				echo "|false|资源名重复！";
				exit();
			}
			//插入记录
			$resource_table->resource_id=uniqid(true);

			if($resource_table->insert()){

				echo "|true|记录插入成功！";
				$this->delete_resource_cache_file();//删除资源缓存文件
			}else {

				echo "|false|记录插入失败！".$resource_table->oracle_error();
			}
		}
		



	}
	/**
	 * 删除操作
	 *
	 */
	public function deleteAction(){
		$resource_id=$this->_request->getParam('resource_id');//资源Id
		$selectFlag_array = $this->_request->getParam('selectFlag'); //资源array
		if(is_array($selectFlag_array)){
			$token=0;//删除成功标记
		    foreach ($selectFlag_array as $res_id){
		    	$resource_table = new Tresources();
				$resource_table->whereAdd("resource_id='$res_id'");
				//$resource_table->debug(2);
				if ($resource_table->delete()) {
					//echo $resource_table->oracle_error();
					delRoleResource("resource_id","$res_id");//删除权限表中resource_id =$resource_id
					echo "|true|删除成功！";
					$this->delete_resource_cache_file();//删除资源缓存文件
					$token++;
					//echo "|true|删除成功！";

				} 
				
				
		    }
		    if($token>0){
					echo "|true|删除{$token}条！";
			}else{
					echo "|false|删除失败！";
			}
		}
		
		if(is_string($resource_id) && strlen($resource_id) > 12){
			$resource_table=new Tresources();
			$resource_table->whereAdd("resource_id='$resource_id'");
			if($resource_table->delete()){
				//echo $resource_table->oracle_error();
				delRoleResource("resource_id","$resource_id");//删除权限表中resource_id =$resource_id
				echo "|true|删除成功！";
				$this->delete_resource_cache_file();//删除资源缓存文件
			}else{
				echo "|false|删除失败！";
			}
		}else{
			echo "|false|参数不正确！";
		}
	}
	//重新生成缓存文件
	private function delete_resource_cache_file()
    {
		//更新资源缓存
		$resource_table=new Tresources();
		$resource_table->selectAdd("resources.resource_id AS resource_id");
		$resource_table->selectAdd("resources.resource_en_name AS   resource_en_name");
		$resource_table->find();
        $tmp_resource=array();
		while ($resource_table->fetch())
        {
		  $tmp_resource[$resource_table->resource_id]=$resource_table->resource_en_name;
		}
        $resource_table->free_statement();
        phpFastCache::set("role_resource",$tmp_resource,3600*24);
        //更新授权缓存
        $role_resource=new Trole_resource();
		$resource_table=new Tresources();
		$role_table=new Trole_table();
		$resource_table->selectAdd("resources.resource_id");
		$resource_table->selectAdd("resources.resource_en_name");
		$role_table->selectAdd("role_table.role_en_name");
		$role_table->selectAdd("role_table.role_id");
		$role_resource->selectAdd("role_resource.read");
		$role_resource->selectAdd("role_resource.write");
		$role_resource->joinAdd('inner',$role_resource,$resource_table,'resource_id','resource_id');
		$role_resource->joinAdd('inner',$role_resource,$role_table,'role_id','role_id');
		//$role_resource->debugLevel(9);
		$role_resource->find();
		$acl_array=array();
		$i=0;
		while ($role_resource->fetch())
        {
			$acl_array[$i]['role_en_name']=$role_table->role_en_name;//角色英文名
			$acl_array[$i]['resource_en_name']=$resource_table->resource_en_name;//资源名
			$acl_array[$i]['read']=$role_resource->read;//读
			$acl_array[$i]['write']=$role_resource->write;//写
			$i++;
		}
        $role_resource->free_statement();
		phpFastCache::set("acl_cache",$acl_array,3600*24);
        //更新角色缓存
        $role_table=new Trole_table();
		$role_table->selectAdd("role_en_name");
		$role_table->selectAdd("role_id");
		$role_table->find();
        $role_arr=array();
		while ($role_table->fetch())
        {
			$role_arr[$role_table->role_id]=$role_table->role_en_name;
		}
        $role_table->free_statement();
		phpFastCache::set("role_cache",$role_arr,3600*24);
	}
}