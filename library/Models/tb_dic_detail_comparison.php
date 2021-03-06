<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttb_dic_detail_comparison extends dao_oracle{
	 public $__table = 'tb_dic_detail_comparison';
	/**
 	 * 注释:诊疗序号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zlxh;
	 public $_zlxh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:项目名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $xmmc;
	 public $_xmmc_type='varchar2';
	/**
 	 * 注释:诊疗项目包含的内容
	 * 
	 * 
	 * @var VARCHAR2(1000)
	 **/
 	 public $xmnh;
	 public $_xmnh_type='varchar2';
	/**
 	 * 注释:诊疗项目的单位
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xmdw;
	 public $_xmdw_type='varchar2';
	/**
 	 * 注释:诊疗项目的拼音代码
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $pydm;
	 public $_pydm_type='varchar2';
	/**
 	 * 注释:诊疗项目的五笔代码
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $wbdm;
	 public $_wbdm_type='varchar2';
	/**
 	 * 注释:编码：0：非自费，1：自费
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $zfpb;
	 public $_zfpb_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $dlbm;
	 public $_dlbm_type='varchar2';
	/**
 	 * 注释:预留字段
	 * 
	 * 
	 * @var VARCHAR2(1000)
	 **/
 	 public $bz;
	 public $_bz_type='varchar2';
}
