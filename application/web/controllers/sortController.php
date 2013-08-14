<?php
/**
 * web_sortController
 * 
 * 网站栏目管理
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class web_sortController extends controller
{
    public function init()
    {
        $this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT.'/library/pinyin/pinyin.php';
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT."library/Models/web_sort.php";
		$this->view->basePath = $this->_request->getBasePath();
    }
    /**
     * web_sortController::indexAction()
     * 
     * 栏目列表
     * 
     * @return void
     */
    public function indexAction()
    {
        $current_id=$this->_request->getParam('uuid');
        $web_sort=new Tweb_sort();
        if($current_id)
        {
            $web_sort->whereAdd("parent_uuid='$current_id'");
        }
        else
        {
            $web_sort->whereAdd("parent_uuid='0'");
        }
        $web_sort->find();
        $i=0;
        $sort=array();
        while($web_sort->fetch())
        {
            $sort[$i]['uuid']=$web_sort->uuid;
            $sort[$i]['js_uuid']=str_replace('.','_',$web_sort->uuid);
            $sort[$i]['sortname']=$web_sort->sortname;
            $sort[$i]['sortname_py']=$web_sort->sortname_py;
            $sort[$i]['sortinfo']=$web_sort->sortinfo;
            $i++;
        }
        //取当前路径
        $current_path=get_sort_path($current_id);
        $this->view->path=$current_path;
        $this->view->sort=$sort;
        $this->view->current_id=$current_id;
        $this->view->display('index.html');
    }
    /**
     * web_sortController::editAction()
     * 
     * 添加编辑栏目展示
     * 
     * @return void
     */
    public function editAction()
    {
        $uuid=$this->_request->getParam('uuid');
        $pid=$this->_request->getParam('pid');
        $path=array();
        if($uuid)
        {
            //获取栏目内容供编辑
            $web_sort=new Tweb_sort();
            $web_sort->whereAdd("uuid='$uuid'");
            $web_sort->find(true);
            $this->view->sort=$web_sort;
            $path=get_sort_path($uuid);
        }
        else
        {
            if($pid)
            {
                //获取父级分类ID
                $path=get_sort_path($pid);
            }
        }
        $this->view->path=$path;
        $this->view->pid=$pid;
        $this->view->display('edit.html');
    }
    /**
     * web_sortController::editinAction()
     * 
     * 添加编辑栏目写入数据库
     * 
     * @return void
     */
    public function editinAction()
    {
        $uuid=$this->_request->getParam('uuid');
        $web_sort=new Tweb_sort();
        $web_sort->sortname=trim($this->_request->getParam('sortname'));
        $web_sort->sortinfo=trim($this->_request->getParam('sortinfo'));
        $web_sort->sortname_py=getPinyin($web_sort->sortname);
        if($uuid)
        {
            //编辑
            $web_sort->whereAdd("uuid='$uuid'");
            if($web_sort->update())
            {
                $url=array("栏目列表"=>__BASEPATH.'web/sort/index/uuid/'.$uuid);
                message("添加门户栏目成功",$url);
            }
            else
            {
                $url=array("栏目列表"=>__BASEPATH.'web/sort/index/uuid/'.$uuid);
                message("编辑门户栏目失败",$url);
            }
        }
        else
        {
            //新增
            $web_sort->parent_uuid=$this->_request->getParam('pid');
            $web_sort->parent_uuid=$web_sort->parent_uuid==''?0:$web_sort->parent_uuid;
            $pid=$web_sort->parent_uuid;
            $uuid=$web_sort->uuid=uniqid('s_',true);
            if($web_sort->parent_uuid)
            {
                $web_parent=new Tweb_sort();
                $web_parent->whereAdd("uuid='".$web_sort->parent_uuid."'");
                $web_parent->find(true);
                if($web_parent->path)
                {
                    $web_sort->path=$web_parent->path.'|'.$web_sort->uuid;
                }
                else
                {
                    $web_sort->path=$web_sort->uuid;
                }
            }
            else
            {
                $web_sort->path=$web_sort->uuid;
            }
            if($web_sort->insert())
            {
                $url=array("栏目列表"=>__BASEPATH.'web/sort/index/uuid/'.$pid);
                message("添加门户栏目成功",$url);
            }
            else
            {
                $url=array("栏目列表"=>__BASEPATH.'web/sort/index/uuid/'.$pid);
                message("添加门户栏目失败",$url);
            }
        }
    }
    /**
     * web_sortController::deleteAction()
     * 
     * 删除栏目
     * 
     * @return void
     */
    public function deleteAction()
    {
        $uuid=$this->_request->getParam('uuid');
        require_once __SITEROOT."library/Models/web_article_base.php";
        $web_article_base=new Tweb_article_base();
        $web_article_base->whereAdd("sort_id='$uuid'");
        if($web_article_base->count())
        {
            exit("article");
        }
        else
        {
            //判断子项目
            $web_sort=new Tweb_sort();
            $web_sort->whereAdd("parent_uuid='$uuid'");
            if($web_sort->count())
            {
                exit("sort");
            }
            $web_sort=new Tweb_sort();
            $web_sort->whereAdd("uuid='$uuid'");
            if($web_sort->delete())
            {
                exit("ok");
            }
            else
            {
                exit("failed");
            }
        }
    }
    /**
     * web_sortController::moveAction()
     * 
     * 移动栏目界面展示
     * 
     * @return void
     */
    public function moveAction()
    {
        
    }
    /**
     * web_sortController::moveinAction()
     * 
     * 移动栏目写入数据库
     * 
     * @return void
     */
    public function moveinAction()
    {
        
    }
}