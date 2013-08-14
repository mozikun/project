<?php
 /**
 * 住院收费明细列表及查看详细
 * @author CT
 */
class his_zysfmxController extends controller 
{
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		$this->view->basePath = $this->_request->getBasePath();
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once(__SITEROOT.'library/Models/tb_his_zy_fee_detail_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->klx = array('0' =>'社保卡','1'=>'新农合卡','2'=>'医疗机构系统内部号（保证唯一）','9'=>'其他');//卡类型
		$this->xb = array('0'=>'未知的性别','1'=>'男','2'=>'女','9'=>'未说明的性别');//性别代码
		$this->xgbz = array('1'=>'收费','2'=>'退费');//退费标志
		$this->mxfylb = array('01'=>'住院费','02' =>'诊疗费','03' =>'治疗费','04' => '护理费','05' => '手术材料费','06' => '检查费','07' => '化验费','08' => '摄片费','09' => '透视费','10' => '输血费','11' => '输氧费','12' => '西药费','13' => '中成药费','14' => '中草药费','15' => '其它费用');//明细费用类别
	}
	/**
	 * 列表
	 * @author CT
	 */
	public function listAction()
	{
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
		$patientname      = trim($this->_request->getParam('patientname'));
		$identity_number  = trim($this->_request->getParam('identity_number'));
		$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
		$this->view->search=$search;
		$current_org = get_organization_id($current_region_path);
		$tb_his_zy_fee_detail  = new Ttb_his_zy_fee_detail(2);
		$tb_yl_patient_information  = new Ttb_his_patinf(2);
		$tb_his_zy_fee_detail->joinAdd('left',$tb_his_zy_fee_detail,$tb_yl_patient_information,'kh','kh');
		$tb_his_zy_fee_detail->joinAdd('left',$tb_his_zy_fee_detail,$tb_yl_patient_information,'klx','klx');
		$tb_his_zy_fee_detail->whereAdd("his_zy_fee_detail_v.yljgdm in (".$current_org.")");
		if (isset($search['identity_number']) && $search['identity_number']!="")
		{
			$tb_his_zy_fee_detail->whereAdd("his_patinf_v.identity_number like '".$search['identity_number']."%'");
		}
		if (isset($search['xm']) && $search['xm']!="")
		{
			$tb_his_zy_fee_detail->whereAdd("his_patinf_v.xm like '".$search['xm']."%'");
		}
		$nums = $tb_his_zy_fee_detail->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/zysfmx/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_his_zy_fee_detail->limit($startnum,__ROWSOFPAGE);
		$tb_his_zy_fee_detail->find();
		$i=0;
		$tb_his_zy_fee_detail_list=array();
		while ($tb_his_zy_fee_detail->fetch()) {
			$tb_his_zy_fee_detail_list[$i]['xm']= $tb_yl_patient_information->xm;
			$tb_his_zy_fee_detail_list[$i]['xb']= getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$tb_his_zy_fee_detail_list[$i]['jzlsh']=$tb_his_zy_fee_detail->jzlsh;
			$tb_his_zy_fee_detail_list[$i]['xgbz']=getarrayvalue($this->xgbz,$tb_his_zy_fee_detail->xgbz);
			$tb_his_zy_fee_detail_list[$i]['fph']=$tb_his_zy_fee_detail->fph;
			$tb_his_zy_fee_detail_list[$i]['kh']=$tb_his_zy_fee_detail->kh;
			$tb_his_zy_fee_detail_list[$i]['klx']=$tb_his_zy_fee_detail->klx;
			$tb_his_zy_fee_detail_list[$i]['mxfylb']=getarrayvalue($this->mxfylb,$tb_his_zy_fee_detail->mxfylb);
			$tb_his_zy_fee_detail_list[$i]['sfmxid']=$tb_his_zy_fee_detail->sfmxid;
			$tb_his_zy_fee_detail_list[$i]['yljgdm']=get_organization_by_standard_code($tb_his_zy_fee_detail->yljgdm);
			$i++;
		}
		$this->view->tb_his_zy_fee_detail_list         =  $tb_his_zy_fee_detail_list;
		$page = $links->subPageCss2();
		$this->view->page  = $page;
		$this->view->display('list.html');
	}
	/**
	 * 详细信息显示
	 * @author CT
	 */
	public function displayAction()
	{
		require_once __SITEROOT.'/library/custom/comm_function.php';
		$sfmxid     = $this->_request->getparam('sfmxid');
		if ($sfmxid)
		{
			$tb_his_zy_fee_detail  = new Ttb_his_zy_fee_detail(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_his_zy_fee_detail->joinAdd('left',$tb_his_zy_fee_detail,$tb_yl_patient_information,'kh','kh');
			$tb_his_zy_fee_detail->joinAdd('left',$tb_his_zy_fee_detail,$tb_yl_patient_information,'klx','klx');
			$tb_his_zy_fee_detail->whereAdd("his_zy_fee_detail_v.sfmxid='$sfmxid'");
			$tb_his_zy_fee_detail->find(true);
			$tb_yl_patient_information->xb  =  getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$tb_yl_patient_information->klx  =  getarrayvalue($this->klx,$tb_yl_patient_information->klx);
			$tb_his_zy_fee_detail->xgbz  =  getarrayvalue($this->xgbz,$tb_his_zy_fee_detail->xgbz);
			$tb_his_zy_fee_detail->mxfylb  =  getarrayvalue($this->mxfylb,$tb_his_zy_fee_detail->mxfylb);
			$tb_his_zy_fee_detail->yljgdm=get_organization_by_standard_code($tb_his_zy_fee_detail->yljgdm);
			$this->view->tb_his_zy_fee_detail  = $tb_his_zy_fee_detail;
			$this->view->tb_yl_patient_information  = $tb_yl_patient_information;
			$this->view->display('detail.html');
		}
		else 
		{
			message("没有你要查询的用户",array("住院收费明细一览表"=>__BASEPATH.'his/zysfmx/list'));
		}
	}
}
?>