<?php
class et_indexController  extends controller {
	public function init(){
		$this->view->basePath = $this->_request->getBasePath();
		//用户验证和权限
		$this->haveWritePrivilege='';
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';//
        require_once __SITEROOT."/library/Models/et_lifecase_assessment.php";
		require_once __SITEROOT."/library/Models/individual_archive.php";
		require_once __SITEROOT."/library/Models/individual_core.php";
		require_once(__SITEROOT.'library/Models/examination_table.php');
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
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/organization.php');
	}
	/**
    * 健康体检表列表
    */
	public function indexAction(){
                      
		//查看当前选中居民的健康体检信息
		$individual_session=new Zend_Session_Namespace("individual_core");
		$seeion_id=$individual_session->uuid;
		$experience = new Texamination_table();
		$individual = new Tindividual_core();
		$experience->joinAdd('left',$experience,$individual,'id','uuid');//关联个人信息
		$experience->whereAdd("examination_table.id='$seeion_id'");
		$experience->orderby("examination_table.updated DESC");
		$num=$experience->count();
		$experience->find(true);
		$this->view->et_id=$experience->uuid;
		$this->view->et_name=$individual->name;
		$this->view->num=$num;
		//echo mktime(0,0,0,4,25,2012);
		//获取地区的信息
//		var_dump($this->user);
  	 	$region_id =  $this->user['region_id'];
  	 	$this->view->region_id_search   = $region_id;
  	 	$this->view->region_p_id_search = $region_id;
  	 	$region_p_id_search   = $this->_request->getParam('region_p_id_search');
  	 	$current_id =  empty($region_p_id_search)?$region_id:$region_p_id_search;//地区的父ID
//  	 	$current_doctor = $this->user['uuid'];
//  	 	$this->view->current_doctor = $current_doctor;
  	 	//echo $current_id;
  	 	//echo $current_id;
  	 	//获取管辖机构
  	 	$region_path_domain = get_region_path(1, $current_id);
  	 	//获取医生
  	 	$staff_core_array=get_region_path(2);
  	 	$staff_core_doctor = new Tstaff_core();
  	 	$staff_core_doctor->whereAdd($staff_core_array);
  	 	$staff_core_doctor->find();
  	 	$staff_array = array();
  	 	$staff_count = 0;
  	 	while ($staff_core_doctor->fetch())
  	 	{
  	 		$staff_array[$staff_count]['id']     = $staff_core_doctor->id;
  	 		$staff_array[$staff_count]['zh_name'] = $staff_core_doctor->name_login;
  	 		$staff_count++;
  	 	}
  	 	$this->view->staff_array = $staff_array;
  	 	$region = new Tregion();
  	 	$region->whereAdd("id='$current_id'");
  	 	$region->find(true);
  	 	//echo $region->region_path;
		$tag_time = array('900','1630');
		$date_array = explode(':',date('H:i:s'),time());
		$current_time = intval($date_array[0].$date_array[1]);
		if($current_time<=$tag_time[1]&&$current_time>=$tag_time[0])
		{
			$this->view->mytag = 1;
		}
		require_once __SITEROOT."/library/custom/pager.php";
		//新加的代码
		require_once __SITEROOT.'library/data_arr/arrdata.php';
  	 	$this->view->sex   =  $sex;
  	 	$this->view->searchtable  = "examination_table";
		//获取参数
		$ok     = $this->_request->getParam("ok");
		if($ok)
		{
			$this->view->ok =1;
		}
		else 
		{
			$this->view->ok =0;
		}
		//echo $region_path_domain;
		$realName     = urlencode(trim($this->_request->getParam('realname')));//体检人名称
		$start_time   = trim($this->_request->getParam('start_time'));
		$end_time     = trim($this->_request->getParam('end_time'));
		//$nowdate      = strtotime($oldTime);//体检日期 
		$start_time_number = strtotime($start_time);
		$end_time_number = strtotime($end_time);
		$doctor = trim($this->_request->getParam('doctor'))?trim($this->_request->getParam('doctor')):99;//体检医生
		$this->view->current_doctor = $doctor;
		$indentity_card_number = trim($this->_request->getParam('indentity_card_number'));
		$this->view->indentity_card_number=$indentity_card_number;
		$begin_age=intval($this->_request->getParam('begin_age'))?intval($this->_request->getParam('begin_age')):0;//年龄段
		$end_age=(intval($this->_request->getParam('end_age'))>=$begin_age)?intval($this->_request->getParam('end_age')):'';
		$current_path = $this->user['current_region_path_domain'];
		$display_sign =  $this->_request->getParam('display_sign')?$this->_request->getParam('display_sign'):'none';
		$this->view->display_sign = $display_sign;
//		echo $start_time;
//		echo $end_time;
		//echo $current_path;
		//获取日期 默认获取一年之内的
		$time = time();
		$this->view->starttime = adodb_date("Y-m-d",adodb_mktime(0,0,0,adodb_date("n",$time),adodb_date("j",$time),adodb_date("Y",$time)-1));
        $this->view->endtime   = adodb_date("Y-m-d",adodb_mktime(0,0,0,adodb_date("n",$time),adodb_date("j",$time),adodb_date("Y",$time)));
		//获取时间 默认为本年时间(未体检时间)
		$this->view->starts_time=adodb_date("Y-m-d",adodb_mktime(0,0,0,01,01,adodb_date("Y",$time)));
		$this->view->ends_time=adodb_date("Y-m-d",adodb_mktime(23,59,59,adodb_date("m",$time),adodb_date("d",$time),adodb_date("Y",$time)));
		//地区id
		$region_id =  $this->user['region_id'];
  	 	$this->view->region_id     =  $region_id;
  	 	$this->view->region_p_id   =  $region_id;
		$current_path_arr = explode('|',$current_path);
		$this->view->basePath     = $this->_request->getBasePath();
		$this->view->basepath     = __BASEPATH;
		//$this->view->nowdate      = $oldTime;
		$realNewName   = urldecode($realName);//编码中文
		$realNewDoctor = urldecode($doctor);
		$this->view->realname     = $realNewName;
		$this->view->realnamenew  = $realName;
		$experience = new Texamination_table();
		$staffArchive = new Tstaff_archive();
		$individual = new Tindividual_core();
		//$experience->debugLevel(9);
		$experience->joinAdd('left',$experience,$staffArchive,'examination_doctor','user_id');//关联医生ID
		$experience->joinAdd('left',$experience,$individual,'id','uuid');//关联个人信息
                                      $experience->whereAdd($region_path_domain);
		if(!empty($realName)){
			$experience->whereAdd("individual_core.name='$realNewName'");
		}
        if(!empty($start_time_number))
        {
        	$experience->whereAdd("examination_table.examination_date>='$start_time_number'");
        }
        if(!empty($end_time_number))
        {
        	$experience->whereAdd("examination_table.examination_date<='$end_time_number'");
        }       
//		if(!empty($nowdate)){
//			$experience->whereAdd("examination_table.examination_date='$nowdate'");
//		}
		if($doctor!='99'){
			$experience->whereAdd("staff_archive.user_id='$doctor'");
		}
		if(!empty($indentity_card_number))
		{
			$experience->whereAdd("individual_core.identity_number='$indentity_card_number'");
		}
		if($begin_age!='' && $begin_age!=0)
        {
        	$begin_age_tmp = adodb_mktime(0,0,0,adodb_date("n",$time),adodb_date("j",$time),adodb_date("Y",$time)-$begin_age);
        	$experience->whereAdd("individual_core.date_of_birth<='$begin_age_tmp'");
        }
        if($end_age!='' && $end_age!=0)
        {
        	$end_age_tmp = adodb_mktime(0,0,0,adodb_date("n",$time),adodb_date("j",$time),adodb_date("Y",$time)-$end_age);
        	$experience->whereAdd("individual_core.date_of_birth>='$end_age_tmp'");
        }
		$experience->whereAdd("individual_core.status_flag='1'");
		$experience->orderby("examination_table.updated DESC");
		$nuNumber = $experience->count();
		//处理分页
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		$arrArg = array('realname'=>$realName,'doctor'=>$doctor,'region_p_id_search'=>$region_p_id_search,'start_time'=>$start_time,'end_time'=>$end_time,'begin_age'=>$begin_age,'end_age'=>$end_age,'indentity_card_number'=>$indentity_card_number);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'et/index/index/page/',3,$arrArg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//echo $nuNumber;
		if($nuNumber>0){
			$experience->limit($startnum,__ROWSOFPAGE);
			//echo "---------------------".__LINE__;
			//$experience->debugLevel(9);
			$experience->find();
			//$experience->debugLevel(9);
			//echo "1111111";
			$newArr = array();
			$count  = 0;
			while($experience->fetch()){
				$newArr[$count]['name_real']   = $staffArchive->name_real;
				if(!$this->haveWritePrivilege){
					$newArr[$count]['name']        = '*';
				}else{
					$newArr[$count]['name']        = $individual->name;
				}
				$newArr[$count]['examination']      = empty($experience->examination_date)?date("Y-m-d",$experience->created):date("Y-m-d",$experience->examination_date);
				$newArr[$count]['serial_number']    = $experience->serial_number;
				$newArr[$count]['date_of_birth']    = floor(($time-$individual->date_of_birth)/3600/24/365);
				$newArr[$count]['uuid']             = $experience->uuid;
				$newArr[$count]['serial_number']    = $experience->standard_code_1;
				$newArr[$count]['identity_number'] = $individual->identity_number;
				$newArr[$count]['address']          = $individual->address;
				$count++;
			}
			$this->view->experience = $newArr;
		}else{
			//var_dump($_POST);
			$str = '<tr><td colspan="7" align="center">当前暂时没有任何数据！</td></tr>';
			$this->view->str = $str;
		}
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->pageCurrent = $pageCurrent;
		//$experienceNew->free_statement();
		//$experience->free_statement();
		$this->view->display('list_experience.html');
	}

