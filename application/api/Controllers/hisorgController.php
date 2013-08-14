<?php
/**
 * @author whx
 * @todo  机构信息查询
 * @time  2012-11-14
 */
class api_hisorgController extends controller 
{       
	private $wsdl_path;
	public function init()
	{
		$this->wsdl_path="wsdl/api_his_".parent::getControllerName().".wsdl";
	}
	/**
	 * api接口地址
	 *
	 */
	public function indexAction()
	{
		require_once(__SITEROOT."application/api/models/api_his_org.php");

		
		$SoapServer = new SoapServer(__SITEROOT.$this->wsdl_path);
		$SoapServer->setClass(parent::getControllerName());
		$SoapServer->handle();
				
	}
	/**
	 * 用于生成wsdl
	 *
	 */
	public function make_wsdlAction()
	{       
		$classname=parent::getControllerName();
		require_once(__SITEROOT."application/api/models/api_his_org.php");//model
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($classname,"wsdl_".$classname,"/api/".$classname."/index");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.$this->wsdl_path,"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}

	
	
	
	
	//科室查询
	public function ws_selectAction()
	{      
            
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$client->ws_select("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			
		</where>"); 
 		echo $tmp;
 	
	}
	
}
?>