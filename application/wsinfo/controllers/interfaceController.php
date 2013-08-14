<?php
/** 
 * @author whx
 * @created 2012-6-25
 */
    class wsinfo_interfaceController extends controller{
        public function init(){
            require_once __SITEROOT.'library/Models/api_module.php';
            require_once __SITEROOT.'application/wsinfo/models/createColumn.php';
            require_once __SITEROOT.'library/custom/comm_function.php';
            $this->view->basePath = __BASEPATH;
        }
        public function indexAction(){
            require_once __SITEROOT."/library/Models/staff_core.php";
            require_once __SITEROOT."/library/custom/pager.php";//引入分页处理文件
            $currentPage = intval($this->_request->getParam('page'));
            $realPage    = empty($currentPage)?1:$currentPage;
            $modu=new Tapi_module();
            $staff_core=new Tstaff_core();
            $count=$modu->count();
            $arrArg = array();
            $links = new SubPages(__ROWSOFPAGE,$count,$realPage,__goodsListRowOfPage,__BASEPATH.'wsinfo/interface/index/module_search/'.'/table_search/'.'/page/',3,$arrArg);
            $pageCurrent = $links->check_page($realPage);//检查当前页数是否合法
            $startnum = __ROWSOFPAGE*($pageCurrent-1);  //计算开始记录数
            $modu->limit($startnum,__ROWSOFPAGE);
            $modu->find();
            $i=0;
            $rows=array();
            while($modu->fetch())
            {   
            
                $rows[$i]['uuid']=$modu->uuid;
                $rows[$i]['module_name']=$modu->module_name;
                $rows[$i]['order_by']=$modu->order_by;
                $rows[$i]['created']= date("y-m-d",$modu->created);
                $rows[$i]['xml_template']=substr($modu->xml_template->load(),1,20)."...";
                $staff_core->where("id='$modu->staff_id'");
               // $staff_core->debug(1);
                $staff_core->find(true);
                $rows[$i]['staff_name']=$staff_core->name_login;
               // print_r($staff_core->toArray());exit();
                $i++;
            }
          
           $page = $links->subPageCss2();
           $this->view->page        = $page;
           $this->view->pageCurrent = $pageCurrent;
           $this->view->rows=$rows;
           $this->view->display("module_list.html");
        }
        public function module_addAction(){
$module=new Tapi_module();
           //获取表单传值
           $module->module_name=$this->_request->getParam("module_name");
           $module->xml_template=$this->_request->getParam("xml_template");
           $module->order_by=$this->_request->getParam("order_by");
           $action=$this->_request->getParam("action"); 
           if($action=="edit"){
               $module_id=$this->_request->getParam("uuid");//获取模块id,获取到了则说明是更新操作
               //echo $module_id;exit();
               $module->whereAdd("uuid='$module_id'");
               $module->find();
               while($module->fetch()){
               $this->view->module_name=$module->module_name;
               $this->view->xml_template=$module->xml_template->load();
               $this->view->order_by=$module->order_by;
               $this->view->staff_id=$module->staff_id;
               $this->view->uuid=$module->uuid;
               }
           }
           if($action=="提交")
           {
               $module_id=$this->_request->getParam("module_id");
               //更新操作
               if($module_id)
               {  
                   $module->whereAdd("uuid='$module_id'");
                   $module->staff_id=$_SESSION['Zend_Auth']['storage']['uuid'];
                   $module->update();
                   message("更新成功");exit();
               }
               //添加操作
               else  
               {
                   $module->uuid=uniqid();
                   $module->created=strtotime("now");
                   $module->staff_id=$_SESSION['Zend_Auth']['storage']['uuid'];
                   //插入记录
                   if($module->insert()){
                   message("添加成功");exit();
                   }
               }
           
           } 
           
            $this->view->display("module_add.html");
        }
        public function delAction(){
            $module=new Tapi_module();
            $module_id=$this->_request->getParam("module_id");
            
            if($module_id)
            {
                $module->whereAdd("uuid='$module_id'");
                if($module->delete()){
                    $this->redirect(__BASEPATH.'wsinfo/interface/index/page/'.$currentpage.'/module_search/'.$module_search.'/table_search/'.$table_search);
                }
               
            }
        }
        //xml语法高亮
        public function xml_highlight($s) {
            $s = preg_replace("|<(.*)>|isU", "[1]<[2]\\1[/2]>[/1]", $s);
            $s = preg_replace("|</(.*)>|isU", "[1]</[2]\\1[/2]>[/1]", $s);
            $s = preg_replace("|<\?(.*)\?>|isU","[3]<?\\1?>[/3]", $s);
            $s = preg_replace("|\=\"(.*)\"|isU", "[6]=[/6][4]\"\\1\"[/4]",$s );
            $s = htmlspecialchars($s);
            $s = str_replace("\t","&nbsp;&nbsp;",$s);
            $s = str_replace(" ","&nbsp;",$s);
            $replace=array(1=>"0000ff",2=>"0000ff",3=>"800000",4=>"ff00ff",5=>"ff0000",6=>"0000ff");
            foreach($replace as $k=>$v) {
            $s = preg_replace("|\[".$k."\](.*)\[/".$k."\]|isU", "<font color=\"#".$v."\">\\1</font>", $s);
      }  
           $s = '<pre>'.$s.'</pre>';
           return nl2br($s);
}
        
        
        //处理ajax请求
        public function load_xmlAction(){
            $module_id=$this->_request->getParam("module_id");
            $module=new Tapi_module();
            $module->where("uuid='$module_id'");
            $module->find(true);
            $xml=$module->xml_template->load();
            print_r($this->xml_highlight($xml));
            exit();
        }
    }
?>