<?php
require_once ('db_oracle.php');
/**
 *注释:新生儿家庭访视记录表
 *
 *
 **/
class Tchild_visits extends dao_oracle{
	 public $__table = 'child_visits';
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
 	 * 注释:父亲姓名|text
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $father_name;
	 public $_father_name_type='varchar2';
	/**
 	 * 注释:父亲职业|text
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $father_occupation;
	 public $_father_occupation_type='varchar2';
	/**
 	 * 注释:父亲电话|text
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $father_phone;
	 public $_father_phone_type='varchar2';
	/**
 	 * 注释:父亲出生日期|text
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $father_birth;
	 public $_father_birth_type='number';
	/**
 	 * 注释:母亲姓名|text
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $mum_name;
	 public $_mum_name_type='varchar2';
	/**
 	 * 注释:母亲职业|text
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $mum_occupation;
	 public $_mum_occupation_type='varchar2';
	/**
 	 * 注释:母亲电话|text
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $mum_phone;
	 public $_mum_phone_type='varchar2';
	/**
 	 * 注释:母亲出生日期|text
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mum_birth;
	 public $_mum_birth_type='number';
	/**
 	 * 注释:出生孕周|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $gestational_week;
	 public $_gestational_week_type='varchar2';
	/**
 	 * 注释:母亲妊娠期患病疾病情况|radio|1=>糖尿病,2=>妊娠期高血压,3=>其它
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $disease_pregnancy;
	 public $_disease_pregnancy_type='varchar2';
	/**
 	 * 注释:母亲妊娠期患病疾病情况其它|text
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $disease_pregnancy_other;
	 public $_disease_pregnancy_other_type='varchar2';
	/**
 	 * 注释:助产机构名称|text
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $midwifery_name;
	 public $_midwifery_name_type='varchar2';
	/**
 	 * 注释:出生情况|checkbox|1=>顺产,2=>头吸,3=>产钳,4=>剖产,5=>双多胎,6=>臀位,7=>其它
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $birth_complexion;
	 public $_birth_complexion_type='varchar2';
	/**
 	 * 注释:出生情况其它|text
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $birth_complexion_other;
	 public $_birth_complexion_other_type='varchar2';
	/**
 	 * 注释:新生儿窒息|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sleepy_baby;
	 public $_sleepy_baby_type='varchar2';
	/**
 	 * 注释:新生儿窒息情况|text
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $sleepy_baby_info;
	 public $_sleepy_baby_info_type='varchar2';
	/**
 	 * 注释:是否有畸形|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $deformity;
	 public $_deformity_type='varchar2';
	/**
 	 * 注释:畸形情况|text
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $deformity_info;
	 public $_deformity_info_type='varchar2';
	/**
 	 * 注释:新生儿听力筛查|radio|1=>通过,2=>未通过,3=>未筛查
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hearing_screening;
	 public $_hearing_screening_type='varchar2';
	/**
 	 * 注释:新生儿出生体重kg|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $weight;
	 public $_weight_type='varchar2';
	/**
 	 * 注释:出生身高cm|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $height;
	 public $_height_type='varchar2';
	/**
 	 * 注释:喂养方式|radio|1=>纯母乳,2=>混合,3=>人工
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $breast_milk;
	 public $_breast_milk_type='varchar2';
	/**
 	 * 注释:体温|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $body_temperature;
	 public $_body_temperature_type='varchar2';
	/**
 	 * 注释:呼吸频率|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $respiratory_rate;
	 public $_respiratory_rate_type='varchar2';
	/**
 	 * 注释:脉率|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pulses;
	 public $_pulses_type='varchar2';
	/**
 	 * 注释:面色|checkbox|1=>红润,2=>黄染,3=>其它
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $complexion;
	 public $_complexion_type='varchar2';
	/**
 	 * 注释:面色其它|text
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $complexion_other;
	 public $_complexion_other_type='varchar2';
	/**
 	 * 注释:前囟宽|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bregma_width;
	 public $_bregma_width_type='varchar2';
	/**
 	 * 注释:前囟高|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bregma_height;
	 public $_bregma_height_type='varchar2';
	/**
 	 * 注释:前囟|radio|1=>正常,2=>膨隆,3=>凹陷,4=>其它
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $bregma;
	 public $_bregma_type='varchar2';
	/**
 	 * 注释:前囟其它|text
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bregma_other;
	 public $_bregma_other_type='varchar2';
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
 	 * 注释:四肢活动度|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $limb;
	 public $_limb_type='varchar2';
	/**
 	 * 注释:四肢活动度异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $limb_info;
	 public $_limb_info_type='varchar2';
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
 	 * 注释:颈部包块|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $cervical_mass;
	 public $_cervical_mass_type='varchar2';
	/**
 	 * 注释:颈部包块
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $cervical_mass_info;
	 public $_cervical_mass_info_type='varchar2';
	/**
 	 * 注释:鼻|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $nose;
	 public $_nose_type='varchar2';
	/**
 	 * 注释:鼻异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $nose_info;
	 public $_nose_info_type='varchar2';
	/**
 	 * 注释:皮肤|checkbox|1=>未见异常,2=>湿疹,3=>糜烂,4=>其它
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $skin;
	 public $_skin_type='varchar2';
	/**
 	 * 注释:皮肤其它
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $skin_other;
	 public $_skin_other_type='varchar2';
	/**
 	 * 注释:口腔|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $oral_cavity;
	 public $_oral_cavity_type='varchar2';
	/**
 	 * 注释:口腔异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $oral_cavity_info;
	 public $_oral_cavity_info_type='varchar2';
	/**
 	 * 注释:肛门|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gmzz;
	 public $_gmzz_type='varchar2';
	/**
 	 * 注释:肛门异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $gmzz_info;
	 public $_gmzz_info_type='varchar2';
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
 	 * 注释:外生殖器|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $pudendum;
	 public $_pudendum_type='varchar2';
	/**
 	 * 注释:外生殖器异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $pudendum_info;
	 public $_pudendum_info_type='varchar2';
	/**
 	 * 注释:腹部|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $abdomen;
	 public $_abdomen_type='varchar2';
	/**
 	 * 注释:腹部异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $abdomen_info;
	 public $_abdomen_info_type='varchar2';
	/**
 	 * 注释:脊柱|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $rachis;
	 public $_rachis_type='varchar2';
	/**
 	 * 注释:脊柱异常
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $rachis_info;
	 public $_rachis_info_type='varchar2';
	/**
 	 * 注释:脐带|radio|1=>未脱,2=>脱落,3=>脐部有渗出,4=>其它
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $umbilical_cord;
	 public $_umbilical_cord_type='varchar2';
	/**
 	 * 注释:脐带其它
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $umbilical_cord_other;
	 public $_umbilical_cord_other_type='varchar2';
	/**
 	 * 注释:转诊|1=>无,2=>有
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
 	 * 注释:指导|checkbox|1=>喂养指导,2=>母乳喂养,3=>护理指导,4=>疾病预防指导
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $advising;
	 public $_advising_type='varchar2';
	/**
 	 * 注释:本次随访日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $followup_time;
	 public $_followup_time_type='number';
	/**
 	 * 注释:下次随访地点
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $next_followup_address;
	 public $_next_followup_address_type='varchar2';
	/**
 	 * 注释:下次随访日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $next_followup_time;
	 public $_next_followup_time_type='number';
	/**
 	 * 注释:随访医生签名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $doctors_signature;
	 public $_doctors_signature_type='varchar2';
	/**
 	 * 注释:新生儿apgar评分标准
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $apgar_score;
	 public $_apgar_score_type='varchar2';
	/**
 	 * 注释:新生儿疾病筛查
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $neonatal_screening;
	 public $_neonatal_screening_type='varchar2';
	/**
 	 * 注释:新生儿目前体重
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $current_weight;
	 public $_current_weight_type='varchar2';
	/**
 	 * 注释:新生儿吃奶量
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $feeding_amount;
	 public $_feeding_amount_type='varchar2';
	/**
 	 * 注释:新生儿每天吃奶次数
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $feeding_times;
	 public $_feeding_times_type='varchar2';
	/**
 	 * 注释:新生儿呕吐情况
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $vomit;
	 public $_vomit_type='varchar2';
	/**
 	 * 注释:新生儿大便情况
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $defecate;
	 public $_defecate_type='varchar2';
	/**
 	 * 注释:新生儿大便次数
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $stool_frequency;
	 public $_stool_frequency_type='varchar2';
	/**
 	 * 注释:新生儿黄疸部位
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $jaundice_site;
	 public $_jaundice_site_type='varchar2';
	/**
 	 * 注释:新生儿疾病筛查其他遗传病
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $neonatal_screening_other;
	 public $_neonatal_screening_other_type='varchar2';
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
