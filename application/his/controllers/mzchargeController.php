<?php
/**
 * 诊疗收费列表及查看详细
 * @author 我好笨
 */
class his_mzchargeController extends controller 
{
	/**
	 * 用于初始化
	 * 原来将包含文件写在这里，但新规范说不写里面了
	 */
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		$this->view->basePath = $this->_request->getBasePath();
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->stfbz = array(1=>'收费',2=>'退费');
		$this->xb = array('0'=>'未知的性别','1'=>'男','2'=>'女','9'=>'未说明的性别');//性别代码
		$this->zjlx =  array('1'=>'身份证','2'=>'军人证','3'=>'护照','4' => '学生证','5' => '回乡证','6' => '驾驶证','7' => '台胞证','9' => '其它');//证件类型
		$this->klx = array('0' =>'社保卡','1'=>'新农合卡','2'=>'医疗机构系统内部号（保证唯一）','9'=>'其他');//卡类型
		$this->wdbz = array(1=>'本市',2=>'外地',3=>'境外（港澳台）',4=>'外国',5=>'未知');//外地标志
		$this->bxlx=array(0 =>'具有本市干保局方面的医疗费用承担',1 =>'具有本市人保局条线的社会医疗保险费用承担',5 =>'军队的医疗费用承担',6 =>'具有市或区县卫生条线的新农合费用承担',7 =>'全自费',8 =>'具有协同关系的成都以外地区社会医疗保险的费用承担',9 =>'其它');//（5）	保险类型
		
	}
	/**
	 * 完成列表
	 * @author 我好笨
	 */
	public function listAction()
	{
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once(__SITEROOT.'library/Models/tb_his_mz_charge_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
		$this->view->search=$search;
		$current_org = get_organization_id($current_region_path);
		$tb_his_mz_charge  = new Ttb_his_mz_charge(2);
		$tb_yl_patient_information  = new Ttb_his_patinf(2);
		$tb_his_mz_charge->joinAdd('inner',$tb_his_mz_charge,$tb_yl_patient_information,'kh','kh');
		$tb_his_mz_charge->joinAdd('inner',$tb_his_mz_charge,$tb_yl_patient_information,'klx','klx');
		$tb_his_mz_charge->whereAdd("his_mz_charge_v.yljgdm in (".$current_org.")");
		if (isset($search['identity_number']) && $search['identity_number']!="")
		{
			$tb_his_mz_charge->whereAdd("his_patinf_v.identity_number like '".$search['identity_number']."%'");
		}
		if (isset($search['xm']) && $search['xm']!="")
		{
			$tb_his_mz_charge->whereAdd("his_patinf_v.xm like '".$search['xm']."%'");
		}
		$nums = $tb_his_mz_charge->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/mzcharge/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_his_mz_charge->limit($startnum,__ROWSOFPAGE);
        $tb_his_mz_charge->orderBy('his_patinf_v.xm');
		$tb_his_mz_charge->find();
		$i=0;
		$mz_charge_list=array();
		while ($tb_his_mz_charge->fetch()) {
			$mz_charge_list[$i]['xm']=$tb_yl_patient_information->xm;
			$mz_charge_list[$i]['xb']=getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$mz_charge_list[$i]['zjhm']=$tb_yl_patient_information->zjhm;
			$mz_charge_list[$i]['stfrq']=$tb_his_mz_charge->stfrq;
			$mz_charge_list[$i]['stfbz']=getarrayvalue($this->stfbz,$tb_his_mz_charge->stfbz);
			$mz_charge_list[$i]['ghbm']=$tb_his_mz_charge->ghbm;
			$mz_charge_list[$i]['yljgdm']=$tb_his_mz_charge->yljgdm;
			$mz_charge_list[$i]['stfsj']=$tb_his_mz_charge->stfsj;
			$mz_charge_list[$i]['stfze']=$tb_his_mz_charge->stfze;
			$mz_charge_list[$i]['ybfwwzf']=$tb_his_mz_charge->ybfwwzf;
			$mz_charge_list[$i]['txfye']=$tb_his_mz_charge->txfye;
			$i++;
		}
		$this->view->mz_charge_list         =  $mz_charge_list;
		$page = $links->subPageCss2();
		$this->view->page  = $page;
		$this->view->display('list.html');
	}
	/**
	 * 完成详细信息显示
	 * @author 我好笨
	 */
	public function displayAction()
	{
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$ghbm      = $this->_request->getParam('ghbm');
		if ($ghbm)
		{
			require_once(__SITEROOT.'library/Models/organization.php');
			require_once(__SITEROOT.'library/Models/tb_his_mz_charge_v.php');
			require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
			$tb_his_mz_charge  = new Ttb_his_mz_charge(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_his_mz_charge->joinAdd('left',$tb_his_mz_charge,$tb_yl_patient_information,'kh','kh');
			$tb_his_mz_charge->joinAdd('left',$tb_his_mz_charge,$tb_yl_patient_information,'klx','klx');
			$tb_his_mz_charge->whereAdd("his_mz_charge_v.ghbm='$ghbm'");
			$tb_his_mz_charge->find(true);
			$tb_yl_patient_information->xb = getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$tb_yl_patient_information->klx = getarrayvalue($this->klx,$tb_yl_patient_information->klx);
			$tb_his_mz_charge->stfbz = getarrayvalue($this->stfbz,$tb_his_mz_charge->stfbz);
			$tb_his_mz_charge->wdbz = getarrayvalue($this->wdbz,$tb_his_mz_charge->wdbz);
			$tb_his_mz_charge->bxlx = getarrayvalue($this->bxlx,$tb_his_mz_charge->bxlx);
			$tb_his_mz_charge->yljgdm=get_organization_by_standard_code($tb_his_mz_charge->yljgdm);
			$this->view->tb_his_mz_charge  = $tb_his_mz_charge;
			$this->view->tb_yl_patient_information  = $tb_yl_patient_information;
			$this->view->display('display.html');
		}
		else 
		{
			message("没有你要查询的用户",array("进入诊疗收费一览表"=>__BASEPATH.'his/mzreg/list'));
		}
	}
}