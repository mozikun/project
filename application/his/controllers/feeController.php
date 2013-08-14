<?php
class his_feeController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_mz_fee_detail_v.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$this->view->basePath = __BASEPATH;
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->klx = array('0' =>'社保卡','1'=>'新农合卡','2'=>'医疗机构系统内部号（保证唯一）','9'=>'其他');//卡类型
		$this->xb = array('0'=>'未知的性别','1'=>'男','2'=>'女','9'=>'未说明的性别');//性别代码
		$this->xgbz = array('1'=>'收费','2'=>'退费');//退费标志
		$this->mxfylb = array('02'=>'诊疗费','03'=>'治疗费','05'=>'手术材料费','06'=>'检查费','07'=>'化验费','08'=>'摄片费','09'=>'透视费','10'=>'输血费','11'=>'输氧费','12'=>'西药费','13'=>'中成药费','15'=>'其它费用','00'=>'挂号费'); //明细费用类别
	}
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
		$current_org = get_organization_id($current_region_path);
		//查询患者的总数
		$tb_his_mz_fee_detail  = new Ttb_his_mz_fee_detail(2);
        $tb_his_mz_fee_detail->whereAdd("yljgdm in (".$current_org.")");
        $tb_his_mz_fee_detail->whereAdd("kh in (select kh from his_patinf_v)");//主表中的数据和收费明细中的不存在的情况
		//$k是字段名$v是表单输入框的值
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	if($k=='identity_number'){
		     		$tb_yl_patient_information = new Ttb_his_patinf(2);
		     		$tb_yl_patient_information->whereAdd("identity_number='$myvalue'");
		     		$tb_yl_patient_information->find(true);
		     		$kh = $tb_yl_patient_information->kh;
		     		$klx= $tb_yl_patient_information->klx;
		     		$tb_his_mz_fee_detail->whereAdd("kh='$kh'");
		     		$tb_his_mz_fee_detail->whereAdd("klx='$klx'");
		     	}
		     	if($k=='xm'){
		     		$tb_his_mz_fee_detail->whereAdd("kh in (select kh from his_patinf_v where xm='$myvalue') and klx in(select klx from his_patinf_v where xm='$myvalue')");
		     	}
		     }
		}
		$nums = $tb_his_mz_fee_detail->count("distinct kh");
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/fee/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_his_mz_fee_detail_list  = new Ttb_his_mz_fee_detail(2);
		$tb_his_mz_fee_detail_list->selectAdd("distinct kh as kh,klx");
		$tb_his_mz_fee_detail_list->whereAdd("yljgdm in (".$current_org.")");
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){	
		     	if($k=='identity_number'){
		     		$tb_yl_patient_information = new Ttb_his_patinf(2);
		     		$tb_yl_patient_information->whereAdd("identity_number='$myvalue'");
		     		$tb_yl_patient_information->find(true);
		     		$kh = $tb_yl_patient_information->kh;
		     		$klx= $tb_yl_patient_information->klx;
		     		$tb_his_mz_fee_detail_list->whereAdd("kh='$kh'");
		     		$tb_his_mz_fee_detail_list->whereAdd("klx='$klx'");
		     	}
		     	if($k=='xm'){
		     		$tb_his_mz_fee_detail_list->whereAdd("kh in (select kh from his_patinf_v where xm='$myvalue') and klx in(select klx from his_patinf_v where xm='$myvalue')");
		     	}
		     }
		}	
		$tb_his_mz_fee_detail_list->whereAdd("kh in (select kh from his_patinf_v)");//主表中的数据和收费明细中的不存在的情况
		$tb_his_mz_fee_detail_list->limit($startnum,__ROWSOFPAGE);
		//$tb_his_mz_fee_detail_list->debugLevel(9);
		$tb_his_mz_fee_detail_list->find();
		$row = array();
		$count = 0;
		while($tb_his_mz_fee_detail_list->fetch()){
			$listkh  = $tb_his_mz_fee_detail_list->kh;
			$listklx = $tb_his_mz_fee_detail_list->klx;
			//通过卡号和卡类型找这个人
			$tb_patient_information = new Ttb_his_patinf(2);
			$tb_patient_information->whereAdd("kh='$listkh'");
			$tb_patient_information->whereAdd("klx='$listklx'");
			$tb_patient_information->find(true);
			$row[$count]['xm']              = $tb_patient_information->xm;
			$row[$count]['kh']              = $listkh;
			$row[$count]['klx']             = $listklx;			
			$count++;
		}
		$this->view->row         =  $row;
		$page = $links->subPageCss2();
		$this->view->page  = $page;
		$this->view->display('list.html');
	}
	/**
	 * author CT
	 * created 2011.10.17
	 * 门诊收费详细
	 *
	 */
	public function displayAction(){
		$kh        =  $this->_request->getParam("kh");
		$klx       =  $this->_request->getParam("klx");
		$sfmxid    =  $this->_request->getParam("sfmxid");
		if(empty($kh)&&empty($klx)&&empty($sfmxid))
		{   
                message("没有你要查询的用户",array("进入门诊收费信息一览表"=>__BASEPATH.'his/fee/list'));
		}else 
		{
			$tb_his_mz_fee_detail = new Ttb_his_mz_fee_detail(2);
//			$tb_his_mz_fee_detail->whereAdd("kh='$kh'");
//			$tb_his_mz_fee_detail->whereAdd("klx='$klx'");
			$tb_his_mz_fee_detail->whereAdd("sfmxid='$sfmxid'");
			$tb_his_mz_fee_detail->find(true);
			//退费标志 1：收费；2：退费
            $xgbzStr =  getarrayvalue($this->xgbz,$tb_his_mz_fee_detail->xgbz);
			$this->view->xgbzstr   = $xgbzStr;
		   //患者信息
		   $tb_yl_patient_information = new Ttb_his_patinf(2);
		   $tb_yl_patient_information->whereAdd("kh='$kh'");
		   $tb_yl_patient_information->whereAdd("klx='$klx'");
		   $tb_yl_patient_information->find(true);
		   //姓名
		   $patientName        =    $tb_yl_patient_information->xm;
		   $this->view->xm     =     $patientName;
		   //性别  
          $xbStr =  getarrayvalue($this->xb,$tb_yl_patient_information->xb);
          $this->view->xbstr    = $xbStr;
          //医疗机构
          $this->view->yljgmc = get_organization_by_standard_code($tb_his_mz_fee_detail->yljgdm);
          //卡号
          $this->view->kh     = $kh;
          //卡类型  
          $klxStr  = getarrayvalue($this->klx,$klx);
          $this->view->klx    = $klxStr;
          //处方号
          $this->view->cfh   =  $tb_his_mz_fee_detail->cfidh;
          //发票号
          $this->view->fph   =  $tb_his_mz_fee_detail->fph;
          //明细费用类别    
          //02 = 诊疗费 03 = 治疗费 05 = 手术材料费 06 = 检查费 07 = 化验费 08 = 摄片费 09 = 透视费 10 = 输血费 11 = 输氧费 12 = 西药费 13 = 中成药费14 = 中草药费 15 = 其它费用 00 = 挂号费
          $mxfylbStr  = getarrayvalue($this->mxfylb,$tb_his_mz_fee_detail->mxfylb);
          $this->view->mxfylb  =  $mxfylbStr;
          //收费/退费时间
          $stfsj  = $tb_his_mz_fee_detail->stfsj;
          $this->view->stfsj = $stfsj;
          //明细项目
          $this->view->mxxmbm  = $tb_his_mz_fee_detail->mxxmbm;
          $this->view->mxxmmc  = $tb_his_mz_fee_detail->mxxmmc;
          $this->view->mxxmdw  = $tb_his_mz_fee_detail->mxxmdw;
          $this->view->mxxmbm  = $tb_his_mz_fee_detail->mxxmbm;
          $this->view->xmflmc  = $tb_his_mz_fee_detail->xmflmc;
          $this->view->mxxmdj  = floatval($tb_his_mz_fee_detail->mxxmdj);
          $this->view->mxxmsl  = $tb_his_mz_fee_detail->mxxmsl;
          $this->view->mxxmje  = $tb_his_mz_fee_detail->mxxmje;
		} 
		$this->view->display("detail.html");
	}
	/**
	 * 单个人的数据
	 *
	 */
	public  function lonepersonAction()
	{
		$search = array();
		$kh        =  $this->_request->getParam("kh");
		$klx       =  $this->_request->getParam("klx");
		if(isset($kh)&&isset($klx))
		{
		   //患者信息
		   $tb_yl_patient_information = new Ttb_his_patinf(2);
		   $tb_yl_patient_information->whereAdd("kh='$kh'");
		   $tb_yl_patient_information->whereAdd("klx='$klx'");
		   $tb_yl_patient_information->find(true);
		   $this->view->xm = $tb_yl_patient_information->xm;
		   // 个人列表 
		   $tb_his_mz_fee_detail_count  = new Ttb_his_mz_fee_detail(2);
		   $tb_his_mz_fee_detail_count->whereAdd("kh='$kh'");
		   $tb_his_mz_fee_detail_count->whereAdd("klx='$klx'");
		   $nums = $tb_his_mz_fee_detail_count->count();
		   $pageCurrent = intval($this->_request->getParam('page'));
		   $pageCurrent = $pageCurrent?$pageCurrent:1;
		   //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		   $links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/fee/loneperson/page/',2,$search);
		   $pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		   $startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		   $tb_his_mz_fee_detail = new Ttb_his_mz_fee_detail(2);
		   $tb_his_mz_fee_detail->whereAdd("kh='$kh'");
		   $tb_his_mz_fee_detail->whereAdd("klx='$klx'");
		   $tb_his_mz_fee_detail->limit($startnum,__ROWSOFPAGE);
		   $tb_his_mz_fee_detail->find();
		   $row = array();
		   $count = 0;
		   while($tb_his_mz_fee_detail->fetch())
		   {
		   	 $row[$count]['mxxmmc'] = $tb_his_mz_fee_detail->mxxmmc;
		   	 $row[$count]['mxxmdw'] = $tb_his_mz_fee_detail->mxxmdw;
		   	 $row[$count]['mxxmdj'] = $tb_his_mz_fee_detail->mxxmdj;
		   	 $row[$count]['mxxmsl'] = $tb_his_mz_fee_detail->mxxmsl;
		   	 $row[$count]['mxxmje'] = $tb_his_mz_fee_detail->mxxmje;
		   	 $row[$count]['sfmxid'] = $tb_his_mz_fee_detail->sfmxid;
//		   	 echo $tb_his_mz_fee_detail->sfmxid.'<br/>';
		   	 $row[$count]['kh']     = $tb_his_mz_fee_detail->kh;
		   	 $row[$count]['klx']    = $tb_his_mz_fee_detail->klx;
		   	 $count++;
		   }  
		   $this->view->row   = $row;
		   $page = $links->subPageCss2();
		   $this->view->page  = $page;
		}
		$this->view->display('loneperson.html');
	}
}