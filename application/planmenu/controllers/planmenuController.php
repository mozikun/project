<?php 
/**
 * created 2010.12.16
 * @author ct
 * 用于维护工作计划类型
 */
 class planmenu_planmenuController extends controller{
 	public function init(){
 		require_once __SITEROOT.'library/Models/tips_type.php';
 		require_once __SITEROOT.'library/privilege.php';
 		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
 		require_once __SITEROOT.'library/Models/organization.php';
 		require_once __SITEROOT.'application/planmenu/models/createarr.php';
 	}
    /**
     * 用于列表显示所有内容
     */
 	public function listAction(){
 		require_once __SITEROOT."/library/custom/pager.php";
 		$currentOrgId = $this->user['org_id'];
 		//var_dump($this->user);
 		$this->view->basePath = __BASEPATH;
        //查询数据库中是否存在记录,如果没有就直接插入一条数据作为当前所有节点的根
        $tips_type = new Ttips_type();
        $numCount = $tips_type->count();
        if($numCount>0){
        	//数据表中有根节点了现在开始列表数据
        	$parentid = trim($this->_request->getParam('parent_id'));
        	$realid   = empty($parentid)?'0':$parentid;
        	//统计当前类别的走势在顶部形成导航 便于操作所有数据
        	$nav = new Ttips_type();
        	$nav->whereAdd("id='$realid'");
        	$nav->find(true);
        	$getTipsRegion = $nav->tips_region;
        	$tipsRegionArr = explode(',',$getTipsRegion);
        	$rs = array();
		    $rsCount = 0 ;
        	//var_dump($tipsRegionArr);
        	foreach($tipsRegionArr as $k=>$v){
        		$realTips = new Ttips_type();
        		$realTips->whereAdd("id='$v'");
        		$realTips->find(true);
        		$rs[$rsCount]['tipszh_name'] =  $realTips->tipszh_name;
        		$rs[$rsCount]['id']          =  $realTips->id;
        		$rsCount++;
        	}
        	$this->view->rs = $rs;
        	//echo $realid;
        	$this->view->realid = $realid;
        	//开始分页显示注意参数的传递
        	$countTipsType = new Ttips_type();
        	$countTipsType->whereAdd("tips_pid='$realid'");
        	$subCount = $countTipsType->count();
        	$arrArg = array();
        	$pageCurrent = intval($this->_request->getParam('page'));
			$pageCurrent = $pageCurrent?$pageCurrent:1;
			//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
			$links = new SubPages(__ROWSOFPAGE,$subCount,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'planmenu/planmenu/list/parent_id/'.$realid.'/page/',3,$arrArg);
			$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
			$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
			$listTipsType = new Ttips_type();
			$listTipsType->whereAdd("tips_pid='$realid'");
			$listTipsType->orderby("id ASC");
			$listTipsType->limit($startnum,__ROWSOFPAGE);
			$listTipsType->find();
			$tipsCount = 0;
			$row = array();
			while($listTipsType->fetch()){
				$row[$tipsCount]['tipszh_name'] = $listTipsType->tipszh_name;
				$row[$tipsCount]['id']          = $listTipsType->id;
				$row[$tipsCount]['tips_pid']    = $listTipsType->tips_pid;
				$org = new Torganization();
				$org->whereAdd("id='$listTipsType->org_id'");
				$org->find(true);
				$strposResult = strpos($listTipsType->region_path,$this->user['current_region_path']);
				if($strposResult===false){
					$editStr = '<strong>您无权编辑<font style="color:red;">'.$org->zh_name.'</font>制定的类别</strong>';
					$delStr  = '<strong>您无权删除<font style="color:red;">'.$org->zh_name.'</font>制定的类别</strong>';
				}else{
					$editStr = "<a href=\"javascript:\" onclick=\"editmywindow('".$listTipsType->id."','".$listTipsType->tips_pid."');\">[编辑]</a>";
				    $delStr  = "<a href=".__BASEPATH."planmenu/planmenu/del/current_id/".$listTipsType->id." onclick=\"return confirm('您确定删除吗?确定');\">[删除该类别]</a>";
				}
				$row[$tipsCount]['edit']        =  $editStr;
				$row[$tipsCount]['del']         =  $delStr;
				$tipsCount++;
			}
			$this->view->pager    = $links->subPageCss2();
			$this->view->row      = $row;
        }else{
        //判断到数据库中没有值存在,插入一条数据当做根节点
            $time = time();
        	$parentNodecreated = adodb_mktime(0,0,0,adodb_date("n",$time),adodb_date("j",$time),adodb_date("Y",$time));
            $tips_type_add = new Ttips_type();
            $tips_type_add->uuid         = uniqid('t_');
            $tips_type_add->id           = '0';
        	$tips_type_add->tipszh_name  = '全部分类';
        	$tips_type_add->tips_pid     = '-1';
        	$tips_type_add->tips_region  = '0';
        	$tips_type_add->region_path  = '0';
        	$tips_type_add->created      = $parentNodecreated;
        	$tips_type_add->org_id       = '1';
        	$tips_type_add->doctor_id    = '1';
        	$tips_type_add->tips_level   = '0';
        	$tips_type_add->role_en_name = 'mytop';
        	if($tips_type_add->insert()){
        		$this->redirect(__BASEPATH.'planmenu/planmenu/list');
        	}else{
        		throw new Exception("数据表写入失败!");
        	}
        }
 		$this->view->display('list.html');
 	}
 	/**
 	 * 用于添加计划工作名称
 	 */
 	public function  displayaddAction(){
 		$time = time();
 		$currentRegionPath = $this->user['current_region_path'];
 		$currentOrgId      = $this->user['org_id'];
 		$currentDoctorId   = $this->user['uuid'];
 		$currentuuid       = uniqid('t_');
 		$currentTime       = adodb_mktime(0,0,0,adodb_date("n",$time),adodb_date("j",$time),adodb_date("Y",$time));
 		$this->view->basePath = __BASEPATH;
 		$pid     = intval($this->_request->getParam('id'));
 		$ajaxpid = intval($this->_request->getParam('p_id'));
 		$zh_name = $this->_request->getParam('zh_name');
 		//获取上一级的名称
 		$myZhName = new Ttips_type();
 		$myZhName->whereAdd("id='$pid'");
 		$myZhName->find(true);
 		$this->view->tipszh_name = $myZhName->tipszh_name;
 		$this->view->pid   = $pid;
 	    //获取数据表中的最大 ID号
 	    $tips_type = new Ttips_type();
 	    $tips_type->orderby('id DESC');
 	    $tips_type->limit(0,1);
 	    $tips_type->find(true);
 	    $maxid = $tips_type->id;
 	    //数据表中新的记录的ID号
 	    $thenextid = intval($maxid+1);
 		//获取上一级所需要的数据,为下一级的数据做准备
 			//echo $pid;
 	    if(isset($pid)){
	 		$lasttipstype = new Ttips_type();
	 		$lasttipstype->whereAdd("id='$ajaxpid'");
	 		$lasttipstype->find(true);
	 	    //拼凑下一级的path
	 	    //$lasttipstype->tips_region;
	 	    $tipsRegion              = $lasttipstype->tips_region.','.$thenextid;
	 	    //$str = '1,2,3,4,5,6' ; 
	 	    $currentlevel            = substr_count($tipsRegion,',');
	 	    //开始写入数据
	 	    $tipsTypeAdd               = new Ttips_type();
	 	    $tipsTypeAdd->uuid         = uniqid('t_');
	 	    $tipsTypeAdd->id           = $thenextid;
	 	    $tipsTypeAdd->tipszh_name  = $zh_name;
	 	    $tipsTypeAdd->tips_pid     = $lasttipstype->id;
	 	    $tipsTypeAdd->tips_region  = $tipsRegion;
	 	    $tipsTypeAdd->tips_level   = $currentlevel;
	 	    $tipsTypeAdd->created      = $currentTime;
	 	    $tipsTypeAdd->region_path  = $currentRegionPath;
	 	    $tipsTypeAdd->org_id       = $currentOrgId;
	 	    $tipsTypeAdd->doctor_id    = $currentDoctorId;
	 	    $tipsTypeAdd->role_en_name = $this->user['role_en_name'];
	 	    if($zh_name){
	 	       $tipsTypeAdd->insert();
	 	       //生成一个数组,先生成一个文件值生成bureau_admin,admin的内容
	 	       if($this->user['role_en_name']=='bureau_admin'||$this->user['role_en_name']=='admin'){
	 	            createFolder('library/planmenu');
	 	            createFile('library/planmenu','plan_array','Ttips_type');
	 	       }
	 	      }
 	    }else{
 	    	throw new Exception("参数出现错误！");
 	    }
 	      //echo $message;
 		$this->view->display('displayadd.html');
 	}
     /**
 	 * 用于编辑计划工作名称
 	 */
 	function displayeditAction(){
 		$this->view->basePath = __BASEPATH;
 		$editid     = $this->_request->getParam('editid');
 		$pid        = $this->_request->getParam('pid');
 		//Ajax传递过来的值
 		$currentpid    = $this->_request->getParam('p_id');
 		$currentid     = $this->_request->getParam('id');
 		$currentZhname = $this->_request->getParam('zh_name');
 		$editTipsType = new Ttips_type();
 		$editTipsType->whereAdd("id='$editid'");
 		$editTipsType->find(true);
 		$this->view->currentzhname = $editTipsType->tipszh_name;
 		$this->view->currentpid    = $pid;
 		$this->view->currenteditid = $editid;
 		//echo $editid;
 		$this->view->display('display.html');
 	}
 	/**
 	 * 获取值过后形成的结果
 	 */
 	public function myresultAction(){                         
 		//Ajax传递过来的值
 		$currentpid    = $this->_request->getParam('p_id');
 		$currentid     = $this->_request->getParam('id');
 		$currentZhname = $this->_request->getParam('zh_name');
 	if($currentid){
 		//通过ajax传递过来的pid
 		$newTipstype = new Ttips_type();
 		$newTipstype->whereAdd("id='$currentpid'");
 		$newTipstype->find(true);
 		$newRegion   = $newTipstype->tips_region;
 		//获取传递过来的ID（没有更新过的原始数据）
 		$ajaxTips = new Ttips_type();
 		$ajaxTips->whereAdd("id='$currentid'");
 		$ajaxTips->find(true);
 		//echo $newRegion.'/'.$ajaxTips->tips_region;
 		
 		$pos = strpos($newRegion,$ajaxTips->tips_region);
 		//处理path保证不会移动到他本身和他的子类下边
 		if($pos===false){
 			$realTipsType = new Ttips_type();
 			$realTipsType->whereAdd("id='$currentid'");
 			//获取修改的数据
 			$realTipsType->tips_pid     = $currentpid;
 			$realTipsType->tips_region  = $newRegion.','.$currentid;
 			$realTipsType->tips_level   = substr_count($newRegion.','.$currentid,',');
 			$realTipsType->tipszh_name  = $currentZhname;
 			if($realTipsType->update()){
 				//更新过后的数据
 				$newtype = new Ttips_type();
 				$newtype->whereAdd("id='$currentid'");
 				$newtype->find(true);
 				//echo $ajaxTips->tips_region.'/'.$newtype->tips_region;
 				if($ajaxTips->tips_region!=$newtype->tips_region){
 				//获取当前已经修改过了的path	
	 				$anotherRegion = new Ttips_type();
	 				$anotherRegion->whereAdd("id!='$currentid'");
	 				$anotherRegion->whereAdd("tips_region like '$ajaxTips->tips_region%'");
	 				$anotherRegion->find();
	 				while ($anotherRegion->fetch()){
	 					//开始修改当前Id的内容
	 					$realOtherRegion = $newtype->tips_region.','.substr($anotherRegion->tips_region,strlen($ajaxTips->tips_region)+1);
	 					$realLevel       = substr_count($realOtherRegion,',');
	 					$updateTips = new Ttips_type();
	 					$updateTips->whereAdd("id='$anotherRegion->id'");
	 					$updateTips->tips_region   = $realOtherRegion;
	 					$updateTips->tips_level    = $realLevel;
	 					$updateTips->update();
	 				}
 			     }
 			    //if($this->user['role_en_name']=='bureau_admin'||$this->user['role_en_name']=='admin'){
	 	            createFolder('library/planmenu');
	 	            createFile('library/planmenu','plan_array','Ttips_type');
	 	         //}
 			     $message = '您的修改成功！';
 			}else{
 				$message = '您的修改失败！';
 			 }
 		   }else{
			$message='不能把分类项目移动到自身及其以下分类';
 		}
 		echo $message;
 		}
 	}
 	/**
 	 * 用于将ajax的数据形成下拉列表
 	 */
 	function ajaxresultAction(){
 		$pid = $this->_request->getParam('p_id');
 		$id  = $this->_request->getParam('id');
 		//首先查找数据表中当前ID的path
 		$tips_type = new Ttips_type();
 		$tips_type->whereAdd("id='$pid'");
 		$tips_type->find(true);
 		$regionArr = explode(',',$tips_type->tips_region);
 		$count = count($regionArr);
 		$seleStr='';
 		$seleStr.="<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)' disabled>";
 		$seleStr.='<option value="0">全部分类</option>';
 		$seleStr.='</select>';
	 		for($i=0;$i<$count;$i++){
	 			$myTips = new Ttips_type();
	 			$myTips->whereAdd("tips_pid = '$regionArr[$i]'");
		 		if($myTips->count('*')<=0){
					continue;
				}
	 			$myTips->select();
		 	    $seleStr.="<select onclick='oldValue=this.value' onchange='changeValue(this,oldValue,this.value)'>";
		 		$seleStr.="<option value='-9|".$regionArr[$i]."'>请选择...</option>";   
	 			
	 			while($myTips->fetch()){
	 				if(in_array($myTips->id,$regionArr)){
	 					$seleStr.='<option value="'.$myTips->id.'" selected>'.$myTips->tipszh_name.'</option>';
	 				}else{
	 				   $seleStr.='<option value="'.$myTips->id.'">'.$myTips->tipszh_name.'</option>';
	 				}
	 			}
	 			$seleStr.="</select>";
	 		}
 		echo $seleStr;
 	}
 	/**
 	 * 用于删除当前类别和他下边的子类
 	 */
 	function delAction(){
 		$delId = $this->_request->getParam('current_id');
 		if(isset($delId)){
 			$delTips = new Ttips_type();
 			$delTips->whereAdd("id='$delId'");
 			$delTips->find(true);
 			$currentPath = $delTips->tips_region;
 			$anotherDel  = new Ttips_type();
 			$anotherDel->whereAdd("tips_region like '$currentPath%'");
 			$count = $anotherDel->count();
 			//echo $count;
 			if($count>1){
			    echo '<script type="text/javascript">window.alert("当前类别下已经有了子类，不能删除");history.go(-1);</script>';
 			}else{
 				$loneDel = new Ttips_type();
 				$loneDel->whereAdd("id='$delId'");
 				if($loneDel->delete()){
 			     //if($this->user['role_en_name']=='bureau_admin'||$this->user['role_en_name']=='admin'){
	 	            createFile('library/planmenu','plan_array','Ttips_type');
	 	         //}
 					echo '<script type="text/javascript">window.alert("该类别已经删除");history.go(-1);</script>';
 				}
 			}
 		}
 	}
 }
?>