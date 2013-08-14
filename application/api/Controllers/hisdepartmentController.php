<?php
/**
 * @author whx
 * @todo  科室表接口测试
 * @time  2012-11-14
 */
class api_hisdepartmentController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_his_department.php");

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
	public function make_wsdlAction()
	{       
		$classname=parent::getControllerName();
		require_once(__SITEROOT."application/api/models/api_his_department.php");//model
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($classname,"wsdl_".$classname,"/api/".$classname."/index");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.$this->wsdl_path,"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}

	//添加科室
	public function ws_insertAction()
	{      
            
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$client->ws_insert("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<uuid>1</uuid>
			<status_flag>1</status_flag>
			<org_id>111111-1</org_id>
			<department_name>金胜科</department_name>
			<sort_number>1</sort_number>
			<p_id>1</p_id>
		</where>"); 
 		echo $tmp;
 	
	}
	
	//修改科室
	public function ws_updateAction()
	{      
            
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$client->ws_update("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<uuid>1</uuid>
			<status_flag>1</status_flag>
			<org_id>111111-1</org_id>
			<department_name>神经外科</department_name>
			<sort_number>1</sort_number>
			<p_id>1</p_id>
		</where>"); 
 		echo $tmp;
 	
	}
	
	//科室查询
	public function ws_selectAction()
	{      
            
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$client->ws_select("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<org_id>45254011251180211A1001</org_id>
		</where>"); 
 		echo $tmp;
 	
	}
	
	//删除科室
	public function ws_deleteAction()
	{      
            
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$client->ws_delete("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<uuid>1</uuid>
			<org_id>111111-1</org_id>
		</where>"); 
 		echo $tmp;
 	
	}
	
	
}
?>