<?php 
class maternal_indexController extends controller{
	/*
	 * Filename: indexController.php
	 * Date : 2010-08-17
	 * Summary : 孕产妇健康管理记录表
	 * 模块作者：我好笨
	 * 修改时间：2010-10-31
	 */
	public function init()
	{
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/prenatal_visit_first.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	/**
	 * 列表所有人或者某一个人的第1次产前随访信息
	 */
	public function indexAction()
	{
		//初始化搜索条件
		$search=array();
		$search['username']=$this->_request->getParam('username');//姓名包含拼音
		$search['staff_id']=($this->_request->getParam('staff_id')=="-9")?"":$this->_request->getParam('staff_id');//建档医生
		$search['standard_code']=$this->_request->getParam('standard_code');//标准档案号
		$search['identity_number']=$this->_request->getParam('identity_number');//身份证号
        $search['startdate']=$this->_request->getParam('startdate');
        $search['enddate']=$this->_request->getParam('enddate');
        $search['org_id'] = $this->_request->getParam('org_id')?$this->_request->getParam('org_id'):$this->user['region_id']; //地区
        $search['display_sign'] = $this->_request->getParam('display_sign')?$this->_request->getParam('display_sign'):'none'; //高级搜索标志
		//医生列表
		$prenatal_visit_first_region_path_domain=get_region_path(1,$search['org_id']);
		$staff_core_region_path_domain=get_region_path(2);
		$individual_session=new Zend_Session_Namespace("individual_core");
		$id=$this->_request->getParam('id');
		$prenatal_visit_first=new Tprenatal_visit_first();
		$core=new Tindividual_core();
		$prenatal_visit_first->whereAdd($prenatal_visit_first_region_path_domain);
		$prenatal_visit_first->joinAdd('left',$prenatal_visit_first,$core,'id','uuid');
		if ($search['staff_id'])
		{
			$prenatal_visit_first->whereAdd("prenatal_visit_first.staff_id = '".$search['staff_id']."'");
		}
		if ($search['username'])
		{
			$prenatal_visit_first->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if ($search['standard_code'])
		{
			$prenatal_visit_first->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$prenatal_visit_first->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
        if($search['startdate'])
        {    
            $startdate  = strtotime(trim($this->_request->getParam('startdate')));
            $prenatal_visit_first->whereAdd("prenatal_visit_first.created>='".$startdate."'");
        }
        if($search['enddate'])
        {
            $enddate = strtotime(trim($this->_request->getParam('enddate')));
            $prenatal_visit_first->whereAdd("prenatal_visit_first.created<='".$enddate."'");
        }
		if ($id)
		{
			$prenatal_visit_first->whereAdd("prenatal_visit_first.id = '".$id."'");
			$search['id']=$id;
		}
		else 
		{
			$this->view->user_id=$individual_session->uuid;
		}
		$nums=$prenatal_visit_first->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'maternal/index/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//处理分页
		$prenatal_visit_first->limit($startnum,__ROWSOFPAGE);
		$prenatal_visit_first->orderby("prenatal_visit_first.created DESC");
		$prenatal_visit_first->find();
		$prenatal_array=array();
		$i=0;
		while ($prenatal_visit_first->fetch())
		{
			$prenatal_array[$i]['gravidity']=$prenatal_visit_first->gravidity;
			$prenatal_array[$i]['parity']=$prenatal_visit_first->parity;
			$prenatal_array[$i]['gestational_weeks']=$prenatal_visit_first->gestational_weeks;
			$prenatal_array[$i]['expected_date_of_confine']=adodb_date("Y-m-d",$prenatal_visit_first->expected_date_of_confine);
			$prenatal_array[$i]['created']=adodb_date("Y-m-d",$prenatal_visit_first->created);
			$prenatal_array[$i]['follow_next_time']=$prenatal_visit_first->follow_next_time?adodb_date("Y-m-d",$prenatal_visit_first->follow_next_time):"";
			$prenatal_array[$i]['filling_time']=adodb_date("Y-m-d",$prenatal_visit_first->filling_time);
			$prenatal_array[$i]['uuid']=$prenatal_visit_first->uuid;
			$prenatal_array[$i]['js_uuid']=@str_replace(".","_",$prenatal_visit_first->uuid);
			$prenatal_array[$i]['staff_id']=$prenatal_visit_first->staff_id;
			$prenatal_array[$i]['staff_name']=get_staff_name_byid($prenatal_visit_first->staff_id);
			if($this->haveWritePrivilege){
				$prenatal_array[$i]['ssname']=$core->name;
			}
			else 
			{
				$prenatal_array[$i]['ssname']="*";
			}
            $prenatal_array[$i]['phone_number']=$core->phone_number;
			//$prenatal_array[$i]['name']=get_individual_info($prenatal_visit_first->staff_id);
			$i++;
		}
		$out = $links->subPageCss2();
		
		//医生列表
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$search['staff_id']);
		$this->view->search=$search;
		$this->view->assign("pager",$out);
		$this->view->prenatal=$prenatal_array;
		$this->view->display('list.html');
	}
	/**
	 * 取第一次产前随访的所有人列表
	 */
	public function listAction()
	{
		//初始化搜索条件
		$search=array();
		$search['username']=$this->_request->getParam('username');//姓名包含拼音
		$search['staff_id']=($this->_request->getParam('staff_id')=="-9")?"":$this->_request->getParam('staff_id');//建档医生
		$search['standard_code']=$this->_request->getParam('standard_code');//标准档案号
		$search['identity_number']=$this->_request->getParam('identity_number');//身份证号
        $search['startdate']=$this->_request->getParam('startdate');
        $search['enddate']=$this->_request->getParam('enddate');
        $search['org_id'] = $this->_request->getParam('org_id')?$this->_request->getParam('org_id'):$this->user['region_id']; //地区
        $search['display_sign'] = $this->_request->getParam('display_sign')?$this->_request->getParam('display_sign'):'none'; //高级搜索标志
		$prenatal_visit_first_region_path_domain=get_region_path(1,$search['org_id']);
		$staff_core_region_path_domain=get_region_path(2);
		$prenatal_visit_first=new Tprenatal_visit_first();
		$core=new Tindividual_core();
		$prenatal_visit_first->whereAdd($prenatal_visit_first_region_path_domain);
		$prenatal_visit_first->joinAdd('left',$prenatal_visit_first,$core,'id','uuid');
		if ($search['staff_id'])
		{
			$prenatal_visit_first->whereAdd("prenatal_visit_first.staff_id = '".$search['staff_id']."'");
		}
		if ($search['username'])
		{
			$prenatal_visit_first->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if ($search['standard_code'])
		{
			$prenatal_visit_first->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$prenatal_visit_first->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
        if($search['startdate'])
        {    
            $startdate  = strtotime(trim($this->_request->getParam('startdate')));
            $prenatal_visit_first->whereAdd("prenatal_visit_first.created>='".$startdate."'");
        }
        if($search['enddate'])
        {
            $enddate = strtotime(trim($this->_request->getParam('enddate')));
            $prenatal_visit_first->whereAdd("prenatal_visit_first.created<='".$enddate."'");
        }
		$nums=$prenatal_visit_first->count("distinct prenatal_visit_first.id");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'maternal/index/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//$hypertension_follow_up->debugLevel(5);
		//$core->selectAdd("individual_core.uuid as uuid");
		$prenatal_visit_first->selectAdd("prenatal_visit_first.id as id,individual_core.standard_code_1,individual_core.identity_number,individual_core.name as name,individual_core.phone_number as phone_number,individual_core.name_pinyin as name_pinyin,max(prenatal_visit_first.gravidity) as gravidity,max(prenatal_visit_first.parity) as parity,max(prenatal_visit_first.created) as created");
		$prenatal_visit_first->groupBy("prenatal_visit_first.id,individual_core.name,individual_core.name_pinyin,individual_core.standard_code_1,individual_core.identity_number,individual_core.phone_number");
		//处理分页
		$prenatal_visit_first->limit($startnum,__ROWSOFPAGE);
		$prenatal_visit_first->find();
		$prenatal_array=array();
		$i=0;
		while ($prenatal_visit_first->fetch())
		{
			$prenatal_array[$i]['gravidity']=$prenatal_visit_first->gravidity;
			$prenatal_array[$i]['parity']=$prenatal_visit_first->parity;
			$prenatal_array[$i]['created']=adodb_date("Y-m-d",$prenatal_visit_first->created);
			$prenatal_array[$i]['id']=$prenatal_visit_first->id;
			if($this->haveWritePrivilege){
				$prenatal_array[$i]['ssname']=$prenatal_visit_first->name;
			}
			else 
			{
				$prenatal_array[$i]['ssname']="*";
			}
            $prenatal_array[$i]['phone_number']=$prenatal_visit_first->phone_number;
			//$prenatal_array[$i]['name']=get_individual_info($prenatal_visit_first->staff_id);
			$i++;
		}
		$out = $links->subPageCss2();
		//医生列表
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$search['staff_id']);
		$this->view->search=$search;
		$this->view->assign("pager",$out);
		$this->view->prenatal=$prenatal_array;
		$this->view->display('index.html');
	}
	/**
	 * 添加第一次随访
	 */
    public function addAction()
    {
    	require_once __SITEROOT.'/library/data_arr/arrdata.php';
    	//查询本产次是否已有第一次随访
    	$uuid=$this->_request->getParam("uuid",'');
    	$individual_session=new Zend_Session_Namespace("individual_core");
    	if (!$uuid)
    	{
    		//添加时判定是否为女性
    		if(@array_search_for_other($individual_session->sex,$sex)!=2){
				message("错误，请在个人档案列表选择女性人员",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
    	}
    	//取最大产次、孕次并自动加1,取孕产史
    	$prenatal_visit_first=new Tprenatal_visit_first();
    	$prenatal_visit_first->selectAdd("max(gravidity) as gravidity,max(parity) as parity,max(abortion) as abortion,max(stillbirth) as stillbirth,max(fetal_death) as fetal_death,max(neonatal_death) as neonatal_death");
		$prenatal_visit_first->whereAdd("id='$individual_session->uuid'");
		$prenatal_visit_first->find(true);
		$this->view->abortion = @intval($prenatal_visit_first->abortion);//孕产史-流产
		$this->view->stillbirth = @intval($prenatal_visit_first->stillbirth);//孕产史-死产
		$this->view->fetal_death = @intval($prenatal_visit_first->fetal_death);//孕产史-死胎
		$this->view->neonatal_death = @intval($prenatal_visit_first->neonatal_death);//孕产史-新生儿死亡
        $this->view->birth_defects = @intval($prenatal_visit_first->birth_defects);//孕产史-出生缺陷儿
        $this->view->number_vaginal_delivery_more = @intval($prenatal_visit_first->number_vaginal_delivery);//阴道分娩次数
        $this->view->cesarean_delivery_times_more = @intval($prenatal_visit_first->cesarean_delivery_times);//剖宫产次
		$this->view->gravidity=$prenatal_visit_first->gravidity+1;
		$this->view->parity=$prenatal_visit_first->parity+1;
		$this->view->uuid=$uuid;
		$this->view->assign("clinical_history",$ma_clinical_history);
		$this->view->assign("family_history",$ma_family_history);
		$this->view->assign("clinical_history_json",json_encode($ma_clinical_history));
		$this->view->assign("family_history_json",json_encode($ma_family_history));
		$this->view->assign("ma_comm",$ma_comm);
		$this->view->assign("ma_vdrl_dic",$ma_vdrl);//血清学
		$this->view->assign("vaginal_fluid_dic",$vaginal_fluid);//阴道分泌物
		$this->view->assign("vaginal_fluid_json",json_encode($vaginal_fluid));//阴道分泌物
		$this->view->assign("fksss_dic",$fksss);//妇科手术史
        $this->view->assign("ma_personal_history",$ma_personal_history);
		$this->view->assign("personal_history_json",json_encode($ma_personal_history));//个人史
        $this->view->assign("ma_vaginal_cleanliness",$ma_vaginal_cleanliness);//阴道清洁度
        $this->view->assign("ma_health_guide",$ma_health_guide);//保健指导 
        $this->view->assign("health_guide_json",json_encode($ma_health_guide));
		$this->view->userid = $individual_session->uuid;	
		if(empty($uuid)){
			if(empty($individual_session->uuid) || empty($individual_session->staff_id)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}		
		}
        $individual_inf=get_individual_info($individual_session->uuid);//取得个人信息中所有信息
        //计算年龄
        $this->view->age = getBirthday($individual_inf->date_of_birth,time());
        //2012-02-21仅查询正常档案，我好笨
        if($individual_inf->status_flag!=1)
        {
            message("你选择了一个非正常档案，请重新选择",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
        }
		if(empty($uuid)){
			if($this->haveWritePrivilege){
				$this->view->user_name = $individual_session->name;//居民姓名
				$this->view->standard_code = $individual_session->standard_code_1;//标准档案号
			}
			else 
			{
				$this->view->user_name = "*";//居民姓名
				$this->view->standard_code = "*";//标准档案号
			}
			$this->view->response_doctor = $individual_session->response_doctor;//责任医生id
			$this->view->person_uuid = $individual_session->uuid;//个人uuid
			//$this->view->examination_doctor =$all_user;
		}else{
			if($this->haveWritePrivilege){
				$this->view->user_name = $individual_inf->name;//居民姓名
				$this->view->standard_code = $individual_inf->standard_code_1;//标准档案号
			}
			else 
			{
				$this->view->user_name = "*";//居民姓名
				$this->view->standard_code = "*";//标准档案号
			}
		}
		//给随访时间初始值
		$this->view->filling_time_year=date("Y",time());
		$this->view->filling_time_month=date("m",time());
		$this->view->filling_time_day=date("d",time());
		//医生列表
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$this->user['uuid']);
		$this->view->display('add.html');
	}
	/**
	 * 编辑随访记录
	 */
	public function editAction()
	{
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$uuid=$this->_request->getParam("id",'');
		if (!$uuid)
		{
			message("编辑随访记录出现错误，错误代码:ma004",array("重新选人"=>__BASEPATH.'iha/index/index',"第1次产前随访人员列表"=>__BASEPATH.'maternal/index/index'));
		}
		else 
		{
			$this->view->assign("clinical_history",$ma_clinical_history);
			$this->view->assign("family_history",$ma_family_history);
			$this->view->assign("clinical_history_json",json_encode($ma_clinical_history));
			$this->view->assign("family_history_json",json_encode($ma_family_history));
			$this->view->assign("ma_comm",$ma_comm);
			$this->view->assign("ma_vdrl_dic",$ma_vdrl);//血清学
			$this->view->assign("vaginal_fluid_dic",$vaginal_fluid);//阴道分泌物
			$this->view->assign("vaginal_fluid_json",json_encode($vaginal_fluid));//阴道分泌物
			$this->view->assign("fksss_dic",$fksss);//妇科手术史
            $this->view->assign("ma_personal_history",$ma_personal_history);
    		$this->view->assign("personal_history_json",json_encode($ma_personal_history));//个人史
            $this->view->assign("ma_vaginal_cleanliness",$ma_vaginal_cleanliness);//阴道清洁度
            $this->view->assign("ma_health_guide",$ma_health_guide);//保健指导 
            $this->view->assign("health_guide_json",json_encode($ma_health_guide));
			//取随访数据
			$prenatal_visit_first=new Tprenatal_visit_first();
			$prenatal_visit_first->whereAdd("uuid='$uuid'");
			$prenatal_visit_first->find(true);
			$this->view->uuid = $prenatal_visit_first->uuid;//
			$this->view->userid = $prenatal_visit_first->id;//
            $individual_inf=get_individual_info($prenatal_visit_first->id);//取得个人信息中所有信息
            //计算年龄
            $this->view->age = getBirthday($individual_inf->date_of_birth,time());
			$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$prenatal_visit_first->follow_staff);
			$this->view->filling_time_year = $prenatal_visit_first->filling_time?adodb_date("Y",$prenatal_visit_first->filling_time):"";//填表时间
			$this->view->filling_time_month = $prenatal_visit_first->filling_time?adodb_date("n",$prenatal_visit_first->filling_time):"";//填表时间
			$this->view->filling_time_day = $prenatal_visit_first->filling_time?adodb_date("j",$prenatal_visit_first->filling_time):"";//填表时间
			$this->view->follow_next_time_year = $prenatal_visit_first->follow_next_time?adodb_date("Y",$prenatal_visit_first->follow_next_time):"";//下次随访日期
			$this->view->follow_next_time_month = $prenatal_visit_first->follow_next_time?adodb_date("n",$prenatal_visit_first->follow_next_time):"";//下次随访日期
			$this->view->follow_next_time_day = $prenatal_visit_first->follow_next_time?adodb_date("j",$prenatal_visit_first->follow_next_time):"";//下次随访日期
			$this->view->husband_name = $prenatal_visit_first->husband_name;//丈夫姓名
			$this->view->husband_age = $prenatal_visit_first->husband_age;//丈夫年龄
			$this->view->husband_phone = $prenatal_visit_first->husband_phone;//丈夫电话
			$this->view->gestational_weeks = $prenatal_visit_first->gestational_weeks;//填表孕周
			$this->view->gravidity = $prenatal_visit_first->gravidity;//孕次
			$this->view->parity = $prenatal_visit_first->parity;//产次
            $this->view->birth_defects = @intval($prenatal_visit_first->birth_defects);//孕产史-出生缺陷儿
            $this->view->number_vaginal_delivery = @intval($prenatal_visit_first->number_vaginal_delivery);//阴道分娩次数
            $this->view->cesarean_delivery_times = @intval($prenatal_visit_first->cesarean_delivery_times);//剖宫产次
            $this->view->number_vaginal_delivery_more = @intval($prenatal_visit_first->number_vaginal_delivery);//阴道分娩次数
            $this->view->cesarean_delivery_times_more = @intval($prenatal_visit_first->cesarean_delivery_times);//剖宫产次
			$this->view->last_menstrual_year = $prenatal_visit_first->last_menstrual?adodb_date("Y",$prenatal_visit_first->last_menstrual):"";//末次月经
			$this->view->last_menstrual_month = $prenatal_visit_first->last_menstrual?adodb_date("n",$prenatal_visit_first->last_menstrual):"";//末次月经
			$this->view->last_menstrual_day = $prenatal_visit_first->last_menstrual?adodb_date("j",$prenatal_visit_first->last_menstrual):"";//末次月经
			$this->view->expected_date_of_confine_year = $prenatal_visit_first->expected_date_of_confine?adodb_date("Y",$prenatal_visit_first->expected_date_of_confine):"";//预产期
			$this->view->expected_date_of_confine_month = $prenatal_visit_first->expected_date_of_confine?adodb_date("n",$prenatal_visit_first->expected_date_of_confine):"";//预产期
			$this->view->expected_date_of_confine_day = $prenatal_visit_first->expected_date_of_confine?adodb_date("j",$prenatal_visit_first->expected_date_of_confine):"";//预产期
			$this->view->fksss = $prenatal_visit_first->fksss;//妇科手术史
			$this->view->fksss_info = $prenatal_visit_first->fksss_info;//妇科手术史说明
			$clinical_history = @explode("|",$prenatal_visit_first->clinical_history);//既往史
			$clinical_history_sign=0;
			foreach ($clinical_history as $k=>$v)
			{
				$clinical_history[$k]=array_search_for_other($v,$ma_clinical_history);
				if (in_array('-99',$clinical_history))
				{
					$clinical_history_sign=1;//用于判定当选择了其他时激活输入框
				}
			}
			$this->view->clinical_history_sign=$clinical_history_sign;
			$this->view->clinical_history_array=$clinical_history;
			$family_history = @explode("|",$prenatal_visit_first->family_history);//家族史
			$family_history_sign=0;
			foreach ($family_history as $k=>$v)
			{
				$family_history[$k]=array_search_for_other($v,$ma_family_history);
				if (in_array('-99',$family_history))
				{
					$family_history_sign=1;//用于判定当选择了其他时激活输入框
				}
			}
			$this->view->family_history_sign=$family_history_sign;
			$this->view->family_history_array = $family_history;
			$this->view->family_history_info = $prenatal_visit_first->family_history_info;//家族史说明
			$this->view->disease_history_info = $prenatal_visit_first->disease_history_info;//既往史说明
            //个人史
            $personal_history = @explode("|",$prenatal_visit_first->personal_history);//家族史
			$personal_history_sign=0;
			foreach ($personal_history as $k=>$v)
			{
				$personal_history[$k]=array_search_for_other($v,$ma_personal_history);
				if (in_array('-99',$personal_history))
				{
					$personal_history_sign=1;//用于判定当选择了其他时激活输入框
				}
			}
			$this->view->personal_history_sign=$personal_history_sign;
			$this->view->personal_history_array = $personal_history;
			$this->view->personal_history_info = $prenatal_visit_first->personal_history_info;//个人史说明

			$this->view->height = $prenatal_visit_first->height;//身高
			$this->view->weight = $prenatal_visit_first->weight;//体重
            //因原来代码有错，所以显示的时候重新计算一次
            $bmi=@intval($prenatal_visit_first->weight)/@pow(@(intval($prenatal_visit_first->height)/100),2);
			$this->view->bmi = round($bmi,2);//体质指数
			$this->view->systolic_blood_pressure = $prenatal_visit_first->systolic_blood_pressure;//收缩压
			$this->view->diastolic_blood_pressure = $prenatal_visit_first->diastolic_blood_pressure;//舒张压
			$this->view->auscultation_heart = $prenatal_visit_first->auscultation_heart;//心脏
			$this->view->auscultation_heart_info = $prenatal_visit_first->auscultation_heart_info;//心脏异常内容
			$this->view->auscultation_lung = $prenatal_visit_first->auscultation_lung;//肺部
			$this->view->auscultation_lung_info = $prenatal_visit_first->auscultation_lung_info;//肺部异常详细
			$this->view->vulva = array_search_for_other($prenatal_visit_first->vulva,$ma_comm);//外阴
			$this->view->vulva_info = $prenatal_visit_first->vulva_info;//外阴异常内容
			$this->view->vaginal = array_search_for_other($prenatal_visit_first->vaginal,$ma_comm);//阴道
			$this->view->vaginal_info = $prenatal_visit_first->vaginal_info;//阴道异常内容
			$this->view->cervix = array_search_for_other($prenatal_visit_first->cervix,$ma_comm);//宫颈
			$this->view->cervix_info = $prenatal_visit_first->cervix_info;//宫颈异常内容
			$this->view->uterus = array_search_for_other($prenatal_visit_first->uterus,$ma_comm);//子宫
			$this->view->uterus_info = $prenatal_visit_first->uterus_info;//子宫异常内容
			$this->view->dnexauteri = array_search_for_other($prenatal_visit_first->dnexauteri,$ma_comm);//附件
			$this->view->dnexauteri_info = $prenatal_visit_first->dnexauteri_info;//附件异常内容
			$this->view->hemoglobin = $prenatal_visit_first->hemoglobin;//血红蛋白值
			$this->view->wbc_count = $prenatal_visit_first->wbc_count;//白细胞计数值
			$this->view->platelet_count = $prenatal_visit_first->platelet_count;//血小板计数值
			$this->view->blood_other = $prenatal_visit_first->blood_other;//血常规其他
			$this->view->azoturia = $prenatal_visit_first->azoturia;//尿蛋白
			$this->view->glucose_in_urine = $prenatal_visit_first->glucose_in_urine;//尿糖
			$this->view->ketone = $prenatal_visit_first->ketone;//尿酮体
			$this->view->urine_occult_blood = $prenatal_visit_first->urine_occult_blood;//尿潜血
			$this->view->urine_other = $prenatal_visit_first->urine_other;//尿常规其他
            $this->view->blood_type = $prenatal_visit_first->blood_type;//血型
            $this->view->blood_sugar = $prenatal_visit_first->blood_sugar;//血糖
			$this->view->sgpt = $prenatal_visit_first->sgpt;//血清谷丙转氨酶
			$this->view->sgot = $prenatal_visit_first->sgot;//血清谷草转氨酶
			$this->view->seralbumin = $prenatal_visit_first->seralbumin;//白蛋白
			$this->view->total_bilirubin = $prenatal_visit_first->total_bilirubin;//总胆红素
			$this->view->bilirubin_direct = $prenatal_visit_first->bilirubin_direct;//结合胆红素
			$this->view->serum_creatinine = $prenatal_visit_first->serum_creatinine;//血清肌酐
			$this->view->bun = $prenatal_visit_first->bun;//血尿素氮
			$this->view->serum_potassium = $prenatal_visit_first->serum_potassium;//血钾浓度
			$this->view->serum_natrium = $prenatal_visit_first->serum_natrium;//血钠浓度
			$vaginal_fluid_array = @explode("|",$prenatal_visit_first->vaginal_fluid);//阴道分泌物
			$vaginal_fluid_sign=0;
			foreach ($vaginal_fluid_array as $k=>$v)
			{
				$vaginal_fluid_array[$k]=array_search_for_other($v,$vaginal_fluid);
				if (in_array('-99',$vaginal_fluid_array))
				{
					$vaginal_fluid_sign=1;//用于判定当选择了其他时激活输入框
				}
			}
			$this->view->vaginal_fluid_sign=$vaginal_fluid_sign;
			$this->view->vaginal_fluid_array = $vaginal_fluid_array;
			$this->view->vaginal_fluid_info = $prenatal_visit_first->vaginal_fluid_info;//阴道分泌物说明
            $this->view->vaginal_cleanliness = array_search_for_other($prenatal_visit_first->vaginal_cleanliness,$ma_vaginal_cleanliness);//阴道清洁度
            
            //乙肝五项
            $this->view->hepatitis_b_surface_antigen = $prenatal_visit_first->hepatitis_b_surface_antigen;
            $this->view->hepatitis_b_surface_antibody = $prenatal_visit_first->hepatitis_b_surface_antibody;
            $this->view->hepatitis_b_e_antigen = $prenatal_visit_first->hepatitis_b_e_antigen;
            $this->view->hepatitis_b_e_antibody = $prenatal_visit_first->hepatitis_b_e_antibody;
            $this->view->hepatitis_b_core_antibody = $prenatal_visit_first->hepatitis_b_core_antibody;
            
			$this->view->result_of_vdrl = array_search_for_other($prenatal_visit_first->result_of_vdrl,$ma_vdrl);//梅毒血清学试验
			$this->view->div_antibody_check = array_search_for_other($prenatal_visit_first->div_antibody_check,$ma_vdrl);//HIV抗体检测
            //B超
            $this->view->bc = $prenatal_visit_first->bc;
			$this->view->overall_assessment = array_search_for_other($prenatal_visit_first->overall_assessment,$ma_comm);//总体评估
            //保健指导
            $health_guide_array = @explode("|",$prenatal_visit_first->health_guide);
			$health_guide_sign=0;
			foreach ($health_guide_array as $k=>$v)
			{
				$health_guide_array[$k]=array_search_for_other($v,$ma_health_guide);
				if (in_array('-99',$health_guide_array))
				{
					$health_guide_sign=1;//用于判定当选择了其他时激活输入框
				}
			}
			$this->view->health_guide_sign=$health_guide_sign;
			$this->view->health_guide_array = $health_guide_array;
			$this->view->health_guide_info = $prenatal_visit_first->health_guide_info;//保健指导说明
			$this->view->referral = array_search_for_other($prenatal_visit_first->referral,$fksss);//转诊（有无）
			$this->view->referral_reason = $prenatal_visit_first->referral_reason;//转诊原因
			$this->view->referral_org = $prenatal_visit_first->referral_org;//转诊机构
			$this->view->overall_assessment_info = $prenatal_visit_first->overall_assessment_info;//总体评估内容
			$this->view->abortion = $prenatal_visit_first->abortion;//孕产史-流产
			$this->view->stillbirth = $prenatal_visit_first->stillbirth;//孕产史-死产
			$this->view->fetal_death = $prenatal_visit_first->fetal_death;//孕产史-死胎
			$this->view->neonatal_death = $prenatal_visit_first->neonatal_death;//孕产史-新生儿死亡
			//个人信息
			$individual_inf=get_individual_info($prenatal_visit_first->id);//取得个人信息中所有信息
			if($this->haveWritePrivilege){
				$this->view->user_name = $individual_inf->name;//居民姓名
				$this->view->standard_code = $individual_inf->standard_code_1;//标准档案号
			}
			else 
			{
				$this->view->user_name = "*";//居民姓名
				$this->view->standard_code = "*";//标准档案号
			}
			$this->view->display('add.html');
		}
	}
	/**
	 * 添加或者编辑写入数据库
	 */
	public function editinAction()
	{
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		//获取机构ID
		$org_id=$this->user['org_id'];
		//获取医生ID
		$staff_id=$this->user['uuid'];
		//传递人物信息错误，或者直接跳至此控制器报错
		if (!$this->_request->getParam('userid'))
		{
			message("保存信息出现错误，错误代码:ma001",array("重新选人"=>__BASEPATH.'iha/index/index',"第1次产前随访人员列表"=>__BASEPATH.'maternal/index/index'));
		}
		$uuid=$this->_request->getParam('uuid',"");
		$prenatal_visit_first=new Tprenatal_visit_first();
		$filling_time=$this->_request->getParam('follow_time_year')?@mkunixstamp($this->_request->getParam('follow_time_year')."-".($this->_request->getParam('follow_time_month')?$this->_request->getParam('follow_time_month'):"1")."-".($this->_request->getParam('follow_time_day')?$this->_request->getParam('follow_time_day'):"1")):"";
		$prenatal_visit_first->filling_time = $filling_time;//填表时间
		$follow_next_time=$this->_request->getParam('follow_next_time_year')?@mkunixstamp($this->_request->getParam('follow_next_time_year')."-".($this->_request->getParam('follow_next_time_month')?$this->_request->getParam('follow_next_time_month'):"1")."-".($this->_request->getParam('follow_next_time_day')?$this->_request->getParam('follow_next_time_day'):"1")):"";
		$prenatal_visit_first->follow_next_time = $follow_next_time;//下次随访日期
		$prenatal_visit_first->husband_name = $this->_request->getParam('husband_name');//丈夫姓名
		$prenatal_visit_first->husband_age = @intval($this->_request->getParam('husband_age'));//丈夫年龄
		$prenatal_visit_first->husband_phone = $this->_request->getParam('husband_phone');//丈夫电话
		$prenatal_visit_first->gestational_weeks = @intval($this->_request->getParam('gestational_weeks'));//填表孕周
		$prenatal_visit_first->gravidity = @intval($this->_request->getParam('gravidity'));//孕次
		$prenatal_visit_first->parity = @intval($this->_request->getParam('parity'));//产次
        $prenatal_visit_first->cesarean_delivery_times = @intval($this->_request->getParam('cesarean_delivery_times'));//剖宫产次
		$prenatal_visit_first->number_vaginal_delivery = @intval($this->_request->getParam('number_vaginal_delivery'));//阴道分娩次
		//校验末次月经时间
		if (!$this->_request->getParam('last_menstrual_year') || !$this->_request->getParam('last_menstrual_month') || !$this->_request->getParam('last_menstrual_day'))
		{
			message("末次月经信息请认真填写，错误代码:ma002",array("返回修改"=>__BASEPATH.'maternal/index/add',"第1次产前随访人员列表"=>__BASEPATH.'maternal/index/index'));
		}
        //防止恶意填写日期
        $last_menstrual_year=$this->_request->getParam('last_menstrual_year');
        if($last_menstrual_year != '' && $last_menstrual_year>=date('Y'))
        {
            $last_menstrual_year=date('Y');
        }
        elseif($last_menstrual_year != '' && $last_menstrual_year<=1903)
        {
            $last_menstrual_year=1903;
        }
        else
        {
                               
        }
		$last_menstrual=$last_menstrual_year?@mkunixstamp($last_menstrual_year."-".($this->_request->getParam('last_menstrual_month')?$this->_request->getParam('last_menstrual_month'):"1")."-".($this->_request->getParam('last_menstrual_day')?$this->_request->getParam('last_menstrual_day'):"1")):"";
		$prenatal_visit_first->last_menstrual = $last_menstrual;//末次月经
		//计算预产期(根据末次月经计算，如果填了预产期的三项，则按填写的计算)
		if (!$this->_request->getParam('expected_date_of_confine_year') || !$this->_request->getParam('expected_date_of_confine_month') || !$this->_request->getParam('expected_date_of_confine_day'))
		{
			$expected_date_of_confine=adodb_mktime(0,0,0,adodb_date("n",$last_menstrual)+9,adodb_date("j",$last_menstrual)+7,adodb_date("Y",$last_menstrual));
		}
		else 
		{
			$expected_date_of_confine=$this->_request->getParam('expected_date_of_confine_year')?@mkunixstamp($this->_request->getParam('expected_date_of_confine_year')."-".($this->_request->getParam('expected_date_of_confine_month')?$this->_request->getParam('expected_date_of_confine_month'):"1")."-".($this->_request->getParam('expected_date_of_confine_day')?$this->_request->getParam('expected_date_of_confine_day'):"1")):"";
		}
		$prenatal_visit_first->expected_date_of_confine = $expected_date_of_confine;//预产期
		$prenatal_visit_first->fksss = array_code_change($this->_request->getParam('fksss'),$fksss);//妇科手术史
		$prenatal_visit_first->fksss_info = "";
		if (array_code_change($this->_request->getParam('fksss'),$fksss)==2)
		{
			$prenatal_visit_first->fksss_info = $this->_request->getParam('fksss_info');//妇科手术史说明
		}
		$clinical_history = $this->_request->getParam('clinical_history');//既往史
		$prenatal_visit_first->disease_history_info = "";
		foreach ($clinical_history as $k=>$v)
		{
			$clinical_history[$k]=array_code_change($v,$ma_clinical_history);
			if (array_code_change($v,$ma_clinical_history)=="-99")//选择其他时添加备注信息
			{
				$prenatal_visit_first->disease_history_info = $this->_request->getParam('disease_history_info');//既往史说明
			}
		}
		
		$prenatal_visit_first->clinical_history=@implode("|",$clinical_history);
		$family_history = $this->_request->getParam('family_history');//家族史
		$prenatal_visit_first->family_history_info = "";
		foreach ($family_history as $k=>$v)
		{
			$family_history[$k]=array_code_change($v,$ma_family_history);
			if (array_code_change($v,$ma_family_history)=="-99")//选择其他时添加备注信息
			{
				$prenatal_visit_first->family_history_info = $this->_request->getParam('family_history_info');//家族史说明
			}
		}
		$prenatal_visit_first->family_history=@implode("|",$family_history);
		//个人史
		$personal_history = $this->_request->getParam('personal_history');//家族史
		$prenatal_visit_first->personal_history_info = "";
		foreach ($personal_history as $k=>$v)
		{
			$personal_history[$k]=array_code_change($v,$ma_personal_history);
			if (array_code_change($v,$ma_personal_history)=="-99")//选择其他时添加备注信息
			{
				$prenatal_visit_first->personal_history_info = $this->_request->getParam('personal_history_info');//个人史说明
			}
		}
		$prenatal_visit_first->personal_history=@implode("|",$personal_history);        
		$prenatal_visit_first->height = $this->_request->getParam('height');//身高
		$prenatal_visit_first->weight = $this->_request->getParam('weight');//体重
		//计算BMI
		$bmi=0;
		if ($this->_request->getParam('height') && $this->_request->getParam('weight') && @intval($this->_request->getParam('height'))!=0 && @intval($this->_request->getParam('weight'))!=0)
		{
			$bmi=@intval($this->_request->getParam('weight'))/@pow(@(intval($this->_request->getParam('height'))/100),2);
		}
		$prenatal_visit_first->bmi = $this->_request->getParam('bmi')?$this->_request->getParam('bmi'):round($bmi,2);//体质指数
		$prenatal_visit_first->systolic_blood_pressure  = $this->_request->getParam('systolic_blood_pressure');//收缩压
		$prenatal_visit_first->diastolic_blood_pressure  = $this->_request->getParam('diastolic_blood_pressure');//舒张压
		
		$prenatal_visit_first->auscultation_heart = array_code_change($this->_request->getParam('auscultation_heart'),$ma_comm);//心脏
		$prenatal_visit_first->auscultation_heart_info = "";
		if (array_code_change($this->_request->getParam('auscultation_heart'),$ma_comm)==2)
		{
			$prenatal_visit_first->auscultation_heart_info = $this->_request->getParam('auscultation_heart_info');//心脏异常内容
		}
		$prenatal_visit_first->auscultation_lung = array_code_change($this->_request->getParam('auscultation_lung'),$ma_comm);//肺部
		$prenatal_visit_first->auscultation_lung_info = "";
		if (array_code_change($this->_request->getParam('auscultation_lung'),$ma_comm)==2)
		{
			$prenatal_visit_first->auscultation_lung_info = $this->_request->getParam('auscultation_lung_info');//肺部异常详细
		}
		$prenatal_visit_first->vulva = array_code_change($this->_request->getParam('vulva'),$ma_comm);//外阴
		$prenatal_visit_first->vulva_info = "";
		if (array_code_change($this->_request->getParam('vulva'),$ma_comm)==2)
		{
			$prenatal_visit_first->vulva_info = $this->_request->getParam('vulva_info');//外阴异常内容
		}
		$prenatal_visit_first->vaginal = array_code_change($this->_request->getParam('vaginal'),$ma_comm);//阴道
		$prenatal_visit_first->vaginal_info = "";
		if (array_code_change($this->_request->getParam('vaginal'),$ma_comm)==2)
		{
			$prenatal_visit_first->vaginal_info = $this->_request->getParam('vaginal_info');//阴道异常内容
		}
		$prenatal_visit_first->cervix = array_code_change($this->_request->getParam('cervix'),$ma_comm);//宫颈
		$prenatal_visit_first->cervix_info = "";
		if (array_code_change($this->_request->getParam('cervix'),$ma_comm)==2)
		{
			$prenatal_visit_first->cervix_info = $this->_request->getParam('cervix_info');//宫颈异常内容
		}
		$prenatal_visit_first->uterus = array_code_change($this->_request->getParam('uterus'),$ma_comm);//子宫
		$prenatal_visit_first->uterus_info = "";
		if (array_code_change($this->_request->getParam('uterus'),$ma_comm)==2)
		{
			$prenatal_visit_first->uterus_info = $this->_request->getParam('uterus_info');//子宫异常内容
		}
		$prenatal_visit_first->dnexauteri = array_code_change($this->_request->getParam('dnexauteri'),$ma_comm);//附件
		$prenatal_visit_first->dnexauteri_info = "";
		if (array_code_change($this->_request->getParam('dnexauteri'),$ma_comm)==2)
		{
			$prenatal_visit_first->dnexauteri_info = $this->_request->getParam('dnexauteri_info');//附件异常内容
		}
		$prenatal_visit_first->hemoglobin = $this->_request->getParam('hemoglobin');//血红蛋白值
		$prenatal_visit_first->wbc_count = $this->_request->getParam('wbc_count');//白细胞计数值
		$prenatal_visit_first->platelet_count  = $this->_request->getParam('platelet_count');//血小板计数值
		$prenatal_visit_first->blood_other = $this->_request->getParam('blood_other');//血常规其他
		$prenatal_visit_first->azoturia = $this->_request->getParam('azoturia');//尿蛋白
		$prenatal_visit_first->glucose_in_urine = $this->_request->getParam('glucose_in_urine');//尿糖
		$prenatal_visit_first->ketone = $this->_request->getParam('ketone');//尿酮体
		$prenatal_visit_first->urine_occult_blood  = $this->_request->getParam('urine_occult_blood');//尿潜血
		$prenatal_visit_first->urine_other = $this->_request->getParam('urine_other');//尿常规其他
        $prenatal_visit_first->blood_type = $this->_request->getParam('blood_type');//血型
        $prenatal_visit_first->blood_sugar = $this->_request->getParam('blood_sugar');//血糖
		$prenatal_visit_first->sgpt = $this->_request->getParam('sgpt');//血清谷丙转氨酶
		$prenatal_visit_first->sgot = $this->_request->getParam('sgot');//血清谷草转氨酶
		$prenatal_visit_first->seralbumin = $this->_request->getParam('seralbumin');//白蛋白
		$prenatal_visit_first->total_bilirubin  = $this->_request->getParam('total_bilirubin');//总胆红素
		$prenatal_visit_first->bilirubin_direct = $this->_request->getParam('bilirubin_direct');//结合胆红素
		$prenatal_visit_first->serum_creatinine = $this->_request->getParam('serum_creatinine');//血清肌酐
		$prenatal_visit_first->bun = $this->_request->getParam('bun');//血尿素氮
		$prenatal_visit_first->serum_potassium = $this->_request->getParam('serum_potassium');//血钾浓度
		$prenatal_visit_first->serum_natrium = $this->_request->getParam('serum_natrium');//血钠浓度
		$prenatal_visit_first->abortion = @intval($this->_request->getParam('abortion'));//孕产史-流产
		$prenatal_visit_first->stillbirth = @intval($this->_request->getParam('stillbirth'));//孕产史-死产
		$prenatal_visit_first->fetal_death = @intval($this->_request->getParam('fetal_death'));//孕产史-死胎
		$prenatal_visit_first->neonatal_death = @intval($this->_request->getParam('neonatal_death'));//孕产史-新生儿死亡
        $prenatal_visit_first->birth_defects = @intval($this->_request->getParam('birth_defects'));//孕产史-出生缺陷儿
		$vaginal_fluid_array = $this->_request->getParam('vaginal_fluid');//阴道分泌物
		$prenatal_visit_first->vaginal_fluid_info = "";
		foreach ($vaginal_fluid_array as $k=>$v)
		{
			$vaginal_fluid_array[$k]=array_code_change($v,$vaginal_fluid);
			if (array_code_change($v,$vaginal_fluid)=="-99")//选择其他时添加备注信息
			{
				$prenatal_visit_first->vaginal_fluid_info = $this->_request->getParam('vaginal_fluid_info');//阴道分泌物说明
			}
		}
		$prenatal_visit_first->vaginal_fluid=@implode("|",$vaginal_fluid_array);
        $prenatal_visit_first->vaginal_cleanliness = array_code_change($this->_request->getParam('vaginal_cleanliness'),$ma_vaginal_cleanliness);//阴道清洁度
        //乙肝五项
        $prenatal_visit_first->hepatitis_b_surface_antigen = $this->_request->getParam('hepatitis_b_surface_antigen');
        $prenatal_visit_first->hepatitis_b_surface_antibody = $this->_request->getParam('hepatitis_b_surface_antibody');
        $prenatal_visit_first->hepatitis_b_e_antigen = $this->_request->getParam('hepatitis_b_e_antigen');
        $prenatal_visit_first->hepatitis_b_e_antibody = $this->_request->getParam('hepatitis_b_e_antibody');
        $prenatal_visit_first->hepatitis_b_core_antibody = $this->_request->getParam('hepatitis_b_core_antibody');
        
		$prenatal_visit_first->result_of_vdrl = array_code_change($this->_request->getParam('result_of_vdrl'),$ma_vdrl);//梅毒血清学试验
		$prenatal_visit_first->div_antibody_check = array_code_change($this->_request->getParam('div_antibody_check'),$ma_vdrl);//HIV抗体检测
        $prenatal_visit_first->bc = $this->_request->getParam('bc');//B超
		$prenatal_visit_first->overall_assessment = array_code_change($this->_request->getParam('overall_assessment'),$ma_comm);//总体评估
		$prenatal_visit_first->overall_assessment_info ="";
		if (array_code_change($this->_request->getParam('overall_assessment'),$ma_comm)==2)
		{
			$prenatal_visit_first->overall_assessment_info = $this->_request->getParam('overall_assessment_info');//总体评估
		}
        //保健指导
        $health_guide_array = $this->_request->getParam('health_guide');
		$prenatal_visit_first->health_guide_info = "";
		foreach ($health_guide_array as $k=>$v)
		{
			$health_guide_array[$k]=array_code_change($v,$ma_health_guide);
			if (array_code_change($v,$ma_health_guide)=="-99")//选择其他时添加备注信息
			{
				$prenatal_visit_first->health_guide_info = $this->_request->getParam('health_guide_info');//保健指导说明
			}
		}
		$prenatal_visit_first->health_guide=@implode("|",$health_guide_array);
		$prenatal_visit_first->referral = array_code_change($this->_request->getParam('referral'),$fksss);//转诊（有无）
		$prenatal_visit_first->follow_staff = $this->_request->getParam('person_in_charge')?$this->_request->getParam('person_in_charge'):$staff_id;//随访医生
		$prenatal_visit_first->referral_reason = "";
		$prenatal_visit_first->referral_org = "";
		if (array_code_change($this->_request->getParam('referral'),$fksss)==2)
		{
			$prenatal_visit_first->referral_reason = $this->_request->getParam('referral_reason');//转诊原因
			$prenatal_visit_first->referral_org = $this->_request->getParam('referral_org');//转诊机构
		}
		if ($uuid=="")
		{
			//新增
			$prenatal_visit_first->uuid = uniqid("ma_",true);//
			$prenatal_visit_first->id = $this->_request->getParam('userid');//
			$prenatal_visit_first->org_id = $org_id;//
			$prenatal_visit_first->created = time();//
			$prenatal_visit_first->staff_id = $staff_id;//随访医生
			if($prenatal_visit_first->insert($this->user['uuid']))
			{
				$url=array("继续添加"=>__BASEPATH.'maternal/index/add',"查看全部记录"=>__BASEPATH.'maternal/index/index',"查看本人记录"=>__BASEPATH.'maternal/index/index/id/'.$this->_request->getParam('userid'));
				message("添加第1次产前随访服务记录表成功",$url);
			}
			else 
			{
				$url=array("重新添加"=>__BASEPATH.'maternal/index/add',"返回列表"=>__BASEPATH.'maternal/index/index');
				message("添加第1次产前随访服务记录表失败，错误代码:ma003",$url);
			}
		}
		else 
		{
			//编辑
			$prenatal_visit_first->whereAdd("uuid='$uuid'");
			if($prenatal_visit_first->update(array($this->user['uuid'],'updated')))
			{
				$url=array("添加第2-5次随访"=>__BASEPATH.'maternal/two/add',"查看全部记录"=>__BASEPATH.'maternal/index/index',"查看本人记录"=>__BASEPATH.'maternal/index/index/id/'.$this->_request->getParam('userid'));
				message("修改记录成功",$url);
			}
			else 
			{
				$url=array("重新添加"=>__BASEPATH.'maternal/index/add',"返回列表"=>__BASEPATH.'maternal/index/index');
				message("修改记录失败，错误代码:ma004",$url);
			}
		}
	}
	/**
	 * 删除记录
	 */
	public function delAction()
	{
		//获取机构ID
		$org_id=$this->user['org_id'];
		//获取医生ID
		$staff_id=$this->user['uuid'];
		$uuid=$this->_request->getParam("uuid",'');
		if ($staff_id=="" || $uuid!="")
		{
			$prenatal_visit_first=new Tprenatal_visit_first();
			$prenatal_visit_first->whereAdd("uuid='$uuid'");
			if ($prenatal_visit_first->delete($this->user['uuid']))
			{
				//删除第2-5次关联记录
				require_once __SITEROOT."library/Models/prenatal_visit_two.php";
				$prenatal_visit_two=new Tprenatal_visit_two();
				$prenatal_visit_two->whereAdd("fid='$uuid'");
				$prenatal_visit_two->delete($this->user['uuid']);
				//删除产后访视
				require_once __SITEROOT."library/Models/postpartum_visit.php";
				$postpartum_visit=new Tpostpartum_visit();
				$postpartum_visit->whereAdd("fid='$uuid'");
				$postpartum_visit->delete($this->user['uuid']);
				//删除产后42天健康检查
				require_once __SITEROOT."library/Models/postpartum_heathcheck.php";
				$postpartum_heathcheck=new Tpostpartum_heathcheck();
				$postpartum_heathcheck->whereAdd("fid='$uuid'");
				$postpartum_heathcheck->delete($this->user['uuid']);
				echo "ok";
				exit;
			}
			else 
			{
				echo "failed";
				exit;
			}
		}
		else 
		{
			echo "failed";
			exit;
		}
	}
}
?>