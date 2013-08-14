<?php
/**
 * @author mark
 * @filename:medicineController.php
 * @package 医疗业务--医疗机构字典表
 * @create 2011-10-13
 */
class his_medicineController extends controller {
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."library/Models/tb_dic_detail_medicine_v.php";
		$this->view->basePath = $this->_request->getBasePath();
	    require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->sfjbyw = array(0=>'非基药',1=>'基药');//是否基药
		$this->validation = array(0=>'作废',1=>'有效');//有效性
	}
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		$current_org = get_organization_id($current_region_path);
		$tb_dic_detail_medicine = new Ttb_dic_detail_medicine(2);
		$zlxh  = $this->_request->getParam('ybid');
		$xmmc  = $this->_request->getParam('ypmc');
		//			echo $name;
		$search = array('ybid'=>$zlxh,'ypmc'=>$xmmc);
		foreach ($search as $k=>$v){
			$myvalue = trim($v);
			if (!empty($myvalue)){
				if ($k=='ybid') {
					$tb_dic_detail_medicine->whereAdd("ybid='$myvalue'");
				}
				if ($k=='ypmc'){
					$tb_dic_detail_medicine->whereAdd("ypmc='$myvalue'");
				}
			}
		}
//		$tb_dic_detail_comparison->whereAdd("yljgdm in (".$current_org.")");

		//处理分页
		$nuNumber = $tb_dic_detail_medicine->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/medicine/list/page/',					2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_dic_detail_medicine->limit($startnum,__ROWSOFPAGE);
		if ($nuNumber>0){
			$tb_dic_detail_medicine->find();
			$medicineList = array();
			$x = 0;
			while ($tb_dic_detail_medicine->fetch()){
//				$org   = new Torganization();
//				$org->whereAdd("standard_code='".trim($tb_dic_detail_comparison->yljgdm)."'");
//				$org->find();
//				while ($org->fetch()){
//					$practitionerList[$x]['yyjgdm'] = $org->zh_name;
//				}
				$medicineList[$x]['ybid'] = $tb_dic_detail_medicine->ybid;
				$medicineList[$x]['ypmc'] = $tb_dic_detail_medicine->ypmc;
				$medicineList[$x]['ypjx'] = $tb_dic_detail_medicine->ypjx;
				$x++;
			}
		}
		$this->view->medicineList = $medicineList;
		$this->view->basePath = __BASEPATH;
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->display('list.html');
	}
	public function displayAction(){
		$ybid  = $this->_request->getParam('ybid');
		if ($ybid){
			$medicine = new Ttb_dic_detail_medicine(2);
			$medicine->whereAdd("ybid='$ybid'");
			$medicine->find(true);
			$this->view->ybid=$medicine->ybid;
			$this->view->ypmc=$medicine->ypmc;
			$this->view->ybbm=$medicine->ybbm;
			$this->view->ypjx=$medicine->ypjx;
			$this->view->sfjbyw=getarrayvalue($this->sfjbyw,$medicine->sfjbyw);
			$this->view->validation=getarrayvalue($this->validation,$medicine->validation);
		}else {
			message("没有你要查询的用户",array("进入患者一览表"=>__BASEPATH.'his/department/list'));
		}
		$this->view->display('display.html');
	}
}
