<?php
/**
 * 县级监管平台
 *
 */

class lead_indexController extends controller {

	public function init()
	{
		$this->view->basePath = $this->_request->getBasePath();
		//用户认证与权限
		//require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/MyAuth.php');
		$this->auth=Zend_Auth::getInstance();
		$this->identity = $this->auth->getIdentity();
		if (!$this->auth->hasIdentity())
		{
			$this->redirect(__BASEPATH."loging/index/leadindex");
		}
	
		

	}
	/**
	 * 县级监管平台主页
	 *
	 */
	public function indexAction(){

		$this->view->display("body.html");


	}
	public function leftAction(){

		$this->view->display("left.html");


	}
	public function topAction(){

		//显示选中病人
		$individual_session=new Zend_Session_Namespace("individual_core");
		$this->view->assign("leader",$this->identity['name_real']);
		$this->view->assign('org_name',$this->identity['org_zh_name']);
		$this->view->display("top.html");


	}
	public function rightAction(){

		$this->view->display("right.html");


	}
	/**
	 * 登出监管
	 *
	 */
	public function logoutAction(){

		//exit('ddd');
		if (!$this->auth->hasIdentity()) {
			$this->redirect(__BASEPATH."loging/index/leadindex");
		}
		$this->auth->clearIdentity();
		//清除 命名空间
		Zend_Session::namespaceUnset('individual_core');
		$this->redirect(__BASEPATH.'loging/index/leadindex');

	
		
	}

}