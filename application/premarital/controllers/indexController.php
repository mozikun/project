<?php
/*
 * Created By Eric_Zhou
 * Filename: diabetesController.php
 * Date : 2010-08-19
 * Summary : 婚检(http://host/premarital/)
 */

class indexController extends controller{
	//初始化
	public function init(){
		$this->haveWritePrivilege='';
		require_once __SITEROOT.'library/privilege.php';
		require_once __SITEROOT.'library/custom/adodb-time.inc.php';
		require_once __SITEROOT.'library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."library/Models/certificate_premartial_exam.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/custom/pager.php";
		require_once __SITEROOT."library/Models/family_archive.php";
		require_once __SITEROOT."library/Models/organization.php";
		require_once(__SITEROOT.'library/Models/region.php');
		$this->view->basePath = $this->_request->getBasePath();
	}
	//婚前检查证明列表
	public function indexAction(){
		//搜索条件
		$search = array();
		$search['username']=$this->_request->getParam('username');//姓名包含拼音
		$search['standard_code']=$this->_request->getParam('standard_code');//档案号
		$search['identity_number']=$this->_request->getParam('identity_number');//身份证号
		$search['staff_id']=$this->_request->getParam('staff_id');//责任医生
		
		$individual_session=new Zend_Session_Namespace("individual_core");
		//医生列表
		$org_region_domain=$this->user['current_region_path_domain'];
		$temp=explode("|",$org_region_domain);
		$diabetes_core_region_path_domain='';
		$staff_core_region_path_domain='';
		foreach ($temp as $k1=>$v1){
			$diabetes_core_region_path_domain=$diabetes_core_region_path_domain.
				"individual_core.region_path like '".$v1."%' or ";
			$staff_core_region_path_domain=$staff_core_region_path_domain.
				"staff_core.region_path like '".$v1."%' or ";
		}
		$diabetes_core_region_path_domain=rtrim($diabetes_core_region_path_domain,' or ');
		$staff_core_region_path_domain=rtrim($staff_core_region_path_domain,' or ');
		$staff_core=new Tstaff_core();
		$staff_archive=new Tstaff_archive();
		$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
		$staff_core->whereAdd($staff_core_region_path_domain);
		$staff_core->find();
		$responseDoctorArray=array();
		$responseDoctorArray[0]['zh_name']='请选择';
		$responseDoctorArray[0]['id']='-9';
		$counter=1;
		while ($staff_core->fetch()) {
			$responseDoctorArray[$counter]['zh_name']=$staff_archive->name_real;
			$responseDoctorArray[$counter]['id']=$staff_core->id;
			if ($search['staff_id']==$staff_core->id){
				$responseDoctorArray[$counter]['selected']='selected';
			}else{
				$responseDoctorArray[$counter]['selected']='';
			}
			$counter++;
		}
		$exam = new Tcertificate_premartial_exam();
		$core=new Tindividual_core();
		$exam->whereAdd($diabetes_core_region_path_domain);
		$exam->joinAdd('left',$exam,$core,'id','uuid');
		if($search['username']){
			$exam->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if($search['standard_code']){
			$exam->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$exam->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
		if ($search['staff_id'] && $search['staff_id'] != '-9')
		{
			$exam->whereAdd("certificate_premartial_exam.staff_id = '".$search['staff_id']."'");
		}
		
		$nums=$exam->count("distinct certificate_premartial_exam.id");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		$arg = array();
		//new subpages(每页显示条数，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,
			__BASEPATH.'premarital/index/index/page/',2,$arg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$exam->selectAdd("certificate_premartial_exam.id as id,certificate_premartial_exam.staff_id as staff_id,individual_core.standard_code_1,individual_core.identity_number,individual_core.name as name,individual_core.name_pinyin as name_pinyin,certificate_premartial_exam.record_time");
		$exam->groupBy("certificate_premartial_exam.id,individual_core.name,individual_core.name_pinyin,certificate_premartial_exam.staff_id,individual_core.standard_code_1,individual_core.identity_number,certificate_premartial_exam.record_time");
		$exam->orderby("certificate_premartial_exam.record_time  DESC");
		$exam->limit($startnum,__ROWSOFPAGE);
		$exam->find();
		$exam_list_arr = array();
		$i = 0;
		while($exam->fetch()){
			$exam_list_arr[$i]['id'] = $exam->id;
			$exam_list_arr[$i]['indent'] = $exam->identity_number;
			$exam_list_arr[$i]['name'] = $exam->name;
			$exam_list_arr[$i]['moreinfo'] = get_moreinfo_premarital($exam->id);
			$i++;
		}
		$out = $links->subPageCss2();
		$this->view->assign('exam_list',$exam_list_arr);
		$this->view->assign('response_doctor',$responseDoctorArray);
		$this->view->assign("pager",$out);
		$this->view->display('index.html');
	}
	//婚前医学检查证明表
	public function proveAction(){
		//获取街道信息
		require_once(__SITEROOT.'library/custom/region_array.php');

		/*
		方法一
		require_once(__SITEROOT.'library/Models/region.php');
		$org_region_domain = $this->user['current_region_path_domain'];
		$temp_path_arr=explode(",",$org_region_domain);
		$temp_zh_name = '';
		foreach($temp_path_arr as $v){
			if($v < 2){
				continue;
			}
			$region = new Tregion();
			$region->whereAdd("id=$v");
			$region->find();
			$region->fetch();
			$temp_zh_name[] = $region->zh_name;
		}
		require_once(__SITEROOT.'library/custom/region_array.php');
		//假如
		$region_id='8942';
		//这里面有数组
		$regionInfo['8942']=array('黎明村委会','200','0,1,2,5,77,8237,8942');
		//因此得到
		
		$regionInfo['8942'][2]='0,1,2,5,77,8237,8942';
		切成数组
		$region1=explod(',',$regionInfo['8942'][2]);
		
		//则
		echo $regionInfo[$region1[0]][0]  可得到每一级的名称
		echo $regionInfo[$region1[0]][1]  可得到每一级的名称
		*/
		/*
		$org_region_domain = $this->user['current_region_path_domain'];
		$temp_path_arr=explode(",",$org_region_domain);
		$region_id=$this->user['region_id'];
		$region1=explode(',',$regionInfo[$region_id][2]);
		*/
		//var_dump($regionInfo[$region_id][2]);
		//获取session
		$individual_session=new Zend_Session_Namespace("individual_core");
		$uuid=$this->_request->getParam('uuid') ? $this->_request->getParam('uuid'):
			$individual_session->uuid;
				
		if(empty($uuid)){
			if(empty($individual_session->staff_id)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}	
			//2012-02-21仅查询正常档案
			if($individual_session->status_flag!=1){
	            message("你选择了一个非正常档案，请重新选择",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
	        }	
		}
		$individual=new Tindividual_core();
		$family=new Tfamily_archive();
		$org=new Torganization();
		$individual->joinAdd('inner',$individual,$family,'family_number','family_number');
		$individual->joinAdd('inner',$individual,$org,'org_id','id');
		$individual->whereAdd("individual_core.uuid='$uuid'");
		$individual->find(true);
		$org_id=$org->id;
		$region_path=$org->region_path;
		$temp_path_arr=explode(",",$region_path);
		$temp_zh_name = '';
		foreach($temp_path_arr as $v){
			if($v < 2){
				continue;
			}
			$region = new Tregion();
			$region->whereAdd("id=$v");
			$region->find();
			$region->fetch();
			$temp_zh_name[] = $region->zh_name;
		}

		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		$individual_inf=get_individual_info($individual_session->uuid);//取得个人信息中所有信息
		//民族
		if(array_search_for_other($individual_inf->race,$race) != 1){
			$curr_race = $races[$individual_inf->race_detail][1];		
		}else{
			$curr_race = $race[array_search_for_other($individual_inf->race,$race)][1];
		}
		//扩展信息 单位或职业
		$individual_archive = new Tindividual_archive();
		$individual_archive->whereAdd("id='$uuid'");
		$individual_archive->find(true);
		$unit = $individual_archive->unit_address;
		if($unit == '' && $individual_archive->occupation != ''){
			$unit = $occupation[$individual_archive->occupation][1];
		}
		//医生列表
		$org_region_domain=$this->user['current_region_path_domain'];
		$temp=explode("|",$org_region_domain);
		$diabetes_core_region_path_domain='';
		$staff_core_region_path_domain='';
		foreach ($temp as $k1=>$v1){
			$diabetes_core_region_path_domain=
				$diabetes_core_region_path_domain."individual_core.region_path like '".$v1."%' or ";
			$staff_core_region_path_domain=$staff_core_region_path_domain.
				"staff_core.region_path like '".$v1."%' or ";
		}
		//生成负责医生下拉框
		$diabetes_core_region_path_domain=rtrim($diabetes_core_region_path_domain,' or ');
		$staff_core_region_path_domain=rtrim($staff_core_region_path_domain,' or ');
		$staff_core=new Tstaff_core();
		$staff_archive=new Tstaff_archive();
		$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
		$staff_core->whereAdd($staff_core_region_path_domain);
		$staff_core->find();
		$responseDoctorArray=array();
		$responseDoctorArray[0]['zh_name']='请选择';
		$responseDoctorArray[0]['id']='-9';
		$counter=1;
		while ($staff_core->fetch()) {
			$responseDoctorArray[$counter]['zh_name']=$staff_archive->name_real;
			$responseDoctorArray[$counter]['id']=$staff_core->id;
			if ($individual_session->response_doctor==$staff_core->id){
				$responseDoctorArray[$counter]['selected']='selected';
			}else{
				$responseDoctorArray[$counter]['selected']='';
			}
			$counter++;
		}
		//赋值操作
		$this->view->assign('uuid',$uuid);
		$this->view->person_uuid = $individual_session->uuid;//个人uuid
		$this->view->standard_code = $individual_inf->standard_code_1;//个人标准档案号
		$this->view->staff_id = $individual_session->staff_id;//医生档案号
		$this->view->assign('add',$temp_zh_name);
		$this->view->assign('standard_code',$individual_inf->standard_code_1);
		$this->view->assign('uname',$individual_session->name);//姓名
		$this->view->assign('birthday',@date('Y-m-d',$individual_session->date_of_birth));//生日
		$this->view->assign('sex',$sex[array_search_for_other($individual_session->sex,$sex)][1]);//性别
		$this->view->assign('race',$curr_race);//民族
		$this->view->assign('identity_number',$individual_inf->identity_number);//身份证号码
		$this->view->assign('address',$individual_inf->address);//民族
		$this->view->assign('unit_address',$unit);//单位或职业
		$this->view->assign('blood_kinship',$pre_blood_kinship);//血亲关系
		$this->view->assign('medical_opinion',$pre_medical_opinion);//医学意见
		$this->view->assign('response_doctor',$responseDoctorArray);//医生列表
		$this->view->display('prove.html');
	}
	//添加婚检证明 入库
	public function addAction(){
		$cer_exam = new Tcertificate_premartial_exam();
		$cer_exam->selectAdd("count(*) as num");
		$cer_exam->whereAdd("id='".$this->_request->getParam('uuid')."'");
		$cer_exam->find();
		$cer_exam->fetch();
		//更新
		if(intval($cer_exam->num) != 0){
			$this->updateAction();
			exit;
		}
		$time = time();
		$exam = new Tcertificate_premartial_exam();
		$exam->uuid = uniqid("D_",true);//编号 唯一标识
		$exam->created = $time;//创建时间
		$request_time = $this->_request->getParam('ftime');
		//获取表单信息
		$exam->staff_id = $this->_request->getParam('staff_id');//档案号
		$exam->id = $this->_request->getParam('uuid');//个人档案
		$exam->partner_name = $this->_request->getParam('obj_name');//对方姓名
		$exam->blood_kinship = $this->_request->getParam('blood_kinship');//血亲关系
		$exam->result_of_premarital_exam = $this->_request->getParam('check_result');//婚检结果
		$exam->medical_opinion = $this->_request->getParam('doc_idea');//医学意见
		$exam->signature_of_doctor = $this->_request->getParam('followup_doctor');//主任医生id
		$exam->record_time = mkunixstamp($request_time);//登记时间
		if($exam->insert()){
			$url=array("医学婚检证明列表"=>__BASEPATH.'premarital/index/index',
				"用户列表"=>__BASEPATH.'iha/index/index');
			message("添加成功",$url);
		}
	}
	//删除婚前检查记录
	public function deleteAction(){
		$userid = $this->_request->getParam('id');
		$exam = new Tcertificate_premartial_exam();
		$exam->whereAdd("id='$userid'");
		if ($exam->delete()){
			$url=array("医学婚检证明列表"=>__BASEPATH.'premarital/index/index',
				"婚前检查表删除成功"=>__BASEPATH.'premarital/index/index',
				"用户列表"=>__BASEPATH.'iha/index/index');
			message("婚前检查表删除成功",$url);
		}
	}
	//编辑婚前检查 显示页
	public function editAction(){
		require_once(__SITEROOT.'library/custom/region_array.php');
		$org_region_domain = $this->user['current_region_path_domain'];
		$temp_path_arr=explode(",",$org_region_domain);
		$cer = new Tcertificate_premartial_exam();
		$cer->whereAdd("id='".$this->_request->getParam('id')."'");
		$cer->find();
		$cer->fetch();
		$doc_info = get_staff_info($cer->staff_id);
		$region_id=$doc_info[0]->region_id;
		$region1=explode(',',$regionInfo[$region_id][2]);
		//获取session
		$individual_session=new Zend_Session_Namespace("individual_core");
		$uuid=$this->_request->getParam('id') ? $this->_request->getParam('id'):$individual_session->uuid;
		if(empty($uuid)){
			message("返回婚前检查列表",array("进入个人档案列表"=>__BASEPATH.'premarital/index/index'));
		}
		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		$individual_inf=get_individual_info($uuid);//取得个人信息中所有信息
		//民族
		if(array_search_for_other($individual_inf->race,$race) != 1){
			$curr_race = $races[$individual_inf->race_detail][1];		
		}else{
			$curr_race = $race[array_search_for_other($individual_inf->race,$race)][1];
		}
		//扩展信息 单位或职业
		$individual_archive = new Tindividual_archive();
		$individual_archive->whereAdd("id='$uuid'");
		$individual_archive->find(true);
		$unit = $individual_archive->unit_address;
		if($unit == '' && $individual_archive->occupation != ''){
			$unit = $occupation[$individual_archive->occupation][1];
		}
		//医生列表
		$org_region_domain=$this->user['current_region_path_domain'];
		$temp=explode("|",$org_region_domain);
		$diabetes_core_region_path_domain='';
		$staff_core_region_path_domain='';
		foreach ($temp as $k1=>$v1){
			$diabetes_core_region_path_domain=
				$diabetes_core_region_path_domain."individual_core.region_path like '".$v1."%' or ";
			$staff_core_region_path_domain=$staff_core_region_path_domain.
				"staff_core.region_path like '".$v1."%' or ";
		}
		//生成负责医生下拉框
		$diabetes_core_region_path_domain=rtrim($diabetes_core_region_path_domain,' or ');
		$staff_core_region_path_domain=rtrim($staff_core_region_path_domain,' or ');
		$staff_core=new Tstaff_core();
		$staff_archive=new Tstaff_archive();
		$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
		$staff_core->whereAdd($staff_core_region_path_domain);
		$staff_core->find();
		$responseDoctorArray=array();
		$responseDoctorArray[0]['zh_name']='请选择';
		$responseDoctorArray[0]['id']='-9';
		$counter=1;
		while ($staff_core->fetch()) {
			$responseDoctorArray[$counter]['zh_name']=$staff_archive->name_real;
			$responseDoctorArray[$counter]['id']=$staff_core->id;
			if ($individual_session->response_doctor==$staff_core->id){
				$responseDoctorArray[$counter]['selected']='selected';
			}else{
				$responseDoctorArray[$counter]['selected']='';
			}
			$counter++;
		}
		//获取婚检信息
		$ex = new Tcertificate_premartial_exam();
		$ex->whereAdd("id = '$uuid'");
		$ex->find();
		$ex->fetch();
		$ex->record_time = @date('Y-m-d',$ex->record_time);
		//赋值操作
		$this->view->assign('uuid',$uuid);
		$this->view->person_uuid = $individual_session->uuid;//个人uuid
		$this->view->standard_code = $individual_inf->standard_code_1;//个人标准档案号
		$this->view->staff_id = $individual_session->staff_id;//医生档案号
		$this->view->assign('province',$regionInfo[$region1[2]][0]);
		$this->view->assign('standard_code',$individual_inf->standard_code_1);
		$this->view->assign('city',$regionInfo[$region1[3]][0]);
		$this->view->assign('area',$regionInfo[$region1[4]][0]);
		$this->view->assign('town',$regionInfo[$region1[5]][0]);
		$this->view->assign('check_info',$ex);
		$this->view->assign('uname',$individual_inf->name);//姓名
		$this->view->assign('birthday',@date('Y-m-d',$individual_inf->date_of_birth));//生日
		$this->view->assign('sex',$sex[array_search_for_other($individual_inf->sex,$sex)][1]);//性别
		$this->view->assign('race',$curr_race);//民族
		$this->view->assign('identity_number',$individual_inf->identity_number);//身份证号码
		$this->view->assign('address',$individual_inf->address);//民族
		$this->view->assign('unit_address',$unit);//单位或职业
		$this->view->assign('blood_kinship',$pre_blood_kinship);//血亲关系
		$this->view->assign('medical_opinion',$pre_medical_opinion);//医学意见
		$this->view->assign('response_doctor',$responseDoctorArray);//医生列表
		$this->view->display('edit.html');
	}
	//编辑入库
	public function updateAction(){
		$time = time();
		$exam = new Tcertificate_premartial_exam();
		//$exam->uuid = uniqid("D_",true);//编号 唯一标识
		//$exam->created = $time;//创建时间
		$request_time = $this->_request->getParam('ftime');
		//获取表单信息
		$uid = $this->_request->getParam('uuid');
		$exam->staff_id = $this->_request->getParam('staff_id');//档案号
		$exam->id = $uid;//个人档案
		$exam->partner_name = $this->_request->getParam('obj_name');//对方姓名
		$exam->blood_kinship = $this->_request->getParam('blood_kinship');//血亲关系
		$exam->result_of_premarital_exam = $this->_request->getParam('check_result');//婚检结果
		$exam->medical_opinion = $this->_request->getParam('doc_idea');//医学意见
		$exam->signature_of_doctor = $this->_request->getParam('followup_doctor');//主任医生id
		$exam->record_time = mkunixstamp($request_time);//登记时间
		$exam->whereAdd("id='$uid'");
		if($exam->update()){
			$url=array("医学婚检证明列表"=>__BASEPATH.'premarital/index/index',
				"用户列表"=>__BASEPATH.'iha/index/index');
			message("编辑成功",$url);
		}else{
			$url=array("医学婚检证明列表"=>__BASEPATH.'premarital/index/index',
				"用户列表"=>__BASEPATH.'iha/index/index');
			message("编辑失败",$url);
		}
	}
}
?>