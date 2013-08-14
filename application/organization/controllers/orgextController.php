<?php 
 class organization_orgextcontroller extends controller{
 	public function init(){
 		require_once(__SITEROOT.'library/privilege.php');
 		require_once __SITEROOT.'library/Models/organization.php';
 		require_once __SITEROOT.'library/Models/chs_center.php';
 	    require_once __SITEROOT.'library/Models/org_ext_1.php';
 	    require_once __SITEROOT.'library/Models/org_ext_2.php';
 	    require_once __SITEROOT.'library/Models/org_ext_3.php';
 	    require_once __SITEROOT.'library/Models/org_ext_4.php';
 	    require_once __SITEROOT.'library/Models/org_ext_5.php';
 	    require_once __SITEROOT.'library/Models/org_ext_6.php';
 	    require_once __SITEROOT."/library/custom/pager.php";//分页类
 	}
 	//按照年份进行多条数据的添加进行列表显示
 	public function listAction()
 	{
 		$this->view->basePath = __BASEPATH;
 		$org_id = $this->user['org_id'];
 		//获取当前机构的名称
 		$organization = new Torganization();
 		$organization->whereAdd("id='$org_id'");
 		$organization->find(true);
 		$this->view->orgname  =  $organization->zh_name;
 		$this->view->org_id   =  $org_id;
 		$this->view->org_type =  $organization->type;
 		//取得当前机构各年的所有机构
 		$search =  array();
 		$chs_center = new Tchs_center();
 		$organization = new  Torganization();
 		$chs_center->joinAdd("left",$chs_center,$organization,'chsc_id','id');
 		$chs_center->whereAdd("chs_center.chsc_id='$org_id'");
 		$chs_center->whereAdd("organization.type='3' or organization.type='5'");
 		$nums = $chs_center->count();
 		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'children/children/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$chs_center->orderby('year DESC');
		$chs_center->limit($startnum,__ROWSOFPAGE);
		$chs_center_array = array();
		$chs_count = 0;
		$chs_center->find();
		while ($chs_center->fetch())
		{
			$chs_center_array[$chs_count]['year'] = $chs_center->year;
			$chs_count++;
		}
		$this->view->chs_center_array = $chs_center_array;
		$this->view->page = $links->subPageCss2();
 		$this->view->display('index.html');
 	}
 	public function indexAction(){
 		require_once __SITEROOT.'library/data_arr/arrdata.php';
 		$org_id = $this->_request->getParam('org_id');
 		$org_year = $this->_request->getParam('org_year');
 		if(!empty($org_id)&&!empty($org_type))
 		{
 			$currentId = $org_id;
 		}
 		else 
 		{
 		   $currentId = $this->user['org_id'];
 		}
 		//获取当前机构的名称
 		$organization = new Torganization();
 		$organization->whereAdd("id='$currentId'");
 		$organization->find(true);
 		$this->view->basePath = __BASEPATH;
 		$this->view->orgname  =  $organization->zh_name;
 		$this->view->orgtype  =  $organization->type;
 		//科室设置
 		$arroffice = '';
 		foreach ($office_setting as $k=>$v){
 		   $arroffice.=$v[1].','; 
 		}
 		$arroffice_get = explode(',',rtrim($arroffice,','));
 		$this->view->office_setting = $arroffice_get;
 		//提供的服务
 		$arrservice = '';
 		foreach ($service_setting as $k=>$v){
 		   $arrservice.=$v[1].','; 
 		}
 		$arrservice_get = explode(',',rtrim($arrservice,','));
 		//提供的服务
 		$arrequipment = '';
 		foreach ($equipment_setting as $k=>$v){
 		   $arrequipment.=$v[1].','; 
 		}
 		$arrequipment_get = explode(',',rtrim($arrequipment,','));
 		$this->view->office_setting    = $arroffice_get;
 		$this->view->service_setting   = $arrservice_get;
 		$this->view->equipment_setting = $arrequipment_get;
 		//基本信息
 		//社区卫生服务中心设立地
 		 $regionalismarr = '';
 		 foreach($regionalism_adscription as $k=>$v){
 		 	$regionalismarr.=$v[1].',';
 		 } 
 		 $regionalismarr_get = explode(',',rtrim($regionalismarr,','));
 		 //政府办机构隶属关系
 		 $org_under_typearr = '';
 		 foreach ($org_under_type as $k=>$v){
 		 	$org_under_typearr.=$v[1].',';
 		 }
 		 $org_under_typearr_get = explode(',',rtrim($org_under_typearr,','));
 		 //基本信息设置/主办单位
 		 $org_typearr = '';
 		 foreach ($org_type as $k=>$v){
 		 	$org_typearr.=$v[1].',';
 		 }
 		 $org_typearr_get = explode(',',rtrim($org_typearr,','));
 		 //非独立法人挂靠单位
 		 $mount_typearr = '';
 		 foreach($mount_type as $k=>$v){
 		 	$mount_typearr.=$v[1].',';
 		 }
 		 $mount_typearr_get = explode(',',rtrim($mount_typearr,','));
 		 $this->view->regionalismarr_get    = $regionalismarr_get;
 		 $this->view->org_under_typearr_get = $org_under_typearr_get;
 		 $this->view->org_typearr_get       = $org_typearr_get;
 		 $this->view->mount_typearr_get     = $mount_typearr_get;
 		 if(!empty($org_id)&&!empty($org_type))
 		 {
	 		 $baseinfo = new Tchs_center();
	 		 $baseinfo->whereAdd("chsc_id='$currentId'");
	 		 $baseinfo->whereAdd("year='$org_year'");
	 		 $baseinfo->find(true);
	 		 if($baseinfo->org_code){
	 		 $orgcodearr = explode('-',$baseinfo->org_code);
	 		 $this->view->org_code                   = $orgcodearr[0];
	 		 $this->view->org_code_last              = $orgcodearr[1];
	 		 }
	 		 $this->view->health_org_code            = $baseinfo->health_org_code;
	 		 $this->view->org_year                   = $baseinfo->year;
	 		 $this->view->org_property_region_code   = $baseinfo->org_property_region_code;
	 		 $this->view->org_property_economy_code  = $baseinfo->org_property_economy_code;
	 		 $this->view->org_property_type_code     = $baseinfo->org_property_type_code;
	 		 $this->view->org_property_manage_code   = $baseinfo->org_property_manage_code;
	 		 $this->view->address                    = $baseinfo->address;
	 		 $this->view->postal_code                = $baseinfo->postal_code;
	 		 $this->view->telephone_number_area      = $baseinfo->telephone_number_area;
	 		 $this->view->telephone_number           = $baseinfo->telephone_number;
	 		 $this->view->email                      = $baseinfo->email;
	 		 $this->view->host_domain                = $baseinfo->host_domain;
	 		 $this->view->build_date                 = empty($baseinfo->build_date)?'':date('Y-m-d',$baseinfo->build_date);
	 		 $this->view->regionalism_adscription    = $baseinfo->regionalism_adscription;
	 		 $this->view->org_type                   = $baseinfo->org_type;
	 		 $this->view->org_under_type             = $baseinfo->org_under_type;
	 		 $this->view->register_bankroll          = $baseinfo->register_bankroll;
	 		 $this->view->principal                  = $baseinfo->principal;
	 		 $this->view->is_nation_autonomy         = $baseinfo->is_nation_autonomy;
	 		 $this->view->is_medicare_point_hospital = $baseinfo->is_medicare_point_hospital;
	 		 $this->view->is_new_point_hospital      = $baseinfo->is_new_point_hospital;
	 		 $this->view->is_common_event_report     = $baseinfo->is_common_event_report;
	 		 $this->view->computer_count             = $baseinfo->computer_count;
	 		 $this->view->has_health_edu_equipment   = $baseinfo->has_health_edu_equipment;
	 		 $this->view->child_chss_count           = $baseinfo->child_chss_count;
	 		 $this->view->is_leaf                    = $baseinfo->is_leaf;
	 		 $this->view->mount_type                 = $baseinfo->mount_type;
	 		//床位信息
	 		 $bedinfo = new Torg_ext_1();
	 		 $bedinfo->whereAdd("id='$currentId'");
	 		 $bedinfo->whereAdd("year='$org_year'");
	 		 $bedinfo->find(true);
	 		 $this->view->totalbed_days_new       = $bedinfo->totalbed_days;
	 		 $this->view->occupied_bed_new        = $bedinfo->occupied_bed; 
	 		 $this->view->bednumber_new           = $bedinfo->bed_number;
	 		 $this->view->bed_allnumber_new       = $bedinfo->bed_allnumber;
	 		 $this->view->poverty_beds_new        = $bedinfo->poverty_beds;
	 		 $this->view->poverty_occupiedbed_new = $bedinfo->poverty_occupiedbed;
	 		 $this->view->tbo_total_new           = $bedinfo->tbo_total;
	 		 $this->view->observation_bed_new     = $bedinfo->observation_bed;
	 		 $this->view->family_beds_new         = $bedinfo->family_beds;
	 		 //设备信息
	         $equipment = new Torg_ext_3();
	         $equipment->whereAdd("id='$currentId'");
	         $equipment->whereAdd("year='$org_year'");
	         $equipment->find(true);
	         $this->view->equipment_total_value_new        = $equipment->equipment_total_value;
	         $this->view->equipment_total_number_new       = $equipment->equipment_total_number;
	         $this->view->total_50_to_100_equipment_number = $equipment->five_equipment;
	         $this->view->total_over_100_equipment_number  = $equipment->over_100_equipment;
	         //房屋建筑信息
	         $building = new Torg_ext_2();
	         $building->whereAdd("id='$currentId'");
	         $building->whereAdd("year='$org_year'");
	         $building->find(true);
	         $this->view->area_new                = $building->area;
	         $this->view->operation_area_new      = $building->operation_area;
	         $this->view->peril_area_new          = $building->peril_area;
	         $this->view->hire_area_new           = $building->hire_area;
	         $this->view->hire_operation_area_new = $building->hire_operation_area;
	         $this->view->basic_build_pro_new     = $building->basic_build_pro;
	         $this->view->basic_build_area_new    = $building->basic_build_area;
	         $this->view->actual_invest_new       = $building->actual_invest;
	         $this->view->finance_invest_new      = $building->finance_invest;
	         $this->view->self_invest_new         = $building->self_invest;
	         $this->view->bank_invest_new         = $building->bank_invest;
	         $this->view->finish_area_new         = $building->finish_area;
	         $this->view->new_fixed_assets_new    = $building->new_fixed_assets;
	         $this->view->new_sickbed_new         = $building->new_sickbed;
	         //收入与支出
	         $inout = new Torg_ext_4();
	         $inout->whereAdd("id='$currentId'");
	         $inout->whereAdd("year='$org_year'");
	         $inout->find(true);
	         $this->view->total_income_new              =  $inout->total_income; 
	         $this->view->finance_income_new            =  $inout->finance_income; 
	         $this->view->superior_income_new           =  $inout->superior_income;
	         $this->view->medical_income_new            =  $inout->medical_income;
	         $this->view->medical_outpatient_income_new =  $inout->medical_outpatient_income;
	         $this->view->medical_hospital_income_new   =  $inout->medical_hospital_income;
	         $this->view->drug_income_new               =  $inout->drug_income;
	         $this->view->drug_outpatient_income_new    =  $inout->drug_outpatient_income;
	         $this->view->drug_hospital_income_new      =  $inout->drug_hospital_income;
	         $this->view->drug_other_income_new         =  $inout->drug_other_income;
	         $this->view->total_payout_new              =  $inout->total_payout;
	         $this->view->medical_payout_new            =  $inout->medical_payout;
	         $this->view->drug_payout_new               =  $inout->drug_payout;
	         $this->view->drug_fee_payout_new           =  $inout->drug_fee_payout;
	         $this->view->finance_payout_new            =  $inout->finance_payout;
	         $this->view->other_payout_new              =  $inout->other_payout;
	         $this->view->hr_payout_new                 =  $inout->hr_payout;
	         $this->view->retire_payout_new             =  $inout->retire_payout;
	         $this->view->arrear_payout_new             =  $inout->arrear_payout;
	         $this->view->arrear_payout_by_year_new     =  $inout->arrear_payout_by_year;
	         //资产与负债
	         $assets = new Torg_ext_5();
	         $assets->whereAdd("id='$currentId'");
	         $assets->whereAdd("year='$org_year'");
	         $assets->find(true);
	         $this->view->total_assets_new           = $assets->total_assets;
	         $this->view->current_assets_new         = $assets->current_assets;
	         $this->view->invest_new                 = $assets->invest;
	         $this->view->capital_asserts_new        = $assets->capital_asserts;
	         $this->view->immateriality_assets_new   = $assets->immateriality_assets;
	         $this->view->owes_assets_new            = $assets->owes_assets;
	         $this->view->long_standing_assets_new   = $assets->long_standing_assets;
	         $this->view->net_assets_new             = $assets->net_assets;
	         $this->view->project_assets_new         = $assets->project_assets;
	         $this->view->fixed_assets_new           = $assets->fixed_assets;
	         $this->view->special_assets_new         = $assets->special_assets;
	         //机构设置
	         $orgset = new Torg_ext_6();
	         $orgset->whereAdd("id='$currentId'");
	         $orgset->whereAdd("year='$org_year'");
	         $orgset->find(true);
	         //科室设置复选框数据
	         $officesetarr                         = explode('|',$orgset->officesetting);
	         $this->view->officeset                = $officesetarr;
	         //提供的服务复选框数据
	         $servicesetarr                        = explode('|',$orgset->service_setting);
	         $this->view->serviceset               = $servicesetarr;
	         //机构资源复选框数据
	         $orgthingarr                          = explode('|',$orgset->equipment_setting);
	         $this->view->equipmentset             = $orgthingarr;
	         //表单数据文本框数据
	         $this->view->area_new_new             = $orgset->area;
	         $this->view->sickbed_number_new_new   = $orgset->sickbed_number;
	         $this->view->sickbed_use_rate_new     = $orgset->sickbed_use_rate;
	         $this->view->outpatient_per_year_new  = $orgset->outpatient_per_year;
	         $this->view->emergency_per_year_new   = $orgset->emergency_per_year;
	         $this->view->iatrology_man_count_new  = $orgset->iatrology_man_count;
	         $this->view->gp_team_count_new        = $orgset->gp_team_count;
	         $this->view->gp_count_new             = $orgset->gp_count;
	         $this->view->community_nurse_count_new= $orgset->community_nurse_count;
	         $this->view->residenter_per_gp_new    = $orgset->residenter_per_gp;
	         $this->view->residenter_per_nurse_new = $orgset->residenter_per_nurse;
	         $this->view->add_tag = 0;
	         $this->view->org_id = $currentId;
 		 }
 		 else 
 		 {
 		 	 $this->view->add_tag = 1;
 		 	 $this->view->org_id = $currentId;
 		 }
 		 $this->view->display('list.html');
 	}
 	/**
 	 * 添加和编辑
 	 */
 	public function addAction(){
 		$this->view->basePath = __BASEPATH;
 		$action = $this->_request->getParam('action');
 		$org_id = $this->user['org_id'];
 		$add_tag = $this->_request->getParam('add_tag');
 		$ok = $this->_request->getParam('ok');
 			if($ok){
 			switch ($action){
 				//基本信息
 				case "baseinfo":			
 					$org_year = $this->_request->getParam('org_year_1');
 					//在数据表中存储形式为组织机构代码 前边输入框加逗号再加后边一位
 					$org_code                  = $this->_request->getParam('org_code');
 					$org_code_last             = $this->_request->getParam('org_code_last');
 					//其他输入框
 					$health_org_code           = $this->_request->getParam('health_org_code');
 					$org_property_region_code  = $this->_request->getParam('org_property_region_code');
 					$org_property_economy_code = $this->_request->getParam('org_property_economy_code');
 					$org_property_type_code    = $this->_request->getParam('org_property_type_code');
 					$org_property_manage_code  = $this->_request->getParam('org_property_manage_code');
 					$address                   = $this->_request->getParam('address');
 					$postal_code               = $this->_request->getParam('postal_code');
 					$telephone_number_area     = $this->_request->getParam('telephone_number_area');
 					$telephone_number          = $this->_request->getParam('telephone_number');
 					$email                     = $this->_request->getParam('email');
 					$host_domain               = $this->_request->getParam('host_domain');
 					$street                    = $this->_request->getParam('street');
 					//这里是时间需要特殊处理
 					$build_date                = strtotime($this->_request->getParam('build_date'));
 					//接下来的
 					$regionalism_adscription   = $this->_request->getParam('regionalism_adscription');
 					$org_type                  = $this->_request->getParam('org_type');
 					$org_under_type            = $this->_request->getParam('org_under_type');
 					$register_bankroll         = $this->_request->getParam('register_bankroll');
 					$principal                 = $this->_request->getParam('principal');
 					$is_nation_autonomy        = $this->_request->getParam('is_nation_autonomy');
 					$is_medicare_point_hospital= $this->_request->getParam('is_medicare_point_hospital');
 					$is_new_point_hospital     = $this->_request->getParam('is_new_point_hospital');
 					$is_common_event_report    = $this->_request->getParam('is_common_event_report');
 					$computer_count            = $this->_request->getParam('computer_count');
 					$has_health_edu_equipment  = $this->_request->getParam('has_health_edu_equipment');
 					$child_chss_count          = $this->_request->getParam('child_chss_count');
 					$is_leaf                   = $this->_request->getParam('is_leaf');
 					$mount_type                = $this->_request->getParam('mount_type');
 					$org_name                  = $this->_request->getParam('org_name');
 					if(!$add_tag){
 						//编辑数据
 						$chs_centerup = new Tchs_center();
 						$chs_centerup->whereAdd("chsc_id='$org_id'");
 						$chs_centerup->whereAdd("year='$org_year'");
 						$chs_centerup->updated                   = time();
 						$chs_centerup->org_code                  = $org_code.'-'.$org_code_last;
 						$chs_centerup->health_org_code           = $health_org_code;
 						$chs_centerup->org_property_region_code  = $org_property_region_code;
 						$chs_centerup->org_property_economy_code = $org_property_economy_code;
 						$chs_centerup->org_property_type_code    = $org_property_type_code;
 						$chs_centerup->org_property_manage_code  = $org_property_manage_code;
 						$chs_centerup->address                   = $address;
 						$chs_centerup->postal_code               = $postal_code;
 						$chs_centerup->telephone_number_area     = $telephone_number_area;
 						$chs_centerup->telephone_number          = $telephone_number;
 						$chs_centerup->email                     = $email;
 						$chs_centerup->host_domain               = $host_domain;
 						$chs_centerup->build_date                = $build_date;
 						$chs_centerup->regionalism_adscription   = $regionalism_adscription;
 						$chs_centerup->org_type                  = $org_type;
 						$chs_centerup->org_under_type            = $org_under_type;
 						$chs_centerup->register_bankroll         = $register_bankroll;
 						$chs_centerup->principal                 = $principal;
 						$chs_centerup->is_nation_autonomy        = $is_nation_autonomy;
 						$chs_centerup->is_medicare_point_hospital= $is_medicare_point_hospital;
 						$chs_centerup->is_new_point_hospital     = $is_new_point_hospital;
 						$chs_centerup->is_common_event_report    = $is_common_event_report;
 						$chs_centerup->computer_count            = $computer_count;
 						$chs_centerup->has_health_edu_equipment  = $has_health_edu_equipment;
 						$chs_centerup->child_chss_count          = $child_chss_count;
 						$chs_centerup->is_leaf                   = $is_leaf;
 						$chs_centerup->mount_type                = $mount_type;
 						$chs_centerup->street                    = $street;
 						$chs_centerup->org_name                  = $org_name;
 						//向机构表中添加数据
 						$orgobj = new Torganization();
 						$orgobj->whereAdd("id='$org_id'");
 						$orgobj->standard_code = $org_code.'-'.$org_code_last;
 						$orgobj->update();
 						if($chs_centerup->update()){
 							echo '<script type="text/javascript">window.alert("机构基本信息修改成功！");history.go(-1);</script>';
 						}
 					}else{
 						//添加数据
 					    $chs_centerinsert = new Tchs_center();
 						$chs_centerinsert->chsc_id                   = $org_id;
 						$chs_centerinsert->created                   = time();
 						$chs_centerinsert->org_code                  = $org_code.'-'.$org_code_last;
 						$chs_centerinsert->health_org_code           = $health_org_code;
 						$chs_centerinsert->org_property_region_code  = $org_property_region_code;
 						$chs_centerinsert->org_property_economy_code = $org_property_economy_code;
 						$chs_centerinsert->org_property_type_code    = $org_property_type_code;
 						$chs_centerinsert->org_property_manage_code  = $org_property_manage_code;
 						$chs_centerinsert->address                   = $address;
 						$chs_centerinsert->postal_code               = $postal_code;
 						$chs_centerinsert->telephone_number_area     = $telephone_number_area;
 						$chs_centerinsert->telephone_number          = $telephone_number;
 						$chs_centerinsert->email                     = $email;
 						$chs_centerinsert->host_domain               = $host_domain;
 						$chs_centerinsert->build_date                = $build_date;
 						$chs_centerinsert->regionalism_adscription   = $regionalism_adscription;
 						$chs_centerinsert->org_type                  = $org_type;
 						$chs_centerinsert->org_under_type            = $org_under_type;
 						$chs_centerinsert->register_bankroll         = $register_bankroll;
 						$chs_centerinsert->principal                 = $principal;
 						$chs_centerinsert->is_nation_autonomy        = $is_nation_autonomy;
 						$chs_centerinsert->is_medicare_point_hospital= $is_medicare_point_hospital;
 						$chs_centerinsert->is_new_point_hospital     = $is_new_point_hospital;
 						$chs_centerinsert->is_common_event_report    = $is_common_event_report;
 						$chs_centerinsert->computer_count            = $computer_count;
 						$chs_centerinsert->has_health_edu_equipment  = $has_health_edu_equipment;
 						$chs_centerinsert->child_chss_count          = $child_chss_count;
 						$chs_centerinsert->is_leaf                   = $is_leaf;
 						$chs_centerinsert->mount_type                = $mount_type;
 						$chs_centerinsert->org_name                  = $org_name;
 						$chs_centerinsert->year                      = $org_year;
 						//向机构表中添加数据
 						$orgobj = new Torganization();
 						$orgobj->whereAdd("id='$org_id'");
 						$orgobj->standard_code = $org_code.'-'.$org_code_last;
 						$orgobj->update();
 						if($chs_centerinsert->insert()){
 							echo '<script type="text/javascript">window.alert("机构基本信息添加成功！");window.location=\''.__BASEPATH.'organization/orgext/index/org_id/'.$org_id.'/org_year/'.$org_year.'\'</script>';
 							//$this->redirect(__BASEPATH."organization/orgext/list");
 						}
 					}
 					break;
 				//床位信息 
 				case "bedinfo":
  				    $bednumber            = $this->_request->getParam('bednumber');
				    $bed_allnumber        = $this->_request->getParam('bed_allnumber');
				    $poverty_beds         = $this->_request->getParam('poverty_beds');
				    $totalbed_days        = $this->_request->getParam('totalbed_days');
				    $occupied_bed         = $this->_request->getParam('occupied_bed');
				    $poverty_occupiedbed  = $this->_request->getParam('poverty_occupiedbed');
				    $tbo_total            = $this->_request->getParam('tbo_total');
				    $observation_bed      = $this->_request->getParam('observation_bed');
				    $family_beds          = $this->_request->getParam('family_beds');
				    $percentage           = $this->_request->getParam('percentage');
				    $org_year_2           = $this->_request->getParam('org_year_2');
				    $bedinfoup = new Torg_ext_1();
 					$bedinfoup->whereAdd("id='$org_id'");
 					$bedinfoup->whereAdd("year='$org_year_2'");
 					$count = $bedinfoup->count();
 					//编辑
 					if($count>0){
 					 $bedinfoup = new Torg_ext_1();
 					 $bedinfoup->whereAdd("id='$org_id'");
 					 $bedinfoup->whereAdd("year='$org_year_2'");
					 $bedinfoup->bed_number          = $bednumber;
					 $bedinfoup->bed_allnumber       = $bed_allnumber;
					 $bedinfoup->poverty_beds        = $poverty_beds;
					 $bedinfoup->totalbed_days       = $totalbed_days;
					 $bedinfoup->occupied_bed        = $occupied_bed;
					 $bedinfoup->poverty_occupiedbed = $poverty_occupiedbed;
					 $bedinfoup->tbo_total           = $tbo_total;
					 $bedinfoup->observation_bed     = $observation_bed;
					 $bedinfoup->family_beds         = $family_beds;
					 $bedinfoup->percentage          = $percentage;
					 if($bedinfoup->update()){
					    echo '<script type="text/javascript">window.alert("床位信息修改成功！");history.go(-1);</script>';
 			            //$this->view->msg = $msg;
 			          // $this->redirect(__BASEPATH.'organization/orgext/index');
					 }	
 					}else{
 					//要	进行添加
					 $bedinfo = new Torg_ext_1();
					 $bedinfo->bed_number          = $bednumber;
					 $bedinfo->bed_allnumber       = $bed_allnumber;
					 $bedinfo->poverty_beds        = $poverty_beds;
					 $bedinfo->totalbed_days       = $totalbed_days;
					 $bedinfo->occupied_bed        = $occupied_bed;
					 $bedinfo->poverty_occupiedbed = $poverty_occupiedbed;
					 $bedinfo->tbo_total           = $tbo_total;
					 $bedinfo->observation_bed     = $observation_bed;
					 $bedinfo->family_beds         = $family_beds;
					 $bedinfo->id                  = $org_id;
					 $bedinfo->percentage          = $percentage;
					 $bedinfo->year                = $org_year_2;
					 if($bedinfo->insert()){
					    echo '<script type="text/javascript">window.alert("床位信息添加成功！");history.go(-1);</script>';
 			            //$this->view->msg = $msg;
 			          // $this->redirect(__BASEPATH.'organization/orgext/index');
					 }
 					}
 					break;
 			    //设备信息
 				case "equipment":
 					$org_year_4 = $this->_request->getParam('org_year_4');
 					$equipment = new Torg_ext_3();
 					$equipment->whereAdd("id='$org_id'");
                    $equipment->whereAdd("year='$org_year_4'");
 					$equipment_total_value            = $this->_request->getParam('equipment_total_value');
 					$equipment_total_number           = $this->_request->getParam('equipment_total_number');
 					$total_50_to_100_equipment_number = $this->_request->getParam('total_50_to_100_equipment_number');
 					$total_over_100_equipment_number  = $this->_request->getParam('total_over_100_equipment_number');
 					if($equipment->count()>0){
 						//大于0就编辑
 						$equipmentup = new Torg_ext_3();
 						$equipmentup->whereAdd("id='$org_id'");
 						$equipmentup->whereAdd("year='$org_year_4'");
 						$equipmentup->equipment_total_value   = $equipment_total_value;
 						$equipmentup->equipment_total_number  = $equipment_total_number;
 						$equipmentup->five_equipment          = $total_50_to_100_equipment_number;
 						$equipmentup->over_100_equipment      = $total_over_100_equipment_number;
 						if($equipmentup->update()){
 							 echo '<script type="text/javascript">window.alert("设备信息修改成功！");history.go(-1);</script>';
 						}
 					}else{
 						//否则就添加
 						$equipmentinsert = new Torg_ext_3();  
 						$equipmentinsert->equipment_total_value   = $equipment_total_value;
 						$equipmentinsert->equipment_total_number  = $equipment_total_number;
 						$equipmentinsert->five_equipment          = $total_50_to_100_equipment_number;  
 						$equipmentinsert->over_100_equipment      = $total_over_100_equipment_number; 
 						$equipmentinsert->id                      = $org_id;
 						$equipmentinsert->year                    = $org_year_4;
 						if($equipmentinsert->insert()){
 							echo '<script type="text/javascript">window.alert("设备信息添加成功！");history.go(-1);</script>';
 						}   
 					}
 					break;
 			     //房屋与建筑信息
 				case "building":
 					$org_year_3           = $this->_request->getParam('org_year_3');
 					$building = new Torg_ext_2();
 					$building->whereAdd("id='$org_id'");
 					$building->whereAdd("year='$org_year_3'");
 					$area                 = $this->_request->getParam('area');
 					$operation_area       = $this->_request->getParam('operation_area');
 					$peril_area           = $this->_request->getParam('peril_area');
 					$hire_area            = $this->_request->getParam('hire_area');
 					$hire_operation_area  = $this->_request->getParam('hire_operation_area');
 					$basic_build_pro      = $this->_request->getParam('basic_build_pro');
 					$basic_build_area     = $this->_request->getParam('basic_build_area');
 					$actual_invest        = $this->_request->getParam('actual_invest');
 					$finance_invest       = $this->_request->getParam('finance_invest');
 					$self_invest          = $this->_request->getParam('self_invest');
 					$bank_invest          = $this->_request->getParam('bank_invest');
 					$finish_area          = $this->_request->getParam('finish_area');
 					$new_fixed_assets     = $this->_request->getParam('new_fixed_assets');
 					$new_sickbed          = $this->_request->getParam('new_sickbed');
 					if($building->count()>0){
 						//当前进行编辑
 						$buildup = new Torg_ext_2();
 						$buildup->whereAdd("id='$org_id'");
 						$buildup->whereAdd("year='$org_year_3'");
 						$buildup->area                 = $area;
 						$buildup->operation_area       = $operation_area;
 						$buildup->peril_area           = $peril_area;
 						$buildup->hire_area            = $hire_area;
 						$buildup->hire_operation_area  = $hire_operation_area;
 						$buildup->basic_build_pro      = $basic_build_pro;
 						$buildup->basic_build_area     = $basic_build_area;
 						$buildup->actual_invest        = $actual_invest;
 						$buildup->finance_invest       = $finance_invest;
 						$buildup->self_invest          = $self_invest;
 						$buildup->bank_invest          = $bank_invest;
 						$buildup->finish_area          = $finish_area;
 						$buildup->new_fixed_assets     = $new_fixed_assets;
 						$buildup->new_sickbed          = $new_sickbed;
 						if($buildup->update()){
 							echo '<script type="text/javascript">window.alert("房屋与建筑信息修改成功！");history.go(-1);</script>';
 						}
 					}else{
 						//进行添加操作
 						$buildinsert = new Torg_ext_2();
 						$buildinsert->area                 = $area;
 						$buildinsert->operation_area       = $operation_area;
 						$buildinsert->peril_area           = $peril_area;
 						$buildinsert->hire_area            = $hire_area;
 						$buildinsert->hire_operation_area  = $hire_operation_area;
 						$buildinsert->basic_build_pro      = $basic_build_pro;
 						$buildinsert->basic_build_area     = $basic_build_area;
 						$buildinsert->actual_invest        = $actual_invest;
 						$buildinsert->finance_invest       = $finance_invest;
 						$buildinsert->self_invest          = $self_invest;
 						$buildinsert->bank_invest          = $bank_invest;
 						$buildinsert->finish_area          = $finish_area;
 						$buildinsert->new_fixed_assets     = $new_fixed_assets;
 						$buildinsert->new_sickbed          = $new_sickbed;
 						$buildinsert->id                   = $org_id;
 						$buildinsert->year                 = $org_year_3;
 						if($buildinsert->insert()){
 							echo '<script type="text/javascript">window.alert("房屋与建筑信息添加成功！");history.go(-1);</script>';
 						}  
 					}
 					break;
 				//收入和支出信息
 				case "inout":
 					$org_year_5                = $this->_request->getParam('org_year_5');
 					$inoutnow = new Torg_ext_4();
 					$inoutnow->whereAdd("id='$org_id'");
 					$inoutnow->whereAdd("year='$org_year_5'");
 					$total_income               = $this->_request->getParam('total_income');
 					$finance_income             = $this->_request->getParam('finance_income');
 					$superior_income            = $this->_request->getParam('superior_income');
 					$medical_income             = $this->_request->getParam('medical_income');
 					$medical_outpatient_income  = $this->_request->getParam('medical_outpatient_income');
 					$medical_hospital_income    = $this->_request->getParam('medical_hospital_income');
 					$drug_income                = $this->_request->getParam('drug_income');
 					$drug_outpatient_income     = $this->_request->getParam('drug_outpatient_income');
 					$drug_hospital_income       = $this->_request->getParam('drug_hospital_income');
 					$drug_other_income          = $this->_request->getParam('drug_other_income');
 					$total_payout               = $this->_request->getParam('total_payout');
 					$medical_payout             = $this->_request->getParam('medical_payout');
 					$drug_payout                = $this->_request->getParam('drug_payout');
 					$drug_fee_payout            = $this->_request->getParam('drug_fee_payout');
 					$finance_payout             = $this->_request->getParam('finance_payout');
 					$other_payout               = $this->_request->getParam('other_payout');
 					$hr_payout                  = $this->_request->getParam('hr_payout');
 					$retire_payout              = $this->_request->getParam('retire_payout');
 					$arrear_payout              = $this->_request->getParam('arrear_payout');
 					$arrear_payout_by_year      = $this->_request->getParam('arrear_payout_by_year');
 					if($inoutnow->count()>0){
 						//就编辑
 						$inoutup = new Torg_ext_4();
 						$inoutup->whereAdd("id='$org_id'");
 						$inoutup->whereAdd("year='$org_year_5'");
 						$inoutup->total_income               = $total_income;
 						$inoutup->finance_income             = $finance_income;
 						$inoutup->superior_income            = $superior_income;
 						$inoutup->medical_income             = $medical_income;
 						$inoutup->medical_outpatient_income  = $medical_outpatient_income;
 						$inoutup->medical_hospital_income    = $medical_hospital_income;
 						$inoutup->drug_income                = $drug_income;
 						$inoutup->drug_outpatient_income     = $drug_outpatient_income;
 						$inoutup->drug_hospital_income       = $drug_hospital_income;
 						$inoutup->total_payout               = $total_payout;
 						$inoutup->medical_payout             = $medical_payout;
 						$inoutup->drug_payout                = $drug_payout;
 						$inoutup->drug_fee_payout            = $drug_fee_payout;
 						$inoutup->finance_payout             = $finance_payout;
 						$inoutup->other_payout               = $other_payout;
 						$inoutup->hr_payout                  = $hr_payout;
 						$inoutup->retire_payout              = $retire_payout;
 						$inoutup->arrear_payout              = $arrear_payout;
 						$inoutup->arrear_payout_by_year      = $arrear_payout_by_year;
 					    $inoutup->drug_other_income          = $drug_other_income;
 						if($inoutup->update()){
 							echo '<script type="text/javascript">window.alert("收入与支出信息修改成功！");history.go(-1);</script>';
 						}
 					}else{
 						//就添加
 					    $inoutinsert = new Torg_ext_4();
 						$inoutinsert->total_income               = $total_income;
 						$inoutinsert->finance_income             = $finance_income;
 						$inoutinsert->superior_income            = $superior_income;
 						$inoutinsert->medical_income             = $medical_income;
 						$inoutinsert->medical_outpatient_income  = $medical_outpatient_income;
 						$inoutinsert->medical_hospital_income    = $medical_hospital_income;
 						$inoutinsert->drug_income                = $drug_income;
 						$inoutinsert->drug_outpatient_income     = $drug_outpatient_income;
 						$inoutinsert->drug_hospital_income       = $drug_hospital_income;
 						$inoutinsert->total_payout               = $total_payout;
 						$inoutinsert->medical_payout             = $medical_payout;
 						$inoutinsert->drug_payout                = $drug_payout;
 						$inoutinsert->drug_fee_payout            = $drug_fee_payout;
 						$inoutinsert->finance_payout             = $finance_payout;
 						$inoutinsert->other_payout               = $other_payout;
 						$inoutinsert->hr_payout                  = $hr_payout;
 						$inoutinsert->retire_payout              = $retire_payout;
 						$inoutinsert->arrear_payout              = $arrear_payout;
 						$inoutinsert->arrear_payout_by_year      = $arrear_payout_by_year;
 						$inoutinsert->drug_other_income          = $drug_other_income;
 						$inoutinsert->id                         = $org_id;
 						$inoutinsert->year                       = $org_year_5;
 						if($inoutinsert->insert()){
 							echo '<script type="text/javascript">window.alert("收入与支出信息添加成功！");history.go(-1);</script>';
 						}
 					}
 					break;
 					//负债与资产
 				case "assets":
 					$org_year_6         = $this->_request->getParam('org_year_6');
 					$assetnow = new Torg_ext_5();
 					$assetnow->whereAdd("id='$org_id'");
 					$assetnow->whereAdd("year='$org_year_6'");
 					$total_assets         = $this->_request->getParam('total_assets');
 					$current_assets       = $this->_request->getParam('current_assets');
 					$invest               = $this->_request->getParam('invest');
 					$capital_asserts      = $this->_request->getParam('capital_asserts');
 					$immateriality_assets = $this->_request->getParam('immateriality_assets');
 					$owes_assets          = $this->_request->getParam('owes_assets');
 					$long_standing_assets = $this->_request->getParam('long_standing_assets');
 					$net_assets           = $this->_request->getParam('net_assets');
 					$project_assets       = $this->_request->getParam('project_assets');
 					$fixed_assets         = $this->_request->getParam('fixed_assets');
 					$special_assets       = $this->_request->getParam('special_assets');
 					if($assetnow->count()>0){
 						//编辑
 						$assetup  = new Torg_ext_5();
 						$assetup->whereAdd("id='$org_id'");
 						$assetup->whereAdd("year='$org_year_6'");
 						$assetup->total_assets         = $total_assets;
 						$assetup->current_assets       = $current_assets;
 						$assetup->invest               = $invest;
 						$assetup->capital_asserts      = $capital_asserts;
 						$assetup->immateriality_assets = $immateriality_assets;
 						$assetup->owes_assets          = $owes_assets;
 						$assetup->long_standing_assets = $long_standing_assets;
 						$assetup->net_assets           = $net_assets;
 						$assetup->project_assets       = $project_assets;
 						$assetup->fixed_assets         = $fixed_assets;
 						$assetup->special_assets       = $special_assets;
 						if($assetup->update()){
 							echo '<script type="text/javascript">window.alert("资产与负债信息修改成功！");history.go(-1);</script>';
 						}
 					}else{
 						//添加
 					    $assetinsert  = new Torg_ext_5();
 						$assetinsert->total_assets         = $total_assets;
 						$assetinsert->current_assets       = $current_assets;
 						$assetinsert->invest               = $invest;
 						$assetinsert->capital_asserts      = $capital_asserts;
 						$assetinsert->immateriality_assets = $immateriality_assets;
 						$assetinsert->owes_assets          = $owes_assets;
 						$assetinsert->long_standing_assets = $long_standing_assets;
 						$assetinsert->net_assets           = $net_assets;
 						$assetinsert->project_assets       = $project_assets;
 						$assetinsert->fixed_assets         = $fixed_assets;
 						$assetinsert->special_assets       = $special_assets;
 						$assetinsert->id                   = $org_id;
 						$assetinsert->year                 = $org_year_6;
 						if($assetinsert->insert()){
 							echo '<script type="text/javascript">window.alert("资产与负债信息添加成功！");history.go(-1);</script>';
 						}
 					}
 					break;
 				case "orginfo":
 					$org_year_7            = $this->_request->getParam('org_year_7');
 					$orginfo = new Torg_ext_6();
 					$orginfo->whereAdd("id='$org_id'");
 					$orginfo->whereAdd("year='$org_year_7'");
 					$area_now              = $this->_request->getParam('area_now');
 					$sickbed_number_now    = $this->_request->getParam('sickbed_number_now');
 					$sickbed_use_rate      = $this->_request->getParam('sickbed_use_rate');
 					$outpatient_per_year   = $this->_request->getParam('outpatient_per_year');
 					$emergency_per_year    = $this->_request->getParam('emergency_per_year');
 					$iatrology_man_count   = $this->_request->getParam('iatrology_man_count');
 					$gp_team_count         = $this->_request->getParam('gp_team_count');
 					$gp_count              = $this->_request->getParam('gp_count');
 					$community_nurse_count = $this->_request->getParam('community_nurse_count');
 					$residenter_per_gp     = $this->_request->getParam('residenter_per_gp');
 					$residenter_per_nurse  = $this->_request->getParam('residenter_per_nurse');
 					//下边的3个需要特殊处理
 					$officesetting         = $this->_request->getParam('officesetting');
 					$val = "";
 					foreach($officesetting as $k=>$v){
 						$val.=$v.'|';
 					}
 					$newofficesetting = rtrim($val,'|');
 					$servicesetting        = $this->_request->getParam('servicesetting');
 					$vals = "";
 					foreach($servicesetting as $k=>$v){
 						$vals.=$v.'|';
 					}
 					$newservicesetting = rtrim($vals,'|');
 					$equipmentsetting      = $this->_request->getParam('equipmentsetting');
 					$vale = "";
 					foreach($equipmentsetting as $k=>$v){
 						$vale.=$v.'|';
 					}
 					$newequipmentsetting = rtrim($vale,'|');
 					if($orginfo->count()>0){
 						//编辑
 						$orginfoup = new Torg_ext_6();
 						$orginfoup->whereAdd("id='$org_id'");
 					    $orginfoup->whereAdd("year='$org_year_7'");
 						$orginfoup->area                  = $area_now;
 						$orginfoup->sickbed_number        = $sickbed_number_now;
 						$orginfoup->sickbed_use_rate      = $sickbed_use_rate;
 						$orginfoup->outpatient_per_year   = $outpatient_per_year;
 						$orginfoup->emergency_per_year    = $emergency_per_year;
 						$orginfoup->iatrology_man_count   = $iatrology_man_count;
 						$orginfoup->gp_team_count         = $gp_team_count;
 						$orginfoup->gp_count              = $gp_count;
 						$orginfoup->community_nurse_count = $community_nurse_count;
 						$orginfoup->residenter_per_gp     = $residenter_per_gp;
 						$orginfoup->residenter_per_nurse  = $residenter_per_nurse;
 						$orginfoup->officesetting         = $newofficesetting;
 						$orginfoup->service_setting       = $newservicesetting;
 						$orginfoup->equipment_setting     = $newequipmentsetting;
 						if($orginfoup->update()){
 							echo '<script type="text/javascript">window.alert("机构资源信息修改成功！");history.go(-1);</script>';
 						}
 					}else{
 						//添加
 					    $orginfoinsert = new Torg_ext_6();
 						$orginfoinsert->area                  = $area_now;
 						$orginfoinsert->sickbed_number        = $sickbed_number_now;
 						$orginfoinsert->sickbed_use_rate      = $sickbed_use_rate;
 						$orginfoinsert->outpatient_per_year   = $outpatient_per_year;
 						$orginfoinsert->emergency_per_year    = $emergency_per_year;
 						$orginfoinsert->iatrology_man_count   = $iatrology_man_count;
 						$orginfoinsert->gp_team_count         = $gp_team_count;
 						$orginfoinsert->gp_count              = $gp_count;
 						$orginfoinsert->community_nurse_count = $community_nurse_count;
 						$orginfoinsert->residenter_per_gp     = $residenter_per_gp;
 						$orginfoinsert->residenter_per_nurse  = $residenter_per_nurse;
 						$orginfoinsert->officesetting         = $newofficesetting;
 						$orginfoinsert->service_setting       = $newservicesetting;
 						$orginfoinsert->equipment_setting     = $newequipmentsetting;
 						$orginfoinsert->id                    = $org_id;
 						$orginfoinsert->year                  = $org_year_7;
 						if($orginfoinsert->insert()){
 							echo '<script type="text/javascript">window.alert("机构资源信息添加成功！");history.go(-1);</script>';
 						}
 					}
 					break;
 			 }
 		  }
 	}
 	//验证输入的年份是否正确
 	public function checkyearAction()
 	{
 		$year = $this->_request->getParam('year');
 		//echo $year;
 		$org_id = $this->user['org_id'];
 		$chs_center = new Tchs_center();
 		$chs_center->whereAdd("year='$year'");
 		$chs_center->whereAdd("chsc_id='$org_id'");
 		//echo $chs_center->count();
 		if($chs_center->count()>0)
 		{
 			echo true;
 		}
 		else 
 		{
 			echo false;
 		}
 	}
 	//删除数据
 	public function delAction()
 	{
 		$org_id = $this->_request->getParam('org_id');
 		$org_year = $this->_request->getParam('org_year');
 		if(!empty($org_id)&&!empty($org_year))
 		{
 				//当还有机构信息存在的时候不清除 organization中的机构代码
 				$tab_array = array('chs_center','org_ext_1','org_ext_2','org_ext_3','org_ext_4','org_ext_5','org_ext_6');
 				foreach ($tab_array as $k=>$v)
 				{
 					//chs_center 的 org和其他表中的org不同
 					if($v=='chs_center')
 					{
 						$real_org = 'chsc_id';
 					}
 					else 
 					{
 						$real_org = 'id';
 					}
 					$tab = 'T'.$v;
 					$obj = new $tab();
 					$obj->whereAdd("$real_org='$org_id'");
 					$obj->whereAdd("year='$org_year'");
 					$obj->delete();
 				}	
 				$chs_center = new Tchs_center();
 			    $chs_center->whereAdd("chsc_id='$org_id'");
 			    if($chs_center->count()==0)
 			    {
	 				$organization = new Torganization();
	 				$organization->whereAdd("id='$org_id'");
	 				$organization->standard_code = '';
	 				$organization->update();
 			    }
 			    $this->redirect(__BASEPATH.'organization/orgext/list');
 			}
 			
 		}
 }
?>