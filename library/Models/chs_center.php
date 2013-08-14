<?php
require_once ('db_oracle.php');
/**
 *注释:机构信息基本表
 *
 *
 **/
class Tchs_center extends dao_oracle{
	 public $__table = 'chs_center';
	/**
 	 * 注释:机构id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $chsc_id;
	 public $_chsc_id_type='number';
	/**
 	 * 注释:机构基本信息创建时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:机构基本信息修改时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:组织机构代码
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $org_code;
	 public $_org_code_type='varchar2';
	/**
 	 * 注释:卫生机构代码
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $health_org_code;
	 public $_health_org_code_type='varchar2';
	/**
 	 * 注释:机构名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $org_name;
	 public $_org_name_type='varchar2';
	/**
 	 * 注释:经济类型代码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $org_property_economy_code;
	 public $_org_property_economy_code_type='varchar2';
	/**
 	 * 注释:卫生机构类别代码
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $org_property_type_code;
	 public $_org_property_type_code_type='varchar2';
	/**
 	 * 注释:机构分类管理代码
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $org_property_manage_code;
	 public $_org_property_manage_code_type='varchar2';
	/**
 	 * 注释:行政区划代码
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $org_property_region_code;
	 public $_org_property_region_code_type='varchar2';
	/**
 	 * 注释:单位所在街道/乡镇名称
	 * 
	 * 
	 * @var VARCHAR2(120)
	 **/
 	 public $street;
	 public $_street_type='varchar2';
	/**
 	 * 注释:机构地址
	 * 
	 * 
	 * @var VARCHAR2(210)
	 **/
 	 public $address;
	 public $_address_type='varchar2';
	/**
 	 * 注释:邮编
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $postal_code;
	 public $_postal_code_type='varchar2';
	/**
 	 * 注释:中心电话区号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $telephone_number_area;
	 public $_telephone_number_area_type='varchar2';
	/**
 	 * 注释:中心电话
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $telephone_number;
	 public $_telephone_number_type='varchar2';
	/**
 	 * 注释:单位电子邮箱
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $email;
	 public $_email_type='varchar2';
	/**
 	 * 注释:单位网站域名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $host_domain;
	 public $_host_domain_type='varchar2';
	/**
 	 * 注释:单位开业/成立时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $build_date;
	 public $_build_date_type='number';
	/**
 	 * 注释:社区卫生服务中心设立地
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $regionalism_adscription;
	 public $_regionalism_adscription_type='varchar2';
	/**
 	 * 注释:设置/主办单位代码
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $org_type;
	 public $_org_type_type='varchar2';
	/**
 	 * 注释:政府办机构隶属关系代码
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $org_under_type;
	 public $_org_under_type_type='varchar2';
	/**
 	 * 注释:注册资金
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $register_bankroll;
	 public $_register_bankroll_type='number';
	/**
 	 * 注释:法人代表
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $principal;
	 public $_principal_type='varchar2';
	/**
 	 * 注释:是否民族自治
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $is_nation_autonomy;
	 public $_is_nation_autonomy_type='varchar2';
	/**
 	 * 注释:是否公费医疗/医疗保险定点医院
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $is_medicare_point_hospital;
	 public $_is_medicare_point_hospital_type='varchar2';
	/**
 	 * 注释:是否新型农村合作医疗定点医院
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $is_new_point_hospital;
	 public $_is_new_point_hospital_type='varchar2';
	/**
 	 * 注释:是否直报疫情及突发公共卫生事件
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $is_common_event_report;
	 public $_is_common_event_report_type='varchar2';
	/**
 	 * 注释:计算机台数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $computer_count;
	 public $_computer_count_type='number';
	/**
 	 * 注释:是否配置健康教育录(放)像设备
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $has_health_edu_equipment;
	 public $_has_health_edu_equipment_type='varchar2';
	/**
 	 * 注释:下设直属分站(院、所)个数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $child_chss_count;
	 public $_child_chss_count_type='number';
	/**
 	 * 注释:是否分支机构
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $is_leaf;
	 public $_is_leaf_type='varchar2';
	/**
 	 * 注释:非独立法人挂靠单位
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $mount_type;
	 public $_mount_type_type='varchar2';
	/**
 	 * 注释:年份
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $year;
	 public $_year_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
