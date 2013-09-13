<?php /* Smarty version 2.6.14, created on 2013-09-13 16:22:41
         compiled from index_list.html */ ?>
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
        <div class="menu_time"><?php echo $this->_tpl_vars['timer']; ?>
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
</a><?php endfor; endif; ?>&gt;列表</div>
      <div class="null"></div>
      <div class="list_body">
        <div class="list_left">
          <div class="bm_right notright">
            <div class="bv_title"> <span><i><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_12.png" width="25" height="26"></i>体检信息查询</span> </div>
            <div class="bv_conts">
              <form id="form2" method="post" action="http://172.16.11.246/loging/index/user">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bv_tbs">
                  <tbody>
                    <tr>
                      <td width="29%" align="right">体检时间：</td>
                      <td width="71%"><input type="text" name="" class="bv_text"></td>
                    </tr>
                    <tr>
                      <td align="right">体检编号：</td>
                      <td><input type="text" name="" class="bv_text"></td>
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
views/images/mh/ws_13.png" /></td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
       <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '../register/register.html', 'smarty_include_vars' => array()));
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
            </div>
          </div>
        </div>
        <div class="list_right">
        <?php unset($this->_sections['sorts']);
$this->_sections['sorts']['name'] = 'sorts';
$this->_sections['sorts']['loop'] = is_array($_loop=$this->_tpl_vars['sort_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sorts']['show'] = true;
$this->_sections['sorts']['max'] = $this->_sections['sorts']['loop'];
$this->_sections['sorts']['step'] = 1;
$this->_sections['sorts']['start'] = $this->_sections['sorts']['step'] > 0 ? 0 : $this->_sections['sorts']['loop']-1;
if ($this->_sections['sorts']['show']) {
    $this->_sections['sorts']['total'] = $this->_sections['sorts']['loop'];
    if ($this->_sections['sorts']['total'] == 0)
        $this->_sections['sorts']['show'] = false;
} else
    $this->_sections['sorts']['total'] = 0;
if ($this->_sections['sorts']['show']):

            for ($this->_sections['sorts']['index'] = $this->_sections['sorts']['start'], $this->_sections['sorts']['iteration'] = 1;
                 $this->_sections['sorts']['iteration'] <= $this->_sections['sorts']['total'];
                 $this->_sections['sorts']['index'] += $this->_sections['sorts']['step'], $this->_sections['sorts']['iteration']++):
$this->_sections['sorts']['rownum'] = $this->_sections['sorts']['iteration'];
$this->_sections['sorts']['index_prev'] = $this->_sections['sorts']['index'] - $this->_sections['sorts']['step'];
$this->_sections['sorts']['index_next'] = $this->_sections['sorts']['index'] + $this->_sections['sorts']['step'];
$this->_sections['sorts']['first']      = ($this->_sections['sorts']['iteration'] == 1);
$this->_sections['sorts']['last']       = ($this->_sections['sorts']['iteration'] == $this->_sections['sorts']['total']);
?>
          <div class="lr_ones">
            <div class="lr_title"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['sort_list'][$this->_sections['sorts']['index']]['py']; ?>
"><?php echo $this->_tpl_vars['sort_list'][$this->_sections['sorts']['index']]['name']; ?>
</a></div>
            <div class="lr_conts">
              <ul>
              <?php unset($this->_sections['articles']);
$this->_sections['articles']['name'] = 'articles';
$this->_sections['articles']['loop'] = is_array($_loop=$this->_tpl_vars['sort_list'][$this->_sections['sorts']['index']]['articles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['articles']['show'] = true;
$this->_sections['articles']['max'] = $this->_sections['articles']['loop'];
$this->_sections['articles']['step'] = 1;
$this->_sections['articles']['start'] = $this->_sections['articles']['step'] > 0 ? 0 : $this->_sections['articles']['loop']-1;
if ($this->_sections['articles']['show']) {
    $this->_sections['articles']['total'] = $this->_sections['articles']['loop'];
    if ($this->_sections['articles']['total'] == 0)
        $this->_sections['articles']['show'] = false;
} else
    $this->_sections['articles']['total'] = 0;
if ($this->_sections['articles']['show']):

            for ($this->_sections['articles']['index'] = $this->_sections['articles']['start'], $this->_sections['articles']['iteration'] = 1;
                 $this->_sections['articles']['iteration'] <= $this->_sections['articles']['total'];
                 $this->_sections['articles']['index'] += $this->_sections['articles']['step'], $this->_sections['articles']['iteration']++):
$this->_sections['articles']['rownum'] = $this->_sections['articles']['iteration'];
$this->_sections['articles']['index_prev'] = $this->_sections['articles']['index'] - $this->_sections['articles']['step'];
$this->_sections['articles']['index_next'] = $this->_sections['articles']['index'] + $this->_sections['articles']['step'];
$this->_sections['articles']['first']      = ($this->_sections['articles']['iteration'] == 1);
$this->_sections['articles']['last']       = ($this->_sections['articles']['iteration'] == $this->_sections['articles']['total']);
?>
                <li>
                  <div class="lr_time"><?php echo $this->_tpl_vars['sort_list'][$this->_sections['sorts']['index']]['articles'][$this->_sections['articles']['index']]['updated']; ?>
</div>
                  [<?php echo $this->_tpl_vars['sort_list'][$this->_sections['sorts']['index']]['articles'][$this->_sections['articles']['index']]['sortname']; ?>
] <a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/<?php if ($this->_tpl_vars['sort_list'][$this->_sections['sorts']['index']]['py'] == 'jkjyhd'): ?>jkjyhd<?php elseif ($this->_tpl_vars['sort_list'][$this->_sections['sorts']['index']]['py'] == 'jkjycf'): ?>jkjycf<?php else: ?>view<?php endif; ?>/uuid/<?php echo $this->_tpl_vars['sort_list'][$this->_sections['sorts']['index']]['articles'][$this->_sections['articles']['index']]['uuid']; ?>
"><?php echo $this->_tpl_vars['sort_list'][$this->_sections['sorts']['index']]['articles'][$this->_sections['articles']['index']]['title']; ?>
</a></li>
              <?php endfor; else: ?>
              <li>
                  此分类下暂时还没有信息发布</li>
              <?php endif; ?>
              </ul>
            </div>
          </div>
          <?php endfor; endif; ?>
          <div class="pages">
          <ul style="width: 100%;padding-left: 8px;">
            <?php echo $this->_tpl_vars['pager']; ?>

          </ul>
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