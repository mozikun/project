<?php
/**
 * @author mask
 * @todo   
 * 婚检主表 premarital_examination
 * 体格检查 pe_physical
 * 男性 pe_second_sex_male
 * 女性 pe_second_sex_female
 * 实验室及特殊检查pe_lab_examination
 * 婚前卫生咨询pe_health_advisory
 * 
 */       
class api_premaritalController extends controller 
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
		
		require_once(__SITEROOT."application/api/models/api_phs_premarital.php");
		/*
		$client=new premarital();
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='premarital_examination'><row><identity_number>51310119761005381x</identity_number><staff_id>511027198805017315</staff_id><created>1358149949</created><fill_time>1358121600</fill_time><name_of_the_partner></name_of_the_partner><sn_of_the_partner></sn_of_the_partner><date_of_examination>943920000</date_of_examination><blood_kinship>3</blood_kinship><blood_kinship_other></blood_kinship_other><past_disease_history></past_disease_history><past_disease_history_other></past_disease_history_other><operation_history>2</operation_history><operation_history_other></operation_history_other><present_disease_history>2</present_disease_history><present_disease_history_info></present_disease_history_info><age_of_menarche></age_of_menarche><menstrual_period></menstrual_period><menstrual_cycle></menstrual_cycle><menstruation></menstruation><dysmenorrhea></dysmenorrhea><lmp_time>943920000</lmp_time><fertile_history>2</fertile_history><fertile_history_info>1</fertile_history_info><fh_term></fh_term><fh_preterm></fh_preterm><fh_abortion></fh_abortion><number_of_children></number_of_children><family_history></family_history><family_history_other></family_history_other><relationship_with_patient></relationship_with_patient><family_inbreeding></family_inbreeding><family_inbreeding_info></family_inbreeding_info><signature_of_doctor>医生2</signature_of_doctor><referral_hospital></referral_hospital><referral_time>1358121600</referral_time><return_visit_time>1358121600</return_visit_time><cpe_time>1358121600</cpe_time><md_signature>医生2</md_signature><ext_uuid>2</ext_uuid><org_id>888888</org_id></row></table><table name='pe_physical'><row><staff_id>511027198805017315</staff_id><created>1358149949</created><systolic_pressure>1</systolic_pressure><diastolic_pressure>2</diastolic_pressure><special_body></special_body><special_body_info></special_body_info><mental_states></mental_states><mental_states_info></mental_states_info><unusual_facies></unusual_facies><unusual_facies_info></unusual_facies_info><intelligence></intelligence><intelligence_info></intelligence_info><skin_and_hair></skin_and_hair><skin_and_hair_info></skin_and_hair_info><feature></feature><feature_info></feature_info><thyroid></thyroid><thyroid_info></thyroid_info><heart_rate></heart_rate><cardiac_rhythm></cardiac_rhythm><noise></noise><noise_info></noise_info><lung></lung><lung_info></lung_info><liver></liver><liver_info></liver_info><spine_extremities></spine_extremities><spine_extremities_info></spine_extremities_info><other></other><signature_of_doctor>医生2</signature_of_doctor><ext_uuid>2</ext_uuid><org_id>888888</org_id></row></table><table name='pe_lab_examination'><row><staff_id>511027198805017315</staff_id><created>1358149949</created><check_result>1</check_result><check_result_info></check_result_info><disease_diagnosis></disease_diagnosis><medical_opinion></medical_opinion><signature_of_doctor></signature_of_doctor><ext_uuid>2</ext_uuid><org_id>888888</org_id></row></table><table name='pe_health_advisory'><row><staff_id>511027198805017315</staff_id><created>1358149949</created><health_advisory></health_advisory><counseling_results></counseling_results><signature_of_doctor></signature_of_doctor><ext_uuid>2</ext_uuid><org_id>888888</org_id></row></table></tables>"; 
	 
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
		require_once(__SITEROOT."application/api/models/api_phs_premarital.php");//model
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
		$token_xml	= $client->login('888888','1');//验证机构标准代码和密码
        $data_xml	= new SimpleXMLElement($token_xml);		
		$token		= $data_xml->return_string;//得到令牌
		/*
		$tmp=$client->ws_select_single($token,"<?xml version='1.0' encoding='UTF-8'?><where><org_id>888888</org_id><identity_number>51310119761005381x</identity_number><ext_uuid>2</ext_uuid></where>"); 
	    echo $tmp;
	    */
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='premarital_examination'><row><identity_number>51310119761005381x</identity_number><staff_id>511027198805017315</staff_id><created>1358149949</created><fill_time>1358121600</fill_time><name_of_the_partner></name_of_the_partner><sn_of_the_partner></sn_of_the_partner><date_of_examination>943920000</date_of_examination><blood_kinship>3</blood_kinship><blood_kinship_other></blood_kinship_other><past_disease_history></past_disease_history><past_disease_history_other></past_disease_history_other><operation_history>2</operation_history><operation_history_other></operation_history_other><present_disease_history>2</present_disease_history><present_disease_history_info></present_disease_history_info><age_of_menarche></age_of_menarche><menstrual_period></menstrual_period><menstrual_cycle></menstrual_cycle><menstruation></menstruation><dysmenorrhea></dysmenorrhea><lmp_time>943920000</lmp_time><fertile_history>2</fertile_history><fertile_history_info>1</fertile_history_info><fh_term></fh_term><fh_preterm></fh_preterm><fh_abortion></fh_abortion><number_of_children></number_of_children><family_history></family_history><family_history_other></family_history_other><relationship_with_patient></relationship_with_patient><family_inbreeding></family_inbreeding><family_inbreeding_info></family_inbreeding_info><signature_of_doctor>医生2</signature_of_doctor><referral_hospital></referral_hospital><referral_time>1358121600</referral_time><return_visit_time>1358121600</return_visit_time><cpe_time>1358121600</cpe_time><md_signature>医生2</md_signature><ext_uuid>2</ext_uuid><org_id>888888</org_id></row></table><table name='pe_physical'><row><staff_id>511027198805017315</staff_id><created>1358149949</created><systolic_pressure>1</systolic_pressure><diastolic_pressure>2</diastolic_pressure><special_body></special_body><special_body_info></special_body_info><mental_states></mental_states><mental_states_info></mental_states_info><unusual_facies></unusual_facies><unusual_facies_info></unusual_facies_info><intelligence></intelligence><intelligence_info></intelligence_info><skin_and_hair></skin_and_hair><skin_and_hair_info></skin_and_hair_info><feature></feature><feature_info></feature_info><thyroid></thyroid><thyroid_info></thyroid_info><heart_rate></heart_rate><cardiac_rhythm></cardiac_rhythm><noise></noise><noise_info></noise_info><lung></lung><lung_info></lung_info><liver></liver><liver_info></liver_info><spine_extremities></spine_extremities><spine_extremities_info></spine_extremities_info><other></other><signature_of_doctor>医生2</signature_of_doctor><ext_uuid>2</ext_uuid><org_id>888888</org_id></row></table><table name='pe_lab_examination'><row><staff_id>511027198805017315</staff_id><created>1358149949</created><check_result>1</check_result><check_result_info></check_result_info><disease_diagnosis></disease_diagnosis><medical_opinion></medical_opinion><signature_of_doctor></signature_of_doctor><ext_uuid>2</ext_uuid><org_id>888888</org_id></row></table><table name='pe_health_advisory'><row><staff_id>511027198805017315</staff_id><created>1358149949</created><health_advisory></health_advisory><counseling_results></counseling_results><signature_of_doctor></signature_of_doctor><ext_uuid>2</ext_uuid><org_id>888888</org_id></row></table></tables>"; 
		$tmp=$client->ws_update($token,$xml_string);
		echo $tmp;
		/*
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='schizophrenia'><row><identity_number>513101194109043818</identity_number><staff_id>511025198711202222</staff_id><created>1303186047</created><fllowup_time>1303142400</fllowup_time><present_symptoms>1|3|4|</present_symptoms><present_symptoms_other></present_symptoms_other><insight></insight><sleep_quality></sleep_quality><diet></diet><personlife_do></personlife_do><housework></housework><work></work><learning></learning><human_communication></human_communication><mild_trouble></mild_trouble><accident></accident><zhaohuo></zhaohuo><self_wounding></self_wounding><attmpted_suicide></attmpted_suicide><lab_examination></lab_examination><compliance></compliance><adverse_drug></adverse_drug><adverse_drug_info></adverse_drug_info><treatment_effect></treatment_effect><followup_classification></followup_classification><is_referral></is_referral><reason_referral></reason_referral><hospital_referral></hospital_referral><drug_name1>11111</drug_name1><drug_usage_frequency1>1</drug_usage_frequency1><drug_usage1></drug_usage1><drug_dose1></drug_dose1><drug_name2></drug_name2><drug_usage_frequency2>1</drug_usage_frequency2><drug_usage2></drug_usage2><drug_dose2></drug_dose2><drug_name3></drug_name3><drug_usage_frequency3>1</drug_usage_frequency3><drug_usage3></drug_usage3><drug_dose3></drug_dose3><rehabilitation_measures></rehabilitation_measures><rehabilitation_measure_other></rehabilitation_measure_other><next_followup_time>1303142400</next_followup_time><followup_doctor>4c7333276f141</followup_doctor><followup_content></followup_content><risk></risk><shut_case></shut_case><hospitalization></hospitalization><discharge_time></discharge_time><is_lab_examination></is_lab_examination><ext_uuid>1</ext_uuid><org_id>888888</org_id></row>
		<row><identity_number>513101194109043818</identity_number><staff_id>511025198711202222</staff_id><created>1303186047</created><fllowup_time>1303142400</fllowup_time><present_symptoms>1|3|4|</present_symptoms><present_symptoms_other></present_symptoms_other><insight></insight><sleep_quality></sleep_quality><diet></diet><personlife_do></personlife_do><housework></housework><work>1</work><learning>1</learning><human_communication>1</human_communication><mild_trouble></mild_trouble><accident></accident><zhaohuo></zhaohuo><self_wounding></self_wounding><attmpted_suicide></attmpted_suicide><lab_examination></lab_examination><compliance></compliance><adverse_drug></adverse_drug><adverse_drug_info></adverse_drug_info><treatment_effect></treatment_effect><followup_classification></followup_classification><is_referral></is_referral><reason_referral></reason_referral><hospital_referral></hospital_referral><drug_name1>11111</drug_name1><drug_usage_frequency1>1</drug_usage_frequency1><drug_usage1></drug_usage1><drug_dose1></drug_dose1><drug_name2></drug_name2><drug_usage_frequency2>1</drug_usage_frequency2><drug_usage2></drug_usage2><drug_dose2></drug_dose2><drug_name3></drug_name3><drug_usage_frequency3>1</drug_usage_frequency3><drug_usage3></drug_usage3><drug_dose3></drug_dose3><rehabilitation_measures></rehabilitation_measures><rehabilitation_measure_other></rehabilitation_measure_other><next_followup_time>1303142400</next_followup_time><followup_doctor>4c7333276f141</followup_doctor><followup_content></followup_content><risk></risk><shut_case></shut_case><hospitalization></hospitalization><discharge_time></discharge_time><is_lab_examination></is_lab_examination><ext_uuid>2</ext_uuid><org_id>888888</org_id></row>
		</table></tables>";
		$tmp=$client->ws_update('17',$xml_string);
		echo $tmp;
		*/
		
	}
}
?>