<?php /* Smarty version 2.6.14, created on 2013-08-30 09:33:23
         compiled from org_logs_pic.html */ ?>
<div id="org_container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script>
$(function () {
    org_pie();
});
function org_pie()
{
    var colors = Highcharts.getOptions().colors,
            categories = [<?php unset($this->_sections['data']);
$this->_sections['data']['name'] = 'data';
$this->_sections['data']['loop'] = is_array($_loop=$this->_tpl_vars['data_logs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['data']['show'] = true;
$this->_sections['data']['max'] = $this->_sections['data']['loop'];
$this->_sections['data']['step'] = 1;
$this->_sections['data']['start'] = $this->_sections['data']['step'] > 0 ? 0 : $this->_sections['data']['loop']-1;
if ($this->_sections['data']['show']) {
    $this->_sections['data']['total'] = $this->_sections['data']['loop'];
    if ($this->_sections['data']['total'] == 0)
        $this->_sections['data']['show'] = false;
} else
    $this->_sections['data']['total'] = 0;
if ($this->_sections['data']['show']):

            for ($this->_sections['data']['index'] = $this->_sections['data']['start'], $this->_sections['data']['iteration'] = 1;
                 $this->_sections['data']['iteration'] <= $this->_sections['data']['total'];
                 $this->_sections['data']['index'] += $this->_sections['data']['step'], $this->_sections['data']['iteration']++):
$this->_sections['data']['rownum'] = $this->_sections['data']['iteration'];
$this->_sections['data']['index_prev'] = $this->_sections['data']['index'] - $this->_sections['data']['step'];
$this->_sections['data']['index_next'] = $this->_sections['data']['index'] + $this->_sections['data']['step'];
$this->_sections['data']['first']      = ($this->_sections['data']['iteration'] == 1);
$this->_sections['data']['last']       = ($this->_sections['data']['iteration'] == $this->_sections['data']['total']);
?>'<?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['zh_name']; ?>
'<?php if ($this->_sections['data']['last']):  else: ?>,<?php endif;  endfor; endif; ?>],
            org_type=[<?php $_from = $this->_tpl_vars['token']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['token'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['token']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['token']):
        $this->_foreach['token']['iteration']++;
?>'<?php echo $this->_tpl_vars['token']; ?>
'<?php if (($this->_foreach['token']['iteration'] == $this->_foreach['token']['total'])):  else: ?>,<?php endif;  endforeach; endif; unset($_from); ?>],
            name = '机构资源信息',
            data = [<?php unset($this->_sections['data']);
$this->_sections['data']['name'] = 'data';
$this->_sections['data']['loop'] = is_array($_loop=$this->_tpl_vars['data_logs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['data']['show'] = true;
$this->_sections['data']['max'] = $this->_sections['data']['loop'];
$this->_sections['data']['step'] = 1;
$this->_sections['data']['start'] = $this->_sections['data']['step'] > 0 ? 0 : $this->_sections['data']['loop']-1;
if ($this->_sections['data']['show']) {
    $this->_sections['data']['total'] = $this->_sections['data']['loop'];
    if ($this->_sections['data']['total'] == 0)
        $this->_sections['data']['show'] = false;
} else
    $this->_sections['data']['total'] = 0;
if ($this->_sections['data']['show']):

            for ($this->_sections['data']['index'] = $this->_sections['data']['start'], $this->_sections['data']['iteration'] = 1;
                 $this->_sections['data']['iteration'] <= $this->_sections['data']['total'];
                 $this->_sections['data']['index'] += $this->_sections['data']['step'], $this->_sections['data']['iteration']++):
$this->_sections['data']['rownum'] = $this->_sections['data']['iteration'];
$this->_sections['data']['index_prev'] = $this->_sections['data']['index'] - $this->_sections['data']['step'];
$this->_sections['data']['index_next'] = $this->_sections['data']['index'] + $this->_sections['data']['step'];
$this->_sections['data']['first']      = ($this->_sections['data']['iteration'] == 1);
$this->_sections['data']['last']       = ($this->_sections['data']['iteration'] == $this->_sections['data']['total']);
?>{
                    y: <?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['percent']; ?>
,
                    color: colors[<?php echo $this->_sections['data']['rownum']; ?>
],
                    drilldown: {
                        name: '<?php echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['zh_name']; ?>
',
                        categories: org_type,
                        data: [<?php unset($this->_sections['nums']);
$this->_sections['nums']['name'] = 'nums';
$this->_sections['nums']['loop'] = is_array($_loop=$this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['drilldown']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['nums']['show'] = true;
$this->_sections['nums']['max'] = $this->_sections['nums']['loop'];
$this->_sections['nums']['step'] = 1;
$this->_sections['nums']['start'] = $this->_sections['nums']['step'] > 0 ? 0 : $this->_sections['nums']['loop']-1;
if ($this->_sections['nums']['show']) {
    $this->_sections['nums']['total'] = $this->_sections['nums']['loop'];
    if ($this->_sections['nums']['total'] == 0)
        $this->_sections['nums']['show'] = false;
} else
    $this->_sections['nums']['total'] = 0;
if ($this->_sections['nums']['show']):

            for ($this->_sections['nums']['index'] = $this->_sections['nums']['start'], $this->_sections['nums']['iteration'] = 1;
                 $this->_sections['nums']['iteration'] <= $this->_sections['nums']['total'];
                 $this->_sections['nums']['index'] += $this->_sections['nums']['step'], $this->_sections['nums']['iteration']++):
$this->_sections['nums']['rownum'] = $this->_sections['nums']['iteration'];
$this->_sections['nums']['index_prev'] = $this->_sections['nums']['index'] - $this->_sections['nums']['step'];
$this->_sections['nums']['index_next'] = $this->_sections['nums']['index'] + $this->_sections['nums']['step'];
$this->_sections['nums']['first']      = ($this->_sections['nums']['iteration'] == 1);
$this->_sections['nums']['last']       = ($this->_sections['nums']['iteration'] == $this->_sections['nums']['total']);
 echo $this->_tpl_vars['data_logs'][$this->_sections['data']['index']]['drilldown'][$this->_sections['nums']['index']]['percent'];  if ($this->_sections['nums']['last']):  else: ?>,<?php endif;  endfor; endif; ?>],
                        color: colors[<?php echo $this->_sections['data']['rownum']; ?>
]
                    }
                }<?php if ($this->_sections['data']['last']):  else: ?>,<?php endif;  endfor; endif; ?>];
    
    
        // Build the data arrays
        var browserData = [];
        var versionsData = [];
        for (var i = 0; i < data.length; i++) {
    
            // add browser data
            browserData.push({
                name: categories[i],
                y: data[i].y,
                color: data[i].color
            });
    
            // add version data
            for (var j = 0; j < data[i].drilldown.data.length; j++) {
                var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
                versionsData.push({
                    name: data[i].drilldown.categories[j],
                    y: data[i].drilldown.data[j],
                    color: Highcharts.Color(data[i].color).brighten(brightness).get()
                });
            }
        }
    
        // Create the chart
        $('#org_container').highcharts({
            chart: {
                type: 'pie'
            },
            title: {
                text: '雅安区域卫生接入机构信息'
            },
            yAxis: {
                title: {
                    text: '机构类型比'
                }
            },
            plotOptions: {
                pie: {
                    shadow: false,
                    center: ['50%', '50%']
                }
            },
            tooltip: {
        	    valueSuffix: '%'
            },
            series: [{
                name: '区域机构占比',
                data: browserData,
                size: '60%',
                dataLabels: {
                    formatter: function() {
                        return this.y > 5 ? this.point.name : null;
                    },
                    color: 'white',
                    distance: -30
                }
            }, {
                name: '机构类型占比',
                data: versionsData,
                size: '80%',
                innerSize: '60%',
                dataLabels: {
                    formatter: function() {
                        // display only if larger than 1
                        return this.y > 1 ? '<b>'+ this.point.name +'%'  : null;
                    }
                }
            }]
        });
}
</script>