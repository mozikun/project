<?php
/**
 * weixin_askController
 * 
 * 微信健互动问答
 * 
 * @package yaan
 * @author whx
 * @copyright 2013
 */
class weixin_askController extends controller
{	
	
    public function init()
    {
        $this->haveWritePrivilege='';
		//权限验证
		require_once(__SITEROOT.'library/privilege.php');
		require_once __SITEROOT.'/library/custom/adodb-time.inc.php';//引入时间处理
		require_once __SITEROOT.'/library/custom/comm_function.php';
		require_once __SITEROOT."/library/custom/pager.php";
		require_once __SITEROOT."/library/Models/weixin_ask.php";
		$this->view->basePath = $this->_request->getBasePath();
		
    }
    /**
     * 
     *微信互动问答添加编辑展示
     * 
     * @return void
     */
    public function editAction()
    {	
		$id=$this->_request->getparam("id");
		$weixin_ask=new Tweixin_ask();
		$weixin_ask->whereAdd("id='$id'");
		$weixin_ask->find(true);
		$this->view->ask=$weixin_ask;
		$this->view->display("edit.html");
    }
	/**
     * 
     *微信互动问答添加编辑数据保存
     * 
     * @return void
     */
    public function editinAction()
    {	
		$id=$this->_request->getParam('id');
        $ask=new Tweixin_ask();
		$ask->question=trim($this->_request->getParam('question'));
		$ask->keywords=$this->_request->getparam("keywords");
		$ask->isactive=$this->_request->getparam("isactive")==1?$this->_request->getparam("isactive"):1;
		$ask->ispublic=$this->_request->getparam("ispublic")?$this->_request->getparam("ispublic"):2;
        $url=array("微信智能问答列表"=>__BASEPATH.'weixin/ask/list',"添加/编辑智能问答"=>__BASEPATH.'weixin/ask/edit/id/'.$id);
        if(!$ask->question)
        {
            message("问题不能为空",$url);
        }
        $ask->answer=trim($this->_request->getParam('answer'));
        if(!$ask->answer)
        {
            message("答案不能为空",$url);
        }
        //判断模块名是否重复
        $tmp_ask=new Tweixin_ask();
		$org_id=$this->user['org_id'];
        $tmp_ask->whereAdd("question='".$ask->question."'");
        $tmp_ask->whereAdd("question='$ask->question' and org_id='$org_id' and id!='$id'");
        if($tmp_ask->count())
        {
            message("问题重复，请重新输入",$url);
        }
		$ask->staff_id=$this->user['uuid'];
		$ask->org_id=$this->user['org_id'];
        if($id)
        {
            $ask->whereAdd("id='$id'");
			$ask->updated=time();
            if($ask->update())
            {
                message("编辑问题成功",$url);
            }
            else
            {
                message("编辑问题失败",$url);
            }
        }
        else
        {
            $url=array("智能问答列表"=>__BASEPATH.'weixin/ask/list');
            $ask->id=uniqid('ask_');
            $ask->created=time();
            if($ask->insert())
            {
                message("新增问题成功",$url);
            }
            else
            {
                message("新增问题失败",$url);
            }
        }
    }
	/**
     * 
     *微信互动问答数据删除
     * 
     * @return void
     */
    public function deleteAction()
    {	
		$id=trim($this->_request->getParam('id')); 
        if($id)
        {
            $ask=new Tweixin_ask();
            $ask->whereAdd("id='$id'");
            if($ask->delete())
            {
                echo 'ok';
                exit;
            }
            else
            {
                echo 'failed';
                exit;
            }
        }
        else
        {
            echo 'failed';
            exit;
        }
    }
	/**
     * 
     *微信互动问答信息列表
     * 
     * @return void
     */
    public function listAction()
    {	
					
		$org_id=$this->user['org_id'];
		$s_question=$this->_request->getParam("s_question");
		$s_keywords=$this->_request->getParam("s_keywords");
		$weixin_ask=new Tweixin_ask();
		//添加搜索条件
		if($s_question){
			$weixin_ask->whereAdd("question like '%$s_question%'");
			$this->view->s_question=$s_question;
		}
		if($s_keywords){
			$weixin_ask->whereAdd("keywords='$s_keywords'");
			$this->view->s_keywords=$s_keywords;
		}
		$weixin_ask->whereAdd("org_id='$org_id' or ispublic=1");
		$nums = $weixin_ask->count();
        $page_size = 10;    //每页显示的条数
        $sub_pages = 8;          //每次显示的页数
        $pageCurrent = $this->_request->getParam('page');
        $links = new SubPages($page_size, $nums, $pageCurrent, $sub_pages, $this->_request->getBasePath() . $this->getModuleName() . '/' . $this->getControllerName() . '/' . $this->getActionName() . '/org_id/' . $org_id.'/s_question/'.$s_question.'/s_keywords/'.$s_keywords.'/page/', 2, array());
        $pageCurrent = $links->check_page($pageCurrent); //检查当前页数是否合法
        $startnum = $page_size * ($pageCurrent - 1);  //计算开始记录数
        $weixin_ask->limit($startnum, $page_size);
		$weixin_ask->find();
		$result=array();
		$index=0;
		while($weixin_ask->fetch()){
			//处理搜索结果，让问题的中的匹配内容高亮
			if($s_question){
				$result[$index]['question']=str_replace($s_question,"<strong style='color:red'>".$s_question."</strong>",$weixin_ask->question);
			}else{
				$result[$index]['question']=$weixin_ask->question;
			}
			
			$result[$index]['id']=$weixin_ask->id;
			$result[$index]['answer']=$weixin_ask->answer;
			$result[$index]['keywords']=$weixin_ask->keywords;
			$result[$index]['isactive']=$weixin_ask->isactive;
			$result[$index]['ispublic']=$weixin_ask->ispublic;
			$index++;
		}
		$this->view->result=$result;
		$out = $links->subPageCss2(); //获取显示样式，$out在smarty中将输出如下：
        $this->view->page = $out; //显示分页
        $this->view->pageCurrent = $pageCurrent; //当前页
		$this->view->display("list.html");
    }
	
}