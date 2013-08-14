<?php
require_once ('db_oracle.php');
/**
 *注释:6岁—65岁人群健康体检表
 *
 *
 **/
class Ttb_jktj_sixrqjktj extends dao_oracle{
	 public $__table = 'tb_jktj_sixrqjktj';
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
 	 * 注释:民族编码
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $mzbm;
	 public $_mzbm_type='varchar2';
	/**
 	 * 注释:民族名称
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $mzmc;
	 public $_mzmc_type='varchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $csrq;
	 public $_csrq_type='date';
	/**
 	 * 注释:身份证号
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $sfzh;
	 public $_sfzh_type='varchar2';
	/**
 	 * 注释:工作单位
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $gzdw;
	 public $_gzdw_type='varchar2';
	/**
 	 * 注释:本人电话
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $brdh;
	 public $_brdh_type='varchar2';
	/**
 	 * 注释:联系人姓名
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $lxrxm;
	 public $_lxrxm_type='varchar2';
	/**
 	 * 注释:联系人电话
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $lxrdh;
	 public $_lxrdh_type='varchar2';
	/**
 	 * 注释:家庭住址
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtzz;
	 public $_jtzz_type='varchar2';
	/**
 	 * 注释:常住类型编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $czlxbm;
	 public $_czlxbm_type='char';
	/**
 	 * 注释:常住类型名称
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $czlxmc;
	 public $_czlxmc_type='varchar2';
	/**
 	 * 注释:血型编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xxbm;
	 public $_xxbm_type='char';
	/**
 	 * 注释:血型名称
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $xxmc;
	 public $_xxmc_type='varchar2';
	/**
 	 * 注释:RH阴性
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $rhyx;
	 public $_rhyx_type='char';
	/**
 	 * 注释:过敏史
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $gms;
	 public $_gms_type='varchar2';
	/**
 	 * 注释:既往史编码
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jwsbm;
	 public $_jwsbm_type='varchar2';
	/**
 	 * 注释:既往史名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jwsmc;
	 public $_jwsmc_type='varchar2';
	/**
 	 * 注释:症状编码
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $zzbm;
	 public $_zzbm_type='varchar2';
	/**
 	 * 注释:症状名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zzmc;
	 public $_zzmc_type='varchar2';
	/**
 	 * 注释:体温
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $tw;
	 public $_tw_type='varchar2';
	/**
 	 * 注释:脉率
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ml;
	 public $_ml_type='varchar2';
	/**
 	 * 注释:呼吸频率
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hxpl;
	 public $_hxpl_type='varchar2';
	/**
 	 * 注释:血压左侧
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $xyzc;
	 public $_xyzc_type='varchar2';
	/**
 	 * 注释:血压右侧
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $xyyc;
	 public $_xyyc_type='varchar2';
	/**
 	 * 注释:身高
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $sg;
	 public $_sg_type='number';
	/**
 	 * 注释:体重
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tz;
	 public $_tz_type='number';
	/**
 	 * 注释:体重指数
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $tzzs;
	 public $_tzzs_type='varchar2';
	/**
 	 * 注释:腰围
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $yw;
	 public $_yw_type='number';
	/**
 	 * 注释:臀围
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $twqk;
	 public $_twqk_type='number';
	/**
 	 * 注释:腰臀比
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ytb;
	 public $_ytb_type='varchar2';
	/**
 	 * 注释:锻炼频率
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $dlpl;
	 public $_dlpl_type='varchar2';
	/**
 	 * 注释:每次锻炼时间
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $mcdlsj;
	 public $_mcdlsj_type='varchar2';
	/**
 	 * 注释:坚持锻炼时间
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $jcdlsj;
	 public $_jcdlsj_type='varchar2';
	/**
 	 * 注释:锻炼方式
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $dlfs;
	 public $_dlfs_type='varchar2';
	/**
 	 * 注释:饮食习惯
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ysxg;
	 public $_ysxg_type='varchar2';
	/**
 	 * 注释:吸烟情况
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $xyqk;
	 public $_xyqk_type='varchar2';
	/**
 	 * 注释:日吸烟量
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $rxyl;
	 public $_rxyl_type='varchar2';
	/**
 	 * 注释:开始吸烟年龄
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ksxynl;
	 public $_ksxynl_type='varchar2';
	/**
 	 * 注释:戒烟年龄
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $jynl;
	 public $_jynl_type='varchar2';
	/**
 	 * 注释:日饮酒量
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ryjl;
	 public $_ryjl_type='varchar2';
	/**
 	 * 注释:是否戒酒
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $sfjj;
	 public $_sfjj_type='char';
	/**
 	 * 注释:戒酒年龄
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $jjnl;
	 public $_jjnl_type='varchar2';
	/**
 	 * 注释:左眼视力
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zysl;
	 public $_zysl_type='varchar2';
	/**
 	 * 注释:右眼视力
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $yysl;
	 public $_yysl_type='varchar2';
	/**
 	 * 注释:左眼矫正视力
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zyjzsl;
	 public $_zyjzsl_type='varchar2';
	/**
 	 * 注释:右眼矫正视力
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $yyjzsl;
	 public $_yyjzsl_type='varchar2';
	/**
 	 * 注释:听力
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $tl;
	 public $_tl_type='varchar2';
	/**
 	 * 注释:运动功能
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ydgn;
	 public $_ydgn_type='varchar2';
	/**
 	 * 注释:皮肤
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pp;
	 public $_pp_type='varchar2';
	/**
 	 * 注释:巩 膜
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $gm;
	 public $_gm_type='varchar2';
	/**
 	 * 注释:淋巴结
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $lbj;
	 public $_lbj_type='varchar2';
	/**
 	 * 注释:桶状胸
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tzx;
	 public $_tzx_type='varchar2';
	/**
 	 * 注释:呼吸音
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $hxy;
	 public $_hxy_type='varchar2';
	/**
 	 * 注释:罗音
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ly;
	 public $_ly_type='varchar2';
	/**
 	 * 注释:心率
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xz;
	 public $_xz_type='varchar2';
	/**
 	 * 注释:心律
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $xl;
	 public $_xl_type='varchar2';
	/**
 	 * 注释:杂音
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $zy;
	 public $_zy_type='varchar2';
	/**
 	 * 注释:压痛
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $yt;
	 public $_yt_type='varchar2';
	/**
 	 * 注释:包块
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $bk;
	 public $_bk_type='varchar2';
	/**
 	 * 注释:肝大
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $gd;
	 public $_gd_type='varchar2';
	/**
 	 * 注释:脾大
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $pd;
	 public $_pd_type='varchar2';
	/**
 	 * 注释:移动性浊音
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ydxzy;
	 public $_ydxzy_type='varchar2';
	/**
 	 * 注释:脊柱
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $jz;
	 public $_jz_type='varchar2';
	/**
 	 * 注释:足背动脉搏动
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zbdmbd;
	 public $_zbdmbd_type='varchar2';
	/**
 	 * 注释:空腹血糖
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $kfxt;
	 public $_kfxt_type='varchar2';
	/**
 	 * 注释:随机血糖
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sjxt;
	 public $_sjxt_type='varchar2';
	/**
 	 * 注释:血常规
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $xcg;
	 public $_xcg_type='varchar2';
	/**
 	 * 注释:尿常规
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ncg;
	 public $_ncg_type='varchar2';
	/**
 	 * 注释:腹部黑白B超
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $fbhbbc;
	 public $_fbhbbc_type='varchar2';
	/**
 	 * 注释:多道联心电图
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ddlxdt;
	 public $_ddlxdt_type='varchar2';
	/**
 	 * 注释:眼底检查
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ydjc;
	 public $_ydjc_type='varchar2';
	/**
 	 * 注释:血脂检查
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $xzjc;
	 public $_xzjc_type='varchar2';
	/**
 	 * 注释:肝功
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $gg;
	 public $_gg_type='varchar2';
	/**
 	 * 注释:肾功
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $sgn;
	 public $_sgn_type='varchar2';
	/**
 	 * 注释:血尿酸
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $xns;
	 public $_xns_type='varchar2';
	/**
 	 * 注释:B超（肝胆胰腺）
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $bc1;
	 public $_bc1_type='varchar2';
	/**
 	 * 注释:B超（双肾、输尿管、膀胱）
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $bc2;
	 public $_bc2_type='varchar2';
	/**
 	 * 注释:子宫、附件
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $bc3;
	 public $_bc3_type='varchar2';
	/**
 	 * 注释:电解质
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $djz;
	 public $_djz_type='varchar2';
	/**
 	 * 注释:胸部X线片
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $xbxp;
	 public $_xbxp_type='varchar2';
	/**
 	 * 注释:两对半检查
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ldbjc;
	 public $_ldbjc_type='varchar2';
	/**
 	 * 注释:转氨酶检查
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $zamjc;
	 public $_zamjc_type='varchar2';
	/**
 	 * 注释:其他检查
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $qtjc;
	 public $_qtjc_type='varchar2';
	/**
 	 * 注释:健康评价
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtpj;
	 public $_jtpj_type='varchar2';
	/**
 	 * 注释:健康评价异常1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtpjyc1;
	 public $_jtpjyc1_type='varchar2';
	/**
 	 * 注释:健康评价异常2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtpjyc2;
	 public $_jtpjyc2_type='varchar2';
	/**
 	 * 注释:健康评价异常3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtpjyc3;
	 public $_jtpjyc3_type='varchar2';
	/**
 	 * 注释:健康评价异常4
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtpjyc4;
	 public $_jtpjyc4_type='varchar2';
	/**
 	 * 注释:健康评价异常5
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtpjyc5;
	 public $_jtpjyc5_type='varchar2';
	/**
 	 * 注释:健康评价异常6
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jtpjyc6;
	 public $_jtpjyc6_type='varchar2';
	/**
 	 * 注释:健康指导
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $jkzd;
	 public $_jkzd_type='varchar2';
	/**
 	 * 注释:危险因素控制
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $wxyskz;
	 public $_wxyskz_type='varchar2';
	/**
 	 * 注释:体检日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tjrq;
	 public $_tjrq_type='date';
	/**
 	 * 注释:体检医生
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tjys;
	 public $_tjys_type='varchar2';
	/**
 	 * 注释:体检医生工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tjysgh;
	 public $_tjysgh_type='varchar2';
	/**
 	 * 注释:修改标志
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $xgbz;
	 public $_xgbz_type='varchar2';
	/**
 	 * 注释:密级
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mj;
	 public $_mj_type='varchar2';
}
