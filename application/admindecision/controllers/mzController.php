<?php
class admindecision_mzController extends controller{
	private $regionDomain;
	private $p_id;
	private $cache_time=__CACHING_LEFTTIME;
	public function  init(){
		require_once(__SITEROOT.'library/MyAuth.php');
		$this->auth = Zend_Auth::getInstance();
		if ($this->auth->hasIdentity()) {
			$this->user = $this->auth->getIdentity();
		}else{
			$this->redirect(__BASEPATH."loging/index/index");
		}
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'/library/Models/clinical_history.php';//慢病确症表
		require_once __SITEROOT.'/library/Models/individual_core.php';//个人档案表
		require_once __SITEROOT."library/Models/tb_yl_mz_medical_record.php";
		$this->view->basePath = $this->_request->getBasePath();
		$this->regionDomain = $this->user['region_id'];				
		$p_id = $this->_request->getParam('region_id','');
		$this->p_id = empty($p_id)?$this->regionDomain:$p_id;
		$this->getdata($this->regionDomain,$this->p_id);		
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
	public function barAction(){
		require_once __SITEROOT."library/Models/region.php";
		require_once(__SITEROOT."application/admindecision/models/region_func.php");//
		$row=$this->getdata($this->regionDomain,$this->p_id);
		foreach ($row as $k=>$v){
			$data[$k][0] = $v['total'];
			$data[$k]['axisname'] = $v['jzzdmc'];
		}
		$x_array = array('疾病名称');
		echo xml_draw_3d_bar($data,$x_array,"人","数量","疾病顺位柱状图","3d column",800,220);
		exit;
	}
	public function listAction(){
		require_once(__SITEROOT."application/admindecision/models/region_func.php");//
		$row=$this->getdata($this->regionDomain,$this->p_id);
		$this->view->assign("row",$row);
		$this->view->display("list.html");
	}
	//取数据
	private function getdata($regionDomain,$p_id){
		$file_md5=md5($regionDomain.$p_id);
		$filename=__SITEROOT."cache/admindecision_mz_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time){
			$region_id			= $this->_request->getParam('region_id');//
			$region_id			= $region_id?$region_id:$this->user['region_id'];//取得机构号
			$row = array();
			$x = 0;
			$orgid = get_organization_id($this->get_region_path($region_id));
			$mz_medical_record=new Ttb_yl_mz_medical_record( 2 );
			$mz_medical_record->whereAdd("yljgdm in (".$orgid.",'5105005')");//2011-11-15叶加，因机构代码问题
			$mz_medical_record->selectAdd("count(*) as total,jzzdmc as jzzdmc");
			$mz_medical_record->whereAdd("jzzdmc is not null");
			$mz_medical_record->groupby("jzzdmc");
			$mz_medical_record->find();
			while ($mz_medical_record->fetch()){
				$row[$x]['jzzdmc'] = $mz_medical_record->jzzdmc;
				$row[$x]['total'] = $mz_medical_record->total;
				$x++;
			}
			create_php_cache($filename,$row);			
		}else {
			require($filename);
			$row=$rows;			
		}
		return $row;				
	}
	private function get_region_path($region_id)
	{
		require_once __SITEROOT."library/Models/region.php";
		$region =new Tregion();
		$region ->whereAdd("id='$region_id'");
		$region ->find(true);
		return  $region->region_path;
	}
}