<?php

/**
     *  更新门诊病历
     *
     * @param string $hospital_id
     * @param string $doctor_id
     * @param string $id_card
     * @param string $diagnosis_time
     * @param string $diagnosis
     * @param string $patient_history1
     * @param string $remark
     * @return bool
     */
function update_patient_history($hospital_id,$doctor_id,$id_card,$diagnosis_time,$diagnosis,$patient_history1='',$remark=''){
	$num=func_num_args();
	if($num<7){
		throw new Exception('参数错误！');
	}

	//===机构===
	$org_id=getOrganize($hospital_id);//取得机构代码
	if(empty($org_id)){
		throw new Exception('参数$hospital_id错误');
	}
	//====医生===
	require_once(__SITEROOT.'library/Models/staff_core.php');//用户信息主表
	$staff_core=new Tstaff_core();
	$staff_core->whereAdd("org_id='{$org_id}'");//权
	$staff_core->whereAdd("standard_code='{$doctor_id}'");//个人标准代码
	$num=$staff_core->count();
	if($num!=1){
		throw new Exception('参数$doctor_id错误');
	}
	$staff_core=new Tstaff_core();
	$staff_core->whereAdd("org_id='{$org_id}'");//权
	$staff_core->whereAdd("standard_code='{$doctor_id}'");//个人标准代码
	$staff_core->find();
	$staff_core->fetch();
	$staff_id=$staff_core->id;//医生ID
	//====个人基本信息
	require_once(__SITEROOT.'library/Models/individual_core.php');//个人基本信息
	$individual_core =new Tindividual_core();
	//$individual_core->whereAdd("identity_type=1");
	$individual_core->whereAdd("identity_number='{$id_card}'");//身份证号
	//$individual_core->debugLevel(3);
	$count=$individual_core->count();
	if($count!=1){
		throw new Exception('参数$id_card错误');
	}
	$individual_core =new Tindividual_core();
	//$individual_core->whereAdd("identity_type=1");
	$individual_core->whereAdd("identity_number='{$id_card}'");//身份证号
	$individual_core->find();
	$individual_core->fetch();
	$serial_number=$individual_core->uuid;

	//====门诊病历======
	//echo $diagnosis_time;
	$diagnosis_time=strtotime($diagnosis_time);//转成时间戳
	//echo $diagnosis_time;
	//  exit();
	require_once(__SITEROOT.'library/Models/patient_history.php');//门诊病历
	$patient_history=new Tpatient_history();
	$patient_history->whereAdd("hospital_id='{$org_id}'");//机构ID
	//$patient_history->whereAdd("doctor_id='$staff_id'");//医生ID
	$patient_history->whereAdd("id_card='$id_card'");//身份证号
	$patient_history->whereAdd("diagnosis_time=$diagnosis_time");//就诊日期
	//$patient_history->debugLevel(3);
	$count=$patient_history->count();
	//echo $count;
	if($count>0){
		//记录存在、不允许再添加
	}else{

		$patient_history=new Tpatient_history();

		$patient_history->uuid = uniqid('ph',true);//

		$patient_history->hospital_id = $org_id;//医院id

		$patient_history->doctor_id = $staff_id;//医生ID

		$patient_history->id_card = $id_card;//身份证号

		$patient_history->diagnosis_time = $diagnosis_time;//就诊日期

		$patient_history->diagnosis = $diagnosis;//诊段结果（icd-10）

		$patient_history->patient_history = $patient_history1;//门诊病历小结

		$patient_history->remark = $remark;//备注

		$patient_history->serial_number=$serial_number;//个人档案号

		$result=false;

		if($patient_history->insert()){

			$result= true;

		}else{
			throw new Exception('');

		}
		return $result;

	}
}





/**
    * 更新出院证明
    *
    * @param string $hospital_id
    * @param string $doctor_id
    * @param string $id_card
    * @param string $admission_time
    * @param string $discharged_time
    * @param string $diagnosis
    * @param string $suggestion
    * @param string $remark
    * @return bool
    */
