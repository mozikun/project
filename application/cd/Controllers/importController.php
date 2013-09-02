<?php

/**
 * cd_importController
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @todo 慢病数据导出
 * @access public
 */
class cd_importController extends controller
{
    public function init()
    {
        $this->haveWritePrivilege = '';
        require_once (__SITEROOT . 'library/privilege.php');
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/Models/individual_archive.php";
        require_once __SITEROOT . "library/Models/individual_core.php";
        require_once __SITEROOT . "library/Models/clinical_history.php";
        require_once (__SITEROOT . 'library/MyAuth.php');
        $this->view->assign("baseUrl", __BASEPATH);
        $this->view->assign("basePath", __BASEPATH);
    }
    /**
     * cd_importController::importAction()
     * 
     * @return void
     */
    public function importAction()
    {
        //判断当前时间
        //2012-03-30 领导要求必须在下午4:30以后才允许导出
        $hours=@intval(date('Gi',time()));//小时分钟
        require_once __SITEROOT . "/library/custom/pager.php";
        require_once __SITEROOT . '/library/custom/adodb-time.inc.php'; //引入时间处理
        require_once __SITEROOT . '/library/data_arr/arrdata.php';
        require_once __SITEROOT . '/library/custom/comm_function.php';
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
        //按下次随访日期搜索，默认情况下列出下次随访日期是今天的所有人员
        $search = array();
        $time = time();
        $excel_name = $this->_request->getParam('excel_name') ? $this->_request->
            getParam('excel_name') : "患者列表";
        $search['age_start'] = intval($this->_request->getParam('age_start')) ? intval($this->
            _request->getParam('age_start')) : 0; //年龄段
        $search['age_end'] = ($this->_request->getParam('age_end') !== '' && intval($this->
            _request->getParam('age_end')) >= $search['age_start']) ? intval($this->
            _request->getParam('age_end')) : '';
        $search['org_id'] = $this->_request->getParam('region_p_id'); //地区
        $search['sex'] = $this->_request->getParam('sex');
        $search['clinical_type'] = $this->_request->getParam('clinical_type') ? $this->
            _request->getParam('clinical_type') : 2;
        $search['status_flag']=$current_status_flag;//档案状态
        $individual_core_region_path_domain = get_region_path(1, $search['org_id']);
        $is_excel = $this->_request->getParam('excel');
        $title = "";
        if ($is_excel != "do")
        {
            $this->view->search = $search;
            $this->view->clinical_type = $search['clinical_type'];
            $this->view->sex = $sex;
            $this->view->disease_history = $disease_history;
            $this->view->assign('region_id', $this->user['region_id']);
            $this->view->assign('region_p_id', $this->user['region_id']);
            $this->view->assign('hours', $hours);
            $this->view->display('clinical_import_index.html');
        }
        else
        {
            if($hours>=900 && $hours<=1630)
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
                if ($k == "age_end" && $v !== '')
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
                if ($k == "clinical_type" && $v != "")
                {
                    $core->whereAdd("individual_core.uuid in (select id from clinical_history where disease_code='$v' and disease_state='1')");
                }
                if ($k=='status_flag' && $v!="")
                {
                	$core->whereAdd("individual_core.status_flag=$v");
                	if($v==1)
                	{
                		$title.="(正常档案)";
                	}
                	elseif ($v==4)
                	{
                		$title.="(临时档案)";
                	}
                	elseif ($v==6)
                	{
                		$title.="(死亡档案)";
                	}
                	elseif ($v==8)
                	{
                		$title.="(转出档案)";
                	}
                	else 
                	{
                		$title.="";
                	}
                }
            }
            $core->joinAdd('left', $core, $individual_archive, 'uuid', 'id');
            $core->whereAdd($individual_core_region_path_domain);
            //$core->whereAdd("individual_core.status_flag=1 or individual_core.status_flag=4");//档案状态 正常和临时
            $core->orderby("individual_core.updated DESC");
            $core->find();
            //导出数据到浏览器，然后输出总共导出多少条数据
            /** PHPExcel */
            require_once __SITEROOT . 'library/phpexcel/Classes/PHPExcel.php';
            // Create new PHPExcel object
            $title .= urldecode($excel_name);
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
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . iconv('utf-8', 'gb2312', $title) .
                '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }
    }
}
