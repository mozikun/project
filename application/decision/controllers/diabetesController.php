<?php
/*
 * Created By Eric_Zhou
 * Filename: diabetesController.php
 * Date : 2010-09-14
 * Summary : 慢病-糖尿病考核指标
 */
class decision_diabetesController extends controller{
	/**
	 * 自动加载
	 */
	public function init(){
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'library/custom/comm_function.php';
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/region_ext_1.php');
		require_once __SITEROOT."library/Models/diabetes_core.php";
		require_once __SITEROOT."library/Models/hypertension_symptom.php";
		require_once __SITEROOT."library/Models/follow_up_drugs.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/individual_status.php";//档案状态表
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."library/custom/pager.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/diabetes_core.php";
		require_once __SITEROOT."library/Models/clinical_history.php";
		require_once __SITEROOT."library/Models/diabetes_accessory_examine.php";

		$this->view->basePath = $this->_request->getBasePath();
		$this->view->evaluation_target=" <pre>考核指标
（一） 糖尿病患者健康管理率:
糖尿病患者健康管理率=已管理糖尿病人数（统计时间段内）/辖区内糖尿病患病总人数（至统计时间）×100％，
辖区糖尿病患病总人数估算：
辖区常住成年人口总数（截至统计时间）×成年人糖尿病患病率（通过当地流行病学调查、社区卫生诊断获得或是选用本省（全国）近期2型糖尿病患病率指标）。 
（二） 按照要求进行糖尿病患者管理的人数:
 确诊糖尿病患者在统计时间段内随访次数（统计时间段内）≥（取整函数（（“查询日期开始时间”-“查询日期结束时间”）/90））。
（三） 管理人群血糖控制率:
最近一次随访空腹血糖达标人数(至统计时间)/已管理的糖尿病患者人数(至统计时间)×100％。
（四）已管理的糖尿病患者人数：
确诊是糖尿病而且做过随访的人(至统计时间)。
（五） 已建档确诊糖尿病患者数(至统计时间)。
（六） 新建档确诊糖尿病患者数(统计时间段内)。
</pre>";

	}
	/**
	 * 主控制器
	 * 用于列表
	 */
	public function indexAction()
	{
		 //默认当前时间
        $number_time = mktime(23,59,59,date("m",time()),date("d",time()),date("Y",time()));//2012-10-12
        $examina_date = $this->_request->getParam('decision_time');//列表的结束时间
        $decision_time_a = $this->_request->getParam('end_time');//表单的结束时间
        $start_time = $this->_request->getParam('start_time');//表单开始时间
        $start_time_list = $this->_request->getParam('start_time_list');//列表开始时间
        //开始的时间处理
        if(!empty($start_time))
        {
        	$get_start_list_array = @explode('-',$start_time);
        	$real_start_time = @mktime(0,0,0,$get_start_list_array[1],$get_start_list_array[2],$get_start_list_array[0]);
        	//echo $start_time_list;
        }
        else 
        {
        	if(!empty($start_time_list))
        	{
        		$get_start_list_array = @explode('-',$start_time_list);
        	    $real_start_time = @mktime(0,0,0,$get_start_list_array[1],$get_start_list_array[2],$get_start_list_array[0]);
        	}
        	else 
        	{
        		$real_start_time = mktime(0,0,0,1,1,date("Y",$number_time));
        	}
        }
        //结束时间的处理
        if(!empty($decision_time_a))
        {
        	$get_date_array = @explode('-',$decision_time_a);
        	$result_time = @mktime(23,59,59,$get_date_array[1],$get_date_array[2],$get_date_array[0]);
        	$time_tag = $result_time;	
        }
        else 
        {
	         if(!empty($examina_date))
	        {
	        	$get_date_array = @explode('-',$examina_date);
	        	$result_time = @mktime(23,59,59,$get_date_array[1],$get_date_array[2],$get_date_array[0]);
	        	$time_tag = $result_time;
	        }
	        else 
	        {
	        	$time_tag = $number_time;
	        }
        }
        $current_time = date("Y-m-d",$time_tag);
        $this->view->current_time = $current_time;
        $this->view->year_start = date("Y-m-d",$real_start_time);//开始时间
		$model = $this->_request->getParam('model','');//用于控制显示
		//获取需要添加类别的当前父ID
		$p_id = $this->_request->getParam('parent_id','');
		$regionDomain = $this->user['region_id'];
		//echo $$regionDomain;
		$p_id = empty($p_id)?$regionDomain:$p_id;
		
		require_once __SITEROOT.'library/data_arr/arrdata.php';//数据字典
		require_once __SITEROOT."/library/custom/pager.php";
		$this->view->caching		=__CACHING;//开启缓存
		$this->view->cache_lifetime	=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('diabetes_index.html',$p_id.$model.$time_tag.$real_start_time))
		{
			$errorMessage = $this->_request->getParam('errorMessage','');
			$regionDomain = $this->user['region_id'];
			$p_id = empty($p_id)?$regionDomain:$p_id;
			$this->view->basePath = $this->_request->getBasePath();
			$adult_rate = $adult_prevalence_rate[2][1]; //成年人糖尿病患病率
			//echo $adult_rate;
			//辖区内成年人口总数
			//$individual_core=new Tindividual_core();
			//$individual_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
			//$individual_core->whereAdd("individual_core.updated>$lastYear");
			//$temp=$individual_core->count();
	
			//糖尿病患者健康管理率
			
			
			//列表显示父ID等于1但是ID不等于1的所有数据(不显示根)
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			$region->find();
			$row = array();
			$i = 0;//行数
			$sum_population=0;//糖尿病患者数
			$sum_archive=0;//糖尿病随访人数
			$sum_adults=0;//辖区内常住成年人口总数
			$sum_archive_last = 0;//血糖达标人数
			$all_manage_presonal = 0;
			$sum_population_temp_2 = 0;//糖尿病患者数死亡的情况
			$sum_archive_temp_die = 0;//糖尿病患者数已经管理过死亡的情况
			$rate_total=0;
			$contr_rate = 0;
			$rate_total_i = 0;//糖尿病患者健康管理率不为空的个数
			$criterion_i = 0;//糖尿病患者健康管理率不为空的个数
            $controlled_rate_i = 0;//成年人糖尿病患病率不为空的个数
			//$time=adodb_mktime(0,0,0,adodb_date("m",time()),adodb_date("d",time()),adodb_date("Y",time())-1);//取过去一年的时间
			$sum_hyper_rule_percent_total = 0;
			$sum_adults_total  = 0;
			$sum_population_total  = 0;
			$sum_archive_total = 0;
			$sum_hyper_ask_total = 0;
			$sum_archive_last_year = '';
			$sum_dis_pep_total = 0;//已管理的糖尿病人数
			//默认的次数
			$default_time = floor(($time_tag-$real_start_time)/(3600*24)/90);
			while($region->fetch()){
				$row[$i]['id'] = trim($region->id);
				$row[$i]['zh_name'] = $region->zh_name;
				$row[$i]['region_path'] = $region->region_path;
				$row[$i]['standard_code'] = $region->standard_code;
				$row[$i]['p_id'] = trim($region->p_id);
				$row[$i]['standard_code'] = trim($region->standard_code);
				$current_level = count(explode(',',$region->region_path));
				$row[$i]['adult_rate'] = $adult_rate;
				//辖区内成年人口总数
				$time_adults=adodb_mktime(0,0,0,adodb_date("m",time()),adodb_date("d",time()),adodb_date("Y",time())-18);//取成年时间
				$ind_core=new Tindividual_core();
				$ind_archive = new Tindividual_archive();
				$ind_core->joinAdd('left',$ind_core,$ind_archive,"uuid","id");
				$ind_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$ind_core->whereAdd("individual_archive.residence ='1'");//户籍状态为户籍的(如果没有这一句差距几万条数据)
				$ind_core->whereAdd("individual_core.date_of_birth<='$time_adults'");
				$ind_core->whereAdd("individual_core.status_flag='1'");
				$ind_core->whereAdd("individual_core.updated<='$time_tag'");//辖区常住成年人口总数（截至统计时间）
				$sum_adults=$ind_core->count();
				$ind_core->free_statement();
				$row[$i]['sum_adults']=$sum_adults;
				$sum_adults_total += $sum_adults;
				if($current_level<6)
				{
					$this->view->td_title='1';
				}
				//显示建档机构名称
				if($current_level==6)
                {
                    require_once __SITEROOT."library/Models/organization.php";
                    $org=new Torganization();
					$org->whereAdd("region_path='$region->region_path'");
					$org->find(true);
					$row[$i]['org_zh_name'] =$org->zh_name;
					$this->view->td_title='2';
				}
				//糖尿病患者数(正常档案的部分第一种情况)
				$sum_population_temp=0;
				$clinical_history=new Tclinical_history();
				$individual_core=new Tindividual_core();
				$individual_core->joinAdd('left',$individual_core,$clinical_history,'uuid','id');
				$individual_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$individual_core->whereAdd("clinical_history.disease_code='3'");
				$individual_core->whereAdd("individual_core.status_flag='1'");
                $individual_core->whereAdd("clinical_history.disease_date<=$time_tag or clinical_history.disease_date is null");
				$sum_population_temp=$individual_core->count("individual_core.uuid");
				//(死亡档案的部分第二种情况,死亡时间在搜索时间之后则要统计出来)
				$individual_core_2 = new Tindividual_core();
				$clinical_history_2 = new Tclinical_history();
				$individual_core_2->joinAdd('left',$individual_core_2,$clinical_history_2,'uuid','id');
				$individual_core_2->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$individual_core_2->whereAdd("clinical_history.disease_code='3'");
				$individual_core_2->whereAdd("individual_core.status_flag='6'");
				$individual_core_2->whereAdd("clinical_history.disease_date<=$time_tag or clinical_history.disease_date is null");
				//$individual_core_2->debugLevel(9);
				$sum_population_temp_2 = $individual_core_2->count("individual_core.uuid");
				$row[$i]['sum_population']=$sum_population_temp+$sum_population_temp_2;
				$sum_population_total=$sum_population_total+$sum_population_temp+$sum_population_temp_2;
				$individual_core->free_statement();
				//已管理糖尿病人数 disease_code='3' 糖尿病(这里是指的所有档案中是糖尿病而且做过随访的，但是没有统计到在这个时间内做过管理但是死去的人)
				$sum_archive_temp=0;
				$diabetes_core=new Tdiabetes_core();
				$diabetes_core->query("select count(distinct diabetes_core.id) as sum_archive_temp from diabetes_core where diabetes_core.id in (select individual_core.uuid from individual_core left join clinical_history on individual_core.uuid=clinical_history.id where clinical_history.disease_code=3 and individual_core.region_path like '$region->region_path%' and individual_core.status_flag='1' and individual_core.updated<='$time_tag') and diabetes_core.followup_time<='$time_tag' and diabetes_core.followup_time>='$real_start_time'");
				$diabetes_core->fetch();
				$sum_archive_temp = $diabetes_core->sum_archive_temp;
				//已经管理的糖尿病人数死亡的那部分(统计时间段内)
				$diabetes_core_die=new Tdiabetes_core();
				$diabetes_core_die->query("select count(distinct diabetes_core.id) as counter from diabetes_core where diabetes_core.id in (select individual_core.uuid from individual_core left join clinical_history on individual_core.uuid=clinical_history.id where clinical_history.disease_code=3 and individual_core.region_path like '$region->region_path%' and individual_core.status_flag='6' and individual_core.updated<='$time_tag') and diabetes_core.followup_time<='$time_tag' and diabetes_core.followup_time>='$real_start_time'");
				$diabetes_core_die->fetch();
				$sum_archive_temp_die = $diabetes_core_die->counter;
				$row[$i]['sum_archive'] =$sum_archive_temp+$sum_archive_temp_die;
				$sum_archive_total+=($sum_archive_temp+$sum_archive_temp_die); 
				//糖尿病患者健康管理率 = 已管理糖尿病人数/年内辖区内糖尿病患病总人数*100%
				//辖区内下去内患病总人数 = 辖区常住成年人口总数×成年人糖尿病患病率
				$row[$i]['rate'] = @round(($sum_archive_temp+$sum_archive_temp_die) / ($sum_adults * $adult_rate / 100) * 100 , 2);
				$rate_total += $row[$i]['rate']; 
				$diabetes_core->free_statement();
				//按照要求进行糖尿病患者健康管理的人数
	     		//且过去一年内随访次数≥（取整函数（（“查询日期开始时间”-“查询日期结束时间”）/90））(正常档案)
	     		//正常档案部分(在统计时间段之内确诊，在统计时间内就进行糖尿病随访而且达到要求的次数)
	     		$sum_hyper_ask = 0;
	     		$diabetes_core_nomal = new Tdiabetes_core();
	     		$diabetes_core_nomal->query("select count(*)  as counter from (select count(diabetes_core.uuid),clinical_history.disease_date from diabetes_core inner join clinical_history on diabetes_core.id = clinical_history.id inner join individual_core on diabetes_core.id = individual_core.uuid inner join individual_status on diabetes_core.id = individual_status.id where clinical_history.disease_code = '3' and clinical_history.disease_date >= '$real_start_time' and clinical_history.disease_date <= '$time_tag' and (individual_core.region_path like '$region->region_path%') and (individual_core.status_flag = '1')  and diabetes_core.followup_time >= '$real_start_time' and diabetes_core.followup_time <= '$time_tag' group by diabetes_core.id,clinical_history.disease_date having count(diabetes_core.uuid)>=floor(($time_tag-clinical_history.disease_date)/(3600*24)/90))");
	     		$diabetes_core_nomal->fetch();
                $sum_hyper_ask= $diabetes_core_nomal->counter;
	       		//echo $sum_hyper_ask;
	     		$diabetes_core_nomal->free_statement();
	     		//在统计时间段之前确诊，但是在统计时间内就进行糖尿病随访而且达到要求的次数
	     		$diabetes_core_nomal_2  = new Tdiabetes_core();
	     		$diabetes_core_nomal_2->query("select count(*) as counter from (select count(diabetes_core.uuid),clinical_history.disease_date from diabetes_core inner join clinical_history on diabetes_core.id = clinical_history.id inner join individual_core on diabetes_core.id = individual_core.uuid inner join individual_status on diabetes_core.id = individual_status.id where clinical_history.disease_code = '3' and (clinical_history.disease_date < '$real_start_time' or clinical_history.disease_date is null) and (individual_core.region_path like '$region->region_path%') and (individual_core.status_flag = '1')  and diabetes_core.followup_time >= '$real_start_time' and diabetes_core.followup_time <= '$time_tag' group by diabetes_core.id,clinical_history.disease_date having count(diabetes_core.uuid)>='$default_time')");
	     		$diabetes_core_nomal_2->fetch();
	     		$sum_hyper_ask+= $diabetes_core_nomal_2->counter;
	     		//统计死亡的那部分人(时间段内)
	     		$diabetes_core_nomal_3  = new Tdiabetes_core();
	     		$diabetes_core_nomal_3->query("select count(*)  as counter from (select count(diabetes_core.uuid),individual_status.status_time from diabetes_core inner join clinical_history on diabetes_core.id = clinical_history.id inner join individual_core on diabetes_core.id = individual_core.uuid inner join individual_status on diabetes_core.id = individual_status.id where clinical_history.disease_code = '3' and (individual_core.region_path like '$region->region_path%') and (individual_status.status_flag = '6' and individual_status.status_time > '$real_start_time' and individual_status.status_time < '$time_tag')  and diabetes_core.followup_time >= '$real_start_time' and diabetes_core.followup_time <= individual_status.status_time group by diabetes_core.id,individual_status.status_time having count(diabetes_core.uuid)>=floor((individual_status.status_time-$real_start_time)/(3600*24)/90))");
	     		$diabetes_core_nomal_3->fetch();
	     		$sum_hyper_ask+=$diabetes_core_nomal_3->counter;
	     		//统计死亡的那部分人(大于统计时间外的)
	     		$diabetes_core_nomal_4  = new Tdiabetes_core();
	     		$diabetes_core_nomal_4->query("select count(*) as counter from (select count(diabetes_core.uuid) from diabetes_core inner join clinical_history on diabetes_core.id = clinical_history.id inner join individual_core on diabetes_core.id = individual_core.uuid inner join individual_status on diabetes_core.id = individual_status.id where clinical_history.disease_code = '3' and (individual_core.region_path like '$region->region_path%') and (individual_status.status_flag = '6' and individual_status.status_time >'$time_tag') and diabetes_core.followup_time >= '$real_start_time' and diabetes_core.followup_time <= '$time_tag' group by diabetes_core.id having count(diabetes_core.uuid)>='$default_time')");
	     		$diabetes_core_nomal_4->fetch();
	     		$sum_hyper_ask+=$diabetes_core_nomal_4->counter;
	     		//echo $sum_hyper_ask;
				$row[$i]['sum_hyper_ask']=$sum_hyper_ask;
				$sum_hyper_ask_total=$sum_hyper_ask_total+$sum_hyper_ask;
				//糖尿病患者规范管理率 = 按照要求进行糖尿病患者健康管理的人数/已管理糖尿病人数（时间段）*100%
				$row[$i]['criterion'] = @round($sum_hyper_ask / ($sum_archive_temp+$sum_archive_temp_die),4) * 100;
				//$sum_hyper_rule_percent_total+= $row[$i]['criterion'];
				//这里由于填写的血糖值是小数 而且 有些输入是全角方式  最初查询的结果不正确 需要用to_number()
                $diabetes_core = new Tdiabetes_core();
                $diabetes_core->query("select count(*) as cou  from (SELECT MAX(diabetes_core.followup_time),diabetes_core.id FROM diabetes_core left join diabetes_accessory_examine on diabetes_core.id=diabetes_accessory_examine.id where to_number(diabetes_accessory_examine.fasting_bloodglucose)<=7 and to_number(diabetes_accessory_examine.fasting_bloodglucose)>=5.6 and diabetes_core.followup_time<='$time_tag'  group by diabetes_core.id having diabetes_core.id in (select individual_core.uuid from individual_core left join clinical_history on individual_core.uuid=clinical_history.id where clinical_history.disease_code=3 and individual_core.status_flag='1' and individual_core.region_path like '$region->region_path%'))");//有了诸如max min的聚合函数的时候最后必须要加上groupby 而且groupby的是查询的字段中的
                $diabetes_core->fetch();
                $new_archive_rate_last_year = $diabetes_core->cou;
				$row[$i]['archive_rate_last_year'] = $new_archive_rate_last_year;
				$sum_archive_last+=$new_archive_rate_last_year;
				//echo $new_archive_rate_last_year;
				//管理人群血糖控制率=最近一次随访血糖达标人数/已管理的糖尿病人数×100％
				$diabetes_core_xtkzl=new Tdiabetes_core();//已管理的糖尿病人数(这里根据文档使用到统计时间)
				$diabetes_core_xtkzl->query("select count(distinct diabetes_core.id) as all_manage_presonal from diabetes_core where diabetes_core.id in (select individual_core.uuid from individual_core left join clinical_history on individual_core.uuid=clinical_history.id where clinical_history.disease_code=3 and individual_core.region_path like '$region->region_path%' and individual_core.status_flag='1' and individual_core.updated<='$time_tag') and diabetes_core.followup_time<='$time_tag'");
				$diabetes_core_xtkzl->fetch();
				$diabetes_core_xtkzl_2=new Tdiabetes_core();//已管理的糖尿病人数(这里根据文档使用到统计时间)
				$diabetes_core_xtkzl_2->query("select count(distinct diabetes_core.id) as counter from diabetes_core where diabetes_core.id in (select individual_core.uuid from individual_core left join clinical_history on individual_core.uuid=clinical_history.id where clinical_history.disease_code=3 and individual_core.region_path like '$region->region_path%' and individual_core.status_flag='6' and individual_core.updated<='$time_tag') and diabetes_core.followup_time<='$time_tag'");
				$diabetes_core_xtkzl_2->fetch();
				//echo $diabetes_core_xtkzl->all_manage_presonal+$diabetes_core_xtkzl_2->counter;
				$all_manage_presonal+= ($diabetes_core_xtkzl->all_manage_presonal+$diabetes_core_xtkzl_2->counter);
				$row[$i]['controlled_rate']=@round($new_archive_rate_last_year / ($diabetes_core_xtkzl->all_manage_presonal+$diabetes_core_xtkzl_2->counter) ,4)*100;
				//$contr_rate += $row[$i]['controlled_rate'];
				$i++;
			}
			$contr_rate_prcent = @round($sum_archive_last/$all_manage_presonal* 100,2);
			$rate_total_prcent = @round($sum_archive_total/($sum_adults_total* $adult_rate / 100)* 100 ,2);
			$sum_hyper_rule_percent_total_prcent = @round($sum_hyper_ask_total/$sum_archive_total* 100,2);
			$this->view->assign('contr_rate',$contr_rate_prcent);
			$this->view->assign('rate_total',$rate_total_prcent);
			$this->view->assign('sum_hyper_rule_percent_total',$sum_hyper_rule_percent_total_prcent);
			$this->view->assign('model',$model);
			$this->view->assign('row',$row);
			$this->view->assign('sum_archive_last',$sum_archive_last);
			$this->view->assign('sum_population',$sum_population);
			$this->view->assign('sum_archive',$sum_archive);
			$this->view->assign('sum_archive_total',$sum_archive_total);
			$this->view->assign('sum_dis_pep_total',$sum_dis_pep_total);
			$this->view->assign('sum_hyper_ask_total',$sum_hyper_ask_total);
			$this->view->assign('sum_adults_total',$sum_adults_total);
			$this->view->assign('sum_population_total',$sum_population_total);
			//@$this->view->assign('sum_archive_rate',round(($sum_archive/$sum_population)*100,2));
			$this->view->assign('sum_archive_last_year',$sum_archive_last_year);
			//@$this->view->assign('sum_archive_rate_last_year',round(($sum_archive_last_year/$sum_population)*100,2));
			$this->view->assign('add_need_id',$p_id);
			$this->view->assign('basePath',__BASEPATH);
			$this->view->assign('adult_rate',$adult_rate);
			//获取所有path 根据登录者的地区id，限制导航条只能在该用户所在的区域内
			$pathSel = new Tregion();
			$pathSel->whereAdd("id='$p_id'");
			$pathSel->find(true);
			$currentPath = $pathSel->region_path;//处理path
			$nuNumber = strpos($currentPath,$regionDomain);
			$strNumber = intval(strlen($currentPath)-$nuNumber);
			$newCurrentPath = substr($currentPath,$nuNumber,$strNumber);
			$realPath = explode(',',$newCurrentPath);
			$realCount = count($realPath);
			$rs = array();
			$rsCount = 0 ;
			foreach ($realPath as $k=>$v){
				$realMenu = new Tregion();
				$realMenu->whereAdd("id='$v'");
				$realMenu->find(true);
                $realMenu->free_statement();
				$rs[$rsCount]['zh_name'] = $realMenu->zh_name;
				$rs[$rsCount]['id'] = trim($realMenu->id);
				$rs[$rsCount]['p_id'] = trim($realMenu->p_id);
				$rsCount++;
			}
			$this->view->assign('rs',$rs);
			//获取当前表中所有栏目内容(除去根)
			$length=count(explode(',',$pathSel->region_path));
			//echo $length;
			if($length<=4){
				$this->view->standard_code_size=6;
			}else{
				$this->view->standard_code_size=3;
			}
			$this->view->errorMessage=$errorMessage;
		}
		$this->view->display('diabetes_index.html',$p_id.$model.$time_tag.$real_start_time);
	}
}
?>