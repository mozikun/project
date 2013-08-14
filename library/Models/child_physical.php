<?php
require_once ('db_oracle.php');
/**
 *注释:儿童健康检查记录表
 *
 *
 **/
class Tchild_physical extends dao_oracle{
	 public $__table = 'child_physical';
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
 	 * 注释:项目|radio|1=>满月,2=>3月龄,3=>6月龄,4=>8月龄,5=>12月龄,6=>18月龄,7=>24月龄,8=>30月龄,
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $project;
	 public $_project_type='varchar2';
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
 	 * 注释:面色|radio|1=>红润,2=>其它
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $complexion;
	 public $_complexion_type='varchar2';
	/**
 	 * 注释:皮肤|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $skin;
	 public $_skin_type='varchar2';
	/**
 	 * 注释:前囟|radio|1=>闭合,2=>未闭
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $bregma;
	 public $_bregma_type='varchar2';
	/**
 	 * 注释:前囟宽
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bregma_width;
	 public $_bregma_width_type='varchar2';
	/**
 	 * 注释:前囟高
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bregma_height;
	 public $_bregma_height_type='varchar2';
	/**
 	 * 注释:眼|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $eye;
	 public $_eye_type='varchar2';
	/**
 	 * 注释:耳|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ear;
	 public $_ear_type='varchar2';
	/**
 	 * 注释:出牙数(颗)
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $number_of_teeth;
	 public $_number_of_teeth_type='varchar2';
	/**
 	 * 注释:心肺|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $heart_lung;
	 public $_heart_lung_type='varchar2';
	/**
 	 * 注释:腹部|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $abdomen;
	 public $_abdomen_type='varchar2';
	/**
 	 * 注释:脐部|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $umbilical_region;
	 public $_umbilical_region_type='varchar2';
	/**
 	 * 注释:四肢|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $limb;
	 public $_limb_type='varchar2';
	/**
 	 * 注释:步态|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gait;
	 public $_gait_type='varchar2';
	/**
 	 * 注释:佝偻病症状|radio|1=>无,2=>夜惊,3=>多汗,4=>烦躁
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $rickets_symptom;
	 public $_rickets_symptom_type='varchar2';
	/**
 	 * 注释:佝偻病体征|radio|1=>无,2=>颅骨软化,3=>方颅,4=>枕秃,5=>肋串珠,6=>肋外翻,7=>肋软骨沟,8=>鸡胸,9=>手镯征,10=>O型腿,11=>X型腿
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $rickets_signs;
	 public $_rickets_signs_type='varchar2';
	/**
 	 * 注释:肛门/外生殖器|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gmzz;
	 public $_gmzz_type='varchar2';
	/**
 	 * 注释:血红蛋白值
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $hemoglobin;
	 public $_hemoglobin_type='varchar2';
	/**
 	 * 注释:户外活动小时/日
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $field_sport;
	 public $_field_sport_type='varchar2';
	/**
 	 * 注释:服用维生素D
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $vitamin_d;
	 public $_vitamin_d_type='varchar2';
	/**
 	 * 注释:发育评估|radio|1=>通过,2=>未过
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $developmental_assessment;
	 public $_developmental_assessment_type='varchar2';
	/**
 	 * 注释:两次随访间患病情况|radio|1=>未患病,2=>患病
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $between_and_vist_time;
	 public $_between_and_vist_time_type='varchar2';
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
 	 * 注释:头围（cm）
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $head_size;
	 public $_head_size_type='varchar2';
	/**
 	 * 注释:颈部包块|radio|1=>有,2=>无
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $cervical_mass;
	 public $_cervical_mass_type='varchar2';
	/**
 	 * 注释:听力|radio|1=>通过,2=>未通过
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hearing;
	 public $_hearing_type='varchar2';
	/**
 	 * 注释:口腔|radio|1=>未见异常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $oralcavity;
	 public $_oralcavity_type='varchar2';
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
