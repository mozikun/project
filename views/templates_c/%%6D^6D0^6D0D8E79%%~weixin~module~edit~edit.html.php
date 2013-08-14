<?php /* Smarty version 2.6.14, created on 2013-06-20 13:53:19
         compiled from edit.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加/编辑微信模块</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css">
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<style>
	table
	{
		background:#ffffff;
	}
	.nobg table,td,tr
	{
		border:0px;
	}
	.line_table td
	{
		border:1px solid #ccc;
		margin:2px 0px 2px 0px;
	}
	.none
	{
	    border:1px solid #FFF;
		border-bottom:1px solid #ccc;
	}
    .input{
	margin-right:6px;
    border:1px solid #ccc;
    }
</style>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/vtip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>   <!--时间控件的加载!-->
</head>
<body>
<table border="0" width="100%" class="line_table">
	<form method="post" action="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/module/editin" onsubmit="editor.sync()">
	<tr class="headbg">
		<td colspan="2">
        	微信模块<?php if (! $this->_tpl_vars['module']->uuid): ?>添加<?php else: ?>编辑<?php endif; ?>
        </td>
	</tr>
			    <tr>
			        <td>模块名称:&nbsp;</td>
                    <td>
						<input type="hidden" name="uuid" value="<?php echo $this->_tpl_vars['module']->uuid; ?>
" />
						<input type="text" name="module_name" value="<?php echo $this->_tpl_vars['module']->module_name; ?>
" size="45" />*中文名称，标识作用
			        </td>
                </tr>
                <tr>
                    <td>模块编码:&nbsp;</td>
                    <td>
                          <input type="text" name="module_code" value="<?php echo $this->_tpl_vars['module']->module_code; ?>
" size="25" onblur="chk_code()" />*请尽量精简一点，比如慢病模块，可输入"mb"，用户则在微信端输入"mb:2013-06-12"来查询输入日期的随访记录
			        </td>			
				</tr>
                <tr>
                    <td>列表URL:&nbsp;</td>
                    <td>
						<input type="text" name="list_url" value="<?php echo $this->_tpl_vars['module']->list_url; ?>
" size="45" />*提供列表功能的url地址，比如"weixin/mb/index"
			        </td>
                </tr>
				<tr>
                    <td>API地址:&nbsp;</td>
                    <td>
                          <input type="text" name="api_url" value="<?php echo $this->_tpl_vars['module']->api_url; ?>
" readonly="readonly" size="45" />*提供处理用户微信端录入数据的url地址，比如"weixin/api/mb"
			        </td>			
				</tr>
                <tr>
                    <td>首页选项:&nbsp;</td>
                    <td>
                          <input type="checkbox" name="is_index" value="1" <?php if ($this->_tpl_vars['module']->is_index == 1): ?> checked="checked"<?php endif; ?> />首页显示
			        </td>			
				</tr>
                <tr>
                    <td>状态:&nbsp;</td>
                    <td>
                          <input type="radio" name="status" value="1" id="status_1" <?php if ($this->_tpl_vars['module']->status == 1): ?> checked="checked"<?php endif; ?> /><label for="status_1">启用</label>
                          <input type="radio" name="status" value="2" id="status_2" <?php if ($this->_tpl_vars['module']->status == 2): ?> checked="checked"<?php endif; ?> /><label for="status_2">禁用</label> 
			        </td>			
				</tr>
	<tr>
		<td style="text-align:center;" colspan="2">
        	<input type="submit" value="保存内容" class="input" style="height: 28px;font-size:14px;"  />
	</tr>
	</form>
</table>
</body>
</html>
<script>
function chk_code()
{
    var module_code=$("input[name='module_code']").val();
    if(module_code)
    {
        $("input[name='api_url']").val('weixin/api/do/code/'+module_code);
        $.ajax({
                    type: "get",
                    url: "<?php echo $this->_tpl_vars['basePath']; ?>
weixin/module/chk/code/"+module_code+"/uuid/"+$("input[name='uuid']").val(),
                    dataType: "html",
                    data: "",
                    success: function(data){
                        if(data!="ok")
						{
							alert("模块代码重复，请重新录入");
                            $("input[name='module_code']").focus();
						}
                        return false;
                    },
                    error: function(){
                        alert("服务器返回信息不完整，请重试");
                        return false;
                    }
                });
    }
    else
    {
        alert("请输入模块代码");
        $("input[name='module_code']").focus();
    }
}
</script>