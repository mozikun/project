<?php /* Smarty version 2.6.14, created on 2013-08-19 10:04:55
         compiled from index.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../default/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <!--导航栏结束，主体开始-->
    <div class="main_body">
      <div class="top_flash"><a href="#"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_31.png" width="960" height="200"></a> </div>
      <div class="top_title">
        <div class="menu_time"><?php echo $this->_tpl_vars['tips']; ?>
</div>
        当前位置：<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/index">首页</a>&gt;联网医院&gt;<?php if ($this->_tpl_vars['card'] && $this->_tpl_vars['search']['display'] != 'all'): ?>附近的<?php endif; ?>医院列表</div>
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
          </div>
        </div>
        <div class="list_right">
        <?php unset($this->_sections['org']);
$this->_sections['org']['name'] = 'org';
$this->_sections['org']['loop'] = is_array($_loop=$this->_tpl_vars['org_all']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['org']['show'] = true;
$this->_sections['org']['max'] = $this->_sections['org']['loop'];
$this->_sections['org']['step'] = 1;
$this->_sections['org']['start'] = $this->_sections['org']['step'] > 0 ? 0 : $this->_sections['org']['loop']-1;
if ($this->_sections['org']['show']) {
    $this->_sections['org']['total'] = $this->_sections['org']['loop'];
    if ($this->_sections['org']['total'] == 0)
        $this->_sections['org']['show'] = false;
} else
    $this->_sections['org']['total'] = 0;
if ($this->_sections['org']['show']):

            for ($this->_sections['org']['index'] = $this->_sections['org']['start'], $this->_sections['org']['iteration'] = 1;
                 $this->_sections['org']['iteration'] <= $this->_sections['org']['total'];
                 $this->_sections['org']['index'] += $this->_sections['org']['step'], $this->_sections['org']['iteration']++):
$this->_sections['org']['rownum'] = $this->_sections['org']['iteration'];
$this->_sections['org']['index_prev'] = $this->_sections['org']['index'] - $this->_sections['org']['step'];
$this->_sections['org']['index_next'] = $this->_sections['org']['index'] + $this->_sections['org']['step'];
$this->_sections['org']['first']      = ($this->_sections['org']['iteration'] == 1);
$this->_sections['org']['last']       = ($this->_sections['org']['iteration'] == $this->_sections['org']['total']);
?>
          <div class="lr_ones" style="height: 80px;">
            <div class="lr_title"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/hospital/detail/id/<?php echo $this->_tpl_vars['org_all'][$this->_sections['org']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['org_all'][$this->_sections['org']['index']]['zh_name']; ?>
</a></div>
            <div class="lr_conts">
              <ul>
                <li>地址：<?php echo $this->_tpl_vars['org_all'][$this->_sections['org']['index']]['address']; ?>
 联系电话：<?php echo $this->_tpl_vars['org_all'][$this->_sections['org']['index']]['phone']; ?>
 <?php if ($this->_tpl_vars['org_all'][$this->_sections['org']['index']]['juli']): ?>距离: <?php echo $this->_tpl_vars['org_all'][$this->_sections['org']['index']]['juli']; ?>
千米<?php endif; ?></li>
              </ul>
            </div>
          </div>
          <?php endfor; endif; ?>
          <div class="pages">
          <ul style="width: 100%;padding-left: 8px;">
            <?php if (! $this->_tpl_vars['card'] || $this->_tpl_vars['search']['display'] == 'all'): ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/hospital/index">查看附近的联网医院</a><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/hospital/index/display/all">查看所有联网医院</a><?php endif; ?>&nbsp;&nbsp; <?php echo $this->_tpl_vars['pager']; ?>

          </ul>
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