<?php
require_once ('db_oracle.php');
/**
 *注释:学生成绩表2
 *
 *
 **/
class Tscore2 extends dao_oracle{
	 public $__table = 'score2';
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
	 * @var CHAR(10)
	 **/
 	 public $id;
	 public $_id_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(10)
	 **/
 	 public $course;
	 public $_course_type='char';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $score;
	 public $_score_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var CHAR(10)
	 **/
 	 public $teacher_id;
	 public $_teacher_id_type='char';
}
