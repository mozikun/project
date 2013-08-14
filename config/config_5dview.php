<?php
//define(ROOT,$_SERVER['DOCUMENT_ROOT']);
require_once(__SITEROOT."library/5dview.class.php");
require_once(__SITEROOT."library/5dview_1.class.php");
class view1 extends v {
	public function __construct(){
		//$view=new zf_mySmarty;
		//template_dir已指向了每个控制器的views，因此不在能在这些设置统一的template_dir文件夹
		//$view->template_dir= __SITEROOT.'views/templates';
		$this->compile_dir= __SITEROOT.'views/templates_c';
		$this->left_delimiter= "<!--{";
		$this->right_delimiter= "}-->";
		$this->cache_dir= __SITEROOT.'views/caches';//缓存目录
		//对于view不能直接输出如下形式的代码了。因为有__set重载执行过程。如
		//echo $this->view->basePath;
	}
	public function __set($key,$value){
		$this->assign($key,$value);
	}
}
class view2 extends view_2 {
	public function __construct(){
		//$view=new zf_mySmarty;
		//template_dir已指向了每个控制器的views，因此不在能在这些设置统一的template_dir文件夹
		//$view->template_dir= __SITEROOT.'/views/templates';
		$this->compile_dir= __SITEROOT.'views/templates_c';
		$this->left_delimiter= "<!--{";
		$this->right_delimiter= "}-->";
		$this->cache_time=60;//秒为单位
		$this->cache_dir= __SITEROOT.'views/caches';//缓存目录
		//对于view不能直接输出如下形式的代码了。因为有__set重载执行过程。如
		//echo $this->view->basePath;
	}
	public function __set($key,$value){
		$this->assign($key,$value);
	}
}
