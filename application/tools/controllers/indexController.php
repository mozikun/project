<?php
/**
 * tools_indexController
 * 
 * 用于构造假数据，将构造假数据流程化
 * 
 * 构造流程：个人档案列表选待构造的人->
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class tools_indexController extends controller
{
    public function init()
    {
        $this->haveWritePrivilege = '';
        //权限验证
        require_once (__SITEROOT . 'library/privilege.php');
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/custom/comm_function.php';
        require_once __SITEROOT . "/library/custom/pager.php";
        require_once __SITEROOT . "library/Models/individual_core.php";
        $this->view->basePath = $this->_request->getBasePath();
    }
    /**
     * tools_indexController::jgdmAction()
     * 
     * 填写医疗结构代码
     * 
     * @return void
     */
    public function jgdmAction()
    {
        $this->view->display('yljgdm.html');
    }
    public function jgdmsaveAction()
    {
        $yljgdm=$this->_request->getParam('jgdm');
        $individual_session = new Zend_Session_Namespace("individual_core");
        $individual_session->jgdm=$yljgdm;
        message("已填写医疗机构代码", array("进入档案列表" => __BASEPATH . 'tools/index/index'));
    }
    /**
     * tools_indexController::indexAction()
     * 
     * 列表个人档案
     * 
     * @return void
     */
    public function indexAction()
    {
        //判定
        $individual_session = new Zend_Session_Namespace("individual_core");
        if (empty($individual_session->uuid) || empty($individual_session->staff_id))
        {
            message("请在个人档案列表双击选中待处理的居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
        if(!$individual_session->jgdm)
        {
            message("你没有填写要转换的机构代码", array("填写机构代码" => __BASEPATH . 'tools/index/jgdm'));
        }
        $this->view->assign("jgdm", $individual_session->jgdm);
        //取身份证号码
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("uuid='" . $individual_session->uuid . "'");
        $individual_core->find(true);
        require_once __SITEROOT . "library/Models/tb_yl_mz_medical_record.php";
        require_once __SITEROOT . "library/Models/tb_his_mz_fee_detail.php";
        require_once __SITEROOT . "library/Models/tb_his_patinf.php";
        //取有门诊处方和收费信息的数据列表供选择
        $tb_yl_mz_medical_record = new Ttb_yl_mz_medical_record(2);
        $tb_his_mz_fee_detail = new Ttb_his_mz_fee_detail(2);
        $tb_his_patinf = new Ttb_his_patinf(2);
        $tb_yl_mz_medical_record->joinAdd('inner',$tb_yl_mz_medical_record,$tb_his_mz_fee_detail,'kh','kh');
        $tb_yl_mz_medical_record->joinAdd('inner',$tb_yl_mz_medical_record,$tb_his_patinf,'kh','kh');
        $nums = $tb_yl_mz_medical_record->count();
        $pageCurrent = intval($this->_request->getParam('page'));
        $pageCurrent = $pageCurrent ? $pageCurrent : 1;
        //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,
            __BASEPATH . 'tools/index/index/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = __ROWSOFPAGE * ($pageCurrent - 1); //计算开始记录数
        $tb_yl_mz_medical_record->limit($startnum, __ROWSOFPAGE);
        $tb_yl_mz_medical_record->find();
        $data=array();
        $i=0;
        $xb=array(1=>'男',2=>'女');
        while($tb_yl_mz_medical_record->fetch())
        {
            $data[$i]['yljgdm']=$tb_yl_mz_medical_record->yljgdm;
            $data[$i]['jzlsh']=$tb_yl_mz_medical_record->jzlsh;
            $data[$i]['kh']=$tb_yl_mz_medical_record->kh;
            $data[$i]['klx']=$tb_yl_mz_medical_record->klx;
            $data[$i]['xm']=$tb_yl_mz_medical_record->hzxm;
            $data[$i]['xb']=$xb[$tb_his_patinf->xb];
            $data[$i]['mxxmmc']=$tb_his_mz_fee_detail->mxxmmc;
            $data[$i]['mxxmdw']=$tb_his_mz_fee_detail->mxxmdw;
            $i++;
        }
        $pager = $links->subPageCss2();
        $this->view->assign("data", $data);
        $this->view->assign("pager", $pager);
        $this->view->display('index.html');
    }
    /**
     * tools_indexController::step1Action()
     * 
     * 更新门诊情况相关表
     * 
     * @return void
     */
    public function step1Action()
    {
        //判定
        $individual_session = new Zend_Session_Namespace("individual_core");
        if (empty($individual_session->uuid) || empty($individual_session->staff_id))
        {
            message("请在个人档案列表双击选中待处理的居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
        if(!$individual_session->jgdm)
        {
            message("你没有填写要转换的机构代码", array("填写机构代码" => __BASEPATH . 'tools/index/jgdm'));
        }
        $this->view->assign("jgdm", $individual_session->jgdm);
        //取身份证号码
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("uuid='" . $individual_session->uuid . "'");
        $individual_core->find(true);
        $individual_core->free_statement();
        $identity_number = $individual_core->identity_number;
        $name=$individual_core->name;  
        $kh=$this->_request->getParam('kh');
        $jzlsh=$this->_request->getParam('jzlsh');
        if($kh && $jzlsh)
        {
            require_once __SITEROOT . "library/Models/tb_yl_mz_medical_record.php";
            require_once __SITEROOT . "library/Models/tb_his_mz_fee_detail.php";
            require_once __SITEROOT . "library/Models/tb_his_patinf.php";
            require_once __SITEROOT . "library/Models/tb_cis_prescription_detail.php";
            //处理门诊情况
            $tb_yl_mz_medical_record = new Ttb_yl_mz_medical_record(2);
            $tb_yl_mz_medical_record->kh=$identity_number;
            $tb_yl_mz_medical_record->klx=9;
            $tb_yl_mz_medical_record->hzxm=$name;
            $tb_yl_mz_medical_record->yljgdm=$individual_session->jgdm;
            $tb_yl_mz_medical_record->whereAdd("kh='$kh'");
            $tb_yl_mz_medical_record->update();
            $tb_yl_mz_medical_record->free_statement();
            
            $tb_his_patinf = new Ttb_his_patinf(2);
            $tb_his_patinf->kh=$identity_number;
            $tb_his_patinf->klx=9;
            $tb_his_patinf->xm=$name;
            $tb_his_patinf->yljgdm=$individual_session->jgdm;
            $tb_his_patinf->identity_number=$identity_number;
            $tb_his_patinf->whereAdd("kh='$kh'");
            $tb_his_patinf->update();
            $tb_his_patinf->free_statement();
            
            $tb_his_mz_fee_detail = new Ttb_his_mz_fee_detail(2);
            $tb_his_mz_fee_detail->kh=$identity_number;
            $tb_his_mz_fee_detail->klx=9;
            $tb_his_mz_fee_detail->whereAdd("kh='$kh'");
            $tb_his_mz_fee_detail->update();
            $tb_his_mz_fee_detail->free_statement();
            
            //判断本卡号所对应的就诊流水号在处方详细里是否有对应记录，有则更新对应记录卡号和卡类型，否则，提供列表选择
            $tb_cis_prescription_detail = new Ttb_cis_prescription_detail(2);
            $tb_cis_prescription_detail->whereAdd("kh='$kh'");
            $tb_cis_prescription_detail->whereAdd("jzlsh='$jzlsh'");
            if($tb_cis_prescription_detail->count())
            {
                //有记录，更新记录
                $tb_cis_prescription_detail_update = new Ttb_cis_prescription_detail(2);
                $tb_cis_prescription_detail_update->kh=$identity_number;
                $tb_cis_prescription_detail_update->klx=9;
                $tb_cis_prescription_detail_update->yljgdm=$individual_session->jgdm;
                $tb_cis_prescription_detail_update->whereAdd("kh='$kh'");
                $tb_cis_prescription_detail_update->update();
                $tb_cis_prescription_detail_update->free_statement();
            }
            else
            {
                //取所有处方列表
                $tb_cis_prescription_detail = new Ttb_cis_prescription_detail(2);
                $nums = $tb_cis_prescription_detail->count();
                $pageCurrent = intval($this->_request->getParam('page'));
                $pageCurrent = $pageCurrent ? $pageCurrent : 1;
                //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
                $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,
                    __BASEPATH . 'tools/index/step1/page/', 2, array());
                $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
                $startnum = __ROWSOFPAGE * ($pageCurrent - 1); //计算开始记录数
                $tb_cis_prescription_detail->limit($startnum, __ROWSOFPAGE);
                $tb_cis_prescription_detail->find();
                $data=array();
                $i=0;
                $xb=array(1=>'男',2=>'女');
                while($tb_cis_prescription_detail->fetch())
                {
                    $data[$i]['yljgdm']=$tb_cis_prescription_detail->yljgdm;
                    $data[$i]['jzlsh']=$tb_cis_prescription_detail->jzlsh;
                    $data[$i]['kh']=$tb_cis_prescription_detail->kh;
                    $data[$i]['klx']=$tb_cis_prescription_detail->klx;
                    $data[$i]['jzksmc']=$tb_cis_prescription_detail->jzksmc;
                    $data[$i]['mxxmmc']=$tb_cis_prescription_detail->xmmc;
                    $data[$i]['mxxmdw']=$tb_cis_prescription_detail->ypgg;
                    $i++;
                }
                $pager = $links->subPageCss2();
                $this->view->assign("data", $data);
                $this->view->assign("pager", $pager);
                $this->view->display('prescription_detail.html');
            }
            $tb_cis_prescription_detail->free_statement();
            
        }
        else
        {
            message("卡号获取错误，请重新选择。", array("门诊及处方列表" => __BASEPATH . 'tools/index/index'));
        }
    }
    /**
     * tools_indexController::step2Action()
     * 
     * 修改处方详情
     * 
     * @return void
     */
    public function step2Action()
    {
        //判定
        $individual_session = new Zend_Session_Namespace("individual_core");
        if (empty($individual_session->uuid) || empty($individual_session->staff_id))
        {
            message("请在个人档案列表双击选中待处理的居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
        if(!$individual_session->jgdm)
        {
            message("你没有填写要转换的机构代码", array("填写机构代码" => __BASEPATH . 'tools/index/jgdm'));
        }
        $this->view->assign("jgdm", $individual_session->jgdm);
        //取身份证号码
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("uuid='" . $individual_session->uuid . "'");
        $individual_core->find(true);
        $individual_core->free_statement();
        $identity_number = $individual_core->identity_number;
        $name=$individual_core->name;  
        $kh=$this->_request->getParam('kh');
        $jzlsh=$this->_request->getParam('jzlsh');
        if($kh && $jzlsh)
        {
            require_once __SITEROOT . "library/Models/tb_cis_prescription_detail.php";
            $tb_cis_prescription_detail_update = new Ttb_cis_prescription_detail(2);
            $tb_cis_prescription_detail_update->jzlsh=$jzlsh;
            $tb_cis_prescription_detail_update->kh=$identity_number;
            $tb_cis_prescription_detail_update->klx=9;
            $tb_cis_prescription_detail_update->yljgdm=$individual_session->jgdm;
            $tb_cis_prescription_detail_update->whereAdd("kh='$kh'");
            $tb_cis_prescription_detail_update->update();
            $tb_cis_prescription_detail_update->free_statement();
            message("门诊及处方部分已更新完成，点击下一步进入构造住院情况", array("构造住院情况" => __BASEPATH . 'tools/index/step3'));
        }
        else
        {
            message("卡号获取错误，请重新选择。", array("门诊及处方列表" => __BASEPATH . 'tools/index/index'));
        }
    }
    /**
     * tools_indexController::step3Action()
     * 
     * 第三步，构造住院情况
     * 
     * @return void
     */
    public function step3Action()
    {
        //判定
        $individual_session = new Zend_Session_Namespace("individual_core");
        if (empty($individual_session->uuid) || empty($individual_session->staff_id))
        {
            message("请在个人档案列表双击选中待处理的居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
        if(!$individual_session->jgdm)
        {
            message("你没有填写要转换的机构代码", array("填写机构代码" => __BASEPATH . 'tools/index/jgdm'));
        }
        $this->view->assign("jgdm", $individual_session->jgdm);
        require_once __SITEROOT . "library/Models/tb_yl_zy_medical_record.php";
        require_once __SITEROOT . "library/Models/tb_his_zy_fee_detail.php";
        $tb_yl_zy_medical_record = new Ttb_yl_zy_medical_record(2);
        $tb_his_zy_fee_detail = new Ttb_his_zy_fee_detail(2);
        $tb_yl_zy_medical_record->joinAdd('inner',$tb_yl_zy_medical_record,$tb_his_zy_fee_detail,'jzlsh','jzlsh');
        $nums = $tb_yl_zy_medical_record->count();
        $pageCurrent = intval($this->_request->getParam('page'));
        $pageCurrent = $pageCurrent ? $pageCurrent : 1;
        //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,
            __BASEPATH . 'tools/index/step3/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = __ROWSOFPAGE * ($pageCurrent - 1); //计算开始记录数
        $tb_yl_zy_medical_record->limit($startnum, __ROWSOFPAGE);
        $tb_yl_zy_medical_record->find();
        $data=array();
        $i=0;
        while($tb_yl_zy_medical_record->fetch())
        {
            $data[$i]['yljgdm']=$tb_yl_zy_medical_record->yljgdm;
            $data[$i]['jzlsh']=$tb_yl_zy_medical_record->jzlsh;
            $data[$i]['kh']=$tb_yl_zy_medical_record->kh;
            $data[$i]['klx']=$tb_yl_zy_medical_record->klx;
            $data[$i]['xm']=$tb_yl_zy_medical_record->hzxm;
            $data[$i]['jzksmc']=$tb_yl_zy_medical_record->jzksmc;
            $data[$i]['mxxmmc']=$tb_his_zy_fee_detail->mxxmmc;
            $i++;
        }
        $pager = $links->subPageCss2();
        $this->view->assign("data", $data);
        $this->view->assign("pager", $pager);
        $this->view->display('yl_mz_medical.html');
    }
    /**
     * tools_indexController::step4Action()
     * 
     * 第四步，构造住院数据，修改入库
     * 
     * @return void
     */
    public function step4Action()
    {
        //判定
        $individual_session = new Zend_Session_Namespace("individual_core");
        if (empty($individual_session->uuid) || empty($individual_session->staff_id))
        {
            message("请在个人档案列表双击选中待处理的居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
        if(!$individual_session->jgdm)
        {
            message("你没有填写要转换的机构代码", array("填写机构代码" => __BASEPATH . 'tools/index/jgdm'));
        }
        $this->view->assign("jgdm", $individual_session->jgdm);
        //取身份证号码
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("uuid='" . $individual_session->uuid . "'");
        $individual_core->find(true);
        $individual_core->free_statement();
        $identity_number = $individual_core->identity_number;
        $name=$individual_core->name;  
        $kh=$this->_request->getParam('kh');
        $jzlsh=$this->_request->getParam('jzlsh');
        if($kh && $jzlsh)
        {
            require_once __SITEROOT . "library/Models/tb_yl_zy_medical_record.php";
            require_once __SITEROOT . "library/Models/tb_his_zy_fee_detail.php";
            $tb_yl_zy_medical_record = new Ttb_yl_zy_medical_record(2);
            $tb_yl_zy_medical_record->kh=$identity_number;
            $tb_yl_zy_medical_record->klx=9;
            $tb_yl_zy_medical_record->hzxm=$name;
            $tb_yl_zy_medical_record->yljgdm=$individual_session->jgdm;
            $tb_yl_zy_medical_record->whereAdd("kh='$kh'");
            $tb_yl_zy_medical_record->update();
            $tb_yl_zy_medical_record->free_statement();
            
            $tb_his_zy_fee_detail = new Ttb_his_zy_fee_detail(2);
            $tb_his_zy_fee_detail->kh=$identity_number;
            $tb_his_zy_fee_detail->klx=9;
            $tb_his_zy_fee_detail->yljgdm=$individual_session->jgdm;
            $tb_his_zy_fee_detail->whereAdd("kh='$kh'");
            $tb_his_zy_fee_detail->update();
            $tb_his_zy_fee_detail->free_statement();
            message("住院情况部分已更新完成，点击下一步进入构造住院病案首页", array("构造住院病案首页" => __BASEPATH . 'tools/index/step5'));
        }
        else
        {
            message("卡号获取错误，请重新选择。", array("门诊及处方列表" => __BASEPATH . 'tools/index/index'));
        }
    }
    /**
     * tools_indexController::step5Action()
     * 
     * 第5步，构造住院病案首页
     * 
     * @return void
     */
    public function step5Action()
    {
        //判定
        $individual_session = new Zend_Session_Namespace("individual_core");
        if (empty($individual_session->uuid) || empty($individual_session->staff_id))
        {
            message("请在个人档案列表双击选中待处理的居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
        if(!$individual_session->jgdm)
        {
            message("你没有填写要转换的机构代码", array("填写机构代码" => __BASEPATH . 'tools/index/jgdm'));
        }
        $this->view->assign("jgdm", $individual_session->jgdm);
        //取年龄
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("uuid='" . $individual_session->uuid . "'");
        $individual_core->find(true);
        $csrq=date('Ymd',$individual_core->date_of_birth);
        require_once __SITEROOT . "library/Models/tb_cis_main.php";
        $tb_cis_main = new Ttb_cis_main(2);
        $nums = $tb_cis_main->count();
        $pageCurrent = intval($this->_request->getParam('page'));
        $pageCurrent = $pageCurrent ? $pageCurrent : 1;
        //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,
            __BASEPATH . 'tools/index/step5/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = __ROWSOFPAGE * ($pageCurrent - 1); //计算开始记录数
        $tb_cis_main->limit($startnum, __ROWSOFPAGE);
        $tb_cis_main->find();
        $data=array();
        $i=0;
        $xb=array(1=>'男',2=>'女');
        while($tb_cis_main->fetch())
        {
            $data[$i]['yljgdm']=$tb_cis_main->yljgdm;
            $data[$i]['jzlsh']=$tb_cis_main->jzlsh;
            $data[$i]['kh']=$tb_cis_main->kh;
            $data[$i]['klx']=$tb_cis_main->klx;
            $data[$i]['xm']=$tb_cis_main->xm;
            $data[$i]['xb']=$xb[$tb_cis_main->xb];
            $data[$i]['jzksmc']=$tb_cis_main->rybq;
            $data[$i]['csny']=$tb_cis_main->csny;
            $i++;
        }
        $pager = $links->subPageCss2();
        $this->view->assign("csrq", $csrq);
        $this->view->assign("data", $data);
        $this->view->assign("pager", $pager);
        $this->view->display('cis_main.html');
    }
    /**
     * tools_indexController::step6Action()
     * 
     * 第6步，构造住院病案首页，修改库
     * 
     * @return void
     */
    public function step6Action()
    {
        //判定
        $individual_session = new Zend_Session_Namespace("individual_core");
        if (empty($individual_session->uuid) || empty($individual_session->staff_id))
        {
            message("请在个人档案列表双击选中待处理的居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
        if(!$individual_session->jgdm)
        {
            message("你没有填写要转换的机构代码", array("填写机构代码" => __BASEPATH . 'tools/index/jgdm'));
        }
        $this->view->assign("jgdm", $individual_session->jgdm);
        //取身份证号码
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("uuid='" . $individual_session->uuid . "'");
        $individual_core->find(true);
        $individual_core->free_statement();
        $identity_number = $individual_core->identity_number;
        $name=$individual_core->name;  
        $kh=$this->_request->getParam('kh');
        $jzlsh=$this->_request->getParam('jzlsh');
        if($kh && $jzlsh)
        {
            require_once __SITEROOT . "library/Models/tb_cis_main.php";
            $tb_cis_main = new Ttb_cis_main(2);
            $tb_cis_main->kh=$identity_number;
            $tb_cis_main->klx=9;
            $tb_cis_main->xm=$name;
            $tb_cis_main->yljgdm=$individual_session->jgdm;
            $tb_cis_main->whereAdd("kh='$kh'");
            $tb_cis_main->update();
            $tb_cis_main->free_statement();
            message("住院病案首页已更新完成，点击下一步进入构造病历记录", array("构造病历记录" => __BASEPATH . 'tools/index/step7'));
        }
        else
        {
            message("卡号获取错误，请重新选择。", array("门诊及处方列表" => __BASEPATH . 'tools/index/index'));
        }
    }
    /**
     * tools_indexController::step7Action()
     * 
     * 第7步，构造病历记录，选择待修改数据
     * 
     * @return void
     */
    public function step7Action()
    {
        //判定
        $individual_session = new Zend_Session_Namespace("individual_core");
        if (empty($individual_session->uuid) || empty($individual_session->staff_id))
        {
            message("请在个人档案列表双击选中待处理的居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
        if(!$individual_session->jgdm)
        {
            message("你没有填写要转换的机构代码", array("填写机构代码" => __BASEPATH . 'tools/index/jgdm'));
        }
        $this->view->assign("jgdm", $individual_session->jgdm);
        //取年龄
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("uuid='" . $individual_session->uuid . "'");
        $individual_core->find(true);
        $csrq=date('Ymd',$individual_core->date_of_birth);
        require_once __SITEROOT . "library/Models/zaojia_emr.php";
        $zaojia_emr = new Tzaojia_emr();
        $nums = $zaojia_emr->count();
        $pageCurrent = intval($this->_request->getParam('page'));
        $pageCurrent = $pageCurrent ? $pageCurrent : 1;
        //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,
            __BASEPATH . 'tools/index/step5/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = __ROWSOFPAGE * ($pageCurrent - 1); //计算开始记录数
        $zaojia_emr->limit($startnum, __ROWSOFPAGE);
        $zaojia_emr->find();
        $data=array();
        $i=0;
        while($zaojia_emr->fetch())
        {
            $data[$i]['yljgdm']=$zaojia_emr->org_id;
            $data[$i]['kh']=$zaojia_emr->uuid;
            $data[$i]['xm']=$zaojia_emr->name;
            $data[$i]['xb']=$zaojia_emr->gender;
            $data[$i]['jzksmc']=$zaojia_emr->department;
            $data[$i]['past_history']=$zaojia_emr->past_history;
            $i++;
        }
        $pager = $links->subPageCss2();
        $this->view->assign("data", $data);
        $this->view->assign("pager", $pager);
        $this->view->display('zaojia_emr.html');
    }
    /**
     * tools_indexController::step8Action()
     * 
     * 第8步 构造病历记录 修改库
     * 
     * @return void
     */
    public function step8Action()
    {
        //判定
        $individual_session = new Zend_Session_Namespace("individual_core");
        if (empty($individual_session->uuid) || empty($individual_session->staff_id))
        {
            message("请在个人档案列表双击选中待处理的居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
        if(!$individual_session->jgdm)
        {
            message("你没有填写要转换的机构代码", array("填写机构代码" => __BASEPATH . 'tools/index/jgdm'));
        }
        $this->view->assign("jgdm", $individual_session->jgdm);
        //取身份证号码
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("uuid='" . $individual_session->uuid . "'");
        $individual_core->find(true);
        $individual_core->free_statement();
        $identity_number = $individual_core->identity_number;
        $name=$individual_core->name;  
        $kh=$this->_request->getParam('kh');
        if($kh)
        {
            require_once __SITEROOT . "library/Models/zaojia_emr.php";
            $zaojia_emr = new Tzaojia_emr();
            $zaojia_emr->identity_number=$identity_number;
            $zaojia_emr->org_id=$individual_session->jgdm;
            $zaojia_emr->whereAdd("uuid='$kh'");
            $zaojia_emr->update();
            $zaojia_emr->free_statement();
            message("病历记录已更新完成，点击下一步进入构造检验记录", array("构造检验记录" => __BASEPATH . 'tools/index/step9'));
        }
        else
        {
            message("卡号获取错误，请重新选择。", array("门诊及处方列表" => __BASEPATH . 'tools/index/index'));
        }
    }
    /**
     * tools_indexController::step9Action()
     * 
     * 第9步 构造检验记录 显示列表
     * 
     * @return void
     */
    public function step9Action()
    {
        //判定
        $individual_session = new Zend_Session_Namespace("individual_core");
        if (empty($individual_session->uuid) || empty($individual_session->staff_id))
        {
            message("请在个人档案列表双击选中待处理的居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
        if(!$individual_session->jgdm)
        {
            message("你没有填写要转换的机构代码", array("填写机构代码" => __BASEPATH . 'tools/index/jgdm'));
        }
        $this->view->assign("jgdm", $individual_session->jgdm);
        //取年龄
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("uuid='" . $individual_session->uuid . "'");
        $individual_core->find(true);
        $csrq=date('Ymd',$individual_core->date_of_birth);
        require_once __SITEROOT . "library/Models/zj_clinic_lab_exam.php";
        $zj_clinic_lab_exam = new Tzj_clinic_lab_exam();
        $nums = $zj_clinic_lab_exam->count();
        $pageCurrent = intval($this->_request->getParam('page'));
        $pageCurrent = $pageCurrent ? $pageCurrent : 1;
        //new subpages(每页显示调试，总条数，当前页数，每次显示页数索引，URL地址，样式，URL参数数组);
        $links = new SubPages(__ROWSOFPAGE, $nums, $pageCurrent, __goodsListRowOfPage,
            __BASEPATH . 'tools/index/step5/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = __ROWSOFPAGE * ($pageCurrent - 1); //计算开始记录数
        $zj_clinic_lab_exam->limit($startnum, __ROWSOFPAGE);
        $zj_clinic_lab_exam->find();
        $data=array();
        $i=0;
        while($zj_clinic_lab_exam->fetch())
        {
            $data[$i]['yljgdm']=$zj_clinic_lab_exam->org_id;
            $data[$i]['kh']=$zj_clinic_lab_exam->uuid;
            $data[$i]['xm']=$zj_clinic_lab_exam->name;
            $data[$i]['xb']=$zj_clinic_lab_exam->gender;
            $data[$i]['jzksmc']=$zj_clinic_lab_exam->departments;
            $data[$i]['test_equipment']=$zj_clinic_lab_exam->test_equipment;
            $i++;
        }
        $pager = $links->subPageCss2();
        $this->view->assign("data", $data);
        $this->view->assign("pager", $pager);
        $this->view->display('lab_exam.html');
    }
    /**
     * tools_indexController::step10Action()
     * 
     * 第10步，最后一步，构造检验记录，修改库
     * 
     * @return void
     */
    public function step10Action()
    {
        //判定
        $individual_session = new Zend_Session_Namespace("individual_core");
        if (empty($individual_session->uuid) || empty($individual_session->staff_id))
        {
            message("请在个人档案列表双击选中待处理的居民", array("进入个人档案列表" => __BASEPATH . 'iha/index/index'));
        }
        if(!$individual_session->jgdm)
        {
            message("你没有填写要转换的机构代码", array("填写机构代码" => __BASEPATH . 'tools/index/jgdm'));
        }
        $this->view->assign("jgdm", $individual_session->jgdm);
        //取身份证号码
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("uuid='" . $individual_session->uuid . "'");
        $individual_core->find(true);
        $individual_core->free_statement();
        $identity_number = $individual_core->identity_number;
        $name=$individual_core->name;  
        $kh=urldecode($this->_request->getParam('kh'));
        if($kh)
        {
            require_once __SITEROOT . "library/Models/zj_clinic_lab_exam.php";
            $zj_clinic_lab_exam = new Tzj_clinic_lab_exam();
            $zj_clinic_lab_exam->identity_number=$identity_number;
            $zj_clinic_lab_exam->org_id=$individual_session->jgdm;
            $zj_clinic_lab_exam->name=$name;
            $zj_clinic_lab_exam->whereAdd("name='$kh'");
            $zj_clinic_lab_exam->update();
            $zj_clinic_lab_exam->free_statement();
            
            require_once __SITEROOT . "library/Models/zj_indicators.php";
            $zj_indicators = new Tzj_indicators();
            $zj_indicators->identity_number=$identity_number;
            $zj_indicators->org_id=$individual_session->jgdm;
            $zj_indicators->whereAdd("lis_id in (select lis_id from zj_clinic_lab_exam where name='$name')");
            $zj_indicators->update();
            $zj_indicators->free_statement();
            
            message("恭喜，您的任务已成功完成，共10步。", array("查看记录记录" => __BASEPATH . 'iha/search/search/name/'.$name.'/card/'.$identity_number));
        }
        else
        {
            message("卡号获取错误，请重新选择。", array("门诊及处方列表" => __BASEPATH . 'tools/index/index'));
        }
    }
}
?>