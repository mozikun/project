<?php 
   /**
    * author  CT
    * created 2011.5.6
    * 用于完整率分段统计
    */
class decision_fullrateController extends controller{
	public function init(){
		require_once __SITEROOT.'library/privilege.php';
		require_once __SITEROOT.'library/Models/individual_core.php';
		require_once __SITEROOT.'library/Models/region.php';
		$this->view->basePath    =  __BASEPATH;
	}
	public function indexAction(){
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
		$arr   =   array('0.999-1'=>'100%','0.9-0.99'=>'90-99%','0.7-0.9'=>'70%-89%','0.6-0.7'=>'60-69%','0-0.6'=>'59%及以下');
		$numNumber = count($arr);
		//获取上级传来的父级ID
		$parentid     =    $this->_request->getParam('parentid');
		//获取当前登录进入这级的地区数据
		$regionId     = $this->user['region_id'];
		$p_id  = empty($parentid)?$regionId:$parentid;	
		if($p_id){
			$this->view->caching		=__CACHING;//开启缓存
		    $this->view->cache_lifetime	=__CACHING_LEFTTIME;//缓存时间
		    if(!$this->view->is_cached('index.html',$p_id.$time_tag.$real_start_time)){
		//echo $p_id;
		//导航栏
		    $this->view->currentarray    =   $arr;
			$this->view->arrNumber       =   $numNumber;
			$this->view->allNumber       =   $numNumber+3;
			$this->view->partical        =   $numNumber+2;
			$pathSel = new Tregion();
			$pathSel->whereAdd("id='$p_id'");
			$pathSel->find(true);
			$currentPath = $pathSel->region_path;//处理path
			$nuNumber = strpos($currentPath,$regionId);
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
			$this->view->rs   = $rs;
		 //循环遍历当前内容	
		$currentRegion = new Tregion();
		$currentRegion->whereAdd("id='$p_id'");
		$currentRegion->find(true);
		$needregion  = explode(',',$currentRegion->region_path);
		//限制级次,到镇那级
		$this->view->regionlevel  = count($needregion);
		if(count($needregion)<=5){
			$nextregion = new Tregion();
			$nextregion->whereAdd("p_id='$p_id'");
			$nextregion->find();
			$nextarr = array();
			$count   = 0;
			while($nextregion->fetch()){
				$nextarr[$count]['zh_name']   = $nextregion->zh_name;
				$nextarr[$count]['region_id'] = $nextregion->id;
				$sumnumber = 0;
				foreach($arr  as  $k=>$v){
				  $individualall = new Tindividual_core();
				  $individualall->whereAdd("region_path like '$nextregion->region_path%'");		
			      $condition =  explode('-',$k);
				  $individualall->whereAdd("criteria_rate >'$condition[0]'");
				  $individualall->whereAdd("criteria_rate<='$condition[1]'");
				  $individualall->whereAdd("created<='$time_tag'");
				  $individualall->whereAdd("created>='$real_start_time'");
				  $nextarr[$count]['mycount'][] = $individualall->count();
				  $sumnumber = $sumnumber+$individualall->count();
			     }   
			      $nextarr[$count]['sumnumber'] = $sumnumber;
			   //  var_dump($nextarr[$count]['mycount'][]);
				$count++;  
			 }		
			$this->view->row   = $nextarr;
		 }	
		  $this->view->add_need_id     = $p_id;
		 }
		}
		$this->view->display('index.html',$p_id.$time_tag.$real_start_time);
	}
}
?>