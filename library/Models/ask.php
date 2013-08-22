<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Task extends dao_oracle{
	 public $__table = 'ask';
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
	 * @var VARCHAR2(30)
	 **/
 	 public $author;
	 public $_author_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $question;
	 public $_question_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $time;
	 public $_time_type='number';
}
