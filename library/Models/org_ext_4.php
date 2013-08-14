<?php
require_once ('db_oracle.php');
/**
 *注释:机构扩展表4收入和支出
 *
 *
 **/
class Torg_ext_4 extends dao_oracle{
	 public $__table = 'org_ext_4';
	/**
 	 * 注释:机构扩展表4收入和支出id
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $id;
	 public $_id_type='number';
	/**
 	 * 注释:财政补助收入 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $finance_income;
	 public $_finance_income_type='number';
	/**
 	 * 注释:上级补助收入
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $superior_income;
	 public $_superior_income_type='number';
	/**
 	 * 注释:医疗门诊收入
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $medical_outpatient_income;
	 public $_medical_outpatient_income_type='number';
	/**
 	 * 注释:医疗住院收入
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $medical_hospital_income;
	 public $_medical_hospital_income_type='number';
	/**
 	 * 注释:药品门诊收入
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $drug_outpatient_income;
	 public $_drug_outpatient_income_type='number';
	/**
 	 * 注释:药品住院收入
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $drug_hospital_income;
	 public $_drug_hospital_income_type='number';
	/**
 	 * 注释:其他收入
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $drug_other_income;
	 public $_drug_other_income_type='number';
	/**
 	 * 注释:医疗支出 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $medical_payout;
	 public $_medical_payout_type='number';
	/**
 	 * 注释:药品支出小计 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $drug_payout;
	 public $_drug_payout_type='number';
	/**
 	 * 注释:药品费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $drug_fee_payout;
	 public $_drug_fee_payout_type='number';
	/**
 	 * 注释:财政专项支出 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $finance_payout;
	 public $_finance_payout_type='number';
	/**
 	 * 注释:其他支出 
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $other_payout;
	 public $_other_payout_type='number';
	/**
 	 * 注释:人员支出
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $hr_payout;
	 public $_hr_payout_type='number';
	/**
 	 * 注释:离退休费
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $retire_payout;
	 public $_retire_payout_type='number';
	/**
 	 * 注释:病人累计欠费总额
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $arrear_payout;
	 public $_arrear_payout_type='number';
	/**
 	 * 注释:年内病人累计欠费总额
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $arrear_payout_by_year;
	 public $_arrear_payout_by_year_type='number';
	/**
 	 * 注释:总收入合计
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $total_income;
	 public $_total_income_type='number';
	/**
 	 * 注释:医疗收入合计
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $medical_income;
	 public $_medical_income_type='number';
	/**
 	 * 注释:药品收入合计
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $drug_income;
	 public $_drug_income_type='number';
	/**
 	 * 注释:其他收入合计
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $total_payout;
	 public $_total_payout_type='number';
	/**
 	 * 注释:年份
	 * 
	 * 
	 * @var NUMBER(22)
	 **/
 	 public $year;
	 public $_year_type='number';
	/**
 	 * 注释:
	 * 
	 * 
	 * @var VARCHAR2(50)
	 **/
 	 public $ext_uuid;
	 public $_ext_uuid_type='varchar2';
}
