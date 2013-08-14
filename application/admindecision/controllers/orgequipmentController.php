<?php
class admindecision_orgequipmentController extends controller{
	private $regionDomain;
	private $p_id;
	private $cache_time=__CACHING_LEFTTIME;
	public function  init(){
		set_time_limit(0);
		require_once(__SITEROOT.'library/Myauth.php');
		$this->auth = Zend_Auth::getInstance();
		if ($this->auth->hasIdentity()) {
			$this->user = $this->auth->getIdentity();
		}else{
			$this->redirect(__BASEPATH."loging/index/index");		
		}
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'/library/Models/region.php';
		require_once __SITEROOT.'/library/Models/organization.php';
		require_once __SITEROOT.'/library/Models/org_ext_3.php';
		$this->view->basePath = $this->_request->getBasePath();
		
		$this->regionDomain = $this->user['region_id'];
		$regionId = $this->_request->getParam('region_id','');
		$this->p_id = empty($regionId)?$this->regionDomain:$regionId;
		$this->view->reginid  = $this->p_id;
	}
	public function indexAction(){
		
		$this->view->display("index.html");
	}
	public function pieAction()
	{   
		$regionid        = $this->_request->getParam('region_id');
		//$data   = getequipment($regionid);
		$data=$this->getdata($this->regionDomain,$this->p_id);
		
		$x_array=array("d");
		echo xml_draw_3d_pie($data,$x_array,"台数","个","万元以上设备台数",200,150);
		exit;
	}
	public function listAction(){
	    $row=$this->getdata($this->regionDomain,$this->p_id);
		$this->view->assign("allnumber",$row['total']['allnumber']);
		unset($row['total']);
		$this->view->assign("regionarr",$row);
		$this->view->display('list.html');
	}
	
	
	private function getdata($regionDomain,$p_id)
	{
		$file_md5=md5($regionDomain.'ct_'.$p_id);
		$filename=__SITEROOT."cache/admindecision_equipment_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
		{
				$region          = new Tregion();
				$region->whereAdd("p_id='$p_id'");
				$region->find();
				$count  = 0;
				$allnumber = 0;
				$regionarr = array();
				while($region->fetch()){
					$regionpath = $region->region_path;
					$org = new Torganization();
					$org->whereAdd("region_path like '$regionpath%'");
					$org->find();
					$orgcount = 0;
					while ($org->fetch()){
						$orgid = $org->id;
						$org_ext_3 = new Torg_ext_3();
						$org_ext_3->whereAdd("id='$orgid'");
						$org_ext_3->find(true);
						$equipment_total_number = $org_ext_3->equipment_total_number;
						$orgcount = $orgcount + $equipment_total_number;
					}
					$regionarr[$count]['equipment_total_number'] = $orgcount;
					$regionarr[$count]['axisname']               = substr($region->zh_name,0,6);
					$allnumber = $allnumber+$orgcount;
					$count++;
				}
				$regionarr['total']['allnumber'] = $allnumber;
				$regionarr['total']['axisname'] = '';
				create_php_cache($filename,$regionarr);
		}
		else 
		{
			require($filename);
			$regionarr=$rows;
		}
		return $regionarr;
	}
}