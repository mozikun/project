<?php 
class maternal_postnatalController extends controller{
	/*
	 * Filename: postnatalController.php
	 * Date : 2010-11-4
	 * Summary : 孕产妇健康管理记录表(产后访视随访)
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
		require_once __SITEROOT."library/Models/postpartum_visit.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	/**
	 * 列表所有人或者某一个人的第2-5次产前随访信息
	 */
	public function listAction()
	{
		//初始化搜索条件
		$search=array();
		$search['username']=$this->_request->getParam('username');//姓名包含拼音
		$search['staff_id']=($this->_request->getParam('staff_id')=="-9")?"":$this->_request->getParam('staff_id');//建档医生
		$search['standard_code']=$this->_request->getParam('standard_code');//标准档案号
		$search['identity_number']=$this->_request->getParam('identity_number');//身份证号
		$postpartum_visit_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		$individual_session=new Zend_Session_Namespace("individual_core");
		$id=$this->_request->getParam('id');
		$postpartum_visit=new Tpostpartum_visit();
		$core=new Tindividual_core();
		$prenatal_visit_first=new Tprenatal_visit_first();
		$postpartum_visit->whereAdd($postpartum_visit_region_path_domain);
		$postpartum_visit->joinAdd('left',$postpartum_visit,$core,'id','uuid');
		if ($search['staff_id'])
		{
			$postpartum_visit->whereAdd("postpartum_visit.staff_id = '".$search['staff_id']."'");
		}
		if ($search['username'])
		{
			$postpartum_visit->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if ($search['standard_code'])
		{
			$postpartum_visit->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$postpartum_visit->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
		if ($id)
		{
			$postpartum_visit->whereAdd("postpartum_visit.id = '".$id."'");
			$search['id']=$id;
		}
		else 
		{
			$this->view->user_id=$individual_session->uuid;
		}
		$nums=$postpartum_visit->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'maternal/postnatal/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//处理分页
		$postpartum_visit->limit($startnum,__ROWSOFPAGE);
		$postpartum_visit->orderby("postpartum_visit.created DESC");
		$postpartum_visit->find();
		$prenatal_array=array();
		$i=0;
		while ($postpartum_visit->fetch())
		{
			$prenatal_array[$i]['prenatal_visit_first']=$this->get_visit_first($postpartum_visit->fid);
			$prenatal_array[$i]['fid']=$postpartum_visit->fid;
			$prenatal_array[$i]['uuid']=$postpartum_visit->uuid;
			$prenatal_array[$i]['js_uuid']=@str_replace(".","_",$postpartum_visit->uuid);
			$prenatal_array[$i]['follow_time']=$postpartum_visit->follow_time?adodb_date("Y-m-d",$postpartum_visit->follow_time):"";
			$prenatal_array[$i]['staff_id']=$postpartum_visit->staff_id;
			$prenatal_array[$i]['staff_name']=get_staff_name_byid($postpartum_visit->staff_id);
			if($this->haveWritePrivilege){
				$prenatal_array[$i]['ssname']=$core->name;
			}
			else 
			{
				$prenatal_array[$i]['ssname']="*";
			}
            $prenatal_array[$i]['phone_number']=$core->phone_number;
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
	 * 取第2-5次产前随访的所有人列表
	 */
	public function indexAction()
	{
		//初始化搜索条件
		$search=array();
		$search['username']=$this->_request->getParam('username');//姓名包含拼音
		$search['staff_id']=($this->_request->getParam('staff_id')=="-9")?"":$this->_request->getParam('staff_id');//建档医生
		$search['standard_code']=$this->_request->getParam('standard_code');//标准档案号
		$search['identity_number']=$this->_request->getParam('identity_number');//身份证号
		$postpartum_visit_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		
		$postpartum_visit=new Tpostpartum_visit();
		$core=new Tindividual_core();
		$postpartum_visit->whereAdd($postpartum_visit_region_path_domain);
		$postpartum_visit->joinAdd('left',$postpartum_visit,$core,'id','uuid');
		if ($search['staff_id'])
		{
			$postpartum_visit->whereAdd("postpartum_visit.staff_id = '".$search['staff_id']."'");
		}
		if ($search['username'])
		{
			$postpartum_visit->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if ($search['standard_code'])
		{
			$postpartum_visit->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$postpartum_visit->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
		$nums=$postpartum_visit->count("distinct postpartum_visit.id");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'maternal/postnatal/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//$hypertension_follow_up->debugLevel(5);
		//$core->selectAdd("individual_core.uuid as uuid");
		$postpartum_visit->selectAdd("postpartum_visit.id as id,individual_core.standard_code_1,individual_core.identity_number,individual_core.name as name,individual_core.name_pinyin as name_pinyin,individual_core.phone_number as phone_number,max(postpartum_visit.created) as created");
		$postpartum_visit->groupBy("postpartum_visit.id,individual_core.name,individual_core.name_pinyin,individual_core.standard_code_1,individual_core.identity_number,individual_core.phone_number");
		//处理分页
		$postpartum_visit->limit($startnum,__ROWSOFPAGE);
		$postpartum_visit->find();
		$prenatal_array=array();
		$i=0;
		while ($postpartum_visit->fetch())
		{
			$prenatal_array[$i]['created']=adodb_date("Y-m-d",$postpartum_visit->created);
			$prenatal_array[$i]['id']=$postpartum_visit->id;
			if($this->haveWritePrivilege){
				$prenatal_array[$i]['ssname']=$postpartum_visit->name;
			}
			else 
			{
				$prenatal_array[$i]['ssname']="*";
			}
            $prenatal_array[$i]['phone_number']=$postpartum_visit->phone_number;
			//$prenatal_array[$i]['name']=get_individual_info($postpartum_visit->staff_id);
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
	 * 列表当前人员的第一次产前检查
	 */
	public function addAction()
    {
    	require_once __SITEROOT.'/library/data_arr/arrdata.php';
    	//初始化搜索条件
		$search=array();
		$search['username']=$this->_request->getParam('username');//姓名包含拼音
		$search['staff_id']=($this->_request->getParam('staff_id')=="-9")?"":$this->_request->getParam('staff_id');//建档医生
		$search['standard_code']=$this->_request->getParam('standard_code');//标准档案号
		$search['identity_number']=$this->_request->getParam('identity_number');//身份证号
		$prenatal_visit_first_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		$individual_session=new Zend_Session_Namespace("individual_core");
		$id=$individual_session->uuid;
		$w_sex=$individual_session->sex;
        //2012-02-21仅查询正常档案，我好笨
        if($individual_session->status_flag!=1)
        {
            message("你选择了一个非正常档案，请重新选择",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
        }
    	if ($id)
    	{
    		//添加时判定是否为女性
    		if(@array_search_for_other($w_sex,$sex)!=2)
    		{
				message("错误，请在个人档案列表选择女性人员",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			else 
			{
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
				if ($id)
				{
					$prenatal_visit_first->whereAdd("prenatal_visit_first.id = '".$id."'");
					$search['id']=$id;
				}
				$nums=$prenatal_visit_first->count();
				if(!$nums)
				{
					message("提示，你选择人员的人员还没有建立第一次产后随访记录",array("重新选人"=>__BASEPATH.'iha/index/index',"新增第一次产前随访"=>__BASEPATH.'maternal/index/add'));
				}
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
					$prenatal_array[$i]['follow_next_time']=$prenatal_visit_first->follow_next_time?adodb_date("Y-m-d",$prenatal_visit_first->created):"";
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
				$this->view->display('addlist.html');
			}
    	}
    	else 
    	{
    		message("错误，你还没有选择人员，请在个人档案列表选择女性人员",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
    	}
    }
	/**
	 * 添加产后随访
	 */
    public function addlistAction()
    {
    	require_once __SITEROOT.'/library/data_arr/arrdata.php';
    	//查询本产次是否已有第一次随访
    	$fid=$this->_request->getParam("fid",'');
    	if (!$fid)
    	{
    		//添加时判定是否为女性
    		if(@array_search_for_other($individual_session->sex,$sex)!=2){
				message("错误，请在个人档案列表选择女性人员",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
    	}
		$this->view->fid=$fid;
		$this->view->assign("ma_comm",$ma_comm);
		$this->view->assign("po_medical_advice",$po_medical_advice);
        $this->view->assign("po_medical_advice_json",json_encode($po_medical_advice));
		$this->view->assign("fksss_dic",$fksss);//妇科手术史
		$individual_session=new Zend_Session_Namespace("individual_core");
		$this->view->userid = $individual_session->uuid;	
		if(empty($fid)){
			if(empty($individual_session->uuid) || empty($individual_session->staff_id)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}		
		}
		if(empty($fid)){
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
			//取当前人员ID
			$prenatal_visit_first=new Tprenatal_visit_first();
			$prenatal_visit_first->whereAdd("uuid='$fid'");
			$prenatal_visit_first->find(true);
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
		}
		//给随访时间初始值
		$this->view->filling_time_year=date("Y",time());
		$this->view->filling_time_month=date("m",time());
		$this->view->filling_time_day=date("d",time());
		//医生列表
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$this->user['uuid']);
		$this->view->display('add.html');
	}
	public function editAction()
	{
	require_once __SITEROOT.'/library/data_arr/arrdata.php';
    	//查询本产次是否已有第一次随访
    	$uuid=$this->_request->getParam("uuid",'');
    	if (!$uuid)
    	{
    		//添加时判定是否为女性
    		message("参数传递错误",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
    	}
		$this->view->assign("ma_comm",$ma_comm);
		$this->view->assign("po_medical_advice",$po_medical_advice);
        $this->view->assign("po_medical_advice_json",json_encode($po_medical_advice));
		$this->view->assign("fksss_dic",$fksss);//妇科手术史
		$individual_session=new Zend_Session_Namespace("individual_core");
		$this->view->userid = $individual_session->uuid;	
		
		//取当前随访次数记录，如有则编辑，无则添加
		$postpartum_visit=new Tpostpartum_visit();
		$postpartum_visit->whereAdd("uuid='$uuid'");
		$postpartum_visit->find("true");
		$this->view->uuid = $postpartum_visit->uuid;//
		$this->view->userid = $postpartum_visit->id?$postpartum_visit->id:$individual_session->uuid;//
		$fid = $postpartum_visit->fid?$postpartum_visit->fid:$fid;//和第一次产前随访关联
        $this->view->fid = $fid;
        if(empty($fid)){
			if(empty($individual_session->uuid) || empty($individual_session->staff_id)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}		
		}
		if(empty($fid)){
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
			//取当前人员ID
			$prenatal_visit_first=new Tprenatal_visit_first();
			$prenatal_visit_first->whereAdd("uuid='$fid'");
			$prenatal_visit_first->find(true);
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
		}
        
		$this->view->filling_time_year=$postpartum_visit->follow_time?adodb_date("Y",$postpartum_visit->follow_time):adodb_date("Y",time());
		$this->view->filling_time_month=$postpartum_visit->follow_time?adodb_date("m",$postpartum_visit->follow_time):adodb_date("m",time());
		$this->view->filling_time_day=$postpartum_visit->follow_time?adodb_date("d",$postpartum_visit->follow_time):adodb_date("d",time());
		//$this->view->follow_time = $postpartum_visit->follow_time?adodb_date("Y-m-d",$postpartum_visit->follow_time):adodb_date("Y-m-d",time());//随访日期
		$this->view->body_temperature = $postpartum_visit->body_temperature;//体温
		$this->view->general_health = $postpartum_visit->general_health;//一般健康情况
		$this->view->general_psychology = $postpartum_visit->general_psychology;//一般心理状况
		$this->view->systolic_blood_pressure = $postpartum_visit->systolic_blood_pressure;//收缩压
		$this->view->diastolic_blood_pressure = $postpartum_visit->diastolic_blood_pressure;//舒张压
		$this->view->brest = array_search_for_other($postpartum_visit->brest,$ma_comm);//乳房
		$this->view->brest_info = $postpartum_visit->brest_info;//乳房备注
		$this->view->lochia = array_search_for_other($postpartum_visit->lochia,$ma_comm);//恶露
		$this->view->lochia_info = $postpartum_visit->lochia_info;//恶露备注
		$this->view->uterus = array_search_for_other($postpartum_visit->uterus,$ma_comm);//子宫
		$this->view->uterus_info = $postpartum_visit->uterus_info;//子宫备注
		$this->view->durative_ulcer = array_search_for_other($postpartum_visit->durative_ulcer,$ma_comm);//伤口
		$this->view->durative_ulcer_info = $postpartum_visit->durative_ulcer_info;//伤口备注
		$this->view->post_other = $postpartum_visit->post_other;//其他
		$this->view->pregnant_sort = array_search_for_other($postpartum_visit->pregnant_sort,$ma_comm);//分类
		$this->view->pregnant_sort_info = $postpartum_visit->pregnant_sort_info;//分类说明
		//指导
        $medical_advice_sign=0;
		$temp_type=@explode("|",$postpartum_visit->medical_advice);
			foreach ($po_medical_advice as $k=>$v)
			{
			     if (@in_array("-99",$temp_type))
				{
					$medical_advice_sign=1;
				}
				if (@in_array($v[0],$temp_type))
				{
					$po_medical_advice[$k]['check']="checked='checked'";
				}
				else 
				{
					$po_medical_advice[$k]['check']="";
				}
			}
		$this->view->assign("po_medical_advice",$po_medical_advice);
		$this->view->medical_advice_sign = $medical_advice_sign;
		$this->view->medical_advice_info = $postpartum_visit->medical_advice_info;//指导说明
        $this->view->assign("medical_advice_info",$postpartum_visit->medical_advice_info);//指导其他项
		$this->view->referral = array_search_for_other($postpartum_visit->referral,$fksss);//转诊
		$this->view->referral_reason = $postpartum_visit->referral_reason;//转诊原因
		$this->view->referral_org = $postpartum_visit->referral_org;//转诊机构
		$this->view->follow_next_time = $postpartum_visit->follow_next_time?adodb_date("Y-m-d",$postpartum_visit->follow_next_time):"";//下次随访日期
		//医生列表
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$postpartum_visit->follow_staff?$postpartum_visit->follow_staff:$this->user['uuid']);
		$this->view->display('add.html');
		
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
			message("保存信息出现错误，错误代码:po002",array("重新选人"=>__BASEPATH.'iha/index/index',"本人第1次产前随访列表"=>__BASEPATH.'maternal/postnatal/add'));
		}
		$uuid=$this->_request->getParam('uuid',"");
		$fid=$this->_request->getParam('fid',"");
		$postpartum_visit=new Tpostpartum_visit();
		$filling_time=$this->_request->getParam('follow_time_year')?@mkunixstamp($this->_request->getParam('follow_time_year')."-".($this->_request->getParam('follow_time_month')?$this->_request->getParam('follow_time_month'):"1")."-".($this->_request->getParam('follow_time_day')?$this->_request->getParam('follow_time_day'):"1")):"";
		$postpartum_visit->follow_time = $filling_time;//随访日期
		$postpartum_visit->body_temperature = $this->_request->getParam('body_temperature');//体温
		$postpartum_visit->general_health = $this->_request->getParam('general_health');//一般健康情况
		$postpartum_visit->general_psychology = $this->_request->getParam('general_psychology');//一般心理状况
		$postpartum_visit->systolic_blood_pressure = $this->_request->getParam('systolic_blood_pressure');//收缩压
		$postpartum_visit->diastolic_blood_pressure = $this->_request->getParam('diastolic_blood_pressure');//舒张压
		$postpartum_visit->brest = array_code_change($this->_request->getParam('brest'),$ma_comm);//乳房
		$postpartum_visit->brest_info = "";
		if (array_code_change($this->_request->getParam('brest'),$ma_comm)==2)
		{
			$postpartum_visit->brest_info = $this->_request->getParam('brest_info');//乳房备注
		}
		$postpartum_visit->lochia = array_code_change($this->_request->getParam('lochia'),$ma_comm);//恶露
		$postpartum_visit->lochia_info = "";
		if (array_code_change($this->_request->getParam('lochia'),$ma_comm)==2)
		{
			$postpartum_visit->lochia_info = $this->_request->getParam('lochia_info');//恶露备注
		}
		$postpartum_visit->uterus = array_code_change($this->_request->getParam('uterus'),$ma_comm);//子宫
		$postpartum_visit->uterus_info = "";
		if (array_code_change($this->_request->getParam('uterus'),$ma_comm)==2)
		{
			$postpartum_visit->uterus_info = $this->_request->getParam('uterus_info');//子宫备注
		}
		$postpartum_visit->durative_ulcer = array_code_change($this->_request->getParam('durative_ulcer'),$ma_comm);//伤口
		$postpartum_visit->durative_ulcer_info = "";
		if (array_code_change($this->_request->getParam('durative_ulcer'),$ma_comm)==2)
		{
			$postpartum_visit->durative_ulcer_info = $this->_request->getParam('durative_ulcer_info');//伤口备注
		}
		$postpartum_visit->post_other = $this->_request->getParam('post_other');//其他
		$postpartum_visit->pregnant_sort = array_code_change($this->_request->getParam('pregnant_sort'),$ma_comm);//孕妇分类
		$postpartum_visit->pregnant_sort_info = "";
		if (array_code_change($this->_request->getParam('pregnant_sort'),$ma_comm)==2)
		{
			$postpartum_visit->pregnant_sort_info = $this->_request->getParam('pregnant_sort_info');//孕妇分类说明
		}
		$medical_advice = $this->_request->getParam('medical_advice');//指导
        $postpartum_visit->medical_advice_info = "";
		foreach ($medical_advice as $k=>$v) 
		{
			$medical_advice[$k]=array_code_change($v,$po_medical_advice);
            if($medical_advice[$k]=="-99")
			{
				$postpartum_visit->medical_advice_info = $this->_request->getParam('medical_advice_info');
			}
		}
		$postpartum_visit->medical_advice = @implode("|",$medical_advice);
		$postpartum_visit->referral = array_code_change($this->_request->getParam('referral'),$fksss);//转诊
		$postpartum_visit->referral_reason = "";
		$postpartum_visit->referral_org = "";
		if (array_code_change($this->_request->getParam('referral'),$fksss)==2)
		{
			$postpartum_visit->referral_reason = $this->_request->getParam('referral_reason');//转诊原因
			$postpartum_visit->referral_org = $this->_request->getParam('referral_org');//转诊机构
		}
		$postpartum_visit->follow_next_time = $this->_request->getParam('follow_next_time')?mkunixstamp($this->_request->getParam('follow_next_time')):"";//下次随访日期
		$postpartum_visit->follow_staff = $this->_request->getParam('follow_staff');//随访责任医生
		if ($uuid=="")
		{
			//新增
			$postpartum_visit->uuid = uniqid("po_",true);//
			$postpartum_visit->id = $this->_request->getParam('userid');//
			$postpartum_visit->org_id = $org_id;//
			$postpartum_visit->created = time();//
			$postpartum_visit->fid = $this->_request->getParam('fid');//和第一次产前随访关联
			$postpartum_visit->staff_id = $staff_id;//随访医生
			if($postpartum_visit->insert($this->user['uuid']))
			{
				$url=array("继续添加"=>__BASEPATH.'maternal/postnatal/addlist/fid/'.$fid,"查看全部记录"=>__BASEPATH.'maternal/postnatal/list',"查看本人记录"=>__BASEPATH.'maternal/postnatal/list/id/'.$this->_request->getParam('userid'));
				message("添加产后访视记录表成功",$url);
			}
			else 
			{
				$url=array("重新添加"=>__BASEPATH.'maternal/postnatal/add',"返回列表"=>__BASEPATH.'maternal/postnatal/index');
				message("添加产后访视记录表失败，错误代码:tw003",$url);
			}
		}
		else 
		{
			//编辑
			$postpartum_visit->whereAdd("uuid='$uuid'");
			if($postpartum_visit->update(array($this->user['uuid'],'updated')))
			{
				$url=array("添加产后随访"=>__BASEPATH.'maternal/postnatal/add',"查看全部记录"=>__BASEPATH.'maternal/postnatal/list',"查看本人记录"=>__BASEPATH.'maternal/postnatal/list/id/'.$this->_request->getParam('userid'));
				message("修改记录成功",$url);
			}
			else 
			{
				$url=array("重新添加"=>__BASEPATH.'maternal/postnatal/add',"返回列表"=>__BASEPATH.'maternal/postnatal/index');
				message("修改记录失败，错误代码:tw004",$url);
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
			$postpartum_visit=new Tpostpartum_visit();
			$postpartum_visit->whereAdd("uuid='$uuid'");
			if ($postpartum_visit->delete($this->user['uuid']))
			{
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
	private function get_visit_first($uuid)
	{
		$prenatal_array=array();
		if ($uuid)
		{
			$prenatal_visit_first=new Tprenatal_visit_first();
			$prenatal_visit_first->whereAdd("uuid='$uuid'");
			$prenatal_visit_first->find(true);
			$prenatal_array['gravidity']=$prenatal_visit_first->gravidity;
			$prenatal_array['parity']=$prenatal_visit_first->parity;
			$prenatal_array['last_menstrual']=$prenatal_visit_first->last_menstrual?adodb_date("Y-m-d",$prenatal_visit_first->last_menstrual):"";	
		}
		return $prenatal_array;
	}
}
?>