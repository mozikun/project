<?php
require_once ('db_oracle.php');
/**
 *注释:健康指导
 *
 *
 **/
class Tet_health_guidance extends dao_oracle{
	 public $__table = 'et_health_guidance';
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
 	 * 注释:健康指导|radio|1=>定期随访,2=>纳入慢性病患者健康管理,3=>建议复查,4=>建议转诊
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $health_assessment;
	 public $_health_assessment_type='varchar2';
	/**
 	 * 注释:危险因素控制|radio|1=>戒烟,2=>健康饮酒,3=>饮食,4=>锻炼,5=>减体重,6=>建议疫苗接种,7=>其它
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $risk_factor_col;
	 public $_risk_factor_col_type='varchar2';
	/**
 	 * 注释:减体重
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $lose_weight;
	 public $_lose_weight_type='varchar2';
	/**
 	 * 注释:建议疫苗接种
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $recommended_vaccination;
	 public $_recommended_vaccination_type='varchar2';
	/**
 	 * 注释:其他
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $risk_factor_col_other;
	 public $_risk_factor_col_other_type='varchar2';
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
