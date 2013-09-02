<?php
/**
*@author：我好笨
*@filename: indexController.php
*@package：用于健康教育活动
*@email：4049054@qq.com
*@create：2010-10-12
*/
class he_indexController extends controller
{
	private $mask_char='******';

	//此级别以下的用like 以上的用instr
	public $optimizerRegion=4;
	/**
	 * 等同于构造函数
	 */
	public function init()
	{
		$this->haveWritePrivilege='';
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT."library/Models/organization.php";
		require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/individual_core.php";
		require_once(__SITEROOT.'library/MyAuth.php');
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		$this->view->assign("baseUrl",__BASEPATH);
		$this->view->assign( "basePath", __BASEPATH );
	}
	/**
	 * 健康教育活动列表
	 */
	public function indexAction()
	{
		//set_time_limit(0);
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		require_once __SITEROOT."library/Models/health_education.php";
		$org_id=$this->user['org_id'];
		$search=array();
		//取搜索值
		$time_start=$this->_request->getParam('time_start','');
		$time_end=$this->_request->getParam('time_end','');
		$address=$this->_request->getParam('address','');
		$sponsor=$this->_request->getParam('sponsor','');
		$person_in_charge=$this->_request->getParam('person_in_charge','');
        $health_education_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		//医生列表
		$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$person_in_charge);
		$health_education=new Thealth_education();
        $staff_core=new Tstaff_core();
        $health_education->whereAdd($staff_core_region_path_domain);
        $health_education->joinAdd('left',$health_education,$staff_core,'staff_id','id');
		if($time_start)
		{
			$search['time_start']=$time_start;
			$time_start=mkunixstamp($time_start);
			$health_education->whereAdd("health_education.activity_time>='$time_start'");
		}
		if($time_end)
		{
			$search['time_end']=$time_end;
			$time_end=mkunixstamp($time_end);
			$health_education->whereAdd("health_education.activity_time<='$time_end'");
		}
		if($address)
		{
			$search['address']=$address;
			$health_education->whereAdd("health_education.activity_address like '$address%'");
		}
		if($sponsor)
		{
			$search['sponsor']=$sponsor;
			$health_education->whereAdd("health_education.sponsor like '$sponsor%'");
		}
		if($person_in_charge && $person_in_charge!='-9')
		{
			$search['person_in_charge']=$person_in_charge;
			$health_education->whereAdd("health_education.person_in_charge='$person_in_charge'");
		}
		$nums=$health_education->count();
		$pageCurrent = intval($this->_request->getParam('page'));
		$pageCurrent = $pageCurrent?$pageCurrent:1;
		//new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
		$links = new SubPages(__ROWSOFPAGE,$nums,$pageCurrent,__goodsListRowOfPage,__BASEPATH.'he/index/index/page/',2,$search);
		$pageCurrent = $links->check_page($pageCurrent);//检查当前页数是否合法
		$startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
		$health_education->limit($startnum,__ROWSOFPAGE);
        $health_education->orderBy("health_education.created DESC");
        //$health_education->debugLevel("4");
		$health_education->find();
		$he=array();
		$i=0;
		while ($health_education->fetch())
		{
			$he[$i]['uuid']=$health_education->uuid;
			$he[$i]['js_uuid']=@str_replace(".","_",$health_education->uuid);
			$he[$i]['activity_time']=$health_education->activity_time?adodb_date("Y-m-d",$health_education->activity_time):"";
			$he[$i]['activity_address']=$health_education->activity_address;
			$he[$i]['sponsor']=$health_education->sponsor;
			$he[$i]['person_num']=$health_education->person_num;
			$he[$i]['person_in_charge']=get_staff_name_byid($health_education->person_in_charge);
			$i++;
		}
		$out = $links->subPageCss2();
		$this->view->assign("page",$pageCurrent);
		$this->view->assign("pager",$out);
		$this->view->assign("he",$he);
		$this->view->assign("search_array",$search);
		$this->view->display("index.html");
	}
	/**
	 * 编辑展示页面
	 */
	public function addAction()
	{
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
		//获取机构ID
		$org_id=$this->user['org_id'];
		//获取医生ID
		$staff_id=$this->user['uuid'];
		//医生列表
        $doctor_list=get_doctor_list($this->user['current_region_path_domain'],$this->user['uuid']);
        //负责医生
		$this->view->response_doctor=$doctor_list;
        //填表医生列表
		$this->view->people_fillin_form=$doctor_list;
        //初始化填表时间
        $this->view->assign("updated",adodb_date("Y-m-d",time()));
		$this->view->assign("health_more_info",$health_more_info);
		$this->view->assign("he_active_type",$he_active_type);
        $this->view->assign("refer",$this->_request->getParam("refer",''));
		$this->view->display('add.html');
	}
	/**
	 * 编辑页面
	 */
	public function editAction()
	{
		//获取机构ID
		$org_id=$this->user['org_id'];
		//获取医生ID
		$staff_id=$this->user['uuid'];
		$uuid=$this->_request->getParam("uuid",'');
		if ($uuid!="")
		{
			require_once __SITEROOT."library/Models/health_education.php";
			$health_education=new Thealth_education();
			$health_education->whereAdd("uuid='$uuid'");
			$health_education->find(true);
			//格式化时间
			$health_education->activity_time=$health_education->activity_time?adodb_date("Y-m-d",$health_education->activity_time):"";
			$health_education->updated=$health_education->created?adodb_date("Y-m-d",$health_education->created):"";
			$this->view->health_education=$health_education;
			//负责医生列表
			$this->view->response_doctor=get_doctor_list($this->user['current_region_path_domain'],$health_education->person_in_charge);
            //填表人医生列表
			$this->view->people_fillin_form=get_doctor_list($this->user['current_region_path_domain'],$health_education->people_fillin_form);
			require_once __SITEROOT.'/library/data_arr/arrdata.php';
			$temp=@explode("|",$health_education->more_info);
			foreach ($health_more_info as $k=>$v)
			{
				if (@in_array($v[0],$temp))
				{
					$health_more_info[$k]['check']="checked='checked'";
				}
				else 
				{
					$health_more_info[$k]['check']="";
				}
			}
			$this->view->assign("health_more_info",$health_more_info);
			$temp_type=@explode("|",$health_education->activity_type);
			foreach ($he_active_type as $k=>$v)
			{
				if (@in_array($v[0],$temp_type))
				{
					$he_active_type[$k]['check']="checked='checked'";
				}
				else 
				{
					$he_active_type[$k]['check']="";
				}
			}
			$this->view->assign("he_active_type",$he_active_type);
			$this->view->display('add.html');
		}
		else 
		{
			$url=array("添加记录"=>__BASEPATH.'he/index/add',"返回列表"=>__BASEPATH.'he/index/index');
			message("添加健康教育活动记录表成功",$url);
		}
	}
	/**
	 * 保存数据页面
	 */
	public function saveAction()
	{
		require_once __SITEROOT."library/Models/health_education.php";
		//获取机构ID
		$org_id=$this->user['org_id'];
		//获取医生ID
		$staff_id=$this->user['uuid'];
		$uuid=$this->_request->getParam("uuid",'');	
		$health_education=new Thealth_education();
		$health_education->activity_time = $this->_request->getParam('activity_time')?mkunixstamp($this->_request->getParam('activity_time')):"";//活动时间		
		$health_education->activity_address = $this->_request->getParam('activity_address');//活动地点
		require_once __SITEROOT.'/library/data_arr/arrdata.php';	
		$health_education->activity_type = "";//活动形式
		$temp=array();
		$temp=$this->_request->getParam('activity_type');
		if (!is_empty_for_multi($temp))
		{
			foreach ($temp as $k=>$v)
			{
				$health_education->activity_type=$health_education->activity_type."|".array_code_change($v,$he_active_type);
			}
			$health_education->activity_type=substr($health_education->activity_type,1);
		}		
		$health_education->sponsor = $this->_request->getParam('sponsor');//主办单位		
		$health_education->partner = $this->_request->getParam('partner');//合作伙伴
        $health_education->person_category = $this->_request->getParam('person_category');//接受健康教育人员类别		
		$health_education->person_num = @intval($this->_request->getParam('person_num'));//参与人数		
		$health_education->promo_type = @intval($this->_request->getParam('promo_type'));//宣传品发放种类		
		$health_education->promo_num = @intval($this->_request->getParam('promo_num'));//宣传品发放数量		
		$health_education->activity_theme = trim($this->_request->getParam('activity_theme'));//活动主题		
		$health_education->doctor = trim($this->_request->getParam('doctor'));//宣教人		
		$health_education->active_summary = trim($this->_request->getParam('active_summary'));//活动小结		
		$health_education->activity_juggde = trim($this->_request->getParam('activity_juggde'));//活动评价	
		$temp=array();
		$temp=$this->_request->getParam('more_info');
		$health_education->more_info="";
		if (!is_empty_for_multi($temp))
		{
			foreach ($temp as $k=>$v)
			{
				$health_education->more_info=$health_education->more_info."|".array_code_change($v,$health_more_info);
			}
			$health_education->more_info=substr($health_education->more_info,1);
		}//存档材料	
        $health_education->people_fillin_form = $this->_request->getParam('people_fillin_form');//填表人	
		$health_education->person_in_charge = $this->_request->getParam('person_in_charge');//负责人
		$health_education->created = $this->_request->getParam('updated')?mkunixstamp($this->_request->getParam('updated')):time();//
		if($uuid=="")
		{
			//新增
			$health_education->uuid = uniqid("H_",true);//
			$health_education->staff_id = $staff_id;//
			$health_education->org_id = $org_id;//		
			if($health_education->insert($this->user['uuid']))
			{
                $refer=$this->_request->getParam('refer',"");//处理跳转
                $refer=$refer?base64_decode($refer):"";
                $refer_array=$refer!=""?explode("|",$refer):array("");
                $new_refer=create_refer($refer);
                if($new_refer)
                {
                    $new_refer=$refer_array[0]?__BASEPATH.$refer_array[0]."/refer/".$new_refer:"";
                }
                else
                {
                    $new_refer=$refer_array[0]?__BASEPATH.$refer_array[0]:"";
                }
				$url=array("继续添加"=>__BASEPATH.'he/index/add',"查看记录"=>__BASEPATH.'he/index/index');
				message("添加健康教育活动记录表成功",$url,$new_refer);
			}
			else 
			{
				$url=array("重新添加"=>__BASEPATH.'he/index/add',"返回列表"=>__BASEPATH.'he/index/index');
				message("添加健康教育活动记录表失败。",$url);
			}
		}
		else 
		{
			//编辑
			$health_education->whereAdd("uuid='$uuid'");
			if($health_education->update(array($this->user['uuid'],'updated')))
			{
				$url=array("添加"=>__BASEPATH.'he/index/add',"查看记录"=>__BASEPATH.'he/index/index');
				message("修改健康教育活动记录表成功",$url);
			}
			else 
			{
				$url=array("重新修改"=>__BASEPATH.'he/index/edit/uuid/'.$uuid,"添加记录"=>__BASEPATH.'he/index/add',"返回列表"=>__BASEPATH.'he/index/index');
				message("修改健康教育活动记录表失败。",$url);
			}
		}
	}
	/**
	 * 删除记录
	 */
	public function delAction()
	{
		//获取机构ID
		$org_id=$this->user['org_id'];
		//获取医生ID
		$staff_id=$this->user['uuid'];
		$uuid=$this->_request->getParam("uuid",'');
		if ($staff_id=="" || $uuid!="")
		{
			require_once __SITEROOT."library/Models/health_education.php";
			$health_education=new Thealth_education();
			$health_education->whereAdd("uuid='$uuid'");
			if ($health_education->delete($this->user['uuid']))
			{
				echo "ok";
				exit;
			}
			else 
			{
				echo "failed";
				exit;
			}
		}
		else 
		{
			echo "failed";
			exit;
		}
	}
}