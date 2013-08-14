<?php
/**
 * weixin_moduleController
 * 
 * 完成微信模块管理
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class weixin_moduleController extends controller
{
    /**
     * weixin_moduleController::init()
     * 
     * @return void
     */
    public function init()
    {
        $this->haveWritePrivilege = '';
        require_once (__SITEROOT . 'library/privilege.php');
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/Models/weixin_module.php";
        require_once (__SITEROOT . 'library/Myauth.php');
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."/library/custom/pager.php";
        $this->view->assign("basePath", __BASEPATH);
    }
    /**
     * weixin_moduleController::indexAction()
     * 
     * @return void
     */
    public function indexAction()
    {
        $org_id=$this->user['org_id'];
		$search=array();
		$module=new Tweixin_module();
		$nums=$module->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'weixin/module/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$module->limit($startnum,__ROWSOFPAGE);
        $module->orderBy("module_code DESC");
		$module->find();
		$modules=array();
		$i=0;
		while ($module->fetch())
		{
			$modules[$i]['uuid']=$module->uuid;
			$modules[$i]['js_uuid']=@str_replace(".","_",$module->uuid);
			$modules[$i]['add_time']=$module->add_time?adodb_date("Y-m-d",$module->add_time):"";
			$modules[$i]['module_name']=$module->module_name;
            $modules[$i]['module_code']=$module->module_code;
            $modules[$i]['list_url']=$module->list_url;
            $modules[$i]['api_url']=$module->api_url;
            $modules[$i]['is_index']=$module->is_index==1?'显示':'不显示';
            $modules[$i]['status']=$module->status==1?'启用':'禁用';
            $modules[$i]['display']=$module->display;
			$i++;
		}
		$out = $links->subPageCss2();
		$this->view->assign("page",$pageCurrent);
		$this->view->assign("pager",$out);
		$this->view->assign("modules",$modules);
		$this->view->assign("search",$search);
		$this->view->display("index.html");
    }
    /**
     * weixin_moduleController::editAction()
     * 
     * @return void
     */
    public function editAction()
    {
        $uuid=$this->_request->getParam('uuid');
        $module=new Tweixin_module();
        $module->whereAdd("uuid='$uuid'");
        $module->find(true);
        $module->status=$module->status?$module->status:1;
        $this->view->module=$module;
        $this->view->display('edit.html');
    }
    /**
     * weixin_moduleController::editinAction()
     * 
     * @return void
     */
    public function editinAction()
    {
        $uuid=$this->_request->getParam('uuid');
        $module=new Tweixin_module();
        $module->module_name=trim($this->_request->getParam('module_name'));
        $url=array("微信模块列表"=>__BASEPATH.'weixin/module/index',"添加/编辑微信模块"=>__BASEPATH.'weixin/module/edit/uuid/'.$uuid);
        if(!$module->module_name)
        {
            message("模块名称不能为空",$url);
        }
        $module->module_code=trim($this->_request->getParam('module_code'));
        if(!$module->module_code)
        {
            message("模块代码不能为空",$url);
        }
        //判断模块名是否重复
        $tmp_module=new Tweixin_module();
        $tmp_module->whereAdd("module_code='".$module->module_code."'");
        if($uuid)
        {
            $tmp_module->whereAdd("uuid!='$uuid'");
        }
        if($tmp_module->count())
        {
            message("模块代码重复，请重新输入",$url);
        }
        $module->api_url='weixin/api/do/code/'.$module->module_code;
        $module->list_url=trim($this->_request->getParam('list_url'));
        $module->is_index=trim($this->_request->getParam('is_index'));
        if($module->is_index==1 && !$module->list_url)
        {
            message("首页显示的模块必须要填写列表地址",$url);
        }
        $module->is_index=$module->is_index==1?$module->is_index:2;
        $module->status=trim($this->_request->getParam('status'));
        $module->status=$module->status==1?$module->status:2;
        if($uuid)
        {
            $module->whereAdd("uuid='$uuid'");
            if($module->update())
            {
                message("编辑微信模块成功",$url);
            }
            else
            {
                message("编辑微信模块失败",$url);
            }
        }
        else
        {
            $url=array("微信模块列表"=>__BASEPATH.'weixin/module/index');
            $module->uuid=uniqid('wx_',true);
            if($module->insert())
            {
                message("新增微信模块成功",$url);
            }
            else
            {
                message("新增微信模块失败",$url);
            }
        }
    }
    /**
     * weixin_moduleController::deleteAction()
     * 
     * @return void
     */
    public function deleteAction()
    {
        $uuid=trim($this->_request->getParam('uuid'));
        if($uuid)
        {
            $module=new Tweixin_module();
            $module->whereAdd("uuid='$uuid'");
            if($module->delete())
            {
                echo 'ok';
                exit;
            }
            else
            {
                echo 'failed';
                exit;
            }
        }
        else
        {
            echo 'failed';
            exit;
        }
    }
    /**
     * weixin_moduleController::chkAction()
     * 
     * @return void
     */
    public function chkAction()
    {
        $uuid=trim($this->_request->getParam('uuid'));
        $code=trim($this->_request->getParam('code'));
        $tmp_module=new Tweixin_module();
        $tmp_module->whereAdd("module_code='".$code."'");
        if($uuid)
        {
            $tmp_module->whereAdd("uuid!='$uuid'");
        }
        if($tmp_module->count())
        {
            echo 'failed';
            exit;
        }
        else
        {
            echo 'ok';
            exit;
        }
    }
    /**
     * weixin_moduleController::displayAction()
     * 
     * 修改模块排序
     * 
     * @return void
     */
    public function displayAction()
    {
        $ids=$this->_request->getParam('ids');
        if(!empty($ids))
        {
            foreach($ids as $k=>$v)
            {
                if(isset($v[0]) && $v[0] && $k)
                {
                    $v[0]=intval($v[0]);
                    $module=new Tweixin_module();
                    $module->whereAdd("uuid='$k'");
                    $module->display=$v[0];
                    $module->update();
                }
            }
            exit('ok');
        }
        else
        {
            exit('failed');
        }
    }
}