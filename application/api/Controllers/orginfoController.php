<?php
class api_orginfoController extends controller {
	public function initAction(){
		 require_once __SITEROOT."application/api/models/api_phs_common.php";
	}
	public function ws_org_selectAction(){
		require_once(__SITEROOT.'application/api/models/api_system_org.php');		
		$server = new SoapServer(__SITEROOT.'wsdl/api_system_org.wsdl');
		$server->setClass('api_system_org');		      
        $server->handle();   
        $api_system_organization = new api_system_org();
        /* $xml_string="<?xml version='1.0' encoding='UTF-8'?>
        <organizations>
	        <organization>
	          <org_id>222333</org_id>
	        </organization>	     
	        <organization>
	          <org_id>222111</org_id>
	        </organization>     
        </organizations>"
        ;
         echo $api_system_organization->ws_del_org_info('1',$xml_string);
        exit();
        
       /* $xml_string="<?xml version='1.0' encoding='UTF-8'?>
        <organizations>
	        <organization>
	          <org_id>222333</org_id>
	          <org_zh_name>雨城区测试机构2更新</org_zh_name>
	          <org_type>2</org_type>
	          <org_password>111111</org_password>
	        </organization>	     
	        <organization>
	          <org_id>222111</org_id>
	          <org_zh_name>雨城区测试机构1更新</org_zh_name>
	          <org_type>2</org_type>
	          <org_password>111111</org_password>
	        </organization>     
        </organizations>"
        ;
         echo $api_system_organization->ws_update_org_info('1',$xml_string);
        exit();
       /* $xml_string="<?xml version='1.0' encoding='UTF-8'?>
        <region>
          <region_standard_code>511802</region_standard_code>
          <organizations>
             <organization>
              <org_zh_name>雨城区测试机构1</org_zh_name>
	          <org_id>222111</org_id>
	          <password>123</password>
	          <org_type>2</org_type>
	          <ext_uuid>323243435353535355</ext_uuid>
	         </organization>
	         <organization>
	          <org_zh_name>雨城区测试机构2</org_zh_name>
	          <org_id>222333</org_id>
	          <password>123</password>
	          <org_type>1</org_type>
	          <ext_uuid>323243435353535355</ext_uuid>
	         </organization>
          </organizations>
        </region>";
        echo $api_system_organization->ws_set_org_info('1',$xml_string);
        exit();
      /* $api_system_organization = new api_system_org();
        $xml_string="<?xml version='1.0' encoding='UTF-8'?><tables>
        <table name='organization'>
        <row>
        <org_id>cb000000</org_id>
        </row>
        </table>
        </tables>";
        echo $api_system_organization->ws_get_org_info('1',$xml_string);
        exit();
        */
        /*$api_system_organization = new api_system_org();
        $xml_string="<?xml version='1.0' encoding='UTF-8'?><tables>
        <table name='organization'>
        <row>
        <org_id>cb000000</org_id>
        </row>
        <row>
        <org_id>511804201</org_id>
        </row>
        </table>
        </tables>";
        echo $api_system_organization->ws_org_register_get_info('1',$xml_string);
        exit();
        */
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
	public function ws_org_resultAction(){
		$soapclient = new SoapClient('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/wsdl/api_system_org.wsdl');
	}
	/**
	 * 用于生成wsdl
	 *
	 */
	public function generate_wsdlAction(){
		$class_name='api_system_org';
		require_once(__SITEROOT."application/api/models/".$class_name.".php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($class_name,$class_name,"/api/orginfo/ws_org_select");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.'wsdl/'.$class_name.'.wsdl',"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}	
	public function testAction()
	{
		$soapclient = new SoapClient(__SITEROOT.'wsdl/api_system_org.wsdl');
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables>
        <table name='organization'>
        <row>
        <org_id>cb000000</org_id>
        </row>
        <row>
        <org_id>511804201</org_id>
        </row>
        </table>
        </tables>";
		echo $soapclient->ws_org_register_get_info('1',$xml_string);
	}
}
?>