<?php
class admindecision_drugController extends controller{
	private $regionDomain;
	private $p_id;
	private $cache_time=__CACHING_LEFTTIME;	
	public function  init(){
		require_once(__SITEROOT.'library/Myauth.php');
		$this->auth = Zend_Auth::getInstance();
		if ($this->auth->hasIdentity()) {
			$this->user = $this->auth->getIdentity();
		}else{
			$this->redirect(__BASEPATH."loging/index/index");
		}
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'/library/Models/clinical_history.php';//慢病确症表
		require_once __SITEROOT.'/library/Models/individual_core.php';//个人档案表
		require_once __SITEROOT."library/Models/wd_med_store.php";
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
	public function barAction(){
		$row=$this->getdata($this->regionDomain,$this->p_id);
		foreach ($row as $k=>$v){
			$data[$k][0] = $v['ypkc'];
			$data[$k]['axisname'] = $v['ypmc'];
		}
		$x_array = array('药品名称');
		echo xml_draw_3d_bar($data,$x_array,"人","数量","药品顺位柱状图","3d column",600,250);
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
		$filename=__SITEROOT."cache/admindecision_drug_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time){
			require_once(__SITEROOT."application/admindecision/models/region_func.php");
			$region_id			= $this->_request->getParam('region_id');//
			$region_id			= $region_id?$region_id:$this->user['region_id'];//取得机构号
			$row = array();
			$x = 0;
			$orgid = get_organization_id($this->get_region_path($region_id));
			$wd_med_store=new Twd_med_store( 2 );
			$wd_med_store->whereAdd("yljgdm in (".$orgid.",'5105005')");//2011-11-15叶加，因机构代码问题
			$wd_med_store->groupby("ypmc");
			$wd_med_store->limit(0,10);
			$wd_med_store->selectAdd("sum(ypkc) as total,ypmc as ypmc");
			$wd_med_store->orderby("total desc");
			//$wd_med_store->debugLevel(2);
			$wd_med_store->find();
			while ($wd_med_store->fetch()){
				$row[$x]['ypmc'] = $wd_med_store->ypmc;
				$row[$x]['ypkc'] = round($wd_med_store->total);
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