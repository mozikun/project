<?php
/**
*@author：我好笨
*@filename: indexController.php
*@package：用于完成慢病高血压考核指标的统计
*@email：4049054@qq.com
*@create：2010-9-13
*/
class decision_rateController extends controller{
	/**
	 * 自动加载
	 */
	public function init(){
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/region.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	/**
	 * 主控制器
	 * 用于列表
     * 我好笨修改
     * 2012-11-08根据svn文档Logs/20121107公卫业务决策支持统计指标确认.doc增加统计开始时间可选择
     * 2012-11-08一并修改刘生明反应的档案完整率以累计方式计算
	 */
	public function indexAction()
	{
		$p_id = $this->_request->getParam('parent_id','');
		$regionDomain = $this->user['region_id'];
		//echo $$regionDomain;
		$p_id = empty($p_id)?$regionDomain:$p_id;
        
        //2012-08-20按照罗领导要求，增加按年统计
        $decision_time=$this->_request->getParam('decision_time');
        //接受Post的时间，防止参数冲突
        $end_time=$this->_request->getParam('end_time');
        $decision_time=$end_time?strtotime($end_time)+(3600*24-1):($decision_time?strtotime($decision_time)+(3600*24-1):time());
        $this->view->decision_time=date('Y-m-d',$decision_time);
        //2012-11-08新增
        $start_time=$this->_request->getParam('start_time');
        //通过url传递的开始时间
        $url_start_time=$this->_request->getParam('url_start_time');
        $start_time=$start_time?strtotime($start_time):($url_start_time?strtotime($url_start_time):mktime(0,0,0,1,1,date('Y',$decision_time)));
        $this->view->start_time=date('Y-m-d',$start_time);
        
		//获取需要添加类别的当前父ID
		$this->view->caching		=__CACHING;//开启缓存
		$this->view->cache_lifetime	=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('rate_index.html',$p_id.$decision_time.$start_time))
		{
			require_once __SITEROOT.'/library/data_arr/arrdata.php';
			$errorMessage = $this->_request->getParam('errorMessage','');
			$this->view->errorMessage=$errorMessage;
			//var_dump($this->user);
			$regionDomain = $this->user['region_id'];
			//echo $$regionDomain;
			$p_id = empty($p_id)?$regionDomain:$p_id;
			//echo 'pid'.$parentId;
			// exit();
			//$listRegion = new Tregion();
			//$listRegion->whereAdd("id='0'");
			// $listRegion->debugLevel(9);
			//$listRegion->find(true);
			//$p_id = empty($parentId)?0:$parentId;
			//列表显示父ID等于1但是ID不等于1的所有数据(不显示根)
			$this->view->basePath = $this->_request->getBasePath();
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			//$region->limit($startnum,__ROWSOFPAGE);
			//$region->debugLevel(9);
			$region->find();
			$row = array();
			$rowCount = 0;//行数
			$time=adodb_mktime(0,0,0,adodb_date("m",time()),adodb_date("d",time()),adodb_date("Y",time())-1);//取过去一年的时间
			while($region->fetch()){
				$row[$rowCount]['id'] = trim($region->id);
				$row[$rowCount]['zh_name'] = $region->zh_name;
				$row[$rowCount]['region_path'] = $region->region_path;
				$row[$rowCount]['standard_code'] = $region->standard_code;
				$row[$rowCount]['p_id'] = trim($region->p_id);
				$row[$rowCount]['standard_code'] = trim($region->standard_code);
				$current_level = count(explode(',',$region->region_path));
				//显示建档机构名称
				if($current_level==6)
                {
                    require_once __SITEROOT."library/Models/organization.php";
                    $org=new Torganization();
					$org->whereAdd("region_path='$region->region_path'");
					$org->find(true);
					$row[$rowCount]['org_zh_name'] =$org->zh_name;
					$this->view->td_title='2';
				}
				
				//取平均数
				$individual_core=new Tindividual_core();
                //2012-02-21 我好笨 仅统计正常档案
                $individual_core->whereAdd("status_flag=1");
				$individual_core->whereAdd("region_path like '".$region->region_path."%'");
                //$individual_core->whereAdd("individual_core.updated>='$start_time'");
                $individual_core->whereAdd("individual_core.updated<='$decision_time'");
				$individual_core->selectAdd("max(criteria_rate) as max_criteria_rate,min(criteria_rate) as min_criteria_rate,avg(criteria_rate) as avg_criteria_rate");
				//$individual_core->groupBy("max_criteria_rate,min_criteria_rate,avg_criteria_rate");
				$individual_core->find();
				while ($individual_core->fetch())
				{
					$row[$rowCount]['max_criteria_rate'] =$individual_core->max_criteria_rate*100;
					$row[$rowCount]['min_criteria_rate'] =$individual_core->min_criteria_rate*100;
					$row[$rowCount]['avg_criteria_rate'] =round($individual_core->avg_criteria_rate,4)*100;
				}
				//规范管理率
				if($current_level<6)
				{
					$this->view->td_title='1';
				}
				if($current_level==6){
					$this->view->td_title='2';
				}
				$rowCount++;
			}
			//取小计
			$individual_core=new Tindividual_core();
            //2012-02-21 我好笨 仅统计正常档案
            $individual_core->whereAdd("status_flag=1");
			$individual_core->whereAdd("region_path like '".$region->region_path."%'");
            //$individual_core->whereAdd("individual_core.updated>='$start_time'");
            $individual_core->whereAdd("individual_core.updated<='$decision_time'");
			$individual_core->selectAdd("max(criteria_rate) as max_criteria_rate,min(criteria_rate) as min_criteria_rate,avg(criteria_rate) as avg_criteria_rate");
			$individual_core->find();
			$max_criteria_rate=0;
			$min_criteria_rate=0;
			$avg_criteria_rate=0;
			while ($individual_core->fetch())
			{
				$max_criteria_rate =$individual_core->max_criteria_rate*100;
				$min_criteria_rate =$individual_core->min_criteria_rate*100;
				$avg_criteria_rate =round($individual_core->avg_criteria_rate,4)*100;
			}
			$this->view->assign('max_criteria_rate',$max_criteria_rate);
			$this->view->assign('min_criteria_rate',$min_criteria_rate);
			$this->view->assign('avg_criteria_rate',$avg_criteria_rate);
			$this->view->assign('row',$row);
			$this->view->assign('add_need_id',$p_id);
			$this->view->assign('basePath',__BASEPATH);
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
				$rs[$rsCount]['zh_name'] = $realMenu->zh_name;
				$rs[$rsCount]['id'] = trim($realMenu->id);
				$rs[$rsCount]['p_id'] = trim($realMenu->p_id);
				$rsCount++;
			}
			$this->view->assign('rs',$rs);
			//获取当前表中所有栏目内容(除去根)
			$length=count(explode(',',$pathSel->region_path));
			//echo $length;
			if($length<=4){
				$this->view->standard_code_size=6;
			}else{
				$this->view->standard_code_size=3;
			}
		}
		$this->view->display('rate_index.html',$p_id);
	}
}