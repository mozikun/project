<?php /* Smarty version 2.6.14, created on 2013-05-07 10:32:26
         compiled from doctor_index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/admincp.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs.css" />
<link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tree.css" />
<script src="<?php echo $this->_tpl_vars['basePath']; ?>
views/js/jquery-1.4.2.js"></script>
<style>
li{
    list-style: none;
}
</style>
<script>
function show_pic()
{
    $.get('<?php echo $this->_tpl_vars['basePath']; ?>
decision/main/tree',function(data)
    {
        $(".tree:eq(1)").append(data);
    });
}
</script>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;float: left;margin: 0;">
    <tr class="headbg">
    <td colspan="3"><b>今日信息</b></td>
    </tr>
    <tr class="columnbg">
    <td colspan="3"><b>今日待办事项提醒</b></td>
    </tr>
    <tr><td>计划时间</td><td>标题</td><td>事件</td></tr>
    <?php unset($this->_sections['tips']);
$this->_sections['tips']['name'] = 'tips';
$this->_sections['tips']['loop'] = is_array($_loop=$this->_tpl_vars['tips_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tips']['show'] = true;
$this->_sections['tips']['max'] = $this->_sections['tips']['loop'];
$this->_sections['tips']['step'] = 1;
$this->_sections['tips']['start'] = $this->_sections['tips']['step'] > 0 ? 0 : $this->_sections['tips']['loop']-1;
if ($this->_sections['tips']['show']) {
    $this->_sections['tips']['total'] = $this->_sections['tips']['loop'];
    if ($this->_sections['tips']['total'] == 0)
        $this->_sections['tips']['show'] = false;
} else
    $this->_sections['tips']['total'] = 0;
if ($this->_sections['tips']['show']):

            for ($this->_sections['tips']['index'] = $this->_sections['tips']['start'], $this->_sections['tips']['iteration'] = 1;
                 $this->_sections['tips']['iteration'] <= $this->_sections['tips']['total'];
                 $this->_sections['tips']['index'] += $this->_sections['tips']['step'], $this->_sections['tips']['iteration']++):
$this->_sections['tips']['rownum'] = $this->_sections['tips']['iteration'];
$this->_sections['tips']['index_prev'] = $this->_sections['tips']['index'] - $this->_sections['tips']['step'];
$this->_sections['tips']['index_next'] = $this->_sections['tips']['index'] + $this->_sections['tips']['step'];
$this->_sections['tips']['first']      = ($this->_sections['tips']['iteration'] == 1);
$this->_sections['tips']['last']       = ($this->_sections['tips']['iteration'] == $this->_sections['tips']['total']);
?>
    <tr><td><?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['tips_time']; ?>
</td><td><?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['tips_name']; ?>
</td><td><?php echo $this->_tpl_vars['tips_array'][$this->_sections['tips']['index']]['tips_type']; ?>
</td></tr>
    <?php endfor; else: ?>
    <tr><td colspan="3">今日暂无待办事项，请查看是否有其他未完成待办事项</td></tr>
    <?php endif; ?>
    <tr><td colspan="3" style="height: 40px;"><input type="button" name="button" value="更多(<?php echo $this->_tpl_vars['tips_count']; ?>
)项待办事项..." onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
tp/index'" /><input type="button" name="button" value="新增个人健康档案" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
iha/cover/add'" /><input type="button" name="button" value="个人健康档案列表" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
iha/index/index'" /><input type="button" name="button" value="高血压随访" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
cd/index/index'" /><input type="button" name="button" value="糖尿病随访" onclick="window.location='<?php echo $this->_tpl_vars['basePath']; ?>
cd/diabetes/list'" /></td></tr>
    <tr class="columnbg">
    <td colspan="3"><b>今日信息</b></td>
    </tr>
    <tr>
    <td colspan="3">今日新建档数<span class="red"><?php echo $this->_tpl_vars['today']['da_new']; ?>
</span>个，更新档案数<span class="red"><?php echo $this->_tpl_vars['today']['da_update']; ?>
</span>个，慢病患者<span class="red"><?php echo $this->_tpl_vars['today']['manbing']; ?>
</span>个(其中高血压<span class="red"><?php echo $this->_tpl_vars['today']['gxy']; ?>
</span>个，II型糖尿病<span class="red"><?php echo $this->_tpl_vars['today']['tnb']; ?>
</span>个，重性精神分裂<span class="red"><?php echo $this->_tpl_vars['today']['jsb']; ?>
</span>个)。</td>
    </tr>
    <tr class="columnbg">
    <td colspan="3"><b>近期档案更新数据变化图</b></td>
    </tr>
    <tr>
    <td colspan="3"><img src="<?php echo $this->_tpl_vars['basePath']; ?>
decision/main/dapic" /></td>
    </tr>
</table>
</body>
</html>