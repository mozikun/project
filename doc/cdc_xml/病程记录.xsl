<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="UTF-8"/>
	<xsl:template name="getbr">
		<xsl:param name="string"/>
		<xsl:choose>
			<xsl:when test="contains($string,'&#xA;')">
				<xsl:value-of select="substring-before($string,'&#xA;')" />
				<br/>
				<xsl:call-template name="getbr">
					<xsl:with-param name="string" select="substring-after($string,'&#xA;')"/>
				</xsl:call-template>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$string"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="/">
		<html xmlns="http://www.w3.org/1999/xhtml" charset="UTF-8">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
				<title>病程记录</title>
				<link rel="StyleSheet" type="text/css" href="/doc/cdc_xml/styles/common.css"/>
				<link rel="StyleSheet" type="text/css" href="/doc/cdc_xml/styles/courserecord.css"/>
			</head>
			<body>
				<div id="courserecord">
					<table cellpadding="3" cellspacing="0" class="crtable">
				
						<tr>
							<td class="crtitle">
								<xsl:value-of select="EMR10.00.99/ZLG10.00.99.001/ZLE10.00.99.001"/>
							</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" class="crtable">
						<tr>
							<td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
						</tr>
					</table>
					<table cellpadding="3" cellspacing="0" class="crtable">
						<tr>
							<td class="alignleft" style="width:18%">
								<span class="fontbold">姓名：</span>
								<xsl:value-of select="EMR10.00.99/ZLG10.00.99.002/ZLE10.00.99.009"/>
							</td>
							<td class="alignleft" style="width:25%">
								<span class="fontbold">性别：</span>
								<xsl:value-of select="EMR10.00.99/ZLG10.00.99.003/ZLE10.00.99.019"/>
							</td>
							<td class="alignleft" style="width:30%">
								<span class="fontbold">年龄：</span>
								<xsl:value-of select="EMR10.00.99/ZLG10.00.99.003/ZLE10.00.99.020"/>
							</td>
							<td class="alignleft">
								<span class="fontbold">住院号：</span>
								<xsl:value-of select="EMR10.00.99/ZLG10.00.99.002/ZLG10.00.99.006[string(ZLE10.00.99.012) = '住院病案']/ZLE10.00.99.013"/>
							</td>
						</tr>
						<tr>
							<td colspan="4"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
						</tr>
					</table>
					<xsl:for-each select="EMR10.00.99/ZLG10.00.99.011">
						<xsl:sort select="ZLE10.00.99.048"/>
						<xsl:variable name="currPos">
							<xsl:value-of select="position()"/>
						</xsl:variable>
						<xsl:variable name="preRecordtime">
							<xsl:for-each select="../ZLG10.00.99.011">
								<xsl:sort select="ZLE10.00.99.048"/>
								<xsl:if test="position() = $currPos - 1">
									<xsl:value-of select="string(ZLE10.00.99.048)"/>
								</xsl:if>
							</xsl:for-each>
						</xsl:variable>
						<xsl:variable name="currRecordTime">
							<xsl:value-of select="string(ZLE10.00.99.048)"/>
						</xsl:variable>
						<xsl:variable name="currOrgDept">
							<xsl:value-of select="concat(../ZLG10.00.99.004[ZLE10.00.99.035= $currRecordTime]/ZLE10.00.99.027,
                                    '|',
                                    ../ZLG10.00.99.004[ZLE10.00.99.035 = $currRecordTime]/ZLE10.00.99.031)"/>
						</xsl:variable>
						<xsl:variable name="preOrgDept">
							<xsl:value-of select="concat(../ZLG10.00.99.004[string(ZLE10.00.99.035) = $preRecordtime]/ZLE10.00.99.027,
                                    '|',
                                    ../ZLG10.00.99.004[string(ZLE10.00.99.035) = $preRecordtime]/ZLE10.00.99.031)"/>
						</xsl:variable>
						<xsl:if test="$currPos = 1">
							<table cellpadding="3" cellspacing="0" class="crtable">
								<tr>
									<td class="alignleft" style="width:43%">
										<span class="fontbold">住院机构：</span>
										<xsl:value-of select="substring-before($currOrgDept,'|')"/>
									</td>
									<td class="alignleft" style="width:30%">
										<span class="fontbold">住院日期：</span>
										<xsl:value-of select="concat(substring(string($currRecordTime),1,4),'年',
                                            substring(string($currRecordTime),6,2),'月',
                                            substring(string($currRecordTime),9,2),'日')
                                        "/>
									</td>
									<td class="alignleft">
										<span class="fontbold">住院科别：</span>
										<xsl:value-of select="substring-after(string($currOrgDept),'|')"/>
									</td>
								</tr>
							</table>
							<table cellpadding="0" cellspacing="0" class="crtable">
								<tr>
									<td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
								</tr>
							</table>
							<table cellpadding="3" cellspacing="0" class="crtable">
								<tr>
									<td style="width:40%" class="alignleft">
										<xsl:value-of select="translate(substring(string($currRecordTime),1,16),'T',' ')"/>
									</td>
									<td class="alignleft">
										<span class="fontbold">
											<xsl:if test="ZLE10.00.99.047!='日常病程记录'">
												<xsl:value-of select="ZLE10.00.99.047"/>
											</xsl:if>
										</span>
									</td>
								</tr>
							</table>
							<table cellpadding="0" cellspacing="0" class="crtable">
								<tr>
									<td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
								</tr>
							</table>
							<div style="width:700px; margin:0 auto;font-size:10.5pt;text-align:left; line-height:150%;">
								<xsl:variable name="SpaceText" select="translate(ZLE10.00.99.046,' ','&#160;')"/>
								<xsl:call-template name="getbr">
									<xsl:with-param name="string" select="$SpaceText"/>
								</xsl:call-template>
							</div>
							<table cellpadding="3" cellspacing="0" class="crtable">
								<xsl:for-each select="../ZLG10.00.99.005[string(ZLE10.00.99.036) = $currRecordTime]">
									<xsl:sort select="servant_role_code"/>
									<tr>
										<td class="alignright">
											<xsl:value-of select="ZLE10.00.99.039"/>：</td>
										<td class="alignleft" style="width:120px">
											<xsl:value-of select="ZLE10.00.99.038"/>
										</td>
									</tr>
								</xsl:for-each>
							</table>
							<table cellpadding="0" cellspacing="0" class="crtable">
								<tr>
									<td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
								</tr>
							</table>
						</xsl:if>
						<xsl:if test="$currPos &gt; 1">
							<xsl:if test="$currOrgDept = $preOrgDept">
								<table cellpadding="0" cellspacing="0" class="crtable">
									<tr>
										<td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
									</tr>
								</table>
								<table cellpadding="3" cellspacing="0" class="crtable">
									<tr>
										<td style="width:40%" class="alignleft">
											<xsl:value-of select="translate(substring(string($currRecordTime),1,16),'T',' ')"/>
										</td>
										<td class="alignleft">
											<span class="fontbold">
												<xsl:if test="ZLE10.00.99.047 != '日常病程记录'">
													<xsl:value-of select="ZLE10.00.99.047"/>
												</xsl:if>
											</span>
										</td>
									</tr>
								</table>
								<table cellpadding="0" cellspacing="0" class="crtable">
									<tr>
										<td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
									</tr>
								</table>
								<div style="width:700px; margin:0 auto;font-size:10.5pt;text-align:left; line-height:150%;">
									<xsl:variable name="SpaceText" select="translate(ZLE10.00.99.046,' ','&#160;')"/>
									<xsl:call-template name="getbr">
										<xsl:with-param name="string" select="$SpaceText"/>
									</xsl:call-template>
								</div>
								<table cellpadding="3" cellspacing="0" class="crtable">
									<xsl:for-each select="../ZLG10.00.99.005[string(ZLE10.00.99.036) = $currRecordTime]">
										<xsl:sort select="ZLE10.00.99.040"/>
										<tr>
											<td class="alignright">
												<xsl:value-of select="ZLE10.00.99.039"/>：</td>
											<td class="alignleft" style="width:120px">
												<xsl:value-of select="ZLE10.00.99.038"/>
											</td>
										</tr>
									</xsl:for-each>
								</table>
								<table cellpadding="0" cellspacing="0" class="crtable">
									<tr>
										<td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
									</tr>
								</table>
							</xsl:if>
							<xsl:if test="$currOrgDept != $preOrgDept">
								<table cellpadding="3" cellspacing="0" class="crtable">
									<tr>
										<td class="alignleft" style="width:43%">
											<span class="fontbold">住院机构：</span>
											<xsl:value-of select="substring-before($currOrgDept,'|')"/>
										</td>
										<td class="alignleft" style="width:30%">
											<span class="fontbold">住院日期：</span>
											<xsl:value-of select="concat(substring(string($currRecordTime),1,4),'年',
                                            substring(string($currRecordTime),6,2),'月',
                                            substring(string($currRecordTime),9,2),'日')
                                        "/>
										</td>
										<td class="alignleft">
											<span class="fontbold">住院科别：</span>
											<xsl:value-of select="substring-after(string($currOrgDept),'|')"/>
										</td>
									</tr>
								</table>
								<table cellpadding="3" cellspacing="0" class="crtable">
									<tr>
										<td style="width:40%" class="alignleft">
											<xsl:value-of select="translate(substring(string($currRecordTime),1,16),'T',' ')"/>
										</td>
										<td class="alignleft">
											<span class="fontbold">
												<xsl:if test="ZLE10.00.99.047!='日常病程记录'">
													<xsl:value-of select="ZLE10.00.99.047"/>
												</xsl:if>
											</span>
										</td>
									</tr>
								</table>
								<table cellpadding="0" cellspacing="0" class="crtable">
									<tr>
										<td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
									</tr>
								</table>
								<div style="width:700px; margin:0 auto;font-size:10.5pt;text-align:left; line-height:150%;">
									<xsl:variable name="SpaceText" select="translate(ZLE10.00.99.046,' ','&#160;')"/>
									<xsl:call-template name="getbr">
										<xsl:with-param name="string" select="$SpaceText"/>
									</xsl:call-template>
								</div>
								<table cellpadding="3" cellspacing="0" class="crtable">
									<xsl:for-each select="../ZLG10.00.99.005[string(ZLE10.00.99.036) = $currRecordTime]">
										<xsl:sort select="ZLE10.00.99.040"/>
										<tr>
											<td class="alignright">
												<xsl:value-of select="ZLE10.00.99.039"/>：</td>
											<td class="alignleft" style="width:120px">
												<xsl:value-of select="ZLE10.00.99.038"/>
											</td>
										</tr>
									</xsl:for-each>
								</table>
								<table cellpadding="0" cellspacing="0" class="crtable">
									<tr>
										<td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
									</tr>
								</table>
							</xsl:if>
						</xsl:if>
					</xsl:for-each>
				</div>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
<!-- Stylus Studio meta-information - (c) 2004-2009. Progress Software Corporation. 保留所有权力.

<metaInformation>
	<scenarios>
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\..\xml\病程记录1.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
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