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
		require_once(__SITEROOT."application/admin/models/delRoleResource.php");//删除权限表


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
	//删除资源缓存文件
	private function delete_resource_cache_file(){
		$file=__SITEROOT.'cache/resource_cache_file.php';
		if(file_exists($file)){
			
			unlink($file);
			
			$acl_file=__SITEROOT.'cache/acl_cache_file.php';//授权文件缓存
			if(file_exists($acl_file)){
				unlink($acl_file);
				
			}

		}
	}
}