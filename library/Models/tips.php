<?php
require_once ('db_oracle.php');
/**
 *注释:工作计划
 *
 *
 **/
class Ttips extends dao_oracle{
	 public $__table = 'tips';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:医生档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:个人档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:添加记录时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:提醒标题
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $title;
	 public $_title_type='varchar2';
	/**
 	 * 注释:提醒类型
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $tips_type;
	 public $_tips_type_type='varchar2';
	/**
 	 * 注释:计划处理时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tips_time;
	 public $_tips_time_type='number';
	/**
 	 * 注释:计划完成时间|text
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $tips_complete_time;
	 public $_tips_complete_time_type='number';
	/**
 	 * 注释:计划执行者|text
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $tips_complete_person;
	 public $_tips_complete_person_type='varchar2';
	/**
 	 * 注释:查看地址|text
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $tips_url;
	 public $_tips_url_type='varchar2';
	/**
 	 * 注释:提醒状态|select|0=>未完成,1=>完成,2=>取消
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $state;
	 public $_state_type='varchar2';
	/**
 	 * 注释:计划参与人员|text
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $tips_framer;
	 public $_tips_framer_type='varchar2';
	/**
 	 * 注释:计划制定者|text
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $tips_serial;
	 public $_tips_serial_type='varchar2';
	/**
 	 * 注释:计划备注|text
	 * 
	 * 
	 * @var VARCHAR2(2000)
	 **/
 	 public $tips_info;
	 public $_tips_info_type='varchar2';
	/**
 	 * 注释:所属机构路径
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $region_path;
	 public $_region_path_type='varchar2';
}
