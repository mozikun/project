<?php
class default_indexController extends controller {
	public function init(){
		//echo "in init";
		//echo "<br />";
	}
	public function indexAction(){
		$this->redirect(__BASEPATH."loging/index");
		echo "<br />in defautl controller action<br />";
		//$this->view->basePath = $this->_request->getBasePath();

		$this->view->basePath = $this->_request->getBasePath();

		echo $this->_request->getBasePath();
		//对于smarty不能直接输出如下形式的代码了。因为有__set重载执行过程。
		//echo $this->view->basePath;

		//echo $this->_request->getParam('name','noname');
		//测试session
		$testSession = new Zend_Session_Namespace('test');
		echo  "<br />";
		echo '测试zend　session'.$testSession->name;
		echo  "<br />";
		$testSession->name=$this->_request->getParam('name','noname');
		//用assign方式
		//$this->view->assign('ddd',$this->_request->getParam()
		$this->view->assign('name',$this->_request->getParam('name','noname'));
		//用直接赋值方式
		$this->view->age=$this->_request->getParam('age','18');
		if($this->_request->getParam('ok')){
			$this->view->message='保存成功';
		}
		//显式调用
		$this->view->display('index.html');
	}
	public function editAction(){
		$this->view->basePath = $this->_request->getBasePath();
		if($this->_request->getParam('ok')){
			echo $this->_request->getParam('name');
		}
		$this->view->display('edit.html');

	}
}