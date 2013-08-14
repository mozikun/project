<?php
/* 
* Created By Eric_Zhou
* Filename: premaritalController.php
* Date : 2010-09-21
* Summary : 婚前医学检查(http://host/premarital/)
*/
class premaritalController extends controller{
	public function init(){
		require_once __SITEROOT.'library/privilege.php';
		require_once __SITEROOT.'library/custom/adodb-time.inc.php';
		require_once __SITEROOT.'library/custom/comm_function.php';
		require_once __SITEROOT."library/custom/pager.php";
		$this->view->basePath = $this->_request->getBasePath();

		require_once(__SITEROOT.'library/Models/premarital_examination.php');//婚检主表
		require_once(__SITEROOT.'library/Models/pe_physical.php');//体格检查
		require_once(__SITEROOT.'library/Models/pe_second_sex_male.php');//第二性征男
		require_once(__SITEROOT.'library/Models/pe_second_sex_female.php');//第二性征女
		require_once(__SITEROOT.'library/Models/pe_lab_examination.php');//实验室及特殊检查
		require_once(__SITEROOT.'library/Models/pe_health_advisory.php');//婚前卫生咨询
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/family_archive.php";
		require_once __SITEROOT."library/Models/organization.php";
		require_once(__SITEROOT.'library/Models/region.php');
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
	}
	/**
	 * 列表
	 *
	 */
	public function listAction(){
		//搜索条件
		$search = array();
		$search['username']=$this->_request->getParam('username');//姓名包含拼音
		$search['standard_code']=$this->_request->getParam('standard_code');//档案号
		$search['identity_number']=$this->_request->getParam('identity_number');//身份证号
		$search['staff_id']=$this->_request->getParam('staff_id');//责任医生
		
		$individual_session=new Zend_Session_Namespace("individual_core");
		//医生列表
		$org_region_domain=$this->user['current_region_path_domain'];
		$temp=explode("|",$org_region_domain);
		$diabetes_core_region_path_domain='';
		$staff_core_region_path_domain='';
		foreach ($temp as $k1=>$v1){
			$diabetes_core_region_path_domain=$diabetes_core_region_path_domain.
				"individual_core.region_path like '".$v1."%' or ";
			$staff_core_region_path_domain=$staff_core_region_path_domain.
				"staff_core.region_path like '".$v1."%' or ";
		}
		$diabetes_core_region_path_domain=rtrim($diabetes_core_region_path_domain,' or ');
		$staff_core_region_path_domain=rtrim($staff_core_region_path_domain,' or ');
		$staff_core=new Tstaff_core();
		$staff_archive=new Tstaff_archive();
		$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
		$staff_core->whereAdd($staff_core_region_path_domain);
		$staff_core->find();
		$responseDoctorArray=array();
		$responseDoctorArray[0]['zh_name']='请选择';
		$responseDoctorArray[0]['id']='-9';
		$counter=1;
		while ($staff_core->fetch()) {
			$responseDoctorArray[$counter]['zh_name']=$staff_archive->name_real;
			$responseDoctorArray[$counter]['id']=$staff_core->id;
			if ($search['staff_id']==$staff_core->id){
				$responseDoctorArray[$counter]['selected']='selected';
			}else{
				$responseDoctorArray[$counter]['selected']='';
			}
			$counter++;
		}
		$pe = new Tpremarital_examination();
		$core=new Tindividual_core();
		$pe->whereAdd($diabetes_core_region_path_domain);
		$pe->joinAdd('left',$pe,$core,'id','uuid');
		if($search['username']){
			$pe->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if($search['standard_code']){
			$pe->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$pe->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
		if ($search['staff_id'] && $search['staff_id'] != '-9')
		{
			$pe->whereAdd("premarital_examination.staff_id = '".$search['staff_id']."'");
		}
		
		$nums=$pe->count("distinct premarital_examination.id");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		$arg = array();
		//new subpages(每页显示条数，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,
			__BASEPATH.'premarital/index/index/page/',2,$arg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$pe->selectAdd("premarital_examination.id as id,premarital_examination.staff_id as staff_id,individual_core.standard_code_1,individual_core.identity_number,individual_core.name as name,individual_core.name_pinyin as name_pinyin,premarital_examination.fill_time");
		$pe->groupBy("premarital_examination.id,individual_core.name,individual_core.name_pinyin,premarital_examination.staff_id,individual_core.standard_code_1,individual_core.identity_number,premarital_examination.fill_time");
		$pe->orderby("premarital_examination.fill_time  DESC");
		$pe->limit($startnum,__ROWSOFPAGE);
		$pe->find();
		$exam_list_arr = array();
		$i = 0;
		while($pe->fetch()){
			$exam_list_arr[$i]['id'] = $pe->id;
			$exam_list_arr[$i]['indent'] = $pe->identity_number;
			$exam_list_arr[$i]['name'] = $pe->name;
			$exam_list_arr[$i]['moreinfo'] = get_moreinfo_premarital_examination($pe->id);
			$i++;
		}
		$out = $links->subPageCss2();
		$this->view->assign('exam_list',$exam_list_arr);
		$this->view->assign('response_doctor',$responseDoctorArray);
		$this->view->assign("pager",$out);
		$this->view->display('index.html');
	}
	/**
	 * 添加、修改页面
	 *
	 */
	public function addAction(){
		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		require_once(__SITEROOT.'library/custom/region_array.php');

		$aid=$this->_request->getParam('aid');//记录的id;
		//print_r($this->user);
		
		$doctor_current_id = $this->user['uuid'];//当前医生id
		$individual_session=new Zend_Session_Namespace("individual_core");
		$id = empty($individual_session->uuid)?'':$individual_session->uuid;//个人档案ID
		//exit(var_dump($individual_session->uuid));
		if(!empty($aid)){
			$this->view->aid = $aid;
			$individual_inf=get_individual_info($aid);//取得个人信息中所有信息
		}else{
			if(empty($individual_session->staff_id)){
				$url=array("婚前医学检查列表"=>__BASEPATH.'premarital/premarital/list',
					"进入个人档案列表"=>__BASEPATH.'iha/index/index');
				message("请在个人档案列表双击选中居民",$url);
			}
			//2012-02-21仅查询正常档案
			if($individual_session->status_flag!=1){
	            message("你选择了一个非正常档案，请重新选择",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
	        }	
			$individual_inf=get_individual_info($individual_session->uuid);//取得个人信息中所有信息
		}
		$sex = empty($individual_inf->sex)?'':$individual_inf->sex;//性别
	
		//====================婚检主表
		//血缘关系|radio|1=>无,2=>表,3=>堂,4=>其他

		$blood_kinship=array('1'=>'无','2'=>'表','3'=>'堂','4'=>'其他');
		$this->view->blood_kinship_options =$blood_kinship; //血缘关系|radio|1=>无,2=>表,3=>堂,4=>其他

		//过去病史|checkbox|1=>无,2=>心脏病,3=>肺结核,4=>肝脏病,5=>泌尿生殖系疾病,6=>糖尿病,7=>高血压,8=>精神病,9=>性病,10=>癫痫,11=>甲亢,12=>先天疾患

		$past_disease_history=array('1'=>'无','2'=>'心脏病','3'=>'肺结核','4'=>'肝脏病','5'=>'泌尿生殖系疾病','6'=>'糖尿病','7'=>'高血压','8'=>'精神病','9'=>'性病','10'=>'癫痫','11'=>'甲亢','12'=>'先天疾患');
		$this->view->past_disease_history_options =$past_disease_history; //过去病史|checkbox|1=>无,2=>心脏病,3=>肺结核,4=>肝脏病,5=>泌尿生殖系疾病,6=>糖尿病,7=>高血压,8=>精神病,9=>性病,10=>癫痫,11=>甲亢,12=>先天疾患

		//手术史|radio|1=>无,2=>有

		$operation_history=array('1'=>'无','2'=>'有');
		$this->view->operation_history_options =$operation_history; //手术史|radio|1=>无,2=>有

		//现病史|radio|1=>无,2=>有

		$present_disease_history=array('1'=>'无','2'=>'有');
		$this->view->present_disease_history_options =$present_disease_history; //现病史|radio|1=>无,2=>有

		//月经量|radio|1=>多,2=>中,3=>少

		$menstruation=array('1'=>'多','2'=>'中','3'=>'少');
		$this->view->menstruation_options =$menstruation; //月经量|radio|1=>多,2=>中,3=>少

		//既往婚育史|radio|1=>无,2=>有

		$fertile_history=array('1'=>'无','2'=>'有');
		$this->view->fertile_history_options =$fertile_history; //既往婚育史|radio|1=>无,2=>有

		//:既往婚育史内容|radio|1=>丧偶,2=>离异

		$fertile_history_info=array('1'=>'丧偶','2'=>'离异');
		$this->view->fertile_history_info_options =$fertile_history_info; //既往婚育史内容|radio|1=>丧偶,2=>离异

		//表注释:与遗传有关的家族史|checkbox|1=>无,2=>盲,3=>聋,4=>哑,5=>精神病,6=>先天性智力低下,7=>先天性心脏病,8=>血友病,9=>糖尿病,10=>其他

		$family_history=array('1'=>'无','2'=>'盲','3'=>'聋','4'=>'哑','5'=>'精神病','6'=>'先天性智力低下','7'=>'先天性心脏病','8'=>'血友病','9'=>'糖尿病','10'=>'其他');
		$this->view->family_history_options =$family_history; //与遗传有关的家族史|checkbox|1=>无,2=>盲,3=>聋,4=>哑,5=>精神病,6=>先天性智力低下,7=>先天性心脏病,8=>血友病,9=>糖尿病,10=>其他

		// 表注释:家族近亲婚配|radio|1=>无,2=>有

		$family_inbreeding=array('1'=>'无','2'=>'有');
		$this->view->family_inbreeding_options =$family_inbreeding; //家族近亲婚配|radio|1=>无,2=>有

		// 表注释:家族近亲婚配内容|radio|1=>父母,2=>祖父母,3=>外祖父母

		$family_inbreeding_info=array('1'=>'父母','2'=>'祖父母','3'=>'外祖父母');
		$this->view->family_inbreeding_info_options =$family_inbreeding_info; //家族近亲婚配内容|radio|1=>父母,2=>祖父母,3=>外祖父母

		if(empty($aid)){
			//添加页面
			
			if(!($sex=='2' or $sex=='3')){
				message("你选择的档案没有指定性别",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}

			$this->view->staff_id = $doctor_current_id;//医生档案号
			//$this->view->id = $premarital_examination->id;//个人档案号
			$this->view->signature_doctor_examination = $this->user['name_real'];
			//$this->view->signature_of_doctor = $doctor_current_id;//医师签名

			$this->view->md_signature = $this->user['name_real'];//主检医师签名
			$_time = date('Y-m-d',time());
			$this->view->fill_time = $_time;//添加时间
			$this->view->referral_time = $_time;//转诊日期
			$this->view->return_visit_time = $_time;//预约复诊日期
			$this->view->cpe_time = $_time;//出具《婚前医学检查证明》日期
		}else{
			//修改页面
			$premarital_examination=new Tpremarital_examination();
			$premarital_examination->whereAdd("id='{$aid}'");
			$premarital_examination->find();
			$premarital_examination->fetch();
			$individual_id=$premarital_examination->id;
			if(empty($individual_id)){
				message("参数错误",array("婚检列表"=>__BASEPATH.'premarital/index/list'));
			}
			$this->view->signature_doctor_examination = $premarital_examination->signature_of_doctor;//医生签名
			$this->view->md_signature = $premarital_examination->md_signature;//主检医生
			$this->view->uuid = $premarital_examination->uuid;//编号
			$this->view->staff_id = $premarital_examination->staff_id;//医生档案号
			$this->view->id = $premarital_examination->id;//个人档案号
			$this->view->created = $premarital_examination->created;//添加记录时间
			$this->view->fill_time = date('Y-m-d',$premarital_examination->fill_time);//填写日期
			$this->view->name_of_the_partner = $premarital_examination->name_of_the_partner;//对方姓名
			$this->view->sn_of_the_partner = $premarital_examination->sn_of_the_partner;//对方编号
			$this->view->follow_time_year = date('Y',$premarital_examination->date_of_examination);//检查日期
			$this->view->follow_time_month = date('m',$premarital_examination->date_of_examination);//检查日期
			$this->view->follow_time_day = date('d',$premarital_examination->date_of_examination);//检查日期
			

			$this->view->blood_kinship_current = $premarital_examination->blood_kinship;//血缘关系|radio|1=>无,2=>表,3=>堂,4=>其他
			$this->view->blood_kinship_other = $premarital_examination->blood_kinship_other;//血缘关系其他
			$this->view->past_disease_history_current = $premarital_examination->past_disease_history;//过去病史|checkbox|1=>无,2=>心脏病,3=>肺结核,4=>肝脏病,5=>泌尿生殖系疾病,6=>糖尿病,7=>高血压,8=>精神病,9=>性病,10=>癫痫,11=>甲亢,12=>先天疾患
			$this->view->past_disease_history_other = $premarital_examination->past_disease_history_other;//过去病史其他

			$this->view->operation_history_current = $premarital_examination->operation_history;//手术史|radio|1=>无,2=>有
			$this->view->operation_history_other = $premarital_examination->operation_history_other;//手术史其它

			$this->view->present_disease_history_current = $premarital_examination->present_disease_history;//现病史|radio|1=>无,2=>有
			$this->view->present_disease_history_info = $premarital_examination->present_disease_history_info;//现病史内容
			$this->view->age_of_menarche = $premarital_examination->age_of_menarche;//初潮年龄
			$this->view->menstrual_period = $premarital_examination->menstrual_period;//经期
			$this->view->menstrual_cycle = $premarital_examination->menstrual_cycle;//周期

			$this->view->menstruation_current = $premarital_examination->menstruation;//月经量|radio|1=>多,2=>中,3=>少
			$this->view->dysmenorrhea = $premarital_examination->dysmenorrhea;//痛经
			//$this->view->lmp_time = $premarital_examination->lmp_time;//末次月经
//var_dump($premarital_examination->lmp_time);
			$this->view->lmp_time_y = date('Y',$premarital_examination->lmp_time);
			$this->view->lmp_time_m = date('m',$premarital_examination->lmp_time);
			$this->view->lmp_time_d = date('d',$premarital_examination->lmp_time);
			$this->view->fertile_history_current = $premarital_examination->fertile_history;//既往婚育史|radio|1=>无,2=>有

			$this->view->fertile_history_info_current = $premarital_examination->fertile_history_info;//既往婚育史内容|radio|1=>丧偶,2=>离异
			$this->view->fh_term = $premarital_examination->fh_term;//足月产
			$this->view->fh_preterm = $premarital_examination->fh_preterm;//早产
			$this->view->fh_abortion = $premarital_examination->fh_abortion;//流产
			$this->view->number_of_children = $premarital_examination->number_of_children;//子女数

			$this->view->family_history_current = $premarital_examination->family_history;//与遗传有关的家族史|checkbox|1=>无,2=>盲,3=>聋,4=>哑,5=>精神病,6=>先天性智力低下,7=>先天性心脏病,8=>血友病,9=>糖尿病,10=>其他
			$this->view->family_history_other = $premarital_examination->family_history_other;//与遗传有关的家族史其他
			$this->view->relationship_with_patient = $premarital_examination->relationship_with_patient;//患者与本人关系

			$this->view->family_inbreeding_current = $premarital_examination->family_inbreeding;//家族近亲婚配|radio|1=>无,2=>有

			$this->view->family_inbreeding_info_current = $premarital_examination->family_inbreeding_info;//家族近亲婚配内容|radio|1=>父母,2=>祖父母,3=>外祖父母
			$this->view->signature_of_doctor = $premarital_examination->signature_of_doctor;//医师签名
			$this->view->referral_hospital = $premarital_examination->referral_hospital;//转诊医院
			$this->view->referral_time = date('Y-m-d',$premarital_examination->referral_time);//转诊日期
			$this->view->return_visit_time = date('Y-m-d',$premarital_examination->return_visit_time);//预约复诊日期
			$this->view->cpe_time = date('Y-m-d',$premarital_examination->cpe_time);//出具《婚前医学检查证明》日期
			$this->view->md_signature = $premarital_examination->md_signature;//主检医师签名
		}
		$this->view->name = $individual_inf->name;
		$this->view->date_of_birth = date('Y-m-d',$individual_inf->date_of_birth);
		$this->view->identity_number = $individual_inf->identity_number;
		$this->view->address = $individual_inf->address;
		//民族
		if(array_search_for_other($individual_inf->race,$race) != 1){
			$curr_race = $races[$individual_inf->race_detail][1];		
		}else{
			$curr_race = $race[array_search_for_other($individual_inf->race,$race)][1];
		}
		$this->view->curr_race = $curr_race;
		//扩展信息 单位或职业
		$individual_archive = new Tindividual_archive();
		$t_id = empty($aid) ? $id : $aid;
		$individual_archive->whereAdd("id='$t_id'");
		$individual_archive->find(true);
		$this->view->unit_name = $individual_archive->unit_name;//单位名称
		if($individual_archive->occupation != ''){
			$unit = $occupation[$individual_archive->occupation][1];
			$this->view->unit = $unit;//职业
		}
		if($individual_archive->study_history != ''){
			$key = intval($individual_archive->study_history) + 1;
			//var_dump($school_type[$key][1]);
			$this->view->study_history = $school_type[$key][1];//文化程度
		}
		$this->view->contact_number = $individual_archive->contact_number;//联系电话
		$this->view->standard_code = $individual_inf->standard_code_1;
		
		//获取户口所在地
		/*
		$doc_info = get_staff_info($doctor_current_id);
		$region_id=$doc_info[0]->region_id;
		$region1=explode(',',$regionInfo[$region_id][2]);
		$this->view->province = $regionInfo[$region1[2]][0];
		$this->view->city = $regionInfo[$region1[3]][0];
		$this->view->area = $regionInfo[$region1[4]][0];
		$this->view->town = $regionInfo[$region1[5]][0];
		*/
		$temp_zh_name = '';
		$individual=new Tindividual_core();
		$family=new Tfamily_archive();
		$org=new Torganization();
		$individual->joinAdd('inner',$individual,$family,'family_number','family_number');
		$individual->joinAdd('inner',$individual,$org,'org_id','id');
		$individual->whereAdd("individual_core.uuid='$t_id'");
		$individual->find(true);
		$org_id=$org->id;
		$region_path=$org->region_path;
		$temp_path_arr=explode(",",$region_path);
		foreach($temp_path_arr as $v){
			if($v < 2){
				continue;
			}
			$region = new Tregion();
			$region->whereAdd("id=$v");
			$region->find();
			$region->fetch();
			$temp_zh_name[] = $region->zh_name;
		}
		$this->view->temp_zh_name = $temp_zh_name;//
		
		
		//================体格检查
		// 表注释:特殊体态|radio|1=>无,2=>有

		$special_body=array('1'=>'无','2'=>'有');
		$this->view->special_body_options =$special_body; //特殊体态|radio|1=>无,2=>有

		// 表注释:精神状态|radio|1=>正常,2=>异常

		$mental_states=array('1'=>'正常','2'=>'异常');
		$this->view->mental_states_options =$mental_states; //精神状态|radio|1=>正常,2=>异常

		// 表注释:特殊面容|radio|1=>无,2=>有

		$unusual_facies=array('1'=>'无','2'=>'有');
		$this->view->unusual_facies_options =$unusual_facies; //特殊面容|radio|1=>无,2=>有

		//:智力|radio|1=>正常,2=>异常

		$intelligence=array('1'=>'正常','2'=>'异常');
		$this->view->intelligence_options =$intelligence; //智力|radio|1=>正常,2=>异常

		//表注释:智力描述|radio|1=>常识,2=>判断,3=>记忆,4=>计算

		$intelligence_info=array('1'=>'常识','2'=>'判断','3'=>'记忆','4'=>'计算');
		$this->view->intelligence_info_options =$intelligence_info; //智力描述|radio|1=>常识,2=>判断,3=>记忆,4=>计算

		// 表注释:皮肤毛发|radio|1=>正常,2=>异常

		$skin_and_hair=array('1'=>'正常','2'=>'异常');
		$this->view->skin_and_hair_options =$skin_and_hair; //皮肤毛发|radio|1=>正常,2=>异常

		// 表注释:五官|radio|1=>正常,2=>异常

		$feature=array('1'=>'正常','2'=>'异常');
		$this->view->feature_options =$feature; //五官|radio|1=>正常,2=>异常

		// 表注释:甲状腺|radio|1=>正常,2=>异常

		$thyroid=array('1'=>'正常','2'=>'异常');
		$this->view->thyroid_options =$thyroid; //甲状腺|radio|1=>正常,2=>异常

		//杂音|radio|1=>无,2=>有

		$noise=array('1'=>'无','2'=>'有');
		$this->view->noise_options =$noise; //杂音|radio|1=>无,2=>有

		//表注释:肺|radio|1=>正常,2=>异常

		$lung=array('1'=>'正常','2'=>'异常');
		$this->view->lung_options =$lung; //肺|radio|1=>正常,2=>异常

		// 表注释:肝|radio|1=>未及,2=>可及

		$liver=array('1'=>'未及','2'=>'可及');
		$this->view->liver_options =$liver; //肝|radio|1=>未及,2=>可及

		// 表注释:四肢脊柱|radio|1=>正常,2=>异常

		$spine_extremities=array('1'=>'正常','2'=>'异常');
		
		$this->view->spine_extremities_options =$spine_extremities; //四肢脊柱|radio|1=>正常,2=>异常
		if(empty($aid)){
			//添加页面
			$this->view->signature_doctor_physical = $this->user['name_real'];
			$this->view->signature_of_doctor = $doctor_current_id;//医师签名

		}else{
			//修改页面
			$pe_physical=new Tpe_physical();
			$pe_physical->whereAdd("id='{$aid}'");
			$pe_physical->find();
			$pe_physical->fetch();
			$this->view->uuid = $pe_physical->uuid;//编号
			$this->view->signature_doctor_physical = $pe_physical->signature_of_doctor;//
			$this->view->staff_id = $pe_physical->staff_id;//医生档案号
			$this->view->id = $pe_physical->id;//个人档案号
			$this->view->created = $pe_physical->created;//添加记录时间
			$this->view->systolic_pressure = $pe_physical->systolic_pressure;//收缩压
			$this->view->diastolic_pressure = $pe_physical->diastolic_pressure;//舒张压

			$this->view->special_body_current = $pe_physical->special_body;//特殊体态|radio|1=>无,2=>有
			$this->view->special_body_info = $pe_physical->special_body_info;//特殊体态描述

			$this->view->mental_states_current = $pe_physical->mental_states;//精神状态|radio|1=>正常,2=>异常
			$this->view->mental_states_info = $pe_physical->mental_states_info;//精神状态异常内容

			$this->view->unusual_facies_current = $pe_physical->unusual_facies;//特殊面容|radio|1=>无,2=>有
			$this->view->unusual_facies_info = $pe_physical->unusual_facies_info;//特殊面容内容

			$this->view->intelligence_current = $pe_physical->intelligence;//智力|radio|1=>正常,2=>异常


			$this->view->intelligence_info_current = $pe_physical->intelligence_info;//智力描述|radio|1=>常识,2=>判断,3=>记忆,4=>计算


			$this->view->skin_and_hair_current = $pe_physical->skin_and_hair;//皮肤毛发|radio|1=>正常,2=>异常
			$this->view->skin_and_hair_info = $pe_physical->skin_and_hair_info;//皮肤毛发内容


			$this->view->feature_current = $pe_physical->feature;//五官|radio|1=>正常,2=>异常
			$this->view->feature_info = $pe_physical->feature_info;//五官异常描述


			$this->view->thyroid_current = $pe_physical->thyroid;//甲状腺|radio|1=>正常,2=>异常
			$this->view->thyroid_info = $pe_physical->thyroid_info;//甲状腺异常描述
			$this->view->heart_rate = $pe_physical->heart_rate;//心率
			$this->view->cardiac_rhythm = $pe_physical->cardiac_rhythm;//心律


			$this->view->noise_current = $pe_physical->noise;//杂音|radio|1=>无,2=>有
			$this->view->noise_info = $pe_physical->noise_info;//杂音描述


			$this->view->lung_current = $pe_physical->lung;//肺|radio|1=>正常,2=>异常
			$this->view->lung_info = $pe_physical->lung_info;//肺异常描述
			// 表注释:肝|radio|1=>未及,2=>可及


			$this->view->liver_current = $pe_physical->liver;//肝|radio|1=>未及,2=>可及
			$this->view->liver_info = $pe_physical->liver_info;//肝描述


			$this->view->spine_extremities_current = $pe_physical->spine_extremities;//四肢脊柱|radio|1=>正常,2=>异常
			$this->view->spine_extremities_info = $pe_physical->spine_extremities_info;//四肢脊柱描述
			$this->view->other = $pe_physical->other;//其它
			$this->view->signature_of_doctor = $pe_physical->signature_of_doctor;//医师签名

		}


		//=============男性体第二性征检查
		/**
		 * 表注释:喉结|radio|1=>有,2=>无
		 * 
		 * 
		 **/
		$adam_apple=array('1'=>'有','2'=>'无');
		$this->view->adam_apple_options =$adam_apple; //喉结|radio|1=>有,2=>无

		/**
		 * 表注释:阴毛|radio|1=>正常,2=>稀少,3=>无
		 * 
		 * 
		 **/
		$pubes=array('1'=>'正常','2'=>'稀少','3'=>'无');
		$this->view->pubes_options =$pubes; //阴毛|radio|1=>正常,2=>稀少,3=>无

		/**
		 * 表注释:阴茎|radio|1=>正常,2=>异常
		 * 
		 * 
		 **/
		$sex_fluid=array('1'=>'正常','2'=>'异常');
		$this->view->sex_fluid_options =$sex_fluid; //阴茎|radio|1=>正常,2=>异常

		/**
		 * 表注释:包皮|radio|1=>正常,2=>过长,3=>包茎
		 * 
		 * 
		 **/
		$foreskin=array('1'=>'正常','2'=>'过长','3'=>'包茎');
		$this->view->foreskin_options =$foreskin; //包皮|radio|1=>正常,2=>过长,3=>包茎

		/**
		 * 表注释:睾丸|radio|1=>双侧扪及,2=>未扪及
		 * 
		 * 
		 **/
		$testis=array('1'=>'双侧扪及','2'=>'未扪及');
		$this->view->testis_options =$testis; //睾丸|radio|1=>双侧扪及,2=>未扪及

		/**
		 * 表注释:附睾|radio|1=>双侧正常,2=>结节
		 * 
		 * 
		 **/
		$epididymis=array('1'=>'双侧正常','2'=>'结节');
		$this->view->epididymis_options =$epididymis; //附睾|radio|1=>双侧正常,2=>结节

		/**
		 * 表注释:精索静脉曲张|radio|1=>无,2=>有
		 * 
		 * 
		 **/
		$varicocele=array('1'=>'无','2'=>'有');
		$this->view->varicocele_options =$varicocele; //精索静脉曲张|radio|1=>无,2=>有
		if(empty($aid)){
			//添加页面
			$this->view->signature_doctor_second = $this->user['name_real'];
		}else{
			//修改页面
			if($sex == '2'){
				$pe_second_sex_male = new Tpe_second_sex_male();
				$pe_second_sex_male->whereAdd("id='{$aid}'");
				$pe_second_sex_male->find();
				$pe_second_sex_male->fetch();
				$this->view->signature_doctor_second = $pe_second_sex_male->signature_of_doctor;
				$this->view->uuid = $pe_second_sex_male->uuid;//编号
				$this->view->staff_id = $pe_second_sex_male->staff_id;//医生档案号
				$this->view->id = $pe_second_sex_male->id;//个人档案号
				$this->view->created = $pe_second_sex_male->created;//添加记录时间
	
				$this->view->adam_apple_current = $pe_second_sex_male->adam_apple;//喉结|radio|1=>有,2=>无
	
				$this->view->pubes_current = $pe_second_sex_male->pubes;//阴毛|radio|1=>正常,2=>稀少,3=>无
	
				$this->view->sex_fluid_current = $pe_second_sex_male->sex_fluid;//阴茎|radio|1=>正常,2=>异常
				$this->view->sex_fluid_info = $pe_second_sex_male->sex_fluid_info;//阴茎异常
	
				$this->view->foreskin_current = $pe_second_sex_male->foreskin;//包皮|radio|1=>正常,2=>过长,3=>包茎
	
				$this->view->testis_current = $pe_second_sex_male->testis;//睾丸|radio|1=>双侧扪及,2=>未扪及
				$this->view->testis_left = $pe_second_sex_male->testis_left;//睾丸左侧
				$this->view->testis_right = $pe_second_sex_male->testis_right;//睾丸右侧
	
				$this->view->epididymis_current = $pe_second_sex_male->epididymis;//附睾|radio|1=>双侧正常,2=>结节
				$this->view->nodules_left = $pe_second_sex_male->nodules_left;//结节：左
				$this->view->nodules_right = $pe_second_sex_male->nodules_right;//结节：右
	
				$this->view->varicocele_current = $pe_second_sex_male->varicocele;//精索静脉曲张|radio|1=>无,2=>有
				$this->view->varicocele_place = $pe_second_sex_male->varicocele_place;//精索静脉曲张部位
				$this->view->varicocele_leavel = $pe_second_sex_male->varicocele_leavel;//精索静脉曲张程度
				$this->view->sex_male_other = $pe_second_sex_male->sex_male_other;//其它
				$this->view->signature_of_doctor = $pe_second_sex_male->signature_of_doctor;//医师签名
			}elseif($sex == '3'){
				$pe_second_sex_female=new Tpe_second_sex_female();
				$pe_second_sex_female->whereAdd("id='{$aid}'");
				$pe_second_sex_female->find();
				$pe_second_sex_female->fetch();
				$this->view->signature_doctor_second = $pe_second_sex_female->signature_of_doctor;
				$this->view->uuid = $pe_second_sex_female->uuid;//编号
				$this->view->staff_id = $pe_second_sex_female->staff_id;//医生档案号
				$this->view->id = $pe_second_sex_female->id;//个人档案号
				$this->view->created = $pe_second_sex_female->created;//添加记录时间
	
				$this->view->pubes_current = $pe_second_sex_female->pubes;//阴毛|radio|1=>正常,2=>稀少,3=>无
	
				$this->view->breast_current = $pe_second_sex_female->breast;//乳房|radio|1=>正常,2=>异常
				$this->view->breast_info = $pe_second_sex_female->breast_info;//乳房详细
				$this->view->vulva_convention = $pe_second_sex_female->vulva_convention;//外阴常规
				$this->view->secretions = $pe_second_sex_female->secretions;//分泌物
				$this->view->uterus = $pe_second_sex_female->uterus;//子宫
				$this->view->enclosure = $pe_second_sex_female->enclosure;//附件
				$this->view->vulva = $pe_second_sex_female->vulva;//外阴
				$this->view->vagina = $pe_second_sex_female->vagina;//阴道
				$this->view->cervix = $pe_second_sex_female->cervix;//宫颈
				$this->view->womb = $pe_second_sex_female->womb;//子宫
				$this->view->annex = $pe_second_sex_female->annex;//附件
				$this->view->sex_female_other = $pe_second_sex_female->sex_female_other;//其它
				$this->view->signature_of_doctor = $pe_second_sex_female->signature_of_doctor;//医师签名
			}
		}
		//========第二性征女性
		//阴毛|radio|1=>正常,2=>稀少,3=>无

		$pubes=array('1'=>'正常','2'=>'稀少','3'=>'无');
		$this->view->pubes_options =$pubes; //阴毛|radio|1=>正常,2=>稀少,3=>无
		
		//痛经
		$dysmenorrhea_options = array('1'=>'无','2'=>'轻','3'=>'中','4'=>'重');
		$this->view->dysmenorrhea_options =$dysmenorrhea_options; //乳房|radio|1=>正常,2=>异常

		//乳房|radio|1=>正常,2=>异常
		$breast=array('1'=>'正常','2'=>'异常');
		$this->view->breast_options =$breast; //乳房|radio|1=>正常,2=>异常
		/*
		if(empty($aid)){
			//添加页面

			$this->view->signature_of_doctor = $doctor_current_id;//医师签名
		}else{
			//修改页面
			$pe_second_sex_female=new Tpe_second_sex_female();
			$pe_second_sex_female->whereAdd("id='{$aid}'");
			$pe_second_sex_female->find();
			$pe_second_sex_female->fetch();
			$this->view->uuid = $pe_second_sex_female->uuid;//编号
			$this->view->staff_id = $pe_second_sex_female->staff_id;//医生档案号
			$this->view->id = $pe_second_sex_female->id;//个人档案号
			$this->view->created = $pe_second_sex_female->created;//添加记录时间

			$this->view->pubes_current = $pe_second_sex_female->pubes;//阴毛|radio|1=>正常,2=>稀少,3=>无

			$this->view->breast_current = $pe_second_sex_female->breast;//乳房|radio|1=>正常,2=>异常
			$this->view->breast_info = $pe_second_sex_female->breast_info;//乳房详细
			$this->view->vulva_convention = $pe_second_sex_female->vulva_convention;//外阴常规
			$this->view->secretions = $pe_second_sex_female->secretions;//分泌物
			$this->view->uterus = $pe_second_sex_female->uterus;//子宫
			$this->view->enclosure = $pe_second_sex_female->enclosure;//附件
			$this->view->vulva = $pe_second_sex_female->vulva;//外阴
			$this->view->vagina = $pe_second_sex_female->vagina;//阴道
			$this->view->cervix = $pe_second_sex_female->cervix;//宫颈
			$this->view->womb = $pe_second_sex_female->womb;//子宫
			$this->view->annex = $pe_second_sex_female->annex;//附件
			$this->view->sex_female_other = $pe_second_sex_female->sex_female_other;//其它
			$this->view->signature_of_doctor = $pe_second_sex_female->signature_of_doctor;//医师签名
		}
		*/
		//=======实验室及特殊检查
		/**
		 * 表注释:医学意见|radio|1=>未发现医学上不宜结婚的情形,2=>建议暂缓结婚,3=>建议不宜生育,4=>建议不宜结婚,5=>建议采取医学措施，尊重受检者意愿
		 * 
		 * 
		 **/
		$disease_diagnosis=array('1'=>'未发现医学上不宜结婚的情形','2'=>'建议暂缓结婚','3'=>'建议不宜生育','4'=>'建议不宜结婚','5'=>'建议采取医学措施，尊重受检者意愿');
		$this->view->disease_diagnosis_options =$disease_diagnosis; //医学意见|radio|1=>未发现医学上不宜结婚的情形,2=>建议暂缓结婚,3=>建议不宜生育,4=>建议不宜结婚,5=>建议采取医学措施，尊重受检者意愿
		if(empty($aid)){
			//添加页面


			$this->view->signature_of_doctor = $doctor_current_id;//医师签名
		}else{
			//修改页面
			$pe_lab_examination=new Tpe_lab_examination();
			$pe_lab_examination->whereAdd("id='{$aid}'");
			$pe_lab_examination->find();
			$pe_lab_examination->fetch();
			$this->view->uuid = $pe_lab_examination->uuid;//编号
			$this->view->staff_id = $pe_lab_examination->staff_id;//医生档案号
			$this->view->id = $pe_lab_examination->id;//个人档案号
			$this->view->created = $pe_lab_examination->created;//添加记录时间
			$this->view->check_result = $pe_lab_examination->check_result;//检查结果
			$this->view->check_result_info = $pe_lab_examination->check_result_info;//检查结果详细

			$this->view->disease_diagnosis_current = $pe_lab_examination->disease_diagnosis;//医学意见|radio|1=>未发现医学上不宜结婚的情形,2=>建议暂缓结婚,3=>建议不宜生育,4=>建议不宜结婚,5=>建议采取医学措施，尊重受检者意愿
			$this->view->medical_opinion = $pe_lab_examination->medical_opinion;//医学意见
			$this->view->signature_of_doctor = $pe_lab_examination->signature_of_doctor;//医师签名
		}
		//====================婚前卫生咨询
		/**
		 * 表注释:咨询指导结果|radio|1=>接受指导意见,2=>不接受指导意见，知情后选择结婚，后果自己承担
		 * 
		 * 
		 **/
		$check_result = array('1'=>'未见异常','2'=>'异常情况','3'=>'疾病诊断');
		$this->view->cr =$check_result; 
		
		$counseling_results=array('1'=>'接受指导意见','2'=>'不接受指导意见，知情后选择结婚，后果自己承担');
		$this->view->counseling_results_options =$counseling_results; //咨询指导结果|radio|1=>接受指导意见,2=>不接受指导意见，知情后选择结婚，后果自己承担

		if(empty($aid)){
			//添加页面


			$this->view->signature_of_doctor = $doctor_current_id;//医师签名
		}else{
			//修改页面
			$pe_health_advisory=new Tpe_health_advisory();
			$pe_health_advisory->whereAdd("id='{$aid}'");
			$pe_health_advisory->find();
			$pe_health_advisory->fetch();
			$this->view->uuid = $pe_health_advisory->uuid;//编号
			$this->view->staff_id = $pe_health_advisory->staff_id;//医生档案号
			$this->view->id = $pe_health_advisory->id;//个人档案号
			$this->view->created = $pe_health_advisory->created;//添加记录时间
			$this->view->health_advisory = $pe_health_advisory->health_advisory;//婚前卫生咨询

			$this->view->counseling_results_current = $pe_health_advisory->counseling_results;//咨询指导结果|radio|1=>接受指导意见,2=>不接受指导意见，知情后选择结婚，后果自己承担
			$this->view->signature_of_doctor = $pe_health_advisory->signature_of_doctor;//医师签名
		}
		//var_dump($sex);
		if(empty($aid)){
			//添加页面
				if($sex=='2'){
					//性别为男性
					$this->view->display('male.html');
				}elseif ($sex=='3'){
					//性别为女性
					$this->view->display('female.html');
				}
		}else{
			//修改页面
			    $individual_core=get_individual_info($individual_id);//根据个要档案uuid取得所有对成员
			    $sex=$individual_core->sex;//性别
				if($sex=='2'){
					//性别为男性
					$this->view->display('male.html');
				}elseif ($sex=='3'){
					//性别为女性
					$this->view->display('female.html');
				}
		}
	}
	/**
	 * 更新婚检-添加,修改
	 *
	 */
	public function updateAction(){
		$_code = '无';
		$aid=$this->_request->getParam('aid');
		$doctor_current_id = $this->user['uuid'];//当前医生id
		$individual_session=new Zend_Session_Namespace("individual_core");
		$id				   = empty($individual_session->uuid)?'':$individual_session->uuid;//个人档案ID
		
		if(!empty($aid)){
			$individual_inf=get_individual_info($aid);//取得个人信息中所有信息
		}else{
			if(empty($individual_session->staff_id)){
				$url=array("婚前医学检查列表"=>__BASEPATH.'premarital/premarital/list',
					"进入个人档案列表"=>__BASEPATH.'iha/index/index');
				message("请在个人档案列表双击选中居民",$url);
			}
			$individual_inf=get_individual_info($individual_session->uuid);//取得个人信息中所有信息
		}
		$sex = empty($individual_inf->sex)?'':$individual_inf->sex;//性别
		$uuid=uniqid('pe',true);//档案唯一编码
		$time=time();//当前时间戳
		//==========婚检主表
		$premarital_examination=new Tpremarital_examination();
		$premarital_examination->fill_time = mkunixstamp($this->_request->getParam('fill_time'));//填写日期

		$premarital_examination->name_of_the_partner = $this->_request->getParam('name_of_the_partner');//对方姓名

		$premarital_examination->sn_of_the_partner = $this->_request->getParam('sn_of_the_partner');//对方编号
		$follow_time_year  = $this->_request->getParam('follow_time_year');
		$follow_time_month = $this->_request->getParam('follow_time_month');
		$follow_time_day   = $this->_request->getParam('follow_time_day');
		
		$premarital_examination->date_of_examination = mkunixstamp($follow_time_year.'-'.$follow_time_month.'-'.$follow_time_day);//检查日期

		$premarital_examination->blood_kinship = $this->_request->getParam('blood_kinship');//血缘关系|radio|1=>无,2=>表,3=>堂,4=>其他

		$premarital_examination->blood_kinship_other = $this->_request->getParam('blood_kinship_other');//血缘关系其他

		$premarital_examination->past_disease_history = $this->_request->getParam('past_disease_history');//过去病史|checkbox|1=>无,2=>心脏病,3=>肺结核,4=>肝脏病,5=>泌尿生殖系疾病,6=>糖尿病,7=>高血压,8=>精神病,9=>性病,10=>癫痫,11=>甲亢,12=>先天疾患

		$premarital_examination->past_disease_history_other = $this->_request->getParam('past_disease_history_other');//过去病史其他

		$premarital_examination->operation_history = $this->_request->getParam('operation_history');//手术史|radio|1=>无,2=>有

		$premarital_examination->operation_history_other = $this->_request->getParam('operation_history_other');//手术史其它

		$premarital_examination->present_disease_history = $this->_request->getParam('present_disease_history');//现病史|radio|1=>无,2=>有

		$premarital_examination->present_disease_history_info = $this->_request->getParam('present_disease_history_info');//现病史内容

		$premarital_examination->age_of_menarche = $this->_request->getParam('age_of_menarche');//初潮年龄

		$premarital_examination->menstrual_period = $this->_request->getParam('menstrual_period');//经期

		$premarital_examination->menstrual_cycle = $this->_request->getParam('menstrual_cycle');//周期

		$premarital_examination->menstruation = $this->_request->getParam('menstruation');//月经量|radio|1=>多,2=>中,3=>少

		$premarital_examination->dysmenorrhea = $this->_request->getParam('dysmenorrhea');//痛经
		
		$lmp_time_y = $this->_request->getParam('lmp_time_y');
		$lmp_time_m = $this->_request->getParam('lmp_time_m');
		$lmp_time_d = $this->_request->getParam('lmp_time_d');
		$premarital_examination->lmp_time = mkunixstamp($lmp_time_y.'-'.$lmp_time_m.'-'.$lmp_time_d);//末次月经

		$premarital_examination->fertile_history = $this->_request->getParam('fertile_history');//既往婚育史|radio|1=>无,2=>有

		$premarital_examination->fertile_history_info = $this->_request->getParam('fertile_history_info');//既往婚育史内容|radio|1=>丧偶,2=>离异

		$premarital_examination->fh_term = $this->_request->getParam('fh_term');//足月产

		$premarital_examination->fh_preterm = $this->_request->getParam('fh_preterm');//早产

		$premarital_examination->fh_abortion = $this->_request->getParam('fh_abortion');//流产

		$premarital_examination->number_of_children = $this->_request->getParam('number_of_children');//子女数

		$premarital_examination->family_history = $this->_request->getParam('family_history');//与遗传有关的家族史|checkbox|1=>无,2=>盲,3=>聋,4=>哑,5=>精神病,6=>先天性智力低下,7=>先天性心脏病,8=>血友病,9=>糖尿病,10=>其他

		$premarital_examination->family_history_other = $this->_request->getParam('family_history_other');//与遗传有关的家族史其他

		$premarital_examination->relationship_with_patient = $this->_request->getParam('relationship_with_patient');//患者与本人关系

		$premarital_examination->family_inbreeding = $this->_request->getParam('family_inbreeding');//家族近亲婚配|radio|1=>无,2=>有

		$premarital_examination->family_inbreeding_info = $this->_request->getParam('family_inbreeding_info');//家族近亲婚配内容|radio|1=>父母,2=>祖父母,3=>外祖父母

		$premarital_examination->signature_of_doctor = $this->_request->getParam('signature_of_doctor');//医师签名

		$premarital_examination->referral_hospital = $this->_request->getParam('referral_hospital');//转诊医院
		$premarital_examination->referral_time = mkunixstamp($this->_request->getParam('referral_time'));//转诊日期
		$premarital_examination->return_visit_time = mkunixstamp($this->_request->getParam('return_visit_time'));//预约复诊日期
		
		$premarital_examination->cpe_time = mkunixstamp($this->_request->getParam('cpe_time'));//出具《婚前医学检查证明》日期
		$premarital_examination->signature_of_doctor = $this->_request->getParam('signature_doctor_examination');
		$premarital_examination->md_signature = $this->_request->getParam('md_signature');//主检医师签名
		if(empty($aid)){
			//添加
			if(empty($id)){

				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			if(!($sex=='2' or $sex=='3')){
				message("你选择的档案没有指定性别",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			$premarital_examination->uuid = $uuid;//编号
			$premarital_examination->staff_id = $doctor_current_id;//医生档案号
			$premarital_examination->id = $id;//个人档案号
			$premarital_examination->created = $time;//添加记录时间
			if(!$premarital_examination->insert()){
				$_code = 'insert_001';
			}
		}else{
			//修改
			$premarital_examination->whereAdd("id = '$aid'");
			if(!$premarital_examination->update()){
				$_code = 'update_001';
			}
		}
		//================体格检查
		$pe_physical=new Tpe_physical();
		$pe_physical->systolic_pressure = $this->_request->getParam('systolic_pressure');//收缩压

		$pe_physical->diastolic_pressure = $this->_request->getParam('diastolic_pressure');//舒张压

		$pe_physical->special_body = $this->_request->getParam('special_body');//特殊体态|radio|1=>无,2=>有

		$pe_physical->special_body_info = $this->_request->getParam('special_body_info');//特殊体态描述

		$pe_physical->mental_states = $this->_request->getParam('mental_states');//精神状态|radio|1=>正常,2=>异常

		$pe_physical->mental_states_info = $this->_request->getParam('mental_states_info');//精神状态异常内容

		$pe_physical->unusual_facies = $this->_request->getParam('unusual_facies');//特殊面容|radio|1=>无,2=>有

		$pe_physical->unusual_facies_info = $this->_request->getParam('unusual_facies_info');//特殊面容内容

		$pe_physical->intelligence = $this->_request->getParam('intelligence');//智力|radio|1=>正常,2=>异常

		$pe_physical->intelligence_info = $this->_request->getParam('intelligence_info');//智力描述|radio|1=>常识,2=>判断,3=>记忆,4=>计算

		$pe_physical->skin_and_hair = $this->_request->getParam('skin_and_hair');//皮肤毛发|radio|1=>正常,2=>异常

		$pe_physical->skin_and_hair_info = $this->_request->getParam('skin_and_hair_info');//皮肤毛发内容

		$pe_physical->feature = $this->_request->getParam('feature');//五官|radio|1=>正常,2=>异常

		$pe_physical->feature_info = $this->_request->getParam('feature_info');//五官异常描述

		$pe_physical->thyroid = $this->_request->getParam('thyroid');//甲状腺|radio|1=>正常,2=>异常

		$pe_physical->thyroid_info = $this->_request->getParam('thyroid_info');//甲状腺异常描述

		$pe_physical->heart_rate = $this->_request->getParam('heart_rate');//心率

		$pe_physical->cardiac_rhythm = $this->_request->getParam('cardiac_rhythm');//心律

		$pe_physical->noise = $this->_request->getParam('noise');//杂音|radio|1=>无,2=>有

		$pe_physical->noise_info = $this->_request->getParam('noise_info');//杂音描述

		$pe_physical->lung = $this->_request->getParam('lung');//肺|radio|1=>正常,2=>异常

		$pe_physical->lung_info = $this->_request->getParam('lung_info');//肺异常描述

		$pe_physical->liver = $this->_request->getParam('liver');//肝|radio|1=>未及,2=>可及

		$pe_physical->liver_info = $this->_request->getParam('liver_info');//肝描述

		$pe_physical->spine_extremities = $this->_request->getParam('spine_extremities');//四肢脊柱|radio|1=>正常,2=>异常

		$pe_physical->spine_extremities_info = $this->_request->getParam('spine_extremities_info');//四肢脊柱描述

		$pe_physical->other = $this->_request->getParam('other');//其它
		$pe_physical->signature_of_doctor = $this->_request->getParam('signature_doctor_physical');
		if(empty($aid)){
			if(empty($id)){

				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			//添加
			$pe_physical->uuid = $uuid;//编号
			$pe_physical->staff_id = $doctor_current_id;//医生档案号
			$pe_physical->id = $id;//个人档案号
			$pe_physical->created = $time;//添加记录时间
			if(!$pe_physical->insert()){
				$_code = 'insert_002';
			}
		}else{
			//修改
			$pe_physical->whereAdd("id = '$aid'");
			if(!$pe_physical->update()){
				$_code = 'update_002';
			}
		}
		//==========第二性征男性
		if($sex=='2'){
				$pe_second_sex_male=new Tpe_second_sex_male();
				$pe_second_sex_male->adam_apple = $this->_request->getParam('adam_apple');//喉结|radio|1=>有,2=>无
		
				$pe_second_sex_male->pubes = $this->_request->getParam('pubes');//阴毛|radio|1=>正常,2=>稀少,3=>无
		
				$pe_second_sex_male->sex_fluid = $this->_request->getParam('sex_fluid');//阴茎|radio|1=>正常,2=>异常
		
				$pe_second_sex_male->sex_fluid_info = $this->_request->getParam('sex_fluid_info');//阴茎异常
		
				$pe_second_sex_male->foreskin = $this->_request->getParam('foreskin');//包皮|radio|1=>正常,2=>过长,3=>包茎
		
				$pe_second_sex_male->testis = $this->_request->getParam('testis');//睾丸|radio|1=>双侧扪及,2=>未扪及
		
				$pe_second_sex_male->testis_left = $this->_request->getParam('testis_left');//睾丸左侧
		
				$pe_second_sex_male->testis_right = $this->_request->getParam('testis_right');//睾丸右侧
		
				$pe_second_sex_male->epididymis = $this->_request->getParam('epididymis');//附睾|radio|1=>双侧正常,2=>结节
		
				$pe_second_sex_male->nodules_left = $this->_request->getParam('nodules_left');//结节：左
		
				$pe_second_sex_male->nodules_right = $this->_request->getParam('nodules_right');//结节：右
		
				$pe_second_sex_male->varicocele = $this->_request->getParam('varicocele');//精索静脉曲张|radio|1=>无,2=>有
		
				$pe_second_sex_male->varicocele_place = $this->_request->getParam('varicocele_place');//精索静脉曲张部位
		
				$pe_second_sex_male->varicocele_leavel = $this->_request->getParam('varicocele_leavel');//精索静脉曲张程度
		
				$pe_second_sex_male->sex_male_other = $this->_request->getParam('sex_male_other');//其它
		
				$pe_second_sex_male->signature_of_doctor = $this->_request->getParam('signature_doctor_second');//医师签名
				if(empty($aid)){
					//添加
					if(empty($id)){
		
						message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
					}
					$pe_second_sex_male->uuid = $uuid;//编号
					$pe_second_sex_male->staff_id = $doctor_current_id;//医生档案号
					$pe_second_sex_male->id = $id;//个人档案号
					$pe_second_sex_male->created = $time;//添加记录时间
					if(!$pe_second_sex_male->insert()){
						$_code = 'insert_003';
					}
				}else{
					//修改
					$pe_second_sex_male->whereAdd("id = '$aid'");
					if(!$pe_second_sex_male->update()){
						$_code = 'update_003';
					}
				}
		}
		
		//===============第二性征女性
		if($sex=='3'){
			$pe_second_sex_female=new Tpe_second_sex_female();
			$pe_second_sex_female->pubes = $this->_request->getParam('pubes');//阴毛|radio|1=>正常,2=>稀少,3=>无
	
			$pe_second_sex_female->breast = $this->_request->getParam('breast');//乳房|radio|1=>正常,2=>异常
	
			$pe_second_sex_female->breast_info = $this->_request->getParam('breast_info');//乳房详细
	
			$pe_second_sex_female->vulva_convention = $this->_request->getParam('vulva_convention');//外阴常规
	
			$pe_second_sex_female->secretions = $this->_request->getParam('secretions');//分泌物
	
			$pe_second_sex_female->uterus = $this->_request->getParam('uterus');//子宫
	
			$pe_second_sex_female->enclosure = $this->_request->getParam('enclosure');//附件
	
			$pe_second_sex_female->vulva = $this->_request->getParam('vulva');//外阴
	
			$pe_second_sex_female->vagina = $this->_request->getParam('vagina');//阴道
	
			$pe_second_sex_female->cervix = $this->_request->getParam('cervix');//宫颈
	
			$pe_second_sex_female->womb = $this->_request->getParam('womb');//子宫
	
			$pe_second_sex_female->annex = $this->_request->getParam('annex');//附件
	
			$pe_second_sex_female->sex_female_other = $this->_request->getParam('sex_female_other');//其它
			$pe_second_sex_female->signature_of_doctor = $this->_request->getParam('signature_doctor_second');//医师签名
			if(empty($aid)){
				//添加
				if(empty($id)){
	
					message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
				}
				$pe_second_sex_female->uuid = $uuid;//编号
				$pe_second_sex_female->staff_id = $doctor_current_id;//医生档案号
				$pe_second_sex_female->id = $id;//个人档案号
				$pe_second_sex_female->created = $time;//添加记录时间
				if(!$pe_second_sex_female->insert()){
					$_code = 'insert_004';
				}
			}else{
				//修改
				$pe_second_sex_female->whereAdd("id = '$aid'");
				if(!$pe_second_sex_female->update()){
					$_code = 'update_004';
				}
			}
		}
		//===============实验室及特殊检查
		$pe_lab_examination=new Tpe_lab_examination();

		$pe_lab_examination->check_result = $this->_request->getParam('check_result');//检查结果

		$pe_lab_examination->check_result_info = $this->_request->getParam('check_result_info');//检查结果详细

		$pe_lab_examination->disease_diagnosis = $this->_request->getParam('disease_diagnosis');//医学意见|radio|1=>未发现医学上不宜结婚的情形,2=>建议暂缓结婚,3=>建议不宜生育,4=>建议不宜结婚,5=>建议采取医学措施，尊重受检者意愿

		$pe_lab_examination->medical_opinion = $this->_request->getParam('medical_opinion');//医学意见

		$pe_lab_examination->signature_of_doctor = $this->_request->getParam('signature_of_doctor');//医师签名
		if(empty($aid)){
			//添加
			if(empty($id)){

				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			$pe_lab_examination->uuid = $uuid;//编号
			$pe_lab_examination->staff_id = $doctor_current_id;//医生档案号
			$pe_lab_examination->id = $id;//个人档案号
			$pe_lab_examination->created = $time;//添加记录时间
			if(!$pe_lab_examination->insert()){
				$_code = 'insert_005';
			}
		}else{
			//修改
			$pe_lab_examination->whereAdd("id = '$aid'");
			if(!$pe_lab_examination->update()){
				$_code = 'update_005';
			}
		}
		//=================婚前卫生咨询
		$pe_health_advisory=new Tpe_health_advisory();
		//$pe_health_advisory->uuid = $this->_request->getParam('uuid');//编号

		//$pe_health_advisory->staff_id = $this->_request->getParam('staff_id');//医生档案号

		$pe_health_advisory->id = $this->_request->getParam('id');//个人档案号

		$pe_health_advisory->created = $this->_request->getParam('created');//添加记录时间

		$pe_health_advisory->health_advisory = $this->_request->getParam('health_advisory');//婚前卫生咨询

		$pe_health_advisory->counseling_results = $this->_request->getParam('counseling_results');//咨询指导结果|radio|1=>接受指导意见,2=>不接受指导意见，知情后选择结婚，后果自己承担

		$pe_health_advisory->signature_of_doctor = $this->_request->getParam('signature_of_doctor');//医师签名
		$pe_health_advisory->created = $time;//添加记录时间
		if(empty($aid)){
			//添加
			if(empty($id)){

				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			$pe_health_advisory->uuid = $uuid;//编号
			$pe_health_advisory->staff_id = $doctor_current_id;//医生档案号
			$pe_health_advisory->id = $id;//个人档案号
			if(!$pe_health_advisory->insert()){
				$_code = 'insert_006';
			}
		}else{
			//修改
			$pe_health_advisory->id = $aid;//个人档案号
			$pe_health_advisory->whereAdd("id = '$aid'");
			if(!$pe_health_advisory->update()){
				$_code = 'update_007';
			}
			//var_dump($pe_health_advisory);
		}
		$url=array("婚前医学检查列表"=>__BASEPATH.'premarital/premarital/list',
			"用户列表"=>__BASEPATH.'iha/index/index',
			"新增婚检表"=>__BASEPATH.'premarital/premarital/add');
		message("更新成功，返回代码：".$_code,$url);
 
	}
	/**
	 * 删除
	 *
	 */
	public function delAction(){
		$err_code = '无';
		$u_id = $this->_request->getParam('id');//获取id号
		if(empty($u_id)){
			message("参数错误",array("返回婚前医学检查列表"=>__BASEPATH.'premarital/premarital/list'));
		}
		//获取性别
		$individual_inf=get_individual_info($u_id);//取得个人信息中所有信息
		if($individual_inf->sex == '2'){
			//男(第二性征)
			$pe_second_sex_male = new Tpe_second_sex_male();
			$pe_second_sex_male->whereAdd("id = '$u_id'");
			if(!$pe_second_sex_male->delete()){
				$err_code = 'premarital_001';
			}
		}elseif($individual_inf->sex == '3'){
			//女(第二性征)
			$pe_second_sex_female = new Tpe_second_sex_female();
			$pe_second_sex_female->whereAdd("id = '$u_id'");
			if(!$pe_second_sex_female->delete()){
				$err_code = 'premarital_002';
			}
		}else{
			message("参数错误",array("返回婚前医学检查列表"=>__BASEPATH.'premarital/premarital/list'));
		}
		//删除体格检查
		$pe_physical = new Tpe_physical();
		$pe_physical -> whereAdd("id = '$u_id'");
		if(!$pe_physical->delete()){
			$err_code = 'premarital_003';
		}
		
		//删除实验室及特殊检查
		$pe_lab_examination = new Tpe_lab_examination();
		$pe_lab_examination -> whereAdd("id = '$u_id'");
		if(!$pe_lab_examination->delete()){
			$err_code = 'premarital_004';
		}
		//删除婚前卫生咨询
		$pe_health_advisory = new Tpe_health_advisory();
		$pe_health_advisory -> whereAdd("id = '$u_id'");
		if(!$pe_health_advisory->delete()){
			$err_code = 'premarital_005';
		}
		//删除主表
		$pe = new Tpremarital_examination();
		$pe->whereAdd("id = '$u_id'");
		if($pe->delete()){
			$url=array("婚前医学检查列表"=>__BASEPATH.'premarital/premarital/list',
				"用户列表"=>__BASEPATH.'iha/index/index',
				"新增婚检表"=>__BASEPATH.'premarital/premarital/add');
			message("删除婚检记录成功，返回代码：".$err_code,$url);
		}else{
			$url=array("婚前医学检查列表"=>__BASEPATH.'premarital/premarital/list',
				"用户列表"=>__BASEPATH.'iha/index/index',
				"新增婚检表"=>__BASEPATH.'premarital/premarital/add');
			message("删除婚检记录失败，返回代码：premarital_006",$url);
		}		
	}
}

?>