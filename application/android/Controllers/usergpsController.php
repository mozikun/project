<?php
/**
 * android_usergpsController
 * 
 * 摇医生 居民端功能处理
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class android_usergpsController extends controller
{
    public function init()
    {
        require_once __SITEROOT . "library/Models/individual_core.php";
        require_once __SITEROOT . "library/Models/staff_core.php";
    }
    /**
     * android_usergpsController::userAction()
     * 
     * 完成居民摇动客户端时的请求响应 返回json
     * 
     * @return void
     */
    public function userAction()
    {
        $message=array();
        $message['error']=1;
        $uid=$this->_request->getParam('uid');
        $gps_x=$this->_request->getParam('gps_x');
        $gps_y=$this->_request->getParam('gps_y');
        if($uid)
        {
            if($gps_x && $gps_y)
            {
                //使用新的GPS信息，并写入数据
                $individual_core=new Tindividual_core();
                $individual_core->whereAdd("identity_number='$uid'");
                $individual_core->gps_x=$gps_x;
                $individual_core->gps_y=$gps_y;
                $individual_core->gps_time=time();
                $individual_core->update();
                //查询附近医生
            }
            else
            {
                //查询过去的GPS位置
                $individual_core=new Tindividual_core();
                $individual_core->whereAdd("identity_number='$uid'");
                $individual_core->find(true);
                if($individual_core->gps_x && $individual_core->gps_y)
                {
                    $gps_x=$individual_core->gps_x;
                    $gps_y=$individual_core->gps_y;
                    $message['error']=3;
                }
                else
                {
                    $message['error']=2;
                }
            }
        }
        else
        {
            $message['error']=4;
        }
        $message['position']['0']=array('doctor_name'=>'医生一','org_name'=>'四川省##医院','gps_x'=>'56.25555','gps_y'=>'87.5215');
        $message['position']['1']=array('doctor_name'=>'医生二','org_name'=>'四川省**医院','gps_x'=>'46.25555','gps_y'=>'77.5215');
        $message['position']['2']=array('doctor_name'=>'医生三','org_name'=>'四川省@@医院','gps_x'=>'54.25555','gps_y'=>'82.5215');
        echo json_encode($message);
    }
}