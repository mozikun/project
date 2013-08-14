<?php
/**
 * @author mark
 * @filename:specimenController.php
 * @package 医疗业务--标本字典表
 * @create 2011-10-13
 */
class his_specimenController extends controller {
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."library/Models/tb_dic_specimen_v.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		$current_org = get_organization_id($current_region_path);
		$tb_dic_specimen = new Ttb_dic_specimen(2);
		$bbdm  = $this->_request->getParam('bbdm');
		$bbmc  = $this->_request->getParam('bbmc');
		//			echo $name;
		$search = array('bbdm'=>$bbdm,'bbmc'=>$bbmc);
		foreach ($search as $k=>$v){
			$myvalue = trim($v);
			if (!empty($myvalue)){
				if ($k=='bbdm') {
					$tb_dic_specimen->whereAdd("bbdm='$myvalue'");
				}
				if ($k=='bbmc'){
					$tb_dic_specimen->whereAdd("bbmc='$myvalue'");
				}
			}
		}

		//处理分页
		$nuNumber = $tb_dic_specimen->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/specimen/list/page/',					2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_dic_specimen->limit($startnum,__ROWSOFPAGE);
		if ($nuNumber>0){
			$tb_dic_specimen->find();
			$specimenList = array();
			$x = 0;
			while ($tb_dic_specimen->fetch()){
				$specimenList[$x]['bbdm'] = $tb_dic_specimen->bbdm;
				$specimenList[$x]['bbmc'] = $tb_dic_specimen->bbmc;
				$x++;
			}
			$this->view->specimenList = $specimenList;
		}
		$this->view->basePath = __BASEPATH;
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->display('list.html');
	}
	public function displayAction(){
		$bbdm  = $this->_request->getParam('bbdm');
		if ($bbdm){
			$specimen = new Ttb_dic_specimen(2);
			$specimen->whereAdd("bbdm='$bbdm'");
			$specimen->find(true);
			$this->view->bbdm=$specimen->bbdm;
			$this->view->bbmc=$specimen->bbmc;
		}else {
			message("没有你要查询的用户",array("进入患者一览表"=>__BASEPATH.'his/department/list'));
		}
		$this->view->display('display.html');
	}
}
