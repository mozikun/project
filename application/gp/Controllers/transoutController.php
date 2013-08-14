<?php 
class gp_transoutController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'library/Models/patient_referral_out.php';//双向转诊转出
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
		$patient_referral_out  = new Tpatient_referral_out();
		$individual = new Tindividual_core();
		//$patient_referral_out->debugLevel(9);
		$patient_referral_out->joinAdd('inner',$patient_referral_out,$individual,'id','uuid');
		if(!empty($realname)){
				 $patient_referral_out->whereAdd("name='$realname'");	
			}
		if(!empty($nowdate)){
				 $patient_referral_out->whereAdd("patient_referral_out.fill_time='$nowdate'");
			}
		$patient_referral_out->find();
		$arrArg = array();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$patient_referral_out->count(),$pageCurrent,__goodsListRowOfPage,__BASEPATH.'gp/diagnosis/listdiagnosis/realname/'.urlencode($realname).'/nowdate/'.$this->_request->getParam('nowdate').'/page/',3,$arrArg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		if($patient_referral_out->count()>0){
		    $patient_referral_outlist   = new Tpatient_referral_out();
			$individualcore  = new Tindividual_core();
			//$patient_referral_outlist->debugLevel(9);
			$patient_referral_outlist->joinAdd('inner',$patient_referral_outlist,$individualcore,'id','uuid');
			//处理搜索
			if(!empty($realname)){
				 $patient_referral_outlist->whereAdd("name='$realname'");	
				}
			if(!empty($nowdate)){
				 $patient_referral_outlist->whereAdd("patient_referral_out.fill_time='$nowdate'");
				}
			$patient_referral_outlist->orderby("patient_referral_out.fill_time DESC");
			$patient_referral_outlist->limit($startnum,__ROWSOFPAGE);
			$patient_referral_outlist->find();
			$patient_referral_outlistarr   = array();
			$patient_referral_outlistcount = 0 ;
			while($patient_referral_outlist->fetch()){
			    $patient_referral_outlistarr[$patient_referral_outlistcount]['name']         = $individualcore->name;
			    $patient_referral_outlistarr[$patient_referral_outlistcount]['urlencodename']= urlencode($individualcore->name);
			    $patient_referral_outlistarr[$patient_referral_outlistcount]['iha_id']       = $individualcore->standard_code_2;
			    $doctor_obj																	 = empty($patient_referral_outlist->in_of_doctor)?'':get_staff_info($patient_referral_outlist->in_of_doctor);
			    $doctor_name															 	 = empty($doctor_obj)?'':$doctor_obj[1]->name_real;
			   // print_r($doctor_archive);
			    $patient_referral_outlistarr[$patient_referral_outlistcount]['doctor_name']  = $doctor_name;
			    $patient_referral_outlistarr[$patient_referral_outlistcount]['current_time'] = $patient_referral_outlist->fill_time==""?'':adodb_date('Y-m-d',$patient_referral_outlist->fill_time);
			    $patient_referral_outlistarr[$patient_referral_outlistcount]['uuid']         = $patient_referral_outlist->uuid;
				$patient_referral_outlistcount++;
			}
			$this->view->diagnosislistarr = $patient_referral_outlistarr;
			$page = $links->subPageCss2();
  	    	$this->view->page   = $page;
		}else{
			$msg = '当前还没有任何数据 ！';
			$this->view->msg = $msg;
		}
		$this->view->delname        = $realname;
		$this->view->deldate        = adodb_date('Y-m-d',$nowdate);
		$this->view->nunumber       = $patient_referral_out->count();
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
		/**
		 * 表注释:科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9=>信息资料室,10=>其它
		
		 **/
		$section_office_id=array('0'=>'','1'=>'预防保健科','2'=>'全科医疗科','3'=>'药房','4'=>'检验室','5'=>'X光室','6'=>'B超室','7'=>'心电图室','8'=>'消毒供应室','9'=>'信息资料室','10'=>'其它');
		$this->view->section_office_id_options =$section_office_id; //科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9=>信息资料室,10=>其它
		
		if(empty($uuid)){
			//添加
			if(empty($individual_session->uuid)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			$this->view->name 			= $individual_session->name;//姓名
			$sex_code					= array_search_for_other($individual_session->sex,$sex);//性别非标准的代码集
			$this->view->sex 			= empty($sex_code)?'':$sex[$sex_code][1];//性别
			$this->view->age 			= $individual_session->age;//年龄
			$this->view->serial_num 	= $individual_session->standard_code_1;//档案编号
			$this->view->faminy_add 	= $individual_session->address;//家庭地址
			$this->view->telphone		= $individual_session->phone_number;//联系电话
			$this->view->referral_out_time_year	= date("Y");//年
			$this->view->referral_out_time_month=date("m");//月
			$this->view->referral_out_time_day	=date("d");//日
			$this->view->stub_unit  	= '';//转入单位
			/**
			 * 表注释:科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9=>信息资料室,10=>其它
			 * 
			 * 
			 **/
			$section_office_id=array('0'=>'','1'=>'预防保健科','2'=>'全科医疗科','3'=>'药房','4'=>'检验室','5'=>'X光室','6'=>'B超室','7'=>'心电图室','8'=>'消毒供应室','9'=>'信息资料室','10'=>'其它');
			$this->view->section_office_id_options =$section_office_id; //科室ID|select|1=>预防保健科,2=>全科医疗科,3=>药房,4=>检验室,5=>X光室,6=>B超室,7=>心电图室,8=>消毒供应室,9=>信息资料室,10=>其它
			$this->view->section_office_id_current = 0;
			$this->view->in_of_doctor	= '';//接诊医生

			$this->view->stub_of_doctor = $this->user['name_real'];//存根转诊医生
			$this->view->stub_fill_time_year = date("Y");//存根填表年
			$this->view->stub_fill_time_month=date("m");//存根填表月
			$this->view->stub_fill_time_day  =date("d");//存根填表日
			$this->view->dst_org_name 	= '';//转到机构名
			$this->view->firefight 		= '';//初步诊断
			$this->view->present_illness= '';//主要现病史
			$this->view->past_history 	= '';//主要既往史
			$this->view->course_and_treatment = '';//治疗经过
			$region_users				= region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users	= $region_users;
			$this->view->out_of_doctor	= $this->user['uuid'];//转诊医生
			$this->view->phone 			= '';//联系电话
			$this->view->my_org_name 	= $this->user['org_zh_name'];//自己的机构名
			$this->view->my_org_code 	= $this->user['org_id'];//自己的机构名
			$this->view->fill_time_year = date("Y");//转出填表年
			$this->view->fill_time_month=date("m");//转出填表月
			$this->view->fill_time_day  =date("d");//转出填表日

		}else{
			//修改
			$patient_referral_out       = 	new Tpatient_referral_out();
			$individual_core  			= 	new Tindividual_core();
			//$patient_referral_out->debugLevel(9);
			$patient_referral_out->joinAdd('inner',$patient_referral_out,$individual_core,'id','uuid');
			$patient_referral_out->whereAdd("patient_referral_out.uuid='{$uuid}'");
			//$patient_referral_out->debugLevel(4);
			$patient_referral_out->find();
			$patient_referral_out->fetch();
			$this->view->uuid 			= 	$patient_referral_out->uuid;//编号
			$this->view->staff_id 		= 	$patient_referral_out->staff_id;//医生档案号
			$this->view->id 			= 	$patient_referral_out->id;//个人档案号
			$this->view->name 			= $individual_core->name;//姓名
			$sex_code					= array_search_for_other($individual_core->sex,$sex);//性别非标准的代码集
			$this->view->sex 			= empty($sex_code)?'':$sex[$sex_code][1];//性别

			$this->view->serial_num 	= $individual_core->standard_code_1;//档案编号
			$this->view->faminy_add 	= $individual_core->address;//家庭地址
			$this->view->telphone		= $individual_core->phone_number;//联系电话
			$this->view->created 		= 	$patient_referral_out->created;//添加记录时间
			$this->view->age 			= 	$patient_referral_out->age;//年龄

			$referral_out_time_year			=	empty($patient_referral_out->referral_out_time)?'':date("Y",$patient_referral_out->referral_out_time);//存根转诊时间
			$referral_out_time_month		=	empty($patient_referral_out->referral_out_time)?'':date("m",$patient_referral_out->referral_out_time);//存根转诊时间
			$referral_out_time_day			=	empty($patient_referral_out->referral_out_time)?'':date("d",$patient_referral_out->referral_out_time);//存根转诊时间
			$this->view->referral_out_time_year= 	$referral_out_time_year;//存根转诊时间
			$this->view->referral_out_time_month= 	$referral_out_time_month;//存根转诊时间
			$this->view->referral_out_time_day = 	$referral_out_time_day;//存根转诊时间

			$this->view->stub_unit_code	= 	$patient_referral_out->stub_unit;//转入单位
			$org_obj					=	empty($patient_referral_out->stub_unit)?'':get_org_info($patient_referral_out->stub_unit);//机构对像
			$this->view->stub_unit		= 	empty($org_obj)?'':$org_obj->zh_name;//转到机构名

			$this->view->section_office_id_current = $patient_referral_out->stub_doccol;//转入科室
		
			$this->view->in_of_doctor 	= 	$patient_referral_out->in_of_doctor;//接诊医生
			$staff_info					=	empty($patient_referral_out->in_of_doctor)?'':get_staff_info($patient_referral_out->in_of_doctor);
			$this->view->in_of_doctor_name	=	empty($staff_info)?'':$staff_info[1]->name_real;
			
			$this->view->stub_of_doctor = 	$patient_referral_out->stub_of_doctor;//存根转诊医生

			$stub_fill_time_year			=	empty($patient_referral_out->stub_fill_time)?'':date("Y",$patient_referral_out->stub_fill_time);//存根填表时间
			$stub_fill_time_month			=	empty($patient_referral_out->stub_fill_time)?'':date("m",$patient_referral_out->stub_fill_time);//存根填表时间
			$stub_fill_time_day				=	empty($patient_referral_out->stub_fill_time)?'':date("d",$patient_referral_out->stub_fill_time);//存根填表时间
			$this->view->stub_fill_time_year= 	$stub_fill_time_year;//存根填表时间
			$this->view->stub_fill_time_month= 	$stub_fill_time_month;//存根填表时间
			$this->view->stub_fill_time_day = 	$stub_fill_time_day;//存根填表时间


			$this->view->dst_org_code 	= 	$patient_referral_out->dst_org_name;//转到机构名
			$org_obj					=	empty($patient_referral_out->dst_org_name)?'':get_org_info($patient_referral_out->dst_org_name);//机构对像
			$this->view->dst_org_name 	= 	empty($org_obj)?'':$org_obj->zh_name;//转到机构名

			$this->view->firefight 		= 	trim($patient_referral_out->firefight);//初步诊断
			$this->view->present_illness= 	trim($patient_referral_out->present_illness);//主要现病史
			$this->view->past_history 	= 	trim($patient_referral_out->past_history);//主要既往史
			$this->view->course_and_treatment = trim($patient_referral_out->course_and_treatment);//治疗经过

			//
			$region_users				= 	empty($this->user['current_region_path_domain'])?'':region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users	= 	$region_users;
			$this->view->out_of_doctor  = 	$patient_referral_out->out_of_doctor;//转诊医生

			$this->view->phone			= 	$patient_referral_out->phone;//联系电话

			$this->view->my_org_code 	= 	$patient_referral_out->my_org_name;//自己的机构名

			$org_obj					=	empty($patient_referral_out->my_org_name)?'':get_org_info($patient_referral_out->my_org_name);//机构对像
			$this->view->my_org_name 	=	empty($org_obj)?'':$org_obj->zh_name;//机构名

			$fill_time_year				=	empty($patient_referral_out->fill_time)?'':date("Y",$patient_referral_out->fill_time);//转出填表时间
			$fill_time_month			=	empty($patient_referral_out->fill_time)?'':date("m",$patient_referral_out->fill_time);//转出填表时间
			$fill_time_day				=	empty($patient_referral_out->fill_time)?'':date("d",$patient_referral_out->fill_time);//转出填表时间
			$this->view->fill_time_year = 	$fill_time_year;//转出填表时间
			$this->view->fill_time_month= 	$fill_time_month;//转出填表时间
			$this->view->fill_time_day 	= 	$fill_time_day;//转出填表时间

		}

		$this->view->display('add.html');
	}
	/**
	 * 更新双向转诊转出
	 *
	 */
	public function updateAction(){

		$uuid 									= $this->_request->getParam('uuid');//编号
		$patient_referral_out					= new Tpatient_referral_out();

		$patient_referral_out->age 				= $this->_request->getParam('age');//年龄

		$referral_out_time 						= strtotime($this->_request->getParam('referral_out_time_year').'-'.$this->_request->getParam('referral_out_time_month').'-'.$this->_request->getParam('referral_out_time_day'));

		$patient_referral_out->referral_out_time = $referral_out_time;//存根转诊时间

		$patient_referral_out->stub_unit 		= $this->_request->getParam('stub_unit_code');//转入单位

		$patient_referral_out->stub_doccol 		= $this->_request->getParam('stub_doccol');//转入科室

		$patient_referral_out->in_of_doctor 	= $this->_request->getParam('in_of_doctor');//接诊医生

		$patient_referral_out->stub_of_doctor 	= $this->_request->getParam('stub_of_doctor');//存根转诊医生

		$stub_fill_time 						= strtotime($this->_request->getParam('stub_fill_time_year').'-'.$this->_request->getParam('stub_fill_time_month').'-'.$this->_request->getParam('stub_fill_time_day'));//存根填表时间

		$patient_referral_out->stub_fill_time 	= $stub_fill_time;//存根填表时间

		$patient_referral_out->dst_org_name 	= $this->_request->getParam('dst_org_code');//转到机构名

		$patient_referral_out->firefight 		= trim($this->_request->getParam('firefight'));//初步诊断

		$patient_referral_out->present_illness  =trim($this->_request->getParam('present_illness'));//主要现病史

		$patient_referral_out->past_history 	= trim($this->_request->getParam('past_history'));//主要既往史

		$patient_referral_out->course_and_treatment = trim($this->_request->getParam('course_and_treatment'));//治疗经过

		$patient_referral_out->out_of_doctor 	= $this->_request->getParam('out_of_doctor');//转诊医生

		$patient_referral_out->phone 			= $this->_request->getParam('phone');//联系电话

		$patient_referral_out->my_org_name 		= $this->_request->getParam('my_org_code');//自己的机构名
		$fill_time								= strtotime($this->_request->getParam('fill_time_year').'-'.$this->_request->getParam('fill_time_month').'-'.$this->_request->getParam('fill_time_day'));//转出填表时间
		$patient_referral_out->fill_time 		= $fill_time;//转出填表时间
		$update_token=true;
		if(empty($uuid)){
			//添加
			$uuid						=uniqid("gp",true);//编号

			$patient_referral_out->uuid = $uuid;//编号

			$patient_referral_out->staff_id = $this->user['uuid'];//医生档案号
			$individual_session 		= new Zend_Session_Namespace("individual_core");

			$patient_referral_out->id 	= $individual_session->uuid;//个人档案号

			$patient_referral_out->created = time();//添加记录时间
			//$patient_referral_out->debugLevel(8);
			$update_token				= $patient_referral_out->insert();

		}else{
			//修改
			$patient_referral_out->whereAdd("uuid='$uuid'");
			$update_token=$patient_referral_out->update();

		}
		if($update_token==true){
			message("更新成功！",array("双向转诊（转出）单列表"=>__BASEPATH.'gp/transout/index',"添加"=>__BASEPATH."gp/transout/add/","修改"=>__BASEPATH."gp/transout/add/uuid/{$uuid}"));
		}else{
			message("更新失败！",array("双向转诊（转出）单列表"=>__BASEPATH.'gp/transout/index',"添加"=>__BASEPATH."gp/transout/add/","修改"=>__BASEPATH."gp/transout/add/uuid/{$uuid}"));
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
				  		$patient_referral_out = new Tpatient_referral_out();
				  		$patient_referral_out->whereAdd("uuid='$v'");
				  		$patient_referral_out->delete();
				  	}
				  	message("批量删除双向转诊（转出）单成功",array("返回记录列表"=>__BASEPATH.'gp/transout/index')); 
				  }
				break;
			case "dellone":
		          $patient_referral_out = new Tpatient_referral_out();
				  $patient_referral_out->whereAdd("uuid='$uuid'");
				  if($patient_referral_out->delete()){
				  	 message("删除双向转诊（转出）单成功",array("返回记录列表"=>__BASEPATH.'gp/transout/index/realnamedel/'.urlencode($realname).'/nowdatedel/'.$nowdate)); 
				  }
				break;
		}
	}
	/**
	 * 根据机构代码找到科室下面的所有医生
	 *
	 */
	public function getusersAction(){
		$org_id				= $this->_request->getParam('org_id','');
		$section_office_id	= $this->_request->getParam('section_office_id','');
		$staff_core=new Tstaff_core();
		$staff_archive=new Tstaff_archive();
		$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
		$staff_core->whereAdd("org_id='{$org_id}'");
		if($section_office_id!=''){
			$staff_core->whereAdd("section_office_id='{$section_office_id}'");//科室
		}
		$staff_core->find();
		//$user_array=array();
		$i=0;
		$user_list='';
		while ($staff_core->fetch()) {
			$user_list.="<option value='$staff_core->id'> $staff_archive->name_real</option>";

		}
		echo $user_list;

	}
	
	



}
?>