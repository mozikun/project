<?php
//define(ROOT,$_SERVER['DOCUMENT_ROOT']);
require_once(__SITEROOT."library/SMARTY/Smarty.class.php");
class newview extends Smarty {
	public function __set($key,$value){
		//echo $key."=>".$value;
		$this->assign($key,$value);
	}
}

$view = new newview;
//$smarty->template_dir = ROOT.'/view/templates';
$view->template_dir = __SITEROOT.'/views/templates';
$view->compile_dir = __SITEROOT.'/views/templates_c';
$view->left_delimiter="<!--{";
$view->right_delimiter="}-->";