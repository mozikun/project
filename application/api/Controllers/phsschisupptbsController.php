<?php
/**
 * @author mask
 * @todo  用于重性精神分裂补充资料接口
 */
class api_phsschisupptbsController extends controller 
{
	private $wsdl_path;
	public function init()
	{
		$this->wsdl_path="wsdl/api_phs_".parent::getControllerName().".wsdl";
		require_once __SITEROOT."application/api/models/api_phs_common.php";
	}
	/**
	 * api接口地址
	 *
	 */
	public function indexAction()
	{
		require_once(__SITEROOT."application/api/models/api_phs_schisupptbs.php");
		/**
		$client=new phsschisupptbs();
		$xml_string="<?xml version='1.0' encoding='UTF-8'?>
		<tables><table name='schizophreniaer_supp_tabs'>
		<row><identity_number>513101194109043818</identity_number>
		<staff_id>511025198711202222</staff_id>
		<created>1321604936</created>
		<guardian_name></guardian_name><relationship_with_patients></relationship_with_patients><guardian_address></guardian_address>
		<guardian_phone></guardian_phone><contact_area></contact_area>
		<phone_area></phone_area><onset_time>1321574400</onset_time>
		<main_symptomsed></main_symptomsed><main_symptomsed_other></main_symptomsed_other><outpatient></outpatient>
		<hospital></hospital><diagnosis></diagnosis><hospital_diagnosis></hospital_diagnosis>
		<time_diagnosis></time_diagnosis><therapeutic_effect></therapeutic_effect>
		<mild_trouble></mild_trouble><accident></accident><zhaohuo></zhaohuo><self_wounding></self_wounding>
		<attmpted_suicide></attmpted_suicide><shut_case></shut_case><fill_time>1321574400</fill_time>
		<doctors_signature>4c7333276f141</doctors_signature><informed_consent></informed_consent>
		<informed_consent_sign></informed_consent_sign><informed_consent_sign_time></informed_consent_sign_time>
		<economic_conditions></economic_conditions><specialist_advice>ddddd</specialist_advice>
		<ext_uuid>1</ext_uuid>
		<org_id>888888</org_id>
		</row>
		<row><identity_number>510129198005073116</identity_number>
		<staff_id>511025198711202222</staff_id>
		<created>1321604936</created>
		<guardian_name></guardian_name><relationship_with_patients></relationship_with_patients><guardian_address></guardian_address>
		<guardian_phone></guardian_phone><contact_area></contact_area>
		<phone_area></phone_area><onset_time>1321574400</onset_time>
		<main_symptomsed></main_symptomsed><main_symptomsed_other></main_symptomsed_other><outpatient></outpatient>
		<hospital></hospital><diagnosis></diagnosis><hospital_diagnosis></hospital_diagnosis>
		<time_diagnosis></time_diagnosis><therapeutic_effect></therapeutic_effect>
		<mild_trouble></mild_trouble><accident></accident><zhaohuo></zhaohuo><self_wounding></self_wounding>
		<attmpted_suicide></attmpted_suicide><shut_case></shut_case><fill_time>1321574400</fill_time>
		<doctors_signature>4c7333276f141</doctors_signature><informed_consent></informed_consent>
		<informed_consent_sign></informed_consent_sign><informed_consent_sign_time></informed_consent_sign_time>
		<economic_conditions></economic_conditions><specialist_advice>erer</specialist_advice>
		<ext_uuid>2</ext_uuid>
		<org_id>888888</org_id>
		</row>			
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
		require_once(__SITEROOT."application/api/models/api_phs_schisupptbs.php");//model
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
		$client		= new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);
        $token_xml	= $client->login('888888','1');//验证机构标准代码和密码
        $data_xml	= new SimpleXMLElement($token_xml);		
		$token		= $data_xml->return_string;//得到令牌
		$tmp		= $client->ws_select_single($token,"<?xml version='1.0' encoding='UTF-8'?><where><org_id>888888</org_id><identity_number>513101194109043818</identity_number><ext_uuid>1</ext_uuid></where>"); 
	    echo $tmp;
	}
}
?>