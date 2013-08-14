<?php
class his_patientmainController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->xb = array('0'=>'未知的性别','1'=>'男','2'=>'女','9'=>'未说明的性别');//性别代码
		$this->zjlx =  array('1'=>'身份证','2'=>'军人证','3'=>'护照','4' => '学生证','5' => '回乡证','6' => '驾驶证','7' => '台胞证','9' => '其它');//证件类型
		$this->klx = array('0' =>'社保卡','1'=>'新农合卡','2'=>'医疗机构系统内部号（保证唯一）','9'=>'其他');//卡类型
        $this->hyzk = array('1'=>'未婚','2'=>'已婚','3'=>'丧偶','4'=>'离婚','5'=>'其他');//婚姻状况
        $this->mz=array('1'=>'汉族','2'=>'蒙古族','3'=>'回族','4'=>'藏族','5'=>'维吾尔族','6'=>'苗族','7'=>'彝族','8'=>'壮族','9'=>'布依族','10'=>'朝鲜族','11'=>'满族','12'=>'侗族','13'=>'瑶族','14'=>'白族','15'=>'土家族','16'=>'哈尼族','17'=>'哈萨克族','18'=>'傣族','19'=>'黎族','20'=>'傈傈族','21'=>'佤族','22'=>'畲族','23'=>'高山族','24'=>'拉祜族','25'=>'水族','26'=>'东乡族','27'=>'纳西族','28'=>'景颇族','29'=>'柯尔克孜族','30'=>'土族','31'=>'达斡尔族','32'=>'仫佬族','33'=>'羌族','34'=>'布朗族','35'=>'撒拉族','36'=>'毛难族','37'=>'仡佬族','38'=>'锡伯族','39'=>'阿昌族','40'=>'普米族','41'=>'塔吉克族','42'=>'怒族','43'=>'乌孜别克族','44'=>'俄罗斯族','45'=>'鄂温克族','46'=>'德昂族','47'=>'保安族','48'=>'裕固族','49'=>'京族','50'=>'塔塔尔族','51'=>'独龙族','52'=>'鄂伦春族','53'=>'赫哲族','54'=>'门巴族','55'=>'珞巴族','56'=>'基诺族');//民族情况
		$this->view->basePath = $this->_request->getBasePath();	
	}
	public function listAction(){
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
		$current_org = get_organization_id($current_region_path);
		//查询患者的总数
		$tb_yl_patient_information  = new Ttb_his_patinf(2);
        $tb_yl_patient_information->whereAdd("yljgdm in (".$current_org.")");
		//$k是字段名$v是表单输入框的名字
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	$tb_yl_patient_information->whereAdd("$k"."="."'$myvalue'");
		     }
		}
		$nums = $tb_yl_patient_information->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/patientmain/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_yl_patient_list  = new Ttb_his_patinf(2);
		$tb_yl_patient_list->whereAdd("yljgdm in (".$current_org.")");
		$tb_yl_patient_list->selectAdd("xm as xm");
		$tb_yl_patient_list->selectAdd("xb as xb");
		$tb_yl_patient_list->selectAdd("to_char(csrq,'yyyy-mm-dd') as csrq");
		$tb_yl_patient_list->selectAdd("klx as klx");
		$tb_yl_patient_list->selectAdd("zjhm as zjhm");
		$tb_yl_patient_list->selectAdd("yljgdm");
		$tb_yl_patient_list->selectAdd("kh");
		$tb_yl_patient_list->selectAdd("jtdz");
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	$tb_yl_patient_list->whereAdd("$k"."="."'$myvalue'");
		     }
		}
		$tb_yl_patient_list->limit($startnum,__ROWSOFPAGE);
		$tb_yl_patient_list->find();
		$row = array();
		$count = 0;
		while($tb_yl_patient_list->fetch()){
			$row[$count]['xm']              = $tb_yl_patient_list->xm;
			//性别
			$row[$count]['xb']      = getarrayvalue($this->xb,$tb_yl_patient_list->xb);
			//卡类别
			$row[$count]['klx']      = getarrayvalue($this->klx,$tb_yl_patient_list->klx);
			//居住地址
			$row[$count]['jzdz']              = $tb_yl_patient_list->jtdz;
			//医疗结构名称
			$yljgdm = $tb_yl_patient_list->yljgdm;
			$org   = new Torganization();
			$org->whereAdd("standard_code='$yljgdm'");
			$org->find(true);
			$row[$count]['yljg']              = $org->zh_name;
			
			$row[$count]['zjhm']              = $tb_yl_patient_list->zjhm;
			$row[$count]['kh']                = $tb_yl_patient_list->kh;
			$row[$count]['csrq']              = $tb_yl_patient_list->csrq;
			$count++;
		}
		$this->view->row         =  $row;
		$page = $links->subPageCss2();
		$this->view->page  = $page;
		$this->view->display('list.html');
	}
	/**
	 * 显示患者显示信息
	 * @author 我好笨
	 */
	public function displayAction(){
		$kh      = $this->_request->getParam('kh');
		if ($kh)
		{
			$tb_yl_patient  = new Ttb_his_patinf(2);
			$tb_yl_patient->whereAdd("kh='$kh'");
			$tb_yl_patient->find(true);
			$tb_yl_patient->klx = getarrayvalue($this->klx,$tb_yl_patient->klx);
			$tb_yl_patient->xb  = getarrayvalue($this->xb,$tb_yl_patient->xb);
			$tb_yl_patient->zjlx  = getarrayvalue($this->zjlx,$tb_yl_patient->zjlx);
			$tb_yl_patient->hyzk  = getarrayvalue($this->hyzk,$tb_yl_patient->hyzk);
			$tb_yl_patient->mz  = getarrayvalue($this->mz,$tb_yl_patient->mz);
			$tb_yl_patient->yljgdm_code=$tb_yl_patient->yljgdm;
			$tb_yl_patient->yljgdm=get_organization_by_standard_code($tb_yl_patient->yljgdm);
			
			$this->view->tb_yl_patient  = $tb_yl_patient;
			$this->view->display('display.html');
		}
		else 
		{
			message("没有你要查询的用户",array("进入患者一览表"=>__BASEPATH.'his/patientmain/list'));
		}
	}
}