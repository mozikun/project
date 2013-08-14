<?php
class organization_chartController extends controller 
{
	public function init()
	{
		$this->view->basePath = __BASEPATH;
	}
	public function indexAction()
	{
		$this->view->display('index.html');
	}
}
?>