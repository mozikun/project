<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tmenu extends dao_oracle{
	 public $__table = 'menu';
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
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $inner_order;
	 public $_inner_order_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(13)
	 **/
 	 public $parent_id;
	 public $_parent_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $description;
	 public $_description_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $property;
	 public $_property_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $action;
	 public $_action_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(255)
	 **/
 	 public $path;
	 public $_path_type='varchar2';
}
