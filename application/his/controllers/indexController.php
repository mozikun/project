<?php
class his_indexController extends controller{
	public function init(){
		
	}
	public function listAction(){
		$this->view->basePath = __BASEPATH;
		$this->view->display('list.html');
	}
	public function displayAction(){
		
	}
}