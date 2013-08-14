<?php
require_once ('db_oracle.php');
/**
 *注释:症状
 *
 *
 **/
class Tet_symptom extends dao_oracle{
	 public $__table = 'et_symptom';
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
 	 * 注释:健康体检id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $examination_id;
	 public $_examination_id_type='varchar2';
	/**
 	 * 注释:症状|checkbox|1=>无症状,2=>头痛,3=>头晕,4=>心悸,5=>胸闷,6=>胸痛,7=>慢性咳嗽,8=>咳痰,9=>呼吸困难,10=>多饮,11=>多尿,12=>体重下降,13=>乏力,14=>关节肿痛,15=>视力模糊,16=>手脚麻木,17=>尿急,18=>尿痛,19=>便秘,20=>腹泻,21=>恶心呕吐,22=>眼花,23=>耳鸣,24=>乳房胀痛,25=>其他
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $symptom;
	 public $_symptom_type='varchar2';
	/**
 	 * 注释:症状其它内容|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $symptom_other;
	 public $_symptom_other_type='varchar2';
	/**
 	 * 注释:扩展UUID
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
	/**
 	 * 注释:机构ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $org_id;
	 public $_org_id_type='varchar2';
}
