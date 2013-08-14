<?php
/**
 * 决策综合统计面板-慢病统计
 *
 */
class admindecision_cmController extends controller{
	public function  init(){
		set_time_limit(0);
		require_once(__SITEROOT.'library/Myauth.php');
		$this->auth = Zend_Auth::getInstance();

		if ($this->auth->hasIdentity()) {
			$this->user = $this->auth->getIdentity();
			//print_r($this->user);
		}else{
			//退出
			$this->redirect(__BASEPATH."loging/index/index");
		}

		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'/library/Models/clinical_history.php';//慢病确症表
		require_once __SITEROOT.'/library/Models/individual_core.php';//个人档案表
		$this->cache_time=__CACHING_LEFTTIME;
		$this->view->basePath = $this->_request->getBasePath();

	}
	/**
	 * 测试页面
	 *
	 */
	public function indexAction(){

		$region_id				= $this->_request->getParam('region_id');//
		$region_id				= $region_id?$region_id:$this->user['region_id'];//取得机构号
		$this->view->regioin_id	= $region_id;
		$this->view->display("index.html");
	}
	/**
	 * 高血压柱状图--管理人数（来自已建档确诊高血压患者数）　规范管理率
	 *
	 */
	public function barhyAction(){
		//exit();
		$action=$this->_request->getParam("action");
		require_once(__SITEROOT."application/admindecision/models/region_func.php");//
		$region_id			= $this->_request->getParam('region_id');//
		$region_id			= $region_id?$region_id:$this->user['region_id'];//取得机构号
		$end_time			= $this->_request->getParam('end_time');//
		$end_time			= $end_time?strtotime($end_time):mktime(24,0,0,date('m'),date('d'),date('Y'));//结束时间
		$row=$this->getDataHy($region_id,$end_time);
		$num		= array();//管理人数
		$rate_num	= array();//规范管理人数
		$rate		= array();//规范管理率
		$regioin_name=array();//机构名
		foreach ($row as $arr){
			$num[]			=$arr['num'];
			$rate_num[]		=$arr['rate_num'];
			$rate[]			=$arr['rate'];
			$regioin_name[]	=$arr['zh_name'];
		}
		
		$x_array=$regioin_name;//机构名
		//高血压管理人数
		if($action=="num"){
			$data[0]=$num;
		$data[0]['axisname']="管理人数";
			echo xml_draw_3d_bar($data,$x_array,"人",array('人','人'),"高血压","3d column",170,184);

		}
		//高血压规范管理率
		if($action=="rate"){
			$data[0]=$rate;
		    $data[0]['axisname']="规范管理率";
			echo xml_draw_3d_bar($data,$x_array,"人",array('%'),"高血压","3d column",170,184);
		}
		exit;
	}
	/**
	 * 列表--高血压
	 *
	 */
	public function listhyAction(){
		//exit();
		require_once(__SITEROOT."application/admindecision/models/region_func.php");//
		$region_id			= $this->_request->getParam('region_id');//
		$region_id			= $region_id?$region_id:$this->user['region_id'];//取得机构号
		$end_time			= $this->_request->getParam('end_time');//
		$end_time			= $end_time?strtotime($end_time):mktime(24,0,0,date('m'),date('d'),date('Y'));//结束时间
		$row				= $this->getDataHy($region_id,$end_time);
		$total_rate=0;//总管理人数
		$total_num=0;//总人数
		//print_r($row);
		foreach ($row as $arr){
			$total_num		+=$arr['num'];
			$total_rate		+=$arr['rate_num'];

		}

		$this->view->row=$row;
		$total_rate=$total_num==0?0:round($total_rate/$total_num*100);
		$this->view->total_num=$total_num;
		$this->view->total_rate=$total_rate;
		$this->view->cm_name="高血压";
		//print_r($row);
		$this->view->display("list.html");
	}
	/**
	 * 读取高血压数据
	 *
	 * @param string $region_id
	 * @param number $end_time
	 * @return array
	 */
	private function getDataHy($region_id,$end_time){
		$file_md5=md5($region_id.$end_time);
		$filename=__SITEROOT."cache/admindecision_cmhy_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
		{
			$region_array		= getRegionArray($region_id);//取得下一级所有机构信息
			$region_name_array=array();//机构名数组
			$num_array=array();//管理人数
			$rate_array=array();//规范管理率
			$data_array=array();//返回结果


			$region_array		= getRegionArray($region_id);//取得下一级所有机构信息
			//$region_name_array=array();//机构名数组
			//$num_array=array();//管理人数
			//$rate_array=array();//规范管理率
			$row=array();
			$i=0;

			foreach ($region_array as $k=>$region_arr){


				$clinical_history		= new Tclinical_history();
				$individual_core		= new Tindividual_core();
				$clinical_history->joinAdd('left',$clinical_history,$individual_core,'id','uuid');
				$clinical_history->whereAdd("disease_date<$end_time");//确症时间小于结束时间
				$clinical_history->whereAdd("disease_code=2");//高血压
				$clinical_history->whereAdd("disease_state=1");//确症
				$clinical_history->whereAdd("individual_core.individual_core.region_path like '".$region_arr['region_path']."%'");
				//$clinical_history->debugLevel(3);
				$num				= $clinical_history->count("*");//确症人数
				//exit();
				$row[$i]['zh_name']	= $region_arr['zh_name'];//机构名
				$row[$i]['num']		= $num;
				//$rate				= standard($region_arr['region_path'],'hypertension_follow_up','follow_time',$end_time,2);//规范管理数
				$rate				= rand(0,$num);
				$row[$i]['rate_num']=$rate;
				//echo $rate.'++';
				$row[$i]['rate']	= $num==0?0:round($rate/$num*100);//规范管理
				//$total_num+=$num;//总的确症人数
				//$total_rate+=$rate;//总的规范管理数
				$i++;
			}
			create_php_cache($filename,$row);
		}else {
			require($filename);
			$row=$rows;

		}
		return $row;
	}
	/**
	 * 糖尿病-柱状图
	 *
	 */
	public function bardiAction(){
		//exit();
		$action			= $this->_request->getParam('action');//
		require_once(__SITEROOT."application/admindecision/models/region_func.php");//
		$region_id			= $this->_request->getParam('region_id');//
		$region_id			= $region_id?$region_id:$this->user['region_id'];//取得机构号
		$end_time			= $this->_request->getParam('end_time');//
		$end_time			= $end_time?strtotime($end_time):mktime(24,0,0,date('m'),date('d'),date('Y'));//结束时间
		$row=$this->getDataDi($region_id,$end_time);
		$num		= array();//管理人数
		$rate_num	= array();//规范管理人数
		$rate		= array();//规范管理率
		$regioin_name=array();//机构名
		foreach ($row as $arr){
			$num[]			=$arr['num'];
			$rate_num[]		=$arr['rate_num'];
			$rate[]			=$arr['rate'];
			$regioin_name[]	=$arr['zh_name'];
		}
		$x_array=$regioin_name;//机构名
		if($action=="num"){
			$data[0]=$num;
			$data[0]['axisname']="管理人数";
			echo xml_draw_3d_bar($data,$x_array,"人",array('人'),"糖尿病","3d column",170,212);
		}
		if($action=="rate"){	
			$data[0]=$rate;
			$data[0]['axisname']="规范管理率";
			
			echo xml_draw_3d_bar($data,$x_array,"人",array('%'),"糖尿病","3d column",170,212);
		}	
		exit;
	}

