<?php
/**
 * @author 我好笨
 * @todo 本类用于家庭档案接口
 */
class api_phsfamilyController extends controller 
{
	private $wsdl_path;
	public function init()
	{
		$this->wsdl_path="wsdl/api_phs_".parent::getControllerName().".wsdl";
	}
	/**
	 * api接口地址
	 *
	 */
	public function indexAction()
	{
		require_once(__SITEROOT."application/api/models/api_phs_family.php");
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
		require_once(__SITEROOT."application/api/models/api_phs_family.php");
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
	   require_once(__SITEROOT."application/api/models/api_phs_family.php");
		$client=new SoapClient("http://172.16.11.245/wsdl/api_phs_phsfamily.wsdl");
        echo $client->ws_select_all("45254124-6","<?xml version='1.0' encoding='UTF-8'?><where><org_id>45254124-6</org_id></where>");
        exit;
        //$client=new phsfamily();
		$tmp=$client->ws_update("511802104","<?xml version='1.0' encoding='UTF-8'?>
<tables>
<table name='family_archive'>
<row>
<identity_number>610502198101040213</identity_number>
<org_id>511802104</org_id>
<staff_id>510103199901010001</staff_id>
<status_flag>1</status_flag>
<ext_uuid>D02DB94F-3BA7-42BC-9431-CC1CC6EA0C33</ext_uuid>
</row>
<row>
<identity_number>513101194010192513</identity_number>
<org_id>511802104</org_id>
<staff_id>510103199901010001</staff_id>
<status_flag>1</status_flag>
<ext_uuid>3BB95965-C0D4-4FE8-AC3C-200A1FE6B494</ext_uuid>
</row>
</table>
</tables>");
		/*$tmp=$client->ws_select_single("888888","<?xml version='1.0' encoding='UTF-8'?><where><identity_number>513101198601143818</identity_number><org_id>888888</org_id></where>");*/
		echo $tmp;
	}
}
?>