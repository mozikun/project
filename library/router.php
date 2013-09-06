<?php
/**
 * 路由器
 * 如果没有指定模、控制器与动作，则默认的模块名/控制器名/动作名　可在配置文件model_config.php中指定
 * 为什么一样要模仿zf呢，也可以设计成index/index/index
 * 其所对应的目录为 application/default  对应的控制器文件为 index_controller.php 或 indexController 
 * 对应的对应为 indexAction
 * 设计思路：
 * 2009-12-22
 * 为了更好提高控制器的灵活性，把模块名，控制器名与动作名都设计为可自定义式
 * 按http://www.mymvc.cn/moduleName/controllerName/actionName/pareKey1/pareValue1.... 的方式来请求。
 * 如http://www.mymvc.cn/admin/user/add
 * 而对应的控制器文件的名称为 controllerName_controller.php或是controllerNameController.php
 * 对应的控制器类的名称为 controllerName_controller或是moduleName_controllerNameController
 * 
 * 
 * 在处理时要
 * 把moduleName映射成为实际的路径,这个映射表可在配置文件中定义，也可在主程序中定义，然后通过
 * 定义如下功能来处理模块设计
 * 
 * setModule($moduleArray)来现实。也可通过getModule([modeuleName])来获取映射表的所有项目或是一项。
 * 
 * 
 * $moduleArray=array('user'=>'application/user','news'=>'application/news','default'=>'application/default')

 * controllerName映射成为实际类名与文件名
 * 
 * controllerName的后缀名要根据用户在配置文件中的设置来处理，
 * 可根据配置修改。如后缀名可定义为_controller，则对应的类文件与类名分别为
 * user_controller.php user_controller (或是　admin_user_controller:保持与zf一致)
 * 如果后缀名定义为Controller,则对应的类文件与类名分别为
 * userController.php userController　(或是　admin_userController:保持与zf一致)
 * actionName要映射成为实际成员函数名
 * 如在配置文件中后缀名可定义为_action，则对应的动作名为
 * add_action
 * 如在配置文件中后缀名可定义为Action，则对应的动作名为
 * addAction
 * 希望在寒假可完成这项改进工作 --上面的工作已完成
 * 另，setModule等设计为与ZF的的接口名一样，这样方便移植
 * 
 * 详细说明见
 * 
 *
 */

class router{
	/**
	 * 模块数组，存储模块与路径之间的映射关系
	 *
	 * @var array
	 */
	private $modules=array();
	/**
	 * 控制器类
	 *
	 * @var char
	 */
	private $controller;

	/**
	 * 控制器后缀名
	 * 如可设定为userController 
	 *
	 * @var char
	 */
	private $controller_suffix;
	/**
	 * 控制器类文件的后缀名
	 *
	 * @var char
	 */
	private $_php_file_suffix;
	/**
	 * 控制器类文件
	 * 如果控制器名为userController 则所对应的文件为userController.php
	 *
	 * @var char
	 */
	private $controller_file;

	/**
	 * 动作
	 * 对应为一个控制器类中的public function
	 *
	 * @var char
	 */
	private $action;

	/**
	 * 动作后缀名
	 * 如public function displayAction()
	 *
	 * @var unknown_type
	 */
	private $action_suffix;
	/**
	 * 默认的模块
	 *
	 * @var unknown_type
	 */
	private $_default_module_controller_action;
	private $_error_module_controller_action;
	private $_default_module;//默认模块
	private $_default_controller;//默认控制器
	private $_default_action;//默认动作


	/**
	 * 控制器实例
	 *
	 * @var unknown_type
	 */
	private $controller_instance;
	/**
	 * 参数封装
	 * @var request
	 */
	private $_request;

	/**
	 * 根
	 *
	 * @var char
	 */
	private $root;

