<?php
/**
*@author：我好笨
*@filename: indexController.php
*@package：用于完成慢病高血压考核指标的统计
*@email：4049054@qq.com
*@create：2010-9-13
*/
class decision_hypertensionController extends controller{
	/**
	 * 自动加载
	 */
	public function init(){
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/hypertension_follow_up.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/clinical_history.php";
		require_once __SITEROOT."library/Models/region.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	/**
	 * 主控制器
	 * 用于列表
     * 
     * 2012-10-17 罗领导要求，百分比超过百分之百的，按实际数现实。
     * 2012-11-08根据svn文档Logs/20121107公卫业务决策支持统计指标确认.doc增加统计开始时间可选择,同时修改规范管理率公式
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
        //2012-11-08新增
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
		$this->view->caching		=__CACHING;//开启缓存
		$this->view->cache_lifetime	=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('hypertension_index.html',$p_id.$model.$decision_time.$start_time))
		{
			require_once __SITEROOT.'/library/data_arr/arrdata.php';
			
			$errorMessage = $this->_request->getParam('errorMessage','');
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
			$sum_population=0;//高血压患者数
			$sum_archive=0;//年内已管理高血压人数
			$sum_hyper_ask=0;//按照要求进行高血压患者管理的人数
			$sum_archive_last_year=0;//血压达标人数
			$sum_adults=0;//辖区内常住成年人口总数
            $sum_archive_gusuan=0;//辖区高血压患病总人数估算
			//小计所有用到的字段
			$sum_population_total=0;
			$sum_archive_total=0;
			$sum_hyper_ask_total=0;
			$sum_archive_last_year_total=0;
			$sum_adults_total=0;
            $sum_archive_gusuan_total=0;
            $sum_archive_all_total=0;
            $sum_population_new_total=0;
			
			$adult_rate=$adult_prevalence_rate[1][1];//成年人患病率
			//年内已管理高血压人数”逻辑：确诊高血压患者；查询过去一年内有至少一条随访记录
			//年内管理高血压患者人数”同第一条“年内已管理高血压人数”
			//按照要求进行高血压患者管理的人数”逻辑：确诊高血压患者；且过去一年内随访次数≥（取整函数（（“查询日期”-“过去一年内第一次随访日期”-90）/90）+1），此公式已于2012-11-08作废
            //新文档中规定公式如下：按照要求进行高血压患者管理的人数 = 确诊高血压患者在统计时间段内随访次数（统计时间段内）≥（取整函数（（“查询日期开始时间”-“查询日期结束时间”）/90））
			//最近一次随访血压达标人数”逻辑：高血压患者；且最后一次随访血压同时满足“收缩压<140 且 舒张压<90mmHg”
			$time=adodb_mktime(0,0,0,adodb_date("m",time()),adodb_date("d",time()),adodb_date("Y",time())-1);//取过去一年的时间
            //计算:(取整函数(("查询日期开始时间"-"查询日期结束时间")/90))
            $tmp_num=0;
            $tmp_num=floor((($decision_time-$start_time)/(3600*24))/90);
			while($region->fetch()){
				$row[$rowCount]['adult_rate'] = $adult_rate;
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
				//取出本机构下的所有人员ID
                //$individual_core=new Tindividual_core();
//                $individual_core->whereAdd("region_path like '".$region->region_path."%'");
//                $individual_core->find();
//                $individual_uuid="";
//                while($individual_core->fetch())
//                {
//                    $individual_uuid.="'".$individual_core->uuid."',";
//                }
//                $individual_core->free_statement();
                //2012-02-21仅查询正常档案，我好笨
                //至统计时间
                $individual_uuid="select individual_core.uuid from individual_core inner join individual_status on individual_core.uuid=individual_status.id where (individual_core.region_path = '".$region->region_path."' or individual_core.region_path like '".$region->region_path.",%') and (individual_status.status_flag='1' or (individual_status.status_flag='6' and individual_status.status_time>'$start_time')) and individual_core.updated <=$decision_time";
				//取个人档案与随访表的关联记录，个人档案里读取region_path,这里取年内已管理高血压人数（统计时间段内）
				$sum_archive_temp=0;
				$hypertension_follow_up=new Thypertension_follow_up();
				$clinical_history=new Tclinical_history();
				$hypertension_follow_up->joinAdd('inner',$hypertension_follow_up,$clinical_history,'id','id');
                $hypertension_follow_up->whereAdd("hypertension_follow_up.id in (select individual_core.uuid from individual_core inner join individual_status on individual_core.uuid=individual_status.id where (individual_core.region_path = '".$region->region_path."' or individual_core.region_path like '".$region->region_path.",%') and (individual_status.status_flag='1' or individual_status.status_flag='6'))");
				$hypertension_follow_up->whereAdd("clinical_history.disease_code='2'");
				$hypertension_follow_up->whereAdd("hypertension_follow_up.follow_time >= '$start_time'");
                $hypertension_follow_up->whereAdd("hypertension_follow_up.follow_time <= '$decision_time'");
                //$hypertension_follow_up->debugLevel(5);
				$sum_archive_temp=$hypertension_follow_up->count("distinct hypertension_follow_up.id");
                $hypertension_follow_up->free_statement();
                //exit;
				$row[$rowCount]['sum_archive'] =$sum_archive_temp;
				$sum_archive_total=$sum_archive_total+$sum_archive_temp;
                //已管理的高血压患者人数（至统计时间）2012-10-12根据文档新增指标
                $sum_archive_all_temp=0;
				$hypertension_follow_up=new Thypertension_follow_up();
				$clinical_history=new Tclinical_history();
				$hypertension_follow_up->joinAdd('inner',$hypertension_follow_up,$clinical_history,'id','id');
                $hypertension_follow_up->whereAdd("hypertension_follow_up.id in ($individual_uuid)");
				$hypertension_follow_up->whereAdd("clinical_history.disease_code='2'");
                $hypertension_follow_up->whereAdd("hypertension_follow_up.follow_time <= $decision_time");
				$sum_archive_all_temp=$hypertension_follow_up->count("distinct hypertension_follow_up.id");
                $hypertension_follow_up->free_statement();
				$row[$rowCount]['sum_archive_all'] =$sum_archive_all_temp;
				$sum_archive_all_total=$sum_archive_all_total+$sum_archive_all_temp;
                
				//高血压患者数--统计慢病表中标志为高血压的人数（至统计时间）
				$sum_population_temp=0;
				$clinical_history=new Tclinical_history();
                $clinical_history->whereAdd("id in ($individual_uuid)");
                //$clinical_history->whereAdd("clinical_history.updated>='$start_time'");
                //$clinical_history->whereAdd("clinical_history.updated<='$decision_time'");
				$clinical_history->whereAdd("disease_code='2'");
				$sum_population_temp=$clinical_history->count("distinct id");
                $clinical_history->free_statement();
				$row[$rowCount]['sum_population']=$sum_population_temp;
				$sum_population_total=$sum_population_total+$sum_population_temp;
                
                //新建档确诊高血压患者数（统计时间段内）
                $sum_population_new_temp=0;
				$clinical_history=new Tclinical_history();
                $clinical_history->whereAdd("id in ($individual_uuid)");
                $clinical_history->whereAdd("clinical_history.updated>=$start_time");
                $clinical_history->whereAdd("clinical_history.updated<=$decision_time");
				$clinical_history->whereAdd("disease_code='2'");
				$sum_population_new_temp=$clinical_history->count("distinct id");
                $clinical_history->free_statement();
				$row[$rowCount]['sum_population_new']=$sum_population_new_temp;
				$sum_population_new_total=$sum_population_new_total+$sum_population_new_temp;
				
				//按照要求进行高血压患者管理的人数
                //计算公式：	按照要求进行高血压患者管理的人数 = 确诊高血压患者在统计时间段内随访次数（统计时间段内）≥（取整函数（（“查询日期开始时间”-“查询日期结束时间”）/90））
				
                //查询随访次数>=tmp_num,正常档案必须以核心表中的标志来判定，否则会计算两次
				$hypertension_follow_up=new Thypertension_follow_up();
				$hypertension_follow_up->query("select count(*) as snums from(select count(hypertension_follow_up.uuid),clinical_history.disease_date from hypertension_follow_up inner join clinical_history on hypertension_follow_up.id = clinical_history.id inner join individual_core on hypertension_follow_up.id = individual_core.uuid inner join individual_status on hypertension_follow_up.id = individual_status.id where clinical_history.disease_code = '2' and (clinical_history.disease_date < '$start_time' or clinical_history.disease_date is null) and (individual_core.region_path = '".$region->region_path."' or individual_core.region_path like '".$region->region_path.",%') and (individual_core.status_flag = '1') and individual_core.updated <= '$decision_time' and hypertension_follow_up.follow_time >= '$start_time' and hypertension_follow_up.follow_time <= '$decision_time' group by hypertension_follow_up.id,clinical_history.disease_date having count(hypertension_follow_up.uuid) >= $tmp_num)");
				//$hypertension_follow_up->find();
				$sum_hyper_ask=0;
                $tmp_time=time();
				while ($hypertension_follow_up->fetch())
				{
					$sum_hyper_ask=$hypertension_follow_up->snums;
				}
                $hypertension_follow_up->free_statement();
				
                
                //1)统计时段内从居民确诊为患者,正常档案必须以核心表中的标志来判定，否则会计算两次
                $hypertension_follow_up=new Thypertension_follow_up();
                $hypertension_follow_up->query("select count(*) as snums from(select count(hypertension_follow_up.uuid),clinical_history.disease_date from hypertension_follow_up inner join clinical_history on hypertension_follow_up.id = clinical_history.id inner join individual_core on hypertension_follow_up.id = individual_core.uuid inner join individual_status on hypertension_follow_up.id = individual_status.id where clinical_history.disease_code = '2' and clinical_history.disease_date >= '$start_time' and clinical_history.disease_date <= '$decision_time' and (individual_core.region_path = '".$region->region_path."' or individual_core.region_path like '".$region->region_path.",%') and (individual_core.status_flag = '1') and individual_core.updated <= '$decision_time' and hypertension_follow_up.follow_time >= '$start_time' and hypertension_follow_up.follow_time <= '$decision_time' group by hypertension_follow_up.id,clinical_history.disease_date having count(hypertension_follow_up.uuid) >= floor((($decision_time-clinical_history.disease_date)/(3600*24))/90))");
                while ($hypertension_follow_up->fetch())
				{
					$sum_hyper_ask+=$hypertension_follow_up->snums;
				}
                $hypertension_follow_up->free_statement();
                //exit;
                //2)统计时段内的患者死亡
                $hypertension_follow_up=new Thypertension_follow_up();
                $hypertension_follow_up->query("select count(*) as snums from(select count(hypertension_follow_up.uuid),individual_status.status_time from hypertension_follow_up inner join clinical_history on hypertension_follow_up.id = clinical_history.id inner join individual_core on hypertension_follow_up.id = individual_core.uuid inner join individual_status on hypertension_follow_up.id = individual_status.id where clinical_history.disease_code = '2' and (individual_core.region_path = '".$region->region_path."' or individual_core.region_path like '".$region->region_path.",%') and (individual_status.status_flag = '6' and individual_status.status_time > '$start_time' and individual_status.status_time < '$decision_time')
   and individual_core.updated <= '$decision_time' and hypertension_follow_up.follow_time >= '$start_time' and hypertension_follow_up.follow_time <= individual_status.status_time group by hypertension_follow_up.id,individual_status.status_time having count(hypertension_follow_up.uuid) >= floor(((individual_status.status_time-$start_time)/(3600*24))/90))");
                while ($hypertension_follow_up->fetch())
				{
					$sum_hyper_ask+=$hypertension_follow_up->snums;
				}
                $hypertension_follow_up->free_statement();
                //3)统计时段后的患者死亡，死亡时间大于统计结束时间
                $hypertension_follow_up=new Thypertension_follow_up();
                $hypertension_follow_up->query("select count(*) as snums from(select count(hypertension_follow_up.uuid) 
 from hypertension_follow_up inner join clinical_history on hypertension_follow_up.id = clinical_history.id inner join individual_core on hypertension_follow_up.id = individual_core.uuid inner join individual_status on hypertension_follow_up.id = individual_status.id where clinical_history.disease_code = '2' and (individual_core.region_path = '".$region->region_path."' or individual_core.region_path like '".$region->region_path.",%') and (individual_status.status_flag = '6' and individual_status.status_time > '$decision_time') and individual_core.updated > '$decision_time' and hypertension_follow_up.follow_time >= '$start_time' and hypertension_follow_up.follow_time <= '$decision_time' group by hypertension_follow_up.id having count(hypertension_follow_up.uuid) >= $tmp_num)");
                while ($hypertension_follow_up->fetch())
				{
					$sum_hyper_ask+=$hypertension_follow_up->snums;
				}
                $hypertension_follow_up->free_statement();
                //4)统计时段内的患者迁出

				$row[$rowCount]['sum_hyper_ask']=$sum_hyper_ask;
				$sum_hyper_ask_total=$sum_hyper_ask_total+$sum_hyper_ask;
				//血压达标人数（至统计时间） ---此处还可以优化，不需要fetch，但是一个SQL无法用面向对象方式显示出来
				$hypertension_follow_up=new Thypertension_follow_up();
				//$clinical_history=new Tclinical_history();
//				$hypertension_follow_up->joinAdd('inner',$hypertension_follow_up,$clinical_history,'id','id');
//                $hypertension_follow_up->selectAdd("hypertension_follow_up.id,max(hypertension_follow_up.FOLLOW_TIME)");
//				$hypertension_follow_up->whereAdd("hypertension_follow_up.id in ($individual_uuid)");
//                $hypertension_follow_up->whereAdd("hypertension_follow_up.id in (select distinct id from hypertension_follow_up where blood_pressure<'140' and diastolic_blood_pressure<'90' and id in ($individual_uuid) )");
//				$hypertension_follow_up->whereAdd("clinical_history.disease_code='2'");
//				$hypertension_follow_up->groupBy("hypertension_follow_up.id");
//                $hypertension_follow_up->find();
                $hypertension_follow_up->query("select count(*) as counter from (select hypertension_follow_up.id,max(hypertension_follow_up.FOLLOW_TIME) from hypertension_follow_up inner join clinical_history on hypertension_follow_up.id=clinical_history.id where (hypertension_follow_up.id in (select distinct id from hypertension_follow_up where blood_pressure<'140' and diastolic_blood_pressure<'90' and id in ($individual_uuid) and follow_time<=$decision_time )) and (clinical_history.disease_code='2') GROUP BY hypertension_follow_up.id)");
				$sum_archive_last_year=0;
				while ($hypertension_follow_up->fetch())
				{
					//if (calculate_blood_pressure($hypertension_follow_up->id))//当满足最后一次随访血压同时满足“收缩压<140 且 舒张压<90mmHg”时返回1
//					{
						$sum_archive_last_year=$hypertension_follow_up->counter;
					//}
				}
                $hypertension_follow_up->free_statement();
				$row[$rowCount]['archive_last_year']=$sum_archive_last_year;
				$sum_archive_last_year_total=$sum_archive_last_year_total+$sum_archive_last_year;
				
				//辖区内常住成年人口总数（截至统计时间）
				$time_adults=adodb_mktime(0,0,0,adodb_date("m",time()),adodb_date("d",time()),adodb_date("Y",time())-18);//取成年时间
				$individual_core=new Tindividual_core();
				$individual_core->whereAdd("individual_core.region_path = '".$region->region_path."%' or individual_core.region_path like '".$region->region_path.",%'");
				$individual_core->whereAdd("individual_core.date_of_birth<=$time_adults");
                $individual_core->whereAdd("individual_core.updated<='$decision_time'");
				$sum_adults=$individual_core->count();
                $individual_core->free_statement();
				$row[$rowCount]['sum_adults']=$sum_adults;
				$sum_adults_total=$sum_adults_total+$sum_adults;
				
				if ($model=="" || $model=="m1")
				{
				    @$sum_hyper_percent_temp=$row[$rowCount]['sum_archive']/($row[$rowCount]['sum_adults']*($adult_rate/100));
                    
					//高血压患者管理率
					$row[$rowCount]['sum_hyper_percent']=@round($sum_hyper_percent_temp,4)*100;
				}
				if ($model=="" || $model=="m2")
				{
				    @$sum_hyper_rule_temp=$row[$rowCount]['sum_hyper_ask']/$row[$rowCount]['sum_archive'];
                    
					//高血压患者规范管理率
					$row[$rowCount]['sum_hyper_rule_percent']=@round($sum_hyper_rule_temp,4)*100;
				}
				if ($model=="" || $model=="m3")
				{
				    @$sum_archive_last_year_temp=$row[$rowCount]['archive_last_year']/$row[$rowCount]['sum_archive_all'];
                    
					//高血压患者血压控制率
					$row[$rowCount]['sum_archive_last_year_percent']=@round($sum_archive_last_year_temp,4)*100;
				}
				//规范管理率
				if($current_level<6)
				{
					$this->view->td_title='1';
				}
				if($current_level==6){
					$this->view->td_title='2';
				}
                //辖区高血压患病总人数估算
                $row[$rowCount]['sum_archive_gusuan']=ceil($row[$rowCount]['sum_adults']*($adult_rate/100));
				$rowCount++;
			}
			//计算小计
			if ($model=="" || $model=="m1")
				{
					//高血压患者管理率
                    @$sum_hyper_percent_total_temp=$sum_archive_total/($sum_adults_total*$adult_rate/100);
                    
					$sum_hyper_percent_total=@round($sum_hyper_percent_total_temp,4)*100;
					$this->view->assign('sum_hyper_percent_total',$sum_hyper_percent_total);
				}
			if ($model=="" || $model=="m2")
				{
				    @$sum_hyper_rule_percent_total_temp=$sum_hyper_ask_total/$sum_archive_total;
                    
					//高血压患者规范管理率
					$sum_hyper_rule_percent_total=@round($sum_hyper_rule_percent_total_temp,4)*100;
					$this->view->assign('sum_hyper_rule_percent_total',$sum_hyper_rule_percent_total);
				}
			if ($model=="" || $model=="m3")
				{
				    @$sum_archive_last_year_percent_total_temp=$sum_archive_last_year_total/$sum_archive_all_total;
                    
					//高血压患者血压控制率
					$sum_archive_last_year_percent_total=@round($sum_archive_last_year_percent_total_temp,4)*100;
					$this->view->assign('sum_archive_last_year_percent_total',$sum_archive_last_year_percent_total);
				}
            @$sum_archive_gusuan_total_temp=$sum_adults_total*$adult_rate;
            
            $sum_archive_gusuan_total=ceil($sum_adults_total*$adult_rate/100);
			$this->view->assign('row',$row);
			$this->view->assign('model',$model);
			$this->view->assign('adult_rate',$adult_rate);
			$this->view->assign('sum_population_total',$sum_population_total);
            $this->view->assign('sum_population_new_total',$sum_population_new_total);
			$this->view->assign('sum_archive_total',$sum_archive_total);
            $this->view->assign('sum_archive_all_total',$sum_archive_all_total);
            $this->view->assign('sum_archive_gusuan_total',$sum_archive_gusuan_total);
			$this->view->assign('sum_hyper_ask_total',$sum_hyper_ask_total);
			$this->view->assign('sum_archive_last_year_total',$sum_archive_last_year_total);
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
                $realMenu->free_statement();
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
		$this->view->display('hypertension_index.html',$p_id.$model.$decision_time.$start_time);
	}
}