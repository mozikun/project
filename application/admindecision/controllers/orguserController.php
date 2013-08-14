<?php
class admindecision_orguserController extends controller{
	   private $p_id;
	   private $cache_time=__CACHING_LEFTTIME;
	   private $regionDomain;
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
		require_once __SITEROOT.'/library/Models/staff_archive.php';
		require_once __SITEROOT.'/library/Models/staff_core.php';
		$this->view->basePath = $this->_request->getBasePath();
		
		$this->regionDomain = $this->user['region_id'];
		$regionId = $this->_request->getParam('region_id','');
		$this->p_id = empty($regionId)?$this->regionDomain:$regionId;
		$this->view->reginid  = $this->p_id;
	}
	public function indexAction(){
		$this->view->reginid  = $regionId;
		$this->view->myarray  = $myarray;
		$this->view->display("index.html");
	}
	 public function barAction(){
	 	require_once(__SITEROOT.'/application/admindecision/models/orgresource.php');
	 	$type = 11;
		$regionid        = $this->_request->getParam('region_id');
		$datas   = getuserinfo($this->p_id,$type);
		$data=array();
		foreach ($datas as $k=>$v){
			$data[$k][$k]=$v['lonezyys'];
			$data[$k]['axisname']=$v['axisname'];
		}
		$x_array[0]= "职业医师人数";
		echo xml_draw_3d_bar($data,$x_array,"人数","人","职业医师人数","3d column",200,150);
		exit;
	 }
	public function listAction(){
		$row = $this->getdata($this->regionDomain,$this->p_id);
		$this->view->assign("staffcountzyys",$row['total']['staffcountzyys']);
		$this->view->assign("staffcountzchs",$row['total']['staffcountzchs']);
		$this->view->assign("staffcountys",$row['total']['staffcountys']);
		$this->view->assign("staffcountjs",$row['total']['staffcountjs']);
		unset($row['total']);
		$this->view->assign("regionarr",$row);
		$this->view->display('list.html');
	}
	private  function getdata($regionDomain,$p_id){
		//specialty_code=array('11'=>'执业医师','12'=>'执业助理医师','13'=>'见习医师','21'=>'注册护士','22'=>'助产士','31'=>'西药师(士)','32'=>'中药师(士)','41'=>'检验技师(士)','42'=>'影像技师(士)','50'=>'卫生监督员','69'=>'其他卫生技术人员','70'=>'其他技术人员','80'=>'管理人员','90'=>'工勤及技能人员');
	    $file_md5=md5($regionDomain.'ct_'.$p_id);
		$filename=__SITEROOT."cache/admindecision_user_$file_md5.php";
		if (!file_exists($filename) || (time()-filemtime($filename))>=$this->cache_time)
		{
		$region          = new Tregion();
		$region->whereAdd("p_id='$p_id'");
		$region->find();
		$count  = 0;
		$regionarr = array();
		$staffcountzyys = 0;
		$staffcountzchs = 0;
		$staffcountys = 0;
		$staffcountjs = 0;
		while($region->fetch()){
			$region_path   = $region->region_path;
			$regionarr[$count]['axisname']   = substr($region->zh_name,0,6);
 			$staff_core    = new Tstaff_core();
			$staff_archive = new Tstaff_archive();
			$staff_core->whereAdd("region_path like '$region_path%'");
			$staff_core->joinAdd('inner',$staff_core,$staff_archive,'id','user_id');
			$staff_core->find();
			$lonezyys = 0;
			$lonezchs = 0;
			$loneys   = 0;   
			$lonejs   = 0;   
			$staffarray = array();
			while ($staff_core->fetch()){
				//执业医师
				if($staff_archive->specialty_code=='11'){
                           $lonezyys = $lonezyys+1;
				}
				//注册护士
				if($staff_archive->specialty_code=='21'){
					$lonezchs =  $lonezchs+1;
				}
				//药师
				if($staff_archive->specialty_code=='31'||$staff_archive->specialty_code=='32'){
                            $loneys   = $loneys+1;
				}
				//技师
				if($staff_archive->specialty_code=='41'||$staff_archive->specialty_code=='42'){
					$lonejs = $lonejs+1;
				}
			}
			$regionarr[$count]['lonezyys']= $lonezyys;
			$staffcountzyys  = $staffcountzyys + $lonezyys;
			$regionarr[$count]['lonezchs']= $lonezchs;
			$staffcountzchs  = $staffcountzchs + $lonezchs;
			$regionarr[$count]['loneys']  = $loneys;
			$staffcountys    = $staffcountys+$loneys;
			$regionarr[$count]['lonejs']  = $lonejs;
			$staffcountjs    = $staffcountjs+$lonejs;
			$count++;
		}
		    $regionarr['total']['staffcountzyys'] = $staffcountzyys;
		    $regionarr['total']['staffcountzchs'] = $staffcountzchs;
		    $regionarr['total']['staffcountys']   = $staffcountys;
		    $regionarr['total']['staffcountjs']   = $staffcountjs;
			//总数
//			$this->view->staffcountzyys = $staffcountzyys;
//			$this->view->staffcountzchs = $staffcountzchs;
//			$this->view->staffcountys   = $staffcountys;
//			$this->view->staffcountjs   = $staffcountjs;
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