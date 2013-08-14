<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Thealth_education extends dao_oracle{
	 public $__table = 'health_education';
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
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
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
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:活动时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $activity_time;
	 public $_activity_time_type='number';
	/**
 	 * 注释:活动地点
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $activity_address;
	 public $_activity_address_type='varchar2';
	/**
 	 * 注释:活动形式
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $activity_type;
	 public $_activity_type_type='varchar2';
	/**
 	 * 注释:主办单位
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $sponsor;
	 public $_sponsor_type='varchar2';
	/**
 	 * 注释:合作伙伴
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $partner;
	 public $_partner_type='varchar2';
	/**
 	 * 注释:参与人数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $person_num;
	 public $_person_num_type='number';
	/**
 	 * 注释:宣传品发放种类
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $promo_type;
	 public $_promo_type_type='number';
	/**
 	 * 注释:宣传品发放数量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $promo_num;
	 public $_promo_num_type='number';
	/**
 	 * 注释:活动主题
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $activity_theme;
	 public $_activity_theme_type='varchar2';
	/**
 	 * 注释:宣教人
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $doctor;
	 public $_doctor_type='varchar2';
	/**
 	 * 注释:活动小结
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $active_summary;
	 public $_active_summary_type='varchar2';
	/**
 	 * 注释:活动评价
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $activity_juggde;
	 public $_activity_juggde_type='varchar2';
	/**
 	 * 注释:存档材料
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $more_info;
	 public $_more_info_type='varchar2';
	/**
 	 * 注释:负责人
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $person_in_charge;
	 public $_person_in_charge_type='varchar2';
	/**
 	 * 注释:接受健康教育人员类别
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $person_category;
	 public $_person_category_type='varchar2';
	/**
 	 * 注释:填表人
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $people_fillin_form;
	 public $_people_fillin_form_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
