<?php
/**
     * 
     * @author Administrator
     *用于健康体检列表
     */
class et_listcontroller extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'library/Models/examination_table.php';
		require_once __SITEROOT.'library/Models/staff_archive.php';
		require_once __SITEROOT.'library/Models/staff_core.php';
		require_once __SITEROOT."/library/Models/individual_archive.php";
		require_once __SITEROOT."/library/Models/individual_core.php";
	}
	public function indexAction(){
		//var_dump($this->user);
		//引入分页
		require_once __SITEROOT."/library/custom/pager.php";
		//获取参数
		$realName     = urlencode(trim($this->_request->getParam('realname')));//体检人名称
		$serialnumber = trim($this->_request->getParam('serialnumber'));//档案编号
		$oldTime      = trim($this->_request->getParam('nowdate'));
		$nowdate      = strtotime($oldTime);//体检日期
		$doctor       = urlencode(trim($this->_request->getParam('doctor')));//体检医生
		$current_path = $this->user['current_region_path_domain'];
		$current_path_arr = explode('|',$current_path);
		var_dump($current_path_arr);
		$this->view->basePath     = $this->_request->getBasePath();
		$this->view->basepath     = __BASEPATH;
		$this->view->serialnumber = $serialnumber;
		$this->view->nowdate      = $oldTime;
		$realNewName   = urldecode($realName);//编码中文
		$realNewDoctor = urldecode($doctor);
		$this->view->doctor       = $realNewDoctor;
		$this->view->realname     = $realNewName;
		$this->view->doctornew    = $doctor;
		$this->view->realnamenew  = $realName;
		$experience = new Texamination_table();
		$staffArchive = new Tstaff_archive();
		$individual = new Tindividual_core();
		$experience->joinAdd('inner',$experience,$staffArchive,'examination_doctor','user_id');//关联医生ID
		$experience->joinAdd('inner',$experience,$individual,'id','uuid');//关联个人信息
		foreach ($current_path_arr as $k=>$v){
			$experience->whereAdd("individual_core.region_path like '$v%'");
		}
		if(!empty($realName)){
			$experience->whereAdd("individual_core.name='$realNewName'");
		}
		if(!empty($serialnumber)){
			$experience->whereAdd("individual_core.standard_code_1='$serialnumber'");
		}
		if(!empty($nowdate)){
			$experience->whereAdd("examination_table.examination_date='$nowdate'");
		}
		if(!empty($doctor)){
			$experience->whereAdd("staff_archive.name_real='$realNewDoctor'");
		}
		//$experience->debugLevel(9);
		$nuNumber = $experience->count();
		//echo $nuNumber;
		//处理分页
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		$arrArg = array();
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'et/list/index/realname/'.$realName.'/serialnumber/'.$serialnumber.'/nowdate/'.$nowdate.'/doctor/'.$doctor.'/page/',3,$arrArg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		echo 'dsdsd'.$nuNumber;
		if($nuNumber>0){
			//var_dump($_POST);
			$experienceNew = new Texamination_table();
			$staffArchiveNew = new Tstaff_archive();
			$individualNew = new Tindividual_core();
			$experienceNew->debugLevel(9);
			$experienceNew->joinAdd('inner',$experienceNew,$staffArchiveNew,'examination_doctor','user_id');//关联医生ID
			$experienceNew->joinAdd('inner',$experienceNew,$individualNew,'id','uuid');//关联个人信息
			//判断是否从表单传递过来的有值(搜索)
			if(!empty($realName)){
				$experienceNew->whereAdd("individual_core.name = '$realNewName'");
			}
			if(!empty($serialnumber)){
				$experienceNew->whereAdd("individual_core.standard_code_1='$serialnumber'");
			}
			if(!empty($nowdate)){
				$experienceNew->whereAdd("examination_table.examination_date='$nowdate'");
			}
			if(!empty($doctor)){
				$experienceNew->whereAdd("staff_archive.name_real='$realNewDoctor'");
			}
			foreach ($current_path_arr as $k=>$v){
				//echo $v.'<br/>';
				$experienceNew->whereAdd("individual_core.region_path like  '$v%'");
			}
			$experienceNew->limit($startnum,__ROWSOFPAGE);
			$experienceNew->find();
			$newArr = array();
			$count  = 0;
			while($experienceNew->fetch()){
				$newArr[$count]['name_real']     = $staffArchiveNew->name_real;
				$newArr[$count]['name']          = $individualNew->name;
				$newArr[$count]['examination']   = empty($experienceNew->examination_date)?date("Y-m-d",$experienceNew->created):date("Y-m-d",$experienceNew->examination_date);
				$newArr[$count]['uuid']          = $experienceNew->uuid;
				$newArr[$count]['serial_number'] = $experienceNew->serial_number;
				$count++;
			}
			$this->view->experience = $newArr;
		}else{
			//var_dump($_POST);
			$str = '<tr><td colspan="6" align="center">当前暂时没有任何数据！</td></tr>';
			$this->view->str = $str;
		}
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->pageCurrent = $pageCurrent;
		$this->view->display('list_experience.html');
	}

	public function delAction(){
		require_once(__SITEROOT.'library/Models/et_symptom.php');
		require_once(__SITEROOT.'library/Models/et_general_condition.php');
		require_once(__SITEROOT.'library/Models/et_lifestyle.php');
		require_once(__SITEROOT.'library/Models/et_organ.php');
		require_once(__SITEROOT.'library/Models/et_examination.php');
		require_once(__SITEROOT.'library/Models/et_identification.php');
		require_once(__SITEROOT.'library/Models/et_mhealth.php');
		require_once(__SITEROOT.'library/Models/et_hospitalization_history.php');
		require_once(__SITEROOT.'library/Models/et_operation_history.php');
		require_once(__SITEROOT.'library/Models/et_main_drug_use.php');
		require_once(__SITEROOT.'library/Models/et_nonepi_vaccination.php');
		require_once(__SITEROOT.'library/Models/et_health_assessment.php');
		require_once(__SITEROOT.'library/Models/et_health_guidance.php');
		$actionName = $this->_request->getParam('actionname');
		$delId = trim($this->_request->getParam('uuid'));
		$page  = intval($this->_request->getParam('page'));
		$pageCurrent = $page?$page:1;
		switch ($actionName){
			//处理删除单条记录
			case "dellone":
				if($delId){
					$experience = new Texamination_table();
					$experience->whereAdd("uuid='$delId'");
					$symptom    = new Tet_symptom();
					$symptom->whereAdd("examination_id='$delId'");
					$general    = new Tet_general_condition();
					$general->whereAdd("examination_id='$delId'");
					$lifestyle  = new Tet_lifestyle();
					$lifestyle->whereAdd("examination_id='$delId'");
					$organ      = new Tet_organ();
					$organ->whereAdd("examination_id='$delId'");
					$examination= new Tet_examination();
					$examination->whereAdd("examination_id='$delId'");
					$identification=new Tet_identification();
					$identification->whereAdd("examination_id='$delId'");
					$mhealth    = new Tet_mhealth();
					$mhealth->whereAdd("examination_id='$delId'");
					$history    = new Tet_hospitalization_history();
					$history->whereAdd("examination_id='$delId'");
					$nonepi     = new Tet_nonepi_vaccination();
					$nonepi->whereAdd("examination_id='$delId'");
					$maindrug   = new Tet_main_drug_use();
					$maindrug->whereAdd("examination_id='$delId'");
					$operation     = new Tet_operation_history();
					$operation->whereAdd("examination_id='$delId'");
					$assessment = new Tet_health_assessment();
					$assessment->whereAdd("examination_id='$delId'");
					$guidance   = new Tet_health_guidance();
					$guidance->whereAdd("examination_id='$delId'");
					$symptom->delete($this->user['uuid']);
					$general->delete($this->user['uuid']);
					$lifestyle->delete($this->user['uuid']);
					$organ->delete($this->user['uuid']);
					$examination->delete($this->user['uuid']);
					$identification->delete($this->user['uuid']);
					$history->delete($this->user['uuid']);
					$maindrug->delete($this->user['uuid']);
					$nonepi->delete($this->user['uuid']);
					$guidance->delete($this->user['uuid']);
					$assessment->delete($this->user['uuid']);
					$operation->delete($this->user['uuid']);
					$mhealth->delete($this->user['uuid']);
					$experience->delete($this->user['uuid']);
					$url=__BASEPATH."et/list/index/page/".$pageCurrent;
					$this->redirect($url);
				}
				break;
				//处理全部删除
			case "delall":
				$selectFlag = $this->_request->getParam('selectFlag');
				if(is_string($selectFlag))
				{
					echo  '<script type="text/javascript">window.alert("没有选择一条记录？");history.go(-1);</script>';
					exit();
				}else{
					foreach ($selectFlag as $k=>$v){
						//echo $v.'</br>';
						$experience = new Texamination_table();
						$symptom    = new Tet_symptom();
						$general    = new Tet_general_condition();
						$lifestyle  = new Tet_lifestyle();
						$organ      = new Tet_organ();
						$examination= new Tet_examination();
						$identification=new Tet_identification();
						$mhealth    = new Tet_mhealth();
						$history    = new Tet_hospitalization_history();
						$nonepi     = new Tet_nonepi_vaccination();
						$maindrug   = new Tet_main_drug_use();
						$operation     = new Tet_operation_history();
						$assessment = new Tet_health_assessment();
						$guidance   = new Tet_health_guidance();
						//$symptom->debugLevel(9);
						$symptom->whereAdd("examination_id='$v'");
						$symptom->delete($this->user['uuid']);
						$general->whereAdd("examination_id='$v'");
						$general->delete($this->user['uuid']);
						$lifestyle->whereAdd("examination_id='$v'");
						$lifestyle->delete($this->user['uuid']);
						$organ->whereAdd("examination_id='$v'");
						$organ->delete($this->user['uuid']);
						$examination->whereAdd("examination_id='$v'");
						$examination->delete($this->user['uuid']);
						$identification->whereAdd("examination_id='$v'");
						$identification->delete($this->user['uuid']);
						$mhealth->whereAdd("examination_id='$v'");
						$mhealth->delete($this->user['uuid']);
						$history->whereAdd("examination_id='$v'");
						$history->delete($this->user['uuid']);
						$nonepi->whereAdd("examination_id='$v'");
						$nonepi->delete($this->user['uuid']);
						$maindrug->whereAdd("examination_id='$v'");
						$maindrug->delete($this->user['uuid']);
						$operation->whereAdd("examination_id='$v'");
						$operation->delete($this->user['uuid']);
						$assessment->whereAdd("examination_id='$v'");
						$assessment->delete($this->user['uuid']);
						$guidance->whereAdd("examination_id='$v'");
						$guidance->delete($this->user['uuid']);
						$experience->whereAdd("uuid='$v'");
						$experience->delete($this->user['uuid']);
					}
					$this->redirect(__BASEPATH."et/list/index");
				}
				break;
		}
	}
}
?>