<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tfamily_history extends dao_oracle{
	 public $__table = 'family_history';
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
 	 * 注释:
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
 	 * 注释:与本人关系，如父亲、母亲等
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $relationship;
	 public $_relationship_type='varchar2';
	/**
 	 * 注释:慢病代码
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $disease_code;
	 public $_disease_code_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $filing_time;
	 public $_filing_time_type='number';
	/**
 	 * 注释:用于存储其他项的文字说明
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $family_comment;
	 public $_family_comment_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
