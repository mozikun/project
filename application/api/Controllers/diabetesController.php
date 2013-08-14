<?php
class api_diabetesController extends controller {
	public function initAction(){
	}
	public function ws_diabetesAction(){
		require_once(__SITEROOT.'application/api/models/api_cd_diabetes.php');	
		$server = new SoapServer(__SITEROOT.'wsdl/api_cd_diabetes.wsdl');
		$server->setClass('api_cd_diabetes');		      
        $server->handle();    
	}
	public function ws_diabetes_resultAction(){
		$soapclient = new SoapClient('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/wsdl/api_cd_diabetes.wsdl');
	}
	public function generate_wsdlAction(){
		$class_name='api_cd_diabetes';
		require_once(__SITEROOT."application/api/models/".$class_name.".php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($class_name,$class_name,"/api/diabetes/ws_diabetes");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.'wsdl/'.$class_name.'.wsdl',"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}	
	public function getresultAction(){
	  $soapclient = new SoapClient(__SITEROOT.'wsdl/api_cd_diabetes.wsdl');	
	  $token      = $soapclient->ws_login('511804201','1');			
	  $xml_string="<?xml version='1.0' encoding='UTF-8'?><where><org_id>511804201</org_id><identity_number>513101196912282322</identity_number><ext_uuid>4324234</ext_uuid></where>";
	  echo $soapclient->ws_select_single($token,$xml_string);
	}
    public function delAction(){
	  $soapclient = new SoapClient(__SITEROOT.'wsdl/api_cd_diabetes.wsdl');
	  $token      = $soapclient->ws_login('511804201','1');
	  $xml_string="<?xml version='1.0' encoding='UTF-8'?><where><org_id>511804201</org_id><identity_number>513101196912282322</identity_number><ext_uuid>4324234</ext_uuid></where>";
	  echo $soapclient->ws_delete($token,$xml_string);
    }
    public function updateAction(){
	  $soapclient = new SoapClient(__SITEROOT.'wsdl/api_cd_diabetes.wsdl');
	  $token      = $soapclient->ws_login('511804201','1');
	  $xml_string ="<?xml version='1.0' encoding='UTF-8'?><tables><table name='diabetes_core'><row><identity_number>513101196912282322</identity_number><staff_id>510824198308190834</staff_id><created>1321585782</created><followup_time>1321585782</followup_time><type_of_followup>2</type_of_followup><time_of_next_followup>1322755200</time_of_next_followup><compliance>2</compliance><adverse_drug_reaction>2</adverse_drug_reaction><reactive_hypoglycemia>3</reactive_hypoglycemia><followup_classification>3</followup_classification><followup_doctor>4c7333276d3c7</followup_doctor><followup_result>血糖控制不满意或出现药物不良反映,2周后进行随访。</followup_result><insulin>胰岛素3</insulin><insulin_class></insulin_class><ext_uuid>4324234</ext_uuid><org_id>511804201</org_id></row></table><table name='diabetes_lifestyle_guide'><row><identity_number>513101196912282322</identity_number><staff_id>510824198308190834</staff_id><created>1321585782</created><smoking>12</smoking><expert_smoking>11</expert_smoking><drinking>3</drinking><expert_drinking>4</expert_drinking><frequency>6</frequency><frequency_time>30</frequency_time><expert_frequency>5</expert_frequency><expert_frequency_time>30</expert_frequency_time><main_course>面1</main_course><expert_main_course>米</expert_main_course><heart_adjustment>2</heart_adjustment><complian>3</complian><ext_uuid>4324234</ext_uuid><org_id>511804201</org_id></row></table><table name='diabetes_patient_referral'><row><identity_number>513101196912282322</identity_number><staff_id>510824198308190834</staff_id><created>1321585782</created><reason>未知原因1</reason><organization>测试卫生院2</organization><ext_uuid>4324234</ext_uuid><org_id>511804201</org_id></row></table><table name='diabetes_physical_sign'><row><identity_number>513101196912282322</identity_number><staff_id>510824198308190834</staff_id><created>1321585782</created><blood_pressure>112</blood_pressure><weight>40</weight><expectative_weight>56</expectative_weight><bmi>1.3</bmi><arteria_dorsalis_pedis>1</arteria_dorsalis_pedis><other>手脚麻木1</other><diastolic_blood_pressure>150</diastolic_blood_pressure><bmi_next></bmi_next><ext_uuid>4324234</ext_uuid><org_id>511804201</org_id></row></table><table name='diabetes_symptom'><row><identity_number>513101196912282322</identity_number><staff_id>510824198308190834</staff_id><created>1321585782</created><diabetes_symptom>2|3|4|5|6</diabetes_symptom><symptom_other>手脚麻木1</symptom_other><ext_uuid>4324234</ext_uuid><org_id>511804201</org_id></row></table><table name='diabetes_accessory_examine'><row><identity_number>513101196912282322</identity_number><staff_id>510824198308190834</staff_id><created>1321585782</created><fasting_bloodglucose>5.4</fasting_bloodglucose><hbclc>12</hbclc><eamination_time>1323619200</eamination_time><eamination_info>111111</eamination_info><ext_uuid>4324234</ext_uuid><org_id>511804201</org_id></row></table><table name='follow_up_drugs'><row><identity_number>513101196912282322</identity_number><staff_id>510824198308190834</staff_id><created>1321585782</created><drug_name>土霉素3</drug_name><drug_amount>0.3</drug_amount><drug_frequency>3</drug_frequency><call_module>diabetes</call_module><ext_uuid>4324234</ext_uuid><org_id>511804201</org_id></row><row><identity_number>513101196912282322</identity_number><staff_id>510824198308190834</staff_id><created>1321585782</created><drug_name>青霉素2</drug_name><drug_amount>0.3</drug_amount><drug_frequency>3</drug_frequency><call_module>diabetes</call_module><ext_uuid>4324234</ext_uuid><org_id>511804201</org_id></row><row><identity_number>513101196912282322</identity_number><staff_id>510824198308190834</staff_id><created>1321585782</created><drug_name>尾巴斯汀1</drug_name><drug_amount>0.5</drug_amount><drug_frequency>3</drug_frequency><call_module>diabetes</call_module><ext_uuid>4324234</ext_uuid><org_id>511804201</org_id></row></table></tables>";
	  echo $soapclient->ws_update('1',$xml_string);
    }
}
?>