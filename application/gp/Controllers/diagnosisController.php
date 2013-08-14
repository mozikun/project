<?php 
class gp_diagnosisController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'library/Models/diagnosis_table.php';
		require_once __SITEROOT.'library/Models/individual_core.php';
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'library/Models/staff_core.php';
	}
	/**
	 * 添加接诊记录
	 */
	public function indexAction(){
		$individual_session=new Zend_Session_Namespace("individual_core");
		$editid          = $this->_request->getParam('uuid');
		$currentpage     = $this->_request->getParam('currentpage');
		$subjective_data = $this->_request->getParam('subjective_data');
		$objective_data  = $this->_request->getParam('objective_data');
		$assessment      = $this->_request->getParam('assessment');
		$disposal_plan   = $this->_request->getParam('disposal_plan');
		$doctorname      = $this->_request->getParam('doctorname');
		$year            = $this->_request->getParam('year');
		$month           = $this->_request->getParam('month');
		$day             = $this->_request->getParam('day');
		$iha_id          = $this->_request->getParam('iha_id');
		if(empty($editid)){
			if(empty($individual_session->uuid)){

				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			$this->view->user_name     = $individual_session->name;//居民姓名
		    $this->view->standard_code = $individual_session->standard_code_1;//标准档案号
		    $this->view->doctor_name   = $this->user['name_real'];
		    $this->view->doctor        = region_users($this->user['current_region_path_domain']);//来自comm_function.php
			//添加内容
			$diagnosis = new Tdiagnosis_table();
			$diagnosis->uuid            = uniqid();
			$diagnosis->subjective_data = $subjective_data;
			$diagnosis->objective_data  = $objective_data;
			$diagnosis->assessment      = $assessment;
			$diagnosis->disposal_plan   = $disposal_plan;
			$diagnosis->staff_id        = $doctorname;
			$this->view->current_doctor = $this->user['uuid'];
			if($year&&$month&&$day){
			    $diagnosis->created     = strtotime($year.'-'.$month.'-'.$day);
			}else{
				$diagnosis->created     = time();
			}
	        $diagnosis->id              = $individual_session->uuid;
	        if($this->_request->getParam('ok')){
	        	if($diagnosis->insert()){
	        		message("添加接诊记录成功",array("返回接诊记录列表"=>__BASEPATH.'gp/diagnosis/listdiagnosis/page/'.$currentpage));
	        	}
	        }
		}else{  
			    $this->view->doctor        = region_users($this->user['current_region_path_domain']);//来自comm_function.php
			    //取出当前ID的内容
			    $realname        = $this->_request->getParam('realname');
			    $currentdateold  = $this->_request->getParam('nowdatedit');
				$diagnosis       = new Tdiagnosis_table();
				$individualcore  = new Tindividual_core();
				//$diagnosis->debugLevel(9);
				$diagnosis->joinAdd('inner',$diagnosis,$individualcore,'id','uuid');
				$diagnosis->whereAdd("diagnosis_table.uuid='$editid'");
				$diagnosis->find(true);
				$this->view->subjective_data  = $diagnosis->subjective_data;
				$this->view->objective_data   = $diagnosis->objective_data;
				$this->view->assessment       = $diagnosis->assessment;
				$this->view->disposal_plan    = $diagnosis->disposal_plan;
				$this->view->current_doctor   = $diagnosis->staff_id;
				$this->view->iha_id           = $diagnosis->id;
				//处理时间
				$currentdate = explode('-',adodb_date('Y-m-d',$diagnosis->created));
				$this->view->year             = $currentdate[0];
				$this->view->month            = $currentdate[1];
				$this->view->day              = $currentdate[2];
				$this->view->user_name        = $individualcore->name;//居民姓名
		        $this->view->standard_code    = $individualcore->standard_code_1;//标准档案号
			    $this->view->realid           = $editid;
			    //更新内容
			    $editdiagnosis       = new Tdiagnosis_table();
			    $editdiagnosis->whereAdd("uuid='$editid'");
			    $editdiagnosis->subjective_data = $subjective_data;
			    $editdiagnosis->objective_data  = $objective_data;
			    $editdiagnosis->assessment      = $assessment;
				$editdiagnosis->disposal_plan   = $disposal_plan;
				$editdiagnosis->staff_id        = $doctorname;
				$editdiagnosis->created         = strtotime($year.'-'.$month.'-'.$day);
		        //$editdiagnosis->id              = $iha_id;
		        if($this->_request->getParam('ok')){
		           if($editdiagnosis->update()){
	        		  message("更新接诊记录成功",array("返回接诊记录列表"=>__BASEPATH.'gp/diagnosis/listdiagnosis/realname/'.urlencode($realname).'/nowdate/'.$currentdateold.'/page/'.$currentpage)); 
		           }
		        }
			}
		$this->view->basePath      = $this->_request->getBasePath();
		$this->view->display('index.html');
	}
	/**
	 * 列表显示接诊记录
	 */
	public function listdiagnosisAction(){
		$realname             = urldecode(trim($this->_request->getParam('realname')));
		$nowdate              = strtotime(trim($this->_request->getParam('nowdate')));
		//var_dump($nowdate);
		$search               = $this->_request->getParam('search');
		$this->view->basePath = $this->_request->getBasePath();
	    //引入分页
		require_once __SITEROOT."/library/custom/pager.php";
		$diagnosis  = new Tdiagnosis_table();
		$individual = new Tindividual_core();
		//$diagnosis->debugLevel(9);
		$diagnosis->joinAdd('inner',$diagnosis,$individual,'id','uuid');
		if($search){
			if(!empty($realname)){
					 $diagnosis->whereAdd("individual_core.name='$realname'");	
				}
			if(!empty($nowdate)){
					 $diagnosis->whereAdd("diagnosis_table.created='$nowdate'");
				}
		}
		$diagnosis->find();
		//echo $diagnosis->count();
		$arrArg = array();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$diagnosis->count(),$pageCurrent,__goodsListRowOfPage,__BASEPATH.'gp/diagnosis/listdiagnosis/realname/'.urlencode($realname).'/nowdate/'.$this->_request->getParam('nowdate').'/page/',3,$arrArg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		if($diagnosis->count()>0){
		    $diagnosislist   = new Tdiagnosis_table();
			$individualcore  = new Tindividual_core();
			//$diagnosislist->debugLevel(9);
			$diagnosislist->joinAdd('inner',$diagnosislist,$individualcore,'id','uuid');
//			//处理搜索
			if($search){
				if(!empty($realname)){
					 $diagnosislist->whereAdd("individual_core.name='$realname'");	
					}
				if(!empty($nowdate)){
					 $diagnosislist->whereAdd("diagnosis_table.created='$nowdate'");
					}
			}
			$diagnosislist->orderby("diagnosis_table.created DESC");
			$diagnosislist->limit($startnum,__ROWSOFPAGE);
			$diagnosislist->find();
			$diagnosislistarr   = array();
			$diagnosislistcount = 0 ;
			while($diagnosislist->fetch()){
			    $diagnosislistarr[$diagnosislistcount]['name']             = $individualcore->name;
			    $diagnosislistarr[$diagnosislistcount]['iha_id']           = $diagnosislist->id;
			    //查询当前的医生
			    $staff_core = new Tstaff_core();
			    $staff_core->whereAdd("id='$diagnosislist->staff_id'");
			    $staff_core->find(true);
			    $diagnosislistarr[$diagnosislistcount]['doctor_name']      = $staff_core->name_login;
			    $diagnosislistarr[$diagnosislistcount]['current_time']     = adodb_date('Y-m-d',$diagnosislist->created);
			    $diagnosislistarr[$diagnosislistcount]['uuid']             = $diagnosislist->uuid;
			    $diagnosislistarr[$diagnosislistcount]['standard_code_1']  = $individualcore->standard_code_1;
				$diagnosislistcount++;
			}
			$this->view->diagnosislistarr = $diagnosislistarr;
			$page = $links->subPageCss2();
  	    	$this->view->page   = $page;
		}else{
			$msg = '当前还没有任何数据 ！';
			$this->view->msg = $msg;
		}
		$this->view->delname        = $realname;
		$this->view->deldate        = adodb_date('Y-m-d',$nowdate);
		$this->view->nunumber       = $diagnosis->count();
		$this->view->currentpagenow = $pageCurrent;
		$this->view->urlencodename  = urlencode($realname);
		$this->view->current_time   = $nowdate;
		$this->view->display('listdiagnosis.html');
	}
	/**
	 * 接诊记录的删除
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
				  		$diagnosis = new Tdiagnosis_table();
				  		$diagnosis->whereAdd("uuid='$v'");
				  		$diagnosis->delete();
				  	}
				  	message("批量删除接诊记录成功",array("返回接诊记录列表"=>__BASEPATH.'gp/diagnosis/listdiagnosis')); 
				  }
				break;
			case "dellone":
		          $diagnosis = new Tdiagnosis_table();
				  $diagnosis->whereAdd("uuid='$uuid'");
				  if($diagnosis->delete()){
				  	 message("删除接诊记录成功",array("返回接诊记录列表"=>__BASEPATH.'gp/diagnosis/listdiagnosis/realnamedel/'.urlencode($realname).'/nowdatedel/'.$nowdate)); 
				  }
				break;
		}
	}
}
?>