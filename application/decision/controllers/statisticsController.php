<?php

/**
 * 
 * @author ct
 * 2010 10 26
 */
class decision_statisticsController extends controller
{

        public function init()
        {
                require_once(__SITEROOT . 'library/privilege.php');
                require_once(__SITEROOT . 'library/Models/region.php');
                require_once(__SITEROOT . 'library/Models/examination_table.php');
                require_once __SITEROOT . "library/Models/individual_core.php";
                require_once __SITEROOT . "library/Models/individual_status.php";
                require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
                require_once __SITEROOT.'/library/Models/et_lifecase_assessment.php';
        }

        public function listAction()
        {
             
                //默认当前时间
                $number_time = mktime(0, 0, 0, date("m", time()), date("d", time()), date("Y", time()));
                $time1=$this->_request->getParam("time_start");
                $time2=$this->_request->getParam("time_end");
                $this->view->time1=$time1;
                $this->view->time2=$time2;
                $start_time=$this->_request->getParam("time_start");
                $examina_date = $this->_request->getParam('time_end');
                $time_tag = empty($examina_date) ? $number_time : strtotime($examina_date);
                $current_time = date("Y-m-d", $time_tag);
                $this->view->end_time = $current_time;
                $time_array = explode('-', $current_time);
                $year_start = empty($start_time)?  mktime(0, 0, 0, 1, 1, $time_array[0]):strtotime($start_time);//如果选择了开始时间则去该时间，否则默认为年初
                $this->view->year_start = date("Y-m-d", $year_start);
                $currentTime = time();
                $yearNumber = 65;
                $tagNumber = adodb_mktime(0, 0, 0, adodb_date("n", $currentTime), adodb_date("j", $currentTime), adodb_date("Y", $currentTime) - $yearNumber);
               // echo adodb_date('Y-m-d',$tagNumber);
                
                $this->view->basePath = $this->_request->getBasePath();
                $current_region_id = $this->user['region_id'];
                $current_region_path = $this->user['current_region_path'];
                //获取列表页传递来的下一级的ID
                $nextRegionId = $this->_request->getParam('parent_id');
                $regionDomain = $this->user['region_id'];
                $p_id = empty($nextRegionId) ? $regionDomain : $nextRegionId;
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
                $this->view->add_need_id = $p_id;
                $this->view->caching = FALSE; //开启缓存
                $this->view->cache_lifetime = __CACHING_LEFTTIME; //缓存时间
                if (!$this->view->is_cached('list.html', $p_id . $time_tag))
                {
                        //传递过来的ID的所有地区
                        $antherRegion = new Tregion();
                        $antherRegion->whereAdd("p_id='$p_id'");
                        $antherRegion->whereAdd("id<>'0'");
                        $antherRegion->find();
                        $row = array();
                        $rowCount = 0;
                      
                        while ($antherRegion->fetch())
                        {       
                                $row[$rowCount]['zh_name'] = $antherRegion->zh_name;
                                $row[$rowCount]['id'] = $antherRegion->id;
                                //有健康体检65岁的老年人
                                $individual_core = new Tindividual_core();                                            
                                $individual_core->whereAdd("individual_core.date_of_birth<=$tagNumber");
                                $individual_core->whereAdd("individual_core.region_path like '$antherRegion->region_path%'");
                                $individual_core->whereAdd("individual_core.status_flag=1"); //档案状态    
                                //65岁以上接收健康管理总人数
                                //先找出65岁以上的正常档案，然后从体检表、老年人服务管理中去筛选
                                $individual_core->whereAdd("individual_core.uuid in (select id from examination_table where examination_table.examination_date>='$year_start'and examination_table.examination_date<='$time_tag' union select id from et_lifecase_assessment where et_lifecase_assessment.created>='$year_start'and et_lifecase_assessment.created<='$time_tag' ) ");
                                $lonePerson = $individual_core->count("distinct individual_core.uuid ");
                                
                                 //老年人生活自理能力评估人数
                                $individual_core = new Tindividual_core();  
                                $lifestyle=new Tet_lifecase_assessment();
                              //  $individual_core->whereAdd("individual_core.status_flag=1"); //档案状态
                                $individual_core->whereAdd("individual_core.date_of_birth<=$tagNumber");
                                $individual_core->whereAdd("individual_core.region_path like '$antherRegion->region_path%'");
                                $lifestyle->whereAdd("et_lifecase_assessment.created>='$year_start'and et_lifecase_assessment.created<='$time_tag'");
                                $lifestyle->joinAdd("inner",$lifestyle,$individual_core,"id","uuid");
                                //$et_lifecase_assessment= $individual_core->count("distinct individual_core.uuid ");
                                $et_lifecase_assessment=$lifestyle->count("distinct et_lifecase_assessment.id");
                                
                                //生活方式统计人数
                                $individual_core = new Tindividual_core();                                            
                                $individual_core->whereAdd("individual_core.date_of_birth<=$tagNumber");
                                $individual_core->whereAdd("individual_core.region_path like '$antherRegion->region_path%'");
                                $individual_core->whereAdd("individual_core.status_flag=1"); //档案状态
                                $individual_core->whereAdd("individual_core.uuid in (select id from et_lifestyle where et_lifestyle.created>='$year_start'and et_lifestyle.created<='$time_tag' ) ");
                                $et_lifestyle= $individual_core->count("distinct individual_core.uuid ");
                                
                                //健康评价人数
                                 $individual_core = new Tindividual_core();                                            
                                $individual_core->whereAdd("individual_core.date_of_birth<=$tagNumber");
                                $individual_core->whereAdd("individual_core.region_path like '$antherRegion->region_path%'");
                                $individual_core->whereAdd("individual_core.status_flag=1"); //档案状态
                                $individual_core->whereAdd("individual_core.uuid in (select id from et_health_assessment where et_health_assessment.created>='$year_start'and et_health_assessment.created<='$time_tag' ) ");
                                $et_health_assessment= $individual_core->count("distinct individual_core.uuid ");
                                
                                //健康体检人数
                                $individual_core = new Tindividual_core();                                            
                                $individual_core->whereAdd("individual_core.date_of_birth<=$tagNumber");
                                $individual_core->whereAdd("individual_core.region_path like '$antherRegion->region_path%'");
                                $individual_core->whereAdd("individual_core.status_flag=1"); //档案状态                             
                                $individual_core->whereAdd("individual_core.uuid in (select id from examination_table where examination_table.examination_date>='$year_start'and examination_table.examination_date<='$time_tag' ) ");
                                 $examination_table = $individual_core->count("distinct individual_core.uuid ");
                                 //健康指导
                                $individual_core = new Tindividual_core();                                            
                                $individual_core->whereAdd("individual_core.date_of_birth<=$tagNumber");
                                $individual_core->whereAdd("individual_core.region_path like '$antherRegion->region_path%'");
                                $individual_core->whereAdd("individual_core.status_flag=1"); //档案状态                             
                                $individual_core->whereAdd("individual_core.uuid in (select id from et_health_guidance where et_health_guidance.created>='$year_start'and et_health_guidance.created<='$time_tag' ) ");
                                $et_health_guidance = $individual_core->count("distinct individual_core.uuid ");  
                                  
                                  
                                 
                                //所有65岁及以上常住居民数
                                $individual_coreall = new Tindividual_core();
                                $individual_coreall->whereAdd("individual_core.date_of_birth<=$tagNumber");
                                $individual_coreall->whereAdd("individual_core.region_path like '$antherRegion->region_path%'");
                                $individual_coreall->whereAdd("individual_core.status_flag=1"); //档案状态
                                $allPerson = $individual_coreall->count();
                                $row[$rowCount]['lonePerson']=$lonePerson;
                                $row[$rowCount]['allPerson']=$allPerson;
                                $row[$rowCount]['et_lifecase_assessment']=$et_lifecase_assessment;
                                $row[$rowCount]['et_lifestyle']=$et_lifestyle;
                                $row[$rowCount]['et_health_assessment']=$et_health_assessment;
                                $row[$rowCount]['examination_table']=$examination_table;
                                $row[$rowCount]['et_health_guidance']=$et_health_guidance; 
                                $row[$rowCount]['percent'] = @round($lonePerson / $allPerson * 100, 2);
                                $rowCount++;
                        }
                        
                        $this->view->row = $row;
                       
                }
                $this->view->display('list.html', $p_id);
        }

}

?>