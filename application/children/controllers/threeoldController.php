<?php 
/**
 * 3～6岁儿童健康检查记录表
 * @author mask
 *
 */
class children_threeoldController extends controller{
	public function init(){
		$this->view->assign( "basePath", __BASEPATH );
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';//通用类
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once __SITEROOT."library/Models/individual_core.php";//个人信息主表
		require_once __SITEROOT."library/Models/child_physical_age_three.php";//3～6岁儿童健康检查记录表
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
			//生成负责医生下拉框
			$responseDoctorArray[$counter]['zh_name']=$staff_archive->name_real;
			$responseDoctorArray[$counter]['id']=$staff_core->id;
			if ($search['staff_id']==$staff_core->id)
			{
				$responseDoctorArray[$counter]['selected']='selected';
			}
			else
			{
				$responseDoctorArray[$counter]['selected']='';
			}
			$counter++;
		}
		$child_physical=new Tchild_physical_age_three();
		$core=new Tindividual_core();
		$child_physical->whereAdd($hypertension_core_region_path_domain);
		$child_physical->joinAdd('left',$child_physical,$core,'id','uuid');
		if ($search['staff_id'])
		{
			$child_physical->whereAdd("child_physical_age_three.staff_id = '".$search['staff_id']."'");
		}
		if ($search['username'])
		{
			$child_physical->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if ($search['standard_code'])
		{
			$child_physical->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$child_physical->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
		//开始时间查询
		if($search['created_start_time']!=''){
			$created_start_time=strtotime($search['created_start_time']);
			$child_physical->whereAdd("child_physical_age_three.vist_time>={$created_start_time}");
		}		
		//结束时间查询
		if($search['created_end_time']!=''){
			$created_end_time=strtotime($search['created_end_time']);
			$child_physical->whereAdd("child_physical_age_three.vist_time<={$created_end_time}");
		}	
		$child_physical->whereAdd($individual_core_region_path_domain);	
		$nums=$child_physical->count("distinct child_physical_age_three.id");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'children/threeold/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//$child_physical->debugLevel(5);
		//$core->selectAdd("individual_core.uuid as uuid");
		$child_physical->selectAdd("child_physical_age_three.id as id,individual_core.standard_code_1,individual_core.identity_number,individual_core.name as name,individual_core.name_pinyin as name_pinyin,count(child_physical_age_three.uuid) as snums");
		$child_physical->groupBy("child_physical_age_three.id,individual_core.name,individual_core.name_pinyin,individual_core.standard_code_1,individual_core.identity_number");
		//处理分页
		$child_physical->limit($startnum,__ROWSOFPAGE);
		$child_physical->find();
		$child_physical_array=array();
		$i=0;
		while ($child_physical->fetch())
		{
			$child_physical_array[$i]['snums']				= $child_physical->snums;
			$child_physical_array[$i]['id']					= $child_physical->id;
			if($this->haveWritePrivilege){
				$child_physical_array[$i]['ssname']			= $child_physical->name;
			}
			else
			{
				$child_physical_array[$i]['ssname']			= "*";
			}
			$child_physical_array[$i]['name']				= get_individual_info($child_physical->id);//用户姓名
			$child_physical_latest							= $this->getChildrenInfo($child_physical->id);//最新儿童体检信息
			//print_r($child_physical_latest);
			$child_physical_array[$i]['followup_time']		= empty($child_physical_latest['vist_time'])?'':adodb_date("Y-m-d",$child_physical_latest['vist_time']);//随访时间
			$child_physical_array[$i]['followup_doctor']	= get_staff_name_byid($child_physical_latest['doctors_signature']);//随访医生
			$i++;
		}
		$out = $links->subPageCss2();

		$this->view->response_doctor=$responseDoctorArray;
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
		$this->view->display('threeoldindex.html');
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
			$age							= array('9'=>'3岁','10'=>'4岁','11'=>'5岁','12'=>'6岁');
			//体重情况|radio|1=>上,2=>中,3=>下
			$weight_info					= array('1'=>'上','2'=>'中','3'=>'下');
			//身长情况|radio|1=>上,2=>中,3=>下
			$height_info					= $weight_info;
			//体格发育评价|radio|1=>正常,2=>低体重,3=>消瘦,4=>发育迟缓,5=>肥胖
			$developmental_assessment		= $bbt_developmental_assessment;
			//面色|radio|1=>红润,2=>异常
			$complexion						= $bbt_complexion;
			//步态|radio|1=>正常,2=>异常
			$gait							= $bbt_gait;
			//眼|radio|1=>未见异常,2=>异常
			$eye							= $bb_exception;
			//耳|radio|1=>未见异常,2=>异常
			$ear							= $bb_exception;
			//心肺|radio|1=>未见异常,2=>异常
			$heart_lung						= $bb_exception;
			//肝脾|radio|1=>未见异常,2=>异常
			$hepatosplenography				= $bb_exception;;
			//发育评估行为|radio|1=>通过,2=>未通过
			$behavior						= $bbt_behavior;
			//发育评估社交|radio|1=>通过,2=>未通过
			$social							= $bbt_behavior;
			//听力|radio|1=>通过,2=>未通过
			$hearing						= $bbt_behavior;
			//幼儿期患病情况|checkbox|1=>无,2=>肺炎,3=>麻疹,4=>贫血,5=>营养不良,6=>佝偻病,7=>因腹泻住院,8=>因外伤住院,9=>其它
			//$prevalence_infancy=array('1'=>'无','2'=>'肺炎','3'=>'麻疹','4'=>'贫血','5'=>'营养不良','6'=>'佝偻病','7'=>'因腹泻住院','8'=>'因外伤住院','9'=>'其它');
			//过敏史|radio|1=>无,2=>有
			$allergic_history				= $bb_referral_features;
			//转诊|radio|1=>无,2=>有
			$referral_features				= $bb_referral_features;
			//指导|checkbox|//1合理膳食2生长发育3疾病预防4预防意外伤害5口腔保健
			$advising						= $bbt_advising;
			//腹部|radio|1=>未见异常,2=>异常
			$abdomen						= $bb_exception;

			$this->view->age_options 		=$age; //年龄|radio|9=>3岁,10=>4岁,11=>5岁,12=>6岁
			$this->view->weight_info_options 				=$weight_info; //体重情况|radio|1=>上,2=>中,3=>下

			$this->view->height_info_options 				=$height_info; //身长情况|radio|1=>上,2=>中,3=>下

			$this->view->developmental_assessment_options 	=$developmental_assessment; //体格发育评价|radio|1=>正常,2=>低体重,3=>消瘦,4=>发育迟缓,5=>肥胖

			$this->view->complexion_options 				=$complexion; //面色|radio|1=>红润,2=>异常

			$this->view->gait_options 						=$gait; //步态|radio|1=>正常,2=>异常

			$this->view->eye_options 						=$eye; //眼|radio|1=>未见异常,2=>异常

			$this->view->ear_options 						=$ear; //耳|radio|1=>未见异常,2=>异常

			$this->view->heart_lung_options 				=$heart_lung; //心肺|radio|1=>未见异常,2=>异常

			$this->view->hepatosplenography_options 		=$hepatosplenography; //肝脾|radio|1=>未见异常,2=>异常

			$this->view->behavior_options 					=$behavior; //发育评估行为|radio|1=>通过,2=>未通过

			$this->view->social_options 					=$social; //发育评估社交|radio|1=>通过,2=>未通过

			//$this->view->prevalence_infancy_options 		=$prevalence_infancy; //幼儿期患病情况|checkbox|1=>无,2=>肺炎,3=>麻疹,4=>贫血,5=>营养不良,6=>佝偻病,7=>因腹泻住院,8=>因外伤住院,9=>其它

			$this->view->allergic_history_options 			=$allergic_history; //过敏史|radio|1=>无,2=>有

			$this->view->referral_features_options 			=$referral_features; //转诊|radio|1=>无,2=>有

			$this->view->advising_options 					=$advising; //指导|checkbox|1=>喂养指导,2=>母乳指导,3=>疾病预防
			$this->view->hearing_options 					=$hearing; //听力|radio|1=>通过,2=>未通过
			$this->view->abdomen_options 					=$abdomen;//腹部

			$child_physical=new Tchild_physical_age_three();
			$child_physical->whereAdd("id='$userid'");
			//$child_physical->whereAdd("project<5");
			$nums=$child_physical->count();//用于数组循环次数
			$child_physical->orderby("to_number(age) ASC");
			$child_physical->find();
			$child_physical_array=array();
			$i=0;
			while ($child_physical->fetch())
			{

				$child_physical_array[$i]['uuid']					= $child_physical->uuid;//编号
				$child_physical_array[$i]['staff_id'] 				= $child_physical->staff_id;//医生档案号
				$child_physical_array[$i]['id'] 					= $child_physical->id;//个人档案号
				$child_physical_array[$i]['created'] 				= $child_physical->created;//添加记录时间

				$project_index										= $child_physical->age;//年龄|radio|9=>3岁,10=>4岁,11=>5岁,12=>6岁
				$child_physical_array[$i]['project_current'] 		= $project_index;//年龄|radio|1=>9=>3岁,10=>4岁,11=>5岁,12=>6岁
				$child_physical_array[$i]['vist_time'] 				= empty($child_physical->vist_time)?'':adodb_date("Y-m-d",$child_physical->vist_time);//随访日期
				$child_physical_array[$i]['weight'] 				= $child_physical->weight;//体重(kg)

				$child_physical_array[$i]['weight_info_current'] 	= $child_physical->weight_info;//体重情况|radio|1=>上,2=>中,3=>下
				$child_physical_array[$i]['height'] 			 	= $child_physical->height;//身长(cm)

				$child_physical_array[$i]['height_info_current'] 	= $child_physical->height_info;//身长情况|radio|1=>上,2=>中,3=>下
				
				$child_physical_array[$i]['sitting_hight'] 			= $child_physical->sitting_hight;//坐高(cm)
				$child_physical_array[$i]['head_size'] 				= $child_physical->head_size;//头围(cm)
				$child_physical_array[$i]['bust'] 					= $child_physical->bust;//胸围(cm)

				$developmental_assessment_index						= array_search_for_other($child_physical->developmental_assessment,$developmental_assessment);
				$child_physical_array[$i]['developmental_assessment_current'] = $developmental_assessment_index==""?"":$developmental_assessment[$developmental_assessment_index][1];//体格发育评价|radio|1正常 2低体重 3消瘦 4发育迟缓 5超重



				$child_physical_array[$i]['sight'] 				 	= $child_physical->sight;//视力

				$hearing_index										= array_search_for_other($child_physical->hearing,$hearing);
				$child_physical_array[$i]['hearing_current'] 		= $hearing_index==''?'':$hearing[$hearing_index][1];//听力|radio|1通过  2未过
				
				$child_physical_array[$i]['number_of_teeth'] 	 	= $child_physical->number_of_teeth;//出牙数(颗)
				$child_physical_array[$i]['number_of_caries'] 	 	= $child_physical->number_of_caries;//龋齿数(颗)

				$heart_lung_index									= array_search_for_other($child_physical->heart_lung,$heart_lung);
				$child_physical_array[$i]['heart_lung_current']  	= $heart_lung_index==''?'':$heart_lung[$heart_lung_index][1];//心肺|radio|1=>未见异常,2=>异常

				$abdomen_index										= array_search_for_other($child_physical->abdomen,$abdomen);
				$child_physical_array[$i]['abdomen_current'] 	 	= $abdomen_index==''?'':$abdomen[$abdomen_index][1];//腹部|radio|1=>未见异常,2=>异常
				
				$child_physical_array[$i]['hemoglobin'] 			= $child_physical->hemoglobin;//血红蛋白值
				
				$child_physical_array[$i]['other'] 					= $child_physical->other;//其它
				
				$child_physical_array[$i]['pneumonia'] 				= $child_physical->pneumonia;//两次随访间患病情况-肺炎
				$child_physical_array[$i]['diarrhea_in_hospitalized'] = $child_physical->diarrhea_in_hospitalized;//两次随访间患病情况-腹泻
				$child_physical_array[$i]['the_patient'] 			= $child_physical->the_patient;//两次随访间患病情况-外伤
				$child_physical_array[$i]['prevalence_infancy_other'] = $child_physical->prevalence_infancy_other;//两次随访间患病情况-其他
				

				$child_physical_array[$i]['referral_features_current'] = array_search_for_other($child_physical->referral_features,$referral_features);//转诊|radio|1=>无,2=>有
				$child_physical_array[$i]['reason'] 				= $child_physical->reason;//转诊原因
				$child_physical_array[$i]['agencies_departments'] 	= $child_physical->agencies_departments;//转诊机构及科室

				$advising_arr=@explode('|',$child_physical->advising);//
				$advising_arrray=array();//指导
				foreach ($advising_arr as $advising_val){
					$advising_arrray[]=array_search_for_other($advising_val,$advising);
				}
				$child_physical_array[$i]['advising_current']   	= $advising_arrray;//指导|checkbox|1=>喂养指导,2=>母乳指导,3=>疾病预防
				$child_physical_array[$i]['advising_other'] 		= $child_physical->advising_other;//指导其它
				$child_physical_array[$i]['next_followup_time'] 	= empty($child_physical->next_followup_time)?'':adodb_date("Y-m-d",$child_physical->next_followup_time);//下次随访日期

				$child_physical_array[$i]['doctors_signature']  	   = get_staff_name_byid($child_physical->doctors_signature);//转诊医
				$i++;
			}
			$this->view->child_physical_array=$child_physical_array;
			//print_r($child_physical_array);
			$this->view->nums=$nums;
			$this->view->display('list_table.html');
		}
		else
		{
			$url=array("3～6岁儿童健康检查记录列表"=>__BASEPATH.'children/threeold/index',"用户列表"=>__BASEPATH.'iha/index/index');
			message("查看3～6岁儿童健康检查记录详细信息失败",$url);
		}
	}
	/**
	 * 添加、修改页面
	 *
	 */
	public function addAction(){
		$individual_session = new Zend_Session_Namespace("individual_core");
		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		
		$age							= array('9'=>'3岁','10'=>'4岁','11'=>'5岁','12'=>'6岁');
		//体重情况|radio|1=>上,2=>中,3=>下
		$weight_info					= array('1'=>'上','2'=>'中','3'=>'下');
		//身长情况|radio|1=>上,2=>中,3=>下
		$height_info					= $weight_info;
		//体格发育评价|radio|1=>正常,2=>低体重,3=>消瘦,4=>发育迟缓,5=>肥胖
		$developmental_assessment		= $bbt_developmental_assessment;
		//面色|radio|1=>红润,2=>异常
		$complexion						= $bbt_complexion;
		//步态|radio|1=>正常,2=>异常
		$gait							= $bbt_gait;
		//眼|radio|1=>未见异常,2=>异常
		$eye							= $bb_exception;
		//耳|radio|1=>未见异常,2=>异常
		$ear							= $bb_exception;
		//心肺|radio|1=>未见异常,2=>异常
		$heart_lung						= $bb_exception;
		//肝脾|radio|1=>未见异常,2=>异常
		$hepatosplenography				= $bb_exception;;
		//发育评估行为|radio|1=>通过,2=>未通过
		$behavior						= $bbt_behavior;
		//发育评估社交|radio|1=>通过,2=>未通过
		$social							= $bbt_behavior;
		//听力|radio|1=>通过,2=>未通过
		$hearing						= $bbt_behavior;
		//幼儿期患病情况|checkbox|1=>无,2=>肺炎,3=>麻疹,4=>贫血,5=>营养不良,6=>佝偻病,7=>因腹泻住院,8=>因外伤住院,9=>其它
		//$prevalence_infancy=array('1'=>'无','2'=>'肺炎','3'=>'麻疹','4'=>'贫血','5'=>'营养不良','6'=>'佝偻病','7'=>'因腹泻住院','8'=>'因外伤住院','9'=>'其它');
		//过敏史|radio|1=>无,2=>有
		$allergic_history				= $bb_referral_features;
		//转诊|radio|1=>无,2=>有
		$referral_features				= $bb_referral_features;
		//指导|checkbox|//1合理膳食2生长发育3疾病预防4预防意外伤害5口腔保健
		$advising						= $bbt_advising;
		
		//腹部|radio|1=>未见异常,2=>异常
		$abdomen						= $bb_exception;

		$this->view->age_options 		=$age; //年龄|radio|9=>3岁,10=>4岁,11=>5岁,12=>6岁
		$this->view->weight_info_options 				=$weight_info; //体重情况|radio|1=>上,2=>中,3=>下

		$this->view->height_info_options 				=$height_info; //身长情况|radio|1=>上,2=>中,3=>下

		$this->view->developmental_assessment_options 	=$developmental_assessment; //体格发育评价|radio|1=>正常,2=>低体重,3=>消瘦,4=>发育迟缓,5=>肥胖

		$this->view->complexion_options 				=$complexion; //面色|radio|1=>红润,2=>异常

		$this->view->gait_options 						=$gait; //步态|radio|1=>正常,2=>异常

		$this->view->eye_options 						=$eye; //眼|radio|1=>未见异常,2=>异常

		$this->view->ear_options 						=$ear; //耳|radio|1=>未见异常,2=>异常

		$this->view->heart_lung_options 				=$heart_lung; //心肺|radio|1=>未见异常,2=>异常

		$this->view->hepatosplenography_options 		=$hepatosplenography; //肝脾|radio|1=>未见异常,2=>异常

		$this->view->behavior_options 					=$behavior; //发育评估行为|radio|1=>通过,2=>未通过

		$this->view->social_options 					=$social; //发育评估社交|radio|1=>通过,2=>未通过

		//$this->view->prevalence_infancy_options 		=$prevalence_infancy; //幼儿期患病情况|checkbox|1=>无,2=>肺炎,3=>麻疹,4=>贫血,5=>营养不良,6=>佝偻病,7=>因腹泻住院,8=>因外伤住院,9=>其它

		$this->view->allergic_history_options 			=$allergic_history; //过敏史|radio|1=>无,2=>有

		$this->view->referral_features_options 			=$referral_features; //转诊|radio|1=>无,2=>有

		$this->view->advising_options 					=$advising; //指导|checkbox|1=>喂养指导,2=>母乳指导,3=>疾病预防
		$this->view->hearing_options 					=$hearing; //听力|radio|1=>通过,2=>未通过
		$this->view->abdomen_options 					=$abdomen;//腹部


		$serial_number					= $this->_request->getParam('id',$individual_session->uuid);//个人档案号
		$age							= $this->_request->getParam('age','9');//年龄
		$child_physical_chk  	= new Tchild_physical_age_three();
		$child_physical_chk->whereAdd("id='$serial_number'");
		$child_physical_chk->whereAdd("age='{$age}'");
		$child_physical_chk->find();
		$child_physical_chk->fetch();
		$uuid							= $child_physical_chk->uuid;

		if(empty($uuid)){
			//添加

			if(empty($individual_session->uuid)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			//2012-02-21仅查询正常档案
			if($individual_session->status_flag!=1){
	            message("你选择了一个非正常档案，请重新选择",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
	        }
			$individual_inf=get_individual_info($serial_number);//取得个人信息中所有信息
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
			$this->view->age_current 		    	= $age;//年龄
			$this->view->id 						= $serial_number;//个人档案号
			$this->view->vist_time 				    = adodb_date("Y-m-d");//随访日期
			$region_users							= region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->next_followup_time		    = adodb_date("Y-m-d",strtotime('+1 year'));//随访日期
			$this->view->region_users				= $region_users;
			$this->view->doctors_signature			= $this->user['uuid'];//转诊医生

		}else{
			$child_physical_age_three 				=	new Tchild_physical_age_three();
			$child_physical_age_three->whereAdd("uuid='$uuid'");
			$child_physical_age_three->find();
			$child_physical_age_three->fetch();
			$this->view->age_current 		    	= $child_physical_age_three->age;//年龄
			$this->view->uuid 						= $child_physical_age_three->uuid;//编号
			$this->view->staff_id 					= $child_physical_age_three->staff_id;//医生档案号
			$this->view->id 						= $child_physical_age_three->id;//个人档案号
			$this->view->created 					= $child_physical_age_three->created;//添加记录时间
			$vist_time 								= empty($child_physical_age_three->vist_time)?'':adodb_date('Y-m-d',$child_physical_age_three->vist_time);//随访日期
			$this->view->vist_time 					= $vist_time;//随访日期
			$this->view->weight 					= $child_physical_age_three->weight;//体重(kg)
			$individual_inf=get_individual_info($child_physical_age_three->id);//取得个人信息中所有信息
			if($this->haveWritePrivilege){
				$this->view->name		 		= $individual_inf->name;//居民姓名
				$this->view->serial_num 		= $individual_inf->standard_code_1;//标准档案号
			}else{
				$this->view->name 				= "*";//居民姓名
				$this->view->serial_num 		= "*";//标准档案号
			}


			$this->view->weight_info_current 		= $child_physical_age_three->weight_info;//体重情况|radio|1=>上,2=>中,3=>下
			$this->view->height 					= $child_physical_age_three->height;//身长(cm)

			$this->view->height_info_current 		= $child_physical_age_three->height_info;//身长情况|radio|1=>上,2=>中,3=>下
			
			$this->view->head_size 			 		= $child_physical_age_three->head_size;//头围（cm）
			$this->view->sitting_hight 				= $child_physical_age_three->sitting_hight;//坐高(cm)
			$this->view->bust 						= $child_physical_age_three->bust;//胸围(cm)

			$this->view->developmental_assessment_current = array_search_for_other($child_physical_age_three->developmental_assessment,$developmental_assessment);//体格发育评价|radio|1=>正常,2=>低体重,3=>消瘦,4=>发育迟缓,5=>肥胖

			$this->view->complexion_current 		= array_search_for_other($child_physical_age_three->complexion,$complexion);//面色|radio|1=>红润,2=>异常
			$this->view->complexion_info 			= $child_physical_age_three->complexion_info;//面色异常

			$this->view->sight 						= $child_physical_age_three->sight;//视力
			$this->view->hearing_current 			= array_search_for_other($child_physical_age_three->hearing,$hearing);//听力|radio|1=>通过,2=>未通过

			$this->view->number_of_teeth			= $child_physical_age_three->number_of_teeth;//牙数（颗）
			$this->view->number_of_caries			= $child_physical_age_three->number_of_caries;///龋齿数

			$this->view->gait_current 				= array_search_for_other($child_physical_age_three->gait,$gait);//步态|radio|1=>正常,2=>异常
			$this->view->gait_info 					= $child_physical_age_three->gait_info;//步态异常

			$this->view->eye_current 				= array_search_for_other($child_physical_age_three->eye,$eye);//眼|radio|1=>正常,2=>异常
			$this->view->eye_info 					= $child_physical_age_three->eye_info;//眼异常

			$this->view->ear_current 				= array_search_for_other($child_physical_age_three->ear,$ear);//耳|radio|1=>未见异常,2=>异常
			$this->view->ear_info 					= $child_physical_age_three->ear_info;//耳异常

			$this->view->heart_lung_current 		= array_search_for_other($child_physical_age_three->heart_lung,$heart_lung);//心肺|radio|1=>未见异常,2=>异常
			$this->view->heart_lung_info 			= $child_physical_age_three->heart_lung_info;//心肺异常

			$this->view->abdomen_current 			= array_search_for_other($child_physical_age_three->abdomen,$abdomen);//腹部|radio|1=>未见异常,2=>异常
			$this->view->hemoglobin 				= $child_physical_age_three->hemoglobin;//血红蛋白值

			$this->view->other 						= $child_physical_age_three->other;//其它

			$this->view->hepatosplenography_current = array_search_for_other($child_physical_age_three->hepatosplenography,$hepatosplenography);//肝脾|radio|1=>未见异常,2=>异常
			$this->view->hepatosplenography_info 	= $child_physical_age_three->hepatosplenography_info;//肝脾异常

			$this->view->behavior_current 			= array_search_for_other($child_physical_age_three->behavior,$behavior);//发育评估行为|radio|1=>通过,2=>未通过
			$this->view->behavior_info 				= $child_physical_age_three->behavior_info;//发育评估行为未通过

			$this->view->social_current 			= array_search_for_other($child_physical_age_three->social,$social);//发育评估社交|radio|1=>通过,2=>未通过
			$this->view->social_info 				= $child_physical_age_three->social_info;//发育评估社交未通过

			$this->view->prevalence_infancy_current = @explode('|',$child_physical_age_three->prevalence_infancy);//幼儿期患病情况|checkbox|1=>无,2=>肺炎,3=>麻疹,4=>贫血,5=>营养不良,6=>佝偻病,7=>因腹泻住院,8=>因外伤住院,9=>其它
			$this->view->pneumonia 					= $child_physical_age_three->pneumonia;//肺炎
			$this->view->diarrhea_in_hospitalized 	= $child_physical_age_three->diarrhea_in_hospitalized;//因腹泻住院
			$this->view->the_patient 				= $child_physical_age_three->the_patient;//因外伤住院
			$this->view->prevalence_infancy_other 	= $child_physical_age_three->prevalence_infancy_other;//幼儿期患病情况其它

			$this->view->allergic_history_current 	= array_search_for_other($child_physical_age_three->allergic_history,$allergic_history);//过敏史|radio|1=>无,2=>有
			$this->view->allergic_history_info 		= $child_physical_age_three->allergic_history_info;//过敏史信息


			$this->view->referral_features_current 	= array_search_for_other($child_physical_age_three->referral_features,$referral_features);//转诊|radio|1=>无,2=>有
			$this->view->reason 					= $child_physical_age_three->reason;//转诊原因
			$this->view->agencies_departments 		= $child_physical_age_three->agencies_departments;//转诊机构及科室

			$next_followup_time						= empty($child_physical_age_three->next_followup_time)?'':adodb_date('Y-m-d',$child_physical_age_three->next_followup_time);//随访日期
			$this->view->next_followup_time 		= $next_followup_time;//随访日期

			$advising_arr=@explode('|',$child_physical_age_three->advising);//
			$advising_arrray=array();//指导
			foreach ($advising_arr as $advising_val){
				$advising_arrray[]=array_search_for_other($advising_val,$advising);
			}
			$this->view->advising_current 			= $advising_arrray;//指导|checkbox|1=>喂养指导,2=>母乳指导,3=>疾病预防
			$this->view->advising_other 			= $child_physical_age_three->advising_other;//指导其它




			$region_users							= empty($this->user['current_region_path_domain'])?'':region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users				= $region_users;
			$this->view->doctors_signature  		= $child_physical_age_three->doctors_signature;//随访医生签名

		}

		$this->view->display('add.html');
	}
	/**
	 * 添加、修改程序
	 *
	 */
	public function updateAction(){
		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		//体格发育评价|radio|1=>正常,2=>低体重,3=>消瘦,4=>发育迟缓,5=>肥胖
		$developmental_assessment		= $bbt_developmental_assessment;
		//面色|radio|1=>红润,2=>异常
		$complexion						= $bbt_complexion;
		//步态|radio|1=>正常,2=>异常
		$gait							= $bbt_gait;
		//眼|radio|1=>未见异常,2=>异常
		$eye							= $bb_exception;
		//耳|radio|1=>未见异常,2=>异常
		$ear							= $bb_exception;
		//心肺|radio|1=>未见异常,2=>异常
		$heart_lung						= $bb_exception;
		//肝脾|radio|1=>未见异常,2=>异常
		$hepatosplenography				= $bb_exception;;
		//发育评估行为|radio|1=>通过,2=>未通过
		$behavior						= $bbt_behavior;
		//发育评估社交|radio|1=>通过,2=>未通过
		$social							= $bbt_behavior;
		//听力|radio|1=>通过,2=>未通过
		$hearing						= $bbt_behavior;
		//幼儿期患病情况|checkbox|1=>无,2=>肺炎,3=>麻疹,4=>贫血,5=>营养不良,6=>佝偻病,7=>因腹泻住院,8=>因外伤住院,9=>其它
		//$prevalence_infancy=array('1'=>'无','2'=>'肺炎','3'=>'麻疹','4'=>'贫血','5'=>'营养不良','6'=>'佝偻病','7'=>'因腹泻住院','8'=>'因外伤住院','9'=>'其它');
		//过敏史|radio|1=>无,2=>有
		$allergic_history				= $bb_referral_features;
		//转诊|radio|1=>无,2=>有
		$referral_features				= $bb_referral_features;
		//1合理膳食2生长发育3疾病预防4预防意外伤害5口腔保健
		$advising						= $bbt_advising;
		//腹部|radio|1=>未见异常,2=>异常
		$abdomen						= $bb_exception;

		//查询一个人是否做过同一个项目，有修改，无添加
		$serial_number										= $this->_request->getParam('id');//个人档案号
		$age												= $this->_request->getParam('age');//年龄
		$child_physical_age_three_chk						= new Tchild_physical_age_three();//
		$child_physical_age_three_chk->whereAdd("id='{$serial_number}'");
        $child_physical_age_three_chk->whereAdd("age='{$age}'");
		$child_physical_age_three_chk->find();
		$child_physical_age_three_chk->fetch();
		$uuid=$child_physical_age_three_chk->uuid;


		$child_physical_age_three							= new Tchild_physical_age_three();

		$child_physical_age_three->age 						= $age;//年龄
		$child_physical_age_three->sight 					= $this->_request->getParam('sight');//视力
		$vist_time 											= $this->_request->getParam('vist_time')?mkunixstamp($this->_request->getParam('vist_time')):'';
		$child_physical_age_three->vist_time 				= $vist_time;//随访日期

		$child_physical_age_three->weight 					= $this->_request->getParam('weight');//体重(kg)

		$child_physical_age_three->weight_info 				= $this->_request->getParam('weight_info');//体重情况|radio|1=>上,2=>中,3=>下

		$child_physical_age_three->height 					= $this->_request->getParam('height');//身长(cm)

		$child_physical_age_three->height_info 				= $this->_request->getParam('height_info');//身长情况|radio|1=>上,2=>中,3=>下
		
		$child_physical_age_three->sitting_hight 			= $this->_request->getParam('sitting_hight');//坐高（cm）
		$child_physical_age_three->head_size 				= $this->_request->getParam('head_size');//头围（cm）
		
		$child_physical_age_three->bust 					= $this->_request->getParam('bust');//胸围（cm）

		$child_physical_age_three->developmental_assessment = array_code_change($this->_request->getParam('developmental_assessment'),$developmental_assessment);//体格发育评价|radio|1=>正常,2=>低体重,3=>消瘦,4=>发育迟缓,5=>肥胖

		$child_physical_age_three->hearing	 				= array_code_change($this->_request->getParam('hearing'),$hearing);//听力|radio|1通过  2未过
		$child_physical_age_three->number_of_teeth 			= $this->_request->getParam('number_of_teeth');//牙数（颗）
		$child_physical_age_three->number_of_caries 		= $this->_request->getParam('number_of_caries');//龋齿数

		$child_physical_age_three->complexion 				= array_code_change($this->_request->getParam('complexion'),$complexion);//面色|radio|1=>红润,2=>异常

		$child_physical_age_three->complexion_info 			= $this->_request->getParam('complexion_info');//面色异常

		$child_physical_age_three->gait 					= array_code_change($this->_request->getParam('gait'),$gait);//步态|radio|1=>正常,2=>异常

		$child_physical_age_three->gait_info 				= $this->_request->getParam('gait_info');//步态异常

		$child_physical_age_three->eye 						= array_code_change($this->_request->getParam('eye'),$eye);//眼|radio|1=>未见异常,2=>异常

		$child_physical_age_three->eye_info 				= $this->_request->getParam('eye_info');//眼异常

		$child_physical_age_three->ear 						= array_code_change($this->_request->getParam('ear'),$ear);//耳|radio|1=>未见异常,2=>异常

		$child_physical_age_three->ear_info 				= $this->_request->getParam('ear_info');//耳异常

		$child_physical_age_three->heart_lung 				= array_code_change($this->_request->getParam('heart_lung'),$heart_lung);//心肺|radio|1=>未见异常,2=>异常

		$child_physical_age_three->heart_lung_info 			= $this->_request->getParam('heart_lung_info');//心肺异常

		$child_physical_age_three->abdomen 					= array_code_change($this->_request->getParam('abdomen'),$abdomen);//腹部|radio|1=>未见异常,2=>异常

		$child_physical_age_three->hemoglobin 				= $this->_request->getParam('hemoglobin');//血红蛋白值
		$child_physical_age_three->other 					= $this->_request->getParam('other');//体格检查其它

		$child_physical_age_three->hepatosplenography 		= array_code_change($this->_request->getParam('hepatosplenography'),$hepatosplenography);//肝脾|radio|1=>未见异常,2=>异常

		$child_physical_age_three->hepatosplenography_info 	= $this->_request->getParam('hepatosplenography_info');//肝脾异常

		$child_physical_age_three->behavior 				= array_code_change($this->_request->getParam('behavior'),$behavior);//发育评估行为|radio|1=>通过,2=>未通过

		$child_physical_age_three->behavior_info 			= $this->_request->getParam('behavior_info');//发育评估行为未通过

		$child_physical_age_three->social 					= array_code_change($this->_request->getParam('social'),$social);//发育评估社交|radio|1=>通过,2=>未通过

		$child_physical_age_three->social_info 				= $this->_request->getParam('social_info');//发育评估社交未通过


		$child_physical_age_three->pneumonia 				= $this->_request->getParam('pneumonia');//肺炎

		$child_physical_age_three->diarrhea_in_hospitalized = $this->_request->getParam('diarrhea_in_hospitalized');//因腹泻住院

		$child_physical_age_three->the_patient				= $this->_request->getParam('the_patient');//因外伤住院

		$child_physical_age_three->prevalence_infancy_other = $this->_request->getParam('prevalence_infancy_other');//幼儿期患病情况其它

		$child_physical_age_three->allergic_history 		= array_code_change($this->_request->getParam('allergic_history'),$allergic_history);//过敏史|radio|1=>无,2=>有

		$child_physical_age_three->allergic_history_info 	= $this->_request->getParam('allergic_history_info');//过敏史信息


		$next_followup_time									= $this->_request->getParam('next_followup_time')?mkunixstamp($this->_request->getParam('next_followup_time')):'';
		$child_physical_age_three->next_followup_time 				= $next_followup_time;//随访日期

		$child_physical_age_three->referral_features 		= array_code_change($this->_request->getParam('referral_features'),$referral_features);//转诊|radio|1=>无,2=>有

		$child_physical_age_three->reason 					= $this->_request->getParam('reason');//转诊原因

		$child_physical_age_three->agencies_departments 	= $this->_request->getParam('agencies_departments');//转诊机构及科室

		$advising_arr										= $this->_request->getParam('advising');//指导|checkbox|1=>喂养指导,2=>母乳指导,3=>疾病预防
		$advising_str='';
		foreach ($advising_arr as $k=>$v){
			if(isset($advising[$v][0])){
				$advising_str.=$advising[$v][0].'|';//
			}
		}

		$child_physical_age_three->advising 				= $advising_str;//指导|checkbox|1=>喂养指导,2=>母乳指导,3=>疾病预防


		$child_physical_age_three->advising_other 			= $this->_request->getParam('advising_other');//指导其它

		$child_physical_age_three->doctors_signature 		= $this->_request->getParam('doctors_signature');//随访医生签名

		if(empty($uuid)){
			//添加
			$uuid									=uniqid("bb",true);//编号

			$child_physical_age_three->uuid 		= $uuid;//编号

			$child_physical_age_three->staff_id 	= $this->user['uuid'];//医生档案号
			$individual_session 					= new Zend_Session_Namespace("individual_core");

			$child_physical_age_three->id 			= empty($serial_number)?$individual_session->uuid:$serial_number;//个人档案号

			$child_physical_age_three->created 		= time();//添加记录时间
			//$child_physical_age_three->debugLevel(8);
			$update_token							= $child_physical_age_three->insert();

		}else{
			//修改
			$child_physical_age_three->whereAdd("uuid='$uuid'");
			$update_token							= $child_physical_age_three->update();

		}
		if($update_token==true){
			message("更新成功！",array("3～6岁儿童健康检查录表列表"=>__BASEPATH.'children/threeold/index',"添加"=>__BASEPATH."children/threeold/add","修改"=>__BASEPATH."children/threeold/add/id/$serial_number/age/$age"));
		}else{
			message("更新失败！",array("3～6岁儿童健康检查录表列表"=>__BASEPATH.'children/threeold/index',"添加"=>__BASEPATH."children/threeold/add","修改"=>__BASEPATH."children/threeold/add/id/$serial_number/age/$age"));
		}


	}
	
	/**
	 * 删除操作
	 *
	 */
	public function delAction(){
		$uuid			= $this->_request->getParam('uuid');
		$child_physical_age_three	=new Tchild_physical_age_three();
		$child_physical_age_three->whereAdd("uuid='$uuid'");
		if($child_physical_age_three->delete()){
			message("删除成功！",array("3～6岁儿童健康检查录表列表"=>__BASEPATH.'children/threeold/index',"添加"=>__BASEPATH."children/threeold/add"));
		}else {
			message("删除失败！",array("3～6岁儿童健康检查录表列表"=>__BASEPATH.'children/threeold/index',"添加"=>__BASEPATH."children/threeold/add"));
		}
	}
	/**
	 * 
	 * 获取child_physical_age_three最新的一条记录取得访问时间和随访医生
	 *
	 * @param unknown_type $id
	 * @return unknown
	 */
	private function getChildrenInfo($id=''){
		if(empty($id)){
			throw new Exception("参数错误！");
		}
		$result=array();
		$child_physical = new Tchild_physical_age_three();//
		$child_physical->whereAdd("id='$id'");
		$child_physical->orderby("created DESC");
		$child_physical->find();
		$child_physical->fetch();
		$result['vist_time']			= $child_physical->vist_time;
		$result['doctors_signature']	= $child_physical->doctors_signature;
		$child_physical->free_statement();
		return $result;

	}
	
	
}
?>