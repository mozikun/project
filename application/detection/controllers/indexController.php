<?php 
   class detection_indexController extends controller{
   	 public function  init(){
   	 	$this->view->basePath     = __BASEPATH;
   	 	//require_once(__SITEROOT.'library/privilege.php');
   	 	require_once __SITEROOT."library/Models/zj_clinic_lab_exam.php";
   	 	require_once __SITEROOT."library/Models/zj_indicators.php";
   	 	require_once __SITEROOT."library/custom/pager.php";
   	 }
   	 /**
   	  * 列表显示
   	  */
   	 public function indexAction(){
   	 	$clinic_exam = new Tzj_clinic_lab_exam();
   	 	$countNumber = $clinic_exam->count();
   	 	$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		$search      = array();
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$countNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'detection/index/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$clinic_examlist = new Tzj_clinic_lab_exam();
		$clinic_examlist->orderby("created DESC");
		$clinic_examlist->limit($startnum,__ROWSOFPAGE);
		$clinic_examlist->find();
		$arr  = array();
		$count = 0;
		while($clinic_examlist->fetch()){
			$arr[$count]['name']         = $clinic_examlist->name;
			$arr[$count]['spe_type']     = $clinic_examlist->spe_type;
			$arr[$count]['gender']       = $clinic_examlist->gender;
			$arr[$count]['lis_id']       = $clinic_examlist->lis_id;
			$arr[$count]['created']      = $clinic_examlist->created;
			$count++;
		}	
 		$out = $links->subPageCss2();
 		$this->view->page         = $out;
 		$this->view->listArray    = $arr;
 		$this->view->display('index.html');
   	 }
   	/**
   	 * 详细
   	 */
   	 public function detailAction(){
   	 	$currentid = $this->_request->getParam('currentid');
   	 	$clinic_exam = new Tzj_clinic_lab_exam();
   	 	$clinic_exam->whereAdd("lis_id='$currentid'");
   	 	$clinic_exam->find(true);
   	 	$this->view->name           = $clinic_exam->name;
   	 	$this->view->gender         = $clinic_exam->gender;
   	 	$this->view->age            = $clinic_exam->age;
   	 	$this->view->outpatient     = $clinic_exam->outpatient;
   	 	$this->view->spe_number     = $clinic_exam->spe_number;
   	 	$this->view->spe_type       = $clinic_exam->spe_type;
   	 	$this->view->departments    = $clinic_exam->departments;
   	 	$this->view->bed_number     = $clinic_exam->bed_number;
   	 	$this->view->medical_doctor = $clinic_exam->medical_doctor;
   	 	$this->view->test_equipment = $clinic_exam->test_equipment;
   	 	$this->view->lis_id         = $clinic_exam->lis_id;
   	 	$this->view->created        = $clinic_exam->created;
   	 	$this->view->remarks        = $clinic_exam->remarks;
   	 	$this->view->lis_id         = $currentid;
   	 	$lidicators  = new Tzj_indicators();
   	 	$lidicators->whereAdd("lis_id='$currentid'");
   	 	$lidicators->find();
   	 	$count = 0;
   	 	$currentArr = array();
   	 	while($lidicators->fetch()){
   	 		$currentArr[$count]['zh_name']     = $lidicators->zh_name;
   	 		$currentArr[$count]['en_name']     = $lidicators->en_name;
   	 		$currentArr[$count]['exam_result'] = $lidicators->exam_result;
   	 		$currentArr[$count]['exam_unit']   = $lidicators->exam_unit;
   	 		$currentArr[$count]['reference']   = $lidicators->reference;
   	 		$count++;
   	 	}
   	 	$this->view->currentArr  = $currentArr;
   	 	$this->view->display('detail.html');
   	 }
   }
?>  