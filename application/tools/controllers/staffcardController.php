<?php
/**
 * tools_staffcardController
 * 
 * 处理空身份证号码的医生，将uuid加密后，写入到身份证字段
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class tools_staffcardController extends controller
{
    public function init()
    {
        
    }
    public function indexAction()
    {
        require_once __SITEROOT.'library/Models/staff_archive.php';
        $staff_archive=new Tstaff_archive();
        $staff_archive->whereAdd("identity_card_number is null");
        $staff_archive->find();
        $i=0;
        while($staff_archive->fetch())
        {
            $staff=new Tstaff_archive();
            $staff->identity_card_number=base64_encode($staff_archive->user_id);
            $staff->whereAdd("user_id='".$staff_archive->user_id."'");
            $staff->update();
            $staff->free_statement();
            $i++;
        }
        $staff_archive->free_statement();
        echo '已刷新'.$i.'个空身份证医生';
    }
}