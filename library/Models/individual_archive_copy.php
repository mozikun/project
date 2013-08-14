<?php
require_once ('db_oracle.php');
/**
 *注释:个人基本档案表 ID字段有唯一索引，因为本表，一个用户有且只能有一条记录
 *
 *
 **/
class Tindividual_archive_copy extends dao_oracle{
	 public $__table = 'individual_archive_copy';
	/**
 	 * 注释:系统唯一标识符
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:建档医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:与个人国家标准档案号关联
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
 	 * 注释:更新时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:删除时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $deleted;
	 public $_deleted_type='number';
	/**
 	 * 注释:状态标志
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='varchar2';
	/**
 	 * 注释:同步标志
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $syn_flag;
	 public $_syn_flag_type='varchar2';
	/**
 	 * 注释:国籍
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $nationality;
	 public $_nationality_type='varchar2';
	/**
 	 * 注释:籍贯
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $native_place;
	 public $_native_place_type='varchar2';
	/**
 	 * 注释:居住地区
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $reside_place;
	 public $_reside_place_type='varchar2';
	/**
 	 * 注释:居住时间(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $reside_time;
	 public $_reside_time_type='number';
	/**
 	 * 注释:联系人
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $contact;
	 public $_contact_type='varchar2';
	/**
 	 * 注释:联系电话
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $contact_number;
	 public $_contact_number_type='varchar2';
	/**
 	 * 注释:家庭住址
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $family_address;
	 public $_family_address_type='varchar2';
	/**
 	 * 注释:所属居委会
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $community;
	 public $_community_type='varchar2';
	/**
 	 * 注释:派出所
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $police_station;
	 public $_police_station_type='varchar2';
	/**
 	 * 注释:户籍类别
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $residence;
	 public $_residence_type='varchar2';
	/**
 	 * 注释:医疗保险形式
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $charge_style;
	 public $_charge_style_type='varchar2';
	/**
 	 * 注释:需要服务类型
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $need_service;
	 public $_need_service_type='varchar2';
	/**
 	 * 注释:入托儿所时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $nursery_date;
	 public $_nursery_date_type='number';
	/**
 	 * 注释:托儿所名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $nursery_name;
	 public $_nursery_name_type='varchar2';
	/**
 	 * 注释:入幼儿园时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $kindergarten_date;
	 public $_kindergarten_date_type='number';
	/**
 	 * 注释:幼儿园名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $kindergarten_name;
	 public $_kindergarten_name_type='varchar2';
	/**
 	 * 注释:入小学时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $elementary_date;
	 public $_elementary_date_type='number';
	/**
 	 * 注释:小学名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $elementary_name;
	 public $_elementary_name_type='varchar2';
	/**
 	 * 注释:入中学时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $high_school_date;
	 public $_high_school_date_type='number';
	/**
 	 * 注释:中学名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $high_school_name;
	 public $_high_school_name_type='varchar2';
	/**
 	 * 注释:结束学业时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $end_school_date;
	 public $_end_school_date_type='number';
	/**
 	 * 注释:学校类别
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $school_type;
	 public $_school_type_type='varchar2';
	/**
 	 * 注释:学校名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $school_name;
	 public $_school_name_type='varchar2';
	/**
 	 * 注释:所学专业
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $specialty;
	 public $_specialty_type='varchar2';
	/**
 	 * 注释:学历
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $study_history;
	 public $_study_history_type='varchar2';
	/**
 	 * 注释:学位
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $degree;
	 public $_degree_type='varchar2';
	/**
 	 * 注释:就业状态
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $obtain_employment;
	 public $_obtain_employment_type='varchar2';
	/**
 	 * 注释:参加工作时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $begin_work_date;
	 public $_begin_work_date_type='number';
	/**
 	 * 注释:单位名称
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $unit_name;
	 public $_unit_name_type='varchar2';
	/**
 	 * 注释:单位地址
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $unit_address;
	 public $_unit_address_type='varchar2';
	/**
 	 * 注释:职业
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $occupation;
	 public $_occupation_type='varchar2';
	/**
 	 * 注释:婚姻状况
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $marriage;
	 public $_marriage_type='varchar2';
	/**
 	 * 注释:配偶姓名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $spouse_name;
	 public $_spouse_name_type='varchar2';
	/**
 	 * 注释:是否近亲结婚
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $close_relative;
	 public $_close_relative_type='varchar2';
	/**
 	 * 注释:结婚时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $marriage_date;
	 public $_marriage_date_type='number';
	/**
 	 * 注释:离婚时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $divorce_date;
	 public $_divorce_date_type='number';
	/**
 	 * 注释:子女数
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $child_number;
	 public $_child_number_type='varchar2';
	/**
 	 * 注释:子女健康情况
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $child_health;
	 public $_child_health_type='varchar2';
	/**
 	 * 注释:父亲姓名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $father_name;
	 public $_father_name_type='varchar2';
	/**
 	 * 注释:母亲姓名
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $mather_name;
	 public $_mather_name_type='varchar2';
	/**
 	 * 注释:父亲年龄
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $father_age;
	 public $_father_age_type='varchar2';
	/**
 	 * 注释:母亲年龄
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $mather_age;
	 public $_mather_age_type='varchar2';
	/**
 	 * 注释:父亲健康状况
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $father_health;
	 public $_father_health_type='varchar2';
	/**
 	 * 注释:母亲健康状况
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $mather_health;
	 public $_mather_health_type='varchar2';
	/**
 	 * 注释:身高
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $height;
	 public $_height_type='varchar2';
	/**
 	 * 注释:体重
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $weight;
	 public $_weight_type='varchar2';
	/**
 	 * 注释:家庭编号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $family_number;
	 public $_family_number_type='varchar2';
	/**
 	 * 注释:配偶个人档案代码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $parter_code;
	 public $_parter_code_type='varchar2';
	/**
 	 * 注释:社区自定义个人档案代码
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $sn_self_define;
	 public $_sn_self_define_type='varchar2';
	/**
 	 * 注释:修改档案状态时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $change_state_date;
	 public $_change_state_date_type='number';
	/**
 	 * 注释:老年人分级 1=>一级2=>二级3=>三级
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $older_classification;
	 public $_older_classification_type='varchar2';
	/**
 	 * 注释:疾病史
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $disease_history;
	 public $_disease_history_type='varchar2';
	/**
 	 * 注释:药物过敏史
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $allergy_history;
	 public $_allergy_history_type='varchar2';
	/**
 	 * 注释:手术史
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $surgery_history;
	 public $_surgery_history_type='varchar2';
	/**
 	 * 注释:外伤史
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $trauma_history;
	 public $_trauma_history_type='varchar2';
	/**
 	 * 注释:输血史
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $blood_history;
	 public $_blood_history_type='varchar2';
	/**
 	 * 注释:家族史
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $family_history;
	 public $_family_history_type='varchar2';
	/**
 	 * 注释:遗传病史
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $genetic_diseases_history;
	 public $_genetic_diseases_history_type='varchar2';
	/**
 	 * 注释:残疾状况
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $disability;
	 public $_disability_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $filing_time;
	 public $_filing_time_type='number';
	/**
 	 * 注释:健康档案信息卡其他说明
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $card_info;
	 public $_card_info_type='varchar2';
	/**
 	 * 注释:暴露史
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $exposure_history;
	 public $_exposure_history_type='varchar2';
	/**
 	 * 注释:厨房排风设施
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $kitchen_exhaust;
	 public $_kitchen_exhaust_type='varchar2';
	/**
 	 * 注释:燃料类型
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $fuel_type;
	 public $_fuel_type_type='varchar2';
	/**
 	 * 注释:饮水
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $water;
	 public $_water_type='varchar2';
	/**
 	 * 注释:厕所
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $toilet;
	 public $_toilet_type='varchar2';
	/**
 	 * 注释:禽畜栏
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $livestock_column;
	 public $_livestock_column_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
