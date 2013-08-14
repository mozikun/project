<?php
require_once ('db_oracle.php');
/**
 *注释:疑似预防接种异常反应（aefi)病例监测表
 *
 *
 **/
class Tabnormal_reaction extends dao_oracle{
	 public $__table = 'abnormal_reaction';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $uuid;
	 public $_uuid_type='nvarchar2';
	/**
 	 * 注释:创建时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:医生签名
	 * 
	 * 
	 * @var NVARCHAR2(52)
	 **/
 	 public $staff_id;
	 public $_staff_id_type='nvarchar2';
	/**
 	 * 注释:个人编号
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $id;
	 public $_id_type='nvarchar2';
	/**
 	 * 注释:病例所在县国标码
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $cd_county;
	 public $_cd_county_type='number';
	/**
 	 * 注释:病例姓名
	 * 
	 * 
	 * @var NVARCHAR2(80)
	 **/
 	 public $name;
	 public $_name_type='nvarchar2';
	/**
 	 * 注释:性别
	 * 
	 * 
	 * @var NVARCHAR2(20)
	 **/
 	 public $sex;
	 public $_sex_type='nvarchar2';
	/**
 	 * 注释:出生日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $date_of_birth;
	 public $_date_of_birth_type='number';
	/**
 	 * 注释:病例职业
	 * 
	 * 
	 * @var NVARCHAR2(80)
	 **/
 	 public $occupation;
	 public $_occupation_type='nvarchar2';
	/**
 	 * 注释:病例现住址
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $home_address;
	 public $_home_address_type='nvarchar2';
	/**
 	 * 注释:病例联系电话
	 * 
	 * 
	 * @var NVARCHAR2(24)
	 **/
 	 public $telephone_number;
	 public $_telephone_number_type='nvarchar2';
	/**
 	 * 注释:监护人姓名
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $guardian;
	 public $_guardian_type='nvarchar2';
	/**
 	 * 注释:就诊单位
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $aefi_onset_date;
	 public $_aefi_onset_date_type='number';
	/**
 	 * 注释:就诊日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $consult_date;
	 public $_consult_date_type='number';
	/**
 	 * 注释:就诊单位
	 * 
	 * 
	 * @var NVARCHAR2(100)
	 **/
 	 public $consult_org;
	 public $_consult_org_type='nvarchar2';
	/**
 	 * 注释:报告日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $report_date;
	 public $_report_date_type='number';
	/**
 	 * 注释:报告单位
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $report_org;
	 public $_report_org_type='nvarchar2';
	/**
 	 * 注释:报告人
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $reporter;
	 public $_reporter_type='nvarchar2';
	/**
 	 * 注释:初步临床诊断
	 * 
	 * 
	 * @var NVARCHAR2(200)
	 **/
 	 public $primary_diagnosis;
	 public $_primary_diagnosis_type='nvarchar2';
	/**
 	 * 注释:住院医院名称
	 * 
	 * 
	 * @var NVARCHAR2(120)
	 **/
 	 public $hospital_name;
	 public $_hospital_name_type='nvarchar2';
	/**
 	 * 注释:住院日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $date_of_hospitalization;
	 public $_date_of_hospitalization_type='number';
	/**
 	 * 注释:出院日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $release_date;
	 public $_release_date_type='number';
	/**
 	 * 注释:转归状况
	 * 
	 * 
	 * @var NVARCHAR2(80)
	 **/
 	 public $prognosis;
	 public $_prognosis_type='nvarchar2';
	/**
 	 * 注释:死亡日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $date_of_death;
	 public $_date_of_death_type='number';
	/**
 	 * 注释:病理解剖结论
	 * 
	 * 
	 * @var NVARCHAR2(400)
	 **/
 	 public $anatomy_result;
	 public $_anatomy_result_type='nvarchar2';
	/**
 	 * 注释:接种前患病名称
	 * 
	 * 
	 * @var NVARCHAR2(80)
	 **/
 	 public $disease_bef_immu;
	 public $_disease_bef_immu_type='nvarchar2';
	/**
 	 * 注释:接种前精神状况
	 * 
	 * 
	 * @var NVARCHAR2(24)
	 **/
 	 public $mental_status_bef_immu;
	 public $_mental_status_bef_immu_type='nvarchar2';
	/**
 	 * 注释:过敏物名称
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $allergen_name;
	 public $_allergen_name_type='nvarchar2';
	/**
 	 * 注释:家族史疾病种类
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $family_his;
	 public $_family_his_type='nvarchar2';
	/**
 	 * 注释:家庭成员曾患病名称
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $disease_family_member;
	 public $_disease_family_member_type='nvarchar2';
	/**
 	 * 注释:既往接种疫苗名称
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $vaccine_innoced;
	 public $_vaccine_innoced_type='nvarchar2';
	/**
 	 * 注释:既往反应发生日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $aefi_date;
	 public $_aefi_date_type='number';
	/**
 	 * 注释:既往反应疫苗名称
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $vaccine_bef;
	 public $_vaccine_bef_type='nvarchar2';
	/**
 	 * 注释:既往反应临床诊断单位名称
	 * 
	 * 
	 * @var NVARCHAR2(80)
	 **/
 	 public $former_clinical_org;
	 public $_former_clinical_org_type='nvarchar2';
	/**
 	 * 注释:反应接种疫苗
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $vaccine_innocued;
	 public $_vaccine_innocued_type='nvarchar2';
	/**
 	 * 注释:疫苗规格
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $vaccine_specification;
	 public $_vaccine_specification_type='nvarchar2';
	/**
 	 * 注释:疫苗生产企业名称
	 * 
	 * 
	 * @var NVARCHAR2(100)
	 **/
 	 public $vaccine_enterprise;
	 public $_vaccine_enterprise_type='nvarchar2';
	/**
 	 * 注释:疫苗批号
	 * 
	 * 
	 * @var NVARCHAR2(100)
	 **/
 	 public $vacc_no;
	 public $_vacc_no_type='nvarchar2';
	/**
 	 * 注释:疫苗有效期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $vaccine_validity;
	 public $_vaccine_validity_type='number';
	/**
 	 * 注释:接种剂量单位
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $vacc_dose_unit;
	 public $_vacc_dose_unit_type='nvarchar2';
	/**
 	 * 注释:接种剂量
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $vacc_dose;
	 public $_vacc_dose_type='number';
	/**
 	 * 注释:接种日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $immu_date;
	 public $_immu_date_type='number';
	/**
 	 * 注释:接种途径
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $vacc_manner;
	 public $_vacc_manner_type='nvarchar2';
	/**
 	 * 注释:接种部位
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $immu_place;
	 public $_immu_place_type='nvarchar2';
	/**
 	 * 注释:疫苗外观
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $appear_vaccine;
	 public $_appear_vaccine_type='nvarchar2';
	/**
 	 * 注释:疫苗保存容器
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $vaccine_store_vessel;
	 public $_vaccine_store_vessel_type='nvarchar2';
	/**
 	 * 注释:疫苗保存温度
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $storage_temperature;
	 public $_storage_temperature_type='nvarchar2';
	/**
 	 * 注释:疫苗有无批签发合格证书
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $whether_autorized;
	 public $_whether_autorized_type='nvarchar2';
	/**
 	 * 注释:疫苗送检日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $vaccine_test_date;
	 public $_vaccine_test_date_type='number';
	/**
 	 * 注释:疫苗检定结果
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $result_vaccine_test;
	 public $_result_vaccine_test_type='nvarchar2';
	/**
 	 * 注释:稀释液名称
	 * 
	 * 
	 * @var NVARCHAR2(80)
	 **/
 	 public $vaccine_diluent;
	 public $_vaccine_diluent_type='nvarchar2';
	/**
 	 * 注释:稀释液规格
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $diluent_specification;
	 public $_diluent_specification_type='nvarchar2';
	/**
 	 * 注释:稀释液生产企业名称
	 * 
	 * 
	 * @var NVARCHAR2(160)
	 **/
 	 public $diluent_enterprise;
	 public $_diluent_enterprise_type='nvarchar2';
	/**
 	 * 注释:稀释液批号
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $diluent_batch;
	 public $_diluent_batch_type='nvarchar2';
	/**
 	 * 注释:稀释液有效日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $diluent_validity;
	 public $_diluent_validity_type='number';
	/**
 	 * 注释:稀释液外观
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $appear_diluent;
	 public $_appear_diluent_type='nvarchar2';
	/**
 	 * 注释:稀释液保存容器
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $preserve_vessel;
	 public $_preserve_vessel_type='nvarchar2';
	/**
 	 * 注释:稀释液保存温度
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $preserve_temperat_ure;
	 public $_preserve_temperat_ure_type='nvarchar2';
	/**
 	 * 注释:注射器名称
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $injector_name;
	 public $_injector_name_type='nvarchar2';
	/**
 	 * 注释:注射器类型
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $injector_type;
	 public $_injector_type_type='nvarchar2';
	/**
 	 * 注释:注射器规格
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $injector_form;
	 public $_injector_form_type='nvarchar2';
	/**
 	 * 注释:注射器生产企业
	 * 
	 * 
	 * @var NVARCHAR2(140)
	 **/
 	 public $injector_enter_name;
	 public $_injector_enter_name_type='nvarchar2';
	/**
 	 * 注释:注射器批号
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $injector_batch;
	 public $_injector_batch_type='nvarchar2';
	/**
 	 * 注释:注射器有效期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $injector_validity;
	 public $_injector_validity_type='number';
	/**
 	 * 注释:接种人员
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $abnormal_reaction_name;
	 public $_abnormal_reaction_name_type='nvarchar2';
	/**
 	 * 注释:接种人员性别
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $abnormal_reaction_gender;
	 public $_abnormal_reaction_gender_type='nvarchar2';
	/**
 	 * 注释:接种人员年龄
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $abnormal_reaction_age;
	 public $_abnormal_reaction_age_type='number';
	/**
 	 * 注释:接种人员工作单位
	 * 
	 * 
	 * @var NVARCHAR2(100)
	 **/
 	 public $abnormal_reaction_org;
	 public $_abnormal_reaction_org_type='nvarchar2';
	/**
 	 * 注释:预防接种培训资质证状况
	 * 
	 * 
	 * @var NVARCHAR2(100)
	 **/
 	 public $authorized_or_not;
	 public $_authorized_or_not_type='nvarchar2';
	/**
 	 * 注释:最近接受培训日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $training_date;
	 public $_training_date_type='number';
	/**
 	 * 注释:接种场所
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $immu_site;
	 public $_immu_site_type='nvarchar2';
	/**
 	 * 注释:接种操作程序状况
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $operational_pro;
	 public $_operational_pro_type='nvarchar2';
	/**
 	 * 注释:最终临床诊断
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $final_diagnosis;
	 public $_final_diagnosis_type='nvarchar2';
	/**
 	 * 注释:异常反应分类
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $ab_eff_class;
	 public $_ab_eff_class_type='nvarchar2';
	/**
 	 * 注释:与可疑疫苗的因果关联程度
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $causality_aefi_vaccine;
	 public $_causality_aefi_vaccine_type='nvarchar2';
	/**
 	 * 注释:机体损害程度
	 * 
	 * 
	 * @var NVARCHAR2(60)
	 **/
 	 public $damage_extent;
	 public $_damage_extent_type='nvarchar2';
	/**
 	 * 注释:群体性反应编码
	 * 
	 * 
	 * @var NVARCHAR2(40)
	 **/
 	 public $aefi_cluster_no;
	 public $_aefi_cluster_no_type='nvarchar2';
	/**
 	 * 注释:调查单位
	 * 
	 * 
	 * @var NVARCHAR2(160)
	 **/
 	 public $investigate_org;
	 public $_investigate_org_type='nvarchar2';
	/**
 	 * 注释:调查人员
	 * 
	 * 
	 * @var NVARCHAR2(160)
	 **/
 	 public $investigator;
	 public $_investigator_type='nvarchar2';
	/**
 	 * 注释:调查日期
	 * 
	 * 
	 * @var NVARCHAR2(160)
	 **/
 	 public $investigate_date;
	 public $_investigate_date_type='nvarchar2';
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
	 * @var NVARCHAR2(60)
	 **/
 	 public $org_id;
	 public $_org_id_type='nvarchar2';
}
