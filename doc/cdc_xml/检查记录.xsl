<?xml version='1.0' encoding='utf-8' ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" />
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml" charset="UTF-8">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>检查记录单</title>
          <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/checkrecord.css" />
          <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/common.css" />
        </head>
        <body>
        <div id="checkrecord">
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td class="cktitle">
                        <xsl:value-of select="EMR04.00.01/ZLG04.00.01.001/EMR04.00.01.001" />                       
                    </td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td>&#160;</td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td colspan="2">
                        区域医疗协同平台文档标识号：
                        <xsl:value-of select="EMR04.00.01/ZLG04.00.01.001/EMR04.00.01.005" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%">
                        归档机构：<xsl:value-of select="EMR04.00.01/ZLG04.00.01.001/EMR04.00.01.003" />
                    </td>
                    <td>
                        归档时间：<xsl:value-of select="translate(EMR04.00.01/ZLG04.00.01.001/EMR04.00.01.006,'T',' ')" />
                    </td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td>&#160;</td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td colspan="2" >
                        病人类型：<xsl:value-of select="EMR04.00.01/ZLG04.00.01.002/EMR04.00.01.019" />
                    </td>
                    <td colspan="2">
                        门诊号/住院号：<xsl:value-of select="EMR04.00.01/ZLG04.00.01.002/ZLG04.00.01.021[EMR04.00.01.011='门诊病历' or EMR04.00.01.011='住院病案' ]/EMR04.00.01.012" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        姓名：<xsl:value-of select="EMR04.00.01/ZLG04.00.01.002/EMR04.00.01.018" />
                    </td>
                    <td style="width: 25%">
                        性别：<xsl:value-of select="EMR04.00.01/ZLG04.00.01.003/EMR04.00.01.021" />
                    </td>
                    <td style="width: 25%">
                        年龄：<xsl:value-of select="EMR04.00.01/ZLG04.00.01.003/EMR04.00.01.022" />
                    </td>
                    <td style="width: 25%">
                        婚姻状况：<xsl:value-of select="EMR04.00.01/ZLG04.00.01.003/EMR04.00.01.025" />
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        工作单位：
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        住址：
                        <xsl:value-of select="EMR04.00.01/ZLG04.00.01.004/EMR04.00.01.032" />
                        <xsl:value-of select="EMR04.00.01/ZLG04.00.01.004/EMR04.00.01.033" />
                        <xsl:value-of select="EMR04.00.01/ZLG04.00.01.004/EMR04.00.01.034" />
                        <xsl:value-of select="EMR04.00.01/ZLG04.00.01.004/EMR04.00.01.035" />
                        <xsl:value-of select="EMR04.00.01/ZLG04.00.01.004/EMR04.00.01.036" />
                        <xsl:value-of select="EMR04.00.01/ZLG04.00.01.004/EMR04.00.01.037" />
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <xsl:value-of select="EMR04.00.01/ZLG04.00.01.005/EMR04.00.01.051" />：
                        <xsl:value-of select="EMR04.00.01/ZLG04.00.01.005/EMR04.00.01.053" />
                    </td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td>&#160;</td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
					<xsl:if  test="EMR04.00.01/ZLG04.00.01.001/EMR04.00.01.001='病理检查记录'"> 
		            <td>标本类型：<xsl:value-of select="EMR04.00.01/ZLG04.00.01.016/EMR04.00.01.171"/></td>
		            <td>标本条码：<xsl:value-of select="EMR04.00.01/ZLG04.00.01.016/EMR04.00.01.173"/></td>
		            <td>采样时间：<xsl:value-of select="EMR04.00.01/ZLG04.00.01.016/EMR04.00.01.176"/></td>
		            <td>核收时间：<xsl:value-of select="EMR04.00.01/ZLG04.00.01.016/EMR04.00.01.176"/></td>
					</xsl:if>
                    <td>
                        检查时间：<xsl:value-of select="translate(EMR04.00.01/ZLG04.00.01.015/EMR04.00.01.165,'T',' ')" />
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text>
                    </td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td class="splinelevel3top">&#160;</td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td colspan="3">
                        <span class="fontbold">检查申请</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        主诉：
						<xsl:for-each select="EMR04.00.01/ZLG04.00.01.009" >
							<xsl:value-of select="EMR04.00.01.091" /> 
						</xsl:for-each>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        症状描述：
						<xsl:for-each select="EMR04.00.01/ZLG04.00.01.009" >
							<xsl:value-of select="EMR04.00.01.096" />
						</xsl:for-each>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-indent: 2em; line-height: 24px;">
						<xsl:for-each select ="EMR04.00.01/ZLG04.00.01.012">
							<xsl:value-of select="EMR04.00.01.121" />
						</xsl:for-each>
                        <xsl:if test="count(EMR04.00.01/ZLG04.00.01.010/ZLG04.00.01.027/EMR04.00.01.104) &gt; 0">
                        ，
                        </xsl:if>                         
						<xsl:for-each select="EMR04.00.01/ZLG04.00.01.010">
							<xsl:value-of select="ZLG04.00.01.027/EMR04.00.01.104" />
						</xsl:for-each>
                        <xsl:if test="count(EMR04.00.01/ZLG04.00.01.011/EMR04.00.01.111) &gt; 0">
                        ，
                        </xsl:if>
						<xsl:value-of select="EMR04.00.01/ZLG04.00.01.011/EMR04.00.01.111" />
                        <xsl:if test="count(EMR04.00.01/ZLG04.00.01.011/ZLG04.00.01.028/EMR04.00.01.112) &gt; 0">
                        ，
                        </xsl:if>
						<xsl:for-each select="EMR04.00.01/ZLG04.00.01.011/ZLG04.00.01.028">
							<xsl:value-of select="EMR04.00.01.112" />
						</xsl:for-each>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
					<!--诊断描述-->
					<xsl:for-each select="EMR04.00.01/ZLG04.00.01.017">
						<xsl:value-of select="EMR04.00.01.185" />：
						<xsl:for-each select="ZLG04.00.01.041">
                            <xsl:value-of select="EMR04.00.01.187" />
							<xsl:if test="position() &lt; last()">，
                            </xsl:if>
						</xsl:for-each>
					</xsl:for-each>			
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        检查部位：
						<xsl:for-each select="EMR04.00.01/ZLG04.00.01.014/ZLG04.00.01.032">
							<xsl:if  test="position() &lt; last()">
								<xsl:for-each select="ZLG04.00.01.033">
                                	<xsl:value-of select="EMR04.00.01.140" />,
								</xsl:for-each>
							</xsl:if>
							<xsl:if test="position()=last()">
							<xsl:for-each select="ZLG04.00.01.033">
                                <xsl:value-of select="EMR04.00.01.140" />
                                <xsl:if test="position() &lt; last()" >,
                                </xsl:if>
							</xsl:for-each>
							</xsl:if>		
						</xsl:for-each>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        &#160;
                    </td>
                </tr>
                <tr>
                    <td width="40%">
                        申请机构：
						<xsl:value-of select="EMR04.00.01/ZLG04.00.01.013/EMR04.00.01.151" />
                    </td>
                    <td width="30%">
						申请辅诊医师：
						<xsl:for-each select="EMR04.00.01/ZLG04.00.01.007">
						<xsl:choose>							
							<xsl:when test="EMR04.00.01.070=41">
							<xsl:value-of select="EMR04.00.01.068" />
							</xsl:when>
						</xsl:choose>
						</xsl:for-each> 
                    </td>
                    <td>
                        申请时间：
						<xsl:value-of select="translate(EMR04.00.01/ZLG04.00.01.013/EMR04.00.01.154,'T',' ')" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text>
                    </td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td class="splinelevel3top">&#160;</td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td colspan="2">
                        <span class="fontbold">检查报告</span>
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="80px">
                        报告单号：
                    </td>
                    <td valign="top">
                        <xsl:value-of select="EMR04.00.01/ZLG04.00.01.015/EMR04.00.01.162" />
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="line-height:20px">
                        客观所见：
                    </td>
                    <td valign="top" style="line-height:20px">
						<xsl:for-each select="EMR04.00.01/ZLG04.00.01.015/ZLG04.00.01.034">
							<xsl:value-of select="EMR04.00.01.163" /><br />
						</xsl:for-each>
						
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="line-height:20px">
                        主观提示：
                    </td>
                    <td valign="top" style="line-height:20px">
						<xsl:for-each select="EMR04.00.01/ZLG04.00.01.015/ZLG04.00.01.035">
							<xsl:value-of select="EMR04.00.01.164" /><br/>
						</xsl:for-each>                        
                    </td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td>&#160;</td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td>
                        <span class="fontbold">诊断意见 </span>
                    </td>
                </tr>
                <xsl:for-each select="EMR04.00.01/ZLG04.00.01.017">
                    <xsl:for-each select="ZLG04.00.01.041">
                        <tr>
                            <td>
                                <xsl:value-of select="position()" />、
                                <xsl:value-of select="EMR04.00.01.187" />， 诊断依据:<xsl:value-of select="EMR04.00.01.189" />
                            </td>
                        </tr>
                    </xsl:for-each>
                </xsl:for-each>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td>&#160;</td>
                </tr>
            </table>
            <table cellpadding="3" cellspacing="0" class="cktable">
                <tr>
                    <td colspan="2">
                        检查机构：<xsl:value-of select="EMR04.00.01/ZLG04.00.01.015/EMR04.00.01.161" />
                    </td>
                    <td>
                        报告时间：<xsl:value-of select="translate(EMR04.00.01/ZLG04.00.01.015/EMR04.00.01.166,'T',' ')" />
                    </td>
                </tr>
                <tr>
                    <td>
						<xsl:for-each select="EMR04.00.01/ZLG04.00.01.007">
						<xsl:choose>							
							<xsl:when test="EMR04.00.01.070=42">
							辅诊执行者：<xsl:value-of select="EMR04.00.01.068" />	
							</xsl:when>
						</xsl:choose>
						</xsl:for-each> 
                    </td>
                    <td>
						<xsl:for-each select="EMR04.00.01/ZLG04.00.01.007">
						<xsl:choose>							
							<xsl:when test="EMR04.00.01.070=44">
							辅诊报告医师：<xsl:value-of select="EMR04.00.01.068" />	
							</xsl:when>
						</xsl:choose>
						</xsl:for-each>                        
                    </td>
                    <td>
                        <xsl:for-each select="EMR04.00.01/ZLG04.00.01.007">
						<xsl:choose>							
							<xsl:when test="EMR04.00.01.070=45">
							报告审核医师：<xsl:value-of select="EMR04.00.01.068" />	
							</xsl:when>
						</xsl:choose>
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
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\..\XML\检查记录.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
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