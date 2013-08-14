<?php
/**

*/
class decision_etController extends controller
{
	//此级别以下的用like 以上的用instr
	public $optimizerRegion=4;
	/**
	 * 等同于构造函数
	 */
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/region_ext_1.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/individual_core.php');
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/examination_table.php";

		$this->view->assign("baseUrl",__BASEPATH);
		$this->view->assign( "basePath", __BASEPATH );
	}
	/**
	 * 建档率列表
	 */
	public function listAction(){
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
		//获取需要添加类别的当前父ID
		$p_id = $this->_request->getParam('parent_id','');
		$errorMessage = $this->_request->getParam('errorMessage','');
		//var_dump($this->user);
		$regionDomain = $this->user['region_id'];
		//echo $$regionDomain;
		$p_id = empty($p_id)?$regionDomain:$p_id;
		
		$this->view->caching		=__CACHING;//开启缓存
		$this->view->cache_lifetime	=__CACHING_LEFTTIME;//缓存时间
		//var_dump($this->view->is_cached('list.html',$p_id));
		if(!$this->view->is_cached('list.html',$p_id.$time_tag.$real_start_time)){
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			//$region->limit($startnum,__ROWSOFPAGE);
			//$region->debugLevel(9);
			$region->find();
			$row = array();
			$rowCount = 0;
			$sum_population=0;
			$sum_archive=0;
			$sum_archive_last_year=0;
			while($region->fetch()){
				$row[$rowCount]['id'] = trim($region->id);
				$row[$rowCount]['zh_name'] = $region->zh_name;
				$row[$rowCount]['region_path'] = $region->region_path;
				$row[$rowCount]['standard_code'] = $region->standard_code;
				$row[$rowCount]['p_id'] = trim($region->p_id);
				$row[$rowCount]['standard_code'] = trim($region->standard_code);
				$current_level = count(explode(',',$region->region_path));
				//select a.region_id,a.population,a.region_year,b.region_id,b.population,b.region_year from region_ext_1 a left join region_ext_1 b on a.region_id=b.region_id and a.region_year>=b.region_year ;
				//人口总数
				//镇以上地区
				if($current_level<6){
					$region1=new Tregion();
					$region1->selectAdd("id,region_path");
					$region1->whereAdd("region_path like '".$region->region_path."%'");
					//$region1->debugLevel(9);
					$region1->find();
					//$child_region='';
					$sum_population1=0;
					while ($region1->fetch()){
						$temp_level = count(explode(',',$region1->region_path));
						//echo $temp_level;
						//echo "<br />";
						if($temp_level==6){
							$region_ext_1=new Tregion_ext_1();
							$region_ext_1->selectAdd("population");
							$region_ext_1->whereAdd("region_id='$region1->id'");
							$region_ext_1->whereAdd("region_year>0");
							$region_ext_1->orderby("region_year desc");
							$region_ext_1->find(true);
							$sum_population1=$sum_population1+$region_ext_1->population;
						}
					}

					$row[$rowCount]['population'] =$sum_population1;
					$population=$sum_population1;
					$sum_population=$sum_population+$sum_population1;
					$this->view->td_title='1';
				}
				//echo $region->zh_name;
				//echo "<br />";
				if($current_level==6){
					$region_ext_1=new Tregion_ext_1();
					$region2=new Tregion();
					$org=new Torganization();
					$region_ext_1->joinAdd("inner",$region_ext_1,$region2,"region_id","id");
					$region_ext_1->joinAdd("inner",$region2,$org,'region_path','region_path');
					$region_ext_1->whereAdd("region_id='$region->id'");
					$region_ext_1->orderby("region_year desc");
					//$region_ext_1->debugLevel(9);
					$region_ext_1->find(true);
					$population=$region_ext_1->population;
					$row[$rowCount]['population'] =$population;
					$row[$rowCount]['org_zh_name'] =$org->zh_name;
					$sum_population=$sum_population+$population;
					$this->view->td_title='2';
				}
				//健康体检表总建档数(指的是健康体检表中id不一样的，如果同一个人的多次体检只算一次)
				$individual_core=new Tindividual_core();
				$individual_core->whereAdd("uuid in (select distinct id from examination_table where created<=$time_tag) and region_path like '$region->region_path%' and status_flag='1'");	
				$temp_all=$individual_core->count();
				$row[$rowCount]['archive']=$temp_all;
				$sum_archive=$sum_archive+$temp_all;
				@$archive_rate=$temp_all/$population;
				$row[$rowCount]['archive_rate']=round(($archive_rate)*100,2);//总建档率
				//取统计时间段内的健康体检数(一年内体检数)
				$individual_core_new=new Tindividual_core();
				$individual_core_new->whereAdd("uuid in (select distinct id from examination_table where created>='$real_start_time' and created<='$time_tag') and status_flag='1' and region_path like '$region->region_path%'");
				$temp_last=$individual_core_new->count();
				$row[$rowCount]['archive_last_year']=$temp_last;
				$sum_archive_last_year=$sum_archive_last_year+$temp_last;
				//统计时间段内体检率=统计时间段内新体检数/地区人口数（统计时间段内）
				@$archive_rate_last_year=$temp_last/$population;
				$row[$rowCount]['archive_rate_last_year']=round(($archive_rate_last_year)*100,2);

				$rowCount++;


			}
			$this->view->assign('row',$row);
			$this->view->assign('sum_population',$sum_population);
			$this->view->assign('sum_archive',$sum_archive);
			@$this->view->assign('sum_archive_rate',round(($sum_archive/$sum_population)*100,2));
			$this->view->assign('sum_archive_last_year',$sum_archive_last_year);
			@$this->view->assign('sum_archive_rate_last_year',round(($sum_archive_last_year/$sum_population)*100,2));
			$this->view->assign('add_need_id',$p_id);
			$this->view->assign('basePath',__BASEPATH);
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
		$this->view->display('list.html',$p_id.$time_tag.$real_start_time);
	}
}
?>