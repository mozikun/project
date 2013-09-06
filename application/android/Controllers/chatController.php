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
		require_once(__SITEROOT."library/Models/region.php");
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
		$isdoctor=$this->_request->getParam("isdoctor");
		
		
		//取得聊天标题，不确定是医生还是患者，在两张表中都查找，在那张表中找到就是哪个角色
		$title="";
		$str="";	
			$individual_core=new Tindividual_core();
			$region=new Tregion();
			$individual_core->whereAdd("identity_number='$receiver_id'");
			if($individual_core->count()>0){
				$individual_core->find(true);
				$name=$individual_core->name;
				$region_array=explode(",", $individual_core->region_path);
				for($i=3;$i<count($region_array);$i++){
					$region->where("id='$region_array[$i]'");
					$region->find(true);
					$str.=$region->zh_name;
				}
				$title="正在和".$str."的居民【".$name."】交流";
			}

			$staff_core=new Tstaff_core();
			$staff_core->whereAdd("id='$receiver_id'");
			if($staff_core->count()>0){
				$staff_core->find(true);
				$name=$staff_core->name_login;
				$title="正在和医生【".$name."】交流";
			}
		
	
		$this->view->title=$title;
		
		
		
		$this->view->isdoctor=$isdoctor;
		$this->view->receiver_id=$receiver_id;
		$this->view->display("chat.html");
		
	}
	//发送消息
	public function sendAction(){
		
		$content=$this->_request->getParam("send_content");
		$receiver_id=$this->_request->getParam("receiver_id");
		$isdoctor=$this->_request->getParam("isdoctor");
		
		
		$mobile=new Zend_Session_Namespace("mobile");
		$identity_number=$mobile->identity_number;
		$auth=new Zend_Session_Namespace("Zend_Auth");
		$doctor_id=$auth->storage['uuid'];
		//$doctor_id=$mobile->doctor_id;
		//去这个两人聊天记录的最大排序
		$chat=new Tchat();
		//$chat->whereAdd("(receiver='$receiver_id' and sender='$sender_id') or (receiver='$sender_id' and sender='$receiver_id')");
		$chat->orderby("order_id desc");
		$chat->find(true);
	    $order_max=$chat->order_id;
		$chat=new Tchat();
		if($isdoctor==1){
			$chat->sender=$doctor_id;
		}else{
			$chat->sender=$identity_number;
		}
		
		$chat->uuid=uniqid();
		$chat->receiver=$receiver_id;
		//$chat->sender=$identity_number;
		$chat->sendtime=time();
		$chat->r_flag='0';
		$chat->content=$content;
		$chat->order_id=$order_max+1;
		$chat->insert();
		
	}
	
	//聊天窗口刷新发来的信息
	public function getinfoAction(){ 
	//print_r($_GET);
		$receiver_id=$this->_request->getParam("receiver_id");
		
		$isdoctor=$this->_request->getParam("isdoctor");
		
		$mobile=new Zend_Session_Namespace("mobile");
		$identity_number=$mobile->identity_number;
		$auth=new Zend_Session_Namespace("Zend_Auth");
		$doctor_id=$auth->storage['uuid'];
		if($isdoctor==1){
			$sender_id=$doctor_id;
		}else{
			$sender_id=$identity_number;
		}
		$chat=new Tchat();
		$staff_core=new Tstaff_core();
		$individual_core=new Tindividual_core();
		$chat->whereAdd("chat.receiver='$sender_id' and chat.sender='$receiver_id' and chat.r_flag=0");
		$chat->orderby("order_id");
		if($isdoctor==1){
		
			$chat->joinAdd("inner",$chat,$individual_core,"sender","identity_number");
		}
		else{
			$chat->joinAdd("inner",$chat,$staff_core,"sender","id");
		}
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
			if($isdoctor==1){
				
				$result[$i]['name']=$individual_core->name;
			}else{
				$result[$i]['name']=$staff_core->name_login;
			}
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
		$auth=new Zend_Session_Namespace("Zend_Auth");
		$doctor_id=$auth->storage['uuid'];
		$chat=new Tchat();
		$individual_core=new Tindividual_core();
		//$chat->joinAdd("inner",$chat,$indivadual_core,"sender","identity_number");
		$chat->query("select count(sender) as c,sender from chat where receiver='4c73332777df2' and r_flag=0 group by sender");
		//$chat->debug(1);
		$result=array();
		$i=0;
		while($chat->fetch()){
			$individual_core->where("identity_number='$chat->sender'");
			$individual_core->find(true);
			$result[$i]['name']=$individual_core->name;
			$result[$i]['identity_number']=$chat->sender;
			$result[$i]['count']=$chat->c;
			$i++;
			
		}
		$this->view->result=$result;
		$this->view->display("doctorhome.html");
	}
	//获取患者发来的消息列表
	public function getuserinfoAction(){
		$auth=new Zend_Session_Namespace("Zend_Auth");
		$doctor_id=$auth->storage['uuid'];
		$chat=new Tchat();
		$individual_core=new Tindividual_core();
		//$chat->joinAdd("inner",$chat,$indivadual_core,"sender","identity_number");
		$chat->query("select count(sender) as c,sender from chat where receiver='$doctor_id' and r_flag=0 group by sender");
		//$chat->debug(1);
		$result=array();
		$i=0;
		while($chat->fetch()){
			$individual_core->where("identity_number='$chat->sender'");
			$individual_core->find(true);
			$result[$i]['name']=$individual_core->name;
			$result[$i]['identity_number']=$chat->sender;
			$result[$i]['count']=$chat->c;
			$i++;
			
		}
		echo json_encode($result);	
	}
}
?>