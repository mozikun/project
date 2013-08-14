<?php
/**
 * @author mark
 * @deprecated 手术明细
 */
	class his_operationController extends controller {
	   private $xb;
       private $mzzybz;
       private $rjssbz;
       private $sslx;
       private $xgbz;
       private $mzfs;
       private $qkyhdj;
		public function init(){
			require_once(__SITEROOT.'library/privilege.php');
			require_once(__SITEROOT.'/library/custom/comm_function.php');
			require_once __SITEROOT."/library/custom/pager.php";//分页类
			require_once __SITEROOT."library/Models/tb_operation_detail_v.php";
			require_once __SITEROOT."library/Models/tb_his_patinf_v.php";
			$this->view->basePath = $this->_request->getBasePath();	
            $this->xb=array(0=>'未知的性别',1=>'男',2=>'女',9=>'未说明的性别');
            $this->mzzybz=array('1'=>'门诊','2'=>'住院');
            $this->rjssbz=array('1'=>'是','2'=>'否');
            $this->sslx=array('1'=>'一般','2'=>'抢救','3'=>'术中及抢救','9'=>'其他');
            $this->xgbz=array('1'=>'正常','3'=>'撤销');
            $this->mzfs=array('1'=>'全身麻醉','11'=>'吸入麻醉','12'=>'静脉麻醉','13'=>'基础麻醉','2'=>'椎管内麻醉','21'=>'蛛网膜下腔阻滞麻醉','22'=>'硬脊膜外腔阻滞麻醉','3'=>'局部麻醉','31'=>'神经丛阻滞麻醉','32'=>'神经节阻滞麻醉','33'=>'神经阻滞麻醉','34'=>'区域阻滞麻醉','35'=>'局部浸润麻醉','36'=>'表面麻醉','4'=>'针刺麻醉','5'=>'复合麻醉','51'=>'静吸复合全麻','52'=>'针药复合麻醉','53'=>'神经丛与硬膜外阻滞复合麻醉','54'=>'全麻复合全身降温','55'=>'全麻复合控制性降压','5X'=>'复合麻醉扩充内容','X'=>'麻醉方法扩充内容','9'=>'其他麻醉方法');
            $this->qkyhdj=array('1'=>'切口等级Ⅰ/愈合类型甲','2'=>'切口等级Ⅰ/愈合类型乙','3'=>'切口等级Ⅰ/愈合类型丙','4'=>'切口等级Ⅱ/愈合类型甲','5'=>'切口等级Ⅱ/愈合类型乙','6'=>'切口等级Ⅱ/愈合类型丙','7'=>'切口等级Ⅲ/愈合类型甲','8'=>'切口等级Ⅲ/愈合类型乙','9'=>'切口等级Ⅲ/愈合类型丙');
		}
		/**
		 * 原mark控制器
		 *
		 */
		public function listbakAction(){
			$current_region_path = $this->user['current_region_path'];		
			$patientname      = $this->_request->getParam('patientname');
			$identity_number  = $this->_request->getParam('identity_number');
			$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
			//$k是字段名$v是表单输入框的值
			$operation = new Ttb_operation_detail(2);
			foreach($search as $k=>$v){
			     $myvalue = trim($v);
			     if(!empty($myvalue)){
			     	if($k=='identity_number'){
			     		$tb_yl_patient_information = new Ttb_his_patinf(2);
			     		$tb_yl_patient_information->whereAdd("identity_number='$myvalue'");
			     		$tb_yl_patient_information->find(true);
			     		$kh = $tb_yl_patient_information->kh;
			     		$klx= $tb_yl_patient_information->klx;
			     		$operation->whereAdd("kh='$kh'");
			     		$operation->whereAdd("klx='$klx'");
			     	}
			     	if($k=='xm'){
			     		$operation->whereAdd("kh in (select kh from tb_his_patinf where xm='$myvalue') and klx in(select klx from tb_his_patinf where xm='$myvalue')");
			     	}
			     }
			}
			//处理分页	
			$nuNumber = $operation->count();
			$pageCurrent = intval($this->_request->getParam('page'));
			$pageCurrent = $pageCurrent?$pageCurrent:1;
			//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
			$links = new SubPages(__ROWSOFPAGE,$nuNumber,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/operation/list/page/',					2,$search);
			$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
			$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
			$operation->limit($startnum,__ROWSOFPAGE);
			if ($nuNumber>0){
				$operation->find();
				$operationList = array();
				$x = 0; 
				while ($operation->fetch()){
					//通过卡号和卡类型找这个人
					$tb_patient_information = new Ttb_his_patinf(2);
					$tb_patient_information->whereAdd("kh='$operation->kh'");
					$tb_patient_information->whereAdd("klx='$operation->klx'");
					$tb_patient_information->find(true);
					//姓名					
					$operationList[$x]['xm'] = $tb_patient_information->xm;
					$operationList[$x]['kh'] = $operation->kh;
					$operationList[$x]['xb'] = $tb_patient_information->xb;					
					//性别
					$sex = array('1'=>'男','2'=>'女');
					foreach ($sex as $k=>$v){
					if($k==$tb_patient_information->xb){
						$operationList[$x]['xb']   = $v;
						}
					}
					//手术类型
					$sslx = array('1'=>'一般','2'=>'抢救','3'=>'术中及抢救','9'=>'其他');
					foreach ($sslx as $k=>$v){
						if ($k==$operation->sslx){
							$operationList[$x]['sslx'] = $v;
						}
					}
					//手术内容
					$operationList[$x]['ssczmc'] = $operation->ssczmc;
					//手术日期
					$operationList[$x]['sskssj'] = date("Y-m-d",strtotime($operation->sskssj));
					$operationList[$x]['ssjssj'] = date("Y-m-d",strtotime($operation->ssjssj));
					//责任医生
					$operationList[$x]['ssysxm'] = $operation->ssysxm;					
					$x++;					
				}
				}else {
					$str = '<tr><td colspan="6" align="center">当前暂时没有任何数据！</td></tr>';
					$this->view->str = $str;				
				}
				$this->view->operationList = $operationList;
				$this->view->basePath = __BASEPATH;
				$page = $links->subPageCss2();
				$this->view->page = $page;
				$this->view->display('list.html');
		}
		/**
		 * @author 我好笨
         * 
         * 2012-10-31我好笨增加数据字典显示
         * 
		 * 完成列表
		 */
		public function listAction()
		{
			require_once(__SITEROOT.'library/Models/organization.php');
			require_once __SITEROOT."/library/custom/pager.php";//分页类
			require_once __SITEROOT.'/library/custom/comm_function.php';
			//require_once(__SITEROOT.'library/Models/tb_operation_detail.php');
			//require_once(__SITEROOT.'library/Models/tb_his_patinf.php');
			$current_region_path = $this->user['current_region_path'];
			$this->view->basePath = __BASEPATH;
			$patientname      = $this->_request->getParam('patientname');
			$identity_number  = $this->_request->getParam('identity_number');
			$search = array('identity_number'=>$identity_number,'xm'=>$patientname);
			$this->view->search=$search;
			$current_org = get_organization_id($current_region_path);
			$tb_operation_detail  = new Ttb_operation_detail(2);
			$tb_yl_patient_information  = new Ttb_his_patinf(2);
			$tb_operation_detail->joinAdd('left',$tb_operation_detail,$tb_yl_patient_information,'kh','kh');
			$tb_operation_detail->joinAdd('left',$tb_operation_detail,$tb_yl_patient_information,'klx','klx');
			$tb_operation_detail->whereAdd("operation_detail_v.yljgdm in (".$current_org.")");
			if (isset($search['identity_number']) && $search['identity_number']!="")
			{
				$tb_operation_detail->whereAdd("his_patinf_v.identity_number like '".$search['identity_number']."%'");
			}
			if (isset($search['xm']) && $search['xm']!="")
			{
				$tb_operation_detail->whereAdd("his_patinf_v.xm like '".$search['xm']."%'");
			}
			$nums = $tb_operation_detail->count();
			$pageCurrent = intval($this->_request->getParam('page'));
			$pageCurrent = $pageCurrent?$pageCurrent:1;
			//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
			$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'his/operation/list/page/',2,$search);
			$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
			$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
			$tb_operation_detail->limit($startnum,__ROWSOFPAGE);
			$tb_operation_detail->find();
			$i=0;
			$operationList=array();
			while ($tb_operation_detail->fetch()) {
				$operationList[$i]['xm']=$tb_yl_patient_information->xm?$tb_yl_patient_information->xm:"";
				$operationList[$i]['xb']=$tb_yl_patient_information->xb?$this->xb[$tb_yl_patient_information->xb]:"";
				$operationList[$i]['kh']=$tb_operation_detail->kh;
				$operationList[$i]['sslx']=$tb_operation_detail->sslx;
				$operationList[$i]['ssczmc']=$tb_operation_detail->ssczmc;
				$operationList[$i]['yljgdm']=get_organization_by_standard_code($tb_operation_detail->yljgdm);
				$operationList[$i]['sskssj']=$tb_operation_detail->sskssj;
				$operationList[$i]['ssjssj']=$tb_operation_detail->ssjssj;
				$operationList[$i]['ssysxm']=$tb_operation_detail->ssysxm;
				$operationList[$i]['ssmxlsh']=$tb_operation_detail->ssmxlsh;
				$i++;
			}
			$this->view->operationList         =  $operationList;
			$page = $links->subPageCss2();
			$this->view->page  = $page;
			$this->view->display('list.html');
		}
		/**
		 * @author 我好笨
		 * 显示详细
		 */
		public function displayAction(){
			require_once __SITEROOT.'/library/custom/comm_function.php';
			$ssmxlsh      = $this->_request->getparam('ssmxlsh');
			if ($ssmxlsh)
			{
				require_once(__SITEROOT.'library/Models/organization.php');
				require_once(__SITEROOT.'library/Models/tb_operation_detail.php');
				require_once(__SITEROOT.'library/Models/tb_his_patinf.php');
				$tb_operation_detail  = new Ttb_operation_detail(2);
				$tb_yl_patient_information  = new Ttb_his_patinf(2);
				$tb_operation_detail->joinAdd('left',$tb_operation_detail,$tb_yl_patient_information,'kh','kh');
				$tb_operation_detail->joinAdd('left',$tb_operation_detail,$tb_yl_patient_information,'klx','klx');
				$tb_operation_detail->whereadd("tb_operation_detail.ssmxlsh='$ssmxlsh'");
				$tb_operation_detail->find(true);
				$tb_operation_detail->yljgdm=get_organization_by_standard_code($tb_operation_detail->yljgdm);
				//取得类的所有属性值，判断是否有数据字典
                $all_vars=array();
                $all_vars=get_class_vars(get_class($tb_operation_detail));
                foreach($all_vars as $k=>$v)
                {
                    if(isset($this->$k) && !empty($this->$k) && isset($tb_operation_detail->$k))
                    {
                        $tmp_k=$this->$k;
                        $tb_operation_detail->$k=isset($tmp_k[$tb_operation_detail->$k])?$tmp_k[$tb_operation_detail->$k]:'';
                    }
                }
                $all_vars=array();
                $all_vars=get_class_vars(get_class($tb_yl_patient_information));
                foreach($all_vars as $k=>$v)
                {
                    if(isset($this->$k) && !empty($this->$k) && isset($tb_yl_patient_information->$k))
                    {
                        $tmp_k=$this->$k;
                        $tb_yl_patient_information->$k=isset($tmp_k[$tb_yl_patient_information->$k])?$tmp_k[$tb_yl_patient_information->$k]:'';
                    }
                }
				$this->view->tb_operation_detail  = $tb_operation_detail;
				$this->view->tb_yl_patient_information  = $tb_yl_patient_information;
				$this->view->display('display.html');
			}
			else 
			{
				message("没有你要查询的用户",array("进入手术明细一览表"=>__BASEPATH.'his/mzreg/list'));
			}
		}
	}