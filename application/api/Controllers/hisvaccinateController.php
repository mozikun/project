<?php
/**
 * @author whx
 * @todo  预防接种
 * @time  2013-1-8
 */
class api_hisvaccinateController extends controller 
{       
	private $wsdl_path;
	public function init()
	{
		$this->wsdl_path="wsdl/api_his_".parent::getControllerName().".wsdl";
	}
	/**
	 * api接口地址
	 *
	 */
	public function indexAction()
	{
		require_once(__SITEROOT."application/api/models/api_his_vaccinate.php");
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
		require_once(__SITEROOT."application/api/models/api_his_vaccinate.php");//model
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
	public function selectAction()
	{     
             
		$client=new SoapClient("http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT']."/".$this->wsdl_path);	
		 
		$tmp=$client->vaccinate_info("17","<?xml version='1.0' encoding='UTF-8'?><where><id>i_4c733a9e9e4a13.88795924</id></where>"); 
 		echo $tmp;
 	
	}
     public function updateAction(){   
         $client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);   
         $tmp=$client->vaccinate_update("17","<?xml version='1.0' encoding='UTF-8'?><where>   
             <id>i_4c733ac24baf51.68258288</id>
			<staff_id>afjdk</staff_id> 
			<vaccinum_name_1>123456</vaccinum_name_1>
<vaccinum_time_1>123456</vaccinum_time_1>
<vaccinum_part_1>123456</vaccinum_part_1>
<vaccinum_batch_1>123456</vaccinum_batch_1>
<vaccinum_effective_1>123456</vaccinum_effective_1>
<vaccinum_enterprises_1>123456</vaccinum_enterprises_1>
<vaccinum_doctor_1>123456</vaccinum_doctor_1>
<vaccinum_remark_1>123456</vaccinum_remark_1>
<vaccinum_time_2>123456</vaccinum_time_2>
<vaccinum_part_2>123456</vaccinum_part_2>
<vaccinum_batch_2>123456</vaccinum_batch_2>
<vaccinum_effective_2>123456</vaccinum_effective_2>
<vaccinum_enterprises_2>123456</vaccinum_enterprises_2>
<vaccinum_doctor_2>123456</vaccinum_doctor_2>
<vaccinum_remark_2>123456</vaccinum_remark_2>
<vaccinum_time_3>123456</vaccinum_time_3>
<vaccinum_part_3>123456</vaccinum_part_3>
<vaccinum_batch_3>123456</vaccinum_batch_3>
<vaccinum_effective_3>123456</vaccinum_effective_3>
<vaccinum_enterprises_3>123456</vaccinum_enterprises_3>
<vaccinum_doctor_3>123456</vaccinum_doctor_3>
<vaccinum_remark_3>123456</vaccinum_remark_3>
<vaccinum_name_2>123456</vaccinum_name_2>
<vaccinum_name_3>123456</vaccinum_name_3>

<date_of_birth>123456</date_of_birth>
<guardian>123456</guardian>
<relation>123456</relation>
<telephone>123456</telephone>
<family_address_city>123456</family_address_city>
<family_address_street>123456</family_address_street>
<census_register>123</census_register>
<census_register_province>123456</census_register_province>
<census_register_city>123456</census_register_city>
<census_register_area>123456</census_register_area>
<census_register_street>123456</census_register_street>
<immigration_time>123456</immigration_time>
<emigration_time>123456</emigration_time>
<emigration_cause>123456</emigration_cause>
<vaccinum_unusual_history>123456</vaccinum_unusual_history>
<vaccinate_no_no>123456</vaccinate_no_no>
<infect_history>123456</infect_history>
<created_card_time>123456</created_card_time>
<created_doc>123456</created_doc>

<ina_batch_1>123456</ina_batch_1>
<ina_effective_1>123456</ina_effective_1>
<ina_enterprises_1>123456</ina_enterprises_1>
<ina_doctor_1>123456</ina_doctor_1>
<ina_remark_1>123456</ina_remark_1>
<ina_time_2>123456</ina_time_2>
<ina_part_2>123456</ina_part_2>
<ina_batch_2>123456</ina_batch_2>
<ina_effective_2>123456</ina_effective_2>
<ina_enterprises_2>123456</ina_enterprises_2>
<ina_doctor_2>123456</ina_doctor_2>
<ina_remark_2>123456</ina_remark_2>
<hepatt_time>123456</hepatt_time>
<hepatt_part>123456</hepatt_part>
<hepatt_batch>123456</hepatt_batch>
<hepatt_effective>123456</hepatt_effective>
<hepatt_enterprises>123456</hepatt_enterprises>
<hepatt_doctor>123456</hepatt_doctor>
<hepatt_remark>123456</hepatt_remark>
<hepa_time_1>123456</hepa_time_1>
<hepa_part_1>123456</hepa_part_1>
<hepa_batch_1>123456</hepa_batch_1>
<hepa_effective_1>123456</hepa_effective_1>
<hepa_enterprises_1>123456</hepa_enterprises_1>
<hepa_doctor_1>123456</hepa_doctor_1>
<hepa_remark_1>123456</hepa_remark_1>
<hepa_time_2>123456</hepa_time_2>
<hepa_part_2>123456</hepa_part_2>
<hepa_batch_2>123456</hepa_batch_2>
<hepa_effective_2>123456</hepa_effective_2>
<hepa_enterprises_2>123456</hepa_enterprises_2>
<hepa_doctor_2>123456</hepa_doctor_2>
<hepa_remark_2>123456</hepa_remark_2>
<ina_time_3>123456</ina_time_3>
<ina_part_3>123456</ina_part_3>
<ina_batch_3>123456</ina_batch_3>
<ina_effective_3>123456</ina_effective_3>
<ina_enterprises_3>123456</ina_enterprises_3>
<ina_doctor_3>123456</ina_doctor_3>
<ina_remark_3>123456</ina_remark_3>
<ina_time_4>123456</ina_time_4>
<ina_part_4>123456</ina_part_4>
<ina_batch_4>123456</ina_batch_4>
<ina_effective_4>123456</ina_effective_4>
<ina_enterprises_4>123456</ina_enterprises_4>
<ina_doctor_4>123456</ina_doctor_4>
<ina_remark_4>123456</ina_remark_4>


<dpt_doctor_1>123456</dpt_doctor_1>
<dpt_remark_1>123456</dpt_remark_1>
<dpt_time_2>123456</dpt_time_2>
<dpt_part_2>123456</dpt_part_2>
<dpt_batch_2>123456</dpt_batch_2>
<dpt_effective_2>123456</dpt_effective_2>
<dpt_enterprises_2>123456</dpt_enterprises_2>
<dpt_doctor_2>123456</dpt_doctor_2>
<dpt_remark_2>123456</dpt_remark_2>
<dpt_time_3>123456</dpt_time_3>
<dpt_part_3>123456</dpt_part_3>
<dpt_batch_3>123456</dpt_batch_3>
<dpt_effective_3>123456</dpt_effective_3>
<dpt_enterprises_3>123456</dpt_enterprises_3>
<dpt_doctor_3>123456</dpt_doctor_3>
<dpt_remark_3>123456</dpt_remark_3>
<dpt_time_4>123456</dpt_time_4>
<dpt_part_4>123456</dpt_part_4>
<dpt_batch_4>123456</dpt_batch_4>
<dpt_effective_4>123456</dpt_effective_4>
<dpt_enterprises_4>123456</dpt_enterprises_4>
<dpt_doctor_4>123456</dpt_doctor_4>
<dpt_remark_4>123456</dpt_remark_4>
<rubella_time>123456</rubella_time>
<rubella_part>123456</rubella_part>
<rubella_batch>123456</rubella_batch>
<rubella_effective>123456</rubella_effective>
<rubella_enterprises>123456</rubella_enterprises>
<rubella_doctor>123456</rubella_doctor>
<rubella_remark>123456</rubella_remark>
<lepra_time>123456</lepra_time>
<lepra_part>123456</lepra_part>
<lepra_batch>123456</lepra_batch>
<lepra_effective>123456</lepra_effective>
<lepra_enterprises>123456</lepra_enterprises>
<lepra_doctor>123456</lepra_doctor>
<lepra_remark>123456</lepra_remark>
<mmr_time_1>123456</mmr_time_1>
<mmr_part_1>123456</mmr_part_1>
<mmr_batch_1>123456</mmr_batch_1>
<mmr_effective_1>123456</mmr_effective_1>
<mmr_enterprises_1>123456</mmr_enterprises_1>
<mmr_doctor_1>123456</mmr_doctor_1>
<mmr_remark_1>123456</mmr_remark_1>
<mmr_time_2>123456</mmr_time_2>
<mmr_part_2>123456</mmr_part_2>
<mmr_batch_2>123456</mmr_batch_2>
<mmr_effective_2>123456</mmr_effective_2>
<mmr_enterprises_2>123456</mmr_enterprises_2>
<mmr_doctor_2>123456</mmr_doctor_2>
<mmr_remark_2>123456</mmr_remark_2>
<mm_time>123456</mm_time>
<mm_part>123456</mm_part>
<mm_batch>123456</mm_batch>
<mm_effective>123456</mm_effective>
<mm_enterprises>123456</mm_enterprises>
<mm_doctor>123456</mm_doctor>
<mm_remark>123456</mm_remark>
<measles_time_1>123456</measles_time_1>
<measles_part_1>123456</measles_part_1>
<measles_batch_1>123456</measles_batch_1>
<measles_effective_1>123456</measles_effective_1>
<measles_enterprises_1>123456</measles_enterprises_1>
<measles_doctor_1>123456</measles_doctor_1>
<measles_remark_1>123456</measles_remark_1>
<measles_time_2>123456</measles_time_2>
<measles_part_2>123456</measles_part_2>
<measles_batch_2>123456</measles_batch_2>
<measles_effective_2>123456</measles_effective_2>
<measles_enterprises_2>123456</measles_enterprises_2>
<measles_doctor_2>123456</measles_doctor_2>
<measles_remark_2>123456</measles_remark_2>
<a_time_1>123456</a_time_1>
<a_part_1>123456</a_part_1>
<a_batch_1>123456</a_batch_1>
<a_effective_1>123456</a_effective_1>
<a_enterprises_1>123456</a_enterprises_1>
<a_doctor_1>123456</a_doctor_1>
<a_remark_1>123456</a_remark_1>
<a_time_2>123456</a_time_2>
<a_part_2>123456</a_part_2>
<a_batch_2>123456</a_batch_2>
<a_effective_2>123456</a_effective_2>
<a_enterprises_2>123456</a_enterprises_2>
<a_doctor_2>123456</a_doctor_2>
<a_remark_2>123456</a_remark_2>
<ac_time_1>123456</ac_time_1>
<ac_part_1>123456</ac_part_1>
<ac_batch_1>123456</ac_batch_1>
<ac_effective_1>123456</ac_effective_1>
<ac_enterprises_1>123456</ac_enterprises_1>
<ac_doctor_1>123456</ac_doctor_1>
<ac_remark_1>123456</ac_remark_1>
<ac_time_2>123456</ac_time_2>
<ac_part_2>123456</ac_part_2>
<ac_batch_2>123456</ac_batch_2>
<ac_effective_2>123456</ac_effective_2>
<ac_enterprises_2>123456</ac_enterprises_2>
<ac_doctor_2>123456</ac_doctor_2>
<ac_remark_2>123456</ac_remark_2>
<att_time_1>123456</att_time_1>
<att_part_1>123456</att_part_1>
<att_batch_1>123456</att_batch_1>
<att_effective_1>123456</att_effective_1>
<att_enterprises_1>123456</att_enterprises_1>
<att_doctor_1>123456</att_doctor_1>
<att_remark_1>123456</att_remark_1>
<att_time_2>123456</att_time_2>
<att_part_2>123456</att_part_2>
<att_batch_2>123456</att_batch_2>
<att_effective_2>123456</att_effective_2>
<att_enterprises_2>123456</att_enterprises_2>
<att_doctor_2>123456</att_doctor_2>
<att_remark_2>123456</att_remark_2>
<ina_time_1>123456</ina_time_1>
<ina_part_1>123456</ina_part_1>
<hepatitis_time_1>123456</hepatitis_time_1>
<hepatitis_part_1>123456</hepatitis_part_1>
<hepatitis_batch_1>123456</hepatitis_batch_1>
<hepatitis_effective_1>123456</hepatitis_effective_1>
<hepatitis_enterprises_1>123456</hepatitis_enterprises_1>
<hepatitis_doctor_1>123456</hepatitis_doctor_1>
<hepatitis_remark_1>123456</hepatitis_remark_1>
<hepatitis_time_2>123456</hepatitis_time_2>
<hepatitis_part_2>123456</hepatitis_part_2>
<hepatitis_batch_2>123456</hepatitis_batch_2>
<hepatitis_effective_2>123456</hepatitis_effective_2>
<hepatitis_enterprises_2>123456</hepatitis_enterprises_2>
<hepatitis_doctor_2>123456</hepatitis_doctor_2>
<hepatitis_remark_2>123456</hepatitis_remark_2>
<hepatitis_time_3>123456</hepatitis_time_3>
<hepatitis_part_3>123456</hepatitis_part_3>
<hepatitis_batch_3>123456</hepatitis_batch_3>
<hepatitis_effective_3>123456</hepatitis_effective_3>
<hepatitis_enterprises_3>123456</hepatitis_enterprises_3>
<hepatitis_doctor_3>123456</hepatitis_doctor_3>
<hepatitis_remark_3>123456</hepatitis_remark_3>
<bcg_time>123456</bcg_time>
<bcg_part>123456</bcg_part>
<bcg_batch>123456</bcg_batch>
<bcg_effective>123456</bcg_effective>
<bcg_enterprises>123456</bcg_enterprises>
<bcg_doctor>123456</bcg_doctor>
<bcg_remark>123456</bcg_remark>
<polio_time_1>123456</polio_time_1>
<polio_part_1>123456</polio_part_1>
<polio_batch_1>123456</polio_batch_1>
<polio_effective_1>123456</polio_effective_1>
<polio_enterprises_1>123456</polio_enterprises_1>
<polio_doctor_1>123456</polio_doctor_1>
<polio_remark_1>123456</polio_remark_1>
<polio_time_2>123456</polio_time_2>
<polio_part_2>123456</polio_part_2>
<polio_batch_2>123456</polio_batch_2>
<polio_effective_2>123456</polio_effective_2>
<polio_enterprises_2>123456</polio_enterprises_2>
<polio_doctor_2>123456</polio_doctor_2>
<polio_remark_2>123456</polio_remark_2>
<polio_time_3>123456</polio_time_3>
<polio_part_3>123456</polio_part_3>
<polio_batch_3>123456</polio_batch_3>
<polio_effective_3>123456</polio_effective_3>
<polio_enterprises_3>123456</polio_enterprises_3>
<polio_doctor_3>123456</polio_doctor_3>
<polio_remark_3>123456</polio_remark_3>
<polio_time_4>123456</polio_time_4>
<polio_part_4>123456</polio_part_4>
<polio_batch_4>123456</polio_batch_4>
<polio_effective_4>123456</polio_effective_4>
<polio_enterprises_4>123456</polio_enterprises_4>
<polio_doctor_4>123456</polio_doctor_4>
<polio_remark_4>123456</polio_remark_4>
<dpt_time_1>123456</dpt_time_1>
<dpt_part_1>123456</dpt_part_1>
<dpt_batch_1>123456</dpt_batch_1>
<dpt_effective_1>123456</dpt_effective_1>
<dpt_enterprises_1>123456</dpt_enterprises_1>
<ext_uuid>122</ext_uuid>


<org_id>123456</org_id>

			
			
             </where>");   
 	echo $tmp;	
     }
	 public function deleteAction(){ 
		$client=new SoapClient("http://".$_SERVER['HTTP_HOST']."/".$this->wsdl_path);	
		$tmp=$client->vaccinate_delete("17","<?xml version='1.0' encoding='UTF-8'?><where><id>i_4c733ac24baf51.68258288</id></where>"); 
 		echo $tmp;
	 }
}
?>