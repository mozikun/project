<?php
class api_wsdlController extends controller 
{
	public function init()
	{
		
	}
	public function indexAction()
	{
		$wsdl_path="wsdl/wsdl.wsdl";
		require_once(__SITEROOT."application/api/models/api_wsdl.php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		if (!file_exists($wsdl_path)) 
		{
			$disco = new SoapDiscovery('haoben','wsdl_haoben','/api/wsdl/index');
			$xml_file=$disco->getWSDL();
			$fp=fopen(__SITEROOT.$wsdl_path,"w+");
			fputs($fp,$xml_file);
			fclose($fp);
		}
		$servidorSoap = new SoapServer('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/'.$wsdl_path);
		$servidorSoap->setClass('haoben');
		$servidorSoap->handle();
	}
	public function ws_testAction()
	{
		$client = new SoapClient('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/'."wsdl/wsdl.wsdl");

		try {
		        $result = $client->ws_haoben('test_haoben');
				var_dump($result);
		        echo "The answer isresult";
		}
		catch (SoapFault $f){
		        echo "Error Message: {$f->getMessage()}";
		}
	}
}
?>