	/**
	 * uri
	 *
	 * @var char
	 */
	private $uri;
	public $module_name;
	public $controller_name;
	public $action_name;
	/**
	 * 构造函数
	 *
	 */
	public function __construct1(){

		//设定根路径
		if(defined('__SITEROOT')){
			$this->root=__SITEROOT;
		}else{
			echo "没有定义根，程序执行错误。请在config/config.php加如下的代码行<br />";
			echo 'define("__SITEROOT",$_SERVER[\'DOCUMENT_ROOT\']."/")或是。。。。';
		}

		//获取uri相关参数
		$this->uri=$_SERVER['REQUEST_URI'];
		require_once(__SITEROOT."config/module_config.php");
		//以下变量来自配置文件config/module_config.php
		$this->modules=$_modules;
		//array_push($this->modules,$_modules);//模块数组
		//var_dump($this->modules);
		//exit();
		$this->controller_suffix=$_controller_suffix;//控制器后缀
		$this->action_suffix=$_action_suffix;//动作后缀
		$this->_php_file_suffix=$_php_file_suffix;//控制器后缀
		$this->_default_module_controller_action=$_default_module_controller_action;//默认模块/控制器/动作
		$this->_default_module=$_default_module;//默认模块
		$this->_default_controller=$_default_controller;//默认控制器
		$this->_default_action=$_default_action;//默认动作
		$this->_error_module_controller_action=$_error_module_controller_action;//默认错误处理模块

		//var_dump($this->modules);
		//转到router动作
		$this->router_action();

		//对通过uri获取的控制器进行有效性进行检查
		//$this->check_controller();
		//实例化控制器
		//$this->factory();
		//对获取的动作是否存在进行检查
		//$this->check_action();
	}
	public function init(){
		//设定根路径
		if(defined('__SITEROOT')){
			$this->root=__SITEROOT;
		}else{
			echo "没有定义根文件路径，程序执行错误。请检查config/config.php的相应代码<br />";
			echo 'define("__SITEROOT",$_SERVER[\'DOCUMENT_ROOT\']."/")或是。。。。';
		}
		//获取uri相关参数
		$this->uri=$_SERVER['REQUEST_URI'];
		require_once(__SITEROOT."config/module_config.php");
		//以下变量来自配置文件config/module_config.php
		//$this->modules=$_modules;
		//将自动得到的模块与手工定义的模块融合
		$this->modules=array_merge($this->modules,$_modules);//模块数组
		//echo "<pre>";
		//var_dump($this->modules);
		//echo "</pre>";
		$this->controller_suffix=$_controller_suffix;//控制器后缀
		$this->action_suffix=$_action_suffix;//动作后缀
		$this->_php_file_suffix=$_php_file_suffix;//控制器后缀
		$this->_default_module_controller_action=$_default_module_controller_action;//默认模块/控制器/动作
		$this->_default_module=$_default_module;//默认模块
		$this->_default_controller=$_default_controller;//默认控制器
		$this->_default_action=$_default_action;//默认动作
		$this->_error_module_controller_action=$_error_module_controller_action;//默认错误处理模块

		//var_dump($this->modules);
		//转到router动作
		$this->routerAction();

		//对通过uri获取的控制器进行有效性进行检查
		//$this->check_controller();
		//实例化控制器
		//$this->factory();
		//对获取的动作是否存在进行检查
		//$this->check_action();
		return true;
	}
	public function routerAction(){
		//$this->modules=$modules;
		//重构模块，控制器，动作与参数
		$this->splitUri();
		//$this->check_controller();
		//静态缓存
		//		if($this->templet_factory())
		//		{
		//			return ;
		//		}
		//		else
		//		{
		//			$this->controllerFactory();
		//		}
		//静态缓存end
		$this->controllerFactory();
		return true;
	}
	/**
	 * 对uri进行分解 分解成为 模/控制器/动作/参数
	 *
	 * @param unknown_type $uri
	 */
	public function splitUri(){
/*		http://localhost/student/student/display/id/1235
		默认第一部分为模块名,第二部分为控制器名,第三部分为动作名
		只有根，则指向默认控制器
		echo $this->uri;
		if($this->uri=='/'){
		http://localhost/5dcms/student/student/display/id/1235
		http://localhost/5dcms
		这样修改的主要目的是为了实现二级目录的模式，以前只能在根目录实现，现在可以在任意二级目录中实现
		统一uri的格式，统一成 toPath/module/controller/action的形式*/
		if($this->uri==__BASEPATH){
			//相当于用户按如下方式访问
			//www.5dcms.com/ 则　此时　$this->uri='/' __BASEPATH也等于'/'
			//www.5dcms.com/5dcms/ 则　此时　$this->uri='/5dcms/' __BASEPATH也等于'/5dcms/'
			//则将默认的模块名控制器名与动作名根据config.php定义的补全，形成类似于
			//$this->uri="/defautl/index/index'或是
			//$this->uri="/5dcms/defautl/index/index'
			$this->_default_module_controller_action=__BASEPATH.$this->_default_module_controller_action;
			$this->_error_module_controller_action=__BASEPATH.$this->_error_module_controller_action;
			$this->uri=$this->_default_module_controller_action;//在config.php中设置
		}
		//去掉 toPath部分	后分解形成模块，控制器与动作
		$parameter=explode("/",substr($this->uri,strlen(__BASEPATH)-1));
		//取模块名
		$module=$parameter['1'];
		if(!array_key_exists($module,$this->modules)){
			$error_message=urlencode('指定的模块名['.$module.']未在配制文件module_config.php中定义的$_modules数组中出现，程序无法执行');
			$url=__BASEPATH.$this->_error_module_controller_action."/error_message/".$error_message;
			//echo $url;
			//exit();
			router::redirect($url);
			exit();
		}else{
			$this->module_name=$module;
		}
		//取控制器名
		if(isset($parameter['2']) and $parameter['2']!=''){
			$this->controller_name=$parameter['2'];
		}else{
			//有可能是用这种方式访问 www.5dcms.com/news 仅有模块名，没有控制器名，则用默认的控制器名设置
			//取控制器名
			$this->controller_name=$this->_default_controller;
		}
		//尝试形成正确的控制文件名与控制器类名。
		//因为加入了自动对_controller 与 controller等多种不同后缀名的自动判断功能
		$controller_file_exist=false;
/*		if(!__COMPATIBLE_ZF){
			foreach ($this->controller_suffix as $controller_suffix){
				foreach ($this->_php_file_suffix as $php_file_suffix){
					$temp_file_name=$this->root.$this->modules[$this->module_name].$this->controller_name.$controller_suffix.$php_file_suffix;
					//echo $temp_file_name;
					//echo "<br />";
					if(file_exists($temp_file_name) and !is_dir($temp_file_name)){
						$this->controller=$this->controller_name.$controller_suffix;
						$this->controller_file=$temp_file_name;
						$controller_file_exist=true;
					}
				}
			}
		}*/
		//exit();
		//以下代码用于与zf保持兼容性而附加   zf中是按　student/controllers/studentController.php方式组织的
		//实际上现在基本也按照zf的文件组织模式在进行了
		if(1 or __COMPATIBLE_ZF){
			foreach ($this->controller_suffix as $controller_suffix){
				foreach ($this->_php_file_suffix as $php_file_suffix){
					//判断在模块名与实际路径映射时，是否已包含了
					//$temp_file_name=$this->root.$this->modules[$this->module_name].'/controllers/'.$this->controller_name.$controller_suffix.$php_file_suffix;
					//$this->module_name 里已包含了/controllers/路径
					$temp_file_name=$this->root.$this->modules[$this->module_name].$this->controller_name.$controller_suffix.$php_file_suffix;
					//echo $temp_file_name;
					//echo "<br />";
					if(file_exists($temp_file_name) and !is_dir($temp_file_name)){
						$this->controller=$this->controller_name.$controller_suffix;
						$this->controller_file=$temp_file_name;
						$controller_file_exist=true;
					}
                    //我好笨 检测不规范的目录名，项目中部分首字母大写，部分没有写
                    if(!$controller_file_exist && !file_exists($temp_file_name))
                    {
                        $temp_file_name=$this->root.str_replace('controllers','Controllers',$this->modules[$this->module_name]).$this->controller_name.$controller_suffix.$php_file_suffix;
                        if(file_exists($temp_file_name) and !is_dir($temp_file_name))
                        {
    						$this->controller=$this->controller_name.$controller_suffix;
    						$this->controller_file=$temp_file_name;
    						$controller_file_exist=true;
					    }
                    }
				}
			}
		}
		//echo $this->uri;

		//exit();

		if(!$controller_file_exist){
			$error_message=urlencode('找不到指定的控制器与控制器文件:'.$this->controller_name.'请检查后缀名是否正确');
			$url=__BASEPATH.$this->_error_module_controller_action."/error_message/".$error_message;
			//echo $url;
			//exit();
			router::redirect($url);
			exit();
		}
		if(isset($parameter['3'])){
			$action=$parameter['3'];//取动作名
			//有可能动作名就是空 如 www.mysite.com/modual/controller//para/value
		}else{
			$action='';//取动作名
		}
		//这几句的逻辑是对的，没办法写在一起2011-11-05
		if(trim($action=='')){
			//$error_message=urlencode('没有指定动作，程序无法执行');
			//router::redirect($this->_error_module_controller_action."/error_message/".$error_message);
			//exit();
			$action=$this->_default_action;
		}
		//这里直接把属于action的部分赋值给$this->action_name
		$this->action_name=$action;
		//不在加这里形成action了，因为要对可能的不同的action的后缀名进行尝试,所以必须是在实例化类后才能完成，而这里还没有实例化，无法完成尝试
		//$this->action=$action.$this->action_suffix;//加动作后缀
		//获取参数列表  name/mike/age/12/class/one
		//并填充到$_GET 与$_REQUEST数组中
		$parameters='';
		//require_once('request.php');
		//实例化request对象
		$this->_request=new request();
		//请同学们想想为什么是从４开始的
		//echo "<pre>";
		//var_dump($parameter);
		//echo "</pre>";
		$temp_counter=count($parameter);
		for($i=4;$i<$temp_counter;$i++){
			$temp=isset($parameter[$i+1])?urldecode($parameter[$i+1]):'';
			//echo $parameter[$i]."|".$temp."\n";
			$_GET[$parameter[$i]]=$temp;
			$_REQUEST[$parameter[$i]]=$temp;
			//兼容zf的方式,将所有的get参数注入到request对象中 zf有一个小bug，就是不能区别同名的get与post参数，5d已解决
			//$this->_request->setParameter($parameter[$i],$temp);
			$this->_request->setParam($parameter[$i],$temp);
			//注意这里，要多加一次
			$i=$i+1;
			$parameters=$parameters.$temp;
		}
		return true;
		//exit();
		//echo $module.$this->controller.$this->action.$parameters;
		//以下代码不属于路由器的一部分，等时机成熟单独封装
		//缓存首页 以后来封装
		if(!__CACHED){
			return ;
		}
		if($this->uri==__BASEPATH."default/index/index"){
			//如果要生成静态缓存页
			if(isset($_GET['generateHTML']) and $_GET['generateHTML']=='gen'){
				//按正常程序走　真正的生成程序在index_controller中 file_put_contents(__SITEROOT.'/views/caches/index.html',$obContent);
			}else{
				echo file_get_contents(__SITEROOT.'index.html');
				$e=microtime(true);
				if(__DEBUG){
					echo "<br>程序执行时间";
					global $s;
					echo $e-$s;
				}
				exit();
			}
		}
		/*		if($this->uri==__BASEPATH."default/index/display"){
		//如果要生成静态缓存页
		if($_GET['generateHTML']=='gen'){
		//按正常程序走
		}else{
		//如果要启用静态缓存，注释return并将index_controller.php中index_action里的$view->dipslay...注释;
		if(__CACHED){

		}else{
		return;
		}
		echo file_get_contents(__SITEROOT.'/html/'.$_GET['id'].'.html');
		$e=microtime(true);
		if(__DEBUG){
		echo "<br>程序执行时间";
		global $s;
		echo $e-$s;
		}
		exit();
		}
		}*/

	}
	/**
	 * 控制器工厂　由它具体实例化请求的类
	 *
	 */
	public function controllerFactory(){
		//引入相应的控制器文件
		require_once("$this->controller_file");
		//实例化控制器 如果引入的类文件中没有所指定的类，则报错
		if(class_exists($this->controller)){
			//这里就判断是类的名称否是加了模块前缀这二种情况就行了。
		}elseif(class_exists($this->module_name.'_'.$this->controller)){
			//控制器加模块前缀名，用于兼容zf  在zf中，类的名称是由模块名加加下划线加控制器名购成如 student_scoreController　学生成绩管理
			$this->controller=$this->module_name.'_'.$this->controller;
		}else{
			$error_message=urlencode('没有指定正确的控制类:'.$this->controller.'，程序无法执行');
			$url=__BASEPATH.$this->_error_module_controller_action."/error_message/".$error_message;
			router::redirect($url);
			exit();
		}
		//php类实例化时，先处理当前类的构造函数，而不会自动去处理其父类的构造函数。

		//这里完成控制器类的实例化，并将参数注入。//2010-02-15不用注入的方法实现，直接通过$this->controller_instance->_request=$this->_request;来注入参数
		//$this->controller_instance=new $this->controller($this->_request);//参数注入
		$this->controller_instance=new $this->controller($this->modules,$this->module_name,$this->controller_name,$this->action_name,$this->_request);
		//设置各项参数
		//$this->controller_instance->moduleName=$this->module_name;
		//$this->controller_instance->controllerName=$this->controller_name;
		//$this->controller_instance->actionName=$this->action_name;
		//$this->controller_instance->_request=$this->_request;
		//echo "1<br />";
		//echo $this->controller_instance->controllerName;
		//exit();
		//echo "2<br />";
		//echo $this->controller_instance->getControllerName();
		//echo "3<br />";
		//var_dump($this->_request);
		//判断所请求的动作是否存在
		$action_exist=false;
		foreach ($this->action_suffix as $actionSuffix){
			$temp_action=$this->action_name.$actionSuffix;
			if(method_exists($this->controller_instance,$temp_action)){
				$action_exist=true;
				$this->action=$temp_action;
				return true;
			}
		}
		if(!$action_exist){
			$error_message=urlencode('没有指定正确的动作:'.$this->action_name.'，程序无法执行');
			$url=__BASEPATH.$this->_error_module_controller_action."/error_message/".$error_message;
			router::redirect($url);
			exit();
		}
	}
	/**
	 * templet exist checking
	 *
	 */
	public function templet_factory(){
		$controller=str_replace($this->controller_suffix,'',$this->controller);
		$action=str_replace($this->action_suffix,'',$this->action);
		//echo $controller.$action;
		$view_file=__SITEROOT."view/templet/view_".$controller."_".$action.".html";
		echo $view_file;
		//echo $this->action;
		if(@$fp=fopen($view_file,'r+')){
			//echo "file exits";
			$view=fread($fp,filesize($view_file));
			echo $view;
			return true;
			//exit();
		}
		return false;
	}
	/**
	 * 分发
	 *
	 */
	public function dispatch(){
		$this->init();
		//暂存动作名到临时变量,如果不这样操作$this->controller_instance->$action($action);要出错
		$action=$this->action;
		//echo $action;
		//exit();
		//$a=array("1","2","3");
		try{
			//$this->controller_instance->$action($action);
			/*2011-09-06 在	public function checkHouseHolderAction($paraFamilyNumber=''){时出了问题，原因在于checkHouseHolderAction又被当成内部函数在coverController中调用，为了区别于不同的调用来源，就通过$paraFamilyNumber的值来区分，而原来的$this->controller_instance->$action($action);会自动把action的name传进去，导致一直出错，现在改成如下版本.*/
			$this->controller_instance->$action();
			//$this->controller_instance->{$this->action};
		}
		catch (Exception $e){
			echo $e->getMessage();
			exit();
		}
	}

	/**
	 * 控制器跳转
	 *
	 * @param string $action
	 */
	public static function redirect($url){
		//echo $url;
		header("location:$url");
	}
	/**
	 * 自动将指定的目录下的所有文件夹设置为模块
	 *
	 */
	public function addModuleDirectory($application_directory){

		$path=__SITEROOT.$application_directory;
		if(!is_dir($path)){
			echo "路径设计有错误，给定的不是有效路径'".$application_directory."'";
			exit();
		}
		if($dir=opendir($path)){
			while(($file_name=readdir($dir))!== false) {
				//形成文件的绝对路径
				$controllers_path = $path."/".$file_name;
				//如果读出的文件名本身又是文件夹，则递归，否则显示文件列表
				if(is_dir($controllers_path)){
					//排除上级与自身
					if($file_name!='.' and $file_name!='..' and $file_name!='.svn'){
/*						if(__COMPATIBLE_ZF){
							$this->modules[$file_name]=$application_directory."/".$file_name."/controllers/";
						}else{
							$this->modules[$file_name]=$application_directory."/".$file_name."/";
						}*/
						$this->modules[$file_name]=$application_directory."/".$file_name."/controllers/";
					}
				}
			}
			closedir($dir);
		}
	}

}