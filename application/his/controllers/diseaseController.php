<?php
/**
 * @author mark
 * @filename:diseaseController.php
 * @package 医疗业务-- 诊断字典表
 * @create 2011-10-13
 */
class his_diseaseController extends controller {
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'/library/custom/comm_function.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."library/Models/tb_dic_disease_v.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		$current_org = get_organization_id($current_region_path);
		$tb_dic_disease = new Ttb_dic_disease(2);
		$id  = $this->_request->getParam('id');
		$dmxmc  = $this->_request->getParam('dmxmc');
		//			echo $name;
		$search = array('id'=>$id,'dmxmc'=>$dmxmc);
		foreach ($search as $k=>$v){
			$myvalue = trim($v);
			if (!empty($myvalue)){
				if ($k=='id') {
					$tb_dic_disease->whereAdd("id='$myvalue'");
				}
				if ($k=='dmxmc'){
					$tb_dic_disease->whereAdd("dmxmc='$myvalue'");
				}
			}
		}


//		$tb_dic_practitioner->whereAdd("yljgdm in (".$current_org.")");

		//处理分页
		$nuNumber = $tb_dic_disease->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/disease/list/page/',					2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_dic_disease->limit($startnum,__ROWSOFPAGE);
		if ($nuNumber>0){
			$tb_dic_disease->find();
			$diseaseList = array();
			$x = 0;
			while ($tb_dic_disease->fetch()){
				$diseaseList[$x]['id'] = $tb_dic_disease->id;
				$diseaseList[$x]['dmxz'] = $tb_dic_disease->dmxz;
				$diseaseList[$x]['dmxmc'] = $tb_dic_disease->dmxmc;
				$x++;
			}
			$this->view->diseaseList = $diseaseList;
		}
		$this->view->basePath = __BASEPATH;
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->display('list.html');
	}
	public function displayAction(){
		$id  = $this->_request->getParam('id');
		if ($id){
			$disease = new Ttb_dic_disease(2);
			$disease->whereAdd("id='$id'");
			$disease->find(true);
			$this->view->id=$disease->id;
			$this->view->fdmz=$disease->fdmz;
			$this->view->dmxz=$disease->dmxz;
			$this->view->dmxmc=$disease->dmxmc;
			$this->view->pyzjm=$disease->pyzjm;
		}else {
			message("没有你要查询的用户",array("进入患者一览表"=>__BASEPATH.'his/department/list'));
		}
		$this->view->display('display.html');
	}
}
