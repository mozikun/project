<?php /* Smarty version 2.6.14, created on 2013-08-26 14:11:01
         compiled from mzrecord.html */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet" type="text/css" id="css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/tabs_search.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/mobileindex.css"/>
	<title><?php echo $this->_tpl_vars['individual_core']->name;  echo $this->_tpl_vars['title']; ?>
</title>
	<style type="text/css">
       body{margin:0 auto;padding:0 auto;text-align:left;background:url(<?php echo $this->_tpl_vars['basePath']; ?>
views/images/div_bg.jpg) repeat-x;height:100%;}
       div,img,table,tr{margin:0 auto;padding:0 auto;text-align:left;}
       .title_bg{background:url(<?php echo $this->_tpl_vars['basePath']; ?>
views/images/bg_search_ext.jpg) repeat-x;height:25px;line-height:25px;text-align:left;padding-left:2em;color:white;font-weight:bold;}
       .div_content{background:url(<?php echo $this->_tpl_vars['basePath']; ?>
views/images/div_bg.jpg) repeat-x center top;height:auto;}
    </style>
</head>
<body>
    <!--最近二次就诊记录-->
  <div class="title_bg">
     门诊就诊记录
   </div>
    <div>
     <table border="0" cellpadding="0" cellspacing="0" width="100%">
     <?php unset($this->_sections['tb_fee']);
