<?php
/**
 * @author 我好笨
 * 文件完成个人基本信息的导入（扩展新增）
 */
$time=time();
//生活环境--单独取--数据库ehr_living_conditions
$rd['uuid']=isset($pd['uuid'])?$pd['uuid']:$rd['uuid'];
$sql="select * from ehr_living_conditions where `serial_number`='".$rd['uuid']."' limit 1";
$li=mysql_query($sql);
while($lc=mysql_fetch_array($li))
{
	$temp_array=array();
	$temp_array=$this->shequtoquyu($lc['kitchen_exhaust_code']);
	$individual_archive->kitchen_exhaust=array_code_change($temp_array[0],$iha_kitchen_exhaust);
	$temp_array=array();
	$temp_array=$this->shequtoquyu($lc['fuel_type_code']);
	$individual_archive->fuel_type=array_code_change($temp_array[0],$iha_fuel_type);
	$temp_array=array();
	$temp_array=$this->shequtoquyu($lc['water_code']);
	$individual_archive->water=array_code_change($temp_array[0],$iha_water);
	$temp_array=array();
	$temp_array=$this->shequtoquyu($lc['toliet_code']);
	$individual_archive->toilet=array_code_change($temp_array[0],$iha_toilet);
	$temp_array=array();
	$temp_array=$this->shequtoquyu($lc['livestock_code']);
	$individual_archive->livestock_column=array_code_change($temp_array[0],$iha_livestock_column);
}
//处理血型
$blood=mysql_query("select * from The_blood_type_characteristics where serial_number='".$rd['uuid']."' limit 1");
$blood_rd=mysql_fetch_array($blood);
require_once __SITEROOT.'/library/Models/blood_type.php';
$blood=new Tblood_type();
$blood->id=$uuid;
$blood->created=time();
$blood->updated=time();
$blood->staff_id=$staff_id;//医生ID
$blood->org_id=$org_id;
$blood->uuid=uniqid("B_");
$blood->status_flag=1;
$temp_array=array();
$temp_array=$this->shequtoquyu($blood_rd['ABO_bloodtype']);
$blood->abo_bloodtype=array_code_change($temp_array[0],$ABO_bloodtype);

$temp_array=array();
$temp_array=$this->shequtoquyu($blood_rd['RH_bloodtype']);
$blood->rh_bloodtype=array_code_change($temp_array[0],$RH_bloodtype);
$blood->insert();
$blood->free_statement();
//处理医疗支付方式
require_once __SITEROOT.'/library/Models/charge_style.php';
$rd['charge_style']=isset($pd['charge_style'])?$pd['charge_style']:$rd['charge_style'];//为了兼容下面的
$rd['charge_style_value']=isset($pd['charge_style_value'])?$pd['charge_style_value']:$rd['charge_style_value'];//为了兼容下面的
if ($rd['charge_style'])
{
	$temp_array=array();
	$temp_array=$this->shequtoquyu($rd['charge_style']);
	foreach ($temp_array as $k=>$v)
	{
		$charge=new Tcharge_style();
		$charge->id=$uuid;
		$charge->created=$time;
		$charge->updated=$time;
		$charge->staff_id=$staff_id;//医生ID
		$charge->org_id=$org_id;
		$charge->status_flag=1;
		$charge->uuid=uniqid("C_");
		$charge->charge_style=array_code_change($v,$charge_style);
		//当值为其他时，则需要向附加字段写入文本值
		$charge->charge_comment=$rd['charge_style_value'];
		$charge->insert();
		$charge->free_statement();
	}
}

//处理暴露史
require_once __SITEROOT.'/library/Models/exposure_history.php';
$individual_archive->exposure_history=1;
$rd['expose_history']=isset($pd['expose_history'])?$pd['expose_history']:$rd['expose_history'];
if ($rd['expose_history'])
{
	$temp_array=array();
	$temp_array=$this->shequtoquyu($rd['expose_history']);
	foreach ($temp_array as $k=>$v)
	{
		$exposure=new Texposure_history();
		$exposure->id=$uuid;
		$exposure->created=$time;
		$exposure->updated=$time;
		$exposure->staff_id=$staff_id;//医生ID
		$exposure->org_id=$org_id;
		$exposure->status_flag=1;
		$exposure->uuid=uniqid("E_");
		$exposure->exposure_code=array_code_change($v,$iha_exposure_history);
		$exposure->insert();
		$exposure->free_statement();
		$individual_archive->exposure_history=2;
	}
}

