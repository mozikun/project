<?php
/**
 * iha_hisController
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class iha_hisController extends controller
{
    public function init()
    {
        $this->haveWritePrivilege = '';
        require_once (__SITEROOT . 'library/privilege.php');
        require_once __SITEROOT . "library/Models/organization.php";
        require_once __SITEROOT . "library/Models/individual_core.php";

        require_once (__SITEROOT . 'library/Myauth.php');
        $this->view->assign("baseUrl", __BASEPATH);
        $this->view->assign("basePath", __BASEPATH);
    }
    /**
     * iha_hisController::hisAction()
     * 
     * 用于处理备份表，后缀为1的医疗数据
     * 
     * 处理流程：从个人档案中查询一条年龄>=20并且此人不存在医疗数据中的档案，修改备份表TB_HIS_PATINF1的身份证号码为新身份证号，姓名，性别，出生日期为身份证日期，修改表TB_HIS_PATINF1卡号为身份证号，卡类型为9，修改ZJHM字段为身份证号，以上修改完成后，修改所有备份表对应的卡号和卡类型为新卡号卡类型。
     * 
     * @return void
     */
    public function hisAction()
    {
        
    }
    /**
     * iha_hisController::updateAction()
     * 
     * 经商议后，决定修改统计数据，而非业务数据
     * 修改以下表中的数据值
     * tb_yw_ywltj业务量统计表，wd_med_store药品库存表，tb_yw_cwsyl床位使用表，tb_yw_ywsrtj业务收入统计表
     * 
     * @return void
     */
    public function updateAction()
    {
        require_once(__SITEROOT.'library/Models/tb_yw_ywltj.php');
        $tb_yw_ywltj=new Ttb_yw_ywltj(2);
        $tb_yw_ywltj->find();
        while($tb_yw_ywltj->fetch())
        {
            $tb_yw_ywltj_u=new Ttb_yw_ywltj(2);
            $tb_yw_ywltj_u->mzrc=$tb_yw_ywltj->mzrc*rand(5,10);//门诊人次
            $tb_yw_ywltj_u->jzrc=$tb_yw_ywltj->jzrc+rand(0,3);//急诊人次
            $tb_yw_ywltj_u->ryrc=abs($tb_yw_ywltj_u->mzrc/2-rand(0,10));//住院人次
            $tb_yw_ywltj_u->cyrc=$tb_yw_ywltj->jzrc+rand(0,10);//出院人次
            $tb_yw_ywltj_u->zyrs=$tb_yw_ywltj->zyrs*rand(2,5);//住院人数
            $tb_yw_ywltj_u->whereAdd("yljgdm='$tb_yw_ywltj->yljgdm'");
            $tb_yw_ywltj_u->whereAdd("ksbm='$tb_yw_ywltj->ksbm'");
            $tb_yw_ywltj_u->whereAdd("ywsj='$tb_yw_ywltj->ywsj'");
            $tb_yw_ywltj_u->update();
            $tb_yw_ywltj_u->free_statement();
        }
        $tb_yw_ywltj->free_statement();
        require_once(__SITEROOT.'library/Models/wd_med_store.php');
        //药品库存量均较大，经询问领导后，不做变动
        require_once(__SITEROOT.'library/Models/tb_yw_cwsyl.php');
        
        require_once(__SITEROOT.'library/Models/tb_yw_ywsrtj.php');
        
    }
}