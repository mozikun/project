<?php
//session_start();
//error_reporting(0);
set_time_limit(0);
header("Content-type: text/html;charset=utf-8");
date_default_timezone_set('Asia/Shanghai');
//$s=microtime(true);
//echo $s;
//exit();
/**
 *引入相关的文件
 */
if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')>0){
}
else{
}

//setBasePath();
require_once("./config/config.php");
//设计查找文件路径
set_include_path(__SITEROOT."library".PATH_SEPARATOR.get_include_path());
require_once(__SITEROOT."library/router.php");
require_once(__SITEROOT."library/function.php");
require_once(__SITEROOT."library/controller.php");//相对于index.php的文件位置
//如果用zf的兼容模式，则不能直接sesssion_start
if(__COMPATIBLE_ZF){
	require_once(__SITEROOT."library/Zend/Session.php");//相对于index.php的文件位置
	$yaanSession = new Zend_Session_Namespace('yaanSession');
}else{
	session_start();
}
//require_once(__SITEROOT.'config/model_config.php');
//echo __MODELPATH;
//view不能包含在这，因为用了两个不同的view
//require_once(__SITEROOT."library/view.php");5dMVC的view
//require_once(__SITEROOT."config/smarty_config.php");smarty的view

/**
 *	安全性检测
 */
//filter::filter();

/**
 * 实例化路由器
 */
$router=new router();
$router->addModuleDirectory('application');
/**
 * 分发
 */
$router->dispatch();
/*
$e=microtime(true);
if(__DEBUG){
	//__DEBUG的定义在config.php中
	echo "<br>程序执行时间";
	echo round(($e-$s),4);
}
*/
