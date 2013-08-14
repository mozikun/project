<?php
 /**
 * 检验结果指标列表及查看详细
 * @author CT
 */
class his_jyjgzbController extends controller 
{
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		$this->view->basePath = $this->_request->getBasePath();
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once(__SITEROOT.'library/Models/tb_lis_indicators_v.php');
		require_once(__SITEROOT.'library/Models/tb_lis_report_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->xb = array('0'=>'未知的性别','1'=>'男','2'=>'女','9'=>'未说明的性别');//性别代码
		$this->ycts = array(1=>'正常',2=>'无法识别的异常',3=>'异常偏高',4=>'异常偏低');//异常提示
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
		$tb_lis_indicators  = new Ttb_lis_indicators(2);
		$where="";
		if (isset($search['identity_number']) && $search['identity_number']!="")
		{
			$where.=" and his_patinf_v.identity_number like '".$search['identity_number']."%'";
		}
		if (isset($search['xm']) && $search['xm']!="")
		{
			$where.=" and his_patinf_v.xm like '".$search['xm']."%'";
		}
//		$sql="select * from tb_lis_indicators left join (select * from tb_lis_report left join tb_yl_patient_information on (tb_lis_report.kh=tb_yl_patient_information.kh and tb_lis_report.klx=tb_lis_report.klx)) a on tb_lis_indicators.bgdh=a.bgdh and  tb_lis_indicators.bgrq=a.bgrq where tb_lis_indicators.yljgdm in (".$current_org.")";
$sql = "select count(*) as counter from lis_indicators_v left join lis_report_v on lis_indicators_v.bgdh=lis_report_v.bgdh and lis_indicators_v.bgrq=lis_report_v.bgrq
left join his_patinf_v on lis_report_v.kh=his_patinf_v.kh and lis_report_v.klx=his_patinf_v.klx where lis_indicators_v.yljgdm in (".$current_org.")";
		if ($where)
		{
			$sql.=$where;
		}
//		echo $sql;
		$nums = $tb_lis_indicators->query($sql);
		$tb_lis_indicators->fetch();
		$nums = $tb_lis_indicators->counter;
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/jyjgzb/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$sqlstr = '';
		//$tb_lis_indicators->limit($startnum,__ROWSOFPAGE);
		if ($where)
		{
			$sqlstr.=$where;
		}else 
		{
			$sqlstr.='';
		}
		$sql1 = "select * from (select A.*,ROWNUM as RN from (select * from lis_indicators_v left join lis_report_v on lis_indicators_v.bgdh=lis_report_v.bgdh and lis_indicators_v.bgrq=lis_report_v.bgrq left join his_patinf_v on lis_report_v.kh=his_patinf_v.kh and lis_report_v.klx=his_patinf_v.klx where lis_indicators_v.yljgdm in (".$current_org.")$sqlstr) A where ROWNUM <= ".(__ROWSOFPAGE*$pageCurrent).") where RN > '$startnum'";
		$tb_lis_indicators->query($sql1);
		//$tb_lis_indicators->find();
		$i=0;
		$tb_lis_indicators_list=array();
		while ($tb_lis_indicators->fetch()) {
//			print_r($tb_lis_indicators);
//			exit();
			$tb_lis_indicators_list[$i]['xm']= $tb_lis_indicators->xm;
			$tb_lis_indicators_list[$i]['xb']= getarrayvalue($this->xb,$tb_lis_indicators->xb);
			$tb_lis_indicators_list[$i]['bgdh']=$tb_lis_indicators->bgdh;
			$tb_lis_indicators_list[$i]['jcrxm']=$tb_lis_indicators->jcrxm;
			$tb_lis_indicators_list[$i]['jcff']=$tb_lis_indicators->jcff;
			$tb_lis_indicators_list[$i]['kh']=$tb_lis_indicators->kh;
			$tb_lis_indicators_list[$i]['klx']=$tb_lis_indicators->klx;
			$tb_lis_indicators_list[$i]['jczbmc']=$tb_lis_indicators->jczbmc;
			$tb_lis_indicators_list[$i]['yqmc']=$tb_lis_indicators->yqmc;
			$tb_lis_indicators_list[$i]['jyzblsh']=$tb_lis_indicators->jyzblsh;
			$tb_lis_indicators_list[$i]['yljgdm']=get_organization_by_standard_code($tb_lis_indicators->yljgdm);
			$i++;
		}
		$this->view->tb_lis_indicators_list         =  $tb_lis_indicators_list;
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
		$jyzblsh     = $this->_request->getparam('jyzblsh');
		if ($jyzblsh)
		{
			$tb_lis_indicators  = new Ttb_lis_indicators(2);
			$tb_lis_indicators->whereAdd("jyzblsh='$jyzblsh'");
			$tb_lis_indicators->find(true);
			$tb_lis_indicators->ycts = getarrayvalue($this->ycts,$tb_lis_indicators->ycts);
			$tb_lis_indicators->yljgdm=get_organization_by_standard_code($tb_lis_indicators->yljgdm);
			$this->view->tb_lis_indicators  = $tb_lis_indicators;
			$this->view->display('detail.html');
		}
		else 
		{
			message("没有你要查询的用户",array("检验结果指标一览表"=>__BASEPATH.'his/jyjgzb/list'));
		}
	}
}
?>