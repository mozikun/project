<?php
 class region_regionextController extends controller{
 	public function init(){
 		require_once __SITEROOT.'library/Models/region_ext_1.php';
 		require_once(__SITEROOT.'library/Models/region.php');
 	}
 	/**
 	 * 用于地区扩展信息的列表
 	 * 2010.8.30
 	 * author:CT
 	 */
 	public function indexAction(){
 		require_once __SITEROOT."/library/custom/pager.php";
 		$this->view->basePath = $this->_request->getBasePath();
 		//获取分页参数
 		$pagenew = $this->_request->getParam('pagecurrent');
		$currentPage = intval($this->_request->getParam('pagenow'));
		$realPage    = empty($currentPage)?1:$currentPage;
 		//获取当前地区的地区ID号,当前地区所在名称
 		$currentid = $this->_request->getParam('nowid');
 		$region = new Tregion();
 		$region->whereAdd("id='$currentid'");
 		$region->find(true);
 		$this->view->region_name = $region->zh_name;
 		//获取扩展信息基本表的记录总数
 		$region_ext_1 = new Tregion_ext_1();
 		$region_ext_1->whereAdd("region_id='$currentid'");
 		$arrArg = array();
		$links = new SubPages(__ROWSOFPAGE,$region_ext_1->count(),$realPage,__goodsListRowOfPage,__BASEPATH.'region/regionext/index/nowid/'.$currentid.'/pagecurrent/'.$pagenew.'/pagenow/',3,$arrArg);
		$pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		if($region_ext_1->count()>0){
			$region_ext_list = new Tregion_ext_1();
			$region_ext_list->whereAdd("region_id='$currentid'");
			$region_ext_list->limit($startnum,__ROWSOFPAGE);
			$region_ext_list->find();
			$extArr = array();
			$extArrCount = 0;
			while($region_ext_list->fetch()){
				$extArr[$extArrCount]['region_year']       = $region_ext_list->region_year;
				$extArr[$extArrCount]['population']        = $region_ext_list->population;
				$extArr[$extArrCount]['urban_population']  = $region_ext_list->urban_population;
				$extArr[$extArrCount]['agral_population']  = $region_ext_list->agral_population;
				$extArr[$extArrCount]['graph_area']        = $region_ext_list->graph_area;
				$extArr[$extArrCount]['uuid']              = $region_ext_list->uuid;
				$extArrCount++;
			}
			$pageNew = $links->subPageCss2();
			$this->view->page = $pageNew;
			$this->view->extarr = $extArr;
		}else{
			$baseMessang = '<strong>当前还没有任何数据!</strong>';
			$this->view->basemessage = $baseMessang;
		}
		$this->view->allnumber = $region_ext_1->count();
		$this->view->oldpage   = $pagenew;
		//获取当前地区的PID便于返回地区列表
		$this->view->parentId = $region->p_id;
		$this->view->currentid= $currentid;
 		$this->view->display('regionext.html');
 	}
 	/**
 	 * 用于地区扩展信息的添加
 	 */
 	public function addAction(){
 		$this->view->basePath = $this->_request->getBasePath();
 		$regionId  = $this->_request->getParam('region_id');
 		$currentId = $this->_request->getParam('id');
 		if($regionId){
 			//获取当前地区名
 			$region = new Tregion();
 			$region->whereAdd("id='$regionId'");
 			$region->find(true);
 			$this->view->regionname = $region->zh_name;
 		}
 		//获取表单地区基本信息
 		$baseYear       = trim($this->_request->getParam('base_year'));
 		$baseNumber     = trim($this->_request->getParam('base_number'));
 		$baseCityNumber = trim($this->_request->getParam('base_city_number'));
 		$baseVillNumber = trim( $this->_request->getParam('base_vill_number'));
 		$baseAreaNumber = trim($this->_request->getParam('base_area_number'));
 		$pageCurrent    = $this->_request->getParam('pagecurrent');
 		$ok             = $this->_request->getParam('ok');
 		if($currentId){
 			//如果存在$currentId表示要进行编辑
 			$regionedit = new Tregion_ext_1();
 			$regionedit->whereAdd("uuid='$currentId'");
 			$regionedit->find(true);
 			$regionext  = new Tregion_ext_1();
 			$regionext->whereAdd("uuid='$currentId'");
 			$regionext->region_year       = $baseYear;
 			$this->view->baseyear         = $regionedit->region_year;
 			$regionext->population        = $baseNumber;
 			$this->view->population       = $regionedit->population;
 			$regionext->urban_population  = $baseCityNumber;
 			$this->view->citypopulation   = $regionedit->urban_population;
 			$regionext->agral_population  = $baseVillNumber;
 			$this->view->vill_population  = $regionedit->agral_population;
 			$regionext->graph_area        = $baseAreaNumber;
 			$this->view->graph_area       = $regionedit->graph_area;
 			if($ok){
 			    $regionext->update();
 			    $msg = '<script type="text/javascript">window.alert("更新成功！");location.href="'.__BASEPATH.'region/regionext/index/nowid/'.$regionId.'/pagecurrent/'.$pageCurrent.'";</script>';
 			    $this->view->msg = $msg;
 			    //$this->redirect(__BASEPATH.'region/regionext/index/nowid/'.$regionId.'/pagecurrent/'.$pageCurrent);
 			}
 		}else{
 			//判断是否是同一年的
 			$regionext =  new Tregion_ext_1();
 			$regionext->whereAdd("region_year='$baseYear'");
 			if($regionext->count()>0)
 			{
 				$msg = '<script type="text/javascript">window.alert("年限重复，请重新选择年限！");location.href="'.__BASEPATH.'region/regionext/index/nowid/'.$regionId.'/pagecurrent/'.$pageCurrent.'";</script>';
 				$this->view->msgadd = $msg;
 			}
 			else
 			{
	 			//否则就是添加
	 			$regionadd = new Tregion_ext_1();
	 			$regionadd->region_year       = $baseYear;
	 			$regionadd->population        = $baseNumber;
	 			$regionadd->urban_population  = $baseCityNumber;
	 			$regionadd->agral_population  = $baseVillNumber;
	 			$regionadd->graph_area        = $baseAreaNumber;
	 			$regionadd->region_id         = $regionId;
	 			$regionadd->uuid              = uniqid('');
	 			if($ok){
	 				$regionadd->insert();
	 				$msg = '<script type="text/javascript">window.alert("添加成功！");location.href="'.__BASEPATH.'region/regionext/index/nowid/'.$regionId.'/pagecurrent/'.$pageCurrent.'";</script>'; 	
	 				$this->view->msgadd = $msg;		    
	 				exit();
	 			}
 			}
 		}
 		
 		$this->view->currentid   = $regionId;
 		$this->view->pagecurrent = $pageCurrent;
 		$this->view->display('add.html');
 	}
 	/**
 	 * 删除地区扩展基本数据
 	 */
 	public function delAction(){
 		$id        = $this->_request->getParam('id');
 		$regionId = $this->_request->getParam('region_id');
 		if($id){
 			$regiondel = new Tregion_ext_1();
 			$regiondel->whereAdd("uuid='$id'");
 			if($regiondel->delete()){
 				$this->redirect(__BASEPATH.'region/regionext/index/nowid/'.$regionId);
 			}
 		}
 	}
 }
?>