function update_hos_discharge_certificate($hospital_id,$doctor_id,$id_card,$admission_time,$discharged_time,$diagnosis='',$suggestion='',$remark=''){

	$num=func_num_args();
	if($num<8){
		throw new Exception('参数错误！');
	}
	//===机构===
	$org_id=getOrganize($hospital_id);//取得机构代码
	if(empty($org_id)){
		throw new Exception('参数$hospital_id错误');
	}
	//====医生===
	require_once(__SITEROOT.'library/Models/staff_core.php');//用户信息主表
	$staff_core=new Tstaff_core();
	$staff_core->whereAdd("org_id='{$org_id}'");//权
	$staff_core->whereAdd("standard_code='{$doctor_id}'");//个人标准代码
	$num=$staff_core->count();
	if($num!=1){
		throw new Exception('参数$doctor_id错误');
	}
	$staff_core=new Tstaff_core();
	$staff_core->whereAdd("org_id='{$org_id}'");//权
	$staff_core->whereAdd("standard_code='{$doctor_id}'");//个人标准代码
	$staff_core->find();
	$staff_core->fetch();
	$staff_id=$staff_core->id;//医生ID
	//====个人基本信息
	require_once(__SITEROOT.'library/Models/individual_core.php');//个人基本信息
	$individual_core =new Tindividual_core();
	//$individual_core->whereAdd("identity_type=1");
	$individual_core->whereAdd("identity_number='{$id_card}'");//身份证号
	$count=$individual_core->count();
	if($count!=1){
		throw new Exception('参数$id_card错误');
	}
	$individual_core =new Tindividual_core();
	//$individual_core->whereAdd("identity_type=1");
	$individual_core->whereAdd("identity_number='{$id_card}'");//身份证号
	//$individual_core->debugLevel(3);
	$individual_core->find();
	$individual_core->fetch();
	$serial_number=$individual_core->uuid;

	//=====出院证明====
	$admission_time=strtotime($admission_time);
	$discharged_time=strtotime($discharged_time);
	require_once(__SITEROOT.'library/Models/hos_discharge_certificate.php');//出院证明
	$hos_discharge_certificate=new Thos_discharge_certificate();
	$hos_discharge_certificate->whereAdd("hospital_id='{$org_id}'");//机构ID
	//$hos_discharge_certificate->whereAdd("doctor_id='$staff_id'");//医生ID
	$hos_discharge_certificate->whereAdd("id_card='$id_card'");//身份证号
	$hos_discharge_certificate->whereAdd("admission_time=$admission_time");//入院日期
	$hos_discharge_certificate->whereAdd("discharged_time=$discharged_time");//出院日期
	if($hos_discharge_certificate->count()>0){
		//记录存在、不允许再添加
	}else{
		$hos_discharge_certificate=new Thos_discharge_certificate();

		$hos_discharge_certificate->uuid = uniqid('ph',true);//

		$hos_discharge_certificate->hospital_id = $org_id;//医院id

		$hos_discharge_certificate->doctor_id = $staff_id;//医生ID

		$hos_discharge_certificate->id_card = $id_card;//身份证号

		$hos_discharge_certificate->admission_time = $admission_time;//入院日期

		$hos_discharge_certificate->discharged_time = $discharged_time;//出院日期

		$hos_discharge_certificate->diagnosis = $diagnosis;//诊断小结

		$hos_discharge_certificate->suggestion = $suggestion;//出院医嘱建议

		$hos_discharge_certificate->remark = $remark;//备注

		$hos_discharge_certificate->serial_number=$serial_number;//个人档案号

		$result=false;

		if($hos_discharge_certificate->insert()){
			$result= true;
		}
		return $result;
	}

}
/**
 * 转诊接口 $org_id 机构标准代码，$identity_card_number医生身份证号，$machine_code机器码
 *
 * @param string $org_id
 * @param string $identity_card_number
 * @param string $machine_code
 * @return array
 */
