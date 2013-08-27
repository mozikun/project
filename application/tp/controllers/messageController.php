<?php
/*
 *@类		message
 *@功能		工作计划短信
 *万 20130408把短信发给个居民（以前王做的是发给医生）
 */
class tp_messageController extends controller{
	public function init(){
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT."library/Models/staff_archive.php";
		require_once __SITEROOT."library/Models/staff_core.php";
		require_once __SITEROOT."library/Models/tips.php";//工作计划
		require_once __SITEROOT."library/Models/tips_message.php";//工作计划短信
		require_once __SITEROOT."library/Models/individual_core.php";//个人档案
		require_once __SITEROOT."library/Models/organization.php";//机构表
		$this->view->basePath = $this->_request->getBasePath();
	}
	/*
     *@函数		sendAction
     *@功能		发送短信
     
     
     */
	public function sendAction(){
		$tips_ids=$this->_request->getParam("tips_ids");
		
		$tips_message=new Ttips_message();
		$num=0;//用于计算发送条数
		$tips_array=array();//发送成功tips的uuid
		$tips_uuid_json='';
		if(__SMS===true && !empty($tips_ids)){
			foreach($tips_ids as $k=>$v){
			    $tips=new Ttips();
				$staff_archive=new Tstaff_archive();
				//$tips_message=new Ttips_message();
				$individual_core=new Tindividual_core();
				
				//$staff_core->selectAdd("phone_number");
				$tips->whereAdd("tips.uuid='$v'");
				$tips->joinAdd('inner',$tips,$staff_archive,'staff_id','user_id');
				$tips->joinAdd('inner',$tips,$individual_core,'id','uuid');			
				$tips->find(true);
				$name			= $individual_core->name;//居民名			
				$doctor_name	= $staff_archive->name_real;//医生名
				$tips_date		= date("Y-m-d ",$tips->tips_time);//随访日期
				
				$tips_uuid		= str_replace('.','_',$tips->uuid);//字符串
				$org_id			= $individual_core->org_id;//机构号
				$org_obj		= $this->getOrgName($org_id);//医疗机构
				$org_name		= $org_obj->zh_name;
				
				
				$title			= $this->tips_of_current($tips->tips_type);//工作计划类型
				$phone_number	= $individual_core->phone_number;//居民手机号
				
				$sms_content	= $name.'你好，请于'.$tips_date.'上午9时，到'.$org_name.'进行'.$title;//短信内容
				$sms_date       = date("Y-m-d H:i:s");
				
				$uuid=uniqid('',true);
				require_once(__SITEROOT.'library/sms.php');//发短信库
				$sms=new SMS();
				$sms_status=$sms->sendSMS($uuid,$phone_number,$sms_content,$sms_date);//发送短信
				
				
				
				for($i=1;$i<7;$i++){
					//sleep($i);
					$sms_result_status=$sms->resultSMS($uuid,$phone_number);//短信返回结果
					if($sms_status && $sms_result_status){
						break;
					}
				}
				
				//var_dump($sms_result_status);
				if($sms_status && $sms_result_status){
					//array_push($tips_array,$tips_uuid);
					$tips_uuid_json='-'.$tips_uuid;
					$tips_message->uuid=$uuid;
					$tips_message->phone=$phone_number;
					$tips_message->created=strtotime($sms_date);
					$tips_message->tips_id=$v;
					$tips_message->staff_id=$tips->staff_id;				
					$tips_message->content=$sms_content;//发送内容
					$tips_message->org_id=$org_id;//机构号
					$tips_message->tips_type=$tips->tips_type;//类别代码
					
					if($tips_message->insert())
					{
						$num+=1;
					}
				}
	
				
				
			}
		}
		echo $num.'|'.$tips_uuid_json;
	}
	/*
     *@函数		listAction
     *@功能		短息列表
     */
   public function listAction(){
   		$search['start_time']=$this->_request->getParam("start_time");
   		$search['end_time']=$this->_request->getParam('end_time');
   		$this->view->start_time=$search['start_time'];
   		$this->view->end_time=$search['end_time'];
   		
		$tips_message=new Ttips_message();
		$staff_core=new Tstaff_core();
		$tips=new Ttips();
		$tips_message->joinAdd("inner",$tips_message,$staff_core,'staff_id','id');
		$tips_message->joinAdd("left",$tips_message,$tips,'tips_id','uuid');
		if($search['start_time'])
		{
			$start_time=strtotime($search['start_time']);
			$tips_message->whereAdd("tips_message.created>='$start_time'");
		}
		if($search['end_time'])
		{
			$end_time=strtotime($search['end_time']);
			$tips_message->whereAdd("tips_message.created<='$end_time'");
		}
		$nums = $tips_message->count();
        $page_size = 10;    //每页显示的条数
        $sub_pages = 8;          //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/page/', 2, $search);
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = __ROWSOFPAGE * ($pageCurrent - 1);  //计算开始记录数
        $tips_message->limit($startnum, __ROWSOFPAGE);
        $tips_message->orderby("tips_message.created DESC");
		$tips_message->find();
		$rows=array();
		$num=0;
		if($tips->count()>0)
		{
			while($tips_message->fetch()){
				$rows[$num]['title']=$tips->title;
				$rows[$num]['content']=$tips_message->content;
				$rows[$num]['staff']=$staff_core->name_login;
				$rows[$num]['created']=date("Y-m-d",$tips_message->created);
				$num++;
			}
		}
		$this->view->row = $rows;
        $this->view->record_count = $nums; //记录数
        $out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->pager= $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页
		$this->view->rows=$rows;
		$this->view->display("list.html");
		
	}
	
	/**
	 * 根据ID取得工作计划类型名
	 *
	 * @param String $id
	 * @return String
	 */
	private function tips_of_current($id){
		require_once __SITEROOT."library/Models/tips_type.php";//工作计划类型
		$tips_type= new Ttips_type();
		$tips_type->whereAdd("id='{$id}'");
		$tips_type->find();
		$tips_type->fetch();
		return $tips_type->tipszh_name;
	}
/**
 * 根据机构ID取得机构所有信息
 *
 * @param number $id
 * @return string
 */
 private  function getOrgName($id){
	require_once(__SITEROOT.'library/Models/organization.php');
	$organization=new Torganization();
	$organization->whereAdd("id={$id}");
	$organization->find();
	$organization->fetch();
	return $organization;
	
}
}
 
?>