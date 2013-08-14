<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="UTF-8"/>
	<xsl:template match="/">
		<html xmlns="http://www.w3.org/1999/xhtml" charset="UTF-8">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
			<head>
				<title>临时医嘱</title>
				<link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/temporaryorder.css"/>
				<link rel="Stylesheet" type="text/css" href="/doc/cdc_xml/styles/common.css"/>
			</head>
			<body>
				<div id="temporaryorder">
					<table cellpadding="3" cellspacing="0" class="totable">
						<tr>
							<td class="totitle">
								<xsl:value-of select="EMR11.00.02/ZLG11.00.02.001/EMR11.00.02.001"/>
							</td>
						</tr>
					</table>
					<xsl:for-each select="EMR11.00.02/ZLG11.00.02.006">
						<xsl:sort select="EMR11.00.02.041"/>
						<xsl:sort select="ZLE11.00.02.006"/>
						<!--当前医嘱序号-->
						<xsl:variable name="currOrderNum">
							<xsl:value-of select="ZLE11.00.02.006"/>
						</xsl:variable>
						<!--当前医嘱机构名称和开单科室名称-->
						<xsl:variable name="currOrgDeptName">
							<xsl:for-each select="../ZLG11.00.02.004[ZLE11.00.02.002 = $currOrderNum]">
								<xsl:for-each select="ZLG11.00.02.008[EMR11.00.02.027 = '05']">
									<xsl:if test="position() = 1">
										<xsl:value-of select="concat(EMR11.00.02.021,'|',EMR11.00.02.025)"/>
									</xsl:if>
								</xsl:for-each>
							</xsl:for-each>
						</xsl:variable>
						<!--当前医嘱机构代码和开单科室代码-->
						<xsl:variable name="currOrgDeptCode">
							<xsl:for-each select="../ZLG11.00.02.004[ZLE11.00.02.002 = $currOrderNum]">
								<xsl:for-each select="ZLG11.00.02.008[EMR11.00.02.027 = '05']">
									<xsl:if test="position() = 1">
										<xsl:value-of select="concat(EMR11.00.02.022,'|',ZLE11.00.02.003)"/>
									</xsl:if>
								</xsl:for-each>
							</xsl:for-each>
						</xsl:variable>
						<!--开嘱医师-->
						<xsl:variable name="startDoctor">
							<xsl:for-each select="../ZLG11.00.02.005[ZLE11.00.02.004 = $currOrderNum]">
								<xsl:if test="position() = 1">
									<xsl:for-each select="ZLG11.00.02.009[EMR11.00.02.033 = '61']">
										<xsl:if test="position() = 1">
											<xsl:value-of select="EMR11.00.02.031"/>
										</xsl:if>
									</xsl:for-each>
								</xsl:if>
							</xsl:for-each>
						</xsl:variable>
						<!--开医嘱校对护士-->
						<xsl:variable name="startNurse">
							<xsl:for-each select="../ZLG11.00.02.005[ZLE11.00.02.004 = $currOrderNum]">
								<xsl:if test="position() = 1">
									<xsl:for-each select="ZLG11.00.02.009[EMR11.00.02.033 = '64']">
										<xsl:if test="position() = 1">
											<xsl:value-of select="EMR11.00.02.031"/>
										</xsl:if>
									</xsl:for-each>
								</xsl:if>
							</xsl:for-each>
						</xsl:variable>
						<xsl:if test="position() = 1">
							<table cellpadding="1" cellspacing="0" class="totable">
								<tr>
									<td colspan="3">
										<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
									</td>
								</tr>
								<tr>
									<td class="alignleft" colspan="2">
										<span class="fontbold">住院机构：</span>
										<xsl:value-of select="substring-before($currOrgDeptName,'|')"/>
									</td>
									<td class="alignleft">
										<span class="fontbold">住院日期：</span>
										<xsl:for-each select="../ZLG11.00.02.002/ZLG11.00.02.007[EMR11.00.02.011='住院病案']">
											<xsl:if test="position() = 1">
												<xsl:value-of select="concat(substring(string(EMR11.00.02.013),1,4),'年',substring(string(EMR11.00.02.013),6,2),'月',substring(string(EMR11.00.02.013),9,2),'日')                                                   "/>
											</xsl:if>
										</xsl:for-each>
									</td>
									<td class="alignleft">
										<span class="fontbold">住院科别：</span>
										<xsl:value-of select="substring-after($currOrgDeptName,'|')"/>
									</td>
								</tr>
								<tr>
									<td class="alignleft">
										<span class="fontbold">姓名：</span>
										<xsl:value-of select="../ZLG11.00.02.002/EMR11.00.02.018"/>
									</td>
									<td class="alignleft">
										<span class="fontbold">性别：</span>
										<xsl:value-of select="../ZLG11.00.02.003/ZLE11.00.02.014"/>
									</td>
									<td class="alignleft">
										<span class="fontbold">年龄：</span>
										<xsl:value-of select="../ZLG11.00.02.003/ZLE11.00.02.013"/>
									</td>
									<td class="alignleft">
										<span class="fontbold">住院号：</span>
										<xsl:for-each select="../ZLG11.00.02.002/ZLG11.00.02.007[EMR11.00.02.011 = '住院病案']">
											<xsl:if test="position() = 1">
												<xsl:value-of select="EMR11.00.02.012"/>
											</xsl:if>
										</xsl:for-each>
									</td>
								</tr>
							</table>
							<table cellpadding="1" cellspacing="0" class="totable tableborders">
								<tr>
									<td class="aligncenter" style="width:8%">开始<br/>日期</td>
									<td class="aligncenter" style="width:8%">开始<br/>时间</td>
									<td class="aligncenter">医嘱</td>
									<td class="aligncenter" style="width:8%">医师<br/>签名</td>
									<td class="aligncenter" style="width:8%">执行<br/>时间</td>
									<td class="aligncenter" style="width:8%">护士<br/>签名</td>
								</tr>
								<!--同一医嘱序号有多条医嘱记录-->
								<xsl:if test="count(ZLG11.00.02.012) &gt; 1">
									<xsl:for-each select="ZLG11.00.02.012">
									<xsl:sort select="ZLE11.00.02.009"/>
										<xsl:if test="position() = 1 ">
											<tr>
												<td class="aligncenter">
													<xsl:value-of select="substring(string(../EMR11.00.02.041),6,5)"/>
												</td>
												<td class="aligncenter">
													<xsl:value-of select="substring(string(../EMR11.00.02.041),12,5)"/>
												</td>
												<td class="alignleft">
													<table cellpadding="1" cellspacing="0" style="border:0;width:100%;font-size:10.5pt;line-height:18px">
														<tr style="border:0">
															<td class="alignleft" style="border:0;width:70%">
																<xsl:value-of select="EMR11.00.02.047"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
																<xsl:if test="ZLE11.00.02.011!=0">
																	<xsl:value-of select="ZLE11.00.02.011"/>
																	<xsl:value-of select="ZLE11.00.02.012"/>
																</xsl:if>
															</td>
															<td class="alignleft" style="border:0;width:3%">┓</td>
															<td class="alignleft" style="border:0;width:27%">
															<xsl:if test="string-length(../ZLE11.00.02.007)&gt; 0">
																<xsl:value-of select="../ZLE11.00.02.007"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
															</xsl:if>
															<xsl:value-of select="../ZLE11.00.02.008"/></td>
														</tr>
													</table>
												</td>
												<td class="aligncenter">
													<xsl:value-of select="$startDoctor"/>
												</td>
												<td class="aligncenter">
													<xsl:value-of select="substring(string(../EMR11.00.02.043),12,5)"/>
												</td>
												<td class="aligncenter">
													<xsl:value-of select="$startNurse"/>
												</td>
											</tr>
										</xsl:if>
										<xsl:if test="position() &lt; last() and position() &gt; 1">
											<tr>
												<td class="alignleft">
												</td>
												<td class="alignleft">
												</td>
												<td class="alignleft">
													<table cellpadding="1" cellspacing="0" style="border:0; width:100%; font-size:10.5pt;line-height:18px">
														<tr style="border:0">
															<td style="border:0;width:70%" class="alignleft">
																<xsl:value-of select="EMR11.00.02.047"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
																<xsl:if test="ZLE11.00.02.011!=0">
																	<xsl:value-of select="ZLE11.00.02.011"/>
																	<xsl:value-of select="ZLE11.00.02.012"/>
																</xsl:if>
															</td>
															<td class="alignleft" style="border:0;width:3%">┃</td>
															<td class="alignleft" style="border:0;width:27%"></td>
														</tr>
													</table>
												</td>
												<td class="alignleft"></td>
												<td class="alignleft"></td>
												<td class="alignleft"></td>
											</tr>
										</xsl:if>
										<xsl:if test="position() = last()">
											<tr>
												<td class="alignleft">
												</td>
												<td class="alignleft">
												</td>
												<td class="alignleft">
													<table cellpadding="1" cellspacing="0" style="width:100%;border:0;font-size:10.5pt;line-height:18px">
														<td class="alignleft" style="border:0; width:70%">
															<xsl:value-of select="EMR11.00.02.047"/>
															<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
															<xsl:if test="ZLE11.00.02.011!=0">
																<xsl:value-of select="ZLE11.00.02.011"/>
																<xsl:value-of select="ZLE11.00.02.012"/>
															</xsl:if>
														</td>
														<td class="alignleft" style="border:0;width:3%">┛</td>
														<td class="alignleft" style="border:0;width:27%"></td>
													</table>
												</td>
												<td class="alignleft"></td>
												<td class="alignleft"></td>
												<td class="alignleft"></td>
											</tr>
										</xsl:if>
									</xsl:for-each>
								</xsl:if>
								<!--同一医嘱序号只有一条医嘱记录-->
								<xsl:if test="count(ZLG11.00.02.012) = 1">
									<tr>
										<td class="aligncenter" style="width:8%">
											<xsl:value-of select="substring(string(EMR11.00.02.041),6,5)"/>
										</td>
										<td class="aligncenter">
											<xsl:value-of select="substring(string(EMR11.00.02.041),12,5)"/>
										</td>
										<td class="alignleft">
													<table cellpadding="1" cellspacing="0" style="border:0;width:100%;font-size:10.5pt;line-height:18px">
														<tr style="border:0">
															<td class="alignleft" style="border:0;width:70%">
																<xsl:value-of select="ZLG11.00.02.012/EMR11.00.02.047"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
																<xsl:if test="ZLG11.00.02.012/ZLE11.00.02.011!=0">
																	<xsl:value-of select="ZLG11.00.02.012/ZLE11.00.02.011"/>
																	<xsl:value-of select="ZLG11.00.02.012/ZLE11.00.02.012"/>
																</xsl:if>
															</td>
															<td class="alignleft" style="border:0;width:3%"></td>
															<td class="alignleft" style="border:0;width:27%">
															<xsl:if test="string-length(ZLE11.00.02.007)&gt; 0">
																<xsl:value-of select="ZLE11.00.02.007"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
															</xsl:if>
															<xsl:value-of select="ZLE11.00.02.008"/></td>
														</tr>
													</table>
												</td>
										<td class="aligncenter">
											<xsl:value-of select="$startDoctor"/>
										</td>
										<td class="aligncenter">
											<xsl:value-of select="substring(string(EMR11.00.02.043),12,5)"/>
										</td>
										<td class="aligncenter">
											<xsl:value-of select="$startNurse"/>
										</td>
									</tr>
								</xsl:if>
							</table>
						</xsl:if>
						<xsl:variable name="currPos" select="position()"/>
						<xsl:if test="position() &gt; 1 ">
							<!--上一条医嘱序号-->
							<xsl:variable name="preOrderNum">
								<xsl:for-each select="../ZLG11.00.02.006">
									<xsl:sort select="EMR11.00.02.041"/>
									<xsl:sort select="ZLE11.00.02.006"/>
									<xsl:if test="position() = $currPos - 1">
										<xsl:value-of select="ZLE11.00.02.006"/>
									</xsl:if>
								</xsl:for-each>
							</xsl:variable>
							<!--上一条医嘱机构代码和开单科室代码-->
							<xsl:variable name="preOrgDeptCode">
								<xsl:for-each select="../ZLG11.00.02.004[ZLE11.00.02.002 = $preOrderNum] ">
									<xsl:for-each select="ZLG11.00.02.008[EMR11.00.02.027 = '05']">
										<xsl:if test="position() = 1">
											<xsl:value-of select="concat(EMR11.00.02.022,'|',ZLE11.00.02.003)"/>
										</xsl:if>
									</xsl:for-each>
								</xsl:for-each>
							</xsl:variable>
							<!--当前开单科室与上一次开单科室相同-->
							<xsl:if test="$currOrgDeptCode = $preOrgDeptCode">
								<!--成组医嘱-->
								<xsl:if test="count(ZLG11.00.02.012) &gt; 1">
									<table cellpadding="1" cellspacing="0" class="totable tobtable">
										<xsl:for-each select="ZLG11.00.02.012">
										<xsl:sort select="ZLE11.00.02.009"/>
											<xsl:if test="position() = 1">
												<tr>
													<td class="aligncenter" style="width:8%">
														<xsl:value-of select="substring(string(../EMR11.00.02.041),6,5)"/>
													</td>
													<td class="aligncenter" style="width:8%">
														<xsl:value-of select="substring(string(../EMR11.00.02.041),12,5)"/>
													</td>
													<td class="alignleft">
													<table cellpadding="1" cellspacing="0" style="border:0;width:100%;font-size:10.5pt;line-height:18px">
														<tr style="border:0">
															<td class="alignleft" style="border:0;width:70%">
																<xsl:value-of select="EMR11.00.02.047"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
																<xsl:if test="ZLE11.00.02.011!=0">
																	<xsl:value-of select="ZLE11.00.02.011"/>
																	<xsl:value-of select="ZLE11.00.02.012"/>
																</xsl:if>
															</td>
															<td class="alignleft" style="border:0;width:3%">┓</td>
															<td class="alignleft" style="border:0;width:27%">
															<xsl:if test="string-length(../ZLE11.00.02.007)&gt; 0">
																<xsl:value-of select="../ZLE11.00.02.007"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
															</xsl:if>
															<xsl:value-of select="../ZLE11.00.02.008"/></td>
														</tr>
													</table>
												</td>
													<td class="aligncenter" style="width:8%">
														<xsl:value-of select="$startDoctor"/>
													</td>
													<td class="aligncenter" style="width:8%">
														<xsl:value-of select="substring(string(../EMR11.00.02.043),12,5)"/>
													</td>
													<td class="aligncenter" style="width:8%">
														<xsl:value-of select="$startNurse"/>
													</td>
												</tr>
											</xsl:if>
											<xsl:if test="position() &gt; 1 and position() &lt; last()">
												<tr>
													<td class="alignleft" style="width:8%">
													</td>
													<td class="alignleft" style="width:8%">
													</td>
													<td class="alignleft">
														<table cellpadding="1" cellspacing="0" style="width:100%;border:0;font-size:10.5pt;line-height:18px">
															<tr style="border:0">
																<td class="alignleft" style="border:0;width:70%">
																	<xsl:value-of select="EMR11.00.02.047"/>
																	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
																	<xsl:if test="ZLE11.00.02.011!=0">
																		<xsl:value-of select="ZLE11.00.02.011"/>
																		<xsl:value-of select="ZLE11.00.02.012"/>
																	</xsl:if>
																</td>
																<td class="alignleft" style="border:0;width:3%">┃</td>
																<td class="alignleft" style="border:0;width:27%"></td>
															</tr>
														</table>
													</td>
													<td class="alignleft" style="width:8%">
													</td>
													<td class="alignleft" style="width:8%">
													</td>
													<td class="alignleft" style="width:8%">
													</td>
												</tr>
											</xsl:if>
											<xsl:if test="position() = last()">
												<tr>
													<td class="alignleft">
													</td>
													<td class="alignleft">
													</td>
													<td class="alignleft">
														<table cellpadding="1" cellspacing="0" style="width:100%;border:0;font-size:10.5pt;line-height:18px">
															<tr style="border:0">
																<td class="alignleft" style="border:0;width:70%">
																	<xsl:value-of select="EMR11.00.02.047"/>
																	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
																	<xsl:if test="ZLE11.00.02.011!=0">
																		<xsl:value-of select="ZLE11.00.02.011"/>
																		<xsl:value-of select="ZLE11.00.02.012"/>
																	</xsl:if>
																</td>
																<td class="alignleft" style="border:0;width:3%">┛</td>
																<td class="alignleft" style="border:0;width:27%"></td>
															</tr>
														</table>
													</td>
													<td class="alignleft"></td>
													<td class="alignleft"></td>
													<td class="alignleft"></td>
												</tr>
											</xsl:if>
										</xsl:for-each>
									</table>
								</xsl:if>
								<xsl:if test="count(ZLG11.00.02.012) = 1">
									<table cellpadding="1" cellspacing="0" class="totable tobtable">
										<tr>
											<td class="aligncenter" style="width:8%">
												<xsl:value-of select="substring(string(EMR11.00.02.041),6,5)"/>
											</td>
											<td class="aligncenter" style="width:8%">
												<xsl:value-of select="substring(string(EMR11.00.02.041),12,5)"/>
											</td>
											<td class="alignleft">
													<table cellpadding="1" cellspacing="0" style="border:0;width:100%;font-size:10.5pt;line-height:18px">
														<tr style="border:0">
															<td class="alignleft" style="border:0;width:70%">
																<xsl:value-of select="ZLG11.00.02.012/EMR11.00.02.047"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
																<xsl:if test="ZLG11.00.02.012/ZLE11.00.02.011!=0">
																	<xsl:value-of select="ZLG11.00.02.012/ZLE11.00.02.011"/>
																	<xsl:value-of select="ZLG11.00.02.012/ZLE11.00.02.012"/>
																</xsl:if>
															</td>
															<td class="alignleft" style="border:0;width:3%"></td>
															<td class="alignleft" style="border:0;width:27%">
															<xsl:if test="string-length(ZLE11.00.02.007)&gt; 0">
																<xsl:value-of select="ZLE11.00.02.007"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
															</xsl:if>
															<xsl:value-of select="ZLE11.00.02.008"/></td>
														</tr>
													</table>
												</td>
											<td class="aligncenter" style="width:8%">
												<xsl:value-of select="$startDoctor"/>
											</td>
											<td class="aligncenter" style="width:8%">
												<xsl:value-of select="substring(string(EMR11.00.02.043),12,5)"/>
											</td>
											<td class="aligncenter" style="width:8%">
												<xsl:value-of select="$startNurse"/>
											</td>
										</tr>
									</table>
								</xsl:if>
							</xsl:if>
							<xsl:if test="$currOrgDeptCode != $preOrgDeptCode">
								<table cellpadding="1" cellspacing="0" class="totable">
									<tr>
										<td colspan="9">
											<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
										</td>
									</tr>
									<tr>
										<td class="alignleft" colspan="2">
											<span class="fontbold">住院机构：</span>
											<xsl:value-of select="substring-before($currOrgDeptName,'|')"/>
										</td>
										<td class="alignleft">
											<span class="fontbold">住院日期：</span>
											<xsl:for-each select="../ZLG11.00.02.002/ZLG11.00.02.007[EMR11.00.02.011='住院病案']">
												<xsl:if test="position() = 1">
													<xsl:value-of select="concat(substring(string(EMR11.00.02.013),1,4),'年',substring(string(EMR11.00.02.013),6,2),'月',substring(string(EMR11.00.02.013),9,2),'日')                                                   "/>
												</xsl:if>
											</xsl:for-each>
										</td>
										<td class="alignleft">
											<span class="fontbold">住院科别：</span>
											<xsl:value-of select="substring-after($currOrgDeptName,'|')"/>
										</td>
									</tr>
									<tr>
										<td class="alignleft">
											<span class="fontbold">姓名：</span>
											<xsl:value-of select="../ZLG11.00.02.002/EMR11.00.02.018"/>
										</td>
										<td class="alignleft">
											<span class="fontbold">性别：</span>
											<xsl:value-of select="../ZLG11.00.02.003/ZLE11.00.02.014"/>
										</td>
										<td class="alignleft">
											<span class="fontbold">年龄：</span>
											<xsl:value-of select="../ZLG11.00.02.003/ZLE11.00.02.013"/>
										</td>
										<td class="alignleft">
											<span class="fontbold">住院号：</span>
											<xsl:for-each select="../ZLG11.00.02.002/ZLG11.00.02.007[EMR11.00.02.011 = '住院病案']">
												<xsl:if test="position() = 1">
													<xsl:value-of select="EMR11.00.02.012"/>
												</xsl:if>
											</xsl:for-each>
										</td>
									</tr>
								</table>
								<table cellpadding="1" cellspacing="0" class="totable tableborders">
									<tr>
										<td class="aligncenter" style="width:8%">开始<br/>日期</td>
										<td class="aligncenter" style="width:8%">开始<br/>时间</td>
										<td class="aligncenter">医嘱</td>
										<td class="aligncenter" style="width:8%">医师<br/>签名</td>
										<td class="aligncenter" style="width:8%">执行<br/>时间</td>
										<td class="aligncenter" style="width:8%">护士<br/>签名</td>
									</tr>
									<!--同一医嘱序号有多条医嘱记录-->
									<xsl:if test="count(ZLG11.00.02.012) &gt; 1">
										<xsl:for-each select="ZLG11.00.02.012">
										<xsl:sort select="ZLE11.00.02.009"/>
											<xsl:if test="position() = 1 ">
												<tr>
													<td class="aligncenter">
														<xsl:value-of select="substring(string(../EMR11.00.02.041),6,5)"/>
													</td>
													<td class="aligncenter">
														<xsl:value-of select="substring(string(../EMR11.00.02.041),12,5)"/>
													</td>
													<td class="alignleft">
													<table cellpadding="1" cellspacing="0" style="border:0;width:100%;font-size:10.5pt;line-height:18px">
														<tr style="border:0">
															<td class="alignleft" style="border:0;width:70%">
																<xsl:value-of select="EMR11.00.02.047"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
																<xsl:if test="ZLE11.00.02.011!=0">
																	<xsl:value-of select="ZLE11.00.02.011"/>
																	<xsl:value-of select="ZLE11.00.02.012"/>
																</xsl:if>
															</td>
															<td class="alignleft" style="border:0;width:3%">┓</td>
															<td class="alignleft" style="border:0;width:27%">
															<xsl:if test="string-length(../ZLE11.00.02.007)&gt; 0">
																<xsl:value-of select="../ZLE11.00.02.007"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
															</xsl:if>
															<xsl:value-of select="../ZLE11.00.02.008"/></td>
														</tr>
													</table>
												</td>
													<td class="aligncenter">
														<xsl:value-of select="$startDoctor"/>
													</td>
													<td class="aligncenter">
														<xsl:value-of select="substring(string(../EMR11.00.02.043),12,5)"/>
													</td>
													<td class="aligncenter">
														<xsl:value-of select="$startNurse"/>
													</td>
												</tr>
											</xsl:if>
											<xsl:if test="position() &lt; last() and position() &gt; 1">
												<tr>
													<td class="alignleft">
													</td>
													<td class="alignleft">
													</td>
													<td class="alignleft">
														<table cellpadding="1" cellspacing="0" style="border:0; width:100%; font-size:10.5pt;line-height:18px">
															<tr style="border:0">
																<td style="border:0;width:70%" class="alignleft">
																	<xsl:value-of select="EMR11.00.02.047"/>
																	<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
																	<xsl:if test="ZLE11.00.02.011!=0">
																		<xsl:value-of select="ZLE11.00.02.011"/>
																		<xsl:value-of select="ZLE11.00.02.012"/>
																	</xsl:if>
																</td>
																<td class="alignleft" style="border:0;width:3%">┃</td>
																<td class="alignleft" style="border:0;width:27%"></td>
															</tr>
														</table>
													</td>
													<td class="alignleft"></td>
													<td class="alignleft"></td>
													<td class="alignleft"></td>
												</tr>
											</xsl:if>
											<xsl:if test="position() = last()">
												<tr>
													<td class="alignleft">
													</td>
													<td class="alignleft">
													</td>
													<td class="alignleft">
														<table cellpadding="1" cellspacing="0" style="width:100%;border:0;font-size:10.5pt;line-height:18px">
															<td class="alignleft" style="border:0; width:70%">
																<xsl:value-of select="EMR11.00.02.047"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
																<xsl:if test="ZLE11.00.02.011!=0">
																	<xsl:value-of select="ZLE11.00.02.011"/>
																	<xsl:value-of select="ZLE11.00.02.012"/>
																</xsl:if>
															</td>
															<td class="alignleft" style="border:0;width:3%">┛</td>
															<td class="alignleft" style="border:0;width:27%"></td>
														</table>
													</td>
													<td class="alignleft"></td>
													<td class="alignleft"></td>
													<td class="alignleft"></td>
												</tr>
											</xsl:if>
										</xsl:for-each>
									</xsl:if>
									<!--同一医嘱序号只有一条医嘱记录-->
									<xsl:if test="count(ZLG11.00.02.012) = 1">
										<tr>
											<td class="aligncenter" style="width:8%">
												<xsl:value-of select="substring(string(EMR11.00.02.041),6,5)"/>
											</td>
											<td class="aligncenter">
												<xsl:value-of select="substring(string(EMR11.00.02.041),12,5)"/>
											</td>
											<td class="alignleft">
													<table cellpadding="1" cellspacing="0" style="border:0;width:100%;font-size:10.5pt;line-height:18px">
														<tr style="border:0">
															<td class="alignleft" style="border:0;width:70%">
																<xsl:value-of select="ZLG11.00.02.012/EMR11.00.02.047"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
																<xsl:if test="ZLG11.00.02.012/ZLE11.00.02.011!=0">
																	<xsl:value-of select="ZLG11.00.02.012/ZLE11.00.02.011"/>
																	<xsl:value-of select="ZLG11.00.02.012/ZLE11.00.02.012"/>
																</xsl:if>
															</td>
															<td class="alignleft" style="border:0;width:3%"></td>
															<td class="alignleft" style="border:0;width:27%">
															<xsl:if test="string-length(ZLE11.00.02.007)&gt; 0">
																<xsl:value-of select="ZLE11.00.02.007"/>
																<xsl:text disable-output-escaping="yes">&amp;#160;</xsl:text>
															</xsl:if>
															<xsl:value-of select="ZLE11.00.02.008"/></td>
														</tr>
													</table>
												</td>
											<td class="aligncenter">
												<xsl:value-of select="$startDoctor"/>
											</td>
											<td class="aligncenter">
												<xsl:value-of select="substring(string(EMR11.00.02.043),12,5)"/>
											</td>
											<td class="aligncenter">
												<xsl:value-of select="$startNurse"/>
											</td>
										</tr>
									</xsl:if>
								</table>
							</xsl:if>
						</xsl:if>
					</xsl:for-each>
				</div>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet><!-- Stylus Studio meta-information - (c) 2004-2009. Progress Software Corporation. 保留所有权力.

