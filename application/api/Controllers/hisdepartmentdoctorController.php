<?php
/**
 * @author whx
 * @todo  医生科室测试
 
 */
class api_hisdepartmentdoctorController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_his_departmentdoctor.php");
		$SoapServer = new SoapServer("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path.$this->wsdl_path);
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
		require_once(__SITEROOT."application/api/models/api_his_departmentdoctor.php");//model
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($classname,"wsdl_".$classname,"/api/".$classname."/index");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.$this->wsdl_path,"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}

	
	
	//添加信息
	public function ws_insertAction()
	{      
            
		$departmentdoctor=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$departmentdoctor->ws_insert("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<department_id>2</department_id>
			<doctor_id>1</doctor_id>
			<default_id>1</default_id>
			
		</where>"); 
 		echo $tmp;
 	
	}
	
	

	
	//查询
	
	public function ws_selectAction()
	{      
        
		$departmentdoctor=new SoapClient(__SITEROOT.$this->wsdl_path);	
		$tmp=$departmentdoctor->ws_select(); 
 		echo $tmp;
 	
	}
	
}
?>