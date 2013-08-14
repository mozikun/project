<?php 
   class zaojiaemr_indexController extends controller{
   	 public function  init(){
   	 	$this->view->basePath     = __BASEPATH;
   	 	require_once(__SITEROOT.'library/privilege.php');
   	 	require_once __SITEROOT."library/Models/zaojia_emr.php";
   	 	require_once __SITEROOT."library/Models/organization.php";
   	 	require_once __SITEROOT."library/custom/pager.php";
   	 }
   	 /**
   	  * 列表显示
   	  */
   	 public function indexAction(){
   	 	$zaojia_emr = new Tzaojia_emr();
   	 	$countNumber = $zaojia_emr->count();
   	 	$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		$search      = array();
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$countNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'zaojiaemr/index/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$zaojia_emrlist = new Tzaojia_emr();
		$zaojia_emrlist->orderby("visiting_doctor_time DESC");
		$zaojia_emrlist->limit($startnum,__ROWSOFPAGE);
		$zaojia_emrlist->find();
		$arr  = array();
		$count = 0;
		while($zaojia_emrlist->fetch()){
			$arr[$count]['uuid']         = $zaojia_emrlist->uuid;
			$arr[$count]['name']         = $zaojia_emrlist->name;
			$arr[$count]['age']          = $zaojia_emrlist->age;
			$arr[$count]['gender']       = $zaojia_emrlist->gender;
			$arr[$count]['adminssion_time']= $zaojia_emrlist->adminssion_time;
			$count++;
		}	
 		$out = $links->subPageCss2();
 		$this->view->page         = $out;
 		$this->view->listArray    = $arr;
 		$this->view->orgid        = $this->user['org_id'];
 		$this->view->display('index.html');
   	 }
   	/**
   	 * 详细
   	 */
   	 public function detailAction(){
   	 	$currentid = $this->_request->getParam('currentid');
   	 	$orgid     = $this->_request->getParam('$orgid');
   	 	$organization = new Torganization();
   	 	$organization->whereAdd("id='$orgid'");
   	 	$organization->find(true);
   	 	$this->view->orgname       = $organization->zh_name;
   	 	$zaojia_emr = new Tzaojia_emr();
   	 	$zaojia_emr->whereAdd("uuid='$currentid'");
   	 	$zaojia_emr->find(true);
   	 	$this->view->name                    = $zaojia_emr->name;
   	 	$this->view->gender                  = $zaojia_emr->gender;
   	 	$this->view->age                     = $zaojia_emr->age;
   	 	$this->view->bed_no                  = $zaojia_emr->bed_no;
   	 	$this->view->admission_number        = $zaojia_emr->admission_number;
   	 	$this->view->birthplace              = $zaojia_emr->birthplace;
   	 	$this->view->department              = $zaojia_emr->department;
   	 	$this->view->marital_status          = $zaojia_emr->marital_status;
   	 	$this->view->occupation              = $zaojia_emr->occupation;
   	 	$this->view->address                 = $zaojia_emr->address;
   	 	$this->view->race                    = $zaojia_emr->race;
   	 	$this->view->admission_time          = $zaojia_emr->admission_time;
   	 	$this->view->medical_records_time    = $zaojia_emr->medical_records_time;
   	 	$this->view->history_narrator        = $zaojia_emr->history_narrator;
   	 	$this->view->reliability             = $zaojia_emr->reliability;
   	 	$this->view->complaints              = $zaojia_emr->complaints;
   	 	$this->view->present_illness         = $zaojia_emr->present_illness;
   	 	$this->view->past_history            = $zaojia_emr->past_history;
   	 	$this->view->personal_history        = $zaojia_emr->personal_history;
   	 	$this->view->menstrual_history       = $zaojia_emr->menstrual_history;
   	 	$this->view->obsterical_history      = $zaojia_emr->obsterical_history;
   	 	$this->view->family_history          = $zaojia_emr->family_history;
   	 	//体格检查
   	 	$this->view->physical_t              = $zaojia_emr->physical_t;
   	 	$this->view->physical_p              = $zaojia_emr->physical_p;
   	 	$this->view->physical_r              = $zaojia_emr->physical_r;
   	 	$this->view->physical_bp_p           = $zaojia_emr->physical_bp_p;
   	 	$this->view->physical_bp_s           = $zaojia_emr->physical_bp_s;
   	 	$this->view->physical_general        = $zaojia_emr->physical_general;
   	 	$this->view->physical_skin           = $zaojia_emr->physical_skin;
   	 	$this->view->physical_lymphaden      = $zaojia_emr->physical_lymphaden;
   	 	$this->view->physical_head           = $zaojia_emr->physical_head;
   	 	$this->view->physical_neck           = $zaojia_emr->physical_neck;
   	 	$this->view->physical_chest          = $zaojia_emr->physical_chest;
   	 	$this->view->physical_vein           = $zaojia_emr->physical_vein;
   	 	//辅助检查
   	 	$this->view->physical_vein           = $zaojia_emr->examie_ecg;
   	 	$this->view->examine_electrolyte     = $zaojia_emr->examine_electrolyte;
   	 	$this->view->examine_blood_sugar     = $zaojia_emr->examine_blood_sugar;
   	 	$this->view->examine_blood           = $zaojia_emr->examine_blood;
   	 	$this->view->examine_heart_cdus      = $zaojia_emr->examine_heart_cdus;
   	 	$this->view->examine_sternum         = $zaojia_emr->examine_sternum;
   	 	$this->view->primary_diagnosis       = $zaojia_emr->primary_diagnosis;
   	 	$this->view->housestaff              = $zaojia_emr->housestaff;
   	 	$this->view->visiting_doctor         = $zaojia_emr->visiting_doctor;
   	 	$this->view->visiting_doctor_time    = $zaojia_emr->visiting_doctor_time;
   	 	$this->view->display('detail.html');
   	 }
   }
?>  