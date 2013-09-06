<?php /* Smarty version 2.6.14, created on 2013-09-06 17:07:01
         compiled from detail_jkjyhd.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <!--导航栏结束，主体开始-->
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
            </div>
          </div>
        </div>
        <div class="list_right">
          <div class="lr_ones four">
            <h1 class="four_title">
              <div class="ftext"><?php if ($this->_tpl_vars['tips']['next']): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/jkjyhd/uuid/<?php echo $this->_tpl_vars['tips']['next']; ?>
">下一条》</a><?php else: ?>没有了<?php endif; ?></div>
              <div class="fpres"><?php if ($this->_tpl_vars['tips']['before']): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/jkjyhd/uuid/<?php echo $this->_tpl_vars['tips']['before']; ?>
">《上一条</a><?php else: ?>没有了<?php endif; ?></div>
              <?php echo $this->_tpl_vars['health_education']->activity_theme; ?>
</h1>
            <div class="four_conts">
              <div class="fc_time"> 日期：<?php echo $this->_tpl_vars['health_education']->updated; ?>
 　　来源：<?php echo $this->_tpl_vars['health_education']->org_id; ?>
 </div>
              <div class="fc_text">
    <table border="0" width="100%" class="nobg">
	<tr>
		<td style="font-size:14px;font-weight:bold;text-align:center;line-height:68px;">
        	健康教育活动记录表
        </td>
	</tr>
	<tr>
		<td style="text-align:center;">
        	<table border="0" width="100%" class="line_table">
			    <tr>
			        <td style="width:50%;">
			        	活动时间:&nbsp;
						<?php echo $this->_tpl_vars['health_education']->activity_time; ?>

			        </td>			
					<td style="width:50%;">
			        	活动地点:&nbsp;<?php echo $this->_tpl_vars['health_education']->activity_address; ?>

			        </td>
				</tr>
				<tr>
			        <td colspan="2">
			        	活动形式:&nbsp;
						<span>
						<?php $_from = $this->_tpl_vars['he_active_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
						&nbsp;<label style="padding-left: 28px;cursor: pointer;"><input type="checkbox" readonly="true" value="<?php echo $this->_tpl_vars['k']; ?>
" <?php echo $this->_tpl_vars['v']['check']; ?>
 name="activity_type[]" /><?php echo $this->_tpl_vars['v'][1]; ?>
</label>
						<?php endforeach; endif; unset($_from); ?>
						</span>
			        </td>			
					
				</tr>
                <tr>
			        <td colspan="2" style="height:100px;">
			        	<span style="float: left;line-height: 100px;">活&nbsp;动&nbsp;主&nbsp;题&nbsp;:&nbsp;&nbsp;</span>
						<?php echo $this->_tpl_vars['health_education']->activity_theme; ?>

			        </td>			
				</tr>
                <tr>
                <td colspan="2">
			        	组织者:&nbsp;<?php echo $this->_tpl_vars['health_education']->sponsor; ?>

			        </td>
                </tr>
				<tr>
			        <td style="width:50%;">
			        	接受健康教育人员类别:&nbsp;<?php echo $this->_tpl_vars['health_education']->person_category; ?>

			        </td>			
					<td style="width:50%;">
			        	接受健康教育人数:&nbsp;<?php echo $this->_tpl_vars['health_education']->person_num; ?>

			        </td>
				</tr>
				<tr>
			        <td style="width:50%;">
			        	健康教育资料发放种类:&nbsp;<?php echo $this->_tpl_vars['health_education']->promo_type; ?>

			        </td>			
					<td style="width:50%;">
			        	健康教育资料发放数量:&nbsp;<?php echo $this->_tpl_vars['health_education']->promo_num; ?>

			        </td>
				</tr>
				<tr>
			        <td colspan="2" style="height:100px;">
			        	<span style="float: left;line-height: 100px;">活&nbsp;动&nbsp;内&nbsp;容&nbsp;:&nbsp;&nbsp;</span>
						<?php echo $this->_tpl_vars['health_education']->active_summary; ?>

			        </td>			
				</tr>
				<tr>
			        <td colspan="2" style="height:100px;">
			        	<span style="float: left;line-height: 100px;">活动总结评价:</span><?php echo $this->_tpl_vars['health_education']->activity_juggde; ?>

			        </td>			
				</tr>
				<tr>
			        <td colspan="2">
			        	存档材料请附后：
						<?php $_from = $this->_tpl_vars['health_more_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
						<input type="checkbox" readonly="true" value="<?php echo $this->_tpl_vars['k']; ?>
" <?php echo $this->_tpl_vars['v']['check']; ?>
 name="more_info[]" /><?php echo $this->_tpl_vars['v'][1]; ?>
</label>&nbsp;
						<?php endforeach; endif; unset($_from); ?>
			        </td>			
				</tr>
				
			</table>
        </td>
	</tr>
	<tr>
		<td>
        	<span style="float: left;">填表人（签字）:
			<?php echo $this->_tpl_vars['people_fillin_form']; ?>

            </span>
            <span style="float: right;">负责人（签字）:
			<?php echo $this->_tpl_vars['response_doctor']; ?>

            </span>
        </td>
	</tr>
	<tr>
		<td style="text-align:right;">
        	填表时间：&nbsp;<?php if ($this->_tpl_vars['health_education']->updated):  echo $this->_tpl_vars['health_education']->updated;  else:  echo $this->_tpl_vars['updated'];  endif; ?>
        </td>
	</tr>
</table>
              </div>
            </div>
          </div>
        </div>
        <div class="bbk"></div>
      </div>
    </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>