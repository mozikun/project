<?php
/**
 * 特殊业务统计
 * @author 我好笨
 */
class admindecision_vaccController extends controller 
{
	private $regionDomain;
	private $start_time;
	private $end_time;
	private $p_id;
	private $cache_time=__CACHING_LEFTTIME;
	public function init()
	{
		//require_once(__SITEROOT.'library/privilege.php');
		set_time_limit(0);
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/vac_info.php";
		require_once __SITEROOT."library/Models/premarital_examination.php";
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once(__SITEROOT.'library/Myauth.php');
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
		$this->view->assign("sum_vaccination",$row['total']['sum_vaccination']);
		$this->view->assign("sum_pre_marital",$row['total']['sum_pre_marital']);
		unset($row['total']);
		$this->view->assign("row",$row);
		$this->view->display("list.html");
	}
	//柱形图
	public function barAction()
	{
		$pic_name="特殊业务管理柱形图";
		$row=$this->getdata($this->regionDomain,$this->start_time,$this->end_time,$this->p_id);
		unset($row['total']);
		$data=array();
		$i=0;
		foreach ($row as $k=>$v)
		{
			$data[0][$k]=$v['sum_vaccination'];
			$data[0]['axisname']="预防接种人次";
			$data[1][$k]=$v['sum_pre_marital'];
			$data[1]['axisname']="婚检人次";
			$x_array[]=$v['zh_name'];
		}
		//exit();
		echo xml_draw_3d_bar($data,$x_array,"人数","人",$pic_name,"3d column",341,229);
		exit;
	}
	//饼形图
	public function pieAction()
	{
		$type=$this->_request->getParam('type')?$this->_request->getParam('type'):"vaccination";
		$row=$this->getdata($this->regionDomain,$this->start_time,$this->end_time,$this->p_id);
		unset($row['total']);
		$data=array();
		$i=0;
		$type_array=array("vaccination"=>"预防接种人次","pre_marital"=>"婚检人次");
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
		echo xml_draw_3d_pie($data,$x_array,"人次","人次",$type_array[$type]."饼形图",330,229);
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
		$filename=__SITEROOT."cache/admindecision_vacc_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
		{
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			$region->find();
			$row = array();
			$rowCount=0;
			$sum_vaccination=0;//预防接种人次
			$sum_pre_marital=0;//婚检人次
			while($region->fetch())
			{
				$row[$rowCount]['id'] = trim($region->id);
				$row[$rowCount]['zh_name'] = $region->zh_name;
				$row[$rowCount]['region_path'] = $region->region_path;
				$row[$rowCount]['p_id'] = trim($region->p_id);
				$row[$rowCount]['standard_code'] = trim($region->standard_code);
				$current_level = count(explode(',',$region->region_path));
				//取预防接种人次 婚检人次 统计数据(人数)
				$sum_vaccination_temp=0;
				$vac_info=new Tvac_info();
				$individual_core=new Tindividual_core();
				$vac_info->joinAdd('left',$vac_info,$individual_core,'id','uuid');
				$vac_info->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$vac_info->whereAdd("vac_info.created >='$start_time'");
				$vac_info->whereAdd("vac_info.created <='$end_time'");
				$sum_vaccination_temp=$vac_info->count("distinct vac_info.id");
				$row[$rowCount]['sum_vaccination'] = $sum_vaccination_temp;
				$sum_vaccination+=$sum_vaccination_temp;
				
				//婚检人次
				$sum_pre_marital_temp=0;
				$premarital_examination=new Tpremarital_examination();
				$individual_core=new Tindividual_core();
				$premarital_examination->joinAdd('left',$premarital_examination,$individual_core,'id','uuid');
				$premarital_examination->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$premarital_examination->whereAdd("premarital_examination.created >='$start_time'");
				$premarital_examination->whereAdd("premarital_examination.created <='$end_time'");
				$sum_pre_marital_temp=$premarital_examination->count("distinct premarital_examination.id");
				$row[$rowCount]['sum_pre_marital'] = $sum_pre_marital_temp;
				$sum_pre_marital+=$sum_pre_marital_temp;
				$rowCount++;
			}
			$row['total']['sum_vaccination']=$sum_vaccination;
			$row['total']['sum_pre_marital']=$sum_pre_marital;
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