function patient_referral($org_id,$identity_card_number,$machine_code){
	$num=func_num_args();
	if($num<3){
		throw new Exception('参数错误！');
	}
	//==========start 根据机构代码中标准代码得到内部机构id=======
	require_once(__SITEROOT.'library/Models/organization.php');
	$organization	= new Torganization();//机构代码表
	$organization->whereAdd("standard_code='$org_id'");
	$num			= $organization->count();//记录数
	if($num!=1){
		throw new Exception("机构代码出错,代码号$org_id");
	}
	$organization->find();
	$organization->fetch();
	$org_id			= $organization->id;//内部机构代码
	$organization->free_statement();

	//===========end  根据机构代码中标准代码得到内部机构id=======
	//===========start 由医生身份证代码得到医生内部代码=======
	require_once(__SITEROOT.'library/Models/staff_archive.php');//医生信息扩展表
	$staff_archive	= new Tstaff_archive();
	$staff_archive->whereAdd("identity_card_number='$identity_card_number'");//

	$num			= $staff_archive->count();//记录数
	if($num!=1){
		throw new Exception("医生身份证代码出错,证件号$identity_card_number");
	}
	$staff_archive->find();
	$staff_archive->fetch();
	$doctor_id		=	$staff_archive->user_id;//医生内部代码
	$staff_archive->free_statement();
	//===========end   由医生身份证代码得到医生内部代码=======

	//===========start 机器码处理======
	//===========end   机器码处理======

	//
	require_once(__SITEROOT.'library/Models/patient_referral_out.php');
	require_once(__SITEROOT.'library/Models/patient_referral_in.php');
	$patient_referral_out	= new Tpatient_referral_out();//转诊转出
	$patient_referral_in	= new Tpatient_referral_in();//转诊回转
	$patient_referral_out->joinAdd('left',$patient_referral_out,$patient_referral_in,'id','id');
	$patient_referral_out->whereAdd("patient_referral_out.stub_unit='$org_id'");//转入机构代码
	$patient_referral_out->whereAdd("patient_referral_out.in_of_doctor='$doctor_id'");//转入医生代码
	//$patient_referral_out->whereAdd("patient_referral_out.in_of_doctor='$identity_card_number'");//转入医生代码
	$patient_referral_out->whereAdd("patient_referral_in.referral_in_time is null OR patient_referral_out.referral_out_time>patient_referral_in.referral_in_time");
	$patient_referral_out->orderby("patient_referral_out.referral_out_time DESC");
	$patient_referral_out->limit(0,10);
	//$patient_referral_out->debugLevel(2);
	$patient_referral_out->find();
	$result=array();//结果
	$i=0;
	while ($patient_referral_out->fetch()) {
		require_once(__SITEROOT.'library/custom/comm_function.php');
		$individual							= get_individual_info($patient_referral_out->id);
		$result[$i]['name']					= $individual->name;//患者姓名
		$result[$i]['sex']					= $patient_referral_out->sex;//性别
		$result[$i]['age']					= $patient_referral_out->age;//年龄
		$result[$i]['address']				= $patient_referral_out->address;//家庭地地址
		$result[$i]['phone_number']			= $patient_referral_out->phone_number;//联系电话
		$referral_out_time					= $patient_referral_out->referral_out_time;//转诊日期
		$result[$i]['referral_time']		= $referral_out_time?date("Y-m-d",$referral_out_time):'';//转诊日期
		$result[$i]['firefight']			= $patient_referral_out->firefight;//初步诊断
		$result[$i]['present_illness']		= $patient_referral_out->present_illness;//主要现病史(转出原因)
		$result[$i]['past_history']			= $patient_referral_out->past_history;//主要既往史
		$result[$i]['course_and_treatment'] = $patient_referral_out->course_and_treatment;//治疗经过
		$org_obj							= get_org_info($patient_referral_out->my_org_name);//机构信息
		$result[$i]['org_name']				= $org_obj->zh_name;//转出机构
		$staff_obj							= get_staff_info($patient_referral_out->out_of_doctor);//医生信息
		$result[$i]['doctor_name']			= $staff_obj[1]->name_real;//转出医生名
	}
	$patient_referral_out->free_statement();

	return $result;

}

