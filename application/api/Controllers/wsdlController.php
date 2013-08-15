<?php
class api_wsdlController extends controller 
{
	public function init()
	{
		
	}
    /**
     * api_wsdlController::wsdlAction()
     * 
     * 用于遍历所有接口并生成wsdl
     * 
     * 我好笨
     * 
     * @return void
     */
    public function wsdlAction()
    {
        set_time_limit(0);
        $path=dirname(__FILE__);
        if (is_dir($path))
    	{
    		if ($path!='.' && $path!='..')
    		{
    			$d=opendir($path);
    			if ($d)
    			{
    				while (false!==($file=readdir($d)))
    				{
    					if ($file!='.' && $file!='..')
    					{
    					    $filename=str_replace("Controller.php",'',$file);
    						file_get_contents('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/api/'.$filename.'/generate_wsdl');
                            echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/api/'.$filename.'/generate_wsdl<br />';
    					}
    				}
    				closedir($d);
    			}
    		}
    	}
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