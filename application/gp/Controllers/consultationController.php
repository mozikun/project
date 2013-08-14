<?php 
/**
 * 
 *  @author ct
 *  会诊记录
 */
class  gp_consultationController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'/library/Models/consultation_table.php';
		require_once __SITEROOT.'library/Models/individual_core.php';
		require_once __SITEROOT.'library/Models/staff_core.php';
		require_once __SITEROOT.'library/Models/organization.php';
	}
/**
 * 添加和编辑会诊记录表
 */
	public function indexAction(){
		$individual_session=new Zend_Session_Namespace("individual_core");
		//表单中是否有当前ID
		$editid = $this->_request->getParam('editid');
		if(empty($editid)){
			if(empty($individual_session->uuid)){

				message("请在个人档案列表双击选中居民",array("进入个人档案列表"=>__BASEPATH.'iha/index/index'));
			}
			//添加的时候显示的编号和名字
			$this->view->user_name     = $individual_session->name;//居民姓名
		    $this->view->standard_code = $individual_session->standard_code_1;//标准档案号
		    $orgnameArr                = $this->_request->getParam('orgname');
		    $doctorConsultation        = $this->_request->getParam('doctor_consultation');
		    //var_dump($orgnameArr);
		    //表单中的个人编号赋值
		    $this->view->iha_id = $individual_session->uuid;
		    $currentval = '';
		    if($this->_request->getParam('ok')){
		    	//获取每个输入框   医生和医疗机构的数据
		    	//var_dump($currentval).'</br>';
		           foreach($doctorConsultation as $k=>$v){
		        	         $currentval.= $v.',';
		        	         if(($k+1)%4==0){
		        	         	$currentval = rtrim($currentval,',');
		        	         	$currentval.='|';
		        	         }
		        	} 
		        $realval = rtrim($currentval,'|');
		      //判断是否输入相同机构
		        $pdequid = '';
		        foreach($doctorConsultation as $k=>$v){
		        	if($k%4==0){
		        		$pdequid.=$v.',';
		        	}
		        }
		        $oldArr    = explode(',',rtrim($pdequid,','));
		        $oldNumber = count($oldArr);
		        $eqArr     = array_unique($oldArr);
		        $newNumber = count($eqArr);
		        if($oldNumber!==$newNumber){
		        	echo '<script type="text/javascript">window.alert("请选择不同的机构！");history.go(-1);</script>';
		        	exit();
		        }
		       // var_dump($realval);
		        //会诊原因数据
		        $consultation_reason  = $this->_request->getParam('consultation_reason');
		        //会诊意见数据
		        $consultation_subject = $this->_request->getParam('consultation_subject');
		        //责任医生签字
		        $doctorname           = $this->_request->getParam('doctor_responsibilities');
		        //处理日期数据
		        $year                 = $this->_request->getParam('year');
		        $month                = $this->_request->getParam('month');
		        $day                  = $this->_request->getParam('day');
		        if($year&&$month&&$day){
		            $realdate         = strtotime($year.'-'.$month.'-'.$day);
		        }else{
		        	$realdate         = time();
		        }
		        //将所有数据写入会诊记录表中
		        $consultation                      = new Tconsultation_table();
		        $consultation->uuid                = uniqid();
		        $consultation->id                  = $individual_session->uuid;
		        $consultation->consultation_reason = $consultation_reason;
		        $consultation->consultation_subject= $consultation_subject;
		        $consultation->all_org             = $realval;
		        $consultation->staff_id            = $doctorname;
		        $consultation->created             = $realdate;
		        if($consultation->insert()){
		        	message("添加会诊记录成功",array("返回会诊记录列表"=>__BASEPATH.'gp/consultation/list'));
		        }
		      }
		}else{
			//编辑数据内容
			 $currentpage = intval($this->_request->getParam('page'));
			 $consultationedit  = new Tconsultation_table();
			 $individualcore    = new Tindividual_core();
			 $consultationedit->joinAdd("inner",$consultationedit,$individualcore,"id","uuid");
			 $consultationedit->whereAdd("consultation_table.uuid='$editid'");
			 $consultationedit->find(true);
			 $this->view->user_name            = $individualcore->name;//居民姓名
		     $this->view->standard_code        = $individualcore->standard_code_1;//标准档案号
		     $this->view->consultation_reason  = $consultationedit->consultation_reason;//会诊原因
		     $this->view->consultation_subject = $consultationedit->consultation_subject;//会诊意见
		     $this->view->current_doctor       = $consultationedit->staff_id;//责任医生
		     $this->view->all_org              = $consultationedit->all_org;//所有医生和机构
		     //处理所有的医生和机构
		     $allOrg = explode('|',$consultationedit->all_org);
		     $j = 0;
		     $allOrgArr = array();
		     foreach ($allOrg as $k=>$v){
		     	$currentOrg = explode(',',$v);
		     	$orgId      = $currentOrg[0];
		     	$organization = new Torganization();
		     	$organization->whereAdd("id='$orgId'");
		     	$organization->find(true);
		     	$allOrgArr[$j]['org_name']     = $organization->zh_name;
		     	$allOrgArr[$j]['doctor_one']   = $currentOrg[1];
		     	$allOrgArr[$j]['doctor_two']   = $currentOrg[2];
		     	$allOrgArr[$j]['doctor_three'] = $currentOrg[3]; 
		     	$allOrgArr[$j]['orgid']        = $orgId;	
		     	$allOrgArr[$j]['all_org']      = $consultationedit->all_org;
		     	$j++;
		     }
		     $this->view->allOrgArr  = $allOrgArr;
		     //构造多余的输入框总共构造5个
		     $countNumber = count($allOrg);
		     $this->view->needNumber  = $countNumber;
		     //处理日期
		     $currentdate = explode('-',adodb_date('Y-m-d',$consultationedit->created));
			 $this->view->year             = $currentdate[0];
		     $this->view->month            = $currentdate[1];
		     $this->view->day              = $currentdate[2];
		     if($this->_request->getParam('ok')){
		     //获取表单中的会诊原因数据
		      $consultation_reason  = $this->_request->getParam('consultation_reason');
		     //获取表单中的会诊意见数据
		     $consultation_subject = $this->_request->getParam('consultation_subject');
		     //获取表单中的责任医生签字
		     $doctorname           = $this->_request->getParam('doctor_responsibilities');
		     //获取表单中的处理日期数据
		     $year                 = $this->_request->getParam('year');
		     $month                = $this->_request->getParam('month');
		     $day                  = $this->_request->getParam('day');
		     $realdate             = strtotime($year.'-'.$month.'-'.$day);
		     $doctorConsultation   = $this->_request->getParam('doctor_consultation');
		     //处理所有的AJAx后医生和机构
		     $currentval='';
		     foreach($doctorConsultation as $k=>$v){
		        	         $currentval.= $v.',';
		        	         if(($k+1)%4==0){
		        	         	$currentval = rtrim($currentval,',');
		        	         	$currentval.='|';
		        	         }
		        	} 
		     //判断是否输入相同机构
		       $pdequid = '';
		       foreach($doctorConsultation as $k=>$v){
		        	if($k%4==0){
		        		$pdequid.=$v.',';
		        	}
		        }
		        $oldArr    = explode(',',rtrim($pdequid,','));
		        $oldNumber = count($oldArr);
		        $eqArr     = array_unique($oldArr);
		        $newNumber = count($eqArr);
		        if($oldNumber!==$newNumber){
		        	echo '<script type="text/javascript">window.alert("请选择不同的机构！");history.go(-1);</script>';
		        	exit();
		        }
		      //处理后要写入表中的医生和机构字符串
		     $realvaledit = rtrim($currentval,'|');
		     //开始写入会诊记录表
		     $consultationedit = new Tconsultation_table();
		     $consultationedit->whereAdd("uuid='$editid'");
		     $consultationedit->consultation_reason   = $consultation_reason;
		     $consultationedit->consultation_subject  = $consultation_subject;
		     $consultationedit->all_org               = $realvaledit;
		     $consultationedit->staff_id              = $doctorname;
		     $consultationedit->created               = $realdate;
		     if($consultationedit->update()){
		     		message("编辑会诊记录成功",array("返回会诊记录列表"=>__BASEPATH.'gp/consultation/list/page/'.$currentpage));
		     	}
		     }  
		}
		$this->view->basePath = $this->_request->getBasePath();
		$this->view->tagid    = $editid;
	    $this->view->doctor = region_users($this->user['current_region_path_domain']);//来自文件comm_function.php的 //来自文件region_users函数
		$this->view->display('index.html');
	}
	/**
	 * 列表显示会诊记录表
	 */
    public function listAction(){
		require_once __SITEROOT."/library/custom/pager.php";
		$this->view->basePath = $this->_request->getBasePath();
		$realname             = urldecode(trim($this->_request->getParam('realname')));
		$nowdate              = strtotime(trim($this->_request->getParam('nowdate')));
		//var_dump($nowdate);
		$search               = $this->_request->getParam('search');
		$consultation  = new Tconsultation_table();
		$individual    = new Tindividual_core();
		$staff         = new Tstaff_core();
		$consultation->joinAdd('inner',$consultation,$individual,'id','uuid');
		$consultation->joinAdd('inner',$consultation,$staff,'staff_id','id');
		if($search){
	        if(!empty($realname)){
					 $consultation->whereAdd("individual_core.name='$realname'");	
				}
			if(!empty($nowdate)){
					 $consultation->whereAdd("consultation_table.created='$nowdate'");
				}
		}
		$consultation->find();
		$arrArg = array();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$consultation->count(),$pageCurrent,__goodsListRowOfPage,__BASEPATH.'gp/consultation/list/realname/'.urlencode($realname).'/nowdate/'.$this->_request->getParam('nowdate').'/page/',3,$arrArg);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
	    if($consultation->count()>0){
	    	$consultationlist   = new Tconsultation_table();
			$individualcore     = new Tindividual_core();
			$staff_core         = new Tstaff_core();
			$consultationlist->joinAdd('inner',$consultationlist,$individualcore,'id','uuid');
			$consultationlist->joinAdd('inner',$consultationlist,$staff_core,'staff_id','id');
			if($search){
			    if(!empty($realname)){
						 $consultationlist->whereAdd("individual_core.name='$realname'");	
					}
				if(!empty($nowdate)){
						 $consultationlist->whereAdd("consultation_table.created='$nowdate'");
					}
			}
			$consultationlist->orderby("individual_core.name DESC");
			$consultationlist->limit($startnum,__ROWSOFPAGE);
			$consultationlist->find();
			$consultationlistarr   = array();
			$consultationlistcount = 0 ;
			while($consultationlist->fetch()){
				$consultationlistarr[$consultationlistcount]['name']          = $individualcore->name;
				$consultationlistarr[$consultationlistcount]['iha_id']        = $consultationlist->id;
				$consultationlistarr[$consultationlistcount]['uuid']          = $consultationlist->uuid;
				$consultationlistarr[$consultationlistcount]['current_time']  = adodb_date('Y-m-d',$consultationlist->created);
				$consultationlistarr[$consultationlistcount]['doctor_name']   = $staff_core->name_login;
				$consultationlistarr[$consultationlistcount]['standard_code_1']= $individualcore->standard_code_1;
				$consultationlistcount++;
			}
			$this->view->consultationlistarr = $consultationlistarr;
			$page = $links->subPageCss2();
  	    	$this->view->page   = $page;
	    }else{
			$msg = '当前还没有任何数据 ！';
			$this->view->msg = $msg;
		}
		$this->view->nunumber       = $consultation->count();
		$this->view->currentpagenow = $pageCurrent;
		$this->view->urlencodename  = urlencode($realname);
		$this->view->current_time   = $nowdate;
		$this->view->delname        = $realname;
		$this->view->deldate        = adodb_date('Y-m-d',$nowdate);
		$this->view->display('listconsultation.html');
	}
     /**
	 * 会诊记录的删除
	 */
	public function delAction(){
		$uuid         = $this->_request->getParam('uuid');
		$realname     = $this->_request->getParam('realnamedel');
		$nowdate      = $this->_request->getParam('nowdatedel');
		$actionname   = $this->_request->getParam('actionname');
		switch ($actionname){
			case "delall":
				  $selectFlag  = $this->_request->getParam('selectFlag');
				  if(is_string($selectFlag)){
				  	echo  '<script type="text/javascript">window.alert("没有选择记录?请选择重试！");history.go(-1);</script>';
				  	exit();
				  }else{
				  	foreach($selectFlag as $k=>$v){
				  		$consultation = new Tconsultation_table();
				  		$consultation->whereAdd("uuid='$v'");
				  		$consultation->delete();
				  	}
				  	message("批量删除会诊记录成功",array("返回会诊记录列表"=>__BASEPATH.'gp/consultation/list')); 
				  }
				break;
			case "dellone":
		          $consultation = new Tconsultation_table();
				  $consultation->whereAdd("uuid='$uuid'");
				  if($consultation->delete()){
				  	 message("删除会诊记录成功",array("返回会诊记录列表"=>__BASEPATH.'gp/consultation/list/realnamedel/'.urlencode($realname).'/nowdatedel/'.$nowdate)); 
				  }
				break;
		}
	}
	/**
	 * 添加时的ajax的处理值
	 */
    public function ajaxresultAction(){
		$this->view->basePath = $this->_request->getBasePath();
		$orgid  = $this->_request->getParam('orgid');
		//echo $orgid;
		if($orgid){
			$staff_core = new Tstaff_core();
			$staff_core->whereAdd("org_id='$orgid'");
			$staff_core->find();
			$str = '<input name="doctor_consultation[]" value="'.$orgid.'" type="hidden"/>';
			$str.= '<select name="doctor_consultation[]">';
			$str.='<option value="-1">请选择...</option>';
		    while($staff_core->fetch()){
				     $str.='<option value="'.$staff_core->id.'">'.$staff_core->name_login.'
				            </option>';
				} 
			$str.='</select>';
			$staff_core1 = new Tstaff_core();
			$staff_core1->whereAdd("org_id='$orgid'");
			$staff_core1->find();
			$str.= '<select name="doctor_consultation[]">';
			$str.='<option value="-1">请选择...</option>';
		    while($staff_core1->fetch()){
				     $str.='<option value="'.$staff_core1->id.'">'.$staff_core1->name_login.'
				            </option>';
				} 
			$str.='</select>';
			$staff_core2 = new Tstaff_core();
			$staff_core2->whereAdd("org_id='$orgid'");
			$staff_core2->find();
			$str.= '<select name="doctor_consultation[]">';
			$str.='<option value="-1">请选择...</option>';
		    while($staff_core2->fetch()){
				     $str.='<option value="'.$staff_core2->id.'">'.$staff_core2->name_login.'
				            </option>';
				} 
			$str.='</select>';
			echo $str;
		}
	}
	/**
	 * 编辑时的ajax的处理值
	 */
     public function ajaxresulteditAction(){
		$this->view->basePath = $this->_request->getBasePath();
		$orgid  = $this->_request->getParam('orgid');
		$orgall = $this->_request->getParam('orgall');
		$orgallArr = explode('|',$orgall);
		if($orgid){
			foreach($orgallArr as $k=>$v){
			$doctorArr = explode(',',$v);
			if($doctorArr[0]==$orgid){
			$staff_core = new Tstaff_core();
			$staff_core->whereAdd("org_id='$orgid'");
			$staff_core->find();
			$str = '<input name="doctor_consultation[]" value="'.$orgid.'" type="hidden"/>';
			$str.= '<select name="doctor_consultation[]">';
			$str.='<option value="-1">请选择...</option>';
		    while($staff_core->fetch()){
		    	if($doctorArr[1]==$staff_core->id){
				      $str.='<option value="'.$staff_core->id.'" selected="selected">'.$staff_core->name_login.'
				            </option>';
		    	}else{
		    		 $str.='<option value="'.$staff_core->id.'" >'.$staff_core->name_login.'
				            </option>';
		    	}
		    		}
			$str.='</select>';
			$staff_core1 = new Tstaff_core();
			$staff_core1->whereAdd("org_id='$orgid'");
			$staff_core1->find();
			$str.= '<select name="doctor_consultation[]">';
			$str.='<option value="-1">请选择...</option>';
		    while($staff_core1->fetch()){
		    	if($doctorArr[2]==$staff_core1->id){
				     $str.='<option value="'.$staff_core1->id.'" selected="selected">'.$staff_core1->name_login.'
				            </option>';
		    	}else{
		    		 $str.='<option value="'.$staff_core1->id.'">'.$staff_core1->name_login.'
				            </option>';
		    	}
		    	}
			$str.='</select>';
			$staff_core2 = new Tstaff_core();
			$staff_core2->whereAdd("org_id='$orgid'");
			$staff_core2->find();
			$str.= '<select name="doctor_consultation[]">';
			$str.='<option value="-1">请选择...</option>';
		    while($staff_core2->fetch()){
		    	if($doctorArr[3]==$staff_core2->id){
				     $str.='<option value="'.$staff_core2->id.'" selected="selected">'.$staff_core2->name_login.'
				            </option>';
		    	}else{
		    		 $str.='<option value="'.$staff_core2->id.'" >'.$staff_core2->name_login.'
				            </option>';
		    	}
				} 
			$str.='</select>';
			echo $str;
			}
		}
		}
    }
}
?>