<?php
//门诊处方明细表
class his_prescriptionController extends controller{
	public function init(){
		require_once(__SITEROOT.'library/privilege.php');
		require_once(__SITEROOT.'library/Models/tb_his_patinf_v.php');
		require_once(__SITEROOT.'library/Models/tb_cis_prescription_detail_v.php');
		require_once __SITEROOT."/library/custom/pager.php";//分页类
		require_once(__SITEROOT.'library/Models/organization.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'application/his/models/getarrayvalue.php';
		$this->view->basePath = $this->_request->getBasePath();
		$this->xb = array('0'=>'未知的性别','1'=>'男','2'=>'女','9'=>'未说明的性别');//性别代码
		$this->klx = array('0' =>'社保卡','1'=>'新农合卡','2'=>'医疗机构系统内部号（保证唯一）','9'=>'其他');//卡类型
		$this->cflx = array('1'=>'药品','0'=>'非药品');
		$this->jxdm = array('00'=>'原料','01'=>'片剂(素片,压制片),浸膏片,非包衣片，半浸膏片，全粉片','02'=>'糖衣片,包衣片,薄膜衣片','03'=>'咀嚼片,糖片,异型片,糖胶片','04'=>'肠溶片(肠衣片)','05'=>'调释片,缓释片,控释片,长效片','06'=>'泡腾片','07'=>'舌下片','08'=>'含片,嗽口片(含嗽片),喉症片(喉片),口腔贴片','09'=>'外用片,外用膜,坐药片,环型片','10'=>'阴道片,外用阴道膜,阴道用药,阴道栓片','11'=>'水溶片,眼药水片','12'=>'分散片(适应片)','13'=>'纸片(纸型片),膜片(薄膜片)','14'=>'丸剂,药丸,眼丸,耳丸,糖丸,糖衣丸,浓缩丸,调释丸,水丸，蜜丸，水蜜丸，糊丸，蜡丸、浓缩丸','15'=>'粉针剂(冻干粉针剂),冻干粉','16'=>'注射液(水针剂),油针剂,混悬针剂','17'=>'注射溶媒(在16有冲突时,可代油针剂,混悬针剂)','18'=>'输液剂,血浆代用品','19'=>'胶囊剂,硬胶囊','20'=>'软胶囊,滴丸,胶丸','21'=>'肠溶胶囊,肠溶胶丸','22'=>'调释胶囊,控释胶囊,缓释胶囊','23'=>'溶液剂,含漱液,内服混悬液','24'=>'合剂','25'=>'乳剂,乳胶','26'=>'凝胶剂,胶剂(胶体),胶冻,胶体微粒','27'=>'胶浆剂','28'=>'芳香水剂(露剂)','29'=>'滴剂','30'=>'糖浆剂(蜜浆剂)','31'=>'口服液','32'=>'浸膏剂','33'=>'流浸膏剂','34'=>'酊剂','35'=>'醑剂','36'=>'酏剂','37'=>'洗剂,阴道冲洗剂','38'=>'搽剂(涂剂,擦剂),外用混悬液剂','39'=>'油剂,甘油剂','40'=>'棉胶剂(火棉胶剂)','41'=>'涂膜剂','42'=>'涂布剂','43'=>'滴眼剂,洗眼剂,粉剂眼花缭乱药','44'=>'滴鼻剂,洗鼻剂','45'=>'滴耳剂,洗耳剂','46'=>'口腔药剂,口腔用药,牙科用药','47'=>'灌肠剂','48'=>'软膏剂(油膏剂,水膏剂)','49'=>'霜剂(乳膏剂)','50'=>'糊剂','51'=>'硬膏剂,橡皮膏','52'=>'眼膏剂','53'=>'散剂(内服散剂,外用散剂,粉剂,撒布粉','54'=>'颗粒剂(冲剂),晶剂(结晶,晶体),干糖浆','55'=>'泡腾颗粒剂','56'=>'调释颗粒剂,缓释颗粒剂','57'=>'气雾剂,水雾剂,(加抛射剂)','58'=>'喷雾剂,(不加抛射剂)','59'=>'混悬雾剂,(水,气,粉三相)','60'=>'吸入药剂(鼻吸式),粉雾剂','61'=>'膜剂(口腔膜)','62'=>'海绵剂','63'=>'栓剂,痔疮栓,耳栓','64'=>'植入栓','65'=>'透皮剂,贴剂(贴膏,贴膜),贴片','66'=>'控释透皮剂,控释贴片,控释口颊片','67'=>'划痕剂','68'=>'珠链(泥珠链)','69'=>'锭剂,糖锭','70'=>'微囊胶囊(微丸胶囊)','71'=>'干混悬剂(干悬乳剂\口服乳干粉)','72'=>'吸放剂(气体)','73'=>'煎膏剂（膏滋）','74'=>'酒剂','75'=>'搽剂','76'=>'胶剂','90'=>'试剂盒(诊断用试剂),药盒','99'=>'其它剂型(空心胶囊,绷带,纱布,胶布)'
);//剂型代码
$this->yf = array('1'=>'口服','2'=>'直肠给药','3'=>'舌下给药','4'=>'注射给药','401'=>'皮下注射','402'=>'皮内注射','403'=>'肌肉注射','404'=>'静脉注射或静脉滴注','5'=>'吸入给药','6'=>'局部用药','601'=>'椎管内给药','602'=>'关节腔内给药','603'=>'胸膜腔给药','604'=>'腹腔给药','605'=>'阴道用药','606'=>'滴眼','607'=>'滴鼻','608'=>'喷喉','609'=>'含化','610'=>'敷伤口','611'=>'擦皮肤','6XX'=>'局部用药扩充内容','699'=>'其他局部给药途径','9'=>'其他给药途径'
);//用药途径代码
	}
	public function listAction(){
		require(__SITEROOT.'config/oracleConfig.php');
		$current_region_path = $this->user['current_region_path'];
		$this->view->basePath = __BASEPATH;
		$patientname      = $this->_request->getParam('patientname');
		$identity_number  = $this->_request->getParam('identity_number');
		$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
		$current_org = get_organization_id($current_region_path);
		//查询患者的总数
		$tb_cis_prescription_detail  = new Ttb_cis_prescription_detail(2);
        $tb_cis_prescription_detail->whereAdd("yljgdm in (".$current_org.")");
		//$k是字段名$v是表单输入框的名字
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){
		     	if($k=='identity_number'){
		     		$tb_yl_patient_information = new Ttb_his_patinf(2);
		     		$tb_yl_patient_information->whereAdd("identity_number='$myvalue'");
		     		$tb_yl_patient_information->find(true);
		     		$kh = $tb_yl_patient_information->kh;
		     		$klx= $tb_yl_patient_information->klx;
		     		$tb_cis_prescription_detail->whereAdd("kh='$kh'");
		     		$tb_cis_prescription_detail->whereAdd("klx='$klx'");
		     	}
		     	if($k=='xm'){		     		
		     	 $tb_cis_prescription_detail->whereAdd("kh in (select kh from his_patinf_v where xm='$myvalue') and klx in(select klx from his_patinf_v where xm='$myvalue')");
		     	}
		     }
		}
		$nums = $tb_cis_prescription_detail->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/prescription/list/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$tb_cis_prescription_detail_list  = new Ttb_cis_prescription_detail(2);
		$tb_cis_prescription_detail_list->selectAdd("to_char(kfrq,'yyyy-mm-dd') AS kfrq");
		$tb_cis_prescription_detail_list->selectAdd("kh");
		$tb_cis_prescription_detail_list->selectAdd("klx");
		$tb_cis_prescription_detail_list->selectAdd("jzlsh");
		$tb_cis_prescription_detail_list->selectAdd("cyh");
		$tb_cis_prescription_detail_list->selectAdd("cfmxh");
		$tb_cis_prescription_detail_list->selectAdd("jzksmc");
		$tb_cis_prescription_detail_list->selectAdd("yljgdm");
		$tb_cis_prescription_detail_list->selectAdd("kfysxm");
		$tb_cis_prescription_detail_list->orderby("kfrq desc");	
		$tb_cis_prescription_detail_list->whereAdd("yljgdm in (".$current_org.")");
		foreach($search as $k=>$v){
		     $myvalue = trim($v);
		     if(!empty($myvalue)){	
		     	if($k=='identity_number'){
		     		$tb_yl_patient_information = new Ttb_his_patinf(2);
		     		$tb_yl_patient_information->whereAdd("identity_number='$myvalue'");
		     		$tb_yl_patient_information->find(true);
		     		$kh = $tb_yl_patient_information->kh;
		     		$klx= $tb_yl_patient_information->klx;
		     		$tb_cis_prescription_detail_list->whereAdd("kh='$kh'");
		     		$tb_cis_prescription_detail_list->whereAdd("klx='$klx'");
		     	}
		     	if($k=='xm'){
		     		 $tb_cis_prescription_detail_list->whereAdd("kh in (select kh from his_patinf_v where xm='$myvalue') and klx in(select klx from his_patinf_v where xm='$myvalue')");
		     	}
		     }
		}
		$tb_cis_prescription_detail_list->limit($startnum,__ROWSOFPAGE);	
		
