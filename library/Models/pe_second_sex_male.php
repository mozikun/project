<?php
require_once ('db_oracle.php');
/**
 *注释:婚前医学检查表-第二性征男性
 *
 *
 **/
class Tpe_second_sex_male extends dao_oracle{
	 public $__table = 'pe_second_sex_male';
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
 	 * 注释:喉结|radio|1=>有,2=>无
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $adam_apple;
	 public $_adam_apple_type='varchar2';
	/**
 	 * 注释:阴毛|radio|1=>正常,2=>稀少,3=>无
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $pubes;
	 public $_pubes_type='varchar2';
	/**
 	 * 注释:阴茎|radio|1=>正常,2=>异常
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sex_fluid;
	 public $_sex_fluid_type='varchar2';
	/**
 	 * 注释:阴茎异常
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $sex_fluid_info;
	 public $_sex_fluid_info_type='varchar2';
	/**
 	 * 注释:包皮|radio|1=>正常,2=>过长,3=>包茎
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $foreskin;
	 public $_foreskin_type='varchar2';
	/**
 	 * 注释:睾丸|radio|1=>双侧扪及,2=>未扪及
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $testis;
	 public $_testis_type='varchar2';
	/**
 	 * 注释:睾丸左侧
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $testis_left;
	 public $_testis_left_type='varchar2';
	/**
 	 * 注释:睾丸右侧
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $testis_right;
	 public $_testis_right_type='varchar2';
	/**
 	 * 注释:附睾|radio|1=>双侧正常,2=>结节
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $epididymis;
	 public $_epididymis_type='varchar2';
	/**
 	 * 注释:结节：左
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $nodules_left;
	 public $_nodules_left_type='varchar2';
	/**
 	 * 注释:结节：右
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $nodules_right;
	 public $_nodules_right_type='varchar2';
	/**
 	 * 注释:精索静脉曲张|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $varicocele;
	 public $_varicocele_type='varchar2';
	/**
 	 * 注释:精索静脉曲张部位
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $varicocele_place;
	 public $_varicocele_place_type='varchar2';
	/**
 	 * 注释:精索静脉曲张程度
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $varicocele_leavel;
	 public $_varicocele_leavel_type='varchar2';
	/**
 	 * 注释:其它
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $sex_male_other;
	 public $_sex_male_other_type='varchar2';
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
