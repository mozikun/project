<?php
/**
 * mdecision_jbController
 * 
 * 疾病顺位分析统计表
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class mdecision_jbController extends controller
{
    public function init()
    {
        require_once(__SITEROOT.'library/privilege.php');
 		require_once __SITEROOT.'library/Models/chs_center.php';
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/api_disease.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/MyAuth.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = $this->_request->getBasePath();
    }
    /**
     * mdecision_jbController::indexAction()
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
            $api_disease=new Tapi_disease();
            $api_disease->whereAdd("diagnosis_org_id in ($org_array)");
            $api_disease->whereAdd("dignosis_date is not null and (dignosis_date >= '$start_time' and dignosis_date <= '$decision_time')");
            $api_disease->groupby("disease_name,disease_code");
			$api_disease->limit(0,10);
			$api_disease->selectAdd("count(disease_name) as total,disease_name as disease_name,disease_code as disease_code");
			$api_disease->orderby("total desc");
            $api_disease->find();
            $j=0;
            $diseases=array();
            $total=array();
            while($api_disease->fetch() || $j<10)
            {
                $row[$rowCount]['name'][$j]['disease_name']=$api_disease->disease_name;
                $row[$rowCount]['disease'][$j]['disease_name']=$api_disease->disease_name;
                $row[$rowCount]['disease'][$j]['disease_code']=$api_disease->disease_code;
                $row[$rowCount]['disease'][$j]['nums']=$api_disease->total;
                $j++;
            }
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
		$this->view->assign("add_need_id",$p_id);
		$this->view->assign('rs',$rs);
        $this->view->assign('diseases',$diseases);
        $this->view->assign('total',$total);
		$this->view->assign('row',$row);
		$this->view->assign('basePath',__BASEPATH);
		$this -> view -> display('jb_index.html');
    }
    /**
     * mdecision_jbController::picAction()
     * 
     * 作图函数
     * 
     * @return void
     */
    function picAction()
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
        $region_name=$org->zh_name;
        $org->free_statement();
        $org_array="select id from organization where region_path like '".$region."%'";
        $api_disease=new Tapi_disease();
        $api_disease->whereAdd("diagnosis_org_id in ($org_array)");
        $api_disease->whereAdd("dignosis_date is not null and (dignosis_date >= '$start_time' and dignosis_date <= '$decision_time')");
        $api_disease->groupby("disease_name,disease_code");
		$api_disease->limit(0,10);
		$api_disease->selectAdd("count(disease_name) as total,disease_name as disease_name,disease_code as disease_code");
		$api_disease->orderby("total desc");
        $api_disease->find();
        $diseases=array();
        $total=0;
        $j=0;
        while($api_disease->fetch())
        {
            $diseases[$j]['disease_name']=$api_disease->disease_name;
            $diseases[$j]['disease_code']=$api_disease->disease_code;
            $diseases[$j]['nums']=$api_disease->total;
            $total+=$api_disease->total;
            $j++;
        }
        $data=array();
        $i=0;
        $x_array=array();
        foreach($diseases as $k=>$v)
        {
            $data[$i][0]=@round($v['nums']/$total,2)*100;
            $data[$i]['axisname']=$v['disease_name'];
            $x_array[$i]=$v['disease_name'].'('.$v['disease_code'].')';
            $i++;
        }
        $picname=$region_name."疾病顺位分析图(".date('Y-m-d',$start_time)."-".date("Y-m-d",$decision_time).")";
        echo xml_draw_donut($data,$x_array,"","",$picname,800,350);
        exit;
    }
}