<?php
/**
 * @author mask
 * @todo  用于重性精神分裂随访接口
 */
class api_phsschiController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_phs_schi.php");
		
		//$client=new phsschi();
		/**$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='schizophrenia'><row><identity_number>513101194109043818</identity_number><staff_id>511025198711202222</staff_id><created>1303186047</created><fllowup_time>1303142400</fllowup_time><present_symptoms>1|3|5|</present_symptoms><present_symptoms_other></present_symptoms_other><insight>1</insight><sleep_quality></sleep_quality><diet></diet><personlife_do></personlife_do><housework></housework><work></work><learning></learning><human_communication></human_communication><mild_trouble></mild_trouble><accident></accident><zhaohuo></zhaohuo><self_wounding></self_wounding><attmpted_suicide></attmpted_suicide><lab_examination></lab_examination><compliance></compliance><adverse_drug></adverse_drug><adverse_drug_info></adverse_drug_info><treatment_effect></treatment_effect><followup_classification></followup_classification><is_referral></is_referral><reason_referral></reason_referral><hospital_referral></hospital_referral><drug_name1>11111</drug_name1><drug_usage_frequency1>1</drug_usage_frequency1><drug_usage1></drug_usage1><drug_dose1></drug_dose1><drug_name2></drug_name2><drug_usage_frequency2>1</drug_usage_frequency2><drug_usage2></drug_usage2><drug_dose2></drug_dose2><drug_name3></drug_name3><drug_usage_frequency3>1</drug_usage_frequency3><drug_usage3></drug_usage3><drug_dose3></drug_dose3><rehabilitation_measures></rehabilitation_measures><rehabilitation_measure_other></rehabilitation_measure_other><next_followup_time>1303142400</next_followup_time><followup_doctor>4c7333276f141</followup_doctor><followup_content></followup_content><risk></risk><shut_case></shut_case><hospitalization></hospitalization><discharge_time></discharge_time><is_lab_examination></is_lab_examination><ext_uuid>1</ext_uuid><org_id>888888</org_id></row>
		<row><identity_number>513101194109043818</identity_number><staff_id>511025198711202222</staff_id><created>1303186047</created><fllowup_time>1303142400</fllowup_time><present_symptoms>1|3|4|</present_symptoms><present_symptoms_other></present_symptoms_other><insight></insight><sleep_quality></sleep_quality><diet></diet><personlife_do></personlife_do><housework></housework><work>1</work><learning>1</learning><human_communication>1</human_communication><mild_trouble></mild_trouble><accident></accident><zhaohuo></zhaohuo><self_wounding></self_wounding><attmpted_suicide></attmpted_suicide><lab_examination></lab_examination><compliance></compliance><adverse_drug></adverse_drug><adverse_drug_info></adverse_drug_info><treatment_effect></treatment_effect><followup_classification></followup_classification><is_referral></is_referral><reason_referral></reason_referral><hospital_referral></hospital_referral><drug_name1>11111</drug_name1><drug_usage_frequency1>1</drug_usage_frequency1><drug_usage1></drug_usage1><drug_dose1></drug_dose1><drug_name2></drug_name2><drug_usage_frequency2>1</drug_usage_frequency2><drug_usage2></drug_usage2><drug_dose2></drug_dose2><drug_name3></drug_name3><drug_usage_frequency3>1</drug_usage_frequency3><drug_usage3></drug_usage3><drug_dose3></drug_dose3><rehabilitation_measures></rehabilitation_measures><rehabilitation_measure_other></rehabilitation_measure_other><next_followup_time>1303142400</next_followup_time><followup_doctor>4c7333276f141</followup_doctor><followup_content></followup_content><risk></risk><shut_case></shut_case><hospitalization></hospitalization><discharge_time></discharge_time><is_lab_examination></is_lab_examination><ext_uuid>2</ext_uuid><org_id>888888</org_id></row>
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
		require_once(__SITEROOT."application/api/models/api_phs_schi.php");//model
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
		$tmp=$client->ws_select_single($token,"<?xml version='1.0' encoding='UTF-8'?><where><org_id>888888</org_id><identity_number>513101194109043818</identity_number><ext_uuid>1</ext_uuid></where>"); 
	    echo $tmp;
	    */
		
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='schizophrenia'><row><identity_number>513101194109043818</identity_number><staff_id>511025198711202222</staff_id><created>1303186047</created><fllowup_time>1303142400</fllowup_time><present_symptoms>1|3|4|</present_symptoms><present_symptoms_other></present_symptoms_other><insight></insight><sleep_quality></sleep_quality><diet></diet><personlife_do></personlife_do><housework></housework><work></work><learning></learning><human_communication></human_communication><mild_trouble></mild_trouble><accident></accident><zhaohuo></zhaohuo><self_wounding></self_wounding><attmpted_suicide></attmpted_suicide><lab_examination></lab_examination><compliance></compliance><adverse_drug></adverse_drug><adverse_drug_info></adverse_drug_info><treatment_effect></treatment_effect><followup_classification></followup_classification><is_referral></is_referral><reason_referral></reason_referral><hospital_referral></hospital_referral><drug_name1>11111</drug_name1><drug_usage_frequency1>1</drug_usage_frequency1><drug_usage1></drug_usage1><drug_dose1></drug_dose1><drug_name2></drug_name2><drug_usage_frequency2>1</drug_usage_frequency2><drug_usage2></drug_usage2><drug_dose2></drug_dose2><drug_name3></drug_name3><drug_usage_frequency3>1</drug_usage_frequency3><drug_usage3></drug_usage3><drug_dose3></drug_dose3><rehabilitation_measures></rehabilitation_measures><rehabilitation_measure_other></rehabilitation_measure_other><next_followup_time>1303142400</next_followup_time><followup_doctor>4c7333276f141</followup_doctor><followup_content></followup_content><risk></risk><shut_case></shut_case><hospitalization></hospitalization><discharge_time></discharge_time><is_lab_examination></is_lab_examination><ext_uuid>1</ext_uuid><org_id>888888</org_id></row>
		<row><identity_number>513101194109043818</identity_number><staff_id>511025198711202222</staff_id><created>1303186047</created><fllowup_time>1303142400</fllowup_time><present_symptoms>1|3|4|</present_symptoms><present_symptoms_other></present_symptoms_other><insight></insight><sleep_quality></sleep_quality><diet></diet><personlife_do></personlife_do><housework></housework><work>1</work><learning>1</learning><human_communication>1</human_communication><mild_trouble></mild_trouble><accident></accident><zhaohuo></zhaohuo><self_wounding></self_wounding><attmpted_suicide></attmpted_suicide><lab_examination></lab_examination><compliance></compliance><adverse_drug></adverse_drug><adverse_drug_info></adverse_drug_info><treatment_effect></treatment_effect><followup_classification></followup_classification><is_referral></is_referral><reason_referral></reason_referral><hospital_referral></hospital_referral><drug_name1>11111</drug_name1><drug_usage_frequency1>1</drug_usage_frequency1><drug_usage1></drug_usage1><drug_dose1></drug_dose1><drug_name2></drug_name2><drug_usage_frequency2>1</drug_usage_frequency2><drug_usage2></drug_usage2><drug_dose2></drug_dose2><drug_name3></drug_name3><drug_usage_frequency3>1</drug_usage_frequency3><drug_usage3></drug_usage3><drug_dose3></drug_dose3><rehabilitation_measures></rehabilitation_measures><rehabilitation_measure_other></rehabilitation_measure_other><next_followup_time>1303142400</next_followup_time><followup_doctor>4c7333276f141</followup_doctor><followup_content></followup_content><risk></risk><shut_case></shut_case><hospitalization></hospitalization><discharge_time></discharge_time><is_lab_examination></is_lab_examination><ext_uuid>2</ext_uuid><org_id>888888</org_id></row>
		</table></tables>";
		$tmp=$client->ws_update('17',$xml_string);
		echo $tmp;
		
		
	}
	public function ws_selectAction()
	{
		$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);
		$token_xml	= $client->login('888888','1');//验证机构标准代码和密码
        $data_xml	= new SimpleXMLElement($token_xml);		
		$token		= $data_xml->return_string;//得到令牌
		/*
		$tmp=$client->ws_select_single($token,"<?xml version='1.0' encoding='UTF-8'?><where><org_id>888888</org_id><identity_number>513101194109043818</identity_number><ext_uuid>1</ext_uuid></where>"); 
	    echo $tmp;
	    */
		
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><org_id>17</org_id>";
		$tmp=$client->ws_select_all($token,"<?xml version='1.0' encoding='UTF-8'?><where><org_id>SM000001151182410A1001</org_id></where>"); 
		echo $tmp;
		
		
	}
}
?>