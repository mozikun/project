<?php
/**
 * mdecision_feeController
 * 
 * 医疗费用分类统计表
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class mdecision_feeController extends controller
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
     * mdecision_feeController::indexAction()
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
            $org_array="select id from organization where region_path like '".$region->region_path."%'";
            $api_summary=new Tapi_summary();
            $api_summary->whereAdd("org_id in ($org_array)");
            $api_summary->whereAdd("updated is not null and (updated >= '$start_time' and updated <= '$decision_time') and medical_code is not null");
			$api_summary->selectAdd("sum(inspection_fees) as inspection_fees,sum(western_medicine) as western_medicine,sum(treatment_costs) as treatment_costs,sum(bed_fee) as bed_fee,sum(nursing_fees) as nursing_fees,sum(special_fee) as special_fee,sum(other_fee) as other_fee,sum(chinese_medicine) as chinese_medicine,sum(difference_fee) as difference_fee,sum(sum_fee) as sum_fee,medical_code");
            $api_summary->groupBy("medical_code");
            $api_summary->find();
            $j=0;
            $total=array();
            $medical_code=array('01'=>'社会基本医疗保险','02'=>'商业保险','03'=>'自费医疗','04'=>'公费医疗','05'=>'大病统筹','99'=>'其它');
            foreach($medical_code as $k=>$v)
            {
                $total[$k]['inspection_fees']=0;
                $total[$k]['western_medicine']=0;
                $total[$k]['treatment_costs']=0;
                $total[$k]['bed_fee']=0;
                $total[$k]['nursing_fees']=0;
                $total[$k]['special_fee']=0;
                $total[$k]['other_fee']=0;
                $total[$k]['chinese_medicine']=0;
                $total[$k]['difference_fee']=0;
                $total[$k]['sum_fee']=0;
            }
            while($api_summary->fetch())
            {
                $total[$api_summary->medical_code]['inspection_fees']+=$row[$rowCount][$api_summary->medical_code]['inspection_fees']=$api_summary->inspection_fees;
                $total[$api_summary->medical_code]['western_medicine']+=$row[$rowCount][$api_summary->medical_code]['western_medicine']=$api_summary->western_medicine;
                $total[$api_summary->medical_code]['treatment_costs']+=$row[$rowCount][$api_summary->medical_code]['treatment_costs']=$api_summary->treatment_costs;
                $total[$api_summary->medical_code]['bed_fee']+=$row[$rowCount][$api_summary->medical_code]['bed_fee']=$api_summary->bed_fee;
                $total[$api_summary->medical_code]['nursing_fees']+=$row[$rowCount][$api_summary->medical_code]['nursing_fees']=$api_summary->nursing_fees;
                $total[$api_summary->medical_code]['special_fee']+=$row[$rowCount][$api_summary->medical_code]['special_fee']=$api_summary->special_fee;
                $total[$api_summary->medical_code]['other_fee']+=$row[$rowCount][$api_summary->medical_code]['other_fee']=$api_summary->other_fee;
                $total[$api_summary->medical_code]['chinese_medicine']+=$row[$rowCount][$api_summary->medical_code]['chinese_medicine']=$api_summary->chinese_medicine;
                $total[$api_summary->medical_code]['difference_fee']+=$row[$rowCount][$api_summary->medical_code]['difference_fee']=$api_summary->difference_fee;
                $total[$api_summary->medical_code]['sum_fee']+=$row[$rowCount][$api_summary->medical_code]['sum_fee']=$api_summary->sum_fee;
                $j++;
            }
            $api_summary->free_statement();
			//取本区域下的机构
			$row[$rowCount]['organization']=get_organization_id($region->region_path);
			//防止机构为空时报错
			$row[$rowCount]['organization']=$row[$rowCount]['organization']?$row[$rowCount]['organization']:"' '";
			$rowCount++;
		}
        
        
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
        $this->view->medical_code=$medical_code;
		$this->view->assign("add_need_id",$p_id);
		$this->view->assign('rs',$rs);
        $this->view->assign('total',$total);
		$this->view->assign('row',$row);
		$this->view->assign('basePath',__BASEPATH);
		$this -> view -> display('fee_index.html');
    }
}