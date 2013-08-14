<?php
 class tools_sgbController extends controller 
 {
 	public function init()
 	{
 		 require_once __SITEROOT . "library/Models/individual_core.php";
 		 require_once __SITEROOT . "library/Models/region.php";
 	}

    public function indexAction()
    {
        //取这个人的region_path,然后找region表中等于这个region_path的这条数据的p_id 再取region表id=p_id的这条数据然后替换掉
        $limit=1000;
        $current=$this->_request->getParam('page');
        $current=$current?$current:1;
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("LENGTH(standard_code_1)<20");
        $total=$individual_core->count();
        $individual_core->free_statement();
        $individual_core = new Tindividual_core();
        $individual_core->whereAdd("LENGTH(standard_code_1)<20");
        $start_num=$limit*($current-1);
        $individual_core->limit($start_num,$limit);
        $individual_core->find();
        while($individual_core->fetch())
        {
//        	echo $individual_core->standard_code_1;
//        	exit();
            $region = new Tregion();
            $region->whereAdd("region_path='$individual_core->region_path'");
            $region->find(true);
            
            $region->free_statement();
            $region_new = new Tregion();
            $region_new->whereAdd("id='$region->p_id'");
            $region_new->find(true);
            //取得国标
            $standard_code_1 = $individual_core->standard_code_1;
            $standard_code_array = explode('-',$standard_code_1);
            //替换掉第3维那个不能使用替换函数
            $standard_code_array[2]=$region_new->standard_code;
            $str = implode('-',$standard_code_array);
//            echo $str.'<br />';
//            echo $standard_code_1;
            //更新这个人的数据
            $region_new->free_statement();
            $core = new Tindividual_core();
            $core->whereAdd("uuid='$individual_core->uuid'");
            $core->standard_code_1 = $str;
            //$core->update();
            //exit();
        }
        $individual_core->free_statement();
        $current++;
        if($total>$start_num)
        {
            echo "<font color=red>正在操作，共有{$total}待转换档案，当前第".$start_num."条...</font>";
       	    echo "<script>
    
    				var pgo=0;
    
          			function JumpUrl(){
    
            		if(pgo==0){ location='/tools/sgb/index/page/{$current}'; pgo=1; }
    
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
    /**
     * 现 从individual_core表中重建一字段 取名 standard_code_1_1(用于存放以前的国标号)
     * 然后将以前存放国标号的字段内容改成新刷的
     * 格式
     * 区（区县-乡镇-村委会-村委会的第几个人）
     */
    public function sgbAction()
    {
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
           $standard_code_array = array();
           //echo $individual_core->region_path.'<br />';
           //取得每个人的region_path
           $region_array = explode(',',$individual_core->region_path);
           $count = count($region_array);
           if(empty($region_array[4])||empty($region_array[5])||empty($region_array[6]))
           {
           	//有为空的出现
           	 continue;
           }
           else 
           {
         	  $first_code =  $this->get_standard_code($region_array[4]);//县区
         	  $second_code =  $this->get_standard_code($region_array[5]);//乡镇
         	  $third_code =  $this->get_standard_code($region_array[6]);//村
         	  //取当前这级的region_path 再取得上一级的region_path
              unset($region_array[$count-1]);//不要最后一维
              $real_region = implode(',',$region_array); 
         	  $region_r  = new Tindividual_core();
         	  $region_r->selectAdd('max(region_inner_id) as region_inner_id');
              $region_r->whereAdd("region_path like '$real_region%'");
              $region_r->find(true);
              if ($region_r->region_inner_id != '') 
              {
                 $region_path_inner_id = $region_r->region_inner_id + 1;
              } 
              else 
              {
                $region_path_inner_id = 1;
              }
              //STANDARD_CODE_1_1   REGION_INNER_ID
              $update_individual = new Tindividual_core();
              $update_individual->whereAdd("uuid='$individual_core->uuid'");
              $update_individual->region_inner_id = $region_path_inner_id;
              $region_path_inner_id = str_repeat('0', 5 - strlen($region_path_inner_id)).$region_path_inner_id;
              $real_str = $first_code.'-'.$second_code.'-'.$third_code.'-'.$region_path_inner_id;
              $update_individual->standard_code_1_1  = $real_str;
              $update_individual->update();
              $update_individual->free_statement();
           }
           
           //echo $first_code.'-'.$second_code.'-'.$third_code.'<br />';
        }
        $individual_core->free_statement();
        $current++;
        if($total>$start_num)
        {
            echo "<font color=red>正在操作，共有{$total}待处理，当前第".$start_num."条...</font>";
       	    echo "<script>
    
    				var pgo=0;
    
          			function JumpUrl(){
    
            		if(pgo==0){ location='/tools/sgb/sgb/page/{$current}'; pgo=1; }
    
          			}
    
    				setTimeout('JumpUrl()',0);
    
    				</script>";
       	    exit;
        }
        else
        {
            exit('处理完成');
        }
    }
    /**
     * 通过regionid 取得region的standard_code
     *
     * @param unknown_type $id
     * @return unknown
     */
    public function get_standard_code($id)
    {
    	$region = new Tregion();
    	$region->whereAdd("id='$id'");
    	$region->find(true);
    	return $region->standard_code;
    }
}
