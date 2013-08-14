<?php
/**
 * iha_imageController
 * 
 * 本模块完成影像文件的读取与下载
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class iha_imageController extends controller
{
    /**
     * iha_imageController::init()
     * 
     * @return void
     */
    public function init()
    {
        //$this->view->assign("baseUrl",__BASEPATH);
	    $this->view->assign("basePath", __BASEPATH);
        require_once __SITEROOT."library/Models/individual_core.php";
        require_once __SITEROOT.'/library/custom/comm_function.php';
    }
    /**
     * iha_imageController::indexAction()
     * 
     * 用于列表指定用户的影像记录，数据来源于：医学影像检查报告表(TB_RIS_Report)
     * 
     * @return void
     */
    public function indexAction()
    {
        $card=base64_decode(stripslashes($this->_request->getParam("card")));//身份证号码
        require_once __SITEROOT."library/Models/tb_ris_report.php";
        $tb_ris_report=new Ttb_ris_report(2);
        $tb_ris_report->whereAdd("tb_ris_report.identity_number='$card'");
        $tb_ris_report->orderby("tb_ris_report.jysj desc");
        //$tb_ris_report->limit(0,8);
        //$tb_ris_report->debugLevel(4);
        $tb_ris_report->find();
        $imgs=array();
        $i=0;
        while($tb_ris_report->fetch())
        {
            $imgs[$i]['uid']=$tb_ris_report->studyuid;
            $imgs[$i]['xm']=$tb_ris_report->brxm;
            $imgs[$i]['xb']=$tb_ris_report->brxb;
            $imgs[$i]['sqdh']=$tb_ris_report->sqdh;
            $imgs[$i]['jcksmc']=$tb_ris_report->jcksmc;
            $imgs[$i]['jcys']=$tb_ris_report->jcys;
            $imgs[$i]['bgrxm']=$tb_ris_report->bgrxm;
            $imgs[$i]['jcmc']=$tb_ris_report->jcmc;
            $imgs[$i]['jcbw']=$tb_ris_report->jcbw;
            $imgs[$i]['jysj']=$tb_ris_report->jysj;
            $i++;
        }
        $this->view->imgs=$imgs;
        $this->view->display('index.html');
    }
    /**
     * iha_imageController::viewAction()
     * 
     * 显示单条记录
     * 
     * @return void
     */
    public function viewAction()
    {
        $uid=$this->_request->getParam("uid");
        if($uid)
        {
            require_once __SITEROOT."library/Models/tb_ris_report.php";
            $tb_ris_report=new Ttb_ris_report(2);
            $tb_ris_report->whereAdd("tb_ris_report.studyuid='$uid'");
            $tb_ris_report->orderby("tb_ris_report.jysj desc");
            $tb_ris_report->find(true);
            $this->view->tb_ris_report=$tb_ris_report;
            $this->view->display('view.html');
        }
        else
        {
            exit('参数获取错误');
        }
    }
    /**
     * iha_imageController::imgAction()
     * 
     * 读取缩略图图片内容
     * 
     * @return void
     */
    public function imgAction()
    {
        $uid=$this->_request->getParam("uid");
        if($uid)
        {
            require __SITEROOT."config/oracleConfig.php";
            require_once __SITEROOT."library/Models/tb_ris_report.php";
            $conn = oci_connect($databaseConfig[2]['user'],$databaseConfig[2]['password'],$databaseConfig[2]['host']);
            $query = "select YXSLT from TB_RIS_REPORT where StudyUid='$uid'";
            $stmt = oci_parse($conn,$query);
            oci_execute($stmt);
            while($result=oci_fetch_array($stmt,OCI_RETURN_LOBS))
            {
                 $file_date = $result[0];
            }
            echo $file_date;
            header('Content-type: image/jpeg');
            oci_free_statement($stmt);
            oci_close($conn);
        }
    }
    /**
     * iha_imageController::getfileAction()
     * 
     * 通过FTP下载影像文件
     * 
     * @return void
     */
    public function getfileAction()
    {
        $uid=$this->_request->getParam("uid");
        if($uid)
        {
            require_once __SITEROOT."library/Models/tb_his_patinf.php";
            require_once __SITEROOT."library/Models/tb_ris_report.php";
            $tb_ris_report=new Ttb_ris_report(2);
            $tb_ris_report->whereAdd("studyuid='$uid'");
            $tb_ris_report->find(true);
            if($tb_ris_report->yxfwqip && $tb_ris_report->yxsjdz)
            {
                require_once __SITEROOT."library/custom/ftp.class.php";
                header("Content-type: application/octet-stream");
                header('Content-Disposition: attachment; filename="'.basename(iconv('utf-8','gb2312//IGNORE',$tb_ris_report->yxsjdz)).'"');
                $ftp=new Ftp();
                if($ftp->connect($tb_ris_report->yxfwqip))
                {
                    $ftp->login($tb_ris_report->yxftpyhm,$tb_ris_report->yxftpmm);
                    $file = tmpfile();
                    $ftp->fget($file, iconv('utf-8','gb2312//IGNORE',$tb_ris_report->yxsjdz), Ftp::ASCII);
                    fseek($file,0);
                    fpassthru($file);
                    fclose($file);
                }
                else
                {
                    exit('无法连接影像服务器');
                }
                
            }
            else
            {
                exit('原图不存在或者已被删除');
            }
        }
        else
        {
            exit('参数获取错误');
        }
    }
    /**
     * iha_imageController::writeAction()
     * 
     * 写测试图片文件入数据库
     * 
     * @return void
     */
    public function writeAction()
    {
        $uid=$this->_request->getParam("uid");
        $sel_img=__SITEROOT.'aa.jpg';
        $user = "yaanhis";
        $password = "YAANHIS";
        $SID = "172.16.11.245/orcl";
        $DBCONN = oci_connect($user,$password,$SID);
        $sql_upt="update TB_RIS_REPORT set YXSLT=EMPTY_BLOB() where StudyUid='$uid' RETURNING YXSLT into :YXSLT";
        $result_upt=oci_parse($DBCONN,$sql_upt);
        $Image = oci_new_descriptor($DBCONN);
        oci_bind_by_name($result_upt, ":YXSLT", $Image, -1, SQLT_BLOB );
        if (!oci_execute($result_upt, OCI_DEFAULT)) 
        {
            echo "Execution failed";
            oci_rollback($DBCONN);
            $uptflag="N";
         }
         else
         {
            $fp = fopen($sel_img, "r" );
            $Image->save(fread($fp, filesize($sel_img)));
            fclose($fp );
            oci_commit($DBCONN);
            $uptflag="Y";
         }
         oci_free_statement($result_upt);
         oci_close($DBCONN);
    }
}