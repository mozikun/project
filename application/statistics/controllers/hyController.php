<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class statistics_hyController extends controller {
	/**
	 * The default action - show the home page
	 */
	public function init() {
		$this->view->assign( "baseUrl", __BASEPATH );
		$this->view->assign( "basePath", __BASEPATH );
		require_once __SITEROOT . "library/Models/individual_archive.php";
		require_once __SITEROOT . "library/Models/individual_core.php";
		require_once __SITEROOT . "library/Models/organization.php";
		require_once __SITEROOT . "library/custom/pager.php";
		require_once __SITEROOT . 'library/custom/adodb-time.inc.php'; //引入时间处理
		require_once __SITEROOT . 'library/custom/comm_function.php';
        require_once __SITEROOT."library/Models/hypertension_follow_up.php";
        require_once __SITEROOT."library/Models/physical_base.php";//取血压结果
        require_once __SITEROOT."library/Models/clinical_history.php";
		require_once(__SITEROOT.'library/MyAuth.php');
		require_once(__SITEROOT.'library/privilege.php');
	}
    /**
     * 此数据不是来自于体检，而是随访结果
     * 为扩展，数据格式支持按年、月、季、星期查询，支持自定义时间段
     */
	public function indexAction()
	{
	   //取随访血压变化图
       require_once(__SITEROOT.'library/custom/region_array.php');
		$time=time();
        //默认统计7天内的收缩压和舒张压血压变化
		$time_start=$this->_request->getParam('startDate')?$this->_request->getParam('startDate'):date("Y-m-d",mktime(0,0,0,date("n"),date("j")-7,date("Y")));
		$time_end=$this->_request->getParam('endDate')?$this->_request->getParam('endDate'):date("Y-m-d");
		$serach_type=$this->_request->getParam('serach_type')?$this->_request->getParam('serach_type'):"day";//默认按天算
		$this->view->assign("serach_type",$serach_type);
		$this->view->assign("startDate",$time_start);
		$this->view->assign("endDate",$time_end);
		$unit=array('day'=>'日','week'=>'周','quarter'=>'季','month'=>'月','year'=>'年');
		$this->view->assign("unit",$unit);//单位数组
		$units=$unit[$serach_type];
		$times="";
		$times=$time_start."-".$time_end;
		$time_start=mkunixstamp($time_start);
		$time_end=mkunixstamp($time_end);
		$time_start=adodb_mktime(0,0,0,date("n",$time_start),date("j",$time_start)-1,date("Y",$time_start));
		$time_end=adodb_mktime(0,0,0,date("n",$time_end),date("j",$time_end)+1,date("Y",$time_end));
		$t=list_time($time_start,$time_end,$serach_type);
        $uuid=$this->_request->getParam("id");
        //分组统计人数
		$hypertension_follow_up=new Thypertension_follow_up();
		$hypertension_follow_up->whereAdd("id='$uuid'");
		$hypertension_follow_up->whereAdd("hypertension_follow_up.follow_time>=$time_start");
		$hypertension_follow_up->whereAdd("hypertension_follow_up.follow_time<=$time_end");
        switch ($serach_type)
		{
			case 'day':
				{
					$serach_type="DD";
					$hypertension_follow_up->groupBy("hypertension_follow_up.blood_pressure,hypertension_follow_up.diastolic_blood_pressure,to_char(unixts_to_date(hypertension_follow_up.follow_time),'yyyy-mm-$serach_type')");
					$hypertension_follow_up->selectAdd("to_char(unixts_to_date(hypertension_follow_up.follow_time),'yyyy-mm-$serach_type') as day,hypertension_follow_up.blood_pressure as blood_pressure,hypertension_follow_up.diastolic_blood_pressure as diastolic_blood_pressure,max(hypertension_follow_up.blood_pressure) as max_blood_pressure,min(hypertension_follow_up.blood_pressure) as min_blood_pressure,avg(hypertension_follow_up.blood_pressure) as avg_blood_pressure,max(hypertension_follow_up.diastolic_blood_pressure) as max_diastolic_blood_pressure,min(hypertension_follow_up.diastolic_blood_pressure) as min_diastolic_blood_pressure,avg(hypertension_follow_up.diastolic_blood_pressure) as avg_diastolic_blood_pressure");
					break;
				}
			case 'week':
				{
					$serach_type="iw";
					$hypertension_follow_up->groupBy("to_char(unixts_to_date(hypertension_follow_up.follow_time),'yyyy($serach_type)')");
					$hypertension_follow_up->selectAdd("to_char(unixts_to_date(hypertension_follow_up.follow_time),'yyyy($serach_type)') as day,hypertension_follow_up.blood_pressure as blood_pressure,hypertension_follow_up.diastolic_blood_pressure as diastolic_blood_pressure,max(hypertension_follow_up.blood_pressure) as max_blood_pressure,min(hypertension_follow_up.blood_pressure) as min_blood_pressure,avg(hypertension_follow_up.blood_pressure) as avg_blood_pressure,max(hypertension_follow_up.diastolic_blood_pressure) as max_diastolic_blood_pressure,min(hypertension_follow_up.diastolic_blood_pressure) as min_diastolic_blood_pressure,avg(hypertension_follow_up.diastolic_blood_pressure) as avg_diastolic_blood_pressure");
					break;
				}
			case 'quarter':
				{
					$serach_type="q";
					$hypertension_follow_up->groupBy("to_char(unixts_to_date(hypertension_follow_up.follow_time),'yyyy($serach_type)')");
					$hypertension_follow_up->selectAdd("to_char(unixts_to_date(hypertension_follow_up.follow_time),'yyyy($serach_type)') as day,hypertension_follow_up.blood_pressure as blood_pressure,hypertension_follow_up.diastolic_blood_pressure as diastolic_blood_pressure,max(hypertension_follow_up.blood_pressure) as max_blood_pressure,min(hypertension_follow_up.blood_pressure) as min_blood_pressure,avg(hypertension_follow_up.blood_pressure) as avg_blood_pressure,max(hypertension_follow_up.diastolic_blood_pressure) as max_diastolic_blood_pressure,min(hypertension_follow_up.diastolic_blood_pressure) as min_diastolic_blood_pressure,avg(hypertension_follow_up.diastolic_blood_pressure) as avg_diastolic_blood_pressure");
					break;
				}
			case 'month':
				{
					$hypertension_follow_up->groupBy("to_char(unixts_to_date(hypertension_follow_up.follow_time),'yyyy-$serach_type')");
					$hypertension_follow_up->selectAdd("to_char(unixts_to_date(hypertension_follow_up.follow_time),'yyyy-$serach_type') as day,hypertension_follow_up.blood_pressure as blood_pressure,hypertension_follow_up.diastolic_blood_pressure as diastolic_blood_pressure,max(hypertension_follow_up.blood_pressure) as max_blood_pressure,min(hypertension_follow_up.blood_pressure) as min_blood_pressure,avg(hypertension_follow_up.blood_pressure) as avg_blood_pressure,max(hypertension_follow_up.diastolic_blood_pressure) as max_diastolic_blood_pressure,min(hypertension_follow_up.diastolic_blood_pressure) as min_diastolic_blood_pressure,avg(hypertension_follow_up.diastolic_blood_pressure) as avg_diastolic_blood_pressure");
					break;
				}
			case 'year':
				{
					$serach_type="yyyy";
					$hypertension_follow_up->groupBy("to_char(unixts_to_date(hypertension_follow_up.follow_time),'$serach_type')");
					$hypertension_follow_up->selectAdd("to_char(unixts_to_date(hypertension_follow_up.follow_time),'$serach_type') as day,hypertension_follow_up.blood_pressure as blood_pressure,hypertension_follow_up.diastolic_blood_pressure as diastolic_blood_pressure,max(hypertension_follow_up.blood_pressure) as max_blood_pressure,min(hypertension_follow_up.blood_pressure) as min_blood_pressure,avg(hypertension_follow_up.blood_pressure) as avg_blood_pressure,max(hypertension_follow_up.diastolic_blood_pressure) as max_diastolic_blood_pressure,min(hypertension_follow_up.diastolic_blood_pressure) as min_diastolic_blood_pressure,avg(hypertension_follow_up.diastolic_blood_pressure) as avg_diastolic_blood_pressure");
					break;
				}
			default:
				{
					$serach_type="DD";
					$hypertension_follow_up->groupBy("to_char(unixts_to_date(hypertension_follow_up.follow_time),'yyyy-mm-$serach_type')");
					$hypertension_follow_up->selectAdd("to_char(unixts_to_date(hypertension_follow_up.follow_time),'yyyy-mm-$serach_type') as day,hypertension_follow_up.blood_pressure as blood_pressure,hypertension_follow_up.diastolic_blood_pressure as diastolic_blood_pressure,max(hypertension_follow_up.blood_pressure) as max_blood_pressure,min(hypertension_follow_up.blood_pressure) as min_blood_pressure,avg(hypertension_follow_up.blood_pressure) as avg_blood_pressure,max(hypertension_follow_up.diastolic_blood_pressure) as max_diastolic_blood_pressure,min(hypertension_follow_up.diastolic_blood_pressure) as min_diastolic_blood_pressure,avg(hypertension_follow_up.diastolic_blood_pressure) as avg_diastolic_blood_pressure");
					break;
				}
		}
		$hypertension_follow_up->find();
		$se=array();
		$i=2;
		while ($hypertension_follow_up->fetch())
		{
            if(isset($se['blood_pressure']['data'][$hypertension_follow_up->day]) && $se['blood_pressure']['data'][$hypertension_follow_up->day]!="")
              {
                $se['blood_pressure']['data'][$hypertension_follow_up->day."(".$i.")"]=$hypertension_follow_up->blood_pressure?$hypertension_follow_up->blood_pressure:0;
                $se['diastolic_blood_pressure']['data'][$hypertension_follow_up->day."(".$i.")"]=$hypertension_follow_up->diastolic_blood_pressure?$hypertension_follow_up->diastolic_blood_pressure:0;
    			$i++;
              }
              else
              {
                $se['blood_pressure']['data'][$hypertension_follow_up->day]=$hypertension_follow_up->blood_pressure?$hypertension_follow_up->blood_pressure:0; 
                $se['diastolic_blood_pressure']['data'][$hypertension_follow_up->day]=$hypertension_follow_up->diastolic_blood_pressure?$hypertension_follow_up->diastolic_blood_pressure:0;
    			
              }
			$se["blood_pressure"]['seriename']="收缩压";
            $se["diastolic_blood_pressure"]['seriename']="舒张压";
		}
		$pic_data=array();
        $temp=array();
        if(isset($se['blood_pressure']['data']) && is_array($se['blood_pressure']['data']))
        {
            $temp=array_keys($se['blood_pressure']['data']);
        }
        $t=array_unique(array_merge($t,$temp));
        sort($t);
		foreach ($t as $j=>$h)
		{
			foreach ($se as $k=>$v)
			{
				if (!isset($v['data'][$h]))
				{
					$pic_data[$k]['data'][$h]=0;
				}
				else 
				{
                    $pic_data[$k]['data'][$h]=$se[$k]['data'][$h]; 
				}
				$pic_data[$k]['seriename']=$se[$k]['seriename'];
			}
		}
        //个人信息
		$individual_inf=get_individual_info($uuid);
		//绘图
		$title=$individual_inf->name."-近7天高血压随访血压走势图";
		@drawline($pic_data,$t,"","血压(mmHg)",$units,"",$title,"750","280","30");
	}
    //今日统计 统计随访人数、随访总次数、高血压患者数
    function todayAction()
    {
        $time=time();
		$time_start=mktime(0,0,0,date("n"),date("j"),date("Y"));//今日0点
		$time_end=mktime(0,0,0,date("n"),date("j")+1,date("Y"));//今日24点
        $hypertension_core_region_path_domain=get_region_path(1);
		$staff_core_region_path_domain=get_region_path(2);
		$hypertension_follow_up=new Thypertension_follow_up();
		$core=new Tindividual_core();
		$hypertension_follow_up->whereAdd($hypertension_core_region_path_domain);
		$hypertension_follow_up->joinAdd('inner',$hypertension_follow_up,$core,'id','uuid');
        $hypertension_follow_up->whereAdd("hypertension_follow_up.follow_time>=$time_start");
		$hypertension_follow_up->whereAdd("hypertension_follow_up.follow_time<=$time_end");
        $hypertension_follow_up->whereAdd("individual_core.status_flag=1");//2012-02-21仅查询正常档案，我好笨
        $nums=$hypertension_follow_up->count("distinct hypertension_follow_up.id");//随访总人数
        $nums_count=$hypertension_follow_up->count("hypertension_follow_up.uuid");//随访总次数
        $this->view->nums=$nums;
        $this->view->nums_count=$nums_count;
        //到今天为止的高血压患者数
        $clinical_history=new Tclinical_history();
		$individual_core=new Tindividual_core();
		$clinical_history->joinAdd('inner',$clinical_history,$individual_core,'id','uuid');
		$clinical_history->whereAdd($hypertension_core_region_path_domain);
		$clinical_history->whereAdd("clinical_history.disease_code='2'");
        $clinical_history->whereAdd("individual_core.status_flag=1");//2012-02-21仅查询正常档案，我好笨
        $clinical_history->whereAdd("clinical_history.disease_state='1'");
		$hypertension_count=$clinical_history->count("distinct clinical_history.id");
        $this->view->hypertension_count=$hypertension_count;
        $this->view->today=date("Y-m-d",$time_start);
        $this->view->display('today.html');
    }
 }
 ?>