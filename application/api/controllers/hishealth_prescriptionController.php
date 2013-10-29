<?php
/**
 * @author whx
 * @todo   健康教育处方
 */
class api_hishealth_prescriptionController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_his_health_prescription.php");
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
		require_once(__SITEROOT."application/api/models/api_his_health_prescription.php");//model
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($classname,"wsdl_".$classname,"/api/".$classname."/index");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.$this->wsdl_path,"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}

	//添加
	public function ws_insertAction()
	{      
       
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		$tmp=$client->ws_insert("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<org_id>45254011251180211A1001</org_id>
			<add_time>12345454545</add_time>
			<title>1</title>
			<content>加适量的经费落实的经费市劳动局</content>
			<doctor_id>513101198204020021</doctor_id>
			<ext_uuid>".uniqid()."</ext_uuid>
		</where>"); 
 		echo $tmp;
 	
	}
	
	//修改
	public function ws_updateAction()
	{      
            
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$client->ws_update("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<org_id>45254011251180211A1001</org_id>
			<add_time>12345454545</add_time>
			<title>sjdflsdjflsdjfldddd</title>
			<content>dfsdfdddddddddddddddddddddd</content>
			<doctor_id>513101198204020021</doctor_id>
			<ext_uuid>1</ext_uuid>
		</where>"); 
 		echo $tmp;
 	
	}
	
	//查询
	public function ws_selectAction()
	{      
            
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$client->ws_select("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<org_id>45254011251180211A1001</org_id>
			<ext_uuid>1</ext_uuid>
		</where>"); 
 		echo $tmp;
 	
	}
	
	//删除
	public function ws_deleteAction()
	{      
            
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$client->ws_delete("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<ext_uuid>1</ext_uuid>
		</where>"); 
 		echo $tmp;
 	
	}
	
	
}
?>