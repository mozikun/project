<?php /* Smarty version 2.6.14, created on 2013-09-04 09:31:10
         compiled from index.html */ ?>
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
.org li{
	list-style:none;
	float:left;
	background-color:rgb(238,238,238);
	margin:4px;
	padding:4px;
	border-radius:2px;
}
.org li a{
	cursor:pointer;
	text-decoration:none;
}
.org li:hover{
	background-color:rgb(113,213,234);
}
.clear{
	clear:both;
}
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
#choose-box-wrapper{width:652px;background:#000;background-color:rgba(0, 0, 0, 0.5);padding:10px;border-radius:5px;display:none;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#4B7D0000,endColorstr=#4B7D0000);
zoom: 1;}
#choose-box{border:1px solid #005EAC;width:650px;background:#fff;}
#choose-box-title{background:#3777BC;color:white;padding:4px 10px 5px;font-size:14px;font-weight:700;margin:0;}
#choose-box-title span{font-family:Tahoma, Verdana, STHeiTi, simsun, sans-serif;}
#choose-a-province, #choose-a-school{margin:5px 8px 10px 8px;border:1px solid #C3C3C3;}
#choose-a-province a{display:inline-block;height:18px;line-height:18px;color:#005EAC;text-decoration:none;font-size:9pt;font-family:Tahoma, Verdana, STHeiTi, simsun, sans-serif;margin:2px 5px;padding:1px;text-align:center;}
#choose-a-province a:hover{text-decoration:underline;cursor:pointer;}
#choose-a-province .choosen{background:#005EAC;color:white;}
#choose-a-school{overflow-x:hidden;overflow-y:auto;height:200px;}
#choose-a-school a{height:18px;line-height:18px;color:#005EAC;text-decoration:none;font-size:9pt;font-family:Tahoma, Verdana, STHeiTi, simsun, sans-serif;float:left;width:160px;margin:4px 12px;padding-left:10px;background:url(http://pic002.cnblogs.com/images/2012/70278/2012072500060712.gif) no-repeat 0 9px;}
#choose-a-school a:hover{background:#005EAC;color:#fff;}
#choose-box-bottom{background:#F0F5F8;padding:8px;text-align:right;border-top:1px solid #CCC;height:40px;}
#choose-box-bottom input{vertical-align:middle;text-align:center;background:#005EAC;color:white;border-top:1px solid #B8D4E8;border-left:1px solid #B8D4E8;border-right:1px solid #114680;border-bottom:1px solid #114680;cursor:pointer;width:60px;height:25px;margin-top:6px;margin-right:6px;}

