<?php
   class organization_poporgController extends controller {
	public function init(){
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/region.php');
	}
	public function listpopAction(){
		$this->view->basePath = $this->_request->getBasePath();
		$regionId = $this->_request->getParam('regionid');
		$orgId = $this->_request->getParam('currentorgid');
		if(!empty($regionId)&&!empty($orgId)){
			//获取当前地区ID的信息
			$listRegion = new Tregion();
			$listRegion->whereAdd("id='$regionId'");
			$listRegion->find(true);
			$regionPath = trim($listRegion->region_path);
			$regionname = trim($listRegion->zh_name);
			$regionParentId = trim($listRegion->p_id);
			//$regionCode = trim($listRegion->standard_code);
			$oldPathNu = count(explode(',',$regionPath));
			//所有机构类型
			$orgType = array(1=>"行政机构",2=>"执法机构",3=>"医院",4=>"社区",5=>"乡镇卫生院",6=>"妇幼保健院");
			$this->view->orgType = $orgType;
			$newOrg = new Torganization();
				//$newOrg->debugLevel(9);
				$newOrg->whereAdd("id='$orgId'");
				$newOrg->find(true);
				$orgCode = trim($newOrg->standard_code);
				$orgRegionDomain = explode('|',$newOrg->region_path_domain);
				$regionMenu = new Tregion();
				$regionMenu->whereAdd("region_path like '$regionPath%'");
				//$regionMenu->whereAdd("id = '$listOrg->id'");
				$regionMenu->orderby("id ASC");
				$regionMenu->find();
				$pathArr = array();
				$pathArrCount = 0;
				while($regionMenu->fetch()){
					$nowPathNu = count(explode(',',$regionMenu->region_path));
					if($nowPathNu==$oldPathNu||$nowPathNu==($oldPathNu+1)){
						$pathArr[$pathArrCount]['zh_name'] = $regionMenu->zh_name;
						$pathArr[$pathArrCount]['region_path'] = trim($regionMenu->region_path);
						$pathArr[$pathArrCount]['standard_code'] = trim($regionMenu->standard_code);
						if(in_array(trim($regionMenu->region_path),$orgRegionDomain)){
							$pathArr[$pathArrCount]['ck'] = 'checked="checked"';
						}else{
							$pathArr[$pathArrCount]['ck']='';
						}
						$pathArrCount++;
					}
				}
				$this->view->pathArr = $pathArr;
		}
		$this->view->c_name = $newOrg->c_name;
		$this->view->rootpath = __BASEPATH;
		$this->view->regionname = $regionname;
		$this->view->areaid = $regionId;
		$this->view->orgid = $orgId;
		$this->view->type = $newOrg->type;
		$this->view->code = $orgCode;
		$this->view->display('poporg.html');
	}
   }