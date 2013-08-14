<?php
/**
 * 修改密码
 * 
 */

class admin_resetpasswdController extends controller {

	public function init()
	{
		$this->view->basePath = $this->_request->getBasePath();
		//用户权限和认证
		require_once(__SITEROOT.'library/privilege.php');
		//var_dump($this->user);
	}
	
	/**
	 * 修改密码页面
	 *
	 */
	public function indexAction(){

		
		$this->view->display("reset_passwd.html");
		
	}
	/**
	 * 修改密码
	 *
	 */
	public function updateAction(){
		
		$last_passwd=$this->_request->getParam('last_passwd');//旧密码
		$new_passwd=$this->_request->getParam('new_passwd');//新密码
		$confirm_passwd=$this->_request->getParam('confirm_passwd');//确认输入
		if(empty($last_passwd) || empty($new_passwd) || empty($confirm_passwd)){
			exit("参数错误！");
		}elseif($new_passwd!=$confirm_passwd){
			exit("您两次输入的新密码不一致，请确认");
		} 
		$user_id=$this->user['uuid'];//用户档案号
		$new_passwd=md5($new_passwd);//加密
		//检查原密码是否相同
		if($this->chk_passwd($last_passwd)){
			$staff_core=new Tstaff_core();
			$staff_core->whereAdd("id='{$user_id}'");
			$staff_core->passwd=$new_passwd;
			if($staff_core->update()){
				echo "密码修改成功";
			}else{
				echo "密码修改失败";
			}
			
		}else{
			exit("您的旧密码不正确");
		}
		
		
		
	}
	/**
	 * 检查当前用户密码是否一致
	 *
	 * @param string $passwd
	 * @return bool
	 */
	private function chk_passwd($passwd){
		
		if(empty($passwd)){
			throw new Exception("请输入您的旧密码");
		}
		//var_dump($this->user);
		$user_id=$this->user['uuid'];
		$passwd=md5($passwd);//加密后的密码
		$staff_core=new Tstaff_core();
		$staff_core->whereAdd("id='{$user_id}'");
		$staff_core->whereAdd("passwd='{$passwd}'");
		
		//$staff_core->debugLevel(2);
		$count=$staff_core->count("*");
		if($count>0){
			return true;
		}else{
			return false;
		}
	}

}
