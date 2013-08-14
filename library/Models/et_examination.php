<?php
require_once ('db_oracle.php');
/**
 *注释:现存主要健康问题
 *
 *
 **/
class Tet_examination extends dao_oracle{
	 public $__table = 'et_examination';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:医生档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:个人档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:添加记录时间
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $created;
	 public $_created_type='varchar2';
	/**
 	 * 注释:健康体检id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $examination_id;
	 public $_examination_id_type='varchar2';
	/**
 	 * 注释:空腹血糖1
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $fbglucoseh;
	 public $_fbglucoseh_type='varchar2';
	/**
 	 * 注释:空腹血糖2
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $fbglucosee;
	 public $_fbglucosee_type='varchar2';
	/**
 	 * 注释:血常规血红蛋白
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $hemoglobin;
	 public $_hemoglobin_type='varchar2';
	/**
 	 * 注释:血常规白细胞
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $leukocyte;
	 public $_leukocyte_type='varchar2';
	/**
 	 * 注释:血常规血小板
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $platelet;
	 public $_platelet_type='varchar2';
	/**
 	 * 注释:血常规其他
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $b_other;
	 public $_b_other_type='varchar2';
	/**
 	 * 注释:尿常规尿蛋白
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $u_protein;
	 public $_u_protein_type='varchar2';
	/**
 	 * 注释:尿常规尿糖
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $urine;
	 public $_urine_type='varchar2';
	/**
 	 * 注释:尿常规尿酮体
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ketone;
	 public $_ketone_type='varchar2';
	/**
 	 * 注释:尿常规尿潜血
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $uoblood;
	 public $_uoblood_type='varchar2';
	/**
 	 * 注释:尿常规其他
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $u_other;
	 public $_u_other_type='varchar2';
	/**
 	 * 注释:尿微量白蛋白
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $microurine;
	 public $_microurine_type='varchar2';
	/**
 	 * 注释:大便潜血|radio|1=>阴性|2=>阳性
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $fecalblood;
	 public $_fecalblood_type='varchar2';
	/**
 	 * 注释:肝功能血清谷丙转氨酶
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $alanine;
	 public $_alanine_type='varchar2';
	/**
 	 * 注释:肝功能血清谷丙转草氨酶
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $serum;
	 public $_serum_type='varchar2';
	/**
 	 * 注释:肝功能白蛋白
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $albumin;
	 public $_albumin_type='varchar2';
	/**
 	 * 注释:肝功能总胆红素
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $tbilirubin;
	 public $_tbilirubin_type='varchar2';
	/**
 	 * 注释:肝功能结合总胆红素
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $bilirubin;
	 public $_bilirubin_type='varchar2';
	/**
 	 * 注释:肾功能血清肌酐
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $screatinine;
	 public $_screatinine_type='varchar2';
	/**
 	 * 注释:肾功能血清肌酐
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $bun;
	 public $_bun_type='varchar2';
	/**
 	 * 注释:肾功能血钾浓度
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $serumpc;
	 public $_serumpc_type='varchar2';
	/**
 	 * 注释:肾功能血钠浓度
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $sodium;
	 public $_sodium_type='varchar2';
	/**
 	 * 注释:血脂总胆固醇
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $tcholesterol;
	 public $_tcholesterol_type='varchar2';
	/**
 	 * 注释:血脂甘油三脂
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $triglyceride;
	 public $_triglyceride_type='varchar2';
	/**
 	 * 注释:血脂血清低密度脂蛋白胆固醇
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $lowcholesterol;
	 public $_lowcholesterol_type='varchar2';
	/**
 	 * 注释:血脂血清高密度脂蛋白胆固醇
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $highcholesterol;
	 public $_highcholesterol_type='varchar2';
	/**
 	 * 注释:糖化血红蛋白
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ghemoglobin;
	 public $_ghemoglobin_type='varchar2';
	/**
 	 * 注释:乙型肝炎表面抗原|radio|1=>阳性|2=>阴性
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $hbsurface;
	 public $_hbsurface_type='varchar2';
	/**
 	 * 注释:眼底|radio|1=>正常|2=>异常
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $fundus;
	 public $_fundus_type='varchar2';
	/**
 	 * 注释:眼底异常名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $veryfundus;
	 public $_veryfundus_type='varchar2';
	/**
 	 * 注释:心电图|radio|1=>正常|2=>异常
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $ecg;
	 public $_ecg_type='varchar2';
	/**
 	 * 注释:心电图异常名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $veryecg;
	 public $_veryecg_type='varchar2';
	/**
 	 * 注释:胸部x线片|radio|1=>正常|2=>异常
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $xrayfilm;
	 public $_xrayfilm_type='varchar2';
	/**
 	 * 注释:胸部x线片异常 名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $veryxrayfilm;
	 public $_veryxrayfilm_type='varchar2';
	/**
 	 * 注释:B超|radio|1=>正常|2=>异常
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $bc;
	 public $_bc_type='varchar2';
	/**
 	 * 注释:B超x线片异常名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $verybc;
	 public $_verybc_type='varchar2';
	/**
 	 * 注释:宫颈涂片|radio|1=>正常|2=>异常
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $csmear;
	 public $_csmear_type='varchar2';
	/**
 	 * 注释:宫颈涂片异常名称
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $verycsmear;
	 public $_verycsmear_type='varchar2';
	/**
 	 * 注释:其它|text
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $examination_other;
	 public $_examination_other_type='varchar2';
	/**
 	 * 注释:档案完整率
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $criteria_rate;
	 public $_criteria_rate_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
}
