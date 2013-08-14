<?php
//配制文件
//定义模块与实际文件夹的映射关系
//路由器中会自动对映射路径的有效性进行检测
//现在已实现了addModuleDirectory方法，因此除了特殊的情况外，可不必手工定义模块名与实际路径
$_modules=array(
	//路径最后一个斜杠不能省
	//"default"=>"application/default/",//非zf兼容模式
	//"default"=>"application/default/controllers/",//zf兼容模式
	//默认模块设计，与zf兼容方式 也可以设计为"index"=>"application/index/"
	//"compatible"=>"application/compatible/controllers/"
	//测试与zf的兼容性。zf的模块名与路径映射是到controllers这一级，因此如果打开了兼容开关（__COMPATIBLE_ZF），则在表现层文件读取时，要去掉最后一级的controllers，以找到表现层正确的路径。
	//"compatible"=>"application/compatible/"//测试与zf的兼容性
);
//默认模块/控制器/动作 用于对首页的访问 如 http://www.5dcms.com，则此时的模块/控制器/动作就按下述定义进行处理
$_default_module='default';//默认模块名
$_default_controller='index';//默认控制器
$_default_action='index';//默认动作
$_default_module_controller_action="$_default_module/$_default_controller/$_default_action";//与用defautl的是为与ZF兼容 注意最前面的/不能省
//$_default_module_controller_action='index/index/index';//也可用这种方式
//默认错误处理
$_default_error_module='default';//默认错误模块名
$_default_error_controller='error';//默认错误控制器
$_default_error_action='error';//默认错误动作
$_error_module_controller_action="$_default_error_module/$_default_error_controller/$_default_error_action";//默认错误处理模块

//控制器后缀名。为保持与别的框架的兼容性，可在此定义多种不同的后缀名
$_controller_suffix=array("_controller","Controller");
//动作后缀名。为保持与别的框架的兼容性，可在此定义多种不同的后缀名
$_action_suffix=array("_action","Action");
//文件扩展名
$_php_file_suffix=array(".php",".php5");


//保留　无用了
$_modules1=array(
	//路径最后一个斜杠不能省
	//"default"=>"application/default",//非zf兼容模式用
	"default"=>"application/default/controllers/",
	//默认模块设计，与zf兼容方式 也可以设计为"index"=>"application/index/"
	"management"=>"application/management/",
	//新闻管理模块
	"goods"=>"application/goods/",
	"download"=>"upload/",
	"message_board"=>"application/message_board/",
	"setup"=>"setup/",
	"test"=>"application/test/",
	"lib"=>"library/",
	"score"=>"application/score/",
	"testsmarty"=>"application/testsmarty/",
	"search"=>"application/search/",
	"mvc"=>"application/testmvc/",
	"oracle"=>"application/oracle/controllers/",
	"oracle1"=>"application/oracle/controllers/",
	"data"=>"application/data/controllers/",
	"compatible"=>"application/compatible/controllers/"
	//测试与zf的兼容性。zf的模块名与路径映射是到controllers这一级，因此如果打开了兼容开关（__COMPATIBLE_ZF），则在表现层文件读取时，要去掉最后一级的controllers，以找到表现层正确的路径。
	//"compatible"=>"application/compatible/"//测试与zf的兼容性
	
);

