<?php
require_once ('db_oracle.php');
/**
 *注释:婚前医学检查表
 *
 *
 **/
class Tpremarital_examination extends dao_oracle{
	 public $__table = 'premarital_examination';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:医生档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:个人档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:添加记录时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:填写日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fill_time;
	 public $_fill_time_type='number';
	/**
 	 * 注释:对方姓名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $name_of_the_partner;
	 public $_name_of_the_partner_type='varchar2';
	/**
 	 * 注释:对方编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $sn_of_the_partner;
	 public $_sn_of_the_partner_type='varchar2';
	/**
 	 * 注释:检查日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $date_of_examination;
	 public $_date_of_examination_type='number';
	/**
 	 * 注释:血缘关系|radio|1=>无,2=>表,3=>堂,4=>其他
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $blood_kinship;
	 public $_blood_kinship_type='varchar2';
	/**
 	 * 注释:血缘关系其他
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $blood_kinship_other;
	 public $_blood_kinship_other_type='varchar2';
	/**
 	 * 注释:过去病史|checkbox|1=>无,2=>心脏病,3=>肺结核,4=>肝脏病,5=>泌尿生殖系疾病,6=>糖尿病,7=>高血压,8=>精神病,9=>性病,10=>癫痫,11=>甲亢,12=>先天疾患
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $past_disease_history;
	 public $_past_disease_history_type='varchar2';
	/**
 	 * 注释:过去病史其他
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $past_disease_history_other;
	 public $_past_disease_history_other_type='varchar2';
	/**
 	 * 注释:手术史|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $operation_history;
	 public $_operation_history_type='varchar2';
	/**
 	 * 注释:手术史其它
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $operation_history_other;
	 public $_operation_history_other_type='varchar2';
	/**
 	 * 注释:现病史|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $present_disease_history;
	 public $_present_disease_history_type='varchar2';
	/**
 	 * 注释:现病史内容
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $present_disease_history_info;
	 public $_present_disease_history_info_type='varchar2';
	/**
 	 * 注释:初潮年龄
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $age_of_menarche;
	 public $_age_of_menarche_type='varchar2';
	/**
 	 * 注释:经期
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $menstrual_period;
	 public $_menstrual_period_type='varchar2';
	/**
 	 * 注释:周期
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $menstrual_cycle;
	 public $_menstrual_cycle_type='varchar2';
	/**
 	 * 注释:月经量|radio|1=>多,2=>中,3=>少
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $menstruation;
	 public $_menstruation_type='varchar2';
	/**
 	 * 注释:痛经
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $dysmenorrhea;
	 public $_dysmenorrhea_type='varchar2';
	/**
 	 * 注释:末次月经
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $lmp_time;
	 public $_lmp_time_type='number';
	/**
 	 * 注释:既往婚育史|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $fertile_history;
	 public $_fertile_history_type='varchar2';
	/**
 	 * 注释:既往婚育史内容|radio|1=>丧偶,2=>离异
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $fertile_history_info;
	 public $_fertile_history_info_type='varchar2';
	/**
 	 * 注释:足月产
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $fh_term;
	 public $_fh_term_type='varchar2';
	/**
 	 * 注释:早产
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $fh_preterm;
	 public $_fh_preterm_type='varchar2';
	/**
 	 * 注释:流产
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $fh_abortion;
	 public $_fh_abortion_type='varchar2';
	/**
 	 * 注释:子女数
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $number_of_children;
	 public $_number_of_children_type='varchar2';
	/**
 	 * 注释:与遗传有关的家族史|checkbox|1=>无,2=>盲,3=>聋,4=>哑,5=>精神病,6=>先天性智力低下,7=>先天性心脏病,8=>血友病,9=>糖尿病,10=>其他
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $family_history;
	 public $_family_history_type='varchar2';
	/**
 	 * 注释:与遗传有关的家族史其他
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $family_history_other;
	 public $_family_history_other_type='varchar2';
	/**
 	 * 注释:患者与本人关系
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $relationship_with_patient;
	 public $_relationship_with_patient_type='varchar2';
	/**
 	 * 注释:家族近亲婚配|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $family_inbreeding;
	 public $_family_inbreeding_type='varchar2';
	/**
 	 * 注释:家族近亲婚配内容|radio|1=>父母,2=>祖父母,3=>外祖父母
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $family_inbreeding_info;
	 public $_family_inbreeding_info_type='varchar2';
	/**
 	 * 注释:医师签名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $signature_of_doctor;
	 public $_signature_of_doctor_type='varchar2';
	/**
 	 * 注释:转诊医院
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $referral_hospital;
	 public $_referral_hospital_type='varchar2';
	/**
 	 * 注释:转诊日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $referral_time;
	 public $_referral_time_type='number';
	/**
 	 * 注释:预约复诊日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $return_visit_time;
	 public $_return_visit_time_type='number';
	/**
 	 * 注释:出具《婚前医学检查证明》日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cpe_time;
	 public $_cpe_time_type='number';
	/**
 	 * 注释:主检医师签名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $md_signature;
	 public $_md_signature_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
}
