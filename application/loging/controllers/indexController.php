<?php
class loging_indexController  extends controller {

	public function init(){

		$this->view->basePath = $this->_request->getBasePath();
		require_once(__SITEROOT.'library/Models/organization.php');//机构表
		require_once(__SITEROOT.'library/Models/region.php');//地区表
		require_once(__SITEROOT.'library/Models/staff_core.php');//用户核心表
		require_once(__SITEROOT.'library/Models/staff_archive.php');//用户扩展表
		require_once(__SITEROOT.'library/Myauth.php');
		$this->auth=Zend_Auth::getInstance();
		require_once(__SITEROOT.'library/custom/comm_function.php');//调用添加日志函数
		require_once(__SITEROOT.'library/Models/login_log.php');//登录日志
	}
	/**
    * 
    */
	public function indexAction(){

		$this->view->display("default_loging_index.html");
	}

	/**
     * 
     * 普通用户
	 * 登录界面
	 *
	 */
	public function userAction(){
        $currentregion = $this->_request->getParam('allregion');
        $this->view->currentregion   = $currentregion;
		$this->view->display("default_loging_user.html");
	}
    /**
     * loging_indexController::decisionAction()
     * 
     * 决策支持界面
     * 
     * @return void
     */
    public function decisionAction()
    {
        $currentregion = $this->_request->getParam('allregion');
        $this->view->currentregion   = $currentregion;
		$this->view->display("default_loging_decision.html");
    }
	/**
	 * 县级管理平台第一页
	 *
	 */
	public function leadindexAction(){
       
		$this->view->display("lead_index.html");
	}
	/**
	 * 县级管理平台登录页
	 *
	 */
	public function leadloginAction(){
       	//选择的区县
		$area=$this->_request->getParam('token','');
		$org_name="";//机构名
		$org_code="";//机构号
       	switch ($area){
       		case 'mingshan':
       			$org_name="名山区卫生局";
       			$org_code="173";
       			break;
       		case 'yucheng':
       			$org_name="雨城区卫生局";
       			$org_code="172";
       			break;
       		case 'xingjing':
       			$org_name="荥经县卫生局";
       			$org_code="174";
       			break;
       		case 'tianquan':
       			$org_name="天全县卫生局";
       			$org_code="177";
       			break;
       		case 'baoxing':
       			$org_name="宝兴县卫生局";
       			$org_code="179";
       			break;
       		case 'shimian':
       			$org_name="石棉县卫生局";
       			$org_code="176";
       			break;
       		case 'lushan':
       			$org_name="芦山县卫生局";
       			$org_code="178";
       			break;     
       		default:
       			$org_name="雅安市卫生局";
       			$org_code="4";	
       			
       	}
       	$this->view->org_name=$org_name;
       	$this->view->org_code=$org_code;
		$this->view->display("lead_login.html");
	}
	/**
	 * 验证机构，并且把用户取出来
	 */
	public function chkoragnizeAction(){
		//机构代码
		$organize_code=$this->_request->getParam('organize_code','');
		//机构密码
		$organize_passwd=$this->_request->getParam('organize_passwd','');

		if(!empty($organize_code) && !empty($organize_passwd)){
			$organize_passwd=md5($organize_passwd);//加密
			$ip_address=$_SERVER['REMOTE_ADDR'];//客户端IP
			$time=time();
			$organization=new Torganization();
			$organization->whereAdd("id='{$organize_code}'");//机构id
			//$organization->whereAdd("zh_passwd='{$organize_passwd}'");//机构密码
			$organization->whereAdd("password='{$organize_passwd}'");//机构密码
			$count=$organization->count();
			if($count>0){

				//用户列表
				$staff_core		=	new Tstaff_core();
				$staff_archive	=	new Tstaff_archive();
				$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
				$staff_core->whereAdd("org_id='{$organize_code}'");
				$staff_core->orderby('standard_code asc');
				//$staff_core->debugLevel(9);
				$staff_core->find();
				$user_record='';
				$record_count=0;//记录数;
				while ($staff_core->fetch()) {

					$user_record.=$staff_core->id.':';//id
					$user_record.=$staff_core->name_login.'|';//登录名

					$record_count++;

				}
				//echo $record_count;
				//用户个数大于等于1
				if($record_count>0){

					$user_record= trim($user_record,'|');//去掉用户左右的|
					echo '1~'.$user_record;


				}else{
					echo '2~'.'还没有工作人员！';
				}

			}else{
				echo '3~'."机构名或者密码错误！";
				//insert_login_log($organize_code,'',$ip_address,$time,2,'机构密码错误');
			}

		}else{
			throw new Exception('4~'."非法进入");
		}

	}
	/**
    * 验证用户
    *
    */
	public function chkuserAction(){
		
		$organize_code=$this->_request->getParam('organize_code');//机构代码
		$user_code=$this->_request->getParam('user_code');//用户名
		$user_passwd=$this->_request->getParam('user_passwd');//用户密码
                $action=$this->_request->getParam('action');
                
                if($action=='android'){
                     $yanz=$this->_request->getParam("yanz");
                     if($yanz!=$_SESSION['check_pic'] )
                     {      
                            // echo "5|".$yanz;
                            echo "5|验证码不正确！";
                            exit();
                     }
                     $organize_code='15';
                     $user_code='4c5b85a2c8f4b';
                    // $user_passwd='770729';
                     
                     
                }
                
		$ip_address=$_SERVER['REMOTE_ADDR'];//客户端IP
		$time=time();
		if(!empty($organize_code) && !empty($user_code) && !empty($user_passwd)){
			$user_passwd=md5($user_passwd);
		}else{
			throw new Exception("2|非法进入！");
		}
		//检查登录日志
		$login_log=new Tlogin_log();
		$login_log->whereAdd("user_id='{$user_code}'");
		$login_log->whereAdd("login_time>".strtotime("-1 hour"));
		$login_log->whereAdd("status<>1");
		$login_log->whereAdd("ip_address='{$ip_address}'");
		$count=$login_log->count("*");	//统计次数	
				
		if($count>5){
			$login_log=new Tlogin_log();
			$login_log->whereAdd("user_id='{$user_code}'");
			$login_log->whereAdd("login_time>".strtotime("-1 hour"));
			$login_log->whereAdd("status<>1");
			$login_log->whereAdd("ip_address='{$ip_address}'");
			$login_log->orderby("login_time ASC");
			$login_log->find();
			$login_log->fetch();
			$second= $time-$login_log->login_time;			
			$minute= number_format(60-$second/60);
			echo "3|该帐户已经锁定！{$minute}分钟后再试！";
			exit();
		}
		
		$auth = Zend_Auth::getInstance();//创建认证session的命名空间，并放到Zend_Auth的实例的存储器中
		//$auth->setStorage(new Zend_Auth_Storage_Session('userNamespace'));
		$authAdapter = new MyAuth($user_code,$user_passwd);
		$result = $auth->authenticate($authAdapter);
		if ($result->isValid()) {
			//print_r($result);
			$this->setOrgInfo($organize_code);
			//$this->redirect(__BASEPATH."doctor/index");
			echo "1|";
			//登录日志
			insert_login_log($organize_code,$user_code,$ip_address,$time,1,'登录成功');
			exit();
		}else{
			//登录日志
			insert_login_log($organize_code,$user_code,$ip_address,$time,3,'用户密码错误');
			echo '4|用户密码错误！';
		}
		

	}

