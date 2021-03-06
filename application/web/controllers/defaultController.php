<?php
/**
 * web_defaultController
 * 
 * 门户前台
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class web_defaultController extends controller
{
    public function init()
    {
        require_once __SITEROOT."library/Models/organization.php";
        require_once __SITEROOT."library/Models/appointment_register.php";
        require_once __SITEROOT."library/Models/ask.php";
        require_once __SITEROOT."library/Models/staff_core.php";
        require_once __SITEROOT."library/Models/web_sort.php";
        require_once __SITEROOT."library/Models/web_article_base.php";
        require_once __SITEROOT."library/Models/web_article_content.php";
        require_once __SITEROOT."library/custom/comm_function.php";
        $this->view->basePath = $this->_request->getBasePath();
        //取公共顶部内容
        //取首页栏目
        $web_sort=new Tweb_sort();
        $web_sort->whereAdd("parent_uuid='0'");
        $web_sort->limit(0,20);
        $web_sort->find();
        $i=0;
        $sorts=array();
        while($web_sort->fetch())
        {
            $sorts[$i]['uuid']=$web_sort->uuid;
            $sorts[$i]['py']=$web_sort->sortname_py;
            $sorts[$i]['name']=$web_sort->sortname;
            $i++;
        }
        $this->view->sorts=$sorts;
        $arr=array("天","一","二","三","四","五","六");
        $this->view->timer=date("Y年m月d日 ").' 星期'.$arr[date('w')];
        //取公共底部内容
        //取医院
        $org=new Torganization();
        $org->whereAdd("type=5");
        $org->limit(0,4);
        $org->find();
        $orgs=array();
        $i=0;
        while($org->fetch())
        {
            $orgs[$i]['id']=$org->id;
            $orgs[$i]['zh_name']=$org->zh_name;
            $i++;
        }
        $this->view->orgs=$orgs;
    }
    /**
     * web_defaultController::indexAction()
     * 
     * 门户首页
     * 
     * @return void
     */
    public function indexAction()
    {
        //取栏目列表
        $web_sort=new Tweb_sort();
        $web_sort->whereAdd("parent_uuid='0'");
        $web_sort->limit(0,20);
        $web_sort->find();
        $sort_list=array();
        while($web_sort->fetch())
        {
            $sort_list[$web_sort->sortname_py]['uuid']=$web_sort->uuid;
            $sort_list[$web_sort->sortname_py]['py']=$web_sort->sortname_py;
            $sort_list[$web_sort->sortname_py]['name']=$web_sort->sortname;
            //取子分类
            $web_sort_son=new Tweb_sort();
            $web_sort_son->whereAdd("parent_uuid='".$web_sort->uuid."'");
            $web_sort_son->find();
            $j=0;
            while($web_sort_son->fetch())
            {
                $sort_list[$web_sort->sortname_py]['son'][$j]['uuid']=$web_sort_son->uuid;
                $sort_list[$web_sort->sortname_py]['son'][$j]['py']=$web_sort_son->sortname_py;
                $sort_list[$web_sort->sortname_py]['son'][$j]['name']=$web_sort_son->sortname;
                $j++;
            }
            $web_sort_son->free_statement();
            //取文章列表
            if($web_sort->sortname_py=='jkjy')
            {
                require_once __SITEROOT."library/Models/health_education.php";
                $health=new Thealth_education();
                $health->whereAdd("activity_address is not null");
                $health->orderBy("activity_time desc");
                $health->limit(0,7);
                $health->find();
                $i=0;
                while($health->fetch())
                {
                    $sort_list[$web_sort->sortname_py]['articles'][$i]['uuid']=$health->uuid;
                    $sort_list[$web_sort->sortname_py]['articles'][$i]['title']=($health->activity_time?date("Y-m-d",$health->activity_time):"").'在'.$health->activity_address."举办健康教育活动";
                    $sort_list[$web_sort->sortname_py]['articles'][$i]['info']=$sort_list[$web_sort->sortname_py]['articles'][$i]['title'];
                    $i++;
                }
                $health->free_statement();
            }
            else
            {
                $article=new Tweb_article_base();
                $article->whereAdd("sort_id in(select uuid from web_sort where path like '".$web_sort->path."%')");
                $article->orderBy("updated desc");
                $article->limit(0,8);
                $article->find();
                $i=0;
                while($article->fetch())
                {
                    $sort_list[$web_sort->sortname_py]['articles'][$i]['uuid']=$article->uuid;
                    $sort_list[$web_sort->sortname_py]['articles'][$i]['title']=cut_str($article->title,18);
                    $sort_list[$web_sort->sortname_py]['articles'][$i]['info']=cut_str($article->info,42);
                    $i++;
                }
                $article->free_statement();
            }
            $this->view->$sort_list[$web_sort->sortname_py]['py']=$sort_list[$web_sort->sortname_py];
        }
		//获取医生挂号排行
		$appointment=new Tappointment_register();
		
		$appointment->query("select * from(select doctor_id,count(doctor_id) as c from appointment_register a group by doctor_id order by c desc)where rownum<=10 ");
		$index=1;
		$doctors=array();
		while($appointment->fetch()){
			$staff_core=new Tstaff_core();
			$staff_core->whereAdd("id='$appointment->doctor_id'");
			if($staff_core->count()>0){
			$staff_core->find(true);
			$doctors[$index]['doctor_id']=$staff_core->id;
			$doctors[$index]['doctor_name']=$staff_core->name_login;
			$index++;
			}
		}
		$this->view->doctors=$doctors;
		
		//获取医患互动
		$ask=new Task();
		$staff=new Tstaff_core();
		$ask->orderby("time");
		$ask->limit(0,8);
		$ask->find();
		$ask_array=array();
		$i=0;
		while($ask->fetch()){
			$ask_array[$i]['id']=$ask->id;
			$ask_array[$i]['question']=$ask->question;
			$i++;
		}
		$this->view->ask=$ask_array;
        $this->view->display('index.html');
    }
    /**
     * web_defaultController::listAction()
     * 
     * 列表，含分类文章列表和文章列表
     * 
     * @return void
     */
    public function listAction()
    {
        $lanmu=$this->_request->getParam('lanmu');
        require_once __SITEROOT."/library/custom/pager.php";
        $search=array();
        if($lanmu)
        {
            //判断栏目是否有子栏目
            $web_sort=new Tweb_sort();
            $web_sort->whereAdd("sortname_py='$lanmu'");
            $web_sort->find(true);
            $parent_uuid=$web_sort->uuid;
            //显示路径
            $this->view->path=get_sort_path($parent_uuid);
            $path=$web_sort->path;
            $current_sortname=$web_sort->sortname;
            $parent_sort=new Tweb_sort();
            $parent_sort->whereAdd("parent_uuid='".$parent_uuid."'");
            if($parent_sort->count())
            {
                //分类列表
                //取栏目列表
                $web_sort=new Tweb_sort();
                $web_sort->whereAdd("parent_uuid='".$parent_uuid."'");
                $nums=$web_sort->count();
        		$pageCurrent = intval($this->_request->getParam('page'));
        		$pageCurrent = $pageCurrent?$pageCurrent:1;
        		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        		$links = new SubPages(3,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'web/default/list/lanmu/'.$lanmu.'/page/',2,$search);
        		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
        		$startnum = 3*($pageCurrent-1);  //计算开始记录数
        		$web_sort->limit($startnum,3);
                $web_sort->find();
                $sort_list=array();
                $i=0;
                while($web_sort->fetch())
                {
                    $sort_list[$i]['uuid']=$web_sort->uuid;
                    $sort_list[$i]['py']=$web_sort->sortname_py;
                    $sort_list[$i]['name']=$web_sort->sortname;
                    //单独取健康教育
                    if($web_sort->sortname_py=='jkjyhd' || $web_sort->sortname_py=='jkjycf')
                    {
                        if($web_sort->sortname_py=='jkjyhd')
                        {
                            require_once __SITEROOT."library/Models/health_education.php";
                            $health=new Thealth_education();
                            $health->whereAdd("activity_address is not null");
                            $health->orderBy("activity_time desc");
                            $health->limit(0,6);
                            $health->find();
                            $x=0;
                            while($health->fetch())
                            {
                                $sort_list[$i]['articles'][$x]['uuid']=$health->uuid;
                                $sort_list[$i]['articles'][$x]['sortname']="健康教育活动";
                                $sort_list[$i]['articles'][$x]['title']=($health->activity_time?date("Y-m-d",$health->activity_time):"").'在'.$health->activity_address."举办健康教育活动";
                                $sort_list[$i]['articles'][$x]['info']=$sort_list[$i]['articles'][$x]['title'];
                                $sort_list[$i]['articles'][$x]['updated']=$health->updated?date('Y-m-d',$health->updated):'';
                                $x++;
                            }
                            $health->free_statement();
                            $i++;
                        }
                        if($web_sort->sortname_py=='jkjycf')
                        {
                            require_once __SITEROOT."library/Models/health_prescription.php";
                            $health=new Thealth_prescription();
                            //$health->whereAdd("status_type != 1");
                            $health->orderBy("edit_time desc");
                            $health->limit(0,6);
                            $health->find();
                            $x=0;
                            while($health->fetch())
                            {
                                $sort_list[$i]['articles'][$x]['uuid']=$health->uuid;
                                $sort_list[$i]['articles'][$x]['sortname']="健康教育处方";
                                $sort_list[$i]['articles'][$x]['title']=cut_str($health->title,40);
                                $sort_list[$i]['articles'][$x]['info']=$sort_list[$i]['articles'][$x]['title'];
                                $sort_list[$i]['articles'][$x]['updated']=$health->edit_time?date('Y-m-d',$health->edit_time):'';
                                $x++;
                            }
                            $health->free_statement();
                            $i++;
                        }
                    }
                    else
                    {
                        //取文章列表
                        $article=new Tweb_article_base();
                        $sort=new Tweb_sort();
                        $article->joinAdd('left',$article,$sort,'sort_id','uuid');
                        $article->whereAdd("web_article_base.sort_id in(select uuid from web_sort where path like '".$web_sort->path."%')");
                        $article->orderBy("web_article_base.updated desc");
                        $article->limit(0,6);
                        $article->find();
                        $x=0;
                        while($article->fetch())
                        {
                            $sort_list[$i]['articles'][$x]['uuid']=$article->uuid;
                            $sort_list[$i]['articles'][$x]['sortname']=$sort->sortname;
                            $sort_list[$i]['articles'][$x]['title']=cut_str($article->title,40);
                            $sort_list[$i]['articles'][$x]['info']=cut_str($article->info,42);
                            $sort_list[$i]['articles'][$x]['updated']=$article->updated?date('Y-m-d',$article->updated):'';
                            $x++;
                        }
                        $article->free_statement();
                        $i++;
                    }
                }
                $out = $links->subPageCss2();
                $this->view->assign("pager",$out);
                $this->view->sort_list=$sort_list;
                $this->view->display("index_list.html");
            }
            else
            {
                //单独取健康教育
                if($web_sort->sortname_py=='jkjyhd' || $web_sort->sortname_py=='jkjycf')
                {
                        if($web_sort->sortname_py=='jkjyhd')
                        {
                            require_once __SITEROOT."library/Models/health_education.php";
                            $health=new Thealth_education();
                            $health->whereAdd("activity_address is not null");
                            $nums=$health->count();
                      		$pageCurrent = intval($this->_request->getParam('page'));
                      		$pageCurrent = $pageCurrent?$pageCurrent:1;
                      		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
                      		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'web/default/list/lanmu/'.$lanmu.'/page/',2,$search);
                      		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
                      		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
                      		$health->limit($startnum,__ROWSOFPAGE);
                            $health->orderBy("activity_time desc");
                            $health->find();
                            $x=0;
                            $articles=array();
                            while($health->fetch())
                            {
                                $articles[$x]['uuid']=$health->uuid;
                                $articles[$x]['sortname']="健康教育活动";
                                $articles[$x]['sort_id']='jkjyhd';
                                $articles[$x]['title']=($health->activity_time?date("Y-m-d",$health->activity_time):"").'在'.$health->activity_address."举办健康教育活动";
                                $articles[$x]['info']=$articles[$x]['title'];
                                $articles[$x]['updated']=$health->updated?date('Y-m-d',$health->updated):'';
                                $x++;
                            }
                            $health->free_statement();
                        }
                        if($web_sort->sortname_py=='jkjycf')
                        {
                            require_once __SITEROOT."library/Models/health_prescription.php";
                            $health=new Thealth_prescription();
                            //$health->whereAdd("status_type != 1");
                            $nums=$health->count();
                      		$pageCurrent = intval($this->_request->getParam('page'));
                      		$pageCurrent = $pageCurrent?$pageCurrent:1;
                      		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
                      		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'web/default/list/lanmu/'.$lanmu.'/page/',2,$search);
                      		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
                      		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
                      		$health->limit($startnum,__ROWSOFPAGE);
                            $health->orderBy("edit_time desc");
                            $health->find();
                            $x=0;
                            $articles=array();
                            while($health->fetch())
                            {
                                $articles[$x]['uuid']=$health->uuid;
                                $articles[$x]['sort_id']='jkjycf';
                                $articles[$x]['sortname']="健康教育处方";
                                $articles[$x]['title']=cut_str($health->title,40);
                                $articles[$x]['info']=$articles[$x]['title'];
                                $articles[$x]['updated']=$health->edit_time?date('Y-m-d',$health->edit_time):'';
                                $x++;
                            }
                            $health->free_statement();
                        }
                }
                else
                {
                    //文章列表
                    $article=new Tweb_article_base();
                    $article->whereAdd("web_article_base.sort_id in(select uuid from web_sort where path like '".$path."%')");
                    $nums=$article->count();
              		$pageCurrent = intval($this->_request->getParam('page'));
              		$pageCurrent = $pageCurrent?$pageCurrent:1;
              		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
              		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'web/default/list/lanmu/'.$lanmu.'/page/',2,$search);
              		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
              		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
              		$article->limit($startnum,__ROWSOFPAGE);
                    $article->orderBy("web_article_base.updated desc");
                    $article->limit($startnum,__ROWSOFPAGE);
                    $article->find();
                    $x=0;
                    $articles=array();
                    while($article->fetch())
                    {
                        $articles[$x]['uuid']=$article->uuid;
                        $articles[$x]['sort_id']=$article->sort_id;
                        $articles[$x]['title']=cut_str($article->title,45);
                        $articles[$x]['info']=cut_str($article->info,42);
                        $articles[$x]['updated']=$article->updated?date('Y-m-d',$article->updated):'';
                        $x++;
                    }
                    $article->free_statement();
                }
                $out = $links->subPageCss2();
                $this->view->assign("pager",$out);
                $this->view->articles=$articles;
                $this->view->current_sortname=$current_sortname;
                $this->view->display("list_article.html");
            }
        }
        else
        {
            //报错
            
        }
    }
    /**
     * web_defaultController::viewAction()
     * 
     * 查看文章
     * 
     * @return void
     */
    public function viewAction()
    {
        $uuid=$this->_request->getParam('uuid');
        if($uuid)
        {
            //取文章详细
            $article=new Tweb_article_base();
            $article_content=new Tweb_article_content();
            $article->joinAdd('left',$article,$article_content,'uuid','article_id');
            $article->whereAdd("web_article_base.uuid='$uuid'");
            $article->find(true);
            $updated=$article->updated;
            $sort=$article->sort_id;
            $article->updated=$article->updated?date('Y-m-d H:i',$article->updated):'';
            $this->view->article=$article;
            //显示路径
            $this->view->path=get_sort_path($article->sort_id);
            $article->free_statement();
            $tips=array();
            //取上一条
            $tips['before']='';
            $article=new Tweb_article_base();
            $article->whereAdd("updated<='$updated'");
            $article->whereAdd("sort_id='$sort'");
            $article->whereAdd("uuid!='$uuid'");
            $article->orderBy('updated desc');
            $article->find(true);
            $tips['before']=$article->uuid;
            $article->free_statement();
            //取下一条
            $tips['next']='';
            $article=new Tweb_article_base();
            $article->whereAdd("updated>='$updated'");
            $article->whereAdd("sort_id='$sort'");
            $article->whereAdd("uuid!='$uuid'");
            $article->orderBy('updated desc');
            $article->find(true);
            $tips['next']=$article->uuid;
            $article->free_statement();
            $this->view->tips=$tips;
            $this->view->article_content=$article_content;
        }
        $this->view->display("detail.html");
    }
    /**
     * web_defaultController::jkjyhdAction()
     * 
     * 显示健康教育活动表格
     * 
     * @return void
     */
    public function jkjyhdAction()
    {
        $uuid=$this->_request->getParam('uuid');
        require_once __SITEROOT."library/Models/health_education.php";
        require_once __SITEROOT.'/library/custom/comm_function.php';
		$health_education=new Thealth_education();
		$health_education->whereAdd("uuid='$uuid'");
		$health_education->find(true);
		//格式化时间
		$health_education->activity_time=$health_education->activity_time?date("Y-m-d",$health_education->activity_time):"";
        $updated=$health_education->created;
		$health_education->updated=$health_education->created?date("Y-m-d",$health_education->created):"";
        $health_education->org_id=get_organization_name($health_education->org_id);
		$this->view->health_education=$health_education;
		//负责医生列表
		$this->view->response_doctor=get_staff_name_byid($health_education->person_in_charge);
        //填表人医生列表
		$this->view->people_fillin_form=get_staff_name_byid($health_education->people_fillin_form);
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$temp=@explode("|",$health_education->more_info);
		foreach ($health_more_info as $k=>$v)
		{
            if (@in_array($v[0],$temp))
            {
                $health_more_info[$k]['check']="checked='checked'";
            }
    		else 
    		{
                $health_more_info[$k]['check']="";
    		}
		}
		$this->view->assign("health_more_info",$health_more_info);
		$temp_type=@explode("|",$health_education->activity_type);
		foreach ($he_active_type as $k=>$v)
		{
    		if (@in_array($v[0],$temp_type))
    		{
  				$he_active_type[$k]['check']="checked='checked'";
    		}
    		else 
            {
                $he_active_type[$k]['check']="";
            }
		}
		$this->view->assign("he_active_type",$he_active_type);
        $tips=array();
        //取上一条
        $tips['before']='';
        $article=new Thealth_education();
        $article->whereAdd("created<='$updated'");
        $article->whereAdd("uuid!='$uuid'");
        $article->orderBy('created desc');
        $article->find(true);
        $tips['before']=$article->uuid;
        $article->free_statement();
        //取下一条
        $tips['next']='';
        $article=new Thealth_education();
        $article->whereAdd("created>='$updated'");
        $article->whereAdd("uuid!='$uuid'");
        $article->orderBy('created desc');
        $article->find(true);
        $tips['next']=$article->uuid;
        $article->free_statement();
        $this->view->tips=$tips;
		$this->view->display('detail_jkjyhd.html');
    }
    /**
     * web_defaultController::jkjycfAction()
     * 
     * 健康教育处方详细
     * 
     * @return void
     */
    public function jkjycfAction()
    {
        $uuid=$this->_request->getParam('uuid');
        if($uuid)
        {
            require_once __SITEROOT."library/Models/health_prescription.php";
            //取文章详细
            $article=new Thealth_prescription();
            $article->whereAdd("uuid='$uuid'");
            $article->find(true);
            $article->source=get_organization_name($article->org_id);
            $updated=$article->edit_time;
            $sort=$article->sort_id;
            $article->updated=$article->edit_time?date('Y-m-d H:i',$article->edit_time):'';
            $this->view->article=$article;
            //显示路径
            $this->view->path=get_sort_path($article->sort_id);
            $article->free_statement();
            $tips=array();
            //取上一条
            $tips['before']='';
            $article=new Thealth_prescription();
            $article->whereAdd("edit_time<='$updated'");
            $article->whereAdd("uuid!='$uuid'");
            $article->orderBy('edit_time desc');
            $article->find(true);
            $tips['before']=$article->uuid;
            $article->free_statement();
            //取下一条
            $tips['next']='';
            $article=new Thealth_prescription();
            $article->whereAdd("edit_time>='$updated'");
            $article->whereAdd("uuid!='$uuid'");
            $article->orderBy('edit_time desc');
            $article->find(true);
            $tips['next']=$article->uuid;
            $article->free_statement();
            $this->view->tips=$tips;
            $this->view->article_content=$article;
        }
        $this->view->display("detail.html");
    }
}