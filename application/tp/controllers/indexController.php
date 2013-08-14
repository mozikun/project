<?php
/**
 * 工作计划、每日提醒
 *
 */
class tp_indexController extends controller
{

	public function init()
	{
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once __SITEROOT."library/Models/tips.php";//工作计划
		require_once __SITEROOT."library/Models/tips_message.php";//工作计划
		$this->view->basePath = $this->_request->getBasePath();
	}


	/**
	 * 工作计划列表
	 */
	public function indexAction()
	{   
		
		
		//print_r($this->user);
		$state=array('0'=>'未完成','1'=>'完成','2'=>'取消');
		$day=$this->_request->getParam('day');//判断是否是当天的工作计划
		$today_url='';///今日提醒放入分页url
		//初始化搜索条件
		$search=array();
		$search['username']				=$this->_request->getParam('username');//姓名包含拼音
		$search['staff_id']				=($this->_request->getParam('staff_id')=="-9")?"":$this->_request->getParam('staff_id');//建档医生
		$search['standard_code']		=$this->_request->getParam('standard_code');//标准档案号
		$search['identity_number']		=$this->_request->getParam('identity_number');//身份证号
		$search['title']				=$this->_request->getParam('title');//工作计划标题 
		$search['created']				=$this->_request->getParam('created');//工作计划制定时间
		$search['tips_time']			=$this->_request->getParam('tips_time');//工作计划预定执行时间
		$search['tips_complete_time']	=$this->_request->getParam('tips_complete_time');//工作计划实际执行时间
		$search['state']				=$this->_request->getParam('state');//工作计划状态
		//$tips_region_path_domain		=get_region_path(1);
		//$staff_core_region_path_domain	=get_region_path(2);
		//print_r($tips_region_path_domain);
		//print_r($staff_core_region_path_domain);
		$tips=new Ttips();
		$core=new Tindividual_core();
		$tips->whereAdd("tips.region_path like '".$this->user['current_region_path_domain']."%'");
		if($day=='today'){
			//今日提醒
			//$tips->whereAdd("tips.state ='0' or tips.state IS NULL " );//未执行
			$current_day_start=adodb_mktime(0,0,0,date("m"),date("d"),date("Y"));
			$current_day_stop=adodb_mktime(24,0,0,date("m"),date("d"),date("Y"));
			//echo $current_day_start;
			$tips->whereAdd("tips.tips_time>=$current_day_start");
			$tips->whereAdd("tips.tips_time<$current_day_stop");
			$today_url="day/today";//今日提醒放入分页url
		}
		$tips->joinAdd('left',$tips,$core,'id','uuid');
		if ($search['staff_id'])
		{
			$tips->whereAdd("tips.staff_id = '".$search['staff_id']."'");
		}
		if ($search['username'])
		{
			$tips->whereAdd("individual_core.name like '".$search['username']."%' or individual_core.name_pinyin like '".$search['username']."%'");
		}
		if ($search['standard_code'])
		{
			$tips->whereAdd("individual_core.standard_code_1 like '".$search['standard_code']."%'");
		}
		if ($search['identity_number'])
		{
			$tips->whereAdd("individual_core.identity_number like '".$search['identity_number']."%'");
		}
		if ($search['title'])
		{
			$tips->whereAdd("tips.title like '".$search['title']."%'");
		}
		if ($search['created'])
		{
			$tips->whereAdd("tips.created >".mkunixstamp($search['created']));
			$next_time=mkunixstamp($search['created']) + 24*60*60;
			$tips->whereAdd("tips.created <".$next_time);
		}
		if ($search['tips_time'])
		{
			$tips->whereAdd("tips.tips_time = '".mkunixstamp($search['tips_time'])."'");
		}
		if ($search['tips_complete_time'])
		{
			$tips->whereAdd("tips.tips_complete_time = '".mkunixstamp($search['tips_complete_time'])."'");
		}
		if ($search['state']!=='')
		{
			$tips->whereAdd("tips.state = '".$search['state']."'");
		}
		
		$nums=$tips->count("*");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH."tp/index/index/$today_url/page/",2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		//处理分页
		$tips->limit($startnum,__ROWSOFPAGE);
		$tips->orderby("tips.created DESC");
		//$tips->debugLevel(3);
		//echo $nums;
		$tips->find();
		$tips_array=array();
		$i=0;
		while ($tips->fetch())
		{
		    
			$tips_array[$i]['ssname']=$core->name;//姓名
			$tips_array[$i]['address']=$core->address;//地址
			$tips_array[$i]['phone_number']=$core->phone_number;//电话号码
			$tips_array[$i]['uuid']=$tips->uuid;//uuid
			$tips_array[$i]['uuid_']=str_replace('.','_',$tips->uuid);//uuid
			$tips_array[$i]['title']=$tips->title;//标题
			$tips_type_obj=$this->tips_of_current($tips->tips_type);//工作计划类型
			$tips_region_path=$tips_type_obj->tips_region;//取工作计划类型路径		
			$tips_region_path_array=@explode(",",substr($tips_region_path,2));
			$tips_type="";
			foreach ($tips_region_path_array as $tips_id){
				$tips_obj=$this->tips_of_current($tips_id);//取一工作计划类型对象
				$tipszh_name=$tips_obj->tipszh_name;//得到中文名
				$tips_type.=$tipszh_name.'->';
			}
			$tips_array[$i]['tips_type']= trim($tips_type,"->");
			$tips_array[$i]['created']=empty($tips->created)?'':adodb_date("Y-m-d",$tips->created);//计划制定时间
			$tips_array[$i]['tips_time']=empty($tips->tips_time)?'':adodb_date("Y-m-d",$tips->tips_time);//计划预定执行时间
			$tips_array[$i]['tips_complete_time']=empty($tips->tips_complete_time)?'':adodb_date("Y-m-d",$tips->tips_complete_time);//计划完成时间
			$tips_serial_array=@explode("|",$tips->tips_serial);//计划制定者
			$user_list='';
			foreach ($tips_serial_array as $tips_serial){
				$user_list.=get_staff_name_byid($tips_serial).' ';
			}
			$tips_array[$i]['tips_serial']= $user_list;
			
			$tips_array[$i]['token']=!empty($tips->id)?'':'user/all';
			$tips_array[$i]['state']=isset($state[$tips->state])?$state[$tips->state]:'未完成';//当前状态
			$tips_array[$i]['state_code']=$tips->state;//状态代码
			//判断短信是否已近发送过
			$tips_message=new Ttips_message();
			$tips_message->whereAdd("tips_id='$tips->uuid'");
			$tips_array[$i]['status']=$tips->state;
			if($tips_message->count()>0)
			{
				$tips_array[$i]['status']='send';
			}
			$i++;
		}
		$out = $links->subPageCss2();
		//医生列表
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$search['staff_id']);
		$this->view->search=$search;
		//print_r($search);
		$this->view->pager=$out;
		$this->view->state_array=$state;//状态数组
		$this->view->tips_array=$tips_array;
		$this->view->display('index.html');
	}

	/**
	 * 添加、修改 页面
	 *
	 */
	public function addAction(){
		//print_r($this->user);
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		$uuid         		= $this->_request->getParam('uuid');//记录编码
		$individual_session = new Zend_Session_Namespace("individual_core");
		$users_view			= $this->_request->getParam('user');//是群体、个人？
		
		if(empty($uuid)){
			//添加
			
			if($users_view!=""){
				$this->view->title_token		= "添加群体工作计划";
				$this->view->user_token			= "group";
			}else{
				if(empty($individual_session->uuid) ){
					message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
				}
				$this->view->title_token		= "添加个人工作计划";
				$this->view->name 				= $individual_session->name;//姓名
				$sex_code						= array_search_for_other($individual_session->sex,$sex);//性别非标准的代码集
				$this->view->sex 				= empty($sex_code)?'':$sex[$sex_code][1];//性别
				$this->view->age 				= $individual_session->age;//年龄
				$this->view->serial_num 		= $individual_session->standard_code_1;//档案编号
				$this->view->faminy_add 		= $individual_session->address;//家庭地址
				$this->view->telphone			= $individual_session->phone_number;//联系电话
				
			}
			//
			$tips=$this->tips_of_parent('0');//工作计划类型
			//print_r($tips);
			$this->view->tips_type_array=$tips;
			$region_users					= region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users		= $region_users;
			$this->view->current_doctor		= $this->user['uuid'];//默认当前登录医生id
			$this->view->display('add.html');
		}else{
			if($users_view!=""){
				$this->view->title_token		= "修改群体工作计划";
				$this->view->user_token			= "group";
			}else{
				$this->view->title_token		= "修改个人工作计划";
			}
			//修改
			$tips      					 		= 	new Ttips();
			$individual_core  					= 	new Tindividual_core();
			//$tips->debugLevel(9);
			if($users_view==""){
				//个人工作计划
				$tips->joinAdd('inner',$tips,$individual_core,'id','uuid');
			}
			$tips->whereAdd("tips.uuid='{$uuid}'");
			//$tips->debugLevel(4);
			$tips->find();
			$tips->fetch();
			$this->view->uuid 					= $tips->uuid;//编号

			$this->view->staff_id 				= $tips->staff_id;//医生档案号
			if($users_view==""){
				//个人工作计划
				$this->view->id 					= $tips->id;//个人档案号
				$this->view->name 					= $individual_core->name;//姓名
				$sex_code							= array_search_for_other($individual_core->sex,$sex);//性别非标准的代码集
				$this->view->sex 					= empty($sex_code)?'':$sex[$sex_code][1];//性别
				$this->view->serial_num 			= $individual_core->standard_code_1;//档案编号
				$this->view->faminy_add 			= $individual_core->address;//家庭地址
				$this->view->telphone				= $individual_core->phone_number;//联系电话
			}
			
			
			$this->view->created 				= $tips->created;//添加记录时间
			$this->view->title 					= $tips->title;//提醒标题
			$tips_type							= $tips->tips_type;//提醒类型
			$this->view->tips_type 				= $tips_type;//提醒类型			
			$tips_type_current_obj				= $this->tips_of_current($tips_type);//工作计划类型当前ID下所有数据
			//print_r($tips_type_current_obj);
			$tips_region						= $tips_type_current_obj->tips_region;//工作计划类型路径
			$this->view->tips_type_pid 			= $tips_type_current_obj->tips_pid;//父id
			//echo  $tips_type_current_obj->tips_pid;//父id
			$tips_region_array					= explode(",",$tips_region);//	
			$this->view->tips_region_array		= json_encode($tips_region_array);//
			//print_r($tips_region_array);		
			$this->view->tips_time 				= adodb_date("Y-m-d",$tips->tips_time);//计划处理时间
			$this->view->tips_complete_time 	= adodb_date("Y-m-d",$tips->tips_complete_time);//计划完成时间|text
			$this->view->tips_complete_person 	= $tips->tips_complete_person;//计划执行者|text
			$this->view->tips_url 				= $tips->tips_url;//查看地址|text
			/**
			 * 表注释:提醒状态|select|0=>未完成,1=>完成,2=>取消
			 * 
			 * 
			 **/
			$state=array('0'=>'未完成','1'=>'完成','2'=>'取消');
			$this->view->state_options 			= $state; //提醒状态|select|0=>未完成,1=>完成,2=>取消
			$this->view->state_current 			= $tips->state;//提醒状态|select|0=>未完成,1=>完成,2=>取消
			$this->view->tips_framer 			= @explode("|",$tips->tips_framer);//计划参与人员|text
		
			$this->view->current_doctor 		= @explode("|",$tips->tips_serial);//计划制定者|text
			$this->view->tips_info 				= $tips->tips_info;//计划备注|text

			$region_users						= region_users($this->user['current_region_path_domain']);//所有的医生
			//print_r($region_users);
			$this->view->region_users			= $region_users;


			$this->view->display('edit.html');

		}


	}
	/**
	 * 添加、修改工作计划
	 *
	 */
	
	public function updateAction(){
		//print_r($_POST);
		$individual_session 		= new Zend_Session_Namespace("individual_core");
		$uuid 						= $this->_request->getParam('uuid');//编号
		$region_path				= $this->user['current_region_path'];
		$tips						= new Ttips();
		
		$tips->title 				= $this->_request->getParam('title');//提醒标题

		$tips->tips_type 			= $this->_request->getParam('tips_type');//提醒类型
		
		$tips_time					= $this->_request->getParam('tips_time');//计划处理时间
		$tips->tips_time 			= $tips_time?mkunixstamp($tips_time):'';//计划处理时间
		
		$tips_complete_time 		= $this->_request->getParam('tips_complete_time');//计划完成时间|text
		$tips->tips_complete_time 	= $tips_complete_time?mkunixstamp($tips_complete_time):'';//计划完成时间|text
		
		$tips->tips_complete_person = $this->_request->getParam('tips_complete_person');//计划执行者|text
		
		$tips->tips_url 			= $this->_request->getParam('tips_url');//查看地址|text
		
		$tips->state 				= '0';//提醒状态|select|0=>未完成,1=>完成,2=>取消
		
		$tips->tips_framer 			= @implode('|',$this->_request->getParam('tips_framer'));//计划参与人员|text
		
		$tips->tips_serial 			= @implode('|',$this->_request->getParam('tips_serial'));//计划制定者|text
		
		$tips->tips_info 			= $this->_request->getParam('tips_info');//计划备注|text
		$tips->region_path			= $region_path;
		$update_token				= true;
		$user_token					= $this->_request->getParam('user_token');//判断是群体工作计划，还是个人
		if(empty($uuid) ){
			//添加
			$uuid						=uniqid("gp",true);//编号
	
			$tips->uuid  				= $uuid;//编号			
			
	
			$tips->staff_id 			= $this->user['uuid'];//医生档案号	
			

			$tips->id 					= $user_token==""?$individual_session->uuid:'';//个人档案号

			$tips->created 				= time();//添加记录时间
			$tips->debugLevel(8);
			$update_token				= $tips->insert();
	
		}else{
			
			//修改
			$tips->whereAdd("uuid='$uuid'");
			$update_token=$tips->update();

		}
		
	    $group_url='';//群体工作计划;
		$user_token!=''?$group_url='user/all':'';
		if($update_token==true){
			
			message("更新成功！",array("工作计划列表"=>__BASEPATH.'tp/index/index',"添加"=>__BASEPATH."gp/index/add/{$group_url}","修改"=>__BASEPATH."tp/index/add/uuid/{$uuid}/{$group_url}"));
		}else{
			message("更新失败！",array("工作计划列表"=>__BASEPATH.'tp/index/index',"添加"=>__BASEPATH."tp/index/add/{$group_url}","修改"=>__BASEPATH."tp/index/add/uuid/{$uuid}/{$group_url}"));
		}
	}
	/**
	 * 删除工作计划
	 *
	 */
	public function delAction(){
		$uuid			= $this->_request->getParam('uuid');//uuid
    	if(empty($uuid)){
    		message("参数错误",array("工作计划列表"=>__BASEPATH.'tp/index/index',"添加"=>__BASEPATH."tp/index/add/"));
    	}
    	$tips	= new Ttips();
    	$tips->whereAdd("uuid='{$uuid}'");
    	if($tips->delete()){
    		message("删除成功！",array("工作计划列表"=>__BASEPATH.'tp/index/index',"添加"=>__BASEPATH."tp/index/add/"));
    	}else {
    		message("删除成功！",array("工作计划列表"=>__BASEPATH.'tp/index/index',"添加"=>__BASEPATH."tp/index/add/"));
    	}
	}
	/**
	 * 更改工作计划状态
	 *
	 */
	public  function doexecutionAction(){
		$uuid					= $this->_request->getParam('uuid');//要更改的工作计划id
		$state					= $this->_request->getParam('state');//要更改的工作计划状态
		$execution_date			= $this->_request->getParam('execution_date');//工作计划完成时间
		$tips_complete_person	= $this->user['uuid'];//工作计划执行者
		if(empty($uuid) || empty($state) || empty($execution_date)){
			echo "参数错误！";
			exit();
		}
		$tips		= new Ttips();
		$tips->whereAdd("uuid='{$uuid}'");
		$tips->state=$state;
		$tips->tips_complete_time=mkunixstamp($execution_date);//完成时间
		$tips->tips_complete_person=$tips_complete_person;//工作计划完成人
		
		if($tips->update()){
			echo "更改成功！";
		}else{
			echo "更改失败！";
		}
	}
	
	/**
	 * Ajax请求页。计划类型选中时更新所有的计划类型。
	 *
	 */
	public function tipstypeajaxAction(){
		require_once __SITEROOT."library/Models/tips_type.php";//工作计划类型
		$parent_id	= $this->_request->getParam('parent_id');
		$token		= $this->_request->getParam('token');//标志判断是添加还是修改
		//echo $parent_id;
		$tips_type= new Ttips_type();
		if($token=="edit"){
			//修改
			$tips_type->whereAdd("id='{$parent_id}'");
		}else{
			//添加
			$tips_type->whereAdd("tips_pid='{$parent_id}'");
		}
		
		$tips_type->find();
		$tips_region_array=array();//工作计划里的地区Path
		
		while ($tips_type->fetch()) {

			 $tips_region=  $tips_type->tips_region;
			 $tips_region_array=explode(",",$tips_region);
			 //print_r($tips_region_array);
			 if($token=="edit"){
			 	//编辑时
			 }else{
			 	//添加时
			 	unset($tips_region_array[count($tips_region_array)-1]);
			 }
			 break;

		}
        $current_id=0;
        //print_r($tips_region_array);
		foreach ($tips_region_array as $key=>$tips_id){
			if(isset($tips_region_array[$key+1])){
				$current_id=$tips_region_array[$key+1];
			}
			//echo $tips_id.'__'.$current_id."<br/>";
			$this->tipstype_parent($tips_id,$current_id);//调用函数
			echo "<br/>";
			
		}
		
	}
	
	
	/**
	 * 根据父ID和当前ID输出select
	 *
	 * @param String $parent_id
	 * @param String $current_id
	 */
	private  function tipstype_parent($parent_id,$current_id){
		require_once __SITEROOT."library/Models/tips_type.php";//工作计划类型
		//echo $parent_id;
		$tips_type= new Ttips_type();
		$tips_type->whereAdd("tips_pid='{$parent_id}'");
		$count= $tips_type->count();
		$tips_type->find();
		if($count>0){
			echo "<select name=\"tips_type\">";
			echo "<option value=''>请选择</option>";
			$checked="";
			while ($tips_type->fetch()) {
	
				if($current_id==$tips_type->id){
					$checked="selected=\"selected\"";
				}
				echo "<option value='".$tips_type->id."' {$checked} >".$tips_type->tipszh_name."</option>";
				$checked="";
			}
			echo "</select>";
			
		}
		
	}
	
	/**
	 * 取得父id下面所有的信息
	 *
	 * @param String $parent_id
	 * @return arrray
	 */
	private function tips_of_parent($parent_id){
		require_once __SITEROOT."library/Models/tips_type.php";//工作计划类型
		$tips_type= new Ttips_type();
		$tips_type->whereAdd("tips_pid='{$parent_id}'");
		$tips_type->find();
		$tips_type_array=array();
		while ($tips_type->fetch()) {
			$tips_type_array[]=clone $tips_type;
		}
		return $tips_type_array;
	}
	/**
	 * 根据ID取得工作计划类型所有内容
	 *
	 * @param String $id
	 * @return object
	 */
	private function tips_of_current($id){
		require_once __SITEROOT."library/Models/tips_type.php";//工作计划类型
		$tips_type= new Ttips_type();
		$tips_type->whereAdd("id='{$id}'");
		$tips_type->find();
		$tips_type->fetch();
		return $tips_type;
	}

}