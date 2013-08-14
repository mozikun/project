<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tapi_logs extends dao_oracle{
	 public $__table = 'api_logs';
	/**
 	 * 注释:唯一id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:机构id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:第三方上传id
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
	/**
 	 * 注释:模块id
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $model_id;
	 public $_model_id_type='varchar2';
	/**
 	 * 注释:上传时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $upload_time;
	 public $_upload_time_type='number';
	/**
 	 * 注释:上传标致1添加成功2修改成功3删除成功
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $upload_token;
	 public $_upload_token_type='varchar2';
	/**
 	 * 注释:备注
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $remark;
	 public $_remark_type='varchar2';
}
