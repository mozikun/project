<?php
/**
 * @author whx
 *
 */
class api_hisdoctorController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_his_doctor.php");

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
		require_once(__SITEROOT."application/api/models/api_his_doctor.php");//model
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
	public function testAction()
	{      
                
		$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);	
		
		$tmp=$client->zuozhen_info("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>17</org_id></where>"); 
 		echo $tmp;
 	
	}
	
	
	public function insertAction()
	{      
                
		$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);	
		
		$tmp=$client->doctor_insert("<?xml version='1.0' encoding='UTF-8'?><doctor_info><org_id>45256445651182412C2201</org_id><org_name>雅安市石棉县新棉镇卫生院</org_name><doctor_code>smxmz015</doctor_code><doctor_name>周勇</doctor_name><identity_number></identity_number></doctor_info>"
); 
 		echo $tmp;
 	
	}
	
	public function updateAction()
	{      
                
		$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);	
		
		$tmp=$client->doctor_update("<?xml version='1.0' encoding='UTF-8'?><doctor_info><uuid>5</uuid><org_id>10</org_id><org_name>南郊乡卫生院</org_name><doctor_code>1212</doctor_code><doctor_name>小强</doctor_name><identity_number>5110251988061224223</identity_number><flag>1</flag></doctor_info>"); 
 		echo $tmp;
 	
	}
	public function selectAction()
	{                
		$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);	
		
		$tmp=$client->doctor_select("<?xml version='1.0' encoding='UTF-8'?><doctor_info><uuid>5</uuid><org_id>10</org_id><org_name>南郊乡卫生院</org_name><doctor_code>smxmz003</doctor_code><doctor_name>小强</doctor_name><identity_number>5110251988061224223</identity_number><flag>1</flag></doctor_info>"); 
 		echo $tmp;
 	
	}
	public function deleteAction()
	{                
		$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);	
		
		$tmp=$client->doctor_delete("<?xml version='1.0' encoding='UTF-8'?><doctor_info><uuid>5</uuid><org_id>10</org_id><org_name>南郊乡卫生院</org_name><doctor_code>1212</doctor_code><doctor_name>小强</doctor_name><identity_number>5110251988061224223</identity_number><flag>1</flag></doctor_info>"); 
 		echo $tmp;
 	
	}
}
?>