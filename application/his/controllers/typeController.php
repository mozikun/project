<?php
/**
 * @author mark
 * @filename:typeController.php
 * @package 医疗业务--医疗机构字典表
 * @create 2011-10-13
 */
class his_typeController extends controller {
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."library/Models/tb_dic_ris_type.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		$current_org = get_organization_id($current_region_path);
		$tb_dic_ris_type = new Ttb_dic_ris_type();
		$zlxh  = $this->_request->getParam('zlxh');
		$xmmc  = $this->_request->getParam('xmmc');
		//			echo $name;
		$search = array('zlxh'=>$zlxh,'xmmc'=>$xmmc);
		foreach ($search as $k=>$v){
			$myvalue = trim($v);
			if (!empty($myvalue)){
				if ($k=='zlxh') {
					$tb_dic_ris_type->whereAdd("zlxh='$myvalue'");
				}
				if ($k=='xmmc'){
					$tb_dic_ris_type->whereAdd("xmmc='$myvalue'");
				}
			}
		}
//		$tb_dic_detail_comparison->whereAdd("yljgdm in (".$current_org.")");

		//处理分页
		$nuNumber = $tb_dic_ris_type->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/type/list/page/',					2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_dic_ris_type->limit($startnum,__ROWSOFPAGE);
		if ($nuNumber>0){
			$tb_dic_ris_type->find();
			$typeList = array();
			$x = 0;
			while ($tb_dic_detail_comparison->fetch()){
//				$org   = new Torganization();
//				$org->whereAdd("standard_code='".trim($tb_dic_detail_comparison->yljgdm)."'");
//				$org->find();
//				while ($org->fetch()){
//					$practitionerList[$x]['yyjgdm'] = $org->zh_name;
//				}
				$typeList[$x]['zlxh'] = $tb_dic_ris_type->zlxh;
				$typeList[$x]['id'] = $tb_dic_ris_type->id;
				$typeList[$x]['xmmc'] = $tb_dic_ris_type->xmmc;
				$x++;
			}
		}
		$this->view->typeList = $typeList;
		$this->view->basePath = __BASEPATH;
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->display('list.html');
	}

}
