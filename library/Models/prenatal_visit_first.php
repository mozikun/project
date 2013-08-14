<?php
require_once ('db_oracle.php');
/**
 *注释:第一次产前访视记录
 *
 *
 **/
class Tprenatal_visit_first extends dao_oracle{
	 public $__table = 'prenatal_visit_first';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:填表时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $filling_time;
	 public $_filling_time_type='number';
	/**
 	 * 注释:下次随访日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $follow_next_time;
	 public $_follow_next_time_type='number';
	/**
 	 * 注释:丈夫姓名
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $husband_name;
	 public $_husband_name_type='varchar2';
	/**
 	 * 注释:丈夫年龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $husband_age;
	 public $_husband_age_type='number';
	/**
 	 * 注释:丈夫电话
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $husband_phone;
	 public $_husband_phone_type='varchar2';
	/**
 	 * 注释:填表孕周
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $gestational_weeks;
	 public $_gestational_weeks_type='varchar2';
	/**
 	 * 注释:孕次
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $gravidity;
	 public $_gravidity_type='varchar2';
	/**
 	 * 注释:产次
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $parity;
	 public $_parity_type='varchar2';
	/**
 	 * 注释:末次月经
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $last_menstrual;
	 public $_last_menstrual_type='number';
	/**
 	 * 注释:预产期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $expected_date_of_confine;
	 public $_expected_date_of_confine_type='number';
	/**
 	 * 注释:妇科手术史
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $fksss;
	 public $_fksss_type='varchar2';
	/**
 	 * 注释:妇科手术史说明
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $fksss_info;
	 public $_fksss_info_type='varchar2';
	/**
 	 * 注释:既往史
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $clinical_history;
	 public $_clinical_history_type='varchar2';
	/**
 	 * 注释:家族史
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $family_history;
	 public $_family_history_type='varchar2';
	/**
 	 * 注释:家族史说明
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $family_history_info;
	 public $_family_history_info_type='varchar2';
	/**
 	 * 注释:既往史说明
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $disease_history_info;
	 public $_disease_history_info_type='varchar2';
	/**
 	 * 注释:身高
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $height;
	 public $_height_type='varchar2';
	/**
 	 * 注释:体重
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $weight;
	 public $_weight_type='varchar2';
	/**
 	 * 注释:体质指数
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bmi;
	 public $_bmi_type='varchar2';
	/**
 	 * 注释:收缩压
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $systolic_blood_pressure;
	 public $_systolic_blood_pressure_type='varchar2';
	/**
 	 * 注释:舒张压
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $diastolic_blood_pressure;
	 public $_diastolic_blood_pressure_type='varchar2';
	/**
 	 * 注释:心脏
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $auscultation_heart;
	 public $_auscultation_heart_type='varchar2';
	/**
 	 * 注释:心脏异常内容
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $auscultation_heart_info;
	 public $_auscultation_heart_info_type='varchar2';
	/**
 	 * 注释:肺部
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $auscultation_lung;
	 public $_auscultation_lung_type='varchar2';
	/**
 	 * 注释:肺部异常详细
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $auscultation_lung_info;
	 public $_auscultation_lung_info_type='varchar2';
	/**
 	 * 注释:外阴
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $vulva;
	 public $_vulva_type='varchar2';
	/**
 	 * 注释:外阴异常内容
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $vulva_info;
	 public $_vulva_info_type='varchar2';
	/**
 	 * 注释:阴道
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $vaginal;
	 public $_vaginal_type='varchar2';
	/**
 	 * 注释:阴道异常内容
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $vaginal_info;
	 public $_vaginal_info_type='varchar2';
	/**
 	 * 注释:宫颈
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $cervix;
	 public $_cervix_type='varchar2';
	/**
 	 * 注释:宫颈异常内容
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $cervix_info;
	 public $_cervix_info_type='varchar2';
	/**
 	 * 注释:子宫
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $uterus;
	 public $_uterus_type='varchar2';
	/**
 	 * 注释:子宫异常内容
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $uterus_info;
	 public $_uterus_info_type='varchar2';
	/**
 	 * 注释:附件
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dnexauteri;
	 public $_dnexauteri_type='varchar2';
	/**
 	 * 注释:附件异常内容
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $dnexauteri_info;
	 public $_dnexauteri_info_type='varchar2';
	/**
 	 * 注释:血红蛋白值
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $hemoglobin;
	 public $_hemoglobin_type='varchar2';
	/**
 	 * 注释:白细胞计数值
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $wbc_count;
	 public $_wbc_count_type='varchar2';
	/**
 	 * 注释:血小板计数值
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $platelet_count;
	 public $_platelet_count_type='varchar2';
	/**
 	 * 注释:血常规其他
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $blood_other;
	 public $_blood_other_type='varchar2';
	/**
 	 * 注释:尿蛋白
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $azoturia;
	 public $_azoturia_type='varchar2';
	/**
 	 * 注释:尿糖
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $glucose_in_urine;
	 public $_glucose_in_urine_type='varchar2';
	/**
 	 * 注释:尿酮体
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $ketone;
	 public $_ketone_type='varchar2';
	/**
 	 * 注释:尿潜血
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $urine_occult_blood;
	 public $_urine_occult_blood_type='varchar2';
	/**
 	 * 注释:尿常规其他
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $urine_other;
	 public $_urine_other_type='varchar2';
	/**
 	 * 注释:血清谷丙转氨酶
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $sgpt;
	 public $_sgpt_type='varchar2';
	/**
 	 * 注释:血清谷草转氨酶
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $sgot;
	 public $_sgot_type='varchar2';
	/**
 	 * 注释:白蛋白
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $seralbumin;
	 public $_seralbumin_type='varchar2';
	/**
 	 * 注释:总胆红素
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $total_bilirubin;
	 public $_total_bilirubin_type='varchar2';
	/**
 	 * 注释:结合胆红素
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $bilirubin_direct;
	 public $_bilirubin_direct_type='varchar2';
	/**
 	 * 注释:血清肌酐
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $serum_creatinine;
	 public $_serum_creatinine_type='varchar2';
	/**
 	 * 注释:血尿素氮
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $bun;
	 public $_bun_type='varchar2';
	/**
 	 * 注释:血钾浓度
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $serum_potassium;
	 public $_serum_potassium_type='varchar2';
	/**
 	 * 注释:血钠浓度
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $serum_natrium;
	 public $_serum_natrium_type='varchar2';
	/**
 	 * 注释:阴道分泌物
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $vaginal_fluid;
	 public $_vaginal_fluid_type='varchar2';
	/**
 	 * 注释:阴道分泌物说明
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $vaginal_fluid_info;
	 public $_vaginal_fluid_info_type='varchar2';
	/**
 	 * 注释:梅毒血清学试验
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $result_of_vdrl;
	 public $_result_of_vdrl_type='varchar2';
	/**
 	 * 注释:HIV抗体检测
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $div_antibody_check;
	 public $_div_antibody_check_type='varchar2';
	/**
 	 * 注释:总体评估
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $overall_assessment;
	 public $_overall_assessment_type='varchar2';
	/**
 	 * 注释:转诊（有无）
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $referral;
	 public $_referral_type='varchar2';
	/**
 	 * 注释:转诊原因
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $referral_reason;
	 public $_referral_reason_type='varchar2';
	/**
 	 * 注释:转诊机构
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $referral_org;
	 public $_referral_org_type='varchar2';
	/**
 	 * 注释:总体评估内容
	 * 
	 * 
	 * @var VARCHAR2(300)
	 **/
 	 public $overall_assessment_info;
	 public $_overall_assessment_info_type='varchar2';
	/**
 	 * 注释:孕产史-流产
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $abortion;
	 public $_abortion_type='number';
	/**
 	 * 注释:孕产史-死产
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $stillbirth;
	 public $_stillbirth_type='number';
	/**
 	 * 注释:孕产史-死胎
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fetal_death;
	 public $_fetal_death_type='number';
	/**
 	 * 注释:孕产史-新生儿死亡
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $neonatal_death;
	 public $_neonatal_death_type='number';
	/**
 	 * 注释:随访责任医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $follow_staff;
	 public $_follow_staff_type='varchar2';
	/**
 	 * 注释:出生缺陷儿
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $birth_defects;
	 public $_birth_defects_type='number';
	/**
 	 * 注释:血型
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $blood_type;
	 public $_blood_type_type='varchar2';
	/**
 	 * 注释:阴道清洁度
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $vaginal_cleanliness;
	 public $_vaginal_cleanliness_type='varchar2';
	/**
 	 * 注释:乙型肝炎表面抗原
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatitis_b_surface_antigen;
	 public $_hepatitis_b_surface_antigen_type='varchar2';
	/**
 	 * 注释:乙型肝炎表面抗体
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatitis_b_surface_antibody;
	 public $_hepatitis_b_surface_antibody_type='varchar2';
	/**
 	 * 注释:乙型肝炎e抗原
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatitis_b_e_antigen;
	 public $_hepatitis_b_e_antigen_type='varchar2';
	/**
 	 * 注释:乙型肝炎e抗体
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatitis_b_e_antibody;
	 public $_hepatitis_b_e_antibody_type='varchar2';
	/**
 	 * 注释:乙型肝炎核心抗体
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatitis_b_core_antibody;
	 public $_hepatitis_b_core_antibody_type='varchar2';
	/**
 	 * 注释:保健指导
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $health_guide;
	 public $_health_guide_type='varchar2';
	/**
 	 * 注释:阴道分娩次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $number_vaginal_delivery;
	 public $_number_vaginal_delivery_type='number';
	/**
 	 * 注释:剖宫产次
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cesarean_delivery_times;
	 public $_cesarean_delivery_times_type='number';
	/**
 	 * 注释:个人史其他项说明
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $personal_history_info;
	 public $_personal_history_info_type='varchar2';
	/**
 	 * 注释:B超
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $bc;
	 public $_bc_type='varchar2';
	/**
 	 * 注释:保健指导其他项
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $health_guide_info;
	 public $_health_guide_info_type='varchar2';
	/**
 	 * 注释:血糖
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $blood_sugar;
	 public $_blood_sugar_type='varchar2';
	/**
 	 * 注释:个人史
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $personal_history;
	 public $_personal_history_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
