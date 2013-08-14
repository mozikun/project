<?php /* Smarty version 2.6.14, created on 2013-07-12 15:50:50
         compiled from detail.html */ ?>
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
		<a data-role="button" href="#page1" data-icon="back" data-iconpos="left"
			class="ui-btn-left">
				返回
		</a>
        <h3>
            <?php echo $this->_tpl_vars['result']['activity_theme']; ?>

        </h3>
    </div>
    <div data-role="content">
        <div data-role="collapsible-set" data-content-theme="e">
            <div data-role="collapsible"  data-collapsed="false">
                <h3>
                    活动时间
                </h3>
				<?php echo $this->_tpl_vars['result']['activity_time']; ?>

            </div>
            <div data-role="collapsible" data-collapsed="false">
                <h3>
                    活动地点
                </h3>
				<?php echo $this->_tpl_vars['result']['activity_address']; ?>

            </div>
            <div data-role="collapsible" data-collapsed="false">
                <h3>
                    活动形式
                </h3>
				<?php echo $this->_tpl_vars['result']['activity_type']; ?>

            </div>
			 <div data-role="collapsible" data-collapsed="false">
                <h3>
                    组织者
                </h3>
				<?php echo $this->_tpl_vars['result']['sponsor']; ?>

            </div>
			 <div data-role="collapsible" data-collapsed="false">
                <h3>
                    接受健康教育人员类别
                </h3>
				<?php echo $this->_tpl_vars['result']['person_category']; ?>

            </div>
			 <div data-role="collapsible" data-collapsed="false">
                <h3>
                    接受健康教育人数
                </h3>
				<?php echo $this->_tpl_vars['result']['person_num']; ?>

            </div>
			 <div data-role="collapsible" data-collapsed="false">
                <h3>
                    健康教育资料发放种类
                </h3>
				<?php echo $this->_tpl_vars['result']['promo_type']; ?>

            </div>
			 <div data-role="collapsible" data-collapsed="false">
                <h3>
                    健康教育资料发放数量
                </h3>
				<?php echo $this->_tpl_vars['result']['promo_num']; ?>

            </div>
			 <div data-role="collapsible" data-collapsed="false">
                <h3>
                    活动内容
                </h3>
				<?php echo $this->_tpl_vars['result']['active_summary']; ?>

            </div>
			 <div data-role="collapsible" data-collapsed="false">
                <h3>
                    活动总结评价
                </h3>
				<?php echo $this->_tpl_vars['result']['activity_juggde']; ?>

            </div> <div data-role="collapsible" data-collapsed="false">
                <h3>
                    填表人
                </h3>
				<?php echo $this->_tpl_vars['result']['people_fillin_form']; ?>

            </div>
			 <div data-role="collapsible" data-collapsed="false">
                <h3>
                    负责人
                </h3>
				<?php echo $this->_tpl_vars['result']['person_in_charge']; ?>

            </div>
			 <div data-role="collapsible" data-collapsed="false">
                <h3>
                    填表时间
                </h3>
				<?php echo $this->_tpl_vars['result']['created']; ?>

            </div>
			 
        </div>
    </div>
    
</div>
<html>