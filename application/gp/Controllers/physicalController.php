<?php 
class gp_physicalController extends controller{
	/*
	 *体格检查、基本检查
	 */
	public function init()
	{
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/physical_base.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	

	/**
	 * 体格检查列表
	 */
	public function indexAction()
	{
		//初始化搜索条件
		$search=array();
		$search['username']=$this->_request->getParam('username');//姓名包含拼音
		$search['staff_id']=($this->_request->getParam('staff_id')=="-9")?"":$this->_request->getParam('staff_id');//建档医生
		$search['standard_code']=$this->_request->getParam('standard_code');//标准档案号
		$search['identity_number']=$this->_request->getParam('identity_number');//身份证号
		$physical_base_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		$physical_base=new Tphysical_base();
		$core=new Tindividual_core();
		$physical_base->whereAdd($physical_base_region_path_domain);
		$physical_base->joinAdd('left',$physical_base,$core,'id','uuid');
		if ($search['staff_id'])
		{
			$physical_base->whereAdd("physical_base.staff_id = '".$search['staff_id']."'");
		}
		if ($search['username'])
		{
			$physical_base->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if ($search['standard_code'])
		{
			$physical_base->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$physical_base->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
		$nums=$physical_base->count("*");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'gp/physical/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数		
		//处理分页
		$physical_base->limit($startnum,__ROWSOFPAGE);
		$physical_base->find();
		$physical_base_array=array();
		$i=0;
		while ($physical_base->fetch())
		{			
			$physical_base_array[$i]['experience_time']=empty($physical_base->experience_time)?'':adodb_date("Y-m-d",$physical_base->experience_time);//体检时间
			$physical_base_array[$i]['uuid']=$physical_base->uuid;
			if($this->haveWritePrivilege){
				$physical_base_array[$i]['ssname']=$core->name;
			}else{
				$physical_base_array[$i]['ssname']="*";
			}
			$physical_base_array[$i]['module_name']=$physical_base->module_name;//模块名
			$physical_base_array[$i]['height']=$physical_base->height;//身高
			$physical_base_array[$i]['weight']=$physical_base->weight;//体重
			$i++;
		}
		$out = $links->subPageCss2();
		//医生列表
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$search['staff_id']);
		$this->view->search=$search;
		$this->view->assign("pager",$out);
		$this->view->physical=$physical_base_array;
		$this->view->display('index.html');
	}
	/**
	 * 添加、修改基本检查页面
	 *
	 */
	public function addAction(){
		//print_r($this->user);		
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$uuid         		= $this->_request->getParam('uuid');//记录编码
		$individual_session = new Zend_Session_Namespace("individual_core");
		
		if(empty($uuid)){
			//添加
			if(empty($individual_session->uuid)){
				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			$this->view->name 			= $individual_session->name;//姓名
			$sex_code					= array_search_for_other($individual_session->sex,$sex);//性别非标准的代码集
			$this->view->sex 			= empty($sex_code)?'':$sex[$sex_code][1];//性别
			$this->view->age 			= $individual_session->age;//年龄
			$this->view->serial_num 	= $individual_session->standard_code_1;//档案编号
			$this->view->faminy_add 	= $individual_session->address;//家庭地址
			$this->view->telphone		= $individual_session->phone_number;//联系电话			

			$region_users				= region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users	= $region_users;
			$this->view->doctors_signature	= $this->user['uuid'];//医生签字默认当前登录医生id
			$this->view->experience_time= adodb_date("Y-m-d");//检查默认时间


		}else{
			//修改
			$physical_base       = 	new Tphysical_base();
			$individual_core  			= 	new Tindividual_core();
			//$physical_base->debugLevel(9);
			$physical_base->joinAdd('inner',$physical_base,$individual_core,'id','uuid');
			$physical_base->whereAdd("physical_base.uuid='{$uuid}'");
			//$physical_base->debugLevel(4);
			$physical_base->find();
			$physical_base->fetch();
			$this->view->uuid 			= 	$physical_base->uuid;//编号
			$this->view->staff_id 		= 	$physical_base->staff_id;//医生档案号
			$this->view->id 			= 	$physical_base->id;//个人档案号
			$this->view->name 			= $individual_core->name;//姓名
			$sex_code					= array_search_for_other($individual_core->sex,$sex);//性别非标准的代码集
			$this->view->sex 			= empty($sex_code)?'':$sex[$sex_code][1];//性别

			$this->view->serial_num 	= $individual_core->standard_code_1;//档案编号
			$this->view->faminy_add 	= $individual_core->address;//家庭地址
			$this->view->telphone		= $individual_core->phone_number;//联系电话
			$this->view->created 		= $physical_base->created;//添加记录时间
			$this->view->age 			= $physical_base->age;//年龄

			$this->view->height 		= $physical_base->height;//身高(厘米)|text
			$this->view->weight 		= $physical_base->weight;//体重(公斤)|text
			$this->view->bmi 			= $physical_base->bmi;//体重指数|text
			$this->view->s_blood_pressure 	= $physical_base->s_blood_pressure;//收缩压(mmHg)|text
			$this->view->p_blood_pressure 	= $physical_base->p_blood_pressure;//舒张压(mmHg)|text
			$this->view->blood_sugar	 	= $physical_base->blood_sugar;//空腹血糖(mmol/L)|text
			$this->view->doctors_signature 	= $physical_base->doctors_signature;//医生签字|text
			$this->view->experience_time 	= empty($physical_base->experience_time)?'':adodb_date("Y-m-d",$physical_base->experience_time);//体检时间|text

			$region_users					= region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users		= $region_users;
			$this->view->doctors_signature	= $physical_base->doctors_signature;//医生签字默认当前登录医生id

			

		}

		$this->view->display('add.html');
	}
   /**
    * 添加、修改主程序
    *
    */
	public function updateAction(){
		//print_r($_POST);
		$individual_session 				= new Zend_Session_Namespace("individual_core");
		$uuid 								= $this->_request->getParam('uuid');//编号
		$physical_base						= new Tphysical_base();
		
		$physical_base->height 				= $this->_request->getParam('height');//身高(厘米)|text
		
		$physical_base->weight 				= $this->_request->getParam('weight');//体重(公斤)|text
		
		$physical_base->bmi 				= $this->_request->getParam('bmi');//体重指数|text
		
		$physical_base->s_blood_pressure 	= $this->_request->getParam('s_blood_pressure');//收缩压(mmHg)|text
		
		$physical_base->p_blood_pressure 	= $this->_request->getParam('p_blood_pressure');//舒张压(mmHg)|text
		$physical_base->blood_sugar 		= $this->_request->getParam('blood_sugar');//空腹血糖(mmol/L)|text
		
		$physical_base->doctors_signature 	= $this->_request->getParam('doctors_signature');//医生签字|text
		$experience_time					= $this->_request->getParam('experience_time');//体检时间|text
		$physical_base->experience_time 	= empty($experience_time)?'':mkunixstamp($experience_time);

		$update_token=true;
		if(empty($uuid) && !empty($individual_session->uuid)){
			//添加
			$uuid						=uniqid("gp",true);//编号

			$physical_base->uuid  = $uuid;//编号

			$physical_base->staff_id = $this->user['uuid'];//医生档案号			

			$physical_base->id 	= $individual_session->uuid;//个人档案号

			$physical_base->created = time();//添加记录时间
			//$physical_base->debugLevel(8);
			$update_token				= $physical_base->insert();

		}else{
			//修改
			$physical_base->whereAdd("uuid='$uuid'");
			$update_token=$physical_base->update();

		}
		if($update_token==true){
			message("更新成功！",array("体格检查-基本检查"=>__BASEPATH.'gp/physical/index',"添加"=>__BASEPATH."gp/physical/add/","修改"=>__BASEPATH."gp/physical/add/uuid/{$uuid}"));
		}else{
			message("更新失败！",array("体格检查-基本检查"=>__BASEPATH.'gp/physical/index',"添加"=>__BASEPATH."gp/physical/add/","修改"=>__BASEPATH."gp/physical/add/uuid/{$uuid}"));
		}
	}
	
	/**
	 * 删除体格检查-基本检查
	 *
	 */
    public function delAction(){
    	$uuid			= $this->_request->getParam('uuid');//uuid
    	if(empty($uuid)){
    		message("参数错误",array("体格检查-基本检查"=>__BASEPATH.'gp/physical/index',"添加"=>__BASEPATH."gp/physical/add/"));
    	}
    	$physical_base	= new Tphysical_base();
    	$physical_base->whereAdd("uuid='{$uuid}'");
    	if($physical_base->delete()){
    		message("删除成功！",array("体格检查-基本检查"=>__BASEPATH.'gp/physical/index',"添加"=>__BASEPATH."gp/physical/add/"));
    	}else {
    		message("删除成功！",array("体格检查-基本检查"=>__BASEPATH.'gp/physical/index',"添加"=>__BASEPATH."gp/physical/add/"));
    	}
    }
    /**
     * 测试多表事务
     *
     */
    public function dotestAction(){
    	require_once __SITEROOT."library/Models/test1.php";
    	require_once __SITEROOT."library/Models/test2.php";
    	$test1=new Ttest1();
    	$test1->startTransaction();
    	$test1->id='2';
    	if($test1->insert()){
    		$test2= new Ttest2();
    		$test2->name='wan';
    		if($test2->insert()){
    			$test1->commit();
    			$test2->commit();
    			echo 'ok';
    		}else{
    			
    			$test1->rollBack();
    			$test2->rollBack();
    			echo 'failure';
    		}
    		
    		
    	}else{
    		echo 'failure';
    		$test1->rollBack();
    	}
    	
    	
    	
    	
    }
	
}
?>