<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class weixin_setorgController extends controller
{
    public function init()
    {
        require_once __SITEROOT.'library/privilege.php';    
        require_once __SITEROOT.'application/weixin/model/__autoload.php';//自动加载数据库模型类
        $this->view->basePath     =  __BASEPATH;
        define('API_URL', 'http://wx.wohaoben.com/yaan.php?token=');
    }    
    public function indexAction()
    {
        $auth_session = $this->user;  
         if(!empty($auth_session['org_id']))
         {       
             $current_org_id = $auth_session['org_id'];
              //取得机构名称
             $organization = new Torganization();
             $organization->whereAdd("id=$current_org_id");
             $organization->find(true);     
              //查询数据表中是否有当前这样的机构存在如果有就编辑如果没有就添加
             $weixin_setorg =  new Tweixin_setorg();
             $weixin_setorg->whereAdd("org_id=$current_org_id");
             //取得机构的名称
             if($weixin_setorg->count()>0)
             {
                 //编辑
                 $add_tag = false;
                 $weixin_setorg->find(true);
                 $this->view->account_name = $weixin_setorg->account_name;
                 $this->view->default_replay = $weixin_setorg->default_replay;
                 $this->view->created_api_url = $weixin_setorg->api_url;
                 $this->view->created_token = $weixin_setorg->token_str;
                 $this->view->wx_platform_name = $weixin_setorg->wx_platform_name;
                 $this->view->wx_platform_pw = $weixin_setorg->wx_platform_pw;
                 if(!empty($weixin_setorg->logo_name))
                 {
                        $this->view->logo_name = __BASEPATH.'upload/'.$weixin_setorg->logo_name;
                 }
                 else
                 {
                      $this->view->logo_name = __BASEPATH.'images/wx.png';
                 }
             }
             else
             {
                 //新增
                 $add_tag = true;
                //生成一个token值
                $created_token = md5(((float) date("YmdHis") + rand(10000000000000000,99999999999999999)).rand(100000,999999));  
                $created_token = mb_substr($created_token, 0,20);
                $created_api_url = API_URL.$created_token;
                $this->view->created_token = $created_token;
                $this->view->created_api_url = $created_api_url;
                 $this->view->default_replay_add  = "欢迎光临{$organization->zh_name}的微信平台!";
             }
             //开始进行数据搜集
             $ok = $this->_request->getParam('ok');
             if(!empty($ok))
             {
                  $account_name_post = $this->_request->getParam('account_name');
                  $default_replay_post  = $this->_request->getParam('default_replay');
                  $api_url_post              = $this->_request->getParam('api_url');
                  $token_str_post              = $this->_request->getParam('token_str');
                  $wx_platform_name              = $this->_request->getParam('wx_platform_name');
                  $wx_platform_pw              = $this->_request->getParam('wx_platform_pw');
                  $wx_platform_pw=$wx_platform_pw?base64_encode($wx_platform_pw):'';
                  $file_name =  $this->upload('logo_name', $current_org_id);
                  $file_name_array = explode('|', $file_name);
                 // var_dump($file_name_array);
                  $weixin_setorg_option = new Tweixin_setorg();
                  $weixin_setorg_option->account_name = $account_name_post;
                  $weixin_setorg_option->default_replay = $default_replay_post;              
                  $weixin_setorg_option->updated = time();
                  $weixin_setorg_option->wx_platform_name=$wx_platform_name;
                  if($file_name_array[1]==1)//上传成功  只传给定了图片的内容
                  {
                      $weixin_setorg_option->logo_name = $file_name_array[0];            
                  }
                  if($add_tag)
                  {
                      $weixin_setorg_option->uuid = uniqid('w_',true);
                      $weixin_setorg_option->created = time();
                      $weixin_setorg_option->org_id = $current_org_id;
                      $weixin_setorg_option->api_url = $api_url_post;   
                      $weixin_setorg_option->token_str = $token_str_post;
                      $weixin_setorg_option->wx_platform_pw=$wx_platform_pw; 
                      if($weixin_setorg_option->insert())
                      {
                          $this->redirect(__BASEPATH.'weixin/setorg/index');
                      }
                  }
                  else
                  {    
                      if($wx_platform_pw)
                      {
                        $weixin_setorg_option->wx_platform_pw=$wx_platform_pw;
                      }
                      $weixin_setorg_option->whereAdd("org_id=$current_org_id");
                      if($weixin_setorg_option->update())
                      {
                           $this->redirect(__BASEPATH.'weixin/setorg/index');
                      }
                  }
                  //var_dump($file_name);
             }
             $this->view->add_tag = $add_tag;        
             $this->view->zh_name = $organization->zh_name;
             $organization->free_statement();
         }
         else
         {
             throw  new Exception("参数错误,机构不存在!");
         }
         $this->view->display('add.html');
    }
   private function upload($input_name,$org_id)
    {
               //处理机构logo上传
                //上传目录
                $upload_dir = __SITEROOT . "upload/";
                $allow_overwrite = 1;
                $allow_rename = 1;
                $file_error = "";
                $allow_ext = array(
                    "jpg",
                    "jpeg",
                    "gif",
                    "bmp",
                    "png");
                //判定是否有文件上传
                if (empty($_FILES))
                {
                    $file_error = "没有logo要上传";
                }
                //上传文件处理
                if (!is_dir($upload_dir) || !is_writable($upload_dir))
                {
                    $file_error = "logo存储目录" . $upload_dir . "不存在或者不可写";
                }
                //不能重写，也不能重命名
                if (!$allow_overwrite && $allow_rename && file_exists($upload_dir . $_FILES[$input_name]['name']))
                {
                    $file_error = "文件" . $upload_dir . "已存在，相关设置不能重命名文件";
                }
                //判定是否有上传文件
                if (@is_uploaded_file($_FILES[$input_name]['tmp_name']))
                {
                    //判定文件格式是否符合要求
                    $ext = substr($_FILES[$input_name]['name'], strpos($_FILES[$input_name]['name'], '.') +
                        1, strlen($_FILES[$input_name]['name']));
                    if (@!in_array(strtolower($ext), $allow_ext))
                    {
                        $file_error = 'logo上传失败，你选择的文件不在允许的范围之内';
                    }
                    else
                    {
                        //强制重命名
                        $filename = iconv('utf-8', 'gb2312', $_FILES[$input_name]['name']);
                        if ($allow_rename)
                        {
                            $filename = 'org_logo_' .$org_id. ".gif";
                        }
                        //允许覆盖
                        if ($allow_overwrite)
                        {
                            if (@is_file($upload_dir . $filename))
                            {
                                @unlink($upload_dir . $filename);
                            }
                        }
                        if (!@move_uploaded_file($_FILES[$input_name]['tmp_name'], $upload_dir . $filename))
                        {
                            $file_error = "logo上传失败，请检查文件夹是否可以写";
                        }
                        else
                        {
                            //文件上传成功--添加写入数据库
                            $file_error = 1;
                            return $filename.'|'.$file_error;
                        }
                    }
                }
    }
}
?>
