<?php

/**
 * api_phsihanoorgController
 * 
 * 完成金石需求的通过个人身份证号码查询个人基本信息的功能，文档见svn，doc目录下相关文档
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class api_phsihanoorgController extends controller 
{
	private $wsdl_path;
	public function init()
	{
		$this->wsdl_path="wsdl/api_phs_ihanoorg.wsdl";;
	}
	/**
	 * api接口地址
	 *
	 */
	public function indexAction()
	{
		require_once(__SITEROOT."application/api/models/api_phs_ihanoorg.php");
		$SoapServer = new SoapServer(__SITEROOT.$this->wsdl_path);
		$SoapServer->setClass(parent::getControllerName());
		$SoapServer->handle();
	}
	/**
	 * 用于生成wsdl
	 *
	 */
	public function generate_wsdlAction()
	{
		$classname="phsihanoorg";
		require_once(__SITEROOT."application/api/models/api_phs_ihanoorg.php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($classname,"wsdl_".$classname,"/api/".$classname."/index");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.$this->wsdl_path,"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}
	/**
	 * 用于测试
	 *
	 */
	public function ws_testAction()
	{
		require_once(__SITEROOT."application/api/models/api_phs_ihanoorg.php");
		$client=new phsihanoorg();
		$tmp=$client->ws_select_single("888888","<?xml version='1.0' encoding='UTF-8'?>
<where>
<identity_number>513101195108173817</identity_number>
</where>
");
		echo $tmp;
	}
}
?>