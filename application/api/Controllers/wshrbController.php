<?php
class api_wshrbController  extends controller {

	public function indexAction(){
		
		require_once(__SITEROOT."application/api/models/update_hrb03_02.php");
		
		$wsdl="d:/works/update_hrb03_02.wsdl";
		
		$server1=new SoapServer(null, array('uri' => "yawsw"));
		$server1->addFunction(array("update_hrb03_02"));
		//$server->addFunction(SOAP_FUNCTIONS_ALL);
		//print_r($server1->getFunctions());
		$server1->handle();
	  	//update_hrb03_02();
	}



}
