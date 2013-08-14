<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tweixin_setorg extends dao_oracle{
	 public $__table = 'weixin_setorg';
	/**
 	 * 注释:唯一标识符
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:机构logo图片
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $logo_name;
	 public $_logo_name_type='varchar2';
	/**
 	 * 注释:创建时间
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
	/**
 	 * 注释:微信公众账号名称
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $account_name;
	 public $_account_name_type='varchar2';
	/**
 	 * 注释:微信的接口地址
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $api_url;
	 public $_api_url_type='varchar2';
	/**
 	 * 注释:默认的微信回复内容
	 * 
	 * 
	 * @var VARCHAR2(1000)
	 **/
 	 public $default_replay;
	 public $_default_replay_type='varchar2';
	/**
 	 * 注释:机构号
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $org_id;
	 public $_org_id_type='number';
	/**
 	 * 注释:token字符串
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $token_str;
	 public $_token_str_type='varchar2';
	/**
 	 * 注释:微信平台登录账户
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $wx_platform_name;
	 public $_wx_platform_name_type='varchar2';
	/**
 	 * 注释:微信平台登录密码
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $wx_platform_pw;
	 public $_wx_platform_pw_type='varchar2';
}
