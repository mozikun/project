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
		require_once(__SITEROOT."application/api/models/api_phs_schi.php");//model
		$token_xml	= $client->login('888888','1');//验证机构标准代码和密码
        $data_xml	= new SimpleXMLElement($token_xml);		
		$token		= $data_xml->return_string;//得到令牌
		/*
		$tmp=$client->ws_select_single($token,"<?xml version='1.0' encoding='UTF-8'?><where><org_id>888888</org_id><identity_number>513101194109043818</identity_number><ext_uuid>1</ext_uuid></where>"); 
	    echo $tmp;
	    */
		/*
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='schizophrenia'><row><identity_number>513101199311112129</identity_number><staff_id>513101198204020021</staff_id><created>1303186047</created><fllowup_time>1303142400</fllowup_time><present_symptoms>1|3|4|</present_symptoms><present_symptoms_other></present_symptoms_other><insight></insight><sleep_quality></sleep_quality><diet></diet><personlife_do></personlife_do><housework></housework><work></work><learning></learning><human_communication></human_communication><mild_trouble></mild_trouble><accident></accident><zhaohuo></zhaohuo><self_wounding></self_wounding><attmpted_suicide></attmpted_suicide><lab_examination>实验室检查
</lab_examination><compliance></compliance><adverse_drug></adverse_drug><adverse_drug_info></adverse_drug_info><treatment_effect></treatment_effect><followup_classification></followup_classification><is_referral></is_referral><reason_referral></reason_referral><hospital_referral></hospital_referral><drug_name1>11111</drug_name1><drug_usage_frequency1>1</drug_usage_frequency1><drug_usage1></drug_usage1><drug_dose1></drug_dose1><drug_name2></drug_name2><drug_usage_frequency2>1</drug_usage_frequency2><drug_usage2></drug_usage2><drug_dose2></drug_dose2><drug_name3></drug_name3><drug_usage_frequency3>1</drug_usage_frequency3><drug_usage3></drug_usage3><drug_dose3></drug_dose3><rehabilitation_measures>1|2|5</rehabilitation_measures><rehabilitation_measure_other></rehabilitation_measure_other><next_followup_time>1303142400</next_followup_time><followup_doctor>513101198204020021</followup_doctor><followup_content></followup_content><risk></risk><shut_case></shut_case><hospitalization></hospitalization><discharge_time></discharge_time><is_lab_examination>2</is_lab_examination><ext_uuid>1</ext_uuid><org_id>54254047451180212C2201</org_id></row>
		<row><identity_number>513101199311112129</identity_number><staff_id>513101198204020021</staff_id><created>1303186047</created><fllowup_time>1303142400</fllowup_time><present_symptoms>1|3|4|</present_symptoms><present_symptoms_other></present_symptoms_other><insight></insight><sleep_quality></sleep_quality><diet></diet><personlife_do></personlife_do><housework></housework><work>1</work><learning>1</learning><human_communication>1</human_communication><mild_trouble></mild_trouble><accident></accident><zhaohuo></zhaohuo><self_wounding></self_wounding><attmpted_suicide></attmpted_suicide><lab_examination></lab_examination><compliance></compliance><adverse_drug></adverse_drug><adverse_drug_info></adverse_drug_info><treatment_effect></treatment_effect><followup_classification></followup_classification><is_referral></is_referral><reason_referral></reason_referral><hospital_referral></hospital_referral><drug_name1>11111</drug_name1><drug_usage_frequency1>1</drug_usage_frequency1><drug_usage1></drug_usage1><drug_dose1></drug_dose1><drug_name2></drug_name2><drug_usage_frequency2>1</drug_usage_frequency2><drug_usage2></drug_usage2><drug_dose2></drug_dose2><drug_name3></drug_name3><drug_usage_frequency3>1</drug_usage_frequency3><drug_usage3></drug_usage3><drug_dose3></drug_dose3><rehabilitation_measures></rehabilitation_measures><rehabilitation_measure_other></rehabilitation_measure_other><next_followup_time>1303142400</next_followup_time><followup_doctor>4c7333276f141</followup_doctor><followup_content></followup_content><risk></risk><shut_case></shut_case><hospitalization></hospitalization><discharge_time></discharge_time><is_lab_examination></is_lab_examination><ext_uuid>2</ext_uuid><org_id>54254047451180212C2201</org_id></row>
		</table></tables>";
		
		*/
		
		$xml_string="<tables><table name='schizophrenia' >
  <row>
    <identity_number>513101199311112129</identity_number>
    <org_id>77794538-8</org_id>
    <staff_id>513127197508260015</staff_id>
    <created>1382361912</created>
    <fllowup_time>1319126400</fllowup_time>
    <present_symptoms>9|10</present_symptoms>
    <present_symptoms_other>通过</present_symptoms_other>
    <insight>2</insight>
    <sleep_quality>2</sleep_quality>
    <personlife_do>4</personlife_do>
    <housework>1</housework>
    <work>1</work>
    <learning>1</learning>
    <human_communication>1</human_communication>
    <mild_trouble>0</mild_trouble>
    <accident>0</accident>
    <zhaohuo>0</zhaohuo>
    <self_wounding>0</self_wounding>
    <attmpted_suicide>0</attmpted_suicide>
    <compliance>1</compliance>
    <adverse_drug>2</adverse_drug>
    <adverse_drug_info>葡萄糖</adverse_drug_info>
    <treatment_effect>2</treatment_effect>
    <followup_classification>3</followup_classification>
    <is_referral>2</is_referral>
    <reason_referral>病情加重</reason_referral>
    <hospital_referral>2甲</hospital_referral>
    <drug_name1>奋乃静</drug_name1>
    <drug_usage1>2</drug_usage1>
    <drug_dose1>2</drug_dose1>
    <drug_name2>氯丙嗪</drug_name2>
    <drug_usage2>2</drug_usage2>
    <drug_dose2>25</drug_dose2>
    <rehabilitation_measure_other>通过</rehabilitation_measure_other>
    <rehabilitation_measures>4|5</rehabilitation_measures>
    <next_followup_time>1327075200</next_followup_time>
    <followup_doctor>513127197508260015</followup_doctor>
    <risk>2</risk>
    <shut_case>1</shut_case>
    <hospitalization>0</hospitalization>
    <discharge_time>1277395200</discharge_time>
    <is_lab_examination>2</is_lab_examination>
    <lab_examination>血常规</lab_examination>
    <ext_uuid>7F5E3548-BAD5-4FC9-BC8A-108419557314</ext_uuid>
  </row>
  <row>
    <identity_number>513101199311112129</identity_number>
    <org_id>77794538-8</org_id>
    <staff_id>513127197508260015</staff_id>
    <created>1382361987</created>
    <fllowup_time>1350748800</fllowup_time>
    <present_symptoms>9|10</present_symptoms>
    <present_symptoms_other>通过</present_symptoms_other>
    <insight>2</insight>
    <sleep_quality>1</sleep_quality>
    <personlife_do>1</personlife_do>
    <housework>1</housework>
    <work>1</work>
    <learning>1</learning>
    <human_communication>1</human_communication>
    <mild_trouble>0</mild_trouble>
    <accident>0</accident>
    <zhaohuo>0</zhaohuo>
    <self_wounding>0</self_wounding>
    <attmpted_suicide>0</attmpted_suicide>
    <compliance>1</compliance>
    <adverse_drug>1</adverse_drug>
    <adverse_drug_info>葡萄糖</adverse_drug_info>
    <treatment_effect>2</treatment_effect>
    <followup_classification>3</followup_classification>
    <is_referral>2</is_referral>
    <reason_referral>病情加重</reason_referral>
    <hospital_referral>2甲</hospital_referral>
    <drug_name1>奋乃静</drug_name1>
    <drug_usage1>2</drug_usage1>
    <drug_dose1>2</drug_dose1>
    <drug_name2>氯丙嗪</drug_name2>
    <drug_usage2>2</drug_usage2>
    <drug_dose2>25</drug_dose2>
    <rehabilitation_measure_other>通过</rehabilitation_measure_other>
    <rehabilitation_measures>4|5</rehabilitation_measures>
    <next_followup_time>1358697600</next_followup_time>
    <followup_doctor>513127197508260015</followup_doctor>
    <risk>2</risk>
    <shut_case>1</shut_case>
    <hospitalization>0</hospitalization>
    <discharge_time>1308931200</discharge_time>
    <is_lab_examination>2</is_lab_examination>
    <lab_examination>血常规ewatat at</lab_examination>
    <ext_uuid>E24E8641-ACE8-416D-BF81-8D40598A0887</ext_uuid>
  </row>
  <row>
    <identity_number>513101199311112129</identity_number>
    <org_id>77794538-8</org_id>
    <staff_id>513127197508260015</staff_id>
    <created>1382362024</created>
    <fllowup_time>1382284800</fllowup_time>
    <present_symptoms>9|10</present_symptoms>
    <present_symptoms_other>通过</present_symptoms_other>
    <insight>2</insight>
    <sleep_quality>1</sleep_quality>
    <personlife_do>1</personlife_do>
    <housework>1</housework>
    <work>1</work>
    <learning>1</learning>
    <human_communication>1</human_communication>
    <mild_trouble>0</mild_trouble>
    <accident>0</accident>
    <zhaohuo>0</zhaohuo>
    <self_wounding>0</self_wounding>
    <attmpted_suicide>0</attmpted_suicide>
    <compliance>1</compliance>
    <adverse_drug>1</adverse_drug>
    <adverse_drug_info>葡萄糖</adverse_drug_info>
    <treatment_effect>2</treatment_effect>
    <followup_classification>3</followup_classification>
    <is_referral>2</is_referral>
    <reason_referral>病情加重</reason_referral>
    <hospital_referral>2甲</hospital_referral>
    <drug_name1>奋乃静</drug_name1>
    <drug_usage1>2</drug_usage1>
    <drug_dose1>2</drug_dose1>
    <drug_name2>氯丙嗪</drug_name2>
    <drug_usage2>2</drug_usage2>
    <drug_dose2>25</drug_dose2>
    <rehabilitation_measure_other>通过</rehabilitation_measure_other>
    <rehabilitation_measures>4|5</rehabilitation_measures>
    <next_followup_time>1390233600</next_followup_time>
    <followup_doctor>513127197508260015</followup_doctor>
    <risk>2</risk>
    <shut_case>1</shut_case>
    <hospitalization>0</hospitalization>
    <discharge_time>1308931200</discharge_time>
    <is_lab_examination>2</is_lab_examination>
    <lab_examination>血常规ewatat atqwetaet at 短发噶</lab_examination>
    <ext_uuid>1CB8643D-98F3-4637-B844-58741EF93BBA</ext_uuid>
  </row>
  <row>
    <identity_number>513101199311112129</identity_number>
    <org_id>77794538-8</org_id>
    <staff_id>513127197508260015</staff_id>
    <created>1383113883</created>
    <fllowup_time>1383062400</fllowup_time>
    <present_symptoms>1|2</present_symptoms>
    <insight>2</insight>
    <sleep_quality>1</sleep_quality>
    <personlife_do>1</personlife_do>
    <housework>1</housework>
    <work>1</work>
    <learning>1</learning>
    <human_communication>1</human_communication>
    <mild_trouble>0</mild_trouble>
    <accident>0</accident>
    <zhaohuo>0</zhaohuo>
    <self_wounding>0</self_wounding>
    <attmpted_suicide>0</attmpted_suicide>
    <compliance>1</compliance>
    <adverse_drug>1</adverse_drug>
    <treatment_effect>1</treatment_effect>
    <followup_classification>1</followup_classification>
    <is_referral>1</is_referral>
    <rehabilitation_measures>1|2|3</rehabilitation_measures>
    <next_followup_time>1391011200</next_followup_time>
    <followup_doctor>513127197508260015</followup_doctor>
    <risk>0</risk>
    <shut_case>2</shut_case>
    <hospitalization>1</hospitalization>
    <is_lab_examination>2</is_lab_examination>
    <lab_examination>11</lab_examination>
    <ext_uuid>DA773777-AB57-48B6-9E9E-076B46FA5314</ext_uuid>
  </row>
</table></tables>";
		//$tmp=$client->ws_update('17',$xml_string);
		//echo $tmp;
		$phsschi=new phsschi();
		echo $phsschi->ws_update(" ",$xml_string);
		
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
		$tmp=$client->ws_select_single($token,"<?xml version='1.0' encoding='UTF-8'?><where><org_id>54254047451180212C2201</org_id><identity_number>511029194609031234</identity_number><ext_uuid>cd520b286c9cffe9.52112127</ext_uuid></where>"); 
		echo $tmp;
		
		
	}
	public function ws_select_personsAction()
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
		$tmp=$client->ws_select_persons($token,"<?xml version='1.0' encoding='UTF-8'?><where><org_id>54254047451180212C2201</org_id><identity_number>511029194609031234</identity_number><ext_uuid>9B485575-DF4F-4DC5-A88F-71D64DFB82A0</ext_uuid></where>"); 
		echo $tmp;
		
		
	}
}
?>