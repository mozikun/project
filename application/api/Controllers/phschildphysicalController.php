<?php
/**
 * @author mask
 * @todo  用于1岁以内健康检查接口
 */
class api_phschildphysicalController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_phs_childphysical.php");
		/*
		$client=new phschildphysical();
		$xml_string="<?xml version='1.0' encoding='UTF-8'?>
		<tables><table name='child_physical'>
		<row><identity_number>510100201107091189</identity_number><staff_id>511025198711202222</staff_id><created>1321842032</created><project>1</project><vist_time>1321833600</vist_time><weight>20</weight><weight_info>上</weight_info><height></height><height_info></height_info><complexion>2</complexion><skin></skin><bregma></bregma><bregma_width></bregma_width><bregma_height></bregma_height><eye></eye><ear></ear><number_of_teeth></number_of_teeth><heart_lung></heart_lung><abdomen></abdomen><umbilical_region></umbilical_region><limb></limb><gait></gait><rickets_symptom></rickets_symptom><rickets_signs></rickets_signs><gmzz>1</gmzz><hemoglobin></hemoglobin><field_sport></field_sport><vitamin_d></vitamin_d><developmental_assessment></developmental_assessment><between_and_vist_time></between_and_vist_time><other></other><referral_features></referral_features><reason></reason><agencies_departments></agencies_departments><advising></advising><advising_other></advising_other><next_followup_time>1321833600</next_followup_time><doctors_signature>4c7333276f141</doctors_signature><head_size></head_size><cervical_mass></cervical_mass><hearing></hearing><oralcavity>1</oralcavity><ext_uuid>1</ext_uuid><org_id>888888</org_id></row>
		<row><identity_number>510100201107091189</identity_number><staff_id>511025198711202222</staff_id><created>1321842032</created><project>2</project><vist_time>1321833600</vist_time><weight>20</weight><weight_info>上</weight_info><height></height><height_info></height_info><complexion>2</complexion><skin></skin><bregma></bregma><bregma_width></bregma_width><bregma_height></bregma_height><eye></eye><ear></ear><number_of_teeth></number_of_teeth><heart_lung></heart_lung><abdomen></abdomen><umbilical_region></umbilical_region><limb></limb><gait></gait><rickets_symptom></rickets_symptom><rickets_signs></rickets_signs><gmzz>1</gmzz><hemoglobin></hemoglobin><field_sport></field_sport><vitamin_d></vitamin_d><developmental_assessment></developmental_assessment><between_and_vist_time></between_and_vist_time><other></other><referral_features></referral_features><reason></reason><agencies_departments></agencies_departments><advising></advising><advising_other></advising_other><next_followup_time>1321833600</next_followup_time><doctors_signature>4c7333276f141</doctors_signature><head_size></head_size><cervical_mass></cervical_mass><hearing></hearing><oralcavity>2</oralcavity><ext_uuid>2</ext_uuid><org_id>888888</org_id></row>
		</table></tables>";
		$tmp=$client->ws_update('17',$xml_string);
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
		require_once(__SITEROOT."application/api/models/api_phs_childphysical.php");//model
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
		$tmp=$client->ws_select_single("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>888888</org_id><identity_number>510100201107091189</identity_number><ext_uuid>1</ext_uuid></where>"); 
	    echo $tmp;
	}
}
?>