<?php /* Smarty version 2.6.14, created on 2013-04-27 20:14:06
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>四川雅安“4.20”地震接受捐赠药品明细表</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
<style>
	table
	{
		background:#ffffff;
	}
	.line
	{
		border-top:0px;
		border-left:0px;
		border-right:0px;
	}
</style>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/skin/default/datePicker.css" rel="stylesheet" type="text/css" />
<!--引入jquery-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js" type="text/javascript"></script>
</head>
<body>
<form action="" id="search" method="post">
<table border="0" width="100%">
<tr><td>统计日期：<input type="text" name="start_time" value="<?php echo $this->_tpl_vars['search']['start_time']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd H:m:s'})" class="Wdate" size="25" />至<input type="text" name="end_time" value="<?php echo $this->_tpl_vars['search']['end_time']; ?>
" class="Wdate" size="25" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd H:m:s'})" />&nbsp;&nbsp;<input type="submit" value="搜索" /></td></tr>
</table>
</form>		
<table border="0" width="100%">
    <tr class="headbg">
    	<td colspan="12">
        	四川雅安“4.20”地震接受捐赠药品明细表
        </td>
	</tr>
    <tr class="columnbg">
    <td rowspan="2">
       		 &nbsp;
		</td>
			        <td colspan="2">口服药品</td>
                    <td colspan="2">注射剂</td>
                    <td colspan="2">抗生素</td>
                    <td colspan="2">毒麻药品</td>
                    <td colspan="2">外用药品</td>
  <td rowspan="2">
       		 录入时间
		</td>
    </tr>
    <tr class="title">
                <td>品种</td><td>金额</td>
                <td>品种</td><td>金额</td>
                <td>品种</td><td>金额</td>
                <td>品种</td><td>金额</td>
                <td>品种</td><td>金额</td>
     </tr>
     <form name="do_all" id="do_all" method="post">
	<?php unset($this->_sections['jsjzypmxs']);
$this->_sections['jsjzypmxs']['name'] = 'jsjzypmxs';
$this->_sections['jsjzypmxs']['loop'] = is_array($_loop=$this->_tpl_vars['jsjzypmxs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['jsjzypmxs']['show'] = true;
$this->_sections['jsjzypmxs']['max'] = $this->_sections['jsjzypmxs']['loop'];
$this->_sections['jsjzypmxs']['step'] = 1;
$this->_sections['jsjzypmxs']['start'] = $this->_sections['jsjzypmxs']['step'] > 0 ? 0 : $this->_sections['jsjzypmxs']['loop']-1;
if ($this->_sections['jsjzypmxs']['show']) {
    $this->_sections['jsjzypmxs']['total'] = $this->_sections['jsjzypmxs']['loop'];
    if ($this->_sections['jsjzypmxs']['total'] == 0)
        $this->_sections['jsjzypmxs']['show'] = false;
} else
    $this->_sections['jsjzypmxs']['total'] = 0;
if ($this->_sections['jsjzypmxs']['show']):

            for ($this->_sections['jsjzypmxs']['index'] = $this->_sections['jsjzypmxs']['start'], $this->_sections['jsjzypmxs']['iteration'] = 1;
                 $this->_sections['jsjzypmxs']['iteration'] <= $this->_sections['jsjzypmxs']['total'];
                 $this->_sections['jsjzypmxs']['index'] += $this->_sections['jsjzypmxs']['step'], $this->_sections['jsjzypmxs']['iteration']++):
$this->_sections['jsjzypmxs']['rownum'] = $this->_sections['jsjzypmxs']['iteration'];
$this->_sections['jsjzypmxs']['index_prev'] = $this->_sections['jsjzypmxs']['index'] - $this->_sections['jsjzypmxs']['step'];
$this->_sections['jsjzypmxs']['index_next'] = $this->_sections['jsjzypmxs']['index'] + $this->_sections['jsjzypmxs']['step'];
$this->_sections['jsjzypmxs']['first']      = ($this->_sections['jsjzypmxs']['iteration'] == 1);
$this->_sections['jsjzypmxs']['last']       = ($this->_sections['jsjzypmxs']['iteration'] == $this->_sections['jsjzypmxs']['total']);
?>
	 <tr>
     <td>
       		 <input type="checkbox" name="ids[]" value="<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['uuid']; ?>
" />
		</td>
	 	<td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['kfyppz']; ?>

        </td>
		<td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['kfypje']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['zsyppz']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['zsypje']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['ksyppz']; ?>

        </td><td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['ksypje']; ?>

        </td><td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['dmyppz']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['dmypje']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['yyyppz']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['yyypje']; ?>

        </td>
        <td>
        	<?php echo $this->_tpl_vars['jsjzypmxs'][$this->_sections['jsjzypmxs']['index']]['created']; ?>

        </td>
	</tr>
	<?php endfor; else: ?>
	<tr>
		<td colspan="12">
        	暂时没有符合条件的数据
        </td>
	</tr>
	<?php endif; ?>
    </form>
	<tr>
		<td colspan="12">
        	&nbsp;<input type="checkbox" onclick="select_all(this)" />全选 &nbsp;&nbsp;<a href="###" onclick="do_select('<?php echo $this->_tpl_vars['basePath']; ?>
ya420/jsjzypmx/tianbao')">+今日填报</a>&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
ya420/jsjzypmx/edit">+新增明细记录</a>
        </td>
	</tr>
	</tbody>
</table>
</body>
</html>
<script>
function select_all(frm) {
	$("td").find("input").each(function(){
		if(this.type) {
			if(this.type=="checkbox") {
				if(frm.checked) {
					$(this).attr("checked","checked");
				}else{
					$(this).removeAttr("checked");
				}
			}
		}
	});
}
function do_select(furl)
{
    if($("input[type='checkbox']:checked").length<1)
    {
        alert("请选择要上报的记录");
        return false;
    }
	$.ajax({
     		type:"post",
     		url:"<?php echo $this->_tpl_vars['basePath']; ?>
ya420/jsjzypmx/doall",
     		dataType:"html",
     		data:$("#do_all").serialize(),
     		success:function(data)
            {
				//alert(data);
	            window.location=furl;
	     	},
	        error:function()
	        {
	            alert('连接服务器错误');
	        }
      });
}
</script>