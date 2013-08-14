<?php 
/*
* 公文管理
* 修改时间：2010-9-30
*/
class document_docController extends controller{
	/**
	 * 自动加载
	 */
	public function init(){
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT."library/Models/individual_core.php";
		//require_once(__SITEROOT.'library/Myauth.php');
		require_once(__SITEROOT.'library/Models/region.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once(__SITEROOT.'library/Models/staff_core.php');
		require_once(__SITEROOT.'library/Models/document_send.php');
		require_once(__SITEROOT.'library/Models/document_dest.php');
		$this->view->basePath = $this->_request->getBasePath();
	}
	public function sendAction(){
		//$string=$this->treeview('5','0,1,2,5');
		//var_dump($this->user);
		/*		region_id
		current_region_path*/
		$region_id=$this->user['region_id'];
		$current_region_path=$this->user['current_region_path'];
		$string=$this->treeview('2','0,1,2');
		//$string=$this->treeview($region_id,$current_region_path);
		//echo $string;
		$this->view->treeview=$string;
		$this->view->display("send.html");
	}
	public function treeviewsaveAction(){
		$region_string=$this->_request->getParam("region_string","");
		$org_string=$this->_request->getParam("org_string","");
		$region_string=rtrim($region_string,"|");
		$region_array=explode('|',$region_string);
		//var_dump($region_array);
		$region_result=array();
		$counter=count($region_array);
		for($i=0;$i<$counter;$i++){
			for($j=0;$j<$counter;$j++){
				if($region_array[$i]==''){
					continue;
				}
				if($region_array[$i]==$region_array[$j]){
					continue;
				}
				if(strpos($region_array[$i],$region_array[$j])!==false){
					$region_array[$i]='';
				}
			}
		}
		for($i=0;$i<$counter;$i++){
			if($region_array[$i]==''){
				continue;
			}
			$region_result[]=$region_array[$i];
		}
		$org_array=explode('|',$org_string);
		$org_result=array();
		$counter=count($org_array);
		for($i=0;$i<$counter;$i++){
			$temp_array=explode(',',$org_array[$i]);
			$org_id=$temp_array[0];
			if($org_id==''){
				continue;
			}
			$temp_counter=count($temp_array);
			$org_region_path='';
			for($j=1;$j<$temp_counter;$j++){
				$org_region_path=$org_region_path.$temp_array[$j].',';
			}
			$org_region_path=rtrim($org_region_path,",");
			$temp_counter=count($region_result);
			$in_region=false;
			for($k=0;$k<$temp_counter;$k++){
				if(strpos($org_region_path,$region_result[$k])!==false){
					$in_region=true;
				}
			}
			if(!$in_region){
				$org_result[]=$org_id;
			}
		}
		$send_id=uniqid("s_");
		$dest_file=__SITEROOT."upload/".$send_id;
		if(move_uploaded_file($_FILES['upload']['tmp_name'],$dest_file)){
		}else{
			echo "上传文件失败";
			exit();
		}
		$document_send=new Tdocument_send;
		$document_send->uuid=$send_id;
		$document_send->id=$send_id;
		$document_send->doc_name=$_FILES['upload']['name'];
		$document_send->doc_encode_name=$send_id;
		$document_send->doc_title=$this->_request->getParam("doc_title");
		$document_send->org_id=$this->user['org_id'];
		$document_send->staff_id=$this->user['uuid'];
		$document_send->send_date=time();
		$document_send->insert();

		foreach ($region_result as $key=>$value){
			$document_dest=new Tdocument_dest();
			$document_dest->uuid=uniqid();
			$document_dest->doc_id=$send_id;
			$document_dest->region_path=$value;
			$document_dest->org_id='';
			$document_dest->insert();
		}
		foreach ($org_result as $key=>$value){
			$document_dest=new Tdocument_dest();
			$document_dest->uuid=uniqid();
			$document_dest->doc_id=$send_id;
			$document_dest->region_path='';
			$document_dest->org_id=$value;
			$document_dest->insert();
		}


		/*		create table document_dest( uuid varchar2(30)  DEFAULT null ,PRIMARY KEY (uuid));
		alter table document_dest add doc_id varchar2(30);
		alter table document_dest add region_path varchar2(100);
		alter table document_dest add org_id number(22) DEFAULT null;	*/
		$url=__BASEPATH."document/doc/sendlist";
		$this->redirect($url);

		//var_dump($this->user);
	}
	public function sendlistAction(){
		require_once __SITEROOT."/library/custom/pager.php";
		$searchArr['title']=trim($this->_request->getParam('title'));
		$searchArr['staff_name']=trim($this->_request->getParam('staff_name'));
		$searchArr['org_name']=trim($this->_request->getParam('org_name'));
		$searchArr['start_time']=$this->_request->getParam('start_time');
		$searchArr['end_time']=$this->_request->getParam('end_time');
		$this->view->title=$searchArr['title'];
		$this->view->staff_name=$searchArr['staff_name'];
		$this->view->org_name=$searchArr['org_name'];
		$this->view->start_time=$searchArr['start_time'];
		$this->view->end_time=$searchArr['end_time'];
		
		$doc_send=new Tdocument_send();
		//$doc_dest=new Tdocument_dest();
		$staff=new Tstaff_core();
		$org=new Torganization();
		$doc_send->joinAdd("left",$doc_send,$staff,'staff_id','id');
		$doc_send->joinAdd("left",$doc_send,$org,"org_id","id");
		//$doc_send->joinAdd("left",$doc_send,$doc_dest,"id","doc_id");
		$doc_send->whereAdd("document_send.org_id='".$this->user['org_id']."'");
		if($searchArr['title'])
		{
			$title=$searchArr['title'];
			$doc_send->whereAdd("document_send.doc_title like '%".$title."%'");
		}
		if($searchArr['staff_name'])
		{
			$staff_name=$searchArr['staff_name'];
			$doc_send->whereAdd("staff_core.name_login like '%".$staff_name."%'");
		}
		if($searchArr['org_name'])
		{
			$org_name=$searchArr['org_name'];
			$doc_send->whereAdd("organization.zh_name like '%".$org_name."%'");
		}
		if($searchArr['start_time'])
		{
			$start_time=strtotime($searchArr['start_time']);
			$doc_send->whereAdd("document_send.send_date>='$start_time'");
		}
		if($searchArr['end_time'])
		{
			$end_time=strtotime($searchArr['end_time']);
			$doc_send->whereAdd("document_send.send_date<='$end_time'");
		}
		$nums=$doc_send->count();
		$pageCurrent=intval($this->_request->getParam('page'));
		$pageCurrent=$pageCurrent?$pageCurrent:1;
		$links=new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'document/doc/sendlist/page/',3,$searchArr);
		$pageCurrent=$links->check_page($pageCurrent);
		$startNum=__ROWSOFPAGE*($pageCurrent-1);
//		$doc_send->debugLevel(9);
		$doc_send->orderby('send_date desc');
		$doc_send->limit($startNum,__ROWSOFPAGE);
		$doc_send->find();
		$row=array();
		$counter=0;
		while ($doc_send->fetch()){
			$row[$counter]['doc_date']=date("Y-m-d H:i:s",$doc_send->send_date);
			$row[$counter]['org_name']=$org->zh_name;
//			$row[$counter]['staff_name']=$doc_send->staff_id;
			$row[$counter]['doc_title']=$doc_send->doc_title;
			$row[$counter]['staff_name']=$staff->name_login;
			$row[$counter]['read_time']=$doc_send->down_load_time;
			$row[$counter]['id']=$doc_send->id;
			$row[$counter]['down_load_time']=$doc_send->down_load_time;
			$row[$counter]['send_dest']=$this->getDest($doc_send->id);
			$counter++;
		}
		//var_dump($this->user);
		$pager=$links->subPageCss2();
		$this->view->page=$pageCurrent;
		$this->view->pager=$pager;
		$this->view->row=$row;
		$this->view->display("sendlist.html");
	}

