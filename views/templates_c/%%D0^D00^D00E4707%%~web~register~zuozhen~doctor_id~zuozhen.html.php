<?php /* Smarty version 2.6.14, created on 2013-09-13 17:16:04
         compiled from zuozhen.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../default/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <!--导航栏结束，主体开始-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>	
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/school.js"></script>	
<style>
.box{
	margin:5px;
}
.box th { 
    font: bold 15px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
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
    font-size:12px; 
    padding: 6px 6px 6px 12px; 
    color: #4f6b72; 
    padding: 5px 2px 5px 2px;
	empty-cells : show;
	text-align:center;
} 

.overlay{position:fixed;top:0;right:0;bottom:0;left:0;z-index:998;width:100%;height:100%;_padding:0 20px 0 0;background:#f6f4f5;display:none;}



</style>

<style type="text/css">
*{margin:0;padding:0;list-style-type:none;}
a,img{border:0;}
body{font:12px/180% Arial, Helvetica, sans-serif, "新宋体";}
.demo{width:600px;margin:20px auto;}
.demo th,.demo td{font-size:14px;padding-bottom:17px;line-height:28px;color:#666;font-family:"新宋体";font-weight:normal;}
.demo th em{color:#ff0000;font-style:normal;}
.demo td .stext{border:1px solid #ccc;font-size:14px;height:26px;line-height:26px;padding:0 3px;width:214px;color:#666;}
/* choose-box-wrapper */
#choose-box-wrapper{width:350px;background:#000;background-color:rgba(0, 0, 0, 0.5);padding:10px;border-radius:5px;display:none;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#4B7D0000,endColorstr=#4B7D0000);
zoom: 1;}
#choose-box{border:1px solid #005EAC;width:350px;background:#fff;}
#choose-box-title{background:#3777BC;color:white;padding:4px 10px 5px;font-size:14px;font-weight:700;margin:0;}
#choose-box-title span{font-family:Tahoma, Verdana, STHeiTi, simsun, sans-serif;}
#choose-a-province, #choose-a-school{margin:5px 8px 10px 8px;border:1px solid #C3C3C3;}
#choose-a-province a{display:inline-block;height:18px;line-height:18px;color:#005EAC;text-decoration:none;font-size:9pt;font-family:Tahoma, Verdana, STHeiTi, simsun, sans-serif;margin:2px 5px;padding:1px;text-align:center;}
#choose-a-province a:hover{text-decoration:underline;cursor:pointer;}
#choose-a-province .choosen{background:#005EAC;color:white;}
#choose-a-school{overflow-x:hidden;overflow-y:auto;height:130px;}
#choose-a-school a{height:18px;line-height:18px;color:#005EAC;text-decoration:none;font-size:9pt;font-family:Tahoma, Verdana, STHeiTi, simsun, sans-serif;float:left;width:160px;margin:4px 12px;padding-left:10px;background:url(http://pic002.cnblogs.com/images/2012/70278/2012072500060712.gif) no-repeat 0 9px;}
#choose-a-school a:hover{background:#005EAC;color:#fff;}
#choose-box-bottom{background:#F0F5F8;padding:8px;text-align:right;border-top:1px solid #CCC;height:40px;}
#choose-box-bottom input{vertical-align:middle;text-align:center;background:#005EAC;color:white;border-top:1px solid #B8D4E8;border-left:1px solid #B8D4E8;border-right:1px solid #114680;border-bottom:1px solid #114680;cursor:pointer;width:60px;height:25px;margin-top:6px;margin-right:6px;line-height:25px;}

.clear{clear:both;}
#department li{list-style:none;margin:2px;padding:2px;float:left;}
#doctors li{list-style:none;margin:2px;padding:2px;float:left;}
#date li{list-style:none;margin:2px;padding:2px;float:left;}

.inputstyle {
width:150px;
height:20px;
background-color:#EEEEEE;
background-image:url(icon.png);
background-repeat:no-repeat;
background-position:3px 3px;
border:#A2B700 1px solid;
padding-left:22px;
font-family:"宋体", "微软雅黑", "黑体";
font-size:14px;
color:#999900;
line-height:20px;
}
.userinfo{
	margin-top:20px;
	margin-left:20px;
	font-size:20px;
	font-weight:blod;
}
.userinfo input{
	margin-top:5px;
}

/* CSS Document */		

/* BUTTONS */

