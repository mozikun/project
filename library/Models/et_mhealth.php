<?php
require_once ('db_oracle.php');
/**
 *注释:现存主要健康问题
 *
 *
 **/
class Tet_mhealth extends dao_oracle{
	 public $__table = 'et_mhealth';
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
 	 * 注释:脑血管疾病
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ceredisease;
	 public $_ceredisease_type='varchar2';
	/**
 	 * 注释:脑血管疾病状态|checkbox|1=>未发现|2=>缺血性卒中|3=>脑出血|4=>蛛网膜下腔出血|5=>短暂性脑缺血|6=>其他
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $ceredisease_status;
	 public $_ceredisease_status_type='varchar2';
	/**
 	 * 注释:其他脑血管疾病中文含义
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ceredisease_other;
	 public $_ceredisease_other_type='varchar2';
	/**
 	 * 注释:肾脏疾病
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $kidneydisease;
	 public $_kidneydisease_type='varchar2';
	/**
 	 * 注释:肾脏疾病状态|checkbox|1=>未发现|2=>糖尿病肾病|3=>肾功能衰竭|4=>急性肾炎|5=>慢性肾炎|6=>其他
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $kidneydisease_status;
	 public $_kidneydisease_status_type='varchar2';
	/**
 	 * 注释:其他肾脏疾病中文含义
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $kidneydisease_other;
	 public $_kidneydisease_other_type='varchar2';
	/**
 	 * 注释:心脏疾病
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $heartdisease;
	 public $_heartdisease_type='varchar2';
	/**
 	 * 注释:心脏疾病状态|checkbox|1=>未发现|2=>心肌梗死|3=>心绞痛|4=>冠状动脉血运重建|5=>充血性心力衰竭|6=>心前区疼痛|7=>其他
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $heartdisease_status;
	 public $_heartdisease_status_type='varchar2';
	/**
 	 * 注释:其他心脏疾病中文含义
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $heartdisease_other;
	 public $_heartdisease_other_type='varchar2';
	/**
 	 * 注释:血管疾病
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $vasculardisease;
	 public $_vasculardisease_type='varchar2';
	/**
 	 * 注释:血管疾病状态|checkbox|1=>未发现|2=>夹层动脉瘤|3=>动脉闭塞性疾病|4=>其他
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $vasculardisease_status;
	 public $_vasculardisease_status_type='varchar2';
	/**
 	 * 注释:其他血管疾病中文含义
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $vasculardisease_other;
	 public $_vasculardisease_other_type='varchar2';
	/**
 	 * 注释:眼部疾病
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $eyedisease;
	 public $_eyedisease_type='varchar2';
	/**
 	 * 注释:眼部疾病状态|checkbox|1=>未发现|2=>视网膜出血或渗出|3=>视乳头水肿|4=>白内障|5=>其他
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $eyedisease_status;
	 public $_eyedisease_status_type='varchar2';
	/**
 	 * 注释:其他眼部疾病中文含义
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $eyedisease_other;
	 public $_eyedisease_other_type='varchar2';
	/**
 	 * 注释:神经系统疾病
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $nervousdisease;
	 public $_nervousdisease_type='varchar2';
	/**
 	 * 注释:神经系统疾病状态|checkbox|1=>未发现|2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $nervousdisease_status;
	 public $_nervousdisease_status_type='varchar2';
	/**
 	 * 注释:有的神经系统疾病中文含义
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $nervousdisease_other;
	 public $_nervousdisease_other_type='varchar2';
	/**
 	 * 注释:其他系统疾病
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $otherdisease;
	 public $_otherdisease_type='varchar2';
	/**
 	 * 注释:其他系统疾病状态|checkbox|1=>未发现|2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $otherdisease_status;
	 public $_otherdisease_status_type='varchar2';
	/**
 	 * 注释:有的其他系统疾病中文含义
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $otherdisease_other;
	 public $_otherdisease_other_type='varchar2';
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
