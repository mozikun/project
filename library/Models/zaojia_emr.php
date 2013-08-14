<?php
require_once ('db_oracle.php');
/**
 *注释:医院病历记录
 *
 *
 **/
class Tzaojia_emr extends dao_oracle{
	 public $__table = 'zaojia_emr';
	/**
 	 * 注释:唯一序号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:科室
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $department;
	 public $_department_type='varchar2';
	/**
 	 * 注释:床号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bed_no;
	 public $_bed_no_type='varchar2';
	/**
 	 * 注释:住院号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $admission_number;
	 public $_admission_number_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $name;
	 public $_name_type='varchar2';
	/**
 	 * 注释:性别
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gender;
	 public $_gender_type='varchar2';
	/**
 	 * 注释:年龄
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $age;
	 public $_age_type='varchar2';
	/**
 	 * 注释:出生地
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $birthplace;
	 public $_birthplace_type='varchar2';
	/**
 	 * 注释:婚姻
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $marital_status;
	 public $_marital_status_type='varchar2';
	/**
 	 * 注释:职业
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $occupation;
	 public $_occupation_type='varchar2';
	/**
 	 * 注释:住址
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $address;
	 public $_address_type='varchar2';
	/**
 	 * 注释:民族
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $race;
	 public $_race_type='varchar2';
	/**
 	 * 注释:入院时间
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $admission_time;
	 public $_admission_time_type='varchar2';
	/**
 	 * 注释:病历记录时间
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $medical_records_time;
	 public $_medical_records_time_type='varchar2';
	/**
 	 * 注释:病历叙述者
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $history_narrator;
	 public $_history_narrator_type='varchar2';
	/**
 	 * 注释:叙述可靠性
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $reliability;
	 public $_reliability_type='varchar2';
	/**
 	 * 注释:主叙
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $complaints;
	 public $_complaints_type='varchar2';
	/**
 	 * 注释:现病史
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $present_illness;
	 public $_present_illness_type='varchar2';
	/**
 	 * 注释:既往史
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $past_history;
	 public $_past_history_type='varchar2';
	/**
 	 * 注释:个人史
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $personal_history;
	 public $_personal_history_type='varchar2';
	/**
 	 * 注释:月经史
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $menstrual_history;
	 public $_menstrual_history_type='varchar2';
	/**
 	 * 注释:婚育史
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $obsterical_history;
	 public $_obsterical_history_type='varchar2';
	/**
 	 * 注释:家族史
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $family_history;
	 public $_family_history_type='varchar2';
	/**
 	 * 注释:体格检查-体温
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $physical_t;
	 public $_physical_t_type='varchar2';
	/**
 	 * 注释:体格检查-脉搏
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $physical_p;
	 public $_physical_p_type='varchar2';
	/**
 	 * 注释:体格检查-呼吸
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $physical_r;
	 public $_physical_r_type='varchar2';
	/**
 	 * 注释:体格检查-收缩压
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $physical_bp_p;
	 public $_physical_bp_p_type='varchar2';
	/**
 	 * 注释:体格检查-舒张压
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $physical_bp_s;
	 public $_physical_bp_s_type='varchar2';
	/**
 	 * 注释:体格检查-一般情况
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $physical_general;
	 public $_physical_general_type='varchar2';
	/**
 	 * 注释:体格检查-皮肤粘膜
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $physical_skin;
	 public $_physical_skin_type='varchar2';
	/**
 	 * 注释:体格检查-淋巴结
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $physical_lymphaden;
	 public $_physical_lymphaden_type='varchar2';
	/**
 	 * 注释:体格检查-头颅
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $physical_head;
	 public $_physical_head_type='varchar2';
	/**
 	 * 注释:体格检查-颈部
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $physical_neck;
	 public $_physical_neck_type='varchar2';
	/**
 	 * 注释:体格检查-胸部
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $physical_chest;
	 public $_physical_chest_type='varchar2';
	/**
 	 * 注释:体格检查-周围血管征
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $physical_vein;
	 public $_physical_vein_type='varchar2';
	/**
 	 * 注释:辅助检查-心电图
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $examie_ecg;
	 public $_examie_ecg_type='varchar2';
	/**
 	 * 注释:辅助检查-肾功电解质
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $examine_electrolyte;
	 public $_examine_electrolyte_type='varchar2';
	/**
 	 * 注释:辅助检查-血糖
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $examine_blood_sugar;
	 public $_examine_blood_sugar_type='varchar2';
	/**
 	 * 注释:辅助检查-血常规
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $examine_blood;
	 public $_examine_blood_type='varchar2';
	/**
 	 * 注释:辅助检查-心彩超
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $examine_heart_cdus;
	 public $_examine_heart_cdus_type='varchar2';
	/**
 	 * 注释:辅助检查-胸片
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $examine_sternum;
	 public $_examine_sternum_type='varchar2';
	/**
 	 * 注释:初步诊断
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $primary_diagnosis;
	 public $_primary_diagnosis_type='varchar2';
	/**
 	 * 注释:住院医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $housestaff;
	 public $_housestaff_type='varchar2';
	/**
 	 * 注释:住院医生日期
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $housestaff_time;
	 public $_housestaff_time_type='varchar2';
	/**
 	 * 注释:主治医生
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $visiting_doctor;
	 public $_visiting_doctor_type='varchar2';
	/**
 	 * 注释:主治医生日期
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $visiting_doctor_time;
	 public $_visiting_doctor_time_type='varchar2';
	/**
 	 * 注释:机构id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:身份证号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $identity_number;
	 public $_identity_number_type='varchar2';
}
