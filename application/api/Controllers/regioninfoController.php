<?php
class api_regioninfoController extends controller {
	public function initAction(){
		 require_once __SITEROOT."application/api/models/api_phs_common.php";
	}
	public function ws_region_selectAction(){
		require_once(__SITEROOT.'application/api/models/api_system_region.php');		
		$server = new SoapServer(__SITEROOT.'wsdl/api_system_region.wsdl');
		$server->setClass('api_system_region');		      
        $server->handle();   
        $api_system_region = new api_system_region();
        /*$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables>
        <table name='region'>
        <row>
        <org_id>5105005</org_id>
        </row>
        </table>
        </tables>";
        echo $api_system_region->ws_region_register_get_all_region_info('1',$xml_string);
        exit();*/
       /* $xml_string="<?xml version='1.0' encoding='UTF-8'?><tables>
        <table name='region'>
	        <row>
		        <org_id>sm0234</org_id>
		        <standard_code_path>0,100000,510000,511800,511824,001,001,09</standard_code_path>
		        <zh_name>一X组</zh_name>
		        <standard_code>03</standard_code>
	        </row>
	        <row>
		        <org_id>sm0234</org_id>
		        <standard_code_path>0,100000,510000,511800,511824,001,001,02</standard_code_path>
		        <zh_name>X二组</zh_name>
		        <standard_code>04</standard_code>
	        </row>
        </table>
        </tables>";
       echo $api_system_region->ws_region_register_set_region_info('1',$xml_string);   */
	}
	public function ws_region_resultAction(){
		$soapclient = new SoapClient('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/wsdl/api_system_region.wsdl');
	}
	/**
	 * 用于生成wsdl
	 *
	 */
	public function generate_wsdlAction(){
		$class_name='api_system_region';
		require_once(__SITEROOT."application/api/models/".$class_name.".php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($class_name,$class_name,"/api/regioninfo/ws_region_select");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.'wsdl/'.$class_name.'.wsdl',"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}	
	public function testAction()
	{
		$soapclient = new SoapClient(__SITEROOT.'wsdl/api_system_region.wsdl');
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='region'><row><org_id>51050051</org_id><org_id>00887943-2</org_id><org_id>454664</org_id></row></table></tables>";
		echo $soapclient->ws_region_register_get_all_region_info('1',$xml_string);
	}
	public function registerAction()
	{
		$soapclient = new SoapClient(__SITEROOT.'wsdl/api_system_region.wsdl');
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables>
        <table name='region'>
	        <row>
		        <org_id>sm0234</org_id>
		        <standard_code_path>0,100000,510000,511800,511824,001,001,09</standard_code_path>
		        <zh_name>一X组</zh_name>
		        <standard_code>03</standard_code>
	        </row>
	        <row>
		        <org_id>sm0234</org_id>
		        <standard_code_path>0,100000,510000,511800,511824,001,001,02</standard_code_path>
		        <zh_name>X二组</zh_name>
		        <standard_code>04</standard_code>
	        </row>
        </table>
        </tables>";
		echo $soapclient->ws_region_register_set_region_info('1',$xml_string);
	}
}
?>