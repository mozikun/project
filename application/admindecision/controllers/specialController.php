<?php
/**
 * 特殊人群统计
 * @author 我好笨
 */
class admindecision_specialController extends controller 
{
	private $regionDomain;
	private $start_time;
	private $end_time;
	private $p_id;
	private $cache_time=__CACHING_LEFTTIME;
	public function init()
	{
		set_time_limit(0);
		//require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/et_general_condition.php";
		require_once __SITEROOT."library/Models/child_physical.php";
		require_once __SITEROOT."library/Models/child_physical_age_three.php";
		require_once __SITEROOT."library/Models/child_physical_two.php";
		require_once __SITEROOT."library/Models/child_visits.php";
		require_once __SITEROOT."library/Models/prenatal_visit_first.php";
		require_once __SITEROOT."library/Models/prenatal_visit_two.php";
		require_once __SITEROOT."library/Models/postpartum_visit.php";
		require_once __SITEROOT."library/Models/postpartum_heathcheck.php";
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once(__SITEROOT.'library/MyAuth.php');
		$this->auth = Zend_Auth::getInstance();
		if ($this->auth->hasIdentity()) {
			$this->user = $this->auth->getIdentity();
			//print_r($this->user);
		}else{
			//退出
			$this->redirect(__BASEPATH."loging/index/index");		
		}
		$this->view->basePath = $this->_request->getBasePath();
		$this->regionDomain = $this->user['region_id'];
		//获取父分类ID，选择下级分类的时候需要
		$start_time=$this->_request->getParam('start_time')?$this->_request->getParam('start_time'):'2000-01-01';
		$end_time=$this->_request->getParam('end_time')?$this->_request->getParam('end_time'):date("Y-m-d");
		$this->view->assign('start_time',$start_time);
		$this->view->assign('end_time',$end_time);
		$this->start_time=strtotime($start_time);
		$this->end_time=strtotime($end_time)+(24*3600);
		$p_id = $this->_request->getParam('region_id','');
		$this->p_id = empty($p_id)?$this->regionDomain:$p_id;
		$this->getdata($this->regionDomain,$this->start_time,$this->end_time,$this->p_id);
	}
	public function indexAction()
	{
		$this->view->assign('basePath',__BASEPATH);
		$this->view->display("index.html");
	}
	//输出列表
	public function listAction()
	{
		$row=$this->getdata($this->regionDomain,$this->start_time,$this->end_time,$this->p_id);
		$this->view->assign("sum_older",$row['total']['sum_older']);
		$this->view->assign("sum_child",$row['total']['sum_child']);
		$this->view->assign("sum_maternal",$row['total']['sum_maternal']);
		unset($row['total']);
		$this->view->assign("row",$row);
		$this->view->display("list.html");
	}
	//柱形图
	public function barAction()
	{
		$pic_name="特殊人群健康管理柱形图";
		$row=$this->getdata($this->regionDomain,$this->start_time,$this->end_time,$this->p_id);
		unset($row['total']);
		$data=array();
		$i=0;
		foreach ($row as $k=>$v)
		{
			$data[0][$k]=$v['sum_older'];
			$data[0]['axisname']="老年人健康\r管理次数";
			$data[1][$k]=$v['sum_child'];
			$data[1]['axisname']="儿童健康\r管理次数";
			$data[2][$k]=$v['sum_maternal'];
			$data[2]['axisname']="孕产妇健\r康管理次数";
			$x_array[]=$v['zh_name'];
		}
		echo xml_draw_3d_bar($data,$x_array,"人数","人",$pic_name,"3d column",330,229);
		exit;
	}
	//饼形图
	public function pieAction()
	{
		$type=$this->_request->getParam('type')?$this->_request->getParam('type'):"older";
		$row=$this->getdata($this->regionDomain,$this->start_time,$this->end_time,$this->p_id);
		unset($row['total']);
		$data=array();
		$i=0;
		$type_array=array("older"=>"老年人健康管理次数","child"=>"儿童健康管理次数","maternal"=>"孕产妇健康管理次数");
		$token=0;//标致是否数值为零
		foreach ($row as $k=>$v)
		{
			$data[$k][$k]=$v['sum_'.$type];
			if($v['sum_'.$type]!=0){
				$token=1;
			}
			$data[$k]['axisname']=$v['zh_name'];
			$x_array[]=$v['zh_name'];
		}
		$token_token=$type.'_token';
		$this->view->$token_token = $token;//处理饼图值全为0的情况
		$token_name=$type.'_name';
		$this->view->$token_name = $type_array["$type"].'为空！';//模块名为空

		echo xml_draw_3d_pie($data,$x_array,"人数","人",$type_array[$type]."饼形图",341,229);
		
		exit;
	}
	//线性图
	public function lineAction()
	{
		
	}
	//取数据
	private function getdata($regionDomain,$start_time,$end_time,$p_id)
	{
		$file_md5=md5($regionDomain.$start_time.$end_time.$p_id);
		$filename=__SITEROOT."cache/admindecision_special_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
		{
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			$region->find();
			$row = array();
			$rowCount=0;
			$sum_older=0;//老年人健康管理数
			$sum_child=0;//儿童健康管理数
			$sum_maternal=0;//孕产妇健康管理数
			while($region->fetch())
			{
				$row[$rowCount]['id'] = trim($region->id);
				$row[$rowCount]['zh_name'] = $region->zh_name;
				$row[$rowCount]['region_path'] = $region->region_path;
				$row[$rowCount]['p_id'] = trim($region->p_id);
				$row[$rowCount]['standard_code'] = trim($region->standard_code);
				$current_level = count(explode(',',$region->region_path));
				//取老年人健康管理次数　儿童健康管理次数  孕产妇健康管理次数 统计数据
				$sum_older_temp=0;
				$et_general_condition=new Tet_general_condition();
				$individual_core=new Tindividual_core();
				$et_general_condition->joinAdd('left',$et_general_condition,$individual_core,'id','uuid');
				$et_general_condition->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$et_general_condition->whereAdd("et_general_condition.elder_health_status is not null");
				$et_general_condition->whereAdd("et_general_condition.created >='$start_time'");
				$et_general_condition->whereAdd("et_general_condition.created <='$end_time'");
				$sum_older_temp=$et_general_condition->count("et_general_condition.id");
				$row[$rowCount]['sum_older'] = $sum_older_temp;
				$sum_older+=$sum_older_temp;
				
				//儿童
				$sum_child_physical=0;
				$child_physical=new Tchild_physical();
				$individual_core=new Tindividual_core();
				$child_physical->joinAdd('left',$child_physical,$individual_core,'id','uuid');
				$child_physical->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$child_physical->whereAdd("child_physical.created >='$start_time'");
				$child_physical->whereAdd("child_physical.created <='$end_time'");
				$sum_child_physical=$child_physical->count();
				
				$sum_child_physical_age_three=0;
				$child_physical_age_three=new Tchild_physical_age_three();
				$individual_core=new Tindividual_core();
				$child_physical_age_three->joinAdd('left',$child_physical_age_three,$individual_core,'id','uuid');
				$child_physical_age_three->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$child_physical_age_three->whereAdd("child_physical_age_three.created >='$start_time'");
				$child_physical_age_three->whereAdd("child_physical_age_three.created <='$end_time'");
				$sum_child_physical_age_three=$child_physical_age_three->count();
				
				$sum_child_physical_two=0;
				$child_physical_two=new Tchild_physical_two();
				$individual_core=new Tindividual_core();
				$child_physical_two->joinAdd('left',$child_physical_two,$individual_core,'id','uuid');
				$child_physical_two->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$child_physical_two->whereAdd("child_physical_two.created >='$start_time'");
				$child_physical_two->whereAdd("child_physical_two.created <='$end_time'");
				$sum_child_physical_two=$child_physical_two->count();
				
				$sum_child_visits=0;
				$child_visits=new Tchild_visits();
				$individual_core=new Tindividual_core();
				$child_visits->joinAdd('left',$child_visits,$individual_core,'id','uuid');
				$child_visits->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$child_visits->whereAdd("child_visits.created >='$start_time'");
				$child_visits->whereAdd("child_visits.created <='$end_time'");
				$sum_child_visits=$child_visits->count();
				$row[$rowCount]['sum_child']=$sum_child_physical+$sum_child_physical_age_three+$sum_child_physical_two+$sum_child_visits;
				$sum_child+=$row[$rowCount]['sum_child'];
				//孕产妇
				$sum_prenatal_visit_first=0;
				$prenatal_visit_first=new Tprenatal_visit_first();
				$individual_core=new Tindividual_core();
				$prenatal_visit_first->joinAdd('left',$prenatal_visit_first,$individual_core,'id','uuid');
				$prenatal_visit_first->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$prenatal_visit_first->whereAdd("prenatal_visit_first.created >='$start_time'");
				$prenatal_visit_first->whereAdd("prenatal_visit_first.created <='$end_time'");
				$sum_prenatal_visit_first=$prenatal_visit_first->count();
	
				$sum_prenatal_visit_two=0;
				$prenatal_visit_two=new Tprenatal_visit_two();
				$individual_core=new Tindividual_core();
				$prenatal_visit_two->joinAdd('left',$prenatal_visit_two,$individual_core,'id','uuid');
				$prenatal_visit_two->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$prenatal_visit_two->whereAdd("prenatal_visit_two.created >='$start_time'");
				$prenatal_visit_two->whereAdd("prenatal_visit_two.created <='$end_time'");
				$sum_prenatal_visit_two=$prenatal_visit_two->count();
	
				$sum_postpartum_visit=0;
				$postpartum_visit=new Tpostpartum_visit();
				$individual_core=new Tindividual_core();
				$postpartum_visit->joinAdd('left',$postpartum_visit,$individual_core,'id','uuid');
				$postpartum_visit->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$postpartum_visit->whereAdd("postpartum_visit.created >='$start_time'");
				$postpartum_visit->whereAdd("postpartum_visit.created <='$end_time'");
				$sum_postpartum_visit=$postpartum_visit->count();
	
				$sum_postpartum_heathcheck=0;
				$postpartum_heathcheck=new Tpostpartum_heathcheck();
				$individual_core=new Tindividual_core();
				$postpartum_heathcheck->joinAdd('left',$postpartum_heathcheck,$individual_core,'id','uuid');
				$postpartum_heathcheck->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$postpartum_heathcheck->whereAdd("postpartum_heathcheck.created >='$start_time'");
				$postpartum_heathcheck->whereAdd("postpartum_heathcheck.created <='$end_time'");
				$sum_postpartum_heathcheck=$postpartum_heathcheck->count();
				$row[$rowCount]['sum_maternal']=$sum_prenatal_visit_first+$sum_prenatal_visit_two+$sum_postpartum_visit+$sum_postpartum_heathcheck;
				$sum_maternal+=$row[$rowCount]['sum_maternal'];
				$rowCount++;
			}
			$row['total']['sum_older']=$sum_older;
			$row['total']['sum_child']=$sum_child;
			$row['total']['sum_maternal']=$sum_maternal;
			create_php_cache($filename,$row);
		}
		else 
		{
			require($filename);
			$row=$rows;
		}
		return $row;
	}
}
?>