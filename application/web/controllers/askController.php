<?php
/**
 * web_askController
 * 
 * 互动问答
 * 
 * @package yaan
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class web_askController extends controller
{
    public function init()
    {
        require_once __SITEROOT."library/Models/organization.php";
        require_once __SITEROOT."library/Models/ask.php";
        require_once __SITEROOT."library/Models/individual_core.php";
        require_once __SITEROOT."library/Models/staff_core.php";
        require_once __SITEROOT."library/Models/answer.php";
        require_once __SITEROOT."library/Models/web_sort.php";
        require_once(__SITEROOT . 'library/custom/pager.php');    //分页表
       
        require_once __SITEROOT."library/custom/comm_function.php";
        $this->view->basePath = $this->_request->getBasePath();
        //取公共顶部内容
        //取首页栏目
        $web_sort=new Tweb_sort();
        $web_sort->whereAdd("parent_uuid='0'");
        $web_sort->limit(0,20);
        $web_sort->find();
        $i=0;
        $sorts=array();
        while($web_sort->fetch())
        {
            $sorts[$i]['uuid']=$web_sort->uuid;
            $sorts[$i]['py']=$web_sort->sortname_py;
            $sorts[$i]['name']=$web_sort->sortname;
            $i++;
        }
        $this->view->sorts=$sorts;
        $arr=array("天","一","二","三","四","五","六");
        $this->view->timer=date("Y年m月d日 ").' 星期'.$arr[date('w')];
        //取公共底部内容
        //取医院
        $org=new Torganization();
        $org->whereAdd("type=5");
        $org->limit(0,4);
        $org->find();
        $orgs=array();
        $i=0;
        while($org->fetch())
        {
            $orgs[$i]['id']=$org->id;
            $orgs[$i]['zh_name']=$org->zh_name;
            $i++;
        }
        $this->view->orgs=$orgs;
    }
    /**
     * 
     * 首页
     * 
     * @return void
     */
    public function indexAction()
    {	
		$this->view->display("index.html");
        
    }
	/**
     * 
     * 
     * 提交问题
     * 
     * @return void
     */
	public function askAction(){ 
	//print_r($_POST);
		$question=$this->_request->getParam("question");
		$search_session=new Zend_Session_Namespace("iha_search");
		$author=$search_session->identity_number;
		//echo $author;
		$ask=new Task();
		$ask->id=uniqid();
		$ask->author=$author;
		$ask->question=$question;
		$ask->time=time();
		if($ask->insert()){
			message("保存成功！",array("返回列表"=>__BASEPATH."web/ask/myquestion"));
		}
		else{
			message("保存失败",array("返回列表"=>__BASEPATH."web/ask/myquestion"));
		}
		
	}
	/**
     * 
     * 
     * 问题列表
     * 
     * @return void
     */
	public function asklistAction(){ 
		$question=$this->_request->getParam("question");
		$search_session=new Zend_Session_Namespace("iha_search");
		$author=$search_session->identity_number;
		//echo $author;
		$ask=new Task();
		$individual_core=new Tindividual_core();
		$ask->joinAdd("inner",$ask,$individual_core,"author","identity_number");
		$nums = $ask->count();
        $page_size = 20;    //每页显示的条数
        $sub_pages = 8;          //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1);  //计算开始记录数
        $ask->limit($startnum, $page_size);
		
		$ask->orderby("time");
		//$ask->debug(1);
		$ask->find();
		$result=array();
		$i=0;
		while($ask->fetch()){
			
			$result[$i]['author']=$individual_core->name;
			$result[$i]['question']=$ask->question;
			$result[$i]['time']=date("Y-m-d",$ask->time);
			$result[$i]['id']=$ask->id;
			$i++;
		}
		$out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->page = $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页
		$this->view->result=$result;
		
		$this->view->display("asklist.html");
	}
	/**
     * 
     * 
     * 医生主页
     * 
     * @return void
     */
	public function doctorhomeAction(){
		$ask=new Task();
		$individual_core=new Tindividual_core();
		$ask->joinAdd("inner",$ask,$individual_core,"author","identity_number");
		$nums = $ask->count();
        $page_size = 20;    //每页显示的条数
        $sub_pages = 8;          //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1);  //计算开始记录数
        $ask->limit($startnum, $page_size);
		
		$ask->orderby("time");
		//$ask->debug(1);
		$ask->find();
		$result=array();
		$i=0;
		while($ask->fetch()){
			
			$result[$i]['author']=$individual_core->name;
			$result[$i]['question']=$ask->question;
			$result[$i]['time']=date("Y-m-d",$ask->time);
			$result[$i]['id']=$ask->id;
			$i++;
		}
		$out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->page = $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页
		$this->view->result=$result;
		
		$this->view->display("doctorhome.html");
	}
	/**
     * 
     * 
     * 回答问题页面
     * 
     * @return void
     */
	public function answerquestionAction(){ 
		
		$question_id=$this->_request->getParam("id");
		if(empty($question_id)){
			message( "消息id获取失败!");
		}
		$ask=new Task();
		$ask->whereAdd("id='$question_id'");
		$ask->find(true);
		$this->view->ask=$ask;
		$this->view->display("answerquestion.html");
	}
	/**
     * 
     * 
     * 保存答案
     * 
     * @return void
     */
	public function saveanswerAction(){ 
		
		$question_id=$this->_request->getParam("id");
		$info=$this->_request->getParam("answer");
		$auth=new Zend_Session_Namespace("Zend_Auth");
		if(empty($question_id)){
			message( "消息id获取失败!");
		}
		$answer=new Tanswer();
		$answer->id=uniqid();
		$answer->answer=$info;
		$answer->question_id=$question_id;
		$answer->time=time();
		$answer->author=$auth->storage['uuid'];
		if($answer->insert()){
			message("保存成功！",array("返回列表"=>__BASEPATH."web/ask/doctorhome"));
		}
		else{
			message("保存失败！",array("返回列表"=>__BASEPATH."web/ask/doctorhome"));
		}
		
	}
	/**
     * 
     * 
     * 查看答案
     * 
     * @return void
     */
	public function getAnswerAction(){ 
		
		$question_id=$this->_request->getParam("id");
		
		if(empty($question_id)){
			message( "消息id获取失败!");
		}
		$answer=new Tanswer();
		$staff_core=new Tstaff_core();
		$answer->whereAdd("question_id='$question_id'");
		$answer->joinAdd("inner",$answer,$staff_core,"author","id");
		$answer->find();
		$result=array();
		$i=0;
		while($answer->fetch()){
			$result[$i]['answer']=$answer->answer;
			$result[$i]['author']=$staff_core->name_login;
			$result[$i]['time']=date("Y-m-d",$answer->time);
			$result[$i]['id']=$answer->id;
			$i++;
		}
		$this->view->result=$result;
		$this->view->display("getanswer.html");
	}
	/**
     * 
     * 
     * 自己提过的问题
     * 
     * @return void
     */
	public function myquestionAction(){
	    $search_session=new Zend_Session_Namespace("iha_search");
		$ask=new Task();
		$individual_core=new Tindividual_core();
		$ask->whereAdd("author='$search_session->identity_number'");
		$ask->joinAdd("inner",$ask,$individual_core,"author","identity_number");
		$nums = $ask->count();
        $page_size = 15;    //每页显示的条数
        $sub_pages = 8;          //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1);  //计算开始记录数
        $ask->limit($startnum, $page_size);
		$ask->orderby("time");
		//$ask->debug(1);
		$ask->find();
		$result=array();
		$i=0;
		while($ask->fetch()){
			
			$result[$i]['author']=$individual_core->name;
			$result[$i]['question']=$ask->question;
			$result[$i]['time']=date("Y-m-d",$ask->time);
			$result[$i]['id']=$ask->id;
			$i++;
		}
		$out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->page = $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页
		$this->view->result=$result;
		
		$this->view->display("myquestion.html");
	}
	/**
     * 
     * 
     * 删除问题
     * 
     * @return void
     */
	public function delquestionAction(){
	   $id=$this->_request->getParam("id");
	   $question=new Task();
	   $question->whereAdd("id='$id'");
	   if($question->delete()){
			message("删除成功",array("返回列表"=>__BASEPATH."web/ask/myquestion"));
	   }
	   else{
			message("删除失败",array("返回列表"=>__BASEPATH."web/ask/myquestion"));
	   }
	}
	/**
     * 
     * 
     * 修改问题
     * 
     * @return void
     */
	public function editquestionAction(){
		message("功能开发中！",array("返回列表"=>__BASEPATH."web/ask/myquestion"));
	}
	/**
     * 
     * 
     * 前端显示问题答案
     * 
     * @return void
     */
	public function answersAction(){

		$question_id=$this->_request->getParam("id");
		$answer=new Tanswer();
		$staff_core=new Tstaff_core();
		$answer->whereAdd("question_id='$question_id'");
		$answer->joinAdd("inner",$answer,$staff_core,"author","id");
		$nums = $answer->count();
        $page_size = 10;    //每页显示的条数
        $sub_pages = 8;          //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1);  //计算开始记录数
        $answer->limit($startnum, $page_size);
		$answer->orderby("time");
		$answer->find();
		$result=array();
		$i=0;
		while($answer->fetch()){
			$result[$i]['answer']=$answer->answer;
			$result[$i]['author']=$staff_core->name_login;
			$result[$i]['time']=date("Y-m-d",$answer->time);
			$result[$i]['id']=$answer->id;
			$i++;
		}
		$out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->page = $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页
		$this->view->result=$result;
		$this->view->display("answers.html");
	}
	
    
}