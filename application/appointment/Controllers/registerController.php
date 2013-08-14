<?php
/*
 * todo:挂号维护
 * author:whx
 * time:2012-11-13
 */
class appointment_registerController extends controller{
    public function init()
    {
        require_once (__SITEROOT . '/library/custom/comm_function.php');
        require_once (__SITEROOT . 'library/Models/zuozhen_dictionary.php');
        require_once (__SITEROOT . 'library/Models/appointment_register.php');
        require_once (__SITEROOT . 'library/Models/staff_archive.php');
        require_once (__SITEROOT . 'library/Models/department.php');
        require_once (__SITEROOT . 'library/Models/clinic.php');
        require_once (__SITEROOT . 'library/Models/number_species.php');
        require_once(__SITEROOT . 'library/Models/zuozhen.php');
        require_once(__SITEROOT . 'library/Models/staff_core.php'); //用户核心表
        require_once(__SITEROOT . "application/admin/models/getRoles.php"); //取得角色
        require_once(__SITEROOT . 'library/custom/pager.php'); //分页表
        $this->view->basePath = $this->_request->getBasePath();
    }
    
    /*************************
     * 预约挂号列表
     ************************/
    public function listAction()
	
    {   
		$identity_number=$this->_request->getParam("identity_number");
        $username=$this->_request->getParam("username");
        $department_search=$this->_request->getParam("department"); 
        $time_start=$this->_request->getParam("time_start");
        $time_end=$this->_request->getParam("time_end");
        $flag=$this->_request->getParam("flag");
		$this->view->identity_number=$identity_number;
		$this->view->username=$username;
		$this->view->department_search=$department_search;
		$this->view->time_start=$time_start;
		$this->view->time_end=$time_end;
		$this->view->flag_flag=$flag;
		
		
        $staff_core = new Tstaff_core();
        $guahao_list = new Tappointment_register();
		$department=new Tdepartment();
		$clinic=new Tclinic();
		$number_species=new Tnumber_species();
        $org_id = $_SESSION['Zend_Auth']['storage']['org_id'];
        $region_id = $_SESSION['Zend_Auth']['storage']['region_id'];
        $guahao_list->whereAdd("appointment_register.org_id='$org_id'");
		//搜索条件
		if(!empty($username))
		$guahao_list->whereAdd("name like '%$username%'");
		if(!empty($identity_number))
		$guahao_list->whereAdd("identity_number like '%$identity_number%'");
		if(!empty($department_search))
		$department->whereAdd("department.department_name like'$department_search%'");
		if(!empty($flag)&&$flag!=0)
		$guahao_list->whereAdd("appointment_register.status ='$flag'");
		if(!empty($time_start))
		{
			$time_start=strtotime($time_start); 
			$guahao_list->whereAdd("appointment_register.register_date >='$time_start'");
		}
		if(!empty($time_end))
		{
			$time_end=strtotime($time_end);
			$guahao_list->whereAdd("appointment_register.register_date <='$time_end'");
		}
		
        $guahao_list->joinAdd("left",$guahao_list,$staff_core,"doctor_id","id");
		$guahao_list->joinAdd("inner",$guahao_list,$department,"department_id","uuid");
		$guahao_list->joinAdd("left",$guahao_list,$clinic,"clinic_id","uuid");
		$guahao_list->joinAdd("left",$guahao_list,$number_species,"number_species_id","uuid");
		$guahao_list->orderby("appointment_register.register_date desc,appointment_register.register_time asc");
		$nums = $guahao_list->count();
		$page_size = 10; //每页显示的条数
        $sub_pages = 8; //每次显示的页数      
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/org_id/' . $org_id . '/region_id/' . $region_id . '/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1); //计算开始记录数
        $guahao_list->limit($startnum, $page_size);
		//$guahao_list->debug(1);
        $guahao_list->find();
		
        $rows = array();
        $count = 0;
        while ($guahao_list->fetch())
        {
            $rows[$count] = $guahao_list->toArray();
            $rows[$count]['register_time'] = date("Y-m-d", $guahao_list->register_date); //格式化预约时间
            $rows[$count]['doctor_name'] =$staff_core->name_login;
            $rows[$count]['day'] =($guahao_list->register_time=='1')?"上午":"下午";
			$rows[$count]['department_name'] =$department->department_name;
            $rows[$count]['clinic_name'] =$clinic->clinic_name;
            $rows[$count]['number_species_name'] =$number_species->no_species_name;
            $count++;
        }
        $arr=array(1=>'正常',2=>"改号",3=>"退号",4=>"已取号");
		$arr1=array(0=>"请选择",1=>'正常',2=>"改号",3=>"退号",4=>"已取号");
		$this->view->status=$arr;
		$this->view->flag=$arr1;
        $this->view->row = $rows;
        $this->view->record_count = $count; //记录数
        $out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->out = $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页
        $this->view->go_back = $this->_request->getParam("go_back", ''); //返回标识 是否出现到机构的链接
        $this->view->display("list.html");
    }
	/********
	 *改变挂号信息状态
	 ********/
	 public function change_statusAction(){
		$data=$this->_request->getParam("data");
		$arr=explode("|",$data);
		$id=$arr[0];
		$status=$arr[1];
		$appointment_register = new Tappointment_register();
		$appointment_register->whereAdd("uuid='$id'");
		$appointment_register->status=$status;
		if($appointment_register->update())
		echo "1|更新成功";
		else{
		echo "2|更新失败";
		}
		
	 }
	 /*****
	 * 删除挂号信息
	 *******/
	 public function delAction(){
		$id=$this->_request->getParam("id");
		$appointment_register = new Tappointment_register();
		$appointment_register->whereAdd("uuid='$id'");
		if($appointment_register->delete()){
		echo "1|删除成功";
		}
		else
		echo "2|删除失败";
		
	 }
}
?>