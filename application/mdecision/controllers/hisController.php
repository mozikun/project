<?php
/**
 * mdecision_hisController
 * 
 * 医疗业务分析 中联 此文件完成住院、出院、在院人数统计
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class mdecision_hisController extends controller
{
    public function init()
    {
        require_once(__SITEROOT.'library/privilege.php');
 		require_once __SITEROOT.'library/Models/chs_center.php';
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/api_summary.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Myauth.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = $this->_request->getBasePath();
    }
    /**
     * mdecision_hisController::indexAction()
     * 
     * 完成地区列表，及小计的取值
     * 
     * @return void
     */
    public function indexAction()
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
			//取本区域下的机构
			$row[$rowCount]['organization']=get_organization_id($region->region_path);
			//防止机构为空时报错
			$row[$rowCount]['organization']=$row[$rowCount]['organization']?$row[$rowCount]['organization']:"' '";
			$rowCount++;
		}
        $org=new Tregion();
        $org->whereAdd("id='$p_id'");
        $org->find(true);
        $region=$org->region_path;
        $org->free_statement();
        $org_array="select id from organization where region_path like '".$region.",%'";
        //取小计数据
        $total['zyrs']=0;
        $total['cyrs']=0;
        $total['rzyrs']=0;
        $api_summary=new Tapi_summary();
        $api_summary->selectAdd("count(distinct patient_identity_card) as zyrs");
        $api_summary->whereAdd("org_id in ($org_array)");
        $api_summary->whereAdd("emr09_time is not null and (emr09_time >= '$start_time' and emr09_time <= '$decision_time')");
        $api_summary->find(true);
        $total['zyrs']=$api_summary->zyrs;
        $api_summary->free_statement();
        
        $api_summary=new Tapi_summary();
        $api_summary->selectAdd("count(distinct patient_identity_card) as cyrs");
        $api_summary->whereAdd("org_id in ($org_array)");
        $api_summary->whereAdd("emr09_time is not null and (emr12_time >= '$start_time' and emr12_time <= '$decision_time')");
        $api_summary->find(true);
        $total['cyrs']=$api_summary->cyrs;
        $api_summary->free_statement();
        
        $total['rzyrs']=$total['zyrs']-$total['cyrs'];
        
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
		$this -> view -> display('his_index.html');
    }
    /**
     * mdecision_hisController::ajaxAction()
     * 
     * ajax请求获取对应的数据
     * 
     * @return void
     */
    public function ajaxAction()
    {
        $org_id = $this->_request->getParam('org_id');
		$type = $this->_request->getParam('t');
        $decision_time=$this->_request->getParam('decision_time');
        //接受Post的时间，防止参数冲突
        $end_time=$this->_request->getParam('end_time');
        $decision_time=$end_time?strtotime($end_time)+(3600*24-1):($decision_time?strtotime($decision_time)+(3600*24-1):time());
        $start_time=$this->_request->getParam('start_time');
        //通过url传递的开始时间
        $url_start_time=$this->_request->getParam('url_start_time');
        $start_time=$start_time?strtotime($start_time):($url_start_time?strtotime($url_start_time):mktime(0,0,0,1,1,date('Y',$decision_time)));
        $org=new Tregion();
        $org->whereAdd("id='$org_id'");
        $org->find(true);
        $region=$org->region_path;
        $org->free_statement();
        $org_array="select id from organization where region_path like '".$region."%'";
        //取数据
        $zyrs=0;
        $cyrs=0;
        $rzyrs=0;
        if($type=='zyrs' || $type=='rzyrs')
        {
            $api_summary=new Tapi_summary();
            $api_summary->selectAdd("count(distinct patient_identity_card) as zyrs");
            $api_summary->whereAdd("org_id in ($org_array)");
            $api_summary->whereAdd("emr09_time is not null and (emr09_time >= '$start_time' and emr09_time <= '$decision_time')");
            $api_summary->find(true);
            $zyrs=$api_summary->zyrs;
            $api_summary->free_statement();
            if($type=='zyrs')
            {
                echo $zyrs;
                exit;
            }
        }
        if($type=='cyrs' || $type=='rzyrs')
        {
            $api_summary=new Tapi_summary();
            $api_summary->selectAdd("count(distinct patient_identity_card) as cyrs");
            $api_summary->whereAdd("org_id in ($org_array)");
            $api_summary->whereAdd("emr09_time is not null and (emr12_time >= '$start_time' and emr12_time <= '$decision_time')");
            $api_summary->find(true);
            $cyrs=$api_summary->cyrs;
            $api_summary->free_statement();
            if($type=='cyrs')
            {
                echo $cyrs;
                exit;
            }
        }
        if($type=='rzyrs')
        {
            echo $rzyrs=$zyrs-$cyrs;
            exit;
        }
    }
}