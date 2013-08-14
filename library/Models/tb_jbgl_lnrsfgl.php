<?php
require_once ('db_oracle.php');
/**
 *注释:老年人随访表
 *
 *
 **/
class Ttb_jbgl_lnrsfgl extends dao_oracle{
	 public $__table = 'tb_jbgl_lnrsfgl';
	/**
 	 * 注释:随访记录ID
	 * 
	 * 
	 * @var VARCHAR2(52)
	 **/
 	 public $sfjlid;
	 public $_sfjlid_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:老年人专项表ID
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $lnrid;
	 public $_lnrid_type='varchar2';
	/**
 	 * 注释:随访编号
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sfbh;
	 public $_sfbh_type='varchar2';
	/**
 	 * 注释:随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sfrq;
	 public $_sfrq_type='date';
	/**
 	 * 注释:随访方式代码
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sffsdm;
	 public $_sffsdm_type='varchar2';
	/**
 	 * 注释:转归情况
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zg;
	 public $_zg_type='varchar2';
	/**
 	 * 注释:失访原因
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $sfyy;
	 public $_sfyy_type='varchar2';
	/**
 	 * 注释:转归其它
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $zgqt;
	 public $_zgqt_type='varchar2';
	/**
 	 * 注释:症状
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zz;
	 public $_zz_type='varchar2';
	/**
 	 * 注释:心理状态与指导
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xlztzd;
	 public $_xlztzd_type='varchar2';
	/**
 	 * 注释:体重
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tz;
	 public $_tz_type='number';
	/**
 	 * 注释:日吸烟量(支)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yl;
	 public $_yl_type='number';
	/**
 	 * 注释:戒烟年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jynl;
	 public $_jynl_type='number';
	/**
 	 * 注释:戒烟日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jyrq;
	 public $_jyrq_type='date';
	/**
 	 * 注释:日饮酒量(两)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jl;
	 public $_jl_type='number';
	/**
 	 * 注释:戒酒日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jjrq;
	 public $_jjrq_type='date';
	/**
 	 * 注释:戒酒年龄(岁)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jjnl;
	 public $_jjnl_type='number';
	/**
 	 * 注释:运动方式说明
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $ydfssm;
	 public $_ydfssm_type='varchar2';
	/**
 	 * 注释:运动频率类别代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ydpllb;
	 public $_ydpllb_type='char';
	/**
 	 * 注释:运动时间(min)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ydsj;
	 public $_ydsj_type='number';
	/**
 	 * 注释:坚持运动时长(年)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jcydsc;
	 public $_jcydsc_type='number';
	/**
 	 * 注释:周运动次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zydcs;
	 public $_zydcs_type='number';
	/**
 	 * 注释:饮食情况
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ysqk;
	 public $_ysqk_type='char';
	/**
 	 * 注释:心理调整
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xltz;
	 public $_xltz_type='char';
	/**
 	 * 注释:遵医行为
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zyxw;
	 public $_zyxw_type='char';
	/**
 	 * 注释:疫苗接种情况
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $ymjzqk;
	 public $_ymjzqk_type='varchar2';
	/**
 	 * 注释:冠心病预防情况
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $gxbyfqk;
	 public $_gxbyfqk_type='varchar2';
	/**
 	 * 注释:骨质疏松预防情况
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $gzssyfqk;
	 public $_gzssyfqk_type='varchar2';
	/**
 	 * 注释:随访建议
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $sfjy;
	 public $_sfjy_type='varchar2';
	/**
 	 * 注释:下次随访目标
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xcsfmb;
	 public $_xcsfmb_type='varchar2';
	/**
 	 * 注释:预约下次随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $xcsfrq;
	 public $_xcsfrq_type='date';
	/**
 	 * 注释:随访医生姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $sfysxm;
	 public $_sfysxm_type='varchar2';
	/**
 	 * 注释:随访医生工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $sfysgh;
	 public $_sfysgh_type='varchar2';
	/**
 	 * 注释:密级
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
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
