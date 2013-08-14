<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="UTF-8" />
<xsl:template name="TrimEnd">
    <xsl:param name="endString" />
    <xsl:choose>
        <xsl:when test="substring($endString,string-length($endString)-1,1)='&#160;'">
           <xsl:call-template name="TrimEnd">
            <xsl:with-param name="endString" select="substring($endString,1,string-length($endString)-1)" />
           </xsl:call-template>
        </xsl:when>
        <xsl:otherwise>
            <xsl:value-of select="$endString" />
        </xsl:otherwise>
    </xsl:choose>
</xsl:template>
<xsl:template name="getbr">
    <xsl:param name="string" />
    <xsl:choose>
        <xsl:when test="contains($string,'&#xA;')">
            <xsl:call-template name="TrimEnd">
                <xsl:with-param name="endString" select="substring-before($string,'&#xA;')" />
            </xsl:call-template>
            <br/>
            <xsl:call-template name="getbr">
            <xsl:with-param name="string" select="substring-after($string,'&#xA;')" />
            </xsl:call-template>
        </xsl:when>
        <xsl:otherwise>
            <xsl:value-of select="$string" />
        </xsl:otherwise>
    </xsl:choose>
</xsl:template>
<xsl:template match="/">
<html xmlns="http://www.w3.org/1999/xhtml" charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <head>
    <title>手术同意书</title>
      <link rel="StyleSheet" type="text/css" href="/doc/cdc_xml/styles/common.css" />
      <link rel="StyleSheet" type="text/css" href="/doc/cdc_xml/styles/surgeryagreement.css" />
    </head>
	<body>
    <div id="surgeryagreement">
        <table cellpadding="3" cellspacing="0" class="sgatable">
            <tr>
                <td class="sgatitle">
                <xsl:value-of select="EMR07.00.01/ZLG07.00.01.001/EMR07.00.01.001" />
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" class="sgatable">
            <tr>
                <td>&#160;</td>
            </tr>
        </table>
        <table cellpadding="3" cellspacing="0" class="sgatable">
            <tr>
                <td style="width:35%" class="alignleft">
                <span class="fontbold">住院机构：</span>
                <xsl:value-of select="EMR07.00.01/ZLG07.00.01.007/EMR07.00.01.081"/>
                </td>
                <td style="width:30%" class="alignleft">
                <span class="fontbold">住院日期：</span>
                <xsl:for-each select="EMR07.00.01/ZLG07.00.01.002/ZLG07.00.01.010[EMR07.00.01.011 = '住院病案']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="concat(substring(string(EMR07.00.01.013),1,4),'年', 
                                                    substring(string(EMR07.00.01.013),6,2),'月',
                                                    substring(string(EMR07.00.01.013),9,2),'日')
                                   " />
                    </xsl:if>
                </xsl:for-each>
                </td>
                <td class="alignleft">
                <span class="fontbold">住院科别：</span>
                <xsl:value-of select="EMR07.00.01/ZLG07.00.01.007/EMR07.00.01.085" />
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" class="sgatable">
            <tr>
                <td>&#160;</td>
            </tr>
        </table>
        <table cellpadding="3" cellspacing="0" class="sgatable">
            <tr>
                <td class="alignleft" style="width:20%">
                <span class="fontbold">姓名：</span>
                <xsl:value-of select="EMR07.00.01/ZLG07.00.01.002/EMR07.00.01.018" />
                </td>
                <td class="alignleft" style="width:15%">
                <span class="fontbold">性别：</span>
                <xsl:value-of select="EMR07.00.01/ZLG07.00.01.003/EMR07.00.01.021" />
                </td>
                <td class="alignleft" style="width:30%">
                <span class="fontbold">年龄：</span>
                <xsl:value-of select="EMR07.00.01/ZLG07.00.01.003/EMR07.00.01.022" />
                </td>
                <td class="alignleft">
                <span class="fontbold">住院号：</span>
                <xsl:for-each select="EMR07.00.01/ZLG07.00.01.002/ZLG07.00.01.010[EMR07.00.01.011='住院病案']">
                    <xsl:if test="position() = 1">
                        <xsl:value-of select="EMR07.00.01.012" />
                    </xsl:if>
                </xsl:for-each>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" class="sgatable">
            <tr>
                <td>&#160;</td>
            </tr>
        </table>
        <div style="width:700px; margin:0 auto;font-size:10.5pt;text-align:left; line-height:18px;">
        <xsl:variable name="SpaceText" select="translate(EMR07.00.01/ZLG07.00.01.016/ZLE07.00.01.007,' ','&#160;')" />
            <xsl:call-template name="getbr">
                <xsl:with-param name="string" select="$SpaceText" />
            </xsl:call-template>
        </div>
        <table cellpadding="0" cellspacing="0" class="sgatable">
            <tr>
                <td>&#160;</td>
            </tr>
        </table>
        <table cellpadding="3" cellspacing="0" class="sgatable">
            <xsl:for-each select="EMR07.00.01/ZLG07.00.01.009">
                <xsl:for-each select="ZLG07.00.01.015">
                <xsl:if test="position() = 1">
                <tr>
                    <td style="width:60%" class="alignright">                    
                        <span class="fontbold"><xsl:value-of select="../EMR07.00.01.104" />：</span>
                    </td>
                    <td class="alignleft">
                        <xsl:value-of select="substring(EMR07.00.01.106,2,1)" />.
                        <xsl:value-of select="EMR07.00.01.107" />
                    </td>
                </tr>
                </xsl:if>
                <xsl:if test="position() &gt; 1">
                <tr>
                    <td style="width:60%">
                    </td>
                    <td class="alignleft">
                        <xsl:value-of select="substring(EMR07.00.01.106,2,1)" />.
                        <xsl:value-of select="EMR07.00.01.107" />
                    </td>
                </tr>
                </xsl:if>
                </xsl:for-each>
            </xsl:for-each>
        </table>
        <table cellpadding="3" cellspacing="0" class="sgatable">
            <xsl:for-each select="EMR07.00.01/ZLG07.00.01.008">
                <tr>
                    <td style="width:90%" class="alignright">
                    <xsl:value-of select="EMR07.00.01.092" />：
                    </td>
                    <td class="alignleft">
                    <xsl:value-of select="EMR07.00.01.091" />
                    </td>
                </tr>
            </xsl:for-each>
        </table>
    </div>
    </body>
</html>
</xsl:template>

</xsl:stylesheet>
<!-- Stylus Studio meta-information - (c) 2004-2009. Progress Software Corporation. 保留所有权力.

<metaInformation>
	<scenarios>
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\xml\手术同意书.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
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