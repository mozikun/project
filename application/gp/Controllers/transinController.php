<?php 
class gp_transinController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'library/Models/patient_referral_out.php';//双向转诊回转
		require_once __SITEROOT.'library/Models/patient_referral_in.php';//双向转诊回转
		require_once __SITEROOT.'library/Models/individual_core.php';//个人档案主表
		require_once __SITEROOT.'library/custom/comm_function.php';
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理


		$this->view->basePath = $this->_request->getBasePath();

	}
	/**
	 * 列表
	 *
	 */
	public function indexAction(){
		$realname             = urldecode(trim($this->_request->getParam('realname')));
		$nowdate              = strtotime(trim($this->_request->getParam('nowdate')));
		//var_dump($nowdate);
		$search               = $this->_request->getParam('search');
		$this->view->basePath = $this->_request->getBasePath();
	    //引入分页
		require_once __SITEROOT."/library/custom/pager.php";
		$patient_referral_in  = new Tpatient_referral_in();
		$individual = new Tindividual_core();
		//$patient_referral_in->debugLevel(9);
		$patient_referral_in->joinAdd('inner',$patient_referral_in,$individual,'id','uuid');
		if(!empty($realname)){
				 $patient_referral_in->whereAdd("name='$realname'");	
			}
		if(!empty($nowdate)){
				 $patient_referral_in->whereAdd("patient_referral_in.fill_time='$nowdate'");
			}
		$patient_referral_in->find();
		$arrArg = array();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$patient_referral_in->count(),$pageCurrent,__goodsListRowOfPage,__BASEPATH.'gp/diagnosis/listdiagnosis/realname/'.urlencode($realname).'/nowdate/'.$this->_request->getParam('nowdate').'/page/',3,$arrArg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		if($patient_referral_in->count()>0){
		    $patient_referral_inlist   = new Tpatient_referral_in();
			$individualcore  = new Tindividual_core();
			//$patient_referral_inlist->debugLevel(9);
			$patient_referral_inlist->joinAdd('inner',$patient_referral_inlist,$individualcore,'id','uuid');
			//处理搜索
			if(!empty($realname)){
				 $patient_referral_inlist->whereAdd("name='$realname'");	
				}
			if(!empty($nowdate)){
				 $patient_referral_inlist->whereAdd("patient_referral_in.fill_time='$nowdate'");
				}
			$patient_referral_inlist->orderby("patient_referral_in.fill_time DESC");
			$patient_referral_inlist->limit($startnum,__ROWSOFPAGE);
			$patient_referral_inlist->find();
			$patient_referral_inlistarr   = array();
			$patient_referral_inlistcount = 0 ;
			while($patient_referral_inlist->fetch()){
			    $patient_referral_inlistarr[$patient_referral_inlistcount]['name']         = $individualcore->name;
			    $patient_referral_inlistarr[$patient_referral_inlistcount]['urlencodename']= urlencode($individualcore->name);
			    $patient_referral_inlistarr[$patient_referral_inlistcount]['iha_id']       = $individualcore->standard_code_2;
			    $doctor_obj																	 = empty($patient_referral_inlist->in_of_doctor)?'':get_staff_info($patient_referral_inlist->in_of_doctor);
			    $doctor_name															 	 = empty($doctor_obj)?'':$doctor_obj[1]->name_real;
			   // print_r($doctor_archive);
			    $patient_referral_inlistarr[$patient_referral_inlistcount]['doctor_name']  = $doctor_name;
			    $patient_referral_inlistarr[$patient_referral_inlistcount]['current_time'] = $patient_referral_inlist->fill_time==""?'':adodb_date('Y-m-d',$patient_referral_inlist->fill_time);
			    $patient_referral_inlistarr[$patient_referral_inlistcount]['uuid']         = $patient_referral_inlist->uuid;
				$patient_referral_inlistcount++;
			}
			$this->view->diagnosislistarr = $patient_referral_inlistarr;
			$page = $links->subPageCss2();
  	    	$this->view->page   = $page;
		}else{
			$msg = '当前还没有任何数据 ！';
			$this->view->msg = $msg;
		}
		$this->view->delname        = $realname;
		$this->view->deldate        = adodb_date('Y-m-d',$nowdate);
		$this->view->nunumber       = $patient_referral_in->count();
		$this->view->currentpagenow = $pageCurrent;
		$this->view->display('list.html');
	}
	/**
	 * 添加、修改页面
	 */
	public function addAction(){
		//print_r($this->user);
		require_once __SITEROOT.'/library/data_arr/arrdata.php';

		$uuid         		= $this->_request->getParam('uuid');//记录编码
		$individual_session = new Zend_Session_Namespace("individual_core");
		
		if(empty($uuid)){
			//添加
			if(empty($individual_session->uuid)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			$this->view->name 			= $individual_session->name;//姓名
			$sex_code					= array_search_for_other($individual_session->sex,$sex);//性别非标准的代码集
			$this->view->sex 			= empty($sex_code)?'':$sex[$sex_code][1];//性别
			$this->view->age 			= $individual_session->age;//年龄
			$this->view->medical_report_no = '';//病案号
			$this->view->serial_num 	= $individual_session->standard_code_1;//档案编号
			$this->view->faminy_add 	= $individual_session->address;//家庭地址
			$this->view->telphone		= $individual_session->phone_number;//联系电话
			$this->view->referral_in_time_year	= date("Y");//年
			$this->view->referral_in_time_month=date("m");//月
			$this->view->referral_in_time_day	=date("d");//日
			

			$this->view->stub_doctor		 =  $this->user['name_real'];//存根转诊医生
			$this->view->stub_fill_time_year = date("Y");//存根填表年
			$this->view->stub_fill_time_month=date("m");//存根填表月
			$this->view->stub_fill_time_day  =date("d");//存根填表日
			$this->view->medical_result 	 = '';//诊断结果
			$this->view->hospitalization_no  = '';//住院病案号
			$this->view->result_of_examination = '';//主要检查结果
			$this->view->suggestion 		 = '';//治疗经过,下一步治疗方案及康复建议

			$region_users				= region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users	= $region_users;
			$this->view->in_of_doctor	= $this->user['uuid'];//转诊医生
			$this->view->phone 			= '';//联系电话
			$this->view->dst_org_name 	= $this->user['org_zh_name'];//转入的机构名
			$this->view->dst_org_code 	= $this->user['org_id'];//转入的机构名
			$this->view->fill_time_year = date("Y");//回转填表年
			$this->view->fill_time_month=date("m");//回转填表月
			$this->view->fill_time_day  =date("d");//回转填表日

		}else{
			//修改
			$patient_referral_in       = 	new Tpatient_referral_in();
			$individual_core  			= 	new Tindividual_core();
			//$patient_referral_in->debugLevel(9);
			$patient_referral_in->joinAdd('inner',$patient_referral_in,$individual_core,'id','uuid');
			$patient_referral_in->whereAdd("patient_referral_in.uuid='{$uuid}'");
			//$patient_referral_in->debugLevel(4);
			$patient_referral_in->find();
			$patient_referral_in->fetch();
			$this->view->uuid 			= 	$patient_referral_in->uuid;//编号
			$this->view->staff_id 		= 	$patient_referral_in->staff_id;//医生档案号
			$this->view->id 			= 	$patient_referral_in->id;//个人档案号
			$this->view->name 			= $individual_core->name;//姓名
			$sex_code					= array_search_for_other($individual_core->sex,$sex);//性别非标准的代码集
			$this->view->sex 			= empty($sex_code)?'':$sex[$sex_code][1];//性别

			$this->view->serial_num 	= $individual_core->standard_code_1;//档案编号
			$this->view->faminy_add 	= $individual_core->address;//家庭地址
			$this->view->telphone		= $individual_core->phone_number;//联系电话
			$this->view->created 		= 	$patient_referral_in->created;//添加记录时间
			$this->view->age 			= 	$patient_referral_in->age;//年龄
			$this->view->medical_report_no = $patient_referral_in->medical_report_no;//病案号

			$referral_in_time_year		=	empty($patient_referral_in->referral_in_time)?'':date("Y",$patient_referral_in->referral_in_time);//存根转诊时间
			$referral_in_time_month		=	empty($patient_referral_in->referral_in_time)?'':date("m",$patient_referral_in->referral_in_time);//存根转诊时间
			$referral_in_time_day		=	empty($patient_referral_in->referral_in_time)?'':date("d",$patient_referral_in->referral_in_time);//存根转诊时间
			$this->view->referral_in_time_year= 	$referral_in_time_year;//存根转诊时间
			$this->view->referral_in_time_month= 	$referral_in_time_month;//存根转诊时间
			$this->view->referral_in_time_day = 	$referral_in_time_day;//存根转诊时间

			$this->view->rewind_unit_code	= 	$patient_referral_in->rewind_unit;//回转单位
			$org_obj						=	empty($patient_referral_in->rewind_unit)?'':get_org_info($patient_referral_in->rewind_unit);//机构对像
			$this->view->rewind_unit_name	= 	empty($org_obj)?'':$org_obj->zh_name;//转到机构名
		
			$this->view->my_doctor 		= 	$patient_referral_in->my_doctor;//接诊医生
			$staff_info					=	empty($patient_referral_in->my_doctor)?'':get_staff_info($patient_referral_in->my_doctor);
			$this->view->my_doctor_name	=	empty($staff_info)?'':$staff_info[1]->name_real;
			
			$this->view->stub_of_doctor = 	$patient_referral_in->stub_doctor;//存根转诊医生

			$stub_fill_time_year			=	empty($patient_referral_in->stub_fill_time)?'':date("Y",$patient_referral_in->stub_fill_time);//存根填表时间
			$stub_fill_time_month			=	empty($patient_referral_in->stub_fill_time)?'':date("m",$patient_referral_in->stub_fill_time);//存根填表时间
			$stub_fill_time_day				=	empty($patient_referral_in->stub_fill_time)?'':date("d",$patient_referral_in->stub_fill_time);//存根填表时间
			$this->view->stub_fill_time_year= 	$stub_fill_time_year;//存根填表时间
			$this->view->stub_fill_time_month= 	$stub_fill_time_month;//存根填表时间
			$this->view->stub_fill_time_day = 	$stub_fill_time_day;//存根填表时间


			$this->view->dst_org_code 	= 	$patient_referral_in->my_org_name;//转到机构名
			$org_obj					=	empty($patient_referral_in->my_org_name)?'':get_org_info($patient_referral_in->my_org_name);//机构对像
			$this->view->dst_org_name 	= 	empty($org_obj)?'':$org_obj->zh_name;//转到机构名

			$this->view->medical_result 		= $patient_referral_in->medical_result;//诊断结果
			$this->view->hospitalization_no 	= $patient_referral_in->hospitalization_no;//住院病案号
			$this->view->result_of_examination  = trim($patient_referral_in->result_of_examination);//主要检查结果
			$this->view->suggestion 			= trim($patient_referral_in->suggestion);//治疗经过,下一步治疗方案及康复建议

			//
			$region_users				= 	empty($this->user['current_region_path_domain'])?'':region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users	= 	$region_users;
			$this->view->out_of_doctor  = 	$patient_referral_in->in_of_doctor;//转诊医生

			$this->view->phone			= 	$patient_referral_in->phone;//联系电话

			$this->view->my_org_code 	= 	$patient_referral_in->dst_org_name;//自己的机构名

			$org_obj					=	empty($patient_referral_in->dst_org_name)?'':get_org_info($patient_referral_in->dst_org_name);//机构对像
			$this->view->my_org_name 	=	empty($org_obj)?'':$org_obj->zh_name;//机构名

			$fill_time_year				=	empty($patient_referral_in->fill_time)?'':date("Y",$patient_referral_in->fill_time);//回转填表时间
			$fill_time_month			=	empty($patient_referral_in->fill_time)?'':date("m",$patient_referral_in->fill_time);//回转填表时间
			$fill_time_day				=	empty($patient_referral_in->fill_time)?'':date("d",$patient_referral_in->fill_time);//回转填表时间
			$this->view->fill_time_year = 	$fill_time_year;//回转填表时间
			$this->view->fill_time_month= 	$fill_time_month;//回转填表时间
			$this->view->fill_time_day 	= 	$fill_time_day;//回转填表时间

		}

		$this->view->display('add.html');
	}
	/**
	 * 更新双向转诊回转
	 *
	 */
	public function updateAction(){
		$individual_session 					= new Zend_Session_Namespace("individual_core");
		$uuid 									= $this->_request->getParam('uuid');//编号
		$patient_referral_in					= new Tpatient_referral_in();
			
		$patient_referral_in->age 				= $this->_request->getParam('age');//年龄
		
		$patient_referral_in->medical_report_no = $this->_request->getParam('medical_report_no');//病案号
		$referral_in_time 						= strtotime($this->_request->getParam('referral_in_time_year').'-'.$this->_request->getParam('referral_in_time_month').'-'.$this->_request->getParam('referral_in_time_day'));
		$patient_referral_in->referral_in_time  = $referral_in_time;//存根转入时间
		
		$patient_referral_in->rewind_unit 		= $this->_request->getParam('rewind_unit_code');//转回单位
		
		$patient_referral_in->my_doctor 		= $this->_request->getParam('my_doctor');//接诊医生
		
		$patient_referral_in->stub_doctor 		= $this->_request->getParam('stub_doctor');//存根转诊医生签字
		$stub_fill_time 						= strtotime($this->_request->getParam('stub_fill_time_year').'-'.$this->_request->getParam('stub_fill_time_month').'-'.$this->_request->getParam('stub_fill_time_day'));//存根填表时间
		$patient_referral_in->stub_fill_time 	= $stub_fill_time;//存根填表时间
		
		$patient_referral_in->my_org_name 		= $this->_request->getParam('my_org_code');//转到的机构名
		
		$patient_referral_in->medical_result 	= $this->_request->getParam('medical_result');//诊断结果
		
		$patient_referral_in->hospitalization_no= $this->_request->getParam('hospitalization_no');//住院病案号
		
		$patient_referral_in->result_of_examination = $this->_request->getParam('result_of_examination');//主要检查结果
		
		$patient_referral_in->suggestion 		= $this->_request->getParam('suggestion');//治疗经过,下一步治疗方案及康复建议
		
		$patient_referral_in->in_of_doctor 		= $this->_request->getParam('in_of_doctor');//转诊医生（签字）
		
		$patient_referral_in->phone 			= $this->_request->getParam('phone');//联系电话
		
		$patient_referral_in->dst_org_name 		= $this->_request->getParam('dst_org_code');//转入的机构名
		$fill_time								= strtotime($this->_request->getParam('fill_time_year').'-'.$this->_request->getParam('fill_time_month').'-'.$this->_request->getParam('fill_time_day'));//回转填表时间
		$patient_referral_in->fill_time 		= $fill_time;//回转填表时间
		
		$update_token=true;
		if(empty($uuid) && !empty($individual_session->uuid)){
			//添加
			$uuid						=uniqid("gp",true);//编号

			$patient_referral_in->uuid  = $uuid;//编号

			$patient_referral_in->staff_id = $this->user['uuid'];//医生档案号			

			$patient_referral_in->id 	= $individual_session->uuid;//个人档案号

			$patient_referral_in->created = time();//添加记录时间
			//$patient_referral_in->debugLevel(8);
			$update_token				= $patient_referral_in->insert();

		}else{
			//修改
			$patient_referral_in->whereAdd("uuid='$uuid'");
			$update_token=$patient_referral_in->update();

		}
		if($update_token==true){
			message("更新成功！",array("双向转诊（回转）单列表"=>__BASEPATH.'gp/transin/index',"添加"=>__BASEPATH."gp/transin/add/","修改"=>__BASEPATH."gp/transin/add/uuid/{$uuid}"));
		}else{
			message("更新失败！",array("双向转诊（回转）单列表"=>__BASEPATH.'gp/transin/index',"添加"=>__BASEPATH."gp/transin/add/","修改"=>__BASEPATH."gp/transin/add/uuid/{$uuid}"));
		}


	}

	/**
	 * 删除操作
	 *
	 */
	public function delAction(){
		$uuid         = $this->_request->getParam('uuid');
		$realname     = $this->_request->getParam('realnamedel');
		$nowdate      = $this->_request->getParam('nowdatedel');
		$actionname   = $this->_request->getParam('actionname');
		switch ($actionname){
			case "delall":
				  $selectFlag  = $this->_request->getParam('selectFlag');
				  if(is_string($selectFlag)){
				  	echo  '<script type="text/javascript">window.alert("没有选择记录?请选择重试！");history.go(-1);</script>';
				  	exit();
				  }else{
				  	foreach($selectFlag as $k=>$v){
				  		$patient_referral_in = new Tpatient_referral_in();
				  		$patient_referral_in->whereAdd("uuid='$v'");
				  		$patient_referral_in->delete();
				  	}
				  	message("批量删除双向转诊（回转）单成功",array("返回记录列表"=>__BASEPATH.'gp/transin/index')); 
				  }
				break;
			case "dellone":
		          $patient_referral_in = new Tpatient_referral_in();
				  $patient_referral_in->whereAdd("uuid='$uuid'");
				  if($patient_referral_in->delete()){
				  	 message("删除双向转诊（回转）单成功",array("返回记录列表"=>__BASEPATH.'gp/transin/index/realnamedel/'.urlencode($realname).'/nowdatedel/'.$nowdate)); 
				  }
				break;
		}
	}



}
?>