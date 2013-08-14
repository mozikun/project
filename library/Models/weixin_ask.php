<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tweixin_ask extends dao_oracle{
	 public $__table = 'weixin_ask';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:问题
	 * 
	 * 
	 * @var VARCHAR2(500)
	 **/
 	 public $question;
	 public $_question_type='varchar2';
	/**
 	 * 注释:答案
	 * 
	 * 
	 * @var VARCHAR2(1000)
	 **/
 	 public $answer;
	 public $_answer_type='varchar2';
	/**
 	 * 注释:关键字
	 * 
	 * 
	 * @var VARCHAR2(500)
	 **/
 	 public $keywords;
	 public $_keywords_type='varchar2';
	/**
 	 * 注释:是否启用 1=>启用 2=>关闭
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $isactive;
	 public $_isactive_type='number';
	/**
 	 * 注释:是否公开 1=>公开 2=>不公开
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ispublic;
	 public $_ispublic_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $created;
	 public $_created_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $updated;
	 public $_updated_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
}
