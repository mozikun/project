<?php
class loging_logController  extends controller {

	public function init(){

		$this->view->basepath = $this->_request->getBasePath();
		//用户权限和认证
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/login_log.php');//登录日志
		require_once(__SITEROOT.'library/custom/comm_function.php');//调用添加日志函数
	}
	/**
    *  日志列表
    */
	public function indexAction(){
		$org_id=$this->user['org_id'];//机构ID
		$login_log=new Tlogin_log();
		$login_log->whereAdd("org_id='{$org_id}'");
		$nums=$login_log->count();    //总记录数
		if($nums>0){
			require_once(__SITEROOT.'library/custom/pager.php');
			$login_log=new Tlogin_log();
			$login_log->whereAdd("org_id='{$org_id}'");
			$page_size=10;    //每页显示的条数
			$sub_pages=8;          //每次显示的页数
			$pageCurrent=$this->_request->getParam('page');
			$links=new SubPages($page_size,$nums,$pageCurrent,$sub_pages,$this->_request->getBasePath().$this->getModuleName().'/'.$this->getControllerName().'/'.$this->getActionName().'/page/',2,array());
			$pageCurrent=$links->check_page($pageCurrent);//检查当前页数是否合法
			$startnum=$page_size*($pageCurrent-1);  //计算开始记录数
			$login_log->orderby("login_time DESC");
			//peardb中limit查找从$startnum开始的$page＿size条记录
			$login_log->limit($startnum,$page_size);
			$row=array();
			$login_log->find();
			$i=0;
			while ($login_log->fetch()) {
				$row[$i]['uuid']		= 	$login_log->uuid;
				$row[$i]['login_time']	= 	date("Y-m-d H:i:s",$login_log->login_time);//登录时间
				$staff_info=get_staff_info($login_log->user_id);//用户信息
				$staff_info=$staff_info[1];//用户扩展表信息
				$row[$i]['user_name']	= 	$staff_info->name_real;//用户
				$row[$i]['ip_address']	= 	$login_log->ip_address;//ip
				$row[$i]['remark']		= 	$login_log->remark;//说明信息
				$i++;
			}

			$this->view->row=$row;
			$out=$links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
			$this->view->out=$out;//显示分页
			$this->view->pageCurrent=$pageCurrent;//当前页
			//echo $pageCurrent;
		}


		$this->view->display("log_list.html");
	}
	/**
	 * 删除日志
	 *
	 */
	public function delAction(){
		
		$uuid_array=$this->_request->getParam('selectFlag');
		$token=false;//删除标志
		foreach ($uuid_array as $uuid){			
			$login_log=new Tlogin_log();
			$login_log->whereAdd("uuid='{$uuid}'");
			if($login_log->delete()){
				$token=true;
			}
		}
		if($token==true){
			echo '删除成功！';
		}else{
			echo '删除失败！';
		}

	}


}
?>