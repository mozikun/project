<?php

/*安卓在线交流
 * author whx
 * time 2013-3-26
 */
class android_chatController extends controller{
	public function init(){
		require_once(__SITEROOT."library/Models/organization.php");
		require_once(__SITEROOT."library/Models/staff_core.php");
		require_once(__SITEROOT."library/Models/staff_archive.php");
		require_once(__SITEROOT."library/Models/chat.php");
		require_once(__SITEROOT."library/Models/organization.php");
		require_once(__SITEROOT."library/Models/individual_core.php");
		$this->view->basePath = $this->_request->getBasePath();
		
		//判断登陆状态
		$mobile=new Zend_Session_Namespace("mobile");
		if(!empty($mobile->identity_number)){
			$this->view->login=1;
		}
		
	}
	
	 
	//聊天窗口
	public function chatAction(){
	
		$receiver_id=$this->_request->getParam("receiver_id");
		/*
		//$mobile=new Zend_Session_Namespace("mobile");
		//$identity_number=$mobile->identity_number;
		//$doctor_id=$mobile->doctor_id;
		
		//取得聊天标题
		$title="";
		if($doctor_id){
			$individual_core=new Tindividual_core();
			$individual_core->whereAdd("identity_number='$receiver_id'");
			$individual_core->find(true);
			$name=$individual_core->name;
			$title="正在和居民[$name]聊天";
			$this->view->sender_id=$doctor_id;
		}
		if($identity_number){
			$staff_core=new Tstaff_core();
			$staff_core->whereAdd("id='$receiver_id'");
			$staff_core->find(true);
			$name=$staff_core->name_login;
			$title="正在和[$name]聊天";
			$this->view->sender_id=$identity_number;
		}
		if(!$doctor_id&&!$identity_number){
			$this->redirect(__BASEPATH.'android/user/login');
		}
		$this->view->title=$title;
		*/
		$this->view->receiver_id=$receiver_id;
		$this->view->display("chat.html");
		
	}
	//发送消息
	public function sendAction(){
		$content=$this->_request->getParam("send_content");
		$receiver_id=$this->_request->getParam("receiver_id");
		//$sender_id=$this->_request->getParam("sender_id");
		
		$mobile=new Zend_Session_Namespace("mobile");
		$identity_number=$mobile->identity_number;
		//$doctor_id=$mobile->doctor_id;
		//去这个两人聊天记录的最大排序
		$chat=new Tchat();
		//$chat->whereAdd("(receiver='$receiver_id' and sender='$sender_id') or (receiver='$sender_id' and sender='$receiver_id')");
		$chat->orderby("order_id desc");
		$chat->find(true);
	    $order_max=$chat->order_id;
		$chat=new Tchat();
		if(!empty($identity_number)){
			
			$chat->sender=$identity_number;
			
		}
		
		$chat->uuid=uniqid();
		$chat->receiver=$receiver_id;
		$chat->sender=$identity_number;
		$chat->sendtime=time();
		$chat->r_flag='0';
		$chat->content=$content;
		$chat->order_id=$order_max+1;
		$chat->insert();
		
	}
	
	//刷新聊天信息
	public function getinfoAction(){
		$doctor_id=$this->_request->getParam("receiver_id");
		
		$mobile=new Zend_Session_Namespace("mobile");
		$sender_id=$mobile->identity_number;

		$chat=new Tchat();
		$staff_core=new Tstaff_core();
		$individual_core=new Tindividual_core();
		$chat->whereAdd("((chat.receiver='$sender_id' and chat.sender='$doctor_id'))and chat.r_flag=0");
		$chat->orderby("order_id");
		$chat->joinAdd("left",$chat,$individual_core,"sender","identity_number");
		$chat->joinAdd("left",$chat,$staff_core,"sender","id");
		$r_flag=new Tchat();
		$chat->find();
		$result=array();
		$i=0;
        while($chat->fetch()){
		
			/*
			//判断该消息是不是自己发的，已选择对应的样式
			//自己发的
			if($receiver_id==$chat->receiver)
			$class="systemitem";
			else
			$class="chatitem";
			$str.="<div class='$class'>[".$staff_core->name_login.$individual_core->name."]<span class='time_tag'><font>".date("Y-m-d H:i:s",$chat->sendtime)."</font></span><br><span>".$chat->content."</span></div>";
			*/
			//将本条信息的r_flag设置为1 也就是标记为已读
			$r_flag->where("uuid='$chat->uuid'");
			$r_flag->r_flag=1;
			$r_flag->update();
			
			$result[$i]['name']=$staff_core->name_login;
			$result[$i]['content']=$chat->content;
			$result[$i]['sendtime']=date("Y-m-d H:i:s",$chat->sendtime);
			$i++;
		}
		//print_r($result);
		echo json_encode($result);
		//echo 12121212;
	}
	//医生在线交流主页
	public function doctorhomeAction(){
		$this->view->display("chat.html");
	}
	
	
}
?>