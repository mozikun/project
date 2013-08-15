<?php
class api_phscardstatusController extends controller {
	public function initAction(){
	}
	public function indexAction(){
		require_once(__SITEROOT.'application/api/models/api_phs_iha_card_status.php ');		
		$server = new SoapServer(__SITEROOT.'wsdl/api_phs_iha_card_status.wsdl');
		$server->setClass('api_phs_iha_card_status');		      
                                      $server->handle();
                                      $et = new api_phs_iha_card_status();
     /* $xml_string = "<?xml version='1.0' encoding='UTF-8'?> 
<table name='iha_card_status'> 
<row> 
<staff_id>510824198308190834</staff_id> 
<identity_number>513101196709162114</identity_number> 
<department_id>22 </department_id> 
<department_name>五官科</department_name> 
<actions>正在ct室</actions > 
<status>2</status> 
<org_id>54254047451180212C2201</org_id> 
<serial_number>222222</serial_number>
<ext_uuid>4444444444444</ext_uuid> 
</row> 
<row> 
<staff_id>510824198308190833</staff_id> 
<identity_number>513101196801031811</identity_number> 
<department_id>23 </department_id> 
<department_name >放射科</department_name > 
<actions>正在X光室</actions > 
<status>3</status> 
<org_id>55667788-9</org_id> 
<ext_uuid>3333333</ext_uuid> 
<serial_number>11111</serial_number>
</row> 
</table> 
";
     echo $et->ws_update('1',$xml_string);
 */
	}
	public function ws_card_resultAction(){
		$soapclient = new SoapClient('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/wsdl/api_phs_iha_card_status.wsdl');

	}
	/**
	 * 用于生成wsdl
	 *
	 */
	public function generate_wsdlAction(){
		$class_name='api_phs_iha_card_status';
		require_once(__SITEROOT."application/api/models/".$class_name.".php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($class_name,$class_name,__BASEPATH."api/phscardstatus/index");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.'wsdl/'.$class_name.'.wsdl',"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}	
	
}
?>