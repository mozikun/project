<?php
class api_phsvisitsController extends controller {
	public function initAction(){
	}
	public function ws_visitsAction(){
		require_once(__SITEROOT.'application/api/models/api_phs_visit.php');		
		$server = new SoapServer(__SITEROOT.'wsdl/api_phs_visit.wsdl');
		$server->setClass('api_phs_visit');		      
        $server->handle();   
        /*$api_phs_visit = new api_phs_visit();
        $xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='child_visits'><row><identity_number>513101193301152525</identity_number><staff_id>510824198308190834</staff_id><created>1322064000</created><father_name>测试父亲1</father_name><father_occupation>农民</father_occupation><father_phone>5555555</father_phone><father_birth>1322064000</father_birth><mum_name>测试母亲1</mum_name><mum_occupation>农民</mum_occupation><mum_phone>5555555</mum_phone><mum_birth>1322064000</mum_birth><gestational_week>12</gestational_week><disease_pregnancy>3</disease_pregnancy><disease_pregnancy_other>母亲妊娠患病疾病情况1</disease_pregnancy_other><midwifery_name>XXXX机构1</midwifery_name><birth_complexion>4|7</birth_complexion><birth_complexion_other>臀位1</birth_complexion_other><sleepy_baby>2</sleepy_baby><sleepy_baby_info>2</sleepy_baby_info><deformity>2</deformity><deformity_info>是否有畸形1</deformity_info><hearing_screening>2</hearing_screening><weight>12</weight><height>12</height><breast_milk>3</breast_milk><body_temperature>37</body_temperature><respiratory_rate>23</respiratory_rate><pulses>22</pulses><complexion>2|7</complexion><complexion_other>面色1</complexion_other><bregma_width>5</bregma_width><bregma_height>6</bregma_height><bregma>4</bregma><bregma_other>前囟</bregma_other><eye>2</eye><eye_info>眼1</eye_info><limb>2</limb><limb_info>四肢活动度1</limb_info><ear>2</ear><ear_info>耳</ear_info><cervical_mass>2</cervical_mass><cervical_mass_info>颈部包块1</cervical_mass_info><nose>2</nose><nose_info>鼻1</nose_info><skin>2|4</skin><skin_other>皮肤</skin_other><oral_cavity>2</oral_cavity><oral_cavity_info>口腔1</oral_cavity_info><gmzz>2</gmzz><gmzz_info>肛门</gmzz_info><heart_lung>2</heart_lung><heart_lung_info>心肺</heart_lung_info><pudendum>2</pudendum><pudendum_info>外生殖器1</pudendum_info><abdomen>2</abdomen><abdomen_info>腹部</abdomen_info><rachis>2</rachis><rachis_info>脊柱1</rachis_info><umbilical_cord>4</umbilical_cord><umbilical_cord_other>脐带</umbilical_cord_other><referral_features>2</referral_features><reason>未知原因</reason><agencies_departments>QQQQ机构</agencies_departments><advising>2|3|4|5</advising><followup_time>1253548800</followup_time><next_followup_address>xxxxxxx未知地点</next_followup_address><next_followup_time>1255536000</next_followup_time><doctors_signature>4c73332782a3d</doctors_signature><apgar_score>3</apgar_score><neonatal_screening>3</neonatal_screening><current_weight>5</current_weight><feeding_amount>12</feeding_amount><feeding_times>3</feeding_times><vomit>2</vomit><defecate>2</defecate><stool_frequency>3</stool_frequency><jaundice_site>4</jaundice_site><neonatal_screening_other>新生儿疾病筛查1</neonatal_screening_other><ext_uuid>5555</ext_uuid><org_id>511804201</org_id></row>
        <row><identity_number>513101196912282322</identity_number><staff_id>510824198308190834</staff_id><created>1322064000</created><father_name>测试父亲1</father_name><father_occupation>农民</father_occupation><father_phone>5555555</father_phone><father_birth>1322064000</father_birth><mum_name>测试母亲1</mum_name><mum_occupation>农民</mum_occupation><mum_phone>5555555</mum_phone><mum_birth>1322064000</mum_birth><gestational_week>12</gestational_week><disease_pregnancy>3</disease_pregnancy><disease_pregnancy_other>母亲妊娠患病疾病情况1</disease_pregnancy_other><midwifery_name>XXXX机构1</midwifery_name><birth_complexion>4|7</birth_complexion><birth_complexion_other>臀位1</birth_complexion_other><sleepy_baby>2</sleepy_baby><sleepy_baby_info>2</sleepy_baby_info><deformity>2</deformity><deformity_info>是否有畸形1</deformity_info><hearing_screening>2</hearing_screening><weight>12</weight><height>12</height><breast_milk>3</breast_milk><body_temperature>37</body_temperature><respiratory_rate>23</respiratory_rate><pulses>22</pulses><complexion>2|7</complexion><complexion_other>面色1</complexion_other><bregma_width>5</bregma_width><bregma_height>6</bregma_height><bregma>4</bregma><bregma_other>前囟</bregma_other><eye>2</eye><eye_info>眼1</eye_info><limb>2</limb><limb_info>四肢活动度1</limb_info><ear>2</ear><ear_info>耳</ear_info><cervical_mass>2</cervical_mass><cervical_mass_info>颈部包块1</cervical_mass_info><nose>2</nose><nose_info>鼻1</nose_info><skin>2|4</skin><skin_other>皮肤</skin_other><oral_cavity>2</oral_cavity><oral_cavity_info>口腔1</oral_cavity_info><gmzz>2</gmzz><gmzz_info>肛门</gmzz_info><heart_lung>2</heart_lung><heart_lung_info>心肺</heart_lung_info><pudendum>2</pudendum><pudendum_info>外生殖器1</pudendum_info><abdomen>2</abdomen><abdomen_info>腹部</abdomen_info><rachis>2</rachis><rachis_info>脊柱1</rachis_info><umbilical_cord>4</umbilical_cord><umbilical_cord_other>脐带</umbilical_cord_other><referral_features>2</referral_features><reason>未知原因</reason><agencies_departments>QQQQ机构</agencies_departments><advising>2|3|4|5</advising><followup_time>1253548800</followup_time><next_followup_address>xxxxxxx未知地点</next_followup_address><next_followup_time>1255536000</next_followup_time><doctors_signature>4c73332782a3d</doctors_signature><apgar_score>3</apgar_score><neonatal_screening>3</neonatal_screening><current_weight>5</current_weight><feeding_amount>12</feeding_amount><feeding_times>3</feeding_times><vomit>2</vomit><defecate>2</defecate><stool_frequency>3</stool_frequency><jaundice_site>4</jaundice_site><neonatal_screening_other>新生儿疾病筛查1</neonatal_screening_other><ext_uuid>4444</ext_uuid><org_id>511804201</org_id></row>
        </table></tables>";
        echo $api_phs_visit->ws_update('1',$xml_string);*/
	}
	public function ws_visits_resultAction(){
		$soapclient = new SoapClient('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/wsdl/api_phs_visit.wsdl');
	}
	/**
	 * 用于生成wsdl
	 *
	 */
	public function generate_wsdlAction(){
		$class_name='api_phs_visit';
		require_once(__SITEROOT."application/api/models/".$class_name.".php");
		require_once(__SITEROOT."library/custom/SoapDiscovery.class.php");
		$wsdl_object = new SoapDiscovery($class_name,$class_name,"/api/phsvisits/ws_visits");
		$xml_file=$wsdl_object->getWSDL();
		$fp=fopen(__SITEROOT.'wsdl/'.$class_name.'.wsdl',"w+");
		fputs($fp,$xml_file);
		fclose($fp);
	}	
	public function test_whereAction(){
		$soapclient = new SoapClient(__SITEROOT.'wsdl/api_phs_visit.wsdl');
		$token      = $soapclient->ws_login('511804201','1');
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><where><org_id>511804201</org_id><identity_number>513101193301152525</identity_number><ext_uuid>5555</ext_uuid></where>";
		echo $soapclient->ws_select_single($token,$xml_string);
	}
	public function test_updateAction(){
		$soapclient = new SoapClient(__SITEROOT.'wsdl/api_phs_visit.wsdl');
		$token      = $soapclient->ws_login('511804201','1');
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><tables><table name='child_visits'><row><identity_number>513101193301152525</identity_number><staff_id>510824198308190834</staff_id><created>1322064000</created><father_name>测试父亲1</father_name><father_occupation>农民</father_occupation><father_phone>5555555</father_phone><father_birth>1322064000</father_birth><mum_name>测试母亲1</mum_name><mum_occupation>农民</mum_occupation><mum_phone>5555555</mum_phone><mum_birth>1322064000</mum_birth><gestational_week>12</gestational_week><disease_pregnancy>3</disease_pregnancy><disease_pregnancy_other>母亲妊娠患病疾病情况1</disease_pregnancy_other><midwifery_name>XXXX机构1</midwifery_name><birth_complexion>4|7</birth_complexion><birth_complexion_other>臀位1</birth_complexion_other><sleepy_baby>2</sleepy_baby><sleepy_baby_info>2</sleepy_baby_info><deformity>2</deformity><deformity_info>是否有畸形1</deformity_info><hearing_screening>2</hearing_screening><weight>12</weight><height>12</height><breast_milk>3</breast_milk><body_temperature>37</body_temperature><respiratory_rate>23</respiratory_rate><pulses>22</pulses><complexion>2|7</complexion><complexion_other>面色1</complexion_other><bregma_width>5</bregma_width><bregma_height>6</bregma_height><bregma>4</bregma><bregma_other>前囟</bregma_other><eye>2</eye><eye_info>眼1</eye_info><limb>2</limb><limb_info>四肢活动度1</limb_info><ear>2</ear><ear_info>耳</ear_info><cervical_mass>2</cervical_mass><cervical_mass_info>颈部包块1</cervical_mass_info><nose>2</nose><nose_info>鼻1</nose_info><skin>2|4</skin><skin_other>皮肤</skin_other><oral_cavity>2</oral_cavity><oral_cavity_info>口腔1</oral_cavity_info><gmzz>2</gmzz><gmzz_info>肛门</gmzz_info><heart_lung>2</heart_lung><heart_lung_info>心肺</heart_lung_info><pudendum>2</pudendum><pudendum_info>外生殖器1</pudendum_info><abdomen>2</abdomen><abdomen_info>腹部</abdomen_info><rachis>2</rachis><rachis_info>脊柱1</rachis_info><umbilical_cord>4</umbilical_cord><umbilical_cord_other>脐带</umbilical_cord_other><referral_features>2</referral_features><reason>未知原因</reason><agencies_departments>QQQQ机构</agencies_departments><advising>2|3|4|5</advising><followup_time>1253548800</followup_time><next_followup_address>xxxxxxx未知地点</next_followup_address><next_followup_time>1255536000</next_followup_time><doctors_signature>4c73332782a3d</doctors_signature><apgar_score>3</apgar_score><neonatal_screening>3</neonatal_screening><current_weight>5</current_weight><feeding_amount>12</feeding_amount><feeding_times>3</feeding_times><vomit>2</vomit><defecate>2</defecate><stool_frequency>3</stool_frequency><jaundice_site>4</jaundice_site><neonatal_screening_other>新生儿疾病筛查1</neonatal_screening_other><ext_uuid>5555</ext_uuid><org_id>511804201</org_id></row></table></tables>";
		echo $soapclient->ws_update($token,$xml_string);
	}
	
	
public function test_deleteAction(){
		$soapclient = new SoapClient(__SITEROOT.'wsdl/api_phs_visit.wsdl');
		$token      = $soapclient->ws_login('511802104','1');
		$xml_string="<?xml version='1.0' encoding='UTF-8'?><where><org_id>511802104</org_id><identity_number>510103199901011679</identity_number><ext_uuid>4324234</ext_uuid></where>";
		echo $soapclient->ws_delete($token,$xml_string);
	}
}
?>