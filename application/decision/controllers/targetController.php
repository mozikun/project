<?php
/**
 * @author :hailang
 * @copyright :用于医疗机构运行指标统计
 * @date:2013-4-20
 */
class decision_targetController extends controller {
	/**
	 * 自动加载
	 */
	public function init()
	{
//		$this->haveWritePrivilege='';
		require_once(__SITEROOT . '/library/custom/adodb-time.inc.php'); //引入时间处理
		require_once(__SITEROOT."library/privilege.php");
		require_once(__SITEROOT."library/Models/region.php");
		require_once(__SITEROOT."library/Models/organization.php");
		require_once(__SITEROOT."library/Models/zl_his_szb.php");
		$this->view->assign("basePath",__BASEPATH);
		$this->view->assign("baseUrl",__BASEPATH);
	}
	public function indexAction()
	{
		require __SITEROOT."config/oracleConfig.php";
		$type=$this->_request->getParam("type");
		//时间处理
		$decision_time = $this->_request->getParam('decision_time');
        $search_time = $this->_request->getParam('search_time');
        $start_time=$this->_request->getParam("start_time");
        $form_start_time=$this->_request->getParam("form_start_time");
        if(!empty($form_start_time))
        {
        	$start_time=$form_start_time;
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
        $start_time =empty($start_time) ? mktime(0, 0, 0, date("m",$decision_time)-1, date("d",$decision_time), date('Y', $decision_time)):  strtotime($start_time);
	    $this->view->decision_time = date('Y-m-d', $decision_time);
        $this->view->start_time = date('Y-m-d', $start_time);  
        $start_time=date("Y-m-d",$start_time);
        $decision_time=date("Y-m-d",$decision_time);
        
        $this->view->caching=__CACHING;//开启缓存
        $this->view->cache_lifetime=__CACHING_LEFTTIME;//缓存时间
        if(!$this->view->is_cached("index.html",$type.$decision_time))
        {   
        	$conn = oci_connect($databaseConfig[2]['user'],$databaseConfig[2]['password'],$databaseConfig[2]['host']);
        	$str="select * from zl_his_szb where shijian>='$start_time' and shijian <='$decision_time' order by shijian desc";
        	$zl=oci_parse($conn,$str);
        	oci_execute($zl);
	        $zl_array=array();
	        $rowCount=0;
			while ($rs=oci_fetch_array($zl, OCI_ASSOC))
			{
//				var_dump($rs);
//            	exit();
	        	$zl_array[$rowCount]['hospatal_name']=iconv('gbk','utf-8//IGNORE',$rs['YASYCQRMYY']);//医院名称
	        	$zl_array[$rowCount]['time']=$rs['SHIJIAN'];//时间
	        	if($type=='' || $type=='workload')
	        	{
	        		$zl_array[$rowCount]['rmzl']=round($rs['RMZL'],2);//日门诊量
	        		$zl_array[$rowCount]['rjzl']=round($rs['RJZL'],2);//日急诊量
	        		$zl_array[$rowCount]['rzjl']=round($rs['RZJL'],2);//日专家量
	        		$zl_array[$rowCount]['sstc']=$rs['SSTC'];//手术台次
	        		$zl_array[$rowCount]['cyrs']=$rs['CYRS'];//出院人数
	        	}
	        	if($type=='' || $type=='efficiency')
	        	{
	        		$zl_array[$rowCount]['rjzyr']=round($rs['RJZYR'],2);//人均住院日
	        	}
	        	if($type=='' || $type=='quality')
	        	{
	        		$zl_array[$rowCount]['zdfhl']=round($rs['ZDFHL'],2);//诊断符合率
	        		$zl_array[$rowCount]['jjyhl']=round($rs['JJYHL'],2);//甲级愈合率
	        	}
	        	if($type=='' || $type=='cost')
	        	{
	        		$zl_array[$rowCount]['mzljfy']=round($rs['MZLJFY'],2);//门诊例均费用
	        		$zl_array[$rowCount]['mzjcfybl']=round($rs['MZJCFYBL'],2);//门诊检查费用比率
	        		$zl_array[$rowCount]['zyljfy']=round($rs['ZYLJFY'],2);//住院例均费用
	        		$zl_array[$rowCount]['zyjcfbl']=round($rs['ZYJCFBL'],2);//住院检查费用比率        		
	        	}
	        	if($type=='' || $type=='medicine')
	        	{
	        		
	        	}
	        	if($type=='' || $type=='dispute')
	        	{
	        		
	        	}
	        	$rowCount++;
	        }
	        $this->view->assign("rows",$zl_array);
	        $this->view->assign("type",$type);
        }
        
//		$p_id=$this->_request->getParam("parent_id",'');
//		$regionDomain=$this->user["region_id"];
//		$p_id=empty($p_id) ? $regionDomain : $p_id;
//		$this->view->caching=__CACHING;
//		$this->view->cache_lifetime=__CACHING_LEFTTIME;
//		if(!$this->view->is_cached("index.html",$p_id))
//		{
//			//列表显示父ID等于1但是ID不等于1的所有数据(不显示根)
//			$region=new Tregion();
//			$region->whereAdd("id<>0");
//			$region->whereAdd("p_id='$p_id'");
//			$region->orderby("id asc");
//			//$region->debugLevel(9);
//			$region->find();
//			
//			$row=array();
//			$rowCount=0;
//			while ($region->fetch())
//			{
//				$row[$rowCount]['id']=$region->id;
//        		$row[$rowCount]['zh_name']=$region->zh_name;
//        		$row[$rowCount]['p_id']=$region->p_id;
//        		$row[$rowCount]['standard_code']=$region->standard_code;
//        		$row[$rowCount]['region_path']=$region->region_path;
//        		$current_level=count(explode(',',$region->region_path));
//        		 //显示建档机构名称
//                if ($current_level == 6)
//                {
//                        require_once __SITEROOT . "library/Models/organization.php";
//                        $org = new Torganization();
//                        $org->whereAdd("region_path='$region->region_path'");
//                        $org->find(true);
//                        $row[$rowCount]['org_zh_name'] = $org->zh_name;
//                        $this->view->td_title = '2';
//                }
//                
//                
//                if ($current_level < 6)
//                {
//                        $this->view->td_title = '1';
//                }
//                if ($current_level == 6)
//                {
//                        $this->view->td_title = '2';
//                }
//        		$rowCount++;	
//			}
//			$this->view->assign("type",$type);
//			$this->view->assign("row",$row);
//        	$this->view->assign('add_need_id', $p_id);		
//			//获取所有path 根据登录者的地区id，限制导航条只能在该用户所在的区域内
//            $pathSel = new Tregion();
//            $pathSel->whereAdd("id='$p_id'");
//            $pathSel->find(true);
//            $currentPath = $pathSel->region_path; //处理path
//            $nuNumber = strpos($currentPath, $regionDomain);
//            $strNumber = intval(strlen($currentPath) - $nuNumber);
//            $newCurrentPath = substr($currentPath, $nuNumber, $strNumber);
//            $realPath = explode(',', $newCurrentPath);
//            $realCount = count($realPath);
//            $rs = array();
//            $rsCount = 0;
//            foreach ($realPath as $k => $v)
//            {
//                    $realMenu = new Tregion();
//                    $realMenu->whereAdd("id='$v'");
//                    $realMenu->find(true);
//                    $rs[$rsCount]['zh_name'] = $realMenu->zh_name;
//                    $rs[$rsCount]['id'] = trim($realMenu->id);
//                    $rs[$rsCount]['p_id'] = trim($realMenu->p_id);
//                    $rsCount++;
//            }
//            $this->view->assign('rs', $rs);
//		}
		$this->view->display("index.html");
	}
}