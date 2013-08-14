<?php /* Smarty version 2.6.14, created on 2013-07-05 14:04:46
         compiled from add.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" media="all" type="text/css" rel="stylesheet"/>
<title><?php if ($this->_tpl_vars['add_tag']): ?>微信机构设置添加<?php else: ?>微信机构设置编辑<?php endif; ?></title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return check_form();">
<table border="1px" align="center" width="100%">
     <tr class="headbg">
       <td colspan="4"><strong><?php if ($this->_tpl_vars['add_tag']): ?><font color="red"><?php echo $this->_tpl_vars['zh_name']; ?>
</font>微信机构设置添加<?php else: ?><font color="red"><?php echo $this->_tpl_vars['zh_name']; ?>
</font>微信机构设置编辑<?php endif; ?></strong></td>
     </tr>
     <tr>
         <td>微信公众账号:</td>
       <td>
          <input type="text" name="account_name" value="<?php echo $this->_tpl_vars['account_name']; ?>
" id="account_name" />
        </td>
     </tr>
     <tr>
        <td>默认微信回复：</td>
        <td>
            <textarea name="default_replay" rows="8" cols="40"><?php if ($this->_tpl_vars['add_tag']):  echo $this->_tpl_vars['default_replay_add'];  else:  echo $this->_tpl_vars['default_replay'];  endif; ?></textarea>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php if (! $this->_tpl_vars['add_tag']): ?>logo图片：<img src="<?php echo $this->_tpl_vars['logo_name']; ?>
"  width="180px" height="80px" /><?php endif; ?>
        </td>
     </tr>
    <tr>
       <td>账号接口地址：</td>
       <td>
             <?php if ($this->_tpl_vars['add_tag']): ?><input name="api_url" id="api_url" type="hidden"  value="<?php echo $this->_tpl_vars['created_api_url']; ?>
" /><?php endif; ?>
             <?php echo $this->_tpl_vars['created_api_url']; ?>

       </td>
    </tr>
    <tr>
       <td>TOKEN：</td>
       <td>
           <?php if ($this->_tpl_vars['add_tag']): ?><input name="token_str" id="token_str" type="hidden"  value="<?php echo $this->_tpl_vars['created_token']; ?>
"  /><?php endif; ?>
           <?php echo $this->_tpl_vars['created_token']; ?>

       </td>
    </tr>
    <tr>
       <td>机构logo上传：</td>
       <td><input name="logo_name" id="logo_name" type="file"   />请上传640*320像素大小的图片</td>
    </tr>
    <tr>
         <td>微信公众平台登录账号:</td>
       <td>
          <input type="text" name="wx_platform_name" value="<?php echo $this->_tpl_vars['wx_platform_name']; ?>
" id="wx_platform_name" />*只有需要群发消息的机构才设置此项
        </td>
     </tr>
     <tr>
         <td>微信公众平台登录密码:</td>
       <td>
          <input type="password" name="wx_platform_pw" id="wx_platform_pw" />*只有需要群发消息的机构才设置此项<?php if (! $this->_tpl_vars['add_tag']): ?>，如果密码未更改，编辑时无须填写<?php endif; ?>
        </td>
     </tr>
    <tr >
      <td colspan="2">
      <div align="center">
      <?php if ($this->_tpl_vars['add_tag']): ?>
          <input type="submit" name="ok" value="添加" />
          <?php else: ?><input type="submit" name="ok" value="修改" /><?php endif; ?>         
      </div></td>
    </tr>
</table>
</form>
</body>
</html>
<script type="text/javascript">
   /* function add_url()
    {
        var api_url = $("#api_url");
        var token_str = $("#token_str");
        var api_url_val = api_url.val();
        var api_url_array = api_url_val.split('/');
        //取得有多少个斜杠
        var array_count = api_url_array.length;
        if(array_count==3)
         {
               api_url.val(api_url_val+'/'+token_str.val());
         }
         else if(array_count==4)
         {
              var new_str = api_url_array[0]+'/'+api_url_array[1]+'/'+api_url_array['2'];
              api_url.val(new_str+'/'+token_str.val());
         }
    }
    */
    function check_form()
    {
        var account_name = $("#account_name");
        var api_url = $("#api_url");
        var token_str = $("#token_str");
        if(account_name.val()=='')
            {
                alert("微信账号不能为空");
                account_name.focus();
                return false;
            }
          if(api_url.val()=='')
            {
                alert("账号接口地址不能为空");
                api_url.focus();
                return false;
            }
            if(token_str.val()=='')
            {
                alert("TOKEN串不能为空");
                token_str.focus();
                return false;
            }
    }
</script>