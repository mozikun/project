<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tiha_view extends dao_oracle{
	 public $__table = 'iha_view';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $a_uuid;
	 public $_a_uuid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $a_name;
	 public $_a_name_type='varchar2';
}
