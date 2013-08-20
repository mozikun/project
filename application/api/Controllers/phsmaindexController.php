<?php
/**
 * @author 我好笨
 * @todo 本类用于孕产妇第一次产前随访接口
 */
class api_phsmaindexController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_phs_maindex.php");
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
		require_once(__SITEROOT."application/api/models/api_phs_maindex.php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($classname,"wsdl_".$classname,"/api/".$classname."/index");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.$this->wsdl_path,"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}
    /**
     * api_phsmaindexController::zltestAction()
     * 
     * 2013-08-19 中联测试
     * 
     * @return void
     */
    public function zltestAction()
    {
        $ws_url="http://172.16.11.251/wsdl/api_phs_phsmaindex.wsdl";
		//$client=new SoapClient($ws_url);
        require_once(__SITEROOT."application/api/models/api_phs_maindex.php");
        $client=new phsmaindex();
        //echo $client->ws_update('54254047451180212C2201',iconv('gbk','utf-8',file_get_contents(__SITEROOT."ych.txt")));
        echo $client->ws_select_single('54254047451180212C2201',"<?xml version='1.0' encoding='UTF-8'?><where><org_id>54254047451180212C2201</org_id><identity_number>511027198109044321</identity_number><ext_uuid>ce4bb093-40d7-4ffc-9c65-c1a736c67f01</ext_uuid></where>");
    }
	/**
	 * 用于测试
	 *
	 */
	public function ws_testAction()
	{
		//$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);
		/*$tmp=$client->ws_select_single("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>511802104</org_id><identity_number>513101196812053821</identity_number><ext_uuid>2222</ext_uuid></where>
");*/
        require_once(__SITEROOT."application/api/models/api_phs_maindex.php");
       	$client=new SoapClient("http://172.16.11.245/".$this->wsdl_path);
        /*echo $client->ws_select_all("45254124-6","<?xml version='1.0' encoding='UTF-8'?><where><org_id>45254124-6</org_id></where>");*/
        echo $client->ws_select_persons("45254124-6","<?xml version='1.0' encoding='UTF-8'?><where><org_id>45254124-6</org_id><identity_number>513101198805221021</identity_number></where>");
        exit;
        $client=new phsmaindex();
		$tmp=$client->ws_update("17","<?xml version='1.0' encoding='UTF-8'?>
<tables>
<table name='prenatal_visit_first'>
<row>
<identity_number>513101195001152127</identity_number>
<org_id>511802104</org_id>
<created>1313984487</created>
<staff_id>510103199901010001</staff_id>
<filling_time>1313971200</filling_time>
<follow_next_time></follow_next_time>
<husband_name>李是猪</husband_name>
<husband_age></husband_age>
<husband_phone></husband_phone>
<gestational_weeks>18</gestational_weeks>
<gravidity>2</gravidity>
<parity>1</parity>
<last_menstrual>1313971200</last_menstrual>
<expected_date_of_confine>1338249600</expected_date_of_confine>
<fksss></fksss>
<fksss_info></fksss_info>
<clinical_history>||||||</clinical_history>
<family_history>1|2|-99</family_history>
<family_history_info>测试111测试</family_history_info>
<disease_history_info></disease_history_info>
<height>198</height>
<weight>78</weight>
<vaginal_fluid>3||</vaginal_fluid>
<follow_staff>510103199901010001</follow_staff>
<birth_defects>1</birth_defects>
<blood_type>1测血型</blood_type>
<vaginal_cleanliness></vaginal_cleanliness>
<hepatitis_b_surface_antigen>1</hepatitis_b_surface_antigen>
<hepatitis_b_surface_antibody>2</hepatitis_b_surface_antibody>
<hepatitis_b_e_antigen>4</hepatitis_b_e_antigen>
<hepatitis_b_e_antibody>4</hepatitis_b_e_antibody>
<hepatitis_b_core_antibody>5</hepatitis_b_core_antibody>
<health_guide>2|-99|||</health_guide>
<number_vaginal_delivery>1</number_vaginal_delivery>
<cesarean_delivery_times></cesarean_delivery_times>
<personal_history_info>1测</personal_history_info>
<bc></bc>
<health_guide_info>1测</health_guide_info>
<blood_sugar>99</blood_sugar>
<personal_history>2|-99|||</personal_history>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691E0</ext_uuid>
</row>

<row>
<identity_number>513101195410172524</identity_number>
<org_id>511802104</org_id>
<created>1313984487</created>
<staff_id>510103199901010001</staff_id>
<filling_time>1313971200</filling_time>
<follow_next_time></follow_next_time>
<husband_name>李建仁</husband_name>
<husband_age></husband_age>
<husband_phone></husband_phone>
<gestational_weeks>18</gestational_weeks>
<gravidity>2</gravidity>
<parity>1</parity>
<last_menstrual>1313971200</last_menstrual>
<expected_date_of_confine>1338249600</expected_date_of_confine>
<fksss></fksss>
<fksss_info></fksss_info>
<clinical_history>||||||</clinical_history>
<family_history>1|2|-99</family_history>
<family_history_info>测试2222测试</family_history_info>
<disease_history_info></disease_history_info>
<height>189</height>
<weight>123</weight>
<vaginal_fluid>3||</vaginal_fluid>
<follow_staff>510103199901010001</follow_staff>
<birth_defects>1</birth_defects>
<blood_type>2测血型</blood_type>
<vaginal_cleanliness></vaginal_cleanliness>
<hepatitis_b_surface_antigen>1</hepatitis_b_surface_antigen>
<hepatitis_b_surface_antibody>2</hepatitis_b_surface_antibody>
<hepatitis_b_e_antigen>4</hepatitis_b_e_antigen>
<hepatitis_b_e_antibody>4</hepatitis_b_e_antibody>
<hepatitis_b_core_antibody>5</hepatitis_b_core_antibody>
<health_guide>2|-99|||</health_guide>
<number_vaginal_delivery>1</number_vaginal_delivery>
<cesarean_delivery_times></cesarean_delivery_times>
<personal_history_info>2测</personal_history_info>
<bc></bc>
<health_guide_info>2测</health_guide_info>
<blood_sugar>99</blood_sugar>
<personal_history>2|-99|||</personal_history>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691E1</ext_uuid>
</row>

<row>
<identity_number>513101193809172121</identity_number>
<org_id>511802104</org_id>
<created>1313984487</created>
<staff_id>510103199901010001</staff_id>
<filling_time>1313971200</filling_time>
<follow_next_time></follow_next_time>
<husband_name>李詪</husband_name>
<husband_age></husband_age>
<husband_phone></husband_phone>
<gestational_weeks>18</gestational_weeks>
<gravidity>2</gravidity>
<parity>1</parity>
<last_menstrual>1313971200</last_menstrual>
<expected_date_of_confine>1338249600</expected_date_of_confine>
<fksss></fksss>
<fksss_info></fksss_info>
<clinical_history>||||||</clinical_history>
<family_history>1|2|-99</family_history>
<family_history_info>测试3333测试</family_history_info>
<disease_history_info></disease_history_info>
<height></height>
<weight></weight>
<vaginal_fluid>3||</vaginal_fluid>
<follow_staff>510103199901010001</follow_staff>
<birth_defects>1</birth_defects>
<blood_type>3测血型</blood_type>
<vaginal_cleanliness></vaginal_cleanliness>
<hepatitis_b_surface_antigen>1</hepatitis_b_surface_antigen>
<hepatitis_b_surface_antibody>2</hepatitis_b_surface_antibody>
<hepatitis_b_e_antigen>4</hepatitis_b_e_antigen>
<hepatitis_b_e_antibody>4</hepatitis_b_e_antibody>
<hepatitis_b_core_antibody>5</hepatitis_b_core_antibody>
<health_guide>2|-99|||</health_guide>
<number_vaginal_delivery>1</number_vaginal_delivery>
<cesarean_delivery_times></cesarean_delivery_times>
<personal_history_info>3测</personal_history_info>
<bc></bc>
<health_guide_info>3测</health_guide_info>
<blood_sugar>99</blood_sugar>
<personal_history>2|-99|||</personal_history>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691E2</ext_uuid>
</row>
</table>
</tables>");
		/*$tmp=$client->ws_delete("17","<?xml version='1.0' encoding='UTF-8'?><where><org_id>511802104</org_id><identity_number>513101196812053821</identity_number><ext_uuid>2222</ext_uuid></where>
");*/
		echo $tmp;
	}
}
?>