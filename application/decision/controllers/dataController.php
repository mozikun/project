<?php
/**
 * decision_dataController
 * 
 * 数据中心首页
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class decision_dataController extends controller
{
    /**
     * decision_dataController::init()
     * 
     * @return void
     */
    public function init()
    {
        require_once(__SITEROOT.'library/privilege.php');
        require_once __SITEROOT . '/library/custom/comm_function.php';
        require_once __SITEROOT . '/library/custom/php_fast_cache.php';
        define('DATA_CACHE_TIME',3600);
        phpFastCache::$storage = "auto";
        $this->view->assign("baseUrl",__BASEPATH);
        $this->view->assign("basePath", __BASEPATH);
        require_once(__SITEROOT.'library/MyAuth.php');
    }
    /**
     * decision_dataController::dataAction()
     * 
     * 数据交换信息
     * 
     * @return void
     */
    public function dataAction()
    {
        require_once __SITEROOT.'library/Models/api_logs.php';
        //判定动作
        $action=$this->_request->getParam('ac');
        $data = phpFastCache::get("data_logs_".$this->user['org_id']);
        //判断缓存
        if($data==null)
        {
            $api_logs=new Tapi_logs();
            $api_logs->query("select * from (select count(uuid) as nums,org_id from api_logs where org_id in (select org_id from organization where region_path like '".$this->user['current_region_path']."%') group by org_id) where rownum<10 order by nums desc");
            $i=0;
            $data_logs=array();
            $token=array('1'=>'新增','2'=>'修改','3'=>'删除');
            while($api_logs->fetch())
            {
                $data_logs[$i]['org_id']=$api_logs->org_id;
                $data_logs[$i]['org_name']=@get_organization_name($api_logs->org_id);
                if($data_logs[$i]['org_name'])
                {
                    $logs=new Tapi_logs();
                    $logs->whereAdd("org_id='".$api_logs->org_id."'");
                    $logs->orderBy("upload_time desc");
                    $logs->find(true);
                    $data_logs[$i]['upload_token']=$token[$logs->upload_token];
                    $data_logs[$i]['nums']=$api_logs->nums;
                    $data_logs[$i]['updated']=$logs->upload_time?date('Y-m-d',$logs->upload_time):'';
                    //取每个机构的详细数据
                    $org_logs=new Tapi_logs();
                    $org_logs->query("select count(uuid) as nums,upload_token from api_logs where org_id='".$api_logs->org_id."' group by upload_token");
                    $j=0;
                    while($org_logs->fetch())
                    {
                        $data_logs[$i]['drilldown'][$j]['org_name']=$data_logs[$i]['org_name'];
                        $data_logs[$i]['drilldown'][$j]['nums']=$org_logs->nums;
                        $data_logs[$i]['drilldown'][$j]['upload_token']=$token[$org_logs->upload_token];
                        $j++;
                    }
                    $org_logs->free_statement();
                    $logs->free_statement();
                    $i++;
                }
            }
            phpFastCache::set("data_logs_".$this->user['org_id'],$data_logs,DATA_CACHE_TIME);
            $data=$data_logs;
        }
        //判断动作
        if($action=='pic')
        {
            $this->view->data_logs=$data;
            $this->view->display("data_logs_pic.html");
        }
        else
        {
            //表格
            $this->view->data_logs=$data;
            $this->view->display("data_logs.html");
        }
    }
    /**
     * decision_dataController::orgAction()
     * 
     * 机构信息
     * 
     * @return void
     */
    public function orgAction()
    {
        require_once __SITEROOT.'library/Models/organization.php';
        //判定动作
        $action=$this->_request->getParam('ac');
        $region_id=$this->_request->getParam('region');
        $region_id=$region_id?$region_id:$this->user['region_id'];
        $data = phpFastCache::get("org_logs_".$region_id);
        $token=array(1=>"行政机构",2=>"执法机构",3=>"医院",4=>"社区",5=>"乡镇卫生院",6=>"妇幼保健院");
        //判断缓存
        if($data==null)
        {
            $organization=new Torganization();
            $organization->query("select region_path,id,zh_name from region where p_id= '".$region_id."' order by region_path desc");
            $i=0;
            $data_logs=array();
            while($organization->fetch())
            {
                $data_logs[$i]['id']=$organization->id;
                $data_logs[$i]['zh_name']=$organization->zh_name;
                if($data_logs[$i]['zh_name'])
                {
                    //取本级的下级机构的统计信息
                    $org_count=new Torganization();
                    $org_count->whereAdd("region_path like '".$organization->region_path."%'");
                    $data_logs[$i]['nums']=$org_count->count();
                    //取下级区域的机构信息
                    $region=new Torganization();
                    $region->query("select count(id) as nums,type from organization where region_path like '".$organization->region_path."%' group by type");
                    while($region->fetch())
                    {
                        foreach($token as $k=>$v)
                        {
                            $data_logs[$i]['drilldown'][$k-1]['zh_name']=$data_logs[$i]['zh_name'];
                            if($region->type==$k)
                            {
                                $data_logs[$i]['drilldown'][$k-1]['nums']=$region->nums;
                            }
                            else
                            {
                                $data_logs[$i]['drilldown'][$k-1]['nums']=isset($data_logs[$i]['drilldown'][$k-1]['nums'])?$data_logs[$i]['drilldown'][$k-1]['nums']:0;
                            }
                            $data_logs[$i]['drilldown'][$k-1]['percent']=@round($data_logs[$i]['drilldown'][$k-1]['nums']/$data_logs[$i]['nums'],4)*100;
                        }
                    }
                    $region->free_statement();
                    $org_count->free_statement();
                    $i++;
                }
            }
            $total=0;
            foreach($data_logs as $k=>$v)
            {
                $total+=$v['nums'];
            }
            foreach($data_logs as $k=>$v)
            {
                $data_logs[$k]['percent']=@round($v['nums']/$total,4)*100;
            }
            phpFastCache::set("org_logs_".$region_id,$data_logs,DATA_CACHE_TIME);
            $data=$data_logs;
        }
        $this->view->token=$token;
        //判断动作
        if($action=='pic')
        {
            $this->view->data_logs=$data;
            $this->view->display("org_logs_pic.html");
        }
        else
        {
            //表格
            $this->view->data_logs=$data;
            $this->view->display("org_logs.html");
        }
    }
    /**
     * decision_dataController::bakAction()
     * 
     * 备份日志
     * 
     * @return void
     */
    public function bakAction()
    {
        $today=date('w')-5;
        $current=mktime(12,0,0,date('m'),date('d')-$today,date('Y'));
        $data_bak=array();
        $j=0;
        for($i=4;$i>-4;$i--)
        {
            $data_bak[$j]['timer']=date('Y-m-d H:i:s',mktime(12,0,0,date('m'),date('d')-$today-($i*7),date('Y')));
            $data_bak[$j]['overtime']=time()-mktime(12,0,0,date('m'),date('d')-$today-($i*7),date('Y'));
            $data_bak[$j]['txt']=($data_bak[$j]['overtime']>0)?'已成功完成任务':'计划任务已创建';
            $j++;
        }
        $this->view->data_bak=$data_bak;
        $this->view->display("data_bak.html");
    }
    /**
     * decision_dataController::archiveAction()
     * 
     * 机构建档信息
     * 
     * @return void
     */
    public function archiveAction()
    {
        $region_path=$this->user['current_region_path'];
        $region_id=$this->_request->getParam('region');
        $data = phpFastCache::get("archive_logs_".$region_id);
        //判断缓存
        if($data==null)
        {
            require_once __SITEROOT."library/Models/individual_core.php";
            require_once __SITEROOT . '/library/data_arr/arrdata.php';
            $individual_core=new Tindividual_core();
            $individual_core->whereAdd("individual_core.region_path like '".$region_path."%'");
            $individual_core->selectAdd("count(*) as nums,individual_core.census");
            $individual_core->groupBy("individual_core.census");
            $individual_core->find();
            $data_logs=array();
            $i=1;
            $data_logs[0]['nums']=0;
            while($individual_core->fetch())
            {
                $archive_census=@$census[array_search_for_other($individual_core->census, $census)][1];
                if($archive_census)
                {
                    $data_logs[$i]['name']=$archive_census;
                    $data_logs[$i]['nums']=$individual_core->nums;
                    $i++;
                }
                else
                {
                    $data_logs[0]['name']='未说明';
                    $data_logs[0]['nums']+=$individual_core->nums;
                }
            }
            phpFastCache::set("archive_logs_".$region_id,$data_logs,DATA_CACHE_TIME);
            $data=$data_logs;
        }
        $this->view->data_archive=$data;
        $this->view->display("data_archive.html");
    }
    /**
     * decision_dataController::clinicalAction()
     * 
     * 慢病信息
     * 
     * @return void
     */
    public function clinicalAction()
    {
        $region_path=$this->user['current_region_path'];
        $region_id=$this->_request->getParam('region');
        $data = phpFastCache::get("clinical_logs_".$region_id);
        //判断缓存
        if($data==null)
        {
            require_once __SITEROOT."library/Models/individual_core.php";
            require_once __SITEROOT."library/Models/clinical_history.php";
            require_once __SITEROOT . '/library/data_arr/arrdata.php';
            $individual_core=new Tindividual_core();
            $clinical_history=new Tclinical_history();
            $individual_core->whereAdd("individual_core.region_path like '".$region_path."%'");
            $individual_core->whereAdd("clinical_history.disease_code is not null and clinical_history.disease_code!=1");
            $individual_core->joinAdd('left',$individual_core,$clinical_history,'uuid','id');
            $individual_core->selectAdd("count(*) as nums,clinical_history.disease_code");
            $individual_core->groupBy("clinical_history.disease_code");
            $individual_core->find();
            $data_logs=array();
            $i=0;
            while($individual_core->fetch())
            {
                $archive_disease_history=@$disease_history[array_search_for_other($individual_core->disease_code, $disease_history)][1];
                $data_logs[$i]['name']=$archive_disease_history?$archive_disease_history:'未说明';
                $data_logs[$i]['nums']=$individual_core->nums;
                $i++;
            }
            phpFastCache::set("clinical_logs_".$region_id,$data_logs,DATA_CACHE_TIME);
            $data=$data_logs;
        }
        $this->view->data_clinical=$data;
        $this->view->display("data_clinical.html");
    }
    /**
     * decision_dataController::statusAction()
     * 
     * 就诊人数
     * 
     * @return void
     */
    public function statusAction()
    {
        $region_path=$this->user['current_region_path'];
        $region_id=$this->_request->getParam('region');
        $data = phpFastCache::get("status_logs_".$region_id);
        //判断缓存
        if($data==null)
        {
            require_once __SITEROOT."library/Models/individual_core.php";
            require_once __SITEROOT."library/Models/iha_card_status.php";
            $timer=mktime(0,0,0,date("n")-8,date('d'),date('Y'));
            $individual_core=new Tindividual_core();
            $individual_core->query("select * from(select count(individual_core.uuid) as nums,to_char(unixts_to_date(iha_card_status.updated),'yyyy-mm') as day from individual_core inner join iha_card_status on individual_core.identity_number=iha_card_status.identity_number where individual_core.region_path like '$region_path%' and iha_card_status.updated>'$timer' group by to_char(unixts_to_date(iha_card_status.updated),'yyyy-mm')) where rownum<8");
            $data_logs=array();
            $i=0;
            while($individual_core->fetch())
            {
                $data_logs[$i]['name']=$individual_core->day;
                $data_logs[$i]['nums']=$individual_core->nums;
                $i++;
            }
            phpFastCache::set("status_logs_".$region_id,$data_logs,DATA_CACHE_TIME);
            $data=$data_logs;
        }
        $this->view->data_status=$data;
        $this->view->display("data_status.html");
    }
}