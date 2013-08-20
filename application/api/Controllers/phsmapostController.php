<?php
/**
 * @author 我好笨
 * @todo 本类用于孕产妇产后随访接口
 */
class api_phsmapostController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_phs_mapost.php");
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
		require_once(__SITEROOT."application/api/models/api_phs_mapost.php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($classname,"wsdl_".$classname,"/api/".$classname."/index");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.$this->wsdl_path,"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}
    /**
     * api_phsmapostController::zltestAction()
     * 
     * @return void
     */
    public function zltestAction()
    {
        $ws_url="http://172.16.11.251/wsdl/api_phs_mapost.wsdl";
		//$client=new SoapClient($ws_url);
        require_once(__SITEROOT."application/api/models/api_phs_mapost.php");
        $client=new phsmapost();
        echo $client->ws_update('54254047451180212C2201',iconv('gbk','utf-8',file_get_contents(__SITEROOT."chs.txt")));
        /*echo $client->ws_select_single('54254047451180212C2201',"<?xml version='1.0' encoding='UTF-8'?><where><org_id>54254047451180212C2201</org_id><identity_number>511027198109044321</identity_number><ext_uuid>ce4bb093-40d7-4ffc-9c65-c1a736c67f01</ext_uuid></where>");*/
    }
	/**
	 * 用于测试
	 *
	 */
	public function ws_testAction()
	{
		//$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);
		/*$tmp=$client->ws_select_single("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>511802104</org_id><identity_number>513101198203263821</identity_number><ext_uuid>66</ext_uuid></where>
");*/
        require_once(__SITEROOT."application/api/models/api_phs_mapost.php");
        $client=new SoapClient("http://172.16.11.245/".$this->wsdl_path);
        echo $client->ws_select_all("45254124-6","<?xml version='1.0' encoding='UTF-8'?><where><org_id>45254124-6</org_id></where>");
        /*echo $client->ws_select_persons("45254124-6","<?xml version='1.0' encoding='UTF-8'?><where><org_id>45254124-6</org_id><identity_number>513101198805221021</identity_number></where>");*/
        exit;
        $client=new phsmapost();
		$tmp=$client->ws_update("17","<?xml version='1.0' encoding='UTF-8'?>
<tables>
<table name='postpartum_visit'>
<row>
<identity_number>513101195001152127</identity_number>
<fid>89E032DE-EFD3-41FD-8C7E-0CF341D691E0</fid>
<org_id>511802104</org_id>
<staff_id>510103199901010001</staff_id>
<created>1288943355</created>
<follow_time>1288915200</follow_time>
<body_temperature></body_temperature>
<general_health></general_health>
<general_psychology></general_psychology>
<systolic_blood_pressure></systolic_blood_pressure>
<diastolic_blood_pressure></diastolic_blood_pressure>
<brest>1</brest>
<brest_info></brest_info>
<lochia>2</lochia>
<lochia_info>异常</lochia_info>
<uterus>2</uterus>
<uterus_info>知道</uterus_info>
<durative_ulcer>2</durative_ulcer>
<durative_ulcer_info>就是个1儿</durative_ulcer_info>
<post_other></post_other>
<pregnant_sort>2</pregnant_sort>
<pregnant_sort_info>异常</pregnant_sort_info>
<medical_advice></medical_advice>
<referral>2</referral>
<referral_reason>8</referral_reason>
<referral_org>9</referral_org>
<follow_next_time>1288999200</follow_next_time>
<follow_staff>4c7333276f141</follow_staff>
<medical_advice_info></medical_advice_info>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691CC</ext_uuid>
</row>

<row>
<identity_number>513101195001152127</identity_number>
<fid>89E032DE-EFD3-41FD-8C7E-0CF341D691E0</fid>
<org_id>511802104</org_id>
<staff_id>510103199901010001</staff_id>
<created>1288943355</created>
<follow_time>1288915200</follow_time>
<body_temperature></body_temperature>
<general_health></general_health>
<general_psychology></general_psychology>
<systolic_blood_pressure></systolic_blood_pressure>
<diastolic_blood_pressure></diastolic_blood_pressure>
<brest>1</brest>
<brest_info></brest_info>
<lochia>2</lochia>
<lochia_info>异常</lochia_info>
<uterus>2</uterus>
<uterus_info>知道</uterus_info>
<durative_ulcer>2</durative_ulcer>
<durative_ulcer_info>就是个2儿</durative_ulcer_info>
<post_other></post_other>
<pregnant_sort>2</pregnant_sort>
<pregnant_sort_info>异常</pregnant_sort_info>
<medical_advice></medical_advice>
<referral>2</referral>
<referral_reason>8</referral_reason>
<referral_org>9</referral_org>
<follow_next_time>1288999200</follow_next_time>
<follow_staff>4c7333276f141</follow_staff>
<medical_advice_info></medical_advice_info>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691BB</ext_uuid>
</row>

<row>
<identity_number>513101195410172524</identity_number>
<fid>89E032DE-EFD3-41FD-8C7E-0CF341D691E1</fid>
<org_id>511802104</org_id>
<staff_id>510103199901010001</staff_id>
<created>1288943355</created>
<follow_time>1288915200</follow_time>
<body_temperature></body_temperature>
<general_health></general_health>
<general_psychology></general_psychology>
<systolic_blood_pressure></systolic_blood_pressure>
<diastolic_blood_pressure></diastolic_blood_pressure>
<brest>1</brest>
<brest_info></brest_info>
<lochia>2</lochia>
<lochia_info>异常</lochia_info>
<uterus>2</uterus>
<uterus_info>知道</uterus_info>
<durative_ulcer>2</durative_ulcer>
<durative_ulcer_info>就是个3儿</durative_ulcer_info>
<post_other></post_other>
<pregnant_sort>2</pregnant_sort>
<pregnant_sort_info>异常</pregnant_sort_info>
<medical_advice></medical_advice>
<referral>2</referral>
<referral_reason>8</referral_reason>
<referral_org>9</referral_org>
<follow_next_time>1288999200</follow_next_time>
<follow_staff>4c7333276f141</follow_staff>
<medical_advice_info></medical_advice_info>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691AA</ext_uuid>
</row>
</table>
</tables>");
		/*$tmp=$client->ws_delete("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>511802104</org_id><identity_number>513101198203263821</identity_number><ext_uuid>77</ext_uuid></where>
");*/
		echo $tmp;
	}
}
?>