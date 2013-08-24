<?php 
/**
 * 1～2岁儿童健康检查记录表
 * @author mask
 *
 */
class children_childrentwoController extends controller{
	public function init(){
		$this->view->assign( "basePath", __BASEPATH );
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';//通用类
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once __SITEROOT."library/Models/individual_core.php";//个人信息主表
		require_once __SITEROOT."library/Models/child_physical_two.php";//1～2岁儿童健康检查记录表
	}
    /**
     * 按个人列表
     *
     */
	public function indexAction(){
		//初始化搜索条件
		$search=array();
		$search['username']=$this->_request->getParam('username');//姓名包含拼音
		$search['staff_id']=($this->_request->getParam('staff_id')=="-9")?"":$this->_request->getParam('staff_id');//建档医生
		$search['standard_code']=$this->_request->getParam('standard_code');//标准档案号
		$search['identity_number']=$this->_request->getParam('identity_number');//身份证号
		
		$search['display'] = $this->_request->getParam('display');//显示状态
		$search['created_start_time'] = $this->_request->getParam('created_start_time');//开始时间
		$search['created_end_time'] = $this->_request->getParam('created_end_time');//结束时间
		$org_id = $this->_request->getParam('region_p_id')?$this->_request->getParam('region_p_id'):$this->user['region_id'];//机构id
		$individual_core_region_path_domain = get_region_path(1, $org_id);
		$search['region_p_id']=$org_id;
		
		//医生列表
		$org_region_domain=$this->user['current_region_path_domain'];
		$temp=explode("|",$org_region_domain);
		$hypertension_core_region_path_domain='';
		$staff_core_region_path_domain='';
		foreach ($temp as $k1=>$v1){
			$hypertension_core_region_path_domain=$hypertension_core_region_path_domain."individual_core.region_path like '".$v1."%' or ";
			$staff_core_region_path_domain=$staff_core_region_path_domain."staff_core.region_path like '".$v1."%' or ";
		}
		$hypertension_core_region_path_domain=rtrim($hypertension_core_region_path_domain,' or ');
		$staff_core_region_path_domain=rtrim($staff_core_region_path_domain,' or ');
		//2013-8-18 修改 以前不能读出随访医生
//		$staff_core=new Tstaff_core();
//		$staff_archive=new Tstaff_archive();
//		$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
//		$staff_core->whereAdd($staff_core_region_path_domain);
//		$staff_core->find();
//		$responseDoctorArray=array();
//		$responseDoctorArray[0]['zh_name']='请选择';
//		$responseDoctorArray[0]['id']='-9';
//		$counter=1;
//		while ($staff_core->fetch()) {
//			//生成负责医生下拉框
//			$responseDoctorArray[$counter]['zh_name']=$staff_archive->name_real;
//			$responseDoctorArray[$counter]['id']=$staff_core->id;
//			if ($search['staff_id']==$staff_core->id)
//			{
//				$responseDoctorArray[$counter]['selected']='selected';
//			}
//			else
//			{
//				$responseDoctorArray[$counter]['selected']='';
//			}
//			$counter++;
//		}
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$search['staff_id']);

