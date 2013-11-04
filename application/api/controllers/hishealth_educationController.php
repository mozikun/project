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
       // require_once(__SITEROOT."application/api/models/api_his_health_education.php");//model
		//$he=new hishealth_education();
		//$he->ws_insert();
		
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=	$client->ws_insert("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<staff_id>513101198204020021</staff_id>			           <!--医生身份证号-->
			<org_id>45254011251180211A1001</org_id>	                   <!--机构编码-->	
			<activity_time>1361836800</activity_time>				   <!--活动时间-->	
			<activity_address>石棉社区</activity_address>			   <!--活动地点-->	
			<activity_type>1|2|3|4</activity_type>					   <!--活动类型-->	
			<sponsor>主办单位</sponsor>								   <!--主办单位-->	
			<partner>合作伙伴</partner>		                           <!--合作伙伴-->	
			<person_num>200</person_num>							   <!--参与人数-->				
			<promo_type>1</promo_type>								   <!--宣传品发放种类-->	
			<promo_num>1</promo_num>								   <!--宣传品发放数量-->	
			<activity_theme>活动主题</activity_theme>				   <!--活动主题-->	
			<active_summary>活动小结</active_summary>				   <!--活动小结-->	
			<activity_juggde>活动评价</activity_juggde>				   <!--活动评价-->	
			<more_info>1|2|4</more_info>							   <!--存档材料类型以”|“分割 如：1 或者1|2|3-->
			<person_in_charge>513101198204020021</person_in_charge>    <!--负责人身份证号-->
			<person_category>社区居民</person_category>				   <!--接受健康教育人员类别-->	
			<people_fillin_form>513101198204020021</people_fillin_form><!--填表医生身份证号-->
			<doctor>宣教人</doctor>									   <!--宣教人-->		
			<created>1361836800</created>							   <!--填表时间-->  	
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
			<org_id>45254011251180211A1001</org_id>	                   <!--机构编码-->	
			<activity_time>1361836800</activity_time>				   <!--活动时间-->	
			<activity_address>石棉社区</activity_address>			   <!--活动地点-->	
			<activity_type>1|2|3|4</activity_type>					   <!--活动类型-->	
			<sponsor>主办单位</sponsor>								   <!--主办单位-->	
			<partner>合作伙伴</partner>		                           <!--合作伙伴-->	
			<person_num>200</person_num>							   <!--参与人数-->				
			<promo_type>1</promo_type>								   <!--宣传品发放种类-->	
			<promo_num>1</promo_num>								   <!--宣传品发放数量-->	
			<activity_theme>活动主题</activity_theme>				   <!--活动主题-->	
			<active_summary>活动小结</active_summary>				   <!--活动小结-->	
			<activity_juggde>活动评价</activity_juggde>				   <!--活动评价-->	
			<more_info>1|2|4</more_info>							   <!--存档材料类型以”|“分割 如：1 或者1|2|3-->
			<person_in_charge>513101198204020021</person_in_charge>    <!--负责人身份证号-->
			<person_category>社区居民</person_category>				   <!--接受健康教育人员类别-->	
			<people_fillin_form>513101198204020021</people_fillin_form><!--填表医生身份证号-->
			<doctor>宣教人</doctor>									   <!--宣教人-->		
			<created>1361836800</created>							   <!--填表时间-->  	
			<ext_uuid>1-1</ext_uuid>	                               <!--外部主键-->
		</where>"); 
		
 		echo $tmp;
 	
	}
	
	
	
	//查询
	public function ws_selectAction()
	{      
     //require_once(__SITEROOT."application/api/models/api_his_health_education.php");//model    
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		//$he=new hishealth_education();
		$tmp=$client->ws_select("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			
			<ext_uuid>1-1</ext_uuid>
		</where>"); 
 		echo $tmp;
 	
	}
	
	//删除
	public function ws_deleteAction()
	{      
            
		$client=new SoapClient(__SITEROOT.$this->wsdl_path);	
		
		$tmp=$client->ws_delete("17","<?xml version='1.0' encoding='UTF-8'?>
		<where>
			<ext_uuid>1-1</ext_uuid>
		</where>"); 
 		echo $tmp;
 	
	}
	
	
}
?>