/**
     * 根据机构中的standard_code找到机构中的id
     *
     * @param string $stand_code
     * @return string org_id
     */
function getOrganize($stand_code=''){
	if(empty($stand_code)){
		throw new Exception('参数错误！');

	}
	require_once(__SITEROOT.'library/Models/organization.php');
	$organization=new Torganization();
	$organization->whereAdd("standard_code='{$stand_code}'");
	$count=$organization->count();
	if($count!=1){
		throw new Exception('在机构表中找不到standard_code的值,或者值不是唯一！');
	}
	$organization=new Torganization();
	$organization->whereAdd("standard_code='{$stand_code}'");
	$organization->find();
	$organization->fetch();
	return $organization->id;

}


/**
 * 临时中联电子病历接口
 * @param string $org_id
 * @param string $identity_number
 * @param string $department
 * @param string $bed_no
 * @param string $admission_number
 * @param string $name
 * @param string $gender
 * @param string $age
 * @param string $birthplace
 * @param string $marital_status
 * @param string $occupation
 * @param string $address
 * @param string $race
 * @param string $admission_time
 * @param string $medical_records_time
 * @param string $history_narrator
 * @param string $reliability
 * @param string $complaints
 * @param string $present_illness
 * @param string $past_history
 * @param string $personal_history
 * @param string $menstrual_history
 * @param string $obsterical_history
 * @param string $family_history
 * @param string $physical_t
 * @param string $physical_p
 * @param string $physical_r
 * @param string $physical_bp_p
 * @param string $physical_bp_s
 * @param string $physical_general
 * @param string $physical_skin
 * @param string $physical_lymphaden
 * @param string $physical_head
 * @param string $physical_neck
 * @param string $physical_chest
 * @param string $physical_vein
 * @param string $examie_ecg
 * @param string $examine_electrolyte
 * @param string $examine_blood_sugar
 * @param string $examine_blood
 * @param string $examine_heart_cdus
 * @param string $examine_sternum
 * @param string $primary_diagnosis
 * @param string $housestaff
 * @param string $housestaff_time
 * @param string $visiting_doctor
 * @param string $visiting_doctor_time
 * @return boolean
 */
