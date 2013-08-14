<?php /* Smarty version 2.6.14, created on 2013-08-13 17:30:31
         compiled from search.html */ ?>
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
 
	

	 <div data-role="content">
        <div data-role="collapsible-set" data-content-theme="e">
            <div data-role="collapsible"  data-collapsed="false">
                <h3>
                    姓名
                </h3>
				<?php echo $this->_tpl_vars['result']['name']; ?>

            </div>
            <div data-role="collapsible" data-collapsed="false">
                <h3>
                    预约医生
                </h3>
				<?php echo $this->_tpl_vars['result']['doctor']; ?>

            </div>
            <div data-role="collapsible" data-collapsed="false">
                <h3>
                    预约时间
                </h3>
				<?php echo $this->_tpl_vars['result']['time']; ?>

            </div>

        </div>
    </div>
    
</div>
</html>