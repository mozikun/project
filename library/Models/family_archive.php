<?php
require_once ('db_oracle.php');
/**
 *注释:家庭基本信息表
 *
 *
 **/
class Tfamily_archive extends dao_oracle{
	 public $__table = 'family_archive';
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
 	 public $standard_code;
	 public $_standard_code_type='varchar2';
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
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $deleted;
	 public $_deleted_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $syn_flag;
	 public $_syn_flag_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $family_number;
	 public $_family_number_type='varchar2';
	/**
 	 * 注释:户主个人档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $householder_id;
	 public $_householder_id_type='varchar2';
	/**
 	 * 注释:户主名称
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $householder_name;
	 public $_householder_name_type='varchar2';
	/**
 	 * 注释:户主名称拼音
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $name_pinyin;
	 public $_name_pinyin_type='varchar2';
	/**
 	 * 注释:家庭地址
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $family_address;
	 public $_family_address_type='varchar2';
	/**
 	 * 注释:家庭地址拼音
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $family_address_pinyin;
	 public $_family_address_pinyin_type='varchar2';
	/**
 	 * 注释:家庭电话
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $telephone_number;
	 public $_telephone_number_type='varchar2';
	/**
 	 * 注释:人数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $man_number;
	 public $_man_number_type='number';
	/**
 	 * 注释:家庭构成
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $relation_of_householder;
	 public $_relation_of_householder_type='varchar2';
	/**
 	 * 注释:居住面积
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $home_area;
	 public $_home_area_type='number';
	/**
 	 * 注释:居住状况
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $bide_style;
	 public $_bide_style_type='varchar2';
	/**
 	 * 注释:房屋类型
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $building_style;
	 public $_building_style_type='number';
	/**
 	 * 注释:饮用水来源
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $drinking_water_source;
	 public $_drinking_water_source_type='number';
	/**
 	 * 注释:卫生设施
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sanitation;
	 public $_sanitation_type='number';
	/**
 	 * 注释:燃料类型
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fuel;
	 public $_fuel_type='number';
	/**
 	 * 注释:家庭月收入
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $home_month_income;
	 public $_home_month_income_type='number';
	/**
 	 * 注释:家庭有线电话
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $home_phone;
	 public $_home_phone_type='number';
	/**
 	 * 注释:家庭冰箱
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $home_refrigeratory;
	 public $_home_refrigeratory_type='number';
	/**
 	 * 注释:残疾人数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $deformity_number;
	 public $_deformity_number_type='number';
	/**
 	 * 注释:家庭吸烟人数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $family_smoke_number;
	 public $_family_smoke_number_type='number';
	/**
 	 * 注释:其他人吸二手烟
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $secondhand_smoke;
	 public $_secondhand_smoke_type='varchar2';
	/**
 	 * 注释:含脂肪多的食物
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fat_food;
	 public $_fat_food_type='number';
	/**
 	 * 注释:油炸或熏制的食物
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $deepfry_food;
	 public $_deepfry_food_type='number';
	/**
 	 * 注释:腌制的食品
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $bloat_food;
	 public $_bloat_food_type='number';
	/**
 	 * 注释:甜食
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sweet_food;
	 public $_sweet_food_type='number';
	/**
 	 * 注释:蔬菜
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $greenstuff;
	 public $_greenstuff_type='number';
	/**
 	 * 注释:水果
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fruit;
	 public $_fruit_type='number';
	/**
 	 * 注释:盐
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $salt;
	 public $_salt_type='number';
	/**
 	 * 注释:油
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $oil;
	 public $_oil_type='number';
	/**
 	 * 注释:家庭自定义档案编号
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $sn_self_define;
	 public $_sn_self_define_type='varchar2';
	/**
 	 * 注释:家庭自定义档案编号 拼音
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $sn_self_define_pinyin;
	 public $_sn_self_define_pinyin_type='varchar2';
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
 	 * 注释:家庭档案流水号，以一个医疗机构为范围
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $inner_id;
	 public $_inner_id_type='number';
	/**
 	 * 注释:行政区域路径
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $region_path;
	 public $_region_path_type='varchar2';
	/**
 	 * 注释:建档医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
