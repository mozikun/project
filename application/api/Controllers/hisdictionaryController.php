<?php
/**
 * @author mask
 * @todo  医疗-数据字典信息查询
 */
class api_hisdictionaryController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_his_dictionary.php");

		/*$client=new hisdictionary();
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><where><org_id>888888</org_id><number>3</number></where>";
 		$tmp=$client->dictionary_info("12",$xml_string); 
 		echo $tmp;
		exit();
		*/
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
		$classname=parent::getControllerName();
		require_once(__SITEROOT."application/api/models/api_his_dictionary.php");//model
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
		$client=new SoapClient("http://182.132.138.30:8080/wsdl/api_his_hisdictionary.wsdl");	
		
		$tmp=$client->dictionary_info("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>45253415-1</org_id><number>2</number></where>"); 
 		echo $tmp;
 	
	}
}
?>