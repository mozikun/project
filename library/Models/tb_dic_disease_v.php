<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttb_dic_disease extends dao_oracle{
	 public $__table = 'dic_disease_v';
	/**
 	 * 注释:疾病的序号，递增
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:疾病的上级编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $fdmz;
	 public $_fdmz_type='varchar2';
	/**
 	 * 注释:疾病的编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dmxz;
	 public $_dmxz_type='varchar2';
	/**
 	 * 注释:疾病名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $dmxmc;
	 public $_dmxmc_type='varchar2';
	/**
 	 * 注释:疾病拼音代码
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $pyzjm;
	 public $_pyzjm_type='varchar2';
}
