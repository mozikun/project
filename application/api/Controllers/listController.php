<?php
class api_listController  extends controller {
	public function init()
	{
		//用户权限和认证
		$this->haveWritePrivilege='';
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/patient_history.php');//门诊病历
		require_once(__SITEROOT.'library/Models/individual_core.php');//个人档案主表
		require_once(__SITEROOT.'library/Models/hos_discharge_certificate.php');//出院证明

		//print_r($this->user);
		$this->view->basePath = $this->_request->getBasePath();
	}
	/**
	 * 门诊病历列表
	 *
	 */
	public function patienthistoryAction(){
		require_once __SITEROOT."/library/custom/pager.php";
		require_once(__SITEROOT.'library/Models/patient_history.php');//门诊病历
		require_once(__SITEROOT.'library/Models/individual_core.php');//个人档案主表


		$org_id=$this->user['org_id'];//当前机构id
		$current_path = $this->user['current_region_path_domain'];
		$current_path_arr = explode('|',$current_path);
		$individual_session = new Zend_Session_Namespace("individual_core");
		$current_user       = $this->_request->getParam('current_user');//查当前session用户

		//获取当前表中有多少记录
		$patient = new Tpatient_history();
		$individual = new Tindividual_core();
		$patient->joinAdd('left',$patient,$individual,'serial_number','uuid');//关联个人信息
		//上级单位管下级
		$current_path_like='';
		foreach ($current_path_arr as $k=>$v){
			$current_path_like="individual_core.region_path like '$v%' or";
		}
		if($current_path_like!=''){
			$patient->whereAdd(trim($current_path_like,'or'));
		}
		//当前选中用户
		if($current_user){
			$patient->whereAdd("patient_history.serial_number='".$individual_session->uuid."'");
		}

		$numCount = $patient->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		$arrArg = array();
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$numCount,$pageCurrent,__goodsListRowOfPage,__BASEPATH."api/list/patienthistory/current_user/$current_user/page/",3,$arrArg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		if($numCount>0){
			$patient_history=new Tpatient_history();
			//$patient_history->whereAdd("hospital_id='{$org_id}'");
			$patient_history = new Tpatient_history();
			$individual = new Tindividual_core();
			$patient_history->joinAdd('inner',$patient_history,$individual,'serial_number','uuid');//关联个人信息
			foreach ($current_path_arr as $k=>$v){
				$patient_history->whereAdd("individual_core.region_path like '$v%'");
			}
			//当前选中用户
			if($current_user){
				$patient_history->whereAdd("patient_history.serial_number='".$individual_session->uuid."'");
			}
			$patient_history->whereAdd("diagnosis_time>0");
			$patient_history->orderby("diagnosis_time DESC");			
			$patient_history->limit($startnum,__ROWSOFPAGE);
			$patient_history->find();
			$patient_arr   = array();
			$patient_count = 0;
			while ($patient_history->fetch()) {

				if(!$this->haveWritePrivilege){
					$patient_arr[$patient_count]['id_card']    = '*';
				}else{
					$patient_arr[$patient_count]['id_card']    = $patient_history->id_card;
				}
				$patient_arr[$patient_count]['uuid'] 		   = $patient_history->uuid;
				$patient_arr[$patient_count]['diagnosis_time'] = date('Y-m-d',$patient_history->diagnosis_time);
				$patient_arr[$patient_count]['diagnosis']      = $patient_history->diagnosis;
				$patient_count++;
			}
			$this->view->patient_arr = $patient_arr;
		}else{
			$msg = "当前没有任何数据!";
			$this->view->msg = $msg;
		}
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->nuNumber = $numCount;
		//session用户
		if(!empty($individual_session->uuid)){
		
			$this->view->current_user=$individual_session->uuid;
		}
		$this->view->display('patient_history.html');
	}
	/**
	 * 门诊病历详细
	 *
	 */
	public function patienthistoryinfoAction(){


		$uuid=$this->_request->getParam('uuid');
		if(empty($uuid)){
			message("参数错误");
		}
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$patient_history = new Tpatient_history();
		$individual = new Tindividual_core();
		$patient_history->joinAdd('inner',$patient_history,$individual,'serial_number','uuid');//关联个人信息
		$patient_history->whereAdd("patient_history.uuid='{$uuid}'");
		$patient_history->find();
		$patient_history->fetch();
		if(!$this->haveWritePrivilege){
			$this->view->name	 		= '*';
		}else{
			$this->view->name	 		= $individual->name;
		}
		//$this->view->name	 		= $individual->name;
		$this->view->sex	 		= @$sex[array_search_for_other($individual->sex,$sex)][1];
		$this->view->date_of_birth  = $individual->date_of_birth=''?'':adodb_date("Y-m-d",$individual->date_of_birth);
		$this->view->race  			=  @$race[array_search_for_other($individual->race,$race)][1];
		$this->view->address  		= $individual->address;
		$this->view->diagnosis_date = $patient_history->diagnosis_time=''?'':adodb_date("Y-m-d",$patient_history->diagnosis_time);
		$this->view->diagnosis 		= $patient_history->diagnosis;
		$this->view->patient_history= $patient_history->patient_history;
		$this->view->remark			= $patient_history->remark;
		$doctor_info				= get_staff_info($patient_history->doctor_id);//就诊医生
		$this->view->doctor_name	=$doctor_info[1]->name_real;

		$this->view->display('patient_history_info.html');
	}