//处理过敏史
require_once __SITEROOT.'/library/Models/allergy.php';
$allergy=mysql_query("select * from the_history_of_allergies where serial_number='".$rd['uuid']."' limit 1");
$allergy_rd=mysql_fetch_array($allergy);
$temp_array=array();
$temp_array=$this->shequtoquyu($allergy_rd['druggery_allergic_history_code']);
$individual_archive->allergy_history='1';
foreach($temp_array as $k=>$v)
{
	if (isset($allergy_history[$v][0]))
	{
		//不在数据字典的记录不写入数据库
		$allergy=new Tallergy();
		$allergy->id=$uuid;
		$allergy->created=$time;
		$allergy->updated=$time;
		$allergy->staff_id=$staff_id;//医生ID
		$allergy->org_id=$org_id;
		$allergy->status_flag=1;
		$allergy->uuid=uniqid("A_");
		$allergy->allergy_code=$allergy_history[$v][0];
		//当填写了其他时，向文本字段写入值
		if ($allergy_history[$v][0]=='-99')
		{
			$allergy->allergy_comment=$allergy_rd['druggery_allergic_history_value'];
		}
		$allergy->insert();
		$allergy->free_statement();
		$individual_archive->allergy_history='2';
	}
}
//处理手术史
require_once __SITEROOT.'/library/Models/surgical_history.php';
$surgical=mysql_query("select * from surgical_history where serial_number='".$rd['uuid']."'");
$individual_archive->surgery_history=1;
while ($surgical_rd=mysql_fetch_array($surgical))
{
	$surgical_history=new Tsurgical_history();
	$surgical_history->id=$uuid;
	$surgical_history->created=$time;
	$surgical_history->updated=$time;
	$surgical_history->staff_id=$staff_id;//医生ID
	$surgical_history->org_id=$org_id;
	$surgical_history->status_flag=1;
	$surgical_history->uuid=uniqid("S_");
	$surgical_history->life_cycle=$surgical_rd['life_cycle'];
	$surgical_history->operation_id=$surgical_rd['operation_name'];
	$surgical_history->operation_date=$surgical_rd['operation_date'];
	$surgical_history->insert();
	$surgical_history->free_statement();
	$individual_archive->surgery_history=2;
}
//处理外伤史
require_once __SITEROOT.'/library/Models/trauma.php';
$trauma_mysql=mysql_query("select * from ehr_trauma_history where serial_number='".$rd['uuid']."'");
$individual_archive->trauma_history=1;
while ($trauma_rd=mysql_fetch_array($trauma_mysql))
{
	$trauma=new Ttrauma();
	$trauma->id=$uuid;
	$trauma->created=$time;
	$trauma->updated=$time;
	$trauma->staff_id=$staff_id;//医生ID
	$trauma->org_id=$org_id;
	$trauma->status_flag=1;
	$trauma->uuid=uniqid("T_");
	$trauma->trauma_name=$trauma_rd['trauma_name'];
	$trauma->trauma_time=$trauma_rd['trauma_date'];
	$trauma->insert();
	$trauma->free_statement();
	$individual_archive->trauma_history=2;
}
//处理输血史
require_once __SITEROOT.'/library/Models/transfusion.php';
$transfusion_mysql=mysql_query("select * from Transfusion_of where serial_number='".$rd['uuid']."'");
$individual_archive->blood_history=1;
while ($transfusion_rd=mysql_fetch_array($transfusion_mysql))
{
	$transfusion=new Ttransfusion();
	$transfusion->id=$uuid;
	$transfusion->created=$time;
	$transfusion->updated=$time;
	$transfusion->staff_id=$staff_id;//医生ID
	$transfusion->org_id=$org_id;
	$transfusion->status_flag=1;
	$transfusion->uuid=uniqid("T_");
	$transfusion->life_cycle=$transfusion_rd['life_cycle'];
	$transfusion->quantity=$transfusion_rd['transfusion_complexion'];
	$transfusion->transfusion_date=$transfusion_rd['transfusion_date'];
	$transfusion->insert();
	$transfusion->free_statement();
	$individual_archive->blood_history=2;
}
//处理遗传病史
$individual_archive->genetic_diseases_history=1;
$rd['genetic_history_value']=isset($pd['genetic_history_value'])?$pd['genetic_history_value']:$rd['genetic_history_value'];
if($rd['genetic_history_value'])
{
	require_once __SITEROOT.'/library/Models/genetic_diseases.php';
	$genetic_diseases=new Tgenetic_diseases();
	$genetic_diseases->id=$uuid;
	$genetic_diseases->created=$time;
	$genetic_diseases->updated=$time;
	$genetic_diseases->staff_id=$staff_id;//医生ID
	$genetic_diseases->org_id=$org_id;
	$genetic_diseases->status_flag=1;
	$genetic_diseases->uuid=uniqid("T_");
	$genetic_diseases->disease_name=$rd['genetic_history_value'];
	$genetic_diseases->insert();
	$genetic_diseases->free_statement();
	$individual_archive->genetic_diseases_history=2;
}
//处理家族史
require_once __SITEROOT.'/library/Models/family_history.php';
$code_temp_array=array('父亲'=>'farther','母亲'=>'mother','兄弟姐妹'=>'brother','子女'=>'son');
$family_history_mysql=mysql_query("select * from family_story where serial_number='".$rd['uuid']."'");
$individual_archive->family_history=1;
while ($family_history_rd=mysql_fetch_array($family_history_mysql))
{
	$temp_array=array();
	$temp_array=$this->shequtoquyu($family_history_rd['family_clinical_code']);
	foreach ($temp_array as $k=>$v)
	{
		$family_historys=new Tfamily_history();
		$family_historys->id=$uuid;
		$family_historys->created=$time;
		$family_historys->updated=$time;
		$family_historys->staff_id=$staff_id;//医生ID
		$family_historys->org_id=$org_id;
		$family_historys->status_flag=1;
		$family_historys->uuid=uniqid("F_");
		$family_historys->relationship=$code_temp_array[$family_history_rd['family_relations']];
		$family_historys->disease_code=array_code_change($v,$family_history);//其他项统一用-99
		//当填写了其他时，向文本字段写入值
		if ($family_history[$v][0]=="-99")
		{
			$family_historys->family_comment=$family_history_rd['family_clinical_other'];
		}
		$family_historys->insert();
		$family_historys->free_statement();
		$individual_archive->family_history=2;
	}
}
//处理残疾状况
require_once __SITEROOT.'/library/Models/deformity.php';
$deformity=mysql_query("select * from deformity where serial_number='".$rd['uuid']."' limit 1");
$deformity_rd=mysql_fetch_array($deformity);
$individual_archive->disability=1;
if($deformity_rd['deformity_type'])
{
	$temp_array=array();
	$temp_array=$this->shequtoquyu($deformity_rd['deformity_type']);
	foreach ($temp_array as $k=>$v)
	{
		$deformity=new Tdeformity();
		$deformity->id=$uuid;
		$deformity->created=$time;
		$deformity->updated=$time;
		$deformity->staff_id=$staff_id;//医生ID
		$deformity->org_id=$org_id;
		$deformity->status_flag=1;
		$deformity->uuid=uniqid("C_");
		$deformity->deformity_type=$v;
		//当填写了其他时，向文本字段写入值
		if ($deformity_type[$v][0]=="-99")
		{
			$deformity->deformity_comment=$deformity_rd['other_deformity'];
		}
		$deformity->insert();
		$deformity->free_statement();
		$individual_archive->disability=2;
	}
}


?>