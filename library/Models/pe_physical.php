<?php
require_once ('db_oracle.php');
/**
 *注释:婚前医学检查表-体格检查
 *
 *
 **/
class Tpe_physical extends dao_oracle{
	 public $__table = 'pe_physical';
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
 	 * 注释:收缩压
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $systolic_pressure;
	 public $_systolic_pressure_type='varchar2';
	/**
 	 * 注释:舒张压
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $diastolic_pressure;
	 public $_diastolic_pressure_type='varchar2';
	/**
 	 * 注释:特殊体态|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $special_body;
	 public $_special_body_type='varchar2';
	/**
 	 * 注释:特殊体态描述
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $special_body_info;
	 public $_special_body_info_type='varchar2';
	/**
 	 * 注释:精神状态|radio|1=>正常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $mental_states;
	 public $_mental_states_type='varchar2';
	/**
 	 * 注释:精神状态异常内容
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $mental_states_info;
	 public $_mental_states_info_type='varchar2';
	/**
 	 * 注释:特殊面容|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $unusual_facies;
	 public $_unusual_facies_type='varchar2';
	/**
 	 * 注释:特殊面容内容
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $unusual_facies_info;
	 public $_unusual_facies_info_type='varchar2';
	/**
 	 * 注释:智力|radio|1=>正常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $intelligence;
	 public $_intelligence_type='varchar2';
	/**
 	 * 注释:智力描述|radio|1=>常识,2=>判断,3=>记忆,4=>计算
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $intelligence_info;
	 public $_intelligence_info_type='varchar2';
	/**
 	 * 注释:皮肤毛发|radio|1=>正常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $skin_and_hair;
	 public $_skin_and_hair_type='varchar2';
	/**
 	 * 注释:皮肤毛发内容
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $skin_and_hair_info;
	 public $_skin_and_hair_info_type='varchar2';
	/**
 	 * 注释:五官|radio|1=>正常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $feature;
	 public $_feature_type='varchar2';
	/**
 	 * 注释:五官异常描述
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $feature_info;
	 public $_feature_info_type='varchar2';
	/**
 	 * 注释:甲状腺|radio|1=>正常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $thyroid;
	 public $_thyroid_type='varchar2';
	/**
 	 * 注释:甲状腺异常描述
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $thyroid_info;
	 public $_thyroid_info_type='varchar2';
	/**
 	 * 注释:心率
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $heart_rate;
	 public $_heart_rate_type='varchar2';
	/**
 	 * 注释:心律
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $cardiac_rhythm;
	 public $_cardiac_rhythm_type='varchar2';
	/**
 	 * 注释:杂音|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $noise;
	 public $_noise_type='varchar2';
	/**
 	 * 注释:杂音描述
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $noise_info;
	 public $_noise_info_type='varchar2';
	/**
 	 * 注释:肺|radio|1=>正常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $lung;
	 public $_lung_type='varchar2';
	/**
 	 * 注释:肺异常描述
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $lung_info;
	 public $_lung_info_type='varchar2';
	/**
 	 * 注释:肝|radio|1=>未及,2=>可及
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $liver;
	 public $_liver_type='varchar2';
	/**
 	 * 注释:肝描述
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $liver_info;
	 public $_liver_info_type='varchar2';
	/**
 	 * 注释:四肢脊柱|radio|1=>正常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $spine_extremities;
	 public $_spine_extremities_type='varchar2';
	/**
 	 * 注释:四肢脊柱描述
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $spine_extremities_info;
	 public $_spine_extremities_info_type='varchar2';
	/**
 	 * 注释:其它
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $other;
	 public $_other_type='varchar2';
	/**
 	 * 注释:医师签名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $signature_of_doctor;
	 public $_signature_of_doctor_type='varchar2';
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
