<?php
require_once ('db_oracle.php');
/**
 *注释:65岁以上老年人健康体检表
 *
 *
 **/
class Ttb_jktj_lnrjktj extends dao_oracle{
	 public $__table = 'tb_jktj_lnrjktj';
	/**
 	 * 注释:体检ID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $tjid;
	 public $_tjid_type='varchar2';
	/**
 	 * 注释:医疗机构代码
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
 	 * 注释:家庭住址
	 * 
	 * 
	 * @var VARCHAR2(120)
	 **/
 	 public $jtzz;
	 public $_jtzz_type='varchar2';
	/**
 	 * 注释:体检日期
	 * 
	 * 
	 * @var DATE(7)
	 **/
 	 public $tjrq;
	 public $_tjrq_type='date';
	/**
 	 * 注释:检查医生工号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tjysgh;
	 public $_tjysgh_type='varchar2';
	/**
 	 * 注释:检查医生姓名
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $jcysxm;
	 public $_jcysxm_type='varchar2';
	/**
 	 * 注释:姓名
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xm;
	 public $_xm_type='varchar2';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $bh;
	 public $_bh_type='varchar2';
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
	 * @var CHAR(1)
	 **/
 	 public $xbbm;
	 public $_xbbm_type='char';
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
	 * @var VARCHAR2(100)
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
 	 * 注释:常住类型
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $czlx;
	 public $_czlx_type='char';
	/**
 	 * 注释:民族
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $mz;
	 public $_mz_type='varchar2';
	/**
 	 * 注释:血型名称
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $xxmc;
	 public $_xxmc_type='varchar2';
	/**
 	 * 注释:血型编码
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xxbm;
	 public $_xxbm_type='char';
	/**
 	 * 注释:RH阴性
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $rhyx;
	 public $_rhyx_type='char';
	/**
 	 * 注释:过 敏 史
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $gms;
	 public $_gms_type='varchar2';
	/**
 	 * 注释:既 往 史
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $jws;
	 public $_jws_type='varchar2';
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
 	 public $tzmc;
	 public $_tzmc_type='varchar2';
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
 	 * 注释:左侧血压
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zcxy;
	 public $_zcxy_type='varchar2';
	/**
 	 * 注释:右侧血压
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ycxy;
	 public $_ycxy_type='varchar2';
	/**
 	 * 注释:左侧收缩压
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zcssxy;
	 public $_zcssxy_type='varchar2';
	/**
 	 * 注释:左侧舒展压
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $zcszxy;
	 public $_zcszxy_type='varchar2';
	/**
 	 * 注释:右侧收缩血压
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ycssxy;
	 public $_ycssxy_type='varchar2';
	/**
 	 * 注释:右侧舒展压
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ycszy;
	 public $_ycszy_type='varchar2';
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
 	 * 注释:腰围
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $yw;
	 public $_yw_type='varchar2';
	/**
 	 * 注释:体重指数
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $tzzs;
	 public $_tzzs_type='varchar2';
	/**
 	 * 注释:臀围
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $tws;
	 public $_tws_type='varchar2';
	/**
 	 * 注释:腰臀围比值
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ytwbz;
	 public $_ytwbz_type='varchar2';
	/**
 	 * 注释:老年人认知功能
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $lnrrzgn;
	 public $_lnrrzgn_type='varchar2';
	/**
 	 * 注释:简易智力状态检查总分
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $jyzlztjczf;
	 public $_jyzlztjczf_type='varchar2';
	/**
 	 * 注释:老年人情感状态
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $lnrqgzt;
	 public $_lnrqgzt_type='varchar2';
	/**
 	 * 注释:下肢水肿
	 * 
	 * 
	 * @var CHAR(1)
	 **/
 	 public $xzsz;
	 public $_xzsz_type='char';
	/**
 	 * 注释:老年人抑郁评分检查总分
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $lnryypfjczf;
	 public $_lnryypfjczf_type='varchar2';
	/**
 	 * 注释:体育锻炼频率
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tydlpl;
	 public $_tydlpl_type='varchar2';
	/**
 	 * 注释:每次锻炼时间
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $mcdlsj;
	 public $_mcdlsj_type='varchar2';
	/**
 	 * 注释:坚持锻炼时间
	 * 
	 * 
	 * @var VARCHAR2(2)
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
 	 * 注释:吸烟状况
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xyzk;
	 public $_xyzk_type='varchar2';
	/**
 	 * 注释:平均日吸烟量
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $pjrxyl;
	 public $_pjrxyl_type='varchar2';
	/**
 	 * 注释:开始吸烟年龄
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $ksxynl;
	 public $_ksxynl_type='varchar2';
	/**
 	 * 注释:戒烟年龄
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $jynl;
	 public $_jynl_type='varchar2';
	/**
 	 * 注释:饮酒频率
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $yjpl;
	 public $_yjpl_type='varchar2';
	/**
 	 * 注释:平均日饮酒量
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $pjryjl;
	 public $_pjryjl_type='varchar2';
	/**
 	 * 注释:是否戒酒
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $sfjj;
	 public $_sfjj_type='varchar2';
	/**
 	 * 注释:戒酒年龄
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $jjnl;
	 public $_jjnl_type='varchar2';
	/**
 	 * 注释:开始饮酒年龄
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $ksyjnl;
	 public $_ksyjnl_type='varchar2';
	/**
 	 * 注释:一年内是否曾醉酒
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ynnsfczj;
	 public $_ynnsfczj_type='varchar2';
	/**
 	 * 注释:饮酒种类
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $yjzl;
	 public $_yjzl_type='varchar2';
	/**
 	 * 注释:视力左眼
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $slzy;
	 public $_slzy_type='varchar2';
	/**
 	 * 注释:视力右眼
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $slyy;
	 public $_slyy_type='varchar2';
	/**
 	 * 注释:矫正视力左眼
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $jzslzy;
	 public $_jzslzy_type='varchar2';
	/**
 	 * 注释:矫正视力右眼
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $jzslyy;
	 public $_jzslyy_type='varchar2';
	/**
 	 * 注释:听力
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $tl;
	 public $_tl_type='varchar2';
	/**
 	 * 注释:运动功能
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ydgn;
	 public $_ydgn_type='varchar2';
	/**
 	 * 注释:皮 肤
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $pf;
	 public $_pf_type='varchar2';
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
 	 * 注释:肺桶状胸
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $ftzx;
	 public $_ftzx_type='varchar2';
	/**
 	 * 注释:预留二
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $fhxy;
	 public $_fhxy_type='varchar2';
	/**
 	 * 注释:肺罗音
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $fly;
	 public $_fly_type='varchar2';
	/**
 	 * 注释:心脏心率
	 * 
	 * 
	 * @var VARCHAR2(5)
	 **/
 	 public $xzxl;
	 public $_xzxl_type='varchar2';
	/**
 	 * 注释:心脏心律
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xzxls;
	 public $_xzxls_type='varchar2';
	/**
 	 * 注释:心脏杂音
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $xzzy;
	 public $_xzzy_type='varchar2';
	/**
 	 * 注释:腹部压痛
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $fbyt;
	 public $_fbyt_type='varchar2';
	/**
 	 * 注释:腹部包块
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $fbbk;
	 public $_fbbk_type='varchar2';
	/**
 	 * 注释:腹部肝大
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $fbgd;
	 public $_fbgd_type='varchar2';
	/**
 	 * 注释:腹部脾大
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $fbpd;
	 public $_fbpd_type='varchar2';
	/**
 	 * 注释:腹部移动性浊音
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $fbydxzy;
	 public $_fbydxzy_type='varchar2';
	/**
 	 * 注释:足背动脉搏动
	 * 
	 * 
	 * @var VARCHAR2(30)
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
 	 * 注释:多道联心电图
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $ddlxdt;
	 public $_ddlxdt_type='varchar2';
	/**
 	 * 注释:腹部黑白B超
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $fbhbbc;
	 public $_fbhbbc_type='varchar2';
	/**
 	 * 注释:眼底检查
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $ydjc;
	 public $_ydjc_type='varchar2';
	/**
 	 * 注释:血脂检查
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $xzjc;
	 public $_xzjc_type='varchar2';
	/**
 	 * 注释:血常规
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $xcg;
	 public $_xcg_type='varchar2';
	/**
 	 * 注释:尿常规
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $ncg;
	 public $_ncg_type='varchar2';
	/**
 	 * 注释:肝功
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $gg;
	 public $_gg_type='varchar2';
	/**
 	 * 注释:血尿酸
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $xns;
	 public $_xns_type='varchar2';
	/**
 	 * 注释:B超（肝、胆、胰）
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $bc1;
	 public $_bc1_type='varchar2';
	/**
 	 * 注释:B超（双肾、输尿管、膀胱）
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $bc2;
	 public $_bc2_type='varchar2';
	/**
 	 * 注释:子宫、附件
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $bc3;
	 public $_bc3_type='varchar2';
	/**
 	 * 注释:心电图
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $xdt;
	 public $_xdt_type='varchar2';
	/**
 	 * 注释:空腹血糖（套餐）
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $kfxttc;
	 public $_kfxttc_type='varchar2';
	/**
 	 * 注释:电解质
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $djz;
	 public $_djz_type='varchar2';
	/**
 	 * 注释:胸部X线片
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $xbxxp;
	 public $_xbxxp_type='varchar2';
	/**
 	 * 注释:其他检查
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $qtjc;
	 public $_qtjc_type='varchar2';
	/**
 	 * 注释:健康评价
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $jkpj;
	 public $_jkpj_type='varchar2';
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
	 * @var VARCHAR2(300)
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
