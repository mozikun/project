<?php
 /**
 * 实验室检验报告列表及查看详细
 * @author CT
 */
class his_sysjybgController extends controller 
{
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		$this->view->basePath = $this->_request->getBasePath();
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once(__SITEROOT.'library/Models/tb_lis_report_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->mzzybz  = array(1=>'门诊',2=>'住院');//门诊/住院标志
		$this->xb = array('0'=>'未知的性别','1'=>'男','2'=>'女','9'=>'未说明的性别');//性别代码
		$this->klx = array('0' =>'社保卡','1'=>'新农合卡','2'=>'医疗机构系统内部号（保证唯一）','9'=>'其他');//卡类型
		$this->bgdlbbm = array(1=>'一般临床检验',2=>'血液学检查',3=>'临床化学检查',4 =>'临床免疫学检查',5 => '临床微生物学检查',6 =>'临床寄生虫学检查',7 =>'分子生物学检查',9999 =>'其它');//报告单类别编码
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
		$tb_lis_report  = new Ttb_lis_report(2);
		$tb_yl_patient_information  = new Ttb_his_patinf(2);
		$tb_lis_report->joinAdd('left',$tb_lis_report,$tb_yl_patient_information,'kh','kh');
		$tb_lis_report->joinAdd('left',$tb_lis_report,$tb_yl_patient_information,'klx','klx');
		$tb_lis_report->whereAdd("lis_report_v.yljgdm in (".$current_org.")");
		if (isset($search['identity_number']) && $search['identity_number']!="")
		{
			$tb_lis_report->whereAdd("his_patinf_v.identity_number like '".$search['identity_number']."%'");
		}
		if (isset($search['xm']) && $search['xm']!="")
		{
			$tb_lis_report->whereAdd("his_patinf_v.xm like '".$search['xm']."%'");
		}
		$nums = $tb_lis_report->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/sysjybg/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_lis_report->limit($startnum,__ROWSOFPAGE);
		$tb_lis_report->find();
		$i=0;
		$tb_lis_report_list=array();
		while ($tb_lis_report->fetch()) {
			$tb_lis_report_list[$i]['brxm']= $tb_lis_report->brxm;
			$tb_lis_report_list[$i]['brxb']= getarrayvalue($this->xb,$tb_lis_report->brxb);
			$tb_lis_report_list[$i]['jzlsh']=$tb_lis_report->jzlsh;
			$tb_lis_report_list[$i]['bgdh']=$tb_lis_report->bgdh;
			$tb_lis_report_list[$i]['ch']=$tb_lis_report->ch;
			$tb_lis_report_list[$i]['bbmc']=$tb_lis_report->bbmc;
			$tb_lis_report_list[$i]['kh']=$tb_lis_report->kh;
			$tb_lis_report_list[$i]['klx']=$tb_lis_report->klx;
			$tb_lis_report_list[$i]['bgrxm']=$tb_lis_report->bgrxm;
			$tb_lis_report_list[$i]['shrxm']=$tb_lis_report->shrxm;
			$tb_lis_report_list[$i]['yljgdm']=get_organization_by_standard_code($tb_lis_report->yljgdm);
			$i++;
		}
		$this->view->tb_lis_report_list         =  $tb_lis_report_list;
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
		$bgdh     = $this->_request->getparam('bgdh');
		if ($bgdh)
		{
			$tb_lis_report  = new Ttb_lis_report(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_lis_report->joinAdd('left',$tb_lis_report,$tb_yl_patient_information,'kh','kh');
			$tb_lis_report->joinAdd('left',$tb_lis_report,$tb_yl_patient_information,'klx','klx');
			$tb_lis_report->whereAdd("lis_report_v.bgdh='$bgdh'");
			$tb_lis_report->find(true);
			$tb_lis_report->klx = getarrayvalue($this->klx,$tb_lis_report->klx);
			$tb_lis_report->brxb = getarrayvalue($this->xb,$tb_lis_report->brxb);
			$tb_lis_report->mzzybz = getarrayvalue($this->mzzybz,$tb_lis_report->mzzybz);
			$tb_lis_report->bgdlbbm = getarrayvalue($this->bgdlbbm,$tb_lis_report->bgdlbbm);
			$tb_lis_report->yljgdm=get_organization_by_standard_code($tb_lis_report->yljgdm);
			$this->view->tb_lis_report  = $tb_lis_report;
			$this->view->tb_yl_patient_information  = $tb_yl_patient_information;
			$this->view->display('detail.html');
		}
		else 
		{
			message("没有你要查询的用户",array("实验室检验报告一览表"=>__BASEPATH.'his/sysjybg/list'));
		}
	}
}
?>