$this->_sections['tb_fee']['name'] = 'tb_fee';
$this->_sections['tb_fee']['loop'] = is_array($_loop=$this->_tpl_vars['tb_yl_mz_medical_record']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tb_fee']['show'] = true;
$this->_sections['tb_fee']['max'] = $this->_sections['tb_fee']['loop'];
$this->_sections['tb_fee']['step'] = 1;
$this->_sections['tb_fee']['start'] = $this->_sections['tb_fee']['step'] > 0 ? 0 : $this->_sections['tb_fee']['loop']-1;
if ($this->_sections['tb_fee']['show']) {
    $this->_sections['tb_fee']['total'] = $this->_sections['tb_fee']['loop'];
    if ($this->_sections['tb_fee']['total'] == 0)
        $this->_sections['tb_fee']['show'] = false;
} else
    $this->_sections['tb_fee']['total'] = 0;
if ($this->_sections['tb_fee']['show']):

            for ($this->_sections['tb_fee']['index'] = $this->_sections['tb_fee']['start'], $this->_sections['tb_fee']['iteration'] = 1;
                 $this->_sections['tb_fee']['iteration'] <= $this->_sections['tb_fee']['total'];
                 $this->_sections['tb_fee']['index'] += $this->_sections['tb_fee']['step'], $this->_sections['tb_fee']['iteration']++):
$this->_sections['tb_fee']['rownum'] = $this->_sections['tb_fee']['iteration'];
$this->_sections['tb_fee']['index_prev'] = $this->_sections['tb_fee']['index'] - $this->_sections['tb_fee']['step'];
$this->_sections['tb_fee']['index_next'] = $this->_sections['tb_fee']['index'] + $this->_sections['tb_fee']['step'];
$this->_sections['tb_fee']['first']      = ($this->_sections['tb_fee']['iteration'] == 1);
$this->_sections['tb_fee']['last']       = ($this->_sections['tb_fee']['iteration'] == $this->_sections['tb_fee']['total']);
?>
     <tr >
          <td colspan="2" ><strong>门诊就诊记录(<?php echo $this->_tpl_vars['tb_yl_mz_medical_record'][$this->_sections['tb_fee']['index']]['myorder']; ?>
)</strong></td>
     </tr>
     <tr>
       <td >就诊时间:</td>
       <td><?php echo $this->_tpl_vars['tb_yl_mz_medical_record'][$this->_sections['tb_fee']['index']]['jzksrq']; ?>
</td>
     </tr>
     <tr>
       <td width="30%">医生:</td>
       <td><?php echo $this->_tpl_vars['tb_yl_mz_medical_record'][$this->_sections['tb_fee']['index']]['zzysxm']; ?>
</td>
     </tr>
     <tr>
       <td>门诊诊断名称:</td>
       <td><?php echo $this->_tpl_vars['tb_yl_mz_medical_record'][$this->_sections['tb_fee']['index']]['jzzdmc']; ?>
</td>
     </tr>
     <?php unset($this->_sections['tb_fee_table']);
$this->_sections['tb_fee_table']['name'] = 'tb_fee_table';
$this->_sections['tb_fee_table']['loop'] = is_array($_loop=$this->_tpl_vars['tb_yl_mz_medical_record'][$this->_sections['tb_fee']['index']]['fee']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tb_fee_table']['show'] = true;
$this->_sections['tb_fee_table']['max'] = $this->_sections['tb_fee_table']['loop'];
$this->_sections['tb_fee_table']['step'] = 1;
$this->_sections['tb_fee_table']['start'] = $this->_sections['tb_fee_table']['step'] > 0 ? 0 : $this->_sections['tb_fee_table']['loop']-1;
if ($this->_sections['tb_fee_table']['show']) {
    $this->_sections['tb_fee_table']['total'] = $this->_sections['tb_fee_table']['loop'];
    if ($this->_sections['tb_fee_table']['total'] == 0)
        $this->_sections['tb_fee_table']['show'] = false;
} else
    $this->_sections['tb_fee_table']['total'] = 0;
if ($this->_sections['tb_fee_table']['show']):

            for ($this->_sections['tb_fee_table']['index'] = $this->_sections['tb_fee_table']['start'], $this->_sections['tb_fee_table']['iteration'] = 1;
                 $this->_sections['tb_fee_table']['iteration'] <= $this->_sections['tb_fee_table']['total'];
                 $this->_sections['tb_fee_table']['index'] += $this->_sections['tb_fee_table']['step'], $this->_sections['tb_fee_table']['iteration']++):
$this->_sections['tb_fee_table']['rownum'] = $this->_sections['tb_fee_table']['iteration'];
$this->_sections['tb_fee_table']['index_prev'] = $this->_sections['tb_fee_table']['index'] - $this->_sections['tb_fee_table']['step'];
$this->_sections['tb_fee_table']['index_next'] = $this->_sections['tb_fee_table']['index'] + $this->_sections['tb_fee_table']['step'];
$this->_sections['tb_fee_table']['first']      = ($this->_sections['tb_fee_table']['iteration'] == 1);
$this->_sections['tb_fee_table']['last']       = ($this->_sections['tb_fee_table']['iteration'] == $this->_sections['tb_fee_table']['total']);
?>
      <tr>
       <td width="30%">收费时间</td>
       <td><?php echo $this->_tpl_vars['tb_yl_mz_medical_record'][$this->_sections['tb_fee']['index']]['fee'][$this->_sections['tb_fee_table']['index']]['stfsj']; ?>
</td>
      </tr>
      <tr>
       <td>明细费用类别</td>
       <td><?php echo $this->_tpl_vars['tb_yl_mz_medical_record'][$this->_sections['tb_fee']['index']]['fee'][$this->_sections['tb_fee_table']['index']]['mxfylb']; ?>
</td>
      </tr>
      <tr>
       <td>明细项目名称</td>
       <td><?php echo $this->_tpl_vars['tb_yl_mz_medical_record'][$this->_sections['tb_fee']['index']]['fee'][$this->_sections['tb_fee_table']['index']]['mxxmmc']; ?>
</td>
      </tr>
       <tr>
       <td>明细项目单位</td>
       <td><?php echo $this->_tpl_vars['tb_yl_mz_medical_record'][$this->_sections['tb_fee']['index']]['fee'][$this->_sections['tb_fee_table']['index']]['mxxmdw']; ?>
</td>
      </tr>
      <tr>
       <td>明细项目单价</td>
       <td><?php echo $this->_tpl_vars['tb_yl_mz_medical_record'][$this->_sections['tb_fee']['index']]['fee'][$this->_sections['tb_fee_table']['index']]['mxxmdj']; ?>
</td>
      </tr>
      <tr>
       <td>明细项目数量</td>
       <td><?php echo $this->_tpl_vars['tb_yl_mz_medical_record'][$this->_sections['tb_fee']['index']]['fee'][$this->_sections['tb_fee_table']['index']]['mxxmsl']; ?>
</td>
      </tr>
      <tr>
       <td>明细项目金额</td>
       <td><?php echo $this->_tpl_vars['tb_yl_mz_medical_record'][$this->_sections['tb_fee']['index']]['fee'][$this->_sections['tb_fee_table']['index']]['mxxmje']; ?>
</td>
      </tr>
      <tr>
        <td colspan="2" style="height:50px;line-height:50px;"></td>
      </tr>
     <?php endfor; endif; ?>
     <?php endfor; else: ?>
      <tr>
      <td colspan="2">没有任何记录</td>
      </tr>
     <?php endif; ?>
    </table>
    </div>
    <div class="ui-footer">
     <a id="login" href="<?php echo $this->_tpl_vars['basePath']; ?>
iha/login/index">返回</a>
  </div>
</body>
</html>