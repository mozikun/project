<?php
/**

*/
class decision_baseController extends controller
{
	//此级别以下的用like 以上的用instr
	public $optimizerRegion=4;
	/**
	 * 等同于构造函数
	 */
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/region_ext_1.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/individual_core.php');
		require_once(__SITEROOT.'library/Models/staff_core.php');
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once(__SITEROOT.'library/MyAuth.php');
		$this->view->assign("baseUrl",__BASEPATH);
		$this->view->assign("basePath", __BASEPATH );
	}
	/**
	 * 建档率列表
     * 2012-10-17 罗领导要求，百分比超过百分之百的，按实际数现实。
     * 2012-11-08根据svn文档Logs/20121107公卫业务决策支持统计指标确认.doc增加统计开始时间可选择
	 */
	public function listAction(){
		//获取需要添加类别的当前父ID
		$p_id = $this->_request->getParam('parent_id','');
        
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
        
		$errorMessage = $this->_request->getParam('errorMessage','');
		$regionDomain = $this->user['region_id'];
		$p_id = empty($p_id)?$regionDomain:$p_id;
		//列表显示父ID等于1但是ID不等于1的所有数据(不显示根)
		$this->view->caching=false;//开启缓存
		$this->view->cache_lifetime=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('list.html',$p_id.$decision_time.$start_time)){
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			//$region->limit($startnum,__ROWSOFPAGE);
			//$region->debugLevel(9);
			$region->find();
			$row = array();
			$rowCount = 0;
			$sum_population=0;
			$sum_archive=0;
			$sum_archive_last_year=0;
            $sum_archive_urban=0;//城镇人口
            $sum_archive_rural=0;//农村人口
            $sum_archive_transient=0;//暂住人口
            $sum_archive_undefine=0;//未定义
			while($region->fetch()){
				$row[$rowCount]['id'] = trim($region->id);
				$row[$rowCount]['zh_name'] = $region->zh_name;
				$row[$rowCount]['region_path'] = $region->region_path;
				$row[$rowCount]['standard_code'] = $region->standard_code;
				$row[$rowCount]['p_id'] = trim($region->p_id);
				$row[$rowCount]['standard_code'] = trim($region->standard_code);
				$current_level = count(explode(',',$region->region_path));
				//select a.region_id,a.population,a.region_year,b.region_id,b.population,b.region_year from region_ext_1 a left join region_ext_1 b on a.region_id=b.region_id and a.region_year>=b.region_year ;
				//人口总数
				//镇以上地区
				if($current_level<6){
					$region1=new Tregion();
					$region1->selectAdd("id,region_path");
					$region1->whereAdd("region_path like '".$region->region_path."%'");
					//$region1->debugLevel(9);
					$region1->find();
					//$child_region='';
					$sum_population1=0;
					while ($region1->fetch()){
						$temp_level = count(explode(',',$region1->region_path));
						//echo $temp_level;
						//echo "<br />";
						if($temp_level==6){
							$region_ext_1=new Tregion_ext_1();
							$region_ext_1->selectAdd("population");
							$region_ext_1->whereAdd("region_id='$region1->id'");
							$region_ext_1->whereAdd("region_year>0");
							$region_ext_1->orderby("region_year desc");
							$region_ext_1->find(true);

							$sum_population1=$sum_population1+$region_ext_1->population;
							//echo $region_ext_1->population;
						}
						/*		$e=microtime(true);
						echo $e-$s;
						echo __LINE__."<br />";	*/
					}

					$row[$rowCount]['population'] =$sum_population1;
					$population=$sum_population1;
					$sum_population=$sum_population+$sum_population1;
					$this->view->td_title='1';
				}
				//echo $region->zh_name;
				//echo "<br />";
				if($current_level==6){
					$region_ext_1=new Tregion_ext_1();
					$region2=new Tregion();
					$org=new Torganization();
					$region_ext_1->joinAdd("inner",$region_ext_1,$region2,"region_id","id");
					$region_ext_1->joinAdd("inner",$region2,$org,'region_path','region_path');
					$region_ext_1->whereAdd("region_id='$region->id'");
					$region_ext_1->orderby("region_year desc");
					//$region_ext_1->debugLevel(9);
					$region_ext_1->find(true);
					$population=$region_ext_1->population;
					$row[$rowCount]['population'] =$population;
					$row[$rowCount]['org_zh_name'] =$org->zh_name;
					$sum_population=$sum_population+$population;
					$this->view->td_title='2';
				}

				//总建档数（至统计时间）
				$individual_core=new Tindividual_core();
                //2012-02-21 我好笨 仅统计正常档案,2012-12-05建档数应统计所有档案，含非正常档案
                //$individual_core->whereAdd("individual_core.status_flag=1");
                //$individual_core->whereAdd("individual_core.updated>='$start_time'");
                $individual_core->groupBy("individual_core.census");
                //将Updated改为created，因更新会导致不同时间点统计出现误差的情况
                $individual_core->whereAdd("individual_core.created<='$decision_time'");
				$individual_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$individual_core->selectAdd("count(*) as nums,individual_core.census");
                $individual_core->find();
                $temp=0;
                $row[$rowCount]['archive_urban']=0;//城镇人口
                $row[$rowCount]['archive_rural']=0;//农村人口
                $row[$rowCount]['archive_transient']=0;//暂住人口
                $row[$rowCount]['archive_undefine']=0;//未定义
                while($individual_core->fetch())
                {
                    $temp+=$individual_core->nums;
                    if($individual_core->census==1)
                    {
                        $row[$rowCount]['archive_urban']+=$individual_core->nums;
                        $sum_archive_urban+=$individual_core->nums;//城镇人口
                    }
                    elseif($individual_core->census==2)
                    {
                        $row[$rowCount]['archive_rural']+=$individual_core->nums;
                        $sum_archive_rural+=$individual_core->nums;//农村人口
                    }
                    elseif($individual_core->census==3)
                    {
                        $row[$rowCount]['archive_transient']+=$individual_core->nums;
                        $sum_archive_transient+=$individual_core->nums;//暂住人口
                    }
                    else
                    {
                        $row[$rowCount]['archive_undefine']+=$individual_core->nums;
                        $sum_archive_undefine+=$individual_core->nums;//未定义
                    }
                }
				$row[$rowCount]['archive']=$temp;
				$sum_archive=$sum_archive+$temp;
				//总建档率
				//echo $temp.'|'.$population;
				//echo "<br />";
				@$archive_rate=$temp/$population;
				$row[$rowCount]['archive_rate']=round(($archive_rate)*100,2);


				//过去一年建档数（统计时间段内）
				//echo time();
				//echo "<br />";
				$lastYear=mktime(0,0,0,date("m",time()),date("d",time()),date("Y",time())-1);
				//echo $lastYear;
				//echo "<br />";
				$individual_core=new Tindividual_core();
                //2012-02-21 我好笨 仅统计正常档案,2012-12-05建档数应统计所有档案，含非正常档案
                //$individual_core->whereAdd("individual_core.status_flag=1");
                $individual_core->whereAdd("individual_core.created>='$start_time'");
                $individual_core->whereAdd("individual_core.created<='$decision_time'");
				$individual_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				//$individual_core->whereAdd("individual_core.updated>$lastYear");
				$temp=$individual_core->count();
				$row[$rowCount]['archive_last_year']=$temp;
				$sum_archive_last_year=$sum_archive_last_year+$temp;
				//过去一年建档率（统计时间段内）
				@$archive_rate_last_year=$temp/$population;
				$row[$rowCount]['archive_rate_last_year']=round(($archive_rate_last_year)*100,2);

				$rowCount++;


			}
			$this->view->assign('row',$row);
			$this->view->assign('sum_population',$sum_population);
			$this->view->assign('sum_archive',$sum_archive);
            $this->view->assign('sum_archive_urban',$sum_archive_urban);
            $this->view->assign('sum_archive_rural',$sum_archive_rural);
            $this->view->assign('sum_archive_transient',$sum_archive_transient);
            $this->view->assign('sum_archive_undefine',$sum_archive_undefine);
            @$this->view->assign('sum_archive_rate',round(($sum_archive/$sum_population)*100,2));
			$this->view->assign('sum_archive_last_year',$sum_archive_last_year);
			@$this->view->assign('sum_archive_rate_last_year',round(($sum_archive_last_year/$sum_population)*100,2));
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
			$this->view->errorMessage=$errorMessage;
		}
		$this->view->display('list.html',$p_id.$decision_time.$start_time);
	}
}
?>