<?php
		
		require_once(__SITEROOT.'library/MyAuth.php');
		$this->auth = Zend_Auth::getInstance();

		if ($this->auth->hasIdentity()) {
			$this->user = $this->auth->getIdentity();
			//print_r($this->user);
		}else{
			//退出
			$this->redirect(__BASEPATH."loging/index/index");		
		}		
		
		require_once(__SITEROOT.'library/MyAcl.php');
		//$s=microtime(true);		
		//$this->acl=MyAcl::getInstance()->getAcl() ;
		//print_r($this->acl);
		//$e=microtime(true);
		//echo $e-$s."<br>";
		//$s=microtime(true);
		//$roles_arr = MyAcl::getInstance()->getRole();//所有注册的角色
		//$e=microtime(true);
		//echo $e-$s."<br>";
		//$s=microtime(true);
		//$resources_arr=MyAcl::getInstance()->getResource() ;//所有注册的资源
		//$e=microtime(true);
		//echo $e-$s."<br>";
		
		$resource=$this->getModuleName().'_'.$this->getControllerName();//模块名_控制器名 做为资源			
		
		$role_arr=$this->user;//登录用户信息
		$role_en_name=$role_arr['role_en_name'];//取得角色名
		
		//验证资源是否注册
		//if(!in_array($resource,$resources_arr)){			
		    //throw new Exception("资源 $resource 没有注册！");
		 //   exit("资源 $resource 没有注册！");
		//}
		//验证角色是否注册
		//if(!in_array($role_en_name,$roles_arr)){			
		    //throw new Exception("角色 $role_en_name 没有注册！");
		  //  exit("角色 $role_en_name 没有注册！");
		//}
		$this->acl=MyAcl::getInstance()->getAcl($role_en_name,$resource) ;
		//echo $role_en_name.'|'.$resource;
		if($this->acl->isAllowed($role_en_name,$resource,'w')){
			$this->haveWritePrivilege=true;
		}else{
			
			if(isset($this->haveWritePrivilege)){
				$this->haveWritePrivilege=false;
			}else{
			     require_once __SITEROOT . '/library/custom/comm_function.php';
				 message("对不起，您没有当前功能的操作权限，可能的错误是：您有当前模块其他功能操作权限，而没有当前操作功能的权限，请联系管理员授权。<br /><br />", array());
			}
			
		}
		//为个别系统中单独进行权限处理时用
		$this->role_en_name=$role_en_name;
		//$this->resource=$resource;
		