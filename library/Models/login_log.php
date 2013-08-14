<?php
require_once ('db_oracle.php');
/**
 *注释:登录日志
 *
 *
 **/
class Tlogin_log extends dao_oracle{
	 public $__table = 'login_log';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:机构编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:医生编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $user_id;
	 public $_user_id_type='varchar2';
	/**
 	 * 注释:IP
	 * 
	 * 
	 * @var VARCHAR2(60)
	 **/
 	 public $ip_address;
	 public $_ip_address_type='varchar2';
	/**
 	 * 注释:登录时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $login_time;
	 public $_login_time_type='number';
	/**
 	 * 注释:状态|radio|1=>登录成功,2=>机构密码错误,3=>用户密码错误,4=>非法进入
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $status;
	 public $_status_type='number';
	/**
 	 * 注释:备注
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $remark;
	 public $_remark_type='varchar2';
}
