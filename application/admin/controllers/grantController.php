<?php
/**
 * 角色授权
 *
 */

class admin_grantController extends controller {
	
	public function init()
	{
		$this->view->basePath = $this->_request->getBasePath();
		
		//用户认证与权限
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT."application/admin/models/getRoles.php");//取得角色
		require_once(__SITEROOT."application/admin/models/getResources.php");//取得资源
		require_once(__SITEROOT.'library/Models/role_resource.php');//角色对应的资源
		require_once(__SITEROOT.'library/Models/resources.php');
        require_once(__SITEROOT.'library/Models/role_table.php');//角色表
        require_once __SITEROOT . '/library/custom/php_fast_cache.php';
        phpFastCache::$storage = "auto";
		
	}
	/**
	 * 授权主界面
	 *
	 */
	public function indexAction(){
		
		$role_arr=getRoles();//取得所有角色
		
		$this->view->roles_arr=$role_arr;
		
		$this->view->display('grant_display.html');
	}
	/**
	 * 列出所有资源
	 *
	 */
	public  function resourceAction(){
		$role_id=$this->_request->getParam('role_id');//角色Id
		if(empty($role_id)){
			exit("参数错误");
		}
		//角色与资源关系表
		$role_resource=new Trole_resource();
		//资源表
		$resources=new Tresources();		
		$role_resource->joinAdd('inner',$role_resource,$resources,'resource_id','resource_id');		
		$role_resource->whereAdd("role_resource.role_id='{$role_id}'");
		$role_resource->orderby("resources.resource_en_name ASC");
		//$role_resource->debugLevel(9);
		$role_resource->find();
		$row=array();//
		$i=0;		
		$modeule_array=array();//模块
		while ($role_resource->fetch()){
			$row[$i]['uuid']		    = $role_resource->uuid;
			$row[$i]['role_id']		    = $role_resource->role_id;
			$row[$i]['resource_id']	    = $role_resource->resource_id;
			$row[$i]['read']		    = $role_resource->read;
			//echo $role_resource->read."<br />";
			$row[$i]['write']		    = $role_resource->write;	
			//echo "<br/>";
			//echo $role_resource->write."<br/>";
			$row[$i]['resource_en_name']= $resources->resource_en_name;				
			$row[$i]['resource_zh_name']= $resources->resource_zh_name;		
			$i++;		
		}
		//print_r($row);
		
		$resource_arr=getResources();//取得所有资源
        //重新定义模块名，row数组中无法出现新增加的模块名称 我好笨 2013-06-17
        foreach($resource_arr as $k=>$v)
        {
            if(preg_match("~[a-z]+[a-z0-9]*~i",$v['resource_en_name'],$matches)==1){
				if(!in_array($matches[0],$modeule_array)){
					$modeule_array[]=$matches[0];
				}
			
			}
        }
		//print_r($resource_arr);
		$this->view->module_array=$modeule_array;//模块
		//currentRoleResource －－getResources.php中函数以资源为基本数组，当role_resource表中存在着对应的资源id，取出role_resource中的权限．
		$resource_arr=currentRoleResource($resource_arr,$row);
		//print_r($resource_arr);
		$this->view->resource_arr=$resource_arr;
		$this->view->display('grant_list.html');
		
	}

	/**
	 * 添加/更新
	 *　查询选中角色的所有资源．如果这种选中角色的资源存在执行修改，否则添加　权限
	 */
	public function updateAction(){
		
		//
		//var_dump($_POST);
		//print_r($_POST['resource_id']);
		//exit();
		$role_id=$this->_request->getParam('role_id');//角色Id
		$resource_id_array=$this->_request->getParam('resource_id');//资源array
		if(empty($role_id)){
			exit("参数错误");
		}
		//print_r($resource_id_array);
		$result_toke=0;//权限更新标志
		//取出对选中角色所有资源
		foreach ($resource_id_array as $resource_id){
			$role_resource_searach=new Trole_resource();
			$role_resource_searach->whereAdd("resource_id='{$resource_id}'");//资源iD
			$role_resource_searach->whereAdd("role_id='{$role_id}'");//角色id
			$count=$role_resource_searach->count("*");//统计
			
			
			//选中角色是否存在资源
			if($count>0){
				//更新
				$role_resource=new Trole_resource();	
				//$role_resource->debugLevel(3);				
				$role_resource->whereAdd("resource_id='{$resource_id}'");//条件　资源
				$role_resource->whereAdd("role_id='{$role_id}'");//条件　角色				
				$role_resource->read=$this->_request->getParam($resource_id.'read');//更新读权限
				//echo $this->_request->getParam($resource_id.'read');
				$role_resource->write=$this->_request->getParam($resource_id.'write');//更新写权限
				if($role_resource->update()){
					$result_toke=1;
				}else{
					$result_toke=0;
				}
			}else{
				//插入
				$role_resource=new Trole_resource();	
				//$role_resource->debugLevel(3);
				$role_resource->uuid=uniqid(true);
				$role_resource->role_id=$role_id;
				$role_resource->resource_id=$resource_id;
				$role_resource->read=$this->_request->getParam($resource_id.'read');
				$role_resource->write=$this->_request->getParam($resource_id.'write');
				if($role_resource->insert()){
					$result_toke=1;
				}else{
					$result_toke=0;
				}
				//echo "111";
			}
			
		}
		//返回结果
		if($result_toke==1){
			echo "权限更新成功！";
			$this->delete_acl_cache_file();//删除授权规则缓存文件
		}else{
			echo "权限更新失败！";
		}
		
		
		
	}
    //更新授权规则缓存
	private function delete_acl_cache_file()
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