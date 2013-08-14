<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tmzsyyljz_cb extends dao_oracle{
	 public $__table = 'mzsyyljz_cb';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:患者姓名
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:患者性别
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $xb;
	 public $_xb_type='varchar2';
	/**
 	 * 注释:年龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $age;
	 public $_age_type='number';
	/**
 	 * 注释:患者来源
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hzly;
	 public $_hzly_type='varchar2';
	/**
 	 * 注释:联系电话
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $lxdh;
	 public $_lxdh_type='varchar2';
	/**
 	 * 注释:地震疾病名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $dzsjbymc;
	 public $_dzsjbymc_type='varchar2';
	/**
 	 * 注释:受伤原因
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ssyy;
	 public $_ssyy_type='varchar2';
	/**
 	 * 注释:非地震伤病员疾病名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $fdzssbymc;
	 public $_fdzssbymc_type='varchar2';
	/**
 	 * 注释:非地震受伤原因
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $fdzssyy;
	 public $_fdzssyy_type='varchar2';
	/**
 	 * 注释:是否急诊
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sfjz;
	 public $_sfjz_type='number';
	/**
 	 * 注释:是否转住院 1=>是
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jz_zzy;
	 public $_jz_zzy_type='number';
	/**
 	 * 注释:转住院医院名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jz_zzymc;
	 public $_jz_zzymc_type='varchar2';
	/**
 	 * 注释:处理后离开 1=>是
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jz_clhlk;
	 public $_jz_clhlk_type='number';
	/**
 	 * 注释:死亡
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jz_sw;
	 public $_jz_sw_type='number';
	/**
 	 * 注释:是否手术 1=>是
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sfss;
	 public $_sfss_type='number';
	/**
 	 * 注释:手术名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ssmc;
	 public $_ssmc_type='varchar2';
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
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $id_zb;
	 public $_id_zb_type='varchar2';
}
