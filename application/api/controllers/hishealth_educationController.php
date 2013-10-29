<?php
/**
 * @author whx
 * @todo   健康教育活动
 */
class api_hishealth_educationController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_his_health_education.php");
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
		require_once(__SITEROOT."application/api/models/api_his_health_education.php");//model
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
			<staff_id>513101198204020021</staff_id>
			<org_id>45254011251180211A1001</org_id>
			<activity_time>1361836800</activity_time>
			<activity_address>上甘岭</activity_address>
			<activity_type>1</activity_type>
			<sponsor>小强</sponsor>
			<partner>小强公司</partner>
			<person_num>200</person_num>
			<promo_type>1</promo_type>
			<promo_num>1</promo_num>
			<activity_theme>活动主题</activity_theme>
			<activity_summary>活动小结</activity_summary>
			<activity_juggde>活动评价</activity_juggde>
			<more_info>存档材料</more_info>
			<person_in_charge>513101198204020021</person_in_charge>
			<person_category>农民</person_category>
			<people_fillin_form>513101198204020021</people_fillin_form>
			<ext_uuid>1-1</ext_uuid>	
		</where>"); 
 		echo $tmp;
 	 
	}
	
	//修改
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
	
	//科室
	public function ws_selectAction()
	{      
            
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$client->ws_select("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<org_id>45254011251180211A1001</org_id>
		</where>"); 
 		echo $tmp;
 	
	}
	
	//删除
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