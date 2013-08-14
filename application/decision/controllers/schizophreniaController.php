<?php
/**
*@author：mask
*@filename: indexController.php
*@package：用于完成慢病重性精神分裂考核指标的统计
*@email：79269786@qq.com
*@create：2010-11-22
*/
class decision_schizophreniaController extends controller{
	/**
	 * 自动加载
	 */
	public function init(){
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/hypertension_follow_up.php";
		require_once __SITEROOT."library/Models/schizophrenia.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/region.php";
		require_once __SITEROOT."library/Models/clinical_history.php";
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT."library/Models/individual_status.php";//个人档案状态
		$this->view->basePath = $this->_request->getBasePath();
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$this->adult_rate = $adult_prevalence_rate[3][1];//成年人患病率
		$this->view->evaluation_target=" <pre>（一）重性精神疾病患者管理率=所有登记在册的确诊重性精神疾病患者数（至统计时间）/
 （辖区内15岁及以上人口总数（至统计时间）×患病率）×100％。
*注：依据当地3年内精神疾病流行病学调查得到的重性精神疾病患病率。若当地未开展调查，建议采用浙江、河北省调查的重性精神疾病患病率（1％）。
（二）重性精神疾病患者规范管理率=按照规范要求进行管理的确诊重性精神疾病患者数（统计时间段内）/
 所有登记在册的确诊重性精神疾病患者数（至统计时间）×100％。
（三）重性精神疾病患者稳定率=最近一次随访时分类为病情稳定的患者数（至统计时间）/所有登记在册的确诊重性精神疾病患者数（至统计时间）×100％。

*<strong>统计时间段内</strong>：开始时间到结束时间段。如果不输入“开始时间”，默认为当年1月1日；如果不输入“结束时间”，默认为今天的时间。
如开始时间：2012-02-03 ，结束时间 ：2012-12-12.则统计指标统计的数据为2012-02-03至2012-12-12的结果。

*<strong>至统计时间</strong>：表示该统计指标所统计数据至所选择的统计时间为止的之前的所有数据，如选择2012-09-26，则统计截止于2012-09-27之前的所有数据

*<strong>与时间无关</strong>：表示该统计指标与所选择的统计时间完全无关，将统计数据库内的所有数据（满足其他条件）
*所有登记在册的确诊重性精神疾病患者数（至统计时间）：重性精神分裂确症时间小于统计结束时间
重性精神分裂确症时间很多为空，程序不能用时间区分出这些数据，可能出现大于100%的情况，请医务人员输入确症时间。


</pre>
";
	}
	/**
	 * 主控制器
	 * 用于列表
	 */
	public function indexAction()
	{
		//print_r($this->user);
		$area_id							= $this->user['region_id'];//区域
		//print_r($area_id);
		$p_id 								= $this->_request->getParam('parent_id',$area_id);
		$post_decision_time					= !$this->_request->getParam('post_decision_time')?'':$this->_request->getParam('post_decision_time');//决策按结束查询时间
		$decision_time						= $post_decision_time!=''?$post_decision_time:(!$this->_request->getParam('decision_time')?date("Y-m-d"):$this->_request->getParam('decision_time'));//决策按结束时间查询

		//$decision_time						= !$this->_request->getParam('decision_time')?date("Y-m-d"):$this->_request->getParam('decision_time');//决策按时间查询
		$decision_datetime					= strtotime($decision_time)+3600*24-1;//决策按结束时间查询

		$start_decision_time				= !$this->_request->getParam('start_decision_time')?'':$this->_request->getParam('start_decision_time');//决策开始查询时间


		$start_time							= $start_decision_time!=''?$start_decision_time:date("Y",strtotime($decision_time)).'-01-01';//决策按时间查询


		$this->view->caching				=__CACHING;//开启缓存
		$this->view->cache_lifetime			=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('index.html',$p_id.$decision_time.$start_decision_time)){
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			//$region->limit($startnum,__ROWSOFPAGE);
			//$region->debugLevel(9);
			$region->find();
			$rowCount				= 0;
			$row					= array();
			$sum_all_schizophreniaer= 0;//总所有登记在册的重性精神疾病患者数
			$sum_population			= 0;//总15岁及以上人口总数
			$sum_last_good_schizophreniaer=0;//总最近一次随访时分类为病情稳定的患者数
			$sum_every_year_stand	=0;//每年按照照规范要求进行管理的确诊重性精神疾病患者数
			$current_level=0;
			while($region->fetch()){
				$row[$rowCount]['id'] 				= trim($region->id);
				$row[$rowCount]['zh_name'] 			= $region->zh_name;
				$row[$rowCount]['region_path']		= $region->region_path;
				$row[$rowCount]['standard_code'] 	= $region->standard_code;
				$row[$rowCount]['p_id'] 			= trim($region->p_id);
				$row[$rowCount]['standard_code'] 	= trim($region->standard_code);
				$current_level 						= count(explode(',',$region->region_path));
				if($current_level==6){
					$org_name						= $this->getOrg($region->region_path);//取得机构名
					$row[$rowCount]['org_name'] 	= $org_name;
				}
				//echo $current_level;
				$region_path						= $region->region_path;

				$all_schizophreniaer				= $this->getAllSchizophreniaer($region_path,$decision_datetime);//所有登记在册的重性精神疾病患者数
				$population 						= $this->getPopulation($region_path,15,$decision_datetime);//15岁及以上人口总数

				$adult_rate							= $this->adult_rate;//患病率
				$population_adult_rate				= $population*$adult_rate*0.01;//辖区内15岁及以上人口总数*患病率
				$mentalillness						= empty($population_adult_rate)?0:$all_schizophreniaer/$population_adult_rate*100;//重性精神疾病患者管理率
				$last_good_schizophreniaer			= $this->lastStabler($region_path,$decision_datetime);//最近一次随访时分类为病情稳定的患者数


				$good_rate							= empty($all_schizophreniaer)?0:$last_good_schizophreniaer/$all_schizophreniaer*100;//重性精神疾病患者显好率=最近一次随访时分类为病情稳定的患者数/所有登记在册的确诊重性精神疾病患者数*100%
				//echo $good_rate;
				$every_year_stand					= $this->standard($region_path,$decision_datetime,strtotime($start_time));//每年按照照规范要求进行管理的确诊重性精神疾病患者数

				//echo $every_year_stand;
				$every_year_stand_rate				= empty($all_schizophreniaer)?0:$every_year_stand/$all_schizophreniaer*100;//重性精神疾病患者规范管理
				$row[$rowCount]['all_schizophreniaer']=$all_schizophreniaer;
				$row[$rowCount]['population']		= $population;
				$row[$rowCount]['adult_rate']		= $adult_rate;
				$row[$rowCount]['population_adult_rate']=$population_adult_rate;
				$row[$rowCount]['mentalillness']	= number_format($mentalillness,2);
				$row[$rowCount]['last_good_schizophreniaer']= $last_good_schizophreniaer;//最近一次随访时分类为病情稳定的患者数
				$row[$rowCount]['good_rate']		= number_format($good_rate,2);//重性精神疾病患者显好率
				$row[$rowCount]['every_year_stand']	= $every_year_stand;//每年按照照规范要求进行管理的确诊重性精神疾病患者数
				//echo $every_year_stand;
				$row[$rowCount]['every_year_stand_rate']= number_format($every_year_stand_rate,2);//规范管理率

				$sum_all_schizophreniaer+=$all_schizophreniaer;
				$sum_population+=$population;
				$sum_last_good_schizophreniaer+=$last_good_schizophreniaer;
				$sum_every_year_stand+=$every_year_stand;
				$rowCount++;
			}
			$region->free_statement();
			$this->view->sum_all_schizophreniaer	= $sum_all_schizophreniaer;//所有确症人数
			$this->view->sum_population				= $sum_population;//15岁及以上人口总数
			$this->view->adult_rate					= $this->adult_rate;//患病优选法
			$population_adult_rate					= $sum_population*$this->adult_rate*0.01;//人口总数*患病率
			$this->view->population_adult_rate		= $population_adult_rate;//管理率(%)
			$this->view->sum_last_good_schizophreniaer=$sum_last_good_schizophreniaer;//总最近一次随访时分类为病情稳定的患者数
			$good_rate								= empty($sum_all_schizophreniaer)?0:$sum_last_good_schizophreniaer/$sum_all_schizophreniaer*100;//重性精神疾病患者显好率
			$this->view->good_rate					= number_format($good_rate,2);//显好率
			$this->view->mentalillness				= empty($population_adult_rate)?0:number_format($sum_all_schizophreniaer/$population_adult_rate*100,2);//管理优选法
			$this->view->sum_every_year_stand		= $sum_every_year_stand;//规范管理人数
			$this->view->sum_every_year_stand_rate	= empty($sum_all_schizophreniaer)?0:number_format($sum_every_year_stand/$sum_all_schizophreniaer*100,2);//规范管理率
			$this->view->row=$row;
			if($current_level==6){
				$this->view->td_title='2';
			}else{
				$this->view->td_title='1';
			}
			//-----start 罗 ----
			//获取所有path 根据登录者的地区id，限制导航条只能在该用户所在的区域内
			$pathSel = new Tregion();
			$pathSel->whereAdd("id='$p_id'");
			$pathSel->find(true);
			$currentPath = $pathSel->region_path;//处理path
			$regionDomain = $this->user['region_id'];
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
				$rs[$rsCount]['zh_name'] = $realMenu->zh_name;
				$rs[$rsCount]['id'] = trim($realMenu->id);
				$rs[$rsCount]['p_id'] = trim($realMenu->p_id);
				$rsCount++;
				$realMenu->free_statement();
			}
			$this->view->assign('rs',$rs);
			$this->view->assign('add_need_id',$p_id);
			//获取当前表中所有栏目内容(除去根)
			$length=count(explode(',',$pathSel->region_path));
			//echo $length;
			if($length<=4){
				$this->view->standard_code_size=6;
			}else{
				$this->view->standard_code_size=3;
			}
			$pathSel->free_statement();
			//-----end 罗----
			//print_r($row);
		}

		$this->view->start_time=$start_time;
		$this->view->decision_time=$decision_time;
		$this->view->display('index.html',$p_id.$decision_time.$start_decision_time);
	}
	/**
	 * 重性精神疾病患者管理率=所有登记在册的确诊重性精神疾病患者数（至统计时间）/（辖区内15岁及以上人口总数（与时间无关）×患病率）×100％
	 *
	 */
	public function mentalillnessAction()
	{

		//print_r($this->user);
		$area_id							= $this->user['region_id'];//区域
		//print_r($area_id);
		$p_id 								= $this->_request->getParam('parent_id',$area_id);

		$post_decision_time					= !$this->_request->getParam('post_decision_time')?'':$this->_request->getParam('post_decision_time');//决策按时间查询
		$decision_time						= $post_decision_time!=''?$post_decision_time:(!$this->_request->getParam('decision_time')?date("Y-m-d"):$this->_request->getParam('decision_time'));//决策按时间查询

		$decision_datetime					= strtotime($decision_time)+3600*24-1;//决策按时间查询

		$start_decision_time				= !$this->_request->getParam('start_decision_time')?'':$this->_request->getParam('start_decision_time');//决策开始查询时间


		$start_time							= $start_decision_time!=''?$start_decision_time:date("Y",strtotime($decision_time)).'-01-01';//决策按时间查询
		//$start_time							= date("Y",strtotime($decision_time)).'-01-01';

		$this->view->caching				=__CACHING;//开启缓存
		$this->view->cache_lifetime			=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('mentalillness.html',$p_id.$decision_time.$start_decision_time)){
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			//$region->limit($startnum,__ROWSOFPAGE);
			//$region->debugLevel(9);
			$region->find();
			$rowCount				= 0;
			$row					= array();
			$sum_all_schizophreniaer= 0;//总所有登记在册的重性精神疾病患者数
			$sum_population			= 0;//总15岁及以上人口总数
			$current_level=0;

			while($region->fetch()){
				$row[$rowCount]['id'] 				= trim($region->id);
				$row[$rowCount]['zh_name'] 			= $region->zh_name;
				$row[$rowCount]['region_path']		= $region->region_path;
				$row[$rowCount]['standard_code'] 	= $region->standard_code;
				$row[$rowCount]['p_id'] 			= trim($region->p_id);
				$row[$rowCount]['standard_code'] 	= trim($region->standard_code);
				$current_level 						= count(explode(',',$region->region_path));
				if($current_level==6){
					$org_name						= $this->getOrg($region->region_path);//取得机构名
					$row[$rowCount]['org_name'] 	= $org_name;
				}
				//echo $current_level;
				$region_path						= $region->region_path;
				$all_schizophreniaer				= $this->getAllSchizophreniaer($region_path,$decision_datetime);//所有登记在册的重性精神疾病患者数
				//万-2012-12-06改成至统计时间，因为“与时间无关”的话，15岁以上人口数是最新的人口数，不能统计到去年，前年的人口数
 				$population 						= $this->getPopulation($region_path,15,$decision_datetime);//15岁及以上人口总数
				$adult_rate							= $this->adult_rate;//患病率
				$population_adult_rate				= $population*$adult_rate*0.01;//辖区内15岁及以上人口总数*患病率
				$mentalillness						= empty($population_adult_rate)?0:$all_schizophreniaer/$population_adult_rate*100;//重性精神疾病患者管理率


				$row[$rowCount]['all_schizophreniaer']=$all_schizophreniaer;
				$row[$rowCount]['population']		= $population;
				$row[$rowCount]['adult_rate']		= $adult_rate;
				$row[$rowCount]['population_adult_rate']=$population_adult_rate;
				$row[$rowCount]['mentalillness']	= number_format($mentalillness,2);
				$sum_all_schizophreniaer+=$all_schizophreniaer;
				$sum_population+=$population;
				$rowCount++;
			}
			$region->free_statement();
			$this->view->sum_all_schizophreniaer	= $sum_all_schizophreniaer;
			$this->view->sum_population				= $sum_population;
			$this->view->adult_rate					= $this->adult_rate;
			$population_adult_rate					= $sum_population*$this->adult_rate*0.01;
			$this->view->population_adult_rate		= $population_adult_rate;

			$this->view->mentalillness				= empty($population_adult_rate)?0:number_format($sum_all_schizophreniaer/$population_adult_rate*100,2);
			$this->view->row=$row;
			if($current_level==6){
				$this->view->td_title='2';
			}else{
				$this->view->td_title='1';
			}
			//-----start 罗 ----
			//获取所有path 根据登录者的地区id，限制导航条只能在该用户所在的区域内
			$pathSel = new Tregion();
			$pathSel->whereAdd("id='$p_id'");
			$pathSel->find(true);
			$currentPath = $pathSel->region_path;//处理path
			$regionDomain = $this->user['region_id'];
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
				$rs[$rsCount]['zh_name'] = $realMenu->zh_name;
				$rs[$rsCount]['id'] = trim($realMenu->id);
				$rs[$rsCount]['p_id'] = trim($realMenu->p_id);
				$rsCount++;
			}
			$this->view->assign('rs',$rs);
			$this->view->assign('add_need_id',$p_id);
			//获取当前表中所有栏目内容(除去根)
			$length=count(explode(',',$pathSel->region_path));
			//echo $length;
			if($length<=4){
				$this->view->standard_code_size=6;
			}else{
				$this->view->standard_code_size=3;
			}
			$realMenu->free_statement();
			//-----end 罗----
			//print_r($row);
		}

		$this->view->start_time=$start_time;
		$this->view->decision_time=$decision_time;
		$this->view->display('mentalillness.html',$p_id.$decision_time.$start_decision_time);

	}
	/**
     * 重性精神疾病患者显好率=最近一次随访时分类为病情稳定的患者数/所有登记在册的确诊重性精神疾病患者数*100%
     *
     */
	public  function goodrateAction(){
		
		//print_r($this->user);
		$area_id							= $this->user['region_id'];//区域
		//print_r($area_id);
		$p_id 								= $this->_request->getParam('parent_id',$area_id);
		$post_decision_time					= !$this->_request->getParam('post_decision_time')?'':$this->_request->getParam('post_decision_time');//决策按时间查询
		$decision_time						= $post_decision_time!=''?$post_decision_time:(!$this->_request->getParam('decision_time')?date("Y-m-d"):$this->_request->getParam('decision_time'));//决策按时间查询

		//$decision_time						= !$this->_request->getParam('decision_time')?date("Y-m-d"):$this->_request->getParam('decision_time');//决策按时间查询
		$decision_datetime					= strtotime($decision_time)+3600*24-1;//决策按时间查询

		$start_decision_time				= !$this->_request->getParam('start_decision_time')?'':$this->_request->getParam('start_decision_time');//决策开始查询时间


		$start_time							= $start_decision_time!=''?$start_decision_time:date("Y",strtotime($decision_time)).'-01-01';//决策按时间查询

		//$start_time							= date("Y",strtotime($decision_time)).'-01-01';


		$this->view->caching				=__CACHING;//开启缓存
		$this->view->cache_lifetime			=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('goodrate.html',$p_id.$decision_time.$start_decision_time)){
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			//$region->limit($startnum,__ROWSOFPAGE);
			//$region->debugLevel(9);
			$region->find();
			$rowCount				= 0;
			$row					= array();
			$sum_all_schizophreniaer= 0;//总所有登记在册的重性精神疾病患者数
			$sum_last_good_schizophreniaer= 0;//最近一次随访时分类为病情稳定的患者数

			while($region->fetch()){
				$row[$rowCount]['id'] 				= trim($region->id);
				$row[$rowCount]['zh_name'] 			= $region->zh_name;
				$row[$rowCount]['region_path']		= $region->region_path;
				$row[$rowCount]['standard_code'] 	= $region->standard_code;
				$row[$rowCount]['p_id'] 			= trim($region->p_id);
				$row[$rowCount]['standard_code'] 	= trim($region->standard_code);
				$current_level 						= count(explode(',',$region->region_path));
				if($current_level==6){
					$org_name						= $this->getOrg($region->region_path);//取得机构名
					$row[$rowCount]['org_name'] 	= $org_name;
				}
				//echo $current_level;
				$region_path						= $region->region_path;
				$all_schizophreniaer				= $this->getAllSchizophreniaer($region_path,$decision_datetime);//所有登记在册的重性精神疾病患者数
			    
				$last_good_schizophreniaer			= $this->lastStabler($region_path,$decision_datetime);//最近一次随访时分类为病情稳定的患者数

				$good_rate							= empty($all_schizophreniaer)?0:$last_good_schizophreniaer/$all_schizophreniaer*100;//重性精神疾病患者显好率=最近一次随访时分类为病情稳定的患者数/所有登记在册的确诊重性精神疾病患者数*100%

				$row[$rowCount]['all_schizophreniaer']		= $all_schizophreniaer;
				$row[$rowCount]['last_good_schizophreniaer']= $last_good_schizophreniaer;
				$row[$rowCount]['adult_rate']				= number_format($good_rate,2);

				$sum_all_schizophreniaer+=$all_schizophreniaer;
				$sum_last_good_schizophreniaer+=$last_good_schizophreniaer;
				$rowCount++;
			}
			$region->free_statement();
			$this->view->sum_all_schizophreniaer	= $sum_all_schizophreniaer;
			$this->view->sum_population				= $sum_last_good_schizophreniaer;
			$good_rate								= empty($sum_all_schizophreniaer)?0:$sum_last_good_schizophreniaer/$sum_all_schizophreniaer*100;//重性精神疾病患者显好率
			$this->view->good_rate					= number_format($good_rate,2);



			$this->view->row=$row;
			if($current_level==6){
				$this->view->td_title='2';
			}else{
				$this->view->td_title='1';
			}
			//-----start 罗 ----
			//获取所有path 根据登录者的地区id，限制导航条只能在该用户所在的区域内
			$pathSel = new Tregion();
			$pathSel->whereAdd("id='$p_id'");
			$pathSel->find(true);
			$currentPath = $pathSel->region_path;//处理path
			$regionDomain = $this->user['region_id'];
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
				$rs[$rsCount]['zh_name'] = $realMenu->zh_name;
				$rs[$rsCount]['id'] = trim($realMenu->id);
				$rs[$rsCount]['p_id'] = trim($realMenu->p_id);
				$rsCount++;
			}
			$this->view->assign('rs',$rs);
			$this->view->assign('add_need_id',$p_id);
			//获取当前表中所有栏目内容(除去根)
			$length=count(explode(',',$pathSel->region_path));
			//echo $length;
			if($length<=4){
				$this->view->standard_code_size=6;
			}else{
				$this->view->standard_code_size=3;
			}
			$realMenu->free_statement();
			//-----end 罗----
			//print_r($row);
		}

		$this->view->start_time=$start_time;
		$this->view->decision_time=$decision_time;
		$this->view->display('goodrate.html',$p_id.$decision_time.$start_decision_time);
	}

	/**
     * 重性精神疾病患者规范管理率=每年按照规范要求进行管理的确诊重性精神疾病患者数（统计时间段内）/所有登记在册的确诊重性精神疾病患者数（至统计时间）×100％。
     *
     */
	public  function standadminAction(){
		//print_r($this->user);
		$area_id							= $this->user['region_id'];//区域
		//print_r($area_id);
		$p_id 								= $this->_request->getParam('parent_id',$area_id);
		$post_decision_time					= !$this->_request->getParam('post_decision_time')?'':$this->_request->getParam('post_decision_time');//决策按时间查询
		$decision_time						= $post_decision_time!=''?$post_decision_time:(!$this->_request->getParam('decision_time')?date("Y-m-d"):$this->_request->getParam('decision_time'));//决策按时间查询

		//$decision_time						= !$this->_request->getParam('decision_time')?date("Y-m-d"):$this->_request->getParam('decision_time');//决策按时间查询
		$decision_datetime					= strtotime($decision_time)+3600*24-1;//决策按时间查询

		$start_decision_time				= !$this->_request->getParam('start_decision_time')?'':$this->_request->getParam('start_decision_time');//决策开始查询时间


		$start_time							= $start_decision_time!=''?$start_decision_time:date("Y",strtotime($decision_time)).'-01-01';//决策按时间查询

		//$start_time							= date("Y",strtotime($decision_time)).'-01-01';

		$this->view->caching				=__CACHING;//开启缓存
		$this->view->cache_lifetime			=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('mentalillness.html',$p_id.$start_time.$decision_time)){
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			//$region->limit($startnum,__ROWSOFPAGE);
			//$region->debugLevel(9);
			$region->find();
			$rowCount				= 0;
			$row					= array();
			$sum_all_schizophreniaer= 0;//总所有登记在册的重性精神疾病患者数
			$sum_last_good_schizophreniaer= 0;//每年按照照规范要求进行管理的确诊重性精神疾病患者数
			$current_level=0;

			while($region->fetch()){
				$row[$rowCount]['id'] 				= trim($region->id);
				$row[$rowCount]['zh_name'] 			= $region->zh_name;
				$row[$rowCount]['region_path']		= $region->region_path;
				$row[$rowCount]['standard_code'] 	= $region->standard_code;
				$row[$rowCount]['p_id'] 			= trim($region->p_id);
				$row[$rowCount]['standard_code'] 	= trim($region->standard_code);
				$current_level 						= count(explode(',',$region->region_path));
				if($current_level==6){
					$org_name						= $this->getOrg($region->region_path);//取得机构名
					$row[$rowCount]['org_name'] 	= $org_name;
				}
				//echo $current_level;
				$region_path						= $region->region_path;
				$all_schizophreniaer				= $this->getAllSchizophreniaer($region_path,$decision_datetime);//所有登记在册的重性精神疾病患者数
				$last_good_schizophreniaer			= $this->standard($region_path,$decision_datetime,strtotime($start_time));//每年按照照规范要求进行管理的确诊重性精神疾病患者数

				$good_rate							= empty($all_schizophreniaer)?0:$last_good_schizophreniaer/$all_schizophreniaer*100;//重性精神疾病患者规范管理

				$row[$rowCount]['all_schizophreniaer']		= $all_schizophreniaer;
				$row[$rowCount]['last_good_schizophreniaer']= $last_good_schizophreniaer;
				$row[$rowCount]['adult_rate']				= number_format($good_rate,2);

				$sum_all_schizophreniaer+=$all_schizophreniaer;
				$sum_last_good_schizophreniaer+=$last_good_schizophreniaer;
				$rowCount++;
			}
			$region->free_statement();
			$this->view->sum_all_schizophreniaer	= $sum_all_schizophreniaer;
			$this->view->sum_population				= $sum_last_good_schizophreniaer;
			$good_rate								= empty($sum_all_schizophreniaer)?0:$sum_last_good_schizophreniaer/$sum_all_schizophreniaer*100;//重性精神疾病患者显好率
			$this->view->good_rate					= number_format($good_rate,2);



			$this->view->row=$row;
			if($current_level==6){
				$this->view->td_title='2';
			}else{
				$this->view->td_title='1';
			}
			//-----start 罗 ----
			//获取所有path 根据登录者的地区id，限制导航条只能在该用户所在的区域内
			$pathSel = new Tregion();
			$pathSel->whereAdd("id='$p_id'");
			$pathSel->find(true);
			$currentPath = $pathSel->region_path;//处理path
			$regionDomain = $this->user['region_id'];
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
				$rs[$rsCount]['zh_name'] = $realMenu->zh_name;
				$rs[$rsCount]['id'] = trim($realMenu->id);
				$rs[$rsCount]['p_id'] = trim($realMenu->p_id);
				$rsCount++;
			}
			$this->view->assign('rs',$rs);
			$this->view->assign('add_need_id',$p_id);
			//获取当前表中所有栏目内容(除去根)
			$length=count(explode(',',$pathSel->region_path));
			//echo $length;
			if($length<=4){
				$this->view->standard_code_size=6;
			}else{
				$this->view->standard_code_size=3;
			}
			$realMenu->free_statement();
			//-----end 罗----
			//print_r($row);
			//}
			$this->view->start_time=$start_time;
			$this->view->decision_time=$decision_time;
		}

		$this->view->display('standadmin.html',$p_id.$start_time.$decision_time);
	}






	/**
	 * 所有登记在册的重性精神疾病患者数
	 * @param String $area_id
	 * @param int $decision_time
	 * @return int
	 */
	private function getAllSchizophreniaer($area_id,$decision_time){
		$clinical_history = new Tclinical_history();//疾病确症
		$individual_core= new Tindividual_core();//个人档案
		$individual_status=new Tindividual_status();//个要档案状态
		$individual_core->joinAdd('left',$individual_core,$clinical_history,'uuid','id');
		$individual_core->joinAdd('inner',$individual_core,$individual_status,'uuid','id');		
		$individual_core->whereAdd("INSTR(individual_core.region_path,'$area_id')>0");//指定区域		
		$individual_core->whereAdd("individual_status.status_flag='1'");//档案状态正常
		$individual_core->whereAdd("clinical_history.disease_date<=$decision_time or  clinical_history.disease_date is null");//确症结束时间
		$individual_core->whereAdd("clinical_history.disease_state='1'");//确症为精神分裂
		$individual_core->whereAdd("clinical_history.disease_code='8'");//确症为精神分裂
		//$individual_core->groupby("individual_core.uuid");//

		//$individual_core->debugLevel(2);
		$num=$individual_core->count("DISTINCT individual_core.uuid");
		$individual_core->free_statement();
		$clinical_history->free_statement();
		return $num;

	}
	/**
	 * 统计一个区域$parent_id.内所有年龄$age及以上的人口数
	 *
	 * @param String $parent_id
	 * @param int $age
	 * @param int $decision_time
	 * @return int 
	 */
	private  function getPopulation($area_id,$age=0,$decision_time=0){

		$age_time=adodb_mktime(adodb_date("H"),adodb_date("i"),adodb_date("s"),adodb_date("m"),adodb_date("d"),adodb_date("Y")-$age);//$age年前时间戳

		$individual_core= new Tindividual_core();//个人档案
		$individual_status= new Tindividual_status();//个人档案状态

		$individual_core->joinAdd('inner',$individual_core,$individual_status,'uuid','id');	
		$individual_core->whereAdd("INSTR(individual_core.region_path,'$area_id')>0");//指定区域
		$individual_core->whereAdd("date_of_birth<=$age_time");//$age及以前出生的人数
		$individual_core->whereAdd("individual_status.status_flag=1");//档案状态
		if($decision_time!=0){
			$individual_core->whereAdd("individual_core.updated<=$decision_time");//决策时间
		}
		//$individual_core->groupby("individual_core.uuid");
		//$individual_core->debug(2);
		return $individual_core->count("DISTINCT individual_core.uuid");

	}
	/**
	 * 统计一个区域$parent_id.最近一次随访时分类为病情稳定的患者数
	 *
	 * @param String $area_id
	 * @param int $decision_time
	 * @return int
	 */
	private function lastStabler($area_id,$decision_time){

		$clinical_history = new Tclinical_history();//疾病确症
		//为了提交效率用多个子查询，速度提高了n倍，n>0,哈哈，正常情况是10倍以上。
		
		$clinical_history->query("SELECT
		COUNT (*) as counter
	FROM
		schizophrenia A
	WHERE
		EXISTS (
			SELECT
				*
			FROM
				(
				SELECT
					id AS s_id,
					MAX (fllowup_time) AS followup_time
				FROM
					(
						SELECT
							uuid,
							id,
							fllowup_time,
							followup_classification
						FROM
							schizophrenia
						WHERE
							EXISTS (
								SELECT
									clinical_history.id AS id
								FROM
									clinical_history
								LEFT JOIN individual_core ON clinical_history. id = individual_core.uuid
								INNER JOIN individual_status ON  clinical_history. id = individual_status.id
								WHERE
									
								 (
									INSTR (
										individual_core.region_path,
										'{$area_id}'
									) > 0
								)
								AND (
									individual_status.status_flag = '1'
								)
								
								
								AND schizophrenia. id = clinical_history. id
								AND (
									clinical_history. disease_date <= {$decision_time}
									OR
									clinical_history.disease_date is null
								)
								AND(
									clinical_history.disease_state = '1'
								)
								AND (
									clinical_history.disease_code = '8'
								)
							)
					)
				GROUP BY
					ID
			)
		WHERE
			A .followup_classification = '1'
		AND A .ID = s_id
		AND A .fllowup_time = followup_time
	)");
		
		//$clinical_history->debug(2);
		$clinical_history->fetch();
		$i=$clinical_history->counter;
		/*
		$individual_core= new Tindividual_core();//个人档案
		$clinical_history->joinAdd('left',$clinical_history,$individual_core,'id','uuid');
		$clinical_history->whereAdd("clinical_history.disease_state='1'");//确症为精神分裂
		$clinical_history->whereAdd("INSTR(individual_core.region_path,'$area_id')>0");//指定区域
		$clinical_history->whereAdd("individual_core.status_flag=1");//档案状态
		$clinical_history->whereAdd("clinical_history.disease_code='8'");//确症为精神分裂
		$clinical_history->whereAdd("individual_core.updated<=$decision_time");//确症时间
		$clinical_history->debug(3);
		$clinical_history->find();
		$i=0;
		while ($clinical_history->fetch()) {
		$serial_number=$clinical_history->id;//患者

		//最近一次随访病情稳定
		if($this->getLastIndividual($serial_number,$decision_time)=='1'){
		$i++;
		}
		}

		$clinical_history->free_statement();
		*/
		//$individual_core->free_statement();
		return $i;


	}
	/**
	 * 根据$serial_number找到最新的随访分类记录
	 *
	 * @param String $serial_number
	 * @return String
	 */
	private function getLastIndividual($serial_number,$decision_time){
		$schizophrenia =new Tschizophrenia();//精神分裂随访
		$schizophrenia->whereAdd("id='$serial_number'");
		$schizophrenia->whereAdd("fllowup_time<$decision_time");
		$schizophrenia->orderby("fllowup_time DESC");
		$schizophrenia->find(true);
		$followup_classification=$schizophrenia->followup_classification;//随访分类
		$schizophrenia->free_statement();
		return $followup_classification;//随访分类
	}
	/**
	 * 每年按照规范要求进行管理的确诊重性精神疾病患者数
	 * 
	 * 以下分别处理
	 * 1.年内死亡，3月内死亡1次随访 ，6月2次随访，9月3次随访，12月4次随访
	 * 2.确症后 3月1次随访，6月2次随访，9月3次随访，12月4次随访
	 *
	 * @param String $area_id
	 * @param int $decision_time
	 * @param int $start_decision_time
	 * @return String
	 */
	private function standard($area_id,$decision_time,$start_decision_time){
		$clinical_history = new Tclinical_history();//疾病确症
		$individual_core= new Tindividual_core();//个人档案
		$individual_status= new Tindividual_status();//个人档案档案状态
		$schizophrenia=new Tschizophrenia();//精神分裂随访
		$schizophrenia->selectAdd("count(schizophrenia.uuid) as snums,schizophrenia.id,min(schizophrenia.fllowup_time) as first_time");
		$schizophrenia->joinAdd('inner',$schizophrenia,$clinical_history,'id','id');
		$schizophrenia->joinAdd('inner',$schizophrenia,$individual_core,'id','uuid');
		$schizophrenia->joinAdd('inner',$schizophrenia,$individual_status,'id','id');
		$schizophrenia->groupby("schizophrenia.id");
		$schizophrenia->whereAdd("INSTR(individual_core.region_path,'$area_id')>0");//指定区域
		$schizophrenia->whereAdd("individual_status.status_flag=1");//档案状态时间
		$schizophrenia->whereAdd("individual_status.status_time<=$decision_time");//档案状态时间
		$schizophrenia->whereAdd("clinical_history.disease_date<=$decision_time or  clinical_history.disease_date is null");//确症结束时间
		$schizophrenia->whereAdd("clinical_history.disease_code=8");//确症为精神分裂

		//$year_time=adodb_mktime(0,0,0,1,1,adodb_date("Y",$decision_time));

		//添加起始时间20121108
		$schizophrenia->whereAdd("fllowup_time>=$start_decision_time");
		$schizophrenia->whereAdd("fllowup_time<=$decision_time");
		//$schizophrenia->debugLevel(3);
		//$number=$individual_core->count('DISTINCT individual_core.uuid');
		$schizophrenia->find();
		$number=0;
		$current_time=time();
		while ($schizophrenia->fetch())
		{

			if ($schizophrenia->snums>=floor(($decision_time/86400-$start_decision_time/86400)/90))
			{
				//规范管理数=随访数：一年做了四次随访、半年两次、三月一次
				$number++;
			}else{
				//死亡时间在统计时间段内
				$death_time=$this->individual_death_time($schizophrenia->id);//死亡时间
				if($death_time!=0){
					if ($schizophrenia->snums>=floor(($death_time/86400-$start_decision_time/86400)/90))
					{
						//随访数
						$number++;
					}
				}
			
				
				
				//确症时间在统计时间段内的情况
				$clinical_history_time=$this->clinical_history_time($schizophrenia->id);//确症时间
				if($start_decision_time<$clinical_history_time){
					//确症时间在统计时间内
					if ($schizophrenia->snums>=floor(($decision_time/86400-$clinical_history_time/86400)/90))
					{
						//随访数
						$number++;
					}
				}
			
				
				
			}
		}
		$individual_core->free_statement();
		$individual_status->free_statement();
		$clinical_history->free_statement();
		$schizophrenia->free_statement();
        //echo $number;
		return  $number;
	}
/**
 * 个人慢病确症时间
 *
 * @param string $id
 * @param string $mode_num
 * @return number
 */
	private function clinical_history_time($id,$mode_num='8'){
		$clinical_history=new Tclinical_history();
		$clinical_history->whereAdd("id='$id'");
		$clinical_history->whereAdd("disease_code='$mode_num'");
		$clinical_history->find(true);
		$result=0;//结果
		$result=$clinical_history->disease_date?$clinical_history->disease_date:0;//确症时间
		$clinical_history->free_statement();
		return $result;//确症时间
		
	}
	/**
	 * 时间段内所有档案状态和档案状态时间
	 *
	 * @param string $id

	 * @return int
	 */
	private function individual_death_time($id){
		$individual_status=new Tindividual_status();
		$individual_status->whereAdd("id='$id'");		
		//$individual_status->whereAdd("status_time>$start_time");
		//$individual_status->whereAdd("status_time<$end_time");
		$individual_status->whereAdd("status_flag='6'");//死亡

		$individual_status->find(true);
		$death_time=$individual_status->status_time?$individual_status->status_time:0;
		$individual_status->free_statement();
		return $death_time;

		
	}


	/**
		 * 根据region_path取得机构名
		 *
		 * @param string $region_path
		 * @return string
		 */
	private function getOrg($region_path){

		$organization=new Torganization();
		$organization->whereAdd("region_path	= '$region_path'");
		$organization->find();
		$organization->fetch();
		$zh_name=$organization->zh_name;
		$organization->free_statement();
		return $zh_name;
	}


}