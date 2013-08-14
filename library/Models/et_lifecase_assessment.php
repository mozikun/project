<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tet_lifecase_assessment extends dao_oracle{
	 public $__table = 'et_lifecase_assessment';
	/**
 	 * 注释:进餐评估得分
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $meal;
	 public $_meal_type='varchar2';
	/**
 	 * 注释:梳洗评估得分
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $cleanup;
	 public $_cleanup_type='varchar2';
	/**
 	 * 注释:穿衣评估得分
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $dress;
	 public $_dress_type='varchar2';
	/**
 	 * 注释:如厕评估得分
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $toilet;
	 public $_toilet_type='varchar2';
	/**
 	 * 注释:活动评估得分
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $activity;
	 public $_activity_type='varchar2';
	/**
 	 * 注释:评估总分
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $totalscore;
	 public $_totalscore_type='varchar2';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
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
