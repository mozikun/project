<?xml version='1.0'?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html"  encoding="UTF-8"  />	
	<xsl:template match="/">

	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	    <title>门诊病历</title>
    <link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/outpatientformulary.css" />
  </head>
	<body>
	    <!--TitleInfo-->
	    <table cellpadding="3" cellspacing="0" class="opftable">
	        <tr>
	            <td class="opftitle">
	                <xsl:value-of select="EMR02.00.01/ZLG02.00.01.001/EMR02.00.01.001" />
	            </td>
	        </tr>
	        <tr>
	            <td>
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
	    </table>
	    <!--FormularyNO-->
	    <table cellpadding="3" cellspacing="0" class="opftable">
	        <tr>
	            <td class="alignleft">
	                病历编号：<xsl:value-of select="EMR02.00.01/ZLG02.00.01.001/EMR02.00.01.005" />
	            </td>
	            <td class="alignleft">
	                就诊时间：<xsl:value-of select="concat(translate(substring(EMR02.00.01/ZLG02.00.01.008/EMR02.00.01.373,0,6),'-','年'),
																	translate(substring(EMR02.00.01/ZLG02.00.01.008/EMR02.00.01.373,6,3),'-','月'),
																	translate(substring(EMR02.00.01/ZLG02.00.01.008/EMR02.00.01.373,9,3),'T','日')
																	)" />
	            </td>
	            <td class="alignright">
	                服务医疗机构：<xsl:value-of select="EMR02.00.01/ZLG02.00.01.006/EMR02.00.01.071" />
	            </td>
	        </tr>
	        <tr>
	            <td colspan="3">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
	    </table>
	    <!--PersonInfo-->
	    <table cellpadding="3" cellspacing="0" class="opftable">
	        <tr>
	            <td class="alignleft">
	                姓名：<xsl:value-of select="EMR02.00.01/ZLG02.00.01.002/EMR02.00.01.018" />
	            </td>
	            <td class="alignleft">
	                性别：<xsl:value-of select="EMR02.00.01/ZLG02.00.01.003/EMR02.00.01.021" />
	            </td>
	            <td class="alignleft">
	                年龄：<xsl:value-of select="EMR02.00.01/ZLG02.00.01.003/EMR02.00.01.022" />
	            </td>
	            <td class="alignleft">
	                婚姻状况：<xsl:value-of select="EMR02.00.01/ZLG02.00.01.003/EMR02.00.01.025" />
	            </td>
	        </tr>
	        <tr>
	            <td colspan="4" class="alignleft">
	                工作单位：
                    <xsl:for-each select="EMR02.00.01/ZLG02.00.01.004[EMR02.00.01.042 = '工作场所地址']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="concat(EMR02.00.01/ZLG02.00.01.004/EMR02.00.01.043,
																EMR02.00.01/ZLG02.00.01.004/EMR02.00.01.044,
																EMR02.00.01/ZLG02.00.01.004/EMR02.00.01.045,
																EMR02.00.01/ZLG02.00.01.004/EMR02.00.01.046,
																EMR02.00.01/ZLG02.00.01.004/EMR02.00.01.047,
																EMR02.00.01/ZLG02.00.01.004/EMR02.00.01.048
																)" />
                        </xsl:if>
                    </xsl:for-each>

	            </td>
	        </tr>
	        <tr>
	            <td colspan="4" class="alignleft">
	                住址：<xsl:for-each select="EMR02.00.01/ZLG02.00.01.004[EMR02.00.01.042 = '户籍住址']">
                        <xsl:if test="position() = 1">
                            <xsl:value-of select="concat(EMR02.00.01/ZLG02.00.01.004/EMR02.00.01.043,
																EMR02.00.01/ZLG02.00.01.004/EMR02.00.01.044,
																EMR02.00.01/ZLG02.00.01.004/EMR02.00.01.045,
																EMR02.00.01/ZLG02.00.01.004/EMR02.00.01.046,
																EMR02.00.01/ZLG02.00.01.004/EMR02.00.01.047,
																EMR02.00.01/ZLG02.00.01.004/EMR02.00.01.048
																)" />
                        </xsl:if>
                    </xsl:for-each>
	            </td>
	        </tr>
	        <tr>
	            <td colspan="4" class="alignleft">
	                <xsl:value-of select="EMR02.00.01/ZLG02.00.01.005/EMR02.00.01.061" />：
					<xsl:value-of select="EMR02.00.01/ZLG02.00.01.005/EMR02.00.01.063" />
	            </td>
	        </tr>
	        <tr>
	            <td colspan="4">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
	    </table>
	    <!--DoctorInfo-->
	    <table cellpadding="3" cellspacing="0" class="opftable">
	        <tr>
	            <td class="alignleft" style="width: 45%">
	                就诊科室：<xsl:value-of select="EMR02.00.01/ZLG02.00.01.006/ZLG02.00.01.064/EMR02.00.01.075" />
	            </td>
	            <td class="alignleft" style="width: 30%">
	                接诊医生：
						<xsl:choose>
							<xsl:when test="EMR02.00.01/ZLG02.00.01.007/EMR02.00.01.363='31'">
								<xsl:value-of select ="EMR02.00.01/ZLG02.00.01.007/EMR02.00.01.361" />
							</xsl:when>
						</xsl:choose>
	            </td>
	            <td class="alignleft">
					<xsl:choose>
						<xsl:when test="EMR02.00.01/ZLG02.00.01.009/EMR02.00.01.089='1'">
							初诊
						</xsl:when>
						<xsl:otherwise>
							复诊
						</xsl:otherwise>
					</xsl:choose>
	            </td>
	        </tr>
	        <tr>
	            <td colspan="3">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
	    </table>
	    <!-- TherapyInfo-->
	    <table cellpadding="3" cellspacing="0" class="opftable">
	        <tr>
	            <td colspan="2" class="level2linetop">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
	        <tr>
				<td class="alignleft" style="width:60px">主诉：</td>
	            <td class="alignleft">
	                <xsl:value-of select="EMR02.00.01/ZLG02.00.01.009/EMR02.00.01.081" />
	            </td>
	        </tr>
			<xsl:if test="EMR02.00.01/ZLG02.00.01.066/ZLE02.00.01.001">
	        <tr>
				<td class="alignleft">现病史：</td>
	            <td class="alignleft">					
					<xsl:value-of select="EMR02.00.01/ZLG02.00.01.066/ZLE02.00.01.001" />
				</td>
			</tr>
			</xsl:if>
			<xsl:if test="EMR02.00.01/ZLG02.00.01.011">
			<tr>
				<td></td>
				<td>
					<xsl:for-each select="EMR02.00.01/ZLG02.00.01.011">
						<xsl:value-of select="EMR02.00.01.201" />，
						<xsl:value-of select="EMR02.00.01.202" />，
						<xsl:value-of select="EMR02.00.01.204" /> 。<br />
					</xsl:for-each>
	            </td>
	        </tr>
			</xsl:if>
			<xsl:choose>					
			<xsl:when test="EMR02.00.01/ZLG02.00.01.067/ZLG02.00.01.012">						
	        <tr>
				<td class="alignleft">既往史：</td>
	            <td class="alignleft">
					<xsl:for-each select="EMR02.00.01/ZLG02.00.01.067/ZLG02.00.01.012">
						<xsl:value-of select="EMR02.00.01.211" />：<xsl:value-of select="EMR02.00.01.216" />
					</xsl:for-each>
	            </td>							
	        </tr>				
			</xsl:when>		
			<xsl:when test="EMR02.00.01/ZLG02.00.01.067/ZLG02.00.01.068">
			<tr>
				<td class="alignleft" valign="top">既往史：</td>
	            <td class="alignleft">		
					<xsl:for-each select="EMR02.00.01/ZLG02.00.01.067/ZLG02.00.01.068">
						<xsl:value-of select="EMR02.00.01.217" /><xsl:value-of select="EMR02.00.01.218" />
					</xsl:for-each>
				</td>				
	        </tr>				
			</xsl:when>
			<xsl:otherwise>
			</xsl:otherwise>
			</xsl:choose>
			<xsl:if test="EMR02.00.01/EMR02.00.01.013">	
	        <tr>
	            <td class="alignleft">					
	                过敏史：
	            </td>
				<td class="alignleft">
					<xsl:value-of select ="EMR02.00.01/ZLG02.00.01.013/EMR02.00.01.221" />
				</td>
	        </tr>
			</xsl:if>
	        <tr>
	            <td colspan="2">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
			<!--
	        <tr>
	            <td class="alignleft">
	                个人史：
	            </td>
	        </tr>
	        <tr>
	            <td class="alignleft">
	                家庭史：
	            </td>
	        </tr>			
	        <tr>
	            <td>
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
			-->
	    </table>
	    <!--Physical-->
	    <table cellpadding="3" cellspacing="0" class="opftable">
	        <tr>
	            <td class="opfsubhead">
	                体格检查
	            </td>
	        </tr>
			<xsl:if test="EMR02.00.01/ZLG02.00.01.065/ZLE02.00.01.002">
			<tr>
				<td class="alignleft textindent">
					<xsl:value-of select="EMR02.00.01/ZLG02.00.01.065/ZLE02.00.01.002" />
				</td>
			</tr>			
	        <tr>
	            <td>
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
			</xsl:if>
			<xsl:if test="EMR02.00.01/ZLG02.00.01.065/ZLG02.00.01.010/ZLG02.00.01.057">
			<tr>
				<td class="alignleft">
					<xsl:for-each select="EMR02.00.01/ZLG02.00.01.065/ZLG02.00.01.010/ZLG02.00.01.057">
						<xsl:value-of select="EMR02.00.01.093" />
						<xsl:value-of select="EMR02.00.01.095" />
						<xsl:value-of select="EMR02.00.01.096" />
						<xsl:value-of select="EMR02.00.01.097" />
					</xsl:for-each>
				</td>
			</tr>
			<tr>
				<td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
			</tr>
			</xsl:if>
			<xsl:if test="EMR02.00.01/EMR02.00.01.018">
			<tr>
				<td>
					<xsl:for-each select="EMR02.00.01/ZLG02.00.01.018">
						<xsl:sort  select="EMR02.00.01.382" />
						<xsl:for-each select="ZLG02.00.01.024">
							<xsl:value-of select="EMR02.00.01.383" />：
							<xsl:value-of select="EMR02.00.01.385" />
							<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
						</xsl:for-each>
					</xsl:for-each>
				</td>
			</tr>			
	        <tr>
	            <td>
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
			</xsl:if>
	    </table>
	    <!--Assistant-->
	    <table cellpadding="3" cellspacing="0" class="opftable">
	        <tr>
	            <td class="opfsubhead">
	                辅助检查
	            </td>
	        </tr>
	    </table>
	    <!--Check-->
		<xsl:if test="EMR02.00.01/ZLG02.00.01.019">
		<table cellpadding="3" cellspacing="0" class="opftable">
		<xsl:for-each select="EMR02.00.01/ZLG02.00.01.019">
	        <tr>
	            <td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
	        </tr>
			<tr>
				<td class="alignleft">
					申请单号：<xsl:value-of select="ZLG02.00.01.040/EMR02.00.01.232" />
				</td>
				<td class="alignleft">
					申请科室：<xsl:value-of select="ZLG02.00.01.040/EMR02.00.01.231" />
				</td>
				<td class="alignlright">
					申请时间：<xsl:value-of select="translate(ZLG02.00.01.040/EMR02.00.01.234,'T',' ')" />
				</td>
			</tr>
			<tr>
				<td colspan="3" class="opfcrosshead">
					检查申请：
				</td>
			</tr>
			<tr>
				<td colspan="3" class="alignleft textindent">
					<xsl:for-each select="ZLG02.00.01.040/ZLG02.00.01.044">
						<xsl:value-of select="EMR02.00.01.233" />
					</xsl:for-each>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="alignleft textindent">
					<xsl:for-each select="ZLG02.00.01.040/ZLG02.00.01.045">
						<xsl:value-of select="EMR02.00.01.235" />
					</xsl:for-each> 
				</td>
			</tr>
			<tr>
	            <td colspan="3">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
			<tr>
	            <td class="alignleft">
	                报告单号：<xsl:value-of select="ZLG02.00.01.042/EMR02.00.01.242" />
	            </td>
	            <td class="alignleft">
	                报告科室：<xsl:value-of select="ZLG02.00.01.042/EMR02.00.01.241" /> 
	            </td>
	            <td class="alignright">
	                检查日期：<xsl:value-of select="concat(translate(substring(ZLG02.00.01.042/EMR02.00.01.245,0,6),'-','年'),
																	translate(substring(ZLG02.00.01.042/EMR02.00.01.245,6,3),'-','月'),
																	translate(substring(ZLG02.00.01.042/EMR02.00.01.245,9,3),'T','日')
																	)" />
	            </td>
	        </tr>
			<tr>
	            <td colspan="3">
	                <xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
	            </td>
	        </tr>
			<!--影像-->
			<xsl:if test="ZLG02.00.01.043">
			<tr>
				<td colspan="3" class="alignleft">
					<xsl:value-of select="ZLG02.00.01.043/EMR02.00.01.256" />：
					<xsl:value-of select="ZLG02.00.01.043/EMR02.00.01.257" /> 
				</td>
			</tr>
			</xsl:if>
			<!--病理-->
			<xsl:if test="ZLG02.00.01.041/ZLG02.00.01.046/EMR02.00.01.271='04'">
			<tr>
				<td class="alignleft">
					检查方法：病理
				</td>
				<td colspan="2" class="alignleft">
					检查部位：
					<xsl:for-each select="ZLG02.00.01.041/ZLG02.00.01.046">
						<xsl:for-each select="ZLG02.00.01.047">
							<xsl:value-of select="EMR02.00.01.269" />
						</xsl:for-each>
					</xsl:for-each>
				</td>
			</tr>
			</xsl:if>
			<!--客观所见-->
			<xsl:if test="ZLG02.00.01.042">
			<!--普通检查和影像检查报告格式-->
			<xsl:if test="ZLG02.00.01.041/ZLG02.00.01.046/EMR02.00.01.271!='04'">
			<tr>
	            <td colspan="3" class="opfcrosshead">
	                检查报告：
	            </td>
	        </tr>
			<xsl:if test="ZLG02.00.01.042/ZLG02.00.01.048/EMR02.00.01.243">	
			<tr>
	            <td colspan="3" class="alignleft textindent">
	                <xsl:for-each select="ZLG02.00.01.042/ZLG02.00.01.048">
						<xsl:value-of  select="EMR02.00.01.243" />
					</xsl:for-each>
	            </td>
	        </tr>
			</xsl:if>
			<xsl:if test="ZLG02.00.01.042/ZLG02.00.01.049/EMR02.00.01.244">			
			<tr>
	            <td colspan="3" class="alignleft textindent">
	                <xsl:for-each select="ZLG02.00.01.042/ZLG02.00.01.049">
						<xsl:value-of  select="EMR02.00.01.244" />
					</xsl:for-each>
	            </td>
	        </tr>
			</xsl:if>
			<xsl:if test="ZLG02.00.01.042/ZLG02.00.01.050/EMR02.00.01.247">			
			<tr>
	            <td colspan="3" class="alignleft textindent">
	                <xsl:for-each select="ZLG02.00.01.042/ZLG02.00.01.050">
						<xsl:value-of  select="EMR02.00.01.247" />
					</xsl:for-each>
	            </td>
	        </tr>
			</xsl:if>
			</xsl:if>
			<!--病理检查报告格式-->
			<xsl:if test="ZLG02.00.01.041/ZLG02.00.01.046/EMR02.00.01.271='04'">
			<xsl:for-each select="ZLG02.00.01.041/ZLG02.00.01.046">
			<tr>
				<td colspan="3" class="alignleft textindent">
					<xsl:value-of select="EMR02.00.01.263" />
					<xsl:for-each select="ZLG02.00.01.047">
						<xsl:value-of select="EMR02.00.01.265" />
					</xsl:for-each>
				</td>
			</tr>
			</xsl:for-each>
			</xsl:if>
			</xsl:if>
			<tr>
	            <td colspan="3" class="alignright">
	                检查报告日期：<xsl:value-of select="concat(translate(substring(ZLG02.00.01.042/EMR02.00.01.246,0,6),'-','年'),
																	translate(substring(ZLG02.00.01.042/EMR02.00.01.246,6,3),'-','月'),
																	translate(substring(ZLG02.00.01.042/EMR02.00.01.246,9,3),'T','日')
																	)" />
	            </td>
	        </tr>
			<tr>
	            <td colspan="3" class="level3linebottom"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
	        </tr>
		</xsl:for-each>
			 <tr>
	            <td colspan="3" style="border-top:1px solid #000000"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
	        </tr>
		</table>
		</xsl:if>
	    <!--Test-->		
		<xsl:if test="EMR02.00.01/ZLG02.00.01.020">
		<table cellpadding="3" cellspacing="0" class="opftable">
		<xsl:for-each select="EMR02.00.01/ZLG02.00.01.020">
			<tr>
	            <td colspan="2"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
	        </tr>
			<tr>
				<td class="alignleft">
					检验申请单号：<xsl:value-of select="ZLG02.00.01.032/EMR02.00.01.282" />
				</td>
				<td class="alignleft">
					检验申请日期：<xsl:value-of select="concat(translate(substring(ZLG02.00.01.032/EMR02.00.01.284,0,6),'-','年'),
																	translate(substring(ZLG02.00.01.032/EMR02.00.01.284,6,3),'-','月'),
																	translate(substring(ZLG02.00.01.032/EMR02.00.01.284,9,3),'T','日')
																	)" />
				
				</td>
			</tr>
			<tr>
				<td class="alignleft">检验申请机构：
                    <xsl:value-of select="ZLG02.00.01.032/EMR02.00.01.281" />
                </td>
				<td class="alignleft">申请辅诊医师：
                    
                </td>
			</tr>
			<xsl:if test="ZLG02.00.01.032/ZLG02.00.01.036/EMR02.00.01.283">
			<tr>
				<td colspan="2" class="alignleft">
					检验目的：
					<xsl:for-each select="ZLG02.00.01.032/ZLG02.00.01.036">
						<xsl:value-of select="EMR02.00.01.283" /> 
					</xsl:for-each>
				</td>
			</tr>
			</xsl:if>
			<tr>
				<td colspan="2" style="line-height:20px">
					<table cellpadding="1" cellspacing="0" border="0" style="width:100%;font-size:10.5pt;">
						<xsl:for-each select="ZLG02.00.01.033">						
						<tr>
							<td colspan="2" class="alignleft">
								标本：
									<xsl:value-of select="EMR02.00.01.301" />
							</td>
							<td colspan="2" class="alignleft">
								标本状态：
									<xsl:value-of select="EMR02.00.01.304" />
							</td>
							<td colspan="2" class="alignleft">
								标本号：
									<xsl:value-of select="EMR02.00.01.303" />
							</td>
						</tr>
						<tr>
							<td colspan="2" class="alignleft">
								采样机构：<xsl:value-of select="EMR02.00.01.302" />
							</td>
							<td colspan="2" class="alignleft">
								固定液：<xsl:value-of select="EMR02.00.01.305" />
							</td>
							<td colspan="2" class="alignleft">
								采样时间：<xsl:value-of select="translate(EMR02.00.01.306,'T',' ')" />
							</td>
						</tr>
						</xsl:for-each>
						<tr>
	                        <td colspan="6"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
	                    </tr>
						<tr>
	                        <td class="aligncenter">检验项目名称</td>
	                        <td class="aligncenter"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>检验值</td>
	                        <td class="aligncenter">单位<xsl:text disable-output-escaping="yes">&amp;#160;&amp;#160;&amp;#160;&amp;#160;</xsl:text></td>
	                        <td class="aligncenter">正常参考值</td>
	                        <td class="aligncenter">结果标志</td>
	                        <td class="aligncenter">备注</td>
	                    </tr>
						<xsl:for-each select="ZLG02.00.01.034/ZLG02.00.01.037[string-length(EMR02.00.01.315)=0]">
							<tr>
	                        <td class="alignleft" style="font-size:10pt"><xsl:value-of select="EMR02.00.01.313" /></td>
	                        <td class="alignright" style="font-size:10pt"><xsl:value-of select="EMR02.00.01.316" /></td>
	                        <td class="alignleft" style="font-size:10pt">
								<xsl:choose>
									<xsl:when  test="number(substring(EMR02.00.01.317,1,1)) >= 0">
										<xsl:value-of select="concat('*',EMR02.00.01.317)" />
									</xsl:when>
									<xsl:otherwise>
										<xsl:value-of select="EMR02.00.01.317" />
									</xsl:otherwise>
								</xsl:choose>								
							</td>
	                        <td class="aligncenter" style="font-size:10pt">
							<xsl:if test="string-length(ZLE02.00.01.209)&gt;0 or string-length(ZLE02.00.01.208) &gt;0">
								<xsl:value-of select="ZLE02.00.01.209" />～<xsl:value-of select="ZLE02.00.01.208" />
							</xsl:if>
							</td>
	                        <td class="aligncenter" style="font-size:10pt">
								<xsl:choose>
									<xsl:when test="EMR02.00.01.316 &lt; ZLE02.00.01.209">
										<span style="color:red">↓</span>
									</xsl:when> 
									<xsl:when test="EMR02.00.01.316 &gt; ZLE02.00.01.208">
									<span style="color:red">↑</span>
									</xsl:when>	
									<xsl:when test="string-length(ZLE02.00.01.209)&lt;1 or string-length(ZLE02.00.01.208) &lt;1">
									<span style="color:red"></span>
									</xsl:when>								
									<xsl:otherwise>
									―
									</xsl:otherwise>
								</xsl:choose>
							</td>
	                        <td></td>
	                    </tr>
						</xsl:for-each>
						<tr>
	                        <td colspan="6"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
	                    </tr>
						<xsl:if test="ZLG02.00.01.034/ZLG02.00.01.037/EMR02.00.01.315">
	                    <tr>
	                        <td colspan="6" class="opfcrosshead">
	                            定性描述：
	                        </td>
	                    </tr>
						<xsl:for-each select="ZLG02.00.01.034/ZLG02.00.01.037[string-length(EMR02.00.01.315) &gt; 0]">
	                    <tr>
	                        <td colspan="6" class="alignleft" style="text-indent:4em">
								<xsl:value-of select="EMR02.00.01.313" />：
								<xsl:value-of select="EMR02.00.01.315" />								
							</td>
	                    </tr>
						</xsl:for-each>
						</xsl:if>
						<tr>
	                        <td colspan="6" class="alignleft">
								<xsl:for-each select="ZLG02.00.01.035/ZLG02.00.01.039">
									<xsl:value-of select="position()" />、<xsl:value-of select="EMR02.00.01.294" />
								</xsl:for-each>
							</td>
	                    </tr>
						<tr>
							<td colspan="6"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
						</tr>
	                    <tr>
	                        <td colspan="2" class="alignleft">
								报告机构：<xsl:value-of select="ZLG02.00.01.035/EMR02.00.01.291" />
							</td>
	                        <td colspan="2" class="alignleft">
								检验日期：<xsl:value-of select="concat(translate(substring(ZLG02.00.01.035/EMR02.00.01.295,0,6),'-','年'),
																	translate(substring(ZLG02.00.01.035/EMR02.00.01.295,6,3),'-','月'),
																	translate(substring(ZLG02.00.01.035/EMR02.00.01.295,9,3),'T','日')
																	)" />
							</td>
	                        <td colspan="2" class="alignright">
								报告时间：<xsl:value-of select="translate(ZLG02.00.01.035/EMR02.00.01.296,'T',' ')" />                                
							</td>
	                    </tr>  
					</table>
				</td>
			</tr>
	        <tr>
	            <td colspan="2" class="level3linebottom"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
	        </tr>
		</xsl:for-each>
			<tr>
	            <td colspan="2" style="border-top:1px solid #000000"><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
	        </tr>
		</table>
		</xsl:if>
        <xsl:if test="not(EMR02.00.01/ZLG02.00.01.019) and not(EMR02.00.01/ZLG02.00.01.020)">
        <table cellpadding="3" cellspacing="0" class="opftable">
	        <tr>
	            <td>
	                无
	            </td>
	        </tr>
	    </table>
        </xsl:if>
		<table cellpadding="3" cellspacing="0" class="opftable">
			<tr>
				<td class="alignright" style="font-size:12pt; font-family:黑体; width:60%">诊断</td>		
				<td class="alignleft">：</td>		
			</tr>
            <xsl:for-each select="EMR02.00.01/ZLG02.00.01.014">
			<tr>
				<td class="alignright"></td>
				<td class="alignleft" >
					<table cellpadding="0" cellspacing="0" style="font-size:10.5pt">
						<tr>
							<td valign="top" class="alignright" style="text-indent:10pt">
								<xsl:value-of select="EMR02.00.01.323" />：
							</td>
							<td class="alignleft">
								<table cellpadding="0" cellspacing="0" style="font-size:10.5pt">
									<xsl:for-each select="ZLG02.00.01.031">
									<xsl:sort select="EMR02.00.01.325"/>
									<tr>
										<td>
										<xsl:value-of select="EMR02.00.01.325"/>.
										<xsl:value-of select="EMR02.00.01.326" />
										</td>
									</tr>
									</xsl:for-each>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
            </xsl:for-each>
			<tr>
				<td colspan="2" class="opfcrosshead">诊疗计划：</td>
			</tr>
			<xsl:for-each select="EMR02.00.01/ZLG02.00.01.015/ZLG02.00.01.025">
			<tr>
				<td colspan="2" class="alignleft"><xsl:value-of select="EMR02.00.01.331" /></td>
			</tr>
			</xsl:for-each>
			<tr>
				<td colspan="2" class="alignleft textindent">
					<xsl:for-each select="EMR02.00.01/ZLG02.00.01.015/ZLG02.00.01.026">
						<xsl:value-of select="EMR02.00.01.332" />
					</xsl:for-each>
				</td>
			</tr>
			<xsl:for-each select="EMR02.00.01/ZLG02.00.01.015/ZLG02.00.01.027">
			<tr>
				<td colspan="2" class="alignleft textindent">
				<xsl:value-of select="EMR02.00.01.333"/>
				</td>
			</tr>
			</xsl:for-each>
			<xsl:for-each select="EMR02.00.01/ZLG02.00.01.015/ZLG02.00.01.029">
			<tr>				
				<td colspan="2" class="alignleft textindent">
					<!--<xsl:value-of   select= "user:formatHtml(EMR02.00.01.343) "   disable-output-escaping= "yes "/> 			-->
					<xsl:value-of select="EMR02.00.01.343" disable-output-escaping="yes" />
				</td>						
			</tr>
			</xsl:for-each>
			<xsl:for-each select="EMR02.00.01/ZLG02.00.01.015/ZLG02.00.01.030">
			<tr>
				<td colspan="2" class="alignleft textindent"><xsl:value-of select="note" /></td>
			</tr>
			</xsl:for-each>
			<xsl:if test="EMR02.00.01/ZLG02.00.01.015/ZLG02.00.01.028/EMR02.00.01.341">
			<tr>
				<td colspan="2" class="alignleft textindent" >定期随访：<xsl:value-of select="EMR02.00.01/ZLG02.00.01.015/ZLG02.00.01.028/EMR02.00.01.342" />天</td>
			</tr>
			</xsl:if>
			<tr colspan="2" >
				<td><xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text></td>
			</tr>
			<tr colspan="2" >
				<td class="opfcrosshead">处置：</td>
			</tr>
			<xsl:if test="EMR02.00.01/ZLG02.00.01.016">
			<xsl:for-each select="EMR02.00.01/ZLG02.00.01.016">
			<tr>
				<td colspan="2"  class="alignleft textindent">
					<xsl:value-of select="EMR02.00.01.451" />
				</td>
			</tr>
			</xsl:for-each>
			</xsl:if>
			<xsl:if test="EMR02.00.01/ZLG02.00.01.017">
			<xsl:for-each select="EMR02.00.01/ZLG02.00.01.017">
			<tr>
				<td colspan="2"  class="alignleft textindent">
					<xsl:value-of select="EMR02.00.01.460" />
				</td>
			</tr>
			</xsl:for-each>
			</xsl:if>
		</table>
	</body>
	</html>
	</xsl:template>	
