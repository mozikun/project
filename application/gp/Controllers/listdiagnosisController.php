<?php 
class gp_listdiagnosisController extends controller{
	public function init(){
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'library/Models/diagnosis_table.php';
		require_once __SITEROOT.'library/Models/individual_core.php';
		require_once __SITEROOT.'/library/custom/comm_function.php';
	}
	public function indexAction(){
		$this->view->basePath = $this->_request->getBasePath();
		//引入分页
		require_once __SITEROOT."/library/custom/pager.php";
		$diagnosis  = new Tdiagnosis_table();
		$individual = new Tindividual_core();
		//$diagnosis->debugLevel(9);
		$diagnosis->joinAdd('inner',$diagnosis,$individual,'iha_id','uuid');
		$diagnosis->find();
		$arrArg = array();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$diagnosis->count(),$pageCurrent,__goodsListRowOfPage,__BASEPATH.'gp/listdiagnosis/index/page/',3,$arrArg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		if($diagnosis->count()>0){
		    $diagnosislist   = new Tdiagnosis_table();
			$individualcore  = new Tindividual_core();
			$diagnosislist->joinAdd('inner',$diagnosislist,$individualcore,'iha_id','uuid');
			$diagnosislist->orderby("current_time DESC");
			$diagnosislist->limit($startnum,__ROWSOFPAGE);
			$diagnosislist->find();
			$diagnosislistarr   = array();
			$diagnosislistcount = 0 ;
			while($diagnosislist->fetch()){
			    $diagnosislistarr[$diagnosislistcount]['name']        = $individualcore->name;
			    $diagnosislistarr[$diagnosislistcount]['iha_id']      = $diagnosislist->iha_id;
			    $diagnosislistarr[$diagnosislistcount]['doctor_name'] = $diagnosislist->doctor_name;
			    $diagnosislistarr[$diagnosislistcount]['current_time']= date('Y-m-d',$diagnosislist->current_time);
			    $diagnosislistarr[$diagnosislistcount]['uuid']        = $diagnosislist->uuid;
				$diagnosislistcount++;
			}
			$this->view->diagnosislistarr = $diagnosislistarr;
			$page = $links->subPageCss2();
  	    	$this->view->page   = $page;
		}else{
			echo "2";
		}
		$this->view->currentpagenow = $pageCurrent;
		$this->view->display('listdiagnosis.html');
	}
}
?>