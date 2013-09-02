<?php

/**
 *@author：我好笨
 *@filename: indexController.php
 *@package：用于完成个人档案的建立
 *@create：2010-5-31
 */
class iha_indexController extends controller
{
    private $mask_char = '******';

    //此级别以下的用like 以上的用instr
    public $optimizerRegion = 4;
    /**
     * 等同于构造函数
     */
    public function init()
    {
        $this->haveWritePrivilege = '';
        require_once (__SITEROOT . 'library/privilege.php');
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/Models/individual_archive.php";
        require_once __SITEROOT . "library/Models/individual_core.php";
        require_once __SITEROOT . "library/Models/family_archive.php";
        require_once __SITEROOT . "library/Models/standard_archive_rate.php";
        require_once __SITEROOT . "library/Models/t_jk_card.php";//银海健康卡
        require_once (__SITEROOT . 'library/MyAuth.php');
        $this->view->assign("baseUrl", __BASEPATH);
        $this->view->assign("basePath", __BASEPATH);

        //region_array.php
        //print_r($this->identity);
    }
    
    /**
     * 个人档案列表
     */
    public function indexAction()
    {  
        //set_time_limit(0);
        require_once __SITEROOT . "/library/custom/pager.php";
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        require_once __SITEROOT . '/library/custom/comm_function.php';
        require_once (__SITEROOT . 'library/custom/region_array.php');
        //处理ajax载入，供其他模块调用
        $extra_table = $this->_request->getParam('searchtable'); //需要查询的扩展表名，如查询高血压患者，这里即为慢病表
        if ($extra_table != "")
        {
            $extra_table_comment = $this->_request->getParam('table_comment'); //扩展表中文注释
            $extra_colum = $this->_request->getParam('colum'); //扩展表字段名，以"||"区分多个字段
            $extra_value = $this->_request->getParam('value'); //对应上面字段名的值，以“||”区分
            $extra_colum_array = array();
            $extra_value_array = array();
            if ($extra_value != "")
            {
                $extra_colum_array = @explode("||", $extra_colum);
                $extra_value_array = @explode("||", $extra_value);
                $this->view->assign("colum", $extra_colum);
                $this->view->assign("value", $extra_value);
            }
            $extra_table_name = @explode("||", $extra_table); //2011-10-25根据新的需求需要选择多种类型，必须查询多表，因此此处添加慢病表||随访主表的形式
            $this->view->assign("table_comment", explode("||", $extra_table_comment));
            $this->view->assign("searchtable", $extra_table);
        }
    
        $region_path_array = explode(",", $this->user['current_region_path'], 5); 
        //档案状态
        $status_flagArray = array(
            '-9' => array('-9', '请选择'),
            '1' => array('1', '正常档案'),
            '4' => array('2', '临时档案'),
            '6' => array('3', '死亡档案'),
            '8' => array('4', '转出档案'));
        $current_status_flag = 1; //默认为正常档案，2012-02-21 我好笨
        $status_flag = array();
        $x = 0;
        foreach ($status_flagArray as $key => $value)
        {
            $status_flag[$x]['key'] = $key;
            $status_flag[$x]['value'] = $value['1'];
            if ($current_status_flag == $key)
            {
                $status_flag[$x]['selected'] = 'selected';
            }
            else
            {
                $status_flag[$x]['selected'] = '';
            }
            $x++;
        }
        $this->view->status_flag = $status_flag;
        //取到市级path
        $region_path_comment = $region_path_array['0'] . "," . $region_path_array['1'] .
            "," . @$region_path_array['2'] . "," . @$region_path_array['3'];
        //取完整率注释
        $standard_archive_rate = new Tstandard_archive_rate();
        //取本模块的所有必填字段数组
        $standard_archive_rate->whereAdd("region_path='$region_path_comment'");
        $standard_archive_rate->whereAdd("module_name = 'individual_core'"); //个人档案模块
        $standard_archive_rate->whereAdd("criteria='1'");
        $nums_rate = $standard_archive_rate->count(); //所有字段
        $standard_archive_rate->find();
        $comment = array();
        $i = 0;
        while ($standard_archive_rate->fetch())
        {
            $comment[$i]['table_zh_name'] = $standard_archive_rate->table_zh_name;
            $comment[$i]['column_zh_name'] = $standard_archive_rate->column_zh_name;
            $i++;
        }
        $this->view->assign("comment", $comment);
        //高级搜索使用数据字典
        $this->view->assign("sex", $sex);
        $this->view->assign("card_status", $card_status);
        $this->view->assign("registered_permanent_residence", $registered_permanent_residence);
        $this->view->assign("school_type", $school_type);
        $this->view->assign("occupation", $occupation);
        $this->view->assign("race", $race);
        $this->view->assign("races", $races);
        $this->view->assign("marriage", $marriage);
        $this->view->assign("charge_style", $charge_style);
        $this->view->assign("charge_style_json", json_encode($charge_style)); //因为JS文件中使用
        $this->view->assign("ABO_bloodtype", $ABO_bloodtype);
        $this->view->assign("RH_bloodtype", $RH_bloodtype);
        $this->view->assign("comm", $comm);
        $this->view->assign("allergy_history", $allergy_history);
        $this->view->assign("family_history", $family_history);
        $this->view->assign("disease_history", $disease_history);
        $this->view->assign("deformity_type", $deformity_type);
        $this->view->assign('region_id', $this->user['region_id']);
        $this->view->assign('region_p_id', $this->user['region_id']);
         
        $individual_core_region_path_domain = get_region_path(1);
        $staff_core_region_path_domain = get_region_path(2);
        //这里比较慢
        $this->view->response_doctor = get_doctor_list($this->user['current_region_path_domain'],
            "");
        //医生列表结束


        $search = array();
        $core = new Tindividual_core();
        //$core->setCache(true,'./cache/',10);
        $core->whereAdd($individual_core_region_path_domain);
        //增加档案状态，2012-02-21 我好笨
        if ($current_status_flag != 0)
        {
            $core->whereAdd("individual_core.status_flag=$current_status_flag");
        }
        //不能去掉
        //$core->whereAdd("individual_core.updated>'0'");
        //ajax载入使用
        if (isset($extra_table_name[0]) && $extra_table_name[0] != "" && $extra_table_name[0] !=
            '0' && file_exists(__SITEROOT . "library/Models/" . $extra_table_name[0] .
            ".php"))
        {
            $where = "";
            foreach ($extra_value_array as $k => $v)
            {
                if ($v != "" && $extra_colum_array[$k] != '')
                {
                    $where .= $extra_table_name[0] . "." . $extra_colum_array[$k] . "='$v'";
                    $where .= " and ";
                }
            }
            $where = $where ? ("where " . substr($where, 0, -5)) : "";
            $cl_search_type = $this->_request->getParam('cl_search_type'); //列表类型
            $this->view->assign("cl_search_type", $cl_search_type);
            if (isset($extra_table_name[1]) && file_exists(__SITEROOT . "library/Models/" .
                $extra_table_name[0] . ".php"))
            {
                require_once (__SITEROOT . "library/Models/" . $extra_table_name[0] . ".php");
            }
            switch ($cl_search_type)
            {
                case 0:
                    //列表所有人
                    break;
                case 1:
                    {
                        //顺序同table_comment
                        $core->whereAdd("individual_core.uuid in (select distinct id from " . $extra_table_name[0] .
                            " $where)");
                        if (isset($extra_table_name[1]))
                        {
                            $core->whereAdd("individual_core.uuid in (select distinct id from " . $extra_table_name[1] .
                                ")");
                        }
                        break;
                    }
                case 2:
                    {
                        $core->whereAdd("individual_core.uuid in (select distinct id from " . $extra_table_name[0] .
                            " $where)");
                        if (isset($extra_table_name[1]))
                        {
                            $core->whereAdd("individual_core.uuid not in (select distinct id from " . $extra_table_name[1] .
                                ")");
                        }
                        break;
                    }
                case 3:
                    {
                        $core->whereAdd("individual_core.uuid not in (select distinct id from " . $extra_table_name[0] .
                            " $where)");
                        if (isset($extra_table_name[1]))
                        {
                            $core->whereAdd("individual_core.uuid in (select distinct id from " . $extra_table_name[1] .
                                ")");
                        }
                        break;
                    }
                case 4:
                    {
                        $core->whereAdd("individual_core.uuid not in (select distinct id from " . $extra_table_name[0] .
                            " $where)");
                        if (isset($extra_table_name[1]))
                        {
                            $core->whereAdd("individual_core.uuid not in (select distinct id from " . $extra_table_name[1] .
                                ")");
                        }
                        break;
                    }
                case 5:
                    {
                        $core->whereAdd("individual_core.uuid in (select distinct id from " . $extra_table_name[0] .
                            " $where)");
                        break;
                    }
                default:
                    {
                        $core->whereAdd("individual_core.uuid in (select distinct id from " . $extra_table_name[0] .
                            " $where)");
                        break;
                    }
            }
        }
        /*	首次进入根本不用下面的代码
        $family=new Tfamily_archive();
        //$family->whereAdd("family_archive.org_id='$org_id'");
        //处理搜索
        if (!empty($search))
        {
        foreach ($search as $k=>$v)
        {
        $core->whereAdd("individual_core.`$k`='$v'");
        }
        }
        //$core->joinAdd('left',$core,$family,'family_number','uuid');
        //$nums=$core->count();
        //$nums=$core->count('*');

        //$core=new Tindividual_core();
        //$core->whereAdd("individual_core.org_id='$org_id'");
        //$family=new Tfamily_archive();
        //$family->whereAdd("family_archive.org_id='$org_id'");
        //个人档案附加表，为实现高级搜索
        $individual_archive=new Tindividual_archive();
        //$individual_archive->whereAdd("individual_archive.org_id='$org_id'");
        //处理搜索
        if (!empty($search))
        {
        foreach ($search as $k=>$v)
        {
        $core->whereAdd("individual_core.$k='$v'");
        }
        }*/
        //$core->debugLevel(9);
        $nums = $core->count();
        //$core->whereAdd("individual_core.updated>0");
        //showtimer();
        $pageCurrent = intval($this->_request->getParam('page'));
        $pageCurrent = $pageCurrent ? $pageCurrent : 1;
        //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,
            __BASEPATH . 'iha/index/list/page/', 2, $search);
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = __ROWSOFPAGE * ($pageCurrent - 1); //计算开始记录数
        //$core->joinAdd('left',$core,$family,'family_number','uuid');
        //$core->joinAdd('left',$core,$individual_archive,'uuid','id');
        //$temp1=explode(",",$this->user['current_region_path']);
        //$current_user_region_level=count($temp1);
        $core->selectAdd("
		individual_core.uuid as uuid,
		individual_core.name as name,
		individual_core.sex as sex,
		individual_core.family_number as family_number,
		individual_core.address as address,
		individual_core.staff_id as staff_id,
		individual_core.standard_code_1 as standard_code_1,
		individual_core.identity_number as identity_number,
		individual_core.phone_number as phone_number,
		individual_core.date_of_birth as date_of_birth,
		individual_core.criteria_rate as criteria_rate,
        individual_core.card_status as card_status,
        individual_core.status_flag as status_flag,
        individual_core.filing_time as filing_time,
        individual_core.updated as updated
		");

        $core->orderby("individual_core.updated DESC");
        //处理分页
        $core->limit($startnum, __ROWSOFPAGE);
        $core->find();
        $indiv = array();
        $i = 0;
        while ($core->fetch())
        {
            $indiv[$i]['uuid'] = $core->uuid;
            if ($this->haveWritePrivilege)
            {
                $indiv[$i]['name'] = $core->name;
                $indiv[$i]['householder_name'] = get_househoder_name($core->family_number);
                $indiv[$i]['contact_number'] = $core->phone_number;
            }
            else
            {
                $indiv[$i]['name'] = $this->mask_char;
                $indiv[$i]['householder_name'] = $this->mask_char;
                $indiv[$i]['contact_number'] = $this->mask_char;
            }
            //2011-08-31 luo 根据社保与身份证号合一的精神，决定在此处显示更有实际用处的身份证号
            $indiv[$i]['standard_code'] = $core->standard_code_1;
            $indiv[$i]['standard_code'] = $core->identity_number;
            $indiv[$i]['standard_code_base'] = base64_encode($core->identity_number);
            //$indiv[$i]['standard_code']=$core->region_path.'|'.$core->standard_code_1;
            $indiv[$i]['address'] = $core->address;
            $indiv[$i]['sex'] = @$sex[array_search_for_other($core->sex, $sex)][1];
            $indiv[$i]['date_of_birth'] = adodb_date("Y-m-d", $core->date_of_birth);
            $indiv[$i]['age'] = getBirthday($core->date_of_birth, time());
            $indiv[$i]['criteria_rate'] = $core->criteria_rate * 100;
            $indiv[$i]['staff_id'] = $core->staff_id;
            $indiv[$i]['card_status_info']= @$card_status[array_search_for_other($core->card_status, $card_status)][1];
            $indiv[$i]['card_status']= $core->card_status;
            $indiv[$i]['status_flag']=$core->status_flag;
            $indiv[$i]['staff_name'] = get_staff_name_byid($core->staff_id);
            $indiv[$i]['filing_time']=$core->filing_time?date('Y-m-d',$core->filing_time):'';
            $indiv[$i]['updated']=$core->updated?date('Y-m-d',$core->updated):'';
            $i++;
        }
        $out = $links->subPageCss3();
        $this->view->assign("page", $pageCurrent);
        $this->view->assign("para_page", $pageCurrent);
        $this->view->assign("pager", $out);
        $this->view->assign("iha", $indiv);
        $individual_session = new Zend_Session_Namespace("individual_core"); 
        $this->view->assign("individual_current", $individual_session);
        $this->view->error_message = $this->_request->getParam('error_message', ''); 
        $this->view->display("list.html");
    }


