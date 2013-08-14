<?php
require_once ('db_oracle.php');
/**
 *注释:诊疗收费表
 *
 *
 **/
class Ttb_his_mz_charge extends dao_oracle{
	 public $__table = 'tb_his_mz_charge';
	/**
 	 * 注释:收/退费日期
	 * 
	 * 
	 * @var VARCHAR2(8)
	 **/
 	 public $stfrq;
	 public $_stfrq_type='varchar2';
	/**
 	 * 注释:收/退费编号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $stfbh;
	 public $_stfbh_type='varchar2';
	/**
 	 * 注释:退费标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $stfbz;
	 public $_stfbz_type='char';
	/**
 	 * 注释:医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:保险类型
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bxlx;
	 public $_bxlx_type='varchar2';
	/**
 	 * 注释:外地标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $wdbz;
	 public $_wdbz_type='char';
	/**
 	 * 注释:收/退费时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $stfsj;
	 public $_stfsj_type='date';
	/**
 	 * 注释:收/退费总额
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $stfze;
	 public $_stfze_type='number';
	/**
 	 * 注释:医保范围外自费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ybfwwzf;
	 public $_ybfwwzf_type='number';
	/**
 	 * 注释:其中特需费用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $txfye;
	 public $_txfye_type='number';
	/**
 	 * 注释:挂号费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ghf;
	 public $_ghf_type='number';
	/**
 	 * 注释:西药费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xyf;
	 public $_xyf_type='number';
	/**
 	 * 注释:中成药费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zcyf;
	 public $_zcyf_type='number';
	/**
 	 * 注释:中草药费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zcaf;
	 public $_zcaf_type='number';
	/**
 	 * 注释:诊查费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zcf;
	 public $_zcf_type='number';
	/**
 	 * 注释:住院费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zyf;
	 public $_zyf_type='number';
	/**
 	 * 注释:床位费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cwf;
	 public $_cwf_type='number';
	/**
 	 * 注释:检查费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jcf;
	 public $_jcf_type='number';
	/**
 	 * 注释:检验费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jyf;
	 public $_jyf_type='number';
	/**
 	 * 注释:透视费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tsf;
	 public $_tsf_type='number';
	/**
 	 * 注释:摄片费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $spf;
	 public $_spf_type='number';
	/**
 	 * 注释:治疗费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zhf;
	 public $_zhf_type='number';
	/**
 	 * 注释:诊疗费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zlf;
	 public $_zlf_type='number';
	/**
 	 * 注释:输血费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sxf;
	 public $_sxf_type='number';
	/**
 	 * 注释:输氧费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $syf;
	 public $_syf_type='number';
	/**
 	 * 注释:手术及材料费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ssclf;
	 public $_ssclf_type='number';
	/**
 	 * 注释:护理费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hlf;
	 public $_hlf_type='number';
	/**
 	 * 注释:其他费用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $qtfy;
	 public $_qtfy_type='number';
	/**
 	 * 注释:自理费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zilif;
	 public $_zilif_type='number';
	/**
 	 * 注释:接生费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jsf;
	 public $_jsf_type='number';
	/**
 	 * 注释:麻醉费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mzf;
	 public $_mzf_type='number';
	/**
 	 * 注释:婴儿费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yef;
	 public $_yef_type='number';
	/**
 	 * 注释:陪床费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $pcf;
	 public $_pcf_type='number';
	/**
 	 * 注释:放射费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $fsf;
	 public $_fsf_type='number';
	/**
 	 * 注释:处方张数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cfzs;
	 public $_cfzs_type='number';
	/**
 	 * 注释:门诊就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ghbm;
	 public $_ghbm_type='varchar2';
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
