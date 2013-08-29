<?php
require_once('Zend/Acl.php');
require_once('Zend/Acl/Resource.php');
require_once('Zend/Acl/Role.php');
require_once(__SITEROOT.'library/Models/role_resource.php');//角色对应的资源权限
require_once(__SITEROOT.'library/Models/role_table.php');//角色表
require_once(__SITEROOT.'library/Models/resources.php');//资源表
require_once(__SITEROOT.'library/custom/php_fast_cache.php');
phpFastCache::$storage = "auto";
/**
 * 取得角色对应的资源的权限
 *
 */
class  MyAcl{
	private static $instance=null;

	private   $role_arr; //role

	private  $resource_arr;//resource;
    private $acl_cach_time;//资源缓存时间
	/**
	 * 初始化 
	 *
	 */
	private function __construct()
	{
	   //初始化缓存时间
	   $this->acl_cach_time=3600*24;
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
     * 我好笨
     * 
     * 2013-08-29 修改为fastcache缓存，默认缓存24小时
     * 
	 */
	public function getRole(){
		//不存在缓存文件，取出内容存放到文件中。
        $role_cache = phpFastCache::get("role_cache");
		if($role_cache==null)
        {
			$role_table=new Trole_table();
			$role_table->selectAdd("role_en_name");
			$role_table->selectAdd("role_id");
			$role_table->find();
			while ($role_table->fetch())
            {
				$this->role_arr[$role_table->role_id]=$role_table->role_en_name;
			}
			phpFastCache::set("role_cache",$this->role_arr,$this->acl_cach_time);
		}
        else
        {
			$this->role_arr=$role_cache;
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
	 * 我好笨
     * 
     * 2013-08-29 修改为fastcache缓存，默认缓存24小时
     * 
	 */
	public function getResource()
    {
	    $role_resource = phpFastCache::get("role_resource");
		if($role_resource==null)
        {

			$resource_table=new Tresources();
			$resource_table->selectAdd("resources.resource_id AS resource_id");
			$resource_table->selectAdd("resources.resource_en_name AS   resource_en_name");
			
			//$role_resource->debugLevel(9);
			$resource_table->find();
			while ($resource_table->fetch())
            {
				$this->resource_arr[$resource_table->resource_id]=$resource_table->resource_en_name;
			}
            phpFastCache::set("role_resource",$this->resource_arr,$this->acl_cach_time);
		}
        else
        {
			$this->resource_arr=$role_resource;
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
	private function setAcl()
    {
        $acl_cache = phpFastCache::get("acl_cache");
		if($acl_cache==null)
        {
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
			phpFastCache::set("acl_cache",$acl_array,$this->acl_cach_time);
		}
        else
        {
			$acl_array=$acl_cache;
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
