<?php
/**
 * tools_daztController
 * 
 * 用于将个人档案的状态刷新到新的状态表中
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class tools_daztController extends controller
{
    public function init()
    {
        
    }
    public function indexAction()
    {
        require_once __SITEROOT . "library/Models/individual_core.php";
        require_once __SITEROOT . "library/Models/individual_status.php";
        //每次刷新多少条
        $limit=1000;
        $current=$this->_request->getParam('page');
        $current=$current?$current:1;
        $individual_core = new Tindividual_core();
        $total=$individual_core->count();
        $individual_core->free_statement();
        $individual_core = new Tindividual_core();
        $start_num=$limit*($current-1);
        $individual_core->limit($start_num,$limit);
        $individual_core->find();
        while($individual_core->fetch())
        {
            $individual_status=new Tindividual_status();
            $individual_status->whereAdd("id='".$individual_core->uuid."'");
            if($individual_status->count())
            {
                continue;
            }
            else
            {
                $individual_status=new Tindividual_status();
                $individual_status->uuid=uniqid('sta_',true);
                $individual_status->staff_id=$individual_core->staff_id;
                $individual_status->id=$individual_core->uuid;
                $individual_status->created=time();
                $individual_status->updated=time();
                $individual_status->status_time=$individual_core->filing_time?$individual_core->filing_time:$individual_core->updated;
                $individual_status->status_flag=1;
                $individual_status->insert();
                $individual_status->free_statement();
            }
        }
        $individual_core->free_statement();
        $current++;
        if($total>$start_num)
        {
            echo "<font color=red>正在操作，共有{$total}待转换档案，当前第".$start_num."条...</font>";
       	    echo "<script>
    
    				var pgo=0;
    
          			function JumpUrl(){
    
            		if(pgo==0){ location='/tools/dazt/index/page/{$current}'; pgo=1; }
    
          			}
    
    				setTimeout('JumpUrl()',0);
    
    				</script>";
       	    exit;
        }
        else
        {
            exit('已完成任务');
        }
        
    }
}