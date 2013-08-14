<?php
	class his_allergyController extends controller {
		public function init(){
			require_once(__SITEROOT.'library/privilege.php');
			require_once(__SITEROOT.'/library/custom/comm_function.php');
			require_once __SITEROOT."/library/custom/pager.php";//分页类
			require_once(__SITEROOT.'library/Models/organization.php');
			require_once __SITEROOT."library/Models/tb_lis_allergy_result_v.php";
			$this->view->basePath = $this->_request->getBasePath();
		}		
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		$current_org = get_organization_id($current_region_path);
//		echo $current_org;
		$allergy = new Ttb_lis_allergy_result(2);
		$allergy->whereAdd("yljgdm in (".$current_org.")");		
		$ymmc  = $this->_request->getParam('ymmc');
		$myvalue = trim($ymmc);
		if(!empty($myvalue)){
			$allergy->whereAdd("ymmc='$myvalue'");
		}
		$search = array();
		//处理分页
		$nuNumber = $allergy->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/allergy/list/page/',					2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$allergy->limit($startnum,__ROWSOFPAGE);
		if ($nuNumber>0){
			
			$allergy->find();
			$allergyList = array();
			$x = 0;
			while ($allergy->fetch()){
				$org   = new Torganization();
				$org->whereAdd("standard_code='".trim($allergy->yljgdm)."'");
				$org->find();
				while ($org->fetch()){
					$allergyList[$x]['yyjgmc'] = $org->zh_name;
				}
				$allergyList[$x]['ymjglsh']=$allergy->ymjglsh;
				$allergyList[$x]['bgdh'] = $allergy->bgdh;
				$allergyList[$x]['ymmc'] = $allergy->ymmc;
				$allergyList[$x]['bgrq'] = $allergy->bgrq;
				$allergyList[$x]['jcjg'] = $allergy->jcjg;
				$x++;
			}
			$this->view->allergyList = $allergyList;
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
		$ymjglsh  = $this->_request->getParam('ymjglsh');
		$ymjglsh = trim($ymjglsh);
		if ($ymjglsh){
			$allergy = new Ttb_lis_allergy_result();
			$allergy->whereAdd("ymjglsh='$ymjglsh'");
			$allergy->find(true);
			$org   = new Torganization();
			$org->whereAdd("standard_code='".trim($allergy->yljgdm)."'");
			$org->find();
			while ($org->fetch()){
				$this->view->yljg = $org->zh_name;
			}
			$this->view->ymjglsh=$allergy->ymjglsh;
			$this->view->bgdh=$allergy->bgdh;
			$this->view->bgrq=$allergy->bgrq;
			$this->view->ymdm=$allergy->ymdm;
			$this->view->xjdh=$allergy->xjdh;
			$this->view->ymmc=$allergy->ymmc;
			$this->view->jcjg=$allergy->jcjg;
			$xgbz = array('1'=>"正常",'2'=>"修改",'3'=>"撤销");
			foreach ($xgbz as $k=>$v){
				if ($k==$allergy->xgbz){
					$this->view->xgbz=$v;
				}
			}			
		}else {
			message("没有你要查询的用户",array("进入患者一览表"=>__BASEPATH.'his/bacteria/list'));
		}
		$this->view->display('display.html');
	}

	}