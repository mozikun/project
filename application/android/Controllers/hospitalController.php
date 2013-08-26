<?php
/*
 *医院相关信息
 */
class android_hospitalController extends controller
{
    public function init()
    {
        require_once(__SITEROOT.'library/Models/staff_core.php');
		require_once(__SITEROOT.'library/Models/staff_archive.php');
		require_once(__SITEROOT.'library/Models/department.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/individual_core.php');
		require_once(__SITEROOT.'library/Myauth.php');
		$this->auth=Zend_Auth::getInstance();		
		$this->view->basePath = $this->_request->getBasePath();
    }
	
	//医院列表
	public function listAction(){
		$organization=new Torganization();
		$organization->whereAdd("type=5");
		$organization->orderby("id");
		$organization->find();
		$result=array();
		$index=0;
		while($organization->fetch()){
			$result[$index]['id']=$organization->id;
			$result[$index]['zh_name']=$organization->zh_name;
			$index++;
		}
		//print_r($result);
		$this->view->title="找医院";
		$this->view->result=$result;
		$this->view->display("list.html");
	}
	//医院首页
	public function hospitalAction(){
		$org_id=$this->_request->getParam("org_id");
		$org_name=$this->_request->getParam("org_name");
		$schat=new Zend_Session_Namespace("schat");
		
		$this->view->org_id=$org_id;
		$this->view->title=$org_name;
		$this->view->display("hospital.html");
	}
	
		//医生列表
	public function doctorAction(){
		$org_id=$this->_request->getparam("org_id");
		$staff_core=new Tstaff_core();
		$staff_core->whereAdd("org_id='$org_id'");
		$staff_core->find();
		$result=array();
		$index=0;
		while($staff_core->fetch()){
			$result[$index]['id']=$staff_core->id;
			$result[$index]['name']=$staff_core->name_login;
			$index++;
		}
		$this->view->title="医院专家";
		$this->view->rows=$result;
		$this->view->display("doctor.html");
		
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
		$this->view->title="医院科室";
		$this->view->department=$result;
		$this->view->display("department.html");
	}
	
	
	

}