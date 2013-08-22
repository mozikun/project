<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tanswer extends dao_oracle{
	 public $__table = 'answer';
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
	 * @var VARCHAR2(1000)
	 **/
 	 public $answer;
	 public $_answer_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $time;
	 public $_time_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $question_id;
	 public $_question_id_type='varchar2';
}
