<?php
require_once ('db_oracle.php');
/**
 *注释:重性精神疾病管理卡表
 *
 *
 **/
class Ttb_jbgl_jsbkfdj extends dao_oracle{
	 public $__table = 'tb_jbgl_jsbkfdj';
	/**
 	 * 注释:精神疾病管理卡ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jsjbglkid;
	 public $_jsjbglkid_type='varchar2';
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
 	 * 注释:病案号
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $bah;
	 public $_bah_type='varchar2';
	/**
 	 * 注释:建卡日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $jkrq;
	 public $_jkrq_type='date';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:性别代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xbdm;
	 public $_xbdm_type='char';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csrq;
	 public $_csrq_type='date';
	/**
 	 * 注释:文化程度
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $whcd;
	 public $_whcd_type='varchar2';
	/**
 	 * 注释:婚姻状况
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hyzk;
	 public $_hyzk_type='varchar2';
	/**
 	 * 注释:民族
	 * 
	 * 
	 * @var VARCHAR2(12)
	 **/
 	 public $mz;
	 public $_mz_type='varchar2';
	/**
 	 * 注释:身份证件-类别代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfzjlbdm;
	 public $_sfzjlbdm_type='char';
	/**
 	 * 注释:身份证件-号码
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $sfzjhm;
	 public $_sfzjhm_type='varchar2';
	/**
 	 * 注释:责任医师工号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zrysgh;
	 public $_zrysgh_type='varchar2';
	/**
 	 * 注释:责任医师姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zrysxm;
	 public $_zrysxm_type='varchar2';
	/**
 	 * 注释:监护人姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jhrxm;
	 public $_jhrxm_type='varchar2';
	/**
 	 * 注释:监护人与患者关系
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $jhrgx;
	 public $_jhrgx_type='varchar2';
	/**
 	 * 注释:监护人住址
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jhrzz;
	 public $_jhrzz_type='varchar2';
	/**
 	 * 注释:监护人电话
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jhrdh;
	 public $_jhrdh_type='varchar2';
	/**
 	 * 注释:辖区居委会名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jwhmc;
	 public $_jwhmc_type='varchar2';
	/**
 	 * 注释:居委会联系人姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jwhlxr;
	 public $_jwhlxr_type='varchar2';
	/**
 	 * 注释:居委会联系人电话
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $xqjwhlxrdh;
	 public $_xqjwhlxrdh_type='varchar2';
	/**
 	 * 注释:重性精神疾病分类
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jsjbfl;
	 public $_jsjbfl_type='char';
	/**
 	 * 注释:初次发病时间
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $ccfbsj;
	 public $_ccfbsj_type='date';
	/**
 	 * 注释:既往主要症状
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $jwzyzz;
	 public $_jwzyzz_type='varchar2';
	/**
 	 * 注释:既往主要症状其他
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jwzyzzqt;
	 public $_jwzyzzqt_type='varchar2';
	/**
 	 * 注释:既往门诊治疗情况代码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $jwmzzldm;
	 public $_jwmzzldm_type='char';
	/**
 	 * 注释:既往精神专科医院/综合医院精神专科次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jwjszycs;
	 public $_jwjszycs_type='number';
	/**
 	 * 注释:最近诊断精神类疾病诊断名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jwjsjbzd;
	 public $_jwjsjbzd_type='varchar2';
	/**
 	 * 注释:确诊日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $scqzrq;
	 public $_scqzrq_type='date';
	/**
 	 * 注释:确诊医疗机构名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $scqzyy;
	 public $_scqzyy_type='varchar2';
	/**
 	 * 注释:确诊医疗机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $qzyljgdm;
	 public $_qzyljgdm_type='varchar2';
	/**
 	 * 注释:最近一次治疗效果
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zjyczlxg;
	 public $_zjyczlxg_type='char';
	/**
 	 * 注释:患病对家庭社会的影响(轻度滋事)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $effect1;
	 public $_effect1_type='number';
	/**
 	 * 注释:患病对家庭社会的影响(肇事)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $effect2;
	 public $_effect2_type='number';
	/**
 	 * 注释:患病对家庭社会的影响(肇祸)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $effect3;
	 public $_effect3_type='number';
	/**
 	 * 注释:患病对家庭社会的影响(自伤)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $effect4;
	 public $_effect4_type='number';
	/**
 	 * 注释:患病对家庭社会的影响(自杀未遂)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $effect5;
	 public $_effect5_type='number';
	/**
 	 * 注释:患病对家庭社会的影响(无)
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $effect6;
	 public $_effect6_type='char';
	/**
 	 * 注释:关锁情况
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $gsqk;
	 public $_gsqk_type='char';
	/**
 	 * 注释:登记人员工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $djrygh;
	 public $_djrygh_type='varchar2';
	/**
 	 * 注释:登记人员姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $djryxm;
	 public $_djryxm_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
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
