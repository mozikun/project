<?php
require_once ('db_oracle.php');
/**
 *注释:3岁儿童健康检查记录表
 *
 *
 **/
class Tchild_physical_age_three extends dao_oracle{
	 public $__table = 'child_physical_age_three';
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
 	 * 注释:随访日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $vist_time;
	 public $_vist_time_type='number';
	/**
 	 * 注释:体重(kg)
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $weight;
	 public $_weight_type='varchar2';
	/**
 	 * 注释:体重情况|radio|1=>上,2=>中,3=>下
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $weight_info;
	 public $_weight_info_type='varchar2';
	/**
 	 * 注释:身长(cm)
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $height;
	 public $_height_type='varchar2';
	/**
 	 * 注释:身长情况|radio|1=>上,2=>中,3=>下
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $height_info;
	 public $_height_info_type='varchar2';
	/**
 	 * 注释:体格发育评价|radio|1=>正常,2=>低体重,3=>消瘦,4=>发育迟缓,5=>肥胖
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $developmental_assessment;
	 public $_developmental_assessment_type='varchar2';
	/**
 	 * 注释:面色|radio|1=>红润,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $complexion;
	 public $_complexion_type='varchar2';
	/**
 	 * 注释:面色异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $complexion_info;
	 public $_complexion_info_type='varchar2';
	/**
 	 * 注释:步态|radio|1=>正常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gait;
	 public $_gait_type='varchar2';
	/**
 	 * 注释:步态异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $gait_info;
	 public $_gait_info_type='varchar2';
	/**
 	 * 注释:眼|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $eye;
	 public $_eye_type='varchar2';
	/**
 	 * 注释:眼异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $eye_info;
	 public $_eye_info_type='varchar2';
	/**
 	 * 注释:耳|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ear;
	 public $_ear_type='varchar2';
	/**
 	 * 注释:耳异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $ear_info;
	 public $_ear_info_type='varchar2';
	/**
 	 * 注释:心肺|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $heart_lung;
	 public $_heart_lung_type='varchar2';
	/**
 	 * 注释:心肺异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $heart_lung_info;
	 public $_heart_lung_info_type='varchar2';
	/**
 	 * 注释:肝脾|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hepatosplenography;
	 public $_hepatosplenography_type='varchar2';
	/**
 	 * 注释:肝脾异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hepatosplenography_info;
	 public $_hepatosplenography_info_type='varchar2';
	/**
 	 * 注释:发育评估行为|radio|1=>通过,2=>未通过
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $behavior;
	 public $_behavior_type='varchar2';
	/**
 	 * 注释:发育评估行为未通过
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $behavior_info;
	 public $_behavior_info_type='varchar2';
	/**
 	 * 注释:发育评估社交|radio|1=>通过,2=>未通过
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $social;
	 public $_social_type='varchar2';
	/**
 	 * 注释:发育评估社交未通过
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $social_info;
	 public $_social_info_type='varchar2';
	/**
 	 * 注释:幼儿期患病情况|checkbox|1=>无,2=>肺炎,3=>麻疹,4=>贫血,5=>营养不良,6=>佝偻病,7=>因腹泻住院,8=>因外伤住院,9=>其它
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $prevalence_infancy;
	 public $_prevalence_infancy_type='varchar2';
	/**
 	 * 注释:肺炎
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pneumonia;
	 public $_pneumonia_type='varchar2';
	/**
 	 * 注释:因腹泻住院
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $diarrhea_in_hospitalized;
	 public $_diarrhea_in_hospitalized_type='varchar2';
	/**
 	 * 注释:因外伤住院
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $the_patient;
	 public $_the_patient_type='varchar2';
	/**
 	 * 注释:幼儿期患病情况其它
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $prevalence_infancy_other;
	 public $_prevalence_infancy_other_type='varchar2';
	/**
 	 * 注释:过敏史|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $allergic_history;
	 public $_allergic_history_type='varchar2';
	/**
 	 * 注释:过敏史信息
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $allergic_history_info;
	 public $_allergic_history_info_type='varchar2';
	/**
 	 * 注释:其它
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $other;
	 public $_other_type='varchar2';
	/**
 	 * 注释:转诊|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $referral_features;
	 public $_referral_features_type='varchar2';
	/**
 	 * 注释:转诊原因
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $reason;
	 public $_reason_type='varchar2';
	/**
 	 * 注释:转诊机构及科室
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $agencies_departments;
	 public $_agencies_departments_type='varchar2';
	/**
 	 * 注释:指导|checkbox|1=>喂养指导,2=>母乳指导,3=>疾病预防
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $advising;
	 public $_advising_type='varchar2';
	/**
 	 * 注释:指导其它
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $advising_other;
	 public $_advising_other_type='varchar2';
	/**
 	 * 注释:随访医生签名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $doctors_signature;
	 public $_doctors_signature_type='varchar2';
	/**
 	 * 注释:年龄
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $age;
	 public $_age_type='varchar2';
	/**
 	 * 注释:视力
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $sight;
	 public $_sight_type='varchar2';
	/**
 	 * 注释:听力|radio|1=>通过,2=>未过
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hearing;
	 public $_hearing_type='varchar2';
	/**
 	 * 注释:牙数（颗）
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $number_of_teeth;
	 public $_number_of_teeth_type='varchar2';
	/**
 	 * 注释:龋齿数
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $number_of_caries;
	 public $_number_of_caries_type='varchar2';
	/**
 	 * 注释:腹部|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $abdomen;
	 public $_abdomen_type='varchar2';
	/**
 	 * 注释:血红蛋白值
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hemoglobin;
	 public $_hemoglobin_type='varchar2';
	/**
 	 * 注释:下次随访时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $next_followup_time;
	 public $_next_followup_time_type='number';
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
	/**
 	 * 注释:坐高(cm)
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $sitting_hight;
	 public $_sitting_hight_type='varchar2';
	/**
 	 * 注释:头围(cm)
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $head_size;
	 public $_head_size_type='varchar2';
	/**
 	 * 注释:胸围(cm)
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $bust;
	 public $_bust_type='varchar2';
}
