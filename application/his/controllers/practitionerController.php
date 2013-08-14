<?php
/**
 * @author mark
 * @filename:practitionerController.php
 * @package 医疗业务--医疗机构字典表
 * @create 2011-10-13
 */
class his_practitionerController extends controller {
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."library/Models/tb_dic_practitioner_v.php";
		$this->view->basePath = $this->_request->getBasePath();
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->gwlb = array('01'=>'医生','02'=>'护士','03'=>'医技人员','04'=>'行政人员','99'=>'其他');//岗位类别
	}
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		$current_org = get_organization_id($current_region_path);
		$tb_dic_practitioner = new Ttb_dic_practitioner(2);
		$name  = $this->_request->getParam('name');
		$sfzh  = $this->_request->getParam('sfzh');
		//			echo $name;
		$search = array('name'=>$name,'sfzh'=>$sfzh);
		foreach ($search as $k=>$v){
			$myvalue = trim($v);
			if (!empty($myvalue)){
				if ($k=='name') {
					$tb_dic_practitioner->whereAdd("xm='$myvalue'");
				}
				if ($k=='sfzh'){
					$tb_dic_practitioner->whereAdd("sfzh='$myvalue'");
				}
			}
		}

		$tb_dic_practitioner->whereAdd("yljgdm in (".$current_org.")");

		//处理分页
		$nuNumber = $tb_dic_practitioner->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/practitioner/list/page/',					2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_dic_practitioner->limit($startnum,__ROWSOFPAGE);
		if ($nuNumber>0){
			$tb_dic_practitioner->find();
			$practitionerList = array();
			$x = 0;
			while ($tb_dic_practitioner->fetch()){
				$org   = new Torganization();
				$org->whereAdd("standard_code='".trim($tb_dic_practitioner->yljgdm)."'");
				$org->find();
				while ($org->fetch()){
					$practitionerList[$x]['yyjgdm'] = $org->zh_name;
				}
				$practitionerList[$x]['gh'] = $tb_dic_practitioner->gh;
				$practitionerList[$x]['xm'] = $tb_dic_practitioner->xm;
				$practitionerList[$x]['sfzh'] = $tb_dic_practitioner->sfzh;
				$x++;
			}
			$this->view->practitionerList = $practitionerList;
		}
		
		$this->view->basePath = __BASEPATH;
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->display('list.html');
	}
	public function displayAction(){
		$gh  = $this->_request->getParam('gh');
		if ($gh){
			$tb_dic_practitioner = new Ttb_dic_practitioner(2);
			$tb_dic_practitioner->whereAdd("gh='$gh'");
			$tb_dic_practitioner->find(true);
			$org   = new Torganization();
			$org->whereAdd("standard_code='".trim($tb_dic_practitioner->yljgdm)."'");
			$org->find(true);
			$tb_dic_practitioner->yljgdm = $org->zh_name;
			$tb_dic_practitioner->gwlb = getarrayvalue($this->gwlb,$tb_dic_practitioner->gwlb);
			$this->view->tb_dic_practitioner  = $tb_dic_practitioner;
		}else {
			message("没有你要查询的用户",array("进入患者一览表"=>__BASEPATH.'his/department/list'));
		}
		$this->view->display('display.html');
	}	

}
