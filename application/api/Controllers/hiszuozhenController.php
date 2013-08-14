<?php
/**
 * @author whx
 * @todo  坐诊信息接口测试
 * @time  2012-11-14
 */
class api_hiszuozhenController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_his_zuozhen.php");

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
		require_once(__SITEROOT."application/api/models/api_his_zuozhen.php");//model
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
		
		$tmp=$client->ws_select("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<org_id>45254011251180211A1001</org_id>
			<start_date>2013-7-17</start_date>
		   <user_id>51a45183ad4f0</user_id>
           <day>2</day>
			
			
			
		</where>"); 
 		echo $tmp;
 	
	}
	public function ws_updateAction()
	{      
            
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$client->ws_update("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<org_id>111111-1</org_id>
			<uuid>3sljdflsdjfls</uuid>
			<user_id>4c5bae3d977f7</user_id>
			<day>1</day>
			<register_num_total>100</register_num_total>
			<register_num_net>10</register_num_net>
			<registration_fee>5</registration_fee>
			<medical_fees>6</medical_fees>
			<fee>5</fee>
			<flag>1</flag>
			<consulting_time>2013-05-15</consulting_time>
			<department>1</department>
			<clinic>1</clinic>
			<number_species>1</number_species>
		</where>"); 
 		echo $tmp;
 	
	}
	
	
	public function ws_deleteAction()
	{      
            
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$client->ws_delete("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<user_id>4c5bae3d977f7</user_id>
			<consulting_time>2013-05-15</consulting_time>
		</where>"); 
 		echo $tmp;
 	
	}
	
}
?>