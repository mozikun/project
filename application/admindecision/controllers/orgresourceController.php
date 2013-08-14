<?php
class admindecision_orgresourceController extends controller{
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
		$this->view->basePath = $this->_request->getBasePath();
		
		$this->regionDomain = $this->user['region_id'];
		$regionId = $this->_request->getParam('region_id','');
		$this->p_id = empty($regionId)?$this->regionDomain:$regionId;
		$this->view->reginid  = $this->p_id;
	}
	public function indexAction(){
		$myarray         = array(1=>'alladmin',2=>'allzfjg',3=>"allhospital",4=>"communitycount",5=>"orgtowncount");
		$this->view->myarray  = $myarray;
		$this->view->display("index.html");
	}
	public function bar3Action()
	{   
		require_once(__SITEROOT.'/application/admindecision/models/orgresource.php');
		$type = 3;
		$regionid        = $this->_request->getParam('region_id');
		$data=getmyallnumber($regionid,$type);
//		foreach ($data as $k=>$v){
//			$x_array[]= $v['axisname'];
//		}
		$x_array=array(date("Y-m-d",time()));
		//echo xml_draw_3d_pie($data,$x_array,"个数","个","医院数",200,150);
		echo xml_draw_3d_bar($data,$x_array,"个数","个","医院数","3d column",200,150);
		exit;
	}
	public function bar4Action()
	{   
		require_once(__SITEROOT.'/application/admindecision/models/orgresource.php');
		$type = 4;
		$regionid        = $this->_request->getParam('region_id');
		$data=getmyallnumber($regionid,$type);
//		foreach ($data as $k=>$v){
//			$x_array[]= $v['axisname'];
//		}
		$x_array=array(date("Y-m-d",time()));
		echo xml_draw_3d_bar($data,$x_array,"个数","个","社区数","3d column",200,150);
		exit;
	}
	public function bar5Action()
	{    
		require_once(__SITEROOT.'/application/admindecision/models/orgresource.php');
		$type = 5;
		$regionid        = $this->_request->getParam('region_id');
		$data = getmyallnumber($regionid,$type);
//		foreach ($data as $k=>$v){
//			$x_array[]= $v['axisname'];
//		}
        $x_array=array(date("Y-m-d",time()));
		echo xml_draw_3d_bar($data,$x_array,"个数","个","乡镇卫生院数","3d column",200,150);
		exit;
	}
	public function listAction(){
		$myarray         = array(1=>'alladmin',2=>'allzfjg',3=>"allhospital",4=>"communitycount",5=>"orgtowncount");
		$row=$this->getdata($this->regionDomain,$this->p_id,$myarray);
		foreach($myarray as $k=>$v){
		        $this->view->assign($v,$row['total'][$v]);
		}
		unset($row['total']);
		$this->view->assign("regionArr",$row);
		$this->view->display('list.html');
	}

	private function getdata($regionDomain,$p_id,$type)
	{
		$file_md5=md5($regionDomain.'ct_'.$p_id);
		$filename=__SITEROOT."cache/admindecision_orgresource_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
		{
				//通过登录的这级寻找他的直接下一级
				$region          = new Tregion();
				$region->whereAdd("p_id='$p_id'");
				$region->find();
				$regionArr   = array();
				$regionCount = 0;
				$allhospital  = 0;
				$allcount    = 0;
				$alladmin    = 0;
				$orgtowncount = 0;
				$alltown     = 0;
				$allzfjg     = 0;
				$loneorgzzzz = 0;
				$communitycount = 0;
				while($region->fetch()){
					//获取到了当前登录这级的直接下一级		
					$regionArr[$regionCount]['axisname'] = substr($region->zh_name,0,6);
					//获取这个直接下一级的所有信息(找机构表),
					//找执法机构
					if(is_array($type)){
						foreach ($type as $k=>$v){
							    $tabobj = $v.$k;
								$tabobj = new Torganization();
								$tabobj->whereAdd("region_path like '$region->region_path%'");
								$tabobj->whereAdd("type='$k'");
							    $tabobj->find();
								$loneorgzfjg = $tabobj->count();
								$regionArr[$regionCount][$v]= $loneorgzfjg;
								$$v = $$v + $loneorgzfjg;
						}
					}
					$regionCount++;
				}
				foreach($type as $k=>$v){
				     $regionArr['total'][$v] = $$v;
				}
//				$this->view->alltown         = $alltown;//卫生院合计
//				$this->view->alladmin        = $alladmin;//卫生行政部门合计
//				$this->view->allhospital     = $allhospital;//市级医院合计
//				$this->view->allzfjg         = $allzfjg;//卫生执法部门合计
//				$this->view->allcommunity    = $allcommunity;//社区合计
				create_php_cache($filename,$regionArr);
		}
		else 
		{
			require($filename);
			$regionArr=$rows;
		}
		return $regionArr;
	}
}