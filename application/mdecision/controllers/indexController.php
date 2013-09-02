<?php
/**
 * 医疗业务决策支持
 *
 */
class mdecision_indexController extends controller 
{
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/tb_yw_ywltj.php');
		require_once(__SITEROOT.'library/Models/yw_ywltj_v.php');
		require_once(__SITEROOT.'library/MyAuth.php');
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
		$start_time=date("Ymd",strtotime($start_time));
		$end_time=date("Ymd",strtotime($end_time));
		$p_id = $this->_request->getParam('parent_id','');
		$p_id = empty($p_id)?$regionDomain:$p_id;
		$region = new Tregion();
		$region->whereAdd("id<>'0'");
		$region->whereAdd("p_id='$p_id'");
		$region->orderby('id asc');
		$region->find();
		$row = array();
		$rowCount=0;
		$sum_mzrc=0;
		$sum_jzrc=0;
		$sum_ryrc=0;
		$sum_cyrc=0;
		$sum_zyrs=0;
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
			//防止机构为空时报错
			$row[$rowCount]['organization']=$row[$rowCount]['organization']?$row[$rowCount]['organization']:"' '";
			//取统计数据
			$tb_yw_ywltj=new Tyw_ywltj_v(2);
			$tb_yw_ywltj->selectAdd("sum(mzrc) mzrc,sum(jzrc) jzrc,sum(ryrc) ryrc,sum(cyrc) cyrc,sum(zyrs) zyrs");
			$tb_yw_ywltj->whereAdd("yljgdm in (".$row[$rowCount]['organization'].")");
			$tb_yw_ywltj->whereAdd("ywsj >= '$start_time'");
			$tb_yw_ywltj->whereAdd("ywsj <= '$end_time'");
			//$tb_yw_ywltj->debug(2);
			$tb_yw_ywltj->find(true);
			$row[$rowCount]['mzrc']=abs(intval($tb_yw_ywltj->mzrc));
			$row[$rowCount]['jzrc']=abs(intval($tb_yw_ywltj->jzrc));
			$row[$rowCount]['ryrc']=abs(intval($tb_yw_ywltj->ryrc));
			$row[$rowCount]['cyrc']=abs(intval($tb_yw_ywltj->cyrc));
			$row[$rowCount]['zyrs']=abs(intval($tb_yw_ywltj->zyrs));
			$sum_mzrc+=$row[$rowCount]['mzrc'];
			$sum_jzrc+=$row[$rowCount]['jzrc'];
			$sum_ryrc+=$row[$rowCount]['ryrc'];
			$sum_cyrc+=$row[$rowCount]['cyrc'];
			$sum_zyrs+=$row[$rowCount]['zyrs'];
			$rowCount++;
		}
		$this->view->assign('sum_mzrc',$sum_mzrc);
		$this->view->assign('sum_jzrc',$sum_jzrc);
		$this->view->assign('sum_ryrc',$sum_ryrc);
		$this->view->assign('sum_cyrc',$sum_cyrc);
		$this->view->assign('sum_zyrs',$sum_zyrs);
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
		$this->view->assign("add_need_id",$p_id);
		$this->view->assign('rs',$rs);
		$this->view->assign('row',$row);
		$this->view->assign('this_url',$_SERVER['HTTP_REFERER']);
		$this->view->assign('basePath',__BASEPATH);
		$this->view->display('index.html');
	}
}
?>