		$child_physical_two=new Tchild_physical_two();
		$core=new Tindividual_core();
		$child_physical_two->whereAdd($hypertension_core_region_path_domain);
		$child_physical_two->joinAdd('left',$child_physical_two,$core,'id','uuid');
		if ($search['staff_id'])
		{
			$child_physical_two->whereAdd("child_physical_two.staff_id = '".$search['staff_id']."'");
		}
		if ($search['username'])
		{
			$child_physical_two->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if ($search['standard_code'])
		{
			$child_physical_two->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$child_physical_two->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
		//开始时间查询
		if($search['created_start_time']!=''){
			$created_start_time=strtotime($search['created_start_time']);
			$child_physical_two->whereAdd("child_physical_two.vist_time>={$created_start_time}");
		}		
		//结束时间查询
		if($search['created_end_time']!=''){
			$created_end_time=strtotime($search['created_end_time']);
			$child_physical_two->whereAdd("child_physical_two.vist_time<={$created_end_time}");
		}	
		$child_physical_two->whereAdd($individual_core_region_path_domain);	
		$nums=$child_physical_two->count("distinct child_physical_two.id");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'children/childrentwo/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//$child_physical_two->debugLevel(5);
		//$core->selectAdd("individual_core.uuid as uuid");
		$child_physical_two->selectAdd("child_physical_two.id as id,individual_core.standard_code_1,individual_core.identity_number,individual_core.name as name,individual_core.name_pinyin as name_pinyin,count(child_physical_two.uuid) as snums");
		$child_physical_two->groupBy("child_physical_two.id,individual_core.name,individual_core.name_pinyin,individual_core.standard_code_1,individual_core.identity_number");
		//处理分页
		$child_physical_two->limit($startnum,__ROWSOFPAGE);
		$child_physical_two->find();
		$child_physical_array=array();
		$i=0;
		while ($child_physical_two->fetch())
		{
			$child_physical_array[$i]['snums']				= $child_physical_two->snums;
			$child_physical_array[$i]['id']					= $child_physical_two->id;
			if($this->haveWritePrivilege){
				$child_physical_array[$i]['ssname']			= $child_physical_two->name;
			}
			else
			{
				$child_physical_array[$i]['ssname']			= "*";
			}
			$child_physical_array[$i]['name']				= get_individual_info($child_physical_two->id);//用户姓名
			$child_physical_latest							= $this->getChildrenInfo($child_physical_two->id);//最新儿童体检信息
			//print_r($child_physical_latest);
			$child_physical_array[$i]['followup_time']		= empty($child_physical_latest['vist_time'])?'':adodb_date("Y-m-d",$child_physical_latest['vist_time']);//随访时间
			$child_physical_array[$i]['followup_doctor']	= get_staff_name_byid($child_physical_latest['doctors_signature']);//随访医生
			$i++;
		}
		$out = $links->subPageCss2();

//		$this->view->response_doctor=$responseDoctorArray;
		$this->view->search=$search;
		$this->view->assign("pager",$out);
//		$this->view->assign('region_id', $this->user['region_id']);//地区
//		if($org_id!=''){
        	$this->view->assign('region_p_id', $org_id);//地区
//		}else{
//			$this->view->assign('region_p_id', $this->user['region_id']);//地区
//		}
	
        if($search['created_start_time']!=''){
        	$this->view->assign('created_start_time', $search['created_start_time']);//时间段开始
        }
        if($search['created_end_time']!=''){
        	$this->view->assign('created_end_time', $search['created_end_time']);//时间段结束
        }
        $this->view->assign("display",$search['display']);
		$this->view->child_physical_array=$child_physical_array;
		$this->view->display('children_index.html');
	}
	/**
	 * 一个用户的所有详细随访
	 *
	 */
	public  function listAction(){
		$userid=$this->_request->getParam('id');
		if ($userid)
		{
			//获取个人信息
			$individual_inf=get_individual_info($userid);//取得个人信息中所有信息
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

			require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
			$project			= array('5'=>'12月龄','6'=>'18月龄','7'=>'24月龄','8'=>'30月龄');
			//体重情况|radio|1=>上,2=>中,3=>下
			$weight_info		= array('1'=>'上','2'=>'中','3'=>'下');
			//身长情况|radio|1=>上,2=>中,3=>下
			$height_info		= $weight_info;
			//面色|radio|1=>红润,2=>其它
			$complexion			= $bb_complexion;
			//皮肤|radio|1=>未见异常,2=>异常
			$skin				= $bb_exception;
			//前囟|radio|1=>闭合,2=>未闭
			$bregma				= $bb_bregma;
			//颈部包块 	1有  2 无
			$cervical_mass		= $bb_cervical_mass;
			//眼|radio|1=>未见异常,2=>异常
			$eye				= $bb_exception;
			//|radio|1=>未见异常,2=>异常
			$ear				= $bb_exception;
			//口腔|radio|1=>未见异常,2=>异常
			$oralcavity			= $bb_exception;
			//心肺|radio|1=>未见异常,2=>异常
			$heart_lung			= $bb_exception;
			//腹部|radio|1=>未见异常,2=>异常
			$abdomen			= $bb_exception;
			//脐部|radio|1=>未见异常,2=>异常
			$umbilical_region	= $bb_exception;
			//脐部|radio|1=>未脱,2=>脱落,3=>脐部有渗出,4=>其他
			$umbilical_region_array= $bb_umbilical_region;
			//四肢|radio|1=>未见异常,2=>异常
			$limb				= $bb_exception;
			//步态|radio|1=>未见异常,2=>异常
			$gait				= $bb_exception;
			//佝偻病症状|radio|1=>无,2=>夜惊,3=>多汗,4=>烦躁
			$rickets_symptom	= $bb_rickets_symptom;
			//佝偻病体征|1无2颅骨软化3方颅4枕秃
			$rickets_signs		= $bb_rickets_signs;
			//佝偻病体征1肋串珠2肋外翻3肋软骨沟4鸡胸5手镯征
			$rickets_signs_array= $bb_rickets_signs_two;
			//肛门/外生殖器|radio|1=>未见异常,2=>异常
			$gmzz				= $bb_exception;
			//发育评估|radio|1=>通过,2=>未过
			$developmental_assessment	= $bb_developmental_assessment;
			//两次随访间患病情况|radio|1=>未患病,2=>患病
			$between_and_vist_time		= $bb_between_and_vist_time;
			//转诊|radio|1=>无,2=>有
			$referral_features	= $bb_referral_features;
			//指导|checkbox|1科学喂养2生长发育3疾病预防4预防意外伤害5口腔保健 
			$advising			= $bb_advising;
			//指导|checkbox|1合理膳食2生长发育3疾病预防4预防意外伤害5口腔保健
			$advising_bbt		= $bbt_advising;

			$this->view->project_options 		=$project; //项目|radio|5=>12月龄,6=>18月龄,7=>24月龄,8=>30月龄
			$this->view->weight_info_options 	=$weight_info; //体重情况|radio|1=>上,2=>中,3=>下
			$this->view->height_info_options 	=$height_info; //身长情况|radio|1=>上,2=>中,3=>下
			$this->view->complexion_options 	=$complexion; //面色|radio|1=>红润,2=>其它
			$this->view->skin_options 			=$skin; //皮肤|radio|1=>未见异常,2=>异常
			$this->view->bregma_options 		=$bregma; //前囟|radio|1=>闭合,2=>未闭
			$this->view->eye_options 			=$eye; //眼|radio|1=>未见异常,2=>异常
			$this->view->ear_options 			=$ear; //耳|radio|1=>未见异常,2=>异常
			$this->view->heart_lung_options 	=$heart_lung; //心肺|radio|1=>未见异常,2=>异常
			$this->view->abdomen_options 		=$abdomen; //腹部|radio|1=>未见异常,2=>异常
			$this->view->umbilical_region_options =$umbilical_region; //脐部|radio|1=>未见异常,2=>异常
			$this->view->limb_options 			=$limb; //四肢|radio|1=>未见异常,2=>异常
			$this->view->gait_options 			=$gait; //步态|radio|1=>未见异常,2=>异常
			$this->view->rickets_symptom_options =$rickets_symptom; //佝偻病症状|radio|1=>无,2=>夜惊,3=>多汗,4=>烦躁
			$this->view->rickets_signs_options  =$rickets_signs; //佝偻病体征|radio|1=>无,2=>颅骨软化,3=>方颅,4=>枕秃,5=>肋串珠,6=>肋外翻,7=>肋软骨沟,8=>鸡胸,9=>手镯征,10=>O型腿,11=>X型腿
			$this->view->gmzz_options 			=$gmzz; //肛门/外生殖器|radio|1=>未见异常,2=>异常
			$this->view->developmental_assessment_options 	=$developmental_assessment; //发育评估|radio|1=>通过,2=>未过
			$this->view->between_and_vist_time_options 		=$between_and_vist_time; //两次随访间患病情况|radio|1=>未患病,2=>患病
			$this->view->referral_features_options 			=$referral_features; //转诊|radio|1=>无,2=>有
			$this->view->advising_options 					=$advising; //指导|checkbox|1科学喂养2生长发育3疾病预防4预防意外伤害5口腔保健
			$this->view->advising_array 					=$advising_bbt; //指导|checkbox|1合理膳食2生长发育3疾病预防4预防意外伤害5口腔保健

			$child_physical_two=new Tchild_physical_two();
			$child_physical_two->whereAdd("id='$userid'");
			$nums=$child_physical_two->count();//用于数组循环次数
			$child_physical_two->orderby("project ASC");
			$child_physical_two->find();
			$child_physical_array=array();
			$i=0;
			while ($child_physical_two->fetch())
			{

				$child_physical_array[$i]['uuid']					= $child_physical_two->uuid;//编号
				$child_physical_array[$i]['staff_id'] 				= $child_physical_two->staff_id;//医生档案号
				$child_physical_array[$i]['id'] 					= $child_physical_two->id;//个人档案号
				$child_physical_array[$i]['created'] 				= $child_physical_two->created;//添加记录时间
				
				$project_index										= $child_physical_two->project;//项目|radio|5=>12月龄,6=>18月龄,7=>24月龄,8=>30月龄
				$child_physical_array[$i]['project_current'] 		= $child_physical_two->project;//项目|radio|5=>12月龄,6=>18月龄,7=>24月龄,8=>30月龄
				$child_physical_array[$i]['vist_time'] 				= empty($child_physical_two->vist_time)?'':adodb_date("Y-m-d",$child_physical_two->vist_time);//随访日期
				$child_physical_array[$i]['weight'] 				= $child_physical_two->weight;//体重(kg)

				$child_physical_array[$i]['weight_info_current'] 	= $child_physical_two->weight_info;//体重情况|radio|1=>上,2=>中,3=>下
				$child_physical_array[$i]['height'] 			 	= $child_physical_two->height;//身长(cm)

				$child_physical_array[$i]['height_info_current'] 	= $child_physical_two->height_info;//身长情况|radio|1=>上,2=>中,3=>下
				$child_physical_array[$i]['sitting_hight'] 			= $child_physical_two->sitting_hight;//坐高(cm)
				$child_physical_array[$i]['head_size'] 				= $child_physical_two->head_size;//头围(cm)
				$child_physical_array[$i]['bust'] 					= $child_physical_two->bust;//胸围(cm)
				
				//$child_physical_array[$i]['head_size'] 			 	= $child_physical_two->head_size;//头围（cm）
				
                $complexion_index									= array_search_for_other($child_physical_two->complexion,$complexion);//面色国家代码
				$child_physical_array[$i]['complexion_current']  	= $complexion_index==""?"":$complexion[$complexion_index][1];//面色|radio|1=>红润,2=>其它

				$skin_index											= array_search_for_other($child_physical_two->skin,$skin);//国家代码 
				$child_physical_array[$i]['skin_current'] 		 	= $skin_index==""?"":$skin[$skin_index][1];//皮肤|radio|1=>未见异常,2=>异常
				
				$bregma_index										= array_search_for_other($child_physical_two->bregma,$bregma);//
				$child_physical_array[$i]['bregma_current']		 	= $bregma_index==""?"":$bregma[$bregma_index][1];//前囟|radio|1=>闭合,2=>未闭
				$child_physical_array[$i]['bregma_width'] 		 	= $child_physical_two->bregma_width;//前囟宽
				$child_physical_array[$i]['bregma_height'] 		 	= $child_physical_two->bregma_height;//前囟高

				$cervical_mass_index								= array_search_for_other($child_physical_two->cervical_mass,$cervical_mass);//
				$child_physical_array[$i]['cervical_mass']		 	= $cervical_mass_index==""?"":$cervical_mass[$cervical_mass_index][1];//颈部包块 	1有  2 无
				
				$eye_index											= array_search_for_other($child_physical_two->eye,$eye);
				$child_physical_array[$i]['eye_current'] 		 	= $eye_index==""?"":$eye[$eye_index][1];//眼|radio|1=>未见异常,2=>异常

				$ear_index											= array_search_for_other($child_physical_two->ear,$ear);
				$child_physical_array[$i]['ear_current'] 		 	= $ear_index==''?'':$ear[$ear_index][1];//耳|radio|1=>未见异常,2=>异常
				

				$child_physical_array[$i]['oralcavity'] 		 	= $child_physical_two->oralcavity;//龋齿数
				$child_physical_array[$i]['number_of_teeth'] 	 	= $child_physical_two->number_of_teeth;//出牙数(颗)

				$heart_lung_index									= array_search_for_other($child_physical_two->heart_lung,$heart_lung);
				$child_physical_array[$i]['heart_lung_current']  	= $heart_lung_index==''?'':$heart_lung[$heart_lung_index][1];//心肺|radio|1=>未见异常,2=>异常

				$abdomen_index										= array_search_for_other($child_physical_two->abdomen,$abdomen);
				$child_physical_array[$i]['abdomen_current'] 	 	= $abdomen_index==''?'':$abdomen[$abdomen_index][1];//腹部|radio|1=>未见异常,2=>异常

				if($project_index==1){
					$umbilical_region=$umbilical_region_array;
				}					
				$umbilical_region_index								 =array_search_for_other( $child_physical_two->umbilical_region,$umbilical_region);
				$child_physical_array[$i]['umbilical_region_current'] =$umbilical_region_index==''?'':$umbilical_region[$umbilical_region_index][1];//脐部|radio|1=>未见异常,2=>异常

				$limb_index											= array_search_for_other($child_physical_two->limb,$limb);
				$child_physical_array[$i]['limb_current'] 		 	= $limb_index==''?'':$limb[$limb_index][1];//四肢|radio|1=>未见异常,2=>异常

				$gait_index											= array_search_for_other($child_physical_two->gait,$gait);
				$child_physical_array[$i]['gait_current'] 			= $gait_index==''?'':$gait[$gait_index][1];//步态|radio|1=>未见异常,2=>异常

				$rickets_symptom_index								= array_search_for_other($child_physical_two->rickets_symptom,$rickets_symptom);
				$child_physical_array[$i]['rickets_symptom_current'] = $rickets_symptom_index==''?'':$rickets_symptom[$rickets_symptom_index][1];//佝偻病症状|radio|1=>无,2=>夜惊,3=>多汗,4=>烦躁

				if($project_index==3 || $project_index==4){
					$rickets_signs	= $rickets_signs_array;
				}			
				$rickets_signs_index								= array_search_for_other($child_physical_two->rickets_signs,$rickets_signs);
				$child_physical_array[$i]['rickets_signs_current'] 	= $rickets_signs_index==''?'':$rickets_signs[$rickets_signs_index][1];//佝偻病体征|

				$gmzz_index											= array_search_for_other($child_physical_two->gmzz,$gmzz);
				$child_physical_array[$i]['gmzz_current'] 			= $gmzz_index==''?'':$gmzz[$gmzz_index][1];//肛门/外生殖器|radio|1=>未见异常,2=>异常
				
				$child_physical_array[$i]['hemoglobin'] 			= $child_physical_two->hemoglobin;//血红蛋白值
				$child_physical_array[$i]['field_sport'] 			= $child_physical_two->field_sport;//户外活动小时/日
				$child_physical_array[$i]['vitamin_d'] 				= $child_physical_two->vitamin_d;//服用维生素D

				$developmental_assessment_index						= array_search_for_other($child_physical_two->developmental_assessment,$developmental_assessment);
				$child_physical_array[$i]['developmental_assessment_current'] = $developmental_assessment_index==''?'':$developmental_assessment[$developmental_assessment_index][1];//发育评估|radio|1=>通过,2=>未过

				$between_and_vist_time_index						= array_search_for_other($child_physical_two->between_and_vist_time,$between_and_vist_time);
				$child_physical_array[$i]['between_and_vist_time_current'] = $between_and_vist_time_index==''?'':$between_and_vist_time[$between_and_vist_time_index][1];//两次随访间患病情况|radio|1=>未患病,2=>患病
				$child_physical_array[$i]['other'] 					= $child_physical_two->other;//其它

				$child_physical_array[$i]['referral_features_current'] = array_search_for_other($child_physical_two->referral_features,$referral_features);//转诊|radio|1=>无,2=>有
				$child_physical_array[$i]['reason'] 				= $child_physical_two->reason;//转诊原因
				$child_physical_array[$i]['agencies_departments'] 	= $child_physical_two->agencies_departments;//转诊机构及科室

				$advising_arr=@explode('|',$child_physical_two->advising);//
				$advising_arrray=array();//指导
				foreach ($advising_arr as $advising_val){
					$advising_arrray[]=array_search_for_other($advising_val,$advising);
				}
				$child_physical_array[$i]['advising_current']   	= $advising_arrray;//指导|checkbox|1=>喂养指导,2=>母乳指导,3=>疾病预防
				$child_physical_array[$i]['advising_other'] 		= $child_physical_two->advising_other;//指导其它
				$child_physical_array[$i]['next_followup_time'] 	= empty($child_physical_two->next_followup_time)?'':adodb_date("Y-m-d",$child_physical_two->next_followup_time);//下次随访日期

				$child_physical_array[$i]['doctors_signature']  	= get_staff_name_byid($child_physical_two->doctors_signature);//转诊医
				$i++;
			}
			$this->view->child_physical_array=$child_physical_array;
			//print_r($child_physical_array);
			$this->view->nums=$nums;
			$this->view->display('list_table.html');
		}
		else
		{
			$url=array("1～2岁儿童健康检查记录列表"=>__BASEPATH.'children/childrentwo/index',"用户列表"=>__BASEPATH.'iha/index/index');
			message("查看1岁内儿童健康检查记录详细信息失败",$url);
		}
	}

	/**
	 * 添加、修改页面
	 *
	 */
	public function addAction(){
		
		
		$individual_session = new Zend_Session_Namespace("individual_core");
		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		$project			= array('5'=>'12月龄','6'=>'18月龄','7'=>'24月龄','8'=>'30月龄');;
		//体重情况|radio|1=>上,2=>中,3=>下
		$weight_info		= array('1'=>'上','2'=>'中','3'=>'下');
		//身长情况|radio|1=>上,2=>中,3=>下
		$height_info		= $weight_info;
		//面色|radio|1=>红润,2=>其它
		$complexion			= $bb_complexion;
		//皮肤|radio|1=>未见异常,2=>异常
		$skin				= $bb_exception;
		//前囟|radio|1=>闭合,2=>未闭
		$bregma				= $bb_bregma;
		//颈部包块|radio|1=>有,2=>无		
		$cervical_mass 		= $bb_cervical_mass;
		//眼|radio|1=>未见异常,2=>异常
		$eye				= $bb_exception;
		//耳外观|radio|1=>未见异常,2=>异常
		$ear				= $bb_exception;
		//听力|radio|1=>通过,2=>未过
		$hearing			= $bb_developmental_assessment;
		//口腔|radio|1=>未见异常,2=>异常
		$oralcavity			= $bb_exception;
		//心肺|radio|1=>未见异常,2=>异常
		$heart_lung			= $bb_exception;
		//腹部|radio|1=>未见异常,2=>异常
		$abdomen			= $bb_exception;
		//脐部|radio|1=>未见异常,2=>异常
		$umbilical_region	= $bb_exception;
		//脐部|radio|1=>未脱,2=>脱落,3=>脐部有渗出,4=>其他
		$umbilical_region_array= $bb_umbilical_region;
		//四肢|radio|1=>未见异常,2=>异常
		$limb				= $bb_exception;
		//步态|radio|1=>未见异常,2=>异常
		$gait				= $bb_exception;
		//佝偻病症状|radio|1=>无,2=>夜惊,3=>多汗,4=>烦躁
		$rickets_symptom	= $bb_rickets_symptom;
		//佝偻病体征|1无2颅骨软化3方颅4枕秃
		$rickets_signs		= $bb_rickets_signs;
		//佝偻病体征1肋串珠2肋外翻3肋软骨沟4鸡胸5手镯征
		$rickets_signs_array= $bb_rickets_signs_two;
		//肛门/外生殖器|radio|1=>未见异常,2=>异常
		$gmzz				= $bb_exception;
		//发育评估|radio|1=>通过,2=>未过
		$developmental_assessment	= $bb_developmental_assessment;
		//两次随访间患病情况|radio|1=>未患病,2=>患病
		$between_and_vist_time		= $bb_between_and_vist_time;
		//转诊|radio|1=>无,2=>有
		$referral_features	= $bb_referral_features;
		//指导|checkbox|1科学喂养2生长发育3疾病预防4预防意外伤害5口腔保健 
		$advising			= $bb_advising;
		//指导|checkbox|1合理膳食2生长发育3疾病预防4预防意外伤害5口腔保健
		$advising_bbt		= $bbt_advising;

		$this->view->project_options 		=$project; //项目|radio|5=>12月龄,6=>18月龄,7=>24月龄,8=>30月龄
		$this->view->weight_info_options 	=$weight_info; //体重情况|radio|1=>上,2=>中,3=>下
		$this->view->height_info_options 	=$height_info; //身长情况|radio|1=>上,2=>中,3=>下
		$this->view->complexion_options 	=$complexion; //面色|radio|1=>红润,2=>其它
		$this->view->skin_options 			=$skin; //皮肤|radio|1=>未见异常,2=>异常
		$this->view->bregma_options 		=$bregma; //前囟|radio|1=>闭合,2=>未闭
		$this->view->cervical_mass_options 	=$cervical_mass;//颈部包块|radio|1=>有,2=>无
		$this->view->eye_options 			=$eye; //眼|radio|1=>未见异常,2=>异常
		$this->view->ear_options 			=$ear; //耳|radio|1=>未见异常,2=>异常
		$this->view->hearing_options 		=$developmental_assessment; //听力|radio|1=>通过,2=>未过
		$this->view->oralcavity_options 	=$oralcavity; //口腔|radio|1=>未见异常,2=>异常
		$this->view->heart_lung_options 	=$heart_lung; //心肺|radio|1=>未见异常,2=>异常
		$this->view->abdomen_options 		=$abdomen; //腹部|radio|1=>未见异常,2=>异常
		$this->view->umbilical_region_options =$umbilical_region; //脐部|radio|1=>未见异常,2=>异常
		$this->view->umbilical_region_array =$umbilical_region_array; //脐部|radio|1=>未脱,2=>脱落,3=>脐部有渗出,4=>其他
		
		$this->view->limb_options 			=$limb; //四肢|radio|1=>未见异常,2=>异常
		$this->view->gait_options 			=$gait; //步态|radio|1=>未见异常,2=>异常
		$this->view->rickets_symptom_options =$rickets_symptom; //佝偻病症状|radio|1=>无,2=>夜惊,3=>多汗,4=>烦躁
		$this->view->rickets_signs_options  =$rickets_signs; //佝偻病体征|radio|1无2颅骨软化3方颅4枕秃
		$this->view->rickets_signs_array    =$rickets_signs_array; //佝偻病体征|radio|肋串珠2肋外翻3肋软骨沟4鸡胸5手镯征
		$this->view->gmzz_options 			=$gmzz; //肛门/外生殖器|radio|1=>未见异常,2=>异常
		$this->view->developmental_assessment_options 	=$developmental_assessment; //发育评估|radio|1=>通过,2=>未过
		$this->view->between_and_vist_time_options 		=$between_and_vist_time; //两次随访间患病情况|radio|1=>未患病,2=>患病
		$this->view->referral_features_options 			=$referral_features; //转诊|radio|1=>无,2=>有
		$this->view->advising_options 					=$advising; //指导|checkbox|1科学喂养2生长发育3疾病预防4预防意外伤害5口腔保健
		$this->view->advising_array 					=$advising_bbt; //指导|checkbox|1合理膳食2生长发育3疾病预防4预防意外伤害5口腔保健
        //
		$serial_number		=	$this->_request->getParam('id',$individual_session->uuid);//个人档案号
		$project_num		=   $this->_request->getParam('project','5');//月（年）龄
		$child_physical_chk	=	new Tchild_physical_two();
		$child_physical_chk->whereAdd("id='{$serial_number}'");//
		$child_physical_chk->whereAdd("project='{$project_num}'");
		$child_physical_chk->find();
		$child_physical_chk->fetch();
		$uuid				=	$child_physical_chk->uuid;
		
		if(empty($uuid)){
			//添加

			if(empty($individual_session->uuid)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			//2012-02-21仅添加正常档案
			if($individual_session->status_flag!=1){
	            message("你选择了一个非正常档案，请重新选择",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
	        }
			$id										=empty($serial_number)?$individual_session->uuid:$serial_number;//个人档案号
			$individual_inf=get_individual_info($id);//取得个人信息中所有信息
			$seven_old								= adodb_mktime(0,0,0,adodb_date('m'),adodb_date('d'),adodb_date('Y')-7);//7岁以前的时间戳
			if($individual_inf->date_of_birth < $seven_old){
				message("请重新选择小于7岁的儿童！",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			if($this->haveWritePrivilege){
				$this->view->name		 			= $individual_inf->name;//居民姓名
				$this->view->serial_num 			= $individual_inf->standard_code_1;//标准档案号
			}else{
				$this->view->name 					= "*";//居民姓名
				$this->view->serial_num 			= "*";//标准档案号
			}

			$this->view->id 						= $id;//个人档案号
			$this->view->vist_time 				    = adodb_date("Y-m-d");//随访日期
			$this->view->next_followup_time 		= adodb_date("Y-m-d");//下次随访日期
			$region_users							= region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->project_current			= $project_num;//项目编码

			$this->view->region_users				= $region_users;
			$this->view->doctors_signature			= $this->user['uuid'];//转诊医生

		}else{
			//修改
			$child_physical_two					=	new Tchild_physical_two();
			$child_physical_two->whereAdd("uuid='$uuid'");
			$child_physical_two->find();
			$child_physical_two->fetch();

			$this->view->uuid 					= $child_physical_two->uuid;//编号
			$this->view->staff_id 				= $child_physical_two->staff_id;//医生档案号
			$this->view->id 					= $child_physical_two->id;//个人档案号
			$this->view->created 				= $child_physical_two->created;//添加记录时间
			$individual_inf=get_individual_info($child_physical_two->id);//取得个人信息中所有信息
			if($this->haveWritePrivilege){
				$this->view->name		 		= $individual_inf->name;//居民姓名
				$this->view->serial_num 		= $individual_inf->standard_code_1;//标准档案号
			}else{
				$this->view->name 				= "*";//居民姓名
				$this->view->serial_num 		= "*";//标准档案号
			}

			//$this->view->project_options 		=$project; //项目|radio|array('5'=>'12月龄','6'=>'18月龄','7'=>'24月龄','8'=>'30月龄');
			$this->view->project_current 		= $child_physical_two->project;//项目|radio|array('5'=>'12月龄','6'=>'18月龄','7'=>'24月龄','8'=>'30月龄');
			$this->view->vist_time 				= empty($child_physical_two->vist_time)?'':adodb_date("Y-m-d",$child_physical_two->vist_time);//随访日期
			$this->view->weight 				= $child_physical_two->weight;//体重(kg)

			$this->view->weight_info_options 	= $weight_info; //体重情况|radio|1=>上,2=>中,3=>下
			$this->view->weight_info_current 	= $child_physical_two->weight_info;//体重情况|radio|1=>上,2=>中,3=>下
			$this->view->height 			 	= $child_physical_two->height;//身长(cm)

			$this->view->height_info_options 	= $height_info; //身长情况|radio|1=>上,2=>中,3=>下
			$this->view->height_info_current 	= $child_physical_two->height_info;//身长情况|radio|1=>上,2=>中,3=>下
			$this->view->head_size 			 	= $child_physical_two->head_size;//头围（cm）
			$this->view->sitting_hight 			= $child_physical_two->sitting_hight;//坐高(cm)
			$this->view->bust 					= $child_physical_two->bust;//胸围(cm)

			//$this->view->complexion_options   =  $complexion; //面色|radio|1=>红润,2=>其它
			$this->view->complexion_current  	= array_search_for_other($child_physical_two->complexion,$complexion);//面色|radio|1=>红润,2=>其它

			$this->view->skin_options 			= $skin; //皮肤|radio|1=>未见异常,2=>异常
			$this->view->skin_current 		 	= array_search_for_other($child_physical_two->skin,$skin);//皮肤|radio|1=>未见异常,2=>异常

			//$this->view->bregma_options 		=$bregma; //前囟|radio|1=>闭合,2=>未闭
			$this->view->bregma_current		 	= array_search_for_other($child_physical_two->bregma,$bregma);//前囟|radio|1=>闭合,2=>未闭
			$this->view->bregma_width 		 	= $child_physical_two->bregma_width;//前囟宽
			$this->view->bregma_height 		 	= $child_physical_two->bregma_height;//前囟高
			
			$this->view->cervical_mass_current 	= array_search_for_other($child_physical_two->cervical_mass,$cervical_mass);//颈部包块|radio|1=>有,2=>无

			//$this->view->eye_options			=$eye; //眼|radio|1=>未见异常,2=>异常
			$this->view->eye_current 		 	= array_search_for_other($child_physical_two->eye,$eye);//眼|radio|1=>未见异常,2=>异常

			//$this->view->ear_options =$ear; //耳|radio|1=>未见异常,2=>异常
			$this->view->ear_current 		 	= array_search_for_other($child_physical_two->ear,$ear);//耳|radio|1=>未见异常,2=>异常
			
			$this->view->hearing_current 		= array_search_for_other($child_physical_two->hearing,$hearing);//听力|radio|1=>通过,2=>未通过
			
			$this->view->oralcavity_current 	= $child_physical_two->oralcavity;//龋齿数
			
			$this->view->number_of_teeth 	 	= $child_physical_two->number_of_teeth;//出牙数(颗)

			//$this->view->heart_lung_options 	=$heart_lung; //心肺|radio|1=>未见异常,2=>异常
			$this->view->heart_lung_current  	= array_search_for_other($child_physical_two->heart_lung,$heart_lung);//心肺|radio|1=>未见异常,2=>异常

			//$this->view->abdomen_options 		=$abdomen; //腹部|radio|1=>未见异常,2=>异常
			$this->view->abdomen_current 	 	= array_search_for_other($child_physical_two->abdomen,$abdomen);//腹部|radio|1=>未见异常,2=>异常

			//$this->view->umbilical_region_options =$umbilical_region; //脐部|radio|1=>未见异常,2=>异常
			$this->view->umbilical_region_current =array_search_for_other( $child_physical_two->umbilical_region,$umbilical_region);//脐部|radio|1=>未见异常,2=>异常

			//$this->view->limb_options =$limb; //四肢|radio|1=>未见异常,2=>异常
			$this->view->limb_current 		 	= array_search_for_other($child_physical_two->limb,$limb);//四肢|radio|1=>未见异常,2=>异常

			//$this->view->gait_options 		=$gait; //步态|radio|1=>未见异常,2=>异常
			$this->view->gait_current 			= array_search_for_other($child_physical_two->gait,$gait);//步态|radio|1=>未见异常,2=>异常

			//$this->view->rickets_symptom_options =$rickets_symptom; //佝偻病症状|radio|1=>无,2=>夜惊,3=>多汗,4=>烦躁
			$this->view->rickets_symptom_current = array_search_for_other($child_physical_two->rickets_symptom,$rickets_symptom);//佝偻病症状|radio|1=>无,2=>夜惊,3=>多汗,4=>烦躁

			//$this->view->rickets_signs_options =$rickets_signs; //佝偻病体征|radio|1=>无,2=>颅骨软化,3=>方颅,4=>枕秃,5=>肋串珠,6=>肋外翻,7=>肋软骨沟,8=>鸡胸,9=>手镯征,10=>O型腿,11=>X型腿
			$this->view->rickets_signs_current 	= array_search_for_other($child_physical_two->rickets_signs,$rickets_signs);//佝偻病体征|radio|1=>无,2=>颅骨软化,3=>方颅,4=>枕秃,5=>肋串珠,6=>肋外翻,7=>肋软骨沟,8=>鸡胸,9=>手镯征,10=>O型腿,11=>X型腿

			//$this->view->gmzz_options =$gmzz; //肛门/外生殖器|radio|1=>未见异常,2=>异常
			$this->view->gmzz_current 			= array_search_for_other($child_physical_two->gmzz,$gmzz);//肛门/外生殖器|radio|1=>未见异常,2=>异常
			$this->view->hemoglobin 			= $child_physical_two->hemoglobin;//血红蛋白值
			$this->view->field_sport 			= $child_physical_two->field_sport;//户外活动小时/日
			$this->view->vitamin_d 				= $child_physical_two->vitamin_d;//服用维生素D

			//$this->view->developmental_assessment_options =$developmental_assessment; //发育评估|radio|1=>通过,2=>未过
			$this->view->developmental_assessment_current = array_search_for_other($child_physical_two->developmental_assessment,$developmental_assessment);//发育评估|radio|1=>通过,2=>未过

			//$this->view->between_and_vist_time_options =$between_and_vist_time; //两次随访间患病情况|radio|1=>未患病,2=>患病
			$this->view->between_and_vist_time_current = array_search_for_other($child_physical_two->between_and_vist_time,$between_and_vist_time);//两次随访间患病情况|radio|1=>未患病,2=>患病
			$this->view->other 					= $child_physical_two->other;//其它

			//$this->view->referral_features_options =$referral_features; //转诊|radio|1=>无,2=>有
			$this->view->referral_features_current = array_search_for_other($child_physical_two->referral_features,$referral_features);//转诊|radio|1=>无,2=>有
			$this->view->reason 				= $child_physical_two->reason;//转诊原因
			$this->view->agencies_departments 	= $child_physical_two->agencies_departments;//转诊机构及科室

			$advising_arr=@explode('|',$child_physical_two->advising);//
			$advising_arrray=array();//指导
			foreach ($advising_arr as $advising_val){
				$advising_arrray[]=array_search_for_other($advising_val,$advising);
			}
			//$this->view->advising_options =$advising; //指导|checkbox|1=>喂养指导,2=>母乳指导,3=>疾病预防
			$this->view->advising_current   	= $advising_arrray;//指导|checkbox|1=>喂养指导,2=>母乳指导,3=>疾病预防
			$this->view->advising_other 		= $child_physical_two->advising_other;//指导其它
			$this->view->next_followup_time 	= empty($child_physical_two->next_followup_time)?'':adodb_date("Y-m-d",$child_physical_two->next_followup_time);//下次随访日期

			$region_users						= empty($this->user['current_region_path_domain'])?'':region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users			= $region_users;
			$this->view->doctors_signature  	= $child_physical_two->doctors_signature;//随访医生签名

		}
		$this->view->display('add.html');
	}
	/**
	 * 添加,修改
	 *
	 */
	public function  updateAction(){
		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		//$uuid 									= $this->_request->getParam('uuid');//编号
		$serial_number								= $this->_request->getParam('id');//个人档案编号
		$project_number								= $this->_request->getParam('project',1);//体检项目
		//查询一个人是否做过同一个项目，有修改，无添加
		$child_physical_chk							= new Tchild_physical_two();//
		$child_physical_chk->whereAdd("id='{$serial_number}'");
		$child_physical_chk->whereAdd("project='$project_number'");
		$count=$child_physical_chk->count("*");
		$child_physical_chk->find();
		$child_physical_chk->fetch();
		$uuid=$child_physical_chk->uuid;


		$child_physical_two								= new Tchild_physical_two();

		$child_physical_two->project 					= $project_number;//项目|radio|array('5'=>'12月龄','6'=>'18月龄','7'=>'24月龄','8'=>'30月龄');
		$vist_time 										= $this->_request->getParam('vist_time');//随访日期
		$child_physical_two->vist_time 					= empty($vist_time)?'':mkunixstamp($vist_time);//随访日期

		$child_physical_two->weight 					= $this->_request->getParam('weight');//体重(kg)

		$child_physical_two->weight_info 				= $this->_request->getParam('weight_info');//体重情况|radio|1=>上,2=>中,3=>下

		$child_physical_two->height 					= $this->_request->getParam('height');//身长(cm)

		$child_physical_two->height_info 				= $this->_request->getParam('height_info');//身长情况|radio|1=>上,2=>中,3=>下
		
		$child_physical_two->sitting_hight 				= $this->_request->getParam('sitting_hight');//坐高（cm）
		$child_physical_two->head_size 					= $this->_request->getParam('head_size');//头围（cm）
		
		$child_physical_two->bust 						= $this->_request->getParam('bust');//胸围（cm）

		$child_physical_two->complexion 				= array_code_change($this->_request->getParam('complexion'),$bb_complexion);//面色|radio|1=>红润,2=>其它

		$child_physical_two->skin 						= array_code_change($this->_request->getParam('skin'),$bb_exception);//皮肤|radio|1=>未见异常,2=>异常

		$child_physical_two->bregma 					= array_code_change($this->_request->getParam('bregma'),$bb_bregma);//前囟|radio|1=>闭合,2=>未闭

		$child_physical_two->bregma_width 				= $this->_request->getParam('bregma_width');//前囟宽

		$child_physical_two->bregma_height 				= $this->_request->getParam('bregma_height');//前囟高
		$child_physical_two->cervical_mass				= array_code_change($this->_request->getParam('cervical_mass'),$bb_cervical_mass);//颈部包块|radio|1=>有,2=>无
		$child_physical_two->eye 						= array_code_change($this->_request->getParam('eye'),$bb_exception);//眼|radio|1=>未见异常,2=>异常

		$child_physical_two->ear 						= array_code_change($this->_request->getParam('ear'),$bb_exception);//耳|radio|1=>未见异常,2=>异常
		$child_physical_two->hearing				 	= array_code_change($this->_request->getParam('hearing'),$bb_developmental_assessment);//听力|radio|1=>通过,2=>未过
		$child_physical_two->oralcavity 				= array_code_change($this->_request->getParam('oralcavity'),$bb_exception);//口腔|radio|1=>未见异常,2=>异常
		
		$child_physical_two->number_of_teeth 			= $this->_request->getParam('number_of_teeth');//出牙数(颗)

		$child_physical_two->heart_lung 				= array_code_change($this->_request->getParam('heart_lung'),$bb_exception);//心肺|radio|1=>未见异常,2=>异常

		$child_physical_two->abdomen 					= array_code_change($this->_request->getParam('abdomen'),$bb_exception);//腹部|radio|1=>未见异常,2=>异常

		$child_physical_two->umbilical_region 			= array_code_change($this->_request->getParam('umbilical_region'),$bb_exception);//脐部|radio|1=>未见异常,2=>异常

		$child_physical_two->limb 						= array_code_change($this->_request->getParam('limb'),$bb_exception);//四肢|radio|1=>未见异常,2=>异常

		$child_physical_two->gait 						= array_code_change($this->_request->getParam('gait'),$bb_exception);//步态|radio|1=>未见异常,2=>异常

		$child_physical_two->rickets_symptom 			= array_code_change($this->_request->getParam('rickets_symptom'),$bb_rickets_symptom);//佝偻病症状|radio|1=>无,2=>夜惊,3=>多汗,4=>烦躁

		$child_physical_two->rickets_signs 				= array_code_change($this->_request->getParam('rickets_signs'),$bb_rickets_signs);//佝偻病体征|radio|1=>无,2=>颅骨软化,3=>方颅,4=>枕秃,5=>肋串珠,6=>肋外翻,7=>肋软骨沟,8=>鸡胸,9=>手镯征,10=>O型腿,11=>X型腿

		$child_physical_two->gmzz 						= array_code_change($this->_request->getParam('gmzz'),$bb_exception);//肛门/外生殖器|radio|1=>未见异常,2=>异常

		$child_physical_two->hemoglobin 				= $this->_request->getParam('hemoglobin');//血红蛋白值

		$child_physical_two->field_sport 				= $this->_request->getParam('field_sport');//户外活动小时/日

		$child_physical_two->vitamin_d 					= $this->_request->getParam('vitamin_d');//服用维生素D

		$child_physical_two->developmental_assessment 	= array_code_change($this->_request->getParam('developmental_assessment'),$bb_developmental_assessment);//发育评估|radio|1=>通过,2=>未过

		$child_physical_two->between_and_vist_time 		= array_code_change( $this->_request->getParam('between_and_vist_time'),$bb_between_and_vist_time);//两次随访间患病情况|radio|1=>未患病,2=>患病

		$child_physical_two->other 						= $this->_request->getParam('other');//其它

		$child_physical_two->referral_features 			= array_code_change($this->_request->getParam('referral_features'),$bb_referral_features);//转诊|radio|1=>无,2=>有

		$child_physical_two->reason 					= $this->_request->getParam('reason');//转诊原因

		$child_physical_two->agencies_departments 		= $this->_request->getParam('agencies_departments');//转诊机构及科室

		$advising_arr								= $this->_request->getParam('advising');//指导|checkbox|1=>喂养指导,2=>母乳指导,3=>疾病预防
		$advising_str='';
		foreach ($advising_arr as $k=>$v){
			if(isset($bb_advising[$v][0])){
				$advising_str.=$bb_advising[$v][0].'|';//
			}
		}
		$child_physical_two->advising 					= $advising_str;//指导|checkbox|1=>喂养指导,2=>母乳指导,3=>疾病预防

		$child_physical_two->advising_other 			= $this->_request->getParam('advising_other');//指导其它
		$next_followup_time 						= $this->_request->getParam('next_followup_time');//下次随访日期
		$child_physical_two->next_followup_time 		= empty($next_followup_time)?'':mkunixstamp($next_followup_time);//下次随访日期*/

		$child_physical_two->doctors_signature 			= $this->_request->getParam('doctors_signature');//随访医生签名
		if(empty($uuid)){
			//添加
			$uuid						=uniqid("cd",true);//编号

			$child_physical_two->uuid = $uuid;//编号

			$child_physical_two->staff_id 	= $this->user['uuid'];//医生档案号
			$individual_session 		= new Zend_Session_Namespace("individual_core");

			$child_physical_two->id 		= empty($serial_number)?$individual_session->uuid:$serial_number;//个人档案号

			$child_physical_two->created 	= time();//添加记录时间
			//$child_physical_two->debugLevel(8);
			$update_token				= $child_physical_two->insert();

		}else{
			//修改
			$child_physical_two->whereAdd("uuid='$uuid'");
			$update_token				= $child_physical_two->update();

		}
		if($update_token==true){
			message("更新成功！",array("1～2岁儿童健康检查录表列表"=>__BASEPATH.'children/childrentwo/index',"添加"=>__BASEPATH."children/childrentwo/add","修改"=>__BASEPATH."children/childrentwo/add/id/$serial_number/project/$project_number"));
		}else{
			message("更新失败！",array("1～2岁儿童健康检查录表列表"=>__BASEPATH.'children/childrentwo/index',"添加"=>__BASEPATH."children/childrentwo/add","修改"=>__BASEPATH."children/childrentwo/add/id/$serial_number/project/$project_number"));
		}
	}
	/**
	 * 删除操作
	 *
	 */
	public function delAction(){
		$uuid			= $this->_request->getParam('uuid');
		$child_physical_two	=new Tchild_physical_two();
		$child_physical_two->whereAdd("uuid='$uuid'");
		if($child_physical_two->delete()){
			message("删除成功！",array("1～2岁儿童健康检查录表列表"=>__BASEPATH.'children/childrentwo/index',"添加"=>__BASEPATH."children/childrentwo/add"));
		}else {
			message("删除失败！",array("1～2岁儿童健康检查录表列表"=>__BASEPATH.'children/childrentwo/index',"添加"=>__BASEPATH."children/childrentwo/add"));
		}
	}

	/**
	 * 
	 * 获取child_physical_two最新的一条记录取得访问时间和随访医生
	 *
	 * @param unknown_type $id
	 * @return unknown
	 */
	private function getChildrenInfo($id=''){
		if(empty($id)){
			throw new Exception("参数错误！");
		}
		$result=array();
		$child_physical_two = new Tchild_physical_two();//
		$child_physical_two->whereAdd("id='$id'");
		$child_physical_two->orderby("created DESC");
		$child_physical_two->find();
		$child_physical_two->fetch();
		$result['vist_time']			= $child_physical_two->vist_time;
		$result['doctors_signature']	= $child_physical_two->doctors_signature;
		$child_physical_two->free_statement();
		return $result;
		
	}
	
}
?>