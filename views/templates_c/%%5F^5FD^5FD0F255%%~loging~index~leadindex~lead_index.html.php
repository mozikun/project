<?php /* Smarty version 2.6.14, created on 2013-05-24 17:10:30
         compiled from lead_index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>雅安卫生信息监管平台</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/lead/site.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['basePath']; ?>
views/styles/lead/main.css"/>
<script type="text/javascript">
function display_info(area){
  var introduction=document.getElementById("introduction");
  switch(area){
    case 1://mingshan
	    
		introduction.innerHTML="名山区位于成都平原西南边缘。面积614.27平方千米，人口25.85万，辖9镇11乡。东距成都90千米，西临雅安13千米。古代是南方丝绸之路的驿站，今天是川藏国际旅游线的起点。1989年被国务院批准为对外开放县，2012年11月6日经国务院批准四川省人民政府批复撤县设区。名山属亚热带季风性湿润气候区。";
	break;
	case 2://yucheng
	introduction.innerHTML="雨城区位于四川盆地西缘，青衣江中游，成都平原向青藏高原过渡带。处于川藏、川滇西公路交汇处。地处东经102°51′~103°12′，北纬29°40′~30°14′，东西宽34公里，南北长63公里，地势呈南北长条形，西南高，东北低。川藏、川云西线、雅（安）乐（山）3条国、省级公路贯穿全境，现成雅高速公路建成开通后距省会成都约120公里。";
	break;
	case 3 ://xingjing
	introduction.innerHTML="荥经古称严道，位于四川盆地西部边缘、雅安地区中部，是古代南丝绸之路的重要驿站。幅员面积1781平方公里，辖25个乡（镇），有人口14万人。县城距离省会成都175公里，前临成都经济辐射圈，背靠“三州”两个扇面，在西部大开发中占据了很强的区位优势。荥经又有“世界鸽子花之都”的美誉。";
	break;
	case 4: //tianquan
	introduction.innerHTML="天全县位于四川盆地周山区西缘，地处二郎山东麓，青衣江之滨，行政区划属四川省雅安市，县辖23个乡（镇），总面积2400平方公里，人口13.8万人。县境四邻与雨城区、荥经县、泸定县、康定县、宝兴县、芦山县接壤，县城设城厢镇，距成都市（公路里程）180公里。";
	break;
	case 5://hanyuan
	introduction.innerHTML="汉源县，位于四川省西南山区，雅安地区南部，全县有6个区，8个镇，32个乡，255个村，1851村民小组，总人口35万，共有汉、彝、藏、回等17个民族，其中少数民族人口占10%，是成都经济圈与攀西经济带上的一颗明珠。有“中国花椒之乡”之称。气候独特、资源丰富，经济发展后劲充足， 汉源县历史悠久、文化灿烂。";
	break;
	case 6://baoxing
	introduction.innerHTML="宝兴县是中国四川省雅安市所辖的一个县。总面积3114平方公里，2002年人口6万人。1869年法国传教士阿尔芒·戴维德在盐井乡蜂桶寨自然保护区邓池沟发现大熊猫。素有“熊猫故乡”及“大理石王国”之称。";
	break;
	case 7://shimian
		introduction.innerHTML="石棉县地处四川省西南部，雅安市最南端，东连汉源县、甘洛县，南接越西县、冕宁县，西依九龙县、康定县、北与泸定县毗邻。距离省会成都365公里，距雅安市城区210公里。境内山高谷深，山地为主，河流纵横，岭谷相间。有贡嘎山、大雪山、令牌山、黄草山、鸡冠山 、坛子山等主要山脉，最高海拔5793米，最低海拔780米。 ";
	break;
	case 8://lushan
	introduction.innerHTML="芦山县位于四川盆地西缘，属盆周山区县。北与汶川，东北与崇州、大邑，东南与邛崃，南与雨城区，西南与天全，西北与宝兴相连。距成都180公里。";
	break;
  
  }
  return ;

}

</script>
</head>
<body>
<div class="box">
  <div class="title">
    <h1>雅安市县级卫生信息监管平台</h1>
  </div>
  <div class="mains"> 
   
    <div class="right">
      <div class="area pos1" onmouseover="display_info(1);"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/leadlogin/token/mingshan"></a></div>
      <div class="area pos2"  onmouseover="display_info(2);"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/leadlogin/token/yucheng"></a></div>
      <div class="area pos3"  onmouseover="display_info(3);"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/leadlogin/token/xingjing"></a></div>
      <div class="area pos4"  onmouseover="display_info(4);"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/leadlogin/token/tianquan"></a></div>
      <div class="area pos5"  onmouseover="display_info(5);"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/leadlogin/token/hanyuan"></a></div>
      <div class="area pos6"  onmouseover="display_info(6);"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/leadlogin/token/baoxing"></a></div>
      <div class="area pos7"  onmouseover="display_info(7);"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/leadlogin/token/shimian"></a></div>
      <div class="area pos8"  onmouseover="display_info(8);"><a href="<?php echo $this->_tpl_vars['basePath']; ?>
loging/index/leadlogin/token/lushan"></a></div>
      <!--<div class="ri_text">宝山县</div>-->
    </div>
    <div class="introduce" >
    <p id="introduction">雅安市位于川藏、川滇公路交会处，距成都120公里，是四川盆地与青藏高原的结合过渡地带、汉文化与民族文化结合过渡地带、现代中心城市与原始自然生态区的结合过渡地带，是古南方丝绸之路的门户和必经之路，曾为西康省省会。它是四川省历史文化名城和新兴的旅游城，有“雨城”之称。

</p>
    </div>
  </div>
</div>
</body>
</html>