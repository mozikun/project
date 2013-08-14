<?php /* Smarty version 2.6.14, created on 2013-08-14 10:49:07
         compiled from index.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <!--导航栏结束，主体开始-->
    <div class="main_body">
      <div class="body_menu">
        <div class="bm_left">
          <div class="small_num"><b class="oller">1</b><b>2</b><b>3</b><b>4</b></div>
          <ul class="big_num">
            <li><a href="#"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_09.png" width="670" height="250"></a></li>
            <li style="display:none;"><a href="#"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_09.png" width="670" height="250"></a></li>
            <li style="display:none;"><a href="#"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_09.png" width="670" height="250"></a></li>
            <li style="display:none;"><a href="#"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_09.png" width="670" height="250"></a></li>
          </ul>
        </div>
        <div class="bm_right">
          <div class="bv_title"> <span><i><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_12.png" width="25" height="26"></i>预约挂号</span> </div>
          <div class="bv_conts">
            <form id="form2" action="<?php echo $this->_tpl_vars['basePath']; ?>
appointment/reservation/index" method="post">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bv_tbs">
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
views/images/mh/ws_13.png" /></td>
                </tr>
              </table>
            </form>
          </div>
        </div>
        <div class="bbk"></div>
      </div>
      <!--body_regist开始 -->
      <div class="body_regist">
        <div class="re_left">
          <form id="" action="<?php echo $this->_tpl_vars['basePath']; ?>
iha/search/search" method="post" onsubmit="return chk_login()">
            <div class="left_st"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_15.png" width="115" height="27"></div>
            <ul class="left_ller">
              <li class="left_sl"> 登陆方式：
                <select id="ne_select" class="ne_select">
                  <option>身份证号码登陆</option>
                </select>
              </li>
              <li> 身份证号：
                <input type="text" name="card" class="ne_inpt"/>
              </li>
              <li> 密码：
                <input type="password" name="password" class="ne_inpt"/>
              </li>
              <li>
                <input type="image" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_16.png"/>
              </li>
              
            </ul>
          </form>
        </div>
        <div class="re_right"> <a href="#">查询说明</a><br />
          <a href="#">使用帮助</a> </div>
        <div class="bbk"></div>
      </div>
      <!--body_regist结束，body_regist开始-->
      <div class="body_lists">
        <div class="li_left">
          <div class="lil_left">
            <div class="li_title"><span class="spn1"><img class="im_l" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_18.png" width="11" height="11">预约挂号排行榜</span></div>
            <div class="li_conts">
              <div class="tbs_top">
                <div class="tbs_ts">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" class="tbs_td">
				  <?php $_from = $this->_tpl_vars['doctors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['d']):
?>
				  <?php if ($this->_tpl_vars['k'] <= 7): ?>
                    <tr <?php if ($this->_tpl_vars['k']%2 == 0): ?>class="ous"<?php endif; ?>>
                      <td width="27%"><?php echo $this->_tpl_vars['k']; ?>
.</td>
                      <td width="73%"><?php echo $this->_tpl_vars['d']['doctor_name']; ?>
</td>
                    </tr>
				<?php endif; ?>	
				 <?php endforeach; endif; unset($_from); ?>	
                    
                  </table>
                </div>
                <div class="tbs_ts">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" class="tbs_td">
                     <?php $_from = $this->_tpl_vars['doctors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['d']):
?>
				  <?php if ($this->_tpl_vars['k'] >= 7 && $this->_tpl_vars['k'] <= 14): ?>
                    <tr <?php if ($this->_tpl_vars['k']%2 == 0): ?>class="ous"<?php endif; ?>>
                      <td width="27%"><?php echo $this->_tpl_vars['k']; ?>
.</td>
                      <td width="73%"><?php echo $this->_tpl_vars['d']['doctor_name']; ?>
</td>
                    </tr>
				<?php endif; ?>	
				 <?php endforeach; endif; unset($_from); ?>	
                    
                  </table>
                </div>
                <div class="bbk"></div>
              </div>
              <div class="tbs_btts">
                <div class="btts_inner">
                  <div class="biner_left">
                    <ul>
                      <li></li>
                      <li class="esdd"></li>
                      <li></li>
                    </ul>
                  </div>
                  <div class="biner_right"><a href="javascript:;"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_24.png" width="18" height="18"></a> <a href="javascript:;"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_23.png" width="18" height="18"></a> </div>
                  <div class="bbk"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="lil_right">
            <div class="li_title"><span class="spn1 spn2"><img class="im_l" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_18.png" width="11" height="11"><b><?php echo $this->_tpl_vars['jkxw']['name']; ?>
</b></span><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['jkxw']['py']; ?>
">更多》</a></div>
            <div class="li_conts">
              <ul class="ulst">
                <?php unset($this->_sections['jkxw']);
$this->_sections['jkxw']['name'] = 'jkxw';
$this->_sections['jkxw']['loop'] = is_array($_loop=$this->_tpl_vars['jkxw']['articles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['jkxw']['show'] = true;
$this->_sections['jkxw']['max'] = $this->_sections['jkxw']['loop'];
$this->_sections['jkxw']['step'] = 1;
$this->_sections['jkxw']['start'] = $this->_sections['jkxw']['step'] > 0 ? 0 : $this->_sections['jkxw']['loop']-1;
if ($this->_sections['jkxw']['show']) {
    $this->_sections['jkxw']['total'] = $this->_sections['jkxw']['loop'];
    if ($this->_sections['jkxw']['total'] == 0)
        $this->_sections['jkxw']['show'] = false;
} else
    $this->_sections['jkxw']['total'] = 0;
if ($this->_sections['jkxw']['show']):

            for ($this->_sections['jkxw']['index'] = $this->_sections['jkxw']['start'], $this->_sections['jkxw']['iteration'] = 1;
                 $this->_sections['jkxw']['iteration'] <= $this->_sections['jkxw']['total'];
                 $this->_sections['jkxw']['index'] += $this->_sections['jkxw']['step'], $this->_sections['jkxw']['iteration']++):
$this->_sections['jkxw']['rownum'] = $this->_sections['jkxw']['iteration'];
$this->_sections['jkxw']['index_prev'] = $this->_sections['jkxw']['index'] - $this->_sections['jkxw']['step'];
$this->_sections['jkxw']['index_next'] = $this->_sections['jkxw']['index'] + $this->_sections['jkxw']['step'];
$this->_sections['jkxw']['first']      = ($this->_sections['jkxw']['iteration'] == 1);
$this->_sections['jkxw']['last']       = ($this->_sections['jkxw']['iteration'] == $this->_sections['jkxw']['total']);
?>
                <li><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/view/uuid/<?php echo $this->_tpl_vars['jkxw']['articles'][$this->_sections['jkxw']['index']]['uuid']; ?>
">·<?php echo $this->_tpl_vars['jkxw']['articles'][$this->_sections['jkxw']['index']]['title']; ?>
</a></li>
              <?php endfor; else: ?>
              <li><a href="#">暂时还没有内容</a></li>
              <?php endif; ?>
              </ul>
            </div>
          </div>
          <div class="bbk"></div>
          <div class="lil_left">
            <div class="li_title"><span class="spn1"><img class="im_l" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_18.png" width="11" height="11">医患互动</span><a href="#">更多》</a></div>
            <div class="li_conts">
            <div class="lic_tops">
            <div class="li_ltimg"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_30.png" width="100" height="85"></div>
            <div class="li_rttext">
            <h2>关注体育锻炼 正视运动损伤</h2>
            <p>运动损伤是指运动过程中发生的各种损伤及专损伤及专损伤及专项...<a href="#">【详情】</a></p>
            </div>
            <div class="bbk"></div>
            </div>
            <ul class="ulst">
                <li><a href="#">·手长老茧或手太软预示...</a></li>
                <li><a href="#"> ·昼夜织“围脖”小心眼中风从"嘴破"</a></li>
                <li><a href="#"> ·让你越放假越累冬天用达克宁效果更好</a></li>
              </ul>
            </div>
          </div>
          <div class="lil_right">
            <div class="li_title"><span class="spn1"><img class="im_l" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_18.png" width="11" height="11"><?php echo $this->_tpl_vars['mbzs']['name']; ?>
</span><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['mbzs']['py']; ?>
">更多》</a></div>
            <div class="li_conts">
            <div class="lic_tops">
            
            <div class="li_rttext notsame">
                        <div class="unhigh unnot"><?php unset($this->_sections['mbzs']);
$this->_sections['mbzs']['name'] = 'mbzs';
$this->_sections['mbzs']['loop'] = is_array($_loop=$this->_tpl_vars['mbzs']['son']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mbzs']['show'] = true;
$this->_sections['mbzs']['max'] = $this->_sections['mbzs']['loop'];
$this->_sections['mbzs']['step'] = 1;
$this->_sections['mbzs']['start'] = $this->_sections['mbzs']['step'] > 0 ? 0 : $this->_sections['mbzs']['loop']-1;
if ($this->_sections['mbzs']['show']) {
    $this->_sections['mbzs']['total'] = $this->_sections['mbzs']['loop'];
    if ($this->_sections['mbzs']['total'] == 0)
        $this->_sections['mbzs']['show'] = false;
} else
    $this->_sections['mbzs']['total'] = 0;
if ($this->_sections['mbzs']['show']):

            for ($this->_sections['mbzs']['index'] = $this->_sections['mbzs']['start'], $this->_sections['mbzs']['iteration'] = 1;
                 $this->_sections['mbzs']['iteration'] <= $this->_sections['mbzs']['total'];
                 $this->_sections['mbzs']['index'] += $this->_sections['mbzs']['step'], $this->_sections['mbzs']['iteration']++):
$this->_sections['mbzs']['rownum'] = $this->_sections['mbzs']['iteration'];
$this->_sections['mbzs']['index_prev'] = $this->_sections['mbzs']['index'] - $this->_sections['mbzs']['step'];
$this->_sections['mbzs']['index_next'] = $this->_sections['mbzs']['index'] + $this->_sections['mbzs']['step'];
$this->_sections['mbzs']['first']      = ($this->_sections['mbzs']['iteration'] == 1);
$this->_sections['mbzs']['last']       = ($this->_sections['mbzs']['iteration'] == $this->_sections['mbzs']['total']);
 if ($this->_sections['mbzs']['last']): ?>
<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['mbzs']['son'][$this->_sections['mbzs']['index']]['py']; ?>
"><?php echo $this->_tpl_vars['mbzs']['son'][$this->_sections['mbzs']['index']]['name']; ?>
</a><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['mbzs']['son'][$this->_sections['mbzs']['index']]['py']; ?>
"><?php echo $this->_tpl_vars['mbzs']['son'][$this->_sections['mbzs']['index']]['name']; ?>
</a> | <?php endif;  endfor; endif; ?></div>
            <?php unset($this->_sections['mbzs']);
$this->_sections['mbzs']['name'] = 'mbzs';
$this->_sections['mbzs']['loop'] = is_array($_loop=$this->_tpl_vars['mbzs']['articles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mbzs']['max'] = (int)4;
$this->_sections['mbzs']['show'] = true;
if ($this->_sections['mbzs']['max'] < 0)
    $this->_sections['mbzs']['max'] = $this->_sections['mbzs']['loop'];
$this->_sections['mbzs']['step'] = 1;
$this->_sections['mbzs']['start'] = $this->_sections['mbzs']['step'] > 0 ? 0 : $this->_sections['mbzs']['loop']-1;
if ($this->_sections['mbzs']['show']) {
    $this->_sections['mbzs']['total'] = min(ceil(($this->_sections['mbzs']['step'] > 0 ? $this->_sections['mbzs']['loop'] - $this->_sections['mbzs']['start'] : $this->_sections['mbzs']['start']+1)/abs($this->_sections['mbzs']['step'])), $this->_sections['mbzs']['max']);
    if ($this->_sections['mbzs']['total'] == 0)
        $this->_sections['mbzs']['show'] = false;
} else
    $this->_sections['mbzs']['total'] = 0;
if ($this->_sections['mbzs']['show']):

            for ($this->_sections['mbzs']['index'] = $this->_sections['mbzs']['start'], $this->_sections['mbzs']['iteration'] = 1;
                 $this->_sections['mbzs']['iteration'] <= $this->_sections['mbzs']['total'];
                 $this->_sections['mbzs']['index'] += $this->_sections['mbzs']['step'], $this->_sections['mbzs']['iteration']++):
$this->_sections['mbzs']['rownum'] = $this->_sections['mbzs']['iteration'];
$this->_sections['mbzs']['index_prev'] = $this->_sections['mbzs']['index'] - $this->_sections['mbzs']['step'];
$this->_sections['mbzs']['index_next'] = $this->_sections['mbzs']['index'] + $this->_sections['mbzs']['step'];
$this->_sections['mbzs']['first']      = ($this->_sections['mbzs']['iteration'] == 1);
$this->_sections['mbzs']['last']       = ($this->_sections['mbzs']['iteration'] == $this->_sections['mbzs']['total']);
?>
            <?php if ($this->_sections['mbzs']['first']): ?>
            <h2><?php echo $this->_tpl_vars['mbzs']['articles'][$this->_sections['mbzs']['index']]['title']; ?>
</h2>
            <p><?php echo $this->_tpl_vars['mbzs']['articles'][$this->_sections['mbzs']['index']]['info']; ?>
<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/view/uuid/<?php echo $this->_tpl_vars['mbzs']['articles'][$this->_sections['mbzs']['index']]['uuid']; ?>
">【详情】</a></p>
            </div>
            <div class="bbk"></div>
            </div>
            <ul class="ulst">
            <?php else: ?>
            <li><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/view/uuid/<?php echo $this->_tpl_vars['mbzs']['articles'][$this->_sections['mbzs']['index']]['uuid']; ?>
">·<?php echo $this->_tpl_vars['mbzs']['articles'][$this->_sections['mbzs']['index']]['title']; ?>
</a></li>
            <?php endif; ?>
              <?php endfor; else: ?>
              </div>
                <div class="bbk"></div>
                </div>
              <ul class="ulst">
              <li><a href="#">暂时还没有内容</a></li>
              <?php endif; ?>
              </ul>
            </div>
          </div>
          <div class="bbk"></div>
          <div class="lil_left">
            <div class="li_title"><span class="spn1 spn2"><img class="im_l" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_18.png" width="11" height="11"><b class="dasw"><?php echo $this->_tpl_vars['jbzs']['name']; ?>
</b></span><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['jbzs']['py']; ?>
">更多》</a></div>
            <div class="li_conts">
              <ul class="ulst">
                <?php unset($this->_sections['jbzs']);
$this->_sections['jbzs']['name'] = 'jbzs';
$this->_sections['jbzs']['loop'] = is_array($_loop=$this->_tpl_vars['jbzs']['articles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['jbzs']['show'] = true;
$this->_sections['jbzs']['max'] = $this->_sections['jbzs']['loop'];
$this->_sections['jbzs']['step'] = 1;
$this->_sections['jbzs']['start'] = $this->_sections['jbzs']['step'] > 0 ? 0 : $this->_sections['jbzs']['loop']-1;
if ($this->_sections['jbzs']['show']) {
    $this->_sections['jbzs']['total'] = $this->_sections['jbzs']['loop'];
    if ($this->_sections['jbzs']['total'] == 0)
        $this->_sections['jbzs']['show'] = false;
} else
    $this->_sections['jbzs']['total'] = 0;
if ($this->_sections['jbzs']['show']):

            for ($this->_sections['jbzs']['index'] = $this->_sections['jbzs']['start'], $this->_sections['jbzs']['iteration'] = 1;
                 $this->_sections['jbzs']['iteration'] <= $this->_sections['jbzs']['total'];
                 $this->_sections['jbzs']['index'] += $this->_sections['jbzs']['step'], $this->_sections['jbzs']['iteration']++):
$this->_sections['jbzs']['rownum'] = $this->_sections['jbzs']['iteration'];
$this->_sections['jbzs']['index_prev'] = $this->_sections['jbzs']['index'] - $this->_sections['jbzs']['step'];
$this->_sections['jbzs']['index_next'] = $this->_sections['jbzs']['index'] + $this->_sections['jbzs']['step'];
$this->_sections['jbzs']['first']      = ($this->_sections['jbzs']['iteration'] == 1);
$this->_sections['jbzs']['last']       = ($this->_sections['jbzs']['iteration'] == $this->_sections['jbzs']['total']);
?>
                <li><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/view/uuid/<?php echo $this->_tpl_vars['jbzs']['articles'][$this->_sections['jbzs']['index']]['uuid']; ?>
">·<?php echo $this->_tpl_vars['jbzs']['articles'][$this->_sections['jbzs']['index']]['title']; ?>
</a></li>
              <?php endfor; else: ?>
              <li><a href="#">暂时还没有内容</a></li>
              <?php endif; ?>
              </ul>
            </div>
          </div>
          <div class="lil_right">
            <div class="li_title"><span class="spn1 spn2"><img class="im_l" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_18.png" width="11" height="11"><b class="dasw"><?php echo $this->_tpl_vars['shcs']['name']; ?>
</b></span><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['shcs']['py']; ?>
">更多》</a></div>
            <div class="li_conts">
            <div class="unhigh"><?php unset($this->_sections['shcs']);
$this->_sections['shcs']['name'] = 'shcs';
$this->_sections['shcs']['loop'] = is_array($_loop=$this->_tpl_vars['shcs']['son']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['shcs']['show'] = true;
$this->_sections['shcs']['max'] = $this->_sections['shcs']['loop'];
$this->_sections['shcs']['step'] = 1;
$this->_sections['shcs']['start'] = $this->_sections['shcs']['step'] > 0 ? 0 : $this->_sections['shcs']['loop']-1;
if ($this->_sections['shcs']['show']) {
    $this->_sections['shcs']['total'] = $this->_sections['shcs']['loop'];
    if ($this->_sections['shcs']['total'] == 0)
        $this->_sections['shcs']['show'] = false;
} else
    $this->_sections['shcs']['total'] = 0;
if ($this->_sections['shcs']['show']):

            for ($this->_sections['shcs']['index'] = $this->_sections['shcs']['start'], $this->_sections['shcs']['iteration'] = 1;
                 $this->_sections['shcs']['iteration'] <= $this->_sections['shcs']['total'];
                 $this->_sections['shcs']['index'] += $this->_sections['shcs']['step'], $this->_sections['shcs']['iteration']++):
$this->_sections['shcs']['rownum'] = $this->_sections['shcs']['iteration'];
$this->_sections['shcs']['index_prev'] = $this->_sections['shcs']['index'] - $this->_sections['shcs']['step'];
$this->_sections['shcs']['index_next'] = $this->_sections['shcs']['index'] + $this->_sections['shcs']['step'];
$this->_sections['shcs']['first']      = ($this->_sections['shcs']['iteration'] == 1);
$this->_sections['shcs']['last']       = ($this->_sections['shcs']['iteration'] == $this->_sections['shcs']['total']);
 if ($this->_sections['shcs']['last']): ?>
<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['shcs']['son'][$this->_sections['shcs']['index']]['py']; ?>
"><?php echo $this->_tpl_vars['shcs']['son'][$this->_sections['shcs']['index']]['name']; ?>
</a><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['shcs']['son'][$this->_sections['shcs']['index']]['py']; ?>
"><?php echo $this->_tpl_vars['shcs']['son'][$this->_sections['shcs']['index']]['name']; ?>
</a> | <?php endif;  endfor; endif; ?></div>
              <ul class="ulst unhill">
              <?php unset($this->_sections['shcs']);
$this->_sections['shcs']['name'] = 'shcs';
$this->_sections['shcs']['loop'] = is_array($_loop=$this->_tpl_vars['shcs']['articles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['shcs']['show'] = true;
$this->_sections['shcs']['max'] = $this->_sections['shcs']['loop'];
$this->_sections['shcs']['step'] = 1;
$this->_sections['shcs']['start'] = $this->_sections['shcs']['step'] > 0 ? 0 : $this->_sections['shcs']['loop']-1;
if ($this->_sections['shcs']['show']) {
    $this->_sections['shcs']['total'] = $this->_sections['shcs']['loop'];
    if ($this->_sections['shcs']['total'] == 0)
        $this->_sections['shcs']['show'] = false;
} else
    $this->_sections['shcs']['total'] = 0;
if ($this->_sections['shcs']['show']):

            for ($this->_sections['shcs']['index'] = $this->_sections['shcs']['start'], $this->_sections['shcs']['iteration'] = 1;
                 $this->_sections['shcs']['iteration'] <= $this->_sections['shcs']['total'];
                 $this->_sections['shcs']['index'] += $this->_sections['shcs']['step'], $this->_sections['shcs']['iteration']++):
$this->_sections['shcs']['rownum'] = $this->_sections['shcs']['iteration'];
$this->_sections['shcs']['index_prev'] = $this->_sections['shcs']['index'] - $this->_sections['shcs']['step'];
$this->_sections['shcs']['index_next'] = $this->_sections['shcs']['index'] + $this->_sections['shcs']['step'];
$this->_sections['shcs']['first']      = ($this->_sections['shcs']['iteration'] == 1);
$this->_sections['shcs']['last']       = ($this->_sections['shcs']['iteration'] == $this->_sections['shcs']['total']);
?>
                <li><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/view/uuid/<?php echo $this->_tpl_vars['shcs']['articles'][$this->_sections['shcs']['index']]['uuid']; ?>
">·<?php echo $this->_tpl_vars['shcs']['articles'][$this->_sections['shcs']['index']]['title']; ?>
</a></li>
              <?php endfor; else: ?>
              <li><a href="#">暂时还没有内容</a></li>
              <?php endif; ?>
              </ul>
            </div>
          </div>
          <div class="bbk"></div>
        </div>
        <div class="li_right">
          <div class="lir_inner notal">
            <div class="notal_top">
              <div class="li_title"><span class="spn1"><img class="im_l" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_18.png" width="11" height="11">接种查询</span></div>
              <div class="ntop_conts">
                <form id="" action="#">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
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
          <div class="lir_inner">
            <div class="li_title"><span class="spn1"><img class="im_l" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_18.png" width="11" height="11"><?php echo $this->_tpl_vars['jkjy']['name']; ?>
</span><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['jkjy']['py']; ?>
">更多》</a></div>
            <div class="li_conts">
            <div class="unhigh"><?php unset($this->_sections['jkjy']);
$this->_sections['jkjy']['name'] = 'jkjy';
$this->_sections['jkjy']['loop'] = is_array($_loop=$this->_tpl_vars['jkjy']['son']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['jkjy']['show'] = true;
$this->_sections['jkjy']['max'] = $this->_sections['jkjy']['loop'];
$this->_sections['jkjy']['step'] = 1;
$this->_sections['jkjy']['start'] = $this->_sections['jkjy']['step'] > 0 ? 0 : $this->_sections['jkjy']['loop']-1;
if ($this->_sections['jkjy']['show']) {
    $this->_sections['jkjy']['total'] = $this->_sections['jkjy']['loop'];
    if ($this->_sections['jkjy']['total'] == 0)
        $this->_sections['jkjy']['show'] = false;
} else
    $this->_sections['jkjy']['total'] = 0;
if ($this->_sections['jkjy']['show']):

            for ($this->_sections['jkjy']['index'] = $this->_sections['jkjy']['start'], $this->_sections['jkjy']['iteration'] = 1;
                 $this->_sections['jkjy']['iteration'] <= $this->_sections['jkjy']['total'];
                 $this->_sections['jkjy']['index'] += $this->_sections['jkjy']['step'], $this->_sections['jkjy']['iteration']++):
$this->_sections['jkjy']['rownum'] = $this->_sections['jkjy']['iteration'];
$this->_sections['jkjy']['index_prev'] = $this->_sections['jkjy']['index'] - $this->_sections['jkjy']['step'];
$this->_sections['jkjy']['index_next'] = $this->_sections['jkjy']['index'] + $this->_sections['jkjy']['step'];
$this->_sections['jkjy']['first']      = ($this->_sections['jkjy']['iteration'] == 1);
$this->_sections['jkjy']['last']       = ($this->_sections['jkjy']['iteration'] == $this->_sections['jkjy']['total']);
 if ($this->_sections['jkjy']['last']): ?>
<a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['jkjy']['son'][$this->_sections['jkjy']['index']]['py']; ?>
"><?php echo $this->_tpl_vars['jkjy']['son'][$this->_sections['jkjy']['index']]['name']; ?>
</a><?php else: ?><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['jkjy']['son'][$this->_sections['jkjy']['index']]['py']; ?>
"><?php echo $this->_tpl_vars['jkjy']['son'][$this->_sections['jkjy']['index']]['name']; ?>
</a> | <?php endif;  endfor; endif; ?></div>
             <ul class="ulst unhill">
                <?php unset($this->_sections['jkjy']);
$this->_sections['jkjy']['name'] = 'jkjy';
$this->_sections['jkjy']['loop'] = is_array($_loop=$this->_tpl_vars['jkjy']['articles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['jkjy']['show'] = true;
$this->_sections['jkjy']['max'] = $this->_sections['jkjy']['loop'];
$this->_sections['jkjy']['step'] = 1;
$this->_sections['jkjy']['start'] = $this->_sections['jkjy']['step'] > 0 ? 0 : $this->_sections['jkjy']['loop']-1;
if ($this->_sections['jkjy']['show']) {
    $this->_sections['jkjy']['total'] = $this->_sections['jkjy']['loop'];
    if ($this->_sections['jkjy']['total'] == 0)
        $this->_sections['jkjy']['show'] = false;
} else
    $this->_sections['jkjy']['total'] = 0;
if ($this->_sections['jkjy']['show']):

            for ($this->_sections['jkjy']['index'] = $this->_sections['jkjy']['start'], $this->_sections['jkjy']['iteration'] = 1;
                 $this->_sections['jkjy']['iteration'] <= $this->_sections['jkjy']['total'];
                 $this->_sections['jkjy']['index'] += $this->_sections['jkjy']['step'], $this->_sections['jkjy']['iteration']++):
$this->_sections['jkjy']['rownum'] = $this->_sections['jkjy']['iteration'];
$this->_sections['jkjy']['index_prev'] = $this->_sections['jkjy']['index'] - $this->_sections['jkjy']['step'];
$this->_sections['jkjy']['index_next'] = $this->_sections['jkjy']['index'] + $this->_sections['jkjy']['step'];
$this->_sections['jkjy']['first']      = ($this->_sections['jkjy']['iteration'] == 1);
$this->_sections['jkjy']['last']       = ($this->_sections['jkjy']['iteration'] == $this->_sections['jkjy']['total']);
?>
                <li><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/view/uuid/<?php echo $this->_tpl_vars['jkjy']['articles'][$this->_sections['jkjy']['index']]['uuid']; ?>
">·<?php echo $this->_tpl_vars['jkjy']['articles'][$this->_sections['jkjy']['index']]['title']; ?>
</a></li>
              <?php endfor; else: ?>
              <li><a href="#">暂时还没有内容</a></li>
              <?php endif; ?>
              </ul>
            </div>
          </div>
          <div class="lir_inner">
            <div class="li_title"><span class="spn1"><img class="im_l" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_18.png" width="11" height="11"><?php echo $this->_tpl_vars['zxcs']['name']; ?>
</span><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['zxcs']['py']; ?>
">更多》</a></div>
            <div class="li_conts">
             <ul class="ulst">
                <?php unset($this->_sections['zxcs']);
$this->_sections['zxcs']['name'] = 'zxcs';
$this->_sections['zxcs']['loop'] = is_array($_loop=$this->_tpl_vars['zxcs']['articles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['zxcs']['show'] = true;
$this->_sections['zxcs']['max'] = $this->_sections['zxcs']['loop'];
$this->_sections['zxcs']['step'] = 1;
$this->_sections['zxcs']['start'] = $this->_sections['zxcs']['step'] > 0 ? 0 : $this->_sections['zxcs']['loop']-1;
if ($this->_sections['zxcs']['show']) {
    $this->_sections['zxcs']['total'] = $this->_sections['zxcs']['loop'];
    if ($this->_sections['zxcs']['total'] == 0)
        $this->_sections['zxcs']['show'] = false;
} else
    $this->_sections['zxcs']['total'] = 0;
if ($this->_sections['zxcs']['show']):

            for ($this->_sections['zxcs']['index'] = $this->_sections['zxcs']['start'], $this->_sections['zxcs']['iteration'] = 1;
                 $this->_sections['zxcs']['iteration'] <= $this->_sections['zxcs']['total'];
                 $this->_sections['zxcs']['index'] += $this->_sections['zxcs']['step'], $this->_sections['zxcs']['iteration']++):
$this->_sections['zxcs']['rownum'] = $this->_sections['zxcs']['iteration'];
$this->_sections['zxcs']['index_prev'] = $this->_sections['zxcs']['index'] - $this->_sections['zxcs']['step'];
$this->_sections['zxcs']['index_next'] = $this->_sections['zxcs']['index'] + $this->_sections['zxcs']['step'];
$this->_sections['zxcs']['first']      = ($this->_sections['zxcs']['iteration'] == 1);
$this->_sections['zxcs']['last']       = ($this->_sections['zxcs']['iteration'] == $this->_sections['zxcs']['total']);
?>
                <li><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/view/uuid/<?php echo $this->_tpl_vars['zxcs']['articles'][$this->_sections['zxcs']['index']]['uuid']; ?>
">·<?php echo $this->_tpl_vars['zxcs']['articles'][$this->_sections['zxcs']['index']]['title']; ?>
</a></li>
              <?php endfor; else: ?>
              <li><a href="#">暂时还没有内容</a></li>
              <?php endif; ?>
              </ul>
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
<script>
$(document).ready(function() {
	var n=0;
	$('.small_num b').mousemove(function(){
		var i=$(this).index();
		$(this).addClass('oller').siblings().removeClass('oller');
		$('.big_num li').eq(i).fadeIn().siblings().fadeOut();
		if(i<3){++n}
		else{n=0;} 
	});
	$('.bm_left').hover(function(){
		clearInterval(t);	
	},function(){
		t=setInterval(function(){
			$('.small_num b').eq(n).trigger('mousemove');	
		},2000);
	}).trigger('mouseout');   
});
function chk_login()
{
    if($("input[name='card']").val()=="")
    {
        alert("请输入身份证号码");
        $("input[name='card']").focus();
        return false;
    }
    if($("input[name='password']").val()=="")
    {
        alert("请输入账户密码");
        $("input[name='password']").focus();
        return false;
    }

}
</script>