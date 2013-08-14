<?php
/**
 * @author mask
 * @todo  用于3~6岁儿童健康检查接口
 */
class api_phschildphysicalthreeController extends controller 
{
	private $wsdl_path;
	public function init()
	{
		$this->wsdl_path="wsdl/api_phs_".parent::getControllerName().".wsdl";
	}
	/**
	 * api接口地址
	 *
	 */
	public function indexAction()
	{
		require_once(__SITEROOT."application/api/models/api_phs_childphysicalthree.php");	
		/*
		$client=new phschildphysicalthree();
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables>
		<table name='child_physical_age_three'>
		<row><identity_number>510100201107091189</identity_number><staff_id>511025198711202222</staff_id><created>1321925005</created><vist_time>1321920000</vist_time><weight>20</weight><weight_info></weight_info><height></height><height_info></height_info><developmental_assessment></developmental_assessment><complexion></complexion><complexion_info></complexion_info><gait></gait><gait_info></gait_info><eye></eye><eye_info></eye_info><ear></ear><ear_info></ear_info><heart_lung>1</heart_lung><heart_lung_info></heart_lung_info><hepatosplenography></hepatosplenography><hepatosplenography_info></hepatosplenography_info><behavior></behavior><behavior_info></behavior_info><social></social><social_info></social_info><prevalence_infancy></prevalence_infancy><pneumonia></pneumonia><diarrhea_in_hospitalized></diarrhea_in_hospitalized><the_patient></the_patient><prevalence_infancy_other></prevalence_infancy_other><allergic_history></allergic_history><allergic_history_info></allergic_history_info><other></other><referral_features></referral_features><reason></reason><agencies_departments></agencies_departments><advising></advising><advising_other></advising_other><doctors_signature>4c7333276f141</doctors_signature><age>9</age><sight></sight><hearing>1</hearing><number_of_teeth></number_of_teeth><number_of_caries></number_of_caries><abdomen></abdomen><hemoglobin></hemoglobin><next_followup_time>1353542400</next_followup_time><ext_uuid>1</ext_uuid><org_id>888888</org_id></row>
		<row><identity_number>510100201107091189</identity_number><staff_id>511025198711202222</staff_id><created>1321925005</created><vist_time>1321920000</vist_time><weight>20</weight><weight_info></weight_info><height></height><height_info></height_info><developmental_assessment></developmental_assessment><complexion></complexion><complexion_info></complexion_info><gait></gait><gait_info></gait_info><eye></eye><eye_info></eye_info><ear></ear><ear_info></ear_info><heart_lung>1</heart_lung><heart_lung_info></heart_lung_info><hepatosplenography></hepatosplenography><hepatosplenography_info></hepatosplenography_info><behavior></behavior><behavior_info></behavior_info><social></social><social_info></social_info><prevalence_infancy></prevalence_infancy><pneumonia></pneumonia><diarrhea_in_hospitalized></diarrhea_in_hospitalized><the_patient></the_patient><prevalence_infancy_other></prevalence_infancy_other><allergic_history></allergic_history><allergic_history_info></allergic_history_info><other></other><referral_features></referral_features><reason></reason><agencies_departments></agencies_departments><advising></advising><advising_other></advising_other><doctors_signature>4c7333276f141</doctors_signature><age>10</age><sight></sight><hearing>1</hearing><number_of_teeth></number_of_teeth><number_of_caries></number_of_caries><abdomen></abdomen><hemoglobin></hemoglobin><next_followup_time>1353542400</next_followup_time><ext_uuid>2</ext_uuid><org_id>888888</org_id></row>
		</table></tables>";
		$tmp=$client->ws_update('17',$xml_string);
		echo $tmp;
		exit();	
		*/
		$SoapServer = new SoapServer(__SITEROOT.$this->wsdl_path);
		$SoapServer->setClass(parent::getControllerName());
		$SoapServer->handle();
		
		/*
		$phschildphysicalthree=new phschildphysicalthree();
		$phschildphysicalthree->ws_delete("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>888888</org_id><identity_number>510100201107091189</identity_number><ext_uuid>1</ext_uuid><age>10</age></where>"); 
 		*/
		
	}
	/**
	 * 用于生成wsdl
	 *
	 */
	public function generate_wsdlAction()
	{
		$classname=parent::getControllerName();
		require_once(__SITEROOT."application/api/models/api_phs_childphysicalthree.php");//model
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
	public function ws_testAction()
	{
		$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);
		
		//查询
		$tmp=$client->ws_select_single("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>888888</org_id><identity_number>510100201107091189</identity_number><ext_uuid>1</ext_uuid><age>9</age></where>"); 
	    
		/**
		//更新
 		$tmp=$client->ws_update("17","<?xml version='1.0' encoding='UTF-8'?><tables><table name='child_physical_age_three'><row><identity_number>510100201107091189</identity_number><staff_id>511025198711202222</staff_id><created>1321925005</created><vist_time>1321920000</vist_time><weight>20</weight><weight_info></weight_info><height></height><height_info></height_info><developmental_assessment></developmental_assessment><complexion></complexion><complexion_info></complexion_info><gait></gait><gait_info></gait_info><eye></eye><eye_info></eye_info><ear></ear><ear_info></ear_info><heart_lung>1</heart_lung><heart_lung_info></heart_lung_info><hepatosplenography></hepatosplenography><hepatosplenography_info></hepatosplenography_info><behavior></behavior><behavior_info></behavior_info><social></social><social_info></social_info><prevalence_infancy></prevalence_infancy><pneumonia></pneumonia><diarrhea_in_hospitalized></diarrhea_in_hospitalized><the_patient></the_patient><prevalence_infancy_other></prevalence_infancy_other><allergic_history></allergic_history><allergic_history_info></allergic_history_info><other></other><referral_features></referral_features><reason></reason><agencies_departments></agencies_departments><advising></advising><advising_other></advising_other><doctors_signature>4c7333276f141</doctors_signature><age>10</age><sight></sight><hearing>1</hearing><number_of_teeth></number_of_teeth><number_of_caries></number_of_caries><abdomen></abdomen><hemoglobin></hemoglobin><next_followup_time>1353542400</next_followup_time><ext_uuid>2</ext_uuid><org_id>888888</org_id></row></table></tables>");
		* 
		*/
		/*删除
		$tmp=$client->ws_delete("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>888888</org_id><identity_number>510100201107091189</identity_number><ext_uuid>2</ext_uuid><age>10</age></where>"); 
 		*/
		echo $tmp;
	}
}
?>