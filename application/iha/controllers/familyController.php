<?php
/**
*@author：
*@filename: familyController.php
*@create：2010-5-31
*/
class iha_familyController extends controller
{
	private $mask_char='******';

	//此级别以下的用like 以上的用instr
	public $optimizerRegion=4;
	/**
	 * 等同于构造函数
	 */
	public function init()
	{
		$this->haveWritePrivilege='';
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/family_archive.php";
		require_once __SITEROOT."library/Models/standard_archive_rate.php";
		require_once(__SITEROOT.'library/MyAuth.php');
        require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->assign("baseUrl",__BASEPATH);
		$this->view->assign( "basePath", __BASEPATH );

		//region_array.php
		//print_r($this->identity);
	}
	/**
	 * 个人档案列表
	 */
	public function indexAction()
	{
	    unset($_SESSION['families']);
		//set_time_limit(0);
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		require_once __SITEROOT.'/library/custom/comm_function.php';
		//高级搜索使用数据字典
		$this->view->assign("sex",$sex);
		$this->view->assign("registered_permanent_residence",$registered_permanent_residence);
		$this->view->assign("school_type",$school_type);
		$this->view->assign("occupation",$occupation);
		$this->view->assign("race",$race);
		$this->view->assign("races",$races);
		$this->view->assign("marriage",$marriage);
		$this->view->assign("charge_style",$charge_style);
		$this->view->assign("charge_style_json",json_encode($charge_style));//因为JS文件中使用
		$this->view->assign("ABO_bloodtype",$ABO_bloodtype);
		$this->view->assign("RH_bloodtype",$RH_bloodtype);
		$this->view->assign("comm",$comm);
		$this->view->assign("allergy_history",$allergy_history);
		$this->view->assign("family_history",$family_history);
		$this->view->assign("disease_history",$disease_history);
		$this->view->assign("deformity_type",$deformity_type);
		$this->view->assign('region_id',$this->user['region_id']);
		$this->view->assign('region_p_id',$this->user['region_id']);
		$individual_core_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],"");
		//医生列表结束

		$search=array();
		$core=new Tindividual_core();
		$core->whereAdd($individual_core_region_path_domain);
		$core->whereAdd("individual_core.relation_holder='1'");
		$nums=$core->count();
        //不能去掉
		//$core->whereAdd("individual_core.updated>'0'");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'iha/family/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//$core->joinAdd('left',$core,$family,'family_number','uuid');
		//$core->joinAdd('left',$core,$individual_archive,'uuid','id');
		//$temp1=explode(",",$this->user['current_region_path']);
		//$current_user_region_level=count($temp1);
		$core->selectAdd("
		individual_core.uuid as uuid,
		individual_core.name as name,
		individual_core.sex as sex,
		individual_core.family_number as family_number,
		individual_core.address as address,
		individual_core.staff_id as staff_id,
		individual_core.standard_code_1 as standard_code_1,
		individual_core.standard_code_2 as standard_code_2,
		individual_core.phone_number as phone_number,
		individual_core.date_of_birth as date_of_birth,
		individual_core.criteria_rate as criteria_rate,
		individual_core.relation_holder as relation_holder
		");		

		$core->orderby("individual_core.updated DESC");
		//处理分页
		$core->limit($startnum,__ROWSOFPAGE);
		$core->find();
		$indiv=array();
		$i=0;
		while ($core->fetch()){
			$indiv[$i]['uuid']=$core->uuid;
			if($this->haveWritePrivilege){
				//$indiv[$i]['name']="<a href='/iha/cover/add/action/edit/uuid/".$core->uuid."'>".$core->name.'('.substr($core->standard_code_2,23,2).')'."</a>&nbsp;";
				//$indiv[$i]['name']="<a href='/iha/cover/add/action/edit/uuid/".$core->uuid."'>".$core->name."</a>&nbsp;";
				$indiv[$i]['name']="<a href='".__BASEPATH."iha/cover/add/action/edit/uuid/".$core->uuid."/para_page/$pageCurrent/opener/family'>".$core->name."</a>&nbsp;";
				//$indiv[$i]['householder_name']=get_househoder_name($core->family_number);
				$indiv[$i]['householder_name']=$core->name;
				
				$indiv[$i]['contact_number']=$core->phone_number;
			}else{
				$indiv[$i]['name']=$this->mask_char;
				$indiv[$i]['householder_name']=$this->mask_char;
				$indiv[$i]['contact_number']=$this->mask_char;
			}
            $indiv[$i]['family_number_edit']=$core->family_number;
			$indiv[$i]['family_number']=substr($core->standard_code_2,0,22);
			//取家庭成员
			$string='';
			if($core->relation_holder==1){
				$temp_individual=new Tindividual_core();
				//$temp_individual->selectAdd("uuid as uuid,name as name,");
				$temp_individual->whereAdd("family_number='".$core->family_number."'");
				$temp_individual->whereAdd("uuid!='".$core->uuid."'");
				//$temp_individual->debugLevel(9);
				$temp_individual->find();
				$temp_individual->orderby('standard_code_2');

				while ($temp_individual->fetch()){
					$string=$string."<a href='".__BASEPATH."iha/cover/add/action/edit/uuid/".$temp_individual->uuid."/para_page/$pageCurrent/opener/family'>".$temp_individual->name.'('.substr($temp_individual->standard_code_2,23,2).')'."</a>&nbsp;";
				}

			}
			$indiv[$i]['family_member_list']=$string==''?'无':$string;
			
			
			$indiv[$i]['standard_code']=$core->standard_code_1;
			//$indiv[$i]['standard_code']=$core->region_path.'|'.$core->standard_code_1;
			$indiv[$i]['address']=$core->address;
			$indiv[$i]['sex']=@$sex[array_search_for_other($core->sex,$sex)][1];
			$indiv[$i]['date_of_birth']=adodb_date("Y-m-d",$core->date_of_birth);
			$indiv[$i]['age']=getBirthday($core->date_of_birth,time());
			$indiv[$i]['criteria_rate']=$core->criteria_rate*100;
			$indiv[$i]['staff_id']=$core->staff_id;
			$indiv[$i]['staff_name']=get_staff_name_byid($core->staff_id);
			$i++;
		}
		$out = $links->subPageCss3();
		$this->view->assign("page",$pageCurrent);
		$this->view->assign("pager",$out);
		$this->view->assign("iha",$indiv);
		$individual_session=new Zend_Session_Namespace("individual_core");
		$this->view->assign("individual_current",$individual_session);
		$this->view->error_message=$this->_request->getParam('error_message','');
		$this->view->display("list.html");
	}


	public function listAction()
	{
		//global $s;
		//set_time_limit(0);
        unset($_SESSION['families']);
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once(__SITEROOT.'library/custom/region_array.php');
		$time=time();
		$search=array();
		$searchurl="";
		$search['username']=$this->_request->getParam('username');//姓名包含拼音
		$nocard=$this->_request->getParam('nocard');//无身份证人员
		$search['staff_id']=($this->_request->getParam('staff_id')=="-9")?"":$this->_request->getParam('staff_id');//建档医生
		$search['standard_code']=$this->_request->getParam('standard_code');//标准档案号
		$search['identity_number']=$this->_request->getParam('identity_number');//身份证号
		$search['age_start']=intval($this->_request->getParam('age_start'))?intval($this->_request->getParam('age_start')):0;//年龄段
		$search['age_end']=(intval($this->_request->getParam('age_end'))>=$search['age_start'])?intval($this->_request->getParam('age_end')):'';
		$search['phone_number']=$this->_request->getParam('phone_number');//电话号码
		$search['unit_name']=$this->_request->getParam('unit_name');//工作单位
		$search['residence']=(is_array($this->_request->getParam('residence')) && !is_empty_for_multi($this->_request->getParam('residence')))?implode("||",$this->_request->getParam('residence')):$this->_request->getParam('residence');//常住类型-数组
		$search['sex']=(is_array($this->_request->getParam('sex')) && !is_empty_for_multi($this->_request->getParam('sex')))?implode("||",$this->_request->getParam('sex')):$this->_request->getParam('sex');//性别-数组
		$search['school_type']=(is_array($this->_request->getParam('school_type')) && !is_empty_for_multi($this->_request->getParam('school_type')))?implode("||",$this->_request->getParam('school_type')):$this->_request->getParam('school_type');//文化程度-数组
		$search['occupation']=(is_array($this->_request->getParam('occupation')) && !is_empty_for_multi($this->_request->getParam('occupation')))?implode("||",$this->_request->getParam('occupation')):$this->_request->getParam('occupation');//职业-数组
		$search['marriage']=(is_array($this->_request->getParam('marriage')) && !is_empty_for_multi($this->_request->getParam('marriage')))?implode("||",$this->_request->getParam('marriage')):$this->_request->getParam('marriage');//婚姻状况-数组
		$search['allergy_history']=(is_array($this->_request->getParam('allergy_history')) && !is_empty_for_multi($this->_request->getParam('allergy_history')))?implode("||",$this->_request->getParam('allergy_history')):$this->_request->getParam('allergy_history');//药物过敏史-数组
		$search['disease_history']=(is_array($this->_request->getParam('disease_history')) && !is_empty_for_multi($this->_request->getParam('disease_history')))?implode("||",$this->_request->getParam('disease_history')):$this->_request->getParam('disease_history');//疾病史-数组
		$search['surgery_history']=(is_array($this->_request->getParam('surgery_history')) && !is_empty_for_multi($this->_request->getParam('surgery_history')))?implode("||",$this->_request->getParam('surgery_history')):$this->_request->getParam('surgery_history');//手术史-数组
		$search['trauma_history']=(is_array($this->_request->getParam('trauma_history')) && !is_empty_for_multi($this->_request->getParam('trauma_history')))?implode("||",$this->_request->getParam('trauma_history')):$this->_request->getParam('trauma_history');//外伤史-数组
		$search['blood_history']=(is_array($this->_request->getParam('blood_history')) && !is_empty_for_multi($this->_request->getParam('blood_history')))?implode("||",$this->_request->getParam('blood_history')):$this->_request->getParam('blood_history');//输血史-数组
		$search['genetic_diseases_history']=(is_array($this->_request->getParam('genetic_diseases_history')) && !is_empty_for_multi($this->_request->getParam('genetic_diseases_history')))?implode("||",$this->_request->getParam('genetic_diseases_history')):$this->_request->getParam('genetic_diseases_history');//遗传病史-数组
		$search['disability']=(is_array($this->_request->getParam('disability')) && !is_empty_for_multi($this->_request->getParam('disability')))?implode("||",$this->_request->getParam('disability')):$this->_request->getParam('disability');//残疾状况-数组
		$orderby=$this->_request->getParam('order');
		$turn=($this->_request->getParam('turn')=="asc" || $this->_request->getParam('turn')=="desc")?$this->_request->getParam('turn'):"desc";
		$org_id=$this->user['org_id'];
		$search_region['region_p_id']=$this->_request->getParam('region_p_id');//地区
		$org_region_domain=$this->user['current_region_path_domain'];
		$temp=explode("|",$org_region_domain);
		$individual_core_region_path_domain='';
		$temp1=explode(",",$this->user['current_region_path']);
		$current_user_region_level=count($temp1);
		foreach ($temp as $k1=>$v1){
			if($current_user_region_level<=$this->optimizerRegion){
				$individual_core_region_path_domain=$individual_core_region_path_domain."INSTR(individual_core.region_path,'".$v1."')>0 or ";
			}else{
				$individual_core_region_path_domain=$individual_core_region_path_domain."individual_core.region_path like '".$v1."%' or ";
			}
		}
		$individual_core_region_path_domain=rtrim($individual_core_region_path_domain,' or ');
		//如果选择了地区，按地区过滤数据，还要按地区过虑数据
		if($search_region['region_p_id']!=''){
			$temp=$regionInfo[$search_region['region_p_id']][2];
			$temp1=explode(",",$temp);
			if(count($temp1)<=$this->optimizerRegion){
				//$individual_core_region_path_domain=$individual_core_region_path_domain."INSTR(individual_core.region_path,'".$v1."')>0 or ";
				$individual_core_region_path_domain='('.$individual_core_region_path_domain.') '."and INSTR(individual_core.region_path,'".$temp."')>0 ";
			}else{
				//$individual_core_region_path_domain=$individual_core_region_path_domain."individual_core.region_path like '".$v1."%' or ";
				$individual_core_region_path_domain='('.$individual_core_region_path_domain.') '." and individual_core.region_path like '".$temp."%' ";
			}
		}
		$core=new Tindividual_core();
		//家庭档案，为取户主姓名
		$family=new Tfamily_archive();
		//个人档案附加表，为实现高级搜索
		$individual_archive=new Tindividual_archive();
		//处理搜索
		$archive=array('unit_name','residence','sex','school_type','occupation','marriage','allergy_history','disease_history','surgery_history','trauma_history','blood_history','genetic_diseases_history','disability');//附加表中搜索字段
		if (!is_empty_for_multi($search))
		{
			foreach ($search as $k=>$v)
			{
				if (is_array($v))
				{
					$v=implode($v,"||");
				}
				if ($v!="" && in_array($k,$archive))
				{
					//数据部分数据全部都取自附加表,因为数组被转换成了含有||的值，所以需要特殊处理，所以
					//组合搜索URL
					$searchurl.="/$k/$v";
					$v=str_replace("%","\%",$v);
					$v=str_replace("_","\_",$v);
					$temp=array();
					$temp=explode("||",$v);
					if (is_array($temp) && !is_empty_for_multi($temp))
					{
						$search_string="";//因为是多条件，所以多个条件间是或者的关系
						foreach ($temp as $m=>$n)
						{
							//if($n!="")
							//{
							if($k!="sex")
							{
								if($n=='all')
								{
									$search_string.= "individual_archive.$k is null or ";
								}
								else
								{
									$search_string.= "individual_archive.$k='$n' or ";
								}
							}
							elseif($k=="sex")
							{
								if($n=='all')
								{
									$search_string.= "individual_core.$k is null or ";
								}
								else
								{
									$search_string.= "individual_core.$k='$n' or ";
								}
							}
							//}
						}
						$search_string=substr($search_string,0,-3);
						if (strpos($search_string,"individual_core")!==false || strpos($search_string,"individual_archive")!==false)
						{
							$core->whereAdd("$search_string");
						}
					}
				}
				else
				{
					//组合搜索URL
					$searchurl.="/$k/$v";
					//移除通配符
					$v=str_replace("%","\%",$v);
					$v=str_replace("_","\_",$v);
					if (!in_array($k,$archive) && $k!="unit_name" && $k!="age_start" && $k!="age_end" && $k!="username" && $k!="order" && $k!="turn" && $k!="standard_code" && $k!="staff_id" && $v!='')
					{
						$core->whereAdd("individual_core.$k like '$v%'");
					}
					if ($k=="standard_code" && $v!='')
					{
						$core->whereAdd("individual_core.standard_code_1 like '$v%'");
					}
					if ($k=="username" && $v!='')
					{
						$core->whereAdd("individual_core.name like '$v%' or individual_core.name_pinyin like '$v%'");
					}
					if ($k=="age_start" && $v!='' && $v!=0)
					{
						$v=adodb_mktime(0,0,0,adodb_date("n",$time),adodb_date("j",$time),adodb_date("Y",$time)-$v);
						$core->whereAdd("individual_core.date_of_birth <= '$v'");
					}
					if ($k=="age_end" && $v!='' && $v!=0)
					{
						$v=$v+1;
						$v=adodb_mktime(0,0,0,adodb_date("n",$time),adodb_date("j",$time),adodb_date("Y",$time)-$v);
						$core->whereAdd("individual_core.date_of_birth >= '$v'");
					}
					if($k=="unit_name" && $v!='' && $v!=0)
					{
						//单独处理工作单位，因为它属于附加表
						$core->whereAdd("individual_archive.$k like '$v%'");
					}
					if($k=="staff_id" && $v!='' && $v!=0)
					{
						$core->whereAdd("individual_core.$k = '$v'");
					}
				}
			}
			//这里是关键，没有查询条件的时候就不关联
			$core->joinAdd('left',$core,$individual_archive,'uuid','id');
			//$core->joinAdd('inner',$core,$family,'family_number','uuid');
			//下面二句不能丟
			$individual_archive->selectAdd("individual_archive.id as individual_archive_id");
			//$family->selectAdd("family_archive.family_number as family_archive_family_number");
		}
		if ($nocard && $nocard=="1")
		{
			$core->whereAdd("individual_core.identity_number is null");
		}
		//根据oracle where 优化原理，这句放在这
		$core->whereAdd($individual_core_region_path_domain);
		$core->whereAdd("individual_core.relation_holder='1'");

		//$core->whereAdd("individual_core.updated>'0'");
        //$core->debuglevel(9);
		$nums=$core->count();
		//echo $nums;
		$pageCurrent = intval($this->_request->getParam('page'));
		//echo $pageCurrent;
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'iha/family/list/page/',2,array());
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//$core->count();
		//处理排序
		if ($orderby){
			$search['order']=$orderby;
			$search['turn']=$turn;
		}
		//$core->joinAdd('left',$core,$family,'family_number','uuid');
		//$core->joinAdd('left',$core,$individual_archive,'uuid','id');
		//处理排序
		if ($orderby){
			$core->orderby("individual_core.$orderby $turn");
			//$core->whereAdd("individual_core.$orderby!=''");
			$searcharray['order']=$orderby;
			$searcharray['turn']=$turn;
		}else{
			//默认按编辑时间排序
			//$core->whereAdd("individual_core.updated>'0'");
			$core->orderby("individual_core.updated DESC");
		}
		//处理分页
		$core->limit($startnum,__ROWSOFPAGE);
		//$core->limit(0,10);
		//$core->debuglevel(9);
		$core->selectAdd("
		individual_core.uuid as uuid,
		individual_core.name as name,
		individual_core.sex as sex,
		individual_core.family_number as family_number,
		individual_core.address as address,
		individual_core.staff_id as staff_id,
		individual_core.standard_code_2 as standard_code_2,
		individual_core.phone_number as phone_number,
		individual_core.date_of_birth as date_of_birth,
		individual_core.criteria_rate as criteria_rate,
		individual_core.relation_holder as relation_holder		
		");

		$core->find();
		//exit();
		$indiv=array();
		$i=0;
		while ($core->fetch()){
			$indiv[$i]['uuid']=$core->uuid;
			if($this->haveWritePrivilege){
				//$indiv[$i]['name']=$core->name;
				$indiv[$i]['name']="<a href='".__BASEPATH."iha/cover/add/action/edit/uuid/".$core->uuid."/para_page/$pageCurrent/opener/family'>".$core->name."</a>&nbsp;";
				$indiv[$i]['householder_name']=get_househoder_name($core->family_number);
				$indiv[$i]['contact_number']=$core->phone_number;
			}else{
				$indiv[$i]['name']=$this->mask_char;
				$indiv[$i]['householder_name']=$this->mask_char;
				$indiv[$i]['contact_number']=$this->mask_char;
			}
			$indiv[$i]['address']=$core->address;
			$indiv[$i]['staff_id']=$core->staff_id;
			$indiv[$i]['family_number_edit']=$core->family_number;
			$indiv[$i]['family_number']=substr($core->standard_code_2,0,22);
			
			//取家庭成员
			$string='';
			if($core->relation_holder==1){
				$temp_individual=new Tindividual_core();
				//$temp_individual->selectAdd("uuid as uuid,name as name,");
				$temp_individual->whereAdd("family_number='".$core->family_number."'");
				$temp_individual->whereAdd("uuid!='".$core->uuid."'");
				//$temp_individual->debugLevel(9);
				$temp_individual->find();

				while ($temp_individual->fetch()){
					//$string=$string."<a href='/iha/cover/add/action/edit/uuid/".$temp_individual->uuid."'>".$temp_individual->name.'('.substr($temp_individual->standard_code_2,23,2).')'."</a>&nbsp;";
					$string=$string."<a href='".__BASEPATH."iha/cover/add/action/edit/uuid/".$temp_individual->uuid."/para_page/$pageCurrent/opener/family'>".$temp_individual->name.'('.substr($temp_individual->standard_code_2,23,2).')'."</a>&nbsp;";
				}

			}
			$indiv[$i]['family_member_list']=$string==''?'无':$string;			
			$indiv[$i]['standard_code']=$core->standard_code_1;
			$indiv[$i]['sex']=@$sex[array_search_for_other($core->sex,$sex)][1];
			$indiv[$i]['date_of_birth']=adodb_date("Y-m-d",$core->date_of_birth);
			$indiv[$i]['age']=getBirthday($core->date_of_birth,time());
			$indiv[$i]['staff_name']=get_staff_name_byid($core->staff_id);
			$indiv[$i]['criteria_rate']=$core->criteria_rate*100;
			$i++;
		}
		$out = $links->subPageCss3();
		$this->view->assign("page",$pageCurrent);
		$this->view->assign("pager",$out);
		$this->view->assign("search",$searchurl);
		$this->view->assign("iha",$indiv);
		$individual_session=new Zend_Session_Namespace("individual_core");
		$this->view->assign("individual_current",$individual_session);
		$this->view->display("list_extra.html");
	}
    /**
     * @author 我好笨
     * @todo 家庭档案编辑展示
     * */
    public function editAction()
    {
        //数据字典
        require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $this->view->assign("family_bide_style",$family_bide_style);
        $this->view->assign("family_bloat_food",$family_bloat_food);
        $this->view->assign("family_deepfry_food",$family_deepfry_food);
        $this->view->assign("family_drinking_water_source",$family_drinking_water_source);
        $this->view->assign("family_fat_food",$family_fat_food);
        $this->view->assign("family_fruit",$family_fruit);
        $this->view->assign("family_fuel",$family_fuel);
        $this->view->assign("family_greenstuff",$family_greenstuff);
        $this->view->assign("family_history",$family_history);
        $this->view->assign("family_home_month_income",$family_home_month_income);
        $this->view->assign("family_home_phone",$family_home_phone);
        $this->view->assign("family_home_refrigeratory",$family_home_refrigeratory);
        $this->view->assign("family_sanitation",$family_sanitation);
        $this->view->assign("family_secondhand_smoke",$family_secondhand_smoke);
        $this->view->assign("family_sweet_food",$family_sweet_food);
        //取数据
        $fuuid=$this->_request->getParam('uuid');//姓名包含拼音
        if($fuuid)
        {
            $family=new Tfamily_archive();
            $iha=new Tindividual_core();            
            $family->joinAdd('left',$family,$iha,'householder_id','uuid');
            $family->whereAdd("family_archive.uuid='$fuuid'");
            $family->find(true);
            //转换代码
            $family->bide_style=array_search_for_other($family->bide_style,$family_bide_style);
            $family->bloat_food=array_search_for_other($family->bloat_food,$family_bloat_food);
            $family->deepfry_food=array_search_for_other($family->deepfry_food,$family_deepfry_food);
            $family->drinking_water_source=array_search_for_other($family->drinking_water_source,$family_drinking_water_source);
            $family->fat_food=array_search_for_other($family->fat_food,$family_fat_food);
            $family->fruit=array_search_for_other($family->fruit,$family_fruit);
            $family->fuel=array_search_for_other($family->fuel,$family_fuel);
            $family->greenstuff=array_search_for_other($family->greenstuff,$family_greenstuff);
            $family->history=array_search_for_other($family->history,$family_history);
            $family->home_month_income=array_search_for_other($family->home_month_income,$family_home_month_income);
            $family->home_phone=array_search_for_other($family->home_phone,$family_home_phone);
            $family->home_refrigeratory=array_search_for_other($family->home_refrigeratory,$family_home_refrigeratory);
            $family->sanitation=array_search_for_other($family->sanitation,$family_sanitation);
            $family->secondhand_smoke=array_search_for_other($family->secondhand_smoke,$family_secondhand_smoke);
            $family->sweet_food=array_search_for_other($family->sweet_food,$family_sweet_food);
            $this->view->assign("family",$family);
            $this->view->assign("relation_holder",$relation_holder);
            $this->view->assign("iha",$iha);
           $this->view->display("edit.html"); 
        }
        else
        {
            $url=array("家庭档案列表"=>__BASEPATH.'iha/family/index');
			message("编辑家庭档案失败，代码：f001",$url);
            exit;
        }
    }
    /**
     * @author 我好笨
     * @todo 编辑写入数据库
     * 
     * */
    public function editinAction()
    {
        require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $this->view->assign("family_bide_style",$family_bide_style);
        $this->view->assign("family_bloat_food",$family_bloat_food);
        $this->view->assign("family_deepfry_food",$family_deepfry_food);
        $this->view->assign("family_drinking_water_source",$family_drinking_water_source);
        $this->view->assign("family_fat_food",$family_fat_food);
        $this->view->assign("family_fruit",$family_fruit);
        $this->view->assign("family_fuel",$family_fuel);
        $this->view->assign("family_greenstuff",$family_greenstuff);
        $this->view->assign("family_history",$family_history);
        $this->view->assign("family_home_month_income",$family_home_month_income);
        $this->view->assign("family_home_phone",$family_home_phone);
        $this->view->assign("family_home_refrigeratory",$family_home_refrigeratory);
        $this->view->assign("family_sanitation",$family_sanitation);
        $this->view->assign("family_secondhand_smoke",$family_secondhand_smoke);
        $this->view->assign("family_sweet_food",$family_sweet_food);
        $uuid=$this->_request->getParam('uuid');
        if($uuid)
        {
            $family_archive=new Tfamily_archive();
        
            $family_archive->uuid = $uuid;//
            
            $family_archive->updated = time();//
            
            $family_archive->telephone_number = $this->_request->getParam('telephone_number');//家庭电话
            
            $family_archive->relation_of_householder = $this->_request->getParam('relation_of_householder');//家庭构成
            
            $family_archive->home_area = $this->_request->getParam('home_area');//居住面积
            
            $family_archive->bide_style = array_code_change($this->_request->getParam('bide_style'),$family_bide_style);//居住状况
            
            //$family_archive->building_style = array_code_change($this->_request->getParam('building_style'),$family_building_style);//房屋类型
            
            $family_archive->drinking_water_source = array_code_change($this->_request->getParam('drinking_water_source'),$family_drinking_water_source);//饮用水来源
            
            $family_archive->sanitation = array_code_change($this->_request->getParam('sanitation'),$family_sanitation);//卫生设施
            
            $family_archive->fuel = array_code_change($this->_request->getParam('fuel'),$family_fuel);//燃料类型
            
            $family_archive->home_month_income = array_code_change($this->_request->getParam('home_month_income'),$family_home_month_income);//家庭月收入
            
            $family_archive->home_phone = array_code_change($this->_request->getParam('home_phone'),$family_home_phone);//家庭有线电话
            
            $family_archive->home_refrigeratory = array_code_change($this->_request->getParam('home_refrigeratory'),$family_home_refrigeratory);//家庭冰箱
            
            $family_archive->deformity_number = intval($this->_request->getParam('deformity_number'));//残疾人数
            
            $family_archive->family_smoke_number = intval($this->_request->getParam('family_smoke_number'));//家庭吸烟人数
            
            $family_archive->secondhand_smoke = array_code_change($this->_request->getParam('secondhand_smoke'),$family_secondhand_smoke);//其他人吸二手烟
            
            $family_archive->fat_food = array_code_change($this->_request->getParam('fat_food'),$family_fat_food);//含脂肪多的食物
            
            $family_archive->deepfry_food = array_code_change($this->_request->getParam('deepfry_food'),$family_deepfry_food);//油炸或熏制的食物
            
            $family_archive->bloat_food = array_code_change($this->_request->getParam('bloat_food'),$family_bloat_food);//腌制的食品
            
            $family_archive->sweet_food = array_code_change($this->_request->getParam('sweet_food'),$family_sweet_food);//甜食
            
            $family_archive->greenstuff = array_code_change($this->_request->getParam('greenstuff'),$family_greenstuff);//蔬菜
            
            $family_archive->fruit = $this->_request->getParam('fruit');//水果
            
            $family_archive->salt = $this->_request->getParam('salt');//盐
            
            $family_archive->oil = $this->_request->getParam('oil');//油
            
            $family_archive->sn_self_define = $this->_request->getParam('sn_self_define');//家庭自定义档案编号
            
            $family_archive->community = $this->_request->getParam('community');//所属居委会
            
            $family_archive->police_station = $this->_request->getParam('police_station');//派出所
            
            $family_archive->whereAdd("uuid='$uuid'");
            
    		if ($family_archive->update(array($this->user['uuid'],'updated')))
    		{
    		    $url=array("家庭档案列表"=>__BASEPATH.'iha/family/index');
    			message("编辑家庭档案成功",$url);
                exit;   
            }
            else
            {
                $url=array("家庭档案列表"=>__BASEPATH.'iha/family/index');
    			message("编辑家庭档案失败，代码：f003",$url);
                exit; 
            }
        }
        else
        {
            $url=array("家庭档案列表"=>__BASEPATH.'iha/family/index');
			message("编辑家庭档案失败，代码：f002",$url);
            exit;
        }
    }
    /**
     * iha_familyController::moveselectAction()
     * 
     * 批量转出家庭选中家庭信息
     * 
     * 我好笨
     * 
     * @return void
     */
    public function moveselectAction()
    {
        unset($_SESSION['families']);
        $ids=$this->_request->getParam('uuids');
        if(!empty($ids))
        {
            $_SESSION['families']=$ids;
        }
    }
    /**
     * iha_familyController::moveAction()
     * 
     * 迁出家庭显示详细
     * 
     * 我好笨
     * 
     * @return void
     */
    public function moveAction()
    {
        $uuid=$this->_request->getParam('uuid');
        $address='';       
        if($uuid || !empty($_SESSION['families']))
        {
            if($uuid)
            {
                //转单个家庭
                $temp_individual=new Tindividual_core();
				$temp_individual->whereAdd("family_number='".$uuid."'");
				$temp_individual->find();
                $string='';
				while ($temp_individual->fetch())
                {
                    if($temp_individual->relation_holder==1)
                    {
                        $string.='<span class="red">'.$temp_individual->name.'('.substr($temp_individual->standard_code_2,23,2).')'."</span>&nbsp;";
                        $address=$temp_individual->address;
                    }
                    else
                    {
                        $string.=$temp_individual->name.'('.substr($temp_individual->standard_code_2,23,2).')'."&nbsp;";
                    }
				}
            }
            elseif(!empty($_SESSION['families']))
            {
                //批量转
                $string='';
                foreach($_SESSION['families'] as $k=>$v)
                {
                    $string.=($k+1).'、';
                    $temp_individual=new Tindividual_core();
    				$temp_individual->whereAdd("family_number='".$v."'");
    				$temp_individual->find();
    				while ($temp_individual->fetch())
                    {
                        if($temp_individual->relation_holder==1)
                        {
                            $string.='<span class="red">'.$temp_individual->name.'('.substr($temp_individual->standard_code_2,23,2).')'."</span>&nbsp;";
                            $address.=($k+1).'、'.$temp_individual->address.'<br /><br />';
                        }
                        else
                        {
                            $string.=$temp_individual->name.'('.substr($temp_individual->standard_code_2,23,2).')'."&nbsp;";
                        }
    				}
                    $string.='<br /><br />';
                }
            }
            else
            {
                $url=array("家庭档案列表"=>__BASEPATH.'iha/family/index');
    			message("获取家庭档案号错误，无法完成转出操作",$url);
                exit;
            }
            $this->view->string=$string;
            //取医生能够操作的最大范围
            $org_id=$this->user['org_id'];
            $temp = explode(',', $this->user['current_region_path']);
            $region_id = $temp[count($temp) - 1];
            $region_last_id_old = $region_id;
            $this->view->region_id_1 = $region_id;
            $this->view->region_last_id_old = $region_last_id_old;
            $this->view->uuid=$uuid;
            $this->view->address=$address;
            $this->view->display('move.html');
        }
        else
        {
            $url=array("家庭档案列表"=>__BASEPATH.'iha/family/index');
			message("获取家庭档案号错误，无法完成转出操作",$url);
            exit;
        }
    }
    /**
     * iha_familyController::moveinAction()
     * 
     * 转出档案，写入数据库
     * 
     * 我好笨
     * 
     * @return void
     */
    public function moveinAction()
    {
        $region_id=$this->_request->getParam('region_p_id');
        $edit_address=$this->_request->getParam('edit_address');
        $region_path='';
        if($region_id)
        {
            //取region_path
            require_once __SITEROOT."library/Models/region.php";
            $region=new Tregion();
            $region->whereAdd("id='$region_id'");
            $region->find(true);
            $region_path=$region->region_path;
            $address='';
            $tmp_path=explode(',',$region_path);
            if(!empty($tmp_path))
            {
                foreach($tmp_path as $k=>$v)
                {
                    if($k>1)
                    {
                        $region_tmp=new Tregion();
                        $region_tmp->whereAdd("id='$v'");
                        $region_tmp->find(true);
                        $address.=$region_tmp->zh_name;
                        $region_tmp->free_statement();
                    }
                }
            }
        }
        else
        {
            unset($_SESSION['families']);
            $url=array("家庭档案列表"=>__BASEPATH.'iha/family/index');
			message("转出档案必须选择正确的转出地区",$url);
            exit;
        }
        $uuid=$this->_request->getParam('uuid');
        if($uuid)
        {
            //转单个家庭
            $temp_individual=new Tindividual_core();
			$temp_individual->whereAdd("family_number='".$uuid."'");
			$temp_individual->find();
            $error=0;
            $success=0;
            while($temp_individual->fetch())
            {
                $move_individual=new Tindividual_core();
                $move_individual->region_path=$region_path;
                if($address && $temp_individual->relation_holder==1 && $edit_address)
                {
                    $move_individual->address=$address;
                }
                $move_individual->whereAdd("uuid='".$temp_individual->uuid."'");
                if($move_individual->update($this->user['uuid']))
                {
                    $success++;
                }
                else
                {
                    $error++;
                }
            }
            $url=array("家庭档案列表"=>__BASEPATH.'iha/family/index');
			message("转出家庭完成，其中有".$success."个家庭成员成功转出，".$error."个家庭成员转出失败，需要手工处理",$url);
            exit;
        }
        elseif(!empty($_SESSION['families']))
        {
            //批量转
            $error=0;
            $success=0;
            foreach($_SESSION['families'] as $k=>$v)
            {
                $temp_individual=new Tindividual_core();
    			$temp_individual->whereAdd("family_number='".$v."'");
    			$temp_individual->find();
                while($temp_individual->fetch())
                {
                    $move_individual=new Tindividual_core();
                    $move_individual->region_path=$region_path;
                    if($address && $temp_individual->relation_holder==1 && $edit_address)
                    {
                        $move_individual->address=$address;
                    }
                    $move_individual->whereAdd("uuid='".$temp_individual->uuid."'");
                    if($move_individual->update($this->user['uuid']))
                    {
                        $success++;
                    }
                    else
                    {
                        $error++;
                    }
                }
            }
            $url=array("家庭档案列表"=>__BASEPATH.'iha/family/index');
			message("转出家庭完成，其中有".$success."个家庭成员成功转出，".$error."个家庭成员转出失败，需要手工处理",$url);
            exit;
            unset($_SESSION['families']);
        }
        else
        {
            $url=array("家庭档案列表"=>__BASEPATH.'iha/family/index');
			message("获取家庭档案号错误，无法完成转出操作",$url);
            exit;
        }
    }
    /**
     * iha_familyController::importAction()
     * 
     * 导出家庭档案列表
     * 
     * @return void
     */
    public function importAction()
    {
        //判断当前时间
        //2012-03-30 领导要求必须在下午4:30以后才允许导出
        $hours = @intval(date('Gi', time())); //小时分钟
        require_once __SITEROOT . "/library/custom/pager.php";
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        require_once __SITEROOT . '/library/custom/comm_function.php';
        //按下次随访日期搜索，默认情况下列出下次随访日期是今天的所有人员
        $search = array();
        $time = time();
        $excel_name = $this->_request->getParam('excel_name') ? $this->_request->
            getParam('excel_name') : "家庭档案";
        $search['org_id'] = $this->_request->getParam('region_p_id'); //地区
        $search['status_flag'] = $this->_request->getParam('status_flag'); //档案状态
        $search['status_flag'] = $search['status_flag'] ? $search['status_flag'] : 1; //默认为正常档案 2012-10-25 我好笨
        $individual_core_region_path_domain = get_region_path(1, $search['org_id']);
        $is_excel = $this->_request->getParam('excel');
        $title = "";
        $per_mount = 10000; //每个文件存储的数据量
        $current_status_flag = $search['status_flag']; //默认为正常档案，2012-10-25 我好笨
        if ($is_excel != "do")
        {
            //档案状态
            $status_flagArray = array(
                '' => array('0', '请选择'),
                '1' => array('1', '正常档案'),
                '4' => array('2', '临时档案'),
                '6' => array('3', '死亡档案'),
                '8' => array('4', '转出档案'));
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
            $this->view->excel_name = urldecode($excel_name);
            $this->view->search = $search;
            $this->view->per_mount = $per_mount;
            $this->view->assign('region_id', $this->user['region_id']);
            $this->view->assign('region_p_id', $this->user['region_id']);
            $this->view->assign('hours', $hours);
            $this->view->display('iha_import_family.html');
        }
        else
        {
            //定义临时变量current存储是当前分卷数
            $current = $this->_request->getParam('current') ? $this->_request->getParam('current') : 0;
            $total_files=$this->_request->getParam('total') ? $this->_request->getParam('total') : 0;//总分卷数
            if ($hours >= 900 && $hours <= 1630)
            {
                exit("请09:00之前，16:30之后使用导出数据功能");
            }
            $core = new Tindividual_core();
            //个人档案附加表，为实现高级搜索
            $individual_archive = new Tindividual_archive();
            $core->whereAdd("individual_core.relation_holder='1'");
            //增加档案状态，2012-10-25 我好笨
            if ($current_status_flag != 0)
            {
                $core->whereAdd("individual_core.status_flag=$current_status_flag");
            }
            $core->joinAdd('left', $core, $individual_archive, 'uuid', 'id');
            $core->whereAdd($individual_core_region_path_domain);
            //当分卷数为1时才获取总分卷数,否则取页面传递值，避免每次都取数据库
            if ($current == 0)
            {
                $total_files=ceil($core->count()/$per_mount);
            }
            $core->limit($current*$per_mount,$per_mount);
            $core->orderby("individual_core.family_number DESC,individual_core.region_path DESC,individual_core.updated DESC");
            $core->find();
            //导出数据到浏览器，然后输出总共导出多少条数据
            /** PHPExcel */
            require_once __SITEROOT . 'library/phpexcel/Classes/PHPExcel.php';
            // Create new PHPExcel object
            $title .= urldecode($excel_name);
            //如果有分卷，给文件添加分卷数
            if($total_files)
            {
                $title.= "-分卷".($current+1)."-共".$total_files.'卷';
            }
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("我好笨")->setLastModifiedBy("我好笨")->
                setTitle($title)->setSubject($title)->setDescription($title)->setKeywords("office 2007 openxml php")->
                setCategory($title);
            //电子表格的序号
            $excel_order = array(
                "A",
                "B",
                "C",
                "D",
                "E",
                "F",
                "G",
                "H",
                "I",
                "J",
                "K",
                "L",
                "M",
                "N",
                "O",
                "P",
                "Q",
                "R",
                "S",
                "T",
                "U",
                "V",
                "W",
                "X",
                "Y",
                "Z",
                "AA",
                "BB",
                "CC");
            // 填写标题
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($excel_order[0] . '1', '户主姓名')->
                setCellValue($excel_order[1] . '1', '性别')->setCellValue($excel_order[2] . '1',
                '年龄')->setCellValue($excel_order[3] . '1', '身份证号')->setCellValue($excel_order[4] .
                '1', '民族')->setCellValue($excel_order[5] . '1', '家庭档案号')->setCellValue($excel_order[6] .
                '1', '家庭成员')->setCellValue($excel_order[7] . '1', '家庭地址')->setCellValue($excel_order[8] .
                '1', '户籍地址')->setCellValue($excel_order[9] . '1', '本人电话')->setCellValue($excel_order[10] .
                '1', '联系人姓名')->setCellValue($excel_order[11] . '1', '联系人电话')->setCellValue($excel_order[12] .
                '1', '创建日期');
            //设置单元格格式
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[0])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[1])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[2])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[3])->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[4])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[5])->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[6])->setWidth(60);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[7])->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[8])->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[9])->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[10])->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[11])->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[12])->setWidth(20);
            $i = 2;
            while ($core->fetch())
            {
                $name = $core->name;
                $filing_time = $core->filing_time ? adodb_date("Y-m-d", $core->filing_time) : "";
                //处理性别
                $sexs = @$sex[array_search_for_other($core->sex, $sex)][1];
                //处理民族
                $races = @$race[array_search_for_other($core->race, $race)][1];
                
                $unit_name = $individual_archive->unit_name;
                $contact = $individual_archive->contact;
                $contact_number = $individual_archive->contact_number;
                $address = $core->address;
                $residence_address = $core->residence_address;
                $age = getBirthday($core->date_of_birth, time());
                
                $identity_number = $core->identity_number;
                $phone_number = $core->phone_number;
                //取家庭成员
    			$string='';
   				$temp_individual=new Tindividual_core();
   				$temp_individual->whereAdd("family_number='".$core->family_number."'");
   				$temp_individual->whereAdd("uuid!='".$core->uuid."'");
   				$temp_individual->find();
   				$temp_individual->orderby('standard_code_2');
   				while ($temp_individual->fetch())
                {
  					$string=$string.$temp_individual->name."、";
   				}
    			$string=$string==''?'无':rtrim($string,'、');
                $family_number=substr($core->standard_code_2,0,22);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($excel_order[0] . $i, $name)->
                    setCellValue($excel_order[1] . $i, $sexs)->setCellValue($excel_order[2] . $i, $age)->
                    setCellValue($excel_order[3] . $i, $identity_number . " ")->setCellValue($excel_order[4] .
                    $i, $races)->setCellValue($excel_order[5] . $i, $family_number)->setCellValue($excel_order[6] .
                    $i, $string)->setCellValue($excel_order[7] . $i, $address)->setCellValue($excel_order[8] .
                    $i, $residence_address)->setCellValue($excel_order[9] . $i, $phone_number)->
                    setCellValue($excel_order[10] . $i, $contact)->setCellValue($excel_order[11] . $i,
                    $contact_number)->setCellValue($excel_order[14] . $i, $filing_time);
                $i++;
            }
            $core->free_statement();
            // Rename sheet

            $objPHPExcel->getActiveSheet()->setTitle($title);
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
            // Redirect output to a client’s web browser (Excel5)
            //header('Content-Type: application/vnd.ms-excel');
            //header('Content-Disposition: attachment;filename="' . iconv('utf-8', 'gb2312', $title) . '.xls"');
            //header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            if(!file_exists(__SITEROOT.'cache/family_'.$this->user['region_id']))
            {
                mkdir(__SITEROOT.'cache/family_'.$this->user['region_id'],0777);
            }
            $objWriter->save(__SITEROOT.'cache/family_'.$this->user['region_id'].'/'.iconv('utf-8', 'gb2312', $title).'.xls');
            if($current<$total_files-1)
            {
                //页面跳转
                //生成跳转地址
                $url=__BASEPATH . 'iha/family/import/excel/do';
                foreach($search as $k=>$v)
                {
                    if($k=='org_id')
                    {
                        $url.='/region_p_id/'.$v;
                    }
                    else
                    {
                        $url.='/'.$k.'/'.$v;
                    }
                }
                $url.='/current/'.($current+1).'/total/'.$total_files;
                if($current==$total_files-2)
                {
                    message('文件导出完成，正在打包发送到浏览器，稍后将弹出文件下载对话框，文件保存完毕后，请手动离开本页面。', array(''=>$url) ,$url);
                }
                else
                {
                    message('分卷'.($current+1).'导出成功，稍后将导出分卷'.($current+2).'，共有分卷'.$total_files.'，每卷导出'.$per_mount.'条数据，<span style="color:red;font-size:18px">如果您对操作流程不熟悉，请不要点击任何连接，让浏览器自动跳转直到弹出下载文件框为止。</span>', array('快速导出下一个分卷'=>$url) ,$url);
                }
            }
            else
            {
                require_once __SITEROOT.'library/custom/zip.class.php';
                $zipfile=new zipfile();
                if($handle = opendir(__SITEROOT.'cache/family_'.$this->user['region_id']))
                {
                    while (false !== ($file = readdir($handle)))
                    {
                        if($file!='.' && $file!="..")
                        {
                            $zipfile->addFilePath(__SITEROOT.'cache/family_'.$this->user['region_id'].'/'.$file,$file);
                            @unlink(__SITEROOT.'cache/family_'.$this->user['region_id'].'/'.$file);
                        }
                    }
                }
                @rmdir(__SITEROOT.'cache/family_'.$this->user['region_id']);
                @header('Content-Encoding: none');
                @header('Content-Type: application/zip');
                @header('Content-Disposition: attachment ; filename='.iconv('utf-8', 'gb2312', urldecode($excel_name)).'.zip');
                @header('Pragma: no-cache');
                @header('Expires: 0');
                print($zipfile->file());
            }
            exit;
        }
    }
}
?>