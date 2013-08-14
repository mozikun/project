<?php
/**
 * @author 我好笨
 * @todo 本类用于孕产妇产后42天检查接口
 */
class api_phsmacheckController extends controller 
{
	private $wsdl_path;
	public function init()
	{
		$this->wsdl_path="wsdl/api_phs_".parent::getControllerName().".wsdl";;
	}
	/**
	 * api接口地址
	 *
	 */
	public function indexAction()
	{
		require_once(__SITEROOT."application/api/models/api_phs_macheck.php");
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
		require_once(__SITEROOT."application/api/models/api_phs_macheck.php");
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
	   require_once(__SITEROOT."application/api/models/api_phs_macheck.php");
		//$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);
		/*$tmp=$client->ws_select_single("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>511802104</org_id><identity_number>513101198203263821</identity_number><ext_uuid>33</ext_uuid></where>
");*/
        $client=new SoapClient("http://172.16.11.245/".$this->wsdl_path);
        echo $client->ws_select_all("45254124-6","<?xml version='1.0' encoding='UTF-8'?><where><org_id>45254124-6</org_id></where>");
        /*echo $client->ws_select_persons("45254124-6","<?xml version='1.0' encoding='UTF-8'?><where><org_id>45254124-6</org_id><identity_number>513101198805221021</identity_number></where>");*/
        exit;
        $client=new phsmacheck();
		$tmp=$client->ws_update("17","<?xml version='1.0' encoding='UTF-8'?>
<tables>
<table name='postpartum_heathcheck'>
<row>
<identity_number>513101195001152127</identity_number>
<fid>89E032DE-EFD3-41FD-8C7E-0CF341D691E0</fid>
<org_id>511802104</org_id>
<staff_id>510103199901010001</staff_id>
<created>1288944255</created>
<follow_time>1288915200</follow_time>
<general_health></general_health>
<general_psychology></general_psychology>
<systolic_blood_pressure></systolic_blood_pressure>
<diastolic_blood_pressure></diastolic_blood_pressure>
<brest>1</brest>
<brest_info></brest_info>
<lochia>1</lochia>
<lochia_info></lochia_info>
<uterus>2</uterus>
<uterus_info>1</uterus_info>
<durative_ulcer>2</durative_ulcer>
<durative_ulcer_info>2</durative_ulcer_info>
<post_other></post_other>
<pregnant_sort>2</pregnant_sort>
<pregnant_sort_info>异常</pregnant_sort_info>
<medical_advice>2|3|-99</medical_advice>
<referral>2</referral>
<referral_reason>8</referral_reason>
<referral_org>阿斯顿范围</referral_org>
<follow_staff>4c7333276f141</follow_staff>
<medical_advice_info>111</medical_advice_info>
<ext_uuid>56E032DE-EFD3-41FD-8C7E-0CF341D691E0</ext_uuid>
</row>

<row>
<identity_number>513101195001152127</identity_number>
<fid>89E032DE-EFD3-41FD-8C7E-0CF341D691E0</fid>
<org_id>511802104</org_id>
<staff_id>510103199901010001</staff_id>
<created>1288944255</created>
<follow_time>1288915200</follow_time>
<general_health></general_health>
<general_psychology></general_psychology>
<systolic_blood_pressure></systolic_blood_pressure>
<diastolic_blood_pressure></diastolic_blood_pressure>
<brest>1</brest>
<brest_info></brest_info>
<lochia>1</lochia>
<lochia_info></lochia_info>
<uterus>2</uterus>
<uterus_info>1</uterus_info>
<durative_ulcer>2</durative_ulcer>
<durative_ulcer_info>2</durative_ulcer_info>
<post_other></post_other>
<pregnant_sort>2</pregnant_sort>
<pregnant_sort_info>异常</pregnant_sort_info>
<medical_advice>2|3|-99</medical_advice>
<referral>2</referral>
<referral_reason>8</referral_reason>
<referral_org>阿斯顿发</referral_org>
<follow_staff>4c7333276f141</follow_staff>
<medical_advice_info>111</medical_advice_info>
<ext_uuid>78E032DE-EFD3-41FD-8C7E-0CF341D691E0</ext_uuid>
</row>

<row>
<identity_number>513101195410172524</identity_number>
<fid>89E032DE-EFD3-41FD-8C7E-0CF341D691E1</fid>
<org_id>511802104</org_id>
<staff_id>510103199901010001</staff_id>
<created>1288944255</created>
<follow_time>1288915200</follow_time>
<general_health></general_health>
<general_psychology></general_psychology>
<systolic_blood_pressure></systolic_blood_pressure>
<diastolic_blood_pressure></diastolic_blood_pressure>
<brest>1</brest>
<brest_info></brest_info>
<lochia>1</lochia>
<lochia_info></lochia_info>
<uterus>2</uterus>
<uterus_info>1</uterus_info>
<durative_ulcer>2</durative_ulcer>
<durative_ulcer_info>2</durative_ulcer_info>
<post_other></post_other>
<pregnant_sort>2</pregnant_sort>
<pregnant_sort_info>异常</pregnant_sort_info>
<medical_advice>2|3|-99</medical_advice>
<referral>2</referral>
<referral_reason>8</referral_reason>
<referral_org>阿斯顿哦啊啊收到</referral_org>
<follow_staff>4c7333276f141</follow_staff>
<medical_advice_info>111</medical_advice_info>
<ext_uuid>23E032DE-EFD3-41FD-8C7E-0CF341D691E0</ext_uuid>
</row>
</table>
</tables>");
		/*$tmp=$client->ws_delete("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>511802104</org_id><identity_number>513101198203263821</identity_number><ext_uuid>99</ext_uuid></where>
");*/
		echo $tmp;
	}
}
?>