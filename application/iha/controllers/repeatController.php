<?php
/**
*@author：
*@filename: repeatController.php
*@create：2012-6-28
*/
class iha_repeatController extends controller
{
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/individual_core.php');
		require_once(__SITEROOT.'library/Models/individual_archive.php');
		require_once(__SITEROOT.'library/Models/family_archive.php');
		require_once(__SITEROOT.'library/Models/clinical_history.php');
		require_once(__SITEROOT.'library/Models/hypertension_follow_up.php');//高血压随访
		require_once(__SITEROOT.'library/Models/diabetes_core.php');//糖尿病随访
		require_once(__SITEROOT.'library/Models/diabetes_physical_sign.php');
		require_once(__SITEROOT.'library/Models/schizophrenia.php');//重型精神分裂随访
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/custom/comm_function.php');
		require_once(__SITEROOT.'library/Models/examination_table.php');//健康体检
		$this->view->assign("baseUrl",__BASEPATH);
		$this->view->assign( "basePath", __BASEPATH );
	}
	public function indexAction()
	{
		$where_1= '';
		$where_2= '';
		require_once (__SITEROOT. 'library/custom/pager.php');
		//		$sql="select *  from (select identity_number, count(identity_number) as nums  from individual_core  group by identity_number order by nums desc ) where nums > 1";//查询重复数据
		
		//    	$sql="SELECT IDENTITY_NUMBER,NAME  FROM individual_core  where IDENTITY_NUMBER in (SELECT IDENTITY_NUMBER FROM individual_core GROUP BY IDENTITY_NUMBER HAVING COUNT(*)>1) order by identity_number";//查询所有重复数据
		//		$sql2="SELECT count(*) as nums  FROM individual_core  where IDENTITY_NUMBER in (SELECT IDENTITY_NUMBER  FROM individual_core GROUP BY IDENTITY_NUMBER  HAVING COUNT(*)>1) ";//查询总记录数
        $current_region_path=$this->user['current_region_path'];//所属地区
        $identity_number = trim($this->_request->getParam('standard_code'));//身份证号
        $token=$this->_request->getParam("token");//所属地区标致
        if(!empty($identity_number))
        {
        	$where_1.="  and identity_number='$identity_number' ";
        	$where_2.=" where identity_number='$identity_number'";
        }
        if($token==1){
        	//管辖范围
        	$sql2="SELECT  count(*) as num  from (select *  from (select identity_number, count(identity_number) as nums  from individual_core where region_path like '$current_region_path%'".$where_1." group by identity_number order by nums desc )  where nums > 1)";//查询总记录数
        }else{
        	//所有数据
        	$sql2="SELECT  count(*) as num  from (select *  from (select identity_number, count(identity_number) as nums  from individual_core".$where_2." group by identity_number order by nums desc )  where nums > 1)";//查询总记录数
        }
        $individual_core2=new Tindividual_core();
		$individual_core2->query($sql2);
		//$individual_core1->debug(9);
		$individual_core2->fetch();
		$total=$individual_core2->num;

		$pageCurrent=intval($this->_request->getParam("page"));
		$pageCurrent=$pageCurrent?$pageCurrent:1;
		$search=array('standard_code'=>$identity_number);
		$pageofnumber=20;
		$links=new SubPages($pageofnumber,$total,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'iha/repeat/index/token/'.$token.'/page/',2,$search);
		$pageCurrent=$links->check_page($pageCurrent);
		$startnum=$pageofnumber*($pageCurrent-1)+1;//使用rownum时，查询返回值从第1行开始
		$endnum=$startnum+$pageofnumber;
		 if($token==1){
        	//管辖范围
			$sql="SELECT * FROM (select ROWNUM as r,identity_number,nums  from (select identity_number, count(identity_number) as nums  from individual_core  where region_path like '$current_region_path%'".$where_1." group by identity_number order by nums desc ) where nums > 1 )WHERE r>=".$startnum." AND r<".$endnum; //oracle中
		 }else{
			$sql="SELECT * FROM (select ROWNUM as r,identity_number,nums  from (select identity_number, count(identity_number) as nums  from individual_core".$where_2." group by identity_number order by nums desc ) where nums > 1 )WHERE r>=".$startnum." AND r<".$endnum; //oracle中
		 }
		$individual_core=new Tindividual_core();
		$individual_core->query($sql);

		$individual=array();
		$i=0;
		while($individual_core->fetch())
		{
			//            $individual[$i]['name']=$individual_core->name;
			$individual[$i]['identity_number']=$individual_core->identity_number;
			$individual[$i]['nums']=$individual_core->nums;

			$i++;
		}
		$this->view->assign("individual",$individual);
		$pager=$links->subPageCss2();
		$this->view->assign("pager",$pager);
		$this->view->assign("token",$token);
		
		$this->view->display("index.html");
	}
	public function listAction()
	{
		require_once (__SITEROOT . 'library/data_arr/arrdata.php');
		require_once (__SITEROOT. 'library/custom/pager.php');
		$identity_code=trim($this->_request->getParam('standard_code'));
        
		$current_region_path=$this->user['current_region_path'];//所属地区
        $token=$this->_request->getParam("token");//所属地区标致
		$uuid=$this->_request->getParam('uuid');
		$identity_code=$identity_code?$identity_code:$uuid;
		if($identity_code!="")
		{
			if($token!="")
			{
				//查询本地区内的重档数2013-6-8
				$individual_core=new Tindividual_core();
				$individual_core->whereAdd("identity_number='$identity_code'");
				$individual_core->whereAdd("region_path like '$current_region_path%'");
				$nums=$individual_core->count();
				$pageCurrent=intval($this->_request->getParam('page'));
				$pageCurrent=$pageCurrent?$pageCurrent:1;
				$search=array();
				//new subpages(每页显示条数，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
				$pageofnumber=20;
				$links=new SubPages($pageofnumber,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'iha/repeat/list/uuid/'.$identity_code.'/page/',2,$search);
				$pageCurrent=$links->check_page($pageCurrent);
				$startnum=$pageofnumber*($pageCurrent-1);
				$individual_core->limit($startnum,$pageofnumber);
				$individual_core->find();
				$individual=array();
				$i=0;
				while ($individual_core->fetch())
				{
					$number = 0;
					$individual[$i]['uuid']=$individual_core->uuid;
					$individual[$i]['identity_number']=$individual_core->identity_number;
					$individual[$i]['name']=$individual_core->name;
					$individual[$i]['sex']=@$sex[array_search_for_other($individual_core->sex,$sex)][1];
					$individual[$i]['created']=date("Y-m-d",$individual_core->created);
					$individual[$i]['householder_name']=get_househoder_name($individual_core->family_number);
					$individual[$i]['staff_name']=get_staff_name_byid($individual_core->staff_id);
					$individual[$i]['criteria_rate']=$individual_core->criteria_rate*100;
					$individual[$i]['address']=$individual_core->address;
					$individual[$i]['display']=strpos($individual_core->region_path,$this->user['current_region_path'])===false?0:1;//是否显示 mask 2012-11-15添加
	                //新增关联数据的查询条数
	                //糖尿病随访次数
	                $diabetes_core = new Tdiabetes_core();
	                $diabetes_core->whereAdd("id='$individual_core->uuid'");
	                $individual[$i]['diabetes_count']=$diabetes_core->count();
	                $number+=$diabetes_core->count();
	                $diabetes_core->free_statement();
	                //体检次数
	                $examina_table =  new Texamination_table();
	                $examina_table->whereAdd("id='$individual_core->uuid'");
	                $individual[$i]['examination_count']=$examina_table->count();
	                $number+=$examina_table->count();
	                $examina_table->free_statement();
	                //高血压随访次数
	                $hypertension_follow_up = new Thypertension_follow_up();
	                $hypertension_follow_up->whereAdd("id='$individual_core->uuid'");
	                $individual[$i]['hypertension_count']=$hypertension_follow_up->count();
	                $number+=$hypertension_follow_up->count();
	                $hypertension_follow_up->free_statement();
	                //重性精神分裂次数
	                $schizophrenia = new Tschizophrenia();
	                $schizophrenia->whereAdd("id='$individual_core->uuid'");
	                $individual[$i]['schizophrenia_count']=$schizophrenia->count();
	                $number+=$schizophrenia->count();
	                $schizophrenia->free_statement();
	                $individual[$i]['all_number']=$number;
					$i++;
				}
				$pager=$links->subPageCss2();
				$this->view->assign("pager",$pager);
				$this->view->assign("individual",$individual);
				$this->view->assign("uuid",$uuid);
				$this->view->assign("token",$token);
			}else 
			{
				//查询身份证重档数
				$individual_core=new Tindividual_core();
				$individual_core->whereAdd("identity_number='$identity_code'");;
				$nums=$individual_core->count();
				$pageCurrent=intval($this->_request->getParam("page"));
				$pageCurrent=$pageCurrent?$pageCurrent:1;
				$search=array();
				//new subpages(每页显示条数，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
				$pageofnumber=20;
				$links=new SubPages($pageofnumber,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'iha/repeat/list/uuid/'.$identity_code.'/page/',2,$search);
				$pageCurrent=$links->check_page($pageCurrent);
				$startnum=$pageofnumber*($pageCurrent-1);
				$individual_core->limit($startnum,$pageofnumber);
				//$individual_core->debugLevel(9);
				$individual_core->find();
				$individual=array();
				$i=0;
				while($individual_core->fetch())
				{
					$number = 0;
					$individual[$i]['uuid']=$individual_core->uuid;
					$individual[$i]['identity_number']=$individual_core->identity_number;
					$individual[$i]['name']=$individual_core->name;
					$individual[$i]['sex']=@$sex[array_search_for_other($individual_core->sex,$sex)][1];
					$individual[$i]['created']=date("Y-m-d",$individual_core->created);
					$individual[$i]['householder_name']=get_househoder_name($individual_core->family_number);
					$individual[$i]['staff_name']=get_staff_name_byid($individual_core->staff_id);
					$individual[$i]['criteria_rate']=$individual_core->criteria_rate*100;
					$individual[$i]['address']=$individual_core->address;
					$individual[$i]['display']=strpos($individual_core->region_path,$this->user['current_region_path'])===false?0:1;//是否显示 mask 2012-11-15添加
	                //新增关联数据的查询条数
	                //糖尿病随访次数
	                $diabetes_core = new Tdiabetes_core();
	                $diabetes_core->whereAdd("id='$individual_core->uuid'");
	                $individual[$i]['diabetes_count']=$diabetes_core->count();
	                $number+=$diabetes_core->count();
	                $diabetes_core->free_statement();
	                //体检次数
	                $examina_table =  new Texamination_table();
	                $examina_table->whereAdd("id='$individual_core->uuid'");
	                $individual[$i]['examination_count']=$examina_table->count();
	                $number+=$examina_table->count();
	                $examina_table->free_statement();
	                //高血压随访次数
	                $hypertension_follow_up = new Thypertension_follow_up();
	                $hypertension_follow_up->whereAdd("id='$individual_core->uuid'");
	                $individual[$i]['hypertension_count']=$hypertension_follow_up->count();
	                $number+=$hypertension_follow_up->count();
	                $hypertension_follow_up->free_statement();
	                //重性精神分裂次数
	                $schizophrenia = new Tschizophrenia();
	                $schizophrenia->whereAdd("id='$individual_core->uuid'");
	                $individual[$i]['schizophrenia_count']=$schizophrenia->count();
	                $number+=$schizophrenia->count();
	                $schizophrenia->free_statement();
	                $individual[$i]['all_number']=$number;
					$i++;
				}
				$pager=$links->subPageCss2();
				$this->view->assign("pager",$pager);
				$this->view->assign("individual",$individual);
				$this->view->assign("uuid",$uuid);
				$this->view->assign("token",$token);
			}
		}
		else 
		{
			//查询本机构和其他机构重复档案总数 然后分页
			$individual_core2=new Tindividual_core();
			$sql2="select count(*) as num from individual_core where region_path like '$current_region_path%' and identity_number in (select identity_number from (select identity_number,count(identity_number) as nums from INDIVIDUAL_CORE GROUP BY IDENTITY_NUMBER ORDER BY nums DESC) where nums>1) ORDER BY IDENTITY_NUMBER desc";
			$individual_core2->query($sql2);
			$individual_core2->fetch();
			$total=$individual_core2->num;
//			echo $total;
//			exit();
			$pageCurrent=intval($this->_request->getParam("page"));
			$pageCurrent=$pageCurrent?$pageCurrent:1;
			$search=array();
			$pageofnumber=20;
			$links=new SubPages($pageofnumber,$total,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'iha/repeat/list/page/',2,$search);
			$pageCurrent=$links->check_page($pageCurrent);
			$startnum=$pageofnumber*($pageCurrent-1)+1;//使用rownum时，查询返回值从第1行开始
			$endnum=$startnum+$pageofnumber;
			
			//查询本机构和其他机构重复的档案
			$individual_core=new Tindividual_core();
//			$sql="select * from individual_core where region_path like '$current_region_path%' and identity_number in (select identity_number from (select identity_number,count(identity_number) as nums from INDIVIDUAL_CORE GROUP BY IDENTITY_NUMBER ORDER BY nums DESC) where nums>1) ORDER BY IDENTITY_NUMBER desc";//没有分页的
//			$sql="select * from (select * from individual_core where region_path like '$current_region_path%' and identity_number in (select identity_number from (select identity_number,count(identity_number) as nums from INDIVIDUAL_CORE GROUP BY IDENTITY_NUMBER ORDER BY nums DESC) where nums>1) ORDER BY IDENTITY_NUMBER desc) where ROWNUM>=".$startnum." AND ROWNUM<".$endnum;//运行但不能分页
//			$sql="select * from (select * from (select * from individual_core where region_path like '$current_region_path%' and identity_number in (select identity_number from (select identity_number,count(identity_number) as nums from INDIVIDUAL_CORE GROUP BY IDENTITY_NUMBER ORDER BY nums DESC) where nums>1) ORDER BY IDENTITY_NUMBER desc) where ROWNUM<=".$endnum." ) where ROWNUM>=".$startnum;//运行但不能分页 不使用rownum别名 要大于等于1
//			$sql="select * from (select individual_core.*,ROWNUM as r from individual_core where region_path like '$current_region_path%' and identity_number in (select identity_number from (select identity_number,count(identity_number) as nums from INDIVIDUAL_CORE GROUP BY IDENTITY_NUMBER ORDER BY nums DESC) where nums>1) ORDER BY IDENTITY_NUMBER desc) where r>".$startnum." AND r<".$endnum;//运行但不能分页
			$sql="select * from (select * from (select individual_core.*,ROWNUM as r from individual_core where region_path like '$current_region_path%' and identity_number in (select identity_number from (select identity_number,count(identity_number) as nums from INDIVIDUAL_CORE GROUP BY IDENTITY_NUMBER ORDER BY nums DESC) where nums>1) ORDER BY IDENTITY_NUMBER desc) where r<=".$endnum.") where r>".$startnum;//运行能分页 使用rownum别名 只要大于1就可以
//			echo $sql;
			$individual_core->query($sql);
			$individual=array();
			$i=0;
			while($individual_core->fetch())
			{
				$number=0;
				$individual[$i]['uuid']=$individual_core->uuid;
				$individual[$i]['identity_number']=$individual_core->identity_number;
				$individual[$i]['name']=$individual_core->name;
				$individual[$i]['sex']=@$sex[array_search_for_other($individual_core->sex,$sex)][1];
				$individual[$i]['created']=date("Y-m-d",$individual_core->created);
				$individual[$i]['householder_name']=get_househoder_name($individual_core->family_number);
				$individual[$i]['staff_name']=get_staff_name_byid($individual_core->staff_id);
				$individual[$i]['criteria_rate']=$individual_core->criteria_rate*100;
				$individual[$i]['address']=$individual_core->address;
				$individual[$i]['display']=strpos($individual_core->region_path,$this->user['current_region_path'])===false?0:1;//是否显示 mask 2012-11-15添加
				//新增关联数据的查询条数
                //糖尿病随访次数
                $diabetes_core = new Tdiabetes_core();
                $diabetes_core->whereAdd("id='$individual_core->uuid'");
                $individual[$i]['diabetes_count']=$diabetes_core->count();
                $number+=$diabetes_core->count();
                $diabetes_core->free_statement();
                //体检次数
                $examina_table =  new Texamination_table();
                $examina_table->whereAdd("id='$individual_core->uuid'");
                $individual[$i]['examination_count']=$examina_table->count();
                $number+=$examina_table->count();
                $examina_table->free_statement();
                //高血压随访次数
                $hypertension_follow_up = new Thypertension_follow_up();
                $hypertension_follow_up->whereAdd("id='$individual_core->uuid'");
                $individual[$i]['hypertension_count']=$hypertension_follow_up->count();
                $number+=$hypertension_follow_up->count();
                $hypertension_follow_up->free_statement();
                //重性精神分裂次数
                $schizophrenia = new Tschizophrenia();
                $schizophrenia->whereAdd("id='$individual_core->uuid'");
                $individual[$i]['schizophrenia_count']=$schizophrenia->count();
                $number+=$schizophrenia->count();
                $schizophrenia->free_statement();
                $individual[$i]['all_number']=$number;
				$i++;
			}
			$this->view->assign("individual",$individual);
			$pager=$links->subPageCss2();
			$this->view->assign("pager",$pager);
		}
		
		$this->view->display("list.html");
	}

	public function delAction()
	{
		$uuid=$this->_request->getParam("uuid");
		$identity_code=$this->_request->getParam("standard_code");//获取身份证编号
		if($uuid)
		{
			//删除个人核心表信息
			$individual_core=new Tindividual_core();
			$individual_core->whereAdd("uuid='$uuid'");
			if($individual_core->delete())
			{
				//删除个人扩展表信息
				$individual_archive=new Tindividual_archive();
				$individual_archive->whereAdd("id='$uuid'");
				$individual_archive->delete();
				//删除家庭档案表信息
				$family_archive=new Tfamily_archive();
				$family_archive->whereAdd("householder_id='$uuid'");
				$family_archive->delete();
				//慢病史
				$clinical_history=new Tclinical_history();
				$clinical_history->whereAdd("id='$uuid'");
				$clinical_history->delete();
				//随访基础表
				$hypertension_follow_up=new Thypertension_follow_up();
				$hypertension_follow_up->whereAdd("id='$uuid'");
				$hypertension_follow_up->delete();
				//2型糖尿病主表
				$diabetes_core=new Tdiabetes_core();
				$diabetes_core->whereAdd("id='$uuid'");
				$diabetes_core->delete();
				//2型糖尿病 体征
				$diabetes_physical_sign=new Tdiabetes_physical_sign();
				$diabetes_physical_sign->whereAdd("id='$uuid'");
				$diabetes_physical_sign->delete();
				//重情精神疾病患者随访服务记录表
				$schizophrenia=new Tschizophrenia();
				$schizophrenia->whereAdd("id='$uuid'");
				$schizophrenia->delete();
			}
			if($identity_code)
			{
				$this->redirect(__BASEPATH.'iha/repeat/list/uuid/'.$identity_code);
			}
			else
			{
				$this->redirect(__BASEPATH.'iha/repeat/index');
			}
		}
		else
		{
			echo "参数错误！";
		}
	}
	public function delallAction()
	{
		$uuid_array=$this->_request->getParam('selectFlag');
		//删除个人档案和此人所有业务表
		$all_tables_array=array(
		'allergy',
		'blood_type',
		'certificate_premartial_exam',
		'charge_style','child_physical',
		'child_physical_age_three',
		'child_physical_two',
		'child_visits','clinical_history',
		'consultation_table',
		'diabetes_accessory_examine',
		'diabetes_lifestyle_guide',
		'diabetes_patient_referral',
		'diabetes_physical_sign',
		'diabetes_symptom',
		'diagnosis_table',
		'et_examination',
		'et_general_condition',
		'et_health_assessment',
		'et_health_guidance',
		'et_hospitalization_history',
		'et_identification',
		'et_lifecase_assessment',
		'et_lifestyle',
		'et_main_drug_use',
		'et_mhealth',
		'et_nonepi_vaccination',
		'et_operation_history',
		'et_organ',
		'et_symptom',
		'examination_table',
		'exposure_history',
		'family_history',
		'follow_up_drugs',
		'hypertension_follow_up',
		'hypertension_symptom',
		'individual_archive',
		'pe_health_advisory',
		'pe_lab_examination',
		'pe_second_sex_female',
		'pe_second_sex_male',
		'physical_base',
		'postpartum_heathcheck',
		'postpartum_visit',
		'premarital_examination',
		'prenatal_visit_first',
		'prenatal_visit_two',
		'schizophrenia',
		'schizophreniaer_supp_tabs',
		'surgical_history',
		'tips',
		'transfusion',
		'trauma',
		'vac_card',
		'vac_info',
		'vac_second_info',
		'abnormal_reaction',
		'deformity',
		'diabetes_core',
		'document_send',
		'genetic_diseases',
		'hypertension_symptom',
		'patient_referral_out');
		//		var_dump($uuid_array);
		$token=false;//删除标志
		//登录用户的region_path
		$current_region_path=$this->user['current_region_path'];
		foreach ($uuid_array as $uuid)
		{
			
			$individual_core=new Tindividual_core();
			$individual_core->whereAdd("uuid='$uuid'");
			$individual_core->find(true);
			$region_path=$individual_core->region_path;//取记录的region_path
			//mask 2012-11-15添加)
			if(strpos($region_path,$current_region_path)===false){
				echo "非法删除！";
				exit();
			}
			$individual_core=new Tindividual_core();
			$individual_core->whereAdd("uuid='$uuid'");
			if($individual_core->delete()){
				//删除所有个人档案业务表
				
				foreach ($all_tables_array as $table_name){
					require_once(__SITEROOT.'library/Models/'.$table_name.'.php');
					$table_obj='T'.$table_name;
					$table_name=new $table_obj();
					$table_name->whereAdd("id='$uuid'");
					$table_name->delete();
				    //$z++;
				}
				
				$token=true;
			}
		}
		//echo $z;
		if($token==true){
			echo '删除成功！';
		}else{
			echo '删除失败！';
		}
	}
	//	public function blankAction()
	//	{
	//		require_once(__SITEROOT . '/library/data_arr/arrdata.php');
	//		require_once(__SITEROOT.'library/custom/pager.php');
	//		$search['username']=trim($this->_request->getParam('username'));
	//		$individual_core=new Tindividual_core();
	//		$individual_core->whereAdd("identity_number is null");
	//		$search_org['org_id'] = $this->_request->getParam('org_id')?$this->_request->getParam('org_id'):$this->user['region_id']; //地区
	//        $individual_core_region_path_domain = get_region_path(1, $search_org['org_id']);
	//        $individual_core->whereAdd($individual_core_region_path_domain);
	//        if($search['username'])
	//        {
	//        	$individual_core->whereAdd("individual_core.name like '" . $search['username'] .
	//                "%' or individual_core.name_pinyin like '" . $search['username'] . "%'");
	//        }
	//		$nums=$individual_core->count();
	//		$pageCurrent=intval($this->_request->getParam("page"));
	//		$pageCurrent=$pageCurrent?$pageCurrent:1;
	//        $search=array();
	//        //new subpages(每页显示条数，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
	//        $pageofnumber=40;
	//        $links=new SubPages($pageofnumber,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'iha/repeat/blank/page/',2,$search);
	//        $pageCurrent=$links->check_page($pageCurrent);
	//        $startnum=$pageofnumber*($pageCurrent-1);
	//        $individual_core->limit($startnum,$pageofnumber);
	//		$individual_core->find();
	//
	//		$individual=array();
	//		$m=0;
	//		while($individual_core->fetch())
	//		{
	//			$individual[$m]['uuid']=$individual_core->uuid;
	//			$individual[$m]['name']=$individual_core->name;
	//			$individual[$m]['householder_name']=get_househoder_name($individual_core->family_number);
	//			$individual[$m]['created']=date("Y-m-d",$individual_core->created);
	//			$individual[$m]['address']=$individual_core->address;
	//			$individual[$m]['sex']=@$sex[array_search_for_other($individual_core->sex,$sex)][1];
	//			$individual[$m]['criteria_rate']=$individual_core->criteria_rate*100;
	//
	//			$m++;
	//		}
	//		$pager=$links->subPageCss2();
	//		$this->view->assign("pager",$pager);
	//		$this->view->assign("individual",$individual);
	//		$this->view->assign('org_id', $search_org['org_id']);
	//		$this->view->display("blank.html");
	//	}
}