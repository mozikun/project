<?php
/**
 * @author 我好笨
 * @todo 导入社区系统数据需要用到的函数，因导入数据涉及过多逻辑，因此代码可能太长，分文件存储，导入健康体检表
 */


/**
 * 导入健康体检表记录
 *
 * @param string $uuid 个人档案号
 */
function import_examination($uuid,$newuuid,$staff_id,$org_id,$db,$dbname)
{
	mysql_select_db($dbname,$db);
	mysql_query("set names utf8");
    $time=time();
    //从MySQL中查询数据，其主表为ehr_hypertension_followup
    $result=mysql_query("select * from ehr_general_inspection where serial_number='$uuid'");
    while ($rd=mysql_fetch_array($result))
    {
    	$hy_uuid='';
    	//只有在主表有记录时才执行后面的操作
    	if (!empty($rd))
    	{
    		require_once __SITEROOT."library/Models/examination_table.php";
    		$examination_table=new Texamination_table();
    		$examination_table->staff_id = $staff_id;//医生档案号
    		$examination_table->id = $newuuid;
    		$examination_table->org_id=$org_id;
    		$examination_table->serial_number=$newuuid;
    		$examination_table->created=$rd['created'];
    		$examination_table->examination_date = $rd['inspection_time'];
    		$examination_table->examination_doctor=$staff_id;
    		$hy_uuid=uniqid('et',true);
    		$examination_table->uuid = $hy_uuid;//随访编号
    		$examination_table->insert();
    		$examination_table->free_statement();
    		
    		$mysql_table=array('lab_inspection_hematology','lab_inspection_body_fluid','lab_inspection_biochemistry','lab_inspection_immunity','lab_inspection_immunity','general_inspection_table','exercise','diet_features','smoking_status','drinking','occupational_hazards','hospitalized_cases','main_drug_case','target_organ_and_clinical','immune_programming_preventio','ph_evaluation_checkup_head','ph_evaluation_checkup_chest','ph_evaluation_checkup_lamb','ph_evaluation_checkup_base','ph_evaluation_checkup_woman');
    		$table_array=array();
    		foreach ($mysql_table as $k=>$v)
    		{
    			$table_source=mysql_query("select * from $v where main_uuid='".$rd['uuid']."' limit 1");
    			if ($table_source)
    			{
    				$table_array[$v]=mysql_fetch_array($table_source);
    			}
    		}
    		require_once __SITEROOT."library/Models/et_health_assessment.php";
    		$et_health_assessment1 =new Tet_health_assessment();
			$et_health_assessment1->health_assessment = $rd['health_assessment'];
			$et_health_assessment1->health_exception =  $rd['health_assessmen_abnormal'];//健康异常
			$et_health_assessment1->created = $rd['created'];//添加记录时间
			$et_health_assessment1->uuid = $hy_uuid;//编号
			$et_health_assessment1->examination_id = $hy_uuid;//健康体检id
			$et_health_assessment1->staff_id = $staff_id;//医生档案号
			$et_health_assessment1->id = $newuuid;//个人档案号
			$et_health_assessment1->insert();
			$et_health_assessment1->free_statement();
    		require_once __SITEROOT."library/Models/et_health_guidance.php";
    		$et_health_guidance =new Tet_health_guidance();
			$et_health_guidance->health_assessment = $rd['health_guide'];
			$et_health_guidance->risk_factor_col =  $rd['risk_factors_control_other'];//健康异常
			$et_health_guidance->created = $rd['created'];//添加记录时间
			$et_health_guidance->uuid = $hy_uuid;//编号
			$et_health_guidance->examination_id = $hy_uuid;//健康体检id
			$et_health_guidance->staff_id = $staff_id;//医生档案号
			$et_health_guidance->id = $newuuid;//个人档案号
			$et_health_guidance->insert();
			$et_health_guidance->free_statement();
    		require_once __SITEROOT."library/Models/et_examination.php";
    		$et_examination =new Tet_examination();
			$et_examination->hemoglobin = $table_array['lab_inspection_hematology']['haematoglobin'];
			$et_examination->leukocyte = $table_array['lab_inspection_hematology']['lencocyte_count'];
			$et_examination->platelet = $table_array['lab_inspection_hematology']['blood_platelets_count'];
			$et_examination->u_protein = $table_array['lab_inspection_hematology']['urine_protein'];
			
			$et_examination->u_protein = $table_array['lab_inspection_body_fluid']['urine_protein'];
			$et_examination->urine = $table_array['lab_inspection_body_fluid']['urine_glucose'];
			$et_examination->ketone = $table_array['lab_inspection_body_fluid']['urine_acetone_bodies'];
			$et_examination->uoblood = $table_array['lab_inspection_body_fluid']['urine_occult_blood'];
			$et_examination->u_other = $table_array['lab_inspection_body_fluid']['urine_other'];
			$et_examination->fecalblood = $table_array['lab_inspection_body_fluid']['fecal_occult_blood'];
			
			$et_examination->fbglucoseh = $table_array['lab_inspection_biochemistry']['blood_glucose'];
			$et_examination->microurine = $table_array['lab_inspection_biochemistry']['urine_microalbumin'];
			$et_examination->alanine = $table_array['lab_inspection_biochemistry']['oro_glutamate_pyruvate_transaminase'];
			$et_examination->serum = $table_array['lab_inspection_biochemistry']['oro_serum_glutamic_oxaloacetic_transaminase'];
			$et_examination->albumin = $table_array['lab_inspection_biochemistry']['A_G'];
			$et_examination->tbilirubin = $table_array['lab_inspection_biochemistry']['serum_total_bilirubin'];
			$et_examination->screatinine = $table_array['lab_inspection_biochemistry']['crt'];
			$et_examination->serumpc = $table_array['lab_inspection_biochemistry']['serum_Potassium'];
			$et_examination->sodium = $table_array['lab_inspection_biochemistry']['serum_calcium'];
			$et_examination->tcholesterol = $table_array['lab_inspection_biochemistry']['total_cholesterin'];
			$et_examination->triglyceride = $table_array['lab_inspection_biochemistry']['serum_gysz'];
			$et_examination->lowcholesterol = $table_array['lab_inspection_biochemistry']['ldlc'];
			$et_examination->highcholesterol =  $table_array['lab_inspection_biochemistry']['hdlc'];//健康异常
			$et_examination->ghemoglobin =  $table_array['lab_inspection_biochemistry']['hba1c'];//健康异常
			
			$et_examination->hbsurface =  $table_array['lab_inspection_immunity']['hepatitis_B_virus_surface_antigen'];//健康异常
			
			$et_examination->fundus =  $table_array['lab_inspection_synthesis']['fundus'];//健康异常
			$et_examination->ecg =  $table_array['lab_inspection_synthesis']['ECG'];//健康异常
			$et_examination->xrayfilm =  $table_array['lab_inspection_synthesis']['x_ray_film'];//健康异常
			$et_examination->bc =  $table_array['lab_inspection_synthesis']['b_super'];//健康异常
			$et_examination->csmear =  $table_array['lab_inspection_synthesis']['cervical_smear'];//健康异常
			$et_examination->examination_other =  $table_array['lab_inspection_synthesis']['other_other'];//健康异常
			
			$et_examination->created = $rd['created'];//添加记录时间
			$et_examination->uuid = $hy_uuid;//编号
			$et_examination->examination_id = $hy_uuid;//健康体检id
			$et_examination->staff_id = $staff_id;//医生档案号
			$et_examination->id = $newuuid;//个人档案号
			$et_examination->insert();
			$et_examination->free_statement();
			
    		require_once __SITEROOT."library/Models/et_symptom.php";
    		if (!empty($table_array['general_inspection_table']))
    		{
	    		$et_symptom =new Tet_symptom();
				$et_symptom->symptom = $table_array['general_inspection_table']['symptom'];
				$et_symptom->symptom_other = $table_array['general_inspection_table']['symptom_zz_other'];
	    		$et_symptom->created = $rd['created'];//添加记录时间
				$et_symptom->uuid = $hy_uuid;//编号
				$et_symptom->examination_id = $hy_uuid;//健康体检id
				$et_symptom->staff_id = $staff_id;//医生档案号
				$et_symptom->id = $newuuid;//个人档案号
				$et_symptom->insert();
				$et_symptom->free_statement();
    		}
			
    		require_once __SITEROOT."library/Models/et_general_condition.php";
    		$et_general_condition =new Tet_general_condition();
			$et_general_condition->temperature = $table_array['general_inspection_table']['body_temperature'];
			$et_general_condition->pulse = $table_array['general_inspection_table']['pulses'];
			$et_general_condition->breathing_rate = $table_array['general_inspection_table']['breath'];
			$et_general_condition->blood_pressure_left_s = $table_array['general_inspection_table']['left_blood_pressure'];
			$et_general_condition->height = $table_array['general_inspection_table']['height'];
			$et_general_condition->weight = $table_array['general_inspection_table']['weight'];
			$et_general_condition->bmi = $table_array['general_inspection_table']['bmi'];
			$et_general_condition->waistline = $table_array['general_inspection_table']['waist_circumference'];
			$et_general_condition->older_cognitive_functions = $table_array['general_inspection_table']['old_rzgn'];
			$et_general_condition->mmse = $table_array['general_inspection_table']['zf1'];
			$et_general_condition->older_affective_state = $table_array['general_inspection_table']['old_qgzt'];
			$et_general_condition->depression = $table_array['general_inspection_table']['zf2'];
			
			$et_general_condition->elder_health_status = $table_array['ehr_general_inspection']['old_emotionspg'];
			$et_general_condition->elder_living_skills = $table_array['ehr_general_inspection']['cognitive_elderly'];
    		$et_general_condition->created = $rd['created'];//添加记录时间
			$et_general_condition->uuid = $hy_uuid;//编号
			$et_general_condition->examination_id = $hy_uuid;//健康体检id
			$et_general_condition->staff_id = $staff_id;//医生档案号
			$et_general_condition->id = $newuuid;//个人档案号
			$et_general_condition->insert();
			$et_general_condition->free_statement();
    		require_once __SITEROOT."library/Models/et_lifestyle.php";
    		$et_lifestyle =new Tet_lifestyle();
			$et_lifestyle->sport_frequence = $table_array['exercise']['exercise_frequency'];
			$et_lifestyle->sport_time = $table_array['exercise']['exercise_every_day'];
			$et_lifestyle->exercise_duration = $table_array['exercise']['adhere_exercise_time'];
			$et_lifestyle->exercising_way = $table_array['exercise']['exercise'];
			
			$et_lifestyle->food_habit = $table_array['diet_features']['diet'];
			
			$et_lifestyle->smoke = $table_array['smoking_status']['smoking_status'];
			$et_lifestyle->smoke_quantity = $table_array['smoking_status']['smoke_quantity'];
			$et_lifestyle->begin_smoke_age = $table_array['smoking_status']['begin_smoke_age'];
			$et_lifestyle->stop_smoke_age = $table_array['smoking_status']['age_quit'];
			
			$et_lifestyle->drink_frequency = $table_array['drinking']['drink_frequency1'];
			$et_lifestyle->drink_quantity = $table_array['drinking']['drink_scalar1'];
			$et_lifestyle->drink = $table_array['drinking']['is_alcohol'];
			$et_lifestyle->stop_drinking_age = $table_array['drinking']['alcohol_age'];
			$et_lifestyle->begin_drinking_age = $table_array['drinking']['start_drinking_age'];
			$et_lifestyle->begin_drinking_age = $table_array['drinking']['is_last_couple_year'];
			$et_lifestyle->drink_style = $table_array['drinking']['drink_style1'];
			
			$et_lifestyle->occupational_exposure = $table_array['occupational_hazards']['is_occupational_exposure'];
			$et_lifestyle->occupation = $table_array['occupational_hazards']['occupational'];
			$et_lifestyle->occupation_age = $table_array['occupational_hazards']['occupational_exposure_years'];
			$et_lifestyle->chemistry = $table_array['occupational_hazards']['chemical_name'];
			$et_lifestyle->chemistry_protection_info = $table_array['occupational_hazards']['is_chemical_protection'];
			$et_lifestyle->dust = $table_array['occupational_hazards']['fc_name'];
			$et_lifestyle->dust_protection = $table_array['occupational_hazards']['is_fc'];
			$et_lifestyle->ray = $table_array['occupational_hazards']['ray_name'];
			$et_lifestyle->ray_protection = $table_array['occupational_hazards']['is_measures_ray_products'];
			$et_lifestyle->physical = $table_array['occupational_hazards']['wl_name'];
			$et_lifestyle->physical_protection = $table_array['occupational_hazards']['is_wl'];
			$et_lifestyle->other_types = $table_array['occupational_hazards']['qt_name'];
			$et_lifestyle->other_types_info = $table_array['occupational_hazards']['is_qt'];
			
    		$et_lifestyle->created = $rd['created'];//添加记录时间
			$et_lifestyle->uuid = $hy_uuid;//编号
			$et_lifestyle->examination_id = $hy_uuid;//健康体检id
			$et_lifestyle->staff_id = $staff_id;//医生档案号
			$et_lifestyle->id = $newuuid;//个人档案号
			$et_lifestyle->insert();
			$et_lifestyle->free_statement();
			
    		require_once __SITEROOT."library/Models/et_hospitalization_history.php";
    		if (!empty($table_array['hospitalized_cases']))
    		{
	    		$et_hospitalization_history =new Tet_hospitalization_history();
				$et_hospitalization_history->be_hospitalized_time = $table_array['hospitalized_cases']['admission_time'];
				$et_hospitalization_history->leave_hospital_time = $table_array['hospitalized_cases']['discharge_time'];
				$et_hospitalization_history->reason = $table_array['hospitalized_cases']['reason'];
				$et_hospitalization_history->record_no = $table_array['hospitalized_cases']['record_no'];
				$et_hospitalization_history->organization = $table_array['hospitalized_cases']['medical_institutions'];
	    		$et_hospitalization_history->created = $rd['created'];//添加记录时间
				$et_hospitalization_history->uuid = $hy_uuid;//编号
				$et_hospitalization_history->examination_id = $hy_uuid;//健康体检id
				$et_hospitalization_history->staff_id = $staff_id;//医生档案号
				$et_hospitalization_history->id = $newuuid;//个人档案号
				$et_hospitalization_history->insert();
				$et_hospitalization_history->free_statement();
    		}
			
    		require_once __SITEROOT."library/Models/et_main_drug_use.php";
    		if (!empty($table_array['main_drug_case']))
    		{
	    		$et_main_drug_use =new Tet_main_drug_use();
				$et_main_drug_use->drug_name = $table_array['main_drug_case']['drug_name'];
				$et_main_drug_use->drug_usage = $table_array['main_drug_case']['drug_usage'];
				$et_main_drug_use->drug_dosage = $table_array['main_drug_case']['drug_does_unit'];
				$et_main_drug_use->drug_time = $table_array['main_drug_case']['drug_use_time'];
				$et_main_drug_use->drug_compliance = $table_array['main_drug_case']['drug_compliance'];
	    		$et_main_drug_use->created = $rd['created'];//添加记录时间
				$et_main_drug_use->uuid = $hy_uuid;//编号
				$et_main_drug_use->examination_id = $hy_uuid;//健康体检id
				$et_main_drug_use->staff_id = $staff_id;//医生档案号
				$et_main_drug_use->id = $newuuid;//个人档案号
				$et_main_drug_use->insert();
				$et_main_drug_use->free_statement();
    		}
			
    		require_once __SITEROOT."library/Models/et_mhealth.php";
    		if (!empty($table_array['target_organ_and_clinical']))
    		{
	    		$et_mhealth =new Tet_mhealth();
				$et_mhealth->ceredisease = $table_array['target_organ_and_clinical']['cerebrovascular'];
				$et_mhealth->ceredisease_other = $table_array['target_organ_and_clinical']['cerebrovascular_other'];
				$et_mhealth->kidneydisease = $table_array['target_organ_and_clinical']['kidney_disease'];
				$et_mhealth->kidneydisease_other = $table_array['target_organ_and_clinical']['kidney_disease_other'];
				$et_mhealth->heartdisease = $table_array['target_organ_and_clinical']['heart_disease'];
				$et_mhealth->heartdisease_other = $table_array['target_organ_and_clinical']['heart_disease_other'];
				$et_mhealth->vasculardisease = $table_array['target_organ_and_clinical']['vas_detail1'];
				$et_mhealth->vasculardisease_other = $table_array['target_organ_and_clinical']['vas_detail1_other'];
				$et_mhealth->eyedisease = $table_array['target_organ_and_clinical']['eyeground_detail1'];
				$et_mhealth->eyedisease_other = $table_array['target_organ_and_clinical']['eyeground_detail1_other'];
				$et_mhealth->nervousdisease = $table_array['target_organ_and_clinical']['nervous_system'];
				$et_mhealth->nervousdisease_other = $table_array['target_organ_and_clinical']['nervous_system_other'];
				$et_mhealth->otherdisease = $table_array['target_organ_and_clinical']['other_detail'];
				$et_mhealth->otherdisease_other = $table_array['target_organ_and_clinical']['other_detail_other'];
	    		$et_mhealth->created = $rd['created'];//添加记录时间
				$et_mhealth->uuid = $hy_uuid;//编号
				$et_mhealth->examination_id = $hy_uuid;//健康体检id
				$et_mhealth->staff_id = $staff_id;//医生档案号
				$et_mhealth->id = $newuuid;//个人档案号
				$et_mhealth->insert();
				$et_mhealth->free_statement();
    		}
			
    		require_once __SITEROOT."library/Models/et_nonepi_vaccination.php";
    		if (!empty($table_array['immune_programming_preventio']))
    		{
	    		$et_nonepi_vaccination =new Tet_nonepi_vaccination();
				$et_nonepi_vaccination->vaccination_name = $table_array['immune_programming_preventio']['name'];
				$et_nonepi_vaccination->vaccination_time = $table_array['immune_programming_preventio']['inoculate_time'];
				$et_nonepi_vaccination->vaccination_org = $table_array['immune_programming_preventio']['inoculate_institutions'];
	    		$et_nonepi_vaccination->created = $rd['created'];//添加记录时间
				$et_nonepi_vaccination->uuid = $hy_uuid;//编号
				$et_nonepi_vaccination->examination_id = $hy_uuid;//健康体检id
				$et_nonepi_vaccination->staff_id = $staff_id;//医生档案号
				$et_nonepi_vaccination->id = $newuuid;//个人档案号
				$et_nonepi_vaccination->insert();
				$et_nonepi_vaccination->free_statement();
    		}
			
    		require_once __SITEROOT."library/Models/et_organ.php";
    		$et_organ =new Tet_organ();
			$et_organ->lips = $table_array['ph_evaluation_checkup_head']['lips'];
			$et_organ->pharyngeal_portion = $table_array['ph_evaluation_checkup_head']['pharyngeal'];
			$et_organ->left_eye = $table_array['ph_evaluation_checkup_head']['left_eyesight'];
			$et_organ->left_eye_corrected_vision = $table_array['ph_evaluation_checkup_head']['left_eye_correction'];
			$et_organ->right_eye = $table_array['ph_evaluation_checkup_head']['right_eyesight'];
			$et_organ->right_eye_corrected_vision = $table_array['ph_evaluation_checkup_head']['right_eye_correction'];
			$et_organ->hearing = $table_array['ph_evaluation_checkup_head']['hearing'];
			$et_organ->energizing_function = $table_array['ph_evaluation_checkup_head']['motor_function'];
			$et_organ->skin = $table_array['ph_evaluation_checkup_head']['cutis1'];
			$et_organ->skin_other = $table_array['ph_evaluation_checkup_head']['cutis1_other'];
			$et_organ->sclera = $table_array['ph_evaluation_checkup_head']['sclera'];
			$et_organ->sclera_other = $table_array['ph_evaluation_checkup_head']['sclera_other'];
			$et_organ->lymph_node = $table_array['ph_evaluation_checkup_head']['lymph_gland1'];
			$et_organ->lymph_node_other = $table_array['ph_evaluation_checkup_head']['lymph_gland1_other'];
			
			$et_organ->lung_barrel_chest = $table_array['ph_evaluation_checkup_chest']['barrel_chest'];
			$et_organ->lung_sounds = $table_array['ph_evaluation_checkup_chest']['breath_sounds'];
			$et_organ->lung_sounds_exception = $table_array['ph_evaluation_checkup_chest']['breath_sounds_other'];
			$et_organ->lung_rale = $table_array['ph_evaluation_checkup_chest']['rale'];
			$et_organ->lung_rale_other = $table_array['ph_evaluation_checkup_chest']['rale_other'];
			$et_organ->heart_rate = $table_array['ph_evaluation_checkup_chest']['heart_rate'];
			$et_organ->heart_noise = $table_array['ph_evaluation_checkup_chest']['noise'];
			$et_organ->heart_noise_info = $table_array['ph_evaluation_checkup_chest']['noise_other'];
			$et_organ->abdominal_tenderness = $table_array['ph_evaluation_checkup_chest']['tenderness'];
			$et_organ->abdominal_tenderness_info = $table_array['ph_evaluation_checkup_chest']['tenderness_other'];
			$et_organ->abdominal_mass = $table_array['ph_evaluation_checkup_chest']['mass'];
			$et_organ->abdominal_mass_info = $table_array['ph_evaluation_checkup_chest']['mass_other'];
			$et_organ->abdominal_hepatomegaly = $table_array['ph_evaluation_checkup_chest']['hepatomegaly'];
			$et_organ->abdominal_hepatomegaly_info = $table_array['ph_evaluation_checkup_chest']['hepatomegaly_other'];
			$et_organ->abdominal_splenomegaly_info = $table_array['ph_evaluation_checkup_chest']['splenomegaly_other'];
			$et_organ->shifting_dullness = $table_array['ph_evaluation_checkup_chest']['mobility_voiced'];
			$et_organ->mammary_gland = $table_array['ph_evaluation_checkup_chest']['breast'];
			$et_organ->mammary_gland_other = $table_array['ph_evaluation_checkup_chest']['breast_other'];
			
			$et_organ->ramus_inferior_edema = $table_array['ph_evaluation_checkup_lamb']['lower_body_edema'];
			$et_organ->foot_arterial_pulse = $table_array['ph_evaluation_checkup_lamb']['dorsalis_pedis_artery'];
			
			$et_organ->rectal_touch = $table_array['ph_evaluation_checkup_base']['dre'];
			$et_organ->rectal_touch_other = $table_array['ph_evaluation_checkup_base']['dre_other'];
			$et_organ->others = $table_array['ph_evaluation_checkup_base']['checkup_base_other_other'];
			
			$et_organ->gynae_vulva = $table_array['ph_evaluation_checkup_woman']['vulva'];
			$et_organ->gynae_vulva_exception = $table_array['ph_evaluation_checkup_woman']['vulva_other'];
			$et_organ->gynae_cunt = $table_array['ph_evaluation_checkup_woman']['vaginal'];
			$et_organ->gynae_cunt_exception = $table_array['ph_evaluation_checkup_woman']['vaginal_other'];
			$et_organ->gynae_cervix = $table_array['ph_evaluation_checkup_woman']['cervix'];
			$et_organ->gynae_cervix_exception = $table_array['ph_evaluation_checkup_woman']['cervix_other'];
			$et_organ->gynae_uterus = $table_array['ph_evaluation_checkup_woman']['cervixti'];
			$et_organ->gynae_uterus_exception = $table_array['ph_evaluation_checkup_woman']['cervixti_other'];
			$et_organ->gynae_appendix = $table_array['ph_evaluation_checkup_woman']['annex'];
			$et_organ->gynae_appendix_exception = $table_array['ph_evaluation_checkup_woman']['annex_other'];
    		$et_organ->created = $rd['created'];//添加记录时间
			$et_organ->uuid = $hy_uuid;//编号
			$et_organ->examination_id = $hy_uuid;//健康体检id
			$et_organ->staff_id = $staff_id;//医生档案号
			$et_organ->id = $newuuid;//个人档案号
			$et_organ->insert();
			$et_organ->free_statement();
    	}
    	echo ("有健康体检导入，请检查<br />");
    }
}