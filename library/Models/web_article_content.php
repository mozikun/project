<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tweb_article_content extends dao_oracle{
	 public $__table = 'web_article_content';
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
	 * @var VARCHAR2(30)
	 **/
 	 public $article_id;
	 public $_article_id_type='varchar2';
	/**
 	 * 注释:文章内容
	 * 
	 * 
	 * @var VARCHAR2(4000)
	 **/
 	 public $content;
	 public $_content_type='varchar2';
}
