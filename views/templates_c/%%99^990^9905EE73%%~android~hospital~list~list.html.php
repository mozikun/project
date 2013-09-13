<?php /* Smarty version 2.6.14, created on 2013-09-13 14:28:12
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
            选择医院
        </h3>
    </div>
    <div data-role="content">
		
		 <ul data-role="listview" data-divider-theme="b" data-inset="true">
                    <li data-role="list-divider" role="heading">
                         医院列表
                    </li>
					<?php if ($this->_tpl_vars['result']): ?>
			<?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['r']):
?>
                    <li data-theme="c">
                        <a href="<?php echo $this->_tpl_vars['basePath']; ?>
android/hospital/doctor/org_id/<?php echo $this->_tpl_vars['r']['id']; ?>
/org_name/<?php echo $this->_tpl_vars['r']['zh_name']; ?>
" data-transition="slide" data-ajax="false">
						
                            <?php echo $this->_tpl_vars['r']['zh_name']; ?>

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
</div>

</html>