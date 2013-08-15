<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class This_image_info extends dao_oracle{
	 public $__table = 'his_image_info';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:医生ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:个人档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:就诊流水号
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $serial_number;
	 public $_serial_number_type='varchar2';
	/**
 	 * 注释:缩略图地址
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $img_thumb;
	 public $_img_thumb_type='varchar2';
	/**
 	 * 注释:影像实际地址
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $img_url;
	 public $_img_url_type='varchar2';
	/**
 	 * 注释:业务ID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
