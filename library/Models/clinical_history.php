<?php
require_once ('db_oracle.php');
/**
 *注释:慢病史
 *
 *
 **/
class Tclinical_history extends dao_oracle{
	 public $__table = 'clinical_history';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:同个人档案的uuid关联
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $deleted;
	 public $_deleted_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $syn_flag;
	 public $_syn_flag_type='varchar2';
	/**
 	 * 注释:当前生命周期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $life_cycle;
	 public $_life_cycle_type='number';
	/**
 	 * 注释:分组标志
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $groupid;
	 public $_groupid_type='varchar2';
	/**
 	 * 注释:内部顺序
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $group_order;
	 public $_group_order_type='varchar2';
	/**
 	 * 注释:分组标志
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $groups;
	 public $_groups_type='varchar2';
	/**
 	 * 注释:慢病名称
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $disease_name;
	 public $_disease_name_type='varchar2';
	/**
 	 * 注释:是否确诊
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $disease_state;
	 public $_disease_state_type='varchar2';
	/**
 	 * 注释:慢病代码
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $disease_code;
	 public $_disease_code_type='varchar2';
	/**
 	 * 注释:确诊时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $disease_date;
	 public $_disease_date_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $filing_time;
	 public $_filing_time_type='number';
	/**
 	 * 注释:其他项填写
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $disease_comment;
	 public $_disease_comment_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
