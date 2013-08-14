<?php
/**
 * web_indexController
 * 
 * 门户文章管理
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class web_indexController extends controller
{
    public function init()
    {
        $this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT."library/Models/web_sort.php";
        require_once __SITEROOT."library/Models/web_article_base.php";
        require_once __SITEROOT."library/Models/web_article_content.php";
		$this->view->basePath = $this->_request->getBasePath();
    }
    /**
     * web_indexController::indexAction()
     * 
     * 文章列表
     * 
     * @return void
     */
    public function indexAction()
    {
        require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$org_id=$this->user['org_id'];
		$search=array();
		//取搜索值
		$title=$this->_request->getParam('title','');
		$sort_id=$this->_request->getParam('sort','');
		$person_in_charge=$this->_request->getParam('person_in_charge','');
		//医生列表
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$person_in_charge);
		$article=new Tweb_article_base();
        $sort=new Tweb_sort();
        $article->joinAdd('left',$article,$sort,'sort_id','uuid');
		if($title)
		{
			$search['title']=$title;
			$article->whereAdd("web_article_base.title like '%$title%'");
		}
		if($sort_id)
		{
			$search['sort_id']=$sort_id;
            $article->whereAdd("web_article_base.sort_id = '$sort_id'");
		}
		$nums=$article->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'web/index/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$article->limit($startnum,__ROWSOFPAGE);
        $article->orderBy("web_article_base.updated DESC");
        //$article->debugLevel("4");
		$article->find();
		$articles=array();
		$i=0;
		while ($article->fetch())
		{
			$articles[$i]['uuid']=$article->uuid;
			$articles[$i]['js_uuid']=@str_replace(".","_",$article->uuid);
			$articles[$i]['updated']=$article->updated?adodb_date("Y-m-d",$article->updated):"";
			$articles[$i]['title']=$article->title;
            $articles[$i]['sortname']=$sort->sortname;
            $articles[$i]['title_cutstr']=cut_str($article->title,60);
			$articles[$i]['views']=$article->views;
            $articles[$i]['org_id']=get_organization_name($article->org_id);
			$articles[$i]['staff_id']=get_staff_name_byid($article->staff_id);
			$i++;
		}
		$out = $links->subPageCss2();
		$this->view->assign("page",$pageCurrent);
		$this->view->assign("pager",$out);
		$this->view->assign("articles",$articles);
		$this->view->assign("search",$search);
        //取分类
        $web_sort=new Tweb_sort();
        $web_sort->whereAdd("uuid not in (select parent_uuid from web_sort)");
        $web_sort->find();
        $sorts=array();
        $i=0;
        while($web_sort->fetch())
        {
            $sorts[$i]['uuid']=$web_sort->uuid;
            $sorts[$i]['sortname']=$web_sort->sortname;
            $i++;
        }
        $this->view->sorts=$sorts;
		$this->view->display("index.html");
    }
    /**
     * web_indexController::editAction()
     * 
     * 添加编辑文章界面展现
     * 
     * @return void
     */
    public function editAction()
    {
        $uuid=$this->_request->getParam('uuid');
        //取分类
        $web_sort=new Tweb_sort();
        $web_sort->whereAdd("uuid not in (select parent_uuid from web_sort)");
        $web_sort->find();
        $sorts=array();
        $i=0;
        while($web_sort->fetch())
        {
            $sorts[$i]['uuid']=$web_sort->uuid;
            $sorts[$i]['sortname']=$web_sort->sortname;
            $i++;
        }
        $article=new Tweb_article_base();
        $article_content=new Tweb_article_content();
        $article->joinAdd("left",$article,$article_content,'uuid','article_id');
        $article->whereAdd("web_article_base.uuid='$uuid'");
        $article->find(true);
        $article->source=$article->source?$article->source:'网络转载';
        $this->view->article=$article;
        $this->view->article_content=$article_content;
        $this->view->sorts=$sorts;
        $this->view->display('edit.html');
    }
    /**
     * web_indexController::editinAction()
     * 
     * 添加编辑文章写入库
     * 
     * @return void
     */
    public function editinAction()
    {
        $article=new Tweb_article_base();
        $uuid=$this->_request->getParam('uuid');
        $article->title=trim($this->_request->getParam('title'));
        $article->sort_id=$this->_request->getParam('sort');
        $article->info=trim($this->_request->getParam('info'));
        $content=$this->_request->getParam('content');
        $article->updated=time();
        if(!$article->info)
        {
            $article->info=cut_str(strip_tags($content),255);
        }
        $article->source=$this->_request->getParam('source')?trim($this->_request->getParam('source')):"网络转载";
        if($uuid)
        {
            //编辑
            $article->whereAdd("uuid='$uuid'");
            if($article->update())
            {
                $web_article_content=new Tweb_article_content();
                $web_article_content->content=$content;
                $web_article_content->whereAdd("article_id='$uuid'");
                $web_article_content->update();
                $url=array("文章列表"=>__BASEPATH.'web/index/index');
                message("修改文章成功",$url);
            }
            else
            {
                $url=array("文章列表"=>__BASEPATH.'web/index/index');
                message("修改文章失败",$url);
            }
        }
        else
        {
            $uuid=$article->uuid=uniqid('a_',true);
            $article->created=time();
            $article->views=0;
            $article->org_id=$this->user['org_id'];
            $article->staff_id=$this->user['uuid'];
            //添加
            if($article->insert($this->user['uuid']))
            {
                //写入内容
                $web_article_content=new Tweb_article_content();
                $web_article_content->uuid=uniqid('a_',true);
                $web_article_content->article_id=$uuid;
                $web_article_content->content=$content;
                $web_article_content->insert();
                $url=array("文章列表"=>__BASEPATH.'web/index/index');
                message("添加文章成功",$url);
            }
            else
            {
                $url=array("文章列表"=>__BASEPATH.'web/index/index');
                message("添加文章失败",$url);
            }
        }
    }
    /**
     * web_indexController::deleteAction()
     * 
     * 删除文章
     * 
     * @return void
     */
    public function deleteAction()
    {
        $uuid=$this->_request->getParam('uuid');
        $web_article_base=new Tweb_article_base();
        $web_article_base->whereAdd("uuid='$uuid'");
        if($web_article_base->delete())
        {
            $article_content=new Tweb_article_content();
            $article_content->whereAdd("article_id='$uuid'");
            $article_content->delete();
            exit("ok");
        }
        else
        {
            exit("failed");
        }
    }
}