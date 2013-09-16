<?php
require_once ('db_oracle.php');
/**
 *注释:工作人员基本信息表
 *
 *
 **/
class Tstaff_archive extends dao_oracle{
	 public $__table = 'staff_archive';
	/**
 	 * 注释:内部用关键序号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:工作人员核心ID
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $user_id;
	 public $_user_id_type='varchar2';
	/**
 	 * 注释:真实姓名|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $name_real;
	 public $_name_real_type='varchar2';
	/**
 	 * 注释:科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9=>信息资料室,10=>其它
	 * 
	 * 
	 * @var VARCHAR2(15)
	 **/
 	 public $section_office_id;
	 public $_section_office_id_type='varchar2';
	/**
 	 * 注释:删除标记|null|0=>未正常保持,1=>正常,2=>删除
	 * 
	 * 
	 * @var VARCHAR2(1)
	 **/
 	 public $status_flag;
	 public $_status_flag_type='varchar2';
	/**
 	 * 注释:身份证号|text
	 * 
	 * 
	 * @var VARCHAR2(18)
	 **/
 	 public $identity_card_number;
	 public $_identity_card_number_type='varchar2';
	/**
 	 * 注释:性别|radio|1=>男,2=>女
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $sex;
	 public $_sex_type='varchar2';
	/**
 	 * 注释:出生日期|text
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $date_of_birth;
	 public $_date_of_birth_type='number';
	/**
 	 * 注释:职称|select|1=>正高,2=>副高,3=>中级,4=>助理（师级）,5=>员（士）,6=>待聘
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $title;
	 public $_title_type='varchar2';
	/**
 	 * 注释:职务|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $duty;
	 public $_duty_type='varchar2';
	/**
 	 * 注释:学历|select|1=>无学历,2=>小学,3=>初中,4=>高中,5=>技校,6=>中专,7=>大专,8=>大学,9=>研究生
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $study_history;
	 public $_study_history_type='varchar2';
	/**
 	 * 注释:学位|select|0=>无学位,1=>学士,2=>硕士,3=>博士
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $degrees;
	 public $_degrees_type='varchar2';
	/**
 	 * 注释:毕业时间|text
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $graduate_date;
	 public $_graduate_date_type='number';
	/**
 	 * 注释:毕业学校|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $graduate_school;
	 public $_graduate_school_type='varchar2';
	/**
 	 * 注释:联系电话|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $telephone_number;
	 public $_telephone_number_type='varchar2';
	/**
 	 * 注释:居委会名称|text
	 * 
	 * 
	 * @var VARCHAR2(40)
	 **/
 	 public $family_address;
	 public $_family_address_type='varchar2';
	/**
 	 * 注释:紧急联系人姓名|text
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $urgency_name;
	 public $_urgency_name_type='varchar2';
	/**
 	 * 注释:紧急联系人电话|text
	 * 
	 * 
	 * @var VARCHAR2(20)
	 **/
 	 public $urgency_telephone_number;
	 public $_urgency_telephone_number_type='varchar2';
	/**
 	 * 注释:年内接受培训情况_可多选|checkbox|11=>住院医师培训已合格,12=>正接受住院医师培训,13=>接受继续医学教育≥25学分,14=>接受继续医学教育<25学分,15=>全科医学培训,20=>护理知识培,30=>疾病预防知识培训,40=>卫生监督知识培训,50=>院前急救培训,60=>管理知识培训,70=>计算机培训,80=>其他岗位培训,90=>进修半年以上
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $continue_education;
	 public $_continue_education_type='varchar2';
	/**
 	 * 注释:所学专业名称|select|101=>基础医学,102=>预防医学,1031=>临床医学,1032=>医学技术,104=>口腔医学,105=>中医学,106=>法医学,107=>护理学,108=>药学,109=>卫生管理,01=>哲学,02=>经济学,03=>法学,04=>教育学,05=>文学,6=>历史学,07=>理学,08=>工学,09=>农学
	 * 
	 * 
	 * @var VARCHAR2(4)
	 **/
 	 public $specialty_name;
	 public $_specialty_name_type='varchar2';
	/**
 	 * 注释:出国留学学习时间（月数）|text
	 * 
	 * 
	 * @var VARCHAR2(3)
	 **/
 	 public $study_abroad;
	 public $_study_abroad_type='varchar2';
	/**
 	 * 注释:本月人员流动情况流入|select|11=>高中等院校毕业生,12=>其他卫生机构调入,13=>非卫生机构调入,14=>军转人员,19=>其他,21=>流出:调往其他卫生机构,22=>考取研究生,23=>出国留学,24=>退休,25=>辞职(辞退),26=>自然减员,29=>其他
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $mobility;
	 public $_mobility_type='varchar2';
	/**
 	 * 注释:是否本单位返聘人员|radio|Y=>是,N=>否
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $reengage;
	 public $_reengage_type='varchar2';
	/**
 	 * 注释:编制|select|1=>在编,2=>非在编
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $organizer;
	 public $_organizer_type='varchar2';
	/**
 	 * 注释:工种|select|1=>卫生技术人员,2=>其他技术人员,3=>管理人员,4=>工勤技能人员
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $type_of_work;
	 public $_type_of_work_type='varchar2';
	/**
 	 * 注释:行政/业务管理职务代码 (要求科室副主任及以上人员填写)|select|1=>党委(副)书记,2=>院(所.站)长,3=>副院(所.站)长,4=>科室主任,5=>科室副主任
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $manage_rank;
	 public $_manage_rank_type='varchar2';
	/**
 	 * 注释:从事专业类别代码|select|11=>执业医师,12=>执业助理医师,13=>见习医师,21=>注册护士,22=>助产士,31=>西药师(士),32=>中药师(士),41=>检验技师(士),42=>影像技师(士),50=>卫生监督员,69=>其他卫生技术人员,70=>其他技术人员,80=>管理人员,90=>工勤及技能人员
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $specialty_code;
	 public $_specialty_code_type='varchar2';
	/**
 	 * 注释:医师执业类别代码|select|1=>临床,2=>口腔,3=>公共卫生,4=>中医
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $physician_certified_type;
	 public $_physician_certified_type_type='varchar2';
	/**
 	 * 注释:医师执业范围代码|select|11=>内科专业,12=>外科专业,13=>妇产科专业,14=>儿科专业,15=>眼耳鼻咽喉科专业,16=>皮肤病与性病专业,17=>精神卫生专业,18=>职业病专业,19=>医学影像和放射治疗专业,20=>医学检验..病理专业,21=>全科医学专业,22=>急救医学专业,23=>康复医学专业,24=>预防保健专业,25=>特种医学与军事医学专业,26=>计划生育技术服务专业,31=>口腔科专业,41=>公共卫生类别专业,51=>中医专业,52=>中西医结合专业,53=>蒙医专业,54=>藏医专业,55=>维医专业,56=>傣医专业,57=>省级卫生行政部门规定的其他专业
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $physician_certified_rang;
	 public $_physician_certified_rang_type='varchar2';
	/**
 	 * 注释:是否中医见习医师|radio|1=>是,2=>否
	 * 
	 * 
	 * @var VARCHAR2(2)
	 **/
 	 public $herbalist_noviciate_doctor;
	 public $_herbalist_noviciate_doctor_type='varchar2';
	/**
 	 * 注释:参加工作日期|text
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $join_job_data;
	 public $_join_job_data_type='number';
	/**
 	 * 注释:办公室电话号码|text
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $office_telephone_number;
	 public $_office_telephone_number_type='varchar2';
	/**
 	 * 注释:手机号码(机构负责人及应急救治专家填写)|text
	 * 
	 * 
	 * @var VARCHAR2(16)
	 **/
 	 public $mobile_telephone_number;
	 public $_mobile_telephone_number_type='varchar2';
	/**
 	 * 注释:人员流动情况时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mobility_date;
	 public $_mobility_date_type='number';
	/**
 	 * 注释:外部业务id
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
	/**
 	 * 注释:中联内部医生ID号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $zl_staff_code;
	 public $_zl_staff_code_type='varchar2';
}
