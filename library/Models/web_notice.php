<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tweb_notice extends dao_oracle{
	 public $__table = 'web_notice';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:通知标题
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $title;
	 public $_title_type='varchar2';
	/**
 	 * 注释:发布人
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:公告内容
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $content;
	 public $_content_type='varchar2';
	/**
 	 * 注释:发布时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:更新时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
}
