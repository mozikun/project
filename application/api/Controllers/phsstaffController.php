<?php
/**
 * @author mask
 * @todo  查询所用用户返回XML接口
 */
class api_phsstaffController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_phs_staff.php");	
		/*$client=new phsstaff();
		$xml_string="<?xml version='1.0' encoding='UTF-8'?>
                                <tables>
                                <table name='staff_core'>
                                <row>
                                <org_id>888888</org_id>
                                <identity_card_number>50038319880103721X</identity_card_number>
                                <ext_uuid>45564704-4326-4cf6-ad7a-34f942d97ebc</ext_uuid>
                                <standard_code>国家标准档案号</standard_code><name_login>liuyan</name_login><passwd>123</passwd>
                                </row>
                                </table>
                                <table name='staff_archive'>
                                <row>
                                <name_real>刘彦</name_real>
                                <status_flag>1</status_flag>
                                <identity_card_number>50038319880103721X</identity_card_number>
                                <sex>1</sex>
                                <ext_uuid>45564704-4326-4cf6-ad7a-34f942d97ebc</ext_uuid>
                                </row>
                                </table>
                                </tables>";
 		$tmp=$client->ws_update("12",$xml_string); 
 		echo $tmp;*/
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
		require_once(__SITEROOT."application/api/models/api_phs_staff.php");//model
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
		
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><where><org_id>45254011251180211A1001</org_id></where>";
		$client=new SoapClient(__SITEROOT."wsdl/api_phs_phsstaff.wsdl");	
		$tmp=$client->ws_select("17",$xml_string);
		echo $tmp;
		exit();
		//$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);	
		/*//查询所用用户返回XML
		$tmp=$client->ws_select("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>888888</org_id></where>"); 
 		echo $tmp;*/
 		$xml_string="<?xml version='1.0' encoding='UTF-8'?> <tables> <table name='staff_core'> <row><standard_code>45564704-4326-4cf6-ad7a-34f942d97ebc</standard_code><name_login>LY</name_login><passwd>123</passwd><org_id>45256446-4</org_id><ext_uuid>45564704-4326-4cf6-ad7a-34f942d97ebc</ext_uuid><identity_card_number>50038319880103721X</identity_card_number></row></table><table name='staff_archive'><row><name_real>刘彦</name_real> <status_flag>1</status_flag><identity_card_number>50038319880103721X</identity_card_number><sex>1</sex><ext_uuid>45564704-4326-4cf6-ad7a-34f942d97ebc</ext_uuid></row></table>";
 	$xml_string="<?xml version='1.0' encoding='UTF-8'?>
                                <tables>
                                <table name='staff_core'>
                                <row>
                                <org_id>45256446-4</org_id>
                                <identity_card_number>50038319880103721X</identity_card_number>
                                <ext_uuid>45564704-4326-4cf6-ad7a-34f942d97ebc</ext_uuid>
                                <standard_code>12</standard_code><name_login>ly1</name_login><passwd>123</passwd>
                                </row>
                                 <row>
                                <org_id>45256446-4</org_id>
                                <identity_card_number>500383198801037212</identity_card_number>
                                <ext_uuid>45564704-4326-4cf6-ad7a-34f942d97ebc</ext_uuid>
                                <standard_code>23</standard_code><name_login>ly2</name_login><passwd>123</passwd>
                                </row>
                                </table>
                                <table name='staff_archive'>
                                <row>
                                <name_real>刘彦1</name_real>
                                <status_flag>1</status_flag>
                                <identity_card_number>50038319880103721X</identity_card_number>
                                <sex>1</sex>
                                <ext_uuid>45564704-4326-4cf6-ad7a-34f942d97ebc</ext_uuid>
                                </row>
                                <row>
                                <name_real>刘彦2</name_real>
                                <status_flag>1</status_flag>
                                <identity_card_number>500383198801037212</identity_card_number>
                                <sex>1</sex>
                                <ext_uuid>45564704-4326-4cf6-ad7a-34f942d97ebc</ext_uuid>
                                </row>
                                </table>
                                </tables>";
		$client=new SoapClient("http://zl.yawsw.com/wsdl/api_phs_phsstaff.wsdl");	
		$tmp=$client->ws_update("17",$xml_string); 
 		echo $tmp;
 		/*$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);	
 		$xml_string="<?xml version='1.0' encoding='UTF-8'?>
                                <tables>
                                <table name='staff_core'>
                                <row>
                                <org_id>888888</org_id>
                                <identity_card_number>50038319880103721X</identity_card_number>
                                <ext_uuid>45564704-4326-4cf6-ad7a-34f942d97ebc</ext_uuid>
                                <standard_code>国家标准档案号</standard_code><name_login>liuyan</name_login><passwd>123</passwd>
                                </row>
                                </table>
                                <table name='staff_archive'>
                                <row>
                                <name_real>刘彦</name_real>
                                <status_flag>1</status_flag>
                                <identity_card_number>50038319880103721X</identity_card_number>
                                <sex>1</sex>
                                <ext_uuid>45564704-4326-4cf6-ad7a-34f942d97ebc</ext_uuid>
                                </row>
                                </table>
                                </tables>";
 		$tmp=$client->ws_update("12",$xml_string); 
 		echo $tmp;*/
	}
}
?>