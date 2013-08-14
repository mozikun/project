<?php 
/**
 * 
 * @author ct
 * created:2010.11.25
 */
class decision_childrenController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
  		require_once __SITEROOT.'library/Models/individual_core.php';
  		require_once __SITEROOT.'library/Models/child_physical.php';
  		require_once __SITEROOT.'library/Models/child_physical_two.php';
  		require_once __SITEROOT.'library/Models/child_physical_age_three.php';
  		require_once __SITEROOT.'library/Models/child_visits.php';
  		require_once(__SITEROOT.'library/Models/region.php');
 		require_once __SITEROOT.'library/custom/adodb-time.inc.php';//引入时间处理
 		$this->view->basePath     = __BASEPATH;
	}
	public function indexAction(){
		 //默认当前时间
        $number_time = mktime(23,59,59,date("m",time()),date("d",time()),date("Y",time()));//2012-10-12
        $examina_date = $this->_request->getParam('decision_time');//由于框架的限制  这里为列表的结束时间
        $decision_time_a = $this->_request->getParam('end_time');//表单结束时间
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
        //echo $start_time;
        //结束的时间处理
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
		//处理时间0-6岁
		$needfirst_start = adodb_mktime(0,0,0,adodb_date("m",$real_start_time),adodb_date("d",$real_start_time),adodb_date("Y",$real_start_time));
		$needend_end_start   = adodb_mktime(0,0,0,adodb_date("m",$real_start_time),adodb_date("d",$real_start_time),adodb_date("Y",$real_start_time)-6);
		$needfirst_end = adodb_mktime(0,0,0,adodb_date("m",$time_tag),adodb_date("d",$time_tag),adodb_date("Y",$time_tag));
		$needend_end_end   = adodb_mktime(0,0,0,adodb_date("m",$time_tag),adodb_date("d",$time_tag),adodb_date("Y",$time_tag)-6);
		//顶部地区导航条
		$current_region_id   = $this->user['region_id'];
		//取当前登录的这级的p_id
		$now_region = new Tregion();
		$now_region->whereAdd("id='$current_region_id'");
		$now_region->find(true);
		$current_pid = $now_region->p_id;
		$nextRegionId        = $this->_request->getParam('parent_id');
		$p_id = empty($nextRegionId)?$current_region_id:$nextRegionId;
		$this->view->caching		=__CACHING;//开启缓存
		$this->view->cache_lifetime	=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('list.html',$p_id.$time_tag)){
		$nav_string='';
		$pathSel = new Tregion();
		$pathSel->whereAdd("id='$p_id'");
		$pathSel->find(true);
		$currentPath = $pathSel->region_path;//处理path
		//取得当前地区的上一级的path
		$last_region = new Tregion();
		$last_region->whereAdd("id='$current_pid'");
		$last_region->find(true);
		$last_region_path = str_replace($last_region->region_path.',','',$currentPath);
		$pathArray = explode(',',$last_region_path);
		foreach ($pathArray as $k=>$v)
		{
			$myregion = new Tregion();
			$myregion->whereAdd("id='$v'");
			$myregion->whereAdd("id<>0");
			$myregion->find(true);
			if($p_id==$v)
			{
				$nav_string.= '<a href="'.__BASEPATH.'decision/children/index/parent_id/'.$v.'"><strong><font color="red">'.$myregion->zh_name.'</font></a>';
			}
			else
			{
				$nav_string.= '<a href="'.__BASEPATH.'decision/children/index/parent_id/'.$v.'">'.$myregion->zh_name.'</a>&nbsp;->&nbsp;';
			}
		} 
		$this->view->nav_string = $nav_string;
		//获取下一级的地区
		$currentregion = new Tregion();
		$currentregion->whereAdd("p_id='$p_id'");
		$currentregion->orderby("id ASC");
		$currentregion->find();
		$row = array();
		$count = 0 ;
		$all_count_children=0;//应管理儿童数
		$all_count_once=0;//一次以上随访数
		while($currentregion->fetch()){
			$row[$count]['zh_name'] = $currentregion->zh_name;
			$row[$count]['id']      = $currentregion->id;
			$individual_core = new Tindividual_core();
			$individual_core->query("select count(*) as a from ((select individual_core.uuid from individual_core where individual_core.region_path like '$currentregion->region_path%'  and (individual_core.date_of_birth >= '$needend_end_start' and individual_core.date_of_birth <= '$needfirst_start') and individual_core.uuid in (SELECT  CHILD_PHYSICAL.id from CHILD_PHYSICAL where CHILD_PHYSICAL.created>='$real_start_time' and CHILD_PHYSICAL.created <= '$time_tag' union SELECT  CHILD_VISITS.id from CHILD_VISITS where CHILD_VISITS.created>='$real_start_time' and CHILD_VISITS.created <= '$time_tag' union SELECT  CHILD_PHYSICAL_TWO.id from CHILD_PHYSICAL_TWO where CHILD_PHYSICAL_TWO.created>='$real_start_time' and CHILD_PHYSICAL_TWO.created <= '$time_tag' union SELECT  CHILD_PHYSICAL_AGE_THREE.id from CHILD_PHYSICAL_AGE_THREE where CHILD_PHYSICAL_AGE_THREE.created>='$real_start_time' and CHILD_PHYSICAL_AGE_THREE.created <= '$time_tag')) union (select individual_core.uuid as b from individual_core where individual_core.region_path like '$currentregion->region_path%'  and (individual_core.date_of_birth >= '$needend_end_end' and individual_core.date_of_birth <= '$needfirst_end') and uuid in (SELECT  CHILD_PHYSICAL.id from CHILD_PHYSICAL where CHILD_PHYSICAL.created>='$real_start_time' and CHILD_PHYSICAL.created <= '$time_tag' union SELECT  CHILD_VISITS.id from CHILD_VISITS where CHILD_VISITS.created>='$real_start_time' and CHILD_VISITS.created <= '$time_tag' union SELECT  CHILD_PHYSICAL_TWO.id from CHILD_PHYSICAL_TWO where CHILD_PHYSICAL_TWO.created>='$real_start_time' and CHILD_PHYSICAL_TWO.created <= '$time_tag' union SELECT  CHILD_PHYSICAL_AGE_THREE.id from CHILD_PHYSICAL_AGE_THREE where CHILD_PHYSICAL_AGE_THREE.created>='$real_start_time' and CHILD_PHYSICAL_AGE_THREE.created <= '$time_tag')))");
            $individual_core->fetch();
            $child_all_number = $individual_core->a;
            $all_count_once+=$child_all_number;
            //查询所有的符合条件的儿童数
			$ihall                       = new Tindividual_core();
			$ihall->whereAdd("region_path like '$currentregion->region_path%'");
			$ihall->whereAdd("date_of_birth between '$needend_end_start' and '$needfirst_start' or date_of_birth between '$needend_end_end' and '$needfirst_end'");
			$ihall->whereAdd("status_flag='1'");
			$all_count=$ihall->count();
			$all_count_children+=$all_count;//年度辖区内应管理的0～6岁儿童数（统计时间段内）
			$row[$count]['all_count']=$all_count; 
			$row[$count]['management_count']=$child_all_number; //已管理人数
//			合并符合条件的数组
//			$realcountnow = count(array_unique(array_merge($real_visit,$real_physical_age_three,$real_physical_two,$real_physical)));
			//计算百分率
			$row[$count]['percent'] = $all_count==0?0.00:number_format(($child_all_number)/$all_count*100,2);
			$count++;
		}
		$currentregion->free_statement();
		$this->view->row = $row;
		$this->view->all_count_children=$all_count_children;//就管理儿童总数
		$this->view->all_count_once=$all_count_once;//1次及以上随访数
		$this->view->children_percent=$all_count_children==0?0.00:number_format($all_count_once/$all_count_children*100,2);//儿童健康管理率(%)
    	
		}
		$this->view->display('list.html',$p_id.$time_tag);
	}
}
?>