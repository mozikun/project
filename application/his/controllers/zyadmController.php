<?php
/**
 * 入院登记列表及查看详细
 * @author 我好笨
 */
class his_zyadmController extends controller 
{
    private $lgbz;
    private $zfbz;
    private $xb;
	/**
	 * 用于初始化
	 * 原来将包含文件写在这里，但新规范说不写里面了
	 */
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		$this->view->basePath = $this->_request->getBasePath();
        $this->xb=array(0=>'未知的性别',1=>'男',2=>'女',9=>'未说明的性别');
        $this->lgbz=array('0'=>'一般住院','1'=>'留院观察');
        $this->zfbz=array('1'=>'正常','2'=>'作废');
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
		require_once(__SITEROOT.'library/Models/tb_his_zy_adm_reg_v.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');//患者信息表
		require_once(__SITEROOT.'library/Models/tb_yl_zy_medical_record_v.php');//住院就诊记录表
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
		$this->view->search=$search;
		$current_org = get_organization_id($current_region_path);
		$tb_his_zy_adm_reg  = new Ttb_his_zy_adm_reg(2);
		$where="";
		if (isset($search['identity_number']) && $search['identity_number']!="")
		{
			$where.=" and his_patinf_v.identity_number like '".$search['identity_number']."%'";
		}
		if (isset($search['xm']) && $search['xm']!="")
		{
			$where.=" and his_patinf_v.xm like '".$search['xm']."%'";
		}
		$sql="select count(*) as nums from his_zy_adm_reg_v left join (select * from yl_zy_medical_record_v left join his_patinf_v on (yl_zy_medical_record_v.kh=his_patinf_v.kh and yl_zy_medical_record_v.klx=his_patinf_v.klx)) a on his_zy_adm_reg_v.zyid=a.jzlsh where his_zy_adm_reg_v.yljgdm in (".$current_org.")";
		if ($where)
		{
			$sql.=$where;
		}
		$tb_his_zy_adm_reg->query($sql);
		$tb_his_zy_adm_reg->fetch();
		$nums = $tb_his_zy_adm_reg->nums;
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/zyadm/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_his_zy_adm_reg  = new Ttb_his_zy_adm_reg(2);
		$sql="select * from (select A.*,ROWNUM as RN from (select * from his_zy_adm_reg_v left join (select * from yl_zy_medical_record_v left join his_patinf_v on (yl_zy_medical_record_v.kh=his_patinf_v.kh and yl_zy_medical_record_v.klx=his_patinf_v.klx)) a on his_zy_adm_reg_v.zyid=a.jzlsh where his_zy_adm_reg_v.yljgdm in (".$current_org.") ".$where.") A where ROWNUM <= ".(__ROWSOFPAGE*$pageCurrent).") where RN > $startnum";
		$tb_his_zy_adm_reg->query($sql);
		//$tb_his_zy_adm_reg->find();
		$i=0;
		$zyadm_list=array();
		while ($tb_his_zy_adm_reg->fetch()) {
			$zyadm_list[$i]['xm']=$tb_his_zy_adm_reg->xm;
			$zyadm_list[$i]['xb']=$this->xb[$tb_his_zy_adm_reg->xb];
			$zyadm_list[$i]['zjhm']=$tb_his_zy_adm_reg->zjhm;
			$zyadm_list[$i]['ryks']=$tb_his_zy_adm_reg->ryks;
			$zyadm_list[$i]['ksmc']=$tb_his_zy_adm_reg->ksmc;
			$zyadm_list[$i]['rysj']=$tb_his_zy_adm_reg->rysj;
			$zyadm_list[$i]['lgbz']=$this->lgbz[$tb_his_zy_adm_reg->lgbz];
			$zyadm_list[$i]['zfbz']=$this->zfbz[$tb_his_zy_adm_reg->zfbz];
			$zyadm_list[$i]['zyid']=$tb_his_zy_adm_reg->zyid;
			$zyadm_list[$i]['yljgdm']=get_organization_by_standard_code($tb_his_zy_adm_reg->yljgdm);
			$i++;
		}
		$this->view->zyadm_list         =  $zyadm_list;
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
		$zyid      = $this->_request->getParam('zyid');
		if ($zyid)
		{
			require_once(__SITEROOT.'library/Models/organization.php');
			require_once(__SITEROOT.'library/Models/tb_his_zy_adm_reg_v.php');
			require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
			$tb_his_zy_adm_reg  = new Ttb_his_zy_adm_reg(2);
			$sql="select * from his_zy_adm_reg_v left join (select * from yl_zy_medical_record_v left join his_patinf_v on (yl_zy_medical_record_v.kh=his_patinf_v.kh and yl_zy_medical_record_v.klx=his_patinf_v.klx)) a on his_zy_adm_reg_v.zyid=a.jzlsh where his_zy_adm_reg_v.zyid='$zyid'";
			$tb_his_zy_adm_reg->query($sql);
			$tb_his_zy_adm_reg->fetch();
			$tb_his_zy_adm_reg->yljgdm=get_organization_by_standard_code($tb_his_zy_adm_reg->yljgdm);
            $tb_his_zy_adm_reg->lgbz=$this->lgbz[$tb_his_zy_adm_reg->lgbz];
			$tb_his_zy_adm_reg->zfbz=$this->zfbz[$tb_his_zy_adm_reg->zfbz];
            $tb_his_zy_adm_reg->xb=$this->xb[$tb_his_zy_adm_reg->xb];
			$this->view->tb_his_zy_adm_reg  = $tb_his_zy_adm_reg;
			$this->view->display('display.html');
		}
		else 
		{
			message("没有你要查询的用户",array("进入入院登记一览表"=>__BASEPATH.'his/mzreg/list'));
		}
	}
}