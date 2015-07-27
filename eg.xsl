<?xml version="1.0" ?>
<xsl:stylesheet 
  version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
>

 
  <xsl:template match="/">
    
    <html>
      
      <body>

    <table class="table" role="table">
	<legend> Weight Conversion</legend>
      <tr class="well">
        <th style="text-align:left">Symbol</th>
        <th style="text-align:left">Name</th>
		<th style="text-align:left">Type</th>
        <th style="text-align:left">ply</th>
		<th style="text-align:left">raps</th>
        <th style="text-align:left">Knit Guage</th>
      </tr>
      <xsl:for-each select="title/yarn">
      <tr>
        <td><xsl:value-of select="symbol"/></td>
        <td><xsl:value-of select="name"/></td>
		<td><xsl:value-of select="type"/></td>
        <td><xsl:value-of select="ply"/></td>
		<td><xsl:value-of select="wraps"/></td>
        <td><xsl:value-of select="knit_gauge"/></td>
		
      </tr>
      </xsl:for-each>
    </table>
</body>
</html>  </xsl:template>
</xsl:stylesheet>
