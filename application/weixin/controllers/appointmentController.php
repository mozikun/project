<?php
/**
 * weixin_appointentController
 *  
 * 微信预约挂号处理
 * 
 * @package yaan
 * @author whx
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class weixin_appointmentController extends controller{
	public function init(){
		$this->view->basePath = $this->_request->getBasePath();
		require_once __SITEROOT."/library/Models/appointment_register.php";
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once __SITEROOT."/library/Models/staff_core.php";
	}
    /**
     * 
     * 查询预约信息首页
     * 
     * @return void
     */
	public function selectAction(){
		$this->view->display("select.html");
	}
	/**
     * 
     * 处理搜索
     * 
     * @return void
     */
	public function searchAction(){
		$identity_number=$this->_request->getParam("identity_number");
		$password=$this->_request->getParam("password");
		if(empty($identity_number)){
			$this->view->message="身份证不能为空！";
			$this->view->display("select.html");
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
					$this->view->message="密码不正确！";
					$this->view->display("select.html");
					exit();
				
				}
			}
		}
		else{
			$this->view->message="身份证号码输入错误！";
			$this->view->display("select.html");
			exit();
		}
		
		$appointment=new Tappointment_register();
		$staff=new Tstaff_core();
		$appointment->joinAdd("inner",$appointment,$staff,"doctor_id","id");
		$appointment->whereAdd("identity_number='$identity_number'");
		$app_count=$appointment->count();
		if($app_count>0){

			$appointment->find(true);
			$result=array();
			$result['name']=$appointment->name;
			$result['doctor']=$staff->name_login;
			$result['time']=date("Y-m-d",$appointment->register_date);
			$this->view->result=$result;
		}
		$this->view->display("search.html");
	}
	
}
 ?>