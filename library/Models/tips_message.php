<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Ttips_message extends dao_oracle{
	 public $__table = 'tips_message';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var VARCHAR2(128)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:发送时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:内容
	 * 
	 * 
	 * @var VARCHAR2(500)
	 **/
 	 public $content;
	 public $_content_type='varchar2';
	/**
 	 * 注释:接收短信者
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:手机号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $phone;
	 public $_phone_type='number';
	/**
 	 * 注释:工作计划id
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $tips_id;
	 public $_tips_id_type='varchar2';
	/**
 	 * 注释:计划执行者
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:发短信的机构-方便统计
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:模块类别-便于统计
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $tips_type;
	 public $_tips_type_type='varchar2';
}
