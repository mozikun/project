<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tchat extends dao_oracle{
	 public $__table = 'chat';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $sender;
	 public $_sender_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $receiver;
	 public $_receiver_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $sendtime;
	 public $_sendtime_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(1000)
	 **/
 	 public $content;
	 public $_content_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $r_flag;
	 public $_r_flag_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $s_flag;
	 public $_s_flag_type='varchar2';
}