function update_emr($org_id='',$identity_number='',$department='',$bed_no='',$admission_number='',$name='',$gender='',$age='',$birthplace='',$marital_status='',$occupation='',$address='',$race='',$admission_time='',$medical_records_time='',$history_narrator='',$reliability='',$complaints='',$present_illness='',$past_history='',$personal_history='',$menstrual_history='',$obsterical_history='',$family_history='',$physical_t='',$physical_p='',$physical_r='',$physical_bp_p='',$physical_bp_s='',$physical_general='',$physical_skin='',$physical_lymphaden='',$physical_head='',$physical_neck='',$physical_chest='',$physical_vein='',$examie_ecg='',$examine_electrolyte='',$examine_blood_sugar='',$examine_blood='',$examine_heart_cdus='',$examine_sternum='',$primary_diagnosis='',$housestaff='',$housestaff_time='',$visiting_doctor='',$visiting_doctor_time=''){
	require_once(__SITEROOT.'library/Models/zaojia_emr.php');
	$zaojia_emr= new Tzaojia_emr();

	$zaojia_emr->uuid = uniqid("zj",true);//唯一序号
	
	$zaojia_emr->org_id = $org_id;//机构号
	$zaojia_emr->identity_number = $identity_number;//身份证号

	$zaojia_emr->department = $department;//科室

	$zaojia_emr->bed_no = $bed_no;//床号

	$zaojia_emr->admission_number = $admission_number;//住院号

	$zaojia_emr->name = $name;//姓名

	$zaojia_emr->gender = $gender;//性别

	$zaojia_emr->age = $age;//年龄

	$zaojia_emr->birthplace = $birthplace;//出生地

	$zaojia_emr->marital_status = $marital_status;//婚姻

	$zaojia_emr->occupation = $occupation;//职业

	$zaojia_emr->address = $address;//住址

	$zaojia_emr->race = $race;//民族

	$zaojia_emr->admission_time = $admission_time;//入院时间

	$zaojia_emr->medical_records_time = $medical_records_time;//病历记录时间

	$zaojia_emr->history_narrator = $history_narrator;//病历叙述者

	$zaojia_emr->reliability = $reliability;//叙述可靠性

	$zaojia_emr->complaints = $complaints;//主叙

	$zaojia_emr->present_illness = $present_illness;//现病史

	$zaojia_emr->past_history = $past_history;//既往史

	$zaojia_emr->personal_history = $personal_history;//个人史

	$zaojia_emr->menstrual_history = $menstrual_history;//月经史

	$zaojia_emr->obsterical_history = $obsterical_history;//婚育史

	$zaojia_emr->family_history = $family_history;//家族史

	$zaojia_emr->physical_t = $physical_t;//体格检查-体温

	$zaojia_emr->physical_p = $physical_p;//体格检查-脉搏

	$zaojia_emr->physical_r = $physical_r;//体格检查-呼吸

	$zaojia_emr->physical_bp_p = $physical_bp_p;//体格检查-收缩压

	$zaojia_emr->physical_bp_s = $physical_bp_s;//体格检查-舒张压

	$zaojia_emr->physical_general = $physical_general;//体格检查-一般情况

	$zaojia_emr->physical_skin = $physical_skin;//体格检查-皮肤粘膜

	$zaojia_emr->physical_lymphaden = $physical_lymphaden;//体格检查-淋巴结

	$zaojia_emr->physical_head = $physical_head;//体格检查-头颅

	$zaojia_emr->physical_neck = $physical_neck;//体格检查-颈部

	$zaojia_emr->physical_chest = $physical_chest;//体格检查-胸部

	$zaojia_emr->physical_vein = $physical_vein;//体格检查-周围血管征

	$zaojia_emr->examie_ecg = $examie_ecg;//辅助检查-心电图

	$zaojia_emr->examine_electrolyte = $examine_electrolyte;//辅助检查-肾功电解质

	$zaojia_emr->examine_blood_sugar = $examine_blood_sugar;//辅助检查-血糖

	$zaojia_emr->examine_blood = $examine_blood;//辅助检查-血常规

	$zaojia_emr->examine_heart_cdus = $examine_heart_cdus;//辅助检查-心彩超

	$zaojia_emr->examine_sternum = $examine_sternum;//辅助检查-胸片

	$zaojia_emr->primary_diagnosis = $primary_diagnosis;//初步诊断

	$zaojia_emr->housestaff = $housestaff;//住院医生

	$zaojia_emr->housestaff_time = $housestaff_time;//住院医生日期

	$zaojia_emr->visiting_doctor = $visiting_doctor;//主治医生

	$zaojia_emr->visiting_doctor_time = $visiting_doctor_time;//主治医生日期
	$return_token=false;
	if($zaojia_emr->insert()){
		$return_token=true;
	}else{
		$return_token=false;
	}
	return $return_token;
}
/**
 * 检验报告表

 *
 * @param string $lis_id
 * @param string $org_id
 * @param string $identity_number
 * @param string $name
 * @param string $gender
 * @param string $age
 * @param string $outpatient
 * @param string $spe_number
 * @param string $spe_type
 * @param string $departments
 * @param string $bed_number
 * @param string $medical_doctor
 * @param string $test_equipment
 * @param string $created
 * @param string $remarks
 * @return boolean
 */
