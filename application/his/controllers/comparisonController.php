<?php
/**
 * @author mark
 * @filename:comparisonController.php
 * @package 医疗业务--医疗机构字典表
 * @create 2011-10-13
 */
class his_comparisonController extends controller {
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."library/Models/tb_dic_detail_comparison_v.php";
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->view->basePath = $this->_request->getBasePath();
		$this->zfpb  = array(0=>'非自费',1=>'自费');
	}
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		$current_org = get_organization_id($current_region_path);
		$tb_dic_detail_comparison = new Ttb_dic_detail_comparison(2);
		$zlxh  = $this->_request->getParam('zlxh');
		$xmmc  = $this->_request->getParam('xmmc');
		//			echo $name;
		$search = array('zlxh'=>$zlxh,'xmmc'=>$xmmc);
		foreach ($search as $k=>$v){
			$myvalue = trim($v);
			if (!empty($myvalue)){
				if ($k=='zlxh') {
					$tb_dic_detail_comparison->whereAdd("zlxh='$myvalue'");
				}
				if ($k=='xmmc'){
					$tb_dic_detail_comparison->whereAdd("xmmc='$myvalue'");
				}
			}
		}
//		$tb_dic_detail_comparison->whereAdd("yljgdm in (".$current_org.")");

		//处理分页
		$nuNumber = $tb_dic_detail_comparison->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/practitioner/list/page/',					2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_dic_detail_comparison->limit($startnum,__ROWSOFPAGE);
		if ($nuNumber>0){
			$tb_dic_detail_comparison->find();
			$comparisonList = array();
			$x = 0;
			while ($tb_dic_detail_comparison->fetch()){
//				$org   = new Torganization();
//				$org->whereAdd("standard_code='".trim($tb_dic_detail_comparison->yljgdm)."'");
//				$org->find();
//				while ($org->fetch()){
//					$practitionerList[$x]['yyjgdm'] = $org->zh_name;
//				}
				$comparisonList[$x]['zlxh'] = $tb_dic_detail_comparison->zlxh;
				$comparisonList[$x]['id'] = $tb_dic_detail_comparison->id;
				$comparisonList[$x]['xmmc'] = $tb_dic_detail_comparison->xmmc;
				$x++;
			}
			$this->view->comparisonList = $comparisonList;
		}	
		$this->view->basePath = __BASEPATH;
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->display('list.html');
	}
	public function displayAction(){
		$zlxh  = $this->_request->getParam('zlxh');
		if ($zlxh){
			$tb_dic_detail_comparison = new Ttb_dic_detail_comparison(2);
			$tb_dic_detail_comparison->whereAdd("zlxh='$zlxh'");
			$tb_dic_detail_comparison->find(true);
			$tb_dic_detail_comparison->zfpb = getarrayvalue($this->zfpb,$tb_yl_patient_information->zfpb);
			$this->view->tb_dic_detail_comparison=$tb_dic_detail_comparison;
		}else {
			message("没有你要查询的用户",array("进入患者一览表"=>__BASEPATH.'his/department/list'));
		}
		$this->view->display('display.html');
	}
}