	/**
	 * 列表--糖尿病
	 *
	 */
	public function listdiAction(){

		require_once(__SITEROOT."application/admindecision/models/region_func.php");//
		$region_id			= $this->_request->getParam('region_id');//
		$region_id			= $region_id?$region_id:$this->user['region_id'];//取得机构号
		$end_time			= $this->_request->getParam('end_time');//
		$end_time			= $end_time?strtotime($end_time):mktime(24,0,0,date('m'),date('d'),date('Y'));//结束时间
		$row				= $this->getDataDi($region_id,$end_time);
		$total_rate=0;//总管理人数
		$total_num=0;//总人数
		//print_r($row);
		foreach ($row as $arr){
			$total_num		+=$arr['num'];
			$total_rate		+=$arr['rate_num'];

		}
		$this->view->row=$row;
		$total_rate=$total_num==0?0:round($total_rate/$total_num*100);
		$this->view->total_num=$total_num;
		$this->view->total_rate=$total_rate;
		$this->view->cm_name="糖尿病";
		//print_r($row);
		$this->view->display("list.html");
	}
	/**
	 * 读取糖尿病数据
	 *
	 * @param string $region_id
	 * @param number $end_time
	 * @return array
	 */
	private function getDataDi($region_id,$end_time){
		
		$file_md5=md5($region_id.$end_time);
		$filename=__SITEROOT."cache/admindecision_cmdi_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
		{
			$region_array		= getRegionArray($region_id);//取得下一级所有机构信息
			//$region_name_array=array();//机构名数组
			//$num_array=array();//管理人数
			//$rate_array=array();//规范管理率
			$row=array();
			$i=0;

			foreach ($region_array as $k=>$region_arr){


				$clinical_history		= new Tclinical_history();
				$individual_core		= new Tindividual_core();
				$clinical_history->joinAdd('left',$clinical_history,$individual_core,'id','uuid');
				$clinical_history->whereAdd("disease_code=3");//糖尿病
				$clinical_history->whereAdd("disease_state=1");//确症
				$clinical_history->whereAdd("region_path like '".$region_arr['region_path']."%'");
				$clinical_history->whereAdd("disease_date<$end_time");//确症时间小于结束时间
				//$clinical_history->debugLevel(3);
				$num				= $clinical_history->count("*");//确症人数
				$row[$i]['zh_name']	= $region_arr['zh_name'];//机构名
				$row[$i]['num']		= $num;
				//$rate				= standard($region_arr['region_path'],'diabetes_core','followup_time',$end_time,3);//规范管理数
				$rate				= rand(0,$num);
				$row[$i]['rate_num']=$rate;
				$row[$i]['rate']	= $num==0?0:round($rate/$num*100);//规范管理

				$i++;
			}
			create_php_cache($filename,$row);
		}else {
			require($filename);
			$row=$rows;

		}
		return $row;
	}
	//====================================
	/**
	 * 重性精神分裂柱状图
	 *
	 */
	public function barscAction(){
		//exit();
		$action			= $this->_request->getParam('action');//
		require_once(__SITEROOT."application/admindecision/models/region_func.php");//
		$region_id			= $this->_request->getParam('region_id');//
		$region_id			= $region_id?$region_id:$this->user['region_id'];//取得机构号
		$end_time			= $this->_request->getParam('end_time');//
		$end_time			= $end_time?strtotime($end_time):mktime(24,0,0,date('m'),date('d'),date('Y'));//结束时间
		$row=$this->getDataSc($region_id,$end_time);
		$num		= array();//管理人数
		$rate_num	= array();//规范管理人数
		$rate		= array();//规范管理率
		$regioin_name=array();//机构名
		foreach ($row as $arr){
			$num[]			=$arr['num'];
			$rate_num[]		=$arr['rate_num'];
			$rate[]			=$arr['rate'];
			$regioin_name[]	=$arr['zh_name'];
		}
		$x_array=$regioin_name;//机构名
		if($action=="num"){
			$data[0]=$num;
			$data[0]['axisname']="管理人数";
			echo xml_draw_3d_bar($data,$x_array,"人",array('人'),"重性精神分裂","3d column",170,212);
		}
		if($action=="rate"){
		$data[0]=$rate;
		$data[0]['axisname']="规范管理率";
		echo xml_draw_3d_bar($data,$x_array,"人",array('%'),"重性精神分裂","3d column",170,212);
		}
		
		
		exit;
	}


