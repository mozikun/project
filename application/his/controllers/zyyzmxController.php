<?php
 /**
 * 住院医嘱明细表列表及查看详细
 * @author CT
 */
class his_zyyzmxController extends controller 
{
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		$this->view->basePath = $this->_request->getBasePath();
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once(__SITEROOT.'library/Models/tb_cis_dradvice_detail_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->xb = array('0'=>'未知的性别','1'=>'男','2'=>'女','9'=>'未说明的性别');//性别代码
		$this->cxbz = array('1'=>'正常','2'=>'撤销该医嘱');//撤销标志
		$this->klx = array('0' =>'社保卡','1'=>'新农合卡','2'=>'医疗机构系统内部号（保证唯一）','9'=>'其他');//卡类型
		$this->yzlb = array('1'=>'长期（在院）','2'=>'临时（在院）','3'=>'出院带药','9'=>'其他');//医嘱类别
		$this->yzlx = array('1'=>'药品','0'=>'非药品');//是否药品
		$this->sfps = array('1'=>'是','0'=>'否');//皮试判别
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
		$tb_cis_dradvice_detail  = new Ttb_cis_dradvice_detail(2);
		$tb_yl_patient_information  = new Ttb_his_patinf(2);
		$tb_cis_dradvice_detail->joinAdd('left',$tb_cis_dradvice_detail,$tb_yl_patient_information,'kh','kh');
		$tb_cis_dradvice_detail->joinAdd('left',$tb_cis_dradvice_detail,$tb_yl_patient_information,'klx','klx');
		$tb_cis_dradvice_detail->whereAdd("cis_dradvice_detail_v.yljgdm in (".$current_org.")");
		if (isset($search['identity_number']) && $search['identity_number']!="")
		{
			$tb_cis_dradvice_detail->whereAdd("his_patinf_v.identity_number like '".$search['identity_number']."%'");
		}
		if (isset($search['xm']) && $search['xm']!="")
		{
			$tb_cis_dradvice_detail->whereAdd("his_patinf_v.xm like '".$search['xm']."%'");
		}
		$nums = $tb_cis_dradvice_detail->count();
		
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/zyyzmx/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_cis_dradvice_detail->limit($startnum,__ROWSOFPAGE);
		$tb_cis_dradvice_detail->find();
		$i=0;
		$tb_cis_dradvice_detail_list=array();
		while ($tb_cis_dradvice_detail->fetch()) {
			$tb_cis_dradvice_detail_list[$i]['xm']= $tb_yl_patient_information->xm;
			$tb_cis_dradvice_detail_list[$i]['xb']= getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$tb_cis_dradvice_detail_list[$i]['jzlsh']=$tb_cis_dradvice_detail->jzlsh;
			$tb_cis_dradvice_detail_list[$i]['yzid']=$tb_cis_dradvice_detail->yzid;
			$tb_cis_dradvice_detail_list[$i]['bq']=$tb_cis_dradvice_detail->bq;
			$tb_cis_dradvice_detail_list[$i]['kh']=$tb_cis_dradvice_detail->kh;
			$tb_cis_dradvice_detail_list[$i]['klx']=$tb_cis_dradvice_detail->klx;
			$tb_cis_dradvice_detail_list[$i]['xdksbm']=$tb_cis_dradvice_detail->xdksbm;
			$tb_cis_dradvice_detail_list[$i]['xdksmc']=$tb_cis_dradvice_detail->xdksmc;
			$tb_cis_dradvice_detail_list[$i]['yljgdm']=get_organization_by_standard_code($tb_cis_dradvice_detail->yljgdm);
			$i++;
		}
		$this->view->tb_cis_dradvice_detail_list         =  $tb_cis_dradvice_detail_list;
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
		$yzid     = $this->_request->getparam('yzid');
		if ($yzid)
		{
			$tb_cis_dradvice_detail  = new Ttb_cis_dradvice_detail(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_cis_dradvice_detail->joinAdd('left',$tb_cis_dradvice_detail,$tb_yl_patient_information,'kh','kh');
			$tb_cis_dradvice_detail->joinAdd('left',$tb_cis_dradvice_detail,$tb_yl_patient_information,'klx','klx');
			$tb_cis_dradvice_detail->whereAdd("cis_dradvice_detail_v.yzid='$yzid'");
			$tb_cis_dradvice_detail->find(true);
			$tb_yl_patient_information->xb = getarrayvalue($this->xb,$tb_yl_patient_information->xb);
			$tb_cis_dradvice_detail->klx = getarrayvalue($this->klx,$tb_cis_dradvice_detail->klx);
			$tb_cis_dradvice_detail->yzlb = getarrayvalue($this->yzlb,$tb_cis_dradvice_detail->yzlb);
			$tb_cis_dradvice_detail->yzlx = getarrayvalue($this->yzlx,$tb_cis_dradvice_detail->yzlx);
			$tb_cis_dradvice_detail->sfps = getarrayvalue($this->sfps,$tb_cis_dradvice_detail->sfps);
			$tb_cis_dradvice_detail->yljgdm=get_organization_by_standard_code($tb_cis_dradvice_detail->yljgdm);
			$this->view->tb_cis_dradvice_detail  = $tb_cis_dradvice_detail;
			$this->view->tb_yl_patient_information  = $tb_yl_patient_information;
			$this->view->display('detail.html');
		}
		else 
		{
			message("没有你要查询的用户",array("住院医嘱明细一览表"=>__BASEPATH.'his/zyyzmx/list'));
		}
	}
}
?>