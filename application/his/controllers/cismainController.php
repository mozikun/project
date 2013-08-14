<?php
/**
 * 住院病案首页列表及查看详细
 * @author 我好笨
 */
class his_cismainController extends controller 
{
	private $gthbz=array();
    private $xb;
    private $hyzk;//婚姻状况
    private $rytj;//入院途径
    private $cyfs;//出院方式
    private $ryqk;//入院情况
    private $ryqwyzz;//入院前经外院诊治
    private $yygrjg;//医疗机构感染结果
    private $mzcyzd;//门诊出院诊断符合编码
    private $rycyzd;
    private $sqshzd;
    private $lcblzd;
    private $fsblzd;
    private $hbsag_jg;//HBSAG_JG HBSAG检查结果编码
    private $hcvab_jg;
    private $hivab_jg;
    private $sxfy;
    private $crbbg;
    private $zlbg;
    private $xsebg;
    private $swbg;
    private $qtbg;
    private $sz;
    private $szqxdw;//随诊期限单位
    private $sjbl;
    private $sj;
    private $rsmdsc;
    private $xsejbsc;
    private $ssdyl;
    private $xse_xb;
    private $bazl;
    private $syfy;
    private $sfkyba;
    private $xgbz;
    private $mz;
	/**
	 * 用于初始化
	 * 原来将包含文件写在这里，但新规范说不写里面了
	 */
	public function init()
	{
		require_once(__SITEROOT.'library/privilege.php');
		$this->view->basePath = $this->_request->getBasePath();
		$this->gthbz=array(1=>'挂号',2=>'退号');
        $this->xse_xb=$this->xb=array(0=>'未知的性别',1=>'男',2=>'女',9=>'未说明的性别');
        $this->hyzk=array(1=>'未婚',2=>'已婚',3=>'丧偶',4=>'离婚',9=>'未说明的婚姻状况');
        $this->rytj=array('01'=>'门诊入院','02'=>'急诊入院','03'=>'转院');
        $this->cyfs=array('1'=>'常规','2'=>'自动','3'=>'转院');
        $this->ryqk=array('1'=>'危重','2'=>'急诊','3'=>'一般','9'=>'其他');
        $this->ryqwyzz=array('1'=>'有','2'=>'无');
        $this->yygrjg=array('1'=>'治愈','2'=>'好转','3'=>'未愈','4'=>'死亡','5'=>'其它');
        $this->mzcyzd=$this->rycyzd=$this->sqshzd=$this->lcblzd=$this->fsblzd=array('0'=>'未作','1'=>'符合','2'=>'不符合','X'=>'诊断符合情况扩充内容','9'=>'无对照');
        $this->hcvab_jg=$this->hivab_jg=$this->hbsag_jg=array('0'=>'未作','1'=>'阴性','2'=>'阳性');
        $this->sxfy=$this->crbbg=$this->zlbg=$this->xsebg=$this->swbg=$this->qtbg=array('1'=>'有','2'=>'无');
        $this->szqxdw=array('1'=>'周','2'=>'月','3'=>'年');
        $this->sfkyba=$this->ssdyl=$this->sjbl=$this->sj=$this->rsmdsc=$this->sz=array('1'=>'是','2'=>'否');
        $this->xsejbsc=array('1'=>'先天性甲状腺功能减低症','2'=>'苯丙酮尿症','3'=>'6-磷酸葡萄糖脱氢酶缺乏症','4'=>'先天性肾上腺皮质增生症','5'=>'半乳糖血症','6'=>'地中海贫血','9'=>'其他');
        $this->bazl=array('1'=>'甲','2'=>'乙','3'=>'丙');
        $this->syfy=array('1'=>'有输','2'=>'有反应','3'=>'未输');
        $this->xgbz=array('1'=>'正常','2'=>'修改','3'=>'撤销');
        $this->mz=array('1'=>'汉族','2'=>'蒙古族','3'=>'回族','4'=>'藏族','5'=>'维吾尔族','6'=>'苗族','7'=>'彝族','8'=>'壮族','9'=>'布依族','10'=>'朝鲜族','11'=>'满族','12'=>'侗族','13'=>'瑶族','14'=>'白族','15'=>'土家族','16'=>'哈尼族','17'=>'哈萨克族','18'=>'傣族','19'=>'黎族','20'=>'傈傈族','21'=>'佤族','22'=>'畲族','23'=>'高山族','24'=>'拉祜族','25'=>'水族','26'=>'东乡族','27'=>'纳西族','28'=>'景颇族','29'=>'柯尔克孜族','30'=>'土族','31'=>'达斡尔族','32'=>'仫佬族','33'=>'羌族','34'=>'布朗族','35'=>'撒拉族','36'=>'毛难族','37'=>'仡佬族','38'=>'锡伯族','39'=>'阿昌族','40'=>'普米族','41'=>'塔吉克族','42'=>'怒族','43'=>'乌孜别克族','44'=>'俄罗斯族','45'=>'鄂温克族','46'=>'德昂族','47'=>'保安族','48'=>'裕固族','49'=>'京族','50'=>'塔塔尔族','51'=>'独龙族','52'=>'鄂伦春族','53'=>'赫哲族','54'=>'门巴族','55'=>'珞巴族','56'=>'基诺族');//民族情况
	}
	/**
	 * 完成列表
     * 
     * 2012-10-31我好笨增加数据字典显示
     * 
	 * @author 我好笨
	 */
	public function listAction()
	{
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once(__SITEROOT.'library/Models/tb_cis_main_v.php');
		require_once(__SITEROOT.'library/Models/tb_yl_patient_information_v.php');
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
		$this->view->search=$search;
		$current_org = get_organization_id($current_region_path);
		$tb_cis_main  = new Ttb_cis_main(2);
		$tb_yl_patient_information  = new Ttb_yl_patient_information(2);
		$tb_cis_main->joinAdd('left',$tb_cis_main,$tb_yl_patient_information,'kh','kh');
		$tb_cis_main->joinAdd('left',$tb_cis_main,$tb_yl_patient_information,'klx','klx');
		$tb_cis_main->whereAdd("cis_main_v.yljgdm in (".$current_org.")");
		if (isset($search['identity_number']) && $search['identity_number']!="")
		{
			$tb_cis_main->whereAdd("yl_patient_information_v.identity_number like '".$search['identity_number']."%'");
		}
		if (isset($search['xm']) && $search['xm']!="")
		{
			$tb_cis_main->whereAdd("yl_patient_information_v.xm like '".$search['xm']."%'");
		}
		$nums = $tb_cis_main->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/cismain/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_cis_main->limit($startnum,__ROWSOFPAGE);
        //$tb_cis_main->debugLevel(4);
		$tb_cis_main->find();
		$i=0;
		$mz_cis_main_list=array();
		while ($tb_cis_main->fetch()) {
			$mz_cis_main_list[$i]['xm']=$tb_yl_patient_information->xm?$tb_yl_patient_information->xm:$tb_cis_main->xm;
			$mz_cis_main_list[$i]['xb']=$tb_yl_patient_information->xb?$this->xb[$tb_yl_patient_information->xb]:$this->xb[$tb_cis_main->xb];
			$mz_cis_main_list[$i]['bah']=$tb_yl_patient_information->bah;
			$mz_cis_main_list[$i]['ch']=$tb_cis_main->ch;
			$mz_cis_main_list[$i]['rybq']=$tb_cis_main->rybq;
			$mz_cis_main_list[$i]['yljgdm']=get_organization_by_standard_code(trim($tb_cis_main->yljgdm));
			$mz_cis_main_list[$i]['cybq']=$tb_cis_main->cybq;
			$mz_cis_main_list[$i]['lxrxm']=$tb_cis_main->lxrxm;
			$mz_cis_main_list[$i]['lxrdh']=$tb_cis_main->lxrdh;
			$mz_cis_main_list[$i]['ryksmc']=$tb_cis_main->ryksmc;
			$mz_cis_main_list[$i]['sjzyts']=$tb_cis_main->sjzyts;
			$mz_cis_main_list[$i]['jzlsh']=$tb_cis_main->jzlsh;
			$i++;
		}
		$this->view->mz_cis_main_list         =  $mz_cis_main_list;
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
		$jzlsh      = $this->_request->getParam('jzlsh');
		if ($jzlsh)
		{
			require_once(__SITEROOT.'library/Models/organization.php');
			require_once(__SITEROOT.'library/Models/tb_cis_main_v.php');
			require_once(__SITEROOT.'library/Models/tb_yl_patient_information_v.php');
			$tb_cis_main  = new Ttb_cis_main(2);
			$tb_yl_patient_information  = new Ttb_yl_patient_information(2);
			$tb_cis_main->joinAdd('left',$tb_cis_main,$tb_yl_patient_information,'kh','kh');
			$tb_cis_main->joinAdd('left',$tb_cis_main,$tb_yl_patient_information,'klx','klx');
			$tb_cis_main->whereAdd("cis_main_v.jzlsh='$jzlsh'");
			$tb_cis_main->find(true);
			$tb_cis_main->yljgdm=get_organization_by_standard_code($tb_cis_main->yljgdm);
            //取得类的所有属性值，判断是否有数据字典
            $all_vars=array();
            $all_vars=get_class_vars(get_class($tb_cis_main));
            foreach($all_vars as $k=>$v)
            {
                if(isset($this->$k) && !empty($this->$k) && isset($tb_cis_main->$k))
                {
                    $tmp_k=$this->$k;
                    $tb_cis_main->$k=isset($tmp_k[$tb_cis_main->$k])?$tmp_k[$tb_cis_main->$k]:'';
                }
            }
			$this->view->tb_cis_main  = $tb_cis_main;
			$this->view->tb_yl_patient_information  = $tb_yl_patient_information;
			$this->view->display('display.html');
		}
		else 
		{
			message("没有你要查询的用户",array("进入住院病案首页一览表"=>__BASEPATH.'his/mzreg/list'));
		}
	}
}