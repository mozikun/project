<?php
/**
 * api_hl7Controller
 * 
 * 基于文档：
 * ICS 11.020 C07 中华人民共和国卫生行业标准   健康档案共享文档规范  第 1 部分：个人基本健康信息登记  （征求意见稿）
 * 完成个人基本健康信息的数据交换接口
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class api_hl7Controller extends controller
{
    private $wsdl_path;
	public function init()
	{
		$this->wsdl_path="wsdl/api_phs_iha.wsdl";;
	}
    /**
	 * api接口地址
	 *
	 */
	public function indexAction()
	{
		require_once(__SITEROOT."application/api/models/api_hl7_iha.php");
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
		$classname="phsiha";
		require_once(__SITEROOT."application/api/models/api_phs_iha.php");
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
	   
    }
}