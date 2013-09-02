<?php
/**
 * tools_novalueController
 * 
 * 分机构导出某个字段为Null的数据
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class tools_novalueController extends controller
{
    public function init()
    {
        $this->haveWritePrivilege = '';
        require_once (__SITEROOT . 'library/privilege.php');
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/Models/individual_core.php";
        require_once (__SITEROOT . 'library/MyAuth.php');
        $this->view->assign("baseUrl", __BASEPATH);
        $this->view->assign("basePath", __BASEPATH);
    }
    public function indexAction()
    {
        $individual_core_org=new Tindividual_core();
        $organization_org = new Torganization();
        $individual_core_org->joinAdd("inner",$individual_core_org,$organization_org,'org_id','id');
        $individual_core_org->selectAdd("distinct individual_core.org_id");
        $individual_core_org->whereAdd("individual_core.sex is null");
        $individual_core_org->find();
        $title='';
        //导出数据到浏览器，然后输出总共导出多少条数据
        require_once __SITEROOT . 'library/phpexcel/Classes/PHPExcel.php';
        while($individual_core_org->fetch())
        {
            $excel_name=$organization_org->zh_name;
            $individual_core=new Tindividual_core();
            $organization = new Torganization();
            $individual_core->joinAdd("inner",$individual_core,$organization,'org_id','id');
            $individual_core->whereAdd("individual_core.sex is null");
            $individual_core->whereAdd("individual_core.org_id = '".$organization_org->id."'");
            $individual_core->orderBy("individual_core.org_id asc");
            $individual_core->find();
            // Create new PHPExcel object
            $title = $excel_name;
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("我好笨")->setLastModifiedBy("我好笨")->setTitle($title)->setSubject($title)->setDescription($title)->setKeywords("office 2007 openxml php")->setCategory($title);
            //电子表格的序号
            $excel_order = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","BB","CC");
            // 填写标题
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($excel_order[0] . '1', '姓名')->setCellValue($excel_order[1] . '1', '身份证号')->setCellValue($excel_order[2] . '1', '现 住 址')->setCellValue($excel_order[3] .'1', '户籍地址')->setCellValue($excel_order[4] . '1', '本人电话');
            //设置单元格格式
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[0])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[1])->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[2])->setWidth(45);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[3])->setWidth(45);
            $objPHPExcel->getActiveSheet()->getColumnDimension($excel_order[4])->setWidth(25);
            $i = 2;
            while($individual_core->fetch())
            {
                $name = $individual_core->name;
                $address = $individual_core->address;
                $residence_address = $individual_core->residence_address;
                $identity_number = $individual_core->identity_number;
                $phone_number = $individual_core->phone_number;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($excel_order[0] . $i, $name)->setCellValue($excel_order[1] . $i, $identity_number . " ")->setCellValue($excel_order[2] . $i, $address)->setCellValue($excel_order[3] .$i, $residence_address)->setCellValue($excel_order[4] . $i, $phone_number);
                $i++;
            }
            $objPHPExcel->getActiveSheet()->setTitle($title);
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
            // Redirect output to a client’s web browser (Excel5)
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save(__SITEROOT.'cache/'.iconv('utf-8', 'gb2312', $title).'.xls');
        }
        
        exit('导出完成');
    }
}