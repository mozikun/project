<?php
require_once ('db_oracle.php');
/**
 *注释:肿瘤随访信息
 *
 *
 **/
class Ttb_jbgl_zlsfxx extends dao_oracle{
	 public $__table = 'tb_jbgl_zlsfxx';
	/**
 	 * 注释:随访记录ID
	 * 
	 * 
	 * @var VARCHAR2(60)
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
 	 * 注释:报告卡编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bgkbh;
	 public $_bgkbh_type='varchar2';
	/**
 	 * 注释:体重(kg)
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $tz;
	 public $_tz_type='varchar2';
	/**
 	 * 注释:是否吸烟
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $sfxy;
	 public $_sfxy_type='varchar2';
	/**
 	 * 注释:目前治疗情况
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $mqzlqk;
	 public $_mqzlqk_type='varchar2';
	/**
 	 * 注释:有无复发
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywff;
	 public $_ywff_type='varchar2';
	/**
 	 * 注释:第一次复发日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $ff1;
	 public $_ff1_type='date';
	/**
 	 * 注释:第二次复发日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $ff2;
	 public $_ff2_type='date';
	/**
 	 * 注释:第三次复发日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $ff3;
	 public $_ff3_type='date';
	/**
 	 * 注释:转移部位1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zybw1;
	 public $_zybw1_type='varchar2';
	/**
 	 * 注释:转移日期1
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zyrq1;
	 public $_zyrq1_type='date';
	/**
 	 * 注释:转移部位2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zybw2;
	 public $_zybw2_type='varchar2';
	/**
 	 * 注释:转移日期2
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zyrq2;
	 public $_zyrq2_type='date';
	/**
 	 * 注释:转移部位3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zybw3;
	 public $_zybw3_type='varchar2';
	/**
 	 * 注释:转移日期3
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zyrq3;
	 public $_zyrq3_type='date';
	/**
 	 * 注释:目前情况
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $mqqk;
	 public $_mqqk_type='varchar2';
	/**
 	 * 注释:指导内容
	 * 
	 * 
	 * @var VARCHAR2(7)
	 **/
 	 public $zdnr;
	 public $_zdnr_type='varchar2';
	/**
 	 * 注释:卡氏评分
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $kspf;
	 public $_kspf_type='varchar2';
	/**
 	 * 注释:医师姓名
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ysxm;
	 public $_ysxm_type='varchar2';
	/**
 	 * 注释:是否撤销随访管理
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $cxsfgl;
	 public $_cxsfgl_type='varchar2';
	/**
 	 * 注释:撤销随访管理原因
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $csxfyy;
	 public $_csxfyy_type='varchar2';
	/**
 	 * 注释:撤消随访原因其他
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $sfcxyyqt;
	 public $_sfcxyyqt_type='varchar2';
	/**
 	 * 注释:撤销随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csxfrq;
	 public $_csxfrq_type='date';
	/**
 	 * 注释:死亡标志
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $swbz;
	 public $_swbz_type='varchar2';
	/**
 	 * 注释:死亡日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $swrq;
	 public $_swrq_type='date';
	/**
 	 * 注释:死亡原因
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $swyy;
	 public $_swyy_type='char';
	/**
 	 * 注释:死亡ICD10
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $swicd;
	 public $_swicd_type='varchar2';
	/**
 	 * 注释:死亡地点
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $swdd;
	 public $_swdd_type='char';
	/**
 	 * 注释:本次随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $bcsfrq;
	 public $_bcsfrq_type='date';
	/**
 	 * 注释:下次随访日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $xcsfrq;
	 public $_xcsfrq_type='date';
	/**
 	 * 注释:备注
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $bz;
	 public $_bz_type='varchar2';
	/**
 	 * 注释:最近更新时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zjgxsj;
	 public $_zjgxsj_type='date';
	/**
 	 * 注释:医疗机构编码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgbm;
	 public $_yljgbm_type='varchar2';
	/**
 	 * 注释:上传时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sbsj;
	 public $_sbsj_type='date';
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
 	 public $yl1;
	 public $_yl1_type='varchar2';
	/**
 	 * 注释:预留二
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $yl2;
	 public $_yl2_type='varchar2';
}