.buttons a, .buttons button{
    display:block;
    float:left;
    margin:0 7px 0 0;
    background-color:#f5f5f5;
    border:1px solid #dedede;
    border-top:1px solid #eee;
    border-left:1px solid #eee;

    font-family:"Lucida Grande", Tahoma, Arial, Verdana, sans-serif;
    font-size:12px;
    line-height:130%;
    text-decoration:none;
    font-weight:bold;
    color:#565656;
    cursor:pointer;
    padding:5px 10px 6px 7px; /* Links */
}
.buttons button{
    width:auto;
    overflow:visible;
    padding:4px 10px 3px 7px; /* IE6 */
}
.buttons button[type]{
    padding:5px 10px 5px 7px; /* Firefox */
    line-height:17px; /* Safari */
}
*:first-child+html button[type]{
    padding:4px 10px 3px 7px; /* IE7 */
}
.buttons button img, .buttons a img{
    margin:0 3px -3px 0 !important;
    padding:0;
    border:none;
    width:16px;
    height:16px;
}

/* STANDARD */

button:hover, .buttons a:hover{
    background-color:#dff4ff;
    border:1px solid #c2e1ef;
    color:#336699;
}
.buttons a:active{
    background-color:#6299c5;
    border:1px solid #6299c5;
    color:#fff;
}

/* POSITIVE */

button.positive, .buttons a.positive{
    color:#529214;
	float:right;
}
.buttons a.positive:hover, button.positive:hover{
    background-color:#E6EFC2;
    border:1px solid #C6D880;
    color:#529214;
}
.buttons a.positive:active{
    background-color:#529214;
    border:1px solid #529214;
    color:#fff;
}

/* NEGATIVE */

.buttons a.negative, button.negative{
    color:#d12f19;
}
.buttons a.negative:hover, button.negative:hover{
    background:#fbe3e4;
    border:1px solid #fbc2c4;
    color:#d12f19;
}
.buttons a.negative:active{
    background-color:#d12f19;
    border:1px solid #d12f19;
    color:#fff;
}

/* REGULAR */

button.regular, .buttons a.regular{
    color:#336699;
}
.buttons a.regular:hover, button.regular:hover{
    background-color:#dff4ff;
    border:1px solid #c2e1ef;
    color:#336699;
}
.buttons a.regular:active{
    background-color:#6299c5;
    border:1px solid #6299c5;
    color:#fff;
}
</style>
<!--[if IE]>
<style type="text/css">
#choose-box-wrapper {
background:transparent;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#4B7D0000,endColorstr=rgb(88,114,120));
zoom: 1;
}
</style>
<![endif]-->
    <div class="main_body">
      <div class="top_flash"><a href="#"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_31.png" width="960" height="200"></a> </div>
      <div class="top_title">
        <div class="menu_time">今天是<?php echo $this->_tpl_vars['timer']; ?>
</div>
        当前位置：<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/index">首页</a><?php unset($this->_sections['path']);
