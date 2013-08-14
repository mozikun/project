<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tweixin_user extends dao_oracle{
	 public $__table = 'weixin_user';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:顺序编号，1开始，00000001
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $userid;
	 public $_userid_type='number';
	/**
 	 * 注释:用户微信号
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $wx_username;
	 public $_wx_username_type='varchar2';
	/**
 	 * 注释:关注的机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:关注时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $add_time;
	 public $_add_time_type='number';
	/**
 	 * 注释:角色ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $role_id;
	 public $_role_id_type='varchar2';
	/**
 	 * 注释:机构微信号
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $org_wxid;
	 public $_org_wxid_type='varchar2';
	/**
 	 * 注释:微信账户的fakeid
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $fakeid;
	 public $_fakeid_type='varchar2';
	/**
 	 * 注释:微信昵称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $nickname;
	 public $_nickname_type='varchar2';
}
