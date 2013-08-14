<?php /* Smarty version 2.6.14, created on 2013-08-14 15:08:44
         compiled from header.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<title>雅安卫生信息网</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/mh/site.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/mh/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/mh/list.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
</head>
<body>
<div class="content">
  <div class="inner"> 
    <!--头部开始-->
    <div class="header">
      <div class="logo"><a href="#"><img title="雅安居民健康信息网" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_02.png" width="315" height="86" /></a></div>
      <div class="search">
        <div class="top_menu">
          <ul>
            <li class="save"><a href="javascript:;">收藏本站</a></li>
            <li class="home"><a href="javascript:;">设为首页</a></li>
          </ul>
        </div>
        <div class="bottom_box">
          <form id="" action="#" method="post">
            <div class="box_left">
              <input type="search" class="first_box" />
            </div>
            <div class="box_right">
              <input type="image" src="<?php echo $this->_tpl_vars['basePath']; ?>
views/images/mh/ws_06.png" />
            </div>
            <div class="bbk"></div>
          </form>
        </div>
      </div>
      <div class="bbk"></div>
    </div>
    <!--头部结束，导航栏开始-->
    <div class="nav">
      <ul class="main_menus">
        <li class="selected"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/index">首页</a></li>
        <?php unset($this->_sections['sort']);
$this->_sections['sort']['name'] = 'sort';
$this->_sections['sort']['loop'] = is_array($_loop=$this->_tpl_vars['sorts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sort']['max'] = (int)5;
$this->_sections['sort']['show'] = true;
if ($this->_sections['sort']['max'] < 0)
    $this->_sections['sort']['max'] = $this->_sections['sort']['loop'];
$this->_sections['sort']['step'] = 1;
$this->_sections['sort']['start'] = $this->_sections['sort']['step'] > 0 ? 0 : $this->_sections['sort']['loop']-1;
if ($this->_sections['sort']['show']) {
    $this->_sections['sort']['total'] = min(ceil(($this->_sections['sort']['step'] > 0 ? $this->_sections['sort']['loop'] - $this->_sections['sort']['start'] : $this->_sections['sort']['start']+1)/abs($this->_sections['sort']['step'])), $this->_sections['sort']['max']);
    if ($this->_sections['sort']['total'] == 0)
        $this->_sections['sort']['show'] = false;
} else
    $this->_sections['sort']['total'] = 0;
if ($this->_sections['sort']['show']):

            for ($this->_sections['sort']['index'] = $this->_sections['sort']['start'], $this->_sections['sort']['iteration'] = 1;
                 $this->_sections['sort']['iteration'] <= $this->_sections['sort']['total'];
                 $this->_sections['sort']['index'] += $this->_sections['sort']['step'], $this->_sections['sort']['iteration']++):
$this->_sections['sort']['rownum'] = $this->_sections['sort']['iteration'];
$this->_sections['sort']['index_prev'] = $this->_sections['sort']['index'] - $this->_sections['sort']['step'];
$this->_sections['sort']['index_next'] = $this->_sections['sort']['index'] + $this->_sections['sort']['step'];
$this->_sections['sort']['first']      = ($this->_sections['sort']['iteration'] == 1);
$this->_sections['sort']['last']       = ($this->_sections['sort']['iteration'] == $this->_sections['sort']['total']);
?>
        <li><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/default/list/lanmu/<?php echo $this->_tpl_vars['sorts'][$this->_sections['sort']['index']]['py']; ?>
"><?php echo $this->_tpl_vars['sorts'][$this->_sections['sort']['index']]['name']; ?>
</a></li>
        <?php endfor; endif; ?>
        <li><a href="<?php echo $this->_tpl_vars['basePath']; ?>
web/register/index">预约挂号</a></li>
      </ul>
      <div class="menu_time"><?php echo $this->_tpl_vars['timer']; ?>
</div>
      <div class="bbk"></div>
    </div>