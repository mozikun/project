<?php
/**
 * weixin_apiController
 *  
 * 完成微信模块回复的功能处理
 * 
 * @package yaan
 * @author 团队成员
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class weixin_apiController extends controller
{
    private $wx_obj;
    private $data;
    /**
     * weixin_apiController::init()
     * 
     * @return void
     */
    public function init()
    {
        
    }
    public function defaultAction()
    {
        require_once __SITEROOT.'application/weixin/model/__autoload.php';//自动加载数据库模型类
        define('WEB_URL', 'http://182.132.138.30:8866/');
        //设置token
        $token=$this->_request->getParam('token');
        $token=$token?$token:'notoken';
        define('TOKEN',$token);
        //开始请求
        include __SITEROOT.'library/custom/weixin.class.php';
        $echoStr=$this->_request->getParam('echostr');
        $signature=$this->_request->getParam('signature');
        $timestamp=$this->_request->getParam('timestamp');
        $nonce=$this->_request->getParam('nonce');
        $this->wx_obj=new weixin($echoStr,$signature,$timestamp,$nonce);
        $this->data=$this->wx_obj->getparams();
        if(($this->data['msgType']=='text' && $this->data['keyword'] == "Hello2BizUser") or ($this->data['msgType']=='event' && $this->data['event']=='subscribe'))
        {
            //取机构信息
            require_once __SITEROOT . "library/Models/weixin_setorg.php";
            $orgs=new Tweixin_setorg();
            $orgs->whereAdd("account_name='".$this->data['toUsername']."'");
            $orgs->find(true);
            //关注账号事件
            if($orgs->default_replay)
            {
                $this->wx_obj->responseSubscribe($orgs->default_replay);
            }
            else
            {
                $this->wx_obj->responseSubscribe('欢迎关注健康微门户，您可以输入index查看功能列表，输入help获取帮助信息，也可以直接提出您想要问的问题。');
            }
        }
        elseif($this->data['msgType']=='text' && $this->data['keyword'] != "Hello2BizUser")
        {
            //调用相应的模块
            $tmp_module=explode(':',strtolower($this->data['keyword']));
            if($tmp_module[0] && (method_exists($this,$tmp_module[0]) || in_array($tmp_module[0],array(1,2,3,4,5))))
            {
                switch($tmp_module[0])
                {
                    case 1:
                    {
                        $tmp_module[0]='index';
                        break;
                    }
                    case 2:
                    {
                        $tmp_module[0]='help';
                        break;
                    }
                    case 3:
                    {
                        $tmp_module[0]='mb';
                        break;
                    }
                    case 4:
                    {
                        $tmp_module[0]='nt';
                        break;
                    }
                    case 5:
                    {
                        $tmp_module[0]='hea';
                        break;
                    }
                    default:
                    {
                        break;
                    }
                }
                $this->$tmp_module[0]();
            }
            else
            {
                //模块不存在，可以直接调用智能回复模块
                $this->ask();
            }
        }
        elseif($this->data['msgType']=='event' && $this->data['event']!='subscribe')
        {
            $this->index();
            exit;
            //回复用户，此功能开发中
            $this->wx_obj->responseText('你好，我们暂时无法处理您发送的内容，请重新输入。');
        }
        elseif($this->data['msgType']=='link')
        {
            $this->index();
            exit;
            //回复用户开发中
            $this->wx_obj->responseText('你好，我们暂时无法处理您发送的内容，请重新输入。');
        }
        elseif($this->data['msgType']=='location')
        {
            $this->index();
            exit;
            //回复用户开发中
            $this->wx_obj->responseText('你好，我们暂时无法处理您发送的内容，请重新输入。');
        }
        elseif($this->data['msgType']=='image')
        {
            $this->index();
            exit;
            //回复用户开发中
            $this->wx_obj->responseText('你好，我们暂时无法处理您发送的内容，请重新输入。');
        }
        else
        {
            $this->index();
            exit;
            //默认回复
            $this->wx_obj->responseText('你好，我们暂时无法识别您说的话，请重新输入。');
        }
    }
    /**
     * weixin_apiController::demo()
     * 
     * 示例 用户请求时，返回一个demo文本
     * 
     * @return void
     */
    private function demo()
    {
        $this->wx_obj->responseText('demo');
    }
    /**
     * weixin_apiController::meet()
     * 
     * 现场会-展示会议纪要
     * 
     * @return void
     */
    private function meet()
    {
        $this->wx_obj->responseText('输入1获取，会议纪要连接');
    }
    /**
     * 慢病工作计划列表
     */
    private function mb()
    {
        $param = $this->data;
        $fromUsername = $param['fromUsername'];//发送者的微信号
        $toUsername     = $param['toUsername'];//被关注的机构的微信号
        //取时间获取模块数据
        $keyword  = $param['keyword'];// 模块：时间格式
        if(strpos($keyword,":")===false)
        {
            $keyword=$keyword.":".date('Y-m-d');
        }
        if(!empty($keyword)&&(strpos($keyword, ':')!==false))
        {
            $keyword_array = explode(':', $keyword);
            $current_module_name = $keyword_array[0];
            $get_select_time = empty($keyword_array[1])?time():strtotime($keyword_array[1]);    
            if(!empty($fromUsername)&&!empty($toUsername))
            {
                //取得当前机构的真正ID
                $weixin_user = new Tweixin_user;
                $weixin_user->whereAdd("wx_username='$fromUsername'");
                $weixin_user->whereAdd("org_wxid='$toUsername'");
                $weixin_user->find(true);
                $cuurent_org_id = $weixin_user->org_id;
               // $cuurent_org_id = 17;
                if(!empty($cuurent_org_id))
                {
                   
                    $start_time = mktime(0,0,0,date('m',$get_select_time),date('d',$get_select_time),date('Y',$get_select_time));
                    $end_time = mktime(23,59,59,date('m',$get_select_time),date('d',$get_select_time),date('Y',$get_select_time));
                    //查询当前数据列表
                    $tips = new Ttips();
                    $tips->query("select * from (SELECT A.*, ROWNUM RN from (select * from tips where tips.id in (select individual_core.uuid from individual_core where individual_core.org_id=$cuurent_org_id) and tips.tips_time>=$start_time and tips.tips_time<=$end_time order by tips.created DESC) A WHERE ROWNUM <= 10)  where RN>=0");             
                    $data_array = array();
                    $count = 0;
                    while($tips->fetch())
                    {
                        //取得姓名
                       $individual_core  = new Tindividual_core;
                       $individual_core->whereAdd("uuid='$tips->id'");
                       $individual_core->find(true);
                       $name = $individual_core->name;
                       $data_array[$count]['title']  = $name.$tips->title;
                       $data_array[$count]['desc']='';
                       $data_array[$count]['pic']='';
                       $data_array[$count]['url']=WEB_URL.'weixin/'.$current_module_name.'/detail/uuid/'.$tips->uuid;
                       $count++;
                    }
                    $this->wx_obj->responseList($data_array);
                }
                else
                {
                    $this->wx_obj->responseText("参数错误");
                }   
            }
        }
        else
        {
            $this->wx_obj->responseText("您发送的内容为空或者语言格式不正确，请使用 （ 模块名:请求时间）如  mb:2013-05-15");
        }
    }
    
    /**
     * 机构通知
     * 
     */
    public function nt()
    {
    	$params=$this->data;
    	$fromusername=$params["fromUsername"];//发送者的微信号
    	$tousername=$params["toUsername"];//被关注的机构的微信号
    	//取时间获取模块数据
    	$keyword=$params['keyword'];
        if(strpos($keyword,":")===false)
        {
            $keyword=$keyword.":".date('Y-m-d');
        }
    	if(!empty($keyword) && strpos($keyword,":")!==false)
    	{
    		$keyword_array=explode(":",$keyword);
    		$current_model_name=$keyword_array[0];
    		$get_select_time=strtotime($keyword_array[1]);
    		
    		if(!empty($fromusername) && !empty($tousername))
    		{
    			//获取机构id
    			$user=new Tweixin_user();
    			$user->whereAdd("wx_username='$fromusername'");
    			$user->whereAdd("org_wxid='$tousername'");
    			$user->find(true);
    			$org_id=$user->org_id;
    			$start_time = mktime(0,0,0,date('m',$get_select_time),date('d',$get_select_time),date('Y',$get_select_time));
                $end_time = mktime(23,59,59,date('m',$get_select_time),date('d',$get_select_time),date('Y',$get_select_time));
    			
    			if(!empty($org_id))
    			{
    				$notice=new Tweixin_notice();
    				$notice->whereAdd("org_id='$org_id'");
    				$notice->whereAdd("create_time>='$start_time' and create_time<='$end_time'");
    				$notice->limit(0,9);
    				$notice->find();
    				$data_array=array();
    				$i=0;
    				while($notice->fetch())
    				{
    					$data_array[$i]['title']=$notice->title;
    					$data_array[$i]['desc']='';
    					$data_array[$i]['pic']='';
    					$data_array[$i]['url']=WEB_URL.'weixin/'.$current_model_name.'/detail/uuid/'.$notice->uuid;
    					$i++;
    				}
    				$this->wx_obj->responseList($data_array);
    			}
    			else {
    				$this->wx_obj->responseText("参数错误！");
    			}
    		}
    	}else{
    		 $this->wx_obj->responseText("您发送的内容为空或者语言格式不正确，请使用 （模块名:请求时间）如  nt:2013-06-20");
    	}
    }
	 /**
     * 
     * 
     * 微信首页
     * 
     * 显示logo及模块列表
     * 
     */
	public function index(){
		$param = $this->data;
        $fromUsername = $param['fromUsername'];//发送者的微信号
        $toUsername     = $param['toUsername'];//被关注的机构的微信号
        //取时间获取模块数据
        $keyword  = $param['keyword'];// 模块：时间格式
        if(!empty($keyword))
        {
            $keyword_array = explode(':', $keyword);
            $current_module_name = $keyword_array[0];
            $get_select_time = strtotime($keyword_array[1]);    
            if(!empty($fromUsername)&&!empty($toUsername))
            {
                //取得当前机构的真正ID
                $weixin_user = new Tweixin_user;
                $weixin_user->whereAdd("wx_username='$fromUsername'");
                $weixin_user->whereAdd("org_wxid='$toUsername'");
                $weixin_user->find(true);
                $current_org_id = $weixin_user->org_id;
                if(!empty($current_org_id))
                {  
				   /*
                    //查询当前数据列表
                    $weixin_setorg = new Tweixin_setorg();
					$weixin_setorg->whereAdd("org_id='$current_org_id'");
					$weixin_setorg->find(true);
                    $data_array = array();
					//logo图片
					$data_array[0]['title'] ="";
                    $data_array[0]['desc']='';
                    $data_array[0]['pic']=$weixin_setorg->logo_name;
                    $data_array[0]['url']=WEB_URL.'weixin/api/index';
					//模块列表
					*/
				$module=new Tweixin_module();
    				$module->whereAdd("status=1 and is_index=1");
                                $module->orderby("display asc");
    				$module->limit(0,9);
    				$module->find();
					$count=1;
                    while($module->fetch())
                    { 
                       $data_array[$count]['title']  =$module->module_name;
                       $data_array[$count]['desc']='';
                       $data_array[$count]['pic']='';
                       $data_array[$count]['url']=WEB_URL.$module->list_url."/org/".$current_org_id;;
                       $count++;
                    }
                    $this->wx_obj->responseList($data_array);
                }
                else
                {
                    $this->wx_obj->responseText("参数错误");
                }  
			}
		}	
	} 
	 /**
     * 
     * 
     * 健康教育
     * 
     * 显示近期健康教育活动列表
     * 
     */
	public function hea(){
		$param = $this->data;
        $fromUsername = $param['fromUsername'];//发送者的微信号
        $toUsername     = $param['toUsername'];//被关注的机构的微信号
        //取时间获取模块数据
        $keyword  = $param['keyword'];// 模块：时间格式
        if(strpos($keyword,":")===false)
        {
            $keyword=$keyword.":".date('Y-m-d');
        }
        if(!empty($keyword) && strpos($keyword,":")!==false)
        {
            $keyword_array = explode(':', $keyword);
            $current_module_name = $keyword_array[0];
            $get_select_time = strtotime($keyword_array[1]);    
            if(!empty($fromUsername)&&!empty($toUsername))
            {
			
                //取得当前机构的真正ID
                $weixin_user = new Tweixin_user;
                $weixin_user->whereAdd("wx_username='$fromUsername'");
                $weixin_user->whereAdd("org_wxid='$toUsername'");
                $weixin_user->find(true);
                $current_org_id = $weixin_user->org_id;
				$start_time = mktime(0,0,0,date('m',$get_select_time),date('d',$get_select_time),date('Y',$get_select_time));
                $end_time = mktime(23,59,59,date('m',$get_select_time),date('d',$get_select_time),date('Y',$get_select_time));
                //$current_org_id=95; 
				if(!empty($current_org_id))
                {   
                    //查询当前数据列表
                    $hea = new Thealth_education();
                    $hea->whereAdd("org_id='$current_org_id'");
					$hea->whereAdd("activity_time>='$start_time' and activity_time<='$end_time'");
                    $hea->limit(0,9);
                    $hea->find();
                    $data_array = array();
                    $count = 0;
					
                    while($hea->fetch())
                    {
                       $data_array[$count]['title']  =$hea->activity_theme." ".date("Y-m-d",$hea->activity_time);
                       $data_array[$count]['desc']='';
                       $data_array[$count]['pic']='';
                       $data_array[$count]['url']=WEB_URL.'weixin/hea/detail/id/'.$hea->uuid;
                       $count++;
					   //$this->wx_obj->responseText($hea->uuid);
                    }
					
                    $this->wx_obj->responseList($data_array);
                }
                else
                {
                    $this->wx_obj->responseText("参数错误");
                }   
            }
        }
        else
        {
            $this->wx_obj->responseText("您发送的内容为空或者语言格式不正确，请使用 （ 模块名:请求时间）如  mb:2013-05-15");
        }
	}
	 /**
     * 
     *微信智能问答
     * 
     */
	public function ask(){
		
		$param = $this->data;
        $fromUsername = $param['fromUsername'];//发送者的微信号
        $toUsername     = $param['toUsername'];//被关注的机构的微信号
        //取时间获取模块数据
        $keyword  = $param['keyword'];// 模块：时间格式
        if(!empty($keyword))
        {
            if(!empty($fromUsername)&&!empty($toUsername))
            {
                //取得当前机构的真正ID
                $weixin_user = new Tweixin_user;
                $weixin_user->whereAdd("wx_username='$fromUsername'");
                $weixin_user->whereAdd("org_wxid='$toUsername'");
                $weixin_user->find(true);
                $current_org_id = $weixin_user->org_id;
                if(!empty($current_org_id))
                {	
					//载入分词模块
					require_once(__SITEROOT."application\weixin\model\splitword\lib_splitword_full.php");
					//$keyword="医院";
					//$current_org_id=$this->user['org_id'];
                    $sp = new SplitWord();//实例化分词类
					$result= @$sp->SplitRMM($keyword);
					$key_arrs=explode(" ",$result);//问题关键字数组
					$sql="question like '%$keyword%' or keywords like '%$keyword%'";
					foreach($key_arrs as $v){
						$v=trim($v);
						if(!empty($v)){
							$sql.="or question like '%$v%' or keywords like '%$v%'";
						}	
						
					}
					$weixin_ask=new Tweixin_ask();
					$weixin_ask->whereAdd($sql);
					$weixin_ask->whereAdd("org_id='$current_org_id'");
					$percent1=0;
					if($weixin_ask->count()>0){ 
						$weixin_ask->find();
						while($weixin_ask->fetch()){
							similar_text($keyword,$weixin_ask->question,$percent2);
							if($percent2>$percent1){
								$percent1=$percent2;
								$answer=$weixin_ask->answer;
							}
							
						}
						$this->wx_obj->responseText($answer);
					}	
					else{
						$this->wx_obj->responseText("噢噢，没有找到答案！输入'1'查看首页，输入'2'获取帮助，试试吧！");
					}
                }	
                else
                {
                    $this->wx_obj->responseText("参数错误");
                }   
            }
        }
        else
        {
            $this->wx_obj->responseText("内容不能为空哦！");
        }
	}
	 /**
     * 
     *微信用户帮助
     * 
     */	
	public function help(){
		$help=array("操作指令说明：","慢病工作计划：mb:2012-7-1或者3查看今天","健康教育活动：hea:2013-7-1或者5查看今天","机构通知：nt:2013-7-1或者4查看今天","功能首页：1或者index","用户帮助：2或者help");
		$data_array=array();
		$count=0;
		foreach($help as $v){
			 $data_array[$count]['title']  =$v;
             $data_array[$count]['desc']='';
             $data_array[$count]['pic']='';
             $data_array[$count]['url']='';
			 $count++;
		}
		 $this->wx_obj->responseList($data_array);
	} 
}