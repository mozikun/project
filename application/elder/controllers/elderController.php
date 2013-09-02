<?php
/**
*@author：ct
*@filename: indexController.php
*@package：只查找个人档案中大于等于65岁的人员(即为老年人)
*@create：2010-10-21
*/
class elder_elderController extends controller
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
		require_once __SITEROOT.'/library/Models/et_lifecase_assessment.php';
		require_once __SITEROOT.'/library/Models/clinical_history.php';
		require_once(__SITEROOT.'library/MyAuth.php');
		$this->view->assign("baseUrl",__BASEPATH);
		$this->view->assign( "basePath", __BASEPATH );
		require_once __SITEROOT.'/library/custom/comm_function.php';
		//region_array.php
		//print_r($this->identity);
	}
	/**
	 * 个人档案列表
	 */
	public function indexAction()
	{   
		$currentTime = time();
		//set_time_limit(0);
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		//只查找65岁和65岁以上的人员
		$yearNumber = 65;
		$tagNumber  = adodb_mktime(0,0,0,adodb_date("n",$currentTime),adodb_date("j",$currentTime),adodb_date("Y",$currentTime)-$yearNumber);
		$region_path_array=explode(",",$this->user['current_region_path'],5);
		//取到市级path
		$region_path_comment=$region_path_array['0'].",".$region_path_array['1'].",".$region_path_array['2'].",".$region_path_array['3'];
		//取完整率注释
		$standard_archive_rate=new Tstandard_archive_rate();
		//取本模块的所有必填字段数组
		$standard_archive_rate->whereAdd("region_path='$region_path_comment'");
		$standard_archive_rate->whereAdd("module_name = 'individual_core'");//个人档案模块
		$standard_archive_rate->whereAdd("criteria='1'");
		$nums_rate=$standard_archive_rate->count();//所有字段
		$standard_archive_rate->find();
		$comment=array();
		$i=0;
		while ($standard_archive_rate->fetch())
		{
			$comment[$i]['table_zh_name']=$standard_archive_rate->table_zh_name;
			$comment[$i]['column_zh_name']=$standard_archive_rate->column_zh_name;
			$i++;
		}
		$this->view->assign("comment",$comment);
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
		$org_region_domain=$this->user['current_region_path_domain'];
		$temp=explode("|",$org_region_domain);
		$individual_core_region_path_domain='';
		$staff_core_region_path_domain='';
		foreach ($temp as $k1=>$v1){
			$temp1=explode(",",$this->user['current_region_path']);
			if(count($temp1)<=4){
				$individual_core_region_path_domain=$individual_core_region_path_domain."INSTR(individual_core.region_path,'".$v1."')>0 or ";
				$staff_core_region_path_domain=$staff_core_region_path_domain."INSTR(staff_core.region_path,'".$v1."')>0 or ";
			}else{
				$individual_core_region_path_domain=$individual_core_region_path_domain."individual_core.region_path like '".$v1."%' or ";
				$staff_core_region_path_domain=$staff_core_region_path_domain."staff_core.region_path like '".$v1."%' or ";
			}
		}
		$individual_core_region_path_domain=rtrim($individual_core_region_path_domain,' or ');
		$staff_core_region_path_domain=rtrim($staff_core_region_path_domain,' or ');
		$temp_org_id=$this->user['org_id'];
		if(!empty($staff_core_region_path_domain)){
			$staff_core_region_path_domain=$staff_core_region_path_domain." or staff_core.org_id='$temp_org_id'";
		}else{
			$staff_core_region_path_domain=$staff_core_region_path_domain." staff_core.org_id='$temp_org_id'";
		}
		
		//医生列表
		$staff_core=new Tstaff_core();
		$staff_archive=new Tstaff_archive();
		$org=new Torganization();
		//$org->whereAdd("org.id='$org'");
		//var_dump($this->user);
		$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
		$staff_core->joinAdd('inner',$staff_core,$org,'org_id','id');
		$staff_core->whereAdd($staff_core_region_path_domain);
		//$staff_core->whereAdd($staff_core_region_path_domain);
//		$staff_core->debugLevel(9);
		$staff_core->find();
		$responseDoctorArray=array();
		$responseDoctorArray[0]['zh_name']='请选择';
		$responseDoctorArray[0]['id']='-9';
		$counter=1;
		while ($staff_core->fetch()) {
			//生成负责医生下拉框
			$responseDoctorArray[$counter]['zh_name']=$org->zh_name.':'.$staff_archive->name_real;
			//$responseDoctorArray[$counter]['zh_name']=$staff_archive->name_real;
			$responseDoctorArray[$counter]['id']=$staff_core->id;
			$responseDoctorArray[$counter]['selected']='';
			$counter++;
		}
		$this->view->response_doctor=$responseDoctorArray;

		//医生列表结束

		$search=array();
		$core=new Tindividual_core();
		$core->whereAdd($individual_core_region_path_domain);
		//不能去掉
		$core->whereAdd("individual_core.updated>'0'");
		$core->whereAdd("individual_core.date_of_birth<='$tagNumber'");
		$core->whereAdd("individual_core.status_flag='1'");
		$nums=$core->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'elder/elder/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$core->selectAdd("
		individual_core.uuid as uuid,
		individual_core.name as name,
		individual_core.sex as sex,
		individual_core.family_number as family_number,
		individual_core.address as address,
		individual_core.staff_id as staff_id,
		individual_core.standard_code_1 as standard_code_1,
		individual_core.phone_number as phone_number,
		individual_core.date_of_birth as date_of_birth,
		individual_core.criteria_rate as criteria_rate
		");		
        $core->whereAdd("individual_core.date_of_birth<='$tagNumber'");
		$core->orderby("individual_core.updated DESC");
		//处理分页
		$core->limit($startnum,__ROWSOFPAGE);
//		$core->debugLevel(9);
		$core->find();
		$indiv=array();
		$i=0;
		while ($core->fetch()){
			$indiv[$i]['uuid']=$core->uuid;
			if($this->haveWritePrivilege){
				$indiv[$i]['name']=$core->name;
				$indiv[$i]['householder_name']=get_househoder_name($core->family_number);
				$indiv[$i]['contact_number']=$core->phone_number;
			}else{
				$indiv[$i]['name']=$this->mask_char;
				$indiv[$i]['householder_name']=$this->mask_char;
				$indiv[$i]['contact_number']=$this->mask_char;
			}
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
		//
	    if($individual_session->uuid){
			 $loneurl = '<a href="'.__BASEPATH.'elder/elder/index/currentid/'.$individual_session->uuid.'">[查看当前用户]</a>';
			 $allurl  =	'<a href="'.__BASEPATH.'elder/elder/index">[查看所有用户]</a>';
			 $this->view->loneurl = $loneurl;
			 $this->view->allurl  = $allurl;
			}
		 $currentuser = $this->_request->getParam('currentid');
	         if($currentuser){
			 	$ihacore = new Tindividual_core();
			 	$ihacore->whereAdd("uuid='$individual_session->uuid'");
			 	$ihacore->whereAdd("status_flag!='1'");
			 	$ihacore->find(true);
			 	if($ihacore->date_of_birth>$tagNumber){
			 		echo '<script type="text/javascript">window.alert("当前用户年龄小于65岁,禁止访问 ");history.go(-1);</script>';
			 	}else{
			 		 $this->view->criteria_rate = ($ihacore->criteria_rate)*100;
			 		 $this->view->standard_code = $ihacore->standard_code_1;
			 		 $this->view->name          = $ihacore->name;
			 		 $this->view->sex           = $ihacore->sex;
			 		 $this->view->address       = $ihacore->address;
			 		 $this->view->date_of_birth = adodb_date("Y-m-d",$ihacore->date_of_birth);
			 		 $this->view->age           = getBirthday($ihacore->date_of_birth,time());
			 		 $this->view->phone_number  = $ihacore->phone_number;
			 		 $this->view->householder_name  = $ihacore->householder_name;
			 		 //查找医生
			 		 $staffcore  = new Tstaff_core();
			 		 $staffcore->whereAdd("id='$ihacore->staff_id'");
			 		 $staffcore->find(true);
			 		 $this->view->currentdoctor = $staffcore->name_login;
			 	}
			  }
			  $this->view->currentuser  = $currentuser;
	    $currentuser      = $this->_request->getParam('currentid');
	    $currentsessionid = $individual_session->uuid;
	    $this->view->currentsessionid = $currentsessionid;
		$this->view->display("list.html");
	}
	public function listAction()
	{
		//global $s;
		//set_time_limit(0);
	   
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once(__SITEROOT.'library/custom/region_array.php');
		$time=time();
		//只查找65岁以上的人员
		$yearNumber = 65;
		$tagNumber  = adodb_mktime(0,0,0,adodb_date("n",$time),adodb_date("j",$time),adodb_date("Y",$time)-$yearNumber);
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
						$search_string="individual_core.date_of_birth<=$tagNumber";//因为是多条件，所以多个条件间是或者的关系
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
					$core->whereAdd("individual_core.date_of_birth<='$tagNumber'");
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
			$core->joinAdd('inner',$core,$individual_archive,'uuid','id');
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
		$core->whereAdd("individual_core.updated>'0'");
		$core->whereAdd("individual_core.status_flag='1'");
		$nums=$core->count();
		//echo $nums;
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'elder/elder/list/page/',2,array());
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
		individual_core.standard_code_1 as standard_code_1,
		individual_core.phone_number as phone_number,
		individual_core.date_of_birth as date_of_birth,
		individual_core.criteria_rate as criteria_rate
		");

		$core->find();
		//exit();
		$indiv=array();
		$i=0;
		while ($core->fetch()){
			$indiv[$i]['uuid']=$core->uuid;
			if($this->haveWritePrivilege){
				$indiv[$i]['name']=$core->name;
				$indiv[$i]['householder_name']=get_househoder_name($core->family_number);
				$indiv[$i]['contact_number']=$core->phone_number;
			}else{
				$indiv[$i]['name']=$this->mask_char;
				$indiv[$i]['householder_name']=$this->mask_char;
				$indiv[$i]['contact_number']=$this->mask_char;
			}
			$indiv[$i]['address']=$core->address;
			$indiv[$i]['staff_id']=$core->staff_id;
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
	 * 用于设置session
	 */
	public function setsessionAction()
	{
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$uuid=$this->_request->getParam('uuid');
		if ($uuid)
		{
			$core=new Tindividual_core();
			$core->whereAdd("uuid='$uuid'");
			$core->find(true);
			if ($core->standard_code_1)
			{
				$individual_session=new Zend_Session_Namespace("individual_core");
				$individual_session->uuid=$uuid;//设置个人UUID
				$individual_session->standard_code=$core->standard_code;//设置手工标准档案号
				$individual_session->standard_code_1=$core->standard_code_1;//设置国家标准档案号
				$individual_session->standard_code_2=$core->standard_code_2;//设置省标准档案号
				$individual_session->name=$core->name;//设置姓名
				$individual_session->sex=$core->sex;//设置性别
				$individual_session->age=getBirthday($core->date_of_birth,time());;//设置年龄
				$individual_session->date_of_birth=$core->date_of_birth;//设置生日
				$individual_session->address=$core->address;//设置现在住址
				$individual_session->residence_address=$core->residence_address;//设置户籍地址
				$individual_session->phone_number=$core->phone_number;//设置本人联系电话
				$individual_session->staff_id=$core->staff_id;//设置建档医生
				$individual_session->response_doctor=$core->response_doctor;//责任医生
				$individual_session->filing_time=$core->filing_time;//设置建档时间
				$individual_session->status_flag=$core->status_flag;//档案状态
				echo "ok";
				exit;
			}
			else
			{
				echo "error_no_person";
				exit;
			}
		}
		else
		{
			echo "error_uuid_no_null";
			exit;
		}
	}
	/*
	 * 老年人生活自理能力评估
	 */
	/**
	 * 
	 * 添加、修改页面
	 */
	public function addAction()
	{
		$uuid=$this->_request->getParam('uuid');
		$editid=$this->_request->getParam('editid');//获取从体检表传过来的个人档案号 或者从表单提交上来的个人档案号
		$individual_session=new Zend_Session_Namespace("individual_core");
		$serial_number=$individual_session->uuid;//个人档案号
		if(empty($uuid) && empty($editid))
		{
			if(empty($individual_session->uuid) || empty($individual_session->staff_id))
			{
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			$lifecase_id=uniqid('et',true);//档案编号
			if ($individual_session->age < 65)
			{
				message("请先选择老年人(年龄>65岁)才能添加老年人生活自理能力评估",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));;
			}
		}
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$time = time();//系统日期
		if(empty($uuid))
		{
			//判断添加从体检表传递过来居民的评估表，还是添加状态栏选中居民的评估表
			if(empty($editid))
			{
				//获取姓名身份证号
				$individual=new Tindividual_core();
				$individual->whereAdd("uuid='$individual_session->uuid'");
				$individual->find(true);
				$this->view->identity_name=$individual->name;
				$this->view->identity_number=$individual->identity_number;
				$mytag = true;
				
				if(!empty($_POST['submit']))
				{
					$lifecase = new Tet_lifecase_assessment();
					$lifecase->uuid = $lifecase_id;//编号
					$lifecase->id = $serial_number;//个人档案号
					$lifecase->meal = $this->_request->getParam('meal1');//进餐得分
					$lifecase->cleanup = $this->_request->getParam('meal2');//梳洗得分
					$lifecase->dress = $this->_request->getParam('meal3');//穿衣得分
					$lifecase->toilet = $this->_request->getParam('meal4');//如厕得分
					$lifecase->activity = $this->_request->getParam('meal5');//活动得分
					$lifecase->totalscore = $this->_request->getParam('sum');//总分
					$addtime=strtotime($this->_request->getParam('time'));
					$lifecase->created = empty($addtime)?$time:$addtime;//时间
					if ($lifecase->insert())
					{
						//添加成功
						$uuid=empty($uuid)?$lifecase_id:$uuid;
						message("添加成功！",array("评估列表"=>__BASEPATH.'elder/elder/scorelist',"继续修改"=>__BASEPATH."elder/elder/add/uuid/{$uuid}"));
					}
				}
			}else 
			{
				//获取姓名身份证号
				$individual=new Tindividual_core();
				$individual->whereAdd("uuid='$editid'");
				$individual->find(true);
				$this->view->identity_name=$individual->name;
				$this->view->identity_number=$individual->identity_number;
				$mytag = false;
				$this->view->assign("id",$editid);

				if(!empty($_POST['submit']))
				{
					$lifecase = new Tet_lifecase_assessment();
					$lifecase_id=uniqid('et',true);//档案编号
					$lifecase->uuid = $lifecase_id;//编号
					$lifecase->id = $this->_request->getParam('editid');//个人档案号	
					$lifecase->meal = $this->_request->getParam('meal1');//进餐得分
					$lifecase->cleanup = $this->_request->getParam('meal2');//梳洗得分
					$lifecase->dress = $this->_request->getParam('meal3');//穿衣得分
					$lifecase->toilet = $this->_request->getParam('meal4');//如厕得分
					$lifecase->activity = $this->_request->getParam('meal5');//活动得分
					$lifecase->totalscore = $this->_request->getParam('sum');//总分
					$addtime=strtotime($this->_request->getParam('time'));
					$lifecase->created = empty($addtime)?$time:$addtime;//时间
					if ($lifecase->insert())
					{
						//添加成功
						$uuid=empty($uuid)?$lifecase_id:$uuid;
						message("添加成功！",array("评估列表"=>__BASEPATH.'elder/elder/scorelist',"继续修改"=>__BASEPATH."elder/elder/add/uuid/{$uuid}"));
					}
				}
			}	
	   }
	   else 
	   {
	   		$mytag = false;
	   		//获取姓名身份证号
	     	$individual=new Tindividual_core();
	     	$lifecase=new Tet_lifecase_assessment();
	     	$individual->joinAdd('left',$individual,$lifecase,'uuid','id');
			$individual->whereAdd("et_lifecase_assessment.uuid='$uuid'");
			$individual->find(true);
			$this->view->identity_name=$individual->name;
			$this->view->identity_number=$individual->identity_number;
			
	   		$lifecase_get = new Tet_lifecase_assessment();
			$lifecase_get->whereAdd("uuid='{$uuid}'");
			$lifecase_get->find(true);
			$this->view->uuid=$lifecase_get->uuid;
			$this->view->meal = $lifecase_get->meal;
			$this->view->cleanup = $lifecase_get->cleanup;
			$this->view->dress = $lifecase_get->dress;
			$this->view->toilet = $lifecase_get->toilet;
			$this->view->activity = $lifecase_get->activity;
			$this->view->totalscore = $lifecase_get->totalscore;
			$this->view->created=date("Y-m-d",$lifecase_get->created);
			
			if (!empty($_POST['submit']))
			{
				$lifecase = new Tet_lifecase_assessment();
				$lifecase->uuid = $uuid;//编号
//				$lifecase->id = $serial_number;//个人档案号
				$lifecase->meal = $this->_request->getParam('meal1');//进餐得分
				$lifecase->cleanup = $this->_request->getParam('meal2');//梳洗得分
				$lifecase->dress = $this->_request->getParam('meal3');//穿衣得分
				$lifecase->toilet = $this->_request->getParam('meal4');//如厕得分
				$lifecase->activity = $this->_request->getParam('meal5');//活动得分
				$lifecase->totalscore = $this->_request->getParam('sum');//总分
				$addtime=strtotime($this->_request->getParam('time'));
				$lifecase->created = empty($addtime)?$time:$addtime;//时间
		 	    $lifecase->whereAdd("uuid='{$uuid}'");
//		 	    $lifecase->debugLevel(9);
				if ($lifecase->update())
				{
					//修改成功
					$uuid=empty($uuid)?$lifecase_id:$uuid;
					message("修改成功！",array("评估列表"=>__BASEPATH.'elder/elder/scorelist',"继续修改"=>__BASEPATH."elder/elder/add/uuid/{$uuid}"));
				}
			}
	   }
	   $this->view->mytag=$mytag;
	   $this->view->display("edit.html");
	} 
	
	/*
	 * 删除
	 */
	public function delAction(){
		if(!$this->haveWritePrivilege){
			$url=array("健康体检表列表"=>__BASEPATH.'elder/elder/scorelist',"用户列表"=>__BASEPATH.'iha/index/index');
			message("对不起，你可能没有权限删除本信息，错误代码：et010",$url);
		}
		$actionname = $this->_request->getParam('actionname');
		$uuid = trim($this->_request->getParam('uuid'));
		$pageCurrent = $page?$page:1;
		switch ($actionname){
			//处理删除单条记录
			case "dellone":
				if ($uuid){
				$lifecase = new Tet_lifecase_assessment();
				$lifecase->whereAdd("uuid='{$uuid}'");
				$lifecase->delete();
				$url=__BASEPATH."elder/elder/scorelist/page/".$pageCurrent;
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
				}else {
					foreach($selectFlag as $k=>$v){
						$lifecase = new Tet_lifecase_assessment();
						$lifecase->whereAdd("uuid='{$v}'");
						$lifecase->delete();
						$this->redirect(__BASEPATH."elder/elder/scorelist");
					}
				}	
		}
		
	}
	/*
	 * 老年人生活自理能力评估列表
	 */
	function scorelistAction(){
		
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		//获取参数
		$arrArg = array();
		$arrArg['realname']     = urlencode(trim($this->_request->getParam('realname')));//体检人名称
		$arrArg['identitynumber'] = trim($this->_request->getParam('identitynumber'));//身份证号
		$arrArg['display'] = $this->_request->getParam('display');//显示状态
		$arrArg['score'] = trim($this->_request->getParam('score'));//评估分数
		$arrArg['region_p_id'] = $this->_request->getParam('region_p_id');//机构id
		$arrArg['created_start_time'] = $this->_request->getParam('created_start_time');//开始时间
		$arrArg['created_end_time'] = $this->_request->getParam('created_end_time');//结束时间
		$individual_core_region_path_domain = get_region_path(1, $arrArg['region_p_id']);
		$realNewName   = urldecode($arrArg['realname']);//编码中文
		
		$current_path = $this->user['current_region_path_domain'];
		$current_path_arr = explode('|',$current_path);	
			
				
		$lifecase = new Tet_lifecase_assessment();
		$individual = new Tindividual_core();
		$lifecase->joinAdd('left',$lifecase,$individual,'id','uuid');//关联个人信息
		$individual_session=new Zend_Session_Namespace("individual_core");
		$id = $individual_session->uuid;	
		//开始时间查询
		if($arrArg['created_start_time']!=''){
			$created_start_time=strtotime($arrArg['created_start_time']);
			$lifecase->whereAdd("et_lifecase_assessment.created>={$created_start_time}");
		}		
		//结束时间查询
		if($arrArg['created_end_time']!=''){
			$created_end_time=strtotime($arrArg['created_end_time']);
			$lifecase->whereAdd("et_lifecase_assessment.created<={$created_end_time}");
		}		
		$lifecase->whereAdd($individual_core_region_path_domain);
		if (!empty($realNewName)){
			$lifecase->whereAdd("individual_core.name='$realNewName'");
		}
		if(!empty($arrArg['identitynumber'])){
			$identitynumber=$arrArg['identitynumber'];
			$lifecase->whereAdd("individual_core.identity_number='$identitynumber'");
		}
		if (!empty($arrArg['score'])){
			$score=$arrArg['score'];
			$lifecase->whereAdd("et_lifecase_assessment.totalscore='$score'");
		}

		//处理分页
		//$lifecase->debugLevel(2);
		$nuNumber = $lifecase->count();
//    	if (!empty($realNewName)){
//			$lifecase->whereAdd("individual_core.name='$realNewName'");
//		}
//		
//		if(!empty($arrArg['serialnumber'])){
//			$serialnumber=$arrArg['serialnumber'];
//			$lifecase->whereAdd("individual_core.standard_code_1='$serialnumber'");
//		}
//		if (!empty($arrArg['score'])){
//			$score=$arrArg['score'];
//			$lifecase->whereAdd("et_lifecase_assessment.totalscore='$score'");
//		}	
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'elder/elder/scorelist/page/',3,$arrArg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
        $lifecase->limit($startnum,__ROWSOFPAGE);				
		$lifecase->find();
//			$lifecaseNew->debugLevel(9);
		$scoreList=array();
		$i=0;
		if($nuNumber>0)
		{	
			while ($lifecase->fetch())
			{
				$scoreList[$i]['uuid'] = $lifecase->uuid;
				$scoreList[$i]['id'] = $lifecase->id;
				$scoreList[$i]['name'] = $individual->name;
				$scoreList[$i]['created'] = date("Y-m-d",$lifecase->created);			
				if(!$this->haveWritePrivilege){
						$scoreList[$i]['name']     = '*';
					}else{
						$scoreList[$i]['name']     = $individual->name;
					}
				//$scoreList[$i]['sex'] = $sex[array_search_for_other($individual->sex,$sex)][1];
				$scoreList[$i]['address']=$individual->address;
				$scoreList[$i]['age'] = getBirthday($individual->date_of_birth,time());
				$temp ='';
				$temp1 = '';
				$temp2 = '';
				$temp = get_status_cd($individual->uuid,2);
				$temp1 = get_status_cd($individual->uuid,3);
				$temp2 = get_status_cd($individual->uuid,8);
				$scoreList[$i]['gxy'] = $temp->id?$temp->id:0;
				$scoreList[$i]['tnb'] = $temp1->id?$temp1->id:0;
				$scoreList[$i]['jsb'] = $temp2->id?$temp2->id:0;
				$scoreList[$i]['identitynumber'] = $individual->identity_number;
				$scoreList[$i]['totalscore'] = $lifecase->totalscore;
				$i++;	
			}
			$this->view->scoreList = $scoreList;
		}
		else
		{
			//var_dump($_POST);
			$str = '<tr><td colspan="10" align="center">当前暂时没有任何数据！</td></tr>';
			$this->view->str = $str;
		}
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->pageCurrent = $pageCurrent;
		$this->view->assign( "basepath", __BASEPATH );
		$this->view->assign('region_id', $this->user['region_id']);//地区
		if($arrArg['region_p_id']!=''){
        	$this->view->assign('region_p_id', $arrArg['region_p_id']);//地区
		}else{
			$this->view->assign('region_p_id', $this->user['region_id']);//地区
		}
	
        if($arrArg['created_start_time']!=''){
        	$starttime=$arrArg['created_start_time'];
        	$this->view->assign('created_start_time', $starttime);//时间段开始
        }
        if($arrArg['created_end_time']!=''){
        	$endtime=$arrArg['created_end_time'];
        	$this->view->assign('created_end_time',$endtime);//时间段结束
        }
        $this->view->assign("display",$arrArg['display']);
		$this->view->display("scorelist.html");
	}
	/**
     * @todo 用于测试慢病确诊函数
     */
    public function tAction()
    {
        require_once __SITEROOT.'/library/custom/comm_function.php';
        //机构ID
        $org_id=$this->user['org_id'];
		//获取医生ID
		$staff_id=$this->user['uuid'];
        //必须指定上面两个参数
        $individual_session=new Zend_Session_Namespace("individual_core");
		$uuid=$this->_request->getParam('uuid')?$this->_request->getParam('uuid'):$individual_session->uuid;
        diagnose_disease($uuid,3,time());
        
    }
    /**
     * 
     * @todo 用于打印老年人自理能力评估表
     */
    public function printAction()
    {
    	$uuid=$this->_request->getParam("uuid");
    	//获取姓名身份证号
    	if($uuid)
    	{
	     	$individual=new Tindividual_core();
	     	$lifecase=new Tet_lifecase_assessment();
	     	$individual->joinAdd('left',$individual,$lifecase,'uuid','id');
			$individual->whereAdd("et_lifecase_assessment.uuid='$uuid'");
			$individual->find(true);
			$this->view->identity_name=$individual->name;
			$this->view->identity_number=$individual->identity_number;
			
	   		$lifecase_get = new Tet_lifecase_assessment();
			$lifecase_get->whereAdd("uuid='{$uuid}'");
			$lifecase_get->find(true);
			$this->view->uuid=$lifecase_get->uuid;
			$this->view->meal = $lifecase_get->meal;
			$this->view->cleanup = $lifecase_get->cleanup;
			$this->view->dress = $lifecase_get->dress;
			$this->view->toilet = $lifecase_get->toilet;
			$this->view->activity = $lifecase_get->activity;
			$this->view->totalscore = $lifecase_get->totalscore;
			$this->view->created=date("Y-m-d",$lifecase_get->created);
    	}else 
    	{
    		$url=array("老年人生活能力评估列表"=> __BASEPATH . 'elder/elder/scorelist');
    		message("老年人生活能力评估表获取失败！",$url);
    	}
    	
    	$this->view->display("elder_print.html");
    }
}
?>