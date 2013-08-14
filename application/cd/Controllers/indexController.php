<?php

/*
* Created By Eric_Zhou
* Filename: indexController.php
* Date : 2010-08-17
* Summary : 慢病-高血压(http://host/cd/)
* 模块作者：我好笨
* 修改时间：2010-8-30
*/

class cd_indexController extends controller
{
    /**
     * 自动加载
     */
    public function init()
    {
        $this->haveWritePrivilege = '';
        //权限验证
        require_once (__SITEROOT . 'library/privilege.php');
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/custom/comm_function.php';
        require_once __SITEROOT . "library/Models/hypertension_follow_up.php";
        require_once __SITEROOT . "library/Models/hypertension_symptom.php";
        require_once __SITEROOT . "library/Models/follow_up_drugs.php";
        require_once __SITEROOT . "library/Models/staff_core.php";
        require_once __SITEROOT . "library/Models/staff_archive.php";
        require_once __SITEROOT . "/library/custom/pager.php";
        require_once __SITEROOT . "library/Models/individual_core.php";
        require_once __SITEROOT . "library/Models/clinical_history.php";
        require_once __SITEROOT . "application/gp/models/insert_physical_base.php"; //引入基本检查函数
        $this->view->basePath = $this->_request->getBasePath();
    }
    /**
     * 主控制器
     * 用于列表
     */
    public function indexAction()
    {  
        require_once (__SITEROOT . 'library/custom/region_array.php');
        //查看当前选中居民的高血压信息
		$individual_session=new Zend_Session_Namespace("individual_core");
		$seeion_id=$individual_session->uuid;
		$individual_name=new Tindividual_core();
		$individual_name->whereAdd("individual_core.uuid='$seeion_id'");
		$individual_name->find(true);
		$this->view->name=$individual_name->name;
		$current_time=time();//获取当前时间
		$before_time=strtotime(date("Y-01-01",time()));//获取年初时间
		$individual = new Tindividual_core();
		$hypertension_follow_up = new Thypertension_follow_up();
		$hypertension_follow_up->joinAdd('left',$hypertension_follow_up,$individual,'id','uuid');//关联个人信息
		$hypertension_follow_up->whereAdd("hypertension_follow_up.id='$seeion_id'");
		$hypertension_follow_up->whereAdd("hypertension_follow_up.follow_time>='".$before_time."'");
		$hypertension_follow_up->whereAdd("hypertension_follow_up.follow_time<='".$current_time."'");
		$hypertension_follow_up->orderby("hypertension_follow_up.follow_time ASC");
		$num=$hypertension_follow_up->count();
//		echo $num;
//		$hypertension_follow_up->debugLevel(9);
		$hypertension_follow_up->find();
		$hy_array=array();
		$n=0;
		while ($hypertension_follow_up->fetch())
		{
			$hy_array[$n]['num']=$n+1;
			$hy_array[$n]['uuid']=$hypertension_follow_up->uuid;
			$hy_array[$n]['name']=$individual->name;
			$n++;
		}
//		print_r($hy_array);
		$this->view->hy=$hy_array;
        //档案状态
        $status_flagArray = array(
            '' => array('0', '请选择'),
            '1' => array('1', '正常档案'),
            '4' => array('2', '临时档案'),
            '6' => array('3', '死亡档案'),
            '8' => array('4', '转出档案'));
        $current_status_flag = $this->_request->getParam('status_flag'); 
        $current_status_flag=$current_status_flag?$current_status_flag:1;
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
        //初始化搜索条件
        $submit=$this->_request->getParam('submit'); 
        $search = array();
        $search['username'] = trim($this->_request->getParam('username')); //姓名包含拼音
        $search['staff_id'] = ($this->_request->getParam('staff_id') == "-9") ? "" : $this->
            _request->getParam('staff_id'); //建档医生
        $search['standard_code'] = trim($this->_request->getParam('standard_code')); //标准档案号
        $search['identity_number'] = trim($this->_request->getParam('identity_number')); //身份证号
        $search['startdate']=$this->_request->getParam('startdate');
        $search['enddate']=$this->_request->getParam('enddate');
        $search['area']=$this->_request->getParam('area');
        $search['status_flag']=$current_status_flag;
        $search['is_gf']=$this->_request->getParam('is_gf');
        $hypertension_core_region_path_domain = get_region_path(1);
        $staff_core_region_path_domain = get_region_path(2);
        $hypertension_follow_up = new Thypertension_follow_up();
        $core = new Tindividual_core();
        $hypertension_follow_up->whereAdd($hypertension_core_region_path_domain);
        $hypertension_follow_up->joinAdd('inner', $hypertension_follow_up, $core, 'id',
            'uuid');
        if ($search['staff_id'])
        {
            $hypertension_follow_up->whereAdd("hypertension_follow_up.staff_id = '" . $search['staff_id'] .
                "'");
        }
        //2012年11月15日新增查询未达到规范管理的人员列表
        if($search['is_gf']==1 && $search['startdate'] && $search['enddate'])
        {
            $startdate  = strtotime(trim($this->_request->getParam('startdate')));
            $enddate = strtotime(trim($this->_request->getParam('enddate')))+(3600*24-1);
            //计算:(取整函数(("查询日期开始时间"-"查询日期结束时间")/90))
            $tmp_num=0;
            $tmp_num=floor((($enddate-$startdate)/(3600*24))/90);
            $hypertension_follow_up->whereAdd("hypertension_follow_up.id in (select id from (select count(hypertension_follow_up.uuid),id from hypertension_follow_up where (hypertension_follow_up.id in (select uuid from individual_core where ($hypertension_core_region_path_domain) and status_flag='1' and updated <=$enddate) and hypertension_follow_up.id in (select id from clinical_history where disease_code='2')) and (follow_time >= $startdate and follow_time <= $enddate) group by hypertension_follow_up.id having count(hypertension_follow_up.uuid)<$tmp_num))");
        }
        if ($search['username'])
        {
            $hypertension_follow_up->whereAdd("individual_core.name like '" . $search['username'] .
                "%' or individual_core.name_pinyin like '" . $search['username'] . "%'");
        }
        if ($search['standard_code'])
        {
            $hypertension_follow_up->whereAdd("individual_core.standard_code_1 like '" . $search['standard_code'] .
                "%'");
        }
        if ($search['identity_number'])
        {
            $hypertension_follow_up->whereAdd("individual_core.identity_number like '" . $search['identity_number'] .
                "%'");
        }
        if($search['startdate'])
        {    
            $startdate  = strtotime(trim($this->_request->getParam('startdate')));
            $hypertension_follow_up->whereAdd("hypertension_follow_up.follow_time>='".$startdate."'");
        }
        if($search['enddate'])
        {
            $enddate = strtotime(trim($this->_request->getParam('enddate')));
            $hypertension_follow_up->whereAdd("hypertension_follow_up.follow_time<='".$enddate."'");
        }
        if($search['status_flag'])
        {
            $hypertension_follow_up->whereAdd("individual_core.status_flag = '" . $current_status_flag ."'");
        }
        $search['org_id'] = $this->_request->getParam('org_id')?$this->_request->getParam('org_id'):$this->user['region_id']; //地区
        $search['gj_show']=$this->_request->getParam('gj_show_post')?$this->_request->getParam('gj_show_post'):$this->_request->getParam('gj_show');
        $individual_core_region_path_domain = get_region_path(1, $search['org_id']); 
        $hypertension_follow_up->whereAdd($individual_core_region_path_domain);
        
        $nums = $hypertension_follow_up->count("distinct hypertension_follow_up.id");
        $pageCurrent = intval($this->_request->getParam('page'));
        $pageCurrent = $pageCurrent ? $pageCurrent : 1;
        //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,
            __BASEPATH . 'cd/index/index/page/', 2, $search);
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = __ROWSOFPAGE * ($pageCurrent - 1); //计算开始记录数
        //$hypertension_follow_up->debugLevel(5);
        //$core->selectAdd("individual_core.uuid as uuid");
        $hypertension_follow_up->selectAdd("hypertension_follow_up.id as id,individual_core.standard_code_1,individual_core.identity_number,individual_core.name as name,individual_core.name_pinyin as name_pinyin,count(hypertension_follow_up.uuid) as snums");
        $hypertension_follow_up->groupBy("hypertension_follow_up.id,individual_core.name,individual_core.name_pinyin,individual_core.standard_code_1,individual_core.identity_number");
        //处理分页
        $hypertension_follow_up->limit($startnum, __ROWSOFPAGE);
        $hypertension_follow_up->find();
        $hypertension_array = array();
        $i = 0;
        while ($hypertension_follow_up->fetch())
        {
            $hypertension_array[$i]['snums'] = $hypertension_follow_up->snums;
            $hypertension_array[$i]['id'] = $hypertension_follow_up->id;
            if ($this->haveWritePrivilege)
            {
                $hypertension_array[$i]['ssname'] = $hypertension_follow_up->name;
            }
            else
            {
                $hypertension_array[$i]['ssname'] = "*";
            }
            $hypertension_array[$i]['name'] = get_individual_info($hypertension_follow_up->
                id);
            $hypertension_array[$i]['moreinfo'] = get_moreinfo_hypertension($hypertension_follow_up->
                id);
            $status_mb=get_status_cd($hypertension_follow_up->id);
            if($status_mb->disease_state==1)
            {
                $hypertension_array[$i]['image']='hz';
            }
            else
            {
                $hypertension_array[$i]['image']='no_person';
            }
            $i++;
        }
        $out = $links->subPageCss2();
        //医生列表
        $this->view->response_doctor = get_doctor_list($this->user['current_region_path_domain'],
            $search['staff_id']);
        $this->view->search = $search;
        $this->view->assign("startdate",$search['startdate']);
        $this->view->assign("enddate",$search['enddate']);
        $this->view->assign("display",$submit?$submit:'none'); 
        //控制高级搜索显示
        $this->view->gj_show=$search['gj_show'];
        $this->view->assign("pager", $out);  
        $this->view->hypertension = $hypertension_array;
        
