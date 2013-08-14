<?php /* Smarty version 2.6.14, created on 2013-04-28 09:20:42
         compiled from list.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/calendar/WdatePicker.js"></script>
		<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/vtip.css" />
       <link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />

        <title><?php echo $this->_tpl_vars['title']; ?>
</title>
	
    </head>
    <body>
<form action="" id="search" method="post">
<table border="0" width="100%">
<tr><td>统计日期：<input type="text" name="start_time" value="<?php echo $this->_tpl_vars['search']['start_time']; ?>
" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd H:m:s'})" class="Wdate" size="25" />至<input type="text" name="end_time" value="<?php echo $this->_tpl_vars['search']['end_time']; ?>
" class="Wdate" size="25" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd H:m:s'})" />&nbsp;&nbsp;<input type="submit" value="搜索" /></td></tr>
</table>
</form>		
          
            <table  cellspacing="0" width="100%">
                <thead>

                </thead>
                <tr  class="headbg">
                    <th  colspan="22">门（急）诊伤员医疗救治信息</th>
                </tr>
				
                <tbody id='1'>

                    <tr class='title'>
						<td rowspan='2'></td>
                        <td  rowspan= '2'  >患者姓名</td>
                        <td  rowspan='2' >性别</td>
                        <td  rowspan='2' >年龄</td>
                        <td  rowspan='2' >患者来源</td>
                        <td  rowspan='2' >联系电话</td>
                        <td  rowspan='2' >地震伤疾病名称</td>
                        <td  rowspan='2' >请注明受伤原因</td>
                        <td  rowspan='2' >非地震伤病员疾病名称</td>
                        <td  rowspan='2' >外伤请注明受伤原因</td>
                        <td  rowspan='2' >是否急诊(是填1)</td>
                        <td  colspan='4'>门诊伤员救治效果</td>
                        <td  rowspan='2'>是否手术(是填1)</td>
                        <td  rowspan='2'>手术名称</td>
                    </tr>
					
					<tr >
                        <td  >转住院(是填1) </td>
                        <td  >转住院医院名称</td>
                        <td  >处理后离开(是填1)</td>
                        <td  >死亡(是填1)</td>
                       
                    </tr>
				<form method="post" id="do_all" name="do_all">	
					<?php $_from = $this->_tpl_vars['mzsyyljz_rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <tr>  
                      <td>
					  
       		            <input type="checkbox" name="ids[]" value="<?php echo $this->_tpl_vars['item']['uuid']; ?>
"/> </td>	
						<td><?php echo $this->_tpl_vars['item']['xm']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['xb']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['age']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['hzly']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['lxdh']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['dzsjbymc']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['ssyy']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['fdzssbymc']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['fdzssyy']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['sfjz']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['jz_zzy']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['jz_zzymc']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['jz_clhlk']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['jz_sw']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['sfss']; ?>
</td>
						<td><?php echo $this->_tpl_vars['item']['ssmc']; ?>
</td>
					</tr> 
					<?php endforeach; endif; unset($_from); ?>	
				</form>
				<tr>
		            <td colspan="17">
        	        <input type="checkbox" onclick="select_all(this)" />全选 &nbsp;&nbsp;<a href="###" onclick="do_select('<?php echo $this->_tpl_vars['basePath']; ?>
ya420/jzsyyljzxx/tianbao')">+今日填报</a>&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
ya420/jzsyyljzxx/edit">+新增明细记录</a>
        </td>
	</tr>
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
ya420/jzsyyljzxx/doall",
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