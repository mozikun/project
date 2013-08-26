<?php /* Smarty version 2.6.14, created on 2013-08-26 14:59:28
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
            慢病工作计划
        </h3>
    </div>
   <div data-role="content">
        <ul data-role="listview" data-divider-theme="b" data-inset="true">
            <li data-role="list-divider" role="heading">
                慢病工作计划列表
            </li>
           <?php unset($this->_sections['row']);
$this->_sections['row']['loop'] = is_array($_loop=$this->_tpl_vars['row']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['row']['name'] = 'row';
$this->_sections['row']['show'] = true;
$this->_sections['row']['max'] = $this->_sections['row']['loop'];
$this->_sections['row']['step'] = 1;
$this->_sections['row']['start'] = $this->_sections['row']['step'] > 0 ? 0 : $this->_sections['row']['loop']-1;
if ($this->_sections['row']['show']) {
    $this->_sections['row']['total'] = $this->_sections['row']['loop'];
    if ($this->_sections['row']['total'] == 0)
        $this->_sections['row']['show'] = false;
} else
    $this->_sections['row']['total'] = 0;
if ($this->_sections['row']['show']):

            for ($this->_sections['row']['index'] = $this->_sections['row']['start'], $this->_sections['row']['iteration'] = 1;
                 $this->_sections['row']['iteration'] <= $this->_sections['row']['total'];
                 $this->_sections['row']['index'] += $this->_sections['row']['step'], $this->_sections['row']['iteration']++):
$this->_sections['row']['rownum'] = $this->_sections['row']['iteration'];
$this->_sections['row']['index_prev'] = $this->_sections['row']['index'] - $this->_sections['row']['step'];
$this->_sections['row']['index_next'] = $this->_sections['row']['index'] + $this->_sections['row']['step'];
$this->_sections['row']['first']      = ($this->_sections['row']['iteration'] == 1);
$this->_sections['row']['last']       = ($this->_sections['row']['iteration'] == $this->_sections['row']['total']);
?>
            <li data-theme="c">
                <a href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/mb/detail/uuid/<?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['uuid']; ?>
" data-transition="slide">
                      <?php echo $this->_tpl_vars['row'][$this->_sections['row']['index']]['name']; ?>

                </a>
            </li>
         <?php endfor; else: ?>
         <li data-theme="b">
                <a href="###" data-transition="slide">
                     目前没数据
                </a>
         </li>
         <?php endif; ?>
         
        </ul>
    </div>   
    
    <div data-theme="a" data-role="footer" data-position="fixed">
        <h3>
           
        </h3>
        <a data-role="button" href="#page1" data-icon="arrow-l" data-iconpos="left"
        class="ui-btn-left">
            上页
        </a>
		 <?php if ($this->_tpl_vars['num']): ?>
        <a data-role="button" href="<?php echo $this->_tpl_vars['basePath']; ?>
weixin/mb/index/num/<?php echo $this->_tpl_vars['num']; ?>
" data-icon="arrow-r" data-iconpos="right"
        class="ui-btn-right">
            下页
        </a>
		<?php endif; ?>
    </div>
</div>
</html>