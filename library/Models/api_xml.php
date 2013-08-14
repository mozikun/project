<?php
require_once ('db_oracle.php');
/**
 *注释:xml内容
 *
 *
 **/
class Tapi_xml extends dao_oracle{
	 public $__table = 'api_xml';
	/**
 	 * 注释:唯一id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:档案id
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $document_id;
	 public $_document_id_type='varchar2';
	/**
 	 * 注释:xml内容
	 * 
	 * 
	 * @var CLOB(4000)
	 **/
 	 public $xml_content;
	 public $_xml_content_type='clob';
}
