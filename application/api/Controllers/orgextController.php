<?php
class api_orgextController extends controller {
	public function initAction(){
	}
	public function hospitalinfoAction(){
		require_once(__SITEROOT.'application/api/models/api_org_ext.php');		
		$server = new SoapServer(__SITEROOT.'wsdl/api_org_ext.wsdl');
		$server->setClass('api_org_ext');		      
        $server->handle();
        /*
        $xml_string = "<?xml version='1.0' encoding='UTF-8'?><where><org_id>444444-1</org_id><number>2</number></where>";
        $ext = new api_org_ext();
        echo $et->hospital_info('1',$xml_string);
        */
      /*  $xml_string="<?xml version='1.0' encoding='UTF-8'?>
        <tables>
        <table name='chs_center'>
        <row>
            <org_id>444444-7</org_id>
            <year>2014</year>
			<ext_uuid>8888888888</ext_uuid>
			<created>2012-05-16</created>
			<updated>2012-05-16</updated> 
			<health_org_code>00001</health_org_code> 
			<org_name>测试上里镇</org_name>
			<org_property_economy_code>1</org_property_economy_code>
			<org_property_type_code>2222</org_property_type_code>
			<org_property_manage_code>3</org_property_manage_code>
			<org_property_region_code>4</org_property_region_code>
			<address>测试上里镇街道111</address>
			<postal_code>3</postal_code>
			<telephone_number_area>028</telephone_number_area> 
			<telephone_number>66666666</telephone_number>
			<email>327636979@qq.com</email>
			<host_domain>www.health.com</host_domain>
			<build_date>2012-08-09</build_date>
			<regionalism_adscription>2</regionalism_adscription> 
			<org_type>1</org_type> 
			<org_under_type>3</org_under_type> 
			<register_bankroll>2222</register_bankroll>
			<principal>陈涛</principal> 
			<is_nation_autonomy>1</is_nation_autonomy>
			<is_medicare_point_hospital>0</is_medicare_point_hospital>
			<is_new_point_hospital>1</is_new_point_hospital>
			<is_common_event_report>1</is_common_event_report>
			<computer_count>300</computer_count>
			<has_health_edu_equipment>0</has_health_edu_equipment>
			<child_chss_count>200</child_chss_count>
			<is_leaf>Y</is_leaf>
			<mount_type>1</mount_type>
        </row>
        <row>
            <org_id>444444-7</org_id>
            <year>2015</year>
			<ext_uuid>999999999999</ext_uuid>
			<created>2012-12-31</created>
			<updated>2012-12-31</updated> 
			<health_org_code>00002</health_org_code> 
			<org_name>测试上里镇</org_name>
			<org_property_economy_code>1</org_property_economy_code>
			<org_property_type_code>2222</org_property_type_code>
			<org_property_manage_code>3</org_property_manage_code>
			<org_property_region_code>4</org_property_region_code>
			<address>测试上里镇街道222</address>
			<postal_code>3</postal_code>
			<telephone_number_area>028</telephone_number_area> 
			<telephone_number>66666667</telephone_number>
			<email>327636979@qq.com</email>
			<host_domain>www.health.com</host_domain>
			<build_date>2012-08-09</build_date>
			<regionalism_adscription>2</regionalism_adscription> 
			<org_type>1</org_type> 
			<org_under_type>3</org_under_type> 
			<register_bankroll>2222</register_bankroll>
			<principal>陈涛</principal> 
			<is_nation_autonomy>1</is_nation_autonomy>
			<is_medicare_point_hospital>0</is_medicare_point_hospital>
			<is_new_point_hospital>0</is_new_point_hospital>
			<is_common_event_report>1</is_common_event_report>
			<computer_count>300</computer_count>
			<has_health_edu_equipment>1</has_health_edu_equipment>
			<child_chss_count>200</child_chss_count>
			<is_leaf>Y</is_leaf>
			<mount_type>1</mount_type>
        </row>
        </table>
        <table name='org_ext_1'>
           <row>
            <org_id>444444-7</org_id>
            <year>2014</year>
            <ext_uuid>777777777777</ext_uuid>
			<bed_number>11</bed_number>
			<bed_allnumber></bed_allnumber>
			<poverty_beds></poverty_beds>
			<totalbed_days></totalbed_days>
			<occupied_bed></occupied_bed>
			<poverty_occupiedbed></poverty_occupiedbed>
			<tbo_total></tbo_total>
			<observation_bed></observation_bed>
			<family_beds></family_beds>
			<percentage></percentage>
		  </row>
		  <row>
            <org_id>444444-7</org_id>
            <year>2015</year>
            <ext_uuid>66666666666</ext_uuid>
			<bed_number></bed_number>
			<bed_allnumber></bed_allnumber>
			<poverty_beds></poverty_beds>
			<totalbed_days></totalbed_days>
			<occupied_bed></occupied_bed>
			<poverty_occupiedbed></poverty_occupiedbed>
			<tbo_total></tbo_total>
			<observation_bed></observation_bed>
			<family_beds></family_beds>
			<percentage></percentage>
		  </row>
        </table>
        <table name='org_ext_2'>
          <row>
            <org_id>444444-7</org_id>
            <year>2015</year>
            <ext_uuid>555555</ext_uuid>
            <area></area>
            <operation_area></operation_area>
            <peril_area></peril_area>
            <hire_area></hire_area>
            <hire_operation_area></hire_operation_area>
            <basic_build_pro></basic_build_pro>
            <basic_build_area></basic_build_area>
            <actual_invest></actual_invest>
            <finance_invest></finance_invest>
            <self_invest></self_invest>
            <bank_invest></bank_invest>
            <finish_area></finish_area>
            <new_fixed_assets></new_fixed_assets>
            <new_sickbed></new_sickbed>
          </row>
        </table>
        <table name='org_ext_3'>
          <row>
            <org_id>444444-7</org_id>
            <year>2015</year>
            <ext_uuid>444444444</ext_uuid>
            <equipment_total_value></equipment_total_value>
            <equipment_total_number></equipment_total_number>
            <five_equipment></five_equipment>
            <over_100_equipment></over_100_equipment>
          </row>
        </table>
        <table name='org_ext_4'>
          <row>
            <org_id>444444-7</org_id>
            <year>2015</year>
            <ext_uuid>444444444</ext_uuid>
            <finance_income></finance_income>
            <superior_income></superior_income>
            <medical_outpatient_income></medical_outpatient_income>
            <medical_hospital_income></medical_hospital_income>
            <drug_outpatient_income></drug_outpatient_income>
            <drug_hospital_income></drug_hospital_income>
            <drug_other_income></drug_other_income>
            <medical_payout></medical_payout>
            <drug_payout></drug_payout>
            <drug_fee_payout></drug_fee_payout>
            <finance_payout></finance_payout>
            <other_payout></other_payout>
            <hr_payout></hr_payout>
            <retire_payout></retire_payout>
            <arrear_payout></arrear_payout>
            <arrear_payout_by_year></arrear_payout_by_year>
            <total_income></total_income>
            <medical_income></medical_income>
            <drug_income></drug_income>
            <total_payout></total_payout>
          </row>
        </table>
        <table name='org_ext_5'>
           <row>
            <org_id>444444-7</org_id>
            <year>2015</year>
            <ext_uuid>444444444</ext_uuid>
            <total_assets></total_assets>
            <current_assets></current_assets>
            <invest></invest>
            <capital_asserts></capital_asserts>
            <immateriality_assets></immateriality_assets>
            <owes_assets></owes_assets>
            <long_standing_assets></long_standing_assets>
            <net_assets></net_assets>
            <project_assets></project_assets>
            <fixed_assets></fixed_assets>
            <special_assets></special_assets>
           </row>
         </table>
          <table name='org_ext_6'>
           <row>
            <org_id>444444-7</org_id>
            <year>2015</year>
            <ext_uuid>444444444</ext_uuid>
            <area></area>
            <sickbed_number></sickbed_number>
            <sickbed_use_rate></sickbed_use_rate>
            <outpatient_per_year></outpatient_per_year>
            <emergency_per_year></emergency_per_year>
            <iatrology_man_count></iatrology_man_count>
            <gp_team_count></gp_team_count>
            <gp_count></gp_count>
            <community_nurse_count></community_nurse_count>
            <residenter_per_gp></residenter_per_gp>
            <residenter_per_nurse></residenter_per_nurse>
            <officesetting></officesetting>
            <service_setting></service_setting>
            <equipment_setting></equipment_setting>
           </row>
         </table>
        </tables>
        ";*/
        $xml_string ="<?xml version='1.0' encoding='UTF-8'?>
         <where>
           <table  name='chs_center'>
	           <rows>
	             <row>
	               <org_id>444444-7</org_id>
	               <year>2012</year>
	             </row>
	             <row>
	               <org_id>444444-7</org_id>
	               <year>2013</year>
	             </row>
	             <row>
	               <org_id>444444-7</org_id>
	               <year>2014</year>
	             </row>
	           </rows>
           </table>
         </where>
        ";
        $ext = new api_org_ext();
        echo $ext->ws_delete('1',$xml_string);
	}
	public function ws_et_resultAction(){
		$soapclient = new SoapClient('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/wsdl/api_phs_et_index.wsdl');

	}
	/**
	 * 用于生成wsdl
	 *
	 */
	public function generate_wsdlAction(){
		$class_name='api_org_ext';
		require_once(__SITEROOT."application/api/models/".$class_name.".php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($class_name,$class_name,__BASEPATH."api/orgext/hospitalinfo");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.'wsdl/'.$class_name.'.wsdl',"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}	
}
?>