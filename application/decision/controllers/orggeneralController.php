<?php 
/**
 * author ct
 * created:2011.3.8
 *机构概况
 * 统计
 * 建档总人数
 * 家庭档案总数
 * 行政机构总数
 * 社区总数
 * 卫生院总数
 * 1=>"行政机构",2=>"执法机构",3=>"医院",4=>"社区",5=>"乡镇卫生院
 */
class decision_orggeneralController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
  		require_once __SITEROOT.'library/Models/organization.php';//机构表
 		require_once __SITEROOT.'library/Models/individual_core.php';//个人表主表
 		require_once __SITEROOT.'library/Models/family_archive.php';//家庭表	
 		require_once __SITEROOT.'library/Models/region.php';//地区表
	}
	public function indexAction(){
		ob_start();
		$this->view->basePath   = __BASEPATH;
		//获取当前登录的地区
		$sessionContent = $this->user;
		//var_dump($sessionContent);
		$currentPath     = $this->user['current_region_path'];
		$currentRegionId = $this->user['region_id'];
		//通过登录的这级寻找他的直接下一级
		$region          = new Tregion();
		$region->whereAdd("p_id='$currentRegionId'");
		$region->find();
		$regionArr   = array();
		$regionCount = 0;
		$alltown     = 0;
		$allcount    = 0;
		$allcity     = 0;
		$alladmin    = 0;
		$allfamily   = 0;
		$allcommunity= 0;
		$allindividual= 0;
		while($region->fetch()){
			//获取到了当前登录这级的直接下一级		
			$regionArr[$regionCount]['zh_name'] = $region->zh_name;
			//获取这个直接下一级的所有信息(找机构表),
			$org = new Torganization();
			$org->whereAdd("region_path like '$region->region_path%'");
			$org->whereAdd("type='3'");
			//最先找医院(市级的)
			if($region->region_level==4){
				$org->find();
				$lonecount = $org->count();
				$regionArr[$regionCount]['citycount'] = $lonecount;
			    $allcount = $allcount +$lonecount;
			}else{
				$regionArr[$regionCount]['citycount'] = 0;
				$allcount = $allcount + 0;
			}
			//找县级的医院
		   if($region->region_level==5){
				$org->find();
				$lonecity = $org->count();
				$regionArr[$regionCount]['countycount'] = $lonecity;
				$allcity = $allcity +$lonecity;
			}else{
				$regionArr[$regionCount]['countycount'] = 0;
				$allcity = $allcity +0;
			}
			//找乡镇卫生院
			$orgtown = new Torganization();
			$orgtown->whereAdd("region_path like '$region->region_path%'");
			$orgtown->whereAdd("type='5'");
			$orgtown->find();
			$lonetown = $orgtown->count();
			$regionArr[$regionCount]['orgtowncount']= $lonetown;
			$alltown = $alltown+$lonetown;
			//找行政机构
			$orgadmin = new Torganization();
			$orgadmin->whereAdd("region_path like '$region->region_path%'");
			$orgadmin->whereAdd("type='1'");
			$orgadmin->find();
			$loneadmin = $orgadmin->count();
			$regionArr[$regionCount]['admincount']= $loneadmin;
			$alladmin  = $alladmin+$loneadmin;
			//找社区
			$communitycount = new Torganization();
			$communitycount->whereAdd("region_path like '$region->region_path%'");
			$communitycount->whereAdd("type='4'");
			$communitycount->find();
			$lonecommunity = $communitycount->count();
			$regionArr[$regionCount]['communitycount']= $lonecommunity;
			$allcommunity = $allcommunity + $lonecommunity;
			//找个人档案数
			$individual = new Tindividual_core();
			$individual->whereAdd("region_path like '$region->region_path%'");
			$individual->find();
			$loneindividual = $individual->count();
			$regionArr[$regionCount]['indivicount']= $loneindividual;
			$allindividual = $allindividual + $loneindividual;
			//个人家庭档案数
			$family = new Tfamily_archive();
			$family->whereAdd("region_path like '$region->region_path%'");
			$family->find();
			$lonefamily = $family->count();
			$regionArr[$regionCount]['familycount']= $lonefamily;
			$allfamily = $allfamily+$lonefamily;
			$regionCount++;
		}
		$this->view->alltown         = $alltown;//卫生院合计
		$this->view->alladmin        = $alladmin;//卫生行政部门合计
		$this->view->allcount        = $allcount;//市级医院合计
		$this->view->allcity         = $allcity;//县级医院合计
		$this->view->allfamily       = $allfamily;//家庭档案合计
		$this->view->allindividual   = $allindividual;//个人档案合计
		$this->view->allcommunity    = $allcommunity;//社区合计
		$this->view->regionArr   = $regionArr;
		$this->view->display('orggeneral.html');
		$info=ob_get_contents(); 
		$mainurl = __SITEROOT.'application/decision/views/scripts/orggeneral/';
		if(file_exists($mainurl.$currentPath.'.html')){
			$filecreateTime =  date('Y-m-d',filemtime($mainurl.$currentPath.'.html'));
			$filecreateArr  =  explode('-',$filecreateTime);
			$currentTime    =  explode('-',date('Y-m-d',time()));
			if($filecreateArr[0]!==$currentTime[0]){
				$file = fopen($mainurl.$currentPath.'.html','w+');
			    fwrite($file,$info);
			}else if($filecreateArr[1]!==$currentTime[1]){
				$file = fopen($mainurl.$currentPath.'.html','w+');
			    fwrite($file,$info);
			}else if($filecreateArr[2]!==$currentTime[2]){
				$file = fopen($mainurl.$currentPath.'.html','w+');
			    fwrite($file,$info);
			}
		}else{
			$file = fopen($mainurl.$currentPath.'.html','w+');
			fwrite($file,$info);
		}
		ob_end_flush(); 
	}
}
?>