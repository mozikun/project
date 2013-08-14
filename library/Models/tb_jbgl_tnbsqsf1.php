<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttb_jbgl_tnbsqsf1 extends dao_oracle{
	 public $__table = 'tb_jbgl_tnbsqsf1';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $sfjlid;
	 public $_sfjlid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(11)
	 **/
 	 public $yljgdm;
	 public $_yljgdm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $bgkbh;
	 public $_bgkbh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sfbh;
	 public $_sfbh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $fzlx;
	 public $_fzlx_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $sfrq;
	 public $_sfrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sffsdm;
	 public $_sffsdm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $xcsfrq;
	 public $_xcsfrq_type='date';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $zg;
	 public $_zg_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $qcdz;
	 public $_qcdz_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $sfyy;
	 public $_sfyy_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $zgqt;
	 public $_zgqt_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $blzl;
	 public $_blzl_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sfzx;
	 public $_sfzx_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $lczt;
	 public $_lczt_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $qtclxtgl;
	 public $_qtclxtgl_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $clxtgl;
	 public $_clxtgl_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jbfzns1;
	 public $_jbfzns1_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jbfzns2;
	 public $_jbfzns2_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jbfzns3;
	 public $_jbfzns3_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jbfzns4;
	 public $_jbfzns4_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns1;
	 public $_mbfzns1_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns2;
	 public $_mbfzns2_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns3;
	 public $_mbfzns3_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns4;
	 public $_mbfzns4_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns5;
	 public $_mbfzns5_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns6;
	 public $_mbfzns6_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mbfzns7;
	 public $_mbfzns7_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dbp;
	 public $_dbp_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sbp;
	 public $_sbp_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sg;
	 public $_sg_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tz;
	 public $_tz_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yw;
	 public $_yw_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tw;
	 public $_tw_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zbdmbd;
	 public $_zbdmbd_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $tzqt;
	 public $_tzqt_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $ydjc;
	 public $_ydjc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $fyzl;
	 public $_fyzl_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ywblfy;
	 public $_ywblfy_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $dxtfy;
	 public $_dxtfy_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ccsffl;
	 public $_ccsffl_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $yyzl;
	 public $_yyzl_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $mqfyywmc1;
	 public $_mqfyywmc1_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $mqfyywyf1;
	 public $_mqfyywyf1_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $mqfyywmc2;
	 public $_mqfyywmc2_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $mqfyywyf2;
	 public $_mqfyywyf2_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $mqfyywmc3;
	 public $_mqfyywmc3_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $mqfyywyf3;
	 public $_mqfyywyf3_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $qtfyywymc;
	 public $_qtfyywymc_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $qtfyywyf;
	 public $_qtfyywyf_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $yds;
	 public $_yds_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $yyzlqt;
	 public $_yyzlqt_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $xxstyhd;
	 public $_xxstyhd_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $xxstyhdsj;
	 public $_xxstyhdsj_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yl;
	 public $_yl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jl;
	 public $_jl_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(256)
	 **/
 	 public $ydfssm;
	 public $_ydfssm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $ydpllb;
	 public $_ydpllb_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ydsj;
	 public $_ydsj_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $jcydsc;
	 public $_jcydsc_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zydcs;
	 public $_zydcs_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jszk;
	 public $_jszk_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $yszk;
	 public $_yszk_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $zsqk;
	 public $_zsqk_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xltz;
	 public $_xltz_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $zyxwjg;
	 public $_zyxwjg_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $kfxtz;
	 public $_kfxtz_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sjxtz;
	 public $_sjxtz_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zdgc;
	 public $_zdgc_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hdlc;
	 public $_hdlc_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ldlc;
	 public $_ldlc_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $gysz;
	 public $_gysz_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $wndb;
	 public $_wndb_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $thxhdb;
	 public $_thxhdb_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $fzjcrq;
	 public $_fzjcrq_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $fzjcms;
	 public $_fzjcms_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $zlfy;
	 public $_zlfy_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $tnbhdcs;
	 public $_tnbhdcs_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $sfjy;
	 public $_sfjy_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(512)
	 **/
 	 public $zzyx;
	 public $_zzyx_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $zzjg;
	 public $_zzjg_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $djrygh;
	 public $_djrygh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $djryxm;
	 public $_djryxm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ysqm;
	 public $_ysqm_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $sfysgh;
	 public $_sfysgh_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl1;
	 public $_ylyl1_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $ylyl2;
	 public $_ylyl2_type='varchar2';
}
