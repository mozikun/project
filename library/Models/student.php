<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tstudent extends dao_oracle{
	 public $__table = 'student';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $create_time;
	 public $_create_time_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $update_time;
	 public $_update_time_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $operator;
	 public $_operator_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(30)
	 **/
 	 public $id;
	 public $_id_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(10)
	 **/
 	 public $name;
	 public $_name_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(2)
	 **/
 	 public $gender;
	 public $_gender_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $birthday;
	 public $_birthday_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(10)
	 **/
 	 public $class;
	 public $_class_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(120)
	 **/
 	 public $address;
	 public $_address_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(10)
	 **/
 	 public $password;
	 public $_password_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(10)
	 **/
 	 public $hometown;
	 public $_hometown_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(20)
	 **/
 	 public $preference;
	 public $_preference_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(20)
	 **/
 	 public $introduce;
	 public $_introduce_type='char';
}
