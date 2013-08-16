<?php
/**
 * @author 我好笨
 * @todo 本类用于高血压接口
 */
class api_phshyperController extends controller 
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
		require_once(__SITEROOT."application/api/models/api_phs_hypertension.php");
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
		require_once(__SITEROOT."application/api/models/api_phs_hypertension.php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($classname,"wsdl_".$classname,"/api/".$classname."/index");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.$this->wsdl_path,"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}
    /**
     * api_phsihaController::zltestAction()
     * 
     * 中联联调
     * 
     * @return void
     */
    public function zltestAction()
    {
        //$ws_url="http://172.16.11.251/wsdl/api_phs_iha.wsdl";
		//$client=new SoapClient($ws_url);
        require_once(__SITEROOT."application/api/models/api_phs_hypertension.php");
        $client=new phshyper();
        echo $client->ws_update('54254047451180212C2201',iconv('gbk','utf-8',file_get_contents(__SITEROOT."gxy.txt")));
    }
	/**
	 * 用于测试
	 *
	 */
	public function ws_testAction()
	{
	   require_once(__SITEROOT."application/api/models/api_phs_hypertension.php");
		$client=new SoapClient("http://172.16.11.245/".$this->wsdl_path);
        /*echo $client->ws_select_all("45254124-6","<?xml version='1.0' encoding='UTF-8'?><where><org_id>45254124-6</org_id></where>");*/
        echo $client->ws_select_persons("45254124-6","<?xml version='1.0' encoding='UTF-8'?><where><org_id>45254124-6</org_id><identity_number>51310119430330081x</identity_number></where>");
        exit;
        $client=new phshyper();
        echo $client->ws_select_single("17","<where><org_id>511802104</org_id>
<identity_number>513101196604173333</identity_number>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691E0</ext_uuid>
</where>");
        exit;
		$tmp=$client->ws_update("17","<?xml version='1.0' encoding='UTF-8'?>
<tables>
<table name='hypertension_follow_up'>
<row>
<identity_number>513101195001152127</identity_number>
<staff_id>510103199901010001</staff_id>
<created>1316141425</created>
<follow_time>1316131200</follow_time>
<follow_next_time>1317340800</follow_next_time>
<follow_type>2</follow_type>
<medication_compliance></medication_compliance>
<adverse_drug>2</adverse_drug>
<adverse_drug_info>不知道</adverse_drug_info>
<follow_up_result></follow_up_result>
<referral_reason></referral_reason>
<organization></organization>
<symptom_other>测试的</symptom_other>
<diastolic_blood_pressure></diastolic_blood_pressure>
<follow_result>有高血压病史。血压控制满意，有药物不良反应。建议维持目前治疗，2周后随访</follow_result>
<pregnancy>2</pregnancy>
<physical_base_uuid></physical_base_uuid>
<height></height>
<blood_difference></blood_difference>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691E0</ext_uuid>
<org_id>511802104</org_id>
</row>

<row>
<identity_number>513101195410172524</identity_number>
<staff_id>510103199901010001</staff_id>
<created>1316141425</created>
<follow_time>1316131200</follow_time>
<follow_next_time>1317340800</follow_next_time>
<follow_type>2</follow_type>
<medication_compliance></medication_compliance>
<adverse_drug>2</adverse_drug>
<adverse_drug_info>不知道</adverse_drug_info>
<follow_up_result></follow_up_result>
<referral_reason></referral_reason>
<organization></organization>
<symptom_other>烦得很</symptom_other>
<diastolic_blood_pressure></diastolic_blood_pressure>
<follow_result>有高血压病史。血压控制不满意</follow_result>
<pregnancy>2</pregnancy>
<physical_base_uuid></physical_base_uuid>
<height></height>
<blood_difference></blood_difference>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691E1</ext_uuid>
<org_id>511802104</org_id>
</row>

<row>
<identity_number>513101193809172121</identity_number>
<staff_id>510103199901010001</staff_id>
<created>1316141425</created>
<follow_time>1316131200</follow_time>
<follow_next_time>1317340800</follow_next_time>
<follow_type>2</follow_type>
<medication_compliance></medication_compliance>
<adverse_drug>2</adverse_drug>
<adverse_drug_info>不知道</adverse_drug_info>
<follow_up_result></follow_up_result>
<referral_reason></referral_reason>
<organization></organization>
<symptom_other>测试的鸟鸟</symptom_other>
<diastolic_blood_pressure></diastolic_blood_pressure>
<follow_result>没有高血压病史，控制个鸭儿。</follow_result>
<pregnancy>2</pregnancy>
<physical_base_uuid></physical_base_uuid>
<height></height>
<blood_difference></blood_difference>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691E2</ext_uuid>
<org_id>511802104</org_id>
</row>

</table>

<table name='follow_up_drugs'>
<row>
<identity_number>513101195001152127</identity_number>
<staff_id>510103199901010001</staff_id>
<created>1316141425</created>
<drug_name>ads发热</drug_name>
<drug_amount>3</drug_amount>
<drug_frequency>1</drug_frequency>
<follow_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691E1</follow_uuid>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691A1</ext_uuid>
<org_id>511802104</org_id>
</row>

<row>
<identity_number>513101195410172524</identity_number>
<staff_id>510103199901010001</staff_id>
<created>1316141425</created>
<drug_amount>2</drug_amount>
<drug_frequency>1</drug_frequency>
<drug_name>萨拉丁佛</drug_name>
<drug_amount>3</drug_amount>
<drug_frequency>1</drug_frequency>
<follow_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691E0</follow_uuid>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691A0</ext_uuid>
<org_id>511802104</org_id>
</row>

<row>
<identity_number>513101193809172121</identity_number>
<staff_id>510103199901010001</staff_id>
<created>1316141425</created>
<drug_name>巍峨全方位111</drug_name>
<drug_amount>2</drug_amount>
<drug_frequency>1</drug_frequency>
<ext_uuid>3</ext_uuid>
<org_id>511802104</org_id>
<staff_id></staff_id>
<created>1316141425</created>
<drug_name>阿里斯顿</drug_name>
<drug_amount>3</drug_amount>
<drug_frequency>1</drug_frequency>
<follow_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691E2</follow_uuid>
<ext_uuid>89E032DE-EFD3-41FD-8C7E-0CF341D691A2</ext_uuid>
<org_id>511802104</org_id>
</row>
</table>
</tables>");
		echo $tmp;
	}
}
?>