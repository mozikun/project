<?php
class mytest_mytestController extends controller{
	public function  init(){
		require_once(__SITEROOT.'library/Myauth.php');
		$this->auth = Zend_Auth::getInstance();
		if ($this->auth->hasIdentity()) {
			$this->user = $this->auth->getIdentity();
		}else{
			$this->redirect(__BASEPATH."loging/index/index");		
		}
		$this->view->basePath = $this->_request->getBasePath();
	}
	public function indexAction(){
		require_once(__SITEROOT.'/application/admindecision/models/orgresource.php');
		$currentRegionId = $this->user['region_id'];
		$getreginid      = $this->_request->getParam('regin_id');
		$regionId        = empty($getreginid)?$currentRegionId:$getreginid;
		$myarray         = array(3=>"医院",4=>"社区",5=>"乡镇卫生院");
		$this->view->myarray         = $myarray;
		$this->view->reginid         = $regionId;
		$this->view->display('index.html');
	}
}