$this->_sections['path']['name'] = 'path';
$this->_sections['path']['loop'] = is_array($_loop=$this->_tpl_vars['path']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['path']['show'] = true;
$this->_sections['path']['max'] = $this->_sections['path']['loop'];
$this->_sections['path']['step'] = 1;
$this->_sections['path']['start'] = $this->_sections['path']['step'] > 0 ? 0 : $this->_sections['path']['loop']-1;
if ($this->_sections['path']['show']) {
    $this->_sections['path']['total'] = $this->_sections['path']['loop'];
    if ($this->_sections['path']['total'] == 0)
        $this->_sections['path']['show'] = false;
} else
    $this->_sections['path']['total'] = 0;
if ($this->_sections['path']['show']):

            for ($this->_sections['path']['index'] = $this->_sections['path']['start'], $this->_sections['path']['iteration'] = 1;
                 $this->_sections['path']['iteration'] <= $this->_sections['path']['total'];
                 $this->_sections['path']['index'] += $this->_sections['path']['step'], $this->_sections['path']['iteration']++):
$this->_sections['path']['rownum'] = $this->_sections['path']['iteration'];
$this->_sections['path']['index_prev'] = $this->_sections['path']['index'] - $this->_sections['path']['step'];
$this->_sections['path']['index_next'] = $this->_sections['path']['index'] + $this->_sections['path']['step'];
$this->_sections['path']['first']      = ($this->_sections['path']['iteration'] == 1);
$this->_sections['path']['last']       = ($this->_sections['path']['iteration'] == $this->_sections['path']['total']);
?>&gt;<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['path'][$this->_sections['path']['index']]['py']; ?>
"><?php echo $this->_tpl_vars['path'][$this->_sections['path']['index']]['sortname']; ?>
</a><?php endfor; endif; ?>&gt;医生坐诊信息表</div>
      <div class="null"></div>
      <div class="list_body">
        <div class="list_left">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './register.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        
          <div class="healthy">
            <div class="bv_title"> <span><i><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_12.png" width="25" height="26"></i>健康档案查询</span> </div>
            <div class="bv_conts">
              <form id="form2" action="<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/search" method="post">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bv_tbs">
                  <tbody>
                    <tr>
                      <td width="29%" align="right">登录方式：</td>
                      <td width="71%"><select class="bv_text">
                          <option>请选择</option>
                          <option value="sfz">身份证号码登陆</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td align="right">身份证号：</td>
                      <td><input type="text" name="card" class="bv_text"></td>
                    </tr>
                    <tr>
                      <td align="right">密码：</td>
                      <td><input type="password" name="password" class="bv_text"></td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td><span class="td_cell">
                        <input class="cell_img" type="image" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_16.png" />
                        </span><span class="td_cell"><a href="#"><img class="cell_img" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_17.png" width="73" height="23" /></a></span></td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td><span class="td_cell"><a href="#">查询说明</a></span><span class="td_cell"><a href="#">使用帮助</a></span></td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
          <div class="lir_inner notal">
            <div class="notal_top">
              <div class="li_title"><span class="spn1"><img class="im_l" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_18.png" width="11" height="11">接种查询</span></div>
              <div class="ntop_conts">
                <form id="" action="#">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr>
                        <td width="27%">免疫卡片:</td>
                        <td width="45%"><input type="text" name="mycard" class="mycard" id="mycard"></td>
                        <td width="28%">&nbsp;</td>
                      </tr>
                      <tr>
                        <td>接种时间:</td>
                        <td><input type="text" name="mycard" class="mycard" id="mycard"></td>
                        <td><input type="image" name="imageField" id="imageField" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_26.png" class="img_btn"></td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
            <div class="notal_bottm">
              <div class="li_title"><span class="spn1"><img class="im_l" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_18.png" width="11" height="11">联网医院</span><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/hospital/index">更多》</a></div>
              <div class="hospital">
                <ul>
                  <?php unset($this->_sections['orgs']);
$this->_sections['orgs']['name'] = 'orgs';
$this->_sections['orgs']['loop'] = is_array($_loop=$this->_tpl_vars['orgs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['orgs']['show'] = true;
$this->_sections['orgs']['max'] = $this->_sections['orgs']['loop'];
$this->_sections['orgs']['step'] = 1;
$this->_sections['orgs']['start'] = $this->_sections['orgs']['step'] > 0 ? 0 : $this->_sections['orgs']['loop']-1;
if ($this->_sections['orgs']['show']) {
    $this->_sections['orgs']['total'] = $this->_sections['orgs']['loop'];
    if ($this->_sections['orgs']['total'] == 0)
        $this->_sections['orgs']['show'] = false;
} else
    $this->_sections['orgs']['total'] = 0;
if ($this->_sections['orgs']['show']):

            for ($this->_sections['orgs']['index'] = $this->_sections['orgs']['start'], $this->_sections['orgs']['iteration'] = 1;
                 $this->_sections['orgs']['iteration'] <= $this->_sections['orgs']['total'];
                 $this->_sections['orgs']['index'] += $this->_sections['orgs']['step'], $this->_sections['orgs']['iteration']++):
$this->_sections['orgs']['rownum'] = $this->_sections['orgs']['iteration'];
$this->_sections['orgs']['index_prev'] = $this->_sections['orgs']['index'] - $this->_sections['orgs']['step'];
$this->_sections['orgs']['index_next'] = $this->_sections['orgs']['index'] + $this->_sections['orgs']['step'];
$this->_sections['orgs']['first']      = ($this->_sections['orgs']['iteration'] == 1);
$this->_sections['orgs']['last']       = ($this->_sections['orgs']['iteration'] == $this->_sections['orgs']['total']);
?>
                  <li><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/hospital/detail/id/<?php echo $this->_tpl_vars['orgs'][$this->_sections['orgs']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['orgs'][$this->_sections['orgs']['index']]['zh_name']; ?>
</a></li>
                  <?php endfor; endif; ?>
                </ul>
              </div>
			  <div class="clear"></div> 
            </div>
          </div>
        </div>
<div class="list_right" style="padding:14px;">

	<table width="100%"  border="0"cellspacing="0" cellpadding="0"  class="box" style="border:1px #d2d2d2  solid;border-bottom:none; border-top:none;border-collapse:collapse;">
		<tr>
			<td colspan='14' style="background-color:rgb(71,139,210);color:white;font-size:14px;"><b><?php echo $this->_tpl_vars['staff']->name_login; ?>
</b></td>
		</tr>
		<tr>
			<?php $_from = $this->_tpl_vars['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['day']):
?>
			<td colspan='2' align='center'><strong><?php echo $this->_tpl_vars['day']['date']; ?>
<br/><?php echo $this->_tpl_vars['day']['week']; ?>
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
		<tr>
			<?php if ($this->_tpl_vars['result']): ?>
			<?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<td ><?php if ($this->_tpl_vars['v']['shangwu'] == 1): ?><a href="#" style="color:#529214;" onclick="pop('<?php echo $this->_tpl_vars['v']['id']; ?>
',1)">预约</a><?php endif; ?>&nbsp;</td>
			<td><?php if ($this->_tpl_vars['v']['xiawu'] == 1): ?><a href="#" style="color:#529214;" onclick="pop('<?php echo $this->_tpl_vars['v']['id']; ?>
',2)">预约</a><?php endif; ?>&nbsp;</td>
			<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
			<td colspan='14'>暂无该医生的号源信息！</td>
			<?php endif; ?>
		</tr>
		
	</table>
<div class="buttons">
    <button type="submit" onclick="window.location.href='<?php echo $this->_tpl_vars['basePath']; ?>
web/register/index'" class="positive" name="save">
      
        返回前一页
    </button>

   
</div>
		<div class='load' style="display:none;margin:10px;text-align:center;" >
			<span ><img src='<?php echo $this->_tpl_vars['basePath']; ?>
views/images/load.gif'/></span>
		</div>
	
			
</div>

	<div class="overlay" style="height: 1321px;"></div>
        <div class="bbk"></div>
      </div>
    </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../default/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="choose-box-wrapper">
	<div id="choose-box">
		<div id="choose-box-title">
			<span>输入用户信息</span>
		</div>
		<div id="choose-a-province"></div>
		<div id="choose-a-school">
			<table class="userinfo">
				<tr><td align='right'>姓名：</td><td> <input type="text" class="inputstyle" id="name"  value="" maxlength="25" onmouseover="this.style.borderColor='#4499EE'" onmouseout="this.style.borderColor=''" /><span></span></td></tr>
				<tr><td align='right'>身份证号：</td><td> <input type="text" class="inputstyle" id="identity_number"  value="" maxlength="25" onmouseover="this.style.borderColor='#4499EE'" onmouseout="this.style.borderColor=''" /><span></span></td></tr>
				<tr><td align='right'>手机号码：</td><td> <input type="text" class="inputstyle" id="phone_number"  value="" maxlength="25" onmouseover="this.style.borderColor='#4499EE'" onmouseout="this.style.borderColor=''" /><span></span></td></tr>
			</table>
		
		</div>
		<div id="choose-box-bottom">
			<input type="button" onclick="send()" value="确定" />
			<input type="button" onclick="hide()" value="取消" />
		</div>
	</div>
</div>
<script>
var zuozhen_id;
var day_time;
function register(id,day,name,identity_number,phone_number){
	var h = $(document).height();
	$(".overlay").css({"height": h });	
	$.ajax({
		type:"post",
		url:"<?php echo $this->_tpl_vars['basePath']; ?>
web/register/register/id/"+id+"/day/"+day+"/name/"+name+"/identity_number/"+identity_number+"/phone_number/"+phone_number,
		beforeSend:function(){
			$(".overlay").css({'display':'block','opacity':'0.1'});
			$(".load").css({'display':'block'});
		},
		success:function(info){
			$(".load").css({'display':'none'});
			alert(info);
			$(".overlay").css({'display':'none'});
		},
	});
}
//弹出窗口
function pop(id,d_time){ 
	//将窗口居中
	makeCenter(); 
	zuozhen_id=id;
	day_time=d_time;

}
//隐藏窗口
function hide(){
	$('#choose-box-wrapper').css("display","none");
}
//提交信息
function send(){
	
	var name=$("#name").val(); 
	var name=encodeURIComponent(name,'UTF-8')
	var identity_number=$("#identity_number").val();
	var phone_number=$("#phone_number").val();
	if(name==""){
		alert("姓名不能为空");return false;
	}
	if(identity_number==""){
		alert("身份证不能为空");return false;
		
	}
	if(!(/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/.test(identity_number))){ 
        alert("身份证格式不正确！"); 
        $("#identtiy_number").focus(); 
        return false; 
	}
	
	if(phone_number==""){
		alert("手机号码不能为空");
		return false;
		
	}
	if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test(phone_number))){ 
        alert("不是完整的11位手机号或者正确的手机号前七位"); 
        $("#phone_number").focus(); 
        return false; 
	}
	//隐藏窗口并提交数据
	hide();
	register(zuozhen_id,day_time,name,identity_number,phone_number);
}
function makeCenter(){
	$('#choose-box-wrapper').css("display","block");
	$('#choose-box-wrapper').css("position","absolute");
	$('#choose-box-wrapper').css("top", Math.max(0, (($(window).height() - $('#choose-box-wrapper').outerHeight()) / 2) + $(window).scrollTop()) + "px");
	$('#choose-box-wrapper').css("left", Math.max(0, (($(window).width() - $('#choose-box-wrapper').outerWidth()) / 2) + $(window).scrollLeft()) + "px");
}
</script>