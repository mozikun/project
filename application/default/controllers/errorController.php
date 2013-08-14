<?php
class default_errorController extends controller {
	//不读取数据表的空动作
	public function errorAction(){
		require_once(__SITEROOT."config/smarty_config.php");
		$this->view->assign('__BASEPATH',__BASEPATH);
		$this->view->assign('error_message',$_REQUEST['error_message']);
		$this->view->display('error.html');
	}
}	
?>	