<?php 
/**
 * 重性精神疾病患者随访服务记录表
 */

class cd_schizophreniaController extends controller{
	/**
	 * 自动加载
	 */
	public function init(){
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'library/custom/comm_function.php';//通用类
		require_once __SITEROOT."library/custom/pager.php";//分页类
		require_once __SITEROOT."library/Models/individual_core.php";//个人信息主表
		require_once __SITEROOT."library/Models/schizophrenia.php";//精神分裂随访
		require_once __SITEROOT."library/Models/schizophreniaer_supp_tabs.php";//精神分裂患者个人信息补充表
		$this->view->basePath = $this->_request->getBasePath();
	}
	/**
	 * 
	 * 用于列表
	 */
	public function indexAction()
	{
		require_once(__SITEROOT."application/cd/models/clinical_history.php");//慢病确症情况
		//查看当前选中居民的精神病信息
		$individual_session=new Zend_Session_Namespace("individual_core");
		$seeion_id=$individual_session->uuid;
		$individual_name=new Tindividual_core();
		$individual_name->whereAdd("individual_core.uuid='$seeion_id'");
		$individual_name->find(true);
		$this->view->name=$individual_name->name;
		$current_time=time();//获取当前时间
		$before_time=strtotime(date("Y-01-01",time()));//获取年初时间
		$individual = new Tindividual_core();
		$schizophrenia_core=new Tschizophrenia();
		$schizophrenia_core->joinAdd('left',$schizophrenia_core,$individual,'id','uuid');//关联个人信息
		$schizophrenia_core->whereAdd("schizophrenia.id='$seeion_id'");
		$schizophrenia_core->whereAdd("schizophrenia.fllowup_time>='".$before_time."'");
		$schizophrenia_core->whereAdd("schizophrenia.fllowup_time<='".$current_time."'");
		$schizophrenia_core->orderby("schizophrenia.fllowup_time ASC");

//		$schizophrenia_core->debugLevel(9);
		$schizophrenia_core->find();
		$shp_array=array();
		$n=0;
		while ($schizophrenia_core->fetch())
		{
			$shp_array[$n]['num']=$n+1;
			$shp_array[$n]['uuid']=$schizophrenia_core->uuid;
			$shp_array[$n]['name']=$individual->name;
			$n++;
		}
//		print_r($db_array);
		$this->view->shp=$shp_array;
		
        $submit=$this->_request->getParam('submit');            
		//初始化搜索条件
		$patient=array(1=>'全部居民',2=>'确诊患者',3=>'未确诊患者');
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
        
		$search=array();
		$search['username']=$this->_request->getParam('username');//姓名包含拼音
		$search['staff_id']=($this->_request->getParam('staff_id')=="-9")?"":$this->_request->getParam('staff_id');//建档医生
        $search['startdate']=$this->_request->getParam('startdate');
        $search['enddate']=$this->_request->getParam('enddate');
		$search['standard_code']=$this->_request->getParam('standard_code');//标准档案号
		$search['identity_number']=$this->_request->getParam('identity_number');//身份证号
		$search['status_flag']=$current_status_flag;
		$hypertension_core_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		$schizophrenia=new Tschizophrenia();
		$core=new Tindividual_core();
		$schizophrenia->selectAdd("schizophrenia.id as id,individual_core.standard_code_1 as standard_code_1,individual_core.identity_number as identity_number,individual_core.name as name,individual_core.name_pinyin as name_pinyin,count(schizophrenia.uuid) as snums");
		$schizophrenia->joinAdd('left',$schizophrenia,$core,'id','uuid');
		$schizophrenia->whereAdd($hypertension_core_region_path_domain);
		if ($search['staff_id'])
		{
			$schizophrenia->whereAdd("schizophrenia.staff_id = '".$search['staff_id']."'");
		}
		if ($search['username'])
		{
			$schizophrenia->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if ($search['standard_code'])
		{
			$schizophrenia->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$schizophrenia->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
         if($search['startdate'])
        {    
            $startdate  = strtotime(trim($this->_request->getParam('startdate')));
            $schizophrenia->whereAdd("schizophrenia.FLLOWUP_TIME>='".$startdate."'");
        }
        if($search['enddate'])
        {
            $enddate = strtotime(trim($this->_request->getParam('enddate')));
            $schizophrenia->whereAdd("schizophrenia.FLLOWUP_TIME<='".$enddate."'");
        }
        if($search['status_flag'])
        {
            $schizophrenia->whereAdd("individual_core.status_flag = '" . $current_status_flag ."'");
        }
        $search_org['org_id'] = $this->_request->getParam('org_id')?$this->_request->getParam('org_id'):$this->user['region_id']; //地区
        $individual_core_region_path_domain = get_region_path(1, $search_org['org_id']); 
        $schizophrenia->whereAdd($individual_core_region_path_domain);
        
		$nums=$schizophrenia->count("distinct schizophrenia.id");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'cd/schizophrenia/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//$schizophrenia->debugLevel(5);
		//$core->selectAdd("individual_core.uuid as uuid");

		$schizophrenia->groupBy("id,name,name_pinyin,standard_code_1,identity_number");
		//处理分页
		$schizophrenia->limit($startnum,__ROWSOFPAGE);
		$schizophrenia->find();
		$schizophrenia_array=array();
		$i=0;
		while ($schizophrenia->fetch())
		{
			$schizophrenia_array[$i]['snums']				= $schizophrenia->snums;
			$schizophrenia_array[$i]['id']					= $schizophrenia->id;
			if($this->haveWritePrivilege){
				$schizophrenia_array[$i]['ssname']			= $schizophrenia->name;
			}
			else
			{
				$schizophrenia_array[$i]['ssname']			= "*";
			}
			$schizophrenia_array[$i]['name']				= get_individual_info($schizophrenia->id);//用户姓名
			//$schizophrenia_array[$i]['followup_time']		= empty($schizophrenia->followup_time)?'':adodb_date("Y-m-d",$schizophrenia->followup_time);//随访时间
			//$schizophrenia_array[$i]['followup_doctor']		= get_staff_name_byid($schizophrenia->followup_doctor);//随访医生
			$schizophrenia_array[$i]['moreinfo']=get_moreinfo_schizophrenia($schizophrenia->id);
			$is_schizophrenia=is_clinical_history($schizophrenia->id,8);
			if($is_schizophrenia>0)
			{
				$schizophrenia_array[$i]['pic_name']="hz.png";
			}
			else {
				$schizophrenia_array[$i]['pic_name']="no_person.png";
			}
			$i++;
		}
		$out = $links->subPageCss2();

		//医生列表
        $this->view->assign("startdate",$search['startdate']);
        $this->view->assign("enddate",$search['enddate']);
        $this->view->assign("display",$submit?$submit:'none'); 
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$search['staff_id']);
		$this->view->search=$search;
		$this->view->assign("pager",$out);
        $this->view->assign('org_id', $search_org['org_id']); 
		$this->view->patient=$patient;//array(1=>'全部居民',2=>'确诊患者',3=>'未确诊患者');
		$this->view->schizophrenia_array=$schizophrenia_array;
		//2013-1-31获取本机构下重型精神病患者，并且未填写确诊日期的
        require_once(__SITEROOT."/library/Models/clinical_history.php");
        $clinical_history=new Tclinical_history();
        $core=new Tindividual_core();
        $core->joinAdd("inner",$core,$clinical_history,"uuid","id");
        $core->whereAdd($individual_core_region_path_domain);
        $core->whereAdd("clinical_history.disease_code='8' and clinical_history.disease_state=1 and (clinical_history.disease_date='' or clinical_history.disease_date is null) and (individual_core.status_flag=1 or individual_core.status_flag=4)");
        $errors=$core->count();
        if($errors)
        {
        	$error_string='<span style="color:red;font-size:14px">本机构存在【'.$errors.'】名重型精神病患者未正确填写确诊日期，为了统计结果精确，请<a href="'.$this->_request->getBasePath().'cd/schizophrenia/nodate">查看未填写确诊日期患者列表</a>并依次填写确诊日期。</span>';
            $this->view->error_string=$error_string;
        }     
		$this->view->display('schizophrenia_index.html');
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
        $core->whereAdd("clinical_history.disease_code='8' and clinical_history.disease_state=1 and (clinical_history.disease_date='' or clinical_history.disease_date is null) and (individual_core.status_flag=1 or individual_core.status_flag=4)");
        $nums = $core->count();
        //$core->whereAdd("individual_core.updated>0");
        //showtimer();
        $pageCurrent = intval($this->_request->getParam('page'));
        $pageCurrent = $pageCurrent ? $pageCurrent : 1;
        //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,
            __BASEPATH . 'cd/schizophrenia/nodate/page/', 2, $search);
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
	/**
	 * 一个用户所有随访列表
	 *
	 */
	public function listAction(){
		$userid=$this->_request->getParam('id');
		if ($userid)
		{
			//获取个人信息
			$individual_inf=get_individual_info($userid);//取得个人信息中所有信息
			if($this->haveWritePrivilege)
			{
				$this->view->user_name = $individual_inf->name;//居民姓名
				$this->view->standard_code = $individual_inf->standard_code_1;//标准档案号
				$this->view->identity_number=$individual_inf->identity_number; //身份证号码
			}
			else
			{
				$this->view->user_name = "*";//居民姓名
				$this->view->standard_code = "*";//标准档案号
				$this->view->identity_number="*"; //身份证号码
			}
			require_once __SITEROOT.'/library/data_arr/arrdata.php';

			$this->view->present_symptoms_options 	= $cd_present_symptoms; //目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
			$this->view->insight_options 			= $cd_insight; //自知力|radio|1=>自知力完全,2=>自知力不全,3=>自知力缺失
			$this->view->sleep_quality_options 		= $cd_sleep_quality; //睡眠情况|radio|1=>良好,2=>一般,3=>较差
			$this->view->diet_options 				= $cd_diet; //饮食情况|radio|1=>良好,2=>一般,3=>较差
			$this->view->personlife_do_options 		= $cd_personlife_do; //个人生活料理|radio|1=>良好,2=>一般,3=>较差
			$this->view->housework_options 			= $cd_housework; //家务劳动|radio|1=>良好,2=>一般,3=>较差
			$this->view->work_options 				= $cd_work; //生产劳动及工作|radio|1=>良好,2=>一般,3=>较差,9=>此项不适用
			$this->view->learning_options 			= $cd_learning; //学习能力|radio|1=>良好,2=>一般,3=>较差
			$this->view->human_communication_options =$cd_human_communication; //社会人际交往|radio|1=>良好,2=>一般,3=>较差
			$this->view->compliance_options 		= $cd_comply; //服药依从性|radio|1=>规律,2=>间断,3=>不服药
			$this->view->adverse_drug_options 		= $adverse_drug_reaction; //药物不良反应|radio|1=>无,2=>有
			$this->view->adverse_drug_json	 		= json_encode($adverse_drug_reaction); //药物不良反应|radio|1=>无,2=>有
			$this->view->treatment_effect_options 	=$cd_treatment_effect; //治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重
			$this->view->followup_classification_options =$cd_followup_classification; //此次随访分类|radio|1=>稳定,2=>基本稳定,3=>不稳定
			$this->view->is_referral_options 		= $cd_is_referral; //是否转诊|radio|1=>否,2=>是
			$drug_usage_frequency					= array('1'=>'每日','2'=>'每月');
			$this->view->drug_usage_frequency1_options  = $drug_usage_frequency; //用法1|radio|1=>每日,2=>每月
			$this->view->drug_usage_frequency2_options  = $drug_usage_frequency; //用法2|radio|1=>每日,2=>每月
			$this->view->drug_usage_frequency3_options  =$drug_usage_frequency; //用法3|radio|1=>每日,2=>每月
			$this->view->rehabilitation_measures_options =$cd_rehabilitation_measures; //康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它

			$schizophrenia=new Tschizophrenia();
			$schizophrenia->whereAdd("id='$userid'");
			$nums=$schizophrenia->count();//用于数组循环次数
			//没有记录跳转到随访列表
			if(intval($nums)<1){
				$url		= $this->_request->getBasePath()."cd/schizophrenia/index";
				$this->redirect($url);

			}
			$schizophrenia->orderby("created DESC");
			$schizophrenia->find();
			$schizophrenia_array=array();
			$i=0;
			while ($schizophrenia->fetch())
			{
				$schizophrenia_array[$i]['uuid']					= $schizophrenia->uuid;
				$schizophrenia_array[$i]['fllowup_time']			= empty($schizophrenia->fllowup_time)?'':date('Y-m-d',$schizophrenia->fllowup_time);//随访日期

				//$this->view->present_symptoms_options 	= $cd_present_symptoms; //目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
				$present_symptoms_arr=@explode('|',$schizophrenia->present_symptoms);//
				$present_symptoms_arrray=array();//存放症状
				foreach ($present_symptoms_arr as $present_symptoms_val){
					$present_symptoms_arrray[]=array_search_for_other($present_symptoms_val,$cd_present_symptoms);
				}

				$schizophrenia_array[$i]['present_symptoms_current'] 	= $present_symptoms_arrray;//目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
				$schizophrenia_array[$i]['present_symptoms_other']  	= $schizophrenia->present_symptoms_other;//目前症状其它

				//$this->view->insight_options 			= $cd_insight; //自知力|radio|1=>自知力完全,2=>自知力不全,3=>自知力缺失
				$schizophrenia_array[$i]['insight_current'] 			= array_search_for_other($schizophrenia->insight,$cd_insight);//自知力|radio|1=>自知力完全,2=>自知力不全,3=>自知力缺失

				//$this->view->sleep_quality_options 		= $cd_sleep_quality; //睡眠情况|radio|1=>良好,2=>一般,3=>较差
				$schizophrenia_array[$i]['sleep_quality_current']  		= array_search_for_other($schizophrenia->sleep_quality,$cd_sleep_quality);//睡眠情况|radio|1=>良好,2=>一般,3=>较差

				//$this->view->diet_options 				= $cd_diet; //饮食情况|radio|1=>良好,2=>一般,3=>较差
				$schizophrenia_array[$i]['diet_current']  				= array_search_for_other($schizophrenia->diet,$cd_diet);//饮食情况|radio|1=>良好,2=>一般,3=>较差

				//$this->view->personlife_do_options 		= $cd_personlife_do; //个人生活料理|radio|1=>良好,2=>一般,3=>较差
				$schizophrenia_array[$i]['personlife_do_current']  		= array_search_for_other($schizophrenia->personlife_do,$cd_personlife_do);//个人生活料理|radio|1=>良好,2=>一般,3=>较差

				//$this->view->housework_options 			= $cd_housework; //家务劳动|radio|1=>良好,2=>一般,3=>较差
				$schizophrenia_array[$i]['housework_current']  			= array_search_for_other($schizophrenia->housework,$cd_housework);//家务劳动|radio|1=>良好,2=>一般,3=>较差

				//$this->view->work_options 				= $cd_work; //生产劳动及工作|radio|1=>良好,2=>一般,3=>较差,9=>此项不适用
				$schizophrenia_array[$i]['work_current']  				= array_search_for_other($schizophrenia->work,$cd_work);//生产劳动及工作|radio|1=>良好,2=>一般,3=>较差,9=>此项不适用

				//$this->view->learning_options 			= $cd_learning; //学习能力|radio|1=>良好,2=>一般,3=>较差
				$schizophrenia_array[$i]['learning_current']  			= array_search_for_other($schizophrenia->learning,$cd_learning);//学习能力|radio|1=>良好,2=>一般,3=>较差

				//$this->view->human_communication_options =$cd_human_communication; //社会人际交往|radio|1=>良好,2=>一般,3=>较差
				$schizophrenia_array[$i]['human_communication_current']  = array_search_for_other($schizophrenia->human_communication,$cd_human_communication);//社会人际交往|radio|1=>良好,2=>一般,3=>较差
				$schizophrenia_array[$i]['mild_trouble']  				= $schizophrenia->mild_trouble;//轻度滋事
				$schizophrenia_array[$i]['accident']  					= $schizophrenia->accident;//肇事
				$schizophrenia_array[$i]['zhaohuo']  					= $schizophrenia->zhaohuo;//肇祸
				$schizophrenia_array[$i]['self_wounding']  				= $schizophrenia->self_wounding;//自伤
				$schizophrenia_array[$i]['attmpted_suicide']  			= $schizophrenia->attmpted_suicide;//自杀未遂
				$schizophrenia_array[$i]['lab_examination']  			= $schizophrenia->lab_examination;//室验室检查

				//$this->view->compliance_options 		= $cd_comply; //服药依从性|radio|1=>规律,2=>间断,3=>不服药
				$schizophrenia_array[$i]['compliance_current']  		= array_search_for_other($schizophrenia->compliance,$cd_comply);//服药依从性|radio|1=>规律,2=>间断,3=>不服药

				//$this->view->adverse_drug_options 		= $adverse_drug_reaction; //药物不良反应|radio|1=>无,2=>有
				$schizophrenia_array[$i]['adverse_drug_current'] 		= array_search_for_other($schizophrenia->adverse_drug,$adverse_drug_reaction);//药物不良反应|radio|1=>无,2=>有
				$schizophrenia_array[$i]['adverse_drug_info']  			= $schizophrenia->adverse_drug_info;//药物不良反应内容

				//$this->view->treatment_effect_options 	=$cd_treatment_effect; //治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重
				$schizophrenia_array[$i]['treatment_effect_current']  	= array_search_for_other($schizophrenia->treatment_effect,$cd_treatment_effect);//治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重

				//$this->view->followup_classification_options =$cd_followup_classification; //此次随访分类|radio|1=>稳定,2=>基本稳定,3=>不稳定
				$schizophrenia_array[$i]['followup_classification_current']  = array_search_for_other($schizophrenia->followup_classification,$cd_followup_classification);//此次随访分类|radio|1=>稳定,2=>基本稳定,3=>不稳定

				//$this->view->is_referral_options 		= $cd_is_referral; //是否转诊|radio|1=>否,2=>是
				$schizophrenia_array[$i]['is_referral_current']  		= array_search_for_other($schizophrenia->is_referral,$cd_is_referral);//是否转诊|radio|1=>否,2=>是
				$schizophrenia_array[$i]['reason_referral']  			= $schizophrenia->reason_referral;//转诊原因
				$schizophrenia_array[$i]['hospital_referral']  			= $schizophrenia->hospital_referral;//转诊医院
				$schizophrenia_array[$i]['drug_name1']  				= $schizophrenia->drug_name1;//药物名1
				/**
			     * 表注释:用法1|radio|1=>每日,2=>每月
			     * 
			     * 
			     **/
				//$drug_usage_frequency					= array('1'=>'每日','2'=>'每月');

				//$this->view->drug_usage_frequency1_options  = $drug_usage_frequency; //用法1|radio|1=>每日,2=>每月
				$schizophrenia_array[$i]['drug_usage_frequency1_current']   = $schizophrenia->drug_usage_frequency1;//用法1|radio|1=>每日,2=>每月
				$schizophrenia_array[$i]['drug_usage1']  					= $schizophrenia->drug_usage1;//用法多少次1
				$schizophrenia_array[$i]['drug_dose1']  					= $schizophrenia->drug_dose1;//每次剂量1
				$schizophrenia_array[$i]['drug_name2']  					= $schizophrenia->drug_name2;//药物名2

				//$this->view->drug_usage_frequency2_options  = $drug_usage_frequency; //用法2|radio|1=>每日,2=>每月
				$schizophrenia_array[$i]['drug_usage_frequency2_current']   = $schizophrenia->drug_usage_frequency2;//用法2|radio|1=>每日,2=>每月
				$schizophrenia_array[$i]['drug_usage2']  					= $schizophrenia->drug_usage2;//用法多少次2
				$schizophrenia_array[$i]['drug_dose2']  					= $schizophrenia->drug_dose2;//每次剂量2
				$schizophrenia_array[$i]['drug_name3']  					= $schizophrenia->drug_name3;//药物名3

				//$this->view->drug_usage_frequency3_options =$drug_usage_frequency; //用法3|radio|1=>每日,2=>每月
				$schizophrenia_array[$i]['drug_usage_frequency3_current']  = $schizophrenia->drug_usage_frequency3;//用法3|radio|1=>每日,2=>每月
				$schizophrenia_array[$i]['drug_usage3'] 				   = $schizophrenia->drug_usage3;//用法多少次3
				$schizophrenia_array[$i]['drug_dose3']  				   = $schizophrenia->drug_dose3;//每次剂量3

				//$this->view->rehabilitation_measures_options =$cd_rehabilitation_measures; //康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它
				$rehabilitation_measures_arr=@explode('|',$schizophrenia->rehabilitation_measures);//康复措施
				$rehabilitation_measures_arrray=array();//康复措施
				foreach ($rehabilitation_measures_arr as $rehabilitation_measures_val){
					$rehabilitation_measures_arrray[]=array_search_for_other($rehabilitation_measures_val,$cd_rehabilitation_measures);
				}

				$schizophrenia_array[$i]['rehabilitation_measures_current']  = $rehabilitation_measures_arrray;//康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它
				$schizophrenia_array[$i]['rehabilitation_measure_other']     = $schizophrenia->rehabilitation_measure_other;//康复措施其它
				$schizophrenia_array[$i]['next_followup_time']			     = empty($schizophrenia->next_followup_time)?'':adodb_date('Y-m-d',$schizophrenia->next_followup_time);//下次随访日期

				//$this->view->followup_doctor 			   = $schizophrenia->followup_doctor;//随访医生签名
				//$region_users							   = empty($this->user['current_region_path_domain'])?'':region_users($this->user['current_region_path_domain']);//所有的医生
				//print_r($region_users);
				//$this->view->region_users				   = $region_users;
				$schizophrenia_array[$i]['followup_doctor']  			   	 = get_staff_name_byid($schizophrenia->followup_doctor);//随访医生签名
				$schizophrenia_array[$i]['followup_content'] 				 = $schizophrenia->followup_content;//随访内容
				$i++;
			}
			$this->view->schizophrenia_array=$schizophrenia_array;
			$this->view->nums=$nums;
			$this->view->display('list_table.html');
		}
		else
		{
			$url=array("随访记录列表"=>__BASEPATH.'cd/schizophrenia/index',"用户列表"=>__BASEPATH.'iha/index/index');
			message("查看重性精神疾病随访访记录详细信息失败",$url);
		}
	}
	/**
	 * 
	 * 添加、修改页面
	 */
	public function addAction()
	{
		//require_once(__SITEROOT."application/cd/models/clinical_history.php");//慢病确症情况

		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		$uuid				=	$this->_request->getParam('uuid');//
		$individual_session = new Zend_Session_Namespace("individual_core");
		$this->view->risk_options 			    = $cd_risk; //危险性|radio|0=>(0级),1=>(1级),2=>(2级),3=>(3级),4=>(4级),5(5级)
		$this->view->present_symptoms_options 	= $cd_present_symptoms; //目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
		$this->view->present_symptoms_json	 	= json_encode($cd_present_symptoms); //目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
		$this->view->insight_options 			= $cd_insight; //自知力|radio|1=>自知力完全,2=>自知力不全,3=>自知力缺失
		$this->view->sleep_quality_options 		= $cd_sleep_quality; //睡眠情况|radio|1=>良好,2=>一般,3=>较差
		$this->view->diet_options 				= $cd_diet; //饮食情况|radio|1=>良好,2=>一般,3=>较差
		$this->view->personlife_do_options 		= $cd_personlife_do; //个人生活料理|radio|1=>良好,2=>一般,3=>较差
		$this->view->housework_options 			= $cd_housework; //家务劳动|radio|1=>良好,2=>一般,3=>较差
		$this->view->work_options 				= $cd_work; //生产劳动及工作|radio|1=>良好,2=>一般,3=>较差,9=>此项不适用
		$this->view->learning_options 			= $cd_learning; //学习能力|radio|1=>良好,2=>一般,3=>较差
		$this->view->human_communication_options =$cd_human_communication; //社会人际交往|radio|1=>良好,2=>一般,3=>较差
		$this->view->shut_case_options 			= $cd_shut_case; //关锁情况|radio|1=>无关锁,2=>关锁,3=>关锁已解除
		$this->view->hospitalization_options 	= $cd_hospitalization; //住院情况|radio|0=>从未住院,1=>目前正在住院,2=>既往住院，现未住院		
		$this->view->compliance_options 		= $cd_comply; //服药依从性|radio|1=>规律,2=>间断,3=>不服药
		$this->view->lab_examination_options 	= $adverse_drug_reaction; //实验室检查|radio|1=>无,2=>有
		$this->view->lab_examination_json	 	= json_encode($adverse_drug_reaction); //实验室检查|radio|1=>无,2=>有
		$this->view->adverse_drug_options 		= $adverse_drug_reaction; //药物不良反应|radio|1=>无,2=>有
		$this->view->adverse_drug_json	 		= json_encode($adverse_drug_reaction); //药物不良反应|radio|1=>无,2=>有
		$this->view->treatment_effect_options 	= $cd_treatment_effect; //治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重
		$this->view->followup_classification_options =$cd_followup_classification; //此次随访分类|radio|1=>稳定,2=>基本稳定,3=>不稳定
		$this->view->is_referral_options 		= $cd_is_referral; //是否转诊|radio|1=>否,2=>是
		$this->view->is_referral_json 			= json_encode($cd_is_referral); //是否转诊|radio|1=>否,2=>是 转成json格式
		$drug_usage_frequency					= array('1'=>'每日','2'=>'每月');
		$this->view->drug_usage_frequency1_options  = $drug_usage_frequency; //用法1|radio|1=>每日,2=>每月
		$this->view->drug_usage_frequency2_options  = $drug_usage_frequency; //用法2|radio|1=>每日,2=>每月
		$this->view->drug_usage_frequency3_options  =$drug_usage_frequency; //用法3|radio|1=>每日,2=>每月
		$this->view->rehabilitation_measures_options =$cd_rehabilitation_measures; //康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它
		$this->view->rehabilitation_measures_json	 =json_encode($cd_rehabilitation_measures); //康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它

		if(empty($uuid)){
			//添加
			if(empty($individual_session->uuid)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			//2012-02-21仅查询正常档案
			if($individual_session->status_flag!=1){
	            message("你选择了一个非正常档案，请重新选择",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
	        }
			//精神分裂是否得到确症
			//$is_schizophreniaer						= is_clinical_history($individual_session->uuid,8);
			//if($is_schizophreniaer==0){
			//	message("居民“".$individual_session->name."”还不是重性精神疾病患者,请到个人档案中确症!",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			//}
			$this->view->name 						= $individual_session->name;//姓名
			$this->view->serial_num 				= $individual_session->standard_code_1;//档案编号
			$this->view->fllowup_time_year			= date("Y");//随访日期
			$this->view->fllowup_time_month			= date("m");//随访日期
			$this->view->fllowup_time_day			= date("d");//随访日期

			$this->view->next_followup_time_year= date("Y");//下次随访日期
			$this->view->next_followup_time_month	= date("m");//下次随访日期
			$this->view->next_followup_time_day		= date("d");//下次随访日期
			$region_users							= region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users				= $region_users;
			$this->view->followup_doctor			= $this->user['uuid'];//转诊医生

		}else{
			//修改
			
			$schizophrenia 		=	new Tschizophrenia();
			$schizophrenia->whereAdd("uuid='$uuid'");
			//$count              =  $schizophrenia->count();
			$schizophrenia->find();
			$schizophrenia->fetch();
			$this->view->uuid						= $schizophrenia->uuid;
			$fllowup_time							= $schizophrenia->fllowup_time;//随访日期

			$individual_inf=get_individual_info($schizophrenia->id);//取得个人信息中所有信息
			$this->view->name 						= $individual_inf->name;//姓名
			$this->view->serial_num 				= $individual_inf->standard_code_1;//档案编号

			$this->view->fllowup_time_year			= empty($fllowup_time)?'':date("Y",$fllowup_time);//随访日期
			$this->view->fllowup_time_month			= empty($fllowup_time)?'':date("m",$fllowup_time);//随访日期
			$this->view->fllowup_time_day			= empty($fllowup_time)?'':date("d",$fllowup_time);//随访日期

			$this->view->risk_current 				= array_search_for_other($schizophrenia->risk,$cd_risk);//危险性|radio|0=>(0级),1=>(1级),2=>(2级),3=>(3级),4=>(4级),5(5级)
			//$this->view->present_symptoms_options 	= $cd_present_symptoms; //目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
			$present_symptoms_arr=@explode('|',$schizophrenia->present_symptoms);//
			$present_symptoms_arrray=array();//存放症状
			foreach ($present_symptoms_arr as $present_symptoms_val){
				$present_symptoms_arrray[]=array_search_for_other($present_symptoms_val,$cd_present_symptoms);
			}

			$this->view->present_symptoms_current 	= $present_symptoms_arrray;//目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
			$this->view->present_symptoms_num		= count($present_symptoms_arrray)-1;//出现症状数

			$this->view->present_symptoms_other 	= $schizophrenia->present_symptoms_other;//目前症状其它

			//$this->view->insight_options 			= $cd_insight; //自知力|radio|1=>自知力完全,2=>自知力不全,3=>自知力缺失
			$this->view->insight_current 			= array_search_for_other($schizophrenia->insight,$cd_insight);//自知力|radio|1=>自知力完全,2=>自知力不全,3=>自知力缺失

			//$this->view->sleep_quality_options 		= $cd_sleep_quality; //睡眠情况|radio|1=>良好,2=>一般,3=>较差
			$this->view->sleep_quality_current 		= array_search_for_other($schizophrenia->sleep_quality,$cd_sleep_quality);//睡眠情况|radio|1=>良好,2=>一般,3=>较差

			//$this->view->diet_options 				= $cd_diet; //饮食情况|radio|1=>良好,2=>一般,3=>较差
			$this->view->diet_current 				= array_search_for_other($schizophrenia->diet,$cd_diet);//饮食情况|radio|1=>良好,2=>一般,3=>较差

			$this->view->personlife_do_options 		= $cd_personlife_do; //个人生活料理|radio|1=>良好,2=>一般,3=>较差
			$this->view->personlife_do_current 		= array_search_for_other($schizophrenia->personlife_do,$cd_personlife_do);//个人生活料理|radio|1=>良好,2=>一般,3=>较差

			//$this->view->housework_options 			= $cd_housework; //家务劳动|radio|1=>良好,2=>一般,3=>较差
			$this->view->housework_current 			= array_search_for_other($schizophrenia->housework,$cd_housework);//家务劳动|radio|1=>良好,2=>一般,3=>较差

			//$this->view->work_options 				= $cd_work; //生产劳动及工作|radio|1=>良好,2=>一般,3=>较差,9=>此项不适用
			$this->view->work_current 				= array_search_for_other($schizophrenia->work,$cd_work);//生产劳动及工作|radio|1=>良好,2=>一般,3=>较差,9=>此项不适用

			//$this->view->learning_options 			= $cd_learning; //学习能力|radio|1=>良好,2=>一般,3=>较差
			$this->view->learning_current 			= array_search_for_other($schizophrenia->learning,$cd_learning);//学习能力|radio|1=>良好,2=>一般,3=>较差

			//$this->view->human_communication_options =$cd_human_communication; //社会人际交往|radio|1=>良好,2=>一般,3=>较差
			$this->view->human_communication_current = array_search_for_other($schizophrenia->human_communication,$cd_human_communication);//社会人际交往|radio|1=>良好,2=>一般,3=>较差
			$this->view->mild_trouble 				= $schizophrenia->mild_trouble;//轻度滋事
			$this->view->accident 					= $schizophrenia->accident;//肇事
			$this->view->zhaohuo 					= $schizophrenia->zhaohuo;//肇祸
			$this->view->self_wounding 				= $schizophrenia->self_wounding;//自伤
			$this->view->attmpted_suicide 			= $schizophrenia->attmpted_suicide;//自杀未遂
			$this->view->lab_examination 			= $schizophrenia->lab_examination;//室验室检查
			
			$this->view->shut_case_current 			= array_search_for_other($schizophrenia->shut_case,$cd_shut_case);//关锁情况
			$this->view->hospitalization_current 	= array_search_for_other($schizophrenia->hospitalization,$cd_hospitalization);//住院情况
			$discharge_time							= $schizophrenia->discharge_time;//住院情况末次出院时间
			$this->view->discharge_time				= empty($discharge_time)?'':date("Y-m-d",$discharge_time);;//住院情况末次出院时间

			//$this->view->compliance_options 		= $cd_comply; //服药依从性|radio|1=>规律,2=>间断,3=>不服药
			$this->view->compliance_current 		= array_search_for_other($schizophrenia->compliance,$cd_comply);//服药依从性|radio|1=>规律,2=>间断,3=>不服药

			$this->view->is_lab_examination_current	= array_search_for_other($schizophrenia->is_lab_examination_current,$adverse_drug_reaction);//实验室检查|radio|1=>无,2=>有
			$this->view->lab_examination 			= $schizophrenia->lab_examination;//实验室检查内容
			
			//$this->view->adverse_drug_options 		= $adverse_drug_reaction; //药物不良反应|radio|1=>无,2=>有
			$this->view->adverse_drug_current		= array_search_for_other($schizophrenia->adverse_drug,$adverse_drug_reaction);//药物不良反应|radio|1=>无,2=>有
			$this->view->adverse_drug_info 			= $schizophrenia->adverse_drug_info;//药物不良反应内容

			//$this->view->treatment_effect_options 	=$cd_treatment_effect; //治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重
			$this->view->treatment_effect_current 	= array_search_for_other($schizophrenia->treatment_effect,$cd_treatment_effect);//治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重

			//$this->view->followup_classification_options =$cd_followup_classification; //此次随访分类|radio|1=>稳定,2=>基本稳定,3=>不稳定
			$this->view->followup_classification_current = array_search_for_other($schizophrenia->followup_classification,$cd_followup_classification);//此次随访分类|radio|1=>稳定,2=>基本稳定,3=>不稳定

			//$this->view->is_referral_options 		= $cd_is_referral; //是否转诊|radio|1=>否,2=>是
			$this->view->is_referral_current 		= array_search_for_other($schizophrenia->is_referral,$cd_is_referral);//是否转诊|radio|1=>否,2=>是
			$this->view->reason_referral 			= $schizophrenia->reason_referral;//转诊原因
			$this->view->hospital_referral 			= $schizophrenia->hospital_referral;//转诊医院
			$this->view->drug_name1 				= $schizophrenia->drug_name1;//药物名1
			/**
		     * 表注释:用法1|radio|1=>每日,2=>每月
		     * 
		     * 
		     **/
			//$drug_usage_frequency					= array('1'=>'每日','2'=>'每月');

			//$this->view->drug_usage_frequency1_options  = $drug_usage_frequency; //用法1|radio|1=>每日,2=>每月
			$this->view->drug_usage_frequency1_current  = $schizophrenia->drug_usage_frequency1;//用法1|radio|1=>每日,2=>每月
			$this->view->drug_usage1 					= $schizophrenia->drug_usage1;//用法多少次1
			$this->view->drug_dose1 					= $schizophrenia->drug_dose1;//每次剂量1
			$this->view->drug_name2 					= $schizophrenia->drug_name2;//药物名2

			//$this->view->drug_usage_frequency2_options  = $drug_usage_frequency; //用法2|radio|1=>每日,2=>每月
			$this->view->drug_usage_frequency2_current  = $schizophrenia->drug_usage_frequency2;//用法2|radio|1=>每日,2=>每月
			$this->view->drug_usage2 					= $schizophrenia->drug_usage2;//用法多少次2
			$this->view->drug_dose2 					= $schizophrenia->drug_dose2;//每次剂量2
			$this->view->drug_name3 					= $schizophrenia->drug_name3;//药物名3

			//$this->view->drug_usage_frequency3_options =$drug_usage_frequency; //用法3|radio|1=>每日,2=>每月
			$this->view->drug_usage_frequency3_current = $schizophrenia->drug_usage_frequency3;//用法3|radio|1=>每日,2=>每月
			$this->view->drug_usage3				   = $schizophrenia->drug_usage3;//用法多少次3
			$this->view->drug_dose3 				   = $schizophrenia->drug_dose3;//每次剂量3

			//$this->view->rehabilitation_measures_options =$cd_rehabilitation_measures; //康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它
			$rehabilitation_measures_arr=@explode('|',$schizophrenia->rehabilitation_measures);//康复措施
			$rehabilitation_measures_arrray=array();//康复措施
			foreach ($rehabilitation_measures_arr as $rehabilitation_measures_val){
				$rehabilitation_measures_arrray[]=array_search_for_other($rehabilitation_measures_val,$cd_rehabilitation_measures);
			}

			$this->view->rehabilitation_measures_current = $rehabilitation_measures_arrray;//康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它
			$this->view->rehabilitation_measure_other  = $schizophrenia->rehabilitation_measure_other;//康复措施其它
			$next_followup_time						   = $schizophrenia->next_followup_time;//下次随访日期
			
			//精神分裂是否得到确症,如果为精神分裂患者则下次随访日期默认为上一次随访后三个月
			// $this->view->next_followup_time1=date("Y,m,d",time()); 
			$is_schizophreniaer						= get_status_cd($schizophrenia->id,$disease_code='8',$status='1');
			if($is_schizophreniaer->disease_state==1){
				 
				 $this->view->disease_state=1;
			}
			$this->view->next_followup_time1=date("Y,m,d",$fllowup_time);
			//var_dump($is_schizophreniaer);
			$this->view->next_followup_time_year	   = empty($next_followup_time)?'':date("Y",$next_followup_time);;//下次随访日期
			$this->view->next_followup_time_month	   = empty($next_followup_time)?'':date("m",$next_followup_time);;//下次随访日期
			$this->view->next_followup_time_day	   	   = empty($next_followup_time)?'':date("d",$next_followup_time);;//下次随访日期
			//$this->view->followup_doctor 			   = $schizophrenia->followup_doctor;//随访医生签名
			$region_users							   = empty($this->user['current_region_path_domain'])?'':region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users				   = $region_users;
			$this->view->followup_content  			   = $schizophrenia->followup_content;//转诊内容
			$this->view->followup_doctor  			   = $schizophrenia->followup_doctor;//转诊医生

		}
		$this->view->display("schizophrenia_add.html");
	}
        
        /**
	 * 
	 * 打印页面
	 */
	public function printAction()
	{
		//require_once(__SITEROOT."application/cd/models/clinical_history.php");//慢病确症情况

		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		$uuid				=	$this->_request->getParam('uuid');//
		$individual_session = new Zend_Session_Namespace("individual_core");
		$this->view->risk_options 			    = $cd_risk; //危险性|radio|0=>(0级),1=>(1级),2=>(2级),3=>(3级),4=>(4级),5(5级)
		$this->view->present_symptoms_options 	= $cd_present_symptoms; //目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
		$this->view->present_symptoms_json	 	= json_encode($cd_present_symptoms); //目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
		$this->view->insight_options 			= $cd_insight; //自知力|radio|1=>自知力完全,2=>自知力不全,3=>自知力缺失
		$this->view->sleep_quality_options 		= $cd_sleep_quality; //睡眠情况|radio|1=>良好,2=>一般,3=>较差
		$this->view->diet_options 				= $cd_diet; //饮食情况|radio|1=>良好,2=>一般,3=>较差
		$this->view->personlife_do_options 		= $cd_personlife_do; //个人生活料理|radio|1=>良好,2=>一般,3=>较差
		$this->view->housework_options 			= $cd_housework; //家务劳动|radio|1=>良好,2=>一般,3=>较差
		$this->view->work_options 				= $cd_work; //生产劳动及工作|radio|1=>良好,2=>一般,3=>较差,9=>此项不适用
		$this->view->learning_options 			= $cd_learning; //学习能力|radio|1=>良好,2=>一般,3=>较差
		$this->view->human_communication_options =$cd_human_communication; //社会人际交往|radio|1=>良好,2=>一般,3=>较差
		$this->view->shut_case_options 			= $cd_shut_case; //关锁情况|radio|1=>无关锁,2=>关锁,3=>关锁已解除
		$this->view->hospitalization_options 	= $cd_hospitalization; //住院情况|radio|0=>从未住院,1=>目前正在住院,2=>既往住院，现未住院		
		$this->view->compliance_options 		= $cd_comply; //服药依从性|radio|1=>规律,2=>间断,3=>不服药
		$this->view->lab_examination_options 	= $adverse_drug_reaction; //实验室检查|radio|1=>无,2=>有
		$this->view->lab_examination_json	 	= json_encode($adverse_drug_reaction); //实验室检查|radio|1=>无,2=>有
		$this->view->adverse_drug_options 		= $adverse_drug_reaction; //药物不良反应|radio|1=>无,2=>有
		$this->view->adverse_drug_json	 		= json_encode($adverse_drug_reaction); //药物不良反应|radio|1=>无,2=>有
		$this->view->treatment_effect_options 	= $cd_treatment_effect; //治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重
		$this->view->followup_classification_options =$cd_followup_classification; //此次随访分类|radio|1=>稳定,2=>基本稳定,3=>不稳定
		$this->view->is_referral_options 		= $cd_is_referral; //是否转诊|radio|1=>否,2=>是
		$this->view->is_referral_json 			= json_encode($cd_is_referral); //是否转诊|radio|1=>否,2=>是 转成json格式
		$drug_usage_frequency					= array('1'=>'每日','2'=>'每月');
		$this->view->drug_usage_frequency1_options  = $drug_usage_frequency; //用法1|radio|1=>每日,2=>每月
		$this->view->drug_usage_frequency2_options  = $drug_usage_frequency; //用法2|radio|1=>每日,2=>每月
		$this->view->drug_usage_frequency3_options  =$drug_usage_frequency; //用法3|radio|1=>每日,2=>每月
		$this->view->rehabilitation_measures_options =$cd_rehabilitation_measures; //康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它
		$this->view->rehabilitation_measures_json	 =json_encode($cd_rehabilitation_measures); //康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它

		if(empty($uuid)){
			//添加
			if(empty($individual_session->uuid)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			//2012-02-21仅查询正常档案
			if($individual_session->status_flag!=1){
	            message("你选择了一个非正常档案，请重新选择",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
	        }
			//精神分裂是否得到确症
			//$is_schizophreniaer						= is_clinical_history($individual_session->uuid,8);
			//if($is_schizophreniaer==0){
			//	message("居民“".$individual_session->name."”还不是重性精神疾病患者,请到个人档案中确症!",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			//}
			$this->view->name 						= $individual_session->name;//姓名
			$this->view->serial_num 				= $individual_session->standard_code_1;//档案编号
			$this->view->fllowup_time_year			= date("Y");//随访日期
			$this->view->fllowup_time_month			= date("m");//随访日期
			$this->view->fllowup_time_day			= date("d");//随访日期

			$this->view->next_followup_time_year= date("Y");//下次随访日期
			$this->view->next_followup_time_month	= date("m");//下次随访日期
			$this->view->next_followup_time_day		= date("d");//下次随访日期
			$region_users							= region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users				= $region_users;
			$this->view->followup_doctor			= $this->user['uuid'];//转诊医生

		}else{
			//修改
			$schizophrenia 		=	new Tschizophrenia();
			$schizophrenia->whereAdd("uuid='$uuid'");
			//$count              =  $schizophrenia->count();
			$schizophrenia->find();
			$schizophrenia->fetch();
			$this->view->uuid						= $schizophrenia->uuid;
			$fllowup_time							= $schizophrenia->fllowup_time;//随访日期

			$individual_inf=get_individual_info($schizophrenia->id);//取得个人信息中所有信息
			$this->view->name 						= $individual_inf->name;//姓名
			$this->view->serial_num 				= $individual_inf->standard_code_1;//档案编号

			$this->view->fllowup_time_year			= empty($fllowup_time)?'':date("Y",$fllowup_time);//随访日期
			$this->view->fllowup_time_month			= empty($fllowup_time)?'':date("m",$fllowup_time);//随访日期
			$this->view->fllowup_time_day			= empty($fllowup_time)?'':date("d",$fllowup_time);//随访日期

			$this->view->risk_current 				= array_search_for_other($schizophrenia->insight,$cd_risk);//危险性|radio|0=>(0级),1=>(1级),2=>(2级),3=>(3级),4=>(4级),5(5级)
			//$this->view->present_symptoms_options 	= $cd_present_symptoms; //目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
			$present_symptoms_arr=@explode('|',$schizophrenia->present_symptoms);//
			$present_symptoms_arrray=array();//存放症状
			foreach ($present_symptoms_arr as $present_symptoms_val){
				$present_symptoms_arrray[]=array_search_for_other($present_symptoms_val,$cd_present_symptoms);
			}

			$this->view->present_symptoms_current 	= $present_symptoms_arrray;//目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
			$this->view->present_symptoms_num		= count($present_symptoms_arrray)-1;//出现症状数

			$this->view->present_symptoms_other 	= $schizophrenia->present_symptoms_other;//目前症状其它

			//$this->view->insight_options 			= $cd_insight; //自知力|radio|1=>自知力完全,2=>自知力不全,3=>自知力缺失
			$this->view->insight_current 			= array_search_for_other($schizophrenia->insight,$cd_insight);//自知力|radio|1=>自知力完全,2=>自知力不全,3=>自知力缺失

			//$this->view->sleep_quality_options 		= $cd_sleep_quality; //睡眠情况|radio|1=>良好,2=>一般,3=>较差
			$this->view->sleep_quality_current 		= array_search_for_other($schizophrenia->sleep_quality,$cd_sleep_quality);//睡眠情况|radio|1=>良好,2=>一般,3=>较差

			//$this->view->diet_options 				= $cd_diet; //饮食情况|radio|1=>良好,2=>一般,3=>较差
			$this->view->diet_current 				= array_search_for_other($schizophrenia->diet,$cd_diet);//饮食情况|radio|1=>良好,2=>一般,3=>较差

			//$this->view->personlife_do_options 		= $cd_personlife_do; //个人生活料理|radio|1=>良好,2=>一般,3=>较差
			$this->view->personlife_do_current 		= array_search_for_other($schizophrenia->personlife_do,$cd_personlife_do);//个人生活料理|radio|1=>良好,2=>一般,3=>较差

			//$this->view->housework_options 			= $cd_housework; //家务劳动|radio|1=>良好,2=>一般,3=>较差
			$this->view->housework_current 			= array_search_for_other($schizophrenia->housework,$cd_housework);//家务劳动|radio|1=>良好,2=>一般,3=>较差

			//$this->view->work_options 				= $cd_work; //生产劳动及工作|radio|1=>良好,2=>一般,3=>较差,9=>此项不适用
			$this->view->work_current 				= array_search_for_other($schizophrenia->work,$cd_work);//生产劳动及工作|radio|1=>良好,2=>一般,3=>较差,9=>此项不适用

			//$this->view->learning_options 			= $cd_learning; //学习能力|radio|1=>良好,2=>一般,3=>较差
			$this->view->learning_current 			= array_search_for_other($schizophrenia->learning,$cd_learning);//学习能力|radio|1=>良好,2=>一般,3=>较差

			//$this->view->human_communication_options =$cd_human_communication; //社会人际交往|radio|1=>良好,2=>一般,3=>较差
			$this->view->human_communication_current = array_search_for_other($schizophrenia->human_communication,$cd_human_communication);//社会人际交往|radio|1=>良好,2=>一般,3=>较差
			$this->view->mild_trouble 				= $schizophrenia->mild_trouble;//轻度滋事
			$this->view->accident 					= $schizophrenia->accident;//肇事
			$this->view->zhaohuo 					= $schizophrenia->zhaohuo;//肇祸
			$this->view->self_wounding 				= $schizophrenia->self_wounding;//自伤
			$this->view->attmpted_suicide 			= $schizophrenia->attmpted_suicide;//自杀未遂
			$this->view->lab_examination 			= $schizophrenia->lab_examination;//室验室检查
			
			$this->view->shut_case_current 			= array_search_for_other($schizophrenia->shut_case,$cd_shut_case);//关锁情况
			$this->view->hospitalization_current 	= array_search_for_other($schizophrenia->hospitalization,$cd_hospitalization);//住院情况
			$discharge_time							= $schizophrenia->discharge_time;//住院情况末次出院时间
			$this->view->discharge_time				= empty($discharge_time)?'':date("Y-m-d",$discharge_time);;//住院情况末次出院时间

			//$this->view->compliance_options 		= $cd_comply; //服药依从性|radio|1=>规律,2=>间断,3=>不服药
			$this->view->compliance_current 		= array_search_for_other($schizophrenia->compliance,$cd_comply);//服药依从性|radio|1=>规律,2=>间断,3=>不服药

			$this->view->is_lab_examination_current	= array_search_for_other($schizophrenia->is_lab_examination_current,$adverse_drug_reaction);//实验室检查|radio|1=>无,2=>有
			$this->view->lab_examination 			= $schizophrenia->lab_examination;//实验室检查内容
			
			//$this->view->adverse_drug_options 		= $adverse_drug_reaction; //药物不良反应|radio|1=>无,2=>有
			$this->view->adverse_drug_current		= array_search_for_other($schizophrenia->adverse_drug,$adverse_drug_reaction);//药物不良反应|radio|1=>无,2=>有
			$this->view->adverse_drug_info 			= $schizophrenia->adverse_drug_info;//药物不良反应内容

			//$this->view->treatment_effect_options 	=$cd_treatment_effect; //治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重
			$this->view->treatment_effect_current 	= array_search_for_other($schizophrenia->treatment_effect,$cd_treatment_effect);//治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重

			//$this->view->followup_classification_options =$cd_followup_classification; //此次随访分类|radio|1=>稳定,2=>基本稳定,3=>不稳定
			$this->view->followup_classification_current = array_search_for_other($schizophrenia->followup_classification,$cd_followup_classification);//此次随访分类|radio|1=>稳定,2=>基本稳定,3=>不稳定

			//$this->view->is_referral_options 		= $cd_is_referral; //是否转诊|radio|1=>否,2=>是
			$this->view->is_referral_current 		= array_search_for_other($schizophrenia->is_referral,$cd_is_referral);//是否转诊|radio|1=>否,2=>是
			$this->view->reason_referral 			= $schizophrenia->reason_referral;//转诊原因
			$this->view->hospital_referral 			= $schizophrenia->hospital_referral;//转诊医院
			$this->view->drug_name1 				= $schizophrenia->drug_name1;//药物名1
			/**
		     * 表注释:用法1|radio|1=>每日,2=>每月
		     * 
		     * 
		     **/
			//$drug_usage_frequency					= array('1'=>'每日','2'=>'每月');

			//$this->view->drug_usage_frequency1_options  = $drug_usage_frequency; //用法1|radio|1=>每日,2=>每月
			$this->view->drug_usage_frequency1_current  = $schizophrenia->drug_usage_frequency1;//用法1|radio|1=>每日,2=>每月
			$this->view->drug_usage1 					= $schizophrenia->drug_usage1;//用法多少次1
			$this->view->drug_dose1 					= $schizophrenia->drug_dose1;//每次剂量1
			$this->view->drug_name2 					= $schizophrenia->drug_name2;//药物名2

			//$this->view->drug_usage_frequency2_options  = $drug_usage_frequency; //用法2|radio|1=>每日,2=>每月
			$this->view->drug_usage_frequency2_current  = $schizophrenia->drug_usage_frequency2;//用法2|radio|1=>每日,2=>每月
			$this->view->drug_usage2 					= $schizophrenia->drug_usage2;//用法多少次2
			$this->view->drug_dose2 					= $schizophrenia->drug_dose2;//每次剂量2
			$this->view->drug_name3 					= $schizophrenia->drug_name3;//药物名3

			//$this->view->drug_usage_frequency3_options =$drug_usage_frequency; //用法3|radio|1=>每日,2=>每月
			$this->view->drug_usage_frequency3_current = $schizophrenia->drug_usage_frequency3;//用法3|radio|1=>每日,2=>每月
			$this->view->drug_usage3				   = $schizophrenia->drug_usage3;//用法多少次3
			$this->view->drug_dose3 				   = $schizophrenia->drug_dose3;//每次剂量3

			//$this->view->rehabilitation_measures_options =$cd_rehabilitation_measures; //康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它
			$rehabilitation_measures_arr=@explode('|',$schizophrenia->rehabilitation_measures);//康复措施
			$rehabilitation_measures_arrray=array();//康复措施
			foreach ($rehabilitation_measures_arr as $rehabilitation_measures_val){
				$rehabilitation_measures_arrray[]=array_search_for_other($rehabilitation_measures_val,$cd_rehabilitation_measures);
			}
			$this->view->rehabilitation_measures_current = $rehabilitation_measures_arrray;//康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它
			$this->view->rehabilitation_measure_other  = $schizophrenia->rehabilitation_measure_other;//康复措施其它
			$next_followup_time						   = $schizophrenia->next_followup_time;//下次随访日期
			$this->view->next_followup_time_year	   = empty($next_followup_time)?'':date("Y",$next_followup_time);;//下次随访日期
			$this->view->next_followup_time_month	   = empty($next_followup_time)?'':date("m",$next_followup_time);;//下次随访日期
			$this->view->next_followup_time_day	   	   = empty($next_followup_time)?'':date("d",$next_followup_time);;//下次随访日期
			//$this->view->followup_doctor 			   = $schizophrenia->followup_doctor;//随访医生签名
			$region_users							   = empty($this->user['current_region_path_domain'])?'':region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users				   = $region_users;
			$this->view->followup_content  			   = $schizophrenia->followup_content;//转诊内容
			$this->view->followup_doctor  			   = $schizophrenia->followup_doctor;//转诊医生

		}
		$this->view->display("print.html");
	}
	/**
	 * 添加、修改精神分裂随访
	 *
	 */

	public function updateAction(){
		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		$uuid 								= $this->_request->getParam('uuid');//编号
		$schizophrenia						= new Tschizophrenia();
		$fllowup_time_year					= $this->_request->getParam('fllowup_time_year');
		$fllowup_time_month					= $this->_request->getParam('fllowup_time_month');
		$fllowup_time_day					= $this->_request->getParam('fllowup_time_day');
		$fllowup_time						= empty($fllowup_time_year)?'':adodb_mktime(0,0,0,$fllowup_time_month,$fllowup_time_day,$fllowup_time_year);
		$schizophrenia->fllowup_time 		= $fllowup_time;//随访日期
        $schizophrenia->risk 				= array_code_change($this->_request->getParam('risk'),$cd_risk);//危险性|radio|0=>(0级),1=>(1级),2=>(2级),3=>(3级),4=>(4级),5(5级)
        $schizophrenia->shut_case 			= array_code_change($this->_request->getParam('shut_case'),$cd_shut_case);//关锁情况|radio|1=>无关锁,2=>关锁,3=>关锁已解除
		$schizophrenia->hospitalization		= array_code_change($this->_request->getParam('hospitalization'),$cd_hospitalization);//住院情况|radio|0=>从未住院,1=>目前正在住院,2=>既往住院，现未住院
		
		$discharge_time  					= $this->_request->getParam('discharge_time');//住院情况末次出院时间
		$schizophrenia->discharge_time		= empty($discharge_time)?'':mkunixstamp($discharge_time);//住院情况末次出院时间
		
		$present_symptoms_array				= $this->_request->getParam('present_symptoms');//目前症状

		$symptom_str='';
		foreach ($present_symptoms_array as $k=>$v){
			if(isset($cd_present_symptoms[$v][0])){
				$symptom_str.=$cd_present_symptoms[$v][0].'|';//症状
				if ($cd_present_symptoms[$v][0]=='-99'){
					$schizophrenia->present_symptoms_other = $this->_request->getParam('present_symptoms_other');//目前症状其它
				}
			}
		}

		$schizophrenia->present_symptoms = $symptom_str;//目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它



		$schizophrenia->insight 			= array_code_change($this->_request->getParam('insight'),$cd_insight);//自知力|radio|1=>自知力完全,2=>自知力不全,3=>自知力缺失

		$schizophrenia->sleep_quality 		= array_code_change($this->_request->getParam('sleep_quality'),$cd_sleep_quality);//睡眠情况|radio|1=>良好,2=>一般,3=>较差

		$schizophrenia->diet 				= array_code_change($this->_request->getParam('diet'),$cd_diet);//饮食情况|radio|1=>良好,2=>一般,3=>较差

		$schizophrenia->personlife_do		= array_code_change($this->_request->getParam('personlife_do'),$cd_personlife_do);//个人生活料理|radio|1=>良好,2=>一般,3=>较差

		$schizophrenia->housework 			= array_code_change($this->_request->getParam('housework'),$cd_housework);//家务劳动|radio|1=>良好,2=>一般,3=>较差

		$schizophrenia->work 				= array_code_change($this->_request->getParam('work'),$cd_work);//生产劳动及工作|radio|1=>良好,2=>一般,3=>较差,9=>此项不适用

		$schizophrenia->learning 			= array_code_change($this->_request->getParam('learning'),$cd_learning);//学习能力|radio|1=>良好,2=>一般,3=>较差

		$schizophrenia->human_communication = array_code_change($this->_request->getParam('human_communication'),$cd_human_communication);//社会人际交往|radio|1=>良好,2=>一般,3=>较差

		$schizophrenia->mild_trouble 		= $this->_request->getParam('mild_trouble');//轻度滋事

		$schizophrenia->accident			= $this->_request->getParam('accident');//肇事

		$schizophrenia->zhaohuo 			= $this->_request->getParam('zhaohuo');//肇祸

		$schizophrenia->self_wounding 		= $this->_request->getParam('self_wounding');//自伤

		$schizophrenia->attmpted_suicide 	= $this->_request->getParam('attmpted_suicide');//自杀未遂

		$schizophrenia->lab_examination 	= $this->_request->getParam('lab_examination');//室验室检查内容
		$schizophrenia->is_lab_examination 	= $this->_request->getParam('is_lab_examination');//室验室检查|radio|1=>无,2=>有
		

		$schizophrenia->compliance 			= array_code_change($this->_request->getParam('compliance'),$cd_comply);//服药依从性|radio|1=>规律,2=>间断,3=>不服药

		$schizophrenia->adverse_drug 		= array_code_change($this->_request->getParam('adverse_drug'),$adverse_drug_reaction);//药物不良反应|radio|1=>无,2=>有

		$schizophrenia->adverse_drug_info 	= $this->_request->getParam('adverse_drug_info');//药物不良反应内容

		$schizophrenia->treatment_effect 	= array_code_change($this->_request->getParam('treatment_effect'),$cd_treatment_effect);//治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重

		$schizophrenia->followup_classification = array_code_change($this->_request->getParam('followup_classification'),$cd_followup_classification);//此次随访分类|radio|1=>稳定,2=>基本稳定,3=>不稳定

		$schizophrenia->is_referral 		= array_code_change($this->_request->getParam('is_referral'),$cd_is_referral);//是否转诊|radio|1=>否,2=>是

		$schizophrenia->reason_referral 	= $this->_request->getParam('reason_referral');//转诊原因

		$schizophrenia->hospital_referral 	= $this->_request->getParam('hospital_referral');//转诊医院

		$schizophrenia->drug_name1 			= $this->_request->getParam('drug_name1');//药物名1

		$schizophrenia->drug_usage_frequency1 = $this->_request->getParam('drug_usage_frequency1');//用法1|radio|1=>每日,2=>每月

		$schizophrenia->drug_usage1 		= $this->_request->getParam('drug_usage1');//用法多少次1

		$schizophrenia->drug_dose1 			= $this->_request->getParam('drug_dose1');//每次剂量1

		$schizophrenia->drug_name2 			= $this->_request->getParam('drug_name2');//药物名2

		$schizophrenia->drug_usage_frequency2 = $this->_request->getParam('drug_usage_frequency2');//用法2|radio|1=>每日,2=>每月

		$schizophrenia->drug_usage2 		= $this->_request->getParam('drug_usage2');//用法多少次2

		$schizophrenia->drug_dose2 			= $this->_request->getParam('drug_dose2');//每次剂量2

		$schizophrenia->drug_name3 			= $this->_request->getParam('drug_name3');//药物名3

		$schizophrenia->drug_usage_frequency3 = $this->_request->getParam('drug_usage_frequency3');//用法3|radio|1=>每日,2=>每月

		$schizophrenia->drug_usage3 		= $this->_request->getParam('drug_usage3');//用法多少次3

		$schizophrenia->drug_dose3 			= $this->_request->getParam('drug_dose3');//每次剂量3

		$rehabilitation_measures_arr		= $this->_request->getParam('rehabilitation_measures');//康复措施|checkbox|1=>生活劳动能力,2=>职业训练,3=>学习能力,4=>社会交往,5=>其它

		$rehabilitation_measures_str='';
		foreach ($rehabilitation_measures_arr as $k=>$v){
			if(isset($cd_rehabilitation_measures[$v][0])){
				$rehabilitation_measures_str.=$cd_rehabilitation_measures[$v][0].'|';//
				if ($cd_rehabilitation_measures[$v][0]=='-99'){
					$schizophrenia->rehabilitation_measure_other = $this->_request->getParam('rehabilitation_measure_other');//康复措施其它
				}
			}
		}

		$schizophrenia->rehabilitation_measures= $rehabilitation_measures_str;

		$next_followup_time_year 			= $this->_request->getParam('next_followup_time_year');//下次随访日期
		$next_followup_time_month 			= $this->_request->getParam('next_followup_time_month');//下次随访日期
		$next_followup_time_day 			= $this->_request->getParam('next_followup_time_day');//下次随访日期
		$tips_time							= empty($next_followup_time_year)?'':adodb_mktime(0,0,0,$next_followup_time_month,$next_followup_time_day,$next_followup_time_year);//下次随访日期
		$schizophrenia->next_followup_time  = $tips_time;//下次随访时间
		$schizophrenia->followup_content 	= $this->_request->getParam('followup_content');//随访内容
		$schizophrenia->followup_doctor 	= $this->_request->getParam('followup_doctor');//随访医生签名
		$tips_error							= "";//精神分裂随访错误
		if(empty($uuid)){
			//添加
			$uuid						=uniqid("cd",true);//编号

			$schizophrenia->uuid = $uuid;//编号

			$schizophrenia->staff_id 	= $this->user['uuid'];//医生档案号
			$individual_session 		= new Zend_Session_Namespace("individual_core");

			$schizophrenia->id 			= $individual_session->uuid;//个人档案号

			$schizophrenia->created 	= time();//添加记录时间
			$tips_error					= create_tips($this->user['uuid'],$individual_session->uuid,$this->user['current_region_path'],($tips_time?date("Y-m-d",$tips_time):"")."精神分裂随访计划","精神分裂随访",$tips_time,__BASEPATH."cd/schizophrenia/add/uuid/".$uuid,$tips_info="本次随访结果：".$this->_request->getParam('followup_content'),$fllowup_time);
			if($tips_error==="error_01"){
				$tips_error=",<font color='red'>工作计划添加失败，无法找到对应的计划类型，请省系统管理员添加【精神分裂随访】的计划类型。</font>";
			}else{
				$tips_error=",对应的工作计划已经自动添加！";
			}
			//$schizophrenia->debugLevel(8);
			$update_token				= $schizophrenia->insert();

		}else{
			//修改
			$schizophrenia->whereAdd("uuid='$uuid'");
			$update_token				= $schizophrenia->update();

		}
		if($update_token==true){
			message("重性精神疾病随访更新成功{$tips_error}",array("重性精神疾病患者随访服务记录列表"=>__BASEPATH.'cd/schizophrenia/index',"添加"=>__BASEPATH."cd/schizophrenia/add","修改"=>__BASEPATH."cd/schizophrenia/add/uuid/{$uuid}"));
		}else{
			message("重性精神疾病随访更新失败！",array("重性精神疾病患者随访服务记录列表"=>__BASEPATH.'cd/schizophrenia/index',"添加"=>__BASEPATH."cd/schizophrenia/add","修改"=>__BASEPATH."cd/schizophrenia/add/uuid/{$uuid}"));
		}

	}
	/**
	 * 删除随访
	 *
	 */
	public function delAction(){

		$uuid      		= $this->_request->getParam('uuid');//随访id
		if(!empty($uuid)){
			$schizophrenia=new Tschizophrenia();
			$schizophrenia->whereAdd("uuid='{$uuid}'");
			if($schizophrenia->delete()){
				//删除成功！
				message("删除成功！",array("重性精神疾病患者随访服务记录列表"=>__BASEPATH.'cd/schizophrenia/index',"添加"=>__BASEPATH."cd/schizophrenia/add"));
			}else{
				//删除失败！
				message("删除失败！",array("重性精神疾病患者随访服务记录列表"=>__BASEPATH.'cd/schizophrenia/index',"添加"=>__BASEPATH."cd/schizophrenia/add"));
			}
		}else{
			message("参数错误！",array("重性精神疾病患者随访服务记录列表"=>__BASEPATH.'cd/schizophrenia/index'));
		}

	}

	/**
	 * 重性精神疾病患者个人信息补充表
	 *
	 */
	public function supptabAction(){
		$serial_number     		= $this->_request->getParam('id');//个人档案id
		if(!empty($serial_number)){
			//获取个人信息
			$individual_inf=get_individual_info($serial_number);//取得个人信息中所有信息
			if($this->haveWritePrivilege)
			{
				$this->view->user_name = $individual_inf->name;//居民姓名
				$this->view->standard_code = $individual_inf->standard_code_1;//标准档案号
			}
			else
			{
				$this->view->user_name = "*";//居民姓名
				$this->view->standard_code = "*";//标准档案号
			}

			require_once __SITEROOT.'/library/data_arr/arrdata.php';
			$this->view->present_symptoms_options 	= $cd_present_symptoms; //目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
			$this->view->present_symptoms_json	 	= json_encode($cd_present_symptoms); //目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它
			$this->view->treatment_effect_options 	= $cd_treatment_effect; //最近一次治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重
			$this->view->shut_case_options 			= $cd_shut_case; //关锁情况|radio|1=>无关锁,2=>关锁,3=>关锁已解除
			$this->view->outpatient_options 		= $cd_outpatient; //既往治疗情况门诊|radio|1=>未治,2=>间断门诊治疗,3=>连续门诊治疗
			$this->view->economic_conditions_array	= $cd_economic_conditions;//经济状况|radio|1=>贫困，在当地贫困线标准以下,2=>非贫困,3=>不详 
			$this->view->informed_consent_options 	= $cd_informed_consent; //知情同意|radio|1=>同意参加管理,0=>不同意参加管理
			
			$schizophreniaer_supp_tabs=new Tschizophreniaer_supp_tabs();
			$schizophreniaer_supp_tabs->whereAdd("id='{$serial_number}'");
			$count=$schizophreniaer_supp_tabs->count("*");
			if($count>0){
				//修改页面

				$schizophreniaer_supp_tabs->find();
				$schizophreniaer_supp_tabs->fetch();
				$this->view->uuid 					= $schizophreniaer_supp_tabs->uuid;//编号
				$this->view->staff_id 				= $schizophreniaer_supp_tabs->staff_id;//医生档案号
				$this->view->id 					= $schizophreniaer_supp_tabs->id;//个人档案号
				$this->view->guardian_name 			= $schizophreniaer_supp_tabs->guardian_name;//监护人姓名
				$this->view->relationship_with_patients = $schizophreniaer_supp_tabs->relationship_with_patients;//与患者关系
				$this->view->guardian_address 		= $schizophreniaer_supp_tabs->guardian_address;//监护人地址
				$this->view->guardian_phone 		= $schizophreniaer_supp_tabs->guardian_phone;//监护人电话
				$this->view->contact_area 			= $schizophreniaer_supp_tabs->contact_area;//辖区村（居）委会联系人
				$this->view->phone_area 			= $schizophreniaer_supp_tabs->phone_area;//辖区村（居）委会联系电话
				
				$this->view->informed_consent_current 	= array_search_for_other($schizophreniaer_supp_tabs->informed_consent,$cd_informed_consent);//知情同意|radio|1=>同意参加管理,0=>不同意参加管理
				$this->view->informed_consent_sign 		= $schizophreniaer_supp_tabs->informed_consent_sign;//知情同意-签字
				$this->view->informed_consent_sign_time = empty($schizophreniaer_supp_tabs->informed_consent_sign_time)?'':adodb_date("Y-m-d",$schizophreniaer_supp_tabs->informed_consent_sign_time);//知情同意-时间

				
				$this->view->onset_time 				= empty($schizophreniaer_supp_tabs->onset_time)?'':adodb_date("Y-m-d",$schizophreniaer_supp_tabs->onset_time);//初次发病时间


				$present_symptoms_arr=@explode('|',$schizophreniaer_supp_tabs->main_symptomsed);//
				$present_symptoms_arrray=array();//存放症状
				foreach ($present_symptoms_arr as $present_symptoms_val){
					$present_symptoms_arrray[]=array_search_for_other($present_symptoms_val,$cd_present_symptoms);
				}

				$this->view->main_symptomsed_current = $present_symptoms_arrray;//既往主要症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故处走,10=>自语自笑,11=>孤僻懒散,12=>其它
				$this->view->main_symptomsed_other  = $schizophreniaer_supp_tabs->main_symptomsed_other;//既往主要症状其它

				$this->view->outpatient_current 	= array_search_for_other($schizophreniaer_supp_tabs->outpatient,$cd_outpatient);//既往治疗情况门诊|radio|1=>未治,2=>间断门诊治疗,3=>连续门诊治疗
				$this->view->hospital 				= $schizophreniaer_supp_tabs->hospital;//既然治疗情况住院次数
				$this->view->diagnosis 				= $schizophreniaer_supp_tabs->diagnosis;//诊断
				$this->view->hospital_diagnosis 	= $schizophreniaer_supp_tabs->hospital_diagnosis;//确诊医院
				$this->view->time_diagnosis 		= empty($schizophreniaer_supp_tabs->time_diagnosis)?'':adodb_date('Y-m-d',$schizophreniaer_supp_tabs->time_diagnosis);//确诊日期

				$this->view->therapeutic_effect_current = array_search_for_other($schizophreniaer_supp_tabs->therapeutic_effect,$cd_treatment_effect);//最近一次治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重
				$this->view->mild_trouble 			= $schizophreniaer_supp_tabs->mild_trouble;//轻度滋事
				$this->view->accident 				= $schizophreniaer_supp_tabs->accident;//肇事
				$this->view->zhaohuo 				= $schizophreniaer_supp_tabs->zhaohuo;//肇祸
				$this->view->self_wounding 			= $schizophreniaer_supp_tabs->self_wounding;//自伤
				$this->view->attmpted_suicide 		= $schizophreniaer_supp_tabs->attmpted_suicide;//自杀未遂

				$this->view->shut_case_current 		= array_search_for_other($schizophreniaer_supp_tabs->shut_case,$cd_shut_case);//关锁情况|radio|1=>无关锁,2=>关锁,3=>关锁已解除
				
				$this->view->economic_conditions 	= array_search_for_other($schizophreniaer_supp_tabs->economic_conditions,$cd_economic_conditions);//经济状况
				$this->view->specialist_advice		= $schizophreniaer_supp_tabs->specialist_advice;//专科医生意见

				$this->view->fill_time 				= empty($schizophreniaer_supp_tabs->fill_time)?'':adodb_date("Y-m-d",$schizophreniaer_supp_tabs->fill_time);//填表日期

				$region_users						= empty($this->user['current_region_path_domain'])?'':region_users($this->user['current_region_path_domain']);//所有的医生
				//print_r($region_users);
				$this->view->region_users		    = $region_users;
				$this->view->doctors_signature  	= $schizophreniaer_supp_tabs->doctors_signature;//医生签字

			}else{
				//添加页面
				$this->view->id 					    = $serial_number;//个人档案号
				$this->view->onset_time 				= adodb_date("Y-m-d");//初次发病时间
				$this->view->fill_time 					= adodb_date("Y-m-d");//填表日期
				$region_users							= region_users($this->user['current_region_path_domain']);//所有的医生
				//print_r($region_users);
				$this->view->region_users				= $region_users;
				//print_r($this->user['uuid']);
				$this->view->doctors_signature			= $this->user['uuid'];//医生签字
			}

		}else{
			message("参数错误！",array("重性精神疾病患者随访服务记录列表"=>__BASEPATH.'cd/schizophrenia/index'));
		}
		$this->view->display("supplementary_table.html");
	}
	/**
	 * 重性精神疾病患者个人信息补充表 添加、修改
	 *
	 */
	public function supptabupdateAction(){
		$serial_number     		= $this->_request->getParam('id');//个人档案id
		if(!empty($serial_number)){
			require_once __SITEROOT.'/library/data_arr/arrdata.php';
			$schizophreniaer_supp_tabs=new Tschizophreniaer_supp_tabs();
			$schizophreniaer_supp_tabs->whereAdd("id='{$serial_number}'");
			$count=$schizophreniaer_supp_tabs->count('*');//查看当前$serial_number是存在

			if($count>0){
				//修改补充表
				$schizophreniaer_supp_tabs->guardian_name 				= $this->_request->getParam('guardian_name');//监护人姓名

				$schizophreniaer_supp_tabs->relationship_with_patients  = $this->_request->getParam('relationship_with_patients');//与患者关系

				$schizophreniaer_supp_tabs->guardian_address 			= $this->_request->getParam('guardian_address');//监护人地址

				$schizophreniaer_supp_tabs->guardian_phone 				= $this->_request->getParam('guardian_phone');//监护人电话

				$schizophreniaer_supp_tabs->contact_area 				= $this->_request->getParam('contact_area');//辖区村（居）委会联系人

				$schizophreniaer_supp_tabs->phone_area 					= $this->_request->getParam('phone_area');//辖区村（居）委会联系电话
				$schizophreniaer_supp_tabs->informed_consent 			= array_code_change($this->_request->getParam('informed_consent'),$cd_informed_consent);//知情同意|radio|1=>同意参加管理,0=>不同意参加管理
				$schizophreniaer_supp_tabs->informed_consent_sign 		= $this->_request->getParam('informed_consent_sign');//知情同意签字
				$informed_consent_sign_time								= $this->_request->getParam('informed_consent_sign_time');//知情同意签字时间
				$schizophreniaer_supp_tabs->informed_consent_sign_time	= empty($informed_consent_sign_time)?'':mkunixstamp($informed_consent_sign_time);//知情同意签字时间
				
				
				$onset_time 											= $this->_request->getParam('onset_time');//初次发病时间
				$schizophreniaer_supp_tabs->onset_time 					= empty($onset_time)?'':mkunixstamp($onset_time);//初次发病时间
				$present_symptoms_array									= $this->_request->getParam('main_symptomsed');//既往主要症状

				$symptom_str='';
				foreach ($present_symptoms_array as $k=>$v){
					if(isset($cd_present_symptoms[$v][0])){
						$symptom_str.=$cd_present_symptoms[$v][0].'|';//症状
						if ($cd_present_symptoms[$v][0]=='-99'){
							$schizophreniaer_supp_tabs->main_symptomsed_other 		= $this->_request->getParam('main_symptomsed_other');//既往主要症状其它
						}
					}
				}

				$schizophreniaer_supp_tabs->main_symptomsed 			= $symptom_str;//目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它

				$schizophreniaer_supp_tabs->outpatient 					= array_code_change($this->_request->getParam('outpatient'),$cd_outpatient);//既往治疗情况门诊|radio|1=>未治,2=>间断门诊治疗,3=>连续门诊治疗

				$schizophreniaer_supp_tabs->hospital 					= $this->_request->getParam('hospital');//既然治疗情况住院次数

				$schizophreniaer_supp_tabs->diagnosis 					= $this->_request->getParam('diagnosis');//诊断

				$schizophreniaer_supp_tabs->hospital_diagnosis 			= $this->_request->getParam('hospital_diagnosis');//确诊医院
				$time_diagnosis 										= $this->_request->getParam('time_diagnosis');//确诊日期
				$schizophreniaer_supp_tabs->time_diagnosis 				= empty($time_diagnosis)?'':mkunixstamp($time_diagnosis);//确诊日期

				$schizophreniaer_supp_tabs->therapeutic_effect 			= array_code_change($this->_request->getParam('therapeutic_effect'),$cd_treatment_effect);//最近一次治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重

				$schizophreniaer_supp_tabs->mild_trouble 				= $this->_request->getParam('mild_trouble');//轻度滋事

				$schizophreniaer_supp_tabs->accident 					= $this->_request->getParam('accident');//肇事

				$schizophreniaer_supp_tabs->zhaohuo 					= $this->_request->getParam('zhaohuo');//肇祸

				$schizophreniaer_supp_tabs->self_wounding 				= $this->_request->getParam('self_wounding');//自伤

				$schizophreniaer_supp_tabs->attmpted_suicide 			= $this->_request->getParam('attmpted_suicide');//自杀未遂

				$schizophreniaer_supp_tabs->shut_case 					= array_code_change($this->_request->getParam('shut_case'),$cd_shut_case);//关锁情况|radio|1=>无关锁,2=>关锁,3=>关锁已解除
				$schizophreniaer_supp_tabs->economic_conditions 		= array_code_change($this->_request->getParam('economic_conditions'),$cd_economic_conditions);//经济状况
				$schizophreniaer_supp_tabs->specialist_advice			= $this->_request->getParam('specialist_advice');//专科医生意见
				
				$fill_time 												= $this->_request->getParam('fill_time');//填表日期
				$schizophreniaer_supp_tabs->fill_time 					= empty($fill_time)?'':mkunixstamp($fill_time);//填表日期

				$schizophreniaer_supp_tabs->doctors_signature 			= $this->_request->getParam('doctors_signature');//医生签字
				$token													= $schizophreniaer_supp_tabs->update();
				if($token){
					message("修改成功！",array("重性精神疾病患者随访服务记录列表"=>__BASEPATH.'cd/schizophrenia/index',"修改补充材料"=>__BASEPATH."cd/schizophrenia/supptab/id/{$serial_number}"));
				}else{
					message("修改失败！",array("重性精神疾病患者随访服务记录列表"=>__BASEPATH.'cd/schizophrenia/index'));
				}

			}else{
				//添加补充表
				$schizophreniaer_supp_tabs=new Tschizophreniaer_supp_tabs();
				$schizophreniaer_supp_tabs->uuid = uniqid('cd',true);//编号

				$schizophreniaer_supp_tabs->staff_id 					= $this->user['uuid'];//医生档案号

				$schizophreniaer_supp_tabs->id 							= $serial_number;//个人档案号

				$schizophreniaer_supp_tabs->created 					= time();//添加记录时间

				$schizophreniaer_supp_tabs->guardian_name 				= $this->_request->getParam('guardian_name');//监护人姓名

				$schizophreniaer_supp_tabs->relationship_with_patients  = $this->_request->getParam('relationship_with_patients');//与患者关系

				$schizophreniaer_supp_tabs->guardian_address 			= $this->_request->getParam('guardian_address');//监护人地址

				$schizophreniaer_supp_tabs->guardian_phone 				= $this->_request->getParam('guardian_phone');//监护人电话

				$schizophreniaer_supp_tabs->contact_area 				= $this->_request->getParam('contact_area');//辖区村（居）委会联系人

				$schizophreniaer_supp_tabs->phone_area 					= $this->_request->getParam('phone_area');//辖区村（居）委会联系电话

				$schizophreniaer_supp_tabs->informed_consent 			= array_code_change($this->_request->getParam('informed_consent'),$cd_informed_consent);//知情同意|radio|1=>同意参加管理,0=>不同意参加管理
				$schizophreniaer_supp_tabs->informed_consent_sign 		= $this->_request->getParam('informed_consent_sign');//知情同意签字
				$informed_consent_sign_time								= $this->_request->getParam('informed_consent_sign_time');//知情同意签字时间
				$schizophreniaer_supp_tabs->informed_consent_sign_time	= empty($informed_consent_sign_time)?'':mkunixstamp($informed_consent_sign_time);//知情同意签字时间
				
				$onset_time 											= $this->_request->getParam('onset_time');//初次发病时间
				$schizophreniaer_supp_tabs->onset_time 					= empty($onset_time)?'':mkunixstamp($onset_time);//初次发病时间

				$schizophreniaer_supp_tabs->main_symptomsed 			= $this->_request->getParam('main_symptomsed');//既往主要症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故处走,10=>自语自笑,11=>孤僻懒散,12=>其它

				$present_symptoms_array									= $this->_request->getParam('main_symptomsed');//既往主要症状

				$symptom_str='';
				foreach ($present_symptoms_array as $k=>$v){
					if(isset($cd_present_symptoms[$v][0])){
						$symptom_str.=$cd_present_symptoms[$v][0].'|';//症状
						if ($cd_present_symptoms[$v][0]=='-99'){
							$schizophreniaer_supp_tabs->main_symptomsed_other 		= $this->_request->getParam('main_symptomsed_other');//既往主要症状其它
						}
					}
				}

				$schizophreniaer_supp_tabs->main_symptomsed 						= $symptom_str;//目前症状|checkbox|1=>幻觉,2=>交流困难,3=>猜疑,4=>喜怒无常,5=>行为怪异,6=>兴奋话多,7=>伤人毁物,8=>悲观厌世,9=>无故外走,10=>自语自笑,11=>孤僻懒散,12=>其它


				$schizophreniaer_supp_tabs->outpatient 					= array_code_change($this->_request->getParam('outpatient'),$cd_outpatient);//既往治疗情况门诊|radio|1=>未治,2=>间断门诊治疗,3=>连续门诊治疗

				$schizophreniaer_supp_tabs->hospital 					= $this->_request->getParam('hospital');//既然治疗情况住院次数

				$schizophreniaer_supp_tabs->diagnosis 					= $this->_request->getParam('diagnosis');//诊断

				$schizophreniaer_supp_tabs->hospital_diagnosis 			= $this->_request->getParam('hospital_diagnosis');//确诊医院
				$time_diagnosis 										= $this->_request->getParam('time_diagnosis');//确诊日期
				$schizophreniaer_supp_tabs->time_diagnosis 				= empty($time_diagnosis)?'':mkunixstamp($time_diagnosis);//确诊日期

				$schizophreniaer_supp_tabs->therapeutic_effect 			= array_code_change($this->_request->getParam('therapeutic_effect'),$cd_treatment_effect);//最近一次治疗效果|radio|1=>痊愈,2=>好转,3=>无变化,4=>加重

				$schizophreniaer_supp_tabs->mild_trouble 				= $this->_request->getParam('mild_trouble');//轻度滋事

				$schizophreniaer_supp_tabs->accident 					= $this->_request->getParam('accident');//肇事

				$schizophreniaer_supp_tabs->zhaohuo 					= $this->_request->getParam('zhaohuo');//肇祸

				$schizophreniaer_supp_tabs->self_wounding 				= $this->_request->getParam('self_wounding');//自伤

				$schizophreniaer_supp_tabs->attmpted_suicide 			= $this->_request->getParam('attmpted_suicide');//自杀未遂

				$schizophreniaer_supp_tabs->shut_case 					= array_code_change($this->_request->getParam('shut_case'),$cd_shut_case);//关锁情况|radio|1=>无关锁,2=>关锁,3=>关锁已解除
				
				$schizophreniaer_supp_tabs->economic_conditions 		= array_code_change($this->_request->getParam('economic_conditions'),$cd_economic_conditions);//经济状况
				$schizophreniaer_supp_tabs->specialist_advice			= $this->_request->getParam('specialist_advice');//专科医生意见
				$fill_time 												= $this->_request->getParam('fill_time');//填表日期
				$schizophreniaer_supp_tabs->fill_time 					= empty($fill_time)?'':mkunixstamp($fill_time);//填表日期

				$schizophreniaer_supp_tabs->doctors_signature 			= $this->_request->getParam('doctors_signature');//医生签字

				$token													= $schizophreniaer_supp_tabs->insert();
				if($token){
					message("添加成功！",array("重性精神疾病患者随访服务记录列表"=>__BASEPATH.'cd/schizophrenia/index',"修改补充材料"=>__BASEPATH."cd/schizophrenia/supptab/id/{$serial_number}"));
				}else{
					message("添加失败！",array("重性精神疾病患者随访服务记录列表"=>__BASEPATH.'cd/schizophrenia/index'));
				}
			}

		}else{
			message("参数错误！",array("重性精神疾病患者随访服务记录列表"=>__BASEPATH.'cd/schizophrenia/index'));
		}
	}


}
?>