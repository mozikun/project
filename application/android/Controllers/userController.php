<?php
/*
 *用户操作管理
 */
class android_userController extends controller
{
    public function init()
    {
        require_once(__SITEROOT.'library/Models/staff_core.php');//用户核心表
		require_once(__SITEROOT.'library/Models/staff_archive.php');//用户扩展表
		require_once(__SITEROOT.'library/Models/department.php');//用户扩展表
		require_once(__SITEROOT.'library/Models/organization.php');//用户扩展表
		require_once(__SITEROOT.'library/Models/individual_core.php');//用户扩展表
		require_once(__SITEROOT.'library/Models/chat.php');//用户扩展表
		require_once(__SITEROOT.'library/MyAuth.php');
		$this->auth=Zend_Auth::getInstance();		
		$this->view->basePath = $this->_request->getBasePath();
    }
	
	//用户登陆页面
	public function loginAction(){
	    
		$organization=new Torganization();
		$organization->orderby("id");
		$organization->find();
		$result=array();
		$index=0;
		while($organization->fetch()){
			$result[$index]['org_name']=$organization->zh_name;
			$result[$index]['org_id']=$organization->id;
			$index++;
		}
		$this->view->title="用户登录";
		$this->view->org=$result;
		$this->view->display("login.html");
	}
	
	//用户登录认证
	public function logindbAction(){
		$device=new Zend_Session_Namespace("device");
		$device_id=$device->device_id;
		//首先清除 chat session
		$schat=new Zend_Session_Namespace("schat");
		$schat->identity_number=null;
		$schat->doctor_id=null;
		$shenfen=$this->_request->getParam("shenfen");
		//居民信息验证
		if($shenfen==1){
			if(empty($device_id)){
			echo "2|设备号获取失败!请关闭程序并重新启动";exit();
			}
			$identity_number=$this->_request->getParam("identity_number");
			$individual_core=new Tindividual_core();
			$individual_core->whereAdd("identity_number='$identity_number'");
			if($individual_core->count()>0){
				$individual_core->find(true);
				//该身份证还没有绑定手机，则进行绑定
				if(empty($individual_core->device_id)){
					$core=new Tindividual_core();
					$core->whereAdd("identity_number='$identity_number'");
					$core->update();
				}
				//身份证已被其它手机给绑定了
				if(!empty($individual_core->device_id)&&($individual_core->device_id!=$device_id)){
					echo "2|该身份证号已与其它手机绑定";exit();
				}
				/*设置session*/
				//mobile主要用于个人信息的session
				$mobile=new Zend_Session_Namespace("mobile");
				$mobile->identity_number=$identity_number;
				$mobile->device_id=$device_id;
				$mobile->card=$identity_number;
				//schat主要用于聊天时的session认证
				$schat=new Zend_Session_Namespace("schat");
				$schat->identity_number=$identity_number;
				
				echo "1|登陆成功";
			}
			else 
			{
				echo "2|未找到该居民!";
				
			}
		}		
		//医生信息验证
		if($shenfen==2){
			$user=$this->_request->getParam("user");
			$password=md5($this->_request->getParam("password"));
			$staff_core=new Tstaff_core();
			$staff_core->whereAdd("id='$user'");
			$staff_core->whereAdd("passwd='$password'");
			if($staff_core->count()>0){
				$staff_core->find(true);
				$schat=new Zend_Session_Namespace("schat");
				$schat->doctor_id=$staff_core->id;
				echo "3|登陆成功";
			}
			else{
				echo "2|用户名或密码错误!";
			}
		}
	}
	
	//居民个人主页
	public function residentAction(){
		$mobile=new Zend_Session_Namespace("mobile");
		$schat=new Zend_Session_Namespace("schat");
		//print_r($_SESSION);
		//判断是否已经登陆
		//print_r($_SESSION);exit();
		if(empty($mobile->identity_number)||empty($schat->identity_number)){
			$this->redirect(__BASEPATH."android/user/login");
		}
		$this->view->login=0;
		$this->view->identity_number=empty($mobile->identity_number)?$mobile->card:$mobile->identity_number;
		if(!empty($mobile->device_id)&&(!empty($mobile->identity_number))){
		$this->view->login=1;
		}
		$this->view->display("resident.html");
	}
	
		//医生个人主页
	public function doctorhomeAction(){
		$schat=new Zend_Session_Namespace("schat");
		$doctor_id=$schat->doctor_id;
		$identity_number=$schat->identity_number;
		if($doctor_id){
		$this->view->login=1;
		$chat=new Tchat();
		$individual_core=new Tindividual_core();
	    $individual_core->selectAdd("individual_core.name");
		$chat->whereAdd("chat.receiver='$doctor_id'");
		$chat->whereAdd("chat.content is not null");
		$individual_core->joinAdd("inner",$individual_core,$chat,"identity_number","sender");
		
		$individual_core->find(); 
		$result=array();
		$index=0;
		while($individual_core->fetch()){ 
			$result[$index]['name']=$individual_core->name;
			$result[$index]['cotent']=$chat->content;
			$result[$index]['sendtime']=$chat->sendtime;
			$result[$index]['identity_number']=$chat->sender;
			$index++;
		}
		
		
	}
	    if($identity_number){
		$chat=new Tchat();
		$staff_core=new staff_core();
	    $staff_core->selectAdd("staff_core.name_login");
		$chat->whereAdd("chat.receiver='$identity_number'");
		$chat->whereAdd("chat.content is not null");
		$staff_core->joinAdd("inner",$staff_core,$chat,"id","sender");
		
		$staff_core->find(); 
		$result=array();
		$index=0;
		while($staff_core->fetch()){ 
			$result[$index]['name']=$staff_core->name_login;
			$result[$index]['cotent']=$chat->content;
			$result[$index]['sendtime']=$chat->sendtime;
			$result[$index]['identity_number']=$chat->sender;
			$index++;
			}
		}
		$this->view->title="最新的聊天记录";
		$this->view->rows=$result;
		$this->view->display("doctorhome.html");
	}
	
	//获取对应机构下的医生信息、登录处用
	public function getuserAction(){
		$org_id=$this->_request->getParam("org_id");
		$staff_core=new Tstaff_core();
		$staff_core->whereAdd("org_id='$org_id'");//$staff_core->debug(1);
		$staff_core->find();
		$str="<select id='user'>";
		while($staff_core->fetch()){
			$str.="<option value='".$staff_core->id."'>".$staff_core->name_login."</option>";
		}
		$str.="</select>";
		echo $str;
	}
	
	//退出登录
	public function loginoutAction(){
		$schat=new Zend_Session_Namespace("schat");
		$mobile=new Zend_Session_Namespace("mobile");
		$schat->identity_number=null;
		$schat->doctor_id=null;
		$mobile->identity_number=null;
		//$this->redirect("");
		$this->redirect(__BASEPATH."android/user/login");	
		
	}
	
	

}