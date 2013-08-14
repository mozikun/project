<?php 
class decision_orginfoController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
  		require_once __SITEROOT.'library/Models/organization.php';
 		require_once __SITEROOT.'library/Models/org_ext_4.php';
	}
	public function indexAction(){
		$this->view->basePath = __BASEPATH;
		//获取当前登录的机构信息
  		$currentId = $this->user['org_id'];
 		$organization = new Torganization();
 		$organization->whereAdd("id='$currentId'");
 		$organization->find(true);
 		$this->view->basePath = __BASEPATH;
 		$this->view->orgname  =  $organization->zh_name;
 		$this->view->orgtype  =  $organization->type;
 		$region = $this->user['current_region_path'];
 		 //将当前region给传过去
 		 $this->view->regionpath            = $region;
 	     $regionname = $this->_request->getParam('regionname');
 	     $orgid      = $this->_request->getParam('parentid');
 	     $this->view->currentid             = $currentId;
 	     $this->view->caching		=__CACHING;//开启缓存
		 $this->view->cache_lifetime	=__CACHING_LEFTTIME;//缓存时间
 	    // if($orgid){
 	    if(!$this->view->is_cached('orginfo.html',$orgid)){
 	     //获取上一级的path
 	     $oldorg = new Torganization();
 	     $oldorg->whereAdd("id='$orgid'");
 	     $oldorg->find(true);
 	     $parentpath = $oldorg->region_path;
 		 //查询当前机构对应的下边的所有机构
 		 $orgnew   = new Torganization();
 		 $orgnew->whereAdd("region_path like '$regionname%'");
 		 $orgnew->whereAdd("id<>'$orgid'");
 		 $orgnew->find();
 		 $orgnewarr       = array();
 		 $orgnewarrcount  = 0;
 		  while($orgnew->fetch()){
 		 	//取当前级别的直接下一级的所有统计信息
 		 	if(count(explode(',',$orgnew->region_path))-count(explode(',',$parentpath))==1){
 		 		$org_ext_4  = new Torg_ext_4();
 		 	    $org_ext_4->whereAdd("id='$orgnew->id'");
 		 	    $org_ext_4->find(true);
 		 	    //总诊疗人次数
 		 	    
 		 		$orgnewarr[$orgnewarrcount]['zh_name']              = $orgnew->zh_name;
 		 		$orgnewarr[$orgnewarrcount]['region_path']          = $orgnew->region_path;	
 		 		$orgnewarr[$orgnewarrcount]['id']                   = $orgnew->id;	
 		 		$orgnewarrcount++;
 		 	}
 		  }
 		  $this->view->orgnewarr  = $orgnewarr;
// 	     	 }
 	     }else{
 	     	    $org_ext_4  = new Torg_ext_4();
 		 	    $org_ext_4->whereAdd("id='$currentId'");
 		 	    $org_ext_4->find(true);
 	     }
 	    $this->view->orgnewid  = $orgid;
		$this->view->display('orginfo.html',$orgid);
	}
}
?>