	/**
	 * 登出
	 *
	 */
	public function logoutAction(){

		//exit('ddd');
		if (!$this->auth->hasIdentity()) {
			$this->redirect(__BASEPATH."loging/index/index");
		}
		$this->auth->clearIdentity();
		//清除 命名空间
		Zend_Session::namespaceUnset('individual_core');
		$this->redirect(__BASEPATH.'loging/index/index');

	}
	/**
	 * 取得机构信息
	 */
	public function setOrgInfo($id){
		$organization=new Torganization();
		$region=new Tregion();
		$organization->joinAdd('inner',$organization,$region,'region_path','region_path');
		$organization->whereAdd("organization.id='$id'");
		$organization->find(true);
		$organizationSession=new Zend_Session_Namespace("organization_core");
		$organizationSession->organization_id=$organization->id;//
		$organizationSession->zh_name=$organization->zh_name;//
		$organizationSession->region_path=$organization->region_path;//
		$organizationSession->region_path_domain=$organization->region_path_domain;//
		$organizationSession->type=$organization->type;//
		$organizationSession->org_standard_code=$organization->standard_code;//
		$organizationSession->region_id=$region->id;//
		$organizationSession->region_standard_code=$region->standard_code;//
	}
	/**
	 * 测试
	 *
	 */
	public function authAction(){

		$auth = Zend_Auth::getInstance();

		if ($auth->hasIdentity()) {
			// Identity exists; get it
			$identity = $auth->getIdentity();
			print_r($identity);
		}else{
			echo "false";
		}

	}

}
?>