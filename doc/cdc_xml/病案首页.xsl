<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="UTF-8"/>
	<xsl:template match="/">
		<html xmlns="http://www.w3.org/1999/xhtml" charset="UTF-8">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
			<head>
				<title>病案首页</title>
				<link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/common.css"/>
				<link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/firstpage.css"/>
			</head>
			<body>
				<div id="firstpage">
					<!--标题-->
					<table cellpadding="5" cellspacing="0" class="fptable">
					
						<tr>
							<td class="title">
								<xsl:value-of select="EMR08.00.01/ZLG08.00.01.001/EMR08.01.01.001"/>
							</td>
						</tr>
						<tr>
							<td>
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
					</table>
					<!--头信息-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft" style="width:55%">
					个人主索引（MPI）：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.002/ZLE08.00.01.001"/>
							</td>
							<td class="alignleft">
					医疗保险类别：
                    <xsl:for-each select="EMR08.00.01/ZLG08.00.01.007">
									<xsl:if test="position() != last()">
										<xsl:value-of select="EMR08.01.01.091"/>、
                        </xsl:if>
									<xsl:if test="position() = last()">
										<xsl:value-of select="EMR08.01.01.091"/>
									</xsl:if>
								</xsl:for-each>
							</td>
						</tr>
						<tr>
							<td class="alignleft">
								<span style="font-size:14pt; font-weight:bold">住院医疗机构：</span>
								<span style="font-size:14pt; font-weight:normal">
									<xsl:value-of select="EMR08.00.01/ZLG08.00.01.009/EMR08.01.01.101"/>
								</span>
							</td>
							<td class="alignleft">
                    机构代码：
					<xsl:value-of select="EMR08.00.01/ZLG08.00.01.009/EMR08.01.01.102"/>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
					</table>
					<!--个人信息-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="seplinelevel2top" style="width:6%">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
							<td class="seplinelevel2top" style="width:10%">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
							<td class="seplinelevel2top" style="width:14%">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
							<td class="seplinelevel2top" style="width:28%">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
							<td class="seplinelevel2top" style="width:18%">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
							<td class="seplinelevel2top">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="alignleft">
					姓名：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.002/EMR08.01.01.013"/>
							</td>
							<td class="alignleft">
					性别：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.003/EMR08.01.01.033"/>
							</td>
							<td class="alignleft">
					出生日期：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.003/EMR08.01.01.031"/>
							</td>
							<td class="alignleft">
					年龄：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.003/EMR08.01.01.034"/>
							</td>
							<td class="alignleft">
					婚姻：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.003/EMR08.01.01.037"/>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="alignleft">
					国籍：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.003/EMR08.01.01.035"/>
							</td>
							<td class="alignleft">
					民族：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.003/EMR08.01.01.036"/>
							</td>
							<td colspan="2" class="alignleft">
					职业：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.003/ZLG08.00.01.024/EMR08.01.01.039"/>
							</td>
							<td class="alignleft">
					文化程度：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.003/EMR08.01.01.040"/>
							</td>
						</tr>
						<xsl:choose>
							<xsl:when test="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.061='09'">
								<tr>
									<td colspan="4" class="alignleft">
					现住址：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.062"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.063"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.064"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.065"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.066"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.067"/>
									</td>
									<td colspan="2" class="alignleft">
					邮政编码：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.068"/>
									</td>
								</tr>
							</xsl:when>
							<xsl:otherwise>
								<tr>
									<td colspan="4" class="alignleft">
					现住址：					
				</td>
									<td colspan="2" class="alignleft">
					邮政编码：
				</td>
								</tr>
							</xsl:otherwise>
						</xsl:choose>
						<xsl:choose>
							<xsl:when test="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.061='02'">
								<tr>
									<td colspan="4" class="alignleft">
					工作单位地址：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.062"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.063"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.064"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.065"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.066"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.067"/>
									</td>
									<td colspan="2" class="alignleft">
					邮政编码：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.005/EMR08.01.01.068"/>
									</td>
								</tr>
							</xsl:when>
							<xsl:otherwise>
								<tr>
									<td colspan="4" class="alignleft">
					工作单位地址：					
				</td>
									<td colspan="2" class="alignleft">
					邮政编码：
				</td>
								</tr>
							</xsl:otherwise>
						</xsl:choose>
					</table>
					<!--联系人信息-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td colspan="3" class="alignleft fontbold">联系人信息：</td>
						</tr>
						<xsl:for-each select="EMR08.00.01/ZLG08.00.01.004">
							<tr>
								<td class="alignleft" style="width:30%">
									<xsl:value-of select="EMR08.01.01.051"/>：
					<xsl:value-of select="EMR08.01.01.053"/>
								</td>
								<td class="alignleft" style="width:30%">
					证件类别：<xsl:value-of select="EMR08.01.01.054"/>
								</td>
								<td class="alignleft">
					证件号码：<xsl:value-of select="EMR08.01.01.055"/>
								</td>
							</tr>
						</xsl:for-each>
					</table>
					<table cellpadding="5" cellspacing="0" class="fptable">
						<xsl:for-each select="EMR08.00.01/ZLG08.00.01.006">
							<tr>
								<td class="alignleft" style="width:30%">
									<xsl:value-of select="EMR08.01.01.081"/>：
					<xsl:value-of select="EMR08.01.01.083"/>
								</td>
								<td class="alignleft">电子邮件地址：
					<xsl:value-of select="EMR08.01.01.084"/>
								</td>
							</tr>
						</xsl:for-each>
					</table>
					<!--入出信息-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td colspan="6">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
						<tr>
							<td class="alignleft" style="width:12%">入院日期：</td>
							<td class="alignleft" style="width:18%">
								<xsl:choose>
									<xsl:when test="EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.121='患者住院' ">
										<xsl:value-of select="concat(translate(substring(string(EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.123),0,6),'-','年'),
																	translate(substring(string(EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.123),6,3),'-','月'),
																	translate(substring(string(EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.123),9,3),'T','日')
																	)"/>
									</xsl:when>
									<xsl:otherwise>
						</xsl:otherwise>
								</xsl:choose>
							</td>
							<td class="alignleft" style="width:12%">入院科室：</td>
							<td class="alignleft" style="width:18%">
								<xsl:choose>
									<xsl:when test="EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.121='患者住院' ">
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.125"/>
									</xsl:when>
									<xsl:otherwise>
						</xsl:otherwise>
								</xsl:choose>
							</td>
							<td class="alignleft" style="width:12%">转科科别:</td>
							<td class="alignleft">
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.011[EMR08.01.01.121='患者转科']">
									<xsl:sort select="EMR08.01.01.123"/>
									<xsl:if test="position() != last() ">
										<xsl:value-of select="EMR08.01.01.125"/>→
					</xsl:if>
									<xsl:if test="position() = last()">
										<xsl:value-of select="EMR08.01.01.125"/>
									</xsl:if>
								</xsl:for-each>
							</td>
						</tr>
						<tr>
							<td class="alignleft" style="width:12%">出院日期：</td>
							<td class="alignleft" style="width:18%">
								<xsl:choose>
									<xsl:when test="EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.121='患者住院'">
										<xsl:value-of select="concat(translate(substring(string(EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.124),0,6),'-','年'),
																	translate(substring(string(EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.124),6,3),'-','月'),
																	translate(substring(string(EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.124),9,3),'T','日')
																	)"/>
									</xsl:when>
								</xsl:choose>
							</td>
							<td class="alignleft" style="width:12%">出院科室：</td>
							<td class="alignleft" style="width:18%">
								<xsl:choose>
									<xsl:when test="EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.121='患者转科'">
										<xsl:for-each select="EMR08.00.01/ZLG08.00.01.011[EMR08.01.01.121='患者转科']">
											<xsl:sort select="EMR08.01.01.123" order="descending"/>
											<xsl:if test="position()=1">
												<xsl:value-of select="EMR08.01.01.125"/>
											</xsl:if>
										</xsl:for-each>
									</xsl:when>
									<xsl:otherwise>
										<xsl:choose>
											<xsl:when test="EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.121='患者住院'">
												<xsl:value-of select="EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.125"/>
											</xsl:when>
											<xsl:otherwise>
								</xsl:otherwise>
										</xsl:choose>
									</xsl:otherwise>
								</xsl:choose>
							</td>
							<td class="alignleft" style="width:12%">实际住院：</td>
							<td class="alignleft">
								<xsl:choose>
									<xsl:when test="EMR08.00.01/ZLG08.00.01.011/EMR08.01.01.121='患者住院'">
										<xsl:value-of select="concat(string(EMR08.00.01/ZLG08.00.01.011/in_days),'天')"/>
									</xsl:when>
								</xsl:choose>
							</td>
						</tr>
					</table>
					<!--诊断-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft" style="width:62%">门（急）诊诊断：
					<xsl:for-each select="EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='2']">
									<xsl:if test="position()=1">
										<xsl:for-each select="ZLG08.00.01.031">
											<xsl:value-of select="EMR08.01.01.154"/>
											<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
										</xsl:for-each>
										<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
									</xsl:if>
								</xsl:for-each>
							</td>
							<td class="alignleft">
					诊断机构：
					<xsl:for-each select="EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='2']">
									<xsl:if test="position()=1">
										<xsl:value-of select="EMR08.01.01.148"/>
									</xsl:if>
								</xsl:for-each>
							</td>
						</tr>
						<tr>
							<td class="alignleft">
					入院诊断：
					<xsl:for-each select="EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='3']">
									<xsl:for-each select="ZLG08.00.01.031">
										<xsl:value-of select="EMR08.01.01.154"/>
										<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
									</xsl:for-each>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
								</xsl:for-each>
							</td>
							<td class="alignleft">
					入院后确诊日期：
					<xsl:for-each select="EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='3']">
									<xsl:if test="position()=1">
										<xsl:value-of select="concat(translate(substring(string(EMR08.01.01.149),0,6),'-','年'),
																	translate(substring(string(EMR08.01.01.149),6,3),'-','月'),
																	translate(substring(string(EMR08.01.01.149),9,3),'T','日')
																	)"/>
									</xsl:if>
								</xsl:for-each>
							</td>
						</tr>
					</table>
					<!--出院诊断-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft fontbold">出院诊断：</td>
						</tr>
					</table>
					<table cellpadding="5" cellspacing="0" class="fptable tableborders">
						<!--表头-->
						<tr>
							<td class="aligncenter" style="width:60%">疾病名称</td>
							<td class="aligncenter" style="width:12%">出院情况</td>
							<td class="aligncenter">ICD-10编码</td>
						</tr>
						<xsl:if test="count(EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='12']) &gt; 0 ">
							<xsl:for-each select="EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='12']/ZLG08.00.01.031">
								<xsl:sort select="EMR08.01.01.153"/>
								<xsl:if test="position() = 1">
									<tr>
										<td class="alignleft">
											<span class="fontbold">主要诊断：</span>
											<xsl:value-of select="EMR08.01.01.154"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="ZLE08.00.01.013"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR08.01.01.155"/>
										</td>
									</tr>
								</xsl:if>
								<xsl:if test="position() &gt; 1">
									<tr>
										<td class="alignleft" style="text-indent:56.5pt">
											<xsl:value-of select="EMR08.01.01.154" disable-output-escaping="no"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="ZLE08.00.01.013"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR08.01.01.155"/>
										</td>
									</tr>
								</xsl:if>
							</xsl:for-each>
						</xsl:if>
						
						<xsl:if test="count(EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='12']) = 0 ">
							<tr>
								<td class="alignleft">
									<span class="fontbold">主要诊断：</span>
								</td>
								<td class="alignleft">
				</td>
								<td class="alignleft">
				</td>
							</tr>
						</xsl:if>
						<xsl:if test="count(EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='13']) &gt; 0 ">
							<xsl:for-each select="EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='13']/ZLG08.00.01.031">
								<xsl:sort select="EMR08.01.01.153"/>
								<xsl:if test="position() = 1">
									<tr>
										<td class="alignleft">
											<span class="fontbold">其他诊断：</span>
											<xsl:value-of select="EMR08.01.01.154"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="ZLE08.00.01.013"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR08.01.01.155"/>
										</td>
									</tr>
								</xsl:if>
								<xsl:if test="position() &gt; 1">
									<tr>
										<td class="alignleft" style="text-indent:56.5pt">
											<xsl:value-of select="EMR08.01.01.154" disable-output-escaping="no"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="ZLE08.00.01.013"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR08.01.01.155"/>
										</td>
									</tr>
								</xsl:if>
							</xsl:for-each>
						</xsl:if>
						
						<xsl:if test="count(EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='13']) = 0 ">
							<tr>
								<td class="alignleft">
									<span class="fontbold">其他诊断：</span>
								</td>
								<td class="alignleft">
				</td>
								<td class="alignleft">
				</td>
							</tr>
						</xsl:if>
						<!--Space-->
						<tr>
							<td>
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
							<td>
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
							<td>
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
						<xsl:if test="count(EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='11']) &gt; 0 ">
							<xsl:for-each select="EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='11']/ZLG08.00.01.031">
								<xsl:sort select="EMR08.01.01.153"/>
								<xsl:if test="position() = 1">
									<tr>
										<td class="alignleft">
											<span class="fontbold">院内感染诊断：</span>
											<xsl:value-of select="EMR08.01.01.154"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="ZLE08.00.01.013"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR08.01.01.155"/>
										</td>
									</tr>
								</xsl:if>
								<xsl:if test="position() &gt; 1">
									<tr>
										<td class="alignleft" style="text-indent:78.5pt">
											<xsl:value-of select="EMR08.01.01.154" disable-output-escaping="no"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="ZLE08.00.01.013"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR08.01.01.155"/>
										</td>
									</tr>
								</xsl:if>
							</xsl:for-each>
						</xsl:if>
						
						<xsl:if test="count(EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='11']) = 0 ">
							<tr>
								<td class="alignleft">
									<span class="fontbold">院内感染诊断：</span>
								</td>
								<td class="alignleft">
				</td>
								<td class="alignleft">
				</td>
							</tr>
						</xsl:if>
					</table>
					<!--病理诊断-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft" style="width:80px;">
								<span class="fontbold">病理诊断：</span>
							</td>
							<td class="alignleft">
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='9']">
									<xsl:for-each select="ZLG08.00.01.031">
										<xsl:value-of select="EMR08.01.01.154"/>
										<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
									</xsl:for-each>
								</xsl:for-each>
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
					</table>
					<!--损伤、中毒的外部原因-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft" style="width:168px">
								<span class="fontbold">损伤、中毒的外部原因：</span>
							</td>
							<td class="alignleft">
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.014[EMR08.01.01.152='98']">
									<xsl:for-each select="ZLG08.00.01.031">
										<xsl:value-of select="EMR08.01.01.154"/>
										<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
									</xsl:for-each>
								</xsl:for-each>
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
					</table>
					<!--药物过敏-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft" style="width:80px">
								<span class="fontbold">药物过敏：</span>
							</td>
							<td class="alignleft">
								<xsl:variable name="symptomsCount" select="count(EMR08.00.01/ZLG08.00.01.013)"/>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.013">
									<xsl:if test="position() = last()">
										<xsl:value-of select="ZLE08.00.01.010"/>
									</xsl:if>
									<xsl:if test="position() != last()">
										<xsl:value-of select="ZLE08.00.01.010"/>，
                        </xsl:if>
								</xsl:for-each>
							</td>
						</tr>
					</table>
					<!--病毒标志检测-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft" style="width:110px">
								<span class="fontbold">病毒标志检测：</span>
							</td>
							<td class="alignleft">
								<xsl:variable name="ProjectItemCount" select="count(EMR08.00.01/ZLG08.00.01.012/ZLG08.00.01.030)"/>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.012/ZLG08.00.01.030">
									<xsl:if test="$ProjectItemCount = 1">
										<xsl:value-of select="EMR08.01.01.133"/>：
							<xsl:value-of select="EMR08.01.01.135"/>
									</xsl:if>
									<xsl:if test="$ProjectItemCount &gt; 1">
										<xsl:if test="position() &lt; $ProjectItemCount">
											<xsl:value-of select="EMR08.01.01.133"/>：
							<xsl:value-of select="EMR08.01.01.135"/>|
							</xsl:if>
										<xsl:if test="position() = $ProjectItemCount">
											<xsl:value-of select="EMR08.01.01.133"/>：
								<xsl:value-of select="EMR08.01.01.135"/>
										</xsl:if>
									</xsl:if>
								</xsl:for-each>
							</td>
						</tr>
					</table>
					<!--Space-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td>
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
					</table>
					<!--手术情况-->
					<xsl:if test="count(EMR08.00.01/ZLG08.00.01.015) &gt; 0">
						<table cellpadding="5" cellspacing="0" class="fptable">
							<tr>
								<td class="alignleft">
									<span class="fontbold">手术情况：</span>
								</td>
							</tr>
						</table>
						<!--手术-->
						<table cellpadding="5" cellspacing="0" class="fptable tableborders">
							<tr>
								<td class="aligncenter" style="width:12%">手术、操作<br/>编码</td>
								<td class="aligncenter" style="width:15%">手术、操作<br/>日期</td>
								<td class="aligncenter">手术、操作名称</td>
								<td class="aligncenter" style="width:10%">术者</td>
								<td class="aligncenter" style="width:10%">Ⅰ助</td>
								<td class="aligncenter" style="width:10%">Ⅱ助</td>
								<td class="aligncenter" style="width:12%">切口愈合<br/>等级</td>
							</tr>
							<xsl:for-each select="EMR08.00.01/ZLG08.00.01.015">
								<xsl:variable name="OptCode" select="ZLG08.00.01.032/EMR08.01.01.163"/>
								<tr>
									<td class="alignleft">
										<xsl:value-of select="ZLG08.00.01.032/EMR08.01.01.163"/>
									</td>
									<td class="alignleft">
										<xsl:value-of select="substring(string(ZLG08.00.01.032/EMR08.01.01.170),1,10)"/>
									</td>
									<td class="alignleft">
										<xsl:value-of select="ZLG08.00.01.032/EMR08.01.01.161"/>
									</td>
									<td class="alignleft">
										<xsl:for-each select="../ZLG08.00.01.010[ZLE08.00.01.011=$OptCode]">
											<xsl:if test="EMR08.01.01.113 = '16'">
												<xsl:value-of select="EMR08.01.01.111"/>
											</xsl:if>
										</xsl:for-each>
									</td>
									<td class="alignleft">
										<xsl:for-each select="../ZLG08.00.01.010[ZLE08.00.01.011=$OptCode]">
											<xsl:if test="EMR08.01.01.113 = '17'">
												<xsl:value-of select="EMR08.01.01.111"/>
											</xsl:if>
										</xsl:for-each>
									</td>
									<td class="alignleft">
										<xsl:for-each select="../ZLG08.00.01.010[ZLE08.00.01.011=$OptCode]">
											<xsl:if test="EMR08.01.01.113='18'">
												<xsl:value-of select="EMR08.01.01.111"/>
											</xsl:if>
										</xsl:for-each>
									</td>
									<td class="alignleft">
										<xsl:value-of select="ZLG08.00.01.032/ZLE08.00.01.012"/>
									</td>
								</tr>
							</xsl:for-each>
							<tr>
								<td>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
								</td>
								<td>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
								</td>
								<td>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
								</td>
								<td>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
								</td>
								<td>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
								</td>
								<td>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
								</td>
								<td>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
								</td>
							</tr>
						</table>
						<!--麻醉信息-->
						<table cellpadding="5" cellspacing="0" class="fptable">
							<xsl:if test="count(EMR08.00.01/ZLG08.00.01.015/ZLG08.00.01.033/ZLG08.00.01.034) &gt; 0">
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.015">
									<xsl:variable name="OptCode2" select="ZLG08.00.01.032/EMR08.01.01.163"/>
									<xsl:if test="position()=1">
										<xsl:for-each select="ZLG08.00.01.033/ZLG08.00.01.034">
											<xsl:if test="position()=1">
												<tr>
													<td class="alignleft" style="width:13%">
														<span class="fontbold">麻醉方式：</span>
													</td>
													<td class="alignleft" style="width:58%">
														<xsl:value-of select="EMR08.01.01.181"/>
													</td>
													<td class="alignleft" style="width:13%">
														<span class="fontbold">麻醉医师：</span>
													</td>
													<td class="alignleft">
														<xsl:for-each select="../../../ZLG08.00.01.010[ZLE08.00.01.011=$OptCode2]">
															<xsl:if test="EMR08.01.01.113= '23'">
																<xsl:value-of select="EMR08.01.01.111"/>
															</xsl:if>
														</xsl:for-each>
													</td>
												</tr>
											</xsl:if>
											<xsl:if test="position()>1">
												<tr>
													<td class="alignleft" style="width:13%">
                </td>
													<td class="alignleft" style="width:58%">
														<xsl:value-of select="EMR08.01.01.181"/>
													</td>
													<td class="alignleft" style="width:13%">
                </td>
													<td class="alignleft">
														<!--<xsl:for-each select="../../../ZLG08.00.01.010[EMR08.01.01.163=$OptCode2]">
						<xsl:if ZLG08.00.01.012="EMR08.01.01.113= '23'">
							<xsl:value-of select="EMR08.01.01.111" />
						</xsl:if>
					</xsl:for-each>-->
													</td>
												</tr>
											</xsl:if>
										</xsl:for-each>
									</xsl:if>
									<xsl:if test="position()>1">
										<xsl:for-each select="ZLG08.00.01.033/ZLG08.00.01.034">
											<tr>
												<td class="alignleft" style="width:13%">
                </td>
												<td class="alignleft" style="width:58%">
													<xsl:value-of select="EMR08.01.01.181"/>
												</td>
												<td class="alignleft" style="width:13%">
                </td>
												<td class="alignleft">
													<xsl:if test="position() = 1">
														<xsl:for-each select="../../../ZLG08.00.01.010[ZLE08.00.01.011=$OptCode2]">
															<xsl:if test="EMR08.01.01.113= '23'">
																<xsl:value-of select="EMR08.01.01.111"/>
															</xsl:if>
														</xsl:for-each>
													</xsl:if>
												</td>
											</tr>
										</xsl:for-each>
									</xsl:if>
								</xsl:for-each>
							</xsl:if>
							<xsl:if test="count(EMR08.00.01/ZLG08.00.01.015/ZLG08.00.01.033/ZLG08.00.01.034) = 0">
								<tr>
									<td class="alignleft" style="width:13%">
										<span class="fontbold">麻醉方式：</span>
									</td>
									<td class="alignleft" style="width:58%">

                </td>
									<td class="alignleft" style="width:13%">
										<span class="fontbold">麻醉医师：</span>
									</td>
									<td class="alignleft">
					
				</td>
								</tr>
							</xsl:if>
						</table>
					</xsl:if>
					<!--Space-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td>
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
					</table>
					<!--随诊-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft" style="width:15%">
								<span class="fontbold">随诊：</span>
								<xsl:if test="EMR08.00.01/ZLG08.00.01.017/ZLG08.00.01.038/EMR08.01.01.204=1">
						是
					</xsl:if>
								<xsl:if test="EMR08.00.01/ZLG08.00.01.017/ZLG08.00.01.038/EMR08.01.01.204=0">
						否
					</xsl:if>
							</td>
							<td class="alignleft" style="width:25%">随诊期限：
					<xsl:if test="EMR08.00.01/ZLG08.00.01.017/ZLG08.00.01.038/EMR08.01.01.204=1">
									<xsl:value-of select="EMR08.00.01/ZLG08.00.01.017/ZLG08.00.01.038/EMR08.01.01.205"/>天
					</xsl:if>
							</td>
							<td class="alignleft" style="width:15%">
								<span class="fontbold">血型：</span>
								<xsl:value-of select="EMR08.00.01/ZLG08.00.01.022/EMR08.01.01.021"/>
							</td>
							<td class="alignleft">
								<!--
                    <xsl:if ZLG08.00.01.012="EMR08.00.01/ZLG08.00.01.022/rh_blood='0'">
						Rh 阳性
					</xsl:if>
					<xsl:if ZLG08.00.01.012="EMR08.00.01/ZLG08.00.01.022/rh_blood='1'">
						Rh 阴性
					</xsl:if>
					<xsl:if ZLG08.00.01.012="EMR08.00.01/ZLG08.00.01.022/rh_blood='3'">
						未知
					</xsl:if>
                    -->
								<xsl:value-of select="EMR08.00.01/ZLG08.00.01.022/EMR08.01.01.022"/>
							</td>
						</tr>
					</table>
					<!--输血记录-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft">
								<span class="fontbold">输血记录：</span>
								<span style="color:Red">
									<!--红细胞：1200u  全血：800ml  输血反应：有
						<xsl:for-each-group select="EMR08.00.01/ZLG08.00.01.016" group-by="concat(tsfs_typecode,'|',tsfs_measure_unit)">
							<xsl:value-of select="substring-before(current-grouping-key(),'|')" />：
							<xsl:value-of select="sum(current-group()/tsfs_amount)" />
							<xsl:value-of select="substring-after(current-grouping-key(),'|')" />
							<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>							
						</xsl:for-each-group>
                        -->
									<xsl:if test="count(EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='红细胞']) &gt; 0">
                            红细胞：
                            <xsl:value-of select="sum(EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='红细胞']/EMR08.01.01.192)"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='红细胞']/EMR08.01.01.193"/>
                            <xsl:text disable-output-escaping="yes">&amp;#160;&amp;#160;&amp;#160;&amp;#160;</xsl:text>
                        </xsl:if>
									<xsl:if test="count(EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='血小板']) &gt; 0">
                            血小板：
                            <xsl:value-of select="sum(EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='血小板']/EMR08.01.01.192)"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='血小板']/EMR08.01.01.193"/>
                            <xsl:text disable-output-escaping="yes">&amp;#160;&amp;#160;&amp;#160;&amp;#160;</xsl:text>
                        </xsl:if>
									<xsl:if test="count(EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='血浆']) &gt; 0">
                            血浆：
                            <xsl:value-of select="sum(EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='血浆']/EMR08.01.01.192)"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='血浆']/EMR08.01.01.193"/>
                            <xsl:text disable-output-escaping="yes">&amp;#160;&amp;#160;&amp;#160;&amp;#160;</xsl:text>
                        </xsl:if>
									<xsl:if test="count(EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='全血']) &gt; 0">
                            全血：
                            <xsl:value-of select="sum(EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='全血']/EMR08.01.01.192)"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='全血']/EMR08.01.01.193"/>
                            <xsl:text disable-output-escaping="yes">&amp;#160;&amp;#160;&amp;#160;&amp;#160;</xsl:text>
                        </xsl:if>
									<xsl:if test="count(EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='其他']) &gt; 0">
                            其他：
                            <xsl:value-of select="sum(EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='其他']/EMR08.01.01.192)"/>
										<xsl:value-of select="EMR08.00.01/ZLG08.00.01.016[EMR08.01.01.191='其他']/EMR08.01.01.193"/>
									</xsl:if>
									<xsl:if test="count(EMR08.00.01/ZLG08.00.01.016[string(EMR08.01.01.194) = '1']) &gt; 0">
							输血反应：有
						</xsl:if>
									<xsl:if test="count(EMR08.00.01/ZLG08.00.01.016[string(EMR08.01.01.194) = '0']) = 0">
							输血反应：无
						</xsl:if>
								</span>
							</td>
						</tr>
					</table>
					<!--诊疗记录-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft">
								<span class="fontbold">诊疗记录：</span>
							</td>
						</tr>
						<tr>
							<td class="alignleft" style="text-indent:2em">
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.020">
									<xsl:value-of select="EMR08.01.01.231"/>：<xsl:value-of select="EMR08.01.01.232"/>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
								</xsl:for-each>
							</td>
						</tr>
					</table>
					<!--诊断符合情况-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft">
								<span class="fontbold">诊断符合情况：</span>
							</td>
						</tr>
						<tr>
							<td class="alignleft">
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.019/ZLG08.00.01.041[EMR08.01.01.221!='']">
									<xsl:value-of select="EMR08.01.01.221"/>：
						<xsl:value-of select="EMR08.01.01.223"/>
									<xsl:if test="position() mod 3 !=0">
							<xsl:text disable-output-escaping="yes">&amp;#160;&amp;#160;&amp;#160;&amp;#160;</xsl:text>
						</xsl:if>
									<xsl:if test="position() mod 3 =0">
										<br/>
									</xsl:if>
								</xsl:for-each>
							</td>
						</tr>
					</table>
					<!--病案相关-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft" style="width:13%">
								<span class="fontbold">病案质量：</span>
							</td>
							<td class="alignleft" style="width:20%">
								<xsl:value-of select="EMR08.00.01/ZLG08.00.01.019/EMR08.01.01.225"/>
							</td>
							<td class="alignleft" style="width:30%">
								<xsl:if test="EMR08.00.01/ZLG08.00.01.018/EMR08.01.01.212">
					抢救 <xsl:value-of select="EMR08.00.01/ZLG08.00.01.018/EMR08.01.01.212"/>次
				</xsl:if>
								<xsl:if test="EMR08.00.01/ZLG08.00.01.018/EMR08.01.01.213">
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
					成功 <xsl:value-of select="EMR08.00.01/ZLG08.00.01.018/EMR08.01.01.213"/>次
				</xsl:if>
							</td>
							<td class="alignleft">
								<xsl:if test="EMR08.00.01/ZLG08.00.01.018">
									<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
						去向：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.018/EMR08.01.01.216"/>
								</xsl:if>
							</td>
						</tr>
					</table>
					<!--医师信息-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft" style="width:20%">
								<span class="fontbold">科主任：</span>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.010">
									<xsl:if test="EMR08.01.01.113='01'">
										<xsl:value-of select="EMR08.01.01.111"/>
									</xsl:if>
								</xsl:for-each>
							</td>
							<td class="alignleft" style="width:27%">
								<span class="fontbold">（副）主任医师：</span>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.010">
									<xsl:if test="EMR08.01.01.113='02'">
										<xsl:value-of select="EMR08.01.01.111"/>
									</xsl:if>
								</xsl:for-each>
							</td>
							<td class="alignleft" style="width:28%">
								<span class="fontbold">主治医师：</span>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.010">
									<xsl:if test="EMR08.01.01.113='03'">
										<xsl:value-of select="EMR08.01.01.111"/>
									</xsl:if>
								</xsl:for-each>
							</td>
							<td class="alignleft" style="width:25%">
								<span class="fontbold">住院总医师：</span>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.010">
									<xsl:if test="EMR08.01.01.113='04'">
										<xsl:value-of select="EMR08.01.01.111"/>
									</xsl:if>
								</xsl:for-each>
							</td>
						</tr>
						<tr>
							<td class="alignleft" style="width:20%">
								<span class="fontbold">住院医师：</span>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.010">
									<xsl:if test="EMR08.01.01.113='05'">
										<xsl:value-of select="EMR08.01.01.111"/>
									</xsl:if>
								</xsl:for-each>
							</td>
							<td class="alignleft" style="width:27%">
								<span class="fontbold">进修医师：</span>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.010">
									<xsl:if test="EMR08.01.01.113='06'">
										<xsl:value-of select="EMR08.01.01.111"/>
									</xsl:if>
								</xsl:for-each>
							</td>
							<td class="alignleft" style="width:28%">
								<span class="fontbold">研究生实习医师：</span>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.010">
									<xsl:if test="EMR08.01.01.113='07'">
										<xsl:value-of select="EMR08.01.01.111"/>
									</xsl:if>
								</xsl:for-each>
							</td>
							<td class="alignleft" style="width:25%">
								<span class="fontbold">实习医师：</span>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.010">
									<xsl:if test="EMR08.01.01.113='08'">
										<xsl:value-of select="EMR08.01.01.111"/>
									</xsl:if>
								</xsl:for-each>
							</td>
						</tr>
						<tr>
							<td class="alignleft" style="width:20%">
								<span class="fontbold">编码员：</span>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.010">
									<xsl:if test="EMR08.01.01.113='09'">
										<xsl:value-of select="EMR08.01.01.111"/>
									</xsl:if>
								</xsl:for-each>
							</td>
							<td class="alignleft" style="width:27%">
								<span class="fontbold">质控医师：</span>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.010">
									<xsl:if test="EMR08.01.01.113='10'">
										<xsl:value-of select="EMR08.01.01.111"/>
									</xsl:if>
								</xsl:for-each>
							</td>
							<td class="alignleft" style="width:28%">
								<span class="fontbold">质控护士：</span>
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.010">
									<xsl:if test="EMR08.01.01.113='11'">
										<xsl:value-of select="EMR08.01.01.111"/>
									</xsl:if>
								</xsl:for-each>
							</td>
							<td class="alignleft" style="width:25%">
								<span class="fontbold"/>
							</td>
						</tr>
					</table>
					<!--Space-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td>
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
					</table>
					<!--总费用-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft" style="width:33%">
								<span class="fontbold">住院费用总计：</span>
								<xsl:value-of select="format-number(sum(EMR08.00.01/ZLG08.00.01.021/ZLG08.00.01.042/EMR08.01.01.247),'########.00')"/>
							</td>
							<td class="alignleft" style="width:33%">
								<xsl:if test="EMR08.00.01/ZLG08.00.01.021/EMR08.01.01.248">
						医疗付款方式：<xsl:value-of select="EMR08.00.01/ZLG08.00.01.021/EMR08.01.01.248"/>
								</xsl:if>
							</td>
							<td class="alignleft">
								<xsl:if test="EMR08.00.01/ZLG08.00.01.021/EMR08.01.01.249">
						个人承担：<xsl:value-of select="format-number(EMR08.00.01/ZLG08.00.01.021/EMR08.01.01.249,'########.00')"/>
								</xsl:if>
							</td>
						</tr>
					</table>
					<!--费用明细-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft">
								<xsl:for-each select="EMR08.00.01/ZLG08.00.01.021/ZLG08.00.01.042">
									<xsl:value-of select="EMR08.01.01.245"/>：
						<xsl:value-of select="EMR08.01.01.247"/>
									<xsl:if test="position() mod 5 != 0">
										<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
										<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
										<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
										<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
									</xsl:if>
									<xsl:if test="position() mod 5 = 0">
										<br/>
									</xsl:if>
								</xsl:for-each>
							</td>
						</tr>
					</table>
				</div>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
