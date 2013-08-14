<?php
/**
 * 在/出院结算列表及查看详细
 * @author 我好笨
 */
class his_jzchargeController extends controller 
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
		$this->stfbz  = array(1=>'收费',2=>'退费');//退费标志
		$this->klx = array('0' =>'社保卡','1'=>'新农合卡','2'=>'医疗机构系统内部号（保证唯一）','9'=>'其他');//卡类型
		$this->xb = array('0'=>'未知的性别','1'=>'男','2'=>'女','9'=>'未说明的性别');//性别代码
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
		require_once(__SITEROOT.'library/Models/tb_his_jz_charge_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
		$this->view->search=$search;
		$current_org = get_organization_id($current_region_path);
		$tb_his_jz_charge  = new Ttb_his_jz_charge(2);
		$tb_yl_patient_information  = new Ttb_his_patinf(2);
		$tb_his_jz_charge->joinAdd('inner',$tb_his_jz_charge,$tb_yl_patient_information,'kh','kh');
		$tb_his_jz_charge->joinAdd('inner',$tb_his_jz_charge,$tb_yl_patient_information,'klx','klx');
		$tb_his_jz_charge->whereAdd("his_jz_charge_v.yljgdm in (".$current_org.")");
		if (isset($search['identity_number']) && $search['identity_number']!="")
		{
			$tb_his_jz_charge->whereAdd("his_patinf_v.identity_number like '".$search['identity_number']."%'");
		}
		if (isset($search['xm']) && $search['xm']!="")
		{
			$tb_his_jz_charge->whereAdd("his_patinf_v.xm like '".$search['xm']."%'");
		}
		$nums = $tb_his_jz_charge->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/jzcharge/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_his_jz_charge->limit($startnum,__ROWSOFPAGE);
        $tb_his_jz_charge->orderBy('his_patinf_v.xm');
		$tb_his_jz_charge->find();
		$i=0;
		$jz_charge_list=array();
		while ($tb_his_jz_charge->fetch()) {
			$jz_charge_list[$i]['xm']=$tb_yl_patient_information->xm;
			$jz_charge_list[$i]['xb']=getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$jz_charge_list[$i]['zjhm']=$tb_yl_patient_information->zjhm;
			$jz_charge_list[$i]['stfbh']=$tb_his_jz_charge->stfbh;
			$jz_charge_list[$i]['stfrq']=$tb_his_jz_charge->stfrq;
			$jz_charge_list[$i]['stfsj']=$tb_his_jz_charge->stfsj;
			$jz_charge_list[$i]['zfy']=$tb_his_jz_charge->zfy;
			$jz_charge_list[$i]['ybfwwzf']=$tb_his_jz_charge->ybfwwzf;
			$jz_charge_list[$i]['txfye']=$tb_his_jz_charge->txfye;
			$jz_charge_list[$i]['yljgdm']=get_organization_by_standard_code($tb_his_jz_charge->yljgdm);
			$i++;
		}
		$this->view->jz_charge_list         =  $jz_charge_list;
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
		$stfbh      = $this->_request->getparam('stfbh');
		if ($stfbh)
		{
			require_once(__SITEROOT.'library/Models/organization.php');
			require_once(__SITEROOT.'library/Models/tb_his_jz_charge_v.php');
			require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
			$tb_his_jz_charge  = new Ttb_his_jz_charge(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_his_jz_charge->joinAdd('left',$tb_his_jz_charge,$tb_yl_patient_information,'kh','kh');
			$tb_his_jz_charge->joinAdd('left',$tb_his_jz_charge,$tb_yl_patient_information,'klx','klx');
			$tb_his_jz_charge->whereAdd("his_jz_charge_v.stfbh='$stfbh'");
			$tb_his_jz_charge->find(true);
			$tb_yl_patient_information->xb = getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$tb_yl_patient_information->klx = getarrayvalue($this->klx,$tb_yl_patient_information->klx);
			$tb_his_jz_charge->yljgdm=get_organization_by_standard_code($tb_his_jz_charge->yljgdm);
			$this->view->tb_his_jz_charge  = $tb_his_jz_charge;
			$this->view->tb_yl_patient_information  = $tb_yl_patient_information;
			$this->view->display('display.html');
		}
		else 
		{
			message("没有你要查询的用户",array("进入在/出院结算一览表"=>__BASEPATH.'his/jzcharge/list'));
		}
	}
}