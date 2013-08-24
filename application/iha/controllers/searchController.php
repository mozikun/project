<?php
/**
*@author：我好笨
*@filename: searchController.php
*@package：用于个人档案的查询
*@create：2011-4-18
*/
class iha_searchController extends controller
{
    public function init()
	{
	   $this->view->assign("baseUrl",__BASEPATH);
	   $this->view->assign( "basePath", __BASEPATH );
       require_once __SITEROOT."library/Models/individual_archive.php";
	   require_once __SITEROOT."library/Models/individual_core.php";
       require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
       require_once __SITEROOT . '/library/custom/comm_function.php';
       require_once __SITEROOT."library/Models/clinical_history.php";
    }
    public function indexAction()
    {
        //展示查询界面
        $this->view->display("login_search.html");
    }
    /**
     * iha_searchController::searchAction()
     * 
     * 显示主框架
     * 
     * @return void
     */
    public function searchAction()
    {
        //查询数据
        require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $params['u']=stripslashes($this->_request->getParam("username"));//用户名
        $params['p']=stripslashes($this->_request->getParam("password"));//密码
        $params['c']=isset($_GET['card'])?stripslashes(base64_decode(trim($_GET['card']))):'';//身份证号码
        if(!$params['c'] && !$_POST['card'])
        {
            $this->redirect(__BASEPATH."iha/search/index");
        }
        if(!$params['c'] && $_POST['card'])
        {
            //表单提交
            $params['c']=stripslashes(trim($_POST['card']));
        }
        if($params['c'])
        {
            //通过表单提交，验证密码
            $core=new Tindividual_core();
            $core->whereAdd("identity_number='".$params['c']."'");
            $core->find(true);
            if($core->password=='')
            {
                //密码为空，写入初始密码
                $core=new Tindividual_core();
                $core->password=md5(substr($params['c'],-8,8));
                $core->whereAdd("identity_number='".$params['c']."'");
                $core->update();
            }
            else
            {
                if($core->password!=md5($params['p']) && $params['p'])
                {
                    //密码错误
                    $url=array("个人登录"=>__BASEPATH.'iha/search/index',"健康首页"=>__BASEPATH.'web/default/index');
                    message("对不起，你输入的密码错误",$url);
                }
            }
        }
        $search_session=new Zend_Session_Namespace("iha_search");
        $core=new Tindividual_core();
        $core->whereAdd("identity_number='".$params['c']."'");
        $core->find(true);
        if(!$core->uuid)
        {
            $this->redirect(__BASEPATH."iha/search/index");
        }
        else
        {
            $search_session->org_id=$core->org_id;
            $search_session->id=$core->uuid;
            $search_session->name=$core->name;
            $search_session->birth_day=date('Y-m-d',$core->date_of_birth);
            $search_session->sex=@$sex[array_search_for_other($core->sex, $sex)][1];
            $search_session->identity_number=$core->identity_number;
            $search_session->age=getBirthday($core->date_of_birth, time());
            $search_session->phone=$core->phone_number;
            $search_session->address=$core->address;
        }
        $this->view->params=$params;
        $this->view->title="区域卫生信息平台-居民公众平台-四川雅安";
        $this->view->display("index.html");
    }
    /*
	 * 顶部
	 */
	public function topAction()
	{
		$this->view->timer=date("Y年m月d日 H时i分");
		$this->view->display("top.html");
	}
	/*
	 * 左菜单
	 * @author mask
	 */
	public function leftdhAction()
	{
        //取医疗模块
        require_once __SITEROOT."library/Models/api_module.php";
        $api_module=new Tapi_module();
        $api_module->whereAdd("module_id!='HRA00.01.01'");
        $api_module->find();
        $i=0;
        $menu_url=array();
        while($api_module->fetch())
        {
            $menu_url[$i]['module_id']=base64_encode($api_module->module_id);
            $menu_url[$i]['module_name']=$api_module->module_name;
            $i++;
        }
		
        $this->view->menu_url=$menu_url;
		$this->view->display("left_menu.html");
	}
	/**
	 * 左间隔
	 */
	public function leftshowAction()
	{
		$this->view->display("left_show.html");
	}
	/**
	 * 右上状态栏
	 */
	public function righttopAction()
	{
		//显示当前病人
        $search_session=new Zend_Session_Namespace("iha_search");
        $this->view->user=$search_session;
		$this->view->display("right_top.html");
	}
    /**
     * iha_searchController::mainAction()
     * 
     * 显示右主界面
     * 
     * @return void
     */
    public function mainAction()
    {
        //展示查询结果
        require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT."library/securimage/securimage.php";
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
        require_once __SITEROOT.'/library/data_arr/arrdata.php';
        
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        if($card)
        {
            if(!$card)
            {
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，请输入你的身份证号码",$url);
            }
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            //$individual_core->whereAdd("name='$username'");
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $individual_core->sex=@$sex[array_search_for_other($individual_core->sex,$sex)][1];
                $individual_core->age=getBirthday($individual_core->date_of_birth,time());
                $individual_core->date_of_birth=adodb_date("Y-m-d",$individual_core->date_of_birth);
                $org_id=$individual_core->org_id;
                $individual_core->filing_time=$individual_core->filing_time?date('Y-m-d',$individual_core->filing_time):'';
                $this->view->core=$individual_core;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                $individual_core->card= @$card_status[array_search_for_other($individual_core->card_status, $card_status)][1];
                //头像
                if(file_exists(__SITEROOT."upload/".$uuid.".gif"))
                {
                    $this->view->assign("headpic",__BASEPATH."upload/".$uuid.".gif");
                }
                else
                {
                    $this->view->assign("headpic","");
                }
                $individual_core->free_statement();
                //读取血型
				require_once __SITEROOT.'/library/Models/blood_type.php';
				$blood=new Tblood_type();
				$blood->whereAdd("id='$uuid'");
				//$blood->whereAdd("org_id='$org_id'");
				$blood->find(true);
				$abo_bloodtype=$blood->abo_bloodtype;
                if($abo_bloodtype)
                {
                    $blood->abo_bloodtype=$ABO_bloodtype[$abo_bloodtype][1];
                }
                else
                {
                    $blood->abo_bloodtype="未说明";
                }
                $blood->free_statement();
				$this->view->assign("blood",$blood);
                
                //取管理医生
                require_once __SITEROOT."library/Models/staff_core.php";
                require_once __SITEROOT."library/Models/staff_archive.php";
                require_once __SITEROOT."library/Models/organization.php";
                $staff_core=new Tstaff_core();
                $staff=new Tstaff_archive();
                $org=new Torganization();
                $staff_core->joinAdd('left',$staff_core,$staff,'id','user_id');
                $staff_core->joinAdd('left',$staff_core,$org,'org_id','id');
                $staff_core->whereAdd("staff_core.id='$staff_id'");
                $staff_core->find(true);
                $staff_array=array();
                $staff_array['name']=$staff->name_real;
                $staff_array['org']=$org->zh_name;
                $staff_array['phone']=$staff->telephone_number;
                $staff_core->free_statement();
                $this->view->staff_array=$staff_array;
                //取智能提示
                $clinical_history=new Tclinical_history();
                $clinical_history->whereAdd("id='$uuid'");
                $clinical_history->whereAdd("disease_state='1'");
                $clinical_history->find();
                $tips_code=array();
                while($clinical_history->fetch())
                {
                    $tips_code[]=$clinical_history->disease_code;
                }
                $this->view->tips_code=$tips_code;
                //取提醒内容
                $tips_count=0;
                require_once __SITEROOT."library/Models/tips.php";
                require_once __SITEROOT."library/Models/tips_type.php";
                $tips=new Ttips();
                $tips_type=new Ttips_type();
                $tips->joinAdd('left',$tips,$tips_type,'tips_type','id');
                $tips->whereAdd("tips.id='$uuid'");
                $tips->whereAdd("tips.state='0'");//未完成
                $tips->orderBy("tips.tips_time DESC");
                $tips_count=$tips->count();
                $this->view->tips_count=$tips_count;
            }
            else
            {
                //没找到人
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，没有查找到您的信息，请检查姓名和身份证是否正确",$url);
            }
            $this->view->card=base64_encode($card);
            $this->view->identity_number=$card;
            $this->view->display("search_base.html");
        }
        else
        {
            //验证码错误
            $url=array("重新查询"=>__BASEPATH.'iha/search/index');
			message("对不起，验证码校验错误，请重新输入",$url);
        }
    }
    /**
     * iha_searchController::familyAction()
     * 
     * 显示家庭信息
     * 
     * @return void
     */
    public function familyAction()
    {
        //展示查询结果
        require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT."library/securimage/securimage.php";
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        if($card)
        {
            if(!$card)
            {
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，请输入你的身份证号码",$url);
            }
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $org_id=$individual_core->org_id;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                //取家庭成员信息
                require_once __SITEROOT."library/Models/family_archive.php";
                $family_core=new Tindividual_core();
                $family_core->whereAdd("family_number='$family_number'");
                $family_core->whereAdd("uuid!='$uuid'");
                $family_core->find();
                $family=array();
                $i=0;
                while($family_core->fetch())
                {
                    $family[$i]['name']=$family_core->name;
                    $family[$i]['realation']=$family_core->relation_holder?$relation_of_householder[array_search_for_other($family_core->relation_holder,$relation_of_householder)][1]:"未说明的关系";
                    $family[$i]['phone_number']=$family_core->phone_number;
                    $family[$i]['address']=$family_core->address;
                    $i++;
                }
                $family_core->free_statement();
                $this->view->family=$family;
            }
            else
            {
                //没找到人
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，没有查找到您的信息，请检查姓名和身份证是否正确",$url);
            }
            $this->view->card=base64_encode($card);
            $this->view->display("search_family.html");
        }
        else
        {
            //验证码错误
            $url=array("重新查询"=>__BASEPATH.'iha/search/index');
			message("对不起，验证码校验错误，请重新输入",$url);
        }
    }
    /**
     * iha_searchController::tipsAction()
     * 
     * 近期提醒信息
     * 
     * @return void
     */
    public function tipsAction()
    {
        //展示查询结果
        require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT."library/securimage/securimage.php";
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        if($card)
        {
            if(!$card)
            {
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，请输入你的身份证号码",$url);
            }
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $org_id=$individual_core->org_id;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                //取近期提醒
                require_once __SITEROOT."library/Models/tips.php";
                require_once __SITEROOT."library/Models/tips_type.php";
                $tips=new Ttips();
                $tips_type=new Ttips_type();
                $tips->joinAdd('left',$tips,$tips_type,'tips_type','id');
                $tips->whereAdd("tips.id='$uuid'");
                $tips->whereAdd("tips.state='0'");//未完成
                $tips->orderBy("tips.tips_time DESC");
                $tips->limit(0,30);
                $tips->find();
                $tips_array=array();
                $i=0;
                while($tips->fetch())
                {
                    $tips_array[$i]['tips_name']=$tips->title;
                    $tips_array[$i]['tips_type']=$tips_type->tipszh_name;
                    $tips_array[$i]['tips_time']=$tips->tips_time?adodb_date("Y-m-d",$tips->tips_time):"未指定日期";
                    $i++;
                }
                $tips->free_statement();
                $this->view->tips_array=$tips_array;
            }
            else
            {
                //没找到人
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，没有查找到您的信息，请检查姓名和身份证是否正确",$url);
            }
            $this->view->card=base64_encode($card);
            $this->view->display("search_tips.html");
        }
        else
        {
            //验证码错误
            $url=array("重新查询"=>__BASEPATH.'iha/search/index');
			message("对不起，验证码校验错误，请重新输入",$url);
        }
    }
    /**
     * iha_searchController::tigeAction()
     * 
     * 体格检查
     * 
     * @return void
     */
    public function tigeAction()
    {
        //展示查询结果
        require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT."library/securimage/securimage.php";
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        if($card)
        {
            if(!$card)
            {
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，请输入你的身份证号码",$url);
            }
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $org_id=$individual_core->org_id;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                //取体格检查数据
                require_once __SITEROOT."library/Models/physical_base.php";
                $physical_base=new Tphysical_base();
                $physical_base->whereAdd("id='$uuid'");
                $physical_base->orderBy("created DESC");
                $physical_base->limit(0,30);
                $physical_base->find();
                $physical=array();
                $i=0;
                while($physical_base->fetch())
                {
                    $physical[$i]['height']=$physical_base->height;
                    $physical[$i]['weight']=$physical_base->weight;
                    $physical[$i]['s_blood_pressure']=$physical_base->s_blood_pressure;
                    $physical[$i]['p_blood_pressure']=$physical_base->p_blood_pressure;
                    $physical[$i]['blood_sugar']=$physical_base->blood_sugar;
                    $i++;
                }
                $physical_base->free_statement();
                $this->view->physical=$physical;
            }
            else
            {
                //没找到人
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，没有查找到您的信息，请检查姓名和身份证是否正确",$url);
            }
            $this->view->card=base64_encode($card);
            $this->view->display("search_tige.html");
        }
        else
        {
            //验证码错误
            $url=array("重新查询"=>__BASEPATH.'iha/search/index');
			message("对不起，验证码校验错误，请重新输入",$url);
        }
    }
    /**
     * iha_searchController::cdAction()
     * 
     * 慢病情况
     * 
     * @return void
     */
    public function cdAction()
    {
        //展示查询结果
        require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT."library/securimage/securimage.php";
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        if($card)
        {
            if(!$card)
            {
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，请输入你的身份证号码",$url);
            }
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $org_id=$individual_core->org_id;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                //取慢病记录
                //高血压
                require_once __SITEROOT."library/Models/hypertension_follow_up.php";
                $hy=new Thypertension_follow_up();
                $hy->whereAdd("id='$uuid'");
                $hy_count=$hy->count("id");
                $hy->free_statement();
                $this->view->hy_count=$hy_count;
                //取最后一次随访记录
                $hy=new Thypertension_follow_up();
                $hy->whereAdd("id='$uuid'");
                $hy->orderBy("follow_time DESC");
                $hy->find(true);
                $hy->follow_time=$hy->follow_time?adodb_date("Y-m-d",$hy->follow_time):"未指定日期";
                $hy->follow_next_time=$hy->follow_next_time?adodb_date("Y-m-d",$hy->follow_next_time):"未指定日期";
                $hy->free_statement();
                $this->view->hy=$hy;
                //糖尿病
                require_once __SITEROOT."library/Models/diabetes_core.php";
                $di=new Tdiabetes_core();
                $di->whereAdd("id='$uuid'");
                $di_count=$di->count("id");
                $di->free_statement();
                $this->view->di_count=$di_count;
                //取最后一次随访记录
                $di=new Tdiabetes_core();
                $di->whereAdd("id='$uuid'");
                $di->orderBy("created DESC");
                $di->find(true);
                $di->followup_time=$di->followup_time?adodb_date("Y-m-d",$di->followup_time):"未指定日期";
                $di->time_of_next_followup=$di->time_of_next_followup?adodb_date("Y-m-d",$di->time_of_next_followup):"未指定日期";
                $di->free_statement();
                $this->view->di=$di;
                //重性精神分裂
                require_once __SITEROOT."library/Models/schizophrenia.php";
                $sc=new Tschizophrenia();
                $sc->whereAdd("id='$uuid'");
                $sc_count=$sc->count("id");
                $sc->free_statement();
                $this->view->sc_count=$sc_count;
                //取最后一次随访记录
                $sc=new Tschizophrenia();
                $sc->whereAdd("id='$uuid'");
                $sc->orderBy("created DESC");
                $sc->find(true);
                $sc->fllowup_time=$sc->fllowup_time?adodb_date("Y-m-d",$sc->fllowup_time):"未指定日期";
                $sc->next_followup_time=$sc->next_followup_time?adodb_date("Y-m-d",$sc->next_followup_time):"未指定日期";
                $sc->free_statement();
                $this->view->sc=$sc;
            }
            else
            {
                //没找到人
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，没有查找到您的信息，请检查姓名和身份证是否正确",$url);
            }
            $this->view->card=base64_encode($card);
            $this->view->display("search_cd.html");
        }
        else
        {
            //验证码错误
            $url=array("重新查询"=>__BASEPATH.'iha/search/index');
			message("对不起，验证码校验错误，请重新输入",$url);
        }
    }
    /**
     * iha_searchController::clinicalAction()
     * 
     * 疾病史
     * 
     * @return void
     */
    public function clinicalAction()
    {
        //展示查询结果
        require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT."library/securimage/securimage.php";
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        if($card)
        {
            if(!$card)
            {
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，请输入你的身份证号码",$url);
            }
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $org_id=$individual_core->org_id;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                //查询个人疾病史
                require_once __SITEROOT."library/Models/clinical_history.php";
                $clinical_history=new Tclinical_history();
                $clinical_history->whereAdd("id='$uuid'");
                $clinical_history->whereAdd("disease_state='1'");
                //$clinical_history->whereAdd("disease_date!=''");
                $clinical_history->orderBy("disease_date DESC");
                $clinical_history->find();
                $i=0;
                $clinical_array=array();
                while($clinical_history->fetch())
                {
                    $code="";
                    if ($clinical_history->disease_code=="-99")
					{
						$code=array_search_for_other("-99",$disease_history);
					}
					else
					{
						$code=array_search_for_other($clinical_history->disease_code,$disease_history);
					}
                    if($code)
                    {
                        $clinical_array[$i]['disease_name']=$disease_history[$code][1];
                    }
                    $clinical_array[$i]['disease_code']=$code;
                    $clinical_array[$i]['disease_date']=$clinical_history->disease_date?adodb_date("Y-m-d",$clinical_history->disease_date):"未指定日期";
                    $i++;
                }
                $clinical_history->free_statement();
                $this->view->clinical_array=$clinical_array;
            }
            else
            {
                //没找到人
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，没有查找到您的信息，请检查姓名和身份证是否正确",$url);
            }
            $this->view->card=base64_encode($card);
            $this->view->display("search_clinical.html");
        }
        else
        {
            //验证码错误
            $url=array("重新查询"=>__BASEPATH.'iha/search/index');
			message("对不起，验证码校验错误，请重新输入",$url);
        }
    }
    /**
     * iha_searchController::heAction()
     * 
     * 健康教育内容
     * 
     * @return void
     */
    public function heAction()
    {
        //展示查询结果
        require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT."library/securimage/securimage.php";
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        if($card)
        {
            if(!$card)
            {
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，请输入你的身份证号码",$url);
            }
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $org_id=$individual_core->org_id;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                //查询个人疾病史
                require_once __SITEROOT."library/Models/clinical_history.php";
                $clinical_history=new Tclinical_history();
                $clinical_history->whereAdd("id='$uuid'");
                $clinical_history->whereAdd("disease_state='1'");
                //$clinical_history->whereAdd("disease_date!=''");
                $clinical_history->orderBy("disease_date DESC");
                $clinical_history->find();
                $i=0;
                $clinical_array=array();
                while($clinical_history->fetch())
                {
                    $code="";
                    if ($clinical_history->disease_code=="-99")
					{
						$code=array_search_for_other("-99",$disease_history);
					}
					else
					{
						$code=array_search_for_other($clinical_history->disease_code,$disease_history);
					}
                    if($code)
                    {
                        $clinical_array[$i]['disease_name']=$disease_history[$code][1];
                    }
                    $clinical_array[$i]['disease_code']=$code;
                    $clinical_array[$i]['disease_date']=$clinical_history->disease_date?adodb_date("Y-m-d",$clinical_history->disease_date):"未指定日期";
                    $i++;
                }
                $clinical_history->free_statement();
                $clinical_history=new Tclinical_history();
                $clinical_history->whereAdd("id='$uuid'");
                $clinical_history->whereAdd("disease_state='1'");
                $clinical_history->whereAdd("disease_code='2' or disease_code='3' or disease_code='8'");
                if($clinical_history->count())
                {
                    //读取健康教育活动记录
                    require_once __SITEROOT."library/Models/health_education.php";
                    $health_education=new Thealth_education();
                    $health_education->whereAdd("org_id='$org_id'");
                    foreach($clinical_array as $k=>$v)
                    {
                        //不同的慢病读取不同的健康教育活动
                        if($v['disease_code']=='2')
                        {
                            $health_education->whereAdd("person_category like '%慢病%' or person_category like '%高血压%'");
                        }
                        if($v['disease_code']=='3')
                        {
                            $health_education->whereAdd("person_category like '%慢病%' or person_category like '%糖尿病%'");
                        }
                        if($v['disease_code']=='8')
                        {
                            $health_education->whereAdd("person_category like '%慢病%' or person_category like '%精神分裂%'");
                        }
                    }
                    $health_education->find();
                    $health=array();
                    $i=0;
                    while($health_education->fetch())
                    {
                        $health[$i]['time']=$health_education->activity_time?date("Y-m-d",$health_education->activity_time):'';
                        $health[$i]['address']=$health_education->activity_address;
                        $temp_type=@explode("|",$health_education->activity_type);
                        $health[$i]['xingshi']='';
            			foreach ($temp_type as $k=>$v)
            			{
            				$health[$i]['xingshi'].=$he_active_type[$v][1].",";
            			}
                        $health[$i]['xingshi']=rtrim($health[$i]['xingshi'],',');
                        $health[$i]['ziliao']=$health_education->promo_type;
                        $health[$i]['doctor']=$this->get_doctor($health_education->person_in_charge);
                        $i++;
                    }
                    $this->view->health=$health;
                    $health_education->free_statement();
                }
            }
            else
            {
                //没找到人
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，没有查找到您的信息，请检查姓名和身份证是否正确",$url);
            }
            $this->view->card=base64_encode($card);
            $this->view->display("search_he.html");
        }
        else
        {
            //验证码错误
            $url=array("重新查询"=>__BASEPATH.'iha/search/index');
			message("对不起，验证码校验错误，请重新输入",$url);
        }
    }
	/**
     * iha_searchController::prescriptionAction()
     * 
     * 健康教育处方
     * 
     * @return void
     */
	public function prescriptionAction(){
		
		 require_once __SITEROOT."library/Models/health_prescription.php";
		 $prescription=new Thealth_prescription();
		 $prescription->whereAdd("title is not null and content is not null");
		 $org_id=$_SESSION['iha_search']['org_id'];
		 $prescription->whereAdd("status_type=2 or org_id='$org_id'");
		 $result=array();
		 $index=0;
		 $prescription->find();
		 while($prescription->fetch()){
			$result[$index]=$prescription->toArray();
			$index++;
		 }
		 $this->view->result=$result;
		 $this->view->display("prescription.html");
		 
	}
    /**
     * iha_searchController::bloodAction()
     * 
     * 血压监测界面展示
     * 
     * @return void
     */
    public function bloodAction()
    {
        //展示查询结果
        require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT."library/securimage/securimage.php";
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        if($card)
        {
            if(!$card)
            {
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，请输入你的身份证号码",$url);
            }
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $org_id=$individual_core->org_id;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                //取近期血压信息
                $this->view->uuid=$individual_core->uuid;
            }
            else
            {
                //没找到人
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，没有查找到您的信息，请检查姓名和身份证是否正确",$url);
            }
            $this->view->card=base64_encode($card);
            $this->view->display("search_blood.html");
        }
        else
        {
            //验证码错误
            $url=array("重新查询"=>__BASEPATH.'iha/search/index');
			message("对不起，验证码校验错误，请重新输入",$url);
        }
    }
    /**
     * iha_searchController::bloodinAction()
     * 
     * 血压值写入表，并返回状态
     * 
     * @return void
     */
    public function bloodinAction()
    {
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        if($card)
        {
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $org_id=$individual_core->org_id;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                $s_blood=floatval($this->_request->getParam('s_blood'));
                $p_blood=floatval($this->_request->getParam('p_blood'));
                require_once __SITEROOT."library/Models/physical_base.php";
                $physical_base=new Tphysical_base();
                $physical_base->uuid=uniqid('p_',true);
                $physical_base->staff_id=$staff_id;
                $physical_base->id=$uuid;
                $physical_base->created=time();
                $physical_base->s_blood_pressure=$s_blood;
                $physical_base->p_blood_pressure=$p_blood;
                $physical_base->org_id=$org_id;
                if($physical_base->insert())
                {
                    //判断是否发送短信
                    $chk=$this->_request->getParam('chk');
                    if($chk)
                    {
                        require_once(__SITEROOT.'library/sms.php');//发短信库
                        $sms=new SMS();
                        $sms_date= date("Y-m-d H:i:s");
                        $uuid=uniqid('s_',true);
                        require_once __SITEROOT."library/Models/staff_archive.php";
                        $staff=new Tstaff_archive();
                        $staff->whereAdd("user_id='$staff_id'");
                        $staff->find(true);
                        $phone_number=$staff->mobile_telephone_number;
                        $msg=$this->_request->getParam('msg');
                        $sms_content="居民：".$individual_core->name."(身份证后4位:".substr($individual_core->identity_number,-4,4)."),电话号码:".$individual_core->phone_number."，血压自我监测中发现：收缩压：".$s_blood."mmHg,舒张压：".$p_blood."mmHg，".$msg.",请及时与我联系";
    				    $sms_status=$sms->sendSMS($uuid,$phone_number,$sms_content,$sms_date);//发送短信
                    }
                    exit('ok');
                }
                else
                {
                    exit('error');
                }
            }
            else
            {
                exit('error');
            }
            $this->view->card=base64_encode($card);
            $this->view->display("search_blood.html");
        }
        else
        {
            exit('error');
        }
    }
    /**
     * iha_searchController::xtAction()
     * 
     * 血糖自我监测界面
     * 
     * @return void
     */
    public function xtAction()
    {
        //展示查询结果
        require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT."library/securimage/securimage.php";
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        if($card)
        {
            if(!$card)
            {
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，请输入你的身份证号码",$url);
            }
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $org_id=$individual_core->org_id;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                //取近期血糖信息
                $this->view->uuid=$individual_core->uuid;
            }
            else
            {
                //没找到人
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，没有查找到您的信息，请检查姓名和身份证是否正确",$url);
            }
            $this->view->card=base64_encode($card);
            $this->view->display("search_xt.html");
        }
        else
        {
            //验证码错误
            $url=array("重新查询"=>__BASEPATH.'iha/search/index');
			message("对不起，验证码校验错误，请重新输入",$url);
        }
    }
    /**
     * iha_searchController::xtinAction()
     * 
     * 空腹血糖值写入表，并返回状态
     * 
     * @return void
     */
    public function xtinAction()
    {
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        if($card)
        {
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $org_id=$individual_core->org_id;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                $blood_sugar=floatval($this->_request->getParam('xt'));
                require_once __SITEROOT."library/Models/physical_base.php";
                $physical_base=new Tphysical_base();
                $physical_base->uuid=uniqid('p_',true);
                $physical_base->staff_id=$staff_id;
                $physical_base->id=$uuid;
                $physical_base->created=time();
                $physical_base->blood_sugar=$blood_sugar;
                $physical_base->org_id=$org_id;
                if($physical_base->insert())
                {
                    exit('ok');
                }
                else
                {
                    exit('error');
                }
            }
            else
            {
                exit('error');
            }
            $this->view->card=base64_encode($card);
            $this->view->display("search_blood.html");
        }
        else
        {
            exit('error');
        }
    }
    /**
     * iha_searchController::tmpAction()
     * 
     * 备份原控制器内容
     * 
     * @return void
     */
    public function tmpAction()
    {
        //展示查询结果
        require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT."library/securimage/securimage.php";
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $img = new securimage();
        //if($img->check($this->_request->getParam("pic")))
        if(1)
        {
            //查询数据
            $username=stripslashes($this->_request->getParam("username"));//用户名
            $password=stripslashes($this->_request->getParam("password"));//密码
            $card=stripslashes($this->_request->getParam("card"));//身份证号码
            //测试数据
            //$username="陈建军";
            //$card="513101198601143818";
            /*if(!$username)
            {
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，请输入你要查询的姓名",$url);
            }*/
            /*if(!$password)
            {
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，请输入你的密码，没有设置密码可以通过发送短信获取",$url);
            }*/
            if(!$card)
            {
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，请输入你的身份证号码",$url);
            }
            //2011-12-10 根据身份证号读取静态文件，临时任务，作弊
            $temp_card_array=array('513101195511251926');//记录需要查询的几个人身份证
            $yx_array=array();
            if(in_array($card,$temp_card_array))
            {
                for($i=0;$i<2;$i++)
                {
                    $yx_array[$i]['pic']=$card.'_'.$i.'.jpg';
                }
            }
            $this->view->yx_array=$yx_array;
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            //$individual_core->whereAdd("name='$username'");
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $individual_core->sex=@$sex[array_search_for_other($individual_core->sex,$sex)][1];
                $individual_core->age=getBirthday($individual_core->date_of_birth,time());
                $individual_core->date_of_birth=adodb_date("Y-m-d",$individual_core->date_of_birth);
                $org_id=$individual_core->org_id;
                $this->view->core=$individual_core;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                //头像
                if(file_exists(__SITEROOT."upload/".$uuid.".gif"))
                {
                    $this->view->assign("headpic",__BASEPATH."upload/".$uuid.".gif");
                }
                else
                {
                    $this->view->assign("headpic","");
                }
                $individual_core->free_statement();
                //读取血型
				require_once __SITEROOT.'/library/Models/blood_type.php';
				$blood=new Tblood_type();
				$blood->whereAdd("id='$uuid'");
				//$blood->whereAdd("org_id='$org_id'");
				$blood->find(true);
				$abo_bloodtype=$blood->abo_bloodtype;
                if($abo_bloodtype)
                {
                    $blood->abo_bloodtype=$ABO_bloodtype[$abo_bloodtype][1];
                }
                else
                {
                    $blood->abo_bloodtype="未说明";
                }
                $blood->free_statement();
				$this->view->assign("blood",$blood);
                //取近期提醒
                require_once __SITEROOT."library/Models/tips.php";
                require_once __SITEROOT."library/Models/tips_type.php";
                $tips=new Ttips();
                $tips_type=new Ttips_type();
                $tips->joinAdd('left',$tips,$tips_type,'tips_type','id');
                $tips->whereAdd("tips.id='$uuid'");
                $tips->whereAdd("tips.state='0'");//未完成
                $tips->orderBy("tips.tips_time DESC");
                $tips->limit(0,6);
                $tips->find();
                $tips_array=array();
                $i=0;
                while($tips->fetch())
                {
                    $tips_array[$i]['tips_name']=$tips->title;
                    $tips_array[$i]['tips_type']=$tips_type->tipszh_name;
                    $tips_array[$i]['tips_time']=$tips->tips_time?adodb_date("Y-m-d",$tips->tips_time):"未指定日期";
                    $i++;
                }
                $tips->free_statement();
                $this->view->tips_array=$tips_array;
                //查询个人疾病史
                require_once __SITEROOT."library/Models/clinical_history.php";
                $clinical_history=new Tclinical_history();
                $clinical_history->whereAdd("id='$uuid'");
                $clinical_history->whereAdd("disease_state='1'");
                //$clinical_history->whereAdd("disease_date!=''");
                $clinical_history->orderBy("disease_date DESC");
                $clinical_history->find();
                $i=0;
                $clinical_array=array();
                while($clinical_history->fetch())
                {
                    $code="";
                    if ($clinical_history->disease_code=="-99")
					{
						$code=array_search_for_other("-99",$disease_history);
					}
					else
					{
						$code=array_search_for_other($clinical_history->disease_code,$disease_history);
					}
                    if($code)
                    {
                        $clinical_array[$i]['disease_name']=$disease_history[$code][1];
                    }
                    $clinical_array[$i]['disease_code']=$code;
                    $clinical_array[$i]['disease_date']=$clinical_history->disease_date?adodb_date("Y-m-d",$clinical_history->disease_date):"未指定日期";
                    $i++;
                }
                $clinical_history->free_statement();
                $this->view->clinical_array=$clinical_array;
                //取家庭成员信息
                require_once __SITEROOT."library/Models/family_archive.php";
                $family_core=new Tindividual_core();
                $family_core->whereAdd("family_number='$family_number'");
                $family_core->whereAdd("uuid!='$uuid'");
                $family_core->find();
                $family=array();
                $i=0;
                while($family_core->fetch())
                {
                    $family[$i]['name']=$family_core->name;
                    $family[$i]['realation']=$family_core->relation_holder?$relation_of_householder[array_search_for_other($family_core->relation_holder,$relation_of_householder)][1]:"未说明的关系";
                    $family[$i]['phone_number']=$family_core->phone_number;
                    $family[$i]['address']=$family_core->address;
                    $i++;
                }
                $family_core->free_statement();
                $this->view->family=$family;
                //取管理医生
                require_once __SITEROOT."library/Models/staff_core.php";
                require_once __SITEROOT."library/Models/staff_archive.php";
                require_once __SITEROOT."library/Models/organization.php";
                $staff_core=new Tstaff_core();
                $staff=new Tstaff_archive();
                $org=new Torganization();
                $staff_core->joinAdd('left',$staff_core,$staff,'id','user_id');
                $staff_core->joinAdd('left',$staff_core,$org,'org_id','id');
                $staff_core->whereAdd("staff_core.id='$staff_id'");
                $staff_core->find(true);
                $staff_array=array();
                $staff_array['name']=$staff->name_real;
                $staff_array['org']=$org->zh_name;
                $staff_array['phone']=$staff->telephone_number;
                $staff_core->free_statement();
                $this->view->staff_array=$staff_array;
                //取体格检查数据
                require_once __SITEROOT."library/Models/physical_base.php";
                $physical_base=new Tphysical_base();
                $physical_base->whereAdd("id='$uuid'");
                $physical_base->orderBy("created DESC");
                $physical_base->limit(0,6);
                $physical_base->find();
                $physical=array();
                $i=0;
                while($physical_base->fetch())
                {
                    $physical[$i]['height']=$physical_base->height;
                    $physical[$i]['weight']=$physical_base->weight;
                    $physical[$i]['s_blood_pressure']=$physical_base->s_blood_pressure;
                    $physical[$i]['p_blood_pressure']=$physical_base->p_blood_pressure;
                    $i++;
                }
                $physical_base->free_statement();
                $this->view->physical=$physical;
                //取慢病记录
                //高血压
                require_once __SITEROOT."library/Models/hypertension_follow_up.php";
                $hy=new Thypertension_follow_up();
                $hy->whereAdd("id='$uuid'");
                $hy_count=$hy->count("id");
                $hy->free_statement();
                $this->view->hy_count=$hy_count;
                //取最后一次随访记录
                $hy=new Thypertension_follow_up();
                $hy->whereAdd("id='$uuid'");
                $hy->orderBy("follow_time DESC");
                $hy->find(true);
                $hy->follow_time=$hy->follow_time?adodb_date("Y-m-d",$hy->follow_time):"未指定日期";
                $hy->follow_next_time=$hy->follow_next_time?adodb_date("Y-m-d",$hy->follow_next_time):"未指定日期";
                $hy->free_statement();
                $this->view->hy=$hy;
                //糖尿病
                require_once __SITEROOT."library/Models/diabetes_core.php";
                $di=new Tdiabetes_core();
                $di->whereAdd("id='$uuid'");
                $di_count=$di->count("id");
                $di->free_statement();
                $this->view->di_count=$di_count;
                //取最后一次随访记录
                $di=new Tdiabetes_core();
                $di->whereAdd("id='$uuid'");
                $di->orderBy("created DESC");
                $di->find(true);
                $di->followup_time=$di->followup_time?adodb_date("Y-m-d",$di->followup_time):"未指定日期";
                $di->time_of_next_followup=$di->time_of_next_followup?adodb_date("Y-m-d",$di->time_of_next_followup):"未指定日期";
                $di->free_statement();
                $this->view->di=$di;
                //重性精神分裂
                require_once __SITEROOT."library/Models/schizophrenia.php";
                $sc=new Tschizophrenia();
                $sc->whereAdd("id='$uuid'");
                $sc_count=$sc->count("id");
                $sc->free_statement();
                $this->view->sc_count=$sc_count;
                //取最后一次随访记录
                $sc=new Tschizophrenia();
                $sc->whereAdd("id='$uuid'");
                $sc->orderBy("created DESC");
                $sc->find(true);
                $sc->fllowup_time=$sc->fllowup_time?adodb_date("Y-m-d",$sc->fllowup_time):"未指定日期";
                $sc->next_followup_time=$sc->next_followup_time?adodb_date("Y-m-d",$sc->next_followup_time):"未指定日期";
                $sc->free_statement();
                $this->view->sc=$sc;
                //检验结果，门诊与住院病历的摘要信息
                require_once __SITEROOT."library/Models/zaojia_emr.php";
                $emr=new Tzaojia_emr();
                $emr->whereAdd("identity_number='$card'");
                $emr->orderBy("medical_records_time DESC");
                $emr->limit(0,6);
                $emr->find();
                $emr_array=array();
                $i=0;
                while($emr->fetch())
                {
                    $emr_array[$i]['medical_records_time']=$emr->medical_records_time;
                    $emr_array[$i]['complaints']=$emr->complaints;
                    $emr_array[$i]['present_illness']=$emr->present_illness;
                    $emr_array[$i]['physical_t']=$emr->physical_t;
                    $emr_array[$i]['physical_p']=$emr->physical_p;
                    $emr_array[$i]['physical_r']=$emr->physical_r;
                    $emr_array[$i]['physical_general']=$emr->physical_general;
                    $emr_array[$i]['primary_diagnosis']=$emr->primary_diagnosis;
                    $i++;
                }
                $emr->free_statement();
                $this->view->emr_array=$emr_array;
                //取检验单记录
                require_once __SITEROOT."library/Models/zj_indicators.php";
                require_once __SITEROOT."library/Models/zj_clinic_lab_exam.php";
                $zj=new Tzj_indicators();
                $zc=new Tzj_clinic_lab_exam();
                $zj->joinAdd('left',$zj,$zc,'lis_id','lis_id');
                $zj->whereAdd("zj_indicators.identity_number='$card'");
                $zj->orderBy("zj_clinic_lab_exam.created DESC");
                $zj->limit(0,100);
                $zj->find();
                $zj_array=array();
                $i=0;
                while($zj->fetch())
                {
                    $zj_array[$zj->lis_id][$i]['zh_name']     = $zj->zh_name;
           	 		$zj_array[$zj->lis_id][$i]['en_name']     = $zj->en_name;
           	 		$zj_array[$zj->lis_id][$i]['exam_result'] = $zj->exam_result;
           	 		$zj_array[$zj->lis_id][$i]['exam_unit']   = $zj->exam_unit;
           	 		$zj_array[$zj->lis_id][$i]['reference']   = $zj->reference;
                    $i++;
                }
                $zj->free();
                $this->view->det_array=$zj_array;
                //取最近8次门诊情况列表一行显示一次门诊时间　机构　医生　患者姓名　疾病名称　门急诊医疗费用　门急诊药品费用　门急诊医保医疗费用　（来自门诊就诊记录表(TB_YL_MZ_Medical_Record)与门诊收费明细表(TB_HIS_MZ_Fee_Detail)
                require_once __SITEROOT."library/Models/tb_his_patinf.php";
                require_once __SITEROOT."library/Models/tb_yl_mz_medical_record.php";
                require_once __SITEROOT."library/Models/tb_his_mz_fee_detail.php";
                $tb_yl_patient_information=new Ttb_his_patinf(2);
                $tb_yl_mz_medical_record=new Ttb_yl_mz_medical_record(2);
                $tb_yl_patient_information->joinAdd('left',$tb_yl_patient_information,$tb_yl_mz_medical_record,'kh','kh');
                $tb_yl_patient_information->joinAdd('left',$tb_yl_patient_information,$tb_yl_mz_medical_record,'klx','klx');
                $tb_yl_patient_information->whereAdd("tb_his_patinf.identity_number='$card'");
                $tb_yl_patient_information->orderby("tb_yl_mz_medical_record.jzksrq desc");
                $tb_yl_patient_information->limit(0,8);
                $tb_yl_patient_information->find();
                $tb_yl_mz_medical_record_array=array();
                $i=0;
                while ($tb_yl_patient_information->fetch())
                {
                	$tb_yl_mz_medical_record_array[$i]['jzksrq']=$tb_yl_mz_medical_record->jzksrq;
                	$tb_yl_mz_medical_record_array[$i]['yljgdm']=get_organization_by_standard_code($tb_yl_mz_medical_record->yljgdm);
                	$tb_yl_mz_medical_record_array[$i]['zzysxm']=$tb_yl_mz_medical_record->zzysxm;
                	$tb_yl_mz_medical_record_array[$i]['hzxm']=$tb_yl_mz_medical_record->hzxm;
                	$tb_yl_mz_medical_record_array[$i]['jzzdmc']=$tb_yl_mz_medical_record->jzzdmc;
                	$tb_yl_mz_medical_record_array[$i]['fee']=$this->get_fee($tb_yl_mz_medical_record->jzlsh);
                	$tb_yl_mz_medical_record_array[$i]['fee_count']=count($tb_yl_mz_medical_record_array[$i]['fee']);
                	$i++;
                }
                $tb_yl_patient_information->free_statement();
                $this->view->tb_yl_mz_medical_record=$tb_yl_mz_medical_record_array;
                //住院情况列表：一行显示一次住院时间　机构　患者姓名　住院医疗费用　住院医保药品费用　住院医保医疗费用（来自陈的模块）
                require_once __SITEROOT."library/Models/tb_yl_zy_medical_record.php";
                require_once __SITEROOT."library/Models/tb_his_zy_fee_detail.php";
                $tb_yl_patient_information=new Ttb_his_patinf(2);
                $tb_yl_zy_medical_record=new Ttb_yl_zy_medical_record(2);
                $tb_yl_patient_information->joinAdd('left',$tb_yl_patient_information,$tb_yl_zy_medical_record,'kh','kh');
                $tb_yl_patient_information->joinAdd('left',$tb_yl_patient_information,$tb_yl_zy_medical_record,'klx','klx');
                $tb_yl_patient_information->whereAdd("tb_his_patinf.identity_number='$card'");
                $tb_yl_patient_information->orderby("tb_yl_zy_medical_record.rysj desc");
                $tb_yl_patient_information->limit(0,8);
                //$tb_yl_patient_information->debugLevel(9);
                $tb_yl_patient_information->find();
                $tb_yl_zy_medical_record_array=array();
                $i=0;
                while ($tb_yl_patient_information->fetch())
                {
                	$tb_yl_zy_medical_record_array[$i]['rysj']=$tb_yl_zy_medical_record->rysj;
                	$tb_yl_zy_medical_record_array[$i]['yljgdm']=get_organization_by_standard_code($tb_yl_patient_information->yljgdm);
                	$tb_yl_zy_medical_record_array[$i]['hzxm']=$tb_yl_patient_information->xm;
                	$tb_yl_zy_medical_record_array[$i]['fee']=$this->get_zy_fee($tb_yl_zy_medical_record->jzlsh);
                	$tb_yl_zy_medical_record_array[$i]['fee_count']=count($tb_yl_zy_medical_record_array[$i]['fee']);
                	$i++;
                }
                $tb_yl_patient_information->free_statement();
                $this->view->tb_yl_zy_medical_record=$tb_yl_zy_medical_record_array;
                //处方显示：门诊处方明细表(TB_CIS_Prescription_Detail)：处方号码，医疗机构，就诊科室名称，开方医生姓名，开方时间，发药数量，用药频次
                require_once __SITEROOT."library/Models/tb_cis_prescription_detail.php";
                $tb_yl_patient_information=new Ttb_his_patinf(2);
                $tb_yl_mz_medical_record=new Ttb_yl_mz_medical_record(2);
                $tb_yl_patient_information->joinAdd('left',$tb_yl_patient_information,$tb_yl_mz_medical_record,'kh','kh');
                $tb_yl_patient_information->joinAdd('left',$tb_yl_patient_information,$tb_yl_mz_medical_record,'klx','klx');
                $tb_yl_patient_information->whereAdd("tb_his_patinf.identity_number='$card'");
                $tb_yl_patient_information->orderby("tb_yl_mz_medical_record.jzksrq desc");
                $tb_yl_patient_information->limit(0,8);
                $tb_yl_patient_information->find();
                $tb_cis_prescription_detail_array=array();
                $i=0;
                while ($tb_yl_patient_information->fetch())
                {
                	$tb_cis_prescription_detail_array[$i]['jzksrq']=$tb_yl_mz_medical_record->jzksrq;
                	$tb_cis_prescription_detail_array[$i]['yljgdm']=get_organization_by_standard_code($tb_yl_mz_medical_record->yljgdm);
                	$tb_cis_prescription_detail_array[$i]['zzysxm']=$tb_yl_mz_medical_record->zzysxm;
                	$tb_cis_prescription_detail_array[$i]['hzxm']=$tb_yl_mz_medical_record->hzxm;
                	$tb_cis_prescription_detail_array[$i]['jzzdmc']=$tb_yl_mz_medical_record->jzzdmc;
                	$tb_cis_prescription_detail_array[$i]['cis']=$this->get_cis($tb_yl_mz_medical_record->jzlsh);
                	$tb_cis_prescription_detail_array[$i]['cis_count']=count($tb_cis_prescription_detail_array[$i]['cis']);
                	$i++;
                }
                $tb_yl_patient_information->free_statement();
                $this->view->tb_cis_prescription_detail=$tb_cis_prescription_detail_array;
                //读取住院病案首页
                require_once __SITEROOT."library/Models/tb_cis_main.php";
                $tb_yl_patient_information=new Ttb_his_patinf(2);
                $tb_cis_main=new Ttb_cis_main(2);
                $tb_yl_patient_information->joinAdd('inner',$tb_yl_patient_information,$tb_cis_main,'kh','kh');
                $tb_yl_patient_information->joinAdd('inner',$tb_yl_patient_information,$tb_cis_main,'klx','klx');
                $tb_yl_patient_information->whereAdd("tb_his_patinf.identity_number='$card'");
                $tb_yl_patient_information->selectAdd("to_char(tb_cis_main.rysj,'YYYY-MM-DD HH24:MI:SS') as rysj,to_char(tb_cis_main.cysj,'YYYY-MM-DD HH24:MI:SS') as cysj");
                $tb_yl_patient_information->orderby("tb_cis_main.rysj desc");
                $tb_yl_patient_information->limit(0,8);
                //$tb_yl_patient_information->debugLevel(4);
                //513125197508192224
                $tb_yl_patient_information->find();
                $tb_cis_mains=array();
                $i=0;
                while($tb_yl_patient_information->fetch())
                {
                    $tb_cis_mains[$i]['rysj']=$tb_cis_main->rysj;
                    $tb_cis_mains[$i]['zycs']=$tb_cis_main->zycs;
                    $tb_cis_mains[$i]['rybq']=$tb_cis_main->rybq;
                    $tb_cis_mains[$i]['ryksmc']=$tb_cis_main->ryksmc;
                    $tb_cis_mains[$i]['cysj']=$tb_cis_main->cysj;
                    $tb_cis_mains[$i]['sjzyts']=$tb_cis_main->sjzyts;
                    $tb_cis_main->yljgdm=trim($tb_cis_main->yljgdm);
                    $tb_cis_mains[$i]['jzlsh']=$tb_cis_main->jzlsh;
                    $tb_cis_mains[$i]['yljgdm']=get_organization_by_standard_code($tb_cis_main->yljgdm);
                    $i++;
                }
                $tb_yl_patient_information->free_statement();
                $this->view->tb_cis_mains=$tb_cis_mains;
                $clinical_history=new Tclinical_history();
                $clinical_history->whereAdd("id='$uuid'");
                $clinical_history->whereAdd("disease_state='1'");
                $clinical_history->whereAdd("disease_code='2' or disease_code='3' or disease_code='8'");
                if($clinical_history->count())
                {
                    //读取健康教育活动记录
                    require_once __SITEROOT."library/Models/health_education.php";
                    $health_education=new Thealth_education();
                    $health_education->whereAdd("org_id='$org_id'");
                    foreach($clinical_array as $k=>$v)
                    {
                        //不同的慢病读取不同的健康教育活动
                        if($v['disease_code']=='2')
                        {
                            $health_education->whereAdd("person_category like '%慢病%' or person_category like '%高血压%'");
                        }
                        if($v['disease_code']=='3')
                        {
                            $health_education->whereAdd("person_category like '%慢病%' or person_category like '%糖尿病%'");
                        }
                        if($v['disease_code']=='8')
                        {
                            $health_education->whereAdd("person_category like '%慢病%' or person_category like '%精神分裂%'");
                        }
                    }
                    $health_education->find();
                    $health=array();
                    $i=0;
                    while($health_education->fetch())
                    {
                        $health[$i]['time']=$health_education->activity_time?date("Y-m-d",$health_education->activity_time):'';
                        $health[$i]['address']=$health_education->activity_address;
                        $temp_type=@explode("|",$health_education->activity_type);
                        $health[$i]['xingshi']='';
            			foreach ($temp_type as $k=>$v)
            			{
            				$health[$i]['xingshi'].=$he_active_type[$v][1].",";
            			}
                        $health[$i]['xingshi']=rtrim($health[$i]['xingshi'],',');
                        $health[$i]['ziliao']=$health_education->promo_type;
                        $health[$i]['doctor']=$this->get_doctor($health_education->person_in_charge);
                        $i++;
                    }
                    $this->view->health=$health;
                    $health_education->free_statement();
                }
            }
            else
            {
                //没找到人
                $url=array("重新查询"=>__BASEPATH.'iha/search/index');
                message("对不起，没有查找到您的信息，请检查姓名和身份证是否正确",$url);
            }
            $this->view->card=base64_encode($card);
            $this->view->display("search_view.html");
        }
        else
        {
            //验证码错误
            $url=array("重新查询"=>__BASEPATH.'iha/search/index');
			message("对不起，验证码校验错误，请重新输入",$url);
        }
    }
    /**
     * iha_searchController::get_doctor()
     * 
     * 取医生名字
     * 
     * @param mixed $doctor_id
     * @return
     */
    protected function get_doctor($doctor_id)
    {
        $staff_core=new Tstaff_core();
        $staff=new Tstaff_archive();
        $staff_core->joinAdd('left',$staff_core,$staff,'id','user_id');
        $staff_core->whereAdd("staff_core.id='$doctor_id'");
        $staff_core->find(true);
        return $staff->name_real;
    }
    /**
     * iha_searchController::cismainAction()
     * 
     * 显示住院病案首页的详细信息，根据就诊流水号确定。
     * 
     * @author 我好笨
     * @return void
     */
    public function cismainAction()
    {
        $id=$this->_request->getParam("id");
        require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT."library/securimage/securimage.php";
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
        require_once __SITEROOT."library/Models/tb_cis_main.php";
        $tb_cis_main=new Ttb_cis_main(2);
        $tb_cis_main->whereAdd("tb_cis_main.jzlsh='$id'");
        $tb_cis_main->selectAdd("to_char(tb_cis_main.rysj,'YYYYMMDDHH24') as rysj,to_char(tb_cis_main.cysj,'YYYYMMDDHH24') as cysj,tb_cis_main.jzlsh as jzlsh,tb_cis_main.yljgdm as yljgdm,tb_cis_main.rylx as rylx,tb_cis_main.kh as kh,tb_cis_main.klx as klx,tb_cis_main.bxlx as bxlx,tb_cis_main.zycs as zycs,tb_cis_main.bah as bah,tb_cis_main.ch as ch,tb_cis_main.rybq as rybq,tb_cis_main.cybq as cybq,tb_cis_main.xm as xm,tb_cis_main.xb as xb,tb_cis_main.csny as csny,tb_cis_main.hyzk as hyzk,tb_cis_main.mz as mz,tb_cis_main.gj as gj,tb_cis_main.csd as csd,tb_cis_main.sfz as sfz,tb_cis_main.lxdh as lxdh,tb_cis_main.gzdw as gzdw,tb_cis_main.gzdwyb as gzdwyb,tb_cis_main.zybm as zybm,tb_cis_main.jzd as jzd,tb_cis_main.hkdh as hkdh,tb_cis_main.dqbm as dqbm,tb_cis_main.qxbm as qxbm,tb_cis_main.jdbm as jdbm,tb_cis_main.lxrxm as lxrxm,tb_cis_main.lxrgx as lxrgx,tb_cis_main.lxrdh as lxrdh,tb_cis_main.lxrtxdz as lxrtxdz,tb_cis_main.ryksbm as ryksbm,tb_cis_main.ryksmc as ryksmc,tb_cis_main.zkksbm1 as zkksbm1,tb_cis_main.zkksmc1 as zkksmc1,tb_cis_main.zkksbm2 as zkksbm2,tb_cis_main.zkksmc2 as zkksmc2,tb_cis_main.zkksbm3 as zkksbm3,tb_cis_main.zkksmc3 as zkksmc3,tb_cis_main.szbq as szbq,tb_cis_main.cyksbm as cyksbm,tb_cis_main.cyksmc as cyksmc,tb_cis_main.sjzyts as sjzyts,tb_cis_main.cyfs as cyfs,tb_cis_main.ryqk as ryqk,tb_cis_main.ryqwyzz as ryqwyzz,tb_cis_main.qzrq as qzrq,tb_cis_main.yygrmc as yygrmc,tb_cis_main.yygrjg as yygrjg,tb_cis_main.mzcyzd as mzcyzd,tb_cis_main.rycyzd as rycyzd,tb_cis_main.sqshzd as sqshzd,tb_cis_main.lcblzd as lcblzd,tb_cis_main.fsblzd as fsblzd,tb_cis_main.sszd as sszd,tb_cis_main.ywgm as ywgm,tb_cis_main.hbsag_jg as hbsag_jg,tb_cis_main.hcvab_jg as hcvab_jg,tb_cis_main.hivab_jg as hivab_jg,tb_cis_main.qjcs as qjcs,tb_cis_main.cgcs as cgcs,tb_cis_main.sfcxwjn as sfcxwjn,tb_cis_main.ssdyl as ssdyl,tb_cis_main.xx as xx,tb_cis_main.hxbsxl as hxbsxl,tb_cis_main.xxbsxl as xxbsxl,tb_cis_main.xjsxl as xjsxl,tb_cis_main.qxsxl as qxsxl,tb_cis_main.qtsxl as qtsxl,tb_cis_main.sxfy as sxfy,tb_cis_main.crbbg as crbbg,tb_cis_main.zlbg as zlbg,tb_cis_main.xsebg as xsebg,tb_cis_main.swbg as swbg,tb_cis_main.qtbg as qtbg,tb_cis_main.sz as sz,tb_cis_main.szqx as szqx,tb_cis_main.szqxdw as szqxdw,tb_cis_main.sjbl as sjbl,tb_cis_main.sj as sj,tb_cis_main.rsmdsc as rsmdsc,tb_cis_main.xsejbsc as xsejbsc,tb_cis_main.chcyl as chcyl,tb_cis_main.xse_xb as xse_xb,tb_cis_main.xse_tz as xse_tz,tb_cis_main.zrysgh as zrysgh,tb_cis_main.zrysxm as zrysxm,tb_cis_main.zzysgh as zzysgh,tb_cis_main.zzysxm as zzysxm,tb_cis_main.zyysgh as zyysgh,tb_cis_main.zyysxm as zyysxm,tb_cis_main.hszgh as hszgh,tb_cis_main.hszxm as hszxm,tb_cis_main.bazl as bazl,tb_cis_main.blh as blh,tb_cis_main.swgbyy as swgbyy,tb_cis_main.swsj as swsj,tb_cis_main.mzysgh as mzysgh,tb_cis_main.mzysxm as mzysxm,tb_cis_main.syfy as syfy,tb_cis_main.sfkyba as sfkyba,tb_cis_main.zyf as zyf,tb_cis_main.zlf as zlf,tb_cis_main.zhf as zhf,tb_cis_main.hlf as hlf,tb_cis_main.ssclf as ssclf,tb_cis_main.jcf as jcf,tb_cis_main.hyf as hyf,tb_cis_main.tsf as tsf,tb_cis_main.spf as spf,tb_cis_main.sxf as sxf,tb_cis_main.syf as syf,tb_cis_main.xyf as xyf,tb_cis_main.zcyf as zcyf,tb_cis_main.zcaf as zcaf,tb_cis_main.qtf as qtf,tb_cis_main.mj as mj,tb_cis_main.xgbz as xgbz,tb_cis_main.ylyl1 as ylyl1,tb_cis_main.ylyl2 as ylyl2 ");
        //$tb_cis_main->debugLevel(5);
        $tb_cis_main->find(true);
        $tb_cis_main->csyear=substr($tb_cis_main->csny,0,4);
        $tb_cis_main->csmonth=substr($tb_cis_main->csny,4,2);
        $tb_cis_main->csday=substr($tb_cis_main->csny,6,2);
        //转换入院时间
        $tb_cis_main->rysjyear=substr($tb_cis_main->rysj,0,4);
        $tb_cis_main->rysjmonth=substr($tb_cis_main->rysj,4,2);
        $tb_cis_main->rysjday=substr($tb_cis_main->rysj,6,2);
        $tb_cis_main->rysjhour=substr($tb_cis_main->rysj,8,2);
        //转换出院时间
        $tb_cis_main->cysjyear=substr($tb_cis_main->cysj,0,4);
        $tb_cis_main->cysjmonth=substr($tb_cis_main->cysj,4,2);
        $tb_cis_main->cysjday=substr($tb_cis_main->cysj,6,2);
        $tb_cis_main->cysjhour=substr($tb_cis_main->cysj,8,2);
        //获取过敏状态
        if($tb_cis_main->ywgm)
        {
            $tb_cis_main->ywgm_code=2;
        }
        else
        {
            $tb_cis_main->ywgm_code=1;
        }
        $this->view->tb_cis_main=$tb_cis_main;
        $yljgmc=get_organization_by_standard_code(trim($tb_cis_main->yljgdm));
        $this->view->yljgmc=$yljgmc;
        $tb_cis_main->free_statement();
        $this->view->display("cis_main.html");
    }
    /**
     * 获取门诊费用详情
     *
     * @param string $jzlsh
     * @return string
     */
    private function get_fee($jzlsh)
    {
    	$mxfylb=array("02" => "诊疗费","03" => "治疗费","05" => "手术材料费","06" => "检查费","07" => "化验费","08" => "摄片费","09" => "透视费","10" => "输血费","11" => "输氧费","12" => "西药费","13" => "中成药费","14" => "中草药费","15" => "其它费用","00" => "挂号费");
    	$tb_his_mz_fee_detail=new Ttb_his_mz_fee_detail(2);
    	$tb_his_mz_fee_detail->whereAdd("jzlsh='$jzlsh'");
    	$tb_his_mz_fee_detail->whereAdd("tb_his_mz_fee_detail.xgbz=1");//收费
    	$tb_his_mz_fee_detail->find();
    	$fee=array();
    	$i=0;
    	while ($tb_his_mz_fee_detail->fetch())
    	{
    		$fee[$i]['mxfylb']=@$mxfylb[$tb_his_mz_fee_detail->mxfylb];
	    	$fee[$i]['stfsj']=$tb_his_mz_fee_detail->stfsj;
	    	$fee[$i]['mxxmbm']=$tb_his_mz_fee_detail->mxxmbm;
	    	$fee[$i]['mxxmmc']=$tb_his_mz_fee_detail->mxxmmc;
	    	$fee[$i]['mxxmdw']=$tb_his_mz_fee_detail->mxxmdw;
	    	$fee[$i]['mxxmdj']=@floatval($tb_his_mz_fee_detail->mxxmdj);
	    	$fee[$i]['mxxmsl']=$tb_his_mz_fee_detail->mxxmsl;
	    	$fee[$i]['mxxmje']=@floatval($tb_his_mz_fee_detail->mxxmje);
	    	$i++;
    	}
    	$tb_his_mz_fee_detail->free_statement();
    	return $fee;
    }
    /**
     * 获取住院费用详情
     *
     * @param string $jzlsh
     * @return string
     */
    private function get_zy_fee($jzlsh)
    {
    	$tb_his_zy_fee_detail=new Ttb_his_zy_fee_detail(2);
    	$tb_his_zy_fee_detail->whereAdd("jzlsh='$jzlsh'");
    	$tb_his_zy_fee_detail->whereAdd("tb_his_zy_fee_detail.xgbz=1");//收费
    	$tb_his_zy_fee_detail->find();
    	$fee=array();
    	$i=0;
    	while ($tb_his_zy_fee_detail->fetch())
    	{
    	    $fee[$i]['yljgdm']=get_organization_by_standard_code($tb_his_zy_fee_detail->yljgdm);
    		$fee[$i]['mxfylb']=$tb_his_zy_fee_detail->mxfylb;
	    	$fee[$i]['stfsj']=$tb_his_zy_fee_detail->stfsj;
	    	$fee[$i]['mxxmbm']=$tb_his_zy_fee_detail->mxxmbm;
	    	$fee[$i]['mxxmmc']=$tb_his_zy_fee_detail->mxxmmc;
	    	$fee[$i]['mxxmdw']=$tb_his_zy_fee_detail->mxxmdw;
	    	$fee[$i]['mxxmdj']=@floatval($tb_his_zy_fee_detail->mxxmdj);
	    	$fee[$i]['mxxmsl']=$tb_his_zy_fee_detail->mxxmsl;
	    	$fee[$i]['mxxmje']=@floatval($tb_his_zy_fee_detail->mxxmje);
	    	$i++;
    	}
    	$tb_his_zy_fee_detail->free_statement();
    	return $fee;
    }
    /**
     * 获取处方详情
     *
     * @param string $jzlsh
     * @return string
     */
    private function get_cis($jzlsh)
    {
    	$tb_cis_prescription_detail=new Ttb_cis_prescription_detail(2);
    	$tb_cis_prescription_detail->whereAdd("jzlsh='$jzlsh'");
    	$tb_cis_prescription_detail->find();
    	$fee=array();
    	$i=0;
    	while ($tb_cis_prescription_detail->fetch())
    	{
    		$fee[$i]['cyh']=$tb_cis_prescription_detail->cyh;
	    	$fee[$i]['yljgdm']=get_organization_by_standard_code($tb_cis_prescription_detail->yljgdm);
	    	$fee[$i]['jzksmc']=$tb_cis_prescription_detail->jzksmc;
	    	$fee[$i]['kfysxm']=$tb_cis_prescription_detail->kfysxm;
	    	$fee[$i]['kfrq']=$tb_cis_prescription_detail->kfrq;
	    	$fee[$i]['ypsl']=$tb_cis_prescription_detail->ypsl;
	    	$fee[$i]['sypc']=$tb_cis_prescription_detail->sypc;
	    	$fee[$i]['ypdw']=$tb_cis_prescription_detail->ypdw;
			$fee[$i]['xmmc']=$tb_cis_prescription_detail->xmmc;
	    	$i++;
    	}
    	$tb_cis_prescription_detail->free_statement();
    	return $fee;
    }
    public function picAction()
    {
        //验证码
        require_once __SITEROOT."library/securimage/securimage.php";
        $img = new securimage();
        $img->gd_font_file=__SITEROOT."library/securimage/gdfonts/bubblebath.gdf";
        $img->ttf_file = __SITEROOT."library/securimage/elephant.ttf";
        $img->image_width="125";
        $img->font_size=22;
        $img->show(); 
    }
    public function showpicAction()
    {
        //画血压变化图
        require_once __SITEROOT.'/library/custom/comm_function.php';
        $uuid=$this->_request->getParam("uuid");
        if($uuid)
        {
            require_once __SITEROOT."library/Models/physical_base.php";
            $physical_base=new Tphysical_base();
            $physical_base->whereAdd("id='$uuid'");
            $physical_base->whereAdd("(s_blood_pressure!='' or s_blood_pressure is not null) and (p_blood_pressure!='' or p_blood_pressure is not null)");
            $physical_base->orderBy("created ASC");
            $physical_base->limit(0,18);
            $physical_base->find();
            $physical=array();
            $i=0;
            $t=array();
            while($physical_base->fetch())
            {
                $date=date("Y-m-d",$physical_base->created);
                $physical['s_blood_pressure']['data'][$i]=$physical_base->s_blood_pressure?$physical_base->s_blood_pressure:0;
                $physical['s_blood_pressure']['serie'][$i]=$date;
                $physical['s_blood_pressure']['seriename']="收缩压";
                $physical['p_blood_pressure']['data'][$i]=$physical_base->p_blood_pressure?$physical_base->p_blood_pressure:0;
                $physical['p_blood_pressure']['serie'][$i]=$date;
                $physical['p_blood_pressure']['seriename']="舒张压";
                $t[$i]=$date;
                $i++;
            }
            $physical_base->free();
            //绘图
            $units="时间";
    		$title="近期18条血压记录走势图";
    		@drawline($physical,$t,"","血压(mmHg)",$units,"",$title,"1024","280","30");
        }
    }
    /**
     * iha_searchController::xtpicAction()
     * 
     * 血糖变化曲线
     * 
     * @return void
     */
    public function xtpicAction()
    {
        //画血压变化图
        require_once __SITEROOT.'/library/custom/comm_function.php';
        $uuid=$this->_request->getParam("uuid");
        if($uuid)
        {
            require_once __SITEROOT."library/Models/physical_base.php";
            $physical_base=new Tphysical_base();
            $physical_base->whereAdd("id='$uuid'");
            $physical_base->whereAdd("blood_sugar!='' or blood_sugar is not null");
            $physical_base->orderBy("created ASC");
            $physical_base->limit(0,18);
            $physical_base->find();
            $physical=array();
            $i=0;
            $t=array();
            while($physical_base->fetch())
            {
                $date=date("Y-m-d",$physical_base->created);
                $physical['s_blood_pressure']['data'][$i]=$physical_base->blood_sugar?$physical_base->blood_sugar:0;
                $physical['s_blood_pressure']['serie'][$i]=$date;
                $physical['s_blood_pressure']['seriename']="空腹血糖";
                $t[$i]=$date;
                $i++;
            }
            $physical_base->free();
            //绘图
            $units="时间";
    		$title="近期18条空腹血糖记录走势图";
    		@drawline($physical,$t,"","空腹血糖(mmol/L)",$units,"",$title,"1024","280","30");
        }
    }
    /**
     * iha_searchController::hisAction()
     * 
     * 处理显示his部分的列表，根据传递的module_id来进行过滤
     * 
     * @return void
     */
    public function hislistAction()
    {
        $module_id=$this->_request->getParam('mid');
        if($module_id)
        {
            $module_id=base64_decode($module_id);
            //取模块名称
            require_once __SITEROOT."library/Models/api_module.php";
            $api_module=new Tapi_module();
            $api_module->whereAdd("module_id='$module_id'");
            $api_module->find(true);
            $this->view->module_name=$api_module->module_name;
            $api_module->free_statement();
            $search_session=new Zend_Session_Namespace("iha_search");
            $card=$search_session->identity_number;//身份证号码
            require_once __SITEROOT.'/library/data_arr/arrdata.php';
            if($card)
            {
                require_once __SITEROOT."library/Models/api_summary.php";
                $api_summary=new Tapi_summary();
                $api_summary->whereAdd("patient_identity_card='$card'");
                $api_summary->whereAdd("module_id='$module_id'");
                $api_summary->orderBy("updated desc");
                $api_summary->limit(0,50);
                $api_summary->find();
                $i=0;
                $data=array();
                while($api_summary->fetch())
                {
                    $data[$i]['module_id']=base64_encode($api_summary->module_id);
                    $data[$i]['updated']=$api_summary->updated?date('Y-m-d',$api_summary->updated):'';
                    $data[$i]['document_id']=$api_summary->document_id;
                    $data[$i]['document_time']=$api_summary->document_time?date('Y-m-d',$api_summary->document_time):'';
                    $data[$i]['doctor_id']=get_staff_name_byid($api_summary->doctor_id);
                    $data[$i]['org_id']=get_organization_name($api_summary->org_id);
                    $data[$i]['patient_name']=$api_summary->patient_name;
                    $data[$i]['patient_sex']=@$sex[array_search_for_other($api_summary->patient_sex, $sex)][1];
                    $i++;
                }
                $this->view->data=$data;
                $this->view->display("search_his_list.html");
            }
            else
            {
                $url=array("公众平台登录"=>__BASEPATH.'iha/search/index');
                message("对不起，你还没有登录，请登录后重试",$url);
            }
        }
        else
        {
            $url=array("个人信息概况"=>__BASEPATH.'iha/search/main');
			message("对不起，信息获取错误，请联系管理员",$url);
        }
    }
    /**
     * iha_searchController::hisAction()
     * 
     * 显示his详细信息
     * 
     * @return void
     */
    public function hisAction()
    {
        $document_id=$this->_request->getParam('did');
        $module_id=$this->_request->getParam('mid');
        if($document_id && $module_id)
        {
            $module_id=base64_decode($module_id);
            //取模块名称
            require_once __SITEROOT."library/Models/api_module.php";
            $api_module=new Tapi_module();
            $api_module->whereAdd("module_id='$module_id'");
            $api_module->find(true);
            header('Content-Type: text/xml');
            require_once __SITEROOT."library/Models/api_xml.php";
            require __SITEROOT."config/oracleConfig.php";
            $conn = oci_connect($databaseConfig[1]['user'],$databaseConfig[1]['password'],$databaseConfig[1]['host'],'zhs16gbk');
            $query = "select xml_content from api_xml where document_id='$document_id'";
            $stmt = oci_parse($conn,$query);
            oci_execute($stmt);
            while($result=oci_fetch_array($stmt,OCI_RETURN_LOBS))
            {
                 $xml_content = iconv('gbk','utf-8//IGNORE',base64_decode($result[0]));
            }
            echo '<?xml-stylesheet type="text/xsl" href="/'.$api_module->xml_template.'/'.urlencode($api_module->module_name).'.xsl"?>'.$xml_content;
        }
        else
        {
            $url=array("个人信息概况"=>__BASEPATH.'iha/search/main');
			message("对不起，信息获取错误，请联系管理员",$url);
        }
    }
    /**
     * iha_searchController::tijianAction()
     * 
     * 绘制体检信息曲线
     * 
     * @return void
     */
    public function tijianAction()
    {
        //展示查询结果
        require_once __SITEROOT.'/library/custom/comm_function.php';
        require_once __SITEROOT."library/securimage/securimage.php";
        require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/data_arr/arrdata.php';
        $search_session=new Zend_Session_Namespace("iha_search");
        $card=$search_session->identity_number;//身份证号码
        if($card)
        {
            if(!$card)
            {
                exit;
            }
            //取姓名、性别等基本信息
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("identity_number='$card'");
            if($individual_core->count())
            {
                $individual_core->find(true);
                $org_id=$individual_core->org_id;
                $uuid=$individual_core->uuid;//个人档案号
                $family_number=$individual_core->family_number;//家庭档案号
                $staff_id=$individual_core->staff_id;//医生档案号
                //取体格检查数据
                require_once __SITEROOT."library/Models/physical_base.php";
                $physical_base=new Tphysical_base();
                $physical_base->whereAdd("id='$uuid'");
                $physical_base->orderBy("created DESC");
                $physical_base->limit(0,30);
                $physical_base->find();
                $physical=array();
                $i=0;
                $t=array();
                while($physical_base->fetch())
                {
                    $date=date("Y-m-d",$physical_base->created);
                    
                    
                    $physical['height']['data'][$i]=$physical_base->height?$physical_base->height:0;
                    $physical['height']['serie'][$i]=$date;
                    $physical['height']['seriename']="身高";
                    $physical['weight']['data'][$i]=$physical_base->weight?$physical_base->weight:0;
                    $physical['weight']['serie'][$i]=$date;
                    $physical['weight']['seriename']="体重";
                    
                    $physical['s_blood_pressure']['data'][$i]=$physical_base->s_blood_pressure?$physical_base->s_blood_pressure:0;
                    $physical['s_blood_pressure']['serie'][$i]=$date;
                    $physical['s_blood_pressure']['seriename']="收缩压";
                    $physical['p_blood_pressure']['data'][$i]=$physical_base->p_blood_pressure?$physical_base->p_blood_pressure:0;
                    $physical['p_blood_pressure']['serie'][$i]=$date;
                    $physical['p_blood_pressure']['seriename']="舒张压";
                    
                    $physical['blood_sugar']['data'][$i]=$physical_base->blood_sugar?$physical_base->blood_sugar:0;
                    $physical['blood_sugar']['serie'][$i]=$date;
                    $physical['blood_sugar']['seriename']="空腹血糖";
                    
                    
                    $t[$i]=$date;
                    $i++;
                }
                $physical_base->free_statement();
                //绘图
                $units="时间";
        		$title="近期身高、体重、体质指数、收缩压、舒张压记录走势图";
        		@drawline($physical,$t,"","记录",$units,"",$title,"1024","280","30");
            }
        }
    }
	/**
     * iha_searchController::appointmentAction()
     * 
     * 预约挂号信息查询
     * 
     * @return void
     */
	public function appointmentAction(){
		
		 require_once __SITEROOT."library/Models/appointment_register.php";
		 require_once __SITEROOT."library/Models/staff_core.php";
		 require_once __SITEROOT."library/Models/department.php";
		 require_once __SITEROOT."library/Models/clinic.php";
		 require_once __SITEROOT."library/Models/organization.php";
		// require_once __SITEROOT."library/Models/appointment_register.php";
		 $organization=new Torganization();
		 $staff_core=new Tstaff_core();
		 $department=new Tdepartment();
		 $clinic=new Tclinic();
		 $appointment=new Tappointment_register();
		 $appointment->joinAdd("inner",$appointment,$staff_core,"doctor_id","id");
		 $appointment->joinAdd("inner",$appointment,$department,"department_id","uuid");
		 $appointment->joinAdd("left",$appointment,$clinic,"clinic_id","uuid");
		 $appointment->joinAdd("inner",$appointment,$organization,"org_id","id");
		 $identity_number=$_SESSION['iha_search']['identity_number'];
		 $appointment->whereAdd("identity_number='$identity_number'");
		 $result=array();
		 $index=0;
		 $appointment->find();
		 while($appointment->fetch()){
			$result[$index]['doctor_name']=$staff_core->name_login;
			$result[$index]['org_name']=$organization->zh_name;
			$result[$index]['time']=date("Y-m-d",$appointment->register_date);
			$result[$index]['department']=$department->department_name;
			$index++;
		 }
		 $this->view->result=$result;
		 $this->view->display("appointment.html");
		 
	}
        /**
         * 取一个人的就诊状态
         */
       public function  getcardstatusAction()
       {
           //通过病人身份证号取得这个人的就诊的状态 
           require_once __SITEROOT."library/Models/iha_card_status.php";
           require_once __SITEROOT."library/Models/staff_core.php";
           require_once __SITEROOT."library/Models/organization.php";
           $identity_number =  $this->_request->getParam('identity_number');//病人身份证号
           if(!empty($identity_number))
           {
                $iha_card_status = new Tiha_card_status();
                $iha_card_status->whereAdd("identity_number='$identity_number'");
                $iha_card_status->find();
                $row = array();
                $count = 0;
                while($iha_card_status->fetch())
                {
                    $row[$count]['created'] =  date("Y-m-d H:i:s",$iha_card_status->created);
                    //就诊机构
                   $org = new Torganization();
                   $org->whereAdd("id=$iha_card_status->org_id");
                   $org->find(true);
                   $row[$count]['zh_name'] =  $org->zh_name;
                   //就诊状态
                   $zl_jz = array(1=>'门诊挂号',2=>'门诊划价',3=>'门诊收费',4=>'门诊记帐',5=>'入院登记',6=>'住院记帐',7=>'科室记帐',8=>'医技科室记帐',9=>'住院结帐',10=>'门诊医生站就诊',11=>'住院医生站',12=>'住院护士工作站',13=>'检验标本采集',14=>'药房发药',15=>'影像检查',16=>'影像采集');
                   $status = $iha_card_status->status;
                   if(!empty($status))
                   {
                   //var_dump($zl_jz);
                       $row[$count]['status'] =  $zl_jz[$status];
                   }
                   //活动描述
                   $row[$count]['actions'] =  $iha_card_status->actions;
                   //科室名称
                   $row[$count]['department_name'] =  $iha_card_status->department_name;
                   //医生
                   $staff_core =  new Tstaff_core();
                   $staff_core->whereAdd("id='$iha_card_status->staff_id'");
                   $staff_core->find(true);
                   $row[$count]['name_login'] = $staff_core->name_login;
                   $count++;     
                }
                $this->view->row = $row;
                $this->view->display('card_status.html');
           }
       }
}
?>