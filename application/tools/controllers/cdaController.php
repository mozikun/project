<?php
/**
 * tools_cdaController
 * 
 * 完成EXCEL的导入到接口表
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class tools_cdaController extends controller
{
    public function init()
    {
        require_once __SITEROOT . '/library/custom/comm_function.php';
        $this->view->basePath = $this->_request->getBasePath();
    }
    /**
     * tools_cdaController::indexAction()
     * 
     * @return void
     */
    public function indexAction()
    {
        $this->view->display("index.html");
    }
    /**
     * tools_cdaController::displayAction()
     * 
     * @return void
     */
    public function displayAction()
    {
        $filename=$this->_request->getParam('filename');
        $tab=intval($this->_request->getParam('tab'));
        $rows=intval($this->_request->getParam('rows'));
        $data=array();
        $i=0;
        if(file_exists(__SITEROOT.'upload/'.$filename))
        {
            require_once __SITEROOT . 'library/phpexcel/Classes/PHPExcel.php';
            $reader = PHPExcel_IOFactory::createReader('Excel5'); //设置以Excel5格式(Excel97-2003工作簿)
            $PHPExcel = $reader->load(__SITEROOT.'upload/'.$filename); // 载入excel文件
            $sheet = $PHPExcel->getSheet($tab); // 根据表名读取
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumm = $sheet->getHighestColumn(); // 取得总列数
            for ($row = $rows; $row <= $highestRow; $row++)
            {
                $data[$i]['c']=$sheet->getCell('C'.$row)->getValue();
                $data[$i]['d']=$sheet->getCell('D'.$row)->getValue();
                $data[$i]['f']=$sheet->getCell('F'.$row)->getValue();
                $i++;
            }
        }
        //取数据库中已有的值
        require_once __SITEROOT . 'library/Models/cda_xmlnode.php';
        $cda_xml=new Tcda_xmlnode();
        $cda_xml->find();
        $cdas=array();
        while($cda_xml->fetch())
        {
            $cdas[$cda_xml->de_code]['tablename']=$cda_xml->table_name;
            $cdas[$cda_xml->de_code]['cols_name']=$cda_xml->cols_name;
        }
        $this->view->data=$data;
        $this->view->cdas=$cdas;
        $this->view->display("display.html");
    }
    /**
     * tools_cdaController::importAction()
     * 
     * @return void
     */
    public function importAction()
    {
        require_once __SITEROOT . 'library/Models/cda_xmlnode.php';
        $c=$this->_request->getParam('c');
        $d=$this->_request->getParam('d');
        $f=$this->_request->getParam('f');
        $is_required=$this->_request->getParam('is_required');
        $cols_name=$this->_request->getParam('cols_name');
        $tablename=$this->_request->getParam('tablename');
        $is_overwrite=$this->_request->getParam('is_overwrite');
        $success=0;
        $overwrite=0;
        if($tablename && !empty($c))
        {
            foreach($c as $k=>$v)
            {
                $cda_xml=new Tcda_xmlnode();
                if($is_overwrite)
                {
                    //查找源数据，并删除后重做
                    $cda_old=new Tcda_xmlnode();
                    $cda_old->whereAdd("de_code='$v'");
                    $cda_old->delete();
                    $cda_old->free_statement();
                    $overwrite++; 
                }
                $cda_xml->uuid=uniqid('cda_',true);
                $cda_xml->cols_name=isset($cols_name[$v])?$cols_name[$v]:'';
                $cda_xml->table_name=isset($tablename[$v])?$tablename[$v]:'';
                $cda_xml->de_code=$v;
                $cda_xml->de_name=isset($d[$v])?$d[$v]:'';
                $cda_xml->de_type=isset($f[$v])?$f[$v]:'';
                $cda_xml->is_required=isset($is_required[$v])?$is_required[$v]:2;
                if($cda_xml->insert())
                {
                    $success++;
                }
                $cda_xml->free_statement();
            }
            $url=array("导入首页"=>__BASEPATH ."tools/cda/index");
            message("导入完成，成功导入".$success."条,覆盖".$overwrite."条记录",$url);
        }
        else
        {
            $url=array("导入首页"=>__BASEPATH ."tools/cda/index");
            message("对不起，导入失败，平台表名为空或待导入字段为空",$url);
            exit;
        }
    }
    /**
     * tools_cdaController::colsAction()
     * 
     * 获取表对象里所有的属性子集
     * 
     * @return void
     */
    public function colsAction()
    {
        $tablename=$this->_request->getParam('table');
        $tmp=array();
        if(file_exists(__SITEROOT . 'library/Models/'.$tablename.'.php'))
        {
            require_once __SITEROOT . 'library/Models/'.$tablename.'.php';
            $vars=get_class_vars('T'.$tablename);
            foreach($vars as $k=>$v)
            {
                if($v=='')
                {
                   $tmp[]=$k; 
                }
            }
        }
        echo json_encode($tmp);
    }
}