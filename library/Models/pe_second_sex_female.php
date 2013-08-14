<?php
require_once ('db_oracle.php');
/**
 *注释:婚前医学检查表-第二性征女性
 *
 *
 **/
class Tpe_second_sex_female extends dao_oracle{
	 public $__table = 'pe_second_sex_female';
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
 	 * 注释:阴毛|radio|1=>正常,2=>稀少,3=>无
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $pubes;
	 public $_pubes_type='varchar2';
	/**
 	 * 注释:乳房|radio|1=>正常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $breast;
	 public $_breast_type='varchar2';
	/**
 	 * 注释:乳房详细
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $breast_info;
	 public $_breast_info_type='varchar2';
	/**
 	 * 注释:外阴常规
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $vulva_convention;
	 public $_vulva_convention_type='varchar2';
	/**
 	 * 注释:分泌物
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $secretions;
	 public $_secretions_type='varchar2';
	/**
 	 * 注释:子宫
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $uterus;
	 public $_uterus_type='varchar2';
	/**
 	 * 注释:附件
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $enclosure;
	 public $_enclosure_type='varchar2';
	/**
 	 * 注释:外阴
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $vulva;
	 public $_vulva_type='varchar2';
	/**
 	 * 注释:阴道
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $vagina;
	 public $_vagina_type='varchar2';
	/**
 	 * 注释:宫颈
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $cervix;
	 public $_cervix_type='varchar2';
	/**
 	 * 注释:子宫
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $womb;
	 public $_womb_type='varchar2';
	/**
 	 * 注释:附件
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $annex;
	 public $_annex_type='varchar2';
	/**
 	 * 注释:其它
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $sex_female_other;
	 public $_sex_female_other_type='varchar2';
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
