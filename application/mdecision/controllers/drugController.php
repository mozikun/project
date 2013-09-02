<?php
/**
 *  @author mark
 * 	@package 药品存库
 */
class mdecision_drugController extends controller {
	public function init()
	{
  		require_once(__SITEROOT.'library/privilege.php');
 		require_once __SITEROOT.'library/Models/chs_center.php';
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/wd_med_store.php');
        require_once(__SITEROOT.'library/Models/wd_med_store_v.php');
        require_once(__SITEROOT.'library/Models/api_drug.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/MyAuth.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = $this->_request->getBasePath();
	}
	//药品库存首页
	public function indexAction(){
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
		$rowCount=0;
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
			//取数据
			$wd_med_store=new Twd_med_store_v( 2 );
			$wd_med_store->whereAdd("yljgdm in (".$row[$rowCount]['organization'].")");
			$wd_med_store->orderby("ypmc asc");
			$wd_med_store->groupby("ypmc,ypdw,sfjy");
			$wd_med_store->selectAdd("sum(ypkc) as total,ypmc as ypmc,ypdw as ypdw,sfjy as sfjy");
			//$wd_med_store->debugLevel(9);
			$wd_med_store->find();
			while ($wd_med_store->fetch()){
				$row[$rowCount]['ypmc'] = $wd_med_store->ypmc;
				$row[$rowCount]['ypkc'] = $wd_med_store->total;
				$row[$rowCount]['ypbzdw'] = $wd_med_store->ypbzdw;
                $row[$rowCount]['ypdw'] = $wd_med_store->ypdw;
				$sfjy = array(0=>'非基药',1=>'基药');
                $row[$rowCount]['sfjy'] = isset($sfjy[$wd_med_store->sfjy])?$sfjy[$wd_med_store->sfjy]:'非基药';
			$rowCount++;
			}
			$rowCount++;
		}
//		$num = $wd_med_store->count('*');
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
		$this->view->num = $num;
		$this->view->assign("add_need_id",$p_id);
		$this->view->assign('rs',$rs);
		$this->view->assign('row',$row);
		$this->view->assign('basePath',__BASEPATH);
		$this -> view -> display('index.html');
	
	}
    /**
     * mdecision_drugController::drugAction()
     * 
     * 此控制器负责统计用药、基药比
     * 
     * 我好笨（仅此控制器）
     * 
     * @return void
     */
    public function drugAction()
    {
        $regionDomain = $this->user['region_id'];
		//获取父分类ID，选择下级分类的时候需要
		//2012-08-20按照罗领导要求，增加按年统计
        $decision_time=$this->_request->getParam('decision_time');
        //接受Post的时间，防止参数冲突
        $end_time=$this->_request->getParam('end_time');
        $decision_time=$end_time?strtotime($end_time)+(3600*24-1):($decision_time?strtotime($decision_time)+(3600*24-1):time());
        $this->view->decision_time=date('Y-m-d',$decision_time);
        $start_time=$this->_request->getParam('start_time');
        //通过url传递的开始时间
        $url_start_time=$this->_request->getParam('url_start_time');
        $start_time=$start_time?strtotime($start_time):($url_start_time?strtotime($url_start_time):mktime(0,0,0,1,1,date('Y',$decision_time)));
        $this->view->start_time=date('Y-m-d',$start_time);
		$p_id = $this->_request->getParam('parent_id','');
		$p_id = empty($p_id)?$regionDomain:$p_id;
		$region = new Tregion();
		$region->whereAdd("id<>'0'");
		$region->whereAdd("p_id='$p_id'");
		$region->orderby('id asc');
		$region->find();
		$row = array();
		$rowCount=0;
        $total=array();
        $total['yyzs']=0;
        $total['jys']=0;
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
            else
            {
                $this->view->td_title='1';
            }
            $org_array="select id from organization where region_path like '".$region->region_path."%'";
            $api_drug=new Tapi_drug();
            $api_drug->whereAdd("org_id in ($org_array)");
            $api_drug->whereAdd("dignosis_time is not null and (dignosis_time >= '$start_time' and dignosis_time <= '$decision_time')");
            $total['yyzs']+=$row[$rowCount]['yyzs']=$api_drug->count();
            $api_drug->free_statement();
            //基药
            $api_drug=new Tapi_drug();
            $api_drug->whereAdd("org_id in ($org_array)");
            $api_drug->whereAdd("dignosis_time is not null and (dignosis_time >= '$start_time' and dignosis_time <= '$decision_time')");
            $api_drug->whereAdd("based_medicine=1");
            $total['jys']+=$row[$rowCount]['jys']=$api_drug->count();
            $api_drug->free_statement();
            //基药比
            $row[$rowCount]['jyb']=@round($row[$rowCount]['jys']/$row[$rowCount]['yyzs'],4)*100;
			//取本区域下的机构
			$row[$rowCount]['organization']=get_organization_id($region->region_path);
			//防止机构为空时报错
			$row[$rowCount]['organization']=$row[$rowCount]['organization']?$row[$rowCount]['organization']:"' '";
			$rowCount++;
		}
        $total['jyb']=@round($total['jys']/$total['yyzs'],4)*100;
        
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
        $this->view->assign('total',$total);
		$this->view->assign('row',$row);
		$this->view->assign('basePath',__BASEPATH);
		$this -> view -> display('drug_drug.html');
    }
}