<?php /* Smarty version 2.6.14, created on 2013-08-22 10:02:13
         compiled from index.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../default/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <!--导航栏结束，主体开始-->
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>		
<style>
.chat{
	width:650px;
	
}
.info_display{
	height:250px;
	border:1px solid green;
	margin-top:10px;
	overflow:auto;
}
.info_input textarea{
	width:650px;
	height:100px;
}
.tishi{
	line-height:20px;
	height:20px;
}
.btn{
	float:right;
	height:20px;
	width:100px;
	line-height:20px;
	border:1px solid rgb(220,153,33);
	background-color:rgb(220,153,33);
	margin:5px;
	text-align:center;
}

</style>
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
</a><?php endfor; endif; ?>&gt;阅读文章</div>
      <div class="null"></div>
      <div class="list_body">
        <div class="list_left">
          <div class="bm_right notright">
            <div class="bv_title"> <span><i><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_12.png" width="25" height="26"></i>预约挂号</span> </div>
            <div class="bv_conts">
              <form id="form2" action="#">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bv_tbs">
                  <tbody>
                    <tr>
                      <td width="29%" align="right">预约时间：</td>
                      <td width="71%"><input type="text" name="" class="bv_text"></td>
                    </tr>
                    <tr>
                      <td align="right">地区：</td>
                      <td><select class="bv_selecd">
                          <option>选择地区</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td align="right">医院：</td>
                      <td><select class="bv_text">
                          <option>请选择医院</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td align="right">科室：</td>
                      <td><select class="bv_text">
                          <option>请选择科室</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td align="right">医生：</td>
                      <td><input type="text" name="" class="bv_text"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="image" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_13.png"></td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
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
	<div class="chat">
		<input type="hidden" id="fromuser" value="<?php echo $this->_tpl_vars['sender']; ?>
"/>
		<input type="hidden" id="touser" value="<?php echo $this->_tpl_vars['receiver']; ?>
"/>
		<div class="info_display">
			<ul id="tab">
				
			</ul>
		</div>
		<div class="tishi">
		请输入内容
		</div>
		<div class="info_input">
			<textarea id="info"></textarea>
			<div class="btn" >发送</div>
		</div>
	</div>
			
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

$(document).ready(function(){
	$(".btn").click(function(){
		fromuser=$("#fromuser").val();
		touser=$("#touser").val();
		info=$("#info").val();
		if(info==""){
			alert("发送内容不能为空");
			return false;
		}
		
		sendInfo(info,fromuser,touser);
		
	});
})

//发送消息
function sendInfo(info,fromuser,touser){
	$.ajax({
		type:"post",
		url:"<?php echo $this->_tpl_vars['basePath']; ?>
web/chat/send",
		data:"info="+info+"&fromuser="+fromuser+"&touser="+touser,
		datatype:"json",
		beforeSend:function(){
			$(".tishi").html("发送中...");
			
		},
		success:function(data){
			if(data=="success"){
			$("#tab").append("<li>我："+info+"</li>");
			
			}
			else{
				alert(data);
				
			}
			$(".tishi").html("请输入内容");
			$("#info").val("");
			//alert(data);
		},
	});
}
</script>