	public function listreceiveAction(){
		$id=$this->_request->getParam('id');
		$doc_send=new Tdocument_send();
		$doc_send->whereAdd("id='$id'");
		$doc_send->find(true);
		$download_org_array=explode('|',$doc_send->down_load_org);
		$doc_dest=new Tdocument_dest();
		$doc_dest->whereAdd("doc_id='$id'");
		$doc_dest->find();
		$row=array();
		$counter=0;
		while ($doc_dest->fetch()){
			/*			echo $doc_dest->region_path;
			echo $doc_dest->org_id;
			echo "<br />";*/
			if($doc_dest->region_path!=''){
				$org=new Torganization();
				$org->whereAdd("region_path like '$doc_dest->region_path%'");
				$org->find();
				while ($org->fetch()){
					$row[$counter]['org_name']=$org->zh_name;
					$row[$counter]['receive']=in_array($org->id,$download_org_array)?'已收':"<font color='red'>待收</font>";
					$counter++;
				}
			}
			if($doc_dest->org_id!=''){
				$org=new Torganization();
				$org->whereAdd("id='".$doc_dest->org_id."'");
				$org->find(true);
				//$string=$string.'['.$org->zh_name.']';
				$row[$counter]['org_name']=$org->zh_name;
				$row[$counter]['receive']=in_array($org->id,$download_org_array)?'已收':"<font color='red'>待收</font>";
				$counter++;
			}
		}
		$this->view->row=$row;

//var_dump($row);

		$this->view->display("listreceive.html");
	}
	public function getDest($id){
		$doc_dest=new Tdocument_dest();
		$doc_dest->whereAdd("doc_id='$id'");
		$doc_dest->find();
		$string='';
		while ($doc_dest->fetch()){
			/*			echo $doc_dest->region_path;
			echo $doc_dest->org_id;
			echo "<br />";*/
			if($doc_dest->region_path!=''){
				$region=new Tregion();
				$region->whereAdd("region_path='".$doc_dest->region_path."'");
				$region->find(true);
				$string=$string.'['.$region->zh_name.']';
			}
			if($doc_dest->org_id!=''){
				$org=new Torganization();
				$org->whereAdd("id='".$doc_dest->org_id."'");
				$org->find(true);
				$string=$string.'['.$org->zh_name.']';
			}
		}
		//echo $string;
		return $string;
	}
	public function inboxAction(){
		require_once __SITEROOT."/library/custom/pager.php";
		$searchArr['title']=trim($this->_request->getParam('title'));
		$searchArr['staff_name']=trim($this->_request->getParam('staff_name'));
		$searchArr['org_name']=trim($this->_request->getParam('org_name'));
		$searchArr['start_time']=$this->_request->getParam('start_time');
		$searchArr['end_time']=$this->_request->getParam('end_time');
		$this->view->title=$searchArr['title'];
		$this->view->staff_name=$searchArr['staff_name'];
		$this->view->org_name=$searchArr['org_name'];
		$this->view->start_time=$searchArr['start_time'];
		$this->view->end_time=$searchArr['end_time'];
		
		$doc_dest=new Tdocument_dest();
		$doc_send=new Tdocument_send();
		$staff=new Tstaff_core();
		$org=new Torganization();
		$doc_dest->joinAdd("left",$doc_dest,$doc_send,"doc_id","id");
		$doc_dest->joinAdd("left",$doc_send,$staff,'document_send.staff_id','id');
		$doc_dest->joinAdd("left",$doc_send,$org,"org_id","id");
		//$doc_dest->whereAdd("document_send.org_id='".$this->user['org_id']."'");
		//$doc_dest->whereAdd("document_dest.region_path like '".$this->user['current_region_path']."%' or document_dest.org_id='".$this->user['org_id']."'");
		$doc_dest->whereAdd("INSTR('".$this->user['current_region_path']."',document_dest.region_path)>0 or document_dest.org_id='".$this->user['org_id']."'");
		//$individual_core_region_path_domain=$individual_core_region_path_domain."INSTR(individual_core.region_path,'".$v1."')>0 or ";

//		$serach=array();
		if($searchArr['title'])
		{
			$title=$searchArr['title'];
			$doc_dest->whereAdd("document_send.doc_title like '%".$title."%'");
		}
		if($searchArr['staff_name'])
		{
			$staff_name=$searchArr['staff_name'];
			$doc_dest->whereAdd("staff_core.name_login like '%".$staff_name."%'");
		}
		if($searchArr['org_name'])
		{
			$org_name=$searchArr['org_name'];
			$doc_dest->whereAdd("organization.zh_name like '%".$org_name."%'");
		}
		if($searchArr['start_time'])
		{
			$start_time=strtotime($searchArr['start_time']);
			$doc_dest->whereAdd("document_send.send_date>='$start_time'");
		}
		if($searchArr['end_time'])
		{
			$end_time=strtotime($searchArr['end_time']);
			$doc_dest->whereAdd("document_send.send_date<='$end_time'");
		}
		$nums=$doc_dest->count();
		$pageCurrent=intval($this->_request->getParam('page'));
		$pageCurrent=$pageCurrent?$pageCurrent:1;
		$links=new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'document/doc/inbox/page/',3,$searchArr);
		$pageCurrent=$links->check_page($pageCurrent);
		$startNum=__ROWSOFPAGE*($pageCurrent-1);
		$doc_dest->orderby('document_send.send_date desc');
		$doc_dest->limit($startNum,__ROWSOFPAGE);
		//$doc_dest->debugLevel(9);
		$doc_dest->find();
		$row=array();
		$counter=0;
		while ($doc_dest->fetch()){
			$row[$counter]['doc_date']=date("Y-m-d H:i:s",$doc_send->send_date);
			$row[$counter]['org_name']=$org->zh_name;
			//$row[$counter]['staff_name']=$doc_send->staff_id;
			$row[$counter]['doc_title']=$doc_send->doc_title;
			$row[$counter]['staff_name']=$staff->name_login;
			$row[$counter]['read_time']=$doc_send->down_load_time;
			$row[$counter]['id']=$doc_send->id;
			//$row[$counter]['down_load_time']=$doc_send->down_load_time;
			$download_org_array=explode('|',$doc_send->down_load_org);
			//var_dump($download_org_array);
			if(in_array($this->user['org_id'],$download_org_array)){
				$row[$counter]['down_load_org']='已处理';
			}else{
				$row[$counter]['down_load_org']="<font color='red'>未处理</font";
			}

			//$row[$counter]['down_load_org']=$doc_send->down_load_time;
			$counter++;
		}
		//var_dump($row);
		$pager=$links->subPageCss2();
		$this->view->page=$pageCurrent;
		$this->view->pager=$pager;
		$this->view->row=$row;
		$this->view->display("inbox.html");
	}
	public function deleteAction(){
		$id=$this->_request->getParam("id");
		if($id==''){
			echo "请正确删除文件&nbsp;<a href='javascript:window.history.go(-1)'>返回</a>";
			exit();
		}
		$doc_send=new Tdocument_send();
		$doc_send->whereAdd("id='$id'");
		$doc_send->find(true);
		if($doc_send->staff_id!=$this->user['uuid'] and $doc_send->org_id!=$this->user['org_id']){
			echo "不能删除此文件&nbsp;<a href='javascript:window.history.go(-1)'>返回</a>";
			exit();
		}
		$doc_send=new Tdocument_send();
		$doc_send->whereAdd("id='$id'");
		$doc_send->delete();
		$doc_dest=new Tdocument_dest();
		$doc_dest->whereAdd("doc_id='$id'");
		$doc_dest->delete();
		//删除文件
		$file_name=__SITEROOT."upload/".$id;
		unlink($file_name);

		$url=__BASEPATH."document/doc/sendlist";
		$this->redirect($url);


	}
	public function downloadAction()
	{
		$id=$this->_request->getParam("id");
		if($id==''){
			echo "请正确下载文件&nbsp;<a href='javascript:window.history.go(-1)'>返回</a>";
			exit();
		}
		$doc_send=new Tdocument_send();
		$doc_send->whereAdd("id='$id'");
		$doc_send->find(true);
		$download_time=$doc_send->down_load_time;
		$download_org=$doc_send->down_load_org;
		$download_org_array=explode("|",$doc_send->down_load_org);

		$fileName=__SITEROOT.'upload/'.$id;
		//$fileName=$path."/".$newsAttachement->fileName;
		//echo $file_name;
		if(@$fp=fopen($fileName,"rb")){

			Header("Content-type: application/x-octet-stream");
			//Header("Content-type: application/msword");
			Header("Accept-Ranges: bytes");
			Header("Accept-Length: ".filesize($fileName));
			Header("Content-Disposition: attachment; filename=".iconv('utf-8','gb2312',$doc_send->doc_name)); //用于xp
			//Header("Content-Disposition: attachment; filename=".$file_name);
			echo fread($fp,filesize($fileName));
			fclose($fp);
			if(!in_array($this->user['org_id'],$download_org_array)){
				if(trim($download_org)==''){
					$download_org=$this->user['org_id'];
				}else{
					$download_org=$download_org."|".$this->user['org_id'];
				}

			}
			//$download_org=rtrim($download_org,'|');
			$doc_send=new Tdocument_send();
			$doc_send->whereAdd("id='$id'");
			$doc_send->down_load_time=$download_time+1;
			$doc_send->down_load_org=$download_org;
			$doc_send->update();
		}else {
			header("Content-type: text/html; charset=utf-8");
			echo "对不起，文件[".$doc_send->doc_name."] 不存在！&nbsp;<a href='javascript:window.history.go(-1)'>返回</a>";
		}
	}


	private function treeview($p_id,$region_path){
		static $string='';
		//$string=$string."<div id='' style='border-left:solid 1px #FFF000;margin-left:15px;'>";

		//先处理本地区的直属机构
		if($string!=''){
			$org=new Torganization();
			$org->whereAdd("region_path='$region_path'");
			$org->find();
			//$temp=count(explode(',',$region_path));
			$div_name='div_'.$p_id;
			if(count(explode(',',$region_path))!=5){
				$string=$string."<div id='$div_name' style='border-left:solid 1px #CCC;margin-left:15px;'>";
			}else{
				$string=$string."<div id='$div_name' style='border-left:solid 1px #CCC;margin-left:15px;display:none'>";
			}

			while ($org->fetch()){
				//$temp1=str_repeat('&nbsp;&nbsp;',$temp);
				//$string=$string."<div id='' style='margin-left:10px;'>";
				$org_name='org_'.$org->id;
				$string=$string."<input type='checkbox' id='$org_name' name='$org_name' value='".$org->id.','.$org->region_path."' onclick=showSelect() check_box_inner_text='".$org->zh_name."' >".$org->zh_name.'<br />';
			}
		}else{
			$div_name='div_'.$p_id;
			if(count(explode(',',$region_path))!=5){
				$string=$string."<div id='$div_name' style='border-left:solid 1px #CCC;margin-left:15px;'>";
			}else{
				$string=$string."<div id='$div_name' style='border-left:solid 1px #CCC;margin-left:15px;display:none'>";
			}

		}
		//处理本地区的子地区
		$region=new Tregion();
		$region->whereAdd("p_id='$p_id'");
		$region->whereAdd("region_level<=6");
		if($region->count()<=0){
			$string=$string."</div>";
			return;
		}
		$region->orderby("id asc");
		$region->find();
		while ($region->fetch()){
			if($region->region_level<=5){
				//$string=$string."<a href='##' id='".$region->id."' onclick='expend(\'$region->id\')'>+</a>";
				$plus_name='plus_'.$region->id;
				$img_src=$this->_request->getBasePath()."views/images/treeview/plus.gif";
				$string=$string."<a class='treeview_a' href='##' id='".$plus_name."' onclick=\"expand('".$region->id."')\"><img src='$img_src' style='border:none' /></a>";
				$region_name='region_'.$region->id;
				$string=$string."<input type='checkbox' id='$region_name' name='$region_name' value='".$region->region_path."' onclick=showSelect()  check_box_inner_text='".$region->zh_name."' >".$region->zh_name.'<br />';
			}
			//$this->treeview($region->id,$region->region_path);
			if($region->region_level<=6){
				$this->treeview($region->id,$region->region_path);
			}

		}
		$string=$string."</div>";
		return $string;
	}
	public function setup(){
		/*
		create table document_send( uuid varchar2(30)  DEFAULT null ,PRIMARY KEY (uuid));
		alter table document_send add id varchar2(30);
		alter table document_send add staff_id varchar2(30);
		alter table document_send add org_id number(22) DEFAULT null;
		alter table document_send add send_date number(22)  DEFAULT null;
		alter table document_send add doc_title varchar2(100);
		alter table document_send add doc_encode_name varchar2(100);
		alter table document_send add doc_name varchar2(100);
		alter table document_send add down_load_time number(22);
		alter table document_send add down_load_org varchar2(4000);
		create index id on document_send(id);

		create table document_dest( uuid varchar2(30)  DEFAULT null ,PRIMARY KEY (uuid));
		alter table document_dest add doc_id varchar2(30);
		alter table document_dest add region_path varchar2(100);
		alter table document_dest add org_id number(22) DEFAULT null;
		create index region_path on document_dest(region_path);
		create index org_id on document_dest(org_id);
		*/
	}

}
?>