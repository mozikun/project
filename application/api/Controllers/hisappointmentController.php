<?php
/**
 * @author whx
 * @todo  预约挂号信息
 * @time  2012-11-15
 */
class api_hisappointmentController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_his_appointment.php");
		$SoapServer = new SoapServer(__SITEROOT.$this->wsdl_path);
		$SoapServer->setClass(parent::getControllerName());
		$SoapServer->handle();
				
	}
	/**
	 * 用于生成wsdl
	 *
	 */
	public function make_wsdlAction()
	{       
		$classname=parent::getControllerName();
		require_once(__SITEROOT."application/api/models/api_his_appointment.php");//model
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
	public function ws_selectAction()
	{     
             
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		 
		$tmp=$client->ws_select("17","<?xml version='1.0' encoding='UTF-8'?><where><id>6</id></where>"); 
 		echo $tmp;
 	
	}
     public function ws_updateAction(){   
        $client=new SoapClient(__SITEROOT.$this->wsdl_path);	   
         $tmp=$client->ws_update("17","<?xml version='1.0' encoding='UTF-8'?><where>
			 <id>6</id>
             <org_id>17</org_id>   
             <doctor_id>4fa786d6a037e9.94213224</doctor_id>   
             <name>zhangsan</name>   
             <identity_number>51102519123456789</identity_number>   
             <gender>女</gender>   
             <age>10</age>   
             <register_date>2012-1-19</register_date>   
             <register_time>1</register_time>   
             <department_id>509c9a6b2625d</department_id>   
             <clinic_id>509c9b0f9896b</clinic_id>   
             <number_species_id>509c9b6e9c674</number_species_id>   
             <status>1</status>   
             </where>");   
 	echo $tmp;	
     }
	public function ws_select_detailAction()
	{     
             
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		 
		$tmp=$client->ws_select_detail("17","<?xml version='1.0' encoding='UTF-8'?><where><identity_number>510724199108074010</identity_number></where>"); 
 		echo $tmp;
 	
	}
}
?>