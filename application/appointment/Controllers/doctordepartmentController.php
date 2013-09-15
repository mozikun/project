<?php
class appointment_doctordepartmentController extends controller{

	public function init(){
		 require_once(__SITEROOT . 'library/Models/department_doctor.php'); //
		 require_once(__SITEROOT . 'library/Models/staff_core.php'); //
		 require_once(__SITEROOT . 'library/Models/department.php'); //
		 $org_id = $_SESSION['Zend_Auth']['storage']['org_id']; //机构id
		 $this->view->basePath = __BASEPATH;
	}
	public function doctorsAction(){
		 $org_id = $_SESSION['Zend_Auth']['storage']['org_id']; //机构id
		 $staff_core=new Tstaff_core();
		 $staff_core->whereAdd("role_id='14c29a32c28c09'");
		 $staff_core->whereAdd("org_id='$org_id'");
		 $staff_core->find();
		 $i=0;
		 $result=array();
		 
		 while($staff_core->fetch()){
			$result[$i]['id']=$staff_core->id;
			$result[$i]['name']=$staff_core->name_login;
			$result[$i]['standard_code']=$staff_core->standard_code;
			$i++;
		 }
		 
		 $this->view->result=$result;
		 $this->view->display("doctors.html");
	}
	//管理科室
	public function editdepartmentAction(){
		$org_id = $_SESSION['Zend_Auth']['storage']['org_id']; //机构id
		$doctor_id=$this->_request->getParam("doctor_id");
		 $staff_core=new Tstaff_core();
		 //查找医生姓名
		$staff_core->whereAdd("id='$doctor_id'");
		$staff_core->find(true);
		
		$department=new Tdepartment();
		$department->whereAdd("org_id='$org_id'");
		$department->find();
		 $i=0;
		 $result=array();
		 
		 while($department->fetch()){
			$result[$i]['id']=$department->uuid;
			$result[$i]['name']=$department->department_name;
			//判断该医生是否在该科室下面
			$department_doctor=new Tdepartment_doctor();
			$department_doctor->whereAdd("department_id='$department->uuid'");
			$department_doctor->whereAdd("doctor_id='$doctor_id'");
			//$department_doctor->debug(1);
			
			if($department_doctor->count()>0){
				$result[$i]['flag']=1;
			}else{
				$result[$i]['flag']=0;
			}
			$i++;
		 }
		$this->view->doctor=$staff_core;
		$this->view->result=$result;
		$this->view->display("edit.html");
	} 
	//保存数据
	public function saveAction(){
		$department_doctor=new Tdepartment_doctor();
		$department_id=$this->_request->getParam("department_id");
		$doctor_id=$this->_request->getParam("doctor_id");
		$todo=$this->_request->getParam("todo");
		echo $todo;
		//新增所属科室
		if($todo==1){
			$department_doctor->uuid=uniqid();
			$department_doctor->department_id=$department_id;
			$department_doctor->doctor_id=$doctor_id;
			$department_doctor->insert();
		}
		//
		//删减所属科室
		if($todo==2){
			$department_doctor->whereAdd("department_id='$department_id' and doctor_id='$doctor_id'");
			
			$department_doctor->delete();
		}
	} 
}
?>