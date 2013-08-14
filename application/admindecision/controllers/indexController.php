<?php
class admindecision_indexController extends controller{
	public function  init(){
		require_once(__SITEROOT.'library/privilege.php');
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
		$getreginid      = $this->_request->getParam('region_id');
		$action		     = $this->_request->getParam('action');//显示内容 基本情况base 公共卫生public 医疗业务his
		$regionId        = empty($getreginid)?$currentRegionId:$getreginid;
		$myarray         = array(3=>"医院",4=>"社区",5=>"乡镇卫生院");
		$this->view->myarray         = $myarray;
		$this->view->reginid         = $regionId;
		$this->view->region = $this->_request->getParam('region');
		$this->field = $this->_request->getParam('field','zyrs');
		$this->view->field = $this->field;
		$this->view->action= $action;
        $start_time=$this->_request->getParam('start_time')?$this->_request->getParam('start_time'):'2000-01-01';
		$end_time=$this->_request->getParam('end_time')?$this->_request->getParam('end_time'):date("Y-m-d");
		$this->view->assign('start_time',$start_time);
		$this->view->assign('end_time',$end_time);
        $this->view->assign('region_id',$regionId);
		$this->view->display('index.html');
	}
	public function pieAction(){
		$regin_id     = $this->_request->getParam('regin_id');
		$realregin_id = empty($regin_id)?$this->user['regin_id']:$regin_id;
		
	}
}