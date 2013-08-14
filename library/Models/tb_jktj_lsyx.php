<?php
require_once ('db_oracle.php');
/**
 *注释:3-6岁儿童健康检查表
 *
 *
 **/
class Ttb_jktj_lsyx extends dao_oracle{
	 public $__table = 'tb_jktj_lsyx';
	/**
 	 * 注释:体检ID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $tjid;
	 public $_tjid_type='varchar2';
	/**
 	 * 注释:体检机构代码
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:体检机构名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $tjjgmc;
	 public $_tjjgmc_type='varchar2';
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
 	 * 注释:个人标识符
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $grdaid;
	 public $_grdaid_type='varchar2';
	/**
 	 * 注释:标识符类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $bzflx;
	 public $_bzflx_type='varchar2';
	/**
 	 * 注释:体检日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tjrq;
	 public $_tjrq_type='date';
	/**
 	 * 注释:1-6岁儿童体检表编号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $lsyxbh;
	 public $_lsyxbh_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:性别名称
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $xbmc;
	 public $_xbmc_type='varchar2';
	/**
 	 * 注释:性别编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $xbbm;
	 public $_xbbm_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csrq;
	 public $_csrq_type='date';
	/**
 	 * 注释:民族编码
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $mzbm;
	 public $_mzbm_type='varchar2';
	/**
 	 * 注释:家庭住址
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtzz;
	 public $_jtzz_type='varchar2';
	/**
 	 * 注释:过敏史
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $gms;
	 public $_gms_type='varchar2';
	/**
 	 * 注释:既往史名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jwsmc;
	 public $_jwsmc_type='varchar2';
	/**
 	 * 注释:监护人姓名
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jhrxm;
	 public $_jhrxm_type='varchar2';
	/**
 	 * 注释:监护人有效证件类型
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $jhrzjlx;
	 public $_jhrzjlx_type='varchar2';
	/**
 	 * 注释:监护人有效证件号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jhrzjh;
	 public $_jhrzjh_type='varchar2';
	/**
 	 * 注释:联系电话
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $lxdh;
	 public $_lxdh_type='varchar2';
	/**
 	 * 注释:常住类型编码
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $czlxbm;
	 public $_czlxbm_type='varchar2';
	/**
 	 * 注释:常住类型
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $czlx;
	 public $_czlx_type='varchar2';
	/**
 	 * 注释:体检责任医师工号
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $tjysgh;
	 public $_tjysgh_type='varchar2';
	/**
 	 * 注释:体检责任医师姓名
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $tjysxm;
	 public $_tjysxm_type='varchar2';
	/**
 	 * 注释:科室编码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ksbm;
	 public $_ksbm_type='varchar2';
	/**
 	 * 注释:科室名称
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ksmc;
	 public $_ksmc_type='varchar2';
	/**
 	 * 注释:身高(CM)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sg;
	 public $_sg_type='number';
	/**
 	 * 注释:体重(KG)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tz;
	 public $_tz_type='number';
	/**
 	 * 注释:头围(CM)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tw;
	 public $_tw_type='number';
	/**
 	 * 注释:枕突
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zt;
	 public $_zt_type='varchar2';
	/**
 	 * 注释:皮肤
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pf;
	 public $_pf_type='varchar2';
	/**
 	 * 注释:皮下脂肪
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $pxzf;
	 public $_pxzf_type='varchar2';
	/**
 	 * 注释:淋巴结
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $lbj;
	 public $_lbj_type='varchar2';
	/**
 	 * 注释:头前囟
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $tql;
	 public $_tql_type='varchar2';
	/**
 	 * 注释:头部其他
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $tbqt;
	 public $_tbqt_type='varchar2';
	/**
 	 * 注释:斜视
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $xs;
	 public $_xs_type='varchar2';
	/**
 	 * 注释:沙眼
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $sy;
	 public $_sy_type='varchar2';
	/**
 	 * 注释:牙颗数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yks;
	 public $_yks_type='number';
	/**
 	 * 注释:龋齿
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $qc;
	 public $_qc_type='varchar2';
	/**
 	 * 注释:听力是否正常
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tlsfzc;
	 public $_tlsfzc_type='varchar2';
	/**
 	 * 注释:耳部其他
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ebqt;
	 public $_ebqt_type='varchar2';
	/**
 	 * 注释:牙齿其他
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ycqt;
	 public $_ycqt_type='varchar2';
	/**
 	 * 注释:鼻部
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bb;
	 public $_bb_type='varchar2';
	/**
 	 * 注释:视力左
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $slz;
	 public $_slz_type='varchar2';
	/**
 	 * 注释:实力右
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sly;
	 public $_sly_type='varchar2';
	/**
 	 * 注释:胸部其他
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xbqt;
	 public $_xbqt_type='varchar2';
	/**
 	 * 注释:鸡胸
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jx;
	 public $_jx_type='varchar2';
	/**
 	 * 注释:肋外翻
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $lwf;
	 public $_lwf_type='varchar2';
	/**
 	 * 注释:心脏
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xz;
	 public $_xz_type='varchar2';
	/**
 	 * 注释:肝脏
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $gz;
	 public $_gz_type='varchar2';
	/**
 	 * 注释:脊柱
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jzh;
	 public $_jzh_type='varchar2';
	/**
 	 * 注释:肺部
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $fb;
	 public $_fb_type='varchar2';
	/**
 	 * 注释:脾脏
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pz;
	 public $_pz_type='varchar2';
	/**
 	 * 注释:双髋外展试验
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $skwzsy;
	 public $_skwzsy_type='varchar2';
	/**
 	 * 注释:生殖器及肛门
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $szqgm;
	 public $_szqgm_type='varchar2';
	/**
 	 * 注释:O形腿
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $oxt;
	 public $_oxt_type='varchar2';
	/**
 	 * 注释:X形腿
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xxt;
	 public $_xxt_type='varchar2';
	/**
 	 * 注释:四肢有无畸形
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $szjx;
	 public $_szjx_type='varchar2';
	/**
 	 * 注释:四肢其他
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sjqt;
	 public $_sjqt_type='varchar2';
	/**
 	 * 注释:血微量元素钙
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xjca;
	 public $_xjca_type='number';
	/**
 	 * 注释:血微量元素铁
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xjfe;
	 public $_xjfe_type='number';
	/**
 	 * 注释:血微量元素锌
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xjzn;
	 public $_xjzn_type='number';
	/**
 	 * 注释:血微量元素镁
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xjcm;
	 public $_xjcm_type='number';
	/**
 	 * 注释:血微量元素铜
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xjct;
	 public $_xjct_type='number';
	/**
 	 * 注释:HB化验结果
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hbhy;
	 public $_hbhy_type='varchar2';
	/**
 	 * 注释:血铅
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $xq;
	 public $_xq_type='varchar2';
	/**
 	 * 注释:视力筛查
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $slsc;
	 public $_slsc_type='varchar2';
	/**
 	 * 注释:口腔预防
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $kqyf;
	 public $_kqyf_type='varchar2';
	/**
 	 * 注释:血细胞分析
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $xxbfx;
	 public $_xxbfx_type='varchar2';
	/**
 	 * 注释:结果评价
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $jgpj;
	 public $_jgpj_type='varchar2';
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
}
