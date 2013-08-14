<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tdocument_dest extends dao_oracle{
	 public $__table = 'document_dest';
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
	 * @var VARCHAR2(30)
	 **/
 	 public $doc_id;
	 public $_doc_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $region_path;
	 public $_region_path_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $org_id;
	 public $_org_id_type='number';
}
