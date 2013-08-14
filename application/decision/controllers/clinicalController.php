<?php
/**
*@author：我好笨
*@filename: clinicalController.php
*@package：用于完成慢病综合统计，满足CDC类似统计需求，按性别、年龄段、职业分类统计，可选统计时间
*@email：4049054@qq.com
*@create：2011-12-29
*/
class decision_clinicalController extends controller{
	/**
	 * 自动加载
	 */
	public function init(){
		$this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."library/Models/individual_core.php";
        require_once __SITEROOT."library/Models/individual_archive.php";
		require_once __SITEROOT."library/Models/clinical_history.php";
		require_once __SITEROOT."library/Models/region.php";
		$this->view->basePath = $this->_request->getBasePath();
	}
	/**
	 * 主控制器
	 * 用于列表
	 */
	public function indexAction()
	{
		$model = $this->_request->getParam('model','');//慢病分类
        $this->view->model		=$model;
        $clinical_array=array('hy'=>'2','di'=>'3','sc'=>'8');//取慢病模块名前两位作为数组索引，值为慢病代码
        $titles=array('2'=>'高血压','3'=>'II型糖尿病','8'=>'重型精神分裂');
        $disease_code=2;//默认高血压
        if(!isset($clinical_array[$model]))
        {
            //错误的慢病分类
            exit('错误的慢病分类');
        }
        else
        {
            $disease_code=$clinical_array[$model];
        }
        //获取统计类型
        $type=$this->_request->getParam('type','');//sex按性别统计;occupation按职业统计;age按年龄段统计
        $this->view->type		=$type;
        $dic_array=array();
        require_once __SITEROOT.'/library/data_arr/arrdata.php';
        if($type=='' || !in_array($type,array('sex','occupation','age')))
        {
            //错误的统计类型
            exit('错误的统计类型');
        }
        else
        {
            if($type=='age')
            {
                //按年龄段统计时，无数据字典，需要构建一个数据字典数组
                $dic_array=array('1'=>array('1','0-10岁'),'2'=>array('2','11-20岁'),'3'=>array('3','21-30岁'),'4'=>array('4','31-40岁'),'5'=>array('5','41-50岁'),'6'=>array('6','51-60岁'),'7'=>array('7','61-70岁'),'8'=>array('8','71-80岁'),'9'=>array('9','81-90岁'),'10'=>array('10','91-100岁'),'11'=>array('11','其他'));
            }
            else
            {
                $dic_array=$$type;//数据字典数组
            }
        }
        //获取统计时间，默认一年
        $start_time=$this->_request->getParam('start_time')?$this->_request->getParam('start_time'):date("Y-m-d",adodb_mktime(0,0,0,date("n"),date("j"),date("Y")-1));
		$end_time=$this->_request->getParam('end_time')?$this->_request->getParam('end_time'):date("Y-m-d");
        $this->view->assign("start_time",$start_time);
        $this->view->assign("end_time",$end_time);
        //转换时间
        $time_start=mkunixstamp($start_time);
		$time_end=mkunixstamp($end_time);
		//获取需要添加类别的当前父ID
		$p_id = $this->_request->getParam('parent_id','');
		$regionDomain = $this->user['region_id'];
        $this->view->p_id		=$p_id;
		//echo $$regionDomain;
		$p_id = empty($p_id)?$regionDomain:$p_id;
		$this->view->caching		=__CACHING;//开启缓存
		$this->view->cache_lifetime	=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('list.html',$p_id.$model.$type.$start_time.$end_time))
		{
            //表格标题
            $table_title='<td colspan="'.(count($dic_array)*2+2).'" class="headbg">'.$titles[$disease_code].'</td>  
</tr> 
<tr ><td class="topbg">患病总人数</td>';
            foreach($dic_array as $k=>$v)
            {
                $table_title.='<td class="topbg">'.$v[1].'</td><td class="topbg">百分比('.$v[1].')</td>';
            }
            $table_title.='<td class="topbg">选项</td>';
			$errorMessage = $this->_request->getParam('errorMessage','');
			$regionDomain = $this->user['region_id'];
			$p_id = empty($p_id)?$regionDomain:$p_id;
			//列表显示父ID等于1但是ID不等于1的所有数据(不显示根)
			$this->view->basePath = $this->_request->getBasePath();
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			$region->find();
			$row = array();
			$rowCount = 0;//行数
			//小计所有用到的字段
            $table_body='';
            $total=array();
            $total_clinical_all=0;//所有患病的人的小计
			while($region->fetch()){
				$row[$rowCount]['id'] = trim($region->id);
				$row[$rowCount]['zh_name'] = $region->zh_name;
				$row[$rowCount]['region_path'] = $region->region_path;
				$row[$rowCount]['standard_code'] = $region->standard_code;
				$row[$rowCount]['p_id'] = trim($region->p_id);
				$row[$rowCount]['standard_code'] = trim($region->standard_code);
				$current_level = count(explode(',',$region->region_path));
                //显示建档机构名称
				if($current_level==6)
                {
                    require_once __SITEROOT."library/Models/organization.php";
                    $org=new Torganization();
					$org->whereAdd("region_path='$region->region_path'");
					$org->find(true);
					$row[$rowCount]['org_zh_name'] =$org->zh_name;
					$this->view->td_title='2';
				}
                //查询患病人数
                $individual_core=new Tindividual_core();
				$clinical_history=new Tclinical_history();
				$individual_core->joinAdd('inner',$individual_core,$clinical_history,'uuid','id');
                $individual_core->whereAdd("individual_core.region_path = '".$region->region_path."' or individual_core.region_path like '".$region->region_path.",%'");
                $individual_core->whereAdd("clinical_history.disease_date between $time_start and $time_end");
				$individual_core->whereAdd("clinical_history.disease_code='$disease_code'");
                //2012-02-21 我好笨 仅统计正常档案
                $individual_core->whereAdd("individual_core.status_flag=1");
                $total_clinical=0;
                $total_clinical=$individual_core->count('distinct individual_core.uuid');
                $total_clinical_all+=$total_clinical;
                $individual_core->free_statement();
                $table_body.='<tr><td class="t1">'.$region->zh_name.'</td>';
                $table_body.='<td class="t1">'.$total_clinical.'</td>';
                $num_array=array();
                foreach($dic_array as $k=>$v)
                {
                    $num_array[$v[0]]=0;
                    $total[$rowCount][$v[0]]=0;
                }
                if($type=='sex')
                {
    				//按性别和年龄段统计时统计表individual_core，按职业统计时统计表Individual_archive
    				$individual_core=new Tindividual_core();
    				$clinical_history=new Tclinical_history();
    				$individual_core->joinAdd('inner',$individual_core,$clinical_history,'uuid','id');
                    $individual_core->whereAdd("individual_core.region_path = '".$region->region_path."' or individual_core.region_path like '".$region->region_path.",%'");
    				$individual_core->whereAdd("clinical_history.disease_code='$disease_code'");
                    $individual_core->whereAdd("clinical_history.disease_date between $time_start and $time_end");
                    //2012-02-21 我好笨 仅统计正常档案
                    $individual_core->whereAdd("individual_core.status_flag=1");
    				$individual_core->selectAdd("count(distinct individual_core.uuid) as counter,individual_core.sex as sex");
                    $individual_core->groupBy('individual_core.sex');
                    $individual_core->find();
                    while($individual_core->fetch())
                    {
                        if($individual_core->sex!='' && $individual_core->sex!=4)
                        {
                            $num_array[$individual_core->sex]=$individual_core->counter;
                            $total[$rowCount][$individual_core->sex]=$individual_core->counter;
                        }
                        else
                        {
                            $num_array[4]+=$individual_core->counter;
                            $total[$rowCount][4]+=$individual_core->counter;
                        }
                    }
                    for($i=1;$i<=count($dic_array);$i++)
                    {
                        $table_body.='<td>'.(isset($num_array[$i])?$num_array[$i]:0).'</td>';
                        //百分比
                        $table_body.='<td>'.(@round(((isset($num_array[$i])?$num_array[$i]:0)/$total_clinical),4)*100).'</td>';
                    }
                    
                    $individual_core->free_statement();
                    $this->view->table_width='100%';
                }
                elseif($type=='occupation')
                {
                    //按职业统计时统计表Individual_archive
    				$individual_core=new Tindividual_core();
                    $individual_archive=new Tindividual_archive();
    				$clinical_history=new Tclinical_history();
                    $individual_core->joinAdd('inner',$individual_core,$individual_archive,'uuid','id');
    				$individual_core->joinAdd('inner',$individual_core,$clinical_history,'uuid','id');
                    //2012-02-21 我好笨 仅统计正常档案
                    $individual_core->whereAdd("individual_core.status_flag=1");
                    $individual_core->whereAdd("individual_core.region_path = '".$region->region_path."' or individual_core.region_path like '".$region->region_path.",%'");
    				$individual_core->whereAdd("clinical_history.disease_code='$disease_code'");
                    $individual_core->whereAdd("clinical_history.disease_date between $time_start and $time_end");
    				$individual_core->selectAdd("count(distinct individual_core.uuid) as counter,individual_archive.occupation as occupation");
                    $individual_core->groupBy('individual_archive.occupation');
                    $individual_core->find();
                    while($individual_core->fetch())
                    {
                        //为空值的放入不便分类的人群
                        if($individual_core->occupation!='' && $individual_core->occupation!=8)
                        {
                            $num_array[$individual_core->occupation]=$individual_core->counter;
                            $total[$rowCount][$individual_core->occupation]=$individual_core->counter;
                        }
                        else
                        {
                            $num_array[8]+=$individual_core->counter;
                            $total[$rowCount][8]+=$individual_core->counter;
                        }
                    }
                    for($i=1;$i<=count($dic_array);$i++)
                    {
                        $table_body.='<td>'.(isset($num_array[$i])?$num_array[$i]:0).'</td>';
                        //百分比
                        $table_body.='<td>'.(@round(((isset($num_array[$i])?$num_array[$i]:0)/$total_clinical),4)*100).'</td>';
                    }
                    $individual_core->free_statement();
                    $this->view->table_width='3000px';
                }
                elseif($type=='age')
                {
                    $individual_core=new Tindividual_core();
                    $sql_case='';
                    //因为是时间戳，构建查询条件
                    foreach($dic_array as $k=>$v)
                    {
                        if($k<count($dic_array))
                        {
                            $sql_case.=" when individual_core.date_of_birth<".(mktime(0,0,0,date("n"),date("j"),(date("Y")-($k-1)*10)))." and individual_core.date_of_birth>=".(mktime(0,0,0,date("n"),date("j"),date("Y")-($k*10)))." then '".$k."' ";
                        }
                        else
                        {
                            $sql_case.=" else '".$k."' ";
                        }
                    }
                    $individual_core->query("select nnd,count(distinct uuid) as counter from (select case $sql_case end as nnd,individual_core.uuid as uuid from individual_core inner join clinical_history on individual_core.uuid=clinical_history.id where individual_core.status_flag=1 and clinical_history.disease_code='$disease_code' and (individual_core.region_path = '".$region->region_path."' or individual_core.region_path like '".$region->region_path.",%') and clinical_history.disease_date between $time_start and $time_end) group by nnd");
    				while ($individual_core->fetch())
    				{
    				    $num_array[$individual_core->nnd]=$individual_core->counter;
                        $total[$rowCount][$individual_core->nnd]=$individual_core->counter;
                    }
                    for($i=1;$i<=count($dic_array);$i++)
                    {
                        $table_body.='<td>'.(isset($num_array[$i])?$num_array[$i]:0).'</td>';
                        //百分比
                        $table_body.='<td>'.(@round(((isset($num_array[$i])?$num_array[$i]:0)/$total_clinical),4)*100).'</td>';
                    }
                    $this->view->table_width='2000px';
                }
                else
                {
                    //错误的统计类型
                    exit('错误的统计类型');
                }
				if($current_level<6)
				{
					$this->view->td_title='1';
                    $table_body.='<td><a href="'.$this->_request->getBasePath().'decision/clinical/index/model/'.$model.'/type/'.$type.'/parent_id/'.$row[$rowCount]['id'].'/start_time/'.$start_time.'/end_time/'.$end_time.'">[进入子地区]</a></td></tr> ';
				}
				if($current_level==6){
					$this->view->td_title='2';
                    $table_body.='<td>&nbsp;</td></tr> ';
				}
				$rowCount++;
			}
            //小计
            $table_body.='<tr><td class="t1">小计</td><td class="t1">'.$total_clinical_all.'</td>';
            for($i=1;$i<=count($dic_array);$i++)
                {
                    $num_tmp=array();
                    foreach($total as $k=>$v)
                    {
                        @$num_tmp[$i]+=(isset($v[$i])?$v[$i]:0);
                    }
                    $table_body.='<td>'.(isset($num_tmp[$i])?$num_tmp[$i]:0).'</td>';
                    //百分比
                    $table_body.='<td>'.(@round(((isset($num_tmp[$i])?$num_tmp[$i]:0)/$total_clinical_all),4)*100).'</td>';
                }
            $table_body.='<td>&nbsp;</td></tr> ';
            $this->view->assign('table_title',$table_title);
            $this->view->assign('table_body',$table_body);
			$this->view->assign('row',$row);
			$this->view->assign('model',$model);
			$this->view->assign('add_need_id',$p_id);
			$this->view->assign('basePath',__BASEPATH);
			//获取所有path 根据登录者的地区id，限制导航条只能在该用户所在的区域内
			$pathSel = new Tregion();
			$pathSel->whereAdd("id='$p_id'");
			$pathSel->find(true);
			$currentPath = $pathSel->region_path;//处理path
			$nuNumber = strpos($currentPath,$regionDomain);
			$strNumber = intval(strlen($currentPath)-$nuNumber);
			$newCurrentPath = substr($currentPath,$nuNumber,$strNumber);
			$realPath = explode(',',$newCurrentPath);
			$realCount = count($realPath);
			$rs = array();
			$rsCount = 0 ;
			foreach ($realPath as $k=>$v){
				$realMenu = new Tregion();
				$realMenu->whereAdd("id='$v'");
				$realMenu->find(true);
                $realMenu->free_statement();
				$rs[$rsCount]['zh_name'] = $realMenu->zh_name;
				$rs[$rsCount]['id'] = trim($realMenu->id);
				$rs[$rsCount]['p_id'] = trim($realMenu->p_id);
				$rsCount++;
			}
			$this->view->assign('rs',$rs);
			//获取当前表中所有栏目内容(除去根)
			$length=count(explode(',',$pathSel->region_path));
			//echo $length;
			if($length<=4){
				$this->view->standard_code_size=6;
			}else{
				$this->view->standard_code_size=3;
			}
			$this->view->errorMessage=$errorMessage;
		}
		$this->view->display('list.html',$p_id.$model);
	}
    /**
     * decision_clinicalController::mapAction()
     * 
     * 地理分布统计
     * 
     * @return void
     */
    public function mapAction()
	{
		$model = $this->_request->getParam('model','');//慢病分类
        $this->view->model		=$model;
        $clinical_array=array('hy'=>'2','di'=>'3','sc'=>'8');//取慢病模块名前两位作为数组索引，值为慢病代码
        $titles=array('2'=>'高血压','3'=>'II型糖尿病','8'=>'重型精神分裂');
        $disease_code=2;//默认高血压
        if(!isset($clinical_array[$model]))
        {
            //错误的慢病分类
            exit('错误的慢病分类');
        }
        else
        {
            $disease_code=$clinical_array[$model];
        }
        require_once __SITEROOT.'/library/data_arr/arrdata.php';
        //获取统计时间，默认一年
        $decision_time=$this->_request->getParam('decision_time');
        //接受Post的时间，防止参数冲突
        $end_time=$this->_request->getParam('end_time');
        $decision_time=$end_time?strtotime($end_time)+(3600*24-1):($decision_time?strtotime($decision_time)+(3600*24-1):time());
        $this->view->decision_time=date('Y-m-d',$decision_time);
        //2012-11-08新增
        $start_time=$this->_request->getParam('start_time');
        //通过url传递的开始时间
        $url_start_time=$this->_request->getParam('url_start_time');
        $start_time=$start_time?strtotime($start_time):($url_start_time?strtotime($url_start_time):mktime(0,0,0,1,1,date('Y',$decision_time)));
        $this->view->start_time=date('Y-m-d',$start_time);
        //转换时间
        $time_start=$start_time;
		$time_end=$decision_time;
		//获取需要添加类别的当前父ID
		$p_id = $this->_request->getParam('parent_id','');
		$regionDomain = $this->user['region_id'];
        $this->view->p_id		=$p_id;
		//echo $$regionDomain;
		$p_id = empty($p_id)?$regionDomain:$p_id;
		$this->view->caching		=__CACHING;//开启缓存
		$this->view->cache_lifetime	=__CACHING_LEFTTIME;//缓存时间
		if(!$this->view->is_cached('map.html',$p_id.$model.$time_start.$time_end))
		{
            //表格标题
            $table_title='<td colspan="2" class="headbg">'.$titles[$disease_code].'</td>  
</tr> 
<tr ><td class="topbg">患病总人数</td>';
            $table_title.='<td class="topbg">选项</td>';
			$errorMessage = $this->_request->getParam('errorMessage','');
			$regionDomain = $this->user['region_id'];
			$p_id = empty($p_id)?$regionDomain:$p_id;
			//列表显示父ID等于1但是ID不等于1的所有数据(不显示根)
			$this->view->basePath = $this->_request->getBasePath();
			$region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("p_id='$p_id'");
			$region->orderby('id asc');
			$region->find();
			$row = array();
			$rowCount = 0;//行数
			//小计所有用到的字段
            $table_body='';
            $total=array();
            $total_clinical_all=0;//所有患病的人的小计
			while($region->fetch()){
				$row[$rowCount]['id'] = trim($region->id);
				$row[$rowCount]['zh_name'] = $region->zh_name;
				$row[$rowCount]['region_path'] = $region->region_path;
				$row[$rowCount]['standard_code'] = $region->standard_code;
				$row[$rowCount]['p_id'] = trim($region->p_id);
				$row[$rowCount]['standard_code'] = trim($region->standard_code);
				$current_level = count(explode(',',$region->region_path));
                //显示建档机构名称
				if($current_level==6)
                {
                    require_once __SITEROOT."library/Models/organization.php";
                    $org=new Torganization();
					$org->whereAdd("region_path='$region->region_path'");
					$org->find(true);
					$row[$rowCount]['org_zh_name'] =$org->zh_name;
					$this->view->td_title='2';
				}
                //查询患病人数
                $individual_core=new Tindividual_core();
				$clinical_history=new Tclinical_history();
				$individual_core->joinAdd('inner',$individual_core,$clinical_history,'uuid','id');
                $individual_core->whereAdd("individual_core.region_path = '".$region->region_path."' or individual_core.region_path like '".$region->region_path.",%'");
                $individual_core->whereAdd("clinical_history.disease_date between $time_start and $time_end");
				$individual_core->whereAdd("clinical_history.disease_code='$disease_code'");
                //2012-02-21 我好笨 仅统计正常档案
                $individual_core->whereAdd("individual_core.status_flag=1");
                $total_clinical=0;
                $total_clinical=$individual_core->count('distinct individual_core.uuid');
                $total_clinical_all+=$total_clinical;
                $individual_core->free_statement();
                $table_body.='<tr><td class="t1">'.$region->zh_name.'</td>';
                $table_body.='<td class="t1">'.$total_clinical.'</td>';
				if($current_level<6)
				{
					$this->view->td_title='1';
                    $table_body.='<td><a href="'.$this->_request->getBasePath().'decision/clinical/map/model/'.$model.'/parent_id/'.$row[$rowCount]['id'].'/start_time/'.date('Y-m-d',$start_time).'/decision_time/'.date('Y-m-d',$decision_time).'">[进入子地区]</a></td></tr> ';
				}
				if($current_level==6){
					$this->view->td_title='2';
                    $table_body.='<td>&nbsp;</td></tr> ';
				}
				$rowCount++;
			}
            //取所有患者的地理坐标数组
            $region = new Tregion();
			$region->whereAdd("id<>'0'");
			$region->whereAdd("id='$p_id'");
			$region->orderby('id asc');
			$region->find(true);
            $region_path=$region->region_path;
            $individual_core=new Tindividual_core();
            $clinical_history=new Tclinical_history();
            $individual_core->joinAdd("left",$individual_core,$clinical_history,'uuid','id');
            $individual_core->selectAdd("distinct individual_core.position_x,individual_core.position_y");
            $individual_core->whereAdd("(individual_core.region_path = '".$region_path."' or individual_core.region_path like '".$region_path.",%') and (clinical_history.disease_date between $time_start and $time_end) and (clinical_history.disease_code='$disease_code') and (individual_core.status_flag=1)");
            $individual_core->find();
            $position=array();
            $i=0;
            while($individual_core->fetch())
            {
                if($individual_core->position_y && $individual_core->position_x)
                {
                    $position[$i]=array($individual_core->position_y,$individual_core->position_x);
                    $i++;
                }
            }
            $individual_core->free_statement();
            $region->free_statement();
            //取省和市
            $region_path_tmp=@explode(',',$region_path);
            $address='';
            for($i=2;$i<count($region_path_tmp);$i++)
            {
                $region=new Tregion();
                $region->whereAdd("id='".$region_path_tmp[$i]."'");
                $region->find(true);
                $address.=$region->zh_name;
            }
            $address=$address?$address:'四川省雅安市';
            $this->view->city=$address;
            $this->view->position=json_encode($position);
            $this->view->assign('table_title',$table_title);
            $this->view->assign('table_body',$table_body);
			$this->view->assign('row',$row);
			$this->view->assign('model',$model);
			$this->view->assign('add_need_id',$p_id);
			$this->view->assign('basePath',__BASEPATH);
			//获取所有path 根据登录者的地区id，限制导航条只能在该用户所在的区域内
			$pathSel = new Tregion();
			$pathSel->whereAdd("id='$p_id'");
			$pathSel->find(true);
			$currentPath = $pathSel->region_path;//处理path
			$nuNumber = strpos($currentPath,$regionDomain);
			$strNumber = intval(strlen($currentPath)-$nuNumber);
			$newCurrentPath = substr($currentPath,$nuNumber,$strNumber);
			$realPath = explode(',',$newCurrentPath);
			$realCount = count($realPath);
			$rs = array();
			$rsCount = 0 ;
			foreach ($realPath as $k=>$v){
				$realMenu = new Tregion();
				$realMenu->whereAdd("id='$v'");
				$realMenu->find(true);
                $realMenu->free_statement();
				$rs[$rsCount]['zh_name'] = $realMenu->zh_name;
				$rs[$rsCount]['id'] = trim($realMenu->id);
				$rs[$rsCount]['p_id'] = trim($realMenu->p_id);
				$rsCount++;
			}
			$this->view->assign('rs',$rs);
			//获取当前表中所有栏目内容(除去根)
			$length=count(explode(',',$pathSel->region_path));
			//echo $length;
			if($length<=4){
				$this->view->standard_code_size=6;
			}else{
				$this->view->standard_code_size=3;
			}
			$this->view->errorMessage=$errorMessage;
		}
        //标注机构
        require_once __SITEROOT."library/Models/organization.php";
        //取当前机构管辖的其他机构
        $org=new Torganization();
        $org->whereAdd("organization.region_path like '".$this->user['current_region_path']."%'");
        $org->find();
        $i=0;
        $position_org=array();
        while($org->fetch())
        {
            if($org->longitude && $org->latitude)
            {
                $nums=0;
                $position_org[$i]['x']=$org->longitude;
                $position_org[$i]['y']=$org->latitude;
                $position_org[$i]['name']=$org->zh_name;
                $position_org[$i]['info']='<div style=\"margin:8px\"><p class=\"info_content\">地址：'.$org->address.'<br />电话：'.$org->phone.'<br />机构简介：'.$org->org_info.'</p></div>';
                $i++;
            }
        }
        $org->free_statement();
        $this->view->position_org=json_encode($position_org);
		$this->view->display('map.html',$p_id.$model.$type.$start_time.$end_time);
	}
}