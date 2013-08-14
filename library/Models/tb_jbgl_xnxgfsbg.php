<?php
require_once ('db_oracle.php');
/**
 *注释:2.6.1 心脑血管A1发病、死亡报告表
 *
 *
 **/
class Ttb_jbgl_xnxgfsbg extends dao_oracle{
	 public $__table = 'tb_jbgl_xnxgfsbg';
	/**
 	 * 注释:报告卡编号
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bgkbh;
	 public $_bgkbh_type='varchar2';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:个人标识符
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jkdabz;
	 public $_jkdabz_type='varchar2';
	/**
 	 * 注释:标识符类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $bzflx;
	 public $_bzflx_type='varchar2';
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
 	 * 注释:证件号码
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $zjhm;
	 public $_zjhm_type='varchar2';
	/**
 	 * 注释:证件类型
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zjlx;
	 public $_zjlx_type='varchar2';
	/**
 	 * 注释:个人保健号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $grbjh;
	 public $_grbjh_type='varchar2';
	/**
 	 * 注释:建卡日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jkrq;
	 public $_jkrq_type='date';
	/**
 	 * 注释:是否心血管发病
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sfxxgfb;
	 public $_sfxxgfb_type='varchar2';
	/**
 	 * 注释:是否心血管死亡
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sfxxgsw;
	 public $_sfxxgsw_type='varchar2';
	/**
 	 * 注释:是否脑血管发病
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sfnxgfb;
	 public $_sfnxgfb_type='varchar2';
	/**
 	 * 注释:是否脑血管死亡
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sfnxgsw;
	 public $_sfnxgsw_type='varchar2';
	/**
 	 * 注释:诊断类型
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $bgbz;
	 public $_bgbz_type='varchar2';
	/**
 	 * 注释:诊断依据
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $zdyj;
	 public $_zdyj_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(32)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:就诊医院
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $jzyy;
	 public $_jzyy_type='varchar2';
	/**
 	 * 注释:发病次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fbcs;
	 public $_fbcs_type='number';
	/**
 	 * 注释:门诊号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $mzh;
	 public $_mzh_type='varchar2';
	/**
 	 * 注释:住院号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zyh;
	 public $_zyh_type='varchar2';
	/**
 	 * 注释:发病日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $fbrq;
	 public $_fbrq_type='date';
	/**
 	 * 注释:死亡日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $swrq;
	 public $_swrq_type='date';
	/**
 	 * 注释:报告单位
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $bgdw;
	 public $_bgdw_type='varchar2';
	/**
 	 * 注释:报告人
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bgr;
	 public $_bgr_type='varchar2';
	/**
 	 * 注释:报告日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $bgrq;
	 public $_bgrq_type='date';
	/**
 	 * 注释:备注
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $bz;
	 public $_bz_type='varchar2';
	/**
 	 * 注释:失访原因
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sfyy;
	 public $_sfyy_type='varchar2';
	/**
 	 * 注释:首次发病或死亡诱因
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $scfahswyy;
	 public $_scfahswyy_type='varchar2';
	/**
 	 * 注释:首次发病或死亡诱因其他
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $scfahswyyqt;
	 public $_scfahswyyqt_type='varchar2';
	/**
 	 * 注释:资料来源
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zlly;
	 public $_zlly_type='varchar2';
	/**
 	 * 注释:资料来源其他
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $zllyqt;
	 public $_zllyqt_type='varchar2';
	/**
 	 * 注释:有无高血压
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywgxy;
	 public $_ywgxy_type='varchar2';
	/**
 	 * 注释:有无糖尿病
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywtnb;
	 public $_ywtnb_type='varchar2';
	/**
 	 * 注释:有无高脂血症
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywgzxz;
	 public $_ywgzxz_type='varchar2';
	/**
 	 * 注释:有无冠心病
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywgxb;
	 public $_ywgxb_type='varchar2';
	/**
 	 * 注释:有无其他心脏病
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywqtxzb;
	 public $_ywqtxzb_type='varchar2';
	/**
 	 * 注释:其他心脏病名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $qtxzbmc;
	 public $_qtxzbmc_type='varchar2';
	/**
 	 * 注释:有无吸烟
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywxy;
	 public $_ywxy_type='varchar2';
	/**
 	 * 注释:有无肥胖或超重
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywfphcz;
	 public $_ywfphcz_type='varchar2';
	/**
 	 * 注释:有无过量饮酒
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywglyj;
	 public $_ywglyj_type='varchar2';
	/**
 	 * 注释:有无家族史
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $ywjzs;
	 public $_ywjzs_type='varchar2';
	/**
 	 * 注释:行为其他
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $xwqt;
	 public $_xwqt_type='varchar2';
	/**
 	 * 注释:调查人
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $dcr;
	 public $_dcr_type='varchar2';
	/**
 	 * 注释:调查单位
	 * 
	 * 
	 * @var VARCHAR2(9)
	 **/
 	 public $dcdw;
	 public $_dcdw_type='varchar2';
	/**
 	 * 注释:发病调查日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $fbdcrq;
	 public $_fbdcrq_type='date';
	/**
 	 * 注释:死亡调查日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $swdcrq;
	 public $_swdcrq_type='date';
	/**
 	 * 注释:卒中脑梗死
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $zzngs;
	 public $_zzngs_type='varchar2';
	/**
 	 * 注释:卒中脑出血
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $zzncx;
	 public $_zzncx_type='varchar2';
	/**
 	 * 注释:卒中蛛网膜下腔出血
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $zzzwmxqcx;
	 public $_zzzwmxqcx_type='varchar2';
	/**
 	 * 注释:卒中未分类
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $zzwfx;
	 public $_zzwfx_type='varchar2';
	/**
 	 * 注释:死亡地点
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $swdd;
	 public $_swdd_type='varchar2';
	/**
 	 * 注释:死亡地点其他
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $swddqt;
	 public $_swddqt_type='varchar2';
	/**
 	 * 注释:主要死因
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zysy;
	 public $_zysy_type='varchar2';
	/**
 	 * 注释:主要死因其他
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $zysyqt;
	 public $_zysyqt_type='varchar2';
	/**
 	 * 注释:前次心肌梗死
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $qcxjgs;
	 public $_qcxjgs_type='varchar2';
	/**
 	 * 注释:发作后存活时间小时
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fzhchsjxs;
	 public $_fzhchsjxs_type='number';
	/**
 	 * 注释:发作后存活时间分钟
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $fzhchsjfz;
	 public $_fzhchsjfz_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:上传时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $scsj;
	 public $_scsj_type='date';
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
