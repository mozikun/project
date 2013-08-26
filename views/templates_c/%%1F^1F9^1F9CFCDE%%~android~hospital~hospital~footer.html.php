<?php /* Smarty version 2.6.14, created on 2013-08-26 14:35:01
         compiled from ../footer.html */ ?>
 <div class="ui-footer">
  <?php if ($this->_tpl_vars['login'] == 1): ?>   
  <a  href="<?php echo $this->_tpl_vars['basePath']; ?>
android/user/loginout">注销</a>
  <?php else: ?>
  <a  href="<?php echo $this->_tpl_vars['basePath']; ?>
android/user/login/">登陆</a>
  <?php endif; ?> 
  </div>