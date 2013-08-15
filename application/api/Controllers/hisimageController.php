<?php
class api_hisimageController extends controller 
{
	private $wsdl_path;
	public function init()
	{
		$this->wsdl_path="wsdl/his_image.wsdl";;
	}
	/**
	 * api接口地址
	 *
	 */
	public function indexAction()
	{
		require_once(__SITEROOT."application/api/models/api_his_image.php");
		$SoapServer = new SoapServer(__SITEROOT.$this->wsdl_path);
		$SoapServer->setClass('api_his_image');
		$SoapServer->handle();
	}
	/**
	 * 用于生成wsdl
	 *
	 */
	public function generate_wsdlAction()
	{
		$classname='api_his_image';
		require_once(__SITEROOT."application/api/models/api_his_image.php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($classname,"wsdl_".$classname,"/api/hisimage/index");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.$this->wsdl_path,"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}
    /**
     * api_phsmaindexController::ws_testAction()
     * 
     * 用于测试
     * 
     * @return void
     */
    public function ws_testAction()
    {
        require_once(__SITEROOT."application/api/models/api_his_image.php");
       	$client=new api_his_image();
        echo $client->ws_update("17","<?xml version='1.0' encoding='UTF-8'?><table name='his_image_info'>
<row>
<identity_number>511027198109044213</identity_number>
<org_id>511802104</org_id>
<staff_id>510103199901010001</staff_id>
<img_thumb>1313971200</img_thumb>
<img_url>ssssssddddddd</img_url>
<serial_number>201301101122</serial_number>
<ext_uuid>111222333444555</ext_uuid>
</row>
</table>
");
    }
 }
 ?>