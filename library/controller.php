<?php
//引入请求对象类
//require_once(__SITEROOT.'library/request.php');//本句保留
//request类本来在requst.php中，在20110221优化工作中，移到了本文件中。luowei主要就是为少包含文件，提高速度
//require_once(__SITEROOT."model/acl.php");
class controller{
	private $_router;
	/**
	 * 模块名下面的属性只能为public，否则动态实例化时，无法将请求参数注入
	 */
	private $module_name;
	private $controller_name;
	private $action_name;
	/**
	 * Enter description here...
	 *
	 * @var request
	 */
	public $_request;
	private $_parameter=array();
	//兼容zf的表现层实现
	/**
	 * Enter description here...
	 *
	 * @var mySmarty
	 */
	public $view;
	function __construct($modules,$module_name='',$controller_name='',$action_name='',$_request=''){
		$this->module_name=$module_name;
		$this->controller_name=$controller_name;
		$this->action_name=$action_name;
		$this->_request=$_request;//传入的requset对象
		//$this->view=$view;
		//对于兼容zf的表现层用法，如果配置文件里不将__COMPATIBLE_ZF设置为false，则会出现无法包含smarty_config.php的情况
		//在未来的版本里，都统一修改成$this->view->的形式。如果都修改成这种模式，下面的兼容模式可以不使用，到时修改
		if(1 or __COMPATIBLE_ZF){
			//去掉$modules[$module_name]路径中最后一级（因为在配制的时候，是指到了控制器所在的位置controllers这里了，因此模块的实际路径应该是去掉controllers的上一级）
			$tempPosition=strrpos($modules[$module_name],'/',-2);
			//echo substr('application/compatible/controllers/',0,22+1)."<br />";保留用于培训
			//echo substr($modules[$module_name],0,$tempPosition+1)."<br />";
			$tempModulePath=substr($modules[$module_name],0,$tempPosition+1);
			$path=__SITEROOT.$tempModulePath."views/scripts/".$controller_name;
			//引入专门为zf兼容的view，这样就不会与原来的view冲突了
			//说明，本来view的配置文件应该在config中引入，但由于与自主开的view有冲突
			//require_once(__SITEROOT."config/zf_samrty_config.php");
			$this->view=new view();
			$this->view->template_dir=$path;
			
			$this->view1=new view1();
			$this->view1->template_dir=$path;

			$this->view2=new view2();
			$this->view2->template_dir=$path;
			
			$this->view2->compile_dir_mask=str_replace('/','~',$tempModulePath."views/scripts/".$controller_name);
			//$this->view2->compile_dir_mask=str_replace('/','_',$tempModulePath.$controller_name."/".$action_name);
			
		}

		//function __construct(){

		//echo "in parent".$router;
		//var_dump($router);
		//$this->_router=$router;
		//php无法自动执行父类的构造函数，因此框架里必须要求每一个控制器子类显式的调用其带参父类的构造函数
		//因此为了调用父类的构造功能，必须增加一个init，在子类的构造里去执行这个init
		$this->init();
		//$this->_request=$_request;
		//var_dump($this->_router);
		//exit();
	}
	public function init(){
		//echo "in parent";
		//exit();
		//ob_start();
	}
	public function __destruct(){
		//$content=ob_get_contents();
		//ob_end_clean();
		//echo $content;
	}

	public function acl($para=''){
		//session_start();
		//if($_SESSION['user_id']!='9999999999999')
		require_once(__SITEROOT."model/acl_staff_resource.php");
		if($_SESSION['url']!=$_SERVER['HTTP_HOST']){
			$errorMessage=urlencode("禁止跨站使用后台功能");
			$this->redirect(__BASEPATH.'default/login/display/errorMessage/'.$errorMessage);
			return;
		}
		if(!isset($_SESSION['staffId'])){
			$errorMessage=urlencode("请登陆后才能使用后台功能");
			$this->redirect(__BASEPATH.'default/login/display/errorMessage/'.$errorMessage);
			return;
		}
		//根据acl来判断是否有权限
		$staffId=$_SESSION['staffId'];
		$controller_name=$this->getcontrollerName();
		//echo $controller_name;
		$acl=new Tacl_staff_resource();
		//注意如果要对从表进行过滤，要在实例化从表的时候就给出过滤条件

		$acl->whereAdd("acl_staff_resource.roleId='$staffId'");
		$acl->whereAdd("acl_staff_resource.resourceId='$controller_name'");
		$acl->whereAdd("acl_staff_resource.privilege='1'");

		//$acl->debug(1);
		if($acl->count('*')==1){

		}else{
			echo "您无权使用该功能";
			exit();
		}

		//echo 'con'.$this->getcontrollerName();
		//echo $this->getModuleControllerAction('/');



	}
	public function getParameter($key='',$value=''){
		//echo $this->_request->getParam($key);
/*		if(isset($this->_request->getParam($key))){
			return $this->_request->getParam($key);
		}else{
			return $value;
		}*/
	}
	public function getParam($key='',$value=''){
		//echo 'ddd'.$this->_request->getParam($key,$value).'---dddd';
/*		if(isset($this->_request->getParam($key))){
			return $this->_request->getParam($key);
		}else{
			return $value;
		}*/
	}	
	public function _getParameter($_key){
		return $_REQUEST[$_key];
		//return $this->_parameter[$_key];
	}
	public function _getParameters(){
	}
	public function _setParameter($key,$value){

	}
	/**
	 * 控制器跳转
	 *
	 * @param string $action
	 */
	public function redirect($url){
		//$url=urlencode($url);
		//echo $url;
		header("location:$url");
	}
	public function forward($action){
		header("location:$url");
	}
	public function getModuleName(){
		return $this->module_name;
	}
	public function getControllerName(){
		return $this->controller_name;
	}
	public function getActionName(){
		return $this->action_name;
	}
	public function getModuleControllerAction($separator='/'){
		return $this->module_name.$separator.$this->controller_name.$separator.$this->action_name;
	}
}
//request本来在requst.php中，在20110221优化工作中，移到了本文件中。luowei
class request{
	private $request=array();
	public function __construct(){
		if($_POST){
			foreach ($_POST as $key=>$value){
				$this->request[$key]=$value;
				//echo 'post'.$key.'|'.$value."<br />";
			}
		}
		if($_FILES){
			$this->request['_FILES']=$_FILES;
		}else{
			//echo "no file";
		}
	}
	public function setParam($key,$value){
		//$this->request[$key]=trim($value);
		$this->request[$key]=$value;
	}	
/*	2010-06-11　商量后去掉此功能，仅留下与zf兼容的版本
	public function setParameter($key,$value){
		$this->request[$key]=$value;
	}
	public function getParameter($key='',$value=''){
		if(isset($this->request[$key])){
			return $this->request[$key];
		}else{
			return $value;
		}
	}*/
	/**
	 * 兼容zf的写法
	 * @param string $key 键
	 * @param string $value 默认值
	 */
	public function getParam($key='',$value=''){
		if(isset($this->request[$key])){
			//去掉可能潜在的前后空格 这里不能去空格，否则如果提交的值是一个数组，就会出错
			//return trim($this->request[$key]);
			return $this->request[$key];
		}else{
			return $value;
		}
	}
	public function getBasePath(){
		return __BASEPATH;
	}
	
}