</xsl:stylesheet><!-- Stylus Studio meta-information - (c) 2004-2009. Progress Software Corporation. 保留所有权力.

<metaInformation>
	<scenarios>
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\..\XML\门诊病历.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
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
		<MapperInfo srcSchemaPathIsRelative="yes" srcSchemaInterpretAsXML="no" destSchemaPath="" destSchemaRoot="" destSchemaPathIsRelative="yes" destSchemaInterpretAsXML="no">
			<SourceSchema srcSchemaPath="门急诊病历01.xml" srcSchemaRoot="EMR02.00.01" AssociatedInstance="" loaderFunction="document" loaderFunctionUsesURI="no"/>
		</MapperInfo>
		<MapperBlockPosition>
			<template match="/">
				<block path="html/body/table[1]/tr/td[1]/xsl:value-of" x="351" y="82"/>
				<block path="html/body/table[1]/tr/td[1]/xsl:value-of/translate[0]" x="305" y="76"/>
				<block path="html/body/table[1]/tr/td[1]/xsl:value-of/translate[0]/substring[0]" x="259" y="70"/>
				<block path="html/body/table[1]/tr/td[1]/xsl:value-of/translate[1]" x="305" y="104"/>
				<block path="html/body/table[1]/tr/td[1]/xsl:value-of/translate[1]/substring[0]" x="259" y="98"/>
				<block path="html/body/table[1]/tr/td[1]/xsl:value-of/translate[2]" x="305" y="112"/>
				<block path="html/body/table[1]/tr/td[1]/xsl:value-of/translate[2]/substring[0]" x="259" y="106"/>
				<block path="html/body/table[2]/tr[1]/td/xsl:for-each" x="369" y="20"/>
				<block path="html/body/table[2]/tr[1]/td/xsl:for-each/xsl:if" x="399" y="50"/>
				<block path="html/body/table[2]/tr[1]/td/xsl:for-each/xsl:if/xsl:value-of" x="69" y="120"/>
				<block path="html/body/table[2]/tr[2]/td/xsl:for-each" x="369" y="20"/>
				<block path="html/body/table[2]/tr[2]/td/xsl:for-each/xsl:if" x="399" y="50"/>
				<block path="html/body/table[2]/tr[2]/td/xsl:for-each/xsl:if/xsl:value-of" x="29" y="120"/>
				<block path="html/body/table[2]/tr[3]/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/table[2]/tr[3]/td/xsl:value-of[1]" x="429" y="80"/>
				<block path="html/body/table[3]/tr/td[1]/xsl:choose" x="351" y="82"/>
				<block path="html/body/table[3]/tr/td[1]/xsl:choose/=[0]" x="305" y="80"/>
				<block path="html/body/table[3]/tr/td[2]/xsl:choose" x="321" y="52"/>
				<block path="html/body/table[3]/tr/td[2]/xsl:choose/=[0]" x="275" y="46"/>
				<block path="" x="351" y="82"/>
				<block path="html/body/table[4]/xsl:if" x="311" y="82"/>
				<block path="html/body/table[4]/xsl:if[1]" x="271" y="82"/>
				<block path="html/body/table[4]/xsl:if[1]/tr/td[1]/xsl:for-each" x="321" y="52"/>
				<block path="html/body/table[4]/xsl:if[1]/tr/td[1]/xsl:for-each/xsl:value-of" x="351" y="82"/>
				<block path="html/body/table[4]/xsl:if[1]/tr/td[1]/xsl:for-each/xsl:value-of[1]" x="351" y="82"/>
				<block path="html/body/table[4]/xsl:if[1]/tr/td[1]/xsl:for-each/xsl:value-of[2]" x="351" y="82"/>
				<block path="html/body/table[4]/xsl:choose" x="231" y="82"/>
				<block path="html/body/table[4]/xsl:choose/xsl:when/tr/td[1]/xsl:for-each" x="321" y="52"/>
				<block path="html/body/table[4]/xsl:choose/xsl:when/tr/td[1]/xsl:for-each/xsl:value-of" x="351" y="82"/>
				<block path="html/body/table[4]/xsl:choose/xsl:when/tr/td[1]/xsl:for-each/xsl:value-of[1]" x="351" y="82"/>
				<block path="html/body/table[4]/xsl:choose/xsl:when[1]/tr/td[1]/xsl:for-each" x="351" y="82"/>
				<block path="html/body/table[4]/xsl:choose/xsl:when[1]/tr/td[1]/xsl:for-each/xsl:value-of" x="429" y="80"/>
				<block path="html/body/table[4]/xsl:choose/xsl:when[1]/tr/td[1]/xsl:for-each/xsl:value-of[1]" x="429" y="80"/>
				<block path="html/body/table[4]/xsl:if[2]" x="191" y="82"/>
				<block path="html/body/table[4]/xsl:if[2]/tr/td[1]/xsl:value-of" x="429" y="80"/>
				<block path="html/body/table[5]/xsl:if" x="151" y="82"/>
				<block path="html/body/table[5]/xsl:if[1]" x="111" y="82"/>
				<block path="html/body/table[5]/xsl:if[1]/tr/td/xsl:for-each" x="321" y="52"/>
				<block path="html/body/table[5]/xsl:if[1]/tr/td/xsl:for-each/xsl:value-of" x="351" y="82"/>
				<block path="html/body/table[5]/xsl:if[1]/tr/td/xsl:for-each/xsl:value-of[1]" x="351" y="82"/>
				<block path="html/body/table[5]/xsl:if[1]/tr/td/xsl:for-each/xsl:value-of[2]" x="351" y="82"/>
				<block path="html/body/table[5]/xsl:if[1]/tr/td/xsl:for-each/xsl:value-of[3]" x="351" y="82"/>
				<block path="html/body/table[5]/xsl:if[2]" x="71" y="82"/>
				<block path="html/body/table[5]/xsl:if[2]/tr/td/xsl:for-each" x="291" y="22"/>
				<block path="html/body/table[5]/xsl:if[2]/tr/td/xsl:for-each/xsl:for-each" x="321" y="52"/>
				<block path="html/body/table[5]/xsl:if[2]/tr/td/xsl:for-each/xsl:for-each/xsl:value-of" x="351" y="82"/>
				<block path="html/body/table[5]/xsl:if[2]/tr/td/xsl:for-each/xsl:for-each/xsl:value-of[1]" x="351" y="82"/>
				<block path="html/body/xsl:if" x="351" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each" x="31" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[1]/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[1]/td[1]/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[1]/td[2]/xsl:value-of" x="351" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[3]/td/xsl:for-each" x="351" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[3]/td/xsl:for-each/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[4]/td/xsl:for-each" x="351" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[4]/td/xsl:for-each/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[6]/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[6]/td[1]/xsl:value-of" x="351" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[6]/td[2]/xsl:value-of" x="351" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[6]/td[2]/xsl:value-of/translate[0]" x="305" y="76"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[6]/td[2]/xsl:value-of/translate[0]/substring[0]" x="259" y="70"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[6]/td[2]/xsl:value-of/translate[1]" x="305" y="104"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[6]/td[2]/xsl:value-of/translate[1]/substring[0]" x="259" y="98"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[6]/td[2]/xsl:value-of/translate[2]" x="305" y="112"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[6]/td[2]/xsl:value-of/translate[2]/substring[0]" x="259" y="106"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if" x="351" y="42"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if/tr/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if/tr/td/xsl:value-of[1]" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[1]/=[0]" x="345" y="40"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[1]" x="391" y="42"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[1]/tr/td[1]/xsl:for-each" x="321" y="52"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[1]/tr/td[1]/xsl:for-each/xsl:for-each" x="351" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[1]/tr/td[1]/xsl:for-each/xsl:for-each/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]" x="241" y="12"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if/!=[0]" x="265" y="40"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if" x="311" y="42"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if/xsl:if" x="191" y="42"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if/xsl:if/tr/td/xsl:for-each" x="351" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if/xsl:if/tr/td/xsl:for-each/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if/xsl:if[1]" x="151" y="42"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if/xsl:if[1]/tr/td/xsl:for-each" x="351" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if/xsl:if[1]/tr/td/xsl:for-each/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if/xsl:if[2]" x="111" y="42"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if/xsl:if[2]/tr/td/xsl:for-each" x="351" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if/xsl:if[2]/tr/td/xsl:for-each/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if[1]/=[0]" x="275" y="130"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if[1]" x="321" y="132"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:for-each" x="71" y="42"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:for-each/tr/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:for-each/tr/td/xsl:for-each" x="351" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each/xsl:if[2]/xsl:if[1]/xsl:for-each/tr/td/xsl:for-each/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[8]/td/xsl:value-of" x="351" y="82"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[8]/td/xsl:value-of/translate[0]" x="305" y="76"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[8]/td/xsl:value-of/translate[0]/substring[0]" x="259" y="70"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[8]/td/xsl:value-of/translate[1]" x="305" y="104"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[8]/td/xsl:value-of/translate[1]/substring[0]" x="259" y="98"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[8]/td/xsl:value-of/translate[2]" x="305" y="112"/>
				<block path="html/body/xsl:if/table/xsl:for-each/tr[8]/td/xsl:value-of/translate[2]/substring[0]" x="259" y="106"/>
				<block path="html/body/xsl:if[1]" x="391" y="82"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each" x="31" y="42"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[1]/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[1]/td[1]/xsl:value-of" x="351" y="82"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[1]/td[1]/xsl:value-of/translate[0]" x="305" y="76"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[1]/td[1]/xsl:value-of/translate[0]/substring[0]" x="259" y="70"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[1]/td[1]/xsl:value-of/translate[1]" x="305" y="104"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[1]/td[1]/xsl:value-of/translate[1]/substring[0]" x="259" y="98"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[1]/td[1]/xsl:value-of/translate[2]" x="305" y="112"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[1]/td[1]/xsl:value-of/translate[2]/substring[0]" x="259" y="106"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[2]/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/xsl:if" x="391" y="122"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/xsl:if/tr/td/xsl:for-each" x="351" y="82"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/xsl:if/tr/td/xsl:for-each/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each" x="351" y="82"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each/tr/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each/tr/td[1]/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each/tr/td[2]/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each/tr[1]/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each/tr[1]/td[1]/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each/tr[1]/td[2]/xsl:value-of" x="351" y="82"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]" x="351" y="82"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td[1]/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td[2]/xsl:choose" x="399" y="50"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td[2]/xsl:choose/&gt;=[0]" x="353" y="44"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td[2]/xsl:choose/&gt;=[0]/number[0]" x="307" y="38"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td[2]/xsl:choose/&gt;=[0]/number[0]/substring[0]" x="261" y="36"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td[2]/xsl:choose/xsl:when/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td[2]/xsl:choose/xsl:otherwise/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td[3]/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td[3]/xsl:value-of[1]" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td[4]/xsl:choose" x="321" y="52"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td[4]/xsl:choose/&lt;[0]" x="275" y="46"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:for-each[1]/tr/td[4]/xsl:choose/&gt;[1]" x="275" y="74"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:if" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:if/xsl:for-each" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:if/xsl:for-each/tr/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/xsl:if/xsl:for-each/tr/td/xsl:value-of[1]" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/tr[3]/td/xsl:for-each" x="399" y="50"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/tr[3]/td/xsl:for-each/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/tr[3]/td/xsl:for-each/xsl:value-of[1]" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/tr[5]/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/tr[5]/td[1]/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/tr[5]/td[1]/xsl:value-of/translate[0]" x="383" y="74"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/tr[5]/td[1]/xsl:value-of/translate[0]/substring[0]" x="337" y="68"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/tr[5]/td[1]/xsl:value-of/translate[1]" x="383" y="102"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/tr[5]/td[1]/xsl:value-of/translate[1]/substring[0]" x="337" y="96"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/tr[5]/td[1]/xsl:value-of/translate[2]" x="383" y="110"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/tr[5]/td[1]/xsl:value-of/translate[2]/substring[0]" x="337" y="104"/>
				<block path="html/body/xsl:if[1]/table/xsl:for-each/tr[3]/td/table/tr[5]/td[2]/xsl:value-of" x="429" y="80"/>
				<block path="html/body/xsl:if[2]/and[0]" x="343" y="78"/>
				<block path="html/body/xsl:if[2]" x="389" y="80"/>
				<block path="html/body/table[7]/xsl:for-each" x="271" y="122"/>
				<block path="html/body/table[7]/xsl:for-each/tr/td[1]/table/tr/td[1]/table/xsl:for-each" x="429" y="80"/>
				<block path="html/body/table[7]/xsl:for-each[1]" x="231" y="122"/>
				<block path="html/body/table[7]/tr[2]/td/xsl:for-each" x="429" y="80"/>
				<block path="html/body/table[7]/xsl:for-each[2]" x="191" y="122"/>
				<block path="html/body/table[7]/xsl:for-each[3]" x="151" y="122"/>
				<block path="html/body/table[7]/xsl:for-each[4]" x="349" y="120"/>
				<block path="html/body/table[7]/xsl:for-each[4]/tr/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/table[7]/xsl:if" x="111" y="122"/>
				<block path="html/body/table[7]/xsl:if[1]" x="321" y="52"/>
				<block path="html/body/table[7]/xsl:if[1]/xsl:for-each" x="71" y="122"/>
				<block path="html/body/table[7]/xsl:if[1]/xsl:for-each/tr/td/xsl:value-of" x="429" y="80"/>
				<block path="html/body/table[7]/xsl:if[2]" x="321" y="52"/>
				<block path="html/body/table[7]/xsl:if[2]/xsl:for-each" x="31" y="122"/>
			</template>
		</MapperBlockPosition>
		<TemplateContext></TemplateContext>
		<MapperFilter side="source"></MapperFilter>
	</MapperMetaTag>
</metaInformation>
-->