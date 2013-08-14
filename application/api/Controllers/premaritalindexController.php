<?php
/**
 * @author mask
 * @todo   婚前医学证明 certificate_premartial_exam
 * 
 */
class api_premaritalindexController extends controller 
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
		
		require_once(__SITEROOT."application/api/models/api_phs_premaritalindex.php");
		/*
		$client=new premaritalindex();
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='certificate_premartial_exam'><row><identity_number>510100198011201312</identity_number><staff_id>511027198805017315</staff_id><created>1295594127</created><partner_name>配名</partner_name><blood_kinship>2</blood_kinship><result_of_premarital_exam>说的</result_of_premarital_exam><medical_opinion>4</medical_opinion><signature_of_doctor>4c7333276f99c</signature_of_doctor><record_time>1295568000</record_time><ext_uuid>3</ext_uuid><org_id>888888</org_id></row><error_msg></error_msg></table></tables>";
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
		require_once(__SITEROOT."application/api/models/api_phs_premaritalindex.php");//model
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
		
		//$token_xml	= $client->login('888888','1');//验证机构标准代码和密码
        //$data_xml	= new SimpleXMLElement($token_xml);		
		//$token		= $data_xml->return_string;//得到令牌
		// 查询
		/*
		$tmp=$client->ws_select_single('',"<?xml version='1.0' encoding='UTF-8'?><where><org_id>888888</org_id><identity_number>510100198011201312</identity_number><ext_uuid>1</ext_uuid></where>"); 
	    echo $tmp;
	    */
		//更新
		/*
	    $tmp=$client->ws_update('',"<?xml version='1.0' encoding='UTF-8'?><tables><table name='certificate_premartial_exam'><row><identity_number>510100198011201312</identity_number><staff_id>511027198805017315</staff_id><created>1295594127</created><partner_name>配名</partner_name><blood_kinship>2</blood_kinship><result_of_premarital_exam>说的</result_of_premarital_exam><medical_opinion>4</medical_opinion><signature_of_doctor>4c7333276f99c</signature_of_doctor><record_time>1295568000</record_time><ext_uuid>1</ext_uuid><org_id>888888</org_id></row><error_msg></error_msg></table></tables>"); 
	    echo $tmp;
		
		*/
		
	}
}
?>