	/**
     * 出院证明列表
     *
     */
	public function hosdcAction(){
		require_once __SITEROOT."/library/custom/pager.php";
		require_once(__SITEROOT.'library/Models/hos_discharge_certificate.php');//出院证明
		require_once(__SITEROOT.'library/Models/individual_core.php');//个人档案主表
		$org_id=$this->user['org_id'];//当前机构id
		
		$current_path = $this->user['current_region_path_domain'];
		$current_path_arr = explode('|',$current_path);
		$individual_session = new Zend_Session_Namespace("individual_core");
		$current_user       = $this->_request->getParam('current_user');//查当前session用户
		//获取当前表中有多少记录
		$hos_discharge = new Thos_discharge_certificate();
		$individual = new Tindividual_core();
		$hos_discharge->joinAdd('left',$hos_discharge,$individual,'serial_number','uuid');//关联个人信息
		//上级单位管下级
		$current_path_like='';
		foreach ($current_path_arr as $k=>$v){
			$current_path_like="individual_core.region_path like '$v%' or";
		}
		if($current_path_like!=""){
			$hos_discharge->whereAdd(trim($current_path_like,'or'));
		}
		//当前选中用户
		if($current_user){
			$hos_discharge->whereAdd("hos_discharge_certificate.serial_number='".$individual_session->uuid."'");
		}
		//$hos_discharge->debugLevel(3);
		$numCount = $hos_discharge->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		$arrArg = array();
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$numCount,$pageCurrent,__goodsListRowOfPage,__BASEPATH."api/list/hosdc/current_user/$current_user/page/",3,$arrArg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		if($numCount>0){
			$hos_discharge_certificate=new Thos_discharge_certificate();
			//$hos_discharge_certificate->whereAdd("hospital_id='{$org_id}'");
			$individual = new Tindividual_core();
			$hos_discharge_certificate->joinAdd('left',$hos_discharge_certificate,$individual,'serial_number','uuid');//关联个人信息
			foreach ($current_path_arr as $k=>$v){
				$hos_discharge_certificate->whereAdd("individual_core.region_path like '$v%'");
			}
			$hos_discharge_certificate->whereAdd("discharged_time>0");
			//当前选中用户
			if($current_user){
				$hos_discharge_certificate->whereAdd("hos_discharge_certificate.serial_number='".$individual_session->uuid."'");
			}
			$hos_discharge_certificate->orderby("discharged_time DESC");	
			$hos_discharge_certificate->limit($startnum,__ROWSOFPAGE);
			$hos_discharge_certificate->find();
			$hos_discharge_arr   = array();
			$hos_discharge_count = 0;
			while ($hos_discharge_certificate->fetch()) {
				if(!$this->haveWritePrivilege){
					$hos_discharge_arr[$hos_discharge_count]['id_card']         =	'*';
				}else{
					$hos_discharge_arr[$hos_discharge_count]['id_card']         = 	$hos_discharge_certificate->id_card;
				}
				$hos_discharge_arr[$hos_discharge_count]['uuid']      		    = 	$hos_discharge_certificate->uuid;
				//$hos_discharge_arr[$hos_discharge_count]['id_card']        	= 	$hos_discharge_certificate->id_card;
				$hos_discharge_arr[$hos_discharge_count]['admission_time']	 	= 	date('Y-m-d',$hos_discharge_certificate->admission_time);
				$hos_discharge_arr[$hos_discharge_count]['discharged_time']		= 	date('Y-m-d',$hos_discharge_certificate->discharged_time);
				$hos_discharge_count++;
			}
			$this->view->hos_discharge_arr = $hos_discharge_arr;
		}else{
			$msg = "当前没有任何数据!";
			$this->view->msg = $msg;
		}
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->nuNumber = $numCount;
		//session用户
		if(!empty($individual_session->uuid)){
		
			$this->view->current_user=$individual_session->uuid;
		}
		$this->view->display('hos_dis.html');
	}
	/**
     * 出院证明详细 
     *
     */
	public function hosdcinfoAction(){

		$uuid=$this->_request->getParam('uuid');

		if(empty($uuid)){
			message("参数错误");
		}

		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$hos_discharge_certificate=new Thos_discharge_certificate();

		$individual = new Tindividual_core();
		$hos_discharge_certificate->joinAdd('inner',$hos_discharge_certificate,$individual,'serial_number','uuid');//关联个人信息
		$hos_discharge_certificate->whereAdd("hos_discharge_certificate.uuid='{$uuid}'");
		//$hos_discharge_certificate->debugLevel(3);
		$hos_discharge_certificate->find();
		$hos_discharge_certificate->fetch();

		if(!$this->haveWritePrivilege){
			$this->view->name	 		= '*';
		}else{
			$this->view->name	 		= $individual->name;
		}
		//$this->view->name	 		= $individual->name;
		$this->view->sex	 		= @$sex[array_search_for_other($individual->sex,$sex)][1];
		$this->view->date_of_birth  = $individual->date_of_birth=''?'':adodb_date("Y-m-d",$individual->date_of_birth);
		$this->view->race  			=  @$race[array_search_for_other($individual->race,$race)][1];
		$this->view->address  		= $individual->address;
		$this->view->admission_date = $hos_discharge_certificate->admission_time=''?'':adodb_date("Y-m-d",$hos_discharge_certificate->admission_time);//入院时间
		$this->view->discharged_date = $hos_discharge_certificate->discharged_time=''?'':adodb_date("Y-m-d",$hos_discharge_certificate->discharged_time);//出院时间
		$this->view->diagnosis 		= $hos_discharge_certificate->diagnosis;
		$this->view->suggestion		= $hos_discharge_certificate->suggestion;
		$this->view->remark			= $hos_discharge_certificate->remark;
		$doctor_info	= get_staff_info($hos_discharge_certificate->doctor_id);//就诊医生
		$this->view->doctor_name	=$doctor_info[1]->name_real;
		
		$this->view->display('hos_dis_info.html');
	}

}
