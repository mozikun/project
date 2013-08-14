<?php
require_once ('db_oracle.php');
/**
 *注释:预防接种卡从表2
 *
 *
 **/
class Tvac_second_info extends dao_oracle{
	 public $__table = 'vac_second_info';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
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
 	 * 注释:二类疫苗接名称1
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $vaccinum_name_1;
	 public $_vaccinum_name_1_type='varchar2';
	/**
 	 * 注释:二类疫苗接种时间1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $vaccinum_time_1;
	 public $_vaccinum_time_1_type='number';
	/**
 	 * 注释:二类疫苗接种部位1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $vaccinum_part_1;
	 public $_vaccinum_part_1_type='varchar2';
	/**
 	 * 注释:二类疫苗批号1
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $vaccinum_batch_1;
	 public $_vaccinum_batch_1_type='varchar2';
	/**
 	 * 注释:二类疫苗有效日期1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $vaccinum_effective_1;
	 public $_vaccinum_effective_1_type='number';
	/**
 	 * 注释:二类疫苗生产企业1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $vaccinum_enterprises_1;
	 public $_vaccinum_enterprises_1_type='varchar2';
	/**
 	 * 注释:二类疫苗接种医生1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $vaccinum_doctor_1;
	 public $_vaccinum_doctor_1_type='varchar2';
	/**
 	 * 注释:二类疫苗接种备注1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $vaccinum_remark_1;
	 public $_vaccinum_remark_1_type='varchar2';
	/**
 	 * 注释:二类疫苗接种时间2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $vaccinum_time_2;
	 public $_vaccinum_time_2_type='number';
	/**
 	 * 注释:二类疫苗接种部位2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $vaccinum_part_2;
	 public $_vaccinum_part_2_type='varchar2';
	/**
 	 * 注释:二类疫苗批号2
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $vaccinum_batch_2;
	 public $_vaccinum_batch_2_type='varchar2';
	/**
 	 * 注释:二类疫苗有效日期2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $vaccinum_effective_2;
	 public $_vaccinum_effective_2_type='number';
	/**
 	 * 注释:二类疫苗生产企业2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $vaccinum_enterprises_2;
	 public $_vaccinum_enterprises_2_type='varchar2';
	/**
 	 * 注释:二类疫苗接种医生2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $vaccinum_doctor_2;
	 public $_vaccinum_doctor_2_type='varchar2';
	/**
 	 * 注释:二类疫苗接种备注2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $vaccinum_remark_2;
	 public $_vaccinum_remark_2_type='varchar2';
	/**
 	 * 注释:二类疫苗接种时间3
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $vaccinum_time_3;
	 public $_vaccinum_time_3_type='number';
	/**
 	 * 注释:二类疫苗接种部位3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $vaccinum_part_3;
	 public $_vaccinum_part_3_type='varchar2';
	/**
 	 * 注释:二类疫苗批号3
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $vaccinum_batch_3;
	 public $_vaccinum_batch_3_type='varchar2';
	/**
 	 * 注释:二类疫苗有效日期3
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $vaccinum_effective_3;
	 public $_vaccinum_effective_3_type='number';
	/**
 	 * 注释:二类疫苗生产企业3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $vaccinum_enterprises_3;
	 public $_vaccinum_enterprises_3_type='varchar2';
	/**
 	 * 注释:二类疫苗接种医生3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $vaccinum_doctor_3;
	 public $_vaccinum_doctor_3_type='varchar2';
	/**
 	 * 注释:二类疫苗接种备注3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $vaccinum_remark_3;
	 public $_vaccinum_remark_3_type='varchar2';
	/**
 	 * 注释:二类疫苗接名称2
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $vaccinum_name_2;
	 public $_vaccinum_name_2_type='varchar2';
	/**
 	 * 注释:二类疫苗接名称3
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $vaccinum_name_3;
	 public $_vaccinum_name_3_type='varchar2';
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