<metaInformation>
	<scenarios>
		<scenario default="yes" name="场景1" userelativepaths="yes" externalpreview="no" url="..\..\xml\临时医嘱12.xml" htmlbaseurl="" outputurl="" processortype="saxon8" useresolver="yes" profilemode="0" profiledepth="" profilelength="" urlprofilexml=""
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
			<SourceSchema srcSchemaPath="..\王欣欣\新xsl\王欣欣\xml\临时医嘱.xml" srcSchemaRoot="EMR11.00.02" AssociatedInstance="" loaderFunction="document" loaderFunctionUsesURI="no"/>
		</MapperInfo>
		<MapperBlockPosition>
			<template match="/">
				<block path="html/body/div/xsl:for-each" x="383" y="43"/>
				<block path="html/body/div/xsl:for-each/xsl:if" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[1]/td/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[1]/td[1]/xsl:for-each" x="273" y="13"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[1]/td[1]/xsl:for-each/xsl:if" x="303" y="43"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[0]/string[0]" x="241" y="61"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[2]" x="287" y="103"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[2]/string[0]" x="241" y="97"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[4]" x="287" y="119"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[4]/string[0]" x="241" y="113"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[1]/td[2]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[2]/td[3]/xsl:for-each" x="303" y="43"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table/tr[2]/td[3]/xsl:for-each/xsl:if" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/&gt;[0]" x="267" y="11"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/&gt;[0]/count[0]" x="221" y="5"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if" x="313" y="13"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each" x="23" y="43"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if" x="93" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td[1]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td[1]/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td[3]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td[4]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td[4]/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td[5]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if[1]" x="173" y="33"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if[2]" x="133" y="33"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if[2]/tr/td[2]/table/td/xsl:if/&gt;[0]" x="287" y="71"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if[2]/tr/td[2]/table/td/xsl:if/&gt;[0]/string-length[0]" x="241" y="65"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if[2]/tr/td[2]/table/td/xsl:if/&gt;[0]/string-length[0]/concat[0]" x="195" y="63"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if[2]/tr/td[2]/table/td/xsl:if" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if/xsl:for-each/xsl:if[2]/tr/td[2]/table/td/xsl:value-of[4]" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/=[0]" x="47" y="31"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/=[0]/count[0]" x="1" y="25"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]" x="93" y="33"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td[1]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td[1]/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td[2]/xsl:if/&gt;[0]" x="287" y="71"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td[2]/xsl:if/&gt;[0]/string-length[0]" x="241" y="65"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td[2]/xsl:if/&gt;[0]/string-length[0]/concat[0]" x="195" y="63"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td[2]/xsl:if" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td[2]/xsl:value-of[4]" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td[3]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td[4]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td[4]/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if/table[1]/xsl:if[1]/tr/td[5]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]" x="273" y="13"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/=[0]" x="177" y="41"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if" x="223" y="43"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/&gt;[0]" x="247" y="71"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/&gt;[0]/count[0]" x="201" y="65"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if" x="293" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each" x="383" y="83"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if" x="333" y="113"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if/tr/td/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if/tr/td/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if/tr/td[1]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if/tr/td[1]/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if/tr/td[3]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if/tr/td[4]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if/tr/td[4]/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if/tr/td[5]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if[1]" x="293" y="113"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if[2]" x="253" y="113"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if[2]/tr/td[2]/table/tr/td/xsl:if/&gt;[0]" x="287" y="71"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if[2]/tr/td[2]/table/tr/td/xsl:if/&gt;[0]/string-length[0]" x="241" y="65"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if[2]/tr/td[2]/table/tr/td/xsl:if/&gt;[0]/string-length[0]/concat[0]" x="195" y="63"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if[2]/tr/td[2]/table/tr/td/xsl:if" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if/table/xsl:for-each/xsl:if[2]/tr/td[2]/table/tr/td/xsl:value-of[4]" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if[1]/=[0]" x="127" y="71"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if[1]/=[0]/count[0]" x="81" y="65"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if[1]" x="173" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if[1]/table/tr/td/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if[1]/table/tr/td/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if[1]/table/tr/td[1]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if[1]/table/tr/td[1]/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if[1]/table/tr/td[2]/xsl:value-of[4]" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if[1]/table/tr/td[3]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if[1]/table/tr/td[4]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if[1]/table/tr/td[4]/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if/xsl:if[1]/table/tr/td[5]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/!=[0]" x="87" y="71"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]" x="133" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[1]/td/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[1]/td[1]/xsl:for-each" x="273" y="13"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[1]/td[1]/xsl:for-each/xsl:if" x="303" y="43"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[0]/string[0]" x="241" y="61"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[2]" x="287" y="103"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[2]/string[0]" x="241" y="97"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[4]" x="287" y="119"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[1]/td[1]/xsl:for-each/xsl:if/xsl:value-of/substring[4]/string[0]" x="241" y="113"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[1]/td[2]/xsl:for-each" x="303" y="43"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[1]/td[2]/xsl:for-each/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[2]/td[3]/xsl:for-each" x="303" y="43"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table/tr[2]/td[3]/xsl:for-each/xsl:if" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/&gt;[0]" x="227" y="11"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/&gt;[0]/count[0]" x="181" y="5"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if" x="273" y="13"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each" x="23" y="83"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if" x="213" y="113"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td[1]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td[1]/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td[3]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td[4]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td[4]/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if/tr/td[5]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if[1]" x="173" y="113"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if[2]" x="133" y="113"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if[2]/tr/td[2]/table/td/xsl:if/&gt;[0]" x="287" y="71"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if[2]/tr/td[2]/table/td/xsl:if/&gt;[0]/string-length[0]" x="241" y="65"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if[2]/tr/td[2]/table/td/xsl:if/&gt;[0]/string-length[0]/concat[0]" x="195" y="63"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if[2]/tr/td[2]/table/td/xsl:if" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if/xsl:for-each/xsl:if[2]/tr/td[2]/table/td/xsl:value-of[4]" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/=[0]" x="47" y="111"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/=[0]/count[0]" x="1" y="105"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]" x="93" y="113"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td[1]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td[1]/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td[2]/xsl:if/&gt;[0]" x="287" y="71"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td[2]/xsl:if/&gt;[0]/string-length[0]" x="241" y="65"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td[2]/xsl:if/&gt;[0]/string-length[0]/concat[0]" x="195" y="63"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td[2]/xsl:if" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td[2]/xsl:value-of[4]" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td[3]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td[4]/xsl:value-of" x="333" y="73"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td[4]/xsl:value-of/string[0]" x="287" y="67"/>
				<block path="html/body/div/xsl:for-each/xsl:if[1]/xsl:if[1]/table[1]/xsl:if[1]/tr/td[5]/xsl:value-of" x="333" y="73"/>
			</template>
		</MapperBlockPosition>
		<TemplateContext></TemplateContext>
		<MapperFilter side="source"></MapperFilter>
	</MapperMetaTag>
</metaInformation>
-->