<?php
require_once ('db_oracle.php');
/**
 *注释:生活方式
 *
 *
 **/
class Tet_lifestyle extends dao_oracle{
	 public $__table = 'et_lifestyle';
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
	 * @var VARCHAR2(30)
	 **/
 	 public $created;
	 public $_created_type='varchar2';
	/**
 	 * 注释:健康体检id
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $examination_id;
	 public $_examination_id_type='varchar2';
	/**
 	 * 注释:锻炼频率|checkbox|1=>每天,2=>每周一次以上,3=>偶尔,4=>不锻炼
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sport_frequence;
	 public $_sport_frequence_type='varchar2';
	/**
 	 * 注释:每次锻炼时间(分钟)|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $sport_time;
	 public $_sport_time_type='varchar2';
	/**
 	 * 注释:坚持锻炼时间(小时)|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $exercise_duration;
	 public $_exercise_duration_type='varchar2';
	/**
 	 * 注释:锻炼方式|text
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $exercising_way;
	 public $_exercising_way_type='varchar2';
	/**
 	 * 注释:饮食习惯|checkbox|1=>荤素均衡,2=>荤食为主,3=>素食为主,4=>嗜盐,5=>嗜油,6=>嗜糖
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $food_habit;
	 public $_food_habit_type='varchar2';
	/**
 	 * 注释:吸烟状况|checkbox|1=>从不吸烟,2=>已戒烟,3=>吸烟
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $smoke;
	 public $_smoke_type='varchar2';
	/**
 	 * 注释:日吸烟量(支)|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $smoke_quantity;
	 public $_smoke_quantity_type='varchar2';
	/**
 	 * 注释:开始吸烟年龄(岁)|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $begin_smoke_age;
	 public $_begin_smoke_age_type='varchar2';
	/**
 	 * 注释:戒烟年龄(岁)|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $stop_smoke_age;
	 public $_stop_smoke_age_type='varchar2';
	/**
 	 * 注释:饮酒频率|radio|1=>从不,2=>偶尔,3=>经常,4=>每天
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $drink_frequency;
	 public $_drink_frequency_type='varchar2';
	/**
 	 * 注释:日饮酒量(两)|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $drink_quantity;
	 public $_drink_quantity_type='varchar2';
	/**
 	 * 注释:是否戒酒|radio|1=>未戒酒,2=>已戒酒
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $drink;
	 public $_drink_type='varchar2';
	/**
 	 * 注释:戒酒年龄|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $stop_drinking_age;
	 public $_stop_drinking_age_type='varchar2';
	/**
 	 * 注释:开始饮酒年龄|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $begin_drinking_age;
	 public $_begin_drinking_age_type='varchar2';
	/**
 	 * 注释:近一年内是否曾醉酒|radio|1=>是,2=>否
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $last_year_ntoxication;
	 public $_last_year_ntoxication_type='varchar2';
	/**
 	 * 注释:饮酒种类|checkbox|1=>白酒,2=>啤酒,3=>红酒,4=>黄酒,5=>其他
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $drink_style;
	 public $_drink_style_type='varchar2';
	/**
 	 * 注释:其它饮酒种类|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $drink_style_other;
	 public $_drink_style_other_type='varchar2';
	/**
 	 * 注释:职业暴露|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $occupational_exposure;
	 public $_occupational_exposure_type='varchar2';
	/**
 	 * 注释:具体职业|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $occupation;
	 public $_occupation_type='varchar2';
	/**
 	 * 注释:从业时间(年)|text
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $occupation_age;
	 public $_occupation_age_type='varchar2';
	/**
 	 * 注释:毒物种类化学品|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $chemistry;
	 public $_chemistry_type='varchar2';
	/**
 	 * 注释:毒物种类化学品防护措施|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $chemistry_protection;
	 public $_chemistry_protection_type='varchar2';
	/**
 	 * 注释:毒物种类化学品防护措施|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $chemistry_protection_info;
	 public $_chemistry_protection_info_type='varchar2';
	/**
 	 * 注释:毒物种类毒物|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $pest;
	 public $_pest_type='varchar2';
	/**
 	 * 注释:毒物种类防护毒物措施|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $pest_protection;
	 public $_pest_protection_type='varchar2';
	/**
 	 * 注释:毒物种类毒物防护措施|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $pest_protection_info;
	 public $_pest_protection_info_type='varchar2';
	/**
 	 * 注释:毒物种类射线|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ray;
	 public $_ray_type='varchar2';
	/**
 	 * 注释:毒物种类防护射线措施|radio|1=>无,2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ray_protection;
	 public $_ray_protection_type='varchar2';
	/**
 	 * 注释:毒物种类射线|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ray_protection_info;
	 public $_ray_protection_info_type='varchar2';
	/**
 	 * 注释:职业病危害粉尘
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $dust;
	 public $_dust_type='varchar2';
	/**
 	 * 注释:职业病危害粉尘防护措施1=>无2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $dust_protection;
	 public $_dust_protection_type='varchar2';
	/**
 	 * 注释:职业病危害粉尘|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $dust_protection_info;
	 public $_dust_protection_info_type='varchar2';
	/**
 	 * 注释:职业病危害物理因素
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $physical;
	 public $_physical_type='varchar2';
	/**
 	 * 注释:职业病危害物理因素防护措施|radio1=>无2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $physical_protection;
	 public $_physical_protection_type='varchar2';
	/**
 	 * 注释:职业病危害物理因素|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $physical_protection_info;
	 public $_physical_protection_info_type='varchar2';
	/**
 	 * 注释:职业病危害其他
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $other_types;
	 public $_other_types_type='varchar2';
	/**
 	 * 注释:职业病危害防护措施|radio1=>无2=>有
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $other_types_protection;
	 public $_other_types_protection_type='varchar2';
	/**
 	 * 注释:职业病危害其他|text
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $other_types_info;
	 public $_other_types_info_type='varchar2';
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
