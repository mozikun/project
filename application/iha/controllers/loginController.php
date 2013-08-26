<?php 
/*
 *@类		login
 *@功能		安卓登陆
 */
 class iha_loginController extends controller{
	public function init(){
		
		//权限验证
		//require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once(__SITEROOT.'library/Myauth.php');
		$this->auth=Zend_Auth::getInstance();
	    $this->view->basePath = $this->_request->getBasePath();
	}
	
	/*
     *@函数		index
     *@功能		登陆页面
     */
	public function indexAction(){
		//$phone_number=$this->_request->getParam("phone_number");
		//2013-8-26 修改登陆方式为省份证密码方式，取消原来的设备号绑定方式
		$device_id=$this->_request->getParam("device_id");
		//如果未获取到device_id 则初始化为1
		if(empty($device_id)) $device_id=1;
		$mobile=new Zend_Session_Namespace("mobile");
		$mobile->divice_id=$device_id;
		//print_r($_SESSION);
		//判断是否已经登陆
		$this->view->login=0;
		$this->view->identity_number=$mobile->identity_number;
		//if(!empty($mobile->device_id)&&(!empty($mobile->identity_number)||!empty($mobile->card))){
		if(!empty($mobile->identity_number)){
		$this->view->login=1;
		}
		//$this->view->device_id=$this->_request->getParam("device_id");//输出sim卡号
		//$this->view->phone_number=$phone_number;
		$this->view->display("index.html");
	} 
	//登陆页面
	public function logindisplayAction(){
	// $this->view->phone_number=$this->_request->getParam("phone_number");
	// $this->view->device_id=$this->_request->getParam("device_id");//输出sim卡号
	 $this->view->display("login.html");
	}
	/*
     *@函数		login
     *@功能		安卓登陆
     */
	public function loginAction(){ 
	
	   /*
		$device_id=$this->_request->getParam("device_id");//获取sim卡号
	    $identity_number=$this->_request->getParam("identity_number");    //身份证
		$password=$this->_request->getParam("phone_number");
		$card=$this->_request->getParam("card");    //居民健康档案号
		$bind=$this->_request->getParam("bind");    //居民健康档案号
		if(empty($device_id))
		{
			echo "6|设备号获取失败!";
			exit();
		}
		$card_id="";
		if(!empty($identity_number)) $card_id=$identity_number;
		else if(!empty($card)) $card_id=$card;
		$core=new Tindividual_core();
		$core->whereAdd("identity_number='$card_id'");//查找身份证对应的居民
		if($core->count()>0){
			$core->find(true); 
			//没有绑定手机(1,数据库中没有手机 2.如果用户选择了绑定手机则绑定该手机
			if(empty($core->device_id))
			{
				//绑定手机
				if($bind==1)
				{
					$core_bind=new Tindividual_core();
					$core_bind->whereAdd("identity_number='$card_id'");//查找身份证对应的居民
					$core_bind->device_id=$device_id;
					if($core_bind->update()){
						$mobile=new Zend_Session_Namespace("mobile");
						$mobile->identity_number=$identity_number;
						$mobile->device_id=$device_id;
						$mobile->card=$card;
						echo "3|登陆成功";
						exit();
					}
					else{
						echo "5|手机绑定失败";
					}
					
				}
				else{
					echo "1|手机未绑定！";
					exit();
				}
			}
			//帮顶了手机验证其正确性
			else
			{
				if($core->device_id !=$device_id)
				{
					echo "2|该身份证已经与其它手机绑定";
					exit();
				}
				//信息正确 成功登陆
				if($core->device_id==$device_id&&$core->identity_number==$card_id)
				{
					$mobile=new Zend_Session_Namespace("mobile");
					$mobile->identity_number=$identity_number;
					$mobile->card=$card;
					$mobile->device_id=$device_id;
					echo "3|登陆成功";
					exit();
				}
			
			}
			
		}
		
		else{
			echo "4|未找到该居民信息，请检查证件号码是否填写正确!";
			exit();
		}
		*/
		
		$identity_number=$this->_request->getParam("identity_number");
		$password=$this->_request->getParam("password");
		if(empty($identity_number)){
			echo "1|身份证号码不能为空";
			exit();
		}
		$individual_core=new Tindividual_core();
		$individual_core->whereAdd("identity_number='$identity_number'");
		$count=$individual_core->count();
		if($count>0){
		
			$individual_core->find(true);
			//var_dump($individual_core->password);
			if($individual_core->password==null){ 
				$core=new Tindividual_core();
				$number=substr($identity_number,-8); 
				$number=md5($number);
				$core->password=$number;
				$core->whereAdd("identity_number='$identity_number'");
				$core->update();
			
				
				
			}
			else{
				if($individual_core->password!=md5($password)){
					echo "1|密码不正确";
					exit();
				
				}
			}
		}
		else{
			echo "1|未找到该身份证信息！";
			exit();
		} 
		$mobile=new Zend_Session_Namespace("mobile");
		$mobile->identity_number=$identity_number;
		echo "3|登陆成功";
		exit();
		
	}
	
	public function checkAction(){
		$mobile=new Zend_Session_Namespace("mobile");
		if(empty($mobile->password)){
		echo "请先登录!";
		exit();
		}
	}
	
	public function loginoutAction(){
		Zend_Session::namespaceUnset('mobile');
		$device_id=$this->_request->getParam("device_id");
		$this->redirect(__BASEPATH."iha/login/index/device_id/".$device_id);
		
	}
	//绑定手机
	/*
	public function bindAction(){
		$device_id=$this->_request->getParam("device_id");//获取sim卡号
	    $bind=$this->_request->getParam("bind");
		if($bind=='是'){
			$core=new Tindividual_core();
			$core->whereAdd("identity_number='$identity_number'");
			$core->device_id=device_id;
			if($core->update()){
				echo "绑定成功";
			}
			else
			{
				echo "绑定失败";
			}
		}
		$this->view->device_id=$device_id;
		$this->view->display("bind.html");
	}
	*/
	 
}	
 ?>