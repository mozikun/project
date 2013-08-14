<?php 
class maternal_twoController extends controller{
	/*
	 * Filename: twoController.php
	 * Date : 2010-08-17
	 * Summary : 孕产妇健康管理记录表(第2-5次产前随访)
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
		require_once __SITEROOT."library/Models/prenatal_visit_two.php";
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
		$prenatal_visit_two_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		$individual_session=new Zend_Session_Namespace("individual_core");
		$id=$this->_request->getParam('id');
		$prenatal_visit_two=new Tprenatal_visit_two();
		$core=new Tindividual_core();
		$prenatal_visit_first=new Tprenatal_visit_first();
		$prenatal_visit_two->whereAdd($prenatal_visit_two_region_path_domain);
		$prenatal_visit_two->joinAdd('left',$prenatal_visit_two,$core,'id','uuid');
		if ($search['staff_id'])
		{
			$prenatal_visit_two->whereAdd("prenatal_visit_two.staff_id = '".$search['staff_id']."'");
		}
		if ($search['username'])
		{
			$prenatal_visit_two->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if ($search['standard_code'])
		{
			$prenatal_visit_two->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$prenatal_visit_two->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
		if ($id)
		{
			$prenatal_visit_two->whereAdd("prenatal_visit_two.id = '".$id."'");
			$search['id']=$id;
		}
		else 
		{
			$this->view->user_id=$individual_session->uuid;
		}
		$nums=$prenatal_visit_two->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'maternal/two/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$prenatal_visit_two->selectAdd("distinct prenatal_visit_two.fid as fid,prenatal_visit_two.follow_time as follow_time,prenatal_visit_two.follow_count as follow_count,prenatal_visit_two.staff_id as staff_id,prenatal_visit_two.created as created,prenatal_visit_two.id as id,individual_core.standard_code_1,individual_core.identity_number,individual_core.name as name,individual_core.name_pinyin as name_pinyin,individual_core.phone_number as phone_number");
		//处理分页
		$prenatal_visit_two->limit($startnum,__ROWSOFPAGE);
		$prenatal_visit_two->orderby("prenatal_visit_two.created DESC");
		$prenatal_visit_two->find();
		$prenatal_array=array();
		$i=0;
		while ($prenatal_visit_two->fetch())
		{
			$prenatal_array[$i]['prenatal_visit_first']=$this->get_visit_first($prenatal_visit_two->fid);
			$prenatal_array[$i]['fid']=$prenatal_visit_two->fid;
			$prenatal_array[$i]['staff_id']=$prenatal_visit_two->staff_id;
			$prenatal_array[$i]['follow_count']=$prenatal_visit_two->follow_count;
			$prenatal_array[$i]['follow_time']=$prenatal_visit_two->follow_time?adodb_date("Y-m-d",$prenatal_visit_two->follow_time):"";
			$prenatal_array[$i]['staff_name']=get_staff_name_byid($prenatal_visit_two->staff_id);
			if($this->haveWritePrivilege){
				$prenatal_array[$i]['ssname']=$core->name;
			}
			else 
			{
				$prenatal_array[$i]['ssname']="*";
			}
            $prenatal_array[$i]['phone_number']=$prenatal_visit_two->phone_number;
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
		
		$prenatal_visit_two_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		
		$prenatal_visit_two=new Tprenatal_visit_two();
		$core=new Tindividual_core();
		$prenatal_visit_two->whereAdd($prenatal_visit_two_region_path_domain);
		$prenatal_visit_two->joinAdd('left',$prenatal_visit_two,$core,'id','uuid');
		if ($search['staff_id'])
		{
			$prenatal_visit_two->whereAdd("prenatal_visit_two.staff_id = '".$search['staff_id']."'");
		}
		if ($search['username'])
		{
			$prenatal_visit_two->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if ($search['standard_code'])
		{
			$prenatal_visit_two->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$prenatal_visit_two->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
		$nums=$prenatal_visit_two->count("distinct prenatal_visit_two.id");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'maternal/two/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//$hypertension_follow_up->debugLevel(5);
		//$core->selectAdd("individual_core.uuid as uuid");
		$prenatal_visit_two->selectAdd("prenatal_visit_two.id as id,individual_core.standard_code_1,individual_core.identity_number,individual_core.name as name,individual_core.name_pinyin as name_pinyin,individual_core.phone_number as phone_number,max(prenatal_visit_two.follow_count) as follow_count,max(prenatal_visit_two.gestational_weeks) as gestational_weeks,max(prenatal_visit_two.created) as created");
		$prenatal_visit_two->groupBy("prenatal_visit_two.id,individual_core.name,individual_core.name_pinyin,individual_core.standard_code_1,individual_core.identity_number,individual_core.phone_number");
		//处理分页
		$prenatal_visit_two->limit($startnum,__ROWSOFPAGE);
		$prenatal_visit_two->find();
		$prenatal_array=array();
		$i=0;
		while ($prenatal_visit_two->fetch())
		{
			$prenatal_array[$i]['follow_count']=$prenatal_visit_two->follow_count;
			$prenatal_array[$i]['gestational_weeks']=$prenatal_visit_two->gestational_weeks;
			$prenatal_array[$i]['created']=adodb_date("Y-m-d",$prenatal_visit_two->created);
			$prenatal_array[$i]['id']=$prenatal_visit_two->id;
			if($this->haveWritePrivilege){
				$prenatal_array[$i]['ssname']=$prenatal_visit_two->name;
			}
			else 
			{
				$prenatal_array[$i]['ssname']="*";
			}
            $prenatal_array[$i]['phone_number']=$prenatal_visit_two->phone_number;
			//$prenatal_array[$i]['name']=get_individual_info($prenatal_visit_two->staff_id);
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
				$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$this->user['uuid']);
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
	 * 添加第2-5次随访
	 */
    public function addlistAction()
    {
    	require_once __SITEROOT.'/library/data_arr/arrdata.php';
    	$individual_session=new Zend_Session_Namespace("individual_core");
    	$uuid=$this->_request->getParam("uuid",'');
    	//查询本产次是否已有第一次随访
    	$fid=$this->_request->getParam("fid",'');
    	if (!$fid)
    	{
    		//添加时判定是否为女性
    		if(@array_search_for_other($individual_session->sex,$sex)!=2){
				message("错误，请在个人档案列表选择女性人员",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
    	}
		$this->view->uuid=$uuid;
		$this->view->assign("clinical_history",$ma_clinical_history);
		$this->view->assign("family_history",$ma_family_history);
        $this->view->assign("medical_advice_json",json_encode($ma_medical_advice));
		$this->view->assign("ma_comm",$ma_comm);
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
		//取最大随访次数
		$follow_count=$this->_request->getParam("follow_count",'')?$this->_request->getParam("follow_count",''):2;//默认为次
		$follow_count=@intval($follow_count);
		//重置随访次数
		if ($follow_count<2 || $follow_count>5)
		{
			$follow_count=2;
		}
		//取当前随访次数记录，如有则编辑，无则添加
		$prenatal_visit_two=new Tprenatal_visit_two();
		$prenatal_visit_two->whereAdd("follow_count='$follow_count'");
		$prenatal_visit_two->whereAdd("fid='$fid'");
		$prenatal_visit_two->find("true");
		$this->view->uuid = $prenatal_visit_two->uuid;//
        if(empty($prenatal_visit_two->id) && $follow_count!=2)
        {
            //取其他随访的个人ID
            $prenatal_visit_two_id=new Tprenatal_visit_two();
            $prenatal_visit_two_id->whereAdd("fid='$fid'");
            $prenatal_visit_two_id->find(true);
            $prenatal_visit_two->id=$prenatal_visit_two_id->id?$prenatal_visit_two_id->id:"";
            $prenatal_visit_two_id->free_statement();
            if(!$prenatal_visit_two->id)
            {
                message("未能成功获取当前人员的信息，你需要在个人档案列表中选中此人",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
            }		
		}
        else
        {
            $prenatal_visit_two->id=$prenatal_visit_two->id?$prenatal_visit_two->id:$individual_session->uuid;
        }
		$this->view->userid = $prenatal_visit_two->id;//
		$this->view->fid = $prenatal_visit_two->fid?$prenatal_visit_two->fid:$fid;//和第一次产前随访关联
		$this->view->follow_time = $prenatal_visit_two->follow_time?adodb_date("Y-m-d",$prenatal_visit_two->follow_time):adodb_date("Y-m-d",time());//随访日期
		$this->view->gestational_weeks = $prenatal_visit_two->gestational_weeks;//孕周
		$this->view->subject_description = $prenatal_visit_two->subject_description;//主诉
		$this->view->weight = $prenatal_visit_two->weight;//体重
		$this->view->fundal_height = $prenatal_visit_two->fundal_height;//宫底高度
		$this->view->abdomen_circumference = $prenatal_visit_two->abdomen_circumference;//腹围
        $this->view->fetal_position = $prenatal_visit_two->fetal_position;//胎位
		$this->view->heart_rate = $prenatal_visit_two->heart_rate;//胎心率
		$this->view->systolic_blood_pressure = $prenatal_visit_two->systolic_blood_pressure;//收缩压
		$this->view->diastolic_blood_pressure = $prenatal_visit_two->diastolic_blood_pressure;//舒张压
		$this->view->hemoglobin = $prenatal_visit_two->hemoglobin;//血红蛋白值
		$this->view->azoturia = $prenatal_visit_two->azoturia;//尿蛋白
		$this->view->other_check = $prenatal_visit_two->other_check;//其他检查
		$this->view->b_ultrasonic = $prenatal_visit_two->b_ultrasonic;//B超
		$this->view->blood_sugar = $prenatal_visit_two->blood_sugar;//血糖筛查
		$this->view->pregnant_sort = array_search_for_other($prenatal_visit_two->pregnant_sort,$ma_comm);//孕妇分类
		$this->view->pregnant_sort_info = $prenatal_visit_two->pregnant_sort_info;//孕妇分类说明
		//指导
        $medical_advice_sign=0;
		$temp_type=@explode("|",$prenatal_visit_two->medical_advice);
			foreach ($ma_medical_advice as $k=>$v)
			{
			     if (@in_array("-99",$temp_type))
				{
					$medical_advice_sign=1;
				}
				if (@in_array($v[0],$temp_type))
				{
					$ma_medical_advice[$k]['check']="checked='checked'";
				}
				else 
				{
					$ma_medical_advice[$k]['check']="";
				}
			}
		$this->view->assign("ma_medical_advice",$ma_medical_advice);
        $this->view->medical_advice_sign = $medical_advice_sign;
        $this->view->medical_advice_info = $prenatal_visit_two->medical_advice_info;//指导其他项
		$this->view->referral = array_search_for_other($prenatal_visit_two->referral,$fksss);//转诊
		$this->view->referral_reason = $prenatal_visit_two->referral_reason;//转诊原因
		$this->view->referral_org = $prenatal_visit_two->referral_org;//转诊机构
		$this->view->follow_next_time = $prenatal_visit_two->follow_next_time?adodb_date("Y-m-d",$prenatal_visit_two->follow_next_time):"";//下次随访日期
		$this->view->follow_staff = $prenatal_visit_two->follow_staff;//随访责任医生
		$this->view->follow_count = $prenatal_visit_two->follow_count?$prenatal_visit_two->follow_count:$follow_count;//用于控制次数
		//医生列表
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$prenatal_visit_two->follow_staff?$prenatal_visit_two->follow_staff:$this->user['uuid']);
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
			message("保存信息出现错误，错误代码:tw002",array("重新选人"=>__BASEPATH.'iha/index/index',"本人第1次产前随访列表"=>__BASEPATH.'maternal/two/add'));
		}
		$uuid=$this->_request->getParam('uuid',"");
		$fid=$this->_request->getParam('fid',"");
		$prenatal_visit_two=new Tprenatal_visit_two();
		$prenatal_visit_two->follow_time = $this->_request->getParam('follow_time')?mkunixstamp($this->_request->getParam('follow_time')):"";//随访日期
		$prenatal_visit_two->gestational_weeks = @intval($this->_request->getParam('gestational_weeks'));//孕周
		$prenatal_visit_two->subject_description = $this->_request->getParam('subject_description');//主诉
		$prenatal_visit_two->weight = $this->_request->getParam('weight');//体重
		$prenatal_visit_two->fundal_height = $this->_request->getParam('fundal_height');//宫底高度
		$prenatal_visit_two->abdomen_circumference = $this->_request->getParam('abdomen_circumference');//腹围
        $prenatal_visit_two->fetal_position = $this->_request->getParam('fetal_position');//胎位
		$prenatal_visit_two->heart_rate = $this->_request->getParam('heart_rate');//胎心率
		$prenatal_visit_two->systolic_blood_pressure = $this->_request->getParam('systolic_blood_pressure');//收缩压
		$prenatal_visit_two->diastolic_blood_pressure = $this->_request->getParam('diastolic_blood_pressure');//舒张压
		$prenatal_visit_two->hemoglobin = $this->_request->getParam('hemoglobin');//血红蛋白值
		$prenatal_visit_two->azoturia = $this->_request->getParam('azoturia');//尿蛋白
		$prenatal_visit_two->other_check = $this->_request->getParam('other_check');//其他检查
		$prenatal_visit_two->b_ultrasonic = $this->_request->getParam('b_ultrasonic');//B超
		$prenatal_visit_two->blood_sugar = $this->_request->getParam('blood_sugar');//血糖筛查
		$prenatal_visit_two->pregnant_sort = array_code_change($this->_request->getParam('pregnant_sort'),$ma_comm);//孕妇分类
		$prenatal_visit_two->pregnant_sort_info = "";
		if (array_code_change($this->_request->getParam('pregnant_sort'),$ma_comm)==2)
		{
			$prenatal_visit_two->pregnant_sort_info = $this->_request->getParam('pregnant_sort_info');//孕妇分类说明
		}
		$medical_advice = $this->_request->getParam('medical_advice');//指导
        $prenatal_visit_two->medical_advice_info = "";
        if(!empty($medical_advice))
        {
            foreach ($medical_advice as $k=>$v) 
    		{
    			$medical_advice[$k]=array_code_change($v,$ma_medical_advice);
                if($medical_advice[$k]=="-99")
    			{
    				$prenatal_visit_two->medical_advice_info = $this->_request->getParam('medical_advice_info');
    			}
    		}
        }
		$prenatal_visit_two->medical_advice = @implode("|",$medical_advice);
		$prenatal_visit_two->referral = array_code_change($this->_request->getParam('referral'),$fksss);//转诊
		$prenatal_visit_two->referral_reason = "";
		$prenatal_visit_two->referral_org = "";
		if (array_code_change($this->_request->getParam('referral'),$fksss)==2)
		{
			$prenatal_visit_two->referral_reason = $this->_request->getParam('referral_reason');//转诊原因
			$prenatal_visit_two->referral_org = $this->_request->getParam('referral_org');//转诊机构
		}
		$prenatal_visit_two->follow_next_time = $this->_request->getParam('follow_next_time')?mkunixstamp($this->_request->getParam('follow_next_time')):"";//下次随访日期
		$prenatal_visit_two->follow_staff = $this->_request->getParam('follow_staff');//随访责任医生
		$follow_count = @intval($this->_request->getParam('follow_count'));//用于控制次数
		if ($follow_count>5 || $follow_count<2)
		{
			$follow_count=2;
		}
		$prenatal_visit_two->follow_count = $follow_count;
		//取用户是否有该产次该次记录
		$check_two=new Tprenatal_visit_two();
		$check_two->whereAdd("follow_count='$follow_count'");
		$check_two->whereAdd("fid='$fid'");
		$check_two->find("true");
		if ($check_two->uuid!="")
		{
			$uuid=$check_two->uuid;
		}
		if ($uuid=="")
		{
			//新增
			$prenatal_visit_two->uuid = uniqid("ma_",true);//
			$prenatal_visit_two->id = $this->_request->getParam('userid');//
			$prenatal_visit_two->org_id = $org_id;//
			$prenatal_visit_two->created = time();//
			$prenatal_visit_two->fid = $this->_request->getParam('fid');//和第一次产前随访关联
			$prenatal_visit_two->staff_id = $staff_id;//随访医生
			if($prenatal_visit_two->insert($this->user['uuid']))
			{
				$url=array("继续添加"=>__BASEPATH.'maternal/two/addlist/fid/'.$fid,"查看全部记录"=>__BASEPATH.'maternal/two/list',"查看本人记录"=>__BASEPATH.'maternal/two/list/id/'.$this->_request->getParam('userid'));
				message("添加第".$follow_count."次产前随访服务记录表成功",$url);
			}
			else 
			{
				$url=array("重新添加"=>__BASEPATH.'maternal/two/add',"返回列表"=>__BASEPATH.'maternal/two/index');
				message("添加第".$follow_count."次产前随访服务记录表失败，错误代码:tw003",$url);
			}
		}
		else 
		{
			//编辑
			$prenatal_visit_two->whereAdd("uuid='$uuid'");
			if($prenatal_visit_two->update(array($this->user['uuid'],'updated')))
			{
				$url=array("添加第2-5次随访"=>__BASEPATH.'maternal/two/add',"查看全部记录"=>__BASEPATH.'maternal/two/list',"查看本人记录"=>__BASEPATH.'maternal/two/list/id/'.$this->_request->getParam('userid'));
				message("修改记录成功",$url);
			}
			else 
			{
				$url=array("重新添加"=>__BASEPATH.'maternal/two/add',"返回列表"=>__BASEPATH.'maternal/two/index');
				message("修改记录失败，错误代码:tw004",$url);
			}
		}
	}
	/**
	 * 查看
	 */
	public function viewAction()
	{
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$this->view->assign("ma_comm",$ma_comm);
		$this->view->assign("fksss_dic",$fksss);//妇科手术史
		//获取机构ID
		$org_id=$this->user['org_id'];
		//获取医生ID
		$staff_id=$this->user['uuid'];
		$fid=$this->_request->getParam('fid');
		//取当前人员ID
		$prenatal_visit_first=new Tprenatal_visit_first();
		$prenatal_visit_first->whereAdd("uuid='$fid'");
		$prenatal_visit_first->find(true);
		$individual_session=new Zend_Session_Namespace("individual_core");
		$userid = $prenatal_visit_first->id?$prenatal_visit_first->id:$individual_session->uuid;
		$this->view->userid = $userid;
		$individual_inf=get_individual_info($userid);//取得个人信息中所有信息
			if($this->haveWritePrivilege){
				$this->view->user_name = $individual_inf->name;//居民姓名
				$this->view->standard_code = $individual_inf->standard_code_1;//标准档案号
			}
			else 
			{
				$this->view->user_name = "*";//居民姓名
				$this->view->standard_code = "*";//标准档案号
			}
		//传递人物信息错误，或者直接跳至此控制器报错
		if (!$fid)
		{
			message("查看信息出现错误，错误代码:tw005",array("随访列表"=>__BASEPATH.'maternal/two/index',"本人第2-5次产前随访列表"=>__BASEPATH.'maternal/two/list/id/'.$individual_session->uuid));
		}
		$prenatal=array();
		for ($i=2;$i<6;$i++)
		{
			$prenatal_visit_two=new Tprenatal_visit_two();
			$prenatal_visit_two->whereAdd("fid='$fid'");
			$prenatal_visit_two->whereAdd("follow_count='$i'");
			$prenatal_visit_two->find();
			$prenatal_temp=array();
			while ($prenatal_visit_two->fetch())
			{
				$prenatal_temp['uuid']=$prenatal_visit_two->uuid;
				$prenatal_temp['fid']=$prenatal_visit_two->fid;
				$prenatal_temp['created']=$prenatal_visit_two->created;
				$prenatal_temp['follow_time']=$prenatal_visit_two->follow_time;
				$prenatal_temp['follow_time'] = $prenatal_visit_two->follow_time?adodb_date("Y-m-d",$prenatal_visit_two->follow_time):adodb_date("Y-m-d",time());//随访日期
				$prenatal_temp['gestational_weeks'] = $prenatal_visit_two->gestational_weeks;//孕周
				$prenatal_temp['subject_description'] = $prenatal_visit_two->subject_description;//主诉
				$prenatal_temp['weight'] = $prenatal_visit_two->weight;//体重
				$prenatal_temp['fundal_height'] = $prenatal_visit_two->fundal_height;//宫底高度
				$prenatal_temp['abdomen_circumference'] = $prenatal_visit_two->abdomen_circumference;//腹围
                $prenatal_temp['fetal_position'] = $prenatal_visit_two->fetal_position;//胎位
				$prenatal_temp['heart_rate'] = $prenatal_visit_two->heart_rate;//胎心率
				$prenatal_temp['systolic_blood_pressure'] = $prenatal_visit_two->systolic_blood_pressure;//收缩压
				$prenatal_temp['diastolic_blood_pressure'] = $prenatal_visit_two->diastolic_blood_pressure;//舒张压
				$prenatal_temp['hemoglobin'] = $prenatal_visit_two->hemoglobin;//血红蛋白值
				$prenatal_temp['azoturia'] = $prenatal_visit_two->azoturia;//尿蛋白
				$prenatal_temp['other_check'] = $prenatal_visit_two->other_check;//其他检查
				$prenatal_temp['b_ultrasonic'] = $prenatal_visit_two->b_ultrasonic;//B超
				$prenatal_temp['blood_sugar'] = $prenatal_visit_two->blood_sugar;//血糖筛查
				$prenatal_temp['pregnant_sort'] = array_search_for_other($prenatal_visit_two->pregnant_sort,$ma_comm);//孕妇分类
				$prenatal_temp['pregnant_sort_info'] = $prenatal_visit_two->pregnant_sort_info;//孕妇分类说明
				//指导
                $prenatal_temp['medical_advice']="";
				$temp_type=@explode("|",$prenatal_visit_two->medical_advice);
					foreach ($ma_medical_advice as $k=>$v)
					{
						if (@in_array($v[0],$temp_type))
						{
							$prenatal_temp['medical_advice'].=$v[1]."、";
						}
					}
                $prenatal_temp['medical_advice_info']=$prenatal_visit_two->medical_advice_info;
				$prenatal_temp['referral'] = array_search_for_other($prenatal_visit_two->referral,$fksss);//转诊
				$prenatal_temp['referral_reason'] = $prenatal_visit_two->referral_reason;//转诊原因
				$prenatal_temp['referral_org'] = $prenatal_visit_two->referral_org;//转诊机构
				$prenatal_temp['follow_next_time'] = $prenatal_visit_two->follow_next_time?adodb_date("Y-m-d",$prenatal_visit_two->follow_next_time):"";//下次随访日期
				$prenatal_temp['follow_staff'] = get_staff_name_byid($prenatal_visit_two->follow_staff);//随访责任医生
				$prenatal_temp['follow_count'] = $prenatal_visit_two->follow_count?$prenatal_visit_two->follow_count:$follow_count;//用于控制次数
				
			}
			$prenatal[$i]=$prenatal_temp;
		}
		$this->view->prenatal=$prenatal;
		$this->view->fid=$fid;
		$this->view->display('view.html');
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
		$fid=$this->_request->getParam("fid",'');
		if ($staff_id=="" || $uuid!="")
		{
			$prenatal_visit_two=new Tprenatal_visit_two();
			$prenatal_visit_two->whereAdd("uuid='$uuid'");
			if ($prenatal_visit_two->delete($this->user['uuid']))
			{
				message("删除成功",array("随访记录"=>__BASEPATH.'maternal/two/view/fid/'.$fid,"第2-5次产前随访列表"=>__BASEPATH.'maternal/two/list'));
			}
			else 
			{
				message("删除失败",array("随访记录"=>__BASEPATH.'maternal/two/view/fid/'.$fid,"第2-5次产前随访列表"=>__BASEPATH.'maternal/two/list'));
			}
		}
		else 
		{
			message("删除失败",array("随访记录"=>__BASEPATH.'maternal/two/view/fid/'.$fid,"第2-5次产前随访列表"=>__BASEPATH.'maternal/two/list'));
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