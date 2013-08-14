<?php
require_once ('db_oracle.php');
/**
 *注释:
 *
 *
 **/
class Tdrug_reserve extends dao_oracle{
	 public $__table = 'drug_reserve';
	/**
 	 * 注释:唯一标识符|TEXT
	 * 
	 * 
	 * @var NCHAR(60)
	 **/
 	 public $uuid;
	 public $_uuid_type='nchar';
	/**
 	 * 注释:机构id
	 * 
	 * 
	 * @var NCHAR(60)
	 **/
 	 public $org_id;
	 public $_org_id_type='nchar';
	/**
 	 * 注释:医生代码|TEXT
	 * 
	 * 
	 * @var NCHAR(60)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='nchar';
	/**
 	 * 注释:创建时间|TEXT
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:修改时间|TEXT
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $updated;
	 public $_updated_type='number';
	/**
 	 * 注释:状态|1=>正常,2=>停用
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='number';
	/**
 	 * 注释:库存ID
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $reserve_id;
	 public $_reserve_id_type='nvarchar2';
	/**
 	 * 注释:药品类别ID
	 * 
	 * 
	 * @var NCHAR(60)
	 **/
 	 public $sort_id;
	 public $_sort_id_type='nchar';
	/**
 	 * 注释:药品ID
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $drug_id;
	 public $_drug_id_type='nvarchar2';
	/**
 	 * 注释:药品生产厂家ID
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $factory_id;
	 public $_factory_id_type='nvarchar2';
	/**
 	 * 注释:购买批次
	 * 
	 * 
	 * @var NVARCHAR2(240)
	 **/
 	 public $buy_batch;
	 public $_buy_batch_type='nvarchar2';
	/**
 	 * 注释:进价
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $wholesale_price;
	 public $_wholesale_price_type='number';
	/**
 	 * 注释:零售价格
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $retail_price;
	 public $_retail_price_type='number';
	/**
 	 * 注释:购买日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $buy_date;
	 public $_buy_date_type='number';
	/**
 	 * 注释:保质期时间 (效期)
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $expire_date;
	 public $_expire_date_type='number';
	/**
 	 * 注释:购买数量
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $buy_amount;
	 public $_buy_amount_type='nvarchar2';
	/**
 	 * 注释:放置位置
	 * 
	 * 
	 * @var NVARCHAR2(500)
	 **/
 	 public $stock_place;
	 public $_stock_place_type='nvarchar2';
	/**
 	 * 注释:规格
	 * 
	 * 
	 * @var NVARCHAR2(100)
	 **/
 	 public $specification;
	 public $_specification_type='nvarchar2';
	/**
 	 * 注释:ABC
	 * 
	 * 
	 * @var NVARCHAR2(500)
	 **/
 	 public $abc;
	 public $_abc_type='nvarchar2';
	/**
 	 * 注释:批准文号
	 * 
	 * 
	 * @var NVARCHAR2(80)
	 **/
 	 public $approval;
	 public $_approval_type='nvarchar2';
	/**
 	 * 注释:质量状况
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $quality_state;
	 public $_quality_state_type='nvarchar2';
	/**
 	 * 注释:停用原因
	 * 
	 * 
	 * @var NVARCHAR2(500)
	 **/
 	 public $suspend_why;
	 public $_suspend_why_type='nvarchar2';
	/**
 	 * 注释:执行动作
	 * 
	 * 
	 * @var NVARCHAR2(20)
	 **/
 	 public $action;
	 public $_action_type='nvarchar2';
	/**
 	 * 注释:操作员ID
	 * 
	 * 
	 * @var NVARCHAR2(70)
	 **/
 	 public $operate_user;
	 public $_operate_user_type='nvarchar2';
	/**
 	 * 注释:单位是否可以撤分
	 * 
	 * 
	 * @var NVARCHAR2(14)
	 **/
 	 public $chefen;
	 public $_chefen_type='nvarchar2';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $suspend;
	 public $_suspend_type='number';
	/**
 	 * 注释:属性
	 * 
	 * 
	 * @var NCHAR(508)
	 **/
 	 public $drug_attribute;
	 public $_drug_attribute_type='nchar';
	/**
 	 * 注释:药品小规格
	 * 
	 * 
	 * @var NCHAR(400)
	 **/
 	 public $xiaospecification;
	 public $_xiaospecification_type='nchar';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xiaowholesale_price;
	 public $_xiaowholesale_price_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $xiaoretail_price;
	 public $_xiaoretail_price_type='number';
	/**
 	 * 注释:前当的库存量  现在使用的是最小的单位 ，使用是用规格进行换算
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $now_stock;
	 public $_now_stock_type='number';
	/**
 	 * 注释:适应症功能主治
	 * 
	 * 
	 * @var NCHAR(508)
	 **/
 	 public $drug_effect;
	 public $_drug_effect_type='nchar';
	/**
 	 * 注释:不良反应
	 * 
	 * 
	 * @var NCHAR(508)
	 **/
 	 public $drug_adverse;
	 public $_drug_adverse_type='nchar';
	/**
 	 * 注释:禁忌
	 * 
	 * 
	 * @var NCHAR(508)
	 **/
 	 public $drug_forbidden;
	 public $_drug_forbidden_type='nchar';
	/**
 	 * 注释:注意事项
	 * 
	 * 
	 * @var NCHAR(508)
	 **/
 	 public $drug_attention;
	 public $_drug_attention_type='nchar';
	/**
 	 * 注释:药物相互作用
	 * 
	 * 
	 * @var NCHAR(508)
	 **/
 	 public $drug_interaction;
	 public $_drug_interaction_type='nchar';
	/**
 	 * 注释:孕妇及哺乳期妇女用药
	 * 
	 * 
	 * @var NCHAR(508)
	 **/
 	 public $drug_pregnant;
	 public $_drug_pregnant_type='nchar';
	/**
 	 * 注释:儿童用药
	 * 
	 * 
	 * @var NCHAR(508)
	 **/
 	 public $drug_children;
	 public $_drug_children_type='nchar';
	/**
 	 * 注释:老年用药
	 * 
	 * 
	 * @var NCHAR(508)
	 **/
 	 public $drug_old;
	 public $_drug_old_type='nchar';
	/**
 	 * 注释:药物过量
	 * 
	 * 
	 * @var NCHAR(508)
	 **/
 	 public $drug_excessive;
	 public $_drug_excessive_type='nchar';
}
