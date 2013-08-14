<?php
	class his_bacteriaController extends controller {
		public function init(){
			require_once(__SITEROOT.'library/privilege.php');
			require_once(__SITEROOT.'/library/custom/comm_function.php');
			require_once __SITEROOT."/library/custom/pager.php";//分页类
			require_once(__SITEROOT.'library/Models/organization.php');
			require_once __SITEROOT."library/Models/tb_lis_bacteria_result_v.php";
			$this->view->basePath = $this->_request->getBasePath();
		}		
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		$current_org = get_organization_id($current_region_path);
//		echo $current_org;
		$bacteria = new Ttb_lis_bacteria_result(2);
		$bacteria->whereAdd("yljgdm in (".$current_org.")");		
		$xjmc  = $this->_request->getParam('xjmc');
		$myvalue = trim($xjmc);
		if(!empty($myvalue)){
			$bacteria->whereAdd("xjmc='$myvalue'");
		}
		$search = array();
		//处理分页
		$nuNumber = $bacteria->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/bacteria/list/page/',					2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$bacteria->limit($startnum,__ROWSOFPAGE);
		if ($nuNumber>0){
			$bacteria->find();
			$bacteriaList = array();
			$x = 0;
			while ($bacteria->fetch()){
				$org   = new Torganization();
				$org->whereAdd("standard_code='".trim($bacteria->yljgdm)."'");
				$org->find();
				while ($org->fetch()){
					$bacteriaList[$x]['yyjgmc'] = $org->zh_name;
				}
				$bacteriaList[$x]['xjjglsh']=$bacteria->xjjglsh;
				$bacteriaList[$x]['bgdh'] = $bacteria->bgdh;
				$bacteriaList[$x]['xjmc'] = $bacteria->xjmc;
				$bacteriaList[$x]['bgrq'] = $bacteria->bgrq;
				$bacteriaList[$x]['jcjg'] = $bacteria->jcjg;
				$x++;
			}
			$this->view->bacteriaList = $bacteriaList;
		}else {
			$str = '<tr><td colspan="5" align="center">当前暂时没有任何数据！</td></tr>';
			$this->view->str = $str;
		}
		
		$this->view->basePath = __BASEPATH;
		$page = $links->subPageCss2();
		$this->view->page = $page;
		$this->view->display('list.html');
	}
	public function displayAction(){
		$xjjglsh  = $this->_request->getParam('xjjglsh');
		$xjjglsh = trim($xjjglsh);
		if ($xjjglsh){
			$bacteria = new Ttb_lis_bacteria_result(2);
			$bacteria->whereAdd("xjjglsh='$xjjglsh'");
			$bacteria->find(true);
			$org   = new Torganization();
			$org->whereAdd("standard_code='".trim($bacteria->yljgdm)."'");
			$org->find();
			while ($org->fetch()){
				$this->view->yljg = $org->zh_name;
			}
			$this->view->xjjglsh=$bacteria->xjjglsh;
			$this->view->bgdh=$bacteria->bgdh;
			$this->view->bgrq=$bacteria->bgrq;
			$this->view->xjdh=$bacteria->xjdh;
			$this->view->xjmc=$bacteria->xjmc;
			$this->view->jcjg=$bacteria->jcjg;
			$xgbz = array('1'=>"正常",'2'=>"修改",'3'=>"撤销");
			foreach ($xgbz as $k=>$v){
				if ($k==$bacteria->xgbz){
					$this->view->xgbz=$v;
				}
			}			
		}else {
			message("没有你要查询的用户",array("进入患者一览表"=>__BASEPATH.'his/bacteria/list'));
		}
		$this->view->display('display.html');
	}

	}