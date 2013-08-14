<?php
require_once ('db_oracle.php');
/**
 *注释:药品库存表
 *
 *
 **/
class Twd_med_store extends dao_oracle{
	 public $__table = 'wd_med_store';
	/**
 	 * 注释:唯一记录编号
	 * 
	 * 
	 * @var VARCHAR2(36)
	 **/
 	 public $kcid;
	 public $_kcid_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:药品所在库房编号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $ypkfid;
	 public $_ypkfid_type='varchar2';
	/**
 	 * 注释:药品所在库房名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $ypkf;
	 public $_ypkf_type='varchar2';
	/**
 	 * 注释:药品编码
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $ypbm;
	 public $_ypbm_type='varchar2';
	/**
 	 * 注释:药品名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ypmc;
	 public $_ypmc_type='varchar2';
	/**
 	 * 注释:药品批号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $ypph;
	 public $_ypph_type='varchar2';
	/**
 	 * 注释:药品产地
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ypcd;
	 public $_ypcd_type='varchar2';
	/**
 	 * 注释:药品失效日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $ypsxrq;
	 public $_ypsxrq_type='date';
	/**
 	 * 注释:药品类别1、西药 2、中成药 3、中草药9、其他
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $yplb;
	 public $_yplb_type='char';
	/**
 	 * 注释:药品毒理分类1、麻醉药
2、 毒性药
3、 精神I类
4、精神II类
5、 普通药
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ypdlfl;
	 public $_ypdlfl_type='char';
	/**
 	 * 注释:批准文号
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $pzwh;
	 public $_pzwh_type='varchar2';
	/**
 	 * 注释:药品规格
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $ypgg;
	 public $_ypgg_type='varchar2';
	/**
 	 * 注释:药品剂量
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $ypjl;
	 public $_ypjl_type='varchar2';
	/**
 	 * 注释:药品大包装单位，瓶，盒，板等。没有包装单位即为“ ”（一个空格，不能写空字符串）
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $ypbzdw;
	 public $_ypbzdw_type='varchar2';
	/**
 	 * 注释:药品包装倍数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ypbzbs;
	 public $_ypbzbs_type='number';
	/**
 	 * 注释:药品库存数量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ypkc;
	 public $_ypkc_type='number';
	/**
 	 * 注释:药品库存单位
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $ypdw;
	 public $_ypdw_type='varchar2';
	/**
 	 * 注释:零售药品价格
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ypdj;
	 public $_ypdj_type='number';
	/**
 	 * 注释:进货药品价格
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jhypjg;
	 public $_jhypjg_type='number';
	/**
 	 * 注释:批发药品价格
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $pfypjg;
	 public $_pfypjg_type='number';
	/**
 	 * 注释:是否基药
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfjy;
	 public $_sfjy_type='char';
	/**
 	 * 注释:药品出库数量合计
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ypcksl;
	 public $_ypcksl_type='number';
	/**
 	 * 注释:药品入库数量合计
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yprksl;
	 public $_yprksl_type='number';
}