.clear{clear:both;}
#department li{list-style:none;margin:2px;padding:2px;float:left;}
#doctors li{list-style:none;margin:2px;padding:2px;float:left;}
#date li{list-style:none;margin:2px;padding:2px;float:left;}
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
</a><?php endfor; endif; ?>&gt;预约挂号</div>
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
<div class="list_right">
	<div class="demo">
		<table width="100%">
			<tr >
				<th style="width:100px;"><em>*</em> 医院名称：</th>
				<td><input type="text" class="stext" name="hospital" id="hospital" value="请选择医院" onblur="if(this.value==''){this.value='请选择医院'}" onfocus="if(this.value=='请选择医院'){this.value=''}" onclick="pop()" /></td>
			</tr>
			<tr style="border-top:1px solid rgb(0,138,201);">
				<th ><em>*</em>科室名称：</th>
				<td>
					<ul id="department">
					
					</ul>
				</td>
			</tr>
			<div class="clear"></div>
			<tr style="border-top:1px solid rgb(0,138,201);">
				<th ><em>*</em> 医生列表：</th>
				<td>
					<ul id="doctors">
						
					</ul>
				</td>
			</tr>
			<!--
			<tr style="border-top:1px solid rgb(0,138,201);">
				<th ><em>*</em> 就诊时间：</th>
				<td>
					<ul id="date">
						<?php $_from = $this->_tpl_vars['dates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['date']):
?>
						<li><a><?php echo $this->_tpl_vars['date']; ?>
</a></li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
				</td>
			</tr>
			-->
			<tr style="border-top:1px solid rgb(0,138,201);">
				<th ><em></em> </th>
				<td>
					<ul id="zuozhen">
						
					</ul>
				</td>
			</tr>	
		</table>
   </div>
   <div id="department"></div>
	<div id="choose-box-wrapper">
	<div id="choose-box">
		<div id="choose-box-title">
			<span>选择医院</span>
		</div>
		<div id="choose-a-province"></div>
		<div id="choose-a-school"></div>
		<div id="choose-box-bottom">
			<input type="botton" onclick="hide()" value="关闭" />
		</div>
	</div>
</div><!--choose-box-wrapper end-->
  
<script type="text/javascript">
//弹出窗口
function pop(){
	//将窗口居中
	makeCenter();

	//初始化省份列表
	initProvince();

	//默认情况下, 给第一个省份添加choosen样式
	$('[province-id="1"]').addClass('choosen');

	//初始化大学列表
	initSchool(1);
}

//隐藏窗口
function hide(){
	$('#choose-box-wrapper').css("display","none");
}

function initProvince(){
	
	//原先的省份列表清空
	$('#choose-a-province').html('');
	
	for(i=0;i<schoolList.length;i++){
		$('#choose-a-province').append('<a href="javascript:void(0);" class="province-item" province-id="'+schoolList[i].id+'">'+schoolList[i].name+'</a>');
	}
	
	//添加省份列表项的click事件
	$('.province-item').bind('click',function(){
		var item=$(this);
		var province = item.attr('province-id');
		var choosenItem = item.parent().find('.choosen');
		if(choosenItem)
		$(choosenItem).removeClass('choosen');
		item.addClass('choosen');
		
		//更新大学列表
		initSchool(province);
	});
}

function initSchool(provinceID){

	//原先的学校列表清空
	$('#choose-a-school').html('');
	var schools = schoolList[provinceID-1].school;
	//alert(schools);
	for(i=0;i<schools.length;i++){
		$('#choose-a-school').append('<a href="javascript:void(0);" class="school-item" school-id="'+schools[i].id+'">'+schools[i].name+'</a>');
	}
	
	//添加大学列表项的click事件
	$('.school-item').bind('click', function(){
		var item=$(this);
		var school = item.attr('school-id');

		//更新选择大学文本框中的值
		$('#hospital').val(item.text());

		//关闭弹窗
		hide();
		//获取科室
		getDepartment(school,'');
		//获取医生
		getDoctor(school);
	});
}

function makeCenter(){
	$('#choose-box-wrapper').css("display","block");
	$('#choose-box-wrapper').css("position","absolute");
	$('#choose-box-wrapper').css("top", Math.max(0, (($(window).height() - $('#choose-box-wrapper').outerHeight()) / 2) + $(window).scrollTop()) + "px");
	$('#choose-box-wrapper').css("left", Math.max(0, (($(window).width() - $('#choose-box-wrapper').outerWidth()) / 2) + $(window).scrollLeft()) + "px");
}
</script>
			
</div>
        <div class="bbk"></div>
      </div>
    </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../default/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script>
//获取该医院的科室
function getDepartment(id){
	$.ajax({
		type:"post",
		url:"<?php echo $this->_tpl_vars['basePath']; ?>
web/register/department/org_id/"+id,
		dataType:"json",
		beforeSend:function(){
				$("#department").html("<li style='text-align:center;width:100%'><img src='<?php echo $this->_tpl_vars['basePath']; ?>
views/images/load.gif'/></li>");
		},
		success:function(department){
			$("#department").html(''); 
			for(i=0;i<department.length;i++){
				$("#department").append('<li><a onclick="getDoctor(\'\',\''+department[i].uuid+'\');" department_id="'+department[i].uuid+'">'+department[i].department_name+'</a></li>');
			}
		},	
	});
}
//获取医生列表
function getDoctor(org_id,department_id){ 
	$.ajax({
		type:"post",
		url:"<?php echo $this->_tpl_vars['basePath']; ?>
web/register/doctor/org_id/"+org_id+"/department_id/"+department_id,
		dataType:"json",
		beforeSend:function(){
			$("#doctors").html("<li style='text-align:center;width:100%'><img src='<?php echo $this->_tpl_vars['basePath']; ?>
views/images/load.gif'/></li>"); 
		},
		success:function(doctor){
			$("#doctors").html(''); 
			for(i=0;i<department.length;i++){
				$("#doctors").append('<li><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/register/zuozhen/doctor_id/'+doctor[i].id+'" doctor_id="'+doctor[i].id+'">'+doctor[i].doctor_name+'</a></li>');
			}
		},	
	});
}

</script>