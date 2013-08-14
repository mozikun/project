<?php
/**
 * @author mark
 * @filename:instrumentController.php
 * @package 医疗业务--医疗机构字典表
 * @create 2011-10-13
 */
class his_instrumentController extends controller {
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."library/Models/tb_dic_instrument_v.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		$current_org = get_organization_id($current_region_path);
		$tb_dic_instrument = new Ttb_dic_instrument(2);
		$yqbh  = $this->_request->getParam('yqbh');
		$yqmc  = $this->_request->getParam('yqmc');
		//			echo $name;
		$search = array('yqbh'=>$yqbh,'yqmc'=>$yqmc);
		foreach ($search as $k=>$v){
			$myvalue = trim($v);
			if (!empty($myvalue)){
				if ($k=='yqbh') {
					$tb_dic_instrument->whereAdd("yqbh='$myvalue'");
				}
				if ($k=='yqmc'){
					$tb_dic_instrument->whereAdd("yqmc='$myvalue'");
				}
			}
		}
//		$tb_dic_detail_comparison->whereAdd("yljgdm in (".$current_org.")");

		//处理分页
		$nuNumber = $tb_dic_instrument->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/instrument/list/page/',					2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_dic_instrument->limit($startnum,__ROWSOFPAGE);
		if ($nuNumber>0){
			$tb_dic_instrument->find();
			$instrumentList = array();
			$x = 0;
			while ($tb_dic_instrument->fetch()){
//				$org   = new Torganization();
//				$org->whereAdd("standard_code='".trim($tb_dic_detail_comparison->yljgdm)."'");
//				$org->find();
//				while ($org->fetch()){
//					$practitionerList[$x]['yyjgdm'] = $org->zh_name;
//				}
				$instrumentList[$x]['yqbh'] = $tb_dic_instrument->yqbh;
				$instrumentList[$x]['yqmc'] = $tb_dic_instrument->yqmc;
				$instrumentList[$x]['sbbm'] = $tb_dic_instrument->sbbm;
				$x++;
			}
			$this->view->instrumentList = $instrumentList;
		}
		
		$this->view->basePath = __BASEPATH;
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->display('list.html');
	}
	public function displayAction(){
		$yqbh  = $this->_request->getParam('yqbh');
		if ($yqbh){
			$instrument = new Ttb_dic_instrument(2);
			$instrument->whereAdd("yqbh='$yqbh'");
			$instrument->find(true);
			$this->view->yqbh=$instrument->yqbh;
			$this->view->yqmc=$instrument->yqmc;
			$this->view->sbbm=$instrument->sbbm;
			$this->view->xgbz=$instrument->xgbz;
		}else {
			message("没有你要查询的用户",array("进入患者一览表"=>__BASEPATH.'his/department/list'));
		}
		$this->view->display('display.html');
	}
}
