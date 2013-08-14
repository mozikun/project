<?php
require_once ('db_oracle.php');
/**
 *注释:药敏结果
 *
 *
 **/
class Ttb_lis_allergy_result extends dao_oracle{
	 public $__table = 'tb_lis_allergy_result';
	/**
 	 * 注释:药敏结果流水号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $ymjglsh;
	 public $_ymjglsh_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:检验报告单号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $bgdh;
	 public $_bgdh_type='varchar2';
	/**
 	 * 注释:报告日期
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $bgrq;
	 public $_bgrq_type='varchar2';
	/**
 	 * 注释:细菌代号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xjdh;
	 public $_xjdh_type='varchar2';
	/**
 	 * 注释:打印序号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dyxh;
	 public $_dyxh_type='number';
	/**
 	 * 注释:药敏代码
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $ymdm;
	 public $_ymdm_type='varchar2';
	/**
 	 * 注释:药敏名称
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $ymmc;
	 public $_ymmc_type='varchar2';
	/**
 	 * 注释:检测结果描述
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $jcjg;
	 public $_jcjg_type='varchar2';
	/**
 	 * 注释:纸片含药量
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $zphyl;
	 public $_zphyl_type='varchar2';
	/**
 	 * 注释:抑菌浓度
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $yjnd;
	 public $_yjnd_type='varchar2';
	/**
 	 * 注释:抑菌环直径
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $yjhzj;
	 public $_yjhzj_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='varchar2';
	/**
 	 * 注释:预留一
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl1;
	 public $_ylyl1_type='varchar2';
	/**
 	 * 注释:预留二
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl2;
	 public $_ylyl2_type='varchar2';
}
