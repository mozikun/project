<?php 
/**
 * 用于预防接种记录的统计
 * @author ct
 * time:2010.11.22
 */
class decision_vaccinateController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'library/Models/individual_core.php';
		require_once __SITEROOT.'application/decision/models/countrows.php';
		require_once __SITEROOT.'library/Models/vac_card.php';
		require_once __SITEROOT.'library/Models/vac_info.php';
		require_once(__SITEROOT.'library/Models/region.php');
		require_once __SITEROOT.'library/custom/adodb-time.inc.php';//引入时间处理
	}
	public function indexAction(){
		$this->view->basePath = __BASEPATH;
		//取60岁的时间
		$needTime = adodb_mktime(0,0,0,adodb_date("m",time()),adodb_date("d",time()),adodb_date("Y",time())-60);
		$current_region_path = $this->user['current_region_path'];
		$current_region_id   = $this->user['region_id'];
		$current_year_first  = adodb_mktime(0,0,0,1,1,date("Y",time()));
		$current_year_end    = adodb_mktime(0,0,0,12,31,date("Y",time()));
		//顶部地区导航条
		$nextRegionId        = $this->_request->getParam('parent_id');
		$p_id = empty($nextRegionId)?$current_region_id:$nextRegionId;
		$this->view->caching		=__CACHING;//开启缓存
		$this->view->cache_lifetime	=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('vaccinate.html',$p_id)){
			$pathSel = new Tregion();
			$pathSel->whereAdd("id='$p_id'");
			$pathSel->find(true);
			$currentPath = $pathSel->region_path;//处理path
			$nuNumber = strpos($currentPath,$current_region_id);
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
				$rs[$rsCount]['zh_name'] = $realMenu->zh_name;
				$rs[$rsCount]['id'] = trim($realMenu->id);
				$rs[$rsCount]['p_id'] = trim($realMenu->p_id);
				$rsCount++;
			}
			$this->view->assign('rs',$rs);
			$this->view->add_need_id  = $nextRegionId;
			//处理所有日期
			//echo realTime(6);
			if(empty($nextRegionId)){
				//处理当前登录地区
				$region = new Tregion();
				$region->whereAdd("id='$current_region_id'");
				$region->find(true);
				$this->view->current_zh_name   = $region->zh_name;
				//获取辖区内应建立预防接种证的人数
				$iha = new Tindividual_core();
				$iha->whereAdd("date_of_birth>='$needTime'");
				$iha->whereAdd("region_path like '$current_region_path%'");
				$allNumber = $iha->count();
				//获取当前辖区内已经建立预防接种人数
				$individual = new Tindividual_core();
				$vacc       = new Tvac_card();
				$vacc->joinAdd('inner',$vacc,$individual,'id','uuid');
				$vacc->whereAdd("individual_core.date_of_birth>='$needTime'");
				$vacc->whereAdd("individual_core.region_path like '$current_region_path%'");
				$vacc->whereAdd("vac_card.created_card_time between '$current_year_first' and '$current_year_end'");
				$otherNumber = $vacc->count();
				$current_persent = @round($otherNumber/$allNumber*100,4);
				$this->view->current_persent = $current_persent;
				//年度辖区内乙肝疫苗应接种人数
				$iha_main = new Tindividual_core();
				$iha_main->whereAdd("region_path like '$current_region_path%'");
				$iha_main->whereAdd("date_of_birth = ".realTime(0)." or date_of_birth =".realTime(1)."or date_of_birth =".realTime(6));
				$allynumber = $iha_main->count();
				echo $allynumber;
				//年度辖区内乙肝疫苗实际接种人数
				$iha_main_s = new Tindividual_core();
				$va_main_s  = new Tvac_card();
				$va_info_s  = new Tvac_info();
				$va_main_s->joinAdd('inner',$va_main_s,$iha_main_s,'id','uuid');
				$va_main_s->joinAdd('inner',$va_main_s,$va_info_s,'uuid','uuid');
				$va_main_s->whereAdd("individual_core.region_path like '$current_region_path%'");
				$va_main_s->whereAdd("individual_core.date_of_birth = ".realTime(0)." or individual_core.date_of_birth = ".realTime(1)." or individual_core.date_of_birth =".realTime(6));
				$va_main_s->whereAdd("vac_info.hepatitis_part_1 is not NULL or vac_info.hepatitis_part_2 is not NULL or vac_info.hepatitis_part_3 is not NULL");
				//乙肝疫苗接种率
				$this->view->ypercent = @round($va_main_s->count()/$allynumber*100,4);
			}else{

			}
			//
			$this->view->current_region_id = $current_region_id;

		}
		$this->view->display('vaccinate.html',$p_id);
	}
}
?>