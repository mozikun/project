<?php
require_once ('db_oracle.php');
/**
 *注释:重情精神疾病患者个人信息补充表
 *
 *
 **/
class Tschizophreniaer_supp_tabs extends dao_oracle{
	 public $__table = 'schizophreniaer_supp_tabs';
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
 	 * 注释:监护人姓名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $guardian_name;
	 public $_guardian_name_type='varchar2';
	/**
 	 * 注释:与患者关系
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $relationship_with_patients;
	 public $_relationship_with_patients_type='varchar2';
	/**
 	 * 注释:监护人地址
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $guardian_address;
	 public $_guardian_address_type='varchar2';
	/**
 	 * 注释:监护人电话
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $guardian_phone;
	 public $_guardian_phone_type='varchar2';
	/**
 	 * 注释:辖区村（居）委会联系人
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $contact_area;
	 public $_contact_area_type='varchar2';
	/**
 	 * 注释:辖区村（居）委会联系电话
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $phone_area;
	 public $_phone_area_type='varchar2';
	/**
 	 * 注释:初次发病时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $onset_time;
	 public $_onset_time_type='number';
	/**
 	 * 注释:既往主要症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故处走,10=>自语自笑,11=>孤僻懒散,12=>其它
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $main_symptomsed;
	 public $_main_symptomsed_type='varchar2';
	/**
 	 * 注释:既往主要症状其它
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $main_symptomsed_other;
	 public $_main_symptomsed_other_type='varchar2';
	/**
 	 * 注释:既往治疗情况门诊|radio|1=>未治,2=>间断门诊治疗,3=>连续门诊治疗
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $outpatient;
	 public $_outpatient_type='varchar2';
	/**
 	 * 注释:既然治疗情况住院次数
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hospital;
	 public $_hospital_type='varchar2';
	/**
 	 * 注释:诊断
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $diagnosis;
	 public $_diagnosis_type='varchar2';
	/**
 	 * 注释:确诊医院
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $hospital_diagnosis;
	 public $_hospital_diagnosis_type='varchar2';
	/**
 	 * 注释:确诊日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $time_diagnosis;
	 public $_time_diagnosis_type='number';
	/**
 	 * 注释:最近一次治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $therapeutic_effect;
	 public $_therapeutic_effect_type='varchar2';
	/**
 	 * 注释:轻度滋事
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $mild_trouble;
	 public $_mild_trouble_type='varchar2';
	/**
 	 * 注释:肇事
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $accident;
	 public $_accident_type='varchar2';
	/**
 	 * 注释:肇祸
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $zhaohuo;
	 public $_zhaohuo_type='varchar2';
	/**
 	 * 注释:自伤
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $self_wounding;
	 public $_self_wounding_type='varchar2';
	/**
 	 * 注释:自杀未遂
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $attmpted_suicide;
	 public $_attmpted_suicide_type='varchar2';
	/**
 	 * 注释:关锁情况|radio|1=>无关锁,2=>关锁,3=>关锁已解除
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $shut_case;
	 public $_shut_case_type='varchar2';
	/**
 	 * 注释:填表日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fill_time;
	 public $_fill_time_type='number';
	/**
 	 * 注释:医生签字
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $doctors_signature;
	 public $_doctors_signature_type='varchar2';
	/**
 	 * 注释:知情同意
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $informed_consent;
	 public $_informed_consent_type='varchar2';
	/**
 	 * 注释:知情同意签字
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $informed_consent_sign;
	 public $_informed_consent_sign_type='varchar2';
	/**
 	 * 注释:知情同意签字时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $informed_consent_sign_time;
	 public $_informed_consent_sign_time_type='number';
	/**
 	 * 注释:经济状况
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $economic_conditions;
	 public $_economic_conditions_type='varchar2';
	/**
 	 * 注释:专科医生的意见
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $specialist_advice;
	 public $_specialist_advice_type='varchar2';
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
