<?php
/*
 *居民掌中宝首页
 */
class android_androidController extends controller
{
    public function init()
    {
        require_once(__SITEROOT.'library/Models/staff_core.php');//用户核心表
		require_once(__SITEROOT.'library/Models/staff_archive.php');//用户扩展表
		require_once(__SITEROOT.'library/Models/department.php');//用户扩展表
		require_once(__SITEROOT.'library/Myauth.php');
		$this->auth=Zend_Auth::getInstance();
		
		$this->view->basePath = $this->_request->getBasePath();
		/*
		//判断登陆状态
		$schat=new Zend_Session_Namespace("schat");
		if(!empty($schat->identity_number)||!empty($schat->doctor_id)){
			$this->view->login=1;
		}
		else{
			$this->redirect(__BASEPATH."android/chat/login");
		}
		*/
    }
	
	//居民掌中宝首页
    public function indexAction(){
	    $device_id=$this->_request->getParam("device_id");
		if($device_id){
			$device=new zend_session_namespace("device");
			$device->device_id=$device_id;
		}
		$this->view->display("index.html");
	}
	
	
	//医院首页
	public function hospitalAction(){
		$org_id=$this->_request->getParam("org_id");
		$org_name=$this->_request->getParam("org_name");
		$schat=new Zend_Session_Namespace("schat");
		
		$this->view->org_id=$org_id;
		$this->view->org_name=$org_name;
		$this->view->display("hospital.html");
	}
	
	//科室列表
	public function departmentAction(){
		$department=new Tdepartment();
		$department->find();
		$result=array();
		$index=0;
		while($department->fetch()){
			$result[$index]['department_name']=$department->department_name;
			$result[$index]['id']=$department->uuid;
			$index++;
			
		}
		$this->view->department=$result;
		$this->view->display("department.html");
	}
	
	//登出
	public function loginoutAction(){
		$schat=new Zend_Session_Namespace("schat");
		$schat->identity_number=null;
		$schat->doctor_id=null;
		//$this->redirect("");
		$this->redirect(__BASEPATH."android/chat/login");	
		
	}

}