        $this->view->assign('org_id', $search['org_id']);
        //2012-11-22根据文档，取本机构下高血压患者，且未填写确诊时间的人数
        require_once __SITEROOT . '/library/Models/clinical_history.php';
        $core = new Tindividual_core();
        $clinical_history = new Tclinical_history();
        $core->whereAdd($individual_core_region_path_domain);
        $core->joinAdd('inner', $core, $clinical_history, 'uuid','id');
        $core->whereAdd("clinical_history.disease_code='2' and clinical_history.disease_state=1 and (clinical_history.disease_date='' or clinical_history.disease_date is null) and (individual_core.status_flag=1 or individual_core.status_flag=4)");
        $errors=$core->count();
        if($errors)
        {
            $error_string='<span style="color:red;font-size:14px">本机构存在【'.$errors.'】名高血压患者未正确填写确诊日期，为了统计结果精确，请<a href="'.$this->_request->getBasePath().'cd/index/nodate">查看未填写确诊日期患者列表</a>并依次填写确诊日期。</span>';
            $this->view->error_string=$error_string;
        }
        $this->view->display('cd_index.html');
    }
    /**
     * cd_indexController::nodateAction()
     * 
     * 2012-11-22根据文档，增加显示确诊未显示随访时间的人群
     * 
     * @return void
     */
    public function nodateAction()
    {
        require_once __SITEROOT . '/library/Models/clinical_history.php';
        require_once __SITEROOT . "/library/custom/pager.php";
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        require_once __SITEROOT . '/library/custom/comm_function.php';
        $search['org_id'] = $this->_request->getParam('org_id')?$this->_request->getParam('org_id'):$this->user['region_id']; //地区
        $individual_core_region_path_domain = get_region_path(1, $search['org_id']);
        $core = new Tindividual_core();
        $clinical_history = new Tclinical_history();
        $core->whereAdd($individual_core_region_path_domain);
        $core->joinAdd('inner', $core, $clinical_history, 'uuid','id');
        $core->whereAdd("clinical_history.disease_code='2' and clinical_history.disease_state=1 and (clinical_history.disease_date='' or clinical_history.disease_date is null) and (individual_core.status_flag=1 or individual_core.status_flag=4)");
        $nums = $core->count();
        //$core->whereAdd("individual_core.updated>0");
        //showtimer();
        $pageCurrent = intval($this->_request->getParam('page'));
        $pageCurrent = $pageCurrent ? $pageCurrent : 1;
        //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,
            __BASEPATH . 'cd/index/nodate/page/', 2, $search);
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = __ROWSOFPAGE * ($pageCurrent - 1); //计算开始记录数
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
		individual_core.criteria_rate as criteria_rate
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
            //$indiv[$i]['standard_code']=$core->region_path.'|'.$core->standard_code_1;
            $indiv[$i]['address'] = $core->address;
            $indiv[$i]['sex'] = @$sex[array_search_for_other($core->sex, $sex)][1];
            $indiv[$i]['date_of_birth'] = adodb_date("Y-m-d", $core->date_of_birth);
            $indiv[$i]['age'] = getBirthday($core->date_of_birth, time());
            $indiv[$i]['criteria_rate'] = $core->criteria_rate * 100;
            $indiv[$i]['staff_id'] = $core->staff_id;
            $indiv[$i]['staff_name'] = get_staff_name_byid($core->staff_id);
            $i++;
        }
        $out = $links->subPageCss2();
        $this->view->assign("page", $pageCurrent);
        $this->view->assign("para_page", $pageCurrent);
        $this->view->assign("pager", $out);
        $this->view->assign("iha", $indiv);
        $individual_session = new Zend_Session_Namespace("individual_core"); 
        $this->view->assign("individual_current", $individual_session);
        $this->view->display("nodate.html");
    }
    /**
     * 用于导出数据导Excel
     * 提供选择时间段的功能
     */
    public function importAction()
    {
        //2012-03-30 领导要求必须在下午4:30以后才允许导出
        $hours=@intval(date('Gi',time()));//小时分钟
        //按下次随访日期搜索，默认情况下列出下次随访日期是今天的所有人员
        $search = array();
        $time = time();
        $time_start = adodb_mktime(0, 0, 0, date("n", $time), date("j", $time), date("Y",
            $time));
        $time_end = adodb_mktime(0, 0, 0, date("n", $time), date("j", $time) + 1, date("Y",
            $time));
        $this->view->start_time = $this->_request->getParam('start_time') ? $this->
            _request->getParam('start_time') : date("Y-m-d");
        $this->view->end_time = $this->_request->getParam('end_time') ? $this->_request->
            getParam('end_time') : date("Y-m-d");
        $search['start_time'] = $this->_request->getParam('start_time') ? strtotime($this->
            _request->getParam('start_time')) : $time_start; //开始日期
        $search['end_time'] = $this->_request->getParam('end_time') ? strtotime($this->
            _request->getParam('end_time')) : $time_end; //结束日期
        $search['staff_id'] = ($this->_request->getParam('staff_id') == "-9") ? "" : $this->
            _request->getParam('staff_id'); //建档医生
        $hypertension_core_region_path_domain = get_region_path(1);
        $staff_core_region_path_domain = get_region_path(2);
        $hypertension_follow_up = new Thypertension_follow_up();
        $core = new Tindividual_core();
        $hypertension_follow_up->whereAdd($hypertension_core_region_path_domain);
        $hypertension_follow_up->joinAdd('inner', $hypertension_follow_up, $core, 'id',
            'uuid');
        if ($search['staff_id'])
        {
            $hypertension_follow_up->whereAdd("hypertension_follow_up.staff_id = '" . $search['staff_id'] .
                "'");
        }
        if ($search['start_time'])
        {
            $hypertension_follow_up->whereAdd("hypertension_follow_up.follow_next_time >= '" .
                $search['start_time'] . "'");
        }
        if ($search['end_time'])
        {
            $hypertension_follow_up->whereAdd("hypertension_follow_up.follow_next_time <= '" .
                $search['end_time'] . "'");
        }
        $nums = $hypertension_follow_up->count("distinct hypertension_follow_up.id");
        $hypertension_follow_up->selectAdd("hypertension_follow_up.id as id,individual_core.standard_code_1,individual_core.identity_number,individual_core.name as name,individual_core.name_pinyin as name_pinyin,count(hypertension_follow_up.uuid) as snums");
        $hypertension_follow_up->groupBy("hypertension_follow_up.id,individual_core.name,individual_core.name_pinyin,individual_core.standard_code_1,individual_core.identity_number");
        $hypertension_follow_up->orderBy("individual_core.name_pinyin DESC");
        $hypertension_follow_up->find();
        $hypertension_array = array();
        $i = 0;
        while ($hypertension_follow_up->fetch())
        {
            $hypertension_array[$i]['snums'] = $hypertension_follow_up->snums;
            $hypertension_array[$i]['id'] = $hypertension_follow_up->id;
            if ($this->haveWritePrivilege)
            {
                $hypertension_array[$i]['ssname'] = $hypertension_follow_up->name;
            }
            else
            {
                $hypertension_array[$i]['ssname'] = "*";
            }
            $hypertension_array[$i]['name'] = get_individual_info($hypertension_follow_up->
                id);
            $hypertension_array[$i]['moreinfo'] = get_moreinfo_hypertension($hypertension_follow_up->
                id, $search['start_time'], $search['end_time']);
            $i++;
        }
        $hypertension_follow_up->free_statement();
        $is_excel = $this->_request->getParam('excel');
        if ($is_excel != "do")
        {
            //医生列表
            $this->view->response_doctor = get_doctor_list($this->user['current_region_path_domain'],
                $search['staff_id']);
            $this->view->search = $search;
            $this->view->hypertension = $hypertension_array;
            $this->view->assign('hours', $hours);
            $this->view->display('cd_import_index.html');
        }
        else
        {
            if($hours>=900 && $hours<=1630)
            {
                exit("请09:00之前，16:30之后使用导出数据功能");
            }
            //导出数据到浏览器，然后输出总共导出多少条数据
            /** PHPExcel */
            require_once __SITEROOT . 'library/phpexcel/Classes/PHPExcel.php';
            // Create new PHPExcel object
            $title = date("Y/m/d", $search['start_time']) . "-" . date("Y/m/d", $search['end_time']) .
                "高血压下次随访人员表";
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
                setCellValue($excel_order[1] . '1', '地址')->setCellValue($excel_order[2] . '1',
                '联系电话')->setCellValue($excel_order[3] . '1', '上次随访时间')->setCellValue($excel_order[4] .
                '1', '上次随访结果')->setCellValue($excel_order[5] . '1', '计划随访时间')->setCellValue($excel_order[6] .
                '1', '上次随访医生')->setCellValue($excel_order[7] . '1', '随访总次数');
            //设置单元格格式
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[0])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[1])->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[2])->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[3])->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[4])->setWidth(60);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[5])->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[6])->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[7])->setWidth(15);
            $i = 2;
            foreach ($hypertension_array as $k => $v)
            {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($excel_order[0] . $i, $v['ssname'])->
                    setCellValue($excel_order[1] . $i, $v['name']->address)->setCellValue($excel_order[2] .
                    $i, $v['name']->phone_number)->setCellValue($excel_order[3] . $i, $v['moreinfo']->
                    follow_time)->setCellValue($excel_order[4] . $i, $v['moreinfo']->follow_result)->
                    setCellValue($excel_order[5] . $i, $v['moreinfo']->follow_next_time)->
                    setCellValue($excel_order[6] . $i, $v['moreinfo']->staff_id)->setCellValue($excel_order[7] .
                    $i, $v['snums']);
                $i++;
            }

            // Rename sheet

            $objPHPExcel->getActiveSheet()->setTitle("高血压下次随访人员表");
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $title . '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }
    }
    /**
     * cd_indexController::import_patientAction()
     * @author 我好笨
     * @todo 2012-03-07 实现导出患者列表
     * @return void
     */
    public function import_patientAction()
    {
        //2012-03-30 领导要求必须在下午4:30以后才允许导出
        $hours=@intval(date('Gi',time()));//小时分钟
        if($hours>=900 && $hours<=1630)
        {
            exit("请09:00之前，16:30之后使用导出数据功能");
        }
        $search = array();
        $time = time();
        $time_start = adodb_mktime(0, 0, 0, date("n", $time), date("j", $time), date("Y",
            $time));
        $time_end = adodb_mktime(0, 0, 0, date("n", $time), date("j", $time) + 1, date("Y",
            $time));
        $this->view->start_time = $this->_request->getParam('start_time') ? $this->
            _request->getParam('start_time') : date("Y-m-d");
        $this->view->end_time = $this->_request->getParam('end_time') ? $this->_request->
            getParam('end_time') : date("Y-m-d");
        $search['start_time'] = $this->_request->getParam('start_time') ? strtotime($this->
            _request->getParam('start_time')) : $time_start; //开始日期
        $search['end_time'] = $this->_request->getParam('end_time') ? strtotime($this->
            _request->getParam('end_time')) : $time_end; //结束日期
        $search['staff_id'] = ($this->_request->getParam('staff_id') == "-9") ? "" : $this->
            _request->getParam('staff_id'); //建档医生
        $hypertension_core_region_path_domain = get_region_path(1);
        $staff_core_region_path_domain = get_region_path(2);
        $core = new Tindividual_core();
        $clinical_history = new Tclinical_history();
        $hypertension_follow_up = new Thypertension_follow_up();
        $core->whereAdd($hypertension_core_region_path_domain);
        $core->joinAdd('left', $core, $hypertension_follow_up, 'uuid', 'id');
        $core->joinAdd('left', $core, $clinical_history, 'uuid', 'id');
        $core->whereAdd("clinical_history.disease_code = '2' and clinical_history.disease_state = '1'");
        $core->selectAdd("individual_core.uuid as uuid,individual_core.standard_code_1,individual_core.identity_number,individual_core.name as name,individual_core.name_pinyin as name_pinyin,clinical_history.disease_date,count(hypertension_follow_up.uuid) as snums");
        $core->groupBy("individual_core.uuid,individual_core.name,individual_core.name_pinyin,clinical_history.disease_date,individual_core.standard_code_1,individual_core.identity_number");
        $core->orderBy("individual_core.name_pinyin DESC");
        $core->find();
        $hypertension_array = array();
        $i = 0;
        while ($core->fetch())
        {
            $hypertension_array[$i]['snums'] = $core->snums;
            ////取随访总次数
//            $hypertension = new Thypertension_follow_up();
//            $hypertension->whereAdd("id='".$core->uuid."'");
//            $hypertension_array[$i]['snums']=$hypertension->count();
//            $hypertension->free_statement();
            if ($this->haveWritePrivilege)
            {
                $hypertension_array[$i]['ssname'] = $core->name;
            }
            else
            {
                $hypertension_array[$i]['ssname'] = "*";
            }
            $hypertension_array[$i]['name'] = get_individual_info($core->uuid);
            $hypertension_array[$i]['moreinfo'] = get_moreinfo_hypertension($core->uuid,
                mktime(0, 0, 0, date('m', time()), date('d', time()), date('Y', time()) - 1),
                time());
            $hypertension_array[$i]['disease_date']=$core->disease_date?date("Y-m-d",$core->disease_date):"";
            $i++;
        }
        $core->free_statement();
        $is_excel = $this->_request->getParam('excel');

        //导出数据到浏览器，然后输出总共导出多少条数据
        /** PHPExcel */
        require_once __SITEROOT . 'library/phpexcel/Classes/PHPExcel.php';
        // Create new PHPExcel object
        $title = "高血压患者表";
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
            setCellValue($excel_order[1] . '1', '地址')->setCellValue($excel_order[2] . '1',
            '联系电话')->setCellValue($excel_order[3] . '1', '上次随访时间')->setCellValue($excel_order[4] .
            '1', '上次随访结果')->setCellValue($excel_order[5] . '1', '计划随访时间')->setCellValue($excel_order[6] .
            '1', '上次随访医生')->setCellValue($excel_order[7] . '1', '随访总次数')->setCellValue($excel_order[8] . '1', '确诊时间');
        //设置单元格格式
        $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[0])->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[1])->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[2])->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[3])->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[4])->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[5])->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[6])->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[7])->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[8])->setWidth(25);
        $i = 2;
        foreach ($hypertension_array as $k => $v)
        {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($excel_order[0] . $i, $v['ssname'])->
                setCellValue($excel_order[1] . $i, $v['name']->address)->setCellValue($excel_order[2] .
                $i, $v['name']->phone_number)->setCellValue($excel_order[3] . $i, $v['moreinfo']->
                follow_time)->setCellValue($excel_order[4] . $i, $v['moreinfo']->follow_result)->
                setCellValue($excel_order[5] . $i, $v['moreinfo']->follow_next_time)->
                setCellValue($excel_order[6] . $i, $v['moreinfo']->staff_id)->setCellValue($excel_order[7] .
                $i, $v['snums'])->setCellValue($excel_order[8] .
                $i, $v['disease_date']);
            $i++;
        }

        // Rename sheet

        $objPHPExcel->getActiveSheet()->setTitle("高血压患者表");
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $title . '.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
    /**
     * 添加页面
     */
    public function addAction()
    {
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        $this->view->assign("symptom_code_array", $symptom_code);
        $this->view->assign("follow_type_array", $follow_type);
        $this->view->assign("psychology_array", $psychology);
        $this->view->assign("pregnancy_array", $pregnancy);
        $this->view->assign("treatment_compliance_array", $treatment_compliance);
        $this->view->assign("medication_compliance_array", $medication_compliance);
        $this->view->assign("adverse_drug_array", $adverse_drug);
        $this->view->assign("follow_up_result_array", $follow_up_result);
        $this->view->assign("adverse_drug_json_array", json_encode($adverse_drug)); //因为JS文件中使用
        $uuid = $this->_request->getParam("uuid", '');
        $this->view->uuid = $uuid;
        $individual_session = new Zend_Session_Namespace("individual_core");
        if (empty($uuid))
        {
            if (empty($individual_session->uuid) || empty($individual_session->staff_id))
            {
                message("请在个人档案列表双击选中居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
            }
        }
        if (empty($uuid))
        {
            if ($this->haveWritePrivilege)
            {
                $this->view->user_name = $individual_session->name; //居民姓名
                $this->view->standard_code = $individual_session->standard_code_1; //标准档案号
            }
            else
            {
                $this->view->user_name = "*"; //居民姓名
                $this->view->standard_code = "*"; //标准档案号
            }
            $this->view->response_doctor = $individual_session->response_doctor; //责任医生id
            $this->view->person_uuid = $individual_session->uuid; //个人uuid
            //$this->view->examination_doctor =$all_user;
        }
        else
        {
            $individual_inf = get_individual_info($individual_session->uuid); //取得个人信息中所有信息
            if ($this->haveWritePrivilege)
            {
                $this->view->user_name = $individual_inf->name; //居民姓名
                $this->view->standard_code = $examination_table->serial_number; //标准档案号
            }
            else
            {
                $this->view->user_name = "*"; //居民姓名
                $this->view->standard_code = "*"; //标准档案号
            }
        }
        //取性别
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("uuid='" . $individual_session->uuid . "'");
        $individual_core->find(true);
        $this->view->sex_code = $individual_core->sex;
        //2012-02-21仅查询正常档案，我好笨
        if ($individual_core->status_flag != 1)
        {
            message("你选择了一个非正常档案，请重新选择", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
        //取慢病状态---2011-10-27贾老师新意见，取消此限制
        $cd_status = get_status_cd($individual_session->uuid);
        /*if(!isset($cd_status->disease_state) || $cd_status->disease_state==0 || $cd_status->disease_state=="")
        {
        message("对不起，高血压随访仅针对高血压患者，您选择的【".$individual_core->name."】属于非高血压患者，您可以在随访记录列表的右上角点+号图标，查看和搜索高血压患者",array("进入随访记录列表"=>__BASEPATH.'cd/index/index'));
        }
        else
        {
        $this->view->sign_hypertension=$cd_status->disease_state;
        }*/
        //2012-11-22增加提示无确诊时间问题
        require_once __SITEROOT . '/library/Models/clinical_history.php';
        $clinical_history = new Tclinical_history();
        $clinical_history->whereAdd("id='$individual_session->uuid'");
        $clinical_history->disease_code='2';
        $clinical_history->find(true);
        if($clinical_history->disease_state==1 && !$clinical_history->disease_date)
        {
            $error_string='<span style="color:red;font-size:14px">此档案未添加高血压确诊日期，将影响统计结果，请<a href="'.$this->_request->getBasePath().'iha/index/add/uuid/'.$individual_session->uuid.'" target="_blank">在新窗口填写</a>确诊日期后保存。</span>';
            $this->view->error_string=$error_string;
        }
        $this->view->sign_hypertension = $cd_status->disease_state;
        //给随访时间初始值
        $this->view->follow_time_year = date("Y", time());
        $this->view->follow_time_month = date("m", time());
        $this->view->follow_time_day = date("d", time());
        //医生列表
        $this->view->response_doctor = get_doctor_list($this->user['current_region_path_domain'],
            $this->user['uuid']);
        //权限
        if ($this->haveWritePrivilege)
        {
            $this->view->ajax_save_disabled = "";
        }
        else
        {
            $this->view->ajax_save_disabled = "disabled";
        }
        //取今天内的血压值
        $person_uuid = $individual_session->uuid;
        require_once __SITEROOT . "library/Models/physical_base.php"; //取血压结果
        $today = mktime(0, 0, 0, adodb_date("m", time()), adodb_date("j", time()),
            adodb_date("Y", time()));
        $physical_base = new Tphysical_base();
        $physical_base->whereAdd("id='$person_uuid'");
        $physical_base->whereAdd("created>='$today'");
        $physical_base->find();
        $blood_today = array();
        $i = 0;
        while ($physical_base->fetch())
        {
            $blood_today[$i]['s_blood_pressure'] = $physical_base->s_blood_pressure;
            $blood_today[$i]['p_blood_pressure'] = $physical_base->p_blood_pressure;
            $blood_today[$i]['height'] = $physical_base->height;
            $blood_today[$i]['weight'] = $physical_base->weight;
            $i++;
        }
        $this->view->blood_today = $blood_today;
        $this->view->display('cd_add.html');
    }
    /**
     * 编辑个人的随访记录
     */
    public function editAction()
    {
        //获取UUID
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        $this->view->assign("symptom_code_array", $symptom_code);
        $this->view->assign("follow_type_array", $follow_type);
        $this->view->assign("psychology_array", $psychology);
        $this->view->assign("pregnancy_array", $pregnancy);
        $this->view->assign("treatment_compliance_array", $treatment_compliance);
        $this->view->assign("medication_compliance_array", $medication_compliance);
        $this->view->assign("adverse_drug_array", $adverse_drug);
        $this->view->assign("follow_up_result_array", $follow_up_result);
        $this->view->assign("adverse_drug_json_array", json_encode($adverse_drug)); //因为JS文件中使用
        $uuid = $this->_request->getParam("uuid");
        if ($uuid)
        {
            //展现编辑框
            $hypertension_follow_up = new Thypertension_follow_up();
            $hypertension_follow_up->whereAdd("uuid='$uuid'");
            $hypertension_follow_up->find(true);
            $this->view->uuid = $hypertension_follow_up->uuid; //编号
            $this->view->staff_id = $hypertension_follow_up->staff_id; //医生档案号
            $this->view->person_uuid = $hypertension_follow_up->id; //个人档案号
            //取性别
            $individual_core = new Tindividual_core();
            $individual_core->whereAdd("uuid='" . $hypertension_follow_up->id . "'");
            $individual_core->find(true);
            $this->view->sex_code = $individual_core->sex;
            //2012-11-22增加提示无确诊时间问题
            require_once __SITEROOT . '/library/Models/clinical_history.php';
            $clinical_history = new Tclinical_history();
            $clinical_history->whereAdd("id='$hypertension_follow_up->id'");
            $clinical_history->disease_code='2';
            $clinical_history->find(true);
            if($clinical_history->disease_state==1 && !$clinical_history->disease_date)
            {
                $error_string='<span style="color:red;font-size:14px">此档案未添加高血压确诊日期，将影响统计结果，请<a href="'.$this->_request->getBasePath().'iha/index/add/uuid/'.$hypertension_follow_up->id.'" target="_blank">在新窗口填写</a>确诊日期后保存。</span>';
                $this->view->error_string=$error_string;
            }
            $this->view->follow_time_year = $hypertension_follow_up->follow_time ?
                adodb_date("Y", $hypertension_follow_up->follow_time) : ""; //随访日期
            $this->view->follow_time_month = $hypertension_follow_up->follow_time ?
                adodb_date("m", $hypertension_follow_up->follow_time) : ""; //随访日期
            $this->view->follow_time_day = $hypertension_follow_up->follow_time ? adodb_date("d",
                $hypertension_follow_up->follow_time) : ""; //随访日期
            $this->view->follow_next_time = $hypertension_follow_up->follow_next_time ?
                adodb_date("Y-m-d", $hypertension_follow_up->follow_next_time) : ""; //下次随访日期
            $this->view->follow_type = array_search_for_other($hypertension_follow_up->
                follow_type, $follow_type); //随访方式
            $this->view->blood_pressure = $hypertension_follow_up->blood_pressure; //血压
            $this->view->diastolic_blood_pressure = $hypertension_follow_up->
                diastolic_blood_pressure; //舒张压
            $this->view->blood_difference = $hypertension_follow_up->blood_difference; //双侧血压差
            $this->view->height = $hypertension_follow_up->height; //身高
            $this->view->weight_begin = $hypertension_follow_up->weight_begin; //体重
            $this->view->pregnancy = array_search_for_other($hypertension_follow_up->
                pregnancy, $pregnancy); //是否妊娠期或哺乳期
            $this->view->weight_after = $hypertension_follow_up->weight_after; //预期体重
            $this->view->body_mass_index = $hypertension_follow_up->body_mass_index; //体质指数
            $this->view->heart_rate_begin = $hypertension_follow_up->heart_rate_begin; //心率
            $this->view->heart_rate_after = $hypertension_follow_up->heart_rate_after; //期望心率
            $this->view->signs_other = $hypertension_follow_up->signs_other; //体征其他
            $this->view->smoking_begin = $hypertension_follow_up->smoking_begin; //日吸烟量
            $this->view->smoking_after = $hypertension_follow_up->smoking_after; //期望日吸烟量
            $this->view->drinking_begin = $hypertension_follow_up->drinking_begin; //日饮酒量
            $this->view->drinking_after = $hypertension_follow_up->drinking_after; //期望日饮酒量
            $this->view->sport_amount_begin = $hypertension_follow_up->sport_amount_begin; //运动次数（次/周）
            $this->view->sport_amount_after = $hypertension_follow_up->sport_amount_after; //期望运动次数（次/周）
            $this->view->sport_time_begin = $hypertension_follow_up->sport_time_begin; //运动频率（分钟/次）
            $this->view->sport_time_after = $hypertension_follow_up->sport_time_after; //期望运动频率（分钟/次）
            $this->view->salt_intake_begin = $hypertension_follow_up->salt_intake_begin; //摄盐情况（克/天）
            $this->view->salt_intake_after = $hypertension_follow_up->salt_intake_after; //期望摄盐情况（克/天）
            $this->view->psychology = array_search_for_other($hypertension_follow_up->
                psychology, $psychology); //心理调整
            $this->view->treatment_compliance = array_search_for_other($hypertension_follow_up->
                treatment_compliance, $treatment_compliance); //遵医行为
            $this->view->auxiliary_check = $hypertension_follow_up->auxiliary_check; //辅助检查
            $this->view->medication_compliance = array_search_for_other($hypertension_follow_up->
                medication_compliance, $medication_compliance); //服药依从性
            $this->view->adverse_drug = array_search_for_other($hypertension_follow_up->
                adverse_drug, $adverse_drug); //药物不良反应
            $this->view->adverse_drug_info = $hypertension_follow_up->adverse_drug_info; //药物不良反应详细说明
            $this->view->follow_up_result = array_search_for_other($hypertension_follow_up->
                follow_up_result, $follow_up_result); //此次随访分类
            $this->view->referral_reason = $hypertension_follow_up->referral_reason; //转诊原因
            $this->view->organization = $hypertension_follow_up->organization; //机构及科别
            $this->view->symptom_other = $hypertension_follow_up->symptom_other; //症状内容
            $this->view->follow_result = $hypertension_follow_up->follow_result; //症状内容
            //个人信息
            $individual_inf = get_individual_info($hypertension_follow_up->id); //取得个人信息中所有信息
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
            //取慢病状态
            $cd_status = get_status_cd($hypertension_follow_up->id);
            if ($cd_status)
            {
                $this->view->sign_hypertension = $cd_status->disease_state;
            }
            //读症状表
            $this->view->symptom_code = get_follow_symptom_code($hypertension_follow_up->
                uuid); //获取症状信息
            //读药品表
            $this->view->drug = get_follow_drug($hypertension_follow_up->uuid); //获取药品信息
            //医生列表
            $this->view->response_doctor = get_doctor_list($this->user['current_region_path_domain'],
                $hypertension_follow_up->staff_id);
            //权限
            if ($this->haveWritePrivilege)
            {
                $this->view->ajax_save_disabled = "";
            }
            else
            {
                $this->view->ajax_save_disabled = "disabled";
            }
            //取今天内的血压值
            $person_uuid = isset($individual_session->uuid) ? $individual_session->uuid : $hypertension_follow_up->
                id;
            require_once __SITEROOT . "library/Models/physical_base.php"; //取血压结果
            $today = mktime(0, 0, 0, adodb_date("m", time()), adodb_date("j", time()),
                adodb_date("Y", time()));
            $physical_base = new Tphysical_base();
            $physical_base->whereAdd("id='$person_uuid'");
            $physical_base->whereAdd("created>='$today'");
            $physical_base->find();
            $blood_today = array();
            $i = 0;
            while ($physical_base->fetch())
            {
                $blood_today[$i]['s_blood_pressure'] = $physical_base->s_blood_pressure;
                $blood_today[$i]['p_blood_pressure'] = $physical_base->p_blood_pressure;
                $i++;
            }
            $this->view->blood_today = $blood_today;
            $this->view->display('cd_add.html');
        }
        else
        {
            //错误
            $url = array(
                "随访记录列表" => __BASEPATH . 'cd/index/index',
                "用户列表" => __BASEPATH . 'iha/index/index',
                "新增随访" => __BASEPATH . 'iha/index/add');
            message("编辑高血压随访记录失败，代码：cd004", $url);
        }
    }
    /**
     * 删除随访记录
     */
    public function deleteAction()
    {
        if (!$this->haveWritePrivilege)
        {
            $url = array("随访记录列表" => __BASEPATH . 'cd/index/index', "用户列表" => __BASEPATH .
                    'iha/index/index');
            message("对不起，你可能没有权限删除本信息，代码：cd010", $url);
        }
        //获取UUID
        $uuid = $this->_request->getParam("uuid");
        if ($uuid)
        {
            //读取该条记录信息
            $error_code = "";
            $hypertension_follow_up = new Thypertension_follow_up();
            $hypertension_follow_up->whereAdd("uuid='$uuid'");
            $hypertension_follow_up->find(true);
            //删除药品表
            $follow_up_drugs = new Tfollow_up_drugs();
            $follow_up_drugs->whereAdd("follow_uuid='$uuid'");
            $follow_up_drugs->whereAdd("id='" . $hypertension_follow_up->id . "'");
            $follow_up_drugs->whereAdd("call_module='hypertension'");
            if (!$follow_up_drugs->delete($this->user['uuid']))
            {
                $error_code = "cd007";
            }
            //删除症状表
            $hypertension_symptom = new Thypertension_symptom();
            $hypertension_symptom->whereAdd("follow_up_uuid='$uuid'");
            $hypertension_symptom->whereAdd("id='" . $hypertension_follow_up->id . "'");
            if (!$hypertension_symptom->delete($this->user['uuid']))
            {
                $error_code .= "|cd008";
            }
            //删除主表
            $hypertension_follow_up = new Thypertension_follow_up();
            $hypertension_follow_up->whereAdd("uuid='$uuid'");
            if ($hypertension_follow_up->delete($this->user['uuid']))
            {
                $url = array(
                    "随访记录列表" => __BASEPATH . 'cd/index/index',
                    "用户列表" => __BASEPATH . 'iha/index/index',
                    "新增随访" => __BASEPATH . 'iha/index/add');
                message("删除高血压随访记录成功，返回代码：" . $error_code, $url);
            }
            else
            {
                //错误
                $url = array(
                    "随访记录列表" => __BASEPATH . 'cd/index/index',
                    "用户列表" => __BASEPATH . 'iha/index/index',
                    "新增随访" => __BASEPATH . 'iha/index/add');
                message("删除高血压随访记录失败，代码：cd009", $url);
            }
        }
        else
        {
            //错误
            $url = array(
                "随访记录列表" => __BASEPATH . 'cd/index/index',
                "用户列表" => __BASEPATH . 'iha/index/index',
                "新增随访" => __BASEPATH . 'iha/index/add');
            message("删除高血压随访记录失败，代码：cd005", $url);
        }
    }
    /**
     * 列表每一个人的随访记录
     */
    public function listAction()
    {
        $userid = $this->_request->getParam('id');
        if ($userid)
        {
            //获取个人信息
            $individual_inf = get_individual_info($userid); //取得个人信息中所有信息
            if ($this->haveWritePrivilege)
            {
                $this->view->user_name = $individual_inf->name; //居民姓名
                $this->view->standard_code = $individual_inf->standard_code_1; //标准档案号
                $this->view->identity_number=$individual_inf->identity_number; //身份证号码
            }
            else
            {
                $this->view->user_name = "*"; //居民姓名
                $this->view->standard_code = "*"; //标准档案号
                $this->view->identity_number="*"; //身份证号码
            }
            //取性别
            $individual_core = new Tindividual_core();
            $individual_core->whereAdd("uuid='" . $userid . "'");
            $individual_core->find(true);
            $this->view->sex_code = $individual_core->sex;
            require_once __SITEROOT . '/library/data_arr/arrdata.php';
            $this->view->assign("symptom_code", $symptom_code);
            $this->view->assign("follow_type", $follow_type);
            $this->view->assign("psychology", $psychology);
            $this->view->assign("pregnancy_array", $pregnancy);
            $this->view->assign("treatment_compliance", $treatment_compliance);
            $this->view->assign("medication_compliance", $medication_compliance);
            $this->view->assign("adverse_drug", $adverse_drug);
            $this->view->assign("follow_up_result", $follow_up_result);
            $hypertension_follow_up = new Thypertension_follow_up();
            $hypertension_follow_up->whereAdd("id='$userid'");
            $nums = $hypertension_follow_up->count(); //用于数组循环次数
            $hypertension_follow_up->orderby("follow_time DESC,created DESC");
            $hypertension_follow_up->find();
            $hypertension_array = array();
            $i = 0;
            while ($hypertension_follow_up->fetch())
            {
                $hypertension_array[$i]['follow_time'] = $hypertension_follow_up->follow_time ?
                    adodb_date("Y年m月d日", $hypertension_follow_up->follow_time) : "";
                $hypertension_array[$i]['uuid'] = $hypertension_follow_up->uuid;
                $hypertension_array[$i]['staff_id'] = $hypertension_follow_up->staff_id;
                $hypertension_array[$i]['staff_name'] = get_staff_name_byid($hypertension_follow_up->
                    staff_id);
                $hypertension_array[$i]['id'] = $hypertension_follow_up->id;
                $hypertension_array[$i]['created'] = $hypertension_follow_up->created;
                $hypertension_array[$i]['follow_next_time'] = $hypertension_follow_up->
                    follow_next_time ? adodb_date("Y年m月d日", $hypertension_follow_up->
                    follow_next_time) : "";
                $hypertension_array[$i]['symptom_code'] = get_follow_symptom_code($hypertension_follow_up->
                    uuid); //获取症状信息
                $hypertension_array[$i]['symptom_other'] = $hypertension_follow_up->
                    symptom_other;
                $hypertension_array[$i]['pregnancy'] = array_search_for_other($hypertension_follow_up->
                    pregnancy, $pregnancy); //是否妊娠期或哺乳期
                $hypertension_array[$i]['follow_type'] = array_search_for_other($hypertension_follow_up->
                    follow_type, $follow_type);
                $hypertension_array[$i]['blood_pressure'] = $hypertension_follow_up->
                    blood_pressure;
                $hypertension_array[$i]['diastolic_blood_pressure'] = $hypertension_follow_up->
                    diastolic_blood_pressure;
                $hypertension_array[$i]['blood_difference'] = $hypertension_follow_up->
                    blood_difference;
                $hypertension_array[$i]['height'] = $hypertension_follow_up->height;
                $hypertension_array[$i]['weight_begin'] = $hypertension_follow_up->weight_begin;
                $hypertension_array[$i]['weight_after'] = $hypertension_follow_up->weight_after;
                $hypertension_array[$i]['pregnancy'] = array_search_for_other($hypertension_follow_up->
                    pregnancy, $pregnancy);
                $hypertension_array[$i]['body_mass_index'] = $hypertension_follow_up->
                    body_mass_index;
                $hypertension_array[$i]['heart_rate_begin'] = $hypertension_follow_up->
                    heart_rate_begin;
                $hypertension_array[$i]['heart_rate_after'] = $hypertension_follow_up->
                    heart_rate_after;
                $hypertension_array[$i]['signs_other'] = $hypertension_follow_up->signs_other;
                $hypertension_array[$i]['smoking_begin'] = $hypertension_follow_up->
                    smoking_begin;
                $hypertension_array[$i]['smoking_after'] = $hypertension_follow_up->
                    smoking_after;
                $hypertension_array[$i]['drinking_begin'] = $hypertension_follow_up->
                    drinking_begin;
                $hypertension_array[$i]['drinking_after'] = $hypertension_follow_up->
                    drinking_after;
                $hypertension_array[$i]['sport_amount_begin'] = $hypertension_follow_up->
                    sport_amount_begin;
                $hypertension_array[$i]['sport_amount_after'] = $hypertension_follow_up->
                    sport_amount_after;
                $hypertension_array[$i]['sport_time_begin'] = $hypertension_follow_up->
                    sport_time_begin;
                $hypertension_array[$i]['sport_time_after'] = $hypertension_follow_up->
                    sport_time_after;
                $hypertension_array[$i]['salt_intake_begin'] = $hypertension_follow_up->
                    salt_intake_begin;
                $hypertension_array[$i]['salt_intake_after'] = $hypertension_follow_up->
                    salt_intake_after;
                $hypertension_array[$i]['psychology'] = array_search_for_other($hypertension_follow_up->
                    psychology, $psychology);
                $hypertension_array[$i]['treatment_compliance'] = array_search_for_other($hypertension_follow_up->
                    treatment_compliance, $treatment_compliance);
                $hypertension_array[$i]['auxiliary_check'] = $hypertension_follow_up->
                    auxiliary_check;
                $hypertension_array[$i]['medication_compliance'] = array_search_for_other($hypertension_follow_up->
                    medication_compliance, $medication_compliance);
                $hypertension_array[$i]['adverse_drug'] = array_search_for_other($hypertension_follow_up->
                    adverse_drug, $adverse_drug);
                $hypertension_array[$i]['adverse_drug_info'] = $hypertension_follow_up->
                    adverse_drug_info;
                $hypertension_array[$i]['follow_up_result'] = array_search_for_other($hypertension_follow_up->
                    follow_up_result, $follow_up_result);
                $hypertension_array[$i]['referral_reason'] = $hypertension_follow_up->
                    referral_reason;
                $hypertension_array[$i]['organization'] = $hypertension_follow_up->organization;
                $hypertension_array[$i]['follow_result'] = $hypertension_follow_up->
                    follow_result;
                $hypertension_array[$i]['drug'] = get_follow_drug($hypertension_follow_up->uuid); //获取药品信息
                $i++;
            }
            $this->view->hypertension_array = $hypertension_array;
            $this->view->nums = $nums;
            $this->view->userid=$userid;
            $this->view->display('cd_table.html');
        }
        else
        {
            $url = array("随访记录列表" => __BASEPATH . 'cd/index/index', "用户列表" => __BASEPATH .
                    'iha/index/index');
            message("查看高血压随访记录详细信息失败，代码：cd003", $url);
        }
    }
    /**
     * 打印高血压信息
     */
    public function printAction()
    {
    	//获取UUID
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        $this->view->assign("symptom_code_array", $symptom_code);
        $this->view->assign("follow_type_array", $follow_type);
        $this->view->assign("psychology_array", $psychology);
        $this->view->assign("pregnancy_array", $pregnancy);
        $this->view->assign("treatment_compliance_array", $treatment_compliance);
        $this->view->assign("medication_compliance_array", $medication_compliance);
        $this->view->assign("adverse_drug_array", $adverse_drug);
        $this->view->assign("follow_up_result_array", $follow_up_result);
        $this->view->assign("adverse_drug_json_array", json_encode($adverse_drug)); //因为JS文件中使用
        $uuid = $this->_request->getParam('uuid');
        
        if($uuid)
        {
        	//展现编辑框
            $hypertension_follow_up = new Thypertension_follow_up();
            $hypertension_follow_up->whereAdd("uuid='$uuid'");
            $hypertension_follow_up->find(true);
            $this->view->uuid = $hypertension_follow_up->uuid; //编号
            $this->view->staff_id = $hypertension_follow_up->staff_id; //医生档案号
            $this->view->person_uuid = $hypertension_follow_up->id; //个人档案号
            //取性别
            $individual_core = new Tindividual_core();
            $individual_core->whereAdd("uuid='" . $hypertension_follow_up->id . "'");
            $individual_core->find(true);
            $this->view->sex_code = $individual_core->sex;
            $this->view->follow_time=adodb_date("Y年m月d日",$hypertension_follow_up->follow_time);//随访日期
            $this->view->follow_next_time = $hypertension_follow_up->follow_next_time ?
                adodb_date("Y年m月d日", $hypertension_follow_up->follow_next_time) : ""; //下次随访日期
            $this->view->follow_type = array_search_for_other($hypertension_follow_up->
                follow_type, $follow_type); //随访方式
            $this->view->blood_pressure = $hypertension_follow_up->blood_pressure; //血压
            $this->view->diastolic_blood_pressure = $hypertension_follow_up->
                diastolic_blood_pressure; //舒张压
            $this->view->blood_difference = $hypertension_follow_up->blood_difference; //双侧血压差
            $this->view->height = $hypertension_follow_up->height; //身高
            $this->view->weight_begin = $hypertension_follow_up->weight_begin; //体重
            $this->view->pregnancy = array_search_for_other($hypertension_follow_up->
                pregnancy, $pregnancy); //是否妊娠期或哺乳期
            $this->view->weight_after = $hypertension_follow_up->weight_after; //预期体重
            $this->view->body_mass_index = $hypertension_follow_up->body_mass_index; //体质指数
            $this->view->heart_rate_begin = $hypertension_follow_up->heart_rate_begin; //心率
            $this->view->heart_rate_after = $hypertension_follow_up->heart_rate_after; //期望心率
            $this->view->signs_other = $hypertension_follow_up->signs_other; //体征其他
            $this->view->smoking_begin = $hypertension_follow_up->smoking_begin; //日吸烟量
            $this->view->smoking_after = $hypertension_follow_up->smoking_after; //期望日吸烟量
            $this->view->drinking_begin = $hypertension_follow_up->drinking_begin; //日饮酒量
            $this->view->drinking_after = $hypertension_follow_up->drinking_after; //期望日饮酒量
            $this->view->sport_amount_begin = $hypertension_follow_up->sport_amount_begin; //运动次数（次/周）
            $this->view->sport_amount_after = $hypertension_follow_up->sport_amount_after; //期望运动次数（次/周）
            $this->view->sport_time_begin = $hypertension_follow_up->sport_time_begin; //运动频率（分钟/次）
            $this->view->sport_time_after = $hypertension_follow_up->sport_time_after; //期望运动频率（分钟/次）
            $this->view->salt_intake_begin = $hypertension_follow_up->salt_intake_begin; //摄盐情况（克/天）
            $this->view->salt_intake_after = $hypertension_follow_up->salt_intake_after; //期望摄盐情况（克/天）
            $this->view->psychology = array_search_for_other($hypertension_follow_up->
                psychology, $psychology); //心理调整
            $this->view->treatment_compliance = array_search_for_other($hypertension_follow_up->
                treatment_compliance, $treatment_compliance); //遵医行为
            $this->view->auxiliary_check = $hypertension_follow_up->auxiliary_check; //辅助检查
            $this->view->medication_compliance = array_search_for_other($hypertension_follow_up->
                medication_compliance, $medication_compliance); //服药依从性
            $this->view->adverse_drug = array_search_for_other($hypertension_follow_up->
                adverse_drug, $adverse_drug); //药物不良反应
            $this->view->adverse_drug_info = $hypertension_follow_up->adverse_drug_info; //药物不良反应详细说明
            $this->view->follow_up_result = array_search_for_other($hypertension_follow_up->
                follow_up_result, $follow_up_result); //此次随访分类
            $this->view->referral_reason = $hypertension_follow_up->referral_reason; //转诊原因
            $this->view->organization = $hypertension_follow_up->organization; //机构及科别
            $this->view->symptom_other = $hypertension_follow_up->symptom_other; //症状内容
            $this->view->follow_result = $hypertension_follow_up->follow_result; //症状内容
            //个人信息
            $individual_inf = get_individual_info($hypertension_follow_up->id); //取得个人信息中所有信息
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
            //取慢病状态
            $cd_status = get_status_cd($hypertension_follow_up->id);
            if ($cd_status)
            {
                $this->view->sign_hypertension = $cd_status->disease_state;
            }
            //读症状表
            $this->view->symptom_code = get_follow_symptom_code($hypertension_follow_up->
                uuid); //获取症状信息
            //读药品表
            $this->view->drug = get_follow_drug($hypertension_follow_up->uuid); //获取药品信息
            //医生列表
            $this->view->response_doctor = get_doctor_list($this->user['current_region_path_domain'],
                $hypertension_follow_up->staff_id);
            //权限
            if ($this->haveWritePrivilege)
            {
                $this->view->ajax_save_disabled = "";
            }
            else
            {
                $this->view->ajax_save_disabled = "disabled";
            }
//            取今天内的血压值
//            $person_uuid = isset($individual_session->uuid) ? $individual_session->uuid : $hypertension_follow_up->
//                id;
//            require_once __SITEROOT . "library/Models/physical_base.php"; //取血压结果
//            $today = mktime(0, 0, 0, adodb_date("m", time()), adodb_date("j", time()),
//                adodb_date("Y", time()));
//            $physical_base = new Tphysical_base();
//            $physical_base->whereAdd("id='$person_uuid'");
//            $physical_base->whereAdd("created>='$today'");
//            $physical_base->find();
//            $blood_today = array();
//            $i = 0;
//            while ($physical_base->fetch())
//            {
//                $blood_today[$i]['s_blood_pressure'] = $physical_base->s_blood_pressure;
//                $blood_today[$i]['p_blood_pressure'] = $physical_base->p_blood_pressure;
//                $i++;
//            }
//            $this->view->blood_today = $blood_today;
            $this->view->display('cd_print.html');
        }
        else 
        {
        	//错误
            $url = array(
                "随访记录列表" => __BASEPATH . 'cd/index/index',
                "用户列表" => __BASEPATH . 'iha/index/index',
                "新增随访" => __BASEPATH . 'iha/index/add');
            message("编辑高血压随访记录失败，代码：cd004", $url);
        }   
    }

    /**
     * 添加或者编辑保存数据
     */
    public function editinAction()
    {
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php';
        require_once __SITEROOT . '/library/data_arr/arrdata.php'; //数据字典
        //获取机构ID
        $org_id = $this->user['org_id'];

        $time = time();
        //个人session
        $individual_session = new Zend_Session_Namespace("individual_core");

        $person_uuid = $this->_request->getParam('person_uuid') ? $this->_request->
            getParam('person_uuid') : $individual_session->uuid; //个人档案号
        $uuid = $this->_request->getParam('uuid') ? $this->_request->getParam('uuid') :
            uniqid("H_", true);
        $hypertension_follow_up = new Thypertension_follow_up();
        //如果用户为选择随访医生，则默认当前填表医生
        if ($this->_request->getParam('staff_id') == "" || $this->_request->getParam('staff_id') ==
            "-9")
        {
            $staff_id = $this->user['uuid']; //医生档案号
        }
        else
        {
            //获取医生ID
            $staff_id = $this->_request->getParam('staff_id');
        }
        $hypertension_follow_up->staff_id = $staff_id; //医生档案号
        $hypertension_follow_up->id = $person_uuid;

        $follow_time_year = intval($this->_request->getParam('follow_time_year'));
        $follow_time_month = intval($this->_request->getParam('follow_time_month'));
        $follow_time_day = intval($this->_request->getParam('follow_time_day'));
        $hypertension_follow_up->follow_time = $follow_time_year ? mkunixstamp($follow_time_year .
            "-" . $follow_time_month . "-" . $follow_time_day) : ""; //随访日期

        $hypertension_follow_up->follow_next_time = $this->_request->getParam('follow_next_time') ?
            mkunixstamp($this->_request->getParam('follow_next_time')) : ""; //下次随访日期
        $tips_time = $hypertension_follow_up->follow_next_time;

        $hypertension_follow_up->follow_type = array_code_change($this->_request->
            getParam('follow_type'), $follow_type); //随访方式

        $hypertension_follow_up->symptom_other = $this->_request->getParam('symptom_other'); //症状内容

        $hypertension_follow_up->pregnancy = $this->_request->getParam('pregnancy'); //是否妊娠期或哺乳期
        
        //2012-11-28强制将血压值进行浮点数转换

        $hypertension_follow_up->blood_pressure = floatval($this->_request->getParam('blood_pressure')); //血压
        

        $hypertension_follow_up->diastolic_blood_pressure = floatval($this->_request->getParam('diastolic_blood_pressure')); //舒张压

        $hypertension_follow_up->height = $this->_request->getParam('height'); //身高

        $hypertension_follow_up->weight_begin = $this->_request->getParam('weight_begin'); //体重

        $hypertension_follow_up->weight_after = $this->_request->getParam('weight_after'); //预期体重

        $hypertension_follow_up->body_mass_index = $this->_request->getParam('body_mass_index'); //体质指数

        $hypertension_follow_up->heart_rate_begin = $this->_request->getParam('heart_rate_begin'); //心率

        $hypertension_follow_up->heart_rate_after = $this->_request->getParam('heart_rate_after'); //期望心率

        $hypertension_follow_up->signs_other = $this->_request->getParam('signs_other'); //体征其他

        $hypertension_follow_up->smoking_begin = $this->_request->getParam('smoking_begin'); //日吸烟量

        $hypertension_follow_up->smoking_after = $this->_request->getParam('smoking_after'); //期望日吸烟量

        $hypertension_follow_up->drinking_begin = $this->_request->getParam('drinking_begin'); //日饮酒量

        $hypertension_follow_up->drinking_after = $this->_request->getParam('drinking_after'); //期望日饮酒量

        $hypertension_follow_up->sport_amount_begin = $this->_request->getParam('sport_amount_begin'); //运动次数（次/周）

        $hypertension_follow_up->sport_amount_after = $this->_request->getParam('sport_amount_after'); //期望运动次数（次/周）

        $hypertension_follow_up->sport_time_begin = $this->_request->getParam('sport_time_begin'); //运动频率（分钟/次）

        $hypertension_follow_up->sport_time_after = $this->_request->getParam('sport_time_after'); //期望运动频率（分钟/次）

        $hypertension_follow_up->salt_intake_begin = $this->_request->getParam('salt_intake_begin'); //摄盐情况（克/天）

        $hypertension_follow_up->salt_intake_after = $this->_request->getParam('salt_intake_after'); //期望摄盐情况（克/天）

        $hypertension_follow_up->psychology = array_code_change($this->_request->
            getParam('psychology'), $psychology); //心理调整

        $hypertension_follow_up->treatment_compliance = array_code_change($this->
            _request->getParam('treatment_compliance'), $treatment_compliance); //遵医行为

        $hypertension_follow_up->auxiliary_check = $this->_request->getParam('auxiliary_check'); //辅助检查

        $hypertension_follow_up->medication_compliance = array_code_change($this->
            _request->getParam('medication_compliance'), $medication_compliance); //服药依从性

        $hypertension_follow_up->adverse_drug = array_code_change($this->_request->
            getParam('adverse_drug'), $adverse_drug); //药物不良反应

        $hypertension_follow_up->adverse_drug_info = $this->_request->getParam('adverse_drug_info'); //药物不良反应详细说明

        $hypertension_follow_up->follow_up_result = array_code_change($this->_request->
            getParam('follow_up_result'), $follow_up_result); //此次随访分类

        $hypertension_follow_up->referral_reason = $this->_request->getParam('referral_reason'); //转诊原因

        $hypertension_follow_up->organization = $this->_request->getParam('organization'); //机构及科别

        $hypertension_follow_up->follow_result = $this->_request->getParam('follow_result'); //机构及科别

        $hypertension_follow_up->blood_difference = $this->_request->getParam('blood_difference'); //双侧血压差
        $ph_uuid = $this->_request->getParam('ph_uuid') ? $this->_request->getParam('ph_uuid') :
            uniqid("p_"); //基本检查表的uuid
        if (!$this->_request->getParam('uuid'))
        {
            if (!$this->haveWritePrivilege)
            {
                $url = array("随访记录列表" => __BASEPATH . 'cd/index/index', "用户列表" => __BASEPATH .
                        'iha/index/index');
                message("对不起，你可能没有权限添加高血压随访信息，代码：cd012", $url);
            }
            //添加
            $hypertension_follow_up->org_id = $org_id;
            $hypertension_follow_up->created = $time; //添加记录时间
            $hypertension_follow_up->uuid = $uuid; //随访编号
            if ($hypertension_follow_up->insert($this->user['uuid']))
            {
                //添加处理药品
                $drug_name_array = $this->_request->getParam('drug_name');
                $drug_amount_array = $this->_request->getParam('drug_amount'); //药物用量（mg）
                $drug_frequency_array = $this->_request->getParam('drug_frequency'); //药物用法（次）
                if (is_array($drug_name_array) && !empty($drug_name_array))
                {
                    foreach ($drug_name_array as $k => $v)
                    {
                        $follow_up_drugs = new Tfollow_up_drugs();
                        $follow_up_drugs->uuid = uniqid("D_", true); //
                        $follow_up_drugs->staff_id = $staff_id; //医生档案号
                        $follow_up_drugs->id = $person_uuid; //个人档案号
                        $follow_up_drugs->created = $time; //添加记录时间
                        $follow_up_drugs->drug_name = $v; //药物名称
                        $follow_up_drugs->drug_amount = $drug_amount_array[$k];
                        $follow_up_drugs->drug_frequency = $drug_frequency_array[$k];
                        $follow_up_drugs->follow_uuid = $uuid; //随访主表ID
                        $follow_up_drugs->call_module = "hypertension"; //调用模块
                        $follow_up_drugs->org_id = $org_id;
                        //药品名不为空的时候才保存数据
                        if ($v != "")
                        {
                            $follow_up_drugs->insert($this->user['uuid']);
                        }
                    }
                }
                //处理症状表
                $symptom_code_array = array();
                $symptom_code_array = $this->_request->getParam('symptom_code');
                if (is_array($symptom_code_array) && !empty($symptom_code_array))
                {
                    foreach ($symptom_code_array as $k => $v)
                    {
                        $hypertension_symptom = new Thypertension_symptom();
                        $hypertension_symptom->uuid = uniqid("H_", true); //
                        $hypertension_symptom->staff_id = $staff_id; //医生档案号
                        $hypertension_symptom->id = $person_uuid; //个人档案号
                        $hypertension_symptom->created = $time; //添加记录时间
                        $hypertension_symptom->symptom_code = array_code_change($v, $symptom_code); //症状代码
                        $hypertension_symptom->follow_up_uuid = $uuid; //随访主表ID
                        $hypertension_symptom->org_id = $org_id;
                        if ($v != "")
                        {
                            $hypertension_symptom->insert($this->user['uuid']);
                        }
                    }
                }
                //处理基本检查
                insert_physical_base($ph_uuid, $staff_id, $person_uuid, "高血压随访", $uuid,
                    __BASEPATH . 'cd/index/edit/uuid/' . $uuid, $this->_request->getParam('height'),
                    $this->_request->getParam('weight_begin'), $this->_request->getParam('body_mass_index'),
                    floatval($this->_request->getParam('blood_pressure')), floatval($this->_request->getParam('diastolic_blood_pressure')),
                    time());
                $refer = $this->_request->getParam('refer', ""); //处理跳转
                $refer_array = $refer != "" ? explode("|", $refer) : array("");
                $new_refer = create_refer($refer);
                if ($new_refer)
                {
                    $new_refer = $refer_array[0] ? __BASEPATH . $refer_array[0] . "/refer/" . $new_refer :
                        "";
                }
                else
                {
                    $new_refer = $refer_array[0] ? __BASEPATH . $refer_array[0] : "";
                }
                //处理每日提醒
                $tips_error = create_tips($staff_id, $person_uuid, $this->user['current_region_path'],
                    ($tips_time ? date("Y-m-d", $tips_time) : "") . "高血压随访计划", "高血压随访", $tips_time,
                    __BASEPATH . "cd/index/edit/uuid/" . $uuid, $tips_info = "本次随访结果：" . $hypertension_follow_up->
                    follow_result,$hypertension_follow_up->follow_time);
                if ($tips_error === "error_01")
                {
                    $tips_error = ",<font color='red'>工作计划添加失败，无法找到对应的计划类型，请省系统管理员添加【高血压随访】的计划类型</font>";
                }
                else
                {
                    $tips_error = ",对应的工作计划已经自动添加";
                }
                //添加结果提示
                $url = array(
                    "继续添加" => __BASEPATH . 'cd/index/add',
                    "用户列表" => __BASEPATH . 'iha/index/index',
                    "随访记录列表" => __BASEPATH . 'cd/index/index');
                message("添加【" . $individual_session->name . "】的高血压随访记录成功" . $tips_error, $url, $new_refer);
            }
            else
            {
                $url = array(
                    "重新添加" => __BASEPATH . 'cd/index/add',
                    "用户列表" => __BASEPATH . 'iha/index/index',
                    "随访记录列表" => __BASEPATH . 'cd/index/index');
                message("添加【" . $individual_session->name . "】的高血压随访记录失败，代码：cd001", $url);
            }
        }
        else
        {
            if (!$this->haveWritePrivilege)
            {
                $url = array("随访记录列表" => __BASEPATH . 'cd/index/index', "用户列表" => __BASEPATH .
                        'iha/index/index');
                message("对不起，你可能没有权限添加高血压随访信息，代码：cd011", $url);
            }
            //编辑
            $uuid = $this->_request->getParam('uuid');
            $hypertension_follow_up->whereAdd("uuid='$uuid'");
            if ($hypertension_follow_up->update(array($this->user['uuid'], 'updated')))
            {
                //编辑处理药品
                $drug_uuid_array = $this->_request->getParam('drug_uuid');
                $drug_name_array = $this->_request->getParam('drug_name');
                $drug_amount_array = $this->_request->getParam('drug_amount'); //药物用量（mg）
                $drug_frequency_array = $this->_request->getParam('drug_frequency'); //药物用法（次）
                if (is_array($drug_uuid_array) && !empty($drug_uuid_array))
                {
                    foreach ($drug_uuid_array as $k => $v)
                    {
                        $follow_up_drugs = new Tfollow_up_drugs();
                        $follow_up_drugs->staff_id = $staff_id; //医生档案号
                        $follow_up_drugs->drug_name = $drug_name_array[$k]; //药物名称
                        $follow_up_drugs->drug_amount = $drug_amount_array[$k];
                        $follow_up_drugs->drug_frequency = $drug_frequency_array[$k];
                        //药品名不为空的时候才保存数据
                        if ($v != "")
                        {
                            //如果有UUID则编辑
                            if ($drug_name_array[$k] != "")
                            {
                                //当药品名不为空时则编辑
                                $follow_up_drugs->whereAdd("uuid='$v'");
                                $follow_up_drugs->update(array($this->user['uuid'], 'updated'));
                            }
                            else
                            {
                                //当药品名为空时，删除该条记录
                                $follow_up_drugs->whereAdd("uuid='$v'");
                                $follow_up_drugs->delete($this->user['uuid']);
                            }
                        }
                        else
                        {
                            //如果没有UUID则增加
                            $follow_up_drugs = new Tfollow_up_drugs();
                            $follow_up_drugs->uuid = uniqid("D_", true); //
                            $follow_up_drugs->staff_id = $staff_id; //医生档案号
                            $follow_up_drugs->id = $person_uuid; //个人档案号
                            $follow_up_drugs->created = $time; //添加记录时间
                            $follow_up_drugs->drug_name = $drug_name_array[$k]; //药物名称
                            $follow_up_drugs->drug_amount = $drug_amount_array[$k];
                            $follow_up_drugs->drug_frequency = $drug_frequency_array[$k];
                            $follow_up_drugs->follow_uuid = $uuid; //随访主表ID
                            $follow_up_drugs->call_module = "hypertension"; //调用模块
                            if ($drug_name_array[$k] != "")
                            {
                                $follow_up_drugs->insert($this->user['uuid']);
                            }
                        }
                    }
                }
                //编辑处理症状表
                $symptom_code_array = array();
                $symptom_code_array = $this->_request->getParam('symptom_code');
                if (is_array($symptom_code_array) && !empty($symptom_code_array))
                {
                    foreach ($symptom_code_array as $k => $v)
                    {
                        $hypertension_symptom = new Thypertension_symptom();
                        $hypertension_symptom->uuid = uniqid("H_", true); //
                        $hypertension_symptom->staff_id = $staff_id; //医生档案号
                        $hypertension_symptom->id = $person_uuid; //个人档案号
                        $hypertension_symptom->created = $time; //添加记录时间
                        $hypertension_symptom->symptom_code = array_code_change($v, $symptom_code); //症状代码
                        $hypertension_symptom->follow_up_uuid = $uuid; //随访主表ID
                        if ($v != "")
                        {
                            $hypertension_symptom->insert($this->user['uuid']);
                        }
                    }
                    //清空之前的症状列表
                    $hypertension_symptom = new Thypertension_symptom();
                    $hypertension_symptom->whereAdd("follow_up_uuid='$uuid'");
                    $hypertension_symptom->whereAdd("created!='$time'");
                    $hypertension_symptom->whereAdd("id='$person_uuid'");
                    $hypertension_symptom->delete($this->user['uuid']);
                }
                //处理每日提醒
                $tips_time = $hypertension_follow_up->follow_next_time;
                $tips_follow_time=$hypertension_follow_up->follow_time;//随访时间
                $tips_error = create_tips($staff_id, $person_uuid, $this->user['current_region_path'],
                    ($tips_time ? date("Y-m-d", $tips_time) : "") . "高血压随访计划", "高血压随访", $tips_time,
                    __BASEPATH . "cd/index/edit/uuid/" . $uuid, $tips_info = "本次随访结果：" . $hypertension_follow_up->
                    follow_result,$tips_follow_time);
                if ($tips_error === "error_01")
                {
                    $tips_error = ",<font color='red'>工作计划添加失败，无法找到对应的计划类型，请省系统管理员添加【高血压随访】的计划类型</font>";
                }
                else
                {
                    $tips_error = ",对应的工作计划已经自动添加";
                }
                $url = array(
                    "查看【" . $individual_session->name . "】的随访记录" => __BASEPATH . 'cd/index/list/id/' .
                        $person_uuid,
                    "用户列表" => __BASEPATH . 'iha/index/index',
                    "随访记录列表" => __BASEPATH . 'cd/index/index');
                message("编辑【" . $individual_session->name . "】的高血压随访记录成功" . $tips_error, $url);
            }
            else
            {
                $url = array(
                    "重新编辑" => __BASEPATH . 'cd/index/add/uuid/' . $uuid,
                    "查看【" . $individual_session->name . "】的随访记录" => __BASEPATH . 'cd/index/list',
                    "用户列表" => __BASEPATH . 'iha/index/index',
                    "随访记录列表" => __BASEPATH . 'cd/index/index');
                message("编辑【" . $individual_session->name . "】的高血压随访记录失败，代码：cd002", $url);
            }
        }
    }
    //根据条件判定逻辑条件
    public function calAction()
    {
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php';
        require_once __SITEROOT . '/library/data_arr/arrdata.php'; //数据字典
        require_once __SITEROOT . "library/Models/physical_base.php"; //取血压结果
        //获取机构ID
        $org_id = $this->user['org_id'];
        $uuid=$this->_request->getParam('uuid');
        if($uuid)
        {
            $hypertension_follow_up=new Thypertension_follow_up();
            $hypertension_follow_up->whereAdd("uuid='$uuid'");
            $hypertension_follow_up->find(true);
            $time=$hypertension_follow_up->follow_time?$hypertension_follow_up->follow_time:$hypertension_follow_up->updated;
        }
        else
        {
            $time = time();
        }
        //个人session
        $individual_session = new Zend_Session_Namespace("individual_core");

        $person_uuid = $this->_request->getParam('person_uuid') ? $this->_request->
            getParam('person_uuid') : $individual_session->uuid; //个人档案号
        if ($person_uuid)
        {
            //需要处理的条件：年龄、性别、收缩压、舒张压、连续两次收缩压舒张压异常与否、
            //4天内有无血压监测结果、是否高血压患者、是否有症状、是否有药物不良反应、是否妊娠期或哺乳期

            //1、取年龄、性别
            $individual_core = new Tindividual_core();
            $individual_core->whereAdd("uuid='$person_uuid'");
            $individual_core->find(true);
            $age = getBirthday($individual_core->date_of_birth, $time);
            $sex_code = $individual_core->sex;
            //2、收缩压、舒张压
            $blood_pressure = intval($this->_request->getParam('blood_pressure')); //血压
            $diastolic_blood_pressure = intval($this->_request->getParam('diastolic_blood_pressure')); //舒张压
            $blood_abs = floatval($this->_request->getParam('blood_difference')); //双侧血压相差值
            //3、之前三天内连续两次收缩压舒张压异常与否
            $three_day_ago = mktime(0, 0, 0, adodb_date("m", $time), adodb_date("j", $time) -
                3, adodb_date("Y", $time));
            $physical_base = new Tphysical_base();
            $physical_base->whereAdd("s_blood_pressure>='140' or p_blood_pressure>='90'");
            $physical_base->whereAdd("id='$person_uuid'");
            $physical_base->whereAdd("created>='$three_day_ago'");
            $sign_three_days = $physical_base->count();
            //4、4天内有无血压监测结果
            $four_day_ago = mktime(0, 0, 0, adodb_date("m", $time), adodb_date("j", $time) -
                4, adodb_date("Y", $time));
            $physical_base = new Tphysical_base();
            $physical_base->whereAdd("id='$person_uuid'");
            $physical_base->whereAdd("created>='$four_day_ago'");
            $sign_four_days = $physical_base->count();
            //5、是否高血压患者
            $cd_status = get_status_cd($person_uuid);
            $sign_hypertension = ($cd_status->disease_state == 1) ? $cd_status->
                disease_state : 0;
            //6、是否有症状
            $symptom_code_sign = 0;
            $symptom_code_array = array();
            $symptom_code_array = $this->_request->getParam('symptom_code');
            foreach ($symptom_code_array as $k => $v)
            {
                if ($v != "" && @array_code_change($v, $symptom_code) != "1")
                {
                    $symptom_code_sign = 1;
                }
            }
            //7、是否有药物不良反应
            $adverse_drug_status = 0;
            $adverse_drugs = $this->_request->getParam('adverse_drug') != "" ?
                array_code_change($this->_request->getParam('adverse_drug'), $adverse_drug) : "";
            if ($adverse_drugs == '2')
            {
                $adverse_drug_status = 1;
            }
            //8、是否妊娠期或哺乳期
            $pregnancy_status = 0;
            $pregnancys = $this->_request->getParam('pregnancy') != "" ? array_code_change($this->
                _request->getParam('pregnancy'), $pregnancy) : "";
            if ($pregnancys == '2')
            {
                $pregnancy_status = 1;
            }
            //9、之前4天内收缩压小于140，舒张压小于90
            $sign_four_days_blood = 0;
            $four_day_ago = mktime(0, 0, 0, adodb_date("m", $time), adodb_date("j", $time) -
                4, adodb_date("Y", $time));
            $physical_base = new Tphysical_base();
            $physical_base->whereAdd("s_blood_pressure<'140' or p_blood_pressure<'90'");
            $physical_base->whereAdd("id='$person_uuid'");
            $physical_base->whereAdd("created>='$four_day_ago'");
            $sign_four_days_blood = $physical_base->count();
            //10、之前4天内收缩压大于等于140，舒张压大于等于90
            $sign_four_days_blood_two = 0;
            $physical_base = new Tphysical_base();
            $physical_base->whereAdd("s_blood_pressure>='140' or p_blood_pressure>='90'");
            $physical_base->whereAdd("id='$person_uuid'");
            $physical_base->whereAdd("created>='$four_day_ago'");
            $sign_four_days_blood_two = $physical_base->count();
            //根据条件走以下逻辑
            //逻辑1：
            $result = 0;
            if ($blood_abs >= 20 || $symptom_code_sign == 1 || ($blood_pressure >= 180 || $diastolic_blood_pressure >=
                110) || (($blood_pressure >= 140 || $diastolic_blood_pressure >= 90) && $pregnancy_status ==
                1))
            {
                $result = 1;
                echo $result.'|'.$time;
                exit;
            }
            //逻辑2
            if ($sign_hypertension == 0 && $symptom_code_sign == 0 && (($blood_pressure <
                180 && $blood_pressure >= 140) || ($diastolic_blood_pressure < 110 && $diastolic_blood_pressure >=
                90)) && ($sign_four_days == 0 || $sign_four_days_blood >= 0))
            {
                $result = 2;
                echo $result.'|'.$time;
                exit;
            }
            //逻辑3
            if ($sign_hypertension == 0 && $symptom_code_sign == 0 && (($blood_pressure <
                180 && $blood_pressure >= 140) || ($diastolic_blood_pressure < 110 && $diastolic_blood_pressure >=
                90)) && ($sign_four_days == 0 || $sign_four_days_blood_two >= 0))
            {
                $result = 3;
                echo $result.'|'.$time;
                exit;
            }
            //逻辑4
            if ($sign_hypertension == 0 && $symptom_code_sign == 0 && (($blood_pressure <
                130 && $blood_pressure >= 120) || ($diastolic_blood_pressure < 90 && $diastolic_blood_pressure >=
                80)) && (($sex_code == 3 || $age >= 65) || ($sex_code == 2 || $age >= 55)))
            {
                $result = 4;
                echo $result.'|'.$time;
                exit;
            }
            //逻辑5
            if ($sign_hypertension == 0 && $symptom_code_sign == 0 && (($blood_pressure <
                130 && $blood_pressure >= 120) || ($diastolic_blood_pressure < 90 && $diastolic_blood_pressure >=
                80)) && (($sex_code == 3 || $age < 65) || ($sex_code == 2 || $age < 55)))
            {
                $result = 5;
                echo $result.'|'.$time;
                exit;
            }
            //逻辑6
            if ($sign_hypertension == 0 && $symptom_code_sign == 0 && $blood_pressure < 120 &&
                $diastolic_blood_pressure < 80)
            {
                $result = 6;
                echo $result.'|'.$time;
                exit;
            }
            //逻辑7
            if ($sign_hypertension == 1 && $symptom_code_sign == 0 && $adverse_drug_status ==
                0 && $blood_pressure < 140 && $diastolic_blood_pressure < 90)
            {
                $result = 7;
                echo $result.'|'.$time;
                exit;
            }
            //逻辑8
            if ($sign_hypertension == 1 && $symptom_code_sign == 0 && $adverse_drug_status ==
                1 && $blood_pressure < 140 && $diastolic_blood_pressure < 90)
            {
                $result = 8;
                echo $result.'|'.$time;
                exit;
            }
            //逻辑9
            if ($sign_hypertension == 1 && $symptom_code_sign == 0 && $adverse_drug_status ==
                0 && ($blood_pressure >= 140 && $blood_pressure < 180) || ($diastolic_blood_pressure >=
                90 && $diastolic_blood_pressure < 110))
            {
                $result = 9;
                echo $result.'|'.$time;
                exit;
            }
            //逻辑10
            if ($sign_hypertension == 1 && $symptom_code_sign == 0 && $adverse_drug_status ==
                1 && ($blood_pressure >= 140 && $blood_pressure < 180) || ($diastolic_blood_pressure >=
                90 && $diastolic_blood_pressure < 110))
            {
                $result = 10;
                echo $result.'|'.$time;
                exit;
            }
            //逻辑11--无靶器官损害指标不做逻辑判定
            echo "nothing|".$time;
            exit;

        }
        else
        {
            echo "error|".$time;
        }
    }
}

?>