<?php
require_once ('db_oracle.php');
/**
 *注释:住院医嘱明细表
 *
 *
 **/
class Ttb_cis_dradvice_detail extends dao_oracle{
	 public $__table = 'tb_cis_dradvice_detail';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:医嘱ID
	 * 
	 * 
	 * @var VARCHAR2(36)
	 **/
 	 public $yzid;
	 public $_yzid_type='varchar2';
	/**
 	 * 注释:住院就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jzlsh;
	 public $_jzlsh_type='varchar2';
	/**
 	 * 注释:撤销标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $cxbz;
	 public $_cxbz_type='char';
	/**
 	 * 注释:卡号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $kh;
	 public $_kh_type='varchar2';
	/**
 	 * 注释:卡类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $klx;
	 public $_klx_type='varchar2';
	/**
 	 * 注释:病区
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $bq;
	 public $_bq_type='varchar2';
	/**
 	 * 注释:下达科室编码
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $xdksbm;
	 public $_xdksbm_type='varchar2';
	/**
 	 * 注释:下达科室名称
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $xdksmc;
	 public $_xdksmc_type='varchar2';
	/**
 	 * 注释:医嘱下达人工号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $xdrgh;
	 public $_xdrgh_type='varchar2';
	/**
 	 * 注释:医嘱下达人姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xdrxm;
	 public $_xdrxm_type='varchar2';
	/**
 	 * 注释:医嘱下达时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $yzxdsj;
	 public $_yzxdsj_type='date';
	/**
 	 * 注释:执行科室编码
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $zxksbm;
	 public $_zxksbm_type='varchar2';
	/**
 	 * 注释:执行科室名称
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $zxksmc;
	 public $_zxksmc_type='varchar2';
	/**
 	 * 注释:医嘱执行人工号
	 * 
	 * 
	 * @var VARCHAR2(64)
	 **/
 	 public $zxrgh;
	 public $_zxrgh_type='varchar2';
	/**
 	 * 注释:医嘱执行人姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zxrxm;
	 public $_zxrxm_type='varchar2';
	/**
 	 * 注释:医嘱执行时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $yzzxsj;
	 public $_yzzxsj_type='date';
	/**
 	 * 注释:医嘱终止时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $yzzzsj;
	 public $_yzzzsj_type='date';
	/**
 	 * 注释:医嘱说明
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $yzsm;
	 public $_yzsm_type='varchar2';
	/**
 	 * 注释:医嘱组号
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $yzzh;
	 public $_yzzh_type='varchar2';
	/**
 	 * 注释:医嘱类别
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $yzlb;
	 public $_yzlb_type='char';
	/**
 	 * 注释:医嘱明细编码
	 * 
	 * 
	 * @var VARCHAR2(36)
	 **/
 	 public $yzmxbm;
	 public $_yzmxbm_type='varchar2';
	/**
 	 * 注释:医嘱明细名称
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $yzmxmc;
	 public $_yzmxmc_type='varchar2';
	/**
 	 * 注释:医嘱项目分类编码
	 * 
	 * 
	 * @var VARCHAR2(36)
	 **/
 	 public $yzxmfldm;
	 public $_yzxmfldm_type='varchar2';
	/**
 	 * 注释:医嘱项目分类名称
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $yzxmflmc;
	 public $_yzxmflmc_type='varchar2';
	/**
 	 * 注释:是否药品
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $yzlx;
	 public $_yzlx_type='varchar2';
	/**
 	 * 注释:药品规格
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $ypgg;
	 public $_ypgg_type='varchar2';
	/**
 	 * 注释:药品用法
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $ypyf;
	 public $_ypyf_type='varchar2';
	/**
 	 * 注释:用药频度
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $yypd;
	 public $_yypd_type='varchar2';
	/**
 	 * 注释:每次使用剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jl;
	 public $_jl_type='number';
	/**
 	 * 注释:每次使用剂量单位
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $dw;
	 public $_dw_type='varchar2';
	/**
 	 * 注释:每次使用数量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mcsl;
	 public $_mcsl_type='number';
	/**
 	 * 注释:每次使用数量单位
	 * 
	 * 
	 * @var VARCHAR2(6)
	 **/
 	 public $mcdw;
	 public $_mcdw_type='varchar2';
	/**
 	 * 注释:给药途径(用法)
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $yf;
	 public $_yf_type='varchar2';
	/**
 	 * 注释:用药天数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yyts;
	 public $_yyts_type='number';
	/**
 	 * 注释:皮试判别
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfps;
	 public $_sfps_type='char';
	/**
 	 * 注释:发药数量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ypsl;
	 public $_ypsl_type='number';
	/**
 	 * 注释:发药数量单位
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $ypdw;
	 public $_ypdw_type='varchar2';
	/**
 	 * 注释:中药煎煮法代码
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $jydm;
	 public $_jydm_type='varchar2';
	/**
 	 * 注释:检查部位
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $jcbw;
	 public $_jcbw_type='varchar2';
	/**
 	 * 注释:备注
	 * 
	 * 
	 * @var VARCHAR2(1024)
	 **/
 	 public $bz;
	 public $_bz_type='varchar2';
	/**
 	 * 注释:密级
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
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
