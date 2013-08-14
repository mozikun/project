<?php
class admindecision_ywsrController extends  controller {
    public function init()
	{
		require_once(__SITEROOT.'library/Myauth.php');
		$this->auth = Zend_Auth::getInstance();
		if ($this->auth->hasIdentity()) {
			$this->user = $this->auth->getIdentity();
		}else{
			$this->redirect(__BASEPATH."loging/index/index");		
		}
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/tb_yw_ywsrtj.php');
		require_once(__SITEROOT.'library/Myauth.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = $this->_request->getBasePath();
	}
	public function indexAction(){
		$userresouse = $this->user;
		$currentRegionId = $this->user['region_id'];
		$getreginid      = $this->_request->getParam('region_id');
		$regionId        = empty($getreginid)?$currentRegionId:$getreginid;
		$this->view->reginid  = $regionId;
		$this->view->display("index.html");
	}
	//决策首页
	public function listAction()
	{
		$regionDomain = $this->user['region_id'];
		//获取父分类ID，选择下级分类的时候需要
		$p_id = $this->_request->getParam('parent_id','');
		$p_id = empty($p_id)?$regionDomain:$p_id;
		$region = new Tregion();
		$region->whereAdd("id<>'0'");
		$region->whereAdd("p_id='$p_id'");
		$region->orderby('id asc');
		$region->find();
		$row = array();
		$rowCount=0;
		$sum_mjzylfy =0;
		$sum_zyylfy =0;
		$sum_mjzypfy =0;
		$sum_zyypfy =0;
		$sum_mjzybylfy =0;
		$sum_zyybylfy =0;
		$sum_mjzybypfy =0;
		$sum_zyybypfy =0;
		while($region->fetch())
		{
			$row[$rowCount]['id'] = trim($region->id);
			$row[$rowCount]['zh_name'] = $region->zh_name;
			$row[$rowCount]['region_path'] = $region->region_path;
			$row[$rowCount]['p_id'] = trim($region->p_id);
			$row[$rowCount]['standard_code'] = trim($region->standard_code);
			$current_level = count(explode(',',$region->region_path));
			//显示建档机构名称，用于最后一级
			if($current_level==6)
			{
				$org=new Torganization();
				$org->whereAdd("region_path='$region->region_path'");
				$org->find(true);
				$row[$rowCount]['org_zh_name'] =$org->zh_name;
				$this->view->td_title='2';
			}
			//取本区域下的机构
			$row[$rowCount]['organization']=get_organization_id($region->region_path);
			$row[$rowCount]['organization']=$row[$rowCount]['organization']?$row[$rowCount]['organization']:"' '";
			//取统计数据
			$tb_yw_ywsrtj=new Ttb_yw_ywsrtj(2);
			$tb_yw_ywsrtj->selectAdd("sum(mjzylfy) mjzylfy,sum(zyylfy) zyylfy,sum(mjzypfy) mjzypfy,sum(zyypfy) zyypfy,sum(mjzybylfy) mjzybylfy,sum(zyybylfy) zyybylfy,sum(mjzybypfy) mjzybypfy,sum(zyybypfy) zyybypfy");
			$tb_yw_ywsrtj->whereAdd("yljgdm in (".$row[$rowCount]['organization'].")");
			$tb_yw_ywsrtj->find(true);
			$row[$rowCount]['mjzylfy']=intval($tb_yw_ywsrtj->mjzylfy);
			$row[$rowCount]['zyylfy']=intval($tb_yw_ywsrtj->zyylfy);
			$row[$rowCount]['mjzypfy']=intval($tb_yw_ywsrtj->mjzypfy);
			$row[$rowCount]['zyypfy']=intval($tb_yw_ywsrtj->zyypfy);
			$row[$rowCount]['mjzybylfy']=intval($tb_yw_ywsrtj->mjzybylfy);
			$row[$rowCount]['zyybylfy']=intval($tb_yw_ywsrtj->zyybylfy);
			$row[$rowCount]['mjzybypfy']=intval($tb_yw_ywsrtj->mjzybypfy);
			$row[$rowCount]['zyybypfy']=intval($tb_yw_ywsrtj->zyybypfy);
			$sum_mjzylfy+=$row[$rowCount]['mjzylfy'];
			$sum_zyylfy+=$row[$rowCount]['zyylfy'];
			$sum_mjzypfy+=$row[$rowCount]['mjzypfy'];
			$sum_zyypfy+=$row[$rowCount]['zyypfy'];
			$sum_mjzybylfy+=$row[$rowCount]['mjzybylfy'];
			$sum_zyybylfy+=$row[$rowCount]['zyybylfy'];
			$sum_mjzybypfy+=$row[$rowCount]['mjzybypfy'];
			$sum_zyybypfy+=$row[$rowCount]['zyybypfy'];
			$rowCount++;
		}
		$this->view->assign('sum_mjzylfy',$sum_mjzylfy);
		$this->view->assign('sum_zyylfy',$sum_zyylfy);
		$this->view->assign('sum_mjzypfy',$sum_mjzypfy);
		$this->view->assign('sum_zyypfy',$sum_zyypfy);
		$this->view->assign('sum_mjzybylfy',$sum_mjzybylfy);
		$this->view->assign('sum_zyybylfy',$sum_zyybylfy);
		$this->view->assign('sum_mjzybypfy',$sum_mjzybypfy);
		$this->view->assign('sum_zyybypfy',$sum_zyybypfy);
		$this->view->assign('row',$row);
		$this->view->assign("region_id",$p_id);
		$this->view->display('list.html');
	}
 }