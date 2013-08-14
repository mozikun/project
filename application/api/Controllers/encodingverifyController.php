<?php
class api_encodingverifyController extends controller {
	public function initAction(){
	}
	public function indexAction(){
		require_once(__SITEROOT.'application/api/models/api_phs_verify.php');	
		$server = new SoapServer(__SITEROOT.'wsdl/api_phs_verify.wsdl');
		$server->setClass('api_phs_verify');		      
        $server->handle();    
        /*
        $api_phs_verify = new api_phs_verify();  
        $xml_string ="<?xml version='1.0' encoding='UTF-8'?>
        <tables>
          <table name='medicine'> 
                <row>
                  <standard_code>01010100038</standard_code>
                </row>
                <row>
                   <standard_code>01010100041</standard_code>
                </row>
                <row>
                   <standard_code>01010100039</standard_code>
                </row>
          </table>
          <table name='disease_name'>
                <row>
                  <standard_code>Z98.8412</standard_code>
                </row>
                <row>
                  <standard_code>Z98.8417</standard_code>
                </row>
          </table>
           <table name='materials'>
                <row>
                 <standard_code>110016408531011</standard_code>
                </row>
                <row>
                 <standard_code>110021108531011</standard_code>
                </row>
          </table>
          <table name='clinic_code'>
                <row>
                 <standard_code>A01010A0002</standard_code>
                </row>
                <row>
                 <standard_code>A01010B0001</standard_code>
                </row>
          </table>
        </tables>
        ";
        echo $api_phs_verify->ws_verify('1',$xml_string);
        */
	}
	public function ws_diabetes_resultAction(){
		$soapclient = new SoapClient('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/wsdl/api_phs_verify.wsdl');
	}
	public function generate_wsdlAction(){
		$class_name='api_phs_verify';
		require_once(__SITEROOT."application/api/models/".$class_name.".php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($class_name,$class_name,__BASEPATH."api/encodingverify/index");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.'wsdl/'.$class_name.'.wsdl',"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}	
}
?>