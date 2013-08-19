<?php /* Smarty version 2.6.14, created on 2013-08-19 16:07:27
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
	empty-cells : show;
	text-align:center;
} 

.overlay{position:fixed;top:0;right:0;bottom:0;left:0;z-index:998;width:100%;height:100%;_padding:0 20px 0 0;background:#f6f4f5;display:none;}

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

	<table width="100%"  border="0"cellspacing="0" cellpadding="0"  class="box" style="border:1px #d2d2d2  solid;border-bottom:none; border-top:none;border-collapse:collapse;">
		<tr>
			<td colspan='14'><?php echo $this->_tpl_vars['staff']->name_login; ?>
</td>
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
			<?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<td ><?php if ($this->_tpl_vars['v']['shangwu'] == 1): ?><a href="#" onclick="register('<?php echo $this->_tpl_vars['v']['id']; ?>
')">预约</a><?php endif; ?></td>
			<td><?php if ($this->_tpl_vars['v']['xiawu'] == 1): ?>预约<?php endif; ?></td>
			<?php endforeach; endif; unset($_from); ?>
		</tr>
		
	</table>
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
<script>
function register(id){
	var h = $(document).height();
	$(".overlay").css({"height": h });	
	$.ajax({
		type:"post",
		url:"<?php echo $this->_tpl_vars['basePath']; ?>
web/register/register/id/"+id,
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
</script>