	public function delAction(){
		if(!$this->haveWritePrivilege){
			$url=array("健康体检表列表"=>__BASEPATH.'et/list/index',"用户列表"=>__BASEPATH.'iha/index/index');
			message("对不起，你可能没有权限删除本信息，错误代码：et010",$url);
		}
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
					//$url=__BASEPATH."et/index/page/".$pageCurrent;
					$url=array("健康体检表列表"=>__BASEPATH.'et/index/index',"个人档案列表"=>__BASEPATH.'iha/index/index');
			        message("删除成功！",$url);
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
					$this->redirect(__BASEPATH."et/index");
				}
				break;
		}
	}
	/**
    * 添加,修改 健康体检表 页面
    */
	public function addAction(){
		$uuid=$this->_request->getParam("uuid",'');
		$this->view->uuid=$uuid;
		$individual_session=new Zend_Session_Namespace("individual_core");
		if(empty($uuid))
		{
			if(empty($individual_session->uuid) || empty($individual_session->staff_id)){

				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			else
			{
				//判断死亡档案
				if($individual_session->status_flag!=1)
				{
					message("该档案为非正常档案,请选择其他档案做体检",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
				}
				else 
				{
					$this->view->id = $individual_session->uuid;
				}
			}
		}
		else 
		{
			$examination_main = new Texamination_table();
			$examination_main->whereAdd("uuid='$uuid'");
			$examination_main->find(true);
			$this->view->id = $examination_main->id;
		}
		//修改日期 2011.8.31开始
		//判断是不是老年人(65岁及其以上的都是)
		 $currentTime=time();
		 $mytime = adodb_date("Y-m-d",$currentTime);
		 $mytime_array = explode('-',$mytime);
		 $yearNumber = 65;
		 $tagNumber  = adodb_mktime(0,0,0,adodb_date("n",$currentTime),adodb_date("j",$currentTime),adodb_date("Y",$currentTime)-$yearNumber);
		 //找当前这个人的年龄做对比
		 if(empty($uuid))
		 {
			 $currentPerson = new Tindividual_core();
			 $currentPerson->whereAdd("uuid='$individual_session->uuid'");
			 $currentPerson->whereAdd("date_of_birth<='$tagNumber'");
			 $myCount = $currentPerson->count();
//			 echo $individual_session->uuid;
		 }else 
		 {
		 	 $currentPerson = new Tindividual_core();
		 	 $examination = new Texamination_table();
		 	 $currentPerson->joinAdd('left',$currentPerson,$examination,'uuid','id');
			 $currentPerson->whereAdd("examination_table.uuid='$uuid'");
			 $currentPerson->whereAdd("date_of_birth<='$tagNumber'");
			 $myCount = $currentPerson->count();
//			 echo $uuid;
		 }
		 if($myCount>0){
		 	$mytag = true;
		 	//老年人生活自理能力（来源于表ET_LIFECASE_ASSESSMENT查找最近一次的生活自理能力情况）
		 	if(empty($uuid))
		 	{
			 	$life_assessment = new Tet_lifecase_assessment();
			 	$life_assessment->whereAdd("id='$individual_session->uuid'");
			 	$life_assessment->orderby("created DESC");
			 	$life_assessment->limit(0,1);
			 	$life_assessment->find(true);
			 	$this->view->totalNumber  = $life_assessment->totalscore;
			 	$this->view->lifecaseuuid = $life_assessment->uuid;
			 	$this->view->editid=$individual_session->uuid;//传递当前状态栏选择居民的id
		 	}else{
		 		$examination_current =new Texamination_table();
		 		$examination_current->whereAdd("uuid='$uuid'");
		 		$examination_current->find(true);
		 		$exm_id=$examination_current->id?$examination_current->id:'';
		 		$this->view->editid=$examination_current->id;//传递不是当前状态栏选择居民的id，而是传递当前编辑居民的id
		 		
		 		$life_assessment = new Tet_lifecase_assessment();
			 	$life_assessment->whereAdd("id='$exm_id'");
			 	$life_assessment->orderby("created DESC");
			 	$life_assessment->limit(0,1);
			 	$life_assessment->find(true);
			 	$this->view->totalNumber  = $life_assessment->totalscore;
			 	$this->view->lifecaseuuid = $life_assessment->uuid;
		 	}
		 }else{
	        $mytag = false;
		 }
		 $this->view->mytag = $mytag;
		 
		 //判断是不是女性
		 $individual_core_my = new Tindividual_core();
		 $individual_core_my->whereAdd("uuid='$individual_session->uuid'");
		 $individual_core_my->find(true);
		 $sex = $individual_core_my->sex;
		 if($sex==3){
		 	$sexTag = true;
		 }else{
		 	$sexTag = false;
		 }
		 $this->view->sexTag = $sexTag;
		 
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$examination_table=new Texamination_table();
		$examination_table->whereAdd("examination_table.uuid='{$uuid}'");
		$examination_table->find();
		$examination_table->fetch();

		$this->view->examination_date_year = empty($examination_table->examination_date)?'':adodb_date("Y",$examination_table->examination_date) ;
		$this->view->examination_date_month = empty($examination_table->examination_date)?'':adodb_date("m",$examination_table->examination_date) ;
		$this->view->examination_date_day = empty($examination_table->examination_date)?'':adodb_date("d",$examination_table->examination_date) ;

		if(empty($uuid)){
			//添加
			$this->view->examination_date_year = $mytime_array[0];
			$this->view->examination_date_month = $mytime_array[1];
			$this->view->examination_date_day = $mytime_array[2];
			//print_r($this->user);
			$this->view->user_name = $individual_session->name;//居民姓名
			$this->view->standard_code = $individual_session->standard_code_1;//标准档案号
			$this->view->response_doctor = $this->user['uuid'];//责任医生id

			//echo $individual_session->staff_id;
			//$individual_session->standard_code;//设置手工标准档案号
			//$individual_session->standard_code_1;//设置国家标准档案号
			//$individual_session->standard_code_2;//设置省标准档案号
			//$stff_info=get_staff_info($individual_session->response_doctor);//取所有医生信息
			//$this->view->examination_doctor = $stff_info->name_real;//责任医生
			$all_user=get_all_staff_info($this->user['org_id']);//取得当前社区的所有医生
			$this->view->examination_doctor =$all_user;
			//print_r($all_user);
		}else{
			//修改
			$individual_inf=get_individual_info($examination_table->id);//取得个人信息中所有信息
			if(!$this->haveWritePrivilege){
				$this->view->user_name = '*';//居民姓名
			}else{
				$this->view->user_name = $individual_inf->name;//居民姓名
			}
			//$this->view->user_name = $individual_inf->name;//居民姓名
			$this->view->standard_code = $examination_table->serial_number;//标准档案号
			$examination_doctor=$examination_table->examination_doctor;//责任医生
			$this->view->response_doctor = $examination_doctor;//责任医生
			$staff_info=get_staff_info($examination_doctor);//取提医生信息
			$staff_info=$staff_info[0];//用户主表中信息
			$all_user=get_all_staff_info($staff_info->org_id);//取得社区的所有医生
			$this->view->examination_doctor =$all_user;

		}

		$et_symptom1=new Tet_symptom();//症状
		$et_symptom1->whereAdd("examination_id='{$uuid}'");
		$et_symptom1->find();
		$et_symptom1->fetch();
		$this->view->symptom_options =$et_symptom; //症状|checkbox|1=>无症状,2=>头痛,3=>头晕,4=>心悸,5=>胸闷,6=>胸痛,7=>慢性咳嗽,8=>咳痰,9=>呼吸困难,10=>多饮,11=>多尿,12=>体重下降,13=>乏力,14=>关节肿痛,15=>视力模糊,16=>手脚麻木,17=>尿急,18=>尿痛,19=>便秘,20=>腹泻,21=>恶心呕吐,22=>眼花,23=>耳鸣,24=>乳房胀痛,25=>其他
		$et_symptom_arr=@explode('|',$et_symptom1->symptom);
		$et_symptom_array=array();//存放症状
		foreach ($et_symptom_arr as $et_symptom_val){
			$et_symptom_array[]= array_search_for_other($et_symptom_val,$et_symptom);
		}
		$this->view->symptom_options_json =json_encode($et_symptom);//json格式的代码
		$this->view->symptom_current_code_arr = $et_symptom_array;//外部代码

		$this->view->symptom_other = $et_symptom1->symptom_other;

		$et_general_condition=new Tet_general_condition();//一般状况
		$et_general_condition->whereAdd("examination_id='{$uuid}'");
		$et_general_condition->find();
		$et_general_condition->fetch();
		$this->view->temperature = $et_general_condition->temperature;//体温|text
		$this->view->pulse = $et_general_condition->pulse;//脉搏|text
		$this->view->breathing_rate = $et_general_condition->breathing_rate;//呼吸频率|text
		$this->view->blood_pressure_left_s = $et_general_condition->blood_pressure_left_s;//血压左收缩压|text
		$this->view->blood_pressure_left_p = $et_general_condition->blood_pressure_left_p;//血压左舒张压|text
		$this->view->blood_pressure_right_s = $et_general_condition->blood_pressure_right_s;//血压右收缩压|text
		$this->view->blood_pressure_right_p = $et_general_condition->blood_pressure_right_p;//血压右舒张压|text
		$this->view->height = $et_general_condition->height;//身高|text
		$this->view->weight = $et_general_condition->weight;//体重|text
		$this->view->bmi = $et_general_condition->bmi;//体质指数|text
		$this->view->waistline = $et_general_condition->waistline;//腰围|text
		$this->view->upelder_health_status = $et_general_condition->elder_health_status;//老年人健康状态自我评估
		$this->view->upelder_living_skills = $et_general_condition->elder_living_skills;//老年人健康状态自我评估
//		$this->view->hipcircumference = $et_general_condition->hipcircumference;//臀围|text
//		$this->view->whi = $et_general_condition->whi;//腰臀围比值|text
		/**
		 * 表注释:老年人认知功能|checkbox|1=>粗筛阴性,2=>粗筛阳性
		 * 
		 * 
		 **/

		$this->view->older_cognitive_functions_options =$et_older_cognitive_functions; //老年人认知功能|checkbox|1=>粗筛阴性,2=>粗筛阳性
		$this->view->older_cognitive_functions_current = $et_general_condition->older_cognitive_functions;//老年人认知功能|checkbox|1=>粗筛阴性,2=>粗筛阳性
		$this->view->mmse = $et_general_condition->mmse;//智力状态检查总分|text
		/**
		 * elder_health_status 老年人健康状态自我评估
		 */
		$this->view->elder_health_status       =     $elder_health_status; 
		/**
		 * elder_living_skills 老年人生活自理能力自我评估
		 */
		$this->view->elder_living_skills = $elder_living_skills;
		/**
		 * 表注释:老年人情感状态|checbox|1=>粗筛阴性,2=>粗筛阳性
		 * 
		 * 
		 **/

		$this->view->older_affective_state_options =$et_older_affective_state; //老年人情感状态|checbox|1=>粗筛阴性,2=>粗筛阳性
		$this->view->older_affective_state_current = $et_general_condition->older_affective_state;//老年人情感状态|checbox|1=>粗筛阴性,2=>粗筛阳性
		$this->view->depression = $et_general_condition->depression;//老年人抑郁量表总分|text

		$et_lifestyle=new Tet_lifestyle();//生活方式
		$et_lifestyle->whereAdd("examination_id='{$uuid}'");
		$et_lifestyle->find();
		$et_lifestyle->fetch();
		/**
		 * 表注释:锻炼频率|checkbox|1=>每天,2=>每周一次以上,3=>偶尔,4=>不锻炼
		 * 
		 * 
		 **/
		$this->view->sport_frequence_options =$et_sport_frequence; //锻炼频率|checkbox|1=>每天,2=>每周一次以上,3=>偶尔,4=>不锻炼
		$this->view->sport_frequence_current = array_search_for_other($et_lifestyle->sport_frequence,$et_sport_frequence);//锻炼频率|checkbox|1=>每天,2=>每周一次以上,3=>偶尔,4=>不锻炼
		$this->view->sport_time = $et_lifestyle->sport_time;//每次锻炼时间(分钟)|text
		$this->view->exercise_duration = $et_lifestyle->exercise_duration;//坚持锻炼时间|text
		$this->view->exercising_way = $et_lifestyle->exercising_way;//锻炼方式|text
		/**
		 * 表注释:饮食习惯|checkbox|1=>荤素均衡,2=>荤食为主,3=>素食为主,4=>嗜盐,5=>嗜油,6=>嗜糖
		 * 
		 * 
		 **/

		$this->view->food_habit_options =$et_food_habit; //饮食习惯|checkbox|1=>荤素均衡,2=>荤食为主,3=>素食为主,4=>嗜盐,5=>嗜油,6=>嗜糖
		//$this->view->food_habit_current = array_search_for_other($et_lifestyle->food_habit,$et_food_habit);//饮食习惯|checkbox|1=>荤素均衡,2=>荤食为主,3=>素食为主,4=>嗜盐,5=>嗜油,6=>嗜糖
		$food_habit_arr=@explode('|',$et_lifestyle->food_habit);
		$food_habit_array=array();
		foreach ($food_habit_arr as $food_habit_val)
		{
			$food_habit_array[]=array_search_for_other($food_habit_val,$et_food_habit);
		}
		$this->view->foot_habit_current=$food_habit_array;
		$this->view->foot_habit_json=json_encode($et_food_habit);
		//var_dump($food_habit_array);
		/**
		 * 表注释:吸烟状况|checkbox|1=>从不吸烟,2=>已戒烟,3=>吸烟
		 * 
		 * 
		 **/

		$this->view->smoke_options =$et_smoke; //吸烟状况|checkbox|1=>从不吸烟,2=>已戒烟,3=>吸烟
		$this->view->smoke_current = array_search_for_other($et_lifestyle->smoke,$et_smoke);//吸烟状况|checkbox|1=>从不吸烟,2=>已戒烟,3=>吸烟
		$this->view->smoke_quantity1 = $et_lifestyle->smoke_quantity;//日吸烟量(支)|text
		$this->view->begin_smoke_age1 = $et_lifestyle->begin_smoke_age;//开始吸烟年龄(岁)|text
		$this->view->stop_smoke_age1 = $et_lifestyle->stop_smoke_age;//戒烟年龄(岁)|text
		/**
		 * 表注释:饮酒频率|radio|1=>从不,2=>偶尔,3=>经常,4=>每天
		 * 
		 * 
		 **/

		$this->view->drink_frequency_options =$et_drink_frequency; //饮酒频率|radio|1=>从不,2=>偶尔,3=>经常,4=>每天
		$this->view->drink_frequency_current = array_search_for_other($et_lifestyle->drink_frequency,$et_drink_frequency);//饮酒频率|radio|1=>从不,2=>偶尔,3=>经常,4=>每天
		$this->view->drink_quantity = $et_lifestyle->drink_quantity;//日饮酒量(两)|text

		$this->view->drink_options =$et_drink; //是否戒酒|radio|1=>未戒酒,2=>已戒酒
		$this->view->drink_current = $et_lifestyle->drink;//是否戒酒|radio|1=>未戒酒,2=>已戒酒
		$this->view->stop_drinking_age = $et_lifestyle->stop_drinking_age;//
		$this->view->begin_drinking_age = $et_lifestyle->begin_drinking_age;//开始饮酒年龄|text
		/**
		 * 表注释:近一年内是否曾醉酒|radio|1=>是,2=>否
		 * 
		 * 
		 **/

		$this->view->last_year_ntoxication_options =$et_last_year_ntoxication; //近一年内是否曾醉酒|radio|1=>是,2=>否
		$this->view->last_year_ntoxication_current = array_search_for_other($et_lifestyle->last_year_ntoxication,$et_last_year_ntoxication);//近一年内是否曾醉酒|radio|1=>是,2=>否
		/**
		 * 表注释:饮酒种类|checkbox|1=>白酒,2=>啤酒,3=>红酒,4=>黄酒,5=>其他
		 * 
		 * 
		 **/

		$this->view->drink_style_options =$et_drink_style; //饮酒种类|checkbox|1=>白酒,2=>啤酒,3=>红酒,4=>黄酒,5=>其他
		$drink_style_arr=@explode('|',$et_lifestyle->drink_style);//饮酒种类|checkbox|1=>白酒,2=>啤酒,3=>红酒,4=>黄酒,5=>其他
		//print_r($drink_style_arr);
		$drink_style_array=array();
		foreach ($drink_style_arr as $drink_style_val){
			$drink_style_array[]=array_search_for_other($drink_style_val,$et_drink_style);
		}
		$this->view->drink_style_current = $drink_style_array;
		//print_r($drink_style_array);
		$this->view->drink_style_other = $et_lifestyle->drink_style_other;//其它饮酒种类|text
		$this->view->drink_style_json=json_encode($et_drink_style);
		/**
		 * 表注释:职业暴露|radio|1=>无,2=>有
		 * 
		 * 
		 **/

		$this->view->occupational_exposure_options =$et_occupational_exposure; //职业暴露|radio|1=>无,2=>有
		$this->view->occupation_status = $et_lifestyle->occupational_exposure;//职业暴露|radio|1=>无,2=>有
		$this->view->occupation = $et_lifestyle->occupation;//具体职业|text
		$this->view->occupation_age = $et_lifestyle->occupation_age;//从业时间(年)|text
		$this->view->chemistry = $et_lifestyle->chemistry;//毒物种类化学品|text
		/** 
		 * 表注释:毒物种类化学品防护措施|radio|1=>无,2=>有
		 * 
		 * 
		 **/

		$this->view->chemistry_protection_options =$et_chemistry_protection; //毒物种类化学品防护措施|radio|1=>无,2=>有
		$this->view->chemistry_protection_current = $et_lifestyle->chemistry_protection;//毒物种类化学品防护措施|radio|1=>无,2=>有
		$this->view->chemistry_protection_info = $et_lifestyle->chemistry_protection_info;//毒物种类化学品防护措施|text
		$this->view->pest = $et_lifestyle->pest;//毒物种类毒物|text
		/**
		 * 表注释:毒物种类防护毒物措施|radio|1=>无,2=>有
		 * 
		 * 
		 **/

		$this->view->pest_protection_options =$et_pest_protection; //毒物种类防护毒物措施|radio|1=>无,2=>有
		$this->view->pest_protection_current = $et_lifestyle->pest_protection;//毒物种类防护毒物措施|radio|1=>无,2=>有
		$this->view->pest_protection_info = $et_lifestyle->pest_protection_info;//毒物种类毒物防护措施|text
		$this->view->ray = $et_lifestyle->ray;//毒物种类射线|text
		/**
		 * 表注释:毒物种类防护射线措施|radio|1=>无,2=>有
		 * 
		 * 
		 **/

		$this->view->ray_protection_options =$et_ray_protection; //毒物种类防护射线措施|radio|1=>无,2=>有
		$this->view->ray_protection_current = $et_lifestyle->ray_protection;//毒物种类防护射线措施|radio|1=>无,2=>有
		$this->view->ray_protection_info = $et_lifestyle->ray_protection_info;//毒物种类射线|text
        /**
         * 表注释：职业病危害 粉尘防护措施 |radio|1=>无,2=>有
         */
        $this->view->dust                    = $et_lifestyle->dust;
        $this->view->dust_protection_options = $et_dust_protection;//职业病危害 粉尘防护措施 |radio|1=>无,2=>有
        $this->view->dust_protection_current = $et_lifestyle->dust_protection;//职业病危害 粉尘防护措施 |radio|1=>无,2=>有
        $this->view->dust_protection_info    = $et_lifestyle->dust_protection_info;//职业病危害粉尘防护措施|text
        /**
         * 表注释：职业病危害物理因素防护措施 |radio|1=>无,2=>有
         */
        $this->view->physical                     = $et_lifestyle->physical;
        $this->view->physical_protection_options  =  $physical;//职业病危害物理因素防护措施 |radio|1=>无,2=>有
        $this->view->physical_protection_current  =  $et_lifestyle->physical_protection;//职业病危害物理因素防护措施 |radio|1=>无,2=>有
        $this->view->physical_protection_info     =  $et_lifestyle->physical_protection_info;//职业病危害物理因素防护措施 |text
        /**
         * 表注释：职业病危害其他因素防护措施|radio|1=>无，2=>有
         */
        $this->view->other_types                  = $et_lifestyle->other_types;
        $this->view->other_types_options          =   $other_types;//职业病危害其他防护措施 |radio|1=>无,2=>有
        $this->view->other_types_protection       =   $et_lifestyle->other_types_protection;//职业病危害其他防护措施 |radio|1=>无,2=>有
        $this->view->other_types_info             =   $et_lifestyle->other_types_info;//职业病危害其他防护措施 |text 
		$et_organ=new Tet_organ();//脏器功能
		$et_organ->whereAdd("examination_id='{$uuid}'");
		$et_organ->find();
		$et_organ->fetch();
		/**
		 * 表注释:口腔 口唇|radio|1=>红润,2=>苍白,3=>发干,4=>皲裂,5=>疱疹
		 * 
		 * 
		 **/

		$this->view->lips_options =$et_lips; //口腔 口唇|radio|1=>红润,2=>苍白,3=>发干,4=>皲裂,5=>疱疹
		$this->view->lips_current = array_search_for_other($et_organ->lips,$et_lips);//口腔 口唇|radio|1=>红润,2=>苍白,3=>发干,4=>皲裂,5=>疱疹
		$this->view->dentition = $et_organ->dentition;//口腔 齿列正常|text
		$this->view->dentition_missing_teeth = explode('|',$et_organ->dentition_missing_teeth);//口腔 齿列缺齿|text
		$this->view->dentition_decayed_tooth = explode('|',$et_organ->dentition_decayed_tooth);//口腔齿列龋齿|text
		$this->view->dentition_false_tooth = explode('|',$et_organ->dentition_false_tooth);//口腔齿列义齿(假牙)|text
		/**
		 * 表注释:口腔咽部|radio|1=>无充血,2=>充血,3=>淋巴滤泡增生
		 * 
		 * 
		 **/

		$this->view->pharyngeal_portion_options =$et_pharyngeal_portion; //口腔咽部|radio|1=>无充血,2=>充血,3=>淋巴滤泡增生
		$this->view->pharyngeal_portion_current = array_search_for_other($et_organ->pharyngeal_portion,$et_pharyngeal_portion);//口腔咽部|radio|1=>无充血,2=>充血,3=>淋巴滤泡增生
		$this->view->left_eye = $et_organ->left_eye;//视力左眼|text
		$this->view->left_eye_corrected_vision = $et_organ->left_eye_corrected_vision;//视力左眼矫正视力|text
		$this->view->right_eye = $et_organ->right_eye;//视力右眼|text
		$this->view->right_eye_corrected_vision = $et_organ->right_eye_corrected_vision;//视力右眼矫正视力|text
		/**
		 * 表注释:听力|radio|1=>听见,2=>听不清或无法听见
		 * 
		 * 
		 **/

		$this->view->hearing_options =$et_hearing; //听力|radio|1=>听见,2=>听不清或无法听见
		$this->view->hearing_current = array_search_for_other($et_organ->hearing,$et_hearing);//听力|radio|1=>听见,2=>听不清或无法听见
		/**
		 * 表注释:运用功能|radio|1=>可顺利完成,2=>无法独立完成其中任何一个动作
		 * 
		 * 
		 **/

		$this->view->energizing_function_options =$et_energizing_function; //运用功能|radio|1=>可顺利完成,2=>无法独立完成其中任何一个动作
		$this->view->energizing_function_current = array_search_for_other($et_organ->energizing_function,$et_energizing_function);//运用功能|radio|1=>可顺利完成,2=>无法独立完成其中任何一个动作
		/**
		 * 表注释:皮肤|radio|1=>正常,2=>潮红,3=>苍白,4=>发绀,5=>黄染,6=>色素沉着,7=>其他
		 * 
		 * 
		 **/

		$this->view->skin_options =$et_skin; //皮肤|radio|1=>正常,2=>潮红,3=>苍白,4=>发绀,5=>黄染,6=>色素沉着,7=>其他
		$this->view->skin_options_json = json_encode($et_skin);
		$this->view->skin_current = array_search_for_other($et_organ->skin,$et_skin);//皮肤|radio|1=>正常,2=>潮红,3=>苍白,4=>发绀,5=>黄染,6=>色素沉着,7=>其他
		$this->view->skin_other = $et_organ->skin_other;//皮肤其它|text
		/**
		 * 表注释:巩膜|radio|1=>正常,2=>黄染,3=>充血,4=>其他
		 * 
		 * 
		 **/

		$this->view->sclera_options =$et_sclera; //巩膜|radio|1=>正常,2=>黄染,3=>充血,4=>其他
		$this->view->et_sclera_json = json_encode($et_sclera);
		$this->view->sclera_current = array_search_for_other($et_organ->sclera,$et_sclera);//巩膜|radio|1=>正常,2=>黄染,3=>充血,4=>其他
		$this->view->sclera_other = $et_organ->sclera_other;//巩膜其它|text
		/**
		 * 表注释:淋巴结|radio|1=>未触及,2=>锁骨上,3=>腋窝,4=>其他
		 * 
		 * 
		 **/

		$this->view->lymph_node_options =$et_lymph_node; //淋巴结|radio|1=>未触及,2=>锁骨上,3=>腋窝,4=>其他
		$this->view->et_lymph_json = json_encode($et_lymph_node);
		$this->view->lymph_node_current = array_search_for_other($et_organ->lymph_node,$et_lymph_node);//淋巴结|radio|1=>未触及,2=>锁骨上,3=>腋窝,4=>其他
		$this->view->lymph_node_other = $et_organ->lymph_node_other;//淋巴结其它|text
		/**
		 * 表注释:肺桶状胸|radio|1=>否,2=>是
		 * 
		 * 
		 **/

		$this->view->lung_barrel_chest_options =$et_lung_barrel_chest; //肺桶状胸|radio|1=>否,2=>是
		$this->view->lung_barrel_chest_current = array_search_for_other($et_organ->lung_barrel_chest,$et_lung_barrel_chest);//肺桶状胸|radio|1=>否,2=>是
		/**
		 * 表注释:肺呼吸音|radio|1=>正常,2=>异常
		 * 
		 * 
		 **/

		$this->view->lung_sounds_options =$et_lung_sounds; //肺呼吸音|radio|1=>正常,2=>异常
		$this->view->lung_sounds_current = $et_organ->lung_sounds;//肺呼吸音|radio|1=>正常,2=>异常
		$this->view->lung_sounds_exception = $et_organ->lung_sounds_exception;//肺呼吸音异常|text
		/**
		 * 表注释:肺罗音|radio|1=>无,2=>干罗音,3=>湿罗音,4=>其他
		 * 
		 * 
		 **/

		$this->view->lung_rale_options =$et_lung_rale; //肺罗音|radio|1=>无,2=>干罗音,3=>湿罗音,4=>其他
		$this->view->et_lung_json = json_encode($et_lung_rale);
		$this->view->lung_rale_current = array_search_for_other($et_organ->lung_rale,$et_lung_rale);//肺罗音|radio|1=>无,2=>干罗音,3=>湿罗音,4=>其他
		$this->view->lung_rale_other = $et_organ->lung_rale_other;//肺罗音其它|text
		$this->view->heart_rate = $et_organ->heart_rate;//心率(次/分钟)|text
		/**
		 * 表注释:心律|radio|1=>齐,2=>不齐,3=>绝对不齐
		 * 
		 * 
		 **/

		$this->view->heart_rhythm_options =$et_heart_rhythm; //心律|radio|1=>齐,2=>不齐,3=>绝对不齐
		$this->view->heart_rhythm_current = array_search_for_other($et_organ->heart_rhythm,$et_heart_rhythm);//心律|radio|1=>齐,2=>不齐,3=>绝对不齐
		/**
		 * 表注释:心脏杂音|radio|1=>无,2=>有
		 * 
		 * 
		 **/

		$this->view->heart_noise_options =$et_heart_noise; //心脏杂音|radio|1=>无,2=>有
		$this->view->heart_noise_current = $et_organ->heart_noise;//心脏杂音|radio|1=>无,2=>有
		$this->view->heart_noise_info = $et_organ->heart_noise_info;//心脏杂音|text
		/**
		 * 表注释:腹部压痛|radio|1=>无,2=>有
		 * 
		 * 
		 **/

		$this->view->abdominal_tenderness_options =$et_abdominal_tenderness; //腹部压痛|radio|1=>无,2=>有
		$this->view->abdominal_tenderness_current = $et_organ->abdominal_tenderness;//腹部压痛|radio|1=>无,2=>有
		$this->view->abdominal_tenderness_info = $et_organ->abdominal_tenderness_info;//腹部压痛|text
		$this->view->abdominal_mass = $et_organ->abdominal_mass;//腹部包块|text
		$this->view->abdominal_mass_info = $et_organ->abdominal_mass_info;//腹部包块|text
		$this->view->abdominal_hepatomegaly = $et_organ->abdominal_hepatomegaly;//腹部肝大|text
		$this->view->abdominal_hepatomegaly_info = $et_organ->abdominal_hepatomegaly_info;//腹部肝大|text
		$this->view->abdominal_splenomegaly = $et_organ->abdominal_splenomegaly;//腹部脾大|text
		$this->view->abdominal_splenomegaly_info = $et_organ->abdominal_splenomegaly_info;//腹部脾大|text
		$this->view->shifting_dullness = $et_organ->shifting_dullness;//腹部移动性浊音|text
		$this->view->shifting_dullness_info = $et_organ->shifting_dullness_info;//腹部移动性浊音|text
		/**
		 * 表注释:下肢水肿|radio|1=>无,2=>单侧,3=>双侧不对称,4=>双侧对称
		 * 
		 * 
		 **/

		$this->view->ramus_inferior_edema_options =$et_ramus_inferior_edema; //下肢水肿|radio|1=>无,2=>单侧,3=>双侧不对称,4=>双侧对称
		$this->view->ramus_inferior_edema_current = array_search_for_other($et_organ->ramus_inferior_edema,$et_ramus_inferior_edema);//下肢水肿|radio|1=>无,2=>单侧,3=>双侧不对称,4=>双侧对称
		/**
		 * 表注释:足背动脉搏动|radio|1=>未触及,2=>触及双侧对称,3=>触及左侧弱或消失,4=>触及右侧弱或消失
		 * 
		 * 
		 **/

		$this->view->foot_arterial_pulse_options =$et_foot_arterial_pulse; //足背动脉搏动|radio|1=>未触及,2=>触及双侧对称,3=>触及左侧弱或消失,4=>触及右侧弱或消失
		$this->view->foot_arterial_pulse_current = array_search_for_other($et_organ->foot_arterial_pulse,$et_foot_arterial_pulse);//足背动脉搏动|radio|1=>未触及,2=>触及双侧对称,3=>触及左侧弱或消失,4=>触及右侧弱或消失
		/**
		 * 表注释:肛门指诊|radio|1=>未及异常,2=>触痛,3=>包块,4=>前列腺异常,5=>其他
		 * 
		 * 
		 **/

		$this->view->rectal_touch_options =$et_rectal_touch; //肛门指诊|radio|1=>未及异常,2=>触痛,3=>包块,4=>前列腺异常,5=>其他
		$this->view->rectal_touch_json = json_encode($et_rectal_touch);
		$this->view->rectal_touch_current = array_search_for_other($et_organ->rectal_touch,$et_rectal_touch);//肛门指诊|radio|1=>未及异常,2=>触痛,3=>包块,4=>前列腺异常,5=>其他
		$this->view->rectal_touch_other = $et_organ->rectal_touch_other;//肛门指诊其它|text
		/**
		 * 表注释:乳腺|radio|1=>未见异常,2=>乳房切除,3=>异常泌乳,4=>乳腺包块,5=>其他
		 * 
		 * 
		 **/

		$this->view->mammary_gland_options =$et_mammary_gland; //乳腺|radio|1=>未见异常,2=>乳房切除,3=>异常泌乳,4=>乳腺包块,5=>其他
		$this->view->mammary_gland_json = json_encode($et_mammary_gland);
		$mammary_gland_arr= @explode('|',$et_organ->mammary_gland);//乳腺|radio|1=>未见异常,2=>乳房切除,3=>异常泌乳,4=>乳腺包块,5=>其他
		$mammary_gland_array=array();//乳腺
		foreach ($mammary_gland_arr as $mammary_gland_val){
			$mammary_gland_array[]= array_search_for_other($mammary_gland_val,$et_mammary_gland);
		}
		$this->view->mammary_gland_current =$mammary_gland_array;//乳腺|radio|1=>未见异常,2=>乳房切除,3=>异常泌乳,4=>乳腺包块,5=>其他

		$this->view->mammary_gland_other = $et_organ->mammary_gland_other;//乳腺其它|text
		/**
		 * 表注释:妇科外阴|radio|1=>未见异常,2=>异常
		 * 
		 * 
		 **/

		$this->view->gynae_vulva_options =$et_gynae_vulva; //妇科外阴|radio|1=>未见异常,2=>异常
		$this->view->gynae_vulva_current = $et_organ->gynae_vulva;//妇科外阴|radio|1=>未见异常,2=>异常
		$this->view->gynae_vulva_exception = $et_organ->gynae_vulva_exception;//妇科外阴异常|text
		/**
		 * 表注释:妇科阴道|radio|1=>未见异常,2=>异常
		 * 
		 * 
		 **/

		$this->view->gynae_cunt_options =$et_gynae_cunt; //妇科阴道|radio|1=>未见异常,2=>异常
		$this->view->gynae_cunt_current = $et_organ->gynae_cunt;//妇科阴道|radio|1=>未见异常,2=>异常
		$this->view->gynae_cunt_exception = $et_organ->gynae_cunt_exception;//妇科阴道异常|text
		/**
		 * 表注释:妇科宫颈|radio|1=>未见异常,2=>异常
		 * 
		 * 
		 **/

		$this->view->gynae_cervix_options =$et_gynae_cervix; //妇科宫颈|radio|1=>未见异常,2=>异常
		$this->view->gynae_cervix_current = $et_organ->gynae_cervix;//妇科宫颈|radio|1=>未见异常,2=>异常
		$this->view->gynae_cervix_exception = $et_organ->gynae_cervix_exception;//妇科宫颈异常|text
		/**
		 * 表注释:妇科宫体|radio|1=>未见异常,2=>异常
		 * 
		 * 
		 **/

		$this->view->gynae_uterus_options =$et_gynae_uterus; //妇科宫体|radio|1=>未见异常,2=>异常
		$this->view->gynae_uterus_current = $et_organ->gynae_uterus;//妇科宫体|radio|1=>未见异常,2=>异常
		$this->view->gynae_uterus_exception = $et_organ->gynae_uterus_exception;//妇科宫体异常|text
		/**
		 * 表注释:妇科附件|radio|1=>未见异常,2=>异常
		 * 
		 * 
		 **/

		$this->view->gynae_appendix_options =$et_gynae_appendix; //妇科附件|radio|1=>未见异常,2=>异常
		$this->view->gynae_appendix_current = $et_organ->gynae_appendix;//妇科附件|radio|1=>未见异常,2=>异常
		$this->view->gynae_appendix_exception = $et_organ->gynae_appendix_exception;//妇科附件异常|text
		$this->view->others = $et_organ->others;//其它|text


		$et_examination=new Tet_examination();//辅助检查
		$et_examination->whereAdd("examination_id='{$uuid}'");
		$et_examination->find();
		$et_examination->fetch();
		$this->view->fbglucoseh = $et_examination->fbglucoseh;//空腹血糖1
		$this->view->fbglucosee = $et_examination->fbglucosee;//空腹血糖2
		$this->view->hemoglobin = $et_examination->hemoglobin;//血常规血红蛋白
		$this->view->leukocyte = $et_examination->leukocyte;//血常规白细胞
		$this->view->platelet = $et_examination->platelet;//血常规血小板
		$this->view->b_other = $et_examination->b_other;//血常规其他
		$this->view->u_protein = $et_examination->u_protein;//尿常规尿蛋白
		$this->view->urine = $et_examination->urine;//尿常规尿糖
		$this->view->ketone = $et_examination->ketone;//尿常规尿酮体
		$this->view->uoblood = $et_examination->uoblood;//尿常规尿潜血
		$this->view->u_other = $et_examination->u_other;//尿常规其他
		$this->view->microurine = $et_examination->microurine;//尿微量白蛋白
		/**
		 * 表注释:大便潜血|radio|1=>阴性|2=>阳性
		 * 
		 * 
		 **/

		$this->view->fecalblood_options =$et_fecalblood; //大便潜血|radio|1=>阴性|2=>阳性
		$this->view->fecalblood_current = $et_examination->fecalblood;//大便潜血|radio|1=>阴性|2=>阳性
		$this->view->alanine = $et_examination->alanine;//肝功能血清谷丙转氨酶
		$this->view->serum = $et_examination->serum;//肝功能血清谷丙转草氨酶
		$this->view->albumin = $et_examination->albumin;//肝功能白蛋白
		$this->view->tbilirubin = $et_examination->tbilirubin;//肝功能总胆红素
		$this->view->bilirubin = $et_examination->bilirubin;//肝功能结合总胆红素
		$this->view->screatinine = $et_examination->screatinine;//肾功能血清肌酐
		$this->view->bun = $et_examination->bun;//肾功能血清肌酐
		$this->view->serumpc = $et_examination->serumpc;//肾功能血钾浓度
		$this->view->sodium = $et_examination->sodium;//肾功能血钠浓度
		$this->view->tcholesterol = $et_examination->tcholesterol;//血脂总胆固醇
		$this->view->triglyceride = $et_examination->triglyceride;//血脂甘油三脂
		$this->view->lowcholesterol = $et_examination->lowcholesterol;//血脂血清低密度脂蛋白胆固醇
		$this->view->highcholesterol = $et_examination->highcholesterol;//血脂血清高密度脂蛋白胆固醇
		$this->view->ghemoglobin = $et_examination->ghemoglobin;//糖化血红蛋白
		/**
		 * 表注释:乙型肝炎表面抗原|radio|1=>阳性|2=>阴性
		 * 
		 * 
		 **/

		$this->view->hbsurface_options =$et_hbsurface; //乙型肝炎表面抗原|radio|1=>阳性|2=>阴性
		$this->view->hbsurface_current = array_search_for_other($et_examination->hbsurface,$et_hbsurface);//乙型肝炎表面抗原|radio|1=>阳性|2=>阴性
		/**
		 * 表注释:眼底|radio|1=>正常|2=>异常
		 * 
		 * 
		 **/

		$this->view->fundus_options =$et_fundus; //眼底|radio|1=>正常|2=>异常
		$this->view->fundus_current = $et_examination->fundus;//眼底|radio|1=>正常|2=>异常
		$this->view->veryfundus = $et_examination->veryfundus;//眼底异常名称
		/**
		 * 表注释:心电图|radio|1=>正常|2=>异常
		 * 
		 * 
		 **/

		$this->view->ecg_options =$et_ecg; //心电图|radio|1=>正常|2=>异常
		$this->view->ecg_current = $et_examination->ecg;//心电图|radio|1=>正常|2=>异常
		$this->view->veryecg = $et_examination->veryecg;//心电图异常名称
		/**
		 * 表注释:胸部x线片|radio|1=>正常|2=>异常
		 * 
		 * 
		 **/

		$this->view->xrayfilm_options =$et_xrayfilm; //胸部x线片|radio|1=>正常|2=>异常
		$this->view->xrayfilm_current = $et_examination->xrayfilm;//胸部x线片|radio|1=>正常|2=>异常
		$this->view->veryxrayfilm = $et_examination->veryxrayfilm;//胸部x线片异常 名称
		/**
		 * 表注释:B超|radio|1=>正常|2=>异常
		 * 
		 * 
		 **/

		$this->view->bc_options =$et_bc; //B超|radio|1=>正常|2=>异常
		$this->view->bc_current = $et_examination->bc;//B超|radio|1=>正常|2=>异常
		$this->view->verybc = $et_examination->verybc;//B超x线片异常名称
		/**
		 * 表注释:宫颈涂片|radio|1=>正常|2=>异常
		 * 
		 * 
		 **/

		$this->view->csmear_options =$et_csmear; //宫颈涂片|radio|1=>正常|2=>异常
		$this->view->csmear_current = $et_examination->csmear;//宫颈涂片|radio|1=>正常|2=>异常
		$this->view->verycsmear = $et_examination->verycsmear;//宫颈涂片异常名称
		$this->view->examination_other = $et_examination->examination_other;//其它

		$et_identification=new Tet_identification();//中医体质辨识
		$et_identification->whereAdd("examination_id='{$uuid}'");
		$et_identification->find();
		$et_identification->fetch();

		$this->view->physical_medicine_name_options =$physical_medicine_name; //中医生体质名字|checkbox|1=>平和质,2=>气虚质,3=>阳虚质,4=>阴虚质,5=>痰湿质,6=>湿热质,7=>血瘀质,8=>气郁质,9=>特秉质
		$this->view->physical_medicine_name_current = $et_identification->physical_medicine_name;//中医生体质名字|checkbox|1=>平和质,2=>气虚质,3=>阳虚质,4=>阴虚质,5=>痰湿质,6=>湿热质,7=>血瘀质,8=>气郁质,9=>特秉质

		/**
		 * 表注释:中医生体质值|radio|1=>是,2=>倾向是
		 * 
		 * 
		 **/
		$this->view->physical_medicine_val_options =$et_physical_medicine_val; //中医生体质值|radio|1=>是,2=>倾向是
		$physical_medicine_val_arr=@explode('|',$et_identification->physical_medicine_val);
		$physical_medicine_val_array=array();
		$j=1;
		foreach ($physical_medicine_val_arr as $physical_medicine_val){
			$physical_medicine_val_array[$j]=array_search_for_other($physical_medicine_val,$et_physical_medicine_val);
			$j++;
		}
		$this->view->physical_medicine_val = $physical_medicine_val_array;//中医生体质值|radio|1=>是,2=>倾向是
		//print_r($physical_medicine_val_array);

		$et_mhealth=new Tet_mhealth();//现存主要健康问题
		$et_mhealth->whereAdd("examination_id='{$uuid}'");
		$et_mhealth->find();
		$et_mhealth->fetch();
		$this->view->ceredisease = $et_mhealth->ceredisease;//脑血管疾病
		/**
		 * 表注释:脑血管疾病状态|checkbox|1=>未发现|2=>缺血性卒中|3=>脑出血|4=>蛛网膜下腔出血|5=>短暂性脑缺血|6=>其他
		 * 
		 * 
		 **/

		$this->view->ceredisease_status_options =$et_ceredisease_status; //脑血管疾病状态|checkbox|1=>未发现|2=>缺血性卒中|3=>脑出血|4=>蛛网膜下腔出血|5=>短暂性脑缺血|6=>其他
		$this->view->ceredisease_status_json    = json_encode($et_ceredisease_status);
		$ceredisease_status_arr=@explode('|',trim($et_mhealth->ceredisease_status,'|'));
		$ceredisease_status_array=array();
		$j=0;
		foreach ($ceredisease_status_arr as $ceredisease_status_val){
			$ceredisease_status_array[$j]=array_search_for_other($ceredisease_status_val,$et_ceredisease_status);
			$j++;
		}
		$this->view->ceredisease_status_current = $ceredisease_status_array;//脑血管疾病状态|checkbox|1=>未发现|2=>缺血性卒中|3=>脑出血|4=>蛛网膜下腔出血|5=>短暂性脑缺血|6=>其他
		$this->view->ceredisease_other = $et_mhealth->ceredisease_other;//其他脑血管疾病中文含义
		$this->view->kidneydisease = $et_mhealth->kidneydisease;//肾脏疾病
		/**
		 * 表注释:肾脏疾病状态|checkbox|1=>未发现|2=>糖尿病肾病|3=>肾功能衰竭|4=>急性肾炎|5=>慢性肾炎|6=>其他
		 * 
		 * 
		 **/

		$this->view->kidneydisease_status_options =$et_kidneydisease_status; //肾脏疾病状态|checkbox|1=>未发现|2=>糖尿病肾病|3=>肾功能衰竭|4=>急性肾炎|5=>慢性肾炎|6=>其他
		$this->view->kidneydisease_status_json    = json_encode($et_kidneydisease_status);
		$kidneydisease_status_arr=@explode('|',$et_mhealth->kidneydisease_status);
		$kidneydisease_status_array=array();
		$j=0;
		foreach ($kidneydisease_status_arr as $kidneydisease_status_val){
			$kidneydisease_status_array[$j]=array_search_for_other($kidneydisease_status_val,$et_kidneydisease_status);
			$j++;
		}
		$this->view->kidneydisease_status_current = $kidneydisease_status_array;//肾脏疾病状态|checkbox|1=>未发现|2=>糖尿病肾病|3=>肾功能衰竭|4=>急性肾炎|5=>慢性肾炎|6=>其他
		$this->view->kidneydisease_other = $et_mhealth->kidneydisease_other;//其他肾脏疾病中文含义
		$this->view->heartdisease = $et_mhealth->heartdisease;//心脏疾病
		/**
		 * 表注释:心脏疾病状态|checkbox|1=>未发现|2=>心肌梗死|3=>心绞痛|4=>冠状动脉血运重建|5=>充血性心力衰竭|6=>心前区疼痛|7=>其他
		 * 
		 * 
		 **/

		$this->view->heartdisease_status_options =$et_heartdisease_status; //心脏疾病状态|checkbox|1=>未发现|2=>心肌梗死|3=>心绞痛|4=>冠状动脉血运重建|5=>充血性心力衰竭|6=>心前区疼痛|7=>其他
		$this->view->heartdisease_status_json    = json_encode($et_heartdisease_status);
		$heartdisease_status_arr=@explode('|',$et_mhealth->heartdisease_status);
		$heartdisease_status_array=array();
		$j=0;
		foreach ($heartdisease_status_arr as $heartdisease_status_val){
			$heartdisease_status_array[$j]=array_search_for_other($heartdisease_status_val,$et_heartdisease_status);
			$j++;
		}
		$this->view->heartdisease_status_current = $heartdisease_status_array;//心脏疾病状态|checkbox|1=>未发现|2=>心肌梗死|3=>心绞痛|4=>冠状动脉血运重建|5=>充血性心力衰竭|6=>心前区疼痛|7=>其他
		$this->view->heartdisease_other = $et_mhealth->heartdisease_other;//其他心脏疾病中文含义
		$this->view->vasculardisease = $et_mhealth->vasculardisease;//血管疾病
		/**
		 * 表注释:血管疾病状态|checkbox|1=>未发现|2=>夹层动脉瘤|3=>动脉闭塞性疾病|4=>其他
		 * 
		 * 
		 **/

		$this->view->vasculardisease_status_options =$et_vasculardisease_status; //血管疾病状态|checkbox|1=>未发现|2=>夹层动脉瘤|3=>动脉闭塞性疾病|4=>其他
		$this->view->vasculardisease_status_json    = json_encode($et_vasculardisease_status);
		$vasculardisease_arr=@explode('|',$et_mhealth->vasculardisease_status);
		$vasculardisease_array=array();
		$j=0;
		foreach ($vasculardisease_arr as $vasculardisease_val){
			$vasculardisease_array[$j]=array_search_for_other($vasculardisease_val,$et_vasculardisease_status);
			$j++;
		}
		$this->view->vasculardisease_status_current = $vasculardisease_array;//血管疾病状态|checkbox|1=>未发现|2=>夹层动脉瘤|3=>动脉闭塞性疾病|4=>其他
		$this->view->vasculardisease_other = $et_mhealth->vasculardisease_other;//其他血管疾病中文含义
		$this->view->eyedisease = $et_mhealth->eyedisease;//眼部疾病
		/**
		 * 表注释:眼部疾病状态|checkbox|1=>未发现|2=>视网膜出血或渗出|3=>视乳头水肿|4=>白内障|5=>其他
		 * 
		 * 
		 **/

		$this->view->eyedisease_status_options =$et_eyedisease_status; //眼部疾病状态|checkbox|1=>未发现|2=>视网膜出血或渗出|3=>视乳头水肿|4=>白内障|5=>其他
		$this->view->et_eyedisease_json    = json_encode($et_eyedisease_status);
		$eyedisease_status_arr=@explode('|',$et_mhealth->eyedisease_status);
		$eyedisease_status_array=array();
		$j=0;
		foreach ($eyedisease_status_arr as $eyedisease_status_val){
			$eyedisease_status_array[$j]=array_search_for_other($eyedisease_status_val,$et_eyedisease_status);
			$j++;
		}
		$this->view->eyedisease_status_current = $eyedisease_status_array;//眼部疾病状态|checkbox|1=>未发现|2=>视网膜出血或渗出|3=>视乳头水肿|4=>白内障|5=>其他
		$this->view->eyedisease_other = $et_mhealth->eyedisease_other;//其他眼部疾病中文含义
		$this->view->nervousdisease = $et_mhealth->nervousdisease;//神经系统疾病
		/**
		 * 表注释:神经系统疾病状态|checkbox|1=>未发现|2=>有
		 * 
		 * 
		 **/

		$this->view->nervousdisease_status_options =$et_nervousdisease_status; //神经系统疾病状态|checkbox|1=>未发现|2=>有
		$this->view->nervousdisease_status_current = $et_mhealth->nervousdisease_status;//神经系统疾病状态|checkbox|1=>未发现|2=>有
		$this->view->nervousdisease_other = $et_mhealth->nervousdisease_other;//有的神经系统疾病中文含义
		$this->view->otherdisease = $et_mhealth->otherdisease;//其他系统疾病
		/**
		 * 表注释:其他系统疾病状态|checkbox|1=>未发现|2=>有
		 * 
		 * 
		 **/

		$this->view->otherdisease_status_options =$et_otherdisease_status; //其他系统疾病状态|checkbox|1=>未发现|2=>有
		$this->view->otherdisease_status_current = $et_mhealth->otherdisease_status;//其他系统疾病状态|checkbox|1=>未发现|2=>有
		$this->view->otherdisease_other = $et_mhealth->otherdisease_other;//有的其他系统疾病中文含义

		$et_hospitalization_history=new Tet_hospitalization_history();//住院史
		$et_hospitalization_history->whereAdd("examination_id='{$uuid}'");
		$et_hospitalization_history->find();
		$et_hospitalization_array=array();
		$i=0;
		while ($et_hospitalization_history->fetch())
		{
			$et_hospitalization_array[$i]['be_hospitalized_time']=adodb_date("Y-m-d",$et_hospitalization_history->be_hospitalized_time);//入院日期
			$et_hospitalization_array[$i]['leave_hospital_time']=adodb_date("Y-m-d",$et_hospitalization_history->leave_hospital_time);//出院日期
			$et_hospitalization_array[$i]['reason']=$et_hospitalization_history->reason;//原因
			$et_hospitalization_array[$i]['organization']=$et_hospitalization_history->organization;//医疗机构名
			$et_hospitalization_array[$i]['record_no']=$et_hospitalization_history->record_no;//病案号
			$i++;
		}
		$this->view->et_hospitalization_array = $et_hospitalization_array;

		$et_operation_history=new Tet_operation_history();//病床史
		$et_operation_history->whereAdd("examination_id='{$uuid}'");
		$et_operation_history->find();
		$et_operation_array=array();
		$i=0;
		while($et_operation_history->fetch())
		{
			$et_operation_array[$i]['put_bed_time']=adodb_date("Y-m-d",$et_operation_history->put_bed_time);//建床日期
			$et_operation_array[$i]['receive_bed_time']=adodb_date("Y-m-d",$et_operation_history->receive_bed_time);//撤床日期
			$et_operation_array[$i]['reason']=$et_operation_history->reason;//原因
			$et_operation_array[$i]['organization']=$et_operation_history->organization;//医疗机构名
			$et_operation_array[$i]['record_no']=$et_operation_history->record_no;//病案号
			$i++;
		}
		$this->view->et_operation_array = $et_operation_array;


		$et_main_drug_use=new Tet_main_drug_use();//主要用药情况
		$et_main_drug_use->whereAdd("examination_id='{$uuid}'");
		$et_main_drug_use->find();
		$et_main_drug_array=array();
		$i=0;
		while ($et_main_drug_use->fetch())
		{
			$et_main_drug_array[$i]['drug_name']=$et_main_drug_use->drug_name;//药物名称
			$et_main_drug_array[$i]['drug_usage']=$et_main_drug_use->drug_usage;//用法
			$et_main_drug_array[$i]['drug_dosage']=$et_main_drug_use->drug_dosage;//用量
			$et_main_drug_array[$i]['drug_time']=$et_main_drug_use->drug_time;//用药时间
			$et_main_drug_array[$i]['drug_compliance']=array_search_for_other($et_main_drug_use->drug_compliance,$et_drug_compliance);//服药依从性|radio|1=>规律,2=>间断,3=>不服药
			$i++;
		}
		$this->view->et_main_drug_array = $et_main_drug_array;
		$this->view->drug_compliance_options = $et_drug_compliance;

		$et_nonepi_vaccination=new Tet_nonepi_vaccination();//非免疫规划预防接种史
		$et_nonepi_vaccination->whereAdd("examination_id='{$uuid}'");
		$et_nonepi_vaccination->find();
		$et_nonepi_array=array();
		$i=0;
		while ($et_nonepi_vaccination->fetch())
		{
			$et_nonepi_array[$i]['vaccination_name']=$et_nonepi_vaccination->vaccination_name;//名称
			$et_nonepi_array[$i]['vaccination_time']=adodb_date("Y-m-d",$et_nonepi_vaccination->vaccination_time);//接种日期
			$et_nonepi_array[$i]['vaccination_org']=$et_nonepi_vaccination->vaccination_org;//接种机构
			$i++;
		}
		$this->view->et_nonepi_array = $et_nonepi_array;

		$et_health_assessment1=new Tet_health_assessment();//健康评价
		$et_health_assessment1->whereAdd("examination_id='{$uuid}'");
		$et_health_assessment1->find();
		$et_health_assessment1->fetch();
		/**
		 * 表注释:健康评价|radio|1=>体检无异常,2=>有异常
		 * 
		 * 
		 **/
        //var_dump($et_health_assessment1);
		$this->view->health_evaluation_assessment_options = $et_health_evaluation; //健康评价|radio|1=>体检无异常,2=>有异常
		//print_r($et_health_evaluation);
		$this->view->health_evaluation_assessment_current = array_search_for_other($et_health_assessment1->health_assessment,$et_health_evaluation);//健康评价|radio|1=>体检无异常,2=>有异常
		$this->view->health_evaluation_exception = explode('|',$et_health_assessment1->health_exception);//健康异常
		// echo  $et_health_assessment1->health_assessment;
		$et_health_guidance=new Tet_health_guidance();//健康指导
		$et_health_guidance->whereAdd("examination_id='{$uuid}'");
		$et_health_guidance->find();
		$et_health_guidance->fetch();
		/**
		 * 表注释:健康指导|radio|1=>定期随访,2=>纳入慢性病患者健康管理,3=>建议复查,4=>建议转诊
		 * 
		 * 
		 **/

		$this->view->health_assessment_options =$et_health_assessment; //健康指导|radio|1=>定期随访,2=>纳入慢性病患者健康管理,3=>建议复查,4=>建议转诊

		$et_health_guidance_arr=@explode('|',$et_health_guidance->health_assessment);//健康指导|radio|1=>定期随访,2=>纳入慢性病患者健康管理,3=>建议复查,4=>建议转诊
		$et_health_guidance_arrray=array();//存放症状
		foreach ($et_health_guidance_arr as $et_health_guidance_val){
			$et_health_guidance_arrray[]=array_search_for_other($et_health_guidance_val,$et_health_assessment);
		}
		$this->view->health_assessment_current = $et_health_guidance_arrray;//健康指导|radio|1=>定期随访,2=>纳入慢性病患者健康管理,3=>建议复查,4=>建议转诊
		//var_dump($et_health_guidance_arrray);
		/**
		 * 表注释:危险因素控制|radio|1=>戒烟,2=>健康饮酒,3=>饮食,4=>锻炼,5=>减体重,6=>建议疫苗接种,7=>其它
		 * 
		 * 
		 **/

		$this->view->risk_factor_col_options =$et_risk_factor_col; //危险因素控制|radio|1=>戒烟,2=>健康饮酒,3=>饮食,4=>锻炼,5=>减体重,6=>建议疫苗接种,7=>其它
		//json
		$this->view->risk_factor_col_json =json_encode($et_risk_factor_col);
		$this->view->risk_factor_col_current = $et_health_guidance->risk_factor_col;//危险因素控制|radio|1=>戒烟,2=>健康饮酒,3=>饮食,4=>锻炼,5=>减体重,6=>建议疫苗接种,7=>其它
		$risk_factor_col_arr=@explode('|',$et_health_guidance->risk_factor_col);
		$risk_factor_col_arrray=array();//危险因素
		foreach ($risk_factor_col_arr as $risk_factor_col_val){
			$temp="";
			$temp=array_search_for_other($risk_factor_col_val,$et_risk_factor_col);
			$risk_factor_col_arrray[]=$temp;
			switch ($temp)
			{
				case "5":
					{
						//减体重文本激活标志
						$this->view->lose_weight_sign = 1;
						break;
					}
				case "6":
					{
						$this->view->recommended_vaccination_sign = 1;
						break;
					}
				case "7":
					{
						$this->view->risk_factor_col_other_sign = 1;
						break;
					}
				default:
					{
						break;
					}

			}
		}
		$this->view->risk_factor_col_arrray = $risk_factor_col_arrray;
		$this->view->lose_weight = $et_health_guidance->lose_weight;//减体重
		$this->view->recommended_vaccination = $et_health_guidance->recommended_vaccination;//建议疫苗接种
		$this->view->risk_factor_col_other = $et_health_guidance->risk_factor_col_other;//其他

		$this->view->display("experience_table.html");
	}
	/**
	 * 添加、修改程序
	 *
	 */
	public function updateAction(){
		if(!$this->haveWritePrivilege){
			$url=array("健康体验表列表"=>__BASEPATH.'et/index/index',"用户列表"=>__BASEPATH.'iha/index/index');
			message("对不起，你可能没有权限修改本信息，错误代码：et010",$url);
		}
		$uuid =$this->_request->getParam('uuid','');//编号
		$time=time();//系统日期
		$staff_id=$this->user['uuid'];//填表医生ID
		$individual_session=new Zend_Session_Namespace("individual_core");
		$serial_number=$this->_request->getParam('id');//个人档案号
		if(empty($uuid)){
			if(empty($individual_session->uuid)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			$org_id=$this->user['org_id'];//机构ID
			$examination_id=uniqid('et',true);//档案编号
		}else{
			$examination_id=$uuid;
			
		}
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
        
		$update_token=false;//更新标识
		//健康体检表主表
		$examination_table=new Texamination_table();
		//echo  $individual_session->standard_code_1;

		$year=$this->_request->getParam('examination_date_year');//年
		$month=$this->_request->getParam('examination_date_month');//月
		$day=$this->_request->getParam('examination_date_day');//日
		if(!empty($year)){
			$examination_table->examination_date = adodb_mktime(0,0,0,$month,$day,$year);//体检日期
		}
		$examination_table->examination_doctor = $this->_request->getParam('examination_doctor');//责任医生
		if(empty($uuid)){//添加
			$examination_table->created = $time;//添加记录时间
			$examination_table->uuid = $examination_id;//编号
			$examination_table->staff_id = $staff_id;//医生档案号
			$examination_table->id = $serial_number;//个人档案号
			$examination_table->serial_number = $individual_session->standard_code_1;//档案编号
			if($examination_table->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}else{//修改
			$examination_table->updated = $time;
			$examination_table->whereAdd("uuid='{$uuid}'");
			if($examination_table->update(array($this->user['uuid'],'updated'))){
				$update_token=true;//修改成功
			}
		}

		//症状 检查项目
		$et_symptom1 =new Tet_symptom();
		$symptom_arr=$this->_request->getParam('symptom');//症状
		$symptom_str='';
		foreach ($symptom_arr as $k=>$v){
			if(isset($et_symptom[$v][0])){
				$symptom_str.=$et_symptom[$v][0].'|';//症状|checkbox|1=>无症状,2=>头痛,3=>头晕,4=>心悸,5=>胸闷,6=>胸痛,7=>慢性咳嗽,8=>咳痰,9=>呼吸困难,10=>多饮,11=>多尿,12=>体重下降,13=>乏力,14=>关节肿痛,15=>视力模糊,16=>手脚麻木,17=>尿急,18=>尿痛,19=>便秘,20=>腹泻,21=>恶心呕吐,22=>眼花,23=>耳鸣,24=>乳房胀痛,25=>其他
				if ($et_symptom[$v][0]=='-99'){
					$et_symptom1->symptom_other = $this->_request->getParam('symptom_other');//症状其它内容|text
				}
			}
		}
		$et_symptom1->symptom = rtrim($symptom_str,'|');//症状|checkbox|1=>无症状,2=>头痛,3=>头晕,4=>心悸,5=>胸闷,6=>胸痛,7=>慢性咳嗽,8=>咳痰,9=>呼吸困难,10=>多饮,11=>多尿,12=>体重下降,13=>乏力,14=>关节肿痛,15=>视力模糊,16=>手脚麻木,17=>尿急,18=>尿痛,19=>便秘,20=>腹泻,21=>恶心呕吐,22=>眼花,23=>耳鸣,24=>乳房胀痛,25=>其他

		if(empty($uuid)){//添加
			$et_symptom1->created = $time;//添加记录时间
			$et_symptom1->uuid = $examination_id;//编号
			$et_symptom1->examination_id = $examination_id;//健康体检id
			$et_symptom1->staff_id = $staff_id;//医生档案号
			$et_symptom1->id = $serial_number;//个人档案号
			if($et_symptom1->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}else{//修改
			$et_symptom1->whereAdd("uuid='{$uuid}'");
			if($et_symptom1->update(array($this->user['uuid'],'updated'))){
				$update_token=true;//修改成功
			}
		}
		//一般检查
		$et_general_condition =new Tet_general_condition();
		$et_general_condition->temperature = $this->_request->getParam('temperature');//体温|text
		$et_general_condition->pulse = $this->_request->getParam('pulse');//脉搏|text
		$et_general_condition->breathing_rate = $this->_request->getParam('breathing_rate');//呼吸频率|text
		$et_general_condition->blood_pressure_left_s = $this->_request->getParam('blood_pressure_left_s');//血压左收缩压|text
		$et_general_condition->blood_pressure_left_p = $this->_request->getParam('blood_pressure_left_p');//血压左舒张压|text
		$et_general_condition->blood_pressure_right_s = $this->_request->getParam('blood_pressure_right_s');//血压右收缩压|text
		$et_general_condition->blood_pressure_right_p = $this->_request->getParam('blood_pressure_right_p');//血压右舒张压|text
		$et_general_condition->height = $this->_request->getParam('height');//身高|text
		$et_general_condition->weight = $this->_request->getParam('weight');//体重|text
		$et_general_condition->bmi = $this->_request->getParam('bmi');//体质指数|text
		$et_general_condition->waistline = $this->_request->getParam('waistline');//腰围|text
//		$et_general_condition->hipcircumference = $this->_request->getParam('hipcircumference');//臀围|text
//		$et_general_condition->whi = $this->_request->getParam('whi');//腰臀围比值|text
        foreach($elder_health_status as $k=>$v){
        	if($this->_request->getParam('elder_health_status')==$k){
        		$et_general_condition->elder_health_status = $v[0];//老年人健康状态自我评估
        	}
        }
        foreach ($elder_living_skills as $k=>$v){
        	if($this->_request->getParam('elder_living_skills')==$k){
               $et_general_condition->elder_living_skills  = $v[0];//老年人生活自理能力自我评估
        	}
        }
		foreach ($et_older_cognitive_functions as $k=>$v){
			if($this->_request->getParam('older_cognitive_functions')==$k){
				$et_general_condition->older_cognitive_functions = $v[0];//老年人认知功能|checkbox|1=>粗筛阴性,2=>粗筛阳性
			}
		}
		$et_general_condition->mmse = $this->_request->getParam('mmse');//智力状态检查总分|text
		foreach ($et_older_affective_state as $k=>$v){
			if($this->_request->getParam('older_affective_state')==$k){
				$et_general_condition->older_affective_state = $v[0];//老年人情感状态|checbox|1=>粗筛阴性,2=>粗筛阳性

			}
		}
		$et_general_condition->depression = $this->_request->getParam('depression');//老年人抑郁量表总分|text
		if(empty($uuid)){//添加
			$et_general_condition->created = $time;//添加记录时间
			$et_general_condition->uuid = $examination_id;//编号
			$et_general_condition->examination_id = $examination_id;//健康体检id
			$et_general_condition->staff_id = $staff_id;//医生档案号
			$et_general_condition->id = $serial_number;//个人档案号
			if($et_general_condition->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}else{//修改
			$et_general_condition->whereAdd("uuid='{$uuid}'");
			if($et_general_condition->update(array($this->user['uuid'],'updated'))){
				$update_token=true;//修改成功
			}
		}
		//生活方式
		$et_lifestyle =new Tet_lifestyle();
		$et_lifestyle->sport_frequence = array_code_change($this->_request->getParam('sport_frequence'),$et_sport_frequence);//锻炼频率|checkbox|1=>每天,2=>每周一次以上,3=>偶尔,4=>不锻炼
		$et_lifestyle->sport_time = $this->_request->getParam('sport_time');//每次锻炼时间(分钟)|text
		$et_lifestyle->exercise_duration = $this->_request->getParam('exercise_duration');//坚持锻炼时间(小时)|text
		$et_lifestyle->exercising_way = $this->_request->getParam('exercising_way');//锻炼方式|text

		//$et_lifestyle->food_habit = array_code_change($this->_request->getParam('food_habit'),$et_food_habit);//饮食习惯|checkbox|1=>荤素均衡,2=>荤食为主,3=>素食为主,4=>嗜盐,5=>嗜油,6=>嗜糖
		$food_habit=$this->_request->getParam("food_habit");//饮食习惯|checkbox|1=>荤素均衡,2=>荤食为主,3=>素食为主,4=>嗜盐,5=>嗜油,6=>嗜糖
		$food_habit_str="";
		foreach ($food_habit as $k=>$v)
		{
			if(isset($et_food_habit[$v][0]))
			{
				$food_habit_str.=$et_food_habit[$v][0].'|';
			}
		}
		$et_lifestyle->food_habit=rtrim($food_habit_str,'|');
		
		$et_lifestyle->smoke =array_code_change( $this->_request->getParam('smoke'),$et_smoke);
		//echo $this->_request->getParam('smoke_quantity');
		$et_lifestyle->smoke_quantity = $this->_request->getParam('smoke_quantity');//日吸烟量(支)|text
		$et_lifestyle->begin_smoke_age = $this->_request->getParam('begin_smoke_age');//开始吸烟年龄(岁)|text
		$et_lifestyle->stop_smoke_age = $this->_request->getParam('stop_smoke_age');//戒烟年龄(岁)|text

		$et_lifestyle->drink_frequency = array_code_change($this->_request->getParam('drink_frequency'),$et_drink_frequency);
		$et_lifestyle->drink_quantity = $this->_request->getParam('drink_quantity');//日饮酒量(两)|text
		foreach ($et_drink as $k=>$v){
			if($this->_request->getParam('drink')==$k){
				$et_lifestyle->drink = $this->_request->getParam('drink');//是否戒酒|radio|1=>未戒酒,2=>已戒酒
				if($k==2){
					$et_lifestyle->stop_drinking_age = $this->_request->getParam('stop_drinking_age');//戒酒年龄|text
				}
			}
		}
		$et_lifestyle->begin_drinking_age = $this->_request->getParam('begin_drinking_age');//开始饮酒年龄|text
		foreach ($et_last_year_ntoxication as $k=>$v){
			if($this->_request->getParam('last_year_ntoxication')==$k){
				$et_lifestyle->last_year_ntoxication = $v[0];//近一年内是否曾醉酒|radio|1=>是,2=>否
			}
		}
		$drink_style_arr=$this->_request->getParam('drink_style');//饮酒种类|checkbox|1=>白酒,2=>啤酒,3=>红酒,4=>黄酒,5=>其他
		$drink_style_str = '';
		if(!empty($drink_style_arr)){
			foreach ($drink_style_arr as $k=>$v){
				if(isset($et_drink_style[$v][0])){
					$drink_style_str.= $et_drink_style[$v][0].'|';//饮酒种类|checkbox|1=>白酒,2=>啤酒,3=>红酒,4=>黄酒,5=>其他
					if ($et_drink_style[$v][0]=='-99'){
						$et_lifestyle->drink_style_other = $this->_request->getParam('drink_style_other');//其它饮酒种类|text
					}
				}
			}
		}
		$et_lifestyle->drink_style = rtrim($drink_style_str,'|');
		$et_lifestyle->occupational_exposure = $this->_request->getParam('occupation_status');//职业暴露|radio|1=>无,2=>有
		$et_lifestyle->occupation = $this->_request->getParam('occupation');//具体职业|text
		$et_lifestyle->occupation_age = $this->_request->getParam('occupation_age');//从业时间(年)|text
		$et_lifestyle->chemistry = $this->_request->getParam('chemistry');//毒物种类化学品|text
		$et_lifestyle->chemistry_protection = $this->_request->getParam('chemistry_protection');//毒物种类化学品防护措施|radio|1=>无,2=>有
		$et_lifestyle->chemistry_protection_info = $this->_request->getParam('chemistry_protection_info');//毒物种类化学品防护措施|text
		$et_lifestyle->pest = $this->_request->getParam('pest');//毒物种类毒物|text
		$et_lifestyle->pest_protection = $this->_request->getParam('pest_protection');//毒物种类防护毒物措施|radio|1=>无,2=>有
		$et_lifestyle->pest_protection_info = $this->_request->getParam('pest_protection_info');//毒物种类毒物防护措施|text
		$et_lifestyle->ray = $this->_request->getParam('ray');//毒物种类射线|text
		$et_lifestyle->ray_protection = $this->_request->getParam('ray_protection');//毒物种类防护射线措施|radio|1=>无,2=>有
		$et_lifestyle->ray_protection_info = $this->_request->getParam('ray_protection_info');//毒物种类射线|text
		//职业病危害粉尘
		$et_lifestyle->dust                    = $this->_request->getParam('dust');
		$et_lifestyle->dust_protection         = $this->_request->getParam('dust_protection');
		$et_lifestyle->dust_protection_info    = $this->_request->getParam('dust_protection_info');
		//职业病危害物理因素
		$et_lifestyle->physical                = $this->_request->getParam('physical');
		$et_lifestyle->physical_protection     = $this->_request->getParam('physical_protection');
		$et_lifestyle->physical_protection_info= $this->_request->getParam('physical_protection_info');
		//职业病危害其他因素
		$et_lifestyle->other_types             = $this->_request->getParam('other_types');
		$et_lifestyle->other_types_protection  = $this->_request->getParam('other_types_protection');
		$et_lifestyle->other_types_info        = $this->_request->getParam('other_types_info');
		if(empty($uuid)){//添加
			$et_lifestyle->created = $time;//添加记录时间
			$et_lifestyle->uuid = $examination_id;//编号
			$et_lifestyle->examination_id = $examination_id;//健康体检id
			$et_lifestyle->staff_id = $staff_id;//医生档案号
			$et_lifestyle->id = $serial_number;//个人档案号
			if($et_lifestyle->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}else{//修改
			$et_lifestyle->whereAdd("uuid='{$uuid}'");
			if($et_lifestyle->update(array($this->user['uuid'],'updated'))){
				$update_token=true;//修改成功
			}
		}
		//脏器功能查体
		$et_organ =new Tet_organ();
		foreach ($et_lips as $k=>$v){
			if($this->_request->getParam('lips')==$k){
				$et_organ->lips = $v[0];//口腔 口唇|radio|1=>红润,2=>苍白,3=>发干,4=>皲裂,5=>疱疹
			}
		}
		$et_organ->dentition = $this->_request->getParam('dentition');//口腔 齿列正常|text
		$et_organ->dentition_missing_teeth = @implode('|',$this->_request->getParam('dentition_missing_teeth'));//口腔 齿列缺齿|text
		$et_organ->dentition_decayed_tooth = @implode('|',$this->_request->getParam('dentition_decayed_tooth'));//口腔齿列龋齿|text
		$et_organ->dentition_false_tooth = @implode('|',$this->_request->getParam('dentition_false_tooth'));//口腔齿列义齿(假牙)|text
		$et_organ->pharyngeal_portion =array_code_change($this->_request->getParam('pharyngeal_portion'),$et_pharyngeal_portion);
		$et_organ->left_eye = $this->_request->getParam('left_eye');//视力左眼|text
		$et_organ->left_eye_corrected_vision = $this->_request->getParam('left_eye_corrected_vision');//视力左眼矫正视力|text
		$et_organ->right_eye = $this->_request->getParam('right_eye');//视力右眼|text
		$et_organ->right_eye_corrected_vision = $this->_request->getParam('right_eye_corrected_vision');//视力右眼矫正视力|text
		$et_organ->hearing =array_code_change($this->_request->getParam('hearing'),$et_hearing);
		$et_organ->energizing_function =array_code_change($this->_request->getParam('energizing_function'),$et_energizing_function);
		foreach ($et_skin as $k=>$v){
			if($this->_request->getParam('skin')==$k){
				$et_organ->skin = $v[0];//皮肤|radio|1=>正常,2=>潮红,3=>苍白,4=>发绀,5=>黄染,6=>色素沉着,7=>其他
				if($v[0]=='-99'){
					$et_organ->skin_other = $this->_request->getParam('skin_other');//皮肤其它|text
				}
			}
		}
		foreach ($et_sclera as $k=>$v){
			if($this->_request->getParam('sclera')==$k){
				$et_organ->sclera = $v[0];//巩膜|radio|1=>正常,2=>黄染,3=>充血,4=>其他
				if($v[0]=='-99'){
					$et_organ->sclera_other = $this->_request->getParam('sclera_other');//巩膜其它|text
				}
			}
		}
		foreach ($et_lymph_node as $k=>$v){
			if($this->_request->getParam('lymph_node')==$k){
				$et_organ->lymph_node = $v[0];//淋巴结|radio|1=>未触及,2=>锁骨上,3=>腋窝,4=>其他
				if($v[0]=='-99'){
					$et_organ->lymph_node_other = $this->_request->getParam('lymph_node_other');//淋巴结其它|text
				}
			}
		}
		foreach ($et_lung_barrel_chest as $k=>$v){
			if($this->_request->getParam('lung_barrel_chest')==$k){
				$et_organ->lung_barrel_chest = $v[0];//肺桶状胸|radio|1=>否,2=>是
			}
		}
		foreach ($et_lung_sounds as $k=>$v){
			if($this->_request->getParam('lung_sounds')==$k){
				$et_organ->lung_sounds = $this->_request->getParam('lung_sounds');//肺呼吸音|radio|1=>正常,2=>异常
				$et_organ->lung_sounds_exception = $this->_request->getParam('lung_sounds_exception');//肺呼吸音异常|text
			}
		}
		foreach ($et_lung_rale as $k=>$v){
			if($this->_request->getParam('lung_rale')==$k){
				$et_organ->lung_rale = $v[0];//肺罗音|radio|1=>无,2=>干罗音,3=>湿罗音,4=>其他
				if($v[0]=='-99'){
					$et_organ->lung_rale_other = $this->_request->getParam('lung_rale_other');//肺罗音其它|text
				}
			}
		}
		$et_organ->heart_rate = $this->_request->getParam('heart_rate');//心率(次/分钟)|text
		foreach ($et_heart_rhythm as $k=>$v){
			if($this->_request->getParam('heart_rhythm')==$k){
				$et_organ->heart_rhythm = $v[0];//心律|radio|1=>齐,2=>不齐,3=>绝对不齐
			}
		}
		foreach ($et_heart_noise as $k=>$v){
			if($this->_request->getParam('heart_noise')==$k){
				$et_organ->heart_noise = $this->_request->getParam('heart_noise');//心脏杂音|radio|1=>无,2=>有
				$et_organ->heart_noise_info = $this->_request->getParam('heart_noise_info');//心脏杂音|text
			}
		}
		foreach ($et_abdominal_tenderness as $k=>$v){
			if($this->_request->getParam('abdominal_tenderness')==$k){
				$et_organ->abdominal_tenderness = $v[0];//腹部压痛|radio|1=>无,2=>有
				$et_organ->abdominal_tenderness_info = $this->_request->getParam('abdominal_tenderness_info');//腹部压痛|text
			}
		}
		foreach ($et_abdominal_tenderness as $k=>$v){
			if($this->_request->getParam('abdominal_mass')==$k){
				$et_organ->abdominal_mass = $v[0];//腹部包块|text
				$et_organ->abdominal_mass_info = $this->_request->getParam('abdominal_mass_info');//腹部包块|text
			}
		}
		foreach ($et_abdominal_tenderness as $k=>$v){
			if($this->_request->getParam('abdominal_hepatomegaly')==$k){
				$et_organ->abdominal_hepatomegaly = $v[0];//腹部肝大|text
				$et_organ->abdominal_hepatomegaly_info = $this->_request->getParam('abdominal_hepatomegaly_info');//腹部肝大|text
			}
		}
		foreach ($et_abdominal_tenderness as $k=>$v){
			if($this->_request->getParam('abdominal_splenomegaly')==$k){
				$et_organ->abdominal_splenomegaly = $v[0];//腹部脾大|text
				$et_organ->abdominal_splenomegaly_info = $this->_request->getParam('abdominal_splenomegaly_info');//腹部脾大|text
			}
		}
		foreach ($et_abdominal_tenderness as $k=>$v){
			if($this->_request->getParam('shifting_dullness')==$k){
				$et_organ->shifting_dullness = $v[0];//腹部移动性浊音|text
				$et_organ->shifting_dullness_info = $this->_request->getParam('shifting_dullness_info');//腹部移动性浊音|text
			}
		}
		foreach ($et_ramus_inferior_edema as $k=>$v){
			if($this->_request->getParam('ramus_inferior_edema')==$k){
				$et_organ->ramus_inferior_edema = $v[0];//下肢水肿|radio|1=>无,2=>单侧,3=>双侧不对称,4=>双侧对称
			}
		}
		foreach ($et_foot_arterial_pulse as $k=>$v){
			if($this->_request->getParam('foot_arterial_pulse')==$k){
				$et_organ->foot_arterial_pulse = $v[0];//足背动脉搏动|radio|1=>未触及,2=>触及双侧对称,3=>触及左侧弱或消失,4=>触及右侧弱或消失
			}
		}
		foreach ($et_rectal_touch as $k=>$v){
			if($this->_request->getParam('rectal_touch')==$k){
				$et_organ->rectal_touch = $v[0];//肛门指诊|radio|1=>未及异常,2=>触痛,3=>包块,4=>前列腺异常,5=>其他
				if($v[0]=='-99'){
					$et_organ->rectal_touch_other = $this->_request->getParam('rectal_touch_other');//肛门指诊其它|text
				}
			}
		}
		/*
		foreach ($et_mammary_gland as $k=>$v){
		if($this->_request->getParam('mammary_gland')==$k){
		$et_organ->mammary_gland = $v[0];//乳腺|radio|1=>未见异常,2=>乳房切除,3=>异常泌乳,4=>乳腺包块,5=>其他
		if($v[0]=='-99'){
		$et_organ->mammary_gland_other = $this->_request->getParam('mammary_gland_other');//乳腺其它|text
		}
		}
		}
		*/


		// Edited By Eric_Zhou
		$post_mammary_gland =  $this->_request->getParam('mammary_gland');//获取值
		//var_dump($post_mammary_gland);
		$et_organ->mammary_gland = '';
		foreach($post_mammary_gland as $k=>$v){
			if(isset($et_mammary_gland[$v][0])){
				$et_organ->mammary_gland .= $et_mammary_gland[$v][0].'|';
				if($et_mammary_gland[$v][0] == '-99'){
					$et_organ->mammary_gland_other = $this->_request->getParam('mammary_gland_other');//乳腺其它|text
				}
			}
		}
		$et_organ->mammary_gland = rtrim($et_organ->mammary_gland,'|');

		foreach ($et_gynae_vulva as $k=>$v){
			if($this->_request->getParam('gynae_vulva')==$k){
				$et_organ->gynae_vulva = $v[0];//妇科外阴|radio|1=>未见异常,2=>异常
				$et_organ->gynae_vulva_exception = $this->_request->getParam('gynae_vulva_exception');//妇科外阴异常|text
			}
		}
		foreach ($et_gynae_cunt as $k=>$v){
			if($this->_request->getParam('gynae_cunt')==$k){
				$et_organ->gynae_cunt = $v[0];//妇科阴道|radio|1=>未见异常,2=>异常
				$et_organ->gynae_cunt_exception = $this->_request->getParam('gynae_cunt_exception');//妇科阴道异常|text
			}
		}
		foreach ($et_gynae_cervix as $k=>$v){
			if($this->_request->getParam('gynae_cervix')==$k){
				$et_organ->gynae_cervix =$v[0];//妇科宫颈|radio|1=>未见异常,2=>异常
				$et_organ->gynae_cervix_exception = $this->_request->getParam('gynae_cervix_exception');//妇科宫颈异常|text
			}
		}
		foreach ($et_gynae_uterus as $k=>$v){
			if($this->_request->getParam('gynae_uterus')==$k){
				$et_organ->gynae_uterus = $v[0];//妇科宫体|radio|1=>未见异常,2=>异常
				$et_organ->gynae_uterus_exception = $this->_request->getParam('gynae_uterus_exception');//妇科宫体异常|text
			}
		}
		foreach ($et_gynae_appendix as $k=>$v){
			if($this->_request->getParam('gynae_appendix')==$k){
				$et_organ->gynae_appendix = $v[0];//妇科附件|radio|1=>未见异常,2=>异常
				$et_organ->gynae_appendix_exception = $this->_request->getParam('gynae_appendix_exception');//妇科附件异常|text
			}
		}
		$et_organ->others = $this->_request->getParam('others');//其它|text
		if(empty($uuid)){//添加
			$et_organ->created = $time;//添加记录时间
			$et_organ->uuid = $examination_id;//编号
			$et_organ->examination_id = $examination_id;//健康体检id
			$et_organ->staff_id = $staff_id;//医生档案号
			$et_organ->id = $serial_number;//个人档案号
			if($et_organ->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}else{//修改
			$et_organ->whereAdd("uuid='{$uuid}'");
			if($et_organ->update(array($this->user['uuid'],'updated'))){
				$update_token=true;//修改成功
			}
		}
		//辅助查体
		$et_examination =new Tet_examination();
		$et_examination->fbglucoseh = $this->_request->getParam('fbglucoseh');//空腹血糖1
		$et_examination->fbglucosee = $this->_request->getParam('fbglucosee');//空腹血糖2
		$et_examination->hemoglobin = $this->_request->getParam('hemoglobin');//血常规血红蛋白
		$et_examination->leukocyte = $this->_request->getParam('leukocyte');//血常规白细胞
		$et_examination->platelet = $this->_request->getParam('platelet');//血常规血小板
		$et_examination->b_other = $this->_request->getParam('b_other');//血常规其他
		$et_examination->u_protein = $this->_request->getParam('u_protein');//尿常规尿蛋白
		$et_examination->urine = $this->_request->getParam('urine');//尿常规尿糖
		$et_examination->ketone = $this->_request->getParam('ketone');//尿常规尿酮体
		$et_examination->uoblood = $this->_request->getParam('uoblood');//尿常规尿潜血
		$et_examination->u_other = $this->_request->getParam('u_other');//尿常规其他
		$et_examination->microurine = $this->_request->getParam('microurine');//尿微量白蛋白
		foreach ($et_fecalblood as $k=>$v){
			if($this->_request->getParam('fecalblood')==$k){
				$et_examination->fecalblood = $v[0];//大便潜血|radio|1=>阴性|2=>阳性
			}
		}
		$et_examination->alanine = $this->_request->getParam('alanine');//肝功能血清谷丙转氨酶
		$et_examination->serum = $this->_request->getParam('serum');//肝功能血清谷丙转草氨酶
		$et_examination->albumin = $this->_request->getParam('albumin');//肝功能白蛋白
		$et_examination->tbilirubin = $this->_request->getParam('tbilirubin');//肝功能总胆红素
		$et_examination->bilirubin = $this->_request->getParam('bilirubin');//肝功能结合总胆红素
		$et_examination->screatinine = $this->_request->getParam('screatinine');//肾功能血清肌酐
		$et_examination->bun = $this->_request->getParam('bun');//肾功能血清肌酐
		$et_examination->serumpc = $this->_request->getParam('serumpc');//肾功能血钾浓度
		$et_examination->sodium = $this->_request->getParam('sodium');//肾功能血钠浓度
		$et_examination->tcholesterol = $this->_request->getParam('tcholesterol');//血脂总胆固醇
		$et_examination->triglyceride = $this->_request->getParam('triglyceride');//血脂甘油三脂
		$et_examination->lowcholesterol = $this->_request->getParam('lowcholesterol');//血脂血清低密度脂蛋白胆固醇
		$et_examination->highcholesterol = $this->_request->getParam('highcholesterol');//血脂血清高密度脂蛋白胆固醇
		$et_examination->ghemoglobin = $this->_request->getParam('ghemoglobin');//糖化血红蛋白
                                      $hbsurface_update =  $this->_request->getParam('hbsurface');//乙型肝炎表面抗原
                                      $fundus_update = $this->_request->getParam('fundus');//眼底
                                      $ecg_update    = $this->_request->getParam('ecg');//心电图
                                      $xrayfilm_update = $this->_request->getParam('xrayfilm');//胸部x片
                                      $bc_update = $this->_request->getParam('bc');//B超
                                      $csmear_update = $this->_request->getParam('csmear');//宫颈涂片
                                      //乙型肝炎表面抗原
                                      if(!empty($hbsurface_update))
                                      {
                                            foreach ($et_hbsurface as $k=>$v)
                                            {                  
                                                    if($hbsurface_update==$k)
                                                     {
                                                            $et_examination->hbsurface = $v[0];//乙型肝炎表面抗原|radio|1=>阳性|2=>阴性
                                                    }
                                            }
                                      }
                                      else
                                      {
                                                  $et_examination->hbsurface ='';
                                      }
                //眼底
                if(!empty($fundus_update))
                {
                        foreach ($et_fundus as $k=>$v)
                        {
                                    if($fundus_update==$k)
                                    {

                                            $et_examination->fundus = $v[0];//眼底|radio|1=>正常|2=>异常
                                            $et_examination->veryfundus = $this->_request->getParam('veryfundus');//眼底异常名称
                                    }              
                        }
                }
                else
                {
                        $et_examination->fundus = '';//眼底|radio|1=>正常|2=>异常
                        $et_examination->veryfundus = '';//眼底异常名称
                }
                //心电图
                if(!empty($ecg_update))
                {
                             foreach ($et_ecg as $k=>$v)
                             {
	              if($ecg_update==$k)
                                  {
                                        $et_examination->ecg = $v[0];//心电图|radio|1=>正常|2=>异常
                                        $et_examination->veryecg = $this->_request->getParam('veryecg');//心电图异常名称
	               }
                              }
                }
                else
                {
                     $et_examination->ecg ='';
                     $et_examination->veryecg ='';
                }
                if(!empty($xrayfilm_update))
                {
		foreach ($et_xrayfilm as $k=>$v){
			if($xrayfilm_update==$k)
                                                         {
				$et_examination->xrayfilm = $v[0];//胸部x线片|radio|1=>正常|2=>异常
				$et_examination->veryxrayfilm = $this->_request->getParam('veryxrayfilm');//胸部x线片异常 名称
			}
		}
                }
                else
                {
                    $et_examination->xrayfilm ='';//胸部x线片|radio|1=>正常|2=>异常
	 $et_examination->veryxrayfilm ='';//胸部x线片异常 名称
                }
                //B超
                if(!empty($bc_update))
                {
	foreach ($et_bc as $k=>$v)
                    {
                        if($bc_update==$k)
                        {
                                $et_examination->bc = $v[0];//B超|radio|1=>正常|2=>异常
                                $et_examination->verybc = $this->_request->getParam('verybc');//B超x线片异常名称
                        }
	 }
                }
                else
                {
                    $et_examination->bc ='';
                    $et_examination->verybc ='';
                }
              if(!empty($csmear_update))
              {
                    foreach ($et_csmear as $k=>$v)
                    {
	       if($csmear_update==$k)
                            {
                                $et_examination->csmear = $v[0];//宫颈涂片|radio|1=>正常|2=>异常
                                $et_examination->verycsmear = $this->_request->getParam('verycsmear');//宫颈涂片异常名称
	         }
	}
              }
              else
              {
                   $et_examination->csmear='';
                   $et_examination->verycsmear ='';
              }
		$et_examination->examination_other = $this->_request->getParam('examination_other');//其它|text
		if(empty($uuid)){//添加
			$et_examination->created = $time;//添加记录时间
			$et_examination->uuid = $examination_id;//编号
			$et_examination->examination_id = $examination_id;//健康体检id
			$et_examination->staff_id = $staff_id;//医生档案号
			$et_examination->id = $serial_number;//个人档案号

			if($et_examination->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}else{//修改
			$et_examination->whereAdd("uuid='{$uuid}'");
                       // $et_examination->debugLevel(9);
			if($et_examination->update(array($this->user['uuid'],'updated'))){
				$update_token=true;//修改成功
			}
		}
		//中医体质辨识
		$et_identification =new Tet_identification();
		$et_identification->physical_medicine_name = @implode('|',$this->_request->getParam('physical_medicine_name'));//中医生体质名字|text
		$physical_medicine_val_array=$this->_request->getParam('physical_medicine_val');
		$physical_medicine_val_str='';
		foreach ($physical_medicine_val_array as $physical_medicine_val){
			$physical_medicine_val_str.=array_code_change($physical_medicine_val,$et_physical_medicine_val).'|';
		}
		$et_identification->physical_medicine_val = rtrim($physical_medicine_val_str,'|');//中医生体质值|radio|1=>是,2=>倾向是
		if(empty($uuid)){//添加
			$et_identification->uuid = $examination_id;//编号
			$et_identification->created = $time;//添加记录时间
			$et_identification->examination_id = $examination_id;//健康体检id
			$et_identification->staff_id = $staff_id;//医生档案号
			$et_identification->id = $serial_number;//个人档案号
			if($et_identification->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}else{//修改
			$et_identification->whereAdd("uuid='{$uuid}'");
			if($et_identification->update(array($this->user['uuid'],'updated'))){
				$update_token=true;//修改成功
			}
		}

		//现存主要健康问题
		$et_mhealth =new Tet_mhealth();
		$et_mhealth->ceredisease = $this->_request->getParam('ceredisease');//脑血管疾病
		$ceredisease_status_str='';
		$ceredisease_status_arr=$this->_request->getParam('ceredisease_status');//脑血管疾病状态|checkbox|1=>未发现|2=>缺血性卒中|3=>脑出血|4=>蛛网膜下腔出血|5=>短暂性脑缺血|6=>其他
		foreach ($ceredisease_status_arr as $k=>$v){
			if(isset($et_ceredisease_status[$v][0])){
				$ceredisease_status_str .= $et_ceredisease_status[$v][0].'|';//脑血管疾病状态|checkbox|1=>未发现|2=>缺血性卒中|3=>脑出血|4=>蛛网膜下腔出血|5=>短暂性脑缺血|6=>其他
				if ($et_ceredisease_status[$v][0]=='-99'){
					$et_mhealth->ceredisease_other = $this->_request->getParam('ceredisease_other');//其他脑血管疾病中文含义
				}
			}
		}
		$et_mhealth->ceredisease_status = rtrim($ceredisease_status_str,'|');//脑血管疾病状态|checkbox|1=>未发现|2=>缺血性卒中|3=>脑出血|4=>蛛网膜下腔出血|5=>短暂性脑缺血|6=>其他
		$et_mhealth->kidneydisease = $this->_request->getParam('kidneydisease');//肾脏疾病
		$kidneydisease_status_arr= $this->_request->getParam('kidneydisease_status');//肾脏疾病状态|checkbox|1=>未发现|2=>糖尿病肾病|3=>肾功能衰竭|4=>急性肾炎|5=>慢性肾炎|6=>其他
		$kidneydisease_status_str='';
		foreach ($kidneydisease_status_arr as $k=>$v){
			if(isset($et_kidneydisease_status[$v][0])){
				$kidneydisease_status_str .= $et_kidneydisease_status[$v][0].'|';//肾脏疾病状态|checkbox|1=>未发现|2=>糖尿病肾病|3=>肾功能衰竭|4=>急性肾炎|5=>慢性肾炎|6=>其他
				if ($et_kidneydisease_status[$v][0]=='-99'){
					$et_mhealth->kidneydisease_other = $this->_request->getParam('kidneydisease_other');//其他肾脏疾病中文含义
				}
			}
		}
		$et_mhealth->kidneydisease_status = rtrim($kidneydisease_status_str,'|');//肾脏疾病状态|checkbox|1=>未发现|2=>糖尿病肾病|3=>肾功能衰竭|4=>急性肾炎|5=>慢性肾炎|6=>其他
		$et_mhealth->heartdisease = $this->_request->getParam('heartdisease');//心脏疾病
		$heartdisease_status_arr=$this->_request->getParam('heartdisease_status');//心脏疾病状态|checkbox|1=>未发现|2=>心肌梗死|3=>心绞痛|4=>冠状动脉血运重建|5=>充血性心力衰竭|6=>心前区疼痛|7=>其他
		$heartdisease_status_str='';
		foreach ($heartdisease_status_arr as $k=>$v){
			if(isset($et_heartdisease_status[$v][0])){
				$heartdisease_status_str .= $et_heartdisease_status[$v][0].'|';//心脏疾病状态|checkbox|1=>未发现|2=>心肌梗死|3=>心绞痛|4=>冠状动脉血运重建|5=>充血性心力衰竭|6=>心前区疼痛|7=>其他
				if ($et_heartdisease_status[$v][0]=='-99'){
					$et_mhealth->heartdisease_other = $this->_request->getParam('heartdisease_other');//其他心脏疾病中文含义
				}
			}
		}
		$et_mhealth->heartdisease_status = rtrim($heartdisease_status_str,'|');//心脏疾病状态|checkbox|1=>未发现|2=>心肌梗死|3=>心绞痛|4=>冠状动脉血运重建|5=>充血性心力衰竭|6=>心前区疼痛|7=>其他
		$et_mhealth->vasculardisease = $this->_request->getParam('vasculardisease');//血管疾病
		$vasculardisease_status_arr = $this->_request->getParam('vasculardisease_status');//血管疾病状态|checkbox|1=>未发现|2=>夹层动脉瘤|3=>动脉闭塞性疾病|4=>其他
		$vasculardisease_status_str='';
		foreach ($vasculardisease_status_arr as $k=>$v){
			if(isset($et_vasculardisease_status[$v][0])){
				$vasculardisease_status_str .= $et_vasculardisease_status[$v][0].'|';//血管疾病状态|checkbox|1=>未发现|2=>夹层动脉瘤|3=>动脉闭塞性疾病|4=>其他
				if ($et_vasculardisease_status[$v][0]=='-99'){
					$et_mhealth->vasculardisease_other = $this->_request->getParam('vasculardisease_other');//其他血管疾病中文含义
				}
			}
		}
		$et_mhealth->vasculardisease_status = rtrim($vasculardisease_status_str,'|');//血管疾病状态|checkbox|1=>未发现|2=>夹层动脉瘤|3=>动脉闭塞性疾病|4=>其他
		$et_mhealth->eyedisease = $this->_request->getParam('eyedisease');//眼部疾病
		$eyedisease_status_arr=$this->_request->getParam('eyedisease_status');//眼部疾病状态|checkbox|1=>未发现|2=>视网膜出血或渗出|3=>视乳头水肿|4=>白内障|5=>其他
		$eyedisease_status_str='';
		foreach ($eyedisease_status_arr as $k=>$v){
			if(isset($et_eyedisease_status[$v][0])){
				$eyedisease_status_str .= $et_eyedisease_status[$v][0].'|';//眼部疾病状态|checkbox|1=>未发现|2=>视网膜出血或渗出|3=>视乳头水肿|4=>白内障|5=>其他
				if ($et_eyedisease_status[$v][0]=='-99'){
					$et_mhealth->eyedisease_other = $this->_request->getParam('eyedisease_other');//其他眼部疾病中文含义
				}
			}
		}
		$et_mhealth->eyedisease_status = rtrim($eyedisease_status_str,'|');//眼部疾病状态|checkbox|1=>未发现|2=>视网膜出血或渗出|3=>视乳头水肿|4=>白内障|5=>其他
		$et_mhealth->nervousdisease = $this->_request->getParam('nervousdisease');//神经系统疾病
		foreach ($et_nervousdisease_status as $k=>$v){
			if($this->_request->getParam('nervousdisease_status')==$k){
				$et_mhealth->nervousdisease_status = $v[0];//神经系统疾病状态|checkbox|1=>未发现|2=>有
				$et_mhealth->nervousdisease_other = $this->_request->getParam('nervousdisease_other');//有的神经系统疾病中文含义
			}
		}
		$et_mhealth->otherdisease = $this->_request->getParam('otherdisease');//其他系统疾病
		foreach ($et_otherdisease_status as $k=>$v){
			if($this->_request->getParam('otherdisease_status')==$k){
				$et_mhealth->otherdisease_status = $v[0];//其他系统疾病状态|checkbox|1=>未发现|2=>有
				$et_mhealth->otherdisease_other = $this->_request->getParam('otherdisease_other');//有的其他系统疾病中文含义
			}
		}
		if(empty($uuid)){//添加
			$et_mhealth->created = $time;//添加记录时间
			$et_mhealth->uuid = $examination_id;//编号
			$et_mhealth->examination_id = $examination_id;//健康体检id
			$et_mhealth->staff_id = $staff_id;//医生档案号
			$et_mhealth->id = $serial_number;//个人档案号
			if($et_mhealth->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}else{//修改
			$et_mhealth->whereAdd("uuid='{$uuid}'");
			if($et_mhealth->update(array($this->user['uuid'],'updated'))){
				$update_token=true;//修改成功
			}
		}
		//住院史
		$be_hospitalized_time_array = $this->_request->getParam('be_hospitalized_time');//入院日期
		$leave_hospital_time_array = $this->_request->getParam('leave_hospital_time');//出院日期
		$organization_array = $this->_request->getParam('hh_organization');//医疗机构名
		$reason_array = $this->_request->getParam('hh_reason');//原因
		$record_no_array = $this->_request->getParam('hh_record_no');//病案号
		//删除住院史
		$et_hospitalization_history =new Tet_hospitalization_history();
		$et_hospitalization_history->whereAdd("examination_id = '{$examination_id}'");
		$et_hospitalization_history->delete();
		foreach ($be_hospitalized_time_array as $key=>$be_hospitalized){
			if(empty($be_hospitalized) || empty($leave_hospital_time_array[$key]) || empty($organization_array[$key])){
				//跳出本次循环
				continue;
			}
			$et_hospitalization_history =new Tet_hospitalization_history();
			$et_hospitalization_history->staff_id = $staff_id;//医生档案号
			$et_hospitalization_history->id = $serial_number;//个人档案号
			$et_hospitalization_history->be_hospitalized_time = mkunixstamp($be_hospitalized);//入院日期
			$et_hospitalization_history->leave_hospital_time =  mkunixstamp($leave_hospital_time_array[$key]) ;//出院日期
			$et_hospitalization_history->reason = $reason_array[$key];//原因
			$et_hospitalization_history->organization = $organization_array[$key];//医疗机构名
			$et_hospitalization_history->record_no = $record_no_array[$key];//病案号

			$et_hospitalization_history->created = $time;//添加记录时间
			$et_hospitalization_history->uuid = uniqid('et',true);//编号
			$et_hospitalization_history->examination_id = $examination_id;//健康体检id
			if($et_hospitalization_history->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}
		//手術史
		$put_bed_time_array = $this->_request->getParam('put_bed_time');//建床日期
		$receive_bed_time_array = $this->_request->getParam('receive_bed_time');//撤床日期
		$reason_array = $this->_request->getParam('oh_reason');//原因
		$organization_array = $this->_request->getParam('oh_organization');//医疗机构名
		$record_no_array = $this->_request->getParam('oh_record_no');//病案号
		//删除手術史
		$et_operation_history =new Tet_operation_history();
		$et_operation_history->whereAdd("examination_id = '{$examination_id}'");
		$et_operation_history->delete();     
		foreach ($put_bed_time_array as $key=>$put_bed_time){
			if(empty($put_bed_time) || empty($receive_bed_time_array[$key]) || empty($organization_array[$key])){
				//跳出本次循环
				continue;
			}
			$et_operation_history =new Tet_operation_history();
			$et_operation_history->staff_id = $staff_id;//医生档案号
			$et_operation_history->id = $serial_number;//个人档案号
			$et_operation_history->put_bed_time = mkunixstamp($put_bed_time);//建床日期
			$et_operation_history->receive_bed_time = mkunixstamp($receive_bed_time_array[$key]);//撤床日期
			$et_operation_history->reason = $reason_array[$key];//原因
			$et_operation_history->organization = $organization_array[$key];//医疗机构名
			$et_operation_history->record_no = $record_no_array[$key];//病案号
			//添加
			$et_operation_history->created = $time;//添加记录时间
			$et_operation_history->uuid = uniqid('et',true);//编号
			$et_operation_history->examination_id = $examination_id;//健康体检id	
			if($et_operation_history->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}

		}

		//主要用药情况
		$drug_name_array = $this->_request->getParam('drug_name');//药物名称
		$drug_usage_array = $this->_request->getParam('drug_usage');//用法
		$drug_dosage_array = $this->_request->getParam('drug_dosage');//用量
		$drug_time_array = $this->_request->getParam('drug_time');//用药时间
		$drug_compliance_array = $this->_request->getParam('drug_compliance');//服药依从性|radio|1=>规律,2=>间断,3=>不服药

		//删除手術史
		$et_main_drug_use =new Tet_main_drug_use();
		$et_main_drug_use->whereAdd("examination_id = '{$examination_id}'");
		$et_main_drug_use->delete();
       
		foreach ($drug_name_array as $key=>$drug_name){
			if(empty($drug_name)){
				//跳出本次循环
				continue;
			}
			
			$et_main_drug_use =new Tet_main_drug_use();
			$et_main_drug_use->staff_id = $staff_id;//医生档案号
			$et_main_drug_use->id = $serial_number;//个人档案号
			$et_main_drug_use->drug_name = $drug_name;//药物名称
			$et_main_drug_use->drug_usage = $drug_usage_array[$key];//用法
			$et_main_drug_use->drug_dosage = $drug_dosage_array[$key];//用量
			$et_main_drug_use->drug_time = $drug_time_array[$key];//用药时间
			$et_main_drug_use->drug_compliance = array_code_change($drug_compliance_array[$key],$et_drug_compliance);//服药依从性|radio|1=>规律,2=>间断,3=>不服药

			$et_main_drug_use->created = $time;//添加记录时间
			$et_main_drug_use->uuid = uniqid('et',true);//编号
			$et_main_drug_use->examination_id = $examination_id;//健康体检id
			if($et_main_drug_use->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}
		//非免疫规划预防接种史
		$vaccination_name_array = $this->_request->getParam('vaccination_name');//名称
		$vaccination_time_array = $this->_request->getParam('vaccination_time');//接种日期
		$vaccination_org_array = $this->_request->getParam('vaccination_org');//接种机构
		//删除非免疫规划预防接种史
		$et_nonepi_vaccination =new Tet_nonepi_vaccination();
		$et_nonepi_vaccination->whereAdd("examination_id = '{$examination_id}'");
		$et_nonepi_vaccination->delete();
		//print_r($vaccination_name_array);
		foreach ($vaccination_name_array as $key=>$vaccination_name){
			if(empty($vaccination_name)){
				//跳出本次循环
				continue;
			}
			$et_nonepi_vaccination1 =new Tet_nonepi_vaccination();
			$et_nonepi_vaccination1->staff_id = $staff_id;//医生档案号
			$et_nonepi_vaccination1->id = $serial_number;//个人档案号
			$et_nonepi_vaccination1->vaccination_name = $vaccination_name;//名称
			$et_nonepi_vaccination1->vaccination_time = mkunixstamp($vaccination_time_array[$key]);//接种日期
			$et_nonepi_vaccination1->vaccination_org = $vaccination_org_array[$key];//接种机构
			$et_nonepi_vaccination1->created = $time;//添加记录时间
			$et_nonepi_vaccination1->uuid = uniqid('et',true);//编号
			$et_nonepi_vaccination1->examination_id = $examination_id;//健康体检id
			//$et_nonepi_vaccination1->debugLevel(3);
			if($et_nonepi_vaccination1->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}
		//健康评价

		$et_health_assessment1 =new Tet_health_assessment();
		$get_form_health_evaluation = $this->_request->getParam('health_evaluation');
		if(!empty($get_form_health_evaluation))
		{
			$et_health_assessment1->health_assessment = array_code_change($get_form_health_evaluation,$et_health_evaluation);//健康评价|radio|1=>体检无异常,2=>有异常
		}
		$get_form_health_exception = $this->_request->getParam('health_exception');
		if(!empty($get_form_health_exception))
		{
			$et_health_assessment1->health_exception =  @implode('|',$get_form_health_exception);//健康异常
		}
		else 
		{
			$et_health_assessment1->health_exception = '';
		}
		if(empty($uuid)){//添加
			$et_health_assessment1->created = $time;//添加记录时间
			$et_health_assessment1->uuid = uniqid('heal_',true);//编号
			$et_health_assessment1->examination_id = $examination_id;//健康体检id
			$et_health_assessment1->staff_id = $staff_id;//医生档案号
			$et_health_assessment1->id = $serial_number;//个人档案号
			if($et_health_assessment1->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}else{//修改
			$et_health_assessment1->whereAdd("examination_id='{$uuid}'");
			if($et_health_assessment1->update(array($this->user['uuid'],'updated'))){
				$update_token=true;//修改成功
			}
		}
		//健康指导
		/*
		$et_health_guidance1->health_assessment = @implode('|',array_code_change($this->_request->getParam('health_assessment'),$et_health_assessment));//健康指导|radio|1=>定期随访,2=>纳入慢性病患者健康管理,3=>建议复查,4=>建议转诊
		*/
		// Edited By Eric_Zhou
		$et_health_guidance1 =new Tet_health_guidance();
		$post_health_assessment =  $this->_request->getParam('health_assessment');//获取值
		$et_health_guidance1->health_assessment = '';
		foreach($post_health_assessment as $k=>$v){
			if(isset($et_health_assessment[$v][0])){
				$et_health_guidance1->health_assessment.= $et_health_assessment[$v][0].'|';
			}
		}
		$et_health_guidance1->health_assessment = rtrim($et_health_guidance1->health_assessment,'|');

		$risk_factor_col=array();
		$risk_factor_col=$this->_request->getParam('risk_factor_col');
		
		foreach ($risk_factor_col as $k=>$v)
		{
			$risk_factor_col[$k]=array_code_change($v,$et_risk_factor_col);
		}
		$et_health_guidance1->risk_factor_col = @implode('|',$risk_factor_col);//危险因素控制|radio|1=>戒烟,2=>健康饮酒,3=>饮食,4=>锻炼,5=>减体重,6=>建议疫苗接种,7=>其它
		$et_health_guidance1->lose_weight = $this->_request->getParam('lose_weight');//减体重
		$et_health_guidance1->recommended_vaccination = $this->_request->getParam('recommended_vaccination');//建议疫苗接种
		$et_health_guidance1->risk_factor_col_other = $this->_request->getParam('risk_factor_col_other');//其他
		if(empty($uuid)){//添加
			$et_health_guidance1->created = $time;//添加记录时间
			$et_health_guidance1->uuid = $examination_id;//编号
			$et_health_guidance1->examination_id = $examination_id;//健康体检id
			$et_health_guidance1->staff_id = $staff_id;//医生档案号
			$et_health_guidance1->id = $serial_number;//个人档案号
			if($et_health_guidance1->insert($this->user['uuid'])){
				$update_token=true;//添加成功
			}
		}else{//修改
			$et_health_guidance1->whereAdd("uuid='{$uuid}'");
			if($et_health_guidance1->update(array($this->user['uuid'],'updated'))){
				$update_token=true;//修改成功
			}
		}
		if($update_token===true){
			$uuid=empty($uuid)?$examination_id:$uuid;
			message("更新成功！",array("体检列表"=>__BASEPATH.'et/index/index',"继续修改"=>__BASEPATH."et/index/add/uuid/{$uuid}"));
		}
	}	
}
