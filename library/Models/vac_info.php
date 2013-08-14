<?php
require_once ('db_oracle.php');
/**
 *注释:预防接种卡从表1
 *
 *
 **/
class Tvac_info extends dao_oracle{
	 public $__table = 'vac_info';
	/**
 	 * 注释:编号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $uuid;
	 public $_uuid_type='varchar2';
	/**
 	 * 注释:个人档案号
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $id;
	 public $_id_type='varchar2';
	/**
 	 * 注释:建立时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $created;
	 public $_created_type='number';
	/**
 	 * 注释:乙肝疫苗接种时间1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hepatitis_time_1;
	 public $_hepatitis_time_1_type='number';
	/**
 	 * 注释:乙肝疫苗接种部位1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hepatitis_part_1;
	 public $_hepatitis_part_1_type='varchar2';
	/**
 	 * 注释:乙肝疫苗批号1
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hepatitis_batch_1;
	 public $_hepatitis_batch_1_type='varchar2';
	/**
 	 * 注释:乙肝疫苗有效日期1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hepatitis_effective_1;
	 public $_hepatitis_effective_1_type='number';
	/**
 	 * 注释:乙肝疫苗生产企业1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatitis_enterprises_1;
	 public $_hepatitis_enterprises_1_type='varchar2';
	/**
 	 * 注释:乙肝疫苗接种医生1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hepatitis_doctor_1;
	 public $_hepatitis_doctor_1_type='varchar2';
	/**
 	 * 注释:乙肝疫苗接种备注1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatitis_remark_1;
	 public $_hepatitis_remark_1_type='varchar2';
	/**
 	 * 注释:乙肝疫苗接种时间2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hepatitis_time_2;
	 public $_hepatitis_time_2_type='number';
	/**
 	 * 注释:乙肝疫苗接种部位2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hepatitis_part_2;
	 public $_hepatitis_part_2_type='varchar2';
	/**
 	 * 注释:乙肝疫苗批号2
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hepatitis_batch_2;
	 public $_hepatitis_batch_2_type='varchar2';
	/**
 	 * 注释:乙肝疫苗有效日期2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hepatitis_effective_2;
	 public $_hepatitis_effective_2_type='number';
	/**
 	 * 注释:乙肝疫苗生产企业2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatitis_enterprises_2;
	 public $_hepatitis_enterprises_2_type='varchar2';
	/**
 	 * 注释:乙肝疫苗接种医生2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hepatitis_doctor_2;
	 public $_hepatitis_doctor_2_type='varchar2';
	/**
 	 * 注释:乙肝疫苗接种备注2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatitis_remark_2;
	 public $_hepatitis_remark_2_type='varchar2';
	/**
 	 * 注释:乙肝疫苗接种时间3
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hepatitis_time_3;
	 public $_hepatitis_time_3_type='number';
	/**
 	 * 注释:乙肝疫苗接种部位3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hepatitis_part_3;
	 public $_hepatitis_part_3_type='varchar2';
	/**
 	 * 注释:乙肝疫苗批号3
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hepatitis_batch_3;
	 public $_hepatitis_batch_3_type='varchar2';
	/**
 	 * 注释:乙肝疫苗有效日期3
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hepatitis_effective_3;
	 public $_hepatitis_effective_3_type='number';
	/**
 	 * 注释:乙肝疫苗生产企业3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatitis_enterprises_3;
	 public $_hepatitis_enterprises_3_type='varchar2';
	/**
 	 * 注释:乙肝疫苗接种医生3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hepatitis_doctor_3;
	 public $_hepatitis_doctor_3_type='varchar2';
	/**
 	 * 注释:乙肝疫苗接种备注3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatitis_remark_3;
	 public $_hepatitis_remark_3_type='varchar2';
	/**
 	 * 注释:卡介疫苗接种时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $bcg_time;
	 public $_bcg_time_type='number';
	/**
 	 * 注释:卡介疫苗接种部位
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $bcg_part;
	 public $_bcg_part_type='varchar2';
	/**
 	 * 注释:卡介疫苗批号
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $bcg_batch;
	 public $_bcg_batch_type='varchar2';
	/**
 	 * 注释:卡介疫苗有效日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $bcg_effective;
	 public $_bcg_effective_type='number';
	/**
 	 * 注释:卡介疫苗生产企业
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $bcg_enterprises;
	 public $_bcg_enterprises_type='varchar2';
	/**
 	 * 注释:卡介疫苗接种医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $bcg_doctor;
	 public $_bcg_doctor_type='varchar2';
	/**
 	 * 注释:卡介疫苗接种备注
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $bcg_remark;
	 public $_bcg_remark_type='varchar2';
	/**
 	 * 注释:脊灰疫苗接种时间1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $polio_time_1;
	 public $_polio_time_1_type='number';
	/**
 	 * 注释:脊灰疫苗接种部位1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $polio_part_1;
	 public $_polio_part_1_type='varchar2';
	/**
 	 * 注释:脊灰疫苗批号1
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $polio_batch_1;
	 public $_polio_batch_1_type='varchar2';
	/**
 	 * 注释:脊灰疫苗有效日期1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $polio_effective_1;
	 public $_polio_effective_1_type='number';
	/**
 	 * 注释:脊灰疫苗生产企业1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $polio_enterprises_1;
	 public $_polio_enterprises_1_type='varchar2';
	/**
 	 * 注释:脊灰疫苗接种医生1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $polio_doctor_1;
	 public $_polio_doctor_1_type='varchar2';
	/**
 	 * 注释:脊灰疫苗接种备注1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $polio_remark_1;
	 public $_polio_remark_1_type='varchar2';
	/**
 	 * 注释:脊灰疫苗接种时间2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $polio_time_2;
	 public $_polio_time_2_type='number';
	/**
 	 * 注释:脊灰疫苗接种部位2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $polio_part_2;
	 public $_polio_part_2_type='varchar2';
	/**
 	 * 注释:脊灰疫苗批号2
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $polio_batch_2;
	 public $_polio_batch_2_type='varchar2';
	/**
 	 * 注释:脊灰疫苗有效日期2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $polio_effective_2;
	 public $_polio_effective_2_type='number';
	/**
 	 * 注释:脊灰疫苗生产企业2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $polio_enterprises_2;
	 public $_polio_enterprises_2_type='varchar2';
	/**
 	 * 注释:脊灰疫苗接种医生2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $polio_doctor_2;
	 public $_polio_doctor_2_type='varchar2';
	/**
 	 * 注释:脊灰疫苗接种备注2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $polio_remark_2;
	 public $_polio_remark_2_type='varchar2';
	/**
 	 * 注释:脊灰疫苗接种时间3
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $polio_time_3;
	 public $_polio_time_3_type='number';
	/**
 	 * 注释:脊灰疫苗接种部位3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $polio_part_3;
	 public $_polio_part_3_type='varchar2';
	/**
 	 * 注释:脊灰疫苗批号3
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $polio_batch_3;
	 public $_polio_batch_3_type='varchar2';
	/**
 	 * 注释:脊灰疫苗有效日期3
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $polio_effective_3;
	 public $_polio_effective_3_type='number';
	/**
 	 * 注释:脊灰疫苗生产企业3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $polio_enterprises_3;
	 public $_polio_enterprises_3_type='varchar2';
	/**
 	 * 注释:脊灰疫苗接种医生3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $polio_doctor_3;
	 public $_polio_doctor_3_type='varchar2';
	/**
 	 * 注释:脊灰疫苗接种备注3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $polio_remark_3;
	 public $_polio_remark_3_type='varchar2';
	/**
 	 * 注释:脊灰疫苗接种时间4
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $polio_time_4;
	 public $_polio_time_4_type='number';
	/**
 	 * 注释:脊灰疫苗接种部位4
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $polio_part_4;
	 public $_polio_part_4_type='varchar2';
	/**
 	 * 注释:脊灰疫苗批号4
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $polio_batch_4;
	 public $_polio_batch_4_type='varchar2';
	/**
 	 * 注释:脊灰疫苗有效日期1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $polio_effective_4;
	 public $_polio_effective_4_type='number';
	/**
 	 * 注释:脊灰疫苗生产企业4
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $polio_enterprises_4;
	 public $_polio_enterprises_4_type='varchar2';
	/**
 	 * 注释:脊灰疫苗接种医生4
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $polio_doctor_4;
	 public $_polio_doctor_4_type='varchar2';
	/**
 	 * 注释:脊灰疫苗接种备注4
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $polio_remark_4;
	 public $_polio_remark_4_type='varchar2';
	/**
 	 * 注释:百白破疫苗接种时间1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dpt_time_1;
	 public $_dpt_time_1_type='number';
	/**
 	 * 注释:百白破疫苗接种部位1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dpt_part_1;
	 public $_dpt_part_1_type='varchar2';
	/**
 	 * 注释:百白破疫苗批号1
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $dpt_batch_1;
	 public $_dpt_batch_1_type='varchar2';
	/**
 	 * 注释:百白破疫苗有效日期1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dpt_effective_1;
	 public $_dpt_effective_1_type='number';
	/**
 	 * 注释:百白破疫苗生产企业1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $dpt_enterprises_1;
	 public $_dpt_enterprises_1_type='varchar2';
	/**
 	 * 注释:百白破疫苗接种医生1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dpt_doctor_1;
	 public $_dpt_doctor_1_type='varchar2';
	/**
 	 * 注释:百白破疫苗接种备注1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $dpt_remark_1;
	 public $_dpt_remark_1_type='varchar2';
	/**
 	 * 注释:百白破疫苗接种时间2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dpt_time_2;
	 public $_dpt_time_2_type='number';
	/**
 	 * 注释:百白破疫苗接种部位2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dpt_part_2;
	 public $_dpt_part_2_type='varchar2';
	/**
 	 * 注释:百白破疫苗批号2
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $dpt_batch_2;
	 public $_dpt_batch_2_type='varchar2';
	/**
 	 * 注释:百白破疫苗有效日期2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dpt_effective_2;
	 public $_dpt_effective_2_type='number';
	/**
 	 * 注释:百白破疫苗生产企业2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $dpt_enterprises_2;
	 public $_dpt_enterprises_2_type='varchar2';
	/**
 	 * 注释:百白破疫苗接种医生2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dpt_doctor_2;
	 public $_dpt_doctor_2_type='varchar2';
	/**
 	 * 注释:百白破疫苗接种备注2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $dpt_remark_2;
	 public $_dpt_remark_2_type='varchar2';
	/**
 	 * 注释:百白破疫苗接种时间3
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dpt_time_3;
	 public $_dpt_time_3_type='number';
	/**
 	 * 注释:百白破疫苗接种部位3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dpt_part_3;
	 public $_dpt_part_3_type='varchar2';
	/**
 	 * 注释:百白破疫苗批号3
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $dpt_batch_3;
	 public $_dpt_batch_3_type='varchar2';
	/**
 	 * 注释:百白破疫苗有效日期3
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dpt_effective_3;
	 public $_dpt_effective_3_type='number';
	/**
 	 * 注释:百白破疫苗生产企业3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $dpt_enterprises_3;
	 public $_dpt_enterprises_3_type='varchar2';
	/**
 	 * 注释:百白破疫苗接种医生3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dpt_doctor_3;
	 public $_dpt_doctor_3_type='varchar2';
	/**
 	 * 注释:百白破疫苗接种备注3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $dpt_remark_3;
	 public $_dpt_remark_3_type='varchar2';
	/**
 	 * 注释:百白破疫苗接种时间4
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dpt_time_4;
	 public $_dpt_time_4_type='number';
	/**
 	 * 注释:百白破疫苗接种部位4
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dpt_part_4;
	 public $_dpt_part_4_type='varchar2';
	/**
 	 * 注释:百白破疫苗批号4
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $dpt_batch_4;
	 public $_dpt_batch_4_type='varchar2';
	/**
 	 * 注释:百白破疫苗有效日期4
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $dpt_effective_4;
	 public $_dpt_effective_4_type='number';
	/**
 	 * 注释:百白破疫苗生产企业4
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $dpt_enterprises_4;
	 public $_dpt_enterprises_4_type='varchar2';
	/**
 	 * 注释:百白破疫苗接种医生4
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $dpt_doctor_4;
	 public $_dpt_doctor_4_type='varchar2';
	/**
 	 * 注释:百白破疫苗接种备注4
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $dpt_remark_4;
	 public $_dpt_remark_4_type='varchar2';
	/**
 	 * 注释:白破疫苗接种时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $rubella_time;
	 public $_rubella_time_type='number';
	/**
 	 * 注释:白破疫苗接种部位
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $rubella_part;
	 public $_rubella_part_type='varchar2';
	/**
 	 * 注释:白破疫苗批号
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $rubella_batch;
	 public $_rubella_batch_type='varchar2';
	/**
 	 * 注释:白破疫苗有效日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $rubella_effective;
	 public $_rubella_effective_type='number';
	/**
 	 * 注释:白破疫苗生产企业
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $rubella_enterprises;
	 public $_rubella_enterprises_type='varchar2';
	/**
 	 * 注释:白破疫苗接种医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $rubella_doctor;
	 public $_rubella_doctor_type='varchar2';
	/**
 	 * 注释:白破疫苗接种备注
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $rubella_remark;
	 public $_rubella_remark_type='varchar2';
	/**
 	 * 注释:麻风疫苗接种时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $lepra_time;
	 public $_lepra_time_type='number';
	/**
 	 * 注释:麻风疫苗接种部位
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $lepra_part;
	 public $_lepra_part_type='varchar2';
	/**
 	 * 注释:麻风疫苗批号
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $lepra_batch;
	 public $_lepra_batch_type='varchar2';
	/**
 	 * 注释:麻风疫苗有效日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $lepra_effective;
	 public $_lepra_effective_type='number';
	/**
 	 * 注释:麻风疫苗生产企业
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $lepra_enterprises;
	 public $_lepra_enterprises_type='varchar2';
	/**
 	 * 注释:麻风疫苗接种医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $lepra_doctor;
	 public $_lepra_doctor_type='varchar2';
	/**
 	 * 注释:麻风疫苗接种备注
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $lepra_remark;
	 public $_lepra_remark_type='varchar2';
	/**
 	 * 注释:麻腮风疫苗接种时间1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mmr_time_1;
	 public $_mmr_time_1_type='number';
	/**
 	 * 注释:麻腮风疫苗接种部位1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $mmr_part_1;
	 public $_mmr_part_1_type='varchar2';
	/**
 	 * 注释:麻腮风疫苗批号1
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $mmr_batch_1;
	 public $_mmr_batch_1_type='varchar2';
	/**
 	 * 注释:麻腮风疫苗有效日期1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mmr_effective_1;
	 public $_mmr_effective_1_type='number';
	/**
 	 * 注释:麻腮风疫苗生产企业1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $mmr_enterprises_1;
	 public $_mmr_enterprises_1_type='varchar2';
	/**
 	 * 注释:麻腮风疫苗接种医生1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $mmr_doctor_1;
	 public $_mmr_doctor_1_type='varchar2';
	/**
 	 * 注释:麻腮风疫苗接种备注1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $mmr_remark_1;
	 public $_mmr_remark_1_type='varchar2';
	/**
 	 * 注释:麻腮风疫苗接种时间2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mmr_time_2;
	 public $_mmr_time_2_type='number';
	/**
 	 * 注释:麻腮风疫苗接种部位2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $mmr_part_2;
	 public $_mmr_part_2_type='varchar2';
	/**
 	 * 注释:麻腮风疫苗批号2
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $mmr_batch_2;
	 public $_mmr_batch_2_type='varchar2';
	/**
 	 * 注释:麻腮风疫苗有效日期2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mmr_effective_2;
	 public $_mmr_effective_2_type='number';
	/**
 	 * 注释:麻腮风疫苗生产企业2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $mmr_enterprises_2;
	 public $_mmr_enterprises_2_type='varchar2';
	/**
 	 * 注释:麻腮风疫苗接种医生2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $mmr_doctor_2;
	 public $_mmr_doctor_2_type='varchar2';
	/**
 	 * 注释:麻腮风疫苗接种备注2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $mmr_remark_2;
	 public $_mmr_remark_2_type='varchar2';
	/**
 	 * 注释:麻腮疫苗接种时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mm_time;
	 public $_mm_time_type='number';
	/**
 	 * 注释:麻腮疫苗接种部位
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $mm_part;
	 public $_mm_part_type='varchar2';
	/**
 	 * 注释:麻腮疫苗批号
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $mm_batch;
	 public $_mm_batch_type='varchar2';
	/**
 	 * 注释:麻腮疫苗有效日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $mm_effective;
	 public $_mm_effective_type='number';
	/**
 	 * 注释:麻腮疫苗生产企业
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $mm_enterprises;
	 public $_mm_enterprises_type='varchar2';
	/**
 	 * 注释:麻腮疫苗接种医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $mm_doctor;
	 public $_mm_doctor_type='varchar2';
	/**
 	 * 注释:麻腮疫苗接种备注
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $mm_remark;
	 public $_mm_remark_type='varchar2';
	/**
 	 * 注释:麻疹疫苗接种时间1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $measles_time_1;
	 public $_measles_time_1_type='number';
	/**
 	 * 注释:麻疹疫苗接种部位1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $measles_part_1;
	 public $_measles_part_1_type='varchar2';
	/**
 	 * 注释:麻疹疫苗批号1
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $measles_batch_1;
	 public $_measles_batch_1_type='varchar2';
	/**
 	 * 注释:麻疹疫苗有效日期1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $measles_effective_1;
	 public $_measles_effective_1_type='number';
	/**
 	 * 注释:麻疹疫苗生产企业1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $measles_enterprises_1;
	 public $_measles_enterprises_1_type='varchar2';
	/**
 	 * 注释:麻疹疫苗接种医生1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $measles_doctor_1;
	 public $_measles_doctor_1_type='varchar2';
	/**
 	 * 注释:麻疹疫苗接种备注1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $measles_remark_1;
	 public $_measles_remark_1_type='varchar2';
	/**
 	 * 注释:麻疹疫苗接种时间2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $measles_time_2;
	 public $_measles_time_2_type='number';
	/**
 	 * 注释:麻疹疫苗接种部位2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $measles_part_2;
	 public $_measles_part_2_type='varchar2';
	/**
 	 * 注释:麻疹疫苗批号2
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $measles_batch_2;
	 public $_measles_batch_2_type='varchar2';
	/**
 	 * 注释:麻疹疫苗有效日期2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $measles_effective_2;
	 public $_measles_effective_2_type='number';
	/**
 	 * 注释:麻疹疫苗生产企业2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $measles_enterprises_2;
	 public $_measles_enterprises_2_type='varchar2';
	/**
 	 * 注释:麻疹疫苗接种医生2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $measles_doctor_2;
	 public $_measles_doctor_2_type='varchar2';
	/**
 	 * 注释:麻疹疫苗接种备注2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $measles_remark_2;
	 public $_measles_remark_2_type='varchar2';
	/**
 	 * 注释:A群流脑疫苗接种时间1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $a_time_1;
	 public $_a_time_1_type='number';
	/**
 	 * 注释:A群流脑疫苗接种部位1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $a_part_1;
	 public $_a_part_1_type='varchar2';
	/**
 	 * 注释:A群流脑疫苗批号1
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $a_batch_1;
	 public $_a_batch_1_type='varchar2';
	/**
 	 * 注释:A群流脑疫苗有效日期1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $a_effective_1;
	 public $_a_effective_1_type='number';
	/**
 	 * 注释:A群流脑疫苗生产企业1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $a_enterprises_1;
	 public $_a_enterprises_1_type='varchar2';
	/**
 	 * 注释:A群流脑疫苗接种医生1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $a_doctor_1;
	 public $_a_doctor_1_type='varchar2';
	/**
 	 * 注释:A群流脑疫苗接种备注1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $a_remark_1;
	 public $_a_remark_1_type='varchar2';
	/**
 	 * 注释:A群流脑疫苗接种时间2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $a_time_2;
	 public $_a_time_2_type='number';
	/**
 	 * 注释:A群流脑疫苗接种部位2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $a_part_2;
	 public $_a_part_2_type='varchar2';
	/**
 	 * 注释:A群流脑疫苗批号2
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $a_batch_2;
	 public $_a_batch_2_type='varchar2';
	/**
 	 * 注释:A群流脑疫苗有效日期2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $a_effective_2;
	 public $_a_effective_2_type='number';
	/**
 	 * 注释:A群流脑疫苗生产企业2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $a_enterprises_2;
	 public $_a_enterprises_2_type='varchar2';
	/**
 	 * 注释:A群流脑疫苗接种医生2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $a_doctor_2;
	 public $_a_doctor_2_type='varchar2';
	/**
 	 * 注释:A群流脑疫苗接种备注2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $a_remark_2;
	 public $_a_remark_2_type='varchar2';
	/**
 	 * 注释:A+C群流脑疫苗接种时间1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ac_time_1;
	 public $_ac_time_1_type='number';
	/**
 	 * 注释:A+C群流脑疫苗接种部位1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ac_part_1;
	 public $_ac_part_1_type='varchar2';
	/**
 	 * 注释:A+C群流脑疫苗批号1
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ac_batch_1;
	 public $_ac_batch_1_type='varchar2';
	/**
 	 * 注释:A+C群流脑疫苗有效日期1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ac_effective_1;
	 public $_ac_effective_1_type='number';
	/**
 	 * 注释:A+C群流脑疫苗生产企业1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ac_enterprises_1;
	 public $_ac_enterprises_1_type='varchar2';
	/**
 	 * 注释:A+C群流脑疫苗接种医生1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ac_doctor_1;
	 public $_ac_doctor_1_type='varchar2';
	/**
 	 * 注释:A+C群流脑疫苗接种备注1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ac_remark_1;
	 public $_ac_remark_1_type='varchar2';
	/**
 	 * 注释:A+C群流脑疫苗接种时间2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ac_time_2;
	 public $_ac_time_2_type='number';
	/**
 	 * 注释:A+C群流脑疫苗接种部位2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ac_part_2;
	 public $_ac_part_2_type='varchar2';
	/**
 	 * 注释:A+C群流脑疫苗批号2
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ac_batch_2;
	 public $_ac_batch_2_type='varchar2';
	/**
 	 * 注释:A+C群流脑疫苗有效日期2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ac_effective_2;
	 public $_ac_effective_2_type='number';
	/**
 	 * 注释:A+C群流脑疫苗生产企业2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ac_enterprises_2;
	 public $_ac_enterprises_2_type='varchar2';
	/**
 	 * 注释:A+C群流脑疫苗接种医生2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ac_doctor_2;
	 public $_ac_doctor_2_type='varchar2';
	/**
 	 * 注释:A+C群流脑疫苗接种备注2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ac_remark_2;
	 public $_ac_remark_2_type='varchar2';
	/**
 	 * 注释:乙脑疫苗接种时间1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $att_time_1;
	 public $_att_time_1_type='number';
	/**
 	 * 注释:乙脑疫苗接种部位1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $att_part_1;
	 public $_att_part_1_type='varchar2';
	/**
 	 * 注释:乙脑疫苗批号1
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $att_batch_1;
	 public $_att_batch_1_type='varchar2';
	/**
 	 * 注释:乙脑疫苗有效日期1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $att_effective_1;
	 public $_att_effective_1_type='number';
	/**
 	 * 注释:乙脑疫苗生产企业1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $att_enterprises_1;
	 public $_att_enterprises_1_type='varchar2';
	/**
 	 * 注释:乙脑苗接种医生1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $att_doctor_1;
	 public $_att_doctor_1_type='varchar2';
	/**
 	 * 注释:乙脑疫苗接种备注1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $att_remark_1;
	 public $_att_remark_1_type='varchar2';
	/**
 	 * 注释:乙脑疫苗接种时间2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $att_time_2;
	 public $_att_time_2_type='number';
	/**
 	 * 注释:乙脑疫苗接种部位2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $att_part_2;
	 public $_att_part_2_type='varchar2';
	/**
 	 * 注释:乙脑疫苗批号2
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $att_batch_2;
	 public $_att_batch_2_type='varchar2';
	/**
 	 * 注释:乙脑疫苗有效日期2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $att_effective_2;
	 public $_att_effective_2_type='number';
	/**
 	 * 注释:乙脑疫苗生产企业2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $att_enterprises_2;
	 public $_att_enterprises_2_type='varchar2';
	/**
 	 * 注释:乙脑疫苗接种医生2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $att_doctor_2;
	 public $_att_doctor_2_type='varchar2';
	/**
 	 * 注释:乙脑脑疫苗接种备注2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $att_remark_2;
	 public $_att_remark_2_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗接种时间1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ina_time_1;
	 public $_ina_time_1_type='number';
	/**
 	 * 注释:乙脑灭活疫苗接种部位1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ina_part_1;
	 public $_ina_part_1_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗批号1
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ina_batch_1;
	 public $_ina_batch_1_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗有效日期1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ina_effective_1;
	 public $_ina_effective_1_type='number';
	/**
 	 * 注释:乙脑灭活疫苗生产企业1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ina_enterprises_1;
	 public $_ina_enterprises_1_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗接种医生1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ina_doctor_1;
	 public $_ina_doctor_1_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗接种备注1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ina_remark_1;
	 public $_ina_remark_1_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗接种时间2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ina_time_2;
	 public $_ina_time_2_type='number';
	/**
 	 * 注释:乙脑灭活疫苗接种部位2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ina_part_2;
	 public $_ina_part_2_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗批号2
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ina_batch_2;
	 public $_ina_batch_2_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗有效日期2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ina_effective_2;
	 public $_ina_effective_2_type='number';
	/**
 	 * 注释:乙脑灭活疫苗生产企业2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ina_enterprises_2;
	 public $_ina_enterprises_2_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗接种医生2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ina_doctor_2;
	 public $_ina_doctor_2_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗接种备注2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ina_remark_2;
	 public $_ina_remark_2_type='varchar2';
	/**
 	 * 注释:甲肝减毒活疫苗接种时间
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hepatt_time;
	 public $_hepatt_time_type='number';
	/**
 	 * 注释:甲肝减毒活疫苗接种部位
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hepatt_part;
	 public $_hepatt_part_type='varchar2';
	/**
 	 * 注释:甲肝减毒活疫苗批号
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hepatt_batch;
	 public $_hepatt_batch_type='varchar2';
	/**
 	 * 注释:甲肝减毒活疫苗有效日期
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hepatt_effective;
	 public $_hepatt_effective_type='number';
	/**
 	 * 注释:甲肝减毒活疫苗生产企业
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatt_enterprises;
	 public $_hepatt_enterprises_type='varchar2';
	/**
 	 * 注释:甲肝减毒活疫苗接种医生
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hepatt_doctor;
	 public $_hepatt_doctor_type='varchar2';
	/**
 	 * 注释:甲肝减毒活疫苗接种备注
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepatt_remark;
	 public $_hepatt_remark_type='varchar2';
	/**
 	 * 注释:甲肝灭活疫苗接种时间1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hepa_time_1;
	 public $_hepa_time_1_type='number';
	/**
 	 * 注释:甲肝灭活疫苗接种部位1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hepa_part_1;
	 public $_hepa_part_1_type='varchar2';
	/**
 	 * 注释:甲肝灭活疫苗批号1
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hepa_batch_1;
	 public $_hepa_batch_1_type='varchar2';
	/**
 	 * 注释:甲肝灭活疫苗有效日期1
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hepa_effective_1;
	 public $_hepa_effective_1_type='number';
	/**
 	 * 注释:甲肝灭活疫苗生产企业1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepa_enterprises_1;
	 public $_hepa_enterprises_1_type='varchar2';
	/**
 	 * 注释:甲肝灭活疫苗接种医生1
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hepa_doctor_1;
	 public $_hepa_doctor_1_type='varchar2';
	/**
 	 * 注释:甲肝灭活疫苗接种备注1
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepa_remark_1;
	 public $_hepa_remark_1_type='varchar2';
	/**
 	 * 注释:甲肝灭活疫苗接种时间2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hepa_time_2;
	 public $_hepa_time_2_type='number';
	/**
 	 * 注释:甲肝灭活疫苗接种部位2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hepa_part_2;
	 public $_hepa_part_2_type='varchar2';
	/**
 	 * 注释:甲肝灭活疫苗批号2
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $hepa_batch_2;
	 public $_hepa_batch_2_type='varchar2';
	/**
 	 * 注释:甲肝灭活疫苗有效日期2
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hepa_effective_2;
	 public $_hepa_effective_2_type='number';
	/**
 	 * 注释:甲肝灭活疫苗生产企业2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepa_enterprises_2;
	 public $_hepa_enterprises_2_type='varchar2';
	/**
 	 * 注释:甲肝灭活疫苗接种医生2
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $hepa_doctor_2;
	 public $_hepa_doctor_2_type='varchar2';
	/**
 	 * 注释:甲肝灭活疫苗接种备注2
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $hepa_remark_2;
	 public $_hepa_remark_2_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗接种时间3
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ina_time_3;
	 public $_ina_time_3_type='number';
	/**
 	 * 注释:乙脑灭活疫苗接种部位3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ina_part_3;
	 public $_ina_part_3_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗批号3
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ina_batch_3;
	 public $_ina_batch_3_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗有效日期3
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ina_effective_3;
	 public $_ina_effective_3_type='number';
	/**
 	 * 注释:乙脑灭活疫苗生产企业3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ina_enterprises_3;
	 public $_ina_enterprises_3_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗接种医生3
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ina_doctor_3;
	 public $_ina_doctor_3_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗接种备注3
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ina_remark_3;
	 public $_ina_remark_3_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗接种时间4
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ina_time_4;
	 public $_ina_time_4_type='number';
	/**
 	 * 注释:乙脑灭活疫苗接种部位4
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ina_part_4;
	 public $_ina_part_4_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗批号4
	 * 
	 * 
	 * @var VARCHAR2(10)
	 **/
 	 public $ina_batch_4;
	 public $_ina_batch_4_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗有效日期4
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $ina_effective_4;
	 public $_ina_effective_4_type='number';
	/**
 	 * 注释:乙脑灭活疫苗生产企业4
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ina_enterprises_4;
	 public $_ina_enterprises_4_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗接种医生4
	 * 
	 * 
	 * @var VARCHAR2(30)
	 **/
 	 public $ina_doctor_4;
	 public $_ina_doctor_4_type='varchar2';
	/**
 	 * 注释:乙脑灭活疫苗接种备注4
	 * 
	 * 
	 * @var VARCHAR2(100)
	 **/
 	 public $ina_remark_4;
	 public $_ina_remark_4_type='varchar2';
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
