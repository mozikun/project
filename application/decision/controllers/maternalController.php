<?php
/**
*@author：我好笨
*@filename: maternalController.php
*@package：用于完成孕产妇健康管理模块的统计
*@email：4049054@qq.com
*@create：2010-11-23
*/
class decision_maternalController extends controller{
	/**
	 * 自动加载
	 */
	public function init(){
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/prenatal_visit_first.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/prenatal_visit_two.php";
		require_once __SITEROOT."library/Models/region.php";
		require_once __SITEROOT."library/Models/postpartum_visit.php";
		require_once __SITEROOT."library/Models/postpartum_heathcheck.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	/**
	 * 主控制器
	 * 用于列表
     * 
     * 2012-10-17 罗领导要求，百分比超过百分之百的，按实际数现实。
	 */
	public function indexAction()
	{
		$model = $this->_request->getParam('model','');//用于控制显示
        
        //2012-08-20按照罗领导要求，增加按年统计
        $decision_time=$this->_request->getParam('decision_time');
        //接受Post的时间，防止参数冲突
        $end_time=$this->_request->getParam('end_time');
        $decision_time=$end_time?strtotime($end_time)+(3600*24-1):($decision_time?strtotime($decision_time)+(3600*24-1):time());
        $this->view->decision_time=date('Y-m-d',$decision_time);
        //接受Post的时间，防止参数冲突
        $start_time=$this->_request->getParam('start_time');
        //通过url传递的开始时间
        $url_start_time=$this->_request->getParam('url_start_time');
        $start_time=$start_time?strtotime($start_time):($url_start_time?strtotime($url_start_time):mktime(0,0,0,1,1,date('Y',$decision_time)));
        $this->view->start_time=date('Y-m-d',$start_time);
        
		//获取需要添加类别的当前父ID
		$p_id = $this->_request->getParam('parent_id','');
		$regionDomain = $this->user['region_id'];
		//echo $$regionDomain;
		$p_id = empty($p_id)?$regionDomain:$p_id;
		$this->view->caching		=false;//开启缓存
		$this->view->cache_lifetime	=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('maternal_index.html',$p_id.$model.$decision_time.$start_time))
		{
			require_once __SITEROOT.'/library/data_arr/arrdata.php';
			
			$errorMessage = $this->_request->getParam('errorMessage','');
			//var_dump($this->user);
			$regionDomain = $this->user['region_id'];
			//echo $$regionDomain;
			$p_id = empty($p_id)?$regionDomain:$p_id;
			//列表显示父ID等于1但是ID不等于1的所有数据(不显示根)
			$this->view->basePath = $this->_request->getBasePath();
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			$region->find();
			$row = array();
			$rowCount = 0;//行数
			$sum_card=0;//辖区内建册孕妇
			$sum_card_12=0;//12周之前建册人数
			$sum_more_five=0;//接受5次产前随访的人数
			$sum_postpartum_visit=0;//产后访视人数
			$sum_postpartum_check=0;//产后体检人数
			$sum_adults=0;//辖区内常住成年妇女人口总数
            $sum_number_of_live_births=0;//活产数
            $pregnancy_rate_of_building_volumes=0;//早孕建册率
            $rates_of_maternal_health_management=0;//孕妇健康管理率
			//小计所有用到的字段
			$sum_card_total=0;
			$sum_card_12_total=0;
			$sum_more_five_total=0;
			$sum_postpartum_visit_total=0;
			$sum_postpartum_check_total=0;
			$sum_adults_total=0;
			$sum_number_of_live_births_total=0;
            $pregnancy_rate_of_building_volumes_total=0;//早孕建册率
            $rates_of_maternal_health_management_total=0;//孕妇健康管理率
			//1、辖区内建册孕妇
			//2、辖区内12周之前建册人数
			//3、接受5次产前随访服务的人数
			//4、产后访视人数
			//5、产后体检人数
			$time=adodb_mktime(0,0,0,adodb_date("m",time()),adodb_date("d",time()),adodb_date("Y",time())-1);//取过去一年的时间
			while($region->fetch()){
				//$row[$rowCount]['adult_rate'] = $adult_rate;
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
				
				//取个人档案与随访表的关联记录，个人档案里读取region_path,这里取辖区内建册孕妇，第一次产前随访为建册
				$sum_card_temp=0;
				$prenatal_visit_first=new Tprenatal_visit_first();
				$individual_core=new Tindividual_core();
				$prenatal_visit_first->joinAdd('inner',$prenatal_visit_first,$individual_core,'id','uuid');
				$prenatal_visit_first->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$prenatal_visit_first->whereAdd("prenatal_visit_first.created >= '$start_time'");
                $prenatal_visit_first->whereAdd("prenatal_visit_first.created <= '$decision_time'");
                //$prenatal_visit_first->debug(5);
				$sum_card_temp=$prenatal_visit_first->count("distinct prenatal_visit_first.id");
				$row[$rowCount]['sum_card'] =$sum_card_temp;
				$sum_card_total=$sum_card_total+$sum_card_temp;
                //取该地该时间段内活产数=辖区一年内年龄小于1岁的建档幼儿数(2011-09-01罗老师意见)
				$individual_core=new Tindividual_core();
				$individual_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
                //$individual_core->whereAdd("individual_core.updated>='$start_time'");
                //$individual_core->whereAdd("individual_core.updated<='$decision_time'");
                //统计口径：当年　就默认为当年１月１日起到统计日至。用户可以修改统计日期活产数等，以正确输入的（出生日期或是死亡日期）为统计点，不以修改记录或是建立记录的时间为统计点(2012-08-28罗老师意见)
                //$time_s=adodb_mktime(0,0,0,adodb_date("m",$start_time),adodb_date("d",$start_time),adodb_date("Y",$start_time)-1);
                //$time_e=adodb_mktime(0,0,0,adodb_date("m",$decision_time),adodb_date("d",$decision_time),adodb_date("Y",$decision_time)-1);
                //2013-05-29 修改为生日在统计时间段内的建档人数(贾、罗)
				$individual_core->whereAdd("individual_core.date_of_birth>=$start_time");
                $individual_core->whereAdd("individual_core.date_of_birth<=$decision_time");
				$sum_number_of_live_births=$individual_core->count();
                $individual_core->free_statement();
				$row[$rowCount]['sum_number_of_live_births']=$sum_number_of_live_births;
				$sum_number_of_live_births_total=$sum_number_of_live_births_total+$sum_number_of_live_births;

				if ($model=="" || $model=="m1")
				{
					//辖区内12周之前建册人数
					$sum_card_12_temp=0;
                    $individual_core=new Tindividual_core();
					$prenatal_visit_first=new Tprenatal_visit_first();
					$prenatal_visit_first->joinAdd('inner',$prenatal_visit_first,$individual_core,'id','uuid');
					$prenatal_visit_first->whereAdd("individual_core.region_path like '".$region->region_path."%'");
                    $prenatal_visit_first->whereAdd("prenatal_visit_first.created >= '$start_time'");
                    $prenatal_visit_first->whereAdd("prenatal_visit_first.created <= '$decision_time'");
					$prenatal_visit_first->whereAdd("prenatal_visit_first.gestational_weeks<=12");
                    //$prenatal_visit_first->debug(5);
					$sum_card_12_temp=$prenatal_visit_first->count("distinct prenatal_visit_first.id");
                    
					$row[$rowCount]['sum_card_12']=$sum_card_12_temp;
					$sum_card_12_total=$sum_card_12_total+$sum_card_12_temp;
					
					//接受5次产前随访服务的人数
					$sum_more_five_temp=0;
                    $individual_core=new Tindividual_core();
					$prenatal_visit_two=new Tprenatal_visit_two();
					$prenatal_visit_two->joinAdd('inner',$prenatal_visit_two,$individual_core,'id','uuid');
					$prenatal_visit_two->whereAdd("individual_core.region_path like '".$region->region_path."%'");
                    $prenatal_visit_two->whereAdd("prenatal_visit_two.created >= '$start_time'");
                    $prenatal_visit_two->whereAdd("prenatal_visit_two.created <= '$decision_time'");
					$prenatal_visit_two->selectAdd("distinct prenatal_visit_two.fid,count(prenatal_visit_two.uuid) as aa,prenatal_visit_two.id");
					$prenatal_visit_two->groupby("prenatal_visit_two.fid,prenatal_visit_two.id");
					$prenatal_visit_two->find();
					$five=array();//空数组，因为查询结果无法统计重复人员的信息，所以通过在组合一个数组实现
					while ($prenatal_visit_two->fetch())
					{
						if ($prenatal_visit_two->aa>3)
						{
							$five[$prenatal_visit_two->id]=1;
						}
					}
					$sum_more_five_temp=count($five);
					$row[$rowCount]['sum_more_five']=$sum_more_five_temp;
					$sum_more_five_total=$sum_more_five_total+$sum_more_five_temp;
				}
				if ($model=="" || $model=="m2")
				{
					//产后访视人数
					$sum_postpartum_visit_temp=0;
                    $individual_core=new Tindividual_core();
					$postpartum_visit=new Tpostpartum_visit();
					$postpartum_visit->joinAdd('inner',$postpartum_visit,$individual_core,'id','uuid');
					$postpartum_visit->whereAdd("individual_core.region_path like '".$region->region_path."%'");
                    $postpartum_visit->whereAdd("postpartum_visit.created >= '$start_time'");
                    $postpartum_visit->whereAdd("postpartum_visit.created <= '$decision_time'");
					$sum_postpartum_visit_temp=$postpartum_visit->count("distinct postpartum_visit.id");
					$row[$rowCount]['sum_postpartum_visit']=$sum_postpartum_visit_temp;
					$sum_postpartum_visit_total=$sum_postpartum_visit_total+$sum_postpartum_visit_temp;
				}
				if ($model=="" || $model=="m3")
				{
					//产后体检人数
					$sum_postpartum_check_temp=0;
                    $individual_core=new Tindividual_core();
					$postpartum_heathcheck=new Tpostpartum_heathcheck();
					$postpartum_heathcheck->joinAdd('inner',$postpartum_heathcheck,$individual_core,'id','uuid');
					$postpartum_heathcheck->whereAdd("individual_core.region_path like '".$region->region_path."%'");
                    $postpartum_heathcheck->whereAdd("postpartum_heathcheck.created >= '$start_time'");
                    $postpartum_heathcheck->whereAdd("postpartum_heathcheck.created <= '$decision_time'");
					$sum_postpartum_check_temp=$postpartum_heathcheck->count("distinct postpartum_heathcheck.id");
					$row[$rowCount]['sum_postpartum_check']=$sum_postpartum_check_temp;
					$sum_postpartum_check_total=$sum_postpartum_check_total+$sum_postpartum_check_temp;
				}
				
				//辖区内常住成年妇女人口总数（至统计时间）
				$time_adults=adodb_mktime(0,0,0,adodb_date("m",time()),adodb_date("d",time()),adodb_date("Y",time())-18);//取成年时间
				$individual_core=new Tindividual_core();
				$individual_core->whereAdd("individual_core.region_path like '".$region->region_path."%'");
				$individual_core->whereAdd("individual_core.date_of_birth<='$time_adults'");
                //$individual_core->whereAdd("individual_core.updated>='$start_time'");
                $individual_core->whereAdd("individual_core.updated<='$decision_time'");
				$individual_core->whereAdd("individual_core.sex='3'");
				$sum_adults=$individual_core->count();
				$row[$rowCount]['sum_adults']=$sum_adults;
				$sum_adults_total=$sum_adults_total+$sum_adults;
                
                //早孕建册率
                $row[$rowCount]['pregnancy_rate_of_building_volumes']=@round(($row[$rowCount]['sum_card_12']/$row[$rowCount]['sum_number_of_live_births']),4);
                $row[$rowCount]['pregnancy_rate_of_building_volumes']=$row[$rowCount]['pregnancy_rate_of_building_volumes']*100;
                //孕妇健康管理率
                $row[$rowCount]['rates_of_maternal_health_management']=@round(($row[$rowCount]['sum_more_five']/$row[$rowCount]['sum_number_of_live_births']),4);
                $row[$rowCount]['rates_of_maternal_health_management']=$row[$rowCount]['rates_of_maternal_health_management']*100;
                //产后访视率
                $row[$rowCount]['rates_of_postpartum_visit']=@round(($row[$rowCount]['sum_postpartum_visit']/$row[$rowCount]['sum_number_of_live_births']),4);
                $row[$rowCount]['rates_of_postpartum_visit']=$row[$rowCount]['rates_of_postpartum_visit']*100;
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
            //早孕建册率
            $pregnancy_rate_of_building_volumes_total=@round(($sum_card_12_total/$sum_number_of_live_births_total),4);
            $pregnancy_rate_of_building_volumes_total=$pregnancy_rate_of_building_volumes_total*100;
            $this->view->assign('pregnancy_rate_of_building_volumes_total',$pregnancy_rate_of_building_volumes_total);
            //孕妇健康管理率
            $rates_of_maternal_health_management_total=@round(($sum_more_five_total/$sum_number_of_live_births_total),4);
            $rates_of_maternal_health_management_total=$rates_of_maternal_health_management_total*100;
            $this->view->assign('rates_of_maternal_health_management_total',$rates_of_maternal_health_management_total);
            //产后访视率
            $rates_of_postpartum_visit_total=@round(($sum_postpartum_visit_total/$sum_number_of_live_births_total),4);
            $rates_of_postpartum_visit_total=$rates_of_postpartum_visit_total*100;
            $this->view->assign('rates_of_postpartum_visit_total',$rates_of_postpartum_visit_total);
            
			$this->view->assign('row',$row);
			$this->view->assign('model',$model);
			$this->view->assign('sum_card',$sum_card);
			if ($model=="" || $model=="m1")
			{
				$this->view->assign('sum_card_12',$sum_card_12);
				$this->view->assign('sum_more_five',$sum_more_five);
				$this->view->assign('sum_card_12_total',$sum_card_12_total);
				$this->view->assign('sum_more_five_total',$sum_more_five_total);
			}
			if ($model=="" || $model=="m2")
			{
				$this->view->assign('sum_postpartum_visit',$sum_postpartum_visit);
				$this->view->assign('sum_postpartum_visit_total',$sum_postpartum_visit_total);
			}
			if ($model=="" || $model=="m3")
			{
				$this->view->assign('sum_postpartum_check',$sum_postpartum_check);
				$this->view->assign('sum_postpartum_check_total',$sum_postpartum_check_total);
			}
            $this->view->assign('sum_number_of_live_births_total',$sum_number_of_live_births_total);
			$this->view->assign('sum_adults',$sum_adults);
			$this->view->assign('sum_card_total',$sum_card_total);
			$this->view->assign('sum_adults_total',$sum_adults_total);
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
		$this->view->display('maternal_index.html',$p_id.$model.$decision_time.$start_time);
	}
}