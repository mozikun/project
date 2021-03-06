<?php
/**
 * web_registerController
 * 
 * 预约挂号
 * 
 * @package yaan
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class web_registerController extends controller
{
    public function init()
    {
        require_once __SITEROOT."library/Models/organization.php";
        require_once __SITEROOT."library/Models/appointment_register.php";
        require_once __SITEROOT."library/Models/department_doctor.php";
        require_once __SITEROOT."library/Models/staff_core.php";
        require_once __SITEROOT."library/Models/web_sort.php";
        require_once __SITEROOT."library/Models/web_article_base.php";
        require_once __SITEROOT."library/Models/web_article_content.php";
        require_once __SITEROOT."library/Models/department.php";
        require_once __SITEROOT."library/custom/comm_function.php";
        $this->view->basePath = $this->_request->getBasePath();
        //取公共顶部内容
        //取首页栏目
        $web_sort=new Tweb_sort();
        $web_sort->whereAdd("parent_uuid='0'");
        $web_sort->limit(0,20);
        $web_sort->find();
        $i=0;
        $sorts=array();
        while($web_sort->fetch())
        {
            $sorts[$i]['uuid']=$web_sort->uuid;
            $sorts[$i]['py']=$web_sort->sortname_py;
            $sorts[$i]['name']=$web_sort->sortname;
            $i++;
        }
        $this->view->sorts=$sorts;
        $arr=array("天","一","二","三","四","五","六");
        $this->view->timer=date("Y年m月d日 ").' 星期'.$arr[date('w')];
        //取公共底部内容
        //取医院
        $org=new Torganization();
        $org->whereAdd("type=5");
        $org->limit(0,4);
        $org->find();
        $orgs=array();
        $i=0;
        while($org->fetch())
        {
            $orgs[$i]['id']=$org->id;
            $orgs[$i]['zh_name']=$org->zh_name;
            $i++;
        }
        $this->view->orgs=$orgs;
    }
    /**
     * web_registerController::indexAction()
     * 
     * 挂号首页
     * 
     * @return void
     */
    public function indexAction()
    {	
		//查找医院
		$organization=new Torganization();
		/*
		$organization->orderby("id");
		//$organization->limit(0,10);
		$organization->find();
		$hospitals=array();
		$i=0;
		while($organization->fetch()){
			$hospitals[$i]['id']=$organization->id;
			$hospitals[$i]['name']=$organization->zh_name;
			$i++;
		}
		
		$this->view->hospitals=$hospitals;
		*/
		
		//输出日期
		$dates=array();
		for($i=1;$i<=7;$i++){
			$dates[]=date("Y-m-d",strtotime("+$i day"));
		}
		$this->view->dates=$dates;
        $this->view->display("index.html");
        
    }
	/**
     * web_registerController::departmentAction()
     * 
     * 获取科室
     * 
     * @return void
     */
	public function departmentAction(){ 
		$org_id=$this->_request->getParam("org_id");
		$department=new Tdepartment();
		//$department->debug(1);
		$department->whereAdd("org_id='$org_id'");
		$department->find();
		$dep=array();
		$i=0;
		while($department->fetch()){
			$dep[$i]['uuid']=$department->uuid;
			$dep[$i]['department_name']=$department->department_name;
			$i++;
		}
		echo (json_encode($dep));
		
	}
	/**
     * web_registerController::departmentAction()
     * 
     * 获取所有医生
     * 
     * @return void
     */
	public function getalldoctorsAction(){
		require_once __SITEROOT."library/Models/zuozhen.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		
		$org_id=$this->_request->getParam("org_id");
		$staff_core=new Tstaff_core();
		$staff_core->whereAdd("org_id='$org_id'");
		$staff_core->whereAdd("role_id='14c29a32c28c09'");
		//$department_doctor->debug(1);
		$staff_core->find();
		$result=array();
		$i=0;
		while($staff_core->fetch()){
			$result[$i]['id']=$staff_core->id;
			$result[$i]['name']=$staff_core->name_login;
			$i++;
		}
		echo json_encode($result);
		
	}
	/**
     * web_registerController::zuozhenAction()
     * 
     * 获取医生的坐诊表 
     * 
     * @return void
     */	
	public function zuozhenAction(){
		require_once __SITEROOT."library/Models/zuozhen.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		//构造7天
		$days=array();
		$weekarray=array("日","一","二","三","四","五","六");
		for($i=1;$i<=7;$i++){
			$days[$i]['date']=date("Y-m-d",strtotime("+$i day"));
			$days[$i]['week']="星期".$weekarray[date("w",strtotime("+$i day"))];
		}
		$this->view->days=$days;
		
		$doctor_id=$this->_request->getParam("doctor_id");
		
		//获取医生名字
		$staff=new Tstaff_core();
		$staff->whereAdd("id='$doctor_id'");
		$staff->find(true);
		$this->view->staff=$staff;
		$staff_core=new Tstaff_core();
		$zuozhen=new Tzuozhen();
		//$zuozhen->whereAdd("zuozhen.org_id='$org_id'");
		//今天
		$tomorrow=time();
		//七天后
		$sevenday=strtotime("+8 day");
		$zuozhen->whereAdd("consulting_time>='$tomorrow' and consulting_time<'$sevenday'");
		$zuozhen->joinAdd("inner",$zuozhen,$staff_core,"user_id","id");
		$zuozhen->whereAdd("zuozhen.user_id='$doctor_id'");
		$zuozhen->find();
		$data=array();
		$i=0;
		while($zuozhen->fetch()){
			$data[$i]['zuozhen']=$zuozhen->toArray();
			$data[$i]['doctor_name']=$staff_core->name_login;
			$i++;
		}
		$result=array();
		//构造坐诊表
		for($i=1;$i<=7;$i++){
			$result[$i]['date']=date("Y-m-d",strtotime("$i day"));
			foreach($data as $v){
				//日期相等
				if(date("Y-m-d",$v['zuozhen']['consulting_time'])==date("Y-m-d",strtotime("+$i day"))){ 
					//启用]
					if($v['zuozhen']['flag']==2){
						$result[$i]['id']=$v['zuozhen']['uuid'];
						//上午
						if($v['zuozhen']['day']==1||$v['zuozhen']['day']==3){
							$result[$i]['shangwu']=1;
							//print_r($result);
						}
						//下午
						if($v['zuozhen']['day']==2||$v['zuozhen']['day']==3){
							$result[$i]['xiawu']=1;
						}
					}
					
				}
				}
			}
		
		$this->view->result=$result;
		$this->view->display("zuozhen.html");
		
	} 
	/**
     * web_registerController::registerAction()
     * 
     * 挂号 
     * 
     * @return void
     */	
    public function registerAction(){
		/*
		//检查登陆
	    $search_session=new Zend_Session_Namespace("iha_search");
		if(empty($search_session->id)){
			echo "您还没有登陆!";
			exit();
		}
		*/
		
		require_once(__SITEROOT.'library/sms.php');//发短信库
		$sms=new SMS();
		$id=$this->_request->getParam("id");
		$day=$this->_request->getParam("day");
		$name=$this->_request->getParam("name");
		$identity_number=$this->_request->getParam("identity_number");
		$phone_number=$this->_request->getParam("phone_number");
	    
		require_once __SITEROOT."library/Models/zuozhen.php";
		require_once __SITEROOT."library/Models/appointment_register.php";
		
		//检查重复预约
		$appointment=new Tappointment_register();
		$appointment->whereAdd("zuozhen_id='$id' and identity_number='$identity_number'");
		//$appointment->debug(1);
		if($appointment->count()>0){
			echo "您已经预约过该号了，请勿重复预约！";
			exit();
		}
		$appointment_register=new Tappointment_register();
		$zuozhen=new Tzuozhen();
		$zuozhen->whereAdd("uuid='$id'");
		$zuozhen->find(true);
		$appointment_register->uuid=uniqid();
		$appointment_register->doctor_id=$zuozhen->user_id;
		$appointment_register->created=time();
		$appointment_register->name=$name;
		$appointment_register->identity_number=$identity_number;
		//$appointment_register->gender=$search_session->sex;
		//$appointment_register->age=$search_session->age;
		$appointment_register->register_date=$zuozhen->consulting_time;
		$appointment_register->register_time=$day;
		$appointment_register->org_id=$zuozhen->org_id;
		$appointment_register->department_id=$zuozhen->department;
		$appointment_register->clinic_id=$zuozhen->cliinic;
		$appointment_register->number_species_id=$zuozhen->number_species;
		$appointment_register->status=1;
		$appointment_register->updated=time();
		$appointment_register->phone_number=$phone_number;
		$appointment_register->zuozhen_id=$id;
		if($appointment_register->insert()){
			//发送短息
			$organization=new Torganization();
			$organization->whereAdd("id='$zuozhen->org_id'");
			$organization->find(true);
			$department=new Tdepartment();
			$department->whereAdd("uuid='$zuozhen->department'");
			$department->find(true);
			$message_id=uniqid();
			$sms_content="您已经成功预约".$organization->zh_name.$department->department_name."，就诊时间为".date("Y年m月d日",$zuozhen->consulting_time).",请准时到医院就诊!";
			$sms->sendSMS($message_id,$phone_number,$sms_content,time());//发送短信
			echo "恭喜您，预约成功!";
			
		}else{
			echo "预约失败";
		}
	}
   /**
     * web_registerController::gethospitalAction()
     * 
     * 查询机构
     * 
     * @return void
     */
	public function gethospitalAction(){
		$organization=new Torganization();
		$organization->orderby("id");
		$organization->whereAdd("type>2");
		$organization->find();
		$result=array();
		$i=0;
		while($organization->fetch()){
			$result[$i]['id']=$organization->id;
			$result[$i]['name']=$organization->zh_name;
			$i++;
		}
		echo json_encode($result);
	}
	 /**
     * web_registerController::getdepartmentAction()
     * 
     * 根据医院查询科室
     * 
     * @return void
     */
	public function getdepartmentAction(){
		$hospital_id=$this->_request->getParam("hospital_id");
		$department=new Tdepartment();
		$department->whereAdd("org_id='$hospital_id'");
		$department->find();
		$result=array();
		$i=0;
		while($department->fetch()){
			$result[$i]['id']=$department->uuid;
			$result[$i]['name']=$department->department_name;
			$i++;
		}
		echo json_encode($result);
	} 
	/**
     * web_registerController::getdoctorAction()
     * 
     * 根据科室查询医生
     * 
     * @return void
     */
	public function getdoctorAction(){
		$department_id=$this->_request->getParam("department_id");
		$department_doctor=new Tdepartment_doctor();
		$staff_core=new Tstaff_core();
		$department_doctor->joinAdd("inner",$department_doctor,$staff_core,"doctor_id","id");
		$department_doctor->whereAdd("department_id='$department_id'");
		//$department_doctor->debug(1);
		$department_doctor->find();
		$result=array();
		$i=0;
		while($department_doctor->fetch()){
			$result[$i]['id']=$staff_core->id;
			$result[$i]['name']=$staff_core->name_login;
			$i++;
		}
		echo json_encode($result);
	} 
}