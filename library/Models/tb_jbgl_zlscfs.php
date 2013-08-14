<?php
require_once ('db_oracle.php');
/**
 *注释:肿瘤首次访视内容
 *
 *
 **/
class Ttb_jbgl_zlscfs extends dao_oracle{
	 public $__table = 'tb_jbgl_zlscfs';
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
 	 * 注释:户口核实
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $hkhs;
	 public $_hkhs_type='varchar2';
	/**
 	 * 注释:户口未核实原因
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $hkwhsyy;
	 public $_hkwhsyy_type='varchar2';
	/**
 	 * 注释:居住核实
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $jzhs;
	 public $_jzhs_type='varchar2';
	/**
 	 * 注释:居住未核实原因
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $jzwhsyy;
	 public $_jzwhsyy_type='varchar2';
	/**
 	 * 注释:身高
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $sg;
	 public $_sg_type='varchar2';
	/**
 	 * 注释:体重
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $tz;
	 public $_tz_type='varchar2';
	/**
 	 * 注释:吸烟史
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $xys;
	 public $_xys_type='varchar2';
	/**
 	 * 注释:被动吸烟场所
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $bdxycs;
	 public $_bdxycs_type='char';
	/**
 	 * 注释:开始吸烟年龄（岁）
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $ksxynl;
	 public $_ksxynl_type='varchar2';
	/**
 	 * 注释:戒烟年龄（岁）
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $jynl;
	 public $_jynl_type='varchar2';
	/**
 	 * 注释:合计吸烟时间
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $hjxysj;
	 public $_hjxysj_type='varchar2';
	/**
 	 * 注释:日均吸烟支数
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $rjxyzs;
	 public $_rjxyzs_type='varchar2';
	/**
 	 * 注释:首次出现症状日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sccxzzrq;
	 public $_sccxzzrq_type='date';
	/**
 	 * 注释:首次就诊日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $scjzrq;
	 public $_scjzrq_type='date';
	/**
 	 * 注释:曾经治疗情况
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $cjzlqk;
	 public $_cjzlqk_type='varchar2';
	/**
 	 * 注释:肿瘤家族史
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zljzs;
	 public $_zljzs_type='char';
	/**
 	 * 注释:祖父辈肿瘤史1
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zfbzls1;
	 public $_zfbzls1_type='varchar2';
	/**
 	 * 注释:祖父辈肿瘤史2
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zfbzls2;
	 public $_zfbzls2_type='varchar2';
	/**
 	 * 注释:祖父辈肿瘤史3
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zfbzls3;
	 public $_zfbzls3_type='varchar2';
	/**
 	 * 注释:父辈肿瘤史1
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $fmbzls1;
	 public $_fmbzls1_type='varchar2';
	/**
 	 * 注释:父辈肿瘤史2
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $fmbzls2;
	 public $_fmbzls2_type='varchar2';
	/**
 	 * 注释:父辈肿瘤史3
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $fmbzls3;
	 public $_fmbzls3_type='varchar2';
	/**
 	 * 注释:同辈肿瘤史1
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $tbzls1;
	 public $_tbzls1_type='varchar2';
	/**
 	 * 注释:同辈肿瘤史2
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $tbzls2;
	 public $_tbzls2_type='varchar2';
	/**
 	 * 注释:同辈肿瘤史3
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $tbzls3;
	 public $_tbzls3_type='varchar2';
	/**
 	 * 注释:子辈肿瘤史1
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zsbzls1;
	 public $_zsbzls1_type='varchar2';
	/**
 	 * 注释:子辈肿瘤史2
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zsbzls2;
	 public $_zsbzls2_type='varchar2';
	/**
 	 * 注释:子辈肿瘤史3
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zsbzls3;
	 public $_zsbzls3_type='varchar2';
	/**
 	 * 注释:首次手术医院代码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $scssyy;
	 public $_scssyy_type='varchar2';
	/**
 	 * 注释:首次手术日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $scssrq;
	 public $_scssrq_type='date';
	/**
 	 * 注释:住院号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zyh;
	 public $_zyh_type='varchar2';
	/**
 	 * 注释:病理号
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $blh;
	 public $_blh_type='varchar2';
	/**
 	 * 注释:手术性质
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ssyz;
	 public $_ssyz_type='char';
	/**
 	 * 注释:手术医院1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ssyy1;
	 public $_ssyy1_type='varchar2';
	/**
 	 * 注释:放疗医院1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $flyy1;
	 public $_flyy1_type='varchar2';
	/**
 	 * 注释:化疗医院1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hlyy1;
	 public $_hlyy1_type='varchar2';
	/**
 	 * 注释:手术医院2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ssyy2;
	 public $_ssyy2_type='varchar2';
	/**
 	 * 注释:放疗医院2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $flyy2;
	 public $_flyy2_type='varchar2';
	/**
 	 * 注释:化疗医院2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hlyy2;
	 public $_hlyy2_type='varchar2';
	/**
 	 * 注释:手术医院3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ssyy3;
	 public $_ssyy3_type='varchar2';
	/**
 	 * 注释:放疗医院3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $flyy3;
	 public $_flyy3_type='varchar2';
	/**
 	 * 注释:化疗医院3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hlyy3;
	 public $_hlyy3_type='varchar2';
	/**
 	 * 注释:转移部位1
	 * 
	 * 
	 * @var VARCHAR2(50)
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
	 * @var VARCHAR2(50)
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
	 * @var VARCHAR2(50)
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
 	 * 注释:转移部位4
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $zybw4;
	 public $_zybw4_type='varchar2';
	/**
 	 * 注释:转移日期4
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zyrq4;
	 public $_zyrq4_type='date';
	/**
 	 * 注释:转移部位5
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $zybw5;
	 public $_zybw5_type='varchar2';
	/**
 	 * 注释:转移日期5
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $zyrq5;
	 public $_zyrq5_type='date';
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
	 * @var VARCHAR2(3)
	 **/
 	 public $kspf;
	 public $_kspf_type='varchar2';
	/**
 	 * 注释:医师姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
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
	 * @var VARCHAR2(1)
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
 	 * 注释:生存期
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $scq;
	 public $_scq_type='varchar2';
	/**
 	 * 注释:死亡标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $swbz;
	 public $_swbz_type='char';
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
 	 * 注释:本次访视日期
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
