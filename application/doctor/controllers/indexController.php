<?php
/**
*@author：我好笨
*@filename: indexController.php
*@package：医生界面首页
*@email：4049054@qq.com
*@create：2010-5-31
*/
class doctor_indexController extends controller
{
	/*
	 *等同于构造函数 
	 */
	public function init()
	{
		$this->view->assign("baseUrl",__BASEPATH);
		$this->view->basePath = $this->_request->getBasePath();
		require_once(__SITEROOT.'library/Myauth.php');
        //require_once(__SITEROOT.'library/privilege.php');
		$this->auth=Zend_Auth::getInstance();
		$this->identity = $this->auth->getIdentity();
		if (!$this->auth->hasIdentity())
		{
			$this->redirect(__BASEPATH."loging/index/index");
		}
	}
	/*
	 * 默认首页菜单
	 */
	public function  indexAction()
	{
 	   if($this->isMobile())
        {
            $this->redirect(__BASEPATH."android/index/list");
        }
		$this->view->title="区域卫生信息平台-四川雅安";
		$this->view->display("main.html");
	}
	/*
	 * 顶部
	 */
	public function topAction()
	{
	    require_once(__SITEROOT.'library/Myauth.php');
		$this->auth = Zend_Auth::getInstance();

		if ($this->auth->hasIdentity()) {
			$this->user = $this->auth->getIdentity();
			//print_r($this->user);
		}else{
			//跳转到登录页
			$this->redirect(__BASEPATH."loging/index/index");		
		}
		$this->view->timer=date("Y年m月d日 H时i分");
        //默认界面
        $this->view->topimg=__BASEPATH."images/logo.jpg";
        require_once __SITEROOT.'library/Models/role_table.php';
        $role=new Trole_table();
        $role->find();
        while($role->fetch())
        {
            //决策者页面
            if(strpos($this->user['role_en_name'],'decision')!==false)
            {
                $this->view->topimg=__BASEPATH."images/logo_jc.jpg";
            }
            //医生页面
            if($this->user['role_en_name']=='doctor')
            {
                $this->view->topimg=__BASEPATH."images/logo.jpg";
            }
            //院长页面
            if($this->user['role_en_name']=='dean')
            {
                $this->view->topimg=__BASEPATH."images/logo_yz.jpg";
            }
            //疾控中心
            if($this->user['role_en_name']=='director')
            {
                $this->view->topimg=__BASEPATH."images/logo_jk.jpg";
            }
            //妇幼
            if($this->user['role_en_name']=='women_and_children')
            {
                $this->view->topimg=__BASEPATH."images/logo_fy.jpg";
            }
            //管理员界面
            if($this->user['role_en_name']=='chs_admin')
            {
                $this->view->topimg=__BASEPATH."images/logo_gl.jpg";
            }
            //系统管理员界面
            if($this->user['role_en_name']=='admin')
            {
                $this->view->topimg=__BASEPATH."images/logo_gl.jpg";
            }
        }
        $role->free_statement();
		$this->view->display("top.html");
	}
	/*
	 * 左菜单
	 * @author mask
	 */
	public function leftdhAction()
	{
		require_once(__SITEROOT.'library/Myauth.php');
		$this->auth = Zend_Auth::getInstance();

		if ($this->auth->hasIdentity()) {
			$this->user = $this->auth->getIdentity();
			//print_r($this->user);
		}else{
			//跳转到登录页
			$this->redirect(__BASEPATH."loging/index/index");		
		}		
		
		require_once(__SITEROOT.'library/MyAcl.php');
		
		
		//$resource=$this->getModuleName().'_'.$this->getControllerName();//模块名_控制器名 做为资源			
		$role_arr=$this->user;//登录用户信息

		$role_en_name=$role_arr['role_en_name'];//取得角色名
		$this->acl=MyAcl::getInstance()->getAcl($role_en_name,'') ;
		
	
		
		//资源是否允许查看
		//var_dump($resources_arr);
		$resources_arr=MyAcl::getInstance()->getResource() ;//所有注册的资源
		$allow_module=array();
		foreach ($resources_arr as $resource){
			$module_name=explode('_',$resource);
			$allow_module[$module_name[0]]=false;
			if($this->acl->isAllowed($role_en_name,$resource,'r')){
				$allow_module[$module_name[0]]=true;
				$this->view->$resource='';
			}else{
				
				
				$this->view->$resource='none';
			}
		}
		//var_dump($allow_module);
		foreach ($allow_module as $key=>$value){
			if($allow_module[$key]==true){
				$this->view->$key='';
			}else{
				$this->view->$key='none';
			}
		}
		
		
		
		//得到当前用户的org_id,然后取standcode给金石使用
        
        $org_id=$this->user['org_id'];
        //取standcode
        require_once __SITEROOT.'library/Models/organization.php';
        $organization=new Torganization();
        $organization->whereAdd("id='$org_id'");
        $organization->find(true);
        if($organization->standard_code)
        {
            //$organization->standard_code='511824';
            $this->view->standard_code=$organization->standard_code;
            $this->view->jinshiip=__JINSHI_SERVER_IP;
        }
        $this->view->user=$this->user;//用户信息
        //医疗信息
        require_once __SITEROOT."library/Models/api_module.php";
        $api_module=new Tapi_module();
        $api_module->whereAdd("module_id!='HRA00.01.01'");
        $api_module->find();
        $i=0;
        $menu_url=array();
        while($api_module->fetch())
        {
            $menu_url[$i]['module_id']=urlencode($api_module->module_id);
            $menu_url[$i]['module_name']=$api_module->module_name;
            $i++;
        }
        $this->view->menu_url=$menu_url;
		$this->view->display("left_menu.html");
	}
    private function isMobile() 
    {
    	$useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    	$useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';
    	
    	$mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
    		
    	$mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');
    		
    	$found_mobile=$this->CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||
    		      $this->CheckSubstrs($mobile_token_list,$useragent);
    		
    	if ($found_mobile) 
    	{
    		return true;
    	}
    	else 
    	{
    		return false;
    	}
    }
    private function CheckSubstrs($substrs,$text)
    	{
    		foreach($substrs as $substr)
    			if(false!==strpos($text,$substr))
    			{
    				return true;
    			}
    				return false;
    	}
	/**
	 * 左间隔
	 */
	public function leftshowAction()
	{
		$this->view->display("left_show.html");
	}
	/**
	 * 右上状态栏
	 */
	public function righttopAction()
	{
		//显示选中病人
		$individual_session=new Zend_Session_Namespace("individual_core");
		$this->view->assign("patient",$individual_session->name?$individual_session->name:"未选择");
		$this->view->assign("yisheng",$this->identity['name_real']);
		$this->view->assign('org_name',$this->identity['org_zh_name']);
        $this->view->assign('role_name',$this->identity['role_zh_name']);
		$this->view->display("right_top.html");
	}

	/**
	 * 登录看到的main信息
	 *
	 */
	public function mainAction(){
		
		$this->view->display("main_index.html");
	}
}
?>