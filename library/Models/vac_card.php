<?php
require_once ('db_oracle.php');
/**
 *注释:预防接种卡主表
 *
 *
 **/
class Tvac_card extends dao_oracle{
	 public $__table = 'vac_card';
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
 	 * 注释:创建时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:性别
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $sex;
	 public $_sex_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $date_of_birth;
	 public $_date_of_birth_type='number';
	/**
 	 * 注释:监护人
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $guardian;
	 public $_guardian_type='varchar2';
	/**
 	 * 注释:与儿童关系
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $relation;
	 public $_relation_type='varchar2';
	/**
 	 * 注释:联系电话
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $telephone;
	 public $_telephone_type='varchar2';
	/**
 	 * 注释:家庭住址区县
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $family_address_city;
	 public $_family_address_city_type='varchar2';
	/**
 	 * 注释:家庭住址街道
	 * 
	 * 
	 * @var VARCHAR2(160)
	 **/
 	 public $family_address_street;
	 public $_family_address_street_type='varchar2';
	/**
 	 * 注释:户籍地址
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $census_register;
	 public $_census_register_type='varchar2';
	/**
 	 * 注释:户籍所在省
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $census_register_province;
	 public $_census_register_province_type='varchar2';
	/**
 	 * 注释:户籍所在市
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $census_register_city;
	 public $_census_register_city_type='varchar2';
	/**
 	 * 注释:户籍所在区
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $census_register_area;
	 public $_census_register_area_type='varchar2';
	/**
 	 * 注释:户籍所在街道
	 * 
	 * 
	 * @var VARCHAR2(160)
	 **/
 	 public $census_register_street;
	 public $_census_register_street_type='varchar2';
	/**
 	 * 注释:迁入时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $immigration_time;
	 public $_immigration_time_type='number';
	/**
 	 * 注释:迁出时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $emigration_time;
	 public $_emigration_time_type='number';
	/**
 	 * 注释:迁出原因
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $emigration_cause;
	 public $_emigration_cause_type='varchar2';
	/**
 	 * 注释:疫苗异常反映史
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $vaccinum_unusual_history;
	 public $_vaccinum_unusual_history_type='varchar2';
	/**
 	 * 注释:疫苗禁忌
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $vaccinate_no_no;
	 public $_vaccinate_no_no_type='varchar2';
	/**
 	 * 注释:传染病史
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $infect_history;
	 public $_infect_history_type='varchar2';
	/**
 	 * 注释:建卡日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created_card_time;
	 public $_created_card_time_type='number';
	/**
 	 * 注释:建卡人
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $created_doc;
	 public $_created_doc_type='varchar2';
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
