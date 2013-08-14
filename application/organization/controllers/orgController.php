<?php
class organization_orgController extends controller {
	public function init(){
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/region.php');
	}
	public function indexAction(){
		//列表显示当前所有地区(以后处理的时候可能通过表单传值查询当前所进入地区的所有地区)
		$parentId = trim($this->_request->getParam('parent_id'));
		$realParentId = empty($parentId)?0:$parentId;
		$this->view->basePath = $this->_request->getBasePath();
		$this->view->rootpath=__BASEPATH;
		$this->view->realParentId = $realParentId;
		$region = new Tregion();
		// $org->debugLevel(9);
		$region->where("id<>'0'");
		$region->whereAdd("p_id='$realParentId'");
		$nuNumbers = $region->count();
		$regionList = new Tregion();
		$regionList->whereAdd("id<>'0'");
		$regionList->whereAdd("p_id='$realParentId'");
		$regionList->orderby("id ASC");;
		$regionList->find();
		$row = array();
		$rowCount = 0;
		while ($regionList->fetch()){
			$row[$rowCount]['zh_name'] = $regionList->zh_name;
			$row[$rowCount]['region_path'] = $regionList->region_path;
			$row[$rowCount]['id'] = $regionList->id;
			$rowCount++;
		}
		$this->view->row = $row;
		$this->view->nuNumber = $nuNumbers;
		//获取当前ID的全路径
		$pathRegion = new Tregion();
		$pathRegion->whereAdd("id='$realParentId'");
		$pathRegion->find(true);
		$rs = array();
		$rsCount = 0;
		$currentPath = explode(',',$pathRegion->region_path);
		foreach ($currentPath as $k=>$v){
			$currentRegion = new Tregion();
			$currentRegion->whereAdd("id='$v'");
			$currentRegion->find(true);
			$rs[$rsCount]['zh_name'] = $currentRegion->zh_name;
			$rs[$rsCount]['id'] = $currentRegion->id;
			$rsCount++;
		}
		$this->view->rs = $rs;
		$this->view->display('index.html');
	}
}