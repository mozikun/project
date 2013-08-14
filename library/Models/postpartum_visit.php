<?php
require_once ('db_oracle.php');
/**
 *注释:产后访视记录表
 *
 *
 **/
class Tpostpartum_visit extends dao_oracle{
	 public $__table = 'postpartum_visit';
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
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $fid;
	 public $_fid_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:
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
 	 public $follow_time;
	 public $_follow_time_type='number';
	/**
 	 * 注释:体温
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $body_temperature;
	 public $_body_temperature_type='varchar2';
	/**
 	 * 注释:一般健康情况
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $general_health;
	 public $_general_health_type='varchar2';
	/**
 	 * 注释:一般心理状况
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $general_psychology;
	 public $_general_psychology_type='varchar2';
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
 	 * 注释:乳房
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $brest;
	 public $_brest_type='varchar2';
	/**
 	 * 注释:乳房备注
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $brest_info;
	 public $_brest_info_type='varchar2';
	/**
 	 * 注释:恶露
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $lochia;
	 public $_lochia_type='varchar2';
	/**
 	 * 注释:恶露备注
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $lochia_info;
	 public $_lochia_info_type='varchar2';
	/**
 	 * 注释:子宫
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $uterus;
	 public $_uterus_type='varchar2';
	/**
 	 * 注释:子宫备注
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $uterus_info;
	 public $_uterus_info_type='varchar2';
	/**
 	 * 注释:伤口
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $durative_ulcer;
	 public $_durative_ulcer_type='varchar2';
	/**
 	 * 注释:伤口备注
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $durative_ulcer_info;
	 public $_durative_ulcer_info_type='varchar2';
	/**
 	 * 注释:其他
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $post_other;
	 public $_post_other_type='varchar2';
	/**
 	 * 注释:分类
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pregnant_sort;
	 public $_pregnant_sort_type='varchar2';
	/**
 	 * 注释:分类说明
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $pregnant_sort_info;
	 public $_pregnant_sort_info_type='varchar2';
	/**
 	 * 注释:指导
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $medical_advice;
	 public $_medical_advice_type='varchar2';
	/**
 	 * 注释:转诊
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
 	 * 注释:下次随访日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $follow_next_time;
	 public $_follow_next_time_type='number';
	/**
 	 * 注释:随访医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $follow_staff;
	 public $_follow_staff_type='varchar2';
	/**
 	 * 注释:指导其他项
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $medical_advice_info;
	 public $_medical_advice_info_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
