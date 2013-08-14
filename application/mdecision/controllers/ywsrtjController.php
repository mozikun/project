<?php
/**
 * author CT
 * created 2011-9-19
 *
 */
    class mdecision_ywsrtjController extends  controller {
    public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/tb_yw_ywsrtj.php');
        require_once(__SITEROOT.'library/Models/yw_ywsrtj_v.php');
		require_once(__SITEROOT.'library/Myauth.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = $this->_request->getBasePath();
	}
	//决策首页
	public function indexAction()
	{
		$regionDomain = $this->user['region_id'];
		//获取父分类ID，选择下级分类的时候需要
		$start_time=$this->_request->getParam('start_time')?$this->_request->getParam('start_time'):date("Y-m-d",strtotime("-1 Year"));
		$end_time=$this->_request->getParam('end_time')?$this->_request->getParam('end_time'):date("Y-m-d");
		$this->view->assign('start_time',$start_time);
		$this->view->assign('end_time',$end_time);
		$start_time = date('Ymd',strtotime($start_time));
		$end_time   = date('Ymd',strtotime($end_time));
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
			$tb_yw_ywsrtj=new Tyw_ywsrtj_v(2);
			$tb_yw_ywsrtj->selectAdd("sum(mjzylfy) mjzylfy,sum(zyylfy) zyylfy,sum(mjzypfy) mjzypfy,sum(zyypfy) zyypfy,sum(mjzybylfy) mjzybylfy,sum(zyybylfy) zyybylfy,sum(mjzybypfy) mjzybypfy,sum(zyybypfy) zyybypfy");
			$tb_yw_ywsrtj->whereAdd("yljgdm in (".$row[$rowCount]['organization'].")");
			$tb_yw_ywsrtj->whereAdd("to_char(tbrq,'yyyy-mm-dd') >= '$start_time'");
			$tb_yw_ywsrtj->whereAdd("to_char(tbrq,'yyyy-mm-dd') <= '$end_time'");
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
		//获取所有path 根据登录者的地区id，限制导航条只能在该用户所在的区域内
		$pathSel = new Tregion();
		$pathSel->whereAdd("id='$p_id'");
		$pathSel->find(true);
		$currentPath = $pathSel->region_path;//处理path
		$nuNumber = strpos($currentPath,$regionDomain);
		$strNumber = intval(strlen($currentPath)-$nuNumber);
		$newCurrentPath = substr($currentPath,$nuNumber,$strNumber);
		$realPath = explode(',',$newCurrentPath);
		$realCount = count($realPath);
		$rs = array();
		$rsCount = 0 ;
		foreach ($realPath as $k=>$v){
			$realMenu = new Tregion();
			$realMenu->whereAdd("id='$v'");
			$realMenu->find(true);
			$realMenu->free_statement();
			$rs[$rsCount]['zh_name'] = $realMenu->zh_name;
			$rs[$rsCount]['id'] = trim($realMenu->id);
			$rs[$rsCount]['p_id'] = trim($realMenu->p_id);
			$rsCount++;
		}
		$this->view->assign('rs',$rs);
		$this->view->assign('row',$row);
		$this->view->assign("add_need_id",$p_id);
		$this->view->display('index.html');
	}
    }
?>