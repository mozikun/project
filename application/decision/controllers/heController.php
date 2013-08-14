<?php

/**
 * @author：我好笨
 * @filename: indexController.php
 * @package：用于完成慢病高血压考核指标的统计
 * @email：4049054@qq.com
 * @create：2010-9-13
 */
class decision_heController extends controller
{

        /**
         * 自动加载
         */
        public function init()
        {
                $this->haveWritePrivilege = '';
                //权限验证
                require_once(__SITEROOT . 'library/privilege.php');
                require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
                require_once __SITEROOT . '/library/custom/comm_function.php';
                require_once __SITEROOT . "library/Models/health_education.php";
                require_once __SITEROOT . "library/Models/staff_core.php";
                require_once __SITEROOT . "library/Models/region.php";
                $this->view->basePath = $this->_request->getBasePath();
        }

        /**
         * 主控制器
         * 用于列表
         */
        public function indexAction()
        {
                $model = $this->_request->getParam('model', ''); //用于控制显示
                //2012-08-20按照罗领导要求，增加按年统计
                $decision_time = $this->_request->getParam('decision_time');
                $search_time = $this->_request->getParam('search_time');
                $start_time=$this->_request->getParam("start_time");
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
                //echo $$regionDomain;
                $p_id = empty($p_id) ? $regionDomain : $p_id;
                $this->view->caching = FALSE; //开启缓存
                $this->view->cache_lifetime = __CACHING_LEFTTIME; //缓存时间
                if (!$this->view->is_cached('he_index.html', $p_id . $model . $decision_time))
                {
                        require_once __SITEROOT . '/library/data_arr/arrdata.php';
                        $errorMessage = $this->_request->getParam('errorMessage', '');
                        //var_dump($this->user);
                        $regionDomain = $this->user['region_id'];
                        //echo $$regionDomain;
                        $p_id = empty($p_id) ? $regionDomain : $p_id;
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
                        $rowCount = 0; //行数
                        //小计所有用到的字段
                        $sum_txt_total = 0; //发放健康教育印刷资料的数量
                        $sum_video_total = 0; //播放健康教育音像资料的次数
						$sum_lecture_total=0;//讲座次数
						$sum_lecture_person_total=0;//讲座人数
                        $sum_ask_total = 0; //举办健康教育咨询活动的次数
                        $sum_ask_person_total = 0; //举办健康教育咨询活动的参加人数

                        $time = adodb_mktime(0, 0, 0, adodb_date("m", time()), adodb_date("d", time()), adodb_date("Y", time()) - 1); //取过去一年的时间
                        while ($region->fetch())
                        {
                                //$row[$rowCount]['adult_rate'] = $adult_rate;
                                $row[$rowCount]['id'] = trim($region->id);
                                $row[$rowCount]['zh_name'] = $region->zh_name;
                                $row[$rowCount]['region_path'] = $region->region_path;
                                $row[$rowCount]['standard_code'] = $region->standard_code;
                                $row[$rowCount]['p_id'] = trim($region->p_id);
                                $row[$rowCount]['standard_code'] = trim($region->standard_code);
                                $current_level = count(explode(',', $region->region_path));
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
                                if ($model == "" || $model == "m1")
                                {
                                        //发放健康教育印刷资料的数量--统计宣传品数量
                                        $sum_txt_temp = 0;
                                        $health_education = new Thealth_education();
                                        $staff_core = new Tstaff_core();
                                        $health_education->joinAdd('inner', $health_education, $staff_core, 'staff_id', 'id');
                                        $health_education->whereAdd("staff_core.region_path like '" . $region->region_path . "%'");
                                        $health_education->whereAdd("health_education.created >= '" . $start_time . "'");
                                        $health_education->whereAdd("health_education.created <= '" . $decision_time . "'");
                                        $health_education->selectAdd("sum(health_education.promo_num) as nums,1 as region_path");
                                        $health_education->groupBy("1");
                                        $health_education->find(true);
										if(!empty($health_education->nums))
                                        $sum_txt_temp = $health_education->nums;
                                        $row[$rowCount]['sum_txt'] = $sum_txt_temp;
                                        $sum_txt_total = $sum_txt_total + $sum_txt_temp;
                                }

                                if ($model == "" || $model == "m2")
                                {
                                        //播放健康教育音像资料的次数
                                        $sum_video_temp = 0;
                                        $health_education = new Thealth_education();
                                        $staff_core = new Tstaff_core();
                                        $health_education->joinAdd('inner', $health_education, $staff_core, 'staff_id', 'id');
                                        $health_education->whereAdd("staff_core.region_path like '" . $region->region_path . "%'");
                                        $health_education->whereAdd("health_education.created >= '" . $start_time . "'");
                                        $health_education->whereAdd("health_education.created <= '" . $decision_time . "'");
                                        $health_education->find();
                                        //先取不为空的数据出来
                                        while ($health_education->fetch())
                                        {
                                                if (@in_array("2", explode('|', $health_education->activity_type)))
                                                {
                                                        $sum_video_temp++;
                                                }
                                        }
                                        $row[$rowCount]['sum_video'] = $sum_video_temp;
                                        $sum_video_total = $sum_video_total + $sum_video_temp;
                                }
                                if ($model == "" || $model == "m3")
                                {
                                        //健康咨询活动次数
                                        $sum_ask_temp = 0;
                                        $health_education = new Thealth_education();
                                        $staff_core = new Tstaff_core();
                                        $health_education->joinAdd('inner', $health_education, $staff_core, 'staff_id', 'id');
                                        $health_education->whereAdd("staff_core.region_path like '" . $region->region_path . "%'");
                                        $health_education->whereAdd("health_education.created >= '" . $start_time . "'");
                                        $health_education->whereAdd("health_education.created <= '" . $decision_time . "'");
										$health_education->find();
										 while ($health_education->fetch())
                                        {
                                                if (@in_array("4", explode('|', $health_education->activity_type)))
                                                {
                                                        $sum_ask_temp++;
                                                }
                                        }
                  
                                        $row[$rowCount]['sum_ask'] = $sum_ask_temp;
                                        $sum_ask_total = $sum_ask_total + $sum_ask_temp;


                                        //健康教育活动人数
                                        $sum_ask_person_temp = 0;
                                        $health_education = new Thealth_education();
                                        $staff_core = new Tstaff_core();
                                        $health_education->joinAdd('inner', $health_education, $staff_core, 'staff_id', 'id');
                                        $health_education->whereAdd("staff_core.region_path like '" . $region->region_path . "%'");
                                        $health_education->whereAdd("health_education.created >= '" . $start_time . "'");
                                        $health_education->whereAdd("health_education.created <= '" . $decision_time . "'");
                                       // $health_education->whereAdd("person_num is not null");
                                        //$health_education->selectAdd("sum(health_education.person_num) as nums,2 as region_path");
                                        //$health_education->groupBy("2");
                                        $health_education->find(); 
										 while ($health_education->fetch())
                                        {
                                                if (@in_array("4", explode('|', $health_education->activity_type)))
                                                {
                                                        $sum_ask_person_temp+=$health_education->person_num;
                                                }
                                        }
                                                    
                                        $row[$rowCount]['sum_ask_person'] = $sum_ask_person_temp;                                   
                                        $sum_ask_person_total = $sum_ask_person_total + $sum_ask_person_temp;
                                }
								if ($model == "" || $model == "m4")
                                {       
                                        //健康讲座次数
                                        $sum_lecture_temp = 0;
                                        $health_education = new Thealth_education();
                                        $staff_core = new Tstaff_core();
                                        $health_education->joinAdd('inner', $health_education, $staff_core, 'staff_id', 'id');
                                        $health_education->whereAdd("staff_core.region_path like '" . $region->region_path . "%'");
                                        $health_education->whereAdd("health_education.created >= '" . $start_time . "'");
                                        $health_education->whereAdd("health_education.created <= '" . $decision_time . "'");
										//$health_education->debug(1);
										$health_education->find();
										 while ($health_education->fetch())
                                        {      
                                                if (@in_array("5", explode('|', $health_education->activity_type)))
                                                {       
                                                        $sum_lecture_temp++;
                                                }
                                        }
                  
                                        $row[$rowCount]['sum_lecture'] = $sum_lecture_temp;
                                        $sum_lecture_total = $sum_lecture_total + $sum_lecture_temp;


                                        //健康讲座人数
                                        $sum_lecture_person_temp = 0;
                                        $health_education = new Thealth_education();
                                        $staff_core = new Tstaff_core();
                                        $health_education->joinAdd('inner', $health_education, $staff_core, 'staff_id', 'id');
                                        $health_education->whereAdd("staff_core.region_path like '" . $region->region_path . "%'");
                                        $health_education->whereAdd("health_education.created >= '" . $start_time . "'");
                                        $health_education->whereAdd("health_education.created <= '" . $decision_time . "'");
                                       // $health_education->whereAdd("person_num is not null");
                                        //$health_education->selectAdd("sum(health_education.person_num) as nums,2 as region_path");
                                        //$health_education->groupBy("2");
                                        $health_education->find(); 
										 while ($health_education->fetch())
                                        {
                                                if (@in_array("5", explode('|', $health_education->activity_type)))
                                                {
                                                        $sum_lecture_person_temp+=$health_education->person_num;
                                                }
                                        }
                                                    
                                        $row[$rowCount]['sum_lecture_person'] = $sum_lecture_person_temp;                                   
                                        $sum_lecture_person_total = $sum_lecture_person_total + $sum_lecture_person_temp;
                                }
								
								
                                //规范管理率
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
                        $this->view->assign('row', $row);
                        $this->view->assign('model', $model);
                        $this->view->assign('sum_txt_total', $sum_txt_total);
                        $this->view->assign('sum_video_total', $sum_video_total);
                        $this->view->assign('sum_ask_total', $sum_ask_total);
                        $this->view->assign('sum_lecture_total', $sum_lecture_total);
                        $this->view->assign('sum_ask_person_total', $sum_ask_person_total);
                        $this->view->assign('sum_lecture_person_total', $sum_lecture_person_total);
                        $this->view->assign('add_need_id', $p_id);
                        $this->view->assign('basePath', __BASEPATH);
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
                        $this->view->errorMessage = $errorMessage;
                }
                $this->view->display('he_index.html', $p_id . $model);
        }

}