<?php
/*
* Created By Eric_Zhou
* Filename: indexController.php
* Date : 2010-10-08
* Summary : 预防接种卡(http://host/vaccinate/)
*/
class vaccinate_indexController extends controller {
	public function init(){
		require_once __SITEROOT.'library/privilege.php';//用户验证和权限
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';//引入时间处理
		require_once __SITEROOT."/library/Models/individual_archive.php";
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once __SITEROOT."/library/Models/vac_card.php";
		require_once __SITEROOT."/library/Models/vac_info.php";
		require_once __SITEROOT."/library/Models/vac_second_info.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/custom/pager.php";
		require_once __SITEROOT."library/Models/family_archive.php";
		require_once __SITEROOT."library/Models/organization.php";
		require_once(__SITEROOT.'library/Models/region.php');
		$this->view->basePath = $this->_request->getBasePath();
	}
	//列表
	public function indexAction(){
		//echo adodb_date('Y-m-d','Y-m-d','');
		$currentTime = time();
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
		$vac = new Tvac_card();
		$core=new Tindividual_core();
		$vac->whereAdd($diabetes_core_region_path_domain);
		$vac->joinAdd('left',$vac,$core,'id','uuid');
		if($search['username']){
			$vac->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if($search['standard_code']){
			$vac->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$vac->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
		if ($search['staff_id'] && $search['staff_id'] != '-9')
		{
			$vac->whereAdd("certificate_premartial_exam.staff_id = '".$search['staff_id']."'");
		}

		$nums=$vac->count("distinct vac_card.id");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		$arg = array();
		//new subpages(每页显示条数，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,
		__BASEPATH.'vaccinate/index/index/page/',2,$arg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$vac->selectAdd("vac_card.id as id,vac_card.staff_id as staff_id,individual_core.standard_code_1,individual_core.identity_number,individual_core.name as name,individual_core.name_pinyin as name_pinyin");
		$vac->groupBy("vac_card.id,individual_core.name,individual_core.name_pinyin,vac_card.staff_id,individual_core.standard_code_1,individual_core.identity_number");
		$vac->orderby('max(vac_card.created) DESC');
		$vac->limit($startnum,__ROWSOFPAGE);
		//$vac->debugLevel(2);
		$vac->find();
		$vac_list_arr = array();
		$i = 0;
		while($vac->fetch()){
			$vac_list_arr[$i]['id'] = $vac->id;
			$vac_list_arr[$i]['indent'] = $vac->identity_number;
			$vac_list_arr[$i]['name'] = $vac->name;
			$vac_list_arr[$i]['moreinfo'] = get_moreinfo_vac($vac->id);
			$i++;
		}
		$out = $links->subPageCss2();
		$this->view->assign('exam_list',$vac_list_arr);
		$this->view->assign('response_doctor',$responseDoctorArray);
		$this->view->assign("pager",$out);
		$this->view->display('list.html');
	}

	//添加修改页面
	public function addAction(){
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$uuid = $this->_request->getParam("id",'');
		$this->view->uuid=$uuid;
		$individual_session=new Zend_Session_Namespace("individual_core");
		if(empty($uuid)){
			//添加页面
			$individual_session=new Zend_Session_Namespace("individual_core");
			if(empty($individual_session->uuid) || empty($individual_session->staff_id))
			{
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			else
			{
				//判断死亡档案
				if($individual_session->status_flag!=1)
				{
					message("该档案为非正常档案,请选择其他档案做预防接种",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
				}
			}
			$this->view->assign('date_of_birth',adodb_date('Y-m-d',$individual_session->date_of_birth));
			$this->view->assign('uname',$individual_session->name);//姓名
			$this->view->standard_code = $individual_session->standard_code_1;//个人标准档案号
			if($individual_session->sex != ''){
				$this->view->assign('sex',$sex[array_search_for_other($individual_session->sex,$sex)][1]);//性别
			}else{
				$this->view->assign('sex','未说明');
			}
		}else{
			//修改页面
			$individual_inf=get_individual_info($uuid);//取得个人信息中所有信息
			$this->view->assign('date_of_birth',adodb_date('Y-m-d',$individual_inf->date_of_birth));
			$this->view->assign('uname',$individual_inf->name);//姓名
			$this->view->standard_code = $individual_inf->standard_code_1;//个人标准档案号
			if($individual_inf->sex != ''){
				$this->view->assign('sex',$sex[array_search_for_other($individual_inf->sex,$sex)][1]);//性别
			}else{
				$this->view->assign('sex','未说明');
			}
			$vac_card = new Tvac_card();
			$vac_card->whereAdd("id = '$uuid'");
			$vac_card->find();
			$vac_card->fetch();
			$this->view->uuid = $vac_card->uuid;//
			$this->view->staff_id = $vac_card->staff_id;//
			$this->view->id = $vac_card->id;//
			$this->view->created = $vac_card->created;//
			//$this->view->sex = $vac_card->sex;//
			//$this->view->date_of_birth = $vac_card->date_of_birth;//
			$this->view->guardian = $vac_card->guardian;//
			$this->view->relation = $vac_card->relation;//
			$this->view->telephone = $vac_card->telephone;//
			$this->view->family_address_city = $vac_card->family_address_city;//
			$this->view->family_address_street = $vac_card->family_address_street;//
			$this->view->census_register = $vac_card->census_register;//
			$this->view->census_register_province = $vac_card->census_register_province;//
			$this->view->census_register_city = $vac_card->census_register_city;//
			$this->view->census_register_area = $vac_card->census_register_area;//
			$this->view->census_register_street = $vac_card->census_register_street;//
			$this->view->immigration_time = $vac_card->immigration_time==''?'':adodb_date('Y-m-d',$vac_card->immigration_time);//
			$this->view->emigration_time = $vac_card->emigration_time==''?'':adodb_date('Y-m-d',$vac_card->emigration_time);//
			$this->view->emigration_cause = $vac_card->emigration_cause;//
			$this->view->vaccinum_unusual_history = $vac_card->vaccinum_unusual_history;//
			$this->view->vaccinate_no_no = $vac_card->vaccinate_no_no;//
			$this->view->infect_history = $vac_card->infect_history;//
			$this->view->created_card_time = adodb_date('Y-m-d',$vac_card->created_card_time);//
			$this->view->created_doc = $vac_card->created_doc;//
			$vac_info = new Tvac_info();
			$vac_info->whereAdd("id = '$uuid'");
			$vac_info->find();
			$vac_info->fetch();

			$this->view->uuid = $vac_info->uuid;//
			$this->view->id = $vac_info->id;//
			$this->view->created = $vac_info->created;//
			$this->view->hepatitis_time_1 = $vac_info->hepatitis_time_1==''?'':adodb_date('Y-m-d',$vac_info->hepatitis_time_1);//
			$this->view->hepatitis_part_1 = $vac_info->hepatitis_part_1;//
			$this->view->hepatitis_batch_1 = $vac_info->hepatitis_batch_1;//
			$this->view->hepatitis_effective_1 = $vac_info->hepatitis_effective_1==''?'':adodb_date('Y-m-d',$vac_info->hepatitis_effective_1);//
			$this->view->hepatitis_enterprises_1 = $vac_info->hepatitis_enterprises_1;//
			$this->view->hepatitis_doctor_1 = $vac_info->hepatitis_doctor_1;//
			$this->view->hepatitis_remark_1 = $vac_info->hepatitis_remark_1;//
			$this->view->hepatitis_time_2 = $vac_info->hepatitis_time_2==''?'':adodb_date('Y-m-d',$vac_info->hepatitis_time_2);//
			$this->view->hepatitis_part_2 = $vac_info->hepatitis_part_2;//
			$this->view->hepatitis_batch_2 = $vac_info->hepatitis_batch_2;//
			$this->view->hepatitis_effective_2 = $vac_info->hepatitis_effective_2==''?'':adodb_date('Y-m-d',$vac_info->hepatitis_effective_2);//
			$this->view->hepatitis_enterprises_2 = $vac_info->hepatitis_enterprises_2;//
			$this->view->hepatitis_doctor_2 = $vac_info->hepatitis_doctor_2;//
			$this->view->hepatitis_remark_2 = $vac_info->hepatitis_remark_2;//
			$this->view->hepatitis_time_3 = $vac_info->hepatitis_time_3==''?'':adodb_date('Y-m-d',$vac_info->hepatitis_time_3);//
			$this->view->hepatitis_part_3 = $vac_info->hepatitis_part_3;//
			$this->view->hepatitis_batch_3 = $vac_info->hepatitis_batch_3;//
			$this->view->hepatitis_effective_3 = $vac_info->hepatitis_effective_3==''?'':adodb_date('Y-m-d',$vac_info->hepatitis_effective_3);//
			$this->view->hepatitis_enterprises_3 = $vac_info->hepatitis_enterprises_3;//
			$this->view->hepatitis_doctor_3 = $vac_info->hepatitis_doctor_3;//
			$this->view->hepatitis_remark_3 = $vac_info->hepatitis_remark_3;//
			$this->view->bcg_time = $vac_info->bcg_time==''?'':adodb_date('Y-m-d',$vac_info->bcg_time);//
			$this->view->bcg_part = $vac_info->bcg_part;//
			$this->view->bcg_batch = $vac_info->bcg_batch;//
			$this->view->bcg_effective = $vac_info->bcg_effective==''?'':adodb_date('Y-m-d',$vac_info->bcg_effective);//
			$this->view->bcg_enterprises = $vac_info->bcg_enterprises;//
			$this->view->bcg_doctor = $vac_info->bcg_doctor;//
			$this->view->bcg_remark = $vac_info->bcg_remark;//
			$this->view->polio_time_1 = $vac_info->polio_time_1==''?'':adodb_date('Y-m-d',$vac_info->polio_time_1);//
			$this->view->polio_part_1 = $vac_info->polio_part_1;//
			$this->view->polio_batch_1 = $vac_info->polio_batch_1;//
			$this->view->polio_effective_1 = $vac_info->polio_effective_1==''?'':adodb_date('Y-m-d',$vac_info->polio_effective_1);//
			$this->view->polio_enterprises_1 = $vac_info->polio_enterprises_1;//
			$this->view->polio_doctor_1 = $vac_info->polio_doctor_1;//
			$this->view->polio_remark_1 = $vac_info->polio_remark_1;//
			$this->view->polio_time_2 = $vac_info->polio_time_2==''?'':adodb_date('Y-m-d',$vac_info->polio_time_2);//
			$this->view->polio_part_2 = $vac_info->polio_part_2;//
			$this->view->polio_batch_2 = $vac_info->polio_batch_2;//
			$this->view->polio_effective_2 = $vac_info->polio_effective_2==''?'':adodb_date('Y-m-d',$vac_info->polio_effective_2);//
			$this->view->polio_enterprises_2 = $vac_info->polio_enterprises_2;//
			$this->view->polio_doctor_2 = $vac_info->polio_doctor_2;//
			$this->view->polio_remark_2 = $vac_info->polio_remark_2;//
			$this->view->polio_time_3 = $vac_info->polio_time_3==''?'':adodb_date('Y-m-d',$vac_info->polio_time_3);//
			$this->view->polio_part_3 = $vac_info->polio_part_3;//
			$this->view->polio_batch_3 = $vac_info->polio_batch_3;//
			$this->view->polio_effective_3 = $vac_info->polio_effective_3==''?'':adodb_date('Y-m-d',$vac_info->polio_effective_3);//
			$this->view->polio_enterprises_3 = $vac_info->polio_enterprises_3;//
			$this->view->polio_doctor_3 = $vac_info->polio_doctor_3;//
			$this->view->polio_remark_3 = $vac_info->polio_remark_3;//
			$this->view->polio_time_4 = $vac_info->polio_time_4==''?'':adodb_date('Y-m-d',$vac_info->polio_time_4);//
			$this->view->polio_part_4 = $vac_info->polio_part_4;//
			$this->view->polio_batch_4 = $vac_info->polio_batch_4;//
			$this->view->polio_effective_4 = $vac_info->polio_effective_4==''?'':adodb_date('Y-m-d',$vac_info->polio_effective_4);//
			$this->view->polio_enterprises_4 = $vac_info->polio_enterprises_4;//
			$this->view->polio_doctor_4 = $vac_info->polio_doctor_4;//
			$this->view->polio_remark_4 = $vac_info->polio_remark_4;//
			$this->view->dpt_time_1 = $vac_info->dpt_time_1==''?'':adodb_date('Y-m-d',$vac_info->dpt_time_1);//
			$this->view->dpt_part_1 = $vac_info->dpt_part_1;//
			$this->view->dpt_batch_1 = $vac_info->dpt_batch_1;//
			$this->view->dpt_effective_1 = $vac_info->dpt_effective_1==''?'':adodb_date('Y-m-d',$vac_info->dpt_effective_1);//
			$this->view->dpt_enterprises_1 = $vac_info->dpt_enterprises_1;//
			$this->view->dpt_doctor_1 = $vac_info->dpt_doctor_1;//
			$this->view->dpt_remark_1 = $vac_info->dpt_remark_1;//
			$this->view->dpt_time_2 = $vac_info->dpt_time_2==''?'':adodb_date('Y-m-d',$vac_info->dpt_time_2);//
			$this->view->dpt_part_2 = $vac_info->dpt_part_2;//
			$this->view->dpt_batch_2 = $vac_info->dpt_batch_2;//
			$this->view->dpt_effective_2 = $vac_info->dpt_effective_2==''?'':adodb_date('Y-m-d',$vac_info->dpt_effective_2);//
			$this->view->dpt_enterprises_2 = $vac_info->dpt_enterprises_2;//
			$this->view->dpt_doctor_2 = $vac_info->dpt_doctor_2;//
			$this->view->dpt_remark_2 = $vac_info->dpt_remark_2;//
			$this->view->dpt_time_3 = $vac_info->dpt_time_3==''?'':adodb_date('Y-m-d',$vac_info->dpt_time_3);//
			$this->view->dpt_part_3 = $vac_info->dpt_part_3;//
			$this->view->dpt_batch_3 = $vac_info->dpt_batch_3;//
			$this->view->dpt_effective_3 = $vac_info->dpt_effective_3==''?'':adodb_date('Y-m-d',$vac_info->dpt_effective_3);//
			$this->view->dpt_enterprises_3 = $vac_info->dpt_enterprises_3;//
			$this->view->dpt_doctor_3 = $vac_info->dpt_doctor_3;//
			$this->view->dpt_remark_3 = $vac_info->dpt_remark_3;//
			$this->view->dpt_time_4 = $vac_info->dpt_time_4==''?'':adodb_date('Y-m-d',$vac_info->dpt_time_4);//
			$this->view->dpt_part_4 = $vac_info->dpt_part_4;//
			$this->view->dpt_batch_4 = $vac_info->dpt_batch_4;//
			$this->view->dpt_effective_4 = $vac_info->dpt_effective_4==''?'':adodb_date('Y-m-d',$vac_info->dpt_effective_4);//
			$this->view->dpt_enterprises_4 = $vac_info->dpt_enterprises_4;//
			$this->view->dpt_doctor_4 = $vac_info->dpt_doctor_4;//
			$this->view->dpt_remark_4 = $vac_info->dpt_remark_4;//
			$this->view->rubella_time = $vac_info->rubella_time==''?'':adodb_date('Y-m-d',$vac_info->rubella_time);//
			$this->view->rubella_part = $vac_info->rubella_part;//
			$this->view->rubella_batch = $vac_info->rubella_batch;//
			$this->view->rubella_effective = $vac_info->rubella_effective==''?'':adodb_date('Y-m-d',$vac_info->rubella_effective);//
			$this->view->rubella_enterprises = $vac_info->rubella_enterprises;//
			$this->view->rubella_doctor = $vac_info->rubella_doctor;//
			$this->view->rubella_remark = $vac_info->rubella_remark;//
			$this->view->lepra_time = $vac_info->lepra_time==''?'':adodb_date('Y-m-d',$vac_info->lepra_time);//
			$this->view->lepra_part = $vac_info->lepra_part;//
			$this->view->lepra_batch = $vac_info->lepra_batch;//
			$this->view->lepra_effective = $vac_info->lepra_effective==''?'':adodb_date('Y-m-d',$vac_info->lepra_effective);//
			$this->view->lepra_enterprises = $vac_info->lepra_enterprises;//
			$this->view->lepra_doctor = $vac_info->lepra_doctor;//
			$this->view->lepra_remark = $vac_info->lepra_remark;//
			$this->view->mmr_time_1 = $vac_info->mmr_time_1==''?'':adodb_date('Y-m-d',$vac_info->mmr_time_1);//
			$this->view->mmr_part_1 = $vac_info->mmr_part_1;//
			$this->view->mmr_batch_1 = $vac_info->mmr_batch_1;//
			$this->view->mmr_effective_1 = $vac_info->mmr_effective_1==''?'':adodb_date('Y-m-d',$vac_info->mmr_effective_1);//
			$this->view->mmr_enterprises_1 = $vac_info->mmr_enterprises_1;//
			$this->view->mmr_doctor_1 = $vac_info->mmr_doctor_1;//
			$this->view->mmr_remark_1 = $vac_info->mmr_remark_1;//
			$this->view->mmr_time_2 = $vac_info->mmr_time_2==''?'':adodb_date('Y-m-d',$vac_info->mmr_time_2);//
			$this->view->mmr_part_2 = $vac_info->mmr_part_2;//
			$this->view->mmr_batch_2 = $vac_info->mmr_batch_2;//
			$this->view->mmr_effective_2 = $vac_info->mmr_effective_2==''?'':adodb_date('Y-m-d',$vac_info->mmr_effective_2);//
			$this->view->mmr_enterprises_2 = $vac_info->mmr_enterprises_2;//
			$this->view->mmr_doctor_2 = $vac_info->mmr_doctor_2;//
			$this->view->mmr_remark_2 = $vac_info->mmr_remark_2;//
			$this->view->mm_time = $vac_info->mm_time==''?'':adodb_date('Y-m-d',$vac_info->mm_time);//
			$this->view->mm_part = $vac_info->mm_part;//
			$this->view->mm_batch = $vac_info->mm_batch;//
			$this->view->mm_effective = $vac_info->mm_effective==''?'':adodb_date('Y-m-d',$vac_info->mm_effective);//
			$this->view->mm_enterprises = $vac_info->mm_enterprises;//
			$this->view->mm_doctor = $vac_info->mm_doctor;//
			$this->view->mm_remark = $vac_info->mm_remark;//
			$this->view->measles_time_1 = $vac_info->measles_time_1==''?'':adodb_date('Y-m-d',$vac_info->measles_time_1);//
			$this->view->measles_part_1 = $vac_info->measles_part_1;//
			$this->view->measles_batch_1 = $vac_info->measles_batch_1;//
			$this->view->measles_effective_1 = $vac_info->measles_effective_1==''?'':adodb_date('Y-m-d',$vac_info->measles_effective_1);//
			$this->view->measles_enterprises_1 = $vac_info->measles_enterprises_1;//
			$this->view->measles_doctor_1 = $vac_info->measles_doctor_1;//
			$this->view->measles_remark_1 = $vac_info->measles_remark_1;//
			$this->view->measles_time_2 = $vac_info->measles_time_2==''?'':adodb_date('Y-m-d',$vac_info->measles_time_2);//
			$this->view->measles_part_2 = $vac_info->measles_part_2;//
			$this->view->measles_batch_2 = $vac_info->measles_batch_2;//
			$this->view->measles_effective_2 = $vac_info->measles_effective_2==''?'':adodb_date('Y-m-d',$vac_info->measles_effective_2);//
			$this->view->measles_enterprises_2 = $vac_info->measles_enterprises_2;//
			$this->view->measles_doctor_2 = $vac_info->measles_doctor_2;//
			$this->view->measles_remark_2 = $vac_info->measles_remark_2;//
			$this->view->a_time_1 = $vac_info->a_time_1==''?'':adodb_date('Y-m-d',$vac_info->a_time_1);//
			$this->view->a_part_1 = $vac_info->a_part_1;//
			$this->view->a_batch_1 = $vac_info->a_batch_1;//
			$this->view->a_effective_1 = $vac_info->a_effective_1==''?'':adodb_date('Y-m-d',$vac_info->a_effective_1);//
			$this->view->a_enterprises_1 = $vac_info->a_enterprises_1;//
			$this->view->a_doctor_1 = $vac_info->a_doctor_1;//
			$this->view->a_remark_1 = $vac_info->a_remark_1;//
			$this->view->a_time_2 = $vac_info->a_time_2==''?'':adodb_date('Y-m-d',$vac_info->a_time_2);//
			$this->view->a_part_2 = $vac_info->a_part_2;//
			$this->view->a_batch_2 = $vac_info->a_batch_2;//
			$this->view->a_effective_2 = $vac_info->a_effective_2==''?'':adodb_date('Y-m-d',$vac_info->a_effective_2);//
			$this->view->a_enterprises_2 = $vac_info->a_enterprises_2;//
			$this->view->a_doctor_2 = $vac_info->a_doctor_2;//
			$this->view->a_remark_2 = $vac_info->a_remark_2;//
			$this->view->ac_time_1 = $vac_info->ac_time_1==''?'':adodb_date('Y-m-d',$vac_info->ac_time_1);//
			$this->view->ac_part_1 = $vac_info->ac_part_1;//
			$this->view->ac_batch_1 = $vac_info->ac_batch_1;//
			$this->view->ac_effective_1 = $vac_info->ac_effective_1==''?'':adodb_date('Y-m-d',$vac_info->ac_effective_1);//
			$this->view->ac_enterprises_1 = $vac_info->ac_enterprises_1;//
			$this->view->ac_doctor_1 = $vac_info->ac_doctor_1;//
			$this->view->ac_remark_1 = $vac_info->ac_remark_1;//
			$this->view->ac_time_2 = $vac_info->ac_time_2==''?'':adodb_date('Y-m-d',$vac_info->ac_time_2);//
			$this->view->ac_part_2 = $vac_info->ac_part_2;//
			$this->view->ac_batch_2 = $vac_info->ac_batch_2;//
			$this->view->ac_effective_2 = $vac_info->ac_effective_2==''?'':adodb_date('Y-m-d',$vac_info->ac_effective_2);//
			$this->view->ac_enterprises_2 = $vac_info->ac_enterprises_2;//
			$this->view->ac_doctor_2 = $vac_info->ac_doctor_2;//
			$this->view->ac_remark_2 = $vac_info->ac_remark_2;//
			$this->view->att_time_1 = $vac_info->att_time_1==''?'':adodb_date('Y-m-d',$vac_info->att_time_1);//
			$this->view->att_part_1 = $vac_info->att_part_1;//
			$this->view->att_batch_1 = $vac_info->att_batch_1;//
			$this->view->att_effective_1 = $vac_info->att_effective_1==''?'':adodb_date('Y-m-d',$vac_info->att_effective_1);//
			$this->view->att_enterprises_1 = $vac_info->att_enterprises_1;//
			$this->view->att_doctor_1 = $vac_info->att_doctor_1;//
			$this->view->att_remark_1 = $vac_info->att_remark_1;//
			$this->view->att_time_2 = $vac_info->att_time_2==''?'':adodb_date('Y-m-d',$vac_info->att_time_2);//
			$this->view->att_part_2 = $vac_info->att_part_2;//
			$this->view->att_batch_2 = $vac_info->att_batch_2;//
			$this->view->att_effective_2 = $vac_info->att_effective_2==''?'':adodb_date('Y-m-d',$vac_info->att_effective_2);//
			$this->view->att_enterprises_2 = $vac_info->att_enterprises_2;//
			$this->view->att_doctor_2 = $vac_info->att_doctor_2;//
			$this->view->att_remark_2 = $vac_info->att_remark_2;//
			$this->view->ina_time_1 = $vac_info->ina_time_1==''?'':adodb_date('Y-m-d',$vac_info->ina_time_1);//
			$this->view->ina_part_1 = $vac_info->ina_part_1;//
			$this->view->ina_batch_1 = $vac_info->ina_batch_1;//
			$this->view->ina_effective_1 = $vac_info->ina_effective_1==''?'':adodb_date('Y-m-d',$vac_info->ina_effective_1);//
			$this->view->ina_enterprises_1 = $vac_info->ina_enterprises_1;//
			$this->view->ina_doctor_1 = $vac_info->ina_doctor_1;//
			$this->view->ina_remark_1 = $vac_info->ina_remark_1;//
			$this->view->ina_time_2 = $vac_info->ina_time_2==''?'':adodb_date('Y-m-d',$vac_info->ina_time_2);//
			$this->view->ina_part_2 = $vac_info->ina_part_2;//
			$this->view->ina_batch_2 = $vac_info->ina_batch_2;//
			$this->view->ina_effective_2 = $vac_info->ina_effective_2==''?'':adodb_date('Y-m-d',$vac_info->ina_effective_2);//
			$this->view->ina_enterprises_2 = $vac_info->ina_enterprises_2;//
			$this->view->ina_doctor_2 = $vac_info->ina_doctor_2;//
			$this->view->ina_remark_2 = $vac_info->ina_remark_2;//

			$this->view->ina_time_3 = $vac_info->ina_time_3==''?'':adodb_date('Y-m-d',$vac_info->ina_time_3);//
			$this->view->ina_part_3 = $vac_info->ina_part_3;//
			$this->view->ina_batch_3 = $vac_info->ina_batch_3;//
			$this->view->ina_effective_3 = $vac_info->ina_effective_3==''?'':adodb_date('Y-m-d',$vac_info->ina_effective_3);//
			$this->view->ina_enterprises_3 = $vac_info->ina_enterprises_3;//
			$this->view->ina_doctor_3 = $vac_info->ina_doctor_3;//
			$this->view->ina_remark_3 = $vac_info->ina_remark_3;//

			$this->view->ina_time_4 = $vac_info->ina_time_4==''?'':adodb_date('Y-m-d',$vac_info->ina_time_4);//
			$this->view->ina_part_4 = $vac_info->ina_part_4;//
			$this->view->ina_batch_4 = $vac_info->ina_batch_4;//
			$this->view->ina_effective_4 = $vac_info->ina_effective_4==''?'':adodb_date('Y-m-d',$vac_info->ina_effective_4);//
			$this->view->ina_enterprises_4 = $vac_info->ina_enterprises_4;//
			$this->view->ina_doctor_4 = $vac_info->ina_doctor_4;//
			$this->view->ina_remark_4 = $vac_info->ina_remark_4;//

			$this->view->hepatt_time = $vac_info->hepatt_time==''?'':adodb_date('Y-m-d',$vac_info->hepatt_time);//
			$this->view->hepatt_part = $vac_info->hepatt_part;//
			$this->view->hepatt_batch = $vac_info->hepatt_batch;//
			$this->view->hepatt_effective = $vac_info->hepatt_effective==''?'':adodb_date('Y-m-d',$vac_info->hepatt_effective);//
			$this->view->hepatt_enterprises = $vac_info->hepatt_enterprises;//
			$this->view->hepatt_doctor = $vac_info->hepatt_doctor;//
			$this->view->hepatt_remark = $vac_info->hepatt_remark;//
			$this->view->hepa_time_1 = $vac_info->hepa_time_1==''?'':adodb_date('Y-m-d',$vac_info->hepa_time_1);//
			$this->view->hepa_part_1 = $vac_info->hepa_part_1;//
			$this->view->hepa_batch_1 = $vac_info->hepa_batch_1;//
			$this->view->hepa_effective_1 = $vac_info->hepa_effective_1==''?'':adodb_date('Y-m-d',$vac_info->hepa_effective_1);//
			$this->view->hepa_enterprises_1 = $vac_info->hepa_enterprises_1;//
			$this->view->hepa_doctor_1 = $vac_info->hepa_doctor_1;//
			$this->view->hepa_remark_1 = $vac_info->hepa_remark_1;//
			$this->view->hepa_time_2 = $vac_info->hepa_time_2==''?'':adodb_date('Y-m-d',$vac_info->hepa_time_2);//
			$this->view->hepa_part_2 = $vac_info->hepa_part_2;//
			$this->view->hepa_batch_2 = $vac_info->hepa_batch_2;//
			$this->view->hepa_effective_2 = $vac_info->hepa_effective_2==''?'':adodb_date('Y-m-d',$vac_info->hepa_effective_2);//
			$this->view->hepa_enterprises_2 = $vac_info->hepa_enterprises_2;//
			$this->view->hepa_doctor_2 = $vac_info->hepa_doctor_2;//
			$this->view->hepa_remark_2 = $vac_info->hepa_remark_2;//

			$vac_second_info = new Tvac_second_info();
			$vac_second_info->whereAdd("id = '$uuid'");
			$vac_second_info->find();
			$vac_second_info->fetch();
			$this->view->uuid = $vac_second_info->uuid;//
			$this->view->id = $vac_second_info->id;//
			$this->view->created = $vac_second_info->created;//
			$this->view->vaccinum_name_1 = $vac_second_info->vaccinum_name_1;//
			$this->view->vaccinum_name_2 = $vac_second_info->vaccinum_name_2;//
			$this->view->vaccinum_name_3 = $vac_second_info->vaccinum_name_3;//
			$this->view->vaccinum_time_1 = $vac_second_info->vaccinum_time_1==''?'':adodb_date('Y-m-d',$vac_second_info->vaccinum_time_1);//
			$this->view->vaccinum_part_1 = $vac_second_info->vaccinum_part_1;//
			$this->view->vaccinum_batch_1 = $vac_second_info->vaccinum_batch_1;//
			$this->view->vaccinum_effective_1 = $vac_second_info->vaccinum_effective_1==''?'':adodb_date('Y-m-d',$vac_second_info->vaccinum_effective_1);//
			$this->view->vaccinum_enterprises_1 = $vac_second_info->vaccinum_enterprises_1;//
			$this->view->vaccinum_doctor_1 = $vac_second_info->vaccinum_doctor_1;//
			$this->view->vaccinum_remark_1 = $vac_second_info->vaccinum_remark_1;//
			$this->view->vaccinum_time_2 = $vac_second_info->vaccinum_time_2==''?'':adodb_date('Y-m-d',$vac_second_info->vaccinum_time_2);//
			$this->view->vaccinum_part_2 = $vac_second_info->vaccinum_part_2;//
			$this->view->vaccinum_batch_2 = $vac_second_info->vaccinum_batch_2;//
			$this->view->vaccinum_effective_2 = $vac_second_info->vaccinum_effective_2==''?'':adodb_date('Y-m-d',$vac_second_info->vaccinum_effective_2);//
			$this->view->vaccinum_enterprises_2 = $vac_second_info->vaccinum_enterprises_2;//
			$this->view->vaccinum_doctor_2 = $vac_second_info->vaccinum_doctor_2;//
			$this->view->vaccinum_remark_2 = $vac_second_info->vaccinum_remark_2;//
			$this->view->vaccinum_time_3 = empty($vac_second_info->vaccinum_time_3)?'':adodb_date('Y-m-d',$vac_second_info->vaccinum_time_3);//
			$this->view->vaccinum_part_3 = $vac_second_info->vaccinum_part_3;//
			$this->view->vaccinum_batch_3 = $vac_second_info->vaccinum_batch_3;//
			$this->view->vaccinum_effective_3 = $vac_second_info->vaccinum_effective_3==''?'':adodb_date('Y-m-d',$vac_second_info->vaccinum_effective_3);//
			$this->view->vaccinum_enterprises_3 = $vac_second_info->vaccinum_enterprises_3;//
			$this->view->vaccinum_doctor_3 = $vac_second_info->vaccinum_doctor_3;//
			$this->view->vaccinum_remark_3 = $vac_second_info->vaccinum_remark_3;//
		}
		$this->view->display('add.html');
	}
	//添加修改
	public function updateAction(){
		$err_code = '无';
		$uuid=$this->_request->getParam("id",'');
		$_uid=uniqid('va',true);//档案唯一编码
		$doctor_current_id = $this->user['uuid'];//当前医生id
		$individual_session=new Zend_Session_Namespace("individual_core");
		$id = empty($individual_session->uuid)?'':$individual_session->uuid;//个人档案ID
		$time = time();
		//预防接种卡主表
		$vac_card = new Tvac_card();
		//$vac_card->uuid = $this->_request->getParam('uuid');//

		$vac_card->staff_id = $this->_request->getParam('staff_id');//

		$vac_card->id = $this->_request->getParam('id');//

		$vac_card->created = $time;//

		$vac_card->sex = $this->_request->getParam('sex');//

		$vac_card->date_of_birth = check_utime($this->_request->getParam('date_of_birth'));//

		$vac_card->guardian = $this->_request->getParam('guardian');//

		$vac_card->relation = $this->_request->getParam('relation');//

		$vac_card->telephone = $this->_request->getParam('telephone');//

		$vac_card->family_address_city = $this->_request->getParam('family_address_city');//

		$vac_card->family_address_street = $this->_request->getParam('family_address_street');//

		$vac_card->census_register = $this->_request->getParam('census_register');//

		$vac_card->census_register_province = $this->_request->getParam('census_register_province');//

		$vac_card->census_register_city = $this->_request->getParam('census_register_city');//

		$vac_card->census_register_area = $this->_request->getParam('census_register_area');//

		$vac_card->census_register_street = $this->_request->getParam('census_register_street');//

		$vac_card->immigration_time = check_utime($this->_request->getParam('immigration_time'));//

		$vac_card->emigration_time = check_utime($this->_request->getParam('emigration_time'));//

		$vac_card->emigration_cause = $this->_request->getParam('emigration_cause');//

		$vac_card->vaccinum_unusual_history = $this->_request->getParam('vaccinum_unusual_history');//

		$vac_card->vaccinate_no_no = $this->_request->getParam('vaccinate_no_no');//

		$vac_card->infect_history = $this->_request->getParam('infect_history');//

		$vac_card->created_card_time = check_utime($this->_request->getParam('created_card_time'));//
		$vac_card->created_doc = $this->_request->getParam('created_doc');//
		if(empty($uuid)){
			//添加入库
			$vac_card->uuid = $_uid;
			$vac_card->staff_id = $doctor_current_id;
			$vac_card->id = $id;
			if(!$vac_card->insert()){
				$err_code = 'vac_insert_001';
			}
		}else{
			//修改入库
			$vac_card->whereAdd("id = '$uuid'");
			if(!$vac_card->update()){
				$err_code = 'vac_update_001';
			}
		}
		//疫苗信息
		$vac_info = new Tvac_info();
		//$vac_info->uuid = $this->_request->getParam('uuid');//

		$vac_info->id = $this->_request->getParam('id');//

		$vac_info->created = $time;//

		$vac_info->hepatitis_time_1 = check_utime($this->_request->getParam('hepatitis_time_1'));//

		$vac_info->hepatitis_part_1 = $this->_request->getParam('hepatitis_part_1');//

		$vac_info->hepatitis_batch_1 = $this->_request->getParam('hepatitis_batch_1');//

		$vac_info->hepatitis_effective_1 = check_utime($this->_request->getParam('hepatitis_effective_1'));//

		$vac_info->hepatitis_enterprises_1 = $this->_request->getParam('hepatitis_enterprises_1');//

		$vac_info->hepatitis_doctor_1 = $this->_request->getParam('hepatitis_doctor_1');//

		$vac_info->hepatitis_remark_1 = $this->_request->getParam('hepatitis_remark_1');//

		$vac_info->hepatitis_time_2 = check_utime($this->_request->getParam('hepatitis_time_2'));//

		$vac_info->hepatitis_part_2 = $this->_request->getParam('hepatitis_part_2');//

		$vac_info->hepatitis_batch_2 = $this->_request->getParam('hepatitis_batch_2');//

		$vac_info->hepatitis_effective_2 = check_utime($this->_request->getParam('hepatitis_effective_2'));//

		$vac_info->hepatitis_enterprises_2 = $this->_request->getParam('hepatitis_enterprises_2');//

		$vac_info->hepatitis_doctor_2 = $this->_request->getParam('hepatitis_doctor_2');//

		$vac_info->hepatitis_remark_2 = $this->_request->getParam('hepatitis_remark_2');//

		$vac_info->hepatitis_time_3 = check_utime($this->_request->getParam('hepatitis_time_3'));//

		$vac_info->hepatitis_part_3 = $this->_request->getParam('hepatitis_part_3');//

		$vac_info->hepatitis_batch_3 = $this->_request->getParam('hepatitis_batch_3');//

		$vac_info->hepatitis_effective_3 = check_utime($this->_request->getParam('hepatitis_effective_3'));//

		$vac_info->hepatitis_enterprises_3 = $this->_request->getParam('hepatitis_enterprises_3');//

		$vac_info->hepatitis_doctor_3 = $this->_request->getParam('hepatitis_doctor_3');//

		$vac_info->hepatitis_remark_3 = $this->_request->getParam('hepatitis_remark_3');//

		$vac_info->bcg_time = check_utime($this->_request->getParam('bcg_time'));//

		$vac_info->bcg_part = $this->_request->getParam('bcg_part');//

		$vac_info->bcg_batch = $this->_request->getParam('bcg_batch');//

		$vac_info->bcg_effective = check_utime($this->_request->getParam('bcg_effective'));//

		$vac_info->bcg_enterprises = $this->_request->getParam('bcg_enterprises');//

		$vac_info->bcg_doctor = $this->_request->getParam('bcg_doctor');//

		$vac_info->bcg_remark = $this->_request->getParam('bcg_remark');//

		$vac_info->polio_time_1 = check_utime($this->_request->getParam('polio_time_1'));//

		$vac_info->polio_part_1 = $this->_request->getParam('polio_part_1');//

		$vac_info->polio_batch_1 = $this->_request->getParam('polio_batch_1');//

		$vac_info->polio_effective_1 = check_utime($this->_request->getParam('polio_effective_1'));//

		$vac_info->polio_enterprises_1 = $this->_request->getParam('polio_enterprises_1');//

		$vac_info->polio_doctor_1 = $this->_request->getParam('polio_doctor_1');//

		$vac_info->polio_remark_1 = $this->_request->getParam('polio_remark_1');//

		$vac_info->polio_time_2 = check_utime($this->_request->getParam('polio_time_2'));//

		$vac_info->polio_part_2 = $this->_request->getParam('polio_part_2');//

		$vac_info->polio_batch_2 = $this->_request->getParam('polio_batch_2');//

		$vac_info->polio_effective_2 = check_utime($this->_request->getParam('polio_effective_2'));//

		$vac_info->polio_enterprises_2 = $this->_request->getParam('polio_enterprises_2');//

		$vac_info->polio_doctor_2 = $this->_request->getParam('polio_doctor_2');//

		$vac_info->polio_remark_2 = $this->_request->getParam('polio_remark_2');//

		$vac_info->polio_time_3 = check_utime($this->_request->getParam('polio_time_3'));//

		$vac_info->polio_part_3 = $this->_request->getParam('polio_part_3');//

		$vac_info->polio_batch_3 = $this->_request->getParam('polio_batch_3');//

		$vac_info->polio_effective_3 = check_utime($this->_request->getParam('polio_effective_3'));//

		$vac_info->polio_enterprises_3 = $this->_request->getParam('polio_enterprises_3');//

		$vac_info->polio_doctor_3 = $this->_request->getParam('polio_doctor_3');//

		$vac_info->polio_remark_3 = $this->_request->getParam('polio_remark_3');//

		$vac_info->polio_time_4 = check_utime($this->_request->getParam('polio_time_4'));//

		$vac_info->polio_part_4 = $this->_request->getParam('polio_part_4');//

		$vac_info->polio_batch_4 = $this->_request->getParam('polio_batch_4');//

		$vac_info->polio_effective_4 = check_utime($this->_request->getParam('polio_effective_4'));//

		$vac_info->polio_enterprises_4 = $this->_request->getParam('polio_enterprises_4');//

		$vac_info->polio_doctor_4 = $this->_request->getParam('polio_doctor_4');//

		$vac_info->polio_remark_4 = $this->_request->getParam('polio_remark_4');//

		$vac_info->dpt_time_1 = check_utime($this->_request->getParam('dpt_time_1'));//

		$vac_info->dpt_part_1 = $this->_request->getParam('dpt_part_1');//

		$vac_info->dpt_batch_1 = $this->_request->getParam('dpt_batch_1');//

		$vac_info->dpt_effective_1 = check_utime($this->_request->getParam('dpt_effective_1'));//

		$vac_info->dpt_enterprises_1 = $this->_request->getParam('dpt_enterprises_1');//

		$vac_info->dpt_doctor_1 = $this->_request->getParam('dpt_doctor_1');//

		$vac_info->dpt_remark_1 = $this->_request->getParam('dpt_remark_1');//

		$vac_info->dpt_time_2 = check_utime($this->_request->getParam('dpt_time_2'));//

		$vac_info->dpt_part_2 = $this->_request->getParam('dpt_part_2');//

		$vac_info->dpt_batch_2 = $this->_request->getParam('dpt_batch_2');//

		$vac_info->dpt_effective_2 = check_utime($this->_request->getParam('dpt_effective_2'));//

		$vac_info->dpt_enterprises_2 = $this->_request->getParam('dpt_enterprises_2');//

		$vac_info->dpt_doctor_2 = $this->_request->getParam('dpt_doctor_2');//

		$vac_info->dpt_remark_2 = $this->_request->getParam('dpt_remark_2');//

		$vac_info->dpt_time_3 = check_utime($this->_request->getParam('dpt_time_3'));//

		$vac_info->dpt_part_3 = $this->_request->getParam('dpt_part_3');//

		$vac_info->dpt_batch_3 = $this->_request->getParam('dpt_batch_3');//

		$vac_info->dpt_effective_3 = check_utime($this->_request->getParam('dpt_effective_3'));//

		$vac_info->dpt_enterprises_3 = $this->_request->getParam('dpt_enterprises_3');//

		$vac_info->dpt_doctor_3 = $this->_request->getParam('dpt_doctor_3');//

		$vac_info->dpt_remark_3 = $this->_request->getParam('dpt_remark_3');//

		$vac_info->dpt_time_4 = check_utime($this->_request->getParam('dpt_time_4'));//

		$vac_info->dpt_part_4 = $this->_request->getParam('dpt_part_4');//

		$vac_info->dpt_batch_4 = $this->_request->getParam('dpt_batch_4');//

		$vac_info->dpt_effective_4 = check_utime($this->_request->getParam('dpt_effective_4'));//

		$vac_info->dpt_enterprises_4 = $this->_request->getParam('dpt_enterprises_4');//

		$vac_info->dpt_doctor_4 = $this->_request->getParam('dpt_doctor_4');//

		$vac_info->dpt_remark_4 = $this->_request->getParam('dpt_remark_4');//

		$vac_info->rubella_time = check_utime($this->_request->getParam('rubella_time'));//

		$vac_info->rubella_part = $this->_request->getParam('rubella_part');//

		$vac_info->rubella_batch = $this->_request->getParam('rubella_batch');//

		$vac_info->rubella_effective = check_utime($this->_request->getParam('rubella_effective'));//

		$vac_info->rubella_enterprises = $this->_request->getParam('rubella_enterprises');//

		$vac_info->rubella_doctor = $this->_request->getParam('rubella_doctor');//

		$vac_info->rubella_remark = $this->_request->getParam('rubella_remark');//

		$vac_info->lepra_time = check_utime($this->_request->getParam('lepra_time'));//

		$vac_info->lepra_part = $this->_request->getParam('lepra_part');//

		$vac_info->lepra_batch = $this->_request->getParam('lepra_batch');//

		$vac_info->lepra_effective = check_utime($this->_request->getParam('lepra_effective'));//

		$vac_info->lepra_enterprises = $this->_request->getParam('lepra_enterprises');//

		$vac_info->lepra_doctor = $this->_request->getParam('lepra_doctor');//

		$vac_info->lepra_remark = $this->_request->getParam('lepra_remark');//

		$vac_info->mmr_time_1 = check_utime($this->_request->getParam('mmr_time_1'));//

		$vac_info->mmr_part_1 = $this->_request->getParam('mmr_part_1');//

		$vac_info->mmr_batch_1 = $this->_request->getParam('mmr_batch_1');//

		$vac_info->mmr_effective_1 = check_utime($this->_request->getParam('mmr_effective_1'));//

		$vac_info->mmr_enterprises_1 = $this->_request->getParam('mmr_enterprises_1');//

		$vac_info->mmr_doctor_1 = $this->_request->getParam('mmr_doctor_1');//

		$vac_info->mmr_remark_1 = $this->_request->getParam('mmr_remark_1');//

		$vac_info->mmr_time_2 = check_utime($this->_request->getParam('mmr_time_2'));//

		$vac_info->mmr_part_2 = $this->_request->getParam('mmr_part_2');//

		$vac_info->mmr_batch_2 = $this->_request->getParam('mmr_batch_2');//

		$vac_info->mmr_effective_2 = check_utime($this->_request->getParam('mmr_effective_2'));//

		$vac_info->mmr_enterprises_2 = $this->_request->getParam('mmr_enterprises_2');//

		$vac_info->mmr_doctor_2 = $this->_request->getParam('mmr_doctor_2');//

		$vac_info->mmr_remark_2 = $this->_request->getParam('mmr_remark_2');//

		$vac_info->mm_time = check_utime($this->_request->getParam('mm_time'));//

		$vac_info->mm_part = $this->_request->getParam('mm_part');//

		$vac_info->mm_batch = $this->_request->getParam('mm_batch');//

		$vac_info->mm_effective = check_utime($this->_request->getParam('mm_effective'));//

		$vac_info->mm_enterprises = $this->_request->getParam('mm_enterprises');//

		$vac_info->mm_doctor = $this->_request->getParam('mm_doctor');//

		$vac_info->mm_remark = $this->_request->getParam('mm_remark');//

		$vac_info->measles_time_1 = check_utime($this->_request->getParam('measles_time_1'));//

		$vac_info->measles_part_1 = $this->_request->getParam('measles_part_1');//

		$vac_info->measles_batch_1 = $this->_request->getParam('measles_batch_1');//

		$vac_info->measles_effective_1 = check_utime($this->_request->getParam('measles_effective_1'));//

		$vac_info->measles_enterprises_1 = $this->_request->getParam('measles_enterprises_1');//

		$vac_info->measles_doctor_1 = $this->_request->getParam('measles_doctor_1');//

		$vac_info->measles_remark_1 = $this->_request->getParam('measles_remark_1');//

		$vac_info->measles_time_2 = check_utime($this->_request->getParam('measles_time_2'));//

		$vac_info->measles_part_2 = $this->_request->getParam('measles_part_2');//

		$vac_info->measles_batch_2 = $this->_request->getParam('measles_batch_2');//

		$vac_info->measles_effective_2 = check_utime($this->_request->getParam('measles_effective_2'));//

		$vac_info->measles_enterprises_2 = $this->_request->getParam('measles_enterprises_2');//

		$vac_info->measles_doctor_2 = $this->_request->getParam('measles_doctor_2');//

		$vac_info->measles_remark_2 = $this->_request->getParam('measles_remark_2');//

		$vac_info->a_time_1 = check_utime($this->_request->getParam('a_time_1'));//

		$vac_info->a_part_1 = $this->_request->getParam('a_part_1');//

		$vac_info->a_batch_1 = $this->_request->getParam('a_batch_1');//

		$vac_info->a_effective_1 = check_utime($this->_request->getParam('a_effective_1'));//

		$vac_info->a_enterprises_1 = $this->_request->getParam('a_enterprises_1');//

		$vac_info->a_doctor_1 = $this->_request->getParam('a_doctor_1');//

		$vac_info->a_remark_1 = $this->_request->getParam('a_remark_1');//

		$vac_info->a_time_2 = check_utime($this->_request->getParam('a_time_2'));//

		$vac_info->a_part_2 = $this->_request->getParam('a_part_2');//

		$vac_info->a_batch_2 = $this->_request->getParam('a_batch_2');//

		$vac_info->a_effective_2 = check_utime($this->_request->getParam('a_effective_2'));//

		$vac_info->a_enterprises_2 = $this->_request->getParam('a_enterprises_2');//

		$vac_info->a_doctor_2 = $this->_request->getParam('a_doctor_2');//

		$vac_info->a_remark_2 = $this->_request->getParam('a_remark_2');//

		$vac_info->ac_time_1 = check_utime($this->_request->getParam('ac_time_1'));//

		$vac_info->ac_part_1 = $this->_request->getParam('ac_part_1');//

		$vac_info->ac_batch_1 = $this->_request->getParam('ac_batch_1');//

		$vac_info->ac_effective_1 = check_utime($this->_request->getParam('ac_effective_1'));//

		$vac_info->ac_enterprises_1 = $this->_request->getParam('ac_enterprises_1');//

		$vac_info->ac_doctor_1 = $this->_request->getParam('ac_doctor_1');//

		$vac_info->ac_remark_1 = $this->_request->getParam('ac_remark_1');//

		$vac_info->ac_time_2 = check_utime($this->_request->getParam('ac_time_2'));//

		$vac_info->ac_part_2 = $this->_request->getParam('ac_part_2');//

		$vac_info->ac_batch_2 = $this->_request->getParam('ac_batch_2');//

		$vac_info->ac_effective_2 = check_utime($this->_request->getParam('ac_effective_2'));//

		$vac_info->ac_enterprises_2 = $this->_request->getParam('ac_enterprises_2');//

		$vac_info->ac_doctor_2 = $this->_request->getParam('ac_doctor_2');//

		$vac_info->ac_remark_2 = $this->_request->getParam('ac_remark_2');//

		$vac_info->att_time_1 = check_utime($this->_request->getParam('att_time_1'));//

		$vac_info->att_part_1 = $this->_request->getParam('att_part_1');//

		$vac_info->att_batch_1 = $this->_request->getParam('att_batch_1');//

		$vac_info->att_effective_1 = check_utime($this->_request->getParam('att_effective_1'));//

		$vac_info->att_enterprises_1 = $this->_request->getParam('att_enterprises_1');//

		$vac_info->att_doctor_1 = $this->_request->getParam('att_doctor_1');//

		$vac_info->att_remark_1 = $this->_request->getParam('att_remark_1');//

		$vac_info->att_time_2 = check_utime($this->_request->getParam('att_time_2'));//

		$vac_info->att_part_2 = $this->_request->getParam('att_part_2');//

		$vac_info->att_batch_2 = $this->_request->getParam('att_batch_2');//

		$vac_info->att_effective_2 = check_utime($this->_request->getParam('att_effective_2'));//

		$vac_info->att_enterprises_2 = $this->_request->getParam('att_enterprises_2');//

		$vac_info->att_doctor_2 = $this->_request->getParam('att_doctor_2');//

		$vac_info->att_remark_2 = $this->_request->getParam('att_remark_2');//

		$vac_info->ina_time_1 = check_utime($this->_request->getParam('ina_time_1'));//

		$vac_info->ina_part_1 = $this->_request->getParam('ina_part_1');//

		$vac_info->ina_batch_1 = $this->_request->getParam('ina_batch_1');//

		$vac_info->ina_effective_1 = check_utime($this->_request->getParam('ina_effective_1'));//

		$vac_info->ina_enterprises_1 = $this->_request->getParam('ina_enterprises_1');//

		$vac_info->ina_doctor_1 = $this->_request->getParam('ina_doctor_1');//

		$vac_info->ina_remark_1 = $this->_request->getParam('ina_remark_1');//

		$vac_info->ina_time_2 = check_utime($this->_request->getParam('ina_time_2'));//

		$vac_info->ina_part_2 = $this->_request->getParam('ina_part_2');//

		$vac_info->ina_batch_2 = $this->_request->getParam('ina_batch_2');//

		$vac_info->ina_effective_2 = check_utime($this->_request->getParam('ina_effective_2'));//

		$vac_info->ina_enterprises_2 = $this->_request->getParam('ina_enterprises_2');//

		$vac_info->ina_doctor_2 = $this->_request->getParam('ina_doctor_2');//

		$vac_info->ina_remark_2 = $this->_request->getParam('ina_remark_2');//


		$vac_info->ina_time_3 = check_utime($this->_request->getParam('ina_time_3'));//

		$vac_info->ina_part_3 = $this->_request->getParam('ina_part_3');//

		$vac_info->ina_batch_3 = $this->_request->getParam('ina_batch_3');//

		$vac_info->ina_effective_3 = check_utime($this->_request->getParam('ina_effective_3'));//

		$vac_info->ina_enterprises_3 = $this->_request->getParam('ina_enterprises_3');//

		$vac_info->ina_doctor_3 = $this->_request->getParam('ina_doctor_3');//

		$vac_info->ina_remark_3 = $this->_request->getParam('ina_remark_3');//

		$vac_info->ina_time_4 = check_utime($this->_request->getParam('ina_time_4'));//

		$vac_info->ina_part_4 = $this->_request->getParam('ina_part_4');//

		$vac_info->ina_batch_4 = $this->_request->getParam('ina_batch_4');//

		$vac_info->ina_effective_4 = check_utime($this->_request->getParam('ina_effective_4'));//

		$vac_info->ina_enterprises_4 = $this->_request->getParam('ina_enterprises_4');//

		$vac_info->ina_doctor_4 = $this->_request->getParam('ina_doctor_4');//

		$vac_info->ina_remark_4 = $this->_request->getParam('ina_remark_4');//



		$vac_info->hepatt_time = check_utime($this->_request->getParam('hepatt_time'));//

		$vac_info->hepatt_part = $this->_request->getParam('hepatt_part');//

		$vac_info->hepatt_batch = $this->_request->getParam('hepatt_batch');//

		$vac_info->hepatt_effective = check_utime($this->_request->getParam('hepatt_effective'));//

		$vac_info->hepatt_enterprises = $this->_request->getParam('hepatt_enterprises');//

		$vac_info->hepatt_doctor = $this->_request->getParam('hepatt_doctor');//

		$vac_info->hepatt_remark = $this->_request->getParam('hepatt_remark');//

		$vac_info->hepa_time_1 = check_utime($this->_request->getParam('hepa_time_1'));//

		$vac_info->hepa_part_1 = $this->_request->getParam('hepa_part_1');//

		$vac_info->hepa_batch_1 = $this->_request->getParam('hepa_batch_1');//

		$vac_info->hepa_effective_1 = check_utime($this->_request->getParam('hepa_effective_1'));//

		$vac_info->hepa_enterprises_1 = $this->_request->getParam('hepa_enterprises_1');//

		$vac_info->hepa_doctor_1 = $this->_request->getParam('hepa_doctor_1');//

		$vac_info->hepa_remark_1 = $this->_request->getParam('hepa_remark_1');//

		$vac_info->hepa_time_2 = check_utime($this->_request->getParam('hepa_time_2'));//

		$vac_info->hepa_part_2 = $this->_request->getParam('hepa_part_2');//

		$vac_info->hepa_batch_2 = $this->_request->getParam('hepa_batch_2');//

		$vac_info->hepa_effective_2 = check_utime($this->_request->getParam('hepa_effective_2'));//

		$vac_info->hepa_enterprises_2 = $this->_request->getParam('hepa_enterprises_2');//

		$vac_info->hepa_doctor_2 = $this->_request->getParam('hepa_doctor_2');//

		$vac_info->hepa_remark_2 = $this->_request->getParam('hepa_remark_2');//
		if(empty($uuid)){
			//添加入库
			$vac_info->uuid = $_uid;
			//$vac_info->staff_id = $doctor_current_id;
			$vac_info->id = $id;
			if(!$vac_info->insert()){
				$err_code = 'vac_insert_002';
			}
		}else{
			//修改入库
			$vac_info->whereAdd("id = '$uuid'");
			if(!$vac_info->update()){
				$err_code = 'vac_update_002';
			}
		}

		//二类疫苗
		$vac_second_info = new Tvac_second_info();
		//$vac_second_info->uuid = $this->_request->getParam('uuid');//

		$vac_second_info->id = $this->_request->getParam('id');//

		$vac_second_info->created = $time;//

		$vac_second_info->vaccinum_name_1 = $this->_request->getParam('vaccinum_name_1');//

		$vac_second_info->vaccinum_time_1 = check_utime($this->_request->getParam('vaccinum_time_1'));//

		$vac_second_info->vaccinum_part_1 = $this->_request->getParam('vaccinum_part_1');//

		$vac_second_info->vaccinum_batch_1 = $this->_request->getParam('vaccinum_batch_1');//

		$vac_second_info->vaccinum_effective_1 = check_utime($this->_request->getParam('vaccinum_effective_1'));//

		$vac_second_info->vaccinum_enterprises_1 = $this->_request->getParam('vaccinum_enterprises_1');//

		$vac_second_info->vaccinum_doctor_1 = $this->_request->getParam('vaccinum_doctor_1');//

		$vac_second_info->vaccinum_remark_1 = $this->_request->getParam('vaccinum_remark_1');//
		$vac_second_info->vaccinum_name_2 = $this->_request->getParam('vaccinum_name_2');//

		$vac_second_info->vaccinum_time_2 = check_utime($this->_request->getParam('vaccinum_time_2'));//

		$vac_second_info->vaccinum_part_2 = $this->_request->getParam('vaccinum_part_2');//

		$vac_second_info->vaccinum_batch_2 = $this->_request->getParam('vaccinum_batch_2');//

		$vac_second_info->vaccinum_effective_2 = check_utime($this->_request->getParam('vaccinum_effective_2'));//

		$vac_second_info->vaccinum_enterprises_2 = $this->_request->getParam('vaccinum_enterprises_2');//

		$vac_second_info->vaccinum_doctor_2 = $this->_request->getParam('vaccinum_doctor_2');//

		$vac_second_info->vaccinum_remark_2 = $this->_request->getParam('vaccinum_remark_2');//

		$vac_second_info->vaccinum_name_3 = $this->_request->getParam('vaccinum_name_3');//
		$vac_second_info->vaccinum_time_3 = check_utime($this->_request->getParam('vaccinum_time_3'));//

		$vac_second_info->vaccinum_part_3 = $this->_request->getParam('vaccinum_part_3');//

		$vac_second_info->vaccinum_batch_3 = $this->_request->getParam('vaccinum_batch_3');//

		$vac_second_info->vaccinum_effective_3 = check_utime($this->_request->getParam('vaccinum_effective_3'));//

		$vac_second_info->vaccinum_enterprises_3 = $this->_request->getParam('vaccinum_enterprises_3');//

		$vac_second_info->vaccinum_doctor_3 = $this->_request->getParam('vaccinum_doctor_3');//

		$vac_second_info->vaccinum_remark_3 = $this->_request->getParam('vaccinum_remark_3');//

		if(empty($uuid)){
			//添加入库
			$vac_second_info->uuid = $_uid;
			//$vac_second_info->staff_id = $doctor_current_id;
			$vac_second_info->id = $id;
			if(!$vac_second_info->insert()){
				$err_code = 'vac_insert_003';
			}
		}else{
			//修改入库
			$vac_second_info->whereAdd("id = '$uuid'");
			if(!$vac_second_info->update()){
				$err_code = 'vac_update_002';
			}
		}
		$url=array("预防接种卡记录"=>__BASEPATH.'vaccinate/index/index',
		"个人档案列表"=>__BASEPATH.'iha/index/index');
		message("更新成功，返回代码：".$err_code,$url);
	}
	//删除记录
	public function delAction(){
		$err_code = '无';
		$_id = $this->_request->getParam('id');
		if(empty($_id)){
			$url=array("预防接种卡记录"=>__BASEPATH.'vaccinate/index/index',
			"个人档案列表"=>__BASEPATH.'iha/index/index');
			message("参数无效，删除失败",$url);
		}
		$vac_card = new Tvac_card();
		$vac_card->whereAdd("id = '$_id'");
		if(!$vac_card->delete()){
			$err_code = 'vac_delete_001';
		}
		$vac_info = new Tvac_info();
		$vac_info->whereAdd("id = '$_id'");
		if(!$vac_info->delete()){
			$err_code = 'vac_delete_002';
		}
		$vac_second_info = new Tvac_second_info();
		$vac_second_info->whereAdd("id = '$_id'");
		if(!$vac_second_info->delete()){
			$err_code = 'vac_delete_003';
		}
		$url=array("预防接种卡记录"=>__BASEPATH.'vaccinate/index/index',
		"个人档案列表"=>__BASEPATH.'iha/index/index');
		message("删除成功，返回代码：".$err_code,$url);
	}

	/**
	 * CSV上传页面
	 *
	 */
	public function displayAction(){
		//print_r($this->user);
		//phpinfo();
		$this->view->display("display.html");
	}
	/**
 * 预防接种数据导入执行过程
 *
 */
	public function processAction(){

		//start文件上传
		$old_filename=$_FILES['upload_name']['name'];
		//检查上传文件合法性
		if(preg_match("~\.csv$~i",$old_filename)===false){
			message('上传文件格式错误！');
		}
		//文件大小
		$file_size=$_FILES['upload_name']['size'];
		if($file_size>5000000){
			maessage('上传文件大小不能超过5M！');
		}
		ob_start();
		$upload_dir=__SITEROOT.'upload/';
		$upload_file=$upload_dir.uniqid().'.csv';
		//echo $upload_file;
		//print_r($_FILES['upload_name']);
		//end 文件上传
		if (move_uploaded_file($_FILES['upload_name']['tmp_name'], $upload_file)) {

			//echo "<br/>File is valid, and was successfully uploaded.\n";
			//echo $upload_file;
			echo '文件上传成功！'."<br/>";
			//flush();
			//ob_flush();

			//清理CSV中的数据
			$row 			= 0;//行号
			$title_token	= 0;//标题标识
			$org_name		= "";//机构名
			$tmp_array		= array();//临时数组、解决用户为空的情况
			$tmp_token		= 0;//首次出现机构标志--过滤错误数据

			$handle 		= fopen($upload_file,"r");
			//setlocale(LC_ALL, 'zh_CN.GBK');
			
			while ($data = $this->fgetcsv_reg($handle)) {
				//print_r($data);
				//新数组
				$new_data	= array();
				//是标题就跳到下次循环
				if($title_token==1){
					$title_token	= 0;
					continue;
				}
				$num 				= count($data);


				if(!isset($data[1])){
					continue;
				}

				$str				= iconv('gbk','utf-8',$data[1]);//所在区别数据
				//echo $str."所在区别数据<br/>";
				$pattern			= "~(?<=所在区域：).*~";
				//得到机构名
				if(preg_match($pattern,$str,$match)){
					echo "所在区域<br/>";
					$org_name		= $match[0];
					$title_token	= 1;
					$tmp_token		= 1;//正常数据标志
					continue;

				}

				//exit();
				//过滤错误数据
				if($tmp_token==0){
					continue;
				}

				$name						= iconv('gbk','utf-8',$data[1]);//姓名
				$vaccine					= iconv('gbk','utf-8',$data[11]);//接种疫苗

				//print_r($name.$vaccine);
				if($name=='' && $vaccine!='' ){
					//用户名为空，接种名不为空 始用临时数组中的人的信息
					$new_data					= $tmp_array;
					//print_r($new_data);
				}elseif($name!='' && $vaccine!='' ){
					//用户名和接种名不为空重新取值并且存放新的临时数组
					$new_data['name']			= $name;//姓名
					$new_data['sex']			= iconv('gbk','utf-8',$data[2]);//性别
					$new_data['borth']			= iconv('gbk','utf-8',$data[3]);//出生日期
					$new_data['parent_name']	= iconv('gbk','utf-8',$data[4]);//家长姓名
					$new_data['phone']			= iconv('gbk','utf-8',$data[5]);//联系电话
					$new_data['mobile_phone']	= iconv('gbk','utf-8',$data[6]);//手机号码
					$new_data['cart_date']		= iconv('gbk','utf-8',$data[7]);//建卡日期
					$new_data['book']			= iconv('gbk','utf-8',$data[8]);//在册情况
					$new_data['address']		= iconv('gbk','utf-8',$data[10]);//通讯地址

					$tmp_array					= $new_data;//临时数组
				}
				$new_data['vaccine']		= $vaccine;//接种疫苗
				$new_data['doses']			= $this->get_does(iconv('gbk','utf-8',$data[12]));//剂次
				$new_data['servings']		= iconv('gbk','utf-8',$data[13]);//人份
				$new_data['vaccine_date']	= iconv('gbk','utf-8',$data[14]);//接种日期
				$new_data['free']			= iconv('gbk','utf-8',$data[15]);//免费
				$new_data['batch_number']	= iconv('gbk','utf-8',$data[16]);//疫苗批号
				$new_data['manufacturer']	= iconv('gbk','utf-8',$data[17]);//生产企业
				$new_data['org_name']		= $org_name;//机构名
				// print_r($data);
				//print_r($new_data);
				//由个人姓名 性别 生出日期 亲人姓名得到个人uuid
				$uuid='';
				if(isset($new_data['name']) || isset($new_data['sex']) || isset($new_data['borth']) || isset($new_data['parent_name'])){
					$uuid=$this->getuuid($new_data['name'],$new_data['sex'],$new_data['borth'],$new_data['parent_name']);
				}


				//echo $uuid;
				//在社区系统中存在的用户才予以导入
				if(!empty($uuid)){
					//var_dump($uuid);
					//continue;
					//print_r($new_data);
					$vac_card=new Tvac_card();
					$vac_card->whereAdd("id='$uuid'");//个人档案号
					$vac_card->find();
					$vac_card->fetch();
					$vac_card_uuid=$vac_card->uuid;//建卡对应uuid
					$vac_card->free_statement();
					//$row++;//导入行数
					//建卡存在更新记录
					if(!empty($vac_card_uuid)){
						//===start 更新建卡
						$vac_card=new Tvac_card();
						$vac_card->staff_id = $this->user['uuid'];//医生档案号
						//$vac_card->id = $uuid;//个人档案号
						//$vac_card->created = $this->_request->getParam('created');//创建时间
						$vac_card->sex = $new_data['sex'];//性别
						$vac_card->date_of_birth = strtotime($new_data['borth']);//出生日期
						$vac_card->guardian = $new_data['parent_name'];//监护人
						$vac_card->telephone = $new_data['phone'];//联系电话
						$vac_card->created_card_time = strtotime($new_data['cart_date']);//建卡日期
						$vac_card->created_doc = $this->user['name_real'];//建卡人
						$vac_card->whereAdd("uuid='$vac_card_uuid'");
						if($vac_card->update()){
							$row++;//导入行数
						}
					
						//$vac_card->free_statement();
						//===stop 更新建卡
						//===start 更新接种
						$vac_info=new Tvac_info();
						//$vac_info->uuid=$vac_uuid;
						//$vac_info->staff_id = $this->user['uuid'];//医生档案号
						//$vac_info->id = $uuid;//个人档案号
						//$vac_info->created = time();//创建时间
						foreach ($this->relation as $relation_array){
							//print_r($new_data);
							if($new_data['vaccine']==$relation_array[0] && $new_data['doses']==$relation_array[1]  ){
								$vaccine_date=$relation_array[2][0];//接种时间字段
								$batch_number=$relation_array[2][1];//疫苗批次字段
								$manufacturer=$relation_array[2][2];//疫苗生产企业字段
								$doctor_name =$relation_array[2][3];//接种医生名字段

								$vac_info->$vaccine_date=strtotime($new_data['vaccine_date']);//接种时间
								$vac_info->$batch_number=$new_data['batch_number'];//疫苗批次
								$vac_info->$manufacturer=$new_data['manufacturer'];//疫苗生产企业
								$vac_info->$doctor_name=$this->user['name_real'];//接种医生
							}

						}
						$vac_info->whereAdd("uuid='$vac_card_uuid'");
						if($vac_info->update()){
							$row++;//导入行数
						}
						//===stop  更新接种
						//===start 更新二类疫苗接种
						//===start 插入二类疫苗接种
						$vac_second_info=new Tvac_second_info();
						//$vac_second_info->uuid=$vac_uuid;
						//$vac_second_info->staff_id = $this->user['uuid'];//医生档案号
						//$vac_second_info->id = $uuid;//个人档案号
						//$vac_second_info->created = time();//创建时间
						//print_r($new_data);
						foreach ($this->relation_two as $relation_two_array){
							//print_r($relation_two_array);
							//print_r($new_data);
							if($relation_two_array[0]==$new_data['vaccine']){

								$vac_field			= $relation_two_array[1][0];//二次疫苗名字段
								$vac_time			= $relation_two_array[1][1];//二次疫苗时间字段
								$vac_batch_number	= $relation_two_array[1][2];//二次疫苗批次字段
								$vac_facturer		= $relation_two_array[1][3];//二次疫苗生产企业
								$doctor_name 		= $relation_two_array[1][4];//接种医生名字段
								$vac_second_info->$vac_field		= $relation_two_array[0];
								$vac_second_info->$vac_time			= strtotime($new_data['vaccine_date']);//接种时间
								$vac_second_info->$vac_batch_number	= $new_data['batch_number'];//疫苗批次
								$vac_second_info->$vac_facturer		= $new_data['manufacturer'];//疫苗生产企业
								$vac_second_info->$doctor_name		= $this->user['name_real'];//接种医生


							}
						}

						//$vac_second_info->debugLevel(3);
						$vac_second_info->whereAdd("uuid='$vac_card_uuid'");
						if($vac_second_info->update()){
							$row++;//导入行数
						}



						//===stop  插入二类疫苗接种

						//===stop  更新二类疫苗接种
					}else {
						//print_r($new_data);
						//建卡不存在插入记录
						//===start 插入建卡
						$vac_uuid=uniqid('vc',true);
						$vac_card=new Tvac_card();
						$vac_card->uuid=$vac_uuid;
						$vac_card->staff_id = $this->user['uuid'];//医生档案号
						$vac_card->id = $uuid;//个人档案号
						$vac_card->created = time();//创建时间
						$vac_card->sex = $new_data['sex'];//性别
						$vac_card->date_of_birth = strtotime($new_data['borth']);//出生日期
						$vac_card->guardian = $new_data['parent_name'];//监护人
						$vac_card->telephone = $new_data['phone'];//联系电话
						$vac_card->created_card_time = strtotime($new_data['cart_date']);//建卡日期
						$vac_card->created_doc = $this->user['name_real'];//建卡人
						//$vac_card->whereAdd("uuid='$vac_card_uuid'");
						if($vac_card->insert()){
							$row++;//导入行数
						}
						//$vac_card->free_statement();
						//===stop 插入建卡
						//===start 插入接种


						$vac_info=new Tvac_info();
						$vac_info->uuid=$vac_uuid;
						//$vac_info->staff_id = $this->user['uuid'];//医生档案号
						$vac_info->id = $uuid;//个人档案号
						$vac_info->created = time();//创建时间
						foreach ($this->relation as $relation_array){
							if($new_data['vaccine']==$relation_array[0] && $new_data['doses']==$relation_array[1]  ){
								$vaccine_date=$relation_array[2][0];//接种时间字段
								$batch_number=$relation_array[2][1];//疫苗批次字段
								$manufacturer=$relation_array[2][2];//疫苗生产企业字段
								$doctor_name =$relation_array[2][3];//接种医生名字段

								$vac_info->$vaccine_date=strtotime($new_data['vaccine_date']);//接种时间
								$vac_info->$batch_number=$new_data['batch_number'];//疫苗批次
								$vac_info->$manufacturer=$new_data['manufacturer'];//疫苗生产企业
								$vac_info->$doctor_name=$this->user['name_real'];//接种医生
							}

						}
						if($vac_info->insert()){
							$row++;//导入行数
						}

						//===stop  插入接种
						//===start 插入二类疫苗接种
						$vac_second_info=new Tvac_second_info();
						$vac_second_info->uuid=$vac_uuid;
						//$vac_second_info->staff_id = $this->user['uuid'];//医生档案号
						$vac_second_info->id = $uuid;//个人档案号
						$vac_second_info->created = time();//创建时间
						//print_r($new_data);
						foreach ($this->relation_two as $relation_two_array){
							//print_r($relation_two_array);
							//print_r($new_data);
							if($relation_two_array[0]==$new_data['vaccine']){

								$vac_field			= $relation_two_array[1][0];//二次疫苗名字段
								$vac_time			= $relation_two_array[1][1];//二次疫苗时间字段
								$vac_batch_number	= $relation_two_array[1][2];//二次疫苗批次字段
								$vac_facturer		= $relation_two_array[1][3];//二次疫苗生产企业
								$doctor_name 		= $relation_two_array[1][4];//接种医生名字段
								$vac_second_info->$vac_field		= $relation_two_array[0];
								$vac_second_info->$vac_time			= strtotime($new_data['vaccine_date']);//接种时间
								$vac_second_info->$vac_batch_number	= $new_data['batch_number'];//疫苗批次
								$vac_second_info->$vac_facturer		= $new_data['manufacturer'];//疫苗生产企业
								$vac_second_info->$doctor_name		= $this->user['name_real'];//接种医生


							}
						}
						//$vac_second_info->debugLevel(3);
						if($vac_second_info->insert()){
							$row++;//导入行数
						}


						//===stop  插入二类疫苗接种
					}



				}



				//echo  "<br>\n";

			}
			fclose($handle);
			echo '更新接种次数'.$row."<br/>";
			//flush();
			//ob_flush();

			if(unlink($upload_file)){
				echo '删除上传文件！'."<br/>";

			}

			//echo '文件导入成功！'."<br/>";

		} else {
			message('文件上传失败！');
		}



	}
	/**
     * 由个人姓名、性别、出生日期、家庭成员姓名确认得到个人的uuid
     *
     * @param string $name
     * @param string $sex 如 男
     * @param string $date_of_birth 如2011-05-05 
     * @param string $parent_name
     * @return string
     */

	private function getuuid($name,$sex,$date_of_birth,$parent_name){
		$n = func_num_args();//参数个数
		$result='';//返回结果
		if($n!=4){
			$result='';
		}else{

			require_once __SITEROOT."/library/Models/individual_core.php";
			$org_id=$this->user['org_id'];//机构id
			$sex_code=$this->getSexCode($sex);//性别标准代码
			$time_of_birth=strtotime($date_of_birth);//出生时间戳
			$family_number='';//家庭档案号

			$individual_core=new Tindividual_core();
			$individual_core->whereAdd("org_id='$org_id'");//机构
			$individual_core->whereAdd("name='$name'");//姓名
			$individual_core->whereAdd("sex='$sex_code'");//性别
			$individual_core->whereAdd("date_of_birth=$time_of_birth");//出生日期
			//$individual_core->debugLevel(3);
			$individual_core->find();
			$individual_core->fetch();
			$family_number=$individual_core->family_number;//家庭档案号
			$individual_uuid=$individual_core->uuid;//档案uuid
			$individual_core->free_statement();
			if($family_number==''){
				$result='';
			}else{
				//根据得到的家庭档案号，查询有没有成员是$parent_name，如果存在返回个人的uuid，不存在返回空
				$individual_core=new Tindividual_core();
				$individual_core->whereAdd("org_id='$org_id'");//机构
				$individual_core->whereAdd("family_number='$family_number'");//
				$individual_core->whereAdd("name='$parent_name'");
				//$individual_core->debugLevel(3);
				$count=$individual_core->count();//
				if($count>0){
					$result=$individual_uuid;
				}
				//var_dump($result);
				$individual_core->free_statement();
			}
		}
		return $result;

	}
	/**
	 * 根据中文名得到性别国家标准代码
	 *
	 * @param string $sex_name
	 * @return string
	 */
	private function getSexCode($sex_name){
		$result='';//返回结果
		$sex_array=array('0'=>array('1','未知的性别'),'1'=>array('2','男'),'2'=>array('3','女'),'9'=>array('4','未说明的性别'));
		foreach ($sex_array as $key=>$sex_arr){
			if($sex_arr[1]==$sex_name){
				$result=$sex_arr[0];
				break;
			}
		}
		return $result;
	}
	/**
	 * excel中剂次与中数字对应
	 *
	 * @param string $val
	 * @return int
	 */
	private function get_does($val){
		//excel中剂次
		$data_array=array(1=>'①',2=>'②',3=>'③',4=>'④');
		$result=0;
		foreach ($data_array as $key=>$value){
			if($val==$value){
				$result=$key;
				break;
			}
		}
		return $result;

	}
	/**
	 * 导入数据疫苗与预防接种疫苗映射
	 *
	 * @var array
	 */
	private $relation	= array(
	'0'=>array('乙肝(酵母)',1,array('hepatitis_time_1','hepatitis_batch_1','hepatitis_enterprises_1','hepatitis_doctor_1')),
	'1'=>array('乙肝(酵母)',2,array('hepatitis_time_2','hepatitis_batch_2','hepatitis_enterprises_2','hepatitis_doctor_2')),
	'2'=>array('乙肝(酵母)',3,array('hepatitis_time_3','hepatitis_batch_3','hepatitis_enterprises_3','hepatitis_doctor_3')),
	'3'=>array('卡介苗',1,array('bcg_time','bcg_batch','bcg_enterprises','bcg_doctor')),
	'4'=>array('脊灰',1,array('polio_time_1','polio_batch_1','polio_enterprises_1','polio_doctor_1')),
	'5'=>array('脊灰',2,array('polio_time_2','polio_batch_2','polio_enterprises_2','polio_doctor_2')),
	'6'=>array('脊灰',3,array('polio_time_3','polio_batch_3','polio_enterprises_3','polio_doctor_3')),
	'7'=>array('脊灰',4,array('polio_time_4','polio_batch_4','polio_enterprises_4','polio_doctor_4')),
	'8'=>array('百白破',1,array('dpt_time_1','dpt_batch_1','dpt_enterprises_1','dpt_doctor_1')),
	'9'=>array('百白破',2,array('dpt_time_2','dpt_batch_2','dpt_enterprises_2','dpt_doctor_2')),
	'10'=>array('百白破',3,array('dpt_time_3','dpt_batch_3','dpt_enterprises_3','dpt_doctor_3')),
	'11'=>array('百白破',4,array('dpt_time_4','dpt_batch_4','dpt_enterprises_4','dpt_doctor_4')),
	'12'=>array('白破',1,array('rubella_time','rubella_batch','rubella_enterprises','rubella_doctor')),
	'13'=>array('麻风',1,array('lepra_time','lepra_batch','lepra_enterprises','lepra_doctor')),
	'14'=>array('麻腮风',1,array('mmr_time_1','mmr_batch_1','mmr_enterprises_1','mmr_doctor_1')),
	'15'=>array('麻腮风',2,array('mmr_time_2','mmr_batch_2','mmr_enterprises_2','mmr_doctor_2')),
	'16'=>array('麻腮',1,array('mm_time','mm_batch','mm_enterprises','mm_doctor')),
	'17'=>array('麻疹',1,array('measles_time_1','measles_batch_1','measles_enterprises_1','measles_doctor_1')),
	'18'=>array('麻疹',2,array('measles_time_2','measles_batch_2','measles_enterprises_2','measles_doctor_2')),
	'19'=>array('流脑A群',1,array('a_time_1','a_batch_1','a_enterprises_1','a_doctor_1')),
	'20'=>array('流脑A群',2,array('a_time_2','a_batch_2','a_enterprises_2','a_doctor_2')),
	'21'=>array('乙脑(减毒)',1,array('att_time_1','att_batch_1','att_enterprises_1','att_doctor_1')),
	'22'=>array('乙脑(减毒)',2,array('att_time_2','att_batch_2','att_enterprises_2','att_doctor_2')),
	'22'=>array('甲肝(减毒)',1,array('hepatt_time','hepatt_batch','hepatt_enterprises','hepatt_doctor'))
	);
	/**
	 * 二类疫苗映射关系
	 *
	 * @var unknown_type
	 */
	private $relation_two=array('0'=>array('Hib',array('vaccinum_name_1','vaccinum_time_1','vaccinum_batch_1','vaccinum_enterprises_1','vaccinum_doctor_1'))
	);
/**
 * 替换CSV中中文出现乱码造成的数据丢失
 *
 * @param handle $handle 
 * @param unknown_type $length
 * @param unknown_type $d
 * @param unknown_type $e
 * @return unknown
 */

	private function fgetcsv_reg(& $handle, $length = null, $d = ',', $e = '”') {
		$d = preg_quote($d);
		$e = preg_quote($e);
		$_line = '';
		$eof=false;
		while ($eof != true) {
			$_line .= (empty ($length) ? fgets($handle) : fgets($handle, $length));
			$itemcnt = preg_match_all('/' . $e . '/', $_line, $dummy);
			if ($itemcnt % 2 == 0)
			$eof = true;
		}
		$_csv_line = preg_replace('/(?: |[ ])?$/', $d, trim($_line));
		$_csv_pattern = '/(' . $e . '[^' . $e . ']*(?:' . $e . $e . '[^' . $e . ']*)*' . $e . '|[^' . $d . ']*)' . $d . '/';
		preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
		$_csv_data = $_csv_matches[1];
		for ($_csv_i = 0; $_csv_i < count($_csv_data); $_csv_i++) {
			$_csv_data[$_csv_i] = preg_replace('/^' . $e . '(.*)' . $e . '$/s', '$1', $_csv_data[$_csv_i]);
			$_csv_data[$_csv_i] = str_replace($e . $e, $e, $_csv_data[$_csv_i]);
		}
		return empty ($_line) ? false : $_csv_data;
	}





}
?>