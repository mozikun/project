<?php
require_once('Zend/Acl.php');
require_once('Zend/Acl/Resource.php');
require_once('Zend/Acl/Role.php');
require_once(__SITEROOT.'library/Models/role_resource.php');//角色对应的资源权限
require_once(__SITEROOT.'library/Models/role_table.php');//角色表
require_once(__SITEROOT.'library/Models/resources.php');//资源表
/**
 * 取得角色对应的资源的权限
 *
 */
class  MyAcl{
	private static $instance=null;

	private   $role_arr; //role

	private  $resource_arr;//resource;

	private  $role_cache_file="cache/role_cache_file.php";//角色缓存文件
	private  $resource_cache_file="cache/resource_cache_file.php";//资源缓存文件
	private  $acl_cache_file="cache/acl_cache_file.php";//角色资源对应的规则文件
	/**
	 * 初始化 
	 *
	 */
	private function __construct()
	{

		$this->acl=new Zend_Acl();
	}
	/**
	 * 单例模式
	 *
	 * @return unknown
	 */
	public  static function getInstance()
	{
		if (self::$instance==null)
		{
			$class=__CLASS__;
			self::$instance=new $class;
		}
		return self::$instance;
	}
	/**
	 * 取得数据库中role_resource表的role
	 *
	 */
	public     function getRole(){
		//不存在缓存文件，取出内容存放到文件中。
		if(!file_exists ($this->role_cache_file)){
			//$role_resource=new Trole_resource();
			$role_table=new Trole_table();
			$role_table->selectAdd("role_en_name");
			$role_table->selectAdd("role_id");
			//$role_resource->selectAdd("role_resource.role_id");
			//$role_resource->joinAdd('inner',$role_resource,$role_table,'role_id','role_id');
			$role_table->find();
			while ($role_table->fetch()) {
				$this->role_arr[$role_table->role_id]=$role_table->role_en_name;
			}
			$content=serialize($this->role_arr);
            //我好笨增加判定目录是否存在，如果不存在则自动创建
            $dir=dirname(__SITEROOT.$this->role_cache_file);
            if(!is_dir($dir))
            {
                mkdir($dir,0777,true);
            }
			$fp=fopen(__SITEROOT.$this->role_cache_file,"w");
			if (fwrite($fp, $content) === FALSE) {
				throw new Exception(__FILE__.__FUNCTION__."文件写入失败！");
			}
			fclose($fp);
		}else{
			$role_str=file_get_contents($this->role_cache_file);
			$this->role_arr=unserialize($role_str);
		}
		return $this->role_arr;

	}
	/**
	 * 把数据库中的role_resource表所有角色添加到role
	 *
	 */
	private  function setRole(){
		foreach ($this->role_arr as $role_id=>$role_en_name){
			$this->acl->addRole(new Zend_Acl_Role($role_en_name));
		}

	}
	/**
	 * 取得role_resource表中的的所有资源
	 *
	 */
	public    function getResource(){
		if(!file_exists ($this->resource_cache_file)){

			$resource_table=new Tresources();
			$resource_table->selectAdd("resources.resource_id AS resource_id");
			$resource_table->selectAdd("resources.resource_en_name AS   resource_en_name");
			
			//$role_resource->debugLevel(9);
			$resource_table->find();
			while ($resource_table->fetch()) {
				$this->resource_arr[$resource_table->resource_id]=$resource_table->resource_en_name;
			}


			$content=serialize($this->resource_arr);

			$fp=fopen(__SITEROOT.$this->resource_cache_file,"w");
			if (fwrite($fp, $content) === FALSE) {
				throw new Exception(__FILE__.__FUNCTION__."文件写入失败！");
			}
			fclose($fp);

			//$$this->resource_arr;

		}else{
			$resource_str=file_get_contents($this->resource_cache_file);
			$this->resource_arr=unserialize($resource_str);
		}
		return $this->resource_arr;

	}
	/**
	 * 把数据库中的role_resource表的resource添加到resource
	 *
	 */
	private  function setResource(){
		foreach ($this->resource_arr as $resource_id=>$resource_en_name){
			$this->acl->add(new Zend_Acl_Resource($resource_en_name));
		}

	}
	/**
	 * 根据role和resource设置权限
	 *
	 */
	private     function  setAcl(){
		if(!file_exists ($this->acl_cache_file)){
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
			while ($role_resource->fetch()) {
				//$this->acl->add(new Zend_Acl_Resource($resource_table->resource_en_name));//
				//$this->acl->addRole(new Zend_Acl_Role($role_table->role_en_name));

				//if($role_resource->read==1){
				//	$this->acl->allow($role_table->role_en_name,$resource_table->resource_en_name,'r');
				//}
				//if($role_resource->write==1){

				//	$this->acl->allow($role_table->role_en_name,$resource_table->resource_en_name,'w');
				//}
				$acl_array[$i]['role_en_name']=$role_table->role_en_name;//角色英文名
				$acl_array[$i]['resource_en_name']=$resource_table->resource_en_name;//资源名
				$acl_array[$i]['read']=$role_resource->read;//读
				$acl_array[$i]['write']=$role_resource->write;//写
				$i++;
			}
			$content=serialize($acl_array);

			$fp=fopen(__SITEROOT.$this->acl_cache_file,"w");
			if (fwrite($fp, $content) === FALSE) {
				throw new Exception(__FILE__.__FUNCTION__."文件写入失败！");
			}
			fclose($fp);



		}else{
			$acl_str=file_get_contents($this->acl_cache_file);
			$acl_array=unserialize($acl_str);
		}
		foreach ($acl_array as $key=>$acl_arr){
			//允许读
			if($acl_arr['read']==1){
				$this->acl->allow($acl_arr['role_en_name'],$acl_arr['resource_en_name'],'r');
			}
			//允许写
			if($acl_arr['write']==1){
				$this->acl->allow($acl_arr['role_en_name'],$acl_arr['resource_en_name'],'w');
			}
		}

		return $this;
	}
	/**
	 * 取得Acl
	 * @param  $role_en_name 
	 * @param  $resource_en_name
	 * @return $this->acl;
	 *
	 * */
	public   function getAcl($role_en_name='',$resource_en_name=''){
		//$s=microtime(true);
		$this->getRole();//role_resource表中的角色
		//$e=microtime(true);
		//echo $e-$s."<br>";
		if(!in_array($role_en_name,$this->role_arr) && $role_en_name!=''){
			//throw new Exception("资源 $resource 没有注册！");
			exit("角色 $role_en_name 没有注册！");
		}
		//$s=microtime(true);
		$this->getResource();//role_resource表中的resource
		
		//$e=microtime(true);
		//echo $e-$s."<br>";
		if(!in_array($resource_en_name,$this->resource_arr) && $resource_en_name!=''){
			//throw new Exception("资源 $resource 没有注册！");
            $resource_table=new Tresources();
            $resource_table->whereAdd("resource_en_name='".$resource_en_name."'");
            if(!$resource_table->count())
            {
                //我好笨 2013-08-22增加自动写入资源
                $resource_table=new Tresources();
                $resource_table->resource_id=uniqid(true);
                $resource_table->resource_en_name=$resource_en_name;
                $resource_table->resource_zh_name=$resource_en_name;
                if($resource_table->insert())
                {
                    $file=__SITEROOT.'cache/resource_cache_file.php';
            		if(file_exists($file))
                    {
            			unlink($file);
            			$acl_file=__SITEROOT.'cache/acl_cache_file.php';//授权文件缓存
            			if(file_exists($acl_file))
                        {
            				unlink($acl_file);	
            			}
            		}
                }
            }
			exit("资源 $resource_en_name 已自动注册，请联系管理员给角色授权！");
		}
		//print_r($this->resource_arr);
		//var_dump($resource_en_name);
		//print_r($this->getResource());
		//print_r($this->role_arr);
		//$s=microtime(true);
		$this->setRole();//设置 role
		//$e=microtime(true);
		//echo $e-$s."<br>";
		//print_r($this->resource_arr);
		//$s=microtime(true);
		$this->setResource();//设置resource
		//$e=microtime(true);
		//echo $e-$s."<br>";
		//$s=microtime(true);
		$this->setAcl();//设置权限
		//print_r($this->setAcl());
		//$e=microtime(true);
		//echo $e-$s."HH<br>";
		return $this->acl;

	}





}
