<?php /* Smarty version 2.6.14, created on 2013-05-02 14:57:18
         compiled from index.html */ ?>

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
#box{width:600px;text-align:left;margin:0 auto;padding-top:80px;}
 #suggest,#suggest2{width:340px;font-size:12px; font-weight:normal;}
 .gray{color:gray;}
 .ac_results {background:#fff;border:1px solid #7f9db9;position: absolute;z-index: 10000;display: none;}
 .ac_results ul{margin:0;padding:0;list-style:none;}
 .ac_results li a{white-space: nowrap;text-decoration:none;display:block;color:#05a;padding:1px 3px;}
.ac_results li{border:1px solid #fff;}
.ac_over,.ac_results li a:hover {background:#c8e3fc;}
.ac_results li a span{float:right;}
.ac_result_tip{border-bottom:1px dashed #666;padding:3px;}


.box th { 
    font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
    color: #4f6b72; 
    border-right: 1px solid #C1DAD7; 
    border-bottom: 1px solid #C1DAD7; 
    border-top: 1px solid #C1DAD7; 
    letter-spacing: 2px; 
    text-transform: uppercase; 
    text-align: left; 
    padding: 6px 6px 6px 12px; 
    background: #CAE8EA url(images/bg_header.jpg) no-repeat; 
} 

.box th.nobg { 
    border-top: 0; 
    border-left: 0; 
    border-right: 1px solid #C1DAD7; 
    background: none; 
} 

.box td { 
    border-right: 1px solid #C1DAD7; 
    border-bottom: 1px solid #C1DAD7; 
    background: #fff; 
    font-size:11px; 
    padding: 6px 6px 6px 12px; 
    color: #4f6b72; 
    padding: 5px 2px 5px 2px;
	 empty-cells : show
} 
</style>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<title>雅安市卫生局网上预约挂号平台</title>
<link href="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/allt.css" rel="stylesheet" type="text/css">
</head>
<script type="text/javascript">
  $(document).ready(function(){
      var org_id=$("#orgs").val();
		getinfo(org_id);
		
	})
	function getinfo(org_id){ 
		$.get("<?php echo $this->_tpl_vars['basePath']; ?>
appointment/reservation/getinfo/org_id/"+org_id,function(info){
			$("#department").html(info);
		});
	}
	function search(){ 
		var org_id=$("#orgs").val(); 
		var department=$("#department").val();
		var department_id=$("#department_id").val();
		
		window.location="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/reservation/index/org_id/"+org_id+"/department/"+department_id;
		
	}
	
</script>
<body>
<!-- 头文件开始 -->
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0" class="top">
  <tbody><tr>
    <td><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/top.gif" width="980" height="81" alt="雅安市卫生局网上预约挂号平台"></td>
  </tr>
</tbody></table>
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0" class="menu">
  <tbody><tr>
    <td valign="top">
			<!-- 导航及搜索开始 -->
	<form action="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/index/add" method="post" name="formsh">
	<table width="930" border="0" align="center" cellpadding="0" cellspacing="0" class="marg">
      <tbody><tr>
        <td width="585" class="white"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/reservation/" class="white">首页</a>　|　<a href="#" class="white">预约指南</a>　|　<a href="#" class="white">最新公告</a>　|　<a href="#" class="white">常见问题</a>　|　<a href="#" class="white">常见病对应科室</a>　|　<a href="#" class="white">意见反馈</a></td>
        <td width="150">&nbsp;</td>
        
        <td width="140" align="center">&nbsp;</td>
        <td width="50" align="center">&nbsp;</td>
      </tr>
    </tbody></table>
	</form>
	<!-- 导航及搜索结束 -->	
	<!-- 登录开始 -->
	
	
	<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" class="marg15">
	<form name="form1" id="form1" method="post" >
      <tbody><tr>
       
        <td width="94" align="center" class="dblue">选择医院：</td>
        <td width="183"  class="inbg1">
        <select name="orgs" id="orgs" onchange="getinfo(this.value)" >
		<?php $_from = $this->_tpl_vars['orgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['value']):
?> 
			<option value="<?php echo $this->_tpl_vars['value']['org_id']; ?>
"<?php if ($this->_tpl_vars['value']['org_id'] == $this->_tpl_vars['org_id']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['value']['org_name']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>	
		</select>
        </td>
        <td width="60" align="center" class="dblue">&nbsp;科室：</td>
        <td width="80" align="center" class="inbg">
		<span id="department"></span>
		</td>        
        <td width="61" align="center" class="dblue">医生：</td>
		<td width="81" class="inbg"> 
		<input name="doctor" style="width:80px"/>
        <td width="79" align="center">
       <input onclick="search()"  type="button"  value="" style=" border:none;background-image:url(/images/index_files/search.gif); width:47px; height:22px; cursor:pointer"/>
        <td width="242" align="right"><a href="#" target="_blank" class="dblue">修改注册信息</a>　<a href="#" target="_blank" class="dblue">查询/取消预约</a></td>
      </tr>
    </tbody>
    </form>
    </table>
		<!-- 登录结束 -->	
	</td>
  </tr>
</tbody></table>
<!-- 头文件结束 -->


<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody><tr>
    <td><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/liucheng.gif" width="980" height="91"></td>
  </tr>
</tbody></table>
<!-- 预约挂号流程结束 -->
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0" class="marg">
  <tbody><tr>
    <td width="770" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td width="26"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_01.gif" width="26" height="34"></td>
        <td align="center" class="lmmenu"><a href="#" class="white">医生列表</a></td>
        <td align="right" valign="bottom" class="lmt_bg1"><a href="#" target="_blank" class="red"></a></td>
        <td width="10"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_03.gif" width="10" height="34"></td>
      </tr>
    </tbody></table>
	<table width="100%"  border="0"cellspacing="0" cellpadding="0"  class="box" style="border:1px #d2d2d2  solid;border-bottom:none; border-top:none;border-collapse:collapse;">
    <tbody><tr>
    <td width="14%" align="center" rowspan="2">排名不分先后</td>
    <?php $_from = $this->_tpl_vars['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
    <td align="center" colspan="2"><strong><?php echo $this->_tpl_vars['v']['day']; ?>
<br/><?php echo $this->_tpl_vars['v']['week']; ?>
</strong></td>
    
    <?php endforeach; endif; unset($_from); ?>

    
    </tr>
    <tr>
    <td border="1" width="8%" style="background-color:#E0EEEE; width:6%">上午</td>
    <td width="6%" style="background-color:#E6E6FA; width:6%">下午</td>
    <td width="6%" style="background-color:#E0EEEE; width:6%">上午</td>
    <td width="6%" style="background-color:#E6E6FA; width:6%">下午</td>
    <td width="6%" style="background-color:#E0EEEE; width:6%">上午</td>
    <td width="6%" style="background-color:#E6E6FA; width:6%">下午</td>
    <td width="6%" style="background-color:#E0EEEE; width:6%">上午</td>
    <td width="6%" style="background-color:#E6E6FA; width:6%">下午</td>
    <td width="6%" style="background-color:#E0EEEE; width:6%">上午</td>
    <td width="6%" style="background-color:#E6E6FA; width:6%">下午</td>
    <td width="6%" style="background-color:#E0EEEE; width:6%">上午</td>
    <td width="6%" style="background-color:#E6E6FA; width:6%">下午</td>
    <td width="6%" style="background-color:#E0EEEE; width:6%">上午</td>
    <td width="6%" style="background-color:#E6E6FA; width:6%">下午</td>
  </tr>
   <?php if ($this->_tpl_vars['rows']): ?> 
  <?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['r'] => $this->_tpl_vars['value']):
?>
  <tr>
    <td align="center" height="29"><b class="red12"><?php echo $this->_tpl_vars['value']['name']; ?>
</b> </td>
 
  <?php $_from = $this->_tpl_vars['value']['cols']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a'] => $this->_tpl_vars['v']):
?>
    <td  align="center"valign="middle">
   <?php if ($this->_tpl_vars['v']['day'] == 1 || $this->_tpl_vars['v']['day'] == 3): ?>
                                <?php if ($this->_tpl_vars['v']['week'] != -1): ?>
                                <?php if ($this->_tpl_vars['v']['register_num_net'] > 0): ?>
    <a href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/reservation/info/day/<?php echo $this->_tpl_vars['v']['consulting_time']; ?>
/register_time/1/uuid/<?php echo $this->_tpl_vars['v']['uuid']; ?>
"><img title="剩余号源个数：<?php echo $this->_tpl_vars['v']['register_num_net']; ?>
" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/yy.jpg" /></a>  
  <?php else: ?> 
   <img  src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/full.jpg" />   
  <?php endif; ?> 
  <?php endif; ?> 
  <?php endif; ?>
    </td>
    <td  align="center"valign="middle">
    <?php if ($this->_tpl_vars['v']['day'] == 2 || $this->_tpl_vars['v']['day'] == 3): ?>
                                <?php if ($this->_tpl_vars['v']['week'] != -1): ?>
                                <?php if ($this->_tpl_vars['v']['register_num_net'] > 0): ?>
    <a href="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/reservation/info/day/<?php echo $this->_tpl_vars['v']['consulting_time']; ?>
/register_time/2/uuid/<?php echo $this->_tpl_vars['v']['uuid']; ?>
"><img title="剩余号源个数：<?php echo $this->_tpl_vars['v']['register_num_net']; ?>
" src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/yy.jpg" /></a>  
  <?php else: ?> 
   <img  src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/full.jpg" />   
  <?php endif; ?> 
  <?php endif; ?> 
  <?php endif; ?>
    </td>
  
   <?php endforeach; endif; unset($_from); ?> 
  
   
  </tr>
  <?php endforeach; endif; unset($_from); ?>
   <?php else: ?>
   <tr>
   <td  align="center"colspan="15">暂时没有信息！</td></tr>
   <?php endif; ?>
    </tbody></table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody><tr>
    <td width="6"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_06.gif" width="6" height="6"></td>
    <td height="6" class="lh"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_07.gif" width="1" height="6"></td>
    <td width="6"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_08.gif" width="6" height="6"></td>
  </tr>
</tbody></table>
</td>
    <td>&nbsp;</td>
    <td width="200" valign="top">
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
          <td width="26"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_01.gif" width="26" height="34"></td>
          <td align="center" class="lmmenu"><a href="#" target="_blank" class="white">公告栏</a></td>
          <td background="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_02.gif">&nbsp;</td>
          <td width="10"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_03.gif" width="10" height="34"></td>
        </tr>
      </tbody></table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="box">
          <tbody><tr>
                      <td class="pad">
          
·<a href="#" target="_blank">预约挂号平台新增医院通知</a> <br>
·<a href="#" target="_blank" >301医院敬告患者</a><br>
·<a href="#" target="_blank">明卫生院恢复预约通知</a><br />
·<a href="#" target="_blank">雅安第一人民医院号源调整公告</a><br />
·<a href="#" target="_blank">预约挂号平台新增医院</a><br />
·<a href="#" target="_blank">关于用户未就诊处理通知</a><br />
·<a href="#" target="_blank">查询、取消预约注意事项<br /></a> </td>
          </tr>
        </tbody></table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody><tr>
            <td width="6"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_06.gif" width="6" height="6"></td>
            <td height="6" class="lh"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_07.gif" width="1" height="6"></td>
            <td width="6"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/lm_08.gif" width="6" height="6"></td>
          </tr>
      </tbody></table>
	  </td>
  </tr>
</tbody></table>
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0" class="marg10">
  <tbody><tr>
    <td width="770" valign="top">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="cjwt">
      <tbody><tr>
        <td width="145" align="center" valign="top" class="pad20"><a href="#" target="_blank"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/cjwt.gif" alt="常见问题" width="65" height="17" border="0"></a></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody><tr>
    <td width="20"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon01.gif" alt="" vspace="3" align="absmiddle"></td>
    <td width="280"><a href="#" target="_blank" class="blue">电话预约或网上预约挂号需要付费吗？</a></td>
    <td width="20"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon01.gif" alt="" vspace="3" align="absmiddle"></td>
    <td width="281"><a href="#" target="_blank" class="blue">预约前需要注册吗？</a></td>
  </tr>
  <tr>
    <td valign="top"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon02.gif" alt="" vspace="3" align="absmiddle"></td>
    <td><a href="#" target="_blank">...</a></td>
    <td valign="top"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon02.gif" alt="" vspace="3" align="absmiddle"></td>
    <td><a href="#" target="_blank">无论通过何种方式预约，预约前都需要实名制注册...</a></td>
  </tr>
  <tr>
    <td><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon01.gif" alt="" vspace="3" align="absmiddle"></td>
    <td><a href="#" target="_blank" class="blue">能预约专家号吗？ </a></td>
    <td><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon01.gif" alt="" vspace="3" align="absmiddle"></td>
    <td><a href="#" target="_blank" class="blue">可以提前几天预约？</a></td>
  </tr>
  <tr>
    <td valign="top"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon02.gif" alt="" vspace="3" align="absmiddle"></td>
    <td><a href="#" target="_blank">根据雅安市卫生局医改新政策按医院、科室、职称...</a></td>
    <td valign="top"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
images/index_files/icon02.gif" alt="" vspace="3" align="absmiddle"></td>
    <td><a href="#" target="_blank">统一平台不提供当日预约服务，用户可预约接入统一平...</a></td>
  </tr>
</tbody></table></td>
        </tr>
    </tbody></table>	</td>
    <td>&nbsp;</td>
    <td width="200" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td height="77" align="center"><a href="#" target="_blank"></a></td>
      </tr>
      <tr>
        <td height="77" align="center">&nbsp;</td>
      </tr>

    </tbody></table>
      </td>
  </tr>
</tbody></table>
<!-- 尾文件开始 -->
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0" class="foot">
  <tbody><tr>
    <td align="center" class="f12px"> <a href="#" target="_blank">联系我们</a> ┊ <a href="#" target="_blank">合作伙伴</a> ┊ <a href="#" target="_blank">法律声明</a> ┊ <a href="#" target="_blank">意见反馈</a><br>
     
    </td>
  </tr>
</tbody></table>



<!-- 尾文件结束 -->
<script type="text/javascript" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>


</body></html>