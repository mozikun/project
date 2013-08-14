<?php
/**
 * weixin
 * 
 * 微信接口处理类
 * 
 * @package yaan
 * @author 我好笨
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class weixin
{
    private $data=array();
    public function __construct($echoStr,$signature,$timestamp,$nonce)
    {
        //valid signature , option
        if($echoStr && $this->checkSignature($signature,$timestamp,$nonce))
        {
        	echo $echoStr;
        	exit;
        }
    }
    /**
     * weixin::getparams()
     * 
     * 返回用户请求参数
     * 
     * @return mixed
     */
    public function getparams()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        //file_put_contents(__SITEROOT.'cache/yaan_input_'.date('Y-m-d').'.log',$postStr);
        $postStr = $postStr?$postStr:file_get_contents("php://input");
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $this->data['fromUsername'] = $postObj->FromUserName;//发送方帐号（一个OpenID）
        $this->data['toUsername'] = $postObj->ToUserName;//开发者微信号
        $this->data['keyword'] = trim($postObj->Content);//文本消息内容
        //判断提交信息的类型
        $this->data['msgType']=strip_tags($postObj->MsgType);//消息类型，目前仅支持 text,event两种类型，link,location,image类型均不支持
        $this->data['event']=strip_tags($postObj->Event);
        $this->data['CreateTime']=$postObj->CreateTime;
        return $this->data;
    }
    /**
     * weixin::responseText()
     * 
     * 响应返回文本信息
     * 
     * @param mixed $contentstr
     * @return void
     */
    public function responseText($contentstr)
    {
        //文本内容
        $textTpl = "<xml>
				    <ToUserName><![CDATA[%s]]></ToUserName>
				    <FromUserName><![CDATA[%s]]></FromUserName>
				    <CreateTime>%s</CreateTime>
				    <MsgType><![CDATA[%s]]></MsgType>
				    <Content><![CDATA[%s]]></Content>
				    <FuncFlag>0</FuncFlag>
				    </xml>";
        $time=time();
        $resultStr = sprintf($textTpl, $this->data['fromUsername'], $this->data['toUsername'], $time, 'text', $contentstr);
        $this->responseMsg($resultStr);
    }
    /**
     * weixin::responseList()
     * 
     * 响应返回图文信息
     * 
     * @param array $content_array
     * @return void
     */
    public function responseList($content_array=array())
    {
        $textTpl = '<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <ArticleCount>%d</ArticleCount>
                    <Articles>%s</Articles>
                    <FuncFlag>1<FuncFlag>
                    </xml>';
        $itemTpl = '<item>
                             <Title><![CDATA[%s]]></Title>
                             <Discription><![CDATA[%s]]></Discription>
                             <PicUrl><![CDATA[%s]]></PicUrl>
                             <Url><![CDATA[%s]]></Url>
                         </item>';
        //取机构信息
        require_once __SITEROOT . "library/Models/weixin_setorg.php";
        $orgs=new Tweixin_setorg();
        $orgs->whereAdd("account_name='".$this->data['toUsername']."'");
        $orgs->find(true);
        require_once __SITEROOT . "library/Models/organization.php";
        $org=new Torganization();
        $org->whereAdd("id='".$orgs->org_id."'");
        $org->find(true);
        $orgname=$org->zh_name?$org->zh_name:'雅安市区域卫生信息平台';
        $orgpic="http://182.132.138.30:8866/images/wx.png";
        $orgdesc=$orgname;
        $url='';
        $contentstr=sprintf($itemTpl, $orgname, $orgdesc,$orgpic, $url);
        if(!empty($content_array))
        {
            foreach($content_array as $k=>$v)
            {
                $contentstr.=sprintf($itemTpl, $v['title'], $v['desc'],$v['pic'], $v['url']);
            }
        }
        $time=time();
        $resultStr = sprintf($textTpl, $this->data['fromUsername'], $this->data['toUsername'], $time, 'news',count($content_array)+1, $contentstr);
        $this->responseMsg($resultStr);
    }
    /**
     * weixin::responseSubscribe()
     * 
     * 响应返回关注事件
     * 
     * @param mixed $contentstr
     * @return void
     */
    public function responseSubscribe($contentstr)
    {
        $this->responseText($contentstr);
    }
    /**
     * weixin::responseMsg()
     * 
     * 响应用户请求并记录日志
     * 
     * @param mixed $text
     * @return void
     */
    private function responseMsg($text)
    {
        header('Content-Type: application/xml; charset=utf-8');
        //写日志表
        require_once __SITEROOT . "library/Models/weixin_logs.php";
        require_once __SITEROOT . "library/Models/weixin_setorg.php";
        require_once __SITEROOT . "library/Models/weixin_user.php";
        require_once __SITEROOT . "library/custom/wechat.class.php";
        if($this->data['fromUsername'])
        {
            $orgs=new Tweixin_setorg();
            $orgs->whereAdd("account_name='".$this->data['toUsername']."'");
            $orgs->find(true);
            if($orgs->org_id)
            {
                $users=new Tweixin_user();
                $users->whereAdd("wx_username='".$this->data['fromUsername']."'");
                $users->whereAdd("org_id='".$orgs->org_id."'");
                if(!$users->count() && $this->data['msgType']=='event' && $this->data['event']=='subscribe')
                {
                    $tmp_user=new Tweixin_user();
                    $tmp_user->orderBy('userid DESC');
                    $tmp_user->find(true);
                    $max=intval($tmp_user->userid);
                    $tmp_user->free_statement();
                    //新建用户
                    $user=new Tweixin_user();
                    $user->uuid=uniqid('wx_',true);
                    $user->userid=$max+1;
                    $user->wx_username=$this->data['fromUsername'];
                    $user->org_id=$orgs->org_id;
                    $user->add_time=time();
                    $user->org_wxid=$this->data['toUsername'];
                    $user->insert();
                }
                //判断发送消息的微信号是否有fakeid，没有则获取fakeid
                $users->find(true);
                if($orgs->wx_platform_name && $orgs->wx_platform_pw && !$users->fakeid)
                {
                    $options = array('account'=>$orgs->wx_platform_name,'password'=>base64_decode($orgs->wx_platform_pw));
                    $wechatObj = new Wechat($options);  //创建Wechat的实例并初始化参数
                    $wechatObj->setCookiefilepath(__SITEROOT."cache/");  //设置cookie文件保存目录
                    $wechatObj->setWebtokenStoragefile(__SITEROOT."cache/webtoken_".$orgs->org_id.".txt");  //设置webtoken的保存路径（包括文件名），您不需要主动发送消息不需要设置
                    if($wechatObj->login())
                    {
                        $result=$wechatObj->getTopMsg();
                        if(isset($result['fakeId']) && $this->data['CreateTime']==$result['dateTime'])
                        {
                            $user=new Tweixin_user();
                            $user->whereAdd("wx_username='".$this->data['fromUsername']."'");
                            $user->whereAdd("org_id='".$orgs->org_id."'");
                            $user->fakeid=$result['fakeId'];
                            $user->nickname=$result['nickName'];
                            $user->update();
                        }
                    }
                    else
                    {
                        //写登录错误日志
                    }
                }
            }
            //写日志
            $logs=new Tweixin_logs();
            $logs->uuid=uniqid('wx_',true);
            $logs->content=$this->data['keyword'];
            $logs->reply=1;
            $logs->weixin_id=$this->data['fromUsername'];
            $logs->org_id=$orgs->org_id;
            $logs->add_time=time();
            $logs->wx_event=$this->get_event();
            $logs->insert();
        }
        //file_put_contents(__SITEROOT.'cache/yaan_output_'.date('Y-m-d').'.log',$text);
        echo $text;
        exit;
    }
    /**
     * weixin::get_event()
     * 
     * 获取时间类型
     * 
     * @return
     */
    private function get_event()
    {
        if($this->data['msgType']=='event' && $this->data['event']=='subscribe')
        {
            return 1;
        }
        elseif($this->data['msgType']=='event' && $this->data['event']=='unsubscribe')
        {
            return 2;
        }
        elseif($this->data['msgType']=='text')
        {
            return 3;
        }
        elseif($this->data['msgType']=='news')
        {
            return 4;
        }
        elseif($this->data['msgType']=='image')
        {
            return 5;
        }
        elseif($this->data['msgType']=='location')
        {
            return 6;
        }
        elseif($this->data['msgType']=='link')
        {
            return 7;
        }
        else
        {
            return 8;
        }
    }
    /**
     * weixin::checkSignature()
     * 
     * 检测token是否合法
     * 
     * @return
     */
    private function checkSignature($signature,$timestamp,$nonce)
	{
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	} 
}