		//$tb_cis_prescription_detail_list->debug(4);
		$tb_cis_prescription_detail_list->find();
		$row = array();
		$count = 0;
		while($tb_cis_prescription_detail_list->fetch()){
			$listkh  = $tb_cis_prescription_detail_list->kh;
			$listklx = $tb_cis_prescription_detail_list->klx;
			$row[$count]['jzlsh']    = $tb_cis_prescription_detail_list->jzlsh;
			$row[$count]['cyh']      = $tb_cis_prescription_detail_list->cyh;
			$row[$count]['cfmxh']    = $tb_cis_prescription_detail_list->cfmxh;
			$row[$count]['jzksmc']   = $tb_cis_prescription_detail_list->jzksmc;
			$row[$count]['kfysxm']   = $tb_cis_prescription_detail_list->kfysxm;
			$row[$count]['kfrq']     = $tb_cis_prescription_detail_list->kfrq;
			$row[$count]['kh']       = $tb_cis_prescription_detail_list->kh;
			$row[$count]['klx']      = $tb_cis_prescription_detail_list->klx;
			//通过卡号和卡类型找这个人
			$tb_patient_information = new Ttb_his_patinf(2);
			$tb_patient_information->whereAdd("kh='$listkh'");
			$tb_patient_information->whereAdd("klx='$listklx'");
			$tb_patient_information->find(true);
			$row[$count]['xm']              = $tb_patient_information->xm;
			$row[$count]['yljg']            = get_organization_by_standard_code($tb_cis_prescription_detail_list->yljgdm);
			$count++;
		}
		$this->view->row         =  $row;
		$page = $links->subPageCss2();
		$this->view->page  = $page;
		$this->view->display('list.html');
	}
	public  function displayAction(){
		require_once __SITEROOT.'application/his/models/data_array.php';
		$kh        =  $this->_request->getParam("kh");
		$klx       =  $this->_request->getParam("klx");
		$cyh       =  $this->_request->getParam("cyh");
		if(empty($kh)&&empty($klx)&&empty($sfmxid))
		{
			message("没有你要查询的用户",array("进入门诊处方明细信息一览表"=>__BASEPATH.'his/prescription/list'));
		}else
		{
			
			$tb_cis_prescription_detail = new Ttb_cis_prescription_detail(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_cis_prescription_detail->joinAdd('left',$tb_cis_prescription_detail,$tb_yl_patient_information,'kh','kh');
			$tb_cis_prescription_detail->joinAdd('left',$tb_cis_prescription_detail,$tb_yl_patient_information,'klx','klx');
			$tb_cis_prescription_detail->whereAdd("cis_prescription_detail_v.cyh='$cyh'");
			$tb_cis_prescription_detail->find(true);
			
			$tb_cis_prescription_detail->klx = getarrayvalue($this->klx,$tb_cis_prescription_detail->klx);
			$tb_cis_prescription_detail->xb = getarrayvalue($this->xb,$tb_cis_prescription_detail->xb);
			$tb_cis_prescription_detail->cflx = getarrayvalue($this->cflx,$tb_cis_prescription_detail->cflx);
			$tb_cis_prescription_detail->jxdm = getarrayvalue($this->jxdm,$tb_cis_prescription_detail->jxdm);
			$tb_cis_prescription_detail->yf = getarrayvalue($this->yf,$tb_cis_prescription_detail->yf);
			$tb_cis_prescription_detail->yljgdm=get_organization_by_standard_code($tb_cis_prescription_detail->yljgdm);
			$this->view->tb_cis_prescription_detail    = $tb_cis_prescription_detail;
			//var_dump($tb_cis_prescription_detail);
			$this->view->tb_yl_patient_information     = $tb_yl_patient_information;
	        $this->view->display('detail.html');
		}
      }
}