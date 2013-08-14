<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tmult extends dao_oracle{
	 public $__table = 'mult';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $name;
	 public $_name_type='varchar2';
}
