<?php
/**
 * 用于微信中的慢病每日提醒中的列表
 */
class weixin_mbController extends controller
 {
      public function init()
      {   
          require_once __SITEROOT.'application/weixin/model/__autoload.php';//自动加载数据库模型类
          $this->view->basePath     =  __BASEPATH;
      }
     /**
      * 用于手机列表模块 慢病工作计划列表
      * 取得微信模块列表中的慢病工作计划列表
      */
      public  function  indexAction()
      {
          $end_tag = false;
          $org = $this->_request->getParam('org');
          $num=$this->_request->getparam("num");
          $num = $num?$num:0;  
          //定义一个慢病数组
          $mb_type = array(1,2,3);
          $mb_select = '';
          foreach($mb_type as $v)
          {
              $mb_select.="tips.tips_type='$v' or";
          }
           $mb_select = rtrim($mb_select,'or');
          if(!empty($org))
          {
              //通过机构微信号找机构ID
              $setorg = new Tweixin_setorg();
              $setorg->whereAdd("account_name='$org'");
              $setorg->find(true);
              $org_id = $setorg->org_id;
              //取得机构的管辖路径
              $organization = new Torganization();
              $organization->whereAdd("id=$org_id");
              $organization->find(true);
              $region_path_domain = $organization->region_path_domain;
              $select_str = '';
              $region_path_domain_array = explode('|', $region_path_domain);
              foreach($region_path_domain_array as $k=>$v)
              {
                   $select_str.=" individual_core.region_path like '$v%' or";
              }
              $region_select = rtrim($select_str, 'or');
              //取得列表
              $row = array();
              $search = array();
              $count = 0;
              $tips = new Ttips();
              $tips->query("select  count(tips.id) as cou from tips where tips.id in (select individual_core.uuid from individual_core where $region_select) ");
              $tips->fetch();
              $nums =  $tips->cou;
              $rowspage = 8;
              $current_num=$num+$rowspage;
              $tips->query("select * from (SELECT A.*, ROWNUM RN from (select  tips.uuid,tips.id,tips.tips_time,tips.tips_complete_time,tips.tips_serial,tips.title  from tips where tips.id in (select individual_core.uuid from individual_core where $region_select) order by tips.tips_time DESC ) A WHERE ROWNUM <= ".$rowspage." )  where RN>=$num");
             // echo "select * from (SELECT A.*, ROWNUM RN from (select  tips.uuid,tips.id,tips.tips_time,tips.tips_complete_time,tips.tips_serial,tips.title  from tips where tips.id in (select individual_core.uuid from individual_core where $region_select) ) A WHERE ROWNUM <= ".__ROWSOFPAGE." )  where RN>=$num";
              while($tips->fetch())
              {
                  //取得居民的姓名，家庭住址
                  $individual_core = new Tindividual_core;
                  $individual_core->whereAdd("uuid='$tips->id'");
                  $individual_core->find(true);
                  $title = $tips->title;
                  $row[$count]['name'] = $individual_core->name.$title;
                  $row[$count]['uuid'] = $tips->uuid;
                  $count++;
              }
             if(!($current_num>=$nums))
              {	
                  $this->view->num=$current_num;
              }
              $this->view->row = $row;
              $this->view->end_tag = $end_tag;
          }
          $this->view->display("list.html");
      }
      /**
       * 取得工作计划的详细内容
       */
      public function detailAction()
      {
          $uuid = $this->_request->getParam("uuid");
          if(!empty($uuid))
          {
              $tips = new Ttips;
              $individual_core = new Tindividual_core;
              $tips->joinAdd('inner', $tips, $individual_core, 'id','uuid');
              $tips->whereAdd("tips.uuid='$uuid'");
              $tips->find(true);
              $this->view->name = $individual_core->name;
              $this->view->address = $individual_core->address;
              $staff_core = new Tstaff_core;
              $staff_core->whereAdd("id='$tips->tips_serial'");
              $staff_core->find(true);
              $this->view->staff_name = $staff_core->name_login;
              $this->view->address = $individual_core->address;
              $this->view->title = $tips->title;
              $this->view->tips_time = date("Y-m-d",$tips->tips_time);//计划处理时间
              $this->view->tips_complete_time = date("Y-m-d",$tips->tips_complete_time);//计划完成时间
              $this->view->display('detail.html');
          }
      }
 }
?>
