<?php /* Smarty version 2.6.14, created on 2013-07-12 14:42:40
         compiled from list.html */ ?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/jquerymobile.min.css" rel="stylesheet" type="text/css" media="screen" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquerymobile.min.js"></script>
<div data-role="page" id="page1">
    <div data-theme="a" data-role="header">
        <h3>
            健康教育活动
        </h3>
    </div>
    <div data-role="content">
		<ul data-role="listview" data-divider-theme="b" data-inset="true">
            <li data-role="list-divider" role="heading">
                健康教育活动列表
            </li>
			<?php if ($this->_tpl_vars['result']): ?>
			<?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?>
            <li data-theme="c">
                <a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/hea/detail/id/<?php echo $this->_tpl_vars['item']['id']; ?>
" data-transition="slide">
                      <?php echo $this->_tpl_vars['item']['activity_theme']; ?>
&nbsp;<?php echo $this->_tpl_vars['item']['activity_time']; ?>

                </a>
            </li>
			 <?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
			<li data-theme="c">
                暂无信息！
                         </li>
			<?php endif; ?>
        </ul>
    </div>
	 <div data-theme="a" data-role="footer" data-position="fixed">
        <h3>
            <?php if ($this->_tpl_vars['total_page'] > 0): ?>
            <?php echo $this->_tpl_vars['current_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>

            <?php endif; ?>
        </h3>
		 <?php if ($this->_tpl_vars['pre_page'] >= 1): ?>
        <a data-role="button" href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/hea/list/page/<?php echo $this->_tpl_vars['pre_page']; ?>
/org/<?php echo $this->_tpl_vars['org']; ?>
" data-icon="arrow-l" data-iconpos="left"
        class="ui-btn-left">
            上页
        </a>
		<?php endif; ?>
		 <?php if ($this->_tpl_vars['next_page']): ?>
        <a data-role="button" href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/hea/list/page/<?php echo $this->_tpl_vars['next_page']; ?>
/org/<?php echo $this->_tpl_vars['org']; ?>
" data-icon="arrow-r" data-iconpos="right"
        class="ui-btn-right">
            下页
        </a>
		<?php endif; ?>
    </div>
</div>
</html>