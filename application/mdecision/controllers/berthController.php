<?php
/**
* @author：Lake
* @filename: berthController.php
* @package：医疗业务决策支持 - 床位使用情况分析
* @create：2011-09-19
*/
class mdecision_berthController extends controller 
{
	public function init() {
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/MyAuth.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = $this->_request->getBasePath();
		//床位使用表
		require_once(__SITEROOT.'library/Models/tb_yw_cwsyl.php');
        require_once(__SITEROOT.'library/Models/yw_cwsyl_v.php');
	}
	
	public function indexAction() {
		
		$regionDomain = $this->user['region_id'];
		//获取父分类ID，选择下级分类的时候需要
		$start_time=$p_id = $this->_request->getParam('start_time',date("Y-m-d"));
		$end_time=$p_id = $this->_request->getParam('end_time',date("Y-m-d"));
		$this->view->assign('start_time',$start_time);
		$this->view->assign('end_time',$end_time);
		$p_id = $this->_request->getParam('parent_id','');
		$p_id = empty($p_id)?$regionDomain:$p_id;
		$region = new Tregion();
		$region->whereAdd("id<>'0'");
		$region->whereAdd("p_id='$p_id'");
		$region->orderby('id asc');
		$region->find();
		$row = array();
		/**
		 *  5	编制床位数	EDCW
			6	每日实际床位数	SJCWS
			7	每日实际开放床位数	SJKFCWS
			8	每日实际使用床位数	SYCW
			9	今日入院	JRRY
			10	今日出院	JRCY
			11	今日转入	JRZR
			12	今日转出	JRZC
			13	今日病重	JRBZ
			14	今日病危	JRBW
			15	今日死亡	JRSW
			16	住院人数	ZYRS
		 */
		$rowCount=0;
		$sum_edcw=0;
		$sum_sjcws=0;
		$sum_sjkfcws=0;
		$sum_sycw=0;
		$sum_jrry=0;
		$sum_jrcy=0;
		$sum_jrzr=0;
		$sum_jrzc=0;
		$sum_jrbz=0;
		$sum_jrbw=0;
		$sum_jrsw=0;
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
			$tb_yw_cwsyl=new Tyw_cwsyl_v(2);
			$tb_yw_cwsyl->selectAdd("sum(edcw) edcw,sum(sjcws) sjcws,sum(sjkfcws) ryrc,sum(sycw) sycw,sum(jrry) jrry,sum(jrcy) jrcy,sum(jrzr) jrzr,sum(jrbz) jrbz,sum(jrzc) jrzc,sum(jrbw) jrbw,sum(jrsw) jrsw,sum(zyrs) zyrs");
			$tb_yw_cwsyl->whereAdd("yljgdm in (".$row[$rowCount]['organization'].")");
			//时间查询，按业务时间进行比较
			
			$start_time = $this->_request->getParam('start_time')?date('Ymd',strtotime($this->_request->getParam('start_time'))):date("Ymd",time());
			
			$view_start_time = $this->_request->getParam('start_time')?$this->_request->getParam('start_time'):date("Y-m-d");
			
			$tb_yw_cwsyl->whereAdd("ywsj = '$start_time'");
			$this->view->assign('start_time',$view_start_time);
			//$tb_yw_ywltj->whereAdd("tbrq <= '$end_time'");
			$tb_yw_cwsyl->find(true);
			$row[$rowCount]['edcw']=intval($tb_yw_cwsyl->edcw);
			$row[$rowCount]['sjcws']=intval($tb_yw_cwsyl->sjcws);
			$row[$rowCount]['sjkfcws']=intval($tb_yw_cwsyl->sjkfcws);
			$row[$rowCount]['sycw']=intval($tb_yw_cwsyl->sycw);
			$row[$rowCount]['jrry']=intval($tb_yw_cwsyl->jrry);
			$row[$rowCount]['jrcy']=intval($tb_yw_cwsyl->jrcy);
			$row[$rowCount]['jrzr']=intval($tb_yw_cwsyl->jrzr);
			$row[$rowCount]['jrbz']=intval($tb_yw_cwsyl->jrbz);
			$row[$rowCount]['jrzc']=intval($tb_yw_cwsyl->jrzc);
			$row[$rowCount]['jrbw']=intval($tb_yw_cwsyl->jrbw);
			$row[$rowCount]['jrsw']=intval($tb_yw_cwsyl->jrsw);
			$row[$rowCount]['zyrs']=intval($tb_yw_cwsyl->zyrs);
			$sum_edcw += $row[$rowCount]['edcw'];
			$sum_sjcws += $row[$rowCount]['sjcws'];
			$sum_sjkfcws += $row[$rowCount]['sjkfcws'];
			$sum_sycw += $row[$rowCount]['sycw'];
			$sum_jrry += $row[$rowCount]['jrry'];
			$sum_jrcy += $row[$rowCount]['jrcy'];
			$sum_jrzr += $row[$rowCount]['jrzr'];
			$sum_jrbz += $row[$rowCount]['jrbz'];
			$sum_jrzc += $row[$rowCount]['jrzc'];
			$sum_jrbw += $row[$rowCount]['jrbw'];
			$sum_jrsw += $row[$rowCount]['jrsw'];
			$sum_zyrs += $row[$rowCount]['zyrs'];
			$rowCount++;
		}
		
		$this->view->assign('sum_edcw',$sum_edcw);
		$this->view->assign('sum_sjcws',$sum_sjcws);
		$this->view->assign('sum_sjkfcws',$sum_sjkfcws);
		$this->view->assign('sum_sycw',$sum_sycw);
		$this->view->assign('sum_jrry',$sum_jrry);
		$this->view->assign('sum_jrcy',$sum_jrcy);
		$this->view->assign('sum_jrzr',$sum_jrzr);
		$this->view->assign('sum_jrbz',$sum_jrbz);
		$this->view->assign('sum_jrzc',$sum_jrzc);
		$this->view->assign('sum_jrbw',$sum_jrbw);
		$this->view->assign('sum_jrsw',$sum_jrsw);
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
		$this->view->assign('basePath',__BASEPATH);
		$this->view->display('index.html');
	}
}
?>