<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html xmlns="http://www.w3.org/1999/xhtml" charset="UTF-8">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
			<head>
				<title>转诊记录</title>
				<link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/common.css"/>
				<link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/referralrecord.css"/>
			</head>
			<body>
				<div id="referralrecord">
					<!--标题-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td>
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
					</table>
					<!--头信息-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							
							<td class="alignleft">
                  个人健康档案号：<xsl:value-of select="EMR13.00.01/ZLG13.00.01.002/ZLE13.00.01.001"/>
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
							<td class="seplinelevel2top" style="width:5%">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
							<td class="seplinelevel2top" style="width:7%">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
							<td class="seplinelevel2top" style="width:14%">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
							<td class="seplinelevel2top" style="width:10%">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
							<td class="seplinelevel2top" style="width:20%">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
							<td class="seplinelevel2top" style="width:24%">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="alignleft">
					姓名：<xsl:value-of select="EMR13.00.01/ZLG13.00.01.002/EMR13.00.01.018"/>
							</td>
							<td class="alignleft">
					性别：<xsl:value-of select="EMR13.00.01/ZLG13.00.01.003/EMR13.00.01.021"/>
							</td>
							<td class="alignleft">
					年龄：<xsl:value-of select="EMR13.00.01/ZLG13.00.01.003/EMR13.00.01.022"/>
							</td>
							<td class="alignleft">
					婚姻：<xsl:value-of select="EMR13.00.01/ZLG13.00.01.003/EMR13.00.01.025"/>
							</td>
							<td class="alignleft">
					出生日期：<xsl:value-of select="concat(translate(substring(EMR13.00.01/ZLG13.00.01.003/EMR13.00.01.029,0,6),'-','年'),
					                                                       translate(substring(EMR13.00.01/ZLG13.00.01.003/EMR13.00.01.029,6,3),'-','月'),
																		   substring(EMR13.00.01/ZLG13.00.01.003/EMR13.00.01.029,9,3),'日')"/>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="alignleft">
				 国籍：<xsl:value-of select="EMR13.00.01/ZLG13.00.01.003/EMR13.00.01.023"/>
							</td>
							<td class="alignleft">
				 民族：<xsl:value-of select="EMR13.00.01/ZLG13.00.01.003/EMR13.00.01.024"/>
							</td>
							<td colspan="2" class="alignleft">
				 文化程度:<xsl:value-of select="EMR13.00.01/ZLG13.00.01.003/EMR13.00.01.028"/>
							</td>
							<td class="alignleft">
				 职业:<xsl:value-of select="EMR13.00.01/ZLG13.00.01.003/ZLG13.00.01.013/EMR13.00.01.027"/>
							</td>
						</tr>
					</table>
					<!--证件号码-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<xsl:for-each select="EMR13.00.01/ZLG13.00.01.002/ZLG13.00.01.012">
							<tr>
								<td class="alignleft" style="width:30%">号码类别：<xsl:value-of select="EMR13.00.01.011"/>
								</td>
								<td class="'alignleft" style="width:30%">号码：<xsl:value-of select="EMR13.00.01.012"/>
								</td>
								<td class="alignleft">标识机构：<xsl:value-of select="EMR13.00.01.015"/>
								</td>
							</tr>
						</xsl:for-each>
						<tr>
							<td class="alignleft" style="width:40%">出生地：<xsl:value-of select="EMR13.00.01/ZLG13.00.01.003/EMR13.00.01.030"/>
							</td>
							<td class="alignleft" style="width:30%">联系方式：<xsl:value-of select="EMR13.00.01/ZLG13.00.01.006[EMR13.00.01.072=01]/EMR13.00.01.071"/>
							</td>
							<td class="alignleft" style="width:30%">号码:<xsl:value-of select="EMR13.00.01/ZLG13.00.01.006[EMR13.00.01.072=01]/EMR13.00.01.073"/>
							</td>
						</tr>
						<tr>
							<td>
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
					</table>
					<!--转出机构信息-->
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="seplinelevel2top">
								<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
							</td>
						</tr>
					</table>
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft" style="width:40%">
									转出机构:<xsl:value-of select="EMR13.00.01/ZLG13.00.01.007[EMR13.00.01.087=02]/EMR13.00.01.081"/>
							</td>
							<td class="alignleft" style="width:30%">转出科室：<xsl:value-of select="EMR13.00.01/ZLG13.00.01.007[EMR13.00.01.087=02]/EMR13.00.01.085"/>
							</td>
							<td class="alignleft" style="width:30%">转出时间：
                
										<xsl:value-of select="concat(translate(substring(string(EMR13.00.01/ZLG13.00.01.009[EMR13.00.01.101='转出机构']/EMR13.00.01.103),0,6),'-','年'),
																	translate(substring(string(EMR13.00.01/ZLG13.00.01.009[EMR13.00.01.101='转出机构']/EMR13.00.01.103),6,3),'-','月'),
																	translate(substring(string(EMR13.00.01/ZLG13.00.01.009[EMR13.00.01.101='转出机构']/EMR13.00.01.103),9,3),'T','日'))"/>
							</td>
						</tr>
						<tr>
							<td class="alignleft">责任医生：<xsl:value-of select="EMR13.00.01/ZLG13.00.01.008[EMR13.00.01.093='84']/EMR13.00.01.091"/>
							</td>
							<td class="alignleft">职称：<xsl:value-of select="EMR13.00.01/ZLG13.00.01.008[EMR13.00.01.093='84']/EMR13.00.01.097"/>
							</td>
						</tr>
						<tr>
							<td class="alignleft fontbold">转出诊断</td>
						</tr>
					</table>
					<!--转出诊断-->
					<table cellpadding="5" cellspacing="0" class="fptable tableborders">
						<!--表头-->
						<tr>
							<td class="aligncenter" style="width:20%">诊断类别</td>
							<td class="aligncenter" style="width:15%">序号</td>
							<td class="aligncenter" style="width:25%">疾病名称</td>
							<td class="aligncenter" style="width:20%">疾病编码</td>
							<td class="aligncenter">诊断日期</td>
						</tr>
						<xsl:variable name="OutOrg" select="EMR13.00.01/ZLG13.00.01.007[EMR13.00.01.087='02']/EMR13.00.01.082">
		     </xsl:variable>
						<!--主要诊断-->
						<xsl:if test="count(EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='12' and ZLE13.00.01.006=$OutOrg])&gt;0">
							<xsl:for-each select="EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='12' and ZLE13.00.01.006=$OutOrg]/ZLG13.00.01.018">
								<xsl:sort select="EMR13.00.01.126"/>
								<xsl:variable name="CouNum" select="count(/EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='12' and ZLE13.00.01.006=$OutOrg]/ZLG13.00.01.018)">
			</xsl:variable>
								<xsl:if test="position() = 1">
									<tr>
										<td rowspan="{$CouNum}" class="alignleft">
											主要诊断
										</td>
										<td class="alignleft">
											<xsl:value-of select="position()"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR13.00.01.127"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR13.00.01.128"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="substring(../EMR13.00.01.122,0,11)"/>
										</td>
									</tr>
								</xsl:if>
								<xsl:if test="position() &gt; 1">
									<tr>
										<td class="alignleft">
											<xsl:value-of select="position()"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR13.00.01.127"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR13.00.01.128"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="substring(../EMR13.00.01.122,0,11)"/>
										</td>
									</tr>
								</xsl:if>
							</xsl:for-each>
						</xsl:if>
						<!--无主要诊断-->
						<xsl:if test="count(EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='12' and ZLE13.00.01.006=$OutOrg])=0">
							<tr>
								<td class="alignleft">
									主要诊断
								</td>
								<td class="alignleft"/>
								<td class="alignleft"/>
								<td class="alignleft"/>
								<td class="alignleft"/>
							</tr>
						</xsl:if>
						<!--次要诊断-->
						<xsl:if test="count(EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='13' and ZLE13.00.01.006=$OutOrg])&gt;0">
							<xsl:for-each select="EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='13' and ZLE13.00.01.006=$OutOrg]/ZLG13.00.01.018">
								<xsl:sort select="EMR13.00.01.126"/>
								<xsl:variable name="CouNum" select="count(/EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='13' and ZLE13.00.01.006=$OutOrg]/ZLG13.00.01.018)">
			</xsl:variable>
								<xsl:if test="position() = 1">
									<tr>
										<td rowspan="{$CouNum}" class="alignleft">
											次要诊断
										</td>
										<td class="alignleft">
											<xsl:value-of select="position()"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR13.00.01.127"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR13.00.01.128"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="substring(../EMR13.00.01.122,0,11)"/>
										</td>
									</tr>
								</xsl:if>
								<xsl:if test="position() &gt; 1">
									<tr>
										<td class="alignleft">
											<xsl:value-of select="position()"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR13.00.01.127"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="EMR13.00.01.128"/>
										</td>
										<td class="alignleft">
											<xsl:value-of select="substring(../EMR13.00.01.122,0,11)"/>
										</td>
									</tr>
								</xsl:if>
							</xsl:for-each>
						</xsl:if>
						<!--无次要诊断-->
						<xsl:if test="count(EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='13' and ZLE13.00.01.006=$OutOrg])=0">
							<tr>
								<td class="alignleft">
									次要诊断
								</td>
								<td class="alignleft"/>
								<td class="alignleft"/>
								<td class="alignleft"/>
								<td class="alignleft"/>
							</tr>
						</xsl:if>
					</table>
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<xsl:for-each select="EMR13.00.01/ZLG13.00.01.007[EMR13.00.01.087='01']">
								<td class="alignleft" style="width:40%">转入机构：<xsl:value-of select="EMR13.00.01.081"/>
								</td>
								<td class="alignleft" style="width:30%">转入科室：<xsl:value-of select="EMR13.00.01.085"/>
								</td>
								<td class="alignleft" style="width:30%">转入时间：</td>
							</xsl:for-each>
						</tr>
						<tr>
							<xsl:for-each select="EMR13.00.01/ZLG13.00.01.008[EMR13.00.01.093='83']">
								<td class="alignleft">责任医生：<xsl:value-of select="EMR13.00.01.091"/>
								</td>
								<td class="alignleft">职称：<xsl:value-of select="EMR13.00.01.097"/>
								</td>
							</xsl:for-each>
						</tr>
					</table>
					<!--转入诊断-->
					<xsl:variable name="InOrg" select="EMR13.00.01/ZLG13.00.01.007[EMR13.00.01.087='01']/EMR13.00.01.082">
		     </xsl:variable>
					<xsl:if test="count(EMR13.00.01/ZLG13.00.01.010[(EMR13.00.01.125='12' or EMR13.00.01.125='13') and ZLE13.00.01.006=$InOrg])&gt;0">
						<table cellpadding="5" cellspacing="0" class="fptable tableborders">
							<!--表头-->
							<tr>
								<td class="aligncenter" style="width:20%">诊断类别</td>
								<td class="aligncenter" style="width:15%">序号</td>
								<td class="aligncenter" style="width:25%">疾病名称</td>
								<td class="aligncenter" style="width:20%">疾病编码</td>
								<td class="aligncenter">诊断日期</td>
							</tr>
							<!--主要诊断-->
							<xsl:if test="count(EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='12' and ZLE13.00.01.006=$InOrg])&gt;0">
								<xsl:for-each select="EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='12' and ZLE13.00.01.006=$InOrg]/ZLG13.00.01.018">
									<xsl:sort select="EMR13.00.01.126"/>
									<xsl:variable name="CouNum" select="count(/EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='12' and ZLE13.00.01.006=$InOrg]/ZLG13.00.01.018)">
									</xsl:variable>
									<xsl:if test="position() = 1">
										<tr>
											<td rowspan="{$CouNum}" class="alignleft">
											主要诊断
										</td>
											<td class="alignleft">
												<xsl:value-of select="position()"/>
											</td>
											<td class="alignleft">
												<xsl:value-of select="EMR13.00.01.127"/>
											</td>
											<td class="alignleft">
												<xsl:value-of select="EMR13.00.01.128"/>
											</td>
											<td class="alignleft">
												<xsl:value-of select="substring(../EMR13.00.01.122,0,11)"/>
											</td>
										</tr>
									</xsl:if>
									<xsl:if test="position() &gt; 1">
										<tr>
											<td class="alignleft">
												<xsl:value-of select="position()"/>
											</td>
											<td class="alignleft">
												<xsl:value-of select="EMR13.00.01.127"/>
											</td>
											<td class="alignleft">
												<xsl:value-of select="EMR13.00.01.128"/>
											</td>
											<td class="alignleft">
												<xsl:value-of select="substring(../EMR13.00.01.122,0,11)"/>
											</td>
										</tr>
									</xsl:if>
								</xsl:for-each>
							</xsl:if>
							<!--无主要诊断-->
							<xsl:if test="count(EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='12' and ZLE13.00.01.006=$InOrg])=0">
								<tr>
									<td class="alignleft">
									主要诊断
								</td>
									<td class="alignleft"/>
									<td class="alignleft"/>
									<td class="alignleft"/>
									<td class="alignleft"/>
								</tr>
							</xsl:if>
							<!--次要诊断-->
							<xsl:if test="count(EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='13' and ZLE13.00.01.006=$InOrg])&gt;0">
								<xsl:for-each select="EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='13' and ZLE13.00.01.006=$InOrg]/ZLG13.00.01.018">
									<xsl:sort select="EMR13.00.01.126"/>
									<xsl:variable name="CouNum" select="count(/EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='13' and ZLE13.00.01.006=$InOrg]/ZLG13.00.01.018)">
			</xsl:variable>
									<xsl:if test="position() = 1">
										<tr>
											<td rowspan="{$CouNum}" class="alignleft">
											次要诊断
										</td>
											<td class="alignleft">
												<xsl:value-of select="position()"/>
											</td>
											<td class="alignleft">
												<xsl:value-of select="EMR13.00.01.127"/>
											</td>
											<td class="alignleft">
												<xsl:value-of select="EMR13.00.01.128"/>
											</td>
											<td class="alignleft">
												<xsl:value-of select="substring(../EMR13.00.01.122,0,11)"/>
											</td>
										</tr>
									</xsl:if>
									<xsl:if test="position() &gt; 1">
										<tr>
											<td class="alignleft">
												<xsl:value-of select="position()"/>
											</td>
											<td class="alignleft">
												<xsl:value-of select="EMR13.00.01.127"/>
											</td>
											<td class="alignleft">
												<xsl:value-of select="EMR13.00.01.128"/>
											</td>
											<td class="alignleft">
												<xsl:value-of select="substring(../EMR13.00.01.122,0,11)"/>
											</td>
										</tr>
									</xsl:if>
								</xsl:for-each>
							</xsl:if>
							<!--无次要诊断-->
							<xsl:if test="count(EMR13.00.01/ZLG13.00.01.010[EMR13.00.01.125='13' and ZLE13.00.01.006=$InOrg])=0">
								<tr>
									<td class="alignleft">
									次要诊断
								</td>
									<td class="alignleft"/>
									<td class="alignleft"/>
									<td class="alignleft"/>
									<td class="alignleft"/>
								</tr>
							</xsl:if>
						</table>
					</xsl:if>
					<table cellpadding="5" cellspacing="0" class="fptable">
						<tr>
							<td class="alignleft fontbold">诊疗过程描述</td>
						</tr>
						<xsl:for-each select="EMR13.00.01/ZLG13.00.01.011">
						<tr>
						    <td class="alignleft">
								<xsl:value-of  select="EMR13.00.01.141"/>:
								<xsl:value-of select="EMR13.00.01.142"/>
							</td>
							
						</tr>
						</xsl:for-each>
					</table>
				</div>
			</body>
		</html>
	</xsl:template>
	<xsl:template match="EMR13.00.01.124">
	
</xsl:template>
</xsl:stylesheet>
<!-- Stylus Studio meta-information - (c) 2004-2009. Progress Software Corporation. 保留所有权力.

<metaInformation>
	<scenarios>
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\..\转诊记录1.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
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