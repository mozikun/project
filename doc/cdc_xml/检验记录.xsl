<?xml version='1.0' encoding='utf-8' ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" />
<xsl:template match="/">
	<html xmlns="http://www.w3.org/1999/xhtml" charset="UTF-8" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>检验记录单</title>
    <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/testrecord.css" />		
    <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/common.css" />
</head>    
<body>
<div id="testrecord">
    <table cellpadding="3" cellspacing="0" class="trtable">
        <tr>
            <td class="trtitle">
			<xsl:value-of select="EMR04.00.02/ZLG04.00.02.001/EMR04.00.02.001"/>
			</td>
        </tr>
    </table>
    <table cellpadding="3" cellspacing="0" class="trtable">
        <tr>
            <td colspan="2" class="alignleft">区域医疗协同平台文档标识号：<xsl:value-of select="EMR04.00.02/ZLG04.00.02.001/EMR04.00.02.005"/></td>
        </tr>
        <tr>
            <td style="width:50%" class="alignleft">归档机构：<xsl:value-of select="EMR04.00.02/ZLG04.00.02.001/EMR04.00.02.003"/></td>
            <td class="alignleft">归档时间：<xsl:value-of select="translate(EMR04.00.02/ZLG04.00.02.001/EMR04.00.02.006,'T',' ')"/></td>
        </tr>        
    </table>
    <table cellpadding="3" cellspacing="0" class="trtable">
        <tr>
            <td>&#160;</td>
        </tr>
    </table>
    <table cellpadding="3" cellspacing="0" class="trtable">
        <tr>
            <td colspan="2" class="alignleft">病人类型：<xsl:value-of select="EMR04.00.02/ZLG04.00.02.002/EMR04.00.02.019"/></td>
            <td colspan="2" class="alignleft">门诊号/住院号：<xsl:value-of select="EMR04.00.02/ZLG04.00.02.002/ZLG04.00.02.012[EMR04.00.02.011='门诊病历' or EMR04.00.02.011='住院病案' ]/EMR04.00.02.012"/></td>
        </tr>
        <tr>
            <td style="width:25%" class="alignleft">姓名：<xsl:value-of select="EMR04.00.02/ZLG04.00.02.002/EMR04.00.02.018"/></td>
            <td style="width:25%" class="alignleft">性别：<xsl:value-of select="EMR04.00.02/ZLG04.00.02.003/EMR04.00.02.021"/></td>
            <td style="width:25%" class="alignleft">年龄：<xsl:value-of select="EMR04.00.02/ZLG04.00.02.003/EMR04.00.02.022"/>
			</td >
            <td style="width:25%">婚姻状况：<xsl:value-of select="EMR04.00.02/ZLG04.00.02.003/EMR04.00.02.025"/></td>
        </tr>		
    </table>
    <table cellpadding="3" cellspacing="0" class="trtable">
        <tr>
            <td>&#160;</td>
        </tr>
    </table>
    
    <table cellpadding="3" cellspacing="0" class="trtable">
		<tr>
			<td colspan="3" class="splinelevel3top"><xsl:text disable-output-escaping="yes">&#160;</xsl:text></td>
		</tr>
        <tr>
            <td width="45%" class="alignleft">
                标本类型：<xsl:value-of select="EMR04.00.02/ZLG04.00.02.008/EMR04.00.02.091"/>
            </td>
            <td class="alignleft">
                &#160;&#160;&#160;&#160;标本单号：<xsl:value-of select="EMR04.00.02/ZLG04.00.02.008/EMR04.00.02.093"/>
            </td>
        </tr>
        <tr>
            <td class="alignleft">申请机构：<xsl:value-of select="EMR04.00.02/ZLG04.00.02.007/EMR04.00.02.071"/></td>
            <td class="alignleft">申请辅诊医师：<xsl:for-each select="EMR04.00.02/ZLG04.00.02.005[EMR04.00.02.040=41]">
					<xsl:value-of select="EMR04.00.02.038" />
				</xsl:for-each>		
			</td>
        </tr>
        <tr>
            <td>采样时间：<xsl:value-of select="translate(EMR04.00.02/ZLG04.00.02.006/EMR04.00.02.053,'T',' ')"/></td>            
            <td>&#160;&#160;&#160;&#160;检验时间：<xsl:value-of select="translate(EMR04.00.02/ZLG04.00.02.010/EMR04.00.02.085,'T',' ')" /></td>
        </tr>
        <tr>
            <td colspan="3"><xsl:text disable-output-escaping="yes">&#160;</xsl:text></td>
        </tr>
        <tr>
            <td colspan="3">
                <table cellpadding="3" cellspacing="0" class="trtable" style="border:0px; width:100%">
					<tr>
						<td width="25%" style="text-align:center">项目名称</td>
						<td width="10%" style="text-align:center">结果</td>
						<td width="10%" style="text-align:center">单位</td>
						<td width="15%" style="text-align:center">正常参考值</td>
						<td width="15%" style="text-align:center">结果标志</td>
						<td width="20%" style="text-align:center">备注</td>
					</tr>
				<xsl:for-each select="EMR04.00.02/ZLG04.00.02.009/ZLG04.00.02.020[string-length(EMR04.00.02.065)=0]">
				    <tr style="font-size:10pt">
                        <td width="25%" style="text-align:left">
						<xsl:value-of select="EMR04.00.02.063"/>
						</td>
						<td width="10%" style="text-align:right">
						<xsl:value-of select="EMR04.00.02.066"/>
						</td>
						<td width="10%" style="text-align:left">
						<xsl:choose>
							<xsl:when test="number(string(substring(EMR04.00.02.067,1,1))) >= 0">
								<xsl:value-of select="concat('*',EMR04.00.02.067)"/>
							</xsl:when>
							<xsl:otherwise>
								<xsl:value-of select="EMR04.00.02.067"/>
							</xsl:otherwise>
						</xsl:choose> 
						</td>
                        <td width="15%" style="text-align:center">
							<xsl:if test="string-length(ZLE04.00.02.089)&gt;0 or string-length(ZLE04.00.02.088) &gt;0">
								<xsl:value-of select="ZLE04.00.02.089" />～<xsl:value-of select="ZLE04.00.02.088" />
							</xsl:if>
						</td>
                        <td width="15%" style="text-align:center">
							<xsl:choose>
								<xsl:when test="EMR04.00.02.066 &lt; ZLE04.00.02.089">
									<span style="color:red">↓</span>
								</xsl:when>
								<xsl:when test="EMR04.00.02.066 &gt;ZLE04.00.02.088">
									<span style="color:red">↑</span>
								</xsl:when>
								<xsl:when test="string-length(ZLE04.00.02.089)&lt;1 or string-length(ZLE04.00.02.088) &lt;1">
									<span style="color:red"></span>
								</xsl:when>
								<xsl:otherwise>
								―
								</xsl:otherwise>
							</xsl:choose>
						</td>
                        <td width="20%" style="text-align:center"></td>
                    </tr>
				</xsl:for-each>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3"><xsl:text disable-output-escaping="yes">&#160;</xsl:text></td>
        </tr>
		<xsl:if test="EMR04.00.02/ZLG04.00.02.009/ZLG04.00.02.020/EMR04.00.02.065!=''">
        <tr>
            <td colspan="3">
                <span style="font-weight:bold;">定性描述：</span>
            </td>
        </tr>
		<xsl:for-each select="EMR04.00.02/ZLG04.00.02.009/ZLG04.00.02.020[string-length(EMR04.00.02.065)&gt;0]">
        <tr>
            <td colspan="3">
					<xsl:value-of select="EMR04.00.02.063"/>：
					<xsl:value-of select="EMR04.00.02.065" />				
			</td>
        </tr>
		</xsl:for-each>
		</xsl:if>       
        <tr>
            <td colspan="3" class="splinelevel3bottom"><xsl:text disable-output-escaping="yes">&#160;</xsl:text></td>
        </tr>		
    </table>
    <table cellpadding="3" cellspacing="0" class="trtable">
        <tr>
            <td>&#160;</td>
        </tr>
    </table>
    <table cellpadding="3" cellspacing="0" class="trtable">
        <tr>
            <td colspan="2">检验机构：<xsl:value-of select="EMR04.00.02/ZLG04.00.02.010/EMR04.00.02.081"/></td>
            <td>报告时间：<xsl:value-of select="translate(EMR04.00.02/ZLG04.00.02.010/EMR04.00.02.086,'T',' ')"/></td>
        </tr>
        <tr>
            <td>
                辅诊执行者：
				<xsl:for-each select="EMR04.00.02/ZLG04.00.02.005[EMR04.00.02.040=42]">
					<xsl:value-of select="EMR04.00.02.038" />
				</xsl:for-each>
			</td>
            <td>
            辅诊报告医师：
				<xsl:for-each select="EMR04.00.02/ZLG04.00.02.005[EMR04.00.02.040=45]">					
                    <xsl:value-of select="EMR04.00.02.038" />
				</xsl:for-each>
			</td>
            <td>
                报告审核医师：
				<xsl:for-each select="EMR04.00.02/ZLG04.00.02.005[EMR04.00.02.040=44]">
					<xsl:value-of select="EMR04.00.02.038" />
				</xsl:for-each>
			</td>
        </tr>
    </table>
</div>
</body>
</html>
</xsl:template>
</xsl:stylesheet><!-- Stylus Studio meta-information - (c) 2004-2009. Progress Software Corporation. 保留所有权力.

<metaInformation>
	<scenarios>
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\..\XML\检验记录22.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
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