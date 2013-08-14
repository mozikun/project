<?php
/**
 * @author mark
 * @filename:departmentController.php
 * @package 医疗业务--医疗机构字典表
 * @create 2011-10-13
 */
class his_departmentController extends controller {
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."library/Models/tb_dic_department_v.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		$current_org = get_organization_id($current_region_path);
		$department = new Ttb_dic_department(2);
		$yyksmc  = $this->_request->getParam('yyksmc');
		$department->whereAdd("yljgdm in (".$current_org.")");
		$myvalue = trim($yyksmc);
		if(!empty($myvalue)){
			$department->whereAdd("yyksmc='$myvalue'");
		}
		//处理分页
		$search = array();
		$nuNumber = $department->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/department/list/page/',					2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$department->limit($startnum,__ROWSOFPAGE);
		if ($nuNumber>0){
			$department->find();
			$departmentList = array();
			$x = 0;
			while ($department->fetch()){
				$org   = new Torganization();
				$org->whereAdd("standard_code='".trim($department->yljgdm)."'");
				$org->find();
				while ($org->fetch()){
					$departmentList[$x]['yyjgmc'] = $org->zh_name;
				}
				$departmentList[$x]['yyksdm']=$department->yyksdm;
				$departmentList[$x]['yyksmc'] = $department->yyksmc;
				$x++;
			}
			$this->view->departmentList = $departmentList;
		}else {
			$str = '<tr><td colspan="3" align="center">当前暂时没有任何数据！</td></tr>';
			$this->view->str = $str;
		}
		$this->view->basePath = __BASEPATH;
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->display('list.html');
	}
	public function displayAction(){
		$yyksdm  = $this->_request->getParam('yyksdm');
		if ($yyksdm){
			$department = new Ttb_dic_department(2);
			$department->whereAdd("yyksdm='$yyksdm'");
			$department->find(true);
			$org   = new Torganization();
			$org->whereAdd("standard_code='".trim($department->yljgdm)."'");
			$org->find();
			while ($org->fetch()){
				$this->view->yljg = $org->zh_name;
			}
			$this->view->yyksmc=$department->yyksmc;
			$this->view->ptksmc=$department->ptksmc;
		}else {
			message("没有你要查询的用户",array("进入患者一览表"=>__BASEPATH.'his/department/list'));
		}
		$this->view->display('display.html');
	}

}
