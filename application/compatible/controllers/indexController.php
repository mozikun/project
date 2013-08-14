<?php
class compatible_indexController extends controller {
	public function init(){
		echo $_SERVER['REQUEST_URI'].'</br>';
		echo $_SERVER['REMOTE_ADDR'].'</br>';
		echo $_SERVER['REMOTE_PORT'].'</br>';
		echo $_SERVER['REQUEST_METHOD'].'</br>';
		echo $_SERVER['DOCUMENT_ROOT'].'</br>';
		echo $_SERVER['PHP_SELF'].'</br>';
	}
	//不读取数据表的空动作
	public function indexAction(){
		echo "<br />in defautl controller action<br />";
		$this->view->basePath = $this->_request->getBasePath();
		//echo $this->_request->getParam('name','noname');
		//测试session
		$testSession = new Zend_Session_Namespace('test');
		$testSession->name=$this->_request->getParam('name','noname');
		//用assign方式
		$this->view->assign('name',$this->_request->getParam('name','noname'));
		//用直接赋值方式
		$this->view->age=$this->_request->getParam('age','18');
		//显式调用
		$this->view->display('index.html');	
		echo  "<br />";
		echo 	'测试aaaaaaaaazend　session'.$testSession->name;
	}
	//
	public function getsessionAction(){
		echo '获取session测试</br>';
		echo '<hr>';
		$newSession = new Zend_Session_Namespace('test');
		echo 'session的真正名称:'.$newSession->name.'</br>';
		echo '<hr>';
		echo 'post提交测试';
		echo '<hr>';
		echo '<form action="" method="POST">';
		echo '<tr><td><input type="text" name="username"/></td></tr></br>';
		echo '<tr><td><input type="text" name="userpwd"/></td></tr></br>';
		echo '<tr><td><input type="submit" name="ok" value="提交"/></td></tr>';
		echo '</form>';
		$name = $_REQUEST['username'];
		$pwd = $_REQUEST['userpwd'];
		echo $name.'</br>';
		echo $pwd;
		echo '<hr>';
		echo '<a href="getsession/id/1/menuid/30">get提交测试</a></br>';
		$id = $_REQUEST['id'];
		$menuid = $_REQUEST['menuid'];
		echo 'id='.$id.'</br>';
		echo 'menuid='.$menuid.'</br>';
//		echo <<<EOT
//		         <form method="POST" action="post">
//		                <select name="choose">
//		                     <option value="1">出租</option>
//		                     <option value="2">出售</option>
//		                     <option value="3">求租</option>
//		                </select>
//		         </form>
//		       EOT;
//		echo $_REQUEST['choose'];
	}
}	
?>	