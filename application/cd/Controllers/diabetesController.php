<?php 
/*
 * Created By Eric_Zhou
 * Filename: diabetesController.php
 * Date : 2010-08-19
 * Summary : 慢病-2型糖尿病(http://host/cd/)
 * 模块作者 ： Eric_Zhou
 */

class diabetesController extends controller{
	/**
	 * 自动加载
	 */
	public function init(){
		//权限验证
		$this->haveWritePrivilege='';
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/diabetes_core.php";
		require_once __SITEROOT."library/Models/diabetes_symptom.php";
		require_once __SITEROOT."library/Models/diabetes_physical_sign.php";
		require_once __SITEROOT."library/Models/diabetes_lifestyle_guide.php";
		require_once __SITEROOT."library/Models/diabetes_accessory_examine.php";
		require_once __SITEROOT."library/Models/diabetes_patient_referral.php";
		require_once __SITEROOT."library/Models/follow_up_drugs.php";
		require_once __SITEROOT."library/custom/pager.php";
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	/*
	*列表
	*/
	public function listAction(){
		//查看当前选中居民的糖尿病信息
                                      require_once(__SITEROOT."application/cd/models/clinical_history.php");//慢病确症情况
		$individual_session=new Zend_Session_Namespace("individual_core");
		$seeion_id=$individual_session->uuid;
		$individual_name=new Tindividual_core();
		$individual_name->whereAdd("individual_core.uuid='$seeion_id'");
		$individual_name->find(true);
		$this->view->name=$individual_name->name;
		$current_time=time();//获取当前时间
		$before_time=strtotime(date("Y-01-01",time()));//获取年初时间
		$individual = new Tindividual_core();
		$diabetes_core = new Tdiabetes_core();
		$diabetes_core->joinAdd('left',$diabetes_core,$individual,'id','uuid');//关联个人信息
		$diabetes_core->whereAdd("diabetes_core.id='$seeion_id'");
		$diabetes_core->whereAdd("diabetes_core.followup_time>='".$before_time."'");
		$diabetes_core->whereAdd("diabetes_core.followup_time<='".$current_time."'");
		$diabetes_core->orderby("diabetes_core.followup_time ASC");
		$num=$diabetes_core->count();
//		echo $num;
//		$diabetes_core->debugLevel(9);
		$diabetes_core->find();
		$db_array=array();
		$n=0;
		while ($diabetes_core->fetch())
		{
			$db_array[$n]['num']=$n+1;
			$db_array[$n]['uuid']=$diabetes_core->uuid;                                                   
			$db_array[$n]['name']=$individual->name;
			$db_array[$n]['id']=$individual->uuid;
			$n++;
		}
//		print_r($db_array);
		$this->view->db=$db_array;
		//档案状态
        $status_flagArray = array(
            '' => array('0', '请选择'),
            '1' => array('1', '正常档案'),
            '4' => array('2', '临时档案'),
            '6' => array('3', '死亡档案'),
            '8' => array('4', '转出档案'));
        $current_status_flag = $this->_request->getParam('status_flag'); 
        $current_status_flag=$current_status_flag?$current_status_flag:1;
        $status_flag = array();
        $x = 0;
        foreach ($status_flagArray as $key => $value)
        {
            $status_flag[$x]['key'] = $key;
            $status_flag[$x]['value'] = $value['1'];
            if ($current_status_flag == $key)
            {
                $status_flag[$x]['selected'] = 'selected';
            }
            else
            {
                $status_flag[$x]['selected'] = '';
            }
            $x++;
        }
        $this->view->status_flag = $status_flag;
         $submit=$this->_request->getParam('submit'); 
		$search=array();
         $search['startdate']=$this->_request->getParam('startdate');
         $search['status_flag'] = $current_status_flag;
        $search['enddate']=$this->_request->getParam('enddate');
		$search['username']                =$this->_request->getParam('username');//姓名包含拼音
		$search['staff_id']                =($this->_request->getParam('staff_id')=="-9")?"":$this->_request->getParam('staff_id');//建档医生
		$search['standard_code']           =$this->_request->getParam('standard_code');//标准档案号
		$search['identity_number']         =$this->_request->getParam('identity_number');//身份证号
        $search['org_id'] = $this->_request->getParam('org_id')?$this->_request->getParam('org_id'):$this->user['region_id']; //地区          
		$diabetes_corelist   =new Tdiabetes_core();
		$core            =new Tindividual_core();
		$diabetes_corelist->joinAdd('left',$diabetes_corelist,$core,'id','uuid');
		if($search['username']){
			$diabetes_corelist->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if($search['standard_code']){
			$diabetes_corelist->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$diabetes_corelist->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
		if ($search['staff_id'])
		{
			$diabetes_corelist->whereAdd("diabetes_core.followup_doctor = '".$search['staff_id']."'");
		}
         if($search['startdate'])
        {    
            $startdate  = strtotime(trim($this->_request->getParam('startdate')));
            $diabetes_corelist->whereAdd("diabetes_core.followup_time>='".$startdate."'");
        }
        if(!empty($search['status_flag']))
        {
        	$diabetes_corelist->whereAdd("individual_core.status_flag=".$search['status_flag']);
        }
        if($search['enddate'])
        {
            $enddate = strtotime(trim($this->_request->getParam('enddate')));
            $diabetes_corelist->whereAdd("diabetes_core.followup_time<='".$enddate."'");
        }
        $individual_core_region_path_domain = get_region_path(1, $search['org_id']); 
        $diabetes_corelist->whereAdd($individual_core_region_path_domain);
        $diabetes_corelist->selectAdd("distinct diabetes_core.id");
        $nums=$diabetes_corelist->count("distinct diabetes_core.id");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示条数，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'cd/diabetes/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$diabetes_corelist->limit($startnum,__ROWSOFPAGE);
		$diabetes_corelist->find();
		$diabetes_array=array();
		$i=0;
		while ($diabetes_corelist->fetch())
		{ 
			$diabetes_array[$i]['id']        =$diabetes_corelist->id;
			$realtrue  = new Tdiabetes_core();
			$realtrue->whereAdd("id='$diabetes_corelist->id'");
			$realtrue->orderby("followup_time DESC");
			$realtrue->limit(0,1);
			$realtrue->find();
			$realtrue->fetch(true);
			$diabetes_array[$i]['follow_time']=empty($realtrue->followup_time)?"":adodb_date("Y-m-d",$realtrue->followup_time);
			$staff =  new Tstaff_core();
			$staff->whereAdd("id='$realtrue->followup_doctor'");
			$staff->find(true);
			$numbernow = new Tdiabetes_core();
			$numbernow->whereAdd("id='$diabetes_corelist->id'");
			$diabetes_array[$i]['snums']       = $numbernow->count();
			$diabetes_array[$i]['doctor_name'] = $staff->name_login;
			$diabetes_array[$i]['name']        = get_individual_info($diabetes_corelist->id);
			if($this->haveWritePrivilege){			
				$diabetes_array[$i]['ssname']  = $diabetes_array[$i]['name']->name;
			}else{
				$diabetes_array[$i]['ssname']  ='*';
			}
                                                         $is_diabetes = is_clinical_history($diabetes_corelist->id,3);
                                                          if($is_diabetes>0)
                                                          {
                                                              $diabetes_array[$i]['pic_name']= 'hz.png';
                                                          }
                                                          else
                                                          {
                                                              $diabetes_array[$i]['pic_name']= 'no_person.png';
                                                          }
			$i++;
		}
        
        $this->view->assign("startdate",$search['startdate']);
        $this->view->assign("enddate",$search['enddate']);
        $this->view->assign("display",$submit?$submit:'none'); 
		//var_dump($diabetes_array);
		$out = $links->subPageCss2();
		//医生列表
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$search['staff_id']);
		$this->view->assign("pager",$out);
		$this->view->diabetes=$diabetes_array;  
        $this->view->assign('org_id', $search['org_id']);   
        //2013-1-31获取本机构下糖尿病患者，并且未填写确诊日期的
        require_once(__SITEROOT."/library/Models/clinical_history.php");
        $clinical_history=new Tclinical_history();
        $core=new Tindividual_core();
        $core->joinAdd("inner",$core,$clinical_history,"uuid","id");
        $core->whereAdd($individual_core_region_path_domain);
        $core->whereAdd("clinical_history.disease_code='3' and clinical_history.disease_state=1 and (clinical_history.disease_date='' or clinical_history.disease_date is null) and (individual_core.status_flag=1 or individual_core.status_flag=4)");
        $errors=$core->count();
        if($errors)
        {
        	$error_string='<span style="color:red;font-size:14px">本机构存在【'.$errors.'】名糖尿病患者未正确填写确诊日期，为了统计结果精确，请<a href="'.$this->_request->getBasePath().'cd/diabetes/nodate">查看未填写确诊日期患者列表</a>并依次填写确诊日期。</span>';
            $this->view->error_string=$error_string;
        }     
		$this->view->display('diabetes_list.html');
	}
	/*
	*2013-1-31 显示未填写确诊时间的慢病患者
	*/
	public function nodateAction()
	{
		require_once __SITEROOT . '/library/Models/clinical_history.php';
        require_once __SITEROOT . "/library/custom/pager.php";
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        require_once __SITEROOT . '/library/custom/comm_function.php';
        $search['org_id'] = $this->_request->getParam('org_id')?$this->_request->getParam('org_id'):$this->user['region_id']; //地区
        $individual_core_region_path_domain = get_region_path(1, $search['org_id']);
        $core = new Tindividual_core();
        $clinical_history = new Tclinical_history();
        $core->whereAdd($individual_core_region_path_domain);
        $core->joinAdd('inner', $core, $clinical_history, 'uuid','id');
        $core->whereAdd("clinical_history.disease_code='3' and clinical_history.disease_state=1 and (clinical_history.disease_date='' or clinical_history.disease_date is null) and (individual_core.status_flag=1 or individual_core.status_flag=4)");
        $nums = $core->count();
        //$core->whereAdd("individual_core.updated>0");
        //showtimer();
        $pageCurrent = intval($this->_request->getParam('page'));
        $pageCurrent = $pageCurrent ? $pageCurrent : 1;
        //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,
            __BASEPATH . 'cd/diabetes/nodate/page/', 2, $search);
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = __ROWSOFPAGE * ($pageCurrent - 1); //计算开始记录数
        $core->selectAdd("
		individual_core.uuid as uuid,
		individual_core.name as name,
		individual_core.sex as sex,
		individual_core.family_number as family_number,
		individual_core.address as address,
		individual_core.staff_id as staff_id,
		individual_core.standard_code_1 as standard_code_1,
		individual_core.identity_number as identity_number,
		individual_core.phone_number as phone_number,
		individual_core.date_of_birth as date_of_birth,
		individual_core.criteria_rate as criteria_rate
		");

        $core->orderby("individual_core.updated DESC");
        //处理分页
        $core->limit($startnum, __ROWSOFPAGE);
        $core->find();
        $indiv = array();
        $i = 0;
        while ($core->fetch())
        {
            $indiv[$i]['uuid'] = $core->uuid;
            if ($this->haveWritePrivilege)
            {
                $indiv[$i]['name'] = $core->name;
                $indiv[$i]['householder_name'] = get_househoder_name($core->family_number);
                $indiv[$i]['contact_number'] = $core->phone_number;
            }
            else
            {
                $indiv[$i]['name'] = $this->mask_char;
                $indiv[$i]['householder_name'] = $this->mask_char;
                $indiv[$i]['contact_number'] = $this->mask_char;
            }
            //2011-08-31 luo 根据社保与身份证号合一的精神，决定在此处显示更有实际用处的身份证号
            $indiv[$i]['standard_code'] = $core->standard_code_1;
            $indiv[$i]['standard_code'] = $core->identity_number;
            //$indiv[$i]['standard_code']=$core->region_path.'|'.$core->standard_code_1;
            $indiv[$i]['address'] = $core->address;
            $indiv[$i]['sex'] = @$sex[array_search_for_other($core->sex, $sex)][1];
            $indiv[$i]['date_of_birth'] = adodb_date("Y-m-d", $core->date_of_birth);
            $indiv[$i]['age'] = getBirthday($core->date_of_birth, time());
            $indiv[$i]['criteria_rate'] = $core->criteria_rate * 100;
            $indiv[$i]['staff_id'] = $core->staff_id;
            $indiv[$i]['staff_name'] = get_staff_name_byid($core->staff_id);
            $i++;
        }
        $out = $links->subPageCss2();
        $this->view->assign("page", $pageCurrent);
        $this->view->assign("para_page", $pageCurrent);
        $this->view->assign("pager", $out);
        $this->view->assign("iha", $indiv);
        $individual_session = new Zend_Session_Namespace("individual_core"); 
        $this->view->assign("individual_current", $individual_session);
        $this->view->display("nodate.html");
	}
	/*
	* 个人随访列表
	*/
	public function indexAction(){
		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		$id=$this->_request->getParam("id");
		//$uuid=$this->_request->getParam("uuid");
		$this->view->id = $id;
		if($id){
			$individual_inf=get_individual_info($id);//取得个人信息中所有信息
			if($this->haveWritePrivilege){
				$this->view->user_name = $individual_inf->name;//居民姓名
				$this->view->identity_number = $individual_inf->identity_number;//身份证号
				$this->view->standard_code = $individual_inf->standard_code_1;//标准档案号
			}else{
				$this->view->user_name = '*';//居民姓名
				$this->view->standard_code = '*';//标准档案号
				$this->view->identity_number = '*';//身份证号
			}
			$this->view->type_of_followup = $type_of_followup;//随访方式
			$this->view->diabetes_symptom = $diabetes_symptom;//症状
			$this->view->arteria_dorsalis_pedis = $arteria_dorsalis_pedis;//足背动脉搏动
			$this->view->heart_adjustment = $heart_adjustment;//心理调整
			$this->view->complian = $complian;//遵医行为
			$this->view->compliance = $compliance;//服药依从性
			$this->view->adverse_drug_reaction = $adverse_drug_reaction;//药物不良反应
			$this->view->reactive_hypoglycemia = $reactive_hypoglycemia;//低血糖反应
			$this->view->followup_classification = $followup_classification;//随访方式
			$diabetes_core = new Tdiabetes_core();
			$diabetes_core->whereAdd("id='$id'");
			$nums=$diabetes_core->count();//
			$diabetes_core->orderby("created DESC");
			$diabetes_core->orderby("followup_time DESC");
			$diabetes_core->find();
			$diabetes_array = $accessory_examine_array = $lifestyle_guide_array = $diabetes_symptom_array = $physical_sign_array = $patient_referral_array = $symptom_other_array = array();
			$i=0;
			while ($diabetes_core->fetch()){
				$core_id = $diabetes_core->id;
				$core_uuid = $diabetes_core->uuid;
				//主表
				$diabetes_array[$i]['followup_time'] =empty($diabetes_core->followup_time)?'': adodb_date("Y年m月d日",$diabetes_core->followup_time);
				$diabetes_array[$i]['type_of_followup'] = $diabetes_core->type_of_followup;
				$diabetes_array[$i]['compliance'] = $diabetes_core->compliance;
				$diabetes_array[$i]['insulin'] = $diabetes_core->insulin;//INSULIN
			    $diabetes_array[$i]['insulin_class'] = $diabetes_core->insulin_class;
				$diabetes_array[$i]['adverse_drug_reaction'] = $diabetes_core->adverse_drug_reaction;
				$diabetes_array[$i]['reactive_hypoglycemia'] = $diabetes_core->reactive_hypoglycemia;
				$diabetes_array[$i]['followup_classification'] = $diabetes_core->followup_classification;
				$myfollowtime    =  adodb_date("Y年m月d日",$diabetes_core->time_of_next_followup);
				//echo $myfollowtime;
				$diabetes_array[$i]['time_of_next_followup'] = empty($diabetes_core->time_of_next_followup)?"":$myfollowtime;
				//找出当前医生
				$staff =  new Tstaff_core();
				$staff->whereAdd("id='$diabetes_core->followup_doctor'");
				$staff->find(true);
				$diabetes_array[$i]['followup_doctor'] = $staff->name_login;
				$diabetes_array[$i]['uuid'] = $diabetes_core->uuid;
				$hypertension_array[$i]['drug']=get_follow_drug($diabetes_core->uuid,'diabetes');//获取药品信息
				//症状表
				$diabetes_symptom_obj = new Tdiabetes_symptom();
				$diabetes_symptom_obj->whereAdd("id='$core_id'");
				$diabetes_symptom_obj->whereAdd("uuid='$core_uuid'");
				$diabetes_symptom_obj->find();
				$diabetes_symptom_obj->fetch();
				$symptom_temp = $diabetes_symptom_obj->diabetes_symptom;
				$symptom_temp_arr = @explode('|',$symptom_temp);
				//症状
				foreach($symptom_temp_arr as $k=>$v){
					$diabetes_symptom_array[$i][]['sym'] = array_search_for_other($v,$diabetes_symptom);
				}
				$symptom_other_array[$i]['sym_other'] = $diabetes_symptom_obj->symptom_other;//症状其他
				//体征
				$diabetes_physical_sign = new Tdiabetes_physical_sign();
				$diabetes_physical_sign->whereAdd("id='$core_id'");
				$diabetes_physical_sign->whereAdd("uuid='$core_uuid'");
				$diabetes_physical_sign->find();
				$diabetes_physical_sign->fetch();
				$physical_sign_array[$i]['blood_pressure'] = $diabetes_physical_sign->blood_pressure;
				$physical_sign_array[$i]['diastolic_blood_pressure'] = $diabetes_physical_sign->diastolic_blood_pressure;               
				$physical_sign_array[$i]['height'] = $diabetes_physical_sign->height;
				$physical_sign_array[$i]['height_next'] = $diabetes_physical_sign->height_next;
				$physical_sign_array[$i]['weight'] = $diabetes_physical_sign->weight;
				$physical_sign_array[$i]['expectative_weight'] = $diabetes_physical_sign->expectative_weight;
				$physical_sign_array[$i]['bmi'] = $diabetes_physical_sign->bmi;
				$physical_sign_array[$i]['bmi_next'] = $diabetes_physical_sign->bmi_next;
				$physical_sign_array[$i]['arteria_dorsalis_pedis'] = $diabetes_physical_sign->arteria_dorsalis_pedis;
				$physical_sign_array[$i]['other'] = $diabetes_physical_sign->other;
				//生活方式指导
				$diabetes_lifestyle_guide = new Tdiabetes_lifestyle_guide();
				$diabetes_lifestyle_guide->whereAdd("id='$core_id'");
				$diabetes_lifestyle_guide->whereAdd("uuid='$core_uuid'");
				$diabetes_lifestyle_guide->find();
				$diabetes_lifestyle_guide->fetch();
				$lifestyle_guide_array[$i]['smoking'] = $diabetes_lifestyle_guide->smoking;
				$lifestyle_guide_array[$i]['expert_smoking'] = $diabetes_lifestyle_guide->expert_smoking;
				$lifestyle_guide_array[$i]['drinking'] = $diabetes_lifestyle_guide->drinking;
				$lifestyle_guide_array[$i]['expert_drinking'] = $diabetes_lifestyle_guide->expert_drinking;
				$lifestyle_guide_array[$i]['frequency'] = $diabetes_lifestyle_guide->frequency;
				$lifestyle_guide_array[$i]['expert_frequency'] = $diabetes_lifestyle_guide->expert_frequency;
				$lifestyle_guide_array[$i]['frequency_time'] = $diabetes_lifestyle_guide->frequency_time;
				$lifestyle_guide_array[$i]['expert_frequency_time'] = $diabetes_lifestyle_guide->expert_frequency_time;
				$lifestyle_guide_array[$i]['main_course'] = $diabetes_lifestyle_guide->main_course;
				$lifestyle_guide_array[$i]['expert_main_course'] = $diabetes_lifestyle_guide->expert_main_course;
				$lifestyle_guide_array[$i]['heart_adjustment'] = $diabetes_lifestyle_guide->heart_adjustment;
				$lifestyle_guide_array[$i]['complian'] = $diabetes_lifestyle_guide->complian;
				//辅助检查
				$diabetes_accessory_examine = new Tdiabetes_accessory_examine();
				$diabetes_accessory_examine->whereAdd("id='$core_id'");
				$diabetes_accessory_examine->whereAdd("uuid='$core_uuid'");
				$diabetes_accessory_examine->find();
				$diabetes_accessory_examine->fetch();
				$accessory_examine_array[$i]['fasting_bloodglucose'] = $diabetes_accessory_examine->fasting_bloodglucose;
				$accessory_examine_array[$i]['hbclc'] = $diabetes_accessory_examine->hbclc;
				$accessory_examine_array[$i]['eamination_time'] = $diabetes_accessory_examine->eamination_time;
				$accessory_examine_array[$i]['eaminat_mot'] =!empty($diabetes_accessory_examine->eamination_time)? adodb_date('m',$diabetes_accessory_examine->eamination_time):" ";
				$accessory_examine_array[$i]['eaminat_day'] =!empty($diabetes_accessory_examine->eamination_time)? adodb_date('d',$diabetes_accessory_examine->eamination_time):" ";
				$accessory_examine_array[$i]['eamination_info'] = $diabetes_accessory_examine->eamination_info;
				//转诊
				$diabetes_patient_referral = new Tdiabetes_patient_referral();
				$diabetes_patient_referral->whereAdd("id='$core_id'");
				$diabetes_patient_referral->whereAdd("uuid='$core_uuid'");
				$diabetes_patient_referral->find();
				$diabetes_patient_referral->fetch();
				$patient_referral_array[$i]['reason'] = $diabetes_patient_referral->reason;
				$patient_referral_array[$i]['organization'] = $diabetes_patient_referral->organization;

				
				$i++;
			}
			$this->view->diabetes_symptom_array = $diabetes_symptom_array;
			$this->view->symptom_other_array = $symptom_other_array;
			$this->view->diabetes_array = $diabetes_array;
			$this->view->physical_sign_array = $physical_sign_array;
			$this->view->lifestyle_guide_array = $lifestyle_guide_array;
			$this->view->accessory_examine_array = $accessory_examine_array;
			$this->view->patient_referral_array = $patient_referral_array;
			$this->view->hypertension_array = $hypertension_array;
			$this->view->nums = $nums;
			$this->view->display('diabetes_table.html');
		}else{
			$url=array("糖尿病随访记录列表"=>__BASEPATH.'cd/diabetes/list',"用户列表"=>__BASEPATH.'iha/index/index');
			message("查看糖尿病随访记录详细信息失败。",$url);
		}
	}
	/**
	 * 打印糖尿病随访
	 */
	public function printAction()
	{
		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		$id=$this->_request->getParam("id");
		$uuid=$this->_request->getParam("uuid");
		$this->view->id = $id;
		if($id){
			$individual_inf=get_individual_info($id);//取得个人信息中所有信息
			if($this->haveWritePrivilege){
				$this->view->user_name = $individual_inf->name;//居民姓名
				$this->view->identity_number = $individual_inf->identity_number;//身份证号
				$this->view->standard_code = $individual_inf->standard_code_1;//标准档案号
			}else{
				$this->view->user_name = '*';//居民姓名
				$this->view->standard_code = '*';//标准档案号
				$this->view->identity_number = '*';//身份证号
			}
			$this->view->type_of_followup = $type_of_followup;//随访方式
			$this->view->diabetes_symptom = $diabetes_symptom;//症状
			$this->view->arteria_dorsalis_pedis = $arteria_dorsalis_pedis;//足背动脉搏动
			$this->view->heart_adjustment = $heart_adjustment;//心理调整
			$this->view->complian = $complian;//遵医行为
			$this->view->compliance = $compliance;//服药依从性
			$this->view->adverse_drug_reaction = $adverse_drug_reaction;//药物不良反应
			$this->view->reactive_hypoglycemia = $reactive_hypoglycemia;//低血糖反应
			$this->view->followup_classification = $followup_classification;//随访方式
			$diabetes_core = new Tdiabetes_core();
			$diabetes_core->whereAdd("id='$id'");
			$diabetes_core->whereAdd("uuid='$uuid'");
			$nums=$diabetes_core->count();//
			$diabetes_core->orderby("created DESC");
			$diabetes_core->find();
			$diabetes_array = $accessory_examine_array = $lifestyle_guide_array = $diabetes_symptom_array = $physical_sign_array = $patient_referral_array = $symptom_other_array = array();
			$i=0;
			while ($diabetes_core->fetch()){
				$core_id = $diabetes_core->id;
				$core_uuid = $diabetes_core->uuid;
				//主表
				$diabetes_array[$i]['followup_time'] =empty($diabetes_core->followup_time)?'': adodb_date("Y年m月d日",$diabetes_core->followup_time);
				$diabetes_array[$i]['type_of_followup'] = $diabetes_core->type_of_followup;
				$diabetes_array[$i]['compliance'] = $diabetes_core->compliance;
				$diabetes_array[$i]['insulin'] = $diabetes_core->insulin;//INSULIN
			    $diabetes_array[$i]['insulin_class'] = $diabetes_core->insulin_class;
				$diabetes_array[$i]['adverse_drug_reaction'] = $diabetes_core->adverse_drug_reaction;
				$diabetes_array[$i]['reactive_hypoglycemia'] = $diabetes_core->reactive_hypoglycemia;
				$diabetes_array[$i]['followup_classification'] = $diabetes_core->followup_classification;
				$myfollowtime    =  adodb_date("Y年m月d日",$diabetes_core->time_of_next_followup);
				//echo $myfollowtime;
				$diabetes_array[$i]['time_of_next_followup'] = empty($diabetes_core->time_of_next_followup)?"":$myfollowtime;
				//找出当前医生
				$staff =  new Tstaff_core();
				$staff->whereAdd("id='$diabetes_core->followup_doctor'");
				$staff->find(true);
				$diabetes_array[$i]['followup_doctor'] = $staff->name_login;
				$diabetes_array[$i]['uuid'] = $diabetes_core->uuid;
				$hypertension_array[$i]['drug']=get_follow_drug($diabetes_core->uuid,'diabetes');//获取药品信息
				//症状表
				$diabetes_symptom_obj = new Tdiabetes_symptom();
				$diabetes_symptom_obj->whereAdd("id='$core_id'");
				$diabetes_symptom_obj->whereAdd("uuid='$core_uuid'");
				$diabetes_symptom_obj->find();
				$diabetes_symptom_obj->fetch();
				$symptom_temp = $diabetes_symptom_obj->diabetes_symptom;
				$symptom_temp_arr = @explode('|',$symptom_temp);
				//症状
				foreach($symptom_temp_arr as $k=>$v){
					$diabetes_symptom_array[$i][]['sym'] = array_search_for_other($v,$diabetes_symptom);
				}
				$symptom_other_array[$i]['sym_other'] = $diabetes_symptom_obj->symptom_other;//症状其他
				//体征
				$diabetes_physical_sign = new Tdiabetes_physical_sign();
				$diabetes_physical_sign->whereAdd("id='$core_id'");
				$diabetes_physical_sign->whereAdd("uuid='$core_uuid'");
				$diabetes_physical_sign->find();
				$diabetes_physical_sign->fetch();
				$physical_sign_array[$i]['blood_pressure'] = $diabetes_physical_sign->blood_pressure;
				$physical_sign_array[$i]['diastolic_blood_pressure'] = $diabetes_physical_sign->diastolic_blood_pressure;
				$physical_sign_array[$i]['weight'] = $diabetes_physical_sign->weight;
				$physical_sign_array[$i]['expectative_weight'] = $diabetes_physical_sign->expectative_weight;
				$physical_sign_array[$i]['bmi'] = $diabetes_physical_sign->bmi;
				$physical_sign_array[$i]['bmi_next'] = $diabetes_physical_sign->bmi_next;
				$physical_sign_array[$i]['arteria_dorsalis_pedis'] = $diabetes_physical_sign->arteria_dorsalis_pedis;
				$physical_sign_array[$i]['other'] = $diabetes_physical_sign->other;
				//生活方式指导
				$diabetes_lifestyle_guide = new Tdiabetes_lifestyle_guide();
				$diabetes_lifestyle_guide->whereAdd("id='$core_id'");
				$diabetes_lifestyle_guide->whereAdd("uuid='$core_uuid'");
				$diabetes_lifestyle_guide->find();
				$diabetes_lifestyle_guide->fetch();
				$lifestyle_guide_array[$i]['smoking'] = $diabetes_lifestyle_guide->smoking;
				$lifestyle_guide_array[$i]['expert_smoking'] = $diabetes_lifestyle_guide->expert_smoking;
				$lifestyle_guide_array[$i]['drinking'] = $diabetes_lifestyle_guide->drinking;
				$lifestyle_guide_array[$i]['expert_drinking'] = $diabetes_lifestyle_guide->expert_drinking;
				$lifestyle_guide_array[$i]['frequency'] = $diabetes_lifestyle_guide->frequency;
				$lifestyle_guide_array[$i]['expert_frequency'] = $diabetes_lifestyle_guide->expert_frequency;
				$lifestyle_guide_array[$i]['frequency_time'] = $diabetes_lifestyle_guide->frequency_time;
				$lifestyle_guide_array[$i]['expert_frequency_time'] = $diabetes_lifestyle_guide->expert_frequency_time;
				$lifestyle_guide_array[$i]['main_course'] = $diabetes_lifestyle_guide->main_course;
				$lifestyle_guide_array[$i]['expert_main_course'] = $diabetes_lifestyle_guide->expert_main_course;
				$lifestyle_guide_array[$i]['heart_adjustment'] = $diabetes_lifestyle_guide->heart_adjustment;
				$lifestyle_guide_array[$i]['complian'] = $diabetes_lifestyle_guide->complian;
				//辅助检查
				$diabetes_accessory_examine = new Tdiabetes_accessory_examine();
				$diabetes_accessory_examine->whereAdd("id='$core_id'");
				$diabetes_accessory_examine->whereAdd("uuid='$core_uuid'");
				$diabetes_accessory_examine->find();
				$diabetes_accessory_examine->fetch();
				$accessory_examine_array[$i]['fasting_bloodglucose'] = $diabetes_accessory_examine->fasting_bloodglucose;
				$accessory_examine_array[$i]['hbclc'] = $diabetes_accessory_examine->hbclc;
				$accessory_examine_array[$i]['eamination_time'] = $diabetes_accessory_examine->eamination_time;
				$accessory_examine_array[$i]['eaminat_mot'] = adodb_date('m',$diabetes_accessory_examine->eamination_time);
				$accessory_examine_array[$i]['eaminat_day'] = adodb_date('d',$diabetes_accessory_examine->eamination_time);
				$accessory_examine_array[$i]['eamination_info'] = $diabetes_accessory_examine->eamination_info;
				//转诊
				$diabetes_patient_referral = new Tdiabetes_patient_referral();
				$diabetes_patient_referral->whereAdd("id='$core_id'");
				$diabetes_patient_referral->whereAdd("uuid='$core_uuid'");
				$diabetes_patient_referral->find();
				$diabetes_patient_referral->fetch();
				$patient_referral_array[$i]['reason'] = $diabetes_patient_referral->reason;
				$patient_referral_array[$i]['organization'] = $diabetes_patient_referral->organization;

				
				$i++;
			}
			$this->view->diabetes_symptom_array = $diabetes_symptom_array;
			$this->view->symptom_other_array = $symptom_other_array;
			$this->view->diabetes_array = $diabetes_array;
			$this->view->physical_sign_array = $physical_sign_array;
			$this->view->lifestyle_guide_array = $lifestyle_guide_array;
			$this->view->accessory_examine_array = $accessory_examine_array;
			$this->view->patient_referral_array = $patient_referral_array;
			$this->view->hypertension_array = $hypertension_array;
			$this->view->nums = $nums;
			$this->view->display("diabetes_print.html");
		}else{
			$url=array("糖尿病随访记录列表"=>__BASEPATH.'cd/diabetes/list',"用户列表"=>__BASEPATH.'iha/index/index');
			message("查看糖尿病随访记录详细信息失败。",$url);
		}
		
	}
	/*
	*添加编辑随访
	*/
	public function addAction(){
		require_once(__SITEROOT."application/cd/models/clinical_history.php");//慢病确症情况
		$nexturl     = $this->_request->getParam('nexturl');
		//$this->view->currentstaff_id   = $this->user['uuid'];
		$uuid   =   $this->_request->getParam('uuid');
		$editid = $this->_request->getParam('editid');
		$ok     = $this->_request->getParam('ok');
		$id     = $this->_request->getParam('id');
		$this->view->default_sftime = date('Y-m-d',time());
		$this->view->currenteditid   = $editid;
		$individual_session=new Zend_Session_Namespace("individual_core");
		$currentuuid  = $individual_session->uuid;
		//去当前这个人的姓名和编号
		$individual_core    = new Tindividual_core();
		$individual_core->whereAdd("uuid='$currentuuid'");
		$individual_core->find(true);
		$this->view->currentname    =  $individual_core->name;
		$this->view->standard_code  =  $individual_core->standard_code_1;
		$this->view->id             =  $id;
		$this->view->uuid   = $currentuuid;
		$this->view->tag    = $editid;
		$this->view->identity_number    = $individual_core->identity_number;
		require_once __SITEROOT.'/library/data_arr/arrdata.php';//数据字典
		$this->view->json_lung               = json_encode($type_of_followup);//随访方式json
		$this->view->json_symptom            = json_encode($diabetes_symptom);//症状json		
		$this->view->type_of_followup        = $type_of_followup;//随访方式
		$this->view->diabetes_symptom        = $diabetes_symptom;//症状
		$this->view->arteria_dorsalis_pedis  = $arteria_dorsalis_pedis;//足背动脉搏动
		$this->view->heart_adjustment        = $heart_adjustment;//心理调整
		$this->view->complian                = $complian;//遵医行为
		$this->view->compliance              = $compliance;//服药依从性
		$this->view->adverse_drug_reaction   = $adverse_drug_reaction;//药物不良反应
		$this->view->reactive_hypoglycemia   = $reactive_hypoglycemia;//低血糖反应
		$this->view->followup_classification = $followup_classification;//随访方式	
		//医生列表
		$org_region_domain                   = $this->user['current_region_path_domain'];
		$responseDoctorArray                 = region_users($org_region_domain);
		$this->view->response_doctor         = $responseDoctorArray;
		$currenttime                         = time();
		$staff_id   = $this->user['uuid'];//获取医生ID
                ////确诊是否是糖尿病
		    $is_diabetes = is_clinical_history($individual_session->uuid,3);
                                          $this->view->is_diabetes = $is_diabetes;
		//没有编辑的ID的时候就添加
		//echo $editid;
		if(empty($editid)){
                                                          $this->view->date_time = '';
			$this->view->title = '新增';//
			$this->view->fdoctor=$this->user['uuid'];
			if(empty($individual_session->uuid) || empty($individual_session->staff_id))
			{
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			else
			{
				//判断死亡档案
				if($individual_session->status_flag!=1)
				{
					message("该档案为非正常档案,请选择其他档案做Ⅱ型糖尿病随访",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
				}
			}		
		
		   if($ok){
			$newuuid            =  uniqid('D_',true); 
		    //处理随访日期
		    $mytime        = $this->_request->getParam('ftime');
		    $sftime        = empty($mytime)?time():strtotime($mytime);
		    $time_of_next_followup      = $this->_request->getParam('time_of_next_followup');
		    $time_of_next_followup_real = empty($time_of_next_followup)?time():strtotime($time_of_next_followup);
			//主表
			$diabetes_core = new Tdiabetes_core();
			$diabetes_core->uuid                     =  $newuuid;
			$diabetes_core->id                       =  $uuid;
			$diabetes_core->staff_id                 =  $staff_id;
			$diabetes_core->followup_time            =  $sftime;
			$diabetes_core->type_of_followup         =  array_code_change($this->_request->getParam('type_of_followup'),$type_of_followup);//随访方式
			$diabetes_core->created                  = $currenttime;
			$diabetes_core->time_of_next_followup    = strtotime($this->_request->getParam('time_of_next_followup'));
			$diabetes_core->compliance               = $this->_request->getParam('compliance');//服药依从性
			$diabetes_core->adverse_drug_reaction    = $this->_request->getParam('adverse_drug_reaction');//药物不良反应
		    $diabetes_core->reactive_hypoglycemia    = $this->_request->getParam('reactive_hypoglycemia');//低血糖反应
		    $diabetes_core->followup_classification  = $this->_request->getParam('followup_classification');//此次随访分类
		    $diabetes_core->followup_doctor          = $this->_request->getParam('followup_doctor');//随访医生签名
		    $diabetes_core->followup_result          = $this->_request->getParam('followup_result');//随访结果
			$diabetes_core->insulin                  = $this->_request->getParam('insulin');//胰岛素用法与用量
			$diabetes_core->insulin_class            = $this->_request->getParam('insulin_class');//胰岛素种类
			//Ⅱ型糖尿病 症状
			$diabetes_symptom_t = new Tdiabetes_symptom();
			$diabetes_symptom_t->staff_id   = $staff_id ;//医生档案号
			$diabetes_symptom_t->id         = $uuid;//个人档案号
			$diabetes_symptom_t->created    = $currenttime;//添加时间
			$diabetes_symptom_t->uuid       = $newuuid;
			$symptom_arr                    = $this->_request->getParam('symptom');//症状
			$symptom_str='';
			foreach($symptom_arr as $v){
				if(isset($diabetes_symptom[$v][0])){
					$symptom_str.=$diabetes_symptom[$v][0].'|';
				}
			}
			$symptom_str = rtrim($symptom_str,'|');
			$diabetes_symptom_t->diabetes_symptom = $symptom_str;
			$diabetes_symptom_t->symptom_other    = $this->_request->getParam('symptom_other');//症状其他
			//Ⅱ型糖尿病 体征
			$diabetes_physical_sign = new Tdiabetes_physical_sign();
			$diabetes_physical_sign->staff_id                 = $staff_id;//医生档案号
			$diabetes_physical_sign->id                       = $uuid;//个人档案号
			$diabetes_physical_sign->created                  = $currenttime;//添加记录时间
			$diabetes_physical_sign->uuid                     = $newuuid;
			$diabetes_physical_sign->blood_pressure           = $this->_request->getParam('blood_pressure');//血压
			$diabetes_physical_sign->diastolic_blood_pressure = $this->_request->getParam('diastolic_blood_pressure');
			$diabetes_physical_sign->height                   = $this->_request->getParam('height');//本次身高   由于2012年11月  工作人员反映要把那个体质指数自动算出来  后经贾老师同意加身高
			$diabetes_physical_sign->height_next              = $this->_request->getParam('height_next');//下次身高
			$diabetes_physical_sign->weight                   = $this->_request->getParam('weight');//体重
			$diabetes_physical_sign->expectative_weight       = $this->_request->getParam('expectative_weight');//体重			
			$diabetes_physical_sign->bmi                      = $this->_request->getParam('bmi');//体质指数
			$diabetes_physical_sign->bmi_next                 = $this->_request->getParam('bmi_next');//体质指数预期指数
			$diabetes_physical_sign->arteria_dorsalis_pedis   = $this->_request->getParam('arteria_dorsalis_pedis');//足背动脉搏动
			$diabetes_physical_sign->other                    = $this->_request->getParam('adp_other');//足背动脉搏动
			//Ⅱ型糖尿病 生活方式指导
			$diabetes_lifestyle_guide = new Tdiabetes_lifestyle_guide();
			$diabetes_lifestyle_guide->staff_id               = $staff_id;//医生档案号
			$diabetes_lifestyle_guide->id                     = $uuid;//个人档案号
			$diabetes_lifestyle_guide->uuid                   = $newuuid;
			$diabetes_lifestyle_guide->created                = $currenttime;//添加时间
			$diabetes_lifestyle_guide->smoking                = $this->_request->getParam('smoking');//日吸烟量
			$diabetes_lifestyle_guide->expert_smoking         = $this->_request->getParam('expert_smoking');//预期日吸烟量
			$diabetes_lifestyle_guide->drinking               = $this->_request->getParam('drinking');//日饮酒量
			$diabetes_lifestyle_guide->expert_drinking        = $this->_request->getParam('expert_drinking');//预期日饮酒量
			$diabetes_lifestyle_guide->frequency              = $this->_request->getParam('frequency');//运动频率次/周
			$diabetes_lifestyle_guide->frequency_time         = $this->_request->getParam('frequency_time');//运动频率分钟/次
			$diabetes_lifestyle_guide->expert_frequency       = $this->_request->getParam('expert_frequency');//运动频率分钟/周
			$diabetes_lifestyle_guide->expert_frequency_time  = $this->_request->getParam('expert_frequency_time');//预期频率分钟/次
			$diabetes_lifestyle_guide->main_course            = $this->_request->getParam('main_course');//主食克
			$diabetes_lifestyle_guide->expert_main_course     = $this->_request->getParam('expert_main_course');//主食天
			$diabetes_lifestyle_guide->heart_adjustment       = $this->_request->getParam('heart_adjustment');//心理调整
			$diabetes_lifestyle_guide->complian               = $this->_request->getParam('complian');//遵医行为
			//2型糖尿病 辅助检查
			$diabetes_accessory_examine = new Tdiabetes_accessory_examine();
			$diabetes_accessory_examine->staff_id             = $staff_id;//医生档案号
			$diabetes_accessory_examine->id                   = $uuid;//个人档案号
			$diabetes_accessory_examine->uuid                 = $newuuid;
			$diabetes_accessory_examine->created              = $currenttime;//添加时间
			$diabetes_accessory_examine->fasting_bloodglucose = $this->_request->getParam('fasting_bloodglucose');//空腹血糖值
			$diabetes_accessory_examine->hbclc                = $this->_request->getParam('hbclc');//糖化血红蛋白
			$dia_time = date('Y',time()) . '-' . $this->_request->getParam('mon') . '-' . $this->_request->getParam('day');
			$dia_t = strtotime($dia_time);
			$diabetes_accessory_examine->eamination_time      = $dia_t;//检查日期
			$diabetes_accessory_examine->eamination_info = $this->_request->getParam('eamination_info');//检查内容
			//2型糖尿病 转诊
			$diabetes_patient_referral = new Tdiabetes_patient_referral();
			$diabetes_patient_referral->staff_id              = $staff_id;
			$diabetes_patient_referral->id                    = $uuid;
			$diabetes_patient_referral->created               = $currenttime;
			$diabetes_patient_referral->uuid                  = $newuuid;
			$diabetes_patient_referral->reason                = $this->_request->getParam('reason');//转诊原因
			$diabetes_patient_referral->organization          = $this->_request->getParam('organization');//机构及科别
			//用药情况
			$drug_name_array                                  = $this->_request->getParam('drug_name');//药物名称
			$drug_frequency_array                             = $this->_request->getParam('drug_frequency');//药物用法(次)
			$drug_amount_array                                = $this->_request->getParam('drug_amount');//药物用法(mg)
	        $tips_error	= create_tips($this->user['uuid'],$individual_session->uuid,$this->user['current_region_path'],adodb_date("Y-m-d",$time_of_next_followup_real)."Ⅱ型糖尿病随访计划","糖尿病随访",$time_of_next_followup_real,__BASEPATH."cd/diabetes/add/editid/".$newuuid.'/id/'.$individual_session->uuid,"本次随访结果：".$this->_request->getParam('followup_result'),$sftime);
		    if($tips_error==="error_01"){
				$tips_error=",<font color='red'>工作计划添加失败，无法找到对应的计划类型，请省系统管理员添加【Ⅱ型糖尿病随访】的计划类型。</font>";
			}else{
				$tips_error=",对应的工作计划已经自动添加！";
			}
	    	$diabetes_core->insert();
	    	$diabetes_symptom_t->insert();
	    	$diabetes_physical_sign->insert();
	    	$diabetes_lifestyle_guide->insert();
	    	$diabetes_accessory_examine->insert();
	    	$diabetes_patient_referral->insert();
		    if(!empty($drug_name_array) && is_array($drug_name_array)){
				foreach($drug_name_array as $k=>$v){
					$follow_up_drugs=new Tfollow_up_drugs();
					$follow_up_drugs->uuid                 = uniqid('DD_',true);//
					$follow_up_drugs->staff_id             = $staff_id;//医生档案号
					$follow_up_drugs->id                   = $uuid;//个人档案号
					$follow_up_drugs->created              = $currenttime;//添加记录时间
					$follow_up_drugs->drug_name            = $v;//药物名称
					$follow_up_drugs->drug_amount          = $drug_amount_array[$k];//(mg)
					$follow_up_drugs->drug_frequency       = $drug_frequency_array[$k];
					$follow_up_drugs->follow_uuid          = $newuuid;//随访主表ID
					$follow_up_drugs->call_module          = "diabetes";//调用模块
					if($v!==''){
					   $follow_up_drugs->insert();
					}
				}
			}
		    if(!empty($nexturl)){
			  echo "<script>window.location='".__BASEPATH.$nexturl."'</script>";
			}else{
			   message("Ⅱ型糖尿病随访添加成功{$tips_error}",array("进入Ⅱ型糖尿病随访列表"=>__BASEPATH.'cd/diabetes/list'));
			} 
		    }
		}else{
			//取当前编辑的人的详细内容
			$this->view->title = '编辑';
			$individual_coreedit    = new Tindividual_core();
			$individual_coreedit->whereAdd("uuid='$id'");
			$individual_coreedit->find(true);
			$this->view->currentname   = $individual_coreedit->name;
			$this->view->standard_code = $individual_coreedit->standard_code_1;
			//有了编辑ID的时候就编辑
			//echo $editid;
			$editdiabetes_core = new Tdiabetes_core();
			$editdiabetes_core->whereAdd("uuid='$editid'");
			$editdiabetes_core->find(true);
            //$editdiabetes_core->fetch();
            //var_dump($editdiabetes_core);
            //主表
            $followuptime  =  empty($editdiabetes_core->followup_time)?'':adodb_date("Y-m-d",$editdiabetes_core->followup_time);
            $date_time = empty($followuptime)?$editdiabetes_core->created:$editdiabetes_core->followup_time;
            $this->view->date_time = $date_time;
            $typefollowup  =  $editdiabetes_core->type_of_followup;
            $nexttime      =  empty($editdiabetes_core->time_of_next_followup)?'':adodb_date("Y-m-d",$editdiabetes_core->time_of_next_followup);
            $complian      =  $editdiabetes_core->compliance;
            $adverse_drug  =  $editdiabetes_core->adverse_drug_reaction;
            $reactive      =  $editdiabetes_core->reactive_hypoglycemia;
            $classification=  $editdiabetes_core->followup_classification;
            $fdoctor       =  $editdiabetes_core->followup_doctor;
            $insuli        =  $editdiabetes_core->insulin;
            $insuli_new    =  $editdiabetes_core->insulin_class;
            $followup_result= $editdiabetes_core->followup_result;
            //症状表
			$symptom_obj = new Tdiabetes_symptom();
			$symptom_obj->whereAdd("uuid='$editid'");
			$symptom_obj->find();
			$symptom_obj->fetch();
			$symptomarr  = explode('|', $symptom_obj->diabetes_symptom);
			$symother    = $symptom_obj->symptom_other;
			//体征
			$physical_sign = new Tdiabetes_physical_sign();
			$physical_sign->whereAdd("uuid='$editid'");
			$physical_sign->find();
			$physical_sign->fetch();
			$bloodpress      = $physical_sign->blood_pressure;
			$diabloodpress   = $physical_sign->diastolic_blood_pressure;
			$weight          = $physical_sign->weight;
			$expecttative    = $physical_sign->expectative_weight;
			$bmi             = $physical_sign->bmi;
			$bmi_next        = $physical_sign->bmi_next;
			$arterta         = $physical_sign->arteria_dorsalis_pedis;
			$other           = $physical_sign->other;
			$height          = $physical_sign->height;//本次身高   由于2012年11月  工作人员反映要把那个体质指数自动算出来  后经贾老师同意加身高
			$height_next     = $physical_sign->height_next;//下次身高
			//生活方式指导
			$lifestyle_guide = new Tdiabetes_lifestyle_guide();
			$lifestyle_guide->whereAdd("uuid='$editid'");
			$lifestyle_guide->find();
			$lifestyle_guide->fetch();
			$smoking            = $lifestyle_guide->smoking;
			$expertsmoking      = $lifestyle_guide->expert_smoking;
			$driking            = $lifestyle_guide->drinking;
			$experdrinking      = $lifestyle_guide->expert_drinking;
			$frequencying       = $lifestyle_guide->frequency;
			$frequencyingtime   = $lifestyle_guide->frequency_time;
			$experquency        = $lifestyle_guide->expert_frequency;
			$experquencytime    = $lifestyle_guide->expert_frequency_time;
			$maincourse         = $lifestyle_guide->main_course;
			$expermaincourse    = $lifestyle_guide->expert_main_course;
			$headerad           = $lifestyle_guide->heart_adjustment;
			$comp               = $lifestyle_guide->complian;
			//辅助检查
			$accessory_examine = new Tdiabetes_accessory_examine();
			$accessory_examine->whereAdd("uuid='$editid'");
			$accessory_examine->find();
			$accessory_examine->fetch();
			$bloodnumber        = $accessory_examine->fasting_bloodglucose;
			$hbclc              = $accessory_examine->hbclc;
			$examin_time=empty($accessory_examine->eamination_time)?"":adodb_date('Y-m-d',$accessory_examine->eamination_time);
			if($examin_time)
			{
				$examintime         = explode('-', $examin_time);
			}
			//echo $accessory_examine->eamination_time;
			$eaminationinf      = $accessory_examine->eamination_info;	
			//转诊
			$patient_referral = new Tdiabetes_patient_referral();
			$patient_referral->whereAdd("uuid='$editid'");
			$patient_referral->find();
			$patient_referral->fetch();	
			$reason             = $patient_referral->reason;
			$organization       = $patient_referral->organization;	 
			//药品信息
		    $hypertension_array=get_follow_drug($editid,'diabetes');
		    $this->view->hypertension_array = $hypertension_array;
		    
		    //var_dump($hypertension_array);
            //主表内容;
            $this->view->followuptime   = $followuptime;
            $this->view->typefollowup   = $typefollowup;
            $this->view->nexttime       = $nexttime;
            $this->view->compile        = $complian;
            $this->view->adverse_drug   = $adverse_drug;
            $this->view->reactive       = $reactive;
            $this->view->classific      = $classification;
            $this->view->fdoctor        = $fdoctor;
            $this->view->insuli         = $insuli;
            $this->view->insuli_edit   = $insuli_new;
            $this->view->followup_result=$followup_result;
            //症状表内容
            $this->view->symptomarr = $symptomarr;
            $this->view->symother   = $symother;
            //体征内容
            $this->view->bloodpress        = $bloodpress;
            $this->view->diabloodpress     = $diabloodpress;
            $this->view->weight            = $weight;
            $this->view->expecttative      = $expecttative;
            $this->view->height            = $height;
            $this->view->height_next      = $height_next;
            $this->view->bmi               = $bmi;
            $this->view->bmi_next          = $bmi_next;
            $this->view->arterta           = $arterta;
            $this->view->other             = $other;
            //生活方式内容
            $this->view->smoking            = $smoking;
            $this->view->expertsmoking      = $expertsmoking;
            $this->view->drinking           = $driking;
            $this->view->experdrinking      = $experdrinking;
            $this->view->frequencying       = $frequencying;
            $this->view->frequencyingtime   = $frequencyingtime;
            $this->view->experquency        = $experquency;
            $this->view->experquencytime    = $experquencytime;
            $this->view->maincourse         = $maincourse;
            $this->view->expermaincourse    = $expermaincourse;
            $this->view->headerad           = $headerad;
            $this->view->comp               = $comp;
            //辅助检查内容
            $this->view->bloodnumber      = $bloodnumber;
            $this->view->hbclc            = $hbclc;
            if($examin_time)
            {
	            $this->view->examintimeone    = $examintime[1];
	            $this->view->examintimetwo    = $examintime[2];
            }
            else 
            {
        	    $this->view->examintimeone    = "";
       			$this->view->examintimetwo    = "";
            }
            $this->view->eaminationinf    = $eaminationinf;
            //转诊内容
            $this->view->reason           = $reason;
            $this->view->organization     = $organization;
            //进行更新操作
            if($ok){
            	//echo "2";	          =   
			    //处理随访日期
			    $mytime        = $this->_request->getParam('ftime');
			    $stime         = empty($mytime)?$editdiabetes_core->followup_time:strtotime($mytime);
			    //更新主表
			    $updatediatable_core = new Tdiabetes_core();
			    $updatediatable_core->whereAdd("uuid='$editid'");
			    $updatediatable_core->followup_time            =  $stime;
	            $updatediatable_core->type_of_followup         =  array_code_change($this->_request->getParam('type_of_followup'),$type_of_followup);//随访方式
				$updatediatable_core->created                  = $currenttime;
				$updatediatable_core->time_of_next_followup    = strtotime($this->_request->getParam('time_of_next_followup'));
				$updatediatable_core->compliance               = $this->_request->getParam('compliance');//服药依从性
				$updatediatable_core->adverse_drug_reaction    = $this->_request->getParam('adverse_drug_reaction');//药物不良反应
			    $updatediatable_core->reactive_hypoglycemia    = $this->_request->getParam('reactive_hypoglycemia');//低血糖反应
			    $updatediatable_core->followup_classification  = $this->_request->getParam('followup_classification');//此次随访分类
			    $updatediatable_core->followup_doctor          = $this->_request->getParam('followup_doctor');//随访医生签名
			    $updatediatable_core->followup_result          = $this->_request->getParam('followup_result');//随访结果
				$updatediatable_core->insulin                  = $this->_request->getParam('insulin');//胰岛素用法与用量
				$updatediatable_core->insulin_class            = $this->_request->getParam('insulin_class');//胰岛素种类
				$updatediatable_core->update();
				//更新症状表
				$updatediabetes_symptom   = new Tdiabetes_symptom();  
				$updatediabetes_symptom->whereAdd("uuid='$editid'");    
				$symptom_arr                    = $this->_request->getParam('symptom');//症状
			    $symptom_str='';
				foreach($symptom_arr as $v){
					if(isset($diabetes_symptom[$v][0])){
						$symptom_str.=$diabetes_symptom[$v][0].'|';
					}
				}
				$symptom_str = rtrim($symptom_str,'|');
				$updatediabetes_symptom->diabetes_symptom = $symptom_str;
				$updatediabetes_symptom->symptom_other    = $this->_request->getParam('symptom_other');//症状其他
				$updatediabetes_symptom->update();
				//更新2型糖尿病 体征
				$updatediabetes_physical_sign = new Tdiabetes_physical_sign();
				$updatediabetes_physical_sign->whereAdd("uuid='$editid'");
				$updatediabetes_physical_sign->blood_pressure           = $this->_request->getParam('blood_pressure');//血压
				$updatediabetes_physical_sign->diastolic_blood_pressure = $this->_request->getParam('diastolic_blood_pressure');
				$updatediabetes_physical_sign->height                   = $this->_request->getParam('height');//身高
				$updatediabetes_physical_sign->height_next              = $this->_request->getParam('height_next');//身高
				$updatediabetes_physical_sign->weight                   = $this->_request->getParam('weight');//体重
				$updatediabetes_physical_sign->expectative_weight       = $this->_request->getParam('expectative_weight');//体重			
				$updatediabetes_physical_sign->bmi                      = $this->_request->getParam('bmi');//体质指数
				$updatediabetes_physical_sign->bmi_next                 = $this->_request->getParam('bmi_next');//体质指数
				$updatediabetes_physical_sign->arteria_dorsalis_pedis   = $this->_request->getParam('arteria_dorsalis_pedis');//足背动脉搏动
				$updatediabetes_physical_sign->other                    = $this->_request->getParam('adp_other');//足背动脉搏动
				$updatediabetes_physical_sign->update();
				//更新2型糖尿病 生活方式指导
				$updatediabetes_lifestyle_guide = new Tdiabetes_lifestyle_guide();
				$updatediabetes_lifestyle_guide->whereAdd("uuid='$editid'");
				$updatediabetes_lifestyle_guide->smoking                = $this->_request->getParam('smoking');//日吸烟量
				$updatediabetes_lifestyle_guide->expert_smoking         = $this->_request->getParam('expert_smoking');//预期日吸烟量
				$updatediabetes_lifestyle_guide->drinking               = $this->_request->getParam('drinking');//日饮酒量
				$updatediabetes_lifestyle_guide->expert_drinking        = $this->_request->getParam('expert_drinking');//预期日饮酒量
				$updatediabetes_lifestyle_guide->frequency              = $this->_request->getParam('frequency');//运动频率次/周
				$updatediabetes_lifestyle_guide->frequency_time         = $this->_request->getParam('frequency_time');//运动频率分钟/次
				$updatediabetes_lifestyle_guide->expert_frequency       = $this->_request->getParam('expert_frequency');//运动频率分钟/周
				$updatediabetes_lifestyle_guide->expert_frequency_time  = $this->_request->getParam('expert_frequency_time');//预期频率分钟/次
				$updatediabetes_lifestyle_guide->main_course            = $this->_request->getParam('main_course');//主食克
				$updatediabetes_lifestyle_guide->expert_main_course     = $this->_request->getParam('expert_main_course');//主食天
				$updatediabetes_lifestyle_guide->heart_adjustment       = $this->_request->getParam('heart_adjustment');//心理调整
				$updatediabetes_lifestyle_guide->complian               = $this->_request->getParam('complian');//遵医行为
				$updatediabetes_lifestyle_guide->update();
				//更新2型糖尿病 辅助检查
				$updatediabetes_accessory_examine = new Tdiabetes_accessory_examine();
				$updatediabetes_accessory_examine->whereAdd("uuid='$editid'");
				$updatediabetes_accessory_examine->fasting_bloodglucose = $this->_request->getParam('fasting_bloodglucose');//空腹血糖值
				$updatediabetes_accessory_examine->hbclc                = $this->_request->getParam('hbclc');//糖化血红蛋白
				$dia_time = date('Y',time()) . '-' . $this->_request->getParam('mon') . '-' . $this->_request->getParam('day');
				$dia_t = strtotime($dia_time);
				$updatediabetes_accessory_examine->eamination_time      = $dia_t;//检查日期
				$updatediabetes_accessory_examine->eamination_info = $this->_request->getParam('eamination_info');//检查内容
				$updatediabetes_accessory_examine->update();
				//2型糖尿病 转诊
				$updatediabetes_patient_referral = new Tdiabetes_patient_referral();
				$updatediabetes_patient_referral->whereAdd("uuid='$editid'");
				$updatediabetes_patient_referral->reason                = $this->_request->getParam('reason');//转诊原因
				$updatediabetes_patient_referral->organization          = $this->_request->getParam('organization');//机构及科别
				$updatediabetes_patient_referral->update();
				//用药情况
				$drug_name_array                                  = $this->_request->getParam('drug_name');//药物名称
				//var_dump($drug_name_array);
				$drug_frequency_array                             = $this->_request->getParam('drug_frequency');//药物用法(次)
				$drug_amount_array                                = $this->_request->getParam('drug_amount');//药物用法(mg)
				$drug_uuid_array                                = $this->_request->getParam('drug_uuid');//药物uuid(mg)
	             if(!empty($drug_name_array) && is_array($drug_name_array)){
	             	//先删除再添加
	             	$del_follow_up_drugs = new Tfollow_up_drugs();
	             	$del_follow_up_drugs->whereAdd("follow_uuid='$editid'");
	             	$del_follow_up_drugs->delete();
	             	$del_follow_up_drugs->free_statement();
	             	//添加用药
	             	foreach($drug_name_array as $k=>$v)
	             	{ 
	             		$new_follow_up_drugs = new Tfollow_up_drugs();
	             		$new_follow_up_drugs->uuid                = uniqid('DD_',true);
	             		$new_follow_up_drugs->staff_id            = $staff_id;
	             		$new_follow_up_drugs->id                  = $this->_request->getParam('id');
	             		$new_follow_up_drugs->created             = time();
	             		$new_follow_up_drugs->drug_name           = $v;
	             		$new_follow_up_drugs->drug_amount         = $drug_amount_array[$k];
	             		$new_follow_up_drugs->drug_frequency      = $drug_frequency_array[$k];
	             		$new_follow_up_drugs->follow_uuid         = $editid;
	             		$new_follow_up_drugs->call_module         = 'diabetes';
	             		$new_follow_up_drugs->insert();
	             		$new_follow_up_drugs->free_statement();
	             	}
				/*		foreach($drug_name_array as $k=>$v){ 
							$myeditid = $drug_uuid_array[$k];
							//echo $v;
							$updatefollow_up_drugs=new Tfollow_up_drugs();
							$updatefollow_up_drugs->whereAdd("uuid='$myeditid'");
							$updatefollow_up_drugs->drug_name            = $v;//药物名称
							$updatefollow_up_drugs->drug_amount          = $drug_amount_array[$k];//(mg)
							$updatefollow_up_drugs->drug_frequency       = $drug_frequency_array[$k];
							if($v!==''){
							   $updatefollow_up_drugs->update();
							}
						}*/
					}
		 
		 $url=array("Ⅱ型糖尿病随访记录列表"=>__BASEPATH.'cd/diabetes/list',"用户列表"=>__BASEPATH.'iha/index/index',"新增随访"=>__BASEPATH.'cd/diabetes/add'); 
		 message("Ⅱ型糖尿病随访记录修改成功",$url);
            }
		}
		$this->view->display('add_diabetes_table.html');
	}
	/*
	*删除记录
	*/
	public function deleteAction(){
		$uuid = $this->_request->getParam('uuid');
		$error_code= '无';
		if($uuid){
			$diabetes_core = new Tdiabetes_core();
			$diabetes_core->whereAdd("uuid='$uuid'");
			$diabetes_core->find(true);
			//删除药品表
			$follow_up_drugs=new Tfollow_up_drugs();
			$follow_up_drugs->whereAdd("follow_uuid='$uuid'");
			$follow_up_drugs->whereAdd("id='".$diabetes_core->id."'");
			$follow_up_drugs->whereAdd("call_module='diabetes'");
			if (!$follow_up_drugs->delete())
			{
				$error_code="cd-diabetes001";
			}
			// 删除症状表
			$diabetes_symptom = new Tdiabetes_symptom();
			$diabetes_symptom->whereAdd("uuid='$uuid'");
			$diabetes_symptom->whereAdd("id='".$diabetes_core->id."'");
			if (!$diabetes_symptom->delete())
			{
				$error_code="cd-diabetes002";
			}
			//删除体征表
			$diabetes_physical_sign = new Tdiabetes_physical_sign();
			$diabetes_physical_sign->whereAdd("uuid='$uuid'");
			$diabetes_physical_sign->whereAdd("id='".$diabetes_core->id."'");
			if (!$diabetes_physical_sign->delete())
			{
				$error_code="cd-diabetes003";
			}
			//删除生活方式指导
			$diabetes_lifestyle_guide = new Tdiabetes_lifestyle_guide();
			$diabetes_lifestyle_guide->whereAdd("uuid='$uuid'");
			$diabetes_lifestyle_guide->whereAdd("id='".$diabetes_core->id."'");
			if (!$diabetes_lifestyle_guide->delete())
			{
				$error_code="cd-diabetes004";
			}
			//删除辅助检查
			$diabetes_accessory_examine = new Tdiabetes_accessory_examine();
			$diabetes_accessory_examine->whereAdd("uuid='$uuid'");
			$diabetes_accessory_examine->whereAdd("id='".$diabetes_core->id."'");
			if (!$diabetes_accessory_examine->delete())
			{
				$error_code="cd-diabetes005";
			}
			//删除转载表
			$diabetes_patient_referral = new Tdiabetes_patient_referral();
			$diabetes_patient_referral->whereAdd("uuid='$uuid'");
			$diabetes_patient_referral->whereAdd("id='".$diabetes_core->id."'");
			if (!$diabetes_patient_referral->delete())
			{
				$error_code="cd-diabetes006";
			}
			//删除主表
			$diabetes_core = new Tdiabetes_core();
			$diabetes_core->whereAdd("uuid='$uuid'");
			if ($diabetes_core->delete())
			{
				$url=array("Ⅱ型糖尿病随访记录列表"=>__BASEPATH.'cd/diabetes/list',"用户列表"=>__BASEPATH.'iha/index/index',"新增随访"=>__BASEPATH.'cd/diabetes/add');
				message("删除Ⅱ型糖尿病随访记录成功，返回代码：".$error_code,$url);
			}else{
				$url=array("随访记录列表"=>__BASEPATH.'cd/diabetes/list',"用户列表"=>__BASEPATH.'iha/index/index',"新增随访"=>__BASEPATH.'cd/diabetes/add');
				message("删除Ⅱ型糖尿病随访记录失败，错误代码：cd-diabetes007",$url);
			}
		}else{
				$url=array("随访记录列表"=>__BASEPATH.'cd/diabetes/list',"用户列表"=>__BASEPATH.'iha/index/index',"新增随访"=>__BASEPATH.'cd/diabetes/add');
				message("删除Ⅱ型糖尿病随访记录失败，错误代码：cd-diabetes008",$url);
		}
	}
public function resultAction(){
		$personalId = $this->_request->getParam('uuid');
		//取得症状信息
		$disable    = $this->_request->getParam('symptom');
		$tagarr     = array(2,4,5);
		//取得血压的值
		$blood_pressure            = $this->_request->getParam('blood_pressure');
		$diastolic_blood_pressure  = $this->_request->getParam('diastolic_blood_pressure');
		//取得血糖的值
		$fasting_bloodglucose     = $this->_request->getParam('fasting_bloodglucose');
		//取得药物不良反应的值
		$adverse_drug_reaction    = $this->_request->getParam('adverse_drug_reaction');
		//取得此次随访分类
		$followup_classification  = $this->_request->getParam('followup_classification');
		//echo $personalId;
		if($personalId){
		    $result=0;
		//连续2次血糖控制不满意，连续2次随访药物不良反映没有改善，有新的并发症
		    //查询该ID下面的这个人最近的2次血糖
		    $allcount = 0;
		    $blood = new Tdiabetes_accessory_examine(); 
		    $blood->whereAdd("id='$personalId'"); 
            $blood->orderby("created DESC");
            $blood->limit(0,2);
            $blood->find();
            //var_dump($blood->fetch());
            while($blood->fetch()){
            	if($blood->fasting_bloodglucose>=7){
            		$allcount=$allcount+1;
            	}
            }
             //查询这个人的最近2次用药不良反映情况
             $disablecount = 0;
             $disable_core = new Tdiabetes_core();
             $disable_core->whereAdd("id='$personalId'");
             $disable_core->orderby("created DESC");
             $disable_core->limit(0,2);
             $disable_core->find();
             while($disable_core->fetch()){
             	if($disable_core->compliance==2){
             		$disablecount = $disablecount+1;
             	}
             }
             //查询这个人的最近的一次并发症出现情况
             $fllowobj = new Tdiabetes_core();
             $fllowobj->whereAdd("id='$personalId'");
             $fllowobj->orderby("created DESC");
             $fllowobj->limit(0,1);
             $fllowobj->find();
             $fllowobj->fetch();          
           if($allcount==2||$disablecount==2||($fllowobj->followup_classification==4)){
           	      $result = 4;
		     	  echo $result;
		     	  exit;
           }
		    //是否有危险因素
		    foreach($tagarr as $k=>$v){
	            if(in_array($v,$disable)&&$blood_pressure>=180&&$diastolic_blood_pressure>=110&&$fasting_bloodglucose>16.7&&$fasting_bloodglucose<3.9)
	            {
	                $result=1;
	                echo $result;
	                exit;
	            }
		    }
		   //血糖控制满意，无药物不良反应无新并发症或原有并发症没加重 
		     if($fasting_bloodglucose>=3.9&&$fasting_bloodglucose<7.0&&$adverse_drug_reaction==1&&$followup_classification==1){
		     	  $result = 2;
		     	  echo $result;
		     	  exit;
		     }
		   //血糖控制不满意或出现药物不良反映
		    if($fasting_bloodglucose>=7||$adverse_drug_reaction==2){
		    	$result = 3;
		    	echo $result;
		    	exit;
		    }
		}
	}
}
?>