<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tdepartment_doctor extends dao_oracle{
	 public $__table = 'department_doctor';
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
 	 public $department_id;
	 public $_department_id_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $doctor_id;
	 public $_doctor_id_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $default;
	 public $_default_type='number';
}
