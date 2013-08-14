<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tweb_article_base extends dao_oracle{
	 public $__table = 'web_article_base';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:发布机构
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
	/**
 	 * 注释:标题
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $title;
	 public $_title_type='varchar2';
	/**
 	 * 注释:分类ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $sort_id;
	 public $_sort_id_type='varchar2';
	/**
 	 * 注释:来源
	 * 
	 * 
	 * @var VARCHAR2(200)
	 **/
 	 public $source;
	 public $_source_type='varchar2';
	/**
 	 * 注释:发布人
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='varchar2';
	/**
 	 * 注释:文章介绍
	 * 
	 * 
	 * @var VARCHAR2(400)
	 **/
 	 public $info;
	 public $_info_type='varchar2';
	/**
 	 * 注释:查看次数
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $views;
	 public $_views_type='number';
}