<!-- Stylus Studio meta-information - (c) 2004-2009. Progress Software Corporation. 保留所有权力.

<metaInformation>
	<scenarios>
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\..\xml\病案首页12.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
		          commandline="" additionalpath="" additionalclasspath="" postprocessortype="none" postprocesscommandline="" postprocessadditionalpath="" postprocessgeneratedext="" validateoutput="no" validator="internal" customvalidator="">
			<advancedProp name="sInitialMode" value=""/>
			<advancedProp name="bXsltOneIsOkay" value="true"/>
			<advancedProp name="bSchemaAware" value="true"/>
			<advancedProp name="bXml11" value="false"/>
			<advancedProp name="iValidation" value="0"/>
			<advancedProp name="bExtensions" value="true"/>
			<advancedProp name="iWhitespace" value="0"/>
			<advancedProp name="sInitialTemplate" value=""/>
			<advancedProp name="bTinyTree" value="true"/>
			<advancedProp name="bWarnings" value="true"/>
			<advancedProp name="bUseDTD" value="false"/>
			<advancedProp name="iErrorHandling" value="fatal"/>
		</scenario>
	</scenarios>
	<MapperMetaTag>
		<MapperInfo srcSchemaPathIsRelative="yes" srcSchemaInterpretAsXML="no" destSchemaPath="" destSchemaRoot="" destSchemaPathIsRelative="yes" destSchemaInterpretAsXML="no"/>
		<MapperBlockPosition></MapperBlockPosition>
		<TemplateContext></TemplateContext>
		<MapperFilter side="source"></MapperFilter>
	</MapperMetaTag>
</metaInformation>
-->