<?php
/**
 * @author mask
 * @todo  用于双向转诊接口
 */
class api_phspatientoutController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_phs_patient_referral_out.php");
/*	$client=new phspatientout();
		$xml_string="<?xml version='1.0' encoding='UTF-8' ?> 
<table name='patient_referral_out'>
    <row>
        <uuid>124443</uuid>
        <identity_number>513101194109043818</identity_number>
        <referral_time>2012-04-23</referral_time>        
		<referral_in_identity_number>510824198308190836</referral_in_identity_number>
        <firefight>初步诊断-文本形式（是否采用CDA，我们双方在交流）</firefight>
        <present_illness>主要现病史-文本形式</present_illness>
        <past_history>主要既往史-文本形式</past_history>
        <course_and_treatment>治疗经过-文本形式</course_and_treatment>
        <referral_out_identity_number>511025198711202222</referral_out_identity_number>
        <stub_fill_time>2012-04-23</stub_fill_time>
        <phone>88888888</phone>
        <fill_time>2012-04-23</fill_time>
        <status>1</status>
        <remark>备注（拒绝原因）</remark>
    </row>
</table> ";

		$tmp=$client->ws_patient_referral_out_insert('17',$xml_string);
		echo $tmp;
		exit();
		//删除
		$client=new phspatientout();
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><where><row><uuid>123</uuid></row></where>";
		$tmp=$client->ws_patient_referral_out_delete('17',$xml_string);
		echo $tmp;
		exit();*/
/*		//查询
		require_once(__SITEROOT."application/api/models/api_phs_patient_referral_out.php");
		$client=new phspatientout();
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><where><org_id>00000000000000</org_id><status></status></where>";
		$tmp=$client->ws_patient_referral_out_select('17',$xml_string);
		echo $tmp;
	    exit();
		//更新
		require_once(__SITEROOT."application/api/models/api_phs_patient_referral_out.php");
		$client=new phspatientout();
		$xml_string="<?xml version='1.0' encoding='UTF-8'?>
<where>
    <row>
<uuid>124443</uuid>
<status>2</status>
<remark>备注（拒绝原因）124443</remark>
</row>
   <row>
<uuid>gp4cb56c265dffc6.22947321</uuid>
<status>2</status>
<remark>备注（拒绝原因）1</remark>
</row>
</where>";
		$tmp=$client->ws_patient_referral_out_('17',$xml_string);
		echo $tmp;
	    exit();*/
		

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
		require_once(__SITEROOT."application/api/models/api_phs_patient_referral_out.php");//model
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
		
	}
}
?>