    public function listAction()
    {  
        //global $s;
        //set_time_limit(0);
        require_once __SITEROOT . "/library/custom/pager.php";
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        require_once __SITEROOT . '/library/custom/comm_function.php';
        require_once (__SITEROOT . 'library/custom/region_array.php');
        $time = time();
        $search = array();
        //处理ajax载入，供其他模块调用
        $extra_table = $this->_request->getParam('searchtable'); //需要查询的扩展表名，如查询高血压患者，这里即为慢病表
        if ($extra_table != "")
        {
            $extra_table_comment = $this->_request->getParam('table_comment'); //扩展表中文注释
            $extra_colum = $this->_request->getParam('colum'); //扩展表字段名，以"||"区分多个字段
            $extra_value = $this->_request->getParam('value'); //对应上面字段名的值，以“||”区分
            $extra_colum_array = array();
            $extra_value_array = array();
            if ($extra_value != "")
            {
                $extra_colum_array = @explode("||", $extra_colum);
                $extra_value_array = @explode("||", $extra_value);
                $this->view->assign("colum", $extra_colum);
                $this->view->assign("value", $extra_value);
            }
            $extra_table_name = @explode("||", $extra_table); //2011-10-25根据新的需求需要选择多种类型，必须查询多表，因此此处添加慢病表||随访主表的形式
            $this->view->assign("table_comment", explode("||", $extra_table_comment));
            $this->view->assign("searchtable", $extra_table);
        }

        $searchurl = "";
        $search['username'] = $this->_request->getParam('username'); //姓名包含拼音
        $search['card_status'] = $this->_request->getParam('card_status');//发卡状态
        $nocard = $this->_request->getParam('nocard'); //无身份证人员
        $this->view->nocard=$nocard;
        $search['staff_id'] = ($this->_request->getParam('staff_id') == "-9") ? "" : $this->
            _request->getParam('staff_id'); //建档医生
        $search['standard_code'] = $this->_request->getParam('standard_code'); //标准档案号
        $search['identity_number'] = $this->_request->getParam('identity_number'); //身份证号
        $search['age_start'] = intval($this->_request->getParam('age_start')) ? intval($this->
            _request->getParam('age_start')) : 0; //年龄段
        $search['status_flag'] = $this->_request->getParam('status_flag'); //档案状态
        $search['status_flag'] = $search['status_flag'] ? $search['status_flag'] : 1; //默认为正常档案 2012-02-21 我好笨
        $search['age_end'] = (intval($this->_request->getParam('age_end')) >= $search['age_start']) ?
            intval($this->_request->getParam('age_end')) : '';
        $search['phone_number'] = $this->_request->getParam('phone_number'); //电话号码
        $search['unit_name'] = $this->_request->getParam('unit_name'); //工作单位
        $search['residence'] = (is_array($this->_request->getParam('residence')) && !
            is_empty_for_multi($this->_request->getParam('residence'))) ? implode("||", $this->
            _request->getParam('residence')) : $this->_request->getParam('residence'); //常住类型-数组
        $search['sex'] = (is_array($this->_request->getParam('sex')) && !
            is_empty_for_multi($this->_request->getParam('sex'))) ? implode("||", $this->
            _request->getParam('sex')) : $this->_request->getParam('sex'); //性别-数组
        $search['school_type'] = (is_array($this->_request->getParam('school_type')) &&
            !is_empty_for_multi($this->_request->getParam('school_type'))) ? implode("||", $this->
            _request->getParam('school_type')) : $this->_request->getParam('school_type'); //文化程度-数组
        $search['occupation'] = (is_array($this->_request->getParam('occupation')) && !
            is_empty_for_multi($this->_request->getParam('occupation'))) ? implode("||", $this->
            _request->getParam('occupation')) : $this->_request->getParam('occupation'); //职业-数组
        $search['marriage'] = (is_array($this->_request->getParam('marriage')) && !
            is_empty_for_multi($this->_request->getParam('marriage'))) ? implode("||", $this->
            _request->getParam('marriage')) : $this->_request->getParam('marriage'); //婚姻状况-数组
        $search['allergy_history'] = (is_array($this->_request->getParam('allergy_history')) &&
            !is_empty_for_multi($this->_request->getParam('allergy_history'))) ? implode("||",
            $this->_request->getParam('allergy_history')) : $this->_request->getParam('allergy_history'); //药物过敏史-数组
        $search['disease_history'] = (is_array($this->_request->getParam('disease_history')) &&
            !is_empty_for_multi($this->_request->getParam('disease_history'))) ? implode("||",
            $this->_request->getParam('disease_history')) : $this->_request->getParam('disease_history'); //疾病史-数组
        $search['surgery_history'] = (is_array($this->_request->getParam('surgery_history')) &&
            !is_empty_for_multi($this->_request->getParam('surgery_history'))) ? implode("||",
            $this->_request->getParam('surgery_history')) : $this->_request->getParam('surgery_history'); //手术史-数组
        $search['trauma_history'] = (is_array($this->_request->getParam('trauma_history')) &&
            !is_empty_for_multi($this->_request->getParam('trauma_history'))) ? implode("||",
            $this->_request->getParam('trauma_history')) : $this->_request->getParam('trauma_history'); //外伤史-数组
        $search['blood_history'] = (is_array($this->_request->getParam('blood_history')) &&
            !is_empty_for_multi($this->_request->getParam('blood_history'))) ? implode("||",
            $this->_request->getParam('blood_history')) : $this->_request->getParam('blood_history'); //输血史-数组
        $search['genetic_diseases_history'] = (is_array($this->_request->getParam('genetic_diseases_history')) &&
            !is_empty_for_multi($this->_request->getParam('genetic_diseases_history'))) ?
            implode("||", $this->_request->getParam('genetic_diseases_history')) : $this->
            _request->getParam('genetic_diseases_history'); //遗传病史-数组
        $search['disability'] = (is_array($this->_request->getParam('disability')) && !
            is_empty_for_multi($this->_request->getParam('disability'))) ? implode("||", $this->
            _request->getParam('disability')) : $this->_request->getParam('disability'); //残疾状况-数组
        //档案状态开始时间
        $search['start_time']=$this->_request->getParam('start_time');
        $tmp_start_time=$search['start_time']?strtotime($search['start_time']):'';
        //档案状态结束时间
        $search['end_time']=$this->_request->getParam('end_time');
        $tmp_end_time=$search['end_time']?strtotime($search['end_time']):'';
        $orderby = $this->_request->getParam('order');
        $turn = strtolower($this->_request->getParam('turn'));
        $turn = ($turn == "asc" || $turn == "desc") ? $turn : "desc";
        $org_id = $this->user['org_id'];
        $search_org['org_id'] = $this->_request->getParam('region_p_id'); //地区

        $individual_core_region_path_domain = get_region_path(1, $search_org['org_id']); 
        $staff_core_region_path_domain = get_region_path(2); 
        $core = new Tindividual_core();
        //ajax载入使用
        if (isset($extra_table_name[0]) && $extra_table_name[0] != "" && $extra_table_name[0] !=
            '0' && file_exists(__SITEROOT . "library/Models/" . $extra_table_name[0] .
            ".php"))
        {
            $where = "";
            foreach ($extra_value_array as $k => $v)
            {
                if ($v != "" && $extra_colum_array[$k] != '')
                {
                    $where .= $extra_table_name[0] . "." . $extra_colum_array[$k] . "='$v'";
                    $where .= " and ";
                }
            }
            $where = $where ? ("where " . substr($where, 0, -5)) : "";
            $cl_search_type = $this->_request->getParam('cl_search_type'); //列表类型
            $this->view->assign("cl_search_type", $cl_search_type);
            if (isset($extra_table_name[1]) && file_exists(__SITEROOT . "library/Models/" .
                $extra_table_name[0] . ".php"))
            {
                require_once (__SITEROOT . "library/Models/" . $extra_table_name[0] . ".php");
            }
            switch ($cl_search_type)
            {
                case 0:
                    //列表所有人
                    break;
                case 1:
                    {
                        //顺序同table_comment
                        $core->whereAdd("individual_core.uuid in (select distinct id from " . $extra_table_name[0] .
                            " $where)");
                        if (isset($extra_table_name[1]))
                        {
                            $core->whereAdd("individual_core.uuid in (select distinct id from " . $extra_table_name[1] .
                                " where id is not null)");
                        }
                        break;
                    }
                case 2:
                    {
                        $core->whereAdd("individual_core.uuid in (select distinct id from " . $extra_table_name[0] .
                            " $where)");
                        if (isset($extra_table_name[1]))
                        {
                            $core->whereAdd("individual_core.uuid not in (select distinct id from " . $extra_table_name[1] .
                                " where id is not null)");
                        }
                        break;
                    }
                case 3:
                    {
                        $core->whereAdd("individual_core.uuid not in (select distinct id from " . $extra_table_name[0] .
                            " $where)");
                        if (isset($extra_table_name[1]))
                        {
                            $core->whereAdd("individual_core.uuid in (select distinct id from " . $extra_table_name[1] .
                                " where id is not null)");
                        }
                        break;
                    }
                case 4:
                    {
                        $core->whereAdd("individual_core.uuid not in (select distinct id from " . $extra_table_name[0] .
                            " $where)");
                        if (isset($extra_table_name[1]))
                        {
                            $core->whereAdd("individual_core.uuid not in (select distinct id from " . $extra_table_name[1] .
                                " where id is not null)");
                        }
                        break;
                    }
                case 5:
                    {
                        $core->whereAdd("individual_core.uuid in (select distinct id from " . $extra_table_name[0] .
                            " $where)");
                        break;
                    }
                default:
                    {
                        $core->whereAdd("individual_core.uuid in (select distinct id from " . $extra_table_name[0] .
                            " $where)");
                        break;
                    }
            }
        }

        //家庭档案，为取户主姓名
        $family = new Tfamily_archive();
        //个人档案附加表，为实现高级搜索
        $individual_archive = new Tindividual_archive();
        //处理搜索
        $archive = array(
            'unit_name',
            'residence',
            'sex',
            'school_type',
            'occupation',
            'marriage',
            'allergy_history',
            'disease_history',
            'surgery_history',
            'trauma_history',
            'blood_history',
            'genetic_diseases_history',
            'disability'); //附加表中搜索字段
        if (!is_empty_for_multi($search))
        {
            foreach ($search as $k => $v)
            {
                if (is_array($v))
                {
                    $v = implode($v, "||");
                }
                if ($v != "" && in_array($k, $archive))
                {
                    //数据部分数据全部都取自附加表,因为数组被转换成了含有||的值，所以需要特殊处理，所以
                    //组合搜索URL
                    $searchurl .= "/$k/$v";
                    $v = str_replace("%", "\%", $v);
                    $v = str_replace("_", "\_", $v);
                    $temp = array();
                    $temp = explode("||", $v);
                    if (is_array($temp) && !is_empty_for_multi($temp))
                    {
                        $search_string = ""; //因为是多条件，所以多个条件间是或者的关系
                        foreach ($temp as $m => $n)
                        {
                            //if($n!="")
                            //{
                            if ($k != "sex")
                            {
                                if ($n == 'all')
                                {
                                    $search_string .= "individual_archive.$k is null or ";
                                }
                                else
                                {
                                    $search_string .= "individual_archive.$k='$n' or ";
                                }
                            }
                            elseif ($k == "sex")
                            {
                                if ($n == 'all')
                                {
                                    $search_string .= "individual_core.$k is null or ";
                                }
                                else
                                {
                                    $search_string .= "individual_core.$k='$n' or ";
                                }
                            }
                            //}
                        }
                        $search_string = substr($search_string, 0, -3);
                        if (strpos($search_string, "individual_core") !== false || strpos($search_string,
                            "individual_archive") !== false)
                        {
                            $core->whereAdd("$search_string");
                        }
                    }
                }
                else
                {
                    //组合搜索URL
                    $searchurl .= "/$k/$v";
                    //移除通配符
                    $v = str_replace("%", "\%", $v);
                    $v = str_replace("_", "\_", trim($v));
                    if (!in_array($k, $archive) && $k != "unit_name" && $k != "age_start" && $k !=
                        "age_end" && $k != "username" && $k != "order" && $k != "turn" && $k !=
                        "standard_code" && $k != "staff_id" && $k != "org_id" && $k!='status_flag' && $k!='start_time' && $k!='end_time' && $v != '')
                    {
                        $core->whereAdd("individual_core.$k like '$v%'");
                    }
                    if ($k == "org_id" && $v !== '')
                    {
                        $core->whereAdd("individual_core.org_id = '$v'");
                    }
                    if ($k == "standard_code" && $v !== '')
                    {
                        $core->whereAdd("individual_core.standard_code_1 like '$v%'");
                    }
                    if ($k == "username" && $v !== '')
                    {
                        $core->whereAdd("individual_core.name like '$v%' or individual_core.name_pinyin like '$v%'");
                    }
                    if ($k == "status_flag" && $v !== '' && $v!='-9')
                    {
                        $core->whereAdd("individual_core.status_flag = '$v'");
                    }
                    if ($k == "age_start" && $v !== '' && $v != 0)
                    {
                        $v = adodb_mktime(0, 0, 0, adodb_date("n", $time), adodb_date("j", $time),
                            adodb_date("Y", $time) - $v);
                        $core->whereAdd("individual_core.date_of_birth <= $v");
                    }
                    if ($k == "age_end" && $v !== '' && $v != 0)
                    {
                        $v = $v + 1;
                        $v = adodb_mktime(0, 0, 0, adodb_date("n", $time), adodb_date("j", $time),
                            adodb_date("Y", $time) - $v);
                        $core->whereAdd("individual_core.date_of_birth >= $v");
                    }
                    if ($k == "unit_name" && $v !== '' && $v != 0)
                    {
                        //单独处理工作单位，因为它属于附加表
                        $core->whereAdd("individual_archive.$k like '$v%'");
                    }
                    if ($k == "staff_id" && $v !== '' && $v != 0)
                    {
                        $core->whereAdd("individual_core.$k = '$v'");
                    }
                    if ($k == "start_time" && $tmp_start_time != '')
                    {
                        $core->whereAdd("individual_core.updated >= '$tmp_start_time'");
                    }
                    if ($k == "end_time" && $tmp_end_time != '')
                    {
                        $core->whereAdd("individual_core.updated <= '$tmp_end_time'");
                    }
                }
            }
            //这里是关键，没有查询条件的时候就不关联
            //$core->joinAdd('left',$core,$individual_archive,'uuid','id');
            //$core->joinAdd('inner',$core,$family,'family_number','uuid');
            //下面二句不能丟
            $individual_archive->selectAdd("individual_archive.id as individual_archive_id");
            //$family->selectAdd("family_archive.family_number as family_archive_family_number");
        }
        if ($nocard && $nocard == "1")
        {
            $core->whereAdd("individual_core.identity_number is null");
        }
        if ($nocard && $nocard == "2")
        {
            $core->whereAdd("length(individual_core.identity_number)=15");
        }
        if ($nocard && $nocard == "3")
        {
            $core->whereAdd("length(individual_core.identity_number)=18");
        }
        if ($nocard && $nocard == "4")
        {
            $core->whereAdd("length(individual_core.identity_number)!=15 and length(individual_core.identity_number)!=18");
        }
        //根据oracle where 优化原理，这句放在这
        //$core->debugLevel(5);
        $core->joinAdd('left', $core, $individual_archive, 'uuid', 'id');
        $core->whereAdd($individual_core_region_path_domain);
        $nums = $core->count();
        //showtimer();
        //exit;
        //$core->whereAdd("individual_core.updated>0");
        //echo $nums;
        $pageCurrent = intval($this->_request->getParam('page'));
        //echo $pageCurrent;
        $pageCurrent = $pageCurrent ? $pageCurrent : 1;
        //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        //处理排序
        $searcharray = array();
        if ($orderby)
        {
            $core->orderby("individual_core.$orderby $turn");
            $searcharray['order'] = $orderby;
            $searcharray['turn'] = strtoupper($turn);
        }
        else
        {
            $core->orderby("individual_core.updated DESC");
        }
        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,
            __BASEPATH . 'iha/index/list/page/', 2, $searcharray);
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = __ROWSOFPAGE * ($pageCurrent - 1); //计算开始记录数
        //处理分页
        $core->limit($startnum, __ROWSOFPAGE);
        //$core->limit(0,10);
        //$core->debuglevel(9);
        $core->selectAdd("
		individual_core.uuid as uuid,
		individual_core.name as name,
		individual_core.sex as sex,
		individual_core.family_number as family_number,
		individual_core.address as address,
		individual_core.staff_id as staff_id,
		individual_core.standard_code_1 as standard_code_1,
		individual_core.identity_number as identity_number,
		individual_core.phone_number as phone_number,
		individual_core.date_of_birth as date_of_birth,
		individual_core.criteria_rate as criteria_rate,
        individual_core.card_status as card_status,
        individual_core.status_flag as status_flag,
        individual_core.filing_time as filing_time,
        individual_core.updated as updated
		");
        //$core->debugLevel(9);
        $core->find();
        //exit();
        $indiv = array();
        $i = 0;
        while ($core->fetch())
        {
            $indiv[$i]['uuid'] = $core->uuid;
            if ($this->haveWritePrivilege)
            {
                $indiv[$i]['name'] = $core->name;
                $indiv[$i]['householder_name'] = get_househoder_name($core->family_number);
                $indiv[$i]['contact_number'] = $core->phone_number;
            }
            else
            {
                $indiv[$i]['name'] = $this->mask_char;
                $indiv[$i]['householder_name'] = $this->mask_char;
                $indiv[$i]['contact_number'] = $this->mask_char;
            }
            $indiv[$i]['address'] = $core->address;
            $indiv[$i]['staff_id'] = $core->staff_id;
            //2011-08-31 luo 根据社保与身份证号合一的精神，决定在此处显示更有实际用处的身份证号
            $indiv[$i]['standard_code'] = $core->standard_code_1;
            $indiv[$i]['standard_code'] = $core->identity_number;
            $indiv[$i]['standard_code_base'] = base64_encode($core->identity_number);
            $indiv[$i]['sex'] = @$sex[array_search_for_other($core->sex, $sex)][1];
            $indiv[$i]['date_of_birth'] = adodb_date("Y-m-d", $core->date_of_birth);
            $indiv[$i]['age'] = getBirthday($core->date_of_birth, time());
            $indiv[$i]['staff_name'] = get_staff_name_byid($core->staff_id);
            $indiv[$i]['criteria_rate'] = $core->criteria_rate * 100;
            $indiv[$i]['card_status_info']= @$card_status[array_search_for_other($core->card_status, $card_status)][1];
            $indiv[$i]['card_status']= $core->card_status;
            $indiv[$i]['status_flag']=$core->status_flag;
            $indiv[$i]['filing_time']=$core->filing_time?date('Y-m-d',$core->filing_time):'';
            $indiv[$i]['updated']=$core->updated?date('Y-m-d',$core->updated):'';
            $i++;
        }
        $ss = $this->_request->getParam("status_flag");

        $out = $links->subPageCss3();
        $this->view->assign("page", $pageCurrent);
        $this->view->assign("para_page", $pageCurrent);
        $this->view->assign("pager", $out);
        $this->view->assign("search", $searchurl);
        $this->view->assign("iha", $indiv);
        $individual_session = new Zend_Session_Namespace("individual_core");
        $this->view->assign("individual_current", $individual_session);
        $this->view->assign("ss", $ss);
        $this->view->display("list_extra.html");
    }

    public function deleteAction()
    {
        if (!$this->haveWritePrivilege)
        {
            $error_message = "你没有权限，不能删除";
            exit($error_message);

        }
        $uuid = $this->_request->getParam('uuid');
        //区域201111141128 万改
        $current_region_path = $this->user['current_region_path'];

        //exit();
        $individual = new Tindividual_core();
        $individual->whereAdd("uuid='$uuid'");
        $individual->find(true);
        $familyNumber = '';
        if ($individual->relation_holder == '1')
        {
            $familyNumber = $individual->family_number;
        }
        //判断是否还有家庭成员
        $individual = new Tindividual_core();
        $individual->whereAdd("family_number='$familyNumber'");
        if ($individual->count('*') > 1)
        {
            $error_message = "此户主还有家庭成员，不能删除";
            exit($error_message);
        }
        //石棉县删除个人档案时，删除所有的个人数据
        if (strpos($current_region_path, '0,1,2,5,75') !== false)
        {
            require_once __SITEROOT . 'application/iha/models/delete_iha_function.php';
            delete_iha_function($uuid);
            $error_message = "删除成功";
        }
        else
        {


            //$individual1->family_number

            $individual = new Tindividual_core();
            $individual->whereAdd("uuid='$uuid'");
            $individual->delete($this->user['uuid']);
            $individual = new Tindividual_archive();
            $individual->whereAdd("uuid='$uuid'");
            $individual->delete($this->user['uuid']);
            if ($familyNumber != '')
            {
                $family = new Tfamily_archive();
                $family->whereAdd("family_number='$familyNumber'");
                $family->delete($this->user['uuid']);
            }
            //2012-12-03按照修改要求，删除档案时，删除档案相关状态
            require_once __SITEROOT . "library/Models/individual_status.php";
            $individual_status=new Tindividual_status();
            $individual_status->whereAdd("id='$uuid'");
            $individual_status->delete($this->user['uuid']);
            $error_message = "删除成功";


        }
        exit($error_message);

    }

