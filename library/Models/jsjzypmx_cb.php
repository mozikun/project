<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tjsjzypmx_cb extends dao_oracle{
	 public $__table = 'jsjzypmx_cb';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:主表uuid
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zb_uuid;
	 public $_zb_uuid_type='varchar2';
	/**
 	 * 注释:填报医生ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $tbys;
	 public $_tbys_type='varchar2';
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
 	 * 注释:口服药品品种
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $kfyppz;
	 public $_kfyppz_type='varchar2';
	/**
 	 * 注释:口服药品金额
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $kfypje;
	 public $_kfypje_type='varchar2';
	/**
 	 * 注释:注射药品品种
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $zsyppz;
	 public $_zsyppz_type='varchar2';
	/**
 	 * 注释:注射药品金额
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zsypje;
	 public $_zsypje_type='varchar2';
	/**
 	 * 注释:抗生素品种
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $ksyppz;
	 public $_ksyppz_type='varchar2';
	/**
 	 * 注释:抗生素金额
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ksypje;
	 public $_ksypje_type='varchar2';
	/**
 	 * 注释:毒麻药品品种
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $dmyppz;
	 public $_dmyppz_type='varchar2';
	/**
 	 * 注释:毒麻药品金额
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $dmypje;
	 public $_dmypje_type='varchar2';
	/**
 	 * 注释:外用药品品种
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $yyyppz;
	 public $_yyyppz_type='varchar2';
	/**
 	 * 注释:外用药品金额
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $yyypje;
	 public $_yyypje_type='varchar2';
	/**
 	 * 注释:1未上报，2已上报。
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tbzt;
	 public $_tbzt_type='varchar2';
}