function update_clinic_lab_exam($lis_id,$org_id='',$identity_number='',$name='',$gender='',$age='',$outpatient='',$spe_number='',$spe_type='',$departments='',$bed_number='',$medical_doctor='',$test_equipment='',$created='',$remarks=''){
	if(!isset($lis_id) || $lis_id==''){
		throw new Exception("检验单号不能为空");
	}
	require_once(__SITEROOT.'library/Models/zj_clinic_lab_exam.php');
	$zj_clinic_lab_exam = new Tzj_clinic_lab_exam();
	$zj_clinic_lab_exam->whereAdd("lis_id='$lis_id'");
	$count=$zj_clinic_lab_exam->count("*");	
	$zj_clinic_lab_exam->free_statement();
	if($count>0){
		throw new Exception("检验单号重复");
	}
	$zj_clinic_lab_exam = new Tzj_clinic_lab_exam();
	$zj_clinic_lab_exam->uuid = uniqid('zj_',true);//
	$zj_clinic_lab_exam->$org_id;
	$zj_clinic_lab_exam->$identity_number;
	$zj_clinic_lab_exam->name = $name;//姓名
	$zj_clinic_lab_exam->gender = $gender;//性别
	$zj_clinic_lab_exam->age = $age;//年龄

	$zj_clinic_lab_exam->outpatient = $outpatient;//门诊ID

	$zj_clinic_lab_exam->spe_number = $spe_number;//标本序号

	$zj_clinic_lab_exam->spe_type = $spe_type;//标本种类

	$zj_clinic_lab_exam->departments = $departments;//科室名称

	$zj_clinic_lab_exam->bed_number = $bed_number;//床号

	$zj_clinic_lab_exam->medical_doctor = $medical_doctor;//申请医生

	$zj_clinic_lab_exam->test_equipment = $test_equipment;//检验仪器	

	$zj_clinic_lab_exam->lis_id = $lis_id;//检验单号

	$zj_clinic_lab_exam->created = $created;//采样日期

	$zj_clinic_lab_exam->remarks = $remarks;//备注
	$return_token=false;
	if($zj_clinic_lab_exam->insert()){
		$return_token=true;
	}else{
		$return_token=false;
	}
	return $return_token;
	
}
/**
 * 检验报告指标
 *
 * @param string $lis_id
 * @param string $org_id
 * @param string $identity_number
 * @param string $zh_name
 * @param string $en_name
 * @param string $exam_result
 * @param string $exam_unit
 * @param string $reference
 * @return boolean
 */
function update_indicators($lis_id,$org_id='',$identity_number='',$zh_name='',$en_name='',$exam_result='',$exam_unit='',$reference=''){
	if(!isset($lis_id) || $lis_id==''){
		throw new Exception("检验单号不能为空");
	}
	require_once(__SITEROOT.'library/Models/zj_clinic_lab_exam.php');	
	$zj_clinic_lab_exam = new Tzj_clinic_lab_exam();
	$zj_clinic_lab_exam->whereAdd("lis_id='$lis_id'");
	$count=$zj_clinic_lab_exam->count('*');
	if($count!=1){
		throw new Exception('检验单号不存在！');
	}
	$zj_clinic_lab_exam->free_statement();
	require_once(__SITEROOT.'library/Models/zj_indicators.php');
	
	$zj_indicators=new Tzj_indicators();
	
	$zj_indicators->uuid = uniqid('zj',true);//
	
	$zj_indicators->org_id =$org_id;
	$zj_indicators->identity_number =$identity_number;
	$zj_indicators->zh_name = $zh_name;//检查指标中文名称

	$zj_indicators->en_name = $en_name;//检查指标英文名称

	$zj_indicators->exam_result = $exam_result;//检查结果

	$zj_indicators->exam_unit = $exam_unit;//计量单位

	$zj_indicators->reference = $reference;//参考值

	$zj_indicators->lis_id = $lis_id;//检验单号
	$return_token=false;
	if($zj_indicators->insert()){
		$return_token=true;
	}else{
		$return_token=false;
	}
	return $return_token;
}