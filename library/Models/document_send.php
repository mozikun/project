<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tdocument_send extends dao_oracle{
	 public $__table = 'document_send';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $id;
	 public $_id_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $org_id;
	 public $_org_id_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $send_date;
	 public $_send_date_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $doc_title;
	 public $_doc_title_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $doc_encode_name;
	 public $_doc_encode_name_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $doc_name;
	 public $_doc_name_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $down_load_time;
	 public $_down_load_time_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $down_load_org;
	 public $_down_load_org_type='varchar2';
}
