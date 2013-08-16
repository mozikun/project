<?php
/**
 * web_registerController
 * 
 * 预约挂号
 * 
 * @package yaan
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class web_registerController extends controller
{
    public function init()
    {
        require_once __SITEROOT."library/Models/organization.php";
        require_once __SITEROOT."library/Models/appointment_register.php";
        require_once __SITEROOT."library/Models/staff_core.php";
        require_once __SITEROOT."library/Models/web_sort.php";
        require_once __SITEROOT."library/Models/web_article_base.php";
        require_once __SITEROOT."library/Models/web_article_content.php";
        require_once __SITEROOT."library/Models/department.php";
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
     * web_registerController::indexAction()
     * 
     * 挂号首页
     * 
     * @return void
     */
    public function indexAction()
    {	
		//查找医院
		$organization=new Torganization();
		/*
		$organization->orderby("id");
		//$organization->limit(0,10);
		$organization->find();
		$hospitals=array();
		$i=0;
		while($organization->fetch()){
			$hospitals[$i]['id']=$organization->id;
			$hospitals[$i]['name']=$organization->zh_name;
			$i++;
		}
		
		$this->view->hospitals=$hospitals;
		*/
		
		//输出日期
		$dates=array();
		for($i=1;$i<=7;$i++){
			$dates[]=date("Y-m-d",strtotime("+$i day"));
		}
		$this->view->dates=$dates;
        $this->view->display("index.html");
        
    }
	/**
     * web_registerController::departmentAction()
     * 
     * 获取科室
     * 
     * @return void
     */
	public function departmentAction(){ 
		$org_id=$this->_request->getParam("org_id");
		$department=new Tdepartment();
		//$department->debug(1);
		$department->whereAdd("org_id='$org_id'");
		$department->find();
		$dep=array();
		$i=0;
		while($department->fetch()){
			$dep[$i]['uuid']=$department->uuid;
			$dep[$i]['department_name']=$department->department_name;
			$i++;
		}
		echo (json_encode($dep));
		
	}
	/**
     * web_registerController::departmentAction()
     * 
     * 获取科室
     * 
     * @return void
     */
	public function doctorAction(){
		require_once __SITEROOT."library/Models/zuozhen.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		
		$org_id=$this->_request->getParam("org_id");
		$department_id=$this->_request->getParam("department_id");
		$staff_core=new Tstaff_core();
		$zuozhen=new Tzuozhen();
		//$zuozhen->whereAdd("zuozhen.org_id='$org_id'");
		//今天
		//$tomorrow=strtotime("+1 day");
		//七天后
		//$sevenday=strtotime("+8 day");
		//$zuozhen->whereAdd("consulting_time>='$tomorrow' and consulting_time<'$sevenday'");
		//$zuozhen->joinAdd("inner",$zuozhen,$staff_core,"user_id","id");
		//$zuozhen->groupby("zuozhen.user_id");
		$staff_core->whereAdd("staff_core.org_id='$org_id'");
		$staff_core->joinAdd("inner",$staff_core,$zuozhen,"id","user_id");
		$zuozhen->whereAdd("zuozhen.department='$department_id'");
		$staff_core->distinct("staff_core.id");
		$staff_core->debug(1);
		$staff_core->find();
		
		$doctors=array();
		$i=0;
		while($staff_core->fetch()){
			$doctors[$i]['id']=$staff_core->id;
			$doctors[$i]['doctor_name']=$staff_core->name_login;
			$i++;
		}
		//print_r($doctors);
		echo json_encode($doctors);
		
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
                $out = $links->subPageCss2();
                $this->view->assign("pager",$out);
                $this->view->sort_list=$sort_list;
                $this->view->display("index_list.html");
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
                    $articles[$x]['title']=cut_str($article->title,45);
                    $articles[$x]['info']=cut_str($article->info,42);
                    $articles[$x]['updated']=$article->updated?date('Y-m-d',$article->updated):'';
                    $x++;
                }
                $article->free_statement();
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
}