<?php
class organization_regionController extends controller {
	public function init(){
		//用户认证与权限
		require_once(__SITEROOT.'library/privilege.php');
		
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/privilege.php');
	}
	public function indexAction(){
		//分页调用
		require_once __SITEROOT."/library/custom/pager.php";
		//列表显示当前所有地区(以后处理的时候可能通过表单传值查询当前所进入地区的所有地区)
		$currentId = $this->_request->getParam('parent_id');
		$realId = $this->user['region_id'];
		$realParentId = empty($currentId)?$realId:$currentId;
		$this->view->basePath = $this->_request->getBasePath();
		$this->view->basePath=__BASEPATH;
		$this->view->realParentId = $realParentId;
		$region = new Tregion();
		// $org->debugLevel(9);
		$region->where("id!='0'");
		$region->whereAdd("p_id='$realParentId'");
		$nuNumbers = $region->count();
		//获取分页参数
		$currentPage = intval($this->_request->getParam('page'));
		$realPage    = empty($currentPage)?1:$currentPage;
		$arrArg = array();
		$links = new SubPages(__ROWSOFPAGE,$nuNumbers,$realPage,__goodsListRowOfPage,__BASEPATH.'organization/region/index/parent_id/'.$realParentId.'/page/',3,$arrArg);
		$pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		if($nuNumbers>0){
		$regionList = new Tregion();
		$regionList->whereAdd("id<>'0'");
		$regionList->whereAdd("p_id='$realParentId'");
		$regionList->orderby("id ASC");
		$regionList->limit($startnum,__ROWSOFPAGE);
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
		}else{
			$msg = '<tr><td align="center" colspan="4"><strong>当前没有任何数据</strong></td></tr>';
			$this->view->msg = $msg; 
		}
		$this->view->page     = $links->subPageCss2();
		$this->view->nuNumber = $nuNumbers;
		//获取当前ID的全路径
		$pathRegion = new Tregion();
		$pathRegion->whereAdd("id='$realParentId'");
		$pathRegion->find(true);
		$rs = array();
		$rsCount = 0;
		$nuNumber = strpos($pathRegion->region_path,$realId);
		$strNumber = intval(strlen($pathRegion->region_path)-$nuNumber);
		$newCurrentPath = substr($pathRegion->region_path,$nuNumber,$strNumber);
		$currentPath = explode(',',$newCurrentPath);
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