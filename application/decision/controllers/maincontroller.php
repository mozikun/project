<?php 
   class decision_mainController extends controller
   {
   	    public function init()
        {
   	    	require_once(__SITEROOT.'library/privilege.php');
            require_once __SITEROOT . '/library/custom/comm_function.php';
            $this->view->assign("baseUrl",__BASEPATH);
	        $this->view->assign("basePath", __BASEPATH);
            require_once(__SITEROOT.'library/MyAuth.php');
   	    }
   	    /**
   	     * decision_mainController::indexAction()
   	     * 
         * 根据角色，自动跳转指定URL
         * 
         * 我好笨 2013-04-01修改
         * 
   	     * @return void
   	     */
   	    public function indexAction()
        {
            require_once __SITEROOT.'library/Models/role_table.php';
            $role=new Trole_table();
            $role->find();
            while($role->fetch())
            {
                //决策者页面
                if(strpos($this->user['role_en_name'],'decision')!==false)
                {
                    $this->redirect(__BASEPATH.'decision/main/decision');
                    exit;
                }
                //医生页面
                if($this->user['role_en_name']=='doctor')
                {
                    $this->redirect(__BASEPATH.'decision/main/doctor');
                    exit;
                }
                //院长页面
                if($this->user['role_en_name']=='dean')
                {
                    $this->redirect(__BASEPATH.'director/index/index');
                    exit;
                }
                //疾控中心
                if($this->user['role_en_name']=='director')
                {
                    //$this->redirect(__BASEPATH.'decision/main/director');
                    //exit;
                }
                //妇幼
                if($this->user['role_en_name']=='women_and_children')
                {
                    //$this->redirect(__BASEPATH.'decision/main/women_and_children');
                    //exit;
                }
                //管理员界面
                if($this->user['role_en_name']=='chs_admin')
                {
                    //$this->redirect(__BASEPATH.'decision/main/chs_admin');
                    //exit;
                }
                //系统管理员界面
                if($this->user['role_en_name']=='admin')
                {
                    $this->redirect(__BASEPATH.'decision/main/data');
                    exit;
                }
                //默认界面
                $this->redirect(__BASEPATH.'decision/main/default');
                exit;
            }
            $role->free_statement();
   	    }
        /**
         * decision_mainController::defaultAction()
         * 
         * 默认界面
         * 
         * @return void
         */
        public function defaultAction()
        {
            $this->view->display("main_index.html");
        }
        /**
         * decision_mainController::adminAction()
         * 
         * 管理员界面
         * 
         * @return void
         */
        public function adminAction()
        {
            //生成树
            $page=file_get_contents(__SITEROOT.'application/doctor/views/scripts/index/left_menu.html');
            preg_match_all('|<span style="float:left;"><a href="###" id="ian(.*)" onclick=".*"><img .* />(.*)</a></span>|Uis',$page,$tmp);
            $tree2='<ul><li><a href="#">雅安市区域卫生信息平台(模块概览)</a><ul>';
            if(isset($tmp[1][29]))
            {
                unset($tmp[1][29]);
                unset($tmp[2][29]);
            }
            $this->view->model=array_map('trim',$tmp[2]);
            foreach($tmp[1] as $k=>$v)
            {
                //一级菜单
                if($k<9)
                {
                    $tree2.='<li><a href="#">'.$tmp[2][$k].'</a>';
                }
                elseif($k==9)
                {
                    $tree2.='<li><a href="#" onclick="show_pic()">查看模块详细...</a>';
                }
                else
                {
                    
                }
            }
            $tree2.='</ul></li></ul>';
            $this->view->tree2=$tree2;
            $this->view->display("admin_index.html");
        }
        /**
         * decision_mainController::treeAction()
         * 
         * 显示整个结构图数据
         * 
         * @return void
         */
        public function treeAction()
        {
            $page=file_get_contents(__SITEROOT.'application/doctor/views/scripts/index/left_menu.html');
            preg_match_all('|<span style="float:left;"><a href="###" id="ian(.*)" onclick=".*"><img .* />(.*)</a></span>|Uis',$page,$tmp);
            $tree='<ul><li><a href="#">雅安市区域卫生信息平台</a><ul>';
            if(isset($tmp[1][29]))
            {
                unset($tmp[1][29]);
                unset($tmp[2][29]);
            }
            $this->view->model=array_map('trim',$tmp[2]);
            foreach($tmp[1] as $k=>$v)
            {
                //一级菜单
                $tree.='<li><a href="#">'.$tmp[2][$k].'</a>';
                preg_match_all('|<a href="###" id="ian'.$v.'_(.*)" onclick=".*">(.*)</a>|Uis',$page,$tmp_2);
                if(isset($tmp_2[2]) && !empty($tmp_2[2]))
                {
                    $tree.='<ul>';
                    foreach($tmp_2[2] as $m=>$n)
                    {
                        //二级菜单
                        $tree.='<li><a href="#">'.$n.'</a>';
                        preg_match_all('|<a href="(.*)" .* id="ian'.$v.'_'.$tmp_2[1][$m].'_[0-9]+" .*>(.*)</a>|Uis',$page,$tmp_url);
                        if(isset($tmp_url[2]) && !empty($tmp_url[2]))
                        {
                            $tree.='<ul>';
                            foreach($tmp_url[2] as $x=>$y)
                            {
                                //三级菜单
                                $tree.='<li><a href="'.$tmp_url[1][$x].'">'.$y.'</a></li>';
                            }
                            $tree.='</ul>';
                        }
                    }
                    $tree.='</ul>';
                }
                else
                {
                    //二级菜单
                    preg_match_all('|<a href="(.*)" .* id="ian'.$v.'_[0-9]+" .*>(.*)</a>|Uis',$page,$tmp_url);
                    if(isset($tmp_url[2]) && !empty($tmp_url[2]))
                    {
                        $tree.='<ul>';
                        foreach($tmp_url[2] as $x=>$y)
                        {
                            $tree.='<li><a href="'.$tmp_url[1][$x].'">'.$y.'</a></li>';
                        }
                        $tree.='</ul>';
                    }
                }
                $tree.='</li>';
            }
            $tree.='</ul></li></ul>';
            $tree=str_replace('<!--{$baseUrl}-->',__BASEPATH,$tree);
            $tree=str_replace('<!--{$basePath}-->',__BASEPATH,$tree);
            echo $tree;
        }
        /**
         * decision_mainController::doctorAction()
         * 
         * 医生界面
         * 
         * @return void
         */
        public function doctorAction()
        {
            $time_start=mktime(0,0,0,date('m'),date('d'),date('Y'));
            $time_end=mktime(0,0,0,date('m'),date('j')+1,date('Y'));
            //取近期提醒
            require_once __SITEROOT."library/Models/tips.php";
            require_once __SITEROOT."library/Models/tips_type.php";
            $doctor_id=$this->user['uuid'];
            $tips=new Ttips();
            $tips_type=new Ttips_type();
            $tips->joinAdd('left',$tips,$tips_type,'tips_type','id');
            $tips->whereAdd("tips.staff_id='$doctor_id'");
            $tips->whereAdd("tips.state='0'");//未完成
            $tips_count=$tips->count();
            $tips->whereAdd("tips_time >='$time_start' and tips_time<='$time_end'");
            $tips->orderBy("tips.tips_time DESC");
            $tips->limit(0,6);
            $tips->find();
            $tips_array=array();
            $i=0;
            while($tips->fetch())
            {
                $tips_array[$i]['tips_name']=$tips->title;
                $tips_array[$i]['tips_type']=$tips_type->tipszh_name;
                $tips_array[$i]['tips_time']=$tips->tips_time?date("Y-m-d",$tips->tips_time):"未指定日期";
                $i++;
            }
            $tips->free_statement();
            $this->view->tips_count=$tips_count;
            $this->view->tips_array=$tips_array;
            //获取数据
            $today['da_new']=0;
            $today['da_update']=0;
            $today['manbing']=0;
            $today['gxy']=0;
            $today['tnb']=0;
            $today['jsb']=0;
            require_once __SITEROOT."library/Models/individual_core.php";
            require_once __SITEROOT."library/Models/individual_archive.php";
            $individual_core_region_path_domain = get_region_path(1);
            $core=new Tindividual_core();
            $core->whereAdd($individual_core_region_path_domain);
            $core->whereAdd("created>='$time_start' and created<='$time_end'");
            $today['da_new']=$core->count();
            $core->free_statement();
            
            $core=new Tindividual_core();
            $core->whereAdd($individual_core_region_path_domain);
            $core->whereAdd("updated>='$time_start' and updated<='$time_end'");
            $today['da_update']=$core->count();
            
            require_once __SITEROOT."library/Models/clinical_history.php";
            $core=new Tindividual_core();
            $core->whereAdd($individual_core_region_path_domain);
            $core->whereAdd("individual_core.status_flag='1'");
            $clinical_history=new Tclinical_history();
            $core->joinAdd('left',$core,$clinical_history,'uuid','id');
            $core->whereAdd("clinical_history.updated>='$time_start' and clinical_history.updated<='$time_end'");
            $core->whereAdd("clinical_history.disease_state='1'");
            $today['manbing']=$core->count();
            $core->free_statement();
            
            $core=new Tindividual_core();
            $core->whereAdd($individual_core_region_path_domain);
            $core->whereAdd("individual_core.status_flag='1'");
            $clinical_history=new Tclinical_history();
            $core->joinAdd('left',$core,$clinical_history,'uuid','id');
            $core->whereAdd("clinical_history.updated>='$time_start' and clinical_history.updated<='$time_end'");
            $core->whereAdd("clinical_history.disease_code='2'");
            $core->whereAdd("clinical_history.disease_state='1'");
            $today['gxy']=$core->count();
            $core->free_statement();
            
            $core=new Tindividual_core();
            $core->whereAdd($individual_core_region_path_domain);
            $core->whereAdd("individual_core.status_flag='1'");
            $clinical_history=new Tclinical_history();
            $core->joinAdd('left',$core,$clinical_history,'uuid','id');
            $core->whereAdd("clinical_history.updated>='$time_start' and clinical_history.updated<='$time_end'");
            $core->whereAdd("clinical_history.disease_code='3'");
            $core->whereAdd("clinical_history.disease_state='1'");
            $today['tnb']=$core->count();
            $core->free_statement();
            
            $core=new Tindividual_core();
            $core->whereAdd($individual_core_region_path_domain);
            $core->whereAdd("individual_core.status_flag='1'");
            $clinical_history=new Tclinical_history();
            $core->joinAdd('left',$core,$clinical_history,'uuid','id');
            $core->whereAdd("clinical_history.updated>='$time_start' and clinical_history.updated<='$time_end'");
            $core->whereAdd("clinical_history.disease_code='8'");
            $core->whereAdd("clinical_history.disease_state='1'");
            $today['jsb']=$core->count();
            $core->free_statement();
            
            
            $this->view->today=$today;
            $this->view->display("doctor_index.html");
        }
        /**
         * decision_mainController::dapicAction()
         * 
         * 绘制线形图
         * 
         * @return void
         */
        public function dapicAction()
        {
            $individual_core_region_path_domain = get_region_path(1);
            $year_start=mktime(0,0,0,date('m'),date('d'),date('Y')-1);
            $year_end=mktime(0,0,0,date('m'),date('j'),date('Y'));
            require_once __SITEROOT."library/Models/individual_core.php";
            $core=new Tindividual_core();
            $core->query("SELECT count(*) as count,to_char(unixts_to_date(individual_core.updated),'yyyy-mm') as day FROM individual_core where updated>='$year_start' and updated<='$year_end' and $individual_core_region_path_domain group by to_char(unixts_to_date(individual_core.updated),'yyyy-mm') order by day asc");
            $physical=array();
            $i=0;
            $t=array();
            while($core->fetch())
            {
                 $date=$core->day;
                 $physical['jds']['data'][$i]=$core->count?$core->count:0;
                 $physical['jds']['serie'][$i]=$date;
                 $physical['jds']['seriename']="更新档案数";
                 $t[$i]=$date;
                 $i++;
            }
            $core->free_statement();
            //绘图
            $units="时间";
      		$title="近期更新档案数走势图";
      		@drawline($physical,$t,"","档案数",$units,"",$title,"1024","280","30");
        }
        /**
         * decision_mainController::decisionAction()
         * 
         * 管理决策者页面
         * 
         * @return void
         */
        public function decisionAction()
        {
            //取当前机构的坐标位置
            require_once __SITEROOT."library/Models/organization.php"; 
            require_once __SITEROOT."library/Models/chs_center.php";
            require_once __SITEROOT."library/Models/individual_core.php";
            $org=new Torganization();
            $org->whereAdd("id='".$this->user['org_id']."'");
            $org->find('true');
            $this_position['x']=$org->longitude;
            $this_position['y']=$org->latitude;
            $org->free_statement();
            //取当前机构管辖的其他机构
            $org=new Torganization();
            $org->whereAdd("organization.region_path like '".$this->user['current_region_path']."%'");
            $org->find();
            $i=0;
            $position=array();
            while($org->fetch())
            {
                if($org->longitude && $org->latitude)
                {
                    $nums=0;
                    $position[$i]['x']=$org->longitude;
                    $position[$i]['y']=$org->latitude;
                    $position[$i]['name']=$org->zh_name;
                    $individual_core=new Tindividual_core();
                    $individual_core->whereAdd("region_path like '".$org->region_path."%'");
                    $individual_core->whereAdd("status_flag=1");
                    $nums=$individual_core->count();
                    $individual_core->free_statement();
                    $position[$i]['info']='<div style=\"width:300px;margin:8px\"><span class=\"title\">'.$org->zh_name.'</span><hr /><p class=\"info_content\">地址：'.$org->address.'<br />电话：'.$org->phone.'<br />机构简介：'.$org->org_info.'</p></div>';
                    $i++;
                }
            }
            $org->free_statement();
            $this->view->this_position=$this_position;
            $this->view->position=json_encode($position);   
            $this->view->display("decision_index.html");
        }
        /**
         * decision_mainController::dataAction()
         * 
         * 数据中心首页
         * 
         * @return void
         */
        public function dataAction()
        {
            //处理计划任务
            $this->view->display("data_index.html");
        }
   }
?>