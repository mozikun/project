<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tweixin_logs extends dao_oracle{
	 public $__table = 'weixin_logs';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:消息内容
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $content;
	 public $_content_type='varchar2';
	/**
 	 * 注释:响应状态，1成功，2失败
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $reply;
	 public $_reply_type='number';
	/**
 	 * 注释:微信ID
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $weixin_id;
	 public $_weixin_id_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $add_time;
	 public $_add_time_type='number';
	/**
 	 * 注释:微信事件，1关注，2取消关注，3文本请求，4图文请求，5图片请求，6地址请求，7链接请求
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $wx_event;
	 public $_wx_event_type='number';
}