	/**
	 * 列表--重性精神分裂
	 *
	 */
	public function listscAction(){

		require_once(__SITEROOT."application/admindecision/models/region_func.php");//
		$region_id			= $this->_request->getParam('region_id');//
		$region_id			= $region_id?$region_id:$this->user['region_id'];//取得机构号
		$end_time			= $this->_request->getParam('end_time');//
		$end_time			= $end_time?strtotime($end_time):mktime(24,0,0,date('m'),date('d'),date('Y'));//结束时间
		$row				= $this->getDataSc($region_id,$end_time);
		$total_rate=0;//总管理人数
		$total_num=0;//总人数
		//print_r($row);
		foreach ($row as $arr){
			$total_num		+=$arr['num'];
			$total_rate		+=$arr['rate_num'];

		}

		$this->view->row=$row;
		$total_rate=$total_num==0?0:round($total_rate/$total_num*100);
		$this->view->total_num=$total_num;
		$this->view->total_rate=$total_rate;
		$this->view->cm_name="重性精神分裂";
		//print_r($row);
		$this->view->display("list.html");

	}
	/**
	 * 读取精神分裂数据
	 *
	 * @param string $region_id
	 * @param number $end_time
	 * @return array
	 */
	private function getDataSc($region_id,$end_time){
		$file_md5=md5($region_id.$end_time);
		$filename=__SITEROOT."cache/admindecision_cmsc_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
		{
			$region_array		= getRegionArray($region_id);//取得下一级所有机构信息
			//$region_name_array=array();//机构名数组
			//$num_array=array();//管理人数
			//$rate_array=array();//规范管理率
			$row=array();
			$i=0;

			foreach ($region_array as $k=>$region_arr){


				$clinical_history		= new Tclinical_history();
				$individual_core		= new Tindividual_core();
				$clinical_history->joinAdd('left',$clinical_history,$individual_core,'id','uuid');
				$clinical_history->whereAdd("disease_code=8");//重性精神分裂
				$clinical_history->whereAdd("disease_state=1");//确症
				$clinical_history->whereAdd("region_path like '".$region_arr['region_path']."%'");
				$clinical_history->whereAdd("disease_date<$end_time");//确症时间小于结束时间
				//$clinical_history->debugLevel(3);
				$num				= $clinical_history->count("*");//确症人数
				$row[$i]['zh_name']	= $region_arr['zh_name'];//机构名
				$row[$i]['num']		= $num;
				//$rate				= standard($region_arr['region_path'],'schizophrenia','fllowup_time',$end_time,8);//规范管理数
				$rate				= rand(0,$num);
				$row[$i]['rate_num']=$rate;
				$row[$i]['rate']	= $num==0?0:round($rate/$num*100);//规范管理

				$i++;
			}
			create_php_cache($filename,$row);
		}else {
			require($filename);
			$row=$rows;

		}
		return $row;
	}
	//================================
	/**
	 * 地区健康体检统计表-饼状图
	 *
	 */
	public function pieAction()
	{
		//exit();
		require_once(__SITEROOT."application/admindecision/models/region_func.php");//
		require_once __SITEROOT.'/library/Models/examination_table.php';//体检表
		$region_id			= $this->_request->getParam('region_id');//
		$region_id			= $region_id?$region_id:$this->user['region_id'];//取得机构号
		$start_time			= $this->_request->getParam('start_time');//开始时间
		$end_time			= $this->_request->getParam('end_time');//结束时间
		$start_time			= $start_time?strtotime($start_time):strtotime('-6 year');//默认今年1月1日
		$end_time			= $end_time?strtotime($end_time):mktime(24,0,0,date('m'),date('d'),date('Y'));//结束时间
		$row=$this->getDataEt($region_id,$start_time,$end_time);
		$num		= array();//人数
		//print_r($row);
		$regioin_name=array();//机构名
		$i=0;
		foreach ($row as $arr){
			$num[$i][$i]			=$arr['num'];
			$num[$i]['axisname']=$arr['zh_name'];
			//$rate[]			=$arr['rate'];
			//$regioin_name[]	=$arr['zh_name'];
			$i++;
		}

		$x_array=array("");
		echo xml_draw_3d_bar($num,$x_array,"人数","人","健康体检统计表柱状图","3d column",341,184);
		exit;
	}
	/**
	 * 地区健康体检统计表列表
	 *
	 */
	public function pielistAction()
	{
		//exit();
		require_once(__SITEROOT."application/admindecision/models/region_func.php");//
		require_once __SITEROOT.'/library/Models/examination_table.php';//体检表
		$region_id			= $this->_request->getParam('region_id');//
		$region_id			= $region_id?$region_id:$this->user['region_id'];//取得机构号
		$start_time			= $this->_request->getParam('start_time');//开始时间
		$end_time			= $this->_request->getParam('end_time');//结束时间
		$start_time			= $start_time?strtotime($start_time):strtotime('-6 year');//默认今年1月1日
		$end_time			= $end_time?strtotime($end_time):mktime(24,0,0,date('m'),date('d'),date('Y'));//结束时间
		$row				= $this->getDataEt($region_id,$start_time,$end_time);

		$total_num=0;//总人数
		//print_r($row);
		foreach ($row as $arr){
			$total_num		+=$arr['num'];

		}

		$this->view->row			=$row;
		$this->view->total_num		= $total_num;
		$this->view->display("pie_list.html");
	}
	/**
	 * 读取体格检查数据
	 *
	 * @param string $region_id
	 * @param number $start_time
	 * @param number $end_time
	 * @return array
	 */
	private function getDataEt($region_id,$start_time,$end_time){
		$file_md5=md5($region_id.$start_time.$end_time);
		$filename=__SITEROOT."cache/admindecision_cmet_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
		{
			$region_array		= getRegionArray($region_id);//取得下一级所有机构信息
			//$total_num			= 0;//体检总数
			$row				= array();
			$i=0;
			foreach ($region_array as $k=>$region_arr){


				$examination_table		= new Texamination_table();
				$individual_core		= new Tindividual_core();
				$examination_table->joinAdd('left',$examination_table,$individual_core,'id','uuid');
				$examination_table->whereAdd("region_path like '".$region_arr['region_path']."%'");
				$examination_table->whereAdd("examination_table.created>$start_time");
				$examination_table->whereAdd("examination_table.created<$end_time");
				//$examination_table->debugLevel(3);
				$num					= $examination_table->count("Distinct id");//体检人数

				$row[$i]['num']			=$num;//体检人数
				$row[$i]['zh_name']		= $region_arr['zh_name'];//机构名
				//$total_num+=$num;//总体检数
				$i++;
			}
			create_php_cache($filename,$row);
		}else {
			require($filename);
			$row=$rows;

		}
		return $row;
	}

}