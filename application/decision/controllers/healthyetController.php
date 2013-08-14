<?php

/**
 * author:hailang
 * package:用于慢病健康体检统计
 * filename:healthyet.php
 * date:2013-2-1
 */
class decision_healthyetController extends controller {
	/**
	 * 自动加载
	 *
	 */
	public function init()
	{
		$this->haveWritePrivilege='';
		require_once(__SITEROOT . '/library/custom/adodb-time.inc.php'); //引入时间处理
		require_once(__SITEROOT . 'library/privilege.php');
		require_once(__SITEROOT . '/library/Models/individual_core.php');
		require_once(__SITEROOT . '/library/Models/examination_table.php');
		require_once(__SITEROOT . '/library/Models/et_examination.php');
		require_once(__SITEROOT . '/library/Models/clinical_history.php');
		require_once(__SITEROOT . '/library/Models/region.php');
		require_once(__SITEROOT . '/library/Models/organization.php');	
		$this->view->basePath = $this->_request->getBasePath();
	}
	/**
	 * 列表
	 */
	public function indexAction()
	{
		$type=$this->_request->getParam("type");
        $decision_time = $this->_request->getParam('decision_time');
        $search_time = $this->_request->getParam('search_time');
        $start_time=$this->_request->getParam("start_time");
        $url_start_time=$this->_request->getParam("url_start_time");
        if(!empty($url_start_time))
        {
        	$start_time=$url_start_time;
        }
        if(!empty($start_time))
        {
        	$start_time=$start_time;
        }
        if (!empty($decision_time))
        {
                $decision_time = strtotime($decision_time);
        }
        if(!empty($search_time))
        {
                $decision_time=  strtotime($search_time);
        }
        $decision_time = $decision_time ? mktime(23, 59, 59, date("m", $decision_time), date("d", $decision_time), date("Y", $decision_time)) : mktime(23, 59, 59, date("m", time()), date("d", time()), date("Y", time()));
        $this->view->decision_time = date('Y-m-d', $decision_time);
        $start_time =empty($start_time)? mktime(0, 0, 0, 1, 1, date('Y', $decision_time)):  strtotime($start_time);
        $this->view->start_time = date('Y-m-d', $start_time);

        //获取需要添加类别的当前父ID
        $p_id = $this->_request->getParam('parent_id', '');
        $regionDomain = $this->user['region_id'];
        //echo $regionDomain;
        $p_id = empty($p_id) ? $regionDomain : $p_id;
        $this->view->caching = __CACHING; //开启缓存
        $this->view->cache_lifetime = __CACHING_LEFTTIME; //缓存时间
        if(!$this->view->is_cached("index.html", $p_id.$type.$decision_time))
        {
        	$regionDomain = $this->user['region_id'];
			$p_id = empty($p_id)?$regionDomain:$p_id;
			$this->view->basePath = $this->_request->getBasePath();
			//列表显示父ID等于1但是ID不等于1的所有数据(不显示根)
        	$region=new Tregion();
        	$region->whereAdd("id<>'0'");
        	$region->whereAdd("p_id='$p_id'");
        	$region->orderby("id asc");
//        	$region->debugLevel(9);
        	$region->find();
        	
        	$row=array();
        	$rowCount=0;
        	//小计所有用到的字段
            $sum_hypertension_total=0;//高血压
        	$sum_diabetes_total=0;//糖尿病
        	$sum_schizophrenia_total=0;//精神分裂症
        	$sum_examization_total=0;
        	
        	while ($region->fetch())
        	{
        		$row[$rowCount]['id']=$region->id;
        		$row[$rowCount]['zh_name']=$region->zh_name;
        		$row[$rowCount]['p_id']=$region->p_id;
        		$row[$rowCount]['standard_code']=$region->standard_code;
        		$row[$rowCount]['region_path']=$region->region_path;
        		$current_level=count(explode(',',$region->region_path));
        		 //显示建档机构名称
                if ($current_level == 6)
                {
                        require_once __SITEROOT . "library/Models/organization.php";
                        $org = new Torganization();
                        $org->whereAdd("region_path='$region->region_path'");
                        $org->find(true);
                        $row[$rowCount]['org_zh_name'] = $org->zh_name;
                        $this->view->td_title = '2';
                }
                if($type=='t1')
                {
                	$sum_hypertension_temp=0;
                	//高血压患病数
                	$individual_core=new Tindividual_core();
                	$clinical_history=new Tclinical_history();
            		$individual_core->joinAdd('left',$individual_core,$clinical_history,'uuid','id');
					$individual_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
					$individual_core->whereAdd("clinical_history.disease_code='2'");
					$individual_core->whereAdd("individual_core.status_flag='1'");
					$individual_core->whereAdd("clinical_history.disease_state='1'");//疾病状态
					
					//$individual_core->whereAdd("clinical_history.disease_date>='$start_time'");
	                //$individual_core->whereAdd("clinical_history.disease_date<='$end_time'");
					$sum_hypertension_temp=$individual_core->count("individual_core.uuid");
					$row[$rowCount]['sum_hypertension']=$sum_hypertension_temp;
					$sum_hypertension_total=$sum_hypertension_temp+$sum_hypertension_total;
                	//健康体检数
                	$sum_examization_temp=0;
                	//$examinztion = new Texamination_table();
                	//$clinical_history = new Tclinical_history();
                	$individual = new Tindividual_core();
					$individual->query("select count(*) as nums from (select DISTINCT EXAMINATION_TABLE.id from EXAMINATION_TABLE where EXAMINATION_TABLE.examination_date>='$start_time' and EXAMINATION_TABLE.examination_date<='$decision_time' and EXAMINATION_TABLE.id in (SELECT INDIVIDUAL_CORE.UUID from INDIVIDUAL_CORE LEFT JOIN CLINICAL_HISTORY on INDIVIDUAL_CORE.UUID=CLINICAL_HISTORY.id where CLINICAL_HISTORY.DISEASE_CODE='2' and  individual_core.status_flag='1' and clinical_history.disease_state='1' and individual_core.region_path like '$region->region_path%'))");
					$individual->fetch();
                	$row[$rowCount]['sum_examization']=$individual->nums;
                	$sum_examization_temp=$individual->nums;
                	$sum_examization_total=$sum_examization_total+$sum_examization_temp;	
                	
                }
                if($type=='t2')
                {
                	$sum_diabetes_temp=0;
                	//糖尿病患者数
                	$individual_core=new Tindividual_core();
                	$clinical_history=new Tclinical_history();
            		$individual_core->joinAdd('left',$individual_core,$clinical_history,'uuid','id');
					$individual_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
					$individual_core->whereAdd("clinical_history.disease_code='3'");
					$individual_core->whereAdd("individual_core.status_flag='1'");
					$individual_core->whereAdd("clinical_history.disease_state='1'");//疾病状态
					//$individual_core->whereAdd("clinical_history.disease_date>='$start_time'");
	                //$individual_core->whereAdd("clinical_history.disease_date<='$end_time'");
					$sum_diabetes_temp=$individual_core->count("individual_core.uuid");
					$row[$rowCount]['sum_diabetes']=$sum_diabetes_temp;
					$sum_diabetes_total=$sum_diabetes_temp+$sum_diabetes_total;
					
					//健康体检数
                	$sum_examization_temp=0;
                	$individual = new Tindividual_core();
					$individual->query("select count(*) as nums from (select DISTINCT EXAMINATION_TABLE.id from EXAMINATION_TABLE where EXAMINATION_TABLE.examination_date>='$start_time' and EXAMINATION_TABLE.examination_date<='$decision_time' and EXAMINATION_TABLE.id in (SELECT INDIVIDUAL_CORE.UUID from INDIVIDUAL_CORE LEFT JOIN CLINICAL_HISTORY on INDIVIDUAL_CORE.UUID=CLINICAL_HISTORY.id where CLINICAL_HISTORY.DISEASE_CODE='3' and  individual_core.status_flag='1' and clinical_history.disease_state='1' and individual_core.region_path like '$region->region_path%'))");
					$individual->fetch();
                	$row[$rowCount]['sum_examization']=$individual->nums;
                	$sum_examization_temp=$individual->nums;
                	$sum_examization_total=$sum_examization_total+$sum_examization_temp;	
                }
                if($type=='t3')
                {
                	$sum_schizophrenia_temp=0;
                	//精神分裂症患者数
                	$individual_core=new Tindividual_core();
                	$clinical_history=new Tclinical_history();
            		$individual_core->joinAdd('left',$individual_core,$clinical_history,'uuid','id');
					$individual_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
					$individual_core->whereAdd("clinical_history.disease_code='8'");
					$individual_core->whereAdd("individual_core.status_flag='1'");
					$individual_core->whereAdd("clinical_history.disease_state='1'");//疾病状态
					//$individual_core->whereAdd("clinical_history.disease_date>='$start_time'");
	                //$individual_core->whereAdd("clinical_history.disease_date<='$end_time'");
					$sum_schizophrenia_temp=$individual_core->count("individual_core.uuid");
					$row[$rowCount]['sum_schizophrenia']=$sum_schizophrenia_temp;
					$sum_schizophrenia_total=$sum_schizophrenia_temp+$sum_schizophrenia_total;
					
					//健康体检数
                	$sum_examization_temp=0;
                	$individual = new Tindividual_core();
					$individual->query("select count(*) as nums from (select DISTINCT EXAMINATION_TABLE.id from EXAMINATION_TABLE where EXAMINATION_TABLE.examination_date>='$start_time' and EXAMINATION_TABLE.examination_date<='$decision_time' and EXAMINATION_TABLE.id in (SELECT INDIVIDUAL_CORE.UUID from INDIVIDUAL_CORE LEFT JOIN CLINICAL_HISTORY on INDIVIDUAL_CORE.UUID=CLINICAL_HISTORY.id where CLINICAL_HISTORY.DISEASE_CODE='8' and  individual_core.status_flag='1' and clinical_history.disease_state='1' and individual_core.region_path like '$region->region_path%'))");
					$individual->fetch();
                	$row[$rowCount]['sum_examization']=$individual->nums;
                	$sum_examization_temp=$individual->nums;
                	$sum_examization_total=$sum_examization_total+$sum_examization_temp;	
                }
                
        		if ($current_level < 6)
                {
                        $this->view->td_title = '1';
                }
                if ($current_level == 6)
                {
                        $this->view->td_title = '2';
                }
        		$rowCount++;
        	}
        	$this->view->assign("type",$type);
        	$this->view->assign("row",$row);
        	$this->view->assign('add_need_id', $p_id);
        	$this->view->assign('sum_hypertension_total',$sum_hypertension_total);
        	$this->view->assign('sum_diabetes_total',$sum_diabetes_total);
        	$this->view->assign('sum_schizophrenia_total',$sum_schizophrenia_total);
        	$this->view->assign('sum_examization_total',$sum_examization_total);
//        	var_dump($row);
			 //获取所有path 根据登录者的地区id，限制导航条只能在该用户所在的区域内
            $pathSel = new Tregion();
            $pathSel->whereAdd("id='$p_id'");
            $pathSel->find(true);
            $currentPath = $pathSel->region_path; //处理path
            $nuNumber = strpos($currentPath, $regionDomain);
            $strNumber = intval(strlen($currentPath) - $nuNumber);
            $newCurrentPath = substr($currentPath, $nuNumber, $strNumber);
            $realPath = explode(',', $newCurrentPath);
            $realCount = count($realPath);
            $rs = array();
            $rsCount = 0;
            foreach ($realPath as $k => $v)
            {
                    $realMenu = new Tregion();
                    $realMenu->whereAdd("id='$v'");
                    $realMenu->find(true);
                    $rs[$rsCount]['zh_name'] = $realMenu->zh_name;
                    $rs[$rsCount]['id'] = trim($realMenu->id);
                    $rs[$rsCount]['p_id'] = trim($realMenu->p_id);
                    $rsCount++;
            }
            $this->view->assign('rs', $rs);
            //获取当前表中所有栏目内容(除去根)
            $length = count(explode(',', $pathSel->region_path));
            //echo $length;
            if ($length <= 4)
            {
                    $this->view->standard_code_size = 6;
            }
            else
            {
                    $this->view->standard_code_size = 3;
            }
        }
		$this->view->display("index.html",$p_id,$type);
	}
}