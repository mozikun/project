<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tweixin_notice extends dao_oracle{
	 public $__table = 'weixin_notice';
	/**
 	 * 注释:系统唯一标示符
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:标题
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $title;
	 public $_title_type='varchar2';
	/**
 	 * 注释:内容
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $content;
	 public $_content_type='varchar2';
	/**
 	 * 注释:机构id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:建档人
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:创建时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $create_time;
	 public $_create_time_type='number';
}
