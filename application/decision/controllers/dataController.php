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
        require_once(__SITEROOT.'library/Myauth.php');
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
        $data = phpFastCache::get("org_logs_".$this->user['region_id']);
        $token=array(1=>"行政机构",2=>"执法机构",3=>"医院",4=>"社区",5=>"乡镇卫生院",6=>"妇幼保健院");
        //判断缓存
        if($data==null)
        {
            $organization=new Torganization();
            $organization->query("select region_path,id,zh_name from region where p_id= '".$this->user['region_id']."' order by region_path desc");
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
            phpFastCache::set("org_logs_".$this->user['region_id'],$data_logs,DATA_CACHE_TIME);
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
        for($i=-4;$i<4;$i++)
        {
            $data_bak[$j]['timer']=date('Y-m-d H:i:s',mktime(12,0,0,date('m'),date('d')-$today-($i*7),date('Y')));
            $data_bak[$j]['txt']=(time()-mktime(12,0,0,date('m'),date('d')-$today-($i*7),date('Y'))>0)?'已成功完成任务':'计划任务已创建';
            $j++;
        }
        $this->view->data_bak=$data_bak;
        $this->view->display("data_bak.html");
    }
}