    /**
     * 添加/编辑个人档案展示页面
     * 
     * 2012-11-16添加完整率样式
     */
    public function addAction()
    {
    	
        //处理完整率特征字段样式
        $archive_rate_css='';
        if(file_exists(__SITEROOT . 'cache/standard_archive_rate_cache.php'))
        {
            require_once __SITEROOT . 'cache/standard_archive_rate_cache.php';
            $region_path_array = @explode(",", $this->user['current_region_path'], 5);
            //取到市级path
            $region_path = $region_path_array['0'] . "," . $region_path_array['1'] . "," . $region_path_array['2'] . "," . $region_path_array['3'];
            $css_name='';
            foreach($rate[$region_path] as $m=>$n)
            {
                foreach($n as $k=>$v)
                {
                    if($k=='individual_core')
                    {
                        $tmp_keys=array_keys($v);
                        $css_name.='.core_'.@implode(',.core_',$tmp_keys);
                    }
                    if($k=='individual_archive')
                    {
                        $tmp_keys=array_keys($v);
                        $css_name.='.archive_'.@implode(',.archive_',$tmp_keys);
                    }
                }
            }
            if($css_name)
            {
                $archive_rate_css=$css_name.'{font-weight:bold;color:green;}';
            }
        }
        $this->view->archive_rate_css=$archive_rate_css;
        require_once __SITEROOT . '/library/custom/comm_function.php';
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php';
        $this->view->assign("sex", $sex);
        $this->view->assign("registered_permanent_residence", $registered_permanent_residence);
        $this->view->assign("school_type", $school_type);
        $this->view->assign("occupation", $occupation);
        $this->view->assign("race", $race);
        $this->view->assign("races", $races);
        $this->view->assign("marriage", $marriage);
        $this->view->assign("charge_style", $charge_style);
        $this->view->assign("charge_style_json", json_encode($charge_style)); //因为JS文件中使用
        $this->view->assign("ABO_bloodtype", $ABO_bloodtype);
        $this->view->assign("RH_bloodtype", $RH_bloodtype);
        $this->view->assign("exposure_history", $iha_exposure_history); //暴露史，2011标准
        $this->view->assign("iha_kitchen_exhaust", $iha_kitchen_exhaust); //厨房排风设施
        $this->view->assign("iha_fuel_type", $iha_fuel_type); //燃料类型
        $this->view->assign("iha_water", $iha_water); //饮水
        $this->view->assign("iha_toilet", $iha_toilet); //厕所
        $this->view->assign("iha_livestock_column", $iha_livestock_column); //禽畜栏
        $this->view->assign("comm", $comm);
        $this->view->assign("allergy_history", $allergy_history);
        $this->view->assign("allergy_history_json", json_encode($allergy_history));
        $this->view->assign("family_history", $family_history);
        $this->view->assign("disease_history", $disease_history);
        $this->view->assign("disease_history_json", json_encode($disease_history));
        $this->view->assign("deformity_type", $deformity_type);
        $this->view->assign("deformity_type_json", json_encode($deformity_type));
        //验证是否选中用户，因必须添加封面，所以此页面已默认被作为编辑页面处理
        //获取机构ID
        $org_id = $this->user['org_id'];
        //获取医生ID
        $staff_id = $this->user['uuid'];
        $individual_session = new Zend_Session_Namespace("individual_core");

        $uuid = $this->_request->getParam('uuid') ? $this->_request->getParam('uuid') :
            $individual_session->uuid;
        //$uuid=$individual_session->uuid?$individual_session->uuid:$this->_request->getParam('uuid');

        if ($uuid == "")
        {
            message("对不起，你必须先选择一个用户才能进入此页面", array("返回选择用户" => __BASEPATH .
                    "iha/index/index"));
        }
        else
        {
            //读取个人核心记录
            $core = new Tindividual_core();
            $core->whereAdd("uuid='$uuid'");
            //$core->whereAdd("org_id='$org_id'");
            if ($core->count())
            {
                $core = new Tindividual_core();
                $core->whereAdd("uuid='$uuid'");
                //$core->whereAdd("org_id='$org_id'");
                $core->find(true);
                //因加密需要，处理姓名、身份证、本人电话
                if ($this->user['role_en_name'] != 'doctor')
                {
                    $core->name = "*";
                    $core->identity_number = "*";
                    $core->phone_number = "*";
                }
                //显示照片
                if (file_exists(__SITEROOT . "upload/" . $core->uuid . ".gif"))
                {
                    $this->view->assign("headpic", __BASEPATH . "upload/" . $core->uuid . ".gif");
                }
                else
                {
                    $this->view->assign("headpic", "");
                }
                //特殊处理日期，因为日期是时间戳
                $core->date_of_birth = $core->date_of_birth ? adodb_date("Y-m-d", $core->
                    date_of_birth) : "";
                $core->filing_time = $core->filing_time ? adodb_date("Y-m-d", $core->
                    filing_time) : "";
                //处理建档医生
                $core->staff_name = get_staff_name_byid($core->staff_id);
                //处理性别
                $core->sex = array_search_for_other($core->sex, $sex);
                //处理民族
                $core->race = array_search_for_other($core->race, $race);
                $this->view->assign("core", $core);

                //读取个人扩展信息
                $individual = new Tindividual_archive();
                $individual->whereAdd("id='$uuid'");
                //$individual->whereAdd("org_id='$org_id'");
                $individual->find(true);
                //因加密原因，隐藏工作单位  联系人姓名 联系人电话
                if ($this->user['role_en_name'] != 'doctor')
                {
                    $individual->unit_name = "*";
                    $individual->contact = "*";
                    $individual->contact_number = "*";
                }
                //文化程度
                $individual->study_history = array_search_for_other($individual->study_history,
                    $school_type);
                //常住类型
                $individual->residence = array_search_for_other($individual->residence, $registered_permanent_residence);
                //职业
                $individual->occupation = array_search_for_other($individual->occupation, $occupation);
                //婚姻
                $individual->marriage = array_search_for_other($individual->marriage, $marriage);
                //手术史
                $individual->surgery_history = array_search_for_other($individual->
                    surgery_history, $comm);
                //外伤史
                $individual->trauma_history = array_search_for_other($individual->
                    trauma_history, $comm);
                //输血史
                $individual->blood_history = array_search_for_other($individual->blood_history,
                    $comm);
                //疾病史
                $individual->genetic_diseases_history = array_search_for_other($individual->
                    genetic_diseases_history, $comm);

                //生活环境
                $individual->kitchen_exhaust = array_search_for_other($individual->
                    kitchen_exhaust, $iha_kitchen_exhaust);
                $individual->fuel_type = array_search_for_other($individual->fuel_type, $iha_fuel_type);
                $individual->water = array_search_for_other($individual->water, $iha_water);
                $individual->toilet = array_search_for_other($individual->toilet, $iha_toilet);
                $individual->livestock_column = array_search_for_other($individual->
                    livestock_column, $iha_livestock_column);
                $this->view->assign("individual", $individual);
                //读取血型
                require_once __SITEROOT . '/library/Models/blood_type.php';
                $blood = new Tblood_type();
                $blood->whereAdd("id='$uuid'");
                //$blood->whereAdd("org_id='$org_id'");
                $blood->find(true);
                $blood->abo_bloodtype = array_search_for_other($blood->abo_bloodtype, $ABO_bloodtype);
                $blood->rh_bloodtype = array_search_for_other($blood->rh_bloodtype, $RH_bloodtype);
                $this->view->assign("blood", $blood);
                //读取医疗支付方式
                require_once __SITEROOT . '/library/Models/charge_style.php';
                $charge = new Tcharge_style();
                $charge->whereAdd("id='$uuid'");
                //$charge->whereAdd("org_id='$org_id'");
                $charge->find();
                $charge_array = array();
                $i = 0;
                $other_sign = 0;
                $charge_comment = ''; //用于存储自定义字段
                while ($charge->fetch())
                {
                    if ($charge->charge_style == "-99")
                    {
                        $charge_array[$i]['display_style'] = array_search_for_other("-99", $charge_style);
                        $other_sign = 1; //设置显示隐藏文本框标志
                        $charge_comment = $charge->charge_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                    }
                    else
                    {
                        $charge_array[$i]['display_style'] = array_search_for_other($charge->
                            charge_style, $charge_style);
                    }
                    $i++;
                }
                $this->view->assign("charge", $charge_array);
                $this->view->assign("charge_sign", $other_sign);
                $this->view->assign("charge_comment", $charge_comment);
                //暴露史 2011标准
                require_once __SITEROOT . '/library/Models/exposure_history.php';
                $exposure = new Texposure_history();
                $exposure->whereAdd("id='$uuid'");
                //$allergy->whereAdd("org_id='$org_id'");
                $exposure->find();
                $exposure_array = array();
                $i = 0;
                while ($exposure->fetch())
                {
                    $exposure_array[$i]['code'] = array_search_for_other($exposure->exposure_code, $iha_exposure_history);
                    $i++;
                }
                $this->view->assign("exposure", $exposure_array);
                //读取药物过敏史
                require_once __SITEROOT . '/library/Models/allergy.php';
                $allergy = new Tallergy();
                $allergy->whereAdd("id='$uuid'");
                //$allergy->whereAdd("org_id='$org_id'");
                $allergy->find();
                $allergy_array = array();
                $i = 0;
                $allergy_sign = 0;
                $allergy_comment = ''; //用于存储自定义字段
                while ($allergy->fetch())
                {
                    if ($allergy->allergy_code == "-99")
                    {
                        $allergy_array[$i]['code'] = array_search_for_other("-99", $allergy_history);
                        $allergy_sign = 1; //设置显示隐藏文本框标志
                        $allergy_comment = $allergy->allergy_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                    }
                    else
                    {
                        $allergy_array[$i]['code'] = array_search_for_other($allergy->allergy_code, $allergy_history);
                    }
                    $i++;
                }
                $this->view->assign("allergy", $allergy_array);
                $this->view->assign("allergy_sign", $allergy_sign);
                $this->view->assign("allergy_comment", $allergy_comment);
                //读取疾病史
                require_once __SITEROOT . '/library/Models/clinical_history.php';
                $clinical_history = new Tclinical_history();
                $clinical_history->orderby("disease_code asc");
                $clinical_history->whereAdd("id='$uuid'");
                $clinical_history->find();
                $clinical_array = array();
                $i = 0;
                $clinical_sign = 0;
                $clinical_comment = ''; //用于存储自定义字段
                while ($clinical_history->fetch())
                {
                    //echo "<pre>";
                    //var_dump($clinical_array);
                    //echo "</pre>";
                    if ($clinical_history->disease_code == "-99")
                    {
                        $clinical_array[$i]['code'] = array_search_for_other("-99", $disease_history);
                        $clinical_sign = 1; //设置显示隐藏文本框标志
                        $clinical_comment = $clinical_history->disease_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                    }
                    else
                    {
                        $clinical_array[$i]['code'] = array_search_for_other($clinical_history->
                            disease_code, $disease_history);
                    }
                    if($clinical_array[$i]['code']!='1')
                    {
                        $clinical_array[$i]['year'] = $clinical_history->disease_date ? adodb_date("Y",
                            $clinical_history->disease_date) : "";
                        $clinical_array[$i]['month'] = $clinical_history->disease_date ? adodb_date("m",
                            $clinical_history->disease_date) : "";
                        $clinical_array[$i]['day'] = $clinical_history->disease_date ? adodb_date("d", $clinical_history->
                            disease_date) : "";
                    }
                    $i++;
                }
                $this->view->assign("clinical", $clinical_array);
                $this->view->assign("clinical_sign", $clinical_sign);
                $this->view->assign("clinical_comment", $clinical_comment);
                //读取手术史
                require_once __SITEROOT . '/library/Models/surgical_history.php';
                $surgical_history = new Tsurgical_history();
                $surgical_history->whereAdd("id='$uuid'");
                //$surgical_history->whereAdd("org_id='$org_id'");
                $surgical_history->orderBy('operation_date ASC');
                $surgical_history->find();
                $surgical_array = array();
                $i = 0;
                while ($surgical_history->fetch())
                {
                    $surgical_array[$i]['code'] = $surgical_history->operation_id;
                    $surgical_array[$i]['year'] = $surgical_history->operation_date ? adodb_date("Y-m-d",
                        $surgical_history->operation_date) : "";
                    $i++;
                }
                $this->view->assign("surgical", $surgical_array);
                //外伤史
                require_once __SITEROOT . '/library/Models/trauma.php';
                $trauma = new Ttrauma();
                $trauma->whereAdd("id='$uuid'");
                //$trauma->whereAdd("org_id='$org_id'");
                $trauma->orderBy('trauma_time ASC');
                $trauma->find();
                $trauma_array = array();
                $i = 0;
                while ($trauma->fetch())
                {
                    $trauma_array[$i]['name'] = $trauma->trauma_name;
                    $trauma_array[$i]['time'] = $trauma->trauma_time ? adodb_date("Y-m-d", $trauma->
                        trauma_time) : "";
                    $i++;
                }
                $this->view->assign("trauma", $trauma_array);
                //输血史
                require_once __SITEROOT . '/library/Models/transfusion.php';
                $transfusion = new Ttransfusion();
                $transfusion->whereAdd("id='$uuid'");
                //$transfusion->whereAdd("org_id='$org_id'");
                $transfusion->orderBy('transfusion_date ASC');
                $transfusion->find();
                $transfusionma_array = array();
                $i = 0;
                while ($transfusion->fetch())
                {
                    $transfusionma_array[$i]['reason'] = $transfusion->quantity;
                    $transfusionma_array[$i]['time'] = $transfusion->transfusion_date ? adodb_date("Y-m-d",
                        $transfusion->transfusion_date) : "";
                    $i++;
                }
                $this->view->assign("transfusion", $transfusionma_array);
                //家族史
                require_once __SITEROOT . '/library/Models/family_history.php';
                $family_historys = new Tfamily_history();
                $family_historys->whereAdd("id='$uuid'");
                //$family_historys->whereAdd("org_id='$org_id'");
                //$family_historys->orderby("relationship");
                $family_historys->find();
                $family_array = array();
                $i = 0;
                $j = 0;
                $m = 0;
                $n = 0;
                $family_sign = array(
                    "farther" => '0',
                    "mother" => '0',
                    "brother" => '0',
                    "son" => '0');
                $family_comment = array(
                    "farther" => '',
                    "mother" => '',
                    "brother" => '',
                    "son" => ''); //用于存储自定义字段
                while ($family_historys->fetch())
                {
                    switch ($family_historys->relationship)
                    {
                        case "farther":
                            {
                                if ($family_historys->disease_code == "-99")
                                {
                                    $family_array[$family_historys->relationship][$i]['code'] =
                                        array_search_for_other("-99", $disease_history);
                                    $family_sign[$family_historys->relationship] = 1; //设置显示隐藏文本框标志
                                    $family_comment[$family_historys->relationship] = $family_historys->
                                        family_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                                }
                                else
                                {
                                    $family_array[$family_historys->relationship][$i]['code'] =
                                        array_search_for_other($family_historys->disease_code, $disease_history);
                                }
                                $i++;
                                break;
                            }
                        case "mother":
                            {
                                if ($family_historys->disease_code == "-99")
                                {
                                    $family_array[$family_historys->relationship][$j]['code'] =
                                        array_search_for_other("-99", $disease_history);
                                    $family_sign[$family_historys->relationship] = 1; //设置显示隐藏文本框标志
                                    $family_comment[$family_historys->relationship] = $family_historys->
                                        family_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                                }
                                else
                                {
                                    $family_array[$family_historys->relationship][$j]['code'] =
                                        array_search_for_other($family_historys->disease_code, $disease_history);
                                }
                                $j++;
                                break;
                            }
                        case "brother":
                            {
                                if ($family_historys->disease_code == "-99")
                                {
                                    $family_array[$family_historys->relationship][$m]['code'] =
                                        array_search_for_other("-99", $disease_history);
                                    $family_sign[$family_historys->relationship] = 1; //设置显示隐藏文本框标志
                                    $family_comment[$family_historys->relationship] = $family_historys->
                                        family_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                                }
                                else
                                {
                                    $family_array[$family_historys->relationship][$m]['code'] =
                                        array_search_for_other($family_historys->disease_code, $disease_history);
                                }
                                $m++;
                                break;
                            }
                        case "son":
                            {
                                if ($family_historys->disease_code == "-99")
                                {
                                    $family_array[$family_historys->relationship][$n]['code'] =
                                        array_search_for_other("-99", $disease_history);
                                    $family_sign[$family_historys->relationship] = 1; //设置显示隐藏文本框标志
                                    $family_comment[$family_historys->relationship] = $family_historys->
                                        family_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                                }
                                else
                                {
                                    $family_array[$family_historys->relationship][$n]['code'] =
                                        array_search_for_other($family_historys->disease_code, $disease_history);
                                }
                                $n++;
                                break;
                            }
                        default:
                            {
                                break;
                            }
                    }
                }
                $this->view->assign("family", $family_array);
                $this->view->assign("family_sign", $family_sign);
                $this->view->assign("family_comment", $family_comment);
                //遗传病史
                require_once __SITEROOT . '/library/Models/genetic_diseases.php';
                $genetic_diseases = new Tgenetic_diseases();
                $genetic_diseases->whereAdd("id='$uuid'");
                //$genetic_diseases->whereAdd("org_id='$org_id'");
                $genetic_diseases->find(true);
                $this->view->assign("genetic", $genetic_diseases);
                //残疾状况
                require_once __SITEROOT . '/library/Models/deformity.php';
                $deformity = new Tdeformity();
                $deformity->orderby("deformity_type asc");
                $deformity->whereAdd("id='$uuid'");
                //$deformity->whereAdd("org_id='$org_id'");
                $deformity->find();
                $deformity_array = array();
                $i = 0;
                $deformity_sign = 0;
                $deformity_comment = ''; //用于存储自定义字段
                while ($deformity->fetch())
                {
                    if ($deformity->deformity_type == "-99")
                    {
                        $deformity_array[$i]['code'] = array_search_for_other("-99", $deformity_type);
                        $deformity_sign = 1; //设置显示隐藏文本框标志
                        $deformity_comment = $deformity->deformity_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                    }
                    else
                    {
                        $deformity_array[$i]['code'] = array_search_for_other($deformity->
                            deformity_type, $deformity_type);
                    }
                    $i++;
                }
                $this->view->assign("deformity", $deformity_array);
                $this->view->assign("deformity_sign", $deformity_sign);
                $this->view->assign("deformity_comment", $deformity_comment);
                if ($this->haveWritePrivilege)
                {
                    $this->view->ajax_save_disabled = "";
                }
                else
                {
                    $this->view->ajax_save_disabled = "disabled";
                }

            }
            else
            {
                //查询记录数为空，报错
                message("对不起，该用户暂时无法编辑", array("重新选择用户" => __BASEPATH . "iha/index/index"));
            }

        }
        $this->view->page = $this->_request->getParam('para_page');
        $this->view->opener = $this->_request->getParam('opener');
        //echo $this->_request->getParam('para_page');

        $this->view->display("add.html");
    }
     /**
     * 打印个人信息
     */
    public function printAction()
    {
        require_once __SITEROOT . '/library/custom/comm_function.php';
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php';
        $this->view->assign("sex", $sex);
        $this->view->assign("registered_permanent_residence", $registered_permanent_residence);
        $this->view->assign("school_type", $school_type);
        $this->view->assign("occupation", $occupation);
        $this->view->assign("race", $race);
        $this->view->assign("races", $races);
        $this->view->assign("marriage", $marriage);
        $this->view->assign("charge_style", $charge_style);
        $this->view->assign("charge_style_json", json_encode($charge_style)); //因为JS文件中使用
        $this->view->assign("ABO_bloodtype", $ABO_bloodtype);
        $this->view->assign("RH_bloodtype", $RH_bloodtype);
        $this->view->assign("exposure_history", $iha_exposure_history); //暴露史，2011标准
        $this->view->assign("iha_kitchen_exhaust", $iha_kitchen_exhaust); //厨房排风设施
        $this->view->assign("iha_fuel_type", $iha_fuel_type); //燃料类型
        $this->view->assign("iha_water", $iha_water); //饮水
        $this->view->assign("iha_toilet", $iha_toilet); //厕所
        $this->view->assign("iha_livestock_column", $iha_livestock_column); //禽畜栏
        $this->view->assign("comm", $comm);
        $this->view->assign("allergy_history", $allergy_history);
        $this->view->assign("allergy_history_json", json_encode($allergy_history));
        $this->view->assign("family_history", $family_history);
        $this->view->assign("disease_history", $disease_history);
        $this->view->assign("disease_history_json", json_encode($disease_history));
        $this->view->assign("deformity_type", $deformity_type);
        $this->view->assign("deformity_type_json", json_encode($deformity_type));
        //验证是否选中用户，因必须添加封面，所以此页面已默认被作为编辑页面处理
        //获取机构ID
        $org_id = $this->user['org_id'];
        //获取医生ID
        $staff_id = $this->user['uuid'];
        $individual_session = new Zend_Session_Namespace("individual_core");

        $uuid = $this->_request->getParam('uuid') ? $this->_request->getParam('uuid') :
            $individual_session->uuid;
        //$uuid=$individual_session->uuid?$individual_session->uuid:$this->_request->getParam('uuid');

        if ($uuid == "")
        {
            message("对不起，你必须先选择一个用户才能进入此页面", array("返回选择用户" => __BASEPATH .
                    "iha/index/index"));
        }
        else
        {
            //读取个人核心记录
            $core = new Tindividual_core();
            $core->whereAdd("uuid='$uuid'");
            //$core->whereAdd("org_id='$org_id'");
            if ($core->count())
            {
                $core = new Tindividual_core();
                $core->whereAdd("uuid='$uuid'");
                //$core->whereAdd("org_id='$org_id'");
                $core->find(true);
                //因加密需要，处理姓名、身份证、本人电话
                if ($this->user['role_en_name'] != 'doctor')
                {
                    $core->name = "*";
                    $core->identity_number = "*";
                    $core->phone_number = "*";
                }
                //显示照片
                if (file_exists(__SITEROOT . "upload/" . $core->uuid . ".gif"))
                {
                    $this->view->assign("headpic", __BASEPATH . "upload/" . $core->uuid . ".gif");
                }
                else
                {
                    $this->view->assign("headpic", "");
                }
                //特殊处理日期，因为日期是时间戳
                $core->date_of_birth = $core->date_of_birth ? adodb_date("Y-m-d", $core->
                    date_of_birth) : "";
                $core->filing_time = $core->filing_time ? adodb_date("Y-m-d", $core->
                    filing_time) : "";
                //处理建档医生
                $core->staff_name = get_staff_name_byid($core->staff_id);
                //处理性别
                $core->sex = array_search_for_other($core->sex, $sex);
                //处理民族
                $core->race = array_search_for_other($core->race, $race);
                $this->view->assign("core", $core);

                //读取个人扩展信息
                $individual = new Tindividual_archive();
                $individual->whereAdd("id='$uuid'");
                //$individual->whereAdd("org_id='$org_id'");
                $individual->find(true);
                //因加密原因，隐藏工作单位  联系人姓名 联系人电话
                if ($this->user['role_en_name'] != 'doctor')
                {
                    $individual->unit_name = "*";
                    $individual->contact = "*";
                    $individual->contact_number = "*";
                }
                //文化程度
                $individual->study_history = array_search_for_other($individual->study_history,
                    $school_type);
                //常住类型
                $individual->residence = array_search_for_other($individual->residence, $registered_permanent_residence);
                //职业
                $individual->occupation = array_search_for_other($individual->occupation, $occupation);
                //婚姻
                $individual->marriage = array_search_for_other($individual->marriage, $marriage);
                //手术史
                $individual->surgery_history = array_search_for_other($individual->
                    surgery_history, $comm);
                //外伤史
                $individual->trauma_history = array_search_for_other($individual->
                    trauma_history, $comm);
                //输血史
                $individual->blood_history = array_search_for_other($individual->blood_history,
                    $comm);
                //疾病史
                $individual->genetic_diseases_history = array_search_for_other($individual->
                    genetic_diseases_history, $comm);

                //生活环境
                $individual->kitchen_exhaust = array_search_for_other($individual->
                    kitchen_exhaust, $iha_kitchen_exhaust);
                $individual->fuel_type = array_search_for_other($individual->fuel_type, $iha_fuel_type);
                $individual->water = array_search_for_other($individual->water, $iha_water);
                $individual->toilet = array_search_for_other($individual->toilet, $iha_toilet);
                $individual->livestock_column = array_search_for_other($individual->
                    livestock_column, $iha_livestock_column);
                $this->view->assign("individual", $individual);
                //读取血型
                require_once __SITEROOT . '/library/Models/blood_type.php';
                $blood = new Tblood_type();
                $blood->whereAdd("id='$uuid'");
                //$blood->whereAdd("org_id='$org_id'");
                $blood->find(true);
                $blood->abo_bloodtype = array_search_for_other($blood->abo_bloodtype, $ABO_bloodtype);
                $blood->rh_bloodtype = array_search_for_other($blood->rh_bloodtype, $RH_bloodtype);
                $this->view->assign("blood", $blood);
                //读取医疗支付方式
                require_once __SITEROOT . '/library/Models/charge_style.php';
                $charge = new Tcharge_style();
                $charge->whereAdd("id='$uuid'");
                //$charge->whereAdd("org_id='$org_id'");
                $charge->find();
                $charge_array = array();
                $i = 0;
                $other_sign = 0;
                $charge_comment = ''; //用于存储自定义字段
                while ($charge->fetch())
                {
                    if ($charge->charge_style == "-99")
                    {
                        $charge_array[$i]['display_style'] = array_search_for_other("-99", $charge_style);
                        $other_sign = 1; //设置显示隐藏文本框标志
                        $charge_comment = $charge->charge_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                    }
                    else
                    {
                        $charge_array[$i]['display_style'] = array_search_for_other($charge->
                            charge_style, $charge_style);
                    }
                    $i++;
                }
                $this->view->assign("charge", $charge_array);
                $this->view->assign("charge_sign", $other_sign);
                $this->view->assign("charge_comment", $charge_comment);
                //暴露史 2011标准
                require_once __SITEROOT . '/library/Models/exposure_history.php';
                $exposure = new Texposure_history();
                $exposure->whereAdd("id='$uuid'");
                //$allergy->whereAdd("org_id='$org_id'");
                $exposure->find();
                $exposure_array = array();
                $i = 0;
                while ($exposure->fetch())
                {
                    $exposure_array[$i]['code'] = array_search_for_other($exposure->exposure_code, $iha_exposure_history);
                    $i++;
                }
                $this->view->assign("exposure", $exposure_array);
                //读取药物过敏史
                require_once __SITEROOT . '/library/Models/allergy.php';
                $allergy = new Tallergy();
                $allergy->whereAdd("id='$uuid'");
                //$allergy->whereAdd("org_id='$org_id'");
                $allergy->find();
                $allergy_array = array();
                $i = 0;
                $allergy_sign = 0;
                $allergy_comment = ''; //用于存储自定义字段
                while ($allergy->fetch())
                {
                    if ($allergy->allergy_code == "-99")
                    {
                        $allergy_array[$i]['code'] = array_search_for_other("-99", $allergy_history);
                        $allergy_sign = 1; //设置显示隐藏文本框标志
                        $allergy_comment = $allergy->allergy_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                    }
                    else
                    {
                        $allergy_array[$i]['code'] = array_search_for_other($allergy->allergy_code, $allergy_history);
                    }
                    $i++;
                }
                $this->view->assign("allergy", $allergy_array);
                $this->view->assign("allergy_sign", $allergy_sign);
                $this->view->assign("allergy_comment", $allergy_comment);
                //读取疾病史
                require_once __SITEROOT . '/library/Models/clinical_history.php';
                $clinical_history = new Tclinical_history();
                $clinical_history->orderby("disease_code asc");
                $clinical_history->whereAdd("id='$uuid'");
                $clinical_history->find();
                $clinical_array = array();
                $i = 0;
                $clinical_sign = 0;
                $clinical_comment = ''; //用于存储自定义字段
                while ($clinical_history->fetch())
                {
                    //echo "<pre>";
                    //var_dump($clinical_array);
                    //echo "</pre>";
                    if ($clinical_history->disease_code == "-99")
                    {
                        $clinical_array[$i]['code'] = array_search_for_other("-99", $disease_history);
                        $clinical_sign = 1; //设置显示隐藏文本框标志
                        $clinical_comment = $clinical_history->disease_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                    }
                    else
                    {
                        $clinical_array[$i]['code'] = array_search_for_other($clinical_history->
                            disease_code, $disease_history);
                    }
                    $clinical_array[$i]['year'] = $clinical_history->disease_date ? adodb_date("Y",
                        $clinical_history->disease_date) : "";
                    $clinical_array[$i]['month'] = $clinical_history->disease_date ? adodb_date("m",
                        $clinical_history->disease_date) : "";
                    $clinical_array[$i]['day'] = $clinical_history->disease_date ? adodb_date("d", $clinical_history->
                        disease_date) : "";
                    $i++;
                }
                $this->view->assign("clinical", $clinical_array);
                $this->view->assign("clinical_sign", $clinical_sign);
                $this->view->assign("clinical_comment", $clinical_comment);
                //读取手术史
                require_once __SITEROOT . '/library/Models/surgical_history.php';
                $surgical_history = new Tsurgical_history();
                $surgical_history->whereAdd("id='$uuid'");
                //$surgical_history->whereAdd("org_id='$org_id'");
                $surgical_history->orderBy('operation_date ASC');
                $surgical_history->find();
                $surgical_array = array();
                $i = 0;
                while ($surgical_history->fetch())
                {
                    $surgical_array[$i]['code'] = $surgical_history->operation_id;
                    $surgical_array[$i]['year'] = $surgical_history->operation_date ? adodb_date("Y-m-d",
                        $surgical_history->operation_date) : "";
                    $i++;
                }
                $this->view->assign("surgical", $surgical_array);
                //外伤史
                require_once __SITEROOT . '/library/Models/trauma.php';
                $trauma = new Ttrauma();
                $trauma->whereAdd("id='$uuid'");
                //$trauma->whereAdd("org_id='$org_id'");
                $trauma->orderBy('trauma_time ASC');
                $trauma->find();
                $trauma_array = array();
                $i = 0;
                while ($trauma->fetch())
                {
                    $trauma_array[$i]['name'] = $trauma->trauma_name;
                    $trauma_array[$i]['time'] = $trauma->trauma_time ? adodb_date("Y-m-d", $trauma->
                        trauma_time) : "";
                    $i++;
                }
                $this->view->assign("trauma", $trauma_array);
                //输血史
                require_once __SITEROOT . '/library/Models/transfusion.php';
                $transfusion = new Ttransfusion();
                $transfusion->whereAdd("id='$uuid'");
                //$transfusion->whereAdd("org_id='$org_id'");
                $transfusion->orderBy('transfusion_date ASC');
                $transfusion->find();
                $transfusionma_array = array();
                $i = 0;
                while ($transfusion->fetch())
                {
                    $transfusionma_array[$i]['reason'] = $transfusion->quantity;
                    $transfusionma_array[$i]['time'] = $transfusion->transfusion_date ? adodb_date("Y-m-d",
                        $transfusion->transfusion_date) : "";
                    $i++;
                }
                $this->view->assign("transfusion", $transfusionma_array);
                //家族史
                require_once __SITEROOT . '/library/Models/family_history.php';
                $family_historys = new Tfamily_history();
                $family_historys->whereAdd("id='$uuid'");
                //$family_historys->whereAdd("org_id='$org_id'");
                //$family_historys->orderby("relationship");
                $family_historys->find();
                $family_array = array();
                $i = 0;
                $j = 0;
                $m = 0;
                $n = 0;
                $family_sign = array(
                    "farther" => '0',
                    "mother" => '0',
                    "brother" => '0',
                    "son" => '0');
                $family_comment = array(
                    "farther" => '',
                    "mother" => '',
                    "brother" => '',
                    "son" => ''); //用于存储自定义字段
                while ($family_historys->fetch())
                {
                    switch ($family_historys->relationship)
                    {
                        case "farther":
                            {
                                if ($family_historys->disease_code == "-99")
                                {
                                    $family_array[$family_historys->relationship][$i]['code'] =
                                        array_search_for_other("-99", $disease_history);
                                    $family_sign[$family_historys->relationship] = 1; //设置显示隐藏文本框标志
                                    $family_comment[$family_historys->relationship] = $family_historys->
                                        family_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                                }
                                else
                                {
                                    $family_array[$family_historys->relationship][$i]['code'] =
                                        array_search_for_other($family_historys->disease_code, $disease_history);
                                }
                                $i++;
                                break;
                            }
                        case "mother":
                            {
                                if ($family_historys->disease_code == "-99")
                                {
                                    $family_array[$family_historys->relationship][$j]['code'] =
                                        array_search_for_other("-99", $disease_history);
                                    $family_sign[$family_historys->relationship] = 1; //设置显示隐藏文本框标志
                                    $family_comment[$family_historys->relationship] = $family_historys->
                                        family_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                                }
                                else
                                {
                                    $family_array[$family_historys->relationship][$j]['code'] =
                                        array_search_for_other($family_historys->disease_code, $disease_history);
                                }
                                $j++;
                                break;
                            }
                        case "brother":
                            {
                                if ($family_historys->disease_code == "-99")
                                {
                                    $family_array[$family_historys->relationship][$m]['code'] =
                                        array_search_for_other("-99", $disease_history);
                                    $family_sign[$family_historys->relationship] = 1; //设置显示隐藏文本框标志
                                    $family_comment[$family_historys->relationship] = $family_historys->
                                        family_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                                }
                                else
                                {
                                    $family_array[$family_historys->relationship][$m]['code'] =
                                        array_search_for_other($family_historys->disease_code, $disease_history);
                                }
                                $m++;
                                break;
                            }
                        case "son":
                            {
                                if ($family_historys->disease_code == "-99")
                                {
                                    $family_array[$family_historys->relationship][$n]['code'] =
                                        array_search_for_other("-99", $disease_history);
                                    $family_sign[$family_historys->relationship] = 1; //设置显示隐藏文本框标志
                                    $family_comment[$family_historys->relationship] = $family_historys->
                                        family_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                                }
                                else
                                {
                                    $family_array[$family_historys->relationship][$n]['code'] =
                                        array_search_for_other($family_historys->disease_code, $disease_history);
                                }
                                $n++;
                                break;
                            }
                        default:
                            {
                                break;
                            }
                    }
                }
                $this->view->assign("family", $family_array);
                $this->view->assign("family_sign", $family_sign);
                $this->view->assign("family_comment", $family_comment);
                //遗传病史
                require_once __SITEROOT . '/library/Models/genetic_diseases.php';
                $genetic_diseases = new Tgenetic_diseases();
                $genetic_diseases->whereAdd("id='$uuid'");
                //$genetic_diseases->whereAdd("org_id='$org_id'");
                $genetic_diseases->find(true);
                $this->view->assign("genetic", $genetic_diseases);
                //残疾状况
                require_once __SITEROOT . '/library/Models/deformity.php';
                $deformity = new Tdeformity();
                $deformity->orderby("deformity_type asc");
                $deformity->whereAdd("id='$uuid'");
                //$deformity->whereAdd("org_id='$org_id'");
                $deformity->find();
                $deformity_array = array();
                $i = 0;
                $deformity_sign = 0;
                $deformity_comment = ''; //用于存储自定义字段
                while ($deformity->fetch())
                {
                    if ($deformity->deformity_type == "-99")
                    {
                        $deformity_array[$i]['code'] = array_search_for_other("-99", $deformity_type);
                        $deformity_sign = 1; //设置显示隐藏文本框标志
                        $deformity_comment = $deformity->deformity_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                    }
                    else
                    {
                        $deformity_array[$i]['code'] = array_search_for_other($deformity->
                            deformity_type, $deformity_type);
                    }
                    $i++;
                }
                $this->view->assign("deformity", $deformity_array);
                $this->view->assign("deformity_sign", $deformity_sign);
                $this->view->assign("deformity_comment", $deformity_comment);
                if ($this->haveWritePrivilege)
                {
                    $this->view->ajax_save_disabled = "";
                }
                else
                {
                    $this->view->ajax_save_disabled = "disabled";
                }

            }
            else
            {
                //查询记录数为空，报错
                message("对不起，该用户暂时无法编辑", array("重新选择用户" => __BASEPATH . "iha/index/index"));
            }

        }
        $this->view->page = $this->_request->getParam('para_page');
        $this->view->opener = $this->_request->getParam('opener');
        //echo $this->_request->getParam('para_page');

        $this->view->display("print.html");
    }
    /**
     * 添加和编辑写入数据库
     * 根据新的规则，核心表数据由封面生成，此页面此负责扩展信息的保存
     * 疾病史等表采用先清空，后保存的方式保存
     */
    public function editinAction()
    {
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/custom/iha_comm.php';
        require_once __SITEROOT . '/library/custom/comm_function.php';
        require_once __SITEROOT . '/library/data_arr/arrdata.php'; //引入数据字典
		//插入第三方数据库
		require_once(__SITEROOT . 'library/third_party.php');//			
		require_once __SITEROOT . "library/Models/t_jk_card.php";//银海健康卡			
		$insert_array=array();	
		$core_array=array();
		$t_jk_card=new Tt_jk_card(3);			
		
		
        //获取UUID
        $uuid = $this->_request->getParam('uuid'); //系统标识符
        //获取机构ID
        $org_id = $this->user['org_id'];
        //获取医生ID
        $staff_id = $this->user['uuid'];
        $core = new Tindividual_core();
        $time = time();
        $core->sex = array_code_change($this->_request->getParam('sex'), $sex);
		if(!empty($core->sex))
		$core_array[]="sex=$core->sex";
        //$core->date_of_birth=mkunixstamp($this->_request->getParam('date_of_birth'));//生日
        $core->race = array_code_change($this->_request->getParam('race'), $race); //民族
		if(!empty($core->race))
		$core_array[]="race=$core->race";
        if (array_code_change($this->_request->getParam('race'), $race) == "2")
        {
            //选择少数民族的时候，我们要存储少数民族选项
            $core->race_detail = array_code_change($this->_request->getParam('races'), $races);
			if(!empty($core->detail))
			$core_array[]="race_detail=$core->detail";
        }
        $individual = new Tindividual_archive();
        $individual->contact = $this->_request->getParam('contact'); //联系人
        $individual->contact_number = $this->_request->getParam('contact_number'); //联系电话
        $individual->residence = array_code_change($this->_request->getParam('registered_permanent_residence'),
            $registered_permanent_residence); //户籍类别
        $individual->study_history = array_code_change($this->_request->getParam('study_history'),
            $school_type); //学历
        $individual->unit_name = $this->_request->getParam('unit_name'); //单位名称
        $individual->occupation = array_code_change($this->_request->getParam('occupation'),
            $occupation); //职业
        $individual->marriage = array_code_change($this->_request->getParam('marriage'),
            $marriage); //婚姻状况
        //生活环境
        $individual->kitchen_exhaust = array_code_change($this->_request->getParam('kitchen_exhaust'),
            $iha_kitchen_exhaust);
        $individual->fuel_type = array_code_change($this->_request->getParam('fuel_type'),
            $iha_fuel_type);
        $individual->water = array_code_change($this->_request->getParam('water'), $iha_water);
        $individual->toilet = array_code_change($this->_request->getParam('toilet'), $iha_toilet);
        $individual->livestock_column = array_code_change($this->_request->getParam('livestock_column'),
            $iha_livestock_column);
		
		//插入第三方数据库
		if(!empty($individual->contact))
		$insert_array[]="contact='$individual->contact'" ; //联系人
		if(!empty($individual->contact_number))
        $insert_array[]="contact_number='$individual->contact_number'"; //联系电话
		if(!empty($individual->residence))
        $insert_array[]="residence='$individual->residence"; //户籍类别
		if(!empty($individual->study_history))
        $insert_array[]="study_history=$individual->study_history";  //学历
		if(!empty($individual->contact_number))
        $insert_array[]="unit_name=$individual->unit_name";  //单位名称
		if(!empty($individual->occupation))
        $insert_array[]="occupation=$individual->occupation";  //职业
		if(!empty($individual->marriage))
        $insert_array[]="marriage=$individual->marriage "; //婚姻状况
        //生活环境
		if(!empty($individual->kitchen_exhaust))
        $insert_array[]="kitchen_exhaust=$individual->kitchen_exhaust"; 
		if(!empty($individual->fuel_type))
        $insert_array[]="fuel_type=$individual->fuel_type";
		if(!empty($individual->water))
        $insert_array[]="water=$individual->water";
		if(!empty($individual->toilet))
        $insert_array[]="toilet=$individual->toilet";
		if(!empty($individual->livestock_column))
        $insert_array[]="livestock_column=$individual->livestock_column"; 

			
        if (isset($uuid) && $uuid != "")
        {
            //校验传递的个人档案编号信息（暂时不验证）
            //更新核心表部分信息
            $core->updated = $time;
			$core_array[]="updated=$time";
            //$core->staff_id=$staff_id;//建档医生暂时不做修改，如果后期开放日志功能，那么这里需要修改建档医生信息
            $core->whereAdd("uuid='$uuid'");
            //$core->whereAdd("org_id='$org_id'");
            if ($core->update(array($this->user['uuid'], 'updated')))
            {   
				//更新第三方数据库
				
				$third_sql=third_party('individual_core',$core_array,2,$uuid);
				
				$t_jk_card->query($third_sql);
                //验证个人档案辅助表里是否有当前用户的信息，如果有，则更新，没有则插入新的记录
                //数据表给ID建立唯一索引，防止一个人同时保存多条记录的情况
                $individual_verify = new Tindividual_archive();
                $individual_verify->whereAdd("id='$uuid'");
                //$individual_verify->whereAdd("org_id='$org_id'");
                if ($individual_verify->count())
                {
                    //更新记录
                    $individual->updated = $time;
                    $individual->whereAdd("id='$uuid'");
                    //$individual->whereAdd("org_id='$org_id'");
                    $individual->update(array($this->user['uuid'], 'updated'));
					$insert_array[]="updated=$time";
					$third_sql= third_party('individual_archive',$insert_array,2,$uuid);
					$t_jk_card->query($third_sql);
                }
                else
                {
                    //写入记录
                    $individual->created = $time;
                    $individual->updated = $time;
                    $individual->staff_id = $staff_id; //医生ID
                    $individual->org_id = $org_id;
                    $individual->id = $uuid;
                    $individual->uuid = uniqid("I_");
                    $individual->status_flag = 1;
                    $individual->insert($this->user['uuid']);
					$insert_array[]="created=$time";
					$insert_array[]="updated=$time";
					$insert_array[]="staff_id=$staff_id";
					$insert_array[]="org_id=$org_id";
					$insert_array[]="id=$uuid";
					$insert_array[]="uuid=$individual->uuid";
					$insert_array[]="status_flag=1";
					$third_sql= third_party('individual_archive',$insert_array,1);
					
					$t_jk_card->query($third_sql);
					
                }
                //此处是为了下面的疾病史等字段，更新附表中的一部分统计字段
                $individual = new Tindividual_archive();
                $individual->whereAdd("id='$uuid'");
                //$individual->whereAdd("org_id='$org_id'");
                //处理医疗支付方式
                $charge_style_input = array(); //初始化
                $charge_style_input = $this->_request->getParam('charge_style');
                if (!is_empty_for_multi($charge_style_input))
                {
                    $charge_style_input = is_array($charge_style_input) ? array_unique($charge_style_input) :
                        array(); //移除恶意添加的重复值
                    require_once __SITEROOT . '/library/Models/charge_style.php';
                    foreach ($charge_style_input as $k => $v)
                    {
                        if (isset($charge_style[$v][0]))
                        {
                            //不在数据字典的记录不写入数据库
                            $charge = new Tcharge_style();
                            $charge->id = $uuid;
                            $charge->created = $time;
                            $charge->updated = $time;
                            $charge->staff_id = $staff_id; //医生ID
                            $charge->org_id = $org_id;
                            $charge->status_flag = 1;
                            $charge->uuid = uniqid("C_");
                            $charge->charge_style = $charge_style[$v][0];
                            //当值为其他时，则需要向附加字段写入文本值
							$charge_array=array();
							//插入第三方数据库
							$charge_array[]="id=$uuid";
							$charge_array[]="created=$time";
							$charge_array[]="updated=$time";
							$charge_array[]="staff_id=$staff_id";
							$charge_array[]="org_id=$org_id";
							$charge_array[]="status_flag=1";
							$charge_array[]="uuid=$charge->uuid";
							if(!empty($charge->chrage_style))
							$charge_array[]="charge_style=$charge->charge_style";
							
                            if ($charge_style[$v][0] == '-99')
                            {
                                $charge->charge_comment = $this->_request->getParam('charget_comment');
								if(!empty($charge->charge->conmment))
								$charge_array[]="charge_conmment=$charge->charge_conmment";
                            }
                             $charge->insert($this->user['uuid']);
							 $third_sql = third_party('charge_style',$insert_array,1);
							 $t_jk_card=new Tt_jk_card(3);
							 $t_jk_card->query($third_sql);
							
                            $charge->free_statement();
                        }
                    }

                }
                //清除掉之前的医疗支付方式记录
                require_once __SITEROOT . '/library/Models/charge_style.php';
                $charge = new Tcharge_style();
                $charge->whereAdd("id='$uuid'");
                $charge->whereAdd("updated<'$time'");
                $charge->delete($this->user['uuid']);
                //处理暴露史
                $exposure_history_input = array();
                $exposure_history_input = $this->_request->getParam('exposure_history');
                if (!is_empty_for_multi($exposure_history_input))
                {
                    $exposure_history_input = is_array($exposure_history_input) ? array_unique($exposure_history_input) :
                        array(); //移除恶意添加的重复值
                    require_once __SITEROOT . '/library/Models/exposure_history.php';
                    foreach ($exposure_history_input as $k => $v)
                    {
                        if (isset($iha_exposure_history[$v][0]))
                        {
                            //不在数据字典的记录不写入数据库
                            $exposure = new Texposure_history();
                            $exposure->id = $uuid;
                            $exposure->created = $time;
                            $exposure->updated = $time;
                            $exposure->staff_id = $staff_id; //医生ID
                            $exposure->org_id = $org_id;
                            $exposure->status_flag = 1;
                            $exposure->uuid = uniqid("E_");
                            $exposure->exposure_code = $iha_exposure_history[$v][0];
                            $exposure->insert($this->user['uuid']);
                            $exposure->free_statement();
                        }
                    }
                    if (in_array(array_search_for_other("1", $iha_exposure_history), $exposure_history_input))
                    {
                        $individual->exposure_history = '1';
						
                    }
                    else
                    {
                        $individual->exposure_history = '2';
                    }
                }
                else
                {
                    $individual->exposure_history = '1';
                }
				
                //清除掉之前的暴露史记录
                require_once __SITEROOT . '/library/Models/exposure_history.php';
                $exposure = new Texposure_history();
                $exposure->whereAdd("id='$uuid'");
                $exposure->whereAdd("updated<'$time'");
                $exposure->delete($this->user['uuid']);

                //处理过敏史
                $allergy_history_input = array();
                $allergy_history_input = $this->_request->getParam('allergy_history');
                if (!is_empty_for_multi($allergy_history_input))
                {
                    $allergy_history_input = is_array($allergy_history_input) ? array_unique($allergy_history_input) :
                        array(); //移除恶意添加的重复值
                    require_once __SITEROOT . '/library/Models/allergy.php';
                    foreach ($allergy_history_input as $k => $v)
                    {
                        if (isset($allergy_history[$v][0]))
                        {
                            //不在数据字典的记录不写入数据库
                            $allergy = new Tallergy();
                            $allergy->id = $uuid;
                            $allergy->created = $time;
                            $allergy->updated = $time;
                            $allergy->staff_id = $staff_id; //医生ID
                            $allergy->org_id = $org_id;
                            $allergy->status_flag = 1;
                            $allergy->uuid = uniqid("A_");
                            $allergy->allergy_code = $allergy_history[$v][0];
                            //当填写了其他时，向文本字段写入值
                            if ($allergy_history[$v][0] == '-99')
                            {
                                $allergy->allergy_comment = $this->_request->getParam('allergy_comment');
                            }
                            $allergy->insert($this->user['uuid']);
                            $allergy->free_statement();
                        }
                    }
                    if (in_array(array_search_for_other("1", $allergy_history), $allergy_history_input))
                    {
                        $individual->allergy_history = '1';
                    }
                    else
                    {
                        $individual->allergy_history = '2';
                    }
                }
                else
                {
                    $individual->allergy_history = '1';
                }
				//第三方数据库
				if(!empty($individual->allergy_history))
				$insert_array[]="allergy_history=$individual->allergy_history";
				$third_sql=third_party("allergy",$insert_array,2,$uuid);
				$t_jk_card->query($third_sql);		
                //清除掉之前的过敏史记录
                require_once __SITEROOT . '/library/Models/allergy.php';
                $allergy = new Tallergy();
                $allergy->whereAdd("id='$uuid'");
                $allergy->whereAdd("updated<'$time'");
                $allergy->delete($this->user['uuid']);
                //处理血型
                require_once __SITEROOT . '/library/Models/blood_type.php';
                $blood = new Tblood_type();
                $blood->id = $uuid;
                $blood->created = $time;
                $blood->updated = $time;
                $blood->staff_id = $staff_id; //医生ID
                $blood->org_id = $org_id;
                $blood->uuid = uniqid("B_");
                $blood->status_flag = 1;
                $abo_bloodtype = $this->_request->getParam('abo_bloodtype');
                $rh_bloodtype = $this->_request->getParam('rh_bloodtype');
                if (isset($ABO_bloodtype[$abo_bloodtype][0]))
                {
                    //不在数据字典的记录不写入数据库
                    $blood->abo_bloodtype = array_code_change($abo_bloodtype, $ABO_bloodtype);
                }
                if (isset($RH_bloodtype[$rh_bloodtype][0]))
                {
                    //不在数据字典的记录不写入数据库
                    $blood->rh_bloodtype = array_code_change($rh_bloodtype, $RH_bloodtype);
                }
                $blood->insert($this->user['uuid']);
                //清除掉之前的记录
                $blood = new Tblood_type();
                $blood->whereAdd("id='$uuid'");
                //$blood->whereAdd("org_id='$org_id'");
                $blood->whereAdd("updated<'$time'");
                $blood->delete($this->user['uuid']);

                //2012-11-22修改既往史写入数据库方式：弃用原删除后重新写入的方式，采用查询该慢病是否存在，存在则修改，不存在就插入的方式，以慢病代码为关键字
                //处理慢病既往史
                $disease_history_input = $this->_request->getParam('disease_history');
                $disease_year = $this->_request->getParam('year');
                $disease_month = $this->_request->getParam('month');
                $disease_day = $this->_request->getParam('day');
                require_once __SITEROOT . '/library/Models/clinical_history.php';
                //如果默认填写1或者不填，则默认疾病史为无
                if (is_empty_for_multi($disease_history_input))
                {
                    $individual->disease_history = '1';
                    //选择了无，则删除所有慢病记录
                    $clinical_history = new Tclinical_history();
                    $clinical_history->whereAdd("id='$uuid'");
                    $clinical_history->delete($this->user['uuid']);
                    $clinical_history->free_statement();
                }
                else
                {
                    $groupid = uniqid("G_");
                    $disease_history_input = is_array($disease_history_input) ? array_unique($disease_history_input) :
                        array(); //移除恶意添加的重复值
                    $disease_code=array();
                    foreach ($disease_history_input as $k => $v)
                    {
                        if (isset($disease_history[$v][0]) && $disease_history[$v][0] != "")
                        {
                            $disease_code[]=$disease_history[$v][0];
                            $clinical_history = new Tclinical_history();
                            $clinical_history->whereAdd("id='$uuid'");
                            $clinical_history->whereAdd("disease_code='".$disease_history[$v][0]."'");
                            if($clinical_history->count())
                            {
                                //更新
                                //不在数据字典的记录不写入数据库
                                $clinical_history = new Tclinical_history();
                                $clinical_history->updated = $time;
                                $clinical_history->staff_id = $staff_id; //医生ID
                                $clinical_history->org_id = $org_id;
                                $clinical_history->disease_name = $disease_history[$v][1];
                                $clinical_history->disease_code = $disease_history[$v][0];
                                //当填写了其他时，向文本字段写入值
                                if ($disease_history[$v][0] == '-99')
                                {
                                    $clinical_history->disease_comment = $this->_request->getParam('disease_comment');
                                }
                                $clinical_history->disease_state = 1;
                                //如果确诊日期大于当前日期或者小于极限日期，均错误
                                if($disease_day[$k] != '' && $disease_year[$k]>=date('Y'))
                                {
                                    $disease_year[$k]=date('Y');
                                }
                                elseif($disease_day[$k] != '' && $disease_year[$k]<=1903)
                                {
                                    $disease_year[$k]=1903;
                                }
                                else
                                {
                                    
                                }
                                if (isset($disease_year[$k]) and $disease_year[$k] != '' and $disease_month[$k] !=
                                    '' and $disease_day[$k] != '')
                                {
                                    $clinical_history->disease_date = mkunixstamp($disease_year[$k]."-".$disease_month[$k]."-".$disease_day[$k]);
                                }
                                $clinical_history->whereAdd("id='$uuid'");
                                $clinical_history->whereAdd("disease_code='".$disease_history[$v][0]."'");
                                $clinical_history->update(array($this->user['uuid'], 'updated'));
                                $clinical_history->free_statement();
                            }
                            else
                            {
                                //插入
                                //不在数据字典的记录不写入数据库
                                $clinical_history = new Tclinical_history();
                                $clinical_history->id = $uuid;
                                $clinical_history->created = $time;
                                $clinical_history->updated = $time;
                                $clinical_history->staff_id = $staff_id; //医生ID
                                $clinical_history->org_id = $org_id;
                                $clinical_history->status_flag = 1;
                                $clinical_history->uuid = uniqid("C_");
                                $clinical_history->groupid = $groupid;
                                $clinical_history->life_cycle = $time;
                                $clinical_history->disease_name = $disease_history[$v][1];
                                $clinical_history->disease_code = $disease_history[$v][0];
                                //当填写了其他时，向文本字段写入值
                                if ($disease_history[$v][0] == '-99')
                                {
                                    $clinical_history->disease_comment = $this->_request->getParam('disease_comment');
                                }
                                $clinical_history->disease_state = 1;
                                //如果确诊日期大于当前日期或者小于极限日期，均错误
                                if($disease_day[$k] != '' && $disease_year[$k]>=date('Y'))
                                {
                                    $disease_year[$k]=date('Y');
                                }
                                elseif($disease_day[$k] != '' && $disease_year[$k]<=1903)
                                {
                                    $disease_year[$k]=1903;
                                }
                                else
                                {
                                    
                                }
                                if (isset($disease_year[$k]) and $disease_year[$k] != '' and $disease_month[$k] !=
                                    '' and $disease_day[$k] != '')
                                {
                                    $clinical_history->disease_date = mkunixstamp($disease_year[$k]."-".$disease_month[$k]."-".$disease_day[$k]);
                                }
                                $clinical_history->insert($this->user['uuid']);
                                $clinical_history->free_statement();
                            }
                        }
                    }
                    if (in_array(array_search_for_other("1", $disease_history), $disease_history_input))
                    {
                        //选择了无，则删除所有慢病记录
                        $clinical_history = new Tclinical_history();
                        $clinical_history->whereAdd("id='$uuid'");
                        $clinical_history->delete($this->user['uuid']);
                        $clinical_history->free_statement();
                        $individual->disease_history = 1;
                    }
                    else
                    {
                        if(!empty($disease_code))
                        {
                            $disease_code_tmp=implode("','",$disease_code);
                            $disease_code_tmp="'".$disease_code_tmp."'";
                            //清除被手动删除的记录
                            $clinical_history = new Tclinical_history();
                            $clinical_history->whereAdd("id='$uuid'");
                            $clinical_history->whereAdd("disease_code  not in ($disease_code_tmp)");
                            $clinical_history->delete($this->user['uuid']);
                            $clinical_history->free_statement(); 
                        }
                        $individual->disease_history = 2;
                    }
                }
				//第三方数据库
				if(!empty($individual->disease_history))
						$insert_array[]="disease_history=$individual->disease_history";
                //处理手术史
                $surgery_history = $this->_request->getParam('surgery_history');
                $surgery = array_code_change($this->_request->getParam('surgery'), $comm);
                $stime = $this->_request->getParam('stime');
                if ($surgery == 2)
                {
                    //有手术史，检测是否填写手术名称
                    if (!is_empty_for_multi($surgery_history))
                    {
                        //向手术史中写入填写的手术名称及时间
                        require_once __SITEROOT . '/library/Models/surgical_history.php';
                        //由于手术史在插件使用的时候会有默认值，所以判定空值的函数对此无影响
                        //在此步骤定义一个未填写手术史的假值，如果下面手术史中有记录则自动将值修正为2
                        $individual->surgery_history = 1;
						
						
                        foreach ($surgery_history as $k => $v)
                        {
                            if ($v != "中文/拼音")
                            {
                                $surgical_history = new Tsurgical_history();
                                $surgical_history->id = $uuid;
                                $surgical_history->created = $time;
                                $surgical_history->updated = $time;
                                $surgical_history->staff_id = $staff_id; //医生ID
                                $surgical_history->org_id = $org_id;
                                $surgical_history->status_flag = 1;
                                $surgical_history->uuid = uniqid("S_");
                                $surgical_history->life_cycle = $time;
                                $surgical_history->operation_id = $v;
                                $surgical_history->operation_date = $stime[$k] ? mkunixstamp($stime[$k]) : "";
                                $surgical_history->insert($this->user['uuid']);
                                $surgical_history->free_statement();
                                $individual->surgery_history = 2;
                            }
                        }
                    }
                    else
                    {
                        //有手术史，但未填写手术名称，默认还原设置，设置为无手术史
                        $individual->surgery_history = 1;
                    }
                }
                else
                {
                    //无手术史
                    $individual->surgery_history = 1;
                }
				if(!empty($individual->surgery_history))
				$insert_array[]="surgery_history=$individual->surgery_history";
				
                //清除掉之前的手术史记录
                require_once __SITEROOT . '/library/Models/surgical_history.php';
                $surgical_history = new Tsurgical_history();
                $surgical_history->whereAdd("id='$uuid'");
                $surgical_history->whereAdd("updated<'$time'");
                $surgical_history->delete($this->user['uuid']);
                //处理外伤史
                $trauma_history = array_code_change($this->_request->getParam('trauma_history'),
                    $comm);
                $trauma_name = $this->_request->getParam('trauma_name');
                $trauma_time = $this->_request->getParam('trauma_time');
                if ($trauma_history == 2)
                {
                    if (!is_empty_for_multi($trauma_name))
                    {
                        require_once __SITEROOT . '/library/Models/trauma.php';
                        foreach ($trauma_name as $k => $v)
                        {
                            $trauma = new Ttrauma();
                            $trauma->id = $uuid;
                            $trauma->created = $time;
                            $trauma->updated = $time;
                            $trauma->staff_id = $staff_id; //医生ID
                            $trauma->org_id = $org_id;
                            $trauma->status_flag = 1;
                            $trauma->uuid = uniqid("T_");
                            $trauma->trauma_name = $v;
                            $trauma->trauma_time = $trauma_time[$k] ? mkunixstamp($trauma_time[$k]) : "";
                            $trauma->insert($this->user['uuid']);
                            $trauma->free_statement();
                        }
                        $individual->trauma_history = 2;
                    }
                    else
                    {
                        //未填写外伤名称，重置为无外伤史
                        $individual->trauma_history = 1;
                    }
                }
                else
                {
                    //无外伤史
                    $individual->trauma_history = 1;
                }
				//第三方数据库
				if(!empty($individual->trauma_history))
				$insert_array[]="trauma_history=$individual->trauma_history";
                //清除掉之前的外伤史记录
                require_once __SITEROOT . '/library/Models/trauma.php';
                $trauma = new Ttrauma();
                $trauma->whereAdd("id='$uuid'");
                $trauma->whereAdd("updated<'$time'");
                $trauma->delete($this->user['uuid']);

                //处理输血史
                $blood_history = array_code_change($this->_request->getParam('blood_history'), $comm);
                $trans_name = $this->_request->getParam('trans_name');
                $trans_time = $this->_request->getParam('trans_time');
                if ($blood_history == 2)
                {
                    if (!is_empty_for_multi($trans_time))
                    {
                        require_once __SITEROOT . '/library/Models/transfusion.php';
                        foreach ($trans_time as $k => $v)
                        {
                            $transfusion = new Ttransfusion();
                            $transfusion->id = $uuid;
                            $transfusion->created = $time;
                            $transfusion->updated = $time;
                            $transfusion->staff_id = $staff_id; //医生ID
                            $transfusion->org_id = $org_id;
                            $transfusion->status_flag = 1;
                            $transfusion->uuid = uniqid("T_");
                            $transfusion->life_cycle = $time;
                            $transfusion->quantity = $trans_name[$k];
                            $transfusion->transfusion_date = $v ? mkunixstamp($v) : "";
                            $transfusion->insert($this->user['uuid']);
                            $transfusion->free_statement();
                        }

                        $individual->blood_history = 2;
                    }
                    else
                    {
                        //填的2，但是未填写任何名称及时间，还原为无输血史
                        $individual->blood_history = 1;
                    }
                }
                else
                {
                    //无输血史
                    $individual->blood_history = 1;
                }
				//第三方数据库
				if(!empty($individual->blood_history))
				$insert_array[]="blood_history=$individual->blood_history";
				$third_sql=third_party("blood_history",$insert_array,2,$uuid);
				$t_jk_card->query($third_sql);
				
                //清除掉之前的输血史记录
                require_once __SITEROOT . '/library/Models/transfusion.php';
                $transfusion = new Ttransfusion();
                $transfusion->whereAdd("id='$uuid'");
                $transfusion->whereAdd("updated<'$time'");
                $transfusion->delete($this->user['uuid']);
                //处理遗传病史
                $genetic_diseases_history = array_code_change($this->_request->getParam('genetic_diseases_history'),
                    $comm);
                $genetic_name = $this->_request->getParam('genetic_name');
                if ($genetic_diseases_history == 2 || $genetic_name != "")
                {
                    if ($genetic_name)
                    {
                        //写入遗传病史表
                        require_once __SITEROOT . '/library/Models/genetic_diseases.php';
                        $genetic_diseases = new Tgenetic_diseases();
                        $genetic_diseases->id = $uuid;
                        $genetic_diseases->created = $time;
                        $genetic_diseases->updated = $time;
                        $genetic_diseases->staff_id = $staff_id; //医生ID
                        $genetic_diseases->org_id = $org_id;
                        $genetic_diseases->status_flag = 1;
                        $genetic_diseases->uuid = uniqid("T_");
                        $genetic_diseases->disease_name = $genetic_name;
                        $genetic_diseases->insert($this->user['uuid']);
                        $genetic_diseases->free_statement();
                        $individual->genetic_diseases_history = 2;
                    }
                    else
                    {
                        $individual->genetic_diseases_history = 1;
                    }
                }
                else
                {
                    //无遗传病史
                    $individual->genetic_diseases_history = 1;
                }
				
				//第三方数据库
				if(!empty($individual->genetic_diseases_history))
				$insert_array[]="genetic_diseases_history=$individual->genetic_diseases_history";
                //清除掉之前的遗传病史记录
                require_once __SITEROOT . '/library/Models/genetic_diseases.php';
                $genetic_diseases = new Tgenetic_diseases();
                $genetic_diseases->whereAdd("id='$uuid'");
                $genetic_diseases->whereAdd("updated<'$time'");
                $genetic_diseases->delete($this->user['uuid']);
                $genetic_diseases->free_statement();

                //处理家族史
                $farther = $this->_request->getParam('farther');
                $mother = $this->_request->getParam('mother');
                $brother = $this->_request->getParam('brother');
                $son = $this->_request->getParam('son');
                if (is_empty_for_multi($farther) && is_empty_for_multi($mother) &&
                    is_empty_for_multi($brother) && is_empty_for_multi($son))
                {
                    //无家族史
                    $individual->family_history = 1;
                }
                else
                {
                    require_once __SITEROOT . '/library/Models/family_history.php';
                    if (!is_empty_for_multi($farther))
                    {
                        $farther = is_array($farther) ? array_unique($farther) : array(); //移除恶意添加的重复值
                        foreach ($farther as $k => $v)
                        {
                            if (isset($family_history[$v][0]))
                            {
                                //只有当填写了数据字典中允许的值时才能写入到数据库中
                                $family_historys = new Tfamily_history();
                                $family_historys->id = $uuid;
                                $family_historys->created = $time;
                                $family_historys->updated = $time;
                                $family_historys->staff_id = $staff_id; //医生ID
                                $family_historys->org_id = $org_id;
                                $family_historys->status_flag = 1;
                                $family_historys->uuid = uniqid("F_");
                                $family_historys->relationship = "farther";
                                $family_historys->disease_code = $family_history[$v][0]; //其他项统一用-99
                                //当填写了其他时，向文本字段写入值
                                if ($family_history[$v][0] == "-99")
                                {
                                    $family_historys->family_comment = $this->_request->getParam('farther_comment');
                                }
                                $family_historys->insert($this->user['uuid']);
                                $family_historys->free_statement();
                            }
                        }
                    }
                    if (!is_empty_for_multi($mother))
                    {
                        $mother = is_array($mother) ? array_unique($mother) : array(); //移除恶意添加的重复值
                        foreach ($mother as $k => $v)
                        {
                            if (isset($family_history[$v][0]))
                            {
                                //只有当填写了数据字典中允许的值时才能写入到数据库中
                                $family_historys = new Tfamily_history();
                                $family_historys->id = $uuid;
                                $family_historys->created = $time;
                                $family_historys->updated = $time;
                                $family_historys->staff_id = $staff_id; //医生ID
                                $family_historys->org_id = $org_id;
                                $family_historys->status_flag = 1;
                                $family_historys->uuid = uniqid("F_");
                                $family_historys->relationship = "mother";
                                $family_historys->disease_code = $family_history[$v][0];
                                //当填写了其他时，向文本字段写入值
                                if ($family_history[$v][0] == "-99")
                                {
                                    $family_historys->family_comment = $this->_request->getParam('mother_comment');
                                }
                                $family_historys->insert($this->user['uuid']);
                                $family_historys->free_statement();
                            }
                        }
                    }
                    if (!is_empty_for_multi($brother))
                    {
                        $brother = is_array($brother) ? array_unique($brother) : array(); //移除恶意添加的重复值
                        foreach ($brother as $k => $v)
                        {
                            if (isset($family_history[$v][0]))
                            {
                                //只有当填写了数据字典中允许的值时才能写入到数据库中
                                $family_historys = new Tfamily_history();
                                $family_historys->id = $uuid;
                                $family_historys->created = $time;
                                $family_historys->updated = $time;
                                $family_historys->staff_id = $staff_id; //医生ID
                                $family_historys->org_id = $org_id;
                                $family_historys->status_flag = 1;
                                $family_historys->uuid = uniqid("F_");
                                $family_historys->relationship = "brother";
                                $family_historys->disease_code = $family_history[$v][0];
                                //当填写了其他时，向文本字段写入值
                                if ($family_history[$v][0] == "-99")
                                {
                                    $family_history->family_comment = $this->_request->getParam('brother_comment');
                                }
                                $family_historys->insert($this->user['uuid']);
                                $family_historys->free_statement();
                            }
                        }
                    }
                    if (!is_empty_for_multi($son))
                    {
                        $son = is_array($son) ? array_unique($son) : array(); //移除恶意添加的重复值
                        foreach ($son as $k => $v)
                        {
                            if (isset($family_history[$v][0]))
                            {
                                //只有当填写了数据字典中允许的值时才能写入到数据库中
                                $family_historys = new Tfamily_history();
                                $family_historys->id = $uuid;
                                $family_historys->created = $time;
                                $family_historys->updated = $time;
                                $family_historys->staff_id = $staff_id; //医生ID
                                $family_historys->org_id = $org_id;
                                $family_historys->status_flag = 1;
                                $family_historys->uuid = uniqid("F_");
                                $family_historys->relationship = "son";
                                $family_historys->disease_code = $family_history[$v][0];
                                //当填写了其他时，向文本字段写入值
                                if ($family_history[$v][0] == "-99")
                                {
                                    $family_history->family_comment = $this->_request->getParam('son_comment');
                                }
                                $family_historys->insert($this->user['uuid']);
                                $family_historys->free_statement();
                            }
                        }
                    }
                    $individual->family_history = 2;
                }
				//第三方数据库
				if(!empty($individual->family_history))
				$insert_array[]="family_history=$individual->family_history";
                //清除掉之前的家族史记录
                require_once __SITEROOT . '/library/Models/family_history.php';
                $family_historys = new Tfamily_history();
                $family_historys->whereAdd("id='$uuid'");
                $family_historys->whereAdd("updated<'$time'");
                $family_historys->delete($this->user['uuid']);
                $family_historys->free_statement();
                //处理残疾状况
                $disability_input = $this->_request->getParam('disability');
                if (!is_empty_for_multi($disability_input))
                {
                    require_once __SITEROOT . '/library/Models/deformity.php';
                    $disability_input = is_array($disability_input) ? array_unique($disability_input) :
                        array(); //移除恶意添加的重复值
                    foreach ($disability_input as $k => $v)
                    {
                        if (isset($deformity_type[$v][0]))
                        {
                            $deformity = new Tdeformity();
                            $deformity->id = $uuid;
                            $deformity->created = $time;
                            $deformity->updated = $time;
                            $deformity->staff_id = $staff_id; //医生ID
                            $deformity->org_id = $org_id;
                            $deformity->status_flag = 1;
                            $deformity->uuid = uniqid("C_");
                            $deformity->deformity_type = $deformity_type[$v][0];
                            //当填写了其他时，向文本字段写入值
                            if ($deformity_type[$v][0] == "-99")
                            {
                                $deformity->deformity_comment = $this->_request->getParam('deformity_comment');
                            }
                            $deformity->insert($this->user['uuid']);
                            $deformity->free_statement();
                        }
                    }
                    if (in_array(array_search_for_other("1", $deformity_type), $disability_input))
                    {
                        $individual->disability = 1;
                    }
                    else
                    {
                        $individual->disability = 2;
                    }
                }
                else
                {
                    $individual->disability = 1;
                }
				//第三方数据库
				if(!empty($individual->disability))
				$insert_array[]="disability=$individual->disability";
				
                //清除掉之前的记录
                require_once __SITEROOT . '/library/Models/deformity.php';
                $deformity = new Tdeformity();
                $deformity->whereAdd("id='$uuid'");
                $deformity->whereAdd("updated<'$time'");
                $deformity->delete($this->user['uuid']);
                $deformity->free_statement();
                //更新个人表里的标志字段
                $individual->updated = time();
                $individual->update(array($this->user['uuid'], 'updated'));
                //计算档案完整率
                $region_path_array = explode(",", $this->user['current_region_path'], 5);
                //取到市级path
                $region_path = $region_path_array['0'] . "," . $region_path_array['1'] . "," . $region_path_array['2'] .
                    "," . $region_path_array['3'];
                //取所有表名
                $standard_archive_rate = new Tstandard_archive_rate();
                $standard_archive_rate->whereAdd("module_name = 'individual_core'"); //个人档案模块
                $standard_archive_rate->whereAdd("region_path='$region_path'");
                //$standard_archive_rate->whereAdd("criteria='1'");
                $standard_archive_rate->selectAdd("table_name as table_name");
                //$standard_archive_rate->debugLevel(5);
                $standard_archive_rate->groupBy("table_name");
                $standard_archive_rate->find();
                while ($standard_archive_rate->fetch())
                {
                    //排除自己
                    if ($standard_archive_rate->table_name != "individual_core")
                    {
                        require_once __SITEROOT . "/library/Models/" . $standard_archive_rate->
                            table_name . ".php";
                        $temp = $standard_archive_rate->table_name;
                        $t = "T$temp";
                        $$temp = new $t;
                        $$temp->whereAdd("id='$uuid'");
                        $$temp->find(true);
                    }
                    else
                    {
                        require_once __SITEROOT . "/library/Models/" . $standard_archive_rate->
                            table_name . ".php";
                        $temp = $standard_archive_rate->table_name;
                        $t = "T$temp";
                        $$temp = new $t;
                        $$temp->whereAdd("uuid='$uuid'");
                        $$temp->find(true);
                    }
                }

                $standard_archive_rate = new Tstandard_archive_rate();
                //取本模块的所有必填字段数组
                $standard_archive_rate->whereAdd("module_name = 'individual_core'"); //个人档案模块
                $standard_archive_rate->whereAdd("region_path='$region_path'");
                $standard_archive_rate->whereAdd("criteria='1'");
                $nums_rate = 0;
                $nums_rate = $standard_archive_rate->count(); //所有字段
                $standard_archive_rate->find();
                $nums_rate_true = 0; //已填写字段数
                while ($standard_archive_rate->fetch())
                {
                    $table_name = $standard_archive_rate->table_name;
                    $column_name = $standard_archive_rate->column_name;
                    if (@isset($$table_name->$column_name) && $$table_name->$column_name)
                    {
                        $nums_rate_true++;
                    }
                }
                $rate = @round($nums_rate_true / $nums_rate, 4);
                $core = new Tindividual_core();
                $core->criteria_rate = $rate;
                $core->whereAdd("uuid='$uuid'");
                $core->updated = time();
                $core->update();
				
					//插入第三方数据库
					require_once(__SITEROOT . 'library/third_party.php');//
					require_once __SITEROOT . "library/Models/t_jk_card.php";//银海健康卡
					$insert_array=array();
					$t_jk_card=new Tt_jk_card(3);
					$object =  get_object_vars($core); 
					foreach($object as $k=>$v){
						$insert_array[]="$k=$v";
					}

					$third_sql= third_party('individual_core',$insert_array,2,$uuid);//返回插入银海数据库sql
					$t_jk_card->query($third_sql);
					
				
				
                //处理头像上传
                //上传目录
                $upload_dir = __SITEROOT . "upload/";
                $allow_overwrite = 1;
                $allow_rename = 1;
                $file_error = "";
                $allow_ext = array(
                    "jpg",
                    "jpeg",
                    "gif",
                    "bmp",
                    "png");
                //判定是否有文件上传
                if (empty($_FILES))
                {
                    $file_error = "没有头像要上传";
                }
                //上传文件处理
                if (!is_dir($upload_dir) || !is_writable($upload_dir))
                {
                    $file_error = "头像存储目录" . $upload_dir . "不存在或者不可写";
                }
                //不能重写，也不能重命名
                if (!$allow_overwrite && $allow_rename && file_exists($upload_dir . $_FILES['headpic']['name']))
                {
                    $file_error = "文件" . $upload_dir . "已存在，相关设置不能重命名文件";
                }
                //判定是否有上传文件
                if (@is_uploaded_file($_FILES['headpic']['tmp_name']))
                {
                    //判定文件格式是否符合要求
                    $ext = substr($_FILES['headpic']['name'], strpos($_FILES['headpic']['name'], '.') +
                        1, strlen($_FILES['headpic']['name']));
                    if (@!in_array(strtolower($ext), $allow_ext))
                    {
                        $file_error = '头像上传失败，你选择的文件不在允许的范围之内';
                    }
                    else
                    {
                        //强制重命名
                        $filename = iconv('utf-8', 'gb2312', $_FILES['headpic']['name']);
                        if ($allow_rename)
                        {
                            $filename = $uuid . ".gif";
                        }
                        //允许覆盖
                        if ($allow_overwrite)
                        {
                            if (@is_file($upload_dir . $filename))
                            {
                                @unlink($upload_dir . $filename);
                            }
                        }
                        if (!@move_uploaded_file($_FILES['headpic']['tmp_name'], $upload_dir . $filename))
                        {
                            $file_error = "头像上传失败，请检查文件夹是否可以写";
                        }
                        else
                        {
                            //文件上传成功--添加写入数据库
                            $file_error = "头像上传文件成功";
                        }
                    }
                }
                $page = $this->_request->getParam('para_page');
                $opener = $this->_request->getParam('opener');

                $url = array(
                    "继续添加" => __BASEPATH . "iha/index/add/para_page/$page/opener/$opener",
                    "返回列表" => __BASEPATH . "iha/index/index/page/$page",
                    );
                message("编辑个人健康档案成功," . $file_error, $url);
            }
            else
            {
                message("编辑个人档案失败", array("返回列表页" => __BASEPATH . "iha/index/index/page/$page"));
                exit;
            }
        }
        else
        {
            message("内部档案号丢失，请从封面页重新进入", array("返回个人档案封面" => __BASEPATH .
                    "iha/index/add/para_page/$page/opener/$opener", "返回个人档案列表" => __BASEPATH .
                    "iha/index/index/page/$page"));
        }
    }
    /**
     * 今日统计
     */
    public function todayAction()
    {
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/custom/iha_comm.php';
        require_once __SITEROOT . '/library/custom/comm_function.php';
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        $this->view->assign("sex", $sex);

        $org_id = $this->user['org_id'];
        $individual_core_region_path_domain = get_region_path(1);
        $time = time();
        $time_start = adodb_mktime(0, 0, 0, date("n", $time), date("j", $time), date("Y",
            $time));
        $time_end = adodb_mktime(0, 0, 0, date("n", $time), date("j", $time) + 1, date("Y",
            $time));
        //统计总人数
        $org_id = $this->user['org_id'];
        $individual = new Tindividual_archive();
        $core = new Tindividual_core();
        $individual->joinAdd('inner', $individual, $core, 'id', 'uuid');
        $individual->whereAdd($individual_core_region_path_domain);
        $individual->whereAdd("individual_archive.updated>=$time_start");
        $individual->whereAdd("individual_archive.updated<=$time_end");
        $total = $individual->count();
        //分组统计人数
        $core = new Tindividual_core();
        $individual = new Tindividual_archive();
        $individual->joinAdd('inner', $individual, $core, 'id', 'uuid');
        $individual->whereAdd($individual_core_region_path_domain);
        $individual->whereAdd("individual_archive.updated>=$time_start");
        $individual->whereAdd("individual_archive.updated<=$time_end");
        $individual->selectAdd("count('individual_archive.uuid') as snums,individual_core.sex as see");
        $individual->groupBy('individual_core.sex');
        $individual->find();
        $se = array();
        while ($individual->fetch())
        {
            $tempcode = "";
            $tempcode = array_search_for_other($individual->see, $sex);
            if ($tempcode)
            {
                $se[$tempcode]['nums'] = $individual->snums ? $individual->snums : 0;
                $se[$tempcode]['chinese'] = $sex[$tempcode][1];
            }
            else
            {
                if (!$individual->see)
                {
                    $se['88']['nums'] = $individual->snums ? $individual->snums : 0;
                    $se['88']['chinese'] = "未填写";
                }
            }
        }
        $sex["88"] = array("0" => "88", "1" => "未填写");
        $sex_count = count($sex);
        //处理既往史
        $his_count = count($disease_history);
        //统计慢病总人数
        require_once __SITEROOT . '/library/Models/clinical_history.php';
        //		$clinical_history=new Tclinical_history();
        //		$core=new Tindividual_core();
        //		$clinical_history->joinAdd('left',$clinical_history,$core,'id','uuid');
        //        $core->whereAdd($individual_core_region_path_domain);
        //		$clinical_history->whereAdd("clinical_history.updated>=$time_start");
        //		$clinical_history->whereAdd("clinical_history.updated<=$time_end");
        //		$clinical_history_count=$clinical_history->count("distinct clinical_history.id");
        $this->view->assign("his_count", $his_count);

        $this->view->assign("disease_history", $disease_history);
        //处理疾病史
        $clinical_history = new Tclinical_history();
        $core = new Tindividual_core();
        $core->whereAdd($individual_core_region_path_domain);
        $clinical_history->joinAdd('inner', $clinical_history, $core, 'id', 'uuid');
        $clinical_history->whereAdd("clinical_history.updated>=$time_start");
        $clinical_history->whereAdd("clinical_history.updated<=$time_end");
        $clinical_history->groupBy('clinical_history.disease_code');
        $clinical_history->selectAdd("count(distinct clinical_history.id) as cnums,clinical_history.disease_code as dcode");
        $clinical_history->find();
        $chis = array();
        while ($clinical_history->fetch())
        {
            if ($clinical_history->dcode == "-99")
            {
                $tempcode = "";
                $tempcode = array_search_for_other("-99", $disease_history);
                $chis[$tempcode] = $clinical_history->cnums ? $clinical_history->cnums : 0;
            }
            else
            {
                $tempcode = "";
                $tempcode = array_search_for_other($clinical_history->dcode, $disease_history);
                $chis[$tempcode] = $clinical_history->cnums ? $clinical_history->cnums : 0;
            }
        }
        $clinical_history_count = 0;
        foreach ($chis as $k => $v)
        {
            $clinical_history_count += $v;
        }
        $this->view->assign("clinical_history_count", $clinical_history_count - $chis['1']);

        $this->view->assign("clinical_history", $chis);
        //无疾病史--所有人与有疾病史的人数之差
        $this->view->assign("no_history", $chis['1']);
        //手术史
        require_once __SITEROOT . '/library/Models/surgical_history.php';
        $surgical_history = new Tsurgical_history();
        $core = new Tindividual_core();
        $core->whereAdd($individual_core_region_path_domain);
        $surgical_history->joinAdd('inner', $surgical_history, $core, 'id', 'uuid');
        $surgical_history->whereAdd("surgical_history.updated>=$time_start");
        $surgical_history->whereAdd("surgical_history.updated<=$time_end");
        $surgical_history_count = $surgical_history->count("distinct surgical_history.id");
        $this->view->assign("surgical_history_count", $surgical_history_count);
        //输血史
        require_once __SITEROOT . '/library/Models/transfusion.php';
        $transfusion = new Ttransfusion();
        $core = new Tindividual_core();
        $core->whereAdd($individual_core_region_path_domain);
        $transfusion->joinAdd('inner', $transfusion, $core, 'id', 'uuid');
        $transfusion->whereAdd("transfusion.updated>=$time_start");
        $transfusion->whereAdd("transfusion.updated<=$time_end");
        $transfusion_count = $transfusion->count("distinct transfusion.id");
        $this->view->assign("transfusion_count", $transfusion_count);
        //外伤史
        require_once __SITEROOT . '/library/Models/trauma.php';
        $trauma = new Ttrauma();
        $core = new Tindividual_core();
        $core->whereAdd($individual_core_region_path_domain);
        $trauma->joinAdd('inner', $trauma, $core, 'id', 'uuid');
        $trauma->whereAdd("trauma.updated>=$time_start");
        $trauma->whereAdd("trauma.updated<=$time_end");
        $trauma_count = $trauma->count("distinct trauma.id");
        $this->view->assign("trauma_count", $trauma_count);
        //既往史总人数--不能将四个表数据相加，必须分别求取后求数组差集
        $clinical_history = new Tclinical_history();
        $core = new Tindividual_core();
        $core->whereAdd($individual_core_region_path_domain);
        $clinical_history->joinAdd('inner', $clinical_history, $core, 'id', 'uuid');
        $clinical_history->whereAdd("clinical_history.updated>=$time_start");
        $clinical_history->whereAdd("clinical_history.updated<=$time_end");
        $clinical_history->selectAdd("distinct clinical_history.id as id");
        $clinical_history->find();
        $i = 0;
        $clinical = array();
        while ($clinical_history->fetch())
        {
            $clinical[$i] = $clinical_history->id;
            $i++;
        }
        $surgical_history = new Tsurgical_history();
        $core = new Tindividual_core();
        $core->whereAdd($individual_core_region_path_domain);
        $surgical_history->joinAdd('inner', $surgical_history, $core, 'id', 'uuid');
        $surgical_history->whereAdd("surgical_history.updated>=$time_start");
        $surgical_history->whereAdd("surgical_history.updated<=$time_end");
        $surgical_history->selectAdd("distinct surgical_history.id as id");
        $surgical_history->find();
        while ($surgical_history->fetch())
        {
            $clinical[$i] = $surgical_history->id;
            $i++;
        }
        $transfusion = new Ttransfusion();
        $core = new Tindividual_core();
        $core->whereAdd($individual_core_region_path_domain);
        $transfusion->joinAdd('inner', $transfusion, $core, 'id', 'uuid');
        $transfusion->whereAdd("transfusion.updated>=$time_start");
        $transfusion->whereAdd("transfusion.updated<=$time_end");
        $transfusion->selectAdd("distinct transfusion.id as id");
        $transfusion->find();
        while ($transfusion->fetch())
        {
            $clinical[$i] = $transfusion->id;
            $i++;
        }
        $trauma = new Ttrauma();
        $core = new Tindividual_core();
        $core->whereAdd($individual_core_region_path_domain);
        $trauma->joinAdd('inner', $trauma, $core, 'id', 'uuid');
        $trauma->whereAdd("trauma.updated>=$time_start");
        $trauma->whereAdd("trauma.updated<=$time_end");
        $trauma->selectAdd("distinct trauma.id as id");
        $trauma->find();
        while ($trauma->fetch())
        {
            $clinical[$i] = $trauma->id;
            $i++;
        }
        $clinical = array_unique($clinical);
        $history_total = count($clinical) - $chis['1'];
        $this->view->assign("history_total", $history_total);
        //查询遗传病史人数
        require_once __SITEROOT . '/library/Models/genetic_diseases.php';
        $genetic_diseases = new Tgenetic_diseases();
        $core = new Tindividual_core();
        $core->whereAdd($individual_core_region_path_domain);
        $genetic_diseases->joinAdd('inner', $genetic_diseases, $core, 'id', 'uuid');
        $genetic_diseases->whereAdd("genetic_diseases.updated>=$time_start");
        $genetic_diseases->whereAdd("genetic_diseases.updated<=$time_end");
        $genetic_count = $genetic_diseases->count("distinct genetic_diseases.id");
        $this->view->assign("genetic_count", $genetic_count);
        //查询残疾
        require_once __SITEROOT . '/library/Models/deformity.php';
        $deformity = new Tdeformity();
        $core = new Tindividual_core();
        $core->whereAdd($individual_core_region_path_domain);
        $deformity->joinAdd('inner', $deformity, $core, 'id', 'uuid');
        $deformity->whereAdd("deformity.updated>=$time_start");
        $deformity->whereAdd("deformity.updated<=$time_end");
        $deformity->whereAdd("deformity.deformity_type!='1'");
        $deformity_count = $deformity->count("distinct deformity.id");
        $this->view->assign("deformity_count", $deformity_count);

        $this->view->assign("total", $total);
        $this->view->assign("sexa", $sex);
        $this->view->assign("sexd", $se);
        $this->view->assign("sex_count", $sex_count);
        $this->view->assign("today", date("Y-m-d", time()));
        $this->view->display("today.html");
    }
    /**
     * 校验表单中档案号是否重复，重复输出0，正确输出1
     */
    public function validatorAction()
    {
        $code = $this->_request->getParam('code');
        if ($code != '')
        {
            $core = new Tindividual_core();
            $core->whereAdd("standard_code='$code'");
            $nums = $core->count();
            if ($nums)
            {
                echo "failed";
                exit;
            }
            else
            {
                echo "ok";
                exit;
            }
        }
        else
        {
            echo "failed";
            exit;
        }
    }
    /**
     * 本控制器用于写入测试数据
     */
    public function testAction()
    {
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/custom/iha_comm.php';
        require_once __SITEROOT . '/library/custom/comm_function.php';
        $doctor = array(
            0 => 'acbde009',
            1 => 'acbde001',
            2 => 'acbde002',
            3 => 'acbde003');
        //向家庭档案写入40条测试数据
        require_once __SITEROOT . "/library/Models/family_archive.php";
        for ($i = 0; $i < 41; $i++)
        {
            $time = rand(mkunixstamp("1932-08-21"), time());
            $family = new Tfamily_archive();
            $fuuid = uniqid("F_");
            $family->uuid = $fuuid;
            $family->family_number = $fuuid;
            $family->org_id = $this->user['org_id'];
            $family->created = $time;
            $family->updated = $time;
            //$family->deleted="";
            $family->standard_code = "001";
            //$family->record_state=1;//新增档案，全部激活
            //$family->staff_id=$this->user['uuid'];//医生ID
            $family->status_flag = 1;
            $family->insert($this->user['uuid']);
        }
        $family = new Tfamily_archive();
        $family->find();
        $fa = array();
        $i = 0;
        while ($family->fetch())
        {
            $fa[$i] = $family->uuid;
            $i++;
        }
        //为了实现多个医生多个档案，先读取医生的表，生成随机数组，然后取随机值
        require_once __SITEROOT . "/library/Models/staff_core.php";
        require_once __SITEROOT . "/library/Models/role_table.php";
        //只取医务人员
        $staff_core = new Tstaff_core();
        $staff_core->whereAdd("org_id='" . $this->user['org_id'] . "'");
        $role_table = new Trole_table();
        $role_table->whereAdd("role_en_name='doctor'");
        $staff_core->joinAdd('inner', $staff_core, $role_table, 'role_id', 'role_id');
        $staff_core->find();
        $staff = array();
        $i = 0;
        while ($staff_core->fetch())
        {
            $staff[$i] = $staff_core->id;
            $i++;
        }
        for ($j = 1; $j < 100; $j++)
        {
            $time = rand(mkunixstamp("1932-08-21"), time());
            $core = new Tindividual_core();
            $uuid = $this->_request->getParam('uuid'); //系统标识符
            $name = name();
            $core->name = $name; //姓名
            //获取姓名的拼音
            require_once __SITEROOT . '/library/pinyin/pinyin.php';
            $py_name = getPinyin($name); //姓名拼音
            $core->name_pinyin = $py_name;
            $l = 17 - strlen($j);
            $standard_code = '';
            for ($i = 0; $i < $l; $i++)
            {
                $standard_code .= "0";
            }
            $core->standard_code = $standard_code . $j;
            $core->sex = rand(0, 2);
            $core->date_of_birth = rand(mkunixstamp("1932-08-21"), time()); //生日
            $core->identity_type = 1; //快捷输入方式默认为身份证
            $core->identity_number = sf();
            $core->race = 2;
            $core->phone_number = rand(1, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0,
                9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9); //本人联系电话
            $newindividual_uuid = uniqid("C_");
            //添加档案，初始化部分数据，如时间字段
            $core->created = $time;
            $core->updated = $time;
            $core->record_state = 1; //新增档案，全部激活
            $core->staff_id = $staff[rand(0, (count($staff) - 1))]; //医生ID
            $core->org_id = $this->user['org_id'];
            $core->uuid = $newindividual_uuid;
            $core->status_flag = 1;
            $family_number = $fa[rand(0, 40)];
            $core->family_number = $family_number;
            //查询对应家庭是否有户主
            $cos = new Tindividual_core();
            $cos->whereAdd("family_number='$family_number'");
            $cos->whereAdd("relation_holder='1'");
            if ($cos->count())
            {
                $core->relation_holder = rand(2, 9);
            }
            else
            {
                //确保每个家庭都有一位户主
                $core->relation_holder = 1;
            }
            $core->insert($this->user['uuid']);


        }
    }
    /**
     * 居民健康档案信息卡展示页面
     */
    public function cardAction()
    {
        require_once __SITEROOT . '/library/custom/comm_function.php';
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php';
        $this->view->assign("ABO_bloodtype", $ABO_bloodtype);
        $this->view->assign("rh_bloodtype_card", $rh_bloodtype_card);
        $this->view->assign("disease_history", $disease_history);
        //获取机构ID
        $org_id = $this->user['org_id'];
        //获取医生ID
        $staff_id = $this->user['uuid'];
        $individual_session = new Zend_Session_Namespace("individual_core");
        $uuid = $this->_request->getParam("uuid", '') ? $this->_request->getParam("uuid",
            '') : $individual_session->uuid;
        $this->view->uuid = $uuid;
        if (empty($uuid))
        {
            if (empty($individual_session->uuid) || empty($individual_session->staff_id))
            {
                message("请在个人档案列表双击选中居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
            }
        }
        else
        {
            $individual_inf = get_individual_info($uuid); //取得个人信息中所有信息
            if ($this->haveWritePrivilege)
            {
                $this->view->user_name = $individual_inf->name; //居民姓名
                $this->view->standard_code = $individual_inf->standard_code_1; //标准档案号
            }
            else
            {
                $this->view->user_name = "*"; //居民姓名
                $this->view->standard_code = "*"; //标准档案号
            }
        }
        //取个人信息
        //读取个人核心记录
        $core = new Tindividual_core();
        $core->whereAdd("uuid='$uuid'");
        if ($core->count())
        {
            $core = new Tindividual_core();
            $core->whereAdd("uuid='$uuid'");
            $core->find(true);
            //因加密需要，处理姓名、身份证、本人电话
            if ($this->user['role_en_name'] != 'doctor')
            {
                $core->name = "*";
                $core->identity_number = "*";
                $core->phone_number = "*";
            }
            //特殊处理日期，因为日期是时间戳
            $core->date_of_birth = $core->date_of_birth ? adodb_date("Y 年 m 月 d 日", $core->
                date_of_birth) : "";
            //处理建档医生
            $core->staff_name = get_staff_name_byid($core->staff_id);
            //处理性别
            $core->sex = $sex[array_search_for_other($core->sex, $sex)][1];
            $this->view->assign("core", $core);
            //读取个人扩展信息
            $individual = new Tindividual_archive();
            $individual->whereAdd("id='$uuid'");
            //$individual->whereAdd("org_id='$org_id'");
            $individual->find(true);
            //因加密原因，隐藏工作单位  联系人姓名 联系人电话
            if ($this->user['role_en_name'] != 'doctor')
            {
                $individual->unit_name = "*";
                $individual->contact = "*";
                $individual->contact_number = "*";
            }
            $this->view->assign("individual", $individual);
            //读取血型
            require_once __SITEROOT . '/library/Models/blood_type.php';
            $blood = new Tblood_type();
            $blood->whereAdd("id='$uuid'");
            //$blood->whereAdd("org_id='$org_id'");
            $blood->find(true);
            $blood->abo_bloodtype = array_search_for_other($blood->abo_bloodtype, $ABO_bloodtype);
            $blood->rh_bloodtype = array_search_for_other($blood->rh_bloodtype, $RH_bloodtype);
            $this->view->assign("blood", $blood);
            //读取药物过敏史
            require_once __SITEROOT . '/library/Models/allergy.php';
            $allergy = new Tallergy();
            $allergy->whereAdd("id='$uuid'");
            //$allergy->whereAdd("org_id='$org_id'");
            $allergy->find();
            $allergy_info = "";
            $allergy_array = array();
            $i = 0;
            $allergy_sign = 0;
            $allergy_comment = ''; //用于存储自定义字段
            while ($allergy->fetch())
            {
                if ($allergy->allergy_code == "-99")
                {
                    $allergy_info .= "、" . $allergy->allergy_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                }
                else
                {
                    $allergy_info .= "、" . $allergy_history[array_search_for_other($allergy->
                        allergy_code, $allergy_history)][1];
                }
                $i++;
            }
            $this->view->assign("allergy", substr($allergy_info, 3));
            //读取疾病史
            //<!--{foreach key=k item=v from=$disease_history}-->
            //	<input type="checkbox" disabled="true"  value="<!--{$k}-->" /><!--{$v[1]}-->&nbsp;
            //	<!--{/foreach}-->
            require_once __SITEROOT . '/library/Models/clinical_history.php';
            $clinical_history = new Tclinical_history();
            $clinical_history->orderby("disease_code asc");
            $clinical_history->whereAdd("id='$uuid'");
            //$clinical_history->whereAdd("org_id='$org_id'");
            $clinical_history->find();
            $clinical_array = array();
            $disease = "";
            $i = 0;
            $clinical_comment = ''; //用于存储自定义字段
            while ($clinical_history->fetch())
            {
                if ($clinical_history->disease_code == "-99")
                {
                    $clinical_array[$i] = array_search_for_other($clinical_history->disease_code, $disease_history);
                    $clinical_comment = $clinical_history->disease_comment; //读取自定义字段，因为只有当选择其他项时此字段才有值
                }
                else
                {
                    $clinical_array[$i] = array_search_for_other($clinical_history->disease_code, $disease_history);
                }
                $i++;
            }
            foreach ($disease_history as $k => $v)
            {
                if (in_array($k, $clinical_array))
                {
                    $disease .= "<input type=\"checkbox\" checked=\"checked\" disabled=\"true\"  value=\"" .
                        $k . "\" />" . $v[1] . "&nbsp;";
                    if (array_code_change($k, $disease_history) == "-99")
                    {
                        $disease .= "&nbsp;&nbsp;<span style='text-decoration:underline;'>" . $clinical_comment .
                            "</span>";
                    }
                }
                else
                {
                    $disease .= "<input type=\"checkbox\" disabled=\"true\"  value=\"" . $k . "\" />" .
                        $v[1] . "&nbsp;";
                }
            }
            $this->view->assign("disease", $disease);
            //取表反面信息
            //取家庭信息
            $family = new Tfamily_archive();
            $family->whereAdd("uuid='$core->family_number'");
            $family->find(true);
            $this->view->assign("family", $family);
            //取机构名称
            require_once __SITEROOT . "library/Models/organization.php";
            $organization = new Torganization();
            $organization->whereAdd("id='$org_id'");
            $organization->find(true);
            $this->view->assign("organization", $organization);
            //取机构电话
            require_once __SITEROOT . 'library/Models/chs_center.php';
            $chs_center = new Tchs_center();
            $chs_center->whereAdd("chsc_id='$org_id'");
            $chs_center->find(true);
            $this->view->assign("chs_center", $chs_center);
            //取医生信息
            require_once __SITEROOT . 'library/Models/staff_archive.php';
            $staff_archive = new Tstaff_archive();
            $staff_archive->whereAdd("user_id='$core->response_doctor'");
            $staff_archive->find(true);
            $this->view->assign("staff_archive", $staff_archive);
            //医生列表
            $org_region_domain = $this->user['current_region_path_domain'];

            $temp = explode("|", $org_region_domain);
            $individual_core_region_path_domain = '';
            $staff_core_region_path_domain = '';
            foreach ($temp as $k1 => $v1)
            {
                $individual_core_region_path_domain = $individual_core_region_path_domain .
                    "individual_core.region_path like '" . $v1 . "%' or ";
                $staff_core_region_path_domain = $staff_core_region_path_domain .
                    "staff_core.region_path like '" . $v1 . "%' or ";
            }
            $individual_core_region_path_domain = rtrim($individual_core_region_path_domain,
                ' or ');
            $staff_core_region_path_domain = rtrim($staff_core_region_path_domain, ' or ');
            $staff_core = new Tstaff_core();
            $staff_archive = new Tstaff_archive();
            $staff_core->joinAdd('inner', $staff_core, $staff_archive, 'id', 'user_id');
            $staff_core->whereAdd($staff_core_region_path_domain);
            //$staff_core->debugLevel("5");
            $staff_core->find();
            $responseDoctorArray = array();
            $responseDoctorArray[0]['zh_name'] = '请选择';
            $responseDoctorArray[0]['id'] = '-9';
            $counter = 1;
            while ($staff_core->fetch())
            {
                //生成负责医生下拉框
                $responseDoctorArray[$counter]['zh_name'] = $staff_archive->name_real;
                $responseDoctorArray[$counter]['id'] = $staff_core->id;
                if ($core->response_doctor == $staff_core->id)
                {
                    $responseDoctorArray[$counter]['selected'] = 'selected';
                }
                else
                {
                    $responseDoctorArray[$counter]['selected'] = '';
                }
                $counter++;
            }
            $this->view->response_doctor = $responseDoctorArray;
            //权限
            if ($this->haveWritePrivilege)
            {
                $this->view->ajax_save_disabled = "";
            }
            else
            {
                $this->view->ajax_save_disabled = "disabled";
            }
            $this->view->display('card.html');
        }
        else
        {
            //查询错误
            message("对不起，查询出现错误，请重新选择人员", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
    }
    /**
     * 用于保存健康卡信息的修改
     */
    public function cardsaveAction()
    {
        require_once __SITEROOT . '/library/custom/comm_function.php';
        $individual_session = new Zend_Session_Namespace("individual_core");
        $uuid = $this->_request->getParam("uuid", '');
        if ($uuid == $individual_session->uuid)
        {
            //修改家庭信息
            $family_address = $this->_request->getParam("family_address", '');
            $telephone_number = $this->_request->getParam("telephone_number", '');
            $family_number = $this->_request->getParam("family_number", '');
            if ($family_number)
            {
                $family = new Tfamily_archive();
                $family->family_address = $family_address;
                $family->telephone_number = $telephone_number;
                $family->whereAdd("uuid='$family_number'");
                $family->update(array($this->user['uuid'], 'updated'));
            }
            //修改基本档案信息
            $contact = $this->_request->getParam("contact", '');
            $contact_number = $this->_request->getParam("contact_number", '');
            $card_info = $this->_request->getParam("card_info", '');
            $individual = new Tindividual_archive();
            $individual->contact = $contact;
            $individual->contact_number = $contact_number;
            $individual->card_info = $card_info;
            $individual->whereAdd("id='$uuid'");
            $individual->update(array($this->user['uuid'], 'updated'));
            //修改责任医生
            $response_doctor = $this->_request->getParam("response_doctor", '');
            $core = new Tindividual_core();
            $core->response_doctor = $response_doctor;
            $core->whereAdd("uuid='$uuid'");
            $core->update(array($this->user['uuid'], 'updated'));
            message("修改资料成功", array("进入个人档案列表" => __BASEPATH . 'iha/index/index', "居民健康信息卡" =>
                    __BASEPATH . 'iha/index/card'));
        }
        else
        {
            message("对不起，你的操作时间间隔太长或者超时，请重新选择人员", array("进入个人档案列表" => __BASEPATH .
                    'iha/index/index', "居民健康信息卡" => __BASEPATH . 'iha/index/card'));
        }
    }
    /**
     * 用于添加时展示居民健康档案封面
     */
    public function coverAction()
    {
        require_once __SITEROOT . '/library/custom/iha_comm.php';
        $this->view->assign("town", $town);
        $this->view->assign("neighborhood", $neighborhood);
        //print_r($this->identity);
        $this->view->assign("doctor_name", $this->user['name_real']);
        $this->view->display("cover.html");
    }
    /**
     * 用于临时修改户主冲突问题
     */
    public function movehousederAction()
    {
        $this->view->display("move.html");
    }
    /**
     * 用于临时修改户主冲突问题
     */
    public function moveviewAction()
    {
    	require_once __SITEROOT . '/library/custom/comm_function.php';
        $card = $this->_request->getParam('card');
        $pass = $this->_request->getParam('pass');
        if ($pass == 'wolfchis')
        {
            $core = new Tindividual_core();
            //不能去掉
            $core->whereAdd("individual_core.identity_number='$card'");
            $core->find();
            $core_array = array();
            $i = 0;
            while ($core->fetch())
            {
                $core_array[$i]['name'] = $core->name;
                $core_array[$i]['identity_number'] = $core->identity_number;
                $core_array[$i]['standard_code'] = $core->standard_code_1;
                $core_array[$i]['address'] = $core->address;
                $i++;
            }
            $this->view->assign("iha", $core_array);
            $this->view->display("move_view.html");
        }
        else
        {
        	message("输入密码错误",array("返回互为户主关系处理页"=>__BASEPATH."iha/index/movehouseder","返回首页"=>__BASEPATH."doctor/index/index"));
//            exit("密码错误");
        }
    }
    /**
     * 用于临时修改户主冲突问题
     */
    public function moveupdateAction()
    {
    	require_once(__SITEROOT."library/custom/comm_function.php");
        $card = $this->_request->getParam('id');
        if ($card)
        {
            $core = new Tindividual_core();
            $core->relation_holder = "";
            //不能去掉
            $core->whereAdd("individual_core.identity_number='$card'");
            $core->update();
            message("处理成功",array("返回互为户主关系处理页"=>__BASEPATH."iha/index/movehouseder","返回首页"=>__BASEPATH."doctor/index/index"));
//            exit("成功");
        }
        else
        {
        	message("处理失败",array("返回互为户主关系处理页"=>__BASEPATH."iha/index/movehouseder","返回首页"=>__BASEPATH."doctor/index/index"));
//            exit("错误");
        }
    }
    /**
     * 用于显示完整率的字段是否填写完整
     * 我好笨 2011-07-28
     */
    public function showrateAction()
    {
        $uuid = $this->_request->getParam('uuid');
        if ($uuid)
        {
            $region_path_array = explode(",", $this->user['current_region_path'], 5);
            //取到市级path
            $i = 0;
            $region_path='';
            foreach ($region_path_array as $k => $v)
            {
                if (isset($v) && $i < 4)
                {
                    $region_path .= $v . ",";
                }
                $i++;
            }
            $region_path = rtrim($region_path, ",");
                //缓存不存在，生成缓存文件
                require_once __SITEROOT . "library/Models/standard_archive_rate.php";
                $standard_archive_rate = new Tstandard_archive_rate();
                //取本模块的所有必填字段数组
                $standard_archive_rate->whereAdd("region_path like '$region_path%'");
                $standard_archive_rate->whereAdd("criteria='1'");
                $standard_archive_rate->find();
                $rate = array();
                while ($standard_archive_rate->fetch())
                {
                    $rate[$standard_archive_rate->region_path][$standard_archive_rate->module_name][$standard_archive_rate->
                        table_name][$standard_archive_rate->column_name] = $standard_archive_rate->
                        column_zh_name;
                }
                if (is_array($rate[$region_path]['individual_core']))
                {
                        $temp_rate = array();
                        $i = 0;
                        foreach ($rate[$region_path]['individual_core'] as $k => $v)
                        {
                            require_once __SITEROOT . "library/Models/$k.php";
                            $temp = $k;
                            $t = "T$temp";
                            $$temp = new $t;
                            if ($k != "individual_core")
                            {
                                $$temp->whereAdd("id='$uuid'");
                            }
                            else
                            {
                                $$temp->whereAdd("uuid='$uuid'");
                            }

                            $$temp->find(true);
                            foreach ($v as $m => $n)
                            {
                                if (isset($$temp->$m) && $$temp->$m != "")
                                {
                                    $temp_rate[$i]['status'] = 1;
                                }
                                else
                                {
                                    $temp_rate[$i]['status'] = 0;
                                }
                                $temp_rate[$i]['table_name'] = $n;
                                $i++;
                            }
                            $$temp->free();
                        }
                        $this->view->rate = $temp_rate;
                        $this->view->display("view_rate.html");
            }
            else
            {
                echo "未设置完成率指标字段。";
                exit;
            }
        }
        else
        {
            echo "参数获取错误，未能查找到相应用户";
            exit;
        }
    }
    /**
     * 用于设置session
     */
    public function setsessionAction()
    {
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/custom/comm_function.php';
        $uuid = $this->_request->getParam('uuid');
        if ($uuid)
        {
            $core = new Tindividual_core();
            $core->whereAdd("uuid='$uuid'");
            $core->find(true);
            if ($core->standard_code_1)
            {
                $individual_session = new Zend_Session_Namespace("individual_core");
                $individual_session->uuid = $uuid; //设置个人UUID
                $individual_session->standard_code = $core->standard_code; //设置手工标准档案号
                $individual_session->standard_code_1 = $core->standard_code_1; //设置国家标准档案号
                $individual_session->standard_code_2 = $core->standard_code_2; //设置省标准档案号
                $individual_session->name = $core->name; //设置姓名
                $individual_session->sex = $core->sex; //设置性别
                $individual_session->age = getBirthday($core->date_of_birth, time());
                ; //设置年龄
                $individual_session->date_of_birth = $core->date_of_birth; //设置生日
                $individual_session->address = $core->address; //设置现在住址
                $individual_session->residence_address = $core->residence_address; //设置户籍地址
                $individual_session->phone_number = $core->phone_number; //设置本人联系电话
                $individual_session->staff_id = $core->staff_id; //设置建档医生
                $individual_session->response_doctor = $core->response_doctor; //责任医生
                $individual_session->filing_time = $core->filing_time; //设置建档时间
                $individual_session->status_flag = $core->status_flag; //档案状态
                echo "ok";
                exit;
            }
            else
            {
                echo "error_no_person";
                exit;
            }
        }
        else
        {
            echo "error_uuid_no_null";
            exit;
        }
    }
    /**
     * 用于医生刷新完整率
     */
    public function refreshAction()
    {
        require_once __SITEROOT . '/library/custom/comm_function.php';
        $current_num = $this->_request->getParam("current");
        $total = $this->_request->getParam("total") ? intval($this->_request->getParam("total")) :
            0;
        //计算档案完整率
        $region_path_array = explode(",", $this->user['current_region_path'], 5);
        //取到市级path
        $region_path = $region_path_array['0'] . "," . $region_path_array['1'] . "," . $region_path_array['2'] .
            "," . $region_path_array['3'];
        $per_count = 30; //每次刷新的记录数
        $individual_core_region_path_domain = get_region_path(1);
        //判定是否第一页，如果是，则需要获取总的需要刷新的人数
        if (!$current_num)
        {
            $core = new Tindividual_core();
            $core->whereAdd($individual_core_region_path_domain);
            $nums = $core->count(); //社区总人数
            $core->free();
            $current_num = 1; //为第一次刷新
            $total = $nums;
            //创建文件锁 至少一小时才能够刷新一次
            $filename = __SITEROOT . "cache/archive_" . str_replace(",", "_", $this->user['current_region_path']) .
                ".lock";
            if (file_exists($filename) && (time() - filemtime($filename)) <= 3600)
            {
                //1小时内，警告退出
                message("对不起，因为刷新完整率会耗费大量服务器资源，系统限制每个机构每小时最多只能刷新一次，距离下次刷新还有" . date("i", ((filemtime
                    ($filename) + 3600) - time())) . "分" . date("s", ((filemtime($filename) + 3600) -
                    time())) . "秒", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
            }
            else
            {
                $fp = @fopen($filename, "w");
                @fclose($fp);
            }
        }
        else
        {
            $nums = $total - (($current_num - 1) * $per_count); //取得剩余的人数
        }
        if ($nums > 0 && $current_num)
        {
            echo "本次共计需要刷新" . $total . "人的档案完整率，当前正在刷新第" . $current_num . "次，每次刷新" . $per_count .
                "人，剩余" . ($total - ($current_num * $per_count)) . "人，请耐心等待，页面会自动跳转";
            while ($per_count > 0)
            {
                //取个人UUID
                $core = new Tindividual_core();
                $core->whereAdd($individual_core_region_path_domain);
                $core->limit($nums, 1);
                $core->orderby("individual_core.updated DESC");
                $core->find(true);
                $uuid = $core->uuid;
                $core->free();
                //取所有表名
                $standard_archive_rate = new Tstandard_archive_rate();
                $standard_archive_rate->whereAdd("module_name = 'individual_core'"); //个人档案模块
                $standard_archive_rate->whereAdd("region_path='$region_path'");
                //$standard_archive_rate->whereAdd("criteria='1'");
                $standard_archive_rate->selectAdd("table_name as table_name");
                //$standard_archive_rate->debugLevel(5);
                $standard_archive_rate->groupBy("table_name");
                $standard_archive_rate->find();
                while ($standard_archive_rate->fetch())
                {
                    //排除自己
                    if ($standard_archive_rate->table_name != "individual_core")
                    {
                        require_once __SITEROOT . "/library/Models/" . $standard_archive_rate->
                            table_name . ".php";
                        $table_name = $standard_archive_rate->table_name;
                        $t = "T$table_name";
                        $$table_name = new $t;
                        $$table_name->whereAdd("id='$uuid'");
                        $$table_name->find(true);
                    }
                    else
                    {
                        require_once __SITEROOT . "/library/Models/" . $standard_archive_rate->
                            table_name . ".php";
                        $table_name = $standard_archive_rate->table_name;
                        $t = "T$table_name";
                        $$table_name = new $t;
                        $$table_name->whereAdd("uuid='$uuid'");
                        $$table_name->find(true);
                    }
                }

                $standard_archive_rate = new Tstandard_archive_rate();
                //取本模块的所有必填字段数组
                $standard_archive_rate->whereAdd("module_name = 'individual_core'"); //个人档案模块
                $standard_archive_rate->whereAdd("region_path='$region_path'");
                $standard_archive_rate->whereAdd("criteria='1'");
                $nums_rate = 0;
                $nums_rate = $standard_archive_rate->count(); //所有字段
                $standard_archive_rate->find();
                $nums_rate_true = 0; //已填写字段数
                while ($standard_archive_rate->fetch())
                {
                    $table_name = $standard_archive_rate->table_name;
                    $column_name = $standard_archive_rate->column_name;
                    if (@isset($$table_name->$column_name) && $$table_name->$column_name)
                    {
                        $nums_rate_true++;
                    }
                }
                $rate = @round($nums_rate_true / $nums_rate, 4);
                $core = new Tindividual_core();
                $core->criteria_rate = $rate;
                $core->whereAdd("uuid='$uuid'");
                //$core->updated=time(); 刷新完整率不更新资料修改时间
                $core->update();
                $core->free();
                $per_count--;
                $nums--;
            }
            echo "<script>window.location='" . __BASEPATH . "iha/index/refresh/current/" . ($current_num +
                1) . "/total/" . $total . "';</script>";
            exit;
        }
        else
        {
            //第一次刷新，无记录
            if ($current_num)
            {
                message("恭喜，完整率已经刷新完成", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
            }
            else
            {
                message("对不起，没有要刷新完整率的人员信息", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
            }
        }

    }
    /**
     * @todo 用于测试慢病确诊函数
     */
    public function tAction()
    {
        require_once __SITEROOT . '/library/custom/comm_function.php';
        //机构ID
        $org_id = $this->user['org_id'];
        //获取医生ID
        $staff_id = $this->user['uuid'];
        //必须指定上面两个参数
        $individual_session = new Zend_Session_Namespace("individual_core");
        $uuid = $this->_request->getParam('uuid') ? $this->_request->getParam('uuid') :
            $individual_session->uuid;
        diagnose_disease($uuid, 8, time());
    }
    /**
     * iha_indexController::importAction()
     * @author 我好笨
     * @todo 用于导出个人档案基本信息到excel
     * 2012-04-01 尝试使用分卷导出功能
     * 暂时还没实现，应该要基于文件压缩来实现，基本原理估计是，Phpexcel生成excel存放在本地，然后使用zip类打包发送到用户浏览器，用户下载的将是一个zip文件
     * @return void
     */
    public function importAction()
    {
        //判断当前时间
        //2012-03-30 领导要求必须在下午4:30以后才允许导出
        $hours = @intval(date('Gi', time())); //小时分钟
        require_once __SITEROOT . "/library/custom/pager.php";
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        require_once __SITEROOT . '/library/custom/comm_function.php';
        //按下次随访日期搜索，默认情况下列出下次随访日期是今天的所有人员
        $search = array();
        $time = time();
        $excel_name = $this->_request->getParam('excel_name') ? $this->_request->
            getParam('excel_name') : "个人档案";
        $search['age_start'] = intval($this->_request->getParam('age_start')) ? intval($this->
            _request->getParam('age_start')) : 0; //年龄段
        $search['age_end'] = ($this->_request->getParam('age_end') !== '' && intval($this->
            _request->getParam('age_end')) >= $search['age_start']) ? intval($this->
            _request->getParam('age_end')) : '';
        $search['org_id'] = $this->_request->getParam('region_p_id'); //地区
        $search['sex'] = $this->_request->getParam('sex');
        $search['status_flag'] = $this->_request->getParam('status_flag'); //档案状态
        $search['status_flag'] = $search['status_flag'] ? $search['status_flag'] : 1; //默认为正常档案 2012-10-25 我好笨
        $individual_core_region_path_domain = get_region_path(1, $search['org_id']);
        $is_excel = $this->_request->getParam('excel');
        $title = "";
        $per_mount = 10000; //每个文件存储的数据量
        $current_status_flag = $search['status_flag']; //默认为正常档案，2012-10-25 我好笨
        if ($is_excel != "do")
        {
            //档案状态
            $status_flagArray = array(
                '' => array('0', '请选择'),
                '1' => array('1', '正常档案'),
                '4' => array('2', '临时档案'),
                '6' => array('3', '死亡档案'),
                '8' => array('4', '转出档案'));
            $status_flag = array();
            $x = 0;
            foreach ($status_flagArray as $key => $value)
            {
                $status_flag[$x]['key'] = $key;
                $status_flag[$x]['value'] = $value['1'];
                if ($current_status_flag == $key)
                {
                    $status_flag[$x]['selected'] = 'selected';
                }
                else
                {
                    $status_flag[$x]['selected'] = '';
                }
                $x++;
            }
            $this->view->status_flag = $status_flag;
            $this->view->excel_name = urldecode($excel_name);
            $this->view->search = $search;
            $this->view->age_start = $search['age_start'];
            $this->view->age_end = $search['age_end'];
            $this->view->sex = $sex;
            $this->view->per_mount = $per_mount;
            $this->view->assign('region_id', $this->user['region_id']);
            $this->view->assign('region_p_id', $this->user['region_id']);
            $this->view->assign('hours', $hours);
            $this->view->display('iha_import_index.html');
        }
        else
        {
            //定义临时变量current存储是当前分卷数
            $current = $this->_request->getParam('current') ? $this->_request->getParam('current') : 0;
            $total_files=$this->_request->getParam('total') ? $this->_request->getParam('total') : 0;//总分卷数
            if ($hours >= 900 && $hours <= 1630)
            {
                exit("请09:00之前，16:30之后使用导出数据功能");
            }
            $core = new Tindividual_core();
            //个人档案附加表，为实现高级搜索
            $individual_archive = new Tindividual_archive();
            foreach ($search as $k => $v)
            {
                if ($k == "age_start" && $v !== '')
                {
                    $title .= $v . "岁起";
                    $v = adodb_mktime(0, 0, 0, adodb_date("n", $time), adodb_date("j", $time),
                        adodb_date("Y", $time) - $v);
                    $core->whereAdd("individual_core.date_of_birth <= $v");
                }
                if ($k == "age_end" && $v != '')
                {
                    $title .= $v . "岁止";
                    $v = adodb_mktime(0, 0, 0, adodb_date("n", $time), adodb_date("j", $time),
                        adodb_date("Y", $time) - $v);
                    $core->whereAdd("individual_core.date_of_birth >= $v");
                }
                if ($k == "sex" && $v != '')
                {
                    $core->whereAdd("individual_core.$k = '$v'");
                    $title .= "性别为" . @$sex[array_search_for_other($v, $sex)][1] . "的";
                }
            }
            //增加档案状态，2012-10-25 我好笨
            if ($current_status_flag != 0)
            {
                $core->whereAdd("individual_core.status_flag=$current_status_flag");
            }
            $core->joinAdd('left', $core, $individual_archive, 'uuid', 'id');
            $core->whereAdd($individual_core_region_path_domain);
            //当分卷数为1时才获取总分卷数,否则取页面传递值，避免每次都取数据库
            if ($current == 0)
            {
                $total_files=ceil($core->count()/$per_mount);
            }
            $core->limit($current*$per_mount,$per_mount);
            $core->orderby("individual_core.family_number DESC,individual_core.updated DESC");
            $core->find();
            //导出数据到浏览器，然后输出总共导出多少条数据
            /** PHPExcel */
            require_once __SITEROOT . 'library/phpexcel/Classes/PHPExcel.php';
            // Create new PHPExcel object
            $title .= urldecode($excel_name);
            //如果有分卷，给文件添加分卷数
            if($total_files)
            {
                $title.= "-分卷".($current+1)."-共".$total_files.'卷';
            }
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("我好笨")->setLastModifiedBy("我好笨")->
                setTitle($title)->setSubject($title)->setDescription($title)->setKeywords("office 2007 openxml php")->
                setCategory($title);
            //电子表格的序号
            $excel_order = array(
                "A",
                "B",
                "C",
                "D",
                "E",
                "F",
                "G",
                "H",
                "I",
                "J",
                "K",
                "L",
                "M",
                "N",
                "O",
                "P",
                "Q",
                "R",
                "S",
                "T",
                "U",
                "V",
                "W",
                "X",
                "Y",
                "Z",
                "AA",
                "BB",
                "CC");
            // 填写标题
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($excel_order[0] . '1', '姓名')->
                setCellValue($excel_order[1] . '1', '性别')->setCellValue($excel_order[2] . '1',
                '年龄')->setCellValue($excel_order[3] . '1', '身份证号')->setCellValue($excel_order[4] .
                '1', '民族')->setCellValue($excel_order[5] . '1', '婚姻状况')->setCellValue($excel_order[6] .
                '1', '常住类型')->setCellValue($excel_order[7] . '1', '现 住 址')->setCellValue($excel_order[8] .
                '1', '户籍地址')->setCellValue($excel_order[9] . '1', '本人电话')->setCellValue($excel_order[10] .
                '1', '联系人姓名')->setCellValue($excel_order[11] . '1', '联系人电话')->setCellValue($excel_order[12] .
                '1', '与户主关系')->setCellValue($excel_order[13] . '1', '户主姓名')->setCellValue($excel_order[14] .
                '1', '建档日期');
            //设置单元格格式
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[0])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[1])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[2])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[3])->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[4])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[5])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[6])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[7])->setWidth(60);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[8])->setWidth(60);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[9])->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[10])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[11])->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[12])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[13])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[14])->setWidth(10);
            $i = 2;
            while ($core->fetch())
            {
                $name = $core->name;
                $filing_time = $core->filing_time ? adodb_date("Y-m-d", $core->filing_time) : "";
                //处理性别
                $sexs = @$sex[array_search_for_other($core->sex, $sex)][1];
                //处理民族
                $races = @$race[array_search_for_other($core->race, $race)][1];
                //常住类型
                $residence = @$registered_permanent_residence[array_search_for_other($individual_archive->
                    residence, $registered_permanent_residence)][1];
                //婚姻
                $marriages = @$marriage[array_search_for_other($individual_archive->marriage, $marriage)][1];
                $unit_name = $individual_archive->unit_name;
                $contact = $individual_archive->contact;
                $contact_number = $individual_archive->contact_number;
                $householder_name = get_househoder_name($core->family_number);
                $address = $core->address;
                $residence_address = $core->residence_address;
                $age = getBirthday($core->date_of_birth, time());
                $relation = @$relation_of_householder[array_search_for_other($core->
                    relation_holder, $relation_of_householder)][1];
                $identity_number = $core->identity_number;
                $phone_number = $core->phone_number;

                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($excel_order[0] . $i, $name)->
                    setCellValue($excel_order[1] . $i, $sexs)->setCellValue($excel_order[2] . $i, $age)->
                    setCellValue($excel_order[3] . $i, $identity_number . " ")->setCellValue($excel_order[4] .
                    $i, $races)->setCellValue($excel_order[5] . $i, $marriages)->setCellValue($excel_order[6] .
                    $i, $residence)->setCellValue($excel_order[7] . $i, $address)->setCellValue($excel_order[8] .
                    $i, $residence_address)->setCellValue($excel_order[9] . $i, $phone_number)->
                    setCellValue($excel_order[10] . $i, $contact)->setCellValue($excel_order[11] . $i,
                    $contact_number)->setCellValue($excel_order[12] . $i, $relation)->setCellValue($excel_order[13] .
                    $i, $householder_name)->setCellValue($excel_order[14] . $i, $filing_time);
                $i++;
            }
            $core->free_statement();
            // Rename sheet

            $objPHPExcel->getActiveSheet()->setTitle($title);
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
            // Redirect output to a client’s web browser (Excel5)
            //header('Content-Type: application/vnd.ms-excel');
            //header('Content-Disposition: attachment;filename="' . iconv('utf-8', 'gb2312', $title) . '.xls"');
            //header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            if(!file_exists(__SITEROOT.'cache/'.$this->user['region_id']))
            {
                mkdir(__SITEROOT.'cache/'.$this->user['region_id'],0777);
            }
            $objWriter->save(__SITEROOT.'cache/'.$this->user['region_id'].'/'.iconv('utf-8', 'gb2312', $title).'.xls');
            if($current<$total_files-1)
            {
                //页面跳转
                //生成跳转地址
                $url=__BASEPATH . 'iha/index/import/excel/do';
                foreach($search as $k=>$v)
                {
                    if($k=='org_id')
                    {
                        $url.='/region_p_id/'.$v;
                    }
                    else
                    {
                        $url.='/'.$k.'/'.$v;
                    }
                }
                $url.='/current/'.($current+1).'/total/'.$total_files;
                if($current==$total_files-2)
                {
                    message('文件导出完成，正在打包发送到浏览器，稍后将弹出文件下载对话框，文件保存完毕后，请手动离开本页面。', array(''=>$url) ,$url);
                }
                else
                {
                    message('分卷'.($current+1).'导出成功，稍后将导出分卷'.($current+2).'，共有分卷'.$total_files.'，每卷导出'.$per_mount.'条数据，<span style="color:red;font-size:18px">如果您对操作流程不熟悉，请不要点击任何连接，让浏览器自动跳转直到弹出下载文件框为止。</span>', array('快速导出下一个分卷'=>$url) ,$url);
                }
            }
            else
            {
                require_once __SITEROOT.'library/custom/zip.class.php';
                $zipfile=new zipfile();
                if($handle = opendir(__SITEROOT.'cache/'.$this->user['region_id']))
                {
                    while (false !== ($file = readdir($handle)))
                    {
                        if($file!='.' && $file!="..")
                        {
                            $zipfile->addFilePath(__SITEROOT.'cache/'.$this->user['region_id'].'/'.$file,$file);
                            @unlink(__SITEROOT.'cache/'.$this->user['region_id'].'/'.$file);
                        }
                    }
                }
                @rmdir(__SITEROOT.'cache/'.$this->user['region_id']);
                @header('Content-Encoding: none');
                @header('Content-Type: application/zip');
                @header('Content-Disposition: attachment ; filename='.iconv('utf-8', 'gb2312', urldecode($excel_name)).'.zip');
                @header('Pragma: no-cache');
                @header('Expires: 0');
                print($zipfile->file());
            }
            exit;
        }
    }
    /**
     * iha_indexController::importcsvAction()
     * 导出CSV
     * @return void
     */
    public function importcsvAction()
    {
        set_time_limit(0);
        //判断当前时间
        //2012-03-30 领导要求必须在下午4:30以后才允许导出
        $hours = @intval(date('Gi', time())); //小时分钟
        require_once __SITEROOT . "/library/custom/pager.php";
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        require_once __SITEROOT . '/library/custom/comm_function.php';
        //按下次随访日期搜索，默认情况下列出下次随访日期是今天的所有人员
        $search = array();
        $time = time();
        $excel_name = $this->_request->getParam('excel_name') ? $this->_request->
            getParam('excel_name') : "个人档案";
        $search['age_start'] = intval($this->_request->getParam('age_start')) ? intval($this->
            _request->getParam('age_start')) : 0; //年龄段
        $search['age_end'] = ($this->_request->getParam('age_end') !== '' && intval($this->
            _request->getParam('age_end')) >= $search['age_start']) ? intval($this->
            _request->getParam('age_end')) : '';
        $search['org_id'] = $this->_request->getParam('region_p_id'); //地区
        $search['sex'] = $this->_request->getParam('sex');
        $individual_core_region_path_domain = get_region_path(1, $search['org_id']);
        $is_excel = $this->_request->getParam('excel');
        $title = "";
        if ($is_excel != "do")
        {
            $this->view->excel_name = urldecode($excel_name);
            $this->view->search = $search;
            $this->view->age_start = $search['age_start'];
            $this->view->age_end = $search['age_end'];
            $this->view->sex = $sex;
            $this->view->assign('region_id', $this->user['region_id']);
            $this->view->assign('region_p_id', $this->user['region_id']);
            $this->view->assign('hours', $hours);
            $this->view->display('iha_import_csv.html');
        }
        else
        {
            if ($hours >= 900 && $hours <= 1630)
            {
                exit("请09:00之前，16:30之后使用导出数据功能");
            }
            $core = new Tindividual_core();
            //个人档案附加表，为实现高级搜索
            $individual_archive = new Tindividual_archive();
            foreach ($search as $k => $v)
            {
                if ($k == "age_start" && $v !== '')
                {
                    $title .= $v . "岁起";
                    $v = adodb_mktime(0, 0, 0, adodb_date("n", $time), adodb_date("j", $time),
                        adodb_date("Y", $time) - $v);
                    $core->whereAdd("individual_core.date_of_birth <= $v");
                }
                if ($k == "age_end" && $v != '')
                {
                    $title .= $v . "岁止";
                    $v = adodb_mktime(0, 0, 0, adodb_date("n", $time), adodb_date("j", $time),
                        adodb_date("Y", $time) - $v);
                    $core->whereAdd("individual_core.date_of_birth >= $v");
                }
                if ($k == "sex" && $v != '')
                {
                    $core->whereAdd("individual_core.$k = '$v'");
                    $title .= "性别为" . @$sex[array_search_for_other($v, $sex)][1] . "的";
                }
            }
            $core->joinAdd('left', $core, $individual_archive, 'uuid', 'id');
            $core->whereAdd($individual_core_region_path_domain);
            $core->orderby("individual_core.updated DESC");
            $core->find();
            //导出数据到浏览器，然后输出总共导出多少条数据
            $title .= urldecode($excel_name);
            //打开csv文件
            $fp = fopen(__SITEROOT . '/cache/' . iconv('utf-8', 'gb2312', $title) . '.csv',
                'w');
            // 填写标题
            fputcsv($fp, array(
                iconv('utf-8', 'gb2312', '姓名'),
                iconv('utf-8', 'gb2312', '性别'),
                iconv('utf-8', 'gb2312', '年龄'),
                iconv('utf-8', 'gb2312', '身份证号'),
                iconv('utf-8', 'gb2312', '民族'),
                iconv('utf-8', 'gb2312', '婚姻状况'),
                iconv('utf-8', 'gb2312', '常住类型'),
                iconv('utf-8', 'gb2312', '现 住 址'),
                iconv('utf-8', 'gb2312', '户籍地址'),
                iconv('utf-8', 'gb2312', '本人电话'),
                iconv('utf-8', 'gb2312', '联系人姓名'),
                iconv('utf-8', 'gb2312', '联系人电话'),
                iconv('utf-8', 'gb2312', '与户主关系'),
                iconv('utf-8', 'gb2312', '户主姓名'),
                iconv('utf-8', 'gb2312', '建档日期')));
            while ($core->fetch())
            {
                $name = $core->name;
                $filing_time = $core->filing_time ? adodb_date("Y-m-d", $core->filing_time) : "";
                //处理性别
                $sexs = @$sex[array_search_for_other($core->sex, $sex)][1];
                //处理民族
                $races = @$race[array_search_for_other($core->race, $race)][1];
                //常住类型
                $residence = @$registered_permanent_residence[array_search_for_other($individual_archive->
                    residence, $registered_permanent_residence)][1];
                //婚姻
                $marriages = @$marriage[array_search_for_other($individual_archive->marriage, $marriage)][1];
                $unit_name = $individual_archive->unit_name;
                $contact = $individual_archive->contact;
                $contact_number = $individual_archive->contact_number;
                $householder_name = get_househoder_name($core->family_number);
                $address = $core->address;
                $residence_address = $core->residence_address;
                $age = getBirthday($core->date_of_birth, time());
                $relation = @$relation_of_householder[array_search_for_other($core->
                    relation_holder, $relation_of_householder)][1];
                $identity_number = $core->identity_number;
                $phone_number = $core->phone_number;
                fputcsv($fp, array(
                    iconv('utf-8', 'gb2312', $name),
                    iconv('utf-8', 'gb2312', $sexs),
                    iconv('utf-8', 'gb2312', $age),
                    iconv('utf-8', 'gb2312', $identity_number) . "\t",
                    iconv('utf-8', 'gb2312', $races),
                    iconv('utf-8', 'gb2312', $marriages),
                    iconv('utf-8', 'gb2312', $residence),
                    iconv('utf-8', 'gb2312', $address),
                    iconv('utf-8', 'gb2312', $residence_address),
                    iconv('utf-8', 'gb2312', $phone_number) . "\t",
                    iconv('utf-8', 'gb2312', $contact),
                    iconv('utf-8', 'gb2312', $contact_number) . "\t",
                    iconv('utf-8', 'gb2312', $relation),
                    iconv('utf-8', 'gb2312', $householder_name),
                    iconv('utf-8', 'gb2312', $filing_time)));
            }
            fclose($fp);
            $core->free_statement();
            exit("导出完成");
        }
    }
    /**
     * iha_indexController::camAction()
     * @author 我好笨
     * @todo 完成摄像头采集照片
     * @return void
     */
    public function camAction()
    {
        $individual_session = new Zend_Session_Namespace("individual_core");
        $uuid = $individual_session->uuid;
        if (!$uuid)
        {
            echo '{
        		"error"		: 1,
        		"message"	: "上传头像出现问题，请重新选择用户后使用摄像头照相."
        	}';
            exit;
        }
        // We only need to handle POST requests:
        if (strtolower($_SERVER['REQUEST_METHOD']) != 'post')
        {
            exit;
        }
        $folder = __SITEROOT . 'upload/';
        $filename = $uuid . '.jpg';

        $original = $folder . $filename;

        // The JPEG snapshot is sent as raw input:
        $input = file_get_contents('php://input');

        if (md5($input) == '7d4df9cc423720b7f1f3d672b89362be')
        {
            // Blank image. We don't need this one.
            exit;
        }

        $result = file_put_contents($original, $input);
        if (!$result)
        {
            echo '{
        		"error"		: 1,
        		"message"	: "保存文件失败，请检查服务器目录"
        	}';
            exit;
        }

        $info = getimagesize($original);
        if ($info['mime'] != 'image/jpeg')
        {
            unlink($original);
            exit;
        }

        // Moving the temporary file to the originals folder:
        rename($original, __SITEROOT . 'upload/' . $filename);
        $original = __SITEROOT . 'upload/' . $filename;
        $origImage = imagecreatefromjpeg($original);
        //定义图像大小
        $maxwidth = 105;
        $maxheight = 128;
        $pic_width = imagesx($origImage);
        $pic_height = imagesy($origImage);

        if (($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight))
        {
            if ($maxwidth && $pic_width > $maxwidth)
            {
                $widthratio = $maxwidth / $pic_width;
                $resizewidth_tag = true;
            }

            if ($maxheight && $pic_height > $maxheight)
            {
                $heightratio = $maxheight / $pic_height;
                $resizeheight_tag = true;
            }

            if ($resizewidth_tag && $resizeheight_tag)
            {
                if ($widthratio < $heightratio)
                    $ratio = $widthratio;
                else
                    $ratio = $heightratio;
            }

            if ($resizewidth_tag && !$resizeheight_tag)
                $ratio = $widthratio;
            if ($resizeheight_tag && !$resizewidth_tag)
                $ratio = $heightratio;

            $newwidth = $pic_width * $ratio;
            $newheight = $pic_height * $ratio;

            if (function_exists("imagecopyresampled"))
            {
                $newImage = imagecreatetruecolor($newwidth, $newheight);
                imagecopyresampled($newImage, $origImage, 0, 0, 0, 0, $newwidth, $newheight, $pic_width,
                    $pic_height);
            }
            else
            {
                $newImage = imagecreate($newwidth, $newheight);
                imagecopyresized($newImage, $origImage, 0, 0, 0, 0, $newwidth, $newheight, $pic_width,
                    $pic_height);
            }

            $name = __SITEROOT . 'upload/' . $uuid . '.gif';
            imagegif($newImage, $name);
            imagedestroy($newImage);
        }
        else
        {
            $name = __SITEROOT . 'upload/' . $uuid . '.gif';
            imagegif($origImage, $name);
        }
        //删除原始JPG文件
        unlink($original);
        echo '{"status":1,"message":"照相成功","filename":"' . __BASEPATH . 'upload/' . $uuid .
            '.gif' . '"}';
    }
    /**
     * iha_indexController::mapAction()
     * 
     * 根据用户的地址，定位显示地图
     * 
     * @return void
     */
    public function mapAction()
    {
        require_once __SITEROOT . "library/Models/region.php";
        $key="e559931e51e2a55bafdff098d046bb65";
        $uuid=$this->_request->getParam('uuid');
        $core=new Tindividual_core();
        $core->whereAdd("uuid='$uuid'");
        $core->find(true);
        $region_path=@explode(',',$core->region_path);
        $city='';
        $region=new Tregion();
        $region->whereAdd("id='".$region_path[3]."'");
        $region->find(true);
        $region->free_statement();
        $city=$region->zh_name?$region->zh_name:'雅安市';
        //如果没有初始经纬度，根据地址获取
        if(!$core->position_x && !$core->position_y)
        {
            $address='';
            for($i=2;$i<count($region_path);$i++)
            {
                $region=new Tregion();
                $region->whereAdd("id='".$region_path[$i]."'");
                $region->find(true);
                $address.=$region->zh_name;
            }
            $url="http://api.map.baidu.com/geocoder?address=".urlencode($address)."&output=xml&key=".$key;
            $xml_content=file_get_contents($url);
            $position_obj = simplexml_load_string($xml_content, 'SimpleXMLElement', LIBXML_NOCDATA);
            $core->position_x=$position_obj->result[0]->location[0]->lat;
            $core->position_y=$position_obj->result[0]->location[0]->lng;
        }
        $this->view->core=$core;
        $this->view->city=$city;
        $this->view->display("map.html");
    }
    /**
     * iha_indexController::mapinAction()
     * 
     * 修改经纬度
     * 
     * @return void
     */
    public function mapinAction()
    {
        require_once __SITEROOT . '/library/custom/comm_function.php';
        $uuid=$this->_request->getParam('uuid');
        $address=$this->_request->getParam('address');
        $lat=$this->_request->getParam('lat');
        $lng=$this->_request->getParam('lng');
        $core=new Tindividual_core();
        if($address)
        {
            $core->address=$address;
        }
        if($lat)
        {
            $core->position_x=$lat;
        }
        if($lng)
        {
            $core->position_y=$lng;
        }
        $core->whereAdd("uuid='$uuid'");
        $url=__BASEPATH."iha/index/index";
        if($core->update())
        {
            message('修改用户经纬度及现住址成功。', array(''=>$url) ,$url);
        }
        else
        {
            message('修改用户经纬度及现住址失败。', array(''=>$url) ,$url);
        }
    }
    /**
     * iha_indexController::basecardAction()
     * 
     * 处理身份证号码，避免明文传输
     * 
     * @return void
     */
    public function basecardAction()
    {
        $card=$this->_request->getParam('vcard');
        if($card)
        {
            echo base64_encode($card);
            exit();
        }
        else
        {
            exit('');
        }
    }
}

?>