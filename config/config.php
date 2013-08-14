<?php
//定义php用的根与HTML用的根。如果config.php框架默认的路径在config中，如果修改成其他路径，则要修改getBasePath中相关的路径
define('__CONFIG_PATH','config');
define('__SITEROOT',getBasePath('site_root'));
define('__BASEPATH',getBasePath('base_path'));
//其中__BASEPATH用于页面上的url路径中,__SITEROOT用PHP中文件包含与打开等
//定义fckeditor中用到的图片路径
$_SESSION['uploadImagePath']=__BASEPATH.'upload/';
//在 newsController editAction也要用到上述定义
//控制首页及内容页缓存
define("__CACHED",false);
//定义缓存
define("__CACHING",false);
//缓存时间，默认为一天
define("__CACHING_LEFTTIME",24*3600);
//控制显示执行时间
define("__DEBUG",true);
//定义是否与zf兼容
define("__COMPATIBLE_ZF",true);//兼容模式下静态化出错，因为在于$view 与$this->view的差异,因此要静态化，则要关掉兼容模式
//定义是否与pear兼容 今天发现不能与pearDB混写，也就是说用了内置的写法，就不能用peaDB的关联表的写法
define("__COMPATIBLE_PEAR",true);
//每页显示行数
define("__ROWSOFPAGE",20);
//翻页常量
//require_once("page_config.php");
define("__goodsListRowOfPage",4);
//ORM表对象映射配置文件
//生成的表对象文件存储的位置。相对于根的路径，默认是在根目录的model下
//如果仅使用db功能，则此二常量要定义在model_config.php中，包含进相应的配置文件
define('__MODEL_PATH',__SITEROOT.'model/');
//生成的表对象文件中类名前缀。
define('__MODEL_CLASS_PREFIX','T');
//$_model_config['__MODEL_CLASS_PREFIX']='T';
//ORM表对象映射配置文件--end

//定义一个金石服务器的IP地址
define('__JINSHI_SERVER_IP','172.16.11.253/yafyxt/ywgl');

//发短信开关-万20130407 
define("__SMS",true);//boolean
define("__SMS_APPLICATIONID",'2222');//sms应用程序id

//引入view层配置文件
require_once(__SITEROOT."config/config_view.php");
//引入5dview层配置文件
require_once(__SITEROOT."config/config_5dview.php");
//引入数据库操作抽象层,本项目使用的oracle因此引入db_oracle
require_once(__SITEROOT."/library/db_oracle.php");

/**
 * 本函数仅用于config.php中
 *
 * @param unknown_type $type
 */
function getBasePath($type){
	//定义根
	$_temp_path=str_replace(__CONFIG_PATH,'',dirname(__FILE__));
	$_temp_path=str_replace('\\','/',$_temp_path);
	if($type=='site_root'){
		return $_temp_path;
	}
	if($type=='base_path'){
		//define('__SITEROOT',$_temp_path);
		//如果系统所在的目录并非根目录，则做相应的处理
		if($_temp_path!=$_SERVER['DOCUMENT_ROOT']){
			$_temp=substr($_temp_path,strlen($_SERVER['DOCUMENT_ROOT']));
			$_temp=str_replace('\\','/',$_temp);
			//define('__BASEPATH',$_temp);
		}else{
			$_temp='/';
			//define('__BASEPATH','/');
		}
		return $_temp;
	}
}
$benchmark_message='';
function bentchmark($message='',$file='',$line=''){
	global $s,$benchmark_message;
	$e=microtime(true);
	//__DEBUG的定义在config.php中
	//echo "<br>程序执行时间";
	$t=round(($e-$s),4);
	$message=$file.$line.$message."<br />";
	$benchmark